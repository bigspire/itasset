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

class Role extends AppModel {
	
	public $name = 'Role';
	 
	public $useTable = 'app_roles';
	  
	public $primaryKey = 'id';

	
	public $validate = array(
			
        'role_name' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please enter the role name'
            )
        ),
		'status' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please select the status'
            )
		),
		
		'permission' => array(		
            'empty' => array(
                'rule'     => 'validate_permission',
                'required' => true,
                'message'  => 'Please select atleast one permission'
			)
		 )
		
	);
	
	/* function to validate the permissions */
	public function validate_permission(){ 
		if($this->data['Role']['permission'][0] > 0){
			return true;
		}else{
			return false;
		}
	}
	

	
	
	
	

	
}