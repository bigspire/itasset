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
 
class HrformController extends AppController {  
	
	public $name = 'HrForm';	
	
	public $helpers = array('Html', 'Form', 'Session');
	
	public $components = array('Session', 'Functions');
	
	public $layout = 'apps';	

	/* function to list the adv. requests */
	public function index(){	
		// set the page title
		$this->set('title_for_layout', 'Form - HRIS - My PDCA');
		// when the form is submitted for search
		if($this->request->is('post')){
			$url_vars = $this->Functions->create_url(array('keyword'),'HrForm'); 
			$this->redirect('/hrform/?'.$url_vars);					
		}
		if($this->params->query['keyword'] != ''){
			$keyCond = array("MATCH (form,HrForm.desc) AGAINST ('".$this->params->query['keyword']."' IN BOOLEAN MODE)"); 
		}
		// fetch the advances		
		$this->paginate = array('fields' => array('id','form', 'desc', 'HrDocCategory.category', 'attachment', 'status','created_date','modified_date'),'limit' => 10,'conditions' => array($keyCond, 'HrForm.is_deleted' => 'N'), 'order' => array('created_date' => 'desc'));
		$data = $this->paginate('HrForm');			
		$this->set('frm_data', $data);
		if(empty($data)){
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>You havn\'t created any form', 'default', array('class' => 'alert alert'));	
		}
		
		
	}
	
	/* function to load the doc. category */
	public function load_category(){
		// fetch the categories
		$cat_list = $this->HrForm->HrDocCategory->find('list', array('fields' => array('id','category'), 'order' => array('priority ASC'),'conditions' => array('is_deleted' => 'N', 'status' => '1')));
		$this->set('catList', $cat_list);
	}
	
	/* function to save the customer */
	public function create_form(){ 
		// set the page title		
		$this->set('title_for_layout', 'Create Form - HRIS - My PDCA');	
		$this->load_category();	
		if ($this->request->is('post')){ 
			// validates the form
			$this->HrForm->set($this->request->data);
			$this->HrForm->validate_file();
			// validate file		
			if ($this->HrForm->validates(array('fieldList' => array('form','status','upload_file','hr_doc_category_id')))) {
				$this->request->data['HrForm']['created_by'] = $this->Session->read('USER.Login.id');				
				$this->request->data['HrForm']['created_date'] = $this->Functions->get_current_date();				
				// save the data
				if($this->HrForm->save($this->request->data['HrForm'], array('validate' => false))) {
					// upload the file
					if($file = $this->upload_attachment($this->request->data['HrForm']['upload_file'], $this->HrForm->id)){						
						$this->HrForm->saveField('attachment', $file);
					}					
					// show the msg.
					$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Doc created successfully', 'default', array('class' => 'alert alert-success'));
					$this->redirect('/hrform/');
				}else{
					$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in saving the data...', 'default', array('class' => 'alert alert-error'));
				}
			}else{
				//$errors = $this->HrForm->validationErrors;
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
			if($this->upload_file($data['tmp_name'], WWW_ROOT.'/uploads/form/'.$file)){
				return $file;
			}			
		}
				
	}
	
		
	
	/* function to delete the adv. request */
	public function delete_form($gr_id){
		if(!empty($gr_id) && intval($gr_id)){
			// authorize user before action
			$ret_value = $this->auth_action($gr_id);
			if($ret_value == 'pass'){		
				$this->HrForm->id = $gr_id;
				$this->HrForm->saveField('is_deleted', 'Y'); 
				$this->HrForm->saveField('modified_date', $this->Functions->get_current_date()); 
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Doc deleted successfully', 'default', array('class' => 'alert alert-success'));			
			}else if($ret_value == 'fail'){
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/hrform/');
			}else{
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Record Deleted: '.$ret_value , 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/hrform/');
			}
		}else{
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));			
		}
		$this->redirect('/hrform/');
	}
	
	
	/* function to edit the form */
	public function edit_form($id){	
		// set the page title		
		$this->set('title_for_layout', 'Edit Form - HRIS - My PDCA');			
		if (!empty($id) && intval($id)){
			// authorize user before action
			$ret_value = $this->auth_action($id);
			if($ret_value == 'pass'){	
				$this->load_category();	
				// when the form submitted
				if (!empty($this->request->data)){ 
					// validates the form
					$this->HrForm->set($this->request->data);
					// validate the file
					$this->HrForm->validate_file();
					if ($this->HrForm->validates(array('fieldList' => array('form','status','hr_doc_category_id')))) {
						$this->request->data['HrForm']['modified_by'] = $this->Session->read('USER.Login.id');		
						$this->request->data['HrForm']['modified_date'] = $this->Functions->get_current_date();		
						// save the data
						if($this->HrForm->save($this->request->data['HrForm'])) {	
							// upload the file
							if($file = $this->upload_attachment($this->request->data['HrForm']['upload_file'], $id)){						
								$this->HrForm->saveField('attachment', $file);
							}
							// show the msg.
							$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Doc details modified successfully', 'default', array('class' => 'alert alert-success'));
							$this->redirect('/hrform/');		
						}else{
							// show the error msg.
							$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in saving the data...', 'default', array('class' => 'alert alert-error'));									
						}					
									
					}	
				}else{
					$this->request->data = $this->HrForm->findById($id);									
				}
			}else if($ret_value == 'fail'){
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/hrform/');
			}else{
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Record Deleted: '.$ret_value , 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/hrform/');
			}
		}else{
			// show the error msg.
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));
			$this->redirect('/hrform/');		
		}		
		
	}
	
	/* function to auth record */
	public function auth_action($id){
		$data = $this->HrForm->findById($id, array('fields' => 'id','is_deleted','modified_date'));	
		// check the req belongs to the user
		if($data['HrForm']['is_deleted'] == 'Y'){
			return $data['HrForm']['modified_date'];
		}		
		else if(empty($data)){	
			return 'fail';
		}else{
			return 'pass';
		}
	}
	
	/* function to download the file */
	public function download_form($file){
		 $this->download_file(WWW_ROOT.'/uploads/form/'.$file);
		 die;
	}
	
	/* function to view the adv. request */
	public function view_form($id){
		// set the page title		
		$this->set('title_for_layout', 'View Form - HRIS - My PDCA');
		if(!empty($id) && intval($id)){
			// authorize user before action
			$ret_value = $this->auth_action($id);
			if($ret_value == 'pass'){	
				$data = $this->HrForm->findById($id);
				$this->set('frm_data', $data);
			}else if($ret_value == 'fail'){ 
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/hrform/');	
			}else{
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Record Deleted: '.$ret_value , 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/hrform/');	
			}
		}else{
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));		
			$this->redirect('/hrform/');	
		}
		
		
	}
	
	/* clear the cache */
	
	public function beforeFilter() { 
		//$this->disable_cache();
		$this->show_tabs(34);
	}
	
	
		/* auto complete search */	
	public function search(){ 
		$this->layout = false;	 
		$q = trim(Sanitize::escape($_GET['q']));	
		if(!empty($q)){
			// execute only when the search keywork has value		
			$this->set('keyword', $q);
			$data = $this->HrForm->find('all', array('fields' => array('form'),  'group' => array('form'), 'conditions' => 	$conditions =  array("OR" => array ('form like' => '%'.$q.'%'), 'AND' => array('is_deleted' => 'N'))));		
			$this->set('results', $data);
		}
    }
	
	
	
}