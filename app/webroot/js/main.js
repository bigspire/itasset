$(document).ready(function() { 	
	// for google chart in home
	$(window).load(function() {
		if($('.loadChart').length > 0){
			jQuery('.loadChart').hide();
		}		
	});
		
	if($('#new_f').length > 0){	
		window.setTimeout(new_flash, 15000);
	}
	
	/* function to scroll org tree */
	window.onload = function() {
		//window.setTimeout(scroll_org, 2000);prop
	};
		
	/* hide the flash msg */
	if($('#flashMessage').length > 0){
		//window.setTimeout(hide_confirm_alert, 2000);
	}
	
	 $(document).click(function(){ 
		if($('.piechart1').val() == '1'){
			$('.popover2').hide();
			$('.piechart1').val(0);
		}
	 });

	
	// to close the theme box	
	$('.main-content').on('click', function(){
		if($('#ace-settings-box').length > 0){
			$('#ace-settings-box').removeClass('open');
		}
	});
	
	// disable multiple button clicks
	$('.btnID').on('click', function() { 
		if(check_browser('alert')){
			if($(this).attr('name') == 'message'){
				valid_id = 'shareTxtBx';
				dataElem = 'shareData';
				url = 'share_url';
				error = 'share_er';
			}else if($(this).attr('name') == 'roa_greeting'){
				valid_id = 'roaTxtBx';
				dataElem = 'roa_shareData';
				url = 'share_url';
				error = 'roa_er'
			}else{
				valid_id = 'taskTxtBx';
				dataElem = 'todoData';
				url = 'todo_url';
				error = 'todo_er'
			}
			// validate the form..
			valid = validate_tsk(valid_id);
			// if validation success
			if(valid){			
				$(this).html('<i class="icon-share-alt"></i> Processing...');		
				$(this).attr('disabled', 'disabled');
				load_page(valid_id,dataElem,url);
				$('.'+error).removeClass('sh_error');
			}else{
				$('.'+error).addClass('sh_error');
				return false;
			}
		}
			
	});
	
	// for autoresize textbox	
	$('textarea[class*=autosize]').on('focus', function(){ 
		 $(this).autosize({append: "<br>"});
	});
	
	/* slider for gallery */
	if($('.bxslider').length > 0){
		$('.bxslider').bxSlider({
		  mode: 'fade',
		  captions: false
		});
	}
	
	// when the enter key is pressed in reply bd
		$('#reviewBD').on('click', function(e){ 
			reply = $('#reply_bd').val();
			new_value = reply.replace(/\n/g, "<br>");
			valid = validate_tsk('bdReply');
			// if validation success				
			if(valid){
				$('.bdReply').removeClass('sh_error');
				$('#bdBtn').hide();
				$('#reply_bd').hide();
				$('.bdSubmit').hide();
				// load the preloader
				$('.typing').show();					
				// update the table					
				update_reply_bd($.trim(new_value), $('#webroot').val()+'save_reply/?id='+$('#bd_id').val());
			}else{
				$('.bdReply').addClass('sh_error');
				return false;
			}				
			
		});
		
		/* function to update bd reply */
		function update_reply_bd(data,url){		
			$.ajax({
				url: url,
				type: "POST",
				 data: { reply : data }
			}).done(function( html ){		
				$('.typing').hide();
				$('#reply_bd').show();
				$('#reply_bd').val('');
				$('.bdSubmit').show();
				$('.replyMsg').html(html);
				$('#bdBtn').show();
				
			});
		}
	
	
	/* validate start time and end time */
	$('.tsk_time').change(function(){ 
		// make sure both has value
		if($(this).val() != ''){
			// check plan start or plan end date
			if($(this).attr('rel') == 'plan_end'){
				start = $(this).closest('.span1').prev().find('.tsk_time_start').val();
				end = $(this).val();
			}else{
				end = $(this).closest('.span1').next().find('.tsk_time_end').val();
				start = $(this).val();
			}		
				
			// check the plan type
			if($('.plan_type_sel').val() == 'P'){		
				start_date = start.split('/');				
				new_start = new Date(start_date[2]+' '+start_date[1]+ ' '+', '+start_date[0]);
				var new_end = '';
				if(end != '' && end != undefined){
					end_date = end.split('/');				
					new_end = new Date(end_date[2]+' '+end_date[1]+ ' '+', '+end_date[0]);	
					// check start date lesser than end date
					if(new_start > new_end){
						$(this).attr('value', '');
						if($(this).attr('rel') == 'plan_end'){
							$(this).closest('.span1').prev().find('.tsk_time_start').val('');
						}else{
							$(this).closest('.span1').next().find('.tsk_time_end').val('');
						}
					}
				}
				
			}else{
			
			 
				/*
				date = '30/06/2014';
				start_date = date.split('/');	
				// get 24 hrs format
				select_time = convertDateTo24Hour(start);
				new_time = select_time.split(':');				
				new_start = new Date(start_date[2]+' '+start_date[1]+ ' '+', '+start_date[0], new_time[0], new_time[1], '00' );				
				var new_end = '';
				if(end != '' && end != undefined){
					select_time = convertDateTo24Hour(end);
					new_time = select_time.split(':');				
					new_end = new Date(start_date[2]+' '+start_date[1]+ ' '+', '+start_date[0], new_time[0], new_time[1], '00' );	
					// check start date lesser than end date
					if(new_start > new_end){
						$(this).attr('value', '');
						if($(this).attr('rel') == 'plan_end'){
							$(this).closest('.span1').prev().find('.tsk_time_start').val('');
						}else{
							$(this).closest('.span1').next().find('.tsk_time_end').val('');
						}
					}
				}	*/			
			}
		}
	});

	/* when we click confirm in step 1 of ticket */
	$('.tktConfirm').click(function(){
		$('#confirm').val(1);
	});
	
	/* check debit client in travel req */
	$('.debitTravel').click(function(){ 
		if($('.debitTravel:checked').val() == 'N'){
			$('#debit_to').val('');
			$('#debit_to').show();
		}else{
			$('#debit_to').hide();
		}
	});
	
	if($('.debitTravel').length > 0){
		if($('.debitTravel:checked').val() == 'N'){
			$('#debit_to').show();
		}else{
			$('#debit_to').hide();
		}
	}
	
	// when the enter key is pressed
	$('.postShare').on('keydown', function(e){	
		var keyCode = e.which || e.keyCode; 		
		if(keyCode == 13){ 			
			if($(this).attr('name') == 'message'){
				/*
				valid_id = 'shareTxtBx';
				dataElem = 'shareData';
				url = 'share_url';
				error = 'share_er';
				*/
				return;
			}else{
				valid_id = 'taskTxtBx';
				dataElem = 'todoData';
				url = 'todo_url';
				error = 'todo_er'
			}			
			valid = validate_tsk(valid_id);
			// if validation success
			if(valid){
				$('.btnID').html('<i class="icon-share-alt"></i> Processing...');		
				$('.btnID').attr('disabled', 'disabled');				
				load_page(valid_id,dataElem,url);
			}else{
				$('.'+error).addClass('sh_error');
			return false;
			}
		}
			
		
	});
	
	
	
	/* when the welcome msg is closed */
	$('.welcomeIcon').click(function(){ 
		update_session();
	});
	
	/* reply share */	
	$('.replytoggle').on('click', function(){	
		if($(this).next().find('.shareReply').is(":visible")){
			$($(this).next().find('.shareReply')).fadeOut();
		}else{
			$($(this).next().find('.shareReply')).fadeIn();
		}
	});
	
	$('.shareReply').on('keydown',function(e){ 
		value = $(this).val();
		id = $(this).attr('val');
		userid = $(this).attr('rel'); 
		type = $(this).attr('cls');
		var keyCode = e.which || e.keyCode; 			
		if(keyCode == 13){ 					
			if($.trim(value) !=''){
				valid =  true;
			}else{
				valid =  false;
			}						
			// if validation success
			if(valid){
				update_reply_share(value,id,userid,type);			
			}
		}
	});
	
	/* close the fancy box */
	$('.close_fancy').click(function (){
		$.fn.fancybox.close()
	});
	
	
	
		/* to close the items 	 */

	$('.itemChk').on('click', function(e) { 
			if($(this).parent().parent().hasClass('selected') == true){ 
					$(this).parent().parent().removeClass('selected');
					//$(this).find('.itemChk').removeAttr('checked', 'checked')
					status = '1';
				}else{
					$(this).parent().parent().addClass('selected');
					//$(this).find('.itemChk').attr('checked', 'checked');
					status = '0'
						
				}		
		
			// attach the unique key
			split_id = $(this).attr('val').split('-');
			// update the todo
			update_todo(status, split_id[1]);


			//return false;
		
	  });
	  
	  /* to modify the item */
	  $('.editItem').click(function() { 
			// hide the label and checkbox
			$(this).parent().parent().find('.itemChk').hide();
			$(this).parent().parent().find('.itemLbl').hide();			
			// split the text id
			split_id = $(this).parent().parent().find('.itemChk').attr('val').split('-');
			// show the form			
			$(this).parent().parent().find('.edit_form').fadeIn("slow").html('<input size="80" type="text" class="todo_input" id="edit-'+split_id[1]+'"/> <a href="javascript:void(0)" class="todoSav">Save</a>  | <a href="javascript:void(0)" class="todoCan" >Cancel</a>');
			// place the edit value
			$('#edit-'+split_id[1]).val($.trim($(this).parent().parent().find('.itemLbl').text()));
			$('#edit-'+split_id[1]).focus();
	  });
	  
	  /* to cancel the todo form */
	  $(document).on('click', '.todoCan', 'click', function() { 
			$(this).parent().parent().find('.edit_form').hide();
			// hide the label and checkbox
			$(this).parent().parent().find('.itemChk').show();
			$(this).parent().parent().find('.itemLbl').show();	
			
			
	  });
	  
	  /* hide welcome alert */
	  if($('.welcomeAlert').length > 0){
		setTimeout(hide_alert, 5000);
	  }
	  
	    /* to save the todo form */
	  $(document).on('click', '.todoSav', 'click', function() { 
			msg = $(this).parent().parent().find('.todo_input').val();
		
			id = $(this).parent().parent().find('.todo_input').attr('id').split('-');			
			// function to save the todo
			save_todo(msg, id[1]);
						
	  });
	  
	  /* when click on debt to client */
	  
	  $('.advDebit').click(function (){ 
		if($(this).val() == '1'){
			$('.comp_list').fadeIn();
		}else{
			$('.comp_list').val('')
			$('.comp_list').hide();
		}
	  });
	  
	  if($('.advDebit').length > 0){
		if($('#hdnDebit').val() == '1'){
			$('.comp_list').show();
		}
	  }
	  
	  
	  /* to delete the item */
	  $('.delItem').on('click', function() { 	
		split_id = $(this).attr('val').split('-'); 
		$('#tasks').find('.listitems-'+split_id[1]).fadeOut("slow");
			// to delete the todo
			delete_todo(split_id[1]);
	  });
	  
	  
	  /* disable education tab */
	  $('.disableEdu').click(function (){
		$('.eduTab').toggle();
	  });
	  
	   /* to delete the item */
	  $('.flagItem').on('click', function() { 	
		split_id = $(this).attr('val').split('-');		
		if(split_id[2] == 'green'){
			$('#tasks').find('.flag-'+split_id[1]).removeClass("green");
			$('#tasks').find('.flag-'+split_id[1]).addClass("grey");
			$('#tasks').find('.flag-'+split_id[1]).attr("val", "flag-"+split_id[1]+"-grey");
			flag = 0;
		}else{
			$('#tasks').find('.flag-'+split_id[1]).addClass("green");
			$('#tasks').find('.flag-'+split_id[1]).removeClass("grey");
			$('#tasks').find('.flag-'+split_id[1]).attr("val", "flag-"+split_id[1]+"-green");
			flag = 1;
		}
		flag_todo(flag,split_id[1]);

	  });
	  
	
	  
	$('.delRec').on('click', function() {
		id = $(this).attr("name");
		type_var = '';
		// for adv. approver and exp. approver
		if($('#approver').length > 0){
			app = $('#approver').val();		
			if(app != '' && app != undefined){type_var = '/'+'?type='+app;}else{type_var = '';}
		}
		// for roles
		if($('#role').length > 0){
			role = $('#role').val();	
			if(role != '' && role != undefined){type_var = '/'+'?mod='+role;}else{type_var = '';}
		}
	
		$( "#dialog-confirm" ).dialog({
			resizable: false,
			height:170,
			modal: true,
			buttons: {
				"Yes": function() { 
					$(this).html('Processing.. Pls wait..');
					$('.ui-dialog-buttonset').hide(); 
					$('#formID').attr('action', $('#del_url').attr('value')+id+type_var); 
					$('#formID').submit();
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
	});
	
	/* function to approve / reject the request */
	$('.approveRec').on('click', function() {
		if($('#approve_exp').length > 0){ 
			if($('#approve_exp').val() == '1'){
				if(validate_exp_form() == false){
					return false;
				}
				
			}
		}
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
	
	/* validate assign task status */
		$('.save_assign').click(function(){ 
			var submit = true;
			var form_field = Array('title','desc','task_type','assign_user','plan_date');
			var valid_msg =  Array('Please enter the title','Please enter the description','Please select the type','Please assign the user');
			for(i = 0; i < form_field.length; i++){ 
				// if empty show the error msg.
				if($('#'+form_field[i]).val() == ''){					
					$('.'+form_field[i]).html(valid_msg[i]);
					submit = false;
				}else if(form_field[i] == 'plan_date'){					
					// validate start and end time
					result = validate_plan_type();
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
	
	// show tooltip for icons	
	$('[rel=tooltip]').tooltip({html:true});
	
	//tooltips
	$( ".show-tip" ).tooltip({
		show: {
		effect: "slideDown",
		delay: 250,
		live: true   
		}
	});

	
	$("[rel=popover]").popover();
	
	$("[rel=preview]").popover({html:true});
	
	// timepicker
	if($('.timepickDefault').length > 0){		
		$('.timepickDefault').timepicker({
			// '9:30 AM'
			defaultTime: false ,
			minuteStep: 15,
			disableFocus: true,
			template: 'modal'
		})
	}
	
	if($('.defaultTimePick').length > 0){
		$('.defaultTimePick').unbind().timepicker({ 'timeFormat': 'h:i A', 'step': 15,'forceRoundTime': true, 'scrollDefaultTime': '06:00 PM'});
	}
	
	/* function to toggle travel type */
	$('.tvlType').change(function(){
		if($(this).val() == '1'){
			$('.rtDiv').hide();
			$('.owDiv').show();
		}else{
			$('.rtDiv').show();
			$('.owDiv').hide();
		}
	});
	
	if($('.tvlType').length > 0){
		if($('.tvlType:checked').val() == '1'){
			$('.rtDiv').hide();
			$('.owDiv').show();
		}else{
			$('.rtDiv').show();
			$('.owDiv').hide();
			
		}
	}
	
	if($('.dpd1,.dpd2').length > 0){
		check_in_out();
	}		
	
	/* when attendance type is clickecd */
	$('.attType').click(function(){	
		retain_change_att($(this).val());
		$('#attType').val($(this).val());
	});
	
	/* show the att. types in server side */
	if($('#attType').length > 0){
		retain_change_att($('#attType').val());
	}
	
	function retain_change_att(value){ 
		switch(value){
			/*case 'I':			
			$('.out_att_time').hide();			
			$('.in_att_time').show();
			$('.out_att_time_field').val('');
			$('.in_att_time_field').val('');
			break;*/
			case 'O':		
			$('.in_att_time').hide();			
			$('.out_att_time').show();			
			$('.in_att_time_field').val('');
			break;
			case 'B':			
			$('.in_att_time').show();
			//$('.out_att_time_field').val('');
			//$('.in_att_time_field').val('');	
			break;
		}
	}
	
	/* time picker for office timings */
	if($('.defaulttimepick').length > 0){		
		$('.defaulttimepick').timepicker({
			// '9:30 AM'
			defaultTime: false ,
			minuteStep: 10,
			disableFocus: true,
			template: 'modal'
		});
	}
	

	
	/* time picker for office timings */
	if($('.tsk_timepicker').length > 0){
		timePicker();
	}
	
	
	
	// timepicker
	if($('.timepick').length > 0){		
		$('.timepick').timepicker({
			// '9:30 AM'
			defaultTime: false ,
			minuteStep: 15,
			disableFocus: true,
			template: 'modal'
		}).on('hide.timepicker', function(e) {			
			var start = $('.fromTime').val();
			var end = $('.toTime').val();
			// make sure both are selected
			if(start != '' && end != ''){
				// split am and hour/min.
				start_time =  start.split(' ');			
				end_time =  end.split(' ');
				// split hour and mins.
				start_h = start_time[0].split(':');
				end_h = end_time[0].split(':');
				if(start_time[1] == 'AM'){
					md1 = 0;
				}else{
					md1 = 1;
				}
				
				if(end_time[1] == 'AM'){
					md2 = 0;
				}else{
					md2 = 1;
				}
				// call time diff. fn.
				time = timeDiff(start_h[0], start_h[1], end_h[0],end_h[1],md1,md2);		
				sp_time = time.split('|');
				$('#no_hrs').html(sp_time[0]  + "  hrs  " + "  " + sp_time[1] + "  mins");	
				$('#nohrslbl').val(sp_time[0]  + "  hrs  " + "  " + sp_time[1] + "  mins");		
				// assign hidden field
				$('#nohrs').val(sp_time[0]+':'+sp_time[1]);
			}
		});
	}
	
	
	// datepicker
	if($('.proj_date_pick').length > 0){
		$('.proj_date_pick').datepicker({
			showOtherMonths: true,
			selectOtherMonths: true,
			format: 'dd/mm/yyyy',
			prevText: "",
			startDate:$('#start_date').val(),
			endDate:$('#end_date').val(),
			nextText: "",
			autoclose:true,		
			todayHighlight: false			
		}).on('changeDate', function(ev){ 
			if($('#plan_task').length > 0){
				// update start and end date
				if($(this).attr('rel') == 'plan_start'){
					$('#start_date').val($(this).val());
				}
				if($(this).attr('rel') == 'plan_end'){
					$('#end_date').val($(this).val());
											
				}
				// reassign the date
				$('.tsk_time').datepicker('remove');
				call_datepicker();
			}
		});
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
			todayHighlight: false
		}).on('changeDate', function(ev){ // for post dated permission confirmation
			post_dated_perm($(this).val(), 'date');
		});
	
	}
	
	/* validate the daily task time */
	$('.valid_daily_tsk_time').change(function(){
		$('.tsk_timepicker').val('');
	});
	
	if($('.monthpick').length > 0){	
		$(".monthpick").datepicker( {
			format: 'mm/yyyy',
			viewMode: 1, 
			startView: 1,
			minViewMode: 1,
			autoclose:true,
			endDate:$('#end_date').val()			
		});
	}
	
	
	
	// datepicker for task manager
	if($('.datepick_tsk').length > 0){	
			call_datepicker();
	}
	
	
	/* editable for reason in attendance */
	if($('#att_reason, #out_att_reason').length > 0){
		$('#att_reason, #out_att_reason').editable({
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
					if($(this).attr('rel') == 'in'){
						// check for task plan
						var buttonsConfig = [{text: "Ok",	"class": "btn btn-sm btn-primary",  click:function(){
							$( this ).dialog( "close" );}}];							
						output = check_last_attendance($.trim(response)); 
						if(output != ''){ 
							output_str = $.trim(response).split('||');
							$('.forgot_date').html(output_str[1]);
							$( "#"+output).dialog({
							  modal: true,
							  buttons: buttonsConfig
							});
						}else{
							$(this).html('In Time: '+response);						
							// change mouse cursor
							$('.btnIn').addClass('cursor');	
							// update the attendance buttons
							check_att_intime_marked($(this).attr('rel'));
						}
					}else{					
						// check for task plan
						var buttonsConfig = [{text: "Ok",	"class": "btn btn-sm btn-primary",  click:function(){
							$( this ).dialog( "close" );}}];
						output = check_task_outtime($.trim(response));
						if(output != ''){							
							$( "#"+output).dialog({
							  modal: true,
							  buttons: buttonsConfig
							});
						}else{
							$(this).html('Out Time: '+response);						
							// change mouse cursor
							$('.btnOut').addClass('cursor');
							// hide the reason box
							$('.editable-container').html('');	
							$('.editable-container').hide();
						}
					}					
					
				}
				
				
			}
		});
	 }
	
	
	
	
	/*if($(".galleryJs").length > 0){
		var p = $(".galleryJs").portfolio({
		 enableKeyboardNavigation: false});
		p.init();
		// load the likes over the images
		
		$(".galImgs").each(function(){		
			var $el = $(this);
			like_src = $el.attr('data-like');
			$el.before('<span class="gal_like"><a href="javascript:void(0)">Like</a> | <a href="javascript:void(0)">Comment</a></span>');
			
		});
	}*/
	
	
	
	// function to select the multiple check boxes
	 
	$('.select_all').click(function() { 
		var c = this.checked; 
		$('.chkSel:checkbox').attr('checked',c);
	});
	
	// function to reset and send share for all user 		
	$('#all_user').click(function(){ 
		$('.no_users').html('All');
		$('#interact_url').attr('href', $('#webroot_share').val());
	});

	
	
	$("#expForm").delegate(".datepicker", "focusin", function () {
		$(this).datepicker({
		showOtherMonths: true,
        selectOtherMonths: true,
		format: 'dd/mm/yyyy',
        prevText: "",
        nextText: "",
		autoclose:true,
		startDate:$('#start_date').val(),
		endDate:$('#end_date').val(),
		todayHighlight: false
		});
	});
	
	/* task time picker */
	$("#expForm").delegate(".tsk_timepicker", "focusin", function () {
		timePicker();
	});

	
	/* when the form submitted */
	$('#formID, .tskPlanForm,.tvlForm,#expForm').submit(function(){ 		
		// Disable the 'Next' button to prevent multiple clicks		
		$('input[type=submit]', this).attr('value', 'Processing...');		
		$('input[type=submit]', this).attr('disabled', 'disabled');
		// hide cancel button
		//$('button[type=button]', this).hide();
		
	});
	
	var browser = get_browser_info();
	if(browser.name == 'MSIE'){
		jQuery("a button").each(function() {
			jQuery(this).click(function() {
				location.href = jQuery(this).closest("a").attr("href");
			});
		});
	}
		
	/* when the form submitted */
	$('#formID').submit(function(){ 		
		// Disable the 'Next' button to prevent multiple clicks		
		$('button[type=submit]', this).attr('value', 'Processing...');		
		$('button[type=submit]', this).attr('disabled', 'disabled');
		
	});
	
	if(jQuery('#SearchKeywords').length > 0){ 
		$('#SearchKeywords').ready(function () {
			webroot = $("#webroot").attr('value');
			var type_var = '';			

			if($('#approver').length > 0){
				app = $('#approver').val();		
				if(app != '' && app != undefined){type_var = '?type='+app;}else{type_var = '';}
			}			
			
			if($('#role').length > 0){
				app = $('#role').val(); 
				if(app != '' && app != undefined){type_var = '?mod='+app;}else{type_var = '';}				
			}		
			
				jQuery('#SearchText').autocomplete(webroot+'search/'+type_var, {
				width: 227,
				selectFirst: true			
			});	
		});
	}
	
	/* employee search in tvl. request */
	if(jQuery('#SearchKeywords').length > 0){ 
		search_passenger();	
	}

	// multiple location selection in jquery	
	/*if(jQuery('.multi_select').length > 0){ 
		$(".multi_select").multiselect({
		minWidth:270,
		height:220}); 
	}*/
	
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
			minFormsCount: 0,
			iniFormsCount: 0
			,	 afterAdd: function(source, newForm) { 
					$('#form_count').val(sheepItForm.getFormsCount()); 
					sheepit_load_task_date();
					search_passenger();
			},
			beforeAdd:function(source,newForm){ 
				//init_tooltip();
				//toggle_plan_type();
				
			},
			afterFill:function(source){
				
			},
			afterRemoveCurrent:function(source){  
				cal_total();
			}
			
		});
	}
	
	/* sheep it for multiple option */
	if(jQuery('#sheepItDynamicForm').length > 0){
		var sheepItForm = $('#sheepItDynamicForm').sheepIt({
			separator: '',
			allowRemoveLast: true,
			allowRemoveCurrent: true,
			allowRemoveAll: true,
			removeCurrentConfirmation:$('#page').val() == 'edit' ? true : false,
			allowAdd: true,
			allowAddN: true,
			maxFormsCount: 10,
			iniFormsCount: $('.init_form').val() != '' ? $('.init_form').val() : $('#page').val() == 'edit' ? '0' : '1',
			minFormsCount: $('.min_form').val() != '0' ? $('.min_form').val() : $('#page').val() == 'edit' ? '0' : '0',
			afterAdd: function(source, newForm) { 
				$('[rel=tooltip]').tooltip({html:true});
				$('#form_count').val(source.getFormsCount()); 
				$('#ctitle'+(parseInt(source.getFormsCount(),10)-parseInt(1, 10))).focus();
				// for add / edit business
				if($('#page').val() == 'add_business'){ 
					$('textarea[class*=autosize]').on('focus', function(){
						$(this).autosize({append: "<br>"});
					});
				}
				/* function to call when drive form is blurred */
				$('.validateBusiness input,select,textarea,checkbox,radio').focusout(function(){ 
					return validate_new_business($(this).attr('id'));
				});
			},			
			beforeAdd:function(source,newForm){ 
				//$('[rel=tooltip]').tooltip({html:true});
			},
			afterRemoveCurrent:function(source){
				count = $('#form_count').val() > 1 ? $('#form_count').val() - 1 : 1;
				$('#form_count').val(count);
			},
			beforeRemoveCurrent:function(source){				
				
			}
		});
	}
	
	// for stylish form elements
	if($('.icheck-me').length > 0){
		  $('.icheck-me').iCheck({
			checkboxClass: 'icheckbox_square-blue',
			radioClass: 'iradio_square-blue',
			increaseArea: '20%' // optional
		  });  
	}
	
	/*function init_tooltip(){
		$('[rel=tooltip]').tooltip();
	}*/
	
	
	/* sheep it for multiple option */
	if(jQuery('#sheepItEmpForm').length > 0){
		var sheepItForm = $('#sheepItEmpForm').sheepIt({
			separator: '',
			allowRemoveLast: true,
			allowRemoveCurrent: false,
			allowRemoveAll: true,
			allowAdd: true,
			allowAddN: true,
			maxFormsCount: 5,
			minFormsCount: 1,
			iniFormsCount: 1,
			afterAdd: function(source, newForm) {
					
			},
			beforeAdd:function(source,newForm){ 
				
			},
			afterRemoveCurrent:function(source){  
			
			}
			
		});
	}
	
	/* validate report form in work planner */
	$('.chkReport').click(function() { 
		res = validateForm('', '');
		if(res == true){
			$('input[type=submit]').attr('value', 'Processing...');		
		}
		return res;
	});
	
	/* validate bd home search form */
	$('.bdhomeSearch').click(function() { 
		res = validateForm('expForm', '');		
		return res;
	});
	
	/* toggle home page search in bd */
	$('.homeSearch').click(function(){
		if ($('.homeSrchBox').is(":hidden")){
			$('.homeSrchBox').show();
			$('#srchSubmit').val(1);
		}else{
			$('.homeSrchBox').hide();
			$('#srchSubmit').val(0);
		}
	});
	
	if($('.homeSearch').length > 0){
		if ($('#srchSubmit').val() == '1'){
			$('.homeSrchBox').show();
		}else{
			$('.homeSrchBox').hide();
		}
	}
		
	/* function to display the report options */
	$('.reportType').change(function(){
		var list = new Array('D', 'B','L');
		for(i = 0; i <= 2; i++){
			if(list[i] == $(this).val()){
				$('.'+$(this).val()+'div').show();
				$('#selReport').attr('value',$(this).val());
			}else{
				$('.'+list[i]+'div').hide();
			}
		}
		$('.selDrop').val('');
	});
	
	if($('.reportType').length > 0 ){
		var list = new Array('D', 'B','L');
		for(i = 0; i <= 2; i++){
			if(list[i] == $('.reportType').val()){
				$('.'+$('.reportType').val()+'div').show();
				$('#selReport').attr('value',$('.reportType').val());
			}else{
				$('.'+list[i]+'div').hide();
			}
		}	
	}
	 
	/* function to process the save btn */
	$('.save_btn').on('click', function() {
		res = validateForm('expForm', '');		
		if(res == true){
			var buttonsConfig = [
				{
					text: "Yes",
					"class": "btn btn-green",
					click: function() {
						$(this).html('Processing.. Pls wait..');
						$('.save_btn').attr('value', 'Processing...');
						$('.draft_btn').hide();
						$('.cancel_btn').hide();
						$('.ui-dialog-buttonset').hide();
						$('#expForm').attr('action', url); 
						$('#expForm').submit();
						res = true;
					}
				},
				{
					text: "No",
					"class": "btn",
					click: function() {	
						$( this ).dialog( "close" );
						res = false	
					}
				}
			];
			
			// show the alert overlay		
			url = $('#post_data').val();
			res = false;
			$("#dialog-confirm" ).dialog({
				resizable: false,
				height:180,
				modal: true,
				buttons: buttonsConfig				
			});		
		}
		
		return res; 
	});	
	
	/* function to process the draft btn */
	$('.draft_btn').on('click', function() {
		res = validateForm('expForm', 'draft');	
		if(res == true){
			$('.draft_btn').attr('value', 'Processing...');	
			//$('input[type=submit]', '#expForm').attr('disabled', 'disabled');
			$('.save_btn').hide();
			$('.cancel_btn').hide();
			$('.draft_btn').hide();
			$('#isDraft').val('1');				
			return true;
		}
		
		return res; 
	});	
	
	/* function to remove the row */
	$("#expForm,.tvlForm").delegate(".del_row", "click", function () { 
		del_id = $(this).attr('id').split('_'); 
		$('.row'+del_id[1]).fadeOut('slow').html('');
		// modify total
		cal_total();
	});	
	
	 /* validate task form 
	$('.tsk_plan_save').click(function() {
		res = validateTskForm('expForm');		
		if(res == true){			
			$('.can_btn').hide();
			return true;
		}
		
		return res; 
	});	
	*/
	
   /* validate task form */
	$('.tsk_plan_save').click(function() {
		res = validateTskForm('expForm');
		tsk_date = $('#plan_date').val();
		// validate same task time exists
		if(res == true){
			var timing_ar = [];
			var i = 0;
			$(".tsk_time").each(function() {
				i++;
				timing_ar.push(convertDateTo24Hour($(this).val()));				
			});
			
			var timing_ar_2 = [];
			timing_ar_2 = timing_ar;
			
			 
			 if($.unique(timing_ar_2).length != i){
				res = false;
				$('.tskTimeError').show();
			 }else{
				$('.tskTimeError').hide();
			 }	 
			
		 }	

			// check in b/w the timings
			if(res == true){
				var pag; var rec_id;
				$('.can_btn').hide();
				$('.tsk_plan_save').val('Validating... Pls wait..');
				$('.tsk_plan_save').attr('disabled', 'disabled');
				pag = $('#page').val();
				rec_id = $('#rec_id').val();
				$.ajax({
				 type: "POST",
				  url: $('#webroot').val()+'tskplan/validate_task_timing/',
					data:  { timing: timing_ar, date: tsk_date, page: pag, id: rec_id}		  
				}).done(function(html) {
					if(html == '0'){
						$('.tskTimeError').show();
						$('.can_btn').show();
						$('.tsk_plan_save').val('Save');
						$('.tsk_plan_save').removeAttr('disabled', 'disabled');
						return false;
					}else{
						res = false;
						$('.tskTimeError').hide();
						$('.tsk_plan_save').val('Processing...');
						$('#expForm').submit();
					}
				});	
			}
				
		return res;

	});	
	
	
   /* allow only numeric */
	$(".tvlForm").delegate(".digitOnly", "keyup keypress keydown blur change", function (event) {
        // Allow special chars + arrows 
		if(event.type == 'keyup' || event.type == 'keyup' || event.type == 'keydown'){				
			// check its a key event
			if ((event.keyCode >= 48 && event.keyCode <= 57) || (event.keyCode >= 96 && event.keyCode <= 105) || event.keyCode == 8 || event.keyCode == 46 || event.keyCode == 9){
				//cal_total();
			}else{
				event.preventDefault(); 
				return false;
			}	
		}
	});		
	
	 /* allow only numeric */
	$(".tvlForm").delegate(".emailOnly", "keyup keypress keydown blur change", function (event) {
        // Allow special chars + arrows 
		if(event.type == 'keyup' || event.type == 'keyup' || event.type == 'keydown'){	
			// check its a key event
			if ((event.keyCode >= 48 && event.keyCode <= 90) || (event.keyCode == 8) || (event.keyCode >= 96 && event.keyCode <= 105) || event.keyCode == 95 || event.keyCode == 9 || event.keyCode == 110
			|| event.keyCode == 45 || event.keyCode == 46 ||  event.keyCode == 16  ||  event.keyCode == 17  || event.keyCode == 64 || event.keyCode == 190
			|| event.keyCode == 189){
				//cal_total
			}else{
				 event.preventDefault(); 				
				 $(this).val('');
				 return false;
			}	
		}
		
		if(event.type == 'change'){
			if(IsEmail($(this).val())){
				return true;
			}else{
				 $(this).val('');
				 $(this).addClass('missing');
			}
		}
	});
	
	function IsEmail(email) {
	  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	  return regex.test(email);
	}
	
	/* when we update the amount */
	$("#expForm").delegate(".amtVal", "keyup keypress keydown blur change", function (event) {
                // Allow special chars + arrows 
				if(event.type == 'keyup' || event.type == 'keyup' || event.type == 'keydown'){				
					// check its a key event
					if ((event.keyCode >= 48 && event.keyCode <= 57) || (event.keyCode >= 96 && event.keyCode <= 105) || event.keyCode == 8 || event.keyCode == 46 || event.keyCode == 9){
						//cal_total();
					}else{
						 event.preventDefault(); 
						 return false;
					}	
				}
				
				if(event.type == 'change'){ 
					
					if($('#page').val() == 'edit'){
						i = 0; 
						n = $('#rec_count').val();
					}else{
						i = 1;
						n = 4;
					}
					
					j = 0;
					val = 0;
					while(i <= n){ 
						if($('#amt_o'+i).length > 0){
							// replace special chars.
							new_val = $('#amt_o'+i).val().replace(/[^0-9]+/g, "");
							$('#amt_o'+i).val(new_val);
						}
						
						if(parseInt($('#amt_o'+i).val(), 10) > 0){
							
							var txt_value = parseInt($('#amt_o'+i).val(), 10);		
							val = val + txt_value;
						}
						i++;
						
					}
						
						// multiple option
					if($('#form_count').val() > 0){
						if($('#amt_'+i).length > 0){
							// replace special chars.
							new_val = $('#amt_'+j).val().replace(/[^0-9]+/g, "");
							$('#amt_'+j).val(new_val);
						}	
						while(j <= $('#form_count').val()){							
							if(parseInt($('#amt_'+j).val(), 10) > 0){
								var txt_value = parseInt($('#amt_'+j).val(), 10);		
								val = val + txt_value;
							
							}
							j++;
						}
					}
					
					$('#totAmt').val(val);
					
                      
               } 
		});	
		
		/* function to validate travel request */
		$('.save_journey').click(function(){			
			var form_fields = new Array('customer','purpose','journey_date','tvlclass','source','dest','outcome');
			var valid_msgs =  new Array('Please select the customer', 'Please enter the purpose', 'Please select the date of travel',
			'Please select any class', 'Please select the source place','Please select the destination place','Please enter the expected outcome'
			);				
			var submit = true;	var submit2 = true;		var submit3 = true;
			// for return trip
			if($('.tvlType:checked').val() == 2){	
				if($('#return_date').val() == ''){					
					$('.return_date').html('Please select the return date');
					submit2 = false;
				}else if($('#return_date').val() != ''){
					$('.return_date').html('');
				}
			}else{
				$('.return_date').html('');				
			}
			j= 0;
			while(j < form_fields.length){
				// if empty show the error msg.
				if($('#'+form_fields[j]).val() == '' || $('#'+form_fields[j]).val() ==  null){					
					$('.'+form_fields[j]).html(valid_msgs[j]);
					submit = false;
				}else if($('#'+form_fields[j]).val() != ''){
					$('.'+form_fields[j]).html('');
				}
				j++;
			}
			
			// for debit to client
			if($('.debitTravel').is(':checked') == false){	
				$('.debit_travel').html('Please select debit to client');
				submit3 = false;				
			}else if($('.debitTravel:checked').val() == 'N' && $('#debit_to').val() == ''){	
				$('.debit_travel').html('Please select debit to client');
				submit3 = false;				
			}else{				
				$('.debit_travel').html('');				
			}
			$('.serverErr').remove();
			if(submit && submit2 && submit3){
				// hide buttons
				$('.hideBtn').hide();
				return true;
			}else{
				return false;
			}
			
			
		});
		
		/* function to validate the travel passengers */
		$('.save_passenger').click(function(){	
			res = validateTskForm('tvlForm');		
			if(res == true){			
				$('.hideBtn').hide();
				return true;
			}			
			return res;
			
		});
		
		/* function to call when drive form is blurred */
		$('.validateBusiness input,select,textarea,checkbox,radio').focusout(function(){ 
			return validate_new_business($(this).attr('id'));
		});
		
		$('.save_business').click(function(){
			return validate_new_business('submit');
		});
		
			
		
		/* function to validate the confirmation travel */
		$('.tvlConfirm').click(function(){	
			$('.hideBtn').hide();
		});
		
		/* function to validate advance form */
		$('.send_adv').click(function (){
			var submit = true;
			var form_field = new Array('purpose', 'required date', 'amount', 'description','debit to client'); 
			for(i = 1; i <= 5; i++){
				// if empty show the error msg.
				if($('#field'+i).val() == ''){				
					$('.field'+i).html('Please enter the '+form_field[i-1]);
					submit = false;
				}else if(i == '5'){	
					if($('.advDebit').is(':checked') == false){						
						$('.field5').html('Please select '+form_field[i-1]);
						submit = false;							
					}	// check client selected if true	
						
					else if($('.advDebit').is(':checked') == true && $('.comp_list').val() == '' && $('#Field51').is(':checked')){						
						$('.field5').html('Please select the client');
						submit = false;							
					}else{
						$('.field5').html('');
					}
			
						
				}else if($('#field'+i).val() != '' && i == 3){
					// numeric validation for amount
					valid = validate_numeric($('#field'+i).val());	
					if(valid == false){submit = valid;$('.field3').html('Please enter valid '+form_field[i-1] + ' (numeric only)');}else{$('.field3').html('');}
				}else if($('#field'+i).val() != ''){
					$('.field'+i).html('');
				}
			}
			if(submit == true){
				//$('.cancel_send').hide();
				// apply style for the button
				var buttonsConfig = [
				{
					text: "Yes",
					"class": "btn btn-green",
					click: function() {
						$(this).html('Processing.. Pls wait..');
						$('.ui-dialog-buttonset').hide();
						$('#formID').attr('action', url); 
						$('#formID').submit();
						submit = true;
					}
				},
				{
					text: "No",
					"class": "btn",
					click: function() {	
						$( this ).dialog( "close" );
						submit = false	
					}
				}
			];
				
				url = $('#post_data').val();
				submit = false;
				$( "#dialog-confirm" ).dialog({
				resizable: false,
				height:180,
				modal: true,
				buttons: buttonsConfig
				
			});
		
			}
			return submit;			
						
		});
		
		/* function to pay the advance */
		/* function to validate advance form */
		$('.pay_adv').click(function (){
			var submit = true;
			var form_field = new Array('amount', 'date of payment', 'mode of payment');
			for(i = 1; i <= 3; i++){
				// if empty show the error msg.
				if($('#field'+i).val() == ''){					
					$('.field'+i).html('Please enter the '+form_field[i-1]);
					submit = false;
				}else if($('#field'+i).val() != '' && i == 1){
					// numeric validation for amount
					valid = validate_numeric($('#field'+i).val());	
					if(valid == false){submit = valid;$('.field1').html('Please enter valid '+form_field[i-1] + ' (numeric only)');}else{$('.field1').html('');}
				}else if($('#field'+i).val() != ''){
					$('.field'+i).html('');
				}
			}
			if(submit == true){
				// apply style for the button
				var buttonsConfig = [
				{
					text: "Yes",
					"class": "btn btn-green",
					click: function() {
						$(this).html('Processing.. Pls wait..');
						$('.ui-dialog-buttonset').hide();
						$('#formID').attr('action', url); 
						$('#formID').submit();
						submit = true;
					}
				},
				{
					text: "No",
					"class": "btn",
					click: function() {	
						$( this ).dialog( "close" );
						submit = false	
					}
				}
			];
				
				url = $('#post_data').val();
				submit = false;
				$( "#dialog-confirm" ).dialog({
				resizable: false,
				height:180,
				modal: true,
				buttons: buttonsConfig
				
			});
		
			}
			return submit;			
						
		});
		
			/* function to pay the advance */
		/* function to validate advance form */
		$('.pay_exp').click(function (){
			var submit = true;
			var form_field = new Array('adjust against advance', 'Payment Date', 'Payment Mode');
			for(i = 1; i <= 3; i++){			
				// if empty show the error msg.
				if($('#field'+i).val() == '' && i != 1){		
					$('.field'+i).html('Please select the '+form_field[i-1]);
					submit = false;
				}else if($('#field'+i).is(':checked') == false && i == 1){	
					if(parseInt($('#tot_advance').val(), 10) < parseInt($('#expense').val(), 10)){
						$('.field'+i).html('Please select the '+form_field[i-1]);
						submit = false;
					}
				}else if($('#field'+i).val() != ''){ 
					$('.field'+i).html('');
				}else if($('#field'+i).val() == '' && $('#amount').val() == 0){		
					$('.field'+i).html('');					
				}
			}
			if(submit == true){
				// apply style for the button
				var buttonsConfig = [
				{
					text: "Yes",
					"class": "btn btn-green",
					click: function() {
						$(this).html('Processing.. Pls wait..');
						$('.ui-dialog-buttonset').hide();
						$('#formID').attr('action', url); 
						$('#formID').submit();
						submit = true;
					}
				},
				{
					text: "No",
					"class": "btn",
					click: function() {	
						$( this ).dialog( "close" );
						submit = false	
					}
				}
			];
				
				url = $('#post_data').val();
				submit = false;
				$( "#dialog-confirm" ).dialog({
				resizable: false,
				height:180,
				modal: true,
				buttons: buttonsConfig
				
			});
		
			}
			return submit;			
						
		});
		
	
		
		/* function to validate advance form */
		$('.tsk_add_file').on('click', function (){
			var submit = true;
			var form_field = new Array('Please enter the title', 'Please enter the description', 'Please assign users');
			for(i = 0; i <= 2; i++){	
				// if empty show the error msg.
				if($('#field'+i).val() == '' || $('#field'+i).val() == null){		
					$('.field'+i).html(form_field[i]);
					submit = false;
				}else if($('#field'+i).val() != '' && $('#field'+i).val() != null){
					$('.field'+i).html('');
				}
			}
			
			// for team validation
			
			if($('#edit_file').val() == '0'){
				if($('.plupload_done').length > 0){
					$('.field4').html('');
					$('#file_upload').val(1);
				}else{
					$('.field4').html('Please upload file');
					submit = false;
				}
			}
			// show confirm for inactive status in edit event
			if(submit == true){
				if($('#edit_file').val() == '1'){ // validate status field
					if($('#evt_stat').val() == '0'){
						if(confirm('Are you sure? Inactive files will not be visible to assigned users.')){
							
						}else{
							submit = false;
						}					
					}				
				}
			}
			
			if(submit == true){
				$('.can_btn').hide();
			}
			return submit;			
						
		});
		
		/* function to validate advance form */
		$('.save_event').on('click', function (){
			var submit = true;
			var form_field = new Array('Please enter the event title', 'Please select the event start and end time', 'Please select the event type', 'Please select the event status');
			for(i = 0; i <= 3; i++){	
				// if empty show the error msg.
				if($('#field'+i).val() == '' || $('#field'+i).val() == null){		
					$('.field'+i).html(form_field[i]);
					submit = false;
				}else if($('#field'+i).val() != '' && $('#field'+i).val() != null){
					$('.field'+i).html('');
				}
			}		
			
			return submit;			
						
		});
			

		/* function to show value in pay expense */
		$('.adj_adv').click(function (){
			emp_pay = parseInt($('#expense').val(), 10) - parseInt($('#sum_adv').val(), 10);	
			
			// when the adjust is checked
			if($('.adj_adv').is(':checked')){

				if($('#balance').val() > 0){
					emp_pay =  emp_pay - $('#balance').val();					
				}
				
				if(emp_pay > 0){					
					$('#pay_emp').text(emp_pay);
					$('#amount').val(emp_pay);	
					update_balance_ajdustadv();		
				}else if(emp_pay < 0){ 
					$('#pay_emp').text('0');
					$('#amount').val('0');
					// update balance in hand
					$('#balance_hand').text(Math.abs(emp_pay));
					$('#balance').val(Math.abs(emp_pay));
					$('#balance_final').val(Math.abs(emp_pay));
					
				}else if(emp_pay == 0){
					$('#pay_emp').text(emp_pay);
					$('#amount').val(emp_pay);	
					// update balance in hand
					$('#balance_hand').text(Math.abs(emp_pay));
					$('#balance').val(Math.abs(emp_pay));
					$('#balance_final').val(Math.abs(emp_pay));
				}
				
				else{
					$('#pay_emp').text($('#expense').val());
					$('#amount').val($('#expense').val());
					
				}				
			}else{
				$('#pay_emp').text('0');
				$('#amount').val('0');
				update_balance();
				$('#amt_received').show();
			}

		});
		
		/* show the balance in hand */
		if($('#balance').length > 0){ 
			// amount paid to employee
			emp_pay = (parseInt($('#expense').val(), 10) - parseInt($('#sum_adv').val(), 10));		    
			if(emp_pay < 0){
				$('#balance_hand').text(Math.abs(emp_pay));
				$('#balance').val(Math.abs(emp_pay));
				$('#balance_final').val(Math.abs(emp_pay));				
			}
			// previous balance
			balance_hand = parseInt($('#prev_balance').val(), 10)
			if(balance_hand > 0){				
				$('#balance_hand').text(balance_hand);
				$('#balance').val(balance_hand);
				$('#balance_final').val(balance_hand);	
			}
			
		}
		
		/* function to update the balance in  hand */
		function update_balance(){
			emp_pay = parseInt($('#expense').val(), 10) - parseInt($('#sum_adv').val(), 10);		
			if(emp_pay < 0){
				$('#balance_hand').text(Math.abs(emp_pay));
				$('#balance').val(Math.abs(emp_pay));
				$('#balance_final').val(Math.abs(emp_pay));			
			}
			// previous balance
			balance_hand = parseInt($('#prev_balance').val(), 10)
			if(balance_hand > 0){				
				$('#balance_hand').text(balance_hand);
				$('#balance').val(balance_hand);
				$('#balance_final').val(balance_hand);	
			}
		}
		
		/* function to update the balance in  hand */
		function update_balance_ajdustadv(){				
			if(($('#amount').val(), 10) > 0){
				$('#balance_hand').text(0);
				$('#balance').val(0);
				$('#balance_final').val(0);	
				//if($('.adj_adv').is(':checked')){
					//$('#amt_received').hide();
				//}else{
				$('#amt_received').hide();
				//}
			}
			
		}
		
		/* when amt. received is entered */
		$('#amt_received').change(function (){
			update_balance();
			balance = parseInt($('#balance').val(), 10) - parseInt($('#amt_received').val(), 10);			
			if(balance >= 0 && $(this).val() > 0){
				$('#balance_hand').text(balance);
				$('#balance_final').val(balance);
			}
			
		});
		
		/* load the current tab in view emp */
		if($('#load_tab').length > 0){
			tab = window.location.hash;
			var fields = new Array('personal','education','experience','family');	
			j = 1;
			flag = 0;
			for(i = 0; i <= fields.length; i++){
				if(tab == '#'+fields[i]){ 
					$('#p'+j).addClass('active');
					$('.c'+j).fadeIn();
					flag = 1;
				}else{
					$('#p'+j).removeClass('active');
					$('.c'+j).hide();					
				}
				j++;
			}
			// if no one selected
			if(flag == 0){
				$('#p1').addClass('active');
				$('.c1').fadeIn();
			}
			
		}
		
		/* change steps in view employee */
		$('.regViewStep').click(function(){
			sel = $(this).attr('rel');
			for(i = 1; i <= 4; i++){
				if(sel == i){
					$('#p'+i).addClass('active');
					$('.c'+i).fadeIn();
				}else{
					$('#p'+i).removeClass('active');
					$('.c'+i).hide();
					
				}
			}
		});
		
		/* source of referal change */
		$('.bdreferSource').change(function(){
			if($(this).val() != '1' && $(this).val() != '2' && $(this).val() != '4'){
				$('.referField').show();
			}else{
				$('.referField').hide();
			}
		});
		
		if($('.bdreferSource').length > 0){
			if($('.bdreferSource').val() != '1' && $('.bdreferSource').val() != '2' && $('.bdreferSource').val() != '4' && $('.bdreferSource').val() != ''){
				$('.referField').show();
			}else{
				$('.referField').hide();
			}
		}
		
		/* retain form value in pay expense */
		if($('#balance_final').length > 0 && $('#amount').length > 0){
			// if form is posted
			
			if($('#balance_final').val() >= 0 && $('#balance_final').val() != ''){
				$('#balance_hand').text($('#balance_final').val());
			}
			// if form is posted
			if($('#amount').val() >= 0  && $('#amount').val() != ''){
				$('#pay_emp').text($('#amount').val());
			}
			
		}
		
		/* color picker */
		$('#skin-colorpicker').change(function (){	
			color = get_color($(this).val());			
			add_color_theme(color);			
		});
		
		/* color picker for patterns */
		$('.patterns').click(function (){	
			color = $(this).attr('rel');	
			match = color.split('-');
			href = $('#css_root').val()+'css/patterns/'+match[0]+'.css';
			var cssLink = $("<link rel='stylesheet' type='text/css' id='"+match[0]+"' href='"+href+"'>");			
			$("head").append(cssLink); 
			// set the cookie 			
			$.cookie('my_login_pattern_cookie', match[0], { expires: 365, path: '/' });			
			remove_pattern_css(match[0]);
			// add matching top
			add_theme_top(match[1]);
		});
		
		/* load the cookie css for themes  */
		if($('#css_root').length > 0){
			// for patterns
			pattern = $.cookie('my_login_pattern_cookie');
			if(pattern != '' && pattern != undefined){
				href = $('#css_root').val()+'css/patterns/'+pattern+'.css';
				var cssLink = $("<link rel='stylesheet' type='text/css' id='"+pattern+"' href='"+href+"'>");	
				$("head").append(cssLink)
			}
		}
	
		/* run menu counts in all pages in ajax */
		if($('.actionCount').length > 0){
			switch_mod_count();
			window.setTimeout(switch_mod_count, 60000);
		}
		
		/* load the cookie css for themes 
		if($('#css_root').length > 0){
			// read cookie
			color = $.cookie('my_login_cookie');
			// set the default theme			
			if(color == undefined || color == ''){
				color = 'blue';
			}
				
			href = $('#css_root').val()+'css/themes/'+color+'.css';
			var cssLink = $("<link rel='stylesheet' type='text/css' id='"+color+"' href='"+href+"'>");	
			$("head").append(cssLink); 
			
			code = get_color_code(color); 
			$.cookie('my_login_cookie', color, { expires: 365, path: '/' });
			$.cookie('my_login_cookie_code', code, { expires: 365, path: '/' });	

			// for patterns
			pattern = $.cookie('my_login_pattern_cookie');
			if(pattern != '' && pattern != undefined){
				href = $('#css_root').val()+'css/patterns/'+pattern+'.css';
				var cssLink = $("<link rel='stylesheet' type='text/css' id='"+pattern+"' href='"+href+"'>");	
				$("head").append(cssLink)
			}
			
			
			// for event calendar	
			/*
			calendar = $.cookie('pdca_event_cal');			
			if(calendar != '' && calendar != undefined){ 
				href = $('#css_root').val()+'full_calendar/css/jquery-ui-1.10/css/'+calendar+'/jquery-ui-1.10.4.custom.css';
				var cssLink = $("<link rel='stylesheet' type='text/css'  href='"+href+"'>");	
				//$("head", window.frames['eventFrame'].document).append(cssLink);
				var $head = $("iframe").contents().find("head");                
				$head.append($("<link/>", 
				{ rel: "stylesheet", href: href, type: "text/css" }));
			}
			*/

	/*	} */
		
		/* boot js for team links */
		$(document).on("click", ".bootjs", function(e) {
           /* bootbox.alert("Hello world!", function() {
                console.log("Alert Callback");
            });
			*/
			var some_html = '<img src="images/bootstrap_logo.png" width="100px"/><br />';
			some_html += '<h2>You can use custom HTML too!</h2><br />';
			some_html += '<h4>Just be sure to mind your quote marks</h4>';
			bootbox.alert(some_html);
			
        });
		
		// load the color box
		$('.iframeBox').click(function(){
			load_colorBox(this, $(this).attr('val'));	
		});
		
		if($('.bghelp').length > 0){
			$('.bghelp').colorbox({rel:'bghelp',width:'68%', height:'75%'});		
		}
		
		
		
		/* to open the profile details */
		
		$('.openProf').on('click', function(){ 
			// hide all profiles
			$('.profSummary').hide();
			// show only the selected
			$('.member_'+$(this).attr('id')).show();
			// open the modal
			$('#myModal').modal({show:true})
		});
		
		$('.moreNews').on('click', function(){ 
			// hide all profiles
			$('.news-detail').hide();
			// show only the selected
			$('.news_'+$(this).attr('id')).show();
			// open the modal
			$('#newsModal').modal({show:true})
		});
		
		/* for gallery */
		if($(".colorbox").length > 0){
			$(".colorbox").colorbox({ 
				maxWidth: "60%",
				maxHeight: "60%",
				rel: $(this).attr("rel")
			});
		}
		
		$(".staticColorBox").colorbox({iframe:true, width:"50%", height:"45%"});
		
		
		/* for picking t-shirt size 
		if($('#shirt_size').length > 0 && $('#shirt_size').val() == ''){
			$.colorbox({width:"60%",height: "80%", iframe:true,overlayClose:false, href: $('#webroot').val()+'home/check_tshirt/'});
			$('#cboxClose').hide();
			//return false;
		}
		*/

		/* for notification of info. */
		if($('#notifyHome').length > 0 && $('#notifyHome').val() != '1'){
			//$.colorbox({width:"45%",height: "55%", iframe:true,overlayClose:false, href: $('#webroot').val()+'home/notify_user/'});		
			//$('#cboxClose').hide();	
			//return false;
		}	
		
		/* notify for IT asset assigning */
		if($('#notifyHome').length > 0 && $('#notifyHome').val() != '1'){
			$.colorbox({width:"45%",height: "85%", iframe:true,overlayClose:false, href: '../it/fr_it_pop_up.php'});		
			// $('#cboxClose').hide();	
			return false;
		}	
		
	
		
		/* for leave policy */
		if($(".colorboxPolicy").length > 0){
			$(".colorboxPolicy").colorbox({ 
				width: "80%",
				height: "95%",
				iframe:true,
				scrolling: true,
				fixed:true,
				overlayClose:true
			});
		}
		
		
		
		/* for prev. year leave details */
		$('.prev_leaves').click(function(){
			$('#bal_leaves').toggle();
		});
		
		
		/* function for survey form 
		$(document).bind('cbox_open', function(){
			$('#cboxClose').hide();
		});
		*/
		
		/* to open the coming soon details */
		
		$('.comingSoon').click(function(){
			// open the modal
			$('#comingSoon').modal({show:true})
		});
		
		/* to open the holiday details */
		
		$('.holidayPop').click(function(){
			// open the modal
			$('#holidayPop').modal({show:true})
		});
		
		/* to open leave status */
		$('.leave_status').click(function(){
			// open the modal
			$('#leave_status').modal({show:true})
		});
		
		// multi-select
	if($('.multiselect').length > 0){
		$(".multiselect").each(function(){
			var $el = $(this);
			var selectableHeader = $el.attr('data-selectableheader'),
			selectionHeader  = $el.attr('data-selectionheader');
			if(selectableHeader != undefined)
			{
				selectableHeader = "<div class='multi-custom-header'>"+selectableHeader+"</div>";
			}
			if(selectionHeader != undefined)
			{
				selectionHeader = "<div class='multi-custom-header'>"+selectionHeader+"</div>";	
			}
			$el.multiSelect({
				selectionHeader : selectionHeader,
				selectableHeader : selectableHeader
			});
		});
	}
	
	
	/*
	$('.pl_start').click(function (){ alert('ravi');
		//$(".plupload_buttons").show();
	}); 
	
	$('.removeFile').live('click',function(){
		uploader.removeFile(uploader.getFile(this.id));
	});
	*/
	
	/* for project plan */
	if($('#plan_task').length > 0){
		if($('#plan_task').val() == 1 && $('#page').val() == 'edit'){
			if($('.plan_type_sel').val() == 'P'){
				$('.input_pp').addClass('required');
			}else{
				$('.input_dp').addClass('required');
			}
			// enable date 
			sheepit_load_task_date();
			
		}
	}
	
	/* event calendar in home page */
	if($("#HomeCalendarDefault").length > 0){
		$("#HomeCalendarDefault").eventCalendar({
			eventsjson: $('#webroot').val()+'home/show_task/',
			jsonDateFormat: 'human',
			eventsScrollable:false,
			txt_SpecificEvents_after:'Tasks',
			txt_NextEvents:'Today\'s Tasks',
			showDescription:true,
			txt_noEvents: 'No tasks found <a href="'+$('#webroot').val()+'tskplan/?type=D">Click Here</a> to create',
			eventsScrollable:true
		});
	}
	
	
	// PlUpload
	if($('.plupload').length > 0){		
		$(".plupload").each(function(){
			var $el = $(this);
			$el.pluploadQueue({
				runtimes : 'html5,gears,flash,silverlight,browserplus',
				url : $('#root').val()+'tskfile/upload_file/',
				max_file_size : '5mb',
				//chunk_size : '1mb',
				unique_names : true,
				multiple_queues : true,
				//resize : {width : 320, height : 240, quality : 90},
				filters : [
				{title : "Image files", extensions : "jpg,gif,png"},
				{title : "Zip files", extensions : "zip"},
				{title : "Document files", extensions : "pdf,doc,docx,xls,xlsx,txt"},
				],
				flash_swf_url : 'js/plupload/plupload.flash.swf',
				silverlight_xap_url : 'js/plupload/plupload.silverlight.xap'
			});
			$(".plupload_header").remove();
			
			var upload = $el.pluploadQueue();
			
			$(".plupload_filelist_header,.plupload_progress_bar,.plupload_start").show();
			//$(".plupload_filelist_header,.plupload_progress_bar,.plupload_start").remove();
				/*$(".plupload_droptext").html("<span>Drop files to upload</span>");
				$(".plupload_progress").remove();
				$(".plupload_add").text("Or click here...");
				upload.bind('FilesAdded', function(up, files) {
					setTimeout(function () { 
						up.start(); 
					}, 500);
				});
				
				upload.bind("QueueChanged", function(up){
					$(".plupload_droptext").html("<span>Drop files to upload</span>");					
				});
				upload.bind("StateChanged", function(up){ 
					$(".plupload_upload_status").remove();
					$(".plupload_buttons").show();
				});*/
				
				upload.bind('uploaded', function(up, files) {
					//$.each(files, function(i, file) { 
						//$('#filelist').append('<div id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b>' +
						//'<span id="'+file.id+'" class="removeFile"> Remove from queue</span></div>');
					//});
				});
			
			if($el.hasClass("pl-sidebar")){
				$(".plupload_filelist_header,.plupload_progress_bar,.plupload_start").remove();
				$(".plupload_droptext").html("<span>Drop files to upload</span>");
				$(".plupload_progress").remove();
				$(".plupload_add").text("Or click here...");
				upload.bind('FilesAdded', function(up, files) {
					setTimeout(function () { 
						up.start(); 
					}, 500);
				});
				
				upload.bind("QueueChanged", function(up){
					$(".plupload_droptext").html("<span>Drop files to upload</span>");					
				});
				upload.bind("StateChanged", function(up){ 
					$(".plupload_upload_status").remove();
					$(".plupload_buttons").show();
				});
				
				 
			} else {
				//$(".plupload_progress_container").addClass("progress").addClass('progress-striped');
				//$(".plupload_progress_bar").addClass("bar");
				$(".plupload_button").each(function(){
					if($(this).hasClass("plupload_add")){ 
						//$(this).attr("class", 'btn pl_add btn-primary').html("<i class='icon-plus-sign'></i> "+$(this).html());
					} else {
						//$(this).attr("class", 'btn pl_start btn-success').html("<i class='icon-cloud-upload'></i> "+$(this).html());						
					}
					
				});
				
			}
		});
	}
	
	/* close the color palette 
	$(document).click(function(e){ 
		if($('#ace-settings-box').length > 0){ 
			if($('#ace-settings-box').is(":visible") && !$(e.target).hasClass('ace-settings-box')){
				$("#ace-settings-box").fadeOut();
			}
		}
	});
	
	$('.ace-settings-container > #ace-settings-btn').click(function(e){ 
		event.stopPropagation();
	});	*/
	
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
	
	/*
	var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"95%"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }*/
	
	// calculate no. of days for comp. off.
	$('.leave_type_id').change(function(){
		// check if comp. off
		if($(this).val() == '7' || $(this).val() == '6'  || $(this).val() == '4'){
			days = get_leave_diff($(".fromDate").val(), $(".toDate").val());
			$('#no_days').text(days);
			$('#nodays').val(days);	
		}else{
			// update only working days
			check_no_days($(".fromDate").val(), $(".toDate").val());
		}
	});
	
		
		
		/* request change in hr */
		$('.chgReq').click(function(){
			// open the modal
			$('#chgReq').modal({show:true})
			// hide succ. msg and open form
			//$('#chgSuccess').hide();
			//$('#chgReqFrm').show();
			
			
		});
		
		
		/* function to validate leave form */
		$('.send_lve').click(function (){
			var submit = true;
			var form_field = new Array('Please select leave from date', 'Please select leave till date', 'Please select leave type', 'Please enter the reason');
			for(i = 1; i <= 4; i++){
				// if empty show the error msg.
				if($('#field'+i).val() == ''){					
					$('.field'+i).html(form_field[i-1]);
					submit = false;
				}else if($('#field'+i).val() != ''){ 
					$('.field'+i).html('');
				}
			}
			
			// for no. of days validation
			if($('#field0').val() != '' && $('#field1').val() != ''){
				if($('#nodays').val() == 0 || $('#nodays').val() == '' ){
					$('.no_days_error').html('No. of days must be atleast one');
					submit = false;
				}else{
					$('.no_days_error').html('');
				}
			}
			
			
			// validate comp. off
			if($('.comp_off').val() == '7'){
				// validate if empty
				if($('#compoff_box').val() == '' || $('#compoff_box').val() == null){					
					$('.field5').html('Please select the date of working');
					submit = false;
				}else{
					$('.field5').html('');
				}
				// validate if not matching				
				var comp_date = $('#compoff_box').val();
				if(comp_date !=  null){
					//var comp_length = comp_date.toString().split(',');
					if(comp_date.length != $('#nodays').val()){
						$('.field5').html('No. of comp. off days not matching with no. of days selected');
						submit = false;
					}else{
						$('.field5').html('');
					}
				}
			}else{
				$('.field5').html('');
			}
			
			if(submit == true){
				// apply style for the button
				var buttonsConfig = [
				{
					text: "Yes",
					"class": "btn btn-green",
					click: function() {
						$(this).html('Processing.. Pls wait..');
						$('.ui-dialog-buttonset').hide();
						$('#formID').attr('action', url); 
						$('#formID').submit();
						submit = true;
					}
				},
				{
					text: "No",
					"class": "btn",
					click: function() {	
						$( this ).dialog( "close" );
						submit = false	
					}
				}
			];
				
				url = $('#post_data').val();
				submit = false;
				$( "#dialog-confirm" ).dialog({
				resizable: false,
				height:180,
				modal: true,
				buttons: buttonsConfig
				
			});
		
			}
			return submit;			
						
		});
		
		/* function to validate permission form */
		$('.send_perm').click(function (){
			var submit = true;
			var post_cond = false;
			var form_field = new Array('Please select date of permission', 'Please select permission from time', 'Please select permission to time', 'Please enter the reason');
			for(i = 1; i <= 4; i++){
				// if empty show the error msg.
				if($('#field'+i).val() == ''){					
					$('.field'+i).html(form_field[i-1]);
					submit = false;
				}else if($('#field'+i).val() != ''){
					$('.field'+i).html('');
				}
			}
			// post dated permission validation
			if(submit == true){
				result = post_dated_perm($('#field1').val(), 'time');				
				if(result == false){
					return false;
				}				
				post_cond = result;				
			}
		
			if(submit == true && post_cond == true){ 
				// apply style for the button
				var buttonsConfig = [
				{
					text: "Yes",
					"class": "btn btn-green",
					click: function() {
						$(this).html('Processing.. Pls wait..');
						$('.ui-dialog-buttonset').hide();
						$('#formID').attr('action', url); 
						$('#formID').submit();
						submit = true;
					}
				},
				{
					text: "No",
					"class": "btn",
					click: function() {	
						$( this ).dialog( "close" );
						submit = false	
					}
				}
			];
				
				url = $('#post_data').val();
				submit = false;
				$( "#dialog-confirm" ).dialog({
				resizable: false,
				height:180,
				modal: true,
				buttons: buttonsConfig
				
			});
		
			}
			return submit;			
						
		});
		
		
		
		/* function to validate att. change form */
		$('.att_changeReq').click(function (){
			var submit = true;
			var form_field = new Array('Please select date of attendance', 'Please choose attendance type','please enter the reason');
			for(i = 1; i <= 3; i++){
				// if empty show the error msg.
				if(i == '2'){
					// validate type
					if($('#attType').val() == ''){
						$('.field'+i).html(form_field[i-1]);
						submit = false;
					}else{
						$('.field'+i).html('');
					}
					
				}else if($('#field'+i).val() == ''){					
					$('.field'+i).html(form_field[i-1]);
					submit = false;
				}else if($('#field'+i).val() != ''){
					$('.field'+i).html('');
				}
			}
			submit2 = validate_time($('#attType').val());
			
			if(submit == true && submit2 == true){
				// apply style for the button
				var buttonsConfig = [
				{
					text: "Yes",
					"class": "btn btn-green",
					click: function() {
						$(this).html('Processing.. Pls wait..');
						$('.ui-dialog-buttonset').hide();
						$('#formID').attr('action', url); 
						$('#formID').submit();
						submit = true;
					}
				},
				{
					text: "No",
					"class": "btn",
					click: function() {	
						$( this ).dialog( "close" );
						submit = false	
					}
				}
			];
				
				url = $('#post_data').val();
				submit = false;
				$( "#dialog-confirm" ).dialog({
				resizable: false,
				height:180,
				modal: true,
				buttons: buttonsConfig
				
			});
		
			}
			return false;			
						
		});
		
		/* function to validate roa request form */
		$('.send_roa').click(function (){
			var submit = true;
			var form_field = new Array('Please choose type', 'Please select the employee(s)', 'Please select the employee(s)','Please enter the details', 'Please select your rating',
			'Please select the recognition month','Please select any one','Please enter the details');
			for(i = 2; i <= 8; i++){ 
				if(i == 5){
					if($('#ratingHdn').val() == 1 || $('#ratingHdn').val() == ''){
						$('.field5').html(form_field[4]);
						submit = false;
					}else{
						$('.field'+i).html('');
					}					
				}else if(i == 2 || i == 3){  // validate employee
					if($('.recommendType:checked').val() == 'I' && $('#field2').val() == '' ){
						$('.field2').html(form_field[1]);
						submit = false;
					}else if($('.recommendType:checked').val() == 'T' && ($('#field3').val() == '' || $('#field3').val() == null) ){
						$('.field2').html(form_field[1]);
						submit = false;
					}else if($('.recommendType:checked').val() == 'T' && ($('#field3').val().length == '1') ){
						$('.field2').html('Team should have atleast two employees');
						submit = false;
					}else{
						$('.field'+i).html('');
					}					
				}else if($('#field'+i).val() == ''  || $('#field'+i).val() == null ){			
					$('.field'+i).html(form_field[i-1]);
					submit = false;
				}else if($('#field'+i).val() != '' && $('#field'+i).val() != null){
					$('.field'+i).html('');
				}
			}
			
			if(submit == true){ 
				// apply style for the button
				var buttonsConfig = [
				{
					text: "Yes",
					"class": "btn btn-green",
					click: function() {
						$(this).html('Processing.. Pls wait..');
						$('.ui-dialog-buttonset').hide();
						$('#formID').attr('action', url); 
						$('#formID').submit();
						submit = true;
					}
				},
				{
					text: "No",
					"class": "btn",
					click: function() {	
						$( this ).dialog( "close" );
						submit = false	
					}
				}
			];
				
				url = $('#post_data').val();
				submit = false;
				$( "#dialog-confirm" ).dialog({
				resizable: false,
				height:180,
				modal: true,
				buttons: buttonsConfig
				
			});
		
			}
			return false;			
						
		});
		
		/* function to validate time */
		function validate_time(type){
			submit = true;
			
			var form_field = new Array('Please select in time', 'Please select out time');
			 if(type == 'O'){ // validate out time
				if($('#field5').val() == ''){
					$('.field5').html(form_field[1]);
					submit = false;
				}else{
					$('.field5').html('');
				}
			}else{ // validate both
				if($('#field4').val() == ''){
					$('.field4').html(form_field[0]);
					submit = false;
				}else{
					$('.field4').html('');
				}
				if($('#field5').val() == ''){
					$('.field5').html(form_field[1]);
					submit = false;
				}else{
					$('.field5').html('');
				}
			}
			
			return submit;
		}
	
		
		/* function to validate permission form */
		$('.send_gal').click(function (){
			var submit = true;
			var form_field = new Array('Please select the gallery title', 'Please upload photo');
			for(i = 1; i <= 1; i++){
				// if empty show the error msg.
				if($('#field'+i).val() == ''){					
					$('.field'+i).html(form_field[i-1]);
					submit = false;
				}else if($('#field'+i).val() != ''){
					$('.field'+i).html('');
				}
			}
			if(submit == true){
				// apply style for the button
				var buttonsConfig = [
				{
					text: "Yes",
					"class": "btn btn-green",
					click: function() {
						$(this).html('Processing.. Pls wait..');
						$('.ui-dialog-buttonset').hide();
						$('#formID').attr('action', url); 
						$('#formID').submit();
						submit = true;
					}
				},
				{
					text: "No",
					"class": "btn",
					click: function() {	
						$( this ).dialog( "close" );
						submit = false	
					}
				}
			];
				
				url = $('#post_data').val();
				submit = false;
				$( "#dialog-confirm" ).dialog({
				resizable: false,
				height:180,
				modal: true,
				buttons: buttonsConfig
				
			});
		
			}
			return submit;			
						
		});
		
		/* function to show day of week in request change att. */
		
		$('.attDate').change(function(){			
            var str2 = $('.attDate').val();
		// show the day of the date
			if(str2 != ''){
				att_frm = str2.split('/');				
				var dt = new Date(att_frm[1]+' '+att_frm[0]+ ' '+', '+att_frm[2]);
				day_mnth = get_week_day(dt.getDay()); 
				$('#attFrmDay').html(day_mnth);
			
			}
		});
		
		/* check from and to date */
		$('.changeDate').change(function(){			
            var str2 = $('.fromDate').val();
            var str4 = $('.toDate').val();
            var ONE_DAY = 1000 * 60 * 60 * 24;
            var dt2 = parseInt(str2.substring(0, 2), 10);
            var mon2 = parseInt(str2.substring(3, 5), 10);
            var yr2 = parseInt(str2.substring(6, 10), 10);
            var dt4 = parseInt(str4.substring(0, 2), 10);
            var mon4 = parseInt(str4.substring(3, 5), 10);
            var yr4 = parseInt(str4.substring(6, 10), 10);
            var date2 = new Date(yr2, mon2 - 1, dt2);
            var date4 = new Date(yr4, mon4 - 1, dt4);
            var date2_ms = date2.getTime();
            var date4_ms = date4.getTime();
            var difference_ms = Math.abs(date2_ms - date4_ms)
            var days = Math.round(difference_ms / ONE_DAY)
			days = ++days;
			
			// show the day of the date
			if(str2 != ''){
				lv_frm = str2.split('/');				
				var dt = new Date(lv_frm[1]+' '+lv_frm[0]+ ' '+', '+lv_frm[2]);
				day_mnth = get_week_day(dt.getDay()); 
				$('#lveFrmDay').html(day_mnth);
			
			}
			
			if(str4 != ''){
				lv_to = str4.split('/');				
				var dt = new Date(lv_to[1]+' '+lv_to[0]+ ' '+', '+lv_to[2]);
				day_mnth = get_week_day(dt.getDay()); 
				$('#lveToDay').html(day_mnth);
			
			}
			//$('#start_date').val(str2);
			
            if (date2 > date4) {
                $(".fromDate").val('');
                $(".toDate").val('');
				$('#no_days').text('#');
				$('.halfL').hide();
                alert("From Date should be lesser than To Date");
				// clear the day display
				$('#lveFrmDay').html('');
				$('#lveToDay').html('');
				
            }
            else if(days > 0) {				
				$('#no_days').text(days);
				$('#nodays').val(days);
				// check is checked
				if($('.is_half').is(':checked')){
					calculate_half();
				}
				$('.halfL').show();
				
				// calculate working days
				if($('.comp_off').val() != '7' && $('.comp_off').val() != '6' && $('.comp_off').val() != '4'){
					check_no_days($(".fromDate").val(), $(".toDate").val());
				}
				
            }
			
			// for post dated leaves
			
			var cur_date = new Date();
			//cur_month = cur_date.getMonth() + 1;
			//date5 = cur_date.getDate()+'/'+cur_month+'/'+cur_date.getFullYear();
			if(date2 < cur_date && $(this).attr('id') == 'field1' && $('.fromDate').val() != ''){
			
				// apply style for the button
				var buttonsConfig = [
				{
					text: "Yes",
					"class": "btn btn-green",
					click: function() {
						$( this ).dialog( "close" );
						submit = false	
					}
				},
				{
					text: "No",
					"class": "btn",
					click: function() {
						$(this).html('Oops! Redirecting page..');
						location.href =  $('#taken_url').val();
						submit = true;	
					}
				}
			];
				
				url = $('#taken_url').val();
				submit = false;
				$("#lv-dialog-confirm" ).dialog({
				resizable: false,
				height:180,
				modal: true,
				buttons: buttonsConfig	
				
				});
				
			}
			
			
		});
		
		/* function to call for search plan type */
		$('.srch_tsk_type').change(function (){ 
			if($(this).val() == 'P'){
				$('.tskCpny').show();
				$('.tskProj').show();
			}else{
				$('.tskCpny').hide();
				$('.tskProj').hide();
			}			
		});
		
		/* function to call for search plan type */
		if($('.srch_tsk_type').length > 0){
			if($('.srch_tsk_type').val() == 'P'){
				$('.tskCpny').show();
				$('.tskProj').show();
			}else{
				$('.tskCpny').hide();
				$('.tskProj').hide();
			}			
		}
		
		/* close the img previews */
		$('.previewDiv').on('click', function(event){ 
			var target = $( event.target);			  
			if($('.imgPreview').length > 0 && target.is( "a" ) == false){				
				$('.prevImg').popover('hide');
			}
		});
		
	/*
	$(".bdDashsortable").sortable({
			connectWith: ".box",
			items: ".box",
			opacity: 0.7,
			placeholder: 'widget-placeholder',
			forcePlaceholderSize: true,
			tolerance: "pointer",
			dropOnEmpty:false
	});
	$(".bdDashsortable").disableSelection();
	*/	
	
	/* sortable for BD home sorting */
	if($('.bdDashsortable').length > 0){
		$( ".bdDashsortable" ).sortable({
			placeholder: "widget-placeholder",
			forcePlaceholderSize: true,
			connectWith: ".box",
			dropOnEmpty:true,
			items: ".box",
			start: function(e, ui){
				//ui.placeholder.height(ui.item.height());
			},
			update: function(event, ui) {
				var info = $(this).sortable("serialize");
				//update_todo_order(info);
			}
		});
		$(".bdDashsortable").disableSelection();
	}
	
	/* function to validate file type */
	$('.validFileType').change(function(){	
		var fname = $(this)[0].files[0].name;
        var ext = fname.split('.').pop().toLowerCase();
		var allowed = $('#valid_file_type').val().split(',');
        if ($.inArray(ext, allowed) == -1) {
			$('.error_file_type').html("Unsupported File ("+fname+")! Allowed files are "+allowed);
			$(this).val('');
        }else{
			$('.error_file_type').html('');

		}	
	});
	
	/* function to validate file size */
	$('.validFileSize').change(function() {
		//check whether browser fully supports all File API
		if (window.File && window.FileReader && window.FileList && window.Blob){
			//get the file size and file type from file input field			
			var fsize = $(this)[0].files[0].size;
			var ftype = $(this)[0].files[0].type;
			var fname = $(this)[0].files[0].name;			
			if(fsize > 5242880){ //do something if file size more than 1 mb (1048576)			
				$('.error_file_size').html("Too big! (File: "+fname+"). Max. allowed size: 5M");	
				$(this).val('');
			}else{
				 $('.error_file_size').html('');
			}			  
		}else{
				alert("Please upgrade your browser latest chrome or firefox to upload file(s)");
		}
	});
		// Notifications
	$(".notify").click(function(){
		var $el = $(this);
		var title = $el.attr('data-notify-title'),
		message = $el.attr('data-notify-message'),
		time = $el.attr('data-notify-time'),
		sticky = $el.attr('data-notify-sticky'),
		overlay = $el.attr('data-notify-overlay');

		$.gritter.add({
			title: 	(typeof title !== 'undefined') ? title : 'Message - Head',
			text: 	(typeof message !== 'undefined') ? message : 'Body',
			image: 	(typeof image !== 'undefined') ? image : null,
			sticky: (typeof sticky !== 'undefined') ? sticky : false,
			time: 	(typeof time !== 'undefined') ? time : 3000
		});
		
		// for payslip generation
		if($('#paygen').length > 0){
			$('#formID').attr('action', $(this).attr('val'));
			$('#disablingDiv').show();
			$('#formID').submit();
			
		}
	});
		
		
	/* function to call when load ajax tabs in home */
	$('.ajaxTab').click(function(){		
		var para = $(this).attr('rel').split('-');			
		// check its a first time
		if($('#'+para[1]).val() == ''){
			load_profile_tab(para,$(this).attr('val'));				
		}
	});
		
		
		/* to print the screen */
		$(function() {	
			$('.print').click(function() {
				var container = $(this).attr('rel'); 
				$('#' + container).printArea();
				return false;
			});
		});
	
		/* to redirect */
		 $(".jsRedirect").each(function() {
			$(this).click(function() {
				location.href=jQuery(this).attr("val");
			});
		});
		
		/* send mail in employee */
		$('.sendEmail').click(function(){ 
			param = $(this).attr('name');
			perm = $(this).attr('val').split('_'); 
			if(perm[0] == '' && perm[1] == '' && perm[2] == ''){
				msg = 'Advance, Expense & Leave approver not set, still want to send ?';
			}else if(perm[0] == ''){
				msg = 'Advance approver not set, still want to send ?';
			}else if(perm[1] == ''){
				msg = 'Expense approver not set, still want to send ?';
			}else if(perm[2] == ''){
				msg = 'Leave approver not set, still want to send ?';
			}else if(perm[0] == '' || perm[1] == '' || perm[2] == ''){
				msg = 'Advance or Expense or Leave approver not set, still want to send ?';
			}else if(perm[0] != '' && perm[1] != '' && perm[2] != ''){
				msg = 'Are you sure you want to send ?';
			}		
				
			// set msg
			$('#alt_msg').html(msg);
				// apply style for the button
				var buttonsConfig = [
				{
					text: "Yes",
					"class": "btn btn-green",
					click: function() {
						$(this).html('Processing.. Pls wait..');
						$('.ui-dialog-buttonset').hide();
						$('#formID').attr('action', $('#del_url').attr('value')+param); 
						$('#formID').submit();
						submit = true;
					}
				},
				{
					text: "No",
					"class": "btn",
					click: function() {	
						$( this ).dialog( "close" );
						submit = false	
					}
				}
			];
				
				url = $('#post_data').val();
				submit = false;
				$( "#dialog-confirm" ).dialog({
				resizable: false,
				height:180,
				modal: true,
				buttons: buttonsConfig
				
			});		
			
			
		});
		
		/* function to mark in time */
		$('.mark-time').click(function(){ 
		    type = $(this).attr('rel');			
			// if in or out time only
			if(type == 'in' || type == 'out'){
				mark_time($(this).attr('rel'), 0);
			}else{
				//$(this).popover('hide');
			}
			
		});
		
		/* get spec. of course */
		$('.tskCpny').change(function(){			
			id = $(this).val();			
			$('.tskProj').empty();
			$('.tskEmp').empty().append('<option value="">Choose Employee</option>');
			$('.tskProj').append('<option>Loading...</option>');
			$.ajax({
			  url: $('#webroot').val()+'finexpense/get_projects/?id='+id	
			}).done(function( html ) {	
				$('.tskProj').empty();
				$('.tskProj').append(html);
			});	
		});
		
		/* get spec. of course */
		$('.tvlModeSel').change(function(){			
			id = $(this).val();			
			$('.tvlModeOpt').empty();
			$('.tvlModeOpt').append('<option>Loading...</option>');
			$.ajax({
			  url: $('#webroot').val()+'tvlreq/get_mode_option/?id='+id	
			}).done(function( html ) {	
				$('.tvlModeOpt').empty();
				$('.tvlModeOpt').append(html);
				// update chosen dynamic
				//$('.tvlModeOpt').val('').trigger('liszt:updated');
				$(".tvlModeOpt").trigger("chosen:updated");
			});
			
		});
		
		/* get project members */
		$('.tskProj').change(function(){			
			id = $(this).val();			
			$('.tskEmp').empty();
			$('.tskEmp').append('<option>Loading...</option>');
			$.ajax({
			  url: $('#webroot').val()+'tskassign/get_project_member/?id='+id	
			}).done(function( html ) {	
				$('.tskEmp').empty();
				$('.tskEmp').append(html);
				// update chosen dynamic
				//$('.tskEmp').val('').trigger('liszt:updated');
				$(".tskEmp").trigger("chosen:updated");
			});	
		});
		
		/* get spec. of course */
		$('.bdState').change(function(){			
			id = $(this).val();			
			$('.bdDist').empty();
			$('.bdDist').append('<option>Loading...</option>');
			$.ajax({
			  url: $('#webroot').val()+'get_district/?id='+id	
			}).done(function( html ) {	
				$('.bdDist').empty();
				$('.bdDist').append(html);
				$(".bdDist").trigger("chosen:updated");
			});	
		});
		
		/* update recommend employee */
		$('.recommendType').change(function(){ 
			if($(this).val() == 'I' || $(this).val() == undefined){
				$('.recommendEmp1').show();
				$('.recommendEmp2').hide();
			}else{
				$('.recommendEmp1').hide();
				$('.recommendEmp2').show();	
			}
			
		});
		
		if($('.recommendType').length > 0){
			if($('.recommendType:checked').val() == 'I'  || $('.recommendType:checked').val() == undefined){
				$('.recommendEmp1').show();
				$('.recommendEmp2').hide();
			}else{
				$('.recommendEmp1').hide();
				$('.recommendEmp2').show();	
			}
			
		}
		
		/* slider in roa */
		
		$( "#input-size-slider" ).css('width','200px').slider({
				value:1,
				range: "min",
				min: 1,
				max: 4,
				step: 1,
				slide: function( event, ui ) {
					var sizing = ['', '', '<i class="icon-star"></i>', '<i class="icon-star"></i> <i class="icon-star"></i>', '<i class="icon-star"></i> <i class="icon-star"></i> <i class="icon-star"></i>'];
					var title = ['', '', 'Improvement / Value Addition', 'Achievement / Exceeding Expectations', 'Exemplary Achievement / Trend Setting / Out of the Way Contribution'];
					var val = parseInt(ui.value);
					$('#tsk_rating_txt').html("<span rel='tooltip' style='font-size:15px' title='"+title[val]+"'>"+sizing[val]+"<span style='font-size:11px'> = "+title[val]+"</span></span>");
					$('#ratingHdn').attr('value', val);
					// attach tooltip dynamic js
					$('[rel=tooltip]').tooltip({html:true});

			}
		});

		
		/* update the clock timer in the site */
		if($('.site_clock').length > 0){ 	
			update_clock();
			check_att_intime(1);
		}
		
		
		
		/* get spec. of course */
		$('.get_spec').change(function(){			
			id = $(this).val();
			spec_id = $(this).attr('val');
			$('.'+spec_id).empty();
			$('.'+spec_id).append('<option>Loading...</option>');
			$.ajax({
			  url: $('#webroot').val()+'hremployee/get_specialization/?id='+id	
			}).done(function( html ) {	
				$('.'+spec_id).empty();
				$('.'+spec_id).append(html);
			});	
		});
		
		/* hide in / out time popover */
		$('.main-container').click(function(){			
			if($('.relin').length > 0){
				$('.relin').popover('hide');
				$('.relin').popover('destroy');				
			}
			if($('.relout').length > 0){
				$('.relout').popover('hide');
				$('.relout').popover('destroy');				
			}	
		});
		
		/* function to select the menu in report 
		$('.sel_report').click(function (){			
			id = $(this).attr('id');			
			$(".subnav-menu li a").each(function() {
				if(id != $(this).attr('id')){
					$(this).removeClass('active');
				}else{
					$(this).addClass('active');	
				} 
			});				
			
		});*/
		
		
		
		
		/* reject the exp. amount */
		$('.exp_reject').click(function(){
			if($(this).is(':checked')){
				amt = parseInt($('#exp_amt').html(), 10) - parseInt($(this).attr('val'), 10);				
			}else{
				amt = parseInt($('#exp_amt').html(), 10) + parseInt($(this).attr('val'), 10);	
			}
			$('#exp_amt').html(amt);
		});
		
		/* function to select plan type */
		$('.plan_type_sel').change(function(){
			$('.tsk_time').val('');	
			if($('.plan_type_sel').val() == 'P'){
				$('.dpDiv').hide();
				$('.ppDiv').show();
				// for validation
				$('.input_dp').removeClass('required');
				$('.input_pp').addClass('required')
			}else{
				$('.dpDiv').show();
				$('.ppDiv').hide();
				// for validation
				$('.input_dp').addClass('required');
				$('.input_pp').removeClass('required');
			}
			load_task_date();
			
		});
		
		// for server side validation
		if($('.plan_type_sel').length > 0){
			if($('.plan_type_sel').val() == 'P'){
				$('.dpDiv').hide();
				$('.ppDiv').show();
				// for validation
				$('.input_dp').removeClass('required');
				$('.input_pp').addClass('required')
				
			}else{
				$('.dpDiv').show();
				$('.ppDiv').hide();
				// for validation
				$('.input_dp').addClass('required');
				$('.input_pp').removeClass('required');
				
			}
			load_task_date();
		}
		
		// when page loads, show the options to add task
		if($('#tskplan').val() == 1){
			if(GetURLParameter('type') == 'P'){
				$('.dpDiv').hide();
				$('.ppDiv').show();
				// for validation
				$('.input_dp').removeClass('required');
				$('.input_pp').addClass('required')
			}else{
				$('.dpDiv').show();
				$('.ppDiv').hide();
				// for validation
				$('.input_dp').addClass('required');
				$('.input_pp').removeClass('required');
			}
			load_task_date();
		}
		
		
		
		
		
		/* function to hide the out time confirm */
		$('.out_no').click(function(){ 
			$('.confirm_out').hide();		
			
		});
		
		/* function to refresh the page */
		$('#refreshPage').on('click', function(){  
			// hide the tool tip
			$('.tooltip').html('');
			auto_page_load(1);
		});
		
		if($('#refreshPage').length > 0){
			var browser=get_browser_info();
			if(browser.name != 'MSIE' && browser.version > 9){
				time = 900000; // 15 mins.			
				window.setTimeout(auto_page_load, 60000);
			}
		}
		
		/* function to hide the tool tip */
		$('.click_hide').on('click', function(){  		
			$('.tooltip').html('');
			
		});
		
		/* function to hide the tool tip */
		$('.mouse_down_hide').on('mousedown', function(){  		
			$('.tooltip').html('');
			
		});
		
		/* catch current tab */
		$('#recent-tab > li.dashList').click(function (){
			tab = $(this).find('.listlink').attr('id');			
			// update notification if count available
			if($(this).find('.radius5').is(':visible') == true){
				if(tab == 'chat' || tab == 'news' || tab == 'poll' || tab == 'gal'  || tab == 'form' || tab == 'latUpdate' || tab == 'roa'){				
					$(this).find('.radius5').fadeOut('slow');
					update_notification(tab);					
				}		
			}
			$('#loadTab').val(tab);		
			
		});
		
		
			
		
		/* function to confirm the out time confirm */
		$('.out_yes').click(function(){ 
			$('.confirm_out').fadeOut();		
			mark_time('out', 1);
		});
		
		/* to upload a file */
		$("#uploadFile").change(function() {
			
			$("#file_name").html(this.value);
			// start preloader
			$('.submitUpload').show();	
			$('.submitUploadCan').show();	
			$(".fileUpload").hide();	
           
        });
		
		/* to upload a share file */
		$("#uploadShareFile").change(function() {			
			$("#share_file_name").html(this.value);	
			$('#share_file_remove').show();
           
        });
		
		$("#uploadRoaFile").change(function() {			
			$("#roa_file_name").html(this.value);	
			$('#roa_file_remove').show();
           
        });
		
		/* cancel file upload */
		$('.submitUploadCan').click(function(){	
			cancel_upload();
			$(".fileUpload").show();			
			
		});
		
		/* to remove the file */
		$('.file_remove').click(function (){
			if(confirm('Are you sure you want to delete?')){
				return true;
			}else{
				return false;
			}
		});
		
		/* for task plan calendar */
		if($('#eventCalendarDefault').length > 0){ 
			if($('#tskplan').val() == '1'){
				title = 'Tasks';
			}else if($('#tskassign').val() == '1'){
				title = 'Tasks Assigned To Me';
			}else if($('#tmtskplan').val() == '1'){
				title = 'Team\'s Tasks';
			}else if($('#tmtskassign').val() == '1'){
				title = 'Tasks Assigned By Me';
			}else{
				title = ' ';
			}
			
			
			url_vars = 'type='+$('#type').val()+'&plan_status='+$('#plan_status').val()+'&company='+$('#company').val()+'&project='+$('#project').val()+'&month_year='+$('#srch_month').val()+'&emp_id='+$('#emp_id').val()+'&';
			
			$("#eventCalendarDefault").eventCalendar({				
				eventsjson: $('#root').val()+'show_data/?'+url_vars, // link to events json
				eventsScrollable: false,
				showDayAsWeeks: false,
				showDescription:true,
				jsonDateFormat: 'human',
				//txt_SpecificEvents_after: title,
				txt_NextEvents: get_task_title(),
				txt_GoToEventUrl: "View Details",
				txt_noEvents: "There are no tasks in this period",
				eventsLimit: 50,
				cacheJson: true
				//openEventInNewWindow: true,
			});
		}
		
		/* hide close bt. for change status */
		// for change task status
		if($('#changeSt').length > 0){ 
			$('#cboxClose').remove();
		}
		
		
		/* when bd proposal submitted */
		$('.bdpropSub').unbind().on('ifClicked', function(event){
			if($(this).val() == 1){
				$('.propDiv').show();
				$('.bizSubmit').hide();
				$('.bizFooterDiv').removeClass('footer_div');
				$('#proposal_done').attr('value', 1);
				
			}else{
				$('.propDiv').hide();
				$('.bizSubmit').show();
				$('.bizFooterDiv').addClass('footer_div');
				$('#proposal_done').attr('value', 0);
			}
		});
		
		/* when bd proposal submitted */
		$('.cbShare').unbind().on('ifClicked', function(event){
			$('#cb_share').val($(this).val());
		});
		
		/* when unread selected in search */
		$('.unRead').unbind().on('ifChanged', function(event){ 
			val = $(this).attr('checked') == 'checked' ? 1 : 0;
			$('#unread').val(val);
		});
		
		/* function to show the adv. search in bd business */
		$('.showAdvSrch').click(function(){
			$('.advSrch').toggle();	
			if($('#srchAdvance').val() == ''){
				$('#srchAdvance').val(1);
				$('.searchBtn').attr('value', 'Basic Search');				
			}else{
				$('#srchAdvance').val('');				
				$('.searchBtn').attr('value', 'Advanced Search');
			}
		});
		
		if($('#srchAdvance').length > 0){
			if($('#srchAdvance').val() == '1'){
				$('.advSrch').show();	
				$('.searchBtn').attr('value', 'Basic Search');
			}else{
				$('.advSrch').hide();
				$('.searchBtn').attr('value', 'Advanced Search');
			}
		}
		
		/* update read status  in bd module */
		$('.upRead').click(function(){
			if($(this).attr('rtype') != ''){
				id = $(this).attr('rid');
				$.ajax({
					url: $('#webroot').val()+'update_read/?id='+id
				}).done(function( html ){				
					$('.u'+id).hide();
					// update read status
					count = parseInt($('.bdCount').html(), 10) - 1;
					count = count ? count : '';
					$('.bdCount').html(count);
				});
			}
			
		});
		
		/* when work status submitted */
		$('.workStatus').unbind().on('ifClicked', function(event){
			$('#work_clicked').val(1);
			// toggle work complete div
			if($(this).val() == '1'){
				$('.workCompDiv').show();
			}else{
				$('.workCompDiv').hide();
			}
		});
		
		// toggle work complete
		if($('#work_started').length > 0){
			if($('#work_started').val() == '1'){
				$('.workCompDiv').show();
			}else{
				$('.workCompDiv').hide();
			}
		}
		
		/* function to edit the bd priority */	
		if($('.priorChange').length > 0){
			 $('.priorChange').editable({ 
				showbuttons: false,
				source: [
					{value: 1, text: 'High'},
					{value: 2, text: 'Medium'},
					{value: 3, text: 'Low'}
				],				
				display: function(value, sourceData) { 
					//render response into element
					if($.trim(value) != ''){
						//elem = $.grep(sourceData, function(o){return o.value == value;});
						// add css
						apply_biz_class(value, this);
						item = value == 1 ? 'High' : value == 2 ? 'Medium' : 'Low';
						$(this).html(item);					
					}
				}   
			}); 
		}
		
		/* function to edit the biz type */	
		if($('.bizTypeChange').length > 0){
			 $('.bizTypeChange').editable({ 
				showbuttons: false,
				source: [
					{value: 'N', text: 'New'},
					{value: 'E', text: 'Existing'},
					{value: 'O', text: 'Old'}
				],				
				display: function(value, sourceData) { 
					//render response into element
					if($.trim(value) != ''){
						//elem = $.grep(sourceData, function(o){return o.value == value;});
						// add css
						apply_biz_class(value, this);
						item = value == 'N' ? 'New' : value == 'E' ? 'Existing' : 'Old';
						$(this).html(item);
						
						
					}
				}   
			}); 
		}
		
		
		
		if($('#proposal_done').length > 0 && $('#proposal_done').val() != ''){  
			if($('#proposal_done').val() == 1){
				$('.propDiv').show();
				$('.bizSubmit').hide();
				$('.bizFooterDiv').removeClass('footer_div');
				
			}else{
				$('.propDiv').hide();
				$('.bizSubmit').show();
				$('.bizFooterDiv').addClass('footer_div');
			}
		}
		
		/* function to toggle the agreement no. */
		$('.agree_sign').unbind().on('ifClicked', function(event){
			if($(this).val() == 1){
				$('.agmttNo').show();
				$('.workStartDiv').show();
				$('#agreement_sign').attr('value', 1);
				
			}else{
				$('.agmttNo').hide();
				$('.workStartDiv').hide();
				$('#agreement_sign').attr('value', 0);
			}
			$('#work_status').val($(this).val());
		});
		
		if($('#agreement_sign').length > 0 && $('#agreement_sign').val() != ''){ 
			if($('#agreement_sign').val() == 1){
				$('.agmttNo').show();
				$('.workStartDiv').show();
			}else{
				$('.agmttNo').hide();	
				$('.workStartDiv').hide();				
			}
		}
		
		/* function to toggle the sow finalized */
		$('.sow_final').unbind().on('ifClicked', function(event){
			if($(this).val() == 1){
				$('.propSubDiv').show();				
				$('#sow_done').attr('value', 1);
				
			}else{
				$('.propSubDiv').hide();
				$('.propDiv').hide();
				$('.bizSubmit').show();
				$('.bizFooterDiv').addClass('footer_div');
				$('#sow_done').attr('value', 0);
			}
		});
		
		if($('#sow_done').length > 0 && $('#sow_done').val() != ''){ 
			if($('#sow_done').val() == 1){
				$('.propSubDiv').show();
			}else{
				$('.propDiv').hide();				
				$('.propSubDiv').hide();
				$('.bizFooterDiv').addClass('footer_div');
				$('#sow_done').attr('value', 0);				
			}
		}
		
		
		
		
		/* function to toggle the agreement signed */
		$('.prop_approve').unbind().on('ifClicked', function(event){
			if($(this).val() == 1){
				$('.agrsignDiv').show();
				$('#proposal_approve').attr('value', 1);
				
			}else{
				$('.agrsignDiv').hide();
				$('.agmttNo').hide();
				$('#proposal_approve').attr('value', 0);
			}
		});
		
		if($('#proposal_approve').length > 0 && $('#proposal_approve').val() != ''){ 
			if($('#proposal_approve').val() == 1){
				$('.agmttNo').show();
				$('.agrsignDiv').show();
			}else{
				$('.agrsignDiv').hide();	
				$('.agmttNo').hide();				
			}
		}
		
		/* open the task add form */
		$('.task_add_form').click(function(){ 
			if($('.addForm').is(":visible")){
				$('.addForm').hide();				
			}else{
				$('.addForm').show();
			}
		});
		
		if($('.addForm').length > 0){
			$('.addForm').hide();	
		}
		
		/* function to sort records in members */
		$('.sortBy').on('click', function() {	
			root = $('#webroot').val();
			$('#busy-indicator').show();
			 jQuery.ajax({
                url: root+'home/sort_by/?type='+$(this).attr('rel'),               
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
					$('#memDiv').html(response);
                   //console.log(response, textStatus);
                }
            });
		});
		
		/* function to load php value into form */
	if($('#sheepItDynamicForm').length > 0){
		for(i = 0; i <= 9; i++){
			if($('#Cname'+i).length > 0){
				$('#contact'+i).attr('value', $('#Cname'+i).val());
			}
			if($('#Ctitle'+i).length > 0){
				$('#biz_title'+i).attr('value', $('#Ctitle'+i).val());
			}
			if($('#Cemail'+i).length > 0){
				$('#email'+i).attr('value', $('#Cemail'+i).val());
			}
			if($('#Cmobile'+i).length > 0){
				$('#mobile'+i).attr('value', $('#Cmobile'+i).val());
			}
			if($('#Cdesig'+i).length > 0){
				$('#designation'+i).attr('value', $('#Cdesig'+i).val());
			}
			if($('#Cid'+i).length > 0){
				$('#contact_id'+i).attr('value', $('#Cid'+i).val());
			}
			if($('#Ccreated'+i).length > 0){
				$('#contact_created'+i).attr('value', $('#Ccreated'+i).val());
			}
		}
	}
		
			/* function to show attendance */
		$('.showBy').on('click', function() {	
			root = $('#webroot').val();
			$('#busy-indicator').show();
			 jQuery.ajax({
                url: root+'home/show_by/?month='+$(this).attr('rel'),               
                contentType: false,
                processData: false,
                data: function() {
                    //var data = new FormData();                 
                }(),
                error: function(_, textStatus, errorThrown) {
                    //alert("Error");
                    //console.log(textStatus, errorThrown);
                },
                success: function(response, textStatus) {
                   // alert("Success");
				    $('#busy-indicator').hide();					
					$('#attDiv').html(response);
                   //console.log(response, textStatus);
                }
            });
		});
		
		
		
		/* upload file */
		$('.submitUpload').click(function(){
			root = $('#webroot').val();
			url = root+'home/change_photo/';
			// if new user in employee
			if($('#new_user').length > 0){
				new_user = $('#new_user').val();
				if(new_user == 1){
					url = root+'hremployee/change_photo/'
				}
			}		
			
			// start preload
			cancel_upload();
			$(".processBtn").toggle();				
		 jQuery.ajax({
                url: url,
                type: "POST",
                contentType: false,
                processData: false,
                data: function() {  
					var data = new FormData();					
                   // data.append("file", jQuery("#uploadFile").val());
                    data.append("file", jQuery("#uploadFile").get(0).files[0]);
					data.append("new_user", jQuery("#new_user").val());
                    return data;
                    // Or simply return new FormData(jQuery("form")[0]);
                }(),
                error: function(_, textStatus, errorThrown) {
                    //alert("Error");
                    //console.log(textStatus, errorThrown);
                },
                success: function(response, textStatus) { 
                   // alert("Success");
                   // console.log(response, textStatus);
					
					// stop preloader
					$(".processBtn").toggle();
						
					$(".photo_waiting").hide();
					$(".fileUpload").toggle();
					
					// if error in upload
					if(response == 'file_type_error'){		
						$(".file_error").show();
						$(".file_error").text('Only jpg, gif and png files allowed');							
					}else if(response == 'file_size_error'){
						$(".file_error").show();
						$(".file_error").text('Photo size <= 1 MB allowed');	
					}else if(response == 'upload_error'){
						$(".file_error").show();
						$(".file_error").text('Oops! Problem in upload photo');	
					}else{
						$(".photo_waiting").show();
						// hide server side alert
						if($('.await_photo').length > 0){
							$('.await_photo').hide();
						}
						$(".file_error").hide(); 									
						
						// for employee add
						if($("#new_user").val() == '1'){
							$('#profilePic').attr('src', response);	
							$('#profilePic').show();	
							$('.regRmPic').toggle();
							$('.thumb').hide();
						}else{			
							$('.thumb').attr('width', '');
							$('.thumb').attr('height', '');
							$('.thumb').attr('src', response);
						}
					}
					
					
                }
            });
		});
		
		/* when reg. confirm btn is clicked */
		$('.regconfirmBtn').click(function (){
			$('#reg_confirm').val(1);	
		});
		
		
		
		/* function to show the theme 
		$('.show_theme').click(function(){
			if($('.event_theme').is(":visible")){
				$('.event_theme').fadeOut();
			}else{
				$('.event_theme').fadeIn();
			}
			
		});*/
		
		if($('#event_theme').length > 0){
			if(GetURLParameter('theme') != '' && GetURLParameter('theme') != undefined){ 
				//$.cookie('pdca_event_cal', get_theme(GetURLParameter('theme')), { expires: 365, path: '/' });				
				$('.event_theme').fadeIn();
			}
		}
		
		/* date time picker */
		if($('.datetimepicker').length > 0){
			$('.datetimepicker').datetimepicker().datetimepicker({step:15,format:'d/m/Y H:i',minDate: $('#start_time').val(),
			minTime:'08:00',maxTime:'21:15',closeOnTimeSelect: true,
			allowTimes:[
				  '08:00', '08:15', '08:30','08:45','09:00','09:15','09:30','09:45','10:00','10:15','10:30','10:45','11:00','11:15', 
				  '11:30', '11:45', '12:00', '12:15', '12:30','12:45','13:00','13:15','13:30','13:45','14:00','14:15','14:30',
				  '14:45','15:00','15:15','15:30','15:45','16:00','16:15','16:30','16:45','17:00','17:15','17:30','17:45',
				  '18:00','18:15','18:30','18:45','19:00','19:15','19:30','19:45','20:00'
				 ]});
		}
		
		/* when gender is selected in employee reg. */
		$('.regGender').click(function (){
			gen = $(this).val();
			$('.dthumb').hide();	
			if(gen == 'M'){
				$('.mthumb').show();
				$('.fthumb').hide();				
			}else{
				$('.fthumb').show();
				$('.mthumb').hide();				
			}
		});
		
		/* cancel the registration emp */
		$('.regCancel').click(function (){
			if(confirm('Are you sure you want to cancel?')){
				return true;
			}else{
				return false;
			}
		});
		
		/* skip the registration emp */
		$('.skipReg').click(function (){
			if(confirm('Are you sure you want to skip the '+$(this).attr('rel')+'?')){
				return true;
			}else{
				return false;
			}
		});
		
		/* check for employee type */
		$('.empType').change(function(){
			if($(this).val() == 'A' || $(this).val() == 'A2'){
				$('#associateDiv').show();
			}else{
				$('#associateDiv').hide();
			}
		});
		
		if($('.empType').length > 0){
			if($('.empType').val() == 'A' || $('.empType').val() == 'A2'){
				$('#associateDiv').show();
			}else{
				$('#associateDiv').hide();
			}
		}
		
		/* check if half day leave */
		$('.is_half').click(function(){
			calculate_half();
		});
		
		/* confirmation for remove reg. image */
		$('.regRmPic').click(function(){
			if(confirm('Are you sure you want to remove?')){
				$('#rem_photo').val(1);
				$('.othumb').hide();
				$('.regRmPic').hide();
				$('#profilePic').hide();	
			}
		});
		
		// enable half day leave
		if($('#nodays').length > 0 && $('#nodays').val() > 0){ 
			//$('.halfL').show();			
		}
		
		// enable half day leave
		if($('#nodays').length > 0 && $('.comp_off').val() == 7){ 
			$('.compoff_row').show();			
		}
		
		// enable half day leave
		if($('.comp_off').length > 0 && $('.comp_off').val() == 7){ 
			$('.compoff_row').show();			
		}else{
			$('.compoff_row').hide();	
		}
		
		/* enable comp off row */
		$('.comp_off').on('click', function(){
			if($(this).val() == 7){ 
				$('.compoff_row').show();			
			}else{
				$('.compoff_row').hide();
				$('#compoff_box').val(null);
			}
		});
		
	
		
		/*function to show the message publish status */
		$('.pubStatus').change(function(){  
			if($('.pubStatus:checked').val() == 'N'){
				$('.betweenDate').show();
				$('.monthDays').hide();
			}else{
				$('.monthDays').show();
				$('.betweenDate').hide();
			}
		});
		
		if($('.pubStatus').length > 0){ 
			if($('.pubStatus:checked').val() == 'N'){
				$('.betweenDate').show();
				$('.monthDays').hide();
			}else if($('.pubStatus:checked').val() == 'M'){
				$('.monthDays').show();
				$('.betweenDate').hide();
			}
		}
		
		/* function to update max drop down */
		$('.minDrop').unbind().change(function(){
			cur_obj = $(this).attr('id');		
			option_id = $(this).attr('rel');
			val = parseFloat($(this).val());
			$('#'+option_id).append('<option>Loading...</option>');
			html = "<option value=''>Select</option>";
			$('#'+cur_obj+' option').each(function(){
				// allow only values equals or greater than
				if(val <= $(this).val()){
					html += '<option value='+$(this).val()+'>'+$(this).text()+'</option>';
				}
			});
			$('#'+option_id).empty();
			$('#'+option_id).append(html);

		});
		
		// scroll page when page ends 
		if($('#share_results').length > 0){	
			
			var total_groups;
			
			if($('#webroot').length > 0){ 
				root = $('#webroot').val();
			}
			var track_load = 0; //total loaded record group(s)
			var loading  = false; //to prevents multipal ajax loads
			
			$('#share_loading').show();
			
			$.ajax({
			  url: root+'home/load_total_share/'
			}).done(function( html ) { 
				total = html.split('|||'); 
				$('#total_group').val(total[0]);
				//total_groups = total[0];
				load_share_data(track_load);
				track_load++;
			});	
		
			 //detect page scroll				
			$('#shareScroll').unbind().scroll(function() {	
		
				//if($('#shareScroll').scrollTop() + $('#shareScroll').height() == $('document').height())  //user scrolled to bottom of the page?
				//{	
			   if($(this).scrollTop() >= ($(this)[0].scrollHeight - $(this).outerHeight())){
				
				total_groups = $('#total_group').val();
				
				// reset track load if refresh clicked
				if($('#ref_share').val() == 1){
					track_load = 1;
				}
					
					if(track_load < total_groups && loading == false) //there's more data to load
					{					
					
						loading = true; //prevent further ajax loading
						$('#busy-indicator').show(); //show loading image
						
						//load data from the server using a HTTP POST request
						$.post(root+'home/load_share/',{'group_no': track_load}, function(data){ 
											
							$("#share_results").append(data); //append received data into the element

							//hide loading image
							$('#busy-indicator').hide(); //hide loading image once data is received
							
							track_load++; //loaded group increment
							loading = false;
							
							
							$('#ref_share').val(0);
							
						
						}).fail(function(xhr, ajaxOptions, thrownError) { //any errors?
							
							//alert(thrownError); //alert with HTTP error
							$('#busy-indicator').hide(); //hide loading image
							loading = false;
						
						});
						
					}
				}
			});
		
	}
	
	// scroll page when page ends 
		if($('#roa_share_results').length > 0){	
			
			var total_groups;
			
			if($('#webroot').length > 0){ 
				root = $('#webroot').val();
			}
			var roa_track_load = 0; //total loaded record group(s)
			var roa_loading  = false; //to prevents multipal ajax loads
			
			$('#roa_share_loading').show();
			
			$.ajax({
			  url: root+'home/load_total_share_roa/'
			}).done(function( html ) { 
				total = html.split('|||'); 
				$('#roa_total_group').val(total[0]);
				//total_groups = total[0];
				load_roa_share_data(roa_track_load);
				roa_track_load++;
			});	
		
			 //detect page scroll				
			$('#roa_shareScroll').unbind().scroll(function() {	
			
			   if($(this).scrollTop() >= ($(this)[0].scrollHeight - $(this).outerHeight())){
				
				total_groups = $('#roa_total_group').val();
				
				// reset track load if refresh clicked
				if($('#ref_roa').val() == 1){ 
					roa_track_load = 1;
				}
					
					if(roa_track_load < total_groups && roa_loading == false) //there's more data to load
					{					
					
						roa_loading = true; //prevent further ajax loading
						$('#busy-indicator').show(); //show loading image
						
						//load data from the server using a HTTP POST request
						$.post(root+'home/load_share/',{'group_no': roa_track_load,'type': 'roa'}, function(data){ 
											
							$("#roa_share_results").append(data); //append received data into the element

							//hide loading image
							$('#busy-indicator').hide(); //hide loading image once data is received
							
							roa_track_load++; //loaded group increment
							roa_loading = false;
							
							$('#ref_roa').val(0);
							
						
						}).fail(function(xhr, ajaxOptions, thrownError) { //any errors?
							
							//alert(thrownError); //alert with HTTP error
							$('#busy-indicator').hide(); //hide loading image
							roa_loading = false;
						
						});
						
					}
				}
			});
		
	}
	
	  
});
	/* function to update the notifications */
	function update_notification(tab){		
		root = $('#webroot').val();
		$('#busy-indicator').show();
		$.ajax({
			 url: root+'home/update_notify/?tab='+tab
		}).done(function(html){		
			$('#busy-indicator').hide();
		});
	}
	
	
		/* function to update group count */
	function update_total_group(type){	
		group_id = type == 'roa' ? '#roa_total_group' : '#total_group';
		url = type == 'roa' ? 'load_total_share_roa' : 'load_total_share';
		$.ajax({
			 url: root+'home/'+url+'/'+type
		}).done(function( html ) {
			total = html.split('|||'); 
			$(group_id).val(total[0]);
		});	
	}
				
	/*
	function load_share_data(track_load, mod){
		
		if(mod == 'roa'){
			result_id = 'roa_share_results';
			load_id = 'roa_share_loading';
			scroll_id = 'roa_shareScroll';
		}else{
			result_id = 'share_results';
			load_id = 'share_loading';
			scroll_id = 'shareScroll';
		}
		$('#'+result_id).load(root+'home/load_share/', {'page':track_load, 'type' : mod}, function(response) {	
		track_load++;
		$('#'+load_id).hide();
		$('#'+scroll_id).scrollTo(0);
		}); //load first group
		
	}
	*/
	
	function load_share_data(track_load){	
		result_id = 'share_results';
		load_id = 'share_loading';
		scroll_id = 'shareScroll';
		
		$('#'+result_id).load(root+'home/load_share/', {'page':track_load}, function(response) {	
		track_load++;
		$('#'+load_id).hide();
		$('#'+scroll_id).scrollTo(0);
		}); //load first group
		
	}
	
	
	function load_roa_share_data(roa_track_load){
		
		$('#roa_share_results').load(root+'home/load_share/', {'page':roa_track_load,'type': 'roa'}, function(response) {	
		roa_track_load++;
		$('#roa_share_loading').hide();
		$('#roa_shareScroll').scrollTo(0);
		}); //load first group
		
	}
	
	

	/* function to calculate half day */
	function calculate_half(){ 
		// check dates are selected
			if($('#no_days').text() != '#'){
				// check half day selected
				if($('.is_half').is(':checked')){				
					tot_days = parseFloat($('#no_days').text()) - 0.5;				
				}else{
					tot_days = parseFloat($('#no_days').text()) + 0.5;
					$('.session').val('');
				}
				$('#no_days').text(tot_days);
				$('#nodays').val(tot_days);
			}
	}

	

	/* function to cancel upload */
	function cancel_upload(){
		$('.submitUploadCan').hide();
		$('.submitUpload').hide();
		$(".file_error").hide();	
		$("#file_name").html('');
	}
	
	

	function mark_time(type, complete){
		
		if(type == 'out' && complete != 1){	
			if($('.confirm_out').is(":visible")){
				$('.confirm_out').fadeOut();
			}else{
				$('.confirm_out').fadeIn();
			}			
			return false;
		}
		
		
		//if(type == 'in'){			
			img_url = $('#webroot').val()+'img/loading.gif'; 					
			$('#'+type+'_time').html('<img src="'+img_url+'">');	
		//}
		
				var jqxhr = $.ajax({
					  type: "POST",
					   url: $('#update_time').val(),
					   data: { type: type }
					}).done(function( html ) {				
					var buttonsConfig = [{text: "Ok",	"class": "btn btn-sm btn-primary",  click:function(){
						$( this ).dialog( "close" );}}];
						// check the tasks for out time marking
						output = check_task_outtime($.trim(html));
						if(output != ''){							
							$( "#"+output).dialog({
								 modal: true,
								 buttons: buttonsConfig
							});
							if(output == 'no_attendance_dialog'){
								output_str = $.trim(html).split('||');
								$('.forgot_date').html(output_str[1]);
							}							
							$('#'+type+'_time').html('');
							return false;
						}
						// if success
						if(html != 'no_mark' && html != '' && html != 'marked'){
							$('.'+type+'_time').hide();
							$('#'+type+'_time').text(html);
							// show popover
							$('[rel='+type+']').popover('show');							
							$('.rel'+type).attr('rel', '');	
							$('.rel'+type).addClass('cursor');
							// update the attendance buttons
							check_att_intime_marked(type);
						}else if(html == 'no_mark'){
							$('#out_time').html('');
							$( "#no_marked_dialog" ).dialog({
							  modal: true,
							  buttons: buttonsConfig
							});
							
						}else if(html == 'marked'){
							$( "#marked_dialog" ).dialog({
							  modal: true,
							  buttons: buttonsConfig
							});
						}
					});
					
		
	}

	/* function to create cookie */
	
	/* function to get the color */
	function get_color(val){		
		switch(val){
			case '#438EB9':
			color = 'blue';
			break;
			case '#C6487E':
			color = 'pink';
			break;
			case '#222A2D':
			color = 'black';
			break;
			case '#D0D0D0':
			color = 'grey';
			break;
			case '#7e6eb0':
			color = 'violet';
			break;
			case '#82af6f':
			color = 'green';
			break;
			case '#ffc657':
			color = 'yellow';
			break;
			case '#e2755f':
			color = 'red';
			break;
			case '#AF914B':
			color = 'brown';
			break;
			case '#BE5FC4':
			color = 'violets';
			break;
			case '#FF99CD':
			color = 'rose';
			break;
			case '#D8E575':
			color = 'lightgreen';
			break;
			
		}
		remove_css(color);
		return color;
	}
	
	/* function to get color code */
	function get_color_code(color){
		switch(color){
			case 'blue':
			code = '#438EB9';
			break;
			case 'pink':
			code = '#C6487E';
			break;
			case 'black':
			code = '#222A2D';
			break;
			case 'grey':
			code = '#D0D0D0';
			break;
			case 'violet':
			code = '#7e6eb0';
			break;
			case 'green':
			code = '#82af6f';
			break;
			case 'yellow':
			code = '#ffc657';
			break;
			case 'red':
			code = '#e2755f';
			break;
			case 'brown':
			code = '#AF914B';
			break;
			case 'violets':
			code = '#BE5FC4';
			break;
			case 'rose':
			code = '#FF99CD';
			break;
			case 'lightgreen':
			code = '#D8E575';
			break;
			default:
			code = '';
			break;
			
			
			
		}
		return code;
		
	}
	
	/* function to remove the css */
	function remove_css(val){
		var colors = new Array('blue', 'pink', 'black', 'grey','red','yellow','green','violet');
		count = colors.length;
		for(i = 0; i < count; i++){
			if(val != colors[i]){
				// remove the css						
				$("#"+colors[i]).remove(); 	
			}
		}
	}
	
	/* function to remove the css */
	function remove_pattern_css(val){
		var colors = new Array('bees', 'peace','sheep','none','peace','pentagon','leaves','gold','geometry','bird','matrix','redbg','bluebg','greenbg','violetbg','yellowbg','fabric',
		'grey_stripe','double_stripe','rose_stripe','yellow_stripe','green_stripe','blue_stripe','checked','purple_checked','pink_checked','red_checked','green_checked');
		count = colors.length;
		for(i = 0; i < count; i++){
			if(val != colors[i]){
				// remove the css						
				$("#"+colors[i]).remove(); 	
			}
		}
	}
	
	/* function to add color theme */
	function add_color_theme(color){
		href = $('#css_root').val()+'css/themes/'+color+'.css';
		var cssLink = $("<link rel='stylesheet' type='text/css' id='"+color+"' href='"+href+"'>");			
		$("head").append(cssLink);		
		// set the cookie 			
		$.cookie('my_login_cookie', color, { expires: 365, path: '/' });
		code = get_color_code(color);	
		$.cookie('my_login_cookie_code', code, { expires: 365, path: '/' });
	}
	
	/* function to add matching top */
	function add_theme_top(new_color){
		//remove the added css
		remove_css(new_color);
		// add matching css
		add_color_theme(new_color);
		
	}

	/* function to validate only numeric */
	function validate_numeric(val){
		if(!$.isNumeric(val) ||  val < 0){			
			return false;
		}
	}

	/* function to validate exp. form */
	function validate_exp_form(){
		var valid = true;
		count = $('#form_count').val();
		id = $('#FinExpApproveHdnId').val();
		val = id.split(',');
		for(i = 0; i <= count; i++){
			if($('#chk_'+val[i]).length > 0){				
				// if the check box is checked
				if($('#chk_'+val[i]).is(':checked')){
					// if reason not entered
					if($('#reason_'+val[i]).val() == ''){
						// show the validation msg.					
						$('#reason_'+val[i]).addClass('missing');
						valid = false;
					}else{
						$('#reason_'+val[i]).removeClass('missing');	
					}
				}
			}
			
		}
		
		if(valid == false){
			return valid;
		}
	}

	/* function to calculate the amount for expense */
	function cal_total(){
		if($('#page').val() == 'edit'){
			i = 0; 
			n = $('#rec_count').val();
		}else{
			i = 1;
			n = 4;
		}					
		j = 0;
		val = 0;
					
		while(i <= n){ 
			// replace special chars.
			if($('#amt_o'+i).length > 0){
				new_val = $('#amt_o'+i).val().replace(/[^0-9]+/g, "");
				$('#amt_o'+i).val(new_val);
			}
			
			if(parseInt($('#amt_o'+i).val(), 10) > 0){
				var txt_value = parseInt($('#amt_o'+i).val(), 10);		
				val = val + txt_value;
			}			
			i++;
		}
		if($('#form_count').val() > 0){
			if($('#amt_'+j).length > 0){
				// replace special chars.
				new_val = $('#amt_'+j).val().replace(/[^0-9]+/g, "");
				$('#amt_'+j).val(new_val);
			}
			// multiple option
			while(j <= $('#form_count').val()){
				if(parseInt($('#amt_'+j).val(), 10) > 0){
					var txt_value = parseInt($('#amt_'+j).val(), 10);		
					val = val + txt_value;
				}
				j++;
			}
		}
		$('#totAmt').val(val);
	}
	
		
	

	/* function to save the todo */
	function save_todo(msg, id){		
		//$('#busy-indicator').show();
		$.ajax({
		  url: $('#save_todo_url').val()+'?msg='+msg+'&id='+id	
		}).done(function( html ) {
			if(html == 'saved'){
				// show the item
				$('#edit-'+id).parent().parent().find('.itemChk').show();
				$('#edit-'+id).parent().parent().find('.itemLbl').show();
				$('#edit-'+id).parent().parent().find('.itemLbl').html('&nbsp; '+msg);
				// hide the form
				$('#edit-'+id).parent().parent().find('.edit_form').hide();
				
			}
		});	
	}
	
	
	function update_todo(st,id){
		//$('#busy-indicator').show();
		$.ajax({
		  url: $('#update_todo_url').val()+'?sts='+st+'&id='+id	
		}).done(function( html ) {
			//alert(html);
		});
	}
	
	/* function to update the reply share */
	function update_reply_share(value, id,userid,type){  
		$('#busy-indicator').show();		
		$.ajax({
			 url: $('#share_reply_url').val()+'?tsk='+$.trim(value)+'&id='+id+'&userid='+userid+'&type='+type			  
			}).done(function( html ) { 
				$('#busy-indicator').hide(); 
				$('.replydelDiv_'+id).html('');
				$('#replyDiv_'+id).html(html);					
			});		  
				  
	}
	
	function delete_todo(id){
		//$('#busy-indicator').show();
		$.ajax({
		  url: $('#delete_todo_url').val()+'?id='+id	
		}).done(function( html ) {
			//alert(html);
		});
	}
	
	function flag_todo(st,id){
		//$('#busy-indicator').show();
		$.ajax({
		  url: $('#flag_todo_url').val()+'?sts='+st+'&id='+id	
		}).done(function( html ) {
			//alert(html);
		});
	}
	
	/* function to update the session */
	function update_session(){
		//$('#busy-indicator').show();
		$.ajax({
		  url: $('#update_ses_url').val()
		}).done(function( html ) {
			//alert(html);
		});
	}
	
	


	/* function to load the page */
	function load_page(valid,dataElem,url){ 
		hdn_id = '';
		if(url == 'share_url'){
			if($('#hdnId').val() != ''){
				hdn_id = '&id='+$('#hdnId').val();
			}
			// reset share
			$('#interact_url').attr('href', $('#webroot_share').val());
		}
		
		 // replace new line with br tag
		new_value = $('.'+valid).val().replace(/\n/g, "<br>");
		
		if(valid == 'roaTxtBx'){
			file_id = 'uploadRoaFile';
			file_name = 'roa_file_name';
			file_remove = 'roa_file_remove';
			mod_type = 'roa';
			scroll_div = 'roa_shareScroll'
		}else{
			file_id = 'uploadShareFile';
			file_name = 'share_file_name';
			file_remove = 'share_file_remove';
			mod_type = '';
			scroll_div = 'shareScroll'
		}
		
		$('#busy-indicator').show();		
		 jQuery.ajax({
                url: $('#'+url).val()+'?tsk='+encodeURIComponent(new_value)+hdn_id,
                type: "POST",
                contentType: false,
                processData: false,
                data: function() {
                    var data = new FormData();                   
                    data.append("file", jQuery("#"+file_id).get(0).files[0]);
					data.append("txtField", valid);
                    return data;
                    // Or simply return new FormData(jQuery("form")[0]);
                }(),
                error: function(_, textStatus, errorThrown) {
                    //alert("Error");
                    //console.log(textStatus, errorThrown);
                },
                success: function(response, textStatus) { 
					$('#busy-indicator').hide();
					// hide file upload img
					$('#'+file_name).html('');				
					$('#'+file_id).val('');
					// hide remove
					$('#'+file_remove).hide();					
					reset_btn(dataElem);
					// scroll to top for new post only
					if(hdn_id == ''){					
						$('#'+scroll_div).scrollTo(0);
					}

					// if error in upload
					if(response == 'file_type_error'){		
						$(".file_share_error").show();
						$(".file_share_error").text('Only jpg,png,gif,doc,docx,pdf,xls,xlsx,zip,txt files allowed');					
					}else if(response == 'file_size_error'){
						$(".file_share_error").show();
						$(".file_share_error").text('File size <= 1 MB allowed');	
					}else if(response == 'upload_error'){
						$(".file_share_error").show();
						$(".file_share_error").text('Oops! Problem in upload file');	
					}else{					
						$('.'+dataElem).hide();
						$('.'+dataElem).html("");
						$('.'+dataElem).show(); 
						$('.'+dataElem).html(response);
						$('#'+valid).val('');
					}
					
					// function to update share group total
					
					update_total_group(mod_type);
					
					$('.postShare').val('');
					
                }
            });
		
		/*
		$.ajax({
		  url: $('#'+url).val()+'?tsk='+$('.'+valid).val()+hdn_id,
		  //data: $(":text, :hidden", $('#formID')).serializeArray(),
		  //cache: false,
		  // processData: true
		}).done(function( html ) {
			$('#busy-indicator').hide();
			reset_btn(dataElem);					
			$('.'+dataElem).hide();
			$('.'+dataElem).html("");
			$('.'+dataElem).show(); 
			$('.'+dataElem).html(html);
			$('#'+valid).val('');
		});*/
			
	}
	
	/* remove the file */
	$('#share_file_remove').click(function (){
		$(this).hide();
		$("#share_file_name").html('');	
	});
	
	$('#roa_file_remove').click(function (){
		$(this).hide();
		$("#roa_file_name").html('');	
	});
			
		
		/*
		$.ajax({
		  url: $('#'+url).val()+'?tsk='+$('.'+valid).val()+hdn_id,
		  data: function() {
              var data = new FormData();             
              data.append("file", jQuery("#uploadShareFile").get(0).files[0]);
              return data;
              // Or simply return new FormData(jQuery("form")[0]);
            }(),
                error: function(_, textStatus, errorThrown) {
                    //alert("Error");
                    //console.log(textStatus, errorThrown);
                },
                success: function(response, textStatus) {
					$('#busy-indicator').hide();
					reset_btn(dataElem);					
					$('.'+dataElem).hide();
					$('.'+dataElem).html("");
					$('.'+dataElem).show(); 
					$('.'+dataElem).html(html);
					$('#'+valid).val('');
				}
			});
		*/
		
	
	
	/* function to reset the form button */	
	function reset_btn(dataElem){
		if(dataElem == 'shareData' || dataElem == 'roa_shareData'){
			$('.btnID').html('<i class="icon-share-alt"></i> Send (<span class="no_users">All</span> Users)');
		}else{
			$('.btnID').html('<i class="icon-share-alt"></i> Save');
		}
		
		$('.btnID').removeAttr('disabled', 'disabled');
	}
	
	/* function to validate task form */
	function validate_tsk(id){
		if($.trim($('.'+id).val()) !=''){
			return true;
		}else{
			return false;
		}
	}
	
	
	/*
	 * validateForm(object)
	 * 
	 * This function takes in a form object and loops
	 * over the elements checking for required fields.
	 *
	 * @return - (bool) Whether or not the form should be submitted
	 */
	 function validateForm (form, action) { 
	 
		var submit = true;
		var msg = '<ul class="errList">';
		
		// Show user message that form is validating
		$('#msg').show().html('<p class="validate">Validating Form</p>');
		
		// Loop over form input and select elements		
		$(".form-vertical input[type=text], select, input[type=checkbox]").each(function(index,elem){			
		
			// If element has the class required check for a value
			//$(this).val() == '' && 
			if($(this).val() == '' &&  $(this).hasClass('required') ) {	
				// skip validation for draft
				if(action == 'draft' && index > 1){
					$(this).removeClass('missing');
					return;
				}
			
				// No Value so add to error message
				msg = msg + '<li>You must select a value for ' + $(this).attr('id') + '</li>';
				
				$(this).addClass('missing');	
				
				/*
				
				val = $(this).attr('id').split('_');
				
				if($(this).attr('type') == 'text' && val[0] != 'billref'){
					$(this).addClass('missing');
				}else if($(this).attr('type') == 'select'){
					$(this).addClass('missing');
				}else if($(this).attr('type') == 'checkbox'){					
					
					if($(this).attr('checked') == 'checked'){						
						$('#billref_'+val[1]).addClass('missing');
					}else{
						$('#billref_'+val[1]).removeClass('missing'); 
					}
				}
				
				*/
			
								
				submit = false;
				
			} else { 
					
				// Remove class incase it had been set on previous try
				$(this).removeClass('missing'); 
					
			}
	
		}); 
		
		// Errors
		if (submit == false) {
	
			$('#msg').html(msg + '</ul>');
			
		}

		return submit;
	
	}
	
	/* validate task plan form */
	function validateBdForm (form, id) { 	 
		var submit = true;
		// Loop over form input and select elements		
		$("#expForm input[type=text], select, input[type=checkbox], textarea").each(function(index,elem){			
			// If element has the class required check for a value		
			if($(this).val() == '' &&  $(this).hasClass('required') ) {
				if(id == 'submit'){
					$(this).addClass('missing');
				}				
				submit = false;				
			} else { 					
				// Remove class incase it had been set on previous try
				$(this).removeClass('missing'); 					
			}	
		}); 

		return submit;	
	}
	
	/* validate task plan form */
	function validateTskForm (form) { 	 
		var submit = true;
		// Loop over form input and select elements		
		$("#expForm input[type=text], select, input[type=checkbox], textarea").each(function(index,elem){			
			// If element has the class required check for a value		
			if($(this).val() == '' &&  $(this).hasClass('required') ) {				
				$(this).addClass('missing');				
				submit = false;				
			} else { 					
				// Remove class incase it had been set on previous try
				$(this).removeClass('missing'); 					
			}	
		}); 

		return submit;
	
	}
	
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
							if(check_browser('reload')){
								update_data();
							}
						}
					}
			
				 }
			
			});
		}
	}
	
	
	
	/*
	$(document).bind('cbox_closed', function(){
		alert('hi ravi');
	});
	*/
	
	// close the color box	
	$('.close_colorBox').click(function(){ 
		parent.$.colorbox.close();			
	});
	
	/* find diff. b/w two times */	
	function timeDiff(h1, m1, h2, m2, er3a, er3b) { 
	h1 = parseFloat(cleanBad(h1),10);
	m1 = parseFloat(cleanBad(m1),10);
	h2 = parseFloat(cleanBad(h2),10);
	m2 = parseFloat(cleanBad(m2),10);
	var er3a = parseFloat(er3a);
	var er3b = parseFloat(er3b);
	if ((er3a==0) && (h1==12)) {h1=0}

	if ((er3a==0) && (er3b==1)) {
	t1= (60*h1) + m1;
	t2= ((h2+12) * 60) + m2;
	t3= t2-t1;
	t4= Math.floor(t3/60)
	t5= t3-(t4*60)
	}
	else if ((er3a==1) && (er3b==0)) {
	if (h2==12) {h2=0}
	if (h1==12) {h1=0}
	t1= (60*h1) + m1;
	t2= ((h2+12) * 60) + m2;
	t3= t2-t1;
	t4= Math.floor(t3/60)
	t5= t3-(t4*60)
	}
	else if ((er3a==0) && (er3b==0)) {
	t1= (h1*60) + m1;
	t2= (h2*60) + m2;
		if (t2>t1) {
		t3= t2-t1;
		t4= Math.floor(t3/60)
		t5= t3-(t4*60)
		}
		else {
		t2= ((h2+24)*60) + m2;
		t3= t2-t1;
		t4= Math.floor(t3/60)
		t5= t3-(t4*60)
		}
	}
	else if ((er3a==1) && (er3b==1)) {
		if (h1!=12) {h1=h1+12}
		if (h2!=12) {h2=h2+12}
		t1= (h1*60) + m1;
		t2= (h2*60) + m2;
		if (t2>t1) {
		t3= t2-t1;
		t4= Math.floor(t3/60)
		t5= t3-(t4*60)
		}
		else {
		t2= ((h2+24)*60) + m2;
		t3= t2-t1;
		t4= Math.floor(t3/60)
		t5= t3-(t4*60)
		}
		}
	
	// sub. 12 hr if it exceeds 12
	if(t4 >= 12){ t4 = parseInt(t4-12); }
	return t4+"|"+t5;
}

function cleanBad(string) {
    for (var i=0, output='', valid="eE-0123456789."; i<string.length; i++){
       if (valid.indexOf(string.charAt(i)) != -1){
          output += string.charAt(i)}
		}
	if (output=='') {output=0}
    return output;
}

function pad(n)	{	
	if(n < 10){
		return "0"+ n;
	}
	else{
		return n;
		}
}

/* reload the task to get updated */
	function reload_tasklist(){
		parent.$('#pageReload').attr('value',$('#pageReload').val());
		parent.$('#date').attr('value',$('#date').val());	
		parent.$('#project').attr('value',$('#project').val());	
		parent.$('#company').attr('value',$('#company').val());	
		parent.$('#type').attr('value',$('#type').val());	
	}

/* function to load page automatically */
function auto_page_load(full_page){
	 $(".refreshLoad").show(); 
		root = $('#webroot').val(); 
		if(full_page == 1){
			url =  root+'home/';
			$("#refresh_page").val(1)
		}else{
			url =  root+'home/auto_refresh/?reload=partial';		
			$("#auto_load").val(1);
		}	
		
		
		jQuery.ajax({
           url: url,
           type: "POST",
           contentType: false,
           processData: false,
           data: function() {
                var data = new FormData();
                data.append("refresh", jQuery("#refresh_page").val()); 
				data.append("autorefresh", jQuery("#auto_load").val()); 
				data.append("load_tab", jQuery("#loadTab").val());	
                return data;
               }(),
           error: function(_, textStatus, errorThrown) {
              //alert("Error");
              //console.log(textStatus, errorThrown);
			  $(".refreshLoad").hide();
			  window.setTimeout(auto_page_load, 60000);
           },
           success: function(response, textStatus) {			
				// load only for full page refresh
				if(full_page == 1){
					//response = response.split('|||');
					$('#ajaxLoadDiv').html(response);				
					// enable tab
					if(response[1] != ''){ 
						//responseId = $.trim(response[1]);
						
						// disable for profile tab (first one)
						//if(responseId != 'plan' && responseId != ''){ 
							//$('#'+responseId).parent().addClass('active');
							$('#plan').parent().addClass('active');						
							//$('#'+responseId+'-tab').addClass('active');
							$('#plan-tab').addClass('active');
						//}
					}					
								
				}else{	
					show_notify_counts(response);
					//$(loadId).html(response);
					window.setTimeout(auto_page_load, 60000);
				}
			    $(".refreshLoad").hide();
          }
       });
}

/* function to notify count */
function show_notify_counts(data){
	val = data.split(':');	
	var tot_val = 0;
		
	for(i = 0; i < 5; i++){
		count = val[i].split('-');
		if(	count[1] > 0){
			tot_val += parseInt(count[1]);
		}
		switch(count[0]){
			case 'HR':
			$('#hr_count').html(count[1]);
			break;
			case 'FIN':
			$('#fin_count').html(count[1]);
			break;
			case 'TSK':
			$('#tsk_count').html(count[1]);
			break;
			case 'TVL':
			$('#tour_count').html(count[1]);
			break;
			case 'BD':
			$('#bd_menu_count').html(count[1]);
			break;
		}		
	}	
	
	$('.tot_count').html(tot_val);
	if(tot_val > 0){
		$('title').html('Home ('+tot_val+') - My PDCA');
	}
}



/* function to hide alert */
function hide_alert(){ 
	$('.welcomeAlert').fadeOut();
	update_session();
}

/* function to upload share file */
function upload_share_file(){
		root = $('#webroot').val();					
		 jQuery.ajax({
                url: root+'home/attach_file_share/',
                type: "POST",
                contentType: false,
                processData: false,
                data: function() {
                    var data = new FormData();
                   // data.append("file", jQuery("#uploadFile").val());
                    data.append("file", jQuery("#uploadShareFile").get(0).files[0]);
                    return data;
                    // Or simply return new FormData(jQuery("form")[0]);
                }(),
                error: function(_, textStatus, errorThrown) {
                    //alert("Error");
                    //console.log(textStatus, errorThrown);
                },
                success: function(response, textStatus) {
                   // alert("Success");
                   // console.log(response, textStatus);
					
					// stop preloader
					$(".processBtn").toggle();
						
					$(".photo_waiting").hide();
					$(".fileUpload").toggle();
					
					// if error in upload
					if(response == 'file_type_error'){		
						$(".file_error").show();
						$(".file_error").text('Only jpg, gif and png files allowed');							
					}else if(response == 'file_size_error'){
						$(".file_error").show();
						$(".file_error").text('Photo size <= 1 MB allowed');	
					}else if(response == 'upload_error'){
						$(".file_error").show();
						$(".file_error").text('Oops! Problem in upload photo');	
					}else{
						$(".photo_waiting").show();
						$(".file_error").hide();
						// load preview
						//$('.thumb').attr('src', response);
					}
					
					
                }
            });
		
}

/* function to show the day of the week */
function get_week_day(no){	 
	var day;
	switch(no){
		case 0:
		day = 'Sunday';
		break;
		case 1:
		day = 'Monday';
		break;
		case 2:
		day = 'Tuesday';
		break;
		case 3:
		day = 'Wednesday';
		break;
		case 4:
		day = 'Thursday';
		break;
		case 5:
		day = 'Friday';
		break;
		case 6:
		day = 'Saturday';
		break;	
		
	}
	
	return day;
}

/* function to update the clock */
function update_clock(){
	/*$.ajax({
	  url: $('#site_root').val()+'home/update_clock/'	
	}).done(function( html ) {	
	});	
	*/
	
	var jqxhr = $.ajax({
			url: $('#site_root').val()+'home/update_clock/'	
		})
	.done(function(html) {
		$('.site_clock').html(html);
		window.setTimeout(update_clock, 60000);
	})
	.fail(function() {
		window.setTimeout(update_clock, 60000);
	})
	.always(function() {
			
	});
}

/* function to update the attendance intimer */
function check_att_intime(first){ 
	// check in time not created	
	if(($('.in_time').text().trim() == '?' || $('.out_time').text().trim() == '?') && $('#no_att').val() != '1'){
		var jqxhr = $.ajax({
				url: $('#site_root').val()+'home/check_att_intime/'	
			})
		.done(function(html) {
			// do not load in the first time
			if(first != '1'){
				$('#att_timer').html(html);
			}
			window.setTimeout(check_att_intime, 60000);
		})
		.fail(function() {
			window.setTimeout(check_att_intime, 60000);
		})
		.always(function() {
				
		});
	}
}

/* function to update the attendance intimer */
function check_att_intime_marked(type){ 
	// check in time not created	
	if($('#no_att').val() != '1' && type == 'in'){
		var jqxhr = $.ajax({
				url: $('#site_root').val()+'home/check_att_intime/'	
			})
		.done(function(html) {
			$('#att_timer').html(html);			
		})
		.fail(function() {
			//window.setTimeout(check_att_intime, 60000);
		})
		.always(function() {
				
		});
	}
}

/* function to get url vars */


function GetURLParameter(sParam){
	var sPageURL = window.location.search.substring(1);
    var sURLVariables = sPageURL.split('&');
    for (var i = 0; i < sURLVariables.length; i++){
        var sParameterName = sURLVariables[i].split('=');
        if(sParameterName[0] == sParam){
            return sParameterName[1];
        }
    }
}

function get_theme(theme){
	var theme_name = '';
	switch(theme){
		case 'default':
		theme_name = '';
		break;
		case 'sky_blue':
		theme_name = 'cupertino';
		break;
		case 'light_orange':
		theme_name = 'humanity';
		break;
		case 'grey':
		theme_name = 'smoothness';
		break;
		case 'blue':
		theme_name = 'ui-lightness';
		break;
		
	}
	return theme_name;
}



/* for post dated permission */
function post_dated_perm(value, type){ 
		if($('#page').val() == 'create_permission'){
			var submit = true;
			var cur_date = new Date();			
			per_date = value.split('/');
			// get selected date
			select_time = convertDateTo24Hour($('.fromTime').val());
			new_time = select_time.split(':');
			var date = new Date(per_date[2], per_date[1]-1, per_date[0]);
			// for time validation
			var date2 = new Date(per_date[2], per_date[1]-1, per_date[0], new_time[0], new_time[1], cur_date.getSeconds());
			
			var cur_month = cur_date.getMonth() + 1;
			// add leading zero
			cur_month = cur_month < 10 ? "0" + (cur_month) : cur_month;
			today_format = cur_date.getDate()+'/'+cur_month+'/'+cur_date.getFullYear();
			
				// apply style for the button
				var buttonsConfig = [
				{
					text: "Yes",
					"class": "btn btn-green",
					click: function() {
						$( this ).dialog( "close" );
						//$(".send_perm" ).trigger( "click" );
						if(type == 'time'){
							confirm_per_form();
						}
					}
				},
				{
					text: "No",
					"class": "btn",
					click: function() {
						$(this).html('Oops! Redirecting page..');
						location.href =  $('#taken_url').val();
						return false;
					}
				}
			];
			
			url = $('#taken_url').val();			
			
			if(type == 'date'){	 	
				// condition for post dated leaves			
				if(date < cur_date &&  value !=  today_format){								
					$("#per-dialog-confirm" ).dialog({
						resizable: false,
						height:180,
						modal: true,
						buttons: buttonsConfig						
					});						
				}else{					
					return submit;
				}
				
			}else if(type == 'time'){
				// condition for post dated when form submit	
				if(value ==  today_format && cur_date.getTime() > date2.getTime()){							
					$("#per-dialog-confirm" ).dialog({
						resizable: false,
						height:180,
						modal: true,
						buttons: buttonsConfig					
					});							
				}else{
					return submit;
				}
			}
			
		return false;
		
	}
}

/* for post dated permission */
function confirm_per_form(){
	// apply style for the button
				var buttonsConfig = [
				{
					text: "Yes",
					"class": "btn btn-green",
					click: function() {
						$(this).html('Processing.. Pls wait..');
						$('.ui-dialog-buttonset').hide();
						$('#formID').attr('action', url); 
						$('#formID').submit();
						submit = true;
					}
				},
				{
					text: "No",
					"class": "btn",
					click: function() {	
						$( this ).dialog( "close" );
						submit = false	
					}
				}
			];
				
				url = $('#post_data').val();
				submit = false;
				$( "#dialog-confirm" ).dialog({
				resizable: false,
				height:180,
				modal: true,
				buttons: buttonsConfig
				
			});
		
}

function convertDateTo24Hour(date){
    var elem = date.split(' ');
    var stSplit = elem[0].split(":");// alert(stSplit);
    var stHour = stSplit[0];
    var stMin = stSplit[1];
    var stAmPm = elem[1];
    var newhr = 0;
    var ampm = '';
    var newtime = '';
    //alert("hour:"+stHour+"\nmin:"+stMin+"\nampm:"+stAmPm); //see current values
    
    if (stAmPm=='PM')
    { 
        if (stHour!=12)
        {
            stHour=stHour*1+12;
        }
       
    }else if(stAmPm=='AM' && stHour=='12'){
       stHour = stHour -12;
    }else{
    	stHour=stHour;
    }

    return stHour+':'+stMin;
}



/*
function UpdateTableHeaders2() {
$(".persist-area2").each(function() {
   
       var el             = $(this),
           offset         = el.offset(),
           scrollTop      = $(window).scrollTop(),
           floatingHeader = $(".floatingHeader2", this)
       
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

   $(".persist-area2").each(function() {
       clonedHeaderRow = $(".persist-header2", this);
       clonedHeaderRow
         .before(clonedHeaderRow.clone())
         .css("width", clonedHeaderRow.width())
         .addClass("floatingHeader2");
         
   });
   
   $(window)
    .scroll(UpdateTableHeaders2)
    .trigger("scroll");
   
});
*/

// smooth scroll
/*
$(function() {
  $('a[href*=#]:not([href=#])').click(function() {
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
      if (target.length) {
        $('html,body').animate({
          scrollTop: target.offset().top
        }, 1000);
        return false;
      }
    }
  });
});*/
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
function load_task_date(){ 
	if($('.plan_type_sel').val() == 'P'){
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

function sheepit_load_task_date(){
	if($('.plan_type_sel').length > 0){
		if($('.plan_type_sel').val() == 'P'){
			// add date picker
			$('.tsk_time').addClass('datepick_tsk');
			call_datepicker();	
			// remove time picker
			$('.tsk_time').timepicker({ 'timeFormat': 'h:i A', 'step': 5,'forceRoundTime': true });
			$('.tsk_time').timepicker('remove');
			$('.tsk_time').removeClass('tsk_timepicker');								
		}else{
			// remove date picker
			$('.tsk_time').removeClass('datepick_tsk');
			$('.tsk_time').datepicker('remove');
			// add time picker
			$('.tsk_time').addClass('tsk_timepicker');
			timePicker();
			
		}
	
	}
}

function timePicker(){
	$('.tsk_timepicker').unbind().timepicker({ 'timeFormat': 'h:i A', 'step': 5,'forceRoundTime': true, 'scrollDefaultTime': '09:30 AM',
	'disableTimeRanges': [
        ['12am', '7am'],
		['9:05pm', '11:56pm']
		
    ]});
	
	// only for add task plan
	/*if($('#plan_date').length > 0){
		$('.tsk_timepicker').on('changeTime', function() {
			var cur_date = new Date();
			sel_date = $('#plan_date').val().split('/');	
			// get selected date
			sel_time = convertDateTo24Hour($(this).val());
			new_time = sel_time.split(':');
			//cur_month = cur_date.getMonth() + 1;
			var now = new Date(cur_date.getFullYear(), cur_date.getMonth(), cur_date.getDate(), cur_date.getHours(), cur_date.getMinutes(), cur_date.getSeconds());
			// for time validation
			var select_time = new Date(sel_date[2], sel_date[1]-1, sel_date[0],new_time[0], new_time[1], cur_date.getSeconds());
			//alert(now);
			//alert(select_time);
			// if selected time is lesser than current time
			if(select_time < now){	
				$(this).val('');
			}else if($('#plan_date').val() == ''){
				alert('Please select the task date');
				$(this).val('');
			}			
		});
		
		
	}*/
	
	if($('#plan_date').length > 0){
		$('.tsk_timepicker').on('changeTime', function() {
			// check plan start or plan end date
			if($(this).attr('rel') == 'plan_end'){
				var sel_field = 'end';
				start = $(this).closest('.span1').prev().find('.tsk_time_start').val();
				end = $(this).val();
			}else{
				end = $(this).closest('.span1').next().find('.tsk_time_end').val();
				start = $(this).val();
			}
			// validation for pm to am selection
			if(end != ''){
				start_val = start.split(' ');
				end_val = end.split(' ');
				if(start_val[1] == 'PM' && end_val[1] == 'AM'){
					$(this).val('');
				}else if((start_val[1] == 'PM' && end_val[1] == 'PM') || (start_val[1] == 'AM' && end_val[1] == 'AM')){
					start_val = start.split(/[ :]+/);
					end_val = end.split(/[ :]+/); 
					// when start hour is greater than end hour
					if(start_val[0] > end_val[0] && start_val[0] != '12'){
						$(this).val('');
					}else if(start_val[0] == end_val[0] && start_val[1] > end_val[1]){ // when start minutes are greater
						$(this).val('');
					}else if(start_val[0] == end_val[0] && start_val[1] == end_val[1]){ // when all are equal
						$(this).val('');
					}else if(start_val[0] == '01' && end_val[0] == '12'){ // when all are equal
						$(this).val('');
					}					
					
				}
			}
		});
	}
	
}

/* update task list */
function update_data(){	
		parent.$('#busy-indicator').show();
			jQuery.ajax({ // ?type='+$('#type').val()+'&date='+$('#date').val()+'&project='+$('#project').val()+'&company='+$('#company').val()
                url: $('#root').val()+'show_task/',             
                contentType: false,
                processData: false,
				type: "POST",
                data: function() {
                    var data = new FormData();
					data.append("date", jQuery("#month").val());
					data.append("task_month", jQuery("#task_month").val());
					data.append("type", jQuery("#type").val());
					data.append("status", jQuery("#plan_status").val());
					return data;
                }(),
                error: function(_, textStatus, errorThrown) {
                    //alert("Error");
                   // console.log(textStatus, errorThrown);
				   parent.$('#busy-indicator').hide();	
                },
                success: function(response, textStatus) { 
                   // alert("Success");
				   parent.$('#busy-indicator').hide();					
				   parent.$('.calTable').html('');
				   parent.$('.calTable').after(response);
					// remove the first div
				   parent.$('.calTable:eq(0)').remove();
				   // remove page reload
				   parent.$('#pageReload').val('');
				   // disable cache
				   parent.$('#pageCache').val('0');
				   // if postponed or partially done				  
				   if($('#tsk_moved_date').val() != ''){
						// issue when search so commented now
						//parent.$('#dayList_'+$('#tsk_moved_date').val()).addClass('dayWithFutureEvents');
				   }
                }
            });
}
/* function to check no. of days */
function check_no_days(from, to){
	if(from != '' && to != ''){
		$('#no_days').html('<span style="color:#22B512">updating...</span>');
		$('.send_lve').hide();
		$.ajax({
			 url: $('#check_leave_url').val()+'?from='+from+'&to='+to	
		}).done(function( html ) {	
			$('#no_days').text(html);
			$('#nodays').val(html);
			// show submit btn
			$('.send_lve').show();
		});
	}
	
}
/* function to get no. of days */
function get_leave_diff(from, to){
	if(from != '' && to != ''){
		var str2 = from;
		var str4 = to;
		var ONE_DAY = 1000 * 60 * 60 * 24;
		var dt2 = parseInt(str2.substring(0, 2), 10);
		var mon2 = parseInt(str2.substring(3, 5), 10);
		var yr2 = parseInt(str2.substring(6, 10), 10);
		var dt4 = parseInt(str4.substring(0, 2), 10);
		var mon4 = parseInt(str4.substring(3, 5), 10);
		var yr4 = parseInt(str4.substring(6, 10), 10);
		var date2 = new Date(yr2, mon2 - 1, dt2);
		var date4 = new Date(yr4, mon4 - 1, dt4);
		var date2_ms = date2.getTime();
		var date4_ms = date4.getTime();
		var difference_ms = Math.abs(date2_ms - date4_ms)
		var days = Math.round(difference_ms / ONE_DAY)
		days = ++days;
		return days;	
	}
}
/* function to sort the table 
function sortTable(col){ 
  var rows = $('#mytable tbody  tr').get();

  rows.sort(function(a, b) {

  var A = $.trim($(a).children('td').eq(col).text());
  var B = $.trim($(b).children('td').eq(col).text());

  date1 = A.split(' ');
  date2 = B.split(' ');
  
  //alert('01/01/2014 '+date1[0]+'00');
  
  if(Date.parse('01/01/2014 '+date1[0]+'00') < Date.parse('01/01/2014 '+date2[0]+'00')) {
    return -1;
  }

  if(Date.parse('01/01/2014 '+A) > Date.parse('01/01/2014 '+B)) {
    return 1;
  }

  return 0;

  });

  $.each(rows, function(index, row) {
    $('#mytable').children('tbody').append(row);
  });
}*/

/* for new features flash */
function new_flash(effect){
	var options = {};
	// clear time out
	if(effect){ clearTimeout(function() { new_flash()});}	
	effect = effect ? effect : 'fade';
	$("#new_f").effect(effect, options, 500);
	if(effect == 'bounce'){
		setTimeout(function() { new_flash('explode')}, 2000);
	}
	
}

/* function to hide the success / fail alert messages */
function hide_confirm_alert(){
	var options = {};
	$("#flashMessage").fadeOut();
}

/* function to get task title for event calendar */
function get_task_title(){
	if($('#cur_date').length > 0){
		tsk_date = $('#cur_date').val();
		if(tsk_date != '' && tsk_date != undefined){
			date = tsk_date.split('-'); 
			return date[1]+' '+date[0]+get_day_suffix(date[0]);			
		}else{ 
			if(GetURLParameter('month_year') != '' && GetURLParameter('month_year') != undefined){ return '';}else{	return 'Today\'s Task'; }
		}
	}else{
		return;
	}
}
/* function to return date suffix */
function get_day_suffix(d){
  if(d > 3 && d < 21) return 'th'; // thanks kennebec
  switch (d % 10) {
        case 1:  return "st";
        case 2:  return "nd";
        case 3:  return "rd";
        default: return "th";
    }
	return suffix;
}
/* function to validate plan type in assign task */
function validate_plan_type(){ 
	if($('.plan_type').val() == 'D'){
		var form_fields = new Array('plandate','starttime','endtime');
		var valid_msgs =  new Array('Please select the plan date','Please select the start and end time','Please select the start and end time');
	}else{
		var form_fields = new Array('startdate','enddate','vcompany','vproject');
		var valid_msgs =  new Array('Please select the start date','Please select the end date','Please select the customer','Please select the project');
	}
	var submit = true;
	
	j= 0;
	while(j < form_fields.length){
		// if empty show the error msg.
		if($('#'+form_fields[j]).val() == ''){					
			$('.'+form_fields[j]).html(valid_msgs[j]);
			submit = false;
		}else if($('#'+form_fields[j]).val() != ''){
			$('.'+form_fields[j]).html('');
		}
		j++;
	}		
	return submit;
}
/* ajax call to update todo order */
function update_todo_order(id){
	$('#busy-indicator').show();
	$.ajax({
		url: $('#todo_sort_url').val(),
		data: id,
		type: "POST"
	}).done(function( html ) {		
		$('#busy-indicator').hide();
	});
}

/*
function check_in_out(){	
	var nowTemp = new Date();
	var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
	 
	var checkin = $('.dpd1').datepicker({
	  format: 'dd/mm/yyyy',
	  'todayHighlight': false,
	  onRender: function(date) { 
		return date.valueOf() < now.valueOf() ? 'disabled' : '';
	  }
	}).on('changeDate', function(ev) {
	  if (ev.date.valueOf() > checkout.date.valueOf()) { 
		var newDate = new Date(ev.date)
		newDate.setDate(newDate.getDate() + 1);
		checkout.setValue(newDate);
	  }
	  checkin.hide();
	  $('.dpd2')[0].focus();
	}).data('datepicker');

	var checkout = $('.dpd2').datepicker({
	  format: 'dd/mm/yyyy',
	  'todayHighlight': false,
	  onRender: function(date) { 
		if($('#sameDatePos').val() == '1' && $('#sameDatePos').val() != undefined){
			return date.valueOf() < checkin.date.valueOf() ? 'disabled' : '';
		}else{
			return date.valueOf() <= checkin.date.valueOf() ? 'disabled' : '';
		}
	  }
	}).on('changeDate', function(ev) {
	  checkout.hide();
	}).data('datepicker');
}
*/
/* function to search the passenger */
function search_passenger(){
	if($('.emp_srch').length > 0){
		webroot = $("#webroot").val();			
		jQuery('.emp_srch').autocomplete(webroot+'search_employee/', {
			width: 227,
			selectFirst: true,
			onItemSelect:get_emp_details
		});
	}
}

/* function to get the emp. details */
function get_emp_details(li){	
	//$("input[value='"+li.selectValue+"']").remove();
	var i = 0;
	$("input[type='text']").each(function(){
        var $this = $(this); 	
        if ($this.val() == li.selectValue){				
			i++;
        }
		if(i == 1){
			$this.parent().parent().parent().addClass('cur_1 cur_r1');	
		}
    });	  
	// to avoid duplicate check for condition
	if(i == 1){
		$('#busy-indicator').show();
		$.ajax({
			url: $('#webroot').val()+'get_emp_data/?emp='+li.selectValue,
			data: li.selectValue
		}).done(function( response ) { 
			data = response.split('||');
			gender = data[0];
			age = data[1];
			phone = data[2];
			email = data[3];
			id_no = data[4];
			id_type = data[5];
			// fill the form values
			$('.cur_1').next('div').addClass('cur_2 cur_r2').eq(0).find('.age').val(age);
			$('.cur_2').next('div').addClass('cur_3 cur_r3').eq(0).find('.gender').val(gender);
			$('.cur_3').next('div').addClass('cur_4 cur_r4').eq(0).find('.mobile').val(phone);
			$('.cur_4').next('div').addClass('cur_5 cur_r5').eq(0).find('.email').val(email);
			$('.cur_5').next('div').addClass('cur_6 cur_r6').eq(0).find('.id_type').val(id_type);
			$('.cur_6').next('div').addClass('cur_7 cur_r7').eq(0).find('.id_no').val(id_no);
			// remove all the class once loaded
			remove_person_cls();			
			$('#busy-indicator').hide();
		});
	}else{
		remove_person_cls();
	}
}

/* function to remove passenger class */
function remove_person_cls(){
	$('.cur_r1').removeClass('cur_1');
	$('.cur_r2').removeClass('cur_2');
	$('.cur_r3').removeClass('cur_3');
	$('.cur_r4').removeClass('cur_4');
	$('.cur_r5').removeClass('cur_5');
	$('.cur_r6').removeClass('cur_6');
}
function scroll_org(){		
	$( "div.orgScroll" ).scrollLeft(250);
}

/* function to load profile tab in home */
function load_profile_tab(para,val){  
	// reset error div if exists
	if($('.loadErr').length > 0){
		$('.loadErr').remove();
	}
	$('#busy-indicator').show();
	// call ajax
	var jqxhr = $.ajax({			
		url: $('#webroot').val()+'home/'+para[0]+'/'+para[1]+'/'+val
	})
	.done(function(html) { 
		$('.ajaxCont-'+para[1]).html(html);
		// update the hidden
		$('#'+para[1]).val(1);	
		$('#busy-indicator').hide();
	})
	.fail(function() {
		$('#busy-indicator').append('<span class="error loadErr" id="">Oops! Something went wrong.. trying again in 10 sec... Pls wait..</span>');
		setTimeout(function() { load_profile_tab(para,val)}, 10000); //window.setTimeout(load_profile_tab, 10000);
	})
	.always(function() {
					
	});
}

/* function to check the task for out time */
function check_task_outtime(res){
	var res;
	res_no_att = res.split('||');
	if(res == 'no_plan'){							
		flag = 'no_plan_dialog';
	}else if(res == 'less_plan'){ // if less tasks planned						
		flag = 'less_plan_dialog';
	}else if(res == 'pending_plan'){ // if less tasks planned							
		flag = 'pending_plan_dialog';
	}else if(res_no_att[0] == 'no_attendance'){ // if not last att. marked						
		flag = 'no_attendance_dialog';
	}else{	
		flag = '';
	}
	return flag;
}

/* function to check the task for out time */
function check_last_attendance(res){
	res_no_att = res.split('||');
	if(res_no_att[0] == 'no_attendance'){							
		flag = 'no_attendance_dialog';
	}else if(res == 'no_plan'){							
		flag = 'no_plan_in_dialog';
	}else if(res == 'less_plan'){ // if less tasks planned						
		flag = 'less_plan_in_dialog';
	}else{	
		flag = '';
	}
	return flag;
}

/* function to call for the switch module counts */
function switch_mod_count(){
	$('.switchPre').html('');
	$('.switchLoad').html('<img src='+$('#site_root').val()+'img/white_dot_loader.gif>');
	$('.switchLoad-sub').html('<img src='+$('#site_root').val()+'img/grey_dot_loader.gif>');
			$.ajax({
			  url: $('#css_root').val()+'home/auto_refresh/?reload=partial'	
			}).done(function( html ) {	
				// stop preloader
				$('.switchLoad').html('');
				$('.switchLoad-sub').html('');
				var tot_val = 0;
				val = html.split(':');
				for(i = 0; i < 5; i++){
					count = val[i].split('-');
					if(	count[1] > 0){
						tot_val += parseInt(count[1]);
					}
					switch(count[0]){
						case 'HR':
						$('#hr_count').html(count[1]);
						break;
						case 'FIN':
						$('#fin_count').html(count[1]);
						break;
						case 'TSK':
						$('#tsk_count').html(count[1]);
						break;
						case 'TVL':
						$('#tour_count').html(count[1]);
						break;
						case 'BD': 
						$('#bd_menu_count').html(count[1]);
						break;
					}		
				}
				$('#total_count').html(tot_val);
			}).fail(function() {
				window.setTimeout(switch_mod_count, 60000);
			})	
			
		window.setTimeout(switch_mod_count, 60000);
}

function get_browser_info(){
    var ua=navigator.userAgent,tem,M=ua.match(/(opera|chrome|safari|firefox|msie|trident(?=\/))\/?\s*(\d+)/i) || []; 
    if(/trident/i.test(M[1])){
        tem=/\brv[ :]+(\d+)/g.exec(ua) || []; 
        return {name:'IE ',version:(tem[1]||'')};
        }   
    if(M[1]==='Chrome'){
        tem=ua.match(/\bOPR\/(\d+)/)
        if(tem!=null)   {return {name:'Opera', version:tem[1]};}
        }   
    M=M[2]? [M[1], M[2]]: [navigator.appName, navigator.appVersion, '-?'];
    if((tem=ua.match(/version\/(\d+)/i))!=null) {M.splice(1,1,tem[1]);}
    return {
      name: M[0],
      version: M[1]
    };
 }
function check_browser(type){
	browser = get_browser_info()
	if(browser.name == 'MSIE' && browser.version <= 9){
		if(type == 'alert'){
			alert('Sorry! This feature does not works for this browser version. Pls use IE (10 and above), Firefox or Chrome latest versions');
			return false;
		}else if(type == 'reload'){
			window.location.reload();
			return false;
		}
	}else{
		return true;
	}
	
}

/* function to validate new business */
function validate_new_business(id){
	var form_fields = new Array('SearchText','opportunity','location','priority','dofd','cb_shared','spoc_follow','vertical','sow_fin','propSubmit','address','source','spot','sow_detail');
	var valid_msgs =  new Array('Please enter the company name', 'Please select the business opportunity', 'Please select the location',
	'Please select the priority','Please select the DOFD','Please select CB Shared','Please select SPOC for follow up','Please select the business vertical',
	'Please select SOW finalized', 'Please select the proposal submitted', 'Please enter the address','Please select the source of business', 'Please select spot by',
	'Please enter the SOW details');				
	var submit = true;	var submit2 = true; var submit3 = true; var submit4 = true;
	var error_label;
	
	if(id != 'submit'){ 
		error_label = get_error_label(id, form_fields, valid_msgs); 
		//alert(error_label);
		var form_fields = new Array(id);		
		var valid_msgs = new Array(error_label);
	}	
	
	
	j= 0;
	while(j < form_fields.length){ 
		// if empty show the error msg.
		if(form_fields[j] == 'cb_shared'){					
			if($('#cb_share').val() == ''){
				$('.'+form_fields[j]).html(valid_msgs[j]);
				submit = false;
			}else{
				$('.'+form_fields[j]).html('');
			}
		}else if(form_fields[j] == 'sow_fin'){					
			if($('#sow_done').val() == ''){
				$('.'+form_fields[j]).html(valid_msgs[j]);
				submit = false;
			}else{
				$('.'+form_fields[j]).html('');
			}
		}else if(form_fields[j] == 'propSubmit'){					
			if($('#proposal_done').val() == '' && $('#sow_done').val() == '1'){
				$('.'+form_fields[j]).html(valid_msgs[j]);
				submit = false;
			}else{
				$('.'+form_fields[j]).html('');
			}
		}else if(form_fields[j] == 'sow_detail'){					
			if($('#sow_detail').val() == '' && $('#sow_done').val() == '1'){
				$('.'+form_fields[j]).html(valid_msgs[j]);
				submit = false;
			}else{
				$('.'+form_fields[j]).html('');
			}
		}else if($('#'+form_fields[j]).val() == '' || $('#'+form_fields[j]).val() ==  null){					
			$('.'+form_fields[j]).html(valid_msgs[j]);
			submit = false;
		}else if($('#'+form_fields[j]).val() != ''){
			$('.'+form_fields[j]).html('');
		}
		j++;
	}
	

	// validate proposal submitted
	var form_fields2 = new Array('project','uploadFile','proposal_ver','proposal_date','proposal_apr','agree_no','sign','work_status');
	var valid_msgs2 =  new Array('Please enter the project name','Please attach proposal','Please select the proposal version','Please select the proposal date',
			'Please select the proposal approved','Please enter the agreement no','Please select the agreement signed', 'Please select the work started');
	
	
	if($('#proposal_done').val() == '1' && id == 'submit'){

		if(id != 'submit'){
			error_label2 = get_error_label(id, form_fields2, valid_msgs2);
			var form_fields2 = new Array(id);
			var valid_msgs2 = new Array(error_label2);
		}	
			j= 0;
			while(j < form_fields2.length){
				// if empty show the error msg.
				if(form_fields2[j] == 'proposal_apr'){					
					if($('#proposal_approve').val() == ''){
						$('.'+form_fields2[j]).html(valid_msgs2[j]);
						submit2 = false;
					}else{
						$('.'+form_fields2[j]).html('');
					}
				}else if(form_fields2[j] == 'sign'){					
					if($('#proposal_approve').val() == '1' && $('#agreement_sign').val() == ''){
						$('.'+form_fields2[j]).html(valid_msgs2[j]);
						submit2 = false;
					}else{
						$('.'+form_fields2[j]).html('');
					}
				}else if(form_fields2[j] == 'uploadFile'){					
					if($('#upload_doc').val() == '' && $('#'+form_fields2[j]).val() == ''){
						$('.'+form_fields2[j]).html(valid_msgs2[j]);
						submit2 = false;
					}else{
						$('.'+form_fields2[j]).html('');
					}
				}else if(form_fields2[j] == 'work_status'){					
					if($('#work_status').val() == '1' && $('#work_clicked').val() == '0'){
						$('.'+form_fields2[j]).html(valid_msgs2[j]);
						submit2 = false;
					}else{
						$('.'+form_fields2[j]).html('');
					}
				}else if(form_fields2[j] == 'sow_final'){					
					if($('#sow_done').val() == ''){
						$('.'+form_fields2[j]).html(valid_msgs2[j]);
						submit2 = false;
					}else{
						$('.'+form_fields2[j]).html('');
					}
				}else if(form_fields2[j] == 'agree_no'){					
					if($('#agreement_sign').val() == '1' && $('#'+form_fields2[j]).val() == ''){
						$('.'+form_fields2[j]).html(valid_msgs2[j]);
						submit2 = false;
					}else{
						$('.'+form_fields2[j]).html('');
					}
				}else if($('#'+form_fields2[j]).val() == '' || $('#'+form_fields2[j]).val() ==  null){					
					$('.'+form_fields2[j]).html(valid_msgs2[j]);
					submit2 = false;
				}else if($('#'+form_fields2[j]).val() != ''){
					$('.'+form_fields2[j]).html('');
				}
				j++;
			}			
	}else if(id != undefined && $('#proposal_done').val() == '0'){
		$.each(form_fields2, function( index, value ) {
			$('.'+form_fields2[index]).html('');
		});
	}
	
	var res = false;
	
	if(id != undefined){
		if(id.match(/biz_title/g) || id.match(/contact/g) || id.match(/email/g) || id.match(/designation/g) || id.match(/mobile/g)  || id == 'submit'){
			res = validateBdForm('bizForm', id);
		}
	}
	
	// validate referrer
	if($('.bdreferSource').val() != '1' && $('.bdreferSource').val() != '2' && $('.bdreferSource').val() != '4' && $('.bdreferSource').val() != ''){
		if($('.referField').val() == ''){
			$('.referField2').html('Please enter the name');
			submit3 = false;
		}else{
			$('.referField2').html('');			
		}
	}else{
		$('.referField2').html('');	
		$('.referField').val('');
					
	}
	
	// validate atleast one form 
	if($('#contact0').val() == undefined && $('#user_type').val() == '1'){
		$('.noForm').html('Please enter the contact details');
		submit4 = false;
	}else{
		$('.noForm').html('');
	}
	
	if(submit && res && submit2 && submit3 && submit4 && id == 'submit'){ 
		// hide buttons
		$('.hideBtn2').hide();
		return true;
	}else if((id == 'submit') && (!submit || !res && !submit2)){ 
		$('#flashMessage').show();
		return false;
	}else{ 
		return false;
	}		

}

/* function to get the form error label */
function get_error_label(id, field, msg){ 
	$.each(field, function( index, value ) { 
		if(value == id){ 
			return msg[index];
		}
	});
}

/* function to apply biz. class */
function apply_biz_class(value, obj){ 
	if(value == 'N' || value == '2'){
		$(obj).addClass('freshBiz');
		$(obj).removeClass('oldBiz');
		$(obj).removeClass('currentBiz');
	}else if(value == 'E'  || value == '1'){
		$(obj).addClass('currentBiz');
		$(obj).removeClass('oldBiz');
		$(obj).removeClass('freshBiz');
	}else if(value == 'O' || value == '3'){
		$(obj).addClass('oldBiz');
		$(obj).removeClass('currentBiz');
		$(obj).removeClass('freshBiz');
	}
	
}

