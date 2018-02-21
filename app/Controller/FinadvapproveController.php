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
class FinAdvApproveController extends AppController {  
	
	public $name = 'FinAdvApprove';	
	
	public $helpers = array('Html', 'Form', 'Session');
	
	public $components = array('Session', 'Functions');
	
	public $layout = 'apps';	

	/* function to list the adv. requests */
	public function index(){	
		// set the page title
		$this->set('title_for_layout', 'Approve Advance - Finance - My PDCA');
		
		// get employee list
		/*if($this->Session->read('USER.Login.hr_department_id') == '4'){
			$format_list = $this->FinAdvApprove->Home->find('list', array('fields' => array('Home.id', 'Home.full_name'), 'order' => array('Home.full_name' => 'asc')));
		}else{
		*/
			$emp_list = $this->FinAdvApprove->get_team($this->Session->read('USER.Login.id'),'A', '1');
			$format_list = $this->Functions->format_dropdown($emp_list, 'u','id','first_name', 'last_name');		
		//}
		$this->set('empList', $format_list);
		
		$options = array(			
			array('table' => 'fin_adv_status',
					'alias' => 'FinAdvStatuses',					
					'type' => 'LEFT',
					'conditions' => array('`FinAdvStatuses`.`fin_advance_id` = `FinAdvApprove`.`id`')
			),
			array('table' => 'app_users',
					'alias' => 'Homes',					
					'type' => 'LEFT',
					'conditions' => array('`FinAdvStatuses`.`app_users_id` = `Homes`.`id`')
			),
			
			array('table' => 'app_users',
					'alias' => 'Home2',					
					'type' => 'LEFT',
					'conditions' => array('`FinAdvApprove`.`app_users_id` = `Home2`.`id`')
			)
		);
			
		// when the form is submitted for search
		if($this->request->is('post')){
			$url_vars = $this->Functions->create_url(array('keyword','emp_id'),'FinAdvApprove'); 
			$this->redirect('/finadvapprove/?'.$url_vars);			
		}					
		$this->FinAdvApprove->unBindModel(array('hasOne' => array('FinAdvStatus')));
		
		if($this->params->query['keyword'] != ''){
			$keyCond = array("MATCH (purpose, description) AGAINST ('".$this->params->query['keyword']."' IN BOOLEAN MODE)"); 
		}
		if($this->params->query['emp_id'] != ''){
			$empCond = array('FinAdvApprove.app_users_id' => $this->params->query['emp_id']); 
		}
		
		$this->FinAdvApprove->virtualFields = array('first_name' => 'Home2.first_name');
		
		// fetch the advances		
		$this->paginate = array('fields' => array('id','purpose', 'amount','req_date','created_date','max(FinAdvStatuses.id) as status_id','group_concat(FinAdvStatuses.status) as st_status', 'group_concat(FinAdvStatuses.created_date) as st_created', 'group_concat(Homes.first_name) as st_user','group_concat(FinAdvStatuses.modified_date) as st_modified','group_concat(FinAdvStatuses.remarks) as st_remarks', 'Homes.id', 'Home2.id', 'Home2.first_name','Home2.last_name',  'Homes.first_name','Homes.last_name'),'limit' => 10,'conditions' => array($keyCond, $empCond,'FinAdvUser.app_users_id' => $this->Session->read('USER.Login.id'),'FinAdvApprove.is_deleted' => 'N'),  'group' => array('FinAdvApprove.id'), 'order' => array('is_approve' => 'asc', 'created_date' => 'desc'), 'joins' => $options);
		$data = $this->paginate('FinAdvApprove');
		
		$this->set('adv_data', $data);
		
		// hide verify icon display
		foreach($data as $fin_adv){ 
			$show_st = $this->auth_action($fin_adv['FinAdvApprove']['id'], $fin_adv[0]['status_id']);			
			$status_id[] = $show_st;				
		}
		$this->set('show_status', $status_id);
		
		if(empty($data)){
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>You have no advances to approve', 'default', array('class' => 'alert alert'));	
		}
		
		
	}
	
	/* function to process the advance */
	public function process_adv($adv_id, $st_id, $status,$user_id){ 
		$data = array('modified_date' => $this->Functions->get_current_date(), 'modified_by' => $this->Session->read('USER.Login.id'), 'remarks' => $this->request->query['remark'], 'status' => $status);
		$this->FinAdvApprove->FinAdvStatus->id = $st_id;
		$st_msg = $status == 'A' ? 'approved' : 'rejected';
		// make sure not duplicate status exists
		$this->check_duplicate_status($adv_id, $this->Session->read('USER.Login.id'), 1);
		// save the finance adv. status
		if($this->FinAdvApprove->FinAdvStatus->save($data, true, $fieldList = array('modified_by','modified_date','remarks','status'))){
			// get user data
			$user_data = $this->FinAdvApprove->Home->find('first', array('conditions' => array('Home.id' => $user_id),'fields' => array('email_address','first_name', 'last_name')));
			// get advance details
			$req_data = $this->FinAdvApprove->findById($adv_id, array('fields' => 'amount','purpose', 'req_date', 'description','TskCustomer.company_name'));
			$vars = array('name' => $user_data['Home']['first_name'].' '.$user_data['Home']['last_name'], 'purpose' => $req_data['FinAdvApprove']['purpose'], 'desc' => $req_data['FinAdvApprove']['description'], 'amt' => $req_data['FinAdvApprove']['amount'], 'remarks' => $this->request->query['remark'], 'status' => $st_msg, 'req_date' => $req_data['FinAdvApprove']['req_date'],'employee' => $user_data['Home']['first_name'].' '.$user_data['Home']['last_name'],'client' => $req_data['TskCustomer']['company_name']);
			// notify employee						
			if(!$this->send_email('My PDCA - Your advance request is '.$st_msg.' by '.ucfirst($this->Session->read('USER.Login.first_name')).' '.ucfirst($this->Session->read('USER.Login.last_name')), 'notify_advance', 'noreply@mypdca.in', $user_data['Home']['email_address'],$vars)){		
				// show the msg.								
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in sending the mail to user...', 'default', array('class' => 'alert alert-error'));				
			}else{								
				}
			
			// get the superiors
			$this->loadModel('Approval');
			// if record approved
			if($status == 'A'){					
				$approval_data = $this->Approval->find('first', array('fields' => array('level2','auth_amount_l2'), 'conditions'=> array('Approval.app_users_id' => $user_id, 'type' => 'A')));
				// make sure level 2 is not empty
				if(!empty($approval_data['Approval']['level2'])){
					// check level 2 is not empty and its not the same user
					if($approval_data['Approval']['level2'] != $this->Session->read('USER.Login.id')){ 	
						// get superior level 2 details				
						$superior_data = $this->FinAdvApprove->Home->find('first', array('conditions' => array('Home.id' => $approval_data['Approval']['level2']),'fields' => array('email_address','first_name', 'last_name')));
						$data = array('fin_advance_id' => $adv_id, 'created_date' => $this->Functions->get_current_date(), 'app_users_id' => $approval_data['Approval']['level2']);
						// save leve 2 if found
						$this->FinAdvApprove->FinAdvStatus->id = '';
						
						// make sure not duplicate status exists
						$this->check_duplicate_status($adv_id, $approval_data['Approval']['level2'], 0);
						
						if($this->FinAdvApprove->FinAdvStatus->save($data, true, $fieldList = array('fin_advance_id','created_date','app_users_id'))){	
							$this->check_duplicate_user($adv_id,  $approval_data['Approval']['level2']);
							// save adv. users
							$adv_user_data = array('fin_advance_id' => $adv_id, 'app_users_id' => $approval_data['Approval']['level2']);							
							$this->FinAdvApprove->FinAdvUser->id = '';
							$this->FinAdvApprove->FinAdvUser->save($adv_user_data, true, $fieldList = array('fin_advance_id','app_users_id'));						
						}else{
							$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in saving superior status...', 'default', array('class' => 'alert alert-error'));
						}
					}else{
						// update advance status when l2 approves
						$this->FinAdvApprove->id = $adv_id;
						$this->FinAdvApprove->saveField('is_approve', 'Y');
						// send mail to finance manager
						$this->notify_finance($user_data, $req_data);
					}
				}else{
					// update advance status
					$this->FinAdvApprove->id = $adv_id;
					$this->FinAdvApprove->saveField('is_approve', 'Y');
					// send mail to finance manager
					$this->notify_finance($user_data, $req_data);
				}
				
			}else{
			
				// update advance status
				$this->FinAdvApprove->id = $adv_id;
				$this->FinAdvApprove->saveField('is_approve', 'R');
					
				$approval_data = $this->Approval->find('first', array('fields' => array('level1','level2'), 'conditions'=> array('Approval.app_users_id' => $user_id, 'type' => 'A')));
				if($approval_data['Approval']['level1'] == $this->Session->read('USER.Login.id')){
					$mail_user = $approval_data['Approval']['level2'];
				}else{
					$mail_user = $approval_data['Approval']['level1'];
				}
								
				// get superior data
				$superior_data = $this->FinAdvApprove->Home->find('first', array('conditions' => array('Home.id' => $mail_user),'fields' => array('email_address','first_name', 'last_name')));
				// make sure superior available
				if(!empty($superior_data)){				
					$vars = array('name' => $superior_data['Home']['first_name'].' '.$superior_data['Home']['last_name'], 'purpose' => $req_data['FinAdvApprove']['purpose'], 'desc' => $req_data['FinAdvApprove']['description'], 'amt' => $req_data['FinAdvApprove']['amount'], 'remarks' => $this->request->query['remark'], 'status' => $st_msg, 'req_date' => $req_data['FinAdvApprove']['req_date'],'employee' => $user_data['Home']['first_name'].' '.$user_data['Home']['last_name'],'client' => $req_data['TskCustomer']['company_name']);
					// notify employee						
					if(!$this->send_email('My PDCA - Advance request is rejected by '.ucfirst($this->Session->read('USER.Login.first_name')).' '.ucfirst($this->Session->read('USER.Login.last_name')), 'notify_advance', 'noreply@mypdca.in', $superior_data['Home']['email_address'],$vars)){		
						// show the msg.								
						$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in sending the mail to user...', 'default', array('class' => 'alert alert-error'));				
					}else{								
					}
				}
				// forward to finance team				
				$this->notify_finance($user_data, $req_data, 1);				
				
			}			
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Advance request is '.$st_msg.' successfully', 'default', array('class' => 'alert alert-success'));
		}else{
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Problem in updating the status', 'default', array('class' => 'alert alert-error'));		
		}
		$this->redirect('/finadvapprove/');	
	}
	
	
	/* function to get advance remarks */
	public function get_adv_remarks($id){
		// get remarks
		$this->FinAdvApprove->unBindModel(array('belongsTo' => array('Home')));
		$this->FinAdvApprove->FinAdvStatus->bindModel(
			array('belongsTo' => array(
					'HrEmployee' => array(
						'className' => 'HrEmployee',
						'foreignKey' => 'app_users_id'
						
					)
				)
			)
		);
		$remarks = $this->FinAdvApprove->FinAdvStatus->find('all', array('fields' => array('HrEmployee.first_name','HrEmployee.last_name', 
		'modified_date','remarks', 'HrEmployee.photo_status', 'HrEmployee.photo'), 'conditions' => array('fin_advance_id' => $id),
		'group' => array('FinAdvStatus.id'), 'order' => array('FinAdvStatus.id' => 'desc'))); 
		
		$this->set('lead_remarks', $remarks);
	}
	
	
	
	/* function to notify finance */
	public function notify_finance($user_data,$req_data, $reject){
		$fin_data = $this->FinAdvApprove->Home->find('all', array('fields' => array('id','email_address', 'first_name','last_name'), 'conditions' => array('hr_department_id' => '4','Home.status' => '1'), 'group' => array('Home.id')));			
		// iterate finance team
			foreach($fin_data as $fin){	
				// check the same user
				if($this->Session->read('USER.Login.id') != $fin['Home']['id']){
				// change the subject
					if($reject == 1){
						$status = 'rejected';						
					}else{
						$status = 'approved';									
					}
					$sub = 'My PDCA - Advance request is '.$status.' by '.ucfirst($this->Session->read('USER.Login.first_name')).' '.ucfirst($this->Session->read('USER.Login.last_name'));
					$template = 'notify_advance';
					$name = $fin['Home']['first_name']. ' '.$fin['Home']['last_name'];
					
					$vars = array('from_name' => ucfirst($this->Session->read('USER.Login.first_name')).' '.ucfirst($this->Session->read('USER.Login.last_name')), 'status' => $status,'name' => $name, 'purpose' => $req_data['FinAdvApprove']['purpose'], 'desc' => $req_data['FinAdvApprove']['description'], 'amt' => $req_data['FinAdvApprove']['amount'], 'req_date' => $req_data['FinAdvApprove']['req_date'],'remarks' => $this->request->query['remark'],'employee' => $user_data['Home']['first_name'].' '.$user_data['Home']['last_name'], 'client' => $req_data['TskCustomer']['company_name']);
					// notify superiors						
					if(!$this->send_email($sub, $template, 'noreply@mypdca.in', $fin['Home']['email_address'],$vars)){	
						// show the msg.								
						$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in sending the mail to finance...', 'default', array('class' => 'alert alert-error'));				
					}
			}
		}
	}
		
	
	
	
	
	/* function to check the duplicate user */
	public function check_duplicate_user($id, $user_id){
		$this->loadModel('FinAdvUser');
		$count = $this->FinAdvUser->find('count', array('conditions' => array('app_users_id' => $user_id, 'fin_advance_id' => $id)));
		if($count > 0){	
			$this->invalid_attempt();
		}
	}
	
	/* function to check for duplicate entry */
	public function check_duplicate_status($fin_id, $app_user_id, $update){
		$count = $this->FinAdvApprove->FinAdvStatus->find('count',  array('conditions' => array('FinAdvStatus.fin_advance_id' => $fin_id, 'FinAdvStatus.app_users_id' => $app_user_id)));
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
	
	
	
	/* function to auth record */
	public function auth_action($id,$st_id, $view){
		$data = $this->FinAdvApprove->FinAdvStatus->findById($st_id, array('fields' => 'app_users_id', 'status'));	
		// check the req belongs to the user
		if($data['FinAdvStatus']['app_users_id'] == $this->Session->read('USER.Login.id') && $data['FinAdvStatus']['status'] == 'W'){	
			return 'pass';
		}else if($view == 1){ // for view mode only
			$data = $this->FinAdvApprove->FinAdvStatus->find('first', array('fields' => array('app_users_id'), 'conditions' => array('app_users_id' => $data['FinAdvStatus']['app_users_id'], 'fin_advance_id' => $id), 'limit' => 1));
			if(!empty($data)){
				return 'view_only';
			}
		}else{
			return 'fail';
		}
	}
	
	/* function to view the adv. request */
	public function view_advance($id,$st_id){
		// set the page title		
		$this->set('title_for_layout', 'Advance Request - Approve/Reject - Finance - My PDCA');
		if(!empty($id) && intval($id) && !empty($st_id) && intval($st_id)){
			// authorize user before action
			$ret_value = $this->auth_action($id,$st_id, 1);
			if($ret_value == 'pass'  || $ret_value == 'view_only'){	
				$data = $this->FinAdvApprove->find('first', array('conditions' => array('FinAdvStatus.app_users_id' => $this->Session->read('USER.Login.id'), 'FinAdvApprove.id' => $id), 'fields' => array('FinAdvApprove.id', 'FinAdvApprove.purpose', 'FinAdvApprove.req_date','FinAdvApprove.amount','FinAdvApprove.description','Home.first_name','Home.last_name','FinAdvStatus.remarks','TskCustomer.company_name')));		
				$this->set('adv_data', $data);
				// get leaders remarks
				$this->get_adv_remarks($id);
				// for view mode
				if($ret_value == 'view_only'){					
					$this->set('VIEW_ONLY', 1);
				}
			}else if($ret_value == 'fail'){ 
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/finadvapprove/');	
			}else{
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Record Deleted: '.$ret_value , 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/finadvapprove/');	
			}
		}else{
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));		
			$this->redirect('/finadvapprove/');	
		}
		
		
	}
	
	/* clear the cache */
	
	public function beforeFilter() { 
		//$this->disable_cache();
		$this->show_tabs(2);
		// check module access
		
	}
	
	
	
	
}