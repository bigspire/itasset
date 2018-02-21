<?php 
/* 
Purpose : To view change asset in front end.
Created : Nikitasa
Date : 01-07-2016
*/

include 'configs/smartyconfig.php';
// include mysql class
include('classes/class.mysql.php');
// Connecting Database
$mysql->connect_database();
// include function validation class
include('classes/class.function.php');

// get record id   
$id = $_GET['id'];
if(($fun->isnumeric($id)) || ($fun->is_empty($id)) || ($id == 0)){
  		header('Location:page_error.php');
}

// select and execute query and fetch the result
$query = "CALL it_view_change_emp('".$id."','".$_GET['asset_type']."')"; 
try{
	if(!$result = $mysql->execute_query($query)){
		throw new Exception('Problem in executing change asset page');
	}
	// check record exists
	if($result->num_rows){
		$i = 0;
		// calling mysql fetch_result function
		while($obj = $mysql->display_result($result)){  
			$data_view_asset[] = $obj;
			$data_view_asset[$i]['type'] = $fun->it_brand_type($obj['type']);
			$data_view_asset[$i]['type_status'] = $obj['type'];
			$i++;
		}
	}else{
		header('Location:page_error.php');
	}
	// free the memory
	$mysql->clear_result($result);
}catch(Exception $e){
	echo 'Caught exception: ',  $e->getMessage(), "\n";
}


// to download files
if($_GET['action'] == 'download'){
	$path = 'uploads/ticket/'.$_GET['file'];
	$fun->download_file($path);
}

// calling mysql close db connection function
$c_c = $mysql->close_connection();

// here assign smarty variables
$smarty->assign('id' , $_GET['id']); 
$smarty->assign('data_view_asset', $data_view_asset);
// display smarty file
$smarty->display('fr_view_change_asset.tpl');
?>