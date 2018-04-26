<?php
/* 
Purpose : To list and search hardware details.
Created : Nikitasa
Modified : Gayathri
Date : 14-06-2016
*/

session_start();
//unset session
session_destroy();

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
	session_start();
	header('Location:dashboard.php?access=Access denied!');
}

$keyword = $_POST['keyword'] ? $_POST['keyword'] : $_GET['keyword'];
$hw_type = $_POST['hw_type'] ? $_POST['hw_type'] : $_GET['hw_type'];
$t_date = $_POST['t_date'] ? $_POST['t_date'] : $_GET['t_date'];
$f_date = $_POST['f_date'] ? $_POST['f_date'] : $_GET['f_date'];   
$rental_type = $_POST['rental_type'] ? $_POST['rental_type'] : $_GET['rental_type'];  
$from_date = $fun->convert_date($f_date);
$to_date = $fun->convert_date($t_date);
$hw_type = $hw_type == '' ? 0 : $hw_type;

// to display the data using status filter
if(isset($_POST['hw_status'])){
	$hw_status = $_POST['hw_status'];
}else if(isset($_GET['hw_status'])){
	$hw_status = $_GET['hw_status'];
}else{
	$hw_status = '1';
}

//post url for paging
if($_POST){
	$post_url .= '&keyword='.$keyword;
	$post_url .= '&hw_status='.$hw_status;
	$post_url .= '&rental_type='.$rental_type;
	$post_url .= '&hw_type='.$hw_type;
	$post_url .= '&f_date='.$f_date;
	$post_url .= '&t_date='.$t_date;
}
	
// for export
if($_GET['action'] == 'export'){
	$hw_status = $_GET['hw_status']; 
}
					
// count the total no. of records
$query = "CALL it_list_hardware('".$mysql->real_escape_str($keyword)."','".$hw_type."','".$hw_status."','".$rental_type."','".$from_date."','".$to_date."','0','0','','','".$_GET['action']."')";
try{
	if(!$result = $mysql->execute_query($query)){
		throw new Exception('Problem in executing list hardware page');
	}

	// fetch result
	$data_num = $mysql->display_result($result);
	// count result
	$count = $data_num['total'];
	if($count == 0){
		if($keyword){
			$alert_msg = 'No hardware "' .$keyword. '" is found in our database';
		}else{
			$alert_msg = 'No hardware details found in our database';
		}
	}
	$page = $_GET['page'] ?  $_GET['page'] : 1;
	$limit = 20;
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
$sort_fields = array('1' => 'hardware_type','brand','model_id','inventory_no','location','asset_desc','validity','vendor','modified','created');
$org_fields = array('1' => 'ht.title', 'b.title', 'h.model_id', 'hi.inventory_no','ad.district_name','hi.asset_desc','validity_to','vendor_name','modified_date','created_date');

// to set the sorting image
foreach($sort_fields as $key => $h_field){
	if($h_field != $_GET['field']){ 
		$smarty->assign('sort_field_'.$h_field,'sorting');
	}else{	
		$order_img = ($_GET['order'] == 'asc') ? 'sorting desc' :  'sorting asc';
		$smarty->assign('sort_field_'.$h_field,$order_img);
	}			
}

// if no fields are set, set default sort image
if(empty($_GET['field']) && empty($keyword)){		
	$order = 'desc';			
	$field = 'h.created_date';			
	$smarty->assign('sort_field_created', 'sorting desc');
}	
$smarty->assign('order', $order);
// set the original field for the sql query
if($search_key = array_search($_GET['field'], $sort_fields)){
	$field =  $org_fields[$search_key];
}
// fetch all data from get_hardware_type
$query = 'call it_get_hardware_type()';
try{
	if(!$result = $mysql->execute_query($query)){
		throw new Exception('Problem in executing hardware type page');
	}
	$hw_type_data['0'] = 'Hardware Type';
	while($obj = $mysql->display_result($result))
	{
 		$hw_type_data[$obj['id']] = ucfirst($obj['title']);
	}

	// free the memory
	$mysql->clear_result($result);
	// call the next result
	$mysql->next_query();
}catch(Exception $e){
	echo 'Caught exception: ',  $e->getMessage(), "\n";
}
// fetch all records
$query = "CALL it_list_hardware('".$mysql->real_escape_str($keyword)."','".$hw_type."','".$hw_status."','".$rental_type."','".$from_date."','".$to_date."','$start','$limit',
'".$field."','".$order."','".$_GET['action']."')";

try{
	if(!$result = $mysql->execute_query($query)){
		throw new Exception('Problem in executing list hardware page');
	}
	// calling mysql fetch_result function
	$i = '0';
	while($obj = $mysql->display_result($result))
	{
 	$data[] = $obj;
 	$data[$i]['subscription'] =  $fun->it_software_subscription($obj['subscription']);
 	$data[$i]['status'] = $fun->it_software_status($obj['status']);
	if($obj['scrap_hw_type'] != '' and $obj['scrap_status'] != 'R'){
		$data[$i]['scrap_hw_type'] = '['.$fun->it_scrap_hw($obj['scrap_hw_type']).']';
	}
	$data[$i]['scrap_status'] = $obj['scrap_status'];
	$data[$i]['status_cls'] = $fun->status_cls($obj['status']);
	$data[$i]['is_rental_hw'] = $obj['is_rental'] == 'Y' ? 'Rental' : 'New';
	$data[$i]['is_rental_status'] = $obj['is_rental'] == 'Y' ? 'Yes' : 'No';
	$data[$i]['validity_to'] = $fun->it_software_created_date($obj['validity_to']);
 	$data[$i]['created_date'] = $fun->it_software_created_date($obj['created_date']);
 	$data[$i]['modified_date'] = $fun->it_software_created_date($obj['modified_date']);
 	$i++;
 	$pno[]=$paging->print_no();
 	$smarty->assign('pno',$pno);
	}
	// get current date 
	$current_date = $fun->display_date();	
	// call to export the excel data
	if(($_GET['action'] == 'export') && ($count > 0)){ 
		include('classes/class.excel.php');
		$excelObj = new libExcel();
		// function to print the excel header
      $excelObj->printHeader($header = array('Type','Is Rental','Brand','Model Id','Inventory No','Location','Asset Description','Validity','Vendor','Created Date','Modified Date','Status') ,$col = array('A','B','C','D','E','F','G','H','I','J','K','L'));  
		// function to print the excel data
		$excelObj->printCell($data, $count,$col = array('A','B','C','D','E','F','G','H','I','J','K','L'), $field = array('type','is_rental_status','brand','model_id','inventory_no','location','asset_desc','validity_to','vendor_name','created_date','modified_date','status'),'Hardwares_'.$current_date);
	}
	// assign software status into array 
	$type = array('' => 'All Status', '1' => 'Active', '0' => 'Inactive');
	// assign software status into array 
	$rental_types = array('' => 'Hardware', 'N' => 'New', 'Y' => 'Rental');
	// create,update,delete message validation
	if($_GET['status'] == 'deleted' || $_GET['status'] == 'created' || $_GET['status'] == 'updated'){
  		$success_msg = 'Hardware details ' . $_GET['status'] . ' successfully';
	}else if($_GET['status'] == 'not_deleted'){
		$erro_msg = "You cannot delete unless you remove this hardware from assigned asset.";	
	}else if($_GET['status'] == 'not_deleted_scrap'){
		$erro_msg = "You cannot move this to scrap unless you remove this hardware from assigned asset.";	
	}else if($_GET['status'] == 'not_exchange'){
		$erro_msg = "You cannot exchange / re-sale this unless you remove this hardware from assigned asset.";	
	}else if($_GET['status'] == 'moved'){
		$success_msg = "Harware Details went for Director Approval";	
	}

	
	// validating pagination
	$total_pages = ceil($count / $limit);

	// free the memory
	$mysql->clear_result($result);
}catch(Exception $e){
	echo 'Caught exception: ',  $e->getMessage(), "\n";
}	
// calling mysql close db connection function
$c_c = $mysql->close_connection();

$paging->posturl($post_url);

// assign smarty variables here
$smarty->assign('page_links',$paging->print_link_frontend());
$smarty->assign('type', $type);
$smarty->assign('rental_type', $rental_type);
$smarty->assign('rental_types', $rental_types);
$smarty->assign('hw_status', $hw_status);
$smarty->assign('hw_type', $hw_type);
$smarty->assign('data', $data);
$smarty->assign('hw_type_data', $hw_type_data);
$smarty->assign('page' , $page); 
$smarty->assign('total_pages' , $total_pages); 	
$smarty->assign('keyword' , $keyword); 
$smarty->assign('f_date', $f_date);
$smarty->assign('t_date', $t_date);	
$smarty->assign('ALERT_MSG', $alert_msg);
$smarty->assign('SUCCESS_MSG', $success_msg);
$smarty->assign('ERROR_MSG', $erro_msg);
// assign page title
$smarty->assign('page_title' , 'Hardware - IT');  
// assigning active class status to smarty menu.tpl
$smarty->assign('hardware_active' , 'active'); 	  
// display smarty file
$smarty->display('list_hardware.tpl');
?>