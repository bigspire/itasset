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

class HrPermission extends AppModel {
	
	public $name = 'HrPermission';
	 
	public $useTable = 'hr_permission';
	  
	public $primaryKey = 'id';	
	
	

	public $hasOne = array(		
		'HrPerStatus' => array(
            'className'  => 'HrPerStatus',
			'foreignKey' => 'hr_permission_id'			
        )
	);
	
	public $belongsTo = array(				
		'Home' => array(
            'className'  => 'Home',
			'foreignKey' => 'app_users_id'			
        )
	);
	
	public $validate = array(
		 'per_date' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please select date of permission'
            )
			/*
			'post_dated' => array(
                'rule'     => 'post_dated',
                'required' => true,
                'message'  => 'Post dated permission is not allowed'
            )*/
        ),
        'per_from' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please select permission from time'
            )
        ),
		'per_to' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please select permission to time'
            )
			,
			 'min_limit' => array(
                'rule'     => 'min_limit',
                'required' => true,
                'message'  => 'Permission should be greater than or equal to 30 mins.'
            )
			,
			 'check_avail' => array(
                'rule'     => 'check_avail',
                'required' => true,
                'message'  => "You are exceeding the monthly hour limit"
            ),
			 'check_exists' => array(
                'rule'     => 'check_exists',
                'required' => true,
                'message'  => 'Permission already created b/w these time'
            ),
			
		),
		'reason' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please enter the reason'
            )
		)
		
		
		
	);
	
	/* function to validate post dated permissions */
	public function post_dated(){ 
		if(strtotime($this->format_date_save($this->data['HrPermission']['per_date'])) < strtotime(date('Y-m-d'))){		
			return false;
		}else{
			return true;
		}
		
	}
	
	
	
	/* function to format the time to save */
	public function format_time_save($time){ 
		$exp_time = explode(' ', $time);
		$time = '2014-03-29 '.$exp_time[0].':00 '.$exp_time[1];
		return date('H:i', strtotime($time));			
	}
	
	/* function to check leave exists */
	public function min_limit(){ 
		$total_hrs = $this->data['HrPermission']['no_hrs'];
		$total_hrs = explode(':', $total_hrs);			
		if($total_hrs[0] == '00' && $total_hrs[1] < 30){
			return false;	
		}else{
			return true;
		}
		
	}
	
	
	
	/* function to check leave exists */
	public function check_exists(){ 
		if(!empty($this->data['HrPermission']['per_from']) && !empty($this->data['HrPermission']['per_to'])){
			$from = $this->format_time_save($this->data['HrPermission']['per_from']);
			$to = $this->format_time_save($this->data['HrPermission']['per_to']);
			$this->unBindModel(array('hasOne' => array('HrPerStatus')));
			$count =  $this->find('count', array('conditions' => array('or' => array('per_from between ? and ?' => 
			array($from, $to),'per_to between ? and ?' => array($from, $to)), 'HrPermission.is_deleted' => 'N', 'is_approve !=' => 'R',  'HrPermission.app_users_id' => $this->data['HrPermission']['user_id'],
			'per_date' => $this->format_date_save($this->data['HrPermission']['per_date']))));
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
		if(!empty($this->data['HrPermission']['per_from']) && !empty($this->data['HrPermission']['per_to']) && !empty($this->data['HrPermission']['per_date'])){
			// get used leave
			$date_str = $this->get_search_date($this->data['HrPermission']['per_date']);
			$this->unBindModel(array('hasOne' => array('HrPerStatus', 'HrPerUser')));			
			$data = $this->find('all', array('fields' => array("TIME_FORMAT(SEC_TO_TIME( SUM( TIME_TO_SEC(no_hrs))), '%k:%i') as count", 'HrPermission.id'), 
			'conditions' => array('HrPermission.app_users_id' => $this->data['HrPermission']['user_id'], 'HrPermission.is_deleted' => 'N', 'is_approve !=' => 'R', 
			'per_date like' => $date_str.'%')));			
			$used = $data[0][0]['count'];
			
			if(empty($used)){	
				$total_hrs = $this->data['HrPermission']['no_hrs'];
			}else{
				$total_hrs = $this->add_time($used, $this->data['HrPermission']['no_hrs']);	
			}
			// find total usable hours					
			$total_hrs = explode(':', $total_hrs);			
			$avail = 2;				
			if(($total_hrs[0] >= $avail && $total_hrs[1] > 0) || ($total_hrs[0] > 2)){ 
				return false;
			}else{
				return true;
			}
		}
		return true;
	}
	
	/* function to format for search date */
	public function get_search_date($date){
		$expl_date = explode('/', $date);
		return $expl_date[2].'-'.$expl_date[1];
	}
	
	/* function to format the date to save */
	public function format_date_save($date){ 
		$exp_date = explode('/', $date); 
		return $exp_date[2].'-'.$exp_date[1].'-'.$exp_date[0];
	}
	
	/* add two time */
	public function add_time($t1, $t2){	
		$sql = "select TIME_FORMAT(addtime('$t1', '$t2'), '%k:%i') as total";
		$result = $this->query($sql);		
		return $result[0][0]['total'];
		
	}
	
	/* add two time */
	public function sub_time($t1, $t2){	
		$sql = "select TIME_FORMAT(subtime('$t1', '$t2'), '%k:%i') as total";
		$result = $this->query($sql);		
		return $result[0][0]['total'];
		
	}

	
	
	
	

	
}