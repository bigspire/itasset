<?php
/* 
Purpose : To edit role.
Created : Gyathri
Date : 22-06-2016
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
if(empty($_SESSION['SettingsRoles'])){
	header('Location:dashboard.php?access=Access denied!');
}

$getid = $_GET['id'];
$smarty->assign('getid',$getid);
// validate url 
if(($fun->isnumeric($getid)) || ($fun->is_empty($getid)) || ($getid == 0)){
  header('Location:page_error.php');
}
// if id is not in our database redirect list page
if($getid !=''){
	$exits = "CALL it_exit_app_roles('".$getid."')";
	$result = $mysql->execute_query($exits);
	$total = $mysql->display_result($result);
	$t = $total['total'];

	if($t == 0){ 
		$msg = 'This record not in our database';
		header("Location:list_role.php?msg= $msg");
	}
}
// next query execution
$mysql->next_query();
// get database values
if(empty($_POST)){
	$query = "CALL it_get_role('$getid')";
	try{
		// calling mysql exe_query function
		if(!$result = $mysql->execute_query($query)){ 
			throw new Exception('Problem in executing get role');
		}
		$row = $mysql->display_result($result);
		$smarty->assign('rows',$row);
		// assign the db values into session
		foreach($row as $key => $record){
			$smarty->assign($key,$record);		
		}  
		
		// free the memory
		$mysql->clear_result($result);
		// next query execution
		$mysql->next_query();
	}catch(Exception $e){
		echo 'Caught exception: ',  $e->getMessage(), "\n";
	}
	$query = "CALL it_get_role_id('$getid')";
	try{
		// calling mysql exe_query function
		if(!$result = $mysql->execute_query($query)){ 
			throw new Exception('Problem in executing get role id');
		}
		$app_modules_id = array();
		while($row = $mysql->display_result($result)){
			$app_modules_id[] = $row['app_modules_id'];
		}	
		$smarty->assign('app_modules_id',$app_modules_id);		
		// free the memory
		$mysql->clear_result($result);
		// next query execution
		$mysql->next_query();
	}catch(Exception $e){
		echo 'Caught exception: ',  $e->getMessage(), "\n";
	}	
}

if(!empty($_POST)){ 
	// Validating the required fields  
	// array for printing correct field name in error message
	$fieldtype = array('0', '1');
	$actualfield = array('role name ','status');
   $field = array('role_name' => 'role_nameErr', 'status' => 'statusErr');
	$j = 0;
	foreach ($field as $field => $er_var){ 
		if(empty($_POST[$field]) && $_POST[$field] != '0'){
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
 	if(empty($_POST['app_modules_id'])){
 		$app_modules_idErr = 'Please select the permissions';
 		$smarty->assign('app_modules_idErr',$app_modules_idErr);
 		$test = 'error';
 	}else{
 		$app_modules_id = array(); 
 		$app_modules_id = $_POST['app_modules_id'];
 		$smarty->assign('app_modules_id',$app_modules_id);
	}
	// assigning the date
	$date =  $fun->current_date();
	// query to check whether it is exist or not. 
	$query = "CALL it_check_role_exist('".$getid."', '".$_POST['role_name']."')";
	// Calling the function that makes the insert
	try{
		// calling mysql exe_query function
		if(!$result = $mysql->execute_query($query)){
			throw new Exception('Problem in executing to check role exist');
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
			// query to insert role. 
			$query = "CALL it_edit_role('".$mysql->real_escape_str($getid)."', '".$mysql->real_escape_str($_POST['role_name'])."', '".$mysql->real_escape_str($_POST['role_desc'])."', 
			'".$mysql->real_escape_str($_POST['status'])."', '1', '".$date."', '1')";
			try{
	    		// calling mysql exe_query function
				if(!$result = $mysql->execute_query($query)){
					throw new Exception('Problem in executing edit role query');
				}
				$row = $mysql->display_result($result);
				$affected_rows = $row['affected_rows'];
				// clear the results	    			
      		   $mysql->clear_result($result);
			   
				// next query execution
				$mysql->next_query();
				// delete all the existing permissions.
				$query = "CALL it_delete_app_roles('".$getid."')";
				try{
	    			// calling mysql exe_query function
					if(!$result = $mysql->execute_query($query)){
						throw new Exception('Problem in executing delete permission query');
					}
					// next query execution
					$mysql->next_query();
				}catch(Exception $e){
					echo 'Caught exception: ',  $e->getMessage(), "\n";
					die;
				}	
				foreach($app_modules_id as $key => $val){
					// query to insert into database. 
					$query = "CALL it_add_permissions('".$mysql->real_escape_str($date)."', '".$_SESSION['user_id']."', '".$mysql->real_escape_str($val)."', '".$mysql->real_escape_str($getid)."')";
				
					try{
	    				// calling mysql exe_query function
						if(!$result = $mysql->execute_query($query)){
							throw new Exception('Problem in executing insert permission query');
						}
						$row = $mysql->display_result($result);
						// next query execution
						$mysql->next_query();
					}catch(Exception $e){
						echo 'Caught exception: ',  $e->getMessage(), "\n";
						die;
					}
				}
				// redirecting to view page
				header('Location: list_role.php?status=updated');		
				// free the memory
				$mysql->clear_result($result);
				// call the next result
				$mysql->next_query();
			}catch(Exception $e){
				echo 'Caught exception: ',  $e->getMessage(), "\n";
				die;
			}
		}else{
			$msg = "Role name already exists";
			$smarty->assign('EXIST_MSG',$msg); 
		} 
	}
}
// smarty dropdown array for architechture
$smarty->assign('role_status', array('' => 'Select', '1' => 'Active', '0' => 'Inactive'));

// smarty dropdown for permission
$query = "call it_get_permissions()";
try{
	// calling mysql exe_query function
	if(!$result = $mysql->execute_query($query)){
		throw new Exception('Problem in executing get permission query');
	}
	$permissions = array();
	while($role_permission = $mysql->display_result($result)){
    	$permissions[$role_permission['id']] = $role_permission['module_name'];    		   
	}
	// clear the results	    			
	$mysql->clear_result($result);
}catch(Exception $e){
	echo 'Caught exception: ',  $e->getMessage(), "\n";
}
$smarty->assign('permissions',$permissions);

// closing mysql
$mysql->close_connection();

// assign page title
$smarty->assign('page_title' , 'Edit Role - IT');  
// assigning active class status to smarty menu.tpl
$smarty->assign('settings_active' , 'active'); 	  
// display smarty file
$smarty->display('edit_role.tpl');
?>
