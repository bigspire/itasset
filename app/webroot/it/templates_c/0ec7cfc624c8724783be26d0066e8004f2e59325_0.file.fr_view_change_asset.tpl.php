<?php
/* Smarty version 3.1.29, created on 2018-01-18 18:10:23
  from "/var/www/html/ceo_apps_it/app/webroot/it/templates/fr_view_change_asset.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5a6095b795d781_60709452',
  'file_dependency' => 
  array (
    '0ec7cfc624c8724783be26d0066e8004f2e59325' => 
    array (
      0 => '/var/www/html/ceo_apps_it/app/webroot/it/templates/fr_view_change_asset.tpl',
      1 => 1516279221,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a6095b795d781_60709452 ($_smarty_tpl) {
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
       
          <h4 class="modal-title">View Change Asset</h4>
        </div><div class="container"></div>
        <div class="">
		
	
		
				 <div class="chgReqFrm" align="center">
		
<div class="" ><div class="" style="display: block;">
												<div class="no-padding">
											
<div class="widget-main">

															<dl id="dt-list-1" style="text-align:left" class="dl-horizontal">
																<?php
$_from = $_smarty_tpl->tpl_vars['data_view_asset']->value;
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
																<dt>Type</dt>
																<dd><?php echo $_smarty_tpl->tpl_vars['item']->value['type'];?>
 <?php ob_start();
echo $_smarty_tpl->tpl_vars['item']->value['sw_type'];
$_tmp1=ob_get_clean();
if ($_tmp1) {?>(<?php echo $_smarty_tpl->tpl_vars['item']->value['sw_type'];?>
)<?php }
ob_start();
echo $_smarty_tpl->tpl_vars['item']->value['hw_type'];
$_tmp2=ob_get_clean();
if ($_tmp2) {?>(<?php echo $_smarty_tpl->tpl_vars['item']->value['hw_type'];?>
)<?php }?></dd>		
																<br>
																<dt>Brand</dt>
																<dd><?php echo $_smarty_tpl->tpl_vars['item']->value['brand'];?>
</dd>
															<?php if ($_smarty_tpl->tpl_vars['item']->value['type_status'] == 'H') {?>
																<br>
																<dt>Inventory No</dt>
																<dd><?php echo $_smarty_tpl->tpl_vars['item']->value['inventory_no'];?>
</dd>
															<?php } else { ?>
																<br>
																<dt>Edition</dt>
																<dd><?php echo $_smarty_tpl->tpl_vars['item']->value['edition'];?>
</dd>
															<?php }?>
																<br>
																<dt>Message</dt>
																<dd><?php echo $_smarty_tpl->tpl_vars['item']->value['message'];?>
</dd>
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
