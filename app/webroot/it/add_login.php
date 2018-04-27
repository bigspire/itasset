<?php
/* 
Purpose : To add the login.
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
if(empty($_SESSION['Logins'])){
	header('Location:../home/?access=Access denied!');
}

if(!empty($_POST)){
	// Validating the required fields  
	// array for printing correct field name in error message
	$fieldtype = array('0', '0', '0', '1', '1', '1');
	$actualfield = array('username', 'password', 'server', 'employee', 'login type', 'status');
   $field = array('username' => 'usernameErr', 'password' => 'passwordErr', 'server' => 'serverErr', 
   'app_users' => 'app_usersErr', 'login_type' => 'login_typeErr', 'status' => 'statusErr');
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

	// assigning the date
	$date = $fun->current_date();
	if(empty($test)){
		// query to insert into database. 
		$query = "CALL it_add_login('".$mysql->real_escape_str($_POST['username'])."', '".$mysql->real_escape_str($_POST['password'])."', 
		'".$mysql->real_escape_str($_POST['server'])."', '".$mysql->real_escape_str($_POST['status'])."', 
		'".$date."', '".$mysql->real_escape_str($_POST['login_type'])."', 
		'".$mysql->real_escape_str($_POST['app_users'])."')";
		// Calling the function that makes the insert
		try{
			// calling mysql exe_query function
			if(!$result = $mysql->execute_query($query)){
				throw new Exception('Problem in executing add login');
			}
			$row = $mysql->display_result($result);
			$last_id = $row['inserted_id'];
			if(!empty($last_id)){
				// redirecting to view page
				header('Location: list_login.php?status=created');		
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

// smarty drop down for Login types
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
$smarty->assign('page_title' , 'Add Login - IT');  
$smarty->assign('login_active','active'); 
$smarty->display('add_login.tpl');
?>