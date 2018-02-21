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

class FinAdvApprove extends AppModel {
	
	public $name = 'FinAdvApprove';
	 
	public $useTable = 'fin_advance';
	  
	public $primaryKey = 'id';	  
	
	public $hasOne = array(		
		'FinAdvStatus' => array(
            'className'  => 'FinAdvStatus',
			'foreignKey' => 'fin_advance_id'			
        ),
		'FinAdvUser' => array(
            'className'  => 'FinAdvUser',
			'foreignKey' => 'fin_advance_id'			
        ),
	);
	
	public $belongsTo = array(		
		'Home' => array(
            'className'  => 'Home',
			'foreignKey' => 'app_users_id'			
        ),
		'TskCustomer' => array(
            'TskCustomer'  => 'TskCustomer',
			'foreignKey' => 'tsk_company_id'			
        ),
	);
	
	
	
	
	/* function to get the team members */
	public function get_team($id, $mod, $list){
		return $this->get_team_mem($id, $mod, $list);
	}
	
	
	
	
	

	
}