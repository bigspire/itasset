{* Purpose : To view scrap hardware.
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
						<h1>View Approve Scrap Hardware</h1>
					</div>
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="dashboard.php">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						<li>
							<a href="list_approve_scrap_hardware.php">Approve Scrap Hardware</a>
								<i class="icon-angle-right"></i>
						</li>
						<li>
							<a href="view_approve_scrap_hardware.php?id={$id}">View Approve Scrap Hardware</a>
						</li>
					</ul>
				</div>
					<div class="row-fluid  footer_div">
					<div class="span12">
		
					<form action="view_approve_scrap_hardware.php" id="formID" class="form-horizontal form-column form-bordered" enctype="multipart/form-data" method="post" accept-charset="utf-8"><div style="display:none;"><input type="hidden" name="_method" value="POST"/></div>										
										<div class="step ui-formwizard-content" id="firstStep" style="width:99%;margin-top:20px;">
									</div>
								</form>
					<form action="/ceo_apps/hremployee/create_employee/confirm/" id="formID" class="form-horizontal form-column form-bordered" enctype="multipart/form-data" method="post" accept-charset="utf-8"><div style="display:none;"><input type="hidden" name="_method" value="POST"/></div>								
						<div class="box">
							<div class="box-title">
								<h3><i class="icon-list"></i> Hardware Details</h3>
								
							</div>						
							<div class="box-content nopadding">
									<div class="span6">
									
						<div class="control-group">
											<label for="textfield" class="control-label">Type </label>
											<div class="controls">
 {foreach from=$data item=item key=key}	                           
							   {$item.hardware_type}
										</div>
										</div>
										<div class="control-group">
											<label for="textfield" class="control-label">Color </label>
											<div class="controls">
											{$item.color}
													</div>
										</div>

										
								<div class="control-group">
											<label for="password" class="control-label">Description</label>
											<div class="controls">
												{$item.description}
										</div>
										</div>
										<div class="control-group">
											<label for="textfield" class="control-label">Status </label>
											<div class="controls">
                                  {if $item.status}
                                  Active
                                  {else}
                                  Inactive
                                  {/if}
											</div>
										</div>
									</div>
									
								

<div class="span6">	

										
										<div class="control-group">
											<label for="textfield" class="control-label">Brand </label>
											<div class="controls">
										{$item.brand}
													</div>
										</div>
												<div class="control-group">
											<label for="textfield" class="control-label">Model ID / Name </label>
											<div class="controls">
											{$item.model_id}
											</div>
										</div>
																			
										<div class="control-group">
										<label for="textfield" class="control-label">Subscription Validity   </label>
											<div class="controls">
											 	{if $item.validity_from}{$item.validity_from}  -  {$item.validity_to}{/if}
											</div>
									</div>
	
									</div>

								
							</div>
						</div>
				


							
						<div class="box">
							<div class="box-title">
								<h3><i class="icon-list"></i> Inventory Details</h3>
								</div>


							<div class="box-content nopadding">

											<div class="span6">

										<div class="control-group">
											<label for="textfield" class="control-label">Inventory No </label>
											<div class="controls">
										    {$item.inventory_no}
												</div>
										</div>    
										<div class="control-group">
											<label for="textfield" class="control-label">Location </label>
											<div class="controls">
												{$item.district_name} ( {$item.state_name} )
													</div>
										</div>   
				<div class="control-group"></div>
		            </div>
									<div class="span6">		
																						
	                           <div class="control-group">
											<label for="password" class="control-label">Serial Number </label>
											<div class="controls">
												{$item.serial_no}
										</div>
										</div>	
											<div class="control-group">
											<label for="textfield" class="control-label">Asset Description </label>
											<div class="controls">
										{$item.asset_desc}
											</div>
										</div>							

				<div class="control-group"></div>	
									</div>
						</div>
						</div>
				

						<div class="box">
							<div class="box-title">
								<h3><i class="icon-list"></i> Pricing Details</h3>
							</div>
													
							<div class="box-content nopadding">
								
																<div class="span6" style="">
										<div class="control-group">
											<label for="textfield" class="control-label">Amount </label>
											<div class="controls">
										{$item.currency} {$item.amount} 
													</div>
										</div>
										
										
																					
									<div class="control-group">
											<label for="textfield" class="control-label">Paid By </label>
											<div class="controls">
											{$item.paid_mode}
												</div>
										</div>
									
                       								
										
	                    <div class="control-group">
											<label for="password" class="control-label">Attach Bill</label> </label>
											<div class="controls">
                      				<a href = "view_scrap_hardware.php?id={$smarty.get.id}&action=download&file={$item.bill}">{$item.bill}</a>
											</div>
					             	</div>
	                   																			
									</div>
									
								
									<div class="span6">									

	                      <div class="control-group">
											<label for="password" class="control-label">Purchase Date  </label> </label>
											<div class="controls">
											{$item.purchase_date}
											</div>
										</div>
										<div class="control-group">
											<label for="password" class="control-label">Paid Date  </label> </label>
											<div class="controls">
											{$item.paid_date}
											</div>
										</div>
									</div>
					
							
								
							</div>
						</div>
				

		<div class="box">
							<div class="box-title">
								<h3><i class="icon-list"></i> Vendor Details</h3>
							</div>

							<div class="box-content nopadding">
																<div class="span6" style="">
				<div class="control-group">
											<label for="textfield" class="control-label">Company Name</label>
											<div class="controls">
											{$item.vendor_name}
													</div>
										</div>
									<div class="control-group">
											<label for="textfield" class="control-label">Email Id </label>
											<div class="controls">
												{$item.vendor_email}
											</div>
										</div>			
										<div class="control-group">
											<label for="textfield" class="control-label">Contact Number</label>
											<div class="controls">
												 	{$item.vendor_phone}
											</div>
										</div>
									</div>
									
									<div class="span6">									
   <div class="control-group">
											<label for="textfield" class="control-label">Contact Person </label>
											<div class="controls">
												{$item.vendor_person}	
											</div>
										</div>
									</div>	
</div>										
<div class="box">
							<div class="box-title">
								<h3><i class="icon-list"></i> Approve Scrap Hardware Details</h3>
							</div>
							
						
							<div class="box-content nopadding">
												
																<div class="span6" style="">
				<div class="control-group">
											<label for="textfield" class="control-label">Type</label>
											<div class="controls">
											{$item.hw_type}
													</div>
										</div>
									<div class="control-group">
											<label for="textfield" class="control-label">Scrap Status </label>
											<div class="controls">
												{$item.scrap}
											</div>
										</div>			</div>
																
									<div class="span6">									
	
   <div class="control-group">
											<label for="textfield" class="control-label">Message </label>
											<div class="controls">
												{$item.message}	
											</div>
										</div>
										<div class="control-group">
											<label for="textfield" class="control-label">Scrap Date </label>
											<div class="controls">
												{$item.scrap_date}	
											</div>
										</div>
									</div>	
									
									
							<div class="span12">
										<div class="form-actions">
										{if $item.scrap_status eq 'W'}
<a class="iframeBox unreadLink" rel="tooltip" title="Approve Billing" href="remarks.php?scrap_id={$item.scrap_id}&action=approve" val="40_50"><input type="button" value="Approve" class="btn btn btn-success"/></a>
<a class="iframeBox unreadLink" rel="tooltip" title="Reject Billing" href="remarks.php?scrap_id={$item.scrap_id}&action=reject" val="40_50"><input type="button" value="Reject" class="btn btn btn-danger"/></a>
				{/if}{/foreach}	
										<a href="list_approve_scrap_hardware.php"><input type="button" val="list_approve_scrap_hardware.php" value="Back" class="jsRedirect btn btn-primary"></a>	
										</div>
							</div>		
							</div>
						</div>
						</div>
					</form>
				 </div>
			</div>
		</div>		
	</div>
{include file='include/footer.tpl'}
</div>
<input type="hidden" value="/" id="css_root">
{include file='include/footer_js.tpl'}