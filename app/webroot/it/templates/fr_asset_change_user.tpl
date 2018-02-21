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
       
          <h4 class="modal-title">Change Asset</h4>
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

											<p>
												
												{$ALERT_MSG}
											</p>
									
											
										</div>
										{/if}
		
				 <div class="chgReqFrm" align="center">
		
<div class="" ><div class="" style="display: block;">
												<div class="no-padding">
											
{if !$ALERT_MSG and !$ALERT_MSG1}
			<form action="fr_asset_change_user.php?type={$get_type}" id="formID"  method="post" accept-charset="utf-8">
									<div class="space-4"></div>
									
									

									<div class="space-4"></div>
									<div class="form-group" style="text-align:left">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> Message <span class="red"> *</span> </label>

										<div class="col-sm-3">
											<textarea id="message" rows="5" cols="45" name="message">{$message}</textarea>
											<div class="errorMsg error error0">{$messageErr}</div>
										
										</div>
									</div>
									
<div class="space-4"></div>
									
									
									
									
<div class="clearfix form-actions">
<input type="hidden" id="" value="{$smarty.get.id}" name="sw_id">
<input type="hidden" id="" value="{$smarty.get.inv_id}" name="hw_id">
<input type="hidden" id="change_req" value="submit" name="submit">
										<div class="col-md-9">
											<input  onclick="return validate_change_asset_user()" rel="PE" class="btn btn-info btn-sm" name="sub" value="Submit" id="btnReq" type="submit"/>
										</div>
									</div>
									
									
									
									
									<input type="hidden" value="PE" id="type">
								</form>
								{/if}
									</div><!-- /widget-main -->
											</div></div>
									</div>
        
		
        </div>
       
      </div>
    </div>
</div>
</body>
{if $form_sent == '1'}
	{literal} 
	<script type="text/javascript">
	$(document).ready(function(){
		window.parent.$('#fr_home').val('success');
	});
	</script>
	{/literal}
{/if}
</html>