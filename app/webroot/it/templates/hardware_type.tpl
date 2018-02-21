{* Purpose : To list and search  hardware type.
   Created : Nikitasa
   Date : 15-06-2016 *}

	{include file='include/header.tpl'}		
	<div id="page_wrapper">
	{include file='include/menu.tpl'}
	
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Hardware Type</h1>
					</div>
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="dashboard.php">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="hardware_type.php">List Hardware Type</a>
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
								<h3><i class="icon-list"></i>Hardware Type</h3>
						</div>
						<form action="hardware_type.php" name="" id="formID" class="" method="post" accept-charset="utf-8">							
						<div class="box-content">
						<div class="dataTables_wrapper">
				<div class="" id="DataTables_Table_8_filter"  style="padding:15px">
				<span>Search:</span>  	
				<input name="keyword" value = "{$keyword}" class="input-large" id="keyword" autocomplete="off" placeholder="Search here..." type="text"/> 
			    {html_options name='hw_status' class="input-medium" placeholder="" style="clear:left" id="HrEmployeeRecStatus1" options=$type selected=$hw_status}
		      <input type="submit" value="Search" class="btn btn-primary" style="margin-bottom:9px;margin-left:4px;">
            <a href="hardware_type.php"><button style="margin-bottom:9px;margin-left:4px;" val="hardware_type.php" type="button" class="jsRedirect btn btn-primary"><i class="icon-refresh"></i> Reset</button></a>
            <a href="add_hardware_type.php"><button type="button" val="add_hardware_type.php" class="jsRedirect btn btn-primary" style="float:right"><i class="icon-plus"></i> Add Hardware Type</button></a>
				{if !$ALERT_MSG}             
            <a href="hardware_type.php?action=export&keyword={$smarty.post.keyword}&hw_status={$hw_status}"><button type="button" val="hardware_type.php?action=export&keyword={$smarty.post.keyword}&hw_status={$hw_status}" class="jsRedirect btn btn-primary" style="float:right;margin-right:20px;"><i class="icon-reply"></i> Export</button></a>		
            {/if}
            </div>			
            <table class="table table-hover table-nomargin table-bordered usertable dataTable">
					<thead>
					 <tr>			
							<th width="80">
								<a href="hardware_type.php?field=hardware_type&order={$order}&page={$smarty.get.page}&keyword={$keyword}&hw_status={$hw_status}" class="{$sort_field_hardware_type}">Title</a></th>
						   <th width="80">
								<a href="hardware_type.php?field=code&order={$order}&page={$smarty.get.page}&keyword={$keyword}&hw_status={$hw_status}" class="{$sort_field_code}">CT Code</a></th>		
							<th width="100">
								<a href="hardware_type.php?field=description&order={$order}&page={$smarty.get.page}&keyword={$keyword}&hw_status={$hw_status}" class="{$sort_field_description}">Description</a></th>
							<th width="100">
								<a href="hardware_type.php?field=created&order={$order}&page={$smarty.get.page}&keyword={$keyword}&hw_status={$hw_status}" class="{$sort_field_created}">Created</a></th>
							<th width="100">
								<a href="hardware_type.php?field=modified&order={$order}&page={$smarty.get.page}&keyword={$keyword}&hw_status={$hw_status}" class="{$sort_field_modified}">Modified</a></th>						
							<th style="text-align:center" width="100">Status</th>
							<th width="80">Options</th>
					 </tr>
					</thead>
							   <tbody>
									{foreach from=$data item=item key=key}		
									 {if $item.title}					
										<tr>
											<td>{$item.title|ucwords}</td> 
											<td>{strtoupper($item.ctcode)}</td>
											<td>{$item.description}</td>
											<td>{$item.created_date}</td> 
											<td>{$item.modified_date}</td> 
											<td style="text-align:center"><span class='label label-{$item.status_cls}'><a href='#' rel='tooltip' data-original-title = {$item.status}>{$item.status}</a></span></td>
											<td class='hidden-480'>
											<a href="edit_hardware_type.php?id={$item.id}" class="btn" rel="tooltip" title="Edit"><i class="icon-edit"></i></a>
										   <a href="delete_hardware_type.php?id={$item.id}&page={$smarty.get.page}" name="21" onclick="return deletefunction()" class="btn delRec" rel="tooltip" title="Delete"><i class="icon-remove"></i></a>
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
							<input type="hidden" id="page" value="hardware_type">
						 </form>						
						 </div>
					</div>
				</div>
			 </div>
			</div>			
		</div>
	{include file='include/footer_js.tpl'}
	
	{include file='include/footer.tpl'}

