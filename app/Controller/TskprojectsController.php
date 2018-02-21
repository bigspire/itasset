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
 
class TskprojectsController extends AppController {  
	
	public $name = 'TskProjects';	
	
	public $helpers = array('Html', 'Form', 'Session');
	
	public $components = array('Session', 'Functions');
	
	public $layout = 'apps';	

	/* function to list the adv. requests */
	public function index(){	
		// set the page title
		$this->set('title_for_layout', 'Projects - Finance - My PDCA');
		// when the form is submitted for search
		if($this->request->is('post')){
			$this->redirect('/tskprojects/?keyword='.$this->request->data['TskProject']['SearchText']);			
		}
		if($this->params->query['keyword'] != ''){
			$keyCond = array("MATCH (project_name,TskCustomer.company_name) AGAINST ('".$this->params->query['keyword']."' IN BOOLEAN MODE)"); 
		}
		// fetch the advances		
		$this->paginate = array('fields' => array('id','project_name', 'TskCustomer.company_name', 'project_leader','status','created_date','Home.first_name', 'Home.last_name',''),'limit' => 10,'conditions' => array($keyCond, 'TskProject.is_deleted' => 'N'), 'order' => array('created_date' => 'desc'), 'group' => array('TskProject.id'));
		$data = $this->paginate('TskProject');			
		$this->set('proj_data', $data);
		if(empty($data)){
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>You havn\'t created any projects', 'default', array('class' => 'alert alert'));	
		}
		
		
	}
	
	/* function to save the customer */
	public function create_project(){ 
		// set the page title		
		$this->set('title_for_layout', 'Create Project - Finance - My PDCA');	
		// fetch the companies
		$comp_list = $this->TskProject->TskCustomer->find('list', array('fields' => array('id','company_name'), 'order' => array('company_name ASC'),'conditions' => array('is_deleted' => 'N')));
		$this->set('compList', $comp_list);	
		// fetch the list of states		
		$emp_list = $this->TskProject->Home->find('list', array('fields' => array('id','Home.full_name'), 'order' => array('Home.full_name ASC'),'conditions' => array('Home.status' => 1)));
		$this->set('empList', $emp_list);
		// fetch the company types
		$this->set_project_status();
		if ($this->request->is('post')){ 
			// validates the form
			$this->TskProject->set($this->request->data);
			if ($this->TskProject->validates(array('fieldList' => array('tsk_company_id','project_name', 'proj_short_code','start_date','status','project_leader','member')))) {
				$this->request->data['TskProject']['created_by'] = $this->Session->read('USER.Login.id');				
				$this->request->data['TskProject']['created_date'] = $this->Functions->get_current_date();
				// format the dates to save
				$this->request->data['TskProject']['start_date'] = $this->Functions->format_date_save($this->request->data['TskProject']['start_date']);
				
				if(!empty($this->request->data['TskProject']['target_finish'])){
					$this->request->data['TskProject']['target_finish'] = $this->Functions->format_date_save($this->request->data['TskProject']['target_finish']);
				}
				// save the data
				if($this->TskProject->save($this->request->data['TskProject'])) {	
					// save project members
					$this->save_members($this->TskProject->id);
					// show the msg.
					$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Project details created successfully', 'default', array('class' => 'alert alert-success'));
					$this->redirect('/tskprojects/');
				}else{
					$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in saving the data...', 'default', array('class' => 'alert alert-error'));
				}
			}else{
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in submitting the form. please check errors...', 'default', array('class' => 'alert alert-error'));	
			}
		}
	}
	
	/* function to save project users */
	public function save_members($id){
		if(count($this->request->data['TskProject']['member']) > 0){
			// save cc. users
			foreach($this->request->data['TskProject']['member'] as $user){
				$data = array('tsk_projects_id' => $id, 'app_users_id' => $user);
				$this->TskProject->TskProjectMember->id = '';
				$this->TskProject->TskProjectMember->save($data, true, $fieldList = array('tsk_projects_id','app_users_id'));	
			}
		}
	}
	
	
	/* function to set the project status */
	public function set_project_status(){
		$proj_status = array('PR' => 'Proposed', 'IP' => 'In Planning', 'IPG' => 'In Progress', 'OH' => 'On Hold', 'CO' => 'Complete', 'AR' => 'Archieved');
		$this->set('projStatus', $proj_status);
	}
	
	/* function to delete the adv. request */
	public function delete_project($project_id){
		if(!empty($project_id) && intval($project_id)){
			// authorize user before action
			$ret_value = $this->auth_action($project_id);
			if($ret_value == 'pass'){				
				$this->TskProject->id = $project_id;
				$this->TskProject->saveField('is_deleted', 'Y'); 
				$this->TskProject->saveField('modified_date', $this->Functions->get_current_date()); 
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Project deleted successfully', 'default', array('class' => 'alert alert-success'));				
			}else if($ret_value == 'fail'){
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/tskprojects/');
			}else{
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Record Deleted: '.$ret_value , 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/tskprojects/');
			}
		}else{
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));			
		}
		$this->redirect('/tskprojects/');
	}
	
	
	/* function to edit the advance */
	public function edit_project($id){	
		// set the page title		
		$this->set('title_for_layout', 'Edit Project - Finance - My PDCA');	
		// fetch the companies
		$comp_list = $this->TskProject->TskCustomer->find('list', array('fields' => array('id','company_name'), 'order' => array('company_name ASC'),'conditions' => array('is_deleted' => 'N')));
		$this->set('compList', $comp_list);		
		// fetch the list of states		
		$emp_list = $this->TskProject->Home->find('list', array('fields' => array('id','Home.full_name'), 'order' => array('Home.full_name ASC'),'conditions' => array('Home.status' => 1)));
		$this->set('empList', $emp_list);
		// fetch the company types
		$this->set_project_status();
		if (!empty($id) && intval($id)){
			// authorize user before action
			$ret_value = $this->auth_action($id);
			if($ret_value == 'pass'){	
				// when the form submitted
				if (!empty($this->request->data)){ 
					// validates the form
					$this->TskProject->set($this->request->data);
					if ($this->TskProject->validates(array('fieldList' => array('tsk_company_id','project_name', 'proj_short_code','start_date','status','project_leader','member')))) {
						$this->request->data['TskProject']['modified_by'] = $this->Session->read('USER.Login.id');				
						$this->request->data['TskProject']['modified_date'] = $this->Functions->get_current_date();
						// format the dates to save
						$this->request->data['TskProject']['start_date'] = $this->Functions->format_date_save($this->request->data['TskProject']['start_date']);
						if(!empty($this->request->data['TskProject']['target_finish']) && $this->request->data['TskProject']['target_finish'] != '00/00/0000'){
							$this->request->data['TskProject']['target_finish'] = $this->Functions->format_date_save($this->request->data['TskProject']['target_finish']);	
						}
							
						// save the data
						if($this->TskProject->save($this->request->data['TskProject'], array('validate' => false))) {
							// remove members
							$this->remove_members($id);
							// save project members
							$this->save_members($id);
							// show the msg.
							$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Project details modified successfully', 'default', array('class' => 'alert alert-success'));
						}else{
							// show the error msg.
							$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in saving the data...', 'default', array('class' => 'alert alert-error'));					
						}					
						$this->redirect('/tskprojects/');						
					}	
				}else{
					$this->request->data = $this->TskProject->findById($id);
					// format the dates to show
					$this->request->data['TskProject']['start_date'] = $this->Functions->format_date_show($this->request->data['TskProject']['start_date']);
					if(!empty($this->request->data['TskProject']['target_finish'])){
						$this->request->data['TskProject']['target_finish'] = $this->Functions->format_date_show($this->request->data['TskProject']['target_finish']);
					}
					// get project members
					$proj_user = $this->TskProject->TskProjectMember->find('all', array('fields' => array('app_users_id'), 'conditions' => array('tsk_projects_id' => $id)));
					foreach($proj_user as $user){						
						$member[] = $user['TskProjectMember']['app_users_id'];					
					}
					$this->set('members', $member);
					
				}
			}else if($ret_value == 'fail'){
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/tskprojects/');
			}else{
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Record Deleted: '.$ret_value , 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/tskprojects/');
			}
		}else{
			// show the error msg.
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));
			$this->redirect('/tskprojects/');		
		}		
		
	}
	
	/* function to remove the project members */
	public function remove_members($id){		
		$this->TskProject->TskProjectMember->deleteAll(array('tsk_projects_id' => $id), false);
	}
	
	/* function to auth record */
	public function auth_action($id){
		$data = $this->TskProject->findById($id, array('fields' => 'id','is_deleted','modified_date'));	
		// check the req belongs to the user
		if($data['TskProject']['is_deleted'] == 'Y'){
			return $data['TskProject']['modified_date'];
		}		
		else if(empty($data)){	
			return 'fail';
		}else{
			return 'pass';
		}
	}
	
	/* function to view the adv. request */
	public function view_project($id){
		// set the page title		
		$this->set('title_for_layout', 'View Project - Finance - My PDCA');
		if(!empty($id) && intval($id)){
			// authorize user before action
			$ret_value = $this->auth_action($id);
			if($ret_value == 'pass'){	
				$data = $this->TskProject->findById($id);
				$this->set('proj_data', $data);
				// get project members
				$this->get_project_member($id);
			}else if($ret_value == 'fail'){ 
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/tskprojects/');	
			}else{
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Record Deleted: '.$ret_value , 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/tskprojects/');	
			}
		}else{
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));		
			$this->redirect('/tskprojects/');	
		}
	}
	
	
	/* function to get project members */
	public function get_project_member($id){		
		$data = $this->TskProject->TskProjectMember->find('all', array('conditions' => array('tsk_projects_id' => $id), 
		'fields' => array('HrEmployee.first_name', 'HrEmployee.last_name')));
		$count = count($data) - 1;
		$break = '<br>';
		foreach($data as $key => $member){
			if($count == $key){ $break = '';}
			$mem_list .= $member['HrEmployee']['first_name'].' '.$member['HrEmployee']['last_name'].$break;
		}
		$this->set('project_member', $mem_list);
	}
	
	
	/* clear the cache */	
	public function beforeFilter() { 
		//$this->disable_cache();
		$this->show_tabs(9);
	}
	
	
		/* auto complete search */	
	public function search(){ 
		$this->layout = false;	 
		$q = trim(Sanitize::escape($_GET['q']));	
		if(!empty($q)){
			// execute only when the search keywork has value		
			$this->set('keyword', $q);
			$data = $this->TskProject->find('all', array('fields' => array('project_name','TskCustomer.company_name'),  'group' => array('project_name'), 'conditions' => 	$conditions =  array("OR" => array ('project_name like' => '%'.$q.'%','TskCustomer.company_name like' => '%'.$q.'%'), 'AND' => array('TskProject.is_deleted' => 'N'))));		
			$this->set('results', $data);
		}
    }
	
	
	
}