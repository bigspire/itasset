<script type="text/javascript">
$(document).ready(function() { 	
	$('.mark-time').unbind().click(function(){ 
		type = $(this).attr('rel');
		// if in or out time only
			if(type == 'in' || type == 'out'){
				mark_time($(this).attr('rel'), 0);
			}else{
				//$(this).popover('hide');
			}
			
			return false;			
	});
	
	$("[rel=preview]").popover({html:true});
	
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
});
</script>

		<span id="att_timer">
				<?php 				 
				 if(strtotime(date('H:i')) > strtotime($office_time) && empty($att_data[0]['HrAttendance']['in_time']) && $today_permission == '1'):?>				 
				 <button  id="att_reason"  data-rows="2" data-type="textarea" data-pk="<?php echo $today_permission;?>" data-url="<?php echo $this->webroot;?>home/att_reason/" data-title="Exceeded permission time. Reason for late"  class="btn btnIn btn-time btn-sm <?php echo $this->Functions->check_cursor($att_data[0]['HrAttendance']['in_time']);?>"  rel="in<?php echo $att_data[0]['HrAttendance']['in_time'];?>" style="padding:6px 12px;margin:0px 10px 0 10px;">In Time: 
				<span  id="in_time"><?php echo $this->Functions->format_attime($att_data[0]['HrAttendance']['in_time']);?></span><?php if(empty($att_data[0]['HrAttendance']['in_time'])):?>
							<span class="badge badge-danger in_time" >?</span>
							<?php endif; ?>
							</button>
			
					<?php
				
				elseif(strtotime(date('H:i')) > strtotime($office_time) && empty($att_data[0]['HrAttendance']['in_time'])):?>				 
				 <button  id="att_reason"  data-rows="2" data-type="textarea" data-pk="<?php echo $today_permission;?>" data-url="<?php echo $this->webroot;?>home/att_reason/" data-title="Reason for late"  class="btn btnIn btn-time btn-sm <?php echo $this->Functions->check_cursor($att_data[0]['HrAttendance']['in_time']);?>"  rel="in<?php echo $att_data[0]['HrAttendance']['in_time'];?>" style="padding:6px 12px;margin:0px 10px 0 10px;">In Time: 
				<span  id="in_time"><?php echo $this->Functions->format_attime($att_data[0]['HrAttendance']['in_time']);?></span><?php if(empty($att_data[0]['HrAttendance']['in_time'])):?>
							<span class="badge badge-danger in_time" >?</span>
							<?php endif; ?>
							</button>			
				<?php
				
				elseif(strtotime(date('H:i')) < strtotime('08:00') && empty($att_data[0]['HrAttendance']['in_time'])):?>				 
				  <button  id="att_reason"  data-rows="2" data-type="textarea" data-pk="" data-url="<?php echo $this->webroot;?>home/att_reason/" data-title="Reason for so early"  class="btn btnIn btn-time btn-sm <?php echo $this->Functions->check_cursor($att_data[0]['HrAttendance']['in_time']);?>"  rel="in<?php echo $att_data[0]['HrAttendance']['in_time'];?>" style="padding:6px 12px;margin:0px 10px 0 10px;">In Time: 
				<span  id="in_time"><?php echo $this->Functions->format_attime($att_data[0]['HrAttendance']['in_time']);?></span><?php if(empty($att_data[0]['HrAttendance']['in_time'])):?>
							<span class="badge badge-danger in_time" >?</span>
							<?php endif; ?>
							</button>
				<?php else:?>				
					<button class="btn btn-time btn_in btn-sm mark-time tooltip-success relin <?php echo $this->Functions->check_cursor($att_data[0]['HrAttendance']['in_time']);?>" data-rel="timepopover" data-placement="bottom"  data-content="You have successfully marked your in time" data-original-title="Thanks"  rel="in<?php echo $att_data[0]['HrAttendance']['in_time'];?>" style="padding:6px 12px;margin:0px 10px 0 10px;">In Time: 
				<span  id="in_time"><?php echo $this->Functions->format_attime($att_data[0]['HrAttendance']['in_time']);?></span>
							
							<?php if(empty($att_data[0]['HrAttendance']['in_time'])):?>
							<span class="badge badge-danger in_time" >?</span>
							<?php endif; ?>
							</button>
					
				 <?php endif; ?>
					
					<?php 
					 if(empty($att_data[0]['HrAttendance']['in_time'])):?>
					 <button  title="Oops!" data-placement="bottom" data-content="You didn't mark your in time" class="tooltip-error popover btn btnOut btn-time btn-sm <?php echo $this->Functions->check_cursor($att_data[0]['HrAttendance']['out_time']);?>"  rel="preview" style="padding:6px 12px;margin-right:10px;cursor:default">Out Time: 
					<span  id="out_time"><?php echo $this->Functions->format_attime($att_data[0]['HrAttendance']['out_time']);?></span><?php if(empty($att_data[0]['HrAttendance']['out_time'])):?>
							<span class="badge badge-danger out_time" >?</span>
							<?php endif; ?>
							</button>
							
				 <?php elseif(strtotime(date('H:i')) < strtotime($office_out_per_time) && empty($att_data[0]['HrAttendance']['out_time']) && $out_permission == '1'): ?>
					 <button  id="out_att_reason"  data-rows="2" data-type="textarea" data-out = "1" data-pk="outPerm-<?php echo $out_permission;?>-E" data-url="<?php echo $this->webroot;?>home/att_reason/" data-title="Reason for early"  class="btn btnOut btn-time btn-sm <?php echo $this->Functions->check_cursor($att_data[0]['HrAttendance']['out_time']);?>"  rel="out<?php echo $att_data[0]['HrAttendance']['out_time'];?>" style="padding:6px 12px;margin-right:10px;">Out Time: 
				<span  id="out_time"><?php echo $this->Functions->format_attime($att_data[0]['HrAttendance']['out_time']);?></span><?php if(empty($att_data[0]['HrAttendance']['out_time'])):?>
							<span class="badge badge-danger out_time" >?</span>
							<?php endif; ?>
							</button>
							
				<?php elseif(strtotime(date('H:i')) >= strtotime($office_out_correct_time) && strtotime(date('H:i')) <= strtotime($office_out_time)&&  empty($att_data[0]['HrAttendance']['out_time'])): ?>
					<button class="btn btn-time relout btn_in btn-sm mark-time tooltip-success <?php echo $this->Functions->check_cursor($att_data[0]['HrAttendance']['out_time']);?>" data-rel="timepopover" data-placement="bottom"  data-content="You have successfully marked your out time" data-original-title="Thanks"  rel="out<?php echo $att_data[0]['HrAttendance']['out_time'];?>" style="padding:6px 12px;margin-right:10px;">Out Time:
					<span id="out_time"><?php echo $this->Functions->format_attime($att_data[0]['HrAttendance']['out_time']);?></span>
					
					<?php if(empty($att_data[0]['HrAttendance']['out_time'])):?>
					<span class="badge badge-danger out_time">?</span>
					<?php endif; ?>
					</button>
					
				
							
				
				<?php elseif(strtotime(date('H:i')) < strtotime($office_out_time) &&  empty($att_data[0]['HrAttendance']['out_time'])):?>
					 <button  id="out_att_reason"  data-rows="2" data-type="textarea" data-out = "1" data-pk="outPerm-<?php echo $out_permission;?>-E" data-url="<?php echo $this->webroot;?>home/att_reason/" data-title="Reason for early"  class="btn btnOut btn-time btn-sm <?php echo $this->Functions->check_cursor($att_data[0]['HrAttendance']['out_time']);?>"  rel="out<?php echo $att_data[0]['HrAttendance']['out_time'];?>" style="padding:6px 12px;margin-right:10px;">Out Time: 
				<span  id="out_time"><?php echo $this->Functions->format_attime($att_data[0]['HrAttendance']['out_time']);?></span><?php if(empty($att_data[0]['HrAttendance']['out_time'])):?>
							<span class="badge badge-danger out_time" >?</span>
							<?php endif; ?>
							</button>
					
								
				<?php // if(strtotime(date('H:i')) > strtotime($office_out_time) &&  empty($att_data[0]['HrAttendance']['out_time']))
				else:?>
				
					 <button  id="out_att_reason<?php echo $att_data[0]['HrAttendance']['out_time'];?>"  data-rows="2" data-type="textarea" data-out = "1" data-pk="outPerm-<?php echo $out_permission;?>-L" data-url="<?php echo $this->webroot;?>home/att_reason/" data-title="Reason for late"  class="btn btnOut btn-time btn-sm <?php echo $this->Functions->check_cursor($att_data[0]['HrAttendance']['out_time']);?>"  rel="out<?php echo $att_data[0]['HrAttendance']['out_time'];?>" style="padding:6px 12px;margin-right:10px;">Out Time: 
				<span  id="out_time"><?php echo $this->Functions->format_attime($att_data[0]['HrAttendance']['out_time']);?></span><?php if(empty($att_data[0]['HrAttendance']['out_time'])):?>
							<span class="badge badge-danger out_time" >?</span>
							<?php endif; ?>
							</button>	
						
			<?php endif;?>
			</span>
				