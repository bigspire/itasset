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
if($_SESSION['s']['add_software_pricing_details'] != 'next'){
	header('Location:page_error.php');
}
if(!empty($_POST)){
	// Amount validation
	$amount = $_POST['amount'];
	if($fun->isnumeric($amount) == true){
		$amountE = 'Please enter the correct amount'; 
		$smarty->assign('amountE',$amountE);
		$test = 'error';		
	}	
	// Validating the required fields  
	// array for printing correct field name in error message
	$fieldtype = array('0', '0', '1','0');		
	// Actual fields
	$actualfield = array('amount', 'paid by', 'currency type','bill no');	
	// Validating the required fields  
   $field = array('amount' => 'amountErr', 'paid_by' => 'paid_byErr', 
   'currency_type' => 'currency_typeErr', 'bill_no' => 'bill_noErr');
	$j = 0;
	foreach ($field as $field => $er_var){ 
		if($_POST[$field] == ''){
			$error_msg = $fieldtype[$j] ? ' select the ' : ' enter the ';
			$actual_field =  $actualfield[$j];
			$er[$er_var] = 'Please'. $error_msg .$actual_field;
			$test = 'error';
			$smarty->assign($er_var,$er[$er_var]);
			$_SESSION['s'][$field] = '';
		}else{
			$_SESSION['s'][$field] = $_POST[$field]; 
		}
		$j++;
	}
	// paid and purchase date assigning as session variable
	$_SESSION['s']['paid_date'] = $_POST['paid_date']; 	
	$_SESSION['s']['purchase_date'] = $_POST['purchase_date']; 	
	// bill upload and validation
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
			$smarty->assign('billfile', $_SESSION['billfile']);
			$size = $billsize;
			$attach_file = 'attach_bill';
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
					$_SESSION['s']['billfile'] = $billfile;
					move_uploaded_file($_FILES['attach_bill']['tmp_name'], $uploadbill);
				}
			}
		}
	} 
	$smarty->assign('billuploadErr',$billuploadErr);
	// redirection to next page
	if(empty($test)){
		$_SESSION['s']['add_software_vendor_details'] = 'next';
		if($_POST['next_hdn'] == '1'){
			header('Location: add_software_vendor_details.php');		
		}else if($_POST['confirm_hdn'] == '1'){
			header('Location: add_software_confirmation.php');	
		}
	}
	if($_POST['previous_hdn'] == '1'){
			header('Location: add_software_details.php');		
	}
}
// smarty dropdown array for pade by
$smarty->assign('paid_modes', array('' => 'Select', 'CA' => 'Cash', 'CQ' => 'Cheque', 'OT' => 'Online Transfer'));
$smarty->assign('paid_by',$form['paid_by']);
// smarty dropdown array for amount type
$smarty->assign('currency_types', array('' => 'Select', 'R' => 'INR', 'D' => 'USD'));
$smarty->assign('currency_type',$form['currency_type']);
// closing mysql
$mysql->close_connection();
$smarty->assign('page_title' , 'Add Software - IT'); 
$smarty->assign('software_active','active'); 
$smarty->display('add_software_pricing_details.tpl');
?>