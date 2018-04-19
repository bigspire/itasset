<?php
/* Smarty version 3.1.29, created on 2018-04-16 16:36:28
  from "C:\xampp\htdocs\2017\itassetsvn\itasset\app\webroot\it\templates\fr_it_pop_up.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5ad483b4f0fef4_86948136',
  'file_dependency' => 
  array (
    'f318fec99022b3cecf03ec74fe3ba38ceb4d516d' => 
    array (
      0 => 'C:\\xampp\\htdocs\\2017\\itassetsvn\\itasset\\app\\webroot\\it\\templates\\fr_it_pop_up.tpl',
      1 => 1523876664,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:include/header.tpl' => 1,
  ),
),false)) {
function content_5ad483b4f0fef4_86948136 ($_smarty_tpl) {
?>

<?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:include/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>


		<!-- basic styles -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="css/font-awesome.min.css">		
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300">
		
	<!-- colorbox -->
<link rel="stylesheet" href="css/plugins/colorbox/colorbox.css">
	<!-- ace styles -->
	<link rel="stylesheet" href="css/ace.min.css">
	
	<link rel="stylesheet" href="css/ace-rtl.min.css">
	<link rel="stylesheet" href="css/ace-skins.min.css">
	<!-- themes -->
	<link rel="stylesheet" href="css/themes/blue.css">
	
       

    
	<div class="widget-body" style="padding-top: 15px;border-top: 1px solid #CCC;">
	
		<div style="margin-left:20px;font-weight:bold;">One moment, Pls verify the assigned hardware and software for you.</div>

		<input type="hidden" id="fr_home" value="">	
	
	
		<div class="widget-main">
			<div>
				<div class="dialogs">
					<div class="clearfix">	
								<div class="row">
									<div class="col-sm-9" >
								
										<div class="tabbable">
											<ul class="nav nav-tabs" id="myTab">
												<li class="active">
													<a data-toggle="tab" href="#hw">
														<i class="green ace-icon fa fa-home bigger-120"></i>
														Assigned Hardware
													</a>
												</li>

												<li>
													<a data-toggle="tab" href="#sw">
														Assigned Software
													</a>
												</li>
								         
											</ul>
<form action="fr_it_pop_up.php" id="formID"  method="post">
																
																

											<div class="tab-content"  style="border:1px solid #c5d0dc">
											
			
	
												<div id="hw" class="tab-pane fade in active">
												
												<?php
$_from = $_smarty_tpl->tpl_vars['data_hardware']->value;
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
												<?php $_smarty_tpl->tpl_vars["hardware_type"] = new Smarty_Variable("1", null);
$_smarty_tpl->ext->_updateScope->updateScope($_smarty_tpl, "hardware_type", 0);?>
													<div class="profile-user-info">
														<div class="profile-info-row">
															
															<div class="profile-info-name"> Type </div>
															
																<div class="profile-info-value">
															
																	<span><b><?php echo ucfirst($_smarty_tpl->tpl_vars['item']->value['hw_type']);?>
</b></span>
																	
																	</div>
																</div>

																<div class="profile-info-row">
																	<div class="profile-info-name"> Brand </div>

																	<div class="profile-info-value">
																		<i class="fa fa-map-marker light-orange bigger-110"></i>
																		<span><?php echo ucfirst($_smarty_tpl->tpl_vars['item']->value['brand']);?>
 &nbsp;</span>
																	</div>
																</div>

																<div class="profile-info-row">
																	<div class="profile-info-name"> Inventory No </div>

																	<div class="profile-info-value">
																		<span><?php echo ucfirst($_smarty_tpl->tpl_vars['item']->value['inventory_no']);?>
&nbsp;</span>
																	</div>
																</div>
																<div class="profile-info-row">
																	<div class="profile-info-name"> Asset Description </div>

																	<div class="profile-info-value">
																		<span><?php echo strtoupper($_smarty_tpl->tpl_vars['item']->value['code']);
echo $_smarty_tpl->tpl_vars['item']->value['asset_desc'];?>
&nbsp;</span>
																	</div>
																</div>
																
																<div class="profile-info-row">
																	<div class="profile-info-name">  </div>

																	<div class="profile-info-value">
																	
																		<span><input type="radio" class="accept" <?php echo $_smarty_tpl->tpl_vars['accept_checked']->value[$_smarty_tpl->tpl_vars['item']->value['inv_id']];?>
 name="accepthw_<?php echo $_smarty_tpl->tpl_vars['item']->value['inv_id'];?>
" value="1_<?php echo $_smarty_tpl->tpl_vars['item']->value['inv_id'];?>
"/> I Accept</span>
																		<span><input type="radio" class="reject" <?php echo $_smarty_tpl->tpl_vars['reject_checked']->value[$_smarty_tpl->tpl_vars['item']->value['inv_id']];?>
 name="accepthw_<?php echo $_smarty_tpl->tpl_vars['item']->value['inv_id'];?>
" value="0_<?php echo $_smarty_tpl->tpl_vars['item']->value['inv_id'];?>
"/> I do not Accept</span>
																		
																	<input type="hidden" id="" name="itahw_<?php echo $_smarty_tpl->tpl_vars['item']->value['inv_id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['ita_id'];?>
"/>

																	
	<input type="hidden" id="" name="itahw_type_<?php echo $_smarty_tpl->tpl_vars['item']->value['ita_id'];?>
" value="<?php echo ucfirst($_smarty_tpl->tpl_vars['item']->value['hw_type']);?>
"/>
	<input type="hidden" id="" name="itahw_brand_<?php echo $_smarty_tpl->tpl_vars['item']->value['ita_id'];?>
" value="<?php echo ucfirst($_smarty_tpl->tpl_vars['item']->value['brand']);?>
"/>
	<input type="hidden" id="" name="itahw_inventory_<?php echo $_smarty_tpl->tpl_vars['item']->value['ita_id'];?>
" value="<?php echo ucfirst($_smarty_tpl->tpl_vars['item']->value['inventory_no']);?>
"/>
	<input type="hidden" id="" name="itahw_asset_desc_<?php echo $_smarty_tpl->tpl_vars['item']->value['ita_id'];?>
" value="<?php echo strtoupper($_smarty_tpl->tpl_vars['item']->value['code']);
echo $_smarty_tpl->tpl_vars['item']->value['asset_desc'];?>
"/>

	
																	


																																				
																		<br>
																			<span class="error"><?php echo $_smarty_tpl->tpl_vars['fieldErr']->value[$_smarty_tpl->tpl_vars['item']->value['inv_id']];?>
</span>
																		
																		<textarea style="margin-top:15px;" id="<?php echo $_smarty_tpl->tpl_vars['item']->value['inv_id'];?>
" class="dn" placeholder="Reason for not accepting" name="reasonhw_<?php echo $_smarty_tpl->tpl_vars['item']->value['inv_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['retainReason']->value[$_smarty_tpl->tpl_vars['item']->value['inv_id']];?>
</textarea>
																		<span class="error"><?php echo $_smarty_tpl->tpl_vars['reasonErr']->value[$_smarty_tpl->tpl_vars['item']->value['inv_id']];?>
</span>
																		
																	</div>
																</div>
																
																
																
															</div>
															<hr>
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
													
													<?php if (!$_smarty_tpl->tpl_vars['hardware_type']->value == 1) {?>
												<div id="flashMessage" class="alert alert-info"  style="margin-bottom:10px;">	
												No hardware assigned to you
												</div>
												<?php }?>
													</div>

												<div id="sw" class="tab-pane fade">
												
												
													<?php
$_from = $_smarty_tpl->tpl_vars['data_software']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_item_1_saved_item = isset($_smarty_tpl->tpl_vars['item']) ? $_smarty_tpl->tpl_vars['item'] : false;
$__foreach_item_1_saved_key = isset($_smarty_tpl->tpl_vars['key']) ? $_smarty_tpl->tpl_vars['key'] : false;
$_smarty_tpl->tpl_vars['item'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['key'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['item']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
$__foreach_item_1_saved_local_item = $_smarty_tpl->tpl_vars['item'];
?>	
													<?php $_smarty_tpl->tpl_vars["software_type"] = new Smarty_Variable("1", null);
$_smarty_tpl->ext->_updateScope->updateScope($_smarty_tpl, "software_type", 0);?>
												<div class="profile-user-info">
																<div class="profile-info-row">
															
																	<div class="profile-info-name"> Type </div>
																	<div class="profile-info-value">
																	
																		<span><b><?php echo ucfirst($_smarty_tpl->tpl_vars['item']->value['sw_type']);?>
</b></span>
																
																	</div>
																</div>

																<div class="profile-info-row">
																	<div class="profile-info-name"> Brand </div>

																	<div class="profile-info-value">
																		<i class="fa fa-map-marker light-orange bigger-110"></i>
																		<span><?php echo ucfirst($_smarty_tpl->tpl_vars['item']->value['brand']);?>
</span>
																	</div>
																</div>

																<div class="profile-info-row">
																	<div class="profile-info-name"> Edition </div>

																	<div class="profile-info-value">
																		<span><?php echo ucfirst($_smarty_tpl->tpl_vars['item']->value['edition']);?>
</span>
																	</div>
																</div>
																	
																	<div class="profile-info-row">
																	<div class="profile-info-name">  </div>

																	<div class="profile-info-value">
																			<span><input type="radio" name="acceptsw_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
" <?php echo $_smarty_tpl->tpl_vars['accept_checked']->value[$_smarty_tpl->tpl_vars['item']->value['id']];?>
 class="accept"  value="1_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
"/> I Accept</span>
																		<span><input type="radio" name="acceptsw_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
" <?php echo $_smarty_tpl->tpl_vars['reject_checked']->value[$_smarty_tpl->tpl_vars['item']->value['id']];?>
  class="reject"  value="0_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
"/> I do not Accept</span>
																		
																		<input type="hidden" id="" name="itasw_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['ita_id'];?>
"/>
																	




	<input type="hidden" id="" name="itasw_type_<?php echo $_smarty_tpl->tpl_vars['item']->value['ita_id'];?>
" value="<?php echo ucfirst($_smarty_tpl->tpl_vars['item']->value['sw_type']);?>
"/>
	<input type="hidden" id="" name="itasw_brand_<?php echo $_smarty_tpl->tpl_vars['item']->value['ita_id'];?>
" value="<?php echo ucfirst($_smarty_tpl->tpl_vars['item']->value['brand']);?>
"/>
	<input type="hidden" id="" name="itasw_edition_<?php echo $_smarty_tpl->tpl_vars['item']->value['ita_id'];?>
" value="<?php echo ucfirst($_smarty_tpl->tpl_vars['item']->value['edition']);?>
"/>

	
																		<br>
																			<span class="error"><?php echo $_smarty_tpl->tpl_vars['fieldErr']->value[$_smarty_tpl->tpl_vars['item']->value['id']];?>
</span>
																			
																		<textarea style="margin-top:15px;" id="<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
" class="dn"  placeholder="Reason for not accepting" name="reasonsw_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['retainReason']->value[$_smarty_tpl->tpl_vars['item']->value['id']];?>
</textarea>
																		
																		<span class="error"><?php echo $_smarty_tpl->tpl_vars['reasonErr']->value[$_smarty_tpl->tpl_vars['item']->value['id']];?>

																		</span>
																		
																	</div>
																</div>
																
																
														
															</div>
															<hr>
										 <?php
$_smarty_tpl->tpl_vars['item'] = $__foreach_item_1_saved_local_item;
}
if ($__foreach_item_1_saved_item) {
$_smarty_tpl->tpl_vars['item'] = $__foreach_item_1_saved_item;
}
if ($__foreach_item_1_saved_key) {
$_smarty_tpl->tpl_vars['key'] = $__foreach_item_1_saved_key;
}
?>
										 <?php if (!$_smarty_tpl->tpl_vars['software_type']->value == 1) {?>
												<div id="flashMessage" class="alert alert-info"  style="margin-bottom:10px;">	
												No software assigned to you
												</div>
												<?php }?>
										
												
												</div>
<div align="center" style="align:center">
<input type="hidden" name="hdnSubmit" id="hdnSubmit"/>
												<input type="submit" name="submit" value="Submit" class="itAcceptBtn btn  btn-success">
											</div>
											
											
											
											</div>
											

											
											
										</form>	
									
									
									</div><!-- /.col -->
								</div>	
												
												
												</div></div></div>

												
										</div>			
													
													
												</div>
															
															
														</div>
											
								</div>
							
								
		</div>					
		<?php echo '<script'; ?>
 src="js/jquery.min.js"><?php echo '</script'; ?>
>
		
		
		<?php echo '<script'; ?>
 src="js/jquery-ui-1.10.4.custom.min.js"><?php echo '</script'; ?>
>

		<?php echo '<script'; ?>
 src="js/plugins/colorbox/jquery.colorbox-min.js"><?php echo '</script'; ?>
>



		<?php echo '<script'; ?>
 src="js/bootstrap.min.js"><?php echo '</script'; ?>
>

		<?php echo '<script'; ?>
 src="js/jquery-ui-1.10.3.custom.min.js"><?php echo '</script'; ?>
>
		<?php echo '<script'; ?>
 src="js/jquery.slimscroll.min.js"><?php echo '</script'; ?>
>
		
		

		<?php echo '<script'; ?>
 src="js/ace-extra.min.js"><?php echo '</script'; ?>
>
		
		<?php echo '<script'; ?>
 src="js/ace-elements.min.js"><?php echo '</script'; ?>
>
		<?php echo '<script'; ?>
 src="js/ace.min.js"><?php echo '</script'; ?>
>
	
	
	<?php echo '<script'; ?>
 src="js/application.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="js/jquery.scrollTo-1.4.3.1-min.js" type="text/javascript"><?php echo '</script'; ?>
>

	

	<?php echo '<script'; ?>
 src="js/main.js"><?php echo '</script'; ?>
>			
	 
	
	<style type="text/css">
	.ui-dialog .ui-dialog-titlebar-close{color:#fff}
	 #dynamic-table tr th{font-weight: bold !important; font-size: 13px !important; }
	 #dynamic-table tr td{font-weight: normal !important; font-size: 13px !important; }
	 #cboxOverlay{opacity:0.5 !important;}
	</style>
	
	
	<?php if ($_smarty_tpl->tpl_vars['form_sent']->value == '1') {?>
	 
	<?php echo '<script'; ?>
 type="text/javascript">
	/* redirect to hardware page once hardware moved to scrap successfully */
	self.parent.location.reload();
	parent.jQuery(".modalCloseImg").click();
	parent.$.colorbox.close();
	<?php echo '</script'; ?>
>
	
	<?php }
}
}
