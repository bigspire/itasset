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
          <h4 class="modal-title">Remarks</h4>
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
			<form action="remarks.php?id={$smarty.get.id}&page={$smarty.get.page}" id="formID"  method="post" accept-charset="utf-8">
									<div class="space-4"></div>
									<div class="form-group" style="text-align:left">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> Remarks <span class="red"> *</span> </label>
										<div class="col-sm-3">
											<textarea id="remarks" rows="5" cols="45" name="remarks">{$smarty.post.remarks}</textarea>
											<div class="errorMsg error">{$remarksErr}</div>	
										</div>
									</div>												
<div class="clearfix form-actions">
<div class="col-md-9">
<input class="btn btn-info btn-sm" name="submit" value="Submit" id="btnReq" type="submit"/>
</div>
</div>
					
<input type="hidden" value="view_approve_hardware.php?page={$smarty.get.page}&status=moved" class="redirect_url">
<input type="hidden" value="view_approve_hardware.php?page={$smarty.get.page}&status=not_deleted_scrap" class="redirect_url1">
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
});
</script>	
{/literal}
</body>
</html>