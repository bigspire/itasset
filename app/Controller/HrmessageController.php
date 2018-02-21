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
 
class HrmessageController extends AppController {  
	
	public $name = 'HrMessage';	
	
	public $helpers = array('Html', 'Form', 'Session');
	
	public $components = array('Session', 'Functions');
	
	public $layout = 'apps';	

	/* function to list the adv. requests */
	public function index(){	
		// set the page title
		$this->set('title_for_layout', 'Message - HRIS - My PDCA');
		// when the form is submitted for search
		if($this->request->is('post')){
			$url_vars = $this->Functions->create_url(array('keyword'),'HrMessage'); 
			$this->redirect('/hrmessage/?'.$url_vars);					
		}
		if($this->params->query['keyword'] != ''){
			$keyCond = array("MATCH (title,HrMessage.desc) AGAINST ('".$this->params->query['keyword']."' IN BOOLEAN MODE)"); 
		}
		// fetch the advances		
		$this->paginate = array('fields' => array('id','title', 'desc', 'show_type','display_type','start_date','end_date','start_day','end_day', 'attachment', 'status','created_date'),'limit' => 10,'conditions' => array($keyCond, 'HrMessage.is_deleted' => 'N'), 'order' => array('created_date' => 'desc'));
		$data = $this->paginate('HrMessage');			
		$this->set('latest_data', $data);
		if(empty($data)){
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>You havn\'t created any updates', 'default', array('class' => 'alert alert'));	
		}
		
		
	}
	
	/* function to save the customer */
	public function create_message(){ 
		// set the page title		
		$this->set('title_for_layout', 'Create Message - HRIS - My PDCA');	
		$this->set('msg_type', array('M' => 'Every Month', 'N' =>  'Particular Date Only'));
		$this->set('show_type', array('A' => 'All Users', 'L' =>  'Approver\'s Only'));
		if ($this->request->is('post')){ 
			// validates the form
			$this->HrMessage->set($this->request->data);
			$this->HrMessage->validate_file();
			// empty the fields
			$this->empty_date_fields();
			// validate file		
			if ($this->HrMessage->validates(array('fieldList' => array('title','status','desc','upload_file','display_type', 'show_type', 'end_date', 'end_day')))) {
				$this->request->data['HrMessage']['created_by'] = $this->Session->read('USER.Login.id');				
				$this->request->data['HrMessage']['created_date'] = $this->Functions->get_current_date();				
				// save the data
				if($this->HrMessage->save($this->request->data['HrMessage'], array('validate' => false))) {
					// upload the file
					if($file = $this->upload_attachment($this->request->data['HrMessage']['upload_file'], $this->HrMessage->id)){						
						$this->HrMessage->saveField('attachment', $file);
					}					
					// show the msg.
					$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Message created successfully', 'default', array('class' => 'alert alert-success'));
					$this->redirect('/hrmessage/');
				}else{
					$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in saving the data...', 'default', array('class' => 'alert alert-error'));
				}
			}else{
				//$errors = $this->HrMessage->validationErrors;
				//print_r($errors);
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in submitting the form. please check errors...', 'default', array('class' => 'alert alert-error'));	
			}
		}
	}
	
	/* function to empty the date fields */
	public function empty_date_fields(){
		if($this->request->data['HrMessage']['display_type'] == 'N'){
			$this->request->data['HrMessage']['start_day'] = '';
			$this->request->data['HrMessage']['end_day'] = '';	
			$this->request->data['HrMessage']['start_date']	= $this->Functions->format_date_save($this->request->data['HrMessage']['start_date']);		
			$this->request->data['HrMessage']['end_date']	= $this->Functions->format_date_save($this->request->data['HrMessage']['end_date']);
		}else if($this->request->data['HrMessage']['display_type'] == 'M'){
			$this->request->data['HrMessage']['start_date'] = '';
			$this->request->data['HrMessage']['end_date'] = '';			
		}
	}
	
	/* function to upload the file */
	public function upload_attachment($data, $id){
		// validate the file				
		if(!empty($data['tmp_name'])){
			$file = $id.'_'.$data['name']; 
			if($this->upload_file($data['tmp_name'], WWW_ROOT.'/uploads/message/'.$file)){
				return $file;
			}			
		}
				
	}
	
		
	
	/* function to delete the adv. request */
	public function delete_message($gr_id){
		if(!empty($gr_id) && intval($gr_id)){
			// authorize user before action
			$ret_value = $this->auth_action($gr_id);
			if($ret_value == 'pass'){		
				$this->HrMessage->id = $gr_id;
				$this->HrMessage->saveField('is_deleted', 'Y'); 
				$this->HrMessage->saveField('modified_date', $this->Functions->get_current_date()); 
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Message deleted successfully', 'default', array('class' => 'alert alert-success'));			
			}else if($ret_value == 'fail'){
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/hrmessage/');
			}else{
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Record Deleted: '.$ret_value , 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/hrmessage/');
			}
		}else{
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));			
		}
		$this->redirect('/hrmessage/');
	}
	
	
	/* function to edit the form */
	public function edit_message($id){	
		// set the page title		
		$this->set('title_for_layout', 'Edit Message - HRIS - My PDCA');
		$this->set('msg_type', array('M' => 'Every Month', 'N' =>  'Particular Date Only'));
		$this->set('show_type', array('A' => 'All Users', 'L' =>  'Approver\'s Only'));		
		if (!empty($id) && intval($id)){
			// authorize user before action
			$ret_value = $this->auth_action($id);
			if($ret_value == 'pass'){	
				// when the form submitted
				if (!empty($this->request->data)){ 
					// validates the form
					$this->HrMessage->set($this->request->data);
					// validate the file
					$this->HrMessage->validate_file();
					// empty the fields
					$this->empty_date_fields();
					if ($this->HrMessage->validates(array('fieldList' => array('title','status','desc','upload_file','display_type', 'show_type', 'end_date', 'end_day')))) {
						$this->request->data['HrMessage']['modified_by'] = $this->Session->read('USER.Login.id');		
						$this->request->data['HrMessage']['modified_date'] = $this->Functions->get_current_date();		
						// save the data
						if($this->HrMessage->save($this->request->data['HrMessage'])) {	
							// upload the file
							if($file = $this->upload_attachment($this->request->data['HrMessage']['upload_file'], $id)){						
								$this->HrMessage->saveField('attachment', $file);
							}
							// show the msg.
							$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Message details modified successfully', 'default', array('class' => 'alert alert-success'));
							$this->redirect('/hrmessage/');		
						}else{
							// show the error msg.
							$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in saving the data...', 'default', array('class' => 'alert alert-error'));									
						}					
									
					}	
				}else{
					$this->request->data = $this->HrMessage->findById($id);
					if($this->request->data['HrMessage']['display_type'] == 'N'){
						$this->request->data['HrMessage']['start_date']	= $this->Functions->format_date_show($this->request->data['HrMessage']['start_date']);		
						$this->request->data['HrMessage']['end_date']	= $this->Functions->format_date_show($this->request->data['HrMessage']['end_date']);
					}		
				}
			}else if($ret_value == 'fail'){
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/hrmessage/');
			}else{
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Record Deleted: '.$ret_value , 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/hrmessage/');
			}
		}else{
			// show the error msg.
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));
			$this->redirect('/hrmessage/');		
		}		
		
	}
	
	/* function to auth record */
	public function auth_action($id){
		$data = $this->HrMessage->findById($id, array('fields' => 'id','is_deleted','modified_date'));	
		// check the req belongs to the user
		if($data['HrMessage']['is_deleted'] == 'Y'){
			return $data['HrMessage']['modified_date'];
		}		
		else if(empty($data)){	
			return 'fail';
		}else{
			return 'pass';
		}
	}
	
	/* function to download the file */
	public function download_update($file){		
		$this->download_file(WWW_ROOT.'/uploads/message/'.$file);
		die;
		
	}
	
	/* function to view the adv. request */
	public function view_message($id){
		// set the page title		
		$this->set('title_for_layout', 'View Message - HRIS - My PDCA');
		if(!empty($id) && intval($id)){
			// authorize user before action
			$ret_value = $this->auth_action($id);
			if($ret_value == 'pass'){	
				$data = $this->HrMessage->findById($id);
				$this->set('frm_data', $data);
			}else if($ret_value == 'fail'){ 
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/hrmessage/');	
			}else{
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Record Deleted: '.$ret_value , 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/hrmessage/');	
			}
		}else{
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));		
			$this->redirect('/hrmessage/');	
		}
		
		
	}
	
	/* clear the cache */
	
	public function beforeFilter() { 
		//$this->disable_cache();
		$this->show_tabs(97);
	}
	
	
	
	
}