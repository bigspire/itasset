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
class HrperapproveController extends AppController {  
	
	public $name = 'HrPerApprove';	
	
	public $helpers = array('Html', 'Form', 'Session');
	
	public $components = array('Session', 'Functions');
	
	public $layout = 'apps';	

	/* function to list the adv. requests */
	public function index(){	
		// set the page title
		$this->set('title_for_layout', 'Approve Permission - HRIS - My PDCA');
		
		// get employee list
		
		$emp_list = $this->HrPerApprove->get_team($this->Session->read('USER.Login.id'),'L');
		$format_list = $this->Functions->format_dropdown($emp_list, 'u','id','first_name', 'last_name');		
		
		$this->set('empList', $format_list);
		
		$options = array(			
			array('table' => 'hr_permission_status',
					'alias' => 'HrPermissionStatuses',					
					'type' => 'LEFT',
					'conditions' => array('`HrPermissionStatuses`.`hr_permission_id` = `HrPerApprove`.`id`')
			),
			array('table' => 'app_users',
					'alias' => 'Homes',					
					'type' => 'LEFT',
					'conditions' => array('`HrPermissionStatuses`.`app_users_id` = `Homes`.`id`')
			),
			
			array('table' => 'app_users',
					'alias' => 'Home2',					
					'type' => 'LEFT',
					'conditions' => array('`HrPerApprove`.`app_users_id` = `Home2`.`id`')
			)
		);
			
		// when the form is submitted for search
		if($this->request->is('post')){
			$url_vars = $this->Functions->create_url(array('keyword','emp_id','from','to'),'HrPerApprove'); 
			$this->redirect('/hrperapprove/?'.$url_vars);			
		}					
		$this->HrPerApprove->unBindModel(array('hasOne' => array('HrPerStatus')));
		
		if($this->params->query['keyword'] != ''){
			$keyCond = array("MATCH (reason) AGAINST ('".$this->params->query['keyword']."' IN BOOLEAN MODE)"); 
		}
		if($this->params->query['emp_id'] != ''){
			$empCond = array('HrPerApprove.app_users_id' => $this->params->query['emp_id']); 
		}
		// for date search
		if($this->params->query['from'] != '' || $this->params->query['to'] != ''){
			$from = $this->Functions->format_date_save($this->params->query['from']);
			$to = $this->Functions->format_date_save($this->params->query['to']);
			
			$dateCond = array('or' => array('per_from between ? and ?' => array($from, $to),'per_to between ? and ?' => array($from, $to))); 
		}
		
		$this->HrPerApprove->virtualFields = array('first_name' => 'Home2.first_name');
		
		// fetch the advances		
		$this->paginate = array('fields' => array('id','per_from','per_date', 'per_to','reason', 'no_hrs', 'created_date','max(HrPermissionStatuses.id) as status_id','group_concat(HrPermissionStatuses.status) as st_status', 'group_concat(HrPermissionStatuses.created_date) as st_created', 'group_concat(Homes.first_name) as st_user','group_concat(HrPermissionStatuses.modified_date) as st_modified','group_concat(HrPermissionStatuses.remarks) as st_remarks', 'Homes.id', 'Home2.id', 'Home2.first_name','Home2.last_name',  'Homes.first_name','Homes.last_name'),'limit' => 10,'conditions' => array($keyCond, $empCond, $dateCond, 'HrPerUser.app_users_id' => $this->Session->read('USER.Login.id'),'HrPerApprove.is_deleted' => 'N'),  'group' => array('HrPerApprove.id'), 'order' => array('HrPerApprove.is_approve' => 'asc', 'created_date' => 'desc'), 'joins' => $options);
		$data = $this->paginate('HrPerApprove');
		
		$this->set('perm_data', $data);
		
		// hide verify icon display
		foreach($data as $hr_permission){ 
			$show_st = $this->auth_action($hr_permission['HrPerApprove']['id'], $hr_permission[0]['status_id']);			
			$status_id[] = $show_st;				
		}
		$this->set('show_status', $status_id);
		
		if(empty($data)){
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>You have no permissions to approve', 'default', array('class' => 'alert alert'));	
		}
		
		
	}
	
	
	
	/* function to process the leave */
	public function process_adv($perm_id, $st_id, $status,$user_id){ 
		$data = array('modified_date' => $this->Functions->get_current_date(), 'modified_by' => $this->Session->read('USER.Login.id'), 'remarks' => $this->request->query['remark'], 'status' => $status);
		$this->HrPerApprove->HrPerStatus->id = $st_id;
		$st_msg = $status == 'A' ? 'approved' : 'rejected';
		// make sure not duplicate status exists
		$this->check_duplicate_status($perm_id, $this->Session->read('USER.Login.id'), 1);
		// save the finance adv. status
		if($this->HrPerApprove->HrPerStatus->save($data, true, $fieldList = array('modified_by','modified_date','remarks','status'))){
			// get user data
			$user_data = $this->HrPerApprove->Home->find('first', array('conditions' => array('Home.id' => $user_id),'fields' => array('email_address','first_name', 'last_name')));
			// get leave details
			$req_data = $this->HrPerApprove->findById($perm_id, array('fields' => 'per_from','per_to', 'per_date', 'no_hrs', 'reason'));
			
			$vars = array('name' => $user_data['Home']['first_name'].' '.$user_data['Home']['last_name'],  'remarks' => $this->request->query['remark'], 'status' => $st_msg, 'req_date' => $req_data['HrPerApprove']['req_date'],'employee' => $user_data['Home']['first_name'].' '.$user_data['Home']['last_name'],'reason' => $req_data['HrPerApprove']['reason'], 'per_from' => $req_data['HrPerApprove']['per_from'], 'per_to' => $req_data['HrPerApprove']['per_to'],  'per_date' => $req_data['HrPerApprove']['per_date'], 'nohrs' => $req_data['HrPerApprove']['no_hrs']);
			// notify employee						
			if(!$this->send_email('My PDCA - Your permission request is '.$st_msg.' by '.ucfirst($this->Session->read('USER.Login.first_name')).' '.ucfirst($this->Session->read('USER.Login.last_name')), 'notify_permission', 'noreply@mypdca.in', $user_data['Home']['email_address'],$vars)){		
				// show the msg.								
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in sending the mail to user...', 'default', array('class' => 'alert alert-error'));				
			}else{								
				}
			
			// get the superiors
			$this->loadModel('Approval');
			// if record approved
			if($status == 'R'){			
				// update leave status
				$this->HrPerApprove->id = $perm_id;
				$this->HrPerApprove->saveField('is_approve', 'R');
			
				$approval_data = $this->Approval->find('first', array('fields' => array('level1','level2'), 'conditions'=> array('Approval.app_users_id' => $user_id, 'type' => 'A')));
				if($approval_data['Approval']['level1'] == $this->Session->read('USER.Login.id')){
					$mail_user = $approval_data['Approval']['level2'];
				}else{
					$mail_user = $approval_data['Approval']['level1'];
				}
				
				// get superior data
				$superior_data = $this->HrPerApprove->Home->find('first', array('conditions' => array('Home.id' => $mail_user),'fields' => array('email_address','first_name', 'last_name')));
				// make sure superior available
				if(!empty($superior_data)){
					// notify employee						
					if(!$this->send_email('My PDCA - Permission request is rejected by '.ucfirst($this->Session->read('USER.Login.first_name')).' '.ucfirst($this->Session->read('USER.Login.last_name')), 'notify_permission', 'noreply@mypdca.in', $superior_data['Home']['email_address'],$vars)){		
						// show the msg.								
						$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in sending the mail to user...', 'default', array('class' => 'alert alert-error'));				
					}else{								
						}
				}
				
			}else{
				// update leave status
				$this->HrPerApprove->id = $perm_id;
				$this->HrPerApprove->saveField('is_approve', 'Y');
				// send mail to finance manager
				$this->notify_hr($user_data, $req_data);
			}			
			
		
				
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Permission request is '.$st_msg.' successfully', 'default', array('class' => 'alert alert-success'));
		}else{
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Problem in updating the status', 'default', array('class' => 'alert alert-error'));		
		}
		$this->redirect('/hrperapprove/');	
	}
	
	
	
	/* function to notify finance */
	public function notify_hr($user_data,$req_data, $reject){
		$fin_data = $this->HrPerApprove->Home->find('all', array('fields' => array('id','email_address', 'first_name','last_name'), 'conditions' => array('hr_department_id' => '14')));			
		// iterate finance team
			foreach($fin_data as $fin){	
				// check the same user
				if($this->Session->read('USER.Login.id') != $fin['Home']['id']){
					// change the subject
					if($reject == 1){
						$status = 'rejected';
					}else{
						$status = 'approved';
					}
					$sub = 'My PDCA - Permission request is '.$status.' by '.ucfirst($this->Session->read('USER.Login.first_name')).' '.ucfirst($this->Session->read('USER.Login.last_name'));
					$template = 'notify_permission';
					$from = ucfirst($this->Session->read('USER.Login.first_name')).' '.ucfirst($this->Session->read('USER.Login.last_name'));
					$name = $fin['Home']['first_name'].' '.$fin['Home']['last_name'];
					
					$vars = array('from_name' => $from, 'status' => $status,'name' => $name, 'reason' => $req_data['HrPerApprove']['reason'], 'per_from' => $req_data['HrPerApprove']['per_from'], 'per_to' => $req_data['HrPerApprove']['per_to'],  'per_date' => $req_data['HrPerApprove']['per_date'], 'nohrs' => $req_data['HrPerApprove']['no_hrs'], 'remarks' => $this->request->query['remark'],'employee' => $user_data['Home']['first_name'].' '.$user_data['Home']['last_name']);
					// notify superiors						
					if(!$this->send_email($sub, $template, 'noreply@mypdca.in', $fin['Home']['email_address'],$vars)){	
						// show the msg.								
						$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in sending the mail to finance...', 'default', array('class' => 'alert alert-error'));				
					}
			}
		}
	}
		
	
	
	
	
	/* function to check the duplicate user */
	public function check_duplicate_user($id, $user_id){
		$this->loadModel('HrPerUser');
		$count = $this->HrPerUser->find('count', array('conditions' => array('app_users_id' => $user_id, 'hr_permission_id' => $id)));
		if($count > 0){	
			$this->invalid_attempt();
		}
	}
	
	/* function to check for duplicate entry */
	public function check_duplicate_status($fin_id, $app_user_id, $update){
		$count = $this->HrPerApprove->HrPerStatus->find('count',  array('conditions' => array('HrPerStatus.hr_permission_id' => $fin_id, 'HrPerStatus.app_users_id' => $app_user_id)));
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
		$data = $this->HrPerApprove->HrPerStatus->findById($st_id, array('fields' => 'app_users_id', 'status'));	
		// check the req belongs to the user
		if($data['HrPerStatus']['app_users_id'] == $this->Session->read('USER.Login.id') && $data['HrPerStatus']['status'] == 'W'){	
			return 'pass';
		}else if($view == 1){ // for view mode only
			$data = $this->HrPerApprove->HrPerStatus->find('first', array('fields' => array('app_users_id'), 'conditions' => array('app_users_id' => $data['HrPerStatus']['app_users_id'], 'hr_permission_id' => $id), 'limit' => 1));
			if(!empty($data)){
				return 'view_only';
			}
		}else{
			return 'fail';
		}
	}
	
	/* function to view the leave request */
	public function view_permission($id,$st_id){
		// set the page title		
		$this->set('title_for_layout', 'Permission Request - Approve/Reject - HRIS - My PDCA');
		if(!empty($id) && intval($id) && !empty($st_id) && intval($st_id)){
			// authorize user before action
			$ret_value = $this->auth_action($id,$st_id, 1);
			if($ret_value == 'pass'  || $ret_value == 'view_only'){	
				$data = $this->HrPerApprove->find('first', array('conditions' => array('HrPerStatus.app_users_id' => $this->Session->read('USER.Login.id'), 
				'HrPerApprove.id' => $id), 'fields' => array('HrPerApprove.id','per_from', 'per_to','reason', 'per_date', 'no_hrs', 'created_date','Home.first_name','Home.last_name','HrPerStatus.remarks')));		
				$this->set('perm_data', $data);
				// for view mode
				if($ret_value == 'view_only'){					
					$this->set('VIEW_ONLY', 1);
				}
			}else if($ret_value == 'fail'){ 
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/hrperapprove/');	
			}else{
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Record Deleted: '.$ret_value , 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/hrperapprove/');	
			}
		}else{
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));		
			$this->redirect('/hrperapprove/');	
		}
		
		
	}
	
	/* clear the cache */
	
	public function beforeFilter() { 
		//$this->disable_cache();
		$this->show_tabs(27);
		// check module access
		
	}
	
	
	
	
}