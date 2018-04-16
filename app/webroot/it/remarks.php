<?php
/* 
   Purpose : add remarks.
	Created : Nikitasa
	Date : 28-02-2018
*/

//session_destroy();
// session_start();

//include smarty congig file
include 'configs/smartyconfig.php';
// include mysql class
include('classes/class.mysql.php');
// Connecting Database
$mysql->connect_database();
// include function validation class
include('classes/class.function.php');
// include permission file
include 'include/get_modules.php';
// add menu count
include('menu_count.php');
// mailing class
include('classes/class.mailer.php');
// content class
include('classes/class.content.php');

// get and assign app user id
$_GET['user_id'];
$smarty->assign('user_id' , $_GET['user_id']);

if(!empty($_POST)){
	
	$error = true;
	// validate for reject option
	if(!empty($_POST) && $_GET['action'] == 'reject'){
		// remarks Field Validation
	   if($_POST['remarks'] == ''){     
		  $smarty->assign('remarksErr' , 'Please enter the remarks');  
		  $error = false;  
	   }
	}

	// details created date and time 
	$created_date = $fun->current_date($date);   

	// approve/reject status validation
	if($_GET['action'] == 'reject'){	
		$status = 'R';
		$is_scrap = '0';
		$form_sent = '2';
		$mail_status = 'Rejected by';
	}elseif($_GET['action'] == 'approve'){
		$status = 'A';
		$is_scrap = '1';
		$form_sent = '1';
		$mail_status = 'Approved by';
	}			
	
	if($error){
			// query to insert into database. 
			$query = "CALL edit_scrap_hardware('".$_GET['scrap_id']."','".$_POST['remarks']."','".$created_date."','".$_POST['user_id']."','".$status."')";
			// Calling the function that makes the insert
			try{
				// calling mysql exe_query function
				if(!$result = $mysql->execute_query($query)){
					throw new Exception('Problem in editing scrap details');
				}
				$row = $mysql->display_result($result);
				$scrap_id = $row['affected_rows'];				
				// free the memory
				$mysql->clear_result($result);
				// call the next result
				$mysql->next_query();
			}catch(Exception $e){
					echo 'Caught exception: ',  $e->getMessage(), "\n";
			}	

			// query to insert into database. 
			$query = "CALL it_edit_scrap_hw_inventory('".$_GET['inv_id']."','".$is_scrap."','".$created_date."')";
			// Calling the function that makes the insert
			try{
				// calling mysql exe_query function
				if(!$result = $mysql->execute_query($query)){
					throw new Exception('Problem in edit hardware inventory details');
				}
				$row = $mysql->display_result($result);
				$inv_id = $row['affected_rows'];				
				// free the memory
				$mysql->clear_result($result);
				// call the next result
				$mysql->next_query();
			}catch(Exception $e){
					echo 'Caught exception: ',  $e->getMessage(), "\n";
			}		
					
			// get the employee details
			$query = "CALL it_get_app_user('".$_POST['user_id']."')";
			try{
				if(!$result = $mysql->execute_query($query)){
					throw new Exception('Problem in getting employee details');
				}
				// calling mysql fetch_result function
				$obj = $mysql->display_result($result);
				$_SESSION['user_name'] = $obj['first_name'].' '.$obj['last_name'];
				$user_email = $obj['email_address'];			
				$user_name = ucwords($_SESSION['user_name']);
				// free the memory
				$mysql->clear_result($result);
				// call the next result
				$mysql->next_query();
			}catch(Exception $e){
				echo 'Caught exception: ',  $e->getMessage(), "\n";
			}
					
			// get the current user details
			$query = "CALL it_get_scrap_roles_user()";
			try{
				if(!$result = $mysql->execute_query($query)){
					throw new Exception('Problem in getting hardware module assigned users details');
				}
				// calling mysql fetch_result function
				while($account = $mysql->display_result($result)){
					$row_account[] = $account;
				}
				//$approval_user_email = $obj['approval_email'];						
				//$approval_user_name = ucwords($obj['approval_user']);
				// free the memory
				$mysql->clear_result($result);
				// call the next result
				$mysql->next_query();
			}catch(Exception $e){
				echo 'Caught exception: ',  $e->getMessage(), "\n";
			}
			
			
			if(($scrap_id != '0') || ($inv_id != '0')){
				foreach($row_account as  $assigned_user){ 					
					$sub = "Scrap Hardware ".$fun->it_scrap_hw_status($status). " by -  ".$user_name;
					$msg = $content->get_scrap_hw_mail_details($_POST,$assigned_user['user_name'],$user_name);
					$mailer->send_mail($sub,$msg,$assigned_user['user_name'],$assigned_user['email_address'],$user_name,$user_email,'','');	
				}
				$smarty->assign('form_sent' , $form_sent);	
				$url = $_GET['action'] == 'approve' ? 'list_approve_scrap_hardware.php?status=Approved' : 'list_approve_scrap_hardware.php?status=Rejected';
				$smarty->assign('redirect_url',$url);
			}		
	}							
	// closing mysql
	$mysql->close_connection();
}
// display smarty file
$smarty->display('remarks.tpl');
?>