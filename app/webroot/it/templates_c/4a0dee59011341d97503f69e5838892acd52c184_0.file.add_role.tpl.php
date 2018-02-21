<?php
/* Smarty version 3.1.29, created on 2017-05-05 17:25:40
  from "/var/www/html/ceo_apps_it/app/webroot/it/templates/add_role.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_590c683cd38fa4_16784077',
  'file_dependency' => 
  array (
    '4a0dee59011341d97503f69e5838892acd52c184' => 
    array (
      0 => '/var/www/html/ceo_apps_it/app/webroot/it/templates/add_role.tpl',
      1 => 1493984710,
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
function content_590c683cd38fa4_16784077 ($_smarty_tpl) {
if (!is_callable('smarty_function_html_options')) require_once '/var/www/html/ceo_apps_it/app/webroot/it/vendor/smarty-3.1.29/libs/plugins/function.html_options.php';
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
						<h1>Role</h1>
					</div>
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="dashboard.php">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						<li>
							<a href="list_role.php">Role </a>
								<i class="icon-angle-right"></i>
						</li>
						<li>
							<a href="add_role.php">Add Role </a>
						</li>
					</ul>
				</div>
				<?php if ($_smarty_tpl->tpl_vars['EXIST_MSG']->value) {?>
				 <div id="flashMessage" class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><?php echo $_smarty_tpl->tpl_vars['EXIST_MSG']->value;?>
</div>					
				<?php }?>
					<div class="row-fluid footer_div">
					<div class="span12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3><i class="icon-list"></i> Please fill the form to create a new role</h3>
							</div>
							<div class="box-content nopadding">
				<form id="formID" class="form-horizontal form-column form-bordered" method="post" accept-charset="utf-8"><div style="display:none;"><input type="hidden" name="_method" value="POST"/></div>								
				<div class="span6">
					<div class="control-group">
						<label for="textfield" class="control-label">Role Name <span class="red_star"> *</span></label>
							<div class="controls field">
								<input name="role_name" class="input-xlarge" placeholder="" type="text" id="role_name" value="<?php echo $_smarty_tpl->tpl_vars['role_name']->value;?>
"/> 
								<div class="errorMsg error"><?php echo $_smarty_tpl->tpl_vars['role_nameErr']->value;?>
 </div>								
							</div>
					</div>
					<div class="control-group">
						<label for="textfield" class="control-label"> Description </label>
							<div class="controls">
								<textarea name="description" class="input-xlarge" placeholder="" cols="30" rows="6" id="description"><?php echo $_smarty_tpl->tpl_vars['description']->value;?>
</textarea> 				
							</div>
					</div>
				</div>
				<div class="span6">									
				<div class="control-group">
						<label  for="textfield" class="control-label"> Permissions <span class="red_star"> *</span> </label>
							<div class="controls field" >		
							<select name="permission[]" multiple="multiple" size="10" separator="  " class="multi_select" id="RolePermission"  style="clear:left"> 		
<?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['permissions']->value,'selected'=>$_smarty_tpl->tpl_vars['permission_ar']->value),$_smarty_tpl);?>
				
 </select>           
 <div class="rolePermError errorMsg error"><?php echo $_smarty_tpl->tpl_vars['permissionErr']->value;?>
 </div>
</div>
				</div>
				<div class="control-group">
						<label for="textfield" class="control-label">Status
						<span class="red_star"> *</span></label>
						<div class="controls field" >	
											<?php if (isset($_smarty_tpl->tpl_vars['status']->value)) {?>
									<?php echo smarty_function_html_options(array('name'=>'status','class'=>"input-xlarge",'placeholder'=>'','style'=>"clear:left",'id'=>"status",'options'=>$_smarty_tpl->tpl_vars['role_status']->value,'selected'=>$_smarty_tpl->tpl_vars['status']->value),$_smarty_tpl);?>
	
											<?php } else { ?>
									<?php echo smarty_function_html_options(array('name'=>'status','class'=>"input-xlarge",'placeholder'=>'','style'=>"clear:left",'id'=>"status",'options'=>$_smarty_tpl->tpl_vars['role_status']->value,'selected'=>'1'),$_smarty_tpl);?>
	
											<?php }?>										

										<div class="errorMsg error"><?php echo $_smarty_tpl->tpl_vars['statusErr']->value;?>
 </div>	
				</div>
				</div>	
				</div>

			<div class="span12">
					<div class="form-actions">
						<input onclick="return validate_role()" type="submit" name="submit" value="Save Changes" class="btn btn-primary">
							<a href="list_role.php"><button type="button" val="list_role.php" class="jsRedirect btn" onclick="return cancelfunction()">Cancel</button></a>
					</div>
				</div>
			</form>
			</div>
			</div>
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
?>

<?php }
}
