<?php
/* Smarty version 3.1.29, created on 2018-04-17 14:47:50
  from "C:\xampp\htdocs\2017\itassetsvn\itasset\app\webroot\it\templates\fr_it_home.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5ad5bbbec5dd35_94431911',
  'file_dependency' => 
  array (
    '89c15aeea007eace92536dc3f94e40dd7d042761' => 
    array (
      0 => 'C:\\xampp\\htdocs\\2017\\itassetsvn\\itasset\\app\\webroot\\it\\templates\\fr_it_home.tpl',
      1 => 1519292829,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:include/header.tpl' => 1,
  ),
),false)) {
function content_5ad5bbbec5dd35_94431911 ($_smarty_tpl) {
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
	
   
	<div class="widget-body">
	
	
		<input type="hidden" id="fr_home" value="">	
	
	
		<div class="widget-main no-padding">
			<div>
				<div class="dialogs scrollable" data-start ="top" data-height="465" data-visible="true">
					<div class="clearfix">	
								<div class="row">
									<div class="col-sm-9" >
										<div style="position:absolute;right:15px;z-index:99999">										
										<a href="fr_add_ticket.php" class="iframeBox" val="55_95"><button class="btn btn-xs btn-info"><i class="icon-plus"></i> Create Ticket
							          </button></a> 
							         </div>
										<div class="tabbable">
											<ul class="nav nav-tabs" id="myTab">
												<li class="active">
													<a data-toggle="tab" href="#hw">
														<i class="green ace-icon fa fa-home bigger-120"></i>
														My Hardware
													</a>
												</li>

												<li>
													<a data-toggle="tab" href="#sw">
														My Software
													</a>
												</li>
								            
								            <li>
													<a data-toggle="tab" href="#car">
														Change Asset Req. <span class="badge badge-danger"><span class="count"  id="ast_cnt"><?php if ($_smarty_tpl->tpl_vars['asset_count']->value > 0) {
echo $_smarty_tpl->tpl_vars['asset_count']->value;
}?></span></span>
													</a>
												</li>
												<li>
													<a data-toggle="tab" href="#tk">
														Help Desk <span class="badge badge-danger"><span class="count" id="tkt_cnt"><?php if ($_smarty_tpl->tpl_vars['ticket_count']->value > 0) {
echo $_smarty_tpl->tpl_vars['ticket_count']->value;
}?></span></span>
													</a>
												</li>
											</ul>

		<div class="tab-content"  style="border:1px solid #c5d0dc">
											<div id="car" class="tab-pane fade">
											<?php if ($_smarty_tpl->tpl_vars['ALERT_MSG_ASSET']->value) {?>
											<div id="flashMessage" class="alert alert-info"  style="margin-bottom:10px;">											
											<?php echo $_smarty_tpl->tpl_vars['ALERT_MSG_ASSET']->value;?>
	
											</div>
											<?php } else { ?>
											<table id="dynamic-table" class="table table-striped table-hover dataTable no-footer" role="grid" aria-describedby="dynamic-table_info">																					
											<div id="message"  class="dn hide-1">
    											<div id="flashMessage" class="alert alert-success"  style="margin-bottom:10px;">
    												<button  type="button" data-dismiss="alert" class="close" style="margin-right:15px;" id="1">×</button>
        												Change asset req deleted successfully.
        										</div>
        											
											</div>											
												<thead>
													<tr role="row">
														<th width="500"  tabindex="0" aria-controls="dynamic-table" rowspan="1" colspan="1">Message</th>
														<th  width="150"  tabindex="0" aria-controls="dynamic-table" rowspan="1" colspan="1" >Type</th>
														<th width="150"  tabindex="0" aria-controls="dynamic-table" rowspan="1" colspan="1">Created Date</th>
														<th width="150" style="text-align:center" tabindex="0" aria-controls="dynamic-table" rowspan="1" colspan="1">
															Status
														</th>
														<th width="150">
															Options
														</th>
														</tr>
												</thead>

												<tbody>	
												<?php
$_from = $_smarty_tpl->tpl_vars['data_asset']->value;
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
								              <?php if ($_smarty_tpl->tpl_vars['item']->value['created_date']) {?>
												<tr role="row" class='row-<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
'>
														<td>
															<a href="fr_view_change_asset.php?id=<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
&asset_type=<?php echo $_smarty_tpl->tpl_vars['item']->value['type_status'];?>
" class="iframeBox"  val="55_95"><?php echo ucfirst($_smarty_tpl->tpl_vars['item']->value['message']);?>
</a>
														</td>
														<td>
														<?php echo ucfirst($_smarty_tpl->tpl_vars['item']->value['type']);?>

														</td>
														<td class="hidden-480"><?php echo $_smarty_tpl->tpl_vars['item']->value['created_date'];?>
</td>

														 <td style="text-align:center">
														 <span class='label label-<?php echo $_smarty_tpl->tpl_vars['item']->value['status_cls'];?>
'>
														 <?php echo $_smarty_tpl->tpl_vars['item']->value['status'];?>
</span>
														 </td>
								
														<td>
															<a href="javascript:void(0)" id='<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
' class='deletedata' val="asset"  rel="tooltip" title="Remove" style=""><button class="btn btn-xs btn-info" val="55_95"><i class="icon-remove"></i></button></a>
														</td>
												</tr>
												 	<?php }?>
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
												</tbody>
												</table>
												<?php }?>
											

												</div>
	
												<div id="hw" class="tab-pane fade in active">
												
												<?php
$_from = $_smarty_tpl->tpl_vars['data_hardware']->value;
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
												<?php $_smarty_tpl->tpl_vars["hardware_type"] = new Smarty_Variable("1", null);
$_smarty_tpl->ext->_updateScope->updateScope($_smarty_tpl, "hardware_type", 0);?>
													<div class="profile-user-info">
														<div class="profile-info-row">
															
															<div class="profile-info-name"> Type </div>
															
																<div class="profile-info-value">
															
																	<span><b><?php echo ucfirst($_smarty_tpl->tpl_vars['item']->value['hw_type']);?>
</b></span>
																		<a href="fr_asset_change_user.php?id=<?php echo $_smarty_tpl->tpl_vars['item']->value['inv_id'];?>
&type=H" rel="tooltip" title="Request Change" style="float:right;margin-right:150px;" class="iframeBox" val="55_95"><button class="btn btn-xs btn-info" val="55_95"><i class="icon-pencil"></i> Change</button></a>
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
$__foreach_item_2_saved_item = isset($_smarty_tpl->tpl_vars['item']) ? $_smarty_tpl->tpl_vars['item'] : false;
$__foreach_item_2_saved_key = isset($_smarty_tpl->tpl_vars['key']) ? $_smarty_tpl->tpl_vars['key'] : false;
$_smarty_tpl->tpl_vars['item'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['key'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['item']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
$__foreach_item_2_saved_local_item = $_smarty_tpl->tpl_vars['item'];
?>	
													<?php $_smarty_tpl->tpl_vars["software_type"] = new Smarty_Variable("1", null);
$_smarty_tpl->ext->_updateScope->updateScope($_smarty_tpl, "software_type", 0);?>
												<div class="profile-user-info">
																<div class="profile-info-row">
															
																	<div class="profile-info-name"> Type </div>
																	<div class="profile-info-value">
																	
																		<span><b><?php echo ucfirst($_smarty_tpl->tpl_vars['item']->value['sw_type']);?>
</b></span>
																	<a href="fr_asset_change_user.php?id=<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
&type=S" rel="tooltip" 
																	title="Request Change" style="float:right;margin-right:150px" 
																	class="iframeBox" val="55_95"><button class="btn btn-xs btn-info" val="55_95"><i class="icon-pencil"></i> Change</button></a>
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
												       
															</div>
															<hr>
										 <?php
$_smarty_tpl->tpl_vars['item'] = $__foreach_item_2_saved_local_item;
}
if ($__foreach_item_2_saved_item) {
$_smarty_tpl->tpl_vars['item'] = $__foreach_item_2_saved_item;
}
if ($__foreach_item_2_saved_key) {
$_smarty_tpl->tpl_vars['key'] = $__foreach_item_2_saved_key;
}
?>
										 <?php if (!$_smarty_tpl->tpl_vars['software_type']->value == 1) {?>
												<div id="flashMessage" class="alert alert-info"  style="margin-bottom:10px;">	
												No software assigned to you
												</div>
												<?php }?>
										
												
												</div>

												<div id="tk" class="tab-pane fade">
												<?php if ($_smarty_tpl->tpl_vars['ALERT_MSG_TICKET']->value) {?>
												<div id="flashMessage" class="alert alert-info"  style="margin-bottom:10px;">	
												<?php echo $_smarty_tpl->tpl_vars['ALERT_MSG_TICKET']->value;?>

												</div>
												<?php } else { ?>
												<table id="dynamic-table" class="table table-striped table-hover dataTable no-footer" role="grid" aria-describedby="dynamic-table_info">												
												<div id="message1" class="dn hide-2">
   												<div id="flashMessage" class="alert alert-success"  style="margin-bottom:10px;">
    													<button  class="close" id="2" style="margin-right:15px;">×</button>
        													Ticket deleted successfully.
   												</div>
												</div>										
												<thead>
													<tr role="row">
														<th width="500"  tabindex="0" aria-controls="dynamic-table" rowspan="1" colspan="1">Subject</th>
														<th  width="150"   tabindex="0" aria-controls="dynamic-table" rowspan="1" colspan="1" >Priority</th>
														<th width="150"  tabindex="0" aria-controls="dynamic-table" rowspan="1" colspan="1">Created Date</th>
														<th width="150"  style="text-align:center" tabindex="0" aria-controls="dynamic-table" rowspan="1" colspan="1">
															Status
														</th>
														<th width="150">
															Options
														</th>
														</tr>
												</thead>

												<tbody>
												<?php
$_from = $_smarty_tpl->tpl_vars['data_ticket']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_item_3_saved_item = isset($_smarty_tpl->tpl_vars['item']) ? $_smarty_tpl->tpl_vars['item'] : false;
$__foreach_item_3_saved_key = isset($_smarty_tpl->tpl_vars['key']) ? $_smarty_tpl->tpl_vars['key'] : false;
$_smarty_tpl->tpl_vars['item'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['key'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['item']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
$__foreach_item_3_saved_local_item = $_smarty_tpl->tpl_vars['item'];
?>		
								              <?php if ($_smarty_tpl->tpl_vars['item']->value['priority']) {?>
												<tr role="row" class='row-<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
'>
														<td>
															<a href="fr_view_ticket.php?id=<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
" class="iframeBox"  val="55_95"><?php echo ucfirst($_smarty_tpl->tpl_vars['item']->value['subject']);?>
</a>
														</td>
														<td>
														<?php echo $_smarty_tpl->tpl_vars['item']->value['priority'];?>

														</td>
														<td class="hidden-480"><?php echo $_smarty_tpl->tpl_vars['item']->value['created_date'];?>
</td>

														
														<td class="hidden-480" style="text-align:center">
															<span class='label label-<?php echo $_smarty_tpl->tpl_vars['item']->value['status_cls'];?>
'><?php echo $_smarty_tpl->tpl_vars['item']->value['status'];?>
</span>
														</td>
														<td>						
														 <a href="javascript:void(0)" id='<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
' class='deletedata' val="ticket" rel="tooltip" title="Remove" style="" ><button class="btn btn-xs btn-info" val="55_95"><i class="icon-remove"></i></button></a>
														</td>
												</tr>
													<?php }?>
												<?php
$_smarty_tpl->tpl_vars['item'] = $__foreach_item_3_saved_local_item;
}
if ($__foreach_item_3_saved_item) {
$_smarty_tpl->tpl_vars['item'] = $__foreach_item_3_saved_item;
}
if ($__foreach_item_3_saved_key) {
$_smarty_tpl->tpl_vars['key'] = $__foreach_item_3_saved_key;
}
?>
												
												</tbody>
											  </table>
												<?php }?>
												</div>

												
											</div>
										
									
									
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
	<?php }
}
