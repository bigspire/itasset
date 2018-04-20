<?php
/* 
Purpose : To add the billing hardware details.
Created : Nikitasa
Date : 19-04-2018
*/

// starting the session
session_start();
// including smarty config
include 'configs/smartyconfig.php';
// inclusing Database class file
include('classes/class.mysql.php');
$mysql->connect_database();
// Validating fields using class.function.php
include('classes/class.function.php');
//include menu_count file
include 'include/menu_count.php';
// include permission file
include 'include/get_modules.php';
// mailing class
include('classes/class.mailer.php');
// content class
include('classes/class.content.php');

// redirecting to dashboard if the user don't have the permission to this module
if(empty($_SESSION['Billing'])){
	header('Location:dashboard.php?access=Access denied!');
}

if(!empty($_POST)){
	
	// validating the required fields
	if(!isset($_POST['bill_copy']) && empty($_FILES['bill_copy']['name'])){
		$smarty->assign('bill_copyErr', 'Please upload the bill copy');	
		$test = 'error';			
	}
	
	// validating the required fields
	if(($_POST['payment_type'] == 'other') && (empty($_POST['payment_details']))){
		$smarty->assign('payment_detailsErr', 'Please enter the payment detials');	
		$test = 'error';			
	}
	
	// Validating the required fields  
	// array for printing correct field name in error message
	$fieldtype = array('1', '0', '1', '1', '0', '0','0');
	$actualfield = array('type', 'amount', 'payment type', 'inventory no','bill date', 'bill no', 'company name');
	$field = array('hardware_type_id' => 'hardware_type_idErr', 'amount' => 'amountErr','payment_type' => 'payment_typeErr', 
	'it_brand_id' => 'it_brand_idErr','bill_date' => 'bill_dateErr','bill_no' => 'bill_noErr','company_name' => 'company_nameErr');
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
	
	 $req_size = 1048576;
	// upload the file if attached
	if(!empty($_FILES['bill_copy']['name'])){
		// upload directory
		$uploaddir = 'uploads/bill_copy/'; 
		$attachmentsize = $_FILES['bill_copy']['size'];
		$attachmenttype = $_FILES['bill_copy']['type'];		
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
	
	// getting invetory no details
	$inv_arr  = $_POST['it_brand_id'];
	$inv_details = explode("-", $inv_arr);
	$invent =  $inv_details[0]; 
		
	// query to check whether it is exist or not. 
	$query = "CALL it_check_bill_exist('".$fun->convert_date($_POST['bill_date'])."','".$invent."')";
	try{
		// calling mysql exe_query function
		if(!$result = $mysql->execute_query($query)){ 
			throw new Exception('Problem in checking exist billing');
		}
		$row = $mysql->display_result($result);	
		// free the memory
		$mysql->clear_result($result);
		// next query execution
		$mysql->next_query();
	}catch(Exception $e){
		echo 'Caught exception: ',  $e->getMessage(), "\n";
	}
	
	if(empty($test)){
		if($row['total'] == '0'){
			// assigning the date
			$date = date('Y-m-d h:i:s');
			$mysql->next_query();
			// query to insert into database. 
			$query = "CALL it_add_billing('".$mysql->real_escape_str($_POST['hardware_type_id'])."', '".$mysql->real_escape_str($_POST['amount'])."', 
			'".$mysql->real_escape_str($_POST['payment_type'])."','".$mysql->real_escape_str($_POST['payment_details'])."','".$mysql->real_escape_str($_POST['description'])."','".$mysql->real_escape_str($invent)."',
			'".$mysql->real_escape_str($fun->convert_date($_POST['bill_date']))."','".$mysql->real_escape_str($_POST['bill_no'])."',
			'".$mysql->real_escape_str($_POST['company_name'])."','".$mysql->real_escape_str($_POST['email_id'])."',
			'".$mysql->real_escape_str($_POST['company_contact'])."','".$mysql->real_escape_str($_POST['contact_per'])."',
			'".$mysql->real_escape_str($_POST['city'])."','".$mysql->real_escape_str($_POST['address'])."','".$mysql->real_escape_str($_SESSION['user_id'])."','".$date."','N')";
			// Calling the function that makes the insert
			try{
				// calling mysql exe_query function
				if(!$result = $mysql->execute_query($query)){
					throw new Exception('Problem in executing add billing');
				}
				$row = $mysql->display_result($result);
				$last_id = $row['inserted_id'];
				// free the memory
				$mysql->clear_result($result);
				// call the next result
				$mysql->next_query();
			}catch(Exception $e){
				echo 'Caught exception: ',  $e->getMessage(), "\n";
			}
			
			// update the attached file
			if(!empty($_FILES['bill_copy']['name'])){
				$new_file = $last_id.'_'.$_FILES['bill_copy']['name'];
				// upload the file
				$path = $uploaddir.$new_file;
				move_uploaded_file($_FILES['bill_copy']['tmp_name'], $path);
				// query to update the file
				$query = "CALL it_update_bill_copy('".$last_id."','".$new_file."')";
				try{
					if(!$result = $mysql->execute_query($query)){
						throw new Exception('Problem in updating bill copy');
					}
					// call the next result
					$mysql->next_query();
				}catch(Exception $e){
					echo 'Caught exception: ',  $e->getMessage(), "\n";
				}
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
			$suc = '1';
			if(!empty($last_id)){
				// send mail to admin
				$sub = 'Billing Created By '.$admin_name;
				$msg = $content->get_billing_mail($_POST,$director_name,$admin_name);
				$mailer->send_mail($sub,$msg,$admin_name,$admin_email,$director_name,$email_address ,'','');
				$suc = '2';
			}
			
			if($suc == '2'){ 
				// redirecting to list page
				header("Location: list_billing.php?status=created");		
			}
		}else{
			$msg = "Billing already added for the inventory";
			$smarty->assign('EXIST_MSG',$msg); 
		}	
	}
}
// smarty dropdown for hardware type
$query = 'call it_get_hardware_type()';
try{
	// calling mysql exe_query function
	if(!$result = $mysql->execute_query($query)){
		throw new Exception('Problem in executing get hardware type');
	}
	$rows = array();
	while($row = $mysql->display_result($result)){
    	$rows[$row['id']] = ucwords($row['title']);    		   
	}
	$smarty->assign('row',$rows);
	// free the memory
	$mysql->clear_result($result);
	// call the next result
	$mysql->next_query();
}catch(Exception $e){
	echo 'Caught exception: ',  $e->getMessage(), "\n";
}
	
// smarty dropdown for hardware brand
$query = "call it_get_billing_inventory('".$_POST['hardware_type_id']."')";
try{
	// calling mysql exe_query function
	if(!$result = $mysql->execute_query($query)){
		throw new Exception('Problem in executing get hardware brand');
	}
	$inventory = array();
	while($obj = $mysql->display_result($result)){ 
		if($obj['inventory_no'] != ''){
			$inventory[$obj['id'].'-'.$obj['brand_id']] = $obj['inventory_no'].' ('.$obj['brand'].')';  
		}
	}
	$smarty->assign('hw_brand',$inventory);
	// free the memory
	$mysql->clear_result($result);
}catch(Exception $e){
	echo 'Caught exception: ',  $e->getMessage(), "\n";
}
// smarty dropdown array for status
$smarty->assign('login_status', array('' => 'Select', '1' => 'Active', '0' => 'Inactive'));
// status field validation
$_SESSION['h']['status'] = isset($_POST['status']) ? $_POST['status'] : ($_GET['status'] != '' ? $_GET['status'] : '1');

// smarty dropdown array for Subscription validity
$smarty->assign('subscription_validity', array('' => 'Select', '0' => 'Life Time', '0.1' => '30 Days', '0.3' => '3 Months', 
'0.6' => '6 Months', '0.9' => '9 Months', '1' => '1 Year', '2' => '2 Years', '3' => '3 Years', '4' => '4 Years', 
'5' => '5 Years'));

$billing_type = array('RS' => 'Resale', 'EX' => 'Exchange', 'R' => 'Rental'); 
$smarty->assign('billingType', $billing_type);

$pay_types = array('CQ' => 'Cheque', 'CA' => 'Cash', 'OT' => 'Online Transfer', 'CC' => 'Credit Card', 'OTH' => 'Other'); 
$smarty->assign('pay_types', $pay_types);
// closing mysql
$mysql->close_connection();
$smarty->assign('page_title' , 'Add Billing Hardware - IT'); 
$smarty->assign('hardware_active','active'); 
$smarty->display('add_billing_hardware_details.tpl');
?>