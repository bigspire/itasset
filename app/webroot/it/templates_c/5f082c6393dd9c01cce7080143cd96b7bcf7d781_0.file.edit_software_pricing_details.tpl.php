<?php
/* Smarty version 3.1.29, created on 2018-04-19 15:56:40
  from "C:\xampp\htdocs\2017\itassetsvn\itasset\app\webroot\it\templates\edit_software_pricing_details.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5ad86ee0609db7_65595542',
  'file_dependency' => 
  array (
    '5f082c6393dd9c01cce7080143cd96b7bcf7d781' => 
    array (
      0 => 'C:\\xampp\\htdocs\\2017\\itassetsvn\\itasset\\app\\webroot\\it\\templates\\edit_software_pricing_details.tpl',
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
function content_5ad86ee0609db7_65595542 ($_smarty_tpl) {
if (!is_callable('smarty_function_html_options')) require_once 'C:\\xampp\\htdocs\\2017\\itassetsvn\\itasset\\app\\webroot\\it\\vendor\\smarty-3.1.29\\libs\\plugins\\function.html_options.php';
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
						<h1>Edit Software</h1>
					</div>
					
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="dashboard.php">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="list_software.php">Software</a>
								<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="edit_software_pricing_details.php?id=<?php echo $_smarty_tpl->tpl_vars['getid']->value;?>
">Edit Software</a>
						</li>
					</ul>
					
				</div>
				
								
				
					
					<div class="row-fluid  footer_div">
					
					
					<div class="span12">
					
								<form action="edit_software_pricing_details.php?id=<?php echo $_smarty_tpl->tpl_vars['getid']->value;?>
" enctype="multipart/form-data" method="POST" class="form-horizontal form-column form-bordered form-wizard ui-formwizard" id="formID" novalidate="novalidate">
									<div class="step ui-formwizard-content" id="firstStep" style="width:99%;margin-top:20px;">
										<ul class="wizard-steps steps-4">
												<li class="">
												<div class="single-step">
													<span class="title">
														1</span>
													<span class="circle">
													</span>
													<span class="description">
													<a href="edit_software_details.php?id=<?php echo $_smarty_tpl->tpl_vars['getid']->value;?>
">Software Details</a> 		
																		</span>
												</div>
											</li>
										
											
											<li class="active">
												<div class="single-step">
													<span class="title">
														2</span>
													<span class="circle">
													</span>
													<span class="description">
																					Pricing Details 		
																				</span>
												</div>
											</li>
											
																				
											<li class="">
												<div class="single-step">
													<span class="title">
														3</span>
													<span class="circle">
													</span>
													<span class="description">
													<a href="edit_software_vendor_details.php?id=<?php echo $_smarty_tpl->tpl_vars['getid']->value;?>
">Vendor Details</a> 		
																				</span>
												</div>
											</li>
											
											<li class="">
												<div class="single-step">
													<span class="title">
														4</span>
													<span class="circle">
													</span>
													<span class="description">
													<a href="edit_software_confirmation.php?id=<?php echo $_smarty_tpl->tpl_vars['getid']->value;?>
">Confirm</a> 		
																				</span>
												</div>
											</li>
																					</ul>
									</div>
								
								
						
									
									
						<div class="box">
							<div class="box-title">
								<h3><i class="icon-list"></i> Pricing Details</h3>
							</div>
							
						
							<div class="box-content nopadding">
								
								
								
								
								
									<div class="span6">
									
										<div class="control-group">
											<label for="textfield" class="control-label">Amount <span class="red_star"> *</span></label>
											<div class="controls field">
												<input name="amount" class="input-medium" placeholder="" type="text" id="amount" value="<?php echo $_SESSION['s']['amount'];?>
"/>
<div class="spaError errorMsg error" tyle="width:170px;"><?php echo $_smarty_tpl->tpl_vars['amountErr']->value;
echo $_smarty_tpl->tpl_vars['amountE']->value;?>
</div>
<?php echo smarty_function_html_options(array('name'=>'currency_type','class'=>"input-small",'placeholder'=>'','style'=>"clear:left",'id'=>"currency_type",'options'=>$_smarty_tpl->tpl_vars['currency_types']->value,'selected'=>$_SESSION['s']['currency_type']),$_smarty_tpl);?>
													
											
											
											
											<div class="errorMsg error"  style="margin-left:170px;"><?php echo $_smarty_tpl->tpl_vars['currency_typeErr']->value;?>
</div>
										</div>
										</div>
										
																					
									<div class="control-group">
											<label for="textfield" class="control-label">Paid By <span class="red_star"> *</span></label>
											<div class="controls field">
		
<?php echo smarty_function_html_options(array('name'=>'paid_mode','class'=>"input-xlarge",'placeholder'=>'','style'=>"clear:left",'id'=>"paid_by",'options'=>$_smarty_tpl->tpl_vars['paid_modes']->value,'selected'=>$_SESSION['s']['paid_mode']),$_smarty_tpl);?>
	
<div class="errorMsg error"><?php echo $_smarty_tpl->tpl_vars['paid_byErr']->value;?>
</div>

											</div>
										</div>
									
										
	<div class="control-group">
											<label for="password" class="control-label">Bill No<span class="red_star"> *</span></label>
											<div class="controls">
                      				<input name="bill_no" class="input-medium" placeholder="" type="text" id="bill_no" value="<?php echo $_SESSION['s']['bill_no'];?>
"/>
											<div class="error"><?php echo $_smarty_tpl->tpl_vars['bill_noErr']->value;?>
</div>
											</div>
						</div>
								
									</div>
									
							

<div class="span6">		

	<div class="control-group">
											<label for="password" class="control-label">Purchase Date </label>
											<div class="controls field">
												<input name="purchase_date" class="input-medium datepick" placeholder="" type="text" id="purchase_date" value="<?php echo $_SESSION['s']['purchase_date'];?>
"/>  
											</div>
										</div>

	<div class="control-group">
											<label for="password" class="control-label">Paid Date </label>
											<div class="controls field">
												<input name="paid_date" class="input-medium datepick" placeholder="" type="text" id="paid_date" value="<?php echo $_SESSION['s']['paid_date'];?>
"/>  
											</div>
										</div>
										<div class="control-group">
											<label for="password" class="control-label">Attach Bill </label>
											<div class="controls">
                      				<input type="file" name="attach_bill"  class="upload" id="attach_bill"/>
											<div class="error"><?php echo $_smarty_tpl->tpl_vars['billuploadErr']->value;?>
</div>
											</div>
						</div>
						</div>
								
</div>


										
										
							<div class="span12">
										<div class="form-actions">
										<input type="submit" id="submit_previous" class="btn" name="previous" value="Previous">
										<input onclick="return validate_pd()" type="submit" id="submit_next" name="next" value="Next" class="btn btn-primary">  									
<!--										<input type="submit" id="submit_next" name="next" value="Next" class="btn btn-primary">  									-->
									   <input onclick="return validate_pd()" type="submit" id="submit_confirm" name="confirm" value="Confirm" class="btn btn-primary">
<!--									   <input type="submit" id="submit_confirm" name="confirm" value="Confirm" class="btn btn-primary">-->
										<a href="list_software.php"><button type="button" val="list_software.php" class="jsRedirect btn regCancel" onclick="return cancelfunction()">Cancel</button></a>
											
										</div>
									</div>	
								
							</div>
						</div>
				


									
							
							
						</div>
					<input type="hidden" id="next_hdn" name="next_hdn">
					<input type="hidden" id="confirm_hdn" name="confirm_hdn">
					<input type="hidden" id="previous_hdn" name="previous_hdn">
					
					<!--input type="hidden" id="end_date" value="30/05/2000"-->
					
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
?>


<?php }
}
