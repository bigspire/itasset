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
 
class HrcompanyController extends AppController {  
	
	public $name = 'HrCompany';	
	
	public $helpers = array('Html', 'Form', 'Session');
	
	public $components = array('Session', 'Functions');
	
	public $layout = 'apps';	

	/* function to list the adv. requests */
	public function index(){	
		// set the page title
		$this->set('title_for_layout', 'Company - HRIS - My PDCA');		
		// fetch the advances		
		$this->paginate = array('fields' => array('id','company_name', 'State.state_name', 'modified_date', 'city','landline','created_date'),'limit' => 10,'conditions' => array($keyCond), 'order' => array('created_date' => 'desc'));
		$data = $this->paginate('HrCompany');			
		$this->set('cust_data', $data);
		if(empty($data)){
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>You havn\'t created any companies', 'default', array('class' => 'alert alert'));	
		}
		
		
	}
	
	/* function to upload the file */
	public function upload_attachment($data, $id){
		// validate the file				
		if(!empty($data['tmp_name'])){
			$file = $id.'_'.$data['name']; 
			if($this->upload_file($data['tmp_name'], WWW_ROOT.'/uploads/company/'.$file)){
				return $file;
			}			
		}
				
	}
	
	
	
	/* function to edit the advance */
	public function edit_company($id){	
		// set the page title		
		$this->set('title_for_layout', 'Edit Customer - HRIS - My PDCA');				
		// fetch the list of states
		$this->loadModel('State');
		$state_list = $this->State->find('list', array('fields' => array('id','state_name'), 'order' => array('state_name ASC'),'conditions' => array('State.status' => 1)));
		$this->set('stateList', $state_list);
		// check its a valid id
		if (!empty($id) && intval($id)){ 
			// when the form submitted
				if (!empty($this->request->data)){ 
					$this->HrCompany->set($this->request->data);
					// validate the file
					$this->HrCompany->validate_file();
					if ($this->HrCompany->validates(array('fieldList' => array('company_name', 'landline','address','city','app_state_id','pincode','bank_name','account_name','account_no','bank_name','branch_address')))) {
						$this->request->data['HrCompany']['modified_by'] = $this->Session->read('USER.Login.id');				
						$this->request->data['HrCompany']['modified_date'] = $this->Functions->get_current_date();				
						// save the data
					if($this->HrCompany->save($this->request->data['HrCompany'])) {	
						// upload the file
						if($file = $this->upload_attachment($this->request->data['HrCompany']['upload_file'], $id)){
							
							$this->HrCompany->saveField('logo', $file);
						}
						// show the msg.
						$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Company details modified successfully', 'default', array('class' => 'alert alert-success'));
						$this->redirect('/hrcompany/');
					}else{
						// show the error msg.
						$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in saving the data...', 'default', array('class' => 'alert alert-error'));					
					}					
							
				}
			}else{
				$this->request->data = $this->HrCompany->findById($id);
			}
		
		}else{
			// show the msg.
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));					
			}					
	}
	
	
			
	/* function to view the adv. request */
	public function view_company($id){
		// set the page title		
		$this->set('title_for_layout', 'View Company - HRIS - My PDCA');
		if(!empty($id) && intval($id)){			
				$data = $this->HrCompany->findById($id);
				$this->set('comp_data', $data);
			}else{ 
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/hrcompany/');	
			}
	}
	
	/* clear the cache */
	
	public function beforeFilter() { 
		//$this->disable_cache();
		$this->show_tabs(15);
	}
	

	
	
	
}