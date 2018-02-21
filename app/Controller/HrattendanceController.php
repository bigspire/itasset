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
 
class HrAttendanceController  extends AppController {  
	
	public $name = 'HrAttendance';	
	
	public $helpers = array('Html', 'Form', 'Session');
	
	public $components = array('Session', 'Functions');
	
	public $layout = 'apps';	
	
	
	public function index(){
		// set the page title
		$this->set('title_for_layout', 'Attendance - HRIS - My PDCA');
		if($this->request->query['type'] == 'team'){ 
			$reset = '?type='.$this->request->query['type'];
			$this->set('reset', $reset);
		}
		// when the form submitted
		if($this->request->is('post')){
			// check for team member
			if($this->request->query['type'] == 'team' && $this->Session->read('USER.Login.app_roles_id') != '18'){ 
				$this->validate_team($this->request->data['HrAttendance']['SearchText']);
			}
			$this->HrAttendance->set($this->request->data);
			// validate the attendance form
			if ($this->HrAttendance->validates(array('fieldList' => array('SearchText')))) {
				// check emp. id or emp. no submitted
				if(intval($this->request->data['HrAttendance']['SearchText'])){
					$cond = array('HrEmployee.emp_no' => $this->request->data['HrAttendancer']['SearchText']);
				}else{
					$cond = array("CONCAT(trim(HrEmployee.first_name), ' ', trim(HrEmployee.last_name))" => trim($this->request->data['HrAttendance']['SearchText']));
				}
				$att_data = $this->HrAttendance->find('all', array('fields' => array('waive_msg','in_time', 'out_time','status','late_reason','reject_reason'), 'conditions' => array($cond, 'in_time like' => $this->request->data['HrAttendance']['att_year']['year'].'-'.$this->request->data['HrAttendance']['att_month']['month'].'%'), 'order' => array('in_time' => 'asc'))); 
				//print_r($att_data);
				
				$this->set('att_data', $att_data);
				// get emp. data
				$emp_data = $this->HrAttendance->HrEmployee->find('first', array('conditions' => array($cond), 'fields' => array('id', 'gender','probation','doj','emp_type','hr_branch_id','work_place','doc')));
				// get the late hr fty
				$this->late_hr_year($emp_data['HrEmployee']['id'],$emp_data['HrEmployee']['gender'],$emp_data['HrEmployee']['doj'],$emp_data['HrEmployee']['emp_type'],$emp_data['HrEmployee']['work_place'],$emp_data['HrEmployee']['hr_branch_id'],$emp_data['HrEmployee']['hr_branch_id'],$this->request->data['HrAttendance']['att_year']['year'],$this->request->data['HrAttendance']['att_month']['month']);
			}else{
				 $errors = $this->HrAttendance->validationErrors;				
				 $this->set('Error', $errors );
			}			
		}else{
			// set the default month
			$this->request->data['HrAttendance']['att_month']['month'] = date('F');
			$this->request->data['HrAttendance']['att_year']['year'] = date('Y');
		}
		
		$date = $this->request->data['HrAttendance']['att_year']['year'].'-'.$this->request->data['HrAttendance']['att_month']['month'];
		// get the leave details
		$this->get_leave_details($emp_data['HrEmployee']['id'],$date);
		// get the permission details
		$this->get_permission_details($emp_data['HrEmployee']['id'],$date);
		// load leave types
		$this->load_leave_types($emp_data['HrEmployee']['gender'], $emp_data['HrEmployee']['id'],$emp_data['HrEmployee']['doj'],$emp_data['HrEmployee']['emp_type']);
		$this->set('emp_type', $emp_data['HrEmployee']['emp_type']);
		// get leaves remaining
		$this->get_used_leaves($emp_data['HrEmployee']['id'],$emp_data['HrEmployee']['doj'],$emp_data['HrEmployee']['emp_type'],$emp_data['HrEmployee']['doc']);
		// get permission remaining
		$this->get_used_perms($date, $emp_data['HrEmployee']['id']);
		// get the leaves of the user
		$this->get_applied_leaves($date, $emp_data['HrEmployee']['id']);
		// get the comp off days of user
		$this->get_compoff_details($emp_data['HrEmployee']['id'],$emp_data['HrEmployee']['emp_type'],$emp_data['HrEmployee']['work_place']);
		// get holidays of this month
		$holid = $this->get_holidays_month($this->request->data['HrAttendance']['att_year']['year'].'-'.$this->request->data['HrAttendance']['att_month']['month'],$emp_data['HrEmployee']['hr_branch_id']);	
		// get happy leave of this month
		$this->get_happy_leave($emp_data['HrEmployee']['id']);
		// get office time for late attendance
		$this->loadModel('HrOfficeTiming');
		$office_timing = $this->HrOfficeTiming->find('all', array('fields' => array('start_time', 'end_time', 'grace_time'),'conditions' => array('app_users_id' => $emp_data['HrEmployee']['id']), 'limit' => '1'));
		$end_time = $office_timing[0]['HrOfficeTiming']['end_time'];
		$start_time = $office_timing[0]['HrOfficeTiming']['start_time'];
		if(!empty($start_time)){		
			$minutes = $this->Functions->check_grace($this->request->data['HrAttendance']['att_year']['year'].'-'.$this->request->data['HrAttendance']['att_month']['month'],$office_timing[0]['HrOfficeTiming']['grace_time'], 'Y-m');
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
		
		// get attendance late timing deducted
		$this->calculate_late_deduct($emp_data['HrEmployee']['id']);
		// get attendance late timing for add
		$this->calculate_late_addition($emp_data['HrEmployee']['id']);
		
		// get permissions to reduce leave hours
		$this->loadModel('HrPermission');
		$data = $this->HrPermission->find('all', array('fields' => array('per_date', 'no_hrs'), 'conditions' => array('HrPermission.app_users_id' => $emp_data['HrEmployee']['id'], 'per_date like' => $date.'%', 'per_from like' => '%'.$start_time.'%', 'HrPermission.is_deleted' => 'N', 'is_approve' => 'Y')));
		foreach($data as $per_data){
			$perData[$per_data['HrPermission']['per_date']] = $per_data['HrPermission']['no_hrs'];
		}
		$this->set('permData', $perData);
		// assign emp. id
		$this->set('emp_id', $emp_data['HrEmployee']['id']);
		$this->set('branch_id', $emp_data['HrEmployee']['hr_branch_id']);
		$this->set('date_val', $date);
		$date_split = explode('-', $date);
		$this->set('year_val', $date_split[0]);
		$this->set('doj', $emp_data['HrEmployee']['doj']);
	}
	
	
	
	
	/* get the permission details */
	public function get_leave_details($id,$date){
		$this->loadModel('HrLeave');
		$options = array(			
			array('table' => 'hr_leave_status',
					'alias' => 'HrLeaveStatuses',					
					'type' => 'LEFT',
					'conditions' => array('`HrLeaveStatuses`.`hr_leave_id` = `HrLeave`.`id`')
			),
			array('table' => 'app_users',
					'alias' => 'Homes',					
					'type' => 'LEFT',
					'conditions' => array('`HrLeaveStatuses`.`app_users_id` = `Homes`.`id`')
			)
		);
			
		$dateCond = array('or' => array('leave_from between ? and ?' => array($date.'-01', $date.'-31'),'leave_to between ? and ?' => array($date.'-01', $date.'-31'))); 
		
		$this->HrLeave->unBindModel(array('hasOne' => array('HrLeaveStatus')));
		$this->HrLeave->unBindModel(array('belongsTo' => array('Home')));

		
		$data = $this->HrLeave->find('all', array('fields' => array('id','leave_from', 'leave_to','reason', 'no_days','HrLeaveType.desc', 
		'created_date','group_concat(HrLeaveStatuses.status) as st_status', 'group_concat(Homes.first_name) as st_user',
		'group_concat(HrLeaveStatuses.modified_date) as st_modified','group_concat(HrLeaveStatuses.created_date) as st_created', 
		'group_concat(HrLeaveStatuses.remarks) as st_remarks'),'conditions' => 
		array('HrLeave.app_users_id' => $id,'HrLeave.is_deleted' => 'N', $dateCond), 'order' => array('created_date' => 'desc'), 
		'group' => array('HrLeave.id'), 'joins' => $options));	
		
		$this->set('leave_data', $data);
	}
	
	/* get the permission details */
	public function get_permission_details($id,$date){
		$this->loadModel('HrPermission');
		$options = array(			
			array('table' => 'hr_permission_status',
					'alias' => 'HrPerStatuses',					
					'type' => 'LEFT',
					'conditions' => array('`HrPerStatuses`.`hr_permission_id` = `HrPermission`.`id`')
			),
			array('table' => 'app_users',
					'alias' => 'Homes',					
					'type' => 'LEFT',
					'conditions' => array('`HrPerStatuses`.`app_users_id` = `Homes`.`id`')
			)
		);
			
		$dateCond = array('or' => array('per_date between ? and ?' => array($date.'-01', $date.'-31'))); 
		
		$this->HrPermission->unBindModel(array('hasOne' => array('HrPerStatus')));
		$this->HrPermission->unBindModel(array('belongsTo' => array('Home')));

		// fetch the advances		
		$this->paginate = array();
		$data = $this->HrPermission->find('all', array('fields' => array('id','per_from','per_date', 'per_to','reason', 'no_hrs', 'created_date',
		'group_concat(HrPerStatuses.status) as st_status', 'group_concat(Homes.first_name) as st_user', 'group_concat(HrPerStatuses.modified_date) 
		as st_modified','group_concat(HrPerStatuses.created_date) as st_created', 'group_concat(HrPerStatuses.remarks) as st_remarks'),'limit' => 10,
		'conditions' => array('HrPermission.app_users_id' => $id,'HrPermission.is_deleted' => 'N',$dateCond), 'order' => array('created_date' => 'desc'), 
		'group' => array('HrPermission.id'), 'joins' => $options));
		$this->set('per_data', $data);
	}
	
		/* auto complete search */	
	public function search(){ 
		$this->layout = false;	 
		$q = trim(Sanitize::escape($_GET['q']));	
		if(!empty($q)){
			if($this->request->query['type'] == 'team'  && $this->Session->read('USER.Login.app_roles_id') != '18'){
				$this->HrAttendance->HrEmployee->bindModel(
					array('hasOne' => array(
							'Approve' => array(
								'className' => 'Approve',
								'foreignKey' => 'app_users_id'
								)
							)
						)
					);
					$cond = array('or' => array('Approve.level1' => $this->Session->read('USER.Login.id'),
							'Approve.level2' => $this->Session->read('USER.Login.id')), 'AND' => array('Approve.type' => 'L'));					
			}
			// execute only when the search keywork has value		
			$this->set('keyword', $q);
			$data = $this->HrAttendance->HrEmployee->find('all', array('fields' => array('HrEmployee.full_name','HrEmployee.emp_no'),  'group' => array('HrEmployee.full_name','emp_no'), 'conditions' => 	array("OR" => array ('emp_no like' => '%'.$q.'%','HrEmployee.full_name like' => '%'.$q.'%'), 'AND' => array('HrEmployee.is_deleted' => 'N'), $cond)));		
			$this->set('results', $data);
		}
    }
	
	
	/* function to validate the team member */
	public function validate_team($q){
			$this->HrAttendance->HrEmployee->bindModel(
					array('hasOne' => array(
							'Approve' => array(
								'className' => 'Approve',
								'foreignKey' => 'app_users_id'
								)
							)
						)
					);
			$cond = array('or' => array('Approve.level1' => $this->Session->read('USER.Login.id'),
							'Approve.level2' => $this->Session->read('USER.Login.id')), 'AND' => array('Approve.type' => 'L'));					
			
			// execute only when the search keywork has value		
			$this->set('keyword', $q);
			$data = $this->HrAttendance->HrEmployee->find('all', array('fields' => array('HrEmployee.full_name','HrEmployee.emp_no'),  'group' => array('HrEmployee.full_name','emp_no'), 'conditions' => 	array("OR" => array ('emp_no like' => '%'.$q.'%','HrEmployee.full_name like' => '%'.$q.'%'), 'AND' => array('HrEmployee.is_deleted' => 'N'), $cond)));		
			if(empty($data)){
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Invalid Attempt', 'default', array('class' => 'alert'));				
				$this->redirect('/');
			}
	}
	

	
	public function beforeFilter() { 
		//$this->disable_cache();
		if($this->request->query['type'] == 'team'){
			$id = '95';
			$this->set('is_team', 'Team');
			$this->set('is_team_url', '?type=team');
		}else{
			$this->set('is_team', 'Employee');
			$id = '33';
		}
		$this->show_tabs($id);
	}
	
	/* function to calculate the total late hrs */
	public function late_hr_year($id,$gender,$doj,$emp_type,$work,$branch,$doc, $years, $months){
		//$this->Home->unbindModel(array('hasOne' => array('Todo')));
		for($k = 1; $k <= intval($months) + 2; $k++){
			$months = $k == 1 ? $months : $months - 1;
			$months = $k != 1 & $months < 10 ? '0'.$months : $months;
			$monthChk =  $years.'-'.$months;	 
			//$monthChk =  date('Y-m');
			// get the attendance of the user
			$this->loadModel('HrAttendance');
			$all_att_data = $this->HrAttendance->find('all', array('fields' => array('in_time', 'out_time','status','reject_reason'), 'conditions' => array('app_users_id' => $id, 'in_time like' => $monthChk.'%', 'att_waive' => ''), 'order' => array('in_time' => 'asc'))); 
			
			//$this->set('selMonth', $monthChk);
			//$this->set('all_att_data', $att_data);	
			// load leave types
			$this->load_leave_types($gender, $id,$doj,$emp_type);		
			// get leaves remaining
			$year  = explode('-', $monthChk);
			$this->get_used_leaves($id,$doj,$emp_type,$doc);
			// get used permissions
			$this->get_used_perms($monthChk,$id);
			// get the leaves of the user
			$leave_data_user = $this->get_applied_leaves($monthChk, $id);
			// get the comp off days of user
			$this->get_compoff_details($id,$emp_type,$this->Session->read('USER.Login.work_place'));
			// get holidays of this month
			$holidayList = $this->get_holidays_month($monthChk,$branch);			
			// get happy leave of this month
			$this->get_happy_leave($id);
			// calculate late timing
			// get office time for late attendance
			$this->loadModel('HrOfficeTiming');
			$office_timing = $this->HrOfficeTiming->find('all', array('fields' => array('start_time', 'end_time', 'grace_time'),'conditions' => array('app_users_id' => $id), 'limit' => '1'));
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
			$data = $this->HrPermission->find('all', array('fields' => array('per_date', 'no_hrs'), 'conditions' => array('HrPermission.app_users_id' => $id, 'per_date like' => $monthChk.'%', 'per_from like' => '%'.$start_time.'%', 'HrPermission.is_deleted' => 'N', 'is_approve' => 'Y')));
			foreach($data as $per_data){
				$perData[$per_data['HrPermission']['per_date']] = $per_data['HrPermission']['no_hrs'];
			}
			
			$month = explode('-', $monthChk);
			$no_days =  date('t',strtotime($month[0].'-'.$month[1].'-1'));			
			$in_data = $this->Functions->format_in_att_data($all_att_data, $no_days ,$month[0],$month[1]);
			$late = '';
			for($j = 1; $j <= $no_days; $j++){
				if(!empty($in_data[$j])){
					$month[0].'-'.$month[1].'-'.$j; 
					$day_no = date('d', strtotime($month[0].'-'.$month[1].'-'.$j));
					
					$date = $day_no.'-'.date('M', strtotime($month[0].'-'.$month[1].'-'.$j)).'-'.$month[0];
					$leave_rec = $this->Functions->check_leave_taken($day_no,$month[1], $month[0],$in_data[$j], $leave_data_user, $holidayList);
					if(empty($leave_rec)){						
						$late += $this->Functions->check_late($office_time, date('H:i', strtotime($in_data[$j])), 'admin', $perData, date('Y-m-d', strtotime($date)),$no_grace_time);
					}
				}
			}

			$total_late += $late;
		}
			
			
			$this->set('late_year', $total_late);
	}
	

	/* function to show the leave status */
	public function leave_status($id, $branch, $date,$doj){
		$this->layout = 'iframe_dash';
		$this->eval_leave_status($id,$branch,$date, $doj);
		$date_split = explode('-', $date);
		$this->set('year_val', $date_split[0]);
		$this->set('month_val', date('M', strtotime('2015-'.$date_split[1].'-01')));
		$this->render('/Elements/leave_status_detail/');
	}
	
	
		
	/* function to waive off the employee late attendance */
	public function waive_off($id, $tot_late){
		$this->layout = 'iframe';
		$this->loadModel('HrWaiveOff');
		// get the user details
		$emp_data = $this->HrWaiveOff->HrEmployee->findById($id, array('fields' => 'first_name','last_name'));
		$this->set('emp_data', $emp_data);
		if ($this->request->is('post')){
			// validates the form
			$this->HrWaiveOff->set($this->request->data);
			if ($this->HrWaiveOff->validates(array('fieldList' => array('minute','remarks')))) {
				$this->request->data['HrWaiveOff']['created_by'] = $this->Session->read('USER.Login.id');				
				$this->request->data['HrWaiveOff']['created_date'] = $this->Functions->get_current_date();
				$this->request->data['HrWaiveOff']['reason'] = $this->request->data['HrWaiveOff']['reason'] ? $this->request->data['HrWaiveOff']['reason'] : 'E';
				$this->request->data['HrWaiveOff']['late_type'] = $this->request->data['HrWaiveOff']['late_type'] ? $this->request->data['HrWaiveOff']['late_type'] : 'S';	
				$this->request->data['HrWaiveOff']['tot_hr'] = date('H:i', mktime(0,$this->request->data['HrWaiveOff']['minute']));
				$this->request->data['HrWaiveOff']['app_users_id'] = $id;	
				// save the data
				if($this->HrWaiveOff->save($this->request->data['HrWaiveOff'])){
					$this->set('data_save', 'ok');
					// send mail to l1, l2 and director
					// get director details
					$direc_data = $this->HrWaiveOff->HrEmployee->find('all', array('fields'=> array('HrEmployee.id'),'conditions' => 
					array('app_roles_id' => '18', 'HrEmployee.status' => '1'), 'group' => array('HrEmployee.id')));
					$user_id[] = $direc_data[0]['HrEmployee']['id'];
					$this->loadModel('Approval');
					// get the superiors
					$approval_data = $this->Approval->find('first', array('fields' => array('level1','level2'), 'conditions'=> array('Approval.app_users_id' => $id, 'type' => 'L')));
					$user_id[] = $approval_data['Approval']['level1'];	
					$user_id[] = $approval_data['Approval']['level2'];
					$superior_data = $this->HrWaiveOff->HrEmployee->find('all', array('fields'=> array('id','first_name','last_name','email_address'),
					'conditions' => array('HrEmployee.id' => $user_id), 'group' => array('HrEmployee.id')));
					// iterate the superiors to send mail
					foreach($superior_data as $superior){
						if($superior['HrEmployee']['id'] != $this->Session->read('USER.Login.id')){
							$name = $superior['HrEmployee']['first_name'].' '.$superior['HrEmployee']['last_name'];
							// send mail to the user
							$sub = 'My PDCA - '.$emp_data['HrEmployee']['first_name'].' '.$emp_data['HrEmployee']['last_name'].' Late Minutes Waived!';
							$vars = array('from_name' => 'noreply@mypdca.in', 'name' => $name, 'remarks' => $this->request->data['HrWaiveOff']['remarks'], 'minute' => $this->request->data['HrWaiveOff']['minute'],			
							'employee' => $emp_data['HrEmployee']['first_name'].' '.$emp_data['HrEmployee']['last_name'], 'tot_late' => $tot_late);
							// notify superiors						
							$this->send_email($sub, 'notify_waive_off', 'noreply@mypdca.in', $superior['HrEmployee']['email_address'],$vars);
						}
					}
					// show the msg.
					$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Late minutes waived off successfully', 'default', array('class' => 'alert alert-success'));					
					echo "<script>parent.location.reload()</script>";
				}else{
					$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in saving the data...', 'default', array('class' => 'alert alert-error'));
				}
			}else{
				//$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Problem in submitting the form. please check errors...', 'default', array('class' => 'alert alert-error'));	
			}
		}
	}
	
	
}