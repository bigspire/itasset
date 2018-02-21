<?php
/* Smarty version 3.1.29, created on 2018-02-21 20:31:39
  from "C:\xampp\htdocs\itassetsvn\itasset\app\webroot\it\templates\dashboard.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5a8d89d300baa3_67703329',
  'file_dependency' => 
  array (
    '4d38c0b1d2aea4dc591a65958bdd2e76b69f3af0' => 
    array (
      0 => 'C:\\xampp\\htdocs\\itassetsvn\\itasset\\app\\webroot\\it\\templates\\dashboard.tpl',
      1 => 1478580347,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:include/header.tpl' => 1,
    'file:include/menu.tpl' => 1,
    'file:include/footer.tpl' => 1,
    'file:include/footer_js.tpl' => 1,
    'file:include/dashboard_js.tpl' => 1,
  ),
),false)) {
function content_5a8d89d300baa3_67703329 ($_smarty_tpl) {
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
					<div class="pull-left" style="margin-left: 10px;">
						<h1>Dashboard
						
	
  
  </h1>				

  
					</div>
					
	<div class="pull-right" style="margin-top:20px;margin-right: 208px;">										
	<a href="list_chart.php?display=hide" class="iframeBox" val="55_90">Graph Settings</a> 
  </div>
				</div>
					<?php if ($_smarty_tpl->tpl_vars['access']->value) {?>
				   <div id="flashMessage" class="alert alert-success">
				   <button type="button" class="close" data-dismiss="alert">&#x2A2F;</button><?php echo $_smarty_tpl->tpl_vars['access']->value;?>
</div>					
				   <?php }?>
				  <!--LIST CHART DETAILS-->
 
				<div class="breadcrumbs"  style="width: 83%;margin-left: 12px;">
					<ul>
						<li>
							<a href="dashboard.php">Dashboard</a>
						</li>
					</ul>	
										
				</div>
				
			<div class="row-fluid footer_div" id="pcontent" >
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
		  		<?php if ($_smarty_tpl->tpl_vars['item']->value['order_to_sort'] != 0) {?>
					<div class="span10 bdBox">
					
						<div class="box box-bordered">
							<div class="box-title dashTitle">
								<h3><i class="icon-bar-chart"></i><?php echo $_smarty_tpl->tpl_vars['item']->value['graph_name'];?>
</h3>
								
							</div>
							<div class="box-content">
								<div id="piechart<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
" style="height:400px;"></div>
							</div>
						</div>
					</div>
            <?php }?>
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
			</div>
		</div>
		</div>
	<?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:include/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

	</div>
		<input type="hidden" id="graphHdn" value="1">
	<input type="hidden" value="/" id="css_root">
	<?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:include/footer_js.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

	<?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:include/dashboard_js.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
