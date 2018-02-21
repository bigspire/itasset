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
class TskroaController extends AppController {  
	
	public $name = 'TskRoa';	
	
	public $helpers = array('Html', 'Form', 'Session');
	
	public $components = array('Session', 'Functions');
	
	public $layout = 'apps';	

	/* function to list the adv. requests */
	public function index(){	
		// set the page title
		$this->set('title_for_layout', 'ROA - Work Planner - My PDCA');
		$this->set('star_options', array('M' => 'Star of the Month', 'Q' => 'Star of the Quarter', 'C' => 'Champion of CareerTree'));
		// when the form is submitted for search
		if($this->request->is('post')){
			$url_vars = $this->Functions->create_url(array('month_start','month_end','type'),'TskRoa'); 
			$this->redirect('/tskroa/?'.$url_vars);			
		}
		// for start date and end date search
		$start = $this->Functions->format_month_save($this->params->query['month_start']);
		$end = $this->Functions->format_month_save($this->params->query['month_end']);
		if($start != '' && $end != ''){			
			$keyCond = array('reward_month between ? and ?' => array($start, $end)); 
		}else if($start != ''){			
			$keyCond = array('reward_month >=' =>  $start); 
		}else if($end != ''){			
			$keyCond = array('reward_month <=' =>  $end); 
		}
		// search task type
		if($this->request->query['type'] != ''){
			$typeCond = array('TskStar.star_type' =>  $this->request->query['type']); 
		}
		
		$options = array(			
			array('table' => 'tsk_applause_status',
					'alias' => 'TskApplauseStatuses',					
					'type' => 'LEFT',
					'conditions' => array('`TskApplauseStatuses`.`tsk_applause_id` = `TskRoa`.`id`')
			),
			array('table' => 'app_users',
					'alias' => 'Homes',					
					'type' => 'LEFT',
					'conditions' => array('`TskApplauseStatuses`.`app_users_id` = `Homes`.`id`')
			)		
			,
			array('table' => 'tsk_applause_member',
					'alias' => 'ApplauseMember',					
					'type' => 'INNER',
					'conditions' => array('`TskRoa`.`id` = `ApplauseMember`.`tsk_applause_id`')
			)
			,
			array('table' => 'app_users',
					'alias' => 'Homes2',					
					'type' => 'INNER',
					'conditions' => array('`ApplauseMember`.`app_users_id` = `Homes2`.`id`')
			),
			array('table' => 'tsk_applause_star',
					'alias' => 'TskStar',					
					'type' => 'LEFT',
					'conditions' => array('`TskStar`.`tsk_applause_id` = `TskRoa`.`id`')
			)
			,
			array('table' => 'tsk_applause_read',
					'alias' => 'TskRoaRead',					
					'type' => 'LEFT',
					'conditions' => array('`TskRoaRead`.`tsk_applause_id` = `TskRoa`.`id`', 'TskRoaRead.app_users_id' => $this->Session->read('USER.Login.id'),
					'TskRoaRead.status' => 'U')
			)
		);
			
		$this->TskRoa->virtualFields = array('status_order' => 'max(TskApplauseStatuses.status)');
					
	
		// fetch the advances		
		$this->paginate = array('fields' => array('id','reward_month', 'type', 'group_concat(Distinct TskStar.star_type) as star_type', 'status_order', 'count(Distinct TskRoaRead.id) as unread', "group_concat(Distinct Homes2.first_name SEPARATOR ', ') as roa_member", 'rating','attachment','created_date', 'group_concat(Distinct TskApplauseStatuses.status) as st_status', 'group_concat(Homes.first_name) as st_user', 'group_concat(Distinct TskApplauseStatuses.modified_date) as st_modified','group_concat(Distinct TskApplauseStatuses.created_date) as st_created', 'group_concat(Distinct TskApplauseStatuses.remarks) as st_remarks'),'limit' => 10,'conditions' => array($keyCond, $typeCond,'TskRoa.app_users_id' => $this->Session->read('USER.Login.id'),'TskRoa.is_deleted' => 'N'), 'order' => array('created_date' => 'desc'), 'group' => array('TskRoa.id'), 'joins' => $options);
		$data = $this->paginate('TskRoa');
		
		$this->set('roa_data', $data);
		if(empty($data)){
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>You have no ROA request found', 'default', array('class' => 'alert alert'));	
		}
		
		
	}
	
	
	
	/* function to download the file */
	public function download_attachment($file){	
		$this->download_file(WWW_ROOT.'/uploads/task/'.$file);
		die;
		
	}

	
	/* function to save the recommend */
	public function recommend(){ 
		// set the page title		
		$this->set('title_for_layout', 'Recommend ROA - Work Planner - My PDCA');
		// get team members
		$emp_list = $this->TskRoa->get_team($this->Session->read('USER.Login.id'),'T');
		$format_list = $this->Functions->format_dropdown($emp_list, 'u','id','first_name', 'last_name');		
		$this->set('empList', $format_list);
		// get roa category
		$this->get_roa_category();
		// when the form submitted
		if ($this->request->is('post')){ 
			// validates the form
			$this->TskRoa->set($this->request->data);
			// validate the file
			$this->TskRoa->validate_file();				
			if ($this->TskRoa->validates(array('fieldList' => array('type', 'employee1','employee2','emp_acts','rating','reward_month','applause_cat','emp_relate','upload_file')))) {				
				$this->request->data['TskRoa']['app_users_id'] = $this->Session->read('USER.Login.id');
				// format the dates to save					
				$rwd_month = explode('/', $this->request->data['TskRoa']['reward_month']);
				$this->request->data['TskRoa']['reward_month'] = $rwd_month[1].'-'.$rwd_month[0].'-01';
				$this->request->data['TskRoa']['created_date'] = $this->Functions->get_current_date();
				--$this->request->data['TskRoa']['rating'];
				// save the data
				if($this->TskRoa->save($this->request->data['TskRoa'])) {
					// upload the file
					if($file = $this->upload_attachment($this->request->data['TskRoa']['upload_file'], $this->TskRoa->id)){						
						$this->TskRoa->saveField('attachment', $file);
					}
					// save task roa members
					$member_data = $this->save_rao_member($this->request->data, $this->TskRoa->id);
					// save roa recommend
					$this->save_recommend($this->request->data, $this->TskRoa->id);
					// get the superiors
					$this->loadModel('Approval');
					$approval_data = $this->Approval->find('first', array('fields' => array('level1','auth_amount_l1'), 'conditions'=> array('Approval.app_users_id' => $this->Session->read('USER.Login.id'), 'type' => 'T')));
					// save finance req. status data
					$this->loadModel('TskApplauseStatus');
					$data = array('tsk_applause_id' => $this->TskRoa->id, 'created_date' => $this->Functions->get_current_date(), 'app_users_id' => $approval_data['Approval']['level1']);
					if(!empty($approval_data)){
						// make sure not duplicate status exists
						$this->check_duplicate_status($this->TskRoa->id, $approval_data['Approval']['level1']);
						// save in status table
						if($this->TskApplauseStatus->save($data, true, $fieldList = array('tsk_applause_id','created_date','app_users_id'))){						
							// save users
							$this->loadModel('TskApplauseUser');
							$user_data = array('tsk_applause_id' => $this->TskRoa->id, 'app_users_id' => $approval_data['Approval']['level1']);							
							$this->TskApplauseUser->id = '';
							$this->TskApplauseUser->save($user_data, true, $fieldList = array('tsk_applause_id','app_users_id'));							
							// show the msg.
							$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Your ROA request is created successfully', 'default', array('class' => 'alert alert-success'));
						}else{
							$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in saving ROA status', 'default', array('class' => 'alert alert-info'));
						}
					}else if($this->Session->read('USER.Login.app_roles_id') == '18'){
						// save approval status
						$this->TskRoa->id = $this->TskRoa->id;
						$this->TskRoa->saveField('is_approve', 'Y');
						// save request status
						$this->loadModel('TskApplauseStatus');
						$this->check_duplicate_status($this->TskRoa->id, $this->Session->read('USER.Login.id'));
						$data = array('status' => 'A','tsk_applause_id' => $this->TskRoa->id, 'created_date' => $this->Functions->get_current_date(), 'app_users_id' => $this->Session->read('USER.Login.id'));
						if($this->TskApplauseStatus->save($data, true, $fieldList = array('status','tsk_applause_id','created_date','app_users_id'))){	
							$this->loadModel('TskApplauseUser');
							$this->check_duplicate_user($this->TskRoa->id,  $this->Session->read('USER.Login.id'));
							// save adv. users
							$adv_user_data = array('tsk_applause_id' => $this->TskRoa->id, 'app_users_id' => $this->Session->read('USER.Login.id'));							
							$this->TskApplauseUser->id = '';
							$this->TskApplauseUser->save($adv_user_data, true, $fieldList = array('tsk_applause_id','app_users_id'));						
						}else{
							$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in saving superior status...', 'default', array('class' => 'alert alert-error'));
						}						
						// nofity employee
						$this->notify_employee($member_data);
						// update greetings
						$this->save_greeting($member_data, 'Round of Applause',$this->request->data['TskRoa']['reward_month']);
						$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Your ROA request is created and approved successfully', 'default', array('class' => 'alert alert-success'));
					}else{
						$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Oops! You have no approver to process your request. Pls contact administrator', 'default', array('class' => 'alert alert-error'));					

					}
					
					$this->redirect('/tskroa/');	
					
				}else{
					// show the error msg.
					$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in saving the data...', 'default', array('class' => 'alert alert-error'));					
				}
				
				
			}
		}
	}
	
		/* function to check the duplicate user */
	public function check_duplicate_user($id, $user_id){
		$count = $this->TskApplauseUser->find('count', array('conditions' => array('app_users_id' => $user_id, 'tsk_applause_id' => $id)));
		if($count > 0){	
			$this->invalid_attempt();
		}
	}
	
		/* function to notify roa to employee */
	public function notify_employee($data){		
		$this->loadModel('HrEmployee');
		foreach($data as $key => $value){
			$user_detail = $this->HrEmployee->findById($value, array('fields' => 'email_address','first_name','last_name'));
			$vars = array('name' => $user_detail['HrEmployee']['first_name'].' '.$user_detail['HrEmployee']['last_name'], 'msg' => 'Round of Applause');
			// notify employee						
			if(!$this->send_email('My PDCA - Congrats! You have been selected for Round of Applause this month', 'notify_applause_star', 'noreply@mypdca.in', $user_detail['HrEmployee']['email_address'], $vars)){		
				// show the msg.								
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in sending the mail to user...', 'default', array('class' => 'alert alert-error'));				
			}else{
					
			}
		}
	}
	
	/* function to save data in greetings */
	public function save_greeting($id, $msg, $month){
		if(!is_array){
			$data = array(0 => $id);
		}else{
			$data = $id;			
		}
		foreach($data as $val){
			// update in greetings			
			$this->loadModel('Share');
			$save_data = array('roa_month' => $month, 'share' => 'Congrats! You have been selected for <b>'. $msg. '</b>', 'created_date' => $this->Functions->get_current_date(),
			'modified_date' => $this->Functions->get_current_date(), 'app_users_id' => $val, 'type' => 'R', 'roa_type' => 'S');
			$this->Share->save($save_data, null);
			$this->Share->id = '';
		}
		
	}
	
	/* function to upload the file */
	public function upload_attachment($data, $id){
		// validate the file				
		if(!empty($data['tmp_name'])){
			$file = $id.'_'.$data['name']; 
			if($this->upload_file($data['tmp_name'], WWW_ROOT.'/uploads/task/'.$file)){
				return $file;
			}			
		}
				
	}
	
	/* function to save roa member */
	public function save_rao_member($data, $id){
		$this->loadModel('TskRoaMember');
		$employee = $data['TskRoa']['type'] == 'I' ? 'employee1' : 'employee2';
		if($data['TskRoa']['type'] == 'I'){		
			$data['TskRoa'][$employee] = array($data['TskRoa'][$employee]);
		}
		$return_data = $data['TskRoa'][$employee];
		foreach($data['TskRoa'][$employee] as $rec){
			$data = array('tsk_applause_id' => $id, 'app_users_id' => $rec);
			$this->TskRoaMember->save($data);
			$this->TskRoaMember->id = '';
		}
		return $return_data;
	}
	
		/* function to save recommend for */
	public function save_recommend($data, $id){
		$this->loadModel('TskRoaCatUser');
		foreach($data['TskRoa']['applause_cat'] as $rec){
			$data = array('tsk_applause_category_id' => $rec, 'tsk_applause_id' => $id);
			$this->TskRoaCatUser->save($data);
			$this->TskRoaCatUser->id = '';
		}
	}
	
	/* function to get ROA category */
	public function get_roa_category(){
		$this->loadModel('TskRoaCat');
		$cat_list = $this->TskRoaCat->find('list', array('fields' => array('id','title'), 'order' => array('id ASC'),'conditions' => array('is_deleted' => 'N', 'status' => '1')));
		$this->set('catList', $cat_list);
	}
	


	
	/* function to check for duplicate entry */
	public function check_duplicate_status($fin_id, $app_user_id, $update){
		$count = $this->TskApplauseStatus->find('count',  array('conditions' => array('TskApplauseStatus.tsk_applause_id' => $fin_id, 'TskApplauseStatus.app_users_id' => $app_user_id)));
		// when the user is updating the request
		if($update){
			$cnt_cond = 1;
		}else{
			$cnt_cond = 0;
		}
		if($count > $cnt_cond){
			$this->invalid_attempt();
		}
		
	}
	
	
	/* function to save the todo item */
	public function reply_task(){
		$this->layout = 'ajax';		
		if ($this->request->is('post') && $this->request->data['reply'] != '') { 
			$data = array('tsk_applause_id' => $this->request->query['id'], 'desc' => trim($this->request->data['reply']), 'created_date' => $this->Functions->get_current_date(), 'app_users_id' => $this->Session->read('USER.Login.id'));		
			$this->loadModel('TskRoaReply');			
			// update the todo
			if($this->TskRoaReply->save($data, true, $fieldList = array('tsk_applause_id', 'desc','created_date','app_users_id'))){		
				$this->get_task_reply($this->request->query['id']);
				// get approval data
				$approval_data = $this->get_approval_data();
				// update unread status
				$this->loadModel('TskRoaRead');
				// check record exists or not
				$count = $this->TskRoaRead->find('count', array('conditions' => array('app_users_id' => $approval_data['Approval']['level1'], 'tsk_applause_id' => $this->request->query['id'])));
				if(!$count){
					$data = array('status' => 'U', 'created_date' => $this->Functions->get_current_date(), 'app_users_id' => $approval_data['Approval']['level1'], 'tsk_applause_id' => $this->request->query['id']);
					$this->TskRoaRead->save($data);
				}else{
					$this->TskRoaRead->updateAll(array('status' => "'U'", 'modified_date' => '"'.$this->Functions->get_current_date().'"'), array('tsk_applause_id' => $this->request->query['id'], 'app_users_id' => $approval_data['Approval']['level1']));
				}
			}
		}
		$this->render('/Elements/reply_roa');	
	}
	
		/* function to get approval data */
	public function get_approval_data(){
		$this->loadModel('Approval');
		return $approval_data = $this->Approval->find('first', array('fields' => array('level1'), 'conditions'=> array('Approval.app_users_id' => $this->Session->read('USER.Login.id'), 'type' => 'T')));
	}
	
		/* get the reply of tasks */
	public function get_task_reply($id){
		$data = $this->TskRoaReply->find('all', array('conditions' => array('tsk_applause_id' => $id), 'fields' => array('desc','created_date', 'HrEmployee.first_name'),
		'order' => array('created_date' => 'desc')));
		$this->set('reply_data', $data);
	}
	
	
	
	/* function to auth record */
	public function auth_action($id){
		$data = $this->TskRoa->findById($id, array('fields' => 'app_users_id','is_deleted'));	
		// check the req belongs to the user
		if($data['TskRoa']['is_deleted'] == 'Y'){
			return 'deleted';
		}		
		else if($data['TskRoa']['app_users_id'] == $this->Session->read('USER.Login.id')){	
			return 'pass';
		}else{
			return 'fail';
		}
	}
	
	/* function to view the adv. request */
	public function view($id){
		$this->layout = 'iframe';
		// set the page title		
		$this->set('title_for_layout', 'View ROA - Work Planner - My PDCA');
		if(!empty($id) && intval($id)){
			// authorize user before action
			$ret_value = $this->auth_action($id);
			if($ret_value == 'pass'){
				$options = array(		
					
					array('table' => 'tsk_applause_member',
							'alias' => 'ApplauseMember',					
							'type' => 'INNER',
							'conditions' => array('`TskRoa`.`id` = `ApplauseMember`.`tsk_applause_id`')
					)
					,
					array('table' => 'app_users',
							'alias' => 'Homes2',					
							'type' => 'INNER',
							'conditions' => array('`ApplauseMember`.`app_users_id` = `Homes2`.`id`')
					),
					array('table' => 'tsk_applause_star',
							'alias' => 'TskStar',					
							'type' => 'LEFT',
							'conditions' => array('`TskStar`.`tsk_applause_id` = `TskRoa`.`id`')
					),
					array('table' => 'tsk_applause_cat_user',
							'alias' => 'TskRoaCatUser',					
							'type' => 'INNER',
							'conditions' => array('`TskRoaCatUser`.`tsk_applause_id` = `TskRoa`.`id`')
					),
					array('table' => 'tsk_applause_category',
							'alias' => 'TskRoaCat',					
							'type' => 'INNER',
							'conditions' => array('`TskRoaCatUser`.`tsk_applause_category_id` = `TskRoaCat`.`id`')
					),
					array('table' => 'app_users',
							'alias' => 'Employee',					
							'type' => 'INNER',
							'conditions' => array('`Employee`.`id` = `TskRoa`.`app_users_id`')
					),
					array('table' => 'hr_business_unit',
							'alias' => 'BusinessUnit',					
							'type' => 'LEFT',
							'conditions' => array('`BusinessUnit`.`id` = `Homes2`.`hr_business_unit_id`')
					),
					array('table' => 'hr_department',
							'alias' => 'Department',					
							'type' => 'LEFT',
							'conditions' => array('`Department`.`id` = `Homes2`.`hr_department_id`')
					),
					array('table' => 'hr_branch',
							'alias' => 'Branch',					
							'type' => 'LEFT',
							'conditions' => array('`Branch`.`id` = `Homes2`.`hr_branch_id`')
					)
				);
				$data = $this->TskRoa->find('all', array('fields' => array('id','reward_month', 'group_concat(Distinct TskStar.star_type) as star_type', 'is_approve','rating','emp_acts','emp_relate','attachment','type','Employee.first_name', 'TskRoa.created_date',
				"group_concat(Distinct Homes2.first_name SEPARATOR ', ') as roa_member",'group_concat(Branch.branch_name) as branch', 'group_concat(Department.dept_name) as dept', 'group_concat(BusinessUnit.business_unit) as bus_unit', "group_concat(Distinct TskRoaCat.title SEPARATOR ', ') as roa_category"),'conditions' => array('TskRoa.id' => $id), 'joins' => $options));
				$this->set('roa_data', $data[0]);
				// fetch task replies
				$this->loadModel('TskRoaReply');
				$this->get_task_reply($id);
				// view read status
				$this->loadModel('TskRoaRead');
				$this->TskRoaRead->updateAll(array('status' => "'R'", 'modified_date' => '"'.$this->Functions->get_current_date().'"'), array('tsk_applause_id' => $id, 'app_users_id' => $this->Session->read('USER.Login.id')));
			}else if($ret_value == 'fail'){ 
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/tskroa/');	
			}else{
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Record Deleted' , 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/tskroa/');	
			}
		}else{
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));		
			$this->redirect('/tskroa/');	
		}
		
		
	}
	
	/* clear the cache */
	
	public function beforeFilter() { 
		//$this->disable_cache();
		$this->show_tabs(89);
		
	}
	
		

	
	
	
}