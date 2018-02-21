<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"  dir="ltr" lang="en-US">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title></title>
<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300">
<link rel="stylesheet" type="text/css" href="styles.css" />
<script type="text/javascript" src="js/jquery-1.3.2.js" ></script>
<script type="text/javascript" >
$(function(){
	var loader=$('#loader');
	var pollcontainer=$('#pollcontainer');
	loader.fadeIn();
	//Load the poll form
	$.get("poll.php?id=<?php echo $_GET['id']?>&pollid=<?php echo $_GET['pollid']?>", '', function(data, status){
		pollcontainer.html(data);
		animateResults(pollcontainer);
		pollcontainer.find('#viewresult').click(function(){
			//if user wants to see result
			loader.fadeIn();
			$.get("poll.php?id=<?php echo $_GET['id']?>&pollid=<?php echo $_GET['pollid']?>", 'result=1', function(data,status){
				pollcontainer.fadeOut(1000, function(){
					$(this).html(data);					
					animateResults(this);
					
				});
				loader.fadeOut();
			});
			//prevent default behavior
			return false;
		}).end()
		.find('.pollBtn').click(function(){			
			var selected_val = $('#pollform').find('input[name=poll]:checked').val();
			// if others option selected
			if($('#hdnOther').val() == '1'){
				if($('#otherTxt').val() == ''){
					$('#otherTxt').css('border', '1px solid #ff0000');
					return false;
				}else{
					$('.pollBtn').hide(); // hide poll button
					// save the option value
					id = $('#pollID').val();					
					$.post("poll.php?pollid="+id, $('#pollform').serialize(), function(data, status){
						$('#formcontainer').fadeOut(100, function(){							
							if(data != ''){
								//post data only if a value is selected
								loader.fadeIn();
								$.post("poll.php?id=<?php echo $_GET['id']?>&pollid=<?php echo $_GET['pollid']?>&other_id="+data, $('#pollform').serialize(), function(data, status){
									$('#formcontainer').fadeOut(100, function(){
										$(this).html(data);
										animateResults(this);
										$('.poll_error').fadeOut();
										loader.fadeOut();
									});
								});
							}
							//prevent form default behavior
							return false;							
						});
					});					
				}
				return false;
				
			}			
			
			if(selected_val == undefined){
				$('.poll_error').fadeIn();
				return ;
			} 
			if(selected_val!=''){
				$('.pollBtn').hide(); // hide poll button
				//post data only if a value is selected
				loader.fadeIn();
				$.post("poll.php?id=<?php echo $_GET['id']?>&pollid=<?php echo $_GET['pollid']?>", $('#pollform').serialize(), function(data, status){
					$('#formcontainer').fadeOut(100, function(){
						$(this).html(data);
						animateResults(this);
						$('.poll_error').fadeOut();
						loader.fadeOut();
					});
				});
			}
			//prevent form default behavior
			return false;
		}).end().find('.otherCls').click(function(){  // for others option
			if($(this).attr('val') == 'Others'){
				$('#otherTxt').show();
				$('#hdnOther').val(1);
			}else{
				$('#otherTxt').hide();	
				$('#otherTxt').val('');
				$('#hdnOther').val(0);
			}
		
		});
		loader.fadeOut();
	});
	
	function animateResults(data){
		$(data).find('.bar').hide().end().fadeIn('slow', function(){
							$(this).find('.bar').each(function(){
								var bar_width=$(this).css('width');
								$(this).css('width', '0').animate({ width: bar_width }, 1000);
							});
						});
	}
	
	
	
});
</script>
</head>
<body>
	<div id="container" >
		
		<div id="pollcontainer" >
		</div>
		<div class="error poll_error" style="display:none;color:#ff0000" >Please select any one</div>
		<p id="loader" >Loading...</p>
	</div>
</body>
</html>