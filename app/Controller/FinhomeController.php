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
class FinhomeController extends AppController {  
	
	public $name = 'FinHome';	
	
	public $helpers = array('Html', 'Form', 'Session');
	
	public $components = array('Session', 'Functions');
	
	public $layout = 'apps';	

	/* function to login the employer */
	public function index(){	
		// set the page title
		$this->set('title_for_layout', 'Home - Finance - My PDCA');	
		// fetch the recent user requests
		$this->loadModel('FinAdvance');
		$data = $this->FinAdvance->find('all', array('fields' => array('id','created_date', 'purpose'), 'conditions' => array('FinAdvance.app_users_id' => $this->Session->read('USER.Login.id'), 'FinAdvance.is_deleted' => 'N','FinAdvance.is_approve' => 'N', 'FinAdvance.is_approve' != 'R'), 'order' => array('created_date' => 'desc'), 'group' => array('FinAdvance.id'),  'limit' => 3));
		$this->set('adv_data', $data);	
		// fetch the recent users approval req.	
		$this->loadModel('FinAdvApprove');	
		$data = $this->FinAdvApprove->find('all', array('fields' => array('Home.id', 'id','created_date', 'purpose','Home.photo', 'Home.photo_status', 'Home.gender', 'FinAdvStatus.id','Home.first_name','Home.last_name'),'conditions' => array('FinAdvStatus.app_users_id' =>$this->Session->read('USER.Login.id'),'FinAdvApprove.is_deleted' => 'N', 'FinAdvStatus.status' => 'W', 'is_approve' => 'N'), 'order' => array('created_date' => 'desc'), 'group' => array('FinAdvApprove.id'), 'limit' => 3));	
		$this->set('approve_data', $data);
		
		// fetch the recent expense requests
		$this->loadModel('FinExpense');
		$data = $this->FinExpense->find('all', array('fields' => array('id','created_date', 'TskCustomer.company_name','TskProject.project_name'), 'conditions' => array('FinExpense.app_users_id' => $this->Session->read('USER.Login.id'), 'FinExpense.is_deleted' => 'N', 'is_draft' => 'N','FinExpense.is_approve' => 'N'), 'order' => array('created_date' => 'desc'), 'group' => array('FinExpense.id'),  'limit' => 3));
		$this->set('exp_data', $data);	
		// fetch the recent users approval req.	
		$this->loadModel('FinExpApprove');	
		if($this->Session->read('USER.Login.hr_department_id') == '4'){
			$cond = array('FinExpApprove.approve_status' => 'W', 'FinExpApprove.is_approve' => 'N');
		}else{
			$cond = array('FinExpStatus.app_users_id' => 'W', 'FinExpApprove.is_approve' => 'N', 'FinExpStatus.app_users_id' =>$this->Session->read('USER.Login.id'));
		}
		$data = $this->FinExpApprove->find('all', array('fields' => array('Home.id', 'id','created_date', 'TskCustomer.company_name','TskProject.project_name','Home.photo', 'Home.photo_status', 'Home.gender', 'FinExpStatus.id','Home.first_name','Home.last_name'),'conditions' => array('FinExpApprove.is_deleted' => 'N', $cond, 'is_draft' => 'N'), 'order' => array('created_date' => 'desc'),'group' => array('FinExpApprove.id'), 'limit' => 3));		
		$this->set('exp_approve_data', $data);
		
		// fetch the recent activities
		$data = $this->FinHome->get_recent_activity($this->Session->read('USER.Login.id'));
		$this->set('activity_data', $data);
		
		
	}
	
	/* clear the cache */
	
	public function beforeFilter() { 
		$this->show_tabs();
	}
	
	
	
	
}