<?php 
/* 
Purpose : To view hardware.
Created : Nikitasa
Modified: Gayathri
Date : 15-06-2016
*/
// ini_set('display_errors',1);
include 'configs/smartyconfig.php';
// include mysql class
include('classes/class.mysql.php');
// Connecting Database
$mysql->connect_database();
// include function validation class
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
if(empty($_SESSION['Hardware'])){
	header('Location:dashboard.php?access=Access denied!');
}
// get record id   
$id = $_GET['id'];
if(($fun->isnumeric($id)) || ($fun->is_empty($id)) || ($id == 0)){
  		header('Location:page_error.php');
}

// select and execute query and fetch the result
$query = "CALL it_view_hw_inventory('".$id."')"; 
try{
	if(!$result = $mysql->execute_query($query)){
		throw new Exception('Problem in executing view page');
	}
	// check record exists
	if($result->num_rows){
	// calling mysql fetch_result function
		$i = '0';
		while($obj = $mysql->display_result($result)){  
			$data[] = $obj;
 			$data[$i]['id'] =  $obj['id'];
 			$data[$i]['inventory_no'] =  $obj['inventory_no'];
 	  	   $data[$i]['asset_desc'] = $obj['asset_desc'];
 	   	$data[$i]['serial_no'] = $obj['serial_no'];
 	   	$data[$i]['district_name'] = $obj['district_name'];
 	   	$data[$i]['state_name'] = $obj['state_name'];
			$i++;	
		}
	}else{
		header('Location:page_error.php');
	}
	// free the memory
	$mysql->clear_result($result);
	// call the next result
	$mysql->next_query();
}catch(Exception $e){
	echo 'Caught exception: ',  $e->getMessage(), "\n";
}

$query = "CALL it_view_hardware('".$id."')";
try{
	// calling mysql exe_query function
	if(!$result = $mysql->execute_query($query)){ 
		throw new Exception('Problem in executing view hardware');
	}
	$row = $mysql->display_result($result);
	$smarty->assign('currency' ,$fun->currency_type($row['currency_type']));
	$smarty->assign('rental_type_details' ,$fun->rental_type_validation($row['rental_type']));
	//$smarty->assign('rows',$row);
	// assign the db values into session
	foreach($row as $key => $record){
		$smarty->assign($key,$record);
	}
	// free the memory
	$mysql->clear_result($result);
}catch(Exception $e){
	echo 'Caught exception: ',  $e->getMessage(), "\n";
}

// to download files
if($_GET['action'] == 'download'){
	$path = 'uploads/hardware/'.$_GET['file'];
	$fun->download_file($path);
}

// calling mysql close db connection function
$c_c = $mysql->close_connection();

// here assign smarty variables
$smarty->assign('id' , $_GET['id']); 
$smarty->assign('data', $data); 
$smarty->assign('paid_date', $fun->it_software_created_date($row['paid_date'])); 
$smarty->assign('purchase_date', $fun->it_software_created_date($row['purchase_date'])); 
$smarty->assign('validity_from', $fun->it_software_created_date($row['validity_from'])); 
$smarty->assign('validity_to', $fun->it_software_created_date($row['validity_to'])); 
// assign page title
$smarty->assign('page_title' , 'View Hardware - IT');
// assigning active class status to smarty menu.tpl
$smarty->assign('hardware_active' , 'active'); 	   
// display smarty template
$smarty->display('view_hardware.tpl');
?>
