<?php
/* Smarty version 3.1.29, created on 2018-03-26 14:25:37
  from "C:\xampp\htdocs\itassetsvn\itasset\app\webroot\it\templates\edit_assign_asset.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5ab8b58997bee9_88526781',
  'file_dependency' => 
  array (
    '3e1e77d273a84021fea015dc59d33430b92fc8fb' => 
    array (
      0 => 'C:\\xampp\\htdocs\\itassetsvn\\itasset\\app\\webroot\\it\\templates\\edit_assign_asset.tpl',
      1 => 1515758469,
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
function content_5ab8b58997bee9_88526781 ($_smarty_tpl) {
if (!is_callable('smarty_function_html_options')) require_once 'C:\\xampp\\htdocs\\itassetsvn\\itasset\\app\\webroot\\it\\vendor\\smarty-3.1.29\\libs\\plugins\\function.html_options.php';
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
						<h1>Edit Assign Asset</h1>
					</div>
					
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="dashboard.php">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="list_assign_asset.php">Assign Asset</a>
								<i class="icon-angle-right"></i>
						</li>
						<li>
							<a href="edit_assign_asset.php?id=<?php echo $_smarty_tpl->tpl_vars['getid']->value;?>
">Edit Assign Asset</a>
						</li>
					</ul>
				</div>
				<?php if ($_smarty_tpl->tpl_vars['EXIST_MSG']->value) {?>
					 <div id="flashMessage" class="alert alert-error">
				 <button type="button" class="close" data-dismiss="alert">&#x2A2F;</button><?php echo $_smarty_tpl->tpl_vars['EXIST_MSG']->value;?>
</div>					
				<?php }?>
				<div class="row-fluid  footer_div">
					<div class="span12">
					
<form id="formID" class="form-horizontal form-column form-bordered" enctype="multipart/form-data" method="post" accept-charset="utf-8">
<div class="box">
	<div class="box-title">
		<h3><i class="icon-list"></i> Assign Asset Details</h3>
	</div>
	<div class="box-content nopadding">
   <div class="span12" style="border-bottom:none;">
			<div class="control-group">
				<label for="textfield" class="control-label">Employee <span class="red_star"> *</span></label>
					<div class="controls field">
						<select name="app_users_id" id="app_users_id">
							<option value=''>Select</option>
								<?php echo smarty_function_html_options(array('class'=>"input-xlarge",'placeholder'=>'','style'=>"clear:left",'options'=>$_smarty_tpl->tpl_vars['emp_name']->value,'selected'=>$_smarty_tpl->tpl_vars['app_users_id']->value),$_smarty_tpl);?>

						</select>			
				    <div class="errorMsg error"><?php echo $_smarty_tpl->tpl_vars['app_users_idErr']->value;?>
 </div>
					</div>
			</div>
	</div>		
								
	
<div id="sheepAdd">	
<div id="sheepAdd_template">
<div class="box" style="margin-bottom:5px;border-top:1px solid #ddd;clear:left;">

<div class="span6">	
 	<div class="control-group">
        <input type="hidden" id="record_id_#index#" name="record_id_#index#" value="<?php echo $_smarty_tpl->tpl_vars['record_id']->value;?>
">
				<label for="textfield" class="control-label">Asset Type <span class="red_star"> *</span></label> 
			<div class="controls">
				<input type="radio" id="sw_#index#" class="change_asset_type" checked="checked" name="type_#index#"  value="S"> Software
				<input type="radio" id="hw_#index#" class="change_asset_type" name="type_#index#"  value="H"> Hardware
			 <div class="error"><?php echo $_smarty_tpl->tpl_vars['typeE']->value;?>
 </div>
			</div>
	</div>
	<div class="control-group" id="swDiv1_#index#">
		<label for="textfield" class="control-label">Software Type <span class="red_star"> *</span></label>
				<div class="controls field">
					<select name="sw_type_id_#index#" class="swtype input-xlarge"  placeholder="" style="clear:left"  id="sw_type_id_#index#">
						<option value="">Select</option>
							<?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['sw_type']->value,'selected'=>$_smarty_tpl->tpl_vars['sw_type_id']->value),$_smarty_tpl);?>
			
					</select>
				  <div class="errorMsg error" id="swtype_Err_#index#"></div>
				</div>
	</div>
	<div class="control-group dn" id="hwDiv1_#index#">
		<label for="textfield" class="control-label">Hardware Type <span class="red_star"> *</span></label>
		 <div class="controls field">
			<select name="hw_type_id_#index#" class="hwtype input-xlarge" placeholder="" style="clear:left"  id="hw_type_id_#index#">
				<option value="">Select</option>	
					<?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['hw_type']->value,'selected'=>$_smarty_tpl->tpl_vars['hw_type_id']->value),$_smarty_tpl);?>

			</select>	
			<div class="errorMsg error" id="hwtype_Err_#index#"></div>
		 </div>
	</div>
</div>				

<div class="span6" style="border-bottom:1px solid #ddd;">		
       					
	<div class="control-group" id="swDiv2_#index#">
		<label for="password" class="control-label">Edition (Brand)<span class="red_star"> *</span></label>
			<div class="controls">
				<select name="edition_it_id_#index#" tabindex="" class="input-xlarge  checkUnique_edition"  id="edition_it_id_#index#" style="clear:left"> 
					<option value="">Select</option>
				</select>	
				<div class="errorMsg error" id="edition_Err_#index#"></div>	
			</div>
	</div>		
	<div class="control-group dn" id="hwDiv2_#index#">
		<label for="password" class="control-label">Inventory No (Brand)
			<span class="red_star"> *</span></label>
				<div class="controls">
					<select placeholder="" style="clear:left"  name="inventory_it_id_#index#" class="input-xlarge checkUnique" id="inventory_it_id_#index#">
						<option value="">Select</option>
					</select>
					<div class="errorMsg error" id="inventory_Err_#index#"></div>
				</div>
	</div> 

	<!--div class="control-group">
			<label for="textfield" class="control-label">Brand <span class="red_star"> *</span></label> 
			<div class="controls dn" id="hwDiv3_#index#">
				<select name="it_hw_brand_id_#index#" style="clear:left"  placeholder="" class="input-xlarge"  id="it_hw_brand_id_#index#">
						<option value="">Select</option>	
							<?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['hw_brand']->value,'selected'=>$_smarty_tpl->tpl_vars['it_hw_brand_id']->value),$_smarty_tpl);?>

				</select>				
				<div class="errorMsg error" id="hwbrand_Err_#index#"></div>
			</div>
			<div class="controls" id="swDiv3_#index#">
					<select name="it_sw_brand_id_#index#" id="it_sw_brand_id_#index#" class="input-xlarge" placeholder="" style="clear:left">
						<option value="">Select</option>	
						<?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['sw_brand']->value,'selected'=>$_smarty_tpl->tpl_vars['it_sw_brand_id']->value),$_smarty_tpl);?>

					</select>				
				<div class="errorMsg error" id="swbrand_Err_#index#"></div>
			</div>
	</div-->
				<div class="control-group">
				<label for="textfield" class="control-label"> <br></label>
					<div class="controls field">
					</div>
							
					</div>			
</div>


								
<div style="float: left;    clear: left;    margin-top: 5px;    margin-bottom: 5px;">										
<button type="button" id="sheepAdd_remove_current" >
<a><span>Remove</span></a></button>
</div>
							
</div>

</div>


										
<!-- No forms template -->
<div id="sheepAdd_noforms_template">No data</div>


<div id="sheepAdd_controls">
<span id="sheepAdd_add"  style="float:right;margin-top:5px;">
	<button type="button"><a><span>Add Another Asset</span></a></button>
</span>
  <!--span id="sheepAdd_remove_last">
     <button type="button"><a><span>Remove</span></a></button>
  </span-->
</div>


 
</div>

</div>				
									
</div>
						<div class="span12">
						<div class="form-actions">
						<input type="submit" name="submit" value="Submit" class="btn btn-primary">
				        <a href="list_assign_asset.php"><button type="button" val="list_assign_asset.php" class="jsRedirect btn regCancel" onclick="return cancelfunction()">Cancel</button></a>				
						</div>			
						</div>
							<input type="hidden" id="asset_count" name="asset_count" value="<?php echo $_smarty_tpl->tpl_vars['assetCount']->value;?>
">
							<input type="hidden" id="totCount" name="totCount" value="<?php echo $_smarty_tpl->tpl_vars['totCount']->value;?>
">
						</form>	
				</div>
			</div>				
		</div>
	</div>
</div>		
					
<?php
$_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['i']->value = 0;
if ($_smarty_tpl->tpl_vars['i']->value < $_smarty_tpl->tpl_vars['totCount']->value) {
for ($_foo=true;$_smarty_tpl->tpl_vars['i']->value < $_smarty_tpl->tpl_vars['totCount']->value; $_smarty_tpl->tpl_vars['i']->value++) {
?>
	<input type="hidden" id="record_idData_<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
" name="record_idData_<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['record_idData']->value[$_smarty_tpl->tpl_vars['i']->value];?>
">
	<input type="hidden" id="typeData_<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
" name="typeData_<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['typeData']->value[$_smarty_tpl->tpl_vars['i']->value];?>
">
	<?php if ($_smarty_tpl->tpl_vars['typeData']->value[$_smarty_tpl->tpl_vars['i']->value] == 'S') {?>
		<input type="hidden" id="sw_type_idData_<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
" name="sw_type_idData_<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['sw_type_idData']->value[$_smarty_tpl->tpl_vars['i']->value];?>
">
		<input type="hidden" id="edition_it_idData_<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
" name="edition_it_idData_<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
" value='<?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['edition_it_idData']->value[$_smarty_tpl->tpl_vars['i']->value]),$_smarty_tpl);?>
'>
		<input type="hidden" id="editionSelData_<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
" name="editionSelData_<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['edition']->value[$_smarty_tpl->tpl_vars['i']->value];?>
">
		<input type="hidden" id="swtype_Err_Data_<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
"  value="<?php echo $_smarty_tpl->tpl_vars['assetErr']->value[$_smarty_tpl->tpl_vars['i']->value]['sw_typeErr'];?>
">
		<input type="hidden" id="edition_Err_Data_<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
"  value="<?php echo $_smarty_tpl->tpl_vars['assetErr']->value[$_smarty_tpl->tpl_vars['i']->value]['editionErr'];?>
">
	<?php } else { ?>
		<input type="hidden" id="hw_type_idData_<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
" name="hw_type_idData_<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['hw_type_idData']->value[$_smarty_tpl->tpl_vars['i']->value];?>
">
		<input type="hidden" id="inventory_it_idData_<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
" name="inventory_it_idData_<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
" value='<?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['inventory_it_idData']->value[$_smarty_tpl->tpl_vars['i']->value]),$_smarty_tpl);?>
'>
		<input type="hidden" id="inventorySelData_<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
" name="inventorySelData_<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['inventory']->value[$_smarty_tpl->tpl_vars['i']->value];?>
">
		<input type="hidden" id="hwtype_Err_Data_<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
"  value="<?php echo $_smarty_tpl->tpl_vars['assetErr']->value[$_smarty_tpl->tpl_vars['i']->value]['hw_typeErr'];?>
">
		<input type="hidden" id="inventory_Err_Data_<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
"  value="<?php echo $_smarty_tpl->tpl_vars['assetErr']->value[$_smarty_tpl->tpl_vars['i']->value]['inventoryErr'];?>
">
	<?php }?>
		<!-- input type="hidden" id="edition_it_idData_<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
" name="edition_it_idData_<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['edition_it_idData']->value[$_smarty_tpl->tpl_vars['i']->value];?>
"-->
		<!--  type="hidden" id="it_hw_brand_idData_<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
" name="it_hw_brand_idData_<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['it_hw_brand_idData']->value[$_smarty_tpl->tpl_vars['i']->value];?>
"-->
		<!-- input type="hidden" id="inventory_it_idData_<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
" name="inventory_it_idData_<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['inventory_it_idData']->value[$_smarty_tpl->tpl_vars['i']->value];?>
"-->
		<!-- input type="hidden" id="it_sw_brand_idData_<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
" name="it_sw_brand_idData_<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['it_sw_brand_idData']->value[$_smarty_tpl->tpl_vars['i']->value];?>
"-->
		<!-- input type="hidden" id="hwbrand_Err_Data_<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
"  value="<?php echo $_smarty_tpl->tpl_vars['assetErr']->value[$_smarty_tpl->tpl_vars['i']->value]['hw_brandErr'];?>
"-->
		<!-- input type="hidden" id="swbrand_Err_Data_<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
"  value="<?php echo $_smarty_tpl->tpl_vars['assetErr']->value[$_smarty_tpl->tpl_vars['i']->value]['sw_brandErr'];?>
"-->
<?php }
}
?>

<?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:include/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

</div>
<?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:include/footer_js.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>



<?php echo '<script'; ?>
 type="text/javascript">
$(document).ready(function(){
   var sheepAdd = {};
	if($('#sheepAdd').length > 0){ 
	var sheepAdd = $('#sheepAdd').sheepIt({
		   separator: '',
		   allowRemoveLast: true,
		   allowRemoveCurrent: true,
		   allowRemoveAll: true,
		   allowAdd: true,
		   allowAddN: true,
		   maxFormsCount: 10,
		   minFormsCount: 1,
		   iniFormsCount: $('#asset_count').val() ? $('#asset_count').val() : '1',
		   removeLastConfirmation: true,
		   removeCurrentConfirmation: true,
		   removeLastConfirmationMsg: 'Are you sure?',
		   removeCurrentConfirmationMsg: 'Are you sure?',
		   continuousIndex: true,
		   afterAdd: function(source, newForm) {
			  $('#asset_count').attr('value',source.getFormsCount());
			   // check for unique
			  check_for_duplicate();
			  $('.change_asset_type').unbind().change(function(){ 
					var asset_id = $(this).attr('id').split('_');
					var radio_value = $(this).val(); 
					change_asset(asset_id[1],radio_value);	
				});
				
				// fetch the edition
				 $(".swtype").change(function (){
					var type_id = $(this).val();
					 var type_name = $(this).attr('id').split('_');	
					 $.ajax({
						url : "get_edition.php",
						method : "GET",
						dataType: "json",
						data : {swtype : type_id},
						encode  : false
					})
						.done(function (data){ 
							var div_data = '<option value="">Select</option>';
							$.each(data,function (a,y){ 
								div_data +=  "<option value="+a+">"+y+"</option>";
							});
						$('#edition_it_id_'+type_name[3]).empty();
						$('#edition_it_id_'+type_name[3]).html(div_data);
					});
				});	
				
				// fetch the inventory
				 $(".hwtype").change(function (){
					var type_id = $(this).val();
					 var type_name = $(this).attr('id').split('_');	
					
					 $.ajax({
						url : "get_inventory.php",
						method : "GET",
						dataType: "json",
						data : {hwtype : type_id},
						encode  : false
					})
						.done(function (data){
							var div_data = '<option value="">Select</option>';
							$.each(data,function (a,y){ 
								div_data +=  "<option value="+a+">"+y+"</option>";
							});
						$('#inventory_it_id_'+type_name[3]).empty();
						$('#inventory_it_id_'+type_name[3]).html(div_data); 
					});
				});
		   },
		   afterRemoveCurrent: function(source) {		
			  $('#asset_count').attr('value',source.getFormsCount());
		  }
	   });	   
	}
	
	$('.change_asset_type').unbind().change(function(){ 
		var asset_id = $(this).attr('id').split('_');
		var radio_value = $(this).val(); 
		change_asset(asset_id[1],radio_value);	
	});
	
	// function to change the asset type
	function change_asset(asset_id,radio_value){			
		if(radio_value == 'S'){
			$('#swDiv1_'+asset_id).show();
			$('#swDiv2_'+asset_id).show();
			$('#swDiv3_'+asset_id).show();
			$('#hwDiv1_'+asset_id).hide();
			$('#hwDiv2_'+asset_id).hide();
			$('#hwDiv3_'+asset_id).hide();
		}else{
			$('#hwDiv1_'+asset_id).show();
			$('#hwDiv2_'+asset_id).show();
			$('#hwDiv3_'+asset_id).show();
			$('#swDiv1_'+asset_id).hide();
			$('#swDiv2_'+asset_id).hide();
			$('#swDiv3_'+asset_id).hide();
		}
	}
		
		if($('.change_asset_type').length > 0){  
			for(var i = 0; i < $('#asset_count').val(); i++){ 
				if($('#typeData_'+i).val() == 'H'){  
					$('#hwDiv1_'+i).show();
					$('#hwDiv2_'+i).show();
					$('#hwDiv3_'+i).show();
					$('#swDiv1_'+i).hide();
					$('#swDiv2_'+i).hide();
					$('#swDiv3_'+i).hide();				
				}else{
					$('#swDiv1_'+i).show();
					$('#swDiv2_'+i).show();
					$('#swDiv3_'+i).show();
					$('#hwDiv1_'+i).hide();
					$('#hwDiv2_'+i).hide();
					$('#hwDiv3_'+i).hide();
				}
			}
		}	
		
/* function to load assign asset php value into form */
	if($('#sheepAdd').length > 0){
		for(i = 0; i < $('#asset_count').val(); i++){
			if($('#typeData_'+i).length > 0){
				if($('#record_idData_'+i).length > 0){ 
					$('#record_id_'+i).val($('#record_idData_'+i).val());
				}
				if($('#typeData_'+i).val() == 'S'){ 
					$('#sw_'+i).attr("checked", true);
					if($('#sw_type_idData_'+i).length > 0){ 
						$('#sw_type_id_'+i).val($('#sw_type_idData_'+i).val());
					}
					/* if($('#edition_it_idData_'+i).length > 0){
						$('#edition_it_id_'+i).val($('#edition_it_idData_'+i).val()); 
					}*/
					
					if($('#edition_it_idData_'+i).length > 0){ 
						$('#edition_it_id_'+i).html('<option value="">Select</option>'+$('#edition_it_idData_'+i).val());
					}
					// to retain edition
					if($('#editionSelData_'+i).length > 0){
						$('#edition_it_id_'+i).val($('#editionSelData_'+i).val());
					}
					if($('#it_sw_brand_idData_'+i).length > 0){ 
						$('#it_sw_brand_id_'+i).val($('#it_sw_brand_idData_'+i).val());
					}
					// for error messages
					if($('#swbrand_Err_Data_'+i).length > 0){ 
						$('#swbrand_Err_'+i).html($('#swbrand_Err_Data_'+i).val());
					}
					if($('#edition_Err_Data_'+i).length > 0){ 
						$('#edition_Err_'+i).html($('#edition_Err_Data_'+i).val());
					}
					if($('#swtype_Err_Data_'+i).length > 0){ 
						$('#swtype_Err_'+i).html($('#swtype_Err_Data_'+i).val());
					}
				}else{
					$('#hw_'+i).attr("checked", true);						
					if($('#hw_type_idData_'+i).length > 0){
						$('#hw_type_id_'+i).val($('#hw_type_idData_'+i).val()); 
					}					
					if($('#it_hw_brand_idData_'+i).length > 0){ 
						$('#it_hw_brand_id_'+i).val($('#it_hw_brand_idData_'+i).val());
					}					
					/* if($('#inventory_it_idData_'+i).length > 0){
						$('#inventory_it_id_'+i).val($('#inventory_it_idData_'+i).val()); 
					}*/
					
					if($('#inventory_it_idData_'+i).length > 0){
						$('#inventory_it_id_'+i).html('<option value="">Select</option>'+$('#inventory_it_idData_'+i).val());
					}
					// to retain inventory
					if($('#inventorySelData_'+i).length > 0){
						$('#inventory_it_id_'+i).val($('#inventorySelData_'+i).val());
					}
					// for error messages
					if($('#hwtype_Err_Data_'+i).length > 0){ 
						$('#hwtype_Err_'+i).html($('#hwtype_Err_Data_'+i).val());
					}
					if($('#hwbrand_Err_Data_'+i).length > 0){ 
						$('#hwbrand_Err_'+i).html($('#hwbrand_Err_Data_'+i).val());
					}
					if($('#inventory_Err_Data_'+i).length > 0){ 
						$('#inventory_Err_'+i).html($('#inventory_Err_Data_'+i).val());
					}				
				}					
			}		
			
		}
	}
	
	function check_for_duplicate(){
		// for check duplicate inventory field values
		$('select').focusout(function(){
		  enter_field = $(this);
		  var value = '';
		  $('.checkUnique').each(function (index){ 
			// check for empty
			if($(this).val().trim() != ''){
				// assign the value in array
				value += $(this).val()+',';	
			}
		  });
		  // if value is not empty
		  if(value != ''){
			// split the string to get total 
			var split_value = value.split(',');
			total = split_value.length-1;	
			// get unique data		
			var uniqueVals = [];
			$.each(split_value, function(i, el){
				if($.inArray(el, uniqueVals) === -1) uniqueVals.push(el);
			});
			unique = uniqueVals.length-1;
			if(total != unique){
				alert('Oops! You entered duplicate value!');
				$(enter_field).val('')
			}
			return false;		
		  }
		});
		
		// for check duplicate edition field values
		$('select').focusout(function(){
		  enter_field = $(this);
		  var value = '';
		  $('.checkUnique_edition').each(function (index){ 
			// check for empty
			if($(this).val().trim() != ''){
				// assign the value in array
				value += $(this).val()+',';	
			}
		  });
		  // if value is not empty
		  if(value != ''){
			// split the string to get total 
			var split_value = value.split(',');
			total = split_value.length-1;	
			// get unique data		
			var uniqueVals = [];
			$.each(split_value, function(i, el){
				if($.inArray(el, uniqueVals) === -1) uniqueVals.push(el);
			});
			unique = uniqueVals.length-1;
			if(total != unique){
				alert('Oops! You entered duplicate value!');
				$(enter_field).val('')
			}
			return false;		
		  }
		});	
	}
});
<?php echo '</script'; ?>
>	
<?php }
}
