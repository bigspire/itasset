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
class HrleaveApproveController extends AppController {  
	
	public $name = 'HrLeaveApprove';	
	
	public $helpers = array('Html', 'Form', 'Session');
	
	public $components = array('Session', 'Functions');
	
	public $layout = 'apps';	

	/* function to list the adv. requests */
	public function index(){	
		// set the page title
		$this->set('title_for_layout', 'Approve Leave - HRIS - My PDCA');
		
		// get employee list
		
		$emp_list = $this->HrLeaveApprove->get_team($this->Session->read('USER.Login.id'), 'L', '1');
		$format_list = $this->Functions->format_dropdown($emp_list, 'u','id','first_name', 'last_name');		
		
		$this->set('empList', $format_list);
		
		$options = array(			
			array('table' => 'hr_leave_status',
					'alias' => 'HrLeaveStatuses',					
					'type' => 'LEFT',
					'conditions' => array('`HrLeaveStatuses`.`hr_leave_id` = `HrLeaveApprove`.`id`')
			),
			array('table' => 'app_users',
					'alias' => 'Homes',					
					'type' => 'LEFT',
					'conditions' => array('`HrLeaveStatuses`.`app_users_id` = `Homes`.`id`')
			),
			
			array('table' => 'app_users',
					'alias' => 'Home2',					
					'type' => 'LEFT',
					'conditions' => array('`HrLeaveApprove`.`app_users_id` = `Home2`.`id`')
			)
		);
			
		// when the form is submitted for search
		if($this->request->is('post')){
			$url_vars = $this->Functions->create_url(array('keyword','emp_id','from','to'),'HrLeaveApprove'); 
			$this->redirect('/hrleaveapprove/?'.$url_vars);			
		}					
		$this->HrLeaveApprove->unBindModel(array('hasOne' => array('HrLeaveStatus')));
		
		if($this->params->query['keyword'] != ''){
			$keyCond = array("MATCH (reason) AGAINST ('".$this->params->query['keyword']."' IN BOOLEAN MODE)"); 
		}
		if($this->params->query['emp_id'] != ''){
			$empCond = array('HrLeaveApprove.app_users_id' => $this->params->query['emp_id']); 
		}
		// for date search
		if($this->params->query['from'] != '' || $this->params->query['to'] != ''){
			$from = $this->Functions->format_date_save($this->params->query['from']);
			$to = $this->Functions->format_date_save($this->params->query['to']);
			
			$dateCond = array('or' => array('leave_from between ? and ?' => array($from, $to),'leave_to between ? and ?' => array($from, $to))); 
		}
		$this->HrLeaveApprove->virtualFields = array('first_name' => 'Home2.first_name');
		
		// fetch the advances		
		$this->paginate = array('fields' => array('id','leave_from', 'leave_to','reason', 'no_days','HrLeaveType.desc', 'created_date', 
		'max(HrLeaveStatuses.id) as status_id','group_concat(HrLeaveStatuses.status) as st_status',
		'group_concat(HrLeaveStatuses.created_date) as st_created', 'group_concat(Homes.first_name) as st_user','group_concat(HrLeaveStatuses.modified_date) 
		as st_modified','group_concat(HrLeaveStatuses.remarks) as st_remarks', 'Homes.id', 'Home2.id', 'Home2.first_name','Home2.last_name',  
		'Homes.first_name','Homes.last_name'),'limit' => 20,'conditions' => array($keyCond, $empCond, $dateCond, 
		'HrLeaveUser.app_users_id' => $this->Session->read('USER.Login.id'),'HrLeaveApprove.is_deleted' => 'N'),  
		'group' => array('HrLeaveApprove.id'), 'order' => array('is_approve' => 'asc','created_date' => 'desc'), 
		'joins' => $options);
		$data = $this->paginate('HrLeaveApprove');
		
		$this->set('leave_data', $data);
		
		// hide verify icon display
		foreach($data as $hr_leave){ 
			$show_st = $this->auth_action($hr_leave['HrLeaveApprove']['id'], $hr_leave[0]['status_id']);			
			$status_id[] = $show_st;				
		}
		$this->set('show_status', $status_id);
		
		if(empty($data)){
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>You have no leaves to approve', 'default', array('class' => 'alert alert'));	
		}
		
		
	}
	
	/* function to get leave type */
	public function get_leave_type($id){
		$data = $this->HrLeaveApprove->HrLeaveType->findById($id, array('fields' => 'desc'));
		return $data['HrLeaveType']['desc'];
		
	}
	
	/* function to process the leave */
	public function process_adv($leave_id, $st_id, $status,$user_id){ 
		$data = array('modified_date' => $this->Functions->get_current_date(), 'modified_by' => $this->Session->read('USER.Login.id'), 'remarks' => $this->request->query['remark'], 'status' => $status);
		$this->HrLeaveApprove->HrLeaveStatus->id = $st_id;
		$st_msg = $status == 'A' ? 'approved' : 'rejected';
		// make sure not duplicate status exists
		$this->check_duplicate_status($leave_id, $this->Session->read('USER.Login.id'), 1);
		// save the finance adv. status
		if($this->HrLeaveApprove->HrLeaveStatus->save($data, true, $fieldList = array('modified_by','modified_date','remarks','status'))){
			// get user data
			$user_data = $this->HrLeaveApprove->Home->find('first', array('conditions' => array('Home.id' => $user_id),'fields' => array('email_address','first_name', 'last_name')));
			// get leave details
			$this->HrLeaveApprove->bindModel(array('hasOne' => array('HrLeaveComp')));
			$req_data = $this->HrLeaveApprove->findById($leave_id, array('fields' => 'leave_from','leave_to', 'no_days', 'reason','hr_leave_type_id','group_concat(distinct HrLeaveComp.comp_off  order by HrLeaveComp.comp_off asc) as compoff'));
			$vars = array('name' => $user_data['Home']['first_name'].' '.$user_data['Home']['last_name'],  'remarks' => $this->request->query['remark'], 'status' => $st_msg, 'req_date' => $req_data['HrLeaveApprove']['req_date'],'employee' => $user_data['Home']['first_name'].' '.$user_data['Home']['last_name'],'reason' => $req_data['HrLeaveApprove']['reason'], 'leave_from' => $req_data['HrLeaveApprove']['leave_from'], 'leave_to' => $req_data['HrLeaveApprove']['leave_to'], 'nodays' => $req_data['HrLeaveApprove']['no_days'], 'leave_type' => $this->get_leave_type($req_data['HrLeaveApprove']['hr_leave_type_id']), 'comp_off' => $req_data[0]['compoff']);
			// notify employee						
			if(!$this->send_email('My PDCA - Your leave request is '.$st_msg.' by '.ucfirst($this->Session->read('USER.Login.first_name')).' '.ucfirst($this->Session->read('USER.Login.last_name')), 'notify_leave', 'noreply@mypdca.in', $user_data['Home']['email_address'],$vars)){		
				// show the msg.								
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in sending the mail to user...', 'default', array('class' => 'alert alert-error'));				
			}else{								
				}
			
			// get the superiors
			$this->loadModel('Approval');
			// if record approved
			if($status == 'A'){					
				$approval_data = $this->Approval->find('first', array('fields' => array('level2','auth_amount_l2'), 'conditions'=> array('Approval.app_users_id' => $user_id, 'type' => 'A')));
				// make sure level 2 is not empty
				if(!empty($approval_data['Approval']['level2'])){
					// check level 2 is not empty and its not the same user
					if($approval_data['Approval']['level2'] != $this->Session->read('USER.Login.id')){ 	
						// get superior level 2 details				
						$data = array('hr_leave_id' => $leave_id, 'created_date' => $this->Functions->get_current_date(), 'app_users_id' => $approval_data['Approval']['level2']);
						// save leve 2 if found
						$this->HrLeaveApprove->HrLeaveStatus->id = '';						
						// make sure not duplicate status exists
						$this->check_duplicate_status($leave_id, $approval_data['Approval']['level2'], 0);						
						if($this->HrLeaveApprove->HrLeaveStatus->save($data, true, $fieldList = array('hr_leave_id','created_date','app_users_id'))){	
							$this->check_duplicate_user($leave_id,  $approval_data['Approval']['level2']);
							// save adv. users
							$leave_user_data = array('hr_leave_id' => $leave_id, 'app_users_id' => $approval_data['Approval']['level2']);							
							$this->HrLeaveApprove->HrLeaveUser->id = '';
							$this->HrLeaveApprove->HrLeaveUser->save($leave_user_data, true, $fieldList = array('hr_leave_id','app_users_id'));							
						}else{
							$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in saving superior status...', 'default', array('class' => 'alert alert-error'));
						}
					}else{
						// update leave status if l2 approved
						$this->HrLeaveApprove->id = $leave_id;
						$this->HrLeaveApprove->saveField('is_approve', 'Y');	
						// update comp. off if comp. off type
						$this->update_leave_comp($req_data['HrLeaveApprove']['hr_leave_type_id'], $leave_id, 'Y');
					}
				}else{
					// update leave status
					$this->HrLeaveApprove->id = $leave_id;
					$this->HrLeaveApprove->saveField('is_approve', 'Y');
					// update comp. off if comp. off type
					$this->update_leave_comp($req_data['HrLeaveApprove']['hr_leave_type_id'], $leave_id, 'Y');
				
				}
				
			}else{
				// update leave status
				$this->HrLeaveApprove->id = $leave_id;
				$this->HrLeaveApprove->saveField('is_approve', 'R');
				// update comp. off if comp. off type
				$this->update_leave_comp($req_data['HrLeaveApprove']['hr_leave_type_id'], $leave_id, 'R');
					
				$approval_data = $this->Approval->find('first', array('fields' => array('level1','level2'), 'conditions'=> array('Approval.app_users_id' => $user_id, 'type' => 'A')));
				if($approval_data['Approval']['level1'] == $this->Session->read('USER.Login.id')){
					$mail_user = $approval_data['Approval']['level2'];
				}else{
					$mail_user = $approval_data['Approval']['level1'];
				}
				
				// get superior data
				$superior_data = $this->HrLeaveApprove->Home->find('first', array('conditions' => array('Home.id' => $mail_user),'fields' => array('email_address','first_name', 'last_name')));
				// make sure superior available
				if(!empty($superior_data)){
					// notify employee						
					if(!$this->send_email('My PDCA - Leave request is rejected by '.ucfirst($this->Session->read('USER.Login.first_name')).' '.ucfirst($this->Session->read('USER.Login.last_name')), 'notify_leave', 'noreply@mypdca.in', $superior_data['Home']['email_address'],$vars)){		
						// show the msg.								
						$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in sending the mail to user...', 'default', array('class' => 'alert alert-error'));				
					}else{								
					}
				}
				// forward to finance team				
				$this->notify_hr($user_data, $req_data, 1);				
				
			}			
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Leave request is '.$st_msg.' successfully', 'default', array('class' => 'alert alert-success'));
		}else{
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Problem in updating the status', 'default', array('class' => 'alert alert-error'));		
		}
		$this->redirect('/hrleaveapprove/');	
	}
	
	/* function to update leave comp. offs */
	public function update_leave_comp($type, $leave_id, $status){
		if($type == '7'){
			$this->loadModel('HrLeaveComp');			
			$this->HrLeaveComp->updateAll( array('HrLeaveComp.is_approve' => "'" . $status. "'", 'HrLeaveComp.modified_date' => "'" . $this->Functions->get_current_date(). "'"),    array('HrLeaveComp.hr_leave_id' => $leave_id));		
		}
	}
	
	
	
	/* function to notify finance */
	public function notify_hr($user_data,$req_data, $reject){
		$hr_data = $this->HrLeaveApprove->Home->find('all', array('fields' => array('id','email_address', 'first_name','last_name'), 'conditions' => array('hr_department_id' => '14')));			
		// iterate finance team
			foreach($hr_data as $fin){	
				// check the same user
				if($this->Session->read('USER.Login.id') != $fin['Home']['id']){
					// change the subject
					if($reject == 1){
						$status = 'rejected';
					}else{
						$status = 'approved';
					}
					$sub = 'My PDCA - Leave request is '.$status.' by '.ucfirst($this->Session->read('USER.Login.first_name')).' '.ucfirst($this->Session->read('USER.Login.last_name'));
					$template = 'notify_leave';
					$from = ucfirst($this->Session->read('USER.Login.first_name')).' '.ucfirst($this->Session->read('USER.Login.last_name'));
					$name = $fin['Home']['first_name'].' '.$fin['Home']['last_name'];
						
					$vars = array('from_name' => $from, 'status' => $status, 'name' => $name, 'reason' => $req_data['HrLeaveApprove']['reason'], 'leave_from' => $req_data['HrLeaveApprove']['leave_from'], 'leave_to' => $req_data['HrLeaveApprove']['leave_to'], 'nodays' => $req_data['HrLeaveApprove']['no_days'], 'leave_type' => $this->get_leave_type($req_data['HrLeaveApprove']['hr_leave_type_id']), 'remarks' => $this->request->query['remark'],'employee' => $user_data['Home']['first_name'].' '.$user_data['Home']['last_name'], 'comp_off' => $req_data[0]['compoff']);
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
		$this->loadModel('HrLeaveUser');
		$count = $this->HrLeaveUser->find('count', array('conditions' => array('app_users_id' => $user_id, 'hr_leave_id' => $id)));
		if($count > 0){	
			$this->invalid_attempt();
		}
	}
	
	/* function to check for duplicate entry */
	public function check_duplicate_status($fin_id, $app_user_id, $update){
		$count = $this->HrLeaveApprove->HrLeaveStatus->find('count',  array('conditions' => array('HrLeaveStatus.hr_leave_id' => $fin_id, 'HrLeaveStatus.app_users_id' => $app_user_id)));
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
		$data = $this->HrLeaveApprove->HrLeaveStatus->findById($st_id, array('fields' => 'app_users_id', 'status'));	
		// check the req belongs to the user
		if($data['HrLeaveStatus']['app_users_id'] == $this->Session->read('USER.Login.id') && $data['HrLeaveStatus']['status'] == 'W'){	
			return 'pass';
		}else if($view == 1){ // for view mode only
			$data = $this->HrLeaveApprove->HrLeaveStatus->find('first', array('fields' => array('app_users_id'), 'conditions' => array('app_users_id' => $data['HrLeaveStatus']['app_users_id'], 'hr_leave_id' => $id), 'limit' => 1));
			if(!empty($data)){
				return 'view_only';
			}
		}else{
			return 'fail';
		}
	}
	
	/* function to view the leave request */
	public function view_leave($id,$st_id){
		// set the page title		
		$this->set('title_for_layout', 'Leave Request - Approve/Reject - HRIS - My PDCA');
		if(!empty($id) && intval($id) && !empty($st_id) && intval($st_id)){
			// authorize user before action
			$ret_value = $this->auth_action($id,$st_id, 1);
			if($ret_value == 'pass'  || $ret_value == 'view_only'){	
				$this->HrLeaveApprove->bindModel(array('hasOne' => array('HrLeaveComp')));
				$data = $this->HrLeaveApprove->find('first', array('conditions' => array('HrLeaveStatus.app_users_id' => $this->Session->read('USER.Login.id'),
				'HrLeaveApprove.id' => $id), 'fields' => array('HrLeaveApprove.id','leave_from', 'leave_to','reason', 'no_days','HrLeaveType.desc', 
				'created_date','Home.first_name','Home.last_name','HrLeaveStatus.remarks','group_concat(DISTINCT  HrLeaveComp.comp_off  order by HrLeaveComp.comp_off asc) as compoff'), 
				'group' => array('HrLeaveApprove.id')));		
				$this->set('leave_data', $data);
				// for view mode
				if($ret_value == 'view_only'){					
					$this->set('VIEW_ONLY', 1);
				}
			}else if($ret_value == 'fail'){ 
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/hrleaveapprove/');	
			}else{
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Record Deleted: '.$ret_value , 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/hrleaveapprove/');	
			}
		}else{
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));		
			$this->redirect('/hrleaveapprove/');	
		}
		
		
	}
	
	/* clear the cache */
	
	public function beforeFilter() { 
		//$this->disable_cache();
		$this->show_tabs(27);
		// check module access
		
	}
	
	
	
	
}