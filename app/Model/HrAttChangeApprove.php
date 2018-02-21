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

class HrAttChangeApprove extends AppModel {
	
	public $name = 'HrAttChangeApprove';
	 
	public $useTable = 'hr_attendance_change';
	  
	public $primaryKey = 'id';	  
	
	public $hasOne = array(		
		'HrAttStatus' => array(
            'className'  => 'HrAttStatus',
			'foreignKey' => 'hr_attendance_change_id'			
        ),
		'HrAttUser' => array(
            'className'  => 'HrAttUser',
			'foreignKey' => 'hr_attendance_change_id'			
        ),
	);
	
	public $belongsTo = array(		
		'Home' => array(
            'className'  => 'Home',
			'foreignKey' => 'app_users_id'			
        )
	);
	
	
	
	
	/* function to get the team members */
	public function get_team($id, $mod){
		return $this->get_team_mem($id, $mod);
	}
	
	
	
	
	

	
}