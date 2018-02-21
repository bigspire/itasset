<div  id="memDiv" >	
<?php $j = 1;
foreach($member_data as  $user):?>

<?php if($ajax_req == 1):

$no_border = 'noBorder';
if($headerType == 'dept'):
$title = $user['HrDepartment']['dept_name'];
elseif($headerType == 'branch'):
$title = $user['HrBranch']['branch_name'];
elseif($headerType == 'bus_unit'):
$title = $user['HrBusinessUnit']['business_unit'];
else:
$no_border = '';
endif; 

$title2 = $title ; 
if($title1 != $title2):?>
<h5 class="header smaller red" style="clear:left;margin-top:0;"><?php  echo $j .'. '.$title;?>
</h5>
<?php $j++; endif; ?>
<?php else: 
$no_border = '';
 endif; ?>
				<div class="itemdiv memberdiv <?php echo $no_border;?>">
																
																
																<div class="user">
					<?php if($user['Home']['photo'] != ''  && $user['Home']['photo_status'] == 'A'):?>
							<img class="nav-user-photo" title="<?php echo $user['HrDesignation']['desig_name'];?>" src="<?php echo $this->webroot;?>timthumb.php?src=uploads/photo/<?php echo $user['Home']['photo'];?>&w=40&h=52&q=100"/>	
						<?php elseif($user['Home']['gender'] == 'M'): ?>
						<img class="nav-user-photo" title="<?php echo $user['HrDesignation']['desig_name'];?>" src="<?php echo $this->webroot;?>img/profile_male_s.jpg" alt=""/>
							<?php else: ?>
							<img class="nav-user-photo" title="<?php echo $user['HrDesignation']['desig_name'];?>" src="<?php echo $this->webroot;?>img/profile_female_s.jpg" alt=""/>
							<?php endif; ?>

							
																	</div>

																	
																	<div class="body">
																		<div class="name">
<a href="<?php echo $this->webroot;?>home/overlay_info/<?php echo $user['Home']['id'];?>/share/" class="iframeBox" val="50_70"><?php echo ucfirst($user['Home']['first_name']);?></a>

																			
																			
																		</div>

																		

																		<div>
																		
			<span class="mem_text <?php //echo $this->Functions->set_tag_color($user['HrDesignation']['id']);  ?>"><?php echo $user['HrBranch']['branch_name'];?></span>
																		</div>
																	</div>
																</div>
<?php
if($ajax_req == 1):
$title1 = $title;
endif; ?>
																<?php endforeach; ?>
																</div>