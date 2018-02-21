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
 * @link          http://cakephp.org CakePHP(tm) Gifts & Rewards
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

class TskRoaReward extends AppModel {
	
	public $name = 'TskRoaReward';
	 
	public $useTable = 'tsk_applause_reward';
	  
	public $primaryKey = 'id';
	

	
	public $belongsTo = array(		
		'HrEmployee' => array(
            'className'  => 'HrEmployee',
			'foreignKey' => 'app_users_id'		
        )
	);
	

	

	
	public $validate = array(
		'reward_month' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please select the reward month'
            )
        ),	
        'member' => array(		
            'empty' => array(
                'rule'     => 'check_member',
                'required' => true,
                'message'  => 'Please select the reward members'
            )
        ),
		'gift_voucher' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please enter the gift/reward details'
            )
        )
	);
	
	/* function to validate the members */
	public function check_member(){
		if($this->data['TskRoaReward']['member'][0] == ''){
			return false;
		}else{
			return true;
		}
	}
	
	public function validate_file(){ 	
		if(!empty($this->data['TskRoaReward']['attachment']['name'])){ 
			$this->file_validation();
		}else{
			return true;
		}
	}
	
	
		/* validate file */
	public function file_validation(){
		return $this->validator()->add('attachment', array(					 
					'type' => array(
						'required' => true,
						'rule'    => array('extension', array('jpg','gif','png','doc','docx','xls','xlsx','pdf','zip','ppt','pptx')),
						'message'  => 'Please upload (jpg, gif, png, doc, docx, xls, xlsx, pdf, ppt, pptx or zip) type file only'					
						
					),
					'size' => array(
						'required' => true,
						'rule' => array('fileSize', '<=', '5MB'),	
						'message' => 'File must be less than 5 MB'						
					)
				));
	}
	
	
}