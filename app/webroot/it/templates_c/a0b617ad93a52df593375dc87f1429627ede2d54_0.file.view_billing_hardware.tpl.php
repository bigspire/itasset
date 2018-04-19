<?php
/* Smarty version 3.1.29, created on 2018-04-19 16:54:14
  from "C:\xampp\htdocs\2017\itassetsvn\itasset\app\webroot\it\templates\view_billing_hardware.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5ad87c5ef2d6f8_38115050',
  'file_dependency' => 
  array (
    'a0b617ad93a52df593375dc87f1429627ede2d54' => 
    array (
      0 => 'C:\\xampp\\htdocs\\2017\\itassetsvn\\itasset\\app\\webroot\\it\\templates\\view_billing_hardware.tpl',
      1 => 1524137051,
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
function content_5ad87c5ef2d6f8_38115050 ($_smarty_tpl) {
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
						<h1>View Billing</h1>
					</div>
					
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="dashboard.php">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="list_billing.php">Billing</a>
								<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="view_billing_hardware.php?id=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
">View Billing</a>
						</li>   
					</ul>
				</div>
					<div class="row-fluid  footer_div">					
					<div class="span12">
								<form action="view_billing_hardware.php" method="POST" class="form-horizontal form-wizard ui-formwizard" id="ss" novalidate="novalidate">
									<div class="step ui-formwizard-content" id="firstStep" style="width:99%;margin-top:20px;">
									</div>
								</form>
					<form action="/ceo_apps/hremployee/create_employee/confirm/" id="formID" class="form-horizontal form-column form-bordered" enctype="multipart/form-data" method="post" accept-charset="utf-8"><div style="display:none;"><input type="hidden" name="_method" value="POST"/></div>								
						<div class="box">
							<div class="box-title">
								<h3><i class="icon-list"></i> Hardware Details</h3>
								
							</div>						
							<div class="box-content nopadding">
									<div class="span6">
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
						<div class="control-group">
											<label for="textfield" class="control-label">Type </label>
											<div class="controls">
	                            <?php echo $_smarty_tpl->tpl_vars['item']->value['hw_type'];?>

										</div>
										</div>
										<div class="control-group">
											<label for="textfield" class="control-label">Amount  </label>
											<div class="controls">
											<?php echo $_smarty_tpl->tpl_vars['item']->value['cost'];?>

													</div>
										</div>

										
								<div class="control-group">
											<label for="password" class="control-label">Payment Type</label>
											<div class="controls">
												<?php echo $_smarty_tpl->tpl_vars['item']->value['payment_type'];?>

										</div>
										</div>
										<div class="control-group">
											<label for="textfield" class="control-label">Description </label>
											<div class="controls">
											<?php echo $_smarty_tpl->tpl_vars['item']->value['message'];?>

											</div>
										</div>
									</div>
									
								

<div class="span6">	

										
										<div class="control-group">
											<label for="textfield" class="control-label">Inventory No (Brand)  </label>
											<div class="controls">
										<?php echo $_smarty_tpl->tpl_vars['item']->value['invid'];?>
 (<?php echo $_smarty_tpl->tpl_vars['item']->value['brand'];?>
)
													</div>
										</div>
												<div class="control-group">
											<label for="textfield" class="control-label">Bill Date  </label>
											<div class="controls">
											<?php echo $_smarty_tpl->tpl_vars['item']->value['invoice_date'];?>

											</div>
										</div>
																			
										<div class="control-group">
										<label for="textfield" class="control-label">Bill Copy   </label>
											<div class="controls">
											 	<?php echo $_smarty_tpl->tpl_vars['item']->value['attachment'];?>

											</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Bill No   </label>
											<div class="controls">
											 	<?php echo $_smarty_tpl->tpl_vars['item']->value['bill_no'];?>

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

											<div class="span6">

										<div class="control-group">
											<label for="textfield" class="control-label">Company Name </label>
											<div class="controls">
										    <?php echo $_smarty_tpl->tpl_vars['item']->value['vendor_company'];?>

												</div>
										</div>    
										<div class="control-group">
											<label for="textfield" class="control-label">Email Id </label>
											<div class="controls">
											  <?php echo $_smarty_tpl->tpl_vars['item']->value['vendor_email'];?>

													</div>
										</div>   
										<div class="control-group">
											<label for="textfield" class="control-label">Contact Number </label>
											<div class="controls">
													  <?php echo $_smarty_tpl->tpl_vars['item']->value['vendor_phone'];?>

													</div>
										</div>  
				<div class="control-group"></div>
		            </div>
									<div class="span6">		
																						
	                           <div class="control-group">
											<label for="password" class="control-label">Contact Person </label>
											<div class="controls">
												<?php echo $_smarty_tpl->tpl_vars['item']->value['vendor_person'];?>

										</div>
										</div>	
											<div class="control-group">
											<label for="textfield" class="control-label">City </label>
											<div class="controls">
										<?php echo $_smarty_tpl->tpl_vars['item']->value['city'];?>

											</div>
										</div>							
<div class="control-group">
											<label for="textfield" class="control-label">Address </label>
											<div class="controls">
										<?php echo $_smarty_tpl->tpl_vars['item']->value['address'];?>

											</div>
										</div>	
				<div class="control-group"></div>	
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
										<a href="list_billing.php"><input type="button" val="list_billing.php" value="Back" class="jsRedirect btn btn-primary"></a>	
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
