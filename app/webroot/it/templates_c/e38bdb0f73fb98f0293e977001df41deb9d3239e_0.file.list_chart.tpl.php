<?php
/* Smarty version 3.1.29, created on 2018-03-03 12:02:44
  from "C:\xampp\htdocs\2017\itassetsvn\itasset\app\webroot\it\templates\list_chart.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5a9a418ccf3c70_63815641',
  'file_dependency' => 
  array (
    'e38bdb0f73fb98f0293e977001df41deb9d3239e' => 
    array (
      0 => 'C:\\xampp\\htdocs\\2017\\itassetsvn\\itasset\\app\\webroot\\it\\templates\\list_chart.tpl',
      1 => 1519292829,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:include/header.tpl' => 2,
    'file:include/menu.tpl' => 2,
    'file:include/footer.tpl' => 1,
    'file:include/footer_js.tpl' => 1,
    'file:include/dashboard_js.tpl' => 1,
  ),
),false)) {
function content_5a9a418ccf3c70_63815641 ($_smarty_tpl) {
?>



	<?php if ($_GET['display'] == '') {?>
	<?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:include/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
		
	<div id="page_wrapper">
	<?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:include/menu.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
		
<?php } elseif ($_GET['display'] == 'hide') {?>
<div style='display:none'>
	<?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:include/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
		

	<?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:include/menu.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

</div>
<?php }?>
	<div id="page_wrapper">
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
				   <?php if ($_smarty_tpl->tpl_vars['SUCCESS_MSG']->value) {?>
					<div class="alert alert-info" role="alert"> 
					<?php echo $_smarty_tpl->tpl_vars['SUCCESS_MSG']->value;?>

			      </div>
			   <?php }?>
					<div class="pull-left">
						<h1>List chart</h1>						
					</div>
					
				</div>
			<div class="row-fluid footer_div" id="pcontent" >
					
		<form action="" name="" id="formID" class="" method="post" accept-charset="utf-8">
							<div class="errorMsg error"><?php echo $_smarty_tpl->tpl_vars['checkbox_error']->value;?>
 </div>		
							<br>
					<div class="span5 bdBox">
										<table class="table table-hover table-nomargin table-bordered usertable dataTable">
									<thead>
										<tr>
											<th style="text-align:center">Chart</th>
											<th style="text-align:center">Show</th>
											<th style="text-align:center">Order</th>
										</tr>
									</thead>
									<tbody>
										<tr>
										 <td>Software By Type</td>

										 <td style="text-align:center;"><input type="checkbox" name="graph[]" value="1" <?php if ($_smarty_tpl->tpl_vars['graph_1']->value) {?> checked <?php }?>></td> 
		                         <td style="text-align:center;"><input type="text" name="order_1" value="<?php echo $_smarty_tpl->tpl_vars['order_1']->value;?>
" style="width:70px;height:30px;"></td>	
				                 </tr>
  										<tr>
										 <td>Software By Edition</td>
		        					<td style="text-align:center;"><input type="checkbox" name="graph[]" value="2" <?php if ($_smarty_tpl->tpl_vars['graph_2']->value) {?> checked <?php }?>></td> 
		                         <td style="text-align:center;"><input type="text" name="order_2" value="<?php echo $_smarty_tpl->tpl_vars['order_2']->value;?>
" style="width:70px;height:30px;"></td>	
				                 </tr>
 										<tr>
										 <td>Assigned Software By Edition</td>
		        					<td style="text-align:center;"><input type="checkbox" name="graph[]" value="3" <?php if ($_smarty_tpl->tpl_vars['graph_3']->value) {?> checked <?php }?>></td> 
		                        <td style="text-align:center;"><input type="text" 	name="order_3" value="<?php echo $_smarty_tpl->tpl_vars['order_3']->value;?>
" style="width:70px;height:30px;"></td>	 	
				                 </tr>
 										<tr>
										 <td>Unassigned Software By Edition</td>
		        					<td style="text-align:center;"><input type="checkbox" name="graph[]" value="4" <?php if ($_smarty_tpl->tpl_vars['graph_4']->value) {?> checked <?php }?>></td> 
		                        <td style="text-align:center;"><input type="text" name="order_4" value="<?php echo $_smarty_tpl->tpl_vars['order_4']->value;?>
" style="width:70px;height:30px;"></td>		
				                 </tr>
 										<tr>
										 <td>Hardware By Type</td>
		        					<td style="text-align:center;"><input type="checkbox" name="graph[]" value="5" <?php if ($_smarty_tpl->tpl_vars['graph_5']->value) {?> checked <?php }?>></td> 
		                         <td style="text-align:center;"><input type="text" name="order_5" value="<?php echo $_smarty_tpl->tpl_vars['order_5']->value;?>
" style="width:70px;height:30px;"></td>		
				                 </tr>
 										<tr>
										 <td>Hardware By Brand</td>
		        						 <td style="text-align:center;"><input type="checkbox" name="graph[]" value="6" <?php if ($_smarty_tpl->tpl_vars['graph_6']->value) {?> checked <?php }?>></td> 
		                          <td style="text-align:center;"><input type="text" name="order_6" value="<?php echo $_smarty_tpl->tpl_vars['order_6']->value;?>
" style="width:70px;height:30px;"></td>	
				                 </tr>
										<tr>
										 <td>Assigned Hardware By Brand</td>
		        						<td style="text-align:center;"><input type="checkbox" name="graph[]" value="7" <?php if ($_smarty_tpl->tpl_vars['graph_7']->value) {?> checked <?php }?>></td> 
		                          <td style="text-align:center;"><input type="text" name="order_7" value="<?php echo $_smarty_tpl->tpl_vars['order_7']->value;?>
" style="width:70px;height:30px;"></td>	
				                 </tr>
  										<tr>
										 <td>Unassigned Hardware By Brand</td>
		        						 <td style="text-align:center;"><input type="checkbox" name="graph[]" value="8" <?php if ($_smarty_tpl->tpl_vars['graph_8']->value) {?> checked <?php }?>></td> 
		                          <td style="text-align:center;"><input type="text" name="order_8" value="<?php echo $_smarty_tpl->tpl_vars['order_8']->value;?>
" style="width:70px;height:30px;"></td>	
				                 </tr>
										<tr>
										 <td>Tickets</td>
		        						<td style="text-align:center;"><input type="checkbox" name="graph[]" value="9" <?php if ($_smarty_tpl->tpl_vars['graph_9']->value) {?> checked <?php }?>></td> 
		                         <td style="text-align:center;"><input type="text" name="order_9" value="<?php echo $_smarty_tpl->tpl_vars['order_9']->value;?>
" style="width:70px;height:30px;"></td>	
				                 </tr>
  										<tr>
										 <td>Request Change</td>
		        						<td style="text-align:center;"><input type="checkbox" name="graph[]" value="10" <?php if ($_smarty_tpl->tpl_vars['graph_10']->value) {?> checked <?php }?>></td> 
		                        <td style="text-align:center;"><input type="text" name="order_10" value="<?php echo $_smarty_tpl->tpl_vars['order_10']->value;?>
" style="width:70px;height:30px;"></td>	
				                 </tr>
				               </tbody>
								</table>
							<input type="submit" value="Save" class="btn btn-primary" style="margin-bottom:4px;margin-left:4px;">
					 </div>
					
					
			
					 
	 </form>
			</div>
			</div>
		</div>
		</div>
<!--	<?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:include/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
-->
	</div>
	<input type="hidden" value="/" id="css_root">
	<?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:include/footer_js.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>


	<?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:include/dashboard_js.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
