<?php //echo $this->element('member'); ?>
<div id="share_loading" class="dn">Loading data.. Pls wait..  <img src="<?php echo $this->webroot;?>img/loading.gif"></div><?php $i = 1;	
														foreach($share_data as $share):?>
														
														<?php $sid = $share['Share']['id']; ?>
														<?php if($share['Share']['reply_id'] == ''):?>	
					<div class="itemdiv dialogdiv line-<?php echo $this->Functions->get_line_color($i);?>" >															
															
															<div class="user">
															
							
							<?php if($share['Share']['type'] == 'T'):?>
							<img src="<?php echo $this->webroot;?>timthumb.php?src=uploads/company/ct_fav.jpg<?php //echo $comp_data['HrCompany']['logo'];?>&w=52&h=40&q=100" title="<?php echo $comp_data['HrCompany']['company_name'];?>"/>															
							<?php elseif($share['Share']['type'] != 'S'):?>
							<img src="<?php echo $this->webroot;?>timthumb.php?src=uploads/company/ct_fav.jpg<?php //echo $comp_data['HrCompany']['logo'];?>&w=52&h=40&q=100" title="<?php echo $comp_data['HrCompany']['company_name'];?>"/>								
							<?php elseif($share['Home']['photo'] != '' && $share['Home']['photo_status'] == 'A'):?>
							<img src="<?php echo $this->webroot;?>timthumb.php?src=uploads/photo/<?php echo $share['Home']['photo'];?>&w=40&h=52&q=100" title="<?php echo $share['Home']['first_name'].' '.$share['Home']['last_name'];?>"/>	
							<?php elseif($share['Home']['gender'] == 'M'): ?>
							<img  src="<?php echo $this->webroot;?>img/profile_male_s.jpg" title="<?php echo $share['Home']['first_name'].' '.$share['Home']['last_name'];?>" title="<?php echo $share['Home']['first_name'].' '.$share['Home']['last_name'];?>"/>
							<?php else: ?>
							<img  src="<?php echo $this->webroot;?>img/profile_female_s.jpg" title="<?php echo $share['Home']['first_name'].' '.$share['Home']['last_name'];?>" title="<?php echo $share['Home']['first_name'].' '.$share['Home']['last_name'];?>"/>
							<?php endif; ?>							
							
															</div>

					<div class="body" style="border-color:<?php //echo $this->Functions->chk_personalized($share['ShareUser']['app_users_id']);?>">
															
		
		<?php 
		if($share['Share']['type'] == 'S'):
		$prev_id = $share['Home']['id'];
		$info_type = 'share';
		$overlay_val = '50_70';
		else:
		$prev_id = '1';
		$info_type = 'company';
		$overlay_val = '50_57';
		endif; 
		?>
		
		
		<div class="name">
		<a href="<?php echo $this->webroot;?>home/overlay_info/<?php echo $prev_id;?>/<?php echo $info_type; ?>/" class="iframeBox" val="<?php echo $overlay_val;?>">		
		<?php
		if($share['Share']['type'] != 'S' && $share['Share']['type'] != 'T'):
		echo $comp_data['HrCompany']['company_name'];		
		elseif($this->Session->read('USER.Login.id') == $share['Home']['id']):
		echo 'Me';		
		elseif($share['Share']['type'] != 'T'):
		echo ucwords($share['Home']['first_name'].' '.$share['Home']['last_name']);
		endif;
		?></a>
																</div>
					<div class="text">
					
		<?php if($share['Share']['type'] != 'S' && $share['Share']['type'] != 'T'): ?>
		<p style="margin-bottom:5px">
		
		Dear 		<a href="<?php echo $this->webroot;?>home/overlay_info/<?php echo $share['Home']['id'];?>/share/" style="font-weight:bold" class="iframeBox" val="50_70">		
<?php echo ucwords($share['Home']['first_name'].' '.$share['Home']['last_name']);?></a> </p>
		<?php elseif($share['Share']['type'] == 'T'):?>
		<span style="color:#438EB9;font-size:15px;"> Thought for the Day! </span>
		<?php if(strtotime(date('Y-m-d')) <= strtotime('2014-09-05')):?><span id="new_f"><img  src="<?php echo $this->webroot;?>img/new.gif"></span><?php endif; ?>
		<?php endif; ?>
							
					<?php $chk_br =  substr($share['Share']['share'],strlen($share['Share']['share'])-4, 4) ;
					if($chk_br == '<br>'):
					echo substr($share['Share']['share'],0, strlen($share['Share']['share'])-4);
					else:
					echo $share['Share']['share'];
					endif; 
					?>
					
						<span class="widget-toolbar no-border" style="color:#4383b4;line-height:normal">
																	<i class="icon-time bigger-110"></i>
																	<?php				
								echo $this->Functions->time_diff($share['Share']['created_date']);?> 
																</span>
				
					
		<?php
		if($share['Share']['type'] == 'T'):
		$folder = 'thought';
		elseif($share['Share']['type'] == 'N'):
		$folder = 'greeting';
		else:
		$folder = 'share';
		endif;
		
		$height = 350;
		if(!empty($share['Share']['attachment'])):	
			$img_size = getimagesize('uploads/'.$folder.'/'.$share['Share']['attachment']);
			if($img_size[1] < 350):
			$height = $img_size[1];
			endif;
		endif;
		 
	
				if($this->Functions->show_attachment($share['Share']['attachment']) == 'img'):?>
							<div style="margin-top:10px"><a href="<?php echo $this->webroot;?>uploads/<?php echo $folder ;?>/<?php echo $share['Share']['attachment'];?>"  class="cboxElement colorbox2">
							<img style="border:1px solid #efefef;padding:2px" src="<?php echo $this->webroot;?>timthumb.php?src=uploads/<?php echo $folder ;?>/<?php echo $share['Share']['attachment'];?>&h=<?php echo $height; ?>&q=100"/></a></div>
						<?php elseif($this->Functions->show_attachment($share['Share']['attachment']) == 'noimg'): ?>
						<div style="margin-top:10px"><a href="<?php echo $this->webroot;?>home/download_share/<?php echo $share['Share']['attachment']; ?>" data-original-title="Download" data-placement="top"   title="Download" class="btn btn-sm btn-light show-tip click_hide"><i class="icon-download-alt"></i> <?php echo $share['Share']['attachment']; ?></a></div>
				    <?php endif; ?>
					
					
				<?php if($share['Share']['type'] != 'S'  && $share['Home']['photo_status'] == 'A'  && $share['Home']['photo'] != '' && $share['Share']['type'] != 'T'):?>
				<div style="margin-top:10px"><a href="<?php echo $this->webroot;?>uploads/photo/<?php echo $share['Home']['photo'];?>"  class="cboxElement colorbox2">
				<img style="border:1px solid #efefef;padding:2px" src="<?php echo $this->webroot;?>timthumb.php?src=uploads/photo/<?php echo $share['Home']['photo'];?>&h=150&q=100"/></a></div>									
				<?php endif; ?>
					
				
				
																
																</div>
																
<?php if($this->Session->read('USER.Login.id') != $share['Home']['id']): ?>				
				<div style="margin-top:8px;clear:left">
<i class="icon-share"></i> <a href="javascript:void(0)" class="replytoggle">Reply</a>	

<div>
<input style="margin-top:10px;width:60%" cls="<?php echo $share['Share']['type']; ?>" rel="<?php echo $share['Share']['app_users_id']; ?>" placeholder="Enter reply here...  Hit Enter to save.."  type="text" class="form-control shareReplyBx dn shareReply"  val="<?php echo $share['Share']['id']; ?>">

</div>
	</div>
<?php endif; ?>


					
															
																
		

		
	</div>
														
								
									<div id="replyDiv_<?php echo $sid;?>"></div>
									
									

									<?php foreach($share_reply as $share): ?>
														
							
							
															<?php if($share['Share']['reply_id'] != '' && $share['Share']['reply_id'] == $sid):?>
															<div class="replydelDiv_<?php echo $sid;?>">
															<div class="itemdiv dialogdiv" style="min-height:33px;margin-left:50px;top:15px;">
															<div class="user">
					<?php if($share['Home']['photo'] != ''  && $share['Home']['photo_status'] == 'A'):?>
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
<input style="margin-top:10px;width:60%" cls="<?php echo $share['Share']['type']; ?>"  rel="<?php echo $share['Share']['app_users_id']; ?>" placeholder="Enter reply here...  Hit Enter to save.."  type="text" class="form-control shareReplyBx dn shareReply"  val="<?php echo $share['Share']['reply_id']; ?>">

</div>
	</div>
<?php endif; ?>

															
																
															</div>
															
															</div>
														</div>
														
														
														<?php  endif;  endforeach;?>	
															
														</div>
														
													
														
														<?php endif;?>
														
														
														
														
														
														<?php $i++; if($i == 6): $i = 1; endif;
														endforeach; ?>
														
														
