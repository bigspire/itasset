<?php
/* 
Purpose : To list and search ticket.
Created : Nikitasa
Date : 16-06-2016
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
if(empty($_SESSION['HelpDesk'])){
	session_start();
	header('Location:dashboard.php?access=Access denied!');
}
//unset session
unset($_SESSION['s']);

$keyword = $_POST['keyword'] ? $_POST['keyword'] : $_GET['keyword'];
$emp_name = $_POST['emp_name'] != '' ? $_POST['emp_name'] : $_GET['emp_name'];
$t_status = $_POST['t_status'] != '' ? $_POST['t_status'] : $_GET['t_status'];
$t_date = $_POST['t_date'] ? $_POST['t_date'] : $_GET['t_date'];
$f_date = $_POST['f_date'] ? $_POST['f_date'] : $_GET['f_date'];    
$from_date = $fun->convert_date($f_date);
$to_date = $fun->convert_date($t_date);
$t_status = empty($t_status) ?  '0' : $t_status;

//post url for paging
if($_POST){
	$post_url .= '&keyword='.$keyword;
   $post_url .= '&emp_name='.$emp_name;
	$post_url .= '&t_status='.$t_status;
   $post_url .= '&f_date='.$f_date;
	$post_url .= '&t_date='.$t_date;
}

// count the total no. of records
$query = "CALL it_list_ticket('".$keyword."','".$emp_name."','".$t_status."','".$from_date."','".$to_date."','0','0','','','".$_GET['action']."')";
try{
	if(!$result = $mysql->execute_query($query)){
		throw new Exception('Problem in executing list ticket page');
	}
	// fetch result
	$data_num = $mysql->display_result($result);
	// count result
	$count = $data_num['total'] ? $data_num['total'] : 0;
	if($count == 0){
		if($keyword){
			$alert_msg = 'No ticket "' .$keyword. '" is found in our database';
		}else{
			$alert_msg = 'No ticket details found in our database';
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
$sort_fields = array('1' => 'full_name','subject', 'type', 'priority', 'description','attach_file','created');
$org_fields = array('1' => 'emp_name','subject', 'type', 'priority', 'description','attach_file','created_date');

// to set the sorting image
foreach($sort_fields as $key => $t_field){
	if($t_field != $_GET['field']){ 
		$smarty->assign('sort_field_'.$t_field,'sorting');
	}else{	
		$order_img = ($_GET['order'] == 'asc') ? 'sorting desc' :  'sorting asc';
		$smarty->assign('sort_field_'.$t_field,$order_img);
	}			
}
// if no fields are set, set default sort image
if(empty($_GET['field']) && empty($keyword)){		
	$order = 'desc';			
	$field = 'itt.created_date';			
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
		throw new Exception('Problem in executing list ticket page');
	}
	$emp_name_drop['0'] = 'Employee';
	while($obj = $mysql->display_result($result)){
 		$emp_name_drop[$obj['id']] = ucfirst($obj['first_name']).' '.($obj['last_name']);
	}

	// free the memory
	$mysql->clear_result($result);
	// call the next result
	$mysql->next_query();
}catch(Exception $e){
	echo 'Caught exception: ',  $e->getMessage(), "\n";
}

// fetch all records
$query = "CALL it_list_ticket('".$keyword."','".$emp_name."','".$t_status."','".$from_date."','".$to_date."','$start','$limit','".$field."','".$order."','".$_GET['action']."')";
try{
	if(!$result = $mysql->execute_query($query)){
		throw new Exception('Problem in executing list ticket page');
	}
	// calling mysql fetch_result function
	$i = '0';
	while($obj = $mysql->display_result($result))
	{
 		$data[] = $obj;
 		$data[$i]['status'] = $fun->ticket_status($obj['status']);
 		$data[$i]['status_cls'] = $fun->ticket_status_cls($obj['status']);
 		$data[$i]['priority'] = $fun->ticket_priority($obj['priority']);
 		$data[$i]['created_date'] = $fun->it_software_created_date($obj['created_date']);
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
      $excelObj->printHeader($header = array('Employee Name','Subject','Type','Priority','Description','Attached File','Created Date','Status') ,$col = array('A','B','C','D','E','F','G','H'));  
		// function to print the excel data
		$excelObj->printCell($data, $count,$col = array('A','B','C','D','E','F','G','H'), $field = array('emp_name','subject','type','priority','description','attach_file','created_date','status'),'Tickets_'.$current_date);
	}  
  
	// assign software status into array 
	$type = array('0' => 'Status', '1' => 'Open', '2' => 'Closed', '3' => 'Hold', '4' => 'Re-Open');

	// create,update,delete message validation
	if($_GET['status'] == 'deleted' || $_GET['status'] == 'created' || $_GET['status'] == 'updated'){
  		$success_msg = 'Ticket ' . $_GET['status'] . ' successfully';
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

// to download files
if($_GET['action'] == 'download'){
	$path = 'uploads/ticket/'.$_GET['file'];
	$fun->download_file($path);
}

// assign smarty variables here
$smarty->assign('page_links',$paging->print_link_frontend());
$smarty->assign('type', $type);
$smarty->assign('emp_name', $emp_name);
$smarty->assign('emp_name_drop', $emp_name_drop);
$smarty->assign('t_status', $t_status);
$smarty->assign('data', $data);
$smarty->assign('page' , $page); 
$smarty->assign('total_pages' , $total_pages); 	
$smarty->assign('keyword' , $keyword); 
$smarty->assign('f_date', $f_date);
$smarty->assign('t_date', $t_date);	
$smarty->assign('ALERT_MSG', $alert_msg);
$smarty->assign('SUCCESS_MSG', $success_msg);
// assign page title
$smarty->assign('page_title' , 'Ticket - IT');  
// assigning active class status to smarty menu.tpl
$smarty->assign('help_desk_active' , 'active'); 	  
// display smarty file
$smarty->display('list_ticket.tpl');
?>