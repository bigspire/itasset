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
class HomeController extends AppController {  
	
	public $name = 'Home';	
	
	public $helpers = array('Html', 'Form', 'Session','Functions');
	
	public $components = array('Session', 'Functions');
	
	public $office_start, $office_end;

	/* function to login the employer */
	public function index(){	
		
		//$this->layout = 'default_test';
		// set the page title
		$this->set('title_for_layout', 'Home - My PDCA');				
		// get the today's attendance
		$this->set_today_attendance();		
		
		$this->get_office_time();			
		
		// get the today leave of user
		$today = date('Y-m-d');
		$this->loadModel('HrLeave');
		$today_leave =  $this->HrLeave->get_leave_day($today, $this->Session->read('USER.Login.id'));
		if($today_leave){
			$this->set('NO_ATTENDANCE', 1);
		}		
		// check for tasks updated
		//$next_date = $this->get_next_working();
			
		// attendance approval count in attendance tab
		$this->load_att_approve();
		
		// check l1 or l2
		$lead_count = $this->Home->check_team_mem($this->Session->read('USER.Login.id'), 'L');
		$this->set('is_approver', $lead_count);
		
		// get task count
		if($lead_count > 0){
			$this->loadModel('TskAssign');
			$options = array(		
				array('table' => 'app_users',
					'alias' => 'HrEmployee',					
					'type' => 'LEFT',
					'conditions' => array('`HrEmployee`.`id` = `TskAssign``.`app_users_id`')
				)
			);
			$assign_count = $this->TskAssign->find('count', array( 'conditions' => array('TskAssign.app_users_id' => $this->Session->read('USER.Login.id'),
			'TskAssign.is_deleted' => 'N', 'TskAssign.status' => 'W', 'HrEmployee.status' => '1'),
			'group' => array('TskAssign.id'), 'joins' => $options));
			$this->set('assignByMe', $assign_count);
		}
		// get task assigned to me count
		$this->loadModel('TskTeamAssign');
		$options = array(		
				array('table' => 'tsk_assign_users',
					'alias' => 'TskAssignUser',					
					'type' => 'LEFT',
					'conditions' => array('`TskAssignUser`.`tsk_assign_id` = `TskTeamAssign``.`id`')
				)
			);
		$assign_count = $this->TskTeamAssign->find('count', array( 'conditions' => array('TskAssignUser.app_users_id' => $this->Session->read('USER.Login.id'),
		'TskTeamAssign.is_deleted' => 'N', 'TskTeamAssign.status' => 'W', 'HrEmployee.status' => '1'), 'group' => array('TskTeamAssign.id'), 'joins' => $options));
		$this->set('assignToMe', $assign_count);
	
		// to get the form data
		$news_date_cond = $this->get_news_date();
		/*		
		// get the org. updates
		$this->loadModel('HrOrg');
		$org_data = $this->HrOrg->find('all', array('fields' => array('title','desc'), 'conditions'=> array('HrOrg.is_deleted' => 'N', 'status' => '1'), 'order' => array('created_date' => 'desc')));		
		$this->set('org_data', $org_data);		
		*/
		
		// get new emails
		//$this->get_new_email();
		
		// get dashboard inner tabs
		$todo_count = $this->Home->Todo->find('count', array('conditions' => array('Todo.app_users_id' => $this->Session->read('USER.Login.id'),'is_deleted' => 'N', 'status' => '1')));
		$this->set('todo_count', $todo_count);
		
		// get app notification time
		$notify_data = $this->get_notification();
		
		$this->set_share_count($notify_data[0]['Notification']['modified_date']);
		
		$this->set_roa_share_count($notify_data[6]['Notification']['modified_date']);
		
		$doj = $this->Session->read('USER.Login.doj');
		if(empty($doj)){
			$doj = Configure::read('ATT_START');
		}
		// get latest updates count
		$this->loadModel('HrLatest');
		$news_modified = $notify_data[1]['Notification']['modified_date'];
		$news_modifiedL = $notify_data[5]['Notification']['modified_date'];
		if(empty($news_modified)){
			$news_modified = $doj.' 00:00:00';
		}
		
		$news_count_cond = strtotime($news_date_cond) > strtotime($news_modified) ? $news_date_cond : $news_modified;
 		$news_count = $this->HrLatest->find('count', array('conditions' => array('created_date >' => $news_count_cond, 'status' => '1', 'is_deleted' => 'N', 'news_type' => 'K'))); 
		$this->set('news_count', $news_count);
		// latest news count
		$news_count_cond = strtotime($news_date_cond) > strtotime($news_modifiedL) ? $news_date_cond : $news_modifiedL;
		$news_count = $this->HrLatest->find('count', array('conditions' => array('created_date >' => $news_count_cond, 'status' => '1', 'is_deleted' => 'N', 'news_type' => 'L'))); 
		$this->set('news_latest_count', $news_count);
				
		// get poll updates count
		$this->loadModel('HrPoll');
		$poll_modified = $notify_data[2]['Notification']['modified_date'];
		if(empty($poll_modified)){
			$poll_modified = $doj.' 00:00:00';
		}
		$poll_count = $this->HrPoll->find('count', array('conditions' => array('created_on >' => $poll_modified,'HrPoll.status' => '1', 'HrPoll.is_deleted' => 'N'), 'group' => array('HrPoll.id'))); 
		$this->set('poll_count', $poll_count);
		
		// get gallery updates count
		$this->loadModel('HrGallery');
		$gal_modified = $notify_data[3]['Notification']['modified_date'];
		if(empty($gal_modified)){
			$gal_modified = $doj.' 00:00:00';
		}
		$gal_count_cond = strtotime($news_date_cond) > strtotime($gal_modified) ? $news_date_cond : $gal_modified;
		$gal_count = $this->HrGallery->find('count', array('conditions' => array('HrGallery.created_date >' => $gal_count_cond, 'HrGallery.is_approve' => 'Y'), 'group' => array('HrGallery.id'))); 
		$this->set('gal_count', $gal_count);
		
		// get docs count
		$this->loadModel('HrForm');
		$doc_modified = $notify_data[4]['Notification']['modified_date'];
		if(empty($doc_modified)){
			$doc_modified = $doj.' 00:00:00';
		}
		$doc_cond = array('OR' => array(array( 'HrForm.created_date >' => $doc_modified), array( 'HrForm.modified_date >' => $doc_modified)) ) ;
		$doc_count = $this->HrForm->find('count', array('conditions' => array($doc_cond, 'HrForm.status' => '1', 'HrForm.is_deleted' => 'N'), 'group' => array('HrForm.id'))); 
		$this->set('doc_count', $doc_count);
		
		$this->loadModel('TskEvent');
		$data = $this->TskEvent->find('count', array('conditions' => array('app_users_id' => $this->Session->read('USER.Login.id'), 'TskEvent.is_deleted' =>  'N','start >= ' =>  date('Y-m-d H:m')),
		'order' => array('start' => 'asc'), 'limit' => 10));	
		$this->set('event_count', $data);
		
		// generate daily planning report
		$chart_date = $this->generate_chart_date();

		$this->gen_planning_chart($chart_date);
		// generate plan status report
		//$this->gen_plan_status_chart($chart_date);
		
		$this->gen_plan_overview_chart();
		
		// notify alert box	
		$this->Home->unBindModel(array('hasOne' => array('Todo'), 'belongsTo' => array('HrDesignation','HrBusinessUnit','HrBloodGroup','HrBranch','HrDepartment','HrCompany')));
		$data = $this->Home->find('all', array('fields' => array('notify_user', 'create_notify'), 'conditions' => array('Home.id' => $this->Session->read('USER.Login.id'))));
		if(!$data[0]['Home']['notify_user']){
			$this->Session->write('USER.Login.notify_user', 0);
		}
		
		// get survey details
		$options = array(	
			array('table' => 'hr_survey_user',
					'alias' => 'SurveyUser',					
					'type' => 'Left',
					'conditions' => array('`SurveyUser`.`hr_survey_id` = `HrSurvey`.`id`',
					'`SurveyUser`.`app_users_id`' => $this->Session->read('USER.Login.id'))
			)
		);
		$this->loadModel('HrSurvey');
		$data = $this->HrSurvey->find('all', array('fields' => array('HrSurvey.id'), 'conditions' => array('end_date >=' => date('Y-m-d'),'start_date <=' => date('Y-m-d'), 'is_deleted' => 'N', 'status' => 1,'SurveyUser.hr_survey_id' => NULL), 'order' => array('HrSurvey.created_date' => 'desc'), 'group' => array('HrSurvey.id'), 'joins' => $options));
		$this->set('notify_survey', count($data));
		
		// get new messages
		$this->loadModel('HrMessage');
		$showCond = $lead_count == 0 ? array('show_type' => 'A') : '';
		$data = $this->HrMessage->find('all', array('fields' => array('id','display_type', 'title', 'desc', 
		'start_day','end_day','start_date', 'end_date'), 'conditions' => array($showCond,'status' => '1','is_deleted' => 'N'),'order' => array('created_date' => 'asc')));		
		$new_data = $this->check_valid_message($data);
		$this->set('message_data', $new_data);
		$this->set('count_message', count($new_data));
		// get voice details
		$options = array(	
			array('table' => 'hr_voice_user',
					'alias' => 'VoiceUser',					
					'type' => 'Left',
					'conditions' => array('`VoiceUser`.`hr_voice_id` = `HrVoice`.`id`',
					'`VoiceUser`.`app_users_id`' => $this->Session->read('USER.Login.id'))
			)
		);
		$this->loadModel('HrVoice');
		$data = $this->HrVoice->find('count', array('conditions' => array('end_date >=' => date('Y-m-d'),'start_date <=' => date('Y-m-d'), 'is_deleted' => 'N', 'status' => 1,'VoiceUser.hr_voice_id' => NULL),'joins' => $options));
		$this->set('notify_voice', $data);
		
		// get it module count
		$this->loadModel('Permission');
		$it_modules = $this->Permission->find('all', array('conditions' => array('app_modules_id' => array('115','103','104','105','106','107','108','109',
		'110','111','112','118','114','119'), 'app_roles_id' => $this->Session->read('USER.Login.app_roles_id')),	'fields' => array('Module.module_name')));
		$this->set('IT_COUNT', count($it_modules));
		
		$it_assign_count = $this->Home->get_it_assign_count($this->Session->read('USER.Login.app_roles_id'));
		$this->set('IT_ASSIGN_COUNT', $it_assign_count);

		
	}
	
	/* function to show the message */
	public function show_message($id){
		$this->layout = 'iframe';
		$this->loadModel('HrMessage');
		$data = $this->HrMessage->findById($id, array('fields' => 'title', 'desc','attachment'));		
		$this->set('message_data', $data);
	}
	
	/* check its a valid message */
	public function check_valid_message($data){
		foreach($data as $record){
			$valid = false;
			switch($record['HrMessage']['display_type']){
				case 'M':
				$valid = $this->check_valid_date($record['HrMessage']['start_day'],$record['HrMessage']['end_day']);
				break;
				case 'N':
				$valid = $this->check_valid_days($record['HrMessage']['start_date'],$record['HrMessage']['end_date']);
				break;
			}
			
			if($valid){
				$new_data[] = $record;
			}
		}
		return $new_data;
	}
	
	function check_valid_date($start, $end){
		if(date('d') >= $start && date('d') <= $end){ 
			return true;
		}
	}
	
	/* function to check valid days */
	function check_valid_days($start, $end){
		if(date('Y-m-d') >= $start && date('Y-m-d') <= $end){ 
			return true;
		}
	}
	
	/* function to generate plan status chart */
	public function gen_plan_status_chart($chart_date){
		$status = $this->Home->status_chart($chart_date, $this->Session->read('USER.Login.id'));
		$this->set('statusChart', $status);
	}
	
	/* function to generate plan overview status chart */
	public function gen_plan_overview_chart(){
		$status = $this->Home->overall_chart($this->Session->read('USER.Login.id'), 'M');		
		$this->set('overallmChart', $status);
		$status = $this->Home->overall_chart($this->Session->read('USER.Login.id'), 'Y');
		$this->set('overallyChart', $status);
	}
	
	/* function to generate planning report */
	public function gen_planning_chart($chart_date){
		$chart_date = $this->generate_chart_date();
		$percent = $this->Home->planned_hr($chart_date, $this->Session->read('USER.Login.id'));
		$this->set('plannedHr', $percent);
	}
	
	/* function to generate the daily plan chart dates */
	public function generate_chart_date(){
		$chart_date[] = date('Y-m-d', strtotime('-2 days'));
		$chart_date[] = date('Y-m-d', strtotime('-1 days'));
		$chart_date[] = date('Y-m-d');
		$chart_date[] = date('Y-m-d', strtotime('+1 days'));
		$chart_date[] = date('Y-m-d', strtotime('+2 days'));
		$this->set('chartDate', $chart_date);
		return $chart_date;
	}
	
	/* function to show the home page tasks */
	public function load_ajax_task(){
		
	}
	
	/* function to show the org chart */
	public function org_chart(){
		$this->layout = 'iframe';
		$this->generate_org_tree();
	}
	
	/* function generate org. structure */
	public function generate_org_tree(){
		$this->loadModel('Approve');
		$options = array(
				array('table' => 'app_users',
					'alias' => 'Home',					
					'type' => 'LEFT',
					'conditions' => array('`Approve`.`app_users_id` = `Home`.`id`')
				),
				array('table' => 'hr_designation',
					'alias' => 'HrDesignation',					
					'type' => 'LEFT',
					'conditions' => array('`Home`.`hr_designation_id` = `HrDesignation`.`id`')
				),
				array('table' => 'app_users',
					'alias' => 'tbl_level1',					
					'type' => 'LEFT',
					'conditions' => array('`Approve`.`level1` = `tbl_level1`.`id`')
				),
				array('table' => 'app_users',
					'alias' => 'tbl_level2',					
					'type' => 'LEFT',
					'conditions' => array('`Approve`.`level2` = `tbl_level2`.`id`')
				)
			);
		$this->Approve->virtualFields = array('first' => 'first', 'l1_first' => 'l1_first', 'l2_first' => 'l2_first');
		$data = $this->Approve->find('all', array('conditions' => array('Approve.type' => 'T', 'Home.is_deleted' => 'N', 'Home.status' => '1'), 'fields' => array('Home.first_name as first','Home.last_name as last',
		'tbl_level1.first_name as l1_first', 'tbl_level1.last_name as l1_last','HrDesignation.desig_name'),'joins' => $options));
		$this->set('org_tree_data', $data);
		
	}
	
	/* function to get news date condition */
	public function get_news_date(){
		return date('Y-m-d', strtotime('-30 days'));
	}
	
	
	
	/* function to get office time */
	public function get_office_time(){
		// get attendance grace time
		$this->loadModel('HrOfficeTiming');
		$office_timing = $this->HrOfficeTiming->find('all', array('fields' => array('start_time', 'end_time', 'grace_time'),'conditions' => array('app_users_id' => $this->Session->read('USER.Login.id')), 'limit' => '1'));
		$end_time = $office_timing[0]['HrOfficeTiming']['end_time'];
		$start_time = $office_timing[0]['HrOfficeTiming']['start_time'];
		if(!empty($start_time)){		
			$minutes = $this->Functions->check_grace(date('Y-m'),$office_timing[0]['HrOfficeTiming']['grace_time'], 'Y-m');
			$time = strtotime('2014-05-16 '.$start_time);
			$time += 60 * $minutes;
			$this->set('office_time', date('H:i', $time));
			// set office out time
			$out_time = strtotime('2014-05-16 '.$end_time);
			$this->set('office_out_correct_time', date('H:i', $out_time));
			// add half and hour for late working
			$out_time += 60 * 30;
			$this->set('office_out_time', date('H:i', $out_time));			
		}else{ 
			$this->set('office_time', '09:45');
			$this->set('office_out_correct_time', '18:30');
			$this->set('office_out_time', '19:00');
			$this->set('today_permission', 0);
		}
		
		// get any permissions
		$this->loadModel('HrPermission');
		$start_time = $start_time ? $start_time : '09:30'; 
		$this->HrPermission->unBindModel(array('hasOne' => array('HrPerStatus', 'HrPerUser'), 'belongsTo' => array('Home')));
		$data = $this->HrPermission->find('all', array('fields' => array('no_hrs'), 'conditions' => array('HrPermission.app_users_id' =>
		$this->Session->read('USER.Login.id'), 'per_date' => date('Y-m-d'), 'per_from like' => '%'.$start_time.'%', 'HrPermission.is_deleted' => 'N', 'is_approve' => 'Y'), 'limit' => 1));
		if(!empty($data)){	
			$permission = $data[0]['HrPermission']['no_hrs'];
			$per_val = explode(':', $permission);
			$per_hr = $per_val[0];
			$per_min2 = ($per_hr == '01' ? '60' : ($per_hr == '02' ? '120' : '0'));
			$per_min = $per_val[1];
			$time = strtotime('2014-05-16 '.$start_time);
			// add minutes
			$time += 60 * $per_min;
			// add mins. in the hour.
			$time += 60 * $per_min2;				
			$this->set('office_time', date('H:i', $time));
			$this->set('today_permission', 1);
		}
		// for out time permission check
		$end_time = $end_time ? $end_time : '18:30'; 
		$this->HrPermission->unBindModel(array('hasOne' => array('HrPerStatus', 'HrPerUser'), 'belongsTo' => array('Home')));
		$data = $this->HrPermission->find('all', array('fields' => array('no_hrs'), 'conditions' => array('HrPermission.app_users_id' => $this->Session->read('USER.Login.id'), 'per_date' => date('Y-m-d'), 'per_from >' => '15:59', 'HrPermission.is_deleted' => 'N', 'is_approve' => 'Y'), 'limit' => 1));
		if(!empty($data)){
			$permission = $data[0]['HrPermission']['no_hrs'];
			$per_val = explode(':', $permission);
			$per_hr = $per_val[0];
			$per_min2 = ($per_hr == '01' ? '60' : ($per_hr == '02' ? '120' : '0'));
			$per_min = $per_val[1];
			$outtime = strtotime('2014-05-16 '.$end_time);
			// sub minutes
			$outtime -= 60 * $per_min;
			// sub mins. in the hour.
			$outtime -= 60 * $per_min2;
			$this->set('office_out_per_time', date('H:i', $outtime));
			$this->set('office_out_correct_time', date('H:i', $outtime));
			$this->set('out_permission', 1);
		}
	}
	
	/* function to update the view task */
	public function update_view_task($id){
		$this->loadModel('HrAttendance');
		$this->HrAttendance->id = $id;
		$this->HrAttendance->saveField('task_view', '1');
		$this->render(false);
		die;
	}
	
	/* function to update att. status */
	public function update_att_status(){
		$this->layout = 'iframe_dash';	
		// update the attendance
		$this->loadModel('HrAttendance');
		if(trim($this->request->data['value']) != ''){
			$reasonField = 'reject_reason';
			$reason_data = trim($this->request->data['value']);
		}
		$this->HrAttendance->id = $this->request->query['id'] ? $this->request->query['id'] : $this->request->data['pk'];
		$status = $this->request->query['status'] ? 'A' : 'R';
		$data = array($reasonField => $reason_data, 'status' => $status, 'approve_date' => $this->Functions->get_current_date(), 'approve_by' => $this->Session->read('USER.Login.id'));
		// save the att
		if($this->HrAttendance->save($data, true, $fieldList = array('status', 'approve_date','approve_by',$reasonField))){			
			echo $this->HrAttendance->id;
			die;
		}		
		$this->render(false);		
	}
	
	
	
	
	
	/* function to load att. approve */
	public function load_att_approve($action){
			// check l1 or l2
		$this->loadModel('HrLeave');
		$emp_list = $this->Home->get_team($this->Session->read('USER.Login.id'), 'L');	
		if(!empty($emp_list)){
			$this->set('apprv_att', 1);
			foreach($emp_list as $emp){
				$tm .= $emp['u']['id'].',';
			}
			$tm = substr($tm,0,strlen($tm)-1);			
			// get all waiting attendance for approval
			$att_st_data = $this->Home->get_tm_att($tm, $action);
						
			$this->set('att_st_data', $att_st_data);
			$this->set('appr_count', count($att_st_data));
			
		}
		// get employee on leave
		if($action == 'view'){
			// iterate the users
			$i = 0;
			foreach($emp_list as $emp){ 
				$id =  $emp['u']['id'];
				$cond =  array('and' => array(
                        array('leave_from <= ' => date('Y-m-d'),
                              'leave_to >= ' => date('Y-m-d')
                             )
						)
				);

				$leave = $this->HrLeave->find('count', array('conditions' => array('HrLeave.app_users_id' => $id,
				'is_approve !=' => 'R', $cond)));
				if($leave > 0){
					$user .= $emp['u']['first_name'].' '.$emp['u']['last_name'].'<br>';
					$i++;
				}
				
			}
			$this->set('total_leave', $i);
			$this->set('leave_user', $user);
		}
		
	}
	
	
	/* function to update task comment */
	public function tsk_comment(){
		$this->layout = 'iframe_dash';	
		// update the attendance
		$this->loadModel('TskPlanReply');
		$data = array('tsk_plan_id' => $this->request->data['pk'], 'desc' => $this->request->data['value'],  'created_date' => $this->Functions->get_current_date(), 'app_users_id' => $this->Session->read('USER.Login.id'));
		// save the att
		if($this->TskPlanReply->save($data, false)){	
			// update unread status
			$this->loadModel('TskPlan');
			if($this->TskPlan->updateAll(array('read_status' => "'U'",'read_type' => "'R'",'modified_date' => '"'.$this->Functions->get_current_date().'"'), array('TskPlan.id' => $this->request->data['pk']))){
				echo $this->request->data['pk'];					
			}			
		}
		die;
		$this->render(false);
	}
	
	
	
	/* function to update waive att. status */
	public function waive_attendance(){
		$this->layout = 'iframe_dash';	
		// update the attendance
		$this->loadModel('HrAttendance');		
		$this->HrAttendance->id = $this->request->data['pk'];
		$data = array('waive_msg' => trim($this->request->data['value']), 'att_waive' => '1');
		// save the att
		if($this->HrAttendance->save($data, true, $fieldList = array('waive_msg', 'att_waive'))){			
			echo $this->HrAttendance->id;
			die;
		}
		$this->render(false);		
	}
	
	
	/* function to get notification */
	public function get_notification(){
		$this->loadModel('Notification');
		$notify_data = $this->Notification->find('all', array('fields' => array('notify', 'modified_date'), 'conditions' => array('app_users_id' => $this->Session->read('USER.Login.id')), 'order' => array('id' => 'asc')));
		return $notify_data;
	}
	
	/* function to approve attendance */
	public function verify_att(){
		$this->layout = 'iframe_dash';
		// get att. members
		$this->load_att_approve();
	}
	
	/* function to view the daily tasks of user */
	public function view_task($id, $date){
		$this->layout = 'iframe_dash';
		// get employee tasks
		$this->employee_task($id, $date);
	}
	
	/* function to load the employee tasks */
	public function employee_task($id, $date){
		// get the employee name
		$this->loadModel('HrEmployee');
		$data = $this->HrEmployee->findById($id, array('fields' => 'first_name', 'last_name'));
		$this->set('emp_data', $data);
		$this->loadModel('TskPlan');
		$task_date = date('Y-m-d', strtotime($date));
		$data = $this->TskPlan->find('all', array('fields' => array('TskPlan.id','start','end','title','desc','TskPlanType.title','status'),
		'conditions' => array('TskPlan.app_users_id' => $id, 'start like' => $task_date.'%'), 'order' => array('start' => 'asc')));
		$this->set('task_data', $data);
		
	}
	
	
	/* function to view the reportees's attendance */
	public function team_att(){
		$this->layout = 'iframe_dash';
		// get att. members
		$this->load_att_approve('view');
	}
	
	/* function to set share count */
	public function set_share_count($modified){
		// get share count
		$last_day = $this->share_start();
		$today = $this->share_end();
		$doj = $this->Session->read('USER.Login.doj');
		// get from day
		if(!empty($modified)){
			$last_day = $modified;
		}elseif(strtotime($doj.' 00:00:00') > strtotime($last_day)){
			$last_day = $doj;
		} 
		
     	$total = $this->Home->get_share_count($this->Session->read('USER.Login.id'),$today, $last_day);
		$this->set('share_count', $total);
		return $total;
	}
	
	
	/* function to set roa share count */
	public function set_roa_share_count($modified){
		// get share count
		$last_day = $this->share_start();
		$today = $this->share_end();
		$doj = $this->Session->read('USER.Login.doj');
		// get from day
		if(empty($modified)){
			//$last_day = date('Y-m-d H:i:s', strtotime('-1 year'));
			$last_day = $doj;
		}else if(!empty($modified)){
			$last_day = $modified;
		}elseif(strtotime($doj.' 00:00:00') > strtotime($last_day)){
			$last_day = $doj;
		} 
		
     	$total = $this->Home->get_share_count($this->Session->read('USER.Login.id'),$today, $last_day, 'roa');
		$this->set('roa_share_count', $total);
		return $total;
	}
	
	/* function to store att. reason */
	public function att_reason(){
		$this->layout = 'ajax';
		// check out reason
		$out_reason = explode('-', $this->request->data['pk']);
		if($out_reason[0] == 'outPerm'){
			$this->request->data['type'] = 'out';		
			$this->request->data['out_permission'] = $out_reason[1];
			$this->request->data['out_reason_type'] = $out_reason[2];			
		}else{
			$this->request->data['type'] = 'in';		
			$this->request->data['is_permission'] = $this->request->data['pk'];
		}
		// mark attendance
		$this->mark_attendance();
		// send mail to HR	
		//$this->notify_hr($reason);
		$this->render(false);
	}
	
	/* function to notify finance */
	public function notify_hr($reason){
		$hr_data = $this->Home->find('all', array('fields' => array('id','email_address', 'first_name','last_name'), 'conditions' => array('hr_department_id' => '14')));		
		// iterate finance team
		foreach($hr_data as $hr){	
			// check the same user
			if($this->Session->read('USER.Login.id') != $hr['Home']['id']){
				$sub = 'My PDCA - '.ucfirst($this->Session->read('USER.Login.first_name')).' '.ucfirst($this->Session->read('USER.Login.last_name')).' submitted late attendance request!';
				$template = 'late_attendance';
				$from = ucfirst($this->Session->read('USER.Login.first_name')).' '.ucfirst($this->Session->read('USER.Login.last_name'));
				$name = $hr['Home']['first_name'].' '.$hr['Home']['last_name'];
					
				$vars = array('from_name' => $from, 'name' => $name, 'reason' => $reason, 'att_date' => date('d-M-Y'));
					
				// notify superiors						
				if(!$this->send_email($sub, $template, 'noreply@mypdca.in', $hr['Home']['email_address'],$vars)){	
					// show the msg.								
					$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in sending the mail to hr..', 'default', array('class' => 'alert alert-error'));		
				}
			}
		}
	}
	
	/* function to set today attendance */
	public function set_today_attendance(){
		$this->Home->unbindModel(array('hasOne' => array('Todo')));
		$this->loadModel('HrAttendance');
		$att_data = $this->HrAttendance->find('all', array('fields' => array('in_time','out_time'), 'conditions' => array('app_users_id' => $this->Session->read('USER.Login.id'), 'in_time like' => date('Y-m-d').'%'), 'limit' => 1)); 
		$this->set('att_data', $att_data);
	}
	
	/* load users share */
	public function load_share(){ 
		// fetch share data
		$this->layout = 'scroll';		
		$this->get_users_share($_POST['type']);		
		
	}
	
	
	
	/* auto refresh */
	public function auto_refresh(){			
		$this->layout = 'refresh';			
		echo $this->get_notifications();
		$this->render(false);
		die;
	}
	
	
	/* function to update the clock */
	public function update_clock(){
		$this->layout = 'refresh';
		echo date('h:i a');
		$this->render(false);
		die;
		
	}
	
	
	/* function to check att. in timer */
	public function check_att_intime(){
		$this->layout = 'refresh';	
		$this->set_today_attendance();
		$this->get_office_time();
		
	}
	
	
	
	/* function to show all share users */
	public function share_user(){
		$this->layout = 'iframe_dash';
		$this->Home->unbindModel(array('hasOne' => array('Todo')));
		$data = $this->Home->find('all', array('fields' => array('id','full_name', 'HrDepartment.dept_name', 'HrDesignation.desig_name', 'photo','photo_status'), 'conditions' => array('Home.is_deleted' => 'N', 'Home.status' => '1'), 'group' => array('Home.id')));
		$this->set('member_data', $data);
		
		
	}
	
	/* function to show the selected tags */
	public function share_tag(){	
		$this->layout = 'refresh';	
		$this->Home->unbindModel(array('hasOne' => array('Todo')));
		$exp_id = explode('_', $this->request->query['id']);
		foreach($exp_id as $id){
			if(intval($id)){
				$data[] = $this->Home->findById($id, array('fields' => 'first_name'));		
			}
		}		
		$this->set('select_data', $data);
	}
	
	
	
	/* function to show the tasks */
	public function show_task(){
		$this->layout = 'refresh';
		
		// get the tasks
		$data = $this->get_my_tasks();
		header('Content-type: text/json');
		date_default_timezone_set('Asia/Calcutta');
		// get office timing for project task time
		$this->loadModel('HrOfficeTiming');
		$office_timing = $this->HrOfficeTiming->find('all', array('fields' => array('start_time', 'end_time'),'conditions' => array('app_users_id' => $this->Session->read('USER.Login.id')), 'limit' => '1'));
		$this->office_start = $office_timing[0]['HrOfficeTiming']['start_time'];
		$this->office_end = $office_timing[0]['HrOfficeTiming']['end_time'];
		

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
				//$this->print_empty_json();
			}

		echo ']';		
		$this->render(false);
		die;	
		
	}
	
	/* function to get my tasks */
	public function get_my_tasks(){		
		$today = date('Y-m-d'); 
		$start = date('Y-m-01');
		$end = date('Y-m-31');
		$end = date('Y-m-d', strtotime($end. '+1 days'));
		$dateCond = array('or' => array('start between ? and ?' => array($start, $end),'end between ? and ?' => array($start, $end)));	
		// read status condition		
		$fields = array('id','created_date','title','type','desc','start','end','status');
		$this->loadModel('TskPlan');
		// fetch the task plans		
		$data = $this->TskPlan->find('all', array('fields' => $fields,	'conditions' => array($dateCond,'TskPlan.app_users_id' => $this->Session->read('USER.Login.id'),'TskPlan.is_deleted' => 'N'), 'order' => array('TskPlan.start' => 'asc'),	'group' => array('TskPlan.id')));

		return $data;
	
	}
	
	/* function to print json */
	public function print_json($rec, $default_start){
				
		$desc_limit = 100;
				
		// for long desc
		$desc_len = strlen($rec['TskPlan']['desc']);
		$more_display = ($desc_len > $desc_limit) ? '' : 'dn';
		$long_desc = ($desc_len > $desc_limit) ? $rec['TskPlan']['desc'] : '';
		$short_desc = $this->Functions->string_truncate($rec['TskPlan']['desc'], $desc_limit);
		// replace new lines
		$short_desc =  $this->Functions->remove_spl_char($short_desc);
		$long_desc =  $this->Functions->remove_spl_char($long_desc);
				
				echo '{ "date": "'; echo date('Y-m-d 23:59:59', strtotime($rec['TskPlan']['start'])); echo '" ,
				"title": "<a href='; echo $this->webroot.'tskplan/?type='.$rec['TskPlan']['type'].'&date='.date('j-F', strtotime($rec['TskPlan']['start'])); echo ' class=\"tsk_title\">'; echo $this->Functions->string_truncate(ucfirst($this->Functions->remove_spl_char($rec['TskPlan']['title'])), 50); echo '</a>'; echo  '",
				"start_time": "'; echo $this->check_plan_type($default_start,$rec['TskPlan']['type'], 'start'); echo '",
				"end_time": "'; echo $this->check_plan_type($rec['TskPlan']['end'], $rec['TskPlan']['type'], 'end'); echo '",
				"description": "<span class=desc_less> '; 
				echo ucfirst($short_desc);
				echo '</span>'; echo '",
				"status": "<span class=\"label '; echo $this->Functions->show_task_status_color($rec['TskPlan']['status']); echo '\">'; echo $this->Functions->show_task_status($rec['TskPlan']['status']);  echo '</span>",
				"plan_type": "<span>'; echo $this->Functions->show_plan_type($rec['TskPlan']['type']); echo '</span>",
				"url" : "","read_status": "'; echo $rec['TskPlan']['read_status']; echo '","plan_date": "'; echo $this->Functions->format_date($default_start); echo '"}';
	}
	
	/* function to show date */
	public function check_plan_type($date, $plan_type, $type){
		if($plan_type == 'D'){ 
			$result = $this->Functions->show_task_time($date, $plan_type);
		}else{
			$this->office_start = $this->office_start == '' ? '09:30' : $this->office_start;
			$this->office_end = $this->office_end == '' ? '18:30' : $this->office_end;
			$result = $type == 'start' ? $this->office_start : $this->office_end;	
			$result =   date('h:i A', strtotime($result));
		}
		return $result;
	}
	
	/* to sort the members in tab */
	public function sort_by(){	
		$this->layout = 'ajax';	
		$this->Home->unbindModel(array('hasOne' => array('Todo')));
		if($this->request->query['type'] == 'dept'){
			$order =  array('HrDepartment.dept_name' => 'asc','Home.first_name' =>  'asc');
		}else if($this->request->query['type'] == 'branch'){
			$order =  array('HrBranch.branch_name' =>  'asc','Home.first_name' =>  'asc');
		}else if($this->request->query['type'] == 'bus_unit'){
			$order =  array('HrBusinessUnit.business_unit' =>  'asc','Home.first_name' =>  'asc');
		}else{
			$order =  array('Home.first_name' =>  'asc');
		}
		$data = $this->Home->find('all', array('fields' => array('id','HrBusinessUnit.business_unit','HrBusinessUnit.id', 'HrBranch.branch_name', 'HrDesignation.id', 
		'HrDepartment.id','gender','first_name', 'email_address','last_name', 'photo','HrDepartment.dept_name','HrDesignation.desig_name',
		'official_contact_no','photo_status'), 'order' => $order, 'conditions' => array('Home.is_deleted' => 'N', 'Home.status' => '1')));	
		$this->set('member_data', $data);	
		$this->set('headerType', $this->request->query['type']);
		$this->set('ajax_req', 1);	
		
		$this->render('/Elements/sort_by');
		
	}
	
	
	/* to sort the members in tab 
	public function show_by(){	
		$this->layout = 'ajax';	
		$this->Home->unbindModel(array('hasOne' => array('Todo')));		
		// get the attendance of the user
		$this->loadModel('HrAttendance');
		$att_data = $this->HrAttendance->find('all', array('fields' => array('in_time', 'out_time','status','reject_reason'), 'conditions' => array('app_users_id' => $this->Session->read('USER.Login.id'), 'in_time like' => $this->request->query['month'].'%'), 'order' => array('in_time' => 'asc'))); 
		$this->set('selMonth', $this->request->query['month']);
		$this->set('all_att_data', $att_data);	
		// load leave types
		$this->load_leave_types($this->Session->read('USER.Login.gender'), $this->Session->read('USER.Login.id'));		
		// get leaves remaining
		$year  = explode('-', $this->request->query['month']);
		$this->get_used_leaves($this->Session->read('USER.Login.id'));
		// get used permissions
		$this->get_used_perms($this->request->query['month'],$this->Session->read('USER.Login.id'));
		// get the leaves of the user
		$this->get_applied_leaves($this->request->query['month'], $this->Session->read('USER.Login.id'));
		// get the comp off days of user
		$this->get_compoff_details($this->Session->read('USER.Login.id'));
		// get holidays of this month
		$this->get_holidays_month($this->request->query['month']);		
		$this->render('/Elements/attendance');
		
	}*/
	
	/* function to sort todo list */
	public function sort_todo(){
		$this->layout = 'refresh';
		foreach($this->request->data['sort'] as $key => $id){
			$this->Home->Todo->id = $id;
			$this->Home->Todo->saveField('sort_order', ++$key);
		}
		$this->render(false);
	}
	
	/* to update the photo */
	public function change_photo(){
		$this->layout = 'ajax';	
		// check form posted
		if($this->request->is('post')){
			// validate the file
			if($this->Functions->validate_img($_FILES['file']['type'], $_FILES['file']['size'])){
				// save the photo
				$this->Home->id = $this->Session->read('USER.Login.id');
				$this->Home->saveField('photo', $this->Session->read('USER.Login.id').'_'.$_FILES['file']['name']);
				// upload the photo
				$src = $_FILES['file']['tmp_name'];
				$dest = 'uploads/photo/'.$this->Session->read('USER.Login.id').'_'.$_FILES['file']['name'];
				if($this->Functions->upload_file($src, $dest)){
					echo $this->webroot.'timthumb.php?src='.$dest.'&h=160&q=100';
					// update user table
					$this->Home->saveField('photo_status', 'W');
					// notify hr
					$sub = 'My PDCA - '.ucfirst($this->Session->read('USER.Login.first_name')).' '.	ucfirst($this->Session->read('USER.Login.last_name')).' updated profile photo!';
					$this->send_mail_hr($sub,'photo_updation');
			}else{
				echo 'upload_error';
				}
			}
		}
		die;
	}
	
	public function send_mail_hr($sub,$template){
		// intimate hr 					
		$approval_data = $this->Home->find('all', array('fields' => array('email_address', 'first_name', 'last_name'), 'conditions'=> array('Home.hr_department_id' => '14', 'Home.status' => '1'), 'group' => array('Home.id')));
		foreach($approval_data as $hr_data){
			$vars = array('from_name' => ucfirst($this->Session->read('USER.Login.first_name')).' '.ucfirst($this->Session->read('USER.Login.last_name')),'name' => $hr_data['Home']['first_name'].' '.$hr_data['Home']['last_name']);
			// notify hr in email						
			if(!$this->send_email($sub, $template, 'noreply@mypdca.in', $hr_data['Home']['email_address'],$vars)){	
			// show the msg.								
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in sending the mail...', 'default', array('class' => 'alert alert-error'));				
		}else{
								
			}
		}
	}
	

		
	
	
	/* function to validate the file */
	public function validate_file($type, $size){ 
		$process = true;
		// validate type
		if($type != 'image/jpeg' &&  $type != 'image/jpg' &&  $type != 'image/gif' && $type != 'image/png' && $type != 'application/octet-stream' && $type != 'application/pdf'  && $type != 'application/vnd.openxmlformats-officedocument.wordprocessingml.document' && $type != 'text/plain' && $type != 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' && $type != 'application/vnd.ms-excel'){
			echo 'file_type_error';
			$process = false;
			die;
		}else if($size == 0 || $size > 1024000){
			echo 'file_size_error';
			$process = false;
			die;
		}
		
		return $process;
	}
	
	

	/* function to download the file */
	public function download_share($file){		
		$this->download_file(WWW_ROOT.'/uploads/share/'.$file);
		die;
		
	}

	
	/* function to mark the attendance */
	public function mark_attendance(){
		$this->layout = 'ajax';
		// make sure form submitted			
		if($this->request->is('post')){
			// if joined today
			$validation = 1;
			if($this->Session->read('USER.Login.doj') == date('Y-m-d') && $this->request->data['type'] == 'in'){
				// do nothing
				$validation = 0;
			}
			$this->loadModel('HrAttendance');
			if($validation == '1' && $this->request->data['type'] == 'in'){
				// check attendance marked in the last working day
				$date = $this->get_last_working();
				$last_att = $this->HrAttendance->find('first', array('conditions' => array('in_time like' => $date.'%', 'out_time like' => $date.'%', 'app_users_id' => $this->Session->read('USER.Login.id'))));
				if(empty($last_att)){
					// check leave request 
					$this->loadModel('HrLeave');
					$leave_cond = array('leave_from <=' => $date, 'leave_to >=' => $date);
					$leave_count = $this->HrLeave->find('count', array('conditions' => array('HrLeave.app_users_id' => $this->Session->read('USER.Login.id'),
					'HrLeave.is_deleted' => 'N', $leave_cond)));
					// check att. change
					$this->loadModel('HrAttChange');
					$att_change_count = $this->HrAttChange->find('count', array('conditions' => array('HrAttChange.app_users_id' => $this->Session->read('USER.Login.id'),
					'att_date' => $date)));
					// get happy leaves
					$happy_data = $this->get_happy_leave($this->Session->read('USER.Login.id'));
					$exp_happy_dob = explode('-', $happy_data[0]);
					$exp_happy_wedding = explode('-', $happy_data[1]);
					$from_split = explode('-', $date);
					if($leave_count == 0 && $att_change_count == 0 && $from_split[1].$from_split[2] != $exp_happy_dob[1].$exp_happy_dob[2]
						&& $from_split[1].$from_split[2] != $exp_happy_wedding[1].$exp_happy_wedding[2]){
						echo 'no_attendance||'.date('d-M-Y', strtotime($date));
						die;
					}
				}
			}
			
			// for today task condition 
			if($validation == '1' && $this->request->data['type'] == 'in'){
				$percent = $this->Home->get_today_planned(date('Y-m-d'), $this->Session->read('USER.Login.id'));
				// if no tasks plans
				if(empty($percent)){
					echo 'no_plan';
					die;
				}elseif($percent < 37){ 
					echo 'less_plan';
					die;
				}
			}
			
			// for out time task checking
			if($this->request->data['type'] == 'out'){
				$percent = $this->Home->get_today_planned(date('Y-m-d'), $this->Session->read('USER.Login.id'));
				// if no tasks plans
				if(empty($percent)){
					echo 'no_plan';
					die;
				}elseif($percent < 80){
					echo 'less_plan';
					die;
				}elseif($this->Home->get_today_planned(date('Y-m-d'), $this->Session->read('USER.Login.id'), 1) != ''){
					echo 'pending_plan';
					die;
				}				
			}
			$field = trim($this->request->data['type']) == 'in' ?  'in_time' : 'out_time';
			// save is permission for only mark intime
			if($this->request->data['type'] == 'in'){
				$perm_field = 'is_permission';
				$per_data = trim($this->request->data['pk']);
			}
			if(trim($this->request->data['value']) != '' && $this->request->data['type'] == 'in'){
				$reasonField = 'late_reason';
				$reason_data = trim($this->request->data['value']);
			}else{
				$reasonField = 'out_reason';
				$reason_data = trim($this->request->data['value']);
				$reason_out_Field = 'out_reason_type';
				$reason_out_data = trim($this->request->data['out_reason_type']);
				$out_permission = 'out_permission';
				$out_permission_data = trim($this->request->data['out_permission']);
			}
			// if not marked
			if(!$this->check_already_marked($field)){
				$data = array($field => $this->Functions->get_current_date(), 'app_users_id' => $this->Session->read('USER.Login.id'), 
				$reasonField => $reason_data, $perm_field => $per_data, $reason_out_Field => $reason_out_data, $out_permission => $out_permission_data);				
				// get record for out time
				if($field  == 'out_time'){
					$att_data = $this->HrAttendance->find('all', array('fields' => array('id','in_time'), 'conditions' => array('app_users_id' => $this->Session->read('USER.Login.id'), 'in_time like' => $this->Functions->format_cktime($data[$field]).'%'), 'limit' => 1)); 
					// if intime not marked
					if(empty($att_data[0]['HrAttendance']['in_time'])){
						echo 'no_mark';
						die;
					}else{
						$this->HrAttendance->id = $att_data[0]['HrAttendance']['id'];				
					}
				}
				// save the todo
				if($this->HrAttendance->save($data, true, $fieldList = array($field, $reasonField, $reason_out_Field, $out_permission, 'app_users_id', $perm_field))){
					echo $this->Functions->format_attime($data[$field]);
					// self approve directors attendance
					if($this->request->data['type'] == 'out' && $this->Session->read('USER.Login.app_roles_id') == '18'){
						$this->HrAttendance->saveField('status', 'A');
						$this->HrAttendance->saveField('approve_date', $this->Functions->get_current_date());
					}
				}
			}else{
				echo 'marked';
				die;
			}
		}
		die;
	}
	
	/* function to get the last working day */
	public function get_last_working($yest_date){
		if(empty($yest_date)){
			$yest_date =  date('Y-m-d', strtotime('-1 day'));
		}
		$yest_day = explode('-', $yest_date); 
		$first_date = explode('-', $yest_date); 
		$first_day = date('N', strtotime($first_date[0].'-'.$first_date[1].'-'.'01'));
		// check second sat or fourth sat.
		$sat_flag = $this->Functions->check_saturday($first_day, $yest_day[2]);
		// check sunday
		$day = date('N', strtotime($yest_date));
		$sun_flag =  $this->Functions->check_sunday($day);
		// check holiday
		$holidays = $this->get_user_holidays($this->Session->read('USER.Login.hr_branch_id'));		
		if($sat_flag != '' || $sun_flag != '' || in_array($yest_date, $holidays)){
			// call recursive if last working is on leave
			return $this->get_last_working(date('Y-m-d', strtotime($yest_date.' -1 day')));
			
		}
		// check leave request 
		/*
		$this->loadModel('HrLeave');
		$leave_cond = array('leave_from <=' => $yest_date, 'leave_to >=' => $yest_date);
		$leave_count = $this->HrLeave->find('count', array('conditions' => array('HrLeave.app_users_id' => $this->Session->read('USER.Login.id'), $leave_cond)));
		*/
		return $yest_date;		
	}
	
	/* function to get the next working day */
	public function get_next_working($next_date){
		if(empty($next_date)){
			$next_date =  date('Y-m-d', strtotime('+1 day'));
		}
		$next_day = explode('-', $next_date); 
		$first_date = explode('-', $next_date); 
		$first_day = date('N', strtotime($first_date[0].'-'.$first_date[1].'-'.'01'));
		// check second sat or fourth sat.
		$sat_flag = $this->Functions->check_saturday($first_day, $yest_day[2]);
		// check sunday
		$day = date('N', strtotime($next_date));
		$sun_flag =  $this->Functions->check_sunday($day);
		// check holiday
		$holidays = $this->get_user_holidays($this->Session->read('USER.Login.hr_branch_id'));		
		if($sat_flag != '' || $sun_flag != '' || in_array($next_date, $holidays)){
			// call recursive if last working is on leave
			return $this->get_next_working(date('Y-m-d', strtotime($next_date.' +1 day')));
			
		}
		// check leave request 
		/*
		$this->loadModel('HrLeave');
		$leave_cond = array('leave_from <=' => $yest_date, 'leave_to >=' => $yest_date);
		$leave_count = $this->HrLeave->find('count', array('conditions' => array('HrLeave.app_users_id' => $this->Session->read('USER.Login.id'), $leave_cond)));
		*/		
		return $next_date;		
	}
	
	/* function to check already att. marked */
	public function check_already_marked($field){
		$att_data = $this->HrAttendance->find('all', array('fields' => array('id'), 'conditions' => array('app_users_id' => $this->Session->read('USER.Login.id'), $field.' like' => date('Y-m-d').'%'), 'limit' => 1)); 
		if(empty($att_data)){
			return false;
		}else{
			return true;
		}
	}
	
	/* clear the cache */
	
	public function beforeFilter() { 
		if($this->request->action == 'index' || $this->request->action == 'auto_refresh'){
			$this->show_tabs();
		}
	}
	
	/* function to save the todo list */
	public function store_todo(){
		$this->layout = 'ajax';		
		$data = array('item' => $this->request->query['tsk'], 'status' => 1, 'created_date' => $this->Functions->get_current_date(), 'app_users_id' => $this->Session->read('USER.Login.id'));
		if ($this->request->is('post') && !empty($this->request->query['tsk'])) { 
			// save the todo
			if($this->Home->Todo->save($data, true, $fieldList = array('item', 'status','created_date','app_users_id'))){
				$this->get_users_todo();
			}
		}
	}
	
	/* function to update the todo list */
	public function update_todo(){
		$this->layout = 'ajax';		
		$st = $this->request->query['sts'] ? '1' : '0';
		$data = array('id' => $this->request->query['id'], 'status' => $st, 'modified_date' => $this->Functions->get_current_date(), 'app_users_id' => $this->Session->read('USER.Login.id'));		
		if ($this->request->is('get') && $st != '') { 
			$this->Home->Todo->id = $this->request->query['id'];
			// update the todo
			if($this->Home->Todo->save($data)){			
				echo 'saved'; 
			}
		}
		$this->render(false);
		die;
	}
	
	/* function to flag the todo list */
	public function flag_todo(){
		$this->layout = 'ajax';		
		$st = $this->request->query['sts'];
		$data = array('id' => $this->request->query['id'], 'flag' => $st, 'modified_date' => $this->Functions->get_current_date(), 'app_users_id' => $this->Session->read('USER.Login.id'));		
		if ($this->request->is('get') && $st != '') { 
			$this->Home->Todo->id = $this->request->query['id'];
			// update the todo
			if($this->Home->Todo->save($data)){			
				echo 'saved'; 
			}
		}
		$this->render(false);
		die;
	}
	
	/* function to delete the todo list */
	public function delete_todo(){
		$this->layout = 'ajax';			
		$data = array('id' => $this->request->query['id'],  'modified_date' => $this->Functions->get_current_date(), 'app_users_id' => $this->Session->read('USER.Login.id'), 'is_deleted' => 'Y');		
		if ($this->request->is('get') && $this->request->query['id'] != '') { 
			$this->Home->Todo->id = $this->request->query['id'];
			// update the todo
			if($this->Home->Todo->save($data)){			
				echo 'deleted'; 
			}
		}
		$this->render(false);
		die;
	}
	
	/* function to save the todo item */
	public function save_todo(){
		$this->layout = 'ajax';			
		$data = array('id' => $this->request->query['id'], 'item' => trim($this->request->query['msg']), 'modified_date' => $this->Functions->get_current_date(), 'app_users_id' => $this->Session->read('USER.Login.id'));		
		if ($this->request->is('get') && $this->request->query['msg'] != '') { 
			$this->Home->Todo->id = $this->request->query['id'];
			// update the todo
			if($this->Home->Todo->save($data)){			
				echo 'saved'; 
			}
		}
		$this->render(false);
		die;
	}
	
	/* function to get users todo */
	public function get_users_todo(){
		$data = $this->Home->Todo->find('all', array('fields' => array('flag','Todo.id','Todo.item', 'Todo.created_date','Todo.status','Todo.modified_date'), 'conditions' => array('Todo.app_users_id' => $this->Session->read('USER.Login.id'),'is_deleted' => 'N'), 'order' => 'Todo.sort_order asc'));
		$this->set('todo_data', $data);
		
	}
	
	/* function to get the assigned tasks */
	public function get_users_assign($flag){
		if($flag){
			$this->layout = 'ajax';
			$this->set('team_assign', '1');
		}
		// get assigned tasks by me
		$count = $this->Home->check_team_mem($this->Session->read('USER.Login.id'), 'L');
		if($count){
			$this->loadModel('TskTeamAssign');
			$fields = array('id','created_date','title','desc','status','type','start','end','TskPlanType.title',
			'TskCustomer.company_name', 'TskProject.project_name', 'HrEmployee2.first_name','TskAssignUser.is_cc',
			'TskAssignStatus.status','TskAssignStatus.created_date','TskTeamAssign.modified_date');				
			$options = array(		
				array('table' => 'tsk_assign_users',
					'alias' => 'TskAssignUser',					
					'type' => 'LEFT',
					'conditions' => array('`TskAssignUser`.`tsk_assign_id` = `TskTeamAssign``.`id`')
				),
				array('table' => 'app_users',
					'alias' => 'HrEmployee2',					
					'type' => 'LEFT',
					'conditions' => array('`TskAssignUser`.`app_users_id` = `HrEmployee2``.`id`')
				)
			);		
			// fetch the task plans		
			$data = $this->TskTeamAssign->find('all', array('fields' => $fields, 'conditions' => array('TskTeamAssign.app_users_id' => $this->Session->read('USER.Login.id'),
			'TskTeamAssign.is_deleted' => 'N', 'HrEmployee.status' => '1', 'TskTeamAssign.status' => 'W'), 'order' => array('TskTeamAssign.start' => 'asc'),
			'group' => array('TskTeamAssign.id'), 'joins' => $options));
			$this->set('model_cls', 'TskTeamAssign'); 
			$this->set('model_url', 'tskteamassign');
			$this->set('team_assign', $count);
			$this->set('data', $data);
			$this->set('byMe', 1);
			if($flag){
				$this->render('/Elements/assign');

			}
		}else{
			// get tasks assigned to me
			$this->get_task_assign($count);
		}
		
	}
	
	/* function to get task assigned to me */
	public function get_task_assign($approve){
		if($approve){
			$this->layout = 'ajax';
			$this->set('team_assign', '1');
		}
		$options = array(		
				array('table' => 'app_users',
					'alias' => 'HrEmployee',					
					'type' => 'LEFT',
					'conditions' => array('`HrEmployee`.`id` = `TskAssign``.`app_users_id`')
				)
			);
		$this->loadModel('TskAssign');
		$fields = array('id','created_date','title','desc','status','remark','type','start','end',
		'TskPlanType.title', 'TskCustomer.company_name', 'TskProject.project_name', 
		'TskAssignRead.status as read_status', 'TskAssignRead.action_type as read_type',
		'TskAssignUser.is_cc', 'TskAssignRead.is_tag','TskAssignStatus.id','TskAssignStatus.status',
		'TskAssign.modified_date','TskAssignStatus.created_date');
		// fetch the task plans		
		$data = $this->TskAssign->find('all', array('fields' => $fields,'conditions' => 
		array('TskAssignRead.app_users_id' =>  $this->Session->read('USER.Login.id'), 
		'TskAssignUser.app_users_id' =>  $this->Session->read('USER.Login.id'), 'HrEmployee.status' => '1','TskAssign.is_deleted' => 'N',
		'TskAssign.status' => 'W'),'order' => array('TskAssign.start' => 'asc'),
		'group' => array('TskAssign.id'), 'joins' => $options));
		$this->set('model_cls', 'TskAssign'); 
		$this->set('model_url', 'tskassign');
		$this->set('data', $data);
		$this->set('toMe', 1);
		$this->render('/Elements/assign');
	}
	
	/* function to save the share data */
	public function store_share(){ 
		$this->layout = 'ajax';
		if($_POST['txtField'] == 'roaTxtBx'){
			$type = 'R';
			$roa_type = 'U';
			$render = 'roa';
		}else{
			$type = 'S';
			$render = 'share';
		}		
		$data = array('roa_type' => $roa_type, 'type' => $type, 'share' => $this->request->query['tsk'], 'created_date' => $this->Functions->get_current_date(),'modified_date' => $this->Functions->get_current_date(), 'app_users_id' => $this->Session->read('USER.Login.id'));
		if ($this->request->is('post') && !empty($this->request->query['tsk'])) { 
			$this->loadModel('Share'); 
			// upload photo if added
				if(!empty($_FILES['file']['name'])){
					// validate the file
					if($this->validate_file($_FILES['file']['type'], $_FILES['file']['size'])){					
						// upload the photo
						$src = $_FILES['file']['tmp_name'];
						$total = $this->Share->find('count');
						$dest = 'uploads/share/'.$total.'_'.$_FILES['file']['name'];
						if($this->Functions->upload_file($src, $dest)){
								//echo '../timthumb.php?src='.$dest.'&w=500&h=300&q=100';						
						}else{
								//echo 'upload_error';
						}
					}
				}
			
			// save the share
			if($this->Share->save($data, true, $fieldList = array('share','created_date','app_users_id','roa_type','type','modified_date'))){			 
			     // save the photo				
				if(!empty($_FILES['file']['name'])){
					$this->Share->id = $this->Share->id;
					$this->Share->saveField('attachment', $total.'_'.$_FILES['file']['name']);					
				}
				// fetch the share
				$this->get_users_share($_POST['txtField']);
			}			
		}
	
		// when user enter id for particular user
		if(!empty($this->request->query['id'])){
			$id_ar = explode('_', $this->request->query['id']);
			$this->loadModel('ShareUser');
			foreach($id_ar as $id){
				if(intval($id)){
					$data = array('app_share_id' => $this->Share->id, 'app_users_id' => $id);
					$this->ShareUser->create();
					if($this->ShareUser->save($data, true, $fieldList = array('app_users_id','app_share_id'))){
						
					}
				}
			}
			
		}
		
		
		$this->render('/Elements/'.$render);
	}
	
	/* function to update the notification */
	public function update_notify(){
		$this->layout = 'ajax';	
		$tab = $this->request->query['tab'];
		$notify = $this->get_tab_val($tab);
		
		$this->loadModel('Notification');		
		$notify_data = $this->Notification->find('all', array('fields' => array('id'), 'conditions' => array('app_users_id' => $this->Session->read('USER.Login.id'), 'notify' => $notify)));
		$data = array('id' => $notify_data[0]['Notification']['id'], 'notify' => $notify,  'modified_date' => $this->Functions->get_current_date(), 'app_users_id' => $this->Session->read('USER.Login.id'));
		
		if (!empty($tab) && !empty($notify_data)){ 
			// save the todo
			if($this->Notification->save($data, true, $fieldList = array('id', 'notify', 'modified_date','app_users_id'))){
				
			}
		}
		$this->render(false);
		die;
		
	}
	
	/* function to get notification val */
	
	public function get_tab_val($tab){	
		switch($tab){
			case 'chat':
			$val = 'I';
			break;
			case 'news':
			$val = 'N';
			break;
			case 'poll':
			$val = 'V';
			break;
			case 'gal':
			$val = 'G';
			break;
			case 'form':
			$val = 'D';
			break;
			case 'latUpdate':
			$val = 'L';
			break;
			case 'roa':
			$val = 'R';
			break;
			
		}
		return $val;		
	}
	
	/* function to reply share */
	public function reply_share(){ 
		$this->layout = 'refresh';	
		$data = array('share' => $this->request->query['tsk'], 'type' => $this->request->query['type'], 'created_date' => $this->Functions->get_current_date(), 
		'modified_date' => $this->Functions->get_current_date(),'app_users_id' => $this->Session->read('USER.Login.id'),'reply_id' => $this->request->query['id']);
		if ($this->request->is('get') && !empty($this->request->query['tsk'])) { 
			$this->loadModel('Share');
			// save the share
			if($this->Share->save($data, true, $fieldList = array('share','created_date','app_users_id','reply_id', 'type','modified_date'))){
				//$this->get_share_reply($this->request->query['id']);				
			}
			// check reply for selected users
			$this->loadModel('ShareUser');
			
			$data = $this->ShareUser->findByAppShareId($this->request->query['id'], array('fields' => 'id','app_share_id'));		
			if(!empty($data)){			
				$shrdata = array('app_share_id' => $this->Share->id, 'app_users_id' => $this->request->query['userid']);
				$this->ShareUser->create();
				if($this->ShareUser->save($shrdata, true, $fieldList = array('app_users_id','app_share_id'))){
						//echo 'success';
				}
			}
			// save modified date to show recent records
			$this->Share->id = $this->request->query['id'];
			$this->Share->saveField('modified_date', $this->Functions->get_current_date());
			// get reply shares
			$data = $this->get_share_reply($this->request->query['id']);		
			$this->set('share_reply', $data);	
			$this->render('/Elements/reply_share');
			
		}
	}
	
	/* function to get all share reply */
	public function get_share_reply($id){
		$this->loadModel('Share');
		$data = $this->Share->find('all', array('fields' => array('Share.id', 'ShareUser.app_users_id','share','attachment','Share.created_date','Home.first_name','Home.last_name','Home.id','Home.gender','Home.photo','reply_id'), 'conditions' => array('reply_id' => $id), 'order' => array('Share.created_date' => 'desc')));
		return $data;
		
	}
	
	/* get share start and end date */
	public function share_start(){
		return $last_day = date('Y-m-d', strtotime('-1 months')).' 00:00:00';			
	}
	
	/* get share start and end date */
	public function share_end(){
		return $today = date('Y-m-d').' 23:59:59';			
	}
	
	
	
	/* function to get users share */
	public function get_users_share($type){ 
		// fetch the share todo
		$this->loadModel('Share');
		if($type == 'roa' || $type == 'roaTxtBx'){
			$last_day = date('Y-m-d H:i:s', strtotime('-1 year'));
			$type = 'roa';
			$render = 'roa';
		}else{
			$last_day = $this->share_start();
			$render = 'share';
		}
		$today = $this->share_end();
			
		$items_per_group = 6;	
		$group_number = $_POST['group_no'];		
		if(empty($_POST['group_no'])){
			$group_number = 0;
		}		
		
		//get current starting point of records
		$position = ($group_number * $items_per_group);
		$this->set('position', $position);		
		
		// fetch the results
     	$data = $this->Home->get_share($this->Session->read('USER.Login.id'),$today, $last_day, $position, $items_per_group, $type);	
		$this->set('share_data', $data);
		// fetch share replies
     	$data_reply = $this->Home->get_share_reply($this->Session->read('USER.Login.id'),$today, $last_day);
		//echo '<pre>';print_r($data_reply);
		$this->set('share_reply', $data_reply);
		
		// get company name and logo
		$this->get_company_info();	
		
		$this->render('/Elements/'.$render);
		
		
	}
	
	/* function to get company info */
	public function get_company_info(){
		$this->loadModel('HrCompany');
		$comp_data = $this->HrCompany->findById('1', array('fields' => 'company_name', 'logo','address','city','landline','website'));		
		$this->set('comp_data', $comp_data);
	}
	
	/* get total users share */
	public function load_total_share($type){
		// fetch share data
		$this->layout = 'refresh';		
		$last_day = $this->share_start();		
		$today = $this->share_end();			
     	$total = $this->Home->get_total_share($this->Session->read('USER.Login.id'),$today, $last_day, '');		
		// calculate total group
		$items_per_group = 6;	
		echo $tot_group = ceil($total / $items_per_group);		
			
			// get app notification time
		$notify_data = $this->get_notification();
		
		echo '|||'.$this->set_share_count($notify_data[0]['Notification']['modified_date']);
	
		
		
		$this->render(false);		
	}
	
	/* get total users share */
	public function load_total_share_roa(){
		// fetch share data
		$this->layout = 'refresh';		
		$last_day = date('Y-m-d H:i:s', strtotime('-1 year'));		
		$today = $this->share_end();			
     	$total = $this->Home->get_total_share($this->Session->read('USER.Login.id'),$today, $last_day, 'roa');		
		// calculate total group
		$items_per_group = 6;		
		echo $tot_group = ceil($total / $items_per_group);		
		// get app notification time
		$notify_data = $this->get_notification();
		echo '|||'.$this->set_roa_share_count($notify_data[6]['Notification']['modified_date']);
		echo '|||'.'roa';
		$this->render(false);		
	}
	
	public function update_welcome_msg(){
		$this->layout = false;		
		$this->Session->write('WELCOME', 0);
		$this->render(false);
		die;
	}
	
	/* function to feedback send */
	public function feedback(){ 
		$this->layout = 'iframe_dash'; 
		if (!empty($this->request->data)){ 			
		$vars = array('from' => ucfirst($this->Session->read('USER.Login.first_name')).' '.ucfirst($this->Session->read('USER.Login.last_name')), 'feedback' => $this->request->data['Home']['feedback']);
		// notify superiors						
		if(!$this->send_email('My PDCA - '.ucfirst($this->Session->read('USER.Login.first_name')).' '.ucfirst($this->Session->read('USER.Login.last_name')).' submitted feedback!', 'feedback_request', $this->Session->read('USER.Login.email_address'), 'helpdesk@career-tree.in',$vars)){	
			// show the msg.								
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in sending mail...', 'default', array('class' => 'alert alert-error'));				
		}else{	
			
			}
			
			$this->set('feedback_submit', 1);
		}
		
		
	}
	
	
	/* function to feedback send */
	public function report_issue(){ 
		$this->layout = 'iframe_dash'; 
		if (!empty($this->request->data)){ 			
		$vars = array('from' => ucfirst($this->Session->read('USER.Login.first_name')).' '.ucfirst($this->Session->read('USER.Login.last_name')), 'issue' => $this->request->data['Home']['issue'], 'page_title' => $this->request->data['Home']['page_title']);
		// notify superiors						
		if(!$this->send_email('My PDCA - '.ucfirst($this->Session->read('USER.Login.first_name')).' '.ucfirst($this->Session->read('USER.Login.last_name')).' submitted an issue!', 'issue_request', $this->Session->read('USER.Login.email_address'), 'helpdesk@career-tree.in',$vars)){		
			// show the msg.								
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in sending mail...', 'default', array('class' => 'alert alert-error'));				
		}else{	
			
			}
			
			$this->set('issue_submit', 1);
		}
		
		
	}
	
	/* function to change the profile req. */
	public function change_req(){ 
		$this->layout = 'iframe_dash';		
		if (!empty($this->request->data)){
			$data = array('type' => $this->request->data['type'], 'created_date' => $this->Functions->get_current_date(), 'app_users_id' =>$this->Session->read('USER.Login.id'),'desc' => $this->request->data['desc']);
			$this->loadModel('HrChgReq');
			// save the req
			if($this->HrChgReq->save($data, true, $fieldList = array('type','created_date','app_users_id','desc'))){
				// notify hr
				$sub = 'My PDCA - '.ucfirst($this->Session->read('USER.Login.first_name')).' '.	ucfirst($this->Session->read('USER.Login.last_name')).' submitted change request!';
				$this->send_mail_hr($sub,'change_request');				
				echo 'saved';
				die;
			}
		};
		
		
	}
	
	/* function to get t-shirt size */
	public function check_tshirt(){
		$this->layout = 'iframe_dash';
		// check form posted
		if($this->request->is('post')){
			$this->Home->id = $this->Session->read('USER.Login.id');
			$this->Home->saveField('tshirt', strtoupper($this->request->data['Home']['tshirt']));
			 $this->Session->write('USER.Login.tshirt', $this->request->data['Home']['tshirt']);
			echo "<script>parent.$.colorbox.close()</script>";
			echo "<script>parent.location.reload();</script>";
			$this->Session->setFlash('Thank You. Your T-Shirt details updated successfully', 'default', array('class' => 'alert alert-success'));

		}
	}
	
	
	/* to view org. updates */
	public function company($page){
		// set the page title
		$this->set('title_for_layout', $page.' - My PDCA');	
		
		$this->loadModel('HrOrg');
		$org_detail = $this->HrOrg->find('all', array('fields' => array('title', 'desc'), 'conditions'=> array('HrOrg.is_deleted' => 'N', 'status' => '1', 'title like' => '%'.$page.'%'), 'limit' => '1'));		
		$this->set('org_detail', $org_detail);
		
		// get all the org. updates
		$this->loadModel('HrOrg');
		$org_data = $this->HrOrg->find('all', array('fields' => array('title','desc'), 'conditions'=> array('HrOrg.is_deleted' => 'N', 'status' => '1'), 'order' => array('created_date' => 'desc')));		
		$this->set('org_data', $org_data);
		
		
		
	}
	
	
	/* function to download the file */
	public function download_form($file){
		 $this->download_file(WWW_ROOT.'/uploads/form/'.$file);
		 die;
	}
	
	/* function to download the file */
	public function download_news($file){
		 $this->download_file(WWW_ROOT.'/uploads/news/'.$file);
		 die;
	}
	
	/* function to download the file */
	public function download_message($file){
		 $this->download_file(WWW_ROOT.'/uploads/message/'.$file);
		 die;
	}
	
	/* function to get new emails */
	public function get_new_email(){ 
		// Initialise cURL
		$c = curl_init('https://gmail.google.com/gmail/feed/atom');
		$headers = array(
		"Host: gmail.google.com",
		"Authorization: Basic ".base64_encode($this->Session->read('mail.email').':'.$this->Session->read('mail.pass')),
		"Accept-Language: en-gb,en;q=0.5?",
		"Accept-Encoding: text",
		"Date: ".date(DATE_RFC822)
		);
		curl_setopt($c, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
		curl_setopt($c, CURLOPT_COOKIESESSION, true);
		curl_setopt($c, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($c, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($c, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($c, CURLOPT_SSL_VERIFYHOST, 1);
		curl_setopt($c, CURLOPT_UNRESTRICTED_AUTH, 1);
		curl_setopt($c, CURLOPT_SSL_VERIFYHOST, 1);

		$str = curl_exec($c);
		if(!empty($str)){
			$mails = new SimpleXMLElement($str);	
			$this->Session->write('mail.new_mail', (string)$mails->fullcount);	
		}
		
		curl_close($c);		
		
	}
	
	/* function to load ajax attendance */
	public function tabbed_call($tab,$view){ 
		$this->layout = 'ajax';
		switch($tab){
			case 'taskP':
			//$this->load_ajax_task();
			break;
			case 'attendance':
			$this->show_by();
			break;
			case 'todoP':
			$this->load_ajax_todo();
			break;
			case 'assignP':
			$this->load_ajax_tasks();
			break;
			case 'eventP':
			$this->layout = 'iframe';
			$this->load_ajax_event();
			break;		
			case 'interact':
			$this->load_ajax_interact();
			break;	
			case 'latestU':
			$this->load_ajax_latest('K');
			break;
			case 'voice':
			$this->layout = 'iframe';
			$this->load_ajax_voice();
			break;	
			case 'profile':
			$this->load_ajax_profile();
			break;	
			case 'officeEmp':
			$this->load_ajax_office_emp();
			break;
			case 'files':
			$this->load_ajax_file();
			break;
			case 'photos':
			$this->load_ajax_gallery();
			break;
			case 'latestupdate':
			$this->load_ajax_latest('L');
			break;
			case 'roa':
			$this->load_ajax_interact();
			break;
		}
		$this->render('/Elements/'.$view);	
	}
	
	/* function to load gallery */
	public function load_ajax_gallery(){ 
		$news_date_cond = $this->get_news_date();
		// get the approved galleries to show
		$this->loadModel('HrGallery');
		$gal_data = $this->HrGallery->find('all', array('conditions' => array('is_approve' => 'Y', 'HrGallery.created_date >' => $news_date_cond), 'fields' => array('HrGallery.title','id', 'HrGallery.desc', 'HrGallery.folder','HrGallery.created_date'), 'group' => array('HrGallery.id'), 'order' => array('created_date' => 'desc')));
		$this->set('gallery_data', $gal_data);
		// get photos in the gallery
		foreach($gal_data as $data){
			 $gal_item[$data['HrGallery']['id']][] = $this->HrGallery->HrGalleryItem->find('all', array('conditions' => array('HrGalleryItem.status' => '1', 'HrGalleryItem.hr_gallery_id' => $data['HrGallery']['id']), 'fields' => array('HrGalleryItem.id','HrGalleryItem.file'),
			 'order' => array('HrGalleryItem.id' => 'asc')));
			 // get total comments
			 $this->loadModel('HrGalComment');
			 $comment_user = $this->HrGalComment->find('all', array('fields' => array("group_concat(HrEmployee.first_name SEPARATOR '<br>') as comment_user"),'conditions' => array('hr_gallery_id' => $data['HrGallery']['id']),
			 'order' => array('HrGalComment.created_date' => 'desc')));
			 $comment_user_count = explode('<br>',  $comment_user[0][0]['comment_user']);
			 // make sure atleast a user commented
			 if($comment_user_count[0] != ''){
				$gal_item[$data['HrGallery']['id']][] = count($comment_user_count);
				// assign comment users
				$comment_user_unique = array_unique($comment_user_count);
				$gal_item[$data['HrGallery']['id']][] = implode('<br>', $comment_user_unique);
			 }else{
				$gal_item[$data['HrGallery']['id']][] = 0;
				$gal_item[$data['HrGallery']['id']][] = '';
			 }
			 
			 // get total likes
			 $this->loadModel('HrGalLike');
			 $like_user = $this->HrGalLike->find('all', array('fields' => array("group_concat(HrEmployee.first_name SEPARATOR '<br>') as like_user"), 'conditions' => array('hr_gallery_id' => $data['HrGallery']['id']),
			 'order' => array('HrGalLike.created_date' => 'desc')));
			 $like_user_count = explode('<br>',  $like_user[0][0]['like_user']);
			 // make sure atleast a user liked
			 if($like_user_count[0] != ''){
				$gal_item[$data['HrGallery']['id']][] = count($like_user_count);
				// assign comment users
				$like_user_unique = array_unique($like_user_count);
				$gal_item[$data['HrGallery']['id']][] = implode('<br>', $like_user_unique);
			 }else{
				$gal_item[$data['HrGallery']['id']][] = 0;
				$gal_item[$data['HrGallery']['id']][] = '';
			 }
			 
		}		
		$this->set('gallery_item', $gal_item);
	}
	
	/* function to view the gallery */
	public function view_gallery($id, $item){
		$this->loadModel('HrGallery');
		$gal_data = $this->HrGallery->findById($id, array('fields' => 'HrGallery.title','id', 'HrGallery.desc',
		'HrGallery.folder','HrGallery.created_date'));
		$this->set('gallery_data', $gal_data);
		$data = $this->HrGallery->HrGalleryItem->find('all', array('fields' => array('file','id','hr_gallery_id'), 'conditions' => 
		array('HrGalleryItem.status' => '1', 'HrGalleryItem.hr_gallery_id' => $id), 'order' => array('HrGalleryItem.id' => 'asc')));
		$this->set('gallery_item', $data);
		// get gallery comments
		$this->loadModel('HrGalComment');
		foreach($data as $key =>  $item){
			$comment_data = $this->get_gallery_comment($item['HrGalleryItem']['id']);
			// iterate the comments
			foreach($comment_data as $comment){
				$commentData[$item['HrGalleryItem']['id']]['msg'][] = $comment['HrGalComment']['msg'];
				$commentData[$item['HrGalleryItem']['id']]['time'][] = $comment['HrGalComment']['created_date'];
				$commentData[$item['HrGalleryItem']['id']]['user'][] = $comment['HrEmployee']['first_name'];
				$commentData[$item['HrGalleryItem']['id']]['photo'][] = $comment['HrEmployee']['photo'];
				$commentData[$item['HrGalleryItem']['id']]['gender'][] = $comment['HrEmployee']['gender'];
				$commentData[$item['HrGalleryItem']['id']]['last'][] = $comment['HrEmployee']['last_name'];
				$commentData[$item['HrGalleryItem']['id']]['photo_st'][] = $comment['HrEmployee']['photo_status'];
				$commentData[$item['HrGalleryItem']['id']]['emp'][] = $comment['HrEmployee']['id'];
			}
			// get photo likes
			$this->loadModel('HrGalLike');
			$count = $this->HrGalLike->find('count', array('conditions' => array('hr_gallery_items_id' => $item['HrGalleryItem']['id'])));
			$commentData[$item['HrGalleryItem']['id']]['like'][] = $count;
			// get users like
			$count = $this->HrGalLike->find('count', array('conditions' => array('hr_gallery_items_id' => $item['HrGalleryItem']['id'],
			'app_users_id' => $this->Session->read('USER.Login.id'))));
			$commentData[$item['HrGalleryItem']['id']]['user_like'][] = $count;
		}
		$this->set('commentData', $commentData);
	}
	
	/* function to view the gallery comments */
	public function view_gal_comments($id){
		$this->loadModel('HrGalComment');
	    $comment_data = $this->HrGalComment->find('all', array('fields' => array('msg','HrGalComment.created_date','HrEmployee.first_name','HrEmployee.last_name','HrEmployee.id','HrEmployee.photo','HrEmployee.gender','HrEmployee.photo_status'),
		 'conditions' => array('HrGalComment.hr_gallery_id' => $id), 'order' => array('HrGalComment.created_date' => 'desc'), 'group' => array('HrGalComment.id')));
		$this->set('comment_data', $comment_data);
	}
	
	/* function to update the comments */
	public function update_comment(){
		$this->layout = 'ajax';
		$this->loadModel('HrGalComment');
		$data = array('msg' => $this->request->query['comment'], 'hr_gallery_items_id' => $this->request->query['id'],
		'created_date' => $this->Functions->get_current_date(),'app_users_id' => $this->Session->read('USER.Login.id'),
		'hr_gallery_id' => $this->request->query['gal_id']);
		$this->HrGalComment->save($data);
		// get comments
		$this->get_gallery_comment($this->request->query['id']);
	}
	
	/* function to update the comments */
	public function update_like(){
		$this->layout = false;
		$this->loadModel('HrGalLike');
		$save = 0;
		// validate user already liked
		if(!$this->check_already_liked($this->Session->read('USER.Login.id'), $this->request->query['id'])){
			$data = array('msg' => $this->request->query['comment'], 'hr_gallery_items_id' => $this->request->query['id'],
			'created_date' => $this->Functions->get_current_date(),'app_users_id' => $this->Session->read('USER.Login.id'),
			'hr_gallery_id' => $this->request->query['gal_id']);
			$this->HrGalLike->save($data);
			$save = 1;
		}
		echo $save;
		$this->render(false);
	}
	
	/* function to check user likes */
	public function check_already_liked($user, $id){
		$count = $this->HrGalLike->find('count', array('conditions' => array('app_users_id' => $user, 'hr_gallery_items_id' => $id)));
		return $count;
		
	}
	
	/* function to get gallery photo comments */
	public function get_gallery_comment($photo_id){
		$comment_data = $this->HrGalComment->find('all', array('fields' => array('msg','HrGalComment.created_date','HrEmployee.first_name',
			'HrEmployee.photo','HrEmployee.photo_status','HrEmployee.id','HrEmployee.last_name','HrEmployee.gender'),'conditions' => array('hr_gallery_items_id' => $photo_id,
			'HrGalComment.is_deleted' => 'N'), 'order' => array('HrGalComment.created_date' => 'desc')));
		$this->set('comData', $comment_data);
		$this->set('photoID', $photo_id);
		return $comment_data;
	}
	
	
	/* function to load files */
	public function load_ajax_file(){
		// to get the form data
		$this->loadModel('HrForm');
		$form_data = $this->HrForm->find('all', array('fields' => array('form','desc','HrDocCategory.category','attachment','created_date','modified_date'), 'conditions'=> array('HrForm.is_deleted' => 'N', 'HrForm.status' => '1'), 'order' => array( 'HrDocCategory.priority' => 'asc', 'HrDocCategory.category' => 'asc')));		
		$this->set('form_data', $form_data);
		/* function to get notification */
		$this->loadModel('Notification');
		$notify_data = $this->Notification->find('all', array('fields' => array('modified_date'), 'conditions' => array('app_users_id' => $this->Session->read('USER.Login.id'), 'notify' => 'D'), 'limit' => '1'));
		$notify_data[0]['Notification']['modified_date'];
		$this->set('doc_modify',$notify_data[0]['Notification']['modified_date']); 
	}
	
	/* function to load office employee */
	public function load_ajax_office_emp(){
		$this->get_office_team();
	}
	
	/* function to get all members in office */
	public function get_office_team(){
		// fetch all members in the company
		$this->Home->unbindModel(array('hasOne' => array('Todo')));
		$data = $this->Home->find('all', array('fields' => array('id','HrBranch.branch_name', 'HrDepartment.id','HrDesignation.id','gender','first_name', 'email_address','last_name', 'photo', 'photo_status','HrDepartment.dept_name','HrDesignation.desig_name','official_contact_no'), 'conditions' => array('Home.is_deleted' => 'N','Home.status' => '1'), 'order' => array('Home.first_name' => 'asc')));
		$this->set('member_data', $data);
	}
	
	/* function to load ajax profile */
	public function load_ajax_profile(){
		// fetch user details
		$this->Home->unbindModel(array('hasOne' => array('Todo')));
		$data = $this->Home->findById($this->Session->read('USER.Login.id'),  array('id','gender','full_name', 'email_address','wedding_date', 'photo','HrBranch.branch_name', 'HrCompany.company_name', 'HrDepartment.dept_name','HrDesignation.desig_name','photo_status','contact_no','dob','doj','emp_no','landline','communication_addr','permanent_addr','blood_group','marital_status','emergency_contact_person','emergency_contact_no','pf_no','esi_no','official_contact_no','pan','emergency_relation','HrBusinessUnit.business_unit','HrBloodGroup.blood_group','probation','att_type'));
		$this->set('user_data', $data);
		// get reporting users
		$this->loadModel('Approval');
		$approval_data = $this->Approval->find('all', array('fields' => array('level1', 'level2'), 'conditions'=> array('Approval.app_users_id' => $this->Session->read('USER.Login.id'), 'type' => 'A')));
		// get reporting users		
		$reporting[] = $this->Home->findById($approval_data[0]['Approval']['level1'], array('fields' => 'id','first_name', 'last_name'));	
		if(!empty($approval_data[0]['Approval']['level2'])){
			$reporting[] = $this->Home->findById($approval_data[0]['Approval']['level2'], array('fields' => 'id','first_name', 'last_name'));	
		}		
		$this->set('reportingUser', $reporting);
		// load the education details for profile
		$this->loadModel('HrEducation');
		$education = $this->HrEducation->find('all', array('fields' => array('inst_name','percent_marks','year_passing',
		'university','course_type','HrCourse.course_name','HrSpec.specialization','board','program_type'), 
		'conditions' => array('HrEducation.app_users_id' => $this->Session->read('USER.Login.id')), 'order' => array('program_type' => 'desc')));		
		foreach($education as $edu){
			$this->set('type'.$edu['HrEducation']['program_type'].'_inst_name', $edu['HrEducation']['inst_name']);
			$this->set('type'.$edu['HrEducation']['program_type'].'_percent_marks', $edu['HrEducation']['percent_marks']);
			$this->set('type'.$edu['HrEducation']['program_type'].'_year_passing', $edu['HrEducation']['year_passing']);
			$this->set('type'.$edu['HrEducation']['program_type'].'_university', $edu['HrEducation']['university']);
			$this->set('type'.$edu['HrEducation']['program_type'].'_course_type', $edu['HrEducation']['course_type']);
			$this->set('type'.$edu['HrEducation']['program_type'].'_course', $edu['HrCourse']['course_name']);
			$this->set('type'.$edu['HrEducation']['program_type'].'_spec', $edu['HrSpec']['specialization']);
			$this->set('type'.$edu['HrEducation']['program_type'].'_board', $edu['HrEducation']['board']);
		}
		$this->set('edu_data', $education);	
		// for l1 and l2
		//$this->get_office_team();
	}
	
	
	/* function to load ajax voice */
	public function load_ajax_voice(){
		$this->loadModel('Notification');		
		$notify_data = $this->Notification->find('all', array('fields' => array('id'), 'conditions' => 
		array('app_users_id' => $this->Session->read('USER.Login.id'), 'notify' => 'V')));
		$data = array('id' => $notify_data[0]['Notification']['id'], 'notify' => 'V',   'modified_date' => $this->Functions->get_current_date(), 'app_users_id' => $this->Session->read('USER.Login.id'));	
		if($this->Notification->save($data, true, $fieldList = array('id', 'notify', 'modified_date','app_users_id'))){
				
		}
		
	}
	
	/* function to load ajax task */
	public function load_ajax_event(){
		// get employee events
		$this->loadModel('TskEvent');
		$data = $this->TskEvent->find('all', array('fields' => array('id','title','start','end','details','status','TskEventType.color','TskEventType.name'),
		'conditions' => array('app_users_id' => $this->Session->read('USER.Login.id'), 'TskEvent.is_deleted' =>  'N','start >= ' =>  date('Y-m-d H:m')),
		'order' => array('start' => 'asc'), 'limit' => 10));
		$this->set('ajax_event', 1);
		$this->set('event_data', $data);
	}
	
	/* function to load ajax latest updates */
	public function load_ajax_latest($type){ 
		// get the latest news
		$this->loadModel('HrLatest');
		$news_date_cond = $this->get_news_date();
		$news_data = $this->HrLatest->find('all', array('fields' => array('id','title','desc','attachment','created_date','modified_date'), 'conditions'=> array('HrLatest.is_deleted' => 'N', 'status' => '1', 'created_date >' => $news_date_cond, 'news_type' => $type), 'order' => array('created_date' => 'desc', 'created_date' => 'desc')));		
		$this->set('news_data', $news_data);
	}
	
	/* function to load ajax interact */
	public function load_ajax_interact(){
		//$this->load_ajax_interact();
	}
	
	/* function to load ajax task */
	public function load_ajax_todo(){
		// fetch the users todo
		$this->get_users_todo();
	}
	
	public function load_ajax_tasks(){
		// fetch the assigned tasks
		$this->get_task_assign();
	}
	
	
	/* function to load ajax attendance */
	public function show_by(){
		/*
		$this->layout = 'ajax';	
		$this->Home->unbindModel(array('hasOne' => array('Todo')));		
		// get the attendance of the user
		$this->loadModel('HrAttendance');
		$att_data = $this->HrAttendance->find('all', array('fields' => array('in_time', 'out_time','status','reject_reason'), 'conditions' => array('app_users_id' => $this->Session->read('USER.Login.id'), 'in_time like' => $this->request->query['month'].'%'), 'order' => array('in_time' => 'asc'))); 
		$this->set('selMonth', $this->request->query['month']);
		$this->set('all_att_data', $att_data);	
		// load leave types
		$this->load_leave_types($this->Session->read('USER.Login.gender'), $this->Session->read('USER.Login.id'));		
		// get leaves remaining
		$year  = explode('-', $this->request->query['month']);
		$this->get_used_leaves($this->Session->read('USER.Login.id'));
		// get used permissions
		$this->get_used_perms($this->request->query['month'],$this->Session->read('USER.Login.id'));
		// get the leaves of the user
		$this->get_applied_leaves($this->request->query['month'], $this->Session->read('USER.Login.id'));
		// get the comp off days of user
		$this->get_compoff_details($this->Session->read('USER.Login.id'));
		// get holidays of this month
		$this->get_holidays_month($this->request->query['month']);		
		$this->render('/Elements/attendance');
		*/
		if($this->request->query['month'] != ''){
			$this->layout = 'ajax';
		}		
		$this->Home->unbindModel(array('hasOne' => array('Todo')));	
		$monthChk = $this->request->query['month'] ? $this->request->query['month'] : date('Y-m');
		// get the attendance of the user
		$this->loadModel('HrAttendance');
		$att_data = $this->HrAttendance->find('all', array('fields' => array('in_time', 'out_time','status','reject_reason','att_waive','waive_msg'), 'conditions' => array('app_users_id' => $this->Session->read('USER.Login.id'), 'in_time like' => $monthChk.'%'), 'order' => array('in_time' => 'asc'))); 
		$this->set('selMonth', $monthChk);
		$this->set('all_att_data', $att_data);	
		// load leave types
		$this->load_leave_types($this->Session->read('USER.Login.gender'), $this->Session->read('USER.Login.id'),$this->Session->read('USER.Login.doj'),$this->Session->read('USER.Login.emp_type'));		
		// get leaves remaining
		$year  = explode('-', $monthChk);
		$this->get_used_leaves($this->Session->read('USER.Login.id'),$this->Session->read('USER.Login.doj'),$this->Session->read('USER.Login.emp_type'),$this->Session->read('USER.Login.doc'));
		// get used permissions
		$this->get_used_perms(date('Y-m'),$this->Session->read('USER.Login.id'));
		// get the leaves of the user
		$this->get_applied_leaves($monthChk, $this->Session->read('USER.Login.id'));
		// get the comp off days of user
		$this->get_compoff_details($this->Session->read('USER.Login.id'),$this->Session->read('USER.Login.emp_type'),$this->Session->read('USER.Login.work_place'));
		// get holidays of this month
		$this->get_holidays_month($monthChk,$this->Session->read('USER.Login.hr_branch_id'));			
		// get happy leave of this month
		$this->get_happy_leave($this->Session->read('USER.Login.id'));
		// load att. approve data
		$this->load_att_approve();
		// calculate late timing
		$this->late_timing($monthChk);
		// check associate user
		$this->set('associateUSER', $this->Session->read('USER.Login.emp_type') == 'A' ? 1 : 0);
		if($this->request->query['month'] != ''){
			$this->render('/Elements/attendance');	
		}else{
			
		}
		
				
	}
	
	/* function calculate office late timing */
	public function late_timing($monthChk){
		// get office time for late attendance
		$this->loadModel('HrOfficeTiming');
		$office_timing = $this->HrOfficeTiming->find('all', array('fields' => array('start_time', 'end_time', 'grace_time'),'conditions' => array('app_users_id' => $this->Session->read('USER.Login.id')), 'limit' => '1'));
		$end_time = $office_timing[0]['HrOfficeTiming']['end_time'];
		$start_time = $office_timing[0]['HrOfficeTiming']['start_time'];
		if(!empty($start_time)){		
			$minutes = $this->Functions->check_grace($monthChk, $office_timing[0]['HrOfficeTiming']['grace_time'], 'Y-m');
			$time = strtotime('2014-05-16 '.$start_time);
			$this->set('no_grace_time', date('H:i', $time));
			$time += 60 * $minutes;
			$this->set('office_time', date('H:i', $time));
		}else{
			$start_time = '09:30';
			$this->set('no_grace_time', $start_time);
			$time = strtotime('2014-05-16 '.$start_time);
			$time += 60 * 10;
			$this->set('office_time', $start_time);
		}		
		// get permissions to reduce leave hours
		$this->loadModel('HrPermission');
		$data = $this->HrPermission->find('all', array('fields' => array('per_date', 'no_hrs'), 'conditions' => array('HrPermission.app_users_id' => $this->Session->read('USER.Login.id'), 'per_date like' => $monthChk.'%', 'per_from like' => '%'.$start_time.'%', 'HrPermission.is_deleted' => 'N', 'is_approve' => 'Y')));
		foreach($data as $per_data){
			$perData[$per_data['HrPermission']['per_date']] = $per_data['HrPermission']['no_hrs'];
		}
		$this->set('permData', $perData);
	}
	
	/* function to show the overlay info for comp. and member */
	public function overlay_info($id, $type){
		$this->layout = 'iframe_dash';
		// fetch all members in the company
		if($type == 'share'){
			$this->Home->unbindModel(array('hasOne' => array('Todo')));
			$data = $this->Home->find('all', array('fields' => array('id','HrBranch.branch_name', 'Home.skype', 'HrBusinessUnit.business_unit', 'HrDepartment.id','HrDesignation.id','gender','first_name', 'email_address','last_name', 'photo', 'photo_status','HrDepartment.dept_name','HrDesignation.desig_name','official_contact_no'), 'conditions' => array('Home.is_deleted' => 'N','Home.status' => '1', 'Home.id' => $id), 'order' => array('Home.first_name' => 'asc')));
			$this->set('member_data', $data[0]);
		}else{
			// get company name and logo
			$this->get_company_info();
			$this->render('/Elements/comp_profile');
		}
	}
	
	/* function to show the overlay info for comp. and member */
	public function news_detail($id){
		$this->layout = 'iframe_dash';
		// get the latest news
		$this->loadModel('HrLatest');
		$news_data = $this->HrLatest->find('all', array('fields' => array('id','title','desc','attachment','created_date','modified_date'), 'conditions'=> array('HrLatest.is_deleted' => 'N', 'status' => '1', 'HrLatest.id' => $id), 'order' => array('created_date' => 'desc', 'created_date' => 'desc')));		
		$this->set('news_data', $news_data[0]);
	}
	
	/* function to show the overlay info for comp. and member */
	public function holiday(){
		$this->layout = 'iframe_dash';
		// get list of holidays for the user
		$this->Home->unbindModel(array('hasOne' => array('Todo')));
		$this->loadModel('HrHoliday');
		$holiday_list = $this->HrHoliday->find('all', array('fields' => array('event', 'event_date', 'desc'), 'conditions' => array('hr_branch_id' => $this->Session->read('USER.Login.hr_branch_id'), 'HrHoliday.status' => '1',  'HrHoliday.is_deleted' => 'N', 'event_date like' => date('Y').'%'), 'order' => array('event_date' => 'asc')));		
		$this->set('holidayData', $holiday_list);
	}
	
	
	
	/* function to update notify user */
	public function notify_user(){
		$this->layout = 'iframe_dash';
		if($this->request->is('post')){
			$this->Home->id = $this->Session->read('USER.Login.id');
			$this->Home->saveField('notify_user', 1);
			$this->Home->saveField('create_notify', $this->Functions->get_current_date());
			$this->Session->write('USER.Login.notify_user', 1);
			echo "<script>parent.$.colorbox.close()</script>";
			echo "<script>parent.location.reload();</script>";
		}		
		
	}
	
	
	/* function to show the survey */
	public function show_survey(){ 
		$this->layout = 'iframe_dash'; 
		// get the survey details
		$this->loadModel('HrSurvey');
		// get survey details
		$options = array(	
			array('table' => 'hr_survey_user',
					'alias' => 'SurveyUser',					
					'type' => 'Left',
					'conditions' => array('`SurveyUser`.`hr_survey_id` = `HrSurvey`.`id`',
					'`SurveyUser`.`app_users_id`' => $this->Session->read('USER.Login.id'))
			)
		);
		$data = $this->HrSurvey->find('all', array('fields' => array('HrSurvey.id','desc','end_date'), 'conditions' => array('end_date >=' => date('Y-m-d'),'start_date <=' => date('Y-m-d'),  'is_deleted' => 'N', 'status' => 1,'SurveyUser.hr_survey_id' => NULL), 'order' => array('HrSurvey.created_date' => 'desc'), 'group' => array('HrSurvey.id'), 'joins' => $options));
		$this->set('survey_data', $data);
		// check server alread completed
		//$count = $this->check_survey_status($data[0]['HrSurvey']['id']);
		// when survey not completed
		if($data[0]['HrSurvey']['id']){
			// get the questions
			$this->loadModel('HrSurveyQuestion');
			$qn_data = $this->HrSurveyQuestion->find('all', array('fields' => array('id', 'question'), 'conditions' => array('hr_survey_id' => $data[0]['HrSurvey']['id']))); 
			$this->set('qn_data', $qn_data);
			$this->loadModel('HrSurveyAns');
			if (!empty($this->request->data)){ 	
				// check if draft
				if($this->request->data['HrSurveyAns']['is_draft'] == '1'){
					// remove survey answer
					$this->remove_survey_ans($data[0]['HrSurvey']['id']);
					$this->save_survey_ans($data[0]['HrSurvey']['id']);
					$this->set('survey_submit', 1);
					$this->get_survey_ans($data[0]['HrSurvey']['id']);

				}else{
					$this->HrSurveyAns->set($this->request->data);					
					if ($this->validate_ans()){
						// save the answers
						$save = $this->save_survey_ans($data[0]['HrSurvey']['id']);
						// update in survey user
						if($save && empty($this->request->data['HrSurveyAns']['is_draft'])){
							$this->loadModel('HrSurveyUser');
							$data = array('app_users_id' =>  $this->Session->read('USER.Login.id'), 'hr_survey_id' => $data[0]['HrSurvey']['id']);
							$this->HrSurveyUser->save($data);
							$this->set('survey_submit', 3);
						}
						
					}else{
						$this->set('survey_submit', 2);
					}
				}
			}else{
				// fetch the survey answers
				$this->get_survey_ans($data[0]['HrSurvey']['id']);
			}
		}
		
	}
	
	/* function to show the voice */
	public function show_voice(){ 
		$this->layout = 'iframe_dash'; 
		// get the survey details
		$this->loadModel('HrVoice');
		$this->set('voiceType', array('Q' => 'Question', 'S' => 'Suggestion', 'I' => 'Idea'));
		// get survey details
		$options = array(	
			array('table' => 'hr_voice_user',
					'alias' => 'VoiceUser',					
					'type' => 'Left',
					'conditions' => array('`VoiceUser`.`hr_voice_id` = `HrVoice`.`id`',
					'`VoiceUser`.`app_users_id`' => $this->Session->read('USER.Login.id'))
			)
		);
		$data = $this->HrVoice->find('all', array('fields' => array('HrVoice.id','desc','end_date'), 'conditions' => array('end_date >=' => date('Y-m-d'),'start_date <=' => date('Y-m-d'),  'is_deleted' => 'N', 'status' => 1,'VoiceUser.hr_voice_id' => NULL), 'order' => array('HrVoice.created_date' => 'desc'), 'group' => array('HrVoice.id'), 'joins' => $options));
		$this->set('survey_data', $data);
		// when survey not completed
		if($data[0]['HrVoice']['id']){
			// get the questions
			$this->loadModel('HrVoiceQuestion');
			$qn_data = $this->HrVoiceQuestion->find('all', array('fields' => array('id', 'msg'), 'conditions' => array('hr_voice_id' => $data[0]['HrSurvey']['id'], 'app_users_id' => $this->Session->read('USER.Login.id')))); 
			$this->set('qn_data', $qn_data);
			$this->loadModel('HrSurveyAns');
			if (!empty($this->request->data)){ 	
				// check if draft
				if($this->request->data['HrVoice']['is_draft'] == '1'){
					// remove voice answer
					$this->remove_voice_msg($data[0]['HrVoice']['id']);
					$this->save_voice_msg($data[0]['HrVoice']['id']);
					$this->set('voice_submit', 1);
					$this->get_voice_msg($data[0]['HrVoice']['id']);

				}else{
					$this->HrVoice->set($this->request->data);
					// remove voice answer
					$this->remove_voice_msg($data[0]['HrVoice']['id']);					
					// save the answers
					$save = $this->save_voice_msg($data[0]['HrVoice']['id']);
					// update in survey user
					if($save && empty($this->request->data['HrVoice']['is_draft'])){
						$this->loadModel('HrVoiceUser');
						$data = array('app_users_id' =>  $this->Session->read('USER.Login.id'), 'hr_voice_id' => $data[0]['HrVoice']['id']);
						$this->HrVoiceUser->save($data);
						$this->set('voice_submit', 3);
					}
				}
			}else{
				// fetch the voice messages
				$this->get_voice_msg($data[0]['HrVoice']['id']);
			}
		}
		
	}
	
	/* function to remove the voice */
	public function remove_voice_msg($id){
		$this->HrVoiceQuestion->deleteAll(array('hr_voice_id' => $id, 'app_users_id' => $this->Session->read('USER.Login.id')), false);
	}
	
	
	/* function to save voice msg */
	public function save_voice_msg($voice_id){
		$tot = $this->request->data['HrVoice']['tot_msg'];
		$save  = true;
		for($i = 0; $i <= $tot; $i++){ 
			if(!empty($this->request->data['HrVoice']['msg'.$i])){
				$this->request->data['HrVoiceQuestion']['msg'] = $this->request->data['HrVoice']['msg'.$i];
				$this->request->data['HrVoiceQuestion']['type'] = $this->request->data['HrVoice']['type'.$i];
				$this->request->data['HrVoiceQuestion']['created_date'] = $this->Functions->get_current_date();
				$this->request->data['HrVoiceQuestion']['app_users_id'] = $this->Session->read('USER.Login.id');
				$this->request->data['HrVoiceQuestion']['hr_voice_id'] = $voice_id;
				$this->HrVoiceQuestion->create();
				if(!$this->HrVoiceQuestion->save($this->request->data['HrVoiceQuestion'])) {	
					$save = false;
				}
			}
		}

		return $save;
	}
	
	/* function to get the voice msg */
	public function get_voice_msg($id){
		$data = $this->HrVoiceQuestion->find('all', array('fields' => array('type','msg'), 'conditions' => array('hr_voice_id' => $id, 
		'app_users_id' => $this->Session->read('USER.Login.id')), 'order' => array('HrVoiceQuestion.id' => 'asc')));
		$this->set('voice_msg_data', $data);
	}
	
	/* function to check survey status
	public function check_survey_status($id){
		$this->loadModel('HrSurveyUser');
		$count = $this->HrSurveyUser->find('count', array('conditions' => array('app_users_id' => $this->Session->read('USER.Login.id'), 'hr_survey_id' => $id)));
		$this->set('survey_complete', $count);
		return $count;
	}
	 */
	
	/* function to get the survey answers */
	public function get_survey_ans($id){
		$ans_data = $this->HrSurveyAns->find('all', array('fields' => array('answer','id','hr_survey_question_id'), 'conditions' => array('hr_survey_id' => $id, 
		'app_users_id' => $this->Session->read('USER.Login.id'))));
		$format_ans = $this->format_answer($ans_data);
		$this->set('survey_ans', $format_ans);
	}
	
	/* function to format the answer data */
	public function format_answer($data){
		foreach($data as $result){
			$ans[$result['HrSurveyAns']['hr_survey_question_id']] = $result['HrSurveyAns']['answer'];
		}
		return $ans;
	}
	
	
	/* function to remove the survey */
	public function remove_survey_ans($id){
		$this->HrSurveyAns->deleteAll(array('hr_survey_id' => $id, 'app_users_id' => $this->Session->read('USER.Login.id')), false);
	}
	
	/* function to save survey answers */
	public function save_survey_ans($survey_id){
		$tot = $this->request->data['HrSurveyAns']['tot_qn'];
		$save  = true;
		for($i = 1; $i <= $tot; $i++){
			if(!empty($this->request->data['HrSurveyAns']['qn'.$i])){
				$this->request->data['HrSurveyAns']['hr_survey_question_id'] = $this->request->data['HrSurveyAns']['question'.$i];
				$this->request->data['HrSurveyAns']['answer'] = $this->request->data['HrSurveyAns']['qn'.$i];
				$this->request->data['HrSurveyAns']['created_date'] = $this->Functions->get_current_date();
				$this->request->data['HrSurveyAns']['app_users_id'] = $this->Session->read('USER.Login.id');
				$this->request->data['HrSurveyAns']['hr_survey_id'] = $survey_id;
				$this->HrSurveyAns->create();
				if(!$this->HrSurveyAns->save($this->request->data['HrSurveyAns'])) {	
					$save = false;
				}
			}
		}

		return $save;
	}
	
	
		
	/* function to validate the answers */
	public function validate_ans(){
		$submit = true;
		$tot = $this->request->data['HrSurveyAns']['tot_qn'];
		for($i = 1; $i <= $tot; $i++){
			if(trim($this->request->data['HrSurveyAns']['qn'.$i]) == ''){
				$submit = false;
			}
		}
		return $submit;
	}
	
	
	/* function to show the late hr status */
	public function late_hr_status(){
		$this->layout = 'iframe_dash';
		$this->Home->unbindModel(array('hasOne' => array('Todo')));
		for($i = 1; $i <= date('m'); $i++){
			$mon = $i < 10 ? '0'.$i : $i;
			$monthChk =  date('Y').'-'.$mon;
			//$monthChk =  date('Y-m');
			// get the attendance of the user
			$this->loadModel('HrAttendance');
			$all_att_data = $this->HrAttendance->find('all', array('fields' => array('in_time', 'out_time','status','reject_reason'), 'conditions' => array('app_users_id' => $this->Session->read('USER.Login.id'), 'in_time like' => $monthChk.'%', 'att_waive' => ''), 'order' => array('in_time' => 'asc'))); 
			//$this->set('selMonth', $monthChk);
			//$this->set('all_att_data', $att_data);	
			// load leave types
			$this->load_leave_types($this->Session->read('USER.Login.gender'), $this->Session->read('USER.Login.id'),$this->Session->read('USER.Login.doj'),$this->Session->read('USER.Login.emp_type'));		
			// get leaves remaining
			$year  = explode('-', $monthChk);
			$this->get_used_leaves($this->Session->read('USER.Login.id'),$this->Session->read('USER.Login.doj'),$this->Session->read('USER.Login.emp_type'),$this->Session->read('USER.Login.doc'));
			// get used permissions
			$this->get_used_perms($monthChk,$this->Session->read('USER.Login.id'));
			// get the leaves of the user
			$leave_data_user = $this->get_applied_leaves($monthChk, $this->Session->read('USER.Login.id'));
			// get the comp off days of user
			$this->get_compoff_details($this->Session->read('USER.Login.id'),$this->Session->read('USER.Login.emp_type'),$this->Session->read('USER.Login.work_place'));
			// get holidays of this month
			$holidayList = $this->get_holidays_month($monthChk,$this->Session->read('USER.Login.hr_branch_id'));			
			// get happy leave of this month
			$this->get_happy_leave($this->Session->read('USER.Login.id'));			
			// calculate late timing
			// get office time for late attendance
			$this->loadModel('HrOfficeTiming');
			$office_timing = $this->HrOfficeTiming->find('all', array('fields' => array('start_time', 'end_time', 'grace_time'),'conditions' => array('app_users_id' => $this->Session->read('USER.Login.id')), 'limit' => '1'));
			$end_time = $office_timing[0]['HrOfficeTiming']['end_time'];
			$start_time = $office_timing[0]['HrOfficeTiming']['start_time'];
			if(!empty($start_time)){		
				$minutes = $this->Functions->check_grace($monthChk, $office_timing[0]['HrOfficeTiming']['grace_time'], 'Y-m');
				$time = strtotime('2014-05-16 '.$start_time);
				$no_grace_time = date('H:i', $time);
				$time += 60 * $minutes;
				$office_time = date('H:i', $time);
			}else{
				$start_time = '09:30';
				$no_grace_time = $start_time;
				$time = strtotime('2014-05-16 '.$start_time);
				$time += 60 * 10;
				$office_time = $start_time;
			}		
			// get permissions to reduce leave hours
			$this->loadModel('HrPermission');
			$this->HrPermission->unBindModel(array('hasOne' => array('HrPerStatus', 'HrPerUser'), 'belongsTo' => array('Home')));
			$data = $this->HrPermission->find('all', array('fields' => array('per_date', 'no_hrs'), 'conditions' => array('HrPermission.app_users_id' => $this->Session->read('USER.Login.id'), 'per_date like' => $monthChk.'%', 'per_from like' => '%'.$start_time.'%', 'HrPermission.is_deleted' => 'N', 'is_approve' => 'Y')));
			foreach($data as $per_data){
				$perData[$per_data['HrPermission']['per_date']] = $per_data['HrPermission']['no_hrs'];
			}
			
			$month = explode('-', $monthChk);
			$no_days =  date('t',strtotime($month[0].'-'.$month[1].'-1'));
			$in_data = $this->Functions->format_in_att_data($all_att_data, $no_days ,$month[0],$month[1]);
			
			
			$late = '';			
			for($j = 1; $j <= $no_days; $j++){	
				if(!empty($in_data[$j])){
					$day_no = date('d', strtotime($month[0].'-'.$month[1].'-'.$j));
					$date = $day_no.'-'.date('M', strtotime($month[0].'-'.$month[1].'-'.$j)).'-'.$month[0];
					$leave_rec = $this->Functions->check_leave_taken($day_no,$month[1], $month[0],$in_data[$j], $leave_data_user, $holidayList);
					if(empty($leave_rec)){
						$late += $this->Functions->check_late($office_time, date('H:i', strtotime($in_data[$j])), 'admin', $perData, date('Y-m-d', strtotime($date)),$no_grace_time);
					}
				}
			}
			
			
			
			// for the current month
			if(date('m') == $month[1]){
				$this->set('late_month', $late);
			}

			$total_late += $late;
		}
		// get attendance late timing deducted
		$deduct_late = $this->calculate_late_deduct($this->Session->read('USER.Login.id'));
		// get attendance late timing for add
		$add_late = $this->calculate_late_addition($this->Session->read('USER.Login.id'));
		
		$this->set('late_year', ($total_late - $deduct_late) + $add_late);
	}
	
	
	/* function to show the leave status */
	public function leave_status(){
		$this->layout = 'iframe_dash';
		$this->eval_leave_status($this->Session->read('USER.Login.id'),$this->Session->read('USER.Login.hr_branch_id'),'','',$this->Session->read('USER.Login.doj'));
		$this->render('/Elements/leave_status_detail/');
	}
	
	
		
	/* function to show the task report */
	public function task_report($id, $date){
		$this->layout = 'iframe_dash';		
		$user_id = $id ? $id : $this->Session->read('USER.Login.id');
		$month_cond = $date ? $date : date('Y-m');
		$year_cond = explode('-', $month_cond);
		// generate monthly task
		$month_result = $this->Home->get_month_task($user_id, $month_cond);
		$this->set('month_task_data', $month_result);
		// generate yearly task
		$year_result = $this->Home->get_month_task($user_id, $year_cond[0]);
		$this->set('year_task_data', $year_result);
		
		$this->set('year_val', $year_cond[0]);
		$this->set('month_val', date('M', strtotime(date($month_cond.'-01'))));
		
	}
	
	/* function to show the finance report */
	public function fin_report($id){
		$this->layout = 'iframe_dash';		
		$user_id = $id ? $id : $this->Session->read('USER.Login.id');	
		$this->eval_fin_status($user_id);
	}
	
	/* function to show the career levels */
	public function career_levels(){
		$this->layout = 'iframe';
	}
	
	/* function to show the budget details */
	public function budget(){
		$this->layout = 'iframe';
	}
	
	/* function to view roa */
	public function view_roa($month, $user){
		$this->layout = 'iframe';
		$this->loadModel('TskRoaApprove');
			$options = array(					
					array('table' => 'tsk_applause_member',
							'alias' => 'ApplauseMember',					
							'type' => 'INNER',
							'conditions' => array('`TskRoaApprove`.`id` = `ApplauseMember`.`tsk_applause_id`')
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
							'conditions' => array('`TskStar`.`tsk_applause_id` = `TskRoaApprove`.`id`')
					),
					array('table' => 'tsk_applause_cat_user',
							'alias' => 'TskRoaCatUser',					
							'type' => 'INNER',
							'conditions' => array('`TskRoaCatUser`.`tsk_applause_id` = `TskRoaApprove`.`id`')
					),
					array('table' => 'tsk_applause_category',
							'alias' => 'TskRoaCat',					
							'type' => 'INNER',
							'conditions' => array('`TskRoaCatUser`.`tsk_applause_category_id` = `TskRoaCat`.`id`')
					),
					array('table' => 'app_users',
							'alias' => 'Employee',					
							'type' => 'INNER',
							'conditions' => array('`Employee`.`id` = `TskRoaApprove`.`app_users_id`')
					)
				);
				$data = $this->TskRoaApprove->find('all', array('fields' => array('id','reward_month', 'group_concat(Distinct TskStar.star_type) as star_type', 'rating',
				'emp_acts','emp_relate','type','Employee.first_name','Homes2.first_name','Homes2.last_name',
				"group_concat(Distinct TskRoaCat.title SEPARATOR ', ') as roa_category"),
				'conditions' => array('reward_month' => $month, 'ApplauseMember.app_users_id' => $user, 'is_approve' => 'Y'),
				'joins' => $options));
				$this->set('roa_data', $data[0]);
	}

	
}