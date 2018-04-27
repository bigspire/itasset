<?php 
/* 
Purpose : To view software.
Created : Nikitasa
Date : 07-06-2016
*/

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
if(empty($_SESSION['Software'])){
	header('Location:../home/?access=Access denied!');
}
// starting the session
session_start();
// get record id   
$id = $_GET['id'];
if(($fun->isnumeric($id)) || ($fun->is_empty($id)) || ($id == 0)){
  		header('Location:page_error.php');
}

// select and execute query and fetch the result
$query = "CALL it_view_software_page('".$id."')"; 
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
 			$data[$i]['subscription'] =  $fun->it_software_subscription($obj['subscription']);
 	   	$data[$i]['status'] = $fun->it_software_status($obj['status']);
 	   	$data[$i]['arch'] = $fun->it_software_architecture($obj['arch']);
 	   	$data[$i]['paid_mode'] = $fun->it_software_paid_mode($obj['paid_mode']);
 	   	$data[$i]['currency_type'] = $fun->currency_type($obj['currency_type']);
 	   	$data[$i]['validity_from'] = $fun->it_software_created_date($obj['validity_from']);
 	   	$data[$i]['validity_till'] = $fun->it_software_created_date($obj['validity_till']);
 	   	$data[$i]['paid_date'] = $fun->it_software_created_date($obj['paid_date']);
			$i++;	
		}
	}else{
		header('Location:page_error.php');
	}
	// free the memory
	$mysql->clear_result($result);
}catch(Exception $e){
	echo 'Caught exception: ',  $e->getMessage(), "\n";
}

// to download files
if($_GET['action'] == 'download'){
	$path = 'uploads/software/'.$_GET['file'];
	$fun->download_file($path);
}

// calling mysql close db connection function
$c_c = $mysql->close_connection();

// here assign smarty variables
$smarty->assign('id' , $_GET['id']); 
$smarty->assign('data', $data); 
// assign page title
$smarty->assign('page_title' , 'View Software - IT');
// assigning active class status to smarty menu.tpl
$smarty->assign('software_active' , 'active'); 	   
// display smarty template
$smarty->display('view_software.tpl');
?>