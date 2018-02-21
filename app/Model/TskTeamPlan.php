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

class TskTeamPlan extends AppModel {
	
	public $name = 'TskTeamPlan';
	 
	public $useTable = 'tsk_plan';
	  
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
		'TskPlanRead' => array(
            'className'  => 'TskPlanRead',
			'foreignKey' => 'tsk_plan_id'			
        )
	);

	
	
		
	
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