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

class HrSurvey extends AppModel {
	
	public $name = 'HrSurvey';
	 
	public $useTable = 'hr_survey';
	  
	public $primaryKey = 'id';
	
	
	

	public $validate = array(	
		'end_date' => array(		
            'empty' => array(
                'rule'     => 'check_date',
                'required' => true,
                'message'  => 'Please select the start date'
            )
        ),
		
        'qn1' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please enter the question 1'
            )
        ),
		'qn2' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please enter the question 2'
            )
        ),
		'qn3' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please enter the question 3'
            )
        ),
		'qn4' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please enter the question 4'
            )
        ),
			'desc' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please enter the description'
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
		if(empty($this->data['HrSurvey']['start_date']) && empty($this->data['HrSurvey']['end_date'])){
			$validator['end_date']['empty']->message = 'Please select the start and end date';
			return false;
		}else if(empty($this->data['HrSurvey']['start_date'])){
			$validator['end_date']['empty']->message = 'Please select the start date';
			return false;
		}else if(empty($this->data['HrSurvey']['end_date'])){
			$validator['end_date']['empty']->message = 'Please select the end date';
			return false;
		}
		return true;
	}
	

	
}