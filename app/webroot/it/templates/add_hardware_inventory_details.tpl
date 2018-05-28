{* Purpose : To add software details.
   Created : Gayathri
   Date : 15-06-2016 *}
   
	{include file='include/header.tpl'}	
	<div id="page_wrapper">
{include file='include/menu.tpl'}
	

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
					<div class="errorMsg error" id="inventory_noErr_#index#">{$EXIST_MSG}</div>	

				</div>
		</div> 
		<div class="control-group">
			<label for="textfield" class="control-label">Location <span class="red_star"> *</span></label>
			<div class="controls field">
		<select name="state_id_#index#" id="stateid_#index#" class="input-medium std">
		<option value="">Select</option>
		{html_options class="input-medium" placeholder="" style="clear:left"  options=$state selected=$smarty.session['h'][$foo].state_id}
		</select>
		<select name="district_id_#index#" id="district_id_#index#"  class="input-large districtid">
		<option value="">Select</option>
		{for $i = 0; $i < $smarty.session['h'].invcount; $i++}
		{html_options class="input-large" placeholder="" style="clear:left" options=$district_id selected=$smarty.session['h'][$foo].district_id}
		{/for} 
		</select>		
		<div class="errorMsg error" id="stateErr_#index#">{$smarty.session['h'][$foo]['stateErr']} </div>
		</div>
		</div>
		<div class="controls field"> </div>
	</div>
	
	<div class="span6">	
	
	<div class="control-group">
	<label for="password" class="control-label">Serial Number </label>
		<div class="controls field">
			<input name="serial_no_#index#" class="input-xlarge" placeholder="" type="text" id="serial_no_#index#" value="{$smarty.session['h'][$foo].serial_no}"/> 
		</div>
	</div>
   <div class="control-group">
		<label for="textfield" class="control-label">Asset Description <span class="red_star"> *</span></label>
		<div class="controls field">
		<input name="asset_desc_#index#" class="input-xlarge" placeholder="" type="text" id="asset_desc_#index#" value="{$smarty.session['h'][$foo].asset_desc}"/> 
		<!-- input name="asset_desc_#index#" class="input-xlarge checkUnique_asset" placeholder="" type="text" id="asset_desc_#index#" value="{$smarty.session['h'][$foo].asset_desc}"/--> 
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
										{if !empty ($smarty.session['h'].confirm_add)}  									
<!--										<input onclick="return validate_id()" type="submit" id="submit_confirm" name="confirm" value="Confirm" class="btn btn-primary">-->
										<input type="submit" id="submit_confirm" name="confirm" value="Confirm" class="btn btn-primary">
										{/if}	
											<a href="list_hardware.php"><button type="button" val="list_hardware.php" class="jsRedirect btn regCancel" onclick="return cancelfunction()">Cancel</button></a>
											
										</div>
									</div>	
								
							</div>
						</div>
				
						</div>
					<input type="hidden" id="inv_count" name="inv_count" value="{$smarty.session['h'].invcount}">
					<input type="hidden" id="next_hdn" name="next_hdn">
					<input type="hidden" id="confirm_hdn" name="confirm_hdn">
					<input type="hidden" id="previous_hdn" name="previous_hdn">
					
					<!--input type="hidden" id="end_date" value="30/05/2000"-->
					
					</form>					
				</div>
					</div>
		
			</div>		
					
				</div>
	{for $i=0; $i < $smarty.session['h'].invcount; $i++}
		<input type="hidden" id="inventorynodata_{$i}" name="inventorynodata_{$i}" value="{$smarty.session['h'][$i].inventory_no}">
		<input type="hidden" id="statedata_{$i}" name="statedata_{$i}" value="{$smarty.session['h'][$i].state_id}">
		<input type="hidden" id="districtdata_{$i}" name="districtdata_{$i}" value="{$districts[$i]}">
		<input type="hidden" id="districtiddata_{$i}" name="districtiddata_{$i}" value="{$smarty.session['h'][$i].district_id}">
		<input type="hidden" id="serialnodata_{$i}" name="serialnodata_{$i}" value="{$smarty.session['h'][$i].serial_no}">
		<input type="hidden" id="assetdescdata_{$i}" name="assetdescdata_{$i}" value="{$smarty.session['h'][$i].asset_desc}">
		
		<input type="hidden" id="inventoryno_e_{$i}"  value="{$smarty.session['h'][$i].inventory_noErr}">
		<input type="hidden" id="state_e_{$i}" value="{$smarty.session['h'][$i].stateErr}">
		<input type="hidden" id="district_e_{$i}"  value="{$smarty.session['h'][$i].stateErr}">
		<input type="hidden" id="assetdesc_e_{$i}"  value="{$smarty.session['h'][$i].asset_descErr}">
	{/for}
		
{include file='include/footer.tpl'}
</div>
<input type="hidden" value="/" id="css_root">
{include file='include/footer_js.tpl'}

<script type="text/javascript">


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
</script>	