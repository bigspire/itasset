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
 
class HrlatestController extends AppController {  
	
	public $name = 'HrLatest';	
	
	public $helpers = array('Html', 'Form', 'Session');
	
	public $components = array('Session', 'Functions');
	
	public $layout = 'apps';	

	/* function to list the adv. requests */
	public function index(){	
		// set the page title
		$this->set('title_for_layout', 'Latest Updates - HRIS - My PDCA');
		// when the form is submitted for search
		if($this->request->is('post')){
			$url_vars = $this->Functions->create_url(array('keyword'),'HrLatest'); 
			$this->redirect('/hrlatest/?'.$url_vars);					
		}
		if($this->params->query['keyword'] != ''){
			$keyCond = array("MATCH (title,HrLatest.desc) AGAINST ('".$this->params->query['keyword']."' IN BOOLEAN MODE)"); 
		}
		// fetch the advances		
		$this->paginate = array('fields' => array('id','title', 'desc', 'attachment', 'status','created_date'),'limit' => 10,'conditions' => array($keyCond, 'HrLatest.is_deleted' => 'N'), 'order' => array('created_date' => 'desc'));
		$data = $this->paginate('HrLatest');			
		$this->set('latest_data', $data);
		if(empty($data)){
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>You havn\'t created any updates', 'default', array('class' => 'alert alert'));	
		}
		
		
	}
	
	/* function to save the customer */
	public function create_updates(){ 
		// set the page title		
		$this->set('title_for_layout', 'Create Latest Updates - HRIS - My PDCA');	
			
		if ($this->request->is('post')){ 
			// validates the form
			$this->HrLatest->set($this->request->data);
			$this->HrLatest->validate_file();
			// validate file		
			if ($this->HrLatest->validates(array('fieldList' => array('title','status','desc','upload_file','news_type')))) {
				$this->request->data['HrLatest']['created_by'] = $this->Session->read('USER.Login.id');				
				$this->request->data['HrLatest']['created_date'] = $this->Functions->get_current_date();				
				// save the data
				if($this->HrLatest->save($this->request->data['HrLatest'], array('validate' => false))) {
					// upload the file
					if($file = $this->upload_attachment($this->request->data['HrLatest']['upload_file'], $this->HrLatest->id)){						
						$this->HrLatest->saveField('attachment', $file);
					}					
					// show the msg.
					$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Latest Updates  created successfully', 'default', array('class' => 'alert alert-success'));
					$this->redirect('/hrlatest/');
				}else{
					$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in saving the data...', 'default', array('class' => 'alert alert-error'));
				}
			}else{
				//$errors = $this->HrLatest->validationErrors;
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
			if($this->upload_file($data['tmp_name'], WWW_ROOT.'/uploads/news/'.$file)){
				return $file;
			}			
		}
				
	}
	
		
	
	/* function to delete the adv. request */
	public function delete_updates($gr_id){
		if(!empty($gr_id) && intval($gr_id)){
			// authorize user before action
			$ret_value = $this->auth_action($gr_id);
			if($ret_value == 'pass'){		
				$this->HrLatest->id = $gr_id;
				$this->HrLatest->saveField('is_deleted', 'Y'); 
				$this->HrLatest->saveField('modified_date', $this->Functions->get_current_date()); 
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Latest Updates deleted successfully', 'default', array('class' => 'alert alert-success'));			
			}else if($ret_value == 'fail'){
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/hrlatest/');
			}else{
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Record Deleted: '.$ret_value , 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/hrlatest/');
			}
		}else{
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));			
		}
		$this->redirect('/hrlatest/');
	}
	
	
	/* function to edit the form */
	public function edit_updates($id){	
		// set the page title		
		$this->set('title_for_layout', 'Edit Latest Updates - HRIS - My PDCA');			
		if (!empty($id) && intval($id)){
			// authorize user before action
			$ret_value = $this->auth_action($id);
			if($ret_value == 'pass'){	
				// when the form submitted
				if (!empty($this->request->data)){ 
					// validates the form
					$this->HrLatest->set($this->request->data);
					// validate the file
					$this->HrLatest->validate_file();
					if ($this->HrLatest->validates(array('fieldList' => array('form','status','news_type')))) {
						$this->request->data['HrLatest']['modified_by'] = $this->Session->read('USER.Login.id');		
						$this->request->data['HrLatest']['modified_date'] = $this->Functions->get_current_date();		
						// save the data
						if($this->HrLatest->save($this->request->data['HrLatest'])) {	
							// upload the file
							if($file = $this->upload_attachment($this->request->data['HrLatest']['upload_file'], $id)){						
								$this->HrLatest->saveField('attachment', $file);
							}
							// show the msg.
							$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Latest Updates details modified successfully', 'default', array('class' => 'alert alert-success'));
							$this->redirect('/hrlatest/');		
						}else{
							// show the error msg.
							$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in saving the data...', 'default', array('class' => 'alert alert-error'));									
						}					
									
					}	
				}else{
					$this->request->data = $this->HrLatest->findById($id);									
				}
			}else if($ret_value == 'fail'){
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/hrlatest/');
			}else{
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Record Deleted: '.$ret_value , 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/hrlatest/');
			}
		}else{
			// show the error msg.
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));
			$this->redirect('/hrlatest/');		
		}		
		
	}
	
	/* function to auth record */
	public function auth_action($id){
		$data = $this->HrLatest->findById($id, array('fields' => 'id','is_deleted','modified_date'));	
		// check the req belongs to the user
		if($data['HrLatest']['is_deleted'] == 'Y'){
			return $data['HrLatest']['modified_date'];
		}		
		else if(empty($data)){	
			return 'fail';
		}else{
			return 'pass';
		}
	}
	
	/* function to download the file */
	public function download_update($file){		
		$this->download_file(WWW_ROOT.'/uploads/news/'.$file);
		die;
		
	}
	
	/* function to view the adv. request */
	public function view_updates($id){
		// set the page title		
		$this->set('title_for_layout', 'View Latest Updates - HRIS - My PDCA');
		if(!empty($id) && intval($id)){
			// authorize user before action
			$ret_value = $this->auth_action($id);
			if($ret_value == 'pass'){	
				$data = $this->HrLatest->findById($id);
				$this->set('frm_data', $data);
			}else if($ret_value == 'fail'){ 
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/hrlatest/');	
			}else{
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Record Deleted: '.$ret_value , 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/hrlatest/');	
			}
		}else{
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));		
			$this->redirect('/hrlatest/');	
		}
		
		
	}
	
	/* clear the cache */
	
	public function beforeFilter() { 
		//$this->disable_cache();
		$this->show_tabs(35);
	}
	
	
	
	
}