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
class TvlhomeController extends AppController {  
	
	public $name = 'TvlHome';	
	
	public $helpers = array('Html', 'Form', 'Session');
	
	public $components = array('Session', 'Functions');
	
	public $layout = 'apps';	

	/* function to login the employer */
	public function index(){	
		// set the page title
		$this->set('title_for_layout', 'Home - Biz Tour - My PDCA');
		
		// fetch the recent user requests
		$this->loadModel('TvlReq');
		$data = $this->TvlReq->find('all', array('fields' => array('id','created_date', 'purpose'), 'conditions' => array('TvlReq.app_users_id' => $this->Session->read('USER.Login.id'), 'TvlReq.is_deleted' => 'N','is_approve' => 'N', 'TvlReq.status' => 'A'), 'order' => array('created_date' => 'desc'), 'group' => array('TvlReq.id'),  'limit' => 5));
		$this->set('tvl_data', $data);	
		
		// fetch the recent user cancel requests
		$this->TvlReq->bindModel(
						array('hasOne' => array(
								'TvlCancel' => array(
									'className' => 'TvlCancel',
									'foreignKey' => 'tvl_request_id',
									'type' => 'INNER'
								)
							)
						)
					);
		
		$data = $this->TvlReq->find('all', array('fields' => array('id','created_date', 'purpose'), 'conditions' => array('TvlReq.app_users_id' => $this->Session->read('USER.Login.id'), 'TvlReq.is_deleted' => 'N', 'TvlReqStatus.type' => 'C','TvlReqStatus.status' => 'W'), 'order' => array('created_date' => 'desc'), 'group' => array('TvlReq.id'),  'limit' => 5));
		$this->set('tvl_cancel_data', $data);	
		
		
		// fetch the recent users approval req.	
		$this->loadModel('TvlReqApr');	
		$data = $this->TvlReqApr->find('all', array('fields' => array('HrEmployee.id', 'id','created_date', 'purpose','HrEmployee.photo', 'HrEmployee.photo_status', 'HrEmployee.gender', 'TvlReqStatus.id','HrEmployee.first_name','HrEmployee.last_name'),'conditions' => array('TvlReqStatus.app_users_id' => $this->Session->read('USER.Login.id'),'TvlReqApr.is_deleted' => 'N','TvlReqApr.status' => 'A', 'TvlReqStatus.type' => 'N','TvlReqStatus.status' => 'W', 'is_approve' => 'N'), 'order' => array('created_date' => 'desc'), 'group' => array('TvlReqApr.id'), 'limit' => 5));	
		$this->set('approve_data', $data);
		
		// fetch approve cancel travel
		$this->loadModel('TvlCanApr');
		$data = $this->TvlCanApr->find('all', array('fields' => array('HrEmployee.id', 'id','created_date', 'purpose','HrEmployee.photo', 'HrEmployee.photo_status', 'HrEmployee.gender', 'TvlReqStatus.id','HrEmployee.first_name','HrEmployee.last_name'),'conditions' => array('TvlReqStatus.app_users_id' => $this->Session->read('USER.Login.id'),'TvlReqStatus.type' => 'C','TvlReqStatus.status' => 'W'), 'order' => array('created_date' => 'desc'), 'group' => array('TvlCanApr.id'), 'limit' => 5));	
		$this->set('approve_cancel_data', $data);
		
		// fetch the priority booking
		$this->loadModel('TvlBookTkt');	
		$data = $this->TvlBookTkt->find('all', array('fields' => array('HrEmployee.id', 'id','created_date', 'purpose','HrEmployee.photo', 'HrEmployee.photo_status', 'HrEmployee.gender','HrEmployee.first_name','HrEmployee.last_name'),'conditions' => array('TvlBookTkt.is_deleted' => 'N', 'is_approve' => 'Y', 'TvlBookTkt.status' => 'A',  'tkt_status' => NULL), 'order' => array('start_date' => 'asc'), 'group' => array('TvlBookTkt.id'), 'limit' => 5));	
		$this->set('booking_data', $data);
	}
	
	/* clear the cache */
	
	public function beforeFilter() { 
		$this->show_tabs();
	}
	
	
	
	
}