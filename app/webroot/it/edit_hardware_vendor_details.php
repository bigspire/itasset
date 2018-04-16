<?php
/* 
Purpose : To add the hardware details.
Created : Gayathri
Modified : Nikitasa
Date : 16-06-2016
*/

session_start();

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

/*
// redirect to error page if the user is not it admin
if($roleid != '21'){
	header('Location:'.IT_DIR.'home/');
} */
// redirecting to dashboard if the user don't have the permission to this module
if(empty($_SESSION['Hardware'])){
	$_SESSION['e']['alert'] = 'Access denied!';
	header('Location:dashboard.php');
}
// starting the session
session_start();
// Selecting the record to edit
$getid = $_GET['id'];
$smarty->assign('getid',$getid);
$inv_id = $_GET['inv_id'];
$smarty->assign('invid',$inv_id);

// validate url 
if(($fun->isnumeric($getid)) || ($fun->is_empty($getid)) || ($getid == 0)){
  header('Location:page_error.php');
}
// get database values only when session has no values
if(empty($_SESSION['h']['vendor_name']) && empty($_POST)){
	$query = "CALL it_get_hardware($getid,'VD')";
	try{
		// calling mysql exe_query function
		if(!$result = $mysql->execute_query($query)){ 
			throw new Exception('Problem in executing get hardware');
		}
		$row = $mysql->display_result($result);
		$smarty->assign('rows',$row);
		// assign the db values into session
		foreach($row as $key => $record){
			$_SESSION['h'][$key] = $record; 
		}
		// free the memory
		$mysql->clear_result($result);
		// call the next result
		$mysql->next_query();
	}catch(Exception $e){
		echo 'Caught exception: ',  $e->getMessage(), "\n";
	}
}

if(!empty($_POST)){
	// Contact number size validation
	if($fun->size_of_phonenumber($_POST['vendor_phone']) == true){
		$er['contact_numberE'] = 'Please enter the valid size'; 
		$test = 'error';		
	}	
	// Contact number validation
	if($fun->is_phonenumber($_POST['vendor_phone']) == true){
		$er['contact_numberEr'] = 'Please enter the valid contact number'; 
		$test = 'error';		
	}
	// email validation
	if($fun->email_validation($_POST['vendor_email']) == true){
		$er['vendor_emailEr'] = 'Please enter the valid email'; 
		$test = 'error';		
	}	
	// assigning session variables  
   $field = array('vendor_phone', 'vendor_email', 'vendor_city', 'vendor_person', 'vendor_address');
	foreach ($field as $field){ 		
		$_SESSION['h'][$field] = $_POST[$field]; 
		$smarty->assign($field,$_SESSION[$field]);	
	}	
	// required field validation for company name
	if($_POST['vendor_name'] == ''){
		$er['vendor_nameErr'] = 'Please enter the company name';
		$test = 'error';
		$_SESSION['h']['vendor_name'] = '';
	}else{
		$_SESSION['h']['vendor_name'] = $_POST['vendor_name']; 
	}
	// error variables assigning to smarty
	$field_var = array('contact_numberE', 'contact_numberEr', 'vendor_nameErr', 'vendor_emailEr');
	foreach ($field_var as $field_var){
		$smarty->assign($field_var,$er[$field_var]);
	}
	// redirection to next page
	if(empty($test)){
		$_SESSION['h']['edit_hardware_details'] = 'next';
		if($_POST['next_hdn'] == '1'){
			header('Location: edit_hardware_confirmation.php?id='.$getid.'&inv_id='.$inv_id.'');	
		}else if($_POST['confirm_hdn'] == '1'){
			header('Location: edit_hardware_confirmation.php?id='.$getid.'&inv_id='.$inv_id.'');		
		}
		if($_POST['previous_hdn'] == '1' && $_SESSION['h']['is_rental'] == 'Y'){
			header('Location: edit_rental_hardware_pricing_details.php?id='.$getid.'&inv_id='.$inv_id.'');		
		}else if($_POST['previous_hdn'] == '1'){
			header('Location: edit_hardware_pricing_details.php?id='.$getid.'&inv_id='.$inv_id.'');		
		}
	}
}

// closing mysql
$mysql->close_connection();
$smarty->assign('page_title' , 'Edit Hardware - IT'); 
$smarty->assign('hardware_active','active');
$smarty->display('edit_hardware_vendor_details.tpl');
?>