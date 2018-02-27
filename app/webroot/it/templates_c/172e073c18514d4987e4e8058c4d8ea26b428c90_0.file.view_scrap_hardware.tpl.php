<?php
/* Smarty version 3.1.29, created on 2018-02-26 12:57:04
  from "C:\xampp\htdocs\2017\itassetsvn\itasset\app\webroot\it\templates\view_scrap_hardware.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5a93b6c823b6b8_90358098',
  'file_dependency' => 
  array (
    '172e073c18514d4987e4e8058c4d8ea26b428c90' => 
    array (
      0 => 'C:\\xampp\\htdocs\\2017\\itassetsvn\\itasset\\app\\webroot\\it\\templates\\view_scrap_hardware.tpl',
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
function content_5a93b6c823b6b8_90358098 ($_smarty_tpl) {
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
						<h1>View Scrap Hardware</h1>
					</div>
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="dashboard.php">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						<li>
							<a href="list_scrap_hardware.php">Scrap Hardware</a>
								<i class="icon-angle-right"></i>
						</li>
						<li>
							<a href="view_scrap_hardware.php?id=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
">View Scrap Hardware</a>
						</li>
					</ul>
				</div>
					<div class="row-fluid  footer_div">
					<div class="span12">
		
					<form action="view_scrap_hardware.php" id="formID" class="form-horizontal form-column form-bordered" enctype="multipart/form-data" method="post" accept-charset="utf-8"><div style="display:none;"><input type="hidden" name="_method" value="POST"/></div>										
					<div class="box">
							<div class="box-title">
								<h3><i class="icon-list"></i>Scrap Hardware Details</h3>
							</div>
				   <div class="box-content nopadding">
						<div class="span6">		
						<div class="control-group">
						 <label for="textfield" class="control-label">Type </label>
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
						 <div class="controls"><?php echo $_smarty_tpl->tpl_vars['item']->value['title'];?>
	</div>
						</div>		
						<div class="control-group">
						 <label for="textfield" class="control-label">Model ID / Name </label>
						 <div class="controls"><?php echo $_smarty_tpl->tpl_vars['item']->value['model_id'];?>
	</div>
						</div>			 
						<div class="control-group">
						 <label for="textfield" class="control-label">Location </label>
						 <div class="controls"><?php echo $_smarty_tpl->tpl_vars['item']->value['location'];?>
	</div>
						</div>
										
						<div class="control-group">
						 <label for="password" class="control-label">Scrap Date</label> </label>
						 <div class="controls"><?php echo $_smarty_tpl->tpl_vars['item']->value['created_date'];?>
	</div>
						</div>			
						</div>
                  <div class="span6">	
                  <div class="control-group">
			          <label for="textfield" class="control-label">Brand </label>
			          <div class="controls"><?php echo $_smarty_tpl->tpl_vars['item']->value['brand'];?>
  </div>
				      </div>
				      <div class="control-group">
				       <label for="textfield" class="control-label">Inventory No </label>
				       <div class="controls">  <?php echo $_smarty_tpl->tpl_vars['item']->value['inventory_no'];?>
	</div>
				      </div>						
				      <div class="control-group">
			          <label for="textfield" class="control-label">Asset Description </label>
				       <div class="controls">	<?php echo $_smarty_tpl->tpl_vars['item']->value['asset_desc'];?>
	</div>
				      </div>
					  <div class="control-group">
			          <label for="textfield" class="control-label">Message </label>
				       <div class="controls">	<?php echo $_smarty_tpl->tpl_vars['item']->value['message'];?>
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
					<div class="span12">
						<div class="form-actions">
						 <a href="list_scrap_hardware.php"><input type="button" val="list_scrap_hardware.php" value="Back" class="jsRedirect btn btn-primary"></a>
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
