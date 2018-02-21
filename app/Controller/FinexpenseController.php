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
class FinExpenseController extends AppController {  
	
	public $name = 'FinExpense';	
	
	public $helpers = array('Html', 'Form', 'Session');
	
	public $components = array('Session', 'Functions', 'Excel');
	
	public $layout = 'apps';

	public $exp_type, $fn_type, $tot_amount;	

	/* function to list the adv. requests */
	public function index(){	
		// set the page title
		$this->set('title_for_layout', $this->exp_type.' - Finance - My PDCA');
		$exp_type = $this->fn_type == 'draft' ? 'Y' : 'N';	
		// when the form is submitted for search
		if($this->request->is('post')){
			if(!empty($this->fn_type)){
				$srch_url = '&type='.$this->fn_type;
			}
			$url_vars = $this->create_url(array('keyword')); 
			$this->redirect('/finexpense/?'.$url_vars.$srch_url);			
		}
		// search with expense no.
		if(intval($this->params->query['keyword'])){
				$exp_cond = array('FinExpense.expense_no' => $this->params->query['keyword']); 
		}
		else if($this->params->query['keyword'] != ''){
			$keyCond = array("MATCH (TskProject.project_name, TskCustomer.company_name) AGAINST ('".$this->params->query['keyword']."' IN BOOLEAN MODE)");			
		}
		
		//$this->set('srchStat', $this->Functions->get_search_status());
		
		$this->FinExpense->unBindModel(array('hasOne' => array('FinExpStatus', 'FinExpList')));
		$this->FinExpense->unBindModel(array('belongsTo' => array('Home')));
		
		// discrepancy condition
		if($this->fn_type == 'discrepancy'){
			$dis_cond = array('FinExpList.status' => 'R');
			$this->FinExpense->bindModel(
			array('hasOne' => array(
					'FinExpList' => array(
						'className' => 'FinExpList',
						'foreignKey' => 'fin_expenses_id'
						)
					)
				)
			);	
		}		
		
		$options = array(			
			array('table' => 'fin_exp_status',
					'alias' => 'FinExpStatuses',					
					'type' => 'LEFT',
					'conditions' => array('`FinExpStatuses`.`fin_expenses_id` = `FinExpense`.`id`')
			),
			array('table' => 'app_users',
					'alias' => 'Homes',					
					'type' => 'LEFT',
					'conditions' => array('`FinExpStatuses`.`app_users_id` = `Homes`.`id`',
					'FinExpStatuses.id' != '')
			),
			
			array('table' => 'app_users',
					'alias' => 'Home2',					
					'type' => 'LEFT',
					'conditions' => array('`FinExpense`.`approve_by` = `Home2`.`id`')
			),
			
		);
		// fetch the advances		
		$this->paginate = array('fields' => array('fin_advance_id','is_draft','id','expense_no', 'FinExpense.amount', 'Home2.first_name', 'approve_status','approve_date', 'approve_by','TskProject.project_name','TskCustomer.company_name','created_date','modified_date','group_concat(FinExpStatuses.status) as st_status', 'group_concat(FinExpStatuses.created_date) as st_created','group_concat(FinExpStatuses.modified_date) as st_modified', 'group_concat(Homes.first_name) as st_user'),'limit' => 10,'conditions' => array($keyCond, $dis_cond, $exp_cond, 'FinExpense.app_users_id' => $this->Session->read('USER.Login.id'),'FinExpense.is_deleted' => 'N', 'is_draft' => $exp_type, 'FinExpense.expense_no !=' => ''), 'order' => array('created_date' => 'desc', 'FinExpStatuses.created_date' => 'asc'), 'group' => array('FinExpense.id'), 'joins' => $options);
		$data = $this->paginate('FinExpense');	
		//echo '<pre>'; print_r($data);
		$this->set('exp_data', $data);
		if(empty($data)){			
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>You have no '. $this->fn_type.' expenses', 'default', array('class' => 'alert alert'));	
		}
		
		
	}
	
	/* function to create url variables */
	public function create_url($url){	
		$count = count($url) - 1;
		foreach($url  as $key => $param){ 			
			if(!empty($this->request->data['FinExpense'][$param])){				
				$url_var .= $param.'='.$this->request->data['FinExpense'][$param].'&';
			}
		}
		$url_var = substr($url_var, 0, strlen($url_var)-1);
		return $url_var;
	}
	
	/* functions to get project of company */
	public function get_projects(){
		$this->layout = 'refresh';		
		$id = $this->request->query['id'];
		// show only project lead
		if(strstr($this->referer(), 'tskteamassign')){
			$proj_cond = array('TskProject.project_leader' => $this->Session->read('USER.Login.id'));
		}
		// show only project lead or project member
		if(strstr($this->referer(), 'tskplan') || strstr($this->referer(), 'tskassign') || strstr($this->referer(), 'tskteamplan')){	
			$this->FinExpense->TskProject->bindModel(
			array('hasOne' => array(
					'TskProjectMember' => array(
						'className' => 'TskProjectMember',
						'foreignKey' => 'tsk_projects_id',
						'type' => 'INNER'
						)
					)
				)
			);			
			
			$proj_cond = array('or' => array('TskProject.project_leader' => $this->Session->read('USER.Login.id'), 'TskProjectMember.app_users_id' => $this->Session->read('USER.Login.id')));
		}
		

		$data = $this->FinExpense->TskProject->find('all', array('fields' => array('id','project_name'), 'conditions' => array('TskProject.is_deleted' => 'N', 'tsk_company_id' => $id, $proj_cond), 'order' => array('project_name' => 'asc'),
		'group' => array('TskProject.id')));		
		$options .= "<option value=''>Select</option>";
		foreach($data as $proj){ 
			$options .= "<option value=".$proj['TskProject']['id'].">".$proj['TskProject']['project_name']."</option>";
		}	
		echo $options;
		$this->render(false);
		die;
	}
	
		/* function to check for duplicate entry */
	public function check_duplicate_status($exp_id, $app_user_id, $update){
		$this->loadModel('FinExpStatus');
		$count = $this->FinExpStatus->find('count',  array('conditions' => array('FinExpStatus.fin_expenses_id' => $exp_id, 'FinExpStatus.app_users_id' => $app_user_id)));
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
	
	/* function to save the advance */
	public function create_expense(){ 
		// set the page title		
		$this->set('title_for_layout', 'Create Expense - Finance - My PDCA');	
		$this->load_static_data();
		$this->load_advances();
		if ($this->request->is('post')){  
			// validates the form
			$this->FinExpense->set($this->request->data);		
			$this->request->data['FinExpense']['app_users_id'] = $this->Session->read('USER.Login.id');
			$this->request->data['FinExpense']['created_date'] = $this->Functions->get_current_date();
			$this->request->data['FinExpense']['is_draft'] = !empty($this->request->data['FinExpense']['draft']) ?  'Y' : 'N';
			$this->request->data['FinExpense']['expense_no'] = $this->calculate_expno();
			$msg = $this->request->data['FinExpense']['is_draft'] == 'Y' ? 'Expense saved as draft successfully' : 'Expense submitted successfully';
			// save the data
			if($this->FinExpense->save($this->request->data['FinExpense'])) {
				// save expense list
				$list_count1 = $this->save_expense_list($this->FinExpense->id);				
				// save dynamic expense list
				$list_count2 = $this->save_dynamic_expense_list($this->FinExpense->id);				
				$total_list = $list_count1 + $list_count2;				
				// update the amount
				$this->FinExpense->saveField('amount', $this->tot_amount);				
				//$this->send_mail_finance($this->request->data['FinExpense']['expense_no']);
				if($this->request->data['FinExpense']['is_draft'] == 'N'){
					$this->process_expense($this->FinExpense->id);
				}				
				// show the msg.
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>'.$msg, 'default', array('class' => 'alert alert-success'));
				
			}else{
				// show the error msg.
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in saving the data...', 'default', array('class' => 'alert alert-error'));					
			}				
			$action = $this->request->data['FinExpense']['is_draft'] == 'Y' ? '?type=draft' : '';
			$this->redirect('/finexpense/'.$action);					
		}						
	}
	
	/* function to load the user advances */
	public function load_advances(){
		$this->loadModel('FinAdvance');
		$data = $this->FinAdvance->find('all', array('fields' => array('FinAdvance.id', 'FinAdvance.amount'), 'conditions' => array('FinAdvance.app_users_id' => $this->Session->read('USER.Login.id'), 'FinAdvance.is_deleted' => 'N', 'is_approve' => 'Y'), 'order' => array('FinAdvance.id' => 'desc')));
		foreach($data as $rec){
			$adv_no[$rec['FinAdvance']['id']] = $this->Functions->get_adv_id($rec['FinAdvance']['id']).' - ₹'.$this->Functions->money_display($rec['FinAdvance']['amount']);
		}
		
		$this->set('advList', $adv_no);
	}
	
	/* function to send mail to finance */
	public function send_mail_finance($emp_no){
		// get the auth from finance department				
			$approval_data = $this->FinExpense->Home->find('all', array('fields' => array('email_address', 'first_name', 'last_name'), 'conditions'=> array('Home.hr_department_id' => '4', 'Home.status' => '1'), 'group' => array('Home.id')));	
					
			if($this->request->data['FinExpense']['is_draft'] == 'N'){
				// when finance users available
				if(!empty($approval_data)){
					//  get project and company
					$project_data = $this->FinExpense->TskProject->findById($this->request->data['FinExpense']['tsk_projects_id'], array('fields' => 'project_name'));
					$company_data = $this->FinExpense->TskCustomer->findById($this->request->data['FinExpense']['tsk_company_id'], array('fields' => 'company_name'));					
					// iterate the fin. users
					
					foreach($approval_data as $fin_data){ 
						$vars = array('from_name' => ucfirst($this->Session->read('USER.Login.first_name')).' '.ucfirst($this->Session->read('USER.Login.last_name')),'name' => $fin_data['Home']['first_name'].' '.$fin_data['Home']['last_name'], 'project' => $project_data['TskProject']['project_name'], 'company' => $company_data['TskCustomer']['company_name'], 'amt' => $this->tot_amount, 'exp_no' => $emp_no);
						// notify superiors						
						if(!$this->send_email('My PDCA - '.ucfirst($this->Session->read('USER.Login.first_name')).' '.ucfirst($this->Session->read('USER.Login.last_name')).' submitted expense request!', 'expense_creation', 'noreply@mypdca.in', $fin_data['Home']['email_address'],$vars)){	
							// show the msg.								
							$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in sending the mail...', 'default', array('class' => 'alert alert-error'));				
						}else{
										
						}
					}
				}else{
						$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>You have no superior to approve your request', 'default', array('class' => 'alert alert-info'));
				}
			}
	}

	
	/* function to save expense lists */
	public function save_expense_list($exp_id){
		$saved_list = 0;
		if($this->request->data['FinExpense']['page'] == 'edit'){
			$start = 0;
			$count = $this->request->data['FinExpense']['rec_count'];
		}else{
			$start = 1;
			$count = 4;
		}
		for($i = $start; $i <= $count; $i++){
			if($this->request->data['FinExpense']['date_exp_o'.$i] != '' && $this->request->data['FinExpense']['fin_exp_category_id_o'.$i] != '' && $this->request->data['FinExpense']['amount_o'.$i] != ''){
				$this->FinExpense->FinExpList->id = '';
				$data = array('fin_expenses_id' => $exp_id, 'date_exp' => $this->Functions->format_date_save($this->request->data['FinExpense']['date_exp_o'.$i]), 'fin_exp_category_id' => $this->request->data['FinExpense']['fin_exp_category_id_o'.$i],'bill_refno' => $this->request->data['FinExpense']['bill_refno_o'.$i],'billable' => $this->request->data['FinExpense']['billable_o'.$i],'amount' => $this->request->data['FinExpense']['amount_o'.$i],'description' => $this->request->data['FinExpense']['description_o'.$i],'bill_avail' => $this->request->data['FinExpense']['bill_avail_o'.$i]);
				$this->FinExpense->FinExpList->save($data, true, $fieldList = array('fin_expenses_id','date_exp','fin_exp_category_id','bill_refno','billable','amount','description','bill_avail'));
				// sum the amount
				$this->tot_amount += $this->request->data['FinExpense']['amount_o'.$i];
				$saved_list++;
			}
		}
		
		$this->request->data['FinExpense']['amount'] = $this->tot_amount;
		return $saved_list;
	}
	
	/* function to delete the expense */
	public function delete_expense($id){ 
		$this->FinExpense->id = $id;
		$this->FinExpense->saveField('is_deleted', 'Y');
		// remove expense lists
		$this->remove_expense_list($id);
		// show the msg.
		$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Draft Expense deleted successfully', 'default', array('class' => 'alert alert-success'));	
		$this->redirect('/finexpense/?type=draft');	
		
	}
	
		/* function to save expense lists */
	public function save_dynamic_expense_list($exp_id){ 
		$saved_list = 0;
		for($i = 0; $i < $this->request->data['FinExpense']['form_count']; $i++){
			if($this->request->data['FinExpense']['date_exp_'.$i] != ''  && $this->request->data['FinExpense']['fin_exp_category_id_'.$i] != '' && $this->request->data['FinExpense']['amount_'.$i] != ''){
				$this->FinExpense->FinExpList->id = '';
				$data = array('fin_expenses_id' => $exp_id, 'date_exp' => $this->Functions->format_date_save($this->request->data['FinExpense']['date_exp_'.$i]), 'fin_exp_category_id' => $this->request->data['FinExpense']['fin_exp_category_id_'.$i],'bill_refno' => $this->request->data['FinExpense']['bill_refno_'.$i],'billable' => $this->request->data['FinExpense']['billable_'.$i],'amount' => $this->request->data['FinExpense']['amount_'.$i],'description' => $this->request->data['FinExpense']['description_'.$i],'bill_avail' => $this->request->data['FinExpense']['bill_avail_'.$i]);
				$this->FinExpense->FinExpList->save($data, true, $fieldList = array('fin_expenses_id','date_exp','fin_exp_category_id','bill_refno','billable','amount','description','bill_avail'));
				
				// sum the amount
				$this->tot_amount += $this->request->data['FinExpense']['amount_'.$i];
				$saved_list++;
			}
		}
			
		return $saved_list;
	}
	
	
	/* function to calculate the exp. no */
	public function calculate_expno(){
		$data = $this->FinExpense->find('first', array('fields' => array('expense_no'), 'limit' => 1, 'order' => array('FinExpense.created_date' => 'desc')));
		if(empty($data)){
			return 101;
		}else{
			return $data['FinExpense']['expense_no'] + 1;
		}
		
	}
	
	/* function to load static data */
	public function load_static_data(){
		// fetch the companies
		$comp_list = $this->FinExpense->TskCustomer->find('list', array('fields' => array('id','company_name'), 'order' => array('company_name ASC'),'conditions' => array('is_deleted' => 'N', 'status' => '1')));
		$this->set('compList', $comp_list);
		// fetch the projects	
		if($this->request->params['action'] == 'edit_expense'){
			$comp_cond = array('tsk_company_id' => $this->request->data['FinExpense']['tsk_company_id']);
		}
		$proj_list = $this->FinExpense->TskProject->find('list', array('fields' => array('id','project_name'), 'order' => array('project_name ASC'),'conditions' => array('is_deleted' => 'N', $comp_cond)));
		$this->set('projList', $proj_list);
		// fetch the categories
		$this->loadModel('FinExpCat');
		$cat_list = $this->FinExpCat->find('list', array('fields' => array('id','category'), 'order' => array('category ASC'),'conditions' => array('is_deleted' => 'N', 'status' => '1')));
		$this->set('catList', $cat_list);
		
	}
	
	
	
	
		/* function to edit the advance */
	public function edit_expense($id){ 
		// set the page title		
		$this->set('title_for_layout', 'Edit '.$this->exp_type.'  - Finance - My PDCA');
		if(!empty($id) && intval($id)){
			// authorize user before action
			$ret_value = $this->auth_action($id);
			if($ret_value == 'pass'){
				if (!empty($this->request->data)){  
					$this->load_static_data();
					// validates the form
					$this->FinExpense->set($this->request->data);			
					$this->request->data['FinExpense']['modified_date'] = $this->Functions->get_current_date();
					$this->request->data['FinExpense']['is_draft'] = !empty($this->request->data['FinExpense']['draft']) ?  'Y' : 'N';
					$msg = $this->request->data['FinExpense']['is_draft'] == 'Y' ? 'Draft expense modified successfully' : 'Expense request modified successfully';
					// save the data
					if($this->FinExpense->save($this->request->data['FinExpense'])) {
						// remove expense lists
						$this->update_expense_list($id);
						// save expense list
						$this->save_expense_list($id);	
						// save dynamic expense list
						$this->save_dynamic_expense_list($id);
						// remove expense lists
						$this->remove_expense_list($id);					
						// update the amount
						$this->FinExpense->saveField('amount', $this->tot_amount);					
						$action = $this->request->data['FinExpense']['is_draft'] == 'Y' ? '?type=draft' : '';
						
						// send mail to finance if save				
						
						if($this->request->data['FinExpense']['is_draft'] == 'N'){
							//$this->send_mail_finance($this->request->data['FinExpense']['expense_no']);
							$this->process_expense($id);
						}
						$msg = $this->request->data['FinExpense']['is_draft'] == 'Y' ? 'Expense saved as draft successfully' : 'Expense submitted successfully';
						
						$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>'.$msg, 'default', array('class' => 'alert alert-success'));	
						$this->redirect('/finexpense/'.$action);					
					}else{
						// show the error msg.
						$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in saving the data...', 'default', array('class' => 'alert alert-error'));					
					}						
				}else{
					$this->request->data = $this->FinExpense->findById($id);
					$this->load_static_data();
					$this->load_advances();
					

					$data = $this->FinExpense->FinExpList->find('all', array('fields' => array('bill_avail', 'billable', 'date_exp','amount','description','bill_refno','fin_expenses_id', 'fin_exp_category_id'), 'conditions' => array('FinExpList.fin_expenses_id ' => $id), 'order' => array('FinExpList.date_exp' => 'asc')));					
					$this->set('exp_list', $data);					
				}
			}else if($ret_value == 'fail'){ 
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/finexpense/');	
			}else{
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Record Deleted: '.$ret_value , 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/finexpense/');	
			}
		}else{
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));		
			$this->redirect('/finexpense/');	
		}
	}
	
	/* function to process the expense */
	public function process_expense($exp_id){
		// get the superiors
		$this->loadModel('Approval');
		$approval_data = $this->Approval->find('first', array('fields' => array('level1'), 'conditions'=> array('Approval.app_users_id' => $this->Session->read('USER.Login.id'), 'type' => 'A')));
		// save finance req. status data
		$this->loadModel('FinExpStatus');
		$data = array('fin_expenses_id' => $exp_id, 'created_date' => $this->Functions->get_current_date(), 'app_users_id' => $approval_data['Approval']['level1']);
		if(!empty($approval_data)){
			// make sure not duplicate status exists
			$this->check_duplicate_status($exp_id, $approval_data['Approval']['level1'], 0);
			// save in adv. status table
			if($this->FinExpStatus->save($data, true, $fieldList = array('fin_expenses_id','created_date','app_users_id'))){						
				// save exp. users
				$this->loadModel('FinExpUser');
				$exp_user_data = array('fin_expenses_id' => $exp_id, 'app_users_id' => $approval_data['Approval']['level1']);							
				$this->FinExpUser->id = '';
				$this->FinExpUser->save($exp_user_data, true, $fieldList = array('fin_expenses_id','app_users_id'));
				// update approve status for finance department
				$data = $this->FinExpense->Home->findById($approval_data['Approval']['level1'], array('fields' => 'hr_department_id'));
				if($data['Home']['hr_department_id'] == '4'){
					$this->FinExpense->id = $exp_id;
					$this->FinExpense->saveField('approve_status', 'W');	
				}
				
			}
		}
	}
	
	/* function to remove the exp. list */
	public function remove_expense_list($id){
		// save in temp table
		$this->save_exp_temp($id);
		$this->FinExpense->FinExpList->deleteAll(array('fin_expenses_id' => $id, 'del_status' => '1'), false);
	}
	
	/* save deleted expense in temp. table */
	public function save_exp_temp($id){
		$data = $this->FinExpense->FinExpList->find('all', array('conditions' => array('fin_expenses_id' => $id, 'del_status' => '1'), 'fields' => array('date_exp', 'description','amount','billable','bill_avail',
		'fin_exp_category_id', 'fin_expenses_id','bill_refno')));
		$this->loadModel('FinExpTemp');
		// remove all prev. data
		$this->FinExpTemp->deleteAll(array('fin_expenses_id' => $id), false);
		// iterate and save in temp table
		foreach($data as $expense){
			$this->FinExpTemp->id = '';
			$temp_ar = array('date_exp' => $expense['FinExpList']['date_exp'],'description' => $expense['FinExpList']['description'],'amount' => $expense['FinExpList']['amount'],'billable' => $expense['FinExpList']['billable'],
			'bill_refno' => $expense['FinExpList']['bill_refno'], 'fin_expenses_id' => $id, 'bill_avail' => $expense['FinExpList']['bill_avail'],'fin_exp_category_id' => $expense['FinExpList']['fin_exp_category_id'],
			'created_date' => $this->Functions->get_current_date());
			$this->FinExpTemp->save($temp_ar, false);
		}
	}
	
	/* function to remove the exp. list */
	public function update_expense_list($id){
		$this->FinExpense->FinExpList->updateAll(array('del_status' => "'1'"),  array('fin_expenses_id' => $id));
	}
	
	
	/* function to auth record */
	public function auth_action($id){ 	
		$data = $this->FinExpense->findById($id, array('fields' => 'app_users_id','is_deleted','modified_date'));	
		// check the req belongs to the user
		if($data['FinExpense']['is_deleted'] == 'Y'){
			return $data['FinExpense']['modified_date'];
		}		
		else if($data['FinExpense']['app_users_id'] == $this->Session->read('USER.Login.id')){	
			return 'pass';
		}else{
			return 'fail';
		}
	}
	
	/* function to view the adv. request */
	public function view_expense($id){
		// set the page title		
		$this->set('title_for_layout', 'View Expense - Finance - My PDCA');
		if(!empty($id) && intval($id)){
			// authorize user before action
			$ret_value = $this->auth_action($id);
			if($ret_value == 'pass'){	
				//$this->load_static_data();
				// discrepancy condition
				if($this->fn_type == 'discrepancy'){
					$dis_cond = array('FinExpList.status' => 'R');
				}	
				
				$this->request->data = $this->FinExpense->findById($id, array('fields' =>'TskProject.project_name, TskCustomer.company_name, FinExpense.id, Home.first_name, Home.last_name, FinExpense.created_date, FinExpense.amount, expense_no,approve_status,is_draft'));
				// for approved requests
				if($this->fn_type != 'discrepancy'){
					$approve_cond = array('FinExpList.status !=' => 'R');
				}
				
				$data = $this->FinExpense->FinExpList->find('all', array('fields' => array('bill_avail', 'billable', 'date_exp','amount','description','bill_refno','fin_expenses_id', 'reason', 'fin_exp_category_id','FinExpCat.category'), 'conditions' => array($dis_cond,$approve_cond,'FinExpList.fin_expenses_id ' => $id), 'order' => array('FinExpList.date_exp' => 'asc')));
				
				$this->set('exp_list', $data);
				
				// for export option
				if($this->request->query['action'] == 'export'){ 
					$this->Excel->generate('expense', $data, $this->request->data, 'Report', 'Expense Report - '.$this->request->data['FinExpense']['expense_no']);
					die;
				}	
			}else if($ret_value == 'fail'){ 
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/finexpense/');	
			}else{
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Record Deleted: '.$ret_value , 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/finexpense/');	
			}
		}else{
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));		
			$this->redirect('/finexpense/');	
		}
		
		
	}
	
	/* clear the cache */
	
	public function beforeFilter() { 
		//$this->disable_cache();
		$this->show_tabs(3);
		$this->exp_type = $this->get_expense_type();
		$this->fn_type = ($this->exp_type == 'Draft Expense' ? 'draft' : ($this->exp_type == 'Discrepancy' ?  'discrepancy' : ''));
		$this->set('EXP_TYPE', $this->exp_type);
		if(!empty($this->fn_type)){
			$this->set('FN_TYPE', '?type='.$this->fn_type);
			$this->set('FN_NAME', $this->fn_type);
		}
		return $exp_type;
	}
	
		/* function to get approval type */
	public function get_expense_type(){
		return ($this->request->query['type'] == 'draft' ? 'Draft Expense' : ($this->request->query['type'] == 'discrepancy' ? 'Discrepancy' : 'My Expense'));
			
	}
	
	
		/* auto complete search */
	public function search(){ 
		$this->layout = false;	 
		$q = trim(Sanitize::escape($_GET['q']));	
		if(!empty($q)){
			// execute only when the search keywork has value		
			$this->set('keyword', $q);
			$data = $this->FinExpense->find('all', array('fields' => array('TskProject.project_name', 'TskCustomer.company_name','FinExpense.expense_no'),  'group' => array('TskProject.project_name', 'FinExpense.expense_no','TskCustomer.company_name'), 'conditions' => 	$conditions =  array("OR" => array ('TskProject.project_name like' => '%'.$q.'%', 'TskCustomer.company_name like' => '%'.$q.'%', 'FinExpense.expense_no like' => '%'.$q.'%'), 'AND' => array('FinExpense.is_deleted' => 'N', 'FinExpense.app_users_id' => $this->Session->read('USER.Login.id')))));		
			$this->set('results', $data);			
		}
    }
		
	
	
	
}