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
 
class HrDepartmentController extends AppController {  
	
	public $name = 'HrDepartment';	
	
	public $helpers = array('Html', 'Form', 'Session');
	
	public $components = array('Session', 'Functions');
	
	public $layout = 'apps';	

	/* function to list the adv. requests */
	public function index(){	
		// set the page title
		$this->set('title_for_layout', 'Department - HRIS - My PDCA');
		// when the form is submitted for search
		if($this->request->is('post')){
			$this->redirect('/hrdepartment/?keyword='.$this->request->data['HrDepartment']['SearchText']);			
		}
		if($this->params->query['keyword'] != ''){
			$keyCond = array("MATCH (dept_name,dept_desc) AGAINST ('".$this->params->query['keyword']."' IN BOOLEAN MODE)"); 
		}
		// fetch the advances		
		$this->paginate = array('fields' => array('id','dept_name', 'status','created_date'),'limit' => 10,'conditions' => array($keyCond, 'HrDepartment.is_deleted' => 'N'), 'order' => array('created_date' => 'desc'));
		$data = $this->paginate('HrDepartment');			
		$this->set('dept_data', $data);
		if(empty($data)){
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>You havn\'t created any departments', 'default', array('class' => 'alert alert'));	
		}
		
		
	}
	
	/* function to save the customer */
	public function create_dept(){ 
		// set the page title		
		$this->set('title_for_layout', 'Create Department - HRIS - My PDCA');				
		if ($this->request->is('post')){ 
			// validates the form
			$this->HrDepartment->set($this->request->data);
			if ($this->HrDepartment->validates(array('fieldList' => array('dept_name','status')))) {
				$this->request->data['HrDepartment']['created_by'] = $this->Session->read('USER.Login.id');				
				$this->request->data['HrDepartment']['created_date'] = $this->Functions->get_current_date();						
				// save the data
				if($this->HrDepartment->save($this->request->data['HrDepartment'])) {					
					// show the msg.
					$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Department  created successfully', 'default', array('class' => 'alert alert-success'));
					$this->redirect('/hrdepartment/');
				}else{
					$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in saving the data...', 'default', array('class' => 'alert alert-error'));
				}
			}else{
				//print_r($this->HrDepartment->validationErrors);
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in submitting the form. please check errors...', 'default', array('class' => 'alert alert-error'));	
			}
		}
	}
	
		
	
	/* function to delete the adv. request */
	public function delete_dept($dept_id){
		if(!empty($dept_id) && intval($dept_id)){
			// authorize user before action
			$ret_value = $this->auth_action($dept_id);
			if($ret_value == 'pass'){				
				$this->HrDepartment->id = $dept_id;
				$this->HrDepartment->saveField('is_deleted', 'Y'); 
				$this->HrDepartment->saveField('modified_date', $this->Functions->get_current_date()); 
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Department deleted successfully', 'default', array('class' => 'alert alert-success'));					
			}else if($ret_value == 'fail'){
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/hrdepartment/');
			}else{
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Record Deleted: '.$ret_value , 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/hrdepartment/');
			}
		}else{
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));			
		}
		$this->redirect('/hrdepartment/');
	}
	
	
	/* function to edit the grade */
	public function edit_dept($id){	
		// set the page title		
		$this->set('title_for_layout', 'Edit Department - HRIS - My PDCA');			
		if (!empty($id) && intval($id)){
			// authorize user before action
			$ret_value = $this->auth_action($id);
			if($ret_value == 'pass'){	
				// when the form submitted
				if (!empty($this->request->data)){ 
					// validates the form
					$this->HrDepartment->set($this->request->data);
					if ($this->HrDepartment->validates(array('fieldList' => array('dept_name','status')))) {
						$this->request->data['HrDepartment']['modified_by'] = $this->Session->read('USER.Login.id');				
						$this->request->data['HrDepartment']['modified_date'] = $this->Functions->get_current_date();					
						// save the data
						if($this->HrDepartment->save($this->request->data['HrDepartment'])) {					
							// show the msg.
							$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Department details modified successfully', 'default', array('class' => 'alert alert-success'));
						}else{
							// show the error msg.
							$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in saving the data...', 'default', array('class' => 'alert alert-error'));					
						}					
					$this->redirect('/hrdepartment/');						
					}	
				}else{
					$this->request->data = $this->HrDepartment->findById($id);									
				}
			}else if($ret_value == 'fail'){
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/hrdepartment/');
			}else{
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Record Deleted: '.$ret_value , 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/hrdepartment/');
			}
		}else{
			// show the error msg.
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));
			$this->redirect('/hrdepartment/');		
		}		
		
	}
	
	/* function to auth record */
	public function auth_action($id){
		$data = $this->HrDepartment->findById($id, array('fields' => 'id','is_deleted','modified_date'));	
		// check the req belongs to the user
		if($data['HrDepartment']['is_deleted'] == 'Y'){
			return $data['HrDepartment']['modified_date'];
		}		
		else if(empty($data)){	
			return 'fail';
		}else{
			return 'pass';
		}
	}
	
	/* function to view the adv. request */
	public function view_dept($id){
		// set the page title		
		$this->set('title_for_layout', 'View Department - HRIS - My PDCA');
		if(!empty($id) && intval($id)){
			// authorize user before action
			$ret_value = $this->auth_action($id);
			if($ret_value == 'pass'){	
				$data = $this->HrDepartment->findById($id);
				$this->set('dept_data', $data);
			}else if($ret_value == 'fail'){ 
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/hrdepartment/');	
			}else{
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Record Deleted: '.$ret_value , 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/hrdepartment/');	
			}
		}else{
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));		
			$this->redirect('/hrdepartment/');	
		}
		
		
	}
	
	/* clear the cache */
	
	public function beforeFilter() { 
		//$this->disable_cache();
		$this->show_tabs(18);
	}
	
	
		/* auto complete search */	
	public function search(){ 
		$this->layout = false;	 
		$q = trim(Sanitize::escape($_GET['q']));	
		if(!empty($q)){
			// execute only when the search keywork has value		
			$this->set('keyword', $q);
			$data = $this->HrDepartment->find('all', array('fields' => array('dept_name'),  'group' => array('dept_name'), 'conditions' => 	$conditions =  array("OR" => array ('dept_name like' => '%'.$q.'%'), 'AND' => array('is_deleted' => 'N'))));		
			$this->set('results', $data);
		}
    }
	
	
	
}