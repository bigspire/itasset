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
							<a href="add_software_inventory_details.php">Add Software</a>
						</li>
					</ul>
					
				</div>
				
								
				
					
					<div class="row-fluid  footer_div">
					
					
					<div class="span12">
					
								<form action="add_software_details.php" method="POST" class="form-horizontal form-column form-bordered form-wizard ui-formwizard" enctype="multipart/form-data" id="formID" novalidate="novalidate">
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
										
											
				<li class="active">
												<div class="single-step">
													<span class="title">
														2</span>
													<span class="circle">
														<span class="active"></span>
													</span>
													<span class="description">
																						Inventory Details 		
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
																						Vendor Details	
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
																						Confirm 		
																				</span>
												</div>
											</li>
																					</ul>
									</div>
								
								
						<div class="box">
							<div class="box-title">
								<h3><i class="icon-list"></i> Inventory Details</h3>
							</div>
							
						
							<div class="box-content nopadding">
								
								
								
								
								
									<div class="span6">
									
			
										
										
										<div class="control-group">
											<label for="textfield" class="control-label">Inventory No <span class="red_star"> *</span></label>
											<div class="controls">
										<input name="inventory_no" class="input-xlarge" placeholder="" type="text" id="inventory_no" value="{$inventory_no}"/> 
											<div class="error">{$inventory_noErr}</div>
											</div>
										</div>
										
										
											<div class="control-group">
											<label for="textfield" class="control-label">Asset Description <span class="red_star"> *</span></label>
											<div class="controls">
											<textarea name="asset_description" rows="2" class="input-xlarge" placeholder="" cols="30" id="asset_description">{$asset_description}</textarea> 
											<div class="error">{$asset_descriptionErr}</div>
											</div>
										</div>
								
										
		
	</div>

<div class="span6">		

	<div class="control-group">
											<label for="textfield" class="control-label">Location <span class="red_star"> *</span></label>
											<div class="controls">
												<input name="location" class="input-xlarge datepick" placeholder="" type="text" id="location" value="{$location}"/>
											<div class="error">{$locationErr} </div>
											</div>
										</div>
									<div class="control-group">
											<label for="textfield" class="control-label">Cost Centre <span class="red_star"></label>
											<div class="controls">
										<input name="cost_centre" class="input-xlarge" placeholder="" type="text" id="cost_centre" value="{$cost_centre}"/> 
											<div class="error">{$cost_centreErr}</div>
											</div>
										</div>
										
										
					</div>

										
										
							<div class="span12">
										<div class="form-actions">
										<a href="add_software_details.php"><button type="button" val="add_software_details.php" class="jsRedirect btn"><i class="icon-arrow-left"></i> Previous</button></a>
												<input type="submit" name="next" value="Next" class="btn btn-primary">
				
											
											<a href="list_software.html"><button type="button" val="list_software.html" class="jsRedirect btn regCancel" onclick="return cancelfunction()">Cancel</button></a>
											
										</div>
									</div>	
								
							</div>
						</div>
			</div>
					<input type="hidden" name="data[HrEmployee][rem_photo]" id="rem_photo">
					<input type="hidden" name="data[HrEmployee][reg_confirm]" id="reg_confirm">
					<input type="hidden" id="new_user" value="1">
					<input type="hidden" id="webroot" value="/">
					
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

