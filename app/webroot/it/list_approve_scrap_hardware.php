<?php
/* 
Purpose : To list and search approve Scrap Hardware.
Created : Nikitasa
Date : 27-02-2018
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


// redirect to error page if the user is not it admin
/*if(!in_array('119', $assigned)){ 
	header('Location:'.IT_DIR.'home/');
}else{
	echo 'success';die;
}*/
// redirecting to dashboard if the user don't have the permission to this module
if(empty($_SESSION['ApproveScrapHardware'])){
	//start session 
	session_start();
	header('Location:dashboard.php?access=Access denied!');
}

//unset session
unset($_SESSION['h']);
	
$keyword = $_POST['keyword'] ? $_POST['keyword'] : $_GET['keyword'];
$hw_type = $_POST['hw_type'] ? $_POST['hw_type'] : $_GET['hw_type'];
$type = $_POST['type'] ? $_POST['type'] : $_GET['type'];
$t_date = $_POST['t_date'] ? $_POST['t_date'] : $_GET['t_date'];
$f_date = $_POST['f_date'] ? $_POST['f_date'] : $_GET['f_date'];    
$from_date = $fun->convert_date($f_date);
$to_date = $fun->convert_date($t_date);
    
$hw_type = $hw_type == '' ? '0' : $hw_type;
//post url for paging
if($_POST){
	$post_url .= '&keyword='.$keyword;
	$post_url .= '&hw_type='.$hw_type;
	$post_url .= '&type='.$type;
	$post_url .= '&f_date='.$f_date;
	$post_url .= '&t_date='.$t_date;
}
// count the total no. of records
$query = "CALL it_list_approve_scrap_hardware('".$keyword."','".$hw_type."','".$type."','".$from_date."','".$to_date."','0','0','','','".$_GET['action']."')";
try{
	if(!$result = $mysql->execute_query($query)){
		throw new Exception('Problem in executing list scrap hardware page');
	}

   // fetch result
   $data_num = $mysql->display_result($result);
	// count result
	$count = $data_num['total'];
	if($count == 0){
		if($keyword){
			$alert_msg = 'No hardware "'.$keyword.'" is found in our database';
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
$sort_fields = array('1' => 'type','brand','model_id','inventory_no','location','asset_desc','scrap_created','status','created_by');
$org_fields = array('1' => 'type','brand','model_id','inventory_no','location','asset_desc','scrap_created','status','created_by');

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
	$field = 'iau.created_date';			
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
 		$hw_type_data[$obj['id']] = $obj['title'];
	}

	// free the memory
	$mysql->clear_result($result);
	// call the next result
	$mysql->next_query();
}catch(Exception $e){
	echo 'Caught exception: ',  $e->getMessage(), "\n";
}

// fetch all records
$query = "CALL it_list_approve_scrap_hardware('".$keyword."','".$hw_type."','".$type."','".$from_date."','".$to_date."','$start','$limit',
'".$field."','".$order."','".$_GET['action']."')";
try{
	if(!$result = $mysql->execute_query($query)){
		throw new Exception('Problem in executing list scrap hardware page');
	}
	// calling mysql fetch_result function
	$i = '0';
	while($obj = $mysql->display_result($result))
	{
 		$data[] = $obj;
 		$data[$i]['scrap_created'] = $fun->it_software_created_date($obj['scrap_created']);
		$data[$i]['status'] = $fun->it_scrap_hw_status($obj['status']);
		$data[$i]['scrap_status'] = $obj['status'];
		$data[$i]['status_cls'] = $fun->approval_status_cls($obj['status']);
		$data[$i]['status_msg'] = $fun->it_scrap_hw($obj['hw_type']);
		$data[$i]['hw_type'] = $fun->it_scrap_hw_type($obj['hw_type']);
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
      $excelObj->printHeader($header = array('Title','Brand','Model Id','Inventory No','Location','Asset Description','Created Date') ,$col = array('A','B','C','D','E','F','G'));  
		// function to print the excel data
		$excelObj->printCell($data, $count,$col = array('A','B','C','D','E','F','G'), $field = array('type','brand','model_id','inventory_no','location','asset_desc','scrap_created'),'Approve Scrap Hardware_'.$current_date);
		die;
	}

	// create,update,delete message validation
	if($_GET['status'] == 'Approved' || $_GET['status'] == 'Rejected'){
		$success_msg = 'Hardware ' . $_GET['status'] . ' successfully';
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
// smarty dropdown array for type
$smarty->assign('type_data', array('' => 'Type', 'S' => 'Scrap', 'RS' => 'Resale','EX' => 'Exchange', 'L' => 'Lost'));
// assign smarty variables here
$smarty->assign('page_links',$paging->print_link_frontend());
$smarty->assign('hw_type', $hw_type);
$smarty->assign('data', $data);
$smarty->assign('type', $type);
$smarty->assign('hw_type_data', $hw_type_data);
$smarty->assign('page' , $page); 
$smarty->assign('total_pages' , $total_pages); 	
$smarty->assign('keyword' , $keyword); 
$smarty->assign('f_date', $f_date);
$smarty->assign('t_date', $t_date);	
$smarty->assign('ALERT_MSG', $alert_msg);
$smarty->assign('SUCCESS_MSG', $success_msg);
$smarty->assign('roleid', $roleid); 
// assign page title
$smarty->assign('page_title' , 'Approve Hardware - IT');  
// assigning active class status to smarty menu.tpl
$smarty->assign('scrap_hardware_active' , 'active'); 	  
// display smarty file
$smarty->display('list_approve_scrap_hardware.tpl');
?>