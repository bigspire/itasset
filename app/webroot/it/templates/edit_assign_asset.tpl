{* Purpose : To edit assign asset.
   Created : Gayathri
   Modified : Nikitasa
   Date : 21-06-2016 *}		
		{include file='include/header.tpl'}
	
	<div id="page_wrapper">
	{include file='include/menu.tpl'}	
	
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
							<a href="edit_assign_asset.php?id={$getid}">Edit Assign Asset</a>
						</li>
					</ul>
				</div>
				{if $EXIST_MSG}
					 <div id="flashMessage" class="alert alert-error">
				 <button type="button" class="close" data-dismiss="alert">&#x2A2F;</button>{$EXIST_MSG}</div>					
				{/if}
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
								{html_options class="input-xlarge" placeholder="" style="clear:left" options=$emp_name selected=$app_users_id}
						</select>			
				    <div class="errorMsg error">{$app_users_idErr} </div>
					</div>
			</div>
	</div>		
								
	
<div id="sheepAdd">	
<div id="sheepAdd_template">
<div class="box" style="margin-bottom:5px;border-top:1px solid #ddd;clear:left;">

<div class="span6">	
 	<div class="control-group">
        <input type="hidden" id="record_id_#index#" name="record_id_#index#" value="{$record_id}">
				<label for="textfield" class="control-label">Asset Type <span class="red_star"> *</span></label> 
			<div class="controls">
				<input type="radio" id="sw_#index#" class="change_asset_type" checked="checked" name="type_#index#"  value="S"> Software
				<input type="radio" id="hw_#index#" class="change_asset_type" name="type_#index#"  value="H"> Hardware
			 <div class="error">{$typeE} </div>
			</div>
	</div>
	<div class="control-group" id="swDiv1_#index#">
		<label for="textfield" class="control-label">Software Type <span class="red_star"> *</span></label>
				<div class="controls field">
					<select name="sw_type_id_#index#" class="swtype input-xlarge"  placeholder="" style="clear:left"  id="sw_type_id_#index#">
						<option value="">Select</option>
							{html_options  options=$sw_type selected=$sw_type_id}			
					</select>
				  <div class="errorMsg error" id="swtype_Err_#index#"></div>
				</div>
	</div>
	<div class="control-group dn" id="hwDiv1_#index#">
		<label for="textfield" class="control-label">Hardware Type <span class="red_star"> *</span></label>
		 <div class="controls field">
			<select name="hw_type_id_#index#" class="hwtype input-xlarge" placeholder="" style="clear:left"  id="hw_type_id_#index#">
				<option value="">Select</option>	
					{html_options  options=$hw_type selected=$hw_type_id}
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
							{html_options options=$hw_brand selected=$it_hw_brand_id}
				</select>				
				<div class="errorMsg error" id="hwbrand_Err_#index#"></div>
			</div>
			<div class="controls" id="swDiv3_#index#">
					<select name="it_sw_brand_id_#index#" id="it_sw_brand_id_#index#" class="input-xlarge" placeholder="" style="clear:left">
						<option value="">Select</option>	
						{html_options  options=$sw_brand selected=$it_sw_brand_id}
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
							<input type="hidden" id="asset_count" name="asset_count" value="{$assetCount}">
							<input type="hidden" id="totCount" name="totCount" value="{$totCount}">
						</form>	
				</div>
			</div>				
		</div>
	</div>
</div>		
					
{for $i=0; $i < $totCount; $i++}
	<input type="hidden" id="record_idData_{$i}" name="record_idData_{$i}" value="{$record_idData[$i]}">
	<input type="hidden" id="typeData_{$i}" name="typeData_{$i}" value="{$typeData[$i]}">
	{if $typeData[$i] eq 'S'}
		<input type="hidden" id="sw_type_idData_{$i}" name="sw_type_idData_{$i}" value="{$sw_type_idData[$i]}">
		<input type="hidden" id="edition_it_idData_{$i}" name="edition_it_idData_{$i}" value='{html_options options=$edition_it_idData[$i]}'>
		<input type="hidden" id="editionSelData_{$i}" name="editionSelData_{$i}" value="{$edition[$i]}">
		<input type="hidden" id="swtype_Err_Data_{$i}"  value="{$assetErr[$i]['sw_typeErr']}">
		<input type="hidden" id="edition_Err_Data_{$i}"  value="{$assetErr[$i]['editionErr']}">
	{else}
		<input type="hidden" id="hw_type_idData_{$i}" name="hw_type_idData_{$i}" value="{$hw_type_idData[$i]}">
		<input type="hidden" id="inventory_it_idData_{$i}" name="inventory_it_idData_{$i}" value='{html_options options=$inventory_it_idData[$i]}'>
		<input type="hidden" id="inventorySelData_{$i}" name="inventorySelData_{$i}" value="{$inventory[$i]}">
		<input type="hidden" id="hwtype_Err_Data_{$i}"  value="{$assetErr[$i]['hw_typeErr']}">
		<input type="hidden" id="inventory_Err_Data_{$i}"  value="{$assetErr[$i]['inventoryErr']}">
	{/if}
		<!-- input type="hidden" id="edition_it_idData_{$i}" name="edition_it_idData_{$i}" value="{$edition_it_idData[$i]}"-->
		<!--  type="hidden" id="it_hw_brand_idData_{$i}" name="it_hw_brand_idData_{$i}" value="{$it_hw_brand_idData[$i]}"-->
		<!-- input type="hidden" id="inventory_it_idData_{$i}" name="inventory_it_idData_{$i}" value="{$inventory_it_idData[$i]}"-->
		<!-- input type="hidden" id="it_sw_brand_idData_{$i}" name="it_sw_brand_idData_{$i}" value="{$it_sw_brand_idData[$i]}"-->
		<!-- input type="hidden" id="hwbrand_Err_Data_{$i}"  value="{$assetErr[$i]['hw_brandErr']}"-->
		<!-- input type="hidden" id="swbrand_Err_Data_{$i}"  value="{$assetErr[$i]['sw_brandErr']}"-->
{/for}
{include file='include/footer.tpl'}
</div>
{include file='include/footer_js.tpl'}

{literal}
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
</script>	
{/literal}