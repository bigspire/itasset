{* Purpose : To list and search ticket.
   Created : Nikitasa
   Date : 16-06-2016 *}

	{include file='include/header.tpl'}		
	<div id="page_wrapper">
	{include file='include/menu.tpl'}
	
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Ticket</h1>
					</div>
					
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="dashboard.php">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="list_ticket.php">List Ticket</a>
						</li>
					</ul>
					
				</div>
				
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
								<h3><i class="icon-list"></i>Ticket</h3>
							</div>
							
						

						<form action="list_ticket.php" name="" id="formID" class="" method="post" accept-charset="utf-8">							<div class="box-content">
							
						<div class="dataTables_wrapper">
						
				<div class="" id="DataTables_Table_8_filter"  style="padding:15px">
				 <span>Search:</span>  
				 <input name="keyword" value="{$keyword}" class="input-large" id="keyword" autocomplete="off" placeholder="Search here..." type="text"/> 
             {html_options name='emp_name' class="input-medium"  placeholder="Employee" style="clear:left" id="HrEmployeeRecStatus" options=$emp_name_drop selected=$emp_name}             
             {html_options name='t_status' class="input-small" placeholder="" style="clear:left" id="HrEmployeeRecStatus1" options=$type selected=$t_status}
	          <input name="f_date" value="{$f_date}" class="input-small datepick" placeholder="From Date" type="text" id="HrEmployeeDob"/> 
	          <input name="t_date" value="{$t_date}" class="input-small datepick" placeholder="To Date" type="text" id="HrEmployeeDob"/> 
		       <input type="submit" value="Search" class="btn btn-primary" style="margin-bottom:9px;margin-left:4px;">
             <a href="list_ticket.php"><button style="margin-bottom:9px;margin-left:4px;" type="button" val="list_ticket.php" class="jsRedirect btn btn-primary"><i class="icon-refresh"></i> Reset</button></a>
             {if !$ALERT_MSG} 
             <a href="list_ticket.php?action=export&keyword={$smarty.post.keyword}&emp_name={$smarty.post.emp_name}&t_status={$smarty.post.t_status}&f_date={$smarty.post.f_date}&t_date={$smarty.post.t_date}"><button type="button" val="list_ticket.php?action=export&keyword={$smarty.post.keyword}&emp_name={$smarty.post.emp_name}&t_status={$t_status}&f_date={$smarty.post.f_date}&t_date={$smarty.post.t_date}" class="jsRedirect btn btn-primary" style="float:right;margin-right:20px;"><i class="icon-reply"></i> Export</button></a>
			   {/if}
			   </div>			
				<table class="table table-hover table-nomargin table-bordered usertable dataTable">
				     <thead>
                    <tr>
                        <th width="60">
									<a href="list_ticket.php?field=full_name&order={$order}&page={$smarty.get.page}&keyword={$keyword}&emp_name={$emp_name}&t_status={$t_status}&f_date={$f_date}&t_date={$t_date}" class="{$sort_field_full_name}">Employee Name</a></th>
								<th width="60">
									<a href="list_ticket.php?field=subject&order={$order}&page={$smarty.get.page}&keyword={$keyword}&emp_name={$emp_name}&t_status={$t_status}&f_date={$f_date}&t_date={$t_date}" class="{$sort_field_subject}">Subject </a></th>
								<th width="60">
									<a href="list_ticket.php?field=type&order={$order}&page={$smarty.get.page}&keyword={$keyword}&emp_name={$emp_name}&t_status={$t_status}&f_date={$f_date}&t_date={$t_date}" class="{$sort_field_type}">Type </a></th>		
								<th width="60">
									<a href="list_ticket.php?field=priority&order={$order}&page={$smarty.get.page}&keyword={$keyword}&emp_name={$emp_name}&t_status={$t_status}&f_date={$f_date}&t_date={$t_date}" class="{$sort_field_priority}">Priority</a></th>
								<th width="100">
									<a href="list_ticket.php?field=description&order={$order}&page={$smarty.get.page}&keyword={$keyword}&emp_name={$emp_name}&t_status={$t_status}&f_date={$f_date}&t_date={$t_date}" class="{$sort_field_description}">Description</a></th>
								<th width="60" >
									<a href="list_ticket.php?field=attach_file&order={$order}&page={$smarty.get.page}&keyword={$keyword}&emp_name={$emp_name}&t_status={$t_status}&f_date={$f_date}&t_date={$t_date}" class="{$sort_field_attach_file}">Attachment</a></th>
								<th width="60" >
									<a href="list_ticket.php?field=created&order={$order}&page={$smarty.get.page}&keyword={$keyword}&emp_name={$emp_name}&t_status={$t_status}&f_date={$f_date}&t_date={$t_date}" class="{$sort_field_created}">Created</a></th>
								<th  style="text-align:center" width="60">Pending</th>
								<th  style="text-align:center" width="60">Status</th>
								<th width="60">Options</th>
							</tr>
						</thead>
					   <tbody>
								{foreach from=$data item=item key=key}		
									{if $item.subject}	
								 <tr>
								   <td>{$item.emp_name} </td> 
									<td>{ucfirst($item.subject)}</td> 		
									<td>{$item.type}</td> 		
									<td>{$item.priority}</td> 		
									<td>{ucfirst($item.description)}</td> 	
									<td>
									<a href = "list_ticket.php?id={$smarty.get.id}&action=download&file={$item.attach_file}">
									{$item.attach_file}
									</a>
									<td>{$item.created_date}</td> 		
									<td>{$item.pending}</td> 		
									<td style="text-align:center"><span class='label label-{$item.status_cls}'><a href='#' rel='tooltip' data-original-title = {$item.status}>{$item.status}</a></span></td>
									<td class='hidden-480'>
									<a href="edit_ticket.php?id={$item.id}&status_id={$item.status_id}" class="btn" rel="tooltip" title="Edit"><i class="icon-edit"></i></a>
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
				<input type="hidden" id="page" value="list_ticket">
			</form>						
		 </div>
		</div>
		</div>
	</div>
</div>			
</div>
{include file='include/footer.tpl'}
</div>
<input type="hidden" value="/" id="css_root">
{include file='include/footer_js.tpl'}
