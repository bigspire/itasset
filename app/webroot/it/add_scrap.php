<?php
/* 
Purpose : To add scrap.
Created : Nikitasa
Date : 27-06-2016
*/

include 'configs/smartyconfig.php';
// include mysql class
include('classes/class.mysql.php');
// Connecting Database
$mysql->connect_database();
// include function validation class
include('classes/class.function.php');
// include permission file
include 'include/get_modules.php';

// redirect to error page if the user is not it admin
if($roleid != '21'){
	// header('Location:'.IT_DIR.'home/');
}

if(empty($_POST)){
      $smarty->assign('message',$_POST['message']);
   }else{
      $smarty->assign('messageErr','Please enter the comments');
}

if(isset($_GET['id']) && !empty($_POST['message'])){
   // get record id   
	$id = $_GET['id'];
	if(($fun->isnumeric($id)) || ($fun->is_empty($id)) || ($id == 0)){
  		// header('Location:page_error.php');
	}
	// Escapes special characters in a string for use in an SQL statement
	$created_dat = $fun->current_date($date);
	$created_date = $mysql->real_escape_str($created_dat);
	$msg = $mysql->real_escape_str($_POST['message']);
	$id = $mysql->real_escape_str($id);
	
	// check assigned hardware
 	$query = "call it_check_hardware_assigned('".$id."')";
	try{
		if(!$result = $mysql->execute_query($query)){
			throw new Exception('Problem in checking assigned hardware');
		}  
		$row = $mysql->display_result($result);
		// clear the results	    			
		$mysql->clear_result($result);
		// next query execution
		$mysql->next_query();
	}catch(Exception $e){
		echo 'Caught exception: ',  $e->getMessage(), "\n";
	}

	if($row['total'] == '0'){
		// add hardware scrap
 		$query = "CALL it_add_scrap_hardware('".$hw_type."','".$msg."','".$status."','".$created_date."','".$app_users_id."','".$id."')";
		try{
			if(!$result = $mysql->execute_query($query)){
				throw new Exception('Problem in executing add hardware query');
			}
			$last_id = $row['inserted_id'];
			// free the memory
			$mysql->clear_result($result);
			// execute next query
			$mysql->next_query();
		}catch(Exception $e){
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
		
		if(!empty($last_id)){
			$smarty->assign('form_sent' , 1);
		}
		
		/*$query = "call it_edit_scrap_hardware('".$id."')";
		try{
			if(!$result = $mysql->execute_query($query)){
				throw new Exception('Problem in executing edit scrap query');
			}
			
			// header('Location:list_hardware.php?page='.$_GET['page'].'&status=moved');
			// free the memory
			$mysql->clear_result($result);
		}catch(Exception $e){
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}*/	
	}else{
		$smarty->assign('form_sent' , 2);
	}
}
// calling mysql close db connection function
$c_c = $mysql->close_connection();
// display smarty file
$smarty->display('add_scrap.tpl');
?>