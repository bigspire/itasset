<?php
/* Smarty version 3.1.29, created on 2018-04-21 15:18:34
  from "C:\xampp\htdocs\2017\itassetsvn\itasset\app\webroot\it\templates\list_billing.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5adb08f259cee9_48814956',
  'file_dependency' => 
  array (
    'd8a63d00289983df6f87731a049337bc9705e315' => 
    array (
      0 => 'C:\\xampp\\htdocs\\2017\\itassetsvn\\itasset\\app\\webroot\\it\\templates\\list_billing.tpl',
      1 => 1524304104,
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
function content_5adb08f259cee9_48814956 ($_smarty_tpl) {
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
						<h1>Billings</h1>
					</div>
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="dashboard.php">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						<li>
							<a href="list_billing.php">List Billings</a>
						</li>
					</ul>
				</div>
				<?php if ($_smarty_tpl->tpl_vars['ERROR_MSG']->value) {?>
				<div id="flashMessage" class="alert alert-danger">		
				<button type="button" class="close" data-dismiss="alert">&#x2A2F;</button><?php echo $_smarty_tpl->tpl_vars['ERROR_MSG']->value;?>
				
				</div>					
				<?php }?>
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
					<div class="row-fluid  footer_div previewDiv">
					<div class="span12">
						<div class="box box-bordered box-color">
						
						<div class="box-title">
								<h3><i class="icon-list"></i> Hardware Billings</h3>
						</div>
			<form action="list_billing.php" name="" id="formID" class="" method="post" accept-charset="utf-8">							
			<div class="box-content">
			<div class="dataTables_wrapper">		
				<div class="" id="DataTables_Table_8_filter"  style="padding:15px">
				 <span>Search:</span>  
				 <input name="keyword" value="<?php echo $_smarty_tpl->tpl_vars['keyword']->value;?>
" id="keyword" autocomplete="off" placeholder="Search here..." type="text"/>
			    <?php echo smarty_function_html_options(array('name'=>'hw_type','class'=>"input-medium",'placeholder'=>'','style'=>"clear:left",'id'=>"HrEmployeeRecStatus",'options'=>$_smarty_tpl->tpl_vars['hw_type_data']->value,'selected'=>$_smarty_tpl->tpl_vars['hw_type']->value),$_smarty_tpl);?>

				<?php echo smarty_function_html_options(array('name'=>'bill_types','class'=>"input-medium",'placeholder'=>'','style'=>"clear:left",'id'=>"HrEmployeeRecStatus1",'options'=>$_smarty_tpl->tpl_vars['billingType']->value,'selected'=>$_smarty_tpl->tpl_vars['bill_types']->value),$_smarty_tpl);?>

	          <input name="f_date" value="<?php echo $_smarty_tpl->tpl_vars['f_date']->value;?>
" class="input-small datepick" placeholder="Billing From" type="text" id="HrEmployeeDob"/> 
	          <input name="t_date" value="<?php echo $_smarty_tpl->tpl_vars['t_date']->value;?>
" class="input-small datepick" placeholder="Billing To" type="text" id="HrEmployeeDob"/> 
		       <input type="submit" value="Search" class="btn btn-primary" style="margin-bottom:9px;margin-left:4px;">
             <a href="list_billing.php"><button style="margin-bottom:9px;margin-left:4px;" type="button" val="list_billing.php" class="jsRedirect btn btn-primary"><i class="icon-refresh"></i> Reset</button></a>

			 <div class="btn-group" style="margin-bottom:9px;margin-left:4px;" >
												<a href="add_billing_hardware_details.php"  class="btn btn-primary"><i class="icon-plus"></i> Add Billing </a>
											
											</div>
			 
			 
             <?php if (!$_smarty_tpl->tpl_vars['ALERT_MSG']->value) {?> 
             <a href="list_billing.php?action=export&keyword=<?php echo $_POST['keyword'];?>
&hw_type=<?php echo $_POST['hw_type'];?>
&bill_types=<?php echo $_POST['bill_types'];?>
&f_date=<?php echo $_POST['f_date'];?>
&t_date=<?php echo $_POST['t_date'];?>
"><button type="button" val="list_hardware.php?action=export&keyword=<?php echo $_POST['keyword'];?>
&hw_type=<?php echo $_POST['hw_type'];?>
&bill_types=<?php echo $_POST['bill_types'];?>
&f_date=<?php echo $_POST['f_date'];?>
&t_date=<?php echo $_POST['t_date'];?>
" class="jsRedirect btn btn-primary" style="float:right;margin-right:20px;"><i class="icon-reply"></i> Export</button></a>	
            <?php }?>
            </div>			
				<table class="table table-hover table-nomargin table-bordered usertable dataTable">
					<thead>
						<tr>
						<th width="80">
										<a href="list_billing.php?field=type&order=<?php echo $_smarty_tpl->tpl_vars['order']->value;?>
&page=<?php echo $_GET['page'];?>
&keyword=<?php echo $_smarty_tpl->tpl_vars['keyword']->value;?>
&hw_type=<?php echo $_smarty_tpl->tpl_vars['hw_type']->value;?>
&bill_types=<?php echo $_smarty_tpl->tpl_vars['bill_types']->value;?>
&f_date=<?php echo $_smarty_tpl->tpl_vars['f_date']->value;?>
&t_date=<?php echo $_smarty_tpl->tpl_vars['t_date']->value;?>
" class="<?php echo $_smarty_tpl->tpl_vars['sort_field_type']->value;?>
">Type</a></th>
								
							<th width="80">
										<a href="list_billing.php?field=hw_type&order=<?php echo $_smarty_tpl->tpl_vars['order']->value;?>
&page=<?php echo $_GET['page'];?>
&keyword=<?php echo $_smarty_tpl->tpl_vars['keyword']->value;?>
&hw_type=<?php echo $_smarty_tpl->tpl_vars['hw_type']->value;?>
&bill_types=<?php echo $_smarty_tpl->tpl_vars['bill_types']->value;?>
&f_date=<?php echo $_smarty_tpl->tpl_vars['f_date']->value;?>
&t_date=<?php echo $_smarty_tpl->tpl_vars['t_date']->value;?>
" class="<?php echo $_smarty_tpl->tpl_vars['sort_field_hw_type']->value;?>
">Billing Type</a></th>
										<th width="80">
											<a href="list_billing.php?field=brand&order=<?php echo $_smarty_tpl->tpl_vars['order']->value;?>
&page=<?php echo $_GET['page'];?>
&keyword=<?php echo $_smarty_tpl->tpl_vars['keyword']->value;?>
&hw_type=<?php echo $_smarty_tpl->tpl_vars['hw_type']->value;?>
&bill_types=<?php echo $_smarty_tpl->tpl_vars['bill_types']->value;?>
&f_date=<?php echo $_smarty_tpl->tpl_vars['f_date']->value;?>
&t_date=<?php echo $_smarty_tpl->tpl_vars['t_date']->value;?>
" class="<?php echo $_smarty_tpl->tpl_vars['sort_field_brand']->value;?>
">Brand</a></th>		
										<th width="80">
											<a href="list_billing.php?field=inventory_no&order=<?php echo $_smarty_tpl->tpl_vars['order']->value;?>
&page=<?php echo $_GET['page'];?>
&keyword=<?php echo $_smarty_tpl->tpl_vars['keyword']->value;?>
&hw_type=<?php echo $_smarty_tpl->tpl_vars['hw_type']->value;?>
&bill_types=<?php echo $_smarty_tpl->tpl_vars['bill_types']->value;?>
&f_date=<?php echo $_smarty_tpl->tpl_vars['f_date']->value;?>
&t_date=<?php echo $_smarty_tpl->tpl_vars['t_date']->value;?>
" class="<?php echo $_smarty_tpl->tpl_vars['sort_field_inventory_no']->value;?>
">Inventory No</a></th>
										<th width="80">
											<a href="list_billing.php?field=location&order=<?php echo $_smarty_tpl->tpl_vars['order']->value;?>
&page=<?php echo $_GET['page'];?>
&keyword=<?php echo $_smarty_tpl->tpl_vars['keyword']->value;?>
&hw_type=<?php echo $_smarty_tpl->tpl_vars['hw_type']->value;?>
&bill_types=<?php echo $_smarty_tpl->tpl_vars['bill_types']->value;?>
&f_date=<?php echo $_smarty_tpl->tpl_vars['f_date']->value;?>
&t_date=<?php echo $_smarty_tpl->tpl_vars['t_date']->value;?>
" class="<?php echo $_smarty_tpl->tpl_vars['sort_field_location']->value;?>
">Location</a></th>
										
										<th width="80">
											<a href="list_billing.php?field=cost&order=<?php echo $_smarty_tpl->tpl_vars['order']->value;?>
&page=<?php echo $_GET['page'];?>
&keyword=<?php echo $_smarty_tpl->tpl_vars['keyword']->value;?>
&hw_type=<?php echo $_smarty_tpl->tpl_vars['hw_type']->value;?>
&bill_types=<?php echo $_smarty_tpl->tpl_vars['bill_types']->value;?>
&f_date=<?php echo $_smarty_tpl->tpl_vars['f_date']->value;?>
&t_date=<?php echo $_smarty_tpl->tpl_vars['t_date']->value;?>
" class="<?php echo $_smarty_tpl->tpl_vars['sort_field_cost']->value;?>
">Billing amount</a></th>
										
										<th width="80">
											<a href="list_billing.php?field=billing_date&order=<?php echo $_smarty_tpl->tpl_vars['order']->value;?>
&page=<?php echo $_GET['page'];?>
&keyword=<?php echo $_smarty_tpl->tpl_vars['keyword']->value;?>
&hw_type=<?php echo $_smarty_tpl->tpl_vars['hw_type']->value;?>
&bill_types=<?php echo $_smarty_tpl->tpl_vars['bill_types']->value;?>
&f_date=<?php echo $_smarty_tpl->tpl_vars['f_date']->value;?>
&t_date=<?php echo $_smarty_tpl->tpl_vars['t_date']->value;?>
" class="<?php echo $_smarty_tpl->tpl_vars['sort_field_billing_date']->value;?>
">Billing Date</a></th>																				
										<th width="80">
											<a href="list_billing.php?field=vendor_company&order=<?php echo $_smarty_tpl->tpl_vars['order']->value;?>
&page=<?php echo $_GET['page'];?>
&keyword=<?php echo $_smarty_tpl->tpl_vars['keyword']->value;?>
&hw_type=<?php echo $_smarty_tpl->tpl_vars['hw_type']->value;?>
&bill_types=<?php echo $_smarty_tpl->tpl_vars['bill_types']->value;?>
&f_date=<?php echo $_smarty_tpl->tpl_vars['f_date']->value;?>
&t_date=<?php echo $_smarty_tpl->tpl_vars['t_date']->value;?>
" class="<?php echo $_smarty_tpl->tpl_vars['sort_field_vendor_company']->value;?>
">Vendor</a></th>																			
										<th width="60">										
										<a href="list_billing.php?field=created_date&order=<?php echo $_smarty_tpl->tpl_vars['order']->value;?>
&page=<?php echo $_GET['page'];?>
&keyword=<?php echo $_smarty_tpl->tpl_vars['keyword']->value;?>
&hw_type=<?php echo $_smarty_tpl->tpl_vars['hw_type']->value;?>
&bill_types=<?php echo $_smarty_tpl->tpl_vars['bill_types']->value;?>
&f_date=<?php echo $_smarty_tpl->tpl_vars['f_date']->value;?>
&t_date=<?php echo $_smarty_tpl->tpl_vars['t_date']->value;?>
" class="<?php echo $_smarty_tpl->tpl_vars['sort_field_created_date']->value;?>
">Created</a></th>										
																													
										<th width="100">Options</th>
										</tr>
					</thead>
					<tbody>
						<tr>
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
									
									 <td><?php echo ucfirst($_smarty_tpl->tpl_vars['item']->value['type']);?>
</td>
									 <td><?php echo ucfirst($_smarty_tpl->tpl_vars['item']->value['hw_type']);?>
</td>
		        					 <td><?php echo ucfirst($_smarty_tpl->tpl_vars['item']->value['brand']);?>
</td> 
				                <td><?php echo ucfirst($_smarty_tpl->tpl_vars['item']->value['inventory_no']);?>
</td>
		                      <td><?php echo ucfirst($_smarty_tpl->tpl_vars['item']->value['location']);?>
</td> 
							  <td><?php echo $_smarty_tpl->tpl_vars['item']->value['cost'];?>
</td> 
		                      <td><?php echo $_smarty_tpl->tpl_vars['item']->value['billing_date'];?>
</td> 
		                      <td><?php echo ucfirst($_smarty_tpl->tpl_vars['item']->value['vendor_company']);?>
</td> 
		                      <td><?php echo $_smarty_tpl->tpl_vars['item']->value['created_date'];?>
</td>
									 
									 <td class='hidden-480'>
											<a href="view_billing_hardware.php?id=<?php echo $_smarty_tpl->tpl_vars['item']->value['billing_id'];?>
" class="btn" rel="tooltip" title="View"><i class="icon-search"></i></a>
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
														
						</div>	
					 </div>
					 <input type="hidden" id="page" value="list_billing_hardware">
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
