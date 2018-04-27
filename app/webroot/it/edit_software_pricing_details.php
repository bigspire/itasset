<?php
/* 
Purpose : To edit the software pricing details.
Created : Gayathri
Modified : Nikitasa
Date : 07-06-2016
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

$getid = $_GET['id'];
$smarty->assign('getid',$getid);
// validate url 
if(($fun->isnumeric($getid)) || ($fun->is_empty($getid)) || ($getid == 0)){
  header('Location:page_error.php');
}

// get database values only when session has no values
if(empty($_POST) && ($_SESSION['s']['amount'] == '')){
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
		// Date format conversion of valid till to display
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

if(!empty($_POST)){ 
	// Amount validation
	if($fun->isnumeric($_POST['amount']) == true){
		$amountE = 'Please enter the correct Amount'; 
		$smarty->assign('amountE',$amountE);
		$test = 'error';		
	}	
	// Validating the required fields  
	// array for printing correct field name in error message
	$fieldtype = array('0', '1', '1','0');		
	// Actual fields
	$actualfield = array('amount', 'paid by', 'currency type', 'bill no');	
	// Validating the required fields  
   $field = array('amount' => 'amountErr', 'paid_mode' => 'paid_byErr', 
   'currency_type' => 'currency_typeErr', 'bill_no' => 'bill_noErr');
	$j = 0;
	$dbfield = array('amount', 'paid_mode', 'currency_type','bill_no');
	foreach($field as $field => $er_var){ 
		if($_POST[$field] == ''){
			$error_msg = $fieldtype[$j] ? ' select the ' : ' enter the ';
			$actual_field =  $actualfield[$j];
			$er[$er_var] = 'Please'. $error_msg .$actual_field;
			$test = 'error';
			$_SESSION['s'][$field] = '';
			$smarty->assign($er_var,$er[$er_var]);
		}else{
			$_SESSION['s'][$field] = $_POST[$field]; 
		}
		$j++;
	}
	$_SESSION['s']['paid_date'] = $_POST['paid_date']; 	
	$_SESSION['s']['purchase_date'] = $_POST['purchase_date']; 	
	// bill and warranty upload and validation
	if(!empty($_POST)){
		// upload directory
		$uploaddir = 'uploads/temp/'; 
		$uploadbill = $uploaddir . basename($_FILES['attach_bill']['name']); 
		$billfile = $_FILES['attach_bill']['name'];
		$billsize = $_FILES['attach_bill']['size'];
		$billtype = $_FILES['attach_bill']['type'];
		// required size for validation 			
		$req_size = 1048576;
		$attach_file = 'attach_bill';
		if($fun->is_empty($billfile) == true){
			$_SESSION['s']['billfile'] = $_SESSION['s']['bill'];
		}else{
			// file extensions
			$extensions = array('jpeg','jpg','png','gif','pdf','zip'); 
			$bill_ext = explode('/',$billtype)	;
			$bill_ext = end($bill_ext); 
			// checking the file extension is jpg,jpeg,pdf,zip or png
			$file_ext = $bill_ext;
			if($fun->extension_validation($file_ext,$extensions) == true){		
				$billuploadErr = 'Attach bill must be jpg, jpeg, png, gif, pdf, zip';
				$test = 'error';
			}
			// checking the file size is less than 1MB
			else if($fun->size_validation($billsize,$req_size)){
				$billuploadErr = 'Bill file size must be less than 1 MB';
				$test = 'error';
			}	
			// checking whether the upload directory is there or not.
			else if($fun->check_uploaded($uploaddir)){
				$billuploadErr = 'The directory does not exist';
				$test = 'error';
			}
			// uploading file if there is no error
			else{
				$_SESSION['s']['billfile_edit'] = $billfile;
				move_uploaded_file($_FILES['attach_bill']['tmp_name'], $uploadbill);
			}
		} 
	} 
	$smarty->assign('billuploadErr',$billuploadErr);
	// redirection to next page
	if(empty($test)){
		if($_POST['next_hdn'] == '1'){
			header('Location: edit_software_vendor_details.php?id='.$getid.'');	
		}else if($_POST['confirm_hdn'] == '1'){
			header('Location: edit_software_confirmation.php?id='.$getid.'');		
		}
		if($_POST['previous_hdn'] == '1'){
			header('Location: edit_software_details.php?id='.$getid.'');		
		}
	}
}
// smarty dropdown array for pade by
$smarty->assign('paid_modes', array('' => 'Select', 'CA' => 'Cash', 'CQ' => 'Cheque', 'OT' => 'Online Transfer' ));
// smarty dropdown array for amount type
$smarty->assign('currency_types', array('' => 'Select', 'R' => 'INR', 'D' => 'USD'));
// closing mysql
$mysql->close_connection();
$smarty->assign('page_title' , 'Edit Software - IT'); 
$smarty->assign('software_active','active');
$smarty->display('edit_software_pricing_details.tpl');
?>