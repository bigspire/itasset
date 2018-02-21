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
class TvlcantktController extends AppController {  
	
	public $name = 'TvlCanTkt';	
	
	public $helpers = array('Html', 'Form', 'Session');
	
	public $components = array('Session', 'Functions');
	
	public $layout = 'apps';	

	/* function to list the adv. requests */
	public function index(){	
		// set the page title
		$this->set('title_for_layout', 'Cancel Ticket - Biz Tour - My PDCA');
		// when the form is submitted for search
		if($this->request->is('post')){
			$url_vars = $this->Functions->create_url(array('keyword','emp_id'),'TvlCanTkt'); 
			$this->redirect('/tvlcantkt/?'.$url_vars);			
		}
		
		// get employee list
		$format_list = $this->TvlCanTkt->HrEmployee->find('list', array('fields' => array('HrEmployee.id', 'HrEmployee.full_name'), 'conditions' => array('HrEmployee.status' => '1', 'HrEmployee.is_deleted'=> 'N'), 'order' => array('HrEmployee.full_name' => 'asc')));
		$this->set('empList', $format_list);
		
		if($this->params->query['keyword'] != ''){
			$keyCond = array("MATCH (tvl_code,TskCustomer.company_name,TvlPlace.place,purpose) AGAINST ('".$this->params->query['keyword']."' IN BOOLEAN MODE)"); 
		}					
		if($this->params->query['emp_id'] != ''){
			$empCond = array('TvlCanTkt.app_users_id' => $this->params->query['emp_id']); 
		}
		// fetch the advances		
		$this->paginate = array('fields' => array('id','TvlTicket.id','TvlCancel.id','purpose','tvl_dest_id','tvl_code','type','TvlPlace.place','start_date','TvlMode.mode','created_date','HrEmployee.first_name','HrEmployee.last_name','tkt_cancel_status','TvlCancel.reason'),'limit' => 10,'conditions' => array($keyCond,$empCond,'TvlCanTkt.is_deleted' => 'N', 'TvlTicket.id !=' => '', 'TvlCanTkt.status' => 'C'), 'order' => array('created_date' => 'desc'), 'group' => array('TvlCanTkt.id'));
		$data = $this->paginate('TvlCanTkt');
		
		$this->set('tvl_data', $data);
		
		if(empty($data)){
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>You have no tickets to cancel', 'default', array('class' => 'alert alert'));	
		}
		
		
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
		$data = $this->TvlCanTkt->TvlMode->findById($id, array('fields' => 'mode'));
		return $data['TvlMode']['mode'];
	}
	
	/* function to get employee id proof */
	public function get_emp_idproof($id){
		$this->loadModel('TvlIdType');
		$data = $this->TvlIdType->findById($id, array('fields' => 'title'));
		return $data['TvlIdType']['title'];
	}
	
	/* function to view the adv. request */
	public function cancel_ticket($id){
		// set the page title		
		$this->set('title_for_layout', 'View Travel - Biz Tour - My PDCA');
		if(!empty($id) && intval($id)){
			// authorize user before action
			$ret_value = $this->auth_action($id);
			if($ret_value == 'pass'){				
				$this->TvlCanTkt->bindModel(
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
				$data = $this->TvlCanTkt->findById($id, array('fields' => 'id','purpose','TskCustomer.company_name','start_date','return_date','expected_outcome',
				'spl_particular','desire_depart_to','desire_depart_from','desire_arrival_from','desire_arrival_to','desire_return_arrival_from','desire_return_arrival_to','desire_return_depart_from','desire_return_depart_to','TvlMode.mode',
				'TvlPlace.place','tvl_code','type', 'TvlStart.place', 'HrEmployee.first_name','HrEmployee.last_name','TvlCancel.reason','TvlDebit.company_name'));
				$this->set('tvl_data', $data);
				
				//get ticket data
				$tkt_data = $this->TvlCanTkt->TvlTicket->find('all', array('fields' => array('id','TvlTicketCancel.tvl_ticket_id'), 'conditions' => array('TvlTicket.tvl_request_id' => $id, 'tkt_type'  => 'O')));
				$this->set('tkt_data', $tkt_data);
				
				$tkt_data2 = $this->TvlCanTkt->TvlTicket->find('all', array('fields' => array('id', 'TvlTicketCancel.tvl_ticket_id'), 'conditions' => array('TvlTicket.tvl_request_id' => $id, 'tkt_type'  => 'R')));
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
				$this->redirect('/tvlcantkt/');	
			}else{
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Record Deleted: '.$ret_value , 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/tvlcantkt/');	
			}			
		}else{
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));		
			$this->redirect('/tvlcantkt/');	
		}
	}
	
	/* function to get travel remarks */
	public function get_tvl_remarks($id){ 
		// get remarks	
		$this->TvlCanTkt->TvlReqStatus->bindModel(
			array('belongsTo' => array(
					'HrEmployee' => array(
						'className' => 'HrEmployee',
						'foreignKey' => 'app_users_id'
						
					)
				)
			)
		);
		$remarks = $this->TvlCanTkt->TvlReqStatus->find('all', array('fields' => array('HrEmployee.first_name','HrEmployee.last_name', 
		'modified_date','remarks', 'HrEmployee.photo_status', 'HrEmployee.photo'), 'conditions' => array('tvl_request_id' => $id),'order' => array('TvlReqStatus.id' => 'desc'),
		'group' => array('TvlReqStatus.id'))); 	
		$this->set('lead_remarks', $remarks);
	}
	
	/* function to edit the cancel ticket details */
	public function edit_ticket($id, $tvl_id){
		$this->layout = 'iframe';		
		// when the form submitted
		if($this->request->is('post')){
			// validates the form
			$this->loadModel('TvlTicketCancel');
			$this->TvlTicketCancel->set($this->request->data); 
			if ($this->TvlTicketCancel->validates(array('fieldList' => array('cancel_fee')))) {
				// save the ticket details
				$this->request->data['TvlTicketCancel']['tvl_ticket_id'] = $id;
				$this->request->data['TvlTicketCancel']['tvl_request_id'] = $tvl_id;
				$this->request->data['TvlTicketCancel']['created_date'] = $this->Functions->get_current_date();
				$this->request->data['TvlTicketCancel']['created_by'] = $this->Session->read('USER.Login.id');				
				if($this->TvlTicketCancel->save($this->request->data, array('validate' => false))){
					
					// save travel desk status	
					if($this->check_can_tkt_status($tvl_id)){
						$this->TvlCanTkt->id = $tvl_id;					
						$this->TvlCanTkt->saveField('tkt_cancel_status', 1);
					}
				
					// show the msg.
					$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Ticket cancelled successfully', 'default', array('class' => 'alert alert-success'));					
					$this->redirect('/tvlcantkt/view_ticket/'.$id.'/?page=refresh&tvl_type='.$this->request->data['TvlTicketCancel']['tkt_type']);
				}else{
					$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in saving cancel ticket details', 'default', array('class' => 'alert alert-info'));
				}
				
			}else{
				//print_r($this->TvlCanTkt->validationErrors);
			}			

		}
	}
	
	/* check travel desk status */
	public function check_can_tkt_status($tvl_id){
		// for one way trip
		if(empty($this->request->query['action'])){
			return '1';
		}else{
			// for round trip
			$count = $this->TvlCanTkt->TvlTicketCancel->find('count', array('conditions' => array('tvl_request_id' => $id)));
			if($count == 2){ 
				return '1';
			}
		}
	}
	
	/* function to view note */
	public function view_ticket($id){
		$this->layout = 'iframe';
		$data = $this->TvlCanTkt->TvlTicket->find('all', array('fields' => array('TvlTicketCancel.cancel_fee', 'TvlTicketCancel.remark'), 'conditions' => array('TvlTicketCancel.tvl_ticket_id' => $id)));
		$this->set('ticket', $data[0]);
	}
	
	
	/* function to get travel place */
	public function get_travel_place($id){
		$this->loadModel('TvlPlace');
		$data = $this->TvlPlace->findById($id, array('fields' => 'place'));
		return $data['TvlPlace']['place'];
	}
	
	/* function to get customer name */
	public function get_customer_name($id){
		$comp = $this->TvlCanTkt->TskCustomer->findById($id, array('fields' => 'company_name'));
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
		$comp_list = $this->TvlCanTkt->TskCustomer->find('list', array('fields' => array('id','company_name'), 'order' => array('company_name ASC'),'conditions' => array('is_deleted' => 'N', 'status' => '1')));
		$this->set('compList', $comp_list);
	}
	
	/* function to load travel mode */
	public function load_travel_mode(){
		$mode_list = $this->TvlCanTkt->TvlMode->find('list', array('fields' => array('id','mode'), 'order' => array('priority ASC'),'conditions' => array('is_deleted' => 'N', 'status' => '1')));
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
		$data = $this->TvlCanTkt->findById($id, array('fields' => 'app_users_id','is_deleted'));	
		// check the req belongs to the user
		if($data['TvlCanTkt']['is_deleted'] == 'Y'){
			return ;
		}else{
			return 'pass';
		}
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
			$data = $this->TvlCanTkt->find('all', array('fields' => array('tvl_code','TskCustomer.company_name','TvlPlace.place'),  'group' => array('tvl_code','TskCustomer.company_name','TvlPlace.place'), 'conditions' => 	$conditions =  array("OR" => array ('tvl_code like' => '%'.$q.'%',
			'TskCustomer.company_name like' => '%'.$q.'%', 'TvlPlace.place like' => '%'.$q.'%'), 'AND' => array('TvlCanTkt.is_deleted' => 'N', 'TvlCanTkt.is_approve' => 'Y', 'TvlCanTkt.status' => 'C', 'TvlTicket.id !=' => ''))));		
			$this->set('results', $data);
		}
    }
	
	
	
	
}