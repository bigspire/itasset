<?php if($this->request->params['controller'] == 'tskplan' || $this->request->params['controller'] == 'tskteamplan'):
$model = 'TskPlanReply';
else:
$model = 'TskAssignReply';
endif;
?>
<div class="box-content scrollable" data-height="150" data-start="top" data-visible="true">
								<ul class="messages">
									<?php foreach($reply_data as $reply):?>	
									<li class="left" style="margin-top:10px">

										<div class="message"  style="margin-left:20px">
													
																					
											<p><span class="name"><?php echo  $reply['HrEmployee']['first_name'];?> :</span><span class="time" style="float:right">
												 <?php echo $this->Functions->time_diff($reply[$model]['created_date']);?>   
											</span>	 <?php echo  $reply[$model]['desc'];?> </p>
										</div>
									</li>
								<?php endforeach;?>
									
								</ul>
								
					
							</div>
							
						


