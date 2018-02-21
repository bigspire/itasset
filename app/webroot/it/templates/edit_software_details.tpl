{* Purpose : To add software details.
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
							<a href="edit_software_details.php?id={$getid}">Edit Software</a>
						</li>
					</ul>
					
				</div>
				<div class="row-fluid  footer_div">
				
					<div class="span12">

				<form action="edit_software_details.php?id={$getid}" method="POST" class="form-horizontal form-wizard ui-formwizard form-column form-bordered" id="formID" novalidate="novalidate">
				
				<div class="step ui-formwizard-content" id="firstStep" style="width:99%;margin-top:20px;">
										<ul class="wizard-steps steps-4">
												<li class="active">
												<div class="single-step">
													<span class="title">
														1</span>
													<span class="circle">
													</span>
													<span class="description">
																				Software Details 		
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
											
																				
											<li class="">
												<div class="single-step">
													<span class="title">
														4</span>
													<span class="circle">
													</span>
													<span class="description">
													<a href="edit_software_confirmation.php?id={$getid}">Confirm</a> 		
																				</span>
												</div>
											</li>
																					</ul>
									</div>
								
								
						
							
									
									
						<div class="box">
							<div class="box-title">
								<h3><i class="icon-list"></i> Software Details</h3>
							</div>
							
						
							<div class="box-content nopadding">
							<div class="span6">
									
										<div class="control-group">
											<label for="textfield" class="control-label">Type <span class="red_star"> *</span></label>
											<div class="controls field">
<select name="software_type_id" id="softwaretype">
<option value="">Select</option>			
{html_options class="input-xlarge" style="clear:left" id="softwaretype" options=$row selected=$smarty.session['s'].software_type_id}										
{$smarty.session['s'].softwaretype}
</select>
  <div class="errorMsg error">{$softwaretypeErr} </div>
										</div>
										</div>
										
										
										<div class="control-group">
										<label for="textfield" class="control-label">Edition <span class="red_star"> *</span></label>
										<div class="controls field">									
 											<input name="edition" class="input-xlarge" placeholder="" type="text" id="edition" value="{$smarty.session['s'].edition}"/> 
  											<div class="errorMsg error">{$editionErr}{$EXIST_MSG} </div>
										</div>
										</div>
										
										<div class="control-group">
										<label for="textfield" class="control-label">Subscription Based <span class="red_star"> *</span></label>
										<div class="controls field">
										<select class="input-xlarge change_subscription_based" name="subscription" id="subscription_based">
											{html_options class="input-xlarge change_subscription_based" placeholder="" style="clear:left" options=$subscription_based selected=$smarty.session['s'].subscription}				
										</select>											
											<div class="errorMsg error">{$subscription_basedErr} </div>
										</div>
										
											<div class="control-group">
											<label for="password" class="control-label sValidity">Validity <span class="red_star"> *</span></label>
											<div class="controls field">

 <input name="validity_from" class="input-medium datepick sValidity" placeholder="Valid From" type="text" id="validity_from" value="{$smarty.session['s'].validity_from}"/> 											
	  <div class="spaError errorMsg error sValidity" style="width:175px;">{$validity_fromErr} </div>
 <input name="validity_till" style="margin-left:5px;" class="input-medium datepick sValidity" placeholder="Valid Till" type="text" id="validity_to" value="{$smarty.session['s'].validity_till}"/> 											
	<div class="errorMsg error sValidity" style="margin-left:175px;">{$validity_tillErr} </div>

											</div>
										</div>
									
	
										</div>
										<div class="control-group">
											<label for="textfield" class="control-label">System Requirements <span class="red_star"> *</span></label>
											<div class="controls field">
										<textarea name="system_req" rows="2" class="input-xlarge" placeholder="" cols="30" id="system_req">{$smarty.session['s'].system_req}</textarea> 

<div class="errorMsg error">{$system_reqErr} </div>											
											</div>
										</div>
									</div>
<div class="span6">		

	<div class="control-group">
											<label for="textfield" class="control-label">Brand <span class="red_star"> *</span></label>
											<div class="controls field">
											<select name="it_brand_id" id="brand">
											<option value="">Select</option>
{html_options class="input-xlarge" placeholder="" style="clear:left" id="brand" options=$softwarebrands selected=$smarty.session['s'].it_brand_id}
</select>
<div class="errorMsg error">{$brandErr} </div>
											</div>
										</div>
										
										
	 <div class="control-group">
											<label for="textfield" class="control-label"> Architecture<span class="red_star"> *</span></label>
											<div class="controls field">
											<select name="arch" id="architechture_no">
											<option value="">Select</option>			
{html_options class="input-xlarge" placeholder="" style="clear:left" options=$architechtures selected=$smarty.session['s'].arch}
</select>
<div class="errorMsg error">{$architechture_noErr} </div>										
											</div>
										</div>

	<div class="control-group">
										<label for="textfield" class="control-label">No. of PC / License <span class="red_star"> *</span></label>
										<div class="controls field">
										<input name="no_license" class="input-xlarge numeric" placeholder="" type="text" id="license_no" autocomplete="off" value="{$smarty.session['s'].no_license}"/> 

										<div class="errorMsg error">{$license_noErr} {$license_noE}</div>
										</div>
										</div>
									
								<div class="control-group">
											<label for="password" class="control-label">Description<span class="red_star"></span></label>
											<div class="controls">
                                  
												<textarea name="description" rows="2" class="input-xlarge" placeholder="" cols="30" id="description" value="description">{$smarty.session['s'].description}</textarea> 

											</div>
										</div>
									<div class="control-group">
											<label for="textfield" class="control-label">Status <span class="red_star"> *</span></label>
											
											<div class="controls field">
									{html_options name=status class="input-xlarge" placeholder="" style="clear:left" id="status" options=$login_status selected=$smarty.session['s'].status}	
											<div class="errorMsg error">{$statusErr}{$ERROR_MSG} </div>	
										</div>
										</div>								
								
									</div>
						<div class="span12">
										<div class="form-actions">
										
							
		 
<input onclick="return validate_sd()" type="submit" name="next" id="submit_next" value="Next" class="btn btn-primary">		 
<input onclick="return validate_sd()" type="submit" name="confirm" id="submit_confirm" value="Confirm" class="btn btn-primary"> 
		
		<a href="list_software.php"><button type="button" val="list_software.php" class="jsRedirect btn regCancel" onclick="return cancelfunction()">Cancel</button></a>
											
										</div>
									</div>	
								
							</div>
						</div>
						</div>
					
					
					
					<input type="hidden" id="next_hdn" name="next_hdn">
					<input type="hidden" id="confirm_hdn" name="confirm_hdn">
					<input type="hidden" id="previous_hdn" name="previous_hdn">
					
					<!--input type="hidden" id="end_date" value="30/05/2000"-->
					</form>			
									
				</div>
					</div>
		
			</div>		
					
				</div>
  				{include file='include/footer.tpl'}
		
		</div>
	
	<input type="hidden" value="/" id="css_root">

{include file='include/footer_js.tpl'}

