<?php
/* Smarty version 3.1.29, created on 2016-11-15 09:32:39
  from "/var/www/html/ceo_apps_it/app/webroot/it/templates/view_software.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_582a88dfe85024_97170144',
  'file_dependency' => 
  array (
    'aba4f9356de8d65558277b6b0ea2123b791c32bc' => 
    array (
      0 => '/var/www/html/ceo_apps_it/app/webroot/it/templates/view_software.tpl',
      1 => 1478836603,
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
function content_582a88dfe85024_97170144 ($_smarty_tpl) {
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
						<h1>View Software</h1>
					</div>
					
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="dashboard.php">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="list_software.php">Software</a>
								<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="view_software.php?id=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
">View Software</a>
						</li>
					</ul>
					
				</div>	
					<div class="row-fluid  footer_div">
					<div class="span12">
								<form action="view.software.php" method="POST" class="form-horizontal form-wizard ui-formwizard" id="ss" novalidate="novalidate">
									<div class="step ui-formwizard-content" id="firstStep" style="width:99%;margin-top:20px;">														
									</div>
								</form>
						
					<form action="/ceo_apps/hremployee/create_employee/confirm/" id="formID" class="form-horizontal form-column form-bordered" enctype="multipart/form-data" method="post" accept-charset="utf-8"><div style="display:none;"><input type="hidden" name="_method" value="POST"/></div>										
						<div class="box">
							<div class="box-title">
								<h3><i class="icon-list"></i>Software Details</h3>
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
										<div class="controls">
								      	<?php echo $_smarty_tpl->tpl_vars['item']->value['software_type'];?>

										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Edition </label>
										<div class="controls">
									      <?php echo $_smarty_tpl->tpl_vars['item']->value['edition'];?>

										</div>
									</div>	
									<div class="control-group">
										<label for="textfield" class="control-label">Subscription Based  </label>
										<div class="controls">
											<?php echo $_smarty_tpl->tpl_vars['item']->value['subscription'];?>

										</div>
									</div>	
									<div class="control-group">
										<label for="textfield" class="control-label">No. of PC / License  </label>
										<div class="controls">
									     <?php echo $_smarty_tpl->tpl_vars['item']->value['no_license'];?>

										</div>
									</div>
									
									<div class="control-group">
									<label for="textfield" class="control-label">System Requirements   </label>
										<div class="controls">
											<?php echo $_smarty_tpl->tpl_vars['item']->value['system_req'];?>
							
										</div>
									</div>
									</div>
                           <div class="span6">		
	                        <div class="control-group">
										<label for="textfield" class="control-label">Brand  </label>
											<div class="controls">
												<?php echo $_smarty_tpl->tpl_vars['item']->value['brand'];?>

											</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Architecture   </label>				
											<div class="controls">
												<?php echo $_smarty_tpl->tpl_vars['item']->value['arch'];?>

											</div>
									</div>					
									<div class="control-group">
										<label for="textfield" class="control-label">Subscription Validity   </label>
											<div class="controls">
											 		<?php if ($_smarty_tpl->tpl_vars['item']->value['validity_from']) {
echo $_smarty_tpl->tpl_vars['item']->value['validity_from'];?>
  -  <?php echo $_smarty_tpl->tpl_vars['item']->value['validity_till'];
} else { ?>Nil<?php }?>
											</div>
									</div>
								   <div class="control-group">
										<label for="textfield" class="control-label">Description   </label>
											<div class="controls">
                           	      <?php echo $_smarty_tpl->tpl_vars['item']->value['description'];?>

											</div>
									</div>
									<div class="control-group">
											<label for="textfield" class="control-label">Status </label>
											<div class="controls">
                                  <?php echo $_smarty_tpl->tpl_vars['item']->value['status'];?>

											</div>
										</div>
								   </div>
							   </div>
						   </div>
						   <div class="box">
							<div class="box-title">
								<h3><i class="icon-list"></i> Pricing Details</h3>
							</div>
							<div class="box-content nopadding">
							<div class="span6" style="">
									<div class="control-group">
										<label for="textfield" class="control-label">Amount </label>
										<div class="controls">
										<?php echo $_smarty_tpl->tpl_vars['item']->value['currency_type'];?>
	<?php echo $_smarty_tpl->tpl_vars['item']->value['amount'];?>
 
										</div>
									</div>		
									<div class="control-group">
										<label for="textfield" class="control-label">Paid By </label>
										<div class="controls">
											<?php echo $_smarty_tpl->tpl_vars['item']->value['paid_mode'];?>
 
										</div>
									</div>
                           <div class="control-group">
		                        <label for="password" class="control-label">Attach Warranty </label>
									   <div class="controls">
											<a href = "view_software.php?id=<?php echo $_GET['id'];?>
&action=download&file=<?php echo $_smarty_tpl->tpl_vars['item']->value['warranty'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['warranty'];?>
</a>
										</div> 
									</div>
							</div>
							<div class="span6">									
							<div class="control-group">
							 <label for="password" class="control-label">Paid Date</label> </label>
								<div class="controls">
									<?php echo $_smarty_tpl->tpl_vars['item']->value['paid_date'];?>

								</div>
							</div>
	                  <div class="control-group">
							 <label for="password" class="control-label">Attach Bill</label> </label>
								<div class="controls">
                      		<a href = "view_software.php?id=<?php echo $_GET['id'];?>
&action=download&file=<?php echo $_smarty_tpl->tpl_vars['item']->value['bill'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['bill'];?>
</a>
								</div>
						   </div>
							</div>
							</div>
						   </div>
							<div class="box">
							<div class="box-title">
								<h3><i class="icon-list"></i> Vendor Details</h3>
							</div>
							<div class="box-content nopadding">
							<div class="span6" style="">
				         <div class="control-group">
									<label for="textfield" class="control-label">Company Name</label>
									<div class="controls">
										<?php echo $_smarty_tpl->tpl_vars['item']->value['vendor_name'];?>

									</div>
							</div>
							<div class="control-group">
									<label for="textfield" class="control-label">Contact Number</label>
									<div class="controls">
										<?php echo $_smarty_tpl->tpl_vars['item']->value['vendor_phone'];?>

									</div>
							</div>
							<div class="control-group">
									<label for="textfield" class="control-label">City </label>
									<div class="controls">
										<?php echo $_smarty_tpl->tpl_vars['item']->value['vendor_city'];?>

									</div>
							</div>											
							</div>
							<div class="span6">									
                     <div class="control-group">
								<label for="textfield" class="control-label">Contact Person </label>
									<div class="controls">
										<?php echo $_smarty_tpl->tpl_vars['item']->value['vendor_person'];?>
	
									</div>
							</div>
	                  <div class="control-group">
								<label for="textfield" class="control-label">Address </label>
									<div class="controls">
										 <?php echo $_smarty_tpl->tpl_vars['item']->value['vendor_address'];?>
																						
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
									<a href="list_software.php"><input type="button" val="list_software.php" value="Back" class="jsRedirect btn btn-primary"></a>
								</div>
						 </div>	
						</div>
						</div>
						</div>
					<!--input type="hidden" id="end_date" value="02/06/2000"-->
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
