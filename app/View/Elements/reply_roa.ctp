<div class="box-content scrollable" data-height="150" data-start="top" data-visible="true">
								<ul class="messages" style="margin-left:0px">
									<?php foreach($reply_data as $reply):?>	
									<li class="left" style="margin-top:10px">

										<div class="message"  style="margin-left:0px">
													
																					
											<p><span class="name"><?php echo  $reply['HrEmployee']['first_name'];?> :</span><span class="time" style="float:right">
												 <?php echo $this->Functions->time_diff($reply['TskRoaReply']['created_date']);?>   
											</span>	 <?php echo  $reply['TskRoaReply']['desc'];?> </p>
										</div>
									</li>
								<?php endforeach;?>
									
								</ul>
								
					
							</div>
							
						


