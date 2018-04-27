<?php 
/* 
Purpose : To view approve scrap hardware.
Created : Nikitasa
Date : 28-02-2018
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

// redirect to error page if the user is not it admin
/* if($roleid != '21'){
	header('Location:'.IT_DIR.'home/');
}*/

// redirecting to dashboard if the user don't have the permission to this module
if(empty($_SESSION['ApproveScrapHardware'])){
	header('Location:../home/?access=Access denied!');
}

// get record id   
$id = $_GET['id'];
if(($fun->isnumeric($id)) || ($fun->is_empty($id)) || ($id == 0)){
  		header('Location:page_error.php');
}

// select and execute query and fetch the result
$query = "CALL it_view_scrap_hardware('".$id."')"; 
try{
	if(!$result = $mysql->execute_query($query)){
		throw new Exception('Problem in executing view page');
	}
	$i = 0;
	// check record exists
	if($result->num_rows){
		// calling mysql fetch_result function
		while($obj = $mysql->display_result($result)){  
			$data[] = $obj;
			$data[$i]['approve_date'] = $fun->it_software_created_date($obj['approve_date']);
			$data[$i]['created_date'] = $fun->it_software_created_date($obj['created_date']);
			$data[$i]['paid_date'] = $fun->it_software_created_date($obj['paid_date']);
			$data[$i]['paid_mode'] = $fun->it_software_paid_mode($obj['paid_mode']);
			$data[$i]['purchase_date'] = $fun->it_software_created_date($obj['purchase_date']);
			$data[$i]['validity_from'] = $fun->it_software_created_date($obj['validity_from']);
			$data[$i]['validity_to'] = $fun->it_software_created_date($obj['validity_to']);
			$data[$i]['scrap_date'] = $fun->it_software_created_date($obj['scrap_date']);
			$data[$i]['hw_type'] = $fun->it_scrap_hw_type($obj['hw_type']);
			$data[$i]['hw_type_val'] = $obj['hw_type'];
			$data[$i]['scrap'] = $fun->it_scrap_hw_status($obj['scrap_status']);
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
	$path = 'uploads/hardware/'.$_GET['file'];
	$fun->download_file($path);
}

// calling mysql close db connection function
$c_c = $mysql->close_connection();

// here assign smarty variables
$smarty->assign('id' , $_GET['id']); 
$smarty->assign('data', $data); 
$smarty->assign('roleid', $roleid); 

// assign page title
$smarty->assign('page_title' , 'View Approve Hardware - IT');
// assigning active class status to smarty menu.tpl
$smarty->assign('scrap_hardware_active' , 'active'); 	   
// display smarty template
$smarty->display('view_approve_scrap_hardware.tpl');
?>
