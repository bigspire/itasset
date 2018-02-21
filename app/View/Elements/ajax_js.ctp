<script type="text/javascript">
$(document).ready(function() {
	
	$('.holidayPop').click(function(){
		// open the modal
		$('#holidayPop').modal({show:true});
	});
		
	$('.openComp').click(function(){
		// open the modal
		$('#comp_profile').modal({show:true})
	});

	/* reply share */	
	$('.replytoggle').unbind().on('click', function(){
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
				$(this).val('');
				$(this).hide();
				update_reply_share(value,id,userid,type);	
			}
		}
	});
	/* to close the items */		
	$('.itemChk').unbind().click(function(e) { 
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
	  $('.editItem').unbind().click(function() { 
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
	  
	  /* to delete the item */
	  $('.delItem').unbind().click(function() { 	
		split_id = $(this).attr('val').split('-'); 
		$('#tasks').find('.listitems-'+split_id[1]).fadeOut("slow");
			// to delete the todo
			delete_todo(split_id[1]);
	  });
	  
	   /* to delete the item */
	  $('.flagItem').unbind().click(function() { 	
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
	  
	
	  
	 $('.openProf').on('click', function(){ 
			// hide all profiles
			$('.profSummary').hide();
			// show only the selected
			$('.member_'+$(this).attr('id')).show();
			// open the modal
			$('#myModal').modal({show:true})
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
	
	/* function to hide the tool tip */
		$('.click_hide').on('click', function(){  		
			$('.tooltip').html('');
			
		});
	
	/* function to refresh share */
	$('.refShare').unbind().click(function (){ 	
		mod = $(this).attr('rel');
		action = mod == 'roa' ? 'load_total_share_roa' : 'load_total_share';
		group = mod == 'roa' ? 'roa_total_group' : 'total_group';
		$('#busy-indicator').show();		
		$.ajax({
		    url: root+'home/'+action+'/'
		}).done(function( html ) {
			total = html.split('|||');
			$('#'+group).val(total[0]);
			//total_groups = total[0];
			total[2] == 'roa' ? load_roa_share_data(0): load_share_data(0);
			ref_id = mod == 'roa' ? '#ref_roa' : '#ref_share';
			count_cls = mod == 'roa' ? '.roaCount' : '.intCount';
			count_cls2 = mod == 'roa' ? '.roaCount2' : '.intCount2';
			// update hidden field
			$(ref_id).val(1); 
			// update share count in tab
			if(total[1] > 0){
				$(count_cls).html(total[1]);
				$(count_cls).show();
				if($(count_cls2).length > 0){
					$(count_cls2).hide();
				}
			}
			$('#busy-indicator').hide();	
			
		});	
		
	});
	
	$("[rel=preview]").popover({html:true});
	
	$("[rel=popover]").popover();
		
	/* for gallery */
		if($(".colorbox2").length > 0){
			$(".colorbox2").colorbox({ 
				maxWidth: "80%",
				maxHeight: "80%",
				rel: $(this).attr("rel")
			});
		}	
		
	/* todo sorting */
	if($('.sortable').length > 0){
		$( ".sortable" ).sortable({
			placeholder: "ui-state-highlight",
			update: function(event, ui) {
				var info = $(this).sortable("serialize");
				update_todo_order(info);
			}
		});
		$(".sortable" ).disableSelection();
	}
	

	
	// load the color box
	$('.iframeBox').click(function(){
		load_colorBox(this, $(this).attr('val'));	
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
				
				 }
			
			});
		}
	}
	
	/* to upload a file */
		$("#uploadFile").change(function() {
			
			//$("#file_name").html(this.value);
			// start preloader
			$('.submitUpload').show();	
			$('.submitUploadCan').show();	
			$(".fileUpload").hide();	
           
        });
		
		/* upload file */
		$('.submitUpload').click(function(){
			if(check_browser('alert')){
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
		}
		
		});
		
		/* cancel file upload */
		$('.submitUploadCan').click(function(){	
			cancel_upload();
			$(".fileUpload").show();			
			
		});
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
		
		
		// update hidden to avoid multiple reload
		if($('#ajaxTabLoad').length > 0){
			tab_val = $('#ajaxTabLoad').val();
			$('#ajaxTabLoad').val(tab_val++);
		}
		
		/* slider for gallery */		
		if($('.bxslider').length > 0){
			for(i = 1; i <= $('#galCount').val(); i++){
				if($('#gal_ID'+i).val() == ''){
					$('.bxslider'+i).unbind().bxSlider({
					  pager:false,
					  maxSlides:10,
					  slideMargin: 4,
					  slideWidth: 250,
					  infiniteLoop:false,
					  hideControlOnEnd:true
					});
				}
				$('#gal_ID'+i).attr('value', i); 
			}
		}
		
		/* function to call task assigned */
		$('.tskToMe').click(function(){
			root = $('#webroot').val();
			$('#busy-indicator').show();
			$.ajax({
				 url: root+'home/get_task_assign/1/'
			}).done(function(html){		
				$('#busy-indicator').hide();
				$('.assignData').html(html);				
				$('.tsk_by_me').show();
				$('.tskTxt').html('<b>Tasks -  Assigned To Me </b>');
				$('.tsk_to_me').hide();
				$('[rel=tooltip]').tooltip({html:true});
			});
		});
		
		$('.tskByMe').click(function(){
			root = $('#webroot').val();
			$('#busy-indicator').show();
			$.ajax({
				 url: root+'home/get_users_assign/1/'
			}).done(function(html){		
				$('#busy-indicator').hide();
				$('.assignData').html(html);				
				$('.tsk_by_me').hide();
				$('.tsk_to_me').show();
				$('.tskTxt').html('<b>Tasks -  Assigned By Me </b>');
				$('[rel=tooltip]').tooltip({html:true});
			});
		});
		
	
});
</script>
<script src="<?php echo $this->webroot;?>js/application.js"></script>

