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
class TskteamplanController extends AppController {  
	
	public $name = 'TskTeamPlan';	
	
	public $helpers = array('Html', 'Form', 'Session');
	
	public $components = array('Session', 'Functions');
	
	public $layout = 'apps';	

	/* function to list the tsk plan requests */
	public function index(){	
		// set the page title
		$this->set('title_for_layout', 'My Team\'s Tasks - Work Planner - My PDCA');
		$this->set('planStatus', $this->Functions->get_plan_status($this->request->params['action']));		
		$this->load_company_data();	
		$this->load_project_data();	
		// load task types
		$this->set('taskType', array('D' => 'Daily Plan', 'P' => 'Project Plan'));
		$emp_list = $this->get_team();
		
		// when the form is submitted for search
		if($this->request->is('post')){
			$url_vars = $this->Functions->create_url(array('type','company','project','month_year','plan_status','emp_id'),'TskTeamPlan'); 
			$this->redirect('/tskteamplan/?'.$url_vars);			
		}
		$url_vars = $this->Functions->create_redirect_url(array('type','company','project','month_year','plan_status','emp_id'),'TskTeamPlan');
		$this->set('URL_VAR', $url_vars);
		
	}
	
	public function get_team(){
		if($this->request->query['type'] == 'D' || empty($this->request->query['type'])){
			$emp_list = $this->TskTeamPlan->get_team($this->Session->read('USER.Login.id'),'T');
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
	
	
	/* function to load static data */
	public function load_company_data(){
		// fetch the companies
		$comp_list = $this->TskTeamPlan->TskCustomer->find('list', array('fields' => array('id','company_name'), 'order' => array('company_name ASC'),'conditions' => array('is_deleted' => 'N', 'status' => '1')));
		$this->set('compList', $comp_list);
	}
	
	public function load_project_data(){
		// fetch the projects	
		if(!empty($this->request->query['company'])){
			$comp_cond = array('tsk_company_id' => $this->request->query['company']);
		}
		// if company selected
		if(!empty($comp_cond)){
			$this->TskTeamPlan->TskProject->bindModel(
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
			$proj_list = $this->TskTeamPlan->TskProject->find('all', array('fields' => array('TskProject.id','project_name'), 'order' => array('project_name ASC'),'conditions' => array('TskProject.is_deleted' => 'N', $comp_cond,$proj_cond)));
			$data2 = $this->Functions->format_dropdown($proj_list, 'TskProject', 'id', 'project_name');
			$this->set('projList', $data2);
		}
	}
	
	
	/* function to show the task plan */
	public function show_data(){ 
		$this->layout = 'refresh';		
		// get the team tasks
		$data = $this->get_team_tasks();
		
		header('Content-type: text/json');
		date_default_timezone_set('Asia/Calcutta');

		echo '[';
			
			$initTime = date("Y")."-".date("m")."-".date("d")." ".date("H").":00:00";
			$separator = ",";
			$count = count($data);
			//$initTime = date("Y-m-d H:i:00");
			foreach($data as $key => $rec){	
				$default_start = $rec['TskTeamPlan']['start'];
				// print json
				$this->print_json($rec, $default_start);				
				// check task more than one day for project task plan
				if($rec['TskTeamPlan']['type'] == 'P'){
					$diff = $this->TskTeamPlan->diff_date(date('Y-m-d', strtotime($rec['TskTeamPlan']['start'])), date('Y-m-d', strtotime($rec['TskTeamPlan']['end'])));
					while($diff >= 1){
						$rec['TskTeamPlan']['start'] = date('Y-m-d', strtotime( $rec['TskTeamPlan']['start']. '+1 days'));
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
	
		
		/* function to show comment */
	public function show_comment($id, $status){
		$this->layout = 'tsk_iframe';
		if(!empty($id) && intval($id)){
			// authorize user before action
			$ret_value = $this->auth_action($id);
			if($ret_value == 'pass'){	
				// if executed or cancelled status
				$data = $this->TskTeamPlan->find('all', array('fields' => array('TskTeamPlan.remark'), 'conditions' => array('TskTeamPlan.id' => $id, 'TskTeamPlan.is_deleted' => 'N'), 'limit' => 1));		
				if($status == 'C' || $status == 'P'){
					$remark_f = 'Reason: ';
				}else{
					$remark_f =  'Comment: ';
				}
				// for postponed or partial status					
				if($status == 'P' || $status == 'L'){ 	
					$data_new = $this->TskTeamPlan->find('all', array('fields' => array('TskTeamPlan.start'), 'conditions' => array('TskTeamPlan.copy_task_id' => $id, 'TskTeamPlan.is_deleted' => 'N'), 'limit' => 1));	
					$date_f = $status == 'P' ? 'Task Postponed To: ' : 'Remaining Task Completion Date: ';	
					$this->set('date_field', $date_f);
					$this->set('date_data', $this->Functions->format_date($data_new[0]['TskTeamPlan']['start']));								
				}
				$this->set('remark_field', $remark_f);
				$this->set('remark_data', $data[0]['TskTeamPlan']['remark']);
			}
		}
		$this->render('/Elements/task/show_comment');
	}
	
	
	/* function to get team tasks */
	public function get_team_tasks(){
		// get url variables for search
		$plan_type = $this->request->query['type']  ? $this->request->query['type'] : 'D';
		
		$typeCond = array('TskTeamPlan.type' => $plan_type);
		
		// for company conditions
		if(!empty($this->request->query['company'])){
			$compCond = array('TskTeamPlan.tsk_company_id' => $this->request->query['company']); 
		}
		
		// for project condition
		if(!empty($this->request->query['project'])){
			$projCond = array('TskTeamPlan.tsk_projects_id' => $this->request->query['project']); 
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
		//$dateCond = array('and' => array("date_format(end, '%Y-%m-%d') >=" =>  $start,	"date_format(start, '%Y-%m-%d') <=" =>  $start )); 
				
		// status conditions
		if(!empty($this->request->query['plan_status'])){
			$statusCond = array('TskTeamPlan.status' => $this->request->query['plan_status']); 
		}
		// employee condition
		if(!empty($this->request->query['emp_id'])){
			$empCond = array('TskTeamPlan.app_users_id' => $this->request->query['emp_id']); 
		}	
		// read status condition
		
		$fields = array('id','created_date','title','desc','status','remark','type','start','end','TskPlanType.title', 'TskCustomer.company_name', 'HrEmployee.first_name', 'TskProject.project_name', 'TskPlanRead.status', 'TskPlanRead.action_type','TskPlanRead.is_tag');
			
		
		// fetch the task plans		
		$data = $this->TskTeamPlan->find('all', array('fields' => $fields, 'conditions' => array($statusCond,$typeCond,$compCond,$projCond,$dateCond,$empCond, 'TskPlanRead.app_users_id' => $this->Session->read('USER.Login.id'), 'TskTeamPlan.is_deleted' => 'N'), 'order' => array('TskTeamPlan.start' => 'asc', 'HrEmployee.first_name' => 'asc'), 'group' => array('TskTeamPlan.id')));
		
		return $data;
	}
	
	/* function to show status link */
	public function show_comment_link($data){
		if($data['status'] != 'W'){
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
				$data_new = $this->TskTeamPlan->find('all', array('fields' => array('TskTeamPlan.start'), 'conditions' => array('TskTeamPlan.copy_task_id' => $this->request->data['id'], 'TskTeamPlan.is_deleted' => 'N'), 'limit' => 1));	
				$remark_d = $status == 'P' ? 'Postponed: ' : 'Remaining: ';	
				// print date
				echo $comment = '<strong>'.$remark_d.'</strong>'.$this->Functions->format_date($data_new[0]['TskTeamPlan']['start']).'<br>';				
			}
			if($status == 'C' || $status == 'P'){
				$remark_f = 'Reason: ';
			}else{
				$remark_f =  'Comment: ';
			}				
			$data = $this->TskTeamPlan->find('all', array('fields' => array('TskTeamPlan.remark'), 'conditions' => array('TskTeamPlan.id' => $this->request->data['id'], 'TskTeamPlan.is_deleted' => 'N'), 'limit' => 1));		
			$remark_f = $this->request->data['status'] == 'C' ? 'Reason: ' : 'Comment: ';
			echo $comment = '<strong>'.$remark_f.'</strong>'.$data[0]['TskTeamPlan']['remark'];			
			echo "||";
			echo $this->request->data['id'];
		}
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
				$url_vars = $this->Functions->create_redirect_url(array('type','company','project','month_year','plan_status','emp_id'),'TskTeamPlan');
				//$url_vars = $this->strip_var($url_vars);
				$desc_limit = $rec['TskTeamPlan']['type'] == 'D' ? 50 : 30;
				
				// for long desc
				$desc_len = strlen($rec['TskTeamPlan']['desc']);
				$more_display = ($desc_len > $desc_limit) ? '' : 'dn';
				$long_desc = ($desc_len > $desc_limit) ? $rec['TskTeamPlan']['desc'] : '';
				$short_desc = $this->Functions->string_truncate($rec['TskTeamPlan']['desc'], $desc_limit);
				// replace new lines
				$short_desc =  $this->Functions->remove_spl_char($short_desc);
				$long_desc =  $this->Functions->remove_spl_char($long_desc);
				
				echo '{ "date": "'; echo date('Y-m-d 23:59:59', strtotime($rec['TskTeamPlan']['start'])); echo '" ,
				"title": "<a href='; echo $this->webroot.'tskteamplan/view_task/'.$rec['TskTeamPlan']['id'].'/?'.trim($url_vars); echo ' class=\" iframeBox cboxElement viewTsk tsk_title\"  id='; echo 'info-'.$rec['TskTeamPlan']['id']; echo ' val=90_90>'; echo $this->Functions->remove_spl_char($this->Functions->string_truncate($rec['TskTeamPlan']['title'], 20)); echo '</a>",
				"start_time": "'; echo $this->check_plan_type($default_start, $rec['TskTeamPlan']['type']); echo '",
				"end_time": "'; echo $this->check_plan_type($rec['TskTeamPlan']['end'], $rec['TskTeamPlan']['type']); echo '",
				"description": "<i data-placement=top id='; echo 'tag-'.$rec['TskTeamPlan']['id']; echo ' val='; echo $rec['TskTeamPlan']['id'].'-'.$rec['TskPlanRead']['is_tag']; echo ' rel=tooltip class=\"tsk_tip '; echo $this->Functions->show_read_class($rec['TskPlanRead']['is_tag']); echo ' cursor icon-circle \" title=\"'; echo $this->Functions->show_read_text($rec['TskPlanRead']['is_tag']); echo '\"></i><span class=desc_less> '; 
				echo $short_desc;
				echo '</span>'. 
				' <span class=\" desc_more dn \"> '; 
				echo $long_desc; echo '</span><a class=\" tsk_more '; echo $more_display; echo '\" href=# style=color:#EF7575>more</a> <a class=\" tsk_less dn \" href=# style=color:#EF7575>less</a>'; echo $this->Functions->check_read_type($rec['TskPlanRead']['status'], $rec['TskPlanRead']['action_type'],$rec['TskTeamPlan']['id']); echo '",
				"status": "<span class=\"label '; echo $this->Functions->show_task_status_color($rec['TskTeamPlan']['status']); echo '\">'; echo $this->Functions->show_task_status($rec['TskTeamPlan']['status']); echo '</span>'; echo $this->show_comment_link($rec['TskTeamPlan']); echo '",
				"plan_action": "'; echo $rec['TskPlanType']['title']; echo '",
				"plan_type": "<span rel=tooltip title=\"'; echo $this->Functions->show_plan_type($rec['TskTeamPlan']['type']); echo '\" class=\"tsk_tip label '; echo $this->Functions->show_task_plan_color($rec['TskTeamPlan']['type']); echo '\">'; echo $rec['TskTeamPlan']['type']; echo '</span>",
				"url" : "", "user": "'; echo $rec['HrEmployee']['first_name']; echo '", "read_status": "'; echo $rec['TskPlanRead']['status']; echo '","plan_date": "'; echo $this->Functions->format_date($default_start); echo '",
				"project" : "'; echo $rec['TskProject']['project_name']; echo '","company" : "'; echo $rec['TskCustomer']['company_name']; echo '","rec_id" : "'; echo $rec['TskTeamPlan']['id']; echo '"}';
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


	/* function to view the plan */
	public function view_task($id){
		$this->layout = 'tsk_iframe';
		// set the page title		
		if(!empty($id) && intval($id)){
			// authorize user before action
			$ret_value = $this->auth_action($id);
			if($ret_value == 'pass'){	
				$data = $this->TskTeamPlan->findById($id, array('fields' => 'id','status','type','remark','TskProject.project_name','TskCustomer.company_name',
				'start','end','title','desc','expected_outcome','TskPlanType.title','HrEmployee.first_name','HrEmployee.last_name'));
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
				$this->redirect('/tskteamplan/');	
			}else{
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Record Deleted: '.$ret_value , 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/tskteamplan/');	
			}
		}else{
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));		
			$this->redirect('/tskteamplan/');	
		}
		
		$this->render('/Elements/task/view_task');	
		
		
	}
	
	
	/* function to auth record */
	public function auth_action($id){
		$data = $this->TskTeamPlan->find('all', array('fields' => array('TskPlanRead.app_users_id','is_deleted','modified_date'), 'conditions' => array('TskTeamPlan.id' => $id)
		, 'limit' => 1));	
		// check the req belongs to the user
		if($data[0]['TskTeamPlan']['is_deleted'] == 'Y'){
			return $data[0]['TskTeamPlan']['modified_date'];
		}else if($data[0]['TskPlanRead']['app_users_id'] == $this->Session->read('USER.Login.id')){	
			return 'pass';
		}else{
			return 'fail';
		}
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
				// update unread status
				if($this->TskTeamPlan->updateAll(array('read_status' => "'U'",'read_type' => "'R'",'modified_date' => '"'.$this->Functions->get_current_date().'"'), array('TskTeamPlan.id' => $this->request->query['id']))){
					
				}				
			}
		}
		$this->render('/Elements/task/reply_task');	
	}
	
	/* get the reply of tasks */
	public function get_task_reply($id){
		$data = $this->TskPlanReply->find('all', array('conditions' => array('tsk_plan_id' => $id), 'fields' => array('desc','TskPlanReply.created_date', 'HrEmployee.first_name'),
		'order' => array('created_date' => 'desc')));
		$this->set('reply_data', $data);
	}
	
	/* function to load the plan types */
	public function load_plan_types(){
		return $plan_types = $this->TskTeamPlan->TskTeamPlanType->find('list', array('fields' => array('id','title'),
		'order' => array('title ASC'),'conditions' => array('is_deleted' => 'N', 'status' => '1')));
	}
	
	/* function to update the read status */
	public function update_read_status(){
		$this->layout = 'ajax';		
		$this->loadModel('TskPlanRead');
		 $this->TskPlanRead->bindModel(
			array('belongsTo' => array(
					'TskTeamPlan' => array(
						'className' => 'TskTeamPlan',
						 'foreignKey' => 'tsk_plan_id'							
					)
				)
			)
		);	
		if($this->TskPlanRead->updateAll(array('status' => "'R'"), array('TskPlanRead.app_users_id' => $this->Session->read('USER.Login.id'), 'TskTeamPlan.type' => $this->request->data['tsk_type'], 'TskTeamPlan.start like' => $this->request->data['date'].'%'))){					
			echo $this->TskPlanRead->getAffectedRows();
		}			
		$this->render(false);
		die;
	}
	
			/* function to update the read status of individual. task */
	public function update_imp_task(){
		$this->layout = 'ajax';	
		// make sure its not empty
		if(!empty($this->request->data['id'])){
			$this->loadModel('TskPlanRead');
			$tag = ($this->request->data['tag'] == '0') ? '1' : '0';
			if($this->TskPlanRead->updateAll(array('is_tag' => '"'.$tag.'"'), array('tsk_plan_id' => $this->request->data['id'], 'app_users_id' => $this->Session->read('USER.Login.id')))){				
				echo $this->request->data['id'];			
			}			
		}	
		$this->render(false);
		die;
	}
	
	
	/* clear the cache */
	
	public function beforeFilter() { 
		//$this->disable_cache();
		$this->set('model_cls', 'TskTeamPlan'); 
		$this->set('model_url', 'tskteamplan');
		$this->show_tabs(58);
		
	}
	
		

	
	
}