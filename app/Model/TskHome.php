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

class TskHome extends AppModel {
	
	public $name = 'TskHome';
	 
	public $useTable = 'app_users';
	  
	public $primaryKey = 'id';	  
	
	
	
	/* function to get the recent activities */
	public function get_recent_activity($id){  
		$sql = "(select lve.id as id, lve.created_date as created, 'leave' as activity from hr_leave lve where app_users_id = '$id' and is_deleted = 'N' group by lve.id )  union ( select per.id as id, per.created_date as created, 'permission' as activity from hr_permission per where app_users_id = '$id' and is_deleted = 'N' group by per.id)  order by created desc limit 3;"; 
		
		$result = $this->query($sql);
		//echo '<pre>';print_r($result);
		return $result;
		
	}
	
	

	
}