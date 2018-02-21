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

class TskRoaHistory extends AppModel {
	
	public $name = 'TskRoaHistory';
	 
	public $useTable = 'tsk_applause';
	  
	public $primaryKey = 'id';	

	/*
	public $hasOne = array(		
		'TskApplauseStatus' => array(
            'className'  => 'TskApplauseStatus',
			'foreignKey' => 'tsk_applause_id'			
        )
	);
	*/
	
	public $belongsTo = array(				
		'Home' => array(
            'className'  => 'Home',
			'foreignKey' => 'app_users_id'			
        )
	);
	
	public $validate = array(	  
        'type' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please choose type'
            )
        ),
		'reward_month' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please select the recognition month'
            )
		),
		'employee1' => array(		
            'check_employee' => array(
                'rule'     => 'check_employee',
                'required' => true,
                'message'  => 'Please select the employee(s)'
            )
			
		),
		'employee2' => array(		
            'check_employee' => array(
                'rule'     => 'check_employee',
                'required' => true,
                'message'  => 'Please select the employee(s)'
            )
			
		),
		'emp_relate' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please enter the details'
            )
		),
		'emp_acts' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please enter the details'
            )
		),
		'applause_cat' => array(		
            'empty' => array(
                'rule'     => 'validate_applause_cat',
                'required' => true,
                'message'  => 'Please select any one'
            )
		),
		/*
		'rating' => array(		
            'check_rating' => array(
                'rule'     => 'check_rating',
                'required' => true,
                'message'  => 'Please rate the performance'
            )
			
		)*/
		
	);
	
	/* function to get the team members */
	public function get_team($id, $mod){
		return $this->get_team_mem($id, $mod);
	}
	
	
	/* function to validate the employee */
	public function check_employee(){ 
		if(empty($this->data['TskRoaHistory']['type']) && empty($this->data['TskRoaHistory']['employee1'])){
			return false;
		}else if($this->data['TskRoaHistory']['type'] == 'I' && empty($this->data['TskRoaHistory']['employee1'])){
			return false;
		}else if($this->data['TskRoaHistory']['type'] == 'T' && empty($this->data['TskRoaHistory']['employee2'])){
			return false;
		}
		return true;
	}
	
	/* function to rate the performance */
	public function check_rating(){
		if(empty($this->data['TskRoaHistory']['rating']) || $this->data['TskRoaHistory']['rating'] == 1){
			return false;
		}else{
			return true;
		}
	}
	
	/* function to validate applause category */
	public function validate_applause_cat(){ 
		if(!empty($this->data['TskRoaHistory']['applause_cat'])){
			return true;
		}else{
			return false;
		}
		return false;
	}
	
	public function validate_file(){ 	
		if(!empty($this->data['TskRoaHistory']['upload_file']['name'])){ 
			$this->file_validation();
		}else{
			return true;
		}
	}
	
	
	/* validate file */
	public function file_validation(){
		return $this->validator()->add('upload_file', array(					 
					'type' => array(
						'required' => true,
						'rule'    => array('extension', array('jpg','gif','png','doc','docx','xls','xlsx','pdf','zip','ppt','pptx')),
						'message'  => 'Please upload (jpg, gif, png, doc, docx, xls, xlsx, pdf, ppt, pptx or zip) type file only'					
						
					),
					'size' => array(
						'required' => true,
						'rule' => array('fileSize', '<=', '5MB'),	
						'message' => 'File must be less than 5 MB'						
					)
				));
	}
	
	

	
}