<?php
/* 
Purpose : To add the hardware details.
Created : Gayathri
Date : 15-06-2016
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

// redirect to error page if the user is not it admin
if($roleid != '21'){
	header('Location:'.IT_DIR.'home/');
}
// redirecting to dashboard if the user don't have the permission to this module
if(empty($_SESSION['Hardware'])){
	header('Location:dashboard.php?access=Access denied!');
}

// check rental 
if($_SESSION['h']['add_hardware_type'] == ''){
	if($_GET['type'] == '' || $_GET['type'] == 'new'){
		$_SESSION['h']['add_hardware_type'] = 'New';
	}else{
		$_SESSION['h']['add_hardware_type'] = 'Rental';
	}
} 


if(!empty($_POST)){
	// from - to date validation
	$fdate=strtotime($fun->convert_date($_POST['validity_from']));
	$tdate=strtotime($fun->convert_date($_POST['validity_to']));	
	if($fun->validity_diff($fdate, $tdate) != true){
		$validityE = 'Please select the correct to date'; 
		$test = 'error';		
		$smarty->assign('validity_toErr',$validityE);
	}
	// Validating the required fields  
	// array for printing correct field name in error message
	$fieldtype = array('0', '0', '1', '1', '0', '0','0');
	$actualfield = array('color', 'model id/name', 'type', 'brand','status','from date', 'to date');
   $field = array('color' => 'colorErr', 'model_id' => 'model_idErr','hardware_type_id' => 'hardware_type_idErr', 
   'it_brand_id' => 'it_brand_idErr','status' => 'statusErr', 'validity_from' => 'validity_fromErr',
   'validity_to' => 'validity_toErr');
	$j = 0;
	foreach ($field as $field => $er_var){ 
		if($_POST[$field] == ''){
			$error_msg = $fieldtype[$j] ? ' select the ' : ' enter the ';
			$actual_field =  $actualfield[$j];
		   $er[$er_varr] = 'Please'. $error_msg .$actual_field;
			$smarty->assign($er_var,$er[$er_var]);
			$test = 'error';
			$_SESSION['h'][$field] = '';
	
		}else{
			$_SESSION['h'][$field] = $_POST[$field]; 
			$smarty->assign($fields,$_SESSION['h'][$field]);	
		}
			$j++;
	}

	// query to check whether it is exist or not. 
	/*
	$query = "CALL it_check_model_id_exist('0','".$_POST['model_id']."')";
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
	}
	
	if($row['total'] != '0'){
		$msg = "Model id already exists";
		$smarty->assign('EXIST_MSG',$msg); 
	}	
	*/
	$_SESSION['h']['description'] = $_POST['description'];
	// redirection to next page
	if(empty($test) && empty($msg)){
		$_SESSION['h']['add_hardware_inventory_details'] = 'next';
		if($_POST['next_hdn'] == '1'){
			header('Location: add_hardware_inventory_details.php');			
		}else if($_POST['confirm_hdn'] == '1'){
			header('Location: add_hardware_confirmation.php');	
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

// closing mysql
$mysql->close_connection();
$smarty->assign('page_title' , 'Add Hardware - IT'); 
$smarty->assign('hardware_active','active'); 
$smarty->display('add_hardware_details.tpl');
?>