<?php
/* Smarty version 3.1.29, created on 2018-03-26 19:29:16
  from "C:\xampp\htdocs\itassetsvn\itasset\app\webroot\it\templates\add_hardware_inventory_details.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5ab8fcb42b43b2_84882153',
  'file_dependency' => 
  array (
    '63d8a1e15e2f841ef5cc77a2cd41f4f60ba801cf' => 
    array (
      0 => 'C:\\xampp\\htdocs\\itassetsvn\\itasset\\app\\webroot\\it\\templates\\add_hardware_inventory_details.tpl',
      1 => 1479213600,
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
function content_5ab8fcb42b43b2_84882153 ($_smarty_tpl) {
if (!is_callable('smarty_function_html_options')) require_once 'C:\\xampp\\htdocs\\itassetsvn\\itasset\\app\\webroot\\it\\vendor\\smarty-3.1.29\\libs\\plugins\\function.html_options.php';
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
						<h1>Create Hardware</h1>
					</div>
					
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="dashboard.php">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="list_hardware.php">Hardware</a>
								<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="add_hardware_inventory_details.php">Add Hardware</a>
						</li>
					</ul>
					
				</div>
	   

					
					<div class="row-fluid  footer_div">
	
					
					<div class="span12">
					
								<form action="add_hardware_inventory_details.php" method="POST" class="form-horizontal form-column form-bordered form-wizard ui-formwizard" id="formID" novalidate="novalidate">
									<div class="step ui-formwizard-content" id="firstStep" style="width:99%;margin-top:20px;">
										<ul class="wizard-steps steps-4">
												<li class="">
												<div class="single-step">
													<span class="title">
														1</span>
													<span class="circle">
													</span>
													<span class="description">
																				Hardware Details 		
																		</span>
												</div>
											</li>
										
											
				<li class="active">
												<div class="single-step">
													<span class="title">
														2</span>
													<span class="circle">
														<span class="active"></span>
													</span>
													<span class="description">
																						Inventory Details 		
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
																					Pricing Details 		
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
																						Vendor Details	
																				</span>
												</div>
											</li>
											
											<li class="">
												<div class="single-step">
													<span class="title">
														5</span>
													<span class="circle">
													</span>
													<span class="description">
																						Confirm 		
																				</span>
												</div>
											</li>
																					</ul>
									</div>
								
															
									
									
						<div class="box">
							<div class="box-title">
								<h3><i class="icon-list"></i> Inventory Details</h3>
							</div>
							
						
							<div class="box-content nopadding">							

<div id="sheepAdd">	
<div id="sheepAdd_template">
<div class="box" style="margin-bottom:5px;border-top:1px solid #ddd;clear:left;">
	<div class="span6">

		<div class="control-group">
			<label for="textfield" class="control-label">Inventory No <span class="red_star"> *</span></label>
				<div class="controls field">
					<input name="inventory_no_#index#" class="input-xlarge checkUnique" placeholder="" type="text" id="inventory_no_#index#" /> 
					<div class="errorMsg error" id="inventory_noErr_#index#"><?php echo $_smarty_tpl->tpl_vars['EXIST_MSG']->value;?>
</div>	

				</div>
		</div> 
		<div class="control-group">
			<label for="textfield" class="control-label">Location <span class="red_star"> *</span></label>
			<div class="controls field">
		<select name="state_id_#index#" id="stateid_#index#" class="input-medium std">
		<option value="">Select</option>
		<?php echo smarty_function_html_options(array('class'=>"input-medium",'placeholder'=>'','style'=>"clear:left",'options'=>$_smarty_tpl->tpl_vars['state']->value,'selected'=>$_SESSION['h'][$_smarty_tpl->tpl_vars['foo']->value]['state_id']),$_smarty_tpl);?>

		</select>
		<select name="district_id_#index#" id="district_id_#index#"  class="input-large districtid">
		<option value="">Select</option>
		<?php
$_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['i']->value = 0;
if ($_smarty_tpl->tpl_vars['i']->value < $_SESSION['h']['invcount']) {
for ($_foo=true;$_smarty_tpl->tpl_vars['i']->value < $_SESSION['h']['invcount']; $_smarty_tpl->tpl_vars['i']->value++) {
?>
		<?php echo smarty_function_html_options(array('class'=>"input-large",'placeholder'=>'','style'=>"clear:left",'options'=>$_smarty_tpl->tpl_vars['district_id']->value,'selected'=>$_SESSION['h'][$_smarty_tpl->tpl_vars['foo']->value]['district_id']),$_smarty_tpl);?>

		<?php }
}
?>
 
		</select>		
		<div class="errorMsg error" id="stateErr_#index#"><?php echo $_SESSION['h'][$_smarty_tpl->tpl_vars['foo']->value]['stateErr'];?>
 </div>
		</div>
		</div>
		<div class="controls field"> </div>
	</div>
	
	<div class="span6">	
	
	<div class="control-group">
	<label for="password" class="control-label">Serial Number </label>
		<div class="controls field">
			<input name="serial_no_#index#" class="input-xlarge" placeholder="" type="text" id="serial_no_#index#" value="<?php echo $_SESSION['h'][$_smarty_tpl->tpl_vars['foo']->value]['serial_no'];?>
"/> 
		</div>
	</div>
   <div class="control-group">
		<label for="textfield" class="control-label">Asset Description <span class="red_star"> *</span></label>
		<div class="controls field">
		<input name="asset_desc_#index#" class="input-xlarge checkUnique_asset" placeholder="" type="text" id="asset_desc_#index#" value="<?php echo $_SESSION['h'][$_smarty_tpl->tpl_vars['foo']->value]['asset_desc'];?>
"/> 
		<div class="errorMsg error" id="asset_descErr_#index#"></div>	
		</div>
	</div>
	<div class="controls field"> </div>
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
   <span id="sheepAdd_add"  style="float:right;margin-top:5px;margin-right: 15px;margin-bottom:0px;">
<button type="button"><a><span>Add Another Inventory Details</span></a></button>
  </span>
</div>

</div>
					<div class="span12">
							
										<div class="form-actions">
										<input onclick="" type="submit" id="submit_previous" class="btn" id="submit_previous" name="previous" value="Previous">
<!--										<input onclick="return validate_id()" type="submit" id="submit_next" name="next" value="Next" class="btn btn-primary">-->
										<input type="submit" id="submit_next" name="next" value="Next" class="btn btn-primary">
										<?php if (!empty($_SESSION['h']['confirm_add'])) {?>  									
<!--										<input onclick="return validate_id()" type="submit" id="submit_confirm" name="confirm" value="Confirm" class="btn btn-primary">-->
										<input type="submit" id="submit_confirm" name="confirm" value="Confirm" class="btn btn-primary">
										<?php }?>	
											<a href="list_hardware.php"><button type="button" val="list_hardware.php" class="jsRedirect btn regCancel" onclick="return cancelfunction()">Cancel</button></a>
											
										</div>
									</div>	
								
							</div>
						</div>
				
						</div>
					<input type="hidden" id="inv_count" name="inv_count" value="<?php echo $_SESSION['h']['invcount'];?>
">
					<input type="hidden" id="next_hdn" name="next_hdn">
					<input type="hidden" id="confirm_hdn" name="confirm_hdn">
					<input type="hidden" id="previous_hdn" name="previous_hdn">
					
					<!--input type="hidden" id="end_date" value="30/05/2000"-->
					
					</form>					
				</div>
					</div>
		
			</div>		
					
				</div>
	<?php
$_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['i']->value = 0;
if ($_smarty_tpl->tpl_vars['i']->value < $_SESSION['h']['invcount']) {
for ($_foo=true;$_smarty_tpl->tpl_vars['i']->value < $_SESSION['h']['invcount']; $_smarty_tpl->tpl_vars['i']->value++) {
?>
		<input type="hidden" id="inventorynodata_<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
" name="inventorynodata_<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
" value="<?php echo $_SESSION['h'][$_smarty_tpl->tpl_vars['i']->value]['inventory_no'];?>
">
		<input type="hidden" id="statedata_<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
" name="statedata_<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
" value="<?php echo $_SESSION['h'][$_smarty_tpl->tpl_vars['i']->value]['state_id'];?>
">
		<input type="hidden" id="districtdata_<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
" name="districtdata_<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['districts']->value[$_smarty_tpl->tpl_vars['i']->value];?>
">
		<input type="hidden" id="districtiddata_<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
" name="districtiddata_<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
" value="<?php echo $_SESSION['h'][$_smarty_tpl->tpl_vars['i']->value]['district_id'];?>
">
		<input type="hidden" id="serialnodata_<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
" name="serialnodata_<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
" value="<?php echo $_SESSION['h'][$_smarty_tpl->tpl_vars['i']->value]['serial_no'];?>
">
		<input type="hidden" id="assetdescdata_<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
" name="assetdescdata_<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
" value="<?php echo $_SESSION['h'][$_smarty_tpl->tpl_vars['i']->value]['asset_desc'];?>
">
		
		<input type="hidden" id="inventoryno_e_<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
"  value="<?php echo $_SESSION['h'][$_smarty_tpl->tpl_vars['i']->value]['inventory_noErr'];?>
">
		<input type="hidden" id="state_e_<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
" value="<?php echo $_SESSION['h'][$_smarty_tpl->tpl_vars['i']->value]['stateErr'];?>
">
		<input type="hidden" id="district_e_<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
"  value="<?php echo $_SESSION['h'][$_smarty_tpl->tpl_vars['i']->value]['stateErr'];?>
">
		<input type="hidden" id="assetdesc_e_<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
"  value="<?php echo $_SESSION['h'][$_smarty_tpl->tpl_vars['i']->value]['asset_descErr'];?>
">
	<?php }
}
?>

		
<?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:include/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

</div>
<input type="hidden" value="/" id="css_root">
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
		   iniFormsCount: $('#inv_count').val() ? $('#inv_count').val() : '1',
		   removeLastConfirmation: true,
		   removeCurrentConfirmation: true,
		   removeLastConfirmationMsg: 'Are you sure?',
		   removeCurrentConfirmationMsg: 'Are you sure?',
		   continuousIndex: true,
		   afterAdd: function(source, newForm){
			  $('#inv_count').attr('value',source.getFormsCount());
			  // check for unique
			  check_for_duplicate();
			  // for fetch districts
				$(".std").change(function (){
					var statname = $(this).val();
		 			var stat_id = $(this).attr('id').split('_');
		 			//alert(statname);
				   $.ajax({
						url : "get_district.php?state="+statname,
						method : "GET",
						dataType: "json",		
						encode  : false
					})
					.done(function (data){
						//alert(data);
						var div_data = '<option value="">Select</option>';
						$.each(data,function (a,y){ 
							div_data +=  "<option value="+a+">"+y+"</option>";
           			});
            		$('#district_id_'+stat_id[1]).empty();
            		$('#district_id_'+stat_id[1]).html(div_data); 
			 		});
				});
		   },
		   afterRemoveCurrent: function(source){		
			  $('#inv_count').attr('value',source.getFormsCount());
		  }
	   });	   
	}
	
/* function to load assign asset php value into form */
	if($('#sheepAdd').length > 0){
		for(i = 0; i < $('#inv_count').val(); i++){
			if($('#inventorynodata_'+i).length > 0){ 
				$('#inventory_no_'+i).val($('#inventorynodata_'+i).val());
			}
			if($('#statedata_'+i).length > 0){ 
				$('#stateid_'+i).val($('#statedata_'+i).val());
			}
			
			if($('#districtdata_'+i).length > 0){
				var dist = '';
				var dist = $('#districtdata_'+i).val().split('|');
				// selected district value 
				var distval = $('#districtiddata_'+i).val();
				dist.pop();
				var list = '<option value="">Select</option>';
				$.each( dist, function( index, value ){ 
					var option_val = value.split('-');
					if(option_val[0] == distval){
						list += '<option value="'+option_val[0]+'"selected>'+option_val[1]+'</option>';
					}else{
						list += '<option value="'+option_val[0]+'">'+option_val[1]+'</option>';						
					}
				});
				$('#district_id_'+i).html(list); 
			}
			if($('#serialnodata_'+i).length > 0){
				$('#serial_no_'+i).val($('#serialnodata_'+i).val()); 
			}
			if($('#assetdescdata_'+i).length > 0){ 
				$('#asset_desc_'+i).val($('#assetdescdata_'+i).val());
			}		
			// for error messages
			if($('#assetdesc_e_'+i).length > 0){ 
				$('#asset_descErr_'+i).html($('#assetdesc_e_'+i).val());
			}
			if($('#state_e_'+i).length > 0){ 
				$('#stateErr_'+i).html($('#state_e_'+i).val());
			}
			if($('#district_e_'+i).length > 0){ 
				$('#stateErr_'+i).html($('#district_e_'+i).val());
			}
			if($('#inventoryno_e_'+i).length > 0){ 
				$('#inventory_noErr_'+i).html($('#inventoryno_e_'+i).val());
			}
		}
	}
	
	// for fetch districts
	$(".std").change(function (){
		var statname = $(this).val();
		 var stat_id = $(this).attr('id').split('_');
		 //alert(statname);
		 $.ajax({
			url : "get_district.php?state="+statname,
			method : "GET",
			dataType: "json",		
			encode  : false
		})
			.done(function (data){
				//alert(data);
				var div_data = '<option value="">Select</option>';
				$.each(data,function (a,y){ 
				div_data +=  "<option value="+a+">"+y+"</option>";
           });
           //alert(div_data);	
            $('#district_id_'+stat_id[1]).empty();
            $('#district_id_'+stat_id[1]).html(div_data); 
			 });
	});
	
	function check_for_duplicate(){
		// for check duplicate inventory field values
		$('input').focusout(function(){
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
		
		// for check duplicate asset field values
		$('input').focusout(function(){
		  enter_field = $(this);
		  var value = '';
		  $('.checkUnique_asset').each(function (index){ 
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
>	<?php }
}
