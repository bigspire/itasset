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

class HrLeaveDetail extends AppModel {
	
	public $name = 'HrLeaveDetail';
	 
	public $useTable = 'hr_leave_balance';
	  
	public $primaryKey = 'id';

	public $belongsTo = array(
		'HrEmployee' => array(
            'className'  => 'HrEmployee',
			'foreignKey' => 'app_users_id'
        )
	);
	
	
	
	
	public $validate = array(			
        /*'start_time' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please enter the start time'
            ),
			'time' => array(
                'rule'     => 'time',
                'required' => true,
                'message'  => 'Please enter valid time'
            )
        ),
		 'end_time' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please enter the end time'
            ),
			'time' => array(
                'rule'     => 'time',
                'required' => true,
                'message'  => 'Please enter valid time'
            )
        ),
		 'grace_time' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please enter the grace time'
            )
        ),
		*/
		
		 'upload_file' => array(	
			
			'type' => array(				
				'rule'    => array('extension',   array('xls', 'xlsx')),
				'required' => true,
				'message'  => 'Please attach file (.xls & xlsx only)'				
				),
			'size' => array(				
				'rule' => array('fileSize', '<=', '1MB'),	
				'required' => true,
				'message' => 'File must be less than 1 MB'									
			)
        )
	);
		

	
}