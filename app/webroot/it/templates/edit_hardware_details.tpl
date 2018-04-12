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
							<a href="edit_hardware_details.php?id={$getid}&inv_id={$invid}">Edit Hardware</a>
							


						</li>
					</ul>
					
				</div>
				
					<div class="row-fluid  footer_div">
					
					
					<div class="span12">
					
								<form action="edit_hardware_details.php?id={$getid}&inv_id={$invid}" method="POST" class="form-horizontal form-column form-bordered form-wizard ui-formwizard" id="formID" novalidate="novalidate">
									<div class="step ui-formwizard-content" id="firstStep" style="width:99%;margin-top:20px;">
										<ul class="wizard-steps steps-4">
												<li class="active">
												<div class="single-step">
													<span class="title">
														1</span>
													<span class="circle">
													</span>
													<span class="description">
																				Hardware Details 		
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
														<span class="active"></span>
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
											
																				
											<li class="">
												<div class="single-step">
													<span class="title">
														5</span>
													<span class="circle">
													</span>
													<span class="description">
													<a href="edit_hardware_confirmation.php?id={$getid}&inv_id={$invid}">Confirm</a> 		
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
											<label for="textfield" class="control-label">Type <span class="red_star"> *</span></label>
											
											<div class="controls field">
											<select name="hardware_type_id" id="hardware_type_id">
										<option value="">Select</option>
									{html_options class="input-xlarge" placeholder="" style="clear:left" id="license_no" options=$row selected=$smarty.session['h'].hardware_type_id}
											</select>
<div class="errorMsg error">{$hardware_type_idErr} </div>
										</div>
										</div>
										<div class="control-group">
		<label for="textfield" class="control-label">Color <span class="red_star"> *</span></label>
			<div class="controls field">
		<input name="color" class="input-xlarge" placeholder="" type="text" id="color" value="{$smarty.session['h'].color}"/>
		<div class="errorMsg error">{$colorErr} </div>
			</div>
	</div>
										
										
										
									
								<div class="control-group">
											<label for="password" class="control-label">Description<span class="red_star"></span></label>
											<div class="controls">
									<textarea name="description" rows="2" class="input-xlarge" placeholder="" cols="30" id="description">{$smarty.session['h'].description}</textarea> 
											
											<div class="error">{$descriptionErr} </div>
											
												  
											</div>
										</div>
									<div class="control-group">
											<label for="textfield" class="control-label">Status <span class="red_star"> *</span></label>
										<div class="controls field">
									{html_options name=status class="input-xlarge" placeholder="" style="clear:left" id="status" options=$login_status selected=$smarty.session['h'].status}	
											<div class="errorMsg error">{$statusErr}{$ERROR_MSG} </div>	
										</div>
										</div>			
									</div>
									
									

									
									

<div class="span6">		
     <div class="control-group">
											<label for="textfield" class="control-label">Brand <span class="red_star"> *</span></label>
											<div class="controls field">
											<select name="it_brand_id" id="it_brand_id">
										<option value="">Select</option>
	{html_options class="input-xlarge" placeholder="" style="clear:left" id="it_brand_id" options=$hw_brand selected=$smarty.session['h'].it_brand_id}
											</select>										
											<div class="errorMsg error">{$it_brand_idErr}</div>
											</div>
										</div>
	
										
								
																					<div class="control-group">
											<label for="textfield" class="control-label">Model ID / Name <span class="red_star"> *</span></label>
											<div class="controls field">
										
		<input name="model_id" class="input-xlarge" placeholder="" type="text" id="model_id" value="{$smarty.session['h'].model_id}"/> 
<div class="errorMsg error">{$model_idErr}{$EXIST_MSG}</div>											
											</div>
										</div>
										<div class="control-group">
											<label for="password" class="control-label">Validity <span class="red_star"> *</span></label>
											<div class="controls field">
<!--											{html_options name=validity_year class="input-small" placeholder="" style="clear:left" id="subscription_validity" options=$subscription_validity selected=$smarty.session['h'].validity_year}-->
											
 <input name="validity_from" class="input-medium datepick sValidity" placeholder="Valid From" type="text" id="validity_from" value="{$smarty.session['h'].validity_from}"/> 
 <div class="spaError errorMsg error sValidity" style="width:175px;">{$validity_fromErr} </div>								
<input name="validity_to" style="margin-left:5px;" class="input-medium datepick sValidity" placeholder="Valid To" type="text" id="validity_to" value="{$smarty.session['h'].validity_to}"/> 
 
<div class=" errorMsg error sValidity" style="margin-left:175px;">{$validity_toErr} </div>
<!--div class="errorMsg error">{$validity_yearErr} {$validity_dateErr}</div-->
											</div>
										</div>
									
									
									</div>


										
										
							<div class="span12">
										<div class="form-actions">
											<input onclick="return validate_hd()" type="submit" name="next" id="submit_next" value="Next" class="btn btn-primary">									
<!--											<input type="submit" name="next" id="submit_next" value="Next" class="btn btn-primary">									-->
										<input onclick="return validate_hd()" type="submit" name="confirm" id="submit_confirm" value="Confirm" class="btn btn-primary">
<!--										<input type="submit" name="confirm" id="submit_confirm" value="Confirm" class="btn btn-primary">-->
											<a href="list_hardware.php"><button type="button" val="list_hardware.php" class="jsRedirect btn regCancel" onclick="return cancelfunction()">Cancel</button></a>
											
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