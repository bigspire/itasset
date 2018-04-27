<?php
/* 
Purpose : To add the software details.
Created : Gayathri
Date : 06-06-2016
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
	header('Location:../home/?access=Access denied!');
}

if(!empty($_POST)){ 
	// no. of pc / license validation
	if($fun->is_number($_POST['license_no']) == true){
		$license_noE = 'Please enter the correct no. of pc / license'; 
		$test = 'error';		
		$smarty->assign('license_noE',$license_noE);
	}	

	// validating the required fields  
	// array for printing correct field name in error message
	$fieldtype = array('0', '0', '1', '1', '0', '1', '1','0');
	$actualfield = array('edition', 'system requirements', 'type', 'subscription based ', 
	'no. of pc / license', 'brand', 'architecture','status');
   $field = array('edition' => 'editionErr',  'system_req' => 'system_reqErr', 'softwaretype' => 'softwaretypeErr', 'subscription_based' => 'subscription_basedErr',
   'license_no' => 'license_noErr', 'brand' => 'brandErr', 
   'architechture_no' => 'architechture_noErr','status' => 'statusErr');
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
	$query = "CALL it_check_software_exist('0','".$_POST['edition']."','".$_POST['softwaretype']."')";
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
	
	// skip the validity date validation if subscription based is 'No' 
	if($_SESSION['s']['subscription_based'] == '2'){
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
		$_SESSION['s']['add_software_pricing_details'] = 'next';
		if($_POST['next_hdn'] == '1'){
			header('Location: add_software_pricing_details.php');	
		}else if($_POST['confirm_hdn'] == '1'){
			header('Location: add_software_confirmation.php');	
		}
	}
}
// smarty dropdown for Software type
$query = 'call it_get_software_type()';
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
		throw new Exception('Problem in executing get software brand');
	}
	$brand = array();
	while($row = $mysql->display_result($result)){
   	$brand[$row['id']] = ucwords($row['title']);    		   
	}
	$smarty->assign('sw_brand',$brand);
	// free the memory
	$mysql->clear_result($result);
}catch(Exception $e){
	echo 'Caught exception: ',  $e->getMessage(), "\n";
}
// smarty dropdown array for status
$smarty->assign('login_status', array('' => 'Select', '1' => 'Active', '0' => 'Inactive'));
// status field validation
$_SESSION['s']['status'] = isset($_POST['status']) ? $_POST['status'] : ($_GET['status'] != '' ? $_GET['status'] : '1');

// smarty dropdown array for architechture
$smarty->assign('architechtures', array('' => 'Select', '1' => '32 bit', '2' => '64 bit', '3' => 'Both' ));

// smarty dropdown array for Subscription Based
$smarty->assign('subscription_based', array('' => 'Select', '1' => 'Yes', '2' => 'No'));

// closing mysql
$mysql->close_connection();
$smarty->assign('page_title' , 'Add Software - IT');  
$smarty->assign('software_active','active'); 
$smarty->display('add_software_details.tpl');
?>