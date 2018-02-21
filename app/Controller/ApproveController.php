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
class ApproveController extends AppController {  
	
	public $name = 'Approve';	
	
	public $helpers = array('Html', 'Form', 'Session');
	
	public $components = array('Session', 'Functions', 'Excel');
	
	public $layout = 'apps';

	public $user_type, $fn_type, $module_name, $red_url;
	
	

	/* function to list the adv. requests */
	public function index(){	
		// set the page title
		$this->set('title_for_layout', $this->user_type.' - Finance - My PDCA');
		$app_type = ($this->fn_type == 'advance' ? 'A' : ($this->fn_type == 'leave' ? 'L' : ($this->fn_type == 'expense' ? 'E' : 'T')));

		// when the form is submitted for search
		if($this->request->is('post')){
			$this->redirect('/approve/?type='.$this->fn_type.'&keyword='.$this->request->data['Approve']['SearchText']);			
		}
		if($this->params->query['keyword'] != ''){
			$keyCond = array("MATCH (Home.first_name,Home.last_name) AGAINST ('".$this->params->query['keyword']."' IN BOOLEAN MODE)"); 
		}
		
		$options = array(
				array('table' => 'app_users',
					'alias' => 'Home',					
					'type' => 'LEFT',
					'conditions' => array('`Approve`.`app_users_id` = `Home`.`id`', 'Home.status' => '1')
				),
				array('table' => 'app_users',
					'alias' => 'tbl_level1',					
					'type' => 'LEFT',
					'conditions' => array('`Approve`.`level1` = `tbl_level1`.`id`')
				),
				array('table' => 'app_users',
					'alias' => 'tbl_level2',					
					'type' => 'LEFT',
					'conditions' => array('`Approve`.`level2` = `tbl_level2`.`id`')
				)
			);
		
		// check order by condition
		if($this->request->query['action'] == 'export'){
			$orderBy = array('first' => 'asc');
		}else{
			$orderBy = array('created_date' => 'desc');
		}
			
		$this->Approve->virtualFields = array('first' => 'first', 'l1_first' => 'l1_first', 'l2_first' => 'l2_first');
		$this->paginate = array('fields' => array('Approve.id','Home.first_name as first','Home.last_name as last','Home.email_address',
		'created_date','auth_amount_l1', 'Approve.modified_date', 'auth_amount_l2','tbl_level1.first_name as l1_first', 'tbl_level1.last_name as l1_last','tbl_level1.email_address as l1_email',
		'tbl_level2.first_name as l2_first', 'tbl_level2.last_name as l2_last', 'tbl_level2.email_address as l2_email',),
		'limit' => 50,'conditions' => array($keyCond, 'type' => $app_type, 'Home.is_deleted' => 'N'), 'order' => $orderBy, 'joins' => $options);
		$data = $this->paginate('Approve');
		
		// for export
		if($this->request->query['action'] == 'export'){
			$this->Excel->generate('approver', $data, $data, 'Report', $this->user_type);
		}

		//$this->render('sql');
		
		$this->set('approver_data', $data);
		if(empty($data)){
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>You havn\'t created any '.$this->fn_type.' approver', 'default', array('class' => 'alert alert'));	
		}
	}
	
	/* function to get module title */
	public function get_module_title(){
		if($this->fn_type == 'advance'){
			return 'Finance';
		}else if($this->fn_type == 'leave'){
			return 'HRIS';
		}else if($this->fn_type == 'expense'){
			return 'Finance';
		}else if($this->fn_type == 'task'){
			return 'Task Manager';
		}
	}

	
	/* function to create the advance approver*/
	public function create_approver(){ 
		// set the page title		
		$this->set('title_for_layout', $this->user_type.'  - '.$this->get_module_title().' - My PDCA');	
		// fetch the employee list for superiors
		$this->loadModel('Home');
		$users_list = $this->Home->find('list', array('fields' => array('id','full_name'), 'order' => array('first_name ASC'),'conditions' => array('Home.status' => 1)));
		$this->set('empList', $users_list);
		
		// for employee list 
		$this->Approve->bindModel(array('belongsTo' => array('Home' => array('foreignKey' => 'app_users_id', 'type' => 'right' , 'conditions' => array('Home.id = Approve.app_users_id','Approve.type' => $this->set_approver_type())))));
		$users_list = $this->Approve->find('all', array('fields' => array('Home.id','Home.first_name','Home.last_name'), 'order' => array('Home.first_name ASC'),'conditions' => array('Home.status' => 1, 'Approve.id' =>  NULL)));		
		$users_format_list = $this->Functions->format_dropdown($users_list, 'Home', 'id', 'first_name', 'last_name');		
		$this->set('empList1', $users_format_list);
		
		if ($this->request->is('post')){ 
			// validates the form
			$this->Approve->set($this->request->data);
			if ($this->Approve->validates(array('fieldList' => array('app_users_id', 'level1','level2','auth_amount_l1','auth_amount_l2')))) {				
				// format the dates to save
				$this->request->data['Approve']['type'] = $this->set_approver_type();					
				$this->request->data['Approve']['created_date'] = $this->Functions->get_current_date();
				// save the data
				if($this->Approve->save($this->request->data['Approve'])) {
					// show the msg.
					$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>'.' '.ucfirst($this->fn_type).'  approver created successfully', 'default', array('class' => 'alert alert-success'));
					}else{
						$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in saving advance approver', 'default', array('class' => 'alert alert-info'));
					}					
					$this->redirect('/approve/?type='.$this->fn_type);	
					
				}else{
					// show the error msg.
					$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Please check the validation errors...', 'default', array('class' => 'alert alert-error'));					
				}
			}			
	}
	
	/* function to delete the adv. request */
	public function delete_approver($id){
		if(!empty($id) && intval($id)){
			// authorize user before action
			$this->Approve->id = $id;
			if($this->Approve->delete(array('id' => $id), false)){ 
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>'.ucfirst($this->fn_type).' Approver deleted successfully', 'default', array('class' => 'alert alert-success'));	
			}else{
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Problem in deleting...', 'default', array('class' => 'alert alert-error'));	
			}			
		}else{
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));			
		}
		$this->redirect('/approve/?type='.$this->fn_type);
	}
	
	
	
	/* function to edit the advance approver*/
	public function edit_approver($id){
		if(!empty($id) && intval($id)){		
			// set the page title		
			$this->set('title_for_layout', $this->user_type.'  - Finance - My PDCA');	
			// fetch the employee list for superiors
			$this->loadModel('Home');
			$users_list = $this->Home->find('list', array('fields' => array('id','full_name'), 'order' => array('first_name ASC'),'conditions' => array('Home.status' => 1)));
			$this->set('empList', $users_list);
			// for employee list 
			$this->Approve->bindModel(array('belongsTo' => array('Home' => array('foreignKey' => 'app_users_id', 'type' => 'right' ))));
			// when the form posted
			if (!empty($this->request->data)){ 
				// validates the form
				$this->Approve->set($this->request->data);
				if ($this->Approve->validates(array('fieldList' => array('app_users_id', 'level1','level2','auth_amount_l1','auth_amount_l2')))) {				
					// format the dates to save
					$this->request->data['Approve']['type'] = $this->set_approver_type();				
					$this->request->data['Approve']['modified_date'] = $this->Functions->get_current_date();
					// save the data
					if($this->Approve->save($this->request->data['Approve'])) {
						// show the msg.
						$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>'.ucfirst($this->fn_type).' approver modified successfully', 'default', array('class' => 'alert alert-success'));
						}else{
							$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in modifying'.ucfirst($this->fn_type). ' approver', 'default', array('class' => 'alert alert-info'));
						}					
						$this->redirect('/approve/?type='.$this->fn_type);	
							
					}else{
						// show the error msg.
						$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Please check the validation errors...', 'default', array('class' => 'alert alert-error'));					
					}
				}else{
					$this->request->data = $this->Approve->findById($id);				
				}				
			}else{
			// show the error msg.
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));	
			$this->redirect('/approve/?type='.$this->fn_type);		
		}
	}
	
	/* find the approver type */
	public function set_approver_type(){
		if($this->fn_type == 'advance'){
			return 'A';
		}else if($this->fn_type == 'leave'){
			return 'L';
		}else if($this->fn_type == 'expense'){
			return 'E';
		}else if($this->fn_type == 'task'){
			return 'T';
		}
	}
	
	
	/* function to auth record */
	public function auth_action($id){
		$data = $this->Approve->findById($id, array('fields' => 'app_users_id'));	
		// check the req belongs to the user
		if($data['Approve']['app_users_id'] == $this->Session->read('USER.Login.id')){	
			return 'pass';
		}else{
			return 'fail';
		}
	}
	
	
	
	/* clear the cache */
	
	public function beforeFilter() { //echo $this->action;
		
		// get approval type		
		$this->user_type = $this->get_approver_type();
		$this->fn_type = ($this->user_type == 'Advance Approver' ? 'advance' : ($this->user_type == 'Expense Approver' ? 'expense' : 
		($this->user_type == 'Leave Approver' ? 'leave' : 'task')));
		// get mod. id
		$mod_id = ($this->user_type == 'Advance Approver' ? '5' : ($this->user_type == 'Expense Approver' ? '20' : 
		($this->user_type == 'Leave Approver' ? '31' : '55')));
		// enable menus
		$this->show_tabs($mod_id);
		
		$this->set('APPROVER_TYPE', $this->user_type);
		$this->set('FN_TYPE', $this->fn_type);
		// set breadcrumb url
		$this->red_url = ($this->fn_type == 'leave' ? 'hrhome' : ($this->fn_type == 'expense' ? 'finhome' : ($this->fn_type == 'advance' ?  'finhome' : 'tskhome')));
		$this->set('redirect', $this->red_url);
		// set menu
		$menu = ($this->fn_type == 'leave' ? 'hr_menu' : ($this->fn_type == 'expense' ? 'fin_menu' : ($this->fn_type == 'advance' ? 'fin_menu' : 'tsk_menu')));
		$this->set('menu_inc', $menu);
		return $user_type;
	}
	
	
		/* function to get approval type */
	public function get_approver_type(){
		return ($this->request->query['type'] == 'advance' ? 'Advance Approver' : ($this->request->query['type'] == 'leave' ? 'Leave Approver' : 
		($this->request->query['type'] == 'expense' ? 'Expense Approver': 'Task Approver')));
			
	}
	
			/* auto complete search */	
	public function search(){ 
		$this->layout = false;	 
		$q = trim(Sanitize::escape($_GET['q']));	
		if(!empty($q)){
			// execute only when the search keywork has value		
			$this->set('keyword', $q);
			$this->loadModel('HrEmployee');
			$data = $this->HrEmployee->find('all', array('fields' => array('first_name'),  'group' => array('first_name'), 
			'conditions' => array("OR" => array ('first_name like' => '%'.$q.'%'), 'AND' => array('HrEmployee.is_deleted' => 'N'))));		
			$this->set('results', $data);
		}
    }
	
	
	
	
}