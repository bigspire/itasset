<?php
/* Smarty version 3.1.29, created on 2018-02-23 11:58:20
  from "C:\xampp\htdocs\2017\itassetsvn\itasset\app\webroot\it\templates\list_login.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5a8fb484513361_33800292',
  'file_dependency' => 
  array (
    '8868d58a00459eff11ac682230bcb3e7c7f25166' => 
    array (
      0 => 'C:\\xampp\\htdocs\\2017\\itassetsvn\\itasset\\app\\webroot\\it\\templates\\list_login.tpl',
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
function content_5a8fb484513361_33800292 ($_smarty_tpl) {
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
						<h1>Login</h1>
					</div>
					
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="dashboard.php">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						<li>
							<a href="list_login.php">List Login</a>
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
				<?php if ($_smarty_tpl->tpl_vars['SUCCESS_MSG']->value) {?>
					 <div id="flashMessage" class="alert alert-success">
				 <button type="button" class="close" data-dismiss="alert">&#x2A2F;</button><?php echo $_smarty_tpl->tpl_vars['SUCCESS_MSG']->value;?>
</div>					
				<?php }?>
						<div class="row-fluid  footer_div previewDiv" >
					<div class="span12">
						<div class="box box-bordered box-color">
						<div class="box-title">
								<h3><i class="icon-list"></i>Logins</h3>
						</div>
						<form action="list_login.php" name="" id="formID" class="" method="post" accept-charset="utf-8">							<div class="box-content">
							
						<div class="dataTables_wrapper">
						
				<div class="" id="DataTables_Table_8_filter"  style="padding:15px">
				
				<span>Search:</span>  				
				<input name="keyword" value = "<?php echo $_smarty_tpl->tpl_vars['keyword']->value;?>
" class="input-large" id="keyword" autocomplete="off" placeholder="Search here..." type="text"/> 
             <?php echo smarty_function_html_options(array('name'=>'emp_name','class'=>"input-medium",'placeholder'=>"Employee",'style'=>"clear:left",'id'=>"HrEmployeeRecStatus",'options'=>$_smarty_tpl->tpl_vars['emp_name_drop']->value,'selected'=>$_smarty_tpl->tpl_vars['emp_name']->value),$_smarty_tpl);?>
			   
			    <?php echo smarty_function_html_options(array('name'=>'l_status','class'=>"input-medium",'placeholder'=>'','style'=>"clear:left",'id'=>"HrEmployeeRecStatus1",'options'=>$_smarty_tpl->tpl_vars['type']->value,'selected'=>$_smarty_tpl->tpl_vars['l_status']->value),$_smarty_tpl);?>

		 
		     <input type="submit" value="Search" class="btn btn-primary" style="margin-bottom:9px;margin-left:4px;">
           <a href="list_login.php"><button style="margin-bottom:9px;margin-left:4px;" type="button" val="list_login.php" class="jsRedirect btn btn-primary"><i class="icon-refresh"></i> Reset</button></a>
           <a href="add_login.php"><button type="button" val="add_login.php" class="jsRedirect btn btn-primary" style="float:right"><i class="icon-plus"></i> Add Login</button></a>
           <?php if (!$_smarty_tpl->tpl_vars['ALERT_MSG']->value) {?> 
           <a href="list_login.php?action=export&keyword=<?php echo $_POST['keyword'];?>
&emp_name=<?php echo $_POST['emp_name'];?>
&l_status=<?php echo $_smarty_tpl->tpl_vars['l_status']->value;?>
"><button type="button" val="list_login.php?action=export&keyword=<?php echo $_POST['keyword'];?>
&emp_name=<?php echo $_POST['emp_name'];?>
&l_status=<?php echo $_smarty_tpl->tpl_vars['l_status']->value;?>
" class="jsRedirect btn btn-primary" style="float:right;margin-right:20px;"><i class="icon-reply"></i> Export</button></a>				
          <?php }?>
          </div>			
								<table class="table table-hover table-nomargin table-bordered usertable dataTable">
									<thead>	
										<tr>	
										<th width="60">
											<a href="list_login.php?field=employee&order=<?php echo $_smarty_tpl->tpl_vars['order']->value;?>
&page=<?php echo $_GET['page'];?>
&keyword=<?php echo $_smarty_tpl->tpl_vars['keyword']->value;?>
&l_status=<?php echo $_smarty_tpl->tpl_vars['l_status']->value;?>
" class="<?php echo $_smarty_tpl->tpl_vars['sort_field_employee']->value;?>
">Employee</a></th>
										<th width="60">
											<a href="list_login.php?field=login_type&order=<?php echo $_smarty_tpl->tpl_vars['order']->value;?>
&page=<?php echo $_GET['page'];?>
&keyword=<?php echo $_smarty_tpl->tpl_vars['keyword']->value;?>
&l_status=<?php echo $_smarty_tpl->tpl_vars['l_status']->value;?>
" class="<?php echo $_smarty_tpl->tpl_vars['sort_field_login_type']->value;?>
">Login Type</a></th>		
										<th width="60">
											<a href="list_login.php?field=username&order=<?php echo $_smarty_tpl->tpl_vars['order']->value;?>
&page=<?php echo $_GET['page'];?>
&keyword=<?php echo $_smarty_tpl->tpl_vars['keyword']->value;?>
&l_status=<?php echo $_smarty_tpl->tpl_vars['l_status']->value;?>
" class="<?php echo $_smarty_tpl->tpl_vars['sort_field_username']->value;?>
">Username</a></th>
										<th width="60">
											<a href="list_login.php?field=password&order=<?php echo $_smarty_tpl->tpl_vars['order']->value;?>
&page=<?php echo $_GET['page'];?>
&keyword=<?php echo $_smarty_tpl->tpl_vars['keyword']->value;?>
&l_status=<?php echo $_smarty_tpl->tpl_vars['l_status']->value;?>
" class="<?php echo $_smarty_tpl->tpl_vars['sort_field_password']->value;?>
">Password</a></th>
										<th width="60">
											<a href="list_login.php?field=server&order=<?php echo $_smarty_tpl->tpl_vars['order']->value;?>
&page=<?php echo $_GET['page'];?>
&keyword=<?php echo $_smarty_tpl->tpl_vars['keyword']->value;?>
&l_status=<?php echo $_smarty_tpl->tpl_vars['l_status']->value;?>
" class="<?php echo $_smarty_tpl->tpl_vars['sort_field_server']->value;?>
">URL</a></th>
										<th width="60">
											<a href="list_login.php?field=created&order=<?php echo $_smarty_tpl->tpl_vars['order']->value;?>
&page=<?php echo $_GET['page'];?>
&keyword=<?php echo $_smarty_tpl->tpl_vars['keyword']->value;?>
&l_status=<?php echo $_smarty_tpl->tpl_vars['l_status']->value;?>
" class="<?php echo $_smarty_tpl->tpl_vars['sort_field_created']->value;?>
">Created</a></th>										
										<th width="60">
											<a href="list_login.php?field=modified&order=<?php echo $_smarty_tpl->tpl_vars['order']->value;?>
&page=<?php echo $_GET['page'];?>
&keyword=<?php echo $_smarty_tpl->tpl_vars['keyword']->value;?>
&l_status=<?php echo $_smarty_tpl->tpl_vars['l_status']->value;?>
" class="<?php echo $_smarty_tpl->tpl_vars['sort_field_modified']->value;?>
">Modified</a></th>																				
										<th style="text-align:center" width="60">Status</th>
										<th width="60">Options</th>
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
											<td><?php echo ucfirst($_smarty_tpl->tpl_vars['item']->value['title']);?>
</td>
											<td><?php echo $_smarty_tpl->tpl_vars['item']->value['user_name'];?>
</td>
											<td><?php echo $_smarty_tpl->tpl_vars['item']->value['password'];?>
</td>
											<td><?php echo $_smarty_tpl->tpl_vars['item']->value['host'];?>
</td>
							            <td><?php echo $_smarty_tpl->tpl_vars['item']->value['created_date'];?>
</td>
											<td><?php echo $_smarty_tpl->tpl_vars['item']->value['modified_date'];?>
</td>
											<td style="text-align:center"><span class='label label-<?php echo $_smarty_tpl->tpl_vars['item']->value['status_cls'];?>
'><a href='#' rel='tooltip' data-original-title = <?php echo $_smarty_tpl->tpl_vars['item']->value['status'];?>
><?php echo $_smarty_tpl->tpl_vars['item']->value['status'];?>
</a></span></td>
										
												<td class='hidden-480'>
												<a href="edit_login.php?id=<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
" class="btn" rel="tooltip" title="Edit"><i class="icon-edit"></i></a>
												<a href="delete_login.php?id=<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
&page=<?php echo $_GET['page'];?>
" onclick="return deletefunction()" name="21" class="btn delRec" rel="tooltip" title="Delete"><i class="icon-remove"></i></a>
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
							<input type="hidden" id="page" value="login">
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
