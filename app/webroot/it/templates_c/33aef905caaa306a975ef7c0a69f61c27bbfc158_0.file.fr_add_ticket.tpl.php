<?php
/* Smarty version 3.1.29, created on 2018-03-08 18:56:12
  from "C:\xampp\htdocs\itassetsvn\itasset\app\webroot\it\templates\fr_add_ticket.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5aa139f47bd7d0_40585270',
  'file_dependency' => 
  array (
    '33aef905caaa306a975ef7c0a69f61c27bbfc158' => 
    array (
      0 => 'C:\\xampp\\htdocs\\itassetsvn\\itasset\\app\\webroot\\it\\templates\\fr_add_ticket.tpl',
      1 => 1488890426,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5aa139f47bd7d0_40585270 ($_smarty_tpl) {
if (!is_callable('smarty_function_html_options')) require_once 'C:\\xampp\\htdocs\\itassetsvn\\itasset\\app\\webroot\\it\\vendor\\smarty-3.1.29\\libs\\plugins\\function.html_options.php';
?>

   
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
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
	<?php echo '<script'; ?>
 src="js/main.js"><?php echo '</script'; ?>
>

	
	<!--script src="js/jquery-ui-1.10.4.custom.min.js"><?php echo '</script'; ?>
-->
	<?php echo '<script'; ?>
 src="js/bootstrap.min.js"><?php echo '</script'; ?>
>
	
	
	
	<?php echo '<script'; ?>
 src="js/custom_validation.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="js/validation.js"><?php echo '</script'; ?>
>
	
	<style>
	.form-group {
		margin-bottom: 6px;
	}
	</style>
	

	
	


	</head>
	<body>


<div class="">
	<div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
       
          <h4 class="modal-title">Create Ticket</h4>
        </div><div class="container"></div>
        <div class="">
									<?php if ($_smarty_tpl->tpl_vars['ALERT_MSG1']->value) {?>
										<div class="alert alert-danger chgError">
											<button type="button" class="close" data-dismiss="alert">
												<i class="icon-remove"></i>
											</button>

											<strong>
												<i class="icon-remove"></i>
												Oops!
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
											
<?php if (!$_smarty_tpl->tpl_vars['ALERT_MSG1']->value && !$_smarty_tpl->tpl_vars['ALERT_MSG']->value) {?>
			<form action="fr_add_ticket.php" id="formID" enctype= "multipart/form-data" method="post" accept-charset="utf-8">
									

									<div class="space-4"></div>
									<input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id'];?>
" style="width:300px;">
									<div class="form-group" style="clear:left;text-align:left">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> Priority <span class="red"> *</span></label>

										<div class="col-sm-3">
										<select name='priority' class="input-medium" style="width:300px;" id="priority">
											<?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['priority_type']->value,'selected'=>$_POST['priority']),$_smarty_tpl);?>
			    
										</select>
											<div style="clear:both;" class="errorMsg error error0"><?php echo $_smarty_tpl->tpl_vars['priorityErr']->value;?>
</div>
										</div>
									</div>
									<div class="space-4"></div>
									<div class="form-group" style="text-align:left;clear:left;">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> Subject <span class="red"> *</span></label>

										<div class="col-sm-3">
											<input type="text" name="subject" id="subject" value="<?php echo $_POST['subject'];?>
" style="width:300px;">
											<div style="clear:both;" class="errorMsg error error0"><?php echo $_smarty_tpl->tpl_vars['subjectErr']->value;?>
</div>
										
										</div>
									</div>
									<div class="space-4"></div>
									<div class="form-group" style="text-align:left;clear:left;">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> Description <span class="red"> *</span></label>
										<div class="col-sm-3">
											<textarea id="description" rows="2" cols="40" name="description"><?php echo $_POST['description'];?>
</textarea>
											<div style="clear:both;"  class="errorMsg error error0"><?php echo $_smarty_tpl->tpl_vars['descriptionErr']->value;?>
</div>
										
										</div>
									</div>
									<div class="space-4"></div>
									<div class="form-group" style="text-align:left;clear:left;">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> Type <span class="red"> *</span></label>

										<div class="col-sm-3">
										<select name='it_ticket_type' class="input-medium" style="width:300px;" id="type">
											<?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['ticket_data']->value,'selected'=>$_POST['it_ticket_type']),$_smarty_tpl);?>
			    
										</select>
											<div style="clear:both;"  class="errorMsg error"><?php echo $_smarty_tpl->tpl_vars['ticket_typeErr']->value;?>
</div>
										
										</div>
									</div>
									
<div class="space-4"></div>
									
									<div class="form-group" style="text-align:left;clear:left;">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> Attachment </label>

										<div class="col-sm-3">
											<input type="file" name="ticket_file" class="upload" id="ticket_file"/>
											<div class="error error0"><?php echo $_smarty_tpl->tpl_vars['attachmentuploadErr']->value;?>
</div>
										
										</div>
									</div>
									
									
									
<div class="clearfix form-actions">
<input type="hidden" id="change_req" value="submit" name="submit">
										<div class="col-md-9">
											<input onclick="return validate_ticket()" rel="PE" name="Submit" class="btn btn-info btn-sm" value="Submit" id="btnReq" type="submit"/>
										</div>
									</div>
								
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
</html>
<?php }
}
