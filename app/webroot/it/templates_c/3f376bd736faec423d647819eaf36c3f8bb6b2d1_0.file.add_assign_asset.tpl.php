<?php
/* Smarty version 3.1.29, created on 2018-01-05 15:10:24
  from "/var/www/html/ceo_apps_it/app/webroot/it/templates/add_assign_asset.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5a4f4808aa33a6_11452216',
  'file_dependency' => 
  array (
    '3f376bd736faec423d647819eaf36c3f8bb6b2d1' => 
    array (
      0 => '/var/www/html/ceo_apps_it/app/webroot/it/templates/add_assign_asset.tpl',
      1 => 1515145223,
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
function content_5a4f4808aa33a6_11452216 ($_smarty_tpl) {
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
						<h1>Add Assign Asset</h1>
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
							<a href="add_assign_asset.php">Add Assign Asset</a>
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
						<select name="employee" id="employee">
							<option value="">Select</option>
								<?php echo smarty_function_html_options(array('class'=>"input-xlarge",'placeholder'=>'','style'=>"clear:left",'options'=>$_smarty_tpl->tpl_vars['emp_name']->value,'selected'=>$_smarty_tpl->tpl_vars['employee']->value),$_smarty_tpl);?>

						</select>			
				    <div class="errorMsg error"><?php echo $_smarty_tpl->tpl_vars['employeeErr']->value;?>
 </div>
					</div>
			</div>
	</div>									
		
<div id="sheepAdd" >	
<div id="sheepAdd_template">
<div class="box" style="margin-bottom:5px;border-top:1px solid #ddd;clear:left;">

<div class="span6">	

 <div class="control-group">
        
										<label for="textfield" class="control-label">Asset Type <span class="red_star"> *</span></label> 
										
										<div class="controls">
<input type="radio" id="sw_#index#" class="change_asset_type" checked="checked" name="asset_type_#index#"  value="S"> Software
<input type="radio" id="hw_#index#" class="change_asset_type"  name="asset_type_#index#"  value="H"> Hardware
				
										  <div class="error"><?php echo $_smarty_tpl->tpl_vars['asset_typeE']->value;?>
 </div>
										  
										 </div>
										</div>
										<div class="control-group " id="swDiv1_#index#">
											<label for="textfield" class="control-label">Software Type <span class="red_star"> *</span></label>
											<div class="controls field">
											<select name="swtype_#index#" id="swtype_#index#" class="swtype input-xlarge" placeholder="" style="clear:left">
										<option value="">Select</option>
												<?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['sw_type']->value,'selected'=>$_smarty_tpl->tpl_vars['swtype']->value),$_smarty_tpl);?>
			
										</select>
				                  <div class="errorMsg error" id="swtype_Err_#index#"></div>
										</div>
										</div>
										


										<div class="control-group dn" id="hwDiv1_#index#">
											<label for="textfield" class="control-label">Hardware Type <span class="red_star"> *</span></label>
											
											<div class="controls field">
											<select name="hwtype_#index#" id="hwtype_#index#" class="hwtype input-xlarge" placeholder="" style="clear:left" >
										<option value="">Select</option>	
											<?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['hw_type']->value),$_smarty_tpl);?>

										</select>			
				                  <div class="errorMsg error" id="hwtype_Err_#index#"></div>
										</div>
										</div>
							</div>				

<div class="span6" style="border-bottom:1px solid #ddd;">		
       					
				
													
								<div class="control-group" id="swDiv2_#index#">
											<label for="password" class="control-label">Edition (Brand)<span class="red_star"> *</span></label>
											<div class="controls">
										<!--select name="edition_#index#" id="edition_#index#" class="input-xlarge checkUnique_edition" placeholder="" style="clear:left">
										<option value="">Select</option>	
												<?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['s_edition']->value),$_smarty_tpl);?>
 
										</select-->
										<select name="edition_#index#" tabindex="" class="input-xlarge  checkUnique_edition"  id="edition_#index#" style="clear:left"> 
										<option value="">Select</option>
										</select>
										<div class="errorMsg error" id="edition_Err_#index#"></div></div>
										</div>		
											<div class="control-group dn" id="hwDiv2_#index#">
											
											<label for="password" class="control-label">Inventory No (Brand)
											<span class="red_star"> *</span></label>
											<div class="controls">
											<select name="inventory_#index#"  id="inventory_#index#" class="input-xlarge checkUnique" placeholder="" style="clear:left">
										<option value="">Select</option>
												<?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['h_inventory']->value),$_smarty_tpl);?>
 
											</select>
 <div class="errorMsg error" id="inventory_Err_#index#"></div>
											</div>
										</div> 
										
										<div class="control-group">
				<label for="textfield" class="control-label"> <br></label>
					<div class="controls field">
									
					</div>
			</div>
			
										<!-- div class="control-group">
									<label for="textfield" class="control-label">Brand <span class="red_star"> *</span></label> 

										<div class="controls dn" id="hwDiv3_#index#">
										<select name="hwbrand_#index#" id="hwbrand_#index#" class="input-xlarge" placeholder="" style="clear:left">
										<option value="">Select</option>	
												<?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['hw_brand']->value),$_smarty_tpl);?>

										</select>				
				 <div class="errorMsg error" id="hwbrand_Err_#index#"></div>
				
				
										</div>
											<div class="controls" id="swDiv3_#index#">
										<select name="swbrand_#index#" id="swbrand_#index#" class="input-xlarge" placeholder="" style="clear:left">
										<option value="">Select</option>	
												<?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['sw_brand']->value),$_smarty_tpl);?>

										</select>				
				 <div class="errorMsg error" id="swbrand_Err_#index#"></div>
										</div>
										</div-->
						
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
										

<input type="hidden" id="asset_count" name="asset_count" value="<?php echo $_smarty_tpl->tpl_vars['assetCount']->value;?>
">

		
						<div class="span12">
						<div class="form-actions">
						<input type="submit" name="next" value="Submit" class="btn btn-primary">
				        <a href="list_assign_asset.php"><button type="button" val="list_assign_asset.php" class="jsRedirect btn regCancel" onclick="return cancelfunction()">Cancel</button></a>
											
						</div>
									
						</div>
						
						</form>	
						
						</div>
						</div>
					
									
				</div>
					</div>
		
			</div>		
			
<?php
$_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['i']->value = 0;
if ($_smarty_tpl->tpl_vars['i']->value < $_POST['asset_count']) {
for ($_foo=true;$_smarty_tpl->tpl_vars['i']->value < $_POST['asset_count']; $_smarty_tpl->tpl_vars['i']->value++) {
?>
		<input type="hidden" id="asset_typeData_<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
" name="asset_typeData_<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['asset_typeData']->value[$_smarty_tpl->tpl_vars['i']->value];?>
">
		<input type="hidden" id="swtypeData_<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
" name="swtypeData_<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['swtypeData']->value[$_smarty_tpl->tpl_vars['i']->value];?>
">
		<input type="hidden" id="hwtypeData_<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
" name="hwtypeData_<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['hwtypeData']->value[$_smarty_tpl->tpl_vars['i']->value];?>
">
		<input type="hidden" id="editionData_<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
" name="editionData_<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
" value='<?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['editionData']->value[$_smarty_tpl->tpl_vars['i']->value]),$_smarty_tpl);?>
'>
		<input type="hidden" id="editionSelData_<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
" name="editionSelData_<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['edition']->value[$_smarty_tpl->tpl_vars['i']->value];?>
">
		<!-- input type="hidden" id="editionData_<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
" name="editionData_<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['editionData']->value[$_smarty_tpl->tpl_vars['i']->value];?>
"-->
		<input type="hidden" id="hwbrandData_<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
" name="hwbrandData_<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['hwbrandData']->value[$_smarty_tpl->tpl_vars['i']->value];?>
">
		<input type="hidden" id="inventoryData_<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
" name="inventoryData_<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
" value='<?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['inventoryData']->value[$_smarty_tpl->tpl_vars['i']->value]),$_smarty_tpl);?>
'>
		<input type="hidden" id="inventorySelData_<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
" name="inventorySelData_<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['inventory']->value[$_smarty_tpl->tpl_vars['i']->value];?>
">
		<!-- input type="hidden" id="inventoryData_<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
" name="inventoryData_<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['inventoryData']->value[$_smarty_tpl->tpl_vars['i']->value];?>
"-->
		<input type="hidden" id="swbrandData_<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
" name="swbrandData_<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['swbrandData']->value[$_smarty_tpl->tpl_vars['i']->value];?>
">
		
		<input type="hidden" id="hwtype_Err_Data_<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
"  value="<?php echo $_smarty_tpl->tpl_vars['assetErr']->value[$_smarty_tpl->tpl_vars['i']->value]['hw_typeErr'];?>
">
		<input type="hidden" id="hwbrand_Err_Data_<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
"  value="<?php echo $_smarty_tpl->tpl_vars['assetErr']->value[$_smarty_tpl->tpl_vars['i']->value]['hw_brandErr'];?>
">
		<input type="hidden" id="inventory_Err_Data_<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
"  value="<?php echo $_smarty_tpl->tpl_vars['assetErr']->value[$_smarty_tpl->tpl_vars['i']->value]['inventoryErr'];?>
">
		<input type="hidden" id="swtype_Err_Data_<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
"  value="<?php echo $_smarty_tpl->tpl_vars['assetErr']->value[$_smarty_tpl->tpl_vars['i']->value]['sw_typeErr'];?>
">
		<input type="hidden" id="edition_Err_Data_<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
"  value="<?php echo $_smarty_tpl->tpl_vars['assetErr']->value[$_smarty_tpl->tpl_vars['i']->value]['editionErr'];?>
">
		<input type="hidden" id="swbrand_Err_Data_<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
"  value="<?php echo $_smarty_tpl->tpl_vars['assetErr']->value[$_smarty_tpl->tpl_vars['i']->value]['sw_brandErr'];?>
">

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
					// alert(asset_id);
					//alert(radio_value);
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
						$('#edition_'+type_name[1]).empty();
						$('#edition_'+type_name[1]).html(div_data); 
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
						$('#inventory_'+type_name[1]).empty();
						$('#inventory_'+type_name[1]).html(div_data); 
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
		// alert(asset_id);
		// alert(radio_value);
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
				if($('#asset_typeData_'+i).val() == 'H'){ 
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
			if($('#asset_typeData_'+i).length > 0){
				if($('#asset_typeData_'+i).val() == 'S'){ 
					$('#sw_'+i).attr("checked", true);
					if($('#swtypeData_'+i).length > 0){ 
						$('#swtype_'+i).val($('#swtypeData_'+i).val());
					}
					/*if($('#editionData_'+i).length > 0){
						$('#edition_'+i).val($('#editionData_'+i).val()); 
					}*/
					
					if($('#editionData_'+i).length > 0){ 
						$('#edition_'+i).html('<option value="">Select</option>'+$('#editionData_'+i).val());
					}
					// to retain edition
					if($('#editionSelData_'+i).length > 0){
						$('#edition_'+i).val($('#editionSelData_'+i).val());
					}
					
					if($('#swbrandData_'+i).length > 0){
						$('#swbrand_'+i).val($('#swbrandData_'+i).val()); 
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
					if($('#hwtypeData_'+i).length > 0){
						$('#hwtype_'+i).val($('#hwtypeData_'+i).val());				
					}			
					/*if($('#inventoryData_'+i).length > 0){ 
						$('#inventory_'+i).val($('#inventoryData_'+i).val());
					}*/
					if($('#inventoryData_'+i).length > 0){
						$('#inventory_'+i).html('<option value="">Select</option>'+$('#inventoryData_'+i).val());
					}
					// to retain edition
					if($('#inventorySelData_'+i).length > 0){
						$('#inventory_'+i).val($('#inventorySelData_'+i).val());
					}
					if($('#hwbrandData_'+i).length > 0){ 
						$('#hwbrand_'+i).val($('#hwbrandData_'+i).val());
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
