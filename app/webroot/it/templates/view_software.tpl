{* Purpose : To view software details.
   Created : Nikitasa
   Date : 07-06-2016 *}

{include file='include/header.tpl'}		
<div id="page_wrapper">
{include file='include/menu.tpl'}

		<input type="hidden" value="/" id="site_root"/>	
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>View Software</h1>
					</div>
					
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="dashboard.php">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="list_software.php">Software</a>
								<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="view_software.php?id={$id}">View Software</a>
						</li>
					</ul>
					
				</div>	
					<div class="row-fluid  footer_div">
					<div class="span12">
								<form action="view.software.php" method="POST" class="form-horizontal form-wizard ui-formwizard" id="ss" novalidate="novalidate">
									<div class="step ui-formwizard-content" id="firstStep" style="width:99%;margin-top:20px;">														
									</div>
								</form>
						
					<form action="/ceo_apps/hremployee/create_employee/confirm/" id="formID" class="form-horizontal form-column form-bordered" enctype="multipart/form-data" method="post" accept-charset="utf-8"><div style="display:none;"><input type="hidden" name="_method" value="POST"/></div>										
						<div class="box">
							<div class="box-title">
								<h3><i class="icon-list"></i>Software Details</h3>
							</div>
							
						
							<div class="box-content nopadding">
								<div class="span6">
									<div class="control-group">
										<label for="textfield" class="control-label">Type </label>
										{foreach from=$data item=item key=key}	
										<div class="controls">
								      	{$item.software_type}
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Edition </label>
										<div class="controls">
									      {$item.edition}
										</div>
									</div>	
									<div class="control-group">
										<label for="textfield" class="control-label">Subscription Based  </label>
										<div class="controls">
											{$item.subscription}
										</div>
									</div>	
									<div class="control-group">
										<label for="textfield" class="control-label">No. of PC / License  </label>
										<div class="controls">
									     {$item.no_license}
										</div>
									</div>
									
									<div class="control-group">
									<label for="textfield" class="control-label">System Requirements   </label>
										<div class="controls">
											{$item.system_req}							
										</div>
									</div>
									</div>
                           <div class="span6">		
	                        <div class="control-group">
										<label for="textfield" class="control-label">Brand  </label>
											<div class="controls">
												{$item.brand}
											</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Architecture   </label>				
											<div class="controls">
												{$item.arch}
											</div>
									</div>					
									<div class="control-group">
										<label for="textfield" class="control-label">Subscription Validity   </label>
											<div class="controls">
											 		{if $item.validity_from}{$item.validity_from}  -  {$item.validity_till}{else}Nil{/if}
											</div>
									</div>
								   <div class="control-group">
										<label for="textfield" class="control-label">Description   </label>
											<div class="controls">
                           	      {$item.description}
											</div>
									</div>
									<div class="control-group">
											<label for="textfield" class="control-label">Status </label>
											<div class="controls">
                                  {$item.status}
											</div>
										</div>
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
										{$item.currency_type}	{$item.amount} 
										</div>
									</div>		
									<div class="control-group">
										<label for="textfield" class="control-label">Paid By </label>
										<div class="controls">
											{$item.paid_mode} 
										</div>
									</div>
                           <div class="control-group">
		                        <label for="password" class="control-label">Attach Warranty </label>
									   <div class="controls">
											<a href = "view_software.php?id={$smarty.get.id}&action=download&file={$item.warranty}">{$item.warranty}</a>
										</div> 
									</div>
							</div>
							<div class="span6">									
							<div class="control-group">
							 <label for="password" class="control-label">Paid Date</label> </label>
								<div class="controls">
									{$item.paid_date}
								</div>
							</div>
	                  <div class="control-group">
							 <label for="password" class="control-label">Attach Bill</label> </label>
								<div class="controls">
                      		<a href = "view_software.php?id={$smarty.get.id}&action=download&file={$item.bill}">{$item.bill}</a>
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
									<label for="textfield" class="control-label">Contact Number</label>
									<div class="controls">
										{$item.vendor_phone}
									</div>
							</div>
							<div class="control-group">
									<label for="textfield" class="control-label">City </label>
									<div class="controls">
										{$item.vendor_city}
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
	                  <div class="control-group">
								<label for="textfield" class="control-label">Address </label>
									<div class="controls">
										 {$item.vendor_address}																						
									</div>
						  </div>
						  {/foreach}
						  </div>		
						  <div class="span12">
								<div class="form-actions">
									<a href="list_software.php"><input type="button" val="list_software.php" value="Back" class="jsRedirect btn btn-primary"></a>
								</div>
						 </div>	
						</div>
						</div>
						</div>
					<!--input type="hidden" id="end_date" value="02/06/2000"-->
					</form>
				</div>
				</div>
			</div>			
			</div>
		{include file='include/footer.tpl'}
		</div>
	<input type="hidden" value="/" id="css_root">
{include file='include/footer_js.tpl'}