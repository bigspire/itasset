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
 * @link          http://cakephp.org CakePHP(tm) ROA Committee
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
 
App::uses('Sanitize', 'Utility');
 
class TskroacommitteeController extends AppController {  
	
	public $name = 'TskRoaCommittee';	
	
	public $helpers = array('Html', 'Form', 'Session');
	
	public $components = array('Session', 'Functions');
	
	public $layout = 'apps';	

	/* function to list the adv. requests */
	public function index(){	
		// set the page title
		$this->set('title_for_layout', 'ROA Committee - Work Planner - My PDCA');		
		// fetch the advances		
		$this->paginate = array('fields' => array('id','HrEmployee.first_name','HrEmployee.last_name', 'created_date'), 'order' => array('created_date' => 'desc'), 'group' => array('TskRoaCommittee.id'),
		'conditions' => array('HrEmployee.status' => '1', 'HrEmployee.is_deleted' => 'N'));
		$data = $this->paginate('TskRoaCommittee');			
		$this->set('committee_data', $data);
		if(empty($data)){
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>You havn\'t created any members', 'default', array('class' => 'alert alert'));	
		}
		
		
	}
	
	
	/* function to save roa users */
	public function save_members(){
		if(count($this->request->data['TskRoaCommittee']['member']) > 0){
			// save cc. users
			foreach($this->request->data['TskRoaCommittee']['member'] as $user){
				$data = array('created_date' => $this->Functions->get_current_date(), 'app_users_id' => $user);
				$this->TskRoaCommittee->id = '';
				$this->TskRoaCommittee->save($data, true, $fieldList = array('created_date','app_users_id'));	
			}
		}
	}
	
	

	
	/* function to edit the advance */
	public function edit_member($id){	
		// set the page title		
		$this->set('title_for_layout', 'Edit ROA Committee - Work Planner - My PDCA');				
		// fetch the list of states
		$this->TskRoaCommittee->HrEmployee->virtualFields = array('full_name' => "UPPER(CONCAT_WS(' ', trim(HrEmployee.first_name), trim(HrEmployee.last_name)))");
		$emp_list = $this->TskRoaCommittee->HrEmployee->find('list', array('fields' => array('id','HrEmployee.full_name'), 'order' => array('HrEmployee.full_name ASC'),'conditions' => array('HrEmployee.status' => 1, 'HrEmployee.is_deleted' => 'N')));
		$this->set('empList', $emp_list);		
		if (!empty($id) && intval($id)){
			// authorize user before action
			$ret_value = $this->auth_action($id);
			if($ret_value == 'pass'){	
				// when the form submitted
				if (!empty($this->request->data)){ 
					// validates the form
					$this->TskRoaCommittee->set($this->request->data);
					if ($this->TskRoaCommittee->validates(array('fieldList' => array('member')))) {
						$this->request->data['TskRoaCommittee']['created_date'] = $this->Functions->get_current_date();					
						// remove members
						$this->remove_members();
						// save project members
						$this->save_members();
						// show the msg.
						$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>ROA Committee members modified successfully', 'default', array('class' => 'alert alert-success'));
									
						$this->redirect('/tskroacommittee/');						
					}	
				}else{
					$result = $this->TskRoaCommittee->find('all', array('fields' => array('HrEmployee.id')));
					
					foreach($result as $data){						
						$member[] = $data['HrEmployee']['id'];					
					}
					$this->set('members', $member);
					
				}
			}else if($ret_value == 'fail'){
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/tskroacommittee/');
			}else{
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Record Deleted: ' , 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/tskroacommittee/');
			}
		}else{
			// show the error msg.
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));
			$this->redirect('/tskroacommittee/');		
		}		
		
	}
	
	/* function to remove the project members */
	public function remove_members($id){		
		$this->TskRoaCommittee->deleteAll(array('TskRoaCommittee.id !=' => NULL), false);
	}
	
	/* function to auth record */
	public function auth_action($id){
		$data = $this->TskRoaCommittee->findById($id, array('fields' => 'id'));	
		// check the req belongs to the user
		if(empty($data)){	
			return 'fail';
		}else{
			return 'pass';
		}
	}
	

	
	/* clear the cache */	
	public function beforeFilter() { 
		//$this->disable_cache();
		$this->show_tabs(92);
	}
	
	
	
}