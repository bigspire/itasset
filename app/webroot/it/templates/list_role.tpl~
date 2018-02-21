{* Purpose : To list and search role.
   Created : Nikitasa
   Date : 21-06-2016 *}

	{include file='include/header.tpl'}		
	<div id="page_wrapper">
	{include file='include/menu.tpl'} 
	
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Role</h1>
					</div>
					
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="dashboard.php">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						<li>
							<a href="list_role.php">List Role</a>
						</li>
					</ul>
				</div>
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
				<div class="row-fluid footer_div" >
					<div class="span12">
						<div class="box box-bordered box-color">
						
						<div class="box-title">
								<h3><i class="icon-list"></i> Role</h3>
							</div>
			<form action="list_role.php" name="" id="formID" class="" method="post" accept-charset="utf-8">							
			<div class="box-content">
			<div class="dataTables_wrapper">
			<div class="" id="DataTables_Table_8_filter"  style="padding:15px">
				<span>Search:</span>  
				<input name="keyword" value = "{$keyword}" class="input-large" id="keyword" autocomplete="off" placeholder="Search here..." type="text"/> 
			  	<input type="submit" value="Search" class="btn btn-primary" style="margin-bottom:9px;margin-left:4px;">
				<a href="list_role.php"><button style="margin-bottom:9px;margin-left:4px;" type="button" val="list_role.php" class="jsRedirect btn btn-primary"><i class="icon-refresh"></i> Reset</button></a>
				<a href="add_role.php"><button type="button" val="add_role.php" class="jsRedirect btn btn-primary" style="float:right"><i class="icon-plus"></i> Add Role</button></a>
				{if !$ALERT_MSG} 
				<a href="list_role.php?action=export&keyword={$smarty.post.keyword}"><button type="button" val="list_role.php?action=export&keyword={$smarty.post.keyword}" name="export" class="jsRedirect btn btn-primary" style="float:right;margin-right:20px;"><i class="icon-reply"></i> Export</button></a>					
			{/if}
			</div>			
			<table class="table table-hover table-nomargin table-bordered usertable dataTable">
				<thead>			
					<tr>		
						<th width="80">
							<a href="list_role.php?field=b_name&order={$order}&page={$smarty.get.page}&keyword={$keyword}" class="{$sort_field_b_name}">Role</a></th>
						<th width="80">
							<a href="list_role.php?field=created_date&order={$order}&page={$smarty.get.page}&keyword={$keyword}" class="{$sort_field_created_date}">Created</a></th>
						<th width="80">
							<a href="list_role.php?field=modified&order={$order}&page={$smarty.get.page}&keyword={$keyword}" class="{$sort_field_modified}">Modified</a></th>						
						<th style="text-align:center" width="80">Status</th>
							<th width="30">Options</th>
						</tr>
				</thead>
				<tbody>	
					{foreach from=$data item=item key=key}		
						{if $item.role_name}														
							<tr>
								<td>{$item.role_name|ucwords}</td>
								<td>{$item.created_date}</td>
								<td>{$item.modified_date}</td>
								<td style="text-align:center"><span class='label label-{$item.status_cls}'><a href='#' rel='tooltip' data-original-title = {$item.status}>{$item.status}</a></span></td>
								<td class='hidden-480'>
									<a href="edit_role.php?id={$item.id}" class="btn" rel="tooltip" title="Edit"><i class="icon-edit"></i></a>
								<!--	<a href="delete_role.php?id={$item.id}&page={$smarty.get.page}" name="16" onclick="return deletefunction()" class="btn delRec" rel="tooltip" title="Delete"><i class="icon-remove"></i></a> -->
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
			<input type="hidden" id="page" value="list_role">
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