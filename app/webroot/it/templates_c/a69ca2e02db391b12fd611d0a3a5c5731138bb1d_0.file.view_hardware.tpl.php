<?php
/* Smarty version 3.1.29, created on 2018-02-23 17:50:21
  from "C:\xampp\htdocs\2017\itassetsvn\itasset\app\webroot\it\templates\view_hardware.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5a900705d8cfc4_30641923',
  'file_dependency' => 
  array (
    'a69ca2e02db391b12fd611d0a3a5c5731138bb1d' => 
    array (
      0 => 'C:\\xampp\\htdocs\\2017\\itassetsvn\\itasset\\app\\webroot\\it\\templates\\view_hardware.tpl',
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
function content_5a900705d8cfc4_30641923 ($_smarty_tpl) {
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
						<h1>View Hardware</h1>
					</div>
					
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="dashboard.php">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="list_hardware.php">Hardware</a>
								<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="view_hardware.php?id=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
">View Hardware</a>
						</li>   
					</ul>
<!--						<a href="add_scrap.php?id=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
&page=<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
" onclick="return scrapfunction()"><button type="button" class="btn btn-primary" style="float:right">Scrap Hardware</button></a>-->
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
								<h3><i class="icon-list"></i> Hardware Details</h3>
								
							</div>						
							<div class="box-content nopadding">
									<div class="span6">
									
						<div class="control-group">
											<label for="textfield" class="control-label">Type </label>
											<div class="controls">
	                            <?php echo $_smarty_tpl->tpl_vars['hardware_type']->value;?>

										</div>
										</div>
										<div class="control-group">
											<label for="textfield" class="control-label">Color </label>
											<div class="controls">
											<?php echo $_smarty_tpl->tpl_vars['color']->value;?>

													</div>
										</div>

										
								<div class="control-group">
											<label for="password" class="control-label">Description</label>
											<div class="controls">
												<?php echo $_smarty_tpl->tpl_vars['description']->value;?>

										</div>
										</div>
										<div class="control-group">
											<label for="textfield" class="control-label">Status </label>
											<div class="controls">
                                  <?php if ($_smarty_tpl->tpl_vars['status']->value) {?>
                                  Active
                                  <?php } else { ?>
                                  Inactive
                                  <?php }?>
											</div>
										</div>
									</div>
									
								

<div class="span6">	

										
										<div class="control-group">
											<label for="textfield" class="control-label">Brand </label>
											<div class="controls">
										<?php echo $_smarty_tpl->tpl_vars['brand']->value;?>

													</div>
										</div>
												<div class="control-group">
											<label for="textfield" class="control-label">Model ID / Name </label>
											<div class="controls">
											<?php echo $_smarty_tpl->tpl_vars['model_id']->value;?>

											</div>
										</div>
																			
										<div class="control-group">
										<label for="textfield" class="control-label">Subscription Validity   </label>
											<div class="controls">
											 	<?php if ($_smarty_tpl->tpl_vars['validity_from']->value) {
echo $_smarty_tpl->tpl_vars['validity_from']->value;?>
  -  <?php echo $_smarty_tpl->tpl_vars['validity_to']->value;
}?>
											</div>
									</div>
	
									</div>

								
							</div>
						</div>
				


							
						<div class="box">
							<div class="box-title">
								<h3><i class="icon-list"></i> Inventory Details</h3>
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

							<div class="box-content nopadding">

											<div class="span6">

										<div class="control-group">
											<label for="textfield" class="control-label">Inventory No </label>
											<div class="controls">
										    <?php echo $_smarty_tpl->tpl_vars['item']->value['inventory_no'];?>

												</div>
										</div>    
										<div class="control-group">
											<label for="textfield" class="control-label">Location </label>
											<div class="controls">
												<?php echo $_smarty_tpl->tpl_vars['item']->value['district_name'];?>
 ( <?php echo $_smarty_tpl->tpl_vars['item']->value['state_name'];?>
 )
													</div>
										</div>   
				<div class="control-group"></div>
		            </div>
									<div class="span6">		
<!--	<a href="add_scrap.php?id=<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
&page=<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
" onclick="return scrapfunction()">
	<button type="button" class="btn btn-primary" style="float:right">Scrap Hardware</button></a>-->																							
	                           <div class="control-group">
											<label for="password" class="control-label">Serial Number </label>
											<div class="controls">
												<?php echo $_smarty_tpl->tpl_vars['item']->value['serial_no'];?>

										</div>
										</div>	
											<div class="control-group">
											<label for="textfield" class="control-label">Asset Description </label>
											<div class="controls">
										<?php echo $_smarty_tpl->tpl_vars['item']->value['asset_desc'];?>

											</div>
										</div>							

				<div class="control-group"></div>	
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
				

						<div class="box">
							<div class="box-title">
								<h3><i class="icon-list"></i> Pricing Details</h3>
							</div>
													
							<div class="box-content nopadding">
								
																<div class="span6" style="">
										<div class="control-group">
											<label for="textfield" class="control-label">Amount </label>
											<div class="controls">
										<?php echo $_smarty_tpl->tpl_vars['currency']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['amount']->value;?>
 
													</div>
										</div>
										
										
																					
									<div class="control-group">
											<label for="textfield" class="control-label">Paid By </label>
											<div class="controls">
											<?php echo $_smarty_tpl->tpl_vars['paid_mode']->value;?>

												</div>
										</div>
									
                       								
										
	                    <div class="control-group">
											<label for="password" class="control-label">Attach Bill</label> </label>
											<div class="controls">
                      				<a href = "view_hardware.php?id=<?php echo $_GET['id'];?>
&action=download&file=<?php echo $_smarty_tpl->tpl_vars['item']->value['bill'];?>
"><?php echo $_smarty_tpl->tpl_vars['bill']->value;?>
</a>
											</div>
					             	</div>
	                   																			
									</div>
									
								
									<div class="span6">									

	                      <div class="control-group">
											<label for="password" class="control-label">Purchase Date  </label> </label>
											<div class="controls">
											<?php echo $_smarty_tpl->tpl_vars['purchase_date']->value;?>

											</div>
										</div>
										<div class="control-group">
											<label for="password" class="control-label">Paid Date  </label> </label>
											<div class="controls">
											<?php echo $_smarty_tpl->tpl_vars['paid_date']->value;?>

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
											<?php echo $_smarty_tpl->tpl_vars['vendor_name']->value;?>

													</div>
										</div>
									<div class="control-group">
											<label for="textfield" class="control-label">Email Id </label>
											<div class="controls">
												<?php echo $_smarty_tpl->tpl_vars['vendor_email']->value;?>

											</div>
										</div>			
										<div class="control-group">
											<label for="textfield" class="control-label">Contact Number</label>
											<div class="controls">
												 	<?php echo $_smarty_tpl->tpl_vars['vendor_phone']->value;?>

											</div>
										</div>
																			
										
									</div>
									
									
									<div class="span6">									
	
   <div class="control-group">
											<label for="textfield" class="control-label">Contact Person </label>
											<div class="controls">
												<?php echo $_smarty_tpl->tpl_vars['vendor_person']->value;?>
	
											</div>
										</div>
											<div class="control-group">
											<label for="textfield" class="control-label">City </label>
											<div class="controls">
												<?php echo $_smarty_tpl->tpl_vars['vendor_city']->value;?>

											</div>
										</div>	
	<div class="control-group">
											<label for="textfield" class="control-label">Address </label>
											<div class="controls">
													<?php echo $_smarty_tpl->tpl_vars['vendor_address']->value;?>
																							
											</div>
										</div>
									</div>	
							<div class="span12">
										<div class="form-actions">
										<a href="list_hardware.php"><input type="button" val="list_hardware.php" value="Back" class="jsRedirect btn btn-primary"></a>	
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
