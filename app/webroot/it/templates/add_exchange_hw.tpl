<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

	<!-- Bootstrap -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="css/font-awesome.min.css">		
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300">	
	<!-- colorbox -->
	<link rel="stylesheet" href="css/plugins/colorbox/colorbox.css">	
	<link rel="stylesheet" href="css/ace.min.css">
	<link rel="stylesheet" href="css/ace-rtl.min.css">
	<link rel="stylesheet" href="css/ace-skins.min.css">
	<script src="js/ace-extra.min.js"></script>
	<script src="js/jquery.min.js"></script>	
	<!--link rel="stylesheet" media="screen" href="css/plugins/jquery-ui/smoothness/jquery-ui.css"-->	
	<!--script src="js/jquery-ui-1.10.4.custom.min.js"></script-->
	<script src="js/bootstrap.min.js"></script>
	<script src="js/bootstrap-editable.min.js"></script>	
	<script src="js/plugins/colorbox/jquery.colorbox-min.js"></script>	
	<script src="js/jquery.autosize.min.js"></script>
	<script src="js/custom_validation.js"></script>
	<script src="js/validation.js"></script>
	<script src="js/main.js"></script>
</head>

<body>
<div class="">
	<div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">       
          <h4 class="modal-title">Exchange / Re-Sale Hardware</h4>
        </div><div class="container"></div>
        <div class="">
		{if $ALERT_MSG1}
		<div class="alert alert-danger chgError">
											<button type="button" class="close" data-dismiss="alert">
												<i class="icon-remove"></i>
											</button>
											<strong>
												<i class="icon-remove"></i>
											</strong>
											{$ALERT_MSG1}
											<br>
										</div>
									{/if}	
										{if $ALERT_MSG}
										<div class="alert alert-block alert-success chgSuccess">
											<button type="button" class="close" data-dismiss="alert">
												<i class="icon-remove"></i>
											</button>
											<p>{$ALERT_MSG}</p>								
										</div>
										{/if}
										
										
										
		
<div class="chgReqFrm" align="center">
<div class="" ><div class="" style="display: block;">
		<div class="no-padding">
			<form action="add_exchange_hw.php?id={$smarty.get.id}&page={$smarty.get.page}" id="formID"  method="post" enctype="multipart/form-data" accept-charset="utf-8">
									<div class="space-4"></div>
									<div class="space-4"></div>
									<div class="form-group" style="text-align:left">
									
									
									<div class="box">
									<div class="box-content nopadding">
									<div class="span6" >
										<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> Type <span class="red"> *</span> </label>
										<div class="col-sm-3">
										<input type="radio"  name="hw_type"    {if $smarty.post.hw_type eq 'RS'} checked="checked" {/if} value="RS"> Resale
										<input type="radio"    name="hw_type"  {if $smarty.post.hw_type eq 'EX'} checked="checked" {/if}  value="EX"> Exchange
										<br><div class="errorMsg error">{$hw_typeErr}</div>	<br>
										</div>
										
										<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> Amount <span class="red">*</span> </label>
										<div class="col-sm-3">
										<input type="text"  name="cost" value="{$smarty.post.cost}">
										<br><div class="errorMsg error">{$costErr}</div>
										<br>
										</div>
										
										<!--label class="col-sm-3 control-label no-padding-right" for="form-field-2"> Payment Method <span class="red"> *</span> </label>
										<div class="col-sm-3">
										<input type="radio"  name="pay_type"    {if $smarty.post.pay_type eq 'CQ'} checked="checked" {/if} value="CQ"> Cheque
										<input type="radio"    name="pay_type"  {if $smarty.post.pay_type eq 'CA'} checked="checked" {/if}  value="CA"> Cash
										<input type="radio"    name="pay_type"  {if $smarty.post.pay_type eq 'OT'} checked="checked" {/if}  value="OT"> Online Transfer
										<input type="radio"    name="pay_type"  {if $smarty.post.pay_type eq 'CC'} checked="checked" {/if}  value="CC"> Credit card
										<br><div class="errorMsg error">{$paymentErr}</div>	<br>
										</div>
										
										<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> Payment Date  <span class="red"> *</span> </label>
										<div class="col-sm-3">
										<input type="text"  name="paid_date" class="datepick" value="{$smarty.post.paid_date}">
										<br><div class="errorMsg error">{$amountErr}</div><br>
										</div>

										
										
										<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> Bill No <span class="red"> *</span> </label>
										<div class="col-sm-3">
										<input type="text"  name="bill_no"  value="{$smarty.post.bill_no}"> 
										<br><div class="errorMsg error">{$bill_noErr}</div>	<br>
										</div>
										<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> Bill Attachment <span class="red"> *</span> </label>
										<div class="col-sm-3">
										<input type="file" name="attach_bill" class="upload" id="attach_bill"/>
										<div class="errorMsg error">{$billuploadErr}</div>	<br>
										</div-->
										
										
										<!--span class="red"> *</span--> 
										
										</label>
										
										
										
									<div class="span6">	
										
									
							<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> New Hardware Details </label>
	<div class="col-sm-3">
										<!--select name="hwtype" class="hwtype" id="hwtype">
										<option value="">Hardware Type</option>	
										{html_options options=$hw_type selected=$smarty.post.hwtype}
										</select
										<select name="inventory"  id="inventory">
										<option value="">Inventory No (Brand) </option>
										{html_options options=$h_inventory selected=$smarty.post.inventory} 
										</select>
										-->	
										<textarea id="new_hw" rows="2" cols="45" name="new_hw">{$smarty.post.new_hw}</textarea>

										
										<br><div class="errorMsg error">{$new_hwErr}</div>	<br>
										
										
										</div>
										
										<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> Message <span class="red"> *</span></label>
										<div class="col-sm-3">
										<textarea id="desc" rows="2" cols="45" name="desc">{$smarty.post.desc}</textarea>
										<br><div class="errorMsg error">{$descErr}</div>	<br>
										</div>
										</div>
										<!--label class="col-sm-3 control-label no-padding-right" for="form-field-2"> Company Name <span class="red"> *</span> </label>
										<div class="col-sm-3">
										<input type="text"  name="company"  value="{$smarty.post.company}"> 
										<br><div class="errorMsg error">{$companyErr}</div>	<br>
										</div>
										
											<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> Vendor Email <span class="red"> *</span> </label>
										<div class="col-sm-3">
										<input type="text"  name="email"  value="{$smarty.post.email}"> 
										<br><div class="errorMsg error">{$emailErr}</div>	<br>
										</div>
										
											<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> Vendor Contact No. <span class="red"> *</span> </label>
										<div class="col-sm-3">
										<input type="text"  name="contact"  value="{$smarty.post.contact}"> 
										<br><div class="errorMsg error">{$contactErr}</div>	<br>
										</div>
										
										
											<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> Contact Person <span class="red"> *</span> </label>
										<div class="col-sm-3">
										<input type="text"  name="person"  value="{$smarty.post.person}"> 
										<br><div class="errorMsg error">{$personErr}</div>	<br>
										</div>
										
										
											<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> City <span class="red"> *</span> </label>
										<div class="col-sm-3">
										<input type="text"  name="city"  value="{$smarty.post.city}"> 
										<br><div class="errorMsg error">{$cityErr}</div>	<br>
										</div>
										
											<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> Address <span class="red"> *</span> </label>
										<div class="col-sm-3">
										<textarea type="text"  name="address">{$smarty.post.address}</textarea> 
										<br><div class="errorMsg error">{$addressErr}</div>	<br>
										</div>
										
										
										
										
										</div-->
										
										<div class="space-4"></div>						


										</div>
										

									</div>
									




								</div>
									
								
<div style="clear:both;padding:20px;">
<input class="btn btn-info btn-sm" name="submit" value="Submit" id="btnReq" type="submit"/>
</div>
					
<input type="hidden" value="list_hardware.php?page={$smarty.get.page}&status=moved" class="redirect_url">
<input type="hidden" value="list_hardware.php?page={$smarty.get.page}&status=not_exchange" class="redirect_url1">
								</form>
						
</div></div>
</div>
        </div>
      </div>
    </div>
</div>
{if $form_sent == '1'}
	{literal} 
	<script type="text/javascript">
	/* redirect to hardware page once hardware moved to scrap successfully */
	self.parent.location.href = jQuery('.redirect_url').val();
	parent.jQuery(".modalCloseImg").click();
	parent.$.colorbox.close();
	</script>
	{/literal}
{else if $form_sent == '2'}
	{literal} 
	<script type="text/javascript">
	/* redirect to hardware page once hardware moved to scrap successfully */
	self.parent.location.href = jQuery('.redirect_url1').val();
	parent.jQuery(".modalCloseImg").click();
	parent.$.colorbox.close();
	</script>
	{/literal}

{/if}

{literal}
<script type="text/javascript">
$(".cancel").click(function(){
	parent.$.colorbox.close();
});

$(document).ready(function(){
		/* when the form submitted */
	$('.formID').submit(function(){ 		
		// Disable the 'Next' button to prevent multiple clicks		
		$('input[type=submit]', this).attr('value', 'Processing...');		
		$('input[type=submit]', this).attr('disabled', 'disabled');
		// hide cancel button
		$('button[type=button]', this).hide();
		$('.cancelBtn').hide();
		
	});
	
	// fetch the inventory
	$(".hwtype").change(function (){
		var type_id = $(this).val();
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
			$('#inventory').empty();
			$('#inventory').html(div_data); 
		});
	});
	
});
</script>	
{/literal}
</body>
</html>