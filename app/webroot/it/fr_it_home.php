<?php
/* 
Purpose : To list change asset request and help desk.
Created : Nikitasa
Date : 01-07-2016
*/

//include smarty congig file
include 'configs/smartyconfig.php';
// include mysql class
include('classes/class.mysql.php');
// Connecting Database
$mysql->connect_database();
// include function validation class
include('classes/class.function.php');
// include paging class 
include('classes/class.paging.php');

// get user id
$user_id = $fun->get_user_id();

// count change emp status
$query = "call it_count_change_emp('".$user_id."')";
try{
	if(!$result = $mysql->execute_query($query)){
		throw new Exception('Problem in executing change asset page');
	}
	// calling mysql fetch_result function
	$obj_asset = $mysql->display_result($result);

	// free the memory
	$mysql->clear_result($result);
	// call the next result
	$mysql->next_query();
}catch(Exception $e){
	echo 'Caught exception: ',  $e->getMessage(), "\n";
}
// assign ticket count variables here
$smarty->assign('asset_count', $obj_asset['count']);


// count ticket emp
$query = "CALL it_count_ticket_emp('".$user_id."')";
try{
	if(!$result = $mysql->execute_query($query)){
		throw new Exception('Problem in executing ticket page');
	}
	// calling mysql fetch_result function
	$obj_ticket = $mysql->display_result($result);

	// free the memory
	$mysql->clear_result($result);
	// call the next result
	$mysql->next_query();
}catch(Exception $e){
	echo 'Caught exception: ',  $e->getMessage(), "\n";
}
// assign ticket count variables here
$smarty->assign('ticket_count', $obj_ticket['count']);


// count the total no. of records for change request asset
$query = "CALL it_list_change_request_emp('".$user_id."','0','0','','')";
try{
	if(!$result = $mysql->execute_query($query)){
		throw new Exception('Problem in executing  change asset request  page');
	}
	// fetch result
	$data_num = $mysql->display_result($result);
	// count result
	$count = $data_num['total'];
	if($count == 0){
		$alert_msg = 'No change asset request found';
	}
	$page = $_GET['page'] ?  $_GET['page'] : 1;
	$limit = 250;
	include('paging_call.php');	

	// free the memory
	$mysql->clear_result($result);
	// call the next result
	$mysql->next_query();
}catch(Exception $e){
	echo 'Caught exception: ',  $e->getMessage(), "\n";
}

// count the total no. of records for help desk
$query = "CALL it_list_ticket_emp('".$user_id."','0','0','','')";
try{
	if(!$result = $mysql->execute_query($query)){
		throw new Exception('Problem in executing help desk page');
	}
	// fetch result
	$data_num = $mysql->display_result($result);
	// count result
	$count = $data_num['total'];
	if($count == 0){
		$alert_msg1 = 'No ticket found';
	}
	$page = $_GET['page'] ?  $_GET['page'] : 1;
	$limit = 250;
	include('paging_call.php');	

	// free the memory
	$mysql->clear_result($result);
	// call the next result
	$mysql->next_query();
}catch(Exception $e){
	echo 'Caught exception: ',  $e->getMessage(), "\n";
}
// set the condition to check ascending or descending order		
$order = ($_GET['order'] == 'desc') ? 'asc' :  'desc';	
$sort_fields = array('message','type','created_date','status');
$org_fields = array('message','type','created_date','status');

// to set the sorting image
foreach($sort_fields as $key => $s_field){
	if($s_field != $_GET['field']){ 
		$smarty->assign('sort_field_'.$s_field,'sorting');
	}else{	
		$order_img = ($_GET['order'] == 'asc') ? 'sorting desc' :  'sorting asc';
		$smarty->assign('sort_field_'.$s_field,$order_img);
	}			
}
// if no fields are set, set default sort image
if(empty($_GET['field'])){		
	$order = 'desc';			
	$field = 'created_date';			
	$smarty->assign('sort_field_created', 'sorting desc');
}
	
$smarty->assign('order', $order);
// set the original field for the sql query
if($search_key = array_search($_GET['field'], $sort_fields)){
	$field =  $org_fields[$search_key];
}

// fetch all records for change request asset
$query = "CALL it_list_change_request_emp('".$user_id."','0','$limit','".$field."','".$order."')";

try{
	if(!$result = $mysql->execute_query($query)){
		throw new Exception('Problem in executing change asset request page');
	}
	// calling mysql fetch_result function
	$i = '0';
	while($obj = $mysql->display_result($result))
	{
 		$data_asset[] = $obj;
 		$data_asset[$i]['message'] = $fun->string_truncate($obj['message'],'50');
 		$data_asset[$i]['type'] = $fun->it_brand_type($obj['type']);
		$data_asset[$i]['type_status'] = $obj['type'];
		$data_asset[$i]['status'] = $fun->dashboard_status($obj['status']);
		$data_asset[$i]['status_cls'] = $fun->ticket_status_cls($obj['status']);
	 	$data_asset[$i]['created_date'] = $fun->it_software_created_date($obj['created_date']);
	   $i++;
 		$pno[]=$paging->print_no();
 		$smarty->assign('pno',$pno);
	}
  // validating pagination
	$total_pages = ceil($count / $limit);

	// free the memory
	$mysql->clear_result($result);
	// call the next result
	$mysql->next_query();
}catch(Exception $e){
	echo 'Caught exception: ',  $e->getMessage(), "\n";
}

// fetch all records for help desk
$query = "CALL it_list_ticket_emp('".$user_id."','0','$limit','".$field."','".$order."')";

try{
	if(!$result = $mysql->execute_query($query)){
		throw new Exception('Problem in executing help desk page');
	}
	// calling mysql fetch_result function
	$i = '0';
	while($obj = $mysql->display_result($result))
	{
 		$data_ticket[] = $obj;
 		$data_ticket[$i]['subject'] = $fun->string_truncate($obj['subject'],'50');
	 	$data_ticket[$i]['priority'] = $fun->ticket_priority($obj['priority']);
	 	$data_ticket[$i]['created_date'] = $fun->it_software_created_date($obj['created_date']);
		$data_ticket[$i]['status'] = $fun->ticket_status($obj['status']);
		$data_ticket[$i]['status_cls'] = $fun->ticket_status_cls($obj['status']);
	   $i++;
 		$pno[]=$paging->print_no();
 		$smarty->assign('pno',$pno);
	}
   // create,update,delete message validation
	if($_GET['status'] == 'deleted' || $_GET['status'] == 'created' || $_GET['status'] == 'updated'){
 	 $alert_msg = 'Record ' . $_GET['status'] . ' successfully';
	}
	// validating pagination
	$total_pages = ceil($count / $limit);

	// free the memory
	$mysql->clear_result($result);
	
	$mysql->next_query();
}catch(Exception $e){
	echo 'Caught exception: ',  $e->getMessage(), "\n";
}

// fetch all records for list assign employee for software
$query = "CALL it_list_assign_emp('".$user_id."','S', 'A')";

try{
	if(!$result = $mysql->execute_query($query)){
		throw new Exception('Problem in executing my software page');
	}
	// calling mysql fetch_result function
	while($obj = $mysql->display_result($result))
	{
 		$data_software[] = $obj;
	}
	// free the memory
	$mysql->clear_result($result);
	// call the next result
	$mysql->next_query();
}catch(Exception $e){
	echo 'Caught exception: ',  $e->getMessage(), "\n";
}

// fetch all records for list_assign_emp hardware
$query = "CALL it_list_assign_emp('".$user_id."','H','A')";

try{
	if(!$result = $mysql->execute_query($query)){
		throw new Exception('Problem in executing my hardware page');
	}
	// calling mysql fetch_result function
	while($obj = $mysql->display_result($result)){
 		$data_hardware[] = $obj;
	}
	// free the memory
	$mysql->clear_result($result);
}catch(Exception $e){
	echo 'Caught exception: ',  $e->getMessage(), "\n";
}

// calling mysql close db connection function
$c_c = $mysql->close_connection();
$smarty->assign('data_software', $data_software);
$smarty->assign('data_hardware', $data_hardware);
$smarty->assign('data_ticket', $data_ticket);
$smarty->assign('data_asset', $data_asset);
$smarty->assign('page' , $page); 
$smarty->assign('total_pages' , $total_pages); 	
$smarty->assign('ALERT_MSG_ASSET', $alert_msg); 
$smarty->assign('ALERT_MSG_TICKET', $alert_msg1);
$smarty->assign('ALERT_MSG_SW', $alert_msg2); 
$smarty->assign('ALERT_MSG_HW', $alert_msg3);  
// display smarty file
$smarty->display('fr_it_home.tpl');
?>