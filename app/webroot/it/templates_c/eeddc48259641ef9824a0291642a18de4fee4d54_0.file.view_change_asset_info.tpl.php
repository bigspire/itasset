<?php
/* Smarty version 3.1.29, created on 2018-04-20 14:33:26
  from "C:\xampp\htdocs\2017\itassetsvn\itasset\app\webroot\it\templates\view_change_asset_info.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5ad9acdebcc3b4_97389183',
  'file_dependency' => 
  array (
    'eeddc48259641ef9824a0291642a18de4fee4d54' => 
    array (
      0 => 'C:\\xampp\\htdocs\\2017\\itassetsvn\\itasset\\app\\webroot\\it\\templates\\view_change_asset_info.tpl',
      1 => 1519292829,
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
function content_5ad9acdebcc3b4_97389183 ($_smarty_tpl) {
?>


	<?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:include/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
		
	<div id="page_wrapper">
	<?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:include/menu.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

	
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>View Change Asset Info</h1>
					</div>
					
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="dashboard.php">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						<li>
							<a href="list_change_asset_info.php">Change Asset Info</a>
								<i class="icon-angle-right"></i>
						</li>
						<li>
							<a href="view_change_asset_info.php?id=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
">View Change Asset Info</a>
						</li>
					</ul>
				</div>
				<div class="row-fluid  footer_div">
					<div class="span12">
					<form action="post.php" method="POST" class="form-horizontal form-wizard ui-formwizard" id="ss" novalidate="novalidate">
					<div class="step ui-formwizard-content" id="firstStep" style="width:99%;margin-top:20px;">										
					</div>
					</form>
					<form action="view_change_asset_info.php" id="formID" class="form-horizontal form-column form-bordered" enctype="multipart/form-data" method="post" accept-charset="utf-8">											
						<div class="box">
							<div class="box-title">
								<h3><i class="icon-list"></i>Change Asset Info </h3>
							</div>
						<div class="box-content nopadding">
						<div class="span6">
							<div class="control-group">
								<label for="textfield" class="control-label">Employee <span class="red_star"></span></label>
								<?php
$_from = $_smarty_tpl->tpl_vars['data']->value;
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
								<div class="controls"><?php echo $_smarty_tpl->tpl_vars['item']->value['full_name'];?>
</div>
							</div>
							<div class="control-group">
								 <label for="password" class="control-label">Brand<span class="red_star"></span></label>
								 <div class="controls"><?php echo $_smarty_tpl->tpl_vars['item']->value['brand'];?>
</div>
							</div>
							<div class="control-group">
								 <label for="password" class="control-label">Message<span class="red_star"></span></label>
								 <div class="controls"><?php echo $_smarty_tpl->tpl_vars['item']->value['message'];?>
</div>
							</div>
							<div class="control-group">
								 <label for="password" class="control-label">Remarks<span class="red_star"></span></label>
								 <div class="controls"><?php echo $_smarty_tpl->tpl_vars['item']->value['remark'];?>
</div>
							</div>
						</div>			
                  <div class="span6">		
						<div class="control-group">
							<label for="textfield" class="control-label">Asset Type <span class="red_star"></span></label>
							<div class="controls"><?php echo $_smarty_tpl->tpl_vars['item']->value['type'];?>
 <?php ob_start();
echo $_smarty_tpl->tpl_vars['item']->value['sw_type'];
$_tmp1=ob_get_clean();
if ($_tmp1) {?>(<?php echo $_smarty_tpl->tpl_vars['item']->value['sw_type'];?>
)<?php }
ob_start();
echo $_smarty_tpl->tpl_vars['item']->value['hw_type'];
$_tmp2=ob_get_clean();
if ($_tmp2) {?>(<?php echo $_smarty_tpl->tpl_vars['item']->value['hw_type'];?>
)<?php }?></div>
						</div>
						<?php if ($_smarty_tpl->tpl_vars['item']->value['type_status'] == 'H') {?>
						<div class="control-group">
								 <label for="password" class="control-label">Inventory No<span class="red_star"></span></label>
								 <div class="controls"><?php echo $_smarty_tpl->tpl_vars['item']->value['inventory_no'];?>
</div>
						</div>
						<?php } else { ?>
						<div class="control-group">
								 <label for="password" class="control-label">Edition<span class="red_star"></span></label>
								 <div class="controls"><?php echo $_smarty_tpl->tpl_vars['item']->value['edition'];?>
</div>
						</div>
						<?php }?>
						<div class="control-group">
							<label for="textfield" class="control-label">Status <span class="red_star"></span></label>
							<div class="controls"><?php echo $_smarty_tpl->tpl_vars['item']->value['status'];?>
</div>
						</div>
						<div class="control-group">
						</div>
						</div>	
						</div>	
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
						<div class="span12">
							<div class="form-actions">
								<a href="list_change_asset_info.php"><input type="button" val="list_change_asset_info.php" value="Back" class="jsRedirect btn btn-primary"></a>
							</div>
						</div>
				  </div>
				</div>
			</form>		
		</div>
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
