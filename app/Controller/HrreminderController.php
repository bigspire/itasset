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
 
class HrreminderController extends AppController {  
	
	public $name = 'HrReminder';	
	
	public $helpers = array('Html', 'Form', 'Session');
	
	public $components = array('Session', 'Functions');
	
	public $layout = 'refresh';	
	
	

	/* function to update the forgot attendance */
	public function att_change_reminder($from){ 
		
	
		
		// fetch all users
		$this->loadModel('Home');
		$this->Home->unBindModel(array('hasOne' => array('Todo')));
		$this->Home->unBindModel(array('belongsTo' => array('HrDepartment','HrDesignation','HrBranch','HrCompany','HrBusinessUnit','HrBloodGroup')));
		// fetch all users
		$user_data = $this->Home->find('all', array('conditions' => array('Home.status' => '1', 'Home.is_deleted' => 'N'), 
		'fields' => array('Home.doj','Home.first_name', 'Home.hr_branch_id', 'Home.last_name', 'Home.id','Home.email_address')));
		
		
		foreach($user_data as $user){  
			$from = date('Y-m-d',strtotime("-1 week"));
			$doj = $user['Home']['doj'];
			
			if($doj != '0000-00-00'){
			
			$this->loadModel('HrAttendance');	
			
			 $to = date('Y-m-d',strtotime("-1 days"));
				
			// for new comer
			if(strtotime($doj) > strtotime($to)){  
				$from = $doj;
				$diff = -1;
			}else if(strtotime($doj) > strtotime($from)){
				$from = $doj;
				$diff = $this->HrReminder->diff_date($from, $to);	
					
			}else{		
				// find diff b/w the dates
				$diff = $this->HrReminder->diff_date($from, $to);					
			}
		
			
		
			
		
			
		
			
			// fetch holidays to skip 
			$this->loadModel('HrHoliday');
			$holiday_list = $this->HrHoliday->find('all', array('fields' => array('event_date'), 
			'conditions' => array('hr_branch_id' =>  $user['Home']['hr_branch_id'], 
			'HrHoliday.status' => '1', 'HrHoliday.is_deleted' => 'N', 'event_date like' => date('Y').'%'),
			'order' => array('event_date' => 'asc'),'group' => array('HrHoliday.id')));
			$holidays = array();	
			foreach($holiday_list as $event){
				$holidays[] = $event['HrHoliday']['event_date'];
			}
			
			// get approved leaves
			$this->loadModel('HrLeave');
			$dateCond = array('or' => array('leave_from between ? and ?' => array($from, $to),
			'leave_to between ? and ?' => array($from, $to))); 
			$leave_list = $this->HrLeave->find('all', array('fields' => array('leave_from','leave_to'),
			'conditions' => array('HrLeave.app_users_id' => $user['Home']['id'],
			'HrLeave.is_approve' => 'Y', $dateCond), 'order' => array('leave_from' => 'asc'), 'group' => array('HrLeave.id')));
						
			$leaves = array();			
			// iterate the leaves
			foreach($leave_list as $leave){	
				
				$days_diff = $this->HrReminder->diff_date($leave['HrLeave']['leave_from'], 
				$leave['HrLeave']['leave_to']);		
				if($days_diff > 0){
					$leaves[] = $leave['HrLeave']['leave_from'];
					// if diff. is there, get all dates					
					while($leave['HrLeave']['leave_from'] != $leave['HrLeave']['leave_to']){
						$next_date = date('Y-m-d', strtotime($leave['HrLeave']['leave_from'] . ' + 1 day'));
						$leaves[] = $next_date;
						$leave['HrLeave']['leave_from'] = $next_date;
					}
				}else{
					$leaves[] = $leave['HrLeave']['leave_from'];
				}
				
			}
			
			// match for already created change req.
			$req = $this->get_att_change_request($from, $to, $user['Home']['id']);
			
			//if($user['Home']['email_address'] == 'ravi@bigspire.com'){ 
		
			while($diff >= 0){
				$from_split = explode('-', $from);
				$sat = date('N', strtotime($from));
				if($sat == '6'){
					$no_days = date('t', strtotime($from));
					$first_day = date('N', strtotime($from_split[0].'-'.$from_split[1].'-'.'01'));
						switch($first_day){	
							case '1':
							$first_sat = 6; 
							break;
							case '2':
							$first_sat = 5; 
							break;
							case '3':
							$first_sat = 4; 
							break;
							case '4':
							$first_sat = 3; 
							break;
							case '5':
							$first_sat = 2; 
							break;
							case '6':
							$first_sat = 1; 
							break;
							case '7':
							$first_sat = 7; 
							break;					
							
						}
						//$first_sat; 
						$second_sat = $first_sat + 7;  
						$third_sat = $second_sat + 7; 
						$forth_sat = $third_sat + 7;	 			
				}
				
		
				
				$day = date('N', strtotime($from));
				// skip sunday
				if($day != '7' && in_array($from, $holidays) === FALSE &&  in_array($from, $req) === FALSE && $from_split[2] != $second_sat && $from_split[2] != $forth_sat
					&& in_array($from, $leaves) === FALSE ){
					// get the last days attendance
					$data = $this->HrAttendance->find('all', array('fields' => array('in_time', 'out_time'), 'conditions' => array('app_users_id' => $user['Home']['id'], 
					'or' => array('in_time like' => $from.'%', 'out_time like' => $from.'%')), 'group' => array('HrAttendance.id'), 'limit' => '1'));
					
					
					if($data[0]['HrAttendance']['in_time'] == '' || $data[0]['HrAttendance']['out_time'] == ''){
					
						$att_status[] = $from;
					}
					
					
					/*
					if($data[0]['HrAttendance']['in_time'] != '' &&	$data[0]['HrAttendance']['out_time'] != ''){
						//echo "Both marked on $from"."<br>";
					}else if($data[0]['HrAttendance']['in_time'] == '' && $data[0]['HrAttendance']['out_time'] == ''){
						$att_status['both'][] = $from;
					}else if($data[0]['HrAttendance']['in_time'] == ''){
						$att_status['in'][] = $from;
					}else if($data[0]['HrAttendance']['out_time'] == ''){
						$att_status['out'][] = $from;
					}
					*/
				}	
				$from =  date('Y-m-d', strtotime($from ." +1 days"));	
				
				$diff--;
				
				
			}
			
			//}
			
			
	
			
			// send mail to users			
			if(count($att_status) > 0){
				$vars = array('from_name' => 'hrd@ceotalentsearch.com',	'name' => $user['Home']['first_name'].' '.$user['Home']['last_name'], 'attendance' => $att_status);
				if(!$this->send_email('My PDCA - Attendance Reminder  - '.date('d-M-Y'), 'attendance_reminder', 'noreply@mypdca.in', $user['Home']['email_address'],$vars)){		
					// show the msg.								
					//$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in sending the mail...', 'default', array('class' => 'alert alert-error'));				
				}else{
						echo 'mail sent to '.  $user['Home']['first_name'].' ('.$user['Home']['email_address'].')<br>';
						// update reminder table
						$this->loadModel('HrAttChgReminder');
						$this->request->data['HrAttChgReminder']['app_users_id'] = $user['Home']['id'];
						$this->request->data['HrAttChgReminder']['reminder_date'] = $this->Functions->get_current_date();
						$this->HrAttChgReminder->create();
						$this->HrAttChgReminder->save($this->request->data['HrAttChgReminder']);
					}
			}
			
			unset($att_status);
			//$att_count = count($att_status['in']) + count($att_status['out']) + count($att_status['both']);
			
		
			
			// set the variables
			
			/*
			$this->set('intime_miss', $att_status['in']);
			$this->set('outtime_miss', $att_status['out']);
			$this->set('bothtime_miss', $att_status['both']);
			*/
		}
		
		}
		
		$this->render(false);
		
		
	}
	
	
	
	
}