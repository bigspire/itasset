<?php
/* 
Purpose : To edit assign asset.
Created : Gayathri
Modified : Nikitasa
Date : 21-06-2016
*/

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
if(empty($_SESSION['AssignAssset'])){
	header('Location:dashboard.php?access=Access denied!');
}

$getid = $_GET['id'];
$smarty->assign('getid',$getid);
// validate url 
if(($fun->isnumeric($getid)) || ($fun->is_empty($getid)) || ($getid == 0)){
  header('Location:page_error.php');
}

// if id is not in our database redirect list page
if($getid !=''){
	$exits = "CALL it_exit_assign_asset_details('".$getid."')";
	$result = $mysql->execute_query($exits);
	$total = $mysql->display_result($result);
	$t = $total['total'];

	if($t == 0){ 
		$msg = 'This record not in our database';
		header("Location:list_assign_asset.php?msg= $msg");
	}
}

// next query execution
$mysql->next_query();
// get database values
if(empty($_POST)){
	$query = "CALL it_get_assign_asset('$getid')";
	try{
		// calling mysql exe_query function
		if(!$result = $mysql->execute_query($query)){ 
			throw new Exception('Problem in executing get assign asset');
		}
		$tot = 0;
		while($row = $mysql->display_result($result)){
			$smarty->assign('app_users_id', $row['app_users_id']);
			// post of assign asset fields value
			$typeData[] = $row['type'];
			if($row['type'] == 'S'){ 
				$record_idData[$tot] = $row['id'];
				$sw_type_idData[$tot] = $row['type_id'];
				$it_sw_brand_idData[$tot] = $row['it_brand_id'];
				$edition_it_idData[$tot] = $row['it_id'];
			}else if($row['type'] == 'H'){	
				$record_idData[$tot] = $row['id'];
				$hw_type_idData[$tot] = $row['type_id'];
				$it_hw_brand_idData[$tot] = $row['it_brand_id'];
				$inventory_it_idData[$tot] = $row['it_id'];
			}
			$tot++;
		}
		$smarty->assign('assetCount',$tot);
			
		$smarty->assign('record_idData', $record_idData);
		$smarty->assign('hw_type_idData', $hw_type_idData);
		$smarty->assign('it_hw_brand_idData', $it_hw_brand_idData);
		$smarty->assign('typeData', $typeData);
		$smarty->assign('inventory_it_idData', $inventory_it_idData);
		$smarty->assign('sw_type_idData', $sw_type_idData);
		$smarty->assign('it_sw_brand_idData', $it_sw_brand_idData);
		$smarty->assign('edition_it_idData', $edition_it_idData);

		$smarty->assign('totCount', $tot);
		
		// free the memory
		$mysql->clear_result($result);
		// call the next result
		$mysql->next_query();
	}catch(Exception $e){
		echo 'Caught exception: ',  $e->getMessage(), "\n";
	}
}

if(!empty($_POST)){
	
	// employee Field Validation
   if($fun->not_empty($_POST['app_users_id'])){
		$smarty->assign('app_users_id' , $_POST['app_users_id']);
   }else{
    	$test = 'error';
      $smarty->assign('app_users_idErr' , 'Please select the employee');
   }
   
	// for passing Employee names
	$query = 'CALL it_get_employee()';
	try{
		// calling mysql exe_query function
		if(!$result = $mysql->execute_query($query)){
			throw new Exception('Problem in executing get employee');
		}
		while($nm = $mysql->display_result($result)){
   		if($nm['id'] == $_POST['app_users_id']){
				$empname = ucfirst($nm['first_name']).' '.ucfirst($nm['last_name']); 
			} 		   
		}
		// free the memory
		$mysql->clear_result($result);
		// call the next result
		$mysql->next_query();
	}catch(Exception $e){
		echo 'Caught exception: ',  $e->getMessage(), "\n";
	}
	
	// post of assign asset fields value
	for($i = 0; $i < $_POST['asset_count']; $i++){
		
		// Validating the required fields  
		// array for printing correct field name in error message
		if($_POST['type_'.$i] == 'S'){
			$record_idData[$i] = $_POST['record_id_'.$i];
			$typeData[$i] = $_POST['type_'.$i];
			$sw_type_idData[$i] = $_POST['sw_type_id_'.$i];
			$edition_it_idData[$i] = $_POST['edition_it_id_'.$i];
			$it_sw_brand_idData[$i] = $_POST['it_sw_brand_id_'.$i];
			// Validating the required fields  
			// array for printing correct field name in error message
			$fieldtype = array('1', '1', '1');
			$actualfield = array('software type', 'software brand', 'edition');
   		$field_ar = array('sw_type_id_'.$i => 'sw_typeErr', 'it_sw_brand_id_'.$i => 'sw_brandErr', 'edition_it_id_'.$i => 'editionErr');
			$j = 0;
			foreach($field_ar as $field => $er_var){ 
				if($_POST[$field] == ''){
					$error_msg = $fieldtype[$j] ? ' select the ' : ' enter the ';
					$actual_field =  $actualfield[$j];
					$er[$i][$er_var] = 'Please'. $error_msg .$actual_field;
				}
				$j++;
			}
		}else{ //if($_POST['type_'.$i] == 'H'){	
			$record_idData[$i] = $_POST['record_id_'.$i];						
			$typeData[$i] = $_POST['type_'.$i];
			$hw_type_idData[$i] = $_POST['hw_type_id_'.$i];
			$inventory_it_idData[$i] = $_POST['inventory_it_id_'.$i];
			$it_hw_brand_idData[$i] = $_POST['it_hw_brand_id_'.$i];
			// Validating the required fields  
			// array for printing correct field name in error message
			$fieldtype = array('1', '1', '1');
			$actualfield = array('hardware type', 'hardware brand', 'inventory no');
  			$field_ar = array('hw_type_id_'.$i => 'hw_typeErr', 'it_hw_brand_id_'.$i => 'hw_brandErr',
  			 'inventory_it_id_'.$i => 'inventoryErr');
			$j = 0;
			foreach($field_ar as $field => $er_var){ 
				if($_POST[$field] == ''){
					$error_msg = $fieldtype[$j] ? ' select the ' : ' enter the ';
					$actual_field =  $actualfield[$j];
					$er[$i][$er_var] = 'Please'. $error_msg .$actual_field;
				}
				$j++;
			}
		}
	}
	
	$smarty->assign('record_idData', $record_idData);
	$smarty->assign('typeData', $typeData);
	$smarty->assign('sw_type_idData', $sw_type_idData);
	$smarty->assign('hw_type_idData', $hw_type_idData);
	$smarty->assign('it_sw_brand_idData', $it_sw_brand_idData);
	$smarty->assign('it_hw_brand_idData', $it_hw_brand_idData);
	$smarty->assign('edition_it_idData', $edition_it_idData);
	$smarty->assign('inventory_it_idData', $inventory_it_idData);
	$smarty->assign('assetCount', $_POST['asset_count']);	
	$smarty->assign('totCount', $_POST['asset_count']);
	$smarty->assign('assetErr',$er);
}

// assigning the date
$date = $fun->current_date();
$status = '1';

if((empty($test)) && (empty($er)) && (!empty($_POST['asset_count']))){

		// query to delete all record from database. 					
		$query = "CALL it_change_asset_delete_status('$getid')";
		// Calling the function that makes the insert
		try{
			// calling mysql exe_query function
			if(!$result = $mysql->execute_query($query)){ 
				throw new Exception('Problem in executing delete assign asset');
			}
			// call the next result
			$mysql->next_query();
		}catch(Exception $e){
			echo 'Caught exception: ',  $e->getMessage(), "\n";
			die;
		}
	
	for($i = 0; $i < $_POST['asset_count']; $i++){ 
		if($_POST['type_'.$i] == 'S'){
			$record_id = $_POST['record_id_'.$i];
			$type = $_POST['type_'.$i];	
			$edition = $_POST['edition_it_id_'.$i];
			$swtype = $_POST['sw_type_id_'.$i];	
			$swbrand = $_POST['it_sw_brand_id_'.$i];
			
			// check number edition assigned
			$query = "CALL it_check_license_assigned('".$mysql->real_escape_str($edition)."')";
			try{
				// calling mysql exe_query function
				if(!$result = $mysql->execute_query($query)){ 
					throw new Exception('Problem in checking number of edition');
				}
				$obj = $mysql->display_result($result);
				// free the memory
				$mysql->clear_result($result);
				// call the next result
				$mysql->next_query();
			}catch(Exception $e){
				echo 'Caught exception: ',  $e->getMessage(), "\n";
				die;
			}
			 
			// check number of license for each software
			$query = "CALL it_check_license('".$mysql->real_escape_str($edition)."')";
			try{
				// calling mysql exe_query function
				if(!$result = $mysql->execute_query($query)){ 
					throw new Exception('Problem in checking license');
				}
				$row = $mysql->display_result($result);
				// free the memory
				$mysql->clear_result($result);
				// call the next result
				$mysql->next_query();
			}catch(Exception $e){
				echo 'Caught exception: ',  $e->getMessage(), "\n";
				die;
			} 
			
			if($row['no_license'] > $obj['count']){
			
				$query = "CALL it_add_assign_asset('".$mysql->real_escape_str($type)."',  
					'".$date."','".$mysql->real_escape_str($status)."',
					'".$mysql->real_escape_str($edition)."', '".$mysql->real_escape_str($swtype)."', 
					'".$mysql->real_escape_str($swbrand)."', '".$mysql->real_escape_str($_POST['app_users_id'])."')";
				// Calling the function that makes the insert
				try{
					// calling mysql exe_query function
					if(!$result = $mysql->execute_query($query)){ 
						throw new Exception('Problem in executing edit assign asset');
					}
					$row = $mysql->display_result($result);
					$last_id = $row['inserted_id'];
					// free the memory
					$mysql->clear_result($result);
					// call the next result
					$mysql->next_query();
				}catch(Exception $e){
					echo 'Caught exception: ',  $e->getMessage(), "\n";
					die;
				}
			}else{
				$error = '1';
				if(empty($last_id)){
					// redirecting to list page
					header("Location: list_assign_asset.php?status=cant_update");	
				}
			}		
		}else if($_POST['type_'.$i] == 'H'){
			$record_id = $_POST['record_id_'.$i];
			$asset_type = $_POST['type_'.$i];	
			$inventory = $_POST['inventory_it_id_'.$i];
			$hwtype = $_POST['hw_type_id_'.$i];	
			$hwbrand = $_POST['it_hw_brand_id_'.$i];
			
			// query to insert into database. 
			$query = "CALL it_add_assign_asset('".$mysql->real_escape_str($asset_type)."',  
					'".$date."','".$status."','".$mysql->real_escape_str($inventory)."', '".$mysql->real_escape_str($hwtype)."', 
					'".$mysql->real_escape_str($hwbrand)."', '".$mysql->real_escape_str($_POST['app_users_id'])."')";
			// Calling the function that makes the insert
			try{
				// calling mysql exe_query function
				if(!$result = $mysql->execute_query($query)){ 
					throw new Exception('Problem in executing edit assign asset');
				}
				$row = $mysql->display_result($result);
				$last_id = $row['inserted_id'];
				// call the next result
				$mysql->next_query();
			}catch(Exception $e){
				echo 'Caught exception: ',  $e->getMessage(), "\n";
			}
		}
	}
	if(!empty($last_id) && empty($error)){ 
		// redirecting to list page
		header("Location: list_assign_asset.php?status=edit&asset_type=".$_POST['type']."&name=".$empname."");			
	}else if(!empty($last_id) && !empty($error)){
		// redirecting to list page
		header("Location: list_assign_asset.php?status=updated&type=error");	
	}
}

// smarty drop down for hardware types
$query = 'CALL it_get_hardware_type()';
try{
	// calling mysql exe_query function
	if(!$result = $mysql->execute_query($query)){ 
		throw new Exception('Problem in executing get hardware type');
	}
	$hw_type = array();
	while($hw = $mysql->display_result($result)){
    	$hw_type[$hw['id']] = ucfirst($hw['title']);    		   
	}
	$smarty->assign('hw_type',$hw_type);
	// free the memory
	$mysql->clear_result($result);
	// call the next result
	$mysql->next_query();
}catch(Exception $e){
	echo 'Caught exception: ',  $e->getMessage(), "\n";
}

// smarty drop down for software types
$query = 'CALL it_get_software_type()';
try{
	// calling mysql exe_query function
	if(!$result = $mysql->execute_query($query)){ 
		throw new Exception('Problem in executing get software type');
	}
	$sw_type = array();
	while($sw = $mysql->display_result($result)){
   	$sw_type[$sw['id']] = ucfirst($sw['title']);    		   
	}
	$smarty->assign('sw_type',$sw_type);
	// free the memory
	$mysql->clear_result($result);
	// call the next result
	$mysql->next_query();
}catch(Exception $e){
	echo 'Caught exception: ',  $e->getMessage(), "\n";
}

// smarty drop down for Employee names
$query = 'CALL it_get_employee()';
try{
	// calling mysql exe_query function
	if(!$result = $mysql->execute_query($query)){ 
		throw new Exception('Problem in executing get employee');
	}
	$emp_name = array();
	while($name = $mysql->display_result($result)){
    	$emp_name[$name['id']] = ucfirst($name['first_name']).' '.ucfirst($name['last_name']);    		   
	}
	$smarty->assign('emp_name',$emp_name);
	// free the memory
	$mysql->clear_result($result);
	// call the next result
	$mysql->next_query();
}catch(Exception $e){
	echo 'Caught exception: ',  $e->getMessage(), "\n";
}

// smarty drop down for software brands.
$query = "CALL it_get_brand('S')";
try{
	// calling mysql exe_query function
	if(!$result = $mysql->execute_query($query)){ 
		throw new Exception('Problem in executing get brand');
	}
	$sw_brand = array();
	while($s_brand = $mysql->display_result($result)){
    	$sw_brand[$s_brand['id']] = ucfirst($s_brand['title']);    		   
	}
	$smarty->assign('sw_brand',$sw_brand);
	// free the memory
	$mysql->clear_result($result);
	// call the next result
	$mysql->next_query();
}catch(Exception $e){
	echo 'Caught exception: ',  $e->getMessage(), "\n";
}

// smarty drop )down for hardware brands.
$query = "CALL it_get_brand('H')";
try{
	// calling mysql exe_query function
	if(!$result = $mysql->execute_query($query)){ 
		throw new Exception('Problem in executing get brand');
	}
	$hw_brand = array();
	while($h_brand = $mysql->display_result($result)){
    	$hw_brand[$h_brand['id']] = ucfirst($h_brand['title']);    		   
	}
	$smarty->assign('hw_brand',$hw_brand);
	// free the memory
	$mysql->clear_result($result);
	// call the next result
	$mysql->next_query();
}catch(Exception $e){
	echo 'Caught exception: ',  $e->getMessage(), "\n";
}

/*if(!empty($edition_it_idData)){
	// print_r($edition_it_idData);
	// print_r(array_chunk($edition_it_idData, 2));
	$s_edition = array();
	foreach($edition_it_idData as $key => $edition_id){
		// smarty drop down for software edition.
		$query = "CALL it_get_asset_edition('".$edition_id."')";
		try{
			// calling mysql exe_query function
			if(!$result = $mysql->execute_query($query)){ 
				throw new Exception('Problem in executing get asset edition with value');
			}
			$s_edition = array();
			while($sw_edition = $mysql->display_result($result)){
    			$s_edition[$sw_edition['id']] = ucfirst($sw_edition['edition']).' ('.ucfirst($sw_edition['title']).')';    		   
				// $s_edition[$sw_edition['id'].'-'.$sw_edition['no_license']] = ucfirst($sw_edition['edition']).' ('.ucfirst($sw_edition['title']).')';    		   			
			}
			$smarty->assign('s_edition',$s_edition);
			// print_r($s_edition);
			// free the memory
			$mysql->clear_result($result);
			// call the next result
			$mysql->next_query();
		}catch(Exception $e){
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
	}
}else{*/
// smarty drop down for software edition.
$query = "CALL it_get_asset_edition()";
try{
	// calling mysql exe_query function
	if(!$result = $mysql->execute_query($query)){ 
		throw new Exception('Problem in executing get asset edition without value');
	}
	$s_edition = array();
	while($sw_edition = $mysql->display_result($result)){
    	$s_edition[$sw_edition['id']] = ucfirst($sw_edition['edition']).' ('.ucfirst($sw_edition['title']).')';   
	}
	$smarty->assign('s_edition',$s_edition);
	// free the memory
	$mysql->clear_result($result);
	// call the next result
	$mysql->next_query();
}catch(Exception $e){
	echo 'Caught exception: ',  $e->getMessage(), "\n";
}

if(!empty($inventory_it_idData)){
	$h_inventory = array();
		// smarty drop down for hardware inventory.
	foreach($inventory_it_idData as $key => $inv_id){
		$query = "CALL it_get_asset_inventory('".$inv_id."')";
		try{
			// calling mysql exe_query function
			if(!$result = $mysql->execute_query($query)){ 
				throw new Exception('Problem in executing get asset inventory');
			}
			while($hw_inventory = $mysql->display_result($result)){
   		 	$h_inventory[$hw_inventory['id']] = ucfirst($hw_inventory['inventory_no']).' ('.ucfirst($hw_inventory['title']).')';    		 
			}
			$smarty->assign('h_inventory',$h_inventory);
			// free the memory
			$mysql->clear_result($result);
			// call the next result
			$mysql->next_query();
		}catch(Exception $e){
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
	}
}else{
	// smarty drop down for hardware inventory.
	$query = "CALL it_get_asset_inventory('')";
	try{
		// calling mysql exe_query function
		if(!$result = $mysql->execute_query($query)){
			throw new Exception('Problem in executing get asset inventory');
		}
		$h_inventory = array();
		while($hw_inventory = $mysql->display_result($result)){
  		  	$h_inventory[$hw_inventory['id']] = ucfirst($hw_inventory['inventory_no']).' ('.ucfirst($hw_inventory['title']).')';    		   
		}
		$smarty->assign('h_inventory',$h_inventory);
		// free the memory
		$mysql->clear_result($result);
	}catch(Exception $e){
		echo 'Caught exception: ',  $e->getMessage(), "\n";
	}
}
// closing mysql
$mysql->close_connection();
// assign page title
$smarty->assign('page_title' , 'Edit Assign Asset - IT');
// assigning active class status to smarty menu.tpl  
$smarty->assign('assign_asset_active','active');
// display smarty file 
$smarty->display('edit_assign_asset.tpl');
?>