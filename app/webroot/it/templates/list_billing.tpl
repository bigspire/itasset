{* Purpose : To list hardware details.
   Created : Nikitasa
   Modified : Gayathri
   Date : 14-06-2016 *}

	{include file='include/header.tpl'}		
	<div id="page_wrapper">
	{include file='include/menu.tpl'}


	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Billings</h1>
					</div>
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="dashboard.php">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						<li>
							<a href="list_billing.php">List Billings</a>
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
					<div class="row-fluid  footer_div previewDiv">
					<div class="span12">
						<div class="box box-bordered box-color">
						
						<div class="box-title">
								<h3><i class="icon-list"></i> Hardware Billings</h3>
						</div>
			<form action="list_hardware.php" name="" id="formID" class="" method="post" accept-charset="utf-8">							
			<div class="box-content">
			<div class="dataTables_wrapper">		
				<div class="" id="DataTables_Table_8_filter"  style="padding:15px">
				 <span>Search:</span>  
				 <input name="keyword" value="{$keyword}" id="keyword" autocomplete="off" placeholder="Search here..." type="text"/>
			    {html_options name='hw_type' class="input-medium" placeholder="" style="clear:left" id="HrEmployeeRecStatus" options=$hw_type_data selected=$hw_type}
	          <input name="f_date" value="{$f_date}" class="input-small datepick" placeholder="Billing From" type="text" id="HrEmployeeDob"/> 
	          <input name="t_date" value="{$t_date}" class="input-small datepick" placeholder="Billing To" type="text" id="HrEmployeeDob"/> 
		       <input type="submit" value="Search" class="btn btn-primary" style="margin-bottom:9px;margin-left:4px;">
             <a href="list_hardware.php"><button style="margin-bottom:9px;margin-left:4px;" type="button" val="list_hardware.php" class="jsRedirect btn btn-primary"><i class="icon-refresh"></i> Reset</button></a>
             <!--a href="add_hardware_details.php"><button type="button" val="add_hardware_details.php" class="jsRedirect btn btn-primary" style="float:right"><i class="icon-plus"></i> Add Hardware</button></a-->
			 
			 <div class="btn-group" style="margin-bottom:9px;margin-left:4px;" >
												<a href="add_billing_hardware_details.php"  class="btn btn-primary"><i class="icon-plus"></i> Add Billing </a>
											
											</div>
			 
			 
             {if !$ALERT_MSG} 
             <a href="list_hardware.php?action=export&keyword={$smarty.post.keyword}&hw_type={$smarty.post.hw_type}&hw_status={$hw_status}&f_date={$smarty.post.f_date}&t_date={$smarty.post.t_date}"><button type="button" val="list_hardware.php?action=export&keyword={$smarty.post.keyword}&hw_type={$smarty.post.hw_type}&hw_status={$hw_status}&f_date={$smarty.post.f_date}&t_date={$smarty.post.t_date}" class="jsRedirect btn btn-primary" style="float:right;margin-right:20px;"><i class="icon-reply"></i> Export</button></a>	
            {/if}
            </div>			
				<table class="table table-hover table-nomargin table-bordered usertable dataTable">
					<thead>
						<tr>
							<th width="80">
										<a href="list_hardware.php?field=hardware_type&order={$order}&page={$smarty.get.page}&keyword={$keyword}&hw_type={$hw_type}&hw_status={$hw_status}&f_date={$f_date}&t_date={$t_date}" class="{$sort_field_hardware_type}">Type</a></th>
										<th width="80">
											<a href="list_hardware.php?field=brand&order={$order}&page={$smarty.get.page}&keyword={$keyword}&hw_type={$hw_type}&hw_status={$hw_status}&f_date={$f_date}&t_date={$t_date}" class="{$sort_field_brand}">Brand</a></th>		
										<th width="80">
											<a href="list_hardware.php?field=model_id&order={$order}&page={$smarty.get.page}&keyword={$keyword}&hw_type={$hw_type}&hw_status={$hw_status}&f_date={$f_date}&t_date={$t_date}" class="{$sort_field_model_id}">Model Id</a></th>
										<th width="80">
											<a href="list_hardware.php?field=inventory_no&order={$order}&page={$smarty.get.page}&keyword={$keyword}&hw_type={$hw_type}&hw_status={$hw_status}&f_date={$f_date}&t_date={$t_date}" class="{$sort_field_inventory_no}">Inventory No</a></th>
										<th width="80">
											<a href="list_hardware.php?field=location&order={$order}&page={$smarty.get.page}&keyword={$keyword}&hw_type={$hw_type}&hw_status={$hw_status}&f_date={$f_date}&t_date={$t_date}" class="{$sort_field_location}">Location</a></th>
										<th width="80">
											<a href="list_hardware.php?field=asset_desc&order={$order}&page={$smarty.get.page}&keyword={$keyword}&hw_type={$hw_type}&hw_status={$hw_status}&f_date={$f_date}&t_date={$t_date}" class="{$sort_field_asset_desc}">Asset</a></th>
										<th width="80">
											<a href="list_hardware.php?field=validity&order={$order}&page={$smarty.get.page}&keyword={$keyword}&hw_type={$hw_type}&hw_status={$hw_status}&f_date={$f_date}&t_date={$t_date}" class="{$sort_field_validity}">Billing Date</a></th>																				
										<th width="80">
											<a href="list_hardware.php?field=vendor&order={$order}&page={$smarty.get.page}&keyword={$keyword}&hw_type={$hw_type}&hw_status={$hw_status}&f_date={$f_date}&t_date={$t_date}" class="{$sort_field_vendor}">Vendor</a></th>																			
										<th width="60">										
										<a href="list_hardware.php?field=created&order={$order}&page={$smarty.get.page}&keyword={$keyword}&sw_type={$sw_type}&sw_status={$sw_status}&f_date={$f_date}&t_date={$t_date}" class="{$sort_field_created}">Created</a></th>										
																													
										<th width="100">Options</th>
										</tr>
					</thead>
					<tbody>
						<tr>
						 {foreach from=$data item=item key=key}		
						
							 {if $item.type}		
								<tr>
									 <td>{ucfirst($item.type)} <br>
								
									 
									 </a>
									 
									 </td>
		        					 <td>{ucfirst($item.brand)}</td> 
		                      <td>{ucfirst($item.model_id)}</td> 	
				                <td>{ucfirst($item.inventory_no)}</td>
		                      <td>{ucfirst($item.location)}</td> 
		                      <td>{ucfirst($item.asset_desc)}</td> 
		                      <td>{$item.validity_to}</td> 
		                      <td>{ucfirst($item.vendor_name)}</td> 
		                      <td>{$item.created_date}</td>
									 
									 <td class='hidden-480'>
											<a href="view_hardware.php?id={$item.id}" class="btn" rel="tooltip" title="View"><i class="icon-search"></i></a>
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
														
						</div>	
					 </div>
					 <input type="hidden" id="page" value="list_hardware">
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