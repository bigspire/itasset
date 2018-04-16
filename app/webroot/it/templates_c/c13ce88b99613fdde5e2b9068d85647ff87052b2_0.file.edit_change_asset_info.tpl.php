<?php
/* Smarty version 3.1.29, created on 2018-04-14 13:54:48
  from "C:\xampp\htdocs\itassetsvn\itasset\app\webroot\it\templates\edit_change_asset_info.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5ad1bad0ef92e1_67158762',
  'file_dependency' => 
  array (
    'c13ce88b99613fdde5e2b9068d85647ff87052b2' => 
    array (
      0 => 'C:\\xampp\\htdocs\\itassetsvn\\itasset\\app\\webroot\\it\\templates\\edit_change_asset_info.tpl',
      1 => 1478863672,
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
function content_5ad1bad0ef92e1_67158762 ($_smarty_tpl) {
if (!is_callable('smarty_function_html_options')) require_once 'C:\\xampp\\htdocs\\itassetsvn\\itasset\\app\\webroot\\it\\vendor\\smarty-3.1.29\\libs\\plugins\\function.html_options.php';
?>
		
		<?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:include/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

	
	<div id="page_wrapper">
	<?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:include/menu.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<input type="hidden" value="/" id="site_root"/>	
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Edit Change Asset Info</h1>
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
							<a href="edit_change_asset_info.php?id=<?php echo $_smarty_tpl->tpl_vars['getid']->value;?>
">Edit Change Asset Info</a>
						</li>
					</ul>
					
				</div>
				<div class="row-fluid  footer_div">
				
					<div class="span12">
					
								<form action="edit_change_asset_info.php?id=<?php echo $_smarty_tpl->tpl_vars['getid']->value;?>
" method="POST" enctype="multipart/form-data"  class="form-horizontal form-column form-bordered form-wizard ui-formwizard" id="formID" novalidate="novalidate">
									<div class="step ui-formwizard-content" id="firstStep" style="width:99%;margin-top:20px;">
										
									</div>
								
								
						<div class="box">
							<div class="box-title">
								<h3><i class="icon-list"></i>Change Asset Info</h3>
							</div>
							
							<div class="box-content nopadding">
							<div class="span6">
									
										<div class="control-group">
											<label for="textfield" class="control-label">Employee <span class="red_star"> *</span></label>
											<div class="controls"><?php echo $_smarty_tpl->tpl_vars['first_name']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['last_name']->value;?>
</div>
										</div>
										<div class="control-group">
											<label for="password" class="control-label">Message<span class="red_star"> *</span></label>
											<div class="controls"><?php echo $_smarty_tpl->tpl_vars['message']->value;?>
</div>
										</div>
										<div class="control-group">
											<label for="textfield" class="control-label">Remarks</label>
											<div class="controls">
												<textarea name="remark" rows="2" class="input-xlarge" placeholder="Remarks" cols="30" id="remark"><?php echo $_smarty_tpl->tpl_vars['remark']->value;?>
</textarea> 											
											</div>
									</div>
										</div>
<div class="span6">		
<div class="control-group">
											<label for="textfield" class="control-label">Asset Type <span class="red_star"> *</span></label>
											<div class="controls"><?php echo $_smarty_tpl->tpl_vars['type']->value;?>
</div>
										</div>
	<div class="control-group">
											<label for="textfield" class="control-label">Status <span class="red_star"> *</span></label>
											<div class="controls">
											<select name=status  class="input-xlarge" placeholder="" style="clear:left" id="status_id">
												<?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['change_asset_status']->value,'selected'=>$_smarty_tpl->tpl_vars['status']->value),$_smarty_tpl);?>
	
											</select>
											<div class="errorMsg error"><?php echo $_smarty_tpl->tpl_vars['statusErr']->value;?>
 </div>
											</div>
										</div>	
										</div>	
										<div class="span12">				
								</div>
										</div>
										
										</div>
										<div class="span12">
										<div class="form-actions">
											<a href="list_change_asset_info.php">
											<input onclick="return validate_edit_ticket()" type="submit" name="next" value="Submit" class="btn btn-primary"></a>
				                        
											
											<a href="list_change_asset_info.php"><button type="button" val="list_change_asset_info.php" class="jsRedirect btn regCancel">Cancel</button></a>
											
										</div>
									</div>	
							
						</div>
						</div>
						
					</form>					
				</div>
					</div>
		
			</div>		
					
				</div>
				<?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:include/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

		
		</div>
	
	<input type="hidden" value="/" id="css_root">


<?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:include/footer_js.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<?php }
}
