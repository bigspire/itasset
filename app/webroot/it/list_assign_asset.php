<?php
/* 
Purpose : To list and search Assign Asset.
Created : Nikitasa
Date : 18-06-2016
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
if(empty($_SESSION['AssignAssset'])){
	//start session 
	session_start();
	header('Location:../home/?access=Access denied!');
}
//unset session
unset($_SESSION['s']);
	
$keyword = $_POST['keyword'] ? $_POST['keyword'] : $_GET['keyword'];
$emp_name = $_POST['emp_name'] != '' ? $_POST['emp_name'] : $_GET['emp_name'];
$t_date = $_POST['t_date'] ? $_POST['t_date'] : $_GET['t_date'];
$f_date = $_POST['f_date'] ? $_POST['f_date'] : $_GET['f_date'];    
$from_date = $fun->convert_date($f_date);
$to_date = $fun->convert_date($t_date);
    
$emp_name = ($emp_name == '') ? 0 : $emp_name;

//post url for paging
if($_POST){
	$post_url .= '&keyword='.$keyword;
	$post_url .= '&emp_name='.$emp_name;
	$post_url .= '&f_date='.$f_date;
	$post_url .= '&t_date='.$t_date;
}

// count the total no. of records
$query = "CALL it_list_assign_asset('".$keyword."','".$emp_name."','".$from_date."','".$to_date."','0','0','','','')";

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
			$alert_msg = 'No assign asset "' .$keyword. '" is found in our database';
		}else{
			$alert_msg = 'No assign asset details found in our database';
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
$sort_fields = array('1' => 'emp_name','no_of_sw','no_of_hw','created');
$org_fields = array('1' => 'emp_name','no_of_sw','no_of_hw','created_date');

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
		throw new Exception('Problem in executing list page');
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
$query = "CALL it_list_assign_asset('".$keyword."','".$emp_name."','".$from_date."','".$to_date."','$start','$limit','".$field."','".$order."','')";
try{
	if(!$result = $mysql->execute_query($query)){
		throw new Exception('Problem in executing fetch all records query');
	}

	// calling mysql fetch_result function
	$i = '0';
	while($obj = $mysql->display_result($result))
	{
 		$data[] = $obj;
 		$data[$i]['emp_name'] = $fun->upper_case_string($obj['emp_name']);
 		$data[$i]['created_date'] = $fun->it_software_created_date($obj['created_date']);
 		$i++;
	   $pno[]=$paging->print_no();
	   $smarty->assign('pno',$pno);
   }
		
	// create,update,delete message validation
	if($_GET['status'] == 'add'){
  		$success_msg = 'Asset assigned successfully';
  	}else if($_GET['status'] == 'edit'){
  		$success_msg = 'Asset updated and re-assigned successfully';
	}else if($_GET['status'] == 'deleted'){
		$success_msg = 'Asset '.   $_GET['status'] .  ' successfully';
	}else if($_GET['status'] == 'cant_update'){
		$error_msg = "Software license got exhausted. Please buy license to assign the software.";
	}else if($_GET['type'] == 'error' || $_GET['status']){
		$success_msg = 'Asset '.   $_GET['status'] .  ' successfully';
		$error_msg = "Software license got exhausted. Please buy license to assign the software.";
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

if(!empty($_GET['action'])){
	// fetch all records for list assign employee for software
	$query = "CALL it_export_assign_asset('".$keyword."','".$emp_name."','".$from_date."','".$to_date."','0','0','','','".$_GET['action']."')";
	try{
		if(!$result = $mysql->execute_query($query)){
			throw new Exception('Problem in executing export page');
		}
		// calling mysql fetch_result function
		$obj = $mysql->display_result($result);
		// count result
		$count_total = $obj['total'];
		// free the memory
		$mysql->clear_result($result);
		// call the next result
		$mysql->next_query();
	}catch(Exception $e){
		echo 'Caught exception: ',  $e->getMessage(), "\n";
	}

	// fetch all records for list assign employee for software
	 $query = "CALL it_export_assign_asset('".$keyword."','".$emp_name."','".$from_date."','".$to_date."','$start','$limit','".$field."','".$order."','".$_GET['action']."')";
	
	try{
		if(!$result = $mysql->execute_query($query)){
			throw new Exception('Problem in executing export page');
		}
		$i = '0';
		// calling mysql fetch_result function
		while($obj = $mysql->display_result($result))
		{
			$data_assigned[] = $obj;
			$data_assigned[$i]['emp_name'] = $fun->upper_case_string($obj['emp_name']);
			$data_assigned[$i]['hw_type'] = $fun->upper_case_string($obj['hw_type']);
			$data_assigned[$i]['brand'] = $fun->upper_case_string($obj['brand']);
			$data_assigned[$i]['inventory_no'] = $fun->upper_case_string($obj['inventory_no']);
			$data_assigned[$i]['asset_desc'] = $fun->upper_case_string($obj['asset_desc']);
			$data_assigned[$i]['sw_type'] = $fun->upper_case_string($obj['sw_type']);
			$data_assigned[$i]['edition'] = $fun->upper_case_string($obj['edition']);
			$data_assigned[$i]['created_date'] = $fun->it_software_created_date($obj['created_date']);
			$data_assigned[$i]['accept_date'] = $fun->it_software_created_date($obj['accept_date']);
			if($obj['accept'] == 'Y'){
				$data_assigned[$i]['accept'] = 'Accepted';
			}else{
				$data_assigned[$i]['accept'] = 'Awaiting';
			}
			$i++;
		}
		
		// get current date 
		$current_date = $fun->display_date();	

		// call to export the excel data
		if($_GET['action'] == 'H'){ 
			include('classes/class.excel.php');
			$excelObj = new libExcel();
			// function to print the excel header
		  $excelObj->printHeader($header = array('Employee Name','Hardware Type','Brand','Inventory No','Asset Description','Status','Verified Date','Created') ,$col = array('A','B','C','D','E','F','G','H'));  
			// function to print the excel data
			$excelObj->printCell($data_assigned, $count_total,$col = array('A','B','C','D','E','F','G','H'), $field = array('emp_name','hw_type','brand','inventory_no','asset_desc','accept','accept_date','created_date'),'Assigned HW Assets_'.$current_date);
			die;
		}else if($_GET['action'] == 'S'){
			include('classes/class.excel.php');
			$excelObj = new libExcel();
			// function to print the excel header
		  $excelObj->printHeader($header = array('Employee Name','Software Type','Brand','Edition','Status','Verified Date','Created') ,$col = array('A','B','C','D','E','F','G'));  
			// function to print the excel data
			$excelObj->printCell($data_assigned, $count_total,$col = array('A','B','C','D','E','F','G'), $field = array('emp_name','sw_type','brand','edition','accept','accept_date','created_date'),'Assigned SW Assets_'.$current_date);
			die;
		}
		// free the memory
		$mysql->clear_result($result);
		// call the next result
		$mysql->next_query();
	}catch(Exception $e){
		echo 'Caught exception: ',  $e->getMessage(), "\n";
	}
}

// calling mysql close db connection function
$c_c = $mysql->close_connection();

$paging->posturl($post_url);

// assign smarty variables here
$smarty->assign('page_links',$paging->print_link_frontend());
$smarty->assign('data_assigned', $data_assigned);
$smarty->assign('emp_name', $emp_name);
$smarty->assign('emp_name_drop', $emp_name_drop);
$smarty->assign('data', $data);
$smarty->assign('page' , $page); 
$smarty->assign('total_pages' , $total_pages); 	
$smarty->assign('keyword' , $keyword); 
$smarty->assign('f_date', $f_date);
$smarty->assign('t_date', $t_date);	
$smarty->assign('ALERT_MSG', $alert_msg);
$smarty->assign('SUCCESS_MSG', $success_msg);
$smarty->assign('ERROR_MSG', $error_msg);
// assign page title
$smarty->assign('page_title' , 'Assign Asset - IT');  
// assigning active class status to smarty menu.tpl
$smarty->assign('assign_asset_active' , 'active'); 	  
// display smarty file
$smarty->display('list_assign_asset.tpl');
?>