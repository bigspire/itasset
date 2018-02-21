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

class HrVoice extends AppModel {
	
	public $name = 'HrVoice';
	 
	public $useTable = 'hr_voice';
	  
	public $primaryKey = 'id';
	
	
	

	public $validate = array(	
		'end_date' => array(		
            'empty' => array(
                'rule'     => 'check_date',
                'required' => true,
                'message'  => 'Please select the start date'
            )
        ),
		
        'desc' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please enter the question 1'
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
	
	/* check its a valid ans */
	public function check_date(){
		$validator = $this->validator();
		if(empty($this->data['HrVoice']['start_date']) && empty($this->data['HrVoice']['end_date'])){
			$validator['end_date']['empty']->message = 'Please select the start and end date';
			return false;
		}else if(empty($this->data['HrVoice']['start_date'])){
			$validator['end_date']['empty']->message = 'Please select the start date';
			return false;
		}else if(empty($this->data['HrVoice']['end_date'])){
			$validator['end_date']['empty']->message = 'Please select the end date';
			return false;
		}
		return true;
	}
	

	
}