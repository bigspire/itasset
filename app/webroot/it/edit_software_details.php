<?php
/* 
Purpose : To edit the software details.
Created : Gayathri
Date : 10-06-2016
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

/*
// redirect to error page if the user is not it admin
if($roleid != '21'){
	header('Location:'.IT_DIR.'home/');
} */
// redirecting to dashboard if the user don't have the permission to this module
if(empty($_SESSION['Software'])){
	header('Location:../home/?access=Access denied!');
}

// get database values only when session has no values
$getid = $_GET['id'];
$smarty->assign('getid',$getid);
// validate url 
if(($fun->isnumeric($getid)) || ($fun->is_empty($getid)) || ($getid == 0)){
  header('Location:page_error.php');
}
// if id is not in our database redirect list page
if($getid !=''){
	$exits = "CALL it_exit_software_details('".$getid."')";
	$result = $mysql->execute_query($exits);
	$total = $mysql->display_result($result);
	$t = $total['total'];

	if($t == 0){ 
		$msg = 'This record not in our database';
		header("Location:list_software.php?msg= $msg");
	}
}
// next query execution
$mysql->next_query();
// Selecting the record to edit
if(empty($_SESSION['s']) && empty($_POST)){
	$query = "CALL it_get_software($getid,'SD')";
	try{
		// calling mysql exe_query function
		if(!$result = $mysql->execute_query($query)){ 
			throw new Exception('Problem in executing get software');
		}
		if($result->num_rows){	
			$row = $mysql->display_result($result);
			$smarty->assign('rows',$row);
			// assign the db values into session
			foreach($row as $key => $record){
				$_SESSION['s'][$key] = $record; 
			}
			// Date format conversion of validity to display
			if(($_SESSION['s']['validity_till'] != '0000-00-00') || ($_SESSION['s']['validity_from'] != '0000-00-00')){
				$val_till_date = $_SESSION['s']['validity_till'];
				$_SESSION['s']['validity_till'] = $fun->convert_date_display($val_till_date);
    	  		$val_from_date = $_SESSION['s']['validity_from'];
				$_SESSION['s']['validity_from'] = $fun->convert_date_display($val_from_date);
			}else{
				$_SESSION['s']['validity_till'] = '';
				$_SESSION['s']['validity_from'] = '';
			}
		}else{
			header('Location:page_error.php');
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
	// no. of pc / license validation
	$licensenum = $_POST['no_license'];
	if($fun->is_number($licensenum) == true){
		$license_noE = 'Please enter the correct no. of pc / license'; 
		$test = 'error';		
		$smarty->assign('license_noE',$license_noE);
	}
	
	// Validating the required fields  
	// array for printing correct field name in error message
	$fieldtype = array('0', '0', '1', '1', '0', '1', '1','0');
	$actualfield = array('edition', 'system requirements', 'type', 'subscription based ', 
	'no. of pc / license', 'brand', 'architecture','status');
   $field = array('edition' => 'editionErr', 'system_req' => 'system_reqErr', 
   'software_type_id' => 'softwaretypeErr', 'subscription' => 'subscription_basedErr',
   'no_license' => 'license_noErr', 'it_brand_id' => 'brandErr', 
   'arch' => 'architechture_noErr','status' => 'statusErr');
	$j = 0;
	foreach ($field as $field => $er_var){ 
		if($_POST[$field] == ''){
			$error_msg = $fieldtype[$j] ? ' select the ' : ' enter the ';
			$actual_field =  $actualfield[$j];
			$er[$er_var] = 'Please'. $error_msg .$actual_field;
			$smarty->assign($er_var,$er[$er_var]);
			$test = 'error';
			$_SESSION['s'][$field] = '';
		}else{
			$_SESSION['s'][$field] = $_POST[$field]; 
		}
		$j++;
	}
	
	// query to check whether it is exist or not. 
	$query = "CALL it_check_software_exist('".$getid."','".$_POST['edition']."','".$_POST['softwaretype']."')";
	try{
		// calling mysql exe_query function
		if(!$result = $mysql->execute_query($query)){ 
			throw new Exception('Problem in checking exist software');
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
		$msg = "Edition already exists";
		$smarty->assign('EXIST_MSG',$msg); 
	}
	
	// check assigned software
 	$query = "call it_check_software_assigned('".$getid."')";
   try{
		if(!$result = $mysql->execute_query($query)){
			throw new Exception('Problem in checking assigned software');
		}  
		$obj = $mysql->display_result($result);
		// next query execution
		$mysql->next_query();
   }catch(Exception $e){
		echo 'Caught exception: ',  $e->getMessage(), "\n";
	}
	
	if(($obj['total'] != '0') && ($_POST['status'] == '0')){
		$msg = "You cannot inactive unless you remove this software from assigned asset";
		$smarty->assign('ERROR_MSG',$msg); 
	}
	
	// Skip the validity year validation id subscription based is 'No' 
	if($_SESSION['s']['subscription'] == '2'){
		$_SESSION['s']['validity_from'] = '';
		$_SESSION['s']['validity_till'] = '';
	}else{
		$act_fields = array('from date', 'till date');		
		$validity_fields = array('validity_from' => 'validity_fromErr', 'validity_till' => 'validity_tillErr');		
		$j = 0;
		foreach ($validity_fields as $fields => $val_er){ 
			if($_POST[$fields] == ''){ 
				$act_field =  $act_fields[$j];
				$err[$val_er] = 'Please select '.$act_field;
				$smarty->assign($val_er, $err[$val_er]);
				$test = 'error';
				$_SESSION['s'][$fields] = '';
			}else{ 
				$_SESSION['s'][$fields] = $_POST[$fields]; 
				// from - to date validation
				$fdate=strtotime($fun->convert_date($_POST['validity_from']));
				$tdate=strtotime($fun->convert_date($_POST['validity_till']));	
				if($fun->validity_diff($fdate, $tdate) != true){
					$validityE = 'Please select the correct validity till'; 
					$test = 'error';		
					$smarty->assign('validity_tillErr',$validityE);
				}
			}
			$j++;
		}
	}
	
	$_SESSION['s']['description'] = $_POST['description']; 
	$smarty->assign('description',$_SESSION['description']);
	// redirection to next page
	if(empty($test) && empty($msg)){
		if($_POST['next_hdn'] == '1'){
			header('Location: edit_software_pricing_details.php?id='.$getid.'');		
		}else if($_POST['confirm_hdn'] == '1'){
			header('Location: edit_software_confirmation.php?id='.$getid.'');		
		}
	}
}

// smarty dropdown for Software type
$query = "call it_get_software_type";
try{
	// calling mysql exe_query function
	if(!$result = $mysql->execute_query($query)){ 
		throw new Exception('Problem in executing get software type');
	}
	$rows = array();
	while($row = $mysql->display_result($result)){
    	$rows[$row['id']] = ucwords($row['title']);    		   
	}
	$smarty->assign('row',$rows);
	// free the memory
	$mysql->clear_result($result);
	// next query execution
	$mysql->next_query();
}catch(Exception $e){
	echo 'Caught exception: ',  $e->getMessage(), "\n";
}
// smarty dropdown for Software brand
$query = "call it_get_brand('S')";
try{
	// calling mysql exe_query function
	if(!$result = $mysql->execute_query($query)){ 
		throw new Exception('Problem in executing get brand');
	}
	$brand = array();
	while($row = $mysql->display_result($result)){
    	$brand[$row['id']] = ucwords($row['title']);    		   
	}
	$smarty->assign('softwarebrands',$brand);
	// free the memory
	$mysql->clear_result($result);
}catch(Exception $e){
	echo 'Caught exception: ',  $e->getMessage(), "\n";
}
// smarty dropdown array for status
$smarty->assign('login_status', array('' => 'Select', '1' => 'Active', '0' => 'Inactive'));
// smarty dropdown array for architechture
$smarty->assign('architechtures', array('1' => '32 bit', '2' => '64 bit', '3' => 'Both' ));

// smarty dropdown array for Subscription Based
$smarty->assign('subscription_based', array('' => 'select', '1' => 'Yes', '2' => 'No'));

// closing mysql
$mysql->close_connection();
$smarty->assign('page_title' , 'Edit Software - IT'); 
$smarty->assign('software_active','active');
$smarty->display('edit_software_details.tpl');
?>