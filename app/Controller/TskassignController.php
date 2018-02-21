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
class TskassignController extends AppController {  
	
	public $name = 'TskAssign';	
	
	public $helpers = array('Html', 'Form', 'Session');
	
	public $components = array('Session', 'Functions');
	
	public $layout = 'apps';	

	/* function to list the tsk plan requests */
	public function index(){	
		// set the page title
		$this->set('title_for_layout', 'Assigned to Me - Work Planner - My PDCA');
		$this->set('planStatus', $this->Functions->get_plan_status($this->request->params['action']));		
		$this->load_company_data();	
		$this->load_project_data();
		// get team list
		$this->get_team();
		$this->set('taskType', array('D' => 'Daily Task', 'P' => 'Project Task'));
		// when the form is submitted for search
		if($this->request->is('post')){
			$url_vars = $this->Functions->create_url(array('type','company','project','month_year','plan_status'),'TskAssign'); 
			$this->redirect('/tskassign/?'.$url_vars);			
		}
		$url_vars = $this->Functions->create_redirect_url(array('type','company','project','month_year','plan_status'),'TskAssign');
		$this->set('URL_VAR', $url_vars);
		
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
				$default_start = $rec['TskAssign']['start'];
				// print json
				$this->print_json($rec, $default_start);				
				// check task more than one day for project task plan
				if($rec['TskAssign']['type'] == 'P'){
					$diff = $this->TskAssign->diff_date(date('Y-m-d', strtotime($rec['TskAssign']['start'])), date('Y-m-d', strtotime($rec['TskAssign']['end'])));
					while($diff >= 1){						
						$rec['TskAssign']['start'] = date('Y-m-d', strtotime( $rec['TskAssign']['start']. '+1 days'));
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
	}
	
	/* function to show comment */
	public function show_comment($id, $status){
		$this->layout = 'tsk_iframe';
		if(!empty($id) && intval($id)){
			// authorize user before action
			$ret_value = $this->auth_action($id);
			if($ret_value == 'pass'){	
				// if executed or cancelled status
				$data = $this->TskAssign->find('all', array('fields' => array('TskAssign.remark'), 'conditions' => array('TskAssign.id' => $id, 'TskAssign.is_deleted' => 'N'), 'limit' => 1));		
				if($status == 'C' || $status == 'P'){
					$remark_f = 'Reason: ';
				}else{
					$remark_f =  'Comment: ';
				}
				// for postponed or partial status					
				if($status == 'P' || $status == 'L'){ 	
					$data_new = $this->TskAssign->find('all', array('fields' => array('TskAssign.start'), 'conditions' => array('TskAssign.copy_id' => $id, 'TskAssign.is_deleted' => 'N'), 'limit' => 1));	
					$date_f = $status == 'P' ? 'Task Postponed To: ' : 'Remaining Task Completion Date: ';	
					$this->set('date_field', $date_f);
					$this->set('date_data', $this->Functions->format_date($data_new[0]['TskAssign']['start']));								
				}
				$this->set('remark_field', $remark_f);
				$this->set('remark_data', $data[0]['TskAssign']['remark']);
			}
		}
		$this->render('/Elements/task/show_comment');
	}
	
	/* function to show leader comment */
	public function show_lead_comment($id){
		$this->layout = 'tsk_iframe';
		if(!empty($id) && intval($id)){
			// authorize user before action
			
			//if($ret_value == 'pass'){	
				// if executed or cancelled status
				$data = $this->TskAssign->TskAssignStatus->findById($id, array('fields' => 'reason'));	
				$this->set('data', $data);				
			//}
		}
		$this->render('/Elements/task/show_lead_comment');
	}
	
	
	/* function to update the read status */
	public function update_read_status(){
		$this->layout = 'ajax';	
		// get the team tasks
		$data = $this->get_my_tasks($this->request->data['date']);		
		if($this->TskAssign->updateAll(array('TskAssignRead.status' => "'R'"), array('TskAssignRead.app_users_id' => $this->Session->read('USER.Login.id'), 'TskAssign.type' => $this->request->data['tsk_type'], 'TskAssign.start like' => $this->request->data['date'].'%'))){					
			echo $this->TskAssign->getAffectedRows();
		}				
		$this->render(false);
		die;
	}
	
	/* functions to get project members */
	public function get_project_member(){
		$this->layout = 'refresh';		
		$id = $this->request->query['id'];
		$this->loadModel('TskProjectMember');
		$this->TskProjectMember->virtualFields = array('full_name' => "UPPER(CONCAT_WS(' ', trim(HrEmployee.first_name), trim(HrEmployee.last_name)))");
		$data = $this->TskProjectMember->find('all', array('fields' => array('app_users_id','full_name'), 'conditions' => array('tsk_projects_id' => $id), 'order' => array('full_name' => 'asc')));		
		$options .= "<option value=''>Select</option>";		
		foreach($data as $member){ 			
			$options .= "<option value=".$member['TskProjectMember']['app_users_id'].">".$member['TskProjectMember']['full_name']."</option>";
		}	
		echo $options;
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
				$url_vars = $this->Functions->create_redirect_url(array('type','company','project','month_year','plan_status'),'TskAssign');
				$desc_limit = $rec['TskAssign']['type'] == 'D' ? 40 : 20;
				
				// for long desc
				$desc_len = strlen($rec['TskAssign']['desc']);
				$more_display = ($desc_len > $desc_limit) ? '' : 'dn';
				$long_desc = ($desc_len > $desc_limit) ? $rec['TskAssign']['desc'] : '';
				$short_desc = $this->Functions->string_truncate($rec['TskAssign']['desc'], $desc_limit);
				// replace new lines
				$short_desc =  $this->Functions->remove_spl_char($short_desc);
				$long_desc =  $this->Functions->remove_spl_char($long_desc);
				
				echo '{ "date": "'; echo date('Y-m-d 23:59:59', strtotime($rec['TskAssign']['start'])); echo '" ,
				"title": "<a href='; echo $this->webroot.'tskassign/view_task/'.$rec['TskAssign']['id'].'/?'.trim($url_vars); echo ' class=\" iframeBox cboxElement tsk_title\" val=90_90>'; echo $this->Functions->string_truncate($rec['TskAssign']['title'], 20); echo '</a>'; echo $this->Functions->check_task_cc($rec['TskAssignUser']['is_cc']); echo '",
				"start_time": "'; echo $this->check_plan_type($default_start, $rec['TskAssign']['type']); echo '",
				"end_time": "'; echo $this->check_plan_type($rec['TskAssign']['end'], $rec['TskAssign']['type']); echo '",
				"description": "<i data-placement=top id='; echo 'tag-'.$rec['TskAssign']['id']; echo ' val='; echo $rec['TskAssign']['id'].'-'.$rec['TskAssignRead']['is_tag']; echo ' rel=tooltip class=\"tsk_tip '; echo $this->Functions->show_read_class($rec['TskAssignRead']['is_tag']); echo ' cursor icon-circle \" title=\"'; echo $this->Functions->show_read_text($rec['TskAssignRead']['is_tag']); echo '\"></i><span class=desc_less> '; 
				echo $short_desc;
				echo '</span>'. 
				' <span class=\" desc_more dn \"> '; 
				echo $long_desc; echo '</span><a class=\" tsk_more '; echo $more_display; echo '\" href=javascript:void(0); style=color:#EF7575>more</a> <a class=\" tsk_less dn \" href=javascript:void(0); style=color:#EF7575>less</a>'; echo $this->Functions->check_read_type($rec['TskAssignRead']['read_status'], $rec['TskAssignRead']['read_type']); echo '",
				"status": "<span class=\"label '; echo $this->Functions->show_task_status_color($rec['TskAssign']['status']); echo '\">'; echo $this->Functions->show_task_status($rec['TskAssign']['status']); echo '</span>'; echo $this->show_status_link($rec['TskAssign'], $url_vars, $rec['TskAssignUser']['is_cc']); echo '",
				"plan_action": "'; echo $rec['TskPlanType']['title']; echo '",
				"plan_type": "<span rel=tooltip title=\"'; echo $this->Functions->show_plan_type($rec['TskAssign']['type']); echo '\" class=\"tsk_tip label '; echo $this->Functions->show_task_plan_color($rec['TskAssign']['type']); echo '\">'; echo $rec['TskAssign']['type']; echo '</span>",
				"user" : "'; echo $rec['TskEmpAssign']['first_name']; echo '","read_status": "'; echo $rec['TskAssignRead']['read_status']; echo '","plan_date": "'; echo $this->Functions->format_date($default_start); echo '",
				"project" : "'; echo $rec['TskProject']['project_name']; echo '","company" : "'; echo $rec['TskCustomer']['company_name']; echo '","rec_id" : "'; echo $rec['TskAssign']['id']; echo '",
				"lead_status": "<span class=\"label '; echo $this->Functions->show_lead_task_status_color($rec['TskAssignStatus']['status'],$rec['TskAssign']['modified_date'],$rec['TskAssignStatus']['created_date']); echo '\">'; echo $this->Functions->show_lead_task_status($rec['TskAssignStatus']['status'],$rec['TskAssign']['modified_date'],$rec['TskAssignStatus']['created_date'],$rec['TskAssign']['status']); echo '</span>';  echo $this->Functions->show_lead_remark($rec['TskAssignStatus']['id'],$rec['TskAssignStatus']['status'],$rec['TskAssign']['modified_date'],$rec['TskAssignStatus']['created_date']);echo '"}';
	}
	

		/* function to show date  / project details */
	public function check_plan_type($date, $type){
		if($type == 'D'){
			$result = $this->Functions->show_task_time($date, $type);
		}else{
			$result = $this->Functions->format_date($date);
		}
		return $result;
	}
	
	/* function to show status link */
	public function show_status_link($data,$url_vars, $is_cc){ 
		$task_date = date('Y-m-d', strtotime($data['start']));
		if($data['status'] == 'W' && $is_cc != '1'){
			return $link = " <a href='".$this->webroot.'tskassign/change_task_status/'.$data['id'].'/?'.$url_vars.'&page=list'."' title='Change Status' rel='tooltip' val='42_75'  class = 'tsk_tip iframeBox cboxElement tsk_title'><i class=icon-edit></i></a>";
		}else if($data['status'] != 'W'){
			return $link = "<a href='javascript:void(0)' rel='tooltip'  st='".$data['status']."'  val='".$data['id']."' id='tk_".$data['id']."' title='View Comment' class = 'commentTsk'><i class=icon-comment-alt></i></a>";
		}
	}
	
	/* function to get the comments */
	public function get_comments($data){
		$this->layout = 'ajax';	
		// check for id
		if(!empty($this->request->data['id'])){
			// if executed or cancelled status
			$status = $this->request->data['status'];
			if($status == 'P' || $status == 'L'){ 
				$data_new = $this->TskAssign->find('all', array('fields' => array('TskAssign.start'), 'conditions' => array('TskAssign.copy_id' => $this->request->data['id'], 'TskAssign.is_deleted' => 'N'), 'limit' => 1));	
				$remark_d = $status == 'P' ? 'Postponed: ' : 'Remaining: ';	
				// print date
				echo $comment = '<strong>'.$remark_d.'</strong>'.$this->Functions->format_date($data_new[0]['TskAssign']['start']).'<br>';				
			}
			if($status == 'C' || $status == 'P'){
				$remark_f = 'Reason: ';
			}else{
				$remark_f =  'Comment: ';
			}				
			$data = $this->TskAssign->find('all', array('fields' => array('TskAssign.remark'), 'conditions' => array('TskAssign.id' => $this->request->data['id'], 'TskAssign.is_deleted' => 'N'), 'limit' => 1));		
			$remark_f = $this->request->data['status'] == 'C' ? 'Reason: ' : 'Comment: ';
			echo $comment = '<strong>'.$remark_f.'</strong>'.$data[0]['TskAssign']['remark'];			
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
			$data = $this->TskAssign->TskAssignStatus->findById($this->request->data['id'], array('fields' => 'reason'));		
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
		
		
		$typeCond = array('TskAssign.type' => $plan_type); 
		
		// for company conditions
		if(!empty($this->request->query['company'])){
			$compCond = array('TskAssign.tsk_company_id' => $this->request->query['company']); 
		}
		// for project condition
		if(!empty($this->request->query['project'])){
			$projCond = array('TskAssign.tsk_projects_id' => $this->request->query['project']); 
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
			$statusCond = array('TskAssign.status' => $this->request->query['plan_status']); 
		}
		// read status condition		
		$fields = array('id','created_date','title','desc','status','remark','type','start','end','TskPlanType.title', 'TskCustomer.company_name', 'TskProject.project_name', 'TskAssignRead.status as read_status', 'TskAssignRead.action_type as read_type','TskAssignUser.is_cc', 'TskAssignRead.is_tag','TskAssignStatus.id','TskAssignStatus.status','TskAssign.modified_date','TskAssignStatus.created_date');
		
		// fetch the task plans		
		$data = $this->TskAssign->find('all', array('fields' => $fields,'conditions' => array($statusCond,$typeCond,$compCond,$projCond,$dateCond,  'TskAssignRead.app_users_id' =>  $this->Session->read('USER.Login.id'), 'TskAssignUser.app_users_id' =>  $this->Session->read('USER.Login.id'),'TskAssign.is_deleted' => 'N'), 'order' => array('TskAssign.start' => 'asc'),	'group' => array('TskAssign.id')));
		return $data;
	
	}
	

	
		/* function to load static data */
	public function load_company_data(){
		// fetch the companies
		$comp_list = $this->TskAssign->TskCustomer->find('list', array('fields' => array('id','company_name'), 'order' => array('company_name ASC'),'conditions' => array('is_deleted' => 'N', 'status' => '1')));
		$this->set('compList', $comp_list);
	}
	
	public function load_project_data(){
		// fetch the projects	
		if($this->request->params['action'] == 'edit_task' || !empty($this->request->data['TskAssign']['tsk_company_id'])){
			$comp_cond = array('tsk_company_id' => $this->request->data['TskAssign']['tsk_company_id']);
		}else if(!empty($this->request->query['company'])){
			$comp_cond = array('tsk_company_id' => $this->request->query['company']);
		}
		// if company selected
		if(!empty($comp_cond)){
			$this->TskAssign->TskProject->bindModel(
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
			$proj_list = $this->TskAssign->TskProject->find('all', array('fields' => array('TskProject.id','project_name'), 'order' => array('project_name ASC'),'conditions' => array('TskProject.is_deleted' => 'N', $comp_cond,$proj_cond)));
			$data2 = $this->Functions->format_dropdown($proj_list, 'TskProject', 'id', 'project_name');
			$this->set('projList', $data2);
		}
	}
	
	
	public function get_team(){
		$emp_list = $this->TskAssign->get_team($this->Session->read('USER.Login.id'),'T');
		$format_list = $this->Functions->format_dropdown($emp_list, 'u','id','first_name', 'last_name');		
		$this->set('empList', $format_list);
	}
	
	
	/* function to show task status */
	public function get_plan_status(){
		return $status = array( 'P' => 'Pending', 'U' => 'Unread', 'C' => 'Executed');
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
				$this->TskAssign->bindModel(
					array('belongsTo' => array(
							'HrEmployee' => array(
								'className' => 'HrEmployee',
								 'foreignKey' => 'app_users_id'							
							)
						)
					)
				);
				$data = $this->TskAssign->find('all', array('fields' => array('id','status','type','remark','TskProject.project_name','TskCustomer.company_name', 'HrEmployee.first_name','HrEmployee.last_name',
				'start','end','title','desc','TskPlanType.title','TskAssignUser.is_cc','TskAssignStatus.status','TskAssignStatus.created_date','TskAssign.modified_date','TskAssignStatus.id'), 'conditions' => array('TskAssign.id' => $id, 'TskAssignUser.app_users_id' => $this->Session->read('USER.Login.id'))));
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
					$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Task status updated successfully', 'default', array('class' => 'alert alert-success'));
				}
			}else if($ret_value == 'fail'){ 
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/tskassign/');	
			}else{
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Record Deleted: '.$ret_value , 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/tskassign/');	
			}
		}else{
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));		
			$this->redirect('/tskassign/');	
		}
		$this->render('/Elements/task/view_task');	

		
	}
	
	/* get the reply of tasks */
	public function get_task_reply($id){
		$data = $this->TskAssignReply->find('all', array('conditions' => array('tsk_assign_id' => $id), 'fields' => array('desc','created_date', 'HrEmployee.first_name'),
		'order' => array('created_date' => 'desc')));
		$this->set('reply_data', $data);
	}
	
	/* function to strip the unwanted chars */
	public function strip_var($url_data){
		return trim(substr($url_data, 0, strlen($url_data)-9));
	}	

	/* function to save the todo item */
	public function reply_task(){
		$this->layout = 'ajax';		
		if ($this->request->is('post') && $this->request->data['reply'] != '') { 
			$data = array('tsk_assign_id' => $this->request->query['id'], 'desc' => trim($this->request->data['reply']), 'created_date' => $this->Functions->get_current_date(), 'app_users_id' => $this->Session->read('USER.Login.id'));		
			$this->loadModel('TskAssignReply');			
			// update the todo
			if($this->TskAssignReply->save($data, true, $fieldList = array('tsk_assign_id', 'desc','created_date','app_users_id'))){			
				$this->get_task_reply($this->request->query['id']);				
				// update unread status
				if($this->TskAssign->updateAll(array('read_status' => "'U'",'read_type' => "'R'",'modified_date' => '"'.$this->Functions->get_current_date().'"'), array('TskAssign.id' => $this->request->query['id']))){
					
				}

			}
		}
		$this->render('/Elements/task/reply_task');	
	}
	
	/* function to update the task plan status */
	public function change_task_status($id){
		$this->layout = 'tsk_iframe';
		$this->set('planStatus', $this->Functions->get_plan_status('user_change_status'));	
		$data = $this->TskAssign->findById($id, array('fields' => 'id','start','title','status','tsk_company_id','tsk_projects_id'));		
		$this->set('tsk_data', $data);
		if (!empty($id) && intval($id)){
			// authorize user before action
			$ret_value = $this->auth_action($id);
			if($ret_value == 'pass'){				
				if (!empty($this->request->data)){ 		
					// validates the form
					$this->TskAssign->set($this->request->data);	
					if ($this->TskAssign->validates(array('fieldList' => $this->get_validation_change_status()))) {
						$this->request->data['TskAssign']['id'] = $id;
						$this->request->data['TskAssign']['modified_date'] = $this->Functions->get_current_date();
						// assign fields
						// assign fields
						$this->task_remark_fields($this->request->data['TskAssign']['status']);
						// update the status
						if($this->TskAssign->save($this->request->data['TskAssign'], array('validate' => false), $fieldList = $this->get_save_change_status())){					
							// save unread status of superior
							$this->TskAssign->updateAll(array('read_status' => "'U'",'read_type' => "'M'",'modified_date' => '"'.$this->Functions->get_current_date().'"'), array('TskAssign.id' => $id));
							// get the superiors
							$approval_data = $this->get_approval_data();
							// update unread status of cc user
							$this->TskAssign->TskAssignRead->updateAll(array('status' => "'U'",'modified_date' => '"'.$this->Functions->get_current_date().'"','action_type' => "'M'"), array('tsk_assign_id' => $id, 'app_users_id !=' => $this->Session->read('USER.Login.id')));
							// check task partial							
							$this->check_task_status($id, $this->request->data['TskAssign']['status'], $approval_data['Approval']['level1']);								
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
						//print_r($this->TskAssign->validationErrors);
					}
				}else{
					
				}
			}
		}
		
		$this->render('/Elements/task/change_task_status/');

	}
	
		/* function to assign the fields to save */
	public function task_remark_fields($st){
		if($st == 'E' || $st == 'L'){
			$this->request->data['TskAssign']['remark'] = $this->request->data['TskAssign']['comment'];
		}else if($st == 'P' || $st == 'C'){
			$this->request->data['TskAssign']['remark'] = $this->request->data['TskAssign']['reason'];			
		}
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
			$typeCond = array('TskAssign.type' => 'D'); 
		}else if($this->request->data['type'] == 'P'){
			$typeCond = array('TskAssign.type' => 'P'); 
		}
		
		$data = $this->TskAssign->find('all', array('fields' => array('id','created_date','title','desc','status','remark','type','start','end','TskPlanType.title', 'TskCustomer.company_name', 'TskProject.project_name','TskAssignRead.is_tag','TskAssignUser.is_cc','TskAssignStatus.id','TskAssignStatus.status','TskAssignStatus.created_date','TskAssign.modified_date'),
		'conditions' => array($statusCond,$typeCond,$compCond,$dateCond, 'TskAssignRead.app_users_id' =>  $this->Session->read('USER.Login.id'), 'TskAssignUser.app_users_id' => $this->Session->read('USER.Login.id'),'TskAssign.is_deleted' => 'N'), 'order' => array('TskAssign.start' => 'asc'),	'group' => array('TskAssign.id','TskAssignStatus.id')));
		$this->set('data', $data);
		
		$this->render('/Elements/task/show_task/');	
	}
	
	/* check for task postpone */
	public function check_task_status($id, $st,$approver){ 
		if($st == 'L'){
			// fetch task plan details
			$data = $this->TskAssign->findById($id, array('fields' => 'id','type','tsk_projects_id','tsk_company_id','start','end','title','desc','tsk_plan_types_id'));
			
			$this->request->data['TskAssign']['plan_date'] = $this->request->data['TskAssign']['task_remaining'];				
			$this->request->data['TskAssign']['type'] = 	$data['TskAssign']['type'];			
			$this->request->data['TskAssign']['start'] = 	$this->set_task_timing($this->request->data['TskAssign']['remain_from']);			
			$this->request->data['TskAssign']['end'] = 	$this->set_task_timing($this->request->data['TskAssign']['remain_end']);
			$this->request->data['TskAssign']['title'] = 	$data['TskAssign']['title'];
			$this->request->data['TskAssign']['desc'] = 	$data['TskAssign']['desc'];
			$this->request->data['TskAssign']['tsk_plan_types_id'] = 	$data['TskAssign']['tsk_plan_types_id'];
			$this->request->data['TskAssign']['created_date'] = 	$this->Functions->get_current_date();
			$this->request->data['TskAssign']['modified_date'] =  '';
			$this->request->data['TskAssign']['app_users_id'] = $approver;
			$this->request->data['TskAssign']['copy_id'] = 	$data['TskAssign']['id'];			
			if($data['TskAssign']['type'] == 'P'){
				$this->request->data['TskAssign']['tsk_projects_id'] = $data['TskAssign']['tsk_projects_id'];
				$this->request->data['TskAssign']['tsk_company_id'] = $data['TskAssign']['tsk_company_id'];
			}
			$this->request->data['TskAssign']['status'] = 'W';
			$this->request->data['TskAssign']['remark'] = '';
			// update read status
			$this->request->data['TskAssign']['read_status'] = 'U';
			$this->request->data['TskAssign']['read_type'] = 'N';
			// save the task
			$this->request->data['TskAssign']['id'] = '';
			if($this->TskAssign->save($this->request->data['TskAssign'], array('validate' => false))){ 
				// get assigned users to reassign
				$data = $this->TskAssign->TskAssignUser->find('all', array('fields' => array('app_users_id','is_cc'), 'conditions' => array('tsk_assign_id' => $id)));
				foreach($data as $user){		
					// check if not the superior
					//if($user['TskAssignUser']['app_users_id'] != $approver){
						$assign_users = array('app_users_id' => $user['TskAssignUser']['app_users_id'], 'tsk_assign_id' => $this->TskAssign->id, 'is_cc' => $user['TskAssignUser']['is_cc']);
						// save in adv. status table
						$this->TskAssign->TskAssignUser->id = '';
						$this->TskAssign->TskAssignUser->create();
						$this->TskAssign->TskAssignUser->save($assign_users, true, $fieldList = array('tsk_assign_id','app_users_id', 'is_cc'));	
					//}
				}
				// save read status of users
				foreach($data as $user){	
					// check if not the employee
					if($user['TskAssignUser']['app_users_id'] == $this->Session->read('USER.Login.id')){
						$read_st = 'R';
					}else{
						$read_st = 'U';
					}
					$read_users = array('app_users_id' => $user['TskAssignUser']['app_users_id'], 'status' => $read_st, 'tsk_assign_id' => $this->TskAssign->id, 'created_date' => $this->Functions->get_current_date());
					// save in adv. status table
					$this->TskAssign->TskAssignRead->id = '';
					$this->TskAssign->TskAssignRead->create();
					$this->TskAssign->TskAssignRead->save($read_users, true, $fieldList = array('tsk_assign_id','app_users_id','created_date','status'));										
				}
				// restore the plan status
				$this->request->data['TskAssign']['status'] = $st;
			}else{ 
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in saving task details', 'default', array('class' => 'alert alert-info'));							

			}			
				
		}
	}
	
		
	/* function to set plan start and end */
	public function set_task_timing($date){
		if($this->request->data['TskAssign']['type'] == 'D'){
			return $this->Functions->format_date_save($this->request->data['TskAssign']['plan_date']).' '.$this->Functions->format_time_save($date);
		}else{
			return $this->Functions->format_date_save($date);
		}
	}
	
	
	/* function to get approval data */
	public function get_approval_data(){
		$this->loadModel('Approval');
		return $approval_data = $this->Approval->find('first', array('fields' => array('level1'), 'conditions'=> array('Approval.app_users_id' => $this->Session->read('USER.Login.id'), 'type' => 'T')));
	}
	
	/* function to show the validation fields */
	public function get_validation_change_status(){
		switch($this->request->data['TskAssign']['status']){
			case 'E':
			$valid_arr =  array('status', 'comment');		
			break;
			case 'L':
			$valid_arr = $this->request->data['TskAssign']['plan_type'] == 'D' ? array('status', 'task_remaining', 'comment') : array('status', 'remain_from', 'comment');
			break;			
			default:
			$valid_arr =  array('status');		
			break;
		}
		
		return $valid_arr;
	}
	
	/* function to show the validation fields */
	public function get_save_change_status(){
		switch($this->request->data['TskAssign']['status']){
			case 'E':
			$this->request->data['TskAssign']['remark'] = $this->request->data['TskAssign']['comment'];
			$save_arr =  array('status', 'remark','modified_date');		
			break;
			case 'L':
			$this->request->data['TskAssign']['remark'] = $this->request->data['TskAssign']['comment'];
			$save_arr =  array('status', 'task_remaining', 'remark','modified_date');		
			break;						
		}
		
		return $save_arr;
	}
	
			/* function to update the read status of individual. task */
	public function update_imp_task(){
		$this->layout = 'ajax';	
		// make sure its not empty
		if(!empty($this->request->data['id'])){
			$this->loadModel('TskAssignRead');
			$tag = ($this->request->data['tag'] == '0') ? '1' : '0';
			if($this->TskAssignRead->updateAll(array('is_tag' => '"'.$tag.'"'), array('tsk_assign_id' => $this->request->data['id'], 'app_users_id' => $this->Session->read('USER.Login.id')))){				
				echo $this->request->data['id'];			
			}			
		}	
		$this->render(false);
		die;
	}
	
	
	
	/* function to auth record */
	public function auth_action($id){
		$data = $this->TskAssign->find('all', array('fields' => array('TskAssignRead.app_users_id','is_deleted','modified_date'), 'conditions' => array('TskAssign.id' => $id,
		 'TskAssignRead.app_users_id' =>  $this->Session->read('USER.Login.id'), 'TskAssignUser.app_users_id' =>  $this->Session->read('USER.Login.id'))
		, 'limit' => 1));	
		// check the req belongs to the user
		if($data[0]['TskAssign']['is_deleted'] == 'Y'){
			return $data[0]['TskAssign']['modified_date'];
		}else if($data[0]['TskAssignRead']['app_users_id'] == $this->Session->read('USER.Login.id')){	
			return 'pass';
		}else{
			return 'fail';
		}
	}
	
	/* function to create a new project */
	public function new_project(){
		$this->layout = 'iframe';
		$this->load_company_data();
		// load team members
		$this->load_employee();
		if ($this->request->is('post')){ 
			$this->loadModel('TskProjectRequest');
			// validates the form
			$this->TskProjectRequest->set($this->request->data);
			if($this->TskProjectRequest->validates(array('fieldList' => array('tsk_company_id','project_name', 'start_date','status','project_leader', 'member')))) {
				$this->request->data['TskProjectRequest']['app_users_id'] = $this->Session->read('USER.Login.id');				
				$this->request->data['TskProjectRequest']['created_date'] = $this->Functions->get_current_date();
				// format the dates to save
				$this->request->data['TskProjectRequest']['start_date'] = $this->Functions->format_date_save($this->request->data['TskProjectRequest']['start_date']);
				// format member data
				$this->request->data['TskProjectRequest']['member'] = $this->format_team_member();
				if(!empty($this->request->data['TskProjectRequest']['target_finish'])){
					$this->request->data['TskProjectRequest']['target_finish'] = $this->Functions->format_date_save($this->request->data['TskProjectRequest']['target_finish']);
				}
				// save project request
				if($this->TskProjectRequest->save($this->request->data['TskProjectRequest'])){
					$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>New Project request sent for approval successfully', 'default', array('class' => 'alert alert-success'));					
					$this->redirect('/tskassign/new_project/');
				}else{
					$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in saving project request', 'default', array('class' => 'alert alert-error'));
				}
				
			}
		}

	}
	
	/* function to format the team member to save */
	public function format_team_member(){
		$count = count($this->request->data['TskProjectRequest']['member']) - 1;
		$comma = ',';
		foreach($this->request->data['TskProjectRequest']['member'] as $key => $user){
			if($count == $key){
				$comma = '';
			}
			$member .= $user.$comma;
		}
		return $member;
	}
	
	/* function to load the employee */
	public function load_employee(){
		$this->loadModel('HrEmployee');
		$this->HrEmployee->virtualFields = array('first_name' => "UPPER(CONCAT_WS(' ', trim(HrEmployee.first_name), trim(HrEmployee.last_name)))");
		$empList = $this->HrEmployee->find('list', array('fields' => array('id','first_name'),
		'order' => array('first_name ASC'),'conditions' => array('is_deleted' => 'N', 'status' => '1')));
		$this->set('empCcList', $empList);
	}
	
	
	/* function to load the plan types */
	public function load_plan_types(){
		return $plan_types = $this->TskAssign->TskPlanType->find('list', array('fields' => array('id','title'),
		'order' => array('title ASC'),'conditions' => array('is_deleted' => 'N', 'status' => '1')));
	}
	
	/* clear the cache */
	
	public function beforeFilter() { 
		//$this->disable_cache();
		$this->set('model_cls', 'TskAssign'); 
		$this->set('model_url', 'tskassign');
		$this->show_tabs(61);
		
	}
	

	
	
}