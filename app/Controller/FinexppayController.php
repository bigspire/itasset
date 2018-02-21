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
 
class FinExpPayController extends AppController {  
	
	public $name = 'FinExpPay';	
	
	public $helpers = array('Html', 'Form', 'Session');
	
	public $components = array('Session', 'Functions','Excel');
	
	public $layout = 'apps';	

	/* function to list the adv. requests */
	public function index(){	
		// set the page title
		$this->set('title_for_layout', 'Pay Expense - Finance - My PDCA');
		// get employee list
		$this->loadModel('Home');
		$format_list = $this->Home->find('list', array('fields' => array('Home.id', 'Home.full_name'), 'conditions' => array('Home.status' => '1', 'Home.is_deleted'=> 'N'),'order' => array('Home.full_name' => 'asc')));
		$this->set('empList', $format_list);
		
		$this->params->query['status'] = $this->request->data['FinExpPay']['status'] ? $this->request->data['FinExpPay']['status'] : $this->params->query['status'];	
		// when the form is submitted for search
		if($this->request->is('post')){
			$url_vars = $this->Functions->create_url(array('status','emp_id'),'FinExpPay'); 
			$this->redirect('/finexppay/?'.$url_vars);			
		}
		// search with expense no.
		if(intval($this->params->query['keyword'])){
			$exp_cond = array('FinExpenses2.expense_no' => $this->params->query['keyword']); 
		}else if($this->params->query['keyword'] != ''){
			$exp_cond = array("MATCH (Project.project_name,Customer.company_name) AGAINST ('".$this->params->query['keyword']."' IN BOOLEAN MODE)"); 		
		}
		
		// get employee condition
		if($this->params->query['emp_id'] != ''){
			$empCond = array('FinExpenses2.app_users_id' => $this->params->query['emp_id']); 
		}
			
		// condition for status
		if($this->params->query['status'] == 'P'){ 
			$statCond = array('FinExpPay.id' => ''); 
		}else if ($this->params->query['status'] == 'S'){ 
			$statCond = array('FinExpPay.id !=' => ''); 
		}
		
		$options = array(			
			array('table' => 'fin_expenses',
					'alias' => 'FinExpenses2',					
					'type' => 'RIGHT',
					'conditions' => array('`FinExpenses2`.`id` = `FinExpPay`.`fin_expenses_id`',
					'FinExpenses2.is_approve' => 'Y')
			),
			
			array('table' => 'app_users',
					'alias' => 'Home',					
					'type' => 'LEFT',
					'conditions' => array('`FinExpenses2`.`app_users_id` = `Home`.`id`',
					'is_approve' => 'Y')
			),
			array('table' => 'tsk_projects',
					'alias' => 'Project',					
					'type' => 'LEFT',
					'conditions' => array('`Project`.`id` = `FinExpenses2`.`tsk_projects_id`')
			)
			,
			array('table' => 'tsk_company',
					'alias' => 'Customer',					
					'type' => 'LEFT',
					'conditions' => array('`Customer`.`id` = `FinExpenses2`.`tsk_company_id`')
			)
		);
		$this->FinExpPay->unBindModel(array('belongsTo' => array('FinExpenses')));
				
		$this->FinExpPay->virtualFields = array('createDate' => 'FinExpenses2.created_date');
		// for export
		if($this->request->query['action'] == 'export'){
			$data = $this->FinExpPay->find('all', array('fields' => array('FinExpenses2.created_date','FinExpPay.id', 'FinExpenses2.id', 'FinExpenses2.created_date', 'FinExpenses2.amount', 'FinExpPay.amount as paid_amount', 'Project.project_name', 'Customer.company_name', 'FinExpenses2.expense_no', 'paid_date', 'Home.first_name', 'Home.last_name', 'pay_mode','created_date'),'conditions' => array('FinExpenses2.is_deleted' => 'N', 'FinExpenses2.is_approve' => 'Y'), 
			 'order' => array('createDate' => 'desc'), 'group' => array('FinExpenses2.id'), 'joins' => $options));
			$this->Excel->generate('expense_pay', $data, $data, 'Report', 'Expense Pay Report');
		}		
		
		$this->paginate = array('fields' => array('FinExpenses2.created_date','FinExpPay.id', 'FinExpenses2.id', 'FinExpenses2.created_date', 'FinExpenses2.amount', 'FinExpPay.amount as paid_amount', 'Project.project_name', 'Customer.company_name', 'FinExpenses2.expense_no', 'paid_date', 'Home.first_name', 'Home.last_name', 'pay_mode','created_date'),'limit' => 10,'conditions' => array($statCond, $exp_cond, $empCond,'FinExpenses2.is_deleted' => 'N', 'FinExpenses2.is_approve' => 'Y'), 'order' => array('createDate' => 'desc'), 'group' => array('FinExpenses2.id'), 'joins' => $options);
		$data = $this->paginate('FinExpPay');
		//echo '<pre>';print_r($data);	
		$this->set('pay_data', $data);		
		if(empty($data)){
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>You have no expenses to pay', 'default', array('class' => 'alert alert'));	
		}
		
		
	}
	
	/* function to view all expenses */
	public function view_exp($id){
		$this->layout = 'iframe';
		$this->loadModel('FinExpense');
		$data = $this->FinExpense->FinExpList->find('all', array('fields' => array('bill_avail', 'billable', 
		'date_exp','amount','description','bill_refno','fin_expenses_id', 'FinExpCat.category'), 
		'conditions' => array('FinExpList.fin_expenses_id ' => $id, 'FinExpList.status' => 'W'), 'order' => array('FinExpList.date_exp' => 'asc')));
		$this->set('exp_list', $data);
	}
	
	/* function to view all expenses */
	public function view_adv($id){ 
		$this->layout = 'iframe';
		$this->loadModel('FinAdvPay');
		$data = $this->FinAdvPay->find('all', array('fields' => array('amount', 'pay_mode', 
		'paid_date','pay_refno','remarks','created_date'), 
		'conditions' => array('FinAdvPay.fin_advance_id ' => $id), 'order' => array('FinAdvPay.created_date' => 'desc')));
		
		$this->set('adv_list', $data);
	}
	
	/* function to save the advance */
	public function add_payment($id){ 
		// set the page title		
		$this->set('title_for_layout', 'Pay Expense - Finance - My PDCA');	
		// check expense set
		$this->validate_expense_pay($id);
		$this->set('modeList', array('CA' => 'Cash', 'CK' => 'Cheque', 'OT' => 'Online Transfer',
		'ADJ' => 'Adjust to Advance')); // , 'ADD' => 'Add to Advance'
		//$this->set('adv_data', $data);		
		$data = $this->FinExpPay->FinExpenses->findById($id, array('fields' => 'app_users_id'));
		$this->loadModel('Home');
		$user_data = $this->Home->findById($data['FinExpenses']['app_users_id'], array('fields' => 'full_name','email_address'));		
		$this->set('user_data', $user_data);
		
		// find expense amount
		$exp_data = $this->FinExpPay->FinExpenses->find('all', array( 'conditions' => array('FinExpenses.id' => $id, 'is_approve' => 'Y'),'fields' => array('amount','FinExpenses.created_date','expense_no')));
		// get prev. balance
		$this->get_balance($data['FinExpenses']['app_users_id']);
		$this->set('exp_data', $exp_data);		
		// calculate adv. amount
		$this->cal_total_adv($data['FinExpenses']['app_users_id']);
		if ($this->request->is('post')){ 
			// validates the form
			$this->FinExpPay->set($this->request->data);
			if ($this->FinExpPay->validates(array('fieldList' => array('pay_mode', 'paid_date')))) {
				// format the dates to save					
				$this->request->data['FinExpPay']['paid_date'] = $this->Functions->format_date_save($this->request->data['FinExpPay']['paid_date']);
				$this->request->data['FinExpPay']['created_date'] = $this->Functions->get_current_date();
				$this->request->data['FinExpPay']['created_by'] = $this->Session->read('USER.Login.id');
				$this->request->data['FinExpPay']['balance_hand'] = $this->request->data['FinExpPay']['balance_final'];
				//$this->request->data['FinExpPay']['tot_advance'] = $this->request->data['FinExpPay']['tot_advance'];				
				$this->request->data['FinExpPay']['fin_expenses_id'] = $this->request->params['pass'][0];
				// update reconcile
				$this->update_reconcile($data['FinExpenses']['app_users_id']);
				// save the data
				if($this->FinExpPay->save($this->request->data['FinExpPay'], array('validate' => false))) {	
												
						// send mail to user
						$this->notify_employee($user_data,$this->request->data, $exp_data);
						// show the msg.
						$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Expense payment updated successfully', 'default', array('class' => 'alert alert-success'));
						$this->redirect('/finexppay/');
					}else{
						$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in saving expense payment', 'default', array('class' => 'alert alert-error'));
					}
			}else{
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in submitting the form, please check errors', 'default', array('class' => 'alert alert-error'));
			}
					
					
			}
	}
	
	/* function to update reconcile */
	public function update_reconcile($id){
		$this->loadModel('FinAdvPay');
		$data = $this->FinAdvPay->find('all', array('conditions' => array('FinAdvance.app_users_id' => $id, 'FinAdvPay.reconcile' => '0'), 
		'fields' => array('FinAdvPay.id')));
		foreach($data as $adv){
			$this->FinAdvPay->id = $adv['FinAdvPay']['id'];
			$this->FinAdvPay->saveField('reconcile', '1');
		}
	}
	
	/* function to get prev. balance */
	public function get_balance($id){
		$data = $this->FinExpPay->find('all', array('conditions' => array('app_users_id' => $id), 
		'order' => array('FinExpPay.id' => 'desc'), 'limit' => '1', 'fields' => array('balance_hand')));
		$this->set('bal_hand', $data[0]['FinExpPay']['balance_hand']);
	}
	
	/* function to validate exp. pay */
	public function validate_expense_pay($id){
		$count = $this->FinExpPay->find('count', array('conditions' => array('fin_expenses_id' => $id)));
		if($count > 0){
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));
			$this->redirect('/finexppay/');
		}
	}
	
	/* function to notify the employee */
	public function notify_employee($user_data,$pay_data,$exp_data){
		
		$vars = array('from_name' => $this->Session->read('USER.Login.first_name').' '.$this->Session->read('USER.Login.last_name') ,'name' => ucwords($user_data['Home']['full_name']), 'exp_no' => $exp_data[0]['FinExpenses']['expense_no'],'date' => $exp_data[0]['FinExpenses']['created_date'], 'receive_emp' => $pay_data['FinExpPay']['amt_received'], 'balance' => $pay_data['FinExpPay']['balance_hand'], 'paid_emp' => $pay_data['FinExpPay']['amount'], 'mode' => $pay_data['FinExpPay']['pay_mode'], 'remarks' => $pay_data['FinExpPay']['remarks'], 'paid_date' => $pay_data['FinExpPay']['paid_date'],'ref_no' => $pay_data['FinExpPay']['pay_refno']);
		
		if(!$this->send_email('My PDCA - Expense submission payment updated by '.ucfirst($this->Session->read('USER.Login.first_name')).' '.ucfirst($this->Session->read('USER.Login.last_name')), 'notify_exp_pay', 'noreply@mypdca.in', $user_data['Home']['email_address'],$vars)){		
			// show the msg.								
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in sending the mail to user...', 'default', array('class' => 'alert alert-error'));				
		}else{								
			
		}
	}
	
	
	/* function to calculate total adv. amt */
	public function cal_total_adv($id){	
	// get sum of pending advances of user
		$this->loadModel('FinAdvPay');
		$adv_data = $this->FinAdvPay->find('all', array( 'conditions' => array('FinAdvance.app_users_id' =>  $id,  'FinAdvPay.reconcile' => '0'),'fields' => array('sum(FinAdvPay.amount) as sum_advance')));
		$advance = $adv_data[0][0]['sum_advance'];
		if(empty($advance)){
			$advance = '0';
		}
		$this->set('SUM_ADVANCE', $advance);
	}
	

	
	/* function to view the adv. request */
	public function view_payment($id, $pay_id){
		// set the page title		
		$this->set('title_for_layout', 'View Payment Advance - Finance - My PDCA');		
		if(!empty($id) && intval($id)){				
			$data = $this->FinExpPay->findById($pay_id);
			//echo '<pre>'; print_r($data);
			$this->set('pay_data', $data);	
			// calculate adv. amount
			//$this->cal_total_adv($data['FinExpenses']['app_users_id']);
			// get employee 
			$data = $this->FinExpPay->FinExpenses->findById($id, array('fields' => 'app_users_id'));
			$this->loadModel('Home');
			$user_data = $this->Home->findById($data['FinExpenses']['app_users_id'], array('fields' => 'full_name'));			
		    $this->set('user_data', $user_data);	
		}else{
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));		
			$this->redirect('/finexppay/');	
		}		
		
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
			// bind home model
			$this->FinExpPay->FinExpenses->bindModel(array('belongsTo' => array('Home' => array('foreignKey' => 'app_users_id', 'conditions' => array('Home.id = FinExpenses.app_users_id')))));			
			$options = array(			
				array('table' => 'tsk_projects',
						'alias' => 'Project',					
						'type' => 'LEFT',
						'conditions' => array('`Project`.`id` = `FinExpenses`.`tsk_projects_id`')
				)
				,
				array('table' => 'tsk_company',
						'alias' => 'Customer',					
						'type' => 'LEFT',
						'conditions' => array('`Customer`.`id` = `FinExpenses`.`tsk_company_id`')
				)
			);
			$data = $this->FinExpPay->FinExpenses->find('all', array('fields' => array('expense_no','Project.project_name','Customer.company_name'),  'group' => array('expense_no'), 'conditions' => 	$conditions =  array("OR" => array ('expense_no like' => '%'.$q.'%',  'Project.project_name like' => '%'.$q.'%', 'Customer.company_name like' => '%'.$q.'%'), 'AND' => array('FinExpenses.is_deleted' => 'N')), 'joins' => $options));		
			$this->set('results', $data);
		}
    }
	
	
	
	
}