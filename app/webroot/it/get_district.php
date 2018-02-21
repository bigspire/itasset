<?php 
/* 
Purpose : To get distict.
Created : Nikitasa
Date : 08-07-2016
*/

include 'configs/smartyconfig.php';
// include mysql class
include('classes/class.mysql.php');
// Connecting Database
$mysql->connect_database();
// include function validation class
include('classes/class.function.php');

$states_id = $_GET['state'];

// smarty dropdown for District
$query ="CALL it_get_district('".$states_id."')";
try{
	// calling mysql exe_query function
	if(!$result = $mysql->execute_query($query)){
		throw new Exception('Problem in executing district page');
	}
   $district = array();
	while($obj = $mysql->display_result($result)){
   	$district[$obj['id']] = $obj['district_name'];  	   
	}
	//$smarty->assign('district',$district);  
	
	// free the memory
	$mysql->clear_result($result);
}catch(Exception $e){
	echo 'Caught exception: ',  $e->getMessage(), "\n";
}
echo json_encode($district);

// closing mysql
$mysql->close_connection();	  
?>