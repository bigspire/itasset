<?php
/* 
Purpose : To add the software details.
Created : Gayathri
Modified : Nikitasa
Date : 07-06-2016
*/
//starting the session
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
// Access next page only after finishing previous step.
if($_SESSION['s']['add_software_vendor_details'] != 'next'){
	header('Location:page_error.php');
}
if(!empty($_POST)){
	// Contact number size validation
	if($fun->size_of_phonenumber($_POST['contact_number']) == true){
		$er['contact_numberE'] = 'Please enter the valid size'; 
		$test = 'error';		
	}	
	// Contact number validation
	if($fun->is_phonenumber($_POST['contact_number']) == true){
		$er['contact_numberEr'] = 'Please enter the valid contact number'; 
		$test = 'error';		
	}
	// email validation
	if($fun->email_validation($_POST['company_email']) == true){
		$er['company_emailEr'] = 'Please enter the valid email'; 
		$test = 'error';		
	}	
	// assigning session variables  
   $field = array('contact_number', 'company_email', 'city', 'contact_person', 'address');
	foreach($field as $field){ 		
		$_SESSION['s'][$field] = $_POST[$field]; 
		$smarty->assign($fields,$_SESSION[$fields]);	
	}	
	// required field validation for company name
	if($_POST['company_name'] == ''){
		$er['company_nameErr'] = 'Please enter the company name';
		$test = 'error';
		$_SESSION['s']['company_name'] = '';
	}else{
		$_SESSION['s']['company_name'] = $_POST['company_name']; 
	}
	// error variables assigning to smarty
	$field_var = array('contact_numberE', 'contact_numberEr', 'company_nameErr', 'company_emailEr');
	foreach ($field_var as $field_var){
		$smarty->assign($field_var,$er[$field_var]);
	}
	// redirection to next page
	if(empty($test)){
		$_SESSION['s']['add_software_confirmation'] = 'next';
		if($_POST['next_hdn'] == '1'){
			header('Location: add_software_confirmation.php');		
		}
	}
	if($_POST['previous_hdn'] == '1'){
			header('Location: add_software_pricing_details.php');		
	}
}
// closing mysql
$mysql->close_connection();
$smarty->assign('page_title' , 'Add Software - IT'); 
$smarty->assign('software_active','active'); 
$smarty->display('add_software_vendor_details.tpl');
?>