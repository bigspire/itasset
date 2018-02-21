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

class Approve extends AppModel {
	
	public $name = 'Approve';
	 
	public $useTable = 'app_approval';
	  
	public $primaryKey = 'id';	
	
	
	public $validate = array(	  
        'app_users_id' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please select the employee name'
            ),
			 'duplicate1' => array(
                'rule'     => 'check_dup1',
                'required' => true,
                'message'  => 'Duplicate entry'
            )
		),
		'level1' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please select L1 user '
            )
			,
			 'duplicate2' => array(
                'rule'     => 'check_dup2',
                'required' => true,
                'message'  => 'Duplicate entry'
            )
		),
		'level2' => array(		
            
			 'duplicate3' => array(
                'rule'     => 'check_dup3',
                'required' => true,
                'message'  => 'Duplicate entry'
            )
			
		)
		/*'auth_amount_l1' => array(            
			 'numeric' => array(
                'rule'     => 'numeric_value1',
                'required' => true,
                'message'  => 'Please enter valid amount (numbers only)'
            )
			
		),
		'auth_amount_l2' => array(            
			 'numeric' => array(
                'rule'     => 'numeric_value2',
                'required' => true,
                'message'  => 'Please enter valid amount (numbers only)'
            )
			
		)*/
		
	);
	
	/* check the duplicate entry in the form validation */
	
	public function check_dup1(){ 
		if($this->data['Approve']['app_users_id'] == $this->data['Approve']['level1'] || $this->data['Approve']['app_users_id'] == $this->data['Approve']['level2']){
			return false;
		}else{
			return true;
		}
	}
	
	public function check_dup2(){ 
		if($this->data['Approve']['app_users_id'] == $this->data['Approve']['level1'] || $this->data['Approve']['level1'] == $this->data['Approve']['level2']){
			return false;
		}else{
			return true;
		}
	}
	
	public function check_dup3(){ 
		if(!empty($this->data['Approve']['level2'])){
			if($this->data['Approve']['level2'] == $this->data['Approve']['level1'] || $this->data['Approve']['app_users_id'] == $this->data['Approve']['level2']){
				return false;
			}else{
				return true;
			}
		}else{
			return true;
		}
	}
	
	public function numeric_value1(){ 
		if(!empty($this->data['Approve']['auth_amount_l1'])){
			if(!intval($this->data['Approve']['auth_amount_l1'])){
				return false;
			}else{
				return true;
			}
		}else{
			return true;
		}
	}
	
	public function numeric_value2(){ 
		if(!empty($this->data['Approve']['auth_amount_l2'])){
			if(!intval($this->data['Approve']['auth_amount_l2'])){
				return false;
			}else{
				return true;
			}
		}else{
			return true;
		}
	}
	
	
	
	

	
}