<?php
/* Smarty version 3.1.29, created on 2018-04-17 15:01:48
  from "C:\xampp\htdocs\2017\itassetsvn\itasset\app\webroot\it\templates\fr_asset_change_user.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5ad5bf043e18e8_19796363',
  'file_dependency' => 
  array (
    '7e81bb53e0762a552fc8cf739d956985c396d2df' => 
    array (
      0 => 'C:\\xampp\\htdocs\\2017\\itassetsvn\\itasset\\app\\webroot\\it\\templates\\fr_asset_change_user.tpl',
      1 => 1519292829,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5ad5bf043e18e8_19796363 ($_smarty_tpl) {
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
       
          <h4 class="modal-title">Change Asset</h4>
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

											<p>
												
												<?php echo $_smarty_tpl->tpl_vars['ALERT_MSG']->value;?>

											</p>
									
											
										</div>
										<?php }?>
		
				 <div class="chgReqFrm" align="center">
		
<div class="" ><div class="" style="display: block;">
												<div class="no-padding">
											
<?php if (!$_smarty_tpl->tpl_vars['ALERT_MSG']->value && !$_smarty_tpl->tpl_vars['ALERT_MSG1']->value) {?>
			<form action="fr_asset_change_user.php?type=<?php echo $_smarty_tpl->tpl_vars['get_type']->value;?>
" id="formID"  method="post" accept-charset="utf-8">
									<div class="space-4"></div>
									
									

									<div class="space-4"></div>
									<div class="form-group" style="text-align:left">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> Message <span class="red"> *</span> </label>

										<div class="col-sm-3">
											<textarea id="message" rows="5" cols="45" name="message"><?php echo $_smarty_tpl->tpl_vars['message']->value;?>
</textarea>
											<div class="errorMsg error error0"><?php echo $_smarty_tpl->tpl_vars['messageErr']->value;?>
</div>
										
										</div>
									</div>
									
<div class="space-4"></div>
									
									
									
									
<div class="clearfix form-actions">
<input type="hidden" id="" value="<?php echo $_GET['id'];?>
" name="sw_id">
<input type="hidden" id="" value="<?php echo $_GET['inv_id'];?>
" name="hw_id">
<input type="hidden" id="change_req" value="submit" name="submit">
										<div class="col-md-9">
											<input  onclick="return validate_change_asset_user()" rel="PE" class="btn btn-info btn-sm" name="sub" value="Submit" id="btnReq" type="submit"/>
										</div>
									</div>
									
									
									
									
									<input type="hidden" value="PE" id="type">
								</form>
								<?php }?>
									</div><!-- /widget-main -->
											</div></div>
									</div>
        
		
        </div>
       
      </div>
    </div>
</div>
</body>
<?php if ($_smarty_tpl->tpl_vars['form_sent']->value == '1') {?>
	 
	<?php echo '<script'; ?>
 type="text/javascript">
	$(document).ready(function(){
		window.parent.$('#fr_home').val('success');
	});
	<?php echo '</script'; ?>
>
	
<?php }?>
</html><?php }
}
