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
class TskroahistoryController extends AppController {  
	
	public $name = 'TskRoaHistory';	
	
	public $helpers = array('Html', 'Form', 'Session');
	
	public $components = array('Session', 'Functions');
	
	public $layout = 'apps';	

	/* function to list the adv. requests */
	public function index(){	
		// set the page title
		$this->set('title_for_layout', 'ROA History - Work Planner - My PDCA');
		$this->set('star_options', array('M' => 'Star of the Month', 'Q' => 'Star of the Quarter', 'C' => 'Champion of CareerTree'));
		// when the form is submitted for search
		if($this->request->is('post')){
			$url_vars = $this->Functions->create_url(array('month_start','month_end','type'),'TskRoaHistory'); 
			$this->redirect('/tskroahistory/?'.$url_vars);			
		}
		// for start date and end date search
		$start = $this->Functions->format_month_save($this->params->query['month_start']);
		$end = $this->Functions->format_month_save($this->params->query['month_end']);
		if($start != '' && $end != ''){			
			$keyCond = array('reward_month between ? and ?' => array($start, $end)); 
		}else if($start != ''){			
			$keyCond = array('reward_month >=' =>  $start); 
		}else if($end != ''){			
			$keyCond = array('reward_month <=' =>  $end); 
		}
		// search task type
		if($this->request->query['type'] != ''){
			$typeCond = array('TskStar.star_type' =>  $this->request->query['type']); 
		}
		
		$options = array(			
			array('table' => 'tsk_applause_status',
					'alias' => 'TskApplauseStatuses',					
					'type' => 'LEFT',
					'conditions' => array('`TskApplauseStatuses`.`tsk_applause_id` = `TskRoaHistory`.`id`')
			),
			array('table' => 'app_users',
					'alias' => 'Homes',					
					'type' => 'LEFT',
					'conditions' => array('`TskApplauseStatuses`.`app_users_id` = `Homes`.`id`')
			)		
			,
			array('table' => 'tsk_applause_member',
					'alias' => 'ApplauseMember',					
					'type' => 'INNER',
					'conditions' => array('`TskRoaHistory`.`id` = `ApplauseMember`.`tsk_applause_id`')
			)
			,
			array('table' => 'app_users',
					'alias' => 'Homes2',					
					'type' => 'INNER',
					'conditions' => array('`ApplauseMember`.`app_users_id` = `Homes2`.`id`')
			),
			array('table' => 'tsk_applause_star',
					'alias' => 'TskStar',					
					'type' => 'LEFT',
					'conditions' => array('`TskStar`.`tsk_applause_id` = `TskRoaHistory`.`id`')
			)
			
		);
			
		$this->TskRoaHistory->virtualFields = array('status_order' => 'max(TskApplauseStatuses.status)');
		
		// check the user has the permission
		if($this->check_committee_member()){
			// fetch the advances		
			$this->paginate = array('fields' => array('id','reward_month', 'type', 'group_concat(Distinct TskStar.star_type) as star_type', 'status_order', "group_concat(Distinct Homes2.first_name SEPARATOR ', ') as roa_member", 'rating','attachment','created_date', 'group_concat(Distinct TskApplauseStatuses.status) as st_status', 'group_concat(Homes.first_name) as st_user', 'group_concat(Distinct TskApplauseStatuses.modified_date) as st_modified','group_concat(Distinct TskApplauseStatuses.created_date) as st_created', 'group_concat(Distinct TskApplauseStatuses.remarks) as st_remarks'),'limit' => 10,'conditions' => array($keyCond, $typeCond, 'TskRoaHistory.is_approve' => 'Y', 'TskRoaHistory.is_deleted' => 'N'), 'order' => array('TskRoaHistory.created_date' => 'desc'), 'group' => array('TskRoaHistory.id'), 'joins' => $options);
			$data = $this->paginate('TskRoaHistory');		
			$this->set('roa_data', $data);
		}
		if(empty($data)){
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>You have no ROA details found', 'default', array('class' => 'alert alert'));	
		}
		
		
	}
	
	
	
	/* function to download the file */
	public function download_attachment($file){	
		$this->download_file(WWW_ROOT.'/uploads/task/'.$file);
		die;
		
	}

	
	
	
	/* function to auth record */
	public function auth_action($id){
		$data = $this->TskRoaHistory->findById($id, array('fields' => 'app_users_id','is_deleted'));	
		// check the req belongs to the user
		if($data['TskRoaHistory']['is_deleted'] == 'Y'){
			return 'deleted';
		}		
		else if($this->check_committee_member()){	
			return 'pass';
		}else{
			return 'fail';
		}
	}
	
	/* function to check committee member */
	public function check_committee_member(){
		$this->loadModel('TskRoaCommittee');
		$data = $this->TskRoaCommittee->find('all', array('conditions' => array('app_users_id' => $this->Session->read('USER.Login.id')), 'fields' => array('TskRoaCommittee.id')));
		if(!empty($data[0]['TskRoaCommittee']['id'])){
			return true;
		}else{
			return false;	
		}
	}
	
	/* function to view the adv. request */
	public function view($id){
		$this->layout = 'iframe';
		// set the page title		
		$this->set('title_for_layout', 'View ROA History - Work Planner - My PDCA');
		if(!empty($id) && intval($id)){
			// authorize user before action
			$ret_value = $this->auth_action($id);
			if($ret_value == 'pass'){
				$options = array(		
					
					array('table' => 'tsk_applause_member',
							'alias' => 'ApplauseMember',					
							'type' => 'INNER',
							'conditions' => array('`TskRoaHistory`.`id` = `ApplauseMember`.`tsk_applause_id`')
					)
					,
					array('table' => 'app_users',
							'alias' => 'Homes2',					
							'type' => 'INNER',
							'conditions' => array('`ApplauseMember`.`app_users_id` = `Homes2`.`id`')
					),
					array('table' => 'tsk_applause_star',
							'alias' => 'TskStar',					
							'type' => 'LEFT',
							'conditions' => array('`TskStar`.`tsk_applause_id` = `TskRoaHistory`.`id`')
					),
					array('table' => 'tsk_applause_cat_user',
							'alias' => 'TskRoaCatUser',					
							'type' => 'INNER',
							'conditions' => array('`TskRoaCatUser`.`tsk_applause_id` = `TskRoaHistory`.`id`')
					),
					array('table' => 'tsk_applause_category',
							'alias' => 'TskRoaCat',					
							'type' => 'INNER',
							'conditions' => array('`TskRoaCatUser`.`tsk_applause_category_id` = `TskRoaCat`.`id`')
					),
					array('table' => 'app_users',
							'alias' => 'Employee',					
							'type' => 'INNER',
							'conditions' => array('`Employee`.`id` = `TskRoaHistory`.`app_users_id`')
					),
					array('table' => 'hr_business_unit',
							'alias' => 'BusinessUnit',					
							'type' => 'LEFT',
							'conditions' => array('`BusinessUnit`.`id` = `Homes2`.`hr_business_unit_id`')
					),
					array('table' => 'hr_department',
							'alias' => 'Department',					
							'type' => 'LEFT',
							'conditions' => array('`Department`.`id` = `Homes2`.`hr_department_id`')
					),
					array('table' => 'hr_branch',
							'alias' => 'Branch',					
							'type' => 'LEFT',
							'conditions' => array('`Branch`.`id` = `Homes2`.`hr_branch_id`')
					)
				);
				$data = $this->TskRoaHistory->find('all', array('fields' => array('id','reward_month', 'group_concat(Distinct TskStar.star_type) as star_type','rating','emp_acts','emp_relate','attachment','type','Employee.first_name', 'TskRoaHistory.created_date',
				"group_concat(Distinct Homes2.first_name SEPARATOR ', ') as roa_member",'group_concat(Branch.branch_name) as branch', 'group_concat(Department.dept_name) as dept', 'group_concat(BusinessUnit.business_unit) as bus_unit', "group_concat(Distinct TskRoaCat.title SEPARATOR ', ') as roa_category"),'conditions' => array('TskRoaHistory.id' => $id), 'joins' => $options));
				$this->set('roa_data', $data[0]);
			}else if($ret_value == 'fail'){ 
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/tskroahistory/');	
			}else{
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Record Deleted' , 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/tskroahistory/');	
			}
		}else{
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));		
			$this->redirect('/tskroahistory/');	
		}
		
		
	}
	
	/* clear the cache */
	
	public function beforeFilter() { 
		//$this->disable_cache();
		$this->show_tabs(94);
		
	}
	
	
	
	
}