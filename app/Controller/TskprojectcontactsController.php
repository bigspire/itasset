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
 * @link          http://cakephp.org CakePHP(tm) Project Contact
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
 
App::uses('Sanitize', 'Utility');
 
class TskprojectcontactsController extends AppController {  
	
	public $name = 'TskProjectContacts';	
	
	public $helpers = array('Html', 'Form', 'Session');
	
	public $components = array('Session', 'Functions');
	
	public $layout = 'apps';	

	/* function to list the adv. requests */
	public function index(){	
		// set the page title
		$this->set('title_for_layout', 'Project Contact Contacts - Finance - My PDCA');
		// when the form is submitted for search
		if($this->request->is('post')){
			$this->redirect('/tskprojectcontacts/?keyword='.$this->request->data['TskProjectContact']['SearchText']);			
		}
		if($this->params->query['keyword'] != ''){
			$keyCond = array("MATCH (project_name) AGAINST ('".$this->params->query['keyword']."' IN BOOLEAN MODE)"); 
		}		
		// fetch the advances		
		$this->paginate = array('fields' => array('id','TskProject.project_name','designation1', 'landline1','phone1','created_date','first_name1','last_name1'),'limit' => 10,'conditions' => array($keyCond, 'TskProjectContact.is_deleted' => 'N'), 'order' => array('created_date' => 'desc'));
		
		$data = $this->paginate('TskProjectContact');
			
		$this->set('proj_cont_data', $data);
		if(empty($data)){
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>You havn\'t created any project contacts', 'default', array('class' => 'alert alert'));	
		}
		
		
	}
	
	/* function to save the customer */
	public function create_project_contact(){ 
		// set the page title		
		$this->set('title_for_layout', 'Create Project Contact Contact - Finance - My PDCA');			
		// fetch the projects
		$proj_list = $this->TskProjectContact->TskProject->find('list', array('fields' => array('id','project_name'), 'order' => array('project_name ASC'),'conditions' => array('is_deleted' => 'N')));
			
		$this->set('projList', $proj_list);		
		if ($this->request->is('post')){ 
			// validates the form
			$this->TskProjectContact->set($this->request->data);
			if ($this->TskProjectContact->validates(array('fieldList' => array('first_name1', 'last_name1','phone1','email1','designation1','tsk_projects_id','landline1')))) {
				$this->request->data['TskProjectContact']['created_by'] = $this->Session->read('USER.Login.id');				
				$this->request->data['TskProjectContact']['created_date'] = $this->Functions->get_current_date();				
				// save the data
				if($this->TskProjectContact->save($this->request->data['TskProjectContact'])) {					
					// show the msg.
					$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Project contact details created successfully', 'default', array('class' => 'alert alert-success'));
					$this->redirect('/tskprojectcontacts/');
				}else{
					$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in saving the data...', 'default', array('class' => 'alert alert-error'));
				}
			}else{
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in submitting the form. please check errors...', 'default', array('class' => 'alert alert-error'));	
			}
		}
	}
	
	
	/* function to set the project status */
	public function set_project_status(){
		$proj_status = array('PR' => 'Proposed', 'IP' => 'In Planning', 'IPG' => 'In Progress', 'OH' => 'On Hold', 'CO' => 'Complete', 'AR' => 'Archieved');
		$this->set('projStatus', $proj_status);
	}
	
	/* function to delete the adv. request */
	public function delete_project_contact($proj_id){
		if(!empty($proj_id) && intval($proj_id)){
			// authorize user before action
			$ret_value = $this->auth_action($proj_id);
			if($ret_value == 'pass'){				
				$this->TskProjectContact->id = $proj_id;
				$this->TskProjectContact->saveField('is_deleted', 'Y'); 
				$this->TskProjectContact->saveField('modified_date', $this->Functions->get_current_date()); 
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Project contact details deleted successfully', 'default', array('class' => 'alert alert-success'));	
			}else if($ret_value == 'fail'){
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/tskprojectcontacts/');
			}else{
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Record Deleted: '.$ret_value , 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/tskprojectcontacts/');
			}
		}else{
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));			
		}
		$this->redirect('/tskprojectcontacts/');
	}
	
	
	/* function to edit the advance */
	public function edit_project_contact($id){	
		// set the page title		
		$this->set('title_for_layout', 'Edit Project Contact - Finance - My PDCA');				
		// fetch the projects
		$proj_list = $this->TskProjectContact->TskProject->find('list', array('fields' => array('id','project_name'), 'order' => array('project_name ASC'),'conditions' => array('is_deleted' => 'N')));
		$this->set('projList', $proj_list);
		
		if (!empty($id) && intval($id)){
			// authorize user before action
			$ret_value = $this->auth_action($id);
			if($ret_value == 'pass'){	
				// when the form submitted
				if (!empty($this->request->data)){ 
					// validates the form
					$this->TskProjectContact->set($this->request->data);
					if ($this->TskProjectContact->validates(array('fieldList' => array('first_name1', 'last_name1','phone1','email1','designation1','tsk_projects_id','landline1')))) {
						$this->request->data['TskProjectContact']['modified_by'] = $this->Session->read('USER.Login.id');				
						$this->request->data['TskProjectContact']['modified_date'] = $this->Functions->get_current_date();													
						$this->TskProjectContact->id = $id;	
						// save the data
						if($this->TskProjectContact->save($this->request->data['TskProjectContact'])) {					
							// show the msg.
							$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Project Contact details modified successfully', 'default', array('class' => 'alert alert-success'));
						}else{
							// show the error msg.
							$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in saving the data...', 'default', array('class' => 'alert alert-error'));					
						}					
					$this->redirect('/tskprojectcontacts/');						
					}	
				}else{
						$this->request->data = $this->TskProjectContact->findById($id);				
					
				}
			}else if($ret_value == 'fail'){
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/tskprojectcontacts/');
			}else{
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Record Deleted: '.$ret_value , 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/tskprojectcontacts/');
			}
		}else{
			// show the error msg.
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));
			$this->redirect('/tskprojectcontacts/');		
		}		
		
	}
	
	/* function to auth record */
	public function auth_action($id){
		$data = $this->TskProjectContact->findById($id, array('fields' => 'id','is_deleted','modified_date'));	
		// check the req belongs to the user
		if($data['TskProjectContact']['is_deleted'] == 'Y'){
			return $data['TskProjectContact']['modified_date'];
		}		
		else if(empty($data)){	
			return 'fail';
		}else{
			return 'pass';
		}
	}
	
	/* function to view the adv. request */
	public function view_customer($id){
		// set the page title		
		$this->set('title_for_layout', 'View Customer - Finance - My PDCA');
		if(!empty($id) && intval($id)){
			// authorize user before action
			$ret_value = $this->auth_action($id);
			if($ret_value == 'pass'){	
				$data = $this->TskProjectContact->findById($id);
				$this->set('cust_data', $data);
			}else if($ret_value == 'fail'){ 
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/tskprojectcontacts/');	
			}else{
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Record Deleted: '.$ret_value , 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/tskprojectcontacts/');	
			}
		}else{
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));		
			$this->redirect('/tskprojectcontacts/');	
		}
		
		
	}
	
	/* clear the cache */
	
	public function beforeFilter() { 
		//$this->disable_cache();
		$this->show_tabs(10);
	}
	
	
		/* auto complete search */	
	public function search(){ 
		$this->layout = false;	 
		$q = trim(Sanitize::escape($_GET['q']));	
		if(!empty($q)){
			// execute only when the search keywork has value		
			$this->set('keyword', $q);
			$data = $this->TskProjectContact->find('all', array('fields' => array('TskProject.project_name'),  'group' => array('project_name'), 'conditions' => 	$conditions =  array("OR" => array ('TskProject.project_name like' => '%'.$q.'%'), 'AND' => array('TskProjectContact.is_deleted' => 'N'))));		
			$this->set('results', $data);
		}
    }
	
	
	
}