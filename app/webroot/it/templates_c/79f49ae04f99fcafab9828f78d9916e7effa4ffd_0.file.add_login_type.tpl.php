<?php
/* Smarty version 3.1.29, created on 2016-11-03 10:23:30
  from "/var/www/html/ceo_apps_it/app/webroot/it/templates/add_login_type.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_581ac2ca343624_89165330',
  'file_dependency' => 
  array (
    '79f49ae04f99fcafab9828f78d9916e7effa4ffd' => 
    array (
      0 => '/var/www/html/ceo_apps_it/app/webroot/it/templates/add_login_type.tpl',
      1 => 1477551609,
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
function content_581ac2ca343624_89165330 ($_smarty_tpl) {
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
						<h1>Add Login Type</h1>
					</div>
					
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="dashboard.php">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="login_type.php">Login Type</a>
								<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="add_login_type.php">Add Login Type</a>
							


						</li>
					</ul>
					
				</div>
				 <?php if ($_smarty_tpl->tpl_vars['EXIST_MSG']->value) {?>
				 <div id="flashMessage" class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><?php echo $_smarty_tpl->tpl_vars['EXIST_MSG']->value;?>
</div>					
				<?php }?>
								
				
					
					<div class="row-fluid  footer_div">
					
					
					<div class="span12">
					
								<form action="post.php" method="POST" class="form-horizontal form-wizard ui-formwizard" id="ss" novalidate="novalidate">
									<div class="step ui-formwizard-content" id="firstStep" style="width:99%;margin-top:20px;">
										
									</div>
								
								</form>
						
					<form id="formID" class="form-horizontal form-column form-bordered" enctype="multipart/form-data" method="post" accept-charset="utf-8"><div style="display:none;"><input type="hidden" name="_method" value="POST"/></div>								
									
									
						<div class="box">
							<div class="box-title">
								<h3><i class="icon-list"></i>Login Type Details</h3>
							</div>
							
						
							<div class="box-content nopadding">
								
								
								
								
								
									<div class="span6">
									
										<div class="control-group">
											<label for="textfield" class="control-label">Title <span class="red_star"> *</span></label>
											
											<div class="controls field">
												 <input name="title" class="input-xlarge" placeholder="" type="text" id="title" value="<?php echo $_smarty_tpl->tpl_vars['title']->value;?>
"/> 
									<div class="errorMsg error"><?php echo $_smarty_tpl->tpl_vars['titleErr']->value;?>
 </div>	
										</div>
										</div>
										
								<div class="control-group">
											<label for="textfield" class="control-label">Status <span class="red_star"> *</span></label>
											
											<div class="controls field">
											<?php if (isset($_smarty_tpl->tpl_vars['status']->value)) {?>
	<?php echo smarty_function_html_options(array('name'=>'status','class'=>"input-xlarge",'placeholder'=>'','style'=>"clear:left",'id'=>"status",'options'=>$_smarty_tpl->tpl_vars['sw_status']->value,'selected'=>$_smarty_tpl->tpl_vars['status']->value),$_smarty_tpl);?>
	
											<?php } else { ?>
	<?php echo smarty_function_html_options(array('name'=>'status','class'=>"input-xlarge",'placeholder'=>'','style'=>"clear:left",'id'=>"status",'options'=>$_smarty_tpl->tpl_vars['sw_status']->value,'selected'=>'1'),$_smarty_tpl);?>
	
											<?php }?>	
										<div class="errorMsg error"><?php echo $_smarty_tpl->tpl_vars['statusErr']->value;?>
 </div>	
										</div>
										</div>
										
									
								
								
									</div>
									
									

									
									

<div class="span6">		

	
										
									
										
												
                          <div class="control-group">
											<label for="password" class="control-label">Description<span class="red_star"></span></label>
											<div class="controls">
										<textarea name="description" rows="2" class="input-xlarge" placeholder="" cols="30" id="description"><?php echo $_smarty_tpl->tpl_vars['description']->value;?>
</textarea> 
									
											
												  
											</div>
										</div>
					
										
									
										
								
									</div>


										
										
							<div class="span12">
										<div class="form-actions">
											<input onclick="return validate_logtype()" type="submit" name="next" value="Submit" class="btn btn-primary">
				
											
											<a href="login_type.php"><button type="button" val="login_type.php" class="jsRedirect btn regCancel" onclick="return cancelfunction()">Cancel</button></a>
											
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
