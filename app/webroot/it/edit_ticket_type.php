<?php
/* 
Purpose : To edit the ticket type.
Created : Nikitasa
Date : 16-12-2017
*/

// including smarty config
include 'configs/smartyconfig.php';
// including Database class file
include('classes/class.mysql.php');
$mysql->connect_database();
// Validating fields using class.function.php
include('classes/class.function.php');
//include menu_count file
include 'include/menu_count.php';
// include permission file
include 'include/get_modules.php';

/*
// redirect to error page if the user is not it admin
if($roleid != '21'){
	header('Location:'.IT_DIR.'home/');
} */
// redirecting to dashboard if the user don't have the permission to this module
if(empty($_SESSION['SettingsTicketType'])){
	header('Location:../home/?access=Access denied!');
}

$getid = $_GET['id'];
$smarty->assign('getid',$getid);
// validate url 
if(($fun->isnumeric($getid)) || ($fun->is_empty($getid)) || ($getid == 0)){
  header('Location:page_error.php');
}
// if id is not in our database redirect list page
if($getid !=''){
	$exits = "CALL it_exit_ticket_type_details('".$getid."')";
	$result = $mysql->execute_query($exits);
	$total = $mysql->display_result($result);
	$t = $total['total'];

	if($t == 0){ 
		$msg = 'This record not in our database';
		header("Location:list_ticket_type.php?msg= $msg");
	}
}
// next query execution
$mysql->next_query();
// get database values
if(empty($_POST)){
	$query = "CALL it_get_ticket_type_id('$getid')";
	try{
		// calling mysql exe_query function
		if(!$result = $mysql->execute_query($query)){ 
			throw new Exception('Problem in executing get ticket type id');
		}
		$row = $mysql->display_result($result);
		$smarty->assign('rows',$row);
		// assign the db values into session
		foreach($row as $key => $record){
			$smarty->assign($key,$record);		
		}  
		// free the memory
		$mysql->clear_result($result);
		// call the next result
		$mysql->next_query();
	}catch(Exception $e){
		echo 'Caught exception: ',  $e->getMessage(), "\n";
	} 			
}
if(!empty($_POST)){
	// Validating the required fields  
	// array for printing correct field name in error message
	$fieldtype = array('0','1');
	$actualfield = array('type',  'status');
   $field = array('type' => 'typeErr', 'status' => 'statusErr');
	$j = 0;
	foreach ($field as $field => $er_var){ 
		if($_POST[$field] == ''){
			$error_msg = $fieldtype[$j] ? ' select the ' : ' enter the ';
			$actual_field =  $actualfield[$j];
			$er[$er_var] = 'Please'. $error_msg .$actual_field;
			$test = 'error';
			$smarty->assign($er_var,$er[$er_var]);
		}else{
			$smarty->assign($field,$_POST[$field]);	
		}
		$j++;
	}

	// query to check whether it is exist or not. 
	$query = "CALL it_check_ticket_type_exist('".$getid."','".$_POST['type']."')";
	// Calling the function that makes the insert
	try{
		// calling mysql exe_query function
		if(!$result = $mysql->execute_query($query)){ 
			throw new Exception('Problem in executing check ticket type exist');
		}
		$row = $mysql->display_result($result);
		// call the next result
		$mysql->next_query();
	}catch(Exception $e){
		echo 'Caught exception: ',  $e->getMessage(), "\n";
	}
	
	
	if(empty($test) && empty($msg)){
		if($row['total'] == '0'){
			// assigning the date
			$date = date('Y-m-d h:i:s');
			// clear the results	    			
			$mysql->clear_result($result);
			// next query execution
			$mysql->next_query();
			// query to insert into database. 
			$query = "CALL it_edit_ticket_type('".$mysql->real_escape_str($getid)."','".$mysql->real_escape_str($_POST['type'])."', '".$mysql->real_escape_str($_POST['status'])."', '".$date."')";
			// Calling the function that makes the insert
			try{
				// calling mysql exe_query function
				if(!$result = $mysql->execute_query($query)){ 
					throw new Exception('Problem in executing edit ticket type');
				}
				$row = $mysql->display_result($result);
				$affected_rows = $row['affected_rows'];
				if(!empty($affected_rows)){
					// redirecting to view page
					header('Location: list_ticket_type.php?status=updated');		
				}
				// free the memory
				$mysql->clear_result($result);
			}catch(Exception $e){
				echo 'Caught exception: ',  $e->getMessage(), "\n";
			}
		}else{
			$msg = "Ticket Type already exists";
			$smarty->assign('EXIST_MSG',$msg); 
		}	
	}
}
// smarty dropdown array for architechture
$smarty->assign('ticket_status', array('' => 'Select', '1' => 'Active', '0' => 'Inactive'));
// closing mysql
$mysql->close_connection();
$smarty->assign('page_title' , 'Edit Ticket Type - IT');  
$smarty->assign('settings_active','active'); 
$smarty->display('edit_ticket_type.tpl');
?>