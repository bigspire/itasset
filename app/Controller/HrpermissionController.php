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
class HrpermissionController extends AppController {  
	
	public $name = 'HrPermission';	
	
	public $helpers = array('Html', 'Form', 'Session');
	
	public $components = array('Session', 'Functions');
	
	public $layout = 'apps';	

	/* function to list the adv. requests */
	public function index(){	
		// set the page title
		$this->set('title_for_layout', 'Permission - HRIS - My PDCA');	
		
		// when the form is submitted for search
		if($this->request->is('post')){
			$url_vars = $this->Functions->create_url(array('keyword', 'from', 'to'),'HrPermission'); 
			$this->redirect('/hrpermission/?'.$url_vars);			
		}
		if($this->params->query['keyword'] != ''){
			$keyCond = array("MATCH (reason) AGAINST ('".$this->params->query['keyword']."' IN BOOLEAN MODE)"); 
		}
		// for date search
		if($this->params->query['from'] != '' || $this->params->query['to'] != ''){
			$from = $this->Functions->format_date_save($this->params->query['from']);
			$to = $this->Functions->format_date_save($this->params->query['to']);
			
			$dateCond = array('or' => array('per_date between ? and ?' => array($from, $to),'per_date between ? and ?' => array($from, $to))); 
		}
		
		$options = array(			
			array('table' => 'hr_permission_status',
					'alias' => 'HrPerStatuses',					
					'type' => 'LEFT',
					'conditions' => array('`HrPerStatuses`.`hr_permission_id` = `HrPermission`.`id`')
			),
			array('table' => 'app_users',
					'alias' => 'Homes',					
					'type' => 'LEFT',
					'conditions' => array('`HrPerStatuses`.`app_users_id` = `Homes`.`id`')
			)
		);
			
							
		$this->HrPermission->unBindModel(array('hasOne' => array('HrPerStatus')));
		$this->HrPermission->unBindModel(array('belongsTo' => array('Home')));

		// fetch the advances		
		$this->paginate = array('fields' => array('id','per_from','per_date', 'per_to','reason', 'no_hrs', 'created_date','group_concat(HrPerStatuses.status) as st_status', 'group_concat(Homes.first_name) as st_user', 'group_concat(HrPerStatuses.modified_date) as st_modified','group_concat(HrPerStatuses.created_date) as st_created', 'group_concat(HrPerStatuses.remarks) as st_remarks'),'limit' => 10,'conditions' => array($keyCond,$dateCond, 'HrPermission.app_users_id' => $this->Session->read('USER.Login.id'),'HrPermission.is_deleted' => 'N'), 'order' => array('created_date' => 'desc'), 'group' => array('HrPermission.id'), 'joins' => $options);
		$data = $this->paginate('HrPermission');
		
		$this->set('per_data', $data);
		if(empty($data)){
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>You have no permission request found', 'default', array('class' => 'alert alert'));	
		}

		// for post dated permissions
		if($this->request->query['action'] == 'pertaken'){
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Sorry, you cannot create post dated permissions unless you have informed to any about the permission', 'default', array('class' => 'alert alert-info'));
			$this->redirect('/hrpermission/');	
		}	
		// get permissions remaining
		$this->get_used_perms(date('Y-m'));
		
		
	}
	
	

	
	
	

	
	/* function to save the advance */
	public function create_permission(){ 
		// set the page title		
		$this->set('title_for_layout', 'Request Permission - HRIS - My PDCA');	
		
		if ($this->request->is('post')){ 
			// validates the form
			$this->HrPermission->set($this->request->data);
			$this->resetHalf();
			if ($this->HrPermission->validates(array('fieldList' => array('per_from', 'per_to','per_date','reason')))) {
				
				$this->request->data['HrPermission']['app_users_id'] = $this->Session->read('USER.Login.id');
				// format the dates to save					
				$this->request->data['HrPermission']['per_from'] = $this->Functions->format_time_save($this->request->data['HrPermission']['per_from']);
				$this->request->data['HrPermission']['per_to'] = $this->Functions->format_time_save($this->request->data['HrPermission']['per_to']);
				$this->request->data['HrPermission']['per_date'] = $this->Functions->format_date_save($this->request->data['HrPermission']['per_date']);
				$this->request->data['HrPermission']['created_date'] = $this->Functions->get_current_date();
				// save the data
				if($this->HrPermission->save($this->request->data['HrPermission'], array('validate' => false))) {
					// get the superiors
					$this->loadModel('Approval');
					$approval_data = $this->Approval->find('first', array('fields' => array('level1'), 'conditions'=> array('Approval.app_users_id' => $this->Session->read('USER.Login.id'), 'type' => 'L')));
					// save finance req. status data
					$this->loadModel('HrPerStatus');
					$data = array('hr_permission_id' => $this->HrPermission->id, 'created_date' => $this->Functions->get_current_date(), 'app_users_id' => $approval_data['Approval']['level1']);
					if(!empty($approval_data)){
						// make sure not duplicate status exists
						$this->check_duplicate_status($this->HrPermission->id, $approval_data['Approval']['level1']);
						// save in adv. status table
						if($this->HrPerStatus->save($data, true, $fieldList = array('hr_permission_id','created_date','app_users_id'))){						
							// save adv. users
							$this->loadModel('HrPerUser');
							$permissions = array('hr_permission_id' => $this->HrPermission->id, 'app_users_id' => $approval_data['Approval']['level1']);							
							$this->HrPerUser->id = '';
							$this->HrPerUser->save($permissions, true, $fieldList = array('hr_permission_id','app_users_id'));					
					
							// get approver email id
							$this->loadModel('Home');
							$superior_data = $this->Home->find('first', array('conditions' => array('Home.id' => $approval_data['Approval']['level1']),'fields' => array('Home.id','email_address','first_name', 'last_name')));
							
							// send mail to finance team
							$approval_data = $this->HrPermission->Home->find('all', array('fields' => array('email_address', 'first_name', 'last_name'), 'group' => array('Home.id'), 'conditions'=> array('Home.id','Home.hr_department_id' => '14', 'Home.status' => '1')));
							foreach($approval_data as $hr_data){
								if($superior_data['Home']['id'] != $hr_data['Home']['id']  && $hr_data['Home']['id'] != $this->Session->read('USER.Login.id')){
									$vars = array('from_name' => ucfirst($this->Session->read('USER.Login.first_name')).' '.ucfirst($this->Session->read('USER.Login.last_name')),'name' => $hr_data['Home']['first_name'].' '.$hr_data['Home']['last_name'], 'reason' => $this->request->data['HrPermission']['reason'], 'per_from' => $this->request->data['HrPermission']['per_from'], 'per_to' => $this->request->data['HrPermission']['per_to'], 'nohrs' => $this->request->data['HrPermission']['no_hrs_lbl'],'per_date' => $this->request->data['HrPermission']['per_date']);
									// notify superiors						
									if(!$this->send_email('My PDCA - '.ucfirst($this->Session->read('USER.Login.first_name')).' '.ucfirst($this->Session->read('USER.Login.last_name')).' created permission request (No Action Required)!', 'permission_creation', 'noreply@mypdca.in', $hr_data['Home']['email_address'],$vars)){	
										// show the msg.								
										$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in sending the mail...', 'default', array('class' => 'alert alert-error'));				
									}else{
													
									}
								}
							}					
							
							// show the msg.
							$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Your permission request is created successfully', 'default', array('class' => 'alert alert-success'));
						}else{
							$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in saving approver status', 'default', array('class' => 'alert alert-info'));
						}
					}else if(empty($approval_data) && $this->Session->read('USER.Login.app_roles_id') == '18'){
						
							$this->HrPermission->id = $this->HrPermission->id;
							$this->HrPermission->saveField('is_approve', 'Y');
							$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Permission created and approved successfully', 'default', array('class' => 'alert alert-success'));

					}else{
						$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>You have no superior to approve your request', 'default', array('class' => 'alert alert-info'));
					}	
					
					$this->redirect('/hrpermission/');	
					
				}else{
					// show the error msg.
					$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in saving the data...', 'default', array('class' => 'alert alert-error'));					
				}
				
				
			}else{
				//echo 'validation error';
			}
		}
	}
	
	/* function to reset the half day session */
	public function resetHalf(){	
		if(empty($this->request->data['HrPermission']['is_half'])){
			unset($this->request->data['HrPermission']['session']);
		}
	}

	
	/* function to check for duplicate entry */
	public function check_duplicate_status($leave_id, $app_user_id){
		$count = $this->HrPermission->HrPerStatus->find('count',  array('conditions' => array('HrPerStatus.hr_permission_id' => $leave_id, 'HrPerStatus.app_users_id' => $app_user_id)));
		if($count > 0){
			$this->invalid_attempt();
		}
		
	}
	
	
	
		
	/* function to auth record */
	public function auth_action($id){
		$data = $this->HrPermission->findById($id, array('fields' => 'app_users_id','is_deleted','modified_date'));	
		// check the req belongs to the user
		if($data['HrPermission']['is_deleted'] == 'Y'){
			return $data['HrPermission']['modified_date'];
		}		
		else if($data['HrPermission']['app_users_id'] == $this->Session->read('USER.Login.id')){	
			return 'pass';
		}else{
			return 'fail';
		}
	}
	
	/* function to view the  permission */
	public function view_permission($id){
		// set the page title		
		$this->set('title_for_layout', 'View Permission - HRIS - My PDCA');
		if(!empty($id) && intval($id)){
			// authorize user before action
			$ret_value = $this->auth_action($id);
			if($ret_value == 'pass'){	
				$data = $this->HrPermission->findById($id);
				$this->set('perm_data', $data);
			}else if($ret_value == 'fail'){ 
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/hrpermission/');	
			}else{
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Record Deleted: '.$ret_value , 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/hrpermission/');	
			}
		}else{
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));		
			$this->redirect('/hrpermission/');	
		}
		
		
	}
	
	/* clear the cache */
	
	public function beforeFilter() { 
		//$this->disable_cache();
		$this->show_tabs(25);
	}
	
		
		/* auto complete search 
	public function search(){ 
		$this->layout = false;	 
		$q = trim(Sanitize::escape($_GET['q']));	
		if(!empty($q)){
			// execute only when the search keywork has value		
			$this->set('keyword', $q);
			$data = $this->HrPermission->find('all', array('fields' => array('purpose'),  'group' => array('purpose','description'), 'conditions' => 	$conditions =  array("OR" => array ('purpose like' => '%'.$q.'%', 'description like' => '%'.$q.'%'), 'AND' => array('is_deleted' => 'N'))));		
			$this->set('results', $data);
		}
    }
	*/	
	
	
	
}