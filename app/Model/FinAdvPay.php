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

class FinAdvPay extends AppModel {
	
	public $name = 'FinAdvPay';
	 
	public $useTable = 'fin_adv_pay';
	  
	public $primaryKey = 'id';
	

	public $belongsTo = array(		
		'FinAdvance' => array(
            'className'  => 'FinAdvance',
			'foreignKey' => 'fin_advance_id'			
        )
	);
	
	
	
	
	public $validate = array(	  
       
		'amount' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please enter the amount'
            ),
			'numeric' => array(
                'rule'     => 'numeric',
                'message'  => 'Please enter the valid amount (numeric only)'
            )
			
		),
		'pay_mode' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please select the mode of payment'
            )
		)
		,
		'paid_date' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please select date of payment'
            )
		)
		
	);
	

	
	
	
	

	
}