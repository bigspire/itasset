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

class TvlTicket extends AppModel {
	
	public $name = 'TvlTicket';
	 
	public $useTable = 'tvl_ticket';
	  
	public $primaryKey = 'id';
	
	
	public $hasOne = array(		
		'TvlTicketCancel' => array(
            'className'  => 'TvlTicketCancel',
			'foreignKey' => 'tvl_ticket_id'			
        )
	);
	
	public $validate = array(	  
       
		'amount' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please enter the ticket fare'
            ),
			'numeric' => array(
                'rule'     => 'Numeric',
                'required' => true,
                'message'  => 'Please enter digits only'
            )
        ),
		'book_ref_no' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please enter the booking ref. no.'
            )
        )
		,
		'book_date' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please select the booking date'
            )
        ),
		'tkt1' => array(		
            'empty' => array(
                'rule'     => 'valid_tkt_file',
                'required' => true,
                'message'  => 'Please attach the ticket'
            ),
			'type' => array(
				'required' => true,
				'rule'    => array('extension', array('jpg','gif','png','doc','docx','pdf','zip')),
				'message'  => 'Please upload (jpg, gif, png, doc, docx, pdf or zip) type file only'					
						
			),
			'size' => array(
				'required' => true,
				'rule' => array('fileSize', '<=', '2MB'),	
				'message' => 'File must be less than 2 MB'
					
			)
        ),
		'book_via' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please select the booked through'
            )
        )
	);
	

	
	/* function validate agent copy */
	public function validate_agent_copy(){ 
		if($this->data['TvlTicket']['book_via'] == 'A'){
			return $this->validator()->add('agent_copy1', array(	
					'empty' => array(
						'rule'     => 'valid_file',
						'required' => true,
						'message'  => 'Please attach agent copy'
					),
					'type' => array(
						'required' => true,
						'rule'    => array('extension', array('jpg','gif','png','doc','docx','pdf')),
						'message'  => 'Please upload (jpg, gif, png, doc, docx or pdf) type file only'					
					),
					'size' => array(
						'required' => true,
						'rule' => array('fileSize', '<=', '1MB'),	
						'message' => 'File must be less than 1 MB'
					)
				));						
				
		}else{ 
			return true;
		}
	}
	
	/* function to validate agent file */
	public function valid_file(){
		if(empty($this->data['TvlTicket']['agent_copy1']['name'])){	
			return false;
		}else{
			return true;
		}
	}
	
	/* function to validate agent file */
	public function valid_tkt_file(){
		if(empty($this->data['TvlTicket']['tkt1']['name'])){	
			return false;
		}else{
			return true;
		}
	}

	
}