<?php
/* 
Purpose : To list and search Change Asset Info
Created : Nikitasa
Date : 20-06-2016
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
if(empty($_SESSION['ChangeAssetInfo'])){
	// start session 
	session_start();
	header('Location:../home/?access=Access denied!');
}
//unset session
unset($_SESSION['s']);
	
$keyword = $_POST['keyword'] ? $_POST['keyword'] : $_GET['keyword'];
$asset_type = $_POST['asset_type'] ? $_POST['asset_type'] : $_GET['asset_type'];
$emp_name = $_POST['emp_name'] != '' ? $_POST['emp_name'] : $_GET['emp_name'];
$status = $_POST['status'] != '' ? $_POST['status'] : $_GET['status'];
$t_date = $_POST['t_date'] ? $_POST['t_date'] : $_GET['t_date'];
$f_date = $_POST['f_date'] ? $_POST['f_date'] : $_GET['f_date'];    
$from_date = $fun->convert_date($f_date);
$to_date = $fun->convert_date($t_date);
    
// $asset_type = $asset_type == '' ? 'S' : $asset_type;
$emp_name = ($emp_name == '') ? 0 : $emp_name;

//post url for paging
if($_POST){
	$post_url .= '&keyword='.$keyword;
	$post_url .= '&emp_name='.$emp_name;
	$post_url .= '&asset_type='.$asset_type;
	$post_url .= '&status='.$status;
	$post_url .= '&f_date='.$f_date;
	$post_url .= '&t_date='.$t_date;
}

// count the total no. of records
$query = "CALL it_list_change_asset('".$keyword."','".$emp_name."','".$asset_type."','".$status."','".$from_date."','".$to_date."','0','0','','','".$_GET['action']."')";

try{
	if(!$result = $mysql->execute_query($query)){
		throw new Exception('Problem in executing list page');
	}
	// fetch result
	$data_num = $mysql->display_result($result);
	// count result
	$count = $data_num['total'];
	if($count == 0){
		if($keyword){
			$alert_msg = 'No change asset info "' .$keyword. '" is found in our database';
		}else{
			$alert_msg = 'No change asset info details found in our database';
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
$sort_fields = array('1' => 'emp_name','asset_type','message','created_date','modified');
$org_fields = array('1' => 'full_name','type','message','created_date','modified_date');

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
if(empty($_GET['field']) && empty($keyword)){		
	$order = 'desc';			
	$field = 'created_date';			
	$smarty->assign('sort_field_created', 'sorting desc');
}	
$smarty->assign('order', $order);
// set the original field for the sql query
if($search_key = array_search($_GET['field'], $sort_fields)){
	$field =  $org_fields[$search_key];
}

// fetch all data from get_employee_type
$query = 'CALL it_get_employee()';
try{
	if(!$result = $mysql->execute_query($query)){
		throw new Exception('Problem in executing employee type page');
	}
	$emp_name_drop['0'] = 'Employee';
	while($obj = $mysql->display_result($result)){
 		$emp_name_drop[$obj['id']] = ucfirst($obj['first_name']).' '.ucfirst($obj['last_name']);
	}

	// free the memory
	$mysql->clear_result($result);
	// call the next result
	$mysql->next_query();
}catch(Exception $e){
	echo 'Caught exception: ',  $e->getMessage(), "\n";
}
// fetch all records
$query = "CALL it_list_change_asset('".$keyword."','".$emp_name."','".$asset_type."','".$status."','".$from_date."','".$to_date."','$start','$limit','".$field."','".$order."','".$_GET['action']."')";
try{
	if(!$result = $mysql->execute_query($query)){
		throw new Exception('Problem in executing list page');
	}

	// calling mysql fetch_result function
	$i = '0';
	while($obj = $mysql->display_result($result))
	{
 		$data[] = $obj;
 		$data[$i]['message'] = $fun->string_truncate($obj['message'],'50');
 		$data[$i]['full_name'] = $fun->upper_case_string($obj['full_name']);
 		$data[$i]['status'] = $fun->dashboard_status($obj['status']);
		$data[$i]['status_cls'] = $fun->ticket_status_cls($obj['status']);
		$data[$i]['type'] = $fun->it_brand_type($obj['type']);
		$data[$i]['type_status'] = $obj['type'];
 		$data[$i]['created_date'] = $fun->it_software_created_date($obj['created_date']);
 		$data[$i]['modified_date'] = $fun->it_software_created_date($obj['modified_date']);
 		$data[$i]['pending'] = $fun->time_diff($obj['created_date'], $ago_str=0, 0);
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
      $excelObj->printHeader($header = array('Employee Name','Type','Message','Created Date','Modified Date','Status') ,$col = array('A','B','C','D','E','F'));  
		// function to print the excel data
		$excelObj->printCell($data, $count,$col = array('A','B','C','D','E','F'), $field = array('full_name','type','message','created_date','modified_date','status'),'Change Asset Info_'.$current_date);
		die;
	}

	// assign software status into array 
	$asset_type_drop = array('' => 'Asset Type', 'S' => 'Software', 'H' => 'Hardware');
	
	// smarty drop down array for status
		$smarty->assign('type', array('' => 'Status', 'O' => 'Open', 'C' => 'Closed', 'N' => 'Not-Closed', 'H' => 'Hold'));
	// create,update,delete message validation
	if($_GET['update_status'] == 'updated'){
  		$success_msg = 'Change asset info ' . $_GET['update_status'] . ' successfully';
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
$smarty->assign('asset_type_drop', $asset_type_drop);
$smarty->assign('emp_name', $emp_name);
$smarty->assign('emp_name_drop', $emp_name_drop);
$smarty->assign('asset_type', $asset_type);
$smarty->assign('data', $data);
$smarty->assign('page' , $page); 
$smarty->assign('total_pages' , $total_pages); 	
$smarty->assign('keyword' , $keyword); 
$smarty->assign('f_date', $f_date);
$smarty->assign('t_date', $t_date);	
$smarty->assign('status', $status);
$smarty->assign('ALERT_MSG', $alert_msg);
$smarty->assign('SUCCESS_MSG', $success_msg);
// assign page title
$smarty->assign('page_title' , 'Change Asset Info - IT');  
// assigning active class status to smarty menu.tpl
$smarty->assign('assign_asset_active' , 'active'); 	  
// display smarty file
$smarty->display('list_change_asset_info.tpl');
?>