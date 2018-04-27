<?php
/* 
Purpose : To add role.
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

// redirect to error page if the user is not it admin
if($roleid != '21'){
	header('Location:'.IT_DIR.'home/');
}
// redirecting to dashboard if the user don't have the permission to this module
if(empty($_SESSION['SettingsRoles'])){
	header('Location:../home/?access=Access denied!');
}

if(!empty($_POST)){
	// Validating the required fields  
	// array for printing correct field name in error message
	$fieldtype = array('0','1');
	$actualfield = array('role name ', 'status');
   $field = array('role_name' => 'role_nameErr', 'status' => 'statusErr');
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
 	if(empty($_POST['permission'])){
 		$permissionErr = 'Please select the permissions';
 		$smarty->assign('permissionErr',$permissionErr);
 		$test = 'error';
 	}else{
 		$permission_ar = array(); 
 		$permission_ar = $_POST['permission'];
 		$smarty->assign('permission_ar',$permission_ar);
	}
	// assigning the date
	$date =  $fun->current_date();
	// query to check whether it is exist or not. 
	$query = "CALL it_check_role_exist('0', '".$_POST['role_name']."')";
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
			$query = "CALL it_add_role('".$mysql->real_escape_str($_POST['role_name'])."', '".$mysql->real_escape_str($_POST['description'])."', 
	 		'".$mysql->real_escape_str($_POST['status'])."', '".$date."', '1', '1')";
			// Calling the function that makes the insert
			try{
				// calling mysql exe_query function
				if(!$result = $mysql->execute_query($query)){
					throw new Exception('Problem in executing add role');
				}
				$row = $mysql->display_result($result);
				$app_roles_id = $row['inserted_id'];
				if(!empty($app_roles_id)){
					// clear the results	    			
					//$mysql->clear_result($result);										
					// next query execution
					$mysql->next_query();
					foreach($permission_ar as $key => $val){
	
						// query to insert in to database. 
						$query = "CALL it_add_permissions('".$date."', '1', '".$mysql->real_escape_str($val)."', '".$mysql->real_escape_str($app_roles_id)."')";
						// Calling the function that makes the insert
						try{
							// calling mysql exe_query function
							if(!$result2 = $mysql->execute_query($query)){ 
								throw new Exception('Problem in executing add permissions');
							}
							$row = $mysql->display_result($result2);
							// free the memory
							$mysql->clear_result($result2);
							// call the next result
							$mysql->next_query();
						}catch(Exception $e){
							echo 'Caught exception: ',  $e->getMessage(), "\n";
							die;
						}
					}
					$last_id = $row['inserted_id'];
					if(!empty($last_id)){
						// redirecting to view page
						 header('Location: list_role.php?status=created');		
					}
				}// free the memory
				$mysql->clear_result($result);
				// call the next result
				$mysql->next_query();
			}catch(Exception $e){
				echo 'Caught exception: ',  $e->getMessage(), "\n";
				die;
			}
		}else{
			$msg = "Role name is already exists";
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
		throw new Exception('Problem in executing get permissions');
	}
	$permissions = array();
	while($role_permission = $mysql->display_result($result)){
    	$permissions[$role_permission['id']] = $role_permission['module_name'];    		   
	}

	$smarty->assign('permissions',$permissions);
	// free the memory
	$mysql->clear_result($result);
	// call the next result
	$mysql->next_query();
}catch(Exception $e){
	echo 'Caught exception: ',  $e->getMessage(), "\n";
}

// closing mysql
$mysql->close_connection();

// assign page title
$smarty->assign('page_title' , 'Add Role - IT');  
// assigning active class status to smarty menu.tpl
$smarty->assign('settings_active' , 'active'); 	  
// display smarty file
$smarty->display('add_role.tpl');
?>