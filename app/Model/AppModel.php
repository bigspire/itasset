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

App::uses('Model', 'Model');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class AppModel extends Model {
	
	//public $name = 'AppModel';

	/* function used to get the members */	
	public function get_team_mem($id, $mod, $list){  
		$str_sql = $list == 1 ? "or a.level2 = '$id'" : '';
		$sql = "select u.id, u.first_name, u.last_name from app_users u inner join app_approval a  on (a.app_users_id = u.id) where (a.level1 = '$id' $str_sql) and a.type = '$mod' and u.is_deleted = 'N' and u.status = '1' group by u.id   order by u.first_name asc";		
		$result = $this->query($sql);
		return $result;
		
	}
	
	
	
	
	
	
	
}
