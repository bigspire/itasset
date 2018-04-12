<?php
/* Smarty version 3.1.29, created on 2018-03-26 20:42:41
  from "C:\xampp\htdocs\itassetsvn\itasset\app\webroot\it\templates\edit_hardware_vendor_details.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5ab90de9b23f14_52362177',
  'file_dependency' => 
  array (
    'a1cea67f272eaf9e0fc9c58e03f14f244f488d54' => 
    array (
      0 => 'C:\\xampp\\htdocs\\itassetsvn\\itasset\\app\\webroot\\it\\templates\\edit_hardware_vendor_details.tpl',
      1 => 1522077160,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:include/header.tpl' => 1,
    'file:include/menu.tpl' => 1,
    'file:include/footer.tpl' => 1,
    'file:include/footer_js.tpl' => 1,
  ),
),false)) {
function content_5ab90de9b23f14_52362177 ($_smarty_tpl) {
?>

   
	<?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:include/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
	
	
	<div id="page_wrapper">
<?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:include/menu.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

	
	
	
	
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
							<a href="edit_hardware_vendor_details.php?id=<?php echo $_smarty_tpl->tpl_vars['getid']->value;?>
&inv_id=<?php echo $_smarty_tpl->tpl_vars['invid']->value;?>
">Edit Hardware</a>
						</li>
					</ul>
					
				</div>
				
								
				
					
					<div class="row-fluid  footer_div">
					
					
					<div class="span12">
					
								<form action="edit_hardware_vendor_details.php?id=<?php echo $_smarty_tpl->tpl_vars['getid']->value;?>
&inv_id=<?php echo $_smarty_tpl->tpl_vars['invid']->value;?>
" method="POST" class="form-horizontal form-column form-bordered form-wizard ui-formwizard" enctype="multipart/form-data" id="formID" novalidate="novalidate">
									<div class="step ui-formwizard-content" id="firstStep" style="width:99%;margin-top:20px;">
										<ul class="wizard-steps steps-4">
												<li class="">
												<div class="single-step">
													<span class="title">
														1</span>
													<span class="circle">
													</span>
													<span class="description">
													<a href="edit_hardware_details.php?id=<?php echo $_smarty_tpl->tpl_vars['getid']->value;?>
&inv_id=<?php echo $_smarty_tpl->tpl_vars['invid']->value;?>
">Hardware Details</a> 		
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
													<a href="edit_hardware_inventory_details.php?id=<?php echo $_smarty_tpl->tpl_vars['getid']->value;?>
&inv_id=<?php echo $_smarty_tpl->tpl_vars['invid']->value;?>
">Inventory Details</a> 		
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
													<?php if ($_SESSION['h']['is_rental'] == 'Y') {?>
													<a href="edit_rental_hardware_pricing_details.php?id=<?php echo $_smarty_tpl->tpl_vars['getid']->value;?>
&inv_id=<?php echo $_smarty_tpl->tpl_vars['invid']->value;?>
">Pricing Details</a> 		
													<?php } else { ?>
													<a href="edit_hardware_pricing_details.php?id=<?php echo $_smarty_tpl->tpl_vars['getid']->value;?>
&inv_id=<?php echo $_smarty_tpl->tpl_vars['invid']->value;?>
">Pricing Details</a> 
													<?php }?>						

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
													<a href="edit_hardware_confirmation.php?id=<?php echo $_smarty_tpl->tpl_vars['getid']->value;?>
&inv_id=<?php echo $_smarty_tpl->tpl_vars['invid']->value;?>
">Confirm</a> 		
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
												<input name="vendor_name" class="input-xlarge" placeholder="" type="text" id="company_name" value="<?php echo $_SESSION['h']['vendor_name'];?>
"/> 	
											<div class="errorMsg error"><?php echo $_smarty_tpl->tpl_vars['vendor_nameErr']->value;?>
</div>
											</div>
										</div>
										<div class="control-group">
											<label for="textfield" class="control-label">Email Id </label>
											<div class="controls field">
												<input name="vendor_email" class="input-xlarge" placeholder="" type="text" id="company_email" value="<?php echo $_SESSION['h']['vendor_email'];?>
"/> 	
												<div class="errorMsg error"> <?php echo $_smarty_tpl->tpl_vars['vendor_emailEr']->value;?>
 </div>
											</div>
										</div>
										<div class="control-group">
											<label for="textfield" class="control-label">Contact Number </label>
											<div class="controls field">
												<input name="vendor_phone" class="input-xlarge" placeholder="" type="text" id="contact_number" value="<?php echo $_SESSION['h']['vendor_phone'];?>
"/> 	
											<div class="errorMsg error"><?php echo $_smarty_tpl->tpl_vars['contact_numberE']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['contact_numberEr']->value;?>
</div>
											</div>
										</div>																				
																	
									</div>
									
							

<div class="span6">	
	
   <div class="control-group">
											<label for="textfield" class="control-label">Contact Person </label>
											<div class="controls field">
												<input name="vendor_person" class="input-xlarge" placeholder="" type="text" id="contact_person" value="<?php echo $_SESSION['h']['vendor_person'];?>
"/> 	
											<div class="errorMsg error"><?php echo $_smarty_tpl->tpl_vars['contact_personErr']->value;?>
 </div>
											</div>
										</div>
										<div class="control-group">
											<label for="textfield" class="control-label">City </label>
											<div class="controls field">
												<input name="vendor_city" class="input-xlarge" placeholder="" type="text" id="city" value="<?php echo $_SESSION['h']['vendor_city'];?>
"/> 	
											<div class="errorMsg error"><?php echo $_smarty_tpl->tpl_vars['cityErr']->value;?>
 </div>
											</div>
										</div>
	<div class="control-group">
											<label for="textfield" class="control-label">Address </label>
											<div class="controls field">
													<textarea name="vendor_address" rows="2" class="input-xlarge" placeholder="" cols="30" id="address"><?php echo $_SESSION['h']['vendor_address'];?>
</textarea> 
												<div class="errorMsg error"><?php echo $_smarty_tpl->tpl_vars['addressErr']->value;?>
</div>	
												
											</div>
										</div>
										
										
	

								
</div>


										
										
							<div class="span12">
										<div class="form-actions">
										<input type="submit" id="submit_previous" class="btn" name="previous" value="Previous">
										<input onclick="return validate_hvd()" type="submit" id="submit_next" name="next" value="Next" class="btn btn-primary">
<!--										<input type="submit" id="submit_next" name="next" value="Next" class="btn btn-primary">-->
				
											
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
		
  				<?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:include/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

		
		</div>
	
	<input type="hidden" value="/" id="css_root">


<?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:include/footer_js.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<?php }
}
