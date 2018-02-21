<?php 
/* 
Purpose : To get brand.
Created : Nikitasa
Date : 02-01-2018
*/

include 'configs/smartyconfig.php';
// include mysql class
include('classes/class.mysql.php');
// Connecting Database
$mysql->connect_database();
// include function validation class
include('classes/class.function.php');

$type_id = $_GET['hwtype'] ? $_GET['hwtype'] : $_GET['hwtype'];

// smarty dropdown for brand
$query = "CALL it_get_inventory_byid('".$type_id."')";
try{
	// calling mysql exe_query function
	if(!$result = $mysql->execute_query($query)){
		throw new Exception('Problem in getting brand details');
	}
    $inventory = array();
	while($obj = $mysql->display_result($result)){
		$inventory[$obj['id'].'-'.$obj['brand_id']] = $obj['inventory_no'].' ('.$obj['brand'].')';  	   
	}
	
	// free the memory
	$mysql->clear_result($result);
}catch(Exception $e){
	echo 'Caught exception: ',  $e->getMessage(), "\n";
}
echo json_encode($inventory);

// closing mysql
$mysql->close_connection();	  
?>