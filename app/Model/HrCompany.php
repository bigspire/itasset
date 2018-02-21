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

class HRCompany extends AppModel {
	
	public $name = 'HRCompany';
	 
	public $useTable = 'hr_company';
	  
	public $primaryKey = 'id';
	
	
	public $belongsTo = array(		
		'State' => array(
            'className'  => 'State',
			'foreignKey' => 'app_state_id'			
        )
	);

	
	public $validate = array(
		'company_name' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please enter the company name'
            )
        ),
		'landline' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please enter the landline no.'
            )
		),
		'address' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please enter the address'
            )
		),
		'city' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please enter the city'
            )
		)
		,
		'app_state_id' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please select the state'
            )
		),
		'pincode' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please enter the pincode'
            )
		),
		'bank_name' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please enter the bank name'
            )
		),
		'account_name' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please enter the account name'
            )
		),
		'account_no' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please enter the account no.'
            )
		),
		'branch_address' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please enter the branch address'
            )
		)
	);
	

	
	public function validate_file(){ 		
		if(!empty($this->data['HrCompany']['upload_file']['name'])){	
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
						'rule'    => array('extension', array('jpg','gif')),
						'message'  => 'Please upload file (jpg, gif) only allowed'					
						
					),
					'size' => array(
						'required' => true,
						'rule' => array('fileSize', '<=', '1MB'),	
						'message' => 'File must be less than 1 MB'
					
						
					)
				));				
			
	}
	
	
	

	
}