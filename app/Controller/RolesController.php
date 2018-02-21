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
 
class RolesController extends AppController {  
	
	public $name = 'Roles';	
	
	public $helpers = array('Html', 'Form', 'Session');
	
	public $components = array('Session', 'Functions');
	
	public $layout = 'apps';
	
	public $mod;

	/* function to list the adv. requests */
	public function index(){	
		// set the page title
		$this->set('title_for_layout', 'Roles -  My PDCA');
		// when the form is submitted for search
		if($this->request->is('post')){
			$this->redirect('/roles/?mod='.$this->mod.'&keyword='.$this->request->data['Role']['SearchText']);			
		}
		if($this->params->query['keyword'] != ''){
			$keyCond = array("MATCH (role_name,role_desc) AGAINST ('".$this->params->query['keyword']."' IN BOOLEAN MODE)"); 
		}
		// fetch the advances		
		$this->paginate = array('fields' => array('id','role_name', 'status','created_date'),'limit' => 10,'conditions' => array($keyCond, 'Role.is_deleted' => 'N'), 'order' => array('created_date' => 'desc'));
		$data = $this->paginate('Role');			
		$this->set('role_data', $data);
		if(empty($data)){
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>You havn\'t created any role', 'default', array('class' => 'alert alert'));	
		}
		
		
	}
	
	/* function to save the customer */
	public function create_role(){ 
		// set the page title		
		$this->set('title_for_layout', 'Create Role -  My PDCA');		
		// load the modules
		$this->load_modules();	
		if ($this->request->is('post')){ 
			// validates the form
			$this->Role->set($this->request->data);
			if ($this->Role->validates(array('fieldList' => array('role_name','status','permission')))) {
				$this->request->data['Role']['created_by'] = $this->Session->read('USER.Login.id');				
				$this->request->data['Role']['created_date'] = $this->Functions->get_current_date();						
				// save the data
				if($this->Role->save($this->request->data['Role'])) {	
					// save the permissions
					$this->save_permission($this->Role->getLastInsertID());
					// show the msg.
					$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Role  created successfully', 'default', array('class' => 'alert alert-success'));
					$this->redirect('/roles/?mod='.$this->mod);
				}else{
					$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in saving the data...', 'default', array('class' => 'alert alert-error'));
				}
			}else{
				//print_r($this->Role->validationErrors);
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in submitting the form. please check errors...', 'default', array('class' => 'alert alert-error'));	
			}
		}
	}
	
	/* function to save the user permissions */
	public function save_permission($id){
		$this->loadModel('Permission');		
		$this->request->data['Role']['id'] = '';
		foreach($this->request->data['Role']['permission'] as $permission){
			$this->Permission->create();
			$this->request->data['Role']['app_modules_id'] = $permission;
			$this->request->data['Role']['app_roles_id'] = $id;
			$this->request->data['Role']['created_date'] = $this->Functions->get_current_date();	
			$this->request->data['Role']['created_by'] = $this->Session->read('USER.Login.id');			
			$this->Permission->save($this->request->data['Role']);
		}
	}
	
	
	/* function to load the permissions */
	public function load_modules(){			
		$this->loadModel('Module');
		$module_list = $this->Module->find('list', array('fields' => array('id', 'module_name'), 'conditions' => array('status' => '1', 'Module.type' => $this->get_type()), 'order' => array('priority' => 'asc')));	
		$this->set('moduleList', $module_list);		
		
	}

	
		
	
	/* function to delete the adv. request */
	public function delete_role($id){ 
		if(!empty($id) && intval($id)){
			// authorize user before action
			$ret_value = $this->auth_action($id);
			if($ret_value == 'pass'){				
				$this->Role->id = $id;
				$this->Role->saveField('is_deleted', 'Y'); 
				$this->Role->saveField('modified_date', $this->Functions->get_current_date()); 
				$this->Role->saveField('modified_by', $this->Session->read('USER.Login.id'));
				// remove the permissions
				$this->remove_user_permissions($id);
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Role deleted successfully', 'default', array('class' => 'alert alert-success'));	
				
			}else if($ret_value == 'fail'){
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/roles/?mod='.$this->mod);
			}else{
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Record Deleted: '.$ret_value , 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/roles/?mod='.$this->mod);
			}
		}else{
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));			
		}
		$this->redirect('/roles/?mod='.$this->mod);
	}
	
	
	/* function to edit the role */
	public function edit_role($id){	
		// set the page title		
		$this->set('title_for_layout', 'Edit Role -  My PDCA');	
		// load the modules
		$this->load_modules();		
		if (!empty($id) && intval($id)){
			// authorize user before action
			$ret_value = $this->auth_action($id);
			if($ret_value == 'pass'){	
				// when the form submitted
				if (!empty($this->request->data)){ 
					// validates the form
					$this->Role->set($this->request->data);
					if ($this->Role->validates(array('fieldList' => array('role_name','status')))) {
						$this->request->data['Role']['modified_by'] = $this->Session->read('USER.Login.id');				
						$this->request->data['Role']['modified_date'] = $this->Functions->get_current_date();					
						// save the data
						if($this->Role->save($this->request->data['Role'], array('validate' => false))) {		
							// remove the permissions
							$this->remove_user_permissions($id);
							// add user permissions
							$this->save_permission($id);
							// show the msg.
							$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Role details modified successfully', 'default', array('class' => 'alert alert-success'));
						}else{
							// show the error msg.
							$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in saving the data...', 'default', array('class' => 'alert alert-error'));					
						}					
					$this->redirect('/roles/?mod='.$this->mod);						
					}	
				}else{
					$this->request->data = $this->Role->findById($id);
					// get user permissions
					$this->loadModel('Permission');
					$permission_list = $this->Permission->find('list', array('fields' => array('app_modules_id'), 'conditions' => array('app_roles_id' => $id)));					
					$this->set('permissionList', $permission_list);	
				}
			}else if($ret_value == 'fail'){
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/roles/?mod='.$this->mod);
			}else{
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Record Deleted: '.$ret_value , 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/roles/?mod='.$this->mod);
			}
		}else{
			// show the error msg.
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));
			$this->redirect('/roles/?mod='.$this->mod);		
		}		
		
	}
	
	/* function to get module type */
	public function get_type(){
		if($this->mod == 'hr'){
			return 'H';			
		}else if($this->mod == 'fin'){
			return 'F';			
		}else if($this->mod == 'tsk'){
			return 'T';			
		}else if($this->mod == 'tvl'){
			return 'B';			
		}else if($this->mod == 'bd'){
			return 'BD';			
		}
	}
	
	/* function to remove the user permissions */
	public function remove_user_permissions($id){
		$this->loadModel('Permission');
		$this->Permission->deleteAll(array('app_roles_id' => $id, 'Module.type' => $this->get_type()), false);
	}
	
	/* function to auth record */
	public function auth_action($id){ 
		$data = $this->Role->findById($id, array('fields' => 'id','is_deleted','modified_date'));		
		// check the req belongs to the user
		if($data['Role']['is_deleted'] == 'Y'){
			return $data['Role']['modified_date'];
		}		
		else if(empty($data)){	
			return 'fail';
		}else{
			return 'pass';
		}
	}
	
	/* function to view the adv. request */
	public function view_role($id){
		// set the page title		
		$this->set('title_for_layout', 'View Role - My PDCA');
		if(!empty($id) && intval($id)){
			// authorize user before action
			$ret_value = $this->auth_action($id);
			if($ret_value == 'pass'){	
				$data = $this->Role->findById($id);
				$this->set('gr_data', $data);
			}else if($ret_value == 'fail'){ 
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/roles/?mod='.$this->mod);	
			}else{
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Record Deleted: '.$ret_value , 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/roles/?mod='.$this->mod);	
			}
		}else{
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));		
			$this->redirect('/roles/?mod='.$this->mod);	
		}
		
		
	}
	
	/* clear the cache */
	
	public function beforeFilter() { 
		//$this->disable_cache();
		$id = $this->get_mod_id();
		$this->show_tabs($id);
		
		
	}
	
	/* find the approver type */
	public function get_mod_id(){
		if($this->request->query['mod'] == 'hr'){			
			$mod_id =  '32';
			$this->mod =  'hr';				
		}elseif($this->request->query['mod'] == 'fin'){
			$mod_id =  '21';
			$this->mod =  'fin';			
		}elseif($this->request->query['mod'] == 'tsk'){
			$mod_id =  '54';
			$this->mod =  'tsk';			
		}elseif($this->request->query['mod'] == 'tvl'){
			$mod_id =  '74';
			$this->mod =  'tvl';			
		}elseif($this->request->query['mod'] == 'bd'){
			$mod_id =  '101';
			$this->mod =  'bd';			
		}
		$this->set('menu', $this->mod.'_menu');
		$this->set('mod', $this->mod);
		$this->set('role_var', '?mod='.$this->mod);
		$this->set('home_link', $this->mod.'home');
		return $mod_id;
	}
	
	
		/* auto complete search */	
	public function search(){ 
		$this->layout = false;	 
		$q = trim(Sanitize::escape($_GET['q']));	
		if(!empty($q)){
			// execute only when the search keywork has value		
			$this->set('keyword', $q);
			$data = $this->Role->find('all', array('fields' => array('role_name'),  'group' => array('role_name'), 'conditions' => 	$conditions =  array("OR" => array ('role_name like' => '%'.$q.'%'), 'AND' => array('is_deleted' => 'N'))));		
			$this->set('results', $data);
		}
    }
	
	
	
}