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
	
	/* editable for reason in attendance */
	if($('#att_reason').length > 0){
		$('#att_reason').editable({
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
					$(this).html('In Time: '+response);	
					// hide the reason box
					$('.editable-container').html('');	
					$('.editable-container').hide();
					// change mouse cursor
					$('.btnIn').addClass('cursor');	
					
				}
			}
		});
	 }
});
</script>
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
				<?php else:?>
					
					<button class="btn btn-time btn_in btn-sm mark-time tooltip-success relin <?php echo $this->Functions->check_cursor($att_data[0]['HrAttendance']['in_time']);?>" data-rel="timepopover" data-placement="bottom"  data-content="You have successfully marked your in time" data-original-title="Thanks"  rel="in<?php echo $att_data[0]['HrAttendance']['in_time'];?>" style="padding:6px 12px;margin:0px 10px 0 10px;">In Time: 
				<span  id="in_time"><?php echo $this->Functions->format_attime($att_data[0]['HrAttendance']['in_time']);?></span>
							
							<?php if(empty($att_data[0]['HrAttendance']['in_time'])):?>
							<span class="badge badge-danger in_time" >?</span>
							<?php endif; ?>
							</button>
					
 <?php endif; ?>