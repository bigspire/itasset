<?php
/* Smarty version 3.1.29, created on 2018-03-07 17:32:27
  from "C:\xampp\htdocs\2017\itassetsvn\itasset\app\webroot\it\templates\add_exchange_hw.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5a9fd4d3432352_39321188',
  'file_dependency' => 
  array (
    'ccccdd560fddc5921f513a3c0ee68eaa127ad3d7' => 
    array (
      0 => 'C:\\xampp\\htdocs\\2017\\itassetsvn\\itasset\\app\\webroot\\it\\templates\\add_exchange_hw.tpl',
      1 => 1520424115,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a9fd4d3432352_39321188 ($_smarty_tpl) {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

	<!-- Bootstrap -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="css/font-awesome.min.css">		
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300">	
	<!-- colorbox -->
	<link rel="stylesheet" href="css/plugins/colorbox/colorbox.css">	
	<link rel="stylesheet" href="css/ace.min.css">
	<link rel="stylesheet" href="css/ace-rtl.min.css">
	<link rel="stylesheet" href="css/ace-skins.min.css">
	<?php echo '<script'; ?>
 src="js/ace-extra.min.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="js/jquery.min.js"><?php echo '</script'; ?>
>	
	<!--link rel="stylesheet" media="screen" href="css/plugins/jquery-ui/smoothness/jquery-ui.css"-->	
	<!--script src="js/jquery-ui-1.10.4.custom.min.js"><?php echo '</script'; ?>
-->
	<?php echo '<script'; ?>
 src="js/bootstrap.min.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="js/bootstrap-editable.min.js"><?php echo '</script'; ?>
>	
	<?php echo '<script'; ?>
 src="js/plugins/colorbox/jquery.colorbox-min.js"><?php echo '</script'; ?>
>	
	<?php echo '<script'; ?>
 src="js/jquery.autosize.min.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="js/custom_validation.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="js/validation.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="js/main.js"><?php echo '</script'; ?>
>
</head>

<body>
<div class="">
	<div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">       
          <h4 class="modal-title">Scrap Hardware</h4>
        </div><div class="container"></div>
        <div class="">
		<?php if ($_smarty_tpl->tpl_vars['ALERT_MSG1']->value) {?>
		<div class="alert alert-danger chgError">
											<button type="button" class="close" data-dismiss="alert">
												<i class="icon-remove"></i>
											</button>
											<strong>
												<i class="icon-remove"></i>
											</strong>
											<?php echo $_smarty_tpl->tpl_vars['ALERT_MSG1']->value;?>

											<br>
										</div>
									<?php }?>	
										<?php if ($_smarty_tpl->tpl_vars['ALERT_MSG']->value) {?>
										<div class="alert alert-block alert-success chgSuccess">
											<button type="button" class="close" data-dismiss="alert">
												<i class="icon-remove"></i>
											</button>
											<p><?php echo $_smarty_tpl->tpl_vars['ALERT_MSG']->value;?>
</p>								
										</div>
										<?php }?>
		
<div class="chgReqFrm" align="center">
<div class="" ><div class="" style="display: block;">
		<div class="no-padding">
			<form action="add_exchange_hw.php?id=<?php echo $_GET['id'];?>
&page=<?php echo $_GET['page'];?>
" id="formID"  method="post" accept-charset="utf-8">
									<div class="space-4"></div>
									<div class="space-4"></div>
									<div class="form-group" style="text-align:left">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> Hardware Type <span class="red"> *</span> </label>
										<div class="col-sm-3">
										<input type="radio"  name="hw_type"    <?php if ($_POST['hw_type'] == 'RS') {?> checked="checked" <?php }?> value="RS"> Resale
										<input type="radio"    name="hw_type"  <?php if ($_POST['hw_type'] == 'EX') {?> checked="checked" <?php }?>  value="EX"> Exchange
										<br><div class="errorMsg error"><?php echo $_smarty_tpl->tpl_vars['hw_typeErr']->value;?>
</div>	<br>
										</div>
										
										<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> Exchange/Resale Cost <span class="red"> *</span> </label>
										<div class="col-sm-3">
										<input type="text"  name="cost" value="<?php echo $_POST['cost'];?>
">
										<br><div class="errorMsg error"><?php echo $_smarty_tpl->tpl_vars['costErr']->value;?>
</div>	<br>
										</div>
										
										<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> Payment Type <span class="red"> *</span> </label>
										<div class="col-sm-3">
										<input type="radio"  name="pay_type"    <?php if ($_POST['pay_type'] == 'CQ') {?> checked="checked" <?php }?> value="CQ"> Cheque
										<input type="radio"    name="pay_type"  <?php if ($_POST['pay_type'] == 'CA') {?> checked="checked" <?php }?>  value="CA"> Cash
										<input type="radio"    name="pay_type"  <?php if ($_POST['pay_type'] == 'OT') {?> checked="checked" <?php }?>  value="OT"> Online Transfer
										<input type="radio"    name="pay_type"  <?php if ($_POST['pay_type'] == 'CC') {?> checked="checked" <?php }?>  value="CC"> Credit card
										<br><div class="errorMsg error"><?php echo $_smarty_tpl->tpl_vars['pay_typeErr']->value;?>
</div>	<br>
										</div>
										
										<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> Amount Received  Date <span class="red"> *</span> </label>
										<div class="col-sm-3">
										<input type="text"  name="amt_rcv_date" class="input-small datepick" value="<?php echo $_POST['amt_rcv_date'];?>
">
										<br><div class="errorMsg error"><?php echo $_smarty_tpl->tpl_vars['amt_rcv_dateErr']->value;?>
</div><br>
										</div>

										<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> Description </label>
										<div class="col-sm-3">
										<textarea id="desc" rows="5" cols="45" name="desc"><?php echo $_POST['desc'];?>
</textarea>
										</div>
										
										<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> New Hardware (mandatory for Exchange H/w) 
										<span class="red"> *</span> </label>
										<div class="col-sm-3">
										<input type="text"  name="new_hw"  value="<?php echo $_POST['new_hw'];?>
"> 
										<br><div class="errorMsg error"><?php echo $_smarty_tpl->tpl_vars['new_hwErr']->value;?>
</div>	<br>
										</div>
										<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> Vendor Details (Same as existing form) <span class="red"> *</span> </label>
										<div class="col-sm-3">
										<input type="text"  name="vendor"  value="<?php echo $_POST['vendor'];?>
"> 
										<br><div class="errorMsg error"><?php echo $_smarty_tpl->tpl_vars['vendorErr']->value;?>
</div>	<br>
										</div>
										<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> Bill No <span class="red"> *</span> </label>
										<div class="col-sm-3">
										<input type="text"  name="bill_no"  value="<?php echo $_POST['bill_no'];?>
"> 
										<br><div class="errorMsg error"><?php echo $_smarty_tpl->tpl_vars['bill_noErr']->value;?>
</div>	<br>
										</div>
										<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> Bill Attachment <span class="red"> *</span> </label>
										<div class="col-sm-3">
										<input type="file" name="bill_file" class="upload" id="bill_file"/>
										<br><div class="errorMsg error"><?php echo $_smarty_tpl->tpl_vars['bill_fileErr']->value;?>
</div>	<br>
										</div>
										
									</div>
								
									
									
<div class="space-4"></div>						
<div class="clearfix form-actions">
<div class="col-md-9">
<input class="btn btn-info btn-sm" name="submit" value="Submit" id="btnReq" type="submit"/>
</div>
</div>
					
<input type="hidden" value="list_hardware.php?page=<?php echo $_GET['page'];?>
&status=moved" class="redirect_url">
<input type="hidden" value="list_hardware.php?page=<?php echo $_GET['page'];?>
&status=not_deleted_scrap" class="redirect_url1">
								</form>
						
</div></div>
</div>
        </div>
      </div>
    </div>
</div>
<?php if ($_smarty_tpl->tpl_vars['form_sent']->value == '1') {?>
	 
	<?php echo '<script'; ?>
 type="text/javascript">
	/* redirect to hardware page once hardware moved to scrap successfully */
	self.parent.location.href = jQuery('.redirect_url').val();
	parent.jQuery(".modalCloseImg").click();
	parent.$.colorbox.close();
	<?php echo '</script'; ?>
>
	
<?php } elseif ($_smarty_tpl->tpl_vars['form_sent']->value == '2') {?>
	 
	<?php echo '<script'; ?>
 type="text/javascript">
	/* redirect to hardware page once hardware moved to scrap successfully */
	self.parent.location.href = jQuery('.redirect_url1').val();
	parent.jQuery(".modalCloseImg").click();
	parent.$.colorbox.close();
	<?php echo '</script'; ?>
>
	

<?php }?>


<?php echo '<script'; ?>
 type="text/javascript">
$(".cancel").click(function(){
	parent.$.colorbox.close();
});

$(document).ready(function(){
		/* when the form submitted */
	$('.formID').submit(function(){ 		
		// Disable the 'Next' button to prevent multiple clicks		
		$('input[type=submit]', this).attr('value', 'Processing...');		
		$('input[type=submit]', this).attr('disabled', 'disabled');
		// hide cancel button
		$('button[type=button]', this).hide();
		$('.cancelBtn').hide();
		
	});
});
<?php echo '</script'; ?>
>	

</body>
</html><?php }
}
