{* Purpose : To add Software details.
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
						<h1>Create Software</h1>
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
							<a href="add_software_vendor_details.php">Add Software</a>
						</li>
					</ul>
					
				</div>
				
								
				
					
					<div class="row-fluid  footer_div">
					
					
					<div class="span12">
					
								<form action="add_software_vendor_details.php" method="POST" class="form-column form-bordered  form-horizontal form-wizard ui-formwizard" id="formID" novalidate="novalidate">
									<div class="step ui-formwizard-content" id="firstStep" style="width:99%;margin-top:20px;">
										<ul class="wizard-steps steps-4">
												<li class="">
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
													</span>
													<span class="description">
																					Pricing Details 		
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
																						Vendor Details 		
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
																						Confirm 		
																				</span>
												</div>
											</li>
																					</ul>
									</div>
								
							
									
						<div class="box">
							<div class="box-title">
								<h3><i class="icon-list"></i> Vendor Details</h3>
							</div>
							
						
							<div class="box-content nopadding">

								
									<div class="span6">
									
										<div class="control-group">
											<label for="textfield" class="control-label">Company Name <span class="red_star"> *</span></label>
											<div class="controls field">
												<input name="company_name" class="input-xlarge" placeholder="" type="text" id="company_name" value="{$smarty.session['s'].company_name}"/> 	
											<a href="company_details.php?type=S" class="iframeBox unreadLink" val="70_80">Choose Vendor</a>
											<div class="errorMsg error">{$company_nameErr}</div>
											</div>
										</div>
										<div class="control-group">
											<label for="textfield" class="control-label">Email Id </label>
											<div class="controls field">
												<input name="company_email" class="input-xlarge" placeholder="" type="text" id="company_email" value="{$smarty.session['s'].company_email}"/> 	
											<div class="errorMsg error"> {$company_emailEr} </div>
											</div>
										</div>
										<div class="control-group">
											<label for="textfield" class="control-label">Contact Number </label>
											<div class="controls field">
												<input name="contact_number" class="input-xlarge" placeholder="" type="text" id="contact_number" value="{$smarty.session['s'].contact_number}"/> 	
										<div class="errorMsg error"> {$contact_numberE} {$contact_numberEr}</div>
											</div>
										</div>																							
									</div>
									
							

<div class="span6">	
	
   <div class="control-group">
											<label for="textfield" class="control-label">Contact Person </label>
											<div class="controls field">
												<input name="contact_person" class="input-xlarge" placeholder="" type="text" id="contact_person" value="{$smarty.session['s'].contact_person}"/> 	
											</div>
										</div>
							    	<div class="control-group">
											<label for="textfield" class="control-label">City  </label>
											<div class="controls field">
												<input name="city" class="input-xlarge" placeholder="" type="text" id="city" value="{$smarty.session['s'].city}"/> 	
											</div>
										</div>
	<div class="control-group">
											<label for="textfield" class="control-label">Address </label>
											<div class="controls field">
													<textarea name="address" rows="2" class="input-xlarge" placeholder="" cols="30" id="address">{$smarty.session['s'].address}</textarea> 
												
											</div>
										</div>
										
										
	

								
</div>


										
										
							<div class="span12">
										<div class="form-actions">
										<input  type="submit" id="submit_previous" class="btn" name="previous" value="Previous">
										<input onclick="return validate_vd()" type="submit" name="next" id="submit_next"  value="Next" class="btn btn-primary">
<!--										<input type="submit" name="next" id="submit_next"  value="Next" class="btn btn-primary">-->
				
											
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

