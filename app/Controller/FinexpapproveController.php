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

class FinExpApproveController extends AppController {  
	
	public $name = 'FinExpApprove';	
	
	public $helpers = array('Html', 'Form', 'Session');
	
	public $components = array('Session', 'Functions','Excel');
	
	public $layout = 'apps';	

	/* function to list the adv. requests */
	public function index(){	
		// set the page title
		$this->set('title_for_layout', 'Approve Expense - Finance - My PDCA');
		// get employee list
		if($this->Session->read('USER.Login.hr_department_id') == '4'){
			$format_list = $this->FinExpApprove->Home->find('list', array('fields' => array('Home.id', 'Home.full_name'), 'conditions' => array('Home.is_deleted' => 'N'), 'order' => array('Home.full_name' => 'asc')));
		}else{	
			$emp_list = $this->FinExpApprove->get_team($this->Session->read('USER.Login.id'),'E', '1');
			$format_list = $this->Functions->format_dropdown($emp_list, 'u','id','first_name', 'last_name');		
		}
		$this->set('empList', $format_list);
		
		// when the form is submitted for search
		if($this->request->is('post')){
			$url_vars = $this->Functions->create_url(array('keyword','emp_id'),'FinExpApprove'); 
			$this->redirect('/finexpapprove/?'.$url_vars);			
		}
		
		// search with expense no.
		if(intval($this->params->query['keyword'])){
			$exp_cond = array('FinExpApprove.expense_no' => $this->params->query['keyword']); 
		}
		else if($this->params->query['keyword'] != ''){
			$exp_cond = array("MATCH (TskProject.project_name, TskCustomer.company_name) AGAINST ('".$this->params->query['keyword']."' IN BOOLEAN MODE)");			
		}
		if($this->params->query['emp_id'] != ''){
			$empCond = array('FinExpApprove.app_users_id' => $this->params->query['emp_id']); 
		}
		
		$this->FinExpApprove->unBindModel(array('hasOne' => array('FinExpList','FinExpStatus')));
		$this->FinExpApprove->unBindModel(array('belongsTo' => array('Home')));
		
		$options = array(			
			array('table' => 'fin_exp_status',
					'alias' => 'FinExpStatuses',					
					'type' => 'LEFT',
					'conditions' => array('`FinExpStatuses`.`fin_expenses_id` = `FinExpApprove`.`id`')
			),
			array('table' => 'app_users',
					'alias' => 'Homes',					
					'type' => 'LEFT',
					'conditions' => array('`FinExpStatuses`.`app_users_id` = `Homes`.`id`')
			),
			
			array('table' => 'app_users',
					'alias' => 'Home2',					
					'type' => 'LEFT',
					'conditions' => array('`FinExpApprove`.`approve_by` = `Home2`.`id`')
			),
			
			
			array('table' => 'app_users',
					'alias' => 'Employee',					
					'type' => 'LEFT',
					'conditions' => array('`FinExpApprove`.`app_users_id` = `Employee`.`id`')
			)
		);
		
		$this->FinExpApprove->virtualFields = array('first_name' => 'Home2.first_name', 'status_id' => 'FinExpStatuses.id' );
		
		//$this->FinExpApprove->virtualFields['status_id'] = 'FinExpStatuses.id';

		// find the department
		if($this->Session->read('USER.Login.hr_department_id') == '4'){
			$this->FinExpApprove->unBindModel(array('hasOne' => array('FinExpUser')));
			$this->paginate = array('fields' => array('id', 'fin_advance_id', 'amount','expense_no','created_date','max(FinExpStatuses.id) as status_id','group_concat(FinExpStatuses.status) as st_status', 'FinExpStatuses.id',  'group_concat(FinExpStatuses.created_date) as st_created','group_concat(FinExpStatuses.modified_date) as st_modified', 'TskCustomer.company_name','Employee.first_name', 'Employee.last_name', 'Employee.id', 'group_concat(Homes.first_name) as st_user', 'Home2.first_name', 'approve_date', 'approve_status',  'TskProject.project_name'),'limit' => 10,'conditions' => array($empCond, $exp_cond,'FinExpApprove.is_deleted' => 'N', 'FinExpApprove.is_draft' => 'N'),  'group' => array('FinExpApprove.id'), 'order' => array('created_date' => 'desc'), 'joins' => $options);
			
		}else{			
			$this->paginate = array('fields' => array('id','fin_advance_id', 'amount','expense_no','created_date','max(FinExpStatuses.id) as status_id','group_concat(FinExpStatuses.status) as st_status', 'group_concat(Homes.first_name) as st_user', 'group_concat(FinExpStatuses.created_date) as st_created', 'group_concat(FinExpStatuses.modified_date) as st_modified', 'TskCustomer.company_name', 'TskProject.project_name','Homes.id', 'approve_status', 'Home2.first_name', 'Home2.last_name','Employee.first_name', 'Employee.last_name', 'Employee.id','approve_date'),'limit' => 10,'conditions' => array($empCond, $exp_cond,'FinExpUser.app_users_id' => $this->Session->read('USER.Login.id'), 'FinExpApprove.is_deleted' => 'N','FinExpApprove.is_draft' => 'N'),  'group' => array('FinExpApprove.id'), 'order' => array('is_approve' => 'asc', 'created_date' => 'desc'), 'joins' => $options);
		}
		$data = $this->paginate('FinExpApprove');
	
		$this->set('exp_data', $data);
		// hide verify icon display
		foreach($data as $fin_exp){
			$show_st = $this->auth_action($fin_exp['FinExpApprove']['id'], $fin_exp[0]['status_id'], 0, $fin_exp['FinExpApprove']['approve_status']);			
			$status_id[] = $show_st;				
		}
		$this->set('show_status', $status_id);
		
		
		if(empty($data)){
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>You have no expenses to approve', 'default', array('class' => 'alert alert'));	
		}
		
		
	}
	
	
	function notify_employee($exp_id, $user_id){	
		// get user data
		$user_data = $this->FinExpApprove->Home->find('first', array('conditions' => array('Home.id' => $user_id),'fields' => array('email_address','first_name', 'last_name')));
		// get expense data
		$exp_data = $this->FinExpApprove->findById($exp_id, array('fields' => 'amount','TskProject.project_name', 'TskCustomer.company_name', 'expense_no'));
		$vars = array('from_name' => $this->Session->read('USER.Login.first_name').' '.$this->Session->read('USER.Login.last_name') ,'name' => ucfirst($user_data['Home']['first_name']).' '.ucfirst($user_data['Home']['last_name']), 'project' => $exp_data['TskProject']['project_name'], 'company' => $exp_data['TskCustomer']['company_name'], 'amt' => $exp_data['FinExpApprove']['amount'], 'exp_no' => $exp_data['FinExpApprove']['expense_no']);
		
		if(!$this->send_email('My PDCA - Your expense request is processed by '.ucfirst($this->Session->read('USER.Login.first_name')).' '.ucfirst($this->Session->read('USER.Login.last_name')), 'notify_expense', 'noreply@mypdca.in', $user_data['Home']['email_address'],$vars)){		
			// show the msg.								
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in sending the mail to user...', 'default', array('class' => 'alert alert-error'));				
		}else{								
			
		}
		
		// reject bills
		$result = $this->update_bills($exp_id);
		
			// send mail to user
		if($result == 'fail'){						
			$vars = array('from_name' =>  $this->Session->read('USER.Login.first_name').' '.$this->Session->read('USER.Login.last_name'), 'exp_no' => $exp_data['FinExpApprove']['expense_no'],'project' => $exp_data['TskProject']['project_name'], 'name' => ucfirst($user_data['Home']['first_name']).' '.ucfirst($user_data['Home']['last_name']), 'company' => $exp_data['TskCustomer']['company_name'], 'amt' => $exp_data['FinExpApprove']['amount'], 'exp_no' => $exp_data['FinExpApprove']['expense_no']);
			// notify superiors						
			if(!$this->send_email('Bills rejected in expense submission - '.$exp_data['FinExpApprove']['expense_no'], 'expense_reject', 'noreply@mypdca.in', $user_data['Home']['email_address'],$vars)){		
			// show the msg.								
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in sending mail to user...', 'default', array('class' => 'alert alert-error'));				
			}
		}
			
	}	
		
	
	/* function to process the advance */
	public function process_adv($exp_id,$user_id,$status,$st_id){
		if($this->Session->read('USER.Login.hr_department_id') == '4' && $status == 'A'){
			// update expense status of finance		
			$exp_approve_data = array('id' => $exp_id, 'approve_status' => 'A', 'approve_date' => $this->Functions->get_current_date(),'approve_by' => $this->Session->read('USER.Login.id'));			
			$this->FinExpApprove->id = $exp_id;
			$this->FinExpApprove->save($exp_approve_data, true, $fieldList = array('approve_status','approve_date', 'approve_by'));
			$this->notify_employee($exp_id, $user_id);
			// close the expense here
			$this->FinExpApprove->id = $exp_id;
			$this->FinExpApprove->saveField('is_approve', 'Y');	
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Expense request is processed successfully', 'default', array('class' => 'alert alert-success'));
		}else{
			$data = array('modified_date' => $this->Functions->get_current_date(), 'modified_by' => $this->Session->read('USER.Login.id'), 'status' => 'A');
			$this->FinExpApprove->FinExpStatus->id = $st_id;	
			// make sure not duplicate status exists
			$this->check_duplicate_status($exp_id, $this->Session->read('USER.Login.id'), 1);			
			// save the finance adv. status
			if($this->FinExpApprove->FinExpStatus->save($data, true, $fieldList = array('modified_by','modified_date','status'))){
				$this->loadModel('Approval');			
				$approval_data = $this->Approval->find('first', array('fields' => array('level2'), 'conditions'=> array('Approval.app_users_id' => $user_id, 'type' => 'E')));				
				// get superior level  details				
				$superior_data = $this->FinExpApprove->Home->find('first', array('conditions' => array('Home.is_deleted' => 'N', 'Home.status' => '1', 'Home.id' => $approval_data['Approval']['level2']),'fields' => array('email_address','first_name', 'last_name')));
				$this->notify_employee($exp_id, $user_id);	
				if(!empty($exp_id) && intval($exp_id)){			
					if(!empty($approval_data['Approval']['level2'])){
						// if has superior
						if(!empty($superior_data) && $approval_data['Approval']['level2'] != $this->Session->read('USER.Login.id')){
							// chk duplicate user
							$this->check_duplicate_user($exp_id,  $approval_data['Approval']['level2']);	
							// save expense users
							$exp_user_data = array('fin_expenses_id' => $exp_id, 'app_users_id' => $approval_data['Approval']['level2']);							
							$this->FinExpApprove->FinExpUser->id = '';
							$this->FinExpApprove->FinExpUser->save($exp_user_data, true, $fieldList = array('fin_expenses_id','app_users_id'));
							
							$data = array('fin_expenses_id' => $exp_id, 'created_date' => $this->Functions->get_current_date(), 'app_users_id' => $approval_data['Approval']['level2']);
							// save level 2 if found
							$this->FinExpApprove->FinExpStatus->id = '';
							// make sure not duplicate status exists
							$this->check_duplicate_status($exp_id, $approval_data['Approval']['level2'], 0);	
							if($this->FinExpApprove->FinExpStatus->save($data, true, $fieldList = array('fin_expenses_id','created_date','app_users_id'))){	
															
							}else{
								$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in saving superior status...', 'default', array('class' => 'alert alert-error'));
							}
						}else{
							// close the expense request				
							$this->FinExpApprove->id = $exp_id;
							$this->FinExpApprove->saveField('approve_status', 'W');	
						}
					}else{
						// close the expense request				
						$this->FinExpApprove->id = $exp_id;
						$this->FinExpApprove->saveField('approve_status', 'W');				
					}			
				}
			}
						
		}
		
		$this->redirect('/finexpapprove/');	
		
	}
	
		/* function to check the duplicate user */
	public function check_duplicate_user($id, $user_id){
		$this->loadModel('FinExpUser');
		$count = $this->FinExpUser->find('count', array('conditions' => array('app_users_id' => $user_id, 'fin_expenses_id' => $id)));
		if($count > 0){	
			$this->invalid_attempt();
		}
	}
	
	
	/* function to check for duplicate entry */
	public function check_duplicate_status($exp_id, $app_user_id, $update){
		$count = $this->FinExpApprove->FinExpStatus->find('count',  array('conditions' => array('FinExpStatus.fin_expenses_id' => $exp_id, 'FinExpStatus.app_users_id' => $app_user_id)));
		// when the user is updating the request
		if($update){
			$cnt_cond = 1;
		}else{
			$cnt_cond = 0;
		}
		if($count > $cnt_cond){
			$this->invalid_attempt();
		}
		
	}
	
	/* function to reject the bills */
	public function update_bills($exp_id){
		$bill_id = explode(',', $this->request->data['FinExpApprove']['hdnId']);
		
		
		// iterate the id
		$i = 1;
		foreach($bill_id as $id){
			// calculate approve amount
			$approve_amt += $this->request->data['FinExpList']['amtChk_'.$id];
			if($this->request->data['FinExpApprove']['verify_'.$id] == 1){
				$this->FinExpApprove->FinExpList->id = $id;
				$this->request->data['FinExpList']['reason'] = $this->request->data['FinExpApprove']['remarks_'.$id];
				$this->request->data['FinExpList']['status'] = 'R';
				$this->request->data['FinExpList']['approve_by'] = $this->Session->read('USER.Login.id');
				// calculate reject amt
				$reject_amt += $this->request->data['FinExpList']['amtChk_'.$id];
				
				if($this->FinExpApprove->FinExpList->save($this->request->data)){					
					// once saved
					$i++;
				}
			}
		}
		
		
		// if any rejection happens
		if($i > 1){
			// update the amount
			$this->FinExpApprove->id = $exp_id;
			$amount = $approve_amt - $reject_amt;
			$this->FinExpApprove->saveField('amount', $amount);			
			return 'fail';
		}else{
			return 'pass';
		}
		
	}
	
	
	/* function to auth record */
	public function auth_action($id,$st_id,$view,$app_status){
		
		$data = $this->FinExpApprove->FinExpStatus->findById($st_id, array('fields' => 'app_users_id', 'status'));		
		// check the req belongs to the user
		/*
		if($this->Session->read('USER.Login.hr_department_id') == '4' && $app_status == 'A' 
		&& $data['FinExpStatus']['app_users_id'] != $this->Session->read('USER.Login.id')){
			return 'view_only';
		}
		else if($this->Session->read('USER.Login.hr_department_id') == '4'){
			return 'pass';
		}		
		else */
		if($this->Session->read('USER.Login.hr_department_id') == '4' && $app_status == 'W'  && $data['FinExpStatus']['status'] == 'A'){
			return 'pass';
		}else if($data['FinExpStatus']['app_users_id'] == $this->Session->read('USER.Login.id') && $data['FinExpStatus']['status'] == 'W'){	
			return 'pass';
		}else if($app_status == 'W' && $this->Session->read('USER.Login.hr_department_id') == '4'){ // for old records when Fin. first approves
			return 'pass';
		}else if($view == 1){ // for view mode only
			$data = $this->FinExpApprove->FinExpStatus->find('first', array('fields' => array('app_users_id'), 'conditions' => array('app_users_id' => $data['FinExpStatus']['app_users_id'], 'fin_expenses_id' => $id), 'limit' => 1));
			if(!empty($data)){
				return 'view_only';
			}else if($app_status == 'W' && $this->Session->read('USER.Login.hr_department_id') == '4'){
				return 'pass';
			}
		}else if($this->Session->read('USER.Login.hr_department_id') == '4'){
			return 'view_only';
		}else{
			return 'fail';
		}
	}
	
	/* function to view the adv. request */
	public function view_expense($id,$user_id, $st_id){
		// set the page title		
		$this->set('title_for_layout', 'Expense Request - Approve/Reject - Finance - My PDCA');
		if(!empty($id) && intval($id)){
			$view = 1;			
			$this->request->data = $this->FinExpApprove->findById($id, array('fields' =>'TskProject.project_name', 'amount','fin_advance_id','FinAdvance.amount', 'TskCustomer.company_name, FinExpApprove.id, FinExpApprove.amount, expense_no', 'approve_status','FinExpApprove.created_date','Home.first_name', 'Home.last_name'));
			// authorize user before action
			$ret_value = $this->auth_action($id,$st_id, $view,$this->request->data['FinExpApprove']['approve_status']);
			
			if($ret_value == 'pass' || $ret_value == 'view_only'){	
				$this->load_static_data();				
				$data = $this->FinExpApprove->FinExpList->find('all', array('fields' => array('id', 'bill_avail', 'billable', 'date_exp','amount','description','bill_refno','fin_expenses_id', 'fin_exp_category_id','FinExpCat.category'), 'conditions' => array('FinExpList.fin_expenses_id' => $id, 'FinExpList.status' => 'W'), 'order' => array('FinExpList.date_exp' => 'asc')));				
				$this->set('exp_list', $data);
				// for export option
				if($this->request->query['action'] == 'export'){ 
					$this->Excel->generate('expense', $data, $this->request->data, 'Report', 'Expense Report - '.$this->request->data['FinExpApprove']['expense_no']);
					die;
				}
				// check for Finance auth
				$data = $this->FinExpApprove->FinExpStatus->findById($st_id, array('fields' => 'status'));
				$this->set('rec_status', $data['FinExpStatus']['status']);
				if($ret_value == 'view_only'){
					$this->set('READ_ONLY', 'readonly');
					$this->set('DISABLED', 'disabled');
					$this->set('VIEW_ONLY', 1);
				}
			}else if($ret_value == 'fail'){ 
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/finexpapprove/');	
			}else{
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Record Deleted: '.$ret_value , 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/finexpapprove/');	
			}
		}else{
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));		
			$this->redirect('/finexpapprove/');	
		}
		
		
	}
	
	
		/* function to view the adv. request */
	public function view_advance($id){
		// set the page title		
		$this->layout = 'iframe';
		if(!empty($id) && intval($id)){				
			$data = $this->FinExpApprove->FinAdvance->findById($id, array('fields' => 'purpose','description','amount','req_date'));
			$this->set('adv_data', $data);	
		}else{
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));		
			$this->redirect('/finadvance/');	
		}
		
	}
	
	/* function to load static data */
	public function load_static_data(){
		// fetch the companies
		$comp_list = $this->FinExpApprove->TskCustomer->find('list', array('fields' => array('id','company_name'), 'order' => array('company_name ASC'),'conditions' => array('is_deleted' => 'N')));
		$this->set('compList', $comp_list);
		// fetch the projects
		$proj_list = $this->FinExpApprove->TskProject->find('list', array('fields' => array('id','project_name'), 'order' => array('project_name ASC'),'conditions' => array('is_deleted' => 'N')));
		$this->set('projList', $proj_list);
		// fetch the categories
		$this->loadModel('FinExpCat');
		$cat_list = $this->FinExpCat->find('list', array('fields' => array('id','category'), 'order' => array('category ASC'),'conditions' => array('is_deleted' => 'N')));
		$this->set('catList', $cat_list);
		
	}
	
	/* clear the cache */
	
	public function beforeFilter() { 
		//$this->disable_cache();
		$this->show_tabs(4);
		// check module access
		
	}
	
	
		/* auto complete search */
	public function search(){ 
		$this->layout = false;	 
		$q = trim(Sanitize::escape($_GET['q']));	
		if(!empty($q)){
			// execute only when the search keywork has value		
			$this->set('keyword', $q);
			$data = $this->FinExpApprove->find('all', array('fields' => array('TskProject.project_name', 'TskCustomer.company_name','FinExpApprove.expense_no'),  'group' => array('TskProject.project_name', 'FinExpApprove.expense_no','TskCustomer.company_name'), 'conditions' => 	$conditions =  array("OR" => array ('TskProject.project_name like' => '%'.$q.'%', 'TskCustomer.company_name like' => '%'.$q.'%', 'FinExpApprove.expense_no like' => '%'.$q.'%'), 'AND' => array('FinExpApprove.is_deleted' => 'N'))));		
			$this->set('results', $data);			
		}
    }
		
	
	
	
}