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
class HrgalapproveController extends AppController {  
	
	public $name = 'HrGalApprove';	
	
	public $helpers = array('Html', 'Form', 'Session');
	
	public $components = array('Session', 'Functions');
	
	public $layout = 'apps';	

	/* function to list the adv. requests */
	public function index(){	
		// set the page title
		$this->set('title_for_layout', 'Approve Gallery - HRIS - My PDCA');		
	
		$format_list = $this->HrGalApprove->Home->find('list', array('fields' => array('Home.id', 'Home.full_name'), 'order' => array('Home.full_name' => 'asc')));		
		$this->set('empList', $format_list);
		
		$options = array(			
			array('table' => 'hr_gallery_status',
					'alias' => 'HrGalleryStatuses',					
					'type' => 'LEFT',
					'conditions' => array('`HrGalleryStatuses`.`hr_gallery_id` = `HrGalApprove`.`id`')
			),
			array('table' => 'app_users',
					'alias' => 'Homes',					
					'type' => 'LEFT',
					'conditions' => array('`HrGalleryStatuses`.`app_users_id` = `Homes`.`id`')
			),
			
			array('table' => 'app_users',
					'alias' => 'Home2',					
					'type' => 'LEFT',
					'conditions' => array('`HrGalApprove`.`app_users_id` = `Home2`.`id`')
			)
		);
			
		// when the form is submitted for search
		if($this->request->is('post')){
			$url_vars = $this->Functions->create_url(array('keyword','emp_id'),'HrGalApprove'); 
			$this->redirect('/hrgalapprove/?'.$url_vars);			
		}					
		$this->HrGalApprove->unBindModel(array('hasOne' => array('HrGalStatus','HrGalleryItem')));
		
		if($this->params->query['keyword'] != ''){
			$keyCond = array("MATCH (HrGalApprove.title,HrGalApprove.desc) AGAINST ('".$this->params->query['keyword']."' IN BOOLEAN MODE)"); 
		}
		if($this->params->query['emp_id'] != ''){
			$empCond = array('HrGalApprove.app_users_id' => $this->params->query['emp_id']); 
		}
				
		// fetch the advances		
		$this->paginate = array('fields' => array('id','HrGalApprove.title','HrGalApprove.desc','created_date','max(HrGalleryStatuses.id) as status_id','group_concat(HrGalleryStatuses.status) as st_status', 'group_concat(HrGalleryStatuses.created_date) as st_created', 'group_concat(Homes.first_name) as st_user','group_concat(HrGalleryStatuses.modified_date) as st_modified','group_concat(HrGalleryStatuses.remarks) as st_remarks', 'Homes.id', 'Home2.id', 'Home2.first_name','Home2.last_name',  'Homes.first_name','Homes.last_name'),'limit' => 10,'conditions' => array($keyCond, $empCond, 'HrGalUser.app_users_id' => $this->Session->read('USER.Login.id')),  'group' => array('HrGalApprove.id'), 'order' => array('created_date' => 'desc'), 'joins' => $options);
		$data = $this->paginate('HrGalApprove');
		
		$this->set('gal_data', $data);
		
		// hide verify icon display
		foreach($data as $hr_gallery){ 
			$show_st = $this->auth_action($hr_gallery['HrGalApprove']['id'], $hr_gallery[0]['status_id']);			
			$status_id[] = $show_st;				
		}
		$this->set('show_status', $status_id);
		
		if(empty($data)){
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>You have no galleries to approve', 'default', array('class' => 'alert alert'));	
		}
		
		
	}
	
	
	
	/* function to process the leave */
	public function process_gal($gal_id, $st_id, $status,$user_id){ 
		$data = array('modified_date' => $this->Functions->get_current_date(), 'modified_by' => $this->Session->read('USER.Login.id'), 'remarks' => $this->request->query['remark'], 'status' => $status);
		$this->HrGalApprove->HrGalStatus->id = $st_id;
		$st_msg = $status == 'A' ? 'approved' : 'rejected';
		// make sure not duplicate status exists
		$this->check_duplicate_status($gal_id, $this->Session->read('USER.Login.id'), 1);
		// save the finance adv. status
		if($this->HrGalApprove->HrGalStatus->save($data, true, $fieldList = array('modified_by','modified_date','remarks','status'))){
			// get user data
			$user_data = $this->HrGalApprove->Home->find('first', array('conditions' => array('Home.id' => $user_id),'fields' => array('email_address','first_name', 'last_name')));
			// get leave details
			$req_data = $this->HrGalApprove->findById($gal_id, array('fields' => 'title','desc'));
			// reject photos
			$this->reject_photos($gal_id);
			
			// update gal status
			$this->HrGalApprove->id = $gal_id;
			$this->HrGalApprove->saveField('is_approve', 'Y');
			
			$vars = array('name' => $user_data['Home']['first_name'].' '.$user_data['Home']['last_name'],  'remarks' => $this->request->query['remark'], 'status' => $st_msg, 'req_date' => $req_data['HrGalApprove']['req_date'],'employee' => $user_data['Home']['first_name'].' '.$user_data['Home']['last_name'],'desc' => $req_data['HrGalApprove']['desc'],'title' => $req_data['HrGalApprove']['title']);
			// notify employee						
			if(!$this->send_email('My PDCA - Your posted gallery is '.$st_msg.' by '.ucfirst($this->Session->read('USER.Login.first_name')).' '.ucfirst($this->Session->read('USER.Login.last_name')), 'notify_gallery', 'noreply@mypdca.in', $user_data['Home']['email_address'],$vars)){		
				// show the msg.								
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in sending the mail to user...', 'default', array('class' => 'alert alert-error'));				
			}else{								
				}		
			
		
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Gallery request is '.$st_msg.' successfully', 'default', array('class' => 'alert alert-success'));
		}else{
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Problem in updating the status', 'default', array('class' => 'alert alert-error'));		
		}
		$this->redirect('/hrgalapprove/');	
	}
	
	/* function to reject photos */
	public function reject_photos($gal_id){
		foreach($this->request->data['HrGalApprove']['reject'] as $check){
			if($check != 0){
				$this->HrGalApprove->HrGalleryItem->id = $check;
				$this->HrGalApprove->HrGalleryItem->saveField('status', '0');
			}
		}
	}
	
	
	
	/* function to check for duplicate entry */
	public function check_duplicate_status($fin_id, $app_user_id, $update){
		$count = $this->HrGalApprove->HrGalStatus->find('count',  array('conditions' => array('HrGalStatus.hr_gallery_id' => $fin_id, 'HrGalStatus.app_users_id' => $app_user_id)));
		// when the user is updating the request
		if($update){
			$cnt_cond = 1;
		}else{
			$cnt_cond = 0;
		}
		if($count > $cnt_cond){
			$this->invalid_attempt();
		}
		
	}
	
	
	
	/* function to auth record */
	public function auth_action($id,$st_id, $view){
		$data = $this->HrGalApprove->HrGalStatus->findById($st_id, array('fields' => 'app_users_id', 'status'));	
		// check the req belongs to the user
		if($data['HrGalStatus']['app_users_id'] == $this->Session->read('USER.Login.id') && $data['HrGalStatus']['status'] == 'W'){	
			return 'pass';
		}else if($view == 1){ // for view mode only
			$data = $this->HrGalApprove->HrGalStatus->find('first', array('fields' => array('app_users_id'), 'conditions' => array('app_users_id' => $data['HrGalStatus']['app_users_id'], 'hr_gallery_id' => $id), 'limit' => 1));
			if(!empty($data)){
				return 'view_only';
			}
		}else{
			return 'fail';
		}
	}
	
	/* function to view the leave request */
	public function view_gallery($id,$st_id){
		// set the page title		
		$this->set('title_for_layout', 'Gallery Request - Approve/Reject - HRIS - My PDCA');
		if(!empty($id) && intval($id) && !empty($st_id) && intval($st_id)){
			// authorize user before action
			$ret_value = $this->auth_action($id,$st_id, 1);
			if($ret_value == 'pass'  || $ret_value == 'view_only'){	
				$data = $this->HrGalApprove->findById($id, array('fields' => 'HrGalApprove.title', 'HrGalApprove.desc','folder'));
				// get gal. items.
				$items = $this->HrGalApprove->HrGalleryItem->find('all', array('conditions' => array('hr_gallery_id' => $id, 'status' => '1'), 'fields' => array('id','title', 'desc', 'file'), 'order' => array('HrGalleryItem.id' => 'asc')));			
				$this->set('gallery_data', $data);
				$this->set('gallery_items', $items);
				// for view mode
				if($ret_value == 'view_only'){					
					$this->set('VIEW_ONLY', 1);
				}
			}else if($ret_value == 'fail'){ 
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/hrgalapprove/');	
			}else{
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Record Deleted: '.$ret_value , 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/hrgalapprove/');	
			}
		}else{
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));		
			$this->redirect('/hrgalapprove/');	
		}
		
		
	}
	
	/* clear the cache */
	
	public function beforeFilter() { 
		//$this->disable_cache();
		$this->show_tabs(44);
		// check module access
		
	}
	
	
	
	
}