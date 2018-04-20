<?php
/* Smarty version 3.1.29, created on 2018-04-19 13:52:06
  from "C:\xampp\htdocs\itassetsvn\itasset\app\webroot\it\templates\add_billing_hardware_details.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5ad851aeb7a4e5_86940175',
  'file_dependency' => 
  array (
    '233a059d2054779b96d3cce69bafca657f445188' => 
    array (
      0 => 'C:\\xampp\\htdocs\\itassetsvn\\itasset\\app\\webroot\\it\\templates\\add_billing_hardware_details.tpl',
      1 => 1524126091,
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
function content_5ad851aeb7a4e5_86940175 ($_smarty_tpl) {
if (!is_callable('smarty_function_html_options')) require_once 'C:\\xampp\\htdocs\\itassetsvn\\itasset\\app\\webroot\\it\\vendor\\smarty-3.1.29\\libs\\plugins\\function.html_options.php';
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
									<?php echo smarty_function_html_options(array('class'=>"input-xlarge",'placeholder'=>'','style'=>"clear:left",'id'=>"license_no",'options'=>$_smarty_tpl->tpl_vars['billingType']->value,'selected'=>$_POST['hardware_type_id']),$_smarty_tpl);?>

										</select>
									<div class="errorMsg error"><?php echo $_smarty_tpl->tpl_vars['hardware_type_idErr']->value;?>
 </div>
										</div>
										</div>
										<div class="control-group">
		<label for="textfield" class="control-label">Amount <span class="red_star"> *</span></label>
			<div class="controls field">
		<input name="amount" class="input-xlarge" placeholder="" type="text" id="amount" value="<?php echo $_POST['amount'];?>
"/>
		<div class="errorMsg error"><?php echo $_smarty_tpl->tpl_vars['amountErr']->value;?>
 </div>
			</div>
	</div>
										

								
										<div class="control-group">
											<label for="textfield" class="control-label">Payment Type <span class="red_star"> *</span></label>
											
											<div class="controls field">
											<select name="payment_type"  tabindex="3" style="clear:left" id="payment_type" class="input-xlarge change_payment_type">
											<option value="">Select</option>
											<?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['pay_types']->value,'selected'=>$_POST['payment_type']),$_smarty_tpl);?>
	
											</select>
											<div class="errorMsg error"><?php echo $_smarty_tpl->tpl_vars['payment_typeErr']->value;?>
 </div>	
											<input name="payment_details" class="input-xlarge payment_Validity" placeholder="" type="text" id="payment_details" value="<?php echo $_POST['payment_details'];?>
"/> 
										</div>
										</div>
										
										<div class="control-group">
											<label for="password" class="control-label">Description<span class="red_star"></span></span></label>
											<div class="controls">
									<textarea name="description" rows="2" class="input-xlarge" placeholder="" cols="30" id="description"><?php echo $_POST['description'];?>
</textarea> 
											
											
												  
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
	<?php echo smarty_function_html_options(array('class'=>"input-xlarge",'placeholder'=>'','style'=>"clear:left",'id'=>"it_brand_id",'options'=>$_smarty_tpl->tpl_vars['hw_brand']->value,'selected'=>$_POST['it_brand_id']),$_smarty_tpl);?>

										</select>											
											<div class="errorMsg error"><?php echo $_smarty_tpl->tpl_vars['it_brand_idErr']->value;?>
</div>
											</div>
										</div>
	
																				
											<div class="control-group">
											<label for="textfield" class="control-label">Bill Date <span class="red_star"> *</span></label>
											<div class="controls field">
										
		<input name="bill_date" class="input-xlarge datepick" placeholder="" type="text" id="bill_date" value="<?php echo $_POST['bill_date'];?>
"/> 
<div class="errorMsg error"><?php echo $_smarty_tpl->tpl_vars['bill_dateErr']->value;?>
</div>											
											</div>
										</div>
										<div class="control-group">
											<label for="password" class="control-label">Bill Copy <span class="red_star"> *</span></label>
											<div class="controls field">
 <input name="bill_copy" class="input-medium dpd1 sValidity" placeholder="Valid From" type="file" id="bill_copy" value="<?php echo $_POST['bill_copy'];?>
"/> 										
											<div class="errorMsg error"><?php echo $_smarty_tpl->tpl_vars['bill_copyErr']->value;?>
</div>
											</div>
										</div>
										<div class="control-group">
											<label for="password" class="control-label">Bill No <span class="red_star"> *</span></label>
											<div class="controls field">
											<input name="bill_no" class="input-xlarge" placeholder="" type="text" id="bill_no" value="<?php echo $_POST['bill_no'];?>
"> 
											<div class="errorMsg error"><?php echo $_smarty_tpl->tpl_vars['bill_noErr']->value;?>
</div>
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
											<input name="company_name" class="input-xlarge" placeholder="" type="text" id="company_name" value="<?php echo $_POST['company_name'];?>
"/> 
									<div class="errorMsg error"><?php echo $_smarty_tpl->tpl_vars['company_nameErr']->value;?>
 </div>
										</div>
										</div>
										
										

								
										<div class="control-group">
											<label for="textfield" class="control-label">Email Id </label>
											<div class="controls field">
									<input name="email_id" class="input-xlarge" placeholder="" type="text" id="email_id" value="<?php echo $_POST['email_id'];?>
"/> 
										</div>
										</div>
										
										<div class="control-group">
											<label for="password" class="control-label">Contact Number </label>
											<div class="controls">
	<input name="company_contact" class="input-xlarge" placeholder="" type="text" id="company_contact" value="<?php echo $_POST['company_contact'];?>
"/> 
											</div>
										</div>
										
										
									</div>
									
									

									
									

<div class="span6">		
     <div class="control-group">
<label for="textfield" class="control-label">Contact Person
</label>
											<div class="controls field">
											<input name="contact_per" class="input-xlarge" placeholder="" type="text" id="contact_per" value="<?php echo $_POST['contact_per'];?>
"/> 
											</div>
										</div>
	
																				
											<div class="control-group">
											<label for="textfield" class="control-label">City </label>
											<div class="controls field">
										
		<input name="city" class="input-xlarge" placeholder="" type="text" id="city" value="<?php echo $_POST['city'];?>
"/> 										
											</div>
										</div>
										<div class="control-group">
											<label for="password" class="control-label">Address </label>
											<div class="controls field">
									<textarea name="address" rows="2" class="input-xlarge" placeholder="" cols="30" id="address"><?php echo $_POST['address'];?>
</textarea> 
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
  				<?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:include/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

		</div>
	<input type="hidden" value="/" id="css_root">
<?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:include/footer_js.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>



<?php echo '<script'; ?>
 type="text/javascript">

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
<?php echo '</script'; ?>
>	
<?php }
}
