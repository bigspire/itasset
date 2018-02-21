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
class TvlreqaprController extends AppController {  
	
	public $name = 'TvlReqApr';	
	
	public $helpers = array('Html', 'Form', 'Session');
	
	public $components = array('Session', 'Functions');
	
	public $layout = 'apps';	

	/* function to list the adv. requests */
	public function index(){	
		// set the page title
		$this->set('title_for_layout', 'Approve Travel - Biz Tour - My PDCA');
		
		$emp_list = $this->TvlReqApr->get_team($this->Session->read('USER.Login.id'),'T', '1');
		$format_list = $this->Functions->format_dropdown($emp_list, 'u','id','first_name', 'last_name');		
		$this->set('empList', $format_list);
		
		// when the form is submitted for search
		if($this->request->is('post')){
			$url_vars = $this->Functions->create_url(array('keyword','emp_id'),'TvlReqApr'); 
			$this->redirect('/tvlreqapr/?'.$url_vars);			
		}
		if($this->params->query['keyword'] != ''){
			$keyCond = array("MATCH (tvl_code,TskCustomer.company_name,TvlPlace.place,purpose) AGAINST ('".$this->params->query['keyword']."' IN BOOLEAN MODE)"); 
		}	
		if($this->params->query['emp_id'] != ''){
			$empCond = array('TvlReqApr.app_users_id' => $this->params->query['emp_id']); 
		}
		
		$options = array(			
			array('table' => 'tvl_req_status',
					'alias' => 'TvlReqStatuses',					
					'type' => 'INNER',
					'conditions' => array('`TvlReqStatuses`.`tvl_request_id` = `TvlReqApr`.`id`','TvlReqStatuses.type' => 'N')
			),
			array('table' => 'app_users',
					'alias' => 'Homes',					
					'type' => 'LEFT',
					'conditions' => array('`TvlReqStatuses`.`app_users_id` = `Homes`.`id`')
			),			
			array('table' => 'app_users',
					'alias' => 'Home2',					
					'type' => 'LEFT',
					'conditions' => array('`TvlReqApr`.`app_users_id` = `Home2`.`id`')
			)
		);
			
							
		$this->TvlReqApr->unBindModel(array('hasOne' => array('TvlReqStatus')));		
		
		$this->paginate = array('fields' => array('id','purpose','tvl_dest_id','tvl_code','type','TvlPlace.place','start_date','TvlMode.mode','TskCustomer.company_name', 'created_date','max(TvlReqStatuses.id) as status_id','group_concat(TvlReqStatuses.status) as st_status', 'group_concat(TvlReqStatuses.created_date) as st_created', 'group_concat(Homes.first_name) as st_user','group_concat(TvlReqStatuses.modified_date) as st_modified','group_concat(TvlReqStatuses.remarks) as st_remarks', 'Homes.id', 'Home2.id', 'Home2.first_name','Home2.last_name',  'Homes.first_name','Homes.last_name'),'limit' => 10,'conditions' => array($keyCond, $empCond,'TvlReqUser.type' => 'N', 'TvlReqApr.status' => 'A', 'TvlReqUser.app_users_id' => $this->Session->read('USER.Login.id'),'TvlReqApr.is_deleted' => 'N'),  'group' => array('TvlReqApr.id'), 'order' => array('is_approve' => 'asc','created_date' => 'desc'), 'joins' => $options);
		$data = $this->paginate('TvlReqApr');
		
		$this->set('tvl_data', $data);
		
		// hide verify icon display
		foreach($data as $tvl_req){ 
			$show_st = $this->auth_action($tvl_req['TvlReqApr']['id'], $tvl_req[0]['status_id']);			
			$status_id[] = $show_st;				
		}
		$this->set('show_status', $status_id);
		
		if(empty($data)){
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>You have no travel request to approve', 'default', array('class' => 'alert alert'));	
		}
	}
	
	/* function to check the duplicate user */
	public function check_duplicate_user($id, $user_id){
		$count = $this->TvlReqApr->TvlReqUser->find('count', array('conditions' => array('TvlReqUser.type' => 'N', 'app_users_id' => $user_id, 'tvl_request_id' => $id)));
		if($count > 0){	
			$this->invalid_attempt();
		}
	}
	
	/* function to check for duplicate entry */
	public function check_duplicate_status($tvl_id, $app_user_id, $update){
		$count = $this->TvlReqApr->TvlReqStatus->find('count',  array('conditions' => array('TvlReqStatus.type' => 'N', 'TvlReqStatus.tvl_request_id' => $tvl_id, 'TvlReqStatus.app_users_id' => $app_user_id)));
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
	
	
	
	/* function to get travel remarks */
	public function get_tvl_remarks($id){ 
		// get remarks	
		$this->TvlReqApr->TvlReqStatus->bindModel(
			array('belongsTo' => array(
					'HrEmployee' => array(
						'className' => 'HrEmployee',
						'foreignKey' => 'app_users_id'
						
					)
				)
			)
		);
		$remarks = $this->TvlReqApr->TvlReqStatus->find('all', array('fields' => array('HrEmployee.first_name','HrEmployee.last_name', 
		'modified_date','remarks', 'HrEmployee.photo_status', 'HrEmployee.photo'), 'conditions' => array('tvl_request_id' => $id, 'TvlReqStatus.type' => 'N'),'order' => array('TvlReqStatus.id' => 'desc'),
		'group' => array('TvlReqStatus.id'))); 	
		$this->set('lead_remarks', $remarks);
	}
	
	
	/* function to auth record */
	public function auth_action($id,$st_id, $view){
		$data = $this->TvlReqApr->TvlReqStatus->findById($st_id, array('fields' => 'app_users_id', 'status'));	
		// check the req belongs to the user
		if($data['TvlReqStatus']['app_users_id'] == $this->Session->read('USER.Login.id') && $data['TvlReqStatus']['status'] == 'W'){	
			return 'pass';
		}else if($view == 1){ // for view mode only
			$data = $this->TvlReqApr->TvlReqStatus->find('first', array('fields' => array('app_users_id'), 'conditions' => array('app_users_id' => $data['TvlReqStatus']['app_users_id'], 'TvlReqStatus.type' => 'N', 'tvl_request_id' => $id), 'limit' => 1));
			if(!empty($data)){ 
				return 'view_only';
			}
		}else{
			return 'fail';
		}
	}
	
	/* function to view the adv. request */
	public function view_request($id,$st_id){
		// set the page title		
		$this->set('title_for_layout', 'View Travel - Biz Tour - My PDCA');
		if(!empty($id) && intval($id) && !empty($st_id) && intval($st_id)){
			// authorize user before action
			$ret_value = $this->auth_action($id,$st_id, 1);
			if($ret_value == 'pass'  || $ret_value == 'view_only'){
				// for view mode
				if($ret_value == 'view_only'){					
					$this->set('VIEW_ONLY', 1);
				}
				$this->TvlReqApr->bindModel(
						array('belongsTo' => array(
								'TvlStart' => array(
									'className' => 'TvlPlace',
									'foreignKey' => 'tvl_depart_id'
								),
								'TvlDebit' => array(
									'className' => 'TskCustomer',
									'foreignKey' => 'debit_to'
								)
							)
						)
				);
				$data = $this->TvlReqApr->findById($id, array('fields' => 'id','purpose','TskCustomer.company_name','start_date','return_date','expected_outcome',
				'spl_particular','desire_depart_to','desire_depart_from','desire_arrival_from','desire_arrival_to','desire_return_arrival_from','desire_return_arrival_to','desire_return_depart_from','desire_return_depart_to','TvlMode.mode',
				'TvlPlace.place','tvl_code','type', 'TvlStart.place', 'HrEmployee.first_name','HrEmployee.last_name','TvlDebit.company_name'));
				$this->set('tvl_data', $data);
				// get passenger details
				$this->loadModel('TvlPassenger');
				$data = $this->TvlPassenger->find('all', array('conditions' => array('tvl_request_id' => $id)));
				$this->set('tvl_person', $data);
				// get travel mode options
				$this->loadModel('TvlReqClass');
				$data = $this->TvlReqClass->find('all', array('fields' => array('group_concat(TvlModeOption.title) tvl_req_class'), 'conditions' => array('TvlReqClass.tvl_request_id' => $id)));
				$this->set('tvl_class_data', $data);
				// load tvl remarks
				$this->get_tvl_remarks($id);
			}else if($ret_value == 'fail'){ 
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/tvlreqapr/');	
			}else{
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Record Deleted: '.$ret_value , 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/tvlreqapr/');	
			}			
		}else{
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));		
			$this->redirect('/tvlreqapr/');	
		}
	}
	
	/* function to process the travel */
	public function process_req($tvl_id, $st_id, $status,$user_id){ 
		$data = array('modified_date' => $this->Functions->get_current_date(), 'modified_by' => $this->Session->read('USER.Login.id'), 'remarks' => $this->request->query['remark'], 'status' => $status);
		$this->TvlReqApr->TvlReqStatus->id = $st_id;
		$st_msg = $status == 'A' ? 'approved' : 'rejected';
		// make sure not duplicate status exists
		$this->check_duplicate_status($tvl_id, $this->Session->read('USER.Login.id'), 1);
		// save the tvl adv. status
		if($this->TvlReqApr->TvlReqStatus->save($data, true, $fieldList = array('modified_by','modified_date','remarks','status'))){
			// get user data
			$user_data = $this->TvlReqApr->HrEmployee->find('first', array('conditions' => array('HrEmployee.id' => $user_id),'fields' => array('email_address','first_name', 'last_name')));
			// get travel details
			$req_data = $this->TvlReqApr->findById($tvl_id, array('fields' => 'start_date','tvl_dest_id','tvl_mode_id','tsk_company_id','purpose', 'return_date', 'TvlPlace.place','TskCustomer.company_name','TvlMode.mode','type'));
			// get tvl mode class
			$this->loadModel('TvlReqClass');
			$mode_options = $this->TvlReqClass->find('all', array('fields' => array('tvl_mode_option_id'), 'conditions' => array('tvl_request_id' => $tvl_id)));
			$vars = array('name' => $user_data['HrEmployee']['first_name'].' '.$user_data['HrEmployee']['last_name'], 'purpose' => $req_data['TvlReqApr']['purpose'], 'start_date' => $req_data['TvlReqApr']['start_date'], 'return_date' => $req_data['TvlReqApr']['return_date'],
			'type' => $req_data['TvlReqApr']['type'], 'class' => $this->get_travel_option($mode_options), 'mode' => $this->get_travel_mode($req_data['TvlReqApr']['tvl_mode_id']),
			'place' => $this->get_travel_place($req_data['TvlReqApr']['tvl_dest_id']),'client' => $this->get_customer_name($req_data['TvlReqApr']['tsk_company_id']),
			'remarks' => $this->request->query['remark'], 'status' => $st_msg, 'employee' => $user_data['HrEmployee']['first_name'].' '.$user_data['HrEmployee']['last_name']);
			// notify employee						
			if(!$this->send_email('My PDCA - Your travel request is '.$st_msg.' by '.ucfirst($this->Session->read('USER.Login.first_name')).' '.ucfirst($this->Session->read('USER.Login.last_name')), 'notify_travel', 'noreply@mypdca.in', $user_data['HrEmployee']['email_address'],$vars)){		
				// show the msg.								
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in sending the mail to user...', 'default', array('class' => 'alert alert-error'));				
			}else{								
				}
			
			// get the superiors
			$this->loadModel('Approval');
			// if record approved
			if($status == 'A'){				
				$approval_data = $this->Approval->find('first', array('fields' => array('level2'), 'conditions'=> array('Approval.app_users_id' => $user_id, 'type' => 'T')));				
				// make sure level 2 is not empty
				if(!empty($approval_data['Approval']['level2'])){
					// check level 2 is not empty and its not the same user
					if($approval_data['Approval']['level2'] != $this->Session->read('USER.Login.id')){ 	
						// get superior level 2 details				
						$superior_data = $this->TvlReqApr->HrEmployee->find('first', array('conditions' => array('HrEmployee.id' => $approval_data['Approval']['level2']),'fields' => array('email_address','first_name', 'last_name')));
						$data = array('tvl_request_id' => $tvl_id, 'created_date' => $this->Functions->get_current_date(), 'app_users_id' => $approval_data['Approval']['level2']);
						// save leve 2 if found
						$this->TvlReqApr->TvlReqStatus->id = '';						
						// make sure not duplicate status exists
						$this->check_duplicate_status($tvl_id, $approval_data['Approval']['level2'], 0);
						if($this->TvlReqApr->TvlReqStatus->save($data, true, $fieldList = array('tvl_request_id','created_date','app_users_id'))){	
							$this->check_duplicate_user($tvl_id,  $approval_data['Approval']['level2']);
							// save adv. users
							$adv_user_data = array('tvl_request_id' => $tvl_id, 'app_users_id' => $approval_data['Approval']['level2']);							
							$this->TvlReqApr->TvlReqUser->id = '';
							$this->TvlReqApr->TvlReqUser->save($adv_user_data, true, $fieldList = array('tvl_request_id','app_users_id'));							
						}else{
							$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in saving superior status...', 'default', array('class' => 'alert alert-error'));
						}
					}else{
						// update travel status when L2 approves
						$this->TvlReqApr->id = $tvl_id;
						$this->TvlReqApr->saveField('is_approve', 'Y');
						// send mail to travel desk
						$this->notify_travel_desk($user_data, $req_data, '', $mode_options);
					}
				}else{
					// update travel status
					$this->TvlReqApr->id = $tvl_id;
					$this->TvlReqApr->saveField('is_approve', 'Y');
					// send mail to travel desk
					$this->notify_travel_desk($user_data, $req_data, '', $mode_options);
				}
				
			}else{		
				// update travel status
				$this->TvlReqApr->id = $tvl_id;
				$this->TvlReqApr->saveField('is_approve', 'R');
					
				$approval_data = $this->Approval->find('first', array('fields' => array('level1','level2'), 'conditions'=> array('Approval.app_users_id' => $user_id, 'type' => 'T')));
				if($approval_data['Approval']['level1'] == $this->Session->read('USER.Login.id')){
					$mail_user = $approval_data['Approval']['level2'];
				}else{
					$mail_user = $approval_data['Approval']['level1'];
				}
								
				// get superior data
				$superior_data = $this->TvlReqApr->HrEmployee->find('first', array('conditions' => array('HrEmployee.id' => $mail_user),'fields' => array('email_address','first_name', 'last_name')));
				// make sure superior available
				if(!empty($superior_data)){				
					$vars = array('name' => $superior_data['HrEmployee']['first_name'].' '.$superior_data['HrEmployee']['last_name'],
					'purpose' => $req_data['TvlReqApr']['purpose'], 'class' => $this->get_travel_option($mode_options), 'start_date' => $req_data['TvlReqApr']['start_date'], 'return_date' => $req_data['TvlReqApr']['return_date'],
					'type' => $req_data['TvlReqApr']['type'], 'mode' => $this->get_travel_mode($req_data['TvlReqApr']['tvl_mode_id']),
					'place' => $this->get_travel_place($req_data['TvlReqApr']['tvl_dest_id']),'client' => $this->get_customer_name($req_data['TvlReqApr']['tsk_company_id']), 'remarks' => $this->request->query['remark'],
					'status' => $st_msg, 'req_date' => $req_data['TvlReqApr']['req_date'],'employee' => $user_data['HrEmployee']['first_name'].' '.$user_data['HrEmployee']['last_name'],'client' => $req_data['TskCustomer']['company_name']);
					// notify employee						
					if(!$this->send_email('My PDCA - Travel request is rejected by '.ucfirst($this->Session->read('USER.Login.first_name')).' '.ucfirst($this->Session->read('USER.Login.last_name')), 'notify_travel', 'noreply@mypdca.in', $superior_data['HrEmployee']['email_address'],$vars)){		
						// show the msg.								
						$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in sending the mail to user...', 'default', array('class' => 'alert alert-error'));				
					}else{								
					}
				}
				// forward to travel desk team				
				$this->notify_travel_desk($user_data, $req_data, 1, $mode_options);				
				
			}			
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Travel request is '.$st_msg.' successfully', 'default', array('class' => 'alert alert-success'));
		}else{
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Problem in updating the status', 'default', array('class' => 'alert alert-error'));		
		}
		$this->redirect('/tvlreqapr/');	
	}
	
	/* function to notify travel desk */
	public function notify_travel_desk($user_data,$req_data, $reject, $mode_options){ 
		$tvl_data = $this->TvlReqApr->HrEmployee->find('all', array('fields' => array('id','email_address', 'first_name','last_name'), 'conditions' => array('app_roles_id' => '19', 'HrEmployee.status' => '1', 'HrEmployee.is_deleted' => 'N'), 'group' => array('HrEmployee.id')));			
		// iterate travel admin team
			foreach($tvl_data as $tvl){	
				// check the same user
				if($this->Session->read('USER.Login.id') != $tvl['HrEmployee']['id']){
				// change the subject
					if($reject == 1){
						$status = 'rejected';						
					}else{
						$status = 'approved';									
					}
					$sub = 'My PDCA - Travel request is '.$status.' by '.ucfirst($this->Session->read('USER.Login.first_name')).' '.ucfirst($this->Session->read('USER.Login.last_name'));
					$template = 'notify_travel';
					$name = $tvl['HrEmployee']['first_name']. ' '.$tvl['HrEmployee']['last_name'];
					
					$vars = array('from_name' => ucfirst($this->Session->read('USER.Login.first_name')).' '.ucfirst($this->Session->read('USER.Login.last_name')), 'status' => $status,'name' => $name, 
					'purpose' => $req_data['TvlReqApr']['purpose'], 'class' => $this->get_travel_option($mode_options), 'start_date' => $req_data['TvlReqApr']['start_date'], 'return_date' => $req_data['TvlReqApr']['return_date'],
					'type' => $req_data['TvlReqApr']['type'], 'mode' => $this->get_travel_mode($req_data['TvlReqApr']['tvl_mode_id']),
					'place' => $this->get_travel_place($req_data['TvlReqApr']['tvl_dest_id']),'client' => $this->get_customer_name($req_data['TvlReqApr']['tsk_company_id']),
					'remarks' => $this->request->query['remark'], 'employee' => $user_data['HrEmployee']['first_name'].' '.$user_data['HrEmployee']['last_name']);
					// notify superiors						
					if(!$this->send_email($sub, $template, 'noreply@mypdca.in', $tvl['HrEmployee']['email_address'],$vars)){	
						// show the msg.								
						$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in sending the mail...', 'default', array('class' => 'alert alert-error'));				
					}
			}
		}
	}
		
		
	/* function to get travel mode */
	public function get_travel_mode($id){
		$data = $this->TvlReqApr->TvlMode->findById($id, array('fields' => 'mode'));
		return $data['TvlMode']['mode'];
	}
	
	/* function to get travel place */
	public function get_travel_place($id){
		$data = $this->TvlReqApr->TvlPlace->findById($id, array('fields' => 'place'));
		return $data['TvlPlace']['place'];
	}
	
	/* function to get customer name */
	public function get_customer_name($id){
		$comp = $this->TvlReqApr->TskCustomer->findById($id, array('fields' => 'company_name'));
		return $comp['TskCustomer']['company_name'];
	}
	
	/* function to get travel class */
	public function get_travel_option($values){
		$this->loadModel('TvlModeOption');
		$comma = ', ';
		$tot = count($values);
		$i = 0;
		foreach($values as $key => $id){
			$data = $this->TvlModeOption->findById($id['TvlReqClass']['tvl_mode_option_id'], array('fields' => 'title'));			
			if($i >= ($tot-1)){ 
				$comma = '';
			} 
			$class .= $data['TvlModeOption']['title'].$comma;
			$i++;
			
		}
		return $class;
	}
	
	/* clear the cache */	
	public function beforeFilter() { 
		//$this->disable_cache();
		$this->show_tabs(71);		
	}
	
		
	/* auto complete search */	
	public function search(){ 
		$this->layout = false;	 
		$q = trim(Sanitize::escape($_GET['q']));	
		if(!empty($q)){
			// execute only when the search keywork has value		
			$this->set('keyword', $q);
			$data = $this->TvlReqApr->find('all', array('fields' => array('tvl_code','TskCustomer.company_name','TvlPlace.place'),  'group' => array('tvl_code','TskCustomer.company_name','TvlPlace.place'), 'conditions' => 	$conditions =  array("OR" => array ('tvl_code like' => '%'.$q.'%',
			'TskCustomer.company_name like' => '%'.$q.'%', 'TvlPlace.place like' => '%'.$q.'%'), 'AND' => array('TvlReqApr.is_deleted' => 'N', 'TvlReqApr.status' => 'A', 'TvlReqUser.app_users_id' => $this->Session->read('USER.Login.id')))));		
			$this->set('results', $data);
		}
    }
	
	
	
	
}