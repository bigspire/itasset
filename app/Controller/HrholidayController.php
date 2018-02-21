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
 
class HrholidayController extends AppController {  
	
	public $name = 'HrHoliday';	
	
	public $helpers = array('Html', 'Form', 'Session');
	
	public $components = array('Session', 'Functions');
	
	public $layout = 'apps';	

	/* function to list the adv. requests */
	public function index(){	
		// set the page title
		$this->set('title_for_layout', 'Holidays - HRIS - My PDCA');
		$this->load_branch();
		// when the form is submitted for search
		if($this->request->is('post')){
			$url_vars = $this->Functions->create_url(array('keyword','branch'),'HrHoliday'); 
			$this->redirect('/hrholiday/?'.$url_vars);					
		}
		if($this->params->query['keyword'] != ''){
			$keyCond = array("MATCH (event,HrHoliday.desc) AGAINST ('".$this->params->query['keyword']."' IN BOOLEAN MODE)"); 
		}
		if($this->params->query['branch'] != ''){
			$branchCond = array('hr_branch_id' => $this->params->query['branch']); 
		}
		// fetch the advances		
		$this->paginate = array('fields' => array('id','event', 'event_date', 'HrBranch.branch_name','desc', 'status','created_date'),'limit' => 10,'conditions' => array($keyCond, $branchCond,'HrHoliday.is_deleted' => 'N'), 'order' => array('created_date' => 'desc'));
		$data = $this->paginate('HrHoliday');			
		$this->set('holiday_data', $data);
		if(empty($data)){
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>You havn\'t created any holiday', 'default', array('class' => 'alert alert'));	
		}
	}
	
	/* load branch details */
	public function load_branch(){
		// load bank details
		$branch_list = $this->HrHoliday->HrBranch->find('list', array('fields' => array('id','branch_name'), 'order' => array('branch_name ASC'),'conditions' => array('status' => 1, 'is_deleted' => 'N')));
		$this->set('branchList', $branch_list);
	}
	
	/* function to save the customer */
	public function create_holiday(){ 
		// set the page title		
		$this->set('title_for_layout', 'Create Holidays - HRIS - My PDCA');	
		$this->load_branch();
		if ($this->request->is('post')){ 
			// validates the form
			$this->HrHoliday->set($this->request->data);		
			// validate file		
			if ($this->HrHoliday->validates(array('fieldList' => array('event', 'event_date', 'hr_branch_id')))) {
				$this->request->data['HrHoliday']['event_date'] = $this->Functions->format_date_save($this->request->data['HrHoliday']['event_date']);
				$this->request->data['HrHoliday']['created_by'] = $this->Session->read('USER.Login.id');				
				$this->request->data['HrHoliday']['created_date'] = $this->Functions->get_current_date();
				// iterate the branch array
				foreach($this->request->data['HrHoliday']['hr_branch_id'] as $branch_id){
					$this->HrHoliday->create();
					$this->request->data['HrHoliday']['hr_branch_id'] = $branch_id;
					// save the data
					if($this->HrHoliday->save($this->request->data['HrHoliday'], array('validate' => false))) {				
						// show the msg.
						$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Holiday created successfully', 'default', array('class' => 'alert alert-success'));						
					}else{
						$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in saving the data...', 'default', array('class' => 'alert alert-error'));
					}
				}				
				$this->redirect('/hrholiday/');
				
			}else{
				//$errors = $this->HrHoliday->validationErrors;
				//print_r($errors);
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in submitting the form. please check errors...', 'default', array('class' => 'alert alert-error'));	
			}
		}
	}
	
	
		
	
	/* function to delete the adv. request */
	public function delete_holiday($gr_id){
		if(!empty($gr_id) && intval($gr_id)){
			// authorize user before action
			$ret_value = $this->auth_action($gr_id);
			if($ret_value == 'pass'){		
				$this->HrHoliday->id = $gr_id;
				$this->HrHoliday->saveField('is_deleted', 'Y'); 
				$this->HrHoliday->saveField('modified_date', $this->Functions->get_current_date()); 
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Holiday deleted successfully', 'default', array('class' => 'alert alert-success'));			
			}else if($ret_value == 'fail'){
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/hrholiday/');
			}else{
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Record Deleted: '.$ret_value , 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/hrholiday/');
			}
		}else{
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));			
		}
		$this->redirect('/hrholiday/');
	}
	
	
	/* function to edit the form */
	public function edit_holiday($id){	
		// set the page title		
		$this->set('title_for_layout', 'Edit Holiday - HRIS - My PDCA');	
		$this->load_branch();	
		if (!empty($id) && intval($id)){
			// authorize user before action
			$ret_value = $this->auth_action($id);
			if($ret_value == 'pass'){	
				// when the form submitted
				if (!empty($this->request->data)){ 
					// validates the form
					$this->HrHoliday->set($this->request->data);				
					if ($this->HrHoliday->validates(array('fieldList' => array('event', 'event_date', 'hr_branch_id')))) {
						$this->request->data['HrHoliday']['modified_by'] = $this->Session->read('USER.Login.id');		
						$this->request->data['HrHoliday']['modified_date'] = $this->Functions->get_current_date();	
						$this->request->data['HrHoliday']['event_date'] = 	$this->Functions->format_date_save($this->request->data['HrHoliday']['event_date']);	
						// save the data
						if($this->HrHoliday->save($this->request->data['HrHoliday'])) {								
							// show the msg.
							$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Holiday details modified successfully', 'default', array('class' => 'alert alert-success'));
							$this->redirect('/hrholiday/');		
						}else{
							// show the error msg.
							$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in saving the data...', 'default', array('class' => 'alert alert-error'));									
						}					
									
					}	
				}else{
					$this->request->data = $this->HrHoliday->findById($id);	
					$this->request->data['HrHoliday']['event_date'] = 	$this->Functions->format_date_show($this->request->data['HrHoliday']['event_date']);
				}
			}else if($ret_value == 'fail'){
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/hrholiday/');
			}else{
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Record Deleted: '.$ret_value , 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/hrholiday/');
			}
		}else{
			// show the error msg.
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));
			$this->redirect('/hrholiday/');		
		}		
		
	}
	
	/* function to auth record */
	public function auth_action($id){
		$data = $this->HrHoliday->findById($id, array('fields' => 'id','is_deleted','modified_date'));	
		// check the req belongs to the user
		if($data['HrHoliday']['is_deleted'] == 'Y'){
			return $data['HrHoliday']['modified_date'];
		}		
		else if(empty($data)){	
			return 'fail';
		}else{
			return 'pass';
		}
	}
	
	
	/* function to view the adv. request */
	public function view_holiday($id){
		// set the page title		
		$this->set('title_for_layout', 'View Holidays - HRIS - My PDCA');
		if(!empty($id) && intval($id)){
			// authorize user before action
			$ret_value = $this->auth_action($id);
			if($ret_value == 'pass'){	
				$data = $this->HrHoliday->findById($id);
				$this->set('holiday_data', $data);
			}else if($ret_value == 'fail'){ 
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/hrholiday/');	
			}else{
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Record Deleted: '.$ret_value , 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/hrholiday/');	
			}
		}else{
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));		
			$this->redirect('/hrholiday/');	
		}
		
		
	}
	
	/* clear the cache */
	
	public function beforeFilter() { 
		//$this->disable_cache();
		$this->show_tabs(37);
	}
	
	
		/* auto complete search */	
	public function search(){ 
		$this->layout = false;	 
		$q = trim(Sanitize::escape($_GET['q']));	
		if(!empty($q)){
			// execute only when the search keywork has value		
			$this->set('keyword', $q);
			$data = $this->HrHoliday->find('all', array('fields' => array('event'),  'group' => array('event'), 'conditions' => array("OR" => array ('event like' => '%'.$q.'%'), 'AND' => array('HrHoliday.is_deleted' => 'N'))));		
			$this->set('results', $data);
		}
    }
	
	
	
}