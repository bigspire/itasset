<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
 
App::uses('Sanitize', 'Utility');
 
class HrpayslipController extends AppController {  
	
	public $name = 'HrPayslip';	
	
	public $helpers = array('Html', 'Form', 'Session');
	
	public $components = array('Session', 'Functions', 'Pdf');
	
	public $layout = 'pdf';

	

	/* function to list the adv. requests */
	public function index($emp_id, $pay_date){  
		$options = array(	
			array('table' => 'app_users',
					'alias' => 'HrEmployee',					
					'type' => 'LEFT',
					'conditions' => array('`HrPayslip`.`app_users_id` = `HrEmployee`.`id`')
				)
			);	
		// assign url vars.
		if(!empty($this->request->query['from']) || !empty($this->request->query['to']) || !empty($this->request->query['keyword'])){
			$urlvar = 'keyword='.$this->request->query['keyword'].'&from='.$this->request->query['from'].'&to='.$this->request->query['to'];
		}
		//  for all payslip generation
		if($emp_id == 'all'){
			$data = $this->HrPayslip->find('all', array('fields' => array('HrEmployee.id', 'HrPayslip.month', 'HrEmployee.first_name'), 'conditions' => array('HrEmployee.is_deleted' => 'N', 'HrEmployee.status' => '1', 'pdf_created' => ''),'joins' => $options, 'group' => array('HrPayslip.id')));
			// make sure any payslips to be generated
			if(!empty($data)){
				// fetch all employee		
				foreach($data as $employee){
					if(!empty($employee['HrEmployee']['first_name'])){
						$file_name = time().'_'.trim($employee['HrEmployee']['first_name']).'_payslip';		
						// call payslip generator
						$this->Pdf->init($file_name, 'file');		
						$this->Pdf->process(Configure::read('WEBSITE').$this->webroot.'hrpayslip/template/'.$employee['HrEmployee']['id'].'/'.$employee['HrPayslip']['month'].'/'.$file_name.'/?'.$urlvar);
						// save to dbase
						$paydata = $this->get_payslip_id($employee['HrEmployee']['id'], $employee['HrPayslip']['month']);
						$this->save_data($paydata[0]['HrPayslip']['id'],$file_name);
					}
				}
			}else{
				$this->redirect('/hruploadpay/?gen_pay=nopayslip'.$urlvar);
			}
			
		}else{			
			$data = $this->HrPayslip->find('all', array('fields' => array('HrEmployee.first_name'), 'conditions' => array('HrEmployee.id' => $emp_id),'joins' => $options, 'group' => array('HrEmployee.id'), 'limit' => '1'));			
			$employee = trim($data[0]['HrEmployee']['first_name']);	
			$employee = str_replace(' ', '_', $employee);
			$file_name = time().'_'.$employee.'_payslip';	
			
			// call payslip generator
			$this->Pdf->init($file_name, 'file');	
			//echo Configure::read('WEBSITE').$this->webroot.'hrpayslip/template/'.$emp_id.'/'.$pay_date.'/'.$file_name.'/?'.$urlvar;
			$this->Pdf->process(Configure::read('WEBSITE').$this->webroot.'hrpayslip/template/'.$emp_id.'/'.$pay_date.'/'.$file_name.'/?'.$urlvar);	
			// save to dbase			
			$paydata = $this->get_payslip_id($emp_id, $pay_date);
			$this->save_data($paydata[0]['HrPayslip']['id'],$file_name);		
			
			$this->redirect('/hruploadpay/?gen_pay=success&'.$urlvar);
		}		
		
	}

	/* function to save the data */
	public function save_data($id,$file){
	
		if(file_exists(WWW_ROOT.'/uploads/payslip/'.$file.'.pdf')){
			$data = array('id' => $id, 'pdf_created' => $this->Functions->get_current_date(), 'pdf_file' => $file.'.pdf');
			// update the payslip creation
			if($this->HrPayslip->save($data, true, $fieldList = array('pdf_created', 'pdf_file'))){					
			}
			else{
				
			}
		}
	
	}		
	
	
	public function template($emp_id, $pay_date, $file_name){	
		//public $layout = 'apps';
		if(!empty($emp_id) && !empty($pay_date)){
			$options = array(	
				array('table' => 'app_users',
						'alias' => 'HrEmployee',					
						'type' => 'LEFT',
						'conditions' => array('`HrPayslip`.`app_users_id` = `HrEmployee`.`id`')
				),
				array('table' => 'hr_bank_account',
						'alias' => 'HrBankAcc',					
						'type' => 'LEFT',
						'conditions' => array('`HrBankAcc`.`app_users_id` = `HrEmployee`.`id`',
						'HrBankAcc.app_users_id' => $emp_id)
				),
				array('table' => 'hr_bank',
						'alias' => 'HrBank',					
						'type' => 'LEFT',
						'conditions' => array('`HrBank`.`id` = `HrBankAcc`.`hr_bank_id`',
						'HrBankAcc.app_users_id' => $emp_id)
				),
				
				array('table' => 'hr_department',
						'alias' => 'HrDepartment',					
						'type' => 'LEFT',
						'conditions' => array('`HrDepartment`.`id` = `HrEmployee`.`hr_department_id`')
				),
								
				array('table' => 'hr_designation',
						'alias' => 'HrDesignation',					
						'type' => 'LEFT',
						'conditions' => array('`HrDesignation`.`id` = `HrEmployee`.`hr_designation_id`')
				),				
								
				array('table' => 'hr_company',
						'alias' => 'HrCompany',					
						'type' => 'LEFT',
						'conditions' => array('`HrCompany`.`id` = `HrEmployee`.`hr_company_id`')
				),				
								
				array('table' => 'hr_branch',
						'alias' => 'HrBranch',					
						'type' => 'LEFT',
						'conditions' => array('`HrBranch`.`id` = `HrEmployee`.`hr_branch_id`')
				)
			);
			
			$pay_data = $this->HrPayslip->find('all', array('fields' => array('HrPayslip.id','basic','hra','conveyance','food_allowance','edu_allowance','spl_allowance','pf','esi','loans','prof_tax','food_coupon_sal','fuel_reimburse','attendance','phone_reimburse','food_coupon_issued','income_tds','other_deduct','tot_earn','tot_deduct','net_amount','HrEmployee.first_name','HrEmployee.last_name','HrEmployee.emp_no','HrDepartment.dept_name','HrDesignation.desig_name','HrBank.bank','HrBank.branch','HrBankAcc.acc_no','HrBankAcc.acc_name','HrEmployee.doj','HrEmployee.pan','HrEmployee.pran_no','HrEmployee.pf_no','HrEmployee.esi_no','HrCompany.company_name','HrCompany.logo','HrCompany.address','HrCompany.pincode','HrCompany.city','HrBranch.branch_name'), 'conditions' => array('HrPayslip.app_users_id' => $emp_id, 'month' => $pay_date),'joins' => $options, 'group' => array('HrEmployee.id')));	
			$this->set('paymonth', strtoupper(date('F, Y', strtotime($pay_date))));	
			$this->set('pay_data', $pay_data);
			
			
		}
			
		
	}
	
	/* function to get payslip id */
	public function get_payslip_id($emp_id, $pay_date){
		return $data = $this->HrPayslip->find('all', array('fields' => array('HrPayslip.id'), 'conditions' => array('HrPayslip.app_users_id' => $emp_id, 'month' => $pay_date),'limit' => '1'));
	}
	
	
	
	public function beforeRender(){
		
	}
	
	
	

	
		
	
}