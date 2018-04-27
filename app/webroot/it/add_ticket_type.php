<?php
/* 
Purpose : To add the ticket type.
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

if(!empty($_POST)){
	// Validating the required fields  
	// array for printing correct field name in error message
	$fieldtype = array('0', '1');
	$actualfield = array('type', 'status');
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
	$query = "CALL it_check_ticket_type_exist('0','".$_POST['type']."')";
	// Calling the function that makes the insert
	try{
		// calling mysql exe_query function
		if(!$result = $mysql->execute_query($query)){
			throw new Exception('Problem in executing to check ticket type exist');
		}
		$row = $mysql->display_result($result);
		// free the memory
		$mysql->clear_result($result);
		// call the next result
		$mysql->next_query();
	}catch(Exception $e){
		echo 'Caught exception: ',  $e->getMessage(), "\n";
	}
	if(empty($test)){
		if($row['total'] == '0'){
			// assigning the date
			$date = date('Y-m-d h:i:s');
			// next query execution
			$mysql->next_query();
			// query to insert into database. 
			$query = "CALL it_add_ticket_type('".$mysql->real_escape_str($_POST['type'])."','".$mysql->real_escape_str($_POST['status'])."', '".$date."')";
			// Calling the function that makes the insert
			try{
				// calling mysql exe_query function
				if(!$result = $mysql->execute_query($query)){
					throw new Exception('Problem in executing add ticket type');
				}
				$row = $mysql->display_result($result);
				$last_id = $row['inserted_id'];
				if(!empty($last_id)){
					// redirecting to view page
					header('Location: list_ticket_type.php?status=created');		
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
$smarty->assign('page_title' , 'Add Ticket Type - IT');  
$smarty->assign('settings_active','active'); 
$smarty->display('add_ticket_type.tpl');
?>