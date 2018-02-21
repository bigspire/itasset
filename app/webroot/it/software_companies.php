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

	
// query to fetch all clients names. 
$query = "CALL get_company_details('S')";
try{
	// calling mysql exe_query function
	if(!$result = $mysql->execute_query($query)){
		throw new Exception('Problem in getting client and position details');
	}
	$row = $mysql->display_result($result);
	$smarty->assign('client',ucwords($row['client_name']));
	$smarty->assign('position_for',ucwords($row['job_title']));
	$url = $row['resume_type'] == 'F' ? 'add_formatted_resume.php' : 'add_resume.php';
	$smarty->assign('redirect_url',$url);
	// free the memory
	$mysql->clear_result($result);
	// call the next result
	$mysql->next_query();
}catch(Exception $e){
	echo 'Caught exception: ',  $e->getMessage(), "\n";
}

	// assigning the date
	$date =  $fun->current_date();
	$type = 'D';
	
	if(empty($test)){ 
		//update the attached file
		if(!empty($_FILES['resume']['name'])){
			$requirement_id = $_POST['position_for'] ? $_POST['position_for'] : $_SESSION['req_id'];
			// get requirement status details
			$query = "CALL get_requirement_status('".$requirement_id."')";
			try{
				if(!$result = $mysql->execute_query($query)){
					throw new Exception('Problem in getting requirement status details');
				}
				$row = $mysql->display_result($result);
				// free the memory
				$mysql->clear_result($result);
				// call the next result
				$mysql->next_query();
			}catch(Exception $e){
				echo 'Caught exception: ',  $e->getMessage(), "\n";
			}
			
			if($row['req_status_id'] != '2' && $row['req_status_id'] != '3' && $row['req_status_id'] != '4'){	
				// upload the file
				$prefix = substr(time(), 2,5).rand(1000,10000000).'_';
				$new_file = $prefix.$_FILES['resume']['name'];
				$path = $uploaddir.$new_file;
				move_uploaded_file($_FILES['resume']['tmp_name'], $path);
				// query to update the file
				$query = "CALL upload_resume('".$new_file."','".$type."','".$_SESSION['user_id']."','".$date."')";
				try{
					if(!$result = $mysql->execute_query($query)){
						throw new Exception('Problem in uploading resume');
					}
					$row = $mysql->display_result($result);
					$last_id = $row['inserted_id'];
					$_SESSION['resume_doc_id'] = $last_id;
					// write the session to server
					$_SESSION['resume_doc'] = $new_file;
					// when user come from view position 
					/* if(empty($_SESSION['client_id']) && empty($_SESSION['req_id'])){
						$_SESSION['client'] = $_POST['client'];
						$_SESSION['position_for'] = $_POST['position_for'];
					}else{
						$_SESSION['client'] = $_SESSION['client_id'];
						$_SESSION['position_for'] = $_SESSION['req_id'];
					}*/
					
					$_SESSION['client'] = $_POST['client'];
					$_SESSION['position_for'] = $_POST['position_for'];
					// call the next result
					$mysql->next_query();
				}catch(Exception $e){
					echo 'Caught exception: ',  $e->getMessage(), "\n";
				}
			}else{
				$smarty->assign('ALERT_MSG', 'Requirement status is not In-Process');
			}
		}
		if(!empty($last_id)){
			$smarty->assign('form_sent' , 1);	
		} 
	}
}

// closing mysql
$mysql->close_connection();
// display smarty file
$smarty->display('software_companies.tpl');
?>
