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
 
class TskFileController extends AppController {  
	
	public $title = 'TskFile';	
	
	public $helpers = array('Html', 'Form', 'Session');
	
	public $components = array('Session', 'Functions');
	
	public $layout = 'apps';	

	/* function to list the adv. requests */
	public function index(){	
		// set the page title
		$this->set('title_for_layout', 'My Files - Work Planner - My PDCA');
		
		// when the form is submitted for search
		if($this->request->is('post')){
			$this->redirect('/tskfile/?keyword='.$this->request->data['TskFile']['SearchText']);			
		}
		if($this->params->query['keyword'] != ''){
			$keyCond = array("MATCH (TskFile.title,TskFile.desc) AGAINST ('".$this->params->query['keyword']."' IN BOOLEAN MODE)"); 
		}
		$this->TskFile->bindModel(
			array('hasOne' => array(
					'TskFileRead' => array(
						'className' => 'TskFileRead',
						'foreignKey' => 'tsk_files_id',
						'conditions' => array('TskFileRead.app_users_id' => $this->Session->read('USER.Login.id'))
						)
					)
				)
			);
		// fetch the advances		
		$this->paginate = array('fields' => array('id','title', 'desc', 'TskFile.app_users_id', 'HrEmployee.first_name', 'HrEmployee.last_name', 'status', 'created_date', 'is_deleted','modified_date','TskFileRead.status'),'limit' => 10,
		 'order' => array('created_date' => 'desc'), 'group' => array('TskFile.id'), 'conditions' => array($keyCond, 'TskFile.is_deleted' => 'N', array('or' => array('TskFile.app_users_id' => 
		$this->Session->read('USER.Login.id'), 'or' => array(array('and' => array('TskFileUser.app_users_id' => $this->Session->read('USER.Login.id') ,
		'TskFile.status' => '1')))))));
		$data = $this->paginate('TskFile');			
		$this->set('file_data', $data);
		if(empty($data)){
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>You havn\'t created any files', 'default', array('class' => 'alert alert'));	
		}
		
		// clear session
		$this->Session->delete('rand_id'); 
	}
	
	/* function to load the employee */
	public function load_employee(){
		$this->TskFile->HrEmployee->virtualFields = array('first_name' => "UPPER(CONCAT_WS(' ', trim(HrEmployee.first_name), trim(HrEmployee.last_name)))");
		$empList = $this->TskFile->HrEmployee->find('list', array('fields' => array('id','first_name'),
		'order' => array('first_name ASC'),'conditions' => array('is_deleted' => 'N', 'status' => '1')));
		$this->set('empList', $empList);
	}
	
	/* function to check the file privilege to the user 
	public function check_file_privilege($id){	
		$count = $this->TskFile->TskFileUser->find('count', array('conditions'=> array('tsk_files_id' => $id, 'app_users_id' => $this->Session->read('USER.Login.id'))));
		if($count > 0)){
			return true;
		}else{
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));		
			$this->redirect('/tskfile/');
		}
		
	}
	*/
	
	/* function to upload the file */
	public function upload_file(){
		$this->layout = 'refresh';
		//$fp = fopen('sample.txt', 'a+');
		foreach($_FILES as $file){
			$rand = rand(1, 99999);
			// replace space to underscore
			$new_file = str_replace(' ', '_', $file['name']);
			if(copy($file['tmp_name'], WWW_ROOT.'/uploads/tsk_files/'.$rand.'_'.$new_file)){
				// check file exits				
				if(file_exists(WWW_ROOT.'/uploads/tsk_files/'.$rand.'_'.$new_file)){
					// save file details
					$this->save_file_details($rand.'_'.$new_file);
				}
			}
			//fputs($fp, $file['tmp_name'].WWW_ROOT.'/uploads/tsk_files/'.$file['name']);
		}
		//fclose($fp);		
		die;
	}
	
	/* function to download single file */
	public function file_download($id){
		$data = $this->TskFile->TskFileDetail->findById($id, array('fields'=> 'attachment'));
		$this->download_file(WWW_ROOT.'/uploads/tsk_files/'.$data['TskFileDetail']['attachment']);
		die;
	}
	
	/* function to download the file */
	public function download($id){
		$ret_value = $this->auth_action($id);
		if($ret_value == 'pass'){	
			// get task details
			$task_data = $data = $this->TskFile->findById($id,  array('fields'=> 'TskFile.title'));
			// get task file details
			$data = $this->TskFile->TskFileDetail->find('all',  array('conditions' => array('TskFileDetail.tsk_files_id' => $id, 'TskFileDetail.status' => '1'), 
			'fields'=> array('attachment')));
			// update read status
			$this->update_read_status($id);
			// if only one file
			if(count($data) == 1){
				$this->download_file(WWW_ROOT.'/uploads/tsk_files/'.$data[0]['TskFileDetail']['attachment']);
			}else if(count($data) > 1){
				if(extension_loaded('zip')){
					// create a zip file
					$zip = new ZipArchive();
					$filename = $task_data['TskFile']['title'].'.zip';	
					$file_path = WWW_ROOT.'/uploads/tsk_files/'.$filename;
					// create zip file
					if ($zip->open($file_path, ZipArchive::CREATE) == TRUE){ 
						// iterate the files
						foreach($data as $file_detail){
							$zip->addFile(WWW_ROOT.'/uploads/tsk_files/'.$file_detail['TskFileDetail']['attachment'], $file_detail['TskFileDetail']['attachment']);										
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
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Oops, No files found', 'default', array('class' => 'alert alert-info'));
				$this->redirect('/tskfile/');	
			}
			die;
		}else{
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));		
			$this->redirect('/tskfile/');	
		}
	}

	
	/* function to save file details */
	public function save_file_details($file_name){
		$data = array('rand_id' => $this->Session->read('rand_id'), 'attachment' => $file_name, 'created_date' => $this->Functions->get_current_date(), 
		'tsk_files_id' => '0');
		// save the att
		if($this->TskFile->TskFileDetail->save($data, true, $fieldList = array('attachment', 'created_date','tsk_files_id','rand_id'))){
			
		}
	}
	
	
	/* function to save the customer */
	public function create_file(){ 
		// set the page title		
		$this->set('title_for_layout', 'Create File - Work Planner - My PDCA');	
		// load send to users
		$this->load_employee();
		// load team members
		//$this->load_team();
		if($this->Session->read('rand_id') == ''){
			$this->Session->write('rand_id', rand(0, 100000));
		}		
		if ($this->request->is('post')){ 
			// validates the form
			$this->TskFile->set($this->request->data);
			if ($this->TskFile->validates(array('fieldList' => array('title', 'desc','users')))) {
				$this->request->data['TskFile']['app_users_id'] = $this->Session->read('USER.Login.id');				
				$this->request->data['TskFile']['created_date'] = $this->Functions->get_current_date();						
				// save the data
				if($this->TskFile->save($this->request->data['TskFile'])) {		
					$this->update_task_id($this->TskFile->id);
					// update task users
					$this->save_task_users($this->TskFile->id);
					// save task reads
					$this->save_task_reads($this->TskFile->id);
					// show the msg.
					$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>File created successfully', 'default', array('class' => 'alert alert-success'));
					$this->redirect('/tskfile/');
				}else{
					$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in saving the data...', 'default', array('class' => 'alert alert-error'));
				}
			}else{
				//print_r($this->TskFile->validationErrors);
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in submitting the form. please check errors...', 'default', array('class' => 'alert alert-error'));	
			}
		}
	}
	
	/* function to save task users */
	public function save_task_users($tsk_id){		
		foreach($this->data['TskFile']['users'] as $id){
			$data = array('app_users_id' => $id, 'tsk_files_id' => $tsk_id);
			// save the task users
			$this->TskFile->TskFileUser->create();
			if($this->TskFile->TskFileUser->save($data, true, $fieldList = array('app_users_id', 'tsk_files_id'))){
				
			}
		}
	}
	
	/* function to save the file reads */
	public function save_task_reads($file_id){
		foreach($this->data['TskFile']['users'] as $id){
			$data = array('app_users_id' => $id, 'tsk_files_id' => $file_id, 'created_date' => $this->Functions->get_current_date());
			// save the task users
			$this->loadModel('TskFileRead');
			$this->TskFileRead->create();
			if($this->TskFileRead->save($data, true, $fieldList = array('app_users_id', 'tsk_files_id','created_date'))){
				
			}
		}
	}
	
	/* public function to update task id */
	public function update_task_id($id){
		$data = $this->TskFile->TskFileDetail->find('all',  array('conditions' => array('TskFileDetail.rand_id' => $this->Session->read('rand_id')), 
		'fields'=> array('id')));
		foreach($data as $file_detail){
			$this->TskFile->TskFileDetail->id = $file_detail['TskFileDetail']['id'];
			$this->TskFile->TskFileDetail->saveField('tsk_files_id', $id);
		}
	}
		
	/* function to load team members */
	public function load_team(){
		$emp_list = $this->TskFile->get_team($this->Session->read('USER.Login.id'),'T');
		$format_list = $this->Functions->format_dropdown($emp_list, 'u','id','first_name', 'last_name');
		$this->set('teamList', $format_list);
	}
	
	/* function to delete the adv. request */
	public function delete_file($id){
		if(!empty($id) && intval($id)){
			// authorize user before action
			$ret_value = $this->auth_action($id);
			if($ret_value == 'pass'){				
				$this->TskFile->id = $id;
				$this->TskFile->saveField('is_deleted', 'Y'); 
				$this->TskFile->saveField('modified_date', $this->Functions->get_current_date()); 
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>File deleted successfully', 'default', array('class' => 'alert alert-success'));	
				
			}else if($ret_value == 'fail'){
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/tskfile/');
			}else{
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Record Deleted: '.$ret_value , 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/tskfile/');
			}
		}else{
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));			
		}
		$this->redirect('/tskfile/');
	}
	
	
	/* function to edit the grade */
	public function edit_file($id){	
		// set the page title		
		$this->set('title_for_layout', 'Edit File - Work Planner - My PDCA');		
		if($this->Session->read('rand_id') == ''){
			$this->Session->write('rand_id', rand(0, 100000));
		}
		// load send to users
		$this->load_employee();
		if (!empty($id) && intval($id)){
			// authorize user before action
			$ret_value = $this->auth_action($id);
			if($ret_value == 'pass'){	
				// when the form submitted
				if (!empty($this->request->data)){ 
					// validates the form
					$this->TskFile->set($this->request->data);
					if ($this->TskFile->validates(array('fieldList' => array('title', 'desc','users','status')))) {
						$this->request->data['TskFile']['modified_date'] = $this->Functions->get_current_date();					
						// save the data
						if($this->TskFile->save($this->request->data['TskFile'])) {	
							$this->update_task_id($id);
							// remove task users
							$this->remove_task_users($id);
							// update task users
							$this->save_task_users($id);
							// remove file users
							$this->remove_read_users($id);
							// save file users
							$this->save_task_reads($id);
							// show the msg.
							$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>File modified successfully', 'default', array('class' => 'alert alert-success'));
						}else{
							// show the error msg.
							$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in saving the data...', 'default', array('class' => 'alert alert-error'));					
						}					
					$this->redirect('/tskfile/');						
					}	
				}else{
					$this->request->data = $this->TskFile->findById($id);
					$file_data = $this->TskFile->TskFileDetail->find('all',  array('conditions' => array('TskFileDetail.tsk_files_id' => $id),'fields'=> array('id','attachment','status')));	
					$this->set('file_data', $file_data);
					// get file users
					$file_user = $this->TskFile->TskFileUser->find('all',  array('conditions' => array('TskFileUser.tsk_files_id' => $id),'fields'=> array('app_users_id'),
					'group' => array('TskFileUser.id')));	
					$this->set('file_user', $file_user);
					foreach($file_user as $user){
						$format_list[] = $user['TskFileUser']['app_users_id'];
					}
					
					$this->set('userList', $format_list);
					
				}
			}else if($ret_value == 'fail'){
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/tskfile/');
			}else{
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Record Deleted: '.$ret_value , 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/tskfile/');
			}
		}else{
			// show the error msg.
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));
			$this->redirect('/tskfile/');		
		}		
		
	}
	
	/* function to remove the task uses */
	public function remove_task_users($id){
		$this->TskFile->TskFileUser->deleteAll(array('tsk_files_id' => $id), false);
	}
	
	/* function to remove the file reads */
	public function remove_read_users($id){
		$this->loadModel('TskFileRead');
		$this->TskFileRead->deleteAll(array('tsk_files_id' => $id), false);
	}
	
	/* function to auth record */
	public function auth_action($id){
		$data = $this->TskFile->findById($id, array('fields' => 'status','app_users_id','id','is_deleted','modified_date'));	
		$file_user = $this->TskFile->TskFileUser->find('all', array('conditions' => array('tsk_files_id' => $id), 'fields' => array('TskFileUser.app_users_id')));
		foreach($file_user as $user){
			$user_list[] = $user['TskFileUser']['app_users_id'];
		}
		// check the req belongs to the user
		if($data['TskFile']['is_deleted'] == 'Y'){
			return $data['TskFile']['modified_date'];
		}else if($data['TskFile']['app_users_id'] == $this->Session->read('USER.Login.id')){	
			return 'pass';
		}else if(in_array($this->Session->read('USER.Login.id'), $user_list) && $data['TskFile']['status'] == 1){	
			return 'pass';
		}else{
			return 'fail';
		}
	}
	
	/* function to show the assigned users */
	public function assign_user($id){
		$this->layout = 'iframe';
		$this->loadModel('TskFileUser');
		$file_user = $this->TskFileUser->find('all',  array('conditions' => array('TskFileUser.tsk_files_id' => $id),'fields'=> array('HrEmployee.first_name',
		'HrEmployee.last_name', 'HrEmployee.id'), 'order' => array('HrEmployee.first_name' => 'asc')));	
		$this->set('file_user', $file_user);
		if(empty($file_user)){
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>File(s) not assigned to any user', 'default', array('class' => 'alert alert'));	
		}
		// get task file
		$tsk_data = $this->TskFile->findById($id,  array('fields' => 'TskFile.id','TskFile.title'));	
		$this->set('tsk_data', $tsk_data);
		
	}
	
	/*function to change the file status */
	public function file_status($st, $id, $file_id, $user_id){
		if(!empty($id)){
			// check user file
			if($this->check_user_file($id, $user_id)){
				$new_st = $st == 1 ? 0 : 1;
				// change status of the file
				$this->TskFile->TskFileDetail->id = $file_id;
				$this->TskFile->TskFileDetail->saveField('status', $new_st);
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>File status changed successfully', 'default', array('class' => 'alert alert-success'));	
				$this->redirect('/tskfile/edit_file/'.$id);	
			}else{
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Invalid Entry.', 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/tskfile/');	
			}
			
		}
	}
	
	
	/* function to remove the file */
	public function remove_file($id, $file_id, $user_id){
		if(!empty($id)){
			// check user file
			if($this->check_user_file($id, $user_id)){				
				// remove the file 
				//$this->TskFile->TskFileDetail->id = $file_id;
				$this->TskFile->TskFileDetail->delete($file_id);
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>File removed successfully', 'default', array('class' => 'alert alert-success'));	
				$this->redirect('/tskfile/edit_file/'.$id);	
			}else{
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Invalid Entry.', 'default', array('class' => 'alert alert-error'));	
				//$this->redirect('/tskfile/');	
			}
			
		}
	}
	
	/* function to check the file belongs to the user */
	public function check_user_file($id, $user_id){
		$count = $this->TskFile->TskFileUser->find('count', array('conditions'=> array('tsk_files_id' => $id, 'app_users_id' => $this->Session->read('USER.Login.id'))));
		if($count > 0 || ($user_id == $this->Session->read('USER.Login.id'))){
			return true;
		}else{
			return false;
		}
		
	}
	
	
	/* function to delete user */
	public function delete_user($tsk_id, $user_id){
		if($this->TskFile->TskFileUser->deleteAll(array('tsk_files_id' => $tsk_id, 'app_users_id' => $user_id), false)){			
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>User removed successfully', 'default', array('class' => 'alert alert-success'));			
		}else{
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in removing the user. please contact administrator.', 'default', array('class' => 'alert alert-error'));	
		}	
		$this->redirect('/tskfile/assign_user/'.$tsk_id);	
	}
	
	/* function to view the adv. request */
	public function view_file($id){
		// set the page title		
		$this->set('title_for_layout', 'View File - Work Planner - My PDCA');
		if(!empty($id) && intval($id)){
			// authorize user before action
			$ret_value = $this->auth_action($id);
			if($ret_value == 'pass'){	
				$data = $this->TskFile->findById($id, array('fields' => 'TskFile.title','TskFile.desc','TskFile.status','TskFile.app_users_id'));				
				$this->set('tsk_file', $data);
				$file_data = $this->TskFile->TskFileDetail->find('all',  array('conditions' => array('TskFileDetail.tsk_files_id' => $id, 'TskFileDetail.status' => '1'),'fields'=> array('id','attachment','status')));	
				$this->set('file_data', $file_data);
				// get file users
				$file_user = $this->TskFile->TskFileUser->find('all',  array('conditions' => array('TskFileUser.tsk_files_id' => $id),'fields'=> array('HrEmployee.first_name','HrEmployee.last_name'),
				'order' => array('HrEmployee.first_name' => 'asc')));	
				$this->set('file_user', $file_user);
				// update read status
				$this->update_read_status($id);

			}else if($ret_value == 'fail'){ 
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/tskfile/');	
			}else{
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Record Deleted: '.$ret_value , 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/tskfile/');	
			}
		}else{
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));		
			$this->redirect('/tskfile/');	
		}
		
		
	}
	
	/* function to updated the file read status */
	public function update_read_status($file_id){
		$this->loadModel('TskFileRead');
		$data = $this->TskFileRead->find('all', array('fields' => array('status', 'id'), 'conditions' => array('app_users_id' => $this->Session->read('USER.Login.id'), 'tsk_files_id' => $file_id)));
		// if unread, update read status
		if($data[0]['TskFileRead']['status'] == 'U'){
			$this->TskFileRead->id = $data[0]['TskFileRead']['id'];
			$this->TskFileRead->saveField('status', 'R');
		}
	}
	
	/* clear the cache */
	
	public function beforeFilter() { 
		//$this->disable_cache();
		$this->show_tabs(60);
	}
	
	
		/* auto complete search */	
	public function search(){ 
		$this->layout = false;	 
		$q = trim(Sanitize::escape($_GET['q']));	
		if(!empty($q)){
			// execute only when the search keywork has value		
			$this->set('keyword', $q);
			$data = $this->TskFile->find('all', array('fields' => array('TskFile.title'), 'group' => array('TskFile.title'), 'conditions' =>  array("OR" => array ('TskFile.title like' => '%'.$q.'%'),
			'AND' => array('TskFile.is_deleted' => 'N'))));		
			$this->set('results', $data);
		}
    }
	
	
	
}