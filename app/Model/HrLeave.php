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

class HrLeave extends AppModel {
	
	public $name = 'HrLeave';
	 
	public $useTable = 'hr_leave';
	  
	public $primaryKey = 'id';	
	
	

	public $hasOne = array(		
		'HrLeaveStatus' => array(
            'className'  => 'HrLeaveStatus',
			'foreignKey' => 'hr_leave_id'			
        )
	);
	
	public $belongsTo = array(				
		'Home' => array(
            'className'  => 'Home',
			'foreignKey' => 'app_users_id'			
        ),
		'HrLeaveType' => array(
            'className'  => 'HrLeaveType',
			'foreignKey' => 'hr_leave_type_id'			
        )
	);
	
	public $validate = array(	  
        'leave_from' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please select leave from date'
            )
			/*
			'post_dated_from' => array(
                'rule'     => 'post_dated_from',
                'required' => true,
                'message'  => 'Post dated leave is not allowed'
            )*/
        ),
		'leave_to' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please select leave to date'
            ),
			 'check_exists' => array(
                'rule'     => 'check_exists',
                'required' => true,
                'message'  => 'Leaves already created b/w these dates'
            )
			/*
			'post_dated_to' => array(
                'rule'     => 'post_dated_to',
                'required' => true,
                'message'  => 'Post dated leave is not allowed'
            )*/
		),
		'hr_leave_type_id' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please select leave type'
            )
			,
			'check_pl_eligible' => array(
                'rule'     => 'check_pl_eligible',
                'required' => true,
                'message'  => 'Sorry, you can apply for PL after 1 year of completion'
            )
			,
			'check_eligible' => array(
                'rule'     => 'check_eligible',
                'required' => true,
                'message'  => 'Sorry, you are not eligible to apply leave for this month'
            ),
			 'check_avail' => array(
                'rule'     => 'check_avail',
                'required' => true,
                'message'  => 'You have no leaves available in this leave type or exceeding the available limit'
            ),
			 'check_pl_times' => array(
                'rule'     => 'check_pl_times',
                'required' => true,
                'message'  => 'You have reached the limit of PL for this year (max. 4 times)'
            )
			
			,
			 'check_pl_prior' => array(
                'rule'     => 'check_pl_prior',
                'required' => true,
                'message'  => 'Sorry, you should apply for PL 7 days before date of leave'
            )
			,			
			'check_req_limit' => array(
                'rule'     => 'check_req_limit',
                'required' => true,
                'message'  => 'Sorry, Max. 2 leave applications per month is only allowed'
            )
			
			,
			 'check_paternity' => array(
                'rule'     => 'check_paternity',
                'required' => true,
                'message'  => 'Sorry, you should apply paternity leave 3 weeks before date of leave'
            ),
			/*
			,
			 'check_maternity' => array(
                'rule'     => 'check_maternity',
                'required' => true,
                'message'  => 'Sorry, you should apply maternity leave 8 weeks before date of leave'
            ),
			*/
			 'check_valid_maternity' => array(
                'rule'     => 'check_valid_maternity',
                'required' => true,
                'message'  => 'Sorry, you should have 80 working days to privilege for maternity leave'
            ),
			
			'check_tasks_od' => array(
                'rule'     => 'check_tasks_od',
                'required' => true,
                'message'  => 'You should plan your tasks for the leave days before creating the OD leaves'
            )
			
		),
		'reason' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please enter the reason'
            )
		),		
		'session' => array(		
            'empty' => array(
                'rule'     => 'validate_session',
                'required' => true,
                'message'  => 'Please select the session'
            )
		),
		'comp_off_dates' => array(		
            'empty' => array(
                'rule'     => 'validate_compoff',
                'required' => true,
                'message'  => 'Please select the date of working'
            ),
			 'compoff_limit' => array(
                'rule'     => 'compoff_limit',
                'required' => true,
                'message'  => 'Sorry, maximum 2 days of comp. off are allowed'
            ),
			'compoff_match' => array(
                'rule'     => 'compoff_match',
                'required' => true,
                'message'  => 'No. of comp. off days not matching with no. of days selected'
            )
			,
			'compoff_attendance' => array(
                'rule'     => 'compoff_attendance',
                'required' => true,
                'message'  => "You have not marked your attendance on these dates"
            ),
			'compoff_exists' => array(
                'rule'     => 'compoff_exists',
                'required' => true,
                'message'  => "You have already used this comp off date(s)"
            ),
			'compoff_period' => array(
                'rule'     => 'compoff_period',
                'required' => true
            ),
			'compoff_future' => array(
                'rule'     => 'compoff_future',
                'required' => true
            )
		)
		
	);
	
	/* function to validate post dated leaves */
	public function post_dated_from(){ 
		if(strtotime($this->format_date_save($this->data['HrLeave']['leave_from'])) < strtotime(date('Y-m-d'))){		
			return false;
		}else{
			return true;
		}
		
	}
	
	/* function to validate post dated leaves */
	public function post_dated_to(){ 
		if(strtotime($this->format_date_save($this->data['HrLeave']['leave_to'])) < strtotime(date('Y-m-d'))){		
			return false;
		}else{
			return true;
		}
		
	}
	
	
	/* function to validate maternity leaves */
	public function check_paternity(){
		if(!empty($this->data['HrLeave']['leave_from']) && !empty($this->data['HrLeave']['leave_to'])){
			$leave_from = $this->format_date_save($this->data['HrLeave']['leave_from']);
			$cur_date = date('Y-m-d');
			$diff = $this->diff_date($cur_date, $leave_from);			
			if($diff <= 21 && $this->data['HrLeave']['hr_leave_type_id'] == '5'){
				return false;
			}else{
				return true;
			}
		}else{
			return true;
		}	
	}
	
	
	public function check_valid_maternity(){
		if($this->data['HrLeave']['hr_leave_type_id'] == '4'){
			if(!empty($this->data['HrLeave']['leave_from']) && !empty($this->data['HrLeave']['leave_to'])){
				$leave_from = $this->format_date_save($this->data['HrLeave']['leave_from']);
				$id = CakeSession::read('USER.Login.id');
				$sql = "select count(*) as total_att from hr_attendance where app_users_id = '$id' and status = 'A'";
				$result = $this->query($sql);
				if($result[0][0]['total_att'] >= 80){
					return true;
				}else{
					return false;
				}
			}else{
				return true;
			}
		}else{
			return true;
		}		
	}
	
	/* function to validate tasks for od leaves */
	public function check_tasks_od(){
		if(!empty($this->data['HrLeave']['leave_from']) && !empty($this->data['HrLeave']['leave_to'])){
			if($this->data['HrLeave']['hr_leave_type_id'] == '6'){
				$leave_days = array();
				$leave_days = $this->get_leave_dates($this->data['HrLeave']['leave_from'],$this->data['HrLeave']['leave_to']);
				foreach($leave_days  as $date){
					$percent = $this->Home->get_today_planned($date, CakeSession::read('USER.Login.id'));
					$validator = $this->validator();
					// if no tasks plans
					if($percent < 80){
						return false;
					}					
				}
				return true;
			}else{
				return true;
			}
		}
	}
	
	/* function to get the complete leave days */
	public function get_leave_dates($from, $to){
		$frm_date = explode('/', $from);
		$days = array();
		if($from == $to){ 
			$days[] = $frm_date[2].'-'.$frm_date[1].'-'.$frm_date[0];
			return $days;
		}else{
			for($i = 0; $i < $this->data['HrLeave']['no_days']; $i++){ 
				$days[] = date('Y-m-d',  strtotime($frm_date[2].'-'.$frm_date[1].'-'.$frm_date[0].' +'.$i.' days'));
			}
			return $days;
		}
	}
	
		
	/* function to validate maternity leaves */
	public function check_maternity(){
		if(!empty($this->data['HrLeave']['leave_from']) && !empty($this->data['HrLeave']['leave_to'])){
			$leave_from = $this->format_date_save($this->data['HrLeave']['leave_from']);
			$cur_date = date('Y-m-d');
			$diff = $this->diff_date($cur_date, $leave_from);			
			if($diff <= 60 && $this->data['HrLeave']['hr_leave_type_id'] == '4'){
				return false;
			}else{
				return true;
			}
		}else{
			return true;
		}	
	}
	
	/* function to check the max. leave limit */
	public function check_req_limit(){
		if((!empty($this->data['HrLeave']['leave_from']) && !empty($this->data['HrLeave']['leave_to'])) && ($this->data['HrLeave']['hr_leave_type_id'] != '6'  && 
			$this->data['HrLeave']['hr_leave_type_id'] != '3'  && $this->data['HrLeave']['hr_leave_type_id'] != '7')){
			$id = CakeSession::read('USER.Login.id');
			//if($id == '15'){ return true;}
			$leave_month = $this->get_search_date($this->data['HrLeave']['leave_from']);
			$sql = "select count(*) as count from hr_leave where app_users_id = '$id' and is_approve != 'R'
			and hr_leave_type_id !=  '3' and is_deleted = 'N' and hr_leave_type_id !=  '6' and hr_leave_type_id !=  '7' and leave_from like '%$leave_month%'";		
			$result = $this->query($sql);
			
			if($result[0][0]['count'] >= 2){
				return false;
			}else{
				return true;
			}
		}else{
			return true;
		}
	}
	
	
	/* function to validate comp off period*/
	public function compoff_period(){
		if(!empty($this->data['HrLeave']['leave_from']) && !empty($this->data['HrLeave']['leave_to'])){						
			if($this->data['HrLeave']['hr_leave_type_id'] == '7'){ 
				$from_date = $this->format_date_save($this->data['HrLeave']['leave_from']);				
				$date1 = $this->data['HrLeave']['comp_off_dates'][0];
				$date2 = $this->data['HrLeave']['comp_off_dates'][1];			
			
				$diff1 = $this->diff_date($date1, $from_date);
				if(!empty($date2)){
					$diff2 = $this->diff_date($date2, $from_date);
				}
				
				// find the business unit and limit of days
				/*
				$data = $this->Home->findById(CakeSession::read('USER.Login.id'), array('fields'=> 'Home.hr_business_unit_id'));					
				if($data['Home']['hr_business_unit_id'] == 1){
					$limit = 30;
				}else{
					$limit = 15;
				}
				*/
				$limit = 30;
				$validator = $this->validator();
				if($diff1 > $limit){					
					$validator['comp_off_dates']['compoff_period']->message = "Comp. off should be used within $limit days from the date of leave";
					return false;
				}
				if($diff2 > $limit){
					$validator['comp_off_dates']['compoff_period']->message = "Comp. off should be used within $limit days from the date of leave";
					return false;
				}
				return true;
			}
			return true;
		}
		return true;
				
		
	}
	
	
	/* function to validate comp. off for old dates */
	public function compoff_future(){
	
	$id = CakeSession::read('USER.Login.id');
	//if($id == '24'){ return true;}
	
		if(!empty($this->data['HrLeave']['leave_from']) && !empty($this->data['HrLeave']['leave_to'])){						
			if($this->data['HrLeave']['hr_leave_type_id'] == '7'){ 
				$validator = $this->validator();
				$from_date = $this->format_date_save($this->data['HrLeave']['leave_from']);		
				if(count($this->data['HrLeave']['comp_off_dates']) == 1){
					if(strtotime($from_date) <= strtotime($this->data['HrLeave']['comp_off_dates'][0])){
						$validator['comp_off_dates']['compoff_future']->message = "Leave From date must be greater than Comp. Off date(s)";
						return false;
					}else{
						return true;
					}
				}else if(count($this->data['HrLeave']['comp_off_dates']) == 2){ 
					if(strtotime($from_date) <= strtotime($this->data['HrLeave']['comp_off_dates'][0]) || strtotime($from_date) <= strtotime($this->data['HrLeave']['comp_off_dates'][1])){
						$validator['comp_off_dates']['compoff_future']->message = "Leave From date must be greater than Comp. Off date(s)";
						return false;
					}else{
						return true;
					}
				}
			}
			
		}
		return true;
					
	}
	
	
	/* function to validate comp off limit */
	public function compoff_exists(){
		if($this->data['HrLeave']['hr_leave_type_id'] == '7'){ 		
			$id = CakeSession::read('USER.Login.id');
			$date1 = $this->data['HrLeave']['comp_off_dates'][0];
			$date2 = $this->data['HrLeave']['comp_off_dates'][1];	
			if($date2 != ''){
				$sql = "select count(*) as count from hr_leave_compoff where app_users_id = '$id' and is_approve != 'R' and (comp_off =  '$date1%' or comp_off = '$date2%') limit 2";
			}else{
				$sql = "select count(*) as count from hr_leave_compoff where app_users_id = '$id' and is_approve != 'R' and (comp_off =  '$date1%') limit 1";
			}
			$result = $this->query($sql);
			if($result[0][0]['count'] > 0){
				return false;
			}else{
				return true;
			}
		}
		return true;
	}
	
	
	
	
	/* function to validate comp off limit */
	public function compoff_attendance(){ 
		if($this->data['HrLeave']['hr_leave_type_id'] == '7'){ 		
			$id = CakeSession::read('USER.Login.id');
			$date1 = $this->data['HrLeave']['comp_off_dates'][0];
			$date2 = $this->data['HrLeave']['comp_off_dates'][1];
			if($date2 != ''){
				$sql = "select in_time, out_time from hr_attendance where app_users_id = '$id' and (in_time like '$date1%' or in_time like '$date2%') limit 2";
			}else{
				$sql = "select in_time, out_time from hr_attendance where app_users_id = '$id' and (in_time like '$date1%') limit 1";
			}						
			$result = $this->query($sql);
			$flag = true;
			// when no attendance marked
			$total = count($this->data['HrLeave']['comp_off_dates']);
			if(count($result) < $total){
				$flag = false;
			}
			// iterate the in and out of comp off dates
			foreach($result as $value){ 
				if($value['hr_attendance']['in_time'] == '' || $value['hr_attendance']['out_time'] == ''){
					$flag = false;
				}
			}
			
			// for on duty leave comp. off
			if($flag == false){
				$cond = "('$date1' between leave_from and leave_to)";
				if($date2 != ''){
					$cond .= " or ('$date2' between leave_from and leave_to)";
				}
				$sql = "select leave_from from hr_leave where app_users_id = '$id' and hr_leave_type_id = '6' and $cond limit 1";
				$result = $this->query($sql);
				if(!empty($result)){
					$flag = true;
				}
			}
			return $flag;
		}
		return true;
	}
	
	
	/* function to validate comp off limit */
	public function compoff_match(){
		if($this->data['HrLeave']['hr_leave_type_id'] == '7'){ 
			if(!empty($this->data['HrLeave']['comp_off_dates'])){ 
				if(count($this->data['HrLeave']['comp_off_dates']) != $this->data['HrLeave']['no_days']){
					return false;
				}else{
					return true;
				}				
			}else{
				return true;
			}	
		}
		return true;
	}
	
	
	
	/* function to validate comp off limit */
	public function compoff_limit(){
		if($this->data['HrLeave']['hr_leave_type_id'] == '7'){ 
			if(!empty($this->data['HrLeave']['comp_off_dates'])){ 
				if(count($this->data['HrLeave']['comp_off_dates']) > 2){
					return false;
				}else{
					return true;
				}				
			}else{
				return true;
			}	
		}
		return true;
	}
	
	
	/* function to validate comp. off dates */
	public function validate_compoff(){
		if($this->data['HrLeave']['hr_leave_type_id'] == '7'){ 
			if(empty($this->data['HrLeave']['comp_off_dates'])){ 
				return false;
			}else{
				return true;
			}	
		}
		return true;
	}
	
	
	/* function to validate pl prior */
	public function check_pl_prior(){
		if(!empty($this->data['HrLeave']['leave_from']) && !empty($this->data['HrLeave']['leave_to'])){
			$leave_from = $this->format_date_save($this->data['HrLeave']['leave_from']);
			$leave_to = $this->format_date_save($this->data['HrLeave']['leave_to']);
			$cur_date = date('Y-m-d');
			$user_id = CakeSession::read('USER.Login.id');
			$diff = $this->diff_date($cur_date, $leave_from);	
			// check in leave request
			$sql = "select count(*) as count from hr_pl_request where date_from = '$leave_from' and date_to = '$leave_to'
			and status = 'A' and app_users_id = '$user_id'";
			$result = $this->query($sql);
			if($result[0][0]['count'] == 1){
				return true;
			}else if($diff <= 7 && $this->data['HrLeave']['hr_leave_type_id'] == '2'){
				return false;
			}else{
				return true;
			}
		}else{
			return true;
		}	
	}
	
	/* function to validate no. of times pl */
	public function check_pl_times(){
		$this->unBindModel(array('hasOne' => array('HrLeaveStatus')));
		$date_str = $this->get_search_year($this->data['HrLeave']['leave_from']);
		$count = $this->find('count', array('conditions' => array('HrLeave.app_users_id' => CakeSession::read('USER.Login.id'), 'HrLeave.leave_from like' => $date_str.'%',
		'HrLeave.is_approve !=' => 'R', 'HrLeave.is_deleted'=> 'N', 'HrLeave.hr_leave_type_id' => 2)));	
		if($count >= 4 && $this->data['HrLeave']['hr_leave_type_id'] == '2'){
			return false;
		}else{
			return true;
		}		
	}
	
	
	/* function to validate pl eligible */
	public function check_pl_eligible(){
		$data = $this->Home->findById(CakeSession::read('USER.Login.id'), array('fields'=> 'doj'));		
		// get diff b/w date
		$next_year =date('Y-m-d',strtotime($data['Home']['doj'] . " + 364 day"));
		$cur_date = date('Y-m-d');
		if($cur_date <= $next_year && $this->data['HrLeave']['hr_leave_type_id'] == '2'){
			return false;
		}else{
			return true;
		}		
	}
	
	/* function to validate emp. join after 15th */
	public function check_eligible(){
		$data = $this->Home->findById(CakeSession::read('USER.Login.id'), array('fields'=> 'doj'));
		$date = explode('-', $data['Home']['doj']);
		$split_leave = explode('/', $this->data['HrLeave']['leave_from']);	
		// for special leave and nbl check condition
		if($this->data['HrLeave']['hr_leave_type_id'] == '1' || $this->data['HrLeave']['hr_leave_type_id'] == '8'){
			if($split_leave[2] == $date[0] && $split_leave[1] == $date[1]){
				// get diff b/w date
				$diff = $this->diff_date($data['Home']['doj'], date('Y-m-d'));
				if($diff < 30){
					if($date[2] > 15  && $this->data['HrLeave']['hr_leave_type_id'] != '3' ){ 
						return false;
					}else{
						return true;
					}
				}else{
					return true;
				}
			}
		}
		return true;
		
	}
	
	/* get diff b/w the date */
	public function diff_date($from, $to){ 
		$sql = "SELECT DATEDIFF('$to','$from') AS date_diff";
		$result = $this->query($sql);		
		return $result[0][0]['date_diff'];

	}
	
	/* function to validate session */
	public function validate_session(){
		if(!empty($this->data['HrLeave']['is_half'])){
			if(empty($this->data['HrLeave']['session'])){
				return false;
			}
		}
		return true;
	}
	
	/* function to check leave exists */
	public function check_exists(){
		if(!empty($this->data['HrLeave']['leave_from']) && !empty($this->data['HrLeave']['leave_to'])){
			$from = $this->format_date_save($this->data['HrLeave']['leave_from']);
			$to = $this->format_date_save($this->data['HrLeave']['leave_to']);
			$count =  $this->find('count', array('conditions' => array('or' => array('leave_from between ? and ?' => array($from, $to),
			'leave_to between ? and ?' => array($from, $to)), 'HrLeave.app_users_id' => $this->data['HrLeave']['user_id'],  'HrLeave.is_deleted'=> 'N', 'is_approve !=' =>  'R')));
			if($count > 0){
				return false;
			}else{
				return true;
			}
		}
		return true;
	}
	
	/* function to check leave exists */
	public function check_avail(){
		if(!empty($this->data['HrLeave']['leave_from']) && !empty($this->data['HrLeave']['leave_to'])){
			if(!empty($this->data['HrLeave']['hr_leave_type_id']) && $this->data['HrLeave']['hr_leave_type_id'] != '3' && $this->data['HrLeave']['hr_leave_type_id'] != '6' && $this->data['HrLeave']['hr_leave_type_id'] != '7'){			
				// for nbl and pl
				if($this->data['HrLeave']['hr_leave_type_id'] == '1' || $this->data['HrLeave']['hr_leave_type_id'] == '2'){
					$validator = $this->validator();
					// get applied leaves
					$used = $this->get_applied_leaves();
					// for nbl
					if($this->data['HrLeave']['hr_leave_type_id'] == '1'){
						// for associates condition
						if(CakeSession::read('USER.Login.emp_type') == 'A'){
							$balance = abs(1 - $used);
						}else{
							$prev_bal = $this->get_bal_nbl($this->data['HrLeave']['user_id']);						
							$balance = abs($prev_bal - $used);
						}
						$eligible_nbl = CakeSession::read('USER.Login.probation') == 'Y' ? 1 : 2;
						// check for probation						
						if($balance >=  $this->data['HrLeave']['no_days']){
							if($this->data['HrLeave']['no_days'] <= $eligible_nbl){ // pl must be greater than or equals 3
								// make sure only 2 days allowed in a month
								$this->unBindModel(array('hasOne' => array('HrLeaveStatus')));
								$date_str = $this->get_search_date($this->data['HrLeave']['leave_from']);
								$data = $this->find('all', array('fields' => array('sum(HrLeave.no_days) as count'), 'conditions' => array('HrLeave.app_users_id' => 
								$this->data['HrLeave']['user_id'],  'is_approve !=' =>  'R', 'leave_from like' => $date_str.'%', 'HrLeave.hr_leave_type_id' => 
								$this->data['HrLeave']['hr_leave_type_id'], 'HrLeave.is_deleted'=> 'N',  'max_limit' => '1')));
								$month_leave =  $data[0][0]['count'];
								$total_leaves = $month_leave + $this->data['HrLeave']['no_days'];								
								if($total_leaves <= $eligible_nbl){
									return true;
								}else{ 
									if(CakeSession::read('USER.Login.id') == '15'){ return true;}
									$validator['hr_leave_type_id']['check_avail']->message = "Maximum limit of NBL is $eligible_nbl in a month";
									return false;
								}
							}else{
								$validator['hr_leave_type_id']['check_avail']->message = "You can avail max. $eligible_nbl days of NBL in a month";
								return false;
							}
								
						}else{ 
							return false;
						}
					}else{ // for pl					
						if($this->data['HrLeave']['no_days'] > 2){ // pl must be greater than or equals 3
							$prev_bal = $this->get_bal_pl($this->data['HrLeave']['user_id']);
							
							$balance = abs($prev_bal - $used);
							// round off it to 30 if more than 30 days
							if($balance > 30) { $balance = 30; }
							if($balance >=  $this->data['HrLeave']['no_days']){
								return true;
							}else{
								return false;
							}
						}else{
							$validator['hr_leave_type_id']['check_avail']->message = 'PL should be more than 2 days';
							return false;
						}
					}
				}
				
				// for Special leave for associates
				if($this->data['HrLeave']['hr_leave_type_id'] == '8'){
					// get sum of spl. leaves
					$sql = "select sum(no_days) as no_days, sum(no_used) as no_used from hr_special_leave  where app_users_id = '".$this->data['HrLeave']['user_id']."'";		
					$data = $this->query($sql);
					$no_spl_leaves = $data[0][0]['no_days'] > 10 ? 10 : $data[0][0]['no_days'];
					$no_spl_used = $data[0][0]['no_used'];
					$remain_spl = $no_spl_leaves - $no_spl_used;	
					// get applied spl leaves
					$this->unBindModel(array('hasOne' => array('HrLeaveStatus')));
					$data = $this->find('all', array('fields' => array('sum(HrLeave.no_days) as count'), 
					'conditions' => array('HrLeave.app_users_id' => $this->data['HrLeave']['user_id'], 
					'is_approve !=' =>  'R', 'HrLeave.is_deleted'=> 'N', 'HrLeave.hr_leave_type_id' => '8'),
					'group' => array('HrLeave.id')));
					$used = $data[0][0]['count'];
					// find the total remaining
					$total_remaining = $remain_spl - $used;
					if($total_remaining >=  $this->data['HrLeave']['no_days']){
						return true;
					}else{
						return false;
					}
				}
				
				// get used leave other than nbl and pl
				$this->unBindModel(array('hasOne' => array('HrLeaveStatus')));
				$date_str = $this->get_search_year($this->data['HrLeave']['leave_from']);

				$data = $this->find('all', array('fields' => array('sum(HrLeave.no_days) as count'), 
				'conditions' => array('HrLeave.app_users_id' => $this->data['HrLeave']['user_id'], 
				'is_approve !=' =>  'R', 'HrLeave.is_deleted'=> 'N', 'leave_from like' => $date_str.'%', 'HrLeave.hr_leave_type_id' => $this->data['HrLeave']['hr_leave_type_id'], 'max_limit' => '1')));
				$used = $data[0][0]['count'];	
				$total_leaves = $used + $this->data['HrLeave']['no_days'];
				// get available leaves
				$leave_avail = $this->HrLeaveType->find('all', array('fields' => array('no_days'), 'order' => array('priority ASC'),'conditions' => array('status' => 1, 'max_limit' => '1', 'is_deleted' => 'N', 'HrLeaveType.id' => $this->data['HrLeave']['hr_leave_type_id'])));
				$avail = $leave_avail[0]['HrLeaveType']['no_days'];
				if($total_leaves <= $avail){
					return true;
				}else{
					return false;
				}
			}
		}
		return true;
	}
	
	
		/* function to format for search date */
	public function get_search_year($date){
		$expl_date = explode('/', $date);
		return $expl_date[2];
	}
	
	
		/* function to format for search date */
	public function get_search_date($date){
		$expl_date = explode('/', $date);
		return $expl_date[2].'-'.$expl_date[1];
	}
	
	
	/* function to get the applied leaves */
	public function get_applied_leaves(){
		$this->unBindModel(array('hasOne' => array('HrLeaveStatus')));
		$date =  explode('/', $this->data['HrLeave']['leave_from']);
		// check for associate condition
		if(CakeSession::read('USER.Login.emp_type') == 'A'){
			$date_str = $date[2].'-'.$date[1]; 
		}else{
			$date_str = $date[2];
		}
		$data = $this->find('all', array('fields' => array('sum(HrLeave.no_days) as count'), 'conditions' => array('HrLeave.app_users_id' => 
		$this->data['HrLeave']['user_id'],  'is_approve !=' =>  'R', 'leave_from like' => $date_str.'%', 'HrLeave.hr_leave_type_id' => 
		$this->data['HrLeave']['hr_leave_type_id'], 'HrLeave.is_deleted'=> 'N', 'max_limit' => '1')));
		return $data[0][0]['count'];
	}
	
	/* function to get the balance ñbl*/
	public function get_bal_nbl($id){ 
		// get used nbl static table		
		$doj = CakeSession::read('USER.Login.doj');
		$doc = CakeSession::read('USER.Login.doc');
		$exp_doj = explode('-', $doj);
		$exp_doc = explode('-', $doc);
		if(CakeSession::read('USER.Login.probation') == 'Y'){
			// check for joined before 15th
			$nbl_count = ($exp_doj[2] <= 15) ? 1 : 0;
			// get the diff. of months in current year
			$nbl_count += 12 - $exp_doj[1];
			$nbl_count = ($nbl_count > 6) ? 6 : $nbl_count;
			if($exp_doj[0] != date('Y')){ 			
				// for next year of probation confirmation
				$nbl_count = 6 - $nbl_count;
			}
			return $nbl_count;
		}else if(CakeSession::read('USER.Login.probation') == 'C' && $exp_doc[0] == date('Y')){ 
			// check for confirmed before 15th
			$nbl_count = ($exp_doc[2] <= 15) ? 1 : 0;
			// get the diff. of months in current year
			$nbl_count += 12 - $exp_doc[1];
			return $nbl_count;
		}else{
			$leave_detail = $this->HrLeaveType->find('first', array('fields' => array('no_days'), 'conditions' => array('status' => 1, 'max_limit' => '1', 'is_deleted' => 'N', 'id' => 1)));
			if($exp_doc[0] == date('Y')){
				$nbl_count = ($exp_doc[2] <= 15) ? 1 : 0;
				$nbl_count += 12 - $exp_doc[1];
			}else{
				$nbl_count = $leave_detail['HrLeaveType']['no_days'];
			}
			return $nbl_count;
		}
		
	}
	
	
	/* function to get the balance pl*/
	public function get_bal_pl($id){
		// get used pl static table				
		$sql = "select sum(pl_bal) as count from hr_leave_balance  where app_users_id = '$id'";		
		$result = $this->query($sql); 		
		return  $result[0][0]['count'];
		
	}
	
	/* function to format the date to save */
	public function format_date_save($date){ 
		$exp_date = explode('/', $date); 
		return $exp_date[2].'-'.$exp_date[1].'-'.$exp_date[0];
	}
	
	/* get leave details of emp */
	public function get_user_leave_details($month, $id, $cond){
		if($cond != ''){			
			$sql = "SELECT sum(l.no_days) as no_days FROM hr_leave l inner join hr_leave_type t on  (t.id = l.hr_leave_type_id) where app_users_id = '$id' 
			and leave_from like '$month%' and is_approve != 'R' and l.is_deleted = 'N' $cond or (leave_to like  '$month%' and leave_from not like '$month%'  and app_users_id = '$id' and 
			l.is_deleted = 'N' $cond);";
		}else{
			$sql = "SELECT leave_from, leave_to, t.desc FROM hr_leave l inner join hr_leave_type t on  (t.id = l.hr_leave_type_id) where app_users_id = '$id' 
			and leave_from like '$month%' and is_approve != 'R' and l.is_deleted = 'N' or (leave_to like  '$month%' and leave_from not like '$month%'  and app_users_id = '$id' and 
			l.is_deleted = 'N');";
		}		
		return $result = $this->query($sql);
	}
	
	
	/* get leave details of lop and od leaves */
	public function get_lop_leaves($month, $id){
		$sql = "SELECT hr_leave_type_id, sum(l.no_days) as no_days FROM hr_leave l inner join hr_leave_type t on  (t.id = l.hr_leave_type_id) where app_users_id = '$id' 
		and leave_from like '$month%' and is_approve != 'R' and (hr_leave_type_id = '3' or hr_leave_type_id = '6') and l.is_deleted = 'N' or 
		(leave_to like  '$month%' and leave_from not like '$month%'  and app_users_id = '$id' and l.is_deleted = 'N' 
		and (hr_leave_type_id = '3' or hr_leave_type_id = '6'))  group by hr_leave_type_id;";
		return $result = $this->query($sql);
	}

	/* get leave for the day */
	public function get_leave_day($date, $id){
		$sql = "SELECT COUNT(*) AS `count` FROM `hr_leave` AS `HrLeave` LEFT JOIN `app_users` AS `Home` ON (`HrLeave`.`app_users_id` = `Home`.`id`) 
		 WHERE `HrLeave`.`app_users_id` = '$id' AND `HrLeave`.`is_approve` = 'Y' AND `HrLeave`.`is_deleted` = 'N' AND ((`leave_from` = '$date') OR 
		 (`leave_to` >= '$date' and `leave_from` <= '$date'))";
		$result = $this->query($sql);		
		return $result[0][0]['count'];
	}
	
	/* function to get comp off days */	
	public function get_comp_dates($id, $in_cond){
		if($in_cond != ''){
			$sql = "SELECT DATE_FORMAT(in_time, '%Y-%m-%d') work_days from hr_attendance where app_users_id = '$id' and DATE_FORMAT(in_time, '%Y-%m-%d') in ($in_cond) and status = 'A'";
			$result = $this->query($sql);
			return $result;
		}
	}
	
	/* function to check comp. req. already created */
	public function get_comp_req($id, $in_cond){
		$data = array();
		if($in_cond != ''){
			$sql = "SELECT comp_off  from hr_leave_compoff where app_users_id = '$id' and comp_off in ($in_cond) and is_approve != 'R'";
			$result = $this->query($sql);
			foreach($result as $res){
				$data[] = $res['hr_leave_compoff']['comp_off'];
				
			}
		}
		return $data;
	}
	
	/* function to check od leaves available */
	public function get_od_leaves($id, $in_cond){
		$data = array();
		if($in_cond != ''){
			/*$sql = "SELECT DATE_FORMAT(leave_from, '%Y-%m-%d') od_leave from hr_leave where app_users_id = '$id' and hr_leave_type_id = '6' and DATE_FORMAT(leave_from, '%Y-%m-%d') in ($in_cond) and is_approve = 'Y' and is_deleted = 'N'";
			$result = $this->query($sql);			
			foreach($result as $res){
				$data[] = $res[0]['od_leave'];
				
			}
			*/
			// check for b/w condition
			$in_ar = explode(',', $in_cond);
			foreach($in_ar as $in_data){
				$in_data = substr($in_data, 1, strlen($in_data)-2);
				$sql = "SELECT DATE_FORMAT(leave_from, '%Y-%m-%d') od_leave from hr_leave where app_users_id = '$id' and hr_leave_type_id = '6' and '$in_data' between DATE_FORMAT(leave_from, '%Y-%m-%d') and DATE_FORMAT(leave_to, '%Y-%m-%d') and is_approve = 'Y' and is_deleted = 'N';";
				$result = $this->query($sql);
				if(!empty($result[0][0]['od_leave'])){
					$data[] = $in_data;	
				}
			}
			
		}
		return $data;
	}
	
}