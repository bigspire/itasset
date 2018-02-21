<?php 
/* 
Purpose : To view ticket in front end.
Created : Nikitasa
Date : 01-07-2016
*/

include 'configs/smartyconfig.php';
// include mysql class
include('classes/class.mysql.php');
// Connecting Database
$mysql->connect_database();
// include function validation class
include('classes/class.function.php');

// get record id   
$id = $_GET['id'];
if(($fun->isnumeric($id)) || ($fun->is_empty($id)) || ($id == 0)){
  		header('Location:page_error.php');
}

// select and execute query and fetch the result
$query = "CALL it_view_ticket_emp('".$id."')"; 
try{
	if(!$result = $mysql->execute_query($query)){
		throw new Exception('Problem in executing ticket page');
	}
	$i = '0';
	// check record exists
	if($result->num_rows){
		// calling mysql fetch_result function
		while($obj = $mysql->display_result($result)){  
			$data_view_ticket[] = $obj;
			$data_view_ticket[$i]['created_date'] = $fun->date_time($obj['created_date']);
			$data_view_ticket[$i]['status'] = $fun->ticket_status($obj['status']);
			$data_view_ticket[$i]['priority'] = $fun->ticket_priority($obj['priority']);
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
	$path = 'uploads/ticket/'.$_GET['file'];
	$fun->download_file($path);
}

// calling mysql close db connection function
$c_c = $mysql->close_connection();

// here assign smarty variables
$smarty->assign('id' , $_GET['id']); 
$smarty->assign('data_view_ticket', $data_view_ticket);
// display smarty file
$smarty->display('fr_view_ticket.tpl');
?>