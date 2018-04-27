<?php
/* 
Purpose : To list and search login.
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
if(empty($_SESSION['Logins'])){
	// start session 
	session_start();
	header('Location:../home/?access=Access denied!');
}

//unset session
unset($_SESSION['s']);
	
$keyword = $_POST['keyword'] ? $_POST['keyword'] : $_GET['keyword'];
$emp_name = $_POST['emp_name'] != '' ? $_POST['emp_name'] : $_GET['emp_name'];
//$l_status = isset($_POST['l_status']) ? $_POST['l_status'] : ($_GET['l_status'] != '' ? $_GET['l_status'] : '1');
$emp_name = ($emp_name == '') ? 0 : $emp_name;

// to display the data using status filter
if(isset($_POST['l_status'])){
	$l_status = $_POST['l_status'];
}else if(isset($_GET['l_status'])){
	$l_status = $_GET['l_status'];
}else{
	$l_status = '1';
}

//post url for paging
if($_POST){
	$post_url .= '&keyword='.$keyword;
	$post_url .= '&emp_name='.$emp_name;
	$post_url .= '&l_status='.$l_status;
}


// for export
if($_GET['action'] == 'export'){
	$l_status = $_GET['l_status']; 
}
		
// count the total no. of records
$query = "CALL it_list_login('".$keyword."','".$emp_name."','".$l_status."','0','0','','','".$_GET['action']."')";
try{
	if(!$result = $mysql->execute_query($query)){
		throw new Exception('Problem in executing list login page');
	}// fetch result
   $data_num = $mysql->display_result($result);
   // count result
   $count = $data_num['total'];
	if($count == 0){
		if($keyword){
			$alert_msg = 'No login "' .$keyword. '" is found in our database';
		}else{
			$alert_msg = 'No login details found in our database';
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
//$order =  $_GET['field'] != '' ? ($_GET['order'] == 'desc' ? 'asc' :  'desc') : '';	
$sort_fields = array('1' => 'employee','login_type','username','password','server','created','modified');
$org_fields = array('1' => 'full_name', 'title', 'user_name', 'password','host','created_date','modified_date');

// to set the sorting image
foreach($sort_fields as $key => $l_field){
	if($l_field != $_GET['field']){ 
		$smarty->assign('sort_field_'.$l_field,'sorting');
	}else{	
		$order_img = ($_GET['order'] == 'asc') ? 'sorting desc' :  'sorting asc';
		$smarty->assign('sort_field_'.$l_field,$order_img);
	}			
}
// if no fields are set, set default sort image
if(empty($_GET['field']) && empty($keyword)){	 
	$order = 'desc';			
	$field = 'l.created_date';			
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
$query = "CALL it_list_login('".$keyword."','".$emp_name."','".$l_status."','$start','$limit','".$field."','".$order."','".$_GET['action']."')";

try{
	if(!$result = $mysql->execute_query($query)){
		throw new Exception('Problem in executing list login page');
	}
	// calling mysql fetch_result function
	$i = '0';
	while($obj = $mysql->display_result($result))
	{
 	$data[] = $obj;
 	$data[$i]['full_name'] = $fun->upper_case_string($obj['full_name']);
 	$data[$i]['status'] = $fun->it_software_status($obj['status']);
 	$data[$i]['status_cls'] = $fun->status_cls($obj['status']);
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
      $excelObj->printHeader($header = array('Employee Name','Login Type','User Name','Password','Server','Created Date','Modified Date','Status') ,$col = array('A','B','C','D','E','F','G','H'));  
		// function to print the excel data
		$excelObj->printCell($data, $count,$col = array('A','B','C','D','E','F','G','H'), $field = array('full_name','title','user_name','password','host','created_date','modified_date','status'),'Logins_'.$current_date);
	}

	// assign software status into array 
	$type = array('' => 'All Status', '1' => 'Active', '0' => 'Inactive');

	// create,update,delete message validation
	if($_GET['status'] == 'deleted' || $_GET['status'] == 'created' || $_GET['status'] == 'updated'){
  		$success_msg = 'Login details ' . $_GET['status'] . ' successfully';
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
$smarty->assign('emp_name', $emp_name);
$smarty->assign('emp_name_drop', $emp_name_drop);
$smarty->assign('l_status', $l_status);
$smarty->assign('data', $data);
$smarty->assign('page' , $page); 
$smarty->assign('total_pages' , $total_pages); 	
$smarty->assign('keyword' , $keyword); 
$smarty->assign('f_date', $f_date);
$smarty->assign('t_date', $t_date);	
$smarty->assign('ALERT_MSG', $alert_msg);
$smarty->assign('SUCCESS_MSG', $success_msg);
// assign page title
$smarty->assign('page_title' , 'Login - IT');  
// assigning active class status to smarty menu.tpl
$smarty->assign('login_active' , 'active'); 	  
// display smarty file
$smarty->display('list_login.tpl');
?>