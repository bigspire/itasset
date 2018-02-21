
	<?php echo $this->element('tsk_menu'); ?>
	
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Dashboard</h1>
					</div>
					
				</div>
				<div class="breadcrumbs" style="width:88%">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>tskhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						<li>
							<a href="#">Dashboard</a>
						</li>
					</ul>
					
					
											
				</div>
				
				<?php echo $this->Session->flash();?>
				
				
				<?php if($tsk_plan_menu == '1' || $tsk_assign_menu == '1'):?>
				
					<div class="span6 noLeft" >
						<div class="box  box-bordered">
							<div class="box-title">
								<h3><i class="icon-edit blue"></i>My Tasks</h3>
								<div class="actions">								
										<?php if(count($tsk_data) > 0 || count($tsk_assign) > 0):?>
										<a href="<?php echo $this->webroot;?>tskplan/">Show All</a>  
										<?php endif; ?>
								</div>
							</div>
							<div class="box-content <?php echo $this->Functions->show_scroll($tsk_data, $tsk_assign, '', 3);?>"  data-start ="top" data-height="180" data-visible="true" style="">
								<ul class="messages">
								
								<?php if(count($tsk_data) == '0' && count($tsk_assign) == '0'):?>
								<div id="flashMessage" class="alert alert">You have no tasks <a href="<?php echo $this->webroot;?>tskplan/">Click Here</a> to create!</div>
								<?php endif; ?>
									
								<?php foreach($tsk_data as $tsk):?>
								
									
									<li class="left" style="margin-top:10px">
										
										
										
										<div class="message new_msg" style="margin-right:1px;">
											
											
											<p class="statusTag">
											My Tasks: <a href="<?php echo $this->webroot;?>tskplan/?type=<?php echo $tsk['TskPlan']['type'];?>&date=<?php echo $this->Functions->get_task_date($tsk['TskPlan']['start']); ?>"><?php echo $this->Functions->string_truncate($tsk['TskPlan']['title'], 50);?></a>, <?php echo $this->Functions->time_diff($tsk['TskPlan']['created_date']);?>
											 
											</p>
											
										
											
										</div>
										
									</li>
										
								<?php endforeach; ?>	
								
									
								<?php foreach($tsk_assign as $assign):?>
								
									
									<li class="left" style="margin-top:10px;">
										
										
										
										<div class="message new_msg" style="margin-right:1px;">
											
											
											<p class="statusTag">
											Assigned to Me: <a href="<?php echo $this->webroot;?>tskassign/?type=<?php echo $assign['TskAssign']['type'];?>&date=<?php echo $this->Functions->get_task_date($assign['TskAssign']['start']); ?>"><?php
											echo $assign['TskAssign']['title'];?></a>, <?php echo $this->Functions->time_diff($assign['TskAssign']['created_date']);?>
											</p>
											
										
											
										</div>
										
									</li>
										
								<?php endforeach; ?>	
									
									
									
									
									
								</ul>
							</div>
						</div>
					</div>
					
					<?php endif; ?>
					
					<?php if($tsk_teamplan_menu == '1' || $tsk_team_assign_menu == '1' ): $left = 'noLeft';?>
					<div class="span6">
						<div class="box  box-bordered">
							<div class="box-title">
								<h3><i class="icon-edit"></i>Team's Tasks</h3>
								<div class="actions">
									<?php  if(count($tsk_team_data) > 0 || count(tsk_team_assign) > 0):?>
									<a href="<?php echo $this->webroot;?>tskteamplan/">Show All</a> 
									<?php endif; ?>
								</div>
							</div>
							<div class="box-content nopadding <?php echo $this->Functions->show_scroll($tsk_team_data, $tsk_team_assign, '', 2);?>" data-start ="top" data-height="180" data-visible="true">
								<ul class="messages">
									
									
									<?php if(count($tsk_team_data) == 0 && count($tsk_team_assign) == 0):?>
								<div id="flashMessage" class="alert alert">You have no team tasks <a href="<?php echo $this->webroot;?>tskteamassign/">Click Here</a> to assign!</div>
								<?php endif; ?>
								
								
									<?php foreach($tsk_team_data as $team_plan):?>
								
									
									<li class="left">
										
										<div class="image">
						<?php if($team_plan['HrEmployee']['photo'] != '' && $team_plan['HrEmployee']['photo_status'] == 'A'):?>
							<img class="nav-user-photo" src="<?php echo $this->webroot;?>timthumb.php?src=uploads/photo/<?php echo $team_plan['HrEmployee']['photo'];?>&w=50&h=50&q=100"/>	
							<?php elseif($team_plan['HrEmployee']['gender'] == 'M'): ?>
						<img class="nav-user-photo" style="height:60px;width:60px" src="<?php echo $this->webroot;?>img/profile_male_s.jpg" alt=""/>
						
							<?php else: ?>
						<img class="nav-user-photo" style="height:60px;width:60px" src="<?php echo $this->webroot;?>img/profile_female_s.jpg" alt=""/>
							<?php endif; ?>
										</div>
										
																				
										<div class="message">
											<span class="name"><?php echo ucfirst($team_plan['HrEmployee']['first_name']).' '.ucfirst($team_plan['HrEmployee']['last_name']);?>, </span>
											
											<p class="statusTag">
											My Team's Task: <a href="<?php echo $this->webroot;?>tskteamplan/?type=<?php echo $team_plan['TskTeamPlan']['type'];?>&date=<?php echo $this->Functions->get_task_date($team_plan['TskTeamPlan']['start']); ?>"><?php echo $this->Functions->string_truncate($team_plan['TskTeamPlan']['title'],50);?></a>,
											  <?php echo $this->Functions->time_diff($team_plan['TskTeamPlan']['created_date']);?>
											</p>
											
										
											
										</div>
										
									</li>
										
								<?php endforeach; ?>	
								
								
								
								<?php foreach($tsk_team_assign as $team_assign):?>
								
									
									<li class="left">
										
										<div class="image">
						<?php if($team_assign['TskEmpAssign']['photo'] != '' && $team_assign['TskEmpAssign']['photo_status'] == 'A'):?>
							<img class="nav-user-photo" src="<?php echo $this->webroot;?>timthumb.php?src=uploads/photo/<?php echo $team_assign['TskEmpAssign']['photo'];?>&w=50&h=50&q=100"/>	
							<?php elseif($team_assign['TskEmpAssign']['gender'] == 'M'): ?>
						<img class="nav-user-photo" style="height:60px;width:60px" src="<?php echo $this->webroot;?>img/profile_male_s.jpg" alt=""/>
						
							<?php else: ?>
						<img class="nav-user-photo" style="height:60px;width:60px" src="<?php echo $this->webroot;?>img/profile_female_s.jpg" alt=""/>
						<?php endif; ?>
										</div>
										
																				
										<div class="message">
											<span class="name"><?php echo ucfirst($team_assign['TskEmpAssign']['first_name']).' '.ucfirst($team_assign['TskEmpAssign']['last_name']);?>, </span>
											<span class="time">
												 <?php echo $this->Functions->time_diff($team_assign['TskTeamAssign']['created_date']);?>,   
											</span>
											<p class="statusTag">
											Assigned by Me: <a href="<?php echo $this->webroot;?>tskteamassign/?type=<?php echo $team_assign['TskTeamAssign']['type'];?>&date=<?php echo $this->Functions->get_task_date($team_assign['TskTeamAssign']['start']); ?>"><?php echo $team_assign['TskTeamAssign']['title'];?></a>
											</p>
											
										
											
										</div>
										
									</li>
										
								<?php endforeach; ?>
								
									
									
								
									
								</ul>
							</div>
						</div>
					</div>
					
				<?php else:
				$noleft = 'noLeft';				
				endif; ?>
				
				
					<div class="span6 <?php echo $left;?>">
						<div class="box box-bordered">
							<div class="box-title">
								<h3><i class="icon-calendar"></i>My Events</h3>
									<div class="actions">
									<?php  if(count($event_data) > 0):?>
									<a href="<?php echo $this->webroot;?>tskevent/">Show All</a> 
									<?php endif; ?>
								</div>
							</div>
							<div class="box-content nopadding  <?php echo $this->Functions->show_scroll($event_data, '', '', 4);?>"  data-start ="top" data-height="170" data-visible="true">
								
								
					<?php if(count($event_data) == '0'):?>
								<ul class="messages">
								<div id="flashMessage" class="alert alert">You have no events <a href="<?php echo $this->webroot;?>tskevent/create_event/">Click Here</a> to create!</div>
								</ul>
								<?php endif; ?>
								
									<?php if(count($event_data) >  0):?>
								
								<ul class="tasklist">								
								
								<?php foreach($event_data as $event):?>	
									<li>
										<div class="check2">
											<?php echo $this->Functions->show_event_date($event['TskEvent']['start']);?>
										</div>
										<span class="task" style="left:155px"><span><a href="<?php echo $this->webroot;?>tskevent/view_event/<?php echo $event['TskEvent']['id'];?>/"><?php echo $event['TskEvent']['title'];?></a> <!--span class="badge <?php echo $this->Functions->set_tag_color($event['TskEvent']['event_type_id']);?>"><?php echo $event['TskEvent']['status'];?></span--></span> 
										</span>
									</li>
									<?php endforeach; ?>
								</ul>
								
								<?php endif; ?>
							</div>
						
						
						</div>
					</div>
					
					<div class="span6 <?php echo $noleft; ?>">
						<div class="box box-bordered">
							<div class="box-title">
								<h3><i class="icon-file"></i>My Files</h3>
								<div class="actions">
									<?php  if(count($file_data) > 0):?>
									<a href="<?php echo $this->webroot;?>tskfile/">Show All</a> 
									<?php endif; ?>
								</div>
							</div>
							
							
							<div class="box-content nopadding <?php echo $this->Functions->show_scroll($file_data, '', '', 4);?>" data-start ="top"  data-height="170" data-visible="true">
							

							<?php if(count($file_data) == '0'):?>
								<ul class="messages">
								<div id="flashMessage" class="alert alert">You have no files <a href="<?php echo $this->webroot;?>tskfile/create_file/">Click Here</a> to create!</div>
								</ul>
								<?php endif; ?>

						<?php if(count($file_data) > 0):?>		
							<ul class="tasklist">
							
								
								
								<?php foreach($file_data as $file):?>	
									<li>
										<div class="check" style="width:80px">
											<?php echo $this->Functions->format_date($file['TskFile']['created_date']); ?>
										</div>
											<div class="check2">
											<?php echo $file['HrEmployee']['first_name']; ?>
										</div>
										<span class="task" style="left:255px"><span><a href="<?php echo $this->webroot;?>tskfile/view_file/<?php echo $file['TskFile']['id'];?>/"><?php echo $file['TskFile']['title']; ?></a></span> 
										</span>
										
										
									</li>
									<?php endforeach; ?>
									
									
								</ul>
									
						<?php endif; ?>
				
							</div>
						</div>
					</div>
					
				
		
			
			</div>
			
			
		</div>
		</div>
		
		