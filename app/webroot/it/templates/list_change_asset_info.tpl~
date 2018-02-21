{* Purpose : To list and search change asset info.
   Created : Nikitasa
   Date : 20-06-2016 *}

{include file='include/header.tpl'}
	<div id="page_wrapper">
	{include file='include/menu.tpl'}
	
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Change Asset Info</h1>
					</div>
					
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="dashboard.php">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="list_change_asset_info.php">List Change Asset Info</a>
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
								<h3><i class="icon-list"></i>Change Asset Info</h3>
							</div>
							
						

						<form action="list_change_asset_info.php" name="" id="formID" class="" method="post" accept-charset="utf-8">							<div class="box-content">
							
						<div class="dataTables_wrapper">
						
				<div class="" id="DataTables_Table_8_filter"  style="padding:15px">
				
				<span>Search:</span>  
				<input name="keyword" value="{$keyword}"  class="input-large" id="search" autocomplete="off" placeholder="Search here..." type="text"/> 
			   <span></span>	
            {html_options name='emp_name' class="input-medium"  placeholder="Employee" style="clear:left" id="HrEmployeeRecStatus" options=$emp_name_drop selected=$emp_name}
				<span></span>	
			   {html_options name='asset_type' class="input-medium"  style="clear:left" id="HrEmployeeRecStatus" options=$asset_type_drop selected=$asset_type}	   
		      <span></span>	
		      {html_options name='status' class="input-small" placeholder="" style="clear:left" id="HrEmployeeRecStatus1" options=$type selected=$status}
		      <input name="f_date" value="{$f_date}" class="input-small datepick" placeholder="From Date" type="text" id="HrEmployeeDob"/> 
	         <input name="t_date" value="{$t_date}" class="input-small datepick" placeholder="To Date" type="text" id="HrEmployeeDob"/> 
		      <input type="submit" value="Search" class="btn btn-primary" style="margin-bottom:9px;margin-left:4px;">
           <a href="list_change_asset_info.php"><button style="margin-bottom:9px;margin-left:4px;" val="list_change_asset_info.php" type="button" class="jsRedirect btn btn-primary"><i class="icon-refresh"></i> Reset</button></a>
           {if !$ALERT_MSG} 
           <a href="list_change_asset_info.php?action=export&keyword={$smarty.post.keyword}&emp_name={$smarty.post.emp_name}&asset_type={$smarty.post.asset_type}&f_date={$smarty.post.f_date}&status={$status}&t_date={$smarty.post.t_date}"><button type="button" val= "list_change_asset_info.php?action=export&keyword={$smarty.post.keyword}&emp_name={$smarty.post.emp_name}&asset_type={$smarty.post.asset_type}&f_date={$smarty.post.f_date}&t_date={$smarty.post.t_date}" class="jsRedirect btn btn-primary" style="float:right;margin-right:20px;"><i class="icon-reply"></i> Export</button></a>							
           {/if}
           </div>			
					<table class="table table-hover table-nomargin table-bordered usertable dataTable">
									<thead>	
										<tr>
											<th width="50">
											<a href="list_change_asset_info.php?field=emp_name&order={$order}&page={$smarty.get.page}&keyword={$keyword}&emp_name={$emp_name}&asset_type={$asset_type}&status={$status}&f_date={$f_date}&t_date={$t_date}" class="{$sort_field_emp_name}">Employee Name</a></th>
										   <th width="50">
											<a href="list_change_asset_info.php?fieldasset_type&order={$order}&page={$smarty.get.page}&keyword={$keyword}&emp_name={$emp_name}&asset_type={$asset_type}&status={$status}&f_date={$f_date}&t_date={$t_date}" class="{$sort_field_asset_type}">Asset Type</a></th>		
											<th width="50">
											<a href="list_change_asset_info.php?field=message&order={$order}&page={$smarty.get.page}&keyword={$keyword}&emp_name={$emp_name}&asset_type={$asset_type}&status={$status}&f_date={$f_date}&t_date={$t_date}" class="{$sort_field_message}">Message</a></th>												
											<th width="50">
											<a href="list_change_asset_info.php?field=created_date&order={$order}&page={$smarty.get.page}&keyword={$keyword}&emp_name={$emp_name}&asset_type={$asset_type}&status={$status}&f_date={$f_date}&t_date={$t_date}" class="{$sort_field_created_date}">Created Date</a></th>												
											<th width="50">
											<a href="list_change_asset_info.php?field=modified&order={$order}&page={$smarty.get.page}&keyword={$keyword}&emp_name={$emp_name}&asset_type={$asset_type}&status={$status}&f_date={$f_date}&t_date={$t_date}" class="{$sort_field_modified}">Modified Date</a></th>													
						         		<th width="40">Pending</th>										
											<th style="text-align:center" width="20">Status</th>
											<th width="20">Options</th>
										</tr>
									</thead>
									<tbody>
									{foreach from=$data item=item key=key}		
										{if $item.full_name}								
										<tr>
											<td>{$item.full_name} </td> 
					                	<td>{$item.type}</td>
											<td>{ucfirst($item.message)}</td>
											<td>{$item.created_date}</td>
											<td>{$item.modified_date}</td>
											<td>{$item.pending}</td> 		
										 <td style="text-align:center"><span class='label label-{$item.status_cls}'><a href='#' rel='tooltip' data-original-title = {$item.status}>{$item.status}</a></span></td>
								      	<td class='hidden-480'>
												<a href="view_change_asset_info.php?id={$item.id}" class="btn" rel="tooltip" title="View"><i class="icon-search"></i></a>
											   <a href="edit_change_asset_info.php?id={$item.id}&asset_type={$item.type}" class="btn" rel="tooltip" title="Edit"><i class="icon-edit"></i></a>
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
