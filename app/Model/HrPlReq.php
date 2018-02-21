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

class HrPlReq extends AppModel {
	
	public $name = 'HrPlReq';
	 
	public $useTable = 'hr_pl_request';
	  
	public $primaryKey = 'id';
	
	public $validate = array(	  
        'reason' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please enter the reason'
            ),
			'check_exists' => array(
                'rule'     => 'check_exists',
                'required' => true,
                'message'  => 'PL request already created b/w these dates'
            )
		)
	);
	
	
	public $belongsTo = array(				
		'HrEmployee' => array(
            'className'  => 'HrEmployee',
			'foreignKey' => 'app_users_id'			
        )
	);
	
	/* function to check leave exists */
	public function check_exists(){
		if(!empty($this->data['HrPlReq']['date_from']) && !empty($this->data['HrPlReq']['date_to'])){
			$from = $this->format_date_save($this->data['HrPlReq']['date_from']);
			$to = $this->format_date_save($this->data['HrPlReq']['date_to']);
			$count =  $this->find('count', array('conditions' => array('or' => array('date_from between ? and ?' => array($from, $to),
			'date_to between ? and ?' => array($from, $to)), 'app_users_id' => CakeSession::read('USER.Login.id'),  'HrPlReq.is_deleted'=> 'N')));
			if($count > 0){
				return false;
			}else{
				return true;
			}
		}
		return true;
	}
	
	/* function to format the date to save */
	public function format_date_save($date){ 
		$exp_date = explode('/', $date); 
		return $exp_date[2].'-'.$exp_date[1].'-'.$exp_date[0];
	}

	
}