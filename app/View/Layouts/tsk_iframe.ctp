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
	<!-- colorbox -->
	<link rel="stylesheet" href="<?php echo $this->webroot;?>css/plugins/colorbox/colorbox.css">
	<!-- jQuery UI -->
	<link rel="stylesheet" media="screen" href="<?php echo $this->webroot;?>css/plugins/jquery-ui/smoothness/jquery-ui.css">
	<link rel="stylesheet" media="screen" href="<?php echo $this->webroot;?>css/plugins/jquery-ui/smoothness/jquery.ui.theme.css">
	<!-- Theme CSS -->
	<link rel="stylesheet" media="screen"  href="<?php echo $this->webroot;?>css/style.css">
	<!-- Color CSS -->
	<link rel="stylesheet" media="screen" href="<?php echo $this->webroot;?>css/themes.css">	
	<!-- Date picker CSS -->
	<link rel="stylesheet" media="screen" href="<?php echo $this->webroot;?>css/plugins/datepicker/datepicker.css">
		
	<script src="<?php echo $this->webroot;?>js/jquery.min.js"></script>	
	<!-- jQuery UI -->
	<script src="<?php echo $this->webroot;?>js/jquery-ui-1.10.4.custom.min.js"></script>
	<!-- slimScroll -->
	<script src="<?php echo $this->webroot;?>js/plugins/slimscroll/jquery.slimscroll.js"></script>	
	<!-- colorbox -->
	<script src="<?php echo $this->webroot;?>js/plugins/colorbox/jquery.colorbox-min.js"></script>
	<!-- Datepicker -->
	<script src="<?php echo $this->webroot;?>js/plugins/datepicker/bootstrap-datepicker.js"></script>
	<!-- time picker -->
	<script src="<?php echo $this->webroot;?>js/jquery.timepicker.min.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo $this->webroot;?>css/jquery.timepicker.css"/>
	
	
	<script type="text/javascript">
	// function to select the multiple check boxes
	$(document).ready(function() {
		$('.select_all').click(function() {
			var c = this.checked; 
			$('.chkSel:checkbox').attr('checked',c);
		});
		
		$('#date').attr('value',parent.$('#month').val());
		
		// show tooltip for icons	
		$('[rel=tooltip]').tooltip({html:true});
		
		/* when the form submitted */
		$('#formID').submit(function(){ 		
			// Disable the 'Next' button to prevent multiple clicks		
			$('input[type=submit]', this).attr('value', 'Processing...');		
			$('input[type=submit]', this).attr('disabled', 'disabled');
			// hide cancel button
			//$('button[type=button]', this).hide();
			
		});
		
		/* validate change task status */
		$('.edit_task_status').click(function(){ 
			var submit = true;
			var form_field = get_status_validation_fields();
			var valid_msg = get_status_validation_msg();
			for(i = 0; i < form_field.length; i++){ 
				// if empty show the error msg.
				if($('#'+form_field[i]).val() == ''){					
					$('.'+form_field[i]).html(valid_msg[i]);
					submit = false;
				}else if(form_field[i] == 'remainChk' && $('#'+form_field[i]).val() != ''){ 
					$('.'+form_field[i]).html('');
					// validate start and end time
					result = validate_start_end();
					if(result == false){ submit = false;} 
				}else if(form_field[i] == 'postChk' && $('#'+form_field[i]).val() != ''){
					$('.'+form_field[i]).html('');
					// validate start and end time
					result = validate_postponed();
					if(result == false){ submit = false;} 
				}else if($('#'+form_field[i]).val() != ''){
					$('.'+form_field[i]).html('');
				}
			}
			if(submit == true){
				$('.can_btn').hide();
			}			
			return submit;			
		});
		
		// close the confirm msg.
		$('.close').click(function() {
			$('#flashMessage').fadeOut();
		});
		
		// for scrollable in task manager
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
		
		/* function to show comment box */
	$('.commentTsk').click(function(e){ alert('asdfasdf');
		// call ajax to fetch comments
		if($(this).attr('data-original-title') == 'View Comment'){
			// destroy tool tip
			$(this).tooltip('destroy');	
			// load preloader
			img_url = $('#webroot').val()+'img/task_loader.gif'; 					
			$(this).html('<img src="'+img_url+'">');	
			if($(this).attr('mod') != '' && $(this).attr('mod') != undefined){
				action = 'get_lead_comments';
				prefix = '#lead_tk_'
			}else{
				action = 'get_comments';
				prefix = '#tk_'
			}
			$.ajax({
				url: $('#root').val()+action+'/',
				type: "POST",
				data: { id : $(this).attr('val'), status:  $(this).attr('st')}
			}).done(function( html ){				
				// split the output
				response = html.split('||');				
				$(prefix+response[1]).attr('data-original-title', response[0]).tooltip('show');
				$('.tooltip-inner').addClass('alignLeft');
				// restore the html
				$(prefix+response[1]).html('<i class="icon-comment"></i>');				
			});
		}
		
		
	});
		
		// close the color box	
		$('.close_colorBox').click(function(){ 
			reload_tasklist();			
		});
		
		// when edit button is clicked
		$('.edit_tsk_overlay').click(function(){
			parent.location.href = $(this).attr('href');
			return true;
		});
		
		// load the color box
		$('.iframeBox').click(function(){
			load_colorBox(this, $(this).attr('val'));	
		});
		
		// function to change task status
		$('.chgTskStatus').change(function(){
			toggle_change_status($(this).val());
		});
		
		// load the form fields for change status
		if($('#tskSt').length > 0 && $('#tskSt').val != ''){
			toggle_change_status($('#tskSt').val());
		}
		
		// datepicker
		if($('.datepick').length > 0){	
			$('.datepick').datepicker({
				showOtherMonths: true,
				selectOtherMonths: true,
				format: 'dd/mm/yyyy',
				prevText: "",
				nextText: "",
				autoclose:true,
				startDate:$('#start_date').val(),
				endDate:$('#end_date').val(),
				todayHighlight: false,
				orientation:'auto'
			});
		
		}
		
		/* validate start and end */
		$('.status_time').change(function(){		
			// only project task
			if($('#type').val() == 'P'){
				// check for task status
				if($('.chgTskStatus').val() == 'P'){
					start_id = 'post_start';
					end_id = 'post_end';
				}else{
					start_id = 'start_time';
					end_id = 'end_time';
				}
				start = $('#'+start_id).val();
				end = $('#'+end_id).val();
				if(start != '' && end != ''){
					start_date = start.split('/');				
					new_start = new Date(start_date[2]+' '+start_date[1]+ ' '+', '+start_date[0]);
					end_date = end.split('/');				
					new_end = new Date(end_date[2]+' '+end_date[1]+ ' '+', '+end_date[0]);
					// if start date greater than end date
					if(new_start > new_end){
						$('#'+start_id).val('');
						$('#'+end_id).val('');
					}
				}
			}
		});
		
	
			
		/* hide close bt. for change status */
		if($('#changeSt, #viewPlan').length > 0){ 
			parent.$('#cboxClose').hide();
		}
		
		/* show close bt. for remarks */
		if($('#viewRemark').length > 0){ 
			parent.$('#cboxClose').show();
		}
		
		// when the enter key is pressed in reply task
		$('#reply_tsk').on('keydown', function(e){	
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
				}else{
					$('.tskReply').addClass('sh_error');
					return false;
				}
			}		
			
		});
		
		// when the submit button is clicked in reply task
		$('#tskBtn').on('click', function(e){				
				reply = $('#reply_tsk').val();
				valid = validate_tsk('tskReply');
				// if validation success				
				if(valid){					
					$('.tskReply').removeClass('sh_error');
					$(this).hide();
					// load the preloader
					$('.tskLoad').show();
					img_url = $('#root').val()+'img/loading.gif'; 					
					$('.tskLoad').html('<img src="'+img_url+'">');					
					// update the table					
					update_reply_tsk($.trim(reply), $('#webroot').val()+'reply_task/?id='+$('#tsk_id').val());
				}else{
					$('.tskReply').addClass('sh_error');
					return false;
				}
		});	

				
		
		/* time picker */
		if($('.tsk_timepicker').length > 0){
			timePicker();
		}
		
		/* show date or time  */
		if($('#page').length > 0){
			load_task_date($('#type').val());
		}
		
		// datepicker for task manager
		if($('.datepick_tsk').length > 0){	
				call_datepicker();
		}
		
		/* function to approve / reject the request */
		$('.approveRec').on('click', function() {		
			url = $(this).attr("name");		
			height = '170';			
			var buttonsConfig = [
					{
						text: "Yes",
						"class": "btn btn-green",
						click: function() {
							// for adv. approve
							if($('#adv_approve').length > 0){
								if($('#finremarks').val() != '' && $('#finremarks').val() != undefined){
									url = url+'?remark='+$('#finremarks').val();
								}
							}
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
		
	
		
	});
	
	
	function timePicker(){ 
		$('.tsk_timepicker').timepicker({ 'timeFormat': 'h:i A', 'step': 30,'forceRoundTime': true, 'scrollDefaultTime': '09:30 AM'});
	}
	
	/* function to run date picker */
	function call_datepicker(){
		$('.datepick_tsk').datepicker({
				showOtherMonths: true,
				selectOtherMonths: true,
				format: 'dd/mm/yyyy',
				prevText: "",
				startDate:$('#start_date').val(),
				endDate:$('#end_date').val(),
				nextText: "",
				autoclose:true,		
				todayHighlight: false,
				orientation:'auto'
			});
	}
	
	/* function to load task date for type */
	function load_task_date(type){ 
		if(type == 'P'){
				// remove time picker
				$('.tsk_time').removeClass('tsk_timepicker');
				$('.tsk_time').timepicker('remove');
				// add date picker
				$('.tsk_time').addClass('datepick_tsk');
				call_datepicker();			
			}else{
				// remove date picker
				$('.tsk_time').removeClass('datepick_tsk');
				$('.tsk_time').datepicker('remove');
				// add time picker
				$('.tsk_time').addClass('tsk_timepicker');
				timePicker();			
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
			$('#reply_tsk').val('');
			$('.tskSubmit').show();
			$('.replyMsg').html(html);
			$('#tskBtn').show();
			
		});
	}
	

	
	/* function to validate change status */
	function get_status_validation_fields(){
		switch($('.chgTskStatus').val()){
			case 'E':
			valid = new Array('statusChk','commentChk');
			break;
			case 'P':
			valid = new Array('statusChk','reasonChk','postChk');
			break;
			case 'C':
			valid = new Array('statusChk','reasonChk');
			break;
			case 'L':
			valid = new Array('statusChk','commentChk','remainChk');
			break;
			default:
			valid = new Array('statusChk');
			break;
		}
		return valid; 
	}
	
	/* validate start and end time */
	function validate_start_end(){
		time = $('#type').val() == 'P' ? 'date' : 'time';
		if($('#start_time').val() == '' || $('#end_time').val() == ''){
			$('.remainChk').html('Please select the start and end '+time);
			return false;
		}else{
			$('.remainChk').html('');
			return true;
		}
	}
	
	/* validate start and end date for postponed */
	function validate_postponed(){
		time = $('#type').val() == 'P' ? 'date' : 'time';
		if($('#post_start').val() == '' || $('#post_end').val() == ''){
			$('.postChk').html('Please select the start and end '+time);
			return false;
		}else{
			$('.postChk').html('');
			return true;
		}
	}
	
	/* function to show error msg. in status valid */
	function get_status_validation_msg(){
		switch($('.chgTskStatus').val()){
			case 'E':
			valid = new Array('Please select the status', 'Please enter the comment');
			break;
			case 'P':
			valid = new Array('Please select the status', 'Please enter the reason','Please select the postponed date');
			break;
			case 'C':
			valid = new Array('Please select the status', 'Please enter the reason');
			break;
			case 'L':
			valid = new Array('Please select the status', 'Please enter the comment','Please select the completion date');
			break;
			default:
			valid = new Array('Please select the status');
			break;
		}
		return valid;
	}
	
	/* reload the task to get updated */
	function reload_tasklist(){ 
		parent.$('#pageReload').attr('value',$('#pageReload').val());
		parent.$('#date').attr('value',$('#date').val());	
		parent.$('#project').attr('value',$('#project').val());	
		parent.$('#company').attr('value',$('#company').val());	
		parent.$('#type').attr('value',$('#type').val());	
		parent.$('#tsk_moved_date').attr('value',$('#tsk_moved_date').val());	
		parent.$.colorbox.close();	
	}
	
	/* function to validate task form */
	function validate_tsk(id){
		if($.trim($('.'+id).val()) !=''){
			return true;
		}else{
			return false;
		}
	}
	
	
	/* function to toggle change status fields */
	function toggle_change_status(status){
		switch(status){
				case 'E':
				$('.commentBox').show();
				$('.postponeBox').hide();
				$('.remainingBox').hide();
				$('.reasonBox').hide();
				$('#commentChk').val('');
				break;
				case 'L':
				$('.remainingBox').show();
				$('.commentBox').show();
				$('#commentChk').val('');
				$('.postponeBox').hide();
				$('.reasonBox').hide();
				break;
				case 'P':
				$('.commentBox').hide();
				$('.postponeBox').show();
				$('.remainingBox').hide();
				$('.reasonBox').show();
				$('#reasonChk').val('');
				break;
				case 'M':
				case 'C':
				$('.commentBox').hide();
				$('.postponeBox').hide();
				$('.remainingBox').hide();
				$('.reasonBox').show();
				$('#reasonChk').val('');

				break;
			}
	}
	
	
	
		/* function to load the color box */
	function load_colorBox(obj, size){ 
		// email to friends			
		dim = $(obj).attr('val').split('_');
		width = dim[0];
		height = dim[1];		
		
		
		if($('#overlayclose').length > 0){
			over_close = false;
			esc = false;
			$('#cboxClose').show();	
			if($('#overlayclose').val() > 0){
				$('#cboxClose').hide();
			}			
		}else{
			over_close = true;
			esc = true;
		}
		
		
		$(obj).colorbox({iframe:true, rel: 'nofollow',  width:width+'%', height:height+'%',opacity:   '.8', 	  scrolling: true, fixed:true,overlayClose:over_close, escKey: esc,
		onClosed:function(){ 
				if($('#edit_bank_acc').length > 0){
					window.parent.location.reload();
				}
				
				// for my tasks plan
				if($('#pageReload').length > 0){ 
					if($('#pageReload').val() == 1){
						if(check_browser('reload')){
							update_data();
						}
					}
				}
		
			 }
		
		});
	}
	

	
	
		

	
	
	</script>

	</head>
	<body>
<?php echo $this->fetch('content'); ?>
</body>
</html>