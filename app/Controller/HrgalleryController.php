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
class HrgalleryController extends AppController {  
	
	public $name = 'HrGallery';	
	
	public $helpers = array('Html', 'Form', 'Session');
	
	public $components = array('Session', 'Functions');
	
	public $layout = 'apps';	

	/* function to list the adv. requests */
	public function index(){	
		// set the page title
		$this->set('title_for_layout', 'Gallery - HRIS - My PDCA');		
		// when the form is submitted for search
		if($this->request->is('post')){
			$url_vars = $this->Functions->create_url(array('keyword'),'HrGallery'); 
			$this->redirect('/hrgallery/?'.$url_vars);			
		}
		if($this->params->query['keyword'] != ''){
			$keyCond = array("MATCH (HrGallery.title, HrGallery.desc) AGAINST ('".$this->params->query['keyword']."' IN BOOLEAN MODE)"); 
		}		
		
		$options = array(			
			array('table' => 'hr_gallery_status',
					'alias' => 'HrGalStatuses',					
					'type' => 'LEFT',
					'conditions' => array('`HrGalStatuses`.`hr_gallery_id` = `HrGallery`.`id`')
			),
			array('table' => 'app_users',
					'alias' => 'Homes',					
					'type' => 'LEFT',
					'conditions' => array('`HrGalStatuses`.`app_users_id` = `Homes`.`id`')
			)
		);
			
							
		$this->HrGallery->unBindModel(array('hasOne' => array('HrGalStatus','HrGalleryItem')));
		$this->HrGallery->unBindModel(array('belongsTo' => array('Home')));

		// fetch the advances		
		$this->paginate = array('fields' => array('id','HrGallery.title','HrGallery.desc', 'created_date','group_concat(HrGalStatuses.status) as st_status', 'group_concat(Homes.first_name) as st_user', 'group_concat(HrGalStatuses.modified_date) as st_created', 'group_concat(HrGalStatuses.remarks) as st_remarks'),'limit' => 10,'conditions' => array($keyCond, 'HrGallery.app_users_id' => $this->Session->read('USER.Login.id')), 'order' => array('created_date' => 'desc'), 'group' => array('HrGallery.id'), 'joins' => $options);
		$data = $this->paginate('HrGallery');		
		$this->set('gallery_data', $data);
		if(empty($data)){
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>You have no gallery found', 'default', array('class' => 'alert alert'));	
		}	
		
		$this->Session->write('folder', '');	
				
		
	}
	
	


	
	/* function to save the advance */
	public function create_gallery(){ 
		// set the page title		
		$this->set('title_for_layout', 'Create Gallery - HRIS - My PDCA');	
		$time = time();	
		if($this->Session->read('folder') == ''){
			$this->Session->write('folder', $time);
		}
		
		if ($this->request->is('post')){ 
			// validates the form
			$this->HrGallery->set($this->request->data);			
			if ($this->HrGallery->validates(array('fieldList' => array('title','file')))) {				
				$this->request->data['HrGallery']['app_users_id'] = $this->Session->read('USER.Login.id');					
				$this->request->data['HrGallery']['created_date'] = $this->Functions->get_current_date();
				$this->request->data['HrGallery']['folder'] = $this->Session->read('folder');			
				// save the data
				if($this->HrGallery->save($this->request->data['HrGallery'])) {
				// save gallery items
				$this->save_gallery_items($this->HrGallery->id);
				// get the superiors				
				$approval_data = $this->HrGallery->Home->find('all', array('fields' => array('Home.id','email_address', 'first_name', 'last_name'), 'conditions'=> array('Home.hr_department_id' => '14', 'Home.status' => '1'), 'group' => array('Home.id')));	
				
				foreach($approval_data as $hr_data){
						// save finance req. status data
					$this->loadModel('HrGalStatus');
					$data = array('hr_gallery_id' => $this->HrGallery->id, 'created_date' => $this->Functions->get_current_date(), 'app_users_id' => $hr_data['Home']['id']);
					if(!empty($hr_data)){
						// make sure not duplicate status exists
						$this->check_duplicate_status($this->HrGallery->id, $hr_data['Home']['id']);
						// save in adv. status table
						if($this->HrGalStatus->save($data, true, $fieldList = array('hr_gallery_id','created_date','app_users_id'))){							
							// save adv. users
							$this->loadModel('HrGalUser');
							$galleries = array('hr_gallery_id' => $this->HrGallery->id, 'app_users_id' => $hr_data['Home']['id']);							
							$this->HrGalUser->id = '';
							$this->HrGalUser->save($galleries, true, $fieldList = array('hr_gallery_id','app_users_id'));
							
							$vars = array('from_name' => ucfirst($this->Session->read('USER.Login.first_name')).' '.ucfirst($this->Session->read('USER.Login.last_name')),'name' => $hr_data['Home']['first_name'].' '.$hr_data['Home']['last_name'], 'desc' => $this->request->data['HrGallery']['desc'], 'title' => $this->request->data['HrGallery']['title']);
								// notify superiors						
								if(!$this->send_email('My PDCA - '.ucfirst($this->Session->read('USER.Login.first_name')).' '.ucfirst($this->Session->read('USER.Login.last_name')).' submitted gallery!', 'gallery_creation', 'noreply@mypdca.in', $hr_data['Home']['email_address'],$vars)){	
								// show the msg.								
								$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in sending the mail...', 'default', array('class' => 'alert alert-error'));				
								}else{
												
								}
							}else{
								$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in saving approver status', 'default', array('class' => 'alert alert-info'));
							}	
						}else{
							$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>You have no superior to approve your request', 'default', array('class' => 'alert alert-info'));
						}
					}
						// show the msg.
						$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Gallery posted successfully', 'default', array('class' => 'alert alert-success'));
						$this->Session->write('folder', '');
						
					}	
					
					$this->redirect('/hrgallery/');	
					
				}else{
					//print_r($this->HrGallery->validationErrors);
					// show the error msg.
					$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in saving the data...', 'default', array('class' => 'alert alert-error'));					
				}
				
				
			}
		}
		
		
	/* update files to database */	
	public function save_gallery_items($id){
		// read the files in the folder
		$dir = WWW_ROOT.'file_upload/server/php/'.$this->request->data['HrGallery']['folder'];
		
		if ($handle = opendir($dir)) {
			while (false !== ($entry = readdir($handle))) {
				if ($entry != "." && $entry != "..") {
					 if (is_file($dir.'/'.$entry)){ 
						$files[] = $entry;
					 }
				}
			}
			closedir($handle);
		}
		
			
		$this->request->data['HrGalleryItem']['hr_gallery_id'] = $id;
		
		foreach($files as $file){			
			$this->request->data['HrGalleryItem']['file'] = $file;
			$this->request->data['HrGalleryItem']['title'] = '';
			$this->request->data['HrGalleryItem']['desc'] = '';	
			$this->HrGallery->HrGalleryItem->create();			
			$this->HrGallery->HrGalleryItem->save($this->request->data['HrGalleryItem'],true, $fieldList = array('file','title','hr_gallery_id','desc'));
		}
		
	}
	
	
		
	/* function to check for duplicate entry */
	public function check_duplicate_status($leave_id, $app_user_id){
		$count = $this->HrGallery->HrGalStatus->find('count',  array('conditions' => array('HrGalStatus.hr_gallery_id' => $leave_id, 'HrGalStatus.app_users_id' => $app_user_id)));
		if($count > 0){
			$this->invalid_attempt();
		}
		
	}
	
	
	
		
	/* function to auth record */
	public function auth_action($id){
		$data = $this->HrGallery->findById($id, array('fields' => 'app_users_id'));	
		// check the req belongs to the user				
		if($data['HrGallery']['app_users_id'] == $this->Session->read('USER.Login.id')){	
			return 'pass';
		}else{
			return 'fail';
		}
	}
	
	/* function to view the  permission */
	public function view_gallery($id){
		// set the page title		
		$this->set('title_for_layout', 'View Gallery - HRIS - My PDCA');
		if(!empty($id) && intval($id)){
			// authorize user before action
			$ret_value = $this->auth_action($id);
			if($ret_value == 'pass'){	
				$data = $this->HrGallery->findById($id, array('fields' => 'HrGallery.title', 'HrGallery.desc','folder'));
				// get gal. items.
				$items = $this->HrGallery->HrGalleryItem->find('all', array('conditions' => array('hr_gallery_id' => $id, 'status' => '1'), 'fields' => array('title', 'desc', 'file'), 'order' => array('HrGalleryItem.id' => 'asc')));
				$this->set('gallery_data', $data);
				$this->set('gallery_items', $items);
			}else if($ret_value == 'fail'){ 
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/hrgallery/');	
			}else{
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Record Deleted: '.$ret_value , 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/hrgallery/');	
			}
		}else{
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));		
			$this->redirect('/hrgallery/');	
		}
		
		
	}
	
	/* clear the cache */
	
	public function beforeFilter() { 
		//$this->disable_cache();
		$this->show_tabs(43);
	}
	
		
	/* auto complete search  */	
	
	public function search(){ 
		$this->layout = false;	 
		$q = trim(Sanitize::escape($_GET['q']));	
		if(!empty($q)){
			// execute only when the search keywork has value		
			$this->set('keyword', $q);
			$data = $this->HrGallery->find('all', array('fields' => array('HrGallery.title'),  'group' => array('HrGallery.title'), 'conditions' =>  array("OR" => array ('HrGallery.title like' => '%'.$q.'%'))));		
			$this->set('results', $data);
		}
    }
	
	
	
	
}