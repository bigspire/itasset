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

class TvlPlace extends AppModel {
	
	public $name = 'TvlPlace';
	 
	public $useTable = 'tvl_place';
	  
	public $primaryKey = 'id';
	
	public $validate = array(			
        'place' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please enter the place'
            ),
			 'already_exist' => array(
                'rule'     => 'already_exist',
                'required' => true,
                'message'  => 'Place already exists'
            )
			
        ),
		'status' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please select the status'
            )
		)
		
	);
	
	public function already_exist(){
		if($this->data['TvlPlace']['page'] == 'edit'){
			$cond = array('id != ' =>  $this->data['TvlPlace']['id']);
		}
		$count = $this->find('count', array('conditions' => array('place' => $this->data['TvlPlace']['place'], $cond)));
		if($count > 0){
			return false;
		}else{
			return true;
		}
		
	}
	

	
	

	
}