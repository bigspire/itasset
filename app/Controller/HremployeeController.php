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
 
class HrEmployeeController extends AppController {  
	
	public $name = 'HrEmployee';	
	
	public $helpers = array('Html', 'Form', 'Session');
	
	public $components = array('Session', 'Functions', 'Excel');
	
	public $layout = 'apps';	

	/* function to list the adv. requests */
	public function index(){
		// set the page title
		$this->set('title_for_layout', 'Employee - HRIS - My PDCA');
		$this->set('emp_types', array('R' => 'Regular','A' => 'Associate 1', 'A2' => 'Associate 2'));
		// for export
		if($this->request->query['action'] == 'export'){
			$data = $this->HrEmployee->find('all', array('fields' => array('first_name', 'last_name','email_address','HrDepartment.dept_name','HrDesignation.desig_name', 'HrBusinessUnit.business_unit','gender', 'HrDesignation.desig_name','emp_no', 'dob','Role.role_name','HrBranch.branch_name','personal_email','official_contact_no','contact_no','permanent_addr','communication_addr','marital_status','wedding_date','landline','HrBloodGroup.blood_group','doj','doc','pan','insurance_no','pf_no','esi_no','emergency_contact_person','emergency_contact_no','emergency_relation','skype'),'conditions' => array('HrEmployee.is_deleted' => 'N', 'HrEmployee.status' => '1'), 
			'order' => array('first_name' => 'asc'), 'group' => array('HrEmployee.id')));
			$this->Excel->generate('employee', $data, $data, 'Report', 'Employee Report');
		}
		
		// when the form is submitted for search
		if($this->request->is('post')){
			$url_vars = $this->Functions->create_url(array('keyword','status','rec_status','emp_type'),'HrEmployee'); 
			$this->redirect('/hremployee/?'.$url_vars);			
		}
		if($this->params->query['keyword'] != ''){
			$keyCond = array("MATCH (first_name,last_name, HrDepartment.dept_name,HrDesignation.desig_name) AGAINST ('".$this->params->query['keyword']."' IN BOOLEAN MODE)"); 
		}
		if($this->params->query['status'] != ''){
			$stCond = array('HrEmployee.photo_status' => $this->params->query['status']); 
		}
		if($this->params->query['emp_type'] != ''){
			$typeCond = array('HrEmployee.emp_type' => $this->params->query['emp_type']); 
		}
		// record status
		$recCond = array('HrEmployee.status' => '1'); 
		if($this->params->query['rec_status'] != ''){
			$rec_st = $this->params->query['rec_status'] == 2 ? 0 : 1;
			$recCond = array('HrEmployee.status' => $rec_st); 
		}
		// fetch the advances		
		$this->paginate = array('fields' => array('id','first_name', 'emp_no','last_name','email_address','HrDepartment.dept_name','HrDesignation.desig_name','photo_status', 'photo','status','created_date','doj','probation','doc','emp_type','Role.role_name'),'limit' => 50,'conditions' => array($keyCond,$stCond,$recCond,$typeCond, 'HrEmployee.is_deleted' => 'N'), 'order' => array('first_name' => 'asc'), 'group' => array('HrEmployee.id'));
		$data = $this->paginate('HrEmployee');			
		$this->set('emp_data', $data);
		if(empty($data)){
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>You have no employee', 'default', array('class' => 'alert alert'));	
		}
		
		// clear the create emp. session
		$this->clear_emp_session();
		
		
		// update pl details
		/* 
		if($this->Session->read('USER.Login.id') == 54){
			$this->loadModel('HrEmployee');
			$data = $this->HrEmployee->find('all', array('fields' => array('id', 'HrEmployee.first_name'), 'conditions' => array('HrEmployee.status' => 1, 'HrEmployee.is_deleted' => 'N', 'HrEmployee.emp_type' => 'R',
			'HrEmployee.id !=' =>  array('76','66','71')), 'group' => array('HrEmployee.id')));
			$this->loadModel('HrLeaveDetail');
			foreach($data as $rec){
				$data2 = array('app_users_id' => $rec['HrEmployee']['id'], 'pl_bal' => '15', 'nbl_bal' => '0',  'created_date' => $this->Functions->get_current_date(), 'created_by' => '54',
				'year' => '2016');
				$this->HrLeaveDetail->save($data2, false);
				$this->HrLeaveDetail->id = '';
			}
			die;
			
		}
		*/
		// update notification for latest updates
		/* if($this->Session->read('USER.Login.id') == 54){
			$this->loadModel('HrEmployee');
			$data = $this->HrEmployee->find('all', array('fields' => array('id'), 'conditions' => array('HrEmployee.status' => 1, 'HrEmployee.is_deleted' => 'N'), 'group' => array('HrEmployee.id')));
			$this->loadModel('Notification');
			foreach($data as $rec){
				$data2 = array('notify' => 'R', 'modified_date' => $this->Functions->get_current_date(),  'created_date' => $this->Functions->get_current_date(), 'app_users_id' => $rec['HrEmployee']['id']);
				$this->Notification->save($data2, false);
				$this->Notification->id = '';
			}
			die;
		}
		*/
		
	}
	
	/* function to clear employee session */
	public function clear_emp_session(){
		$this->Session->write('personal', '');
		$this->Session->write('education', '');
		$this->Session->write('family', '');
		$this->Session->write('experience', '');
		$this->Session->write('reg.step1', '');
		$this->Session->write('reg.step2', '');
		$this->Session->write('reg.step3', '');
		$this->Session->write('reg.step4', '');
	}
	
	/* function to save the customer */
	public function create_employee($type){ 
		// set the page title		
		$this->set('title_for_layout', 'Create Employee - HRIS - My PDCA');	
		// load static models
		$this->load_static_tables();
		$this->set_year_passing();	
		$this->set_experience();
		$this->set('relation', array('F' => 'Father','M' => 'Mother', 'G' => 'Guardian', 'SP' => 'Spouse', 'B' => 'Brother', 'S' => 'Sister'));
		$this->set('emp_types', array('R' => 'Regular','A' => 'Associate 1', 'A2' => 'Associate 2'));
		$this->set('att_types', array('B' => 'Biometric','O' => 'Online'));

		if ($this->request->is('post')){			
			if($type == 'personal'){
				// validates the form
				$this->HrEmployee->set($this->request->data['HrEmployee']);
				// to retain portrait
				$this->Session->write('personal.gender', $this->request->data['HrEmployee']['gender']);
				// remove photo
				if(!empty($this->request->data['HrEmployee']['rem_photo'])){
					$this->Session->write('personal.photo', '');
					$this->Session->write('personal.photo_status', '');
				}
				
				if($this->HrEmployee->validates(array('fieldList' => $this->get_validation($type)))) {				
					// save the data					
					$this->save_temp_session($this->request->data['HrEmployee'],$type);					
					// check confirm btn clicked
					$this->check_confirm($this->request->data['HrEmployee']['reg_confirm']);
					$this->Session->write('reg.step1', 1);
					$this->redirect('/hremployee/create_employee/education/');					
				}else{
					//$errors = $this->HrEmployee->validationErrors;					
					$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in submitting the form. please check errors...', 'default', array('class' => 'alert alert-error'));	
				}
			}else if($type == 'education'){			
				// validates the form
				$this->HrEmployee->HrEducation->set($this->request->data['HrEducation']);
				// retain spec
				$this->retain_spec();
		
				if($this->HrEmployee->HrEducation->validates(array('fieldList' => $this->get_validation($type)))) {	
					// save the data
					$this->save_temp_session($this->request->data['HrEducation'],$type);
					// check confirm btn clicked
					$this->check_confirm($this->request->data['HrEducation']['reg_confirm']);
					$this->Session->write('reg.step2', 1);					
					$this->redirect('/hremployee/create_employee/experience/');					
				}else{
					//$errors = $this->HrEmployee->validationErrors;					
					$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in submitting the form. please check errors...', 'default', array('class' => 'alert alert-error'));	
				}				
			}else if($type == 'experience'){
				// validates the form
				$this->HrEmployee->HrExperience->set($this->request->data['HrExperience']);				
				if($this->HrEmployee->HrExperience->validates(array('fieldList' => $this->get_validation($type)))) {				
					// save the data					
					$this->save_temp_session($this->request->data['HrExperience'],$type);
					// check confirm btn clicked
					$this->check_confirm($this->request->data['HrExperience']['reg_confirm']);
					$this->Session->write('reg.step3', 1);					
					$this->redirect('/hremployee/create_employee/family/');					
				}else{
					//$errors = $this->HrEmployee->validationErrors;					
					//print_r($errors);
					$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in submitting the form. please check errors...', 'default', array('class' => 'alert alert-error'));	
				}
			}else if($type == 'family'){
				// validates the form
				$this->HrEmployee->HrFamily->set($this->request->data['HrFamily']);
				if($this->HrEmployee->HrFamily->validates(array('fieldList' => $this->get_validation($type)))){	
					// save the data
					$this->save_temp_session($this->request->data['HrFamily'],$type);
					// check confirm btn clicked
					$this->check_confirm($this->request->data['HrFamily']['reg_confirm']);
					$this->Session->write('reg.step4', 1);					
					$this->redirect('/hremployee/create_employee/confirm/');					
				}else{
					//$errors = $this->HrEmployee->validationErrors;					
					$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in submitting the form. please check errors...', 'default', array('class' => 'alert alert-error'));	
				}
			}
			else if($type == 'confirm'){
				// save the data
				$id = $this->save_personal();				
				$this->save_education($id);
				$this->save_experience($id);
				$this->save_family($id);	
				$this->save_notification($id);
				// show the msg.
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Employee details created successfully', 'default', array('class' => 'alert alert-success'));	
				$this->redirect('/hremployee/');				
			}			
			
		}else{ // when form not submitted
		
			$this->check_steps($type);			
			// check skip
			$this->check_skip($this->request->query['action'],$type);
			
			if($type == 'confirm'){				
				$this->get_company_name($this->Session->read('personal.hr_company_id'));
				$this->get_department_name($this->Session->read('personal.hr_department_id'));
				$this->get_designation_name($this->Session->read('personal.hr_designation_id'));
				$this->get_role_name($this->Session->read('personal.app_roles_id'));
				$this->get_branch_name($this->Session->read('personal.hr_branch_id'));
				$this->get_business_unit($this->Session->read('personal.hr_business_unit_id'));
				$this->get_blood_group($this->Session->read('personal.hr_blood_group_id'));
				$this->get_course_name();
				$this->get_spec_name();
			}else if($type == 'education'){
				// retain spec
				$this->retain_spec();			
				
			}
		}			
		
		
		$this->render('/Elements/employee/add/'.$type);
	}
	
	/* function to get course name */
	public function get_course_name(){
		for($i = 3; $i <= 5; $i++){
			if($this->Session->read('education.hr_course_id'.$i) != ''){
				$this->loadModel('HrCourse');
				$course_data = $this->HrCourse->findById($this->Session->read('education.hr_course_id'.$i), array('fields' => 'course_name'));				
				$this->set('course_name'.$i, $course_data);	
			}
		}
	}
	
	/* function to get course name */
	public function get_spec_name(){
		for($i = 3; $i <= 5; $i++){
			if($this->Session->read('education.hr_specialization_id'.$i) != ''){
				$this->loadModel('HrSpec');
				$spec_data = $this->HrSpec->findById($this->Session->read('education.hr_specialization_id'.$i), array('fields' => 'specialization'));		
				$this->set('spec_name'.$i, $spec_data);	
			}
		}
	}
	
	/* function to check steps */
	public function check_steps($type){
		if($type == 'confirm'){
			if($this->Session->read('reg.step1') == '' || $this->Session->read('reg.step2') == '' || $this->Session->read('reg.step3') == '' || $this->Session->read('reg.step4') == ''){
				$this->redirect('/hremployee/');	
			}
		}else if($type == 'education'){
			if($this->Session->read('reg.step1') == ''){
				$this->redirect('/hremployee/');	
			}
		}else if($type == 'experience'){
			if($this->Session->read('reg.step1') == '' || $this->Session->read('reg.step2') == ''){
				$this->redirect('/hremployee/');	
			}
		}else if($type == 'family'){
			if($this->Session->read('reg.step1') == '' || $this->Session->read('reg.step2') == '' || $this->Session->read('reg.step3') == ''){
				$this->redirect('/hremployee/');	
			}
		}
	}
	
	
	/* function to get role name */
	public function get_role_name($id){
		$data = $this->HrEmployee->Role->findById($id, array('fields' => 'role_name'));		
		$this->set('role_data', $data);
	}
	
	/* function to get branch name */
	public function get_branch_name($id){
		$data = $this->HrEmployee->HrBranch->findById($id, array('fields' => 'branch_name'));		
		$this->set('branch_data', $data);
	}
	
	/* function to get branch name */
	public function get_blood_group($id){
		$data = $this->HrEmployee->HrBloodGroup->findById($id, array('fields' => 'blood_group'));		
		$this->set('blood_data', $data);
	}
	
	
	
	/* function to get dept name */
	public function get_department_name($id){
		$data = $this->HrEmployee->HrDepartment->findById($id, array('fields' => 'dept_name'));		
		$this->set('dept_data', $data);
	}
	
	/* function to get desig name */
	public function get_designation_name($id){
		$data = $this->HrEmployee->HrDesignation->findById($id, array('fields' => 'desig_name'));		
		$this->set('desig_data', $data);
	}
	
	/* function to get business name */
	public function get_business_unit($id){
		$data = $this->HrEmployee->HrBusinessUnit->findById($id, array('fields' => 'business_unit'));		
		$this->set('biz_data', $data);
	}
	
	
	
	/* function to get company name */
	public function get_company_name($id){
		$data = $this->HrEmployee->HrCompany->findById($id, array('fields' => 'company_name'));		
		$this->set('company_data', $data);
	}
	
	/* function save personal */
	public function save_personal(){ 	
		// iterate the session array
		foreach($this->Session->read('personal') as $key => $personal){
			$this->request->data['HrEmployee'][$key] = $personal;
		}
		$this->request->data['HrEmployee']['created_by'] = $this->Session->read('USER.Login.id');		
		$this->request->data['HrEmployee']['created_date'] = $this->Functions->get_current_date();			
		$this->request->data['HrEmployee']['doj'] = $this->Functions->format_date_save($this->Session->read('personal.doj'));
		$this->request->data['HrEmployee']['dob'] = $this->Functions->format_date_save($this->Session->read('personal.dob'));
		$this->request->data['HrEmployee']['doc'] = $this->Functions->format_date_save($this->Session->read('personal.doc'));
		// parse contract dates
		if($this->request->data['HrEmployee']['emp_type'] == 'A' || $this->request->data['HrEmployee']['emp_type'] == 'A2'){
			$this->request->data['HrEmployee']['contract_from'] = $this->Functions->format_date_save($this->Session->read('personal.contract_from'));
			$this->request->data['HrEmployee']['contract_to'] = $this->Functions->format_date_save($this->Session->read('personal.contract_to'));							
		}		
		if($this->HrEmployee->save($this->request->data['HrEmployee'], array('validate' => false))){
			return $this->HrEmployee->id;
		}else{
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in saving data... Please contact administrator', 'default', array('class' => 'alert alert-error'));	
		}
		
	}
	
	
	/* function save edu */
	public function save_education($id){ 
		// save school details
		$this->request->data['HrEducation']['created_by'] = $this->Session->read('USER.Login.id');		
		$this->request->data['HrEducation']['created_date'] = $this->Functions->get_current_date();
		$this->request->data['HrEducation']['app_users_id'] =  $id;
		
		for($i = 1; $i <= 2; $i++){
		 	$this->request->data['HrEducation']['inst_name'] =  $this->Session->read('education.inst_name'.$i);		
			if($this->request->data['HrEducation']['inst_name'] != ''){
				$this->request->data['HrEducation']['year_passing'] =  $this->Session->read('education.year_passing'.$i);
				$this->request->data['HrEducation']['program_type'] =  $i;
				$this->request->data['HrEducation']['board'] =  $this->Session->read('education.board'.$i);
				$this->request->data['HrEducation']['percent_marks'] =  $this->Session->read('education.percent_marks'.$i);					
				$this->HrEmployee->HrEducation->create();
				if($this->HrEmployee->HrEducation->save($this->request->data['HrEducation'], array('validate' => false))){
					
				}	
			}
		}
		
		// save degree details
		for($i = 3; $i <= 5; $i++){
		 	$this->request->data['HrEducation']['hr_course_id'] =  $this->Session->read('education.hr_course_id'.$i);		
			if($this->request->data['HrEducation']['hr_course_id'] != ''){
				$this->request->data['HrEducation']['inst_name'] =  $this->Session->read('education.inst_name'.$i);	
				$this->request->data['HrEducation']['year_passing'] =  $this->Session->read('education.year_passing'.$i);
				$this->request->data['HrEducation']['program_type'] =  $i;
				$this->request->data['HrEducation']['hr_course_id'] =  $this->Session->read('education.hr_course_id'.$i);
				$this->request->data['HrEducation']['board'] = '';
				$this->request->data['HrEducation']['hr_specialization_id'] =  $this->Session->read('education.hr_specialization_id'.$i);
				$this->request->data['HrEducation']['percent_marks'] =  $this->Session->read('education.percent_marks'.$i);	
				$this->request->data['HrEducation']['university'] =  $this->Session->read('education.university'.$i);	
				$this->request->data['HrEducation']['course_type'] =  $this->Session->read('education.course_type'.$i);		
				$this->HrEmployee->HrEducation->create();
				if($this->HrEmployee->HrEducation->save($this->request->data['HrEducation'], array('validate' => false))){
					
				}	
			}
		}
		
	}
	
	/* function to remove the education details */
	public function remove_education($id){
		$this->HrEmployee->HrEducation->deleteAll(array('app_users_id' => $id), false);
	}
	
	
		/* function save edu */
	public function save_education_view($id){ 
		$this->remove_education($id);
		// save school details
		$this->request->data['HrEducation']['created_by'] = $this->Session->read('USER.Login.id');		
		$this->request->data['HrEducation']['created_date'] = $this->Functions->get_current_date();
		$this->request->data['HrEducation']['app_users_id'] =  $id;
		
		for($i = 1; $i <= 2; $i++){
		 	$this->request->data['HrEducation']['inst_name'] = $this->request->data['HrEducation']['inst_name'.$i];		
			if($this->request->data['HrEducation']['inst_name'] != ''){
				$this->request->data['HrEducation']['year_passing'] =  $this->request->data['HrEducation']['year_passing'.$i];
				$this->request->data['HrEducation']['program_type'] =  $i;
				$this->request->data['HrEducation']['board'] =  $this->request->data['HrEducation']['board'.$i];
				$this->request->data['HrEducation']['percent_marks'] =  $this->request->data['HrEducation']['percent_marks'.$i];
				$this->HrEmployee->HrEducation->create();
				if($this->HrEmployee->HrEducation->save($this->request->data['HrEducation'], array('validate' => false))){
					
				}	
			}
		}
		
		// save degree details
		for($i = 3; $i <= 5; $i++){
		 	$this->request->data['HrEducation']['hr_course_id'] =  $this->request->data['HrEducation']['hr_course_id'.$i];	
			if($this->request->data['HrEducation']['hr_course_id'] != ''){
				$this->request->data['HrEducation']['inst_name'] =   $this->request->data['HrEducation']['inst_name'.$i];		
				$this->request->data['HrEducation']['year_passing'] =  $this->request->data['HrEducation']['year_passing'.$i];					
				$this->request->data['HrEducation']['program_type'] =  $i;
				$this->request->data['HrEducation']['hr_course_id'] =  $this->request->data['HrEducation']['hr_course_id'.$i];	
				$this->request->data['HrEducation']['board'] = '';
				$this->request->data['HrEducation']['hr_specialization_id'] =   $this->request->data['HrEducation']['hr_specialization_id'.$i];	
				$this->request->data['HrEducation']['percent_marks'] =  $this->request->data['HrEducation']['percent_marks'.$i];	
				$this->request->data['HrEducation']['university'] =  $this->request->data['HrEducation']['university'.$i];	
				$this->request->data['HrEducation']['course_type'] =  $this->request->data['HrEducation']['course_type'.$i];	
				$this->HrEmployee->HrEducation->create();
				if($this->HrEmployee->HrEducation->save($this->request->data['HrEducation'], array('validate' => false))){
					
				}	
			}
		}
		
		return true;
		
	}
	
	
	/* function to remove the education details */
	public function remove_experience($id){
		$this->HrEmployee->HrExperience->deleteAll(array('app_users_id' => $id), false);
	}

			/* function save edu */
	public function save_experience_view($id){ 
		$this->remove_experience($id);
		// save school details
		$this->request->data['HrExperience']['created_by'] = $this->Session->read('USER.Login.id');		
		$this->request->data['HrExperience']['created_date'] = $this->Functions->get_current_date();
		$this->request->data['HrExperience']['app_users_id'] =  $id;
		
		for($i = 1; $i <= 2; $i++){
		 	$this->request->data['HrExperience']['company'] = $this->request->data['HrExperience']['company'.$i];		
			if($this->request->data['HrExperience']['company'] != ''){
				$this->request->data['HrExperience']['designation'] =  $this->request->data['HrExperience']['designation'.$i];			
				$this->request->data['HrExperience']['address'] =  $this->request->data['HrExperience']['address'.$i];
				$this->request->data['HrExperience']['total_exp'] =  $this->request->data['HrExperience']['total_exp'.$i];
				$this->request->data['HrExperience']['doj'] =  $this->Functions->format_date_save($this->request->data['HrExperience']['doj'.$i]);
				$this->request->data['HrExperience']['dor'] =  $this->Functions->format_date_save($this->request->data['HrExperience']['dor'.$i]);
				$this->HrEmployee->HrExperience->create();
				if($this->HrEmployee->HrExperience->save($this->request->data['HrExperience'], array('validate' => false))){
					
				}	
			}
		}
		
				
		return true;
		
	}
	
	
	/* function to remove the education details */
	public function remove_family($id){
		$this->HrEmployee->HrFamily->deleteAll(array('app_users_id' => $id), false);
	}

			/* function save edu */
	public function save_family_view($id){ 
		$this->remove_family($id);
		// save school details
		$this->request->data['HrFamily']['created_by'] = $this->Session->read('USER.Login.id');		
		$this->request->data['HrFamily']['created_date'] = $this->Functions->get_current_date();
		$this->request->data['HrFamily']['app_users_id'] =  $id;
		
		for($i = 1; $i <= 6; $i++){
		 	$this->request->data['HrFamily']['relative_name'] = $this->request->data['HrFamily']['relative_name'.$i];		
			if($this->request->data['HrFamily']['relative_name'] != ''){
				$this->request->data['HrFamily']['relative_name'] =  $this->request->data['HrFamily']['relative_name'.$i];			
				$this->request->data['HrFamily']['address'] =  $this->request->data['HrFamily']['address'.$i];
				$this->request->data['HrFamily']['relationship'] =  $this->request->data['HrFamily']['relationship'.$i];
				$this->request->data['HrFamily']['dob'] =  $this->Functions->format_date_save($this->request->data['HrFamily']['dob'.$i]);
				$this->HrEmployee->HrFamily->create();
				if($this->HrEmployee->HrFamily->save($this->request->data['HrFamily'], array('validate' => false))){
					
				}	
			}
		}
		
				
		return true;
		
	}
	
	
	
	/* function save exp */
	public function save_experience($id){
		$this->request->data['HrExperience']['created_by'] = $this->Session->read('USER.Login.id');		
		$this->request->data['HrExperience']['created_date'] = $this->Functions->get_current_date();
		$this->request->data['HrExperience']['app_users_id'] =  $id;
		
		// save degree details
		for($i = 1; $i <= 2; $i++){ 
		 	$this->request->data['HrExperience']['company'] =  $this->Session->read('experience.company'.$i);		
			if($this->request->data['HrExperience']['company'] != ''){
				// format the dates to save
				$this->request->data['HrExperience']['doj'] = $this->Functions->format_date_save($this->Session->read('experience.doj'.$i));			
				$this->request->data['HrExperience']['dor'] = $this->Functions->format_date_save($this->Session->read('experience.dor'.$i));	
				$this->request->data['HrExperience']['company'] =  $this->Session->read('experience.company'.$i);	
				$this->request->data['HrExperience']['designation'] =  $this->Session->read('experience.designation'.$i);			
				$this->request->data['HrExperience']['address'] =  $this->Session->read('experience.address'.$i);
				$this->request->data['HrExperience']['total_exp'] =  $this->Session->read('experience.total_exp'.$i);
						
				$this->HrEmployee->HrExperience->create();
				if($this->HrEmployee->HrExperience->save($this->request->data['HrExperience'], array('validate' => false))){
					
				}	
			}
		}
	}
	
	
	
	/* function save family */
	public function save_family($id){
		// save family details
		$this->request->data['HrFamily']['created_by'] = $this->Session->read('USER.Login.id');		
		$this->request->data['HrFamily']['created_date'] = $this->Functions->get_current_date();
		$this->request->data['HrFamily']['app_users_id'] =  $id;
		
		for($i = 1; $i <= 6; $i++){
		 	$this->request->data['HrFamily']['relative_name'] =  $this->Session->read('family.relative_name'.$i);		
			if($this->request->data['HrFamily']['relative_name'] != ''){
				$this->request->data['HrFamily']['address'] =  $this->Session->read('family.address'.$i);
				$this->request->data['HrFamily']['dob'] =  $this->Functions->format_date_save($this->Session->read('family.dob'.$i));	
				$this->request->data['HrFamily']['relationship'] =  $this->Session->read('family.relationship'.$i);	
				$this->HrEmployee->HrFamily->create();
				if($this->HrEmployee->HrFamily->save($this->request->data['HrFamily'], array('validate' => false))){
					
				}	
			}
		}
	}
	
	/* function to save notifications */
	public function save_notification($id){
		$notify = array('I', 'N','V', 'G', 'D', 'L','R'); 
		$this->loadModel('Notification');
		foreach($notify as $not){
			$data = array('notify' => $not, 'created_date' => $this->Functions->get_current_date(),
			'app_users_id' => $id);	
			$this->Notification->create();
			// save the todo
			$this->Notification->save($data, true, $fieldList = array('notify', 'created_date','app_users_id'));
		}
	}
	
	
	/* function to retain the specs */
	public function retain_spec(){
		$this->loadModel('HrSpec');
		if(empty($this->request->data['HrEducation']['hr_course_id3'])){
			$course1 = $this->Session->read('education.hr_course_id3');
		}else{
			$course1 = $this->request->data['HrEducation']['hr_course_id3'];	
		}
		$dip_spec = $this->HrSpec->find('list', array('fields' => array('id','specialization'), 'order' => array('specialization' =>  'asc'), 'conditions' => array('status' => 'A', 'course_details_id' => $course1)));
		$this->set('dipspecList', $dip_spec);	
		
		if(empty($this->request->data['HrEducation']['hr_course_id4'])){
			$course2 = $this->Session->read('education.hr_course_id4');
		}else{
			$course2 = $this->request->data['HrEducation']['hr_course_id4'];	
		}		
		$ug_spec = $this->HrSpec->find('list', array('fields' => array('id','specialization'), 'order' => array('specialization' =>  'asc'), 'conditions' => array('status' => 'A', 'course_details_id' => $course2)));
		$this->set('ugspecList', $ug_spec);
		
		if(empty($this->request->data['HrEducation']['hr_course_id5'])){
			$course3 = $this->Session->read('education.hr_course_id5');
		}else{
			$course3 = $this->request->data['HrEducation']['hr_course_id5'];	
		}		
		$pg_spec = $this->HrSpec->find('list', array('fields' => array('id','specialization'), 'order' => array('specialization' =>  'asc'), 'conditions' => array('status' => 'A', 'course_details_id' => $course3)));
		$this->set('pgspecList', $pg_spec);
	}
	
	
	/* function to retain the specs */
	public function retain_spec_view($course1, $course2, $course3){
		$this->loadModel('HrSpec');
		
		
		$dip_spec = $this->HrSpec->find('list', array('fields' => array('id','specialization'), 'order' => array('specialization' =>  'asc'), 'conditions' => array('status' => 'A', 'course_details_id' => $course1)));
		$this->set('dipspecList', $dip_spec);	
		
				
		$ug_spec = $this->HrSpec->find('list', array('fields' => array('id','specialization'), 'order' => array('specialization' =>  'asc'), 'conditions' => array('status' => 'A', 'course_details_id' => $course2)));
		$this->set('ugspecList', $ug_spec);
		
				
		$pg_spec = $this->HrSpec->find('list', array('fields' => array('id','specialization'), 'order' => array('specialization' =>  'asc'), 'conditions' => array('status' => 'A', 'course_details_id' => $course3)));
		$this->set('pgspecList', $pg_spec);
	}
	
	/* function to check confirm button submission */
	public function check_confirm($confirm){
		if($confirm){
			$this->redirect('/hremployee/create_employee/confirm/');	
		}
		
	}
	
	/* function to check skip */
	public function check_skip($action,$type){
		if($action == 'skip'){
			if($type == 'education'){
				$this->Session->write('reg.step2', 1);
				$this->Session->write('education', '');
				$url = 'experience';
			}else if($type == 'experience'){
				$this->Session->write('reg.step3', 1);
				$this->Session->write('experience', '');
				$url = 'family';
			}else if($type == 'family'){
				$this->Session->write('reg.step4', 1);
				$this->Session->write('family', '');
				$url = 'confirm';
			}
			
			$this->redirect('/hremployee/create_employee/'.$url.'/');	
		}
		
	}
	
		/* to update the photo */
	public function change_photo(){
		$this->layout = 'ajax';	
		// check form posted
		if($this->request->is('post')){
			// validate the file
			if($this->Functions->validate_img($_FILES['file']['type'], $_FILES['file']['size'])){					
				// upload the photo
				$src = $_FILES['file']['tmp_name'];
				$file_name = rand(1,100000).'_'.$_FILES['file']['name'];
				$dest = 'uploads/photo/'.$file_name;
				if($this->Functions->upload_file($src, $dest)){
					$this->Session->write('personal.photo', $file_name);
					$this->Session->write('personal.photo_status', 'A');
					echo $this->webroot.'timthumb.php?src='.$dest.'&h=90q=100';				
				}
			}else{
				echo 'upload_error';
			}
		}
		die;
			
	}
	
	/* function to save the temporary session */
	public function save_temp_session($data,$type){
		foreach($data as $key => $record){ 
			$this->Session->write($type.'.'.$key, $record);
		}	
	
		//print_r($this->Session->read('education'));
	}
	
	/* function to set year of passing */
	public function set_year_passing(){		
		for($i = 0; $i <= 50; $i++){			
			$year[date('Y')-$i] = date('Y')-$i;			
		}		
		$this->set('yearPass', $year);
	}
	
	/* function to set year of passing */
	public function set_experience(){	
		
		$year['0.3'] = '3 Months';
		$year['0.6'] = '6 Months';
		$year['0.9'] = '9 Months';
		$year['1'] = '1 Year';
		for($i = 2; $i <= 25; $i++){
			$year[$i] =$i.' Years';
			
		}		
		$this->set('yearExp', $year);
	}
	
	
	
	/* function to set validation */
	public function get_validation($type){	
		switch($type){
			case 'personal':
			$valid = array('first_name','last_name', 'email_address','dob','doj','gender','hr_department_id','hr_designation_id','hr_branch_id','hr_company_id','app_roles_id','status','emp_no','blood_group','communication_addr','permanent_addr','marital_status','contact_no','personal_email','official_contact_no','hr_business_unit_id','doc','probation','hr_blood_group_id','emp_type','work_place','contract_from','contract_to','att_type','att_approve');
			break;
			case 'education':
			//$valid = array('inst_name1','inst_name4','percent_marks1','percent_marks4','year_passing1','year_passing4','board1','hr_course_id4','hr_specialization_id4','percent_marks4','university4','course_type4');
			$valid = array();
			break;
			case 'experience':
			$valid = array('company1','designation1', 'total_exp1','dor1','doj1');
			break;
			case 'family':
			$valid = array('relative_name1','relationship1');
			break;
			
		}		
		return $valid;
	}
	
	/* function to upload the photo */
	public function upload_emp_photo($data, $id){			
		if(!empty($data['tmp_name'])){
			$file = $id.'_'.$data['name'];
			if($this->upload_file($data['tmp_name'], WWW_ROOT.'/uploads/photo/'.$file)){
				return $file;
			}			
		}
				
	}
	
	
	
	/* function to load all the static models */
	public function load_static_tables(){
		// fetch the list of dept.		
		$dept_list = $this->HrEmployee->HrDepartment->find('list', array('fields' => array('id','dept_name'), 'order' => array('dept_name ASC'),'conditions' => array('status' => 1, 'is_deleted' => 'N')));
		$this->set('deptList', $dept_list);
		// fetch the list of designation		
		$desig_list = $this->HrEmployee->HrDesignation->find('list', array('fields' => array('id','desig_name'), 'order' => array('desig_name ASC'),'conditions' => array('status' => 1, 'is_deleted' => 'N')));
		$this->set('desigList', $desig_list);
		// fetch the list of roles		
		$role_list = $this->HrEmployee->Role->find('list', array('fields' => array('id','role_name'), 'order' => array('role_name ASC'),'conditions' => array('status' => 1, 'is_deleted' => 'N')));
		$this->set('roleList', $role_list);
		// fetch the list of grade		
		//$grade_list = $this->HrEmployee->HrGrade->find('list', array('fields' => array('id','grade_name'), 'order' => array('grade_name ASC'),'conditions' => array('status' => 1,'is_deleted' => 'N')));
		//$this->set('gradeList', $grade_list);
			// fetch the list of branches		
		$branch_list = $this->HrEmployee->HrBranch->find('list', array('fields' => array('id','branch_name'), 'order' => array('branch_name ASC'),'conditions' => array('status' => 1,'is_deleted' => 'N')));
		$this->set('branchList', $branch_list);
		// fetch the list of grade		
		$comp_list = $this->HrEmployee->HrCompany->find('list', array('fields' => array('id','company_name'), 'order' => array('company_name ASC')));
		$this->set('compList', $comp_list);
		// set course type
		$this->set('courseType', array('F' => 'Full time', 'P' => 'Executive', 'C' => 'Correspondance'));
		// fetch course details	
		$this->loadModel('HrCourse');
		$dip_course_list = $this->HrCourse->find('list', array('fields' => array('id','course_name'), 'order' => array('course_name' =>  'asc'), 'conditions' => array('status' => 'A', 'is_deleted' => 'N', 'program_details_id <=' => '2')));
		$this->set('dipcourseList', $dip_course_list);	
		
		$ug_course_list = $this->HrCourse->find('list', array('fields' => array('id','course_name'), 'order' => array('course_name' =>  'asc'), 'conditions' => array('status' => 'A', 'is_deleted' => 'N', 'program_details_id' => '3')));
		$this->set('ugcourseList', $ug_course_list);
		
		$pg_course_list = $this->HrCourse->find('list', array('fields' => array('id','course_name'), 'order' => array('course_name' =>  'asc'), 'conditions' => array('status' => 'A', 'is_deleted' => 'N', 'program_details_id' => '4')));
		$this->set('pgcourseList', $pg_course_list);			
		// set school board
		$this->set('boardList', array('S' => 'State Board', 'C' => 'CBSE', 'I' => 'ICSE','M' => 'Matriculation', 'A' => 'Anglo Indian'));
		// load hr business unit
		$business_list = $this->HrEmployee->HrBusinessUnit->find('list', array('fields' => array('id','business_unit'), 'order' => array('business_unit ASC'),'conditions' => array('status' => 1,'is_deleted' => 'N')));
		$this->set('businessList', $business_list);
		// load hr business unit
		$blood_list = $this->HrEmployee->HrBloodGroup->find('list', array('fields' => array('id','blood_group'), 'order' => array('blood_group ASC'),'conditions' => array('status' => 1)));
		$this->set('bloodList', $blood_list);
		
	}
	
	
	/* function to get spec. details */
	public function get_specialization(){
		$this->layout = 'refresh';
		$this->loadModel('HrSpec');
		$id = $this->request->query['id'];
		$data = $this->HrSpec->find('all', array('fields' => array('id','specialization'), 'conditions' => array('status' => 'A', 'course_details_id' => $id), 'order' => array('specialization' => 'asc')));
		$options .= "<option value=''>Select</option>";
		foreach($data as $spec){ 
			$options .= "<option value=".$spec['HrSpec']['id'].">".$spec['HrSpec']['specialization']."</option>";
		}	
		echo $options;
		$this->render(false);
		die;
	}
	
	
	
	/* function to delete the adv. request */
	public function delete_employee($emp_id){
		if(!empty($emp_id) && intval($emp_id)){
			// authorize user before action
			$ret_value = $this->auth_action($emp_id);
			if($ret_value == 'pass'){					
				$this->HrEmployee->id = $emp_id;
				$this->HrEmployee->saveField('is_deleted', 'Y'); 
				$this->HrEmployee->saveField('modified_date', $this->Functions->get_current_date()); 
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Employee deleted successfully', 'default', array('class' => 'alert alert-success'));				
			}else if($ret_value == 'fail'){
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/hremployee/');
			}else{
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Record Deleted: '.$ret_value , 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/hremployee/');
			}
		}else{
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));			
		}
		$this->redirect('/hremployee/');
	}
	
	
	/* function to edit the advance */
	public function edit_employee($type, $id){	
		// set the page title		
		$this->set('title_for_layout', 'Edit Employee - HRIS - My PDCA');	
		// load static models
		$this->load_static_tables();
		$this->set_year_passing();	
		$this->set_experience();
		$this->set('relation', array('F' => 'Father','M' => 'Mother', 'G' => 'Guardian', 'SP' => 'Spouse', 'B' => 'Brother', 'S' => 'Sister'));		
		$this->set('emp_types', array('R' => 'Regular','A' => 'Associate 1', 'A2' => 'Associate 2'));
		$this->set('att_types', array('B' => 'Biometric','O' => 'Online'));
		if (!empty($id) && intval($id)){
			// authorize user before action
			$ret_value = $this->auth_action($id);
			if($ret_value == 'pass'){	
				// when the form submitted
				if (!empty($this->request->data)){ 					
														
					$this->request->data['HrEmployee']['modified_by'] = $this->Session->read('USER.Login.id');	
					$this->request->data['HrEmployee']['modified_date'] = $this->Functions->get_current_date();
					// when personal data is updated
					if($type == 'personal'){ 					
						// validates the form
						$this->HrEmployee->set($this->request->data);					
						if ($this->HrEmployee->validates(array('fieldList' => $this->get_validation($type)))){
							// format the dates to save
							$this->request->data['HrEmployee']['dob'] = $this->Functions->format_date_save($this->request->data['HrEmployee']['dob']);
							$this->request->data['HrEmployee']['doj'] = $this->Functions->format_date_save($this->request->data['HrEmployee']['doj']);
							$this->request->data['HrEmployee']['wedding_date'] = $this->Functions->format_date_save($this->request->data['HrEmployee']['wedding_date']);
							$this->request->data['HrEmployee']['doc'] = $this->Functions->format_date_save($this->request->data['HrEmployee']['doc']);	
							// parse contract dates
							if($this->request->data['HrEmployee']['emp_type'] == 'A' || $this->request->data['HrEmployee']['emp_type'] == 'A2'){
								$this->request->data['HrEmployee']['contract_from'] = $this->Functions->format_date_save($this->request->data['HrEmployee']['contract_from']);
								$this->request->data['HrEmployee']['contract_to'] = $this->Functions->format_date_save($this->request->data['HrEmployee']['contract_to']);							
							}	
							// update photo
							$photo = $this->Session->read('personal.photo');
							if($photo != ''){
								$this->request->data['HrEmployee']['photo'] = $photo;
								$this->request->data['HrEmployee']['photo_status'] = 'A';									
							}
							// remove photo
							if(!empty($this->request->data['HrEmployee']['rem_photo'])){
								$this->request->data['HrEmployee']['photo'] = '';	
								$this->request->data['HrEmployee']['photo_status'] = '';		
							}
							// save the data
							if($this->HrEmployee->save($this->request->data['HrEmployee'])) {	
								// show the msg.
								$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Personal details modified successfully', 'default', array('class' => 'alert alert-success'));
								$this->redirect('/hremployee/view_employee/'.$id.'#personal');
								
							}else{
								// show the error msg.
								$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in saving the data...', 'default', array('class' => 'alert alert-error'));					
							}
						  }
								
						}// when education data is updated
						else if($type == 'education'){ 
							$this->retain_spec_view($this->request->data['HrEducation']['hr_course_id3'],$this->request->data['HrEducation']['hr_course_id4'],$this->request->data['HrEducation']['hr_course_id5']);
							$this->HrEmployee->HrEducation->set($this->request->data);					
							if ($this->HrEmployee->HrEducation->validates(array('fieldList' => $this->get_validation($type)))){
							// save the data
							if($this->save_education_view($id)){	
								// show the msg.
								$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Education details modified successfully', 'default', array('class' => 'alert alert-success'));
								$this->redirect('/hremployee/view_employee/'.$id.'#education');								
							}else{
								// show the error msg.
								$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in saving the data...', 'default', array('class' => 'alert alert-error'));					
							}	
						}
								
					}else if($type == 'experience'){ 						
							$this->HrEmployee->HrExperience->set($this->request->data);					
							if ($this->HrEmployee->HrExperience->validates(array('fieldList' => $this->get_validation($type)))){
							// save the data
							if($this->save_experience_view($id)){	
								// show the msg.
								$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Experience details modified successfully', 'default', array('class' => 'alert alert-success'));
								$this->redirect('/hremployee/view_employee/'.$id.'#experience');								
							}else{
								// show the error msg.
								$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in saving the data...', 'default', array('class' => 'alert alert-error'));					
							}	
						}								
					}else if($type == 'family'){ 						
						$this->HrEmployee->HrFamily->set($this->request->data);					
						if ($this->HrEmployee->HrFamily->validates(array('fieldList' => $this->get_validation($type)))){
							// save the data
							if($this->save_family_view($id)){	
								// show the msg.
								$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Family details modified successfully', 'default', array('class' => 'alert alert-success'));
								$this->redirect('/hremployee/view_employee/'.$id.'#family');								
							}else{
								// show the error msg.
								$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in saving the data...', 'default', array('class' => 'alert alert-error'));					
							}	
						}
								
					}									
						
				}else{ // form not posted
					if($type == 'personal'){
						$this->request->data = $this->HrEmployee->findById($id, array('fields' => 'id','first_name','last_name','email_address','hr_department_id','hr_designation_id','emp_no','contact_no','landline','personal_email','communication_addr','marital_status','hr_company_id','blood_group','status','gender', 'photo', 'dob','doj','doc','app_roles_id','hr_branch_id','pan','insurance_no','pf_no','esi_no','permanent_addr','wedding_date', 'official_contact_no','emergency_contact_person','emergency_contact_no','emergency_relation','hr_business_unit_id','doc','probation','hr_blood_group_id','emp_type','contract_from','contract_to','work_place','att_type','att_approve','skype'));
						// format the dates to show
						$this->request->data['HrEmployee']['dob'] = $this->Functions->format_date_show($this->request->data['HrEmployee']['dob']);	
						if($this->request->data['HrEmployee']['doc'] != ''){
							$this->request->data['HrEmployee']['doc'] = $this->Functions->format_date_show($this->request->data['HrEmployee']['doc']);	
						}
						if($this->request->data['HrEmployee']['doj'] != ''){
							$this->request->data['HrEmployee']['doj'] = $this->Functions->format_date_show($this->request->data['HrEmployee']['doj']);	
						}
						if($this->request->data['HrEmployee']['wedding_date'] != '' && $this->request->data['HrEmployee']['wedding_date'] != '0000-00-00' ){
							$this->request->data['HrEmployee']['wedding_date'] = $this->Functions->format_date_show($this->request->data['HrEmployee']['wedding_date']);	
						}else{
							$this->request->data['HrEmployee']['wedding_date'] = '';	
						}
						// parse contract dates
						if($this->request->data['HrEmployee']['emp_type'] == 'A'  && $this->request->data['HrEmployee']['contract_from'] != '0000-00-00' ){
							$this->request->data['HrEmployee']['contract_from'] = $this->Functions->format_date_show($this->request->data['HrEmployee']['contract_from']);
							$this->request->data['HrEmployee']['contract_to'] = $this->Functions->format_date_show($this->request->data['HrEmployee']['contract_to']);							
						}else if($this->request->data['HrEmployee']['emp_type'] == 'A2'  && $this->request->data['HrEmployee']['contract_from'] != '0000-00-00' ){
							$this->request->data['HrEmployee']['contract_from'] = $this->Functions->format_date_show($this->request->data['HrEmployee']['contract_from']);
							$this->request->data['HrEmployee']['contract_to'] = $this->Functions->format_date_show($this->request->data['HrEmployee']['contract_to']);							
						}else{
							$this->request->data['HrEmployee']['contract_from'] = '';
							$this->request->data['HrEmployee']['contract_to'] = '';
							$this->request->data['HrEmployee']['work_place'] = '';
							
						}
						
					}else if($type == 'education'){
						
						// get education details of employee
						$education = $this->HrEmployee->HrEducation->find('all', array('fields' => array('inst_name','percent_marks','year_passing','board'), 'conditions' => array('app_users_id' => $id ,'program_type' => '1')));						
						$this->set('edu_data', $education);
						$education = $this->HrEmployee->HrEducation->find('all', array('fields' => array('inst_name','percent_marks','year_passing','board'), 'conditions' => array('app_users_id' => $id,'program_type' => '2')));						
						$this->set('edu_data2', $education);
						$education1 = $this->HrEmployee->HrEducation->find('all', array('fields' => array('inst_name','percent_marks','year_passing','university','course_type','hr_specialization_id','hr_course_id'), 'conditions' => array('app_users_id' => $id,'program_type' => '3')));		
						$this->set('edu_data3', $education1);
						$education2 = $this->HrEmployee->HrEducation->find('all', array('fields' => array('inst_name','percent_marks','year_passing','university','course_type','hr_specialization_id','hr_course_id'), 'conditions' => array('app_users_id' => $id,'program_type' => '4')));		
						$this->set('edu_data4', $education2);
						$education3 = $this->HrEmployee->HrEducation->find('all', array('fields' => array('inst_name','percent_marks','year_passing','university','course_type','hr_specialization_id','hr_course_id'), 'conditions' => array('app_users_id' => $id,'program_type' => '5')));		
						$this->set('edu_data5', $education3);
						// retain spec.
						$this->retain_spec_view($education1[0]['HrEducation']['hr_course_id'],$education2[0]['HrEducation']['hr_course_id'],$education3[0]['HrEducation']['hr_course_id']);
					}else if($type == 'experience'){
						// get experience details
						$experience = $this->HrEmployee->HrExperience->find('all', array('fields' => array('company','total_exp','address','designation','dor','doj'), 'conditions' => array('app_users_id' => $id), 'order' => array('dor' => 'desc')));
						$this->set('exp_data', $experience);
					}else if($type == 'family'){
						// get family details
						$family = $this->HrEmployee->HrFamily->find('all', array('fields' => array('dob','relationship','relative_name','address'), 'conditions' => array('app_users_id' => $id), 'order' => array('id' => 'asc')));						
						$this->set('family_data', $family);
						
						/* if($family['HrEmployee']['dob'] != '0000-00-00'){
							$this->request->data['HrEmployee']['dob'] = $this->Functions->format_date_show($this->request->data['HrEmployee']['dob']);	
						}*/
					}
					
				}
			}else if($ret_value == 'fail'){
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/hremployee/');
			}else{
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Record Deleted: '.$ret_value , 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/hremployee/');
			}
		}else{
			// show the error msg.
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));
			$this->redirect('/hremployee/');		
		}	

		$this->render('/Elements/employee/edit/'.$type);	
		
	}
	
	/* function to auth record */
	public function auth_action($id){
		$data = $this->HrEmployee->findById($id, array('fields' => 'id','is_deleted','modified_date'));	
		// check the req belongs to the user
		if($data['HrEmployee']['is_deleted'] == 'Y'){
			return $data['HrEmployee']['modified_date'];
		}		
		else if(empty($data)){	
			return 'fail';
		}else{
			return 'pass';
		}
	}
	
	/* function to view the adv. request */
	public function view_employee($id, $type){
		// set the page title		
		$this->set('title_for_layout', 'View Employee - HRIS - My PDCA');
		$this->set('st_url', '?status='.$this->params->query['status']);
		if(!empty($id) && intval($id)){
			// authorize user before action
			$ret_value = $this->auth_action($id);
			if($ret_value == 'pass'){	
				$data = $this->HrEmployee->findById($id, array('fields' => 'id','first_name','last_name','email_address','HrDepartment.dept_name','HrDesignation.desig_name','emp_no','contact_no','landline','personal_email','communication_addr','marital_status','HrCompany.company_name','blood_group','status','gender', 'photo','photo_status', 'dob','doj','Role.role_name','HrBranch.branch_name','pan','insurance_no','pf_no','esi_no','permanent_addr','emergency_contact_person','emergency_contact_no','emergency_relation','wedding_date','official_contact_no','pan','HrBusinessUnit.business_unit','doc','probation','HrBloodGroup.blood_group','emp_type','work_place','contract_from','contract_to','att_type','att_approve','skype'));
				$this->Session->write('personal.photo', '');				
				$this->set('emp_data', $data);
				// get education details of employee
				$education = $this->HrEmployee->HrEducation->find('all', array('fields' => array('inst_name','percent_marks','year_passing','university','course_type','board','HrCourse.course_name','HrSpec.specialization','program_type'), 'conditions' => array('app_users_id' => $id), 'order' => array('program_type' => 'asc')));
				$this->set('edu_data', $education);
				// get experience details
				$experience = $this->HrEmployee->HrExperience->find('all', array('fields' => array('company','total_exp','address','designation','dor','doj'), 'conditions' => array('app_users_id' => $id), 'order' => array('dor' => 'desc')));
				$this->set('exp_data', $experience);
				// get family details
				$family = $this->HrEmployee->HrFamily->find('all', array('fields' => array('dob','relationship','relative_name','address'), 'conditions' => array('app_users_id' => $id), 'order' => array('id' => 'asc')));
				$this->set('family_data', $family);
				
			}else if($ret_value == 'fail'){ 
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/hremployee/');	
			}else{
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Record Deleted: '.$ret_value , 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/hremployee/');	
			}
		}else{
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));		
			$this->redirect('/hremployee/');	
		}
		
	}
	
	/* function to verify photo */
	public function verify_photo($id, $status){
		$this->HrEmployee->id = $id;
		$this->HrEmployee->saveField('photo_status', $status);
		if($status == 'R'){
			$this->HrEmployee->id = $id;
			$this->HrEmployee->saveField('photo', '');
			$st_msg = ' rejected';
		}else{
			$st_msg = ' approved';
		}		
		// send notification to user							
		$user_data = $this->HrEmployee->findById($id, array('fields' => 'email_address', 'first_name', 'last_name'));		
		$vars = array('from_name' => ucfirst($this->Session->read('USER.Login.first_name')).' '.ucfirst($this->Session->read('USER.Login.last_name')),'name' => $user_data['HrEmployee']['first_name'].' '.$user_data['HrEmployee']['last_name'], 'status' => $st_msg, 'remarks' => $this->request->query['remark']);
		// send mail		
		if(!$this->send_email('My PDCA - '.ucfirst($this->Session->read('USER.Login.first_name')).' '.	ucfirst($this->Session->read('USER.Login.last_name')).  ' '.$st_msg.' profile photo!', 'photo_verification', 'noreply@mypdca.in', $user_data['HrEmployee']['email_address'],$vars)){	
		// show the msg.								
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in sending the mail...', 'default', array('class' => 'alert alert-error'));				
		}else{
						
		}		
		$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Profile photo '.$st_msg.' successfully', 'default', array('class' => 'alert alert-success'));
		$this->redirect('/hremployee/view_employee/'.$id.'/?status=W');
	}
	
	/* clear the cache */
	
	public function beforeFilter() { 
		//$this->disable_cache();
		$this->show_tabs(16);
	}
	
	
	/* auto complete search */	
	public function search(){ 
		$this->layout = false;	 
		$q = trim(Sanitize::escape($_GET['q']));	
		if(!empty($q)){
			// execute only when the search keywork has value		
			$this->set('keyword', $q);
			$data = $this->HrEmployee->find('all', array('fields' => array('full_name','HrDepartment.dept_name','HrDesignation.desig_name'),  'group' => array('full_name'), 'conditions' => 	array("OR" => array ('full_name like' => '%'.$q.'%','HrDepartment.dept_name like' => '%'.$q.'%','HrDesignation.desig_name like' => '%'.$q.'%'), 'AND' => array('HrEmployee.is_deleted' => 'N'))));		
			$this->set('results', $data);
		}
    }
	
	
	
}