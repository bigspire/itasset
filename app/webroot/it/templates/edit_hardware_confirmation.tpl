{* Purpose : To edit Hardware details.
   Created : Gayathri
   Modified : Nikitasa
   Date : 15-06-2016 *}
   
	{include file='include/header.tpl'}	
	<div id="page_wrapper">
{include file='include/menu.tpl'}
		<input type="hidden" value="/" id="site_root"/>	
		<input type="hidden" id="" name="" value="">
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Edit Hardware</h1>
					</div>
					
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="dashboard.php">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="list_hardware.php">Hardware</a>
								<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="edit_hardware_confirmation.php?id={$getid}&inv_id={$invid}">Edit Hardware</a>
						</li>
					</ul>
					
				</div>
				
								
				
					
					<div class="row-fluid  footer_div">
					
					
					<div class="span12">
					
								<form action="edit_hardware_confirmation.php?id={$getid}&inv_id={$invid}" method="POST" class="form-horizontal form-column form-bordered form-wizard ui-formwizard" id="formID" novalidate="novalidate">
									<div class="step ui-formwizard-content" id="firstStep" style="width:99%;margin-top:20px;">
										<ul class="wizard-steps steps-4">
												<li class="">
												<div class="single-step">
													<span class="title">
														1</span>
													<span class="circle">
													</span>
													<span class="description">
													<a href="edit_hardware_details.php?id={$getid}&inv_id={$invid}">Hardware Details</a> 		
																		</span>
												</div>
											</li>
										
											
				<li class="">
												<div class="single-step">
													<span class="title">
														2</span>
													<span class="circle">
														<span class="active"></span>
													</span>
													<span class="description">
													<a href="edit_hardware_inventory_details.php?id={$getid}&inv_id={$invid}">Inventory Details</a>		
																				</span>
												</div>
											</li>
											<li class="">
												<div class="single-step">
													<span class="title">
														3</span>
													<span class="circle">
													</span>
													<span class="description">
													
													{if $smarty.session['h'].is_rental == 'Y'}
													<a href="edit_rental_hardware_pricing_details.php?id={$getid}&inv_id={$invid}">Pricing Details</a> 		
													{else}
													<a href="edit_hardware_pricing_details.php?id={$getid}&inv_id={$invid}">Pricing Details</a> 
													{/if}
													
													</span>
												</div>
											</li>
											<li class="">
												<div class="single-step">
													<span class="title">
														4</span>
													<span class="circle">
													</span>
													<span class="description">
													<a href="edit_hardware_vendor_details.php?id={$getid}&inv_id={$invid}">Vendor Details</a> 		
																				</span>
												</div>
											</li>
											
																				
											<li class="active">
												<div class="single-step">
													<span class="title">
														5</span>
													<span class="circle">
													</span>
													<span class="description">
																						Confirm 		
																				</span>
												</div>
											</li>
																					</ul>
									
									
									
									</div>
								
							
									
						<div class="box">
							<div class="box-title">
								<h3><i class="icon-list"></i> Hardware Details</h3>
							</div>
							
						
							<div class="box-content nopadding">
								
								
								
								
								
									<div class="span6">
									
						<div class="control-group">
											<label for="textfield" class="control-label">Type </label>
											<div class="controls">
	                            {ucfirst($smarty.session['h'].hardware_type)}
										</div>
										</div>
										
										<div class="control-group">
											<label for="textfield" class="control-label">Color </label>
											<div class="controls">
											{ucfirst($smarty.session['h'].color)}
													</div>
										</div>
										
									
										<div class="control-group">
											<label for="password" class="control-label">Description</label>
											<div class="controls">
												{$smarty.session['h'].description}
										</div>
										</div>
								<div class="control-group">
											<label for="textfield" class="control-label">Status </label>
											 
											<div class="controls">
                                 {if $smarty.session['h'].status == 1}
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
										{ucfirst($smarty.session['h'].brand_name)}
													</div>
										</div>
										
												<div class="control-group">
											<label for="textfield" class="control-label">Model ID / Name </label>
											<div class="controls">
											{$smarty.session['h'].model_id}
											</div>
										</div>
										<div class="control-group">
										<label for="textfield" class="control-label">Subscription validity   </label>
											<div class="controls">
											{if !empty($smarty.session['h'].validityfrom)}
											{$smarty.session['h'].validityfrom} - {$smarty.session['h'].validityto} 
											{else}
											Nil	
											{/if}										
											</div>
									</div>
										
										
									
										
							
										
									</div>

								
							</div>
						</div>
				


							
						<div class="box">
							<div class="box-title">
								<h3><i class="icon-list"></i> Inventory Details</h3>
								</div>
							{for $foo=0 to $smarty.session['h'].invcount-1}		
						
							<div class="box-content nopadding">
											<div class="span6">
									
													
										<div class="control-group">
											<label for="textfield" class="control-label">Inventory No </label>
											<div class="controls">
										    {$smarty.session['h'][$foo].inventory_no}
												</div>
										</div>
											<div class="control-group">
											<label for="textfield" class="control-label">Location </label>
											<div class="controls">
												{$smarty.session['h'][$foo].district_name} ( {$smarty.session['h'][$foo].state_name} )
													</div>
										</div>
														
																				<div class="control-group"></div>									
		
										
		</div>
									
									
						
									

									<div class="span6">	
<div class="control-group">
											<label for="password" class="control-label">Serial Number </label>
											<div class="controls">
											{$smarty.session['h'][$foo].serial_no}
										</div>
										</div>
									<div class="control-group">
											<label for="textfield" class="control-label">Asset Description </label>
											<div class="controls">
										{$smarty.session['h'][$foo].asset_desc}
											</div>
										</div>								
																		
										<div class="control-group"></div>
										
									</div>
						</div>
						{/for}
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
										{$smarty.session['h'].currencytype}	{$smarty.session['h'].amount} 
													</div>
										</div>
										
								{if $smarty.session['h'].is_rental neq 'Y'}				
																					
									<div class="control-group">
											<label for="textfield" class="control-label">Paid By </label>
											<div class="controls">
											{$smarty.session['h'].paidby}
												</div>
										</div>
									
     	<div class="control-group">
											<label for="password" class="control-label">Bill No</label> </label>
											<div class="controls">
											{$smarty.session['h'].bill_no}
												</div>
						</div>
									
								{else}	
								
								<div class="control-group">
											<label for="textfield" class="control-label">Rental Type </label>
											<div class="controls">
											{$smarty.session['h'].rental_type_detail}
												</div>
										</div>	
								
								
								{/if}
							</div>	
									<div class="span6">	

	{if $smarty.session['h'].is_rental neq 'Y'}										

	<div class="control-group">
											<label for="password" class="control-label">Purchase Date</label> </label>
											<div class="controls">
											{$smarty.session['h'].purchasedate}
											</div>
										</div>
		<div class="control-group">
											<label for="password" class="control-label">Paid Date</label> </label>
											<div class="controls">
											{$smarty.session['h'].paiddate}
											</div>
										</div>									
										<div class="control-group">
											<label for="password" class="control-label">Attach Bill</label> </label>
											<div class="controls">
												{if !empty($smarty.session['h'].billfile_edit)}
												<a href = "edit_hardware_confirmation.php?id={$smarty.get.id}&action=download&file={$smarty.session['h'].billfile_edit} ">{$smarty.session['h'].billfile_edit} </a>
												{else} 
												<a href = "edit_hardware_confirmation.php?id={$smarty.get.id}&action=download&file={$smarty.session['h'].bill} ">{$smarty.session['h'].bill} </a> 
											{/if}	
											</div>
						</div>
						
						{else}
						<div class="control-group">
											<label for="password" class="control-label">Rented Date</label> </label>
											<div class="controls">
											{$smarty.session['h'].purchasedate}
											</div>
										</div>
						
						
						{/if}
						
						
								
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
											{$smarty.session['h'].vendor_name}
													</div>
										</div>
									<div class="control-group">
											<label for="textfield" class="control-label">Email Id </label>
											<div class="controls">
											{$smarty.session['h'].vendor_email}
													</div>
										</div>	
										<div class="control-group">
											<label for="textfield" class="control-label">Contact Number</label>
											<div class="controls">
											{$smarty.session['h'].vendor_phone}
											</div>
										</div>																												
									</div>
									
									
									<div class="span6">									
	
   <div class="control-group">
											<label for="textfield" class="control-label">Contact Person </label>
											<div class="controls">
											{$smarty.session['h'].vendor_person}	
											</div>
										</div>
										<div class="control-group">
											<label for="textfield" class="control-label">City </label>
											<div class="controls">
											{$smarty.session['h'].vendor_city} 	
											</div>
										</div>	
	<div class="control-group">
											<label for="textfield" class="control-label">Address </label>
											<div class="controls">
											{$smarty.session['h'].vendor_address}																						
											</div>
										</div>
										
								
									</div>
					
							
										
							<div class="span12">
										<div class="form-actions">
										<a href="edit_hardware_vendor_details.php?id={$getid}&inv_id={$invid}"><button type="button" val="edit_hardware_vendor_details.php?id={$getid}&inv_id={$invid}" id="submit_previous" class="jsRedirect btn"><i class="icon-arrow-left"></i> Previous</button></a>
											<input type="submit" name="finish" id="submit_next" value="Finish" class="btn btn-primary">
											
											<a href="list_hardware.php"><button type="button" val="list_hardware.php" class="jsRedirect btn regCancel" onclick="return cancelfunction()">Cancel</button></a>
											
										</div>
									</div>	
								
							</div>
						</div>
				
						
							
							
						</div>
					
					
					
					<input type="hidden" id="next_hdn" name="next_hdn">
					<input type="hidden" id="confirm_hdn" name="confirm_hdn">
					<input type="hidden" id="previous_hdn" name="previous_hdn">
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
