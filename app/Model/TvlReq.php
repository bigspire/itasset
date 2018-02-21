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

class TvlReq extends AppModel {
	
	public $name = 'TvlReq';
	 
	public $useTable = 'tvl_request';
	  
	public $primaryKey = 'id';	

	public $hasOne = array(		
		'TvlReqStatus' => array(
            'className'  => 'TvlReqStatus',
			'foreignKey' => 'tvl_request_id'			
        )
	);
	
	public $belongsTo = array(				
		'HrEmployee' => array(
            'className'  => 'HrEmployee',
			'foreignKey' => 'app_users_id'			
        ),
		'TskCustomer' => array(
            'TskCustomer'  => 'TskCustomer',
			'foreignKey' => 'tsk_company_id'			
        ),
		'TvlMode' => array(
            'TvlMode'  => 'TvlMode',
			'foreignKey' => 'tvl_mode_id'			
        ),
		'TvlPlace' => array(
            'TvlPlace'  => 'TvlPlace',
			'foreignKey' => 'tvl_dest_id'			
        )
	);
	
	public $validate = array(	  
        'purpose' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please enter the purpose'
            )
        ),
		 'type' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please select the travel type'
            )
        ),
		'tsk_company_id' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please select the customer'
            )
		),
		'tvl_mode_id' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please select the mode of travel'
            )
			
		),
		'tvl_mode_option' => array(		
            'empty' => array(
                'rule'     => 'validate_mode_option',
                'required' => true,
                'message'  => 'Please select any class'
            )
		),
		'tvl_dest_id' => array(		
            'empty' => array(
                'rule'     => 'validate_place',
                'required' => true,
                'message'  => 'Please select the place of travel'
            )
		),
		'start_date' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please select the date of journey'
            ),
			 'already_exist' => array(
                'rule'     => 'validate_start_exist',
                'required' => true,
                'message'  => 'You already created travel request on this date'
            )
		),		
		'return_date' => array( 
			 'empty' => array(
                'rule'     => 'validate_date',
                'required' => true,
                'message'  => 'Please select the return date'
            ),
			 'already_return_exist' => array(
                'rule'     => 'validate_return_exist',
                'required' => true,
                'message'  => 'You already created travel request on this return date'
            )
		),
		'expected_outcome' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please enter the expected outcome'
            )
		),
		'passenger' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please enter the passenger name'
            )
		)
		,
		'age' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please enter the age'
            )
		),
		'gender' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please select the gender'
            )
		),
		'id_type' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please select the id card type'
            )
		),
		'id_no' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please enter the id card no.'
            )
		),
		'mobile_no' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please enter the mobile no.'
            )
		),
		'email_id' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please enter the email address'
            ),
			 'valid' => array(
                'rule'     => 'email',
                'required' => true,
                'message'  => 'Please enter the valid email address'
            )
		)
		
	);
	
	/* function check for start time already exists */
	public function validate_start_exist(){ 
		$count = $this->find('count', array('conditions' => array('TvlReq.app_users_id' => CakeSession::read('USER.Login.id'), 'TvlReq.start_date' => $this->format_date_save($this->data['TvlReq']['start_date']))));
		if($count > 0){
			return false;
		}else{
			return true;
		}
	}
	
	/* function check for return time already exists */
	public function validate_return_exist(){ 
		if($this->data['TvlReq']['type'] == 2){
			$count = $this->find('count', array('conditions' => array('TvlReq.app_users_id' => CakeSession::read('USER.Login.id'), 'TvlReq.return_date' => $this->format_date_save($this->data['TvlReq']['return_date']))));
			if($count > 0){
				return false;
			}else{
				return true;
			}
		}
		return true;
	}
	
	
	/* function to validate mode options */
	public function validate_mode_option(){ 
		if($this->data['TvlReq']['tvl_mode_option'][0] != ''){
			return true;
		}else{
			return false;
		}
	}
	
	/* function to validate the place */
	public function validate_place(){
		$validator = $this->validator();	
		if(empty($this->data['TvlReq']['tvl_depart_id'])){
			$validator['tvl_dest_id']['empty']->message = 'Please select the source place';
			return false;
		}elseif(empty($this->data['TvlReq']['tvl_dest_id'])){
			$validator['tvl_dest_id']['empty']->message = 'Please select the destination place';
			return false;
		}elseif($this->data['TvlReq']['tvl_depart_id'] == $this->data['TvlReq']['tvl_dest_id']){
			$validator['tvl_dest_id']['empty']->message = 'Source and destination place shouldn\'t be same';
			return false;
		}else{
			return true;
		}
	}
	
	/* function to validate the return date */
	public function validate_date(){
		if(empty($this->data['TvlReq']['return_date']) && $this->data['TvlReq']['type'] == '2'){
			return false;
		}else{
			return true;
		}
	}

		
	/* function to format the date to save */
	public function format_date_save($date){ 
		$exp_date = explode('/', $date); 
		return $exp_date[2].'-'.$exp_date[1].'-'.$exp_date[0];
	}
	
	

	
}