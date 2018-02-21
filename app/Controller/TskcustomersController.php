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
 
class TskcustomersController extends AppController {  
	
	public $name = 'TskCustomers';	
	
	public $helpers = array('Html', 'Form', 'Session');
	
	public $components = array('Session', 'Functions');
	
	public $layout = 'apps';	

	/* function to list the adv. requests */
	public function index(){	
		// set the page title
		$this->set('title_for_layout', 'Customers - Finance - My PDCA');
		// when the form is submitted for search
		if($this->request->is('post')){
			$this->redirect('/tskcustomers/?keyword='.$this->request->data['TskCustomer']['SearchText']);			
		}
		if($this->params->query['keyword'] != ''){
			$keyCond = array("MATCH (company_name) AGAINST ('".$this->params->query['keyword']."' IN BOOLEAN MODE)"); 
		}
		// fetch the advances		
		$this->paginate = array('fields' => array('id','company_name', 'email','phone','city','type','created_date','status'),'limit' => 10,'conditions' => array($keyCond, 'is_deleted' => 'N'), 'order' => array('created_date' => 'desc'));
		$data = $this->paginate('TskCustomer');			
		$this->set('cust_data', $data);
		if(empty($data)){
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>You havn\'t created any customers', 'default', array('class' => 'alert alert'));	
		}
		
		
	}
	
	/* function to save the customer */
	public function create_customer(){ 
		// set the page title		
		$this->set('title_for_layout', 'Create Customer - Finance - My PDCA');	
		// fetch the list of states
		$this->loadModel('State');
		$state_list = $this->State->find('list', array('fields' => array('id','state_name'), 'order' => array('state_name ASC'),'conditions' => array('State.status' => 1)));
		$this->set('stateList', $state_list);
		// fetch the company types
		$this->set_company_types();
		if ($this->request->is('post')){ 
			// validates the form
			$this->TskCustomer->set($this->request->data);
			if ($this->TskCustomer->validates(array('fieldList' => array('company_name', 'email','phone','address','city','zip','type','app_state_id','status')))) {
				$this->request->data['TskCustomer']['created_by'] = $this->Session->read('USER.Login.id');				
				$this->request->data['TskCustomer']['created_date'] = $this->Functions->get_current_date();
				// save the data
				if($this->TskCustomer->save($this->request->data['TskCustomer'])) {					
					// show the msg.
					$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Company details created successfully', 'default', array('class' => 'alert alert-success'));
					$this->redirect('/tskcustomers/');
				}else{
					$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in saving the data...', 'default', array('class' => 'alert alert-error'));
				}
			}else{
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in submitting the form. please check errors...', 'default', array('class' => 'alert alert-error'));	
			}
		}
	}
	
	/* function to set the company types */
	public function set_company_types(){
		$types = array('C' => 'Client', 'V' => 'Vendor', 'S' => 'Supplier', 'CO' => 'Consultant', 'G' => 'Government', 'I' => 'Internal');
		$this->set('compTypes', $types);
	}
	
	/* function to delete the adv. request */
	public function delete_customer($id){
		if(!empty($id) && intval($id)){
			// authorize user before action
			$ret_value = $this->auth_action($id);
			if($ret_value == 'pass'){				
				$this->TskCustomer->id = $id;
				$this->TskCustomer->saveField('is_deleted', 'Y'); 
				$this->TskCustomer->saveField('modified_date', $this->Functions->get_current_date()); 
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Customer deleted successfully', 'default', array('class' => 'alert alert-success'));				
			}else if($ret_value == 'fail'){
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/tskcustomers/');
			}else{
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Record Deleted: '.$ret_value , 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/tskcustomers/');
			}
		}else{
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));			
		}
		$this->redirect('/tskcustomers/');
	}
	
	
	/* function to edit the advance */
	public function edit_customer($id){	
		// set the page title		
		$this->set('title_for_layout', 'Edit Customer - Finance - My PDCA');				
		// fetch the list of states
		$this->loadModel('State');
		$state_list = $this->State->find('list', array('fields' => array('id','state_name'), 'order' => array('state_name ASC'),'conditions' => array('State.status' => 1)));
		$this->set('stateList', $state_list);
		// fetch the company types
		$this->set_company_types();
		if (!empty($id) && intval($id)){
			// authorize user before action
			$ret_value = $this->auth_action($id);
			if($ret_value == 'pass'){	
				// when the form submitted
				if (!empty($this->request->data)){ 
					// validates the form
					$this->TskCustomer->set($this->request->data);
					if ($this->TskCustomer->validates(array('fieldList' => array('company_name', 'email','phone','address','city','zip','type','app_state_id','status')))) {
						$this->request->data['TskCustomer']['modified_by'] = $this->Session->read('USER.Login.id');				
						$this->request->data['TskCustomer']['modified_date'] = $this->Functions->get_current_date();				
						// save the data
						if($this->TskCustomer->save($this->request->data['TskCustomer'])) {					
							// show the msg.
							$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Customer details modified successfully', 'default', array('class' => 'alert alert-success'));
						}else{
							// show the error msg.
							$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in saving the data...', 'default', array('class' => 'alert alert-error'));					
						}					
					$this->redirect('/tskcustomers/');						
					}	
				}else{
					$this->request->data = $this->TskCustomer->findById($id);
					
				}
			}else if($ret_value == 'fail'){
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/tskcustomers/');
			}else{
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Record Deleted: '.$ret_value , 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/tskcustomers/');
			}
		}else{
			// show the error msg.
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));
			$this->redirect('/tskcustomers/');		
		}		
		
	}
	
	/* function to auth record */
	public function auth_action($id){
		$data = $this->TskCustomer->findById($id, array('fields' => 'id','is_deleted','modified_date'));	
		// check the req belongs to the user
		if($data['TskCustomer']['is_deleted'] == 'Y'){
			return $data['TskCustomer']['modified_date'];
		}		
		else if(empty($data)){	
			return 'fail';
		}else{
			return 'pass';
		}
	}
	
	/* function to view the adv. request */
	public function view_customer($id){
		// set the page title		
		$this->set('title_for_layout', 'View Customer - Finance - My PDCA');
		if(!empty($id) && intval($id)){
			// authorize user before action
			$ret_value = $this->auth_action($id);
			if($ret_value == 'pass'){	
				$data = $this->TskCustomer->findById($id);
				$this->set('cust_data', $data);
			}else if($ret_value == 'fail'){ 
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/tskcustomers/');	
			}else{
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Record Deleted: '.$ret_value , 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/tskcustomers/');	
			}
		}else{
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));		
			$this->redirect('/tskcustomers/');	
		}
		
		
	}
	
	/* clear the cache */
	
	public function beforeFilter() { 
		//$this->disable_cache();
		$this->show_tabs(11);
	}
	
	
		/* auto complete search */	
	public function search(){ 
		$this->layout = false;	 
		$q = trim(Sanitize::escape($_GET['q']));	
		if(!empty($q)){
			// execute only when the search keywork has value		
			$this->set('keyword', $q);
			$data = $this->TskCustomer->find('all', array('fields' => array('company_name'),  'group' => array('company_name'), 'conditions' => 	$conditions =  array("OR" => array ('company_name like' => '%'.$q.'%'), 'AND' => array('is_deleted' => 'N'))));		
			$this->set('results', $data);
		}
    }
	
	
	
}