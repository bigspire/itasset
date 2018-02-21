					
													<?php 
													foreach($comData as $comment):?>
														<div class="itemdiv dialogdiv">
															<div class="user">
							<?php if($comment['HrEmployee']['photo'] != '' && $comment['HrEmployee']['photo_status'] == 'A'):?>
							<img src="<?php echo $this->webroot;?>timthumb.php?src=uploads/photo/<?php echo $comment['HrEmployee']['photo'];?>&w=40&h=52&q=100" title="<?php echo $comment['HrEmployee']['first_name'].' '.$comment['HrEmployee']['last_name'];?>"/>	
							<?php elseif($comment['HrEmployee']['gender'] == 'M'): ?>
							<img  src="<?php echo $this->webroot;?>img/profile_male_s.jpg" title="<?php echo $comment['HrEmployee']['first_name'].' '.$comment['HrEmployee']['last_name'];?>"/>
							<?php else: ?>
							<img  src="<?php echo $this->webroot;?>img/profile_female_s.jpg" title="<?php echo $comment['HrEmployee']['first_name'].' '.$comment['HrEmployee']['last_name'];?>"/>
							<?php endif; ?>	
							
															
															</div>

															<div class="body" style="font-size:12px;">
																<div class="time">
																	<i class="ace-icon fa fa-clock-o"></i>
																	<span class="blue"  style="font-size:12px;font-weight:normal;"><?php echo $this->Functions->time_diff($comment['HrGalComment']['created_date'], 1);?></span>
																</div>

																<div class="name">
																	<a href="<?php echo $this->webroot;?>home/overlay_info/<?php echo $comment['HrEmployee']['id'];?>/share/" class="iframeBox" val="80_86"><?php echo $comment['HrEmployee']['first_name'];?></a>
																</div>
																<div class="text"  style="font-size:12px;"><?php echo $comment['HrGalComment']['msg'];?></div>

																
															</div>
															
														</div>
	
														<?php endforeach;?>
	
							