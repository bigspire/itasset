<?php 
//starting the session
session_start();
// remote search
include 'configs/smartyconfig.php';
// include mysql class
include('classes/class.mysql.php');
// Connecting Database
$mysql->connect_database();
// include function validation class
include('classes/class.function.php');
//try
//assign user id
$id = $_SESSION['user_id'];
// get user role
$query = "call it_get_user_role('".$id."')";
try{
	// calling mysql exe_query function
	if(!$result = $mysql->execute_query($query)){
		throw new Exception('Problem in executing get user role');
	}
	$row = $mysql->display_result($result);
	$roleid = $row['app_roles_id']; 
	$mysql->clear_result($result);
	// call the next result
	$mysql->next_query();
}catch(Exception $e){
	echo 'Caught exception: ',  $e->getMessage(), "\n";
}

// get user modules
$query = "call it_get_user_modules('".$roleid."')";
	try{
		// calling mysql exe_query function
		if(!$result = $mysql->execute_query($query)){
			throw new Exception('Problem in executing get user modules');
		}
		$modules = array();
		while($row = $mysql->display_result($result)){
			$modules[$row['app_modules_id']] = $row['module_name']; 
		}
		$mysql->clear_result($result);
	}catch(Exception $e){
		echo 'Caught exception: ',  $e->getMessage(), "\n";
	}
	// assign smarty for module names
	foreach($modules as $key => $record){
		$smarty->assign($record, $record); 
	}
	print_r($_SESSION);
$smarty->assign('user_id', $roleid); 
//try end
?>