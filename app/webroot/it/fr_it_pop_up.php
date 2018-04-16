<?php
/* 
Purpose : To list change asset request and help desk.
Created : Nikitasa
Date : 01-07-2016
*/

//include smarty congig file
include 'configs/smartyconfig.php';
// include mysql class
include('classes/class.mysql.php');
// Connecting Database
$mysql->connect_database();
// include function validation class
include('classes/class.function.php');
// include paging class 
include('classes/class.paging.php');
// mailing class
include('classes/class.mailer.php');
// content class
include('classes/class.content.php');
// get user id
$user_id = $fun->get_user_id();



// fetch all records for list assign employee for software
$query = "CALL it_list_assign_emp('".$user_id."','S', '')";

try{
	if(!$result = $mysql->execute_query($query)){
		throw new Exception('Problem in executing my software page');
	}
	// calling mysql fetch_result function
	while($obj = $mysql->display_result($result))
	{
 		$data_software[] = $obj;
	}
	// free the memory
	$mysql->clear_result($result);
	// call the next result
	$mysql->next_query();
}catch(Exception $e){
	echo 'Caught exception: ',  $e->getMessage(), "\n";
}

// fetch all records for list_assign_emp hardware
$query = "CALL it_list_assign_emp('".$user_id."','H', '')";

try{
	if(!$result = $mysql->execute_query($query)){
		throw new Exception('Problem in executing my hardware page');
	}
	// calling mysql fetch_result function
	while($obj = $mysql->display_result($result)){
 		$data_hardware[] = $obj;
	}
	// free the memory
	$mysql->clear_result($result);
	// call the next result
	$mysql->next_query();
}catch(Exception $e){
	echo 'Caught exception: ',  $e->getMessage(), "\n";
}

// assigning the date
$date = date('Y-m-d h:i:s');

// when the form submitted
if($_POST["hdnSubmit"] == '1'){
	
	$error = '1';

	foreach($_POST as $key => $data){ 
	
		$field = explode('_',$key);
		$value = explode('_',$data);
		
		// validate radio
		if(isset($_POST['reasonhw_'.$field[1]])){ 
			if($_POST['accepthw_'.$field[1]] == ''){ 
				$field_error[$field[1]] = 'Please select any one';	
				$error = 0;
			}else{
				$field_error[$field[1]] = '';
				$field_hw_data[$field[1]] = $_POST['itahw_'.$field[1]];
			}
		}
		
		if(isset($_POST['reasonsw_'.$field[1]])){
			if($_POST['acceptsw_'.$field[1]] == ''){
				$field_error[$field[1]] = 'Please select any one';	
				$error = 0;
			}else{
				$field_error[$field[1]] = '';
				$field_sw_data[$field[1]] = $_POST['itasw_'.$field[1]];
			}
		}
	
		if($data != ''){ 			
			// retain radio
			if($field[0] == 'accepthw' && $value[0] == '1'){
				$accept_check[$field[1]] = 'checked';	
				$_POST['reasonhw_'.$field[1]] = '';
			}else if($field[0] == 'accepthw' && $value[0] == '0'){
				$reject_check[$field[1]] = 'checked';	
			}else if($field[0] == 'acceptsw' && $value[0] == '1'){
				$accept_check[$field[1]] = 'checked';	
				$_POST['reasonsw_'.$field[1]] = '';
			}else if($field[0] == 'acceptsw' && $value[0] == '0'){
				$reject_check[$field[1]] = 'checked';	
			}
			
			
			// validate reason
			if(isset($_POST['reasonhw_'.$field[1]])){
				if($field[0] == 'accepthw' && $value[0] == '0' && $_POST['reasonhw_'.$field[1]] == ''){
					$reason_error[$field[1]] = 'Please enter the reason';
					$error = 0;
				}else{			
					$retain_reason[$field[1]] = $_POST['reasonhw_'.$field[1]];					
					$field_hw_reason[$field[1]] = $_POST['reasonhw_'.$field[1]];
				}
			}
			
			if(isset($_POST['reasonsw_'.$field[1]])){
				if($field[0] == 'acceptsw' && $value[0] == '0' && $_POST['reasonsw_'.$field[1]] == ''){
					$reason_error[$field[1]] = 'Please enter the reason';
					$error = 0;
				}else{
					$retain_reason[$field[1]] = $_POST['reasonsw_'.$field[1]];
					$field_sw_reason[$field[1]] = $_POST['reasonsw_'.$field[1]];
				}
			}
					
		}
	}
	$smarty->assign('retainReason', $retain_reason);
	$smarty->assign('reasonErr', $reason_error);
	$smarty->assign('fieldErr', $field_error);
	$smarty->assign('accept_checked', $accept_check);
	$smarty->assign('reject_checked', $reject_check);
	
	
	// when no error process the form
	if($error){
		$field_sw_data = array_unique($field_sw_data);
		$field_hw_data = array_unique($field_hw_data);
		$field_sw_reason = array_unique($field_sw_reason);
		$field_hw_reason = array_unique($field_hw_reason);
		
		// save the assigned s/w accept status in it assign table
		foreach($field_sw_data as $key_data => $it_data){
			$accept = $field_sw_reason[$key_data] == '' ? 'Y' : 'N';
			$query = "CALL it_update_assign_asset('".$it_data."', '".$field_sw_reason[$key_data]."', '".$date."',  '".$accept."', '".$user_id."')";
			// Calling the function that makes the insert
			try{
				// calling mysql exe_query function
				if(!$result = $mysql->execute_query($query)){ 
					throw new Exception('Problem in executing update assign asset');
				}
				$row = $mysql->display_result($result);
				$affected_rows = $row['affected_rows'];
				if(!empty($affected_rows)){
					// redirecting to view page
					// header('Location: list_brand.php?status=updated');		
				}
				// free the memory
				$mysql->clear_result($result);
				// call the next result
				$mysql->next_query();
				// get the assigned s/w asset status
				$item_sw_type[] = 'Software';
				$item_swtype[] = $_POST['itasw_type_'.$it_data];
				$item_sw_brand[] = $_POST['itasw_brand_'.$it_data];
				$item_sw_edition[] = $_POST['itasw_edition_'.$it_data];	
				$item_sw_reason[] = $field_sw_reason[$key_data];	
				$item_sw_accept[] = $accept;
				
			}catch(Exception $e){
				echo 'Caught exception: ',  $e->getMessage(), "\n";
			}
		}
		// save the assigned h/w accept status in it assign table
		foreach($field_hw_data as $key_data2 => $it_data2){
			
			$accept = $field_hw_reason[$key_data2] == '' ? 'Y' : 'N';
			$query = "CALL it_update_assign_asset('".$it_data2."', '".$field_hw_reason[$key_data2]."', '".$date."',  '".$accept."', '".$user_id."')";
			// Calling the function that makes the insert
			try{
				// calling mysql exe_query function
				if(!$result = $mysql->execute_query($query)){ 
					throw new Exception('Problem in executing update assign asset');
				}
				$row = $mysql->display_result($result);
				
				// free the memory
				$mysql->clear_result($result);
				// call the next result
				$mysql->next_query();
				
				// get the assigned h/w asset status
				$item_hw_type[] = 'Hardware';				
				$item_hwtype[] = $_POST['itahw_type_'.$it_data2];
				$item_hw_brand[] = $_POST['itahw_brand_'.$it_data2];
				$item_hw_inventory[] = $_POST['itahw_inventory_'.$it_data2];
				$item_hw_asset_desc[] = $_POST['itahw_asset_desc_'.$it_data2];
				$item_hw_reason[] = $field_hw_reason[$key_data2];	
				$item_hw_accept[] = $accept;
				
			}catch(Exception $e){
				echo 'Caught exception: ',  $e->getMessage(), "\n";
			}
		}
		
		// get the employee details
		$query = "CALL it_get_app_user('".$user_id."')";
		try{
			if(!$result = $mysql->execute_query($query)){
				throw new Exception('Problem in getting employee details');
			}
			// calling mysql fetch_result function
			$obj = $mysql->display_result($result);
			$user_name = ucwords($obj['first_name'].' '.$obj['last_name']);
			$user_email = $obj['email_address'];			
			// free the memory
			$mysql->clear_result($result);
			// call the next result
			$mysql->next_query();
		}catch(Exception $e){
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
		// get the current user details
		$query = "CALL it_get_scrap_roles_user()";
		try{
			if(!$result = $mysql->execute_query($query)){
				throw new Exception('Problem in getting hardware module assigned users details');
			}
			// calling mysql fetch_result function
			while($account = $mysql->display_result($result)){
				$row_account[] = $account;
			}
			// free the memory
			$mysql->clear_result($result);
			// call the next result
			$mysql->next_query();
		}catch(Exception $e){
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
		

		// parse hardware mail data
		foreach($item_hw_type as $mail_key => $hw_mail_data){
			$accept = $item_hw_accept[$mail_key] == 'Y' ? 'Accepted' : 'Rejected';
			$mail_data .= '<tr style="background:#f5f4f4;">';
			$mail_data .= '<td width="100">Hardware Type</td>';
			$mail_data .= '<td style="color:#2a2a2a;">'.$item_hwtype[$mail_key].'</td>';
			$mail_data .= '<td width="100">Brand</td>';
			$mail_data .= '<td style="color:#2a2a2a;">'.$item_hw_brand[$mail_key].'</td>';
			$mail_data .= '</tr>';
			$mail_data .= '<tr style="background:#f5f4f4;">';
			$mail_data .= '<td width="100">Inventory No</td>';
			$mail_data .= '<td style="color:#2a2a2a;">'.$item_hw_inventory[$mail_key].'</td>';
			$mail_data .= '<td width="100">Asset Description</td>';
			$mail_data .= '<td style="color:#2a2a2a;">'.$item_hw_asset_desc[$mail_key].'</td>';
			$mail_data .= '</tr>';   
			$mail_data .= '<tr style="background:#f5f4f4;">';
			$mail_data .= '<td width="100">Accepted?</td>';
			$mail_data .= '<td style="color:#2a2a2a;">'.$accept.'</td>';	
			$mail_data .= '<td width="100"></td>';
			$mail_data .= '<td style="color:#2a2a2a;"></td>';			
			$mail_data .= '</tr>'; 	
			if($item_hw_accept[$mail_key] == 'N'){
				$mail_data .= '<tr style="background:#f5f4f4;">';
				$mail_data .= '<td width="100" colspan="3">Reject Reason</td>';
				$mail_data .= '<td style="color:#2a2a2a;">'.$item_hw_reason[$mail_key].'</td>';
				$mail_data .= '</tr>'; 	
			}            
		}
						
		// parse software mail data
		foreach($item_sw_type as $mail_key2 =>  $sw_mail_data){
			$accept = $item_sw_accept[$mail_key2] == 'Y' ? 'Accepted' : 'Rejected';
			$mail_data .= '<tr style="background:#f5f4f4;">';
			$mail_data .= '<td width="100">Software Type</td>';
			$mail_data .= '<td style="color:#2a2a2a;">'.$item_swtype[$mail_key2].'</td>';
			$mail_data .= '<td width="100">Brand</td>';
			$mail_data .= '<td style="color:#2a2a2a;">'.$item_sw_brand[$mail_key2].'</td>';
			$mail_data .= '</tr>';
			$mail_data .= '<tr style="background:#f5f4f4;">';
			$mail_data .= '<td width="100">Edition</td>';
			$mail_data .= '<td style="color:#2a2a2a;">'.$item_sw_edition[$mail_key2].'</td>';
			$mail_data .= '<td width="100">Accepted?</td>';
			$mail_data .= '<td style="color:#2a2a2a;">'.$accept.'</td>';	
			$mail_data .= '</tr>';				
			if($item_sw_accept[$mail_key2] == 'N'){
				$mail_data .= '<tr style="background:#f5f4f4;">';
				$mail_data .= '<td width="100" colspan="3">Reject Reason</td>';
				$mail_data .= '<td style="color:#2a2a2a;">'.$item_sw_reason[$mail_key2].'</td>';
				$mail_data .= '</tr>'; 
			}			
		}			
			
		// send notification mail to system admin about acceptance or rejection
		foreach($row_account as  $assigned_user){ 	
			$sub = 'MyPDCA: Assigned Asset Verified By - '.$user_name;			
			$msg = $content->get_asset_verify_mail($mail_data, $user_name, $assigned_user['user_name']);
			$mailer->send_mail($sub,$msg,$user_name,$user_email,$assigned_user['user_name'],$assigned_user['email_address']);
		}
		
		$smarty->assign('form_sent', '1');
		
		
	}
}

// calling mysql close db connection function
$c_c = $mysql->close_connection();
$smarty->assign('data_software', $data_software);
$smarty->assign('data_hardware', $data_hardware);
$smarty->assign('ALERT_MSG_ASSET', $alert_msg); 
$smarty->assign('ALERT_MSG_TICKET', $alert_msg1);
$smarty->assign('ALERT_MSG_SW', $alert_msg2); 
$smarty->assign('ALERT_MSG_HW', $alert_msg3);  
// display smarty file
$smarty->display('fr_it_pop_up.tpl');
?>