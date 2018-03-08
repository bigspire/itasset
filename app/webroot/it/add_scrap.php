<?php
/* 
Purpose : To add scrap.
Created : Nikitasa
Date : 27-06-2016
*/

session_start();
include 'configs/smartyconfig.php';
// include mysql class
include('classes/class.mysql.php');
// Connecting Database
$mysql->connect_database();
// include function validation class
include('classes/class.function.php');
// include permission file
include 'include/get_modules.php';
include 'include/menu_count.php';
// mailing class
include('classes/class.mailer.php');
// content class
include('classes/class.content.php');

// redirect to error page if the user is not it admin
if($roleid != '21'){
	// header('Location:'.IT_DIR.'home/');
}

// get scrap type and assign to smarty variable 
$_SESSION['scrap_type'] = $_GET['scrap_type'];
$smarty->assign('scrap_type', $_SESSION['scrap_type']);

if(!empty($_POST)){
	
	if(!empty($_POST['message'])){
      $smarty->assign('message',$_POST['message']);
    }else{
      $smarty->assign('messageErr','Please enter the comments');
    }
	if(!empty($_POST['hw_type'])){
      $smarty->assign('hw_type',$_POST['hw_type']);
    }else{
      $smarty->assign('hw_typeErr','Please select the hardware type');
    }
}

if(isset($_GET['id']) && !empty($_POST['message'])){
   // get record id   
	$hw_id = $_GET['id'];
	if(($fun->isnumeric($hw_id)) || ($fun->is_empty($hw_id)) || ($hw_id == 0)){
  		// header('Location:page_error.php');
	}
	// Escapes special characters in a string for use in an SQL statement
	$created_dat = $fun->current_date($date);
	$created_date = $mysql->real_escape_str($created_dat);
	$msg = $mysql->real_escape_str($_POST['message']);
	$hw_id = $mysql->real_escape_str($hw_id);
	$status = 'W';
	// check assigned hardware
 	$query = "call it_check_hardware_assigned('".$hw_id."')";
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
 		$query = "CALL it_add_scrap_hardware('".$_POST['hw_type']."','".$msg."','".$status."','".$created_date."','".$_SESSION['user_id']."','".$hw_id."')";
		try{
			if(!$result = $mysql->execute_query($query)){
				throw new Exception('Problem in executing add hardware query');
			}
			$row = $mysql->display_result($result);
			$last_id = $row['inserted_id'];
			// free the memory
			$mysql->clear_result($result);
			// execute next query
			$mysql->next_query();
		}catch(Exception $e){
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
		
		
		// fetch the director details 
		$query = "call it_get_director_role_id()";
		try{
			if(!$result = $mysql->execute_query($query)){
				throw new Exception('Problem in getting director role id');
			}
			$direc = $mysql->display_result($result);
			// free the memory
			$mysql->clear_result($result);
			// execute next query
			$mysql->next_query();
		}catch(Exception $e){
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
		
		// fetch the director details 
		$query = "call it_get_director_details('".$direc['id']."')";
		try{
			if(!$result = $mysql->execute_query($query)){
				throw new Exception('Problem in getting director details');
			}
			$obj = $mysql->display_result($result);
			$director_name = $obj['director_name'];
			$email_address = $obj['email_address'];
			// free the memory
			$mysql->clear_result($result);
			// call the next result
			$mysql->next_query();
		}catch(Exception $e){
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
		
		// get the admin details
		$query = "CALL it_get_admin_name('21')";
		try{
				if(!$result = $mysql->execute_query($query)){
					throw new Exception('Problem in executing admin details');
				}
				// calling mysql fetch_result function
				$obj = $mysql->display_result($result);
				$_SESSION['admin_name'] = $obj['emp_name'];
				$admin_email = $obj['email_address'];						
				$admin_name = $_SESSION['admin_name'];
				// free the memory
				$mysql->clear_result($result);
				// call the next result
				$mysql->next_query();
		}catch(Exception $e){
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
		
		if(!empty($last_id)){
			// send mail to admin
			$sub = 'Hardware details Received From '.$admin_name;
			$msg = $content->get_scrap_hw_mail($_POST,$director_name,$admin_name);
			$mailer->send_mail($sub,$msg,$admin_name,$admin_email,$director_name,$email_address ,'','');
			$suc = '1';
		}	
		
		if($suc == '1'){
			$smarty->assign('form_sent' , 1);
		}else{
			echo "error";die;
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