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

	/* function to login the employer */
	public function index(){	
		// set the page title
		$this->set('title_for_layout', 'Home - My PDCA');			
		// fetch all members in the company
		$this->Home->unbindModel(array('hasOne' => array('Todo')));
		$data = $this->Home->find('all', array('fields' => array('id','HrBranch.branch_name', 'HrDepartment.id','HrDesignation.id','gender','first_name', 'email_address','last_name', 'photo', 'photo_status','HrDepartment.dept_name','HrDesignation.desig_name','official_contact_no'), 'conditions' => array('Home.is_deleted' => 'N','Home.status' => '1'), 'order' => array('Home.first_name' => 'asc')));
		$this->set('member_data', $data);
		// fetch the users todo
		$this->get_users_todo();
				
		// get the today's attendance
		$this->set_today_attendance();		
		
		// get the attendance of the user
		$att_data = $this->HrAttendance->find('all', array('fields' => array('in_time', 'out_time','status','reject_reason'), 'conditions' => array('app_users_id' => $this->Session->read('USER.Login.id'), 'in_time like' => date('Y').'-'.date('m').'%'), 'order' => array('in_time' => 'asc'))); 
		$this->set('selMonth', date('Y-m'));	
		$this->set('all_att_data', $att_data);
				
		
		$this->get_office_time();
				
		// load att. approve data
		$this->load_att_approve();		
		
		// load leave types
		$this->load_leave_types($this->Session->read('USER.Login.gender'), $this->Session->read('USER.Login.id'));
		// get leaves remaining
		$this->get_used_leaves($this->Session->read('USER.Login.id'));
		// get used permissions
		$this->get_used_perms(date('Y-m'), $this->Session->read('USER.Login.id'));
		// get the leaves of the user
		$this->get_applied_leaves(date('Y-m'), $this->Session->read('USER.Login.id'));
		// get the today leave of user
		$today = date('Y-m-d');
		$today_leave =  $this->HrLeave->get_leave_day($today, $this->Session->read('USER.Login.id'));
		if($today_leave){
			$this->set('NO_ATTENDANCE', 1);
		}
		// get the comp off days of user
		$this->get_compoff_details($this->Session->read('USER.Login.id'));
		// get holidays of this month
		$this->get_holidays_month(date('Y-m'));
		
		
		// get list of holidays for the user
		$this->Home->unbindModel(array('hasOne' => array('Todo')));
		$this->loadModel('HrHoliday');
		$holiday_list = $this->HrHoliday->find('all', array('fields' => array('event', 'event_date', 'desc'), 'conditions' => array('hr_branch_id' => $this->Session->read('USER.Login.hr_branch_id'), 'HrHoliday.status' => '1',  'HrHoliday.is_deleted' => 'N', 'event_date like' => date('Y').'%'), 'order' => array('event_date' => 'asc')));		
		$this->set('holidayData', $holiday_list);
		// fetch user details
		$this->Home->unbindModel(array('hasOne' => array('Todo')));
		$data = $this->Home->findById($this->Session->read('USER.Login.id'),  array('id','gender','full_name', 'email_address','wedding_date', 'photo','HrBranch.branch_name', 'HrCompany.company_name', 'HrDepartment.dept_name','HrDesignation.desig_name','photo_status','contact_no','dob','doj','emp_no','landline','communication_addr','permanent_addr','blood_group','marital_status','emergency_contact_person','emergency_contact_no','pf_no','esi_no','official_contact_no','pan','emergency_relation','HrBusinessUnit.business_unit','HrBloodGroup.blood_group','probation'));
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
		
		// to get the form data
		$this->loadModel('HrForm');
		$form_data = $this->HrForm->find('all', array('fields' => array('form','desc','attachment','created_date','modified_date'), 'conditions'=> array('HrForm.is_deleted' => 'N', 'status' => '1'), 'order' => array( 'created_date' => 'desc')));		
		$this->set('form_data', $form_data);
		// get the latest news
		$this->loadModel('HrLatest');
		$news_date_cond = $this->get_news_date();
		$news_data = $this->HrLatest->find('all', array('fields' => array('id','title','desc','attachment','created_date','modified_date'), 'conditions'=> array('HrLatest.is_deleted' => 'N', 'status' => '1', 'created_date >' => $news_date_cond), 'order' => array('created_date' => 'desc', 'created_date' => 'desc')));		
		$this->set('news_data', $news_data);
		// get the org. updates
		$this->loadModel('HrOrg');
		$org_data = $this->HrOrg->find('all', array('fields' => array('title','desc'), 'conditions'=> array('HrOrg.is_deleted' => 'N', 'status' => '1'), 'order' => array('created_date' => 'desc')));		
		$this->set('org_data', $org_data);
		
		// get the approved galleries to show
		$this->loadModel('HrGallery');
		$gal_data = $this->HrGallery->find('all', array('conditions' => array('is_approve' => 'Y', 'HrGallery.created_date >' => $news_date_cond), 'fields' => array('HrGallery.title','id', 'HrGallery.desc', 'HrGallery.folder','HrGallery.created_date'), 'group' => array('HrGallery.id'), 'order' => array('created_date' => 'desc')));
		$this->set('gallery_data', $gal_data);
		// get photos in the gallery
		foreach($gal_data as $data){
			$gal_item[$data['HrGallery']['id']][] = $this->HrGallery->HrGalleryItem->find('all', array('conditions' => array('HrGalleryItem.status' => '1', 'HrGalleryItem.hr_gallery_id' => $data['HrGallery']['id']), 'fields' => array('HrGalleryItem.file'), 'order' => array('HrGallery.created_date' => 'desc', 'HrGalleryItem.id' => 'asc')));
			 
		}		
		$this->set('gallery_item', $gal_item);
		
		// get new emails
		//$this->get_new_email();
		
		// get dashboard inner tabs
		$todo_count = $this->Home->Todo->find('count', array('conditions' => array('Todo.app_users_id' => $this->Session->read('USER.Login.id'),'is_deleted' => 'N', 'status' => '1')));
		$this->set('todo_count', $todo_count);
		
		// get app notification time
		$notify_data = $this->get_notification();
					
		$this->set_share_count($notify_data[0]['Notification']['modified_date']);
		
		$doj = $this->Session->read('USER.Login.doj');
		if(empty($doj)){
			$doj = Configure::read('ATT_START');
		}
		// get latest updates count
		$this->loadModel('HrLatest');
		$news_modified = $notify_data[1]['Notification']['modified_date'];
		if(empty($news_modified)){
			$news_modified = $doj.' 00:00:00';
		}
		
		$news_count_cond = strtotime($news_date_cond) > strtotime($news_modified) ? $news_date_cond : $news_modified;
 		$news_count = $this->HrLatest->find('count', array('conditions' => array('created_date >' => $news_count_cond, 'status' => '1', 'is_deleted' => 'N'))); 
		$this->set('news_count', $news_count);
		
		
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
		// get company name and logo
		$this->get_company_info();
		// get employee events
		$this->loadModel('TskEvent');
		$data = $this->TskEvent->find('count', array('fields' => array('id','title','start','end','details','status','TskEventType.color','TskEventType.name'),
		'conditions' => array('app_users_id' => $this->Session->read('USER.Login.id'), 'TskEvent.is_deleted' =>  'N','start >= ' =>  date('Y-m-d H:m')),
		'order' => array('start' => 'asc'), 'limit' => 10));
		$this->set('event_count', $data);
		
	
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
			$minutes = $office_timing[0]['HrOfficeTiming']['grace_time'];
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
		$data = $this->HrPermission->find('all', array('fields' => array('no_hrs'), 'conditions' => array('HrPermission.app_users_id' => $this->Session->read('USER.Login.id'), 'per_date' => date('Y-m-d'), 'per_from like' => '%'.$start_time.'%', 'HrPermission.is_deleted' => 'N', 'is_approve' => 'Y'), 'limit' => 1));
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
	
	
	
	/* function to load att. approve */
	public function load_att_approve(){
			// check l1 or l2
		$emp_list = $this->Home->get_team($this->Session->read('USER.Login.id'), 'L');	
		
		if(!empty($emp_list)){
			$this->set('apprv_att', 1);
			foreach($emp_list as $emp){
				$tm .= $emp['u']['id'].',';
			}
			$tm = substr($tm,0,strlen($tm)-1);	
			
			// get all waiting attendance for approval
			$att_st_data = $this->Home->get_tm_att($tm);
			$this->set('att_st_data', $att_st_data);
			$this->set('appr_count', count($att_st_data));
		}
		
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
			// reload the attendance
			//$this->load_att_approve();
			//$this->render('verify_att');
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
		$this->get_users_share();		
		
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
		header('Content-type: text/json');
		date_default_timezone_set('Asia/Calcutta');

		echo '[';
		$separator = "";
		$days = 16;

		$i = 1;
			echo $separator;
			$initTime = date("Y")."-".date("m")."-".date("d")." ".date("H").":00:00";
			//$initTime = date("Y-m-d H:i:00");
			echo '  { "date": "2014-10-08 05:30:00", "user": "Priya", "plan_date" : "08-Jun-2014", "type": "meeting", "title": "Recruitment Process", "start_time": "8:30am", "end_time": "6:30pm",  "description": "<i data-placement=bottom rel=tooltip class=\"show-tip click_hide cursor icon-circle unread\" original-title=\"Mark as Read\" title=\"Mark as Read\"></i>  <a href=#>Recruit 10 members for a Software Developer by 12th..</a> <a href=# style=color:#EF7575>view more</a>", "status": "<span class=\"label label-warning\">Postponed</span>", "plan_action": "Recruitment Drive", "plan_type": "<span title=\"Project Plan\" class=\"label label-warning\">P</span>", "url": "http://localhost/pdca_html/v1.3/view_plan.html" },';
			 echo '  { "date": "2014-10-10 05:30:00", "user": "Sundar", "plan_date" : "10-Jun-2014", "type": "meeting", "title": "Client Meeting", "start_time": "8:30am", "end_time": "6:30pm",  "description": "Going for the client meeting for new project on 10th... <a href=#>view more</a>", "status": "<i data-placement=bottom rel=tooltip class=\"show-tip click_hide cursor icon-circle unread\" original-title=\"Mark as Read\" title=\"Mark as Read\"></i> <span class=\"label label-success\">Executed</span>", "plan_action": "Recruitment Drive", "plan_type": "<span title=\"Daily Plan\" class=\"label label-success\">D</span>", "url": "http://localhost/pdca_html/v1.3/view_plan.html" },';
			 echo '  { "date": "2014-10-10 06:30:00", "user": "Sundar", "plan_date" : "10-Jun-2014", "type": "meeting", "title": "Client Meeting", "start_time": "8:30am", "end_time": "6:30pm",  "description": "Going for the client meeting for new project on 10th... <a href=#>view more</a>", "status": "<i data-placement=bottom rel=tooltip class=\"show-tip click_hide cursor icon-circle unread\" original-title=\"Mark as Read\" title=\"Mark as Read\"></i> <span class=\"label label-success\">Executed</span>", "plan_action": "Recruitment Drive", "plan_type": "<span title=\"Daily Plan\" class=\"label label-success\">D</span>", "url": "http://localhost/pdca_html/v1.3/view_plan.html" },';
			 echo '  { "date": "2014-10-10 08:30:00", "user": "Sundar", "plan_date" : "10-Jun-2014", "type": "meeting", "title": "Client Meeting", "start_time": "8:30am", "end_time": "6:30pm",  "description": "Going for the client meeting for new project on 10th... <a href=#>view more</a>", "status": "<i data-placement=bottom rel=tooltip class=\"show-tip click_hide cursor icon-circle unread\" original-title=\"Mark as Read\" title=\"Mark as Read\"></i> <span class=\"label label-success\">Executed</span>", "plan_action": "Recruitment Drive", "plan_type": "<span title=\"Daily Plan\" class=\"label label-success\">D</span>", "url": "http://localhost/pdca_html/v1.3/view_plan.html" },';
			 echo '  { "date": "2014-10-10 11:30:00", "user": "Sundar", "plan_date" : "10-Jun-2014", "type": "meeting", "title": "Client Meeting", "start_time": "8:30am", "end_time": "6:30pm",  "description": "Going for the client meeting for new project on 10th... <a href=#>view more</a>", "status": "<i data-placement=bottom rel=tooltip class=\"show-tip click_hide cursor icon-circle unread\" original-title=\"Mark as Read\" title=\"Mark as Read\"></i> <span class=\"label label-success\">Executed</span>", "plan_action": "Recruitment Drive", "plan_type": "<span title=\"Daily Plan\" class=\"label label-success\">D</span>", "url": "http://localhost/pdca_html/v1.3/view_plan.html" },';
			 echo '  { "date": "2014-10-10 22:30:00", "user": "Sundar", "plan_date" : "10-Jun-2014", "type": "meeting", "title": "Client Meeting", "start_time": "8:30am", "end_time": "6:30pm",  "description": "Going for the client meeting for new project on 10th... <a href=#>view more</a>", "status": "<i data-placement=bottom rel=tooltip class=\"show-tip click_hide cursor icon-circle unread\" original-title=\"Mark as Read\" title=\"Mark as Read\"></i> <span class=\"label label-success\">Executed</span>", "plan_action": "Recruitment Drive", "plan_type": "<span title=\"Daily Plan\" class=\"label label-success\">D</span>", "url": "http://localhost/pdca_html/v1.3/view_plan.html" },';

			  echo '  { "date": "2014-10-12 05:30:00", "user": "Vimal", "plan_date" : "12-Jun-2014", "type": "meeting", "title": "Documentation", "start_time": "8:30am", "end_time": "6:30pm",  "description": "Proposal preparation for temp staffing for new company.. <a href=#>view more</a>", "status": "<i data-placement=bottom rel=tooltip class=\"show-tip click_hide cursor icon-circle unread\" original-title=\"Mark as Read\" title=\"Mark as Read\"></i> <span class=\"label label-important\">Modified</span>", "plan_action": "Recruitment Drive", "plan_type": "<span title=\"Daily Plan\" class=\"label label-success\">D</span>", "url": "http://localhost/pdca_html/v1.3/view_plan.html" }';
		
			$separator = ",";

		echo ']';
		$this->render(false);		
		
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
	
	
	/* to sort the members in tab */
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
		
	}
	
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
			$this->loadModel('HrAttendance');
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
				}
			}else{
				echo 'marked';
				die;
			}
		}
		die;
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
		$this->show_tabs();
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
	
	/* function to save the share data */
	public function store_share(){ 
		$this->layout = 'ajax';			
		$data = array('share' => $this->request->query['tsk'], 'created_date' => $this->Functions->get_current_date(), 'app_users_id' => $this->Session->read('USER.Login.id'));
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
			if($this->Share->save($data, true, $fieldList = array('share','created_date','app_users_id'))){			 
			     // save the photo				
				if(!empty($_FILES['file']['name'])){
					$this->Share->id = $this->Share->id;
					$this->Share->saveField('attachment', $total.'_'.$_FILES['file']['name']);					
				}
				// fetch the share
				$this->get_users_share();
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
		
		
		$this->render('/Elements/share');
	}
	
	/* function to update the notification */
	public function update_notify(){
		$this->layout = 'ajax';	
		$tab = $this->request->query['tab'];
		$notify = $this->get_tab_val($tab);
		
		$this->loadModel('Notification');		
		$notify_data = $this->Notification->find('all', array('fields' => array('id'), 'conditions' => array('app_users_id' => $this->Session->read('USER.Login.id'), 'notify' => $notify)));
		print_r($notify_data);
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
			
		}
		return $val;		
	}
	
	/* function to reply share */
	public function reply_share(){ 
		$this->layout = 'refresh';		
		$data = array('share' => $this->request->query['tsk'], 'created_date' => $this->Functions->get_current_date(), 
		'app_users_id' => $this->Session->read('USER.Login.id'),'reply_id' => $this->request->query['id']);
		if ($this->request->is('get') && !empty($this->request->query['tsk'])) { 
			$this->loadModel('Share');
			// save the share
			if($this->Share->save($data, true, $fieldList = array('share','created_date','app_users_id','reply_id'))){
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
	public function get_users_share(){ 
		// fetch the share todo
		$this->loadModel('Share');
		$last_day = $this->share_start();
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
     	$data = $this->Home->get_share($this->Session->read('USER.Login.id'),$today, $last_day, $position, $items_per_group);	
		$this->set('share_data', $data);
		
		// fetch share replies
     	$data_reply = $this->Home->get_share_reply($this->Session->read('USER.Login.id'),$today, $last_day);
		//echo '<pre>';print_r($data_reply);
		$this->set('share_reply', $data_reply);
		
		// get company name and logo
		$this->get_company_info();		
		
		$this->render('/Elements/share');
		
	}
	
	/* function to get company info */
	public function get_company_info(){
		$this->loadModel('HrCompany');
		$comp_data = $this->HrCompany->findById('1', array('fields' => 'company_name', 'logo','address','city','landline','website'));		
		$this->set('comp_data', $comp_data);
	}
	
	/* get total users share */
	public function load_total_share(){
		// fetch share data
		$this->layout = 'refresh';	
		$last_day = $this->share_start();
		$today = $this->share_end();			
     	$total = $this->Home->get_total_share($this->Session->read('USER.Login.id'),$today, $last_day);		
		// calculate total group
		$items_per_group = 6;		
		echo $tot_group = ceil($total / $items_per_group);
			
			// get app notification time
		$notify_data = $this->get_notification();
					
		echo '|||'.$this->set_share_count($notify_data[0]['Notification']['modified_date']);
		
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
	
	
}