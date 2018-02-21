<?php
/* 
Purpose : To add the hardware confirmation.
Created : Gayathri
Modified : Nikitasa
Date : 15-06-2016
*/

//starting the session
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

// redirect to error page if the user is not it admin
if($roleid != '21'){
	header('Location:'.IT_DIR.'home/');
}
// Access next page only after finishing previous step.
if($_SESSION['h']['add_hardware_confirmation'] != 'next'){
	header('Location:page_error.php');
}
// checking there is no empty fields before submit
if(!empty($_POST['next_hdn'])){
	
	// query to check whether inventory no is exist or not.  
	$query = "CALL it_check_inventory_no_exist('0','".$_POST['inventory_no_'.$i]."')";
	try{
		// calling mysql exe_query function
		if(!$result = $mysql->execute_query($query)){ 
			throw new Exception('Problem in checking exist inventory no');
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
		$msg = "Inventory no already exists";
		$_SESSION['h'][$i]['inventory_noErr'] = $msg;
	}
		
	// Date format conversion 
	$paid_date = $fun->convert_date( $_SESSION['h']['paid_date']);
	$purchase_date = $fun->convert_date( $_SESSION['h']['purchase_date']);
	$validity_from = $fun->convert_date( $_SESSION['h']['validity_from']);
	$validity_to = $fun->convert_date( $_SESSION['h']['validity_to']);
		
	// assigning the date
	$date = $fun->current_date();
	// query to insert into database. 
	$query = "CALL it_add_hardware_details('".$mysql->real_escape_str($_SESSION['h']['model_id'])."', '".$mysql->real_escape_str($_SESSION['h']['color'])."', 
	'".$mysql->real_escape_str($purchase_date)."', '".$mysql->real_escape_str($_SESSION['h']['description'])."', 
	'".$mysql->real_escape_str($_SESSION['h']['amount'])."',  
	'".$mysql->real_escape_str($_SESSION['h']['currency_type'])."', '".$mysql->real_escape_str($paid_date)."', 
	'".$mysql->real_escape_str($_SESSION['h']['paid_by'])."',
	'".$mysql->real_escape_str($validity_from)."', '".$mysql->real_escape_str($validity_to)."', 
	'".$mysql->real_escape_str($_SESSION['h']['company_name'])."', '".$mysql->real_escape_str($_SESSION['h']['company_email'])."',
	'".$mysql->real_escape_str($_SESSION['h']['contact_person'])."', '".$mysql->real_escape_str($_SESSION['h']['contact_number'])."', 
	'".$mysql->real_escape_str($_SESSION['h']['address'])."', '".$mysql->real_escape_str($_SESSION['h']['city'])."', '1' , '".$date."', 
	'".$mysql->real_escape_str($_SESSION['h']['hardware_type_id'])."', 
	'".$mysql->real_escape_str($_SESSION['h']['it_brand_id'])."','".$mysql->real_escape_str($_SESSION['h']['bill_no'])."')";
	try{
		// executing query
		if(!$result = $mysql->execute_query($query)){
			throw new Exception('Problem in executing add hardware details');
		}
		$row = $mysql->display_result($result);
		$last_id = $row['inserted_id'];
		$uploaddir = 'uploads/hardware/'.$last_id.'_'; 
		if(!empty($last_id)){
			// next query execution
			$mysql->next_query();
			if(!empty($_SESSION['h']['billfile'])){
				$bill_add = $last_id.'_'.$_SESSION['h']['billfile'];
				$query1 = "CALL it_update_hw_bill('".$mysql->real_escape_str($last_id)."', '".$mysql->real_escape_str($bill_add)."')";
				try{
					if(!$result1 = $mysql->execute_query($query1)){ 
						throw new Exception('Problem in executing edit bill file');
					}
					// copying the uploaded file from temp folder to hardware folder and deleting from temp
					copy('uploads/temp/'.$_SESSION['h']['billfile'], $uploaddir.$_SESSION['h']['billfile']); 
					unlink('uploads/temp/'.$_SESSION['h']['billfile']);
					// next query execution
					$mysql->next_query();
				}catch(Exception $e){
					echo 'Caught exception: ',  $e->getMessage(), "\n";
				}
			}
			for($i = 0; $i < $_SESSION['h']['inv_count']; $i++){
				// next query execution
				$mysql->next_query();
				// insert inventory details
				$query2 = "CALL it_add_hw_inventory('".$mysql->real_escape_str($_SESSION['h'][$i]['serial_no'])."',
		 	   '".$mysql->real_escape_str($_SESSION['h'][$i]['inventory_no'])."', '".$mysql->real_escape_str($_SESSION['h'][$i]['asset_desc'])."',
 			   '".$date."', '1', '".$mysql->real_escape_str($_SESSION['h'][$i]['district_id'])."',
 			   '".$last_id."')";
				try{
					if(!$result2 = $mysql->execute_query($query2)){ 
					throw new Exception('Problem in executing add hardware inventory details');
					}
					// next query execution
					$mysql->next_query();
				}catch(Exception $e){
					echo 'Caught exception: ',  $e->getMessage(), "\n";
				}
			}
			session_destroy();
			// redirecting to view page
			if($_POST['next_hdn'] == '1'){
				header('Location: list_hardware.php?status=created');			
			}else if($_POST['previous_hdn'] == '1'){
				header('Location: add_hardware_vendor_details.php');		
			}			
		}
		// free the memory
		$mysql->clear_result($result);
		// call the next result
		$mysql->next_query();
	}catch(Exception $e){
		echo 'Caught exception: ',  $e->getMessage(), "\n";
	}
}else{
	// session confirmation to display confirm button
	$_SESSION['h']['confirm_add'] = 'confirm';
	// paid modes value to name conversion	
	$paid_modes = array('CA' => 'Cash', 'CQ' => 'Cheque', 'OT' => 'Online Transfer');
	foreach ($paid_modes  as $paid_by  => $paid_mode){ 
		if($_SESSION['h']['paid_by'] == $paid_by){
			$_SESSION['h']['paidby'] = $paid_mode; 
		}
	}
	// currency types value to name conversion	
	$currency_types = array('' => 'Select', 'R' => 'Rs', 'D' => '$');
	foreach ($currency_types as $currencytypes  => $currency_type){ 
		if($_SESSION['h']['currency_type'] == $currencytypes){
			$_SESSION['h']['currencytype'] = $currency_type; 
		}
	}
	// smarty name conversion for hardware type
	$hardwaretype = $_SESSION['h']['hardware_type_id'];
	$query = "call it_get_hw_byname('".$hardwaretype."')";
	// Calling the function that makes the insert
	try{
		// calling mysql exe_query function
		if(!$result = $mysql->execute_query($query)){
			throw new Exception('Problem in executing get hardware type');
		} 
		$row = $mysql->display_result($result); 		   
		$_SESSION['h']['hardware_type'] = $row['title']; 		
		// free the memory
		$mysql->clear_result($result);
		// call the next result
		$mysql->next_query();
	}catch(Exception $e){
		echo 'Caught exception: ',  $e->getMessage(), "\n";
	}

	// smarty name conversion for hardware brand
	$brand = $_SESSION['h']['it_brand_id'];
	$query = "CALL it_get_brand_byname('".$brand."')";
	// Calling the function that makes the insert
	try{
		// calling mysql exe_query function
		if(!$result = $mysql->execute_query($query)){
			throw new Exception('Problem in executing get hardware brand');
		}
		$row = $mysql->display_result($result);
		$_SESSION['h']['brand_name'] = $row['title']; 
		// free the memory
		$mysql->clear_result($result);
		// call the next result
		$mysql->next_query();
	}catch(Exception $e){
		echo 'Caught exception: ',  $e->getMessage(), "\n";
	}
	for($i = 0; $i <= $_SESSION['h']['inv_count'] - 1; $i++){
		// changing the status to display
		//$_SESSION['h'][$i]['status_nm'] = $fun->it_software_status($_SESSION['h'][$i]['status']);
		// call the next result
	   $mysql->next_query();
		// smarty dropdown for State
		$query = "call it_get_state_byname('".$_SESSION['h'][$i]['state_id']."')";
		try{
			// calling mysql exe_query function
			if(!$result = $mysql->execute_query($query)){
				throw new Exception('Problem in executing get state');
			}
			$row = $mysql->display_result($result);
			$_SESSION['h'][$i]['state_name'] = $row['state_name']; 
			$mysql->clear_result($result);
			// call the next result
			$mysql->next_query();
		}catch(Exception $e){
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
		// call the next result
	   $mysql->next_query();
		// smarty drop down for District
		$query = "call it_get_dist_byname('".$_SESSION['h'][$i]['district_id']."')";
		// Calling the function that makes the insert
		try{
			// calling mysql exe_query function
			if(!$result = $mysql->execute_query($query)){
				throw new Exception('Problem in executing get district');
			}
			$row = $mysql->display_result($result);
			$_SESSION['h'][$i]['district_name'] = $row['district_name']; 
			// free the memory
			$mysql->clear_result($result);
		}catch(Exception $e){
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}  
	}
	// validating date conversion
	$validityfrom = $fun->convert_date($_SESSION['h']['validity_from']);
	$_SESSION['h']['validityfrom'] = $fun->it_software_created_date($validityfrom);
   $validityto = $fun->convert_date($_SESSION['h']['validity_to']);
	$_SESSION['h']['validityto'] = $fun->it_software_created_date($validityto);
	$paid_date = $fun->convert_date( $_SESSION['h']['paid_date']);
	$_SESSION['h']['paiddate'] = $fun->it_software_created_date($paid_date);
	$purchase_date = $fun->convert_date( $_SESSION['h']['purchase_date']);
	$_SESSION['h']['purchasedate'] = $fun->it_software_created_date($purchase_date);

	// to download files
	if($_GET['action'] == 'download'){
		$path = 'uploads/temp/'.$_GET['file'];
		$fun->download_file($path);
	}	
}
// closing mysql
$mysql->close_connection();
$smarty->assign('page_title' , 'Add Hardware - IT');
$smarty->assign('hardware_active','active'); 
$smarty->display('add_hardware_confirmation.tpl');
?>