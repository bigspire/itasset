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
class HrleaveController extends AppController {  
	
	public $name = 'HrLeave';	
	
	public $helpers = array('Html', 'Form', 'Session');
	
	public $components = array('Session', 'Functions');
	
	public $layout = 'apps';	

	/* function to list the adv. requests */
	public function index(){	
		// set the page title
		$this->set('title_for_layout', 'Leave - HRIS - My PDCA');		
		
		// when the form is submitted for search
		if($this->request->is('post')){			
			$url_vars = $this->Functions->create_url(array('keyword', 'from', 'to'),'HrLeave'); 
			$this->redirect('/hrleave/?'.$url_vars);			
		}
		if($this->params->query['keyword'] != ''){
			$keyCond = array("MATCH (reason) AGAINST ('".$this->params->query['keyword']."' IN BOOLEAN MODE)"); 
		}
		// for date search
		if($this->params->query['from'] != '' || $this->params->query['to'] != ''){
			$from = $this->Functions->format_date_save($this->params->query['from']);
			$to = $this->Functions->format_date_save($this->params->query['to']);
			
			$dateCond = array('or' => array('leave_from between ? and ?' => array($from, $to),'leave_to between ? and ?' => array($from, $to))); 
		}
		
		$options = array(			
			array('table' => 'hr_leave_status',
					'alias' => 'HrLeaveStatuses',					
					'type' => 'LEFT',
					'conditions' => array('`HrLeaveStatuses`.`hr_leave_id` = `HrLeave`.`id`')
			),
			array('table' => 'app_users',
					'alias' => 'Homes',					
					'type' => 'LEFT',
					'conditions' => array('`HrLeaveStatuses`.`app_users_id` = `Homes`.`id`')
			)
		);
			
							
		$this->HrLeave->unBindModel(array('hasOne' => array('HrLeaveStatus')));
		$this->HrLeave->unBindModel(array('belongsTo' => array('Home')));

		// fetch the advances		
		$this->paginate = array('fields' => array('id','leave_from', 'auto_reject', 'leave_to','reason', 'no_days','HrLeaveType.desc', 'created_date','group_concat(HrLeaveStatuses.status) as st_status', 'group_concat(Homes.first_name) as st_user', 'group_concat(HrLeaveStatuses.modified_date) as st_modified','group_concat(HrLeaveStatuses.created_date) as st_created', 'group_concat(HrLeaveStatuses.remarks) as st_remarks'),'limit' => 10,'conditions' => array($keyCond,$dateCond, 'HrLeave.app_users_id' => $this->Session->read('USER.Login.id'),'HrLeave.is_deleted' => 'N'), 'order' => array('created_date' => 'desc'), 'group' => array('HrLeave.id'), 'joins' => $options);
		$data = $this->paginate('HrLeave');
		
		$this->set('leave_data', $data);
		if(empty($data)){
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>You have no leave request found', 'default', array('class' => 'alert alert'));	
		}
		
		// for post dated leaves
		if($this->request->query['action'] == 'lvtaken'){
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Sorry, you cannot create post dated leaves unless you have informed to any about the leave', 'default', array('class' => 'alert alert-info'));
			$this->redirect('/hrleave/');	
		}
		
		
		//$gender = $this->set_user_gender();	
		// load leave types
	
		$this->load_leave_types($this->Session->read('USER.Login.gender'),$this->Session->read('USER.Login.id'),$this->Session->read('USER.Login.doj'),$this->Session->read('USER.Login.emp_type'));
		// get leaves remaining
		$this->get_used_leaves($this->Session->read('USER.Login.id'),$this->Session->read('USER.Login.doj'),$this->Session->read('USER.Login.emp_type'),$this->Session->read('USER.Login.doc'));
		// get the comp off days of user
		$this->get_compoff_details($this->Session->read('USER.Login.id'));
		
		
	}
	
	
	/* function to show the leave policy */
	public function leave_policy(){
		
		
	}
	
	/* function to calculate only working days */
	public function check_leave_days(){
		$this->layout ='refresh';
		$from_exp = explode('/', $this->request->query['from']);
		$from = $from_exp[2].'-'.$from_exp[1].'-'.$from_exp[0];
		$to_exp = explode('/', $this->request->query['to']);
		$to = $to_exp[2].'-'.$to_exp[1].'-'.$to_exp[0];
		// get diff b/w the dates
		$diff = $this->HrLeave->diff_date($from, $to);	
		// get emp. holidays
		//$holidays = $this->get_user_holidays();
		//  && in_array($from, $holidays) === FALSE 
		$count = 0;
		while($diff >= 0){			
			//for sunday
			$day = date('N', strtotime($from));
			// get date
			$date = explode('-', $from);
			if($day == 6){ 
				// get first day
				$first_day = date('N', strtotime($date[0].'-'.$date[1].'-'.'01'));
				// get first sat
				$first_sat = $this->get_first_sat($first_day);
				$second_sat = $first_sat  + 7;
				$third_sat = $second_sat + 7;
				$forth_sat = $third_sat + 7;
			}			
			// remove sundays, second, forth sat and holidays
			if($day != '7' && $date[2] != $second_sat && $date[2] != $forth_sat){						
				$count++;
			}else{
				//echo $from;
			}
			$from =  date('Y-m-d', strtotime($from ." +1 days"));
			$diff--;
		}
		echo $count;
		$this->render(false);
		die;
	}
	
	
	/* function to set user's gender */
	public function set_user_gender(){
		$gender = $this->HrLeave->Home->findById($this->Session->read('USER.Login.id'), array('fields' => 'Home.gender'));
		return $gender['Home']['gender'];
		
	}
	
	
	
	
	public function write_file($data, $file){
		$fp = fopen($file, 'w+');
		fputs($fp, print_r($data, true));
		fclose($fp);
	}
	
	/* function to save the advance */
	public function create_leave(){ 		
		// set the page title		
		$this->set('title_for_layout', 'Request Leave - HRIS - My PDCA');	
		//$gender = $this->set_user_gender();	
		// load leave types
		$this->load_leave_types($this->Session->read('USER.Login.gender'),$this->Session->read('USER.Login.id'),$this->Session->read('USER.Login.doj'),$this->Session->read('USER.Login.emp_type'));
		// get leaves remaining
		$this->get_used_leaves($this->Session->read('USER.Login.id'),$this->Session->read('USER.Login.doj'),$this->Session->read('USER.Login.emp_type'),$this->Session->read('USER.Login.doc'));
		// get the comp off days of user
		$this->get_compoff_details($this->Session->read('USER.Login.id'));
		// get the business unit
		/*
		$user_bus = $this->HrLeave->Home->findById($this->Session->read('USER.Login.id'), array('fields'=> 'hr_business_unit_id'));
		if($user_bus['Home']['hr_business_unit_id'] == 1){
			$no_days = 30;
		}else{
			$no_days = 15;
		}
		// generate comp off dates
		$last_days = $this->Functions->generate_comp_days($no_days, 'list');
		$this->set('lastDays', $last_days);
		*/
		
		if ($this->request->is('post')){ 
			// validates the form
			$this->HrLeave->set($this->request->data);
			$this->resetHalf();
			if ($this->HrLeave->validates(array('fieldList' => array('leave_from', 'leave_to','hr_leave_type_id','reason', 'comp_off_dates')))) {
				// validate no. of days
				if($this->check_no_days()){				
					$this->request->data['HrLeave']['app_users_id'] = $this->Session->read('USER.Login.id');
					// format the dates to save					
					$this->request->data['HrLeave']['leave_from'] = $this->Functions->format_date_save($this->request->data['HrLeave']['leave_from']);
					$this->request->data['HrLeave']['leave_to'] = $this->Functions->format_date_save($this->request->data['HrLeave']['leave_to']);
					$this->request->data['HrLeave']['created_date'] = $this->Functions->get_current_date();
					// save comp. off dates
					if($this->request->data['HrLeave']['hr_leave_type_id'] == '7'){ 					
						$comp_date = $this->request->data['HrLeave']['comp_off_dates'][0];
						if(!empty($this->request->data['HrLeave']['comp_off_dates'][1])){
							$comp_date .= ','.$this->data['HrLeave']['comp_off_dates'][1];
						}
					}
					// save the data
					if($this->HrLeave->save($this->request->data['HrLeave'], array('validate' => false))) {
						// save comp off dates
						$this->save_comp_off($this->HrLeave->id);
						// get the superiors
						$this->loadModel('Approval');
						$approval_data = $this->Approval->find('first', array('fields' => array('level1'), 'conditions'=> array('Approval.app_users_id' => $this->Session->read('USER.Login.id'), 'type' => 'L')));
						// save finance req. status data
						$this->loadModel('HrLeaveStatus');
						$data = array('hr_leave_id' => $this->HrLeave->id, 'created_date' => $this->Functions->get_current_date(), 'app_users_id' => $approval_data['Approval']['level1']);
						
						if(!empty($approval_data)){
							// make sure not duplicate status exists
							$this->check_duplicate_status($this->HrLeave->id, $approval_data['Approval']['level1']);
							// save in adv. status table
							if($this->HrLeaveStatus->save($data, true, $fieldList = array('hr_leave_id','created_date','app_users_id'))){						
								// save adv. users
								$this->loadModel('HrLeaveUser');
								$leave_user_data = array('hr_leave_id' => $this->HrLeave->id, 'app_users_id' => $approval_data['Approval']['level1']);							
								$this->HrLeaveUser->id = '';
								$this->HrLeaveUser->save($leave_user_data, true, $fieldList = array('hr_leave_id','app_users_id'));					
						
								// get approver email id
								$this->loadModel('Home');
								$superior_data = $this->Home->find('first', array('conditions' => array('Home.id' => $approval_data['Approval']['level1']),'fields' => array('id','email_address','first_name', 'last_name')));
							
								// send mail to hr team
								$approval_data = $this->HrLeave->Home->find('all', array('fields' => array('id','email_address', 'first_name', 'last_name'),'group' => array('Home.id'), 'conditions'=> array('Home.hr_department_id' => '14', 'Home.status' => '1')));
								foreach($approval_data as $hr_data){
									if($superior_data['Home']['id'] != $hr_data['Home']['id'] && $hr_data['Home']['id'] != $this->Session->read('USER.Login.id')){
										$vars = array('from_name' => ucfirst($this->Session->read('USER.Login.first_name')).' '.ucfirst($this->Session->read('USER.Login.last_name')),'name' => $hr_data['Home']['first_name'].' '.$hr_data['Home']['last_name'], 'reason' => $this->request->data['HrLeave']['reason'], 'leave_from' => $this->request->data['HrLeave']['leave_from'], 'leave_to' => $this->request->data['HrLeave']['leave_to'], 'nodays' => $this->request->data['HrLeave']['no_days'], 'leave_type' => $this->get_leave_type($this->request->data['HrLeave']['hr_leave_type_id']), 'comp_off' => $comp_date);
										
										if(!$this->send_email('My PDCA - '.ucfirst($this->Session->read('USER.Login.first_name')).' '.ucfirst($this->Session->read('USER.Login.last_name')).' created leave request (No Action Required)!', 'leave_creation', 'noreply@mypdca.in', $hr_data['Home']['email_address'],$vars)){	
											// show the msg.								
											$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in sending the mail...', 'default', array('class' => 'alert alert-error'));				
										}else{
														
										}
									}
								}					
								
								// show the msg.
								$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Your leave request is created successfully', 'default', array('class' => 'alert alert-success'));
							}else{
								$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in saving approver status', 'default', array('class' => 'alert alert-info'));
							}
						}else if(empty($approval_data) && $this->Session->read('USER.Login.app_roles_id') == '18'){
						
							$this->HrLeave->id = $this->HrLeave->id;
							$this->HrLeave->saveField('is_approve', 'Y');
							$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Leave created and approved successfully', 'default', array('class' => 'alert alert-success'));

						}else{
							$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>You have no superior to approve your request', 'default', array('class' => 'alert alert-info'));

						}	
						
						$this->redirect('/hrleave/');	
						
					}else{
						// show the error msg.
						$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in saving the data...', 'default', array('class' => 'alert alert-error'));					
					}
				}
			}else{
				//echo 'validation failed';
				//print_r($this->HrLeave->validationErrors);
				$this->set('pl_error', $this->HrLeave->validationErrors['hr_leave_type_id'][0]);
			}
		}
	}
	
	/* function to check no. of days */
	public function check_no_days(){
		if(empty($this->request->data['HrLeave']['no_days']) || !intval($this->request->data['HrLeave']['no_days'])){
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>No. of days must be atleast one', 'default', array('class' => 'alert alert-error'));					
			return false;
		}else{
			return true;
		}
	}
	
	/* function to save comp off */
	public function save_comp_off($id){
		if($this->request->data['HrLeave']['hr_leave_type_id'] == '7'){ 
			$this->loadModel('HrLeaveComp');
			$this->request->data['HrLeaveComp']['hr_leave_id'] = $id;
			foreach($this->request->data['HrLeave']['comp_off_dates'] as $date){				
				$this->request->data['HrLeaveComp']['app_users_id'] = $this->Session->read('USER.Login.id');
				$this->request->data['HrLeaveComp']['created_date'] = $this->Functions->get_current_date();
				$this->request->data['HrLeaveComp']['comp_off'] = $date;
				$this->HrLeaveComp->create();
				if($this->HrLeaveComp->save($this->request->data['HrLeaveComp'], array('validate' => false))) {
					
				}
			}
		}
	}
	
	
	
	/* function to reset the half day session */
	public function resetHalf(){	
		if(empty($this->request->data['HrLeave']['is_half'])){
			unset($this->request->data['HrLeave']['session']);
		}
	}
	
	/* function to get leave type */
	public function get_leave_type($id){
		$data = $this->HrLeave->HrLeaveType->findById($id, array('fields' => 'desc'));
		return $data['HrLeaveType']['desc'];
		
	}
	
	/* function to check for duplicate entry */
	public function check_duplicate_status($leave_id, $app_user_id){
		$count = $this->HrLeave->HrLeaveStatus->find('count',  array('conditions' => array('HrLeaveStatus.hr_leave_id' => $leave_id, 'HrLeaveStatus.app_users_id' => $app_user_id)));
		if($count > 0){
			$this->invalid_attempt();
		}
		
	}
	
	
	
		
	/* function to auth record */
	public function auth_action($id){
		$data = $this->HrLeave->findById($id, array('fields' => 'app_users_id','is_deleted','modified_date'));	
		// check the req belongs to the user
		if($data['HrLeave']['is_deleted'] == 'Y'){
			return $data['HrLeave']['modified_date'];
		}		
		else if($data['HrLeave']['app_users_id'] == $this->Session->read('USER.Login.id')){	
			return 'pass';
		}else{
			return 'fail';
		}
	}
	
	/* function to view the adv. request */
	public function view_leave($id){
		// set the page title		
		$this->set('title_for_layout', 'View Leave - HRIS - My PDCA');
		if(!empty($id) && intval($id)){
			// authorize user before action
			$ret_value = $this->auth_action($id);
			if($ret_value == 'pass'){
				$this->HrLeave->bindModel(array('hasOne' => array('HrLeaveComp', 'HrCancelLeaveStatus')));
				$data = $this->HrLeave->findById($id, array('fields' => 'leave_from','HrLeave.id','HrCancelLeaveStatus.id','leave_to','no_days','reason','HrLeaveType.desc','group_concat(distinct HrLeaveComp.comp_off order by HrLeaveComp.comp_off asc) as compoff'));
				
				$this->set('leave_data', $data);
			}else if($ret_value == 'fail'){ 
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/hrleave/');	
			}else{
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Record Deleted: '.$ret_value , 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/hrleave/');	
			}
		}else{
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));		
			$this->redirect('/hrleave/');	
		}
		
		
	}
	
	/* function to activate pl */
	public function activate_pl(){
		$this->layout = 'iframe';
		if ($this->request->is('post')){ 
			$this->loadModel('HrPlReq');
			// validates the form
			$this->HrPlReq->set($this->request->data);
			// validate the request
			if($this->HrPlReq->validates(array('fieldList' => array('reason','date_to')))) {
				// format the dates to save			
				$this->request->data['HrPlReq']['date_from'] = $this->Functions->format_date_save($this->request->data['HrPlReq']['date_from']);
				$this->request->data['HrPlReq']['date_to'] = $this->Functions->format_date_save($this->request->data['HrPlReq']['date_to']);
				$this->request->data['HrPlReq']['created_date'] = $this->Functions->get_current_date();
				$this->request->data['HrPlReq']['app_users_id'] = $this->Session->read('USER.Login.id');
				// save the request
				if($this->HrPlReq->save($this->request->data['HrPlReq'], array('validate' => false))){
					$this->Session->setFlash('PL request sent for approval successfully. Once approved, you can add the PL Leave', 'default', array('class' => 'alert alert-success'));
					echo "<script>parent.$.colorbox.close()</script>";
					echo "<script>parent.location.reload();</script>";
				}
			}else{
				//print_r($this->HrPlReq->validationErrors);
			}
		}
				
	}
	
	/* clear the cache */
	
	public function beforeFilter() { 
		//$this->disable_cache();
		$this->show_tabs(25);
		$this->set('associateUSER', $this->Session->read('USER.Login.emp_type') == 'A' ? 1 : 0);

	}
	
		
		/* auto complete search 
	public function search(){ 
		$this->layout = false;	 
		$q = trim(Sanitize::escape($_GET['q']));	
		if(!empty($q)){
			// execute only when the search keywork has value		
			$this->set('keyword', $q);
			$data = $this->HrLeave->find('all', array('fields' => array('purpose'),  'group' => array('purpose','description'), 'conditions' => 	$conditions =  array("OR" => array ('purpose like' => '%'.$q.'%', 'description like' => '%'.$q.'%'), 'AND' => array('is_deleted' => 'N'))));		
			$this->set('results', $data);
		}
    }
	*/	
	
	
	
}