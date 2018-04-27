<?php
/* Smarty version 3.1.29, created on 2018-04-27 11:31:50
  from "C:\xampp\htdocs\2017\itassetsvn\itasset\app\webroot\it\templates\edit_login.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5ae2bcce680793_18031816',
  'file_dependency' => 
  array (
    '576eaa27756f5f9a1247655e8a103607a9756a7f' => 
    array (
      0 => 'C:\\xampp\\htdocs\\2017\\itassetsvn\\itasset\\app\\webroot\\it\\templates\\edit_login.tpl',
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
function content_5ae2bcce680793_18031816 ($_smarty_tpl) {
if (!is_callable('smarty_function_html_options')) require_once 'C:\\xampp\\htdocs\\2017\\itassetsvn\\itasset\\app\\webroot\\it\\vendor\\smarty-3.1.29\\libs\\plugins\\function.html_options.php';
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
						<h1>Edit Login</h1>
					</div>
					
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="dashboard.php">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="list_login.php">Login </a>
								<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="edit_login.php?id=<?php echo $_smarty_tpl->tpl_vars['getid']->value;?>
">Edit Login </a>
						</li>
					</ul>
				</div>
					<div class="row-fluid  footer_div">
					
					
					<div class="span12">
					
								<form action="edit_login.php?id=<?php echo $_smarty_tpl->tpl_vars['getid']->value;?>
" method="POST" enctype="multipart/form-data"  class="form-horizontal form-column form-bordered form-wizard ui-formwizard" id="formID" novalidate="novalidate">
									<div class="step ui-formwizard-content" id="firstStep" style="width:99%;margin-top:20px;">
										
									</div>
								
									
									
						<div class="box">
							<div class="box-title">
								<h3><i class="icon-list"></i> Login Details</h3>
							</div>
							
						
							<div class="box-content nopadding">
								
								
								
								
								
									<div class="span6">
									
										<div class="control-group">
											<label for="textfield" class="control-label">Employee <span class="red_star"> *</span></label>
											<div class="controls field">
											<select name="app_users_id" id="app_users">
											<option value="">Select</option>
											<?php echo smarty_function_html_options(array('class'=>"input-xlarge",'placeholder'=>'','style'=>"clear:left",'id'=>"app_users",'options'=>$_smarty_tpl->tpl_vars['employee']->value,'selected'=>$_smarty_tpl->tpl_vars['app_users_id']->value),$_smarty_tpl);?>
	
											</select>
<div class="errorMsg error"><?php echo $_smarty_tpl->tpl_vars['app_users_idErr']->value;?>
 </div>													
										</div>
										</div>
										
										
										<div class="control-group">
											<label for="textfield" class="control-label">Username <span class="red_star"> *</span></label>
											<div class="controls field">
										<input name="user_name" class="input-xlarge" placeholder="" type="text" id="username" value="<?php echo $_smarty_tpl->tpl_vars['user_name']->value;?>
"/> 													
										<div class="errorMsg error"><?php echo $_smarty_tpl->tpl_vars['user_nameErr']->value;?>
 </div>

											</div>
										</div>
										
										<div class="control-group">
											<label for="textfield" class="control-label">URL <span class="red_star"> *</span></label>
											<div class="controls field">
										<input name="host" class="input-xlarge" placeholder="" type="text" id="server" value="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
"/> 													
<div class="errorMsg error"><?php echo $_smarty_tpl->tpl_vars['hostErr']->value;?>
 </div>										
										</div>
										</div>
										
													
								
									</div>
									
									

									
									

<div class="span6">		

	
										
									
									<div class="control-group">
											<label for="textfield" class="control-label">Login Type <span class="red_star"> *</span></label>
											<div class="controls field">
											<select name="it_login_type_id" id="login_type">
										<option value="">Select</option>
					<?php echo smarty_function_html_options(array('class'=>"input-xlarge",'placeholder'=>'','style'=>"clear:left",'id'=>"login_type",'options'=>$_smarty_tpl->tpl_vars['login']->value,'selected'=>$_smarty_tpl->tpl_vars['it_login_type_id']->value),$_smarty_tpl);?>
	
										</select>
<div class="errorMsg error"><?php echo $_smarty_tpl->tpl_vars['it_login_type_idErr']->value;?>
 </div>
										
										</div>
										</div>
										
										<div class="control-group">
											<label for="textfield" class="control-label">Password <span class="red_star"> *</span></label>
											<div class="controls field">
								       	<input name="password" class="input-xlarge" placeholder="" type="text" id="password" value="<?php echo $_smarty_tpl->tpl_vars['password']->value;?>
"/> 													
										  <div class="errorMsg error"><?php echo $_smarty_tpl->tpl_vars['passwordErr']->value;?>
 </div>
										</div>
										</div>
													
										<div class="control-group">
											<label for="textfield" class="control-label">Status <span class="red_star"> *</span></label>
											
											<div class="controls field">
	<?php echo smarty_function_html_options(array('name'=>'status','class'=>"input-xlarge",'placeholder'=>'','style'=>"clear:left",'id'=>"status",'options'=>$_smarty_tpl->tpl_vars['login_status']->value,'selected'=>$_smarty_tpl->tpl_vars['status']->value),$_smarty_tpl);?>
	
										<div class="errorMsg error"><?php echo $_smarty_tpl->tpl_vars['statusErr']->value;?>
 </div>	
										</div>
										</div>						
								
									</div>


										
										
							<div class="span12">
										<div class="form-actions">
											<input onclick = "return validate_login()" type="submit" name="submit" value="Submit" class="btn btn-primary">
				                        
											
											<a href="list_login.php"><button type="button" val="list_login.php" class="jsRedirect btn regCancel" onclick="return cancelfunction()">Cancel</button></a>
											
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
?>

<?php }
}
