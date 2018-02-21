{* Purpose : To list software details.
   Created : Nikitasa
   Date : 04-06-2016 *}

	{include file='include/header.tpl'}		
	<div id="page_wrapper">
	{include file='include/menu.tpl'}


	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Software</h1>
					</div>
					
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="dashboard.php">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="list_software.php">List Software</a>
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
								<h3><i class="icon-list"></i>Software</h3>
							</div>
							
						

				<form action="list_software.php" name="" id="formID" class="" method="post" accept-charset="utf-8">							<div class="box-content">
							
				<div class="dataTables_wrapper">
						
				<div class="" id="DataTables_Table_8_filter"  style="padding:15px">
				
			    <span>Search:</span>  
				 <input name="keyword" value="{$keyword}" id="keyword" autocomplete="off" placeholder="Search here..." type="text"/> 

			    {html_options name='sw_type' class="input-medium" placeholder="" style="clear:left" id="HrEmployeeRecStatus" options=$sw_type_data selected=$sw_type}
			    {html_options name='sw_status' class="input-medium" placeholder="" style="clear:left" id="HrEmployeeRecStatus1" options=$type selected=$sw_status}
	          <input name="f_date" value="{$f_date}" class="input-small datepick" placeholder="Validity From" type="text" id="HrEmployeeDob"/> 
	          <input name="t_date" value="{$t_date}" class="input-small datepick" placeholder="Validity To" type="text" id="HrEmployeeDob"/> 
		      
		       <input type="submit" value="Search" class="btn btn-primary" style="margin-bottom:9px;margin-left:4px;">
             <a href="list_software.php"><button style="margin-bottom:9px;margin-left:4px;" val="list_software.php" type="button" class="jsRedirect btn btn-primary"><i class="icon-refresh"></i> Reset</button></a>
             <a href="add_software_details.php"><button type="button" val="add_software_details.php" class="jsRedirect btn btn-primary" style="float:right"><i class="icon-plus"></i> Add Software</button></a>
             {if !$ALERT_MSG} 
              <a href="list_software.php?action=export&keyword={$smarty.post.keyword}&sw_type={$smarty.post.sw_type}&sw_status={$sw_status}&f_date={$f_date}&t_date={$t_date}"><button val="list_software.php?action=export&keyword={$smarty.post.keyword}&sw_type={$smarty.post.sw_type}&sw_status={$sw_status}&f_date={$f_date}&t_date={$t_date}" type="button" class="jsRedirect btn btn-primary" style="float:right;margin-right:20px;"><i class="icon-reply"></i> Export</button></a>
				 {/if}		
            </div>			

								<table class="table table-hover table-nomargin table-bordered usertable dataTable">
									<thead>
										<tr>
											<th width="150">
											<a href="list_software.php?field=software_type&order={$order}&page={$smarty.get.page}&keyword={$keyword}&sw_type={$sw_type}&sw_status={$sw_status}&f_date={$f_date}&t_date={$t_date}" class="{$sort_field_software_type}">Type</a></th>
										   <th width="150">
											<a href="list_software.php?field=brand&order={$order}&page={$smarty.get.page}&keyword={$keyword}&sw_type={$sw_type}&sw_status={$sw_status}&f_date={$f_date}&t_date={$t_date}" class="{$sort_field_brand}">Brand</a></th>		
											<th width="150">
											<a href="list_software.php?field=edition&order={$order}&page={$smarty.get.page}&keyword={$keyword}&sw_type={$sw_type}&sw_status={$sw_status}&f_date={$f_date}&t_date={$t_date}" class="{$sort_field_edition}">Edition</a></th>
											<th width="60">
											<a href="list_software.php?field=no_license&order={$order}&page={$smarty.get.page}&keyword={$keyword}&sw_type={$sw_type}&sw_status={$sw_status}&f_date={$f_date}&t_date={$t_date}"  class="{$sort_field_no_license}">No. Licenses</a></th>
											<th width="60">
											<a href="list_software.php?field=subscription&order={$order}&page={$smarty.get.page}&keyword={$keyword}&sw_type={$sw_type}&sw_status={$sw_status}&f_date={$f_date}&t_date={$t_date}"  class="{$sort_field_subscription}">Subscription</a></th>
											<th width="60">
											<a href="list_software.php?field=validity&order={$order}&page={$smarty.get.page}&keyword={$keyword}&sw_type={$sw_type}&sw_status={$sw_status}&f_date={$f_date}&t_date={$t_date}" class="{$sort_field_validity}">Validity</a></th>
											<th width="60">
											<a href="list_software.php?field=vendor&order={$order}&page={$smarty.get.page}&keyword={$keyword}&sw_type={$sw_type}&sw_status={$sw_status}&f_date={$f_date}&t_date={$t_date}" class="{$sort_field_vendor}">Vendor</a></th>																						
											<th width="60">
											<a href="list_software.php?field=created&order={$order}&page={$smarty.get.page}&keyword={$keyword}&sw_type={$sw_type}&sw_status={$sw_status}&f_date={$f_date}&t_date={$t_date}" class="{$sort_field_created}">Created</a></th>
											<th width="60">
											<a href="list_software.php?field=modified&order={$order}&page={$smarty.get.page}&keyword={$keyword}&sw_type={$sw_type}&sw_status={$sw_status}&f_date={$f_date}&t_date={$t_date}" class="{$sort_field_modified}">Modified</a></th>											
											<th style="text-align:center" width="100">Status</th>
											<th width="150">Options</th>
										</tr>
									</thead>
									<tbody>
									 {foreach from=$data item=item key=key}		
									 {if $item.software_type}		
										<tr>
										 <td>{ucfirst($item.software_type)}</td>
		        						 <td>{ucfirst($item.brand)}</td> 
		                         <td>{ucfirst($item.edition)}</td> 	
				                   <td>{$item.no_license}</td>
		                         <td>{$item.subscription}</td> 
		                         <td>{$item.validity_till}</td> 
		                         <td>{ucfirst($item.vendor_name)}</td> 
								       <td>{$item.created_date}</td> 
								       <td>{$item.modified_date}</td>		
										 <td style="text-align:center"><span class='label label-{$item.status_cls}'><a href='#' rel='tooltip' data-original-title = {$item.status}>{$item.status}</a></span></td>
										 <td class='hidden-480'>
												<a href="view_software.php?id={$item.id}" class="btn" rel="tooltip" title="View"><i class="icon-search"></i></a>
											   <a href="edit_software_details.php?id={$item.id}" class="btn" rel="tooltip" title="Edit"><i class="icon-edit"></i></a>
												<a href="delete_software.php?id={$item.id}&page={$smarty.get.page}" name="21" onclick="return deletefunction()" class="btn delRec" rel="tooltip" title="Delete"><i class="icon-remove"></i></a>
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
							<input type="hidden" id="page" value="list_software">
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
