<?php
/* 
Purpose : To upload resume.
Created : Nikitasa
Date : 07-03-2017
*/

// starting session
session_start();
// including smarty config
include 'configs/smartyconfig.php';
// including Database class file
include('classes/class.mysql.php');
$mysql->connect_database();
// Validating fields using class.function.php
include('classes/class.function.php');
// include paging class 
include('classes/class.paging.php');

if($_GET['type'] != ''){	
	// count the total no. of records
	$query = "CALL get_company_details('".$_GET['type']."','0','0','','')";
	try{
		if(!$result = $mysql->execute_query($query)){
			throw new Exception('Problem in executing list vendor page');
		}

		// fetch result
		$data_num = $mysql->display_result($result);
		
		$page = $_GET['page'] ?  $_GET['page'] : 1;
		$limit = 10;
		// count result
		$count = $data_num['total'];
		if($count == 0){			
			$alert_msg = 'No vendor details found in our database';
		}
	   include('paging_call.php');	
		// free the memory
		$mysql->clear_result($result);
		// execute next query
		$mysql->next_query();
	}catch(Exception $e){
		echo 'Caught exception: ',  $e->getMessage(), "\n";
	}
	
	// if no fields are set, set default sort image
	if(empty($_GET['field'])){	
		$order = 'desc';			
		$field = 'created_date';			
		$smarty->assign('sort_field_created', 'sorting desc');
	}	
	
	// query to fetch all clients names. 
	$query = "CALL get_company_details('".$_GET['type']."','$start','$limit','".$field."','".$order."')";
	try{
		// calling mysql exe_query function
		if(!$result = $mysql->execute_query($query)){
			throw new Exception('Problem in getting vendor details');
		}
		$i = '0';
		while($obj = $mysql->display_result($result))
		{
			$data[] = $obj;
			$i++;
			$pno[]=$paging->print_no();
			$smarty->assign('pno',$pno);
		}
		// free the memory
		$mysql->clear_result($result);
		// call the next result
		$mysql->next_query();
		
		// validating pagination
		$total_pages = ceil($count / $limit);
		
	}catch(Exception $e){
		echo 'Caught exception: ',  $e->getMessage(), "\n";
	}
	
	$paging->posturl($post_url);
}
// assign smarty variables here
$smarty->assign('page_links',$paging->print_link_frontend());
$smarty->assign('data', $data);
$smarty->assign('page' , $page); 
$smarty->assign('total_pages' , $total_pages);
// closing mysql
$mysql->close_connection();
// display smarty file
$smarty->display('company_details.tpl');
?>
