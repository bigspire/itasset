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
class TvlbooktktController extends AppController {  
	
	public $name = 'TvlBookTkt';	
	
	public $helpers = array('Html', 'Form', 'Session');
	
	public $components = array('Session', 'Functions', 'Excel');
	
	public $layout = 'apps';	

	/* function to list the adv. requests */
	public function index(){	
		// set the page title
		$this->set('title_for_layout', 'Book Ticket - Biz Tour - My PDCA');		
	
		// when the form is submitted for search
		if($this->request->is('post')){
			$url_vars = $this->Functions->create_url(array('keyword','emp_id'),'TvlBookTkt'); 
			$this->redirect('/tvlbooktkt/?'.$url_vars);			
		}
			// get employee list
		$format_list = $this->TvlBookTkt->HrEmployee->find('list', array('fields' => array('HrEmployee.id', 'HrEmployee.full_name'), 'conditions' => array('HrEmployee.status' => '1', 'HrEmployee.is_deleted'=> 'N'), 'order' => array('HrEmployee.full_name' => 'asc')));
		$this->set('empList', $format_list);
		
		if($this->params->query['keyword'] != ''){
			$keyCond = array("MATCH (tvl_code,TskCustomer.company_name,TvlPlace.place,purpose) AGAINST ('".$this->params->query['keyword']."' IN BOOLEAN MODE)"); 
		}					
		if($this->params->query['emp_id'] != ''){
			$empCond = array('TvlBookTkt.app_users_id' => $this->params->query['emp_id']); 
		}
		// fetch the advances		
		$this->paginate = array('fields' => array('id','TvlTicket.id','TvlTicketStatus.id', 'purpose','tvl_dest_id','tvl_code','type','TvlPlace.place','start_date','return_date','TvlMode.mode','created_date','tdesk_status','tkt_status','HrEmployee.first_name','HrEmployee.last_name'),'limit' => 15,'conditions' => array($keyCond,$empCond,'TvlBookTkt.is_deleted' => 'N', 'is_approve' => 'Y', 'TvlBookTkt.status' => 'A'), 'order' => array('TvlBookTkt.tkt_status' => 'asc', 'created_date' => 'desc'), 'group' => array('TvlBookTkt.id'));
		$data = $this->paginate('TvlBookTkt');
		
		$this->set('tvl_data', $data);
		if(empty($data)){
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>You have no tickets to book', 'default', array('class' => 'alert alert'));	
		}
		
		
	}
	
	
	/* function to export the travel details */
	public function export(){
		$this->set('title_for_layout', 'Export Travel - Biz Tour - My PDCA');		

		if ($this->request->is('post')){ 
			// validates the form
			$this->TvlBookTkt->set($this->request->data);
			if ($this->TvlBookTkt->validates(array('fieldList' => array('from_date','to_date')))) {
				$start_date = $this->Functions->format_date_save($this->request->data['TvlBookTkt']['from_date']);				
				$end_date = $this->Functions->format_date_save($this->request->data['TvlBookTkt']['to_date']);
				//$start_date = date('Y-m-d', strtotime($start_date  . '-1 day'));
				//$end_date = date('Y-m-d', strtotime($end_date . '+1 day'));
				$this->loadModel('TvlTicket');
				
				$options = array(
					array('table' => 'tvl_request',
							'alias' => 'TvlReq',					
							'type' => 'LEFT',
							'conditions' => array('`TvlTicket`.`tvl_request_id` = `TvlReq`.`id`')
					),
					array('table' => 'app_users',
							'alias' => 'Employee',					
							'type' => 'LEFT',
							'conditions' => array('`TvlReq`.`app_users_id` = `Employee`.`id`')
					),
					array('table' => 'tvl_passenger',
							'alias' => 'TvlPassenger',					
							'type' => 'LEFT',
							'conditions' => array('`TvlPassenger`.`tvl_request_id` = `TvlReq`.`id`')
					),
					array('table' => 'tvl_place',
							'alias' => 'Source',					
							'type' => 'LEFT',
							'conditions' => array('`Source`.`id` = `TvlReq`.`tvl_depart_id`')
					),
					array('table' => 'tvl_place',
							'alias' => 'Destination',					
							'type' => 'LEFT',
							'conditions' => array('`Destination`.`id` = `TvlReq`.`tvl_dest_id`')
					),
					array('table' => 'tsk_company',
							'alias' => 'Company',					
							'type' => 'LEFT',
							'conditions' => array('`Company`.`id` = `TvlReq`.`debit_to`')
					)
					,
					array('table' => 'tvl_req_status',
							'alias' => 'ReqStatus',					
							'type' => 'LEFT',
							'conditions' => array('`ReqStatus`.`tvl_request_id` = `TvlReq`.`id`'),
							'order' => array('ReqStatus.id' => 'asc')
					),
					array('table' => 'app_users',
							'alias' => 'Approver',					
							'type' => 'LEFT',
							'conditions' => array('`ReqStatus`.`app_users_id` = `Approver`.`id`')
					)
				);
				// fetch data to export travel details
				$data = $this->TvlTicket->find('all', array('fields' => array('TvlReq.tvl_code','TvlReq.purpose','Employee.first_name','TvlReq.start_date','TvlReq.return_date','TvlTicket.tkt_type',"group_concat(Distinct TvlPassenger.passenger SEPARATOR ', ') passenger","group_concat(Distinct Approver.first_name SEPARATOR ', ') approver", 'TvlReq.return_date', 'Destination.place', 'Source.place','Company.company_name','TvlTicket.book_date','TvlTicket.created_date', 'TvlTicket.amount','TvlReq.status', 'TvlTicket.book_ref_no'), 'conditions' => array('TvlReq.is_deleted' => 'N', 'TvlReq.is_approve' => 'Y', 'TvlReq.status' => 'A',
				"date_format(TvlTicket.created_date, '%Y-%m-%d') between ? and ?" => array($start_date, $end_date)),'order' => array('TvlTicket.created_date' => 'desc'), 'group' => array('TvlTicket.id'), 'joins' => $options));
				if(empty($data)){
					$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Sorry! No records found', 'default', array('class' => 'alert alert-error'));
				}else{
					// generate excel 
					$this->Excel->generate('travel', $data, $data, 'Report', 'Travel Report');
				}
			}else{
				//print_r($this->TvlPlace->validationErrors);
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in submitting the form. please check errors...', 'default', array('class' => 'alert alert-error'));	
			}
		}
	}
	
	
	/* function to download the file */
	public function download($id,$type){
		$ret_value = $this->auth_action($id);
		if($ret_value == 'pass'){
			// in view ticket download
			if(strstr($this->referer(), 'view_ticket')){
				$type_cond = array('tkt_type' => $this->request->query['tvl_type']);
			}
			$data = $this->TvlBookTkt->TvlTicket->find('all', array('conditions' => array('TvlTicket.tvl_request_id' => $id, $type_cond), 'fields' => array('tkt','agent_copy')));
			if(!empty($data)){
				// if only one file
				if($type == 1){
					$field = ($this->request->query['file'] == 'agentcopy') ? 'agent_copy' : 'tkt';
					$this->download_file(WWW_ROOT.'/uploads/ticket/'.$data[0]['TvlTicket'][$field]);
				}else if($type == 2){
					if(extension_loaded('zip')){
						// create a zip file
						$zip = new ZipArchive();
						$filename = 'ticket.zip';	
						$file_path = WWW_ROOT.'/uploads/ticket/'.$filename;
						// create zip file
						if ($zip->open($file_path, ZipArchive::CREATE) == TRUE){ 
							// iterate the files
							foreach($data as $file_detail){
								$zip->addFile(WWW_ROOT.'/uploads/ticket/'.$file_detail['TvlTicket']['tkt'], $file_detail['TvlTicket']['tkt']);										
							}
							$zip->close();
							// download the zip file
							$this->download_file($file_path);
							unlink($file_path);
							die;
						}else{
							exit("cannot open <$filename>\n");
						}
					}else{
						die('You donot have zip extension');
					}
				}else{
					$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Oops, No ticket(s) found', 'default', array('class' => 'alert alert-info'));
					$this->redirect('/tvlbooktkt/');	
				}
			}else{
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Oops, No ticket(s) found', 'default', array('class' => 'alert alert-info'));
				$this->redirect('/tvlbooktkt//');	
			}
			die;
		}else{
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));		
			$this->redirect('/tvlbooktkt/');	
		}
	}
	
	/* function to add notes for the ticket */
	public function add_note($id){
		$this->layout = 'iframe';
		$this->load_travel_mode();
		$this->set('bookMode', array('G' => 'General', 'T' => 'Tatkal'));
		// check already added for return
		$this->check_note_added($id);
		if($this->request->is('post')){ 
			// validates the form
			$this->TvlBookTkt->set($this->request->data);
			$this->TvlBookTkt->validate_avail();
			if ($this->TvlBookTkt->validates(array('fieldList' => array('avail','tvl_mode_id','book_mode','issue_date','suggestion')))) {
				// save the data
				$this->request->data['TvlBookTkt']['created_date'] = $this->Functions->get_current_date();
				$this->request->data['TvlBookTkt']['tvl_request_id'] = $id;
				$this->request->data['TvlBookTkt']['issue_date'] = $this->Functions->format_date_save($this->request->data['TvlBookTkt']['issue_date']);
				$this->request->data['TvlBookTkt']['tkt_type'] = $this->check_ticket_type();
				if($this->TvlBookTkt->TvlTicketStatus->save($this->request->data['TvlBookTkt'])){	
					// save travel desk status	
					if($this->check_td_status($id)){
						$this->TvlBookTkt->id = $id;					
						$this->TvlBookTkt->saveField('tdesk_status', 1);
					}
					
					$this->TvlBookTkt->bindModel(
						array('belongsTo' => array(
								'TvlStart' => array(
									'className' => 'TvlPlace',
									'foreignKey' => 'tvl_depart_id'
								)
							)
						)
					);
					$tvl_data = $this->TvlBookTkt->findById($id, array('fields' => 'app_users_id','tvl_code','start_date','return_date','TvlPlace.place','TvlStart.place'));
					// get user data
					$user_data = $this->TvlBookTkt->HrEmployee->findById($tvl_data['TvlBookTkt']['app_users_id'], array('fields' => 'first_name','last_name','email_address'));
					$vars = array('tvl_id' => $tvl_data['TvlBookTkt']['tvl_code'], 'name' => $user_data['HrEmployee']['first_name'].' '.$user_data['HrEmployee']['last_name'], 'avail' => $this->request->data['TvlBookTkt']['avail'], 'book_mode' => $this->request->data['TvlBookTkt']['book_mode'], 'issue_date' => $this->request->data['TvlBookTkt']['issue_date'],
					'mode' => $this->get_travel_mode($this->request->data['TvlBookTkt']['tvl_mode_id']),'remark' => $this->request->data['TvlBookTkt']['remark'],
					'suggestion' => $this->request->data['TvlBookTkt']['suggestion'], 'tvl_type' => $this->request->query['action'], 'return_date' => $tvl_data['TvlBookTkt']['return_date'],  'start_date' => $tvl_data['TvlBookTkt']['start_date'], 'start_place' => $tvl_data['TvlStart']['place'],  'dest_place' => $tvl_data['TvlPlace']['place'],  'from_name' => ucfirst($this->Session->read('USER.Login.first_name')).' '.ucfirst($this->Session->read('USER.Login.last_name')));
					// notify employee						
					if(!$this->send_email('My PDCA - Ticket Status Updated - '.$tvl_data['TvlBookTkt']['tvl_code'], 'ticket_status', 'noreply@mypdca.in', $user_data['HrEmployee']['email_address'],$vars)){		
						// show the msg.								
						$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in sending the mail to user...', 'default', array('class' => 'alert alert-error'));				
					}else{								
						}
					// show the msg.
					$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Ticket status sent successfully', 'default', array('class' => 'alert alert-success'));					
					$this->redirect('/tvlbooktkt/view_note/'.$id.'/?page=refresh&action='.$this->request->query['action']);
				}else{
					$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in saving ticket status', 'default', array('class' => 'alert alert-info'));
				}
				
			}else{
				$errors = $this->TvlBookTkt->validationErrors;
				//print_r($errors);
			}
		}		
	}
	
	/* check not already added for journey */
	public function check_note_added($id){
		$data = $this->TvlBookTkt->TvlTicketStatus->find('all', array('fields' => array('TvlTicketStatus.id'), 'conditions' => array('tvl_request_id' => $id, 'tkt_type' => $this->check_ticket_type())));
		if(!empty($data)){
			$return_url = $this->request->query['action'] ? '?action='.$this->request->query['action'] : '';
			$this->redirect('/tvlbooktkt/view_note/'.$id.'/'.$return_url);
		}
	}
	
	/* check travel desk status */
	public function check_td_status($id){
		// for one way trip
		if($this->request->query['trip'] == '1'){
			return '1';
		}else{
			// for round trip
			$count = $this->TvlBookTkt->TvlTicketStatus->find('count', array('conditions' => array('tvl_request_id' => $id)));
			if($count == 2){ 
				return '1';
			}
		}
	}
	
	/* check travel desk status */
	public function check_tkt_status($id){
		// for one way trip
		if($this->request->query['trip'] == 1){
			return '1';
		}else{
			// for round trip
			$count = $this->TvlBookTkt->TvlTicket->find('count', array('conditions' => array('TvlTicket.tvl_request_id' => $id)));
			if($count == 2){ 
				return '1';
			}
			
		}
	}
	
	/* function to check the ticket type */
	public function check_ticket_type(){
		if($this->request->query['action'] == 'return'){
			$type = 'R';
		}else{
			$type = 'O';
		}
		return $type;		
	}
	
	/* function to view note */
	public function view_note($id){
		$this->layout = 'iframe';		
		$type = $this->check_ticket_type();	
		$data = $this->TvlBookTkt->TvlTicketStatus->find('all', array('fields' => array('TvlTicketStatus.avail','TvlTicketStatus.book_mode','TvlTicketStatus.issue_date','TvlTicketStatus.remark','TvlTicketStatus.suggestion',
		'TvlMode.mode'), 'conditions' => array('TvlTicketStatus.tkt_type' => $type, 'TvlTicketStatus.tvl_request_id' => $id)));
		$this->set('ticket_update', $data[0]);
	}
	
		

			
	/* function to notify travel team */
	public function notify_tvl_desk($approver){
		// if no approver, change subject msg.
		if(empty($approver)){
			$sub_action = '';
		}else{
			$sub_action = '(No Action Required)';
		}			
		$approval_data = $this->TvlBookTkt->HrEmployee->find('all', array('fields' => array('id','email_address', 'first_name', 'last_name'), 'conditions'=> array('HrEmployee.app_roles_id' => '19', 'HrEmployee.status' => '1', 'HrEmployee.is_deleted' => 'N'), 'group' => array('HrEmployee.id')));
		foreach($approval_data as $tvl_data){
			if($superior_data['HrEmployee']['id'] != $tvl_data['HrEmployee']['id']){
				$vars = array('from_name' => ucfirst($this->Session->read('USER.Login.first_name')).' '.ucfirst($this->Session->read('USER.Login.last_name')),'name' => $tvl_data['HrEmployee']['first_name'].' '.$tvl_data['HrEmployee']['last_name'],'purpose' => $this->request->data['TvlBookTkt']['purpose'], 'start_date' => $this->request->data['TvlBookTkt']['start_date'], 'return_date' => $this->request->data['TvlBookTkt']['return_date'],
				'type' => $this->request->data['TvlBookTkt']['type'], 'mode' => $this->get_travel_mode($this->request->data['TvlBookTkt']['tvl_mode_id']),
				'place' => $this->get_travel_place($this->request->data['TvlBookTkt']['tvl_dest_id']),'client' => $this->get_customer_name($this->request->data['TvlBookTkt']['tsk_company_id']), 'class' => $this->get_travel_option($this->request->data['TvlBookTkt']['tvl_mode_option']));
				// notify superiors						
				if(!$this->send_email('My PDCA - '.ucfirst($this->Session->read('USER.Login.first_name')).' '.ucfirst($this->Session->read('USER.Login.last_name'))." created travel request $sub_action!", 'travel_creation', 'noreply@mypdca.in', $tvl_data['HrEmployee']['email_address'],$vars)){	
					// show the msg.								
					$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in sending the mail...', 'default', array('class' => 'alert alert-error'));				
				}else{
													
				}
			}
		}
	}
	

	
	/* function to load the travel id types */
	public function load_tvl_id_types(){
		$this->loadModel('TvlIdType');
		$id_list = $this->TvlIdType->find('list', array('fields' => array('id','title'), 'order' => array('id ASC'),'conditions' => array('is_deleted' => 'N', 'status' => '1')));
		$this->set('idList', $id_list);
	}
	
	
	/* function to load the places */
	public function load_places(){
		$this->loadModel('TvlPlace');
		$place_list = $this->TvlPlace->find('list', array('fields' => array('id','place'), 'order' => array('place ASC'),'conditions' => array('is_deleted' => 'N', 'status' => '1')));
		$this->set('placeList', $place_list);
	}
	
	
	
	/* function to get travel class */
	public function get_travel_option($values){
		$this->loadModel('TvlModeOption');
		$comma = ', ';
		$tot = count($values);
		foreach($values as $key => $id){
			$data = $this->TvlModeOption->findById($id, array('fields' => 'title'));			
			if(++$key >= $tot){ 
				$comma = '';
			} 
			$class .= $data['TvlModeOption']['title'].$comma;
			
		}
		return $class;
	}
	
	/* function to get travel mode */
	public function get_travel_mode($id){
		$data = $this->TvlBookTkt->TvlMode->findById($id, array('fields' => 'mode'));
		return $data['TvlMode']['mode'];
	}
	
	/* function to get employee id proof */
	public function get_emp_idproof($id){
		$this->loadModel('TvlIdType');
		$data = $this->TvlIdType->findById($id, array('fields' => 'title'));
		return $data['TvlIdType']['title'];
	}
	
	
	/* function to get travel place */
	public function get_travel_place($id){
		$this->loadModel('TvlPlace');
		$data = $this->TvlPlace->findById($id, array('fields' => 'place'));
		return $data['TvlPlace']['place'];
	}
	
	/* function to get customer name */
	public function get_customer_name($id){
		$comp = $this->TvlBookTkt->TskCustomer->findById($id, array('fields' => 'company_name'));
		return $comp['TskCustomer']['company_name'];
	}
	
	/* function to load the mode options */
	public function get_mode_option(){
		$this->layout = 'refresh';		
		$id = $this->request->query['id'];
		$this->loadModel('TvlModeOption');
		$data = $this->TvlModeOption->find('all', array('fields' => array('id','title'), 'conditions' => array('is_deleted' => 'N', 'tvl_mode_id' => $id, 'status' => '1'), 'order' => array('id' => 'asc')));		
		foreach($data as $option){ 
			$options .= "<option value=".$option['TvlModeOption']['id'].">".$option['TvlModeOption']['title']."</option>";
		}	
		echo $options;
		$this->render(false);
		die;
	}
	
	/* function to load the customer details */
	public function load_customers(){
		$comp_list = $this->TvlBookTkt->TskCustomer->find('list', array('fields' => array('id','company_name'), 'order' => array('company_name ASC'),'conditions' => array('is_deleted' => 'N', 'status' => '1')));
		$this->set('compList', $comp_list);
	}
	
	/* function to load travel mode */
	public function load_travel_mode(){
		$mode_list = $this->TvlBookTkt->TvlMode->find('list', array('fields' => array('id','mode'), 'order' => array('priority ASC'),'conditions' => array('is_deleted' => 'N', 'status' => '1')));
		$this->set('modeList', $mode_list);
	}
	
	/* function to load travel mode */
	public function load_travel_mode_option($id){ 
		$this->loadModel('TvlModeOption');
		$data = $this->TvlModeOption->find('list', array('fields' => array('id','title'), 'conditions' => array('is_deleted' => 'N', 'tvl_mode_id' => $id, 'status' => '1'), 'order' => array('id' => 'asc')));			
		$this->set('modeOption', $data);
	}
	
	
	
	/* function to auth record */
	public function auth_action($id){
		$data = $this->TvlBookTkt->findById($id, array('fields' => 'app_users_id','is_deleted'));	
		// check the req belongs to the user
		if($data['TvlBookTkt']['is_deleted'] == 'Y'){
			return ;
		}else{
			return 'pass';
		}
	}
	
	/* function to view the adv. request */
	public function book_ticket($id){
		// set the page title		
		$this->set('title_for_layout', 'Book Ticket - Biz Tour - My PDCA');
		if(!empty($id) && intval($id)){
			// authorize user before action
			$ret_value = $this->auth_action($id);
			if($ret_value == 'pass'){	
				$this->TvlBookTkt->bindModel(
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
				$data = $this->TvlBookTkt->findById($id, array('fields' => 'id','purpose','TskCustomer.company_name','start_date','return_date','expected_outcome',
				'spl_particular','desire_depart_to','desire_depart_from','desire_arrival_from','desire_arrival_to','desire_return_arrival_from','desire_return_arrival_to','desire_return_depart_from','desire_return_depart_to','TvlMode.mode',
				'TvlPlace.place','tvl_code','type', 'TvlStart.place', 'HrEmployee.first_name','HrEmployee.last_name','TvlDebit.company_name'));
				$this->set('tvl_data', $data);
				
				//get ticket data
				$tkt_data = $this->TvlBookTkt->TvlTicket->find('all', array('fields' => array('id', 'tkt_type'), 'conditions' => array('TvlTicket.tvl_request_id' => $id, 'tkt_type'  => 'O')));
				$this->set('tkt_data', $tkt_data);
				
				$tkt_data2 = $this->TvlBookTkt->TvlTicket->find('all', array('fields' => array('id', 'tkt_type'), 'conditions' => array('TvlTicket.tvl_request_id' => $id, 'tkt_type'  => 'R')));
				$this->set('tkt_data2', $tkt_data2);
				
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
				$this->redirect('/tvlbooktkt/');	
			}else{
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Record Deleted: '.$ret_value , 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/tvlbooktkt/');	
			}
		}else{
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));		
			$this->redirect('/tvlbooktkt/');	
		}
		
		
	}
	
	/* function to get travel remarks */
	public function get_tvl_remarks($id){ 
		// get remarks	
		$this->TvlBookTkt->bindModel(
			array('hasOne' => array(
					'TvlReqStatus' => array(
						'className' => 'TvlReqStatus',
						'foreignKey' => 'tvl_request_id',
						'conditions' => array('TvlReqStatus.type' => 'N')						
					)
				)
			)
		);
		$this->TvlBookTkt->TvlReqStatus->bindModel(
			array('belongsTo' => array(
					'HrEmployee' => array(
						'className' => 'HrEmployee',
						'foreignKey' => 'app_users_id'
					)
				)
			)
		);
		$remarks = $this->TvlBookTkt->TvlReqStatus->find('all', array('fields' => array('HrEmployee.first_name','HrEmployee.last_name', 
		'modified_date','remarks', 'HrEmployee.photo_status', 'HrEmployee.photo'), 'conditions' => array('tvl_request_id' => $id),'order' => array('TvlReqStatus.id' => 'desc'),
		'group' => array('TvlReqStatus.id'))); 	
		$this->set('lead_remarks', $remarks);
	}
	
	/* function to add the ticket details */
	public function add_ticket($id){
		$this->layout = 'iframe';
		// set booking list
		$this->set('bookList', array('CC' => 'Credit Card', 'A' => 'Agent', 'C' => 'Cash'));
		// when the form submitted
		if($this->request->is('post')){
			// validates the form
			$this->TvlBookTkt->TvlTicket->set($this->request->data); 
			$this->TvlBookTkt->TvlTicket->validate_agent_copy();
			if ($this->TvlBookTkt->TvlTicket->validates(array('fieldList' => array('amount','tkt1', 'book_via','book_ref_no','agent_copy1','book_date')))) {
				// save the ticket details
				$this->request->data['TvlTicket']['tvl_request_id'] = $id;
				$this->request->data['TvlTicket']['created_date'] = $this->Functions->get_current_date();
				$this->request->data['TvlTicket']['tkt'] = '';
				$this->request->data['TvlTicket']['agent_copy'] = '';
				$this->request->data['TvlTicket']['tkt_type'] = $this->check_ticket_type();	
				$this->request->data['TvlTicket']['book_date'] = $this->Functions->format_date_save($this->request->data['TvlTicket']['book_date']);				
				if($this->TvlBookTkt->TvlTicket->save($this->request->data, array('validate' => false))){
					if($tkt_file = $this->upload_attachment($this->request->data['TvlTicket']['tkt1'], $this->TvlBookTkt->TvlTicket->id)){						
						$this->TvlBookTkt->TvlTicket->saveField('tkt', $tkt_file);
					}
					if($file = $this->upload_attachment($this->request->data['TvlTicket']['agent_copy1'], $this->TvlBookTkt->TvlTicket->id)){						
						$this->TvlBookTkt->TvlTicket->saveField('agent_copy', $file);
					}
					// save travel desk status	
					if($this->check_tkt_status($id)){
						$this->TvlBookTkt->id = $id;					
						$this->TvlBookTkt->saveField('tkt_status', 1);
					}
					
					$this->TvlBookTkt->bindModel(
						array('belongsTo' => array(
								'TvlStart' => array(
									'className' => 'TvlPlace',
									'foreignKey' => 'tvl_depart_id'
								)
							)
						)
					);
					$tvl_data = $this->TvlBookTkt->findById($id, array('fields' => 'app_users_id','tvl_code','start_date','return_date','TvlPlace.place','TvlStart.place','purpose'));
					// get user data
					$user_data = $this->TvlBookTkt->HrEmployee->findById($tvl_data['TvlBookTkt']['app_users_id'], array('fields' => 'first_name','last_name','email_address'));
					// get passenger details
					$this->loadModel('TvlPassenger');
					$pass_data = $this->TvlPassenger->find('all', array('conditions' => array('tvl_request_id' => $id)));
					$vars = array('tvl_id' => $tvl_data['TvlBookTkt']['tvl_code'], 'tvl_person' => $pass_data, 'name' => $user_data['HrEmployee']['first_name'].' '.$user_data['HrEmployee']['last_name'],					
					'tvl_type' => $this->request->query['action'], 'purpose' => $tvl_data['TvlBookTkt']['purpose'], 'amount' => $this->request->data['TvlTicket']['amount'],  'return_date' => $tvl_data['TvlBookTkt']['return_date'],  'start_date' => $tvl_data['TvlBookTkt']['start_date'],
					'start_place' => $tvl_data['TvlStart']['place'],  'dest_place' => $tvl_data['TvlPlace']['place'],  'from_name' => ucfirst($this->Session->read('USER.Login.first_name')).' '.ucfirst($this->Session->read('USER.Login.last_name')));
					$attachment = WWW_ROOT.'/uploads/ticket/'.$tkt_file;
					// notify employee						
					if(!$this->send_email('My PDCA - Ticket Confirmation - '.$tvl_data['TvlBookTkt']['tvl_code'], 'book_ticket', 'noreply@mypdca.in', $user_data['HrEmployee']['email_address'],$vars,$attachment)){		
						// show the msg.								
						$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in sending the mail to user...', 'default', array('class' => 'alert alert-error'));				
					}else{								
						}
					// show the msg.
					$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Ticket sent successfully', 'default', array('class' => 'alert alert-success'));					
					$this->redirect('/tvlbooktkt/view_ticket/'.$this->TvlBookTkt->TvlTicket->id.'/'.$id.'/?page=refresh&tvl_type='.$this->request->data['TvlTicket']['tkt_type']);
				}else{
					$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in saving ticket details', 'default', array('class' => 'alert alert-info'));
				}
				
			}else{
				//print_r($this->TvlBookTkt->validationErrors);
			}			

		}
	}
	
	/* function to edit the ticket details */
	public function edit_ticket($id, $tvl_id){
		$this->layout = 'iframe';
		// set booking list
		$this->set('bookList', array('CC' => 'Credit Card', 'A' => 'Agent', 'C' => 'Cash'));
		// when the form submitted
		if(!empty($this->request->data)){
			// validates the form
			$this->TvlBookTkt->TvlTicket->set($this->request->data); 
			$this->TvlBookTkt->TvlTicket->validate_agent_copy();
			if ($this->TvlBookTkt->TvlTicket->validates(array('fieldList' => array('amount','book_date', 'book_via','book_ref_no','agent_copy1')))) {
				// save the ticket details
				$this->request->data['TvlTicket']['modified_date'] = $this->Functions->get_current_date();
				$this->request->data['TvlTicket']['agent_copy'] = '';
				$this->request->data['TvlTicket']['book_date'] = $this->Functions->format_date_save($this->request->data['TvlTicket']['book_date']);
				$this->TvlBookTkt->TvlTicket->id = $id;
				if($this->TvlBookTkt->TvlTicket->save($this->request->data, array('validate' => false))){ 
					if($file = $this->upload_attachment($this->request->data['TvlTicket']['agent_copy1'], $id)){						
						$this->TvlBookTkt->TvlTicket->saveField('agent_copy', $file);
					}
					// show the msg.
					$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Ticket details modified successfully', 'default', array('class' => 'alert alert-success'));					
					$this->redirect('/tvlbooktkt/view_ticket/'.$id.'/'.$tvl_id.'/?tvl_type='.$this->request->query['tvl_type']);
				}else{
					$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in saving ticket details', 'default', array('class' => 'alert alert-info'));
				}
				
			}else{
				//print_r($this->TvlBookTkt->validationErrors);
			}			

		}else{
			$this->request->data = $this->TvlBookTkt->TvlTicket->findById($id);
			$this->request->data['TvlTicket']['book_date'] = $this->Functions->format_date_show($this->request->data['TvlTicket']['book_date']);
		}
	}
	
	/* function to upload the file */
	public function upload_attachment($data, $id){
		// validate the file				
		if(!empty($data['tmp_name'])){
			$file = $id.'_'.$data['name']; 
			if($this->upload_file($data['tmp_name'], WWW_ROOT.'/uploads/ticket/'.$file)){
				return $file;
			}			
		}
				
	}
	
	/* function to view note */
	public function view_ticket($id){
		$this->layout = 'iframe';
		$data = $this->TvlBookTkt->TvlTicket->findById($id, array('fields' => 'TvlTicket.amount', 'TvlTicket.book_date', 'TvlTicket.tkt', 'TvlTicket.book_via','TvlTicket.book_ref_no','TvlTicket.agent_copy'));
		$this->set('ticket', $data);
	}
	
	/* clear the cache */
	
	public function beforeFilter() { 
		//$this->disable_cache();
		$this->show_tabs(73);		
	}
	
		
		/* auto complete search */	
	public function search(){ 
		$this->layout = false;	 
		$q = trim(Sanitize::escape($_GET['q']));	
		if(!empty($q)){
			// execute only when the search keywork has value		
			$this->set('keyword', $q);
			$data = $this->TvlBookTkt->find('all', array('fields' => array('tvl_code','TskCustomer.company_name','TvlPlace.place'),  'group' => array('tvl_code','TskCustomer.company_name','TvlPlace.place'), 'conditions' => 	$conditions =  array("OR" => array ('tvl_code like' => '%'.$q.'%',
			'TskCustomer.company_name like' => '%'.$q.'%', 'TvlPlace.place like' => '%'.$q.'%'), 'AND' => array('TvlBookTkt.is_deleted' => 'N', 'TvlBookTkt.is_approve' => 'Y'))));		
			$this->set('results', $data);
		}
    }
	
	
	
	
}