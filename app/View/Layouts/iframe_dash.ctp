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
	<link href="<?php echo $this->webroot;?>css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo $this->webroot;?>css/font-awesome.min.css">		
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300">
	
	<!-- colorbox -->
	<link rel="stylesheet" href="<?php echo $this->webroot;?>css/plugins/colorbox/colorbox.css">
	
	<link rel="stylesheet" href="<?php echo $this->webroot;?>css/ace.min.css">
	<link rel="stylesheet" href="<?php echo $this->webroot;?>css/ace-rtl.min.css">
	<link rel="stylesheet" href="<?php echo $this->webroot;?>css/ace-skins.min.css">

	<script src="<?php echo $this->webroot;?>js/ace-extra.min.js"></script>
	<script src="<?php echo $this->webroot;?>js/jquery.min.js"></script>
	
	<!--link rel="stylesheet" media="screen" href="<?php echo $this->webroot;?>css/plugins/jquery-ui/smoothness/jquery-ui.css"-->	
	
	
	<!--script src="<?php echo $this->webroot;?>js/jquery-ui-1.10.4.custom.min.js"></script-->
	<script src="<?php echo $this->webroot;?>js/bootstrap.min.js"></script>
	<script src="<?php echo $this->webroot;?>js/bootstrap-editable.min.js"></script>
	
	<script src="<?php echo $this->webroot;?>js/plugins/colorbox/jquery.colorbox-min.js"></script>
	
	<script src="<?php echo $this->webroot;?>js/jquery.autosize.min.js"></script>
	
	<script src="<?php echo $this->webroot;?>js/jquery.sheepItPlugin-1.1.1.js"></script>
	

	<style type="text/css">
	.tooltip_style{font-size:11px}
	</style>
	<script type="text/javascript">
	// function to select the multiple check boxes
	$(document).ready(function() {
		/* sheep it for multiple option */
		if(jQuery('#sheepItForm').length > 0){
			var sheepItForm = $('#sheepItForm').sheepIt({
				separator: '',
				allowRemoveLast: true,
				allowRemoveCurrent: true,
				allowRemoveAll: true,
				allowAdd: true,
				allowAddN: true,
				maxFormsCount: 100,
				minFormsCount: 1,
				iniFormsCount: $('#tot_edit').val() != '0' ? $('#tot_edit').val() : '3'
				,	 
				afterAdd: function(source, newForm) { 
					$('[rel=tooltip2]').tooltip({html:true});
					// save the total
					$('#tot_msg').val($('.msgBox').length);
					// text auto resize
					$('textarea[class*=autosize]').on('focus', function(){
						 $(this).autosize({append: "<br>"});
					});
				},
				beforeAdd:function(source,newForm){					
				},
				afterFill:function(source){
				},
				afterRemoveCurrent:function(source){					
				}
				
			});
		}
		
		
	/* function to load php value into form */
	if($('.sheepitVoice').length > 0){ 
		for(i = 0; i <= $('#tot_edit').val(); i++){
			if($('#Vmsg'+i).length > 0){ 
				$('#msg'+i).val($('#Vmsg'+i).val());
			}
			if($('#Vtype'+i).length > 0){
				$('#type'+i).val($('#Vtype'+i).val());
			}			
		}
	}
		
		// for autoresize textbox	
		$('textarea[class*=autosize]').on('focus', function(){
			 $(this).autosize({append: "<br>"});
		});
		
		/* validate the voice form */
		$('.voiceSend').click(function() { 
			$('#is_draft').val('');
			$('.draftMsg').hide();
			res = validateForm();			
			return res;
		});
		
		// for previw user in share
		$('.previewUser').mouseover(function(){	
			id = $(this).attr('rel');			
			$('#prev-'+id).fadeIn('fast');
		});
		
		$('.previewUser').mouseout(function(){	
			id = $(this).attr('rel');			
			$('#prev-'+id).fadeOut('slow');
		});
			
		// tool tip
		$('[rel=tooltip],.show-tip').tooltip({html:true,placement:'top' });
		
		$('[rel=tooltip2]').tooltip({html:true});
		
		// load the color box
		$('.iframeBox').click(function(){
			load_colorBox(this, $(this).attr('val'));	
		});
		
			/* when task view is clicked */
		$('.verifyTsk').click(function(){
			id = $(this).attr('rel');
			$.ajax({
				url: $('#webroot').val()+'home/update_view_task/'+id
			}).done(function( html ){			
				$('#enableTsk-'+id).show();
				$('#disableTsk-'+id).hide();
			});
		});
		
		
			/* function to load the color box */
	function load_colorBox(obj, size){ 
		// email to friends	
		if($(obj).attr('val') != '' && $(obj).attr('val') != undefined) {
		
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
							update_data();
						}
					}
			
				 }
			
			});
		}
	}
		
		/* when the form submitted */
		$('#formID').submit(function(){ 		
			// Disable the 'Next' button to prevent multiple clicks		
			$('button[type=submit]', this).attr('value', 'Processing...');		
			$('button[type=submit]', this).attr('disabled', 'disabled');
			
		});
	
		/* submit feedback form */
		$('.feedBack').click(function (){
			submit = true;
			if($('#feedback').val() == ''){
				$('.error1').html('Please enter the feedback');
				submit = false;
			}
			return submit;
		});
	
		/* submit feedback form */
		$('.reportIssue').click(function (){
			submit = true;
			if($('#page_title').val() == ''){
				$('.error1').html('Please enter the page title');
				submit = false;
			}
			if($('#issue').val() == ''){
				$('.error2').html('Please enter the issue details');
				submit = false;
			}
			return submit;
		});
		
		/* function to verify bio attendance in att. approval */
		if($('.verifyAtt').length > 0){
			$('.verifyAtt').editable({
				showbuttons: false,
				response: '',
				value: '',
				source: [
					{value: '', text: 'Select'},
					{value: 'B', text: 'Biometric'},
					{value: 'O', text: 'Online'}
				],
			success: function(response, newValue) {
				//userModel.set('att_reason', newValue); //update backbone model				
			},				
			display: function(value, response) { 
				//render response into element
				if($.trim(value) != ''){
					// remove reject record
					response = $(this).attr('val');
					rowid = 'row-'+response;
					$('#'+rowid).remove(); 
					// update the counts
					new_val = $('#st_total').val() - 1;					
					$('#rec_count').html(new_val);
					$('#st_total').val(new_val);					
					// update the count
					parent.$('.stCount').html(new_val);
					// show messages
					$('.recrej').hide();
					$('.recapr').show();
					// hide the reason box
					$('.editable-container').html('');	
					$('.editable-container').hide();
				 }			
				
			 }				
		 });
		}
		
			
	   /* function to approve attendance */
	   $('.verify_att').on('click', function() {	
			status = $(this).attr('rel');
			id = $(this).attr('val'); 	
			rowid = 'row-'+id;
			root = $('#webroot').val();
			$('#busy-indicator').show();
			$('#disablingDiv').show();
			 jQuery.ajax({
                url: root+'home/update_att_status/?id='+id+'&status='+status,               
                contentType: false,
                processData: false,
                data: function() {
                    //var data = new FormData();                 
                }(),
                error: function(_, textStatus, errorThrown) {
                    //alert("Error");
                   // console.log(textStatus, errorThrown);
                },
                success: function(response, textStatus) { 
                   // alert("Success");
				    $('#busy-indicator').hide();
					$('#disablingDiv').hide();
					$('#'+rowid).remove(); 
					new_val = $('#st_total').val() - 1;
					
					$('#rec_count').html(new_val);
					$('#st_total').val(new_val);
					
					// update the count
					parent.$('.stCount').html(new_val);
                  
				   // show confirm msg.
				   if(status == 'A'){
					$('.recapr').show();
					$('.recrej').hide();					
				   }else if(status == 'R'){
					$('.recrej').show();
					$('.recapr').hide();
				   }
                }
            });
		
	   });
	   
	 /* editable for reason in approve attendance */
	if($('.att_reject').length > 0){
		$('.att_reject').editable({
			type: 'textarea',
			value: '',
			success: function(response, newValue) {
				//userModel.set('att_reason', newValue); //update backbone model				
			},
			validate: function(value) {
				if($.trim(value) == '') {
					return 'Please enter the reason';
				}
			},
			display: function(value, response) {
				//render response into element
				if($.trim(response) != ''){
					// remove reject record
					rowid = 'row-'+response;
					$('#'+rowid).remove(); 
					// update the counts
					new_val = $('#st_total').val() - 1;					
					$('#rec_count').html(new_val);
					$('#st_total').val(new_val);					
					// update the count
					parent.$('.stCount').html(new_val);
					// show messages
					$('.recrej').show();
					$('.recapr').hide();
					// hide the reason box
					$('.editable-container').html('');	
					$('.editable-container').hide();
				}
				
				
			}
		});
	 }
	 
	/* editable for waive in approve attendance */
	if($('.att_waive').length > 0){
		$('.att_waive').editable({
			type: 'textarea',
			value: '',
			success: function(response, newValue) {
				//userModel.set('att_reason', newValue); //update backbone model				
			},
			validate: function(value) {
				if($.trim(value) == '') {
					return 'Please enter the message';
				}
			},			
			display: function(value, response) {			
				// remove reject record
				$('#enableWaive-'+response).hide();
				$('#disableWaive-'+response).show();
				// hide the reason box
				$('.editable-container').html('');	
				$('.editable-container').hide();
			}
		});
	 }
	 
	   /* editable for reason in approve attendance */
	if($('.tsk_comment').length > 0){
		$('.tsk_comment').editable({
			type: 'textarea',
			value: '',
			success: function(response, newValue) {
				//userModel.set('att_reason', newValue); //update backbone model				
			},
			validate: function(value) {
				if($.trim(value) == '') {
					return 'Please enter the comment';
				}
			},
			display: function(value, response) {
				//render response into element
				if($.trim(response) != ''){
					// remove reject record
					$('#tsk'+response).removeClass('btn-warning').addClass('btn-success');
					// show messages
					$('.com_success').show();
					$('.com_error').hide();
					// hide the reason box
					$('.editable-container').html('');	
					$('.editable-container').hide();
				}else{
					//$('.com_error').show();
					//$('.com_success').hide();
				}
			}
		});
	 }
	
		// function to process the id and show no. of users
		$('.shareSrch').click(function(){
			id = parse_id();			
			parent.$.colorbox.close(); 

		});
		
		/* resize page when survey completed */
		if($('#survey_status').val() == 1){ 
			parent.$.colorbox.resize({width:'600px', height:'350px'});			
		}
		
		/* refresh page when survey completed */
		if($('#survey_close').val() == 3){ 
			parent.$('#cboxClose').hide();
			parent.$.colorbox.resize({width:'600px', height:'250px'});
			setTimeout(function(){	
				update_refTime();}, 1000);
			setTimeout(function(){ window.parent.location.reload();}, 5000);
		}
		
		// function to show the selected user in tags		
		$('.shareSel').click(function(){ 
			//$('#tagDiv').html('updating...');
			id = parse_id();
			$.ajax({
			  url: $('#shareTagUrl').val()+'?id='+id	
			}).done(function( html ) {
				$('#tagDiv').html(html);
			});
			
		});
		
		// to reset the searh tags
		$('.shareReset').click(function(){
			$('#tagDiv').html('');
			parent.$('.no_users').html('All');
			parent.$('#interact_url').attr('href', $('#webroot').val());
			location.href = $('#webroot').val();
		});
		
		/* to save the change request */
		$('#btnReq').click(function(event){ 
			type = $('#type').val(); 			
			var submit = true;
			var form_field = new Array('Please enter the description');
			for(i = 0; i < 1; i++){
				// if empty show the error msg.
				if($('#field'+i).val() == ''){					
					$('.error'+i).html(form_field[i]);
					submit = false;
				}else if($('#field'+i).val() != ''){
					$('.error'+i).html('');
				}
			}
			
			if(submit == true){
				// disable the Button
				$('#btnReq').text('Processing...');		
				$('#btnReq').attr('disabled', 'disabled');
				save_change_req(type, $('#field0').val());
			}
			
		});
		
		/* function to validate the survey */
		$('.validate_survey').click(function(){
			$('#is_draft').val('');
			$('.draftMsg').hide();
			var submit = true;
			total = $('#tot_qn').val();
			var k = 1;
			for(i = 1; i <= total; i++){
				if($('#qn'+i).val() == ''){
					$('#qn'+i).css('border-left', '2px solid #ff0000');
					$('#qn'+i).css('border-right', '2px solid #ff0000');
					$('.errorMsg').show();
					submit = false;	
					if(k == 1){
						$('#qn'+i).focus();
					}
					k++;
				}else{
					$('#qn'+i).css('border', '1px solid #d5d5d5');
				}
			}
			
			
			if(submit == true){
				if(confirm('Are you sure you want to send? once sent, it cannot be modified!')){
					return true;
				}else{
					return false;
				}
			}
			
			return submit;
			
		});

		
		$('.survey_draft').click(function(){
			$('#is_draft').val(1);
		});
		
		
		
		
		
		
	});	
	
	function validateForm () { 
	 
		var submit = true;		
		
		// Loop over form input and select elements		
		$(".form-vertical input[type=text], select, input[type=checkbox], textarea").each(function(index,elem){			
		
			// If element has the class required check for a value
			//$(this).val() == '' && 
			if($(this).val() == '' &&  $(this).hasClass('required') ) {				
				
				$(this).addClass('missing');	
												
				submit = false;
				
			} else { 
					
				// Remove class incase it had been set on previous try
				$(this).removeClass('missing'); 
					
			}
	
		}); 
		
		// Errors
		if (submit == false) {
			$('.errorMsg').show();			
		}else{
			$('.errorMsg').hide();
			// add confirmation
			if(confirm('Are you sure you want to send? once sent, it cannot be modified!')){
				return true;
			}else{
				return false;
			}
		}
		return submit;
	
	}
	
		/* function to save change req */
	function save_change_req(type, desc){
		$.ajax({
			 type: "POST",
			 url: $('#change_req').val(),
			 data: { type: type, desc : desc }
			 }).done(function( html ) {
				if(html == 'saved'){
					$('.chgReqFrm').hide();
					$('.chgSuccess').fadeIn();				
				}else{
					$('.chgError').fadeIn();	
				}
				
			});					
	}
	
	
		// function to parse the selected users in share
		function parse_id(){
			id = '';
			i = 0;
			$("input:checkbox").each(function(){
				var $this = $(this);    
				if($this.is(":checked")){
					id += $this.val()+'_';
					i++;
				}
			});			
			// save in hidden for process
			parent.$('#hdnId').val(id);			
			// show no. of users
			parent.$('.no_users').html(i);
			// change the iframe url 
			if(id != ''){
				parent.$('#interact_url').attr('href', $('#webroot').val()+'?id='+id);
			}
			
			return id;
		}
		
		
		function update_refTime(){
			val = $('#timeRef').text() - 1;		if(val >= 0){$('#timeRef').text(val)};
			
			setTimeout(function(){	
				update_refTime();}, 1000);
		}
	
	</script>

	</head>
	<body>


<?php echo $this->fetch('content'); ?>
</body>
</html>