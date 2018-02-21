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
 
class HrbankaccController extends AppController {  
	
	public $name = 'HrBankAcc';	
	
	public $helpers = array('Html', 'Form', 'Session');
	
	public $components = array('Session', 'Functions');
	
	public $layout = 'apps';	

	/* function to list the adv. requests */
	public function index(){	
		// set the page title
		$this->set('title_for_layout', 'Bank Account - HRIS - My PDCA');
		// when the form is submitted for search
		if($this->request->is('post')){
			$url_vars = $this->Functions->create_url(array('keyword'),'HrBankAcc'); 
			$this->redirect('/hrbankacc/?'.$url_vars);					
		}
		if($this->params->query['keyword'] != ''){
			$keyCond = array("MATCH (acc_name,acc_no,HrEmployee.first_name) AGAINST ('".$this->params->query['keyword']."' IN BOOLEAN MODE)"); 
		}
		
		$options = array(	
			array('table' => 'hr_bank_account',
					'alias' => 'HrBankAcc',					
					'type' => 'LEFT',
					'conditions' => array('`HrBankAcc`.`app_users_id` = `HrEmployee`.`id`')
			),
			array('table' => 'hr_bank',
					'alias' => 'HrBank',					
					'type' => 'LEFT',
					'conditions' => array('`HrBank`.`id` = `HrBankAcc`.`hr_bank_id`')
			)
		);
			
		
		$this->HrBankAcc->HrEmployee->unBindModel(array('belongsTo' => array('HrDepartment','HrDesignation','HrGrade','Role','HrCompany','HrBranch')));
		//$this->HrBankAcc->HrEmployee->BindModel(array('hasOne' => array('HrBankAcc')));
		// fetch the advances		
		$this->paginate = array('fields' => array('id','HrBankAcc.id', 'HrBankAcc.acc_no', 'HrBankAcc.acc_name', 
		'HrEmployee.first_name', 'HrEmployee.last_name', 'HrBank.bank', 'HrBank.branch','HrBank.ifsc',
		'HrBankAcc.created_date'),'limit' => 50,  'conditions' => array($keyCond, 'HrEmployee.is_deleted' => 'N','HrEmployee.status' => '1'), 
		'order' => array('HrEmployee.first_name' => 'asc'), 'joins' => $options, 'group' => array('HrEmployee.id'));
		$data = $this->paginate('HrEmployee');			
		$this->set('bnk_data', $data);
		if(empty($data)){
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>You havn\'t created any bank accounts', 'default', array('class' => 'alert alert'));	
		}
		
	}
	

		
	
	/* function to edit the form */
	public function edit_account($id,$bnkid){
		$this->layout = 'iframe';
		// set the page title		
		$this->set('title_for_layout', 'Edit Bank Account - HRIS - My PDCA');		
		// unbind unwanted models
		$this->HrBankAcc->HrEmployee->unBindModel(array('belongsTo' => array('HrDepartment','HrDesignation','HrGrade','Role','HrCompany','HrBranch')));
		// get employee
		$emp_data = $this->HrBankAcc->HrEmployee->findById($id, array('fields ' => 'full_name'));
		$this->set('emp_data', $emp_data);
		// load bank details
		$bank_list = $this->HrBankAcc->HrBank->find('list', array('fields' => array('id','bankbranch'), 'order' => array('bank ASC'),'conditions' => array('status' => 1, 'is_deleted' => 'N')));
		$this->set('bankList', $bank_list);
		
		
				
		// when the form submitted
		if (!empty($this->request->data)){ 
			// validates the form
			$this->HrBankAcc->set($this->request->data);				
			if ($this->HrBankAcc->validates(array('fieldList' => array('bank', 'branch', 'ifsc')))) {
					$this->request->data['HrBankAcc']['app_users_id'] = $id;
					// check edit or new
					if(empty($bnkid)){
						$this->HrBankAcc->id = '';
						$this->request->data['HrBankAcc']['created_date'] = $this->Functions->get_current_date();
						$this->request->data['HrBankAcc']['created_by'] = $this->Session->read('USER.Login.id');
					}else{
						$this->HrBankAcc->id = $bnkid;
						$this->request->data['HrBankAcc']['modified_by'] = $this->Session->read('USER.Login.id');	
						$this->request->data['HrBankAcc']['modified_date'] = $this->Functions->get_current_date();
					}
					// save the data
					if($this->HrBankAcc->save($this->request->data['HrBankAcc'])) {								
						// show the msg.
						$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Account details updated successfully', 'default', array('class' => 'alert alert-success'));						
						$this->redirect('/hrbankacc/edit_account/'.$id.'/'.$this->HrBankAcc->id.'/?action=view');
					}			
				}	
			}else{
				$this->request->data = $this->HrBankAcc->findByAppUsersId($id);	
				
			}
	}
	
	
	/* clear the cache */
	
	public function beforeFilter() { 
		//$this->disable_cache();
		$this->show_tabs(40);
	}
	
	
		/* auto complete search */	
	public function search(){ 
		$this->layout = false;	 
		$q = trim(Sanitize::escape($_GET['q']));	
		if(!empty($q)){
			// execute only when the search keywork has value		
			$this->set('keyword', $q);
			$data = $this->HrBankAcc->HrEmployee->find('all', array('fields' => array('HrEmployee.full_name'),  'group' => array('HrEmployee.first_name', 'HrEmployee.last_name'), 'conditions' => array("OR" => array ('HrEmployee.full_name like' => '%'.$q.'%'), 'AND' => array('HrEmployee.is_deleted' => 'N'))));		
			$this->set('results', $data);
		}
    }
	
	
	
}