<?php
/* Smarty version 3.1.29, created on 2018-03-26 21:28:09
  from "C:\xampp\htdocs\itassetsvn\itasset\app\webroot\it\templates\company_details.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5ab91891963984_98301478',
  'file_dependency' => 
  array (
    '93a9363afda9987ab42df45b2a9ffee3fb40ab3e' => 
    array (
      0 => 'C:\\xampp\\htdocs\\itassetsvn\\itasset\\app\\webroot\\it\\templates\\company_details.tpl',
      1 => 1513763309,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5ab91891963984_98301478 ($_smarty_tpl) {
?>


<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />	<title>
		Upload Resume - CT Hiring</title>
	   <!-- Bootstrap framework -->
         <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" />
         <link rel="stylesheet" href="bootstrap/css/bootstrap-responsive.min.css" />
       <!-- gebo blue theme-->
         <link rel="stylesheet" href="css/blue.css" id="link_theme" />            
         <!-- main styles -->
         <link rel="stylesheet" href="css/style.css" />
        
	
</head>
<body  class="menu_hover " >
	<div id="container">
		<div id="content">
			<div id="maincontainer" class="clearfix">
			
			<!-- main content -->
            <div id="contentwrapper">
               <div class="main_content" style="min-height:auto;">
            <div class="row-fluid">
				 <div class="span12">
				 
				 <?php if ($_smarty_tpl->tpl_vars['ALERT_MSG']->value) {?>
							<div class="alert alert-info">
								<a class="close" data-dismiss="alert">×</a>
								<?php echo $_smarty_tpl->tpl_vars['ALERT_MSG']->value;?>

							</div>
						<?php }?>
			 		
<form action="upload_resume.php?client_id=<?php echo $_smarty_tpl->tpl_vars['client_id']->value;?>
&req_id=<?php echo $_smarty_tpl->tpl_vars['req_id']->value;?>
" class="formID" id="formID" method="post" enctype="multipart/form-data" accept-charset="utf-8">
<div class="box">
	<div class="row-fluid">
		<div class="span6">
			<table class="table table-hover table-nomargin table-bordered usertable dataTable">
									<thead>
										<tr>
											<th width="150">Company Name</th>
											<th width="150">Contact Person</th>
											<th width="150">Email Id</th>
											<th width="150">Contact Number</th>
											<th width="150">City</th>
											<th width="150">Address</th>								
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
										<tr>
											<td><a href="javascript:void(0)" id="<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
" class="chooseVendor"><?php echo ucfirst($_smarty_tpl->tpl_vars['item']->value['vendor_name']);?>
<a></td>
											<td><?php echo ucfirst($_smarty_tpl->tpl_vars['item']->value['vendor_person']);?>
</td>
											<td><?php echo $_smarty_tpl->tpl_vars['item']->value['vendor_email'];?>
</td> 
											<td><?php echo $_smarty_tpl->tpl_vars['item']->value['vendor_phone'];?>
</td> 	
											<td><?php echo $_smarty_tpl->tpl_vars['item']->value['vendor_address'];?>
</td> 
											<td><?php echo $_smarty_tpl->tpl_vars['item']->value['vendor_city'];?>
</td>    
										</tr>
										
										<input type="hidden" value="<?php echo ucfirst($_smarty_tpl->tpl_vars['item']->value['vendor_name']);?>
" class="" id="company_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
"/>		
										<input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['vendor_person'];?>
" class="" id="person_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
"/>	
										<input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['vendor_email'];?>
" class="" id="email_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
"/>	
										<input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['vendor_phone'];?>
" class="" id="phone_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
"/>	
										<input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['vendor_address'];?>
" class="" id="address_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
"/>	
										<input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['vendor_city'];?>
" class="" id="city_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
"/>	
									

										<input type="hidden" value="add_software_vendor_details.php" class="redirect_url"/>		
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
	</div>
</div>

</form>
  </div>
  </div>
 </div> 
</div>
</div>
</div>
</div>
	 
<?php echo '<script'; ?>
 src="js/jquery.min.js"><?php echo '</script'; ?>
>
		
<input type="hidden" value="add_software_vendor_details.php" class="redirect_url"/>		
<input type="hidden" value="resume.php" class="redirect_url_value"/>	
<!-- main bootstrap js -->
		 

<?php echo '<script'; ?>
 type="text/javascript">
/* show the add page once selected the vendor successfully */
$(document).ready(function(){
    $(".chooseVendor").click(function(){
        var id = jQuery(this).attr('id');		
		parent.jQuery('#company_name').attr('value', jQuery('#company_'+id).val());
		parent.jQuery('#contact_person').attr('value', jQuery('#person_'+id).val());
		parent.jQuery('#company_email').attr('value', jQuery('#email_'+id).val());
		parent.jQuery('#contact_number').attr('value', jQuery('#phone_'+id).val());
		parent.jQuery('#city').attr('value', jQuery('#city_'+id).val());
		parent.jQuery('#address').text(jQuery('#address_'+id).val());		
		parent.jQuery(".modalCloseImg").click();
		parent.$.colorbox.close();
    });
});
<?php echo '</script'; ?>
>	

</body>
</html><?php }
}
