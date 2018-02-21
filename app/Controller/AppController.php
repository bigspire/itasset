<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
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
App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

	public $components = array('Session', 'Cookie','Functions','MobileDetect');	
	
	public $post_job_permission;
	
	
	// search profiles
	public $down_res_permission;
	public $save_res_permission;
	public $email_res_permission;
	public $hr_count, $fin_count, $adv_count, $exp_count, $leave_count, $per_count, $gal_count,$emp_count, $tsk_count,
		   $tsk_plan_count,$tsk_assign_count, $tsk_file_count,$tour_count,$tvl_apr_count, $tvl_tkt_count, $probation,
		   $biz_apr_count;
	

	/* function to check site maintenance */
	public function check_site_maintenance(){  // && $_SERVER['REMOTE_ADDR'] != '127.0.0.1'
		if(Configure::read('WEBSITE_MAINTENANCE') == 1){			
			echo file_get_contents(Configure::read('WEBSITE').$this->webroot.'maintenance.php');
			die;		
		}
		// for task manager dev.
		if(Configure::read('TASK_MANAGER') == 0 && $this->request->params['controller'] == 'tskhome'){			
			echo file_get_contents(Configure::read('WEBSITE').$this->webroot.'under_construction.php');
			die;		
		}
		// for biz tour
		if(Configure::read('BIZ_TOUR') == 0 && $this->request->params['controller'] == 'tvlhome'){			
			echo file_get_contents(Configure::read('WEBSITE').$this->webroot.'under_construction.php');
			die;		
		}
	}
	public function beforeRender(){ 
		// function to check site maintenance
		if($this->request->params['action'] != 'maintenance'){
			$this->check_site_maintenance();
		}
		// check mobile device
		if($this->request->params['controller'] != 'Logins'){
			$this->check_mobile_device();
		}
		
		if($this->request->params['controller'] != 'Logins' && $this->request->params['controller'] != 'hrpayslip' && $this->request->params['controller'] != 'hrreminder'){ 
			$this->check_session();
			$this->front_active_menus();			
			
		}		
		// assign cookie to var
		$this->set('cookie_color', $_COOKIE['my_login_cookie']);
		$this->set('cookie_color_code', $_COOKIE['my_login_cookie_code']);
		
		if($this->request->params['controller'] != 'Logins' && $this->request->params['controller'] != 'hrpayslip' && $this->request->params['controller'] != 'hrreminder'){ 
			if($this->check_session()){
				// menu counts
				$this->set('ADV_COUNT', $this->adv_count);
				$this->set('EXP_COUNT', $this->exp_count);
				$this->set('LEAVE_COUNT', $this->leave_count);
				$this->set('FIN_COUNT', $this->fin_count > 0 ? $this->fin_count : '');
				$this->set('HR_COUNT',  $this->hr_count > 0 ? $this->hr_count: '');
				$this->set('TSK_COUNT',  $this->tsk_count > 0 ? $this->tsk_count : '');
				$this->set('EMP_COUNT', $this->emp_count);
				$this->set('TSK_PLAN_COUNT', $this->tsk_plan_count);
				$this->set('TSK_ASSIGN_COUNT', $this->tsk_assign_count);
				$this->set('TOUR_COUNT',  $this->tour_count > 0 ? $this->tour_count : '');
				$this->set('TVL_TOT_APR', $this->tvl_apr_count);
				$this->set('TVL_TOT_TKT', $this->tvl_tkt_count);
				// for bd module
				$this->check_spoc_user(); 
				$this->set('BD_COUNT', $this->biz_apr_count);
				$tot_value = $this->fin_count + $this->hr_count + $this->tsk_count + $this->tour_count + $this->biz_apr_count;
				$this->set('TOT_COUNT', $tot_value > 0 ? $tot_value : '');	
				
			}
		}
	
		// load current theme
		$this->get_user_theme();
		
	}
	
	/* function to check mobile device */
	public function check_mobile_device(){
		// allow for director and admin
		if($this->Session->read('USER.Login.id') != '54' && $this->Session->read('USER.Login.app_roles_id') != '18' && $this->Session->read('USER.Login.id') != '72'){
			if($this->request->is('mobile')){
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Oops! MyPDCA is not available in mobile!', 'default', array('class' => 'alert alert-error'));
				$this->invalid_access();
			}
		}
	}
	
	function get_notifications(){
		$hrcount = $this->hr_count > 0 ? $this->hr_count: '';
		$fincount = $this->fin_count > 0 ? $this->fin_count: '';
		$tskcount = $this->tsk_count > 0 ? $this->tsk_count: '';
		$tourcount = $this->tour_count > 0 ? $this->tour_count: ''; 
		// for bd module
		$this->check_spoc_user();
		$bizcount = $this->biz_apr_count > 0 ? $this->biz_apr_count: ''; 
		return 'HR-'.$hrcount.':FIN-'.$fincount.':TSK-'.$tskcount.':TVL-'.$tourcount.':BD-'.$bizcount;		
	}
	
	/* function to set the menu active */
	public function front_active_menus(){ 
		$this->set($this->request->params['controller'].'_menu', 'active');
		
	}
	
	
	/* function to delete cookie */
	public function delete_cookie($name){		  
		$this->Cookie->delete($name); 

	}
	
	/* function to set users theme */
	public function get_user_theme(){
		// set users theme from cookie
		$theme = $_COOKIE['my_login_cookie'];
		// set default theme if not selected
		if($theme == ''){
			$theme = 'blue';
			setcookie('my_login_cookie', $theme, time()+60*60*24*30*12, '/', Configure::read('WEBSITE'));
		}
		
		$this->set('my_theme', $theme);		
	}
	
	
	/* function to check the users session */
	public function check_session(){		
		$this->disable_cache(); 
		//$this->Session->destroy();
		if(count($this->Session->read('USER'))){	
			return true;
		}else if($this->Cookie->read('PDCAUSER') != ''){
			$this->loadModel('Login');
			$data = $this->Login->find('first', array('fields' => array('first_name','last_name','email_address','id','status', 'gender', 'doj','last_login','photo','hr_branch_id', 'app_roles_id','hr_department_id','tshirt','hr_business_unit_id','notify_user','emp_type','work_place','doc','probation','att_type'),'conditions' =>array('Login.id' => $this->Functions->decrypt($this->Cookie->read('PDCAUSER')), 'is_deleted' => 'N', 'status' => '1')));					
			if(empty($data)){
					$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Invalid Attempt', 'default', array('class' => 'alert'));				
					$this->redirect('/');
			}
			$this->Session->write('USER', $data);	
			return true;
		}else if($this->Cookie->read('PDCAUSER') == ''){
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Session got expired', 'default', array('class' => 'alert'));	
			echo "<script>location.href=$this->webroot</script>";
			$this->redirect('/');
		}else{
			$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert">&times;</button>Session got expired', 'default', array('class' => 'alert'));
			$this->delete_cookie('PDCAUSER');	
			$this->redirect('/');
		}
	}
	
		
	/* function to disable the browser cache */
	function disable_cache(){
		$this->disableCache();		 
		header( 'Expires: Sat, 26 Jul 1997 05:00:00 GMT' ); 
		header( 'Last-Modified: ' . gmdate( 'D, d M Y H:i:s' ) . ' GMT' ); 
		header( 'Cache-Control: no-store, no-cache, must-revalidate' ); 
		header( 'Cache-Control: post-check=0, pre-check=0', false ); 
		header( 'Pragma: no-cache'); 
		
	}
	
	/* function to show/hide the top menu tabs */
	function show_tabs($cur_module){ 
		$this->check_session();
		$this->loadModel('Permission');
		$permissions = $this->Permission->find('all', array('fields' => array('app_modules_id'), 'conditions' => array('app_roles_id' => $this->Session->read('USER.Login.app_roles_id'))));	
		//echo "<pre>"; print_r($module_list);
		$modules = $this->Permission->Module->find('all', array('fields' => array('id'), 'conditions' => array('status' => 'A'), 'order' => array('module_name' => 'asc')));
		//echo '<pre>'; print_r($permissions);
		foreach($permissions as $per){
			$format_per[] = $per['Permission']['app_modules_id'];
		}
		
		if($this->params['controller'] != 'home' && $this->params['controller'] != 'finhome' && $this->params['controller'] != 'hrhome'   && $this->params['controller'] != 'tskhome'  && $this->params['controller'] != 'tvlhome' && $this->params['controller'] != 'bdhome' && $this->params['controller'] != 'hrpayslip'){
			// check user has permission to module
			if (!in_array($cur_module, $format_per)) {
				$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Invalid Entry', 'default', array('class' => 'alert alert-error'));	
				$this->redirect('/home/');	
			}
		} 
		
		
		// check the module exists in the list
		foreach($modules as $key => $module){ 
			// check the user module exists in the database module list
			if (in_array($module['Module']['id'], $format_per)) { 	
				switch($module['Module']['id']){
					case 1:					
					$this->set('advance_menu', 1);
					break;					
					case 2:					
					$this->set('approve_advance_menu', 1);
					$this->show_adv_menu_count();
					break;						
					case 3:					
					$this->set('expense_menu', 1);
					$this->show_exp_menu_count();
					break;					
					case 4:					
					$this->set('approve_expense_menu', 1);
					break;
					case 7:					
					$this->set('advance_pay_menu', 1);
					$this->show_adv_pay_count();
					break;	
					case 8:					
					$this->set('advance_report_menu', 1);
					break;
					case 12:					
					$this->set('expense_pay_menu', 1);
					$this->show_exp_pay_count();
					break;	
					case 13:					
					$this->set('discrepancy_menu', 1);
					break;
					case 14:					
					$this->set('expense_report_menu', 1);
					break;
					case 9:					
					$this->set('project_menu', 1);
					break;
					case 10:					
					$this->set('project_contact_menu', 1);
					break;
					case 11:					
					$this->set('customer_menu', 1);
					break;
					case 15:					
					$this->set('company_menu', 1);
					break;
					case 16:					
					$this->set('employee_menu', 1);
					$this->show_photo_verify_count();
					break;
					case 17:					
					$this->set('grade_menu', 1);
					break;
					case 18:					
					$this->set('department_menu', 1);
					break;
					case 19:					
					$this->set('designation_menu', 1);
					break;
					case 5:					
					$this->set('adv_approver_menu', 1);
					break;
					case 20:					
					$this->set('expense_approver_menu', 1);
					break;
					case 21:					
					$this->set('role_menu', 1);
					break;
					case 22:					
					$this->set('expense_limit_menu', 1);
					break;
					case 23:					
					$this->set('expense_category_menu', 1);
					break;
					case 24:					
					$this->set('emp_email_menu', 1);
					break;
					case 25:					
					$this->set('leave_menu', 1);
					break;
					case 26:					
					$this->set('approve_leave_menu', 1);
					$this->show_leave_menu_count();
					break;
					case 27:					
					$this->set('permission_menu', 1);
					break;
					case 28:					
					$this->set('approve_permission_menu', 1);
					$this->show_per_menu_count();
					break;
					case 31:					
					$this->set('leave_approver_menu', 1);
					break;
					case 32:					
					$this->set('hr_role_menu', 1);
					break;
					case 33:					
					$this->set('attendance_menu', 1);
					break;
					case 34:					
					$this->set('form_menu', 1);
					break;
					case 35:					
					$this->set('latest_menu', 1);
					break;
					case 36:					
					$this->set('org_menu', 1);
					break;
					case 37:					
					$this->set('holiday_menu', 1);
					break;						
					case 38:					
					$this->set('payslip_menu', 1);
					break;
					case 39:					
					$this->set('upload_pay_menu', 1);
					break;	
					case 40:					
					$this->set('bank_act_menu', 1);
					break;
					case 42:					
					$this->set('bank_menu', 1);
					break;	
					case 43:					
					$this->set('gallery_menu', 1);					
					break;	
					case 44:					
					$this->set('gallery_aprv_menu', 1);				
					$this->show_gal_menu_count();
					break;
					case 45:					
					$this->set('att_change_menu', 1);					
					$this->update_att_change(Configure::read('ATT_START'));	
					break;
					case 47:					
					$this->set('apr_att_change_menu', 1);	
					$this->show_appr_att_menu_count();					
					break;
					case 46:					
					$this->set('profile_change_menu', 1);
					$this->show_prof_change_menu_count();					
					break;
					case 48:					
					$this->set('poll_menu', 1);								
					break;
					case 49:					
					$this->set('branch_menu', 1);								
					break;
					case 50:					
					$this->set('file_menu', 1);								
					break;
					case 51:					
					$this->set('business_unit_menu', 1);								
					break;
					case 52:					
					$this->set('office_timing_menu', 1);								
					break;
					case 53:					
					$this->set('leave_details_menu', 1);								
					break;
					case 54:					
					$this->set('tskrole_menu', 1);								
					break;
					case 55:					
					$this->set('tskapprover_menu', 1);								
					break;
					case 56:					
					$this->set('tsk_types_menu', 1);								
					break;
					case 57:					
					$this->set('tsk_plan_menu', 1);	
					$this->show_mytask_menu_count();								
					break;
					case 58:					
					$this->set('tsk_teamplan_menu', 1);
					$this->show_teamtask_menu_count();
					break;
					case 59:					
					$this->set('tsk_event_menu', 1);								
					break;
					case 60:					
					$this->set('tsk_file_menu', 1);	
					$this->show_tsk_file_count();
					break;
					case 61:					
					$this->set('tsk_assign_menu', 1);
					$this->show_assigned_menu_count();					
					break;
					case 62:					
					$this->set('tsk_team_assign_menu', 1);	
					$this->show_assigned_by_count();	
					break;
					case 63:					
					$this->set('event_type_menu', 1);								
					break;
					case 64:					
					$this->set('hr_tm_report_menu', 1);								
					break;
					case 66:					
					$this->set('hr_comp_report_menu', 1);								
					break;
					case 65:					
					$this->set('fin_tm_report_menu', 1);								
					break;
					case 67:					
					$this->set('fin_comp_report_menu', 1);								
					break;
					case 67:					
					$this->set('fin_comp_report_menu', 1);								
					break;
					case 69:					
					$this->set('tvl_req_menu', 1);								
					break;
					case 71:					
					$this->set('tvl_apr_req_menu', 1);
					$this->show_appr_travel_menu_count();		
					break;
					case 73:					
					$this->set('tvl_ticket_menu', 1);	
					$this->show_book_ticket_menu();
					$this->show_cancel_ticket_menu();						
					break;
					case 74:					
					$this->set('tvl_roles_menu', 1);								
					break;
					case 75:					
					$this->set('tvl_mode_menu', 1);								
					break;
					case 76:					
					$this->set('tvl_class_menu', 1);								
					break;	
					case 77:					
					$this->set('tvl_idtype_menu', 1);								
					break;
					case 78:					
					$this->set('tvl_place_menu', 1);								
					break;
					case 82:					
					$this->set('tsk_project_req_menu', 1);	
					$this->show_appr_proj_req_count();							
					break;
					case 83:					
					$this->set('tvl_can_apr_menu', 1);	
					$this->show_tvl_apr_cancel_count();									
					break;
					case 84:					
					$this->set('hr_cancel_leave_menu', 1);								
					break;
					case 85:					
					$this->set('hr_apr_cancel_leave_menu', 1);
					$this->show_cancel_leave_menu_count();					
					break;
					case 86:					
					$this->set('hr_pl_request_menu', 1);
					$this->show_pl_req_count();					
					break;
					case 87:					
					$this->set('tsk_report_indiv', 1);								
					break;
					case 88:					
					$this->set('hr_report_company', 1);								
					break;
					case 89:					
					$this->set('tsk_roa', 1);								
					break;
					case 91:					
					$this->set('tsk_roa_approve', 1);
					$this->show_roa_apr_menu_count();
					break;
					case 92:					
					$this->set('tsk_roa_committe', 1);
					break;
					case 93:					
					$this->set('tsk_roa_rewards', 1);
					break;
					case 94:					
					$this->set('tsk_roa_history', 1);
					break;
					case 95:					
					$this->set('team_attendance', 1);
					break;
					case 96:					
					$this->set('survey_menu', 1);
					break;
					case 97:					
					$this->set('hr_message_menu', 1);
					break;
					case 98:					
					$this->set('hr_voice_menu', 1);
					break;
					case 99:					
					$this->set('bd_business_menu', 1);					
					break;
					case 100:					
					$this->set('bd_spoc_menu', 1);
					break;
					case 101:					
					$this->set('bd_roles_menu', 1);
					break;
					case 102:					
					$this->set('bd_admin_menu', 1);
					break;
				}				
			}
		}
		
		
	}
	
	/* function to check the user is spoc */
	public function check_spoc_user(){ 
		$this->loadModel('BdSpoc');
		$this->BdSpoc->unBindModel(array('belongsTo' => array('HrEmployee')));
		$count = $this->BdSpoc->find('count', array('conditions' => array('BdSpoc.status' => 1, 'BdSpoc.is_deleted' => 'N', 'BdSpoc.app_users_id' => $this->Session->read('USER.Login.id'))));
		$this->set('is_spoc', $count);		
		if($count){
			$this->get_biz_menu_count();
			$this->get_biz_apr_menu_count();
			$this->set('bd_business_menu', 1);
		}else{
			$this->set('bd_business_menu', 0);
		}
		return $count;		
	}
	
	/* function to check the user is bd admin */
	public function check_bd_admin(){
		$this->loadModel('BdAdmin');
		$this->BdAdmin->unBindModel(array('belongsTo' => array('HrEmployee')));
		$count = $this->BdAdmin->find('count', array('conditions' => array('BdAdmin.status' => 1, 'BdAdmin.is_deleted' => 'N', 'BdAdmin.app_users_id' => $this->Session->read('USER.Login.id'))));
		$this->set('is_bd_admin', $count);
		return $count;
	}
	
	
	/* function to show the leave. menu alert */
	public function show_leave_menu_count(){ 
		// check finance modules
		if($this->check_hr_module()){
			// fetch the recent users approval req.	
			$this->loadModel('HrLeaveApprove');
			$this->HrLeaveApprove->unBindModel(array('hasOne' => array('HrLeaveUser'), 'belongsTo' => array('Home','HrLeaveType')));	
			$lv_count = $this->HrLeaveApprove->find('count', array('conditions' => array('HrLeaveStatus.app_users_id' => 
			$this->Session->read('USER.Login.id'),'HrLeaveApprove.is_deleted' => 'N', 'HrLeaveStatus.status' => 'W'), 
			'group' => array('HrLeaveApprove.id')));	
			$this->leave_count += $lv_count;
			$this->hr_count += $lv_count;
			$this->set('LV_APPR_COUNT', $lv_count);
		}
		
	}
	
	/* function to show the cancel leave. menu alert */
	public function show_cancel_leave_menu_count(){
		// check finance modules
		if($this->check_hr_module()){
			// fetch the recent users approval req.	
			$this->loadModel('HrAprCancelLeave');
			$this->HrAprCancelLeave->unBindModel(array('hasOne' => array('HrCancelLeaveUser'), 'belongsTo' => array('HrEmployee','HrLeaveType')));
			$can_count = $this->HrAprCancelLeave->find('count', array('conditions' => array('HrCancelLeaveStatus.app_users_id' => $this->Session->read('USER.Login.id'),'HrAprCancelLeave.is_deleted' => 'N', 'HrCancelLeaveStatus.status' => 'W'), 'group' => array('HrAprCancelLeave.id')));	
			$this->leave_count += $can_count;
			$this->hr_count += $can_count;
			$this->set('LV_CAN_APPR_COUNT', $can_count);
		}
		
	}
	
	
	
	
	/* function to show the per. menu alert */
	public function show_per_menu_count(){
		// check finance modules
		if($this->check_hr_module()){
			// fetch the recent users approval req.	
			$this->loadModel('HrPerApprove');
			$this->HrPerApprove->unBindModel(array('hasOne' => array('HrPerUser'), 'belongsTo' => array('Home')));			
			$per_count = $this->HrPerApprove->find('count', array('conditions' => array('HrPerStatus.app_users_id' =>$this->Session->read('USER.Login.id'),'HrPerApprove.is_deleted' => 'N', 'HrPerStatus.status' => 'W'), 'group' => array('HrPerApprove.id')));	
			$this->per_count += $per_count;
			$this->hr_count += $per_count;
			$this->set('PER_APPR_COUNT', $per_count);
		}
		
	}
	
	
	/* function to show the adv. menu alert */
	public function show_adv_menu_count(){
		// check finance modules
		if($this->check_fin_module()){
			// fetch the recent users approval req.	
			$this->loadModel('FinAdvApprove');
			$this->FinAdvApprove->unBindModel(array('hasOne' => array('FinAdvUser'), 'belongsTo' => array('TskCustomer','Home')));
			$this->FinAdvApprove->bindModel(array('hasOne' => array('FinAdvStatus')));		
			$adv_count = $this->FinAdvApprove->find('count', array('conditions' => array('FinAdvStatus.app_users_id' => $this->Session->read('USER.Login.id'),
			'FinAdvApprove.is_deleted' => 'N', 'FinAdvStatus.status' => 'W'), 'group' => array('FinAdvApprove.id')));	
			$this->fin_count += $adv_count;
			$this->adv_count += $adv_count;
			$this->set('ADV_APPR_COUNT', $adv_count);
		}
		
	}
	
	/* function to show pay count */
	public function show_adv_pay_count(){
		// check finance modules
		if($this->check_fin_module()){
			//  get pay count
			$this->loadModel('FinAdvApprove');
			$this->FinAdvApprove->unBindModel(array('belongsTo' => array('TskCustomer','Home'),'hasOne' => array('FinAdvUser','FinAdvStatus')));			
			$this->FinAdvApprove->BindModel(array('hasOne' => array('FinAdvPay')));
			if($this->Session->read('USER.Login.hr_department_id') == '4'){
				$pay_count = $this->FinAdvApprove->find('count', array('conditions' => array('FinAdvApprove.is_deleted' => 'N', 'FinAdvApprove.is_approve' => 'Y', 'FinAdvPay.amount' => NULL), 'group' => array('FinAdvApprove.id')));	
				$this->fin_count += $pay_count;
				$this->adv_count += $pay_count;
				$this->set('ADV_PAY_COUNT', $pay_count);
			}	
		}
		
	}
	
		/* function to show the adv. menu alert */
	public function show_exp_menu_count(){
		// check finance modules
		if($this->check_fin_module()){
			$this->loadModel('FinExpense');
			$this->FinExpense->unBindModel(array('hasOne' => array('FinExpUser','FinExpList'), 'belongsTo' => array('FinAdvance','TskCustomer','TskProject','Home')));
			// fetch the recent users approval req.
			if($this->Session->read('USER.Login.hr_department_id') == '4'){
				$exp_count = $this->FinExpense->find('count', array('conditions' => array('FinExpense.is_deleted' => 'N', 'FinExpense.approve_status' => 'W', 'is_draft' => 'N'), 'group' => array('FinExpense.id')));	
			}else{			
				$exp_count = $this->FinExpense->find('count', array('conditions' => array('FinExpense.is_deleted' => 'N','FinExpStatus.status' => 'W', 'is_draft' => 'N', 'FinExpStatus.app_users_id' => $this->Session->read('USER.Login.id')), 'group' => array('FinExpense.id')));	
			}
			$this->exp_count += $exp_count;
			$this->fin_count += $exp_count;
			$this->set('EXP_APPR_COUNT', $exp_count);
				
		}
	}
	
	/* function to get exp. pay count */
	public function show_exp_pay_count(){
	// check finance modules
		if($this->check_fin_module()){
		// get pay count
			$this->loadModel('FinExpense');	
			$this->FinExpense->bindModel(
			array('hasOne' => array(
					'FinExpPay' => array(
						'className' => 'FinExpPay',
						'foreignKey' => 'fin_expenses_id'
						)
					)
				)
			);
			
			if($this->Session->read('USER.Login.hr_department_id') == '4'){
				$this->FinExpense->unBindModel(array('hasOne' => array('FinExpList','FinExpStatus'), 'belongsTo' => array('Home','TskProject','FinAdvance','TskCustomer')));
				$pay_count = $this->FinExpense->find('count', array('conditions' => array('FinExpense.is_deleted' => 'N', 'FinExpense.is_approve' => 'Y', 'FinExpPay.amount' => NULL), 'group' => array('FinExpense.id')));	
				$this->exp_count += $pay_count;
				$this->fin_count += $pay_count;
				$this->set('EXP_PAY_COUNT', $pay_count);
			}
		}
			
	}
	
	
	
	/* function to show the appr. att. change count */
	public function show_appr_att_menu_count(){
		// check finance modules
		if($this->check_hr_module()){
			// fetch the recent users approval req.	
			$this->loadModel('HrAttChangeApprove');	
			$this->HrAttChangeApprove->unBindModel(array('hasOne' => array('HrAttUser'), 'belongsTo' => array('Home')));
			$apr_att_count = $this->HrAttChangeApprove->find('count', array('conditions' => array('HrAttStatus.app_users_id' =>$this->Session->read('USER.Login.id'), 'HrAttStatus.status' => 'W'), 'group' => array('HrAttChangeApprove.id')));	
			$this->emp_count += $apr_att_count;
			 $this->hr_count += $apr_att_count;
			$this->set('ATT_APRV_COUNT', $apr_att_count);
		}
		
	}
	
	
	
	/* function to show the per. menu alert */
	public function show_photo_verify_count(){
		// check finance modules
		if($this->check_hr_module()){
			// fetch the recent users approval req.	
			$this->loadModel('Home');
			$this->Home->unBindModel(array('hasOne' => array('Todo'), 'belongsTo' => array('HrDesignation','HrCompany','HrBusinessUnit','HrBloodGroup','HrBranch','HrDepartment')));			
			$photo_count = $this->Home->find('count', array('conditions' => array('Home.photo_status' => 'W'), 'group' => array('Home.id')));	
			$this->emp_count += $photo_count;
			$this->hr_count += $photo_count;
			$this->set('EMP_PHOTO_COUNT', $photo_count);
		}
		
	}
	
	/* function to show the per. menu alert */
	public function show_prof_change_menu_count(){
		// check finance modules
		if($this->check_hr_module()){
			// fetch the recent users approval req.	
			$this->loadModel('HrProfileChange');	
			$this->HrProfileChange->unBindModel(array('belongsTo' => array('User')));
			$prof_chg_count = $this->HrProfileChange->find('count', array('conditions' => array('HrProfileChange.status' => 'W'), 'group' => array('HrProfileChange.id')));	
			$this->emp_count += $prof_chg_count;
			$this->hr_count += $prof_chg_count;
			$this->set('EMP_PROF_CHG_COUNT', $prof_chg_count);
		}
		
	}
	
	/* function to show the per. menu alert */
	public function show_gal_menu_count(){ 
		// check finance modules
		if($this->check_hr_module()){
			if($this->Session->read('USER.Login.hr_department_id') == '14'){
				// fetch the recent users approval req.	
				$this->loadModel('HrGalApprove');	
				$this->HrGalApprove->unBindModel(array('hasOne' => array('HrGalleryItem','HrGalUser'), 'belongsTo' => array('Home')));
				$gal_count = $this->HrGalApprove->find('count', array('conditions' => array('HrGalStatus.app_users_id' =>$this->Session->read('USER.Login.id'), 'HrGalStatus.status' => 'W'), 'group' => array('HrGalApprove.id')));		
				$this->gal_count += $gal_count;
				$this->hr_count += $gal_count;
				$this->set('GAL_APPR_COUNT', $gal_count);
			}
		}
		
	}
	
	/* function to show the per. menu alert */
	public function show_mytask_menu_count(){ 
		// check finance modules
		if($this->check_tsk_module() && $this->request->params['controller'] != 'home'){			
			$this->loadModel('TskPlan');
			$this->TskPlan->unBindModel(array('belongsTo' => array('TskCustomer','TskProject','TskPlanType')));	
			$my_plan_count = $this->TskPlan->find('count', array('conditions' => array('TskPlan.app_users_id' =>$this->Session->read('USER.Login.id'), 
			'TskPlan.read_status' => 'U','TskPlan.is_deleted' => 'N',$this->get_plan_condition()), 'group' => array('TskPlan.id')));		
			$this->tsk_plan_count = $my_plan_count;
			$this->tsk_count += $my_plan_count;
			$this->set('MY_PLAN_COUNT', $my_plan_count);			
		}
		
	}
	
	/* function to return date condition */
	public function get_plan_condition(){
		$today = date('Y-m-d'); 
		$start = date('Y-m-01', strtotime($today. '-1 months'));
		$end = date('Y-m-31', strtotime( $today. '+1 months'));
		$end = date('Y-m-d', strtotime($end. '+1 days'));
		return $dateCond = array('or' => array('start between ? and ?' => array($start, $end),'end between ? and ?' => array($start, $end)));
	}
	
	
	/* function to show the per. menu alert */
	public function show_teamtask_menu_count(){ 
		// check finance modules
		if($this->check_tsk_module() && $this->request->params['controller'] != 'home'){			
			$this->loadModel('TskTeamPlan');	
			$this->TskTeamPlan->unBindModel(array('belongsTo' => array('TskCustomer','TskProject','TskPlanType','HrEmployee')));
			$tm_plan_count = $this->TskTeamPlan->find('count', array('conditions' => array('TskPlanRead.app_users_id' => $this->Session->read('USER.Login.id'), 
			'TskPlanRead.status' => 'U', 'TskTeamPlan.is_deleted' => 'N', $this->get_plan_condition()), 'group' => array('TskPlanRead.tsk_plan_id')));					
			$this->tsk_plan_count += $tm_plan_count;
			$this->tsk_count += $tm_plan_count;
			$this->set('TEAM_PLAN_COUNT', $tm_plan_count);
			
		}
		
	}
	
	
	/* function to show the per. menu alert */
	public function show_assigned_menu_count(){ 
		// check finance modules
		$this->loadModel('TskAssign');
		if($this->check_tsk_module() && $this->request->params['controller'] != 'home'){	
			$this->TskAssign->unBindModel(array('hasOne' => array('TskAssignStatus','TskAssignUser'), 'belongsTo' => array('TskProject','TskPlanType','TskCustomer','HrEmployee')));
			$my_tsk_count = $this->TskAssign->find('count', array('conditions' => array('TskAssign.is_deleted' => 'N', 'TskAssignRead.app_users_id' => $this->Session->read('USER.Login.id'), 'TskAssignRead.status' => 'U'), 'group' => array('TskAssign.id')));		
			$this->tsk_assign_count += $my_tsk_count;
			$this->tsk_count += $my_tsk_count;
			$this->set('MY_TSK_COUNT', $my_tsk_count);			
		}		
	}
	
	
	/* function to show the team assigned alert */
	public function show_assigned_by_count(){ 
		// check finance modules
		if($this->check_tsk_module()  && $this->request->params['controller'] != 'home'){			
			$this->loadModel('TskTeamAssign');	
			$this->TskTeamAssign->unBindModel(array('hasOne' => array('TskAssignStatus','TskAssignUser'), 'belongsTo' => array('TskProject','TskPlanType','TskCustomer','HrEmployee')));
			$tm_tsk_count = $this->TskTeamAssign->find('count', array('conditions' => array('TskTeamAssign.app_users_id' =>$this->Session->read('USER.Login.id'), 'TskTeamAssign.read_status' => 'U','TskTeamAssign.is_deleted' => 'N'), 'group' => array('TskTeamAssign.id')));		
			$this->tsk_assign_count += $tm_tsk_count;
			$this->tsk_count += $tm_tsk_count;
			$this->set('TM_TSK_COUNT', $tm_tsk_count);		
					
		}		
	}
	
	/* function to show the team assigned alert */
	public function show_tsk_file_count(){ 
		// check finance modules
		if($this->check_tsk_module()  && $this->request->params['controller'] != 'home'){			
			$this->loadModel('TskFile');
			$this->TskFile->bindModel(
			array('hasOne' => array(
					'TskFileRead' => array(
						'className' => 'TskFileRead',
						'foreignKey' => 'tsk_files_id'
						)
					)
				)
			);
			$file_count = $this->TskFile->find('count', array('conditions' => array('TskFileRead.app_users_id' => $this->Session->read('USER.Login.id'), 'TskFileRead.status' => 'U','TskFile.is_deleted' => 'N'), 'group' => array('TskFile.id')));		
			$this->tsk_file_count += $file_count;
			$this->tsk_count += $file_count;
			$this->set('TSK_FILE_COUNT', $file_count);		
					
		}		
	}
	
	
	
	/* function to show the biz menu count */
	public function get_biz_menu_count(){
		$this->loadModel('BdBusiness');	
		$this->BdBusiness->unBindModel(array('belongsTo' => array('BdSpoc','BdProposalVer','HrBusinessUnit','Creator','BdOpportunity','BdPriority','State','District','BdBizSource')));
		$this->BdBusiness->bindModel(array('hasOne' => array('BdRead')));
		$biz_count = $this->BdBusiness->find('count', array('conditions' => array('BdRead.app_users_id' =>$this->Session->read('USER.Login.id'),
		'BdBusiness.is_deleted' => 'N', 'BdRead.status' => 'U'), 'group' => array('BdBusiness.id')));	
		$this->biz_count = $biz_count;
		$this->set('NEW_BIZ_COUNT', $biz_count);	
				
	}
	
	/* function to show the biz menu count */
	public function get_biz_apr_menu_count(){
		// check finance modules
		if($this->check_biz_module() && $this->check_bd_admin()){
			// fetch the recent users approval req.	
			$this->loadModel('BdBusiness');	
			$this->BdBusiness->unBindModel(array('belongsTo' => array('BdSpoc','BdProposalVer','HrBusinessUnit','Creator','BdOpportunity','BdPriority','State','District','BdBizSource')));
			$biz_aproval_count = $this->BdBusiness->find('count', array('conditions' => array('BdBusiness.is_approve !=' => 'R','BdBusiness.is_deleted' => 'N', 'BdBusiness.status' => '0'), 'group' => array('BdBusiness.id')));	
			$this->biz_apr_count = $biz_aproval_count; 
			$this->set('NEW_BIZ_APR_COUNT', $biz_aproval_count);	
		}
		
	}
	
	
	
	/* function to show the roa approve menu alert */
	public function show_roa_apr_menu_count(){
		// check finance modules
		if($this->check_tsk_module()){
			// fetch the recent users approval req.	
			$this->loadModel('TskRoaApprove');	
			$this->TskRoaApprove->unBindModel(array('hasOne' => array('TskApplauseUser'), 'belongsTo' => array('HrEmployee')));	
			$roa_count = $this->TskRoaApprove->find('count', array('conditions' => array('TskApplauseStatus.app_users_id' =>$this->Session->read('USER.Login.id'),'TskRoaApprove.is_deleted' => 'N', 'TskApplauseStatus.status' => 'W'), 'group' => array('TskRoaApprove.id')));	
			$this->tsk_count += $roa_count;
			$this->set('TSK_ROA_COUNT', $roa_count);	
		}
		
	}
	
	
	/* function to show approve proj. req. count */
	public function show_appr_proj_req_count(){
		// check finance modules
		if($this->check_tsk_module()){	
			$this->loadModel('TskProjectRequest');
			$this->TskProjectRequest->unBindModel(array('belongsTo' => array('TskCustomer','HrEmployee')));
			$req_count = $this->TskProjectRequest->find('count', array('conditions' => array('TskProjectRequest.status' => 'W','TskProjectRequest.is_deleted' => 'N'), 'group' => array('TskProjectRequest.id')));		
			$this->tsk_count += $req_count;
			$this->set('TSK_PROJ_REQ_COUNT', $req_count);	
		}
	}
	
	
	/* function to show pl req. count */
	public function show_pl_req_count(){
		// check finance modules
		if($this->check_hr_module()){	
			$this->loadModel('HrPlReq');
			$this->HrPlReq->unBindModel(array('belongsTo' => array('HrEmployee')));
			$req_count = $this->HrPlReq->find('count', array('conditions' => array('HrPlReq.status' => 'W','HrPlReq.is_deleted' => 'N'), 'group' => array('HrPlReq.id')));		
			$this->hr_count += $req_count;
			$this->set('PL_REQ_COUNT', $req_count);	
		}
	}
	
	
	/* function to show approve travel count */
	public function show_appr_travel_menu_count(){
		// check tour modules
		if($this->check_tour_module()){
			// fetch the recent users approval req.	
			$this->loadModel('TvlReqApr');	
			$this->TvlReqApr->unBindModel(array('hasOne' => array('TvlReqUser','TvlTicketStatus'), 'belongsTo' => array('HrEmployee','TskCustomer','TvlMode','TvlPlace')));
			$tvl_count = $this->TvlReqApr->find('count', array('conditions' => array('TvlReqStatus.type' => 'N', 'TvlReqApr.status' => 'A', 'TvlReqStatus.app_users_id' =>$this->Session->read('USER.Login.id'),'TvlReqApr.is_deleted' => 'N', 'TvlReqStatus.status' => 'W'), 'group' => array('TvlReqApr.id')));	
			$this->tvl_apr_count += $tvl_count;
			$this->tour_count += $tvl_count;
			$this->set('APR_TVL_COUNT', $tvl_count);
		}
	}
	
	/* function to show count of ticket booking */
	public function show_book_ticket_menu(){
		// check tour modules
		if($this->check_tour_module()){ 
			$this->loadModel('TvlBookTkt');
			$this->TvlBookTkt->unBindModel(array('hasOne' => array('TvlTicket','TvlTicketStatus'), 'belongsTo' => array('HrEmployee','TskCustomer','TvlMode','TvlPlace')));
			$tkt_count = $this->TvlBookTkt->find('count', array('conditions' => array('TvlBookTkt.status' => 'A', 'is_approve' => 'Y', 'tkt_status' => '', 'TvlBookTkt.is_deleted' => 'N'), 'group' => array('TvlBookTkt.id')));	
			$this->tvl_tkt_count += $tkt_count;
			$this->tour_count += $tkt_count;
			$this->set('BOOK_TKT_COUNT', $tkt_count);
		}
	}
	
	/* function to show count of cancel ticket booking */
	public function show_cancel_ticket_menu(){
		// check tour modules
		if($this->check_tour_module()){ 
			$this->loadModel('TvlCanTkt');
			$this->TvlCanTkt->unBindModel(array('hasOne' => array('TvlTicketStatus','TvlCancel'), 'belongsTo' => array('HrEmployee','TskCustomer','TvlMode','TvlPlace')));
			$can_tkt_count = $this->TvlCanTkt->find('all', array('fields' => array('DISTINCT count(DISTINCT TvlCanTkt.id) as count'), 'conditions' => array('TvlTicket.tkt !=' => '', 'tkt_cancel_status' => '',  'TvlCanTkt.status' => 'C', 'TvlCanTkt.is_deleted' => 'N'), 'group' => array('TvlCanTkt.id')));	
			$this->tvl_tkt_count += $can_tkt_count[0][0]['count'];
			$this->tour_count += $can_tkt_count[0][0]['count'];
			$this->set('CANCEL_TKT_COUNT', $can_tkt_count[0][0]['count']);
		}
	}
	
	/* function to show the cancel travel approval count */
	public function show_tvl_apr_cancel_count(){
		// check finance modules
		if($this->check_tour_module()){
			$this->loadModel('TvlCanApr');	
			$this->TvlCanApr->unBindModel(array('hasOne' => array('TvlReqUser','TvlCancel'), 'belongsTo' => array('HrEmployee','TskCustomer','TvlPlace','TvlMode')));	
			$tvl_can_count = $this->TvlCanApr->find('count', array('conditions' => array('TvlReqStatus.type' => 'C', 'TvlReqStatus.app_users_id' =>$this->Session->read('USER.Login.id'),'TvlCanApr.is_deleted' => 'N', 'TvlReqStatus.status' => 'W'), 'group' => array('TvlCanApr.id')));	
			$this->tvl_apr_count += $tvl_can_count;
			$this->tour_count += $tvl_can_count;
			$this->set('APR_TVL_CAN_COUNT', $tvl_can_count);
		}
	}
	
	/* function to check finance modules are accessing */
	public function check_fin_module(){ 
		$controller =  $this->params['controller'];
		$modules = array('home', 'finhome', 'finadvance', 'finexpense', 'finadvapprove','finadvpay', 'finexpapprove', 'finexppay', 'tskcustomers', 'tskprojects', 'tskprojectcontacts', 'roles', 'finexpcat', 'approve', 'finemailsend','finreport');
		if(in_array($controller, $modules)){
			return true;
		}else{	
			return false;
		}
	}
	
	/* function to check finance modules are accessing */
	public function check_hr_module(){
		$controller =  $this->params['controller'];
		$modules = array('home', 'hrhome', 'hrleave', 'hrpermission', 'hrcancelleave', 'hraprcancelleave','hrleaveapprove','hrperapprove', 'roles', 'hremployee', 'approve', 'hrcompany','hrdepartment','hrdesignation','hrattendance','hrform','hrlatest', 'bank','hrorg','hrbank','hrbankacc','hruploadpay','hrmypayslip','hrholiday','hrgallery','hrgalapprove','hrattchange','hraprattchange','hrprofilechange','hrpoll','hrattchangeapprove','hrbranch','hrbusinessunit','hrofficetiming','hrleavedetails','hrreport','hrplreq','hrmessage','hrsurvey','hrvoice');
		if(in_array($controller, $modules)){ 
			return true;
		}else{	
			return false;
		}
	}
	
	/* function to check finance modules are accessing */
	public function check_tsk_module(){ 
		$controller =  $this->params['controller'];
		$modules = array('home', 'tskhome','roles','approve','tskplan','tskplantype','tskteamplan','tskassign', 'tskteamassign', 'tskevent','tskeventtype','tskfile','tskprojectrequest','tskroa','tskroaapprove','tskroareward','tskroacommittee','tskroareward','tskroahistory');
		if(in_array($controller, $modules)){
			return true;
		}else{	
			return false;
		}
	}
	
	/* function to check biz tour modules are accessing */
	public function check_tour_module(){
		$controller =  $this->params['controller'];
		$modules = array('home', 'tvlhome','roles','approve','tvlreq','tvlreqapr','tvlbooktkt','tvlcanreq','tvltktdownload','tvlcanapr','tvlcantkt');
		if(in_array($controller, $modules)){
			return true;
		}else{	
			return false;
		}
	}
	
	/* function to check biz modules are accessing */
	public function check_biz_module(){
		$controller =  $this->params['controller'];
		$modules = array('home','bdhome','roles','bdspoc','bdadmin','bdbusiness');
		if(in_array($controller, $modules)){
			return true;
		}else{	
			return false;
		}
	}

	
	
	
	/* function to update the forgot attendance */
	public function update_att_change($from){
		
		if($this->check_hr_module()){
			$this->loadModel('HrAttendance');		
			$to = date('Y-m-d');
			
			$doj = $this->Session->read('USER.Login.doj');
			// for new comer
			if(strtotime($doj) == strtotime($to)){ // new comer
				$from = $doj;
				$diff = -1;
			}else{  // joined after may 1st.			
				$from = date('Y-m-d',strtotime("-3 days"));
				$diff = $this->HrAttendance->diff_date($doj, $to);				
				if($diff <= 3 && $diff > 0){
					$from = $doj;
					//$diff = 3; // if doj not entered	
				}else{
					$diff = 3;
				}
			}	
			
			// match for already created change req.
			$req = $this->get_att_change_request($from, $to, $this->Session->read('USER.Login.id'));
			

			// get emp. holidays
			$holidays = $this->get_user_holidays($this->Session->read('USER.Login.hr_branch_id'));
			
			// get approved leaves
			$this->loadModel('HrLeave');
			$dateCond = array('or' => array('leave_from between ? and ?' => array($from, $to),
			'leave_to between ? and ?' => array($from, $to))); 
			$this->HrLeave->unBindModel(array('hasOne' => array('HrLeaveStatus'), 'belongsTo' => array('Home','HrLeaveType')));
			$leave_list = $this->HrLeave->find('all', array('fields' => array('leave_from','leave_to'),
			'conditions' => array('HrLeave.app_users_id' => $this->Session->read('USER.Login.id'),
			'HrLeave.is_approve' => 'Y', $dateCond), 'order' => array('leave_from' => 'asc'), 'group' => array('HrLeave.id')));
						
			$leaves = array();			
			// iterate the leaves
			foreach($leave_list as $leave){	
				
				$days_diff = $this->HrAttendance->diff_date($leave['HrLeave']['leave_from'], 
				$leave['HrLeave']['leave_to']);		
				if($days_diff > 0){
					$leaves[] = $leave['HrLeave']['leave_from'];
					// if diff. is there, get all dates					
					while($leave['HrLeave']['leave_from'] != $leave['HrLeave']['leave_to']){
						$next_date = date('Y-m-d', strtotime($leave['HrLeave']['leave_from'] . ' + 1 day'));
						$leaves[] = $next_date;
						$leave['HrLeave']['leave_from'] = $next_date;
					}
				}else{
					$leaves[] = $leave['HrLeave']['leave_from'];
				}
				
			}
			
			// get the last days attendance
			$data = $this->HrAttendance->find('all', array('fields' => array('in_time', 'out_time'), 'conditions' => array('app_users_id' => $this->Session->read('USER.Login.id'),
			'in_time between ? and ?' => array($from, $to)), 'group' => array('HrAttendance.id')));
			foreach($data as $value){
				// check for not empty
				if(!empty($value['HrAttendance']['in_time'])){
					$in_date = date('Y-m-d', strtotime($value['HrAttendance']['in_time']));
				}else{
					$in_date = '';
				}
				if(!empty($value['HrAttendance']['out_time'])){
					$out_date = date('Y-m-d', strtotime($value['HrAttendance']['out_time']));
				}else{
					$out_date = '';
				}
				$att_in_data[] = $in_date;
				$att_out_data[] = $out_date;
			}
				
			$happy = $this->get_happy_leave($this->Session->read('USER.Login.id'));
			$exp_happy_dob = explode('-', $happy[0]);
			$exp_happy_wedding = explode('-', $happy[1]);
				
			
			while($diff >= 0){
				$from_split = explode('-', $from);
				$sat = date('N', strtotime($from));
				if($sat == '6'){
					$no_days = date('t', strtotime($from));
					$first_day = date('N', strtotime($from_split[0].'-'.$from_split[1].'-'.'01'));
						// get first saturday
						$first_sat = $this->get_first_sat($first_day );
						//$first_sat; 
						$second_sat = $first_sat + 7;  
						$third_sat = $second_sat + 7; 
						$forth_sat = $third_sat + 7;	 			
				}
		
				
				$day = date('N', strtotime($from));
				
				// skip sunday, happy leaves
				if($day != '7' && in_array($from, $holidays) === FALSE && in_array($from, $req) === FALSE &&  $from_split[2] != $second_sat && $from_split[2] != $forth_sat
					&& in_array($from, $leaves) === FALSE && $from != date('Y-m-d') && $from_split[1].$from_split[2] != $exp_happy_dob[1].$exp_happy_dob[2]
					&& $from_split[1].$from_split[2] != $exp_happy_wedding[1].$exp_happy_wedding[2]){
				
					// match att. marked or not					
					$in_key = array_search($from, $att_in_data);
					$out_key = array_search($from, $att_out_data);
				
					if($in_key === FALSE || empty($att_in_data)){
						$att_status['both'][] = $from;
					}else if($out_key === FALSE){
						$att_status['out'][] = $from;
					}
				}	
				$from =  date('Y-m-d', strtotime($from ." +1 days"));	
				
				$diff--;
				
				
			}
			
			//print_r($att_status);die;
			$att_count = count($att_status['in']) + count($att_status['out']) + count($att_status['both']);
			
			$this->hr_count += $att_count;
			$this->emp_count += $att_count;
			$this->set('ATT_CHG_COUNT', $att_count);
			
			// set the variables
			$this->set('intime_miss', $att_status['in']);
			$this->set('outtime_miss', $att_status['out']);
			$this->set('bothtime_miss', $att_status['both']);
		}
		
	}
	
	/* function to get employee holidays */
	public function get_user_holidays($branch){
			// fetch holidays to skip 
			$this->loadModel('HrHoliday');
			$holiday_list = $this->HrHoliday->find('all', array('fields' => array('event_date'), 
			'conditions' => array('hr_branch_id' => $branch, 
			'HrHoliday.status' => '1', 'HrHoliday.is_deleted' => 'N', 'event_date like' => date('Y').'%',),
			'order' => array('event_date' => 'asc'),'group' => array('HrHoliday.id')));
			$holidays = array();	
			foreach($holiday_list as $event){
				$holidays[] = $event['HrHoliday']['event_date'];
			}
			return $holidays;
	}
	
	/* function to get employee holidays */
	public function get_user_holidays_previous($branch){
			// fetch holidays to skip 
			$this->loadModel('HrHoliday');
			$holiday_list = $this->HrHoliday->find('all', array('fields' => array('event_date'), 
			'conditions' => array('hr_branch_id' => $branch, 
			'HrHoliday.status' => '1', 'HrHoliday.is_deleted' => 'N', 'event_date like' => (date('Y') - 1).'%',),
			'order' => array('event_date' => 'asc'),'group' => array('HrHoliday.id')));
			$holidays = array();	
			foreach($holiday_list as $event){
				$holidays[] = $event['HrHoliday']['event_date'];
			}
			return $holidays;
	}
	
	
	/* function to get first sat */
	public function get_first_sat($first_day){
		switch($first_day){	
							case '1':
							$first_sat = 6; 
							break;
							case '2':
							$first_sat = 5; 
							break;
							case '3':
							$first_sat = 4; 
							break;
							case '4':
							$first_sat = 3; 
							break;
							case '5':
							$first_sat = 2; 
							break;
							case '6':
							$first_sat = 1; 
							break;
							case '7':
							$first_sat = 7; 
							break;					
							
				}
			
			return $first_sat;
		}
	
	
	
		
	
	/* function to send email */
	function send_email($subject,$template,$from,$to,$vars,$src){
		App::uses('CakeEmail', 'Network/Email');
		$Email = new CakeEmail();
		$Email->viewVars($vars);		
		$Email->template($template, 'default');
		$Email->emailFormat('html');
		$Email->subject($subject);
		$Email->to($to);
		$Email->from($from);
		$Email->config('gmail');
		$Email->delivery = 'smtp';
		if(!empty($src)){
			$Email->attachments($src);
		}
		/*
		if($smtp != ''){
			$Email->config($smtp);
			$Email->delivery = 'smtp';
		}else{
			$Email->config('ses');
			$Email->delivery = 'smtp';
			//$Email->config('default');
		}
		*/
		
		
		try {
			$Email->send();
			return true;
		} catch (Exception $e) {
			$this->write_log($e->getMessage().$this->Functions->get_current_date());			
			return false;
		} 
				
	}
	
	/* function to write log file */
	public function write_log($content){
		$fp = fopen(WWW_ROOT.'/uploads/logs/error.log', 'a+');
		fwrite($fp, $content."\r\n");
		fclose();
	}
	
	/* function used to upload the image */
	function  upload_file($src, $dest){	
		if(!empty($src)){			
			// copy the file to the image path			
			if(!copy($src, $dest)){
				echo 'failed to copy the file';
			}else{				
				return 1;
			}
		}
	}
	
	
	
	/* function to download the file */
	public function download_file($path){	
		// Must be fresh start
		if( headers_sent() )
		die('Headers Sent');
		// Required for some browsers
		if(ini_get('zlib.output_compression'))
		ini_set('zlib.output_compression', 'Off');
		// File Exists?
		if(file_exists($path)){
			// Parse Info / Get Extension
			$fsize = filesize($path);
			$path_parts = pathinfo($path);
			$ext = strtolower($path_parts["extension"]);
			// Determine Content Type
			switch($ext){			 
			  case "zip": $ctype="application/zip"; break;
			  case "doc": $ctype="application/msword"; break;
			  case "xls": $ctype="application/vnd.ms-excel"; break;		 
			  case "gif": $ctype="image/gif"; break;
			  case "png": $ctype="image/png"; break;
			  case "jpeg":
			  case "jpg": $ctype="image/jpg"; break;
			  default: $ctype="application/force-download";
			}
			header("Pragma: public"); // required
			header("Expires: 0");
			header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
			header("Cache-Control: private",false); // required for certain browsers
			header("Content-Type: $ctype");
			$file_name =  basename($path);
			header("Content-Disposition: attachment; filename=\"".$file_name."\";" );
			header("Content-Transfer-Encoding: binary");
			header("Content-Length: ".$fsize);
			ob_clean();
			flush();
			readfile( $path );
		}else{
			die('File Not Found');
		}
	} 
	
	
	
	/* function to extract the zip */
	public function extract_zip($zip_files){		
		if(extension_loaded('zip'))	{ 
			$zip_path = 'uploads/download/';
			// Checking files are selected
			$zip = new ZipArchive(); // Load zip library 
			$zip_name = time().'.zip'; // Zip name
			if($zip->open($zip_path.$zip_name, ZIPARCHIVE::CREATE) !== TRUE){ 
			 // Opening zip file to load files
				$error .= '* Sorry ZIP creation failed at this time';
			}
			foreach($zip_files as $file){ 
				$zip->addFile($file,basename($file)); // Adding files into zip
			}
			$zip->close();
			if(file_exists($zip_path.$zip_name)){
				// push to download the zip
				header('Content-type: application/zip');
				header('Content-Disposition: attachment; filename="'.$zip_name.'"');
				readfile($zip_path.$zip_name);
				// remove zip file is exists in temp path
				unlink($zip_path.$zip_name);
			}else{
				$error .= 'File not exists';
			}

		}		
		else{
			$error .= '* You dont have ZIP extension';
		}
		
		echo $error;
		
	}
	
	/* function to check the permissions */
	public function check_permission(){
		$user_type = $this->Session->read('EMPLOYER.CompanyUser.is_admin');
		if($user_type == 1){
			$this->post_job_permission = true;
			$this->down_res_permission = true;
			$this->save_res_permission = true;
			$this->email_res_permission = true;
			return true;
		}
		$user_id = $this->Session->read('EMPLOYER.CompanyUser.id');
		
		// get user permissions
		$this->loadModel('EmpPermission');
		$permission_list = $this->EmpPermission->find('list', array('fields' => array('emp_modules_id'), 'conditions' => array('company_users_id' => $user_id)));
		
		foreach($permission_list as $list){
			switch($list){
				case 1:
				$this->set('PER_ADD_JOB', true);
				$this->post_job_permission = true;
				break;
				case 2:
				$this->set('PER_VIEW_JOB', true);
				break;
				case 3:
				$this->set('PER_EDIT_JOB', true);
				break;
				case 4:
				$this->set('PER_DEL_JOB', true);
				break;
				case 5:
				$this->set('PER_DOW_RES', true);
				$this->down_res_permission = true;
				break;
				case 6:
				$this->set('PER_SAVE_RES', true);
				$this->save_res_permission = true;
				break;
				case 7:
				$this->set('PER_EMAIL_RES', true);
				$this->email_res_permission = true;
				break;
				case 8:
				$this->set('PER_VIEW_PRO', true);
				break;
				case 9:
				$this->set('PER_EDIT_PRO', true);
				break;
				case 10:
				$this->set('PER_ADD_FDR', true);
				break;
				case 11:
				$this->set('PER_VIEW_FDR', true);
				break;
				case 12:
				$this->set('PER_FDR_SAVE_PRO', true);
				break;
				case 13:
				$this->set('PER_SHR_FDR', true);
				break;
				case 14:
				$this->set('PER_ADD_TMP', true);
				break;
				case 15:
				$this->set('PER_VIEW_TMP', true);
				break;
				case 16:
				$this->set('PER_EMAIL_TMP', true);
				break;
				case 17:
				$this->set('PER_REP_DB', true);
				break;
				case 18:
				$this->set('PER_REP_LOGIN', true);
				break;
				case 19:
				$this->set('PER_REP_RES', true);
				break;
				
			}		
			  			 
		   
		}		
	}
	
	
	public function invalid_attempt() {
		$this->Session->destroy();
		$this->disable_cache();
		$this->delete_cookie('PDCAUSER');	
		$this->Session->setFlash('<button type="button" class="close" data-dismiss="alert-error">&times;</button>Oops! Something went wrong!', 'default', array('class' => 'alert alert-error'));
		$this->redirect('/');

	}
	
	public function invalid_access() {
		$this->Session->destroy();
		$this->disable_cache();
		$this->delete_cookie('PDCAUSER');	
		$this->redirect('/');
	}
	
	/* function to get leaves remaining */
	public function get_used_leaves($id, $doj,$emp_type,$doc){ 
		$id = $this->get_user_id($id);
		$this->get_used_lve($id,$emp_type);
		//if(date('Y') == '2014'){
			$this->get_bal_nbl($id, $doj,$doc);	
		//}		
		$this->get_bal_pl($id);
		
		
	}
	
	public function get_user_id($id){
		if($this->request->params['controller'] == 'hrattendance'){
			$id = $id;
		}else{
			$id = $this->Session->read('USER.Login.id');
		}		
		return $id;
	}
	
	/* function to load leave types */
	public function load_leave_types($gender, $id, $doj,$emp_type){
		// load for table values
		if($gender == 'M'){
			$cond = array('HrLeaveType.id !=' => '4');
		}else{
			$cond = array('HrLeaveType.id !=' => '5');
		}		
		// for probation remove pl
		$id = $this->get_user_id($id);
		$probation = $this->set_user_probation($id);
		$this->probation = $probation;
		if($probation == 'Y'){
			$prob_cond = array('HrLeaveType.id !=' => '2');
		}
		// check for associates
		$leave_cond = $this->check_associate($id, $doj,$emp_type);
		$leave_detail = $this->HrLeave->HrLeaveType->find('all', array('fields' => array('desc','no_days','type', 'id'), 'order' => array('priority ASC'),'conditions' => array('status' => 1, 'max_limit' => '1', 'is_deleted' => 'N', $cond,$leave_cond)));
		$this->set('leaveDetail', $leave_detail);
		
		// for drop down
		$leave_list = $this->HrLeave->HrLeaveType->find('list', array('fields' => array('id','leave_type'), 'order' => array('priority ASC'),'conditions' => array('status' => 1, 'is_deleted' => 'N', $cond, $prob_cond,$leave_cond)));
		$this->set('leaveType', $leave_list);
	}
	
	/* function to check for associates */
	public function check_associate($id, $doj,$emp_type){
		// check for regular or associates
		if($emp_type == 'A'){
			$leave_cond = array('or' => array(array('HrLeaveType.id' => '1'), array('HrLeaveType.id' => '6'), array('HrLeaveType.id' => '3'), array('HrLeaveType.id' => '7'), array('HrLeaveType.id' => '8')));
			// get special leave
			$this->get_special_leave($id, $doj);
			$this->set('associateUSER', 1);
		}else if($emp_type == 'A2'){
			$leave_cond = array('or' => array(array('HrLeaveType.id' => '1'), array('HrLeaveType.id' => '6'), array('HrLeaveType.id' => '3'), array('HrLeaveType.id' => '7')));
			$this->set('associateUSER2', 1);
		}else{
			$leave_cond = array('HrLeaveType.id !=' => '8');
		}
		return $leave_cond;
	}
	
	/* function to get the special leaves for associates */
	public function get_special_leave($id, $doj){
		$this->loadModel('HrSplLeave');
		$cur_date = date('Y-m-d');
		//$cur_date = '2015-10-06';		
		$data = $this->HrSplLeave->find('all', array('conditions' => array('app_users_id' => $id, "date_format(created_date, '%Y-') like" => date('Y-').'%'), 'fields' => array("date_format(created_date, '%Y-%m-%d') as created"),  'limit' => '1', 'order' => array('created_date' => 'desc')));
		
		// for the first time
		if(empty($data[0][0]['created'])){
			// insert into spl leave table
			$data2 = $this->HrSplLeave->find('all', array('conditions' => array('app_users_id' => $id), 'fields' => array("date_format(created_date, '%Y-%m-%d') as created"),  'limit' => '1', 'order' => array('created_date' => 'desc')));
			$save_date = empty($data2) ?  $doj : $cur_date;
			$record = array('app_users_id' => $id, 'created_date' => $save_date, 'no_days' => '3');
			$this->HrSplLeave->save($record);	
		}
		// check for old dates
		if(!empty($data[0][0]['created'])){
			 $next_quarter =  date('Y-m-d', strtotime($data[0][0]['created']. '+3 months'));
			// iterate until it comes to current date
			while(strtotime($cur_date) >= strtotime($next_quarter)){
				// for the next time
				$this->HrSplLeave->id = '';
				$record = array('app_users_id' => $id, 'created_date' => $next_quarter, 'no_days' => '3');
				$this->HrSplLeave->save($record);
				// fetch the last inserted date
				$data = $this->HrSplLeave->find('all', array('conditions' => array('app_users_id' => $id), 'fields' => array("date_format(created_date, '%Y-%m-%d') as created"),  'limit' => '1', 'order' => array('created_date' => 'desc')));
				//print_r($data);
				$next_quarter =  date('Y-m-d', strtotime($data[0][0]['created']. '+3 months'));
			}
		}
		
		$this->get_spl_avail($id);
		
	}
	
	/* function to get the spl. leave availability */
	public function get_spl_avail($id){ 
		// get total special leaves
		$data = $this->HrSplLeave->find('all', array('conditions' => array('app_users_id' => $id, 'created_date like' => date('Y').'%'), 'fields' => array('sum(no_days) as no_days','sum(no_used) as no_used'), 'order' => array('created_date' => 'desc')));
		$no_spl_leaves = $data[0][0]['no_days'] > 10 ? 10 : $data[0][0]['no_days'];
		$no_spl_used = $data[0][0]['no_used'];		
		// get applied spl. leaves
		$this->HrLeave->unBindModel(array('hasOne' => array('HrLeaveStatus')));
		$data = $this->HrLeave->find('all', array('fields' => array('sum(HrLeave.no_days) as count'),'conditions' => array('HrLeave.app_users_id' => $id, 'is_approve !=' =>  'R', 'HrLeave.is_deleted'=> 'N', 'leave_from like' => date('Y').'%', 'HrLeave.hr_leave_type_id' => '8')));
		$applied = $data[0][0]['count'];
		$remain_spl = $no_spl_leaves - ($no_spl_used + $applied);		
		$this->set('no_spl_avail', $remain_spl);
		return $remain_spl;
	}
		
	
	/* function to get nbl */
	public function get_used_lve($id, $emp_type){
		$this->HrLeave->unBindModel(array('hasOne' => array('HrLeaveStatus')));
		// for associate conditions
		if($emp_type == 'A' || $emp_type == 'A2'){
			$date_cond = date('Y-m');
		}else{
			$date_cond = date('Y');
		}
		
		
		$data = $this->HrLeave->find('all', array('fields' => array('HrLeaveType.id', 'sum(HrLeave.no_days) as count'), 
		'conditions' => array('HrLeave.app_users_id' => $id, 'leave_from like' => $date_cond.'%',  
		'HrLeaveType.max_limit' => '1', 'is_approve !=' => 'R','HrLeave.hr_leave_type_id' => '1', 'HrLeave.is_deleted' => 'N', 'HrLeave.is_cancel' => 'N'),'group' => array('HrLeave.hr_leave_type_id'), 'order' => array('priority ASC')));	
		$this->set('applied_nbl', $data[0][0]['count']);
		
		
		$this->HrLeave->unBindModel(array('hasOne' => array('HrLeaveStatus')));
		// for nbl exclude year
		$data2 = $this->HrLeave->find('all', array('fields' => array('HrLeave.id', 'sum(HrLeave.no_days) as count'), 
		'conditions' => array('HrLeave.app_users_id' => $id,'HrLeave.hr_leave_type_id' => '2', 
		'HrLeaveType.max_limit' => '1', 'is_approve !=' => 'R', 'HrLeave.is_deleted' => 'N'), 'order' => array('priority ASC')));
		$this->set('applied_pl', $data2[0][0]['count']);
		
		if($this->Session->read('USER.Login.gender') == 'F'){
			$data = $this->HrLeave->find('all', array('fields' => array('HrLeaveType.id', 'sum(HrLeave.no_days) as count'), 
			'conditions' => array('HrLeave.app_users_id' => $id, 'leave_from like' => $date_cond.'%',  
			'HrLeaveType.max_limit' => '1', 'is_approve !=' => 'R','HrLeave.hr_leave_type_id' => '4', 'HrLeave.is_deleted' => 'N', 'HrLeave.is_cancel' => 'N'),'group' => array('HrLeave.hr_leave_type_id'), 'order' => array('priority ASC')));	
			$this->set('applied_matl', $data[0][0]['count']);
		}else{
			$data = $this->HrLeave->find('all', array('fields' => array('HrLeaveType.id', 'sum(HrLeave.no_days) as count'), 
			'conditions' => array('HrLeave.app_users_id' => $id, 'leave_from like' => $date_cond.'%',  
			'HrLeaveType.max_limit' => '1', 'is_approve !=' => 'R','HrLeave.hr_leave_type_id' => '5', 'HrLeave.is_deleted' => 'N', 'HrLeave.is_cancel' => 'N'),'group' => array('HrLeave.hr_leave_type_id'), 'order' => array('priority ASC')));	
			$this->set('applied_patl', $data[0][0]['count']);
		}
		
		//print_r($data2);
		
		/*foreach($data as $key => $leaves){
			switch($leaves['HrLeaveType']['id']){
				case '1': 
				break;
				case '2':	
				print_r($data2);
				$this->set('applied_pl', $data2[0][0]['count']);
				break;
			}
		}*/
		$this->set('used_data', $data);
	
	}
	
	/* function to get the balance ñbl*/
	public function get_bal_nbl($id, $doj,$doc){ 
		$doj = $doj == '' ? $this->Session->read('USER.Login.doj') : $doj;
		$doc = $doc == '' ? $this->Session->read('USER.Login.doc') : $doc;
		$exp_doc = explode('-', $doc);
		$exp_doj = explode('-', $doj);
		if($this->probation == 'Y'){
			$nbl_count = ($exp_doj[2] <= 15) ? 1 : 0;
			// get the diff. of months in current year
			$nbl_count += 12 - $exp_doj[1];
			$nbl_count = ($nbl_count > 6) ? 6 : $nbl_count;
			$this->set('balance_nbl', $nbl_count);
			if($exp_doj[0] != date('Y')){ 			
				// for next year of probation confirmation
				$nbl_count = 6 - $nbl_count;
				$this->set('balance_nbl', $nbl_count);
			}
		}else if($this->probation == 'C' && $exp_doc[0] == date('Y')){
			// check for confirmed before 15th
			$nbl_count = ($exp_doc[2] <= 15) ? 1 : 0;
			// get the diff. of months in current year
			$nbl_count += 12 - $exp_doc[1];
			$this->set('balance_nbl', $nbl_count);
			$this->set('confirm_pro_rata', '1');			
		}else{ 	
			$leave_detail = $this->HrLeave->HrLeaveType->find('first', array('fields' => array('no_days'), 'conditions' => array('status' => 1, 'max_limit' => '1', 'is_deleted' => 'N', 'id' => 1)));
			if($exp_doc[0] == date('Y')){
				$nbl_count = ($exp_doc[2] <= 15) ? 1 : 0;
				$nbl_count += 12 - $exp_doc[1];
				$this->set('balance_nbl', $nbl_count);
			}else{
				$this->set('balance_nbl', $leave_detail['HrLeaveType']['no_days']);
			}
		}
		
	}
	
	
	/* function to get the balance pl*/
	public function get_bal_pl($id){
		$this->loadModel('HrLeaveDetail');
		// get used pl static table		
		$data = $this->HrLeaveDetail->find('all', array('fields' => array('sum(pl_bal) as count'), 'conditions' => array('app_users_id' => $id)));
		// deduct the encashed PL
		$this->loadModel('HrLeaveEncash');
		$lv_encash = $this->HrLeaveEncash->find('all', array('fields' => array('sum(encashable) tot_encash', 'sum(encashed) tot_nocash'), 'conditions' => array('app_users_id' => $id)));
		$balance_pl = $data[0][0]['count'] - $lv_encash[0][0]['tot_encash'];
					
		// get used pl of the user
		$this->HrLeave->unBindModel(array('hasOne' => array('HrLeaveStatus')));
		$data2 = $this->HrLeave->find('all', array('fields' => array('HrLeaveType.id', 'sum(HrLeave.no_days) as count'), 
		'conditions' => array('HrLeave.app_users_id' => $id,'HrLeave.hr_leave_type_id' => '2',   'HrLeaveType.max_limit' => '1', 'is_approve !=' => 'R', 'HrLeave.is_deleted' => 'N'), 'order' => array('priority ASC')));
		
		$balance_pl = $balance_pl -  $data2[0][0]['count'];
		// save in pl encash if more than 30 days
		if($balance_pl > 30){			
			$encash = $balance_pl - 30; 
			// check already saved for the year
			if(!$this->check_leave_encash($id)){
				// save in pl encash table				
				$encash_data = array('year' => date('Y'), 'encashable' => $encash, 'created_date' => $this->Functions->get_current_date(), 'app_users_id' => $id);
				$this->HrLeaveEncash->save($encash_data, true, $fieldList = array('encashable', 'year','created_date','app_users_id'));			
			}
		}
		
		// get updated encash details
		$lv_latest_encash = $this->HrLeaveEncash->find('all', array('fields' => array('sum(encashable) tot_encash', 'sum(encashed) tot_nocash'), 'conditions' => array('app_users_id' => $id)));
		
		$balance_pl = $data[0][0]['count'] - ($lv_encash[0][0]['tot_encash'] + $encash);
		$this->set('balance_pl', $balance_pl);
		// get encashable pl leaves
		$this->set('pl_encashable', ($lv_latest_encash[0][0]['tot_encash'] - $lv_latest_encash[0][0]['tot_nocash']));
		
		// get used PL's in previous years
		$this->HrLeave->unBindModel(array('hasOne' => array('HrLeaveStatus')));
		$prev_pl_data = $this->HrLeave->find('all', array('fields' => array("DATE_FORMAT(HrLeave.leave_from, '%Y') year", 'sum(HrLeave.no_days) as count'), 
		'conditions' => array('HrLeave.hr_leave_type_id' => '2', 'HrLeave.app_users_id' => $id, 'HrLeaveType.max_limit' => '1', 'is_approve !=' => 'R', 'HrLeave.is_deleted' => 'N'),
		'group' => array("DATE_FORMAT(HrLeave.leave_from, '%Y')")));
		foreach($prev_pl_data as $prev_lv){ 
			$old_pl[$prev_lv[0]['count']] = $prev_lv[0]['year'];
			// for getting array value
			$prev_pl_year[$prev_lv[0]['year']] = $prev_lv[0]['count'];
		}
		
		// for list details
		$pl_history = $this->HrLeaveDetail->find('all', array('fields' => array('pl_bal', 'year'), 
		'conditions' => array('app_users_id' => $id, 'pl_bal >' => '0'), 'order' => array('year' => 'desc')));		
		$hist = "<table style='margin-top:5px;width:130px' id='bal_leaves' class='table-condensed table table-nomargin'><tr><th>Year</th><th>Balance</th></tr>";		
		foreach($pl_history as $leaves){
			$hist .= '<tr><td>'; 
			// deduct used pl req.
			if($key = array_search($leaves['HrLeaveDetail']['year'], $old_pl) !== false){ 
				$pl_bal = $leaves['HrLeaveDetail']['pl_bal'] - $prev_pl_year[$leaves['HrLeaveDetail']['year']];
			}else{
				$pl_bal = $leaves['HrLeaveDetail']['pl_bal'];
			}
			$hist .= $leaves['HrLeaveDetail']['year'];
			$hist .=  '</td><td>'; 
			$hist .= $pl_bal;
			$hist .=  '</td></tr>';
			
		}
		
		$hist .= '</table>';
		
		$this->set('pl_history', $hist);
		
		
	}
	
	/* function check leave already encashed */
	public function check_leave_encash($id){
		$count = $this->HrLeaveEncash->find('count', array('conditions' => array('app_users_id' => $id, 'year' => date('Y'))));
		if($count > 0){
			return true;
		}else{
			return false;
		}
		
	}
	
	/* function to set user's probation */
	public function set_user_probation($id){		
		$this->loadModel('HrLeave');
		$prob = $this->HrLeave->Home->findById($id, array('fields' => 'Home.probation'));
		$this->set('probation_review', $prob['Home']['probation']);
		return $prob['Home']['probation'];
		
	}
	
	/* function to get permissions remaining */
	public function get_used_perms($month, $id){ 
		$id = $this->get_user_id($id);
		$this->loadModel('HrPermission');
		$this->HrPermission->unBindModel(array('hasOne' => array('HrPerStatus', 'HrPerUser'), 'belongsTo' => array('Home')));
		$data = $this->HrPermission->find('all', array('fields' => array("TIME_FORMAT(SEC_TO_TIME( SUM( TIME_TO_SEC(no_hrs))), '%k:%i') 
		as count"), 'conditions' => array('HrPermission.app_users_id' => $id, 'HrPermission.is_deleted' => 'N', 'per_date like' => $month.'-%', 'is_approve !=' => 'R')));	
		//echo $data[0][0]['count'];
	    // subtract the time		
		$rem_time = $this->HrPermission->sub_time('02:00', $data[0][0]['count']);
		if(empty($rem_time)){
			$rem_time = '2';
		}
		$this->set('remain_data', $rem_time);		
	}
	
	/* function to get applied leaves */
	public function get_applied_leaves($month, $id, $lve_cond){
		$data = $this->HrLeave->get_user_leave_details($month, $id, $lve_cond);
		$this->set('leave_data_user', $data);
		return $data;
	}
	
	/* function to get att. change req. of user */
	public function get_att_change_request($from, $to, $id){
		$this->loadModel('HrAttChange');
		$this->HrAttChange->unBindModel(array('hasOne' => array('Todo','HrAttStatus'), 'belongsTo' => array('Home','HrAttendance')));		
		$change_req = $this->HrAttChange->find('all', array('fields'=> array('att_date'), 'conditions' => array('att_date between ? and ?' => array($from, $to),
		'HrAttChange.app_users_id' => $id, 'is_approve' => 'N')));
		$req = array();
			
		foreach($change_req as $req_data){
			$req[] = $req_data['HrAttChange']['att_date'];
		}
		return $req;
	}

	/* function to get comp. off details */
	public function get_compoff_details($id,$emp_type,$work){
		// get the business unit
		$user_bus = $this->HrLeave->Home->findById($id, array('fields'=> 'hr_business_unit_id','hr_branch_id'));
		/*if($user_bus['Home']['hr_business_unit_id'] == 1){
			$no_days = 30;
		}else{
			$no_days = 15;
		}*/
		$no_days = 30;
		// generate comp off dates
		$last_days = $this->Functions->generate_comp_days($no_days);
		// check same month or diff month
		$first_date = explode('-', $last_days[0]);
		$last_date = explode('-', $last_days[$no_days-1]);
		$first_day = date('N', strtotime($first_date[0].'-'.$first_date[1].'-'.'01'));
		$first_day2 = date('N', strtotime($last_date[0].'-'.$last_date[1].'-'.'01'));
		$comp_days1 = $this->get_comp_days($last_days,$first_day,$first_date,$id,$emp_type,$work,$user_bus['Home']['hr_branch_id']);
		//$day = date('N', strtotime($from));
		$comp_days2 = array();
		if(($first_date[1] != $last_date[1]) && !empty($last_date[1])){		
			$comp_days2 = $this->get_comp_days($last_days,$first_day2,$last_date,$id,$emp_type,$work,$user_bus['Home']['hr_branch_id']);
		}
		$comp_days = array_merge($comp_days1, $comp_days2);
		
		
		
		// generate in conditions
		$comma = ',';
		$total = count($comp_days);
		foreach($comp_days as $key => $comp){ 
			if($key == ($total-1)){ $comma = '';}
			$in_cond .= '"'.$comp.'"'.$comma;
		}		
		
		// get data from attendance		
		$working = $this->HrLeave->get_comp_dates($id, $in_cond);
		
		$working_days = array();
		
		foreach($working as $workDay){ 
			$working_days[] = $workDay[0]['work_days'];
		}
		
		// get days not present
		foreach($comp_days as $key => $c_date ){ 
			if(!in_array($c_date, $working_days)){
				$no_attend[] = $comp_days[$key];
			}
		}
		
		// generate in conditions
		$comma = ',';
		$total = count($no_attend);
		foreach($no_attend as $key => $comp){
			if($key == ($total-1)){ $comma = '';}
			$in_cond2 .= '"'.$comp.'"'.$comma;
		}
		
		
		// get od leaves available	
		$total_working = array();
		
		
		
		$od_leaves = $this->HrLeave->get_od_leaves($id, $in_cond2);
		
		
		$total_working = array_unique(array_merge($od_leaves, $working_days));		
		
		
		// make sure the comp off not created
		if(!empty($in_cond2)){
			$in_cond = $in_cond.','.$in_cond2;
		}
				
		$comp_req = $this->HrLeave->get_comp_req($id, $in_cond);
		// match already created with working days
		foreach($total_working as $work){
			if(!in_array($work, $comp_req)){ 
				$comp_final[] = $work;
				// for create leave drop down
				$comp_list[$work] = $this->Functions->format_date($work);
			}
		}
		
		
		$this->set('no_compoff', count($comp_final));
		$this->set('lastDays', $comp_list);
		// sort in ascending
		asort($comp_final);
		// generate details table for comp. off
		$compoff = "<table style='margin-top:5px;width:180px;z-index:9999999' id='bal_leaves' class='table-condensed table table-nomargin'><tr><th>S.No.</th><th>Date</th></tr>";			
		$i = 1;
		foreach($comp_final as $comp){
			$compoff .= '<tr><td>'; 
			// deduct used pl req.			
			$compoff .= $i;
			$compoff .=  '</td><td>'; 
			$compoff .= $this->Functions->format_date($comp).' ('.$this->Functions->get_day($comp, 'short').')';
			$compoff .=  '</td></tr>';
			$i++;
		}
		
		$compoff .= '</table>';
		$this->set('comp_details', $compoff);
		
	}
	
	/* function to get comp off days */
	public function get_comp_days($last_days, $first_day,$first_date,$id,$emp_type,$work,$branch){ 
		// find the sat, sun and holidays
		$first_sat = $this->get_first_sat($first_day);
		$second = $first_sat + 7;
		$second_sat = date('Y-m-d', strtotime($first_date[0].'-'.$first_date[1].'-'.$second)); 			
		$third_sat = $second + 7; 			
		$forth_sat = $first_date[0].'-'.$first_date[1].'-'.($third_sat + 7); 
		
		// find happy leaves
		$happy = $this->get_happy_leave($id);
		$exp_happy_dob = explode('-', $happy[0]);
		$exp_happy_wedding = explode('-', $happy[1]);
				
		// iterate to find the comp off eligible days
		foreach($last_days as $comp_date){
			$exp_comp = explode('-', $comp_date);

			// find second and forth sat.
			if(($comp_date == $second_sat || $comp_date == $forth_sat)){ 
				$comp_days[] = $comp_date;
				//print_r($comp_days);
			}	
			
			// find sunday
			$day = date('N', strtotime($comp_date));
			if($day == '7'){
				$comp_days[] = $comp_date;
			}
			$holidays = $this->get_user_holidays($branch);
			// find holidays
			if(in_array($comp_date, $holidays)){
				$comp_days[] = $comp_date;
				$leave_days[] = $comp_date;
			}
			// find holidays in previous year (only for january)
			if($exp_comp[1] == '12'){
				if(in_array($comp_date, $this->get_user_holidays_previous($branch))){
					$comp_days[] = $comp_date;
				}
			}
			
			if($exp_happy_dob[1].$exp_happy_dob[2] == $exp_comp[1].$exp_comp[2]){
				$comp_days[] = $comp_date;
			}
			if($exp_happy_wedding[1].$exp_happy_wedding[2] == $exp_comp[1].$exp_comp[2]){
				$comp_days[] = $comp_date;
			}
			
			// get onduty on holidays and week ends
			
			foreach($leave_days as $leave){
				$holiday_cond[] = array('leave_from like' => $leave);
			}
			$leave_cond = array('or' => array( array('leave_from like' => $second_sat), array('leave_from like' => $forth_sat), $holiday_cond));
			$this->HrLeave->unBindModel(array('hasOne' => array('HrLeaveStatus')));
			$od_data = $this->HrLeave->find('all', array('fields' => array('leave_from', 'leave_to'), 'conditions'  =>  array($leave_cond, 'HrLeave.hr_leave_type_id' => '6', 'is_approve' => 'Y', 'HrLeave.is_deleted' => 'N', 'HrLeave.app_users_id' => $id)));
			foreach($od_data as $data){
				if($comp_date == $data['HrLeave']['leave_from']){
					$comp_days[] = $comp_date;
				}
			}
			
		}
		
		return $comp_days;
	}
	
	/* function to get holidays of the month */
	public function get_holidays_month($month,$branch){
		$holiday_data = $this->HrHoliday->find('all', array('fields' => array('event_date', 'event'), 'conditions' => array('event_date like' => $month.'%', 'HrHoliday.is_deleted' => 'N', 'HrHoliday.status' => '1',
		'hr_branch_id' => $branch)));
		foreach($holiday_data as $holiday){
			$holidayList[$holiday['HrHoliday']['event']] = $holiday['HrHoliday']['event_date']; 
		}
		$this->set('holidayList', $holidayList);
		return $holidayList;
	}
	
	/* function to get holidays of the month */
	public function get_holidays($month,$branch){ 
		$holiday_count = $this->HrHoliday->find('count', array('conditions' => array('event_date like' => $month.'%', 'HrHoliday.is_deleted' => 'N', 'HrHoliday.status' => '1',
		'hr_branch_id' => $branch, 'event_date <=' => date('Y-m-d'))));		
		return $holiday_count;
	}
	
	/* function to get lop leaves and od leaves */
	public function get_lop_leaves($month,$id){
		$data = $this->HrLeave->get_lop_leaves($month,$id);
		return $data;
	}
	
	
	/* function to get birthday and wedding day */
	public function get_happy_leave($id){
		$this->loadModel('HrEmployee');
		$this->HrEmployee->unBindModel(array('hasOne' => array('HrEducation','HrExperience','HrFamily'), 'belongsTo' => array('HrDepartment',
		'HrCompany','HrBloodGroup','HrBusinessUnit','HrDesignation','HrGrade','HrBranch','Role')));
		$leave_data = $this->HrEmployee->findById($id, array('fields' => 'dob', 'wedding_date'));
		$happyLeave[] = $leave_data['HrEmployee']['dob']; 
		$happyLeave[] = $leave_data['HrEmployee']['wedding_date']; 
		$this->set('happyLeave', $happyLeave);
		return $happyLeave;
	}
	
	/* function to evaluate leave status */
	public function eval_leave_status($id,$branch,$date,$doj){
		if($date == ''){		
			$month_cond = date('Y-m');
			$year_cond = date('Y-');
		}else{
			$month_cond = $date;
			$year_val = explode('-', $date);
			$year_cond = $year_val[0];
		}
		$this->loadModel('HrLeave');
		// get leaves for the month / year
		$lve_cond = " and hr_leave_type_id != '6' and hr_leave_type_id != '3'";
		//$lve_cond = " and  hr_leave_type_id != '3'";
		$year_leave = $this->get_applied_leaves($year_cond,  $id, $lve_cond);
		$this->set('FTY_APPROVED', $year_leave[0][0]['no_days'] ? $year_leave[0][0]['no_days'] : 0);		
		$month_leave = $this->get_applied_leaves($month_cond,  $id, $lve_cond);
		$this->set('FTM_APPROVED', $month_leave[0][0]['no_days'] ? $month_leave[0][0]['no_days'] : 0);
		// get present days for the year / month
		$month_present = $this->get_present($id, $month_cond, 'FTM_PRESENT','FTM_ABSENT');
		$month_present_split = explode('|', $month_present);
		$year_present = $this->get_present($id, $year_cond, 'FTY_PRESENT','FTY_ABSENT');
		$year_present_split = explode('|', $year_present);
		// get declared. off year / month
		$this->loadModel('HrHoliday');
		$month_holiday = $this->get_holidays($month_cond,$branch);
		$this->set('FTM_OFF', $month_holiday);
		$year_holiday = $this->get_holidays($year_cond,$branch);
		$this->set('FTY_OFF', $year_holiday);
		// get weekly off in the month & year
		$month_weekoff = $this->get_week_off('M', $id,$month_cond,$year_cond);
		$this->set('FTM_WEEKOFF', $month_weekoff);
		$year_weekoff = $this->get_week_off('Y', $id,$month_cond,$year_cond,$doj);
		$this->set('FTY_WEEKOFF', $year_weekoff);
		// total days in the month / year
		$this->set('FTM_TOTAL', $month_leave[0][0]['no_days'] + $month_holiday + $month_present_split[0] + $month_present_split[1] + $month_weekoff);
		$this->set('FTY_TOTAL', $year_leave[0][0]['no_days'] + $year_holiday + $year_present_split[0] + $year_present_split[1] + $year_weekoff);
	}
	
	/* function to calculate the weekly off */
	public function get_week_off($type, $id,$month_cond,$year_cond,$doj){
		$weekoff = 0;
		// for monthly week off.
		if($type == 'M'){
			$weekoff = $this->check_monthly_weekoff($type,$month_cond,$id);
		}else{
			$cur_month = $year_cond < date('Y') ? 13 : date('m');
			$prev_month = --$cur_month;
			for($i = 1; $i <= $prev_month; $i++){
				$i = $i < 10 ? '0'.$i : $i;
				if(strtotime($doj) < strtotime($year_cond.'-'.$i.'-01')){
					$weekoff += $this->check_monthly_weekoff($type, $i, $id, $year_cond);
				}
			}
			// check current month
			$weekoff += $this->check_monthly_weekoff('M',$month_cond,$id, $year_cond);
		}
		
		return $weekoff;
	}
	
	function check_monthly_weekoff($type, $month, $id, $year_cond){		
		if($type == 'M'){
			$today = date('d');
		}else{ 
			$today = date('t', strtotime($year_cond.'-'.$month.'-01'));
		}
		$first_day = date('N', strtotime($year_cond.'-'.$month.'-'.'01'));
		// get first saturday
		$first_sat = $this->get_first_sat($first_day );
		// first_sat; 
		$second_sat = $first_sat + 7;  
		$third_sat = $second_sat + 7; 
		$forth_sat = $third_sat + 7;
		for($i = 1; $i < $today; $i++){ 
			$j = $i < 10 ? '0'.$i : $i;
			// check sunday
			$sun = date('N', strtotime($year_cond.'-'.$month.'-'.$i));
			if($sun == 7){
				$week_off_date[]= $year_cond.'-'.$month.'-'.$j;
				$weekoff++;
			}
			// for second and forth sat.
			if($i == $second_sat || $i == $forth_sat){
				$week_off_date[] = $year_cond.'-'.$month.'-'.$j;
				$weekoff++;
			}
		}
		$week_off_str = substr($sun_date.$sun_date, 0, strlen($sun_date.$sun_date) - 2);
		
		// get leaves on the week off.
		//$working_week = $this->HrAttendance->find('count', array('conditions' => array("date_format(HrAttendance.in_time, '%Y-%m-%d')" => $week_off_date, 'HrAttendance.status' => 'A', 'app_users_id' => $id)));
		$this->loadModel('HrLeaveComp');
		$working_week = $this->HrLeaveComp->find('count', array('conditions' => array('comp_off' => $week_off_date, 'HrLeaveComp.is_approve' => 'Y', 'HrLeaveComp.app_users_id' => $id)));

		return $weekoff - $working_week;
	}
	
	/* functions to check present and absent */
	public function get_present($id,$date_cond,$prsent_str,$absent_str){
		$this->loadModel('HrAttendance');
		$att_year = $this->HrAttendance->find('all', array('fields' => array('HrAttendance.status', 'count(*) as count'), 'conditions' => array('app_users_id' => $id, 'HrAttendance.in_time like' => $date_cond.'%'), 'group' => array('HrAttendance.status'))); 
		foreach($att_year as $att){
			switch($att['HrAttendance']['status']){
				case 'A':
				$present = $att[0]['count'];
				break;
				case 'W':
				$waiting = $att[0]['count'];
				break;
				case 'R':
				$reject = $att[0]['count'];
				break;
			}
		}
		// get LOP Leaves and onduty Leaves
		if($prsent_str == 'FTM_PRESENT'){
			$month_lop_od_leave = $this->get_lop_leaves($date_cond, $id);
			$month_lop_od = $this->parse_lop_leave($month_lop_od_leave);
			$lop_od_split = explode('|', $month_lop_od);			
		}else{
			$year_lop_od_leave = $this->get_lop_leaves($date_cond, $id);
			$year_lop_od = $this->parse_lop_leave($year_lop_od_leave);
			$lop_od_split = explode('|', $year_lop_od);
		}
		
		$present += $lop_od_split[1];
		$reject += $lop_od_split[0];
		
		$this->set($prsent_str, $present);
		$this->set($absent_str, $reject);
		return $present.'|'.$reject;
	}
	
	/* parse od and lop leaves */
	public function parse_lop_leave($data){
		foreach($data as $result){
			switch($result['l']['hr_leave_type_id']){
				case '3':
				$lop = $result[0]['no_days'];
				break;
				case '6':
				$od = $result[0]['no_days'];
				break;				
			}
		}
		return $lop.'|'.$od;
	}
	
	/* function to generate the fin. report */
	public function eval_fin_status($id){
		// get advance amount received details
		$this->loadModel('FinAdvance');
		$options = array(			
			array('table' => 'fin_adv_pay',
					'alias' => 'FinAdvPay',					
					'type' => 'INNER',
					'conditions' => array('`FinAdvPay`.`fin_advance_id` = `FinAdvance`.`id`')
			)
		);
		$data = $this->FinAdvance->find('all', array('fields' => array('sum(FinAdvPay.amount) as total1'), 'conditions' => array('FinAdvance.app_users_id' => $id, 'FinAdvance.is_deleted' => 'N'), 'joins' => $options));
		$this->set('advance_received', $data[0][0]['total1']); 
		// get total expense submission
		$this->loadModel('FinExpense');
		$data2 = $this->FinExpense->find('all', array('fields' => array('sum(FinExpense.amount) as total2'), 'conditions' => array('FinExpense.app_users_id' => $id, 'FinExpense.is_deleted' => 'N', 'FinExpense.is_approve' => 'Y')));
		$this->set('expense_submitted', $data2[0][0]['total2']); 
		// get  expense submission pending 
		$pending = $data[0][0]['total1'] - $data2[0][0]['total2'];
		$this->set('expense_pending', $pending > 0 ? $pending : '-'); 
		// get payable to employee and total adv. balance in hand
		$this->loadModel('FinExpPay');
		$data = $this->FinExpPay->find('all', array('fields' => array('FinExpPay.balance_hand','FinExpPay.paid_date'), 'conditions' => array('FinExpenses.app_users_id' => $id), 'order' => array('FinExpPay.id' => 'desc')));
		$this->set('expense_pay', $data[0]['FinExpPay']);
	}
	
	/* function to calculate late deduction */
	public function calculate_late_deduct($id){
		$this->loadModel('HrLateHr');
		$late_data = $this->HrLateHr->find('all', array('fields' => array("TIME_FORMAT(SEC_TO_TIME( SUM( TIME_TO_SEC(tot_hr))), '%k:%i') 
		as count"), 'conditions' => array('app_users_id' => $id, 'late_type' => 'S', 'HrLateHr.created_date like' => date('Y-').'%')));
		$split_deduct = explode(':', $late_data[0][0]['count']); 
		$late_deduct = (60 * $split_deduct[0]) + $split_deduct[1];
		$this->set('late_hr_deduct', $late_deduct);
		return $late_deduct;
	}
	
	/* function to calculate late addition */
	public function calculate_late_addition($id){
		$this->loadModel('HrLateHr');
		$late_data = $this->HrLateHr->find('all', array('fields' => array("TIME_FORMAT(SEC_TO_TIME( SUM( TIME_TO_SEC(tot_hr))), '%k:%i') 
		as count"), 'conditions' => array('app_users_id' => $id, 'late_type' => 'A', 'HrLateHr.created_date like' => date('Y-').'%')));
		$split_add = explode(':', $late_data[0][0]['count']); 
		$late_add = (60 * $split_add[0]) + $split_add[1];
		$this->set('late_hr_add', $late_add);
		return $late_add;
	}

}