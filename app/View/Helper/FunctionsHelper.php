<?php
class FunctionsHelper extends AppHelper {
	
	public $helpers = array('Session');
	
    public function __construct(View $view, $settings = array()) {
        parent::__construct($view, $settings);
        debug($settings);
    }
	
	/* show task time in formatted */
	public function show_task_time($date, $type, $field, $model){
		if(empty($date)){
			$date = $this->request->data[$model][$field];
			$type = $this->request->data[$model]['type'];
		}	
		if($type == 'D'){
			return date('h:i A', strtotime($date));
		}else{
			return date('d/m/Y', strtotime($date));
		}
	}
	
	/* function to show year of passing */
	public function show_year($year){
		if($year != '0000'){
			return $year;
		}
	}
	
	/* function to check field has value */
	public function check_chart_value($value){
		if(intval($value)){
			return $value;
		}else{
			return 0;
		}
	}
	
	/* function to format the date to save */
	public function format_date_save($date){
		if(!empty($date)){
			$exp_date = explode('/', $date); 
			return $exp_date[2].'-'.$exp_date[1].'-'.$exp_date[0];
		}
	}
	
	/* function to check max. percent in graph */
	public function check_max_percent($percent){
		if($percent > 100){
			return 100;
		}else if($percent < 0){
			return 0;
		}else{
			return $percent;
		}
	}
	
	/* function to check max. planned hr */	
	public function check_max_planned($hr){
		if($hr < 0){
			return 0;
		}else{
			return $hr;
		}
	}
	
	/* function to show travel type */
	public function get_travel_type($type){
		return $type == 1 ? 'One Way' : 'Round Trip';		
	}
	
	/* function to show travel type */
	public function get_att_punch_type($type){
		return $type == 'B' ? 'Biometric' : 'Online';		
	}
	
	/* function to show bio icon */
	public function show_bio_icon($time){
		return $time ? 'icon-hand-down' : 'icon-circle-arrow-down';
	}
	
	/* function to show bio title */
	public function show_bio_title($time){
		return $time ? 'Biometric' : 'Online';
	}
	
	/* function to calculate the late att. */
	public function calculate_late($data, $type, $is_early){ 
		if($type == 'in'){
			$field = 'start_time';
			$act_field = 'act_in_time';
			$actual_time = $data['ot'][$field] ? '2014-08-12 '.$data['ot'][$field] : '2014-08-12 09:30:00';
		}else{
			$field = 'end_time';
			$act_field = 'act_out_time';
			$actual_time = $data['ot'][$field] ? '2014-08-12 '.$data['ot'][$field] : '2014-08-12 18:30:00';
		}
		
		
		$time =  '2014-08-12 '.$data[0][$act_field];
		
		if($is_early == 'E'){ 
			// add one minute
			$actual_time = strtotime($actual_time);
			$actual_time += 60 * 1;
			return $diff = $this->diff_time($time, date('Y-m-d H:i:s', $actual_time));
		}if($is_early == 'E_IN'){		
			return $diff = $this->diff_time($time, $actual_time);
		}else{
			return $diff = $this->diff_time($actual_time, $time);
		}
	}
	
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
	
	
	/* function to get numeric date */
	public function get_numeric_date($date){
		if($date != ''){
			return date('j',strtotime($date));
		}
	}
	
	/* function to show tooltip for active / inactive files */
	public function get_file_tip($st){
		return $tooltip = $st == 1 ? 'Click to unshare the file' : 'Click to share the file';
	}
	
	/* function to check task edit link */
	public function show_task_link($start){ 
		$task_date = date('Y-m-d', strtotime($start));
		if($data['status'] == 'W' && strtotime($task_date) <= strtotime(date('Y-m-d'))){
			return true;
		}
	}
	
	/* function to get mail url */
	public function get_mail_url(){
		if(Configure::read('LOGIN_EMAIL') == 'yahoo'){
			$url = 'http://mail.career-tree.in';
		}elseif(Configure::read('LOGIN_EMAIL') == 'gmail'){
			$url = 'http://mail.google.com';
		}
		return $url;
	}
	
	/* check book via */
	public function get_book_via($val){ 
		switch($val){
			case 'CC':
			$option = 'Credit Card';
			break;
			case 'A':
			$option = 'Agent';
			break;
			case 'C':
			$option = 'Cash';
			break;			
		}
		return $option;
	}
	
	/* function to show the booking mode */
	public function get_book_mode($mode){
		switch($mode){
			case 'G':
			$option = 'General';
			break;
			case 'T':
			$option = 'Tatkal';
			break;
		}
		return $option;
	}
	
	/* function to enable task edit */
	public function check_task_edit($date){
		$task_date = date('Y-m-d', strtotime($date));
		if($this->request->params['controller'] == 'tskplan'){
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
	
	/* function to show the cc type */
	public function check_task_cc($cc){
		// check task is cc
		if($cc == 1){		
			return $type = " <span rel='tooltip'  title='Not assigned, just Cc' class='cc_task task_info label label-yellow' data-original-title='Not assigned, just Cc'>Cc</span>";			
		}
	}
	
	/* function to show the unread type */
	public function show_biz_read_status($id, $type, $created, $modified){ 
		$date = $modified ? $modified : $created;
		$date_for = date('d M Y h:i a', strtotime($date));
		// check task is cc
		if($type == 'N'){		
			return $type = " <span rel='tooltip'  title='New Business Created' class='bdRead u$id label label-orange'>New</span>";			
		}else if($type == 'R'){		
			return $type = " <span rel='tooltip'  title='Review Record Updated On $date_for' class='bdRead u$id label label-pink'>RR Added</span>";			
		}else if($type == 'M'){		
			return $type = " <span rel='tooltip'  title='Business Modified On $date_for' class='bdRead u$id label label-info'>Modified</span>";			
		}
	}
	
	
	
	/* function to set theme */
	public function set_theme($color){
		if(!empty($color)){
			return $color;
		}else{
			return 'blue';
		}
		
	}
	
	/* function to show the model class for tag */
	public function get_tag_class(){
		switch($this->request->params['controller']){
			case 'tskplan':
			$model = 'TskPlan';
			break;
			case 'tskteamplan':
			$model = 'TskPlanRead';
			break;
			case 'tskassign':
			$model = 'TskAssignRead';
			break;
			case 'tskteamassign':
			$model = 'TskTeamAssign';
			break;
		}
		return $model;
	}
	
	
	/* get task date */
	public function get_task_date($date){
		return date('j-F', strtotime($date));
	}
	
	/* function to check day options */
	public function check_day_plural($no){
		return $no > 1 ? 'days': 'day';
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
				if($date.$month == $wedding_exp[2].$wedding_exp[1]){
					$leave_type = 'Happy Leave';
				}
			}
		}
		
		
		if($leave_type){
			$color = $this->set_leave_color($leave_type);
			return "<span class='$color'>$leave_type</span>";
		}
		
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
	
	
	/* check the given day is second / forth sat */
	public function check_sunday($day){
	
		if($day == '7'){
			return 'Weekly Off';
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
			case 'Special Leave':
			$color = 'rose-txt';
			break;				
			default:
			$color = 'weekoff-txt';
			break;		
			
		}
		return $color;
		
	}
	
	/* function to get day of date */
	public function get_day($date){
		return date("l", strtotime($date));
	}
	
	/* function to show probation */
	public function show_probation($p){
		switch($p){
			case 'Y':
			$det = 'Probation';
			break;
			case 'C':
			$det = 'Confirmed';
			break;			
		}
		return $det;
	}
	
	/* function to enable scroll */
	public function show_scroll($data1, $data2, $data3, $length){
		if(!empty($data1)){
			$total = count($data1);
		}
		if(!empty($data2)){
			$total += count($data2);
		}
		if(!empty($data3)){
			$total += count($data3);
		}
		if($total > $length){
			return 'scrollable';
		}else{
			return 'no_scroll';
		}
	}
	
	/* function to show debit to client */
	public function debit_client($comp){
		if(!empty($comp)){
			return $comp;
		}else{
			return 'No';
		}
	}
	
	/* function to set the report class */
	public function set_report_cls($action){
		if($this->request->params['action'] == $action){
			$cls = 'active';
		}else if($this->request->params['action'] == $action){
			$cls = 'active';
		}else if($this->request->params['action'] == $action){
			$cls = 'active';
		}else if($this->request->params['action'] == $action){
			$cls = 'active';
		}else{
			$cls = '';
		}
		
		return $cls;
		
	}
	
	/* function to set the theme */
	public function get_event_theme($theme){
		switch($theme){
			case 'default':
			$theme = '';
			break;
			case 'sky_blue':
			$theme = 'cupertino';
			break;
			case 'light_orange':
			$theme = 'humanity';
			break;
			case 'grey':
			$theme = 'smoothness';
			break;
			case 'blue':
			$theme = 'ui-lightness';
			break;
		}
		
		return $theme;
	}
	
	/* function to show adv. id */
	public function get_adv_id($id){
		if(!empty($id)){
			return  str_pad($id, 3, 0, STR_PAD_LEFT);
		}
		
	}
	
	/* function to show travel id */
	public function get_tvl_id($id){
		return  'TVL'.str_pad($id, 3, 0, STR_PAD_LEFT);
	}
	
	
	
	/* function to show marital */
	public function marital_status($st){
		if($st == 1){
			return 'Single';
		}else if($st == 2){
			return 'Married';
		}
	}
	
	/* function to show travel mode icon */
	public function show_tvl_mode_icon($mode){
		$mode_icon = $mode == 'Bus' ? 'glyphicon-bus' : ($mode == 'Train' ? 'glyphicon-train' : 'icon-plane');
		$mode_color = $mode == 'Bus' ? 'pink' : ($mode == 'Train' ? 'green' : 'bluish');
		$mode_link = "<span class=btn><a href='javascript:void(0)' rel='tooltip' title = '".$mode."' class='".$mode_color."'><i class=".$mode_icon.'></i></a></span>';
		return $mode_link;

	}
	
	/* function to check registration confirm btn */
	public function check_reg_confirm($reg){
		if($reg['step1'] == '1' && $reg['step2'] == '1' && $reg['step3'] == '1' && $reg['step4'] == '1'){
			return true;
		}
	
	}
	
	/* function to get att. type */
	public function get_att_type($type){
		if($type == 'I'){
			return 'In Time';
		}else if($type == 'O'){
			return 'Out Time';
		}else if($type == 'B'){
			return 'Both';
		}
	}
	
	/* function to show attachment in share */
	public function show_attachment($file){
		if(!empty($file)){
			$lower_file = strtolower(strrchr($file, '.'));			
			// if image file
			if($lower_file == '.jpg' || $lower_file == '.gif' || $lower_file == '.png'  || $lower_file == '.jpeg'){
				return 'img';
			}else{
				return 'noimg';
			}
		}
	}
	
	/* function to get file status */
	public function get_file_status($st){
		if($st == 1){
			return 'Active';
		}else{
			return 'Inactive';
		}
	}
	
	public function get_status_color($st){
		if($st == 1){
			return 'green';
		}else{
			return 'red';
		}
	}
	
	
	
	
	
	/* function to check image */
	public function check_image($file){
		$file = strtolower(substr($file, strlen($file)-3, 3));			
		if($file == 'jpg' || $file == 'png' || $file == 'gif'){
			return true;
		}else{
			return false;
		}
	}
	
	
	/* function to check personalized msg or not */
	public function chk_personalized($user_id){
		if(!empty($user_id)){
			return '#F4D6BC';
		}else{
			return '#DDE4ED';
		}
	}
	
	/* function to get payslip gen. date */
	public function get_payslip_date($date){
		if(!empty($date)){			
			$date = $this->format_date($date);
			return $date;
		}else{
			return 'Generate Payslip';
		}
	}
	
	/* function to get payslip icon color */
	public function get_payslip_color($created){
		if(!empty($created)){
			return 'btn-green';
		}
	}
	
	
	
	/* function to get latest date */
	public function get_latest_date($created, $modified){
		if(!empty($modified)){
			$date = $modified;			
		}else{
			$date = $created;
		}
		return $date;
	}
	
	/* function to show file icon */
	public function get_file_icon($file){
		$type = strtolower(strrchr($file, '.'));
		switch($type){
			case '.doc':
			$icon = 'doc_file.png';
			break;
			case '.docx':
			$icon = 'doc_file.png';
			break;
			case '.zip':
			$icon = 'zip_file.png';
			break;
			case '.pdf':
			$icon = 'pdf_file.png';
			break;
			case '.xls':
			$icon = 'xls_file.png';
			break;
			case '.xlsx':
			$icon = 'xls_file.png';
			break;
			case '.ppsx':
			$icon = 'ppt_file.png';
			break;
			case '.png':
			$icon = 'png_file.png';
			break;
			case '.gif':
			$icon = 'gif_file.png';
			break;
			case '.jpg':
			$icon = 'jpg_file.png';
			break;
			
		}
		return $icon;
	}
	
	/* function to check half day leave */
	public function check_halfday($half){
		if($half == 'M'){
			$session = 'Morning';
		}else if($half == 'A'){
			$session = 'Afternoon';
		}else{
			$session = 'No';
		}
		
		return $session;
	}
	
	/* function to show days */
	public function check_days($data){
		if(!empty($data)){
			return $data.' days';
		}else{
			return $data;
		}
	}
	
	/* function to get dept. tag color */
	public function set_tag_color($id){
		switch($id){
			case '1':
			$color = 'badge-warning';
			break;
			case '2':
			$color = 'badge-success';
			break;
			case '3':
			$color = 'badge-danger';
			break;
			case '4':
			$color = 'badge-info';
			break;
			case '5':
			$color = '';
			break;
			case '6':
			$color = 'badge-yellow';
			break;
			case '7':
			$color = 'badge-purple';
			break;
			case '8':
			$color = 'badge-grey';
			break;
			case '9':
			$color = 'badge-pink';
			break;
			case '10':
			$color = 'badge-primary';
			break;
			case '11':
			$color = 'badge-rose';
			break;
			case '12':
			$color = 'badge-brown';
			break;
			case '13':
			$color = 'badge-blue';
			break;
			case '14':
			$color = 'badge-green';
			break;
			case '15':
			$color = 'badge-red';
			break;
		}
		return $color;
	}
	
	
	
	/* function to show the color code */
	function get_color($inc){
		switch($inc){
			case '1':
			$color = 'orange';
			break;
			case '2':
			$color = 'red';
			break;
			case '3':
			$color = 'blue';
			break;
			case '4':
			$color = 'grey';
			break;
			case '5':
			$color = 'green';
			break;
			case '6':
			$color = 'pink';
			break;
			case '7':
			$color = 'default';
			break;
		}
		return $color;
		
	}
	
	/* function to show the color code */
	function get_line_color($inc){
		switch($inc){
			case '1':
			$color = 'orange';
			break;
			case '2':
			$color = 'red';
			break;
			case '3':
			$color = 'blue';
			break;			
			case '4':
			$color = 'green';
			break;
			case '5':
			$color = 'pink';
			break;			
		}
		return $color;
		
	}
	
	/* function to enable the payment */
	public function show_pay($req, $tot){ 
		if(empty($tot)){
			return true;
		}elseif($req > $tot){
			return true;
		}else if($req == $tot){
			return false;
		}
		
	}
	
	/* function to show payment mode */
	public function pay_mode($mode){
		switch($mode){
			case 'CA':
			$desc = 'Cash';
			break;
			case 'CK':
			$desc = 'Cheque';
			break;
			case 'OT':
			$desc = 'Online Transfer';
			break;	
			case 'ADJ':
			$desc = 'Adjust to Advance';
			break;	
		}
		return $desc;
		
	}
	
	/* function to check discrepancy */
	public function check_discrepancy($val){ 
		if($val == 'discrepancy'){
			return 'Discrepancy';
		}else if($val == 'draft'){
			return 'Draft';
		}else{
			return 'Expense';
		}
	}
	
	/* function to show verify icon */
	public function show_verify_icon($st){
		if($st == 'pass'){			
			$icon = 'icon-check-empty';
		}
		else{			
			$icon = 'icon-check';
		}
		return $icon;
	}
	
	/* function to show verify title */
	public function show_verify_title($st){
		if($st == 'pass'){
			$title = 'Verify';			
		}
		else{
			$title = 'Verified';			
		}
		return $title;
	}
	
	/* function to show verify title */
	public function show_tkt_verify_title($st){
		if($st == 'pass'){
			$title = 'Book Ticket';			
		}
		else{
			$title = 'Booked';			
		}
		return $title;
	}
	
	/* function to show verify title */
	public function show_tkt_cancel_title($st){
		if($st == 'pass'){
			$title = 'Cancel Ticket';			
		}
		else{
			$title = 'Cancelled';			
		}
		return $title;
	}
	
	
	
	/* function to get item status */
	public function get_item_status($st){
		switch($st){
			case '1':
			$status = '';
			break;
			case '0':
			$status = 'selected';
			break;
		}
		return $status;
		
	}
	
	/* function to get flag status */
	public function get_flag_status($st){
		switch($st){
			case '1':
			$flag = 'green';
			break;
			default:
			$flag = 'grey';
			break;
		}
		return $flag;
		
	}
	
	/* function to find the time of event */
	public function time_diff($date, $ago_str=1, $show_date){ 		
		$s = time() - strtotime($date);
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
		
		if($d > 30){		
			$m = (int)($d/30);
			$td = "$m month"; if($m>1) $td .= "s"; 
			
		} 
		if($ago_str == 1){
			$td .= ($td=="now")? "":" ago"; // in this example "ago" 
		}
		// show the date
		if($d > 1 && $show_date == '1'){
			return date('jS M, Y', strtotime($date));
		}
		if(trim($td) == 'ago')	return '1 sec ago';
		
		return $td;
		
   }
   
   
   /* function to find the time of event */
	public function time_diff_late($time1, $time2){ 		
		$s = abs(strtotime($time2) - strtotime($time1));		   
		$m = (int)($s/60); 
		$hr = (int)($m/60); 
		return $m;
		
   }
   
   /* parse the status of the request */
   public function format_status($st,$st_created,$st_user, $st_modified){
	$exp_status = explode(',', $st);
	$exp_created = explode(',', $st_created);
	$exp_modified = explode(',', $st_modified);
	$exp_user = explode(',', $st_user);
	$time1 = strtotime($exp_created[0]); 
	$time2 = strtotime($exp_created[1]);
	// reverse the array if value comes wrong in group concat
	if(!empty($time1) && !empty($time2)){
		if($time1 > $time2){ 
			$exp_status = array_reverse($exp_status);
			$exp_created = array_reverse($exp_created);
			$exp_user = array_reverse($exp_user);
			$exp_modified = array_reverse($exp_modified);
			
			
		}
	}	
	
	foreach($exp_status as $key => $status){
		// if status is not empty
		if(!empty($status)){
			$st_color = ($status == 'A' ? 'label-satgreen' : ($status == 'R' ? 'label-lightred' : ''));
			if(!empty($exp_created[$key])){$comma = ', ';}else{$comma = '';}
			$status = $status == 'W' ? 'P': $status;
			$show_detail = ($status == 'P' ? ' (Pending)' : ($status == 'A' ? " (Approved)<br> ". $this->format_date($exp_modified[$key]) : " (Rejected)<br> ". $this->format_date($exp_modified[$key])));
			$st_label .= "<span class='label $st_color'><a href='#' rel='tooltip' data-original-title = '".$exp_user[$key].$comma.$show_detail."'>L".++$key.' - '.$status.'</a></span>';
		}
	}
	return $st_label;
	
   }
   
   /* function to check the status */
   public function check_status($st){
		return $st == '1' ? 'Yes' : 'No';
   }
   
   
    /* show the status of the finance */
   public function get_fin_status($status,$st_user,$st_created){ 	
	$st_color = ($status == 'A' ? 'label-satgreen' : ($status == 'R' ? 'label-lightred' : ''));
	if(!empty($st_created)){$comma = ', ';}else{$comma = '';}
	$details = $status == 'W' ? 'Finance (Pending)' : $st_user.$comma.$this->format_date($st_created);
	$status = $status == 'W' ? 'P': $status;
	$st_label .= "<span class='label $st_color'><a href='#' rel='tooltip' data-original-title = '".$details."'>FIN".' - '.$status.'</a></span>';
	
	return $st_label;
	
   }
   
    /* show the status of the director */
   public function get_admin_status($status,$st_created, $st_user){
	if(!empty($status)){
		$st_color = ($status == 'A' ? 'label-satgreen' : ($status == 'R' ? 'label-lightred' : ''));
		$details = $status == 'W' ? '' : $this->format_date($st_created);
		$details = $st_user ? $details.'<br>'.$st_user : $details;
		$status_show = $status == 'W' ? 'Pending': ($status == 'R' ? 'Rejected' : 'Approved');
		$st_label .= "<span class='label $st_color'><a href='#' rel='tooltip' data-original-title = '".$details."'>".$status_show.'</a></span>';	
		return $st_label;
		}	
   }
   
    /* show the status of the director */
   public function get_bd_admin_status($status,$st_created, $st_user){
	if(!empty($status) && $status != 'S'){
		$st_color = ($status == 'A' ? 'label-satgreen' : ($status == 'R' ? 'label-lightred' : ''));
		$details = $status == 'W' ? 'Awaiting BD Admin Approval' : $this->format_date($st_created);
		$details = $st_user ? $details.'<br>'.$st_user : $details;
		$status_show = $status == 'W' ? 'Pending': ($status == 'R' ? 'Rejected' : 'Approved');
		$st_label .= "<span class='label $st_color'><a href='#' rel='tooltip' data-original-title = '".$details."'>".$status_show.'</a></span>';	
		return $st_label;
		}	
   }
   
    /* show the status of the finance */
   public function get_hr_status($status,$st_created, $st_user){ 	
	$st_color = ($status == 'A' ? 'label-satgreen' : ($status == 'R' ? 'label-lightred' : ''));
	if(!empty($st_created)){$comma = ', ';}else{$comma = '';}
	$details = $status == 'W' ? 'HR (Pending)' : $st_user.$comma.$this->format_date($st_created);
	$status = $status == 'W' ? 'P': $status;
	$st_label .= "<span class='label $st_color'><a href='#' rel='tooltip' data-original-title = '".$details."'>HR".' - '.$status.'</a></span>';
	
	return $st_label;
	
   }

   /* function to print the company type */
	function company_type($type){
		switch($type){
			case 'C':
			$type = 'Client';
			break;
			case 'V':
			$type = 'Vendor';
			break;
			case 'CO':
			$type = 'Consultant';
			break;
			case 'G':
			$type = 'Government';
			break;
			case 'I':
			$type = 'Internal';
		}
		return $type;
		
	}
	

	 /* function to print the company type */
	function project_status($st){
		switch($st){
			case 'PR':
			$status = 'Proposed';
			$st_color = 'btn btn-blue';
			break;
			case 'IP':
			$status = 'In Planning';
			$st_color = 'btn btn-orange';
			break;
			case 'IPG':
			$status = 'In Progress';
			$st_color = 'btn btn-green';
			break;
			case 'OH':
			$status = 'On Hold';
			$st_color = 'btn btn-lightgrey';
			break;
			case 'CO':
			$st_color = 'btn btn-satblue';			
			$status = 'Complete';
			break;
			case 'AR':
			$st_color = 'btn btn-grey';			
			$status = 'Archieved';
			break;
		}
		
		$st_label .= "<span class='label $st_color'><a href='#' rel='tooltip' data-original-title = '".$status."'>".$status.'</a></span>';
		
		return $st_label;
		
	}
	
	/* function to show standard */
	public function get_standard($i){
		if($i == '1'){
			return '10th';
		}else if($i == '2'){
			return '12th';
		}else if($i == '3'){
			return 'Diploma/ITI';
		}else if($i == '4'){
			return 'UG';
		}else if($i == '5'){
			return 'PG';
		}
	}
	
	/* function to get total exp */
	public function get_total_exp($exp){
		$exps = explode('.', $exp);
		if(!empty($exps[1])){
			$exp = $exps[1].' Month(s)';
		}else{
			$exp = $exps[0].' Year(s)';
		}		
		return $exp;
		
	}
	
	/* function to get family relation */
	public function get_family_relation($rel){
		switch($rel){
			case 'F':
			$relation = 'Father';
			break;
			case 'M':
			$relation = 'Mother';
			break;
			case 'G':
			$relation = 'Guardian';
			break;
			case 'SP':
			$relation = 'Spouse';
			break;
			case 'B':
			$relation = 'Brother';
			break;
			case 'S':
			$relation = 'Sister';
			break;
			
		}
		return $relation;
	}
	
	/* function to show the course type */
	public function show_course_type($type){
		if($type == 'F'){
			return 'Full time';
		}else if($type == 'P'){
			return 'Executive';
		}else if($type == 'C'){
			return 'Correspondance';
		}
	}
	
	/* print money format */
	public function money_display($amount){			
		return  number_format($amount);
	}
	/* function to show the school board */
	public function show_board($bd){
		if($bd == 'S'){
			return 'State Board';
		}else if($bd == 'C'){
			return 'CBSE';
		}else if($bd == 'I'){
			return 'ICSE';
		}else if($bd == 'M'){
			return 'Matriculation';
		}else if($bd == 'A'){
			return 'Anglo Indian';
		}
	}
	
	/* function to show the reg. steps active */
	public function get_reg_active($tab){ 
		if($tab == $this->request->params['pass'][0]){
			return 'active';
		}
	}
	
	/* function to format the date to show */
	public function format_date_show($date){ 
		if(!empty($date) && $date!= '0000-00-00' && $date!= '0000-00-00 00:00:00'){
			$exp_date = explode('-', $date);
			return $exp_date[2].'/'.$exp_date[1].'/'.$exp_date[0];
		}
	}
	
	/* function to format the date to show */
	public function format_date_time_show($date){ 
		if(!empty($date) && $date!= '0000-00-00' && $date!= '0000-00-00 00:00:00'){
			$exp_date =  split("[-: ]", $date);
			return $exp_date[0].'-'.$exp_date[1].'-'.$exp_date[2];
		}
	}

	
	 /* parse the status of the request */
   public function show_status($st){	
		if(intval($st)){
			$st_color = ($st == '1' ? 'label-satgreen' : ($st == '0' ? 'label-lightred' : ''));
			$st_value = $st == '1' ? 'Active' : 'Inactive';
		}else{
			$st_color = ($st == 'A' ? 'label-satgreen' : ($st == 'R' ? 'label-lightred' : ''));
			$st_value = $st == 'A' ? 'Active' : 'Inactive';
		}
		$st_label .= "<span class='label $st_color'><a href='#' rel='tooltip' data-original-title = '".$st_value."'>".$st_value.'</a></span>';
		return $st_label;
	
   }
   
   	 /* parse the status of the survey request */
   public function show_survey_status($st,$end){
		if(strtotime($end) < strtotime(date('Y-m-d'))){
			$st_value = 'Expired';
			$st_color = 'label-lightgrey';
		}else if(intval($st)){
			$st_color = ($st == '1' ? 'label-satgreen' : ($st == '0' ? 'label-lightred' : ''));
			$st_value = $st == '1' ? 'Active' : 'Inactive';
		}else{
			$st_color = ($st == 'A' ? 'label-satgreen' : ($st == 'R' ? 'label-lightred' : ''));
			$st_value = $st == 'A' ? 'Active' : 'Inactive';
		}
		
		$st_label .= "<span class='label $st_color'><a href='#' rel='tooltip' data-original-title = '".$st_value."'>".$st_value.'</a></span>';
		return $st_label;
	
   }
   
    /* parse the status of the request */
   public function show_change_status($st){			
		$st_color = $st == 'C' ? 'label-satgreen' : 'label-lightred';
		$st_value = $st == 'C' ? 'Complete' : 'Pending';
		
		$st_label .= "<span class='label $st_color'><a href='#' rel='tooltip' data-original-title = '".$st_value."'>".$st_value.'</a></span>';
		return $st_label;
	
   }
   
   /* function show change req. type */
   public function change_req_type($type){
		switch($type){
			case 'PE':
			$label = 'Personal';
			break;
			case 'CT':
			$label = 'Contact';
			break;
			case 'PR':
			$label = 'Professional';
			break;
			case 'ED':
			$label = 'Education';
			break;
			case 'OT':
			$label = 'Miscellaneous';
			break;
		}
		return $label;
   }
   
   
 
   
   	 /* parse the status of the email send */
   public function show_email_status($date){
		
		$st_color = $date === NULL ? 'btn btn-red' : 'btn btn-satgreen';
		$st_tip = $date === NULL ? '' : $this->format_date($date);
		$st_value = $date === NULL ? 'Not Sent' : 'Sent';
		
		$st_label .= "<span class='label $st_color'><a href='#' rel='tooltip' data-original-title = '".$st_tip."'>".$st_value.'</a></span>';
		return $st_label;
	
   }
   
   	 /* parse the status of the expense pay */
   public function show_exppay_status($date){
		
		$st_color = $date === NULL ? 'btn btn-lightgrey' : 'btn btn-satgreen';
		$st_tip = $date === NULL ? '' : $this->format_date($date);
		$st_value = $date === NULL ? 'Not Paid' : 'Paid';
		
		$st_label .= "<span class='label $st_color'><a href='#' rel='tooltip' data-original-title = '".$st_tip."'>".$st_value.'</a></span>';
		return $st_label;
	
   }
   
   
   
    	 /* parse the status of the email send */
   public function show_pay_status($amt, $tot,$paid_amt, $paid_date){ 
		if(empty($tot)){
			$type = 'Not Paid';
		}else if($amt > $tot){
			$type = 'Partial';
		}else if($tot == $amt){
			$type = 'Paid';
		}else if($amt < $tot){
			$type = 'Overlimit';
		}
		
		if(empty($paid_amt)){$comma = '';}else{$comma = ', ';}
		$st_color = ($type == 'Not Paid' ? 'btn btn-lightgrey' : ($type == 'Paid' ? 	'btn btn-satgreen': 'btn btn-warning'));		
		$st_label .= "<span class='label $st_color'><a href='#' rel='tooltip' data-original-title = '".$paid_amt.$comma.$this->format_date($paid_date)."'>".$type.'</a></span>';
		return $st_label;
	
   }
   
   
   /* function to get the activity url */
   public function get_activity_url($mod){
		switch($mod){
			case 'advance':
			$url = 'finadvance/view_advance/';			
			break;	
			case 'expense':
			$url = 'finexpense/view_expense/';			
			break;
			case 'leave':
			$url = 'hrleave/view_leave/';			
			break;	
			case 'permission':
			$url = 'hrpermission/view_permission/';			
			break;			
		}
		return $url;
		
   }
	
	
	
	
	
	/* to show the formatted post date */
	public function posted_date($date){
		return date('d-M-Y');
	}
	
	/* to show the formatted post date */
	public function job_date($date){
		if(!empty($date)){
			$date =  split("[-: ]", $date);
			return date('d M',mktime($date[3],$date[4],$date[5],$date[1],$date[2],$date[0]));
		}
	}
	
	/* to show the gender */
	public function show_gender($gen){
		if($gen == 'F'){
			return 'Female';
		}else if($gen == 'M'){
			return 'Male';
		}else if($gen == 'B'){
			return 'Any';
		}
	}
	
	  /* function used to format the date */

	public function format_date($date){ 
		if(!empty($date) && $date!= '0000-00-00' && $date!= '0000-00-00 00:00:00'){
			$date =  split("[-: ]", $date);
			return date('d-M-Y',mktime($date[3],$date[4],$date[5],$date[1],$date[2],$date[0]));
		}
	}
	
	public function format_month($date){ 
		if(!empty($date) && $date!= '0000-00-00' && $date!= '0000-00-00 00:00:00'){
			$date =  split("[-: ]", $date);
			return date('M-Y',mktime($date[3],$date[4],$date[5],$date[1],$date[2],$date[0]));
		}
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
	
	/* function to format the att. data */
	public function format_out_att_data($data, $no_days, $sel_year, $sel_month){
		// parse the data in the array
		foreach($data as $att){						
			$out[] = date('Y-m-d', strtotime($att['HrAttendance']['out_time']));			
			$out_time[] = date('h:i A', strtotime($att['HrAttendance']['out_time']));
		}		
		// fill the data with values
		for($i = 1; $i <= $no_days; $i++){		
			$date_value = $sel_year.'-'.$sel_month.'-'.date('d', strtotime($sel_year.'-'.$sel_month.'-'.$i));
			$key = array_search($date_value, $out);
			if($key ===  false){				
				$out_data[$i] = '';		
			}else{				
				$out_data[$i] = $out_time[$key];
			}
		}		
		return $out_data;
		
	}
	
	
	/* function to format the att. data */
	public function format_att_status_data($data, $no_days, $sel_year, $sel_month){
		// parse the data in the array
		foreach($data as $att){						
			$out[] = date('Y-m-d', strtotime($att['HrAttendance']['in_time']));			
			$out_time[] = date('h:i A', strtotime($att['HrAttendance']['in_time']));
			$att_status[] = $att['HrAttendance']['status'];
		}		
		// fill the data with values
		for($i = 1; $i <= $no_days; $i++){		
			$date_value = $sel_year.'-'.$sel_month.'-'.date('d', strtotime($sel_year.'-'.$sel_month.'-'.$i));
			$key = array_search($date_value, $out);
			if($key ===  false){				
				$status_data[$i] = '';		
			}else{				
				$status_data[$i] = $att_status[$key];
			}
		}		
		return $status_data;
		
	}
	
	/* function to format the att. data */
	public function format_att_reason_data($data, $no_days, $sel_year, $sel_month){
		// parse the data in the array
		foreach($data as $att){						
			$out[] = date('Y-m-d', strtotime($att['HrAttendance']['in_time']));			
			$out_time[] = date('h:i A', strtotime($att['HrAttendance']['in_time']));
			$att_status[] = $att['HrAttendance']['reject_reason'];
		}	
		// fill the data with values
		for($i = 1; $i <= $no_days; $i++){		
			$date_value = $sel_year.'-'.$sel_month.'-'.date('d', strtotime($sel_year.'-'.$sel_month.'-'.$i));
			$key = array_search($date_value, $out);
			if($key ===  false){				
				$reason_data[$i] = '';		
			}else{				
				$reason_data[$i] = $att_status[$key];
			}
		}		
		return $reason_data;
		
	}
	
	public function format_att_waive_data($data, $no_days, $sel_year, $sel_month){
		// parse the data in the array
		foreach($data as $att){						
			$out[] = date('Y-m-d', strtotime($att['HrAttendance']['in_time']));			
			$waive_status[] = $att['HrAttendance']['waive_msg'];
		}	
		// fill the data with values
		for($i = 1; $i <= $no_days; $i++){		
			$date_value = $sel_year.'-'.$sel_month.'-'.date('d', strtotime($sel_year.'-'.$sel_month.'-'.$i));
			$key = array_search($date_value, $out);
			if($key ===  false){				
				$waive_data[$i] = '';		
			}else{				
				$waive_data[$i] = $waive_status[$key];
			}
		}		
		return $waive_data;
		
	}
	
	/* function to check attendance status */
	public function check_att_status($st){
		switch($st){
			case 'W':
			$cls = 'att_w';
			break;
			case 'A':
			$cls = 'att_a';
			break;
			case 'R':
			$cls = 'att_r';
			break;			
		}
		return $cls;
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
	
	
	public function format_time($date){
		if(!empty($date)){
			$date =  split("[-: ]", $date);
			return date('d-m-Y h:i:s a',mktime($date[3],$date[4],$date[5],$date[1],$date[2],$date[0]));
		}
	}
	
	public function format_time_show($time){
		if(!empty($time)){
			$time = '2014-03-29 '.$time;
			$time =  split("[-: ]", $time);
			return date('h:i A',mktime($time[3],$time[4],$time[5],$time[1],$time[2],$time[0]));
		}
	}
	
	/* format the task time show */
	public function format_tsk_time_show($time, $type){
		if(!empty($time)){		
			if($type == 'D'){
				return date('h:i A', strtotime($time));
			}else{
				return date('d-M-Y', strtotime($time));
			}
		}
	}
	
	/* function to display the hrs */
	public function display_hrs($hr){
		$time = explode(':', $hr);
		$hr = $time[0];
		$min = $time[1];
		
		return $hr.':'.$min;	
		
	}
	
	/* format time for attedance */
	public function format_attime($date){
		if(!empty($date)){
			$date =  split("[-: ]", $date);
			return date('h:i a',mktime($date[3],$date[4],$date[5],$date[1],$date[2],$date[0]));
		}
	}
	
	function getFileSize($file, $precision = 2) {		
		if (is_file($file)) { 
			//if (!realpath($file)) $file = $_SERVER['DOCUMENT_ROOT'] . $file;
			$fileSize = filesize($file);
			if($fileSize < 1024){
				$size = $fileSize.' Bytes';
			}else if ($fileSize < 1048576){
				$size = round($fileSize/1024, 2).' KB';
			}else if ($fileSize < 1073741824){
				$size = round($fileSize/1048576, 2).' MB';
			}
			
			// hardcoded maximum number of units @ 9 for minor speed increase
			return $size;
		}
		return false;
	}
	 
	 
	/* function to format the login time */
	public function format_log_date($date){
		if(!empty($date)){
			$date =  split("[-: ]", $date);
			return date('d.m.Y',mktime($date[3],$date[4],$date[5],$date[1],$date[2],$date[0]));
		}
	}
	
	/* function to format the diff. time */
	public function format_diff_time($date){
		if(!empty($date)){
			$date =  split("[-: ]", $date);
			return date('d, M y',mktime($date[3],$date[4],$date[5],$date[1],$date[2],$date[0]));
		}
	}
	
	
	/* function to format the login time */
	public function get_time($date){
		if(!empty($date)){
			$date =  split("[-: ]", $date);
			return date('h:i A',mktime($date[3],$date[4],$date[5],$date[1],$date[2],$date[0]));
		}
	}
	
	public function format_date_report($date){
		if(!empty($date)){
			$date =  split("[-: ]", $date);
			return date('F j',mktime($date[3],$date[4],$date[5],$date[1],$date[2],$date[0]));
		}
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
	
	
	/* show plan type */
	public function show_plan_type($type){
		if($this->request->params['controller'] == 'tskplan' || $this->request->params['controller'] == 'tskteamplan'){
			$txt = 'Task';
		}else{
			$txt = 'Task';
		}
		return  $type == 'D' ? 'Daily '.$txt : ($type == '' ? 'Daily '.$txt : 'Project '.$txt);
	}
	
	public function format_tsk_date($date){
		if(!empty($date)){
			$date =  split("[-: ]", $date);
			return date('d/m/Y',mktime($date[3],$date[4],$date[5],$date[1],$date[2],$date[0]));
		}
	}
	 
	  /* function used to format the date */
	public function show_last_login($date){
		if(!empty($date)){
			$date =  split("[-: ]", $date);
			return date('d M, h:i a',mktime($date[3],$date[4],$date[5],$date[1],$date[2],$date[0]));
		}
	 }
	 
	   /* function used to format the date and time */
	public function show_event_date($date){
		if(!empty($date) && $date!= '0000-00-00' && $date!= '0000-00-00 00:00:00'){
			$date =  split("[-: ]", $date);
			if($date[3] == '00'){
				return date('d M Y',mktime($date[3],$date[4],$date[5],$date[1],$date[2],$date[0]));
			}else{
				return date('d M Y h:i a',mktime($date[3],$date[4],$date[5],$date[1],$date[2],$date[0]));
			}
		}
	 }
	 
	 
	 /* match the fields in the auto complete search */
	function match_results($keyword, $value){
		//  matching the keyword with the result
		if(strncmp($keyword,strtolower(trim($value)),strlen($keyword)) == 0){
			return trim("$value\n");		
		}		
	 }
	 
	 /* function to show the experience */
	 function show_exp($min_exp, $max_exp){	 
		if(empty($min_exp) && empty($max_exp)){
			return 'Fresher';
		}else if($min_exp == $max_exp){
			$exp = $min_exp;
		}else if($min_exp != $max_exp){
			$exp = $min_exp .' - '. $max_exp;
		}
		
		if($exp == 1){
			$year = ' Year';
		}else{
			$year = ' Years';
		}	
			
		return $exp.$year;
		
	 }
	 
	 /* function to get the current date and time */
	 function get_cur_date(){
		return date('Y-m-d H:i:s');
	 }
	 
	 /* function to convert first letter caps */
	 function fcaps($str){ 
		return ucfirst($str);
	 }
	 
	 /* function to decrypt */
	function decrypt($cypher, $field, $order) {
		// get the cypher from the url
		if($field!=''){
			$explode_url = explode("&", $_SERVER['QUERY_STRING']);
			$order = $order - 1;
			$encrypt_id = explode($field.'=', $explode_url[$order]);
			$encrypt_id[1] = str_replace('%20','+',$encrypt_id[1]);
			$cypher = ($encrypt_id[1]);		
		}else{
			$cypher =str_replace('%20','+',str_replace(' ','+',$cypher));

		}
		return trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, Configure::read('Security.key'), base64_decode($cypher), MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND)));
    }
			
	/* function to encrypt */
	 function encrypt($plain) {	
        return trim(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, Configure::read('Security.key'), $plain, MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND))));
    }
	
	/* function to display the status */
	function record_status($status){
		switch($status){
			case '1':
			$status = 'Active';
			break;
			case '0':
			$status = 'Inactive';
			break;
		}
		return $status;
		
	}
	
	/* function to retain the check box of exp. in search */
	function retain_exp($key, $value){ 
		$exp_value = $split_key = explode(',', $key);
		$min_exp = $exp_value[0];
		$max_exp = $exp_value[1];
		if($value >= $min_exp && $value <= $max_exp){
			return 2;
		}	
	}
	
	/* function to get the formatted id */
	public function get_format_id($enc_id){
		return str_replace(array('%20','/','+','='), array('','','','',), $enc_id);
	}
	
	/* function to replace the slash */
	public function replace_slash($enc_id){
		return str_replace('/', '$', $enc_id);
	}
	
	/* function to check the search filters visibility */
	public function check_srchVisible($sort){
		if($sort == 1){
			return false;
		}
		
		return true;
		
	}
	
	/* function to check data exists or not */
	public function check_data($data){
		if(!empty($data)){
			return $data;
		}else{
			return '--';
		}
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
	
	/* function to calculate age */
	public function get_age($dob){
		return floor((time() - strtotime($dob))/31556926);
	}
	
	/* function to check is default profile */
	public function is_default_profile($is_d){
		return $is_d = ($is_d == 1) ? 'default' : '';
	}
	
	/* function to check is default profile */
	public function get_default_caption($is_d){
		return $is_d = ($is_d == 1) ? 'Default Profile' : 'Set as Default';
	}

	/* show the share / unshare */
	public function show_share($share){
		return $share ? 'Shared' : 'Not Shared';
	}

	/* function to show the title */
	public function is_draft(){
		return $this->request->query['items'] == 'draft' ? 'Draft' : '';
	}
	
	/* function to return the user status */
	public function get_user_status($status){
		switch($status){
			case '1':
			$st = 'active';
			break;
			case '0':
			$st = 'in-active';
			break;
		}
		return $st;
	}
	
	
	
	/* function to get the recent activity */
	public function get_activity($activity){		
		switch($activity){
			case 'advance':
			$label = 'New Advance Created';
			break;
			case 'expense':
			$label = 'New Expense Created';
			break;	
			case 'leave':
			$label = 'New Leave Created';
			break;
			case 'permission':
			$label = 'New Permission Created';
			break;
		}
		return $label;
	}
	
	
	
		/* function to get the recent activity */
	public function get_db_usage($value, $key){		
		switch($key){
			case 'profile_search':
			$label = 'Searches';
			break;
			case 'profile_views':
			$label = 'Profile Views';
			break;
			case 'profile_saves':
			$label = 'Profile Saves';
			break;
			case 'mail_sent':
			$label = 'Mail Sent';
			break;
			case 'jobs_posted':
			$label = 'Jobs Posted';
			break;
			case 'profile_downloads':
			$label = 'Profile downloads';
			break;
		}
		return $label.'$$'.$value;
	}
	
	/* function to calculate the percentages */
	public function cal_percentage($total, $used){
		$percent = ($used/$total)*100;
		return $percent = $percent.'%';
	}
	
	/* function to subtract dates */
	function sub_date($format,$no){
		return $date = date(date($format, mktime(date('H'), date('i'), date('s'), date("m") , date("d")-$no, date("Y"))));
	}
	
	/* show avail image in search results */	
	public function show_avail_img($avail){
		switch($avail){
			case 'Immediate':
			$st = 'immediate.png';
			break;
			case '7 Days':
			$st = '7days.png';
			break;
			case '15 Days':
			$st = '15days.png';
			break;
			case '1 Month':
			$st = '1month.png';
			break;
		}
		return $st;
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
	
	
	
	/* function to show the task status */
	public function show_lead_task_status($st,$modified,$created,$rec_status){ 
	
		// if user updated task 
		if(!empty($created)){
			if(strtotime($modified) > strtotime($created) &&  $st == 'R'){
				return $status = 'Pending';			
			}
		}else if(empty($created)  && $rec_status == 'W'){
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
	
		/* show status color */
	public function show_lead_task_status_color($st,$modified,$created){ 
		// if user updated task 
		if(strtotime($created) > strtotime($modified)  || $st == 'A'){
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
	
	/* function to set url for access privileges */
	public function access_url($perm, $url, $module, $rel, $cls, $static){ 
		$access = false;
		// execute if not super admin
		if(!$this->Session->read('EMPLOYER.CompanyUser.is_admin')){
			// iterate the permissions
			foreach($perm as $item){
				if($item){
					$access = true;
					break;
				}
			}
		}else{
			$access = true;
		}
		// If any access exists
		if($access == true){
			$url = $url;
			$css_cls = '';
			
			
		}else{
			$url = 'javascript:void(0)';
			$css_cls = 'denyPage';
			// remove css only for dynamic scripts class names
			if($static){
				 $cls = str_replace('iframe', ' ', $cls);
			}
			$rel = '';
		}
		$link = '<a href="'.$url.'"  class="'.$css_cls.' '.$cls.'" rel="'.$rel.'" title="'.$module.'">'.$module.'</a>';
		return $link;
	}
	
	
	/* function to check the single permission */
	public function mod_permission($permission){
		$user_type = $this->Session->read('EMPLOYER.CompanyUser.is_admin');		
		if($user_type == 1){	// check for super admin		
			return true;
		}else if($permission){ // check user has permissions
			return true;
		}else{
			return false;
		}
	}
	
		/* function to check the single permission */
	public function mod_multi_permission($permission){
		$user_type = $this->Session->read('EMPLOYER.CompanyUser.is_admin');		
		if($user_type == 1){	// check for super admin		
			return true;
		}
		// iterate go get multiple
		foreach($permission as $perm){ // check user has permissions
			if($perm){
				return true;
			}
		}
		
		return false;
	}
	
		/* function to check the single permission */
	public function mod_multi_perm_form($permission){
		$user_type = $this->Session->read('EMPLOYER.CompanyUser.is_admin');		
		if($user_type == 1){	// check for super admin		
			return;
		}
		// iterate go get multiple
		foreach($permission as $perm){ // check user has permissions
			if($perm){
				return;
			}
		}
		
		return 'denyPage';
	}
	
	/* order the payslip print fields */
	public function order_pay_fields($l1,$f1,$l2,$f2,$l3,$f3){
		if(!empty($f1)){
			$f[] = $l1.'-'.'Food Coupons Issued';
		}
		if(!empty($f2)){
			$f[] = $l2.'-'.'Income TDS on Salary';
		}
		if(!empty($f3)){
			$f[] = $l3.'-'.'Other Deduction';
		}
		
		
		return $f;
				
	}
	
	public function convert_number($number){
		if (($number < 0) || ($number > 999999999))
		{
		throw new Exception("Number is out of range");
		}
		 
		$Gn = floor($number / 100000);  /* Millions (giga) */
		$number -= $Gn * 100000;
		$kn = floor($number / 1000);     /* Thousands (kilo) */
		$number -= $kn * 1000;
		$Hn = floor($number / 100);      /* Hundreds (hecto) */
		$number -= $Hn * 100;
		$Dn = floor($number / 10);       /* Tens (deca) */
		$n = $number % 10;               /* Ones */
		 
		$res = "";
		 
		if ($Gn)
		{
		$res .= $this->convert_number($Gn) . " Lacs";
		}
		 
		if ($kn)
		{
		$res .= (empty($res) ? "" : " ") .
		$this->convert_number($kn) . " Thousand";
		}
		 
		if ($Hn)
		{
		$res .= (empty($res) ? "" : " ") .
		$this->convert_number($Hn) . " Hundred";
		}
		 
		$ones = array("", "One", "Two", "Three", "Four", "Five", "Six",
		"Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen",
		"Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eightteen",
		"Nineteen");
		$tens = array("", "", "Twenty", "Thirty", "Fourty", "Fifty", "Sixty",
		"Seventy", "Eigthy", "Ninety");
		 
		if ($Dn || $n)
		{
		if (!empty($res))
		{
		$res .= " and ";
		}
		 
		if ($Dn < 2)
		{
		$res .= $ones[$Dn * 10 + $n];
		}
		else
		{
		$res .= $tens[$Dn];
		 
		if ($n)
		{
		$res .=  $ones[$n];
		}
		}
		}
		 
		if (empty($res))
		{
		$res = "zero";
		}
		 
		return $res;
	}
	
		/* function to show the default cursor */
		public function check_cursor($data){
			if(!empty($data)){
				return 'cursor';
			}
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
	
	/* function to check the amount */
	public function check_amount($amt){
		if($amt > 0){
			return '₹'.$this->money_display($amt);			
		}else{
			return '-';
		}
		
	}
	
	/* function to get the ROA type */
	public function get_roa_type($type){	
		return $type == 'I' ? 'Individual' : 'Team';
	}
	
	/* function to show roa rating */
	public function show_roa_rating($rate){
		$star = "<i class='icon-star'></i>";		
		switch($rate){
			case '1':
			$star = $star;
			$title = 'Improvement / Value Addition';
			break;
			case '2':
			$star = $star.$star;
			$title = 'Achievement / Exceeding Expectations';
			break;
			case '3':
			$star = $star.$star.$star;
			$title = 'Exemplary Achievement / Trend Setting / Out of the Way Contribution';
			break;
			default:
			$star = '';
			break;
		}
		$labelStart = "<span title='".$title."' rel='tooltip'>";
		$labelEnd = '</span>';
		
		return $labelStart.$star.$labelEnd;
	}
	
	
	/* function to get star color */
	public function get_star_color($type){
		switch($type){
			case 'M':
			$color = 'teal';
			break;
			case 'Q':
			$color = 'green';
			break;
			case 'C':
			$color = 'orange';
			break;
		}
		return $color;
	}
	
	/* function to get star color */
	public function get_star_msg($type){
			switch($type){
			case 'M':
			$msg = 'Star of the Month';
			break;
			case 'Q':
			$msg = 'Star of the Quarter';
			break;
			case 'C':
			$msg = 'Champion of Career Tree';
			break;
		}
		return $msg;
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
	
	/* function to show the graph status in bd home */
	public function get_bdgraph_status($st, $label){
		if($label == 'sow_done'){
			$str = 'SOW';
		}		
		switch($st){			
			case '1':
			$msg = 'Finalized';
			break;
			case '0':
			$msg = 'Not Finalized';
			break;
		}
		return $str.' '.$msg;
	}
	
	/* function to assign biz. type color */
	public function get_biz_type_color($type){
		switch($type){			
			case 'N':
			$msg = 'freshBiz';
			break;
			case 'E':
			$msg = 'currentBiz';
			break;
			case 'O':
			$msg = 'oldBiz';
			break;
		}
		return $msg;
	}

	/* function to get url variables */
	public function get_url_vars($vars){
		foreach($vars as $key => $value){
			$str .= $key.'='.$value.'&';
		}
		return $str;
	}
	
	/* function to show the mandatory text */
	public function show_mandatory($val){
		if($val){
			return "<span class='red_star'>*</span>";				
		}
	}
		
	/* function to assign biz. type color */
	public function get_biz_type_cls($type){
		switch($type){			
			case 'N':
			$msg = 'success';
			break;
			case 'E':
			$msg = 'info';
			break;
			case 'O':
			$msg = 'inverse';
			break;
		}
		return $msg;
	}
	
	/* function to assign biz. priority color */
	public function get_priority_cls($type){
		switch($type){			
			case 'High':
			$msg = 'lightred';
			break;
			case 'Medium':
			$msg = 'warning';
			break;
			case 'Low':
			$msg = 'inverse';
			break;
		}
		return $msg;
	}
	
	/* function to get biz. contact title */
	public function get_contact_title($val){
		return $val == 1 ? 'Mr' : ($val == 2 ? 'Mrs' : 'Ms');
	}

	
	/* function to show the bd status text */
	public function get_bd_status_txt($data){ 
		if($data['work_complete'] == '1'){
			$txt = 'WC';
			$label = 'success';
			$tip = 'Active/Inprogress';
		}else if($data['work_start'] == '1' && $data['work_complete'] != '0'){
			$txt = 'WS';
			$label = 'success';
			$tip = 'Work Started';
		}else if($data['agreement_sign'] == '1' && $data['work_start'] != '0' && $data['work_complete'] != '0'){
			$txt = 'AS';
			$label = 'success';
			$tip = 'Agreement Signed';
		}else if($data['proposal_approve'] == '1' && $data['agreement_sign'] != '0' && $data['work_start'] != '0' && $data['work_complete'] != '0'){
			$txt = 'PA';
			$label = 'yellow';
			$tip = 'Proposal Approved';
		}else if($data['proposal_done'] == '1'  && $data['proposal_approve'] != '0' && $data['agreement_sign'] != '0' && $data['work_start'] != '0' && $data['work_complete'] != '0'){
			$txt = 'PS';
			$label = 'yellow';
			$tip = 'Proposal Submitted';
		}else if($data['sow_done'] == '1' && $data['proposal_done'] != '0' && $data['proposal_approve'] != '0' && $data['agreement_sign'] != '0' && $data['work_start'] != '0' && $data['work_complete'] != '0'){
			$txt = 'SW';
			$label = 'red';
			$tip = 'Scope of Work Finalized';
		}else if($data['sow_done'] == '0'){
			$txt = 'SW';
			$label = 'red';
			$tip = 'Scope of Work Not Finalized';
		}else if($data['proposal_done'] == '0'){
			$txt = 'PS';
			$label = 'red';
			$tip = 'Proposal Not Submitted';
		}else if($data['proposal_approve'] == '0'){
			$txt = 'PA';
			$label = 'yellow';
			$tip = 'Proposal Not Approved';
		}else if($data['agreement_sign'] == '0'){
			$txt = 'AS';
			$label = 'yellow';
			$tip = 'Agreement Not Signed';
		}else if($data['work_start'] == '0'){
			$txt = 'WS';
			$label = 'green';
			$tip = 'Work Not Started';
		}else if($data['work_complete'] == '0'){
			$txt = 'WC';
			$label = 'green';
			$tip = 'Inactive/Completed';
		}
		
		return $tip.'|'.$label.'|'.$txt;
	}
	
}
?>