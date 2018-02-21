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
class HrattchangeController extends AppController {  
	
	public $name = 'HrAttChange';	
	
	public $helpers = array('Html', 'Form', 'Session');
	
	public $components = array('Session', 'Functions');
	
	public $layout = 'apps';	

	/* function to list the adv. requests */
	public function index(){	
		// set the page title
		$this->set('title_for_layout', 'Attendance Change - HRIS - My PDCA');		
		// when the form is submitted for search
		if($this->request->is('post')){
			$url_vars = $this->Functions->create_url(array('keyword', 'from', 'to'),'HrAttChange'); 
			$this->redirect('/hrattchange/?'.$url_vars);			
		}
		if($this->params->query['keyword'] != ''){
			$keyCond = array("MATCH (reason) AGAINST ('".$this->params->query['keyword']."' IN BOOLEAN MODE)"); 
		}
		
		$dateCond = array('or' => array('att_date between ? and ?' => array(date('Y-m-d 00:00:00', strtotime("-2 month")), date('Y-m-d 23:59:59')))); 
		
		
		
		// for date search
		if($this->params->query['from'] != '' || $this->params->query['to'] != ''){
			$from = $this->Functions->format_date_save($this->params->query['from']);
			$to = $this->Functions->format_date_save($this->params->query['to']);
			
			$dateCond = array('or' => array('att_date between ? and ?' => array($from, $to))); 
		}
		
		$options = array(			
			array('table' => 'hr_attendance_status',
					'alias' => 'HrAttStatuses',					
					'type' => 'LEFT',
					'conditions' => array('`HrAttStatuses`.`hr_attendance_change_id` = `HrAttChange`.`id`')
			),
			array('table' => 'app_users',
					'alias' => 'Homes',					
					'type' => 'LEFT',
					'conditions' => array('`HrAttStatuses`.`app_users_id` = `Homes`.`id`')
			)
		);
			
							
		$this->HrAttChange->unBindModel(array('hasOne' => array('HrAttStatus')));
		$this->HrAttChange->unBindModel(array('belongsTo' => array('Home')));

		// fetch the advances		
		$this->paginate = array('fields' => array('id','att_date','att_type','in_time', 'out_time','reason','created_date',
		'group_concat(HrAttStatuses.status) as st_status', 'group_concat(Homes.first_name) as st_user',
		'group_concat(HrAttStatuses.created_date) as st_created','group_concat(HrAttStatuses.modified_date) as st_modified', 'group_concat(HrAttStatuses.remarks) as st_remarks'),'limit' => 10,'conditions' => array($keyCond,$dateCond, 'HrAttChange.app_users_id' => $this->Session->read('USER.Login.id')), 'order' => array('created_date' => 'desc'), 'group' => array('HrAttChange.id'), 'joins' => $options);
		$data = $this->paginate('HrAttChange');
		
		$this->set('att_data', $data);
		
		if(empty($data)){
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>You have no change attendance found', 'default', array('class' => 'alert alert'));	
		}		
		
		
	}
	
	

	
	
	
	
	/* function to save the advance */
	public function change_attendance(){ 
		// set the page title		
		$this->set('title_for_layout', 'Request Attendance Change - HRIS - My PDCA');	
		$this->set('types', array( 'B' => 'Both',  'O' => 'Out Time'));
		if ($this->request->is('post')){ 
			// validates the form
			$this->HrAttChange->set($this->request->data);			
			if ($this->HrAttChange->validates(array('fieldList' => array('att_date', 'in_time','out_time','reason','att_type')))) {
				
				if($this->data['HrAttChange']['att_type'] == 'I'){
					unset($this->data['HrAttChange']['out_time']);
				}
				if($this->data['HrAttChange']['att_type'] == 'O'){
					unset($this->data['HrAttChange']['in_time']);
				}			
				
				$this->request->data['HrAttChange']['app_users_id'] = $this->Session->read('USER.Login.id');
				// format the dates to save		
				if(!empty($this->request->data['HrAttChange']['in_time'])){
					$this->request->data['HrAttChange']['in_time'] = $this->Functions->format_time_save($this->request->data['HrAttChange']['in_time']);
				}
				if(!empty($this->request->data['HrAttChange']['out_time'])){
					$this->request->data['HrAttChange']['out_time'] = $this->Functions->format_time_save($this->request->data['HrAttChange']['out_time']);
				}
				$this->request->data['HrAttChange']['att_date'] = $this->Functions->format_date_save($this->request->data['HrAttChange']['att_date']);
				$this->request->data['HrAttChange']['created_date'] = $this->Functions->get_current_date();
				// save the data
				if($this->HrAttChange->save($this->request->data['HrAttChange'], array('validate'=> false))) {
					// get the superiors
					$this->loadModel('Approval');
					$approval_data = $this->Approval->find('first', array('fields' => array('level1'), 'conditions'=> array('Approval.app_users_id' => $this->Session->read('USER.Login.id'), 'type' => 'L')));
					// save finance req. status data
					$this->loadModel('HrAttStatus');
					$data = array('hr_attendance_change_id' => $this->HrAttChange->id, 'created_date' => $this->Functions->get_current_date(), 'app_users_id' => $approval_data['Approval']['level1']);
					
					if(!empty($approval_data)){
						// make sure not duplicate status exists
						$this->check_duplicate_status($this->HrAttChange->id, $approval_data['Approval']['level1']);
						// save in adv. status table
						if($this->HrAttStatus->save($data, true, $fieldList = array('hr_attendance_change_id','created_date','app_users_id'))){				
							// save adv. users
							$this->loadModel('HrAttUser');
							$permissions = array('hr_attendance_change_id' => $this->HrAttChange->id, 'app_users_id' => $approval_data['Approval']['level1']);							
							$this->HrAttUser->id = '';
							$this->HrAttUser->save($permissions, true, $fieldList = array('hr_attendance_change_id','app_users_id'));							
							// show the msg.
							$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Your attendance change request is created successfully', 'default', array('class' => 'alert alert-success'));
						}else{
							$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in saving approver status', 'default', array('class' => 'alert alert-info'));
						}
					}else if($this->Session->read('USER.Login.app_roles_id') == '18'){
						$this->HrAttChange->id = $this->HrAttChange->id;
						$this->HrAttChange->saveField('is_approve', 'Y');
						// update the attendance
						$this->update_attendance($this->request->data['HrAttChange']); 
						$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Attendance change created and approved successfully', 'default', array('class' => 'alert alert-success'));

					}
					else{
						$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>You have no superior to approve your request', 'default', array('class' => 'alert alert-info'));
					}	
					
					$this->redirect('/hrattchange/');	
					
				}else{
					// show the error msg.
					$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in saving the data...', 'default', array('class' => 'alert alert-error'));					
				}
				
				
			}else{
				 $errors = $this->HrAttChange->validationErrors;
				// print_r($errors);
			}
		}
	}
	
	
	/* function to update the attendance */
	public function update_attendance($data){ 
		$this->loadModel('HrAttendance');
		if($data['att_type'] == 'O'){		
			// fetch the attendance record
			$user_att_data = $this->HrAttendance->find('all', array('fields' => array('HrAttendance.id'), 'conditions' => array("in_time like" =>  $data['att_date'].'%', 'app_users_id' => $this->Session->read('USER.Login.id')), 'limit' => '1')); 			
			// format array
			$ar_data = array('status' => 'A', 'out_time' => $data['att_date'].' '.$data['out_time'], 'modified_date' => $this->Functions->get_current_date());
			$fieldList = array('out_time', 'modified_date','app_users_id','status');
			$this->HrAttendance->id = $user_att_data[0]['HrAttendance']['id'];		
		}else{
			// format array
			$ar_data = array('status' => 'A', 'in_time' => $data['att_date'].' '.$data['in_time'], 'out_time' => $data['att_date'].' '.$data['out_time'], 'modified_date' => $this->Functions->get_current_date(), 'app_users_id' => $this->Session->read('USER.Login.id'));
			$fieldList = array('in_time','out_time',  'modified_date','app_users_id','status');
			$this->HrAttendance->create();
			
		}
		// save the todo
		if($this->HrAttendance->save($ar_data, true, $fieldList)){	
			
		}else{
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in updating the attendance, pls contact admin..', 'default', array('class' => 'alert alert-error'));
		}		
	}
	
	
	
	/* function to check for duplicate entry */
	public function check_duplicate_status($leave_id, $app_user_id){
		$count = $this->HrAttChange->HrAttStatus->find('count',  array('conditions' => array('HrAttStatus.hr_attendance_change_id' => $leave_id, 'HrAttStatus.app_users_id' => $app_user_id)));
		if($count > 0){
			$this->invalid_attempt();
		}
		
	}
	
	
	
		
	/* function to auth record */
	public function auth_action($id){
		$data = $this->HrAttChange->findById($id, array('fields' => 'app_users_id'));	
		if($data['HrAttChange']['app_users_id'] == $this->Session->read('USER.Login.id')){	
			return 'pass';
		}else{
			return 'fail';
		}
	}
	
	/* function to view the  permission */
	public function view_change($id){
		// set the page title		
		$this->set('title_for_layout', 'View Attendance Change - HRIS - My PDCA');
		if(!empty($id) && intval($id)){
			// authorize user before action
			$ret_value = $this->auth_action($id);
			if($ret_value == 'pass'){	
				$data = $this->HrAttChange->findById($id);
				$this->set('att_data', $data);
			}else if($ret_value == 'fail'){ 
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/hrattchange/');	
			}else{
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Record Deleted: '.$ret_value , 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/hrattchange/');	
			}
		}else{
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));		
			$this->redirect('/hrattchange/');	
		}
		
		
	}
	
	/* clear the cache */
	
	public function beforeFilter() { 
		//$this->disable_cache();
		$this->show_tabs(45);
	}
	
		
		
	
	
	
}