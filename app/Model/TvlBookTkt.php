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

class TvlBookTkt extends AppModel {
	
	public $name = 'TvlBookTkt';
	 
	public $useTable = 'tvl_request';
	  
	public $primaryKey = 'id';	

	public $hasOne = array(		
		'TvlTicket' => array(
            'className'  => 'TvlTicket',
			'foreignKey' => 'tvl_request_id'			
        ),
		'TvlTicketStatus' => array(
            'className'  => 'TvlTicketStatus',
			'foreignKey' => 'tvl_request_id'			
        )
	);
	
	public $belongsTo = array(				
		'HrEmployee' => array(
            'className'  => 'HrEmployee',
			'foreignKey' => 'app_users_id'			
        ),
		'TskCustomer' => array(
            'TskCustomer'  => 'TskCustomer',
			'foreignKey' => 'tsk_company_id'			
        ),
		'TvlMode' => array(
            'TvlMode'  => 'TvlMode',
			'foreignKey' => 'tvl_mode_id'			
        ),
		'TvlPlace' => array(
            'TvlPlace'  => 'TvlPlace',
			'foreignKey' => 'tvl_dest_id'			
        )
	);
	
	public $validate = array(	  
       
		'avail' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please select the availability'
            )
        ),
		 
		'from_date' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please select the from date'
            )
        ),
		 
		'to_date' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please select the to date'
            )
        )
	);
	
	/* function to check ticket availability */
	public function validate_avail(){ 
		if($this->data['TvlBookTkt']['avail'] == 'Y'){
			$this->avail_validation();
		}else if($this->data['TvlBookTkt']['avail'] == 'N'){
			$this->noavail_validation();
		}		
	}
	
	
	
	/* validate ticket status */
	public function avail_validation(){
	
		$this->validator()->add('tvl_mode_id', array(					 
				'empty' => array(
					'rule'     => 'notEmpty',
					'required' => true,
					'message'  => 'Please select the mode of travel'
				)
			
		));
		$this->validator()->add('book_mode', array(					 
				'empty' => array(
					'rule'     => 'notEmpty',
					'required' => true,
					'message'  => 'Please select booking mode'
				)
			
		));
		$this->validator()->add('issue_date', array(					 
				'empty' => array(
					'rule'     => 'notEmpty',
					'required' => true,
					'message'  => 'Please select the booking date'
				)
			
		));
				
			
	}
	
	/* validate ticket status */
	public function noavail_validation(){
	
		$this->validator()->add('suggestion', array(					 
				'empty' => array(
					'rule'     => 'notEmpty',
					'required' => true,
					'message'  => 'Please enter the suggestion alternative'
				)
		));
				
			
	}
	
	
	

	
}