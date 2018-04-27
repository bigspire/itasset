<?php
/* Smarty version 3.1.29, created on 2018-04-27 13:27:10
  from "C:\xampp\htdocs\2017\itassetsvn\itasset\app\webroot\it\templates\view_approve_scrap_hardware.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5ae2d7d6123d86_63571047',
  'file_dependency' => 
  array (
    'af6d2efd7976ff422316b6c410279ed25b311311' => 
    array (
      0 => 'C:\\xampp\\htdocs\\2017\\itassetsvn\\itasset\\app\\webroot\\it\\templates\\view_approve_scrap_hardware.tpl',
      1 => 1524815826,
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
function content_5ae2d7d6123d86_63571047 ($_smarty_tpl) {
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
						<h1>View Approve Scrap Hardware</h1>
					</div>
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="dashboard.php">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						<li>
							<a href="list_approve_scrap_hardware.php">Approve Hardware</a>
								<i class="icon-angle-right"></i>
						</li>
						<li>
							<a href="view_approve_scrap_hardware.php?id=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
">View Approve Hardware</a>
						</li>
					</ul>
				</div>
					<div class="row-fluid  footer_div">
					<div class="span12">
		
					<form action="view_approve_scrap_hardware.php" id="formID" class="form-horizontal form-column form-bordered" enctype="multipart/form-data" method="post" accept-charset="utf-8">									
										
						

<div class="box">
							<div class="box-title">
								<h3><i class="icon-list"></i> Request Details</h3>
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
										
									<?php if ($_smarty_tpl->tpl_vars['item']->value['hw_type_val'] == 'S' || $_smarty_tpl->tpl_vars['item']->value['hw_type_val'] == 'L') {?>				
									<div class="span6" style="">
				<div class="control-group">
											<label for="textfield" class="control-label">Type</label>
											<div class="controls">
											<?php echo $_smarty_tpl->tpl_vars['item']->value['hw_type'];?>

													</div>
										</div>
										
										<div class="control-group">
											<label for="textfield" class="control-label">Created Date </label>
											<div class="controls">
												<?php echo $_smarty_tpl->tpl_vars['item']->value['scrap_date'];?>
	
											</div>
										</div>
										<div class="control-group">
											<label for="textfield" class="control-label">Approval Date </label>
											<div class="controls">
												<?php echo $_smarty_tpl->tpl_vars['item']->value['approve_date'];?>
	
											</div>
										</div>
									<div class="control-group">
											<label for="textfield" class="control-label">Status </label>
											<div class="controls">
												<?php echo $_smarty_tpl->tpl_vars['item']->value['scrap'];?>

											</div>
										</div>	
										
										

										</div>
																
									<div class="span6">									
	
   <div class="control-group">
											<label for="textfield" class="control-label">Message </label>
											<div class="controls">
												<?php echo $_smarty_tpl->tpl_vars['item']->value['message'];?>
	
											</div>
										</div>
										
										 <div class="control-group">
											<label for="textfield" class="control-label">Created By </label>
											<div class="controls">
												<?php echo $_smarty_tpl->tpl_vars['item']->value['first_name'];?>
	
											</div>
										</div>
										<div class="control-group">
											<label for="textfield" class="control-label">Remarks </label>
											<div class="controls">
												<?php echo $_smarty_tpl->tpl_vars['item']->value['remarks'];?>
	
											</div>
										</div>
										
									</div>	
									<?php }?>
									
									<?php if ($_smarty_tpl->tpl_vars['item']->value['hw_type_val'] == 'EX' || $_smarty_tpl->tpl_vars['item']->value['hw_type_val'] == 'RS') {?>				
									<div class="span6" style="">
				<div class="control-group">
											<label for="textfield" class="control-label">Type</label>
											<div class="controls">
											<?php echo $_smarty_tpl->tpl_vars['item']->value['hw_type'];?>

													</div>
										</div>
										
										
											<div class="control-group">
											<label for="textfield" class="control-label">Amount</label>
											<div class="controls">
										Rs.	<?php echo $_smarty_tpl->tpl_vars['item']->value['cost'];?>

													</div>
										</div>
										
										
										
									
										
										<div class="control-group">
											<label for="textfield" class="control-label">Created Date </label>
											<div class="controls">
												<?php echo $_smarty_tpl->tpl_vars['item']->value['scrap_date'];?>
	
											</div>
										</div>
									
									<div class="control-group">
											<label for="textfield" class="control-label">Status </label>
											<div class="controls">
												<?php echo $_smarty_tpl->tpl_vars['item']->value['scrap'];?>

											</div>
										</div>	
										
										

										</div>
																
									<div class="span6">	

	<div class="control-group">
											<label for="textfield" class="control-label">New Hardware</label>
											<div class="controls">
											<?php echo $_smarty_tpl->tpl_vars['item']->value['it_hardware_inventory_new'];?>

													</div>
										</div>									
	
   <div class="control-group">
											<label for="textfield" class="control-label">Message </label>
											<div class="controls">
												<?php echo $_smarty_tpl->tpl_vars['item']->value['message'];?>
	
											</div>
										</div>
										
										 <div class="control-group">
											<label for="textfield" class="control-label">Created By </label>
											<div class="controls">
												<?php echo $_smarty_tpl->tpl_vars['item']->value['first_name'];?>
	
											</div>
										</div>
										<div class="control-group">
											<label for="textfield" class="control-label">Remarks </label>
											<div class="controls">
												<?php echo $_smarty_tpl->tpl_vars['item']->value['remarks'];?>
	
											</div>
										</div>
										
									</div>	
									<?php }?>
									
						</div>
						
						<div class="box">
							<div class="box-title">
								<h3><i class="icon-list"></i> Hardware Details</h3>
								
							</div>						
							<div class="box-content nopadding">
							
									<div class="span6">
									
						<div class="control-group">
											<label for="textfield" class="control-label">Type </label>
											<div class="controls">
                         
							   <?php echo $_smarty_tpl->tpl_vars['item']->value['hardware_type'];?>

										</div>
										</div>
										<div class="control-group">
											<label for="textfield" class="control-label">Color </label>
											<div class="controls">
											<?php echo $_smarty_tpl->tpl_vars['item']->value['color'];?>

													</div>
										</div>

										
								<div class="control-group">
											<label for="password" class="control-label">Description</label>
											<div class="controls">
												<?php echo $_smarty_tpl->tpl_vars['item']->value['description'];?>

										</div>
										</div>
										<!--div class="control-group">
											<label for="textfield" class="control-label">Status </label>
											<div class="controls">
                                  <?php if ($_smarty_tpl->tpl_vars['item']->value['status']) {?>
                                  Active
                                  <?php } else { ?>
                                  Inactive
                                  <?php }?>
											</div>
										</div-->
									</div>
									
								

<div class="span6">	

										
										<div class="control-group">
											<label for="textfield" class="control-label">Brand </label>
											<div class="controls">
										<?php echo $_smarty_tpl->tpl_vars['item']->value['brand'];?>

													</div>
										</div>
												<div class="control-group">
											<label for="textfield" class="control-label">Model ID / Name </label>
											<div class="controls">
											<?php echo $_smarty_tpl->tpl_vars['item']->value['model_id'];?>

											</div>
										</div>
																			
										<div class="control-group">
										<label for="textfield" class="control-label">Subscription Validity   </label>
											<div class="controls">
											 	<?php if ($_smarty_tpl->tpl_vars['item']->value['validity_from']) {
echo $_smarty_tpl->tpl_vars['item']->value['validity_from'];?>
  -  <?php echo $_smarty_tpl->tpl_vars['item']->value['validity_to'];
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
												<?php echo $_smarty_tpl->tpl_vars['item']->value['location'];?>
 ( <?php echo $_smarty_tpl->tpl_vars['item']->value['state_name'];?>
 )
													</div>
										</div>   
				<div class="control-group"></div>
		            </div>
									<div class="span6">		
																						
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
										Rs.  <?php echo $_smarty_tpl->tpl_vars['item']->value['amount'];?>
 
													</div>
										</div>
										
										
																					
									<div class="control-group">
											<label for="textfield" class="control-label">Paid By </label>
											<div class="controls">
											<?php echo $_smarty_tpl->tpl_vars['item']->value['paid_mode'];?>

												</div>
										</div>
									
                       								
										
	                    <div class="control-group">
											<label for="password" class="control-label">Attach Bill</label> </label>
											<div class="controls">
                      				<a href = "view_approve_scrap_hardware.php?id=<?php echo $_GET['id'];?>
&action=download&file=<?php echo $_smarty_tpl->tpl_vars['item']->value['bill'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['bill'];?>
</a>
											</div>
					             	</div>
	                   																			
									</div>
									
								
									<div class="span6">									

	                      <div class="control-group">
											<label for="password" class="control-label">Purchase Date  </label> </label>
											<div class="controls">
											<?php echo $_smarty_tpl->tpl_vars['item']->value['purchase_date'];?>

											</div>
										</div>
										<div class="control-group">
											<label for="password" class="control-label">Paid Date  </label> </label>
											<div class="controls">
											<?php echo $_smarty_tpl->tpl_vars['item']->value['paid_date'];?>

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
											<label for="textfield" class="control-label">Email Id </label>
											<div class="controls">
												<?php echo $_smarty_tpl->tpl_vars['item']->value['vendor_email'];?>

											</div>
										</div>			
										<div class="control-group">
											<label for="textfield" class="control-label">Contact Number</label>
											<div class="controls">
												 	<?php echo $_smarty_tpl->tpl_vars['item']->value['vendor_phone'];?>

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
											<label for="textfield" class="control-label">City </label>
											<div class="controls">
												<?php echo $_smarty_tpl->tpl_vars['item']->value['vendor_city'];?>

											</div>
										</div>	
									<div class="control-group">
											<label for="textfield" class="control-label">Address </label>
											<div class="controls">
													<?php echo $_smarty_tpl->tpl_vars['item']->value['vendor_address'];?>
																							
											</div>
										</div>
									</div>	</div>
</div>										
<div class="box">
							
						
							<div class="box-content nopadding">
												
														
																
									
									
							<div class="span12">
									<div class="form-actions">
										<?php if ($_smarty_tpl->tpl_vars['item']->value['scrap_status'] == 'W' && $_smarty_tpl->tpl_vars['roleid']->value == '18') {?>
<a class="iframeBox unreadLink" rel="tooltip" title="Approve Scrap" href="remarks.php?scrap_id=<?php echo $_smarty_tpl->tpl_vars['item']->value['scrap_id'];?>
&user_id=<?php echo $_SESSION['user_id'];?>
&inv_id=<?php echo $_smarty_tpl->tpl_vars['item']->value['inv_id'];?>
&action=approve" val="40_50"><input type="button" value="Approve" class="btn btn btn-success"/></a>
<a class="iframeBox unreadLink" rel="tooltip" title="Reject Scrap" href="remarks.php?scrap_id=<?php echo $_smarty_tpl->tpl_vars['item']->value['scrap_id'];?>
&user_id=<?php echo $_SESSION['user_id'];?>
&inv_id=<?php echo $_smarty_tpl->tpl_vars['item']->value['inv_id'];?>
&action=reject" val="40_50"><input type="button" value="Reject" class="btn btn btn-danger"/></a>
				<?php }
$_smarty_tpl->tpl_vars['item'] = $__foreach_item_0_saved_local_item;
}
if ($__foreach_item_0_saved_item) {
$_smarty_tpl->tpl_vars['item'] = $__foreach_item_0_saved_item;
}
if ($__foreach_item_0_saved_key) {
$_smarty_tpl->tpl_vars['key'] = $__foreach_item_0_saved_key;
}
?>	
										<a href="list_approve_scrap_hardware.php"><input type="button" val="list_approve_scrap_hardware.php" value="Back" class="jsRedirect btn btn-primary"></a>	
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
