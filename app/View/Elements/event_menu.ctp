<script>
$(document).ready(function() {
	/* hide the event help tips */
	$('.event_tips').click(function(){
		$(this).parent().hide();
		//position = $('.event_tips').index(this);
		call_event_tips($(this).attr('rel'));
	});
	
	
});	

function call_event_tips(p){		
		
			jQuery.ajax({
                url: $('#webroot').val()+'update_event_tips/'+p,              
                contentType: false,
                processData: false,
                data: function() {
                    //var data = new FormData();                 
                }(),
                error: function(_, textStatus, errorThrown) {
                  
                },
                success: function(response, textStatus) { 
                  //alert(response);
                }
            });
	}
</script>

<div class="" style="">
					<div class="span2" style="float:left;margin-top:25px;">
									<ul class="nav nav-tabs nav-stacked">
												<li class="<?php echo $tskevent_index;?>">
													<a href="<?php echo $this->webroot;?>tskevent/">Event Calendar</a>
												</li>
												
												
												
												<li class="<?php echo $tskevent_create_event;?>">
													<a href="<?php echo $this->webroot;?>tskevent/create_event/">Create Event</a>
												</li>
												
										<!--li class="<?php echo $tskevent_list_event;?> <?php echo $tskevent_edit_event;?> <?php echo $tskevent_view_event;?>">
													<a href="<?php echo $this->webroot;?>tskevent/list_event/">Manage Events</a>
												</li-->
												
												
											</ul>
											
											<?php if($this->request->params['action'] == 'index'):?>
											<!--div class="event_theme" style="margin-left:10px;">
											<h5>Calendar Themes</h5> <p></p>
										<ul class="nav nav-list">
											<li class="<?php echo $default_active;?>"><a href="<?php echo $this->webroot;?>tskevent/?theme=default">Default</a></li>
												
												<li class="<?php echo $sky_blue_active;?>"><a href="<?php echo $this->webroot;?>tskevent/?theme=sky_blue">Sky Blue</a></li>											
												<li class="<?php echo $light_orange_active;?>"><a href="<?php echo $this->webroot;?>tskevent/?theme=light_orange">Light Orange</a></li>											
												<li class="<?php echo $grey_active;?>"><a href="<?php echo $this->webroot;?>tskevent/?theme=grey">Grey</a></li>
												
												<li class="<?php echo $blue_active;?>"><a href="<?php echo $this->webroot;?>tskevent/?theme=blue">Blue</a></li>
											
											</ul>
										<p></p>
										
										</div-->
										
								
										
										<?php endif; ?>
										
										
											
											
										
						<?php if($this->request->params['action'] == 'index'):?>
						
					
					
					
					<!--h6>Tips</h6-->	
					<?php if($this->Session->read('evnt_tip_1') != '1'):?>
					<div class="alert  alert-info">
						<button type="button" class="close" data-dismiss="alert">×</button>
						<strong>Click</strong> on the event title in the calendar to view the event details.
						<span class="event_tips" rel="1"><br><i class="icon-remove green"></i> <a href="javascript:void(0)" style="font-size:10px" rel="tooltip" data-placement="right" title="I got it, never show this again"> Hide</a>
						</span>
						</div>
					<?php endif; ?>	
					
					<?php if($this->Session->read('evnt_tip_2') != '1'):?>
				<div class="alert">
						<button type="button" class="close" data-dismiss="alert">×</button>
						<strong>Drag</strong> the event title in the calendar to change the event date.
						<span class="event_tips" rel="2"><br>
						<i class="icon-remove green"></i> <a href="javascript:void(0)" style="font-size:10px" rel="tooltip" data-placement="right" title="I got it, never show this again"> Hide</a>
						</span>
						</div>
					<?php endif; ?>			
	
		<?php if($this->Session->read('evnt_tip_3') != '1'):?>
				<div class="alert  alert-success">
						<button type="button" class="close" data-dismiss="alert">×</button>
						<strong>Modify</strong> the event time by dragging at the end of the event title in Week or Day view.
						<span class="event_tips" rel="3"><br><i class="icon-remove green"></i> <a href="javascript:void(0)" data-placement="right" style="font-size:10px" rel="tooltip" 
						title="I got it, never show this again">Hide</a>
						</span>
						</div>
											
					<?php endif; ?>				
		<?php endif; ?>											
										
					<input type="hidden" value="<?php echo $this->webroot;?>tskevent/" id="webroot"/>
						
								
					</div>			
				</div>				