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
class FinAdvanceController extends AppController {  
	
	public $name = 'FinAdvance';	
	
	public $helpers = array('Html', 'Form', 'Session');
	
	public $components = array('Session', 'Functions');
	
	public $layout = 'apps';	

	/* function to list the adv. requests */
	public function index(){	
		// set the page title
		$this->set('title_for_layout', 'Advance - Finance - My PDCA');
		$this->set('srchStat', $this->Functions->get_search_status());
		$this->set('payStat', $this->Functions->get_pay_status());
		// when the form is submitted for search
		if($this->request->is('post')){
			$url_vars = $this->Functions->create_url(array('keyword'),'FinAdvance'); 
			$this->redirect('/finadvance/?'.$url_vars);			
		}
		if($this->params->query['keyword'] != ''){
			$keyCond = array("MATCH (purpose, description) AGAINST ('".$this->params->query['keyword']."' IN BOOLEAN MODE)"); 
		}
		/*if($this->params->query['status'] != ''){
			$statusCond = array('FinAdvStatuses.status' => $this->params->query['status']); 
		}
		if($this->params->query['pay_status'] != ''){
			
		}
		*/
		$options = array(			
			array('table' => 'fin_adv_status',
					'alias' => 'FinAdvStatuses',					
					'type' => 'LEFT',
					'conditions' => array('`FinAdvStatuses`.`fin_advance_id` = `FinAdvance`.`id`')
			),
			array('table' => 'app_users',
					'alias' => 'Homes',					
					'type' => 'LEFT',
					'conditions' => array('`FinAdvStatuses`.`app_users_id` = `Homes`.`id`')
			)
		);
			
							
		$this->FinAdvance->unBindModel(array('hasOne' => array('FinAdvStatus')));

		// fetch the advances		
		$this->paginate = array('fields' => array('id','purpose', 'amount','req_date','created_date','group_concat(FinAdvStatuses.status) as st_status', 'group_concat(Homes.first_name) as st_user', 'group_concat(FinAdvStatuses.modified_date) as st_modified','group_concat(FinAdvStatuses.created_date) as st_created', 'group_concat(FinAdvStatuses.remarks) as st_remarks'),'limit' => 10,'conditions' => array($keyCond,'FinAdvance.app_users_id' => $this->Session->read('USER.Login.id'),'FinAdvance.is_deleted' => 'N'), 'order' => array('created_date' => 'desc'), 'group' => array('FinAdvance.id'), 'joins' => $options);
		$data = $this->paginate('FinAdvance');
		
		$this->set('adv_data', $data);
		if(empty($data)){
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>You have no advance request found', 'default', array('class' => 'alert alert'));	
		}
		
		
	}
	
	
	

	
	/* function to save the advance */
	public function create_advance(){ 
		// set the page title		
		$this->set('title_for_layout', 'Create Advance - Finance - My PDCA');
		$this->load_customers();
		if ($this->request->is('post')){ 
			// validates the form
			$this->FinAdvance->set($this->request->data);
			if ($this->FinAdvance->validates(array('fieldList' => array('purpose', 'req_date','amount','description','is_debit')))) {
				
				$this->request->data['FinAdvance']['app_users_id'] = $this->Session->read('USER.Login.id');
				// format the dates to save					
				$this->request->data['FinAdvance']['req_date'] = $this->Functions->format_date_save($this->request->data['FinAdvance']['req_date']);
				$this->request->data['FinAdvance']['created_date'] = $this->Functions->get_current_date();
				// save the data
				if($this->FinAdvance->save($this->request->data['FinAdvance'])) {
					// get the superiors
					$this->loadModel('Approval');
					$approval_data = $this->Approval->find('first', array('fields' => array('level1','auth_amount_l1'), 'conditions'=> array('Approval.app_users_id' => $this->Session->read('USER.Login.id'), 'type' => 'A')));
					// save finance req. status data
					$this->loadModel('FinAdvStatus');
					$data = array('fin_advance_id' => $this->FinAdvance->id, 'created_date' => $this->Functions->get_current_date(), 'app_users_id' => $approval_data['Approval']['level1']);
					if(!empty($approval_data)){
						// make sure not duplicate status exists
						$this->check_duplicate_status($this->FinAdvance->id, $approval_data['Approval']['level1']);
						// save in adv. status table
						if($this->FinAdvStatus->save($data, true, $fieldList = array('fin_advance_id','created_date','app_users_id'))){						
							// save adv. users
							$this->loadModel('FinAdvUser');
							$adv_user_data = array('fin_advance_id' => $this->FinAdvance->id, 'app_users_id' => $approval_data['Approval']['level1']);							
							$this->FinAdvUser->id = '';
							$this->FinAdvUser->save($adv_user_data, true, $fieldList = array('fin_advance_id','app_users_id'));					
					
							
							// send mail to finance team
							$approval_data = $this->FinAdvance->Home->find('all', array('fields' => array('id','email_address', 'first_name', 'last_name'), 'conditions'=> array('Home.hr_department_id' => '4', 'Home.status' => '1'), 'group' => array('Home.id')));
							foreach($approval_data as $fin_data){
								if($superior_data['Home']['id'] != $fin_data['Home']['id']){
									$vars = array('from_name' => ucfirst($this->Session->read('USER.Login.first_name')).' '.ucfirst($this->Session->read('USER.Login.last_name')),'name' => $fin_data['Home']['first_name'].' '.$fin_data['Home']['last_name'], 'purpose' => $this->request->data['FinAdvance']['purpose'], 'desc' => $this->request->data['FinAdvance']['description'], 'amt' => $this->request->data['FinAdvance']['amount'], 'req_date' => $this->request->data['FinAdvance']['req_date'],'client' => $this->get_customer_name($this->request->data['FinAdvance']['tsk_company_id']));
									// notify superiors						
									if(!$this->send_email('My PDCA - '.ucfirst($this->Session->read('USER.Login.first_name')).' '.ucfirst($this->Session->read('USER.Login.last_name')).' created advance request (No Action Required)!', 'advance_creation', 'noreply@mypdca.in', $fin_data['Home']['email_address'],$vars)){	
										// show the msg.								
										$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in sending the mail...', 'default', array('class' => 'alert alert-error'));				
									}else{
													
									}
								}
							}					
							
							// show the msg.
							$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Your advance request is created successfully', 'default', array('class' => 'alert alert-success'));
						}else{
							$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in saving approver status', 'default', array('class' => 'alert alert-info'));
						}
					}else{
						$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>You have no superior to approve your request', 'default', array('class' => 'alert alert-info'));
					}	
					
					$this->redirect('/finadvance/');	
					
				}else{
					// show the error msg.
					$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in saving the data...', 'default', array('class' => 'alert alert-error'));					
				}
				
				
			}
		}
	}
	
	/* function to get advance remarks */
	public function get_adv_remarks($id){
		// get remarks
		$this->FinAdvance->unBindModel(array('belongsTo' => array('Home')));
		$this->FinAdvance->FinAdvStatus->bindModel(
			array('belongsTo' => array(
					'HrEmployee' => array(
						'className' => 'HrEmployee',
						'foreignKey' => 'app_users_id'
					)
				)
			)
		);
		$remarks = $this->FinAdvance->FinAdvStatus->find('all', array('fields' => array('HrEmployee.first_name','HrEmployee.last_name', 
		'modified_date','remarks', 'HrEmployee.photo_status', 'HrEmployee.photo'), 'conditions' => array('fin_advance_id' => $id),'order' => array('FinAdvStatus.id' => 'desc'),
		'group' => array('FinAdvStatus.id'))); 		
		$this->set('lead_remarks', $remarks);
	}
	
	/* function to get customer name */
	public function get_customer_name($id){
		$comp = $this->FinAdvance->TskCustomer->findById($id, array('fields' => 'company_name'));
		return $comp['TskCustomer']['company_name'];
	}
	
	/* function to load the customer details */
	public function load_customers(){
		$comp_list = $this->FinAdvance->TskCustomer->find('list', array('fields' => array('id','company_name'), 'order' => array('company_name ASC'),'conditions' => array('is_deleted' => 'N', 'status' => '1')));
		$this->set('compList', $comp_list);
	}
	
	/* function to check for duplicate entry */
	public function check_duplicate_status($fin_id, $app_user_id){
		$count = $this->FinAdvance->FinAdvStatus->find('count',  array('conditions' => array('FinAdvStatus.fin_advance_id' => $fin_id, 'FinAdvStatus.app_users_id' => $app_user_id)));
		if($count > 0){
			$this->invalid_attempt();
		}
		
	}
	
	
	
	/* function to auth record */
	public function auth_action($id){
		$data = $this->FinAdvance->findById($id, array('fields' => 'app_users_id','is_deleted','modified_date'));	
		// check the req belongs to the user
		if($data['FinAdvance']['is_deleted'] == 'Y'){
			return $data['FinAdvance']['modified_date'];
		}		
		else if($data['FinAdvance']['app_users_id'] == $this->Session->read('USER.Login.id')){	
			return 'pass';
		}else{
			return 'fail';
		}
	}
	
	/* function to view the adv. request */
	public function view_advance($id){
		// set the page title		
		$this->set('title_for_layout', 'View Advance - Finance - My PDCA');
		if(!empty($id) && intval($id)){
			// authorize user before action
			$ret_value = $this->auth_action($id);
			if($ret_value == 'pass'){	
				$data = $this->FinAdvance->findById($id, array('fields' => 'id','purpose','description','amount','req_date','TskCustomer.company_name'));
				$this->set('adv_data', $data);
				// get leaders remarks
				$this->get_adv_remarks($id);
			}else if($ret_value == 'fail'){ 
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/finadvance/');	
			}else{
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Record Deleted: '.$ret_value , 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/finadvance/');	
			}
		}else{
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));		
			$this->redirect('/finadvance/');	
		}
		
		
	}
	
	/* clear the cache */
	
	public function beforeFilter() { 
		//$this->disable_cache();
		$this->show_tabs(1);
		
	}
	
		
		/* auto complete search 
	public function search(){ 
		$this->layout = false;	 
		$q = trim(Sanitize::escape($_GET['q']));	
		if(!empty($q)){
			// execute only when the search keywork has value		
			$this->set('keyword', $q);
			$data = $this->FinAdvance->find('all', array('fields' => array('purpose'),  'group' => array('purpose','description'), 'conditions' => 	$conditions =  array("OR" => array ('purpose like' => '%'.$q.'%', 'description like' => '%'.$q.'%'), 'AND' => array('is_deleted' => 'N'))));		
			$this->set('results', $data);
		}
    }
	*/	
	
	
	
}