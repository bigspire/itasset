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

class HrEmployee extends AppModel {
	
	public $name = 'HrEmployee';
	 
	public $useTable = 'app_users';
	  
	public $primaryKey = 'id';
	
	public $virtualFields = array('full_name' => "UPPER(CONCAT_WS(' ', trim(HrEmployee.first_name), trim(HrEmployee.last_name)))");

	public $belongsTo = array(		
		'HrDepartment' => array(
            'className'  => 'HrDepartment',
			'foreignKey' => 'hr_department_id'			
        ),
		'HrDesignation' => array(
            'className'  => 'HrDesignation',
			'foreignKey' => 'hr_designation_id'			
        ),
		'HrGrade' => array(
            'className'  => 'HrGrade',
			'foreignKey' => 'hr_grade_id'			
        ),
		'Role' => array(
            'className'  => 'Role',
			'foreignKey' => 'app_roles_id'			
        ),
		'HrCompany' => array(
            'className'  => 'HrCompany',
			'foreignKey' => 'hr_company_id'			
        ),
		'HrBranch' => array(
            'className'  => 'HrBranch',
			'foreignKey' => 'hr_branch_id'			
        ),
		'HrBusinessUnit' => array(
            'className'  => 'HrBusinessUnit',
			'foreignKey' => 'hr_business_unit_id'			
        ),
		'HrBloodGroup' => array(
            'className'  => 'HrBloodGroup',
			'foreignKey' => 'hr_blood_group_id'			
        )
	);
	
	public $hasOne = array(		
		'HrEducation' => array(
            'className'  => 'HrEducation',
			'foreignKey' => 'app_users_id'			
        ),
		'HrExperience' => array(
            'className'  => 'HrExperience',
			'foreignKey' => 'app_users_id'			
        ),
		'HrFamily' => array(
            'className'  => 'HrFamily',
			'foreignKey' => 'app_users_id'			
        )
	);
	
	public $validate = array(
		'hr_company_id' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please select the company name'
            )
        ),	
        'first_name' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please enter the first name'
            )
        ),
		'last_name' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please enter the last name'
            )
		)
		,
		'emp_no' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please enter the employee code'
            ),
			/*
			'check_exist_code' => array(
                'rule'     => 'isUnique',
                'required' => 'create',				
                'message'  => 'Employee code already exists'
            )
			*/
		)
		,
		'doj' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please enter the date of joining'
            )
		),	
		'doc' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please select date of confirmation'
            )
		),	

		'probation' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please selection probation review'
            )
		),		
		'email_address' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => 'create',				
                'message'  => 'Please enter the email address'
            ),
			'email' => array(
                'rule'     => 'email',
                'required' => true,
                'message'  => 'Please enter the valid email address'
            ),
			/*
			'check_exist_email' => array(
                'rule'     => 'isUnique',
                'required' => true,
				'create' => 'on',
                'message'  => 'Email address already exists'
            )
			*/
		)
		,							
		'personal_email' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => 'create',				
                'message'  => 'Please enter the personal email address'
            ),
			'email' => array(
                'rule'     => 'email',
                'required' => true,
                'message'  => 'Please enter the valid personal email address'
            )
		),
		'dob' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please select the date of birth'
            )
			
		),
		'gender' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please select the gender'
            )
		),
		'status' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please select the status'
            )
		),
		'emp_type' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please select the employee type'
            )
		),
		'work_place' => array(		
            'empty' => array(
                'rule'     => 'valid_workplace',
                'required' => true,
                'message'  => 'Please select the work place'
            )
		),
		'contract_from' => array(		
            'empty' => array(
                'rule'     => 'valid_contract_from',
                'required' => true,
                'message'  => 'Please select the contract from'
            )
		),
		'contract_to' => array(		
            'empty' => array(
                'rule'     => 'valid_contract_to',
                'required' => true,
                'message'  => 'Please select the contract to'
            )
		)
		,
		'hr_department_id' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please select the department'
            )
		),
		
		'hr_business_unit_id' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please select the business unit'
            )
		),
		'hr_designation_id' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please select the designation'
            )
		),
		
		'hr_branch_id' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please select the branch'
            )
		),		
		
		'app_roles_id' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please select the role'
            )
		)
		,
		'marital_status' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please select the marital status'
            )
		),
		'hr_blood_group_id' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please select the blood group'
            )
		),
		'communication_addr' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please enter the present address'
            )
		),
		'permanent_addr' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please enter the permanent address'
            )
		),
		'contact_no' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please enter the mobile no. (Personal)'
            )
		)
		,
		'official_contact_no' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please enter the mobile no. (Office)'
            )
		),
		'att_type' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please select attendance type'
            )
		),
		'att_approve' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please select attendance approval'
            )
		)
		
	);
	
	/* function to validate the work place */
	public function valid_workplace(){
		if($this->data['HrEmployee']['emp_type'] == 'A' && empty($this->data['HrEmployee']['work_place'])){
			return false;
		}else{
			return true;
		}
	}
	
	/* function to validate the contract from */
	public function valid_contract_from(){
		if($this->data['HrEmployee']['emp_type'] == 'A' && empty($this->data['HrEmployee']['contract_from'])){
			return false;
		}else{
			return true;
		}
	}
	
	/* function to validate the contract to */
	public function valid_contract_to(){
		if($this->data['HrEmployee']['emp_type'] == 'A' && empty($this->data['HrEmployee']['contract_to'])){
			return false;
		}else{
			return true;
		}
	}
	
	public function validate_photo($data){ 
		if(empty($data['name'])){	
			return true;
		}else{				
			$this->validator()->add('pic', array(
					'type' => array(
						'required' => false,
						'rule'    => array('extension', array('jpg', 'jpeg', 'png', 'gif')),
						'message'  => 'Please attach photo (.jpg, .jpeg, .png or .gif only)',
						'allowEmpty' => false
						
					),
					'size' => array(
						'required' => false,
						'rule' => array('fileSize', '<=', '1MB'),	
						'message' => 'Photo must be less than 1MB',
						'allowEmpty' => false
						
					)
				));		
		}
		
		
	}
	
	

	
}