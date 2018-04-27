<?php
/* 
Purpose : To edit the brand.
Created : Gayathri
Date : 20-06-2016
*/

// including smarty config
include 'configs/smartyconfig.php';
// including Database class file
include('classes/class.mysql.php');
$mysql->connect_database();
// Validating fields using class.function.php
include('classes/class.function.php');
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
if(empty($_SESSION['SettingsBrand'])){
	header('Location:../home/?access=Access denied!');
}

$getid = $_GET['id'];
$smarty->assign('getid',$getid);
// validate url 
if(($fun->isnumeric($getid)) || ($fun->is_empty($getid)) || ($getid == 0)){
  header('Location:page_error.php');
}
// if id is not in our database redirect list page
if($getid !=''){
	$exits = "CALL it_exit_brand_details('".$getid."')";
	$result = $mysql->execute_query($exits);
	$total = $mysql->display_result($result);
	$t = $total['total'];

	if($t == 0){ 
		$msg = 'This record not in our database';
		header("Location:list_brand.php?msg= $msg");
	}
}
// next query execution
$mysql->next_query();
// get database values
if(empty($_POST)){
	$query = "CALL it_get_brand_id('$getid')";
	try{
		// calling mysql exe_query function
		if(!$result = $mysql->execute_query($query)){ 
			throw new Exception('Problem in executing get brand id');
		}
		$row = $mysql->display_result($result);
		$smarty->assign('rows',$row);
		// assign the db values into session
		foreach($row as $key => $record){
			$smarty->assign($key,$record);		
		}  
		// free the memory
		$mysql->clear_result($result);
		// call the next result
		$mysql->next_query();
	}catch(Exception $e){
		echo 'Caught exception: ',  $e->getMessage(), "\n";
	} 			
}
if(!empty($_POST)){
	// Validating the required fields  
	// array for printing correct field name in error message
	$fieldtype = array('0', '1', '1');
	$actualfield = array('title', 'type',  'status');
   $field = array('title' => 'titleErr', 'type' => 'typeErr', 'status' => 'statusErr');
	$j = 0;
	foreach ($field as $field => $er_var){ 
		if($_POST[$field] == ''){
			$error_msg = $fieldtype[$j] ? ' select the ' : ' enter the ';
			$actual_field =  $actualfield[$j];
			$er[$er_var] = 'Please'. $error_msg .$actual_field;
			$test = 'error';
			$smarty->assign($er_var,$er[$er_var]);
		}else{
			$smarty->assign($field,$_POST[$field]);	
		}
		$j++;
	}

	// query to check whether it is exist or not. 
	$query = "CALL it_check_brand_type_exist('".$getid."','".$_POST['title']."','".$_POST['type']."')";
	// Calling the function that makes the insert
	try{
		// calling mysql exe_query function
		if(!$result = $mysql->execute_query($query)){ 
			throw new Exception('Problem in executing check brand type exist');
		}
		$row = $mysql->display_result($result);
		// call the next result
		$mysql->next_query();
	}catch(Exception $e){
		echo 'Caught exception: ',  $e->getMessage(), "\n";
	}
	
	// check assigned brand
 	$query = "call it_check_brand_assigned('".$getid."')";
   try{
		if(!$result = $mysql->execute_query($query)){
			throw new Exception('Problem in checking assigned brand type');
		}  
		$obj = $mysql->display_result($result);
		// next query execution
		$mysql->next_query();
   }catch(Exception $e){
		echo 'Caught exception: ',  $e->getMessage(), "\n";
	}
	
	if(($obj['total'] != '0') && ($_POST['status'] == '0')){
		$msg = "You cannot inactive unless you remove this brand from ".$fun->it_brand_type($_POST['type']);
		$smarty->assign('EXIST_MSG',$msg); 
	}
	
	if(empty($test) && empty($msg)){
		if($row['total'] == '0'){
			// assigning the date
			$date = date('Y-m-d h:i:s');
			// clear the results	    			
			$mysql->clear_result($result);
			// next query execution
			$mysql->next_query();
			// query to insert into database. 
			$query = "CALL it_edit_brand('".$mysql->real_escape_str($getid)."', '".$mysql->real_escape_str($_POST['title'])."', 
			'".$mysql->real_escape_str($_POST['type'])."', '".$mysql->real_escape_str($_POST['status'])."', '".$date."')";
			// Calling the function that makes the insert
			try{
				// calling mysql exe_query function
				if(!$result = $mysql->execute_query($query)){ 
					throw new Exception('Problem in executing edit brand');
				}
				$row = $mysql->display_result($result);
				$affected_rows = $row['affected_rows'];
				if(!empty($affected_rows)){
					// redirecting to view page
					header('Location: list_brand.php?status=updated');		
				}
				// free the memory
				$mysql->clear_result($result);
			}catch(Exception $e){
				echo 'Caught exception: ',  $e->getMessage(), "\n";
			}
		}else{
			$msg = "Brand title already exists";
			$smarty->assign('EXIST_MSG',$msg); 
		}	
	}
}
// smarty dropdown array for architechture
$smarty->assign('brand_status', array('' => 'Select', '1' => 'Active', '0' => 'Inactive'));

// smarty dropdown array for brand
$smarty->assign('br_type', array('' => 'Select', 'S' => 'Software', 'H' => 'Hardware'));
// closing mysql
$mysql->close_connection();
$smarty->assign('page_title' , 'Edit Brand - IT');  
$smarty->assign('settings_active','active'); 
$smarty->display('edit_brand.tpl');
?>