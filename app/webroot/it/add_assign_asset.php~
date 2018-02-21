<?php
/* 
Purpose : To add assign asset.
Created : Gayathri
Modified : Ravi,Nikitasa
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

if(!empty($_POST)){
	
	 // employee Field Validation
    if($fun->not_empty($_POST['employee'])){
		$smarty->assign('employee' , $_POST['employee']);
    }else{
		$test = 'error';
		$smarty->assign('employeeErr' , 'Please select the employee');
    }

	// post of assign asset fields value
	for($i = 0; $i < $_POST['asset_count']; $i++){
		
		// query to check whether it is exist or not. 
		$query = "CALL it_check_assign_inventory_no_exist('0','".$_POST['inventory_'.$i]."')";
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
				$er[$i][$inventoryErr] = $msg;
				// $smarty->assign('EXIST_MSG',$msg); 
		}
		
		if($_POST['asset_type_'.$i] == 'S'){
			$asset_typeData[$i] = $_POST['asset_type_'.$i];
			$swtypeData[$i] = $_POST['swtype_'.$i];
			$editionData[$i] = $_POST['edition_'.$i];
			$swbrandData[$i] = $_POST['swbrand_'.$i];		
			// Validating the required fields  
			// array for printing correct field name in error message	
			$fieldtype = array('1', '1', '1');
			$actualfield = array('software type', 'software brand', 'edition');
			$field_ar = array('swtype_'.$i => 'sw_typeErr', 'swbrand_'.$i => 'sw_brandErr','edition_'.$i => 'editionErr');
			$j = 0;
			foreach($field_ar as $field => $er_var){ 
				if($_POST[$field] == ''){
					$error_msg = $fieldtype[$j] ? ' select the ' : ' enter the ';
					$actual_field =  $actualfield[$j];
					$er[$i][$er_var] = 'Please'. $error_msg .$actual_field;
				}
				$j++;
			}

		}else{
			$asset_typeData[$i] = $_POST['asset_type_'.$i];
			$inventoryData[$i] = $_POST['inventory_'.$i];
			$hwbrandData[$i] = $_POST['hwbrand_'.$i];
			$hwtypeData[$i] = $_POST['hwtype_'.$i];
			// Validating the required fields  
			// array for printing correct field name in error message
			$fieldtype = array('1', '1', '1');
			$actualfield = array('hardware type', 'hardware brand', 'inventory no');
  			$field_ar = array('hwtype_'.$i => 'hw_typeErr', 'hwbrand_'.$i => 'hw_brandErr', 'inventory_'.$i => 'inventoryErr');
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
	$smarty->assign('asset_typeData', $asset_typeData);
	$smarty->assign('swtypeData', $swtypeData);
	$smarty->assign('hwtypeData', $hwtypeData);
	$smarty->assign('hwbrandData', $hwbrandData);
	$smarty->assign('swbrandData', $swbrandData);
	$smarty->assign('editionData', $editionData);
	$smarty->assign('inventoryData', $inventoryData);
	$smarty->assign('assetCount', $_POST['asset_count']);
	$smarty->assign('assetErr',$er);
}

// assigning the date
$date = $fun->current_date();
$status = '1';
if(empty($er) && empty($test)){
			
	// iterate the for to insert all the assign asset 
	for($i = 0; $i < $_POST['asset_count']; $i++){
		if($_POST['asset_type_'.$i] == 'S'){
			$asset_type = $_POST['asset_type_'.$i];	
			$edition = $_POST['edition_'.$i];
			$swtype = $_POST['swtype_'.$i];	
			$swbrand = $_POST['swbrand_'.$i];	
			
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
						
				// query to insert into database. 
				$query = "CALL it_add_assign_asset('".$mysql->real_escape_str($asset_type)."', '".$date."','".$status."',
				'".$mysql->real_escape_str($edition)."', '".$mysql->real_escape_str($swtype)."', 
				'".$mysql->real_escape_str($swbrand)."', '".$mysql->real_escape_str($_POST['employee'])."')";
				// Calling the function that makes the insert
				try{
					// calling mysql exe_query function
				 
					if(!$result = $mysql->execute_query($query)){
						throw new Exception('Problem in executing add assign asset');
					}
				
					$row = $mysql->display_result($result);
					$last_id = $row['inserted_id'];				
					// free the memory
					$mysql->clear_result($result);
					// call the next result
					$mysql->next_query();
				}catch(Exception $e){
					echo 'Caught exception: ',  $e->getMessage(), "\n";
				}
			}else{
				$error = '1';
				if(empty($last_id)){
					// redirecting to list page
					header("Location: list_assign_asset.php?status=cant_update");	
				}
			}	
		}else if($_POST['asset_type_'.$i] == 'H'){
			$asset_type = $_POST['asset_type_'.$i];	
			$inventory = $_POST['inventory_'.$i];
			$hwtype = $_POST['hwtype_'.$i];	
			$hwbrand = $_POST['hwbrand_'.$i];

			// query to insert into database. 
			$query = "CALL it_add_assign_asset('".$mysql->real_escape_str($asset_type)."','".$date."','".$status."',
				'".$mysql->real_escape_str($inventory)."', '".$mysql->real_escape_str($hwtype)."', 
				'".$mysql->real_escape_str($hwbrand)."', '".$mysql->real_escape_str($_POST['employee'])."')";
			// Calling the function that makes the insert
			try{
				// calling mysql exe_query function
				if(!$result = $mysql->execute_query($query)){
					throw new Exception('Problem in executing add assign asset');
				}
				$row = $mysql->display_result($result);
				$last_id = $row['inserted_id'];
				// free the memory
				$mysql->clear_result($result);
				// call the next result
				$mysql->next_query();
			}catch(Exception $e){
				echo 'Caught exception: ',  $e->getMessage(), "\n";
			}
		}
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
		
	if(!empty($last_id) && empty($error)){ 
		// redirecting to view page
		header("Location: list_assign_asset.php?status=add");		
	}else if(!empty($last_id) && !empty($error)){
		// redirecting to list page
		header("Location: list_assign_asset.php?status=created&type=error");	
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
		throw new Exception('Problem in executing get software brand');
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

// smarty drop down for hardware brands.
$query = "CALL it_get_brand('H')";
try{
	// calling mysql exe_query function
	if(!$result = $mysql->execute_query($query)){
		throw new Exception('Problem in executing get hardware brand');
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

// smarty drop down for software edition.
$query = "CALL it_get_asset_edition()";
try{
	// calling mysql exe_query function
	if(!$result = $mysql->execute_query($query)){
		throw new Exception('Problem in executing get asset edition');
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
// closing mysql
$mysql->close_connection();
// assign page title
$smarty->assign('page_title' , 'Add Assign Asset - IT');  
// assigning active class status to smarty menu.tpl  
$smarty->assign('assign_asset_active','active'); 
// display smarty file
$smarty->display('add_assign_asset.tpl');
?>