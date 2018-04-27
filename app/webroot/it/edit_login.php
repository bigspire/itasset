<?php
/* 
Purpose : To edit the login.
Created : Gayathri
Date : 18-06-2016
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
if(empty($_SESSION['Logins'])){
	header('Location:../home/?access=Access denied!');
}

$getid = $_GET['id'];
$smarty->assign('getid',$getid);
// validate url 
if(($fun->isnumeric($getid)) || ($fun->is_empty($getid)) || ($getid == 0)){
  header('Location:page_error.php');
}
if($getid !=''){
	$exits = "CALL it_exit_login_details('".$getid."')";
	$result = $mysql->execute_query($exits);
	$total = $mysql->display_result($result);
	$t = $total['total'];

	if($t == 0){ 
		$msg = 'This record not in our database';
		header("Location:list_login.php?msg= $msg");
	}
}
// next query execution
$mysql->next_query();

// get database values
if(empty($_POST)){
	$query = "CALL it_get_login_id('$getid')";
	try{
		// calling mysql exe_query function
		if(!$result = $mysql->execute_query($query)){ 
			throw new Exception('Problem in executing get login id');
		}
		$row = $mysql->display_result($result);
		$smarty->assign('rows',$row);
		// assign the db values into session
		foreach($row as $key => $record){
			$smarty->assign($key,$record);		
		}   	
		// call the next result
		$mysql->next_query();		
		// free the memory
		$mysql->clear_result($result);
	}catch(Exception $e){
		echo 'Caught exception: ',  $e->getMessage(), "\n";
	}
}
if(!empty($_POST)){
	// Validating the required fields  
	// array for printing correct field name in error message
	$fieldtype = array('0', '0', '0', '1', '1','1');
	$actualfield = array('username', 'password', 'server', 'employee', 'login type', 'status');
   $field = array('user_name' => 'user_nameErr', 'password' => 'passwordErr', 'host' => 'hostErr', 
   'app_users_id' => 'app_users_idErr', 'it_login_type_id' => 'it_login_type_idErr', 'status' => 'statusErr');
	$j = 0;
	foreach ($field as $field => $er_var){ 
		if($_POST[$field] == ''){
			$error_msg = $fieldtype[$j] ? ' select the ' : ' enter the ';
			$actual_field =  $actualfield[$j];
			$er[$er_var] = 'Please'. $error_msg .$actual_field;
			$test = 'error';
			$smarty->assign($er_var,$er[$er_var]);
		}else{
			//$field = $_POST[$field];
			$smarty->assign($field,$_POST[$field]);	
		}
		$j++;
	}

	// assigning the date
	$date = $fun->current_date();
	if(empty($test)){
		// query to insert into database. 
		$query = "CALL it_edit_login('".$mysql->real_escape_str($getid)."', '".$mysql->real_escape_str($_POST['user_name'])."', '".$mysql->real_escape_str($_POST['password'])."', 
		'".$mysql->real_escape_str($_POST['host'])."', '".$date."', '".$mysql->real_escape_str($_POST['status'])."', '".$mysql->real_escape_str($_POST['it_login_type_id'])."', 
		'".$mysql->real_escape_str($_POST['app_users_id'])."')";
		// Calling the function that makes the insert
		try{
			// calling mysql exe_query function
			if(!$result = $mysql->execute_query($query)){ 
				throw new Exception('Problem in executing edit login');
			}
			$row = $mysql->display_result($result);
			$affected_rows = $row['affected_rows'];
			if(!empty($affected_rows)){
				// redirecting to view page
				header('Location: list_login.php?status=updated');		
			}
			// free the memory
			$mysql->clear_result($result);
			// call the next result
			$mysql->next_query();
		}catch(Exception $e){
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
	}
}

// smarty dropdown array for architechture
$smarty->assign('login_status', array('' => 'Select', '1' => 'Active', '0' => 'Inactive'));
// smarty dropdown for District
$query = 'CALL it_get_employee()';
try{
	// calling mysql exe_query function
	if(!$result = $mysql->execute_query($query)){ 
		throw new Exception('Problem in executing get employee');
	}
	$employee = array();
	while($emp = $mysql->display_result($result)){
    	$employee[$emp['id']] = ucwords($emp['first_name']).' '.$emp['last_name'];    		   
	}
	$smarty->assign('employee',$employee);
	// free the memory
	$mysql->clear_result($result);
	// call the next result
	$mysql->next_query();
}catch(Exception $e){
	echo 'Caught exception: ',  $e->getMessage(), "\n";
}

// smarty dropdown for Login types
$query = 'CALL it_get_login()';
try{
	// calling mysql exe_query function
	if(!$result = $mysql->execute_query($query)){ 
		throw new Exception('Problem in executing get login');
	}
	$login = array();
	while($log = $mysql->display_result($result)){
    	$login[$log['id']] = ucwords($log['title']);    		   
	}
	$smarty->assign('login',$login);
	// free the memory
	$mysql->clear_result($result);
}catch(Exception $e){
	echo 'Caught exception: ',  $e->getMessage(), "\n";
}
// closing mysql
$mysql->close_connection();
$smarty->assign('page_title' , 'Edit Login - IT');  
$smarty->assign('login_active','active'); 
$smarty->display('edit_login.tpl');
?>