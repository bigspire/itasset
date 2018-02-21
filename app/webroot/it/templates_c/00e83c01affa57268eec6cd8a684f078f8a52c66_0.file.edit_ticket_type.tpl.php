<?php
/* Smarty version 3.1.29, created on 2017-12-16 14:56:10
  from "/var/www/html/ceo_apps_it/app/webroot/it/templates/edit_ticket_type.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5a34e6b2759294_98428177',
  'file_dependency' => 
  array (
    '00e83c01affa57268eec6cd8a684f078f8a52c66' => 
    array (
      0 => '/var/www/html/ceo_apps_it/app/webroot/it/templates/edit_ticket_type.tpl',
      1 => 1513416010,
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
function content_5a34e6b2759294_98428177 ($_smarty_tpl) {
if (!is_callable('smarty_function_html_options')) require_once '/var/www/html/ceo_apps_it/app/webroot/it/vendor/smarty-3.1.29/libs/plugins/function.html_options.php';
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
						<h1>Edit Ticket Type</h1>
					</div>
					
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="dashboard.php">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="list_ticket_type.php">Ticket Type</a>
							<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="edit_ticket_type.php">Edit Ticket Type</a>
						</li>
					</ul>
					
				</div>
				<?php if ($_smarty_tpl->tpl_vars['EXIST_MSG']->value) {?>
				 <div id="flashMessage" class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><?php echo $_smarty_tpl->tpl_vars['EXIST_MSG']->value;?>
</div>					
				<?php }?>
								

				<div class="row-fluid  footer_div">
					<div class="span12">
						
					<form action="edit_ticket_type.php?id=<?php echo $_smarty_tpl->tpl_vars['getid']->value;?>
"  id="formID" class="form-horizontal form-column form-bordered" enctype="multipart/form-data" method="post" accept-charset="utf-8"><div style="display:none;"><input type="hidden" name="_method" value="POST"/></div>											
						<div class="box">
							<div class="box-title">
								<h3><i class="icon-list"></i>Ticket Type Details</h3>
							</div>
							
							<div class="box-content nopadding">
									<div class="span6">
									
										<div class="control-group">
											<label for="textfield" class="control-label">Type <span class="red_star"> *</span></label>
											<div class="controls field">
											   <input name="type" class="input-xlarge" placeholder="" type="text" id="type" value="<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
"/> 
												<div class="errorMsg error"><?php echo $_smarty_tpl->tpl_vars['typeErr']->value;?>
 </div>												  
									  	</div>
										</div>
										</div>	
									<div class="span6">	
										<div class="control-group">
											<label for="textfield" class="control-label">Status <span class="red_star"> *</span></label>
											<div class="controls field">
											<?php if (isset($_smarty_tpl->tpl_vars['status']->value)) {?>
												<?php echo smarty_function_html_options(array('name'=>'status','class'=>"input-xlarge",'placeholder'=>'','style'=>"clear:left",'id'=>"status",'options'=>$_smarty_tpl->tpl_vars['ticket_status']->value,'selected'=>$_smarty_tpl->tpl_vars['status']->value),$_smarty_tpl);?>
	
											<?php } else { ?>
												<?php echo smarty_function_html_options(array('name'=>'status','class'=>"input-xlarge",'placeholder'=>'','style'=>"clear:left",'id'=>"status",'options'=>$_smarty_tpl->tpl_vars['ticket_status']->value,'selected'=>'1'),$_smarty_tpl);?>
	
											<?php }?>	
											<div class="errorMsg error"><?php echo $_smarty_tpl->tpl_vars['statusErr']->value;?>
 </div>			
											</div>
										</div>
																	
									</div>					
	
							<div class="span12">
										<div class="form-actions">
											<input onclick="return validate_brand()" type="submit" name="submit" value="Submit" class="btn btn-primary">
											<a href="list_ticket_type.php"><button type="button" val="list_ticket_type.php" class="jsRedirect btn regCancel" onclick="return cancelfunction()">Cancel</button></a>
										</div>
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
}
}
