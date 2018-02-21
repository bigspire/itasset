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

class TskTeamAssign extends AppModel {
	
	public $name = 'TskTeamAssign';
	 
	public $useTable = 'tsk_assign';
	  
	public $primaryKey = 'id';	

	public $belongsTo = array(		
		'HrEmployee' => array(
            'className'  => 'HrEmployee',
			'foreignKey' => 'app_users_id'			
        ),
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
		'TskAssignStatus' => array(
            'className'  => 'TskAssignStatus',
			'foreignKey' => 'tsk_assign_id',
			'order' => array('TskAssignStatus.id' => 'desc'),
			'conditions' => array('is_recent' => '1')
			
        )
	);
	
	public $validate = array(
		'title' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please enter the task title'
            )
        ),
		'desc' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please enter the description'
            )
        ),
        'plan_date' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please select the plan date'
            )
        ),
		'type' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please select the plan type'
            )
		),
		'start_date' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please select the start date'
            )
			
		),
		'end_date' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please select the end date'
            )
		),
		'start_time' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please select the start time'
            )
			
		),
		'end_time' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please select the end time'
            )
		),
		'users' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please assign the user'
            )
			
		),
		'cc_user' => array(		
            'empty' => array(
                'rule'     => 'check_cc',
                'required' => true,
                'message'  => 'Assign and Cc user should not be same'
            )
			
		),
		'tsk_company_id' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please select the customer'
            )
		),
		'tsk_projects_id' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please select the project'
            )
		),
		'tsk_plan_types_id' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please select the type'
            )
		),
		'status' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please select the status'
            )
		),
		
		'reason' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please enter the reason'
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
	
	/* check cc and assign users not same */
	
	public function check_cc(){
		if(empty($this->data['TskTeamAssign']['cc_user'])){		
			return true;
		}else{
			foreach($this->data['TskTeamAssign']['cc_user'] as $cc){
				if($cc == $this->data['TskTeamAssign']['users']){
					return false;
				}
			}
			return true;
		}
		
	}
	
	public function validate_file(){ 	
		if(!empty($this->data['TskTeamAssign']['upload_file']['name'])){ 
			$this->add_validation();
		}else{
			return true;
		}
	}
	
	
	
	/* validate file */
	public function add_validation(){
		return $this->validator()->add('upload_file', array(					 
					'type' => array(
						'required' => true,
						'rule'    => array('extension', array('jpg','gif','png','doc','docx','xls','xlsx','pdf','zip','ppt','pptx')),
						'message'  => 'Please upload (jpg, gif, png, doc, docx, xls, xlsx, pdf, ppt, pptx or zip) type file only'					
						
					),
					'size' => array(
						'required' => true,
						'rule' => array('fileSize', '<=', '5MB'),	
						'message' => 'File must be less than 5 MB'
					
						
					)
				));
				
			
	}

	
	
	
	/* function to check start and end time */
	public function check_task_postpone(){
		if($this->data['TskTeamAssign']['plan_type'] == 'D' && empty($this->data['TskTeamAssign']['postpone_date'])){
			return false;
		}else{
			return true;
		}
	}		
	
	
	/* function to check start and end time */
	public function valid_task_postpone(){
		$validator = $this->validator();		
		if(empty($this->data['TskTeamAssign']['post_from']) || empty($this->data['TskTeamAssign']['post_end'])){
			if($this->data['TskTeamAssign']['plan_type'] == 'D'){
				$validator['postpone_date']['valid_task_postpone']->message = 'Please select the start and end time';
			}else{
				$validator['postpone_date']['valid_task_postpone']->message = 'Please select the start and end date';
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