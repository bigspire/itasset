<?php
/* 
Purpose : To edit the software vendor details.
Created : Gayathri
Modified : Nikitasa
Date : 16-06-2016
*/
// starting the session
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

// redirect to error page if the user is not it admin
if($roleid != '21'){
	header('Location:'.IT_DIR.'home/');
}
// redirecting to dashboard if the user don't have the permission to this module
if(empty($_SESSION['Software'])){
	header('Location:dashboard.php?access=Access denied!');
}

// Selecting the record to edit
$getid = $_GET['id'];
$smarty->assign('getid',$getid);
// validate url 
if(($fun->isnumeric($getid)) || ($fun->is_empty($getid)) || ($getid == 0)){
  header('Location:page_error.php');
}
// get database values only when session has no values
if(($_SESSION['s']['vendor_name'] == '') && empty($_POST)){
	$query = "CALL it_get_software($getid,'VD')";
	try{
		// calling mysql exe_query function
		if(!$result = $mysql->execute_query($query)){ 
			throw new Exception('Problem in executing get software');
		}
		$row = $mysql->display_result($result);
		$smarty->assign('rows',$row);
		// assign the db values into session
		foreach($row as $key => $record){
			$_SESSION['s'][$key] = $record; 
		}
		// free the memory
		$mysql->clear_result($result);
		// next query execution
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
		$_SESSION['s'][$field] = $_POST[$field]; 
	}	
	// required field validation for company name
	if($_POST['vendor_name'] == ''){
		$er['vendor_nameErr'] = 'Please enter the company name';
		$test = 'error';
		$_SESSION['s']['vendor_name'] = '';
	}else{
		$_SESSION['s']['vendor_name'] = $_POST['vendor_name']; 
	}
	// error variables assigning to smarty
	$field_var = array('contact_numberE', 'contact_numberEr', 'vendor_nameErr', 'vendor_emailEr');
	foreach ($field_var as $field_var){
		$smarty->assign($field_var,$er[$field_var]);
	}
		// redirection to next page
	if(empty($test)){
		if($_POST['next_hdn'] == '1'){
			header('Location: edit_software_confirmation.php?id='.$getid.'');
		}else if($_POST['confirm_hdn'] == '1'){
			header('Location: edit_software_confirmation.php?id='.$getid.'');		
		}
		if($_POST['previous_hdn'] == '1'){
			header('Location: edit_software_pricing_details.php?id='.$getid.'');		
		}
	}
}
// closing mysql
$mysql->close_connection();
$smarty->assign('page_title' , 'Edit Software - IT'); 
$smarty->assign('software_active','active');
$smarty->display('edit_software_vendor_details.tpl');
?>