<?php
/* 
Purpose : To edit the hardware details.
Created : Gayathri
Modified : Nikita
Date : 16-06-2016
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

// redirect to error page if the user is not it admin
if($roleid != '21'){
	header('Location:'.IT_DIR.'home/');
}
// redirecting to dashboard if the user don't have the permission to this module
if(empty($_SESSION['Hardware'])){
	$_SESSION['e']['alert'] = 'Access denied!';
	header('Location:dashboard.php');
}

// Selecting the record to edit
$getid = $_GET['id'];
$smarty->assign('getid',$getid);
$inv_id = $_GET['inv_id'];
$smarty->assign('invid',$inv_id);

// validate url 
if(($fun->isnumeric($getid)) || ($fun->is_empty($getid)) || ($getid == 0)){
	header('Location:page_error.php');
}

// get database values only when session has no values
if(empty($_SESSION['h']['amount'])){
	$query = "CALL it_get_hardware($getid,'PD')";
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
		// Date format conversion to display
		if(($_SESSION['h']['paid_date'] != '0000-00-00') || ($_SESSION['h']['purchase_date'] != '0000-00-00')){
			$paiddate = $_SESSION['h']['paid_date'];
			$_SESSION['h']['paid_date'] = $fun->convert_date_display($paiddate);
			$purchasedate = $_SESSION['h']['purchase_date'];
			$_SESSION['h']['purchase_date'] = $fun->convert_date_display($purchasedate);
		}else{
			$_SESSION['h']['paid_date'] = '';
			$_SESSION['h']['purchase_date'] = '';
		}		
		// free the memory
		$mysql->clear_result($result);
		// call the next result
		$mysql->next_query();
	}catch(Exception $e){
		echo 'Caught exception: ',  $e->getMessage(), "\n";
	}
}

if($_SESSION['h']['0']['inventory_no'] == ''){
	$query = "CALL it_get_hw_inventory('$inv_id')";
	try{
		// calling mysql exe_query function
		if(!$result = $mysql->execute_query($query)){ 
			throw new Exception('Problem in executing get hardware');
		}
		$i = '0';
		while($row = $mysql->display_result($result)){ 
			$_SESSION['h'][$i]['id'] =  $row['id'];
			$_SESSION['h'][$i]['inventory_no'] =  $row['inventory_no'];
			$_SESSION['h'][$i]['serial_no'] = $row['serial_no'];
			$_SESSION['h'][$i]['asset_desc'] = $row['asset_desc'];
			//$_SESSION['h'][$i]['status'] = $row['status'];
			$_SESSION['h'][$i]['district_id'] = $row['district_id'];
			$_SESSION['h'][$i]['state_id'] = $row['state_id'];
			$i++;
		}
		// free the memory
		$mysql->clear_result($result);
		// call the next result
		$mysql->next_query();
	}catch(Exception $e){
		echo 'Caught exception: ',  $e->getMessage(), "\n";
	}
	// assigning number of quantity
	$_SESSION['h']['invcount'] = $i;
}

if(empty($_SESSION['h']['vendor_name'])){
	$query = "CALL it_get_hardware($getid,'VD')";
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
		// free the memory
		$mysql->clear_result($result);
		// call the next result
		$mysql->next_query();
	}catch(Exception $e){
		echo 'Caught exception: ',  $e->getMessage(), "\n";
	}
}
/*// check assigned hardware
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
if($obj['total'] == '0'){*/
	if(!empty($_POST['next_hdn'])){
		// assigning the date
		$date = $fun->current_date();
		// query to insert into database. 
	   $query = "CALL it_edit_hardware_details('".$mysql->real_escape_str($getid)."', 
		'".$mysql->real_escape_str($_SESSION['h']['model_id'])."', '".$mysql->real_escape_str($_SESSION['h']['color'])."', 
		'".$mysql->real_escape_str($fun->convert_date($_SESSION['h']['purchase_date']))."',  '".$mysql->real_escape_str($_SESSION['h']['description'])."', 
		'".$mysql->real_escape_str($_SESSION['h']['status'])."', 
		'".$mysql->real_escape_str($_SESSION['h']['amount'])."', '".$mysql->real_escape_str($_SESSION['h']['currency_type'])."', 
		'".$mysql->real_escape_str($fun->convert_date($_SESSION['h']['paid_date']))."', 
		'".$mysql->real_escape_str($_SESSION['h']['paid_mode'])."', '".$mysql->real_escape_str($fun->convert_date($_SESSION['h']['validity_from']))."', 
		'".$mysql->real_escape_str($fun->convert_date($_SESSION['h']['validity_to']))."', '".$mysql->real_escape_str($_SESSION['h']['vendor_name'])."', 
		'".$mysql->real_escape_str($_SESSION['h']['vendor_email'])."', '".$mysql->real_escape_str($_SESSION['h']['vendor_person'])."', 
		'".$mysql->real_escape_str($_SESSION['h']['vendor_phone'])."', '".$mysql->real_escape_str($_SESSION['h']['vendor_address'])."', 
		'".$mysql->real_escape_str($_SESSION['h']['vendor_city'])."', '1' , '".$date."', 
		'".$mysql->real_escape_str($_SESSION['h']['hardware_type_id'])."', '".$mysql->real_escape_str($_SESSION['h']['it_brand_id'])."',
		'".$mysql->real_escape_str($_SESSION['h']['bill_no'])."')";

		try{
			// calling mysql exe_query function
			if(!$result = $mysql->execute_query($query)){ 
				throw new Exception('Problem in executing edit hardware details');
			}
			$row = $mysql->display_result($result);
			// free the memory
			$mysql->clear_result($result);
			// next query execution
			$mysql->next_query();
			if(!empty($row['affected_rows'])){
				if(!empty($_SESSION['h']['billfile_edit'])){
					$bill_edit = $getid.'_'.$_SESSION['h']['billfile_edit'];
					$query1 = "CALL it_update_hw_bill('".$mysql->real_escape_str($getid)."', '".$mysql->real_escape_str($bill_edit)."')";
					try{
						if(!$result1 = $mysql->execute_query($query1)){ 
							throw new Exception('Problem in executing edit bill file');
						}
						copy('uploads/temp/'.$_SESSION['h']['billfile_edit'], 'uploads/hardware/'.$getid.'_'.$_SESSION['h']['billfile_edit']);
						unlink('uploads/temp/'.$_SESSION['h']['billfile_edit']);
						// next query execution
						$mysql->next_query();
					}catch(Exception $e){
						echo 'Caught exception: ',  $e->getMessage(), "\n";
					}
				}
				// next query execution
				$mysql->next_query();	
				
				/*
				// inserting the inventory details
				for($i = 0; $i < $_SESSION['h']['invcount']; $i++){
					// delete all the existing inventory.
					$query = "CALL it_delete_hw_inventory('".$mysql->real_escape_str($_SESSION['h'][$i]['id'])."')";
					try{
	    				// calling mysql exe_query function
						if(!$result = $mysql->execute_query($query)){
							throw new Exception('Problem in executing delete inventory details');
						}
						// next query execution
						$mysql->next_query();
					}catch(Exception $e){
						echo 'Caught exception: ',  $e->getMessage(), "\n";
						die;
					}
				}	
				*/

				// inserting the inventory details
				for($i = 0; $i < $_SESSION['h']['invcount']; $i++){	
					if($_SESSION['h'][$i]['id'] != ''){				
						$query2 = "CALL it_edit_hw_inventory('".$_SESSION['h'][$i]['id']."','".$mysql->real_escape_str($_SESSION['h'][$i]['serial_no'])."',
		 	   		'".$mysql->real_escape_str($_SESSION['h'][$i]['inventory_no'])."', '".$mysql->real_escape_str($_SESSION['h'][$i]['asset_desc'])."',
 		 	   		'".$date."', '1', '".$mysql->real_escape_str($_SESSION['h'][$i]['district_id'])."',
 		 	   		'".$mysql->real_escape_str($getid)."')";
			   		try{
							if(!$result2 = $mysql->execute_query($query2)){ 
								throw new Exception('Problem in executing add hardware inventory details');
							}
							// next query execution
							$mysql->next_query();
						}catch(Exception $e){
							echo 'Caught exception: ',  $e->getMessage(), "\n";
						}
					}else{
						$query2 = "CALL it_add_hw_inventory('".$mysql->real_escape_str($_SESSION['h'][$i]['serial_no'])."',
		 	   		'".$mysql->real_escape_str($_SESSION['h'][$i]['inventory_no'])."', '".$mysql->real_escape_str($_SESSION['h'][$i]['asset_desc'])."',
 		 	   		'".$date."', '1', '".$mysql->real_escape_str($_SESSION['h'][$i]['district_id'])."',
 		 	   		'".$mysql->real_escape_str($getid)."')";
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
				}
		
				// destroy session
				session_destroy();
				// redirecting to view page
				if($_POST['next_hdn'] == '1'){
					header('Location: list_hardware.php?status=updated');		
				}else if($_POST['previous_hdn'] == '1'){
					header('Location: edit_hardware_vendor_details.php?id='.$getid.'&inv_id='.$inv_id.'');		
				}
			}
		}catch(Exception $e){
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
	}else{
		// subscription value to name conversion
		$subscription_based = array('1' => 'Yes', '2' => 'No');
		foreach ($subscription_based  as $subscription_based  => $subscriptionbased){ 
			if($_SESSION['h']['subscription'] == $subscription_based){
				$_SESSION['h']['subscriptionbased'] = $subscriptionbased; 
			}
		}
		// validating date conversion
		$valid_to = $fun->convert_date($_SESSION['h']['validity_to']);
		$_SESSION['h']['validityto'] = $fun->it_software_created_date($valid_to);
		$valid_from = $fun->convert_date($_SESSION['h']['validity_from']);
		$_SESSION['h']['validityfrom'] = $fun->it_software_created_date($valid_from);
		$paiddate = $fun->convert_date($_SESSION['h']['paid_date']);
		$_SESSION['h']['paiddate'] = $fun->it_software_created_date($paiddate);
		$purchasedate = $fun->convert_date($_SESSION['h']['purchase_date']);
		$_SESSION['h']['purchasedate'] = $fun->it_software_created_date($purchasedate);
		// architecture value to name conversion
		$architechtures = array('1' => '32 bit', '2' => '64 bit', '3' => 'Both' );
		foreach ($architechtures  as $architechture_no  => $architechture){ 
			if($_SESSION['h']['arch'] == $architechture_no){
				$_SESSION['h']['architechture'] = $architechture; 
			}
		}
		// paid modes value to name conversion	
		$paid_modes = array('CA' => 'Cash', 'CQ' => 'Cheque', 'OT' => 'Online transfer');
		foreach ($paid_modes  as $paid_by  => $paid_mode){ 
			if($_SESSION['h']['paid_mode'] == $paid_by){
				$_SESSION['h']['paidby'] = $paid_mode; 
			}
		}
		// paid modes value to name conversion	
		$currency_types = array('' => 'Select', 'R' => 'Rs', 'D' => '$');
		foreach ($currency_types as $currencytypes  => $currency_type){ 
			if($_SESSION['h']['currency_type'] == $currencytypes){
				$_SESSION['h']['currencytype'] = $currency_type; 
			}
		}
		// smarty name conversion for Software brand
		$hardwaretype = $_SESSION['h']['hardware_type_id'];
		$query = "call it_get_hw_byname('".$hardwaretype."')";
		try{
			// calling mysql exe_query function
			if(!$result = $mysql->execute_query($query)){ 
				throw new Exception('Problem in executing get hardware type');
			} 
			$row = $mysql->display_result($result); 		   
			$_SESSION['h']['hardware_type'] = $row['title']; 
			$smarty->assign('software_type',$_SESSION['software_type']);
			// free the memory
			$mysql->clear_result($result);
			// call the next result
			$mysql->next_query();
		}catch(Exception $e){
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}

		// smarty name conversion for Software brand
		$brand = $_SESSION['h']['it_brand_id'];
		$query = "CALL it_get_brand_byname('".$brand."')";
		try{
			// calling mysql exe_query function
			if(!$result = $mysql->execute_query($query)){ 
				throw new Exception('Problem in executing get brand');
			}
			$row = $mysql->display_result($result);
			$_SESSION['h']['brand_name'] = $row['title']; 
			$smarty->assign('brand_name',$_SESSION['brand_name']);
			// free the memory
			$mysql->clear_result($result);
			// call the next result
			$mysql->next_query();
		}catch(Exception $e){
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
		for($i = 0; $i <= $_SESSION['h']['invcount']; $i++){
			// smarty dropdown for State
			// call the next result
	   	$mysql->next_query();
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
			// smarty dropdown for District
			$query = "call it_get_dist_byname('".$_SESSION['h'][$i]['district_id']."')";
			try{
				// calling mysql exe_query function
				if(!$result = $mysql->execute_query($query)){ 
					throw new Exception('Problem in executing get district');
				}
				$district = $mysql->display_result($result);
				$_SESSION['h'][$i]['district_name'] = $district['district_name']; 
				// free the memory
				$mysql->clear_result($result);
			}catch(Exception $e){
				echo 'Caught exception: ',  $e->getMessage(), "\n";
			}
		}
		// session confirmation
		$_SESSION['h']['confirm_edit'] = 'confirm'; 
		// to download files
		if($_GET['action'] == 'download'){
			if(file_exists('uploads/temp/'.$_GET['file'])){
				$path = 'uploads/temp/'.$_GET['file'];
			}else{
				$path = 'uploads/hardware/'.$_GET['file'];
			}
			$fun->download_file($path);
		}	
	}       
/*}else{
	header('Location:list_hardware.php?&status=not_deleted');
}  */                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       
// closing mysql
$mysql->close_connection();
$smarty->assign('page_title' , 'Edit Hardware - IT'); 
$smarty->assign('hardware_active','active');
$smarty->display('edit_hardware_confirmation.tpl');
?>