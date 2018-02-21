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
class TskroaapproveController extends AppController {  
	
	public $name = 'TskRoaApprove';	
	
	public $helpers = array('Html', 'Form', 'Session');
	
	public $components = array('Session', 'Functions');
	
	public $layout = 'apps';	

	/* function to list the adv. requests */
	public function index(){	
		// set the page title
		$this->set('title_for_layout', 'Approve ROA - Work Planner - My PDCA');
		$this->set('star_options', array('M' => 'Star of the Month', 'Q' => 'Star of the Quarter', 'C' => 'Champion of CareerTree'));
		// get employee list		
		$emp_list = $this->TskRoaApprove->get_team($this->Session->read('USER.Login.id'),'A', '1');
		$format_list = $this->Functions->format_dropdown($emp_list, 'u','id','first_name', 'last_name');		
		$this->set('empList', $format_list);
		
		$options = array(			
			array('table' => 'tsk_applause_status',
					'alias' => 'TskApplauseStatuses',					
					'type' => 'LEFT',
					'conditions' => array('`TskApplauseStatuses`.`tsk_applause_id` = `TskRoaApprove`.`id`')
			),
			array('table' => 'app_users',
					'alias' => 'Homes',					
					'type' => 'LEFT',
					'conditions' => array('`TskApplauseStatuses`.`app_users_id` = `Homes`.`id`')
			),
			
			array('table' => 'app_users',
					'alias' => 'Homes2',					
					'type' => 'LEFT',
					'conditions' => array('`TskRoaApprove`.`app_users_id` = `Homes2`.`id`')
			)
			,
			array('table' => 'tsk_applause_member',
					'alias' => 'ApplauseMember',					
					'type' => 'INNER',
					'conditions' => array('`TskRoaApprove`.`id` = `ApplauseMember`.`tsk_applause_id`')
			)
			,
			array('table' => 'app_users',
					'alias' => 'Homes3',					
					'type' => 'INNER',
					'conditions' => array('`ApplauseMember`.`app_users_id` = `Homes3`.`id`')
			),
			array('table' => 'tsk_applause_star',
					'alias' => 'TskStar',					
					'type' => 'LEFT',
					'conditions' => array('`TskStar`.`tsk_applause_id` = `TskRoaApprove`.`id`')
			),
			array('table' => 'tsk_applause_read',
					'alias' => 'TskRoaRead',					
					'type' => 'LEFT',
					'conditions' => array('`TskRoaRead`.`tsk_applause_id` = `TskRoaApprove`.`id`', 'TskRoaRead.app_users_id' => $this->Session->read('USER.Login.id'),
					'TskRoaRead.status' => 'U')
			)
		);
			
		// when the form is submitted for search
		if($this->request->is('post')){
			$url_vars = $this->Functions->create_url(array('month_start','month_end','type'),'TskRoaApprove'); 
			$this->redirect('/tskroaapprove/?'.$url_vars);			
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
		
		
		$this->TskRoaApprove->unBindModel(array('hasOne' => array('TskApplauseStatus')));
		
			
		$this->TskRoaApprove->virtualFields = array('first_name' => 'Home2.first_name', 'status_order' => 'max(TskApplauseStatuses.status)');
		
		// fetch the advances		
		$this->paginate = array('fields' => array('id','reward_month', 'status_order', 'group_concat(Distinct TskStar.star_type) as star_type',  'count(Distinct TskRoaRead.id) as unread', 'Homes2.id', 'Homes2.first_name','Homes2.last_name','type','max(TskApplauseStatuses.id) as status_id', "group_concat(Distinct Homes3.first_name SEPARATOR ', ') as roa_member", 'rating','attachment','created_date', 'group_concat(Distinct TskApplauseStatuses.status) as st_status', 'group_concat(Homes.first_name) as st_user', 'group_concat(Distinct TskApplauseStatuses.modified_date) as st_modified','group_concat(Distinct TskApplauseStatuses.created_date) as st_created', 'group_concat(Distinct TskApplauseStatuses.remarks) as st_remarks'),'limit' => 10,'conditions' => array($keyCond, $typeCond,'TskApplauseUser.app_users_id' => $this->Session->read('USER.Login.id'),'TskRoaApprove.is_deleted' => 'N'),  'group' => array('TskRoaApprove.id'), 'order' => array('is_approve' => 'asc', 'created_date' => 'desc'), 'joins' => $options);
		$data = $this->paginate('TskRoaApprove');
		$this->set('roa_data', $data);
		
		// hide verify icon display
		foreach($data as $roa_rec){ 
			$show_st = $this->auth_action($roa_rec['TskRoaApprove']['id'], $roa_rec[0]['status_id']);			
			$status_id[] = $show_st;				
		}
		$this->set('show_status', $status_id);
		
		if(empty($data)){
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>You have no requests to approve', 'default', array('class' => 'alert alert'));	
		}
		
		
	}
	
	/* function to process the request */
	public function process_req($req_id, $st_id, $status,$user_id){ 
		$data = array('modified_date' => $this->Functions->get_current_date(), 'modified_by' => $this->Session->read('USER.Login.id'), 'remarks' => $this->request->query['remark'], 'status' => $status);
		$this->TskRoaApprove->TskApplauseStatus->id = $st_id;
		$st_msg = $status == 'A' ? 'approved' : 'rejected';
		// make sure not duplicate status exists
		$this->check_duplicate_status($req_id, $this->Session->read('USER.Login.id'), 1);
		// save the finance adv. status
		if($this->TskRoaApprove->TskApplauseStatus->save($data, true, $fieldList = array('modified_by','modified_date','remarks','status'))){
			// get user data
			$user_data = $this->TskRoaApprove->HrEmployee->find('first', array('conditions' => array('HrEmployee.id' => $user_id),'fields' => array('email_address','first_name', 'last_name')));
			// get advance details
			$options = array(			
				array('table' => 'tsk_applause_member',
						'alias' => 'ApplauseMember',					
						'type' => 'INNER',
						'conditions' => array('`TskRoaApprove`.`id` = `ApplauseMember`.`tsk_applause_id`')
				)
				,
				array('table' => 'app_users',
						'alias' => 'Homes3',					
						'type' => 'INNER',
						'conditions' => array('`ApplauseMember`.`app_users_id` = `Homes3`.`id`')
				)
			);
			$req_detail = $this->TskRoaApprove->find('all', array('fields' => array('reward_month',"group_concat(Distinct Homes3.id) as roa_user",
			"group_concat(Homes3.email_address) as roa_email","group_concat(Homes3.first_name SEPARATOR ', ') as roa_member",'type'),
			'conditions' => array('TskRoaApprove.id' => $req_id), 'joins' => $options));
			$req_data = $req_detail[0];
			$vars = array('name' => $user_data['HrEmployee']['first_name'].' '.$user_data['HrEmployee']['last_name'], 'date' => $req_data['TskRoaApprove']['reward_month'], 'roa_member' => $req_data[0]['roa_member'], 'type' => $req_data['TskRoaApprove']['type'], 'remarks' => $this->request->query['remark'], 'status' => $st_msg, 'employee' => $user_data['HrEmployee']['first_name'].' '.$user_data['HrEmployee']['last_name']);
			// notify employee						
			if(!$this->send_email('My PDCA - Your ROA request is '.$st_msg.' by '.ucfirst($this->Session->read('USER.Login.first_name')).' '.ucfirst($this->Session->read('USER.Login.last_name')), 'notify_applause', 'noreply@mypdca.in', $user_data['HrEmployee']['email_address'],$vars)){		
				// show the msg.								
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in sending the mail to user...', 'default', array('class' => 'alert alert-error'));				
			}else{								
				}
			
			// get the superiors
			$this->loadModel('Approval');
			// if record approved
			if($status == 'A'){					
				$approval_data = $this->Approval->find('first', array('fields' => array('level2'), 'conditions'=> array('Approval.app_users_id' => $user_id, 'type' => 'T')));
				// make sure level 2 is not empty
				if(!empty($approval_data['Approval']['level2'])){
					// check level 2 is not empty and its not the same user
					if($approval_data['Approval']['level2'] != $this->Session->read('USER.Login.id')){ 	
						// get superior level 2 details				
						$superior_data = $this->TskRoaApprove->HrEmployee->find('first', array('conditions' => array('HrEmployee.id' => $approval_data['Approval']['level2']),'fields' => array('email_address','first_name', 'last_name')));
						$data = array('tsk_applause_id' => $req_id, 'created_date' => $this->Functions->get_current_date(), 'app_users_id' => $approval_data['Approval']['level2']);
						// save leve 2 if found
						$this->TskRoaApprove->TskApplauseStatus->id = '';
						
						// make sure not duplicate status exists
						$this->check_duplicate_status($req_id, $approval_data['Approval']['level2'], 0);
						
						if($this->TskRoaApprove->TskApplauseStatus->save($data, true, $fieldList = array('tsk_applause_id','created_date','app_users_id'))){	
							$this->check_duplicate_user($req_id,  $approval_data['Approval']['level2']);
							// save adv. users
							$adv_user_data = array('tsk_applause_id' => $req_id, 'app_users_id' => $approval_data['Approval']['level2']);							
							$this->TskRoaApprove->TskApplauseUser->id = '';
							$this->TskRoaApprove->TskApplauseUser->save($adv_user_data, true, $fieldList = array('tsk_applause_id','app_users_id'));						
						}else{
							$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in saving superior status...', 'default', array('class' => 'alert alert-error'));
						}
					}else{
						// update advance status when l2 approves
						$this->TskRoaApprove->id = $req_id;
						$this->TskRoaApprove->saveField('is_approve', 'Y');
						// nofity employee
						$this->notify_employee($req_data[0]['roa_member'], $req_data[0]['roa_email']);
						// update greetings
						$this->save_greeting($req_data[0]['roa_user'], 'Round of Applause',$req_data['TskRoaApprove']['reward_month']);
					}
				}else{
					// update advance status
					$this->TskRoaApprove->id = $req_id;
					$this->TskRoaApprove->saveField('is_approve', 'Y');
					// nofity employee
					$this->notify_employee($req_data[0]['roa_member'], $req_data[0]['roa_email']);
					// update greetings
					$this->save_greeting($req_data[0]['roa_user'], 'Round of Applause',$req_data['TskRoaApprove']['reward_month']);
				}
				
			}else{			
				// update advance status
				$this->TskRoaApprove->id = $req_id;
				$this->TskRoaApprove->saveField('is_approve', 'R');				
			}			
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>ROA request is '.$st_msg.' successfully', 'default', array('class' => 'alert alert-success'));
		}else{
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Problem in updating the status', 'default', array('class' => 'alert alert-error'));		
		}
		$this->redirect('/tskroaapprove/view/'.$this->request->params['pass'][0].'/'.$this->request->params['pass'][1].'/'.$this->request->params['pass'][3].'/?refresh=1');	
	}
	
	
	
	/* function to process the request */
	public function change_status($id, $type, $user_id, $st_id){ 
		$data = array('created_date' => $this->Functions->get_current_date(), 'created_by' => $this->Session->read('USER.Login.id'), 'star_type' => $type,
		'tsk_applause_id' => $id);
		$this->loadModel('TskRoaStar');
		if($this->TskRoaStar->save($data, true, $fieldList = array('star_type','created_date','created_by','tsk_applause_id'))){			
			// get user data
			/*$options = array(			
				array('table' => 'tsk_applause_member',
						'alias' => 'ApplauseMember',					
						'type' => 'INNER',
						'conditions' => array('`TskRoaApprove`.`id` = `ApplauseMember`.`tsk_applause_id`')
				)
				,
				array('table' => 'app_users',
						'alias' => 'Employee',					
						'type' => 'INNER',
						'conditions' => array('`ApplauseMember`.`app_users_id` = `Employee`.`id`')
				)
			);
			*/
			
			$this->TskRoaApprove->unBindModel(array('hasOne' => array('TskApplauseStatus','TskApplauseUser')));
			$user_data = $this->TskRoaApprove->HrEmployee->find('all', array('conditions' => array('HrEmployee.id' => $this->request->data['team_member']),
			'fields' => array('HrEmployee.id', 'HrEmployee.first_name', 'HrEmployee.last_name', 'HrEmployee.email_address'),'group' => array('HrEmployee.id')));	
		
			$st_msg = $this->get_star_msg($type);
			// send mail and updte in greetings
			foreach($user_data as $user){ 			
				// update in greetings
				$this->save_greeting($user['HrEmployee']['id'], $st_msg,$this->request->data['reward_month']);
				$vars = array('name' => $user['HrEmployee']['first_name'].' '.$user['HrEmployee']['last_name'], 'msg' => $st_msg);
				// notify employee						
				if(!$this->send_email('My PDCA - Congrats! You have been selected as - '.$st_msg, 'notify_applause_star', 'noreply@mypdca.in', $user['HrEmployee']['email_address'],$vars)){		
					// show the msg.								
					$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in sending the mail to user...', 'default', array('class' => 'alert alert-error'));				
				}else{
					
				}
			}
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>'.$st_msg.' set successfully', 'default', array('class' => 'alert alert-success'));

			$this->redirect('/tskroaapprove/view/'.$id.'/'.$st_id.'/'.$user_id.'/?refresh=1');
			
		}
	}
	
	
	/* function to notify roa to employee */
	public function notify_employee($name, $email){
		$email_address = explode(',', $email);
		$first_name = explode(',', $name);
		foreach($email_address as $key => $mail){
			$vars = array('name' => $first_name[$key], 'msg' => 'Round of Applause');
			// notify employee						
			if(!$this->send_email('My PDCA - Congrats! You have been selected for Round of Applause this month', 'notify_applause_star', 'noreply@mypdca.in', $mail, $vars)){		
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
			$data = explode(',', $id);			
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
	
	
	/* function to get start message */
	public function get_star_msg($type){
		switch($type){
			case 'M':
			$msg = 'Star of the Month';
			break;
			case 'Q':
			$msg = 'Star of the Quarter';
			break;
			case 'C':
			$msg = 'Champion of Career Tree';
			break;
		}
		return $msg;	
	}
	
	
	
	
	
	
	
	/* function to check the duplicate user */
	public function check_duplicate_user($id, $user_id){
		$this->loadModel('TskApplauseUser');
		$count = $this->TskApplauseUser->find('count', array('conditions' => array('app_users_id' => $user_id, 'tsk_applause_id' => $id)));
		if($count > 0){	
			$this->invalid_attempt();
		}
	}
	
	/* function to check for duplicate entry */
	public function check_duplicate_status($fin_id, $app_user_id, $update){
		$count = $this->TskRoaApprove->TskApplauseStatus->find('count',  array('conditions' => array('TskApplauseStatus.tsk_applause_id' => $fin_id, 'TskApplauseStatus.app_users_id' => $app_user_id)));
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
	
	
	
	/* function to auth record */
	public function auth_action($id,$st_id, $view){
		$data = $this->TskRoaApprove->TskApplauseStatus->findById($st_id, array('fields' => 'app_users_id', 'status'));	
		// check the req belongs to the user
		if($data['TskApplauseStatus']['app_users_id'] == $this->Session->read('USER.Login.id') && $data['TskApplauseStatus']['status'] == 'W'){	
			return 'pass';
		}else if($view == 1){ // for view mode only
			$data = $this->TskRoaApprove->TskApplauseStatus->find('first', array('fields' => array('app_users_id'), 'conditions' => array('app_users_id' => $data['TskApplauseStatus']['app_users_id'], 'tsk_applause_id' => $id), 'limit' => 1));
			if(!empty($data)){
				return 'view_only';
			}
		}else{
			return 'fail';
		}
	}
	
	/* function to view the adv. request */
	public function view($id,$st_id,$user_id){
		$this->layout = 'iframe';
		// set the page title		
		$this->set('title_for_layout', 'View ROA - Work Planner - My PDCA');
		if(!empty($id) && intval($id)){
			// authorize user before action
			$ret_value = $this->auth_action($id,$st_id, 1);
			if($ret_value == 'pass'  || $ret_value == 'view_only'){
				// for view mode
				if($ret_value == 'view_only'){					
					$this->set('VIEW_ONLY', 1);
				}
				$options = array(					
					array('table' => 'tsk_applause_member',
							'alias' => 'ApplauseMember',					
							'type' => 'INNER',
							'conditions' => array('`TskRoaApprove`.`id` = `ApplauseMember`.`tsk_applause_id`')
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
							'conditions' => array('`TskStar`.`tsk_applause_id` = `TskRoaApprove`.`id`')
					),
					array('table' => 'tsk_applause_cat_user',
							'alias' => 'TskRoaCatUser',					
							'type' => 'INNER',
							'conditions' => array('`TskRoaCatUser`.`tsk_applause_id` = `TskRoaApprove`.`id`')
					),
					array('table' => 'tsk_applause_category',
							'alias' => 'TskRoaCat',					
							'type' => 'INNER',
							'conditions' => array('`TskRoaCatUser`.`tsk_applause_category_id` = `TskRoaCat`.`id`')
					),
					array('table' => 'app_users',
							'alias' => 'Employee',					
							'type' => 'INNER',
							'conditions' => array('`Employee`.`id` = `TskRoaApprove`.`app_users_id`')
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
				$data = $this->TskRoaApprove->find('all', array('fields' => array('id','reward_month','group_concat(Distinct Homes2.id) as emp_id', 'group_concat(Distinct TskStar.star_type) as star_type', 'rating','is_approve','emp_acts','emp_relate','attachment','type','Employee.first_name', 'TskRoaApprove.created_date',
				"group_concat(Distinct Homes2.first_name SEPARATOR ', ') as roa_member",'group_concat(Branch.branch_name) as branch', 'group_concat(Department.dept_name) as dept', 'group_concat(BusinessUnit.business_unit) as bus_unit',  "group_concat(Distinct TskRoaCat.title SEPARATOR ', ') as roa_category"),'conditions' => array('TskRoaApprove.id' => $id), 'joins' => $options));
				$this->set('roa_data', $data[0]);
				// get task replies
				$this->loadModel('TskRoaReply');
				$this->get_task_reply($id);
				// view read status
				$this->loadModel('TskRoaRead');
				$this->TskRoaRead->updateAll(array('status' => "'R'", 'modified_date' => '"'.$this->Functions->get_current_date().'"'), array('tsk_applause_id' => $id, 'app_users_id' => $this->Session->read('USER.Login.id')));
			}else if($ret_value == 'fail'){ 
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/tskroaapprove/');	
			}else{
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Record Deleted' , 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/tskroaapprove/');	
			}
		}else{
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));		
			$this->redirect('/tskroaapprove/');	
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
				// get task owner
				$creator_data = $this->get_request_creator($this->request->query['id']);
				// update unread status
				$this->loadModel('TskRoaRead');
				// check record exists or not
				$count = $this->TskRoaRead->find('count', array('conditions' => array('app_users_id' => $creator_data['TskRoaApprove']['app_users_id'], 'tsk_applause_id' => $this->request->query['id'])));
				if(!$count){
					$data = array('status' => 'U', 'created_date' => $this->Functions->get_current_date(), 'app_users_id' => $creator_data['TskRoaApprove']['app_users_id'], 'tsk_applause_id' => $this->request->query['id']);
					$this->TskRoaRead->save($data);
				}else{
					$this->TskRoaRead->updateAll(array('status' => "'U'", 'modified_date' => '"'.$this->Functions->get_current_date().'"'), array('tsk_applause_id' => $this->request->query['id'], 'app_users_id' => $creator_data['TskRoaApprove']['app_users_id']));
				}				
			}
		}
		$this->render('/Elements/reply_roa');	
	}
	
	
	
	
		/* function to get approval data */
	public function get_request_creator($id){
		return $tsk_creator = $this->TskRoaApprove->findById($id, array('fields' => 'app_users_id'));
	}
	
	/* get the reply of tasks */
	public function get_task_reply($id){
		$data = $this->TskRoaReply->find('all', array('conditions' => array('tsk_applause_id' => $id), 'fields' => array('desc','TskRoaReply.created_date', 'HrEmployee.first_name'),
		'order' => array('created_date' => 'desc')));
		$this->set('reply_data', $data);
	}
	
	/* clear the cache */
	
	public function beforeFilter() { 
		//$this->disable_cache();
		$this->show_tabs(91);
		// check module access
		
	}
	
	
	
	
}