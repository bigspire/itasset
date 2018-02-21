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
 
class HrofficetimingController extends AppController {  
	
	public $name = 'HrOfficeTiming';	
	
	public $helpers = array('Html', 'Form', 'Session');
	
	public $components = array('Session', 'Functions');
	
	public $layout = 'apps';	

	/* function to list the adv. requests */
	public function index(){	
		// set the page title
		$this->set('title_for_layout', 'Employee Office Timing - HRIS - My PDCA');
		// when the form is submitted for search
		if($this->request->is('post')){
			$url_vars = $this->Functions->create_url(array('keyword'),'HrOfficeTiming'); 
			$this->redirect('/hrofficetiming/?'.$url_vars);					
		}
		if($this->params->query['keyword'] != ''){
			$keyCond = array("MATCH (HrEmployee.first_name) AGAINST ('".$this->params->query['keyword']."' IN BOOLEAN MODE)"); 
		}
		
		$options = array(	
			array('table' => 'hr_office_timing',
					'alias' => 'HrOfficeTiming',					
					'type' => 'LEFT',
					'conditions' => array('`HrOfficeTiming`.`app_users_id` = `HrEmployee`.`id`')
			)
		);
			
		
		$this->HrOfficeTiming->HrEmployee->unBindModel(array('belongsTo' => array('HrDepartment','HrDesignation','HrGrade','Role','HrCompany','HrBranch','HrBusinessUnit')));
		
		// fetch the advances		
		$this->paginate = array('fields' => array('id','HrOfficeTiming.id', 'HrOfficeTiming.start_time', 'HrOfficeTiming.end_time', 'HrOfficeTiming.grace_time', 'HrEmployee.first_name', 'HrEmployee.last_name','HrOfficeTiming.created_date'),'limit' => 50,  'conditions' => array($keyCond, 'HrEmployee.is_deleted' => 'N', 'HrEmployee.status' => '1'), 'order' => array('HrEmployee.first_name' => 'asc'), 'joins' => $options, 'group' => array('HrEmployee.id'));
		$data = $this->paginate('HrEmployee');			
		$this->set('timing_data', $data);
		if(empty($data)){
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>You havn\'t created any office timings', 'default', array('class' => 'alert alert'));	
		}
		
	}
	

		
	
	/* function to edit the form */
	public function edit_timing($id,$timing_id){
		$this->layout = 'iframe';
		// set the page title		
		$this->set('title_for_layout', 'Edit Employee Office Timing - HRIS - My PDCA');		
		// unbind unwanted models
		$this->HrOfficeTiming->HrEmployee->unBindModel(array('belongsTo' => array('HrDepartment','HrDesignation','HrGrade','Role','HrCompany','HrBranch','HrBusinessUnit')));
		// get employee
		$emp_data = $this->HrOfficeTiming->HrEmployee->findById($id, array('fields ' => 'full_name'));
		$this->set('emp_data', $emp_data);
		// set grace timings
		$this->set('grace_timings', array('0' => '0 mins', '5' => '5 mins.',  '10' => '10 mins.', '15' => '15 mins.', '20' => '20 mins.','30' => '30 mins.'));
		$this->set('rec_exists', $timing_id);
		
		// when the form submitted
		if (!empty($this->request->data)){ 
			// validates the form
			$this->HrOfficeTiming->set($this->request->data);				
			if ($this->HrOfficeTiming->validates(array('fieldList' => array('start_time', 'end_time', 'grace_time')))) {
					$this->request->data['HrOfficeTiming']['app_users_id'] = $id;
					
					$this->request->data['HrOfficeTiming']['start_time'] = $this->Functions->format_time_save($this->request->data['HrOfficeTiming']['start_time']);
					$this->request->data['HrOfficeTiming']['end_time'] = $this->Functions->format_time_save($this->request->data['HrOfficeTiming']['end_time']);
					
					// check edit or new
					if(empty($timing_id)){
						$this->HrOfficeTiming->id = '';
						$this->request->data['HrOfficeTiming']['created_date'] = $this->Functions->get_current_date();
						$this->request->data['HrOfficeTiming']['created_by'] = $this->Session->read('USER.Login.id');
					}else{
						$this->HrOfficeTiming->id = $timing_id;
						$this->request->data['HrOfficeTiming']['modified_by'] = $this->Session->read('USER.Login.id');	
						$this->request->data['HrOfficeTiming']['modified_date'] = $this->Functions->get_current_date();
					}
					// save the data
					if($this->HrOfficeTiming->save($this->request->data['HrOfficeTiming'])) {								
						// show the msg.
						$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Office timing updated successfully', 'default', array('class' => 'alert alert-success'));						
						$this->redirect('/hrofficetiming/edit_timing/'.$id.'/'.$this->HrOfficeTiming->id.'/?action=view');
						
					}			
				}	
			}else{
				$this->request->data = $this->HrOfficeTiming->findByAppUsersId($id);	
											
			}
	}
	
	
	/* clear the cache */
	
	public function beforeFilter() { 
		//$this->disable_cache();
		$this->show_tabs(52);
	}
	
	
		/* auto complete search */	
	public function search(){ 
		$this->layout = false;	 
		$q = trim(Sanitize::escape($_GET['q']));	
		if(!empty($q)){
			// execute only when the search keywork has value		
			$this->set('keyword', $q);
			$data = $this->HrOfficeTiming->HrEmployee->find('all', array('fields' => array('HrEmployee.full_name'),  'group' => array('HrEmployee.first_name', 'HrEmployee.last_name'), 'conditions' => array("OR" => array ('HrEmployee.full_name like' => '%'.$q.'%'), 'AND' => array('HrEmployee.is_deleted' => 'N'))));		
			$this->set('results', $data);
		}
    }
	
	
	
}