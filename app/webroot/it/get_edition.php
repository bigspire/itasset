<?php 
/* 
Purpose : To get specialization.
Created : Nikitasa
Date : 02-08-2016
*/

// starting session
session_start();

include 'configs/smartyconfig.php';
// include mysql class
include('classes/class.mysql.php');
// Connecting Database
$mysql->connect_database();
// include function validation class
include('classes/class.function.php');

$type_id = $_GET['swtype'] ? $_GET['swtype'] : $_GET['hwtype'];

// smarty drop down for edition
$query = "CALL it_get_edition_byid('".$type_id."')";
try{
	// calling mysql exe_query function
	if(!$result = $mysql->execute_query($query)){
		throw new Exception('Problem in executing edition');
	}
    $edition = array();
	while($obj = $mysql->display_result($result)){
		$edition[$obj['id'].'-'.$obj['brand_id']] = $obj['edition'].' ('.$obj['brand'].')';  	   
	}
	
	// free the memory
	$mysql->clear_result($result);
}catch(Exception $e){
	echo 'Caught exception: ',  $e->getMessage(), "\n";
}
echo json_encode($edition);

// closing mysql
$mysql->close_connection();	  
?>