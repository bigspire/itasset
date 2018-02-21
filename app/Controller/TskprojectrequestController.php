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
 
class TskprojectrequestController extends AppController {  
	
	public $name = 'TskProjectRequest';	
	
	public $helpers = array('Html', 'Form', 'Session');
	
	public $components = array('Session', 'Functions');
	
	public $layout = 'apps';	
	
	

	/* function to list the adv. requests */
	public function index(){	
		// set the page title
		$this->set('title_for_layout', 'Project Requests - Work Planner - My PDCA');
		// load team members
		$this->load_employee();
		// when the form is submitted for search
		if($this->request->is('post')){
			$url_vars = $this->Functions->create_url(array('keyword','emp_id'),'TskProjectRequest'); 
			$this->redirect('/tskprojectrequest/?'.$url_vars);			

	
		}
		if($this->params->query['keyword'] != ''){
			$keyCond = array("MATCH (project_name,TskCustomer.company_name, PROJ_LEAD.first_name) AGAINST ('".$this->params->query['keyword']."' IN BOOLEAN MODE)"); 
		}
		if($this->params->query['emp_id'] != ''){
			$empCond = array('TskProjectRequest.app_users_id' => $this->params->query['emp_id']); 
		}
		
		$options = array(			
			array('table' => 'app_users',
					'alias' => 'PROJ_LEAD',					
					'type' => 'LEFT',
					'conditions' => array('`PROJ_LEAD`.`id` = `TskProjectRequest`.`project_leader`')
			)
		);
		// fetch the advances		
		$this->paginate = array('fields' => array('id','project_name', 'purpose','TskCustomer.company_name','app_users_id', 'project_leader','status','created_date','approved_date','HrEmployee.first_name', 'HrEmployee.last_name','PROJ_LEAD.first_name','PROJ_LEAD.last_name'),
		'limit' => 10,'conditions' => array($keyCond, $empCond, 'TskProjectRequest.is_deleted' => 'N'), 'order' => array('created_date' => 'desc'), 'joins' => $options);
		$data = $this->paginate('TskProjectRequest');			
		$this->set('proj_data', $data);
		if(empty($data)){
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>You have no project requests for approve', 'default', array('class' => 'alert alert'));	
		}
		
		
	}
	
	
	/* function to load the employee */
	public function load_employee(){
		$this->TskProjectRequest->HrEmployee->virtualFields = array('first_name' => "UPPER(CONCAT_WS(' ', trim(HrEmployee.first_name), trim(HrEmployee.last_name)))");
		$empList = $this->TskProjectRequest->HrEmployee->find('list', array('fields' => array('id','first_name'),
		'order' => array('first_name ASC'),'conditions' => array('is_deleted' => 'N', 'status' => '1')));
		$this->set('empList', $empList);
	}
	
	
		/* function to process the advance */
	public function process_req($req_id, $status,$user_id){ 
		$ret_value = $this->auth_action($req_id);
		// make sure valid user
		if($ret_value == 'pass'){	
			$data = array('approved_date' => $this->Functions->get_current_date(),'approved_by' => $this->Session->read('USER.Login.id'), 'remarks' => $this->request->query['remark'], 'status' => $status);
			$this->TskProjectRequest->id = $req_id;
			$st_msg = $status == 'A' ? 'approved' : 'rejected';
			// save the finance adv. status
			if($this->TskProjectRequest->save($data, true, $fieldList = array('approved_by','approved_date','remarks','status'))){				
				// get user data
				$user_data = $this->TskProjectRequest->HrEmployee->find('first', array('conditions' => array('HrEmployee.id' => $user_id),'fields' => array('email_address','first_name', 'last_name')));
				// get req details
				$req_data = $this->TskProjectRequest->findById($req_id, array('fields' => 'project_name','purpose', 'project_leader','start_date', 'target_finish','tsk_company_id', 'TskCustomer.company_name','member'));
				// save in project table
				if($status == 'A'){
					$proj_status = $this->save_project_details($req_data['TskProjectRequest']);
					if(!$proj_status){
						$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Request updated successfully, but problem in creating project...', 'default', array('class' => 'alert alert-error'));		
						$this->redirect('/tskprojectrequest/');	
						die;
					}
				}
				$vars = array('name' => $user_data['HrEmployee']['first_name'].' '.$user_data['HrEmployee']['last_name'], 'project_name' => $req_data['TskProjectRequest']['project_name'], 'purpose' => $req_data['TskProjectRequest']['purpose'], 'start_date' => $req_data['TskProjectRequest']['start_date'],
				'remarks' => $this->request->query['remark'], 'status' => $st_msg, 'employee' => $user_data['HrEmployee']['first_name'].' '.$user_data['HrEmployee']['last_name'],'client' => $req_data['TskCustomer']['company_name']);
				// notify employee						
				if(!$this->send_email('My PDCA - Your project request is '.$st_msg.' by '.ucfirst($this->Session->read('USER.Login.first_name')).' '.ucfirst($this->Session->read('USER.Login.last_name')), 'notify_project_req', 'noreply@mypdca.in', $user_data['HrEmployee']['email_address'],$vars)){		
					// show the msg.								
					$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in sending the mail to user...', 'default', array('class' => 'alert alert-error'));				
				}else{								
				}		
				
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Project request is '.$st_msg.' successfully', 'default', array('class' => 'alert alert-success'));
			}else{
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Problem in updating the status', 'default', array('class' => 'alert alert-error'));		
			}
		}else{
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));		

		}
		$this->redirect('/tskprojectrequest/');	
	}
	
	/* function to save project details */
	public function save_project_details($data){
		$this->loadModel('TskProject');
		$proj_data = array('project_name' => $data['project_name'], 'tsk_company_id' => $data['tsk_company_id'], 'created_date' => $this->Functions->get_current_date(), 'start_date' => $data['start_date'],
		'target_finish' => $data['target_finish'], 'project_leader' => $data['project_leader'], 'created_by' => $this->Session->read('USER.Login.id'), 'proj_short_code' => strtoupper(substr($data['project_name'], 0, 4)));
		if($this->TskProject->save($proj_data, array('validate' => false))){
			$this->save_project_member($this->TskProject->id, $data['member']);
			return true;
		}else{
			return false;
		}
	}
	
	/* function to save approved project members */
	public function save_project_member($id, $members){ 
		$users = explode(',', $members);
		$this->loadModel('TskProjectMember');
		foreach($users as $member){
			$data = array('tsk_projects_id' => $id, 'created_date' => $this->Functions->get_current_date(), 'app_users_id' => $member);
			$this->TskProjectMember->id = '';
			$this->TskProjectMember->save($data);
		}
		
	}
		
	/* function to auth record */
	public function auth_action($id){
		$data = $this->TskProjectRequest->findById($id, array('fields' => 'id','is_deleted'));	
		// check the req belongs to the user
		if($data['TskProjectRequest']['is_deleted'] == 'Y'){
			return 'fail';
		}		
		else if(empty($data)){	
			return 'fail';
		}else{
			return 'pass';
		}
	}
	
	/* function to view the adv. request */
	public function view_project_req($id){
		// set the page title		
		$this->set('title_for_layout', 'Approve Project Request - Work Planner - My PDCA');
		if(!empty($id) && intval($id)){
			// authorize user before action
			$ret_value = $this->auth_action($id);
			if($ret_value == 'pass'){	
				$options = array(			
					array('table' => 'app_users',
							'alias' => 'PROJ_LEAD',					
							'type' => 'LEFT',
							'conditions' => array('`PROJ_LEAD`.`id` = `TskProjectRequest`.`project_leader`')
					)
				);
				$data = $this->TskProjectRequest->find('all', array('conditions' => array('TskProjectRequest.id' => $id), 'fields' => array('project_name','purpose','start_date','target_finish','status','TskCustomer.company_name','member','HrEmployee.first_name','HrEmployee.last_name','PROJ_LEAD.first_name','PROJ_LEAD.last_name','remarks'), 'joins' => $options));
				$this->set('proj_data', $data[0]);
				// get project members
				$this->get_project_member($data[0]['TskProjectRequest']['member']);
			}else if($ret_value == 'fail'){ 
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/tskprojectrequest/');	
			}else{
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Record Deleted: '.$ret_value , 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/tskprojectrequest/');	
			}
		}else{
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));		
			$this->redirect('/tskprojectrequest/');	
		}
		
		
	}
	
	/* function to get project members */
	public function get_project_member($id){
		$user = explode(',', $id);
		$count = count($user) - 1;
		$break = '<br>';
		foreach($user as $key => $member){
			// get the employee name
			$data = $this->TskProjectRequest->HrEmployee->findById($member, array('fields' => 'first_name', 'last_name'));
			if($count == $key){ $break = '';}
			$mem_list .= $data['HrEmployee']['first_name'].' '.$data['HrEmployee']['last_name'].$break;
		}
		$this->set('project_member', $mem_list);
	}
	
	/* clear the cache */
	
	public function beforeFilter() { 
		//$this->disable_cache();
		$this->show_tabs(82);
	}
	
	
		/* auto complete search */	
	public function search(){ 
		$this->layout = false;	 
		$q = trim(Sanitize::escape($_GET['q']));	

		if(!empty($q)){
			// execute only when the search keywork has value		
			$this->set('keyword', $q);
			$options = array(			
			array('table' => 'app_users',
					'alias' => 'PROJ_LEAD',					
					'type' => 'LEFT',
					'conditions' => array('`PROJ_LEAD`.`id` = `TskProjectRequest`.`project_leader`')
				)
			);
			$this->TskProjectRequest->virtualFields = array('full_name' => "concat(PROJ_LEAD.first_name, ' ', PROJ_LEAD.last_name)");

			$data = $this->TskProjectRequest->find('all', array('fields' => array('project_name','TskCustomer.company_name', 'full_name'),  'group' => array('project_name', 'TskCustomer.company_name','full_name'), 'conditions' => 	$conditions =  array("OR" => array ('project_name like' => '%'.$q.'%','TskCustomer.company_name like' => '%'.$q.'%', 'PROJ_LEAD.first_name like' => $q.'%' ), 'AND' => array('TskProjectRequest.is_deleted' => 'N')), 'joins' => $options));		
			$this->set('results', $data);
		}
    }
	
	
	
}