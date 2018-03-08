{* Purpose : To list and search approve scrap hardware.
   Created : Nikitasa
   Date : 27-02-2018 *}

	{include file='include/header.tpl'}		
	<div id="page_wrapper">
	{include file='include/menu.tpl'}
	
<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Approve Scrap Hardware</h1>
					</div>
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="dashboard.php">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						<li>
							<a href="list_approve_scrap_hardware.php">List Approve Scrap Hardware</a>
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
								<h3><i class="icon-list"></i>Approve Scrap Hardware</h3>
						</div>
				<form action="list_approve_scrap_hardware.php" name="" id="formID" class="" method="post" accept-charset="utf-8">							
				<div class="box-content">
				<div class="dataTables_wrapper">
				<div class="" id="DataTables_Table_8_filter"  style="padding:15px">
				<span>Search:</span>  
				 <input name="keyword" value="{$keyword}" id="keyword" autocomplete="off" placeholder="Search here..." type="text"/>
			    {html_options name='hw_type' class="input-medium" placeholder="" style="clear:left" id="HrEmployeeRecStatus" options=$hw_type_data selected=$hw_type}
			     {html_options name='type' class="input-medium" placeholder="" style="clear:left" id="HrEmployeeRecStatus" options=$type_data selected=$type}
				<input name="f_date" value="{$f_date}" class="input-small datepick" placeholder="From Date" type="text" id="HrEmployeeDob"/> 
	          <input name="t_date" value="{$t_date}" class="input-small datepick" placeholder="To Date" type="text" id="HrEmployeeDob"/> 
		       <input type="submit" value="Search" class="btn btn-primary" style="margin-bottom:9px;margin-left:4px;">
             <a href="list_approve_scrap_hardware.php"><button style="margin-bottom:9px;margin-left:4px;" type="button" val="list_approve_scrap_hardware.php" class="jsRedirect btn btn-primary"><i class="icon-refresh"></i> Reset</button></a>
             {if !$ALERT_MSG} 
             <a href="list_approve_scrap_hardware.php?action=export&keyword={$smarty.post.keyword}&hw_type={$smarty.post.hw_type}&f_date={$smarty.post.f_date}&t_date={$smarty.post.t_date}"><button type="button" val="list_scrap_hardware.php?action=export&keyword={$smarty.post.keyword}&hw_type={$smarty.post.hw_type}&f_date={$smarty.post.f_date}&t_date={$smarty.post.t_date}" class="jsRedirect btn btn-primary" style="float:right;margin-right:20px;"><i class="icon-reply"></i> Export</button></a>			
            {/if}
            </div>			
				<table class="table table-hover table-nomargin table-bordered usertable dataTable">
					<thead>
						<tr>	
							<th width="200">
								<a href="list_approve_scrap_hardware.php?field=type&order={$order}&page={$smarty.get.page}&keyword={$keyword}&hw_type={$hw_type}&f_date={$f_date}&t_date={$t_date}" class="{$sort_field_type}">Type</a></th>
							<th width="200">
								<a href="list_approve_scrap_hardware.php?field=brand&order={$order}&page={$smarty.get.page}&keyword={$keyword}&hw_type={$hw_type}&f_date={$f_date}&t_date={$t_date}" class="{$sort_field_brand}">Brand</a></th>		
							<th width="200">
								<a href="list_approve_scrap_hardware.php?field=model_id&order={$order}&page={$smarty.get.page}&keyword={$keyword}&hw_type={$hw_type}&f_date={$f_date}&t_date={$t_date}" class="{$sort_field_model_id}">Model Id</a></th>
							<th width="200">
								<a href="list_approve_scrap_hardware.php?field=inventory_no&order={$order}&page={$smarty.get.page}&keyword={$keyword}&hw_type={$hw_type}&f_date={$f_date}&t_date={$t_date}" class="{$sort_field_inventory_no}">Inventory No</a></th>
							<th width="200">
								<a href="list_approve_scrap_hardware.php?field=location&order={$order}&page={$smarty.get.page}&keyword={$keyword}&hw_type={$hw_type}&f_date={$f_date}&t_date={$t_date}" class="{$sort_field_location}">Location</a></th>
							<th width="200">
								<a href="list_approve_scrap_hardware.php?field=asset_desc&order={$order}&page={$smarty.get.page}&keyword={$keyword}&hw_type={$hw_type}&f_date={$f_date}&t_date={$t_date}" class="{$sort_field_asset_desc}">Asset Description</a></th>
							<th width="200">
								<a href="list_approve_scrap_hardware.php?field=created_date&order={$order}&page={$smarty.get.page}&keyword={$keyword}&hw_type={$hw_type}&f_date={$f_date}&t_date={$t_date}" class="{$sort_field_created_date}">Scrap Date</a></th>
							<th width="100">Options</th>
				      </tr>
				  </thead>
				<tbody>
				 {foreach from=$data item=item key=key}		
					{if $item.type}	
					<tr>
						<td>{$item.type}</td> 
						<td>{$item.brand}</td>
						<td>{$item.model_id}</td>
						<td>{$item.inventory_no}</td>
						<td>{$item.location}</td>
						<td>{$item.asset_desc}</td>
						<td>{$item.scrap_created}</td>
					   <!-- td class='hidden-480'>
						<a href="view_approve_scrap_hardware.php?id={$item.id}" class="btn" rel="tooltip" title="View"><i class="icon-search"></i></a>
					   </td-->
							<td style="text-align:center">
								<a href="view_approve_scrap_hardware.php?id={$item.id}" rel="tooltip" class="btn  btn-mini" title="Approve Scrap"><i class="icon-edit"></i></a>
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
				<input type="hidden" id="page" value="approve_scrap_hardware">
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