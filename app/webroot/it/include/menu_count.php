<?php
/* 
Purpose : To count sum of open ticket and re-open ticket.
Created : Nikitasa
Date : 18-06-2016
*/

// get the current user details
$cookie_id = $fun->decrypt($_COOKIE['CakeCookie']['PDCAUSER']);
if($_SESSION['user_id'] == ''){
	// fetch user details
	$query = "CALL it_get_app_user('".$cookie_id."')";
	try{
		if(!$result = $mysql->execute_query($query)){
			throw new Exception('Problem in executing app user');
		}
		// calling mysql fetch_result function
		$obj = $mysql->display_result($result);
		// free the memory
		$mysql->clear_result($result);
		// call the next result
		$mysql->next_query();
	}catch(Exception $e){
		echo 'Caught exception: ',  $e->getMessage(), "\n";
	}
	$_SESSION['user_id'] = $cookie_id;
	$_SESSION['user_name'] = $obj['first_name'].' '.$obj['last_name'];
	$_SESSION['email_address'] = $obj['email_address'];
}

// fetch ticket count
$query = 'CALL it_get_ticket_count()';
try{
	if(!$result = $mysql->execute_query($query)){
		throw new Exception('Problem in executing ticket page');
	}
	// calling mysql fetch_result function
	$obj = $mysql->display_result($result);
	
	// free the memory
	$mysql->clear_result($result);
	// call the next result
	$mysql->next_query();
}catch(Exception $e){
	echo 'Caught exception: ',  $e->getMessage(), "\n";
}

// fetch change asset info count
$query = 'CALL it_count_change_request()';
try{
	if(!$result = $mysql->execute_query($query)){
		throw new Exception('Problem in executing change asset count page');
	}
	// calling mysql fetch_result function
	$obj_asset = $mysql->display_result($result);

	// free the memory
	$mysql->clear_result($result);
	// call the next result
	$mysql->next_query();
}catch(Exception $e){
	echo 'Caught exception: ',  $e->getMessage(), "\n";
}

// assign ticket count variables here
$smarty->assign('ticket_count', $obj['count']);
// assign change asset info count here
$smarty->assign('change_asset_count', $obj_asset['count']); 
?>