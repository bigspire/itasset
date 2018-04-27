<?php
/* 
Purpose : To add the login type.
Created : Gayathri
Date : 17-06-2016
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

// redirect to error page if the user is not it admin
if($roleid != '21'){
	header('Location:'.IT_DIR.'home/');
}
// redirecting to dashboard if the user don't have the permission to this module
if(empty($_SESSION['SettingsLoginType'])){
	header('Location:../home/?access=Access denied!');
}

if(!empty($_POST)){
	// Validating the required fields  
	// array for printing correct field name in error message
	$fieldtype = array('0', '0');
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
	$date = date('Y-m-d h:i:s');
	// query to check whether it is exist or not. 
	$query = "CALL it_check_login_type_exist('0','".$_POST['title']."')";
	// Calling the function that makes the insert
	try{
		// calling mysql exe_query function
		if(!$result = $mysql->execute_query($query)){
			throw new Exception('Problem in executing to check login type exist');
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
			// query to insert into database. 
			$query = "CALL it_add_login_type('".$mysql->real_escape_str($_POST['title'])."', '".$mysql->real_escape_str($_POST['description'])."', 
			'".$mysql->real_escape_str($_POST['status'])."', '".$date."')";
			// Calling the function that makes the insert
			try{
				// calling mysql exe_query function
				if(!$result = $mysql->execute_query($query)){
					throw new Exception('Problem in executing add login type');
				}
				$row = $mysql->display_result($result);
				$last_id = $row['inserted_id'];
				if(!empty($last_id)){
					// redirecting to view page
					header('Location: login_type.php?status=created');		
				}
				// free the memory
				$mysql->clear_result($result);
			}catch(Exception $e){
				echo 'Caught exception: ',  $e->getMessage(), "\n";
			}
		}else{
			$msg = "Login type already exists";
			$smarty->assign('EXIST_MSG',$msg); 
		}
	}
}
// smarty dropdown array for architechture
$smarty->assign('sw_status', array('' => 'Select', '1' => 'Active', '0' => 'Inactive'));

// closing mysql
$mysql->close_connection();
$smarty->assign('page_title' , 'Add Login Type - IT');  
$smarty->assign('settings_active','active'); 
$smarty->display('add_login_type.tpl');
?>