<?php
include('config/db.php');
date_default_timezone_set('Asia/Calcutta');
$cur_date_m = date('m-d');
// get birthday details
$sql = "select id from app_users where dob like '%$cur_date_m' and is_deleted = 'N' and status = '1'";
$result = mysql_query($sql);
while($rows = mysql_fetch_array($result)){
	// insert into share
	$msg = 'Wishing you a Happy Birthday';
	save_share($rows['id'], 'B', $msg);
}

// get wedding details
$sql = "select id from app_users where wedding_date like '%$cur_date_m'  and is_deleted = 'N' and status = '1'";
$result = mysql_query($sql);
while($rows = mysql_fetch_array($result)){
	// insert into share
	$msg = 'Wishing you a Happy Wedding Day';
	save_share($rows['id'], 'W', $msg);
}
/* for work anniversary */
$sql = "select id, doj, first_name, last_name from app_users where doj like '%$cur_date_m'  and is_deleted = 'N' and status = '1'";
$result = mysql_query($sql);
while($rows = mysql_fetch_array($result)){ 
	$no_days = time_diff($rows['doj']);
	if($no_days > 360){
		$no_work = floor(floor($no_days)/365);
		$suf = get_ordinal($no_work);
		// insert into share
		$msg = "Wishing you a Happy <b>$no_work<sup>$suf</sup></b> Work Anniversary. Thank You!";
		save_share($rows['id'], 'A', $msg);
	}else{
		// for new employee
		$msg = 'CareerTree Team wishes you the best in your new assignment and a happy association with us.';
		save_share($rows['id'], 'N', $msg, 'welcome.jpg');
	}
}

// getting date of confirmation reminder
$cur_date = date('Y-m-d');
$sql = "select id from app_users where doc = '$cur_date' and probation = 'C'  and is_deleted = 'N' and status = '1'";
$result = mysql_query($sql);
while($rows = mysql_fetch_array($result)){
	// insert into share
	$msg = 'Congrats, You have successfully completed your probation period!';
	save_share($rows['id'], 'P', $msg);
}

// getting thought of the day 
$day = date('N', strtotime($cur_date));
// check for sunday
if($day != '7'){
	$first_day = date('N', strtotime(date('Y-m-01')));
	$day_split = explode('-', $cur_date);
	// get first saturday
	$first_sat = get_first_sat($first_day );
	$second_sat = $first_sat + 7;  
	$third_sat = $second_sat + 7; 
	$forth_sat = $third_sat + 7;
	// check for 2nd and 4th sat.
	if($day_split[2] != $second_sat && $day_split[2] != $forth_sat){
		$_GET['tot_files'] = get_thought_dir();
		$filename = get_thought(rand(0,$_GET['tot_files']));	
		if(!empty($filename)){
			save_share_nocheck(0, 'T', '',$filename);
		}
	}
}

/* function to count the thought dir */
function get_thought_dir(){
	$root_dir = '/var/www/html/';
	$project_dir = '/app/webroot/';
	$root_dir = $_SERVER['DOCUMENT_ROOT'] ? $_SERVER['DOCUMENT_ROOT'] : $root_dir; 
	if ($handle = opendir($root_dir.'/'.$project_dir.'uploads/thought/')) {
		while (false !== ($file_name = readdir($handle))) {
			if($file_name != '..' && $i != '.'){
				$count++;
			}
		}
	}
	return $count;
}


/* function to generate random */
function get_thought($rand){
	$i = 0;	
	$root_dir = '/var/www/html/';
	$project_dir = '/app/webroot/';
	$root_dir = $_SERVER['DOCUMENT_ROOT'] ? $_SERVER['DOCUMENT_ROOT'] : $root_dir; 
	if ($handle = opendir($root_dir.'/'.$project_dir.'uploads/thought/')) {
		while (false !== ($file_name = readdir($handle))) {
			if($i == $rand && $file_name != '..' && $i != '.'){
				// check for duplicate
				if($result = check_though_dup($file_name)){
					return get_thought(rand(0,$_GET['tot_files']));
				}else{
					return $file_name;
				}				
			}elseif (($file_name == '.' || $file_name == '..') && ($i == $rand)){
				// regenerate random				
				return get_thought(rand(0,$_GET['tot_files']));
			}
			$i++;		
		}		
		closedir($handle);
	}
}



/* function to check thought for duplicate entry */
function check_though_dup($file){
	// make sure the file is not used in last week
	$cur_date = date('Y-m-d',strtotime($cur_date . "  +1 Day"));
	$week = date('Y-m-d',strtotime($cur_date . "  -1 week"));	
	$sql = "select count(*)  from app_share where attachment = '$file' and type = 'T' and created_date
	between '$week' and '$cur_date'";
	$result = mysql_query($sql);
	$rows = mysql_fetch_array($result);
	if($rows[0] > 0){
		return $file;
	}
}

/* save the share in share table */
function save_share($id, $type, $msg, $attach=null){ 
	if(check_exists($id, $type) == false){
		$cur_time = date('Y-m-d H:i:s');	
		// for date of joining
		if($attach != ''){
			$sql = "insert into app_share (share, created_date,modified_date, type, app_users_id, attachment)values('$msg', '$cur_time','$cur_time', '$type', '$id', '$attach')";
		}else{
			$sql = "insert into app_share (share, created_date,modified_date, type, app_users_id)values('$msg', '$cur_time','$cur_time', '$type', '$id')";
		}
		
		$result = mysql_query($sql);		
	}
}

/* save the share in share table */
function save_share_nocheck($id, $type, $msg,$file){ 	
	if(check_exists('0', $type) == false){
		$cur_time = date('Y-m-d H:i:s');		
		$sql = "insert into app_share (share, created_date, type, app_users_id,attachment,modified_date)values('$msg', '$cur_time', '$type', '$id', '$file','$cur_time')";
		$result = mysql_query($sql);	
	}
}

/* function to get first sat */
function get_first_sat($first_day){
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
/* function to find the time of event */
function time_diff($date){ 
		$s = abs(time() - strtotime($date));
		if($s >= 1) {
			$td = "$s sec";
		}   
		
		if($s > 59){ 
			$m = (int)($s/60); 
			$s = $s-($m*60); // sec left over 
			$td = "$m min";  if($s>1) $td .= "s"; 
		} 
		
		if($m > 59){ 
			$hr = (int)($m/60); 
			$m = $m-($hr*60); // min left over 
			$td = "$hr hr"; if($hr>1) $td .= "s"; 
			
		} 
		if($hr>23){		
			$d = (int)($hr/24); 
			$hr = $hr-($d*24); // hr left over 
			$td = "$d day"; if($d>1) $td .= "s"; 
			
		} 
		
		return $d;
		
   }
   
/* function to get ordinal no. */
 function get_ordinal($num) {
    if (!in_array(($num % 100),array(11,12,13))){
      switch ($num % 10) {
        // Handle 1st, 2nd, 3rd
        case 1:  return 'st';
        case 2:  return 'nd';
        case 3:  return 'rd';
      }
    }
    return 'th';
  }
?>
test content