<?php 
/* 
Purpose : To view hardware.
Created : Nikitasa
Date : 19-06-2016
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
$query = "CALL it_view_billing('".$id."')"; 
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
 			$data[$i]['hw_type'] =  $fun->it_scrap_hw_type($obj['hw_type']);
			$data[$i]['payment_type'] =  $fun->it_software_paid_mode($obj['payment_type']);
			$data[$i]['invoice_date'] =  $fun->it_software_created_date($obj['invoice_date']);
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


// to download files
if($_GET['action'] == 'download'){
	$path = 'uploads/bill_copy/'.$_GET['file'];
	$fun->download_file($path);
}

// calling mysql close db connection function
$c_c = $mysql->close_connection();

// here assign smarty variables
$smarty->assign('id' , $_GET['id']); 
$smarty->assign('data', $data); 
// assign page title
$smarty->assign('page_title' , 'View Billing Hardware - IT');
// assigning active class status to smarty menu.tpl
$smarty->assign('hardware_active' , 'active'); 	   
// display smarty template
$smarty->display('view_billing_hardware.tpl');
?>
