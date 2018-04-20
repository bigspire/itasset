{* Purpose : To view hardware details.
   Created : Nikitasa
   Date : 19-06-2016 *}

{include file='include/header.tpl'}		
<div id="page_wrapper">
{include file='include/menu.tpl'}
	
	
	<input type="hidden" value="/" id="site_root"/>	
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>View Billing</h1>
					</div>
					
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="dashboard.php">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="list_billing.php">Billing</a>
								<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="view_billing_hardware.php?id={$id}">View Billing</a>
						</li>   
					</ul>
				</div>
					<div class="row-fluid  footer_div">					
					<div class="span12">
								<form action="view_billing_hardware.php" method="POST" class="form-horizontal form-wizard ui-formwizard" id="ss" novalidate="novalidate">
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
									{foreach from=$data item=item key=key}	
						<div class="control-group">
											<label for="textfield" class="control-label">Type </label>
											<div class="controls">
										{$item.hw_type}
										</div>
										</div>
										<div class="control-group">
											<label for="textfield" class="control-label">Amount  </label>
											<div class="controls">
											{$item.cost}
													</div>
										</div>

										
								<div class="control-group">
											<label for="password" class="control-label">Payment Type</label>
											<div class="controls">
												{$item.payment_type}
										</div>
										</div>
										<div class="control-group">
											<label for="textfield" class="control-label">Description </label>
											<div class="controls">
											{$item.message}
											</div>
										</div>
									</div>
									
								

<div class="span6">	

										
										<div class="control-group">
											<label for="textfield" class="control-label">Inventory No (Brand)  </label>
											<div class="controls">
										{$item.invid} ({$item.brand})
													</div>
										</div>
												<div class="control-group">
											<label for="textfield" class="control-label">Bill Date  </label>
											<div class="controls">
											{$item.invoice_date}
											</div>
										</div>
																			
										<div class="control-group">
										<label for="textfield" class="control-label">Bill Copy   </label>
											<div class="controls">
											<a href = "view_billing_hardware.php?id={$smarty.get.id}&action=download&file={$item.attachment}">
											{$item.attachment}
											</a>
											</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Bill No   </label>
											<div class="controls">
											 	{$item.bill_no}
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

											<div class="span6">

										<div class="control-group">
											<label for="textfield" class="control-label">Company Name </label>
											<div class="controls">
										    {$item.vendor_company}
												</div>
										</div>    
										<div class="control-group">
											<label for="textfield" class="control-label">Email Id </label>
											<div class="controls">
											  {$item.vendor_email}
													</div>
										</div>   
										<div class="control-group">
											<label for="textfield" class="control-label">Contact Number </label>
											<div class="controls">
													  {$item.vendor_phone}
													</div>
										</div>  
				<div class="control-group"></div>
		            </div>
									<div class="span6">		
																						
	                           <div class="control-group">
											<label for="password" class="control-label">Contact Person </label>
											<div class="controls">
												{$item.vendor_person}
										</div>
										</div>	
											<div class="control-group">
											<label for="textfield" class="control-label">City </label>
											<div class="controls">
										{$item.vendor_city}
											</div>
										</div>							
<div class="control-group">
											<label for="textfield" class="control-label">Address </label>
											<div class="controls">
										{$item.vendor_address}
											</div>
										</div>	
				<div class="control-group"></div>	
									</div>
					
																  {/foreach}
								
							<div class="span12">
										<div class="form-actions">
										<a href="list_billing.php"><input type="button" val="list_billing.php" value="Back" class="jsRedirect btn btn-primary"></a>	
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