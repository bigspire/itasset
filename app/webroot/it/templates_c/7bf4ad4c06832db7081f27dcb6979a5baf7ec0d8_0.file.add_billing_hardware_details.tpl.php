<?php
/* Smarty version 3.1.29, created on 2018-04-20 16:28:58
  from "C:\xampp\htdocs\2017\itassetsvn\itasset\app\webroot\it\templates\add_billing_hardware_details.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5ad9c7f27989d5_99756935',
  'file_dependency' => 
  array (
    '7bf4ad4c06832db7081f27dcb6979a5baf7ec0d8' => 
    array (
      0 => 'C:\\xampp\\htdocs\\2017\\itassetsvn\\itasset\\app\\webroot\\it\\templates\\add_billing_hardware_details.tpl',
      1 => 1524221933,
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
function content_5ad9c7f27989d5_99756935 ($_smarty_tpl) {
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
					<?php if ($_smarty_tpl->tpl_vars['EXIST_MSG']->value) {?>
				<div id="flashMessage" class="alert alert-danger">
				<button type="button" class="close" data-dismiss="alert">&#x2A2F;</button><?php echo $_smarty_tpl->tpl_vars['EXIST_MSG']->value;?>
</div>					
				<?php }?>
								<form  enctype= "multipart/form-data" method="POST" class="form-horizontal form-column form-bordered form-wizard ui-formwizard" id="formID" novalidate="novalidate">
														
						<div class="box">
							<div class="box-title">
								<h3><i class="icon-list"></i> Hardware Details</h3>
							</div>
							<div class="box-content nopadding">
									<div class="span6">
										<div class="control-group">
											<label for="textfield" class="control-label">Type <span class="red_star"> *</span></label>
											
											<div class="controls field">
											<select name="hardware_type_id" class="hwtype" id="hardware_type_id">
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
											<select name="payment_type"  tabindex="3"  id="payment_type" class="input-medium change_payment_type">
											<option value="">Select</option>
											<?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['pay_types']->value,'selected'=>$_POST['payment_type']),$_smarty_tpl);?>
	
											</select>
											<div class="spaError errorMsg error"> <?php echo $_smarty_tpl->tpl_vars['payment_typeErr']->value;?>
</div>
												<input name="payment_details" style="clear:left" class="input-large payment_Validity" placeholder="Other Payment Type" type="text" id="payment_details" value="<?php echo $_POST['payment_details'];?>
"/> 
													<div class="spaError errorMsg error"> <?php echo $_smarty_tpl->tpl_vars['payment_detailsErr']->value;?>
</div>
													
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
											<select name="it_brand_id" id="inventory" class="inventory">
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
											<input name="bill_copy" class="upload" type="file" id="bill_copy"> 										
											<div class="errorMsg error"><?php echo $_smarty_tpl->tpl_vars['attachmentuploadErr']->value;
echo $_smarty_tpl->tpl_vars['bill_copyErr']->value;?>
</div>
											</div>
										</div>
										<div class="control-group">
											<label for="password" class="control-label">Bill No <span class="red_star"> *</span></label>
											<div class="controls field">
											<input name="bill_no" class="input-xlarge" placeholder="" type="text" id="bill_no" value="<?php echo $_POST['bill_no'];?>
"/> 
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
											<a href="company_details.php?type=H" class="iframeBox unreadLink" val="70_80">Choose Vendor</a>
									<div class="errorMsg error"><?php echo $_smarty_tpl->tpl_vars['company_nameErr']->value;?>
 </div>
										</div>
										</div>
										
										

								
										<div class="control-group">
											<label for="textfield" class="control-label">Email Id </label>
											<div class="controls field">
									<input name="email_id" class="input-xlarge" placeholder="" type="text" id="company_email" value="<?php echo $_POST['email_id'];?>
"/> 
										</div>
										</div>
										
										<div class="control-group">
											<label for="password" class="control-label">Contact Number </label>
											<div class="controls">
	<input name="company_contact" class="input-xlarge" placeholder="" type="text" id="contact_number" value="<?php echo $_POST['company_contact'];?>
"/> 
											</div>
										</div>
										
										
									</div>

<div class="span6">		
     <div class="control-group">
<label for="textfield" class="control-label">Contact Person
</label>
											<div class="controls field">
											<input name="contact_per" class="input-xlarge" placeholder="" type="text" id="contact_person" value="<?php echo $_POST['contact_per'];?>
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

$(document).ready(function(){
	// fetch the inventory and brand details
    $(".hwtype").change(function (){
		var type_id = $(this).val();
	    var type_name = $(this).attr('id').split('_');			
		$.ajax({
			url : "get_billing_inventory.php",
			method : "GET",
			dataType: "json",
			data : {hwtype : type_id},
			encode  : false
		})
		.done(function (data){
			var div_data = '<option value="">Select</option>';
			$.each(data,function (a,y){ 
				div_data +=  "<option value="+a+">"+y+"</option>";
			});
			$('#inventory').empty();
			$('#inventory').html(div_data); 
		});
	});	
});	
<?php echo '</script'; ?>
>	
<?php }
}
