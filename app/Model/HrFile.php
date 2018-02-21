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

class HrFile extends AppModel {
	
	public $name = 'HrFile';
	 
	public $useTable = 'hr_files';
	  
	public $primaryKey = 'id';

	
	public $validate = array(			
        'title' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please enter the file name'
            )
        )
	);
	
	public function validate_file(){ 
		if($this->data['HrFile']['page'] == 'edit'){	
			if(!empty($this->data['HrFile']['upload_file']['name'])){	
				$this->add_validation();
			}else{
				return true;
			}
		}
		// for add page
		$this->add_validation();		
	}
	
	/* validate file */
	public function add_validation(){
		return $this->validator()->add('upload_file', array(
					 
					'type' => array(
						'required' => true,
						'rule'    => array('extension', array('jpg','gif','png','doc','docx','xls','xlsx','pdf','zip','swf')),
						'message'  => 'Please upload file (jpg,gif,png,doc,docx,xls,xlsx,pdf,swf or zip) only allowed'					
						
					),
					'size' => array(
						'required' => true,
						'rule' => array('fileSize', '<=', '5MB'),	
						'message' => 'File must be less than 5 MB'
					
						
					)
				));
				
			
	}

	
	
	
	

	
}