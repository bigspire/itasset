<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
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
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
 
App::uses('Sanitize', 'Utility');
 
class HrfileController extends AppController {  
	
	public $name = 'HrFile';	
	
	public $helpers = array('Html', 'Form', 'Session');
	
	public $components = array('Session', 'Functions');
	
	public $layout = 'apps';	

	/* function to list the adv. requests */
	public function index(){	
		// set the page title
		$this->set('title_for_layout', 'File - HRIS - My PDCA');
		// when the form is submitted for search
		if($this->request->is('post')){
			$url_vars = $this->Functions->create_url(array('keyword'),'HrFile'); 
			$this->redirect('/hrfile/?'.$url_vars);					
		}
		if($this->params->query['keyword'] != ''){
			$keyCond = array("MATCH (title) AGAINST ('".$this->params->query['keyword']."' IN BOOLEAN MODE)"); 
		}
		// fetch the advances		
		$this->paginate = array('fields' => array('id','title', 'image','created_date'),'limit' => 10,'conditions' => array($keyCond, 'HrFile.is_deleted' => 'N'), 'order' => array('created_date' => 'desc'));
		$data = $this->paginate('HrFile');			
		$this->set('file_data', $data);
		if(empty($data)){
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>You havn\'t created any files', 'default', array('class' => 'alert alert'));	
		}
		
		
	}
	
	/* function to save the customer */
	public function create_file(){ 
		// set the page title		
		$this->set('title_for_layout', 'Create File - HRIS - My PDCA');	
			
		if ($this->request->is('post')){ 
			// validates the form
			$this->HrFile->set($this->request->data);
			$this->HrFile->validate_file();
			// validate file		
			if ($this->HrFile->validates(array('fieldList' => array('title','status','upload_file')))) {
				$this->request->data['HrFile']['created_by'] = $this->Session->read('USER.Login.id');				
				$this->request->data['HrFile']['created_date'] = $this->Functions->get_current_date();				
				// save the data
				if($this->HrFile->save($this->request->data['HrFile'], array('validate' => false))) {
					// upload the file
					if($file = $this->upload_attachment($this->request->data['HrFile']['upload_file'], $this->HrFile->id)){						
						$this->HrFile->saveField('image', $file);
					}					
					// show the msg.
					$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>File created successfully', 'default', array('class' => 'alert alert-success'));
					$this->redirect('/hrfile/');
				}else{
					$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in saving the data...', 'default', array('class' => 'alert alert-error'));
				}
			}else{
				//$errors = $this->HrFile->validationErrors;
				//print_r($errors);
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in submitting the form. please check errors...', 'default', array('class' => 'alert alert-error'));	
			}
		}
	}
	
	
	/* function to upload the file */
	public function upload_attachment($data, $id){
		// validate the file				
		if(!empty($data['tmp_name'])){
			$file = $id.'_'.$data['name']; 
			if($this->upload_file($data['tmp_name'], WWW_ROOT.'/uploads/files/'.$file)){
				return $file;
			}			
		}
				
	}
	
		
	
	/* function to delete the adv. request */
	public function delete_file($gr_id){
		if(!empty($gr_id) && intval($gr_id)){
			// authorize user before action
			$ret_value = $this->auth_action($gr_id);
			if($ret_value == 'pass'){		
				$this->HrFile->id = $gr_id;
				$this->HrFile->saveField('is_deleted', 'Y'); 
				$this->HrFile->saveField('modified_date', $this->Functions->get_current_date()); 
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>File deleted successfully', 'default', array('class' => 'alert alert-success'));			
			}else if($ret_value == 'fail'){
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/hrfile/');
			}else{
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Record Deleted: '.$ret_value , 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/hrfile/');
			}
		}else{
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));			
		}
		$this->redirect('/hrfile/');
	}
	
	
	/* function to edit the form */
	public function edit_file($id){	
		// set the page title		
		$this->set('title_for_layout', 'Edit File - HRIS - My PDCA');			
		if (!empty($id) && intval($id)){
			// authorize user before action
			$ret_value = $this->auth_action($id);
			if($ret_value == 'pass'){	
				// when the form submitted
				if (!empty($this->request->data)){ 
					// validates the form
					$this->HrFile->set($this->request->data);
					// validate the file
					$this->HrFile->validate_file();
					if ($this->HrFile->validates(array('fieldList' => array('title','status')))) {
						$this->request->data['HrFile']['modified_by'] = $this->Session->read('USER.Login.id');		
						$this->request->data['HrFile']['modified_date'] = $this->Functions->get_current_date();		
						// save the data
						if($this->HrFile->save($this->request->data['HrFile'])) {	
							// upload the file
							if($file = $this->upload_attachment($this->request->data['HrFile']['upload_file'], $id)){						
								$this->HrFile->saveField('image', $file);
							}
							// show the msg.
							$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>File details modified successfully', 'default', array('class' => 'alert alert-success'));
							$this->redirect('/hrfile/');		
						}else{
							// show the error msg.
							$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in saving the data...', 'default', array('class' => 'alert alert-error'));									
						}					
									
					}	
				}else{
					$this->request->data = $this->HrFile->findById($id);									
				}
			}else if($ret_value == 'fail'){
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/hrfile/');
			}else{
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Record Deleted: '.$ret_value , 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/hrfile/');
			}
		}else{
			// show the error msg.
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));
			$this->redirect('/hrfile/');		
		}		
		
	}
	
	/* function to auth record */
	public function auth_action($id){
		$data = $this->HrFile->findById($id, array('fields' => 'id','is_deleted','modified_date'));	
		// check the req belongs to the user
		if($data['HrFile']['is_deleted'] == 'Y'){
			return $data['HrFile']['modified_date'];
		}		
		else if(empty($data)){	
			return 'fail';
		}else{
			return 'pass';
		}
	}
	
	/* function to download the file */
	public function download_image($file){ 
		 $this->download_file(WWW_ROOT.'/uploads/files/'.$file);
		 die;
	}
	
	
	
	/* clear the cache */
	
	public function beforeFilter() { 
		//$this->disable_cache();
		$this->show_tabs(50);
	}
	
	
		/* auto complete search */	
	public function search(){ 
		$this->layout = false;	 
		$q = trim(Sanitize::escape($_GET['q']));	
		if(!empty($q)){
			// execute only when the search keywork has value		
			$this->set('keyword', $q);
			$data = $this->HrFile->find('all', array('fields' => array('title'),  'group' => array('title'), 'conditions' => 	array("OR" => array ('title like' => '%'.$q.'%'), 'AND' => array('is_deleted' => 'N'))));		
			$this->set('results', $data);
		}
    }
	
	
	
}