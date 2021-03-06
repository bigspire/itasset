<?php
/* Smarty version 3.1.29, created on 2018-04-16 17:03:52
  from "C:\xampp\htdocs\2017\itassetsvn\itasset\app\webroot\it\templates\edit_hardware_details.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5ad48a20207ee6_22670045',
  'file_dependency' => 
  array (
    'e4de8bcb35678f0b1ee0b2b7740e6a69328fb496' => 
    array (
      0 => 'C:\\xampp\\htdocs\\2017\\itassetsvn\\itasset\\app\\webroot\\it\\templates\\edit_hardware_details.tpl',
      1 => 1523876664,
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
function content_5ad48a20207ee6_22670045 ($_smarty_tpl) {
if (!is_callable('smarty_function_html_options')) require_once 'C:\\xampp\\htdocs\\2017\\itassetsvn\\itasset\\app\\webroot\\it\\vendor\\smarty-3.1.29\\libs\\plugins\\function.html_options.php';
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
							<a href="edit_hardware_details.php?id=<?php echo $_smarty_tpl->tpl_vars['getid']->value;?>
&inv_id=<?php echo $_smarty_tpl->tpl_vars['invid']->value;?>
">Edit Hardware</a>
							


						</li>
					</ul>
					
				</div>
				
					<div class="row-fluid  footer_div">
					
					
					<div class="span12">
					
								<form action="edit_hardware_details.php?id=<?php echo $_smarty_tpl->tpl_vars['getid']->value;?>
&inv_id=<?php echo $_smarty_tpl->tpl_vars['invid']->value;?>
" method="POST" class="form-horizontal form-column form-bordered form-wizard ui-formwizard" id="formID" novalidate="novalidate">
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
														<span class="active"></span>
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
								<h3><i class="icon-list"></i> Hardware Details</h3>
							</div>
							
						
							<div class="box-content nopadding">
								
								
									<div class="span6">
									
										<div class="control-group">
											<label for="textfield" class="control-label">Type <span class="red_star"> *</span></label>
											
											<div class="controls field">
											<select name="hardware_type_id" id="hardware_type_id">
										<option value="">Select</option>
									<?php echo smarty_function_html_options(array('class'=>"input-xlarge",'placeholder'=>'','style'=>"clear:left",'id'=>"license_no",'options'=>$_smarty_tpl->tpl_vars['row']->value,'selected'=>$_SESSION['h']['hardware_type_id']),$_smarty_tpl);?>

											</select>
<div class="errorMsg error"><?php echo $_smarty_tpl->tpl_vars['hardware_type_idErr']->value;?>
 </div>
										</div>
										</div>
										<div class="control-group">
		<label for="textfield" class="control-label">Color <span class="red_star"> *</span></label>
			<div class="controls field">
		<input name="color" class="input-xlarge" placeholder="" type="text" id="color" value="<?php echo $_SESSION['h']['color'];?>
"/>
		<div class="errorMsg error"><?php echo $_smarty_tpl->tpl_vars['colorErr']->value;?>
 </div>
			</div>
	</div>
										
										
										
									
								<div class="control-group">
											<label for="password" class="control-label">Description<span class="red_star"></span></label>
											<div class="controls">
									<textarea name="description" rows="2" class="input-xlarge" placeholder="" cols="30" id="description"><?php echo $_SESSION['h']['description'];?>
</textarea> 
											
											<div class="error"><?php echo $_smarty_tpl->tpl_vars['descriptionErr']->value;?>
 </div>
											
												  
											</div>
										</div>
									<div class="control-group">
											<label for="textfield" class="control-label">Status <span class="red_star"> *</span></label>
										<div class="controls field">
									<?php echo smarty_function_html_options(array('name'=>'status','class'=>"input-xlarge",'placeholder'=>'','style'=>"clear:left",'id'=>"status",'options'=>$_smarty_tpl->tpl_vars['login_status']->value,'selected'=>$_SESSION['h']['status']),$_smarty_tpl);?>
	
											<div class="errorMsg error"><?php echo $_smarty_tpl->tpl_vars['statusErr']->value;
echo $_smarty_tpl->tpl_vars['ERROR_MSG']->value;?>
 </div>	
										</div>
										</div>			
									</div>
									
									

									
									

<div class="span6">		
     <div class="control-group">
											<label for="textfield" class="control-label">Brand <span class="red_star"> *</span></label>
											<div class="controls field">
											<select name="it_brand_id" id="it_brand_id">
										<option value="">Select</option>
	<?php echo smarty_function_html_options(array('class'=>"input-xlarge",'placeholder'=>'','style'=>"clear:left",'id'=>"it_brand_id",'options'=>$_smarty_tpl->tpl_vars['hw_brand']->value,'selected'=>$_SESSION['h']['it_brand_id']),$_smarty_tpl);?>

											</select>										
											<div class="errorMsg error"><?php echo $_smarty_tpl->tpl_vars['it_brand_idErr']->value;?>
</div>
											</div>
										</div>
	
										
								
																					<div class="control-group">
											<label for="textfield" class="control-label">Model ID / Name <span class="red_star"> *</span></label>
											<div class="controls field">
										
		<input name="model_id" class="input-xlarge" placeholder="" type="text" id="model_id" value="<?php echo $_SESSION['h']['model_id'];?>
"/> 
<div class="errorMsg error"><?php echo $_smarty_tpl->tpl_vars['model_idErr']->value;
echo $_smarty_tpl->tpl_vars['EXIST_MSG']->value;?>
</div>											
											</div>
										</div>
										<div class="control-group">
											<label for="password" class="control-label">Validity <span class="red_star"> *</span></label>
											<div class="controls field">
<!--											<?php echo smarty_function_html_options(array('name'=>'validity_year','class'=>"input-small",'placeholder'=>'','style'=>"clear:left",'id'=>"subscription_validity",'options'=>$_smarty_tpl->tpl_vars['subscription_validity']->value,'selected'=>$_SESSION['h']['validity_year']),$_smarty_tpl);?>
-->
											
 <input name="validity_from" class="input-medium datepick sValidity" placeholder="Valid From" type="text" id="validity_from" value="<?php echo $_SESSION['h']['validity_from'];?>
"/> 
 <div class="spaError errorMsg error sValidity" style="width:175px;"><?php echo $_smarty_tpl->tpl_vars['validity_fromErr']->value;?>
 </div>								
<input name="validity_to" style="margin-left:5px;" class="input-medium datepick sValidity" placeholder="Valid To" type="text" id="validity_to" value="<?php echo $_SESSION['h']['validity_to'];?>
"/> 
 
<div class=" errorMsg error sValidity" style="margin-left:175px;"><?php echo $_smarty_tpl->tpl_vars['validity_toErr']->value;?>
 </div>
<!--div class="errorMsg error"><?php echo $_smarty_tpl->tpl_vars['validity_yearErr']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['validity_dateErr']->value;?>
</div-->
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
  				<?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:include/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

		</div>
	
	<input type="hidden" value="/" id="css_root">

<?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:include/footer_js.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
