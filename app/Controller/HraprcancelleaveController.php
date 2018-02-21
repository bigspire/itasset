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
class HraprcancelleaveController extends AppController {  
	
	public $name = 'HrAprCancelLeave';	
	
	public $helpers = array('Html', 'Form', 'Session');
	
	public $components = array('Session', 'Functions');
	
	public $layout = 'apps';	

	/* function to list the adv. requests */
	public function index(){	
		// set the page title
		$this->set('title_for_layout', 'Approve Cancel Leave - HRIS - My PDCA');
		
		// get employee list
		
		$emp_list = $this->HrAprCancelLeave->get_team($this->Session->read('USER.Login.id'), 'L', '1');
		$format_list = $this->Functions->format_dropdown($emp_list, 'u','id','first_name', 'last_name');		
		
		$this->set('empList', $format_list);
		
		$options = array(			
			array('table' => 'hr_leave_cancel_status',
					'alias' => 'HrLeaveStatuses',					
					'type' => 'INNER',
					'conditions' => array('`HrLeaveStatuses`.`hr_leave_id` = `HrAprCancelLeave`.`id`')
			),
			array('table' => 'app_users',
					'alias' => 'Homes',					
					'type' => 'LEFT',
					'conditions' => array('`HrLeaveStatuses`.`app_users_id` = `Homes`.`id`')
			),
			
			array('table' => 'app_users',
					'alias' => 'Home2',					
					'type' => 'LEFT',
					'conditions' => array('`HrAprCancelLeave`.`app_users_id` = `Home2`.`id`')
			)
		);
			
		// when the form is submitted for search
		if($this->request->is('post')){
			$url_vars = $this->Functions->create_url(array('keyword','emp_id','from','to'),'HrAprCancelLeave'); 
			$this->redirect('/hraprcancelleave/?'.$url_vars);			
		}					
		$this->HrAprCancelLeave->unBindModel(array('hasOne' => array('HrCancelLeaveStatus')));
		
		if($this->params->query['keyword'] != ''){
			$keyCond = array("MATCH (cancel_reason) AGAINST ('".$this->params->query['keyword']."' IN BOOLEAN MODE)"); 
		}
		if($this->params->query['emp_id'] != ''){
			$empCond = array('HrAprCancelLeave.app_users_id' => $this->params->query['emp_id']); 
		}
		// for date search
		if($this->params->query['from'] != '' || $this->params->query['to'] != ''){
			$from = $this->Functions->format_date_save($this->params->query['from']);
			$to = $this->Functions->format_date_save($this->params->query['to']);
			
			$dateCond = array('or' => array('leave_from between ? and ?' => array($from, $to),'leave_to between ? and ?' => array($from, $to))); 
		}
		$this->HrAprCancelLeave->virtualFields = array('first_name' => 'Home2.first_name');
		
		// fetch the advances		
		$this->paginate = array('fields' => array('id','leave_from', 'leave_to','cancel_reason', 'no_days','HrLeaveType.desc', 'created_date','max(HrLeaveStatuses.id) as status_id','group_concat(HrLeaveStatuses.status) as st_status', 'group_concat(HrLeaveStatuses.created_date) as st_created', 'group_concat(Homes.first_name) as st_user','group_concat(HrLeaveStatuses.modified_date) as st_modified','group_concat(HrLeaveStatuses.remarks) as st_remarks', 'Homes.id', 'Home2.id', 'Home2.first_name','Home2.last_name',  'Homes.first_name','Homes.last_name'),'limit' => 10,'conditions' => array($keyCond, $empCond, $dateCond, 'HrCancelLeaveUser.app_users_id' => $this->Session->read('USER.Login.id')),  'group' => array('HrAprCancelLeave.id'), 'order' => array('created_date' => 'desc'), 'joins' => $options);
		$data = $this->paginate('HrAprCancelLeave');
		
		$this->set('leave_data', $data);
		
		// hide verify icon display
		foreach($data as $hr_leave){ 
			$show_st = $this->auth_action($hr_leave['HrAprCancelLeave']['id'], $hr_leave[0]['status_id']);			
			$status_id[] = $show_st;				
		}
		$this->set('show_status', $status_id);
		
		if(empty($data)){
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>You have no cancel leaves to approve', 'default', array('class' => 'alert alert'));	
		}
		
		
	}
	
	/* function to get leave type */
	public function get_leave_type($id){
		$data = $this->HrAprCancelLeave->HrLeaveType->findById($id, array('fields' => 'desc'));
		return $data['HrLeaveType']['desc'];
		
	}
	
	/* function to process the leave */
	public function process_req($leave_id, $st_id, $status,$user_id){ 
		$data = array('modified_date' => $this->Functions->get_current_date(), 'modified_by' => $this->Session->read('USER.Login.id'), 'remarks' => $this->request->query['remark'], 'status' => $status);
		$this->HrAprCancelLeave->HrCancelLeaveStatus->id = $st_id;
		$st_msg = $status == 'A' ? 'approved' : 'rejected';
		// make sure not duplicate status exists
		$this->check_duplicate_status($leave_id, $this->Session->read('USER.Login.id'), 1);
		// save the finance adv. status
		if($this->HrAprCancelLeave->HrCancelLeaveStatus->save($data, true, $fieldList = array('modified_by','modified_date','remarks','status'))){					
			// get the superiors
			$this->loadModel('Approval');
			// if record approved
			if($status == 'A'){		
				// get leave type id
				$req_data = $this->HrAprCancelLeave->findById($leave_id, array('fields' => 'hr_leave_type_id'));
				
				$approval_data = $this->Approval->find('first', array('fields' => array('level2','auth_amount_l2'), 'conditions'=> array('Approval.app_users_id' => $user_id, 'type' => 'A')));
				// make sure level 2 is not empty
				if(!empty($approval_data['Approval']['level2']) && $this->check_approval_req($approval_data['Approval']['level2'],$leave_id)){
					// check level 2 is not empty and its not the same user
					if($approval_data['Approval']['level2'] != $this->Session->read('USER.Login.id')){ 	
						// get superior level 2 details				
						$superior_data = $this->HrAprCancelLeave->HrEmployee->find('first', array('conditions' => array('HrEmployee.id' => $approval_data['Approval']['level2']),'fields' => array('email_address','first_name', 'last_name')));
						$data = array('hr_leave_id' => $leave_id, 'created_date' => $this->Functions->get_current_date(), 'app_users_id' => $approval_data['Approval']['level2']);
						// save leve 2 if found
						$this->HrAprCancelLeave->HrCancelLeaveStatus->id = '';						
						// make sure not duplicate status exists
						$this->check_duplicate_status($leave_id, $approval_data['Approval']['level2'], 0);						
						if($this->HrAprCancelLeave->HrCancelLeaveStatus->save($data, true, $fieldList = array('hr_leave_id','created_date','app_users_id'))){	
							$this->check_duplicate_user($leave_id,  $approval_data['Approval']['level2']);
							// save adv. users
							$leave_user_data = array('hr_leave_id' => $leave_id, 'app_users_id' => $approval_data['Approval']['level2']);							
							$this->HrAprCancelLeave->HrCancelLeaveUser->id = '';
							$this->HrAprCancelLeave->HrCancelLeaveUser->save($leave_user_data, true, $fieldList = array('hr_leave_id','app_users_id'));					
							
						}else{
							$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in saving superior status...', 'default', array('class' => 'alert alert-error'));
						}
					}else{
						
						// update leave status if l2 approved
						$this->HrAprCancelLeave->id = $leave_id;
						$this->HrAprCancelLeave->saveField('is_deleted', 'Y');	
						$this->HrAprCancelLeave->saveField('is_cancel', 'Y');	
						// update comp. off if comp. off type
						$this->update_leave_comp($req_data['HrAprCancelLeave']['hr_leave_type_id'], $leave_id, 'R');
					}
				}else{
					// update leave status
					$this->HrAprCancelLeave->id = $leave_id;
					$this->HrAprCancelLeave->saveField('is_deleted', 'Y');
					$this->HrAprCancelLeave->saveField('is_cancel', 'Y');
					// update comp. off if comp. off type
					$this->update_leave_comp($req_data['HrAprCancelLeave']['hr_leave_type_id'], $leave_id, 'R');					
				}
				
			}else{					
										
				
			}			
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Cancel leave request is '.$st_msg.' successfully', 'default', array('class' => 'alert alert-success'));
		}else{
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Problem in updating the status', 'default', array('class' => 'alert alert-error'));		
		}
		$this->redirect('/hraprcancelleave/');	
	}
	
	
	/* function to validate l2 validation required */
	public function check_approval_req($id,$leave_id){	
		$this->loadModel('HrLeaveStatus');
		$count = $this->HrLeaveStatus->find('count', array('conditions' => array('HrLeaveStatus.app_users_id' => $id, 'HrLeaveStatus.hr_leave_id' => $leave_id)));		
		if($count > 0){
			return true;
		}else{
			return false;
		}
	}
	
	/* function to update leave comp. offs */
	public function update_leave_comp($type, $leave_id, $status){
		if($type == '7'){
			$this->loadModel('HrLeaveComp');			
			$this->HrLeaveComp->updateAll( array('HrLeaveComp.is_approve' => "'" . $status. "'", 'HrLeaveComp.modified_date' => "'" . $this->Functions->get_current_date(). "'"),    array('HrLeaveComp.hr_leave_id' => $leave_id));		
		}
	}
	
	
	
	
	/* function to check the duplicate user */
	public function check_duplicate_user($id, $user_id){
		$this->loadModel('HrCancelLeaveUser');
		$count = $this->HrCancelLeaveUser->find('count', array('conditions' => array('app_users_id' => $user_id, 'hr_leave_id' => $id)));
		if($count > 0){	
			$this->invalid_attempt();
		}
	}
	
	/* function to check for duplicate entry */
	public function check_duplicate_status($fin_id, $app_user_id, $update){
		$count = $this->HrAprCancelLeave->HrCancelLeaveStatus->find('count',  array('conditions' => array('HrCancelLeaveStatus.hr_leave_id' => $fin_id, 'HrCancelLeaveStatus.app_users_id' => $app_user_id)));
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
		$data = $this->HrAprCancelLeave->HrCancelLeaveStatus->findById($st_id, array('fields' => 'app_users_id', 'status'));	
		// check the req belongs to the user
		if($data['HrCancelLeaveStatus']['app_users_id'] == $this->Session->read('USER.Login.id') && $data['HrCancelLeaveStatus']['status'] == 'W'){	
			return 'pass';
		}else if($view == 1){ // for view mode only
			$data = $this->HrAprCancelLeave->HrCancelLeaveStatus->find('first', array('fields' => array('app_users_id'), 'conditions' => array('app_users_id' => $data['HrCancelLeaveStatus']['app_users_id'], 'hr_leave_id' => $id), 'limit' => 1));
			if(!empty($data)){
				return 'view_only';
			}
		}else{
			return 'fail';
		}
	}
	
	/* function to view the cancel leave request */
	public function view_leave($id,$st_id){
		// set the page title		
		$this->set('title_for_layout', 'Cancel Leave Request - Approve/Reject - HRIS - My PDCA');
		if(!empty($id) && intval($id) && !empty($st_id) && intval($st_id)){
			// authorize user before action
			$ret_value = $this->auth_action($id,$st_id, 1);
			if($ret_value == 'pass'  || $ret_value == 'view_only'){	
				$this->HrAprCancelLeave->bindModel(array('hasOne' => array('HrLeaveComp')));
				$data = $this->HrAprCancelLeave->find('first', array('conditions' => array('HrCancelLeaveStatus.app_users_id' => $this->Session->read('USER.Login.id'),
				'HrAprCancelLeave.id' => $id), 'fields' => array('HrAprCancelLeave.id','leave_from', 'cancel_reason','leave_to','reason', 'no_days','HrLeaveType.desc', 
				'created_date','HrEmployee.first_name','HrEmployee.last_name','HrCancelLeaveStatus.remarks','group_concat(DISTINCT  HrLeaveComp.comp_off  order by HrLeaveComp.comp_off asc) as compoff'), 
				'group' => array('HrAprCancelLeave.id')));
				$this->set('leave_data', $data);
				// for view mode
				if($ret_value == 'view_only'){					
					$this->set('VIEW_ONLY', 1);
				}
			}else if($ret_value == 'fail'){ 
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/hraprcancelleave/');	
			}else{
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Record Deleted: '.$ret_value , 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/hraprcancelleave/');	
			}
		}else{
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));		
			$this->redirect('/hraprcancelleave/');	
		}
		
		
	}
	
	/* clear the cache */
	
	public function beforeFilter() { 
		//$this->disable_cache();
		$this->show_tabs(85);
		// check module access
		
	}
	
	
	
	
}