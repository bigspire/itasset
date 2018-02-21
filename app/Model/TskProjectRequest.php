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

class TskProjectRequest extends AppModel {
	
	public $name = 'TskProjectRequest';
	 
	public $useTable = 'tsk_projects_request';
	  
	public $primaryKey = 'id';

	public $belongsTo = array(	
		'HrEmployee' => array(
            'className'  => 'Home',
			'foreignKey' => 'app_users_id'			
        ),
		'TskCustomer' => array(
            'className'  => 'TskCustomer',
			'foreignKey' => 'tsk_company_id'			
        )
	);
	
	
	public $validate = array(
		'tsk_company_id' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please select the company name'
            )
        ),	
        'project_name' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please enter the project name'
            )
        ),
		'start_date' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please enter the start date'
            )
			
		)
		,
		'project_leader' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please select the project leader'
            )
		),
		
		'member' => array(		
            'empty' => array(
                'rule'     => 'check_member',
                'required' => true,
                'message'  => 'Please select the project member(s)'
            ),
			 'adv_check' => array(
                'rule'     => 'valid_member',
                'required' => true,
                'message'  => 'Project leader cannot be added in the member'
            )
		)
	);
	

	
	/* function to validate the members */
	public function check_member(){
		if($this->data['TskProjectRequest']['member'][0] == ''){
			return false;
		}else{
			return true;
		}
	}
	
	
	public function valid_member(){
		if(empty($this->data['TskProjectRequest']['member'])){		
			return true;
		}else{
			foreach($this->data['TskProjectRequest']['member'] as $cc){
				if($cc == $this->data['TskProjectRequest']['project_leader']){
					return false;
				}
			}
			return true;
		}
		
	}
	

	
}