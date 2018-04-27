<?php 
/* 
Purpose : To view dashboard
Created : Nikitasa 
Modified : Gayathri
Date : 17-06-2016
*/

// ini_set('display_errors', 1);

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
} 

// redirecting to dashboard if the user don't have the permission to this module
if($_SESSION['dashboard'] == 'empty'){
	header('Location:../home/?access=Access denied!');
}
*/
// getting the url variable to check access denied or not
$access_permission = $_GET['access'];
$smarty->assign('access',$access_permission);

// query for fetch software type graph 
$query = 'call it_get_sw_type_graph()';
// calling mysql exe_query function
try{
	if(!$result = $mysql->execute_query($query)){
		throw new Exception('Problem in executing software type graph');
	}
	// fetch result
	while($obj = $mysql->display_result($result)){
	 $data_sw_type[] = $obj; 
	}
	// free the memory
	$mysql->clear_result($result);
	// call the next result
	$mysql->next_query();
}catch(Exception $e){
	echo 'Caught exception: ',  $e->getMessage(), "\n";
}

// query for fetch software type graph 
$query = 'call it_get_sw_edition_graph()';
// calling mysql exe_query function
try{
	if(!$result = $mysql->execute_query($query)){
		throw new Exception('Problem in executing software edition graph');
	}
	// fetch result
	while($obj = $mysql->display_result($result)){
	 $data_sw_edition[] = $obj; 
	 $sw_edition[$obj['edition']] = $obj['no_license']; 
	}
	// free the memory
	$mysql->clear_result($result);
	// call the next result
	$mysql->next_query();
}catch(Exception $e){
	echo 'Caught exception: ',  $e->getMessage(), "\n";
}

// query for fetch assign software graph 
$query = 'call it_get_sw_assigned_graph()';
// calling mysql exe_query function
try{
	if(!$result = $mysql->execute_query($query)){
		throw new Exception('Problem in executing software edition graph');
	}
	// fetch result
	while($obj = $mysql->display_result($result)){
	 $data_assign_sw[] = $obj; 
	 $as_sw_edition[$obj['edition']] = $obj['count']; 
	}
	// free the memory
	$mysql->clear_result($result);
	// call the next result
	$mysql->next_query();
}catch(Exception $e){
	echo 'Caught exception: ',  $e->getMessage(), "\n";
}

// fetching unassigned software graph 
foreach($sw_edition as $key => $record){
	if(array_key_exists($key, $as_sw_edition)){
		$assigned_sw_edition[$key] = $sw_edition[$key];
	}else{
		$un_sw_edition[$key] = $sw_edition[$key].'_'.$sw_edition[$key];
	}		
}
// fetching unassigned software license 
foreach($sw_edition as $key => $record){
	if(array_key_exists($key, $as_sw_edition)){
		if($sw_edition[$key] - $as_sw_edition[$key] > 0){
			$un_sw_edition_bylicense[$key] = $sw_edition[$key].'_'.($sw_edition[$key] - $as_sw_edition[$key]);			
		}
	}
}
// Combining unassigned software and unassigned software license
if(isset($un_sw_edition) && isset($un_sw_edition_bylicense)){
	$data_unassign_sw = array_merge($un_sw_edition,$un_sw_edition_bylicense);
}

// query for fetch hardware type graph
$query = 'call it_get_hw_type_graph()';
try{
	// calling mysql exe_query function
	if(!$result = $mysql->execute_query($query)){
		throw new Exception('Problem in executing hardware graph page');
	}
	// fetch result
	while($obj = $mysql->display_result($result)){
		$data_hw_type[] = $obj;
	}
	// free the memory
	$mysql->clear_result($result);
	// call the next result
	$mysql->next_query();
}catch(Exception $e){
	echo 'Caught exception: ',  $e->getMessage(), "\n";
}

// query for fetch hardware brand graph
$query = 'call it_get_hw_brand_graph()';
try{
	// calling mysql exe_query function
	if(!$result = $mysql->execute_query($query)){
		throw new Exception('Problem in executing hardware graph page');
	}
	$i = 0;
	// fetch result
	while($obj = $mysql->display_result($result)){
		$data_hw_brand[] = $obj;
		$data_hw_brand[$i]['brand'] = $obj['brand'];
		$i++;
	}
	// free the memory
	$mysql->clear_result($result);
	// call the next result
	$mysql->next_query();
}catch(Exception $e){
	echo 'Caught exception: ',  $e->getMessage(), "\n";
}

// query for fetch assign hardware graph
$query = 'call it_get_hw_assigned_graph()';
try{
	// calling mysql exe_query function
	if(!$result = $mysql->execute_query($query)){
		throw new Exception('Problem in executing hardware graph page');
	}
	$i = 0;
	// fetch result
	while($obj = $mysql->display_result($result)){
		$data_assign_hw[] = $obj;
		$data_assign_hw[$i]['brand'] = $obj['brand'];
		$i++;
	}
	// free the memory
	$mysql->clear_result($result);
	// call the next result
	$mysql->next_query();
}catch(Exception $e){
	echo 'Caught exception: ',  $e->getMessage(), "\n";
}


// get unassigned hardware by brand graph
$query = 'call it_get_hw_unassigned_graph()';
try{
	// calling mysql exe_query function
	if(!$result = $mysql->execute_query($query)){
		throw new Exception('Problem in executing hardware graph page');
	}
	$i = 0;
	// fetch result
	while($obj = $mysql->display_result($result)){
		$data_unassign_hw[] = $obj;
		$data_unassign_hw[$i]['brand'] = $obj['brand'];
		$i++;
	}
	// free the memory
	$mysql->clear_result($result);
	// call the next result
	$mysql->next_query();
}catch(Exception $e){
	echo 'Caught exception: ',  $e->getMessage(), "\n";
}


// query for fetch records
$query = 'call it_get_request_change_graph()';
try{
	// calling mysql exe_query function
	if(!$result = $mysql->execute_query($query)){
		throw new Exception('Problem in executing req. change page');
	}
	// fetch result
	$i = 0;
	while($obj = $mysql->display_result($result)){
		$data_req_change[] = $obj;
		$data_req_change[$i]['status'] = $fun->dashboard_status($obj['status']);
		$i++;
	}
	// free the memory
	$mysql->clear_result($result);
	// call the next result
	$mysql->next_query();
}catch(Exception $e){
	echo 'Caught exception: ',  $e->getMessage(), "\n";
}

// query for fetch records
$query = 'call it_get_ticket_graph()';
try{
	// calling mysql exe_query function
	if(!$result = $mysql->execute_query($query)){ 
		throw new Exception('Problem in executing ticket graph page');
	}	// fetch result
	$i = 0;
	while($obj = $mysql->display_result($result)){
	 $data_ticket[] = $obj;
	 $data_ticket[$i]['status'] = $fun->ticket_status($obj['status']);
	 $i++;
	}
	// free the memory
	$mysql->clear_result($result);
	// call the next result
	$mysql->next_query();
}catch(Exception $e){
	echo 'Caught exception: ',  $e->getMessage(), "\n";
}

// Display graph based on order
$dt = array();
$query = "CALL it_display_graph()";  
$result = $mysql->execute_query($query);  
$i = '0';
while($obj = $mysql->display_result($result)){  
	$data[] = $obj;
	$data[$i]['id'] =  $obj['id'];
	$dt[$i] =  $obj['id'];
	$smarty->assign("dt_$dt[$i]", $dt[$i]); 
	$data[$i]['order_to_sort'] =  $obj['sort'];
	$data[$i]['graph_name'] = $obj['graph_name'];
	$i++;	
}


/*while($obj = $mysql->display_result($result)){  
	$graph[$obj['id']] = $obj['order_to_sort'];
	$graph_name[$obj['order_to_sort']] = $obj['graph_name'];
}
   // call the next result
	$mysql->next_query();

foreach($graph as $key => $order){
	if($order != 0){
		 $_SESSION['val'][$order] = 'piechart'.$key; 
	 }
}

foreach($graph_name as $key => $title){
	if($key != 0){
		echo $_SESSION['title'][$key] = $title; 
	}
}*/

// assign smarty variables here
$smarty->assign('data', $data); 
$smarty->assign('data_sw_type', $data_sw_type);
$smarty->assign('data_assign_sw', $data_assign_sw);
$smarty->assign('data_sw_edition', $data_sw_edition);
$smarty->assign('data_hw_type', $data_hw_type);
$smarty->assign('data_hw_brand', $data_hw_brand);
$smarty->assign('data_assign_hw', $data_assign_hw);
$smarty->assign('data_req_change', $data_req_change);
$smarty->assign('data_ticket', $data_ticket);
$smarty->assign('data_unassign_hw' , $data_unassign_hw);
$smarty->assign('data_unassign_sw' , $data_unassign_sw);
// assign page title
$smarty->assign('page_title' , 'Home - IT');  
// assigning active class status to smarty menu.tpl
$smarty->assign('dashboard_active' , 'active'); 	  
// display smarty template
$smarty->display('dashboard.tpl');
?>