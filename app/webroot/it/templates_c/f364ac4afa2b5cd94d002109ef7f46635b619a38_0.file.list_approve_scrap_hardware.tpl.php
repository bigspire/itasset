<?php
/* Smarty version 3.1.29, created on 2018-04-16 17:09:37
  from "C:\xampp\htdocs\2017\itassetsvn\itasset\app\webroot\it\templates\list_approve_scrap_hardware.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5ad48b79060fc1_72397452',
  'file_dependency' => 
  array (
    'f364ac4afa2b5cd94d002109ef7f46635b619a38' => 
    array (
      0 => 'C:\\xampp\\htdocs\\2017\\itassetsvn\\itasset\\app\\webroot\\it\\templates\\list_approve_scrap_hardware.tpl',
      1 => 1523876664,
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
function content_5ad48b79060fc1_72397452 ($_smarty_tpl) {
if (!is_callable('smarty_function_html_options')) require_once 'C:\\xampp\\htdocs\\2017\\itassetsvn\\itasset\\app\\webroot\\it\\vendor\\smarty-3.1.29\\libs\\plugins\\function.html_options.php';
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
						<h1>Approve Hardware (Scrap, Lost, Resale & Exchange)</h1>
					</div>
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="dashboard.php">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						<li>
							<a href="list_approve_scrap_hardware.php">Approve Hardware (Scrap, Lost, Resale & Exchange)</a>
						</li>
					</ul>
				</div>
				<?php if ($_smarty_tpl->tpl_vars['ALERT_MSG']->value) {?>
				<div id="flashMessage" class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert">&#x2A2F;</button><?php echo $_smarty_tpl->tpl_vars['ALERT_MSG']->value;?>
</div>					
				<?php }?>
				<?php if ($_smarty_tpl->tpl_vars['SUCCESS_MSG']->value) {?>
					 <div id="flashMessage" class="alert alert-success">
				 <button type="button" class="close" data-dismiss="alert">&#x2A2F;</button><?php echo $_smarty_tpl->tpl_vars['SUCCESS_MSG']->value;?>
</div>					
				<?php }?>
				<div class="row-fluid  footer_div previewDiv" >
					<div class="span12">
						<div class="box box-bordered box-color">
						<div class="box-title">
								<h3><i class="icon-list"></i>Approve Hardware</h3>
						</div>
				<form action="list_approve_scrap_hardware.php" name="" id="formID" class="" method="post" accept-charset="utf-8">							
				<div class="box-content">
				<div class="dataTables_wrapper">
				<div class="" id="DataTables_Table_8_filter"  style="padding:15px">
				<span>Search:</span>  
				 <input name="keyword" value="<?php echo $_smarty_tpl->tpl_vars['keyword']->value;?>
" id="keyword" autocomplete="off" placeholder="Search here..." type="text"/>
			    <?php echo smarty_function_html_options(array('name'=>'hw_type','class'=>"input-medium",'placeholder'=>'','style'=>"clear:left",'id'=>"HrEmployeeRecStatus",'options'=>$_smarty_tpl->tpl_vars['hw_type_data']->value,'selected'=>$_smarty_tpl->tpl_vars['hw_type']->value),$_smarty_tpl);?>

			     <?php echo smarty_function_html_options(array('name'=>'type','class'=>"input-medium",'placeholder'=>'','style'=>"clear:left",'id'=>"HrEmployeeRecStatus",'options'=>$_smarty_tpl->tpl_vars['type_data']->value,'selected'=>$_smarty_tpl->tpl_vars['type']->value),$_smarty_tpl);?>

				<input name="f_date" value="<?php echo $_smarty_tpl->tpl_vars['f_date']->value;?>
" class="input-small datepick" placeholder="From Date" type="text" id="HrEmployeeDob"/> 
	          <input name="t_date" value="<?php echo $_smarty_tpl->tpl_vars['t_date']->value;?>
" class="input-small datepick" placeholder="To Date" type="text" id="HrEmployeeDob"/> 
		       <input type="submit" value="Search" class="btn btn-primary" style="margin-bottom:9px;margin-left:4px;">
             <a href="list_approve_scrap_hardware.php"><button style="margin-bottom:9px;margin-left:4px;" type="button" val="list_approve_scrap_hardware.php" class="jsRedirect btn btn-primary"><i class="icon-refresh"></i> Reset</button></a>
             <?php if (!$_smarty_tpl->tpl_vars['ALERT_MSG']->value) {?> 
             <a href="list_approve_scrap_hardware.php?action=export&keyword=<?php echo $_POST['keyword'];?>
&hw_type=<?php echo $_POST['hw_type'];?>
&f_date=<?php echo $_POST['f_date'];?>
&t_date=<?php echo $_POST['t_date'];?>
"><button type="button" val="list_scrap_hardware.php?action=export&keyword=<?php echo $_POST['keyword'];?>
&hw_type=<?php echo $_POST['hw_type'];?>
&f_date=<?php echo $_POST['f_date'];?>
&t_date=<?php echo $_POST['t_date'];?>
" class="jsRedirect btn btn-primary" style="float:right;margin-right:20px;"><i class="icon-reply"></i> Export</button></a>			
            <?php }?>
            </div>			
				<table class="table table-hover table-nomargin table-bordered usertable dataTable">
					<thead>
						<tr>	
							<th width="200">
								<a href="list_approve_scrap_hardware.php?field=type&order=<?php echo $_smarty_tpl->tpl_vars['order']->value;?>
&page=<?php echo $_GET['page'];?>
&keyword=<?php echo $_smarty_tpl->tpl_vars['keyword']->value;?>
&hw_type=<?php echo $_smarty_tpl->tpl_vars['hw_type']->value;?>
&f_date=<?php echo $_smarty_tpl->tpl_vars['f_date']->value;?>
&t_date=<?php echo $_smarty_tpl->tpl_vars['t_date']->value;?>
" class="<?php echo $_smarty_tpl->tpl_vars['sort_field_type']->value;?>
">Hardware Type</a></th>
							<th width="200">
								<a href="list_approve_scrap_hardware.php?field=brand&order=<?php echo $_smarty_tpl->tpl_vars['order']->value;?>
&page=<?php echo $_GET['page'];?>
&keyword=<?php echo $_smarty_tpl->tpl_vars['keyword']->value;?>
&hw_type=<?php echo $_smarty_tpl->tpl_vars['hw_type']->value;?>
&f_date=<?php echo $_smarty_tpl->tpl_vars['f_date']->value;?>
&t_date=<?php echo $_smarty_tpl->tpl_vars['t_date']->value;?>
" class="<?php echo $_smarty_tpl->tpl_vars['sort_field_brand']->value;?>
">Brand</a></th>		
							<th width="200">
								<a href="list_approve_scrap_hardware.php?field=model_id&order=<?php echo $_smarty_tpl->tpl_vars['order']->value;?>
&page=<?php echo $_GET['page'];?>
&keyword=<?php echo $_smarty_tpl->tpl_vars['keyword']->value;?>
&hw_type=<?php echo $_smarty_tpl->tpl_vars['hw_type']->value;?>
&f_date=<?php echo $_smarty_tpl->tpl_vars['f_date']->value;?>
&t_date=<?php echo $_smarty_tpl->tpl_vars['t_date']->value;?>
" class="<?php echo $_smarty_tpl->tpl_vars['sort_field_model_id']->value;?>
">Model Id</a></th>
							<th width="200">
								<a href="list_approve_scrap_hardware.php?field=inventory_no&order=<?php echo $_smarty_tpl->tpl_vars['order']->value;?>
&page=<?php echo $_GET['page'];?>
&keyword=<?php echo $_smarty_tpl->tpl_vars['keyword']->value;?>
&hw_type=<?php echo $_smarty_tpl->tpl_vars['hw_type']->value;?>
&f_date=<?php echo $_smarty_tpl->tpl_vars['f_date']->value;?>
&t_date=<?php echo $_smarty_tpl->tpl_vars['t_date']->value;?>
" class="<?php echo $_smarty_tpl->tpl_vars['sort_field_inventory_no']->value;?>
">Inventory No</a></th>
							<th width="200">
								<a href="list_approve_scrap_hardware.php?field=location&order=<?php echo $_smarty_tpl->tpl_vars['order']->value;?>
&page=<?php echo $_GET['page'];?>
&keyword=<?php echo $_smarty_tpl->tpl_vars['keyword']->value;?>
&hw_type=<?php echo $_smarty_tpl->tpl_vars['hw_type']->value;?>
&f_date=<?php echo $_smarty_tpl->tpl_vars['f_date']->value;?>
&t_date=<?php echo $_smarty_tpl->tpl_vars['t_date']->value;?>
" class="<?php echo $_smarty_tpl->tpl_vars['sort_field_location']->value;?>
">Location</a></th>
							<th width="200">
								<a href="list_approve_scrap_hardware.php?field=asset_desc&order=<?php echo $_smarty_tpl->tpl_vars['order']->value;?>
&page=<?php echo $_GET['page'];?>
&keyword=<?php echo $_smarty_tpl->tpl_vars['keyword']->value;?>
&hw_type=<?php echo $_smarty_tpl->tpl_vars['hw_type']->value;?>
&f_date=<?php echo $_smarty_tpl->tpl_vars['f_date']->value;?>
&t_date=<?php echo $_smarty_tpl->tpl_vars['t_date']->value;?>
" class="<?php echo $_smarty_tpl->tpl_vars['sort_field_asset_desc']->value;?>
">Asset Description</a></th>
							
								<th width="200">
								<a href="list_approve_scrap_hardware.php?field=status&order=<?php echo $_smarty_tpl->tpl_vars['order']->value;?>
&page=<?php echo $_GET['page'];?>
&keyword=<?php echo $_smarty_tpl->tpl_vars['keyword']->value;?>
&hw_type=<?php echo $_smarty_tpl->tpl_vars['hw_type']->value;?>
&f_date=<?php echo $_smarty_tpl->tpl_vars['f_date']->value;?>
&t_date=<?php echo $_smarty_tpl->tpl_vars['t_date']->value;?>
" class="<?php echo $_smarty_tpl->tpl_vars['sort_field_asset_desc']->value;?>
">Status</a></th>
								
								<th width="200">
								<a href="list_approve_scrap_hardware.php?field=created_date&order=<?php echo $_smarty_tpl->tpl_vars['order']->value;?>
&page=<?php echo $_GET['page'];?>
&keyword=<?php echo $_smarty_tpl->tpl_vars['keyword']->value;?>
&hw_type=<?php echo $_smarty_tpl->tpl_vars['hw_type']->value;?>
&f_date=<?php echo $_smarty_tpl->tpl_vars['f_date']->value;?>
&t_date=<?php echo $_smarty_tpl->tpl_vars['t_date']->value;?>
" class="<?php echo $_smarty_tpl->tpl_vars['sort_field_created_date']->value;?>
">Created Date</a></th>
									<th width="200">
								<a href="list_approve_scrap_hardware.php?field=created_by&order=<?php echo $_smarty_tpl->tpl_vars['order']->value;?>
&page=<?php echo $_GET['page'];?>
&keyword=<?php echo $_smarty_tpl->tpl_vars['keyword']->value;?>
&hw_type=<?php echo $_smarty_tpl->tpl_vars['hw_type']->value;?>
&f_date=<?php echo $_smarty_tpl->tpl_vars['f_date']->value;?>
&t_date=<?php echo $_smarty_tpl->tpl_vars['t_date']->value;?>
" class="<?php echo $_smarty_tpl->tpl_vars['sort_field_created_date']->value;?>
">Created By</a></th>
							<th width="100">Options</th>
				      </tr>
				  </thead>
				<tbody>
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
					<?php if ($_smarty_tpl->tpl_vars['item']->value['type']) {?>	
					<tr>
						<td><?php echo $_smarty_tpl->tpl_vars['item']->value['type'];?>
</td> 
						<td><?php echo $_smarty_tpl->tpl_vars['item']->value['brand'];?>
</td>
						<td><?php echo $_smarty_tpl->tpl_vars['item']->value['model_id'];?>
</td>
						<td><?php echo $_smarty_tpl->tpl_vars['item']->value['inventory_no'];?>
</td>
						<td><?php echo $_smarty_tpl->tpl_vars['item']->value['location'];?>
</td>
						<td><?php echo $_smarty_tpl->tpl_vars['item']->value['asset_desc'];?>
</td>
						<td>
						<?php if ($_smarty_tpl->tpl_vars['item']->value['status'] == 'Approved' || $_smarty_tpl->tpl_vars['item']->value['status'] == 'Rejected') {?>
						<span class='label label-<?php echo $_smarty_tpl->tpl_vars['item']->value['status_cls'];?>
'><a href='#' rel='tooltip' data-original-title = <?php echo $_smarty_tpl->tpl_vars['item']->value['status'];?>
><?php echo $_smarty_tpl->tpl_vars['item']->value['status'];?>
</a>
						<?php } else { ?>
						</span><span style="color:#ff0000;font-size:11px;"><?php echo $_smarty_tpl->tpl_vars['item']->value['status_msg'];?>
</span>
						<?php }?>
						</td>
						<td><?php echo $_smarty_tpl->tpl_vars['item']->value['scrap_created'];?>
</td>
						<td><?php echo $_smarty_tpl->tpl_vars['item']->value['created_by'];?>
</td>
					   <!-- td class='hidden-480'>
						<a href="view_approve_scrap_hardware.php?id=<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
" class="btn" rel="tooltip" title="View"><i class="icon-search"></i></a>
					   </td-->
							<td style="text-align:center">
								<a href="view_approve_scrap_hardware.php?id=<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
" rel="tooltip" class="btn  btn-mini" title="Approve Hardware"><i class="icon-edit"></i></a>
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
		         <div class="dataTables_info" id="DataTables_Table_8_info">
					 <?php echo $_smarty_tpl->tpl_vars['page_info']->value;?>

					</div>
					<div class="table-pagination" id="DataTables_Table_8_paginate">
					 <?php echo $_smarty_tpl->tpl_vars['page_links']->value;?>
		
					</div>
					&nbsp;							
					</div>	
				</div>
				<input type="hidden" id="page" value="approve_scrap_hardware">
			</form>						
		 </div>
		</div>
		</div>
	</div>
</div>			
</div>
<?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:include/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

</div>
<?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:include/footer_js.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
