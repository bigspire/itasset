<?php
/* 
Purpose : To edit the hardware details.
Created : Gayathri
Modified : Nikitasa
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


// get database values only when session has no values
$getid = $_GET['id'];
$smarty->assign('getid',$getid);
$inv_id = $_GET['inv_id'];
$smarty->assign('invid',$inv_id);

// validate url 
if(($fun->isnumeric($getid)) || ($fun->is_empty($getid)) || ($getid == 0)){
  header('Location:page_error.php');
}
// if id is not in our database redirect list page
if($getid !=''){
	$exits = "CALL it_exit_hardware_details('".$getid."')";
	$result = $mysql->execute_query($exits);
	$total = $mysql->display_result($result);
	$t = $total['total'];

	if($t == 0){ 
		$msg = 'This record not in our database';
		header("Location:list_hardware.php?msg= $msg");
	}
}
// next query execution
		$mysql->next_query();
		
		
// Selecting the record to edit
if(empty($_SESSION['h']) && empty($_POST)){
  $query = "CALL it_get_hardware($getid,'HD')";
  
  
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
		
		
		
		// Date format conversion of valid till to display
		$val_to_date = $_SESSION['h']['validity_to'];
		$_SESSION['h']['validity_to'] = $fun->convert_date_display($val_to_date);
      $val_from_date = $_SESSION['h']['validity_from'];
		$_SESSION['h']['validity_from'] = $fun->convert_date_display($val_from_date);
		// free the memory
		$mysql->clear_result($result);
		// call the next result
		$mysql->next_query();
	}catch(Exception $e){
		echo 'Caught exception: ',  $e->getMessage(), "\n";
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
	$actualfield = array('color', 'model id/name', 'type', 'brand','status',
	'from date','to date');
   $field = array('color' => 'colorErr', 'model_id' => 'model_idErr', 
   'hardware_type_id' => 'hardware_type_idErr', 
   'it_brand_id' => 'it_brand_idErr','status' => 'statusErr', 'validity_from' => 'validity_fromErr', 'validity_to' => 'validity_toErr');
	$j = 0;
	foreach ($field as $field => $er_var){ 
		if($_POST[$field] == ''){
			$error_msg = $fieldtype[$j] ? ' select the ' : ' enter the ';
			$actual_field =  $actualfield[$j];
			$er[$er_var] = 'Please'. $error_msg .$actual_field;
			$smarty->assign($er_var,$er[$er_var]);
			$test = 'error';
			$_SESSION['h'][$field] = '';
		}else{
			$_SESSION['h'][$field] = $_POST[$field]; 
			$smarty->assign($fields,$_SESSION[$fields]);	
		}
		$j++;
	}
	
	/*
	// query to check whether it is exist or not. 
	$query = "CALL it_check_model_id_exist('".$getid."','".$_POST['model_id']."')";
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
	// check assigned software
 	$query = "call it_check_hardware_assigned('".$inv_id."')";
   try{
		if(!$result = $mysql->execute_query($query)){
			throw new Exception('Problem in checking assigned hardware');
		}  
		$obj = $mysql->display_result($result);
		// next query execution
		$mysql->next_query();
   }catch(Exception $e){
		echo 'Caught exception: ',  $e->getMessage(), "\n";
	}
	
	if(($obj['total'] != '0') && ($_POST['status'] == '0')){
		$msg = "You cannot inactive unless you remove this hardware from assigned asset";
		$smarty->assign('ERROR_MSG',$msg); 
	}
	
	$_SESSION['h']['description'] = $_POST['description'];
	$_SESSION['h']['serial_no'] = $_POST['serial_no'];
	// redirection to next page
	if(empty($test) && empty($msg)){
		$_SESSION['h']['edit_hardware_details'] = 'next';
		header('Location: edit_hardware_inventory_details.php?id='.$getid.'&inv_id='.$inv_id.'');		
		if($_POST['next_hdn'] == '1'){
			header('Location: edit_hardware_inventory_details.php?id='.$getid.'&inv_id='.$inv_id.'');	
		}else if($_POST['confirm_hdn'] == '1'){
			header('Location: edit_hardware_confirmation.php?id='.$getid.'&inv_id='.$inv_id.'');		
		}
	}
}
// smarty dropdown for Software type
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
	
// smarty dropdown for Software brand
$query = "call it_get_brand('H')";
try{
	// calling mysql exe_query function
	if(!$result = $mysql->execute_query($query)){ 
		throw new Exception('Problem in executing get brand');
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
// closing mysql
$mysql->close_connection();
$smarty->assign('page_title' , 'Edit Hardware - IT'); 
$smarty->assign('hardware_active','active'); 
$smarty->display('edit_hardware_details.tpl');
?>