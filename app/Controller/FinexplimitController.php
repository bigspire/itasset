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
 
class FinexplimitController extends AppController {  
	
	public $name = 'FinExpLimit';	
	
	public $helpers = array('Html', 'Form', 'Session');
	
	public $components = array('Session', 'Functions');
	
	public $layout = 'apps';	

	/* function to list the adv. requests */
	public function index(){	
		// set the page title
		$this->set('title_for_layout', 'Expense Limit - Finance - My PDCA');
		// when the form is submitted for search
		if($this->request->is('post')){
			$this->redirect('/finexplimit/?keyword='.$this->request->data['FinExpLimit']['SearchText']);			
		}
		if($this->params->query['keyword'] != ''){
			$keyCond = array("MATCH (HRGrade.grade_name,FinExpCat.category) AGAINST ('".$this->params->query['keyword']."' IN BOOLEAN MODE)"); 
		}
		// fetch the advances		
		$this->paginate = array('fields' => array('id','amount', 'FinExpLimit.created_date', 'FinExpLimit.status','HRGrade.grade_name','FinExpCat.category'),'limit' => 10,'conditions' => array($keyCond, 'FinExpLimit.is_deleted' => 'N'), 'order' => array('created_date' => 'desc'));
		$data = $this->paginate('FinExpLimit');			
		$this->set('limit_data', $data);
		if(empty($data)){
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>You havn\'t set any expense limit', 'default', array('class' => 'alert alert'));	
		}
		
		
	}
	
	/* function to save the customer */
	public function create_explimit(){ 
		// set the page title		
		$this->set('title_for_layout', 'Create Expense Limit - Finance - My PDCA');
		// load the modules
		$this->load_grade_modules();			
		if ($this->request->is('post')){ 
			// validates the form
			$this->FinExpLimit->set($this->request->data);
			if ($this->FinExpLimit->validates(array('fieldList' => array('fin_exp_category_id','hr_grade_id','amount','status')))) {
				$this->request->data['FinExpLimit']['created_by'] = $this->Session->read('USER.Login.id');				
				$this->request->data['FinExpLimit']['created_date'] = $this->Functions->get_current_date();						
				// save the data
				if($this->FinExpLimit->save($this->request->data['FinExpLimit'])) {					
					// show the msg.
					$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Expense Limit  created successfully', 'default', array('class' => 'alert alert-success'));
					$this->redirect('/finexplimit/');
				}else{
					$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in saving the data...', 'default', array('class' => 'alert alert-error'));
				}
			}else{
				//print_r($this->FinExpLimit->validationErrors);
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in submitting the form. please check errors...', 'default', array('class' => 'alert alert-error'));	
			}
		}
	}
	
	
	
	/* function to load the permissions */
	public function load_grade_modules(){			
		$this->loadModel('HrGrade');
		$grade_list = $this->HrGrade->find('list', array('fields' => array('id', 'grade_name'), 'conditions' => array('is_deleted' => 'N', 'status' => '1'), 'order' => array('grade_name' => 'asc')));	
		$this->set('gradeList', $grade_list);
		// load exp. category
		$this->loadModel('FinExpCat');
		$cat_list = $this->FinExpCat->find('list', array('fields' => array('id', 'category'), 'conditions' => array('is_deleted' => 'N', 'status' => '1'), 'order' => array('category' => 'asc')));	
		$this->set('catList', $cat_list);
	}
		
	
	/* function to delete the adv. request */
	public function delete_explimit($adv_id){
		if(!empty($adv_id) && intval($adv_id)){
			// authorize user before action
			$ret_value = $this->auth_action($adv_id);
			if($ret_value == 'pass'){	
				// check the req belongs to the user
				$this->FinExpLimit->id = $adv_id;
				$this->FinExpLimit->saveField('is_deleted', 'Y'); 
				$this->FinExpLimit->saveField('modified_date', $this->Functions->get_current_date()); 
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Expense limit deleted successfully', 'default', array('class' => 'alert alert-success'));				
			}else if($ret_value == 'fail'){
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/finexplimit/');
			}else{
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Record Deleted: '.$ret_value , 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/finexplimit/');
			}
		}else{
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));			
		}
		$this->redirect('/finexplimit/');
	}
	
	
	/* function to edit the grade */
	public function edit_explimit($id){	
		// set the page title		
		$this->set('title_for_layout', 'Edit Expense Limit - Finance - My PDCA');		
		// load the modules
		$this->load_grade_modules();	
		if (!empty($id) && intval($id)){
			// authorize user before action
			$ret_value = $this->auth_action($id);
			if($ret_value == 'pass'){	
				// when the form submitted
				if (!empty($this->request->data)){ 
					// validates the form
					$this->FinExpLimit->set($this->request->data);
					if ($this->FinExpLimit->validates(array('fieldList' => array('fin_exp_category_id','hr_grade_id','amount','status')))) {
						$this->request->data['FinExpLimit']['modified_by'] = $this->Session->read('USER.Login.id');				
						$this->request->data['FinExpLimit']['modified_date'] = $this->Functions->get_current_date();					
						// save the data
						if($this->FinExpLimit->save($this->request->data['FinExpLimit'])) {					
							// show the msg.
							$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Expense Limit modified successfully', 'default', array('class' => 'alert alert-success'));
						}else{
							// show the error msg.
							$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in saving the data...', 'default', array('class' => 'alert alert-error'));					
						}					
					$this->redirect('/finexplimit/');						
					}	
				}else{
					$this->request->data = $this->FinExpLimit->findById($id);									
				}
			}else if($ret_value == 'fail'){
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/finexplimit/');
			}else{
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Record Deleted: '.$ret_value , 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/finexplimit/');
			}
		}else{
			// show the error msg.
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));
			$this->redirect('/finexplimit/');		
		}		
		
	}
	
	/* function to auth record */
	public function auth_action($id){
		$data = $this->FinExpLimit->findById($id, array('fields' => 'id','is_deleted','modified_date'));	
		// check the req belongs to the user
		if($data['FinExpLimit']['is_deleted'] == 'Y'){
			return $data['FinExpLimit']['modified_date'];
		}		
		else if(empty($data)){	
			return 'fail';
		}else{
			return 'pass';
		}
	}
	
	/* function to view the adv. request */
	public function view_explimit($id){
		// set the page title		
		$this->set('title_for_layout', 'View Expense Limit - Finance - My PDCA');
		if(!empty($id) && intval($id)){
			// authorize user before action
			$ret_value = $this->auth_action($id);
			if($ret_value == 'pass'){	
				$data = $this->FinExpLimit->findById($id);
				$this->set('explimit_data', $data);
			}else if($ret_value == 'fail'){ 
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/finexplimit/');	
			}else{
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Record Deleted: '.$ret_value , 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/finexplimit/');	
			}
		}else{
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));		
			$this->redirect('/finexplimit/');	
		}
		
		
	}
	
	/* clear the cache */
	
	public function beforeFilter() { 
		//$this->disable_cache();
		$this->show_tabs(22);
	}
	
	
		/* auto complete search */	
	public function search(){ 
		$this->layout = false;	 
		$q = trim(Sanitize::escape($_GET['q']));	
		if(!empty($q)){
			// execute only when the search keywork has value		
			$this->set('keyword', $q);
			$data = $this->FinExpLimit->find('all', array('fields' => array('amount','HrGrade.grade_name', 'FinExpCat.category'),  'group' => array('amount','HrGrade.grade_name', 'FinExpCat.category'), 'conditions' => 	$conditions =  array("OR" => array ('amount like' => '%'.$q.'%', 'HrGrade.grade_name like' => '%'.$q.'%', 'FinExpCat.category like' => '%'.$q.'%'), 'AND' => array('FinExpLimit.is_deleted' => 'N'))));		
			$this->set('results', $data);
		}
    }
	
	
	
}