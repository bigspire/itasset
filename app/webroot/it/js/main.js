$(document).ready(function(){
	
	// function to remove the success msg_div
	 $(".close").click(function(){ n
		var id = $(this).attr('id'); // get the dynamic value from button
		$('.hide-'+id).hide();
     });
	 
	 /* to redirect */
	 $(".jsRedirect").each(function() {
		$(this).click(function() {
			location.href=jQuery(this).attr("val");
		});
	});
	
	// delete records from front end
	$(".deletedata").click(function(){
		var id = $(this).attr('id'); // get the dynamic value from button	
		var page_id = $(this).attr('val');// get the dynamic value from button		
		var url = (page_id == 'ticket') ? 'fr_delete_ticket.php' : 'fr_delete_change_asset.php';
		var msg_div = (page_id == 'ticket') ? '#message1' : '#message';
		var c = confirm('Are you sure you want to delete this record?');// ask to user confirmation deleteing
		if(c == true){
		    $.ajax({              
				url : url+'?id='+id,
			 	method : "GET",
		   	success: function(data){
					$('.row-'+id).hide();
					$(msg_div).show();
					// to display the menu count
					var count_id = (page_id == 'ticket') ? '#tkt_cnt' : '#ast_cnt';
					var num = parseInt($(count_id).html()) - parseInt(1);
					$(count_id).html(num);	
				}			 
			});			
		}			
	}); 


	
	
	// when the form submitted 
	$('#formID').submit(function(){ 	
		// Disable the 'Next' button to prevent multiple clicks		
		$('input[type=submit]', this).attr('value', 'Processing...');		
		$('input[type=submit]', this).attr('disabled', 'disabled');
	});
	
/*	// for fetch districts
	$(".stateid").change(function (){
		var statname = $(this).val();
		 var stat_id = $(this).attr('id').split('_');
		 //alert(statname);
		 $.ajax({
			url : "get_district.php",
			method : "GET",
			dataType: "json",
			data : {state : statname},
			encode  : false
		})
			.done(function (data){
				var div_data = '<option value="">Select</option>';
				$.each(data,function (a,y){ 
				div_data +=  "<option value="+a+">"+y+"</option>";
           });
           //alert(div_data);	
            $('#district_id_'+stat_id[1]).empty();
            $('#district_id_'+stat_id[1]).html(div_data); 
			 });
	});	*/
	
 	
	
		function split( val ){
		  return val.split( /,\s*/ );
		}
		function extractLast( term ) {
		  return split( term ).pop();
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
					if($('#graphHdn').length > 0){
						window.parent.location.reload(true); 					 
					}else if(($('#fr_home').length > 0) && ($('#fr_home').val() == 'success')){
						window.parent.location.reload(true); 					 
					}
			
				 }
			
			});
		}
	}
      // for auto complete	search
	 if($('#keyword').length > 0){
		$( "#keyword")
		  .bind( "keydown", function( event ){
			// for asset type search			
			if ( event.keyCode === $.ui.keyCode.TAB &&
				$( this ).autocomplete( "instance" ).menu.active ){
				event.preventDefault();
			}
		  })
		  .autocomplete({
			source: function( request, response ) { 
			  $.getJSON( "autocomplete_search.php", {
				term: extractLast( request.term ),page:$('#page').val(),para1:$('#asset_type').val()
			  }, response );
			},
			search: function() {
			  // custom minLength
			  var term = extractLast( this.value );
			  if ( term.length < 2 ) {
				return false;
			  }
			},
			focus: function() {
			  // prevent value inserted on focus
			  return false;
			},
			select: function( event, ui ){
				if(ui.item.value != 'No Results!'){
				  var terms = split( this.value );
				  // remove the current input
				  terms.pop();
				  // add the selected item
				  terms.push( ui.item.value );
				  // add placeholder to get the comma-and-space at the end
				  terms.push( "" );
				  this.value = terms.join( ", " );
				  return false;
			  }else{
				return false;
			  }			  
			}
			
		  });
	} 
	 
	// multiple location selection in jquery	
	if(jQuery('.multi_select').length > 0){ 
		$(".multi_select").multiselect({
		minWidth:270,
		height:220}); 
	}
	
/*	 numeric field validation */
	jQuery(".numeric").on("keypress",function(event){
		var regex = new RegExp("^[0-9 -]+$"); 
		var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
		var exists_space = false,dont_allow = false;
		//this.value = this.value.replace(/^\s+/,"");
		if(this.value.indexOf(' ') != -1 && key == ' '){
			//exists_space = true;
		}
		if(this.value.indexOf('-') != -1 && key == '-'){
			exists_space = true;
		}
		if ((!regex.test(key) && (event.which) != 8 && event.which!=0) || exists_space) {
			event.preventDefault();
			return false;
		}
	});
	
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
		});
	
	}
	
	
	/*	

	// for drive from and to date
	if($('.dpd1,.dpd2').length > 0){
		check_in_out();
	}
	
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
			newDate.setDate(newDate.getDate());
			checkout.setValue(newDate);
		  }
		  checkin.hide();
		  $('.dpd2')[0].focus();
		}).data('datepicker');

		var checkout = $('.dpd2').datepicker({
		  format: 'dd/mm/yyyy',
		  'todayHighlight': false,
		  onRender: function(date) { 
			return date.valueOf() <= checkin.date.valueOf() ? 'disabled' : '';
		  }
		}).on('changeDate', function(ev) {
		  checkout.hide();
		}).data('datepicker');
	
	}
	*/

	
	/*
	// function to change the asset type
	$('.change_asset_type').change(function(){ 
	var asset_id = $(this).attr('id').split('_');
		if($(this).val() == 'S'){
			// alert(asset_id);
			if($('.swDiv').change(function()) 
			{
				alert(hi);
				var asset_type_id = $(this).attr('id').split('_');
				if (asset_id == asset_type_id) {
					
					$('.swDiv').show();
					$('.hwDiv').hide();
				}
			});
			
		}else{
			if($('.hwDiv'))
			{
				var asset_type_id = $(this).attr('id').split('_');
				if (asset_id == asset_type_id) {
					alert('hi');
					$('.hwDiv').show();
					$('.swDiv').hide();
				}
			}
		}
	});
	
	*/

	// function to change the subscription validity
	$('.change_subscription_based').change(function(){ 
		if($(this).val() == '1' || $(this).val() == ''){
			$('.sValidity').show();
		}else if($(this).val() == '2'){
			$('.sValidity').hide();
		}
	});
	
	if($('.change_subscription_based').length > 0){
		if($('.change_subscription_based:selected').val() == '1' || $('.change_subscription_based:selected').val() == ''){
			$('.sValidity').show();
		}else if($('.change_subscription_based:selected').val() == '2'){
			$('.sValidity').hide();
		}
	}

	
	// $( ".btn-primary" ).val( "Next Step..." );
	
	// show tooltip for icons	
	$('[rel=tooltip]').tooltip({html:true});
	
	
	// Submit button identification
	$('#submit_previous').click(function(e){
		 $('#next_hdn' ).val('0');
		 $('#confirm_hdn').val('0');
		 $('#previous_hdn').val('1');

	});

	$('#submit_confirm').click(function(e){
		 $('#next_hdn' ).val('0');
		 $('#confirm_hdn').val('1');
		 $('#previous_hdn').val('0');
	});
	
	$('#submit_next').click(function(e){
		$('#next_hdn' ).val('1');
		$('#confirm_hdn').val('0');
		$('#previous_hdn').val('0');
	});
});

// delete button validation
function deletefunction(){
    var del = confirm('Are you sure you want to delete this record?');
    if(del == true){
      return true;
    }else{
    	return false;
    }
} 
// add scrap hardware validation
function scrapfunction(){
    var mov = confirm('Are you sure you want to move to scrap?');
    if(mov == true){
      return true;
    }else{
    	return false;
    }
} 
  // delete button validation
function cancelfunction(){
    var can = confirm('Are you sure you want to cancel?');
    if(can == true){
      return true;
    }else{
    	return false;
    }
}
