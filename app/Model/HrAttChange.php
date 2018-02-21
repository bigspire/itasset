<?php
/**
 * Application model for Cake.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
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
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

class HrAttChange extends AppModel {
	
	public $name = 'HrAttChange';
	 
	public $useTable = 'hr_attendance_change';
	  
	public $primaryKey = 'id';	
	
	public $hasOne = array(		
		'HrAttStatus' => array(
            'className'  => 'HrAttStatus',
			'foreignKey' => 'hr_attendance_change_id'			
        )
	);
	
	public $belongsTo = array(				
		'Home' => array(
            'className'  => 'Home',
			'foreignKey' => 'app_users_id'			
        ),
		'HrAttendance' => array(
            'className'  => 'HrAttendance',
			'foreignKey' => 'app_users_id'			
        )
	);
	
	public $validate = array(
		 'att_date' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please select date of attendance'
            ),
			'check_exists' => array(
                'rule'     => 'check_exists',
                'required' => true,
                'message'  => 'Attendance already marked for this date'
            ),
			'check_request' => array(
                'rule'     => 'check_request',
                'required' => true,
                'message'  => 'Request already created for this date'
            ),
			'check_valid' => array(
                'rule'     => 'check_valid',
                'required' => true,
                'message'  => 'Invalid attendance date'
            ),
			'check_leave' => array(
                'rule'     => 'check_leave',
                'required' => true,
                'message'  => 'You cannot create request for leave date'
            ),
			'check_limit' => array(
                'rule'     => 'check_limit',
                'required' => true,
                'message'  => 'You cannot create more than 3 request in a month'
            )
        ),
		'att_type' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please choose the attendance type'
            )
			
        ),
        'in_time' => array(		
            'empty' => array(
                'rule'     => 'valid_in',
                'required' => true,
                'message'  => 'Please select the In time'
            )
        ),
		'out_time' => array(		
            'empty' => array(
                'rule'     => 'valid_out',
                'required' => true,
                'message'  => 'Please select the Out time'
            ),
			 'check_task' => array(
                'rule'     => 'valid_task',
                'required' => true,
                'message'  => 'Please update your tasks before creating att. change request'
            )
			
		),
		'reason' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please enter the reason'
            )
		)
		
	);
	
	/* function to validate tasks */
	public function valid_task(){ 
		if(!empty($this->data['HrAttChange']['att_date'])){ 
			$date = explode('/', $this->data['HrAttChange']['att_date']);
			$percent = $this->Home->get_today_planned($date[2].'-'.$date[1].'-'.$date[0], CakeSession::read('USER.Login.id'));
			$validator = $this->validator();
			// if no tasks plans
			if(empty($percent)){
				$validator['out_time']['check_task']->message = "Please create and update your tasks on this date before creating att. change request";
				return false;
			}elseif($percent < 80){
				$validator['out_time']['check_task']->message = "You have not properly planned your tasks on this date (should be min. 80%). Please create correctly before creating att. change request";
				return false;
			}elseif($this->Home->get_today_planned($date[2].'-'.$date[1].'-'.$date[0], CakeSession::read('USER.Login.id'), 1) != ''){
				$validator['out_time']['check_task']->message = "You have not fully updated your tasks on this date. Please update all before creating att. change request";
				return false;
			}
			
			return true;
		}
	}
	
	/* check for max. limit reached */
	public function check_limit(){
		if(!empty($this->data['HrAttChange']['att_date'])){
			$count = $this->find('count', array('conditions' => array('HrAttChange.app_users_id' => CakeSession::read('USER.Login.id'), 'att_date like' => date('Y-m').'%', 'is_approve !=' => 'R'))); 
			if($count > 2){
				return false;
			}else{
				return true;
			}
		}
		
	}
	
	
	/* function validate in time */
	public function check_leave(){
		if(!empty($this->data['HrAttChange']['att_date'])){
			$id = $this->data['HrAttChange']['user_id'];
			$att_date = $this->format_date_save($this->data['HrAttChange']['att_date']);
			$count = $this->get_leave_day($att_date, $id);
			if($count){
				return false;
			}else{
				return true;
			}
		}		
		return true;
	}
	
	/* get leave for the day */
	public function get_leave_day($date, $id){
		$sql = "SELECT COUNT(*) AS `count` FROM `hr_leave` AS `HrLeave` LEFT JOIN `app_users` AS `Home` ON (`HrLeave`.`app_users_id` = `Home`.`id`) 
			 WHERE `HrLeave`.`app_users_id` = '$id' AND `HrLeave`.`is_approve` = 'Y' AND `HrLeave`.`is_deleted` = 'N' AND ((`leave_from` = '$date') OR 
			 (`leave_to` >= '$date' and `leave_from` <= '$date'))";
			$result = $this->query($sql);
			return $result[0][0]['count'];
	}
	
	/* function validate in time */
	public function valid_in(){
		if($this->data['HrAttChange']['att_type'] == 'I' || $this->data['HrAttChange']['att_type'] == 'B'){	
			if(!empty($this->data['HrAttChange']['in_time'])){
				return true;
			}else{
				return false;
			}
		}
		return true;
	}
	
	/* function validate out time */
	public function valid_out(){ 
		if($this->data['HrAttChange']['att_type'] == 'O' || $this->data['HrAttChange']['att_type'] == 'B'){	
			if(!empty($this->data['HrAttChange']['out_time'])){				
				return true;
			}else{
				return false;
			}
		}
		return true;
	}
	
	/* function to format the time to save */
	public function format_time_save($time){ 
		$exp_time = explode(' ', $time);
		$time = '2014-03-29 '.$exp_time[0].':00 '.$exp_time[1];
		return date('H:i', strtotime($time));			
	}
	
	/* function to check leave exists */
	public function check_request(){ 
		if(!empty($this->data['HrAttChange']['att_date'])){	
			$this->HrAttendance->unBindModel(array('hasOne' => array('HrAttStatus')));
			$this->HrAttendance->unBindModel(array('belongsTo' => array('Home','HrAttendance')));
			// check the change req. table
			$data =  $this->find('all', array('fields' => array('att_type', 'in_time', 'out_time'), 'conditions' =>  
			array('HrAttChange.app_users_id' => $this->data['HrAttChange']['user_id'],  'HrAttChange.is_approve !=' => 'R', 
			'att_date' =>  $this->format_date_save($this->data['HrAttChange']['att_date'])),'limit'=> 2, 'order' => array('HrAttChange.att_type'=> 'asc')));
			// if no rec. available
			$validator = $this->validator();
			if(!empty($data)){			
				// check for both condition
				if($this->data['HrAttChange']['att_type'] == 'B'){
					if(empty($data[0]['HrAttChange']['in_time']) && empty($data[0]['HrAttChange']['out_time'])){
						return true;
					}else if(!empty($data[0]['HrAttChange']['in_time']) &&  !empty($data[1]['HrAttChange']['out_time'])){											
						return false;
					}else if(!empty($data[0]['HrAttChange']['in_time']) &&  !empty($data[0]['HrAttChange']['out_time'])){								
						return false;
					}else if(!empty($data[0]['HrAttChange']['in_time']) ||  !empty($data[0]['HrAttChange']['out_time'])){
						$validator['att_date']['check_request']->message = "In time request already created for this date. Choose 'Out Time' option for Type";
						return false;
					}else{ 
						return false;
					}
				}
				else if($this->data['HrAttChange']['att_type'] == 'O'){ 
					if(empty($data[0]['HrAttChange']['out_time']) && !empty($data[0]['HrAttChange']['in_time']) && count($data) < 2){ 
						return true;
					}else{
						return false;
					}
				}
			}else{			
				
				// check in master table for out time condition
				$this->HrAttendance->unBindModel(array('belongsTo' => array('HrBranch','HrDesignation','HrDepartment','HrCompany')));
				$this->HrAttendance->unBindModel(array('hasOne' => array('Todo')));
				$data2 =  $this->HrAttendance->find('all', array('fields' => array('in_time','out_time'), 'conditions' =>  array('app_users_id' => $this->data['HrAttChange']['user_id'], array('or' =>  
				array('HrAttendance.in_time like' => 	$this->format_date_save($this->data['HrAttChange']['att_date']).'%',
				'HrAttendance.out_time like' => $this->format_date_save($this->data['HrAttChange']['att_date']).'%'))), 'limit' => 1));	
				$validator = $this->validator();
				
				if(empty($data2) && $this->data['HrAttChange']['att_type'] == 'O' && empty($data)){					
					$validator['att_date']['check_request']->message = "In time also not marked on this date. choose 'Both' option for Type";					
					return false;
				}else if(!empty($data2[0]['HrAttendance']['in_time']) && !empty($data2[0]['HrAttendance']['out_time']) && $this->data['HrAttChange']['att_type'] == 'B'){					
					$validator['att_date']['check_request']->message = "Request already created for this date";
					return false;
				}else if(!empty($data2) && $this->data['HrAttChange']['att_type'] == 'B'){					
					$validator['att_date']['check_request']->message = "In time already marked on this date. Choose 'Out Time' option for Type";
					return false;
				}else{
					return true;
				}
			}			
		}else{		
			return true;
		}
	}
	
	
	
	/* function to check leave exists */
	public function check_valid(){ 
		if(!empty($this->data['HrAttChange']['att_date'])){
			if(strtotime($this->format_date_save($this->data['HrAttChange']['att_date'])) >= strtotime(date('Y-m-d'))){
				return false;
			}
		}
		return true;
	}
	
	/* function to check leave exists */
	public function check_exists(){ 
		if(!empty($this->data['HrAttChange']['att_date'])){			
			$this->HrAttendance->unBindModel(array('belongsTo' => array('HrBranch','HrDesignation','HrDepartment','HrCompany')));
			$this->HrAttendance->unBindModel(array('hasOne' => array('Todo')));
			$data =  $this->HrAttendance->find('all', array('fields' => array('in_time','out_time'), 
			'conditions' =>  array('app_users_id' => $this->data['HrAttChange']['user_id'], array('or' =>  
		    array('HrAttendance.in_time like' => 	$this->format_date_save($this->data['HrAttChange']['att_date']).'%', 
			'HrAttendance.out_time like' => $this->format_date_save($this->data['HrAttChange']['att_date']).'%'))), 
			'limit' => 1));
			
			if(!empty($data)){						
				// if in time selected
				if($this->data['HrAttChange']['att_type'] == 'I'){
					if(!empty($data[0]['HrAttendance']['in_time'])){				
						return false;
					}
				}			
				// if out time selected
				if($this->data['HrAttChange']['att_type'] == 'O'){
					if(!empty($data[0]['HrAttendance']['out_time'])){
						return false;
					}
				}		
				// if both time selected
				if($this->data['HrAttChange']['att_type'] == 'B'){ 
					 if(!empty($data[0]['HrAttendance']['in_time']) && !empty($data[0]['HrAttendance']['out_time'])){
						return false;
					}
				}
			}
			
			
			
		}
		return true;
		
	}
	
	
	/* function to format the date to save */
	public function format_date_save($date){ 
		$exp_date = explode('/', $date); 
		return $exp_date[2].'-'.$exp_date[1].'-'.$exp_date[0];
	}
	
	
	

	
}