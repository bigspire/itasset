<?php
/* Smarty version 3.1.29, created on 2018-01-18 16:40:11
  from "/var/www/html/ceo_apps_it/app/webroot/it/templates/list_change_asset_info.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5a60809354c106_40228061',
  'file_dependency' => 
  array (
    '4b8743ab3af149d1087751f7afa1d7137b5bd15c' => 
    array (
      0 => '/var/www/html/ceo_apps_it/app/webroot/it/templates/list_change_asset_info.tpl',
      1 => 1516273802,
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
function content_5a60809354c106_40228061 ($_smarty_tpl) {
if (!is_callable('smarty_function_html_options')) require_once '/var/www/html/ceo_apps_it/app/webroot/it/vendor/smarty-3.1.29/libs/plugins/function.html_options.php';
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
						<h1>Change Asset Info</h1>
					</div>
					
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="dashboard.php">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="list_change_asset_info.php">List Change Asset Info</a>
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
								<h3><i class="icon-list"></i>Change Asset Info</h3>
							</div>
						<form action="list_change_asset_info.php" name="" id="formID" class="" method="post" accept-charset="utf-8">
						<div class="box-content">
						<div class="dataTables_wrapper">
				<div class="" id="DataTables_Table_8_filter"  style="padding:15px">
				<span>Search:</span>  
				<input name="keyword" value="<?php echo $_smarty_tpl->tpl_vars['keyword']->value;?>
"  class="input-large" id="search" autocomplete="off" placeholder="Search here..." type="text"/> 
			   <span></span>	
            <?php echo smarty_function_html_options(array('name'=>'emp_name','class'=>"input-medium",'placeholder'=>"Employee",'style'=>"clear:left",'id'=>"HrEmployeeRecStatus",'options'=>$_smarty_tpl->tpl_vars['emp_name_drop']->value,'selected'=>$_smarty_tpl->tpl_vars['emp_name']->value),$_smarty_tpl);?>

				<span></span>	
			   <?php echo smarty_function_html_options(array('name'=>'asset_type','class'=>"input-medium",'style'=>"clear:left",'id'=>"HrEmployeeRecStatus",'options'=>$_smarty_tpl->tpl_vars['asset_type_drop']->value,'selected'=>$_smarty_tpl->tpl_vars['asset_type']->value),$_smarty_tpl);?>
	   
		      <span></span>	
		      <?php echo smarty_function_html_options(array('name'=>'status','class'=>"input-small",'placeholder'=>'','style'=>"clear:left",'id'=>"HrEmployeeRecStatus1",'options'=>$_smarty_tpl->tpl_vars['type']->value,'selected'=>$_smarty_tpl->tpl_vars['status']->value),$_smarty_tpl);?>

		      <input name="f_date" value="<?php echo $_smarty_tpl->tpl_vars['f_date']->value;?>
" class="input-small datepick" placeholder="From Date" type="text" id="HrEmployeeDob"/> 
	         <input name="t_date" value="<?php echo $_smarty_tpl->tpl_vars['t_date']->value;?>
" class="input-small datepick" placeholder="To Date" type="text" id="HrEmployeeDob"/> 
		      <input type="submit" value="Search" class="btn btn-primary" style="margin-bottom:9px;margin-left:4px;">
           <a href="list_change_asset_info.php"><button style="margin-bottom:9px;margin-left:4px;" val="list_change_asset_info.php" type="button" class="jsRedirect btn btn-primary"><i class="icon-refresh"></i> Reset</button></a>
           <?php if (!$_smarty_tpl->tpl_vars['ALERT_MSG']->value) {?> 
           <a href="list_change_asset_info.php?action=export&keyword=<?php echo $_POST['keyword'];?>
&emp_name=<?php echo $_POST['emp_name'];?>
&asset_type=<?php echo $_POST['asset_type'];?>
&f_date=<?php echo $_POST['f_date'];?>
&status=<?php echo $_smarty_tpl->tpl_vars['status']->value;?>
&t_date=<?php echo $_POST['t_date'];?>
"><button type="button" val= "list_change_asset_info.php?action=export&keyword=<?php echo $_POST['keyword'];?>
&emp_name=<?php echo $_POST['emp_name'];?>
&asset_type=<?php echo $_POST['asset_type'];?>
&f_date=<?php echo $_POST['f_date'];?>
&t_date=<?php echo $_POST['t_date'];?>
" class="jsRedirect btn btn-primary" style="float:right;margin-right:20px;"><i class="icon-reply"></i> Export</button></a>							
           <?php }?>
           </div>			
					<table class="table table-hover table-nomargin table-bordered usertable dataTable">
									<thead>	
										<tr>
											<th width="50">
											<a href="list_change_asset_info.php?field=emp_name&order=<?php echo $_smarty_tpl->tpl_vars['order']->value;?>
&page=<?php echo $_GET['page'];?>
&keyword=<?php echo $_smarty_tpl->tpl_vars['keyword']->value;?>
&emp_name=<?php echo $_smarty_tpl->tpl_vars['emp_name']->value;?>
&asset_type=<?php echo $_smarty_tpl->tpl_vars['asset_type']->value;?>
&status=<?php echo $_smarty_tpl->tpl_vars['status']->value;?>
&f_date=<?php echo $_smarty_tpl->tpl_vars['f_date']->value;?>
&t_date=<?php echo $_smarty_tpl->tpl_vars['t_date']->value;?>
" class="<?php echo $_smarty_tpl->tpl_vars['sort_field_emp_name']->value;?>
">Employee Name</a></th>
										   <th width="50">
											<a href="list_change_asset_info.php?fieldasset_type&order=<?php echo $_smarty_tpl->tpl_vars['order']->value;?>
&page=<?php echo $_GET['page'];?>
&keyword=<?php echo $_smarty_tpl->tpl_vars['keyword']->value;?>
&emp_name=<?php echo $_smarty_tpl->tpl_vars['emp_name']->value;?>
&asset_type=<?php echo $_smarty_tpl->tpl_vars['asset_type']->value;?>
&status=<?php echo $_smarty_tpl->tpl_vars['status']->value;?>
&f_date=<?php echo $_smarty_tpl->tpl_vars['f_date']->value;?>
&t_date=<?php echo $_smarty_tpl->tpl_vars['t_date']->value;?>
" class="<?php echo $_smarty_tpl->tpl_vars['sort_field_asset_type']->value;?>
">Asset Type</a></th>		
											<th width="50">
											<a href="list_change_asset_info.php?field=message&order=<?php echo $_smarty_tpl->tpl_vars['order']->value;?>
&page=<?php echo $_GET['page'];?>
&keyword=<?php echo $_smarty_tpl->tpl_vars['keyword']->value;?>
&emp_name=<?php echo $_smarty_tpl->tpl_vars['emp_name']->value;?>
&asset_type=<?php echo $_smarty_tpl->tpl_vars['asset_type']->value;?>
&status=<?php echo $_smarty_tpl->tpl_vars['status']->value;?>
&f_date=<?php echo $_smarty_tpl->tpl_vars['f_date']->value;?>
&t_date=<?php echo $_smarty_tpl->tpl_vars['t_date']->value;?>
" class="<?php echo $_smarty_tpl->tpl_vars['sort_field_message']->value;?>
">Message</a></th>												
											<th width="50">
											<a href="list_change_asset_info.php?field=created_date&order=<?php echo $_smarty_tpl->tpl_vars['order']->value;?>
&page=<?php echo $_GET['page'];?>
&keyword=<?php echo $_smarty_tpl->tpl_vars['keyword']->value;?>
&emp_name=<?php echo $_smarty_tpl->tpl_vars['emp_name']->value;?>
&asset_type=<?php echo $_smarty_tpl->tpl_vars['asset_type']->value;?>
&status=<?php echo $_smarty_tpl->tpl_vars['status']->value;?>
&f_date=<?php echo $_smarty_tpl->tpl_vars['f_date']->value;?>
&t_date=<?php echo $_smarty_tpl->tpl_vars['t_date']->value;?>
" class="<?php echo $_smarty_tpl->tpl_vars['sort_field_created_date']->value;?>
">Created Date</a></th>												
											<th width="50">
											<a href="list_change_asset_info.php?field=modified&order=<?php echo $_smarty_tpl->tpl_vars['order']->value;?>
&page=<?php echo $_GET['page'];?>
&keyword=<?php echo $_smarty_tpl->tpl_vars['keyword']->value;?>
&emp_name=<?php echo $_smarty_tpl->tpl_vars['emp_name']->value;?>
&asset_type=<?php echo $_smarty_tpl->tpl_vars['asset_type']->value;?>
&status=<?php echo $_smarty_tpl->tpl_vars['status']->value;?>
&f_date=<?php echo $_smarty_tpl->tpl_vars['f_date']->value;?>
&t_date=<?php echo $_smarty_tpl->tpl_vars['t_date']->value;?>
" class="<?php echo $_smarty_tpl->tpl_vars['sort_field_modified']->value;?>
">Modified Date</a></th>													
						         		<th width="40">Pending</th>										
											<th style="text-align:center" width="20">Status</th>
											<th width="20">Options</th>
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
										<?php if ($_smarty_tpl->tpl_vars['item']->value['full_name']) {?>								
										<tr>
											<td><?php echo $_smarty_tpl->tpl_vars['item']->value['full_name'];?>
 </td> 
					                	<td><?php echo $_smarty_tpl->tpl_vars['item']->value['type'];?>
</td>
											<td><?php echo ucfirst($_smarty_tpl->tpl_vars['item']->value['message']);?>
</td>
											<td><?php echo $_smarty_tpl->tpl_vars['item']->value['created_date'];?>
</td>
											<td><?php echo $_smarty_tpl->tpl_vars['item']->value['modified_date'];?>
</td>
											<td><?php echo $_smarty_tpl->tpl_vars['item']->value['pending'];?>
</td> 		
										 <td style="text-align:center"><span class='label label-<?php echo $_smarty_tpl->tpl_vars['item']->value['status_cls'];?>
'><a href='#' rel='tooltip' data-original-title = <?php echo $_smarty_tpl->tpl_vars['item']->value['status'];?>
><?php echo $_smarty_tpl->tpl_vars['item']->value['status'];?>
</a></span></td>
								      	<td class='hidden-480'>
												<a href="view_change_asset_info.php?id=<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
&asset_type=<?php echo $_smarty_tpl->tpl_vars['item']->value['type_status'];?>
" class="btn" rel="tooltip" title="View"><i class="icon-search"></i></a>
											   <a href="edit_change_asset_info.php?id=<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
&asset_type=<?php echo $_smarty_tpl->tpl_vars['item']->value['type'];?>
" class="btn" rel="tooltip" title="Edit"><i class="icon-edit"></i></a>
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
<input type="hidden" value="/" id="css_root">
<?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:include/footer_js.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<?php }
}
