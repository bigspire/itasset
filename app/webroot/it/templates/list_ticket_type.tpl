{* Purpose : To list and search ticket type.
   Created : Nikitasa
   Date : 16-12-2017 *}

	{include file='include/header.tpl'}		
	<div id="page_wrapper">
	{include file='include/menu.tpl'}
	
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Ticket Type</h1>
					</div>
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="dashboard.php">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						<li>
							<a href="list_ticket_type.php">List Ticket Type</a>
						</li>
					</ul>
				</div>
				{if $ERROR_MSG}
				<div id="flashMessage" class="alert alert-danger">		
				<button type="button" class="close" data-dismiss="alert">&#x2A2F;</button>{$ERROR_MSG}				
				</div>					
				{/if}
			{if $smarty.get.msg}
				<div id="flashMessage" class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert">&#x2A2F;</button>{$smarty.get.msg}</div>					
				{/if}
			   {if $ALERT_MSG}
				 <div id="flashMessage" class="alert alert-success">
				 <button type="button" class="close" data-dismiss="alert">&#x2A2F;</button>{$ALERT_MSG}</div>					
				{/if}
				{if $SUCCESS_MSG}
					 <div id="flashMessage" class="alert alert-success">
				 <button type="button" class="close" data-dismiss="alert">&#x2A2F;</button>{$SUCCESS_MSG}</div>					
				{/if}
					<div class="row-fluid  footer_div previewDiv" >
					<div class="span12">
						<div class="box box-bordered box-color">
						<div class="box-title">
								<h3><i class="icon-list"></i>Ticket Type</h3>
							</div>
						<form action="list_ticket_type.php" name="" id="formID" class="" method="post" accept-charset="utf-8">							
						<div class="box-content">
						<div class="dataTables_wrapper">	
				<div class="" id="DataTables_Table_8_filter"  style="padding:15px">
				 <span>Search:</span>  
			    <input name="keyword" value = "{$keyword}" class="input-large" id="keyword" autocomplete="off" placeholder="Search here..." type="text"/> 
			    {html_options name='t_status' class="input-medium" placeholder="" style="clear:left" id="HrEmployeeRecStatus1" options=$type selected=$t_status}
		       <input type="submit" value="Search" class="btn btn-primary" style="margin-bottom:9px;margin-left:4px;">
             <a href="list_ticket_type.php"><button style="margin-bottom:9px;margin-left:4px;" type="button" val="list_ticket_type.php" class="jsRedirect btn btn-primary"><i class="icon-refresh"></i> Reset</button></a>
             <a href="add_ticket_type.php"><button type="button" val="add_ticket_type.php" class="jsRedirect btn btn-primary" style="float:right"><i class="icon-plus"></i> Add Ticket Type</button></a>
				 {if !$ALERT_MSG}              
               <a href="list_ticket_type.php?action=export&keyword={$smarty.post.keyword}&t_status={$t_status}"><button type="button" name="export" val="list_ticket_type.php?action=export&keyword={$smarty.post.keyword}&t_status={$t_status}" class="jsRedirect btn btn-primary" style="float:right;margin-right:20px;"><i class="icon-reply"></i> Export</button></a>				
				 {/if}            
            </div>			
            <input type="hidden" id="del_url" value="/ceo_apps/hremployee/delete_employee/"/>
					<table class="table table-hover table-nomargin table-bordered usertable dataTable">
						<thead>
							<tr>
								<th>
									<a href="list_ticket_type.php?field=type&order={$order}&page={$smarty.get.page}&keyword={$keyword}&t_status={$t_status}" class="{$sort_field_type}">Type</a></th>
								<th>
									<a href="list_ticket_type.php?field=created_date&order={$order}&page={$smarty.get.page}&keyword={$keyword}&t_status={$t_status}" class="{$sort_field_created_date}">Created Date</a></th>	
								<th>
									<a href="list_ticket_type.php?field=modified&order={$order}&page={$smarty.get.page}&keyword={$keyword}&t_status={$t_status}" class="{$sort_field_modified}">Modified Date</a></th>									
								<th style="text-align:center">Status</th>
								<th>Options</th>
							</tr>
						</thead>
						<tbody>
							{foreach from=$data item=item key=key}		
								 {if $item.created_date}				
								 <tr>
									<td>{$item.type|ucwords}</td> 
									<td>{$item.created_date}</td>
									<td>{$item.modified_date}</td>
								   <td style="text-align:center"><span class='label label-{$item.status_cls}'><a href='#' rel='tooltip' data-original-title = {$item.status}>{$item.status}</a></span></td>
									<td class='hidden-480'>
										<a href="edit_ticket_type.php?id={$item.id}" class="btn" rel="tooltip" title="Edit"><i class="icon-edit"></i></a>
										<a href="delete_ticket_type.php?id={$item.id}&page={$smarty.get.page}" name="21" onclick="return deletefunction()"	class="btn delRec" rel="tooltip" title="Delete"><i class="icon-remove"></i></a>
									</td>
								</tr>
								 {/if}
							{/foreach}	
						</tbody>
					</table>
		         <div class="dataTables_info" id="DataTables_Table_8_info">
					 {$page_info}
					</div>
					<div class="table-pagination" id="DataTables_Table_8_paginate">
					 {$page_links}		
					</div>
					&nbsp;							
					</div>	
				</div>
				<input type="hidden" id="page" value="list_ticket_type">
			</form>						
		 </div>
		</div>
		</div>
	</div>
</div>			
</div>
{include file='include/footer.tpl'}
</div>
{include file='include/footer_js.tpl'}