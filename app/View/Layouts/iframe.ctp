<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<head>

	<!-- Bootstrap -->
	<link rel="stylesheet" media="screen" href="<?php echo $this->webroot;?>css/bootstrap.css">

	<!-- Bootstrap responsive -->
	<link rel="stylesheet" media="screen" href="<?php echo $this->webroot;?>css/bootstrap-responsive.min.css">

	<!-- jQuery UI -->
	<link rel="stylesheet" media="screen" href="<?php echo $this->webroot;?>css/plugins/jquery-ui/smoothness/jquery-ui.css">
	<link rel="stylesheet" media="screen" href="<?php echo $this->webroot;?>css/plugins/jquery-ui/smoothness/jquery.ui.theme.css">
	<!-- Theme CSS -->
	<link rel="stylesheet" media="screen"  href="<?php echo $this->webroot;?>css/style.css">
	<!-- Color CSS -->
	<link rel="stylesheet" media="screen" href="<?php echo $this->webroot;?>css/themes.css">	
	
	


		
	<script src="<?php echo $this->webroot;?>js/jquery.min.js"></script>	

	<!-- Datepicker -->
	<script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
	
	<!-- slimScroll -->
	<script src="<?php echo $this->webroot;?>js/plugins/slimscroll/jquery.slimscroll.js"></script>	
	
	<!-- Chosen -->
	<?php if($this->request->params['action'] == 'new_project' ): ?>
		<link rel="stylesheet" href="<?php echo $this->webroot;?>css/plugins/chosen/chosen.css">	
		<script src="<?php echo $this->webroot;?>js/plugins/chosen/chosen.jquery.min.js"></script>
	<?php endif; ?>
	
	<?php if($this->request->params['action'] == 'reply'): ?>
	<script src="<?php echo $this->webroot;?>js/jquery.autosize.min.js"></script>
	<?php endif; ?>
	
	<script src="<?php echo $this->webroot;?>js/application.js"></script>

	<style type="text/css">
	.ui-widget-header{color:#222222}
	.ui-datepicker-current-day{background: #AFD4FF;}
	.ui-datepicker-today {background: #AFD4FF;}
	</style>
	<script type="text/javascript">
	// function to select the multiple check boxes
	$(document).ready(function() {
		$('.select_all').click(function() {
			var c = this.checked; alert(c);
			$('.chkSel:checkbox').attr('checked',c);
		});
		
		/* when the form submitted */
		$('#formID').submit(function(){ 		
			// Disable the 'Next' button to prevent multiple clicks		
			$('input[type=submit]', this).attr('value', 'Processing...');		
			$('input[type=submit]', this).attr('disabled', 'disabled');
			// hide cancel button
			//$('button[type=button]', this).hide();
			
		});
		
		// close the confirm msg.
		$('.close').click(function() {
			$('#flashMessage').fadeOut();
		});
		
		// datepicker
		if($('.datepick').length > 0){	
			$('.datepick').datepicker({
				dateFormat: 'dd/mm/yy',			
				autoclose:true,				
				orientation:'auto',
				minDate:$('#start_date').val(),
				maxDate:$('#end_date').val()
			});
		
		}
		
		// update ticket status
		$('.tktAvail').change(function(){ 
			clear_tkt_update();
			if($(this).val() == 'Y'){
				$('.tkt1').show();
				$('.tkt0').hide();
			}else if($(this).val() == 'N'){
				$('.tkt1').hide();
				$('.tkt0').show();
			}
		});
		
		if($('.tktAvail').length > 0){
			if($('.tktAvail').val() == 'Y'){
				$('.tkt1').show();
				$('.tkt0').hide();
			}else if($('.tktAvail').val() == 'N'){
				$('.tkt1').hide();
				$('.tkt0').show();
			}
		}
		
		// for autoresize textbox	
		$('textarea[class*=autosize]').on('focus', function(){ 
			 $(this).autosize({append: "<br>"});
		});
		
		/* to refresh once tkt status added */
		if($('#is_page_reload').length > 0){
			if($('#is_page_reload').val() == 'refresh'){
				parent.$('#cboxClose').remove();
			}
		}
		
		/* hide close bt. for change status */
		if($('#view_roa').length > 0){ 
			parent.$('#cboxClose').hide();
		}
		
		/* to reload the ticket update status */
		$('.tktReload').click(function(){
			parent.$.colorbox.close();	
			window.parent.location.reload();
		});
		
		/* to reload and submit the place form */
		$('.tvlPlaceAdd').click(function(){
			window.parent.document.getElementById("formID").submit();
		});
		
		// close the color box	
		$('.close_colorBox').click(function(){ 
			// reset unread reply
			if($('#view_roa').length > 0){
				id = $(this).attr('rel');
				parent.$('#Read-'+id).remove();
			}
			parent.$.colorbox.close();
			
				
		});
		
		// Chosen (chosen)
		if($('.chosen-select').length > 0)	{
			$('.chosen-select').each(function(){
				var $el = $(this);
				var search = ($el.attr("data-nosearch") === "true") ? true : false,
				opt = {};
				if(search) opt.disable_search_threshold = 9999999;
				$el.chosen(opt);
			});
		}
		
		/* show the booking type */
		$('.tvlBookThro').click(function(){
			if($(this).val() == 'A'){
				$('.'+$(this).attr('rel')).show();
			}else{
				$('.'+$(this).attr('rel')).hide();
			}
		});
		
		if($('.tvlBookThro').length > 0){
			if($('.tvlBookThro:checked').val() == 'A'){
				$('.'+$('.tvlBookThro').attr('rel')).show();
			}else{
				$('.'+$('.tvlBookThro').attr('rel')).hide();
			}
		}
		
		// when the enter key is pressed in reply task
		$('#reply_roa').on('keydown', function(e){	
			var keyCode = e.which || e.keyCode; 
			if(keyCode == 13){	
				reply = $(this).val();
				valid = validate_tsk('tskReply');
				// if validation success				
				if(valid){
					$('.tskReply').removeClass('sh_error');
					$('#tskBtn').hide();
					// load the preloader
					$('.tskLoad').show();
					img_url = $('#root').val()+'img/loading.gif'; 					
					$('.tskLoad').html('<img src="'+img_url+'">');					
					// update the table					
					update_reply_tsk($.trim(reply), $('#webroot').val()+'reply_task/?id='+$('#tsk_id').val());
					$('#tskBtn').show();
				}else{
					$('.tskReply').addClass('sh_error');
					return false;
				}
			}		
			
		});
		
		// for scrollable in task replies
		if($(".scrollable").length > 0){
			$('.scrollable').each(function () {
			var $el = $(this);
			var height = parseInt($el.attr('data-height')),
			vis = ($el.attr("data-visible") == "true") ? true : false,
			start = ($el.attr("data-start") == "bottom") ? "bottom" : "top";
			
			var opt = {
				height: height,
				color: "#666",
				start: start,
				allowPageScroll:true
			};
			if (vis) {
				opt.alwaysVisible = true;
				opt.disabledFadeOut = true;
			}
			$el.slimScroll(opt);
			});
		}
		
		
		/* function to approve / reject the request */
	$('.approveRec').on('click', function() {
		url = $(this).attr("name");		
		// for adva. approve
		if($('#adv_approve').length > 0){
			height = '260'; 						
		}else{
			height = '170';			
		}
		
		
		var buttonsConfig = [
				{
					text: "Yes",
					"class": "btn btn-green",
					click: function() {						
						$(this).html('Processing.. Pls wait..');
						$('.ui-dialog-buttonset').hide();						
						$('#formID').attr('action', url); 
						$('#formID').submit();
					}
				},
				{
					text: "No",
					"class": "btn",
					click: function() {	
						$( this ).dialog( "close" );
					}
				}
			];
		$( "#dialog-confirm" ).dialog({
			resizable: false,
			height: height,
			modal: true,
			buttons: buttonsConfig
		});
	});
	
	/* function to approve / reject the request */
	$('.rejectRec').on('click', function() {
		url = $(this).attr("name");	
		var buttonsConfig = [
				{
					text: "Yes",
					"class": "btn btn-red",
					click: function() {
						remark = $('#remarks').val();
						// validate remarks
						if($.trim(remark) == ''){ 
							$('#remarks').addClass('missing');
							return false;
						}else{
							$('#remarks').removeClass('missing');
						}
						$(this).html('Processing.. Pls wait..');
						$('.ui-dialog-buttonset').hide();
						$('#formID').attr('action', url+'?remark='+remark); 
						$('#formID').submit();
					}
				},
				{
					text: "No",
					"class": "btn",
					click: function() {	
						$( this ).dialog( "close" );
					}
				}
			];		
		$( "#dialog-rej-confirm" ).dialog({
			resizable: false,
			height:260,
			modal: true,
			buttons: buttonsConfig
		});
	});
	
		/* function to confirm the  request */
	$('.confirmRec').on('click', function() {
		url = $(this).attr("name");	
		title = $(this).attr('title');
		// check for team recognition
		if($('#teamRecog').length > 0){
			if($('#teamRecog').val() == 'T'){
				var submit = false;
				$( ".teamSel" ).each(function( index ) {
					if($(this).is(':checked') == true){
						submit = true;
					}
				});
				if(submit == false){
					alert('Please select atleast a employee to set '+title);
					return false;
				}
			}
			
		}
		var buttonsConfig = [
				{
					text: "Yes",
					"class": "btn btn-green",
					click: function() {						
						$(this).html('Processing.. Pls wait..');
						$('.ui-dialog-buttonset').hide();						
						$('#formID').attr('action', url); 
						$('#formID').submit();
					}
				},
				{
					text: "No",
					"class": "btn",
					click: function() {	
						$( this ).dialog( "close" );
					}
				}
			];
		$( "#dialog-confirm-rec" ).dialog({
			resizable: false,
			height: 160,
			modal: true,
			buttons: buttonsConfig
		});
	});
		
		/* close fancybox close */
		if($('.send_ticket').length > 0){	
			parent.$('#cboxClose').remove();
		}
		
		// show tooltip for icons	
		$('[rel=tooltip]').tooltip({html:true});
		
		/* validate add ticket */
		$('.send_ticket').click(function(){ 
			var submit = true;
			var form_field = Array('ticket','book_date','book_via','fare','ref_no','agent_copy');
			var valid_msg =  Array('Please attach the ticket', 'Please select the booking date', 'Please select the booked through','Please enter the ticket fare','Please enter the booking ref. no.');
			for(i = 0; i < form_field.length; i++){ 
				// if empty show the error msg.
			
				if(form_field[i] == 'agent_copy'){					
					result = validate_agent_copy();
					if(result == false){ submit = false;} 
				}else if($('#'+form_field[i]).val() == ''){					
					$('.'+form_field[i]).html(valid_msg[i]);
					submit = false;
				}else if($('#'+form_field[i]).val() != ''){
					$('.'+form_field[i]).html('');
				}
			}
			if(submit == true){
				$('.can_btn').hide();
			}
			return submit;			
		});
		
		// in view page of bd business
		if($('#proposal_done').length > 0 && $('#proposal_done').val() != ''){  
			if($('#proposal_done').val() == 1){
				$('.bizSubmit').hide();
				
			}else{
				$('.bizSubmit').show();
			}
		}
		
		if($('#agreement_sign').length > 0 && $('#agreement_sign').val() != ''){ 
			if($('#agreement_sign').val() == 1){
				$('.agmttNo').show();
				$('.workStartDiv').show();
			}else{
				$('.agmttNo').hide();	
				$('.workStartDiv').hide();				
			}
		}
		
		
		
	});

/* function to clear the ticket update */
function clear_tkt_update(){ 
	$('.clearF').val('');
	$('.clearR').attr('checked', false);
}
/* function to validate agent copy in add ticket */
function validate_agent_copy(){
	if($('.tvlBookThro:checked').val() == 'A'){ 
		if($('#agent_copy').val() == ''){
			$('.agent_copy').html('Please attach agent copy');
			return false;
		}else{
			$('.agent_copy').html('');
			return true;
		}
	}else{
		$('.agent_copy').html('');
		return true;
	}
}
	/* function to validate task form */
	function validate_tsk(id){
		if($.trim($('.'+id).val()) !=''){
			return true;
		}else{
			return false;
		}
	}
		/* function to update task reply */
	function update_reply_tsk(data,url){		
		$.ajax({
			url: url,
			type: "POST",
			 data: { reply : data }
		}).done(function( html ){		
			$('.tskLoad').hide();
			$('#reply_roa').val('');
			$('.tskSubmit').show();
			$('.replyMsg').html(html);
			$('#tskBtn').show();
			
		});
	}
	
	 function UpdateTableHeaders() {
   $(".persist-area").each(function() {
   
       var el             = $(this),
           offset         = el.offset(),
           scrollTop      = $(window).scrollTop(),
           floatingHeader = $(".floatingHeader", this)
       
       if ((scrollTop > offset.top) && (scrollTop < offset.top + el.height())) {
           floatingHeader.css({
            "visibility": "visible"
           });
       } else {
           floatingHeader.css({
            "visibility": "hidden"
           });      
       };
   });
}

// DOM Ready      
$(function() {

	var clonedHeaderRow;

   $(".persist-area").each(function() {
       clonedHeaderRow = $(".persist-header", this);
       clonedHeaderRow
         .before(clonedHeaderRow.clone())
         .css("width", clonedHeaderRow.width())
         .addClass("floatingHeader");
         
   });
   
   $(window)
    .scroll(UpdateTableHeaders)
    .trigger("scroll");
   
});
$(function(){ 
	if($('#messagePage').length > 0){
		parent.$.colorbox.resize({
			Width:$('body').width(),
			innerHeight:$('.modal-dialog').height() + parseInt(100),
		});
		$('.modal-body').css('overflow-y', 'auto');
		$('.modal-body').css('max-height', 'none');
	}
});
</script>

	</head>
	<body>
<?php echo $this->fetch('content'); ?>
</body>
</html>