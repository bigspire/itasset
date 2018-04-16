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
	$actualfield = array('amount', 'paid by', 'currency type','bill no');	
	// Validating the required fields  
   $field = array('amount' => 'amountErr', 'paid_by' => 'paid_byErr', 
   'currency_type' => 'currency_typeErr','bill_no' => 'bill_noErr');
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
		if($billfile != ''){
			// Bill file name assigning as session variable
			$size = $billsize;
			$attach_file = 'attach_bill';
			// retaining the upload file name
			if($fun->is_empty($billfile) == true){
				$billuploadErr = 'Not uploaded the bill file';
				$test = 'error';
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
				// checking the file size is less than 1 MB
				else if($fun->size_validation($size,$req_size)){
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
					$_SESSION['h']['billfile'] = $billfile;
					move_uploaded_file($_FILES['attach_bill']['tmp_name'], $uploadbill);				
				}
			} 
		}
	} 
	$smarty->assign('billuploadErr',$billuploadErr);
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
$smarty->assign('paid_modes', array('' => 'Select', 'CA' => 'Cash', 'CQ' => 'Cheque', 'OT' => 'Online Transfer' ));

// smarty dropdown array for amount type
$smarty->assign('currency_types', array('' => 'Select', 'R' => 'INR', 'D' => 'USD'));

// closing mysql
$mysql->close_connection();
$smarty->assign('page_title' , 'Add Hardware - IT'); 
$smarty->assign('hardware_active','active'); 
$smarty->display('add_hardware_pricing_details.tpl');
?>