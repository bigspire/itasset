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
class TskhomeController extends AppController {  
	
	public $name = 'TskHome';	
	
	public $helpers = array('Html', 'Form', 'Session');
	
	public $components = array('Session', 'Functions');
	
	public $layout = 'apps';	

	/* function to login the employer */
	public function index(){	
		// set the page title
		$this->set('title_for_layout', 'Home - Work Planner - My PDCA');	
		// fetch the recent user tasks
		$this->loadModel('TskPlan');
		$data = $this->TskPlan->find('all', array('fields' => array('created_date','start','title','type'), 'conditions' => 
		array('TskPlan.app_users_id' => $this->Session->read('USER.Login.id'), 'TskPlan.is_deleted' => 'N'), 
		'order' => array('created_date' => 'desc'), 'group' => array('TskPlan.id'),  'limit' => 3));		

		$this->set('tsk_data', $data);
		
		// fetch the recent users assign task	
		$this->loadModel('TskAssign');	
		$data = $this->TskAssign->find('all', array('fields' => array('id','created_date','title','start','type'), 'conditions' => 
		array('TskAssignUser.app_users_id' => $this->Session->read('USER.Login.id'), 'TskAssign.is_deleted' => 'N'), 
		'order' => array('created_date' => 'desc'), 'group' => array('TskAssign.id'),  'limit' => 3));		
		$this->set('tsk_assign', $data);
		
		// get team task plans
		$this->loadModel('TskTeamPlan');	
		$data = $this->TskTeamPlan->find('all', array('fields' => array('id','created_date', 'HrEmployee.photo','title','start','HrEmployee.photo_status',
		'HrEmployee.first_name','HrEmployee.gender','HrEmployee.last_name','HrEmployee.id','TskPlanRead.id','type'), 'conditions' => 
		array('TskPlanRead.app_users_id' => $this->Session->read('USER.Login.id'), 'TskTeamPlan.is_deleted' => 'N'), 
		'order' => array('created_date' => 'desc'), 'group' => array('TskTeamPlan.id'),  'limit' => 3));		
		$this->set('tsk_team_data', $data);
		
		// get team task plans
		$this->loadModel('TskTeamAssign');
		$options = array(		
				array('table' => 'tsk_assign_users',
					'alias' => 'TskAssignUser',					
					'type' => 'LEFT',
					'conditions' => array('`TskAssignUser`.`tsk_assign_id` = `TskTeamAssign``.`id`')
				),
				array('table' => 'app_users',
					'alias' => 'TskEmpAssign',					
					'type' => 'LEFT',
					'conditions' => array('`TskAssignUser`.`app_users_id` = `TskEmpAssign``.`id`')
				)
			);
		$data = $this->TskTeamAssign->find('all', array('fields' => array('id','created_date', 'title', 'start','TskEmpAssign.photo','TskEmpAssign.photo_status',
		'TskEmpAssign.first_name','TskEmpAssign.gender','TskEmpAssign.last_name','HrEmployee.id','TskTeamAssign.id','type'), 'conditions' => 
		array('TskTeamAssign.app_users_id' => $this->Session->read('USER.Login.id'), 'TskTeamAssign.is_deleted' => 'N'), 
		'order' => array('created_date' => 'desc'), 'group' => array('TskTeamAssign.id'),  'limit' => 3, 'joins' => $options));			
		$this->set('tsk_team_assign', $data);
		
		// get recent events
		$this->loadModel('TskEvent');
		$data = $this->TskEvent->find('all', array('fields' => array('id','title','start', 'status','event_type_id'),'limit' => 10,
		'conditions' => array('app_users_id' => $this->Session->read('USER.Login.id'), 'TskEvent.is_deleted' =>  'N', 'start >= ' =>  date('Y-m-d H:m')), 'order' => array('start' => 'asc')));		
		$this->set('event_data', $data);		
		
		// get recent events
		$this->loadModel('TskFile');
		$data = $this->TskFile->find('all', array('fields' => array('id','title','HrEmployee.first_name','created_date'),'limit' => 10,
		 'order' => array('created_date' => 'desc'), 'group' => array('TskFile.id'), 'conditions' => array($keyCond, 'TskFile.is_deleted' => 'N', array('or' => array('TskFile.app_users_id' => 
		$this->Session->read('USER.Login.id'), 'or' => array(array('and' => array('TskFileUser.app_users_id' => $this->Session->read('USER.Login.id') ,
		'TskFile.status' => '1'))))))));
		$this->set('file_data', $data);
		
		// fetch the recent activities
		//$data = $this->TskHome->get_recent_activity($this->Session->read('USER.Login.id'));
		//$this->set('activity_data', $data);
		
		
	}
	
	/* clear the cache */
	
	public function beforeFilter() { 
		$this->show_tabs();
	}
	
	
	
	
}