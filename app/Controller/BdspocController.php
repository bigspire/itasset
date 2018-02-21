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
 
class BdspocController extends AppController {  
	
	public $name = 'BdSpoc';	
	
	public $helpers = array('Html', 'Form', 'Session');
	
	public $components = array('Session', 'Functions');
	
	public $layout = 'apps';	

	/* function to list the adv. requests */
	public function index(){	
		// set the page title
		$this->set('title_for_layout', 'SPOC - Settings - My PDCA');
		// when the form is submitted for search
		if($this->request->is('post')){
			$url_vars = $this->Functions->create_url(array('keyword'), 'BdSpoc'); 
			$this->redirect('/bdspoc/?'.$url_vars);			
		}
		if($this->params->query['keyword'] != ''){
			$keyCond = array("MATCH (HrEmployee.first_name) AGAINST ('".$this->params->query['keyword']."' IN BOOLEAN MODE)"); 
		}
		// fetch the spoc		
		$this->paginate = array('fields' => array('id','HrEmployee.first_name','HrEmployee.last_name','BdSpoc.status','created_date'),
		'limit' => 10,'conditions' => array('HrEmployee.status' => '1', 'HrEmployee.is_deleted' => 'N', 'BdSpoc.is_deleted' => 'N', $keyCond),
		'order' => array('created_date' => 'desc'));
		$data = $this->paginate('BdSpoc');			
		$this->set('spoc_data', $data);
		if(empty($data)){
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>You havn\'t created any SPOC', 'default', array('class' => 'alert alert'));	
		}
	}
	
	/* function to list the add  */
	public function add_spoc(){	
		// set the page title
		$this->set('title_for_layout', 'Add SPOC - Settings - BD - My PDCA');
		$this->set('empList', $this->BdSpoc->get_employee_details());
		if ($this->request->is('post')){
			// validates the form
			$this->BdSpoc->set($this->request->data);
			// validate file		
			if ($this->BdSpoc->validates(array('fieldList' => array('app_users_id','status')))) {
				$this->request->data['BdSpoc']['created_date'] = $this->Functions->get_current_date();
				// save the data
				if($this->BdSpoc->save($this->request->data['BdSpoc'], array('validate' => false))){					
					// show the msg.
					$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>SPOC created successfully', 'default', array('class' => 'alert alert-success'));
					$this->redirect('/bdspoc/');
				}else{
					$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in saving the data...', 'default', array('class' => 'alert alert-error'));
				}
			}else{
				//$errors = $this->BdSpoc->validationErrors;
				//print_r($errors);
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in submitting the form. please check errors...', 'default', array('class' => 'alert alert-error'));	
			}
		}
	}
	
	/* function to delete the spoc */
	public function delete_spoc($id){
		if(!empty($id) && intval($id)){
			// authorize user before action
			$ret_value = $this->auth_action($id);
			if($ret_value == 'pass'){					
				$this->BdSpoc->id = $id;
				$this->BdSpoc->saveField('is_deleted', 'Y'); 
				$this->BdSpoc->saveField('modified_date', $this->Functions->get_current_date()); 
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>SPOC deleted successfully', 'default', array('class' => 'alert alert-success'));				
			}else if($ret_value == 'fail'){
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/bdspoc/');
			}else{
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Record Deleted: '.$ret_value , 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/bdspoc/');
			}
		}else{
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));			
		}
		$this->redirect('/bdspoc/');
	}
	
	/* function to auth record */
	public function auth_action($id){
		$data = $this->BdSpoc->findById($id, array('fields' => 'id','is_deleted','modified_date'));	
		// check the req belongs to the user
		if($data['BdSpoc']['is_deleted'] == 'Y'){
			return $data['BdSpoc']['modified_date'];
		}		
		else if(empty($data)){	
			return 'fail';
		}else{
			return 'pass';
		}
	}
	
	/* clear the cache */	
	public function beforeFilter(){ 
		//$this->disable_cache();
		$this->show_tabs(100);
	}
	
	/* auto complete search */	
	public function search(){ 
		$this->layout = false;	 
		$q = trim(Sanitize::escape($_GET['q']));	
		if(!empty($q)){
			// execute only when the search keywork has value		
			$this->set('keyword', $q);
			$data = $this->BdSpoc->find('all', array('fields' => array('HrEmployee.first_name'),
			'group' => array('first_name'), 'conditions' => 	array("OR" => array ('first_name like' => '%'.$q.'%'),
			'AND' => array('HrEmployee.status' => '1', 'HrEmployee.is_deleted' => 'N','BdSpoc.is_deleted' => 'N'))));		
			$this->set('results', $data);
		}
    }
	
	
	
}