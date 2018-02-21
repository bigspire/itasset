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
class TskplanController extends AppController {  
	
	public $name = 'TskPlan';	
	
	public $helpers = array('Html', 'Form', 'Session');
	
	public $components = array('Session', 'Functions');
	
	public $layout = 'apps';	

	/* function to list the tsk plan requests */
	public function index(){ 
		// set the page title
		$this->set('title_for_layout', 'My Tasks - Work Planner - My PDCA');
		$this->set('planStatus', $this->Functions->get_plan_status($this->request->params['action']));		
		$this->load_company_data();	
		$this->load_project_data();
		$this->set('planType', $this->load_plan_types());

		// load task types
		$this->set('taskType', array('D' => 'Daily Plan', 'P' => 'Project Plan'));
		// call create task
		$this->create_plan();
		// when the form is submitted for search
		if($this->request->is('post')){		
			$url_vars = $this->Functions->create_url(array('type','company','project','month_year','plan_status'),'TskPlan'); 			
			$this->redirect('/tskplan/?'.$url_vars);			
		}
		$url_vars = $this->Functions->create_redirect_url(array('type','company','project','month_year','plan_status'),'TskPlan');
		$this->set('URL_VAR', $url_vars);
		
		
		
	}
	
	/* function to set plan month */
	public function get_plan_month(){
		$cur_month_key = date('Y-m');
		$prev_month_key = date("Y-m", strtotime('-1 months'));
		$next_month_key =  date("Y-m", strtotime('+1 months'));
		// set monthly 
		$cur_month_val = date('M');
		$prev_month_val = date("M", strtotime('-1 months'));
		$next_month_val =  date("M", strtotime('+1 months'));
		
		return $month = array( $prev_month_key => $prev_month_val, $cur_month_key => $cur_month_val,$next_month_key => $next_month_val);
	}
	
	
	
	
	/* function to update the task plan status */
	public function change_task_status($id){
		$this->layout = 'tsk_iframe';
		$this->set('planStatus', $this->Functions->get_plan_status('change_status'));	
		$data = $this->TskPlan->findById($id, array('fields' => 'id','start','title','status','tsk_company_id','tsk_projects_id'));		
		$this->set('tsk_data', $data);
		if (!empty($id) && intval($id)){
			// authorize user before action
			$ret_value = $this->auth_action($id);
			if($ret_value == 'pass'){ 	
				if (!empty($this->request->data)){ 
					// validates the form
					$this->TskPlan->set($this->request->data);	
					if ($this->TskPlan->validates(array('fieldList' => $this->get_validation_change_status()))) {
						$this->request->data['TskPlan']['id'] = $id;
						$this->request->data['TskPlan']['modified_date'] = $this->Functions->get_current_date();
						// assign fields
						$this->task_remark_fields($this->request->data['TskPlan']['status']);
						// update the status
						if($this->TskPlan->save($this->request->data['TskPlan'], array('validate' => false), $fieldList = $this->get_save_change_status())){
							// get approval data
							$approval_data = $this->get_approval_data();
							// update unread status
							$this->loadModel('TskPlanRead');
							$this->TskPlanRead->updateAll(array('status' => "'U'",'action_type' => "'M'", 'modified_date' => '"'.$this->Functions->get_current_date().'"'), array('tsk_plan_id' => $id, 'app_users_id' => $approval_data['Approval']['level1']));
							// check task partial							
							$this->check_task_status($id, $this->request->data['TskPlan']['status'],$approval_data['Approval']['level1']);							
							// show the msg.
							if($this->request->query['page'] != 'list'){
								$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Task status updated successfully', 'default', array('class' => 'alert alert-success'));				
								$this->set('page_reload', 1);
								$this->set('save_success', 1);
								echo "<script>window.parent.location.reload()</script>";
							}else{	
								$this->set('page_reload', 1);
								//$this->set('save_success', 1);
								//echo "<script>window.parent.location.reload()</script>";
								$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Task status updated successfully', 'default', array('class' => 'alert alert-success'));				
							}					
						}else{
							$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Problem in saving task status', 'default', array('class' => 'alert alert-info'));
						}
					}else{
						//print_r($this->TskPlan->validationErrors);
					}
				}else{
					// if status is not pending
					/*if($data['TskPlan']['status'] != 'W'){
						$this->set('page_reload', 1);
					}*/
				}
			}
		}
		$this->render('/Elements/task/change_task_status/');

	}
	
	/* function to assign the fields to save */
	public function task_remark_fields($st){
		if($st == 'E' || $st == 'L'){
			$this->request->data['TskPlan']['remark'] = $this->request->data['TskPlan']['comment'];
		}else if($st == 'P' || $st == 'C'){
			$this->request->data['TskPlan']['remark'] = $this->request->data['TskPlan']['reason'];			
		}
	}

	/* check for task postpone */
	public function check_task_status($id, $st,$approver){ 
		if($st == 'L' || $st == 'P'){
			// fetch task plan details
			$data = $this->TskPlan->findById($id, array('fields' => 'id','type','tsk_projects_id','tsk_company_id','start','end','title','desc','expected_outcome','tsk_plan_types_id'));
			if($st == 'L'){
				$start = 'remain_from';
				$end = 'remain_end';	
				$this->request->data['TskPlan']['plan_date'] = $this->request->data['TskPlan']['task_remaining'];	
			}else{
				$start = 'post_from';
				$end = 'post_end';
				$this->request->data['TskPlan']['plan_date'] = $this->request->data['TskPlan']['postpone_date'];
			}
			$this->request->data['TskPlan']['type'] = 	$data['TskPlan']['type'];			
			$this->request->data['TskPlan']['start'] = 	$this->set_plan_date($this->request->data['TskPlan'][$start]);			
			$this->request->data['TskPlan']['end'] = 	$this->set_plan_date($this->request->data['TskPlan'][$end]);
			$this->request->data['TskPlan']['title'] = 	$data['TskPlan']['title'];
			$this->request->data['TskPlan']['desc'] = 	$data['TskPlan']['desc'];
			$this->request->data['TskPlan']['expected_outcome'] = 	$data['TskPlan']['expected_outcome'];
			$this->request->data['TskPlan']['tsk_plan_types_id'] = 	$data['TskPlan']['tsk_plan_types_id'];
			$this->request->data['TskPlan']['created_date'] = 	$this->Functions->get_current_date();
			$this->request->data['TskPlan']['modified_date'] =  '';
			$this->request->data['TskPlan']['app_users_id'] = 	$this->Session->read('USER.Login.id');
			$this->request->data['TskPlan']['copy_task_id'] = 	$data['TskPlan']['id'];			
			if($data['TskPlan']['type'] == 'P'){
				$this->request->data['TskPlan']['tsk_projects_id'] = $data['TskPlan']['tsk_projects_id'];
				$this->request->data['TskPlan']['tsk_company_id'] = $data['TskPlan']['tsk_company_id'];
			}
			$this->request->data['TskPlan']['status'] = 'W';
			$this->request->data['TskPlan']['remark'] = '';
			// save the task
			$this->request->data['TskPlan']['id'] = '';
			if($this->TskPlan->save($this->request->data['TskPlan'], array('validate' => false))){ 
				// restore the plan status
				$this->request->data['TskPlan']['status'] = $st;
				// save read status
				$this->TskPlanRead->updateAll(array('status' => "'U'",'action_type' => "'M'", 'modified_date' => '"'.$this->Functions->get_current_date().'"'), array('tsk_plan_id' => $id, 'app_users_id' => $approver));

			}else{ 
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in saving task details', 'default', array('class' => 'alert alert-info'));							

			}
			
				
		}
	}
	
	/* function to load static data */
	public function load_company_data(){
		// fetch the companies
		$comp_list = $this->TskPlan->TskCustomer->find('list', array('fields' => array('id','company_name'), 'order' => array('company_name ASC'),'conditions' => array('is_deleted' => 'N', 'status' => '1')));
		$this->set('compList', $comp_list);
	}
	
	public function load_project_data(){
		// fetch the projects	
		if($this->request->params['action'] == 'edit_task'){
			$comp_cond = array('tsk_company_id' => $this->request->data['TskPlan']['tsk_company_id']);
		}else if(!empty($this->request->query['company'])){
			$comp_cond = array('tsk_company_id' => $this->request->query['company']);
		}
		// if company selected
		if(!empty($comp_cond)){
			$this->TskPlan->TskProject->bindModel(
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
			$proj_list = $this->TskPlan->TskProject->find('all', array('fields' => array('TskProject.id','project_name'), 'order' => array('project_name ASC'),'conditions' => array('TskProject.is_deleted' => 'N', $comp_cond,$proj_cond)));
			$data2 = $this->Functions->format_dropdown($proj_list, 'TskProject', 'id', 'project_name');
			$this->set('projList', $data2);
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
				$default_start = $rec['TskPlan']['start'];
				// print json
				$this->print_json($rec, $default_start);				
				// check task more than one day for project task plan
				if($rec['TskPlan']['type'] == 'P'){
					$diff = $this->TskPlan->diff_date(date('Y-m-d', strtotime($rec['TskPlan']['start'])), date('Y-m-d', strtotime($rec['TskPlan']['end'])));
					while($diff >= 1){
						$rec['TskPlan']['start'] = date('Y-m-d', strtotime( $rec['TskPlan']['start']. '+1 days'));
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
	
	/* function to get my tasks */
	public function get_my_tasks(){
		// get url variables for search
		$plan_type = $this->request->query['type']  ? $this->request->query['type'] : 'D';		
		
		$typeCond = array('TskPlan.type' => $plan_type);
		
		// for company conditions
		if(!empty($this->request->query['company'])){
			$compCond = array('TskPlan.tsk_company_id' => $this->request->query['company']); 
		}
		// for project condition
		if(!empty($this->request->query['project'])){
			$projCond = array('TskPlan.tsk_projects_id' => $this->request->query['project']); 
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
			$statusCond = array('TskPlan.status' => $this->request->query['plan_status']); 
		}
		// read status condition		
		$fields = array('id','created_date','title','desc','status','remark','type','start','end','TskPlanType.title', 'TskCustomer.company_name', 'TskProject.project_name', 'read_status', 'read_type','is_tag');
				
		// fetch the task plans		
		$data = $this->TskPlan->find('all', array('fields' => $fields,	'conditions' => array($statusCond,$typeCond,$compCond,$projCond,$dateCond,'TskPlan.app_users_id' => $this->Session->read('USER.Login.id'),'TskPlan.is_deleted' => 'N'), 'order' => array('TskPlan.start' => 'asc'),	'group' => array('TskPlan.id')));
		return $data;
	
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
				$url_vars = $this->Functions->create_redirect_url(array('type','company','project','month_year','plan_status'),'TskPlan');
				//$url_vars = $this->strip_var($url_vars);
				
				$desc_limit = $rec['TskPlan']['type'] == 'D' ? 50 : 30;
				
				// for long desc
				$desc_len = strlen($rec['TskPlan']['desc']);
				$more_display = ($desc_len > $desc_limit) ? '' : 'dn';
				$long_desc = ($desc_len > $desc_limit) ? $rec['TskPlan']['desc'] : '';
				$short_desc = $this->Functions->string_truncate($rec['TskPlan']['desc'], $desc_limit);
				// replace new lines
				$short_desc =  $this->Functions->remove_spl_char($short_desc);
				$long_desc =  $this->Functions->remove_spl_char($long_desc);
				
				echo '{ "date": "'; echo date('Y-m-d 23:59:59', strtotime($rec['TskPlan']['start'])); echo '" ,
				"title": "<a href='; echo $this->webroot.'tskplan/view_task/'.$rec['TskPlan']['id'].'/?'.trim($url_vars); echo ' class=\" iframeBox cboxElement tsk_title\" val=90_90>'; echo $this->Functions->remove_spl_char($this->Functions->string_truncate(trim($rec['TskPlan']['title']), 20)); echo '</a>'; echo $this->show_edit_link($rec['TskPlan'], $url_vars);  echo '",
				"start_time": "'; echo $this->check_plan_type($default_start,$rec['TskPlan']['type'], 'start', $rec['TskCustomer']['company_name'], $rec['TskProject']['project_name']); echo '",
				"end_time": "'; echo $this->check_plan_type($rec['TskPlan']['end'], $rec['TskPlan']['type'], 'end', $rec['TskCustomer']['company_name'], $rec['TskProject']['project_name']); echo '",
				"description": "<i data-placement=top id='; echo 'tag-'.$rec['TskPlan']['id']; echo ' val='; echo $rec['TskPlan']['id'].'-'.$rec['TskPlan']['is_tag']; echo ' rel=tooltip class=\"tsk_tip '; echo $this->Functions->show_read_class($rec['TskPlan']['is_tag']); echo ' cursor icon-circle \" title=\"'; echo $this->Functions->show_read_text($rec['TskPlan']['is_tag']); echo '\"></i><span class=desc_less> '; 
				echo $short_desc;
				echo '</span>'. 
				' <span class=\" desc_more dn \"> '; 
				echo $long_desc; echo '</span><a class=\" tsk_more '; echo $more_display; echo '\" href=javascript:void(0); style=color:#EF7575>more</a> <a class=\" tsk_less dn \" href=javascript:void(0); style=color:#EF7575>less</a>'; echo $this->Functions->check_read_type($rec['TskPlan']['read_status'], $rec['TskPlan']['read_type']); echo '",
				"status": "<span class=\"label '; echo $this->Functions->show_task_status_color($rec['TskPlan']['status']); echo '\">'; echo $this->Functions->show_task_status($rec['TskPlan']['status']); echo '</span>'; echo $this->show_status_link($rec['TskPlan'], $url_vars); echo '",
				"plan_action": "'; echo $rec['TskPlanType']['title']; echo '",
				"plan_type": "<span rel=tooltip title=\"'; echo $this->Functions->show_plan_type($rec['TskPlan']['type']); echo '\" class=\"tsk_tip label '; echo $this->Functions->show_task_plan_color($rec['TskPlan']['type']); echo '\">'; echo $rec['TskPlan']['type']; echo '</span>",
				"url" : "","read_status": "'; echo $rec['TskPlan']['read_status']; echo '","plan_date": "'; echo $this->Functions->format_date($default_start); echo '",
				"project" : "'; echo $rec['TskProject']['project_name']; echo '","company" : "'; echo $rec['TskCustomer']['company_name']; echo '","rec_id" : "'; echo $rec['TskPlan']['id']; echo '"}';
	}
	
	
	
	/* function to show edit link */
	public function show_edit_link($data, $url_vars){
		$task_date = date('Y-m-d', strtotime($data['end']));
		if($data['status'] == 'W'  && strtotime($task_date) >= strtotime(date('Y-m-d'))){
			return $link = " <a href='".$this->webroot.'tskplan/edit_task/'.$data['id'].'/?'.$url_vars."' title='Edit Plan' rel='tooltip'  class = 'tsk_tip tsk_title'><i class=icon-edit></i></a>";
		}
	}
	
	/* function to show status link */
	public function show_status_link($data,$url_vars){ 
		if($data['status'] == 'W'){
			return $link = " <a href='".$this->webroot.'tskplan/change_task_status/'.$data['id'].'/?'.$url_vars.'&page=list'."' title='Change Status' rel='tooltip' val='42_75'  class = 'tsk_tip iframeBox cboxElement tsk_title'><i class=icon-edit></i></a>";
		}else{
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
				$data_new = $this->TskPlan->find('all', array('fields' => array('TskPlan.start'), 'conditions' => array('TskPlan.copy_task_id' => $this->request->data['id'], 'TskPlan.is_deleted' => 'N'), 'limit' => 1));	
				$remark_d = $status == 'P' ? 'Postponed: ' : 'Remaining: ';	
				// print date
				echo $comment = '<strong>'.$remark_d.'</strong>'.$this->Functions->format_date($data_new[0]['TskPlan']['start']).'<br>';				
			}
			if($status == 'C' || $status == 'P'){
				$remark_f = 'Reason: ';
			}else{
				$remark_f =  'Comment: ';
			}				
			$data = $this->TskPlan->find('all', array('fields' => array('TskPlan.remark'), 'conditions' => array('TskPlan.id' => $this->request->data['id'], 'TskPlan.is_deleted' => 'N'), 'limit' => 1));		
			$remark_f = $this->request->data['status'] == 'C' ? 'Reason: ' : 'Comment: ';
			echo $comment = '<strong>'.$remark_f.'</strong>'.$data[0]['TskPlan']['remark'];			
			echo "||";
			echo $this->request->data['id'];
		}
		$this->render(false);
		die;
	}
	
		/* function to show comment */
	public function show_comment($id, $status){
		$this->layout = 'tsk_iframe';
		if(!empty($id) && intval($id)){
			// authorize user before action
			$ret_value = $this->auth_action($id);
			if($ret_value == 'pass'){	
				// if executed or cancelled status
				$data = $this->TskPlan->find('all', array('fields' => array('TskPlan.remark'), 'conditions' => array('TskPlan.id' => $id, 'TskPlan.is_deleted' => 'N'), 'limit' => 1));		
				if($status == 'C' || $status == 'P'){
					$remark_f = 'Reason: ';
				}else{
					$remark_f =  'Comment: ';
				}
				// for postponed or partial status					
				if($status == 'P' || $status == 'L'){ 	
					$data_new = $this->TskPlan->find('all', array('fields' => array('TskPlan.start'), 'conditions' => array('TskPlan.copy_task_id' => $id, 'TskPlan.is_deleted' => 'N'), 'limit' => 1));	
					$date_f = $status == 'P' ? 'Task Postponed To: ' : 'Remaining Task Completion Date: ';	
					$this->set('date_field', $date_f);
					$this->set('date_data', $this->Functions->format_date($data_new[0]['TskPlan']['start']));								
				}
				$this->set('remark_field', $remark_f);
				$this->set('remark_data', $data[0]['TskPlan']['remark']);
			}
		}
		$this->render('/Elements/task/show_comment');
	}
	
	
	
	/* function to show date */
	public function check_plan_type($date, $type, $show_type){
		if($type == 'D'){
			$result = $this->Functions->show_task_time($date, $type);
		}else{
			$result = $this->Functions->format_date($date);
		}
		return $result;
	}
	
	/* function to strip the unwanted chars */
	public function strip_var($url_data){
		return trim(substr($url_data, 0, strlen($url_data)-9));
	}	

	
	
	/* function to check for duplicate entry */
	public function check_duplicate_status($plan_id, $app_user_id){
		$count = $this->TskPlanRead->find('count',  array('conditions' => array('TskPlanRead.tsk_plan_id' => $plan_id,
		'TskPlanRead.app_users_id' => $app_user_id)));
		if($count > 0){
			$this->invalid_attempt();
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
			$typeCond = array('TskPlan.type' => 'D'); 
		}else if($this->request->data['type'] == 'P'){
			$typeCond = array('TskPlan.type' => 'P'); 
		}
		
		// status condition
		if($this->request->data['status'] != ''){
			$stCond = array('TskPlan.status' => $this->request->data['status']); 
		}
		
		$data = $this->TskPlan->find('all', array('fields' => array('id','created_date','title','desc','status','remark','type','start','end','TskPlanType.title', 'TskCustomer.company_name', 'TskProject.project_name','is_tag'),
		'conditions' => array($statusCond,$typeCond,$stCond,$compCond,$projCond, $dateCond,'TskPlan.app_users_id' => $this->Session->read('USER.Login.id'),'TskPlan.is_deleted' => 'N'), 'order' => array('start' => 'asc'),	'group' => array('TskPlan.id')));
		$this->set('data', $data);
	
		$this->render('/Elements/task/show_task/');	
	}
	
	
	/* function to save the advance */
	public function create_plan(){ 
		// set the page title		
		if ($this->request->is('post')){ 
			// validates the form
			$this->TskPlan->set($this->request->data);
			if ($this->TskPlan->validates(array('fieldList' => $this->get_validation_fields()))) {
				// check atleast a plan filled
				if($this->check_plan_filled()){
					$this->request->data['TskPlan']['app_users_id'] = $this->Session->read('USER.Login.id');
					$this->request->data['TskPlan']['read_status'] = 'R';
					// format the dates to save					
					$this->request->data['TskPlan']['created_date'] = $this->Functions->get_current_date();
					// update project data details
					$this->format_tsk_fields();

					$this->request->data['TskPlan']['start'] = $this->set_plan_date($this->request->data['TskPlan']['start']);
					$this->request->data['TskPlan']['end'] = $this->set_plan_date($this->request->data['TskPlan']['end']);
					
					$this->request->data['TskPlan']['is_plan'] = $this->check_is_planned($this->request->data['TskPlan']['start']);

					
					// make sure superior available
					// get the superiors
					$approval_data = $this->get_approval_data();
					if(!empty($approval_data)){
						// save the data
						if($this->TskPlan->save($this->request->data['TskPlan'], array('validate' => false))) {
							// save static task
							$id = $this->TskPlan->id;							
							// save dynamic task list
							$this->loadModel('TskPlanRead');
							// save  req. status data					
							$data = array('tsk_plan_id' => $id, 'created_date' => $this->Functions->get_current_date(), 'app_users_id' => $approval_data['Approval']['level1']);						
							// make sure not duplicate status exists
							$this->check_duplicate_status($id, $approval_data['Approval']['level1']);
							// save in adv. status table
							$this->TskPlanRead->id = '';
							$this->TskPlanRead->create();
							if($this->TskPlanRead->save($data, true, $fieldList = array('tsk_plan_id','created_date','app_users_id'))){
								// save other tasks
								$this->save_dynamic_task_list($approval_data['Approval']['level1']);								
								// show the msg.
								$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Task plan created successfully', 'default', array('class' => 'alert alert-success'));
							}else{
								$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in saving read status', 'default', array('class' => 'alert alert-info'));
							}
						}else{
							$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in saving the data..', 'default', array('class' => 'alert alert-info'));
						}
						$this->redirect('/tskplan/?type='.$this->request->data['TskPlan']['type'].'&date='.$this->Functions->get_task_date($this->request->data['TskPlan']['start']));							
					}else{
						// save the data
						if($this->TskPlan->save($this->request->data['TskPlan'], array('validate' => false))) {
							// save other tasks
							$this->save_dynamic_task_list();
							$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Task plan created successfully', 'default', array('class' => 'alert alert-success'));					
						}else{
							$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in saving the data..', 'default', array('class' => 'alert alert-error'));
						}
						// show the error msg.
						$this->redirect('/tskplan/?type='.$this->request->data['TskPlan']['type'].'&date='.$this->Functions->get_task_date($this->request->data['TskPlan']['start']));
					}
					
				}	
				
			}else{
					
			}
			
		}
	}
	
	/* function to check whether its planned in time */
	public function check_is_planned($date){
		if(strtotime($date) >= strtotime(date('Y-m-d H:i:s'))){
			return 'Y';
		}else{
			return 'N';
		}
	}
	
	/* function to get approval data */
	public function get_approval_data(){
		$this->loadModel('Approval');
		return $approval_data = $this->Approval->find('first', array('fields' => array('level1'), 'conditions'=> array('Approval.app_users_id' => $this->Session->read('USER.Login.id'), 'type' => 'T')));
	}
	
	
	/* function to set plan start and end */
	public function set_plan_date($date){
		if($this->request->data['TskPlan']['type'] == 'D'){
			return $this->Functions->format_date_save($this->request->data['TskPlan']['plan_date']).' '.$this->Functions->format_time_save($date);
		}else{
			return $this->Functions->format_date_save($date);
		}
	}
	
	/* function to set plan start and end */
	public function format_tsk_fields(){
		if($this->request->data['TskPlan']['type'] == 'D'){					
			$this->request->data['TskPlan']['tsk_company_id'] == '';
			$this->request->data['TskPlan']['tsk_projects_id'] == '';
		}
	}
	
	
	

	
		/* function to save task lists */
	public function save_dynamic_task_list($approve_id){ 
		for($i = 0; $i < $this->request->data['TskPlan']['form_count']; $i++){
			if($this->request->data['TskPlan']['start_'.$i] != ''  && $this->request->data['TskPlan']['types_id_'.$i] != '' && $this->request->data['TskPlan']['end_'.$i] != ''
			&& $this->request->data['TskPlan']['desc_'.$i] != ''  && $this->request->data['TskPlan']['title_'.$i] != ''  && $this->request->data['TskPlan']['outcome_'.$i] != ''){
				$this->TskPlan->id = '';
				$this->TskPlan->create();				
				$data = array('app_users_id' => $this->Session->read('USER.Login.id'), 'status' => 'W', 'is_deleted' => 'N', 'type' => $this->request->data['TskPlan']['type'], 'tsk_projects_id' => $this->request->data['TskPlan']['tsk_projects_id'], 
				'tsk_company_id' => $this->request->data['TskPlan']['tsk_company_id'], 'read_status' => 'R', 'start' =>  $this->set_plan_date($this->request->data['TskPlan']['start_'.$i]), 
				'tsk_plan_types_id' => $this->request->data['TskPlan']['types_id_'.$i],'end' => $this->set_plan_date($this->request->data['TskPlan']['end_'.$i]),
				'title' => $this->request->data['TskPlan']['title_'.$i],'desc' => $this->request->data['TskPlan']['desc_'.$i],
				'created_date' => $this->Functions->get_current_date(), 'is_plan' => $this->check_is_planned($this->set_plan_date($this->request->data['TskPlan']['start_'.$i])),'expected_outcome' => $this->request->data['TskPlan']['outcome_'.$i]);				
				// save the list
				$this->TskPlan->save($data, false, $fieldList = array('app_users_id','tsk_projects_id', 'tsk_company_id', 'read_status','start','tsk_plan_types_id',
				'end','title','desc','created_date', 'expected_outcome', 'type', 'status', 'is_deleted','is_plan'));
				// save read status	
				if(!empty($approve_id)){
					$this->TskPlanRead->id = '';
					$this->TskPlanRead->create();				
					$data = array('tsk_plan_id' => $this->TskPlan->id, 'created_date' => $this->Functions->get_current_date(), 'app_users_id' => $approve_id);
					$this->TskPlanRead->save($data, true, $fieldList = array('tsk_plan_id','created_date','app_users_id'));
				}
			}
		}
	}
	
	
	
	
	/* function to show the validation fields */
	public function get_validation_fields(){
		if($this->request->data['TskPlan']['type'] == 'P'){
			$valid_arr =  array('type', 'start_date','end_date','tsk_company_id','tsk_projects_id');			
		}else{
			$valid_arr =  array('type', 'plan_date');			
		}
		return $valid_arr;
	}
	
	/* function to show the validation fields */
	public function get_validation_change_status(){
		switch($this->request->data['TskPlan']['status']){
			case 'E':
			$valid_arr =  array('status', 'comment');		
			break;
			case 'L':
			$valid_arr = $this->request->data['TskPlan']['plan_type'] == 'D' ? array('status', 'task_remaining', 'comment') : array('status', 'remain_from', 'comment');
			break;
			case 'P':
			$valid_arr = $this->request->data['TskPlan']['plan_type'] == 'D' ? array('status', 'postpone_date', 'reason') : array('status', 'post_from', 'reason');
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
		switch($this->request->data['TskPlan']['status']){
			case 'E':
			$this->request->data['TskPlan']['remark'] = $this->request->data['TskPlan']['comment'];
			$save_arr =  array('status', 'remark','modified_date');		
			break;
			case 'L':
			$this->request->data['TskPlan']['remark'] = $this->request->data['TskPlan']['comment'];
			$save_arr =  array('status', 'task_remaining', 'remark','modified_date');		
			break;
			case 'P':
			$this->request->data['TskPlan']['remark'] = $this->request->data['TskPlan']['reason'];
			//$this->request->data['TskPlan']['postpone_from'] = $this->Functions->format_date_save($this->request->data['TskPlan']['postpone_from2']);
			$save_arr =  array('status', 'postpone_date', 'date_from', 'date_to', 'remark','modified_date');		
			break;			
			case 'C':
			$this->request->data['TskPlan']['remark'] = $this->request->data['TskPlan']['comment'];
			$save_arr =  array('status', 'remark','modified_date');		
			break;			
		}
		
		return $save_arr;
	}
	
	/* function to check plan filled */
	public function check_plan_filled(){	
		// for edit page validation
		//$suffix = ($this->request->data['TskPlan']['page'] == 'edit') ? '_t' : '';		
		if(empty($this->request->data['TskPlan']['start']) || empty($this->request->data['TskPlan']['end']) 
		|| empty($this->request->data['TskPlan']['desc']) || empty($this->request->data['TskPlan']['expected_outcome']) || 
		empty($this->request->data['TskPlan']['title']) || empty($this->request->data['TskPlan']['tsk_plan_types_id'])){		
			// show the error msg.
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Please fill atleast a task plan', 'default', array('class' => 'alert alert-error'));		
		}else{
			return true;
		}
	}
	
	/* function to remove the task. list */
	public function remove_task_list($id){
		//$this->TskPlan->deleteAll(array('tsk_plan_id' => $id), false);
	}
	
	
	
	
	/* function to edit the task plan  */
	public function edit_task($id){	
		// set the page title		
		$this->set('title_for_layout', 'Edit Task Plan - Work Planner - My PDCA');
		// load task types
		$this->set('taskType', array('D' => 'Daily Plan', 'P' => 'Project Plan'));
		$this->set('planType', $this->load_plan_types());		
		if (!empty($id) && intval($id)){
			// authorize user before action
			$ret_value = $this->auth_action($id);
			if($ret_value == 'pass'){
				// when the form submitted
				if (!empty($this->request->data)){ 
					$this->load_company_data();	
					$this->load_project_data();
					// validates the form
					$this->TskPlan->set($this->request->data);
					if ($this->TskPlan->validates(array('fieldList' => $this->get_validation_fields()))) {
						// check atleast a plan filled
						if($this->check_plan_filled()){
							// format the dates to save
							$this->request->data['TskPlan']['modified_date'] = $this->Functions->get_current_date();
							// format the dates to save						
							$this->request->data['TskPlan']['start'] = $this->set_plan_date($this->request->data['TskPlan']['start']);
							$this->request->data['TskPlan']['end'] = $this->set_plan_date($this->request->data['TskPlan']['end']);
							
							$this->request->data['TskPlan']['is_plan'] = $this->check_is_planned($this->request->data['TskPlan']['start']);
							
							// update project data details
							$this->format_tsk_fields();
							// get the superiors
							$approval_data = $this->get_approval_data();
							if(!empty($approval_data)){
								// save the data					
								if($this->TskPlan->save($this->request->data['TskPlan'], array('validate' => false))) {
									// save  req. status data								
									$this->loadModel('TskPlanRead');
									if($this->TskPlanRead->updateAll(array('modified_date' => '"'.$this->Functions->get_current_date().'"', 'status' => "'U'", 'action_type' => "'M'"), array('tsk_plan_id' => $id, 'app_users_id' => $approval_data['Approval']['level1']))){
										// show the msg.
										$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Task plan modified successfully', 'default', array('class' => 'alert alert-success'));	
									}else{										
										$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in saving read status', 'default', array('class' => 'alert alert-info'));							
									}
									// save dynamic task list
									$this->save_dynamic_task_list($approval_data['Approval']['level1']);																	
																
								}else{
									$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in saving the data...', 'default', array('class' => 'alert alert-info'));									
								}
								$this->redirect('/tskplan/?type='.$this->request->data['TskPlan']['type'].'&date='.$this->Functions->get_task_date($this->request->data['TskPlan']['start']));							
							}else{
								// save the data
								if($this->TskPlan->save($this->request->data['TskPlan'], array('validate' => false))) {
									// save other tasks
									$this->save_dynamic_task_list();
									$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Task plan created successfully', 'default', array('class' => 'alert alert-success'));					
								}else{
									$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in saving the data..', 'default', array('class' => 'alert alert-error'));
								}
								// show the error msg.
								//$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>You have no superior to check your task. Please contact admin', 'default', array('class' => 'alert alert-error'));					
								$this->redirect('/tskplan/?type='.$this->request->data['TskPlan']['type'].'&date='.$this->Functions->get_task_date($this->request->data['TskPlan']['start']));
							}
						}
								
					}	
				}else{
					$this->request->data = $this->TskPlan->findById($id, array('fields'=> 'id','status','type','remark','tsk_company_id','tsk_projects_id','start','end','title','desc','expected_outcome','tsk_plan_types_id'));					
					// if status is not pending
					if($this->request->data['TskPlan']['status'] != 'W' || $this->Functions->check_task_edit($this->request->data['TskPlan']['end']) == false){
						$this->redirect('/tskplan/');
					}
					$this->set('task_data', $this->request->data);
					$this->load_company_data();	
					$this->load_project_data();		
				}
			}else if($ret_value == 'fail'){
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/tskplan/');
			}else{
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Record Deleted: '.$ret_value , 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/tskplan/');
			}
		}else{
			// show the error msg.
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));
			$this->redirect('/tskplan/');		
		}		
		
	}
	
	
	/* function to auth record */
	public function auth_action($id){  
		$data = $this->TskPlan->findById($id, array('fields' => 'app_users_id','is_deleted','modified_date'));	
		// check the req belongs to the user
		if($data['TskPlan']['is_deleted'] == 'Y'){
			return $data['TskPlan']['modified_date'];
		}else if($data['TskPlan']['app_users_id'] == $this->Session->read('USER.Login.id')){	
			return 'pass';
		}else{
			return 'fail';
		}
	}
	
	/* function to view the plan */
	public function view_task($id){
		$this->layout = 'tsk_iframe';
		// set the page title		
		$this->set('title_for_layout', 'View My Tasks - Work Planner - My PDCA');
		if(!empty($id) && intval($id)){
			// authorize user before action
			$ret_value = $this->auth_action($id);
			if($ret_value == 'pass'){	
				$data = $this->TskPlan->findById($id, array('fields' => 'id','status','type','remark','TskProject.project_name','TskCustomer.company_name',
				'start','end','title','desc','expected_outcome','TskPlanType.title'));
				$this->set('tsk_data', $data);
				// get task replies
				$this->loadModel('TskPlanReply');
				$this->get_task_reply($id);				
				// when the task updated
				if(strstr($this->referer(), 'view_task') != ''){
					$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Task status updated successfully', 'default', array('class' => 'alert alert-success'));
				}
			}else if($ret_value == 'fail'){ 
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/tskplan/');	
			}else{
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Record Deleted: '.$ret_value , 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/tskplan/');	
			}
		}else{
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));		
			$this->redirect('/tskplan/');	
		}
		$this->render('/Elements/task/view_task');	
	}
	
	/* function to save the todo item */
	public function reply_task(){
		$this->layout = 'ajax';		
		if ($this->request->is('post') && $this->request->data['reply'] != '') { 
			$data = array('tsk_plan_id' => $this->request->query['id'], 'desc' => trim($this->request->data['reply']), 'created_date' => $this->Functions->get_current_date(), 'app_users_id' => $this->Session->read('USER.Login.id'));		
			$this->loadModel('TskPlanReply');			
			// update the todo
			if($this->TskPlanReply->save($data, true, $fieldList = array('tsk_plan_id', 'desc','created_date','app_users_id'))){			
				$this->get_task_reply($this->request->query['id']);
				// get approval data
				$approval_data = $this->get_approval_data();
				// update unread status
				$this->loadModel('TskPlanRead');
				$this->TskPlanRead->updateAll(array('status' => "'U'",'action_type' => "'R'", 'modified_date' => '"'.$this->Functions->get_current_date().'"'), array('tsk_plan_id' => $this->request->query['id'], 'app_users_id' => $approval_data['Approval']['level1']));

			}
		}
		$this->render('/Elements/task/reply_task');	
	}
	
	/* get the reply of tasks */
	public function get_task_reply($id){
		$data = $this->TskPlanReply->find('all', array('conditions' => array('tsk_plan_id' => $id), 'fields' => array('desc','created_date', 'HrEmployee.first_name'),
		'order' => array('created_date' => 'desc')));
		$this->set('reply_data', $data);
	}
	
	
	/* function to load the plan types */
	public function load_plan_types(){
		$this->loadModel('TskPlanType');
		$cond = array('OR' => array(array( 'hr_business_unit_id' => null), array( 'hr_business_unit_id' => $this->Session->read('USER.Login.hr_business_unit_id')) ) );
		return $plan_types = $this->TskPlanType->find('list', array('fields' => array('id','title'),
		'order' => array('title ASC'),'conditions' => array('is_deleted' => 'N', 'status' => '1', $cond)));
	}
	
	/* function to update the read status */
	public function update_read_status(){
		$this->layout = 'ajax';			
		if(!empty($this->request->data['date'])){
			if($this->TskPlan->updateAll(array('read_status' => "'R'"), array('TskPlan.app_users_id' => $this->Session->read('USER.Login.id'),'TskPlan.type' => $this->request->data['tsk_type'], 'TskPlan.start like' => $this->request->data['date'].'%'))){					
				echo $this->TskPlan->getAffectedRows();
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
			$this->TskPlan->id = $this->request->data['id'];
			if($this->TskPlan->saveField('is_tag', $tag)){				
				echo $this->request->data['id'];			
			}
			
		}	
	
		$this->render(false);
		die;
	}
	

	
	/* function to add new task type */
	public function new_task_type(){
		$this->layout = 'iframe';	
		if ($this->request->is('post')){ 
			$this->loadModel();
			// validates the form
			$this->TskPlan->TskPlanType->set($this->request->data);
			if($this->TskPlan->TskPlanType->validates(array('fieldList' => array('title','desc')))) {
				$this->request->data['TskProjectRequest']['app_users_id'] = $this->Session->read('USER.Login.id');				
				$this->request->data['TskProjectRequest']['created_date'] = $this->Functions->get_current_date();				
				// save project request
				if($this->TskPlan->TskPlanType->save($this->request->data['TskPlanType'])){
					$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>New Task Type sent for approval successfully', 'default', array('class' => 'alert alert-success'));					
					$this->redirect('/tskplan/new_task_type/');
				}else{
					$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in saving task type', 'default', array('class' => 'alert alert-error'));
				}
				
			}
		}	
	
	}
	
	/* function to save task timing for validation */
	public function validate_task_timing(){
		$this->layout = 'refresh';
		$data = $this->request->data['timing']; 
		$task_date = $this->request->data['date']; 
		$date = explode('/', $task_date);
		$chk_tsk_date = $date[2].'-'.$date[1].'-'.$date[0];

		$this->loadModel('TskTimeTemp');
		
		// save and fetch task timings for validation
		$this->save_temp_data($data);
		//echo 0;die;
		$data_ar = $this->get_temp_data($data);		
		// clear after fetched
		$this->TskTimeTemp->deleteAll(array('app_users_id' => $this->Session->read('USER.Login.id')), false);
		// for edit task 
		$page_cond = $this->request->data['page'] == 'edit' ? array('TskPlan.id !=' => $this->request->data['id']) : '';		
		$this->TskPlan->unbindModel(array('belongsTo' => array('TskCustomer','TskProject','TskPlanType')));
		
		$tsk_chk_data = $this->TskPlan->find('all', array('fields' => array('start','end'), 
		'conditions' => array('TskPlan.app_users_id' => $this->Session->read('USER.Login.id'),
		'start like' => $chk_tsk_date.'%', 'TskPlan.type' => 'D', 'TskPlan.status !=' => array('P', 'C'), $page_cond)));
		$error = 1;		
		
		$tot = count($data_ar);	
		if($tot > 1){
			$flag = 0;
			foreach($data_ar as $record){ 
				$start = $record['TskTimeTemp']['start'];
				$end = $record['TskTimeTemp']['end'];
				if(!empty($start) && !empty($end)){ 
					if($flag == 0){ 
						$data = array('start' => $start, 'end' => $end,'app_users_id' => $this->Session->read('USER.Login.id'));
						$this->TskTimeTemp->save($data);
						$this->TskTimeTemp->create();
						$flag = 1;
					}else{
						// compare the dates 
						if($this->comapare_time_temp($start, $end)){
							echo 0;
							$this->TskTimeTemp->deleteAll(array('app_users_id' => $this->Session->read('USER.Login.id')), false);
							die;
						}else{
							$data = array('start' => $start, 'end' => $end,'app_users_id' => $this->Session->read('USER.Login.id'));
							$this->TskTimeTemp->save($data);
							$this->TskTimeTemp->create();
						}
					}
				}				
			
			}
			
			$tsk_data = $this->TskTimeTemp->find('all', array('fields' => array('start', 'end'), 'conditions' => array('app_users_id' => $this->Session->read('USER.Login.id')),
			'order' => array('start' => 'asc')));						
			// check the database if its true
			if($error == 1 && !empty($tsk_data)){
				foreach($tsk_data as $tsk_value){
					// Compare two elements of array
					if(!$this->comapare_time($chk_tsk_date.' '.$tsk_value['TskTimeTemp']['start'], $chk_tsk_date.' '.$tsk_value['TskTimeTemp']['end'], $chk_tsk_date)){
						// if exists in the already created tasks
						echo 0;
						$this->TskTimeTemp->deleteAll(array('app_users_id' => $this->Session->read('USER.Login.id')), false);
						die;
					}						
				}
			}				
			// delete all records
			$this->TskTimeTemp->deleteAll(array('app_users_id' => $this->Session->read('USER.Login.id')), false);			
			echo $error;
		}else{ 	
			// make sure db value is not empty
			if(!empty($tsk_chk_data)){
				// check task already created in this date
				$start = $chk_tsk_date.' '.$data_ar[0]['TskTimeTemp']['start'];
				$end = $chk_tsk_date.' '.$data_ar[0]['TskTimeTemp']['end'];				
					// Compare two elements of array
				if(!$this->comapare_time($start, $end, $chk_tsk_date)){
					// if exists in the already created tasks
					echo 0;
					$this->TskTimeTemp->deleteAll(array('app_users_id' => $this->Session->read('USER.Login.id')), false);
					die;
				}
			}
			echo $error;
		}
		$this->render(false);
	}
	
	/* function to save the temp table */
	public function save_temp_data($data){
		krsort($data); 
		$data_ar = array_values($data);	
		//$this->write_log(print_r($data_ar, true));
		$tot = count($data_ar) / 2;
		$k = 1;
		for($i = 0; $i <= $tot; $i++){ 
			$i = $i == 0 ? 0 :  $i + 1;
			if(!empty($data_ar[$i]) && !empty($data_ar[$k])){
				$data_val = array('start' => $data_ar[$i], 'end' => $data_ar[$k],'app_users_id' => $this->Session->read('USER.Login.id'));
				$this->TskTimeTemp->save($data_val);
				$this->TskTimeTemp->create();
			}
			$k = $k + 2;			
			
		}
	}
	
	/* function to get the temp data */
	public function get_temp_data(){ 
		$tsk_data = $this->TskTimeTemp->find('all', array('fields' => array('start', 'end'), 'conditions' => array('app_users_id' => $this->Session->read('USER.Login.id')),
			'order' => array('start' => 'asc')));		
		return $tsk_data;		
	}
	
	/* function to compare two times */
	public function comapare_time($start, $end ,$tsk_date){ 
		// write query to check
		$error = $this->check_task_exists($start, $end,$tsk_date);
		return !$error ? 1 : 0;
	}
	
	/* function to compare two times */
	public function comapare_time_temp($start, $end){
		// write query to check
		//$this->loadModel('TskTimeTemp');
		//$start = '09:40'; $end = '09:55';
		$dateCond = array('or' => array(array('start >=' => $start, 'start <=' => $end), array('end >=' => $start, 'end <=' => $end),
		array('start <=' => $start, 'end >=' => $start), array('start' => $start), array('end' => $end), array('start' => $end)));
		$tsk_count = $this->TskTimeTemp->find('count', array('conditions' => array('TskTimeTemp.app_users_id' => $this->Session->read('USER.Login.id'),
		$dateCond)));
		return $tsk_count;
	}
	
	/* function to check same task exists in time */
	public function check_task_exists($start, $end, $tsk_date){
		$this->TskPlan->unbindModel(array('belongsTo' => array('TskCustomer','TskProject','TskPlanType')));
		$page_cond = $this->request->data['page'] == 'edit' ? array('TskPlan.id !=' => $this->request->data['id']) : '';
		//$start = '2015-08-31 9:35'; $end = '2015-08-31 09:45';		
		$dateCond = array('or' => array(array('start >=' => $start, 'start <=' => $end), array('end >=' => $start, 'end <=' => $end),
		array('start <=' => $start, 'end >=' => $start)));
		$tsk_count = $this->TskPlan->find('count', array('conditions' => array('TskPlan.app_users_id' => $this->Session->read('USER.Login.id'),
		'TskPlan.type' => 'D',	'start like' => $tsk_date.'%', 'TskPlan.status !=' => array('P', 'C'), $dateCond, $page_cond)));
		return $tsk_count;
	}
	
	
	/* clear the cache */	
	public function beforeFilter() { 
		//$this->disable_cache();
		$this->set('model_cls', 'TskPlan'); 
		$this->set('model_url', 'tskplan');
		$this->show_tabs(57);
		
	}
	
	
	
	
}