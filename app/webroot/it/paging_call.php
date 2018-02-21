<?php
/* 
Purpose : To paginate list and search software details.
Created : Nikitasa
Date : 08-06-2016
*/

	//retain the page number.
	if($_GET['page'.$paging_no]){
		$smarty->assign('retain_pageno', $_GET['page'.$paging_no]);
		$page_num = $_GET['page'.$paging_no];
	}
	else{
	
		$smarty->assign('retain_pageno', 1);
		$page_num =1;
	}
	
	$smarty->assign('cur_url',$_SERVER['PHP_SELF']);
	//$smarty->assign(5,$limit);
    
	$paging = new paging($limit==''?5:$limit,5,'Prev','Next','%%number%%',$paging_n,$post_url);

	$paging->query($count);

	$page_details = $paging->print_info();
	$start = 0;
	$end = $limit==''?5:$limit;
	$page = $_GET["page$paging_no"];
	//$order = 'desc';
	$page = ($page >= 1) ? ($page - 1) : $page;
	$start = $page * $end;
	if($start >= $count) {
		$start = 0;
	}
	// show only when page available
	if($page_details['total_pages']){
		$smarty->assign('page_info'.$paging_no,"Page: <strong>$page_num of $page_details[total_pages]</strong>;  Records showing from <strong>$page_details[start] to $page_details[end]</strong>; Total Records: <strong>$page_details[total]</strong>");
	}
	// $smarty->assign('page_info'.$paging_no,'Total Records: <strong>'.$count.'</strong>');
	$smarty->assign('all_records',$count);
?>