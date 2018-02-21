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

class TskFile extends AppModel {
	
	public $name = 'TskFile';
	 
	public $useTable = 'tsk_files';
	  
	public $primaryKey = 'id';
	
	
	public $hasOne = array(
		'TskFileDetail' => array(
            'className'  => 'TskFileDetail',
			'foreignKey' => 'tsk_files_id'		
        ),
		'TskFileUser' => array(
            'className'  => 'TskFileUser',
			'foreignKey' => 'tsk_files_id'		
        )
	);
	
	public $belongsTo= array(		
		'HrEmployee' => array(
            'className'  => 'HrEmployee',
			'foreignKey' => 'app_users_id'		
        )
	);
	
	
	public $validate = array(			
        'title' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please enter the title'
            )
        ),
		'desc' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please enter the description'
            )
		),
		'users' => array(		
            'empty' => array(
                'rule'     => 'check_users',
                'required' => true,
                'message'  => 'Please select users'
            )
		) 
		
	);
	
	/* function to get the team members */
	public function get_team($id, $mod){
		return $this->get_team_mem($id, $mod);
	}
	
	
	/* function to validate users */
	public function check_users(){
		if(!empty($this->data['TskFile']['users'][0])){
			return true;
		}else{
			return false;
		}
	}
	
	

	
}