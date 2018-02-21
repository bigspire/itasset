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

class HrGallery extends AppModel {
	
	public $name = 'HrGallery';
	 
	public $useTable = 'hr_gallery';
	  
	public $primaryKey = 'id';	
	
	public $hasOne = array(		
		'HrGalleryItem' => array(
            'className'  => 'HrGalleryItem',
			'foreignKey' => 'hr_gallery_id'		
        ),
		'HrGalStatus' => array(
            'className'  => 'HrGalStatus',
			'foreignKey' => 'hr_gallery_id'			
        )
	);
	
	public $belongsTo = array(				
		'Home' => array(
            'className'  => 'Home',
			'foreignKey' => 'app_users_id'			
        )
	);
	
	
	public $validate = array(			
        'title' => array(		
            'empty' => array(
                'rule'     => 'notEmpty',
                'required' => true,
                'message'  => 'Please enter the gallery title'
            )
        ),
		 'file' => array(		
            'empty' => array(
                'rule'     => 'validate_file',
                'required' => true,
                'message'  => 'Please choose file(s) and upload the file(s)'
            )
        )
	);
	
	/* function to validate the file */
	public function validate_file(){
		$dir = $this->webroot.'file_upload/server/php/'.$this->data['HrGallery']['folder'];
		if ($handle = opendir($dir)) {
			while (false !== ($entry = readdir($handle))) {
				if ($entry != "." && $entry != "..") {
					 if (is_file($dir.'/'.$entry)){ 
						$files[] = $entry;
					 }
				}
			}
			closedir($handle);
		}
		if(count($files) > 0){
			return true;
		}else{
			return false;
		}
	}
	
	
	
	
	
	

	
}