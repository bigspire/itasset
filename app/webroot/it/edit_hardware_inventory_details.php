<?php
/* 
Purpose : To edit the hardware inventory details.
Created : Gayathri
Date : 15-06-2016
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

// redirecting to dashboard if the user don't have the permission to this module
if(empty($_SESSION['Hardware'])){
	$_SESSION['e']['alert'] = 'Access denied!';
	header('Location:dashboard.php');
}

// get database values only when session has no values
$getid = $_GET['id'];
$smarty->assign('getid', $getid);
$inv_id = $_GET['inv_id'];
$smarty->assign('invid',$inv_id);

// validate url 
if(($fun->isnumeric($getid)) || ($fun->is_empty($getid)) || ($getid == 0)){
	header('Location:page_error.php');
}

// Selecting the record to edit
if($_SESSION['h']['0']['inventory_no'] == ''){
	 $query = "CALL it_get_hw_inventory('$inv_id')";
	try{
		// calling mysql exe_query function
		if(!$result = $mysql->execute_query($query)){ 
			throw new Exception('Problem in executing get hardware');
		}
		$i = '0';
		while($row = $mysql->display_result($result)){
			$_SESSION['h'][$i]['inventory_no'] =  $row['inventory_no'];
			$_SESSION['h'][$i]['serial_no'] = $row['serial_no'];
			$_SESSION['h'][$i]['asset_desc'] = $row['asset_desc'];
			//$_SESSION['h'][$i]['status'] = $row['status'];
			$_SESSION['h'][$i]['district_id'] = $row['district_id'];
			$_SESSION['h'][$i]['state_id'] = $row['state_id'];
			$_SESSION['h'][$i]['id'] = $row['id'];
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
	 $_SESSION['h']['get_inv_count'] = $i;
}

if(!empty($_POST)){
	// quantity assigning to session
	$_SESSION['h']['post_inv_count'] = $_POST['inv_count'];
	for($i = 0; $i < $_POST['inv_count']; $i++){
		
		$fieldtype = array('0', '0', '1', '1');
		$actualfield = array('inventory no', 'asset description', 'location', 'location');
  	   $field = array('inventory_no' => 'inventory_noErr', 'asset_desc' => 'asset_descErr',
      'state_id' => 'stateErr', 'district_id' => 'stateErr');
		$j = 0;
		foreach ($field as $field => $er_var){ 
			if($_POST[$field.'_'.$i] == ''){
				$error_msg = $fieldtype[$j] ? ' select the ' : ' enter the ';
				$actual_field =  $actualfield[$j];
				$_SESSION['h'][$i][$er_var] = 'Please'. $error_msg .$actual_field;
				$test = 'error';
			}else{
				$_SESSION['h'][$i][$er_var] = '';
				$_SESSION['h'][$i][$field] = $_POST[$field.'_'.$i]; 
			}
			$j++;
		}	
	   if($_POST['serial_no_'.$i] == ''){
			$_SESSION['h'][$i]['serial_no'] = '';
		}else{
			$_SESSION['h'][$i]['serial_no'] = $_POST['serial_no_'.$i];
		}
		
		// Amount validation
		/* if($fun->isnumeric($_POST['asset_desc_'.$i]) == true){
			$msg = "Please enter numeric values";
			$_SESSION['h'][$i]['asset_descErr'] = $msg; 	
		}*/
		
		$inv_exist_id = $_SESSION['h'][$i]['id'] ? $_SESSION['h'][$i]['id'] : 0;
		
		// query to check whether inventory no is exist or not.  
		$query = "CALL it_check_inventory_no_exist('".$inv_exist_id."','".$_POST['inventory_no_'.$i]."')";
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
		
		// query to check whether asset description no is exist or not.  
		$query = "CALL it_check_asset_description_exist('".$inv_exist_id."','".$_POST['asset_desc_'.$i]."')";
		try{
			// calling mysql exe_query function
			if(!$result = $mysql->execute_query($query)){ 
				throw new Exception('Problem in checking exist asset description');
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
				$msg = "Asset description already exists";
				$_SESSION['h'][$i]['asset_descErr'] = $msg;
		}
		// status field validation
		//$_SESSION['h'][$i]['status'] = isset($_POST['status_'.$i]) ? $_POST['status_'.$i] : ($_GET['status_'.$i] != '' ? $_GET['status_'.$i] : '1');
	}
	// redirection to next page
	if(empty($test) && empty($msg)){
		$_SESSION['h']['edit_hardware_details'] = 'next';		
		if($_POST['next_hdn'] == '1' && $_SESSION['h']['is_rental'] == 'Y'){
			header('Location: edit_rental_hardware_pricing_details.php?id='.$getid.'&inv_id='.$inv_id.'');	
		}else if($_POST['next_hdn'] == '1'){
			header('Location: edit_hardware_pricing_details.php?id='.$getid.'&inv_id='.$inv_id.'');	
		}else if($_POST['confirm_hdn'] == '1'){
			header('Location: edit_hardware_confirmation.php?id='.$getid.'&inv_id='.$inv_id.'');		
		}
	}
	if($_POST['previous_hdn'] == '1'){
		header('Location: edit_hardware_details.php?id='.$getid.'&inv_id='.$inv_id.'');		
	}
}

// no. of quantity
$inv_count = isset($_SESSION['h']['post_inv_count']) ? $_SESSION['h']['post_inv_count'] : $_SESSION['h']['get_inv_count'];
// inventory field quantity assigning to session
$_SESSION['h']['invcount'] = $inv_count;
// smarty dropdown for State
$query = 'CALL it_get_state()';
try{
	// calling mysql exe_query function
	if(!$result = $mysql->execute_query($query)){ 
		throw new Exception('Problem in executing get state');
	}
	$states = array();
	while($state = $mysql->display_result($result)){
    	$states[$state['id']] = $state['state_name'];    		   
	}
	$smarty->assign('state',$states);
	// free the memory
	$mysql->clear_result($result);
	// call the next result
	$mysql->next_query();
}catch(Exception $e){
	echo 'Caught exception: ',  $e->getMessage(), "\n";
}

for($i = 0; $i < $_SESSION['h']['invcount']; $i++){
	// smarty dropdown for District
	$query = "CALL it_get_district('".$_SESSION['h'][$i]['state_id']."')";
	try{
		// calling mysql exe_query function
		if(!$result = $mysql->execute_query($query)){
			throw new Exception('Problem in executing get district');
		}
		$districts = '';
		while($district = $mysql->display_result($result)){
			$districts .= $district['id'].'-'.$district['district_name'].'|';    		   
		}
		// free the memory
		$mysql->clear_result($result);
		// call the next result
	   $mysql->next_query();
	   $dist_data[] = $districts;
	}catch(Exception $e){
		echo 'Caught exception: ',  $e->getMessage(), "\n";
	}
}

$smarty->assign('districts',$dist_data);
$smarty->assign('no_quantity', $no_quantity);
$smarty->assign('invcount', $inv_count);
// closing mysql
$mysql->close_connection();
$smarty->assign('page_title' , 'Edit Hardware - IT');  
$smarty->assign('hardware_active','active'); 
$smarty->display('edit_hardware_inventory_details.tpl');
?>