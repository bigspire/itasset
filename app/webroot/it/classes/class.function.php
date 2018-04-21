<?php
/* 
Purpose : To validate form fields.
Created : Gayathri, Nikitasa
Date : 02-06-2016
*/
class fun{
	
	public $key = '33YhGkf983ilkasjdf4GSD01';
	
	// letter and number validation with space
	public function name_validation($name){
		if(!preg_match('/^[a-zA-Z0-9. ]*$/',$name)){           
			return true;
    	}
    }
	
	// letter and space validation
	public function string_validation($string){
		if(!preg_match('/^[a-zA-Z ]*$/',$string)){           
			return true;
    	}
    }
	
	// letter and number letter validation without space
	public function letter_num_validation($input){
		if(!preg_match('/^[a-zA-Z0-9]*$/',$input)){           
			return true;
    	}
    }
	
    // function to validate string
	public function check_string($i_s){
		if(is_string($i_s)){
			return $i_s;	
		}
	}
	 
	// function to validate string
	public function upper_case_string($emp_name){
		$let = ucwords($emp_name);
		return $let;	
	}
	// function for create current date and time
    public function current_date(){
		$date = date('Y-m-d H:i:s');
		return $date;
	}
	
	// function to show date and time
    public function date_time($created_date){
		if(($created_date != '') && ($created_date != '0000-00-00 00:00:00')){
			$date = date('d, M Y  h:ia',strtotime($created_date));
			return $date;
		}
	}
	
	// function to validate database it_software created_date field 
	public function it_software_created_date($created_date){
		if(($created_date != '') && ($created_date != '0000-00-00')){
			$c_d = date('d-M-Y', strtotime($created_date));
			return $c_d;
		}
	}
	
   // function to validate database it_software subscription field 
	public function it_software_subscription($subscription){
		if($subscription == '1'){
			$sub = 'Yes';
		}else{	
	 		$sub = 'No';
		}
		return $sub;
	}
  // function to validate database it_software status field 
	public function it_software_status($status){
		if($status == '1'){
			$st = 'Active';
		}else{	
	 		$st = 'Inactive';
		}
		return $st;
	}	
	
	// function to validate database it hardware scrap status field 
	public function it_scrap_hw($status){
		if($status == 'S'){
			$st = 'Scrap - Awaiting Approval';
		}else if($status == 'L'){
	 		$st = 'Lost - Awaiting Approval';
		}else if($status == 'RS'){
			$st = 'Resale - Awaiting Approval';
		}else if($status == 'EX'){
	 		$st = 'Exchange - Awaiting Approval';
		}
		return $st;
	}	
	
	// function to validate database scrap type field 
	public function it_scrap_hw_type($status){
		if($status == 'S'){
			$st = 'Scrap';
		}else if($status == 'L'){
	 		$st = 'Lost';
		}else if($status == 'RS'){
			$st = 'Resale';
		}else if($status == 'EX'){
	 		$st = 'Exchange';
		}else if($status == 'R'){
	 		$st = 'Rental';
		}
		return $st;
	}
	
	// function to validate database scrap status field 
	public function it_scrap_hw_status($status){
		if($status == 'A'){
			$st = 'Approved';
		}else if($status == 'R'){
	 		$st = 'Rejected';
		}else if($status == 'W'){
			$st = 'Awaiting Approval';
		}
		return $st;
	}
	
	// function to validate database it_brand type field 
	public function it_brand_type($type){
		if($type == 'S'){
			$t = 'Software';
		}elseif($type == 'H'){	
	 		$t = 'Hardware';
		}
		return $t;
	}
	// function to validate priority for add ticket
	public function it_ticket_priority($type){
		if($type == '1'){
			$t = 'High';
		}elseif($type == '2'){	
	 		$t = 'Medium';
		}elseif($type == '3'){
			$t = 'Low';		
		}
		return $t;
	}
	// function to validate database assign_asset view type field 
	public function asset_type($type){
		if($type == 'Software'){
			$t = 'S';
		}else{	
	 		$t = 'H';
		}
		return $t;
	}
	// function to validate database it_software architecture field 
	public function it_software_architecture($architecture){
		if($architecture == '1'){
			$ar = '32 Bit';
		}if($architecture == '2'){	
	 		$ar = '64 Bit';
		}if($architecture == '3'){	
	 		$ar = 'Both';
		}
		return $ar;
	}
	// function to validate database it_software paid_mode field 
	public function it_software_paid_mode($paid_mode){
		if($paid_mode == 'CA'){
			$pm = 'Cash';
		}if($paid_mode == 'CQ'){	
	 		$pm = 'Cheque';
		}if($paid_mode == 'OT'){	
	 		$pm = 'Online Transfer';
		}if($paid_mode == 'CC'){	
	 		$pm = 'Credit Card';
		}if($paid_mode == 'OTH'){	
	 		$pm = 'Other';
		}
		return $pm;
	}

	// tpl active color field validation
	public function status_cls($status){
		if($status == '1'){
		 $stat = 'satgreen';
		}else{	
		 $stat = 'lightred';	
		}
		return $stat;
	} 
	
	// tpl active color field validation
	public function approval_status_cls($status){
		if($status == 'A'){
			$stat = 'satgreen';
		}else if($status == 'R'){
			$stat = 'lightred';	
		}
		return $stat;
	} 
	
	// function to validate database ticket status field 
	public function ticket_status($status){
		if($status == 'O'){
			$st = 'Open';
		}elseif($status == 'C'){	
	 		$st = 'Closed';
		}elseif($status == 'H'){	
	 		$st = 'Hold';
	 		$st = 'Hold';
		}else{	
	 		$st = 'Re-Open';
		}
		return $st;
	}
	// function to validate database ticket status field 
	public function ticket_status_id($status){
		if($status == '1'){
			$st = 'Open';
		}elseif($status == '2'){	
	 		$st = 'Closed';
		}elseif($status == '3'){	
	 		$st = 'Hold';
		}elseif($status == '4'){	
	 		$st = 'Re-Open';
		}
		return $st;
	}
	

	// function to validate database dashboard status field 
	public function dashboard_status($status){
		if($status == 'O'){
			$st = 'Open';
		}elseif($status == 'C'){	
	 		$st = 'Closed';
		}elseif($status == 'H'){	
	 		$st = 'Hold';
		}elseif($status == 'N'){	
	 		$st = 'Not-Closed';
		}
		return $st;
	}
	// function to validate database ticket priority field 
	public function ticket_priority($priority){
		if($priority == 'H'){
			$tp = 'High';
		}elseif($priority == 'M'){	
	 		$tp = 'Medium';
		}else{	
	 		$tp = 'Low';
		}
		return $tp;
	}
	// function to validate database view  software currency field 
	public function currency($priority){
		if($priority == 'R'){
			$tp = 'INR';
		}elseif($priority == 'D'){	
	 		$tp = 'USD';
		}
		return $tp;
	}
	// function to validate database view  software currency field 
	public function currency_type($priority){
		if($priority == 'R'){
			$tp = 'Rs';
		}elseif($priority == 'D'){	
	 		$tp = '$';
		}
		return $tp;
	}
	// tpl active color field validation for ticket
	public function ticket_status_cls($status){
		if($status == 'O'){
			$stat = 'blue_ticket';
		}elseif($status == 'C'){	
		 	$stat = 'lightred_ticket';	
		}elseif($status == 'H'){	
		 	$stat = 'satgreen_ticket';	
		}else{
			$stat = 'yellow_ticket';	
		}			
		return $stat;
	} 
	// function to validate database it_software subscription_validity field 
	public function it_software_validity($validity_year){
		$arr = array('0' => 'Life Time', '0.1' => '30 Days', '0.3' => '3 Months','0.6' => '6 Months', '0.9' => '9 Months', '1' => '1 Year', '2' => '2 Years', '3' => '3 Years', '4' => '4 Years', '5' => '5 Years');
		foreach($arr as $key => $value){
			if($validity_year == $key){
				$v = $value;
			}
		}
		return $v;
	}  
	// check if amount only contains numbers
	public function isnumeric($amount){
		if(!empty($amount) && !is_numeric($amount)){           
			return true;
		}
   }
   // check if it is a integer   
	public function is_number($num){		
		if(!empty($num)){
			if(!ctype_digit($num)){
				return true;
			}
   	}
   }
   // check if field only contains zero
	public function is_zero($number){
		if(($number == 0)){           
			return true;
		}
   }
	// check if phone number only contains numbers   
	public function is_phonenumber($contact_no){		
		if (!empty($contact_no) && !ctype_digit($contact_no)){
			return true;
		}
   }
	// check if phone number only contains numbers   
	public function size_of_phonenumber($contact_no){	
		if (!empty($contact_no) && ctype_digit($contact_no)){			
			if (strlen($contact_no) < 10){
				return true;
			}else if(strlen($contact_no) > 12){
				return true;
			}
 	   }
   }
   // email validation
	public function email_validation($email){		
		if(!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)){
			return true;
		}
   }
   // date format conversion
	public function convert_date($date){
		if($date != ''){
			$dateformat = explode('/',$date);
			$date_format = $dateformat[2].'-'.$dateformat[1].'-'.$dateformat[0];
			return $date_format;
		}
   }
   
   // date format conversion
	public function convert_date_display($date){
		if($date != ''){
			$dateformat = explode('-',$date);
			$date_format = $dateformat[2].'/'.$dateformat[1].'/'.$dateformat[0];
			return $date_format;
		}
	}
	// validity till should be greater than validity till
	
	public function validity_diff($fdate, $tdate){
		if(!empty($tdate)){
			if($tdate > $fdate){
				return true;
			}
		}
	}
   // function to validate date field for export
	public function display_date(){
		$display = date('d-m-Y');
		return $display;
	}
   // check the  file is empty
   public function is_empty($filename){
		if(empty($filename)){
			return true;
		}
	}
	// check the  file is not empty
   public function not_empty($filename){
		if(!empty($filename)){
			return true;
		}
	}
	
	//  checking the file extension is jpg,jpeg or png
	public function extension_validation($file_ext,$extensions){
		if(in_array($file_ext,$extensions) == false){
			return true;
		}
	}
	
	// checking the file size is less than 1 MB
	public function size_validation($size,$req_size){	
		if($size > $req_size){
			return true;
		}	
	}
	
	// upload folder validation
	public function check_uploaded($uploaddir){
		if(!file_exists($uploaddir)){
			return true;
		}		
	}
	
	 /* match the fields in the auto complete search */
	function match_results($keyword, $value){
		//  matching the keyword with the result
		if(strncmp($keyword,strtolower(trim($value)),strlen($keyword)) == 0){
			if(trim($value)){
				return trim("$value\n");
			}			
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
	
	/* function to decrypt */
	public function decrypt($cypher){
		$cypher = str_replace('%20','+',str_replace(' ','+',$cypher));			
		return trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $this->key, base64_decode($cypher), MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND)));
    }
	
	
	/* function to encrypt */
	 public function encrypt($plain){	
        return trim(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $this->key, $plain, MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND))));
    }
	
	/* function to assign the user id in session */
	function get_user_id(){
		// get the current user details
		$cookie_id = $this->decrypt($_COOKIE['CakeCookie']['PDCAUSER']);		
		return $cookie_id;
	}
		
}
$fun = new fun();
?>
