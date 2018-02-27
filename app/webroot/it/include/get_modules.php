<?php 
/* 
Purpose : To display modules based on permission
Created : Gayathri 
Date : 11-10-2016
*/
// Connecting Database
$mysql->connect_database();

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
			$modules[$row['app_modules_id']] = preg_replace("/[-\s]/","",$row['module_name']); 
			$_SESSION[preg_replace("/[-\s]/","",$row['module_name'])] = 'present';
		}
		$mysql->clear_result($result);
		// call the next result
		$mysql->next_query();
	}catch(Exception $e){
		echo 'Caught exception: ',  $e->getMessage(), "\n";
	}
	// assign smarty for module names
	foreach($modules as $key => $record){
		$smarty->assign($record, $record); 
	}
?>