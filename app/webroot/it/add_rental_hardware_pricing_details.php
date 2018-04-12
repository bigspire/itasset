<?php
/* 
Purpose : To add the hardware pricing details.
Created : Gayathri
Modified : Nikitasa
Date : 15-06-2016
*/
//starting the session
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
// Access next page only after finishing previous step.
if($_SESSION['h']['add_hardware_pricing_details'] != 'next'){
	header('Location:page_error.php');
}
if(!empty($_POST)){
	// Amount validation
	$amount = $_POST['amount'];
	if($fun->isnumeric($amount) == true){
		$amountE = 'Please enter the correct amount'; 
		$test = 'error';		
		$smarty->assign('amountE',$amountE);
		$_SESSION['h'][$field] = '';
	}	
	// Validating the required fields  
	// array for printing correct field name in error message
	$fieldtype = array('0', '1','0');		
	// Actual fields
	$actualfield = array('amount', 'rental type', 'currency type');	
	// Validating the required fields  
   $field = array('amount' => 'amountErr', 'rental_type' => 'rental_type_byErr', 
   'currency_type' => 'currency_typeErr');
	$j = 0;
	foreach($field as $field => $er_var){ 
		if($_POST[$field] == ''){
			$error_msg = $fieldtype[$j] ? ' select the ' : ' enter the ';
			$actual_field =  $actualfield[$j];
			$er[$er_var] = 'Please'. $error_msg .$actual_field;
			$test = 'error';
			$smarty->assign($er_var,$er[$er_var]);
			$_SESSION['h'][$field] = '';
		}else{
			$_SESSION['h'][$field] = $_POST[$field]; 
			$smarty->assign($fields,$_SESSION[$fields]);	
		}
		$j++;
	}
	$_SESSION['h']['paid_date'] = $_POST['paid_date']; 	
	$smarty->assign('paid_date',$_SESSION['paid_date']);
	$_SESSION['h']['purchase_date'] = $_POST['purchase_date']; 	
	$smarty->assign('purchase_date',$_SESSION['purchase_date']);
	
	// redirection to next page
	if(empty($test)){
		$_SESSION['h']['add_hardware_vendor_details'] = 'next';
		if($_POST['next_hdn'] == '1'){
			header('Location: add_hardware_vendor_details.php');		
		}else if($_POST['confirm_hdn'] == '1'){
			header('Location: add_hardware_confirmation.php');	
		}	
	}	
	if($_POST['previous_hdn'] == '1'){
			header('Location: add_hardware_inventory_details.php');		
	}
}
// smarty dropdown array for pade by
$smarty->assign('rental_types', array('' => 'Select', 'D' => 'Daily', 'W' => 'Weekly', 'M' => 'Monthly','H' => 'Half Yearly', 'Y' => 'Yearly'));

// smarty dropdown array for amount type
$smarty->assign('currency_types', array('' => 'Select', 'R' => 'INR', 'D' => 'USD'));

// closing mysql
$mysql->close_connection();
$smarty->assign('page_title' , 'Add Hardware - IT'); 
$smarty->assign('hardware_active','active'); 
$smarty->display('add_rental_hardware_pricing_details.tpl');
?>