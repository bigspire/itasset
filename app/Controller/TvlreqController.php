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
class TvlreqController extends AppController {  
	
	public $name = 'TvlReq';	
	
	public $helpers = array('Html', 'Form', 'Session');
	
	public $components = array('Session', 'Functions');
	
	public $layout = 'apps';	

	/* function to list the adv. requests */
	public function index(){	
		// set the page title
		$this->set('title_for_layout', 'My Travel - Biz Tour - My PDCA');
		// when the form is submitted for search
		if($this->request->is('post')){
			$url_vars = $this->Functions->create_url(array('keyword'),'TvlReq'); 
			$this->redirect('/tvlreq/?'.$url_vars);			
		}
		if($this->params->query['keyword'] != ''){
			$keyCond = array("MATCH (tvl_code,TskCustomer.company_name,TvlPlace.place,purpose) AGAINST ('".$this->params->query['keyword']."' IN BOOLEAN MODE)"); 
		}	
		
		$options = array(			
			array('table' => 'tvl_req_status',
					'alias' => 'TvlReqStatuses',					
					'type' => 'LEFT',
					'conditions' => array('`TvlReqStatuses`.`tvl_request_id` = `TvlReq`.`id`', 'TvlReqStatuses.type' => 'N')
			),
			array('table' => 'app_users',
					'alias' => 'Homes',					
					'type' => 'LEFT',
					'conditions' => array('`TvlReqStatuses`.`app_users_id` = `Homes`.`id`')
			),
			array('table' => 'tvl_ticket_status',
					'alias' => 'TicketStatus',					
					'type' => 'LEFT',
					'conditions' => array('`TicketStatus`.`tvl_request_id` = `TvlReq`.`id`')
			)
		);
			
							
		$this->TvlReq->unBindModel(array('hasOne' => array('TvlReqStatus')));

		// fetch the advances		
		$this->paginate = array('fields' => array('id','purpose','tvl_dest_id','tvl_code','type','TvlPlace.place','start_date','TvlMode.mode','TskCustomer.company_name', 'created_date','group_concat(TvlReqStatuses.status) as st_status', 'group_concat(Homes.first_name) as st_user', 'group_concat(TvlReqStatuses.modified_date) as st_modified','group_concat(TvlReqStatuses.created_date) as st_created', 'group_concat(TvlReqStatuses.remarks) as st_remarks','TicketStatus.id'),'limit' => 10,'conditions' => array($keyCond,'TvlReq.app_users_id' => $this->Session->read('USER.Login.id'),'TvlReq.status' => 'A', 'TvlReq.is_deleted' => 'N'), 'order' => array('created_date' => 'desc'), 'group' => array('TvlReq.id'), 'joins' => $options);
		$data = $this->paginate('TvlReq');
		
		$this->set('tvl_data', $data);
		if(empty($data)){
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>You have no travel request found', 'default', array('class' => 'alert alert'));	
		}
		// clear req. session
		$this->clear_req_session();
		
	}
	
	public function clear_req_session(){
		$this->Session->write('STEP1', '');
		$this->Session->write('STEP2', '');
	}
	
	/* function to clear session in the steps */
	public function clear_step($step){
		$this->Session->write('STEP'.$step, '');
	}
	
	/* function to add new place */
	public function add_place(){
		$this->layout = 'iframe';
		if($this->request->is('post')){ 
			// validates the form
			$this->TvlReq->TvlPlace->set($this->request->data); 
			// save the data in session
			if ($this->TvlReq->TvlPlace->validates(array('fieldList' => array('place')))) {
				// save the place
				$this->request->data['TvlPlace']['created_date'] = $this->Functions->get_current_date();				
				$this->request->data['TvlPlace']['created_by'] = $this->Session->read('USER.Login.id');
				$this->request->data['TvlPlace']['status'] = 1;
				if($this->TvlReq->TvlPlace->save($this->request->data['TvlPlace'])){
					$this->set('refresh', 'refresh');
					$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>New Place added successfully', 'default', array('class' => 'alert alert-success'));
				}else{
					$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in adding the place', 'default', array('class' => 'alert alert-info'));
				}
			}
		}
				
	}
		
	/* function to save the advance */
	public function add_request($step){ 
		// set the page title		
		$this->set('title_for_layout', 'Add Travel Request - Biz Tour - My PDCA');
		switch($step){			
			case 'journey':
			$this->process_journey();
			break;
			case 'passenger':
			$this->process_passenger();
			break;
			case 'confirmation':
			$this->process_travel();
			break;
			default:
			$this->process_journey();
			$step = 'journey';
			break;
		}
		$this->render($step);
	}
	
	/* function to process journey */
	public function process_journey(){
		$this->set('travelType', $this->Functions->get_travel_type());
		$this->load_customers();
		$this->load_travel_mode();
		// load the places		
		$this->load_places(); 
		if($this->request->is('post')){ 
			// validates the form
			$this->TvlReq->set($this->request->data); 
			// retain travel mode options
			$this->load_travel_mode_option($this->request->data['TvlReq']['tvl_mode_id']);
			// format travel type
			$this->check_travel_type();	
			// save the data in session
			$this->save_travel_session(1);	
			if ($this->TvlReq->validates(array('fieldList' => array('type','purpose', 'tsk_company_id','tvl_mode_id','tvl_mode_option','tvl_dest_id','start_date','return_date','expected_outcome')))) {				
				// check form confirmation
				if($this->request->data['TvlReq']['confirm'] == 1){
					$this->redirect('/tvlreq/add_request/confirmation/');
				}else{
					$this->redirect('/tvlreq/add_request/passenger/');
				}
			}else{ 				
				$this->set('ERROR', $this->TvlReq->validationErrors);
			}
		}elseif($this->Session->read('STEP1.start_date') == ''){
			// when the form not submitted
			$this->load_travel_mode_option(2);
		}else{
			// when comes to back
			$this->load_travel_mode_option($this->Session->read('STEP1.tvl_mode_id'));
		}
	}
	
		/* auto complete search */	
	public function search_employee(){ 
		$this->layout = false;	 
		$q = trim(Sanitize::escape($_GET['q']));	
		if(!empty($q)){				
			$this->set('keyword', $q);
			$data = $this->TvlReq->HrEmployee->find('all', array('fields' => array('full_name'),  'group' => array('full_name'), 
			'conditions' => array('OR' => array ('full_name like' => '%'.$q.'%'), 'AND' => array('HrEmployee.is_deleted' => 'N', 'HrEmployee.status' => '1'))));		
			$this->set('results', $data);
		}
    }
	
	/* function to process the passenger details */
	public function process_passenger(){
		// check step 1 completed
		$this->check_step_complete(2);
		// set gender
		$this->set('gender', array('M' => 'Male', 'F' => 'Female'));
		// load the id types
		$this->load_tvl_id_types();
		// when the form posted
		if($this->request->is('post')){ 
			// validates the form
			$this->TvlReq->set($this->request->data); 
			// save the data in session
			$this->save_travel_session(2);	
			if ($this->TvlReq->validates(array('fieldList' => array('passenger','age', 'gender','id_type','id_no','mobile_no','email_id')))) {
				$this->redirect('/tvlreq/add_request/confirmation/');
			}
		}
		
	}
	
	/* function to process the confirmation */
	public function process_travel(){
		// check step 1 completed
		$this->check_step_complete(3);
		if($this->request->is('post')){ 
			// rewrite to form to save values
			$this->save_form_values(1);
			$this->save_form_values(2);
			$this->request->data['TvlReq']['app_users_id'] = $this->Session->read('USER.Login.id');
			// format the dates to save					
			$this->request->data['TvlReq']['start_date'] = $this->Functions->format_date_save($this->request->data['TvlReq']['start_date']);
			$this->request->data['TvlReq']['created_date'] = $this->Functions->get_current_date();
			// format the date and time fields
			$this->format_dates_save();		
			// save the data
			if($this->TvlReq->save($this->request->data['TvlReq'])){
				// generate travel code
				$this->gen_travel_code($this->TvlReq->id);
				// save travel req. class
				$this->save_req_class($this->TvlReq->id);
				// save passenger data
				$this->save_passenger($this->TvlReq->id);				
				// get the superiors
				$this->loadModel('Approval');
				$approval_data = $this->Approval->find('first', array('fields' => array('level1'), 'conditions'=> array('Approval.app_users_id' => $this->Session->read('USER.Login.id'), 'type' => 'T')));
				
				// save finance req. status data
				$this->loadModel('TvlReqStatus');
				$data = array('tvl_request_id' => $this->TvlReq->id, 'created_date' => $this->Functions->get_current_date(), 'app_users_id' => $approval_data['Approval']['level1']);
				if(!empty($approval_data)){
					/*
					$fp = fopen('test.txt', 'w+');
					fwrite($fp, print_r($approval_data, true));
					fclose($fp);
					*/
					// make sure not duplicate status exists
					$this->check_duplicate_status($this->TvlReq->id, $approval_data['Approval']['level1'], 'N');
					// save in adv. status table
					if($this->TvlReqStatus->save($data, true, $fieldList = array('tvl_request_id','created_date','app_users_id'))){						
						// save adv. users
						$this->loadModel('TvlReqUser');
						$adv_user_data = array('tvl_request_id' => $this->TvlReq->id, 'app_users_id' => $approval_data['Approval']['level1']);							
						$this->TvlReqUser->id = '';
						$this->TvlReqUser->save($adv_user_data, true, $fieldList = array('tvl_request_id','app_users_id'));						
						// send mail to travel desk team
						$this->notify_tvl_desk(1);						
						// show the msg.
						$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Your travel request is created successfully', 'default', array('class' => 'alert alert-success'));
					}else{
						$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in saving approver status', 'default', array('class' => 'alert alert-info'));
					}
				}else{
					$this->update_travel_req($this->TvlReq->id, 'Y');
					// send mail to travel desk team
					$this->notify_tvl_desk();
					$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>You have no superior to approve, so request sent to travel desk directly to book ticket(s)', 'default', array('class' => 'alert alert-success'));
				}					
				$this->redirect('/tvlreq/');
			}else{
				// show the error msg.
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in saving the data...', 'default', array('class' => 'alert alert-error'));					
			}		
		}
	}
	
	/* function to notify travel team */
	public function notify_tvl_desk($approver, $cancel){
		if($cancel == 1){
			$action  = 'cancelled';
			$mail_action = 'cancel';
		}else{
			$action  = 'created';
			
		}
		
		// action req or not.
		if(empty($approver)){
			$sub_action = '';
		}else{
			$sub_action = '(No Action Required)';
		}			
		
		$approval_data = $this->TvlReq->HrEmployee->find('all', array('fields' => array('id','email_address', 'first_name', 'last_name'), 'conditions'=> array('HrEmployee.app_roles_id' => '19', 'HrEmployee.status' => '1', 'HrEmployee.is_deleted' => 'N'), 'group' => array('HrEmployee.id')));
		foreach($approval_data as $tvl_data){
			if($superior_data['HrEmployee']['id'] != $tvl_data['HrEmployee']['id']){
				if(empty($this->request->data['TvlReq']['purpose'])){
					// get tvl mode class
					$this->loadModel('TvlReqClass');
					$mode_options = $this->TvlReqClass->find('all', array('fields' => array('tvl_mode_option_id'), 'conditions' => array('tvl_request_id' => $this->request->data['tvlID'])));
					$req_data = $this->TvlReq->findById($this->request->data['tvlID'], array('fields' => 'type','tvl_mode_id','tvl_dest_id','tsk_company_id','purpose','start_date','return_date'));
					$vars = array('from_name' => ucfirst($this->Session->read('USER.Login.first_name')).' '.ucfirst($this->Session->read('USER.Login.last_name')),'name' => $tvl_data['HrEmployee']['first_name'].' '.$tvl_data['HrEmployee']['last_name'],'purpose' => $req_data['TvlReq']['purpose'], 'start_date' => $req_data['TvlReq']['start_date'], 'return_date' => $req_data['TvlReq']['return_date'],
					'type' => $req_data['TvlReq']['type'], 'mode' => $this->get_travel_mode($req_data['TvlReq']['tvl_mode_id']), 'action' => $mail_action,
					'place' => $this->get_travel_place($req_data['TvlReq']['tvl_dest_id']),'reason' => $this->request->query['remark'], 'client' => $this->get_customer_name($req_data['TvlReq']['tsk_company_id']), 'class' => $this->get_travel_option2($mode_options));
				}else{
					$vars = array('from_name' => ucfirst($this->Session->read('USER.Login.first_name')).' '.ucfirst($this->Session->read('USER.Login.last_name')),'name' => $tvl_data['HrEmployee']['first_name'].' '.$tvl_data['HrEmployee']['last_name'],'purpose' => $this->request->data['TvlReq']['purpose'], 'start_date' => $this->request->data['TvlReq']['start_date'], 'return_date' => $this->request->data['TvlReq']['return_date'],
					'type' => $this->request->data['TvlReq']['type'], 'mode' => $this->get_travel_mode($this->request->data['TvlReq']['tvl_mode_id']), 'action' => $mail_action,
					'place' => $this->get_travel_place($this->request->data['TvlReq']['tvl_dest_id']),'client' => $this->get_customer_name($this->request->data['TvlReq']['tsk_company_id']), 'class' => $this->get_travel_option($this->request->data['TvlReq']['tvl_mode_option']));
				}
				// notify superiors						
				if(!$this->send_email('My PDCA - '.ucfirst($this->Session->read('USER.Login.first_name')).' '.ucfirst($this->Session->read('USER.Login.last_name'))." $action travel request $sub_action!", 'travel_creation', 'noreply@mypdca.in', $tvl_data['HrEmployee']['email_address'],$vars)){	
					// show the msg.								
					$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in sending the mail...', 'default', array('class' => 'alert alert-error'));				
				}else{
													
				}
			}
		}
	}
	/* function to check the prev. steps are done */
	public function check_step_complete($step){
		if($step == 2){
			if($this->Session->read('STEP1.start_date') == ''){
				$this->redirect('/tvlreq/add_request/journey/');
			}
		}elseif($step == 3){
			if($this->Session->read('STEP2.passenger') == ''){
				$this->redirect('/tvlreq/add_request/passenger/');
			}
		}
			
	}
	
	
	/* function to save id proof of the passenger */
	public function save_person_proof($id, $person, $id_type, $id_no){
		// get the employee
		$this->TvlReq->HrEmployee->unBindModel(array('belongsTo' => array('HrDepartment','HrDesignation','Role','HrCompany','HrGrade','HrBusinessUnit','HrBloodGroup','HrBranch')));
		$this->TvlReq->HrEmployee->unBindModel(array('hasOne' => array('HrEducation','HrExperience','HrFamily')));
		$data = $this->TvlReq->HrEmployee->find('all', array('fields' => array('HrEmployee.id'), 'conditions' => array("lower(concat(trim(first_name),' ', trim(last_name)))" => strtolower(trim($person)))));
		// check already exists
		$this->loadModel('TvlEmpId');
		$count = $this->TvlEmpId->find('count', array('conditions' => array('app_users_id' => $data[0]['HrEmployee']['id'], 'id_no' => $id_no, 'tvl_id_type_id' => $id_type)));
		// if id not exists save id
		if($count == 0 && !empty($data)){
			$data = array('app_users_id' => $data[0]['HrEmployee']['id'], 'id_no' => $id_no, 'tvl_id_type_id' => $id_type, 'created_date' => $this->Functions->get_current_date());
			$this->TvlEmpId->save($data);
		}
	}
	
	/* function to save request class */
	public function save_req_class($id){
		$this->loadModel('TvlReqClass');
		foreach($this->Session->read('STEP1.tvl_mode_option') as $class){
			$this->TvlReqClass->id = '';
			$data = array('created_date' => $this->Functions->get_current_date(), 'tvl_request_id' => $id, 'tvl_mode_option_id' => $class);
			$this->TvlReqClass->save($data);
		}
	}
	
	/* function to save the passenger details */
	public function save_passenger($id){
		$this->loadModel('TvlPassenger');
		$this->TvlReq->id = $id;
		$data = array('tvl_request_id' => $id, 'passenger' => $this->Session->read('STEP2.passenger'), 'gender' => $this->Session->read('STEP2.gender'), 'age' => $this->Session->read('STEP2.age'), 'mobile' => $this->Session->read('STEP2.mobile_no'),
		'email_id' => $this->Session->read('STEP2.email_id'), 'id_no' => $this->Session->read('STEP2.id_no'), 'tvl_id_type_id' => $this->Session->read('STEP2.id_type'),'created_date' => $this->Functions->get_current_date());
		$this->TvlPassenger->save($data);
		// save passenger id
		$this->save_person_proof($id, $this->Session->read('STEP2.passenger'), $this->Session->read('STEP2.id_type'),$this->Session->read('STEP2.id_no'));
		// save dynamic passengers
		for($i = 0; $i < $this->Session->read('STEP2.rec_count'); $i++){
			if($this->Session->read('STEP2.passenger'.$i) != ''){
				$this->TvlPassenger->id = '';
				$data = array('tvl_request_id' => $id, 'passenger' => $this->Session->read('STEP2.passenger'.$i), 'gender' => $this->Session->read('STEP2.gender'.$i), 'age' => $this->Session->read('STEP2.age'.$i), 'mobile' => $this->Session->read('STEP2.mobile'.$i),
				'email_id' => $this->Session->read('STEP2.email_id'.$i), 'id_no' => $this->Session->read('STEP2.id_no'.$i), 'tvl_id_type_id' => $this->Session->read('STEP2.id_type'.$i),'created_date' => $this->Functions->get_current_date());
				$this->TvlPassenger->save($data);
				// save passenger id
				$this->save_person_proof($id, $this->Session->read('STEP2.passenger'.$i), $this->Session->read('STEP2.id_type'.$i),$this->Session->read('STEP2.id_no'.$i));
		
			}
		}
		// save dynamic passengers
		for($i = 0; $i < $this->Session->read('STEP2.form_count'); $i++){
			if($this->Session->read('STEP2.employee_'.$i) != ''){
				$this->TvlPassenger->id = '';
				$data = array('tvl_request_id' => $id, 'passenger' => $this->Session->read('STEP2.employee_'.$i), 'gender' => $this->Session->read('STEP2.gender_'.$i), 'age' => $this->Session->read('STEP2.age_'.$i), 'mobile' => $this->Session->read('STEP2.mobile_'.$i),
				'email_id' => $this->Session->read('STEP2.email_'.$i), 'id_no' => $this->Session->read('STEP2.id_no_'.$i), 'tvl_id_type_id' => $this->Session->read('STEP2.id_type_'.$i),'created_date' => $this->Functions->get_current_date());
				$this->TvlPassenger->save($data);
				// save passenger id
				$this->save_person_proof($id, $this->Session->read('STEP2.employee_'.$i), $this->Session->read('STEP2.id_type_'.$i),$this->Session->read('STEP2.id_no_'.$i));
			}
		}
		
	}
	
		

	/* function to generate travel req. id */
	public function gen_travel_code($id){
		$this->TvlReq->id = $id;
		$this->TvlReq->saveField('tvl_code', 'TVL'.str_pad($id, 3, 0, STR_PAD_LEFT));
	}
	
	/* function to approve the travel req. */
	public function update_travel_req($id, $status){
		$this->TvlReq->id = $id;
		$this->TvlReq->saveField('is_approve', 'Y');
		
	}
	
	/* function to check for duplicate entry */
	public function check_duplicate_status($tvl_id, $app_user_id, $type){
		$count = $this->TvlReq->TvlReqStatus->find('count',  array('conditions' => array('TvlReqStatus.type' => $type, 'TvlReqStatus.tvl_request_id' => $tvl_id, 'TvlReqStatus.app_users_id' => $app_user_id)));
		if($count > 0){
			$this->invalid_attempt();
		}
		
	}
	
	/* function to save session to form */
	public function save_form_values($step){
		foreach($this->Session->read('STEP'.$step) as $key =>  $form){
			$this->request->data['TvlReq'][$key] = $this->Session->read('STEP'.$step.'.'.$key);
		}
	}
	
	/* function to load the travel id types */
	public function load_tvl_id_types(){
		$this->loadModel('TvlIdType');
		$id_list = $this->TvlIdType->find('list', array('fields' => array('id','title'), 'order' => array('id ASC'),'conditions' => array('is_deleted' => 'N', 'status' => '1')));
		$this->set('idList', $id_list);
	}
	
	/* function to save the form fields in session */
	public function save_travel_session($step){ 
		// clear the step before save
		$this->clear_step($step);
		foreach($this->request->data['TvlReq'] as $key => $form){ 			
			// check for value
			if(!empty($this->request->data['TvlReq'][$key])){
				$this->Session->write('STEP'.$step.'.'.$key, $form);
			}else{ 
				$this->Session->write('STEP'.$step.'.'.$key, '');
			}
			
			// for company name
			if($key == 'tsk_company_id'){
				$this->Session->write('STEP1.customer', $this->get_customer_name($this->Session->read('STEP'.$step.'.'.$key)));
			}			
			// for debit to
			if($key == 'debit_to'){
				$this->Session->write('STEP1.debit_customer', $this->get_debit_customer_name($this->Session->read('STEP'.$step.'.'.$key)));
			}
			// get travel mode
			if($key == 'tvl_mode_id'){
				$this->Session->write('STEP1.tvl_mode', $this->get_travel_mode($this->Session->read('STEP'.$step.'.'.$key)));
			}
			// get travel mode
			if($key == 'tvl_mode_option'){
				$this->Session->write('STEP1.tvl_class', $this->get_travel_option($this->Session->read('STEP'.$step.'.'.$key)));
			}
			// get start place and dest. place
			if($key == 'tvl_dest_id' || $key == 'tvl_depart_id'){
				$this->Session->write('STEP1.'.$key.'_place', $this->get_travel_place($this->Session->read('STEP'.$step.'.'.$key)));
			}
			// get travel mode
			if($key == 'id_type' || strstr($key, 'id_type')){ 
				$this->Session->write('STEP2.'.$key.'_idtype', $this->get_emp_idproof($this->Session->read('STEP'.$step.'.'.$key)));
			}
			
			
		}
		
	}
	
	/* function to get the emp. details */
	public function get_emp_data(){
		$this->layout = 'refresh';
		if(!empty($this->request->query['emp'])){
			$this->TvlReq->HrEmployee->unBindModel(array('belongsTo' => array('HrDepartment','HrDesignation','Role','HrCompany','HrGrade','HrBusinessUnit','HrBloodGroup','HrBranch')));
			$this->TvlReq->HrEmployee->unBindModel(array('hasOne' => array('HrEducation','HrExperience','HrFamily')));
			// bind employee id proof
			$this->TvlReq->HrEmployee->bindModel(array('hasOne' => array('TvlEmpId')));
			$this->TvlReq->HrEmployee->bindModel(
				array('hasOne' => array(
						'TvlEmpId' => array(
							'className' => 'TvlEmpId',
							'foreignKey' => 'app_users_id'
						)
					)
				)
			);	
			$data = $this->TvlReq->HrEmployee->find('all', array('fields' => array('gender','dob','official_contact_no','email_address','TvlEmpId.id_no','TvlEmpId.tvl_id_type_id'), 'conditions' => array("lower(concat(trim(first_name),' ', trim(last_name)))" => strtolower(trim($this->request->query['emp']))),
			'order' => array('TvlEmpId.created_date' => 'desc')));
			echo $data[0]['HrEmployee']['gender'].'||'.$this->Functions->get_age($data[0]['HrEmployee']['dob']).'||'.$data[0]['HrEmployee']['official_contact_no'].'||'.$data[0]['HrEmployee']['email_address'].'||'.$data[0]['TvlEmpId']['id_no'].'||'.$data[0]['TvlEmpId']['tvl_id_type_id'];
		}
		$this->render(false);
	}
	
	/* function to format the fields for travel type */
	public function check_travel_type(){
		if($this->request->data['TvlReq']['type'] == '1'){			
			$this->request->data['TvlReq']['return_date'] = '';
			$this->request->data['TvlReq']['desire_return_depart_from'] = '';
			$this->request->data['TvlReq']['desire_return_depart_to'] = '';
			$this->request->data['TvlReq']['desire_return_arrival_from'] = '';
			$this->request->data['TvlReq']['desire_return_arrival_to'] = '';		
		}
	}
	
	/* function to format date fields */
	public function format_dates_save(){
		if($this->request->data['TvlReq']['type'] == '1'){			
			$this->request->data['TvlReq']['desire_depart_from'] = $this->Functions->format_time_save($this->request->data['TvlReq']['desire_depart_from']);
			$this->request->data['TvlReq']['desire_depart_to'] = $this->Functions->format_time_save($this->request->data['TvlReq']['desire_depart_to']);
			$this->request->data['TvlReq']['desire_arrival_from'] = $this->Functions->format_time_save($this->request->data['TvlReq']['desire_arrival_from']);
			$this->request->data['TvlReq']['desire_arrival_to'] = $this->Functions->format_time_save($this->request->data['TvlReq']['desire_arrival_to']);					
		}else{			
			$this->request->data['TvlReq']['return_date'] = $this->Functions->format_date_save($this->request->data['TvlReq']['return_date']);
			$this->request->data['TvlReq']['desire_return_depart_from'] = $this->Functions->format_time_save($this->request->data['TvlReq']['desire_return_depart_from']);
			$this->request->data['TvlReq']['desire_return_depart_to'] = $this->Functions->format_time_save($this->request->data['TvlReq']['desire_return_depart_to']);
			$this->request->data['TvlReq']['desire_return_arrival_from'] = $this->Functions->format_time_save($this->request->data['TvlReq']['desire_return_arrival_from']);
			$this->request->data['TvlReq']['desire_return_arrival_to'] = $this->Functions->format_time_save($this->request->data['TvlReq']['desire_return_arrival_to']);			
		}
	}
	
	
	/* function to load the places */
	public function load_places(){
		$this->loadModel('TvlPlace');
		$place_list = $this->TvlPlace->find('list', array('fields' => array('id','place'), 'order' => array('place ASC'),'conditions' => array('is_deleted' => 'N', 'status' => '1')));
		$this->set('placeList', $place_list);
	}
	
	
	
	/* function to get travel class */
	public function get_travel_option($values){
		$this->loadModel('TvlModeOption');
		$comma = ', ';
		$tot = count($values);
		foreach($values as $key => $id){
			$data = $this->TvlModeOption->findById($id, array('fields' => 'title'));			
			if(++$key >= $tot){ 
				$comma = '';
			} 
			$class .= $data['TvlModeOption']['title'].$comma;
			
		}
		return $class;
	}
	
	/* function to get travel mode */
	public function get_travel_mode($id){
		$data = $this->TvlReq->TvlMode->findById($id, array('fields' => 'mode'));
		return $data['TvlMode']['mode'];
	}
	
	/* function to get employee id proof */
	public function get_emp_idproof($id){
		$this->loadModel('TvlIdType');
		$data = $this->TvlIdType->findById($id, array('fields' => 'title'));
		return $data['TvlIdType']['title'];
	}
	
	
	/* function to get travel place */
	public function get_travel_place($id){
		$this->loadModel('TvlPlace');
		$data = $this->TvlPlace->findById($id, array('fields' => 'place'));
		return $data['TvlPlace']['place'];
	}
	
	/* function to get customer name */
	public function get_customer_name($id){
		$comp = $this->TvlReq->TskCustomer->findById($id, array('fields' => 'company_name'));
		return $comp['TskCustomer']['company_name'];
	}
	
	/* function to get debit customer name */
	public function get_debit_customer_name($id){
		if($this->Session->read('STEP1.debit_same') == 'Y'){
			$this->Session->write('STEP1.debit_to', $this->Session->read('STEP1.tsk_company_id'));
			return $this->Session->read('STEP1.customer');
		}else{		
			$comp = $this->TvlReq->TskCustomer->findById($id, array('fields' => 'company_name'));
			return $comp['TskCustomer']['company_name'];
		}
	}
	
	/* function to load the mode options */
	public function get_mode_option(){
		$this->layout = 'refresh';		
		$id = $this->request->query['id'];
		$this->loadModel('TvlModeOption');
		$data = $this->TvlModeOption->find('all', array('fields' => array('id','title'), 'conditions' => array('is_deleted' => 'N', 'tvl_mode_id' => $id, 'status' => '1'), 'order' => array('id' => 'asc')));		
		foreach($data as $option){ 
			$options .= "<option value=".$option['TvlModeOption']['id'].">".$option['TvlModeOption']['title']."</option>";
		}	
		echo $options;
		$this->render(false);
		die;
	}
	
	/* function to load the customer details */
	public function load_customers(){
		$comp_list = $this->TvlReq->TskCustomer->find('list', array('fields' => array('id','company_name'), 'order' => array('company_name ASC'),'conditions' => array('is_deleted' => 'N', 'status' => '1')));
		$this->set('compList', $comp_list);
	}
	
	/* function to load travel mode */
	public function load_travel_mode(){
		$mode_list = $this->TvlReq->TvlMode->find('list', array('fields' => array('id','mode'), 'order' => array('priority ASC'),'conditions' => array('is_deleted' => 'N', 'status' => '1')));
		$this->set('modeList', $mode_list);
	}
	
	/* function to load travel mode */
	public function load_travel_mode_option($id){ 
		$this->loadModel('TvlModeOption');
		$data = $this->TvlModeOption->find('list', array('fields' => array('id','title'), 'conditions' => array('is_deleted' => 'N', 'tvl_mode_id' => $id, 'status' => '1'), 'order' => array('id' => 'asc')));			
		$this->set('modeOption', $data);
	}
	
	
	
	/* function to auth record */
	public function auth_action($id){
		$data = $this->TvlReq->findById($id, array('fields' => 'app_users_id','is_deleted'));	
		// check the req belongs to the user
		if($data['TvlReq']['is_deleted'] == 'Y'){
			return ;
		}		
		else if($data['TvlReq']['app_users_id'] == $this->Session->read('USER.Login.id')){	
			return 'pass';
		}else{
			return 'fail';
		}
	}
	
	/* function to view the adv. request */
	public function view_request($id){
		// set the page title		
		$this->set('title_for_layout', 'View Travel - Biz Tour - My PDCA');
		if(!empty($id) && intval($id)){
			// authorize user before action
			$ret_value = $this->auth_action($id);
			if($ret_value == 'pass'){	
				$this->TvlReq->bindModel(
					array('belongsTo' => array(
							'TvlStart' => array(
								'className' => 'TvlPlace',
								'foreignKey' => 'tvl_depart_id'
							),
							'TvlDebit' => array(
								'className' => 'TskCustomer',
								'foreignKey' => 'debit_to'
							)
						),
						'hasOne' => array(
							'TvlCancel' => array(
								'className' => 'TvlCancel',
								'foreignKey' => 'tvl_request_id'
							)
						)
					)
					
				);
				$data = $this->TvlReq->findById($id, array('fields' => 'id','purpose','TskCustomer.company_name','start_date','return_date','expected_outcome',
				'spl_particular','desire_depart_to','desire_depart_from','TvlCancel.id','desire_arrival_from','desire_arrival_to','desire_return_arrival_from','desire_return_arrival_to','desire_return_depart_from','desire_return_depart_to','TvlMode.mode',
				'TvlPlace.place','tvl_code','type', 'TvlStart.place','is_approve','TvlDebit.company_name'));
				$this->set('tvl_data', $data);
				// get passenger details
				$this->loadModel('TvlPassenger');
				$data = $this->TvlPassenger->find('all', array('conditions' => array('tvl_request_id' => $id)));
				$this->set('tvl_person', $data);
				// get travel mode options
				$this->loadModel('TvlReqClass');
				$data = $this->TvlReqClass->find('all', array('fields' => array('group_concat(TvlModeOption.title) tvl_req_class'), 'conditions' => array('TvlReqClass.tvl_request_id' => $id)));
				$this->set('tvl_class_data', $data);
				// load tvl remarks
				$this->get_tvl_remarks($id);				
			}else if($ret_value == 'fail'){ 
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/tvlreq/');	
			}else{
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Record Deleted: '.$ret_value , 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/tvlreq/');	
			}
		}else{
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));		
			$this->redirect('/tvlreq/');	
		}
		
	}
	
	
	/* function to get travel remarks */
	public function get_tvl_remarks($id){ 
		// get remarks	
		$this->TvlReq->TvlReqStatus->bindModel(
			array('belongsTo' => array(
					'HrEmployee' => array(
						'className' => 'HrEmployee',
						'foreignKey' => 'app_users_id',
						
					)
				)
			)
		);
		$remarks = $this->TvlReq->TvlReqStatus->find('all', array('fields' => array('HrEmployee.first_name','HrEmployee.last_name', 
		'modified_date','remarks', 'HrEmployee.photo_status', 'HrEmployee.photo'), 'conditions' => array('tvl_request_id' => $id, 'TvlReqStatus.type' => 'N'),'order' => array('TvlReqStatus.id' => 'desc'),
		'group' => array('TvlReqStatus.id'))); 	
		$this->set('lead_remarks', $remarks);
	}
	
	/* function to cancel the travel */
	public function cancel_travel(){
		if($this->request->is('post')){
			$this->loadModel('TvlCancel');
			$data = array('created_date' => $this->Functions->get_current_date(), 'app_users_id' => $this->Session->read('USER.Login.id'), 'reason' => $this->request->query['remark'], 'tvl_request_id' => $this->request->data['tvlID']);
			// save the cancel req status
			if($this->TvlCancel->save($data)){
				$id = $this->request->data['tvlID'];
				// get the superiors
				$this->loadModel('Approval');
				$approval_data = $this->Approval->find('first', array('fields' => array('level1'), 'conditions'=> array('Approval.app_users_id' => $this->Session->read('USER.Login.id'), 'type' => 'T')));
				// save finance req. status data
				$this->loadModel('TvlReqStatus');
				$data = array('tvl_request_id' => $id, 'type' => 'C', 'created_date' => $this->Functions->get_current_date(), 'app_users_id' => $approval_data['Approval']['level1']);
				if(!empty($approval_data)){
					// make sure not duplicate status exists
					$this->check_duplicate_status($id, $approval_data['Approval']['level1'], 'C');
					// save in adv. status table
					if($this->TvlReqStatus->save($data, true, $fieldList = array('tvl_request_id','created_date','app_users_id', 'type'))){						
						// save adv. users
						$this->loadModel('TvlReqUser');
						$user_data = array('tvl_request_id' => $id, 'type' => 'C', 'app_users_id' => $approval_data['Approval']['level1']);							
						$this->TvlReqUser->id = '';
						$this->TvlReqUser->save($user_data, true, $fieldList = array('tvl_request_id','app_users_id', 'type'));					
						// get approver email id
						
						/*
						$superior_data = $this->TvlReq->HrEmployee->find('first', array('conditions' => array('HrEmployee.id' => $approval_data['Approval']['level1']),'fields' => array('HrEmployee.id','email_address','first_name', 'last_name')));
						$vars = array('from_name' => ucfirst($this->Session->read('USER.Login.first_name')).' '.ucfirst($this->Session->read('USER.Login.last_name')),'name' => $superior_data['HrEmployee']['first_name'].' '.$superior_data['HrEmployee']['last_name'],
						'purpose' => $this->request->data['TvlReq']['purpose'], 'start_date' => $this->request->data['TvlReq']['start_date'], 'return_date' => $this->request->data['TvlReq']['return_date'], 'action' => 'cancel',
						'type' => $this->request->data['TvlReq']['type'], 'mode' => $this->get_travel_mode($this->request->data['TvlReq']['tvl_mode_id']),
						'place' => $this->get_travel_place($this->request->data['TvlReq']['tvl_dest_id']),'client' => $this->get_customer_name($this->request->data['TvlReq']['tsk_company_id']), 'class' => $this->get_travel_option($this->request->data['TvlReq']['tvl_mode_option']));
						// notify superiors						
						if(!$this->send_email('My PDCA - '.ucfirst($this->Session->read('USER.Login.first_name')).' '.ucfirst($this->Session->read('USER.Login.last_name')).' cancelled travel request!', 'travel_creation', 'noreply@mypdca.in', $superior_data['HrEmployee']['email_address'],$vars)){		
							// show the msg.								
							$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in sending the mail...', 'default', array('class' => 'alert alert-error'));				
						}else{								
						}*/
						
						
						// send mail to travel desk team
						$this->notify_tvl_desk(1, 1);
						$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Travel cancel request created successfully', 'default', array('class' => 'alert alert-success'));
					}
				}else{
					$this->TvlReq->id = $id;
					$this->TvlReq->saveField('status', 'C');
					$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Travel cancel request created successfully', 'default', array('class' => 'alert alert-success'));
				}				
			}else{
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Problem in cancelling travel. pls contact admin', 'default', array('class' => 'alert alert-error'));		
			}
			$this->redirect('/tvlcanreq/');	
		}
		
	}
	
	
	/* function to get travel class */
	public function get_travel_option2($values){
		$this->loadModel('TvlModeOption');
		$comma = ', ';
		$tot = count($values);
		$i = 0;
		foreach($values as $key => $id){
			$data = $this->TvlModeOption->findById($id['TvlReqClass']['tvl_mode_option_id'], array('fields' => 'title'));			
			if($i >= ($tot-1)){ 
				$comma = '';
			} 
			$class .= $data['TvlModeOption']['title'].$comma;
			$i++;
			
		}
		return $class;
	}
	
	/* function to view note */
	public function view_note($id){
		$this->layout = 'iframe';		
		$type = $this->check_ticket_type();	
		$this->TvlReq->bindModel(
						array('hasOne' => array(
								'TvlTicketStatus' => array(
									'className' => 'TvlTicketStatus',
									'foreignKey' => 'tvl_request_id'
								)
							)
						)
					);
		$data = $this->TvlReq->TvlTicketStatus->find('all', array('fields' => array('TvlTicketStatus.avail','TvlTicketStatus.book_mode','TvlTicketStatus.issue_date','TvlTicketStatus.remark','TvlTicketStatus.suggestion',
		'TvlMode.mode'), 'conditions' => array('TvlTicketStatus.tkt_type' => $type, 'TvlTicketStatus.tvl_request_id' => $id)));
		$this->set('ticket_update', $data[0]);
		if(empty($data)){
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Sorry, Ticket status is not available', 'default', array('class' => 'alert alert-info'));				

		}
	}
	
	/* function to check the ticket type */
	public function check_ticket_type(){
		if($this->request->query['action'] == 'return'){
			$type = 'R';
		}else{
			$type = 'O';
		}
		return $type;		
	}
	
	/* clear the cache */	
	public function beforeFilter() { 
		//$this->disable_cache();
		$this->show_tabs(69);		
	}
	
		
		/* auto complete search */	
	public function search(){ 
		$this->layout = false;	 
		$q = trim(Sanitize::escape($_GET['q']));	
		if(!empty($q)){
			// execute only when the search keywork has value		
			$this->set('keyword', $q);
			$data = $this->TvlReq->find('all', array('fields' => array('tvl_code','TskCustomer.company_name','TvlPlace.place'),  'group' => array('tvl_code','TskCustomer.company_name','TvlPlace.place'), 'conditions' => 	$conditions =  array("OR" => array ('tvl_code like' => '%'.$q.'%',
			'TskCustomer.company_name like' => '%'.$q.'%', 'TvlPlace.place like' => '%'.$q.'%'), 'AND' => array('TvlReq.is_deleted' => 'N', 'TvlReq.status' => 'A', 'TvlReq.app_users_id' => $this->Session->read('USER.Login.id')))));		
			$this->set('results', $data);
		}
    }
	
	
	
	
}