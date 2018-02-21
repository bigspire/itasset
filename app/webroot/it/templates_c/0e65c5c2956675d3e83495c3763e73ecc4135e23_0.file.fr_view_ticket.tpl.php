<?php
/* Smarty version 3.1.29, created on 2018-01-18 13:21:13
  from "/var/www/html/ceo_apps_it/app/webroot/it/templates/fr_view_ticket.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5a6051f1da56b3_64431863',
  'file_dependency' => 
  array (
    '0e65c5c2956675d3e83495c3763e73ecc4135e23' => 
    array (
      0 => '/var/www/html/ceo_apps_it/app/webroot/it/templates/fr_view_ticket.tpl',
      1 => 1516261864,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a6051f1da56b3_64431863 ($_smarty_tpl) {
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
 src="js/jquery.sheepItPlugin-1.1.1.js"><?php echo '</script'; ?>
>
	
 
	
	

	</head>
	<body>


<div class="">
	<div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
       
          <h4 class="modal-title">View Ticket</h4>
        </div><div class="container"></div>
        <div class="">
		
	
		
				 <div class="chgReqFrm" align="center">
		
<div class="" ><div class="" style="display: block;">
												<div class="no-padding">
											
<div class="widget-main">

															<dl id="dt-list-1" style="text-align:left" class="dl-horizontal">
															<?php
$_from = $_smarty_tpl->tpl_vars['data_view_ticket']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_item_0_saved_item = isset($_smarty_tpl->tpl_vars['item']) ? $_smarty_tpl->tpl_vars['item'] : false;
$__foreach_item_0_saved_key = isset($_smarty_tpl->tpl_vars['key']) ? $_smarty_tpl->tpl_vars['key'] : false;
$_smarty_tpl->tpl_vars['item'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['key'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['item']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
$__foreach_item_0_saved_local_item = $_smarty_tpl->tpl_vars['item'];
?>
																<dt>Subject</dt>
																<dd><?php echo $_smarty_tpl->tpl_vars['item']->value['subject'];?>
</dd><br>
																<dt>Status</dt>
																<dd><?php echo $_smarty_tpl->tpl_vars['item']->value['status'];?>
</dd><br>
																<dt>Priority</dt>
																<dd><?php echo $_smarty_tpl->tpl_vars['item']->value['priority'];?>
</dd><br>
																<dt>Description</dt>
																<dd><?php echo $_smarty_tpl->tpl_vars['item']->value['description'];?>
</dd><br>
																<dt>Message</dt>
																<dd><?php echo ucfirst($_smarty_tpl->tpl_vars['item']->value['message']);?>
 <?php if ($_smarty_tpl->tpl_vars['item']->value['message']) {?> on <?php } else { ?> On<?php }?> </span> <?php echo $_smarty_tpl->tpl_vars['item']->value['created_date'];?>
</dd><br>
																<dt>Attachment</dt>
																<dd><a href = "fr_view_ticket.php?id=<?php echo $_GET['id'];?>
&action=download&file=<?php echo $_smarty_tpl->tpl_vars['item']->value['attach_file'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['attach_file'];?>
</a></dd>
																<?php
$_smarty_tpl->tpl_vars['item'] = $__foreach_item_0_saved_local_item;
}
if ($__foreach_item_0_saved_item) {
$_smarty_tpl->tpl_vars['item'] = $__foreach_item_0_saved_item;
}
if ($__foreach_item_0_saved_key) {
$_smarty_tpl->tpl_vars['key'] = $__foreach_item_0_saved_key;
}
?>															
															</dl>
														</div>
			
									</div><!-- /widget-main -->
											</div></div>
									</div>
        
		
        </div>
       
      </div>
    </div>
</div>
</body>
</html><?php }
}
