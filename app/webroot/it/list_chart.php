<?php 
/* 
Purpose : To list chart
Created : Mohan
Modified : Gayathri
Date : 06-10-2016
*/
session_start();

ini_set('display_errors', 0);

include 'configs/smartyconfig.php';
// include mysql class
include('classes/class.mysql.php');
// Connecting Database
$mysql->connect_database();
// include function validation class
include('classes/class.function.php');
//include menu_count file
include 'include/menu_count.php';

if(empty($_POST)){
	// fetching data for retaining
	$dt = array();
	$query = "CALL it_display_graph()";  
	$result = $mysql->execute_query($query);  
	$i = '0';
	while($obj = $mysql->display_result($result)){  
		$data[] = $obj;
		$data[$i]['id'] =  $obj['id'];
		$data[$i]['order_to_sort'] =  $obj['sort'];
		$dt[$obj['id']] =  $obj['sort'];
		$i++;	
	}
	$smarty->assign('data', $data); 
	foreach($dt as $key => $order){
		$smarty->assign('order_'.$key, $order); 
		$smarty->assign('graph_'.$key, $order); 
	}
}
if(!empty($_POST)){
	// Validating the required fields  
	$fieldtype = array('1', '1');
   $field_val = array('order_1', 'order_2', 'order_3', 'order_4', 'order_5', 'order_6', 'order_7', 'order_8', 'order_9', 'order_10');
	foreach ($field_val as $field){ 
		$smarty->assign($field,$_POST[$field]);
	}
	// assigning array of posted graph values
	$graph_val = $_POST['graph'];
	// Validating the required fields  	
	if(count($_POST['graph']) < 2){
    	$filling_error = "Please select at least 2 charts and order";
 		$test = 'error';
 		// all order value remains empty while checking only one box
		for($i = 0; $i <= 10; $i++){
      	$smarty->assign('order_'.$i, '');  
      }
      // retaining the the checked box even if it is one
 		for($i = 0; $i < count($_POST['graph']); $i++){
      	$smarty->assign('graph_'.$graph_val[$i], $graph_val[$i]);  
      }
	}

	// assigning the date
	$date = $fun->current_date(); 
	
  	if(!empty($graph_val) && empty($test)){
  	   $graph_count = count($graph_val);
  	   // inserting the empty values to update
    	for($i = 1; $i <= 10; $i++){
			$query = "CALL it_update_dashboard_graph('".$i."', '', '', '')";   
			$result = $mysql->execute_query($query);  
			// call the next result
			$mysql->next_query();	 
    	}
    	// assigning the non empty order values
		for($i = 0; $i < $graph_count; $i++){
			if(!empty($_POST['graph'][$i])){
				$arr[$i] = 'order_'.$_POST['graph'][$i]; 
				$sel_arr[$i] = $_POST['graph'][$i]; 
			}
		}

		// counting the non empty order fields.
		foreach($arr as $k => $v){
			if(!empty($_POST[$v])){
				$c[] = count($_POST["$v"]);	
			}		
		}
		// total count non empty order fields.
		$cc = count($c);
		// auto incrementing the checked boxes
		foreach($arr as $key => $val){
			if(empty($_POST[$val])){
				$cc = $cc + 1;
				$smarty->assign($val, $cc);
				$query = "CALL it_update_dashboard_graph('".$sel_arr[$key]."', '".$cc."', '1', '".$date."')";  
				$result = $mysql->execute_query($query);  
				// call the next result
				$mysql->next_query();				
			}		
		}
		// inserting data based on checked boxes and order
   	for($i = 0; $i < $graph_count; $i++){
      	$smarty->assign('graph_'.$graph_val[$i],$graph_val[$i]);   
			if(!empty($_POST['order_'.$graph_val[$i]])){
				$query = "CALL it_update_dashboard_graph('".$graph_val[$i]."', '".$_POST['order_'.$graph_val[$i]]."', '1', '".$date."')";  
				$result = $mysql->execute_query($query);  
				// call the next result
				$mysql->next_query();
				if($result){	
					$msg = "Chart saved successfully";
					$smarty->assign('SUCCESS_MSG',$msg); 
				}
			}
		}
  	}
	
}
// assign smarty variables here
$smarty->assign('checkbox_error',$filling_error); 
$smarty->assign('data_sw_type', $data_sw_type);
$smarty->assign('data_assign_sw', $data_assign_sw);
$smarty->assign('data_sw_edition', $data_sw_edition);
$smarty->assign('data_hw_type', $data_hw_type);
$smarty->assign('data_hw_brand', $data_hw_brand);
$smarty->assign('data_assign_hw', $data_assign_hw);
$smarty->assign('data_req_change', $data_req_change);
$smarty->assign('data_ticket', $data_ticket);
$smarty->assign('data_unassign_hw' , $data_unassign_hw);
// assign page title
$smarty->assign('page_title' , 'Home - IT');  
// assigning active class status to smarty menu.tpl
$smarty->assign('dashboard_active' , 'active'); 	  
// display smarty template
$smarty->display('list_chart.tpl');
?>