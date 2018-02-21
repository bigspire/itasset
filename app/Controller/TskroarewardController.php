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
 * @link          http://cakephp.org CakePHP(tm) Gifts & Rewards
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
 
App::uses('Sanitize', 'Utility');
 
class TskroarewardController extends AppController {  
	
	public $name = 'TskRoaReward';	
	
	public $helpers = array('Html', 'Form', 'Session');
	
	public $components = array('Session', 'Functions');
	
	public $layout = 'apps';	

	/* function to list the adv. requests */
	public function index(){	
		// set the page title
		$this->set('title_for_layout', 'Gifts & Rewards - Work Planner - My PDCA');
		$this->set('star_options', array('M' => 'Star of the Month', 'Q' => 'Star of the Quarter', 'C' => 'Champion of CareerTree'));

		// when the form is submitted for search
		if($this->request->is('post')){
			$url_vars = $this->Functions->create_url(array('month_start','month_end','type'),'TskRoaReward'); 
			$this->redirect('/tskroareward/?'.$url_vars);			
		}
		// for start date and end date search
		$start = $this->Functions->format_month_save($this->params->query['month_start']);
		$end = $this->Functions->format_month_save($this->params->query['month_end']);
		if($start != '' && $end != ''){			
			$keyCond = array('reward_date between ? and ?' => array($start, $end)); 
		}else if($start != ''){			
			$keyCond = array('reward_date >=' =>  $start); 
		}else if($end != ''){			
			$keyCond = array('reward_date <=' =>  $end); 
		}
		// search task type
		if($this->request->query['type'] != ''){
			$typeCond = array('TskRoaReward.is_star' =>  $this->request->query['type']); 
		}
		
		$options = array(			
				array('table' => 'tsk_applause_reward_member',
						'alias' => 'RewardMember',					
						'type' => 'INNER',
						'conditions' => array('`TskRoaReward`.`id` = `RewardMember`.`tsk_applause_reward_id`')
				)
				,
				array('table' => 'app_users',
						'alias' => 'Employee',					
						'type' => 'INNER',
						'conditions' => array('`RewardMember`.`app_users_id` = `Employee`.`id`')
				)
			);
			
		// fetch the advances		
		$this->paginate = array('fields' => array('id','reward_date', 'certificate', 'gift_voucher','is_star','created_date',"group_concat(Employee.first_name SEPARATOR ', ') as reward_member"),'limit' => 10,'conditions' => array($keyCond, 'TskRoaReward.is_deleted' => 'N'), 'order' => array('created_date' => 'desc'), 'group' => array('TskRoaReward.id'), 'joins' => $options);
		$data = $this->paginate('TskRoaReward');			
		$this->set('reward_data', $data);
		if(empty($data)){
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>You havn\'t created any gifts & rewards', 'default', array('class' => 'alert alert'));	
		}
	}
	
	/* function to save the customer */
	public function create_reward(){ 
		// set the page title		
		$this->set('title_for_layout', 'Create Gifts & Rewards - Work Planner - My PDCA');	
		$this->set('star_list', array('M' => 'Star of the Month', 'Q' => 'Star of the Quarter', 'C' => 'Champion of CareerTree'));
		// fetch the list of employee
		$this->TskRoaReward->HrEmployee->virtualFields = array('full_name' => "UPPER(CONCAT_WS(' ', trim(HrEmployee.first_name), trim(HrEmployee.last_name)))");
		$emp_list = $this->TskRoaReward->HrEmployee->find('list', array('fields' => array('id','HrEmployee.full_name'), 'order' => array('HrEmployee.full_name ASC'),'conditions' => array('HrEmployee.status' => 1)));
		$this->set('empList', $emp_list);
		if ($this->request->is('post')){ 
			// validates the form
			$this->TskRoaReward->set($this->request->data);
			// validate the file
			$this->TskRoaReward->validate_file();
			if ($this->TskRoaReward->validates(array('fieldList' => array('reward_month','gift_voucher','member','attachment')))) {
				$this->request->data['TskRoaReward']['created_date'] = $this->Functions->get_current_date();
				$this->request->data['TskRoaReward']['app_users_id'] = $this->Session->read('USER.Login.id');
				// format the dates to save
				$this->request->data['TskRoaReward']['reward_date'] = $this->Functions->format_month_save($this->request->data['TskRoaReward']['reward_month']);
				
				// save the data
				if($this->TskRoaReward->save($this->request->data['TskRoaReward'])) {	
					// upload the file
					if($file = $this->upload_attachment($this->request->data['TskRoaReward']['attachment'], $this->TskRoaReward->id)){						
						$this->TskRoaReward->saveField('certificate', $file);
					}
					// save project members
					$this->save_members($this->TskRoaReward->id);
					// show the msg.
					$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Gifts & Rewards details created successfully', 'default', array('class' => 'alert alert-success'));
					$this->redirect('/tskroareward/');
				}else{
					$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in saving the data...', 'default', array('class' => 'alert alert-error'));
				}
			}else{
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in submitting the form. please check errors...', 'default', array('class' => 'alert alert-error'));	
			}
		}
	}
	
	/* function to upload the file */
	public function upload_attachment($data, $id){
		// validate the file				
		if(!empty($data['tmp_name'])){
			$file = $id.'_'.$data['name']; 
			if($this->upload_file($data['tmp_name'], WWW_ROOT.'/uploads/task/'.$file)){
				return $file;
			}			
		}
				
	}
	
	/* function to save project users */
	public function save_members($id){
		if(count($this->request->data['TskRoaReward']['member']) > 0){
			$this->loadModel('TskRoaRewardMember');
			// save cc. users
			foreach($this->request->data['TskRoaReward']['member'] as $user){
				$data = array('tsk_applause_reward_id' => $id, 'app_users_id' => $user);
				$this->TskRoaRewardMember->id = '';
				$this->TskRoaRewardMember->save($data, true, $fieldList = array('tsk_applause_reward_id','app_users_id'));	
			}
		}
	}
	
	/* function to download the file */
	public function download_certificate($file){	
		$this->download_file(WWW_ROOT.'/uploads/task/'.$file);
		die;
		
	}
	
	/* function to delete the adv. request */
	public function delete_reward($project_id){
		if(!empty($project_id) && intval($project_id)){
			// authorize user before action
			$ret_value = $this->auth_action($project_id);
			if($ret_value == 'pass'){				
				$this->TskRoaReward->id = $project_id;
				$this->TskRoaReward->saveField('is_deleted', 'Y'); 
				$this->TskRoaReward->saveField('modified_date', $this->Functions->get_current_date()); 				
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Gifts & Rewards deleted successfully', 'default', array('class' => 'alert alert-success'));				
			}else if($ret_value == 'fail'){
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/tskroareward/');
			}else{
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Record Deleted: '.$ret_value , 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/tskroareward/');
			}
		}else{
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));			
		}
		$this->redirect('/tskroareward/');
	}
	
	
	/* function to edit the advance */
	public function edit_reward($id){	
		// set the page title		
		$this->set('title_for_layout', 'Edit Gifts & Rewards - Work Planner - My PDCA');
		$this->set('star_list', array('M' => 'Star of the Month', 'Q' => 'Star of the Quarter', 'C' => 'Champion of CareerTree'));
		$this->TskRoaReward->HrEmployee->virtualFields = array('full_name' => "UPPER(CONCAT_WS(' ', trim(HrEmployee.first_name), trim(HrEmployee.last_name)))");

		// fetch the list of states		
		$emp_list = $this->TskRoaReward->HrEmployee->find('list', array('fields' => array('id','HrEmployee.full_name'), 'order' => array('HrEmployee.full_name ASC'),'conditions' => array('HrEmployee.status' => 1, 'HrEmployee.is_deleted' => 'N')));
		$this->set('empList', $emp_list);
		if (!empty($id) && intval($id)){
			// authorize user before action
			$ret_value = $this->auth_action($id);
			if($ret_value == 'pass'){	
				// when the form submitted
				if (!empty($this->request->data)){ 
					// validates the form
					$this->TskRoaReward->set($this->request->data);
					// validate the file
					$this->TskRoaReward->validate_file();
					if ($this->TskRoaReward->validates(array('fieldList' => array('reward_month','gift_voucher','member','attachment')))) {
						
						$this->request->data['TskRoaReward']['modified_date'] = $this->Functions->get_current_date();
						// format the dates to save
						$this->request->data['TskRoaReward']['reward_date'] = $this->Functions->format_month_save($this->request->data['TskRoaReward']['reward_month']);
				
						// save the data
						if($this->TskRoaReward->save($this->request->data['TskRoaReward'], array('validate' => false))) {
						
							// upload the file
							if($file = $this->upload_attachment($this->request->data['TskRoaReward']['attachment'], $id)){						
								$this->TskRoaReward->saveField('certificate', $file);
							}
							// remove members
							$this->remove_members($id);
							// save project members
							$this->save_members($id);
							// show the msg.
							$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Gifts & Rewards details modified successfully', 'default', array('class' => 'alert alert-success'));
						}else{
							// show the error msg.
							$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in saving the data...', 'default', array('class' => 'alert alert-error'));					
						}					
						$this->redirect('/tskroareward/');						
					}	
				}else{
					$this->request->data = $this->TskRoaReward->findById($id);
					// format the dates to show
					$this->request->data['TskRoaReward']['reward_month'] = $this->Functions->format_month_show($this->request->data['TskRoaReward']['reward_date']);
					
					// get project members
					$this->loadModel('TskRoaRewardMember');
					$proj_user = $this->TskRoaRewardMember->find('all', array('fields' => array('app_users_id'), 'conditions' => array('tsk_applause_reward_id' => $id)));
					foreach($proj_user as $user){						
						$member[] = $user['TskRoaRewardMember']['app_users_id'];					
					}
					$this->set('members', $member);
					
				}
			}else if($ret_value == 'fail'){
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/tskroareward/');
			}else{
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Record Deleted: '.$ret_value , 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/tskroareward/');
			}
		}else{
			// show the error msg.
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));
			$this->redirect('/tskroareward/');		
		}		
		
	}
	
	/* function to remove the project members */
	public function remove_members($id){	
		$this->loadModel('TskRoaRewardMember');
		$this->TskRoaRewardMember->deleteAll(array('tsk_applause_reward_id' => $id), false);
	}
	
	/* function to auth record */
	public function auth_action($id){
		$data = $this->TskRoaReward->findById($id, array('fields' => 'id','is_deleted','modified_date'));	
		// check the req belongs to the user
		if($data['TskRoaReward']['is_deleted'] == 'Y'){
			return $data['TskRoaReward']['modified_date'];
		}		
		else if(empty($data)){	
			return 'fail';
		}else{
			return 'pass';
		}
	}
	
	
	
	
	/* clear the cache */	
	public function beforeFilter() { 
		//$this->disable_cache();
		$this->show_tabs(93);
	}
	
	
	
	
	
}