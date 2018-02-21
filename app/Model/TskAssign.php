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

class TskAssign extends AppModel {
	
	public $name = 'TskAssign';
	 
	public $useTable = 'tsk_assign';
	  
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
	
	public $hasOne = array(		
		'TskAssignRead' => array(
            'className'  => 'TskAssignRead',
			'foreignKey' => 'tsk_assign_id'			
        ),
		'TskAssignUser' => array(
            'className'  => 'TskAssignUser',
			'foreignKey' => 'tsk_assign_id',
			'type'=> 'INNER'
        ),
		'TskAssignStatus' => array(
            'className'  => 'TskAssignStatus',
			'foreignKey' => 'tsk_assign_id',
			'order' => array('TskAssignStatus.id' => 'desc'),
			'conditions' => array('is_recent' => '1')
        )
	);
	
	

	public $validate = array(        
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
		)
		
	);
	
	
	
	/* function to check start and end time */
	public function check_task_remaining(){ 
		if($this->data['TskAssign']['plan_type'] == 'D' && empty($this->data['TskAssign']['task_remaining'])){
			return false;
		}else{
			return true;
		}
	}		
	
	
	/* function to check start and end time */
	public function valid_remaining(){ 
		$validator = $this->validator();		
		if(empty($this->data['TskAssign']['remain_from']) || empty($this->data['TskAssign']['remain_end'])){
			if($this->data['TskAssign']['plan_type'] == 'D'){
				$validator['task_remaining']['valid_remaining']->message = 'Please select the start and end time';
			}else{
				$validator['task_remaining']['valid_remaining']->message = 'Please select the start and end date';
			}
			return false;
		}
		return true;
	}
	
	

	/* function to get the team members */
	public function get_team($id, $mod){
		return $this->get_team_mem($id, $mod);
	}
	
	
	/* get diff b/w the date */
	public function diff_date($from, $to){ 
		$sql = "SELECT DATEDIFF('$to','$from') AS date_diff";
		$result = $this->query($sql);		
		return $result[0][0]['date_diff'];

	}
	
	
	
	

	
}