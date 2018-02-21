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
class HrHomeController extends AppController {  
	
	public $name = 'HrHome';	
	
	public $helpers = array('Html', 'Form', 'Session');
	
	public $components = array('Session', 'Functions');
	
	public $layout = 'apps';	

	/* function to login the employer */
	public function index(){	
		// set the page title		
		$this->set('title_for_layout', 'Home - HRIS - My PDCA');	
		// fetch the recent user requests
		$this->loadModel('HrLeave');
		$data = $this->HrLeave->find('all', array('fields' => array('id','created_date', 'reason'), 'conditions' => array('HrLeave.app_users_id' => $this->Session->read('USER.Login.id'), 'HrLeave.is_deleted' => 'N','is_approve' => 'N', 'is_approve' != 'R'), 'order' => array('created_date' => 'desc'), 'group' => array('HrLeave.id'),  'limit' => 3));
		$this->set('leave_data', $data);	
		
		// fetch the recent users approval req.	
		$this->loadModel('HrLeaveApprove');	
		$data = $this->HrLeaveApprove->find('all', array('fields' => array('Home.id', 'id','created_date', 'reason','Home.photo','Home.photo_status','Home.gender', 'HrLeaveStatus.id','Home.first_name','Home.last_name'),'conditions' => array('HrLeaveStatus.app_users_id' =>$this->Session->read('USER.Login.id'),'HrLeaveApprove.is_deleted' => 'N', 'HrLeaveStatus.status' => 'W'), 'order' => array('created_date' => 'desc'), 'group' => array('HrLeaveApprove.id'), 'limit' => 3));	
		$this->set('approve_data', $data);
		
		
		// fetch the recent permission req.	
		$this->loadModel('HrPermission');
		$data = $this->HrPermission->find('all', array('fields' => array('id','created_date', 'reason'), 'conditions' => array('HrPermission.app_users_id' => $this->Session->read('USER.Login.id'), 'HrPermission.is_deleted' => 'N','is_approve' => 'N','is_approve' != 'R'), 'order' => array('created_date' => 'desc'), 'group' => array('HrPermission.id'),  'limit' => 3));
		$this->set('perm_data', $data);
		
		// fetch the recent users approval req.	
		$this->loadModel('HrPerApprove');	
		$data = $this->HrPerApprove->find('all', array('fields' => array('Home.id', 'id','created_date', 'reason','Home.photo','Home.photo_status','Home.gender', 'HrPerStatus.id','Home.first_name','Home.last_name'),'conditions' => array('HrPerStatus.app_users_id' =>$this->Session->read('USER.Login.id'),'HrPerApprove.is_deleted' => 'N', 'HrPerStatus.status' => 'W'), 'order' => array('created_date' => 'desc'), 'group' => array('HrPerApprove.id'), 'limit' => 3));	
		$this->set('per_approve_data', $data);
		
		// fetch the recent permission req.	
		$this->loadModel('HrGallery');
		$data = $this->HrGallery->find('all', array('fields' => array('id','created_date', 'HrGallery.title'), 'conditions' => array('HrGallery.app_users_id' => $this->Session->read('USER.Login.id'),'is_approve' => 'N'), 'order' => array('created_date' => 'desc'), 'group' => array('HrGallery.id'),  'limit' => 3));		
		$this->set('gal_data', $data);
		
		// fetch approve gallery only for HR
		if($this->Session->read('USER.Login.hr_department_id') == '14'){
				// fetch the recent users approval req.	
			$this->loadModel('HrGalApprove');	
			$data = $this->HrGalApprove->find('all', array('fields' => array('Home.id', 'id','created_date', 'HrGalApprove.title','Home.photo','Home.photo_status','Home.gender', 'HrGalStatus.id','Home.first_name','Home.last_name'),'conditions' => array('HrGalStatus.app_users_id' =>$this->Session->read('USER.Login.id'), 'HrGalStatus.status' => 'W'), 'order' => array('created_date' => 'desc'), 'group' => array('HrGalApprove.id'), 'limit' => 3));	
			$this->set('gal_approve_data', $data);
		}
		
			// fetch the recent activities
		$data = $this->HrHome->get_recent_activity($this->Session->read('USER.Login.id'));
		$this->set('activity_data', $data);
		
	}
	
	
	/* clear the cache */
	
	public function beforeFilter() { 
		$this->show_tabs();
	}
	
	
	
	
	
}