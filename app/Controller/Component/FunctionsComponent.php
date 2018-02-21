<?php
App::uses('Component', 'Controller');
class FunctionsComponent extends Component {

	/* initialize component to get data */
	public function initialize(Controller $controller) {
		$this->controller = $controller;
	}
	
	/* show task time in formatted */
	public function show_task_time($date, $plan_type){
		if($plan_type == 'D'){
			return date('h:i A', strtotime($date));
		}else{
			return date('d-M-Y', strtotime($date));
		}
	}
	
	/* function to remove spl. char. */
	public function remove_spl_char($str){
		return trim(str_replace(array("\n", "\r", '"',"'", "\t"), ' ', $str));
	}
	
	/* function to get travel type */
	public function get_travel_type(){
		$type = array('1' => 'One Way', '2' => 'Round Trip');
		return $type;
	}
	
		/* function to show the cc type */
	public function check_task_cc($cc){
		// check task is cc
		if($cc == 1){		
			return $type = " <span rel='tooltip'  class='task_info cc_task tsk_tip label label-yellow' data-original-title='Not assigned, just Cc'>Cc</span>";			
		}
	}
	
	/* function to check the grace time */
	public function check_grace($date, $grace, $format){ 
		if(strtotime($date) <= strtotime('2016-03')){		
			return $grace;
		}else{ 
			return 0;
		}
	}
	
	
	/* show plan type */
	public function show_plan_type($type){
		if($this->controller->request->params['controller'] == 'tskplan' || $this->controller->request->params['controller'] == 'tskteamplan'){
			$txt = 'Task';
		}else{
			$txt = 'Task';
		}
		return  $type == 'D' ? 'Daily '.$txt : 'Project '.$txt;
	}
	
	/* function to show task status */
	public function get_plan_status($action){ 
		if($action == 'change_status'){
			return $status = array('E' => 'Executed',  'L' => 'Partially Done', 'P' => 'Postponed',  'C' => 'Cancelled');
		}else if($action == 'assign_change'){
			return $status = array('C' => 'Cancelled','P' => 'Postponed');
		}if($action == 'user_change_status'){
			return $status = array('E' => 'Executed');
		}if($action == 'team_assign'){
			return $status = array('W' => 'Pending', 'E' => 'Executed', 'P' => 'Postponed', 'C' => 'Cancelled');
		}else{
			return $status = array('W' => 'Pending', 'E' => 'Executed',  'L' => 'Partially Done', 'P' => 'Postponed', 'C' => 'Cancelled');
		}
	}
	
	/* function to get day of date */
	public function get_day($date, $type){
		if(empty($type)){
			$letter = 'l';
		}else{
			$letter = 'D';
		}
		return date($letter, strtotime($date));
	}
	
	/* get task date */
	public function get_task_date($date){
		return date('j-F', strtotime($date));
	}
	
	/* function to enable task edit */
	public function check_task_edit($date){
		$task_date = date('Y-m-d', strtotime($date)); 
		if($this->controller->request->params['controller'] == 'tskplan'){
			// check the task not crossed the closing date
			if(strtotime($task_date) >= strtotime(date('Y-m-d'))){
				return true;
			}else{
				return false;
			}
		}else{
			return true;
		}
	}
	
	/* function to generate comp. off dates */
	public function generate_comp_days($no_days, $type){
		$day = date('Y-m-d');
		for($i = 1; $i <= $no_days; $i++){			
			$prev_day = date('Y-m-d',strtotime($day . "  -1 day"));
			$day = $prev_day;
			if($type == 'list'){
				$last_days[$prev_day] = $this->format_date($prev_day);
			}else{
				$last_days[] = $prev_day;
			}
		}	
		asort($last_days);
		return $last_days;
	}
	
	
	/* show status color */
	public function show_task_plan_color($st){
		switch($st){
			case 'P':
			$color = 'label-info2';
			break;
			case 'D':
			$color = 'label-warning';
			break;			
		}
		
		return $color;
	}
	
		/* show status color */
	public function show_lead_task_status_color($st,$modified,$created){ 
		// if user updated task 
		if(strtotime($created) > strtotime($modified) || $st == 'A'){
			switch($st){
				case 'R':
				$color = 'label-important';
				break;
				case 'A':
				$color = 'label-success';
				break;			
			}	
		}
		return $color;
	}
	
	
	/* show status color */
	public function show_task_status_color($st){
		switch($st){
			case 'P':
			$color = 'label-important';
			break;
			case 'E':
			$color = 'label-success';
			break;
			case 'M':
			$color = 'label-warning';
			break;
			case 'L':
			$color = 'label-info2';
			break;
			case 'W':
			$color = '';
			break;
			case 'C':
			$color = 'label-inverse';
			break;
		}
		
		return $color;
	}
	
		
	/* function to show lead status remark */
	public function show_lead_remark($id,$status,$modified,$created){ 
		if($status == 'R' && strtotime($created) > strtotime($modified)){
			return $link = "<a href='javascript:void(0)' rel='tooltip'   val='".$id."' st='".$id."' mod='lead_remark' id='lead_tk_".$id."' title='View Comment' class = 'commentTsk'><i class=icon-comment-alt></i></a>";
		}
	}
	
	
	
	/* function to show the task status */
	public function show_lead_task_status($st,$modified,$created,$rec_status){  
			// if user updated task 
		if(!empty($created)){
			if(strtotime($modified) > strtotime($created)  &&  $st == 'R'){
				return $status = 'Pending';			
			}
		}else if(empty($created) && $rec_status == 'W'){
			return ;
		}
		// make sure 
		//if($rec_status != 'W'){
			switch($st){
				case 'A':
				$status = 'Approved';
				break;
				case 'R':
				$status = 'Rejected';
				break;
				default:
				$status = 'Pending';
				break;
			}
			return $status;	
		//}
	}
	
	/* function to show the task status */
	public function show_task_status($st){
		switch($st){
			case 'P':
			$status = 'Postponed';
			break;
			case 'E':
			$status = 'Executed';
			break;
			case 'M':
			$status = 'Modified';
			break;
			case 'L':
			$status = 'Partially Done';
			break;
			case 'W':
			$status = 'Pending';
			break;
			case 'C':
			$status = 'Cancelled';
			break;
		}
		
		return $status;
	}

	
	/* function to show read status type */
	public function check_read_type($status,$type,$id){
		// check task is unread
		if($status == 'U'){
			if($type == 'N'){
				return $type = " <span rel='tooltip' val='info-".$id."' class='task_info tsk_tip label label-green' data-original-title='New Task'>New</span>";
			}else if($type == 'M'){
				return $type = " <span rel='tooltip' val='info-".$id."' class='task_info tsk_tip label label-pink' data-original-title='Task Modified'>Edit</span>";
			}else if($type == 'R'){
				return $type = " <span rel='tooltip' val='info-".$id."'  class='task_info tsk_tip label label-brown' data-original-title='Task Replied'>Reply</span>";
			}
		}
	}
	
		
	public function format_tsk_date($date){
		if(!empty($date)){
			$date =  split("[-: ]", $date);
			return date('d/m/Y',mktime($date[3],$date[4],$date[5],$date[1],$date[2],$date[0]));
		}
	}
	
		
	/* function to show read status */
	public function show_read_class($st){
		if($st == '0'){
			return 'tsk_read';
		}else{ // changed logic
			return 'tsk_unread';
		}
		
	}
	
	/* function to show read status */
	public function show_read_text($st){
		if($st == '0'){
			return 'Mark as Important';
		}else{ // changed logic
			return 'Important Task ';
		}
		
	}
	
	/* string truncate*/
	function string_truncate($message,$length){ 	
		$message = strip_tags($message);
		$dots = '..';
	    $len = strlen($message);
		if($len > $length){	
			$position =  strpos($message,' ',$length);	
			if($position){
				return $message = substr($message,0,$position).$dots;		
			}else{
				return $message = substr($message,0,$length).$dots;
			}				
		}
		else{
			return $message;		
		}			
	}
	
	/* function to validate the file */
	public function validate_img($type, $size){
		$process = true;
		// validate type
		if($type != 'image/jpeg' &&  $type != 'image/jpg' &&  $type != 'image/gif' && $type != 'image/png'){
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

	/* function to create url variables */
	public function create_url($url,$model){ 
		$count = count($url) - 1;
		foreach($url  as $key => $param){ 	
			if(!empty($this->controller->request->data[$model][$param])){		
				$url_var .= $param.'='.$this->controller->request->data[$model][$param].'&';
			}
		}
		$url_var = substr($url_var, 0, strlen($url_var)-1);
		return $url_var;
	}
	
	/* function to create url variables */
	public function create_redirect_url($url,$model){ 
		$count = count($url) - 1;
		foreach($url  as $key => $param){ 	
			if(!empty($this->controller->request->query[$param])){		
				$url_var .= $param.'='.$this->controller->request->query[$param].'&';
			}
		}
		
		$url_var = substr($url_var, 0, strlen($url_var)-1);
		return $url_var;
	}
	
	/* format time for attedance */
	public function format_attime($date){
		if(!empty($date)){
			$date =  split("[-: ]", $date);
			return date('h:i a',mktime($date[3],$date[4],$date[5],$date[1],$date[2],$date[0]));
		}
	}
	
	public function format_date($date){
		if(!empty($date)){
			$date =  split("[-: ]", $date);
			return date('d-M-Y',mktime($date[3],$date[4],$date[5],$date[1],$date[2],$date[0]));
		}
	}
	
	
	/* format time for attedance */
	public function format_cktime($date){
		if(!empty($date)){
			$date =  split("[-: ]", $date);
			return date('Y-m-d',mktime($date[3],$date[4],$date[5],$date[1],$date[2],$date[0]));
		}
	}

	/* function to format the date to save */
	public function format_date_save($date){
		if(!empty($date)){
			$exp_date = explode('/', $date); 
			return $exp_date[2].'-'.$exp_date[1].'-'.$exp_date[0];
		}
	}
	
		/* function to format the month to save */
	public function format_month_save($date){
		if(!empty($date)){
			$exp_date = explode('/', $date); 
			return $exp_date[1].'-'.$exp_date[0].'-1';
		}
	}
	
	/* function to format the date to save */
	public function format_date_time_save($date){ 
		$split_date =  split("[/: ]", $date); 
		return $split_date[2].'-'.$split_date[1].'-'.$split_date[0].' '.$split_date[3].':'.$split_date[4];
	}
	
	/* function to format the date to show */
	public function format_date_time_show($date){ 
		if(!empty($date) && $date!= '0000-00-00' && $date!= '0000-00-00 00:00:00'){
			$split_date =  split("[-: ]", $date); 
			return $split_date[2].'/'.$split_date[1].'/'.$split_date[0].' '.$split_date[3].':'.$split_date[4];
		}
	}
	
	/* function to format the date to save */
	public function format_date_search($date){ 
		$exp_date = explode('/', $date); 
		return $exp_date[1].'-'.$exp_date[0];
	}
	
	/* function to format the time to save */
	public function format_time_save($time){
		if(!empty($time)){
			$exp_time = explode(' ', $time);
			$time = '2014-03-29 '.$exp_time[0].':00 '.$exp_time[1];
			return date('H:i', strtotime($time));
		}
	}
	
	public function format_time_show($time){
		if(!empty($time)){
			$time = '2014-03-29 '.$time;
			$time =  split("[-: ]", $time);
			return date('h:i A',mktime($time[3],$time[4],$time[5],$time[1],$time[2],$time[0]));
		}
	}
	
	/* function to format the date to show */
	public function format_date_show($date){ 
		$exp_date = explode('-', $date);
		return $exp_date[2].'/'.$exp_date[1].'/'.$exp_date[0];
	}
	
	/* function to format the month to show */
	public function format_month_show($date){ 
		$exp_date = explode('-', $date);
		return $exp_date[1].'/'.$exp_date[0];
	}
	
	
	public function get_search_status(){ 
		return $status = array('W' => 'Pending', 'A' => 'Approved', 'R' => 'Rejected');
	}
	
	public function get_pay_status(){ 
		return $status = array('P' => 'Pending', 'PP' => 'Partial Paid', 'FP' => 'Paid');
	}
	
	 /* function to format the data for drop down */	
	function format_dropdown($list,$model, $id, $label1, $label2){ 
		foreach($list as $key => $value){ 
			$data_list[$value[$model][$id]] = $value[$model][$label1].' '.$value[$model][$label2] ;		
		}	
		return $data_list;
	}

    /* function to load the exp. drop down */
	public function load_Experience($filter){		
		for($i = 0; $i <= 40; $i++){
			if($i == 0 && !$filter){				
				$exp[$i] = 'Fresher';
			}else{
				$exp[$i] = $i;
			}
		}
		return $exp;
	}
	
	
	
	/* function to load the exp. drop down */
	public function load_salary(){	
		$sal = array('10000' => '10000', '20000' => '20000', '30000' => '30000', '40000' => '40000', '50000' => '50000', '60000' => '60000', '70000' => '70000', '80000' => '80000','90000' => '90000', '100000' => '100000');		
		return $sal;
	}
	
	
	/* func tion to show the show date with time */
	public function get_current_date(){
		return date('Y-m-d H:i:s');
	}
	
	/* function to decrypt */
	function decrypt($cypher) {
		$cypher =str_replace('%20','+',str_replace(' ','+',$cypher));			
		return trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, Configure::read('Security.key'), base64_decode($cypher), MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND)));
    }
	
	
	/* function to encrypt */
	 function encrypt($plain) {	
        return trim(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, Configure::read('Security.key'), $plain, MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND))));
    }
	
		
	/* function to add dates */
	function add_date($no){
		return $date = date(date('Y-m-d', mktime(date('H'), date('i'), date('s'), date("m") , date("d")+$no, date("Y"))));
	}
	
	/* function to subtract dates */
	function sub_date($no){
		return $date = date(date('Y-m-d', mktime(date('H'), date('i'), date('s'), date("m") , date("d")-$no, date("Y"))));
	}
	
	/* function to show the expiry date */
	function get_expiry_date(){
		return $date = date(date('Y-m-d', mktime(date('H'), date('i'), date('s'),date("m") , date("d")+30, date("Y"))));
	}
	
	/* function to format the drop down  */
	public function format_list($data, $model,$field){
		foreach($data as $record){
			$format_list[] =  $record[$model][$field];
		}
		return $format_list;
	}
	
	/* function to get the formatted id */
	public function get_format_id($enc_id){
		return str_replace(array('%20','/','+','='), array('','','','',), $enc_id);
	}
	
	/* function to get the formatted id */
	public function replace_dollar($enc_id){
		return str_replace('$', '/', $enc_id);
	}
	
	/* function to calculate the profile percentage */
	public function calculate_profile_percent($data){
	//echo '<pre>';
	//print_r($data);
		$fill = 0; $unfill = 0; $count = 0;
		foreach($data as $key => $value){
			if($value != NULL){
				$fill += 1;
			}else{
				$unfill += 1;
			}
			// increment the value
			$count += 1;
		}
		//echo $fill; echo "<br>"; echo $unfill;
		return $percent = round(($fill/$count)*100);
		
	}
	
	/* function to show the job status */
	public function get_job_status(){
		return $status = array('1' => 'Active', '0' => 'Inactive', '2' => 'Expired'); 
	}
	
	/* function to get the no. of records */
	public function get_rec_options(){
		return $rec = array('5' => '5', '10' => '10','15' => '15','20' => '20','25' => '25');
	}
	
	/* function to show the default paging rec. */
	public function get_rec_default($no_rec){
		return $no_rec ? $no_rec : 10;
	}
	
	/* function to format the date in search */
	public function format_search_date($date){ 
		$exp_date = explode('/', $date);
		return $exp_date[2].'-'.$exp_date[1].'-'.$exp_date[0];
	}
	
	 /* function to load the exp. drop down */
	public function load_age($filter){		
		for($i = 18; $i <= 60; $i++){	
			$age[$i] = $i;			
		}
		return $age;
	}
	
	/* function to get the exp. key list */
	public function get_key_label($res){
		if($res == 0){
			$res = 0;
		}else if($res == 1 || $res == 2){
			$res = 1;
		}
		else if($res >= 3  &&  $res <= 5){
			$res = 2;
		}
		else if($res >= 5  &&  $res <= 8){
			$res = 3;
		}
		else if($res >= 9  &&  $res <= 14){
			$res = 4;
		}
		else if($res >= 15  &&  $res <= 50){
			$res = 5;
		}
		return $res;
	}
	
	/* function to get the start date of the week */
	public function week_date($day){
		$prior_week = date('W') - 1;
		if($prior_week == 0){
			$prior_week = 52;
			$year = date('Y') - 1;
		}else{
			$year = date('Y');
		}
		return date("Y-m-d", strtotime($year.'W'.$prior_week.$day));
	}
	
	/* function to get the start date of the week */
	public function month_date($day){		
		return date("Y-m-$day");
	}
	
	/* function to format the login time */
	public function format_log_date($date){
		if(!empty($date)){
			$date =  split("[-: ]", $date);
			return date('d.m.Y',mktime($date[3],$date[4],$date[5],$date[1],$date[2],$date[0]));
		}
	}
	
	/* function to format the login time */
	public function get_time($date){
		if(!empty($date)){
			$date =  split("[-: ]", $date);
			return date('h:i A',mktime($date[3],$date[4],$date[5],$date[1],$date[2],$date[0]));
		}
	}
	
	/* function to calculate age */
	public function get_age($dob){
		return floor((time() - strtotime($dob))/31556926);
	}
	
	/* function to check the experience */
	public function check_exp($exp){
		if(empty($exp)){
			$exp = 0;
		}
		else{
			$exp = $exp;
		}
		return $exp .' Years';
	}

	/* upload file */
	public function upload_file($src, $dest){
		if(!copy($src, $dest)){
			return false;
		}
		return true;
	}
	
	/* function to format the att. data */
	public function format_in_att_data($data, $no_days, $sel_year, $sel_month){
		// parse the data in the array
		foreach($data as $att){						
			$in[] = date('Y-m-d', strtotime($att['HrAttendance']['in_time']));
			$in_time[] = date('h:i A', strtotime($att['HrAttendance']['in_time']));			
		}	
		
			
		// fill the data with values
		for($i = 1; $i <= $no_days; $i++){		
			$date_value = $sel_year.'-'.$sel_month.'-'.date('d', strtotime($sel_year.'-'.$sel_month.'-'.$i));
			$key = array_search($date_value, $in);
			if($key ===  false){
				$in_data[$i] = '';						
			}else{
				$in_data[$i] = $in_time[$key];				
			}
		}
	
		
		return $in_data;
		
	}
	
	/* function to check leaves for attendance */
	public function check_leave_taken($date, $month, $year, $in_time, $leaves, $holidays, $happy){	
		// iterate for matching
		$continue = true;	
		$leave_type = '';		
		foreach($leaves as $leave_rec){
			if($continue){				
				$expl_from = explode('-', $leave_rec['l']['leave_from']);
				$expl_to = explode('-', $leave_rec['l']['leave_to']);
				// if from and to are same month				
				if($month == $expl_from[1]){
					if($date >= $expl_from[2] && $date <= $expl_to[2]){
						$leave_type =  $leave_rec['t']['desc'];
						$continue = false;
					}
				}else if($date <= $expl_to[2]){ 
					$leave_type =   $leave_rec['t']['desc'];
					$continue = false;
				}				
			}
		}
		
		// check holidays & happy leave
		if(empty($in_time) && empty($leave_type)){		
			// check holidays
			$key = array_search($year.'-'.$month.'-'.$date, $holidays);
			if($key !==  false){				
				$leave_type = $key;
			}			
			// check sat or sunday
			if(empty($leave_type)){
				// get the first day		
				$day = date('N', strtotime($year.'-'.$month.'-01'));
				$sat_cond = $this->check_saturday($day, $date);
				// check sunday
				$day = date('N', strtotime($year.'-'.$month.'-'.$date));
				$sun_cond =  $this->check_sunday($day);
				if(!empty($sat_cond) || !empty($sun_cond)){
					$leave_type = $sat_cond ? $sat_cond : $sun_cond;
				}
			}
			
			// check happy leave
			if(empty($leave_type)){
				$dob_exp = explode('-', $happy[0]);
				$wedding_exp = explode('-', $happy[1]);
				if($date.$month == $dob_exp[2].$dob_exp[1]){
					$leave_type = 'Happy Leave';
				}
				if($date.$month == $wedding_exp[2].$dob_exp[1]){
					$leave_type = 'Happy Leave';
				}
			}
		}
		
		if($leave_type){
			$color = $this->set_leave_color($leave_type);
			return "<span class='$color'>$leave_type</span>";
		}
		
	}
	
	/* function to set leave color */
	public function set_leave_color($leave_type){
		switch($leave_type){
			case 'Privilege Leave':
			$color = 'green-txt';
			break;
			case 'Loss of Pay':
			$color = 'red-txt';
			break;
			case 'Comp. Off':
			$color = 'brown-txt';
			break;
			case 'Maternity Leave':
			$color = 'rose-txt';
			break;
			case 'On Duty':
			$color = 'violet-txt';
			break;
			case 'Need Based Leave':
			$color = 'blue-txt';
			break;
			case 'Paternity Leave':
			$color = 'pink-txt';
			break;		
			default:
			$color = 'weekoff-txt';
			break;		
			
		}
		return $color;
		
	}
	
	/* check the given day is second / forth sat */
	public function check_sunday($day){
		if($day == '7'){
			return 'Weekly Off';
		}		
	}
	
	
	/* function to calculate late timings 
	public function check_late($in_time, $actual_in, $type, $perm_data, $date, $no_grace){
		$time = $in_time ? '2014-11-21 '.$in_time.':00' : '2014-11-21 09:30:00';	
		$actual_time =  '2014-11-21 '.$actual_in.':00';
		if(array_key_exists($date, $perm_data)){
			$time = '2014-11-21 '.$no_grace.':00';
			$per_val = explode(':', $perm_data[$date]);
			$per_hr = $per_val[0];
			$per_min2 = ($per_hr == '01' ? '60' : ($per_hr == '02' ? '120' : '0'));
			$per_min = $per_val[1];
			$new_time = strtotime($time);
			// add minutes
			$new_time += 60 * $per_min;
			// add mins. in the hour.
			$new_time += 60 * $per_min2;				
			$time = '2014-11-21 '.date('H:i', $new_time);
		}
		if($type == 'user' && strtotime($actual_time) > strtotime($time)){			
			return $diff = $this->diff_time($actual_time, $time);
		}else if(strtotime($actual_time) > strtotime($time)){
			return $diff = $this->time_diff_late($actual_time, $time);
		}
	}	
	*/
	
	/* function to calculate late timings */
	public function check_late($in_time, $actual_in, $type, $perm_data, $date, $no_grace){ 		
		$time = $in_time ? '2014-11-21 '.$in_time.':00' : '2014-11-21 09:30:00';	
		$actual_time =  '2014-11-21 '.$actual_in.':00';
		// July 2015 late hr. policy change		
		if(strtotime($date) >= strtotime('2015-07-01')){
			if(strtotime($actual_time) > strtotime($time)){
				$time = '2014-11-21 '.$no_grace.':00';
			}
		}
		// check for permission taken on that day
		if(array_key_exists($date, $perm_data)){
			$time = '2014-11-21 '.$no_grace.':00';
			$per_val = explode(':', $perm_data[$date]);
			$per_hr = $per_val[0];
			$per_min2 = ($per_hr == '01' ? '60' : ($per_hr == '02' ? '120' : '0'));
			$per_min = $per_val[1];
			$new_time = strtotime($time);
			// add minutes
			$new_time += 60 * $per_min;
			// add mins. in the hour.
			$new_time += 60 * $per_min2;				
			$time = '2014-11-21 '.date('H:i', $new_time);
		}		
		if($type == 'user' && strtotime($actual_time) > strtotime($time)){			
			$diff = $this->diff_time($actual_time, $time);
		}else if(strtotime($actual_time) > strtotime($time)){
			$diff = $this->time_diff_late($actual_time, $time);
		}
		
		return $diff;
	}
		/* check the given day is second / forth sat */
	public function check_saturday($first_day, $cur_day){
		$first_sat = $this->get_first_sat($first_day);
		$second_sat = $first_sat  + 7;
		$third_sat = $second_sat + 7;
		$forth_sat = $third_sat + 7;
		if($cur_day == $second_sat || $cur_day == $forth_sat){ 
			return 'Weekly Off';
		}
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
	
	/* function to find the time of event */
	public function time_diff_late($time1, $time2){ 		
		$s = abs(strtotime($time2) - strtotime($time1));		   
		$m = (int)($s/60); 
		$hr = (int)($m/60); 
		return $m;
		
   }
	
	/* function to find diff. b/w the time */
	public function diff_time($time1, $time2){ 
		$s = abs(strtotime($time2) - strtotime($time1));
		   
		if($s > 59){ 
			$m = (int)($s/60); 
			$s = $s-($m*60); // sec left over 
			
			if($m > 1) { $m = $m.' mins';}else{$m = $m.' min'; }
		} 
		if($m > 59){ 
			$hr = (int)($m/60); 
			$m = $m-($hr*60); // min left over 
			if($m > 1) { $m = $m.' mins';}
			
			if($hr > 1){ $hr = $hr.' hrs';}else{ $hr = $hr.' hr'; } 
 
			
		} 
		
		return $hr.' '.$m = $m > 0 ? $m : '';
	}
	
	/* function to show adv. id */
	public function get_adv_id($id){
		return  str_pad($id, 3, 0, STR_PAD_LEFT);		
	}
	
	/* print money format */
	public function money_display($amount){			
		return  number_format($amount);
	}
	
	/* function to get the business type */
	public function get_biz_type($type){
		switch($type){
			case 'N':
			$msg = 'New';
			break;
			case 'E':
			$msg = 'Existing';
			break;
			case 'O':
			$msg = 'Old';
			break;
		}
		return $msg;
	}
	
	
	
}
?>