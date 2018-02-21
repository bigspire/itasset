<?php foreach($reply_data as $key => $reply):?>	
									<li class="<?php //echo $key%2 ? 'right' : 'left';?>">
										<div class="image">
										
										<?php if($reply['HrEmployee']['photo'] != '' && $reply['HrEmployee']['photo_status'] == 'A'):?>
							<img src="<?php echo $this->webroot;?>timthumb.php?src=uploads/photo/<?php echo $reply['HrEmployee']['photo'];?>&w=60&h=90&q=100"/>	
							<?php elseif($reply['HrEmployee']['gender'] == 'M'): ?>
							<img  src="<?php echo $this->webroot;?>img/profile_male_s.jpg" title="<?php echo $reply['HrEmployee']['first_name'].' '.$reply['HrEmployee']['last_name'];?>" title="<?php echo $reply['HrEmployee']['first_name'].' '.$reply['HrEmployee']['last_name'];?>"/>
							<?php else: ?>
							<img  src="<?php echo $this->webroot;?>img/profile_female_s.jpg" title="<?php echo $reply['HrEmployee']['first_name'].' '.$reply['HrEmployee']['last_name'];?>" title="<?php echo $reply['HrEmployee']['first_name'].' '.$reply['HrEmployee']['last_name'];?>"/>
							<?php endif; ?>							
							
							
							
										</div>
										<div class="message">
											<span class="caret"></span>
											<span class="name"><?php echo  $reply['HrEmployee']['first_name'].' '.$reply['HrEmployee']['last_name'];?></span>
											<p><?php echo $reply['BdReply']['desc'];?></p>
											<span class="time">
												 <?php echo $this->Functions->time_diff($reply['BdReply']['created_date'], '1', '1');?>   
											</span>
										</div>
									</li>
								<?php endforeach;?>	