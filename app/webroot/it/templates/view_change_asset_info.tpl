{* Purpose : To view change asset info.
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
						<h1>View Change Asset Info</h1>
					</div>
					
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="dashboard.php">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						<li>
							<a href="list_change_asset_info.php">Change Asset Info</a>
								<i class="icon-angle-right"></i>
						</li>
						<li>
							<a href="view_change_asset_info.php?id={$id}">View Change Asset Info</a>
						</li>
					</ul>
				</div>
				<div class="row-fluid  footer_div">
					<div class="span12">
					<form action="post.php" method="POST" class="form-horizontal form-wizard ui-formwizard" id="ss" novalidate="novalidate">
					<div class="step ui-formwizard-content" id="firstStep" style="width:99%;margin-top:20px;">										
					</div>
					</form>
					<form action="view_change_asset_info.php" id="formID" class="form-horizontal form-column form-bordered" enctype="multipart/form-data" method="post" accept-charset="utf-8">											
						<div class="box">
							<div class="box-title">
								<h3><i class="icon-list"></i>Change Asset Info </h3>
							</div>
						<div class="box-content nopadding">
						<div class="span6">
							<div class="control-group">
								<label for="textfield" class="control-label">Employee <span class="red_star"></span></label>
								{foreach from=$data item=item key=key}
								<div class="controls">{$item.full_name}</div>
							</div>
							<div class="control-group">
								 <label for="password" class="control-label">Brand<span class="red_star"></span></label>
								 <div class="controls">{$item.brand}</div>
							</div>
							<div class="control-group">
								 <label for="password" class="control-label">Message<span class="red_star"></span></label>
								 <div class="controls">{$item.message}</div>
							</div>
							<div class="control-group">
								 <label for="password" class="control-label">Remarks<span class="red_star"></span></label>
								 <div class="controls">{$item.remark}</div>
							</div>
						</div>			
                  <div class="span6">		
						<div class="control-group">
							<label for="textfield" class="control-label">Asset Type <span class="red_star"></span></label>
							<div class="controls">{$item.type} {if {$item.sw_type}}({$item.sw_type}){/if}{if {$item.hw_type}}({$item.hw_type}){/if}</div>
						</div>
						{if $item.type_status eq 'H'}
						<div class="control-group">
								 <label for="password" class="control-label">Inventory No<span class="red_star"></span></label>
								 <div class="controls">{$item.inventory_no}</div>
						</div>
						{else}
						<div class="control-group">
								 <label for="password" class="control-label">Edition<span class="red_star"></span></label>
								 <div class="controls">{$item.edition}</div>
						</div>
						{/if}
						<div class="control-group">
							<label for="textfield" class="control-label">Status <span class="red_star"></span></label>
							<div class="controls">{$item.status}</div>
						</div>
						<div class="control-group">
						</div>
						</div>	
						</div>	
						{/foreach}
						<div class="span12">
							<div class="form-actions">
								<a href="list_change_asset_info.php"><input type="button" val="list_change_asset_info.php" value="Back" class="jsRedirect btn btn-primary"></a>
							</div>
						</div>
				  </div>
				</div>
			</form>		
		</div>
	</div>
</div>
</div>		
</div>
{include file='include/footer.tpl'}
</div>
<input type="hidden" value="/" id="css_root">
{include file='include/footer_js.tpl'}