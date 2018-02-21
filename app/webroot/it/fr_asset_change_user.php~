<?php
/* 
Purpose : To change asset in front end.
Created : Nikitasa
Date : 03-07-2016
*/

//include smarty congig file
include 'configs/smartyconfig.php';
// include mysql class
include('classes/class.mysql.php');
// Connecting Database
$mysql->connect_database();
// include function validation class
include('classes/class.function.php');
// include paging class 
include('classes/class.paging.php');
// mailing class
include('classes/class.mailer.php');
// content class
include('classes/class.content.php');


if(!empty($_POST['submit'])){
	// Priority Field Validation
   if($fun->not_empty($_POST['message'])){
      $smarty->assign('message' , $_POST['message']);
   }else{
      $smarty->assign('messageErr' , 'Please enter the message');
   }
}

// get user id
$user_id = $fun->get_user_id();
$status = 'O';   	   		
// details created date and time 
$created_date = $fun->current_date($date);   
// Escapes special characters in a string for use in an SQL statement
$message = $mysql->real_escape_str($_POST['message']);
$type = $mysql->real_escape_str($_GET['type']);

if(!empty($_POST['message'])){	
      // query to insert into database. 
		$query = "CALL it_add_change_emp('".$message."','".$type."','".$created_date."','".$status."','".$user_id."')";
		// Calling the function that makes the insert
		try{
			// calling mysql exe_query function
			if(!$result = $mysql->execute_query($query)){
				$alert_msg1 = 'Oops! Problem in saving the data. Pls check the errors.';
			}else{
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
			   // get the current user details
				$query = "CALL it_get_app_user('".$user_id."')";
				try{
						if(!$result = $mysql->execute_query($query)){
							throw new Exception('Problem in executing app user');
						}
						// calling mysql fetch_result function
						$obj = $mysql->display_result($result);
						$_SESSION['user_name'] = $obj['first_name'].' '.$obj['last_name'];
						$user_email = $obj['email_address'];						
						$user_name = $_SESSION['user_name'];
						// free the memory
						$mysql->clear_result($result);
				}catch(Exception $e){
					echo 'Caught exception: ',  $e->getMessage(), "\n";
				}
				// send mail to admin
				$sub = 'Change Asset Request Received From '.' '.$user_name;
				$msg = $content->get_change_asset_mail($_POST,$user_name,$admin_name);
				$mailer->send_mail($sub,$msg,$user_name,$user_email ,$admin_name,$admin_email,'','');	
				$alert_msg = 'Change asset request created and sent to admin successfully. ';	
				$smarty->assign('form_sent' , 1);
			}
		}catch(Exception $e){
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}					
}		  		 
	
// calling mysql close db connection function
$c_c = $mysql->close_connection();
$smarty->assign('ALERT_MSG1' , $alert_msg1);
$smarty->assign('ALERT_MSG' , $alert_msg);
$smarty->assign('get_type' , $_GET['type']);
$smarty->display('fr_asset_change_user.tpl');
?>