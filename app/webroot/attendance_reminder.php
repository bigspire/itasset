<?php
include('config/db.php');
date_default_timezone_set('Asia/Calcutta');
$cur_date = date('Y-m-d');
// validate the date details
if($cur_date == date('Y-m-23')){
	$sql = "select id, first_name, last_name from app_users";
	$result = mysql_query($sql);
	// fetch all users
	while($rows = mysql_fetch_object($result)){		
		// iterate the no of day		
		$last_month = date('Y-m-26',strtotime($cur_date . "  -1 month"));			
		$id = $rows->id;		
		$sql2 = "select in_time, out_time from hr_attendance where app_users_id = '$id' and in_time between '$last_month' and '$cur_date'";
		$result2 = mysql_query($sql2);
		// fetch all users attendance
		while($rows2 = mysql_fetch_object($result2)){
			if($rows2->in_time == '' || $rows2->out_time == ''){
					$missed = $rows2->in_time;
			}
		}
		
	}
}




/* save the share in share table */
function save_share($id, $type, $msg){
	if(check_exists($id, $type) == false){
		$cur_time = date('Y-m-d H:i:s');		
		$sql = "insert into app_share (share, created_date, type, app_users_id)values('$msg', '$cur_time', '$type', '$id')";
		$result = mysql_query($sql);		
	}
}

/* make sure the update is not done */
function check_exists($id, $type){
	$cur_date = date('Y-m-d');
	$sql = "select count(*) from app_share where type = '$type' and app_users_id = '$id' and created_date like '$cur_date%'";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);
	if($row[0] > 0){
		return true;
	}else{
		return false;
	}
}
?>
test content