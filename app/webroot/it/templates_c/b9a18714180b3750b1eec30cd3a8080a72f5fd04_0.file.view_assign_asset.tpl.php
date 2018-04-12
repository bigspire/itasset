<?php
/* Smarty version 3.1.29, created on 2018-03-26 13:02:45
  from "C:\xampp\htdocs\itassetsvn\itasset\app\webroot\it\templates\view_assign_asset.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5ab8a21d3fbe60_93634279',
  'file_dependency' => 
  array (
    'b9a18714180b3750b1eec30cd3a8080a72f5fd04' => 
    array (
      0 => 'C:\\xampp\\htdocs\\itassetsvn\\itasset\\app\\webroot\\it\\templates\\view_assign_asset.tpl',
      1 => 1477122467,
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
function content_5ab8a21d3fbe60_93634279 ($_smarty_tpl) {
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
						<h1>View Assign Asset</h1>
					</div>
					
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="dashboard.php">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="list_assign_asset.php">Assign Asset</a>
								<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="view_assign_asset.php?id=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
&type=<?php echo $_GET['type'];?>
">View Assign Asset</a>
						</li>
					</ul>
					
				</div>
				<div class="row-fluid  footer_div">
					<div class="span12">
					
					<form action="view_assign_asset.php" id="formID" class="form-horizontal form-column form-bordered" enctype="multipart/form-data" method="post" accept-charset="utf-8">										
						<div class="box">
							<div class="box-title">
								<h3><i class="icon-list"></i>Assign Asset Details</h3>
							</div>
							<div class="box-content nopadding" style="border-bottom:1px solid #ddd;">
								<div class="span12">
										<div class="row-fluid">									
										<div class="control-group">
											<label for="textfield" class="control-label">Employee Name </label>
											
											<div class="controls">
											 <?php echo $_smarty_tpl->tpl_vars['name']->value;?>

										   </div>
									</div>
									
									<div class="control-group">
											<label for="textfield" class="control-label">Created</label>
											
											<div class="controls">
											  <?php echo $_smarty_tpl->tpl_vars['created']->value;?>

										   </div>
									</div>
									
									<div class="control-group">
											<label for="textfield" class="control-label">Modified</label>
											
											<div class="controls">
											  <?php echo $_smarty_tpl->tpl_vars['modified']->value;?>

										   </div>
									</div>
								</div>
								</div>
							</div>		
									
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
	
		<div class="box-content nopadding" style="border-bottom:1px solid #ddd;border-top:1px solid #ddd;margin-top:20px;">
									<div class="span12">
										<div class="row-fluid">
										<div class="span6" style="clear:left;">
								     <div class="control-group">
											<label for="textfield" class="control-label">Asset Type</label>
											 
											<div class="controls">
											<?php if ($_smarty_tpl->tpl_vars['item']->value['type'] == 'S') {?> Software <?php } else { ?> Hardware <?php }?>                                  
											</div>
										</div>
											
										<div class="control-group">
											<label for="textfield" class="control-label">Brand  </label>
											<div class="controls">
											 <?php echo $_smarty_tpl->tpl_vars['item']->value['brand'];?>

											</div>
										</div>	


										
									</div>

										<div class="span6">		
                              <div class="control-group">
											<label for="textfield" class="control-label"><?php if ($_smarty_tpl->tpl_vars['item']->value['type'] == 'S') {?> Software Type<?php } else { ?> Hardware Type<?php }?> </label>
											<div class="controls">
											 <?php if ($_smarty_tpl->tpl_vars['item']->value['edition']) {?> <?php echo $_smarty_tpl->tpl_vars['item']->value['sw_type'];
} else {
echo $_smarty_tpl->tpl_vars['item']->value['hw_type'];
}?>
											</div>
										</div>
										
	                            <div class="control-group">
											<label for="textfield" class="control-label"><?php if ($_smarty_tpl->tpl_vars['item']->value['type'] == 'S') {?> Edition<?php } else { ?>Inventory No<?php }?>  </label>
											<div class="controls">
											<?php if ($_smarty_tpl->tpl_vars['item']->value['type'] == 'S') {?> <?php echo $_smarty_tpl->tpl_vars['item']->value['edition'];?>
 <?php } else {
echo $_smarty_tpl->tpl_vars['item']->value['inventory_no'];?>
 <?php if ($_smarty_tpl->tpl_vars['item']->value['asset_desc']) {?> (<?php echo $_smarty_tpl->tpl_vars['item']->value['asset_desc'];?>
)<?php }
}?> 
											</div>
										</div>	
										
									</div>	
										
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
						</div>
					
					            <div class="span12">
										<div class="form-actions">
											<a href="list_assign_asset.php"><input type="button" val="list_assign_asset.php" value="Back" class="jsRedirect btn btn-primary"></a>
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
