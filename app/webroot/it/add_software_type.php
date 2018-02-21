<?php
/* 
Purpose : To add the software type.
Created : Gayathri
Modified : NIkitasa
Date : 17-06-2016
*/
// starting the session
session_start();

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

// redirect to error page if the user is not it admin
if($roleid != '21'){
	header('Location:'.IT_DIR.'home/');
}
// redirecting to dashboard if the user don't have the permission to this module
if(empty($_SESSION['SettingsSoftwareType'])){
	header('Location:dashboard.php?access=Access denied!');
}

if(!empty($_POST)){
	// Validating the required fields  
	// array for printing correct field name in error message
	$fieldtype = array('0', '1');
	$actualfield = array('title', 'status');
   $field = array('title' => 'titleErr', 'status' => 'statusErr');
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
	$smarty->assign('description',$_POST['description']);	
	// assigning the date
	$date = $fun->current_date();
	// query to check whether it is exist or not. 
	$query = "CALL it_check_sw_type_exist('0','".$_POST['title']."')";
	// Calling the function that makes the insert
	$result = $mysql->execute_query($query);
	$row = $mysql->display_result($result);
	// clear the results	    			
	$mysql->clear_result($result);
	// next query execution
	$mysql->next_query();
	if(empty($test)){
		if($row['total'] == '0'){
			// query to insert into database. 
			$query = "CALL it_add_software_type('".$mysql->real_escape_str($_POST['title'])."', '".$mysql->real_escape_str($_POST['description'])."', 
			'".$mysql->real_escape_str($_POST['status'])."', '".$date."')";
			// Calling the function that makes the insert
			$result = $mysql->execute_query($query);
			$row = $mysql->display_result($result);
			$last_id = $row['inserted_id'];
			if(!empty($last_id)){
				// redirecting to view page
				header('Location: software_type.php?status=created');		
			}
		}else{
		$msg = "Software type title already exists";
		$smarty->assign('EXIST_MSG',$msg); 
		}
	}
}
// smarty dropdown array for architechture
$smarty->assign('sw_status', array('' => 'Select', '1' => 'Active', '0' => 'Inactive'));

// closing mysql
$mysql->close_connection();
$smarty->assign('page_title' , 'Add Software Type - IT');  
$smarty->assign('settings_active','active'); 
$smarty->display('add_software_type.tpl');
?>