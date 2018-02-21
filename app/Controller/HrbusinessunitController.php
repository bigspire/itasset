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
 
class HrbusinessunitController extends AppController {  
	
	public $name = 'HrBusinessUnit';	
	
	public $helpers = array('Html', 'Form', 'Session');
	
	public $components = array('Session', 'Functions');
	
	public $layout = 'apps';	

	/* function to list the adv. requests */
	public function index(){	
		// set the page title
		$this->set('title_for_layout', 'Business Unit - HRIS - My PDCA');
		// when the form is submitted for search
		if($this->request->is('post')){
			$this->redirect('/hrbusinessunit/?keyword='.$this->request->data['HrBusinessUnit']['SearchText']);			
		}
		if($this->params->query['keyword'] != ''){
			$keyCond = array("MATCH (business_unit) AGAINST ('".$this->params->query['keyword']."' IN BOOLEAN MODE)"); 
		}
		// fetch the advances		
		$this->paginate = array('fields' => array('id','business_unit', 'status','created_date'),'limit' => 10,'conditions' => array($keyCond, 'HrBusinessUnit.is_deleted' => 'N'), 'order' => array('HrBusinessUnit.created_date' => 'desc'));
		$data = $this->paginate('HrBusinessUnit');			
		$this->set('dept_data', $data);
		if(empty($data)){
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>You havn\'t created any business unit(s)', 'default', array('class' => 'alert alert'));	
		}
		
		
	}
	
	/* function to save the customer */
	public function create_business_unit(){ 
		// set the page title		
		$this->set('title_for_layout', 'Create Business Unit - HRIS - My PDCA');				
		if ($this->request->is('post')){ 
			// validates the form
			$this->HrBusinessUnit->set($this->request->data);
			if ($this->HrBusinessUnit->validates(array('fieldList' => array('business_unit','status')))) {
				$this->request->data['HrBusinessUnit']['created_by'] = $this->Session->read('USER.Login.id');				
				$this->request->data['HrBusinessUnit']['created_date'] = $this->Functions->get_current_date();						
				// save the data
				if($this->HrBusinessUnit->save($this->request->data['HrBusinessUnit'])) {					
					// show the msg.
					$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Business Unit  created successfully', 'default', array('class' => 'alert alert-success'));
					$this->redirect('/hrbusinessunit/');
				}else{
					$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in saving the data...', 'default', array('class' => 'alert alert-error'));
				}
			}else{
				//print_r($this->HrBusinessUnit->validationErrors);
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in submitting the form. please check errors...', 'default', array('class' => 'alert alert-error'));	
			}
		}
	}
	
		
	
	/* function to delete the adv. request */
	public function delete_business_unit($branch_id){
		if(!empty($branch_id) && intval($branch_id)){
			// authorize user before action
			$ret_value = $this->auth_action($branch_id);
			if($ret_value == 'pass'){				
				$this->HrBusinessUnit->id = $branch_id;
				$this->HrBusinessUnit->saveField('is_deleted', 'Y'); 
				$this->HrBusinessUnit->saveField('modified_date', $this->Functions->get_current_date()); 
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Business Unit deleted successfully', 'default', array('class' => 'alert alert-success'));					
			}else if($ret_value == 'fail'){
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/hrbusinessunit/');
			}else{
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Record Deleted: '.$ret_value , 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/hrbusinessunit/');
			}
		}else{
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));			
		}
		$this->redirect('/hrbusinessunit/');
	}
	
	
	/* function to edit the grade */
	public function edit_business_unit($id){	
		// set the page title		
		$this->set('title_for_layout', 'Edit Business Unit - HRIS - My PDCA');			
		if (!empty($id) && intval($id)){
			// authorize user before action
			$ret_value = $this->auth_action($id);
			if($ret_value == 'pass'){	
				// when the form submitted
				if (!empty($this->request->data)){ 
					// validates the form
					$this->HrBusinessUnit->set($this->request->data);
					if ($this->HrBusinessUnit->validates(array('fieldList' => array('business_unit','status')))) {
						$this->request->data['HrBusinessUnit']['modified_by'] = $this->Session->read('USER.Login.id');				
						$this->request->data['HrBusinessUnit']['modified_date'] = $this->Functions->get_current_date();					
						// save the data
						if($this->HrBusinessUnit->save($this->request->data['HrBusinessUnit'])) {					
							// show the msg.
							$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Business Unit details modified successfully', 'default', array('class' => 'alert alert-success'));
						}else{
							// show the error msg.
							$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in saving the data...', 'default', array('class' => 'alert alert-error'));					
						}					
					$this->redirect('/hrbusinessunit/');						
					}	
				}else{
					$this->request->data = $this->HrBusinessUnit->findById($id);									
				}
			}else if($ret_value == 'fail'){
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/hrbusinessunit/');
			}else{
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Record Deleted: '.$ret_value , 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/hrbusinessunit/');
			}
		}else{
			// show the error msg.
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));
			$this->redirect('/hrbusinessunit/');		
		}		
		
	}
	
	/* function to auth record */
	public function auth_action($id){
		$data = $this->HrBusinessUnit->findById($id, array('fields' => 'id','is_deleted','modified_date'));	
		// check the req belongs to the user
		if($data['HrBusinessUnit']['is_deleted'] == 'Y'){
			return $data['HrBusinessUnit']['modified_date'];
		}		
		else if(empty($data)){	
			return 'fail';
		}else{
			return 'pass';
		}
	}
	
	/* function to view the adv. request */
	public function view_business_unit($id){
		// set the page title		
		$this->set('title_for_layout', 'View Business Unit - HRIS - My PDCA');
		if(!empty($id) && intval($id)){
			// authorize user before action
			$ret_value = $this->auth_action($id);
			if($ret_value == 'pass'){	
				$data = $this->HrBusinessUnit->findById($id);
				$this->set('dept_data', $data);
			}else if($ret_value == 'fail'){ 
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/hrbusinessunit/');	
			}else{
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Record Deleted: '.$ret_value , 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/hrbusinessunit/');	
			}
		}else{
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));		
			$this->redirect('/hrbusinessunit/');	
		}
		
		
	}
	
	/* clear the cache */
	
	public function beforeFilter() { 
		//$this->disable_cache();
		$this->show_tabs(51);
	}
	
	
		/* auto complete search */	
	public function search(){ 
		$this->layout = false;	 
		$q = trim(Sanitize::escape($_GET['q']));	
		if(!empty($q)){
			// execute only when the search keywork has value		
			$this->set('keyword', $q);
			$data = $this->HrBusinessUnit->find('all', array('fields' => array('business_unit'),  'group' => array('business_unit'), 'conditions' =>  array("OR" => array ('business_unit like' => '%'.$q.'%'), 'AND' => array('is_deleted' => 'N'))));		
			$this->set('results', $data);
		}
    }
	
	
	
}