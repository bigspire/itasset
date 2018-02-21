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

class FinExpense extends AppModel {
	
	public $name = 'FinExpense';
	 
	public $useTable = 'fin_expenses';
	  
	public $primaryKey = 'id';

	public $hasOne = array(		
		'FinExpStatus' => array(
            'className'  => 'FinExpStatus',
			'foreignKey' => 'fin_expenses_id'			
        ),
		'FinExpList' => array(
            'className'  => 'FinExpList',
			'foreignKey' => 'fin_expenses_id'			
        )
		
	);
	
	public $belongsTo = array(		
		'TskProject' => array(
            'className'  => 'TskProject',
			'foreignKey' => 'tsk_projects_id'			
        ),
		'TskCustomer' => array(
            'className'  => 'TskCustomer',
			'foreignKey' => 'tsk_company_id'			
        ),		
		'Home' => array(
            'className'  => 'Home',
			'foreignKey' => 'app_users_id'			
        ),
		'FinAdvance' => array(
            'className'  => 'FinAdvance',
			'foreignKey' => 'fin_advance_id'			
        ),
	);
	
	
	
	

	
	
	
	

	
}