<?php
/* Smarty version 3.1.29, created on 2017-12-15 16:44:14
  from "/var/www/html/ceo_apps_it/app/webroot/it/templates/edit_hardware_confirmation.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5a33ae86d4f4b3_05566723',
  'file_dependency' => 
  array (
    '4aaabc73c6e18c6b7dc6a3d90db5fd02aff92bb6' => 
    array (
      0 => '/var/www/html/ceo_apps_it/app/webroot/it/templates/edit_hardware_confirmation.tpl',
      1 => 1513336413,
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
function content_5a33ae86d4f4b3_05566723 ($_smarty_tpl) {
?>

   
	<?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:include/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
	
	<div id="page_wrapper">
<?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:include/menu.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

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
							<a href="edit_hardware_confirmation.php?id=<?php echo $_smarty_tpl->tpl_vars['getid']->value;?>
&inv_id=<?php echo $_smarty_tpl->tpl_vars['invid']->value;?>
">Edit Hardware</a>
						</li>
					</ul>
					
				</div>
				
								
				
					
					<div class="row-fluid  footer_div">
					
					
					<div class="span12">
					
								<form action="edit_hardware_confirmation.php?id=<?php echo $_smarty_tpl->tpl_vars['getid']->value;?>
&inv_id=<?php echo $_smarty_tpl->tpl_vars['invid']->value;?>
" method="POST" class="form-horizontal form-column form-bordered form-wizard ui-formwizard" id="formID" novalidate="novalidate">
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
													<a href="edit_hardware_pricing_details.php?id=<?php echo $_smarty_tpl->tpl_vars['getid']->value;?>
&inv_id=<?php echo $_smarty_tpl->tpl_vars['invid']->value;?>
">Pricing Details</a> 		
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
													<a href="edit_hardware_vendor_details.php?id=<?php echo $_smarty_tpl->tpl_vars['getid']->value;?>
&inv_id=<?php echo $_smarty_tpl->tpl_vars['invid']->value;?>
">Vendor Details</a> 		
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
	                            <?php echo ucfirst($_SESSION['h']['hardware_type']);?>

										</div>
										</div>
										
										<div class="control-group">
											<label for="textfield" class="control-label">Color </label>
											<div class="controls">
											<?php echo ucfirst($_SESSION['h']['color']);?>

													</div>
										</div>
										
									
										<div class="control-group">
											<label for="password" class="control-label">Description</label>
											<div class="controls">
												<?php echo $_SESSION['h']['description'];?>

										</div>
										</div>
								<div class="control-group">
											<label for="textfield" class="control-label">Status </label>
											 
											<div class="controls">
                                 <?php if ($_SESSION['h']['status'] == 1) {?>
                                   Active
                                   <?php } else { ?>
                                   Inactive
                                   <?php }?>
											</div>
										</div>
									</div>
									
								

<div class="span6">	

										<div class="control-group">
											<label for="textfield" class="control-label">Brand </label>
											<div class="controls">
										<?php echo ucfirst($_SESSION['h']['brand_name']);?>

													</div>
										</div>
										
												<div class="control-group">
											<label for="textfield" class="control-label">Model ID / Name </label>
											<div class="controls">
											<?php echo $_SESSION['h']['model_id'];?>

											</div>
										</div>
										<div class="control-group">
										<label for="textfield" class="control-label">Subscription validity   </label>
											<div class="controls">
											<?php if (!empty($_SESSION['h']['validityfrom'])) {?>
											<?php echo $_SESSION['h']['validityfrom'];?>
 - <?php echo $_SESSION['h']['validityto'];?>
 
											<?php } else { ?>
											Nil	
											<?php }?>										
											</div>
									</div>
										
										
									
										
							
										
									</div>

								
							</div>
						</div>
				


							
						<div class="box">
							<div class="box-title">
								<h3><i class="icon-list"></i> Inventory Details</h3>
								</div>
							<?php
$_smarty_tpl->tpl_vars['foo'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['foo']->step = 1;$_smarty_tpl->tpl_vars['foo']->total = (int) ceil(($_smarty_tpl->tpl_vars['foo']->step > 0 ? $_SESSION['h']['invcount']-1+1 - (0) : 0-($_SESSION['h']['invcount']-1)+1)/abs($_smarty_tpl->tpl_vars['foo']->step));
if ($_smarty_tpl->tpl_vars['foo']->total > 0) {
for ($_smarty_tpl->tpl_vars['foo']->value = 0, $_smarty_tpl->tpl_vars['foo']->iteration = 1;$_smarty_tpl->tpl_vars['foo']->iteration <= $_smarty_tpl->tpl_vars['foo']->total;$_smarty_tpl->tpl_vars['foo']->value += $_smarty_tpl->tpl_vars['foo']->step, $_smarty_tpl->tpl_vars['foo']->iteration++) {
$_smarty_tpl->tpl_vars['foo']->first = $_smarty_tpl->tpl_vars['foo']->iteration == 1;$_smarty_tpl->tpl_vars['foo']->last = $_smarty_tpl->tpl_vars['foo']->iteration == $_smarty_tpl->tpl_vars['foo']->total;?>		
						
							<div class="box-content nopadding">
											<div class="span6">
									
													
										<div class="control-group">
											<label for="textfield" class="control-label">Inventory No </label>
											<div class="controls">
										    <?php echo $_SESSION['h'][$_smarty_tpl->tpl_vars['foo']->value]['inventory_no'];?>

												</div>
										</div>
											<div class="control-group">
											<label for="textfield" class="control-label">Location </label>
											<div class="controls">
												<?php echo $_SESSION['h'][$_smarty_tpl->tpl_vars['foo']->value]['district_name'];?>
 ( <?php echo $_SESSION['h'][$_smarty_tpl->tpl_vars['foo']->value]['state_name'];?>
 )
													</div>
										</div>
														
																				<div class="control-group"></div>									
		
										
		</div>
									
									
						
									

									<div class="span6">	
<div class="control-group">
											<label for="password" class="control-label">Serial Number </label>
											<div class="controls">
											<?php echo $_SESSION['h'][$_smarty_tpl->tpl_vars['foo']->value]['serial_no'];?>

										</div>
										</div>
									<div class="control-group">
											<label for="textfield" class="control-label">Asset Description </label>
											<div class="controls">
										<?php echo $_SESSION['h'][$_smarty_tpl->tpl_vars['foo']->value]['asset_desc'];?>

											</div>
										</div>								
																		
										<div class="control-group"></div>
										
									</div>
						</div>
						<?php }
}
?>

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
										<?php echo $_SESSION['h']['currencytype'];?>
	<?php echo $_SESSION['h']['amount'];?>
 
													</div>
										</div>
										
										
																					
									<div class="control-group">
											<label for="textfield" class="control-label">Paid By </label>
											<div class="controls">
											<?php echo $_SESSION['h']['paidby'];?>

												</div>
										</div>
									
     	<div class="control-group">
											<label for="password" class="control-label">Bill No</label> </label>
											<div class="controls">
											<?php echo $_SESSION['h']['bill_no'];?>

												</div>
						</div>
									</div>
									
								
									<div class="span6">									

	<div class="control-group">
											<label for="password" class="control-label">Purchase Date</label> </label>
											<div class="controls">
											<?php echo $_SESSION['h']['purchasedate'];?>

											</div>
										</div>
		<div class="control-group">
											<label for="password" class="control-label">Paid Date</label> </label>
											<div class="controls">
											<?php echo $_SESSION['h']['paiddate'];?>

											</div>
										</div>									
										<div class="control-group">
											<label for="password" class="control-label">Attach Bill</label> </label>
											<div class="controls">
												<?php if (!empty($_SESSION['h']['billfile_edit'])) {?>
												<a href = "edit_hardware_confirmation.php?id=<?php echo $_GET['id'];?>
&action=download&file=<?php echo $_SESSION['h']['billfile_edit'];?>
 "><?php echo $_SESSION['h']['billfile_edit'];?>
 </a>
												<?php } else { ?> 
												<a href = "edit_hardware_confirmation.php?id=<?php echo $_GET['id'];?>
&action=download&file=<?php echo $_SESSION['h']['bill'];?>
 "><?php echo $_SESSION['h']['bill'];?>
 </a> 
											<?php }?>	
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
								
								
								
					
												
																<div class="span6" style="">
				<div class="control-group">
											<label for="textfield" class="control-label">Company Name</label>
											<div class="controls">
											<?php echo $_SESSION['h']['vendor_name'];?>

													</div>
										</div>
									<div class="control-group">
											<label for="textfield" class="control-label">Email Id </label>
											<div class="controls">
											<?php echo $_SESSION['h']['vendor_email'];?>

													</div>
										</div>	
										<div class="control-group">
											<label for="textfield" class="control-label">Contact Number</label>
											<div class="controls">
											<?php echo $_SESSION['h']['vendor_phone'];?>

											</div>
										</div>																												
									</div>
									
									
									<div class="span6">									
	
   <div class="control-group">
											<label for="textfield" class="control-label">Contact Person </label>
											<div class="controls">
											<?php echo $_SESSION['h']['vendor_person'];?>
	
											</div>
										</div>
										<div class="control-group">
											<label for="textfield" class="control-label">City </label>
											<div class="controls">
											<?php echo $_SESSION['h']['vendor_city'];?>
 	
											</div>
										</div>	
	<div class="control-group">
											<label for="textfield" class="control-label">Address </label>
											<div class="controls">
											<?php echo $_SESSION['h']['vendor_address'];?>
																						
											</div>
										</div>
										
								
									</div>
					
							
										
							<div class="span12">
										<div class="form-actions">
										<a href="edit_hardware_vendor_details.php?id=<?php echo $_smarty_tpl->tpl_vars['getid']->value;?>
&inv_id=<?php echo $_smarty_tpl->tpl_vars['invid']->value;?>
"><button type="button" val="edit_hardware_vendor_details.php?id=<?php echo $_smarty_tpl->tpl_vars['getid']->value;?>
&inv_id=<?php echo $_smarty_tpl->tpl_vars['invid']->value;?>
" id="submit_previous" class="jsRedirect btn"><i class="icon-arrow-left"></i> Previous</button></a>
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
		
			
  				<?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:include/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

		
		</div>
	
	<input type="hidden" value="/" id="css_root">


<?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:include/footer_js.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<?php }
}
