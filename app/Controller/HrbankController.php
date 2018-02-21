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
 
class HrbankController extends AppController {  
	
	public $name = 'HrBank';	
	
	public $helpers = array('Html', 'Form', 'Session');
	
	public $components = array('Session', 'Functions');
	
	public $layout = 'apps';	

	/* function to list the adv. requests */
	public function index(){	
		// set the page title
		$this->set('title_for_layout', 'Bank - HRIS - My PDCA');
		// when the form is submitted for search
		if($this->request->is('post')){
			$url_vars = $this->Functions->create_url(array('keyword'),'HrBank'); 
			$this->redirect('/hrbank/?'.$url_vars);					
		}
		if($this->params->query['keyword'] != ''){
			$keyCond = array("MATCH (bank,ifsc,branch) AGAINST ('".$this->params->query['keyword']."' IN BOOLEAN MODE)"); 
		}
		// fetch the advances		
		$this->paginate = array('fields' => array('id','bank', 'branch', 'ifsc', 'status','created_date'),'limit' => 10,'conditions' => array($keyCond, 'HrBank.is_deleted' => 'N'), 'order' => array('created_date' => 'desc'));
		$data = $this->paginate('HrBank');			
		$this->set('bnk_data', $data);
		if(empty($data)){
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>You havn\'t created any bank', 'default', array('class' => 'alert alert'));	
		}
		
		
	}
	
	/* function to save the customer */
	public function create_bank(){ 
		// set the page title		
		$this->set('title_for_layout', 'Create Bank - HRIS - My PDCA');				
		if ($this->request->is('post')){ 
			// validates the form
			$this->HrBank->set($this->request->data);		
			// validate file		
			if ($this->HrBank->validates(array('fieldList' => array('bank','status')))) {
				$this->request->data['HrBank']['created_by'] = $this->Session->read('USER.Login.id');				
				$this->request->data['HrBank']['created_date'] = $this->Functions->get_current_date();				
				// save the data
				if($this->HrBank->save($this->request->data['HrBank'], array('validate' => false))) {				
					// show the msg.
					$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Bank  created successfully', 'default', array('class' => 'alert alert-success'));
					$this->redirect('/hrbank/');
				}else{
					$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in saving the data...', 'default', array('class' => 'alert alert-error'));
				}
			}else{
				//$errors = $this->HrBank->validationErrors;
				//print_r($errors);
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in submitting the form. please check errors...', 'default', array('class' => 'alert alert-error'));	
			}
		}
	}
	
	
		
	
	/* function to delete the adv. request */
	public function delete_bank($gr_id){
		if(!empty($gr_id) && intval($gr_id)){
			// authorize user before action
			$ret_value = $this->auth_action($gr_id);
			if($ret_value == 'pass'){		
				$this->HrBank->id = $gr_id;
				$this->HrBank->saveField('is_deleted', 'Y'); 
				$this->HrBank->saveField('modified_date', $this->Functions->get_current_date()); 
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Bank deleted successfully', 'default', array('class' => 'alert alert-success'));			
			}else if($ret_value == 'fail'){
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/hrbank/');
			}else{
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Record Deleted: '.$ret_value , 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/hrbank/');
			}
		}else{
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));			
		}
		$this->redirect('/hrbank/');
	}
	
	
	/* function to edit the form */
	public function edit_bank($id){	
		// set the page title		
		$this->set('title_for_layout', 'Edit Bank - HRIS - My PDCA');			
		if (!empty($id) && intval($id)){
			// authorize user before action
			$ret_value = $this->auth_action($id);
			if($ret_value == 'pass'){	
				// when the form submitted
				if (!empty($this->request->data)){ 
					// validates the form
					$this->HrBank->set($this->request->data);				
					if ($this->HrBank->validates(array('fieldList' => array('bank','status')))) {
						$this->request->data['HrBank']['modified_by'] = $this->Session->read('USER.Login.id');		
						$this->request->data['HrBank']['modified_date'] = $this->Functions->get_current_date();		
						// save the data
						if($this->HrBank->save($this->request->data['HrBank'])) {								
							// show the msg.
							$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Bank details modified successfully', 'default', array('class' => 'alert alert-success'));
							$this->redirect('/hrbank/');		
						}else{
							// show the error msg.
							$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in saving the data...', 'default', array('class' => 'alert alert-error'));									
						}					
									
					}	
				}else{
					$this->request->data = $this->HrBank->findById($id);									
				}
			}else if($ret_value == 'fail'){
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/hrbank/');
			}else{
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Record Deleted: '.$ret_value , 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/hrbank/');
			}
		}else{
			// show the error msg.
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));
			$this->redirect('/hrbank/');		
		}		
		
	}
	
	/* function to auth record */
	public function auth_action($id){
		$data = $this->HrBank->findById($id, array('fields' => 'id','is_deleted','modified_date'));	
		// check the req belongs to the user
		if($data['HrBank']['is_deleted'] == 'Y'){
			return $data['HrBank']['modified_date'];
		}		
		else if(empty($data)){	
			return 'fail';
		}else{
			return 'pass';
		}
	}
	
	
	/* function to view the adv. request */
	public function view_bank($id){
		// set the page title		
		$this->set('title_for_layout', 'View Bank - HRIS - My PDCA');
		if(!empty($id) && intval($id)){
			// authorize user before action
			$ret_value = $this->auth_action($id);
			if($ret_value == 'pass'){	
				$data = $this->HrBank->findById($id);
				$this->set('bnk_data', $data);
			}else if($ret_value == 'fail'){ 
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/hrbank/');	
			}else{
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Record Deleted: '.$ret_value , 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/hrbank/');	
			}
		}else{
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));		
			$this->redirect('/hrbank/');	
		}
		
		
	}
	
	/* clear the cache */
	
	public function beforeFilter() { 
		//$this->disable_cache();
		$this->show_tabs(42);
	}
	
	
		/* auto complete search */	
	public function search(){ 
		$this->layout = false;	 
		$q = trim(Sanitize::escape($_GET['q']));	
		if(!empty($q)){
			// execute only when the search keywork has value		
			$this->set('keyword', $q);
			$data = $this->HrBank->find('all', array('fields' => array('bank', 'branch', 'ifsc'),  'group' => array('bank', 'branch', 'ifsc'), 'conditions' => array("OR" => array ('bank like' => '%'.$q.'%', 'ifsc like' => '%'.$q.'%', 'branch like' => '%'.$q.'%'), 'AND' => array('is_deleted' => 'N'))));		
			$this->set('results', $data);
		}
    }
	
	
	
}