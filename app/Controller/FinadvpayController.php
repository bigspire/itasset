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
 
class FinAdvPayController extends AppController {  
	
	public $name = 'FinAdvPay';	
	
	public $helpers = array('Html', 'Form', 'Session');
	
	public $components = array('Session', 'Functions','Excel');
	
	public $layout = 'apps';	

	/* function to list the adv. requests */
	public function index(){
		
		// set the page title
		$this->set('title_for_layout', 'Pay Advance - Finance - My PDCA');
		// get employee list
		$this->loadModel('Home');
		$format_list = $this->Home->find('list', array('fields' => array('Home.id', 'Home.full_name'), 'conditions' => array('Home.status' => '1', 'Home.is_deleted'=> 'N'),'order' => array('Home.full_name' => 'asc')));
		$this->set('empList', $format_list);
		
		$this->params->query['status'] = $this->request->data['FinAdvPay']['status'] ? $this->request->data['FinAdvPay']['status'] : $this->params->query['status'];	
		// when the form is submitted for search
		if($this->request->is('post')){
			$url_vars = $this->Functions->create_url(array('status','emp_id'),'FinAdvPay'); 
			$this->redirect('/finadvpay/?'.$url_vars);			
		}
		
		// condition for status
		if($this->params->query['status'] == 'P'){ 
			$statCond = array('FinAdvPay.id' => ''); 
		}else if ($this->params->query['status'] == 'S'){ 
			$statCond = array('FinAdvPay.id !=' => ''); 
		}
		// get employee condition
		if($this->params->query['emp_id'] != ''){
			$empCond = array('FinAdvances.app_users_id' => $this->params->query['emp_id']); 
		}
		
		$options = array(			
			array('table' => 'fin_advance',
					'alias' => 'FinAdvances',					
					'type' => 'RIGHT',
					'conditions' => array('`FinAdvances`.`id` = `FinAdvPay`.`fin_advance_id`',
					'FinAdvances.is_approve' => 'Y')
			),
			array('table' => 'app_users',
					'alias' => 'Home',					
					'type' => 'LEFT',
					'conditions' => array('`FinAdvances`.`app_users_id` = `Home`.`id`',
					'is_approve' => 'Y')
			)
		);
		$this->FinAdvPay->unBindModel(array('belongsTo' => array('FinAdvance')));
		
		
		$this->FinAdvPay->virtualFields = array('createDate' => 'FinAdvances.created_date', 'adv_no' => 'FinAdvances.id', 'purpose' => 'FinAdvances.purpose');
		
		// for export
		if($this->request->query['action'] == 'export'){
			$data = $this->FinAdvPay->find('all', array('fields' => array('id','FinAdvPay.amount as paid_amount', 'paid_date', 'Home.first_name', 'Home.last_name', 'pay_mode','created_date', 'FinAdvances.id','FinAdvances.created_date','FinAdvances.created_date','FinAdvances.amount as req_amount', 'sum(FinAdvPay.amount) as tot_amt', 'FinAdvances.purpose','FinAdvances.req_date'),'conditions' => array('FinAdvances.is_deleted' => 'N', 'FinAdvances.is_approve' => 'Y'), 
			'order' => array('createDate' => 'desc'), 'group' => array('FinAdvances.id'), 'joins' => $options));
			$this->Excel->generate('advance', $data, $data, 'Report', 'Advance Pay Report');
		}		
		
		$this->paginate = array('fields' => array('id','FinAdvPay.amount as paid_amount', 'paid_date', 'Home.first_name', 'Home.last_name', 'pay_mode','created_date', 'FinAdvances.id','FinAdvances.created_date','FinAdvances.created_date','FinAdvances.amount as req_amount', 'sum(FinAdvPay.amount) as tot_amt', 'FinAdvances.purpose','FinAdvances.req_date'),'limit' => 10,'conditions' => array($statCond,$empCond,'FinAdvances.is_deleted' => 'N', 'FinAdvances.is_approve' => 'Y'), 'order' => array('createDate' => 'desc'), 'group' => array('FinAdvances.id'), 'joins' => $options);
		$data = $this->paginate('FinAdvPay');
		
		$this->set('pay_data', $data);		
		if(empty($data)){
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>You have no advances to pay', 'default', array('class' => 'alert alert'));	
		}
		
		
	}
	
	/* function to save the advance */
	public function pay_advance($id){ 
		// set the page title		
		$this->set('title_for_layout', 'Pay Advance - Finance - My PDCA');	
		//$data = $this->FinAdvPay->findByFinAdvanceId($id);
		$this->set('modeList', array('CA' => 'Cash', 'CK' => 'Cheque', 'OT' => 'Online Transfer'));
		//$this->set('adv_data', $data);		
		$data = $this->FinAdvPay->FinAdvance->findById($id, array('fields' => 'app_users_id','purpose','description','amount'));
		$this->set('adv_data', $data);
		$this->loadModel('Home');
		$user_data = $this->Home->findById($data['FinAdvance']['app_users_id'], array('fields' => 'full_name','email_address'));		
		$this->set('user_data', $user_data);
		// get adv. payment
		$this->get_adv_payment($id);		
		// get remarks
		$this->get_adv_remarks($id);
		if ($this->request->is('post')){ 
			// validates the form
			$this->FinAdvPay->set($this->request->data);
			if ($this->FinAdvPay->validates(array('fieldList' => array('amount', 'pay_mode','paid_date')))) {
				$this->request->data['FinAdvPay']['app_users_id'] = $this->Session->read('USER.Login.id');
				// format the dates to save					
				$this->request->data['FinAdvPay']['paid_date'] = $this->Functions->format_date_save($this->request->data['FinAdvPay']['paid_date']);
				$this->request->data['FinAdvPay']['created_date'] = $this->Functions->get_current_date();
				$this->request->data['FinAdvPay']['created_by'] = $this->Session->read('USER.Login.id');
				
				$this->request->data['FinAdvPay']['fin_advance_id'] = $this->request->params['pass'][0];
				// save the data
				if($this->FinAdvPay->save($this->request->data['FinAdvPay'])) {	
						// send mail to user
						$this->notify_employee($user_data,$this->request->data, $data);
						// show the msg.
						$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Advance payment created successfully', 'default', array('class' => 'alert alert-success'));
						$this->redirect('/finadvpay/');
					}else{
						$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in saving advance payment', 'default', array('class' => 'alert alert-error'));
					}
				}else{
					$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in submitting the form, please check errors', 'default', array('class' => 'alert alert-error'));
					//$this->redirect('/finadvpay/');	
				}
					
					
			}	
			
	}
	
	/* function to get advance remarks */
	public function get_adv_remarks($id){
		// get remarks
		$this->loadModel('FinAdvStatus');
		$this->FinAdvStatus->bindModel(
			array('belongsTo' => array(
					'HrEmployee' => array(
						'className' => 'HrEmployee',
						'foreignKey' => 'app_users_id'
					)
				)
			)
		);
		$remarks = $this->FinAdvStatus->find('all', array('fields' => array('HrEmployee.first_name','HrEmployee.last_name', 
		'modified_date','remarks', 'HrEmployee.photo_status', 'HrEmployee.photo'), 'conditions' => array('fin_advance_id' => $id),'order' => array('FinAdvStatus.id' => 'desc'))); 
		$this->set('lead_remarks', $remarks);
	}
	
	/* function to notify the employee */
	public function notify_employee($user_data,$pay_data,$adv_data){	
		
		$vars = array('from_name' => $this->Session->read('USER.Login.first_name').' '.$this->Session->read('USER.Login.last_name') ,'name' => $user_data['Home']['full_name'], 'amt' => $pay_data['FinAdvPay']['amount'], 'mode' => $pay_data['FinAdvPay']['pay_mode'], 'remarks' => $pay_data['FinAdvPay']['remarks'], 'paid_date' => $pay_data['FinAdvPay']['paid_date'], 'purpose' => $adv_data['FinAdvance']['purpose'],'ref_no' => $pay_data['FinAdvPay']['pay_refno']);
		
		if(!$this->send_email('My PDCA - Advance payment updated by '.ucfirst($this->Session->read('USER.Login.first_name')).' '.ucfirst($this->Session->read('USER.Login.last_name')), 'notify_adv_pay', 'noreply@mypdca.in', $user_data['Home']['email_address'],$vars)){		
			// show the msg.								
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in sending the mail to user...', 'default', array('class' => 'alert alert-error'));				
		}else{								
			
		}
	}
	
	/* function to delete the adv. request 
	public function edit_payment($adv_id, $pay_id){
		if(!empty($adv_id) && intval($adv_id) && !empty($pay_id) && intval($pay_id)){	
			$this->set('modeList', array('CA' => 'Cash', 'CK' => 'Cheque', 'OT' => 'Online Transfer'));
			//$this->set('adv_data', $data);		
			$data = $this->FinAdvPay->FinAdvance->findById($adv_id, array('fields' => 'app_users_id'));
			$this->loadModel('Home');
			$user_data = $this->Home->findById($data['FinAdvance']['app_users_id'], array('fields' => 'full_name'));			
		    $this->set('user_data', $user_data);
			if (!empty($this->request->data)){ 
				// validates the form
				$this->FinAdvPay->set($this->request->data);
				if ($this->FinAdvPay->validates(array('fieldList' => array('amount', 'pay_mode','paid_date')))) {
					// format the dates to save					
					$this->request->data['FinAdvPay']['paid_date'] = $this->Functions->format_date_save($this->request->data['FinAdvPay']['paid_date']);
					$this->request->data['FinAdvPay']['modified'] = $this->Functions->get_current_date();
					$this->request->data['FinAdvPay']['modified_by'] = $this->Session->read('USER.Login.id');
					
					// save the data
					if($this->FinAdvPay->save($this->request->data['FinAdvPay'])) {					
							// show the msg.
							$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Advance payment modified successfully', 'default', array('class' => 'alert alert-success'));
							$this->redirect('/finadvpay/');
					}else{
						$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in modifying advance payment', 'default', array('class' => 'alert alert-error'));
					}
				}else{
					$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in submitting the form, please check errors', 'default', array('class' => 'alert alert-error'));
				}
			}else{				
				$this->request->data = $this->FinAdvPay->findById($pay_id);
				$this->request->data['FinAdvPay']['paid_date'] = $this->Functions->format_date_show($this->request->data['FinAdvPay']['paid_date']);
	
			}			
		}else{
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));	
			$this->redirect('/finadvpay/');	
		}
		
	}
	*/
	
	

	
	/* function to view the adv. request */
	public function view_payment($id, $pay_id){
		// set the page title		
		$this->set('title_for_layout', 'View Payment Advance - Finance - My PDCA');		
		if(!empty($id) && intval($id)){			   
			$data = $this->FinAdvPay->FinAdvance->findById($id, array('fields' => 'app_users_id', 'purpose','amount','req_date','TskCustomer.company_name','FinAdvance.id'));
			$this->set('adv_data', $data);	
			// get employee 	
			$this->loadModel('Home');			
			$user_data = $this->Home->find('all', array('fields' => array('full_name'), 'conditions' => array('Home.id' => $data['FinAdvance']['app_users_id'])));
			$this->set('user_data', $user_data[0]);		
			
			// get adv. payment
			$this->get_adv_payment($id);			
			// get remarks
			$this->get_adv_remarks($id);
		}else{
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));		
			$this->redirect('/finadvpay/');	
		}		
		
	}
	
	/* function to get adv. payments */
	public function get_adv_payment($id){
		$this->FinAdvPay->unBindModel(array('belongsTo' => array('FinAdvance')));
		$data = $this->FinAdvPay->find('all', array('conditions' => array('FinAdvPay.fin_advance_id' => $id), 'order' => array('FinAdvPay.created_date' => 'desc')));			
		$this->set('pay_data', $data);	
	}
	
	
	/* clear the cache */
	
	public function beforeFilter() { 
		//$this->disable_cache();
		$this->show_tabs(7);
	}
	
		
		/* auto complete search */	
	public function search(){ 
		$this->layout = false;	 
		$q = trim(Sanitize::escape($_GET['q']));	
		if(!empty($q)){
			// execute only when the search keywork has value		
			$this->set('keyword', $q);
			$data = $this->FinAdvPay->find('all', array('fields' => array('purpose'),  'group' => array('purpose','description'), 'conditions' => 	$conditions =  array("OR" => array ('purpose like' => '%'.$q.'%', 'description like' => '%'.$q.'%'), 'AND' => array('is_deleted' => 'N'))));		
			$this->set('results', $data);
		}
    }
	
	
	
	
}