{* Purpose : To view assign asset.
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
						<h1>View Assign Asset</h1>
					</div>
					
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="dashboard.php">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="list_assign_asset.php">Assign Asset</a>
								<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="view_assign_asset.php?id={$id}&type={$smarty.get.type}">View Assign Asset</a>
						</li>
					</ul>
					
				</div>
				<div class="row-fluid  footer_div">
					<div class="span12">
					
					<form action="view_assign_asset.php" id="formID" class="form-horizontal form-column form-bordered" enctype="multipart/form-data" method="post" accept-charset="utf-8">										
						<div class="box">
							<div class="box-title">
								<h3><i class="icon-list"></i>Assign Asset Details</h3>
							</div>
							<div class="box-content nopadding" style="border-bottom:1px solid #ddd;">
								<div class="span12">
										<div class="row-fluid">									
										<div class="control-group">
											<label for="textfield" class="control-label">Employee Name </label>
											
											<div class="controls">
											 {$name}
										   </div>
									</div>
									
									<div class="control-group">
											<label for="textfield" class="control-label">Last Modified</label>
											
											<div class="controls">
											  {$created}
										   </div>
									</div>

								</div>
								</div>
							</div>		
									
							{foreach from=$data item=item key=key}
	
		<div class="box-content nopadding" style="border-bottom:1px solid #ddd;border-top:1px solid #ddd;margin-top:20px;">
									<div class="span12">
										<div class="row-fluid">
										<div class="span6" style="clear:left;">
								     <div class="control-group">
											<label for="textfield" class="control-label">Asset Type</label>
											 
											<div class="controls">
											{if $item.type eq 'S'} Software {else} Hardware {/if}                                  
											</div>
										</div>
											
										<div class="control-group">
											<label for="textfield" class="control-label">Brand  </label>
											<div class="controls">
											 {$item.brand}
											</div>
										</div>	
										
										<div class="control-group">
											<label for="textfield" class="control-label">Status  </label>
											<div class="controls">
											 {$item.accept}
											</div>
										</div>	

										
									</div>

										<div class="span6">		
                              <div class="control-group">
											<label for="textfield" class="control-label">{if $item.type eq 'S'} Software Type{else} Hardware Type{/if} </label>
											<div class="controls">
											 {if $item.edition} {$item.sw_type}{else}{$item.hw_type}{/if}
											</div>
										</div>
										
	                            <div class="control-group">
											<label for="textfield" class="control-label">{if $item.type eq 'S'} Edition{else}Inventory No{/if}  </label>
											<div class="controls">
											{if $item.type eq 'S'} {$item.edition} {else}{$item.inventory_no} {if $item.asset_desc} ({$item.asset_desc}){/if}{/if} 
											</div>
										</div>	
										<div class="control-group">
											<label for="textfield" class="control-label">Verified Date</label>
											<div class="controls">
											{$item.accept_date}
											</div>
										</div>	
									</div>	
										
								</div>
									</div>	
									
							</div>
							{/foreach}
						</div>
					
					            <div class="span12">
										<div class="form-actions">
											<a href="list_assign_asset.php"><input type="button" val="list_assign_asset.php" value="Back" class="jsRedirect btn btn-primary"></a>
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