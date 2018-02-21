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

class HrAttendance extends AppModel {
	
	public $name = 'HrAttendance';
	 
	public $useTable = 'hr_attendance';
	  
	public $primaryKey = 'id';
	
	
	public $belongsTo = array(		
		'HrEmployee' => array(
            'className'  => 'HrEmployee',
			'foreignKey' => 'app_users_id'			
        )
	);
	
	public $validate = array(
		'SearchText' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please select employee name or no.'
            )
        )
	);
		
	/* get diff b/w the date */
	public function diff_date($from, $to){ 
		$sql = "SELECT DATEDIFF('$to','$from') AS date_diff";
		$result = $this->query($sql);		
		return $result[0][0]['date_diff'];

	}
	

	
}