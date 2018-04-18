<?php
/* 
Purpose : To add the billing hardware details.
Created : Nikitasa
Date : 18-04-2018
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

// redirecting to dashboard if the user don't have the permission to this module
if(empty($_SESSION['Billing'])){
	header('Location:dashboard.php?access=Access denied!');
}

if(!empty($_POST)){
	
	// Validating the required fields  
	// array for printing correct field name in error message
	$fieldtype = array('1', '0', '1', '1', '0', '0','0','0');
	$actualfield = array('type', 'amount', 'payment type', 'inventory no','bill date','bill copy', 'bill no', 'company name');
	$field = array('hardware_type_id' => 'hardware_type_idErr', 'amount' => 'amountErr','payment_type' => 'payment_typeErr', 
	'it_brand_id' => 'it_brand_idErr','bill_date' => 'bill_dateErr', 'bill_copy' => 'bill_copyErr','bill_no' => 'bill_noErr','company_name' => 'company_nameErr');
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

	// query to check whether it is exist or not. 
	/* $query = "CALL it_check_model_id_exist('0','".$_POST['model_id']."')";
	try{
		// calling mysql exe_query function
		if(!$result = $mysql->execute_query($query)){ 
			throw new Exception('Problem in checking exist model id');
		}
		$row = $mysql->display_result($result);	
		// free the memory
		$mysql->clear_result($result);
		// next query execution
		$mysql->next_query();
	}catch(Exception $e){
		echo 'Caught exception: ',  $e->getMessage(), "\n";
	} */
	
	if(empty($test)){
		// if($row['total'] == '0'){
			// assigning the date
			$date = date('Y-m-d h:i:s');
			$mysql->next_query();
			// query to insert into database. 
			$query = "CALL it_add_billing('".$mysql->real_escape_str($_POST['hardware_type_id'])."', '".$mysql->real_escape_str($_POST['amount'])."', 
			'".$mysql->real_escape_str($_POST['payment_type'])."','".$mysql->real_escape_str($_POST['description'])."','".$mysql->real_escape_str($_POST['it_brand_id'])."',
			'".$mysql->real_escape_str($_POST['bill_date'])."','".$mysql->real_escape_str($_POST['bill_copy'])."',
			'".$mysql->real_escape_str($_POST['bill_no'])."','".$mysql->real_escape_str($_POST['company_name'])."'
			'".$mysql->real_escape_str($_POST['email_id'])."','".$mysql->real_escape_str($_POST['company_contact'])."','".$mysql->real_escape_str($_POST['contact_per'])."',
			'".$mysql->real_escape_str($_POST['city'])."','".$mysql->real_escape_str($_POST['address'])."','".$mysql->real_escape_str($_SESSION['user_id'])."','".$date."')";
			// Calling the function that makes the insert
			try{
				// calling mysql exe_query function
				if(!$result = $mysql->execute_query($query)){
					throw new Exception('Problem in executing add billing');
				}
				$row = $mysql->display_result($result);
				$last_id = $row['inserted_id'];
				if(!empty($last_id)){
					// redirecting to view page
					header('Location: list_billing.php?status=created');		
				}
				// free the memory
				$mysql->clear_result($result);
			}catch(Exception $e){
				echo 'Caught exception: ',  $e->getMessage(), "\n";
			}
		//}else{
			// $msg = "Brand title already exists";
			// $smarty->assign('EXIST_MSG',$msg); 
		//}	
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
$query = "call it_get_brand('H')";
try{
	// calling mysql exe_query function
	if(!$result = $mysql->execute_query($query)){
		throw new Exception('Problem in executing get hardware brand');
	}
	$brand = array();
	while($row = $mysql->display_result($result)){
  		$brand[$row['id']] = ucwords($row['title']);    		   
	}
	$smarty->assign('hw_brand',$brand);
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
// check rental 
if($_SESSION['h']['add_hardware_type'] == ''){
	if($_GET['type'] == '' || $_GET['type'] == 'new'){
		$_SESSION['h']['add_hardware_type'] = 'New';
	}else{
		$_SESSION['h']['add_hardware_type'] = 'Rental';
	}
}

$billing_type = array('RS' => 'Resale', 'EX' => 'Exchange', 'R' => 'Rental'); 
$smarty->assign('billingType', $billing_type);


$pay_types = array('CQ' => 'Cheque', 'CA' => 'Cash', 'OT' => 'Online Transfer', 'CC' => 'Credit Card', 'other' => 'Other'); 
$smarty->assign('pay_types', $pay_types);
// closing mysql
$mysql->close_connection();
$smarty->assign('page_title' , 'Add Billing Hardware - IT'); 
$smarty->assign('hardware_active','active'); 
$smarty->display('add_billing_hardware_details.tpl');
?>