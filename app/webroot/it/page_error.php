<?php
/* 
Purpose : Page Error.
Created : Gayathri
Date : 3-08-2016
*/
//include smarty congig file
include 'configs/smartyconfig.php';
$ntfd = 'Not Found';
$msg = 'The requested URL is invalid.';
$smarty->assign('ntfd', $ntfd);
$smarty->assign('msg', $msg);
// assign page title
$smarty->assign('page_title' , 'Page Error - IT');  
// assigning active class status to smarty menu.tpl
$smarty->assign('dashboard_active' , 'active'); 	  
// display smarty file
$smarty->display('page_error.tpl');
?>