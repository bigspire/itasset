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

class HrPoll extends AppModel {
	
	public $name = 'HrPoll';
	 
	public $useTable = 'poll_questions';
	  
	public $primaryKey = 'id';
	
	
	public $hasOne = array(		
		'HrPollOption' => array(
            'className'  => 'HrPollOption',
			'foreignKey' => 'ques_id'			
        )
	);
	
	

	public $validate = array(			
        'ques' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please enter the question name'
            )
        ),
		 'option1' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please enter the option 1'
            )
        ),
		 'option2' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please enter the option 2'
            )
        ),
		 'option3' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please enter the option 3'
            )
        ),
		 'answer' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please enter the correct answer'
            ),
			 'valid_answer' => array(
                'rule'     => 'valid_answer',
                'required' => true,
                'message'  => 'Invalid answer'
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
	public function valid_answer(){
		if(!empty($this->data['HrPoll']['answer'])){
			$ans = $this->data['HrPoll']['answer'];
			// for only 3 options
			if($ans <= 3){
				if(empty($this->data['HrPoll']['option'.$ans]) && $this->data['HrPoll']['answer'] != '7'){
					return false;
				}else{
					return true;
				}
			}
		}
		return true;
	}
	

	
}