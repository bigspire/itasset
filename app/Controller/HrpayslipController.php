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
//echo Configure::read('WEBSITE').$this->webroot.'hrpayslip/template/'.$employee['HrEmployee']['id'].'/'.$employee['HrPayslip']['month'].'/'.$file_name.'/?'.$urlvar;

//die;						
						$this->Pdf->process(Configure::read('WEBSITE').'/hrpayslip/template/'.$employee['HrEmployee']['id'].'/'.$employee['HrPayslip']['month'].'/'.$file_name.'/?'.$urlvar);
//echo Configure::read('WEBSITE').'/hrpayslip/template/'.$employee['HrEmployee']['id'].'/'.$employee['HrPayslip']['month'].'/'.$file_name.'/?'.$urlvar; die;/
						// save to dbase
						
						if(!copy('/var/www/html/mypdca.in/app/Vendor/fpdf/cache/'.$file_name.'.pdf', '/var/www/html/mypdca.in/app/webroot/uploads/payslip/'.$file_name.'.pdf')){
							echo 'start-/var/www/html/mypdca.in/app/Vendor/fpdf/cache/'.$file_name.'.pdf';
							echo 'end-/var/www/html/mypdca.in/app/webroot/uploads/payslip/'.$file_name.'.pdf';
							echo 'failed to move file';
						}
						
						// remove the copied file
						unlink('/var/www/html/mypdca.in/app/Vendor/fpdf/cache/'.$file_name.'.pdf');
						
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
			if(!copy('/var/www/html/mypdca.in/app/Vendor/fpdf/cache/'.$file_name.'.pdf', '/var/www/html/mypdca.in/app/webroot/uploads/payslip/'.$file_name.'.pdf')){
							echo 'start-/var/www/html/mypdca.in/app/Vendor/fpdf/cache/'.$file_name.'.pdf';
							echo 'end-/var/www/html/mypdca.in/app/webroot/uploads/payslip/'.$file_name.'.pdf';
							echo 'failed to move file';
						}
						
			// remove the copied file
			unlink('/var/www/html/mypdca.in/app/Vendor/fpdf/cache/'.$file_name.'.pdf');
			
			$paydata = $this->get_payslip_id($emp_id, $pay_date);
			$this->save_data($paydata[0]['HrPayslip']['id'],$file_name);		
			
			$this->redirect('/hruploadpay/?gen_pay=success&'.$urlvar);
		}		
		
	}

	/* function to save the data */
	public function save_data($id,$file){
	
	//echo WWW_ROOT.'/uploads/payslip/'.$file; die;
	//echo $this->webroot.'app/webroot/uploads/payslip/'.$file.'.pdf'; die;
	
		if(file_exists('/var/www/html/mypdca.in/app/webroot/uploads/payslip/'.$file.'.pdf')){
		
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
			
			
			$pay_data = $this->HrPayslip->find('all', array('fields' => array('HrPayslip.id','lop','basic','hra','conveyance','food_allowance','edu_allowance','spl_allowance','pf','esi','loans','prof_tax','food_coupon_sal','fuel_reimburse','attendance','phone_reimburse','food_coupon_issued','income_tds','other_deduct','tot_earn','tot_deduct','net_amount','HrEmployee.first_name','HrEmployee.last_name','HrEmployee.emp_no','HrDepartment.dept_name','HrDesignation.desig_name','HrBank.bank','HrBank.branch','HrBankAcc.acc_no','HrBankAcc.acc_name','HrEmployee.doj','HrEmployee.pan','HrEmployee.pran_no','HrEmployee.pf_no','HrEmployee.esi_no','HrCompany.company_name','HrCompany.logo','HrCompany.address','HrCompany.pincode','HrCompany.city','HrBranch.branch_name'), 'conditions' => array('HrPayslip.app_users_id' => $emp_id, 'month' => $pay_date),'joins' => $options, 'group' => array('HrEmployee.id')));	
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
	
	
	/* function to send reminder for HRIS module */
	public function hris_reminder(){
		$this->reject_leave();
		$this->probation_reminder();
		$this->contract_validity_reminder();
	}
	
	
	/* function to reject leave request more than 3 days */
	public function reject_leave(){
		$this->loadModel('HrLeave');
		$date = date('Y-m-d', strtotime('-6 days'));
		// fetch leaves pending for more than 3 days
		$data = $this->HrLeave->find('all', array('fields' => array('HrLeave.id','max(HrLeaveStatus.id) as status_id','Home.first_name',
		'Home.last_name','leave_from','leave_to','HrLeaveType.desc','no_days','reason','Home.email_address'), 
		'conditions' => array('is_approve' => 'N', 'HrLeave.is_deleted' => 'N', "date_format(HrLeave.created_date,'%Y-%m-%d') <=" => $date),
		'order' => array('HrLeave.created_date' => 'asc'), 'group' => array('HrLeave.id')));
		// iterate the data set
		$this->loadModel('HrLeaveStatus');
		foreach($data as $record){ 
			$data = array('id' => $record[0]['status_id'], 'modified_date' => $this->Functions->get_current_date(),
			'remarks' => 'AUTO REJECT', 'status' => 'R');
			$this->HrLeaveStatus->save($data);
			// update the leave
			$this->HrLeave->id = $record['HrLeave']['id'];
			$this->HrLeave->saveField('is_approve', 'R');
			$this->HrLeave->saveField('auto_reject', '1');
			// send mail to the user
			$this->notify_employee($record);			
		}
		$this->render(false);
	}

	/* function to notify finance */
	public function notify_employee($data){					
		$sub = 'My PDCA - Leave request is rejected automatically!';
		$from = 'noreply@mypdca.in';
		$name = $data['Home']['first_name'].' '.$data['Home']['last_name'];
		$vars = array('from_name' => $from,  'name' => $name, 'reason' => $data['HrLeave']['reason'],
		'leave_from' => $data['HrLeave']['leave_from'], 'leave_to' => $data['HrLeave']['leave_to'],
		'nodays' => $data['HrLeave']['no_days'], 'leave_type' => $data['HrLeaveType']['desc'],
		'employee' => $name);
		// notify superiors						
		$this->send_email($sub, 'notify_leave_reject', 'noreply@mypdca.in', $data['Home']['email_address'],$vars);	
	}
	
	/* function to remind probation / contract expiry */	
	public function probation_reminder(){
		$this->loadModel('HrEmployee');
		$this->HrEmployee->unBindModel(array('belongsTo' => array('HrDepartment','HrDesignation', 'Role', 'HrCompany', 'HrGrade','HrBloodGroup','HrBranch','HrBusinessUnit','')));
		$this->HrEmployee->unBindModel(array('hasOne' => array('HrEducation','HrExperience','HrFamily')));		
		$data = $this->HrEmployee->find('all', array('fields'=> array('HrEmployee.id','first_name',  'last_name','doc','email_address'),
		'conditions' => array('probation' => 'Y', 'HrEmployee.is_deleted' => 'N', 'doc !=' => '',  'HrEmployee.status' => '1', 
		'probation_reminder' => '', 'doc <=' => date('Y-m-d'))));
		// get director details
		$direc_data = $this->HrEmployee->find('all', array('fields'=> array('HrEmployee.id'),'conditions' => array('app_roles_id' => '18', 'HrEmployee.status' => '1')));
		$user_id[] = $direc_data[0]['HrEmployee']['id'];
		$this->loadModel('Approval');
		// iterate the results to send mail
		foreach($data as $record){
			// get the superiors
			$approval_data = $this->Approval->find('first', array('fields' => array('level1','level2'), 'conditions'=> array('Approval.app_users_id' => $record['HrEmployee']['id'], 'type' => 'L')));
			$user_id[] = $approval_data['Approval']['level1'];	
			$user_id[] = $approval_data['Approval']['level2'];
			$superior_data = $this->HrEmployee->find('all', array('fields'=> array('first_name','last_name','email_address'),
			'conditions' => array('HrEmployee.id' => $user_id), 'group' => array('HrEmployee.id')));
			// iterate the superiors to send mail
			foreach($superior_data as $superior){
				$name = $superior['HrEmployee']['first_name'].' '.$superior['HrEmployee']['last_name'];
				// send mail to the user
				$sub = 'My PDCA - '.$record['HrEmployee']['first_name'].' '.$record['HrEmployee']['last_name'].' Probation Confirmation Reminder!';
				$vars = array('from_name' => 'noreply@mypdca.in', 'name' => $name, 'doc' => $record['HrEmployee']['doc'],			
				'employee' => $record['HrEmployee']['first_name'].' '.$record['HrEmployee']['last_name']);
				// notify superiors						
				$this->send_email($sub, 'notify_probation', 'noreply@mypdca.in', $superior['HrEmployee']['email_address'],$vars);
				
			}
			// update the reminder
			$this->HrEmployee->id = $record['HrEmployee']['id'];
			$this->HrEmployee->saveField('probation_reminder', '1');			
		}
		$this->render(false);
	}
	
	/* function to send reminder for contract validity */
	public function contract_validity_reminder(){
		$this->loadModel('HrEmployee');
		$this->HrEmployee->unBindModel(array('belongsTo' => array('HrDepartment','HrDesignation', 'Role', 'HrCompany', 'HrGrade','HrBloodGroup','HrBranch','HrBusinessUnit','')));
		$this->HrEmployee->unBindModel(array('hasOne' => array('HrEducation','HrExperience','HrFamily')));		
		$data = $this->HrEmployee->find('all', array('fields'=> array('HrEmployee.id','first_name','emp_type','last_name','contract_from','contract_to','email_address'),
		'conditions' => array('emp_type !=' => 'R', 'contract_reminder' => '', 'HrEmployee.is_deleted' => 'N','contract_from !=' => '0000-00-00','contract_to !=' => '0000-00-00',  'HrEmployee.status' => '1', 
		'contract_to <=' => date('Y-m-d', strtotime('+1 week')))));
		// get director details
		$direc_data = $this->HrEmployee->find('all', array('fields'=> array('HrEmployee.id'),'conditions' => array('app_roles_id' => '18', 'HrEmployee.status' => '1')));
		$user_id[] = $direc_data[0]['HrEmployee']['id'];
		$this->loadModel('Approval');
		// iterate the results to send mail
		foreach($data as $record){ 
			// get the superiors
			$approval_data = $this->Approval->find('first', array('fields' => array('level1','level2'), 'conditions'=> array('Approval.app_users_id' => $record['HrEmployee']['id'], 'type' => 'L')));
			$user_id[] = $approval_data['Approval']['level1'];	
			$user_id[] = $approval_data['Approval']['level2'];
			$superior_data = $this->HrEmployee->find('all', array('fields'=> array('first_name','last_name','email_address'),
			'conditions' => array('HrEmployee.id' => $user_id), 'group' => array('HrEmployee.id')));
			// iterate the superiors to send mail
			foreach($superior_data as $superior){
				$name = $superior['HrEmployee']['first_name'].' '.$superior['HrEmployee']['last_name'];
				// send mail to the user
				$sub = 'My PDCA - '.$record['HrEmployee']['first_name'].' '.$record['HrEmployee']['last_name'].' Contract Period Ending!';
				$vars = array('from_name' => 'noreply@mypdca.in', 'type' => $record['HrEmployee']['emp_type'], 'name' => $name, 'cf' => $record['HrEmployee']['contract_from'], 'ct' => $record['HrEmployee']['contract_to'],			
				'employee' => $record['HrEmployee']['first_name'].' '.$record['HrEmployee']['last_name']);
				// notify superiors						
				$this->send_email($sub, 'notify_contract', 'noreply@mypdca.in', $superior['HrEmployee']['email_address'],$vars);
			}
			// update the reminder
			$this->HrEmployee->id = $record['HrEmployee']['id'];
			$this->HrEmployee->saveField('contract_reminder', '1');			
		}
		$this->render(false);
	}
}