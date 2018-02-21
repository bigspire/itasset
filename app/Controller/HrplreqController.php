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
 
class HrplreqController extends AppController {  
	
	public $name = 'HrPlReq';	
	
	public $helpers = array('Html', 'Form', 'Session');
	
	public $components = array('Session', 'Functions');
	
	public $layout = 'apps';	
	
	

	/* function to list the adv. requests */
	public function index(){	
		// set the page title
		$this->set('title_for_layout', 'Approve PL Requests - HRIS - My PDCA');
		// load team members
		$this->load_employee();
		// when the form is submitted for search
		if($this->request->is('post')){
			$url_vars = $this->Functions->create_url(array('keyword','emp_id'),'HrPlReq'); 
			$this->redirect('/hrplreq/?'.$url_vars);	
		}
		
		if($this->params->query['emp_id'] != ''){
			$empCond = array('HrPlReq.app_users_id' => $this->params->query['emp_id']); 
		}
		
	
		// fetch the advances		
		$this->paginate = array('fields' => array('id','date_from', 'date_to','reason','HrPlReq.status','created_date', 'no_days', 'approve_date','app_users_id','HrEmployee.first_name', 'HrEmployee.last_name'),
		'limit' => 10,'conditions' => array($empCond, 'HrPlReq.is_deleted' => 'N'), 'order' => array('created_date' => 'desc'), 'joins' => $options);
		$data = $this->paginate('HrPlReq');			
		$this->set('req_data', $data);
		if(empty($data)){
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>You have no PL requests for approve', 'default', array('class' => 'alert alert'));	
		}
		
		
	}
	
	
	/* function to load the employee */
	public function load_employee(){
		$this->HrPlReq->HrEmployee->virtualFields = array('first_name' => "UPPER(CONCAT_WS(' ', trim(HrEmployee.first_name), trim(HrEmployee.last_name)))");
		$empList = $this->HrPlReq->HrEmployee->find('list', array('fields' => array('id','first_name'),
		'order' => array('first_name ASC'),'conditions' => array('is_deleted' => 'N', 'status' => '1')));
		$this->set('empList', $empList);
	}
	
	
		/* function to process the advance */
	public function process_req($req_id, $status,$user_id){ 
		$ret_value = $this->auth_action($req_id);
		// make sure valid user
		if($ret_value == 'pass'){
			$data = array('approve_date' => $this->Functions->get_current_date(),'approve_by' => $this->Session->read('USER.Login.id'), 'remarks' => $this->request->query['remark'], 'status' => $status);
			$this->HrPlReq->id = $req_id;
			$st_msg = $status == 'A' ? 'approved' : 'rejected';
			// save the finance adv. status
			if($this->HrPlReq->save($data, true, $fieldList = array('approve_by','approve_date','remarks','status'))){				
				// get user data
				$user_data = $this->HrPlReq->HrEmployee->find('first', array('conditions' => array('HrEmployee.id' => $user_id),'fields' => array('email_address','first_name', 'last_name')));
				// get req details
				$req_data = $this->HrPlReq->findById($req_id, array('fields' => 'date_from','reason', 'date_to','no_days'));
				
				$vars = array('name' => $user_data['HrEmployee']['first_name'].' '.$user_data['HrEmployee']['last_name'], 'leave_from' => $req_data['HrPlReq']['date_from'], 'leave_to' => $req_data['HrPlReq']['date_to'], 'no_days' => $req_data['HrPlReq']['no_days'],
				'reason' => $req_data['HrPlReq']['reason'], 'remarks' => $this->request->query['remark'], 'status' => $st_msg, 'employee' => $user_data['HrEmployee']['first_name'].' '.$user_data['HrEmployee']['last_name']);
				// notify employee						
				if(!$this->send_email('My PDCA - Your PL request is '.$st_msg.' by '.ucfirst($this->Session->read('USER.Login.first_name')).' '.ucfirst($this->Session->read('USER.Login.last_name')), 'notify_pl_req', 'noreply@mypdca.in', $user_data['HrEmployee']['email_address'],$vars)){		
					// show the msg.								
					$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in sending the mail to user...', 'default', array('class' => 'alert alert-error'));				
				}else{								
				}		
				
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>PL request is '.$st_msg.' successfully', 'default', array('class' => 'alert alert-success'));
			}else{
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Problem in updating the status', 'default', array('class' => 'alert alert-error'));		
			}
		}else{
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));		

		}
		$this->redirect('/hrplreq/');	
	}

		
	/* function to auth record */
	public function auth_action($id){
		$data = $this->HrPlReq->findById($id, array('fields' => 'id','is_deleted'));	
		// check the req belongs to the user
		if($data['HrPlReq']['is_deleted'] == 'Y'){
			return 'fail';
		}		
		else if(empty($data)){	
			return 'fail';
		}else{
			return 'pass';
		}
	}
	
	/* function to view the adv. request */
	public function view_request($id){
		// set the page title		
		$this->set('title_for_layout', 'View PL Request - HRIS - My PDCA');
		if(!empty($id) && intval($id)){
			// authorize user before action
			$ret_value = $this->auth_action($id);
			if($ret_value == 'pass'){				
				$data = $this->HrPlReq->find('all', array('conditions' => array('HrPlReq.id' => $id), 'fields' => array('date_from','date_to','reason','remarks','HrPlReq.status','no_days','HrEmployee.first_name','HrEmployee.last_name')));
				$this->set('req_data', $data[0]);
			}else if($ret_value == 'fail'){ 
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/hrplreq/');	
			}else{
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Record Deleted: '.$ret_value , 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/hrplreq/');	
			}
		}else{
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));		
			$this->redirect('/hrplreq/');	
		}
		
		
	}
	
	
	
	/* clear the cache */
	
	public function beforeFilter() { 
		//$this->disable_cache();
		$this->show_tabs(86);
	}
	
	

	
	
	
}