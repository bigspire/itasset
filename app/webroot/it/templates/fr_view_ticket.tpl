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
{literal} 
	<script src="js/ace-extra.min.js"></script>
	<script src="js/jquery.min.js"></script>
	
	<!--link rel="stylesheet" media="screen" href="css/plugins/jquery-ui/smoothness/jquery-ui.css"-->	
	
	
	<!--script src="js/jquery-ui-1.10.4.custom.min.js"></script-->
	<script src="js/bootstrap.min.js"></script>
	<script src="js/bootstrap-editable.min.js"></script>
	
	<script src="js/plugins/colorbox/jquery.colorbox-min.js"></script>
	
	<script src="js/jquery.autosize.min.js"></script>
	
	<script src="js/jquery.sheepItPlugin-1.1.1.js"></script>
	
{/literal} 
	
	

	</head>
	<body>


<div class="">
	<div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
       
          <h4 class="modal-title">View Ticket</h4>
        </div><div class="container"></div>
        <div class="">
		
	
		
				 <div class="chgReqFrm" align="center">
		
<div class="" ><div class="" style="display: block;">
												<div class="no-padding">
											
<div class="widget-main">

															<dl id="dt-list-1" style="text-align:left" class="dl-horizontal">
															{foreach from=$data_view_ticket item=item key=key}
																<dt>Subject</dt>
																<dd>{$item.subject}</dd><br>
																<dt>Status</dt>
																<dd>{$item.status}</dd><br>
																<dt>Priority</dt>
																<dd>{$item.priority}</dd><br>
																<dt>Description</dt>
																<dd>{$item.description}</dd><br>
																<dt>Message</dt>
																<dd>{$item.message|ucfirst} {if $item.message} on {else} On{/if} </span> {$item.created_date}</dd><br>
																<dt>Attachment</dt>
																<dd><a href = "fr_view_ticket.php?id={$smarty.get.id}&action=download&file={$item.attach_file}">{$item.attach_file}</a></dd>
																{/foreach}															
															</dl>
														</div>
			
									</div><!-- /widget-main -->
											</div></div>
									</div>
        
		
        </div>
       
      </div>
    </div>
</div>
</body>
</html>