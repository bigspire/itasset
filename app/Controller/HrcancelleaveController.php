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
class HrcancelleaveController extends AppController {  
	
	public $name = 'HrCancelLeave';	
	
	public $helpers = array('Html', 'Form', 'Session');
	
	public $components = array('Session', 'Functions');
	
	public $layout = 'apps';	

	/* function to list the adv. requests */
	public function index(){	
		// set the page title
		$this->set('title_for_layout', 'Cancel Leave - HRIS - My PDCA');		
		
		// when the form is submitted for search
		if($this->request->is('post')){			
			$url_vars = $this->Functions->create_url(array('keyword', 'from', 'to'),'HrCancelLeave'); 
			$this->redirect('/hrcancelleave/?'.$url_vars);			
		}
		if($this->params->query['keyword'] != ''){
			$keyCond = array("MATCH (cancel_reason) AGAINST ('".$this->params->query['keyword']."' IN BOOLEAN MODE)"); 
		}
		// for date search
		if($this->params->query['from'] != '' || $this->params->query['to'] != ''){
			$from = $this->Functions->format_date_save($this->params->query['from']);
			$to = $this->Functions->format_date_save($this->params->query['to']);
			
			$dateCond = array('or' => array('leave_from between ? and ?' => array($from, $to),'leave_to between ? and ?' => array($from, $to))); 
		}
		
		$options = array(			
			array('table' => 'hr_leave_cancel_status',
					'alias' => 'HrLeaveStatuses',					
					'type' => 'INNER',
					'conditions' => array('`HrLeaveStatuses`.`hr_leave_id` = `HrCancelLeave`.`id`')
			),
			array('table' => 'app_users',
					'alias' => 'Homes',					
					'type' => 'LEFT',
					'conditions' => array('`HrLeaveStatuses`.`app_users_id` = `Homes`.`id`')
			)
		);
			
							
		$this->HrCancelLeave->unBindModel(array('hasOne' => array('HrCancelLeaveStatus')));
		$this->HrCancelLeave->unBindModel(array('belongsTo' => array('HrEmployee')));

		// fetch the advances		
		$this->paginate = array('fields' => array('id','leave_from', 'leave_to','cancel_reason', 'no_days','HrLeaveType.desc', 'created_date','group_concat(HrLeaveStatuses.status) as st_status', 'group_concat(Homes.first_name) as st_user', 'group_concat(HrLeaveStatuses.modified_date) as st_modified','group_concat(HrLeaveStatuses.created_date) as st_created', 'group_concat(HrLeaveStatuses.remarks) as st_remarks'),'limit' => 10,'conditions' => array($keyCond,$dateCond, 'HrCancelLeave.app_users_id' => $this->Session->read('USER.Login.id')), 'order' => array('created_date' => 'desc'), 'group' => array('HrCancelLeave.id'), 'joins' => $options);
		$data = $this->paginate('HrCancelLeave');
		
		$this->set('leave_data', $data);
		if(empty($data)){
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>You have no cancel leave request found', 'default', array('class' => 'alert alert'));	
		}
	}
	
	
	/* function to cancel the travel */
	public function cancel_leave(){
		if($this->request->is('post')){
			// get the superiors
			$this->loadModel('Approval');			
			$approval_data = $this->Approval->find('first', array('fields' => array('level1'), 'conditions'=> array('Approval.app_users_id' => $this->Session->read('USER.Login.id'), 'type' => 'L')));
			// save leave  req. status data
			$id = $this->request->data['HrLeave']['leave_id'];
			$this->loadModel('HrCancelLeaveStatus');
			$data = array('hr_leave_id' => $id, 'created_date' => $this->Functions->get_current_date(), 'app_users_id' => $approval_data['Approval']['level1']);
			if(!empty($approval_data)){
				// make sure not duplicate status exists
				$this->check_duplicate_status($id, $approval_data['Approval']['level1']);
				// save in adv. status table
				if($this->HrCancelLeaveStatus->save($data, true, $fieldList = array('hr_leave_id','created_date','app_users_id'))){
					// update reason
					$this->HrCancelLeave->id = $id;
					$this->HrCancelLeave->saveField('cancel_reason', $this->request->query['remark']);
					// save adv. users
					$this->loadModel('HrCancelLeaveUser');
					$user_data = array('hr_leave_id' => $id, 'app_users_id' => $approval_data['Approval']['level1']);							
					$this->HrCancelLeaveUser->save($user_data, true, $fieldList = array('hr_leave_id','app_users_id'));				
					$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Cancel request is created successfully', 'default', array('class' => 'alert alert-success'));
				}
			}				
		}else{
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Problem in cancelling leave. pls contact admin', 'default', array('class' => 'alert alert-error'));		
		}		
		$this->redirect('/hrcancelleave/');			
	}
	
	
	/* function to get leave type */
	public function get_leave_type($id){
		$data = $this->HrCancelLeave->HrLeaveType->findById($id, array('fields' => 'desc'));
		return $data['HrLeaveType']['desc'];
		
	}
	
	/* function to check for duplicate entry */
	public function check_duplicate_status($leave_id, $app_user_id){
		$count = $this->HrCancelLeave->HrCancelLeaveStatus->find('count',  array('conditions' => array('HrCancelLeaveStatus.hr_leave_id' => $leave_id, 'HrCancelLeaveStatus.app_users_id' => $app_user_id)));
		if($count > 0){
			$this->invalid_attempt();
		}
		
	}
	
	
	
		
	/* function to auth record */
	public function auth_action($id){
		$data = $this->HrCancelLeave->findById($id, array('fields' => 'app_users_id','modified_date'));	
		// check the req belongs to the user				
		if($data['HrCancelLeave']['app_users_id'] == $this->Session->read('USER.Login.id')){	
			return 'pass';
		}else{
			return 'fail';
		}
	}
	
	/* function to view the adv. request */
	public function view_leave($id){
		// set the page title		
		$this->set('title_for_layout', 'View Cancel Leave - HRIS - My PDCA');
		if(!empty($id) && intval($id)){
			// authorize user before action
			$ret_value = $this->auth_action($id);
			if($ret_value == 'pass'){
				$this->HrCancelLeave->bindModel(array('hasOne' => array('HrLeaveComp')));
				$data = $this->HrCancelLeave->findById($id, array('fields' => 'leave_from','HrCancelLeave.id','cancel_reason', 'leave_to','no_days','reason','HrLeaveType.desc','group_concat(distinct HrLeaveComp.comp_off order by HrLeaveComp.comp_off asc) as compoff'));
				
				$this->set('leave_data', $data);
			}else if($ret_value == 'fail'){ 
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/hrcancelleave/');	
			}else{
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Record Deleted: '.$ret_value , 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/hrcancelleave/');	
			}
		}else{
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));		
			$this->redirect('/hrcancelleave/');	
		}
		
		
	}
	
	/* clear the cache */
	
	public function beforeFilter() { 
		//$this->disable_cache();
		$this->show_tabs(84);
	}
	
		
		/* auto complete search 
	public function search(){ 
		$this->layout = false;	 
		$q = trim(Sanitize::escape($_GET['q']));	
		if(!empty($q)){
			// execute only when the search keywork has value		
			$this->set('keyword', $q);
			$data = $this->HrCancelLeave->find('all', array('fields' => array('purpose'),  'group' => array('purpose','description'), 'conditions' => 	$conditions =  array("OR" => array ('purpose like' => '%'.$q.'%', 'description like' => '%'.$q.'%'), 'AND' => array('is_deleted' => 'N'))));		
			$this->set('results', $data);
		}
    }
	*/	
	
	
	
}