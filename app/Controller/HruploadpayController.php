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
 
class HruploadpayController extends AppController {  
	
	public $name = 'HrUploadPay';	
	
	public $helpers = array('Html', 'Form', 'Session');
	
	public $components = array('Session', 'Functions','Excel');
	
	public $layout = 'apps';	

	/* function to list the adv. requests */
	public function index(){	
	
		// set the page title
		$this->set('title_for_layout', 'Payslip - HRIS - My PDCA');
		// when the form is submitted for search
		if($this->request->is('post')){
			$url_vars = $this->Functions->create_url(array('keyword','from','to'),'HrUploadPay'); 
			$this->redirect('/hruploadpay/?'.$url_vars);					
		}
		if($this->params->query['keyword'] != ''){
			$keyCond = array("MATCH (HrEmployee.first_name) AGAINST ('".$this->params->query['keyword']."' IN BOOLEAN MODE)"); 
		}
		 			
		// for date search
		if($this->params->query['from'] != '' || $this->params->query['to'] != ''){
			$from = $this->Functions->format_date_search($this->params->query['from']).'-1';
			$to = $this->Functions->format_date_search($this->params->query['to']).'-1';
			
			$dateCond = array('or' => array('month between ? and ?' => array($from, $to),'month between ? and ?' => array($from, $to))); 			
		}else{
			// set default date condition
			$from = date('Y-m', strtotime('-1 months')).'-1';
			$to =  date('Y-m', strtotime('-1 months')).'-1';
			$dateCond = array('or' => array('month between ? and ?' => array($from, $to),'month between ? and ?' => array($from, $to)));
			// set the default search dates
			$this->request->data['HrUploadPay']['from'] =  date('m/Y', strtotime('-1 months'));
			$this->request->data['HrUploadPay']['to'] =  date('m/Y', strtotime('-1 months'));
		}	
	
		
		// assign url vars.
		if(!empty($this->request->query['from']) || !empty($this->request->query['to'])){
			$urlvar = '?keyword='.$this->request->query['keyword'].'&from='.$this->request->query['from'].'&to='.$this->request->query['to'];
			$this->set('url_var', $urlvar);
		}
			
	
		$this->paginate = array('fields' => array('id', 'pdf_created', 'pdf_file', 'HrEmployee.id', 'month', 'net_amount', 'HrEmployee.first_name', 'HrEmployee.last_name', 'HrUploadPay.created_date','HrEmployee.email_address', 'HrEmployee.emp_no'),'limit' => 10,  'conditions' => array($keyCond, $dateCond, 'HrUploadPay.is_deleted' => 'N', 'HrEmployee.status' => '1'), 'order' => array('HrEmployee.first_name' => 'asc'));
		$data = $this->paginate('HrUploadPay');			
		$this->set('pay_data', $data);
		if(empty($data)){
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>You havn\'t created any payslips', 'default', array('class' => 'alert alert'));	
		}
		
	}
		
	
	/* function to edit the form */
	public function upload(){		
		// set the page title		
		$this->set('title_for_layout', 'Upload Payslip - HRIS - My PDCA');		
		// when the form submitted
		if (!empty($this->request->data)){ 
			// validates the form
			$this->HrUploadPay->set($this->request->data);				
			if ($this->HrUploadPay->validates(array('fieldList' => array('upload_file')))) {				
				$this->request->data['HrUploadPay']['created_date'] = $this->Functions->get_current_date();
				$this->request->data['HrUploadPay']['created_by'] = $this->Session->read('USER.Login.id');
				$this->request->data['HrUploadPay']['month'] = $this->request->data['HrUploadPay']['sal_year']['year'].'-'.$this->request->data['HrUploadPay']['sal_month']['month'].'-'.'01';
				// upload excel file				
				$file = $this->upload_attachment($this->request->data['HrUploadPay']['upload_file']);	
				// read the excel file
				$data = $this->Excel->read_data('uploads/salary/'.$file);
				$suc_start = "<span class='out_suc'>";
				$fail_start = "<span class='out_fail'> ";
				$end = ' </span>';
				$output = '';
				// iterate excel array
				foreach($data as $key =>  $salary){	
					// skip the headers and title
					if($key >= 3){	
						// make sure it has value
						if(!empty($salary['B'])){
							$this->HrUploadPay->HrEmployee->unBindModel(array('belongsTo' => array('HrDepartment','HrDesignation','HrGrade','Role','HrCompany','HrBranch')));
							$emp_detail = $this->HrUploadPay->HrEmployee->find('all', array('fields' => array('id'), 'conditions' => array('HrEmployee.emp_no' => trim(strtoupper($salary['B'])))));
							// check user exists
							if(!empty($emp_detail[0]['HrEmployee']['id'])){ 
								$exists = $this->check_salary_exists($emp_detail[0]['HrEmployee']['id'], $this->request->data['HrUploadPay']['month']);
								// format the data
								$this->request->data['HrUploadPay']['app_users_id'] = $emp_detail[0]['HrEmployee']['id'];
								$this->request->data['HrUploadPay']['lop'] = $salary['C'];
								$this->request->data['HrUploadPay']['basic'] = $salary['D'];
								$this->request->data['HrUploadPay']['conveyance'] = $salary['E'];
								$this->request->data['HrUploadPay']['edu_allowance'] = $salary['F'];
								$this->request->data['HrUploadPay']['food_allowance'] = $salary['G'];
								$this->request->data['HrUploadPay']['food_coupon_sal'] = $salary['H'];
								$this->request->data['HrUploadPay']['fuel_reimburse'] = $salary['I'];					
								$this->request->data['HrUploadPay']['hra'] = $salary['J'];
								$this->request->data['HrUploadPay']['spl_allowance'] = $salary['K'];
								$this->request->data['HrUploadPay']['phone_reimburse'] = $salary['L'];
								$this->request->data['HrUploadPay']['tot_earn'] = $salary['M'];							
								$this->request->data['HrUploadPay']['pf'] = $salary['N'];
								$this->request->data['HrUploadPay']['esi'] = $salary['O'];
								$this->request->data['HrUploadPay']['food_coupon_issued'] = $salary['P'];
								$this->request->data['HrUploadPay']['income_tds'] = $salary['Q'];
								$this->request->data['HrUploadPay']['loans'] = $salary['R'];
								$this->request->data['HrUploadPay']['other_deduct'] = $salary['S'];						
								$this->request->data['HrUploadPay']['prof_tax'] = $salary['T'];
								$this->request->data['HrUploadPay']['tot_deduct'] = $salary['U'];
								$this->request->data['HrUploadPay']['net_amount'] = $salary['V'];
								if($exists != ''){
									$output_str = 'modified';
									$this->HrUploadPay->id = $exists;
									// reset pdf created and file 
									$this->request->data['HrUploadPay']['pdf_created'] = '';
									$this->request->data['HrUploadPay']['pdf_file'] = '';
									
								}else{
									$output_str = 'uploaded';
									$this->HrUploadPay->create();
								}
								// save into database							
								if($this->HrUploadPay->save($this->request->data['HrUploadPay'])) {		
									$output .= $suc_start.$salary['A'] ." salary $output_str successfully<br>".$end;
								}else{
									$output .= $suc_start.$salary['A'] ." salary failed to upload <br>".$end;
								}
							}else{
								$output .= $fail_start.$salary['A'] ." doesn't exists in the company<br>".$end;
							}
						}						
					}if($key == 1){	
						$this->request->data['HrUploadPay']['attendance'] = $salary['A'];
					}
					
					
				}				
				
				$file = $this->write_report($output);
				
				// show the msg.
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>'.$output."<br><a href=".$this->webroot.'hruploadpay/download_report/'.$file.'>Download Report</a>', 'default', array('class' => 'alert alert-success'));
				
			}	
		}
	}
	
	/* function to create report */
	public function write_report($op){ 		
		$file = time().'_payslip.txt';
		$path = WWW_ROOT.'/uploads/report/'.$file;
		$fp = fopen($path, 'w+');
		$op_new = str_replace(array("<span class='out_suc'>", "<span class='out_fail'>","</span>"), array('', '', ''), $op);
		$op_ar = explode('<br>', $op_new);		
		foreach($op_ar as $key =>  $str){ 
			if(trim($str) != ''){		
				fputs($fp, ++$key.') '.trim($str)."\r\n");
			}
		}
		fclose($fp);
		return $file;
		
	}
	
	/* function to download the file */
	public function download_report($file){
		$this->download_file(WWW_ROOT.'/uploads/report/'.$file);
		die;
	
	}
	
	/* function to download the file */
	public function download_pay($file){		
		$this->download_file(WWW_ROOT.'/uploads/payslip/'.$file);
		die;
	}
	
	/* function to download the file */
	public function download_sample($file){		
		$this->download_file(WWW_ROOT.'/uploads/sample/'.$file);
		die;
	}
	
	
	/* function to delete the adv. request */
	public function delete_payslip($id){
		if(!empty($id) && intval($id)){
			// authorize user before action
			$ret_value = $this->auth_action($id);
			if($ret_value == 'pass'){		
				$this->HrUploadPay->id = $id;
				$this->HrUploadPay->saveField('is_deleted', 'Y'); 
				$this->HrUploadPay->saveField('modified_date', $this->Functions->get_current_date()); 
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Payslip deleted successfully', 'default', array('class' => 'alert alert-success'));			
			}else if($ret_value == 'fail'){
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/hruploadpay/');
			}else{
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Record Deleted: '.$ret_value , 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/hruploadpay/');
			}
		}else{
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));			
		}
		$this->redirect('/hruploadpay/');
	}
	
	/* function to auth record */
	public function auth_action($id){
		$data = $this->HrUploadPay->findById($id, array('fields' => 'id','is_deleted','modified_date'));	
		// check the req belongs to the user
		if($data['HrUploadPay']['is_deleted'] == 'Y'){
			return $data['HrUploadPay']['modified_date'];
		}		
		else if(empty($data)){	
			return 'fail';
		}else{
			return 'pass';
		}
	}
	
	/* function to check salary already exists */
	public function check_salary_exists($id, $month){
		$upload_data = $this->HrUploadPay->find('all', array('fields' => array('id'), 'conditions' => array('HrUploadPay.app_users_id' => $id, 'HrUploadPay.month' => $month), 'limit' => '1'));
		return $upload_data[0]['HrUploadPay']['id'];
	}
	
	/* function to upload the file */
	public function upload_attachment($data){
		// validate the file				
		if(!empty($data['tmp_name'])){
			$file = time().'_'.$data['name']; 
			if($this->upload_file($data['tmp_name'], WWW_ROOT.'/uploads/salary/'.$file)){
				return $file;
			}			
		}
				
	}
	
	
	/* clear the cache */
	
	public function beforeFilter() { 
		//$this->disable_cache();
		$this->show_tabs(39);
	}
	
	
		/* auto complete search */	
	public function search(){ 
		$this->layout = false;	 
		$q = trim(Sanitize::escape($_GET['q']));	
		if(!empty($q)){
			// execute only when the search keywork has value		
			$this->set('keyword', $q);
			$data = $this->HrUploadPay->find('all', array('fields' => array('HrEmployee.first_name'),  'group' => array('HrEmployee.first_name'), 'conditions' => array("OR" => array ('HrEmployee.first_name like' => $q.'%'), 'AND' => array('HrUploadPay.is_deleted' => 'N','HrEmployee.is_deleted' => 'N'))));		
			$this->set('results', $data);
		}
    }
	
	

	
}