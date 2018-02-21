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

class TskReport extends AppModel {
	
	public $name = 'TskReport';
	 
	public $useTable = 'tsk_plan';
	  
	public $primaryKey = 'id';
	
	
	public $belongsTo = array(				
		'HrEmployee' => array(
            'className'  => 'HrEmployee',
			'foreignKey' => 'app_users_id'			
        )
	);
	
	/* function to get the team members */
	public function get_team($id, $mod, $list){
		return $this->get_team_mem($id, $mod, $list);
	}
	
	
		/* function to get planned hrs */
	public function planned_hr($start, $end, $user_id,$ids){ 
		//$user_id = $user_id ? $user_id : $ids;
		$user_data = $user_id ? array($user_id) : explode(',', $ids);
		$no_days = date('t', strtotime($start));
		// check no. of Sundays
		$start_month = explode('-', $start);
		$holiday_month = $start_month[0].'-'.$start_month[1];
			
		// check months completed or not
		$today = date('Y-m-d');
		$srch_month = $start_month[0].'-'.$start_month[1].'-'.$no_days;
		$sql = "SELECT DATEDIFF('$today','$srch_month') AS diff_days";
		$diff_result = $this->query($sql);
		if($diff_result[0][0]['diff_days'] < 0){
			$no_days = $no_days + $diff_result[0][0]['diff_days'];
			$end = $today;
		}else{
			$no_days = $no_days;			
		}
		// check no. of Sundays		
		$no_sunday = $this->get_no_sunday($holiday_month, $no_days);
		$no_days -= $no_sunday;
		$final_no_days = $no_days;
		// iterate the users
		$j = 0;
		foreach($user_data as $user_id){
			// get the category name
			$sql = "select first_name, last_name, hr_branch_id from app_users where id = '$user_id'";
			$cat_result = $this->query($sql);
			$branch = $cat_result[0]['app_users']['hr_branch_id'];
			$no_days = $final_no_days;
			$sql = "select is_plan, SUM( TIME_TO_SEC(TIMEDIFF(t.end, t.start))) as count from tsk_plan t inner join app_users a on (t.app_users_id = a.id) where  t.app_users_id = '$user_id' and t.type = 'D' and t.is_deleted = 'N' and a.status = '1' and a.is_deleted = 'N' and t.start like '$holiday_month%'
			group by is_plan"; 
			$result = $this->query($sql);
			
			$planned = ''; $unplanned = '';
			foreach($result as $res){ 
				switch($res['t']['is_plan']){
					case 'Y':
					$planned = $res[0]['count'];
					break;
					case 'N':
					$unplanned = $res[0]['count'];
					break;
				}
			}
			// reduce second and forth Saturdays
			$no_sat = $this->get_no_saturday($holiday_month, $no_days);
			$no_days -= $no_sat;
			
			// check no. of holidays		
			$sql = "select count(*) as holiday from hr_holiday where hr_branch_id = '$branch' and status = '1' and is_deleted = 'N' and event_date between  '$start' and '$end'";
			$holiday_result = $this->query($sql);
			$no_days -= $holiday_result[0][0]['holiday'];
			
			// 1 day
			$work_sec = 28800 * $no_days; // 60 * 60 * 8
			
			$planned_percent = floor(($planned / $work_sec ) * 100);
			$unplanned_percent = floor(($unplanned / $work_sec ) * 100);
			
			$percent[$j][] = $planned_percent.'|'.$unplanned_percent;
			
			$percent[$j][] = $cat_result[0]['app_users']['first_name'].' '.$cat_result[0]['app_users']['last_name'];
			
			$j++;
		}
		
		
		
		return $percent;
	}
	
		/* function to get planned hrs of company*/
	public function planned_hr_company($start, $end, $dept, $bus_unit, $loc, $type){
		// get list of users in the department
		if($type == 'D'){
			$field = 'hr_department_id';
			$id = $dept;
			$table = 'hr_department';
			$label = 'dept_name';
		}else if($type == 'B'){
			$field = 'hr_business_unit_id';
			$id = $bus_unit;
			$table = 'hr_business_unit';
			$label = 'business_unit';
		}else if($type == 'L'){
			$field = 'hr_branch_id';
			$id = $loc;
			$table = 'hr_branch';
			$label = 'branch_name';
		}
		// check for all condition
		if($dept == '' && $bus_unit == '' && $loc == ''){	
			$sql = "select id from $table where is_deleted = 'N' and status = '1'";
			$data = $this->query($sql);
		}else{
			$data = array(1);
		}
		$no_days = date('t', strtotime($start));
		$start_month = explode('-', $start);
		$holiday_month = $start_month[0].'-'.$start_month[1];
		// check months completed or not
		$today = date('Y-m-d');
		$srch_month = $start_month[0].'-'.$start_month[1].'-'.$no_days;
		$sql = "SELECT DATEDIFF('$today','$srch_month') AS diff_days";
		$diff_result = $this->query($sql);
		if($diff_result[0][0]['diff_days'] < 0){
			$no_days = $no_days + $diff_result[0][0]['diff_days'];
			$end = $today;
		}else{
			$no_days = $no_days;			
		}
		// check no. of Sundays		
		$no_sunday = $this->get_no_sunday($holiday_month, $no_days);
		$no_days -= $no_sunday;
		// reduce second and forth Saturdays
		$no_sat = $this->get_no_saturday($holiday_month, $no_days);
		$no_days -= $no_sat;
		$final_no_days = $no_days;
		$j = 0;
		foreach($data as $value){
			$no_days = $final_no_days;
			$val =  $value[$table]['id'] ? $value[$table]['id'] : $id;
			$sql = "select id, hr_branch_id from app_users where is_deleted = 'N' and $field = '$val';";
			$result = $this->query($sql);
			// get the category name
			$sql = "select $label from $table where id = '$val'";
			$cat_result = $this->query($sql);			
			$i = 0;
			$total_hrs = '';
			// check no. of holidays		
			$sql = "select count(*) as holiday from hr_holiday where hr_branch_id = '$branch' and status = '1' and is_deleted = 'N' and event_date between '$start' and '$end';";
			$holiday_result = $this->query($sql);
			$no_days -= $holiday_result[0][0]['holiday'];
			// iterate the users
			$planned = ''; $unplanned = '';
			foreach($result as $record){
				$user_id = $record['app_users']['id'];	
				
				$sql = "select  is_plan, SUM( TIME_TO_SEC(TIMEDIFF(t.end, t.start))) as count from tsk_plan t inner join app_users a on (t.app_users_id = a.id) where t.app_users_id = '$user_id' and t.type = 'D' and t.is_deleted = 'N' and a.is_deleted = 'N' and t.start like '$holiday_month%' group by is_plan;"; 
				
				//if($val == 9){ echo $sql; echo "<br>"; }
				
				$task_result = $this->query($sql);
				
				
				foreach($task_result as $res){ 
					switch($res['t']['is_plan']){
						case 'Y':
						$planned += $res[0]['count'];
						break;
						case 'N':
						$unplanned += $res[0]['count'];
						break;
					}
				}
				
				// set employee branch
				$branch = $record['app_users']['hr_branch_id'];
				
				//$total_hrs += $task_result[0][0]['count'];	
								
				$i++;
				
			}		
			
			//echo $total_hrs; echo "<br>";
			
			//echo $no_days; echo "<br>";
			
			// 1 day
			
			$work_sec = 28800 * $no_days * $i; // 60 * 60 * 8
			
			$planned_percent = floor(($planned / $work_sec ) * 100);
			$unplanned_percent = floor(($unplanned / $work_sec ) * 100);
			
			$percent[$j][] = $planned_percent.'|'.$unplanned_percent;
			
			//if($val == 9){ echo $no_days; echo "<br>"; }
			
			//$percent[$j][] = floor(($total_hrs / $work_sec ) * 100);
			
			$percent[$j][] = $cat_result[0][$table][$label];
			
			$j++;
		}
		
		//echo '<pre>'; print_r($percent);
		
		return $percent;
	}
	
	/* function to find no. of sundays */
	public function get_no_sunday($date, $tot_day){	
		for($i = 1; $i <= $tot_day; $i++){ //echo $date.$i;
			$day = date('N', strtotime($date.'-'.$i));
			if($day == 7){
				$no_sunday++;
			}
		}
		return $no_sunday;
	}
	
	/* function to get no. of saturdays */
	public function get_no_saturday($date, $tot_day){
		$first_day = date('N', strtotime($date.'-'.'01'));
		// get first saturday
		$first_sat = $this->get_first_sat($first_day );
		//$first_sat; 
		$second_sat = $first_sat + 7;  
		$third_sat = $second_sat + 7; 
		$forth_sat = $third_sat + 7;
		$no_sat = 0;
		for($i = 1; $i <= $tot_day; $i++){ 
			if($i == $second_sat || $i == $forth_sat){
				$no_sat++;
			}
		}
		return $no_sat;
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
	
}