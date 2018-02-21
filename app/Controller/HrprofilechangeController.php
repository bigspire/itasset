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
 
class HrprofilechangeController extends AppController {  
	
	public $name = 'HrProfileChange';	
	
	public $helpers = array('Html', 'Form', 'Session');
	
	public $components = array('Session', 'Functions');
	
	public $layout = 'apps';	

	/* function to list the adv. requests */
	public function index(){	
		// set the page title
		$this->set('title_for_layout', 'Approve Profile Change - HRIS - My PDCA');
		// when the form is submitted for search
		if($this->request->is('post')){
			$url_vars = $this->Functions->create_url(array('keyword'),'HrProfileChange'); 
			$this->redirect('/hrprofilechange/?'.$url_vars);					
		}
		if($this->params->query['keyword'] != ''){
			$keyCond = array("MATCH (User.first_name) AGAINST ('".$this->params->query['keyword']."' IN BOOLEAN MODE)"); 
		}				
		
		$this->paginate = array('fields' => array('type','desc','status','id', 'User.id','User.first_name', 'User.last_name', 'created_date'),'limit' => 10,  'conditions' => array($keyCond), 'order' => array('HrProfileChange.created_date' => 'desc'));
		$data = $this->paginate('HrProfileChange');			
		$this->set('chg_data', $data);
		if(empty($data)){
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>You havn\'t created any bank accounts', 'default', array('class' => 'alert alert'));	
		}
		
	}
	

		
	
	/* function to edit the form */
	public function update_request($id,$chgid){
		$this->layout = 'iframe';
		// set the page title		
		$this->set('title_for_layout', 'Approve Profile Change - HRIS - My PDCA');		
		// get employee
		$emp_data = $this->HrProfileChange->User->findById($id, array('fields ' => 'full_name'));
		$this->set('emp_data', $emp_data);
		// get profile change req. details
		$chg_data = $this->HrProfileChange->findById($chgid, array('fields ' => 'desc','status','remark'));
		$this->set('chg_data', $chg_data);	
		
		// when the form submitted
		if (!empty($this->request->data)){ 
			// validates the form
			$this->HrProfileChange->set($this->request->data);				
			if ($this->HrProfileChange->validates(array('fieldList' => array('status')))) {
					$this->HrProfileChange->id = $chgid;
					$this->request->data['HrProfileChange']['modified_by'] = $this->Session->read('USER.Login.id');	
					$this->request->data['HrProfileChange']['modified_date'] = $this->Functions->get_current_date();
					$this->request->data['HrProfileChange']['status'] = 'C';					
					// save the data
					if($this->HrProfileChange->save($this->request->data['HrProfileChange'])) {	
						// notify user in mail
						$sub = 'My PDCA - '.ucfirst($this->Session->read('USER.Login.first_name')).' '.	ucfirst($this->Session->read('USER.Login.last_name')).' updated your profile!';
						$this->send_mail_emp($sub,'profile_updation',$id,$this->request->data['HrProfileChange']['remark']);
						// show the msg.
						$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Request details updated successfully', 'default', array('class' => 'alert alert-success'));	
						$this->redirect('/hrprofilechange/update_request/'.$id.'/'.$chgid);	
					}			
				}	
			}else{
				$this->request->data = $this->HrProfileChange->findById($chgid);									
			}
	}
	
	
	/* function to edit the form */
	public function view_request($id,$chgid){
		$this->layout = 'iframe';
		// set the page title		
		$this->set('title_for_layout', 'Approve Profile Change - HRIS - My PDCA');		
		// get employee
		$emp_data = $this->HrProfileChange->User->findById($id, array('fields ' => 'full_name'));
		$this->set('emp_data', $emp_data);
		// get profile change req. details
		$chg_data = $this->HrProfileChange->findById($chgid, array('fields ' => 'desc','status','remark'));
		$this->set('chg_data', $chg_data);
	}
	
	
	public function send_mail_emp($sub,$template,$id,$remark){
		// intimate hr 					
		$emp_data = $this->Home->find('all', array('fields' => array('email_address', 'first_name', 'last_name'), 'conditions'=> array('Home.id' => $id, 'Home.status' => '1'), 'group' => array('Home.id')));		
		$vars = array('from_name' => ucfirst($this->Session->read('USER.Login.first_name')).' '.ucfirst($this->Session->read('USER.Login.last_name')), 'remarks' => $remark, 'name' => $emp_data[0]['Home']['first_name'].' '.$emp_data[0]['Home']['last_name']);
		// notify hr in email						
		if(!$this->send_email($sub, $template, 'noreply@mypdca.in', $emp_data[0]['Home']['email_address'],$vars)){	
			// show the msg.								
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in sending the mail...', 'default', array('class' => 'alert alert-error'));				
		}else{								
		}
		
	}
	
	
	/* clear the cache */
	
	public function beforeFilter() { 
		//$this->disable_cache();
		$this->show_tabs(46);
	}
	
	
		/* auto complete search */	
	public function search(){ 
		$this->layout = false;	 
		$q = trim(Sanitize::escape($_GET['q']));	
		if(!empty($q)){
			// execute only when the search keywork has value		
			$this->set('keyword', $q);
			$data = $this->HrProfileChange->find('all', array('fields' => array('User.first_name'),  'group' => array('User.first_name'), 'conditions' => array("OR" => array ('User.first_name like' => '%'.$q.'%'))));		
			$this->set('results', $data);
		}
    }
	
	
	
}