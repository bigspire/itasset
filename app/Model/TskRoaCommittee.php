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
 * @link          http://cakephp.org CakePHP(tm) ROA Committee
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

class TskRoaCommittee extends AppModel {
	
	public $name = 'TskRoaCommittee';
	 
	public $useTable = 'tsk_applause_committee';
	  
	public $primaryKey = 'id';
	
	public $belongsTo = array(		
		'HrEmployee' => array(
            'className'  => 'HrEmployee',
			'foreignKey' => 'app_users_id'		
        )
	);
	
	
	public $validate = array(		
		'member' => array(		
            'empty' => array(
                'rule'     => 'check_member',
                'required' => true,
                'message'  => 'Please select the committee member(s)'
            )
		)
	);
	
	
	/* function to validate the members */
	public function check_member(){
		if($this->data['TskRoaCommittee']['member'][0] == ''){
			return false;
		}else{
			return true;
		}
	}

	
}