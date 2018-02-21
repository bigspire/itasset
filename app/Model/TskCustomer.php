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

class TskCustomer extends AppModel {
	
	public $name = 'TskCustomer';
	 
	public $useTable = 'tsk_company';
	  
	public $primaryKey = 'id';

	public $belongsTo = array(		
		'State' => array(
            'className'  => 'State',
			'foreignKey' => 'app_state_id'			
        )
	);
	
	
	public $validate = array(	  
        'company_name' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please enter the company name'
            )
        ),
		'email' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please enter the email address'
            ),
			 'email' => array(
                'rule'     => 'email',
                'required' => true,
                'message'  => 'Please enter valid email address'
            )
		),
		'phone' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please enter the phone no.'
            ),
			'numeric' => array(
                'rule'     => 'numeric',
                'message'  => 'Please enter the valid phone no. (numeric only)'
            )
			
		),
		'address' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please enter the address'
            )
		),
		'city' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please enter the city'
            )
		)
		,
		'app_state_id' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please select the state'
            )
		),
		'zip' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please enter the zipcode'
            ),
			'numeric' => array(
                'rule'     => 'numeric',
                'message'  => 'Please enter the valid zipcode (numeric only)'
            )
		),
		'type' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please select the type of company'
            )
		)
		,
		'status' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please select the status'
            )
		)
	);
	

	
	
	
	

	
}