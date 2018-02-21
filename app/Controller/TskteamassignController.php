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
class TskteamassignController extends AppController {  
	
	public $name = 'TskTeamAssign';	
	
	public $helpers = array('Html', 'Form', 'Session');
	
	public $components = array('Session', 'Functions');
	
	public $layout = 'apps';	

	/* function to list the tsk plan requests */
	public function index(){	
		// set the page title
		$this->set('title_for_layout', 'Assigned by Me - Work Planner - My PDCA');
		$this->set('planStatus', $this->Functions->get_plan_status('team_assign'));		
		$this->load_company_data();	
		$this->load_project_data();
		// get team list
		$this->get_team();
		$this->set('taskType', array('D' => 'Daily Task', 'P' => 'Project Task'));
		// load task types
		$this->set('planType', $this->load_plan_types());
		// load employee for Cc
		$this->load_employee();		
		// call create task
		$this->assign_task();
		// when the form is submitted for search
		if($this->request->is('post')){
			$url_vars = $this->Functions->create_url(array('type','company','project','month_year','plan_status','emp_id'),'TskTeamAssign'); 
			$this->redirect('/tskteamassign/?'.$url_vars);			
		}
		
		$this->create_url_var('TskTeamAssign');
	}
	
	/* function to create redirect url */
	public function create_url_var($model){
		$url_vars = $this->Functions->create_redirect_url(array('type','company','project','month_year','plan_status','emp_id'), $model);
		$this->set('URL_VAR', $url_vars);
	}
	
	
	public function get_team(){
		if($this->request->query['type'] == 'D' || empty($this->request->query['type'])){
			$emp_list = $this->TskTeamAssign->get_team($this->Session->read('USER.Login.id'),'T');
			$format_list = $this->Functions->format_dropdown($emp_list, 'u','id','first_name', 'last_name');		
			$this->set('empList', $format_list);
		}else{
			$this->loadModel('TskProjectMember');
			$this->TskProjectMember->virtualFields = array('full_name' => "UPPER(CONCAT_WS(' ', trim(HrEmployee.first_name), trim(HrEmployee.last_name)))");
			$data = $this->TskProjectMember->find('all', array('fields' => array('app_users_id','full_name'), 'conditions' => array('tsk_projects_id' => $this->request->query['project']), 'order' => array('full_name' => 'asc')));		
			$data2 = $this->Functions->format_dropdown($data, 'TskProjectMember', 'app_users_id', 'full_name');
			$this->set('empList', $data2);
		}
	}


	
	/* function to show the task plan */
	public function show_data(){ 
		$this->layout = 'refresh';
		
		// get the tasks
		$data = $this->get_my_tasks();
		
		header('Content-type: text/json');
		date_default_timezone_set('Asia/Calcutta');

		echo '[';
			
			$initTime = date("Y")."-".date("m")."-".date("d")." ".date("H").":00:00";
			$separator = ",";
			$count = count($data);
			//$initTime = date("Y-m-d H:i:00");
			foreach($data as $key => $rec){	
				$default_start = $rec['TskTeamAssign']['start'];
				// print json
				$this->print_json($rec, $default_start);				
				// check task more than one day for project task plan
				if($rec['TskTeamAssign']['type'] == 'P'){
					$diff = $this->TskTeamAssign->diff_date(date('Y-m-d', strtotime($rec['TskTeamAssign']['start'])), date('Y-m-d', strtotime($rec['TskTeamAssign']['end'])));
					while($diff >= 1){						
						$rec['TskTeamAssign']['start'] = date('Y-m-d', strtotime( $rec['TskTeamAssign']['start']. '+1 days'));
						// print json
						echo $separator;
						$this->print_json($rec, $default_start);
						$diff--; 
					}					
					
				}
				if($key == ($count-1)){
					$separator = " ";
				}				
				echo $separator;
				
			}
			
			// print empty json
			if(empty($data)){
				$this->print_empty_json();
			}

		echo ']';		
		$this->render(false);
		die;		
	}
	
	
	/* function to print empty json */
	public function print_empty_json(){
		echo '{ "date": "1980-03-22 00:00:00" ,
				"title": "test",
				"start_time": "test",
				"end_time": "test",
				"description": "test",
				"status": "test",
				"plan_action": "test",
				"plan_type": "test",
				"url" : "test"}';
	}
	
	/* function to print json */
	public function print_json($rec, $default_start){
				// create url vars
				$url_vars = $this->Functions->create_redirect_url(array('type','company','project','month_year','plan_status','emp_id'),'TskTeamAssign');
				$desc_limit = $rec['TskTeamAssign']['type'] == 'D' ? 40 : 20;
				// for long desc
				$desc_len = strlen($rec['TskTeamAssign']['desc']);
				$more_display = ($desc_len > $desc_limit) ? '' : 'dn';
				$long_desc = ($desc_len > $desc_limit) ? $rec['TskTeamAssign']['desc'] : '';
				$short_desc = $this->Functions->string_truncate($rec['TskTeamAssign']['desc'], $desc_limit);
				// replace new lines
				$short_desc =  $this->Functions->remove_spl_char($short_desc);
				$long_desc =  $this->Functions->remove_spl_char($long_desc);
				
				echo '{ "date": "'; echo date('Y-m-d 23:59:59', strtotime($rec['TskTeamAssign']['start'])); echo '" ,
				"title": "<a href='; echo $this->webroot.'tskteamassign/view_task/'.$rec['TskTeamAssign']['id'].'/?'.trim($url_vars); echo ' class=\" iframeBox cboxElement tsk_title\" val=90_90>'; echo $this->Functions->string_truncate($rec['TskTeamAssign']['title'], 20); echo '</a>'; echo $this->show_edit_link($rec['TskTeamAssign'],$url_vars); echo '",
				"start_time": "'; echo $this->check_plan_type($default_start, $rec['TskTeamAssign']['type']); echo '",
				"end_time": "'; echo $this->check_plan_type($rec['TskTeamAssign']['end'], $rec['TskTeamAssign']['type']); echo '",
				"description": "<i data-placement=top id='; echo 'tag-'.$rec['TskTeamAssign']['id']; echo ' val='; echo $rec['TskTeamAssign']['id'].'-'.$rec['TskTeamAssign']['is_tag']; echo ' rel=tooltip class=\"tsk_tip '; echo $this->Functions->show_read_class($rec['TskTeamAssign']['is_tag']); echo ' cursor icon-circle \" title=\"'; echo $this->Functions->show_read_text($rec['TskTeamAssign']['is_tag']); echo '\"></i><span class=desc_less> '; 
				echo $short_desc;
				echo '</span>'. 
				' <span class=\" desc_more dn \"> '; 
				echo $long_desc; echo '</span><a class=\" tsk_more '; echo $more_display; echo '\" href=javascript:void(0); style=color:#EF7575>more</a> <a class=\" tsk_less dn \" href=javascript:void(0); style=color:#EF7575>less</a>'; echo $this->Functions->check_read_type($rec['TskTeamAssign']['read_status'], $rec['TskTeamAssign']['read_type']); echo '",
				"status": "<span class=\"label '; echo $this->Functions->show_task_status_color($rec['TskTeamAssign']['status']); echo '\">'; echo $this->Functions->show_task_status($rec['TskTeamAssign']['status']); echo '</span>'; echo $this->show_status_link($rec['TskTeamAssign'], $url_vars); echo '",
				"plan_action": "'; echo $rec['TskPlanType']['title']; echo '",
				"plan_type": "<span rel=tooltip title=\"'; echo $this->Functions->show_plan_type($rec['TskTeamAssign']['type']); echo '\" class=\"tsk_tip label '; echo $this->Functions->show_task_plan_color($rec['TskTeamAssign']['type']); echo '\">'; echo $rec['TskTeamAssign']['type']; echo '</span>",
				"user" : "'; echo $rec['TskEmpAssign']['first_name'];  echo $this->Functions->check_task_cc($rec['TskAssignUser']['is_cc']); echo '","read_status": "'; echo $rec['TskTeamAssign']['read_status']; echo '","plan_date": "'; echo $this->Functions->format_date($default_start); echo '",
				"project" : "'; echo $rec['TskProject']['project_name']; echo '","company" : "'; echo $rec['TskCustomer']['company_name']; echo '","rec_id" : "'; echo $rec['TskTeamAssign']['id']; echo '",
				"lead_status": "<span class=\"label '; echo $this->Functions->show_lead_task_status_color($rec['TskAssignStatus']['status'],$rec['TskTeamAssign']['modified_date'],$rec['TskAssignStatus']['created_date']); echo '\">'; echo $this->Functions->show_lead_task_status($rec['TskAssignStatus']['status'],$rec['TskTeamAssign']['modified_date'],$rec['TskAssignStatus']['created_date'],$rec['TskTeamAssign']['status']); echo '</span>'; echo $this->Functions->show_lead_remark($rec['TskAssignStatus']['id'],$rec['TskAssignStatus']['status'],$rec['TskTeamAssign']['modified_date'],$rec['TskAssignStatus']['created_date']); echo '"}';
	}
	
	/* function to show edit link */
	public function show_edit_link($data, $url_vars){
		$task_date = date('Y-m-d', strtotime($data['start']));
		if($data['status'] == 'W'){
			return $link = " <a href='".$this->webroot.'tskteamassign/edit_task/'.$data['id'].'/?'.$url_vars."' title='Edit Task' rel='tooltip'  class = 'tsk_tip tsk_title'><i class=icon-edit></i></a>";
		}
	}
	
		/* function to show date  / project details */
	public function check_plan_type($date, $type, $show_type){
		if($type == 'D'){
			$result = $this->Functions->show_task_time($date, $type);
		}else{
			$result = $this->Functions->format_date($date);
		}
		return $result;
	}
	
	/* function to show status link */
	public function show_status_link($data,$url_vars){ 
		if($data['status'] == 'W'){
			return $link = " <a href='".$this->webroot.'tskteamassign/change_task_status/'.$data['id'].'/?'.$url_vars.'&type='.$data['type'].'&page=list'."' title='Change Status' rel='tooltip' val='42_75'  class = 'tsk_tip iframeBox cboxElement tsk_title'><i class=icon-edit></i></a>";
		}else{
			return $link = "<a href='javascript:void(0)' rel='tooltip'  st='".$data['status']."'  val='".$data['id']."' id='tk_".$data['id']."' title='View Comment' class = 'commentTsk'><i class=icon-comment-alt></i></a>";
		}
	}

	
	
	/* function to get the comments */
	public function get_comments(){
		$this->layout = 'ajax';	
		// check for id
		if(!empty($this->request->data['id'])){
			// if executed or cancelled status
			$status = $this->request->data['status'];
			if($status == 'P' || $status == 'L'){ 
				$data_new = $this->TskTeamAssign->find('all', array('fields' => array('TskTeamAssign.start'), 'conditions' => array('TskTeamAssign.copy_id' => $this->request->data['id'], 'TskTeamAssign.is_deleted' => 'N'), 'limit' => 1));	
				$remark_d = $status == 'P' ? 'Postponed: ' : 'Remaining: ';	
				// print date
				echo $comment = '<strong>'.$remark_d.'</strong>'.$this->Functions->format_date($data_new[0]['TskTeamAssign']['start']).'<br>';				
			}
			if($status == 'C' || $status == 'P'){
				$remark_f = 'Reason: ';
			}else{
				$remark_f =  'Comment: ';
			}				
			$data = $this->TskTeamAssign->find('all', array('fields' => array('TskTeamAssign.remark'), 'conditions' => array('TskTeamAssign.id' => $this->request->data['id'], 'TskTeamAssign.is_deleted' => 'N'), 'limit' => 1));		
			$remark_f = $this->request->data['status'] == 'C' ? 'Reason: ' : 'Comment: ';
			echo $comment = '<strong>'.$remark_f.'</strong>'.$data[0]['TskTeamAssign']['remark'];			
			echo "||";
			echo $this->request->data['id'];
		}
		$this->render(false);
		die;
	}
	
	
	/* function to get the comments */
	public function get_lead_comments(){
		$this->layout = 'ajax';	
		// check for id
		if(!empty($this->request->data['id'])){			
			$data = $this->TskTeamAssign->TskAssignStatus->findById($this->request->data['id'], array('fields' => 'reason'));		
			echo $comment = '<strong>Reason: </strong>'.$data['TskAssignStatus']['reason'];
			echo "||";
			echo $this->request->data['id'];			
		}
		$this->render(false);
		die;
	}
	
	/* function to get my tasks */
	public function get_my_tasks(){
		// get url variables for search
		$plan_type = $this->request->query['type']  ? $this->request->query['type'] : 'D';
		$typeCond = array('TskTeamAssign.type' => $plan_type); 
		
		// for company conditions
		if(!empty($this->request->query['company'])){
			$compCond = array('TskTeamAssign.tsk_company_id' => $this->request->query['company']); 
		}
		// for project condition
		if(!empty($this->request->query['project'])){
			$projCond = array('TskTeamAssign.tsk_projects_id' => $this->request->query['project']); 
		}
		// search task
		if($this->request->query['month_year'] != ''){ 
			$date_split = explode('/', $this->request->query['month_year']);
			$date_str = $date_split[1].'-'.$date_split[0];
			$date_str.'%';
			$dateCond = array('start like' => $date_str.'%');		
		}else{
			$today = date('Y-m-d'); 
			$start = date('Y-m-01', strtotime($today. '-1 months'));
			$end = date('Y-m-31', strtotime( $today. '+1 months'));
			$end = date('Y-m-d', strtotime($end. '+1 days'));
			$dateCond = array('or' => array('start between ? and ?' => array($start, $end),'end between ? and ?' => array($start, $end)));	
		}		
				
		// status conditions
		if(!empty($this->request->query['plan_status'])){
			$statusCond = array('TskTeamAssign.status' => $this->request->query['plan_status']); 
		}
		// employee condition
		if(!empty($this->request->query['emp_id'])){
			$empCond = array('TskAssignUser.app_users_id' => $this->request->query['emp_id'], 'TskAssignUser.is_cc' => '0'); 
		}else{
			$empCond = array('TskAssignUser.is_cc' => '0'); 
		}
		
		$fields = array('id','created_date','title','desc','status','remark','type','start','end','TskPlanType.title', 'TskCustomer.company_name', 'TskProject.project_name', 'read_status', 'read_type','TskEmpAssign.first_name','is_tag','TskAssignUser.is_cc','TskAssignStatus.id','TskAssignStatus.status','TskTeamAssign.modified_date','TskAssignStatus.created_date');
				
		$options = array(		
			array('table' => 'tsk_assign_users',
				'alias' => 'TskAssignUser',					
				'type' => 'LEFT',
				'conditions' => array('`TskAssignUser`.`tsk_assign_id` = `TskTeamAssign``.`id`')
			),
			array('table' => 'app_users',
				'alias' => 'TskEmpAssign',					
				'type' => 'LEFT',
				'conditions' => array('`TskAssignUser`.`app_users_id` = `TskEmpAssign``.`id`')
			)
		);
		
		// fetch the task plans		
		$data = $this->TskTeamAssign->find('all', array('fields' => $fields, 'conditions' => array($statusCond,$typeCond,$compCond,$projCond,$dateCond,$empCond,'TskTeamAssign.app_users_id' => $this->Session->read('USER.Login.id'),'TskTeamAssign.is_deleted' => 'N'), 'order' => array('TskTeamAssign.start' => 'asc'),	'group' => array('TskTeamAssign.id'), 'joins' => $options));

		return $data;
	
	}
	


	
	/* function to save the advance */
	public function assign_task(){ 		
		if ($this->request->is('post')){ 
			// validates the form
			$this->TskTeamAssign->set($this->request->data);
			$this->TskTeamAssign->validate_file();		
			if ($this->TskTeamAssign->validates(array('fieldList' => $this->get_validation_fields()))) { 	
				$this->request->data['TskTeamAssign']['app_users_id'] = $this->Session->read('USER.Login.id');
				// format the dates to save					
				$this->set_plan_date();
				$this->request->data['TskTeamAssign']['created_date'] = $this->Functions->get_current_date();
				$this->format_tsk_fields();
				// save the data
				if($this->TskTeamAssign->save($this->request->data['TskTeamAssign'], array('validate' => false))) {
					// assign the users
					$this->loadModel('TskAssignUser');
					$data = array('tsk_assign_id' => $this->TskTeamAssign->id, 'is_cc' => '0', 'app_users_id' => $this->request->data['TskTeamAssign']['users']);
					// save in adv. status table
					if($this->TskAssignUser->save($data, true, $fieldList = array('tsk_assign_id','is_cc','app_users_id'))){
						// upload the file
						if($file = $this->upload_attachment($this->request->data['TskTeamAssign']['upload_file'], $this->TskTeamAssign->id)){						
							$this->TskTeamAssign->saveField('attachment', $file);
						}
						// save cc users
						$this->save_cc_users($this->TskTeamAssign->id);
						// save read status
						$this->loadModel('TskAssignRead');
						$data = array('tsk_assign_id' => $this->TskTeamAssign->id, 'created_date' => $this->Functions->get_current_date(), 'app_users_id' => $this->request->data['TskTeamAssign']['users']);						
						// make sure not duplicate status exists
						$this->check_duplicate_status($this->TskTeamAssign->id, $this->request->data['TskTeamAssign']['users']);
						// save in adv. status table
						$this->TskAssignRead->id = '';
						$this->TskAssignRead->create();
						if($this->TskAssignRead->save($data, true, $fieldList = array('tsk_assign_id','created_date','app_users_id'))){
							// save read status for cc users
							$this->save_unread_status($this->TskTeamAssign->id);
							$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Task assigned successfully', 'default', array('class' => 'alert alert-success'));
							$url_vars = $this->Functions->create_redirect_url(array('type','company','project','month_year','plan_status','emp_id'),'TskTeamAssign');
							$this->redirect('/tskteamassign/?type='.$this->request->data['TskTeamAssign']['type'].'&date='.$this->Functions->get_task_date($this->request->data['TskTeamAssign']['start']).'&'.$url_vars);							

						}
						
					}else{
						$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in assign users', 'default', array('class' => 'alert alert-info'));
					}				
										
				}else{
					// show the error msg.
					$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in saving the data...', 'default', array('class' => 'alert alert-error'));					
				}			
			}else{
				//print_r($this->TskTeamAssign->validationErrors);
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
	
	
	
			/* function to assign the fields to save */
	public function task_remark_fields($st){
		if($st == 'E' || $st == 'L'){
			$this->request->data['TskTeamAssign']['remark'] = $this->request->data['TskTeamAssign']['comment'];
		}else if($st == 'P' || $st == 'C'){
			$this->request->data['TskTeamAssign']['remark'] = $this->request->data['TskTeamAssign']['reason'];			
		}
	}
	
	
	/* function to save the read status */
	public function save_unread_status($id, $action){
		if(count($this->request->data['TskTeamAssign']['cc_user']) > 0){
			if($action == 'edit'){
				$type = 'M';
				$field = 'action_type';
			}
			// save cc. users
			foreach($this->request->data['TskTeamAssign']['cc_user'] as $cc){
				$data = array('tsk_assign_id' => $id, 'created_date' => $this->Functions->get_current_date(), 'app_users_id' => $cc,
				$field => $type);						
				$this->check_duplicate_status($id, $cc);
				$this->TskAssignUser->id = '';
				// save in adv. status table
				$this->TskAssignRead->id = '';
				$this->TskAssignRead->create();
				$this->TskAssignRead->save($data, true, $fieldList = array('tsk_assign_id','created_date','app_users_id', $field));									
			}
		}
	}
	
	
	/* function to save cc users */
	public function save_cc_users($id){
		if(count($this->request->data['TskTeamAssign']['cc_user']) > 0){
			// save cc. users
			foreach($this->request->data['TskTeamAssign']['cc_user'] as $cc){
				$data = array('tsk_assign_id' => $id, 'is_cc' => '1', 'app_users_id' => $cc);
				$this->TskAssignUser->id = '';
				$this->TskAssignUser->save($data, true, $fieldList = array('tsk_assign_id','is_cc','app_users_id'));	
			}
		}
	}
	
	/* function to check for duplicate entry */
	public function check_duplicate_status($id, $user_id){
		$count = $this->TskAssignRead->find('count',  array('conditions' => array('TskAssignRead.tsk_assign_id' => $id,
		'TskAssignRead.app_users_id' => $user_id)));
		if($count > 0){
			$this->invalid_attempt();
		}
		
	}
	
	/* function to set plan start and end */
	public function set_task_timing($date){
		if($this->request->data['TskTeamAssign']['type'] == 'D'){
			return $this->Functions->format_date_save($this->request->data['TskTeamAssign']['plan_date']).' '.$this->Functions->format_time_save($date);
		}else{
			return $this->Functions->format_date_save($date);
		}
	}
	
	
	/* function to set plan start and end */
	public function set_plan_date(){
		if($this->request->data['TskTeamAssign']['type'] == 'D'){
			$this->request->data['TskTeamAssign']['start'] = $this->Functions->format_date_save($this->request->data['TskTeamAssign']['plan_date']).' '.$this->Functions->format_time_save($this->request->data['TskTeamAssign']['start_time']);
			$this->request->data['TskTeamAssign']['end'] = $this->Functions->format_date_save($this->request->data['TskTeamAssign']['plan_date']).' '.$this->Functions->format_time_save($this->request->data['TskTeamAssign']['end_time']);
		}else{
			$this->request->data['TskTeamAssign']['start'] = $this->Functions->format_date_save($this->request->data['TskTeamAssign']['start_date']);
			$this->request->data['TskTeamAssign']['end'] = $this->Functions->format_date_save($this->request->data['TskTeamAssign']['end_date']);

		}
	}
	
	/* function to set plan start and end */
	public function format_tsk_fields(){
		if($this->request->data['TskTeamAssign']['type'] == 'D'){					
			$this->request->data['TskTeamAssign']['tsk_company_id'] == '';
			$this->request->data['TskTeamAssign']['tsk_projects_id'] == '';
		}
	}
	
	/* function to show the validation fields */
	public function get_validation_fields(){
		if($this->request->data['TskTeamAssign']['type'] == 'P'){
			$valid_arr =  array('type', 'title', 'desc','start_date','end_date','tsk_company_id','tsk_projects_id', 'tsk_plan_types_id','upload_file','cc_user');			
		}else{
			$valid_arr =  array('type', 'title', 'desc', 'plan_date', 'start_time','end_time','tsk_plan_types_id','users','cc_user','upload_file','cc_user');			
		}
		return $valid_arr;
	}
	
	
		/* function to load static data */
	public function load_company_data(){
		// fetch the companies
		$comp_list = $this->TskTeamAssign->TskCustomer->find('list', array('fields' => array('id','company_name'), 'order' => array('company_name ASC'),'conditions' => array('is_deleted' => 'N', 'status' => '1')));
		$this->set('compList', $comp_list);
	}
	
	public function load_project_data(){
		// fetch the projects	
		if($this->request->params['action'] == 'edit_task' || !empty($this->request->data['TskTeamAssign']['tsk_company_id'])){
			$comp_cond = array('tsk_company_id' => $this->request->data['TskTeamAssign']['tsk_company_id']);
		}else if(!empty($this->request->query['company'])){
			$comp_cond = array('tsk_company_id' => $this->request->query['company']);
		}
		// if company selected
		if(!empty($comp_cond)){
			$this->TskTeamAssign->TskProject->bindModel(
			array('hasOne' => array(
					'TskProjectMember' => array(
						'className' => 'TskProjectMember',
						'foreignKey' => 'tsk_projects_id',
						'type' => 'INNER'
						)
					)
				)
			);			
			$proj_cond = array('or' => array('TskProject.project_leader' => $this->Session->read('USER.Login.id'), 'TskProjectMember.app_users_id' => $this->Session->read('USER.Login.id')));
			$proj_list = $this->TskTeamAssign->TskProject->find('all', array('fields' => array('id','project_name'), 'order' => array('project_name ASC'),'conditions' => array('TskProject.is_deleted' => 'N', $comp_cond,$proj_cond)));
			$data2 = $this->Functions->format_dropdown($proj_list, 'TskProject', 'id', 'project_name');
			$this->set('projList', $data2);
		}
	}
	
	
	/* function to load the employee */
	public function load_employee(){
		$this->TskTeamAssign->HrEmployee->virtualFields = array('first_name' => "UPPER(CONCAT_WS(' ', trim(HrEmployee.first_name), trim(HrEmployee.last_name)))");
		$empList = $this->TskTeamAssign->HrEmployee->find('list', array('fields' => array('id','first_name'),
		'order' => array('first_name ASC'),'conditions' => array('is_deleted' => 'N', 'status' => '1')));
		$this->set('empCcList', $empList);
	}
	
	
	/* function to edit the advance */
	public function edit_task($id){	
		// set the page title		
		$this->set('title_for_layout', 'Edit Task - Work Planner - My PDCA');		
		if (!empty($id) && intval($id)){
			// authorize user before action
			$ret_value = $this->auth_action($id);
			if($ret_value == 'pass'){
				$this->create_url_var('TskTeamAssign');
				// load task types
				$this->set('planType', $this->load_plan_types());
				$this->get_team();
				$this->load_company_data();
				// load employee for Cc
				$this->load_employee();				
				// load task types
				$this->set('taskType', array('D' => 'Daily Task', 'P' => 'Project Task'));
				// when the form submitted
				if (!empty($this->request->data)){ 
					// validates the form
					$this->TskTeamAssign->set($this->request->data);
					$this->load_project_data();
					// validate the file
					$this->TskTeamAssign->validate_file();
					if ($this->TskTeamAssign->validates(array('fieldList' => $this->get_validation_fields()))) {
						// format the dates to save					
						$this->set_plan_date();
						$this->request->data['TskTeamAssign']['modified_date'] = $this->Functions->get_current_date();
						$this->format_tsk_fields();
						// save the data
						if($this->TskTeamAssign->save($this->request->data['TskTeamAssign'], array('validate' => false))) {
							// remove assign user to update
							$this->loadModel('TskAssignUser');
							$this->remove_assign_users($id);
							$data = array('tsk_assign_id' => $id, 'is_cc' => '0', 'app_users_id' => $this->request->data['TskTeamAssign']['users']);
							// save in assign user table
							if($this->TskAssignUser->save($data, true, $fieldList = array('tsk_assign_id','is_cc','app_users_id'))){
								// upload the file
								if($file = $this->upload_attachment($this->request->data['TskTeamAssign']['upload_file'], $id)){						
									$this->TskTeamAssign->saveField('attachment', $file);
								}
								// save cc user
								$this->save_cc_users($id);
								// remove unread rows
								$this->loadModel('TskAssignRead');
								$this->remove_unread_status($id);
								// set unread for assign user
								// make sure not duplicate status exists
								$this->check_duplicate_status($id, $this->request->data['TskTeamAssign']['users']);
								// save in adv. status table
								$this->TskAssignRead->id = '';
								$this->TskAssignRead->create();
								$data = array('tsk_assign_id' => $id, 'created_date' => $this->Functions->get_current_date(), 'app_users_id' => $this->request->data['TskTeamAssign']['users'], 'action_type' => 'M');
								// save unread status of user
								if($this->TskAssignRead->save($data, true, $fieldList = array('tsk_assign_id','created_date','app_users_id','action_type'))){
									// set unread for cc users
									$this->save_unread_status($id, 'edit');
									// show the msg.
									$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Task modified successfully', 'default', array('class' => 'alert alert-success'));
								}else{
									// show the error msg.
									$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in saving unread status...', 'default', array('class' => 'alert alert-error'));												
								}
							}else{
								// show the error msg.
								$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in assigning user...', 'default', array('class' => 'alert alert-error'));					
							}
						}else{
							// show the error msg.
							$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in saving the data...', 'default', array('class' => 'alert alert-error'));					
						}					
						$this->redirect('/tskteamassign/?type='.$this->request->data['TskTeamAssign']['type'].'&date='.$this->Functions->get_task_date($this->request->data['TskTeamAssign']['start']));							
					}	
				}else{
					$this->request->data = $this->TskTeamAssign->findById($id, array('fields' => 'id','type','title','desc','attachment','start','end','tsk_projects_id','tsk_company_id','tsk_plan_types_id','status'));
					$this->load_project_data();

					// if status is not pending
					if($this->request->data['TskTeamAssign']['status'] != 'W'){
						$this->redirect('/tskteamassign/');
					}
					$this->request->data['TskTeamAssign']['plan_date'] = $this->Functions->format_tsk_date($this->request->data['TskTeamAssign']['start']);
					// if daily task
					if($this->request->data['TskTeamAssign']['type'] == 'D'){
						$this->request->data['TskTeamAssign']['start_time'] = $this->Functions->show_task_time($this->request->data['TskTeamAssign']['start'], $this->request->data['TskTeamAssign']['type']);
						$this->request->data['TskTeamAssign']['end_time'] = $this->Functions->show_task_time($this->request->data['TskTeamAssign']['end'], $this->request->data['TskTeamAssign']['type']);
					}else{
						$this->request->data['TskTeamAssign']['start_date'] = $this->Functions->format_tsk_date($this->request->data['TskTeamAssign']['start']);
						$this->request->data['TskTeamAssign']['end_date'] = $this->Functions->format_tsk_date($this->request->data['TskTeamAssign']['end']);
					}
					// get assigned user
					$this->loadModel('TskAssignUser');
					$assign_user = $this->TskAssignUser->find('all', array('fields' => array('app_users_id','is_cc'), 'conditions' => array('tsk_assign_id' => $id)));
					foreach($assign_user as $assign){
						if($assign['TskAssignUser']['is_cc'] == '0'){
							$user[] = $assign['TskAssignUser']['app_users_id'];
						}else{
							$cc[] = $assign['TskAssignUser']['app_users_id'];
						}
					}
					$this->set('cc', $cc);
					$this->set('users', $user);
					
				}
			}else if($ret_value == 'fail'){
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/tskteamassign/');
			}else{
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Record Deleted: '.$ret_value , 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/tskteamassign/');
			}
		}else{
			// show the error msg.
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));
			$this->redirect('/tskteamassign/');		
		}		
		
	}
	
	/* function to download the file */
	public function download_task_file($file){		
		$this->download_file(WWW_ROOT.'/uploads/task/'.$file);
		die;
		
	}
	
	/* function to remove the exp. list */
	public function remove_assign_users($id){		
		$this->TskAssignUser->deleteAll(array('tsk_assign_id' => $id), false);
	}
	
	/* function to remove the exp. list */
	public function remove_unread_status($id){		
		$this->TskAssignRead->deleteAll(array('tsk_assign_id' => $id), false);
	}
	
	
	
	/* function to view the task */
	public function view_task($id){
		$this->layout = 'tsk_iframe';
		// set the page title		
		$this->set('title_for_layout', 'View Task - Work Planner - My PDCA');
		if(!empty($id) && intval($id)){
			// authorize user before action
			$ret_value = $this->auth_action($id);
			if($ret_value == 'pass'){	
				$this->create_url_var('TskTeamAssign');
				$options = array(		
					array('table' => 'tsk_assign_users',
						'alias' => 'TskAssignUser',					
						'type' => 'LEFT',
						'conditions' => array('`TskAssignUser`.`tsk_assign_id` = `TskTeamAssign``.`id`', 'TskAssignUser.is_cc' => '0')
					),
					array('table' => 'app_users',
						'alias' => 'TskEmpAssign',					
						'type' => 'LEFT',
						'conditions' => array('`TskAssignUser`.`app_users_id` = `TskEmpAssign``.`id`')
					)
				);
				$data = $this->TskTeamAssign->find('all', array('conditions' => array('TskTeamAssign.id' => $id), 'fields' => array('id','TskEmpAssign.first_name','status','type','remark','TskProject.project_name','TskCustomer.company_name','HrEmployee.first_name',
				'start','end','title','desc','TskPlanType.title','attachment','TskTeamAssign.modified_date','TskAssignStatus.status', 'TskAssignStatus.created_date','TskAssignStatus.id'), 'joins' => $options));
				$this->set('tsk_data', $data[0]);
				// get task replies
				$this->loadModel('TskAssignReply');
				$this->get_task_reply($id);	
				// get task assigned task
				$this->loadModel('TskAssignUser');
				$this->TskAssignUser->bindModel(
					array('belongsTo' => array(
							'HrEmployee' => array(
								'className' => 'HrEmployee',
								 'foreignKey' => 'app_users_id'							
							)
						)
					)
				);
				$data = $this->TskAssignUser->find('all', array('fields' => array('HrEmployee.first_name', 'HrEmployee.last_name','TskAssignUser.is_cc'), 'conditions' => array('tsk_assign_id' => $id), 'order' => array('is_cc' => 'asc')));
				$this->set('assign_data', $data);
				// when the task updated
				if(strstr($this->referer(), 'view_task') != ''){
					//$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Task status updated successfully', 'default', array('class' => 'alert alert-success'));
				}
			}else if($ret_value == 'fail'){ 
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/tskteamassign/');	
			}else{
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Record Deleted: '.$ret_value , 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/tskteamassign/');	
			}
		}else{
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));		
			$this->redirect('/tskteamassign/');	
		}
		$this->render('/Elements/task/view_task');	
						
	}
	
	/* function to save the reply */
	public function reply_task(){
		$this->layout = 'ajax';		
		if ($this->request->is('post') && $this->request->data['reply'] != '') { 
			$data = array('tsk_assign_id' => $this->request->query['id'], 'desc' => trim($this->request->data['reply']), 'created_date' => $this->Functions->get_current_date(), 'app_users_id' => $this->Session->read('USER.Login.id'));		
			$this->loadModel('TskAssignReply');			
			// update the todo
			if($this->TskAssignReply->save($data, true, $fieldList = array('tsk_assign_id', 'desc','created_date','app_users_id'))){			
				$this->get_task_reply($this->request->query['id']);
				// update unread status
				$this->loadModel('TskAssignRead');
				$this->TskAssignRead->updateAll(array('status' => "'U'",'action_type' => "'R'", 'modified_date' => '"'.$this->Functions->get_current_date().'"'), array('tsk_assign_id' => $this->request->query['id']));
			}
		}
		$this->render('/Elements/task/reply_task');	
	}
	
	/* function to auth record */
	public function auth_action($id){  
		$data = $this->TskTeamAssign->findById($id, array('fields' => 'app_users_id','is_deleted','modified_date'));	
		// check the req belongs to the user
		if($data['TskTeamAssign']['is_deleted'] == 'Y'){
			return $data['TskTeamAssign']['modified_date'];
		}else if($data['TskTeamAssign']['app_users_id'] == $this->Session->read('USER.Login.id')){	
			return 'pass';
		}else{
			return 'fail';
		}
	}
	
	/* get the reply of tasks */
	public function get_task_reply($id){
		$data = $this->TskAssignReply->find('all', array('conditions' => array('tsk_assign_id' => $id), 'fields' => array('desc','created_date', 'HrEmployee.first_name'),
		'order' => array('created_date' => 'desc')));
		$this->set('reply_data', $data);
	}
	
	
	/* function to update the task plan status */
	public function change_task_status($id){
		$this->layout = 'tsk_iframe';
		$this->set('planStatus', $this->Functions->get_plan_status('assign_change'));	
		$data = $this->TskTeamAssign->findById($id, array('fields' => 'id','start','title','status','tsk_company_id','tsk_projects_id'));		
		$this->set('tsk_data', $data);
		if (!empty($id) && intval($id)){
			// authorize user before action
			$ret_value = $this->auth_action($id);
			if($ret_value == 'pass'){
				$this->loadModel('TskAssignUser');
				// get assigned user
				$assign_data = $this->TskAssignUser->find('all', array('conditions' => array('tsk_assign_id' => $id, 'is_cc' => '0'), 'fields' => array('app_users_id')));						
				$this->set('assign_data', $assign_data[0]);
				if (!empty($this->request->data)){ 					
					// validates the form
					$this->TskTeamAssign->set($this->request->data);	
					if ($this->TskTeamAssign->validates(array('fieldList' => $this->get_validation_change_status()))) {
						$this->request->data['TskTeamAssign']['id'] = $id;
						$this->request->data['TskTeamAssign']['modified_date'] = $this->Functions->get_current_date();
						// assign fields
						$this->task_remark_fields($this->request->data['TskTeamAssign']['status']);
						// update the status
						if($this->TskTeamAssign->save($this->request->data['TskTeamAssign'], array('validate' => false), $fieldList = $this->get_save_change_status())){
							$assign_user = $this->TskAssignUser->find('all', array('conditions' => array('tsk_assign_id' => $id), 'fields' => array('app_users_id','is_cc')));
							$this->loadModel('TskAssignRead');
							// update unread status
							foreach($assign_user as $user){
								// save unread status of user
								$this->TskAssignRead->updateAll(array('status' => "'U'",'action_type' => "'M'", 'modified_date' => '"'.$this->Functions->get_current_date().'"'), array('tsk_assign_id' => $id, 'app_users_id' => $user['TskAssignUser']['app_users_id']));
							}
							// check task partial							
							$this->check_task_status($id, $this->request->data['TskTeamAssign']['status'], $assign_user);								
							// show the msg.
							if($this->request->query['page'] != 'list'){
								$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Task status updated successfully', 'default', array('class' => 'alert alert-success'));				
								$this->set('page_reload', 1);
								$this->set('save_success', 1);
								echo "<script>window.parent.location.reload()</script>";
							}else{	
								$this->set('page_reload', 1);
								$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Task status updated successfully', 'default', array('class' => 'alert alert-success'));				
							}					
						}else{
							$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Problem in saving task status', 'default', array('class' => 'alert alert-info'));
						}
					}else{
						//print_r($this->TskTeamAssign->validationErrors);
					}
				}else{
					
				}
			}
		}
		$this->render('/Elements/task/change_task_status/');

	}
	
	/* function to update the task plan status */
	public function confirm_task($id, $status){ 
		$ret_value = $this->auth_action($id);
		// make sure valid user
		if($ret_value == 'pass'){	
			$data = array('tsk_assign_id'=> $id, 'created_date' => $this->Functions->get_current_date(),'app_users_id' => $this->Session->read('USER.Login.id'), 'reason' => $this->request->query['remark'], 'status' => $status);
			$st_msg = $status == 'A' ? 'closed' : 'reopened';
			// save the finance adv. status
			if($this->TskTeamAssign->TskAssignStatus->save($data, true, $fieldList = array('tsk_assign_id','created_date','reason','status','app_users_id'))){		
				// update recent status
				$this->TskTeamAssign->TskAssignStatus->updateAll(array('is_recent' => "'0'"), array('tsk_assign_id' => $id, 'id !=' =>$this->TskTeamAssign->TskAssignStatus->id));					
				// if rejected, update task  & read status
				if($status == 'R'){
					// update task status
					$this->TskTeamAssign->id = $id;
					$this->TskTeamAssign->saveField('status', 'W');
					// get assigned users
					$this->loadModel('TskAssignUser');
					$assign_user = $this->TskAssignUser->find('all', array('conditions' => array('tsk_assign_id' => $id), 'fields' => array('app_users_id','is_cc')));
					$this->loadModel('TskAssignRead');
					// update unread status
					foreach($assign_user as $user){
						// save unread status of user
						$this->TskAssignRead->updateAll(array('status' => "'U'",'action_type' => "'M'", 'modified_date' => '"'.$this->Functions->get_current_date().'"'), array('tsk_assign_id' => $id, 'app_users_id' => $user['TskAssignUser']['app_users_id']));
					}
				}
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Task is '.$st_msg.' successfully', 'default', array('class' => 'alert alert-success'));
			}else{
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Problem in updating the status', 'default', array('class' => 'alert alert-error'));		
			}
		}else{
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));		
		}
		$this->redirect('/tskteamassign/view_task/'.$id);	
	}
					
					
	
		/* function to run the ajax call */
	public function show_task(){
		$this->layout = 'refresh'; 
		// check date conditions
		if(!empty($this->request->data['task_month'])){
			$date_str = $this->request->data['task_month'];
		}else{
			$day = explode('-', $this->request->data['date']);
			$date = $day[2] < 10 ? '0'.$day[2] : $day[2];
			$date_str = $day[0].'-'.$day[1].'-'.$date;
		}
		
		
		if(!empty($date_str)){
			$dateCond = array('start like' => $date_str.'%');
		}
		
		
		
		// plan type condition
		if($this->request->data['type'] == 'D'){
			$typeCond = array('TskTeamAssign.type' => 'D'); 
		}else if($this->request->data['type'] == 'P'){
			$typeCond = array('TskTeamAssign.type' => 'P'); 
		}
		$empCond = array('TskAssignUser.is_cc' => '0'); 
		
		/*$this->TskTeamAssign->bindModel(
					array('hasOne' => array(
							'TskAssignUser' => array(
								'className' => 'TskAssignUser',
								 'foreignKey' => 'tsk_assign_id'							
							)
						)
					)
				);
			*/
		$options = array(		
					array('table' => 'tsk_assign_users',
						'alias' => 'TskAssignUser',					
						'type' => 'LEFT',
						'conditions' => array('`TskAssignUser`.`tsk_assign_id` = `TskTeamAssign``.`id`', 'TskAssignUser.is_cc' => '0')
					),
					array('table' => 'app_users',
						'alias' => 'TskEmpAssign',					
						'type' => 'LEFT',
						'conditions' => array('`TskAssignUser`.`app_users_id` = `TskEmpAssign``.`id`')
					)
				);
				
		$data = $this->TskTeamAssign->find('all', array('fields' => array('id','TskEmpAssign.first_name','created_date','title','desc','status','remark','type','start','end','TskPlanType.title', 'TskCustomer.company_name', 'TskProject.project_name','is_tag','TskAssignStatus.created_date','TskTeamAssign.modified_date','TskAssignStatus.status','TskAssignStatus.id','HrEmployee.first_name'),
		'conditions' => array($statusCond,$typeCond,$compCond,$dateCond,$empCond,'TskTeamAssign.app_users_id' => $this->Session->read('USER.Login.id'),'TskTeamAssign.is_deleted' => 'N'), 'order' => array('TskTeamAssign.start' => 'asc'),	'group' => array('TskTeamAssign.id','TskAssignStatus.id'), 'joins' => $options));
		$this->set('data', $data);
		
		
		$this->render('/Elements/task/show_task/');
	}
	
		/* check for task postpone */
	public function check_task_status($id, $st,$assign_user){ 
		if( $st == 'P'){
			// fetch task plan details
			$data = $this->TskTeamAssign->findById($id, array('fields' => 'id','type','tsk_projects_id','tsk_company_id','start','end','title','desc','tsk_plan_types_id'));		
			$this->request->data['TskTeamAssign']['plan_date'] = $this->request->data['TskTeamAssign']['postpone_date'];			
			$this->request->data['TskTeamAssign']['type'] = $data['TskTeamAssign']['type'];			
			$this->request->data['TskTeamAssign']['start'] = $this->set_task_timing($this->request->data['TskTeamAssign']['post_from']);			
			$this->request->data['TskTeamAssign']['end'] = 	$this->set_task_timing($this->request->data['TskTeamAssign']['post_end']);
			$this->request->data['TskTeamAssign']['title'] = $data['TskTeamAssign']['title'];
			$this->request->data['TskTeamAssign']['desc'] = $data['TskTeamAssign']['desc'];
			$this->request->data['TskTeamAssign']['tsk_plan_types_id'] = $data['TskTeamAssign']['tsk_plan_types_id'];
			$this->request->data['TskTeamAssign']['created_date'] = $this->Functions->get_current_date();
			$this->request->data['TskTeamAssign']['modified_date'] =  '';
			$this->request->data['TskTeamAssign']['app_users_id'] = $this->Session->read('USER.Login.id');
			$this->request->data['TskTeamAssign']['copy_id'] = $data['TskTeamAssign']['id'];			
			if($data['TskTeamAssign']['type'] == 'P'){
				$this->request->data['TskTeamAssign']['tsk_projects_id'] = $data['TskTeamAssign']['tsk_projects_id'];
				$this->request->data['TskTeamAssign']['tsk_company_id'] = $data['TskTeamAssign']['tsk_company_id'];
			}
			$this->request->data['TskTeamAssign']['status'] = 'W';
			$this->request->data['TskTeamAssign']['remark'] = '';
			// save the task
			$this->request->data['TskTeamAssign']['id'] = '';
			if($this->TskTeamAssign->save($this->request->data['TskTeamAssign'], array('validate' => false))){				
				// restore the plan status
				$this->request->data['TskTeamAssign']['status'] = $st;
				// unread status to old task
				$this->TskAssignRead->updateAll(array('status' => "'U'",'action_type' => "'M'", 'modified_date' => '"'.$this->Functions->get_current_date().'"'), array('tsk_assign_id' => $id));
				// update unread status if postpone
				foreach($assign_user as $user){					
					// assign task to user
					$data = array('tsk_assign_id' => $this->TskTeamAssign->id, 'is_cc' => $user['TskAssignUser']['is_cc'], 'app_users_id' => $user['TskAssignUser']['app_users_id']);
					// save in  table
					$this->TskAssignUser->id = '';
					$this->TskAssignUser->create();
					if($this->TskAssignUser->save($data, true, $fieldList = array('tsk_assign_id','is_cc','app_users_id'))){					
						// check duplicate status
						$this->check_duplicate_status($this->TskTeamAssign->id, $user['TskAssignUser']['app_users_id']);
						// save unread status
						$this->TskAssignRead->id = '';
						$this->TskAssignRead->create();						
						$data = array('status' => $read_st, 'tsk_assign_id' => $this->TskTeamAssign->id, 'created_date' => $this->Functions->get_current_date(), 'app_users_id' => $user['TskAssignUser']['app_users_id']);
						// save unread status of user
						if($this->TskAssignRead->save($data, true, $fieldList = array('tsk_assign_id','created_date','app_users_id','action_type'))){
							
						}else{
							$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in saving unread status', 'default', array('class' => 'alert alert-error'));							
						}
					}else{
						$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in assigning user', 'default', array('class' => 'alert alert-error'));							
					}
				}
			}else{ 
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in saving task details', 'default', array('class' => 'alert alert-error'));							

			}
			
				
		}
	}
	
	/* function to show comment */
	public function show_comment($id, $status){
		$this->layout = 'tsk_iframe';
		if(!empty($id) && intval($id)){
			// authorize user before action
			$ret_value = $this->auth_action($id);
			if($ret_value == 'pass'){	
				// if executed or cancelled status
				$data = $this->TskTeamAssign->find('all', array('fields' => array('TskTeamAssign.remark'), 'conditions' => array('TskTeamAssign.id' => $id, 'TskTeamAssign.is_deleted' => 'N'), 'limit' => 1));		
				if($status == 'C' || $status == 'P'){
					$remark_f = 'Reason: ';
				}else{
					$remark_f =  'Comment: ';
				}
				// for postponed or partial status					
				if($status == 'P' || $status == 'L'){ 	
					$data_new = $this->TskTeamAssign->find('all', array('fields' => array('TskTeamAssign.start'), 'conditions' => array('TskTeamAssign.copy_id' => $id, 'TskTeamAssign.is_deleted' => 'N'), 'limit' => 1));	
					$date_f = $status == 'P' ? 'Task Postponed To: ' : 'Remaining Task Completion Date: ';	
					$this->set('date_field', $date_f);
					$this->set('date_data', $this->Functions->format_date($data_new[0]['TskTeamAssign']['start']));								
				}
				$this->set('remark_field', $remark_f);
				$this->set('remark_data', $data[0]['TskTeamAssign']['remark']);
			}
		}
		$this->render('/Elements/task/show_comment');
	}
	
	
	/* function to show leader comment */
	public function show_lead_comment($id){
		$this->layout = 'tsk_iframe';
		if(!empty($id) && intval($id)){
			// authorize user before action
			$ret_value = $this->auth_action($id);
			if($ret_value == 'pass'){	
				// if executed or cancelled status
				$data = $this->TskTeamAssign->TskAssignStatus->findById($id, array('fields' => 'reason'));	
				$this->set('data', $data);				
			}
		}
		$this->render('/Elements/task/show_lead_comment');
	}
	
	
	/* function to show the validation fields */
	public function get_validation_change_status(){
		switch($this->request->data['TskTeamAssign']['status']){			
			case 'P':
			$valid_arr = $this->request->data['TskTeamAssign']['plan_type'] == 'D' ? array('status', 'postpone_date', 'reason') : array('status', 'post_from', 'reason');
			break;			
			case 'C':
			$valid_arr =  array('status', 'reason');		
			break;
			default:
			$valid_arr =  array('status');		
			break;
		}
		
		return $valid_arr;
	}
	
	/* function to show the validation fields */
	public function get_save_change_status(){
		switch($this->request->data['TskTeamAssign']['status']){			
			case 'P':
			$this->request->data['TskTeamAssign']['remark'] = $this->request->data['TskTeamAssign']['reason'];
			//$this->request->data['TskTeamAssign']['postpone_from'] = $this->Functions->format_date_save($this->request->data['TskTeamAssign']['postpone_from2']);
			$save_arr =  array('status', 'postpone_date', 'date_from', 'date_to', 'remark','modified_date');		
			break;			
			case 'C':
			$this->request->data['TskTeamAssign']['remark'] = $this->request->data['TskTeamAssign']['comment'];
			$save_arr =  array('status', 'remark','modified_date');		
			break;			
		}
		
		return $save_arr;
	}
	
		/* function to update the read status */
	public function update_read_status(){
		$this->layout = 'ajax';				
		if(!empty($this->request->data['date'])){
			if($this->TskTeamAssign->updateAll(array('read_status' => "'R'"), array('TskTeamAssign.app_users_id' => $this->Session->read('USER.Login.id'),'TskTeamAssign.type' => $this->request->data['tsk_type'], 'TskTeamAssign.start like' => $this->request->data['date'].'%'))){					
				echo $this->TskTeamAssign->getAffectedRows();
			}		
		}
		$this->render(false);
		die;
	}
	
			/* function to update the read status of individual. task */
	public function update_imp_task(){
		$this->layout = 'ajax';	
		// make sure its not empty
		if(!empty($this->request->data['id'])){
			$tag = ($this->request->data['tag'] == '0') ? '1' : '0';
			$this->TskTeamAssign->id = $this->request->data['id'];
			if($this->TskTeamAssign->saveField('is_tag', $tag)){				
				echo $this->request->data['id'];			
			}
			
		}	
	
		$this->render(false);
		die;
	}
	
	
	/* function to load the plan types */
	public function load_plan_types(){
		$cond = array('OR' => array(array( 'hr_business_unit_id' => null), array( 'hr_business_unit_id' => $this->Session->read('USER.Login.hr_business_unit_id')) ) );
		return $plan_types = $this->TskTeamAssign->TskPlanType->find('list', array('fields' => array('id','title'),
		'order' => array('title ASC'),'conditions' => array('is_deleted' => 'N', 'status' => '1',$cond)));
	}
	
	/* clear the cache */
	
	public function beforeFilter() { 
		//$this->disable_cache();
		$this->set('model_cls', 'TskTeamAssign'); 
		$this->set('model_url', 'tskteamassign');
		$this->show_tabs(62);
		
	}
	

	
	
}