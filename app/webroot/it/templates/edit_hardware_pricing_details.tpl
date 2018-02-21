{* Purpose : To add software details.
   Created : Gayathri
   Modified : Nikitasa
   Date : 15-06-2016 *}
   
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
							<a href="edit_hardware_pricing_details.php?id={$getid}&inv_id={$invid}">Edit Hardware</a>
						</li>
					</ul>
					
				</div>
				
								
				
					
					<div class="row-fluid  footer_div">
					
					
					<div class="span12">
					
								<form action="edit_hardware_pricing_details.php?id={$getid}&inv_id={$invid}" method="POST" class="form-horizontal form-column form-bordered form-wizard ui-formwizard" enctype="multipart/form-data" id="formID" novalidate="novalidate">
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
											<li class="active">
												<div class="single-step">
													<span class="title">
														3</span>
													<span class="circle">
													</span>
													<span class="description">
																					Pricing Details 		
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
								<h3><i class="icon-list"></i> Pricing Details</h3>
							</div>
							
						
							<div class="box-content nopadding">
								
								
								
								
								
									<div class="span6">
									
										<div class="control-group">
											<label for="textfield" class="control-label">Amount <span class="red_star"> *</span></label>
											<div class="controls field">
												<input name="amount" class="input-medium" placeholder="" type="text" id="amount" value="{$smarty.session['h'].amount}"/> 	
<div class="spaError errorMsg error" tyle="width:170px;">{$amountErr}{$amountE}</div>
{html_options name=currency_type class="input-small" placeholder="" style="clear:left" id="currency_type" options=$currency_types selected=$smarty.session['h'].currency_type}																								
													
											<div class="errorMsg error"  style="margin-left:170px;">{$currency_typeErr}</div>
											</div>
										</div>
										
										
																					
									<div class="control-group">
											<label for="textfield" class="control-label">Paid By <span class="red_star"> *</span></label>
											<div class="controls field">
		
{html_options name=paid_mode class="input-xlarge" placeholder="" style="clear:left" id="paid_by" options=$paid_modes selected=$smarty.session['h'].paid_mode}	
<div class="errorMsg error">{$paid_byErr}</div>

											</div>
										</div>
	<div class="control-group">
											<label for="password" class="control-label">Bill No<span class="red_star"> *</span></label>
											<div class="controls">
                      					<input name="bill_no" class="input-medium"  type="text" id="bill_no" value="{$smarty.session['h'].bill_no}"/>
											<div class="error">{$bill_noErr}</div>
											</div>
						</div>
								
									</div>
									
							

<div class="span6">		

	<div class="control-group">
											<label for="password" class="control-label">Purchase Date </label>
											<div class="controls field">
												<input name="purchase_date" class="input-medium datepick" placeholder="" type="text" id="purchase_date" value="{$smarty.session['h'].purchase_date}"/>  
											</div>
										</div>

	<div class="control-group">
											<label for="password" class="control-label">Paid Date </label>
											<div class="controls field">
												<input name="paid_date" class="input-medium datepick" placeholder="" type="text" id="paid_date" value="{$smarty.session['h'].paid_date}"/>  
											</div>
										</div>
											<div class="control-group">
											<label for="password" class="control-label">Attach Bill <span class="red_star"> </span></label>
											<div class="controls">
                      				<input type="file" name="attach_bill"  class="upload" id="attach_bill"/>
											<div class="error">{$billuploadErr}</div>
											</div>
						</div>									
								
</div>


										
										
							<div class="span12">
										<div class="form-actions">
										<input type="submit" id="submit_previous" class="btn" name="previous" value="Previous">
											<input onclick="return validate_hpd()" type="submit" id="submit_next" name="next" value="Next" class="btn btn-primary">												
<!--											<input type="submit" id="submit_next" name="next" value="Next" class="btn btn-primary">												-->
											<input onclick="return validate_hpd()" type="submit" id="submit_confirm" name="confirm" value="Confirm" class="btn btn-primary">
<!--											<input type="submit" id="submit_confirm" name="confirm" value="Confirm" class="btn btn-primary">-->
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