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

class BdAdmin extends AppModel {
	
	public $name = 'BdAdmin';
	 
	public $useTable = 'bd_admin';
	  
	public $primaryKey = 'id';	  
	
	
	public $belongsTo = array(		
		'HrEmployee' => array(
            'className'  => 'HrEmployee',
			'foreignKey' => 'app_users_id'			
        )
	);
	
	public $validate = array(
		'app_users_id' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please select the employee name'
            ),
			'unique' => array(
				'rule' => 'validate_exist',
				'required' => 'create',
				'message'  => 'Employee name already exists'
			)
        ),
		'status' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please select the status'
            )
        )
	);

	/* function to get the employee details */
	public function get_employee_details(){
		return $list = $this->HrEmployee->find('list', array('fields' => array('HrEmployee.id','HrEmployee.full_name'), 
		'order' => array('HrEmployee.first_name ASC'),'conditions' => array('HrEmployee.status' => 1, 'HrEmployee.is_deleted' => 'N')));		
	}
	
	/* validate admin already exists */
	public function validate_exist(){
		$count = $this->find('count', array('conditions' => array('BdAdmin.is_deleted' => 'N', 'app_users_id' => $this->data['BdAdmin']['app_users_id'])));
		if($count){
			return false;
		}else{
			return true;
		}
	}
	
}