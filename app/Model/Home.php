<?php
/**
 * Application model for Cake.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
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
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

class Home extends AppModel {
	
	public $name = 'Home';
	 
	public $useTable = 'app_users';
	  
	public $primaryKey = 'id';
	
	public $virtualFields = array('full_name' => "UPPER(CONCAT_WS(' ', Home.first_name, Home.last_name))");

	public $belongsTo = array(		
		'HrDepartment' => array(
            'className'  => 'HrDepartment',
			'foreignKey' => 'hr_department_id'		
        ),
		'HrDesignation' => array(
            'className'  => 'HrDesignation',
			'foreignKey' => 'hr_designation_id'		
        )
		,
		'HrBranch' => array(
            'className'  => 'HrBranch',
			'foreignKey' => 'hr_branch_id'		
        ),
		'HrCompany' => array(
            'className'  => 'HrCompany',
			'foreignKey' => 'hr_company_id'		
        ),
		'HrBusinessUnit' => array(
            'className'  => 'HrBusinessUnit',
			'foreignKey' => 'hr_business_unit_id'			
        ),
		'HrBloodGroup' => array(
            'className'  => 'HrBloodGroup',
			'foreignKey' => 'hr_blood_group_id'			
        )
	);
	
	public $hasOne = array(		
		'Todo' => array(
            'className'  => 'Todo',
			'foreignKey' => 'app_users_id'			
        )
	);
	
	/* function to get users  share */
	public function get_share($id, $today, $last_day, $start, $end, $type){	
		$typeCond = ($type != 'shareTxtBx' && $type != '') ? " and type = 'R'" : " and type != 'R'";		
		$sql = "SELECT roa_type, roa_month,`ShareUser`.`app_users_id`, `Share`.`id`, `Share`.`app_users_id`, `Share`.`type`,`Share`.`share`,
		`Share`.`attachment`,`Share`.`created_date`, `Home`.`first_name`, `Home`.`photo`,`Home`.`photo_status`, `Share`.`reply_id`, `Home`.`last_name`, 
		`Home`.`id`, `Home`.`gender` FROM `app_share` AS `Share` LEFT JOIN `app_users` AS `Home` ON (`Share`.`app_users_id` = `Home`.`id`) 
		LEFT JOIN `app_share_user` AS `ShareUser` ON (`ShareUser`.`app_share_id` = `Share`.`id`) WHERE `Share`.`created_date` between '$last_day'  
		and '$today'  and  (`ShareUser`.`app_users_id` = '$id' or `ShareUser`.`app_users_id` is NULL or `Share`.`app_users_id` = '$id') 
		and `Share`.`reply_id` is NULL $typeCond group by `Share`.`id` ORDER BY `Share`.`modified_date` desc  limit $start, $end";
		$result = $this->query($sql);		
		return $result;
	
	}
	
		/* function to get users  share replies */
	public function get_share_reply($id, $today, $last_day){	
		$sql = "SELECT `ShareUser`.`app_users_id`,`Share`.`type`, `Share`.`app_users_id`, `Share`.`id`, `Share`.`share`, `Share`.`attachment`,`Share`.`created_date`, `Home`.`first_name`, `Home`.`photo`, `Home`.`photo_status`, `Share`.`reply_id`, `Home`.`last_name`, `Home`.`id`, `Home`.`gender` FROM `app_share` AS `Share` LEFT JOIN `app_users` AS `Home` ON (`Share`.`app_users_id` = `Home`.`id`) LEFT JOIN `app_share_user` AS `ShareUser` ON (`ShareUser`.`app_share_id` = `Share`.`id`) WHERE `Share`.`created_date` between '$last_day'  and '$today'  and  (`ShareUser`.`app_users_id` = '$id' or `ShareUser`.`app_users_id` is NULL or `Share`.`app_users_id` = '$id') and `Share`.`reply_id` != ''   ORDER BY `Share`.`created_date` desc";
		$result = $this->query($sql);		
		return $result;
	
	}
	
	
	
	
	/* function to get count  share */
	public function get_total_share($id, $today, $last_day, $type){
		$typeCond = $type != '' ? " and type = 'R'" : " and type != 'R'";
		/*
		$sql = "SELECT count(*) as total FROM `app_share` AS `Share` LEFT JOIN `app_users` AS `Home` ON (`Share`.`app_users_id` = `Home`.`id`) LEFT JOIN 
		`app_share_user` AS `ShareUser` ON (`ShareUser`.`app_share_id` = `Share`.`id`) WHERE `Share`.`created_date` between '$last_day'  and '$today' 
		and  (`ShareUser`.`app_users_id` = '$id' or `ShareUser`.`app_users_id` is NULL or `Share`.`app_users_id` = '$id') $typeCond ";
		*/
		$sql = "SELECT count(*) as total FROM `app_share` AS `Share` LEFT JOIN `app_users` AS `Home` ON (`Share`.`app_users_id` = `Home`.`id`) 
		LEFT JOIN `app_share_user` AS `ShareUser` ON (`ShareUser`.`app_share_id` = `Share`.`id`) WHERE `Share`.`created_date` between '$last_day'  
		and '$today'  and  (`ShareUser`.`app_users_id` = '$id' or `ShareUser`.`app_users_id` is NULL or `Share`.`app_users_id` = '$id') 
		and `Share`.`reply_id` is NULL $typeCond";
		$result = $this->query($sql);		
		return $result[0][0]['total'];
	
	}
	
	
	/* function to get count  share */
	public function get_share_count($id, $today, $last_day, $type){	
		$typeCond = $type == 'roa' ? " and type = 'R'" : " and type != 'R'";
		$sql = "SELECT count(*) as total FROM `app_share` AS `Share` LEFT JOIN `app_users` AS `Home` ON 
		(`Share`.`app_users_id` = `Home`.`id`) LEFT JOIN `app_share_user` AS `ShareUser` 
		ON (`ShareUser`.`app_share_id` = `Share`.`id`) WHERE `Share`.`created_date` between '$last_day'  
		and '$today'  $typeCond  and `Share`.`app_users_id` != '$id' and (`ShareUser`.`app_users_id` = '$id' or (`Share`.`app_users_id` != '$id' and  
		`ShareUser`.`app_users_id` is NULL $typeCond) or `Share`.`type` != 'S')";
		$result = $this->query($sql);		
		return $result[0][0]['total'];
	
	}
	
	
	/* function to get the team members */
	public function get_team($id, $mod){
		return $this->get_team_mem($id, $mod);
	}
	
	
		/* function used to get the members */	
	public function check_team_mem($id, $mod){  
		$str_sql = "or a.level2 = '$id'";
		$sql = "select count(*) as count from app_users u inner join app_approval a 
		on (a.app_users_id = u.id) where (a.level1 = '$id' $str_sql) and a.type = '$mod' 
		and u.is_deleted = 'N'	and u.status = '1'";		
		$result = $this->query($sql);
		return $result[0][0]['count'];
		
	}
	
	
	/* function to get team members attendance */
	public function get_tm_att($tm, $action){
		$date = date('Y-m-d');		
		
		$field = "t.id, u.id,a.is_permission,a.late_reason,a.out_reason,a.out_reason_type,a.id,date_format(a.in_time, '%d-%b-%Y') as in_date,date_format(a.in_time, '%h:%i %p') as in_time, date_format(a.in_time, '%H:%i:%s') as act_in_time, date_format(a.out_time, '%h:%i %p') as out_time,concat(u.first_name,' ',u.last_name) as first_name,ot.grace_time,ot.start_time,ot.end_time,date_format(a.out_time, '%H:%i:%s') as act_out_time,
		date_format(a.bio_in_time, '%h:%i %p') as bio_in_time,	date_format(a.bio_out_time, '%h:%i %p') as bio_out_time";
		
		if($action == 'view'){
			//echo $sql = "SELECT  group_concat(t.id) as tid, $field FROM `hr_attendance` AS `a` LEFT JOIN `app_users`
			//AS `u` ON (`a`.`app_users_id` = `u`.`id`)  left join hr_office_timing as ot on (ot.app_users_id = u.id)			
			//left join tsk_plan t on (t.app_users_id = u.id and t.type = 'D' and date_format(t.start, '%Y-%m-%d') = date_format(a.in_time, '%Y-%m-%d')) 
			//WHERE `a`.`app_users_id` in ($tm) and date_format(a.in_time, '%Y-%m-%d') = '$date' group by a.id  order by a.id asc";	
			//
			$sql = "SELECT 
			group_concat(t.id) as tid,
			t.id,
			u.id,
			a.is_permission,
			a.late_reason,
			a.out_reason,
			a.out_reason_type,			
			a.id,
			
			ot.grace_time,
			ot.start_time,
			ot.end_time,
			date_format(a.in_time, '%d-%b-%Y') as in_date,
			date_format(a.in_time, '%h:%i %p') as in_time,
			date_format(a.in_time, '%H:%i:%s') as act_in_time,
			date_format(a.out_time, '%h:%i %p') as out_time,
			concat(u.first_name, ' ', u.last_name) as first_name,
			date_format(a.out_time, '%H:%i:%s') as act_out_time
		FROM
			`app_users` AS `u`
				left JOIN
			`hr_attendance` AS `a` ON (`a`.`app_users_id` = `u`.`id`
				and (date_format(a.in_time, '%Y-%m-%d') = '$date'))
				left join
			tsk_plan t ON (t.app_users_id = u.id and t.type = 'D'
				and date_format(t.start, '%Y-%m-%d') = date_format(a.in_time, '%Y-%m-%d'))
				LEFT JOIN
			hr_office_timing as ot ON (ot.app_users_id = u.id)
		WHERE
			`u`.`id` in ($tm)
		group by u.id
		order by u.first_name asc";

		}else{
			$sql = "SELECT  a.task_view,a.att_waive, group_concat(t.id) as tid, $field FROM `hr_attendance` AS `a` LEFT JOIN `app_users`
			AS `u` ON (`a`.`app_users_id` = `u`.`id`)  left join hr_office_timing as ot on (ot.app_users_id = u.id)
			left join tsk_plan t on (t.app_users_id = u.id and t.type = 'D' and date_format(t.start, '%Y-%m-%d') = date_format(a.in_time, '%Y-%m-%d')) 
			WHERE `a`.`app_users_id` in ($tm) and a.status = 'W' and a.in_time != '' and a.out_time != '' and u.att_approve = '1' and date_format(a.in_time, '%Y-%m-%d') < '$date'
			group by a.id  order by a.id asc";
		}
		
		$result = $this->query($sql);	
		return $result;
	}
	
	/* function to get planned hrs */
	public function planned_hr($date, $user_id){
		foreach($date as $day){
			$sql = "select  is_plan, SUM( TIME_TO_SEC(TIMEDIFF(end, start))) as count from tsk_plan where app_users_id = '$user_id' 
			and is_deleted = 'N' and type = 'D' and status != 'P' and date_format(start, '%Y-%m-%d') = '$day' group by is_plan"; 
			$result = $this->query($sql);
			$planned = ''; $unplanned = '';
			foreach($result as $res){
				switch($res['tsk_plan']['is_plan']){
					case 'Y':
					$planned = $res[0]['count'];
					break;
					case 'N':
					$unplanned = $res[0]['count'];
					break;
				}
			}
			// 1 hr
			//$work_sec = 28800; // 60 * 60 * 8
			//$planned_percent = floor(($planned / 28800 ) * 100);
			//$unplanned_percent = floor(($unplanned / 28800 ) * 100);
			
			$work_sec = 3600; // 60 * 60
			$planned_hr = floor($planned / $work_sec );
			$unplanned_hr = floor($unplanned / $work_sec );
			
			// fix to 12 hrs if more than 12 hrs
			$planned_hr = $planned_hr > 14 ? 14 : $planned_hr;
			$unplanned_hr = $unplanned_hr > 14 ? 14 : $unplanned_hr;
			
			$tot_plan_hr[] = $planned_hr.'|'.$unplanned_hr;
		}
		
		return $tot_plan_hr;
		
	}
	
	
	/* function to get planned hrs */
	public function overall_chart($user_id, $type){
			$date_cond = $type == 'M' ? date('Y-m-').'%' : date('Y-').'%';
			$sql = "select  is_plan, SUM( TIME_TO_SEC(TIMEDIFF(end, start))) as count from tsk_plan where app_users_id = '$user_id' 
			and is_deleted = 'N' and type = 'D' and status != 'P' and date_format(start, '%Y-%m-%d') like '$date_cond' group by is_plan"; 
			$result = $this->query($sql);
			$planned = ''; $unplanned = '';
			foreach($result as $res){
				switch($res['tsk_plan']['is_plan']){
					case 'Y':
					$planned = $res[0]['count'];
					break;
					case 'N':
					$unplanned = $res[0]['count'];
					break;
				}
			}
			
			$work_sec = 3600; // 60 * 60
			$planned_hr = floor($planned / $work_sec );
			$unplanned_hr = floor($unplanned / $work_sec);
			
			$tot_plan_hr = $planned_hr.'|'.$unplanned_hr;
		
		
		return $tot_plan_hr;
		
	}
	
	/* function to get the today planning */
	public function get_today_planned($day, $user_id, $status){		
		if($status){
			$st_cond = "and status = 'W'";
		}
		$sql = "select SUM( TIME_TO_SEC(TIMEDIFF(end, start))) as count from tsk_plan where app_users_id = '$user_id' and status != 'P' and type = 'D' and is_deleted = 'N' and date_format(start, '%Y-%m-%d') = '$day' $st_cond"; 
		$result = $this->query($sql);
		// 1 hr
		$work_sec = 28800; // 60 * 60 * 8
		$percent = floor(($result[0][0]['count'] / 28800 ) * 100);
		return $percent;
	}

		
	/* function to get plan status chart */
	public function status_chart($date, $user_id){
		$i = 0;
		foreach($date as $day){
			$sql = "select  status, count(*) as count from tsk_plan where app_users_id = $user_id and is_deleted = 'N' and (date_format(start, '%Y-%m-%d') = '$day' or (date_format(start, '%Y-%m-%d') <= '$day'
and date_format(end, '%Y-%m-%d') >= '$day')) group by status;"; 
			$result = $this->query($sql);
			if(strtotime($day) <= strtotime(date('Y-m-d'))){
				// iterate the results
				foreach($result as $data){ //echo $data['tsk_plan']['status'];
					switch($data['tsk_plan']['status']){
						case 'W':
						$status['p'][$i] = $data[0]['count'];
						break;
						default:
						$status['u'][$i] += $data[0]['count'];
						break;
					}
				}
				
			}else{ // for upcoming task				
				foreach($result as $data){
					$status['f'][$i] += $data[0]['count'];
				}
			}
			
			$i++;
			
		}
		
		return $status;
	}

	
	/* function to get monthly task report */
	public function get_month_task($user_id, $date){
		$sql = "select  tp.title, SUM( TIME_TO_SEC(TIMEDIFF(t.end, t.start))) as count from tsk_plan t inner join app_users a 
		on (t.app_users_id = a.id) inner join tsk_plan_types tp on (tp.id = t.tsk_plan_types_id) where  t.app_users_id = '$user_id' 
		and t.status != 'P' and t.type = 'D' and t.is_deleted = 'N' and a.status = '1' and a.is_deleted = 'N' and t.start like '$date%' group by tsk_plan_types_id"; 
		$result = $this->query($sql);
		return $result;
	}
	
	
	/* function to get assigned asset count */
	public function get_it_assign_count($user_id){ 
		$sql = "CALL it_list_assign_emp('".$user_id."','S', '')"; 
		$result = $this->query($sql);
		$count_sw = (count($result));
		$sql = "CALL it_list_assign_emp('".$user_id."','H', '')"; 
		$result = $this->query($sql);
		$count_hw = (count($result));
		return $count = $count_sw + $count_hw;
	}
	

	
	
	

	
}