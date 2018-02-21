<?php
/* 
Purpose : To Delete software type.
Created : Nikitasa
Date : 15-06-2016
*/

include 'configs/smartyconfig.php';
// include mysql class
include('classes/class.mysql.php');
// Connecting Database
$mysql->connect_database();
// include function validation class
include('classes/class.function.php');

if(isset($_GET['id'])){
   // get record id   
	$id = $_GET['id'];
	if(($fun->isnumeric($id)) || ($fun->is_empty($id)) || ($id == 0)){
  		header('Location:page_error.php');
	}

   // Escapes special characters in a string for use in an SQL statement
	$id = $mysql->real_escape_str($id);
	
	// check assigned software type
 	$query = "call it_check_sw_type_assigned('".$id."')";
   try{
		if(!$result = $mysql->execute_query($query)){
			throw new Exception('Problem in checking assigned software type');
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
   	// delete records
 		$query = "CALL it_delete_software_type('".$id."')";

   	try{
			if(!$result = $mysql->execute_query($query)){
				throw new Exception('Problem in deleting');
			}  
   		header('Location:software_type.php?page='.$_GET['page'].'&status=deleted');
   	}catch(Exception $e){
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}	
	}else{
		header('Location:software_type.php?page='.$_GET['page'].'&status=not_deleted');
	}	
}
$c_c = $mysql->close_connection();
?>