<?php
/* Smarty version 3.1.29, created on 2018-03-26 12:55:28
  from "C:\xampp\htdocs\itassetsvn\itasset\app\webroot\it\templates\remarks.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5ab8a068cdafc2_58522691',
  'file_dependency' => 
  array (
    '3e53be30c09017a572e0421567415d424483ea08' => 
    array (
      0 => 'C:\\xampp\\htdocs\\itassetsvn\\itasset\\app\\webroot\\it\\templates\\remarks.tpl',
      1 => 1522049085,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5ab8a068cdafc2_58522691 ($_smarty_tpl) {
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
          <h4 class="modal-title">Remarks</h4>
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
			<form action="remarks.php?scrap_id=<?php echo $_GET['scrap_id'];?>
&user_id=<?php echo $_SESSION['user_id'];?>
&page=<?php echo $_GET['page'];?>
&action=<?php echo $_GET['action'];?>
&inv_id=<?php echo $_GET['inv_id'];?>
" id="formID"  method="post" accept-charset="utf-8">
									<div class="space-4"></div>
									<div class="form-group" style="text-align:left">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> Remarks 
										<?php if ($_GET['action'] == 'reject') {?>
										<span class="red"> *</span>
										<?php }?>
										 </label>
										<div class="col-sm-3">
											<textarea id="remarks" rows="5" cols="45" name="remarks"><?php if ($_POST['remarks']) {
echo $_POST['remarks'];
}?></textarea>
											<div class="errorMsg error"><?php echo $_smarty_tpl->tpl_vars['remarksErr']->value;?>
</div>	
										</div>
									</div>												
<div class="clearfix form-actions">
<div class="col-md-9">
<input class="btn btn-info btn-sm" name="Submit" value="Submit" id="btnReq" type="submit"/>
</div>
</div>
					
<input type="hidden" value="list_approve_scrap_hardware.php?page=<?php echo $_GET['page'];?>
&status=Approved" class="redirect_url">
<input type="hidden" value="list_approve_scrap_hardware.php?page=<?php echo $_GET['page'];?>
&status=Rejected" class="redirect_url1">
<input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['user_id']->value;?>
" name="user_id" class="redirect_url1">
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
