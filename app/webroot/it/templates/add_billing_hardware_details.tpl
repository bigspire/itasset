{* Purpose : To add software details.
   Created : Gayathri
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
						<h1>Create Biling</h1>
					</div>
					
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="dashboard.php">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="list_billing.php">Hardware</a>
								<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="add_billing_hardware_details.php">Add Billing</a>
						</li>
					</ul>
					
				</div>
					<div class="row-fluid  footer_div">
					<div class="span12">
					
								<form action="add_hardware_details.php" method="POST" class="form-horizontal form-column form-bordered form-wizard ui-formwizard" id="formID" novalidate="novalidate">
														
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
									{html_options class="input-xlarge" placeholder="" style="clear:left" id="license_no" options=$billingType selected=$smarty.session['h'].hardware_type_id}
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
											<label for="password" class="control-label">Description<span class="red_star"></span></span></label>
											<div class="controls">
									<textarea name="description" rows="2" class="input-xlarge" placeholder="" cols="30" id="description">{$smarty.session['h'].description}</textarea> 
											
											
												  
											</div>
										</div>
										<div class="control-group">
											<label for="textfield" class="control-label">Status <span class="red_star"> *</span></label>
											
											<div class="controls field">
									{html_options name=status class="input-xlarge" placeholder="" style="clear:left" id="status" options=$login_status selected=$smarty.session['h'].status}	
											<div class="errorMsg error">{$statusErr} </div>	
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
											<label for="password" class="control-label">Subscription Validity <span class="red_star"> *</span></label>
											<div class="controls field">
<!--											{html_options name=subscription_validity class="input-small" placeholder="" style="clear:left" id="subscription_validity" options=$subscription_validity selected=$smarty.session['h'].subscription_validity}-->
											
 <input name="validity_from" class="input-medium datepick dpd1 sValidity" placeholder="Valid From" type="text" id="validity_from" value="{$smarty.session['h'].validity_from}"/> 										
<div class="spaError errorMsg error sValidity" style="width:175px;">{$validity_fromErr}</div> 											
 <input name="validity_to" class="input-medium datepick dpd2 sValidity" style="margin-left:5px;"  placeholder="Valid To" type="text" id="validity_to" value="{$smarty.session['h'].validity_to}"/> 
 <div class="errorMsg error sValidity" style="margin-left:175px;">{$validity_toErr} </div>

 
 
											<div class="errorMsg error">{$subscription_validityErr} {$valid_tillErr}</div>
											</div>
										</div>
									
									
									</div>


										
										
							<div class="span12">
										<div class="form-actions">
											<input onclick="return validate_hd()" type="submit" name="next" id="submit_next" value="Next" class="btn btn-primary">
<!--											<input type="submit" name="next" id="submit_next" value="Next" class="btn btn-primary">-->
											{if !empty ($smarty.session['h'].confirm_add)}  											
											<input onclick="return validate_hd()" type="submit" name="confirm" id="submit_confirm" value="Confirm" class="btn btn-primary">
<!--											<input type="submit" name="confirm" id="submit_confirm" value="Confirm" class="btn btn-primary">-->
											{/if}
											<a href="list_hardware.php"><button type="button" val="list_hardware.php" class="jsRedirect btn regCancel"  onclick="return cancelfunction()" >Cancel</button></a>
											
										</div>
									</div>	
								
							</div>
						</div>
						
						
						
						</div>
					<input type="hidden" id="next_hdn" name="next_hdn">
					<input type="hidden" id="confirm_hdn" name="confirm_hdn">
					
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