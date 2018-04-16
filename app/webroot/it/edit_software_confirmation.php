<?php
/* 
Purpose : To edit the software confirmation.
Created : Gayathri
Date : 08-06-2016
*/
// starting the session
session_start();

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
if($_SESSION['s']['vendor_name'] == ''){
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
if($_SESSION['s']['amount'] == ''){
	$query = "CALL it_get_software($getid,'PD')";
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
		$_SESSION['s']['billfile'] = $_SESSION['s']['bill'];
		// Date format conversion to display
		if(($_SESSION['s']['paid_date'] != '0000-00-00') || ($_SESSION['s']['purchase_date'] != '0000-00-00')){
			$paiddate = $_SESSION['s']['paid_date'];
			$_SESSION['s']['paid_date'] = $fun->convert_date_display($paiddate);
			$purchasedate = $_SESSION['s']['purchase_date'];
			$_SESSION['s']['purchase_date'] = $fun->convert_date_display($purchasedate);
		}else{
			$_SESSION['s']['paid_date'] = '';
			$_SESSION['s']['purchase_date'] = '';
		}
		// free the memory
		$mysql->clear_result($result);
		// next query execution
		$mysql->next_query();
	}catch(Exception $e){
		echo 'Caught exception: ',  $e->getMessage(), "\n";
	}
}

if(!empty($_POST['next_hdn'])){ 
	// Date format conversion of paid date 
	$_SESSION['s']['paid_dt'] = $fun->convert_date($_SESSION['s']['paid_date']);	
	$_SESSION['s']['purchase_dt'] = $fun->convert_date($_SESSION['s']['purchase_date']);	
	$_SESSION['s']['validity_fr'] = $fun->convert_date($_SESSION['s']['validity_from']);	
	$_SESSION['s']['validity_to'] = $fun->convert_date($_SESSION['s']['validity_till']);	
	// assigning the date
	$date = $fun->current_date();
	// query to insert into database. 
	$query = "CALL it_edit_software_details('".$mysql->real_escape_str($getid)."', 
	'".$mysql->real_escape_str($_SESSION['s']['edition'])."', '".$mysql->real_escape_str($_SESSION['s']['arch'])."', 
	'".$mysql->real_escape_str($_SESSION['s']['no_license'])."', '".$mysql->real_escape_str($_SESSION['s']['purchase_dt'])."',   
	'".$mysql->real_escape_str($_SESSION['s']['subscription'])."', '".$mysql->real_escape_str($_SESSION['s']['validity_fr'])."', 
	'".$mysql->real_escape_str($_SESSION['s']['validity_to'])."', '".$mysql->real_escape_str($_SESSION['s']['system_req'])."', 
	'".$mysql->real_escape_str($_SESSION['s']['description'])."','".$mysql->real_escape_str($_SESSION['s']['status'])."', '".$mysql->real_escape_str($_SESSION['s']['amount'])."', 
	'".$mysql->real_escape_str($_SESSION['s']['currency_type'])."', '".$mysql->real_escape_str($_SESSION['s']['paid_dt'])."', 
	'".$mysql->real_escape_str($_SESSION['s']['paid_mode'])."', '".$mysql->real_escape_str($_SESSION['s']['vendor_name'])."', 
	'".$mysql->real_escape_str($_SESSION['s']['vendor_person'])."', '".$mysql->real_escape_str($_SESSION['s']['vendor_email'])."', 
	'".$mysql->real_escape_str($_SESSION['s']['vendor_phone'])."', 
	'".$mysql->real_escape_str($_SESSION['s']['vendor_address'])."', '".$mysql->real_escape_str($_SESSION['s']['vendor_city'])."', '1' , 
	'".$mysql->real_escape_str($date)."', '".$mysql->real_escape_str($_SESSION['s']['software_type_id'])."', 
	'".$mysql->real_escape_str($_SESSION['s']['it_brand_id'])."','".$mysql->real_escape_str($_SESSION['s']['bill_no'])."')";

	// Calling the function that makes the insert
	try{
		// calling mysql exe_query function
		if(!$result = $mysql->execute_query($query)){ 
			throw new Exception('Problem in executing edit software details');
		}
		
		$row = $mysql->display_result($result);
		// free the memory
		$mysql->clear_result($result);
		// next query execution
		 $mysql->next_query();
		if(!empty($row['affected_rows'])){
			if(!empty($_SESSION['s']['billfile_edit'] )){
				$bill_edit = $getid.'_'.$_SESSION['s']['billfile_edit'];
				// query to update the file
				$query1 = "CALL it_update_sw_bill('".$mysql->real_escape_str($getid)."', '".$mysql->real_escape_str($bill_edit)."')";
				try{
					if(!$result1 = $mysql->execute_query($query1)){ 
						throw new Exception('Problem in executing edit bill file');
					}
					copy('uploads/temp/'.$_SESSION['s']['billfile_edit'], 'uploads/software/'.$getid.'_'.$_SESSION['s']['billfile_edit']);
					unlink('uploads/temp/'.$_SESSION['s']['billfile_edit']);
					// next query execution
					$mysql->next_query();
				}catch(Exception $e){
					echo 'Caught exception: ',  $e->getMessage(), "\n";
				}
			}
			// destroy session
			session_destroy();
			// redirecting to view page
			if($_POST['next_hdn'] == '1'){
				header('Location: list_software.php?status=updated');	
			}else if($_POST['previous_hdn'] == '1'){
				header('Location: edit_software_vendor_details.php?id='.$getid.'');		
			}
		}
	}catch(Exception $e){
		echo 'Caught exception: ',  $e->getMessage(), "\n";
	}
}else{
	// subscription value to name conversion
	$subscription_based = array("1" => "Yes", "2" => "No");
	foreach ($subscription_based  as $subscription_based  => $subscriptionbased){ 
		if($_SESSION['s']['subscription'] == $subscription_based){
			$_SESSION['s']['subscriptionbased'] = $subscriptionbased; 
		}
	}

	// validating date conversion
	$valid_from = $fun->convert_date($_SESSION['s']['validity_from']);
	$_SESSION['s']['validityfrom'] = $fun->it_software_created_date($valid_from);
	$valid_to = $fun->convert_date($_SESSION['s']['validity_till']);
	$_SESSION['s']['validitytill'] = $fun->it_software_created_date($valid_to);
	$paid_date = $fun->convert_date($_SESSION['s']['paid_date']);
	$_SESSION['s']['paiddate'] = $fun->it_software_created_date($paid_date);
	$purchase_date = $fun->convert_date($_SESSION['s']['purchase_date']);
	$_SESSION['s']['purchasedate'] = $fun->it_software_created_date($purchase_date);
	// session confirmation for confirm button
	$_SESSION['s']['confirm_edit'] = 'confirm';
	// architecture value to name conversion
	$architechtures = array("1" => "32 bit", "2" => "64 bit","3" => "Both" );
	foreach ($architechtures  as $architechture_no  => $architechture){ 
		if($_SESSION['s']['arch'] == $architechture_no){
			$_SESSION['s']['architechture'] = $architechture; 
		}
	}
	// paid modes value to name conversion	
	$paid_modes = array('CA' => 'Cash', 'CQ' => 'Cheque', 'OT' => 'Online Transfer');
	foreach ($paid_modes  as $paid_by  => $paid_mode){ 
		if($_SESSION['s']['paid_mode'] == $paid_by){
			$_SESSION['s']['paidby'] = $paid_mode; 
		}
	}
	// paid modes value to name conversion	
	$currency_types = array('' => 'Select', 'R' => 'Rs', 'D' => '$');
	foreach ($currency_types as $currencytypes  => $currency_type){ 
		if($_SESSION['s']['currency_type'] == $currencytypes){
			$_SESSION['s']['currencytype'] = $currency_type; 
		}
	}
	// smarty name conversion for Software type
	$softwaretype = $_SESSION['s']['software_type_id'];
	$query = "call it_get_swtype_byname('".$softwaretype."')";
	try{
		// calling mysql exe_query function
		if(!$result = $mysql->execute_query($query)){ 
			throw new Exception('Problem in executing get software type');
		}
		$row = $mysql->display_result($result);	   
		$_SESSION['s']['software_type'] = $row['title']; 
		$smarty->assign('software_type',$_SESSION['software_type']);
		// free the memory
		$mysql->clear_result($result);
		// next query execution
		$mysql->next_query();
	}catch(Exception $e){
		echo 'Caught exception: ',  $e->getMessage(), "\n";
	}

	// smarty name conversion for Software brand
	$brand = $_SESSION['s']['it_brand_id'];
	$query = "CALL it_get_brand_byname('".$brand."')";
	try{
		// calling mysql exe_query function
		if(!$result = $mysql->execute_query($query)){ 
			throw new Exception('Problem in executing get software brand');
		}
		$row = $mysql->display_result($result);
		$_SESSION['s']['brand_name'] = $row['title']; 
		$smarty->assign('brand_name',$_SESSION['brand_name']);
		// free the memory
		$mysql->clear_result($result);
	}catch(Exception $e){
		echo 'Caught exception: ',  $e->getMessage(), "\n";
	}

	// to download files
	if($_GET['action'] == 'download'){
		if(file_exists('uploads/temp/'.$_GET['file'])){
			$path = 'uploads/temp/'.$_GET['file'];
		}else{
			$path = 'uploads/software/'.$_GET['file'];
		}
		$fun->download_file($path);
	}	
}
// closing mysql
$mysql->close_connection();
$smarty->assign('software_active','active');
$smarty->assign('page_title', 'Edit Software - IT'); 
$smarty->display('edit_software_confirmation.tpl');
?>