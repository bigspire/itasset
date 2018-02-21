{* Purpose : To edit software confirmation.
   Created : Gayathri
   Modified : Nikitasa
   Date : 04-06-2016 *}
   
	{include file='include/header.tpl'}

	<div id="page_wrapper">
{include file='include/menu.tpl'}	
	
	
		<input type="hidden" value="/" id="site_root"/>	
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Edit Software</h1>
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
							<a href="edit_software_confirmation.php?id={$getid}">Edit Software</a>
						</li>
					</ul>
					
				</div>
				
								
				
					
					<div class="row-fluid  footer_div">
					
					
					<div class="span12">
					
								<form action="edit_software_confirmation.php?id={$getid}" method="POST" class="form-column form-bordered form-horizontal form-wizard ui-formwizard" id="formID" novalidate="novalidate">
									<div class="step ui-formwizard-content" id="firstStep" style="width:99%;margin-top:20px;">
										<ul class="wizard-steps steps-4">
												<li class="">
												<div class="single-step">
													<span class="title">
														1</span>
													<span class="circle">
													</span>
													<span class="description">
													<a href="edit_software_details.php?id={$getid}">Software Details</a> 		
																		</span>
												</div>
											</li>
										
											<li class="">
												<div class="single-step">
													<span class="title">
														2</span>
													<span class="circle">
													</span>
													<span class="description">
													<a href="edit_software_pricing_details.php?id={$getid}">Pricing Details</a> 		
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
													<a href="edit_software_vendor_details.php?id={$getid}">Vendor Details</a> 		
																				</span>
												</div>
											</li>
											
																				
											<li class="active">
												<div class="single-step">
													<span class="title">
														4</span>
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
								<h3><i class="icon-list"></i>Software Details</h3>
							</div>
							
						
							<div class="box-content nopadding">
								
								
									<div class="span6">
									
										<div class="control-group">
											<label for="textfield" class="control-label">Type </label>
											<div class="controls">
											{ucfirst($smarty.session['s'].software_type)}
										</div>
										</div>
										
										
										<div class="control-group">
											<label for="textfield" class="control-label">Edition </label>
											<div class="controls">
									      {ucfirst($smarty.session['s'].edition)}
											</div>
										</div>
										
										
											
										
										
										<div class="control-group">

												<label for="textfield" class="control-label">Subscription Based  </label>
											<div class="controls">
  											{$smarty.session['s'].subscriptionbased}
											</div>
										</div>
										
										<div class="control-group">
												<label for="textfield" class="control-label">No. of PC / License  </label>
											<div class="controls">
									     {$smarty.session['s'].no_license}

											</div>
										</div>
										
										<div class="control-group">
											<label for="textfield" class="control-label">System Requirements   </label>
											<div class="controls">
											{ucfirst($smarty.session['s'].system_req)}							
											</div>
										</div>
																	
								
									</div>
									
									

									
									

<div class="span6">		

	                           <div class="control-group">
											<label for="textfield" class="control-label">Brand  </label>
											<div class="controls">
											{ucfirst($smarty.session['s'].brand_name)}
											</div>
										</div>
										
										
	                               <div class="control-group">
											<label for="textfield" class="control-label">Architecture   </label>				
											<div class="controls">
											{$smarty.session['s'].architechture}
											</div>
										</div>		
									
										
										
									<div class="control-group">
											<label for="textfield" class="control-label">Subscription validity   </label>
											<div class="controls">	
											{if !empty($smarty.session['s'].validityfrom)}
											{$smarty.session['s'].validityfrom} - {$smarty.session['s'].validitytill} 
											{else}
											Nil
											{/if}
											</div>
										</div>
										
									
								<div class="control-group">
											<label for="textfield" class="control-label">Description   </label>
											 
											<div class="controls">
                                 {ucfirst($smarty.session['s'].description)}
											</div>
										</div>
																
								<div class="control-group">
											<label for="textfield" class="control-label">Status </label>
											 
											<div class="controls">
                                 {if $smarty.session['s'].status == 1}
                                   Active
                                   {else}
                                   Inactive
                                   {/if}
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
											{$smarty.session['s'].currencytype}  {$smarty.session['s'].amount} 
													</div>
										</div>
										
										
																					
									<div class="control-group">
											<label for="textfield" class="control-label">Paid By </label>
											<div class="controls">
											{$smarty.session['s'].paidby} 
												</div>
										</div>
									
	<div class="control-group">
											<label for="password" class="control-label">Bill No</label> 
											<div class="controls">
											{$smarty.session['s'].bill_no} 
												</div>
						</div>
										
									</div>
									
								
									<div class="span6">									

	<div class="control-group">
											<label for="password" class="control-label">Purchase Date</label> </label>
											<div class="controls">
											{$smarty.session['s'].purchasedate} 
											</div>
										</div>
									<div class="control-group">
											<label for="password" class="control-label">Paid Date</label> </label>
											<div class="controls">
											{$smarty.session['s'].paiddate} 
											</div>
										</div>												
								<div class="control-group">
											<label for="password" class="control-label">Attach Bill</label> 
											<div class="controls">
												{if !empty($smarty.session['s'].billfile_edit)}
												<a href = "edit_software_confirmation.php?id={$smarty.get.id}&action=download&file={$smarty.session['s'].billfile_edit} ">{$smarty.session['s'].billfile_edit} </a>
												{else} 
												<a href = "edit_software_confirmation.php?id={$smarty.get.id}&action=download&file={$smarty.session['s'].billfile} ">{$smarty.session['s'].billfile} </a> 
											{/if}	
											
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
											{ucfirst($smarty.session['s'].vendor_name)} 
													</div>
										</div>
										<div class="control-group">
											<label for="textfield" class="control-label">Email Id </label>
											<div class="controls">
											{$smarty.session['s'].vendor_email} 
													</div>
										</div>
										<div class="control-group">
											<label for="textfield" class="control-label">Contact Number</label>
											<div class="controls">
											{$smarty.session['s'].vendor_phone} 	
											</div>
										</div>
																				
											
										
									</div>
									

									<div class="span6">									
	
   <div class="control-group">
											<label for="textfield" class="control-label">Contact Person </label>
											<div class="controls">
											{ucfirst($smarty.session['s'].vendor_person)} 	
											</div>
										</div>
										<div class="control-group">
											<label for="textfield" class="control-label">City </label>
											<div class="controls">
											{ucfirst($smarty.session['s'].vendor_city)}
											</div>
										</div>	
	<div class="control-group">
											<label for="textfield" class="control-label">Address </label>
											<div class="controls">
										   {ucfirst($smarty.session['s'].vendor_address)}																								
											</div>
										</div>
										
								
									</div>
						
										
							<div class="span12">
										<div class="form-actions">
											<a href="edit_software_vendor_details.php?id={$getid}"><input val="edit_software_vendor_details.php?id={$getid}" type="button" class="jsRedirect btn" name="previous" id="submit_previous" value="Previous"></a>
											<input type="submit" name="finish" value="Finish" id="submit_next" class="btn btn-primary">
											
											<a href="list_software.php"><button type="button" val="list_software.php" class="jsRedirect btn regCancel" onclick="return cancelfunction()">Cancel</button></a>
											
										</div>
									</div>	
								
							</div>
						</div>
				
						
						</div>
					
					
					<input type="hidden" id="next_hdn" name="next_hdn">
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