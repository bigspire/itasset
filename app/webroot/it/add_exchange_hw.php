<?php
/* 
Purpose : To add lost/exchange scrap hardware.
Created : Nikitasa
Date : 7-03-2018
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

// smarty drop down for hardware types

/*

$query = 'CALL it_get_hardware_type()';
try{
	// calling mysql exe_query function
	if(!$result = $mysql->execute_query($query)){
		throw new Exception('Problem in executing get hardware type');
	}
	$hw_type = array();
	while($hw = $mysql->display_result($result)){
    	$hw_type[$hw['id']] = ucfirst($hw['title']);    		   
	}
	$smarty->assign('hw_type',$hw_type);
	// free the memory
	$mysql->clear_result($result);
	// call the next result
	$mysql->next_query();
}catch(Exception $e){
	echo 'Caught exception: ',  $e->getMessage(), "\n";
}
*/


if(isset($_GET['id'])){
	 // get record id   
	$hw_id = $_GET['id'];		
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

	if($row['total']){
		$smarty->assign('form_sent', 2);
	}
}
	
	
if(!empty($_POST)){
	
	// get the selected inventory
	/*
	$query = "CALL it_get_inventory_byid('".$_POST['hwtype']."')";
	try{
		// calling mysql exe_query function
		if(!$result = $mysql->execute_query($query)){
			throw new Exception('Problem in getting inventory details');
		}
		$inventory = array();
		while($obj = $mysql->display_result($result)){
			$inventory[$obj['id'].'-'.$obj['brand_id']] = $obj['inventory_no'].' ('.$obj['brand'].')';  	   
		}	   
		$smarty->assign('h_inventory',$inventory);
		// free the memory
		$mysql->clear_result($result);
		
	}catch(Exception $e){
		echo 'Caught exception: ',  $e->getMessage(), "\n";
	}	
	*/
	
	
	/*
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
	*/
	
	/*
	$fieldtype = array('1', '0', '1','1', '0', '0');
	$actualfield = array('type', 'cost', 'payment type','payment date','bill no','company','email','contact no','contact person','city','address');
   $field = array('hw_type' => 'hw_typeErr', 'cost' => 'costErr', 'pay_type' => 'paymentErr','paid_date' => 'amountErr','bill_no' => 'bill_noErr',
   'company' => 'companyErr','email' => 'emailErr','contact' => 'contactErr','person' => 'personErr'
   ,'city' => 'cityErr','address' => 'addressErr');
   */
   
   
   $fieldtype = array('1', '0', '0');
   $actualfield = array('type', 'cost', 'message');
   $field = array('hw_type' => 'hw_typeErr', 'cost' => 'costErr', 'desc' => 'descErr');
   
   
	$j = 0;

	foreach ($field as $field => $er_var){ 
		if($_POST[$field] == ''){
			$error_msg = $fieldtype[$j] ? ' select the ' : ' enter the ';
			$actual_field =  $actualfield[$j];
			$er[$er_var] = 'Please'. $error_msg .$actual_field;
			$smarty->assign($er_var,$er[$er_var]);
			$test = 'error';
		}else{
			$smarty->assign($field,$_POST[$field]);	
			$test = '';
		}
		$j++;
	}
	
	// validate the new hardware 
	if($_POST['hw_type'] == 'EX'){ 
		if($_POST['new_hw'] == ''){
			$smarty->assign('new_hwErr', 'Please enter the new hardware details');
			$test = 'error';
		}
	}
	
	// bill and warranty upload and validation
	// upload directory
	$uploaddir = 'uploads/exchange/'; 
	$uploadbill = $uploaddir . basename($_FILES['attach_bill']['name']); 
	$billfile = $_FILES['attach_bill']['name'];
	$billsize = $_FILES['attach_bill']['size'];
	$billtype = $_FILES['attach_bill']['type'];
	// required size for validation 			
	$req_size = 1048576;
	if($billfile != ''){
		// Bill file name assigning as session variable
		$size = $billsize;
		$attach_file = 'attach_bill';
		// retaining the upload file name
		if($fun->is_empty($billfile) == true){
			$billuploadErr = 'Not uploaded the bill file';
			$test = 'error';
		}else{
			// file extensions
			$extensions = array('jpeg','jpg','png','gif','pdf','zip'); 
			$bill_ext = explode('/',$billtype)	;
			$bill_ext = end($bill_ext); 
			// checking the file extension is jpg,jpeg,pdf,zip or png
			$file_ext = $bill_ext;
			if($fun->extension_validation($file_ext,$extensions) == true){		
				$billuploadErr = 'Attach bill must be jpg, jpeg, png, gif, pdf,zip';
				$test = 'error';
			}
			// checking the file size is less than 1 MB
			else if($fun->size_validation($size,$req_size)){
				$billuploadErr = 'Bill file size must be less than 1 MB';
				$test = 'error';
			}	
			// checking whether the upload directory is there or not.
			else if($fun->check_uploaded($uploaddir)){
				$billuploadErr = 'The directory does not exist';
				$test = 'error';
			}
			// uploading file if there is no error
			else{
							
			}
		} 
	}else{
		$billuploadErr = 'Please attach the file';
	}
	$smarty->assign('billuploadErr',$billuploadErr);


	if(isset($_GET['id']) && $test == ''){
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
			
			$query = "CALL it_add_exchange_hardware(
						'".$_POST['hw_type']."',
						'".$_POST['cost']."',
						'W',
						'".$created_date."',
						'".$_SESSION['user_id']."',
						'".$_POST['payment_type']."',
						'".$_POST['amount_receive_date']."',
						'".$_POST['vendor_company']."',
						'".$_POST['vendor_email']."',
						'".$_POST['vendor_phone']."',
						'".$_POST['vendor_city']."',
						'".$_POST['vendor_person']."',
						'".$_POST['bill_no']."',
						'".$_POST['bill_file']."',
						'".$_POST['desc']."',
						'".$_POST['new_hw']."',
						'".$hw_id."'
						)";
			try{
				if(!$result = $mysql->execute_query($query)){
					throw new Exception('Problem in executing add exchange h/w query');
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
			
			move_uploaded_file($_FILES['attach_bill']['tmp_name'], $uploadbill);	
			
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
				$msg = $content->get_approve_scrap_hwmail_details($_POST,$director_name,$admin_name);
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

}
// calling mysql close db connection function
$c_c = $mysql->close_connection();
// display smarty file
$smarty->display('add_exchange_hw.tpl');
?>