{* Purpose : To add Billing Hardware details.
   Created : Nikitasa
   Date : 18-04-2018 *}
   

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
							<a href="list_billing.php">Billing</a>
								<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="add_billing_hardware_details.php">Add Billing</a>
						</li>
					</ul>
					
				</div>
					<div class="row-fluid  footer_div">
					<div class="span12">
					
								<form action="add_billing_hardware_details.php" method="POST" class="form-horizontal form-column form-bordered form-wizard ui-formwizard" id="formID" novalidate="novalidate">
														
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
									{html_options class="input-xlarge" placeholder="" style="clear:left" id="license_no" options=$billingType selected=$smarty.post.hardware_type_id}
										</select>
									<div class="errorMsg error">{$hardware_type_idErr} </div>
										</div>
										</div>
										<div class="control-group">
		<label for="textfield" class="control-label">Amount <span class="red_star"> *</span></label>
			<div class="controls field">
		<input name="amount" class="input-xlarge" placeholder="" type="text" id="amount" value="{$smarty.post.amount}"/>
		<div class="errorMsg error">{$amountErr} </div>
			</div>
	</div>
										

								
										<div class="control-group">
											<label for="textfield" class="control-label">Payment Type <span class="red_star"> *</span></label>
											
											<div class="controls field">
											<select name="payment_type"  tabindex="3" style="clear:left" id="payment_type" class="input-xlarge change_payment_type">
											<option value="">Select</option>
											{html_options   options=$pay_types selected=$smarty.post.payment_type}	
											</select>
											<div class="errorMsg error">{$payment_typeErr} </div>	
											<input name="payment_details" class="input-xlarge payment_Validity" placeholder="" type="text" id="payment_details" value="{$smarty.post.payment_details}"/> 
										</div>
										</div>
										
										<div class="control-group">
											<label for="password" class="control-label">Description<span class="red_star"></span></span></label>
											<div class="controls">
									<textarea name="description" rows="2" class="input-xlarge" placeholder="" cols="30" id="description">{$smarty.post.description}</textarea> 
											
											
												  
											</div>
										</div>
										
										
									</div>
									
									

									
									

<div class="span6">		
     <div class="control-group">
											<label for="textfield" class="control-label">Inventory No (Brand)

 <span class="red_star"> *</span></label>
											<div class="controls field">
											<select name="it_brand_id" id="it_brand_id">
										<option value="">Select</option>	
	{html_options class="input-xlarge" placeholder="" style="clear:left" id="it_brand_id" options=$hw_brand selected=$smarty.post.it_brand_id}
										</select>											
											<div class="errorMsg error">{$it_brand_idErr}</div>
											</div>
										</div>
	
																				
											<div class="control-group">
											<label for="textfield" class="control-label">Bill Date <span class="red_star"> *</span></label>
											<div class="controls field">
										
		<input name="bill_date" class="input-xlarge datepick" placeholder="" type="text" id="bill_date" value="{$smarty.post.bill_date}"/> 
<div class="errorMsg error">{$bill_dateErr}</div>											
											</div>
										</div>
										<div class="control-group">
											<label for="password" class="control-label">Bill Copy <span class="red_star"> *</span></label>
											<div class="controls field">
 <input name="bill_copy" class="input-medium dpd1 sValidity" placeholder="Valid From" type="file" id="bill_copy" value="{$smarty.post.bill_copy}"/> 										
											<div class="errorMsg error">{$bill_copyErr}</div>
											</div>
										</div>
										<div class="control-group">
											<label for="password" class="control-label">Bill No <span class="red_star"> *</span></label>
											<div class="controls field">
											<input name="bill_no" class="input-xlarge" placeholder="" type="text" id="bill_no" value="{$smarty.post.bill_no}"> 
											<div class="errorMsg error">{$bill_noErr}</div>
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
											<label for="textfield" class="control-label">Company Name  <span class="red_star"> *</span></label>
											
											<div class="controls field">
											<input name="company_name" class="input-xlarge" placeholder="" type="text" id="company_name" value="{$smarty.post.company_name}"/> 
									<div class="errorMsg error">{$company_nameErr} </div>
										</div>
										</div>
										
										

								
										<div class="control-group">
											<label for="textfield" class="control-label">Email Id </label>
											<div class="controls field">
									<input name="email_id" class="input-xlarge" placeholder="" type="text" id="email_id" value="{$smarty.post.email_id}"/> 
										</div>
										</div>
										
										<div class="control-group">
											<label for="password" class="control-label">Contact Number </label>
											<div class="controls">
	<input name="company_contact" class="input-xlarge" placeholder="" type="text" id="company_contact" value="{$smarty.post.company_contact}"/> 
											</div>
										</div>
										
										
									</div>
									
									

									
									

<div class="span6">		
     <div class="control-group">
<label for="textfield" class="control-label">Contact Person
</label>
											<div class="controls field">
											<input name="contact_per" class="input-xlarge" placeholder="" type="text" id="contact_per" value="{$smarty.post.contact_per}"/> 
											</div>
										</div>
	
																				
											<div class="control-group">
											<label for="textfield" class="control-label">City </label>
											<div class="controls field">
										
		<input name="city" class="input-xlarge" placeholder="" type="text" id="city" value="{$smarty.post.city}"/> 										
											</div>
										</div>
										<div class="control-group">
											<label for="password" class="control-label">Address </label>
											<div class="controls field">
									<textarea name="address" rows="2" class="input-xlarge" placeholder="" cols="30" id="address">{$smarty.post.address}</textarea> 
											</div>
										</div>
									
									
									</div>


										
										
							<div class="span12">
										<div class="form-actions">
											<input onclick="return validate_brand()" type="submit" name="submit" value="Submit" class="btn btn-primary">
											<a href="list_billing.php"><button type="button" val="list_billing.php" class="jsRedirect btn regCancel" >Cancel</button></a>
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

{literal}
<script type="text/javascript">

$(document).ready(function(){
	// function to change the amount
	$('.change_payment_type').change(function(){ 
		if($(this).val() == 'other'){
			$('.payment_Validity').show();
		}else{
			$('.payment_Validity').hide();
		}
	});
	
	if($('.change_payment_type').length > 0){
		if($('.change_payment_type:selected').val() == 'other'){
			$('.payment_Validity').show();
		}else{
			$('.payment_Validity').hide();
		}
	}
});
</script>	
{/literal}