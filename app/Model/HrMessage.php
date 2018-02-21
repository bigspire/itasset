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

class HrMessage extends AppModel {
	
	public $name = 'HrMessage';
	 
	public $useTable = 'hr_message';
	  
	public $primaryKey = 'id';
	
	public $validate = array(			
        'title' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please enter the title'
            )
        )
		,
		'desc' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please enter the description'
            )
		),
		'status' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please select the status'
            )
		),
		'display_type' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please select the publish status'
            )
		),
		'show_type' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please select the show to'
            )
		)
		,
		'end_date' => array(		
            'empty' => array(
                'rule'     => 'valid_between',
                'required' => true,
                'message'  => 'Please select the dates'
            )
		),
		'end_day' => array(		
            'empty' => array(
                'rule'     => 'valid_month',
                'required' => true,
                'message'  => 'Please select the dates'
            )
		)
	);
	
	/* function to validate between the dates */
	public function valid_between(){
		if($this->data['HrMessage']['display_type'] == 'N'){
			if(empty($this->data['HrMessage']['start_date']) || empty($this->data['HrMessage']['end_date'])){
				return false;
			}
		}
		return true;
	}
	
	/* function to validate monthly dates */
	public function valid_month(){
		if($this->data['HrMessage']['display_type'] == 'M'){
			if(empty($this->data['HrMessage']['start_day']) || empty($this->data['HrMessage']['end_day'])){
				return false;
			}
		}
		return true;
	}
	
	public function validate_file(){ 		
		if(!empty($this->data['HrMessage']['upload_file']['name'])){	
			$this->add_validation();
		}else{
			return true;
		}
	}
	
	
	/* validate file */
	public function add_validation(){
		return $this->validator()->add('upload_file', array(
					 
					'type' => array(
						'required' => true,
						'rule'    => array('extension', array('jpg','gif','png','doc','docx','xls','xlsx','pdf','zip')),
						'message'  => 'Please upload (jpg, gif, png, doc, docx, xls, xlsx, pdf or zip) type file only'					
						
					),
					'size' => array(
						'required' => true,
						'rule' => array('fileSize', '<=', '2MB'),	
						'message' => 'File must be less than 2 MB'
					
						
					)
				));
				
			
	}


	
}