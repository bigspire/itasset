<?php foreach($share_reply as $share): ?>
															
															<div class="itemdiv dialogdiv" style="min-height:33px;margin-left:50px;top:15px;">
															<div class="user">
																<?php if($share['Home']['photo'] != ''):?>
							<img src="<?php echo $this->webroot;?>timthumb.php?src=uploads/photo/<?php echo $share['Home']['photo'];?>&w=36&h=36&q=100" title="<?php echo $share['Home']['first_name'].' '.$share['Home']['last_name'];?>"/>	
						<?php elseif($this->Session->read('USER.Login.gender') == 'M'): ?>
						<img class="nav-user-photo" src="<?php echo $this->webroot;?>img/profile_male_s.jpg" title="<?php echo $share['Home']['first_name'].' '.$share['Home']['last_name'];?>"/>
							<?php else: ?>
							<img class="nav-user-photo" src="<?php echo $this->webroot;?>img/profile_male_s.jpg" title="<?php echo $share['Home']['first_name'].' '.$share['Home']['last_name'];?>"/>
							<?php endif; ?>						
							
															</div>

															<div class="body" style="border-color:<?php //echo $this->Functions->chk_personalized($share['ShareUser']['app_users_id']);?>">
															

																<div class="name">
		
		<a href="<?php echo $this->webroot;?>home/overlay_info/<?php echo $share['Home']['id'];?>/share/" class="iframeBox" val="50_70">		
		
		<?php
		if($this->Session->read('USER.Login.id') == $share['Home']['id']):
		echo 'Me';
		else:
		echo ucwords($share['Home']['first_name'].' '.$share['Home']['last_name']);
		endif;
		?></a>
																</div>
																<div class="text"><?php echo $share['Share']['share']?>
																
																	<span class="widget-toolbar no-border" style="color:#4383b4;line-height:normal">
																	<i class="icon-time bigger-110"></i>
																	<?php				
								echo $this->Functions->time_diff($share['Share']['created_date']);?> 
																</span>
																
																
																</div>

																
		<?php if($this->Session->read('USER.Login.id') != $share['Home']['id']): ?>				
				<div style="margin-top:8px;clear:left">
<i class="icon-share"></i> <a href="javascript:void(0)" class="replytoggle">Reply</a>	

<div>
<input style="margin-top:10px;width:60%" placeholder="Enter reply here...  Hit Enter to save.."  type="text" class="form-control shareReplyBx dn shareReply"  val="<?php echo $share['Share']['reply_id']; ?>">

</div>
	</div>
<?php endif; ?>

															
																
															</div>
															
														</div>
														
														<?php   endforeach;?>	
															
														
														
														
														
														