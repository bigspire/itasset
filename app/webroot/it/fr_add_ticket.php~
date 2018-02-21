<?php
/* 
Purpose : To add ticket in front end.
Created : Nikitasa
Date : 02-07-2016
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

// get user id
$user_id = $fun->get_user_id();

// fetch all data from get_ticket_type
$query = 'call it_get_ticket_type()';
try{
	if(!$result = $mysql->execute_query($query)){
		throw new Exception('Problem in executing get ticket type');
	}
	$it_ticket_type[''] = 'Select';
	while($obj = $mysql->display_result($result))
	{
 		$it_ticket_type[$obj['id']] = $obj['type'];
	}

	// free the memory
	$mysql->clear_result($result);
	// call the next result
	$mysql->next_query();
}catch(Exception $e){
	echo 'Caught exception: ',  $e->getMessage(), "\n";
}
if(!empty($_POST['submit'])){
	$submit = true;
    // Priority Field Validation
    if($fun->not_empty($_POST['priority'])){
		$smarty->assign('priority' , $_POST['priority']);
     }else{
      $smarty->assign('priorityErr' , 'Please select the priority');
		$submit = false;
     }
	 
	 // Subject Field Validation
	 if($fun->not_empty($_POST['subject'])){
		$smarty->assign('subject' , $_POST['subject']);
	 }else{
		 $smarty->assign('subjectErr', 'Please enter the subject');
		 $submit = false;
	 }

	  // description field Validation		
  	  if($fun->not_empty($_POST['description'])){
		$smarty->assign('description', $_POST['description']);
	  }else{
		 $smarty->assign('descriptionErr', 'Please enter the description');
		$submit = false;
	  } 

	  // ticket type field Validation		
  	 if($fun->not_empty($_POST['it_ticket_type'])){
		$smarty->assign('ticket', $_POST['it_ticket_type']);
	 }else{
		$smarty->assign('ticket_typeErr', 'Please select the ticket type');
		$submit = false;
	 }
	 
	 $req_size = 1048576;
	// upload the file if attached
	if(!empty($_FILES['ticket_file']['name'])){
		// upload directory
		$uploaddir = 'uploads/ticket/'; 
		$attachmentsize = $_FILES['ticket_file']['size'];
		$attachmenttype = $_FILES['ticket_file']['type'];		
		// file extensions
		$extensions = array('jpeg','jpg','png','gif','pdf','zip'); 
		$attachment_ext = explode('/', $attachmenttype)	;
		$attach_ext = end($attachment_ext); 
		// checking the file extension is jpg,jpeg,pdf,zip or png
		if($fun->extension_validation($attach_ext,$extensions) == true){		
			$attachmentuploadErr = 'Attachment must be jpg, jpeg, png, gif, pdf, zip';
			$submit = false;
		}
		// checking the file size is less than 1 MB		
		else if($fun->size_validation($attachmentsize,$req_size)){
			$attachmentuploadErr = 'Attachment file size must be less than 1 MB';
			$submit = false;
		}				
	}	
	$smarty->assign('attachmentuploadErr', $attachmentuploadErr);
}
     		
// details created date and time 
$created_date = $fun->current_date($date);
	   
if($submit == true){	
   $attach_file = $_FILES['ticket_file']['name'];  		
   // query to insert into database. 
	$query = "CALL it_add_ticket('".$mysql->real_escape_str($_POST['subject'])."','".$mysql->real_escape_str($_POST['priority'])."',
				'".$mysql->real_escape_str($_POST['description'])."','".$created_date."',
				'".$mysql->real_escape_str($_POST['it_ticket_type'])."','".$user_id."')";
	// Calling the function that makes the insert
	try{
		// calling mysql exe_query function
		if(!$result = $mysql->execute_query($query)){
			$alert_msg1 = 'Problem in saving the ticket. Pls check the errors.';
			//throw new Exception('Problem in executing add brand');	
		}
		$obj = $mysql->display_result($result);
		// free the memory
		$mysql->clear_result($result);
		// call the next result
		$mysql->next_query();
	}catch(Exception $e){
		echo 'Caught exception: ',  $e->getMessage(), "\n";
	}			
	$last_id = $obj['inserted_id'];
	
	// update the attached file
	if(!empty($_FILES['ticket_file']['name'])){
		$new_file = $last_id.'_'.$_FILES['ticket_file']['name'];
		// upload the file
		$path = $uploaddir.$new_file;
		move_uploaded_file($_FILES['ticket_file']['tmp_name'], $path);
		// query to update the file
		$query = "CALL it_update_ticket_file('".$last_id."','".$new_file."')";
		try{
			if(!$result = $mysql->execute_query($query)){
				throw new Exception('Problem in updating ticket file');
			}
			// call the next result
			$mysql->next_query();
		}catch(Exception $e){
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
	}
	
	// assign message field as empty as it is not required
	$msg = 0;
	// write the query to update the ticket status is recent to 1
	$query = "CALL it_add_ticket_status_id('".$created_date."','".$last_id."','1','$msg')";
	try{
		if(!$result = $mysql->execute_query($query)){
			throw new Exception('Problem in executing ticket status page');
		}
		$alert_msg = 'Ticket created and sent to admin successfully!';
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
			// call the next result
			$mysql->next_query();
	}catch(Exception $e){
		echo 'Caught exception: ',  $e->getMessage(), "\n";
	}
	
	
	// send mail to admin
	$sub = 'Ticket Received From '.$user_name;
	
	// fetch the ticket types as per id 
	$query = "call it_get_ticket_type_emp('".$_POST['it_ticket_type']."')";
	try{
		if(!$result = $mysql->execute_query($query)){
			throw new Exception('Problem in executing ticket status page');
		}
		$obj = $mysql->display_result($result);
		$type_data = $obj['type'];
		// free the memory
		$mysql->clear_result($result);
	}catch(Exception $e){
		echo 'Caught exception: ',  $e->getMessage(), "\n";
	}
	$msg = $content->get_ticket_mail($_POST,$type_data,$user_name,$admin_name);
	$mailer->send_mail($sub,$msg,$user_name,$user_email ,$admin_name,$admin_email,$new_file,$path);
	$alert_msg = 'Ticket created and sent to admin successfully.';	
	$smarty->assign('form_sent' , 1);
}  
// assign software status into array 
$priority_type = array('' => 'Select', '1' => 'High', '2' => 'Medium', '3' => 'Low');
// calling mysql close db connection function
$c_c = $mysql->close_connection();
$smarty->assign('ALERT_MSG1' , $alert_msg1);
$smarty->assign('ALERT_MSG' , $alert_msg);
$smarty->assign('ticket_data' , $it_ticket_type);
$smarty->assign('priority_type' , $priority_type);
$smarty->display('fr_add_ticket.tpl');
?>