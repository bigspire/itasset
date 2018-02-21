<?php
/* 
Purpose : To list and search software details.
Created : Nikitasa
Date : 06-06-2016
*/

// starting end destroying session
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

// redirect to error page if the user is not it admin
if($roleid != '21'){
	header('Location:'.IT_DIR.'home/');
}
// redirecting to dashboard if the user don't have the permission to this module
if(empty($_SESSION['Software'])){
	//start session 
	session_start();
	header('Location:dashboard.php?access=Access denied!');
} 

	
$keyword = $_POST['keyword'] ? $_POST['keyword'] : $_GET['keyword'];
$sw_type = $_POST['sw_type'] ? $_POST['sw_type'] : $_GET['sw_type'];
$t_date = $_POST['t_date'] ? $_POST['t_date'] : $_GET['t_date'];
$f_date = $_POST['f_date'] ? $_POST['f_date'] : $_GET['f_date'];    
$from_date = $fun->convert_date($f_date);
$to_date = $fun->convert_date($t_date); 
$sw_type = $sw_type == '' ? 0 : $sw_type;

// to display the data using status filter
if(isset($_POST['sw_status'])){
	$sw_status = $_POST['sw_status'];
}else if(isset($_GET['sw_status'])){
	$sw_status = $_GET['sw_status'];
}else{
	$sw_status = '1';
}

//post url for paging
if($_POST){
	$post_url .= '&keyword='.$keyword;
	$post_url .= '&sw_status='.$sw_status;
	$post_url .= '&sw_type='.$sw_type;
	$post_url .= '&f_date='.$f_date;
	$post_url .= '&t_date='.$t_date;
}

// for export
if($_GET['action'] == 'export'){
	$sw_status = $_GET['sw_status']; 
}

// count the total no. of records
$query = "CALL it_list_software('".$keyword."','".$sw_type."','".$sw_status."','".$from_date."','".$to_date."','0','0','','','".$_GET['action']."')";
try{
	if(!$result = $mysql->execute_query($query)){
		throw new Exception('Problem in executing list software page');
	}
	// fetch result
	$data_num = $mysql->display_result($result);
	// count result
	$count = $data_num['total'];
	if($count == 0){
		if($keyword){
			$alert_msg = 'No software "' .$keyword. '" is found in our database';
		}else{
			$alert_msg = 'No software details found in our database';
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
$sort_fields = array('1' => 'software_type','brand','edition','no_license','subscription','validity','vendor','created','modified');
$org_fields = array('1' => 'st.title', 'b.title', 's.edition', 's.no_license','s.subscription',
's.validity_till','vendor_name','s.created_date','modified_date');

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
	$field = 's.created_date';			
	$smarty->assign('sort_field_created', 'sorting desc');
}	
$smarty->assign('order', $order);
// set the original field for the sql query
if($search_key = array_search($_GET['field'], $sort_fields)){
	$field =  $org_fields[$search_key];
}
// fetch all data from get_software_type
$query = 'call it_get_software_type()';
try{
	if(!$result = $mysql->execute_query($query)){
		throw new Exception('Problem in executing software type page');
	}
	$sw_type_data['0'] = 'Software Type';
	while($obj = $mysql->display_result($result))
	{
 		$sw_type_data[$obj['id']] = ucfirst($obj['title']); 
	}

	// free the memory
	$mysql->clear_result($result);
	// call the next result
	$mysql->next_query();
}catch(Exception $e){
	echo 'Caught exception: ',  $e->getMessage(), "\n";
}
// fetch all records
$query = "CALL it_list_software('".$keyword."','".$sw_type."','".$sw_status."','".$from_date."','".$to_date."','$start','$limit','".$field."','".$order."','".$_GET['action']."')";

try{
	if(!$result = $mysql->execute_query($query)){
		throw new Exception('Problem in executing list software page');
	}
	// calling mysql fetch_result function
	$i = '0';
	while($obj = $mysql->display_result($result))
	{
 		$data[] = $obj;
 		$data[$i]['subscription'] =  $fun->it_software_subscription($obj['subscription']);
 		$data[$i]['validity_year'] =  $fun->it_software_validity($obj['validity_year']);
		$data[$i]['status'] = $fun->it_software_status($obj['status']);
		$data[$i]['status_cls'] = $fun->status_cls($obj['status']);
		$data[$i]['validity_till'] = $fun->it_software_created_date($obj['validity_till']);
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
      $excelObj->printHeader($header = array('Software Type','Brand','Edition','No Of License','Subscription','Validity','Vendor','Created Date','Modified Date','Status') ,$col = array('A','B','C','D','E','F','G','H','I','J'));  
		// function to print the excel data
		$excelObj->printCell($data, $count,$col = array('A','B','C','D','E','F','G','H','I','J'), $field = array('software_type','brand','edition','no_license','subscription','validity_till','vendor_name','created_date','modified_date','status'),'Softwares_'.$current_date);
	}

	// assign software status into array 
	$type = array('' => 'All Status', '1' => 'Active', '0' => 'Inactive');

	// create,update,delete message validation
	if($_GET['status'] == 'deleted' || $_GET['status'] == 'created' || $_GET['status'] == 'updated' ){
  		$success_msg = 'Software details ' . $_GET['status'] . ' successfully';
	}else if($_GET['status'] == 'not_deleted'){
		$erro_msg = "You cannot delete unless you remove this from assigned asset.";	
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
$smarty->assign('sw_status', $sw_status);
$smarty->assign('sw_type', $sw_type);
$smarty->assign('data', $data);
$smarty->assign('sw_type_data', $sw_type_data);
$smarty->assign('page' , $page); 
$smarty->assign('total_pages' , $total_pages); 	
$smarty->assign('keyword' , $keyword); 
$smarty->assign('f_date', $f_date);
$smarty->assign('t_date', $t_date);	
$smarty->assign('ALERT_MSG', $alert_msg);
$smarty->assign('SUCCESS_MSG', $success_msg);
$smarty->assign('ERROR_MSG', $erro_msg);

// assign page title
$smarty->assign('page_title' , 'Software - IT');  
// assigning active class status to smarty menu.tpl
$smarty->assign('software_active' , 'active'); 	  
// display smarty file
$smarty->display('list_software.tpl');
?>