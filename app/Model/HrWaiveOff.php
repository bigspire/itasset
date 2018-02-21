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

class HrWaiveOff extends AppModel {
	
	public $name = 'HrWaiveOff';
	 
	public $useTable = 'hr_late_hrs';
	  
	public $primaryKey = 'id';	
	
	public $belongsTo = array(		
		'HrEmployee' => array(
            'className'  => 'HrEmployee',
			'foreignKey' => 'app_users_id'		
        )
	);
	
		
	public $validate = array(	  
        'minute' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please enter the minutes'
            ),
			'numeric' => array(
                'rule'     => 'numeric',
                'required' => true,
                'message'  => 'Please enter valid minutes (integer only)'
            ),
			'valid_minute' => array(
                'rule'     => 'valid_minute',
                'required' => true,
                'message'  => 'Shouldn\'t be greater than actual late'
            )		
        ),
		'remarks' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please enter the remarks'
            )			
        )
	);
	
	public function valid_minute(){
		if($this->data['HrWaiveOff']['minute'] > $this->data['HrWaiveOff']['total_hr']){
			return false;
		}
		return true;
	}
	
}