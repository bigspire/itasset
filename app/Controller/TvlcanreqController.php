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
class TvlcanreqController extends AppController {  
	
	public $name = 'TvlCanReq';	
	
	public $helpers = array('Html', 'Form', 'Session');
	
	public $components = array('Session', 'Functions');
	
	public $layout = 'apps';	

	/* function to list the adv. requests */
	public function index(){	
		// set the page title
		$this->set('title_for_layout', 'Cancel Travel - Biz Tour - My PDCA');
		// when the form is submitted for search
		if($this->request->is('post')){
			$url_vars = $this->Functions->create_url(array('keyword'),'TvlCanReq'); 
			$this->redirect('/tvlcanreq/?'.$url_vars);			
		}
		if($this->params->query['keyword'] != ''){
			$keyCond = array("MATCH (tvl_code,TskCustomer.company_name,TvlPlace.place,purpose) AGAINST ('".$this->params->query['keyword']."' IN BOOLEAN MODE)"); 
		}	
		
		$options = array(			
			array('table' => 'tvl_req_status',
					'alias' => 'TvlReqStatuses',					
					'type' => 'INNER',
					'conditions' => array('`TvlReqStatuses`.`tvl_request_id` = `TvlCanReq`.`id`', 'TvlReqStatuses.type' => 'C')
			),
			array('table' => 'app_users',
					'alias' => 'Homes',					
					'type' => 'LEFT',
					'conditions' => array('`TvlReqStatuses`.`app_users_id` = `Homes`.`id`')
			)
		);
			
							
		$this->TvlCanReq->unBindModel(array('hasOne' => array('TvlReqStatus')));

		// fetch the advances		
		$this->paginate = array('fields' => array('id','purpose','tvl_dest_id','tvl_code','type','TvlPlace.place','start_date','TvlMode.mode','TskCustomer.company_name','TvlCancel.reason', 'created_date','group_concat(TvlReqStatuses.status) as st_status', 'group_concat(Homes.first_name) as st_user', 'group_concat(TvlReqStatuses.modified_date) as st_modified','group_concat(TvlReqStatuses.created_date) as st_created', 'group_concat(TvlReqStatuses.remarks) as st_remarks'),'limit' => 10,'conditions' => array($keyCond,'TvlCanReq.app_users_id' => $this->Session->read('USER.Login.id'),'TvlCanReq.is_deleted' => 'N'), 'order' => array('created_date' => 'desc'), 'group' => array('TvlCanReq.id'), 'joins' => $options);
		$data = $this->paginate('TvlCanReq');
		
		$this->set('tvl_data', $data);
		if(empty($data)){
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>You have no cancel request found', 'default', array('class' => 'alert alert'));	
		}
	
		
	}
	
	
		

	/* function to generate travel req. id */
	public function gen_travel_code($id){
		$this->TvlCanReq->id = $id;
		$this->TvlCanReq->saveField('tvl_code', 'TVL'.str_pad($id, 3, 0, STR_PAD_LEFT));
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
		$data = $this->TvlCanReq->TvlMode->findById($id, array('fields' => 'mode'));
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
		$comp = $this->TvlCanReq->TskCustomer->findById($id, array('fields' => 'company_name'));
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
		$comp_list = $this->TvlCanReq->TskCustomer->find('list', array('fields' => array('id','company_name'), 'order' => array('company_name ASC'),'conditions' => array('is_deleted' => 'N', 'status' => '1')));
		$this->set('compList', $comp_list);
	}
	
	/* function to load travel mode */
	public function load_travel_mode(){
		$mode_list = $this->TvlCanReq->TvlMode->find('list', array('fields' => array('id','mode'), 'order' => array('priority ASC'),'conditions' => array('is_deleted' => 'N', 'status' => '1')));
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
		$data = $this->TvlCanReq->findById($id, array('fields' => 'app_users_id','is_deleted'));	
		// check the req belongs to the user
		if($data['TvlCanReq']['is_deleted'] == 'Y'){
			return ;
		}		
		else if($data['TvlCanReq']['app_users_id'] == $this->Session->read('USER.Login.id')){	
			return 'pass';
		}else{
			return 'fail';
		}
	}
	
	/* function to view the adv. request */
	public function view_request($id){
		// set the page title		
		$this->set('title_for_layout', 'View Travel - Biz Tour - My PDCA');
		if(!empty($id) && intval($id)){
			// authorize user before action
			$ret_value = $this->auth_action($id);
			if($ret_value == 'pass'){	
				$this->TvlCanReq->bindModel(
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
				$data = $this->TvlCanReq->findById($id, array('fields' => 'id','purpose','TskCustomer.company_name','start_date','return_date','expected_outcome',
				'spl_particular','desire_depart_to','desire_depart_from','desire_arrival_from','desire_arrival_to','desire_return_arrival_from','desire_return_arrival_to','desire_return_depart_from','desire_return_depart_to','TvlMode.mode',
				'TvlPlace.place','tvl_code','type', 'TvlStart.place','TvlCancel.reason','TvlDebit.company_name'));
				$this->set('tvl_data', $data);
				// get passenger details
				$this->loadModel('TvlPassenger');
				$data = $this->TvlPassenger->find('all', array('conditions' => array('tvl_request_id' => $id)));
				$this->set('tvl_person', $data);
				// get travel mode options
				$this->loadModel('TvlReqClass');
				$data = $this->TvlReqClass->find('all', array('fields' => array('group_concat(TvlModeOption.title) tvl_req_class'), 'conditions' => array('TvlReqClass.tvl_request_id' => $id)));
				$this->set('tvl_class_data', $data);				
			}else if($ret_value == 'fail'){ 
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/tvlcanreq/');	
			}else{
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Record Deleted: '.$ret_value , 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/tvlcanreq/');	
			}
		}else{
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));		
			$this->redirect('/tvlcanreq/');	
		}
		
		
	}
	
	/* clear the cache */
	
	public function beforeFilter() { 
		//$this->disable_cache();
		$this->show_tabs(81);		
	}
	
		
		/* auto complete search */	
	public function search(){ 
		$this->layout = false;	 
		$q = trim(Sanitize::escape($_GET['q']));	
		if(!empty($q)){
			// execute only when the search keywork has value		
			$this->set('keyword', $q);
			$data = $this->TvlCanReq->find('all', array('fields' => array('tvl_code','TskCustomer.company_name','TvlPlace.place'),  'group' => array('tvl_code','TskCustomer.company_name','TvlPlace.place'), 'conditions' => 	$conditions =  array("OR" => array ('tvl_code like' => '%'.$q.'%',
			'TskCustomer.company_name like' => '%'.$q.'%', 'TvlPlace.place like' => '%'.$q.'%'), 'AND' => array('TvlCanReq.is_deleted' => 'N', 'TvlReqStatus.type' => 'C', 'TvlCanReq.app_users_id' => $this->Session->read('USER.Login.id')))));		
			$this->set('results', $data);
		}
    }
	
	
	
	
}