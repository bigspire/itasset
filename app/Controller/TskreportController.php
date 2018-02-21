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
 
class TskreportController extends AppController {  
	
	public $name = 'TskReport';	
	
	public $helpers = array('Html', 'Form', 'Session');
	
	public $components = array('Session', 'Functions','Excel');
	
	public $layout = 'apps';	

	/* function to list the adv. requests */
	public function individual(){	
		// set the page title
		$this->set('title_for_layout', 'Individual Reports - Work Planner - My PDCA');		
		
		// get employee list
		if($this->Session->read('USER.Login.app_roles_id') == '18' || $this->Session->read('USER.Login.app_roles_id') == '1'){
			$format_list = $this->TskReport->HrEmployee->find('list', array('fields' => array('HrEmployee.id', 'HrEmployee.full_name'), 'conditions' => array('HrEmployee.status' => '1'), 'order' => array('HrEmployee.full_name' => 'asc')));
		}else{	
			$emp_list = $this->TskReport->get_team($this->Session->read('USER.Login.id'),'T', '1');
			$format_list = $this->Functions->format_dropdown($emp_list, 'u','id','first_name', 'last_name');		
		}
		// parse sql string
		foreach($format_list as $key => $list){
			$ids .= $key.',';
		}
		$ids = substr($ids, 0, strlen($ids)-1);
		$this->set('empList', $format_list);
		// when the form posted
		if($this->request->is('post')){
			// get the branch of the employee
			$data = $this->TskReport->HrEmployee->findById($this->request->data['TskReport']['emp_id'], array('fields' => 'hr_branch_id', 'first_name','last_name'));
			$this->set('empName', $data['HrEmployee']['first_name'].' '.$data['HrEmployee']['last_name']);		
			$month = explode('/', $this->request->data['TskReport']['month_year']);
			$start = $month[1].'-'.$month[0].'-01';
			$end = $month[1].'-'.$month[0].'-31';
			$data = $this->TskReport->planned_hr($start, $end, $this->request->data['TskReport']['emp_id'], $ids); 
			$this->set('plannerHR', $data);
			$this->set('empMonth', date('M, Y', strtotime($start)));
		}
		
		// for export
		if($this->request->query['action'] == 'export'){
			$month = explode('/', $this->request->query['month_year']);
			$start = $month[1].'-'.$month[0].'-01';
			$end = $month[1].'-'.$month[0].'-31';
			$data = $this->TskReport->planned_hr($start, $end, $this->request->query['emp_id'],$ids); 
			$this->Excel->generate('individual_plan', $data, $data, 'Report', 'Individual Report - '.date('M, Y', strtotime($start)));
		}
		
		$this->render('index');
		
		
	}
	
	
	/* function to list the company task requests */
	
	public function company(){	
		// set the page title
		$this->set('title_for_layout', 'Company Reports - Work Planner - My PDCA');
		// get the list of branches 
		$dept_list = $this->TskReport->HrEmployee->HrDepartment->find('list', array('fields' => array('id','dept_name'), 'order' => array('dept_name ASC'),'conditions' => array('status' => 1, 'is_deleted' => 'N')));
		$this->set('deptList', $dept_list);
		// fetch the list of branches		
		$branch_list = $this->TskReport->HrEmployee->HrBranch->find('list', array('fields' => array('id','branch_name'), 'order' => array('branch_name ASC'),'conditions' => array('status' => 1,'is_deleted' => 'N')));
		$this->set('branchList', $branch_list);
		// load hr business unit
		$business_list = $this->TskReport->HrEmployee->HrBusinessUnit->find('list', array('fields' => array('id','business_unit'), 'order' => array('business_unit ASC'),'conditions' => array('status' => 1,'is_deleted' => 'N')));
		$this->set('businessList', $business_list);
		// when the form posted
		if($this->request->is('post')){			
			$month = explode('/', $this->request->data['TskReport']['month_year']);
			$start = $month[1].'-'.$month[0].'-01';
			$end = $month[1].'-'.$month[0].'-31';			
			$data = $this->TskReport->planned_hr_company($start, $end, $this->request->data['TskReport']['dept_id'], $this->request->data['TskReport']['bus_unit'], $this->request->data['TskReport']['location'],$this->request->data['TskReport']['selReport']); 
			$this->set('plannerHR', $data);
			$this->set('empMonth', date('M, Y', strtotime($start)));
		}
		
		// for export
		if($this->request->query['action'] == 'export'){
			$month = explode('/', $this->request->query['month_year']);
			$start = $month[1].'-'.$month[0].'-01';
			$end = $month[1].'-'.$month[0].'-31';
			$data = $this->TskReport->planned_hr_company($start, $end, $this->request->query['dept_id'],$this->request->query['bus_unit'],$this->request->query['location'],$this->request->query['sel']); 
			$this->Excel->generate('company_plan', $data, $data, 'Report', 'Company Report - '.date('M, Y', strtotime($start)));
		}
		
		$this->render('index');
		
		
	}

	
	public function beforeFilter() { 
		//$this->disable_cache();
		$mod_id = $this->request->params['action'] == 'individual' ? 87 : 88;
		$this->show_tabs($mod_id);
	}
	
	

	
	
}