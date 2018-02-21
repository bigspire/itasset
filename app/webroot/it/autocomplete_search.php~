<?php 
// remote search
// include mysql class
include('classes/class.mysql.php');
// Connecting Database
$mysql->connect_database();
// include function validation class
include('classes/class.function.php');
//get search term
$keyword = $_GET['term'];
if($_GET['page'] == 'list_software'){
	// get matched data from software
	$query = "CALL it_search_software('".$keyword."')";
	try{	
		if(!$result = $mysql->execute_query($query)){
			throw new Exception('Problem in executing software page');
		}
		// iterate until get the matched results
		while($obj = $mysql->display_result($result)){
			$data[] = strtolower($fun->match_results($keyword,$obj['brand']));		
			$data[] = strtolower($fun->match_results($keyword,$obj['edition']));
			$data[] = strtolower($fun->match_results($keyword,$obj['vendor_name']));
		}
		
		// filter the duplicate values
		$unique_result = array_unique($data);	
		// display the search results
		foreach($unique_result as $res){
			if(!empty($res)){ 
				$unique[] = $res;
			}
		}
		// free the memory
		$mysql->clear_result($result);		
   }catch(Exception $e){
		echo 'Caught exception: ',  $e->getMessage(), "\n";
   }
}else if($_GET['page'] == 'list_hardware'){
	// get matched data from hardware
	$query = "CALL it_search_hardware('".$keyword."')";
	try{	
		if(!$result = $mysql->execute_query($query)){
			throw new Exception('Problem in executing hardware page');
		}
		// iterate until get the matched results
		while($obj = $mysql->display_result($result)){
			$data[] = strtolower($fun->match_results($keyword,$obj['brand']));		
			$data[] = strtolower($fun->match_results($keyword,$obj['model_id']));
			$data[] = strtolower($fun->match_results($keyword,$obj['inventory_no']));
			$data[] = strtolower($fun->match_results($keyword,$obj['location']));
			$data[] = strtolower($fun->match_results($keyword,$obj['asset_desc']));
			$data[] = strtolower($fun->match_results($keyword,$obj['vendor_name']));
		}
		
		// filter the duplicate values
		$unique_result = array_unique($data);	
		// display the search results
		foreach($unique_result as $res){
			if(!empty($res)){ 
				$unique[] = $res;
			}
		}
		// free the memory
		$mysql->clear_result($result);		
   }catch(Exception $e){
		echo 'Caught exception: ',  $e->getMessage(), "\n";
   }
}else if($_GET['page'] == 'software_type'){
	// get matched data from software
	$query = "CALL it_search_software_type('".$keyword."')";
	try{	
		if(!$result = $mysql->execute_query($query)){
			throw new Exception('Problem in executing software page');
		}
		// iterate until get the matched results
		while($obj = $mysql->display_result($result)){
			$data[] = strtolower($fun->match_results($keyword,$obj['title']));		
		}
		
		// filter the duplicate values
		$unique_result = array_unique($data);	
		// display the search results
		foreach($unique_result as $res){
			if(!empty($res)){ 
				$unique[] = $res;
			}
		}
		// free the memory
		$mysql->clear_result($result);		
   }catch(Exception $e){
		echo 'Caught exception: ',  $e->getMessage(), "\n";
   }
}else if($_GET['page'] == 'hardware_type'){
	// get matched data from software
	$query = "CALL it_search_hardware_type('".$keyword."')";
	try{	
		if(!$result = $mysql->execute_query($query)){
			throw new Exception('Problem in executing software page');
		}
		// iterate until get the matched results
		while($obj = $mysql->display_result($result)){
			$data[] = strtolower($fun->match_results($keyword,$obj['title']));		
			$data[] = strtolower($fun->match_results($keyword,$obj['code']));
		}
		
		// filter the duplicate values
		$unique_result = array_unique($data);	
		// display the search results
		foreach($unique_result as $res){
			if(!empty($res)){ 
				$unique[] = $res;
			}
		}
		// free the memory
		$mysql->clear_result($result);		
   }catch(Exception $e){
		echo 'Caught exception: ',  $e->getMessage(), "\n";
   }
}else if($_GET['page'] == 'login_type'){
		// get matched data from software
	$query = "CALL it_search_login_type('".$keyword."')";
	try{	
		if(!$result = $mysql->execute_query($query)){
			throw new Exception('Problem in executing software page');
		}
		// iterate until get the matched results
		while($obj = $mysql->display_result($result)){
			$data[] = strtolower($fun->match_results($keyword,$obj['title']));		
		}
		
		// filter the duplicate values
		$unique_result = array_unique($data);	
		// display the search results
		foreach($unique_result as $res){
			if(!empty($res)){ 
				$unique[] = $res;
			}
		}
		// free the memory
		$mysql->clear_result($result);		
   }catch(Exception $e){
		echo 'Caught exception: ',  $e->getMessage(), "\n";
   }
}else if($_GET['page'] == 'brand'){
	// get matched data from brand
	$query = "CALL it_search_brand('".$keyword."')";
	try{	
		if(!$result = $mysql->execute_query($query)){
			throw new Exception('Problem in executing brand page');
		}
		// iterate until get the matched results
		while($obj = $mysql->display_result($result)){
			$data[] = strtolower($fun->match_results($keyword,$obj['title']));		
		}
		
		// filter the duplicate values
		$unique_result = array_unique($data);	
		// display the search results
		foreach($unique_result as $res){
			if(!empty($res)){ 
				$unique[] = $res;
			}
		}
		// free the memory
		$mysql->clear_result($result);		
   }catch(Exception $e){
		echo 'Caught exception: ',  $e->getMessage(), "\n";
   }
}else if($_GET['page'] == 'list_role'){
	// get matched data from software
	$query = "CALL it_search_role('".$keyword."')";
	try{	
		if(!$result = $mysql->execute_query($query)){
			throw new Exception('Problem in executing software page');
		}
		// iterate until get the matched results
		while($obj = $mysql->display_result($result)){
			$data[] = strtolower($fun->match_results($keyword,$obj['role_name']));		
		}
		
		// filter the duplicate values
		$unique_result = array_unique($data);	
		// display the search results
		foreach($unique_result as $res){
			if(!empty($res)){ 
				$unique[] = $res;
			}
		}
		// free the memory
		$mysql->clear_result($result);		
   }catch(Exception $e){
		echo 'Caught exception: ',  $e->getMessage(), "\n";
   }
}else if($_GET['page'] == 'login'){
	// get matched data from software
	$query = "CALL it_search_login('".$keyword."')";
	try{	
		if(!$result = $mysql->execute_query($query)){
			throw new Exception('Problem in executing software page');
		}
		// iterate until get the matched results
		while($obj = $mysql->display_result($result)){
			$data[] = strtolower($fun->match_results($keyword,$obj['user_name']));		
			$data[] = strtolower($fun->match_results($keyword,$obj['host']));
			$data[] = strtolower($fun->match_results($keyword,$obj['title']));
		}
		
		// filter the duplicate values
		$unique_result = array_unique($data);	
		// display the search results
		foreach($unique_result as $res){
			if(!empty($res)){ 
				$unique[] = $res;
			}
		}
		// free the memory
		$mysql->clear_result($result);		
   }catch(Exception $e){
		echo 'Caught exception: ',  $e->getMessage(), "\n";
   }
}else if($_GET['page'] == 'list_ticket'){
		// get matched data from ticket
	$query = "CALL it_search_ticket('".$keyword."')";
	try{	
		if(!$result = $mysql->execute_query($query)){
			throw new Exception('Problem in executing ticket page');
		}
		// iterate until get the matched results
		while($obj = $mysql->display_result($result)){
			$data[] = strtolower($fun->match_results($keyword,$obj['subject']));		
		}
		
		// filter the duplicate values
		$unique_result = array_unique($data);	
		// display the search results
		foreach($unique_result as $res){
			if(!empty($res)){ 
				$unique[] = $res;
			}
		}
		// free the memory
		$mysql->clear_result($result);		
   }catch(Exception $e){
		echo 'Caught exception: ',  $e->getMessage(), "\n";
   }
}
/* else if($_GET['page'] == 'assign_asset'){
	
	$query = "CALL it_search_assign_asset('".$keyword."')";
	try{	
		if(!$result = $mysql->execute_query($query)){
			throw new Exception('Problem in executing software page');
		}
		// iterate until get the matched results
		while($obj = $mysql->display_result($result)){
				$data[] = strtolower($fun->match_results($keyword,$obj['brand']));		
				$data[] = strtolower($fun->match_results($keyword,$obj['sw_type']));
				$data[] = strtolower($fun->match_results($keyword,$obj['edition']));		
				$data[] = strtolower($fun->match_results($keyword,$obj['hw_type']));
				$data[] = strtolower($fun->match_results($keyword,$obj['inventory_no']));
				$data[] = strtolower($fun->match_results($keyword,$obj['model_id']));
		}		
		// filter the duplicate values
		$unique_result = array_unique($data);	
		// display the search results
		foreach($unique_result as $res){
			if(!empty($res)){ 
				$unique[] = $res;
			}
		}
		// free the memory
		$mysql->clear_result($result);	
		
   }catch(Exception $e){
		echo 'Caught exception: ',  $e->getMessage(), "\n";
   }
} */
else if($_GET['page'] == 'scrap_hardware'){
	// get matched data from scrap_hardware
	$query = "CALL it_search_scrap_hardware('".$keyword."')";
	try{	
		if(!$result = $mysql->execute_query($query)){
			throw new Exception('Problem in executing scrap_hardware page');
		}
		// iterate until get the matched results
		while($obj = $mysql->display_result($result)){
			$data[] = strtolower($fun->match_results($keyword,$obj['brand']));		
			$data[] = strtolower($fun->match_results($keyword,$obj['model_id']));
			$data[] = strtolower($fun->match_results($keyword,$obj['inventory_no']));
			$data[] = strtolower($fun->match_results($keyword,$obj['asset_desc']));
			$data[] = strtolower($fun->match_results($keyword,$obj['district_name']));
		}
		
		// filter the duplicate values
		$unique_result = array_unique($data);	
		// display the search results
		foreach($unique_result as $res){
			if(!empty($res)){ 
				$unique[] = $res;
			}
		}
		// free the memory
		$mysql->clear_result($result);		
   }catch(Exception $e){
		echo 'Caught exception: ',  $e->getMessage(), "\n";
   }
}

if(!empty($unique)){
	echo json_encode($unique); 
}else{
	$no_data[] = 'No Results!';
	echo json_encode($no_data); 
}
// calling mysql close db connection function
$c_c = $mysql->close_connection(); 
?>