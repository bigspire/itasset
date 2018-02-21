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

class TskPlanList extends AppModel {
	
	public $name = 'TskPlanList';
	 
	public $useTable = 'tsk_plan_list';
	  
	public $primaryKey = 'id';	

	public $belongsTo = array(		
		'TskPlanType' => array(
            'className'  => 'TskPlanType',
			'foreignKey' => 'tsk_plan_types_id'			
        ),
		'TskPlan' => array(
            'className'  => 'TskPlan',
			'foreignKey' => 'tsk_plan_id'			
        ),
		
		
	);
	
	
	
	

	
	
	
	

	
}