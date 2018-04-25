<?php
/* Smarty version 3.1.29, created on 2018-04-25 13:14:12
  from "C:\xampp\htdocs\2017\itassetsvn\itasset\app\webroot\it\templates\list_assign_asset.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5ae031cca73689_28781803',
  'file_dependency' => 
  array (
    '4a99f572b1f1fda1b81c0704ed7fcad9298a3f31' => 
    array (
      0 => 'C:\\xampp\\htdocs\\2017\\itassetsvn\\itasset\\app\\webroot\\it\\templates\\list_assign_asset.tpl',
      1 => 1524642246,
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
function content_5ae031cca73689_28781803 ($_smarty_tpl) {
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
						<h1>Assign Asset</h1>
					</div>
					
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="dashboard.php">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="list_assign_asset.php">List Assign Asset</a>
						</li>
					</ul>
					
				</div>
				<?php if ($_GET['msg']) {?>
				<div id="flashMessage" class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert">&#x2A2F;</button><?php echo $_GET['msg'];?>
</div>					
				<?php }?>
			   <?php if ($_smarty_tpl->tpl_vars['ALERT_MSG']->value) {?>
				 <div id="flashMessage" class="alert alert-success">
				 <button type="button" class="close" data-dismiss="alert">&#x2A2F;</button><?php echo $_smarty_tpl->tpl_vars['ALERT_MSG']->value;?>
</div>					
			   <?php }?>	
			   
				<?php if ($_smarty_tpl->tpl_vars['ERROR_MSG']->value) {?>
					 <div id="flashMessage" class="alert alert-danger">
				 <button type="button" class="close" data-dismiss="alert">&#x2A2F;</button><?php echo $_smarty_tpl->tpl_vars['ERROR_MSG']->value;?>
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
								<h3><i class="icon-list"></i>Assign Asset</h3>
							</div>
							
						

						<form action="list_assign_asset.php" name="" id="formID" class="" method="post" accept-charset="utf-8">							<div class="box-content">
							
						<div class="dataTables_wrapper">
						
				<div class="" id="DataTables_Table_8_filter"  style="padding:15px">
				
				<!--<span>Search:</span>  
				 <input name="keyword" value="<?php echo $_smarty_tpl->tpl_vars['keyword']->value;?>
"  class="input-large" id="keyword" autocomplete="off" placeholder="Search here..." type="text"/>-->
			   <span></span>	
            <?php echo smarty_function_html_options(array('name'=>'emp_name','class'=>"input-xlarge",'placeholder'=>"Employee",'style'=>"clear:left",'id'=>"HrEmployeeRecStatus",'options'=>$_smarty_tpl->tpl_vars['emp_name_drop']->value,'selected'=>$_smarty_tpl->tpl_vars['emp_name']->value),$_smarty_tpl);?>

				<span></span>	
		      <input name="f_date" value="<?php echo $_smarty_tpl->tpl_vars['f_date']->value;?>
" class="input-small datepick" placeholder="From Date" type="text" id="HrEmployeeDob"/> 
	         <input name="t_date" value="<?php echo $_smarty_tpl->tpl_vars['t_date']->value;?>
" class="input-small datepick" placeholder="To Date" type="text" id="HrEmployeeDob"/> 
		      <input type="submit" value="Search" class="btn btn-primary" style="margin-bottom:9px;margin-left:4px;">
            <a href="list_assign_asset.php"><button style="margin-bottom:9px;margin-left:4px;" type="button" val="list_assign_asset.php" class="jsRedirect btn btn-primary"><i class="icon-refresh"></i> Reset</button></a>
            <a href="add_assign_asset.php"><button type="button" val="add_assign_asset.php" class="jsRedirect btn btn-primary" style="float:right"><i class="icon-plus"></i> Assign Asset</button></a>
				<?php if (!$_smarty_tpl->tpl_vars['ALERT_MSG']->value) {?>            
            	<a href="list_assign_asset.php?action=S&keyword=<?php echo $_POST['keyword'];?>
&emp_name=<?php echo $_POST['emp_name'];?>
&f_date=<?php echo $_smarty_tpl->tpl_vars['f_date']->value;?>
&t_date=<?php echo $_smarty_tpl->tpl_vars['t_date']->value;?>
"><button type="button" val="list_assign_asset.php?action=H&keyword=<?php echo $_POST['keyword'];?>
&emp_name=<?php echo $_POST['emp_name'];?>
&f_date=<?php echo $_smarty_tpl->tpl_vars['f_date']->value;?>
&t_date=<?php echo $_smarty_tpl->tpl_vars['t_date']->value;?>
" class="jsRedirect btn btn-primary" style="float:right;margin-right:20px;"><i class="icon-reply"></i> Export Assigned Software </button></a>		           
            	<a href="list_assign_asset.php?action=H&keyword=<?php echo $_POST['keyword'];?>
&emp_name=<?php echo $_POST['emp_name'];?>
&f_date=<?php echo $_smarty_tpl->tpl_vars['f_date']->value;?>
&t_date=<?php echo $_smarty_tpl->tpl_vars['t_date']->value;?>
"><button type="button" val="list_assign_asset.php?action=S&keyword=<?php echo $_POST['keyword'];?>
&emp_name=<?php echo $_POST['emp_name'];?>
&f_date=<?php echo $_smarty_tpl->tpl_vars['f_date']->value;?>
&t_date=<?php echo $_smarty_tpl->tpl_vars['t_date']->value;?>
" class="jsRedirect btn btn-primary" style="float:right;margin-right:20px;"><i class="icon-reply"></i> Export Assigned Hardware </button></a>		
				<?php }?> 				
            </div>			
								
				<table class="table table-hover table-nomargin table-bordered usertable dataTable">
				<thead>
				<tr>	
					<th width="80">
						<a href="list_assign_asset.php?field=emp_name&order=<?php echo $_smarty_tpl->tpl_vars['order']->value;?>
&page=<?php echo $_GET['page'];?>
&keyword=<?php echo $_smarty_tpl->tpl_vars['keyword']->value;?>
&emp_name=<?php echo $_smarty_tpl->tpl_vars['emp_name']->value;?>
&f_date=<?php echo $_smarty_tpl->tpl_vars['f_date']->value;?>
&t_date=<?php echo $_smarty_tpl->tpl_vars['t_date']->value;?>
" class="<?php echo $_smarty_tpl->tpl_vars['sort_field_emp_name']->value;?>
">Employee Name</a></th>
					<th width="80">
						<a href="list_assign_asset.php?field=no_of_sw&order=<?php echo $_smarty_tpl->tpl_vars['order']->value;?>
&page=<?php echo $_GET['page'];?>
&keyword=<?php echo $_smarty_tpl->tpl_vars['keyword']->value;?>
&emp_name=<?php echo $_smarty_tpl->tpl_vars['emp_name']->value;?>
&f_date=<?php echo $_smarty_tpl->tpl_vars['f_date']->value;?>
&t_date=<?php echo $_smarty_tpl->tpl_vars['t_date']->value;?>
" class="<?php echo $_smarty_tpl->tpl_vars['sort_field_no_of_sw']->value;?>
">No.of Software</a></th>
					<th width="80">
						<a href="list_assign_asset.php?field=no_of_hw&order=<?php echo $_smarty_tpl->tpl_vars['order']->value;?>
&page=<?php echo $_GET['page'];?>
&keyword=<?php echo $_smarty_tpl->tpl_vars['keyword']->value;?>
&emp_name=<?php echo $_smarty_tpl->tpl_vars['emp_name']->value;?>
&f_date=<?php echo $_smarty_tpl->tpl_vars['f_date']->value;?>
&t_date=<?php echo $_smarty_tpl->tpl_vars['t_date']->value;?>
" class="<?php echo $_smarty_tpl->tpl_vars['sort_field_no_of_hw']->value;?>
">No.of Hardware</a></th>		
					<th width="80">
						<a href="list_assign_asset.php?field=created&order=<?php echo $_smarty_tpl->tpl_vars['order']->value;?>
&page=<?php echo $_GET['page'];?>
&keyword=<?php echo $_smarty_tpl->tpl_vars['keyword']->value;?>
&emp_name=<?php echo $_smarty_tpl->tpl_vars['emp_name']->value;?>
&f_date=<?php echo $_smarty_tpl->tpl_vars['f_date']->value;?>
&t_date=<?php echo $_smarty_tpl->tpl_vars['t_date']->value;?>
" class="<?php echo $_smarty_tpl->tpl_vars['sort_field_created']->value;?>
">Last Modified </a></th>
						<th width="80">Options</th>
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
					<?php if ($_smarty_tpl->tpl_vars['item']->value['emp_name']) {?>										
					<tr>		
						<td><?php echo $_smarty_tpl->tpl_vars['item']->value['emp_name'];?>
</td> 
						<td><?php echo $_smarty_tpl->tpl_vars['item']->value['no_of_sw'];?>
</td>
						<td><?php echo $_smarty_tpl->tpl_vars['item']->value['no_of_hw'];?>
</td>
						<td><?php echo $_smarty_tpl->tpl_vars['item']->value['created_date'];?>
</td> 
						<td class='hidden-480'>
							<a href="view_assign_asset.php?id=<?php echo $_smarty_tpl->tpl_vars['item']->value['emp_id'];?>
" class="btn" rel="tooltip" title="View"><i class="icon-search"></i></a>
						   <a href="edit_assign_asset.php?id=<?php echo $_smarty_tpl->tpl_vars['item']->value['emp_id'];?>
" class="btn" rel="tooltip" title="Edit"><i class="icon-edit"></i></a>	
							<a href="delete_assign_asset.php?id=<?php echo $_smarty_tpl->tpl_vars['item']->value['emp_id'];?>
&page=<?php echo $_GET['page'];?>
" name="21" onclick="return deletefunction()"	class="btn delRec" rel="tooltip" title="Delete"><i class="icon-remove"></i></a>
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
				<input type="hidden" id="page" value="assign_asset">
				<input type="hidden" id="asset_type" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['asset_type'];?>
">
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
}
}
