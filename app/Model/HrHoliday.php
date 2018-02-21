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

class HrHoliday extends AppModel {
	
	public $name = 'HrHoliday';
	 
	public $useTable = 'hr_holiday';
	  
	public $primaryKey = 'id';
	
	public $belongsTo = array(		
		'HrBranch' => array(
            'className'  => 'HrBranch',
			'foreignKey' => 'hr_branch_id'		
        )
	);
	
	
	public $validate = array(			
        'event' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please enter the event name'
            )
        ),
		 'event_date' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please select the event date'
            )
        ),
		 'hr_branch_id' => array(		
            'empty' => array(
                'rule'     => 'validate_branch',
                'required' => true,
                'message'  => 'Please select the branch'
            )
        )
	);
	
	
		/* function to validate the permissions */
	public function validate_branch(){ 
		if($this->data['HrHoliday']['hr_branch_id'][0] > 0){
			return true;
		}else{
			return false;
		}
	}
	

	
	
	

	
}