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
 
class FinEmailSendController extends AppController {  
	
	public $name = 'FinEmailSend';	
	
	public $helpers = array('Html', 'Form', 'Session');
	
	public $components = array('Session', 'Functions');
	
	public $layout = 'apps';	

	/* function to list the adv. requests */
	public function index(){	
		// set the page title
		$this->set('title_for_layout', 'Email Send - Finance - My PDCA');
		// when the form is submitted for search
		if($this->request->is('post')){
			$this->redirect('/finemailsend/?keyword='.$this->request->data['FinEmailSend']['SearchText']);			
		}
		if($this->params->query['keyword'] != ''){
			$keyCond = array("MATCH (first_name,last_name) AGAINST ('".$this->params->query['keyword']."' IN BOOLEAN MODE)"); 
		}
		
		$options = array(
				
				array('table' => 'app_approval',
					'alias' => 'Advance',					
					'type' => 'LEFT',
					'conditions' => array('`Advance`.`app_users_id` = `FinEmailSend`.`id`',
					'Advance.type' => 'A')
				),
				array('table' => 'app_approval',
					'alias' => 'Expense',					
					'type' => 'LEFT',
					'conditions' => array('`Expense`.`app_users_id` = `FinEmailSend`.`id`',
					'Expense.type' => 'E')
				)
				,
				array('table' => 'app_approval',
					'alias' => 'Leave',					
					'type' => 'LEFT',
					'conditions' => array('`Leave`.`app_users_id` = `FinEmailSend`.`id`',
					'Leave.type' => 'L')
				)
			);
			
		// fetch the advances		
		$this->paginate = array('fields' => array('Advance.id', 'Leave.id', 'Expense.id','id','first_name', 'last_name','create_notify','email_address','HrDepartment.dept_name', 'HrDesignation.desig_name','status'),'limit' => 50,'conditions' => array($keyCond, 'FinEmailSend.is_deleted' => 'N'), 'order' => array('created_date' => 'desc'), 'joins' => $options);
		$data = $this->paginate('FinEmailSend');			
		$this->set('emp_data', $data);
		if(empty($data)){
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>You havn\'t created any category', 'default', array('class' => 'alert alert'));	
		}
		
		
	}
	
	/* function to save the customer */
	public function send_mail($data){		
		$new_data = explode('--', $data);
		$this->request->data['FinEmailSend']['create_notify'] = $this->Functions->get_current_date();
		$this->request->data['FinEmailSend']['id'] = $new_data[2];		
		$vars = array('name' => $new_data[1], 'email' => $new_data[0]);
		// send the mail
		if(!$this->send_email('My PDCA - Account Created!', 'account_creation', 'noreply@mypdca.in', $new_data[0],$vars)){		
			// show the msg.
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in sending the mail...', 'default', array('class' => 'alert alert-error'));				
		}else{
			if($this->FinEmailSend->save($this->request->data)) {	
					$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Email sent   successfully', 'default', array('class' => 'alert alert-success'));
			}else{
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in saving the data...', 'default', array('class' => 'alert alert-error'));	
			}		
		}		
		$this->redirect('/finemailsend/');
	}
	
		
	/* clear the cache */	
	public function beforeFilter() { 
		//$this->disable_cache();
		$this->show_tabs(24);
	}
	
	
		/* auto complete search */	
	public function search(){ 
		$this->layout = false;	 
		$q = trim(Sanitize::escape($_GET['q']));	
		if(!empty($q)){
			// execute only when the search keywork has value		
			$this->set('keyword', $q);
			$data = $this->FinEmailSend->find('all', array('fields' => array('full_name'),  'group' => array('full_name'), 'conditions' => array("OR" => array ('full_name like' => '%'.$q.'%'), 'AND' => array('FinEmailSend.is_deleted' => 'N'))));		
			$this->set('results', $data);
		}
    }
	
	
	
}