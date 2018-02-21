{* Purpose : To list logins.
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
						<h1>Login</h1>
					</div>
					
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="dashboard.php">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						<li>
							<a href="list_login.php">List Login</a>
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
						<div class="row-fluid  footer_div previewDiv" >
					<div class="span12">
						<div class="box box-bordered box-color">
						<div class="box-title">
								<h3><i class="icon-list"></i>Logins</h3>
						</div>
						<form action="list_login.php" name="" id="formID" class="" method="post" accept-charset="utf-8">							<div class="box-content">
							
						<div class="dataTables_wrapper">
						
				<div class="" id="DataTables_Table_8_filter"  style="padding:15px">
				
				<span>Search:</span>  				
				<input name="keyword" value = "{$keyword}" class="input-large" id="keyword" autocomplete="off" placeholder="Search here..." type="text"/> 
             {html_options name='emp_name' class="input-medium"  placeholder="Employee" style="clear:left" id="HrEmployeeRecStatus" options=$emp_name_drop selected=$emp_name}			   
			    {html_options name='l_status' class="input-medium" placeholder="" style="clear:left" id="HrEmployeeRecStatus1" options=$type selected=$l_status}
		 
		     <input type="submit" value="Search" class="btn btn-primary" style="margin-bottom:9px;margin-left:4px;">
           <a href="list_login.php"><button style="margin-bottom:9px;margin-left:4px;" type="button" val="list_login.php" class="jsRedirect btn btn-primary"><i class="icon-refresh"></i> Reset</button></a>
           <a href="add_login.php"><button type="button" val="add_login.php" class="jsRedirect btn btn-primary" style="float:right"><i class="icon-plus"></i> Add Login</button></a>
           {if !$ALERT_MSG} 
           <a href="list_login.php?action=export&keyword={$smarty.post.keyword}&emp_name={$smarty.post.emp_name}&l_status={$l_status}"><button type="button" val="list_login.php?action=export&keyword={$smarty.post.keyword}&emp_name={$smarty.post.emp_name}&l_status={$l_status}" class="jsRedirect btn btn-primary" style="float:right;margin-right:20px;"><i class="icon-reply"></i> Export</button></a>				
          {/if}
          </div>			
								<table class="table table-hover table-nomargin table-bordered usertable dataTable">
									<thead>	
										<tr>	
										<th width="60">
											<a href="list_login.php?field=employee&order={$order}&page={$smarty.get.page}&keyword={$keyword}&l_status={$l_status}" class="{$sort_field_employee}">Employee</a></th>
										<th width="60">
											<a href="list_login.php?field=login_type&order={$order}&page={$smarty.get.page}&keyword={$keyword}&l_status={$l_status}" class="{$sort_field_login_type}">Login Type</a></th>		
										<th width="60">
											<a href="list_login.php?field=username&order={$order}&page={$smarty.get.page}&keyword={$keyword}&l_status={$l_status}" class="{$sort_field_username}">Username</a></th>
										<th width="60">
											<a href="list_login.php?field=password&order={$order}&page={$smarty.get.page}&keyword={$keyword}&l_status={$l_status}" class="{$sort_field_password}">Password</a></th>
										<th width="60">
											<a href="list_login.php?field=server&order={$order}&page={$smarty.get.page}&keyword={$keyword}&l_status={$l_status}" class="{$sort_field_server}">URL</a></th>
										<th width="60">
											<a href="list_login.php?field=created&order={$order}&page={$smarty.get.page}&keyword={$keyword}&l_status={$l_status}" class="{$sort_field_created}">Created</a></th>										
										<th width="60">
											<a href="list_login.php?field=modified&order={$order}&page={$smarty.get.page}&keyword={$keyword}&l_status={$l_status}" class="{$sort_field_modified}">Modified</a></th>																				
										<th style="text-align:center" width="60">Status</th>
										<th width="60">Options</th>
										</tr>
									</thead>
									<tbody>
									{foreach from=$data item=item key=key}		
									 {if $item.full_name}	
									<tr>
											<td>{$item.full_name}</td>
											<td>{ucfirst($item.title)}</td>
											<td>{$item.user_name}</td>
											<td>{$item.password}</td>
											<td>{$item.host}</td>
							            <td>{$item.created_date}</td>
											<td>{$item.modified_date}</td>
											<td style="text-align:center"><span class='label label-{$item.status_cls}'><a href='#' rel='tooltip' data-original-title = {$item.status}>{$item.status}</a></span></td>
										
												<td class='hidden-480'>
												<a href="edit_login.php?id={$item.id}" class="btn" rel="tooltip" title="Edit"><i class="icon-edit"></i></a>
												<a href="delete_login.php?id={$item.id}&page={$smarty.get.page}" onclick="return deletefunction()" name="21" class="btn delRec" rel="tooltip" title="Delete"><i class="icon-remove"></i></a>
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
							<input type="hidden" id="page" value="login">
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