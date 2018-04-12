<?php
/* 
Purpose : To add the hardware inventory details.
Created : Gayathri
Modified : Nikitasa
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


// redirect to error page if the user is not it admin
if($roleid != '21'){
	header('Location:'.IT_DIR.'home/');
}
// Access next page only after finishing previous step.
if($_SESSION['h']['add_hardware_inventory_details'] != 'next'){
	header('Location:page_error.php');
}

if(!empty($_POST)){
	// quantity assigning to session
	$_SESSION['h']['inv_count'] = $_POST['inv_count'];
	for($i = 0; $i <= $_POST['inv_count'] - 1; $i++){
		$fieldtype = array('0', '0', '1', '1');
		$actualfield = array('inventory no', 'asset description', 'location', 'location');
  		$fields = array('inventory_no' => 'inventory_noErr', 'asset_desc' => 'asset_descErr',
      'state_id' => 'stateErr', 'district_id' => 'stateErr');
		$j = 0;
	   foreach($fields as $field => $er_var){
			if($_POST[$field.'_'.$i] == ''){
				$error_msg = $fieldtype[$j] ? ' select the ' : ' enter the ';
				$actual_field =  $actualfield[$j];
				$_SESSION['h'][$i][$er_var] = 'Please'. $error_msg .$actual_field;
				$test = 'error';
				$_SESSION['h'][$i][$field] = '';
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
		} */
	 	
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
		
		// query to check whether asset description no is exist or not.  
		$query = "CALL it_check_asset_description_exist('0','".$_POST['asset_desc_'.$i]."')";
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
	
	   /*
		if($_POST['inventory_no_'.$i] == $_POST['inventory_no_'.$i]){
			$msg = "You can not save same inventory number";
			$_SESSION['h'][$i]['inventory_noErr'] = $msg;			
		}		
		*/
	
		// status field validation
  		//$_SESSION['h'][$i]['status'] = isset($_POST['status_'.$i]) ? $_POST['status_'.$i] : ($_GET['status_'.$i] != '' ? $_GET['status_'.$i] : '1');
	}
	
	// redirection to next page
	if(empty($test) && empty($msg)){
		$_SESSION['h']['add_hardware_pricing_details'] = 'next';
		if($_POST['next_hdn'] == '1' && $_SESSION['h']['add_hardware_type'] == 'New'){
			header('Location: add_hardware_pricing_details.php');			
		}else if($_POST['next_hdn'] == '1' && $_SESSION['h']['add_hardware_type'] == 'Rental'){
			header('Location: add_rental_hardware_pricing_details.php');			
		}else if($_POST['confirm_hdn'] == '1'){
			header('Location: add_hardware_confirmation.php');	
		}
	}
	if($_POST['previous_hdn'] == '1'){
			header('Location: add_hardware_details.php');		
	}	
}

// no. of quantity
$inv_count = isset($_GET['qty']) ? $_GET['qty']+1 : $_SESSION['h']['inv_count'];
// inventory field quantity assigning to session
$_SESSION['h']['invcount'] = $inv_count;
$smarty->assign('qty',$qty);
// smarty dropdown for State
$query = 'CALL it_get_state()';
try{
	// calling mysql exe_query function
	if(!$result = $mysql->execute_query($query)){
		throw new Exception('Problem in executing get state');
	}
	$states = array();
	$states_id = array();
	while($state = $mysql->display_result($result)){
    	$states[$state['id']] = $state['state_name'];    		   
    	$states_id[] = $state['id'];    		   
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
$smarty->assign('page_title' , 'Add Hardware - IT');  
$smarty->assign('hardware_active','active'); 
$smarty->display('add_hardware_inventory_details.tpl');
?>