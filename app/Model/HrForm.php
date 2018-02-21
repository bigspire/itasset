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

class HrForm extends AppModel {
	
	public $name = 'HrForm';
	 
	public $useTable = 'hr_form';
	  
	public $primaryKey = 'id';

	public $belongsTo = array(		
		'HrDocCategory' => array(
            'className'  => 'HrDocCategory',
			'foreignKey' => 'hr_doc_category_id'			
        )
	);
	
	public $validate = array(			
        'form' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please enter the form name'
            )
        )
		,
		'hr_doc_category_id' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please select the category'
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
	
	public function validate_file(){ 
		if($this->data['HrForm']['page'] == 'edit'){	
			if(!empty($this->data['HrForm']['upload_file']['name'])){	
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
						'rule'    => array('extension', array('doc','docx','xls','xlsx','pdf','zip','ppsx','jpg','png','gif')),
						'message'  => 'Please upload file (doc, docx, xls, xlsx, pdf, ppsx, jpg, png, gif or zip) only allowed'					
						
					),
					'size' => array(
						'required' => true,
						'rule' => array('fileSize', '<=', '20MB'),	
						'message' => 'File must be less than 20 MB'
					
						
					)
				));
				
			
	}

	
	
	
	

	
}