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

class TskPlan extends AppModel {
	
	public $name = 'TskPlan';
	 
	public $useTable = 'tsk_plan';
	  
	public $primaryKey = 'id';	

	public $belongsTo = array(			
		
		'TskCustomer' => array(
            'className'  => 'TskCustomer',
			'foreignKey' => 'tsk_company_id'			
        ),
		'TskProject' => array(
            'className'  => 'TskProject',
			'foreignKey' => 'tsk_projects_id'			
        ),
		'TskPlanType' => array(
            'className'  => 'TskPlanType',
			'foreignKey' => 'tsk_plan_types_id'			
        )
		
	);	
	
	
	/* get diff b/w the date */
	public function diff_date($from, $to){ 
		$sql = "SELECT DATEDIFF('$to','$from') AS date_diff";
		$result = $this->query($sql);		
		return $result[0][0]['date_diff'];

	}

	
	
	public function planmodel(){
		echo CakeSession::read('USER.Login.id');
	}
		
	public $validate = array(	  
        'plan_date' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please enter the plan date'
            )
        ),
		'type' => array(		
            'empty' => array(
                'rule'     => 'check_plan_type',
                'required' => true,
                'message'  => 'Please select the plan type'
            )
		),
		'start_date' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please select the plan start date'
            )
			
		),
		'end_date' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please select the plan end date'
            )
		),
		'tsk_company_id' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please select the company name'
            )
		),
		'tsk_projects_id' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please select the project name'
            )
		),
		'status' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please select the status'
            )
		),
		'comment' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please enter the comment'
            )
		),
		'reason' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please enter the reason'
            )
		),
		'task_remaining' => array(		
            'empty' => array(
                'rule'     => 'check_task_remaining',
                'required' => true,
                'message'  => 'Please select the completion date'
            ),
			 'valid_remaining' => array(
                'rule'     => 'valid_remaining',
                'required' => true,
                'message'  => 'Please select the start and end'
            )
		),
		'remain_from' => array(           
			 'valid_remaining' => array(
                'rule'     => 'valid_remaining',
                'required' => true,
                'message'  => 'Please select the start and end date'
            )
		),
		'postpone_date' => array(		
           'empty' => array(
                'rule'     => 'check_task_postpone',
                'required' => true,
                'message'  => 'Please select the postponed date'
            ),
			 'valid_task_postpone' => array(
                'rule'     => 'valid_task_postpone',
                'required' => true,
                'message'  => 'Please select the start and end'
            )
			
		),
		'post_from' => array(           
			 'valid_task_postpone' => array(
                'rule'     => 'valid_task_postpone',
                'required' => true,
                'message'  => 'Please select the start and end date'
            )
		)
		
	);
	
	/* function to validate plan type */
	public function check_plan_type(){
		if($this->data['TskPlan']['page'] != 'edit' && empty($this->data['TskPlan']['type'])){
			return false;
		}else{
			return true;
		}
	}
	
	/* function to check start and end time */
	public function check_task_remaining(){ 
		if($this->data['TskPlan']['plan_type'] == 'D' && empty($this->data['TskPlan']['task_remaining'])){
			return false;
		}else{
			return true;
		}
	}		
	
	
	/* function to check start and end time */
	public function valid_remaining(){ 
		$validator = $this->validator();		
		if(empty($this->data['TskPlan']['remain_from']) || empty($this->data['TskPlan']['remain_end'])){
			if($this->data['TskPlan']['plan_type'] == 'D'){
				$validator['task_remaining']['valid_remaining']->message = 'Please select the start and end time';
			}else{
				$validator['task_remaining']['valid_remaining']->message = 'Please select the start and end date';
			}
			return false;
		}
		return true;
	}
	
	/* function to check start and end time */
	public function check_task_postpone(){
		if($this->data['TskPlan']['plan_type'] == 'D' && empty($this->data['TskPlan']['postpone_date'])){
			return false;
		}else{
			return true;
		}
	}		
	
	
	/* function to check start and end time */
	public function valid_task_postpone(){
		$validator = $this->validator();		
		if(empty($this->data['TskPlan']['post_from']) || empty($this->data['TskPlan']['post_end'])){
			if($this->data['TskPlan']['plan_type'] == 'D'){
				$validator['postpone_date']['valid_task_postpone']->message = 'Please select the start and end time';
			}else{
				$validator['postpone_date']['valid_task_postpone']->message = 'Please select the start and end date';
			}
			return false;
		}
		return true;
	}
	
	
	
	

	
}