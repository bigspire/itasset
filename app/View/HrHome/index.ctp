
	<?php echo $this->element('hr_menu'); ?>
	
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Dashboard</h1>
					</div>
					
				</div>
				<div class="breadcrumbs"  style="width:88%">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>hrhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						<li>
							<a href="#">Dashboard</a>
						</li>
					</ul>
					
					
											
				</div>
				
				<?php echo $this->Session->flash();?>
				
				
				<?php if($leave_menu == '1' || $permission_menu == '1' ):?>
				
					<div class="span6 noLeft" >
						<div class="box  box-bordered">
							<div class="box-title">
								<h3><i class="icon-edit"></i>My Recent Requests</h3>
								<div class="actions">								
										<?php if(count($leave_data) > 0 || count($perm_data) > '0' || count($gal_data) > '0'  ):?>
										<a href="<?php echo $this->webroot;?>hrleave/">Show All</a> 
										<?php endif; ?>
								</div>
							</div>
							<div class="box-content  <?php echo $this->Functions->show_scroll($leave_data, $perm_data, $gal_data,  2);?>"  data-start ="top" data-height="180" data-visible="true">
								<ul class="messages">
								
								<?php if(count($leave_data) == '0' && count($perm_data) == '0' && count($gal_data) == '0'):?>
								<div id="flashMessage" class="alert alert">You have no requests <a href="<?php echo $this->webroot;?>hrleave/create_leave/">Click Here</a> to create!</div>
								<?php endif; ?>
									
								<?php foreach($leave_data as $leave):?>
								
									
									<li class="left">
										
										
										
										<div class="message new_msg">
											
											<span class="time">
												 <?php echo $this->Functions->time_diff($leave['HrLeave']['created_date']);?>,   
											</span>
											<p class="statusTag">
											Leave: <a href="<?php echo $this->webroot;?>hrleave/view_leave/<?php echo $leave['HrLeave']['id'];?>/"><?php echo $this->Functions->string_truncate($leave['HrLeave']['reason'], 50);?></a>
											</p>
											
										
											
										</div>
										
									</li>
										
								<?php endforeach; ?>	
								
									
								<?php foreach($perm_data as $perm):?>
								
									
									<li class="left">
										
										
										
										<div class="message new_msg">
											
											<span class="time">
												 <?php echo $this->Functions->time_diff($perm['HrPermission']['created_date']);?>,   
											</span>
											<p class="statusTag">
											Permission: <a href="<?php echo $this->webroot;?>hrpermission/view_permission/<?php echo $perm['HrPermission']['id'];?>/"><?php echo $this->Functions->string_truncate($perm['HrPermission']['reason'], 50);?></a>
											</p>
											
										
											
										</div>
										
									</li>
										
								<?php endforeach; ?>	
									
									
									
										
								<?php foreach($gal_data as $gal):?>
								
									
									<li class="left">
										
										
										
										<div class="message new_msg">
											
											<span class="time">
												 <?php echo $this->Functions->time_diff($gal['HrGallery']['created_date']);?>,   
											</span>
											<p class="statusTag">
											Gallery: <a href="<?php echo $this->webroot;?>hrgallery/view_gallery/<?php echo $gal['HrGallery']['id'];?>/"><?php echo $this->Functions->string_truncate($gal['HrGallery']['title'], 50);?></a>
											</p>
											
										
											
										</div>
										
									</li>
										
								<?php endforeach; ?>	
									
									
									
								</ul>
							</div>
						</div>
					</div>
					
					<?php endif; ?>
					
					<?php if($approve_leave_menu == '1' || $approve_permission_menu == '1' ): $left = 'noLeft';?>
					<div class="span6">
						<div class="box  box-bordered">
							<div class="box-title">
								<h3><i class="icon-edit"></i>Approve Requests</h3>
								<div class="actions">
									<?php  if(count($approve_data) > 0 || count($per_approve_data) > 0):?>
									<a href="<?php echo $this->webroot;?>hrleaveapprove/">Show All</a> 
									<?php endif; ?>
								</div>
							</div>
							<div class="box-content nopadding  <?php echo $this->Functions->show_scroll($approve_data, $per_approve_data, '',  2);?>" data-start ="top" data-height="180" data-visible="true">
								<ul class="messages">
									
									
									<?php if(count($approve_data) == '0' && count($per_approve_data) == '0'):?>
								<div id="flashMessage" class="alert alert">You have no request for approval</div>
								<?php endif; ?>
								
								
									<?php foreach($approve_data as $app_data):?>
								
									
									<li class="left">
										
										<div class="image">
						<?php if($app_data['Home']['photo'] != '' && $app_data['Home']['photo_status'] == 'A'):?>
							<img class="nav-user-photo" src="<?php echo $this->webroot;?>timthumb.php?src=uploads/photo/<?php echo $app_data['Home']['photo'];?>&w=50&h=50&q=100"/>	
								<?php elseif($app_data['Home']['gender'] == 'M'): ?>
						<img class="nav-user-photo" style="height:60px;width:60px" src="<?php echo $this->webroot;?>img/profile_male_s.jpg" alt=""/>
						
							<?php else: ?>
						<img class="nav-user-photo" style="height:60px;width:60px" src="<?php echo $this->webroot;?>img/profile_female_s.jpg" alt=""/>
							<?php endif; ?>
										</div>
										
																				
										<div class="message">
											<span class="name"><?php echo ucfirst($app_data['Home']['first_name']).' '.ucfirst($app_data['Home']['last_name']);?>, </span>
											<span class="time">
												 <?php echo $this->Functions->time_diff($app_data['HrLeaveApprove']['created_date']);?>,   
											</span>
											<p class="statusTag">
											Leave: <a href="<?php echo $this->webroot;?>hrleaveapprove/view_leave/<?php echo $app_data['HrLeaveApprove']['id'];?>/<?php echo $app_data['HrLeaveStatus']['id'];?>/<?php echo $app_data['Home']['id'];?>"><?php echo $this->Functions->string_truncate($app_data['HrLeaveApprove']['reason'], 50);?></a>
											</p>
											
										
											
										</div>
										
									</li>
										
								<?php endforeach; ?>	
								
								
								
								<?php foreach($per_approve_data as $app_data):?>
								
									
									<li class="left">
										
										<div class="image">
				<?php if($app_data['Home']['photo'] != ''  && $app_data['Home']['photo_status'] == 'A'):?>
							<img class="nav-user-photo" src="<?php echo $this->webroot;?>timthumb.php?src=uploads/photo/<?php echo $app_data['Home']['photo'];?>&w=50&h=50&q=100"/>	
								<?php elseif($app_data['Home']['gender'] == 'M'): ?>
						<img class="nav-user-photo" style="height:60px;width:60px" src="<?php echo $this->webroot;?>img/profile_male_s.jpg" alt=""/>
						
							<?php else: ?>
						<img class="nav-user-photo" style="height:60px;width:60px" src="<?php echo $this->webroot;?>img/profile_female_s.jpg" alt=""/>
							<?php endif; ?>
										</div>
										
																				
										<div class="message">
											<span class="name"><?php echo ucfirst($app_data['Home']['first_name']).' '.ucfirst($app_data['Home']['last_name']);?>, </span>
											<span class="time">
												 <?php echo $this->Functions->time_diff($app_data['HrPerApprove']['created_date']);?>,   
											</span>
											<p class="statusTag">
											Permission: <a href="<?php echo $this->webroot;?>hrperapprove/view_permission/<?php echo $app_data['HrPerApprove']['id'];?>/<?php echo $app_data['HrPerStatus']['id'];?>/<?php echo $app_data['Home']['id'];?>/"><?php echo $this->Functions->string_truncate($app_data['HrPerApprove']['reason'], 50);?></a>
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
				
				
				<div class="span6 <?php echo $left; ?>">
						<div class="box box-bordered">
							<div class="box-title">
								<h3><i class="glyphicon-log_book"></i>My Recent Activity</h3>
								
							</div>
							
							
							<div class="box-content nopadding <?php echo $this->Functions->show_scroll($activity_data, '', '',  5);?>" data-height="180" data-visible="true">
								
								
								<table class="table table-nohead" id="randomFeed">
									<tbody>
									
								
									<?php if(count($activity_data) == '0'):?>
								<tr><td><div id="flashMessage" class="alert alert">You have no recent activities </div></td></tr>
								<?php endif; ?>
								
								
									<?php foreach($activity_data as $activity):?>
									
									<?php $result =  $this->Functions->get_activity($activity[0]['activity']); ?>
										<tr>
											<td><span class="label"><i class="icon-plus"></i></span> 
											<?php echo $this->Functions->time_diff($activity[0]['created']); ?>,  
											<a href="<?php echo $this->webroot;?><?php echo $this->Functions->get_activity_url($activity[0]['activity']);?><?php echo $activity[0]['id'];?>"><?php echo $result;?></a>
											</td>
										</tr>
									<?php endforeach; ?>
									</tbody>
								</table>
								
								
									
				
				
							</div>
						</div>
					</div>
					
				
				
			<?php if($this->Session->read('USER.Login.hr_department_id') == '14'): ?>
				<div class="span6 <?php echo $noleft;?>">
						<div class="box box-bordered">
							<div class="box-title">
								<h3><i class="icon-picture"></i>Approve Gallery</h3>
								<div class="actions">
									<?php  if(count($gal_approve_data) > 0):?>
									<a href="<?php echo $this->webroot;?>hrgalapprove/">Show All</a> 
									<?php endif; ?>
								</div>
								
							</div>
						<div class="box-content nopadding <?php echo $this->Functions->show_scroll($gal_approve_data, '', '',  2);?>" data-height="180"  data-visible="true" data-start="top">
								<ul class="messages">
								<?php if(count($gal_approve_data) == '0'):?>
									<div id="flashMessage" class="alert alert">You have no gallery for approval</div>
								<?php endif; ?>
								
								<?php foreach($gal_approve_data as $app_data):?>
								
									
									<li class="left">
										
										<div class="image">
				<?php if($app_data['Home']['photo'] != ''  && $app_data['Home']['photo_status'] == 'A'):?>
							<img class="nav-user-photo" src="<?php echo $this->webroot;?>timthumb.php?src=uploads/photo/<?php echo $app_data['Home']['photo'];?>&w=50&h=50&q=100"/>	
								<?php elseif($app_data['Home']['gender'] == 'M'): ?>
						<img class="nav-user-photo" style="height:60px;width:60px" src="<?php echo $this->webroot;?>img/profile_male_s.jpg" alt=""/>
						
							<?php else: ?>
						<img class="nav-user-photo" style="height:60px;width:60px" src="<?php echo $this->webroot;?>img/profile_female_s.jpg" alt=""/>
							<?php endif; ?>
										</div>
										
																				
										<div class="message">
											<span class="name"><?php echo ucfirst($app_data['Home']['first_name']).' '.ucfirst($app_data['Home']['last_name']);?>, </span>
											<span class="time">
												 <?php echo $this->Functions->time_diff($app_data['HrGalApprove']['created_date']);?>,   
											</span>
											<p class="statusTag">
											<a href="<?php echo $this->webroot;?>hrgalapprove/view_gallery/<?php echo $app_data['HrGalApprove']['id'];?>/<?php echo $app_data['HrGalStatus']['id'];?>/<?php echo $app_data['Home']['id'];?>/"><?php echo $this->Functions->string_truncate($app_data['HrGalApprove']['title'],50);?></a>
											</p>
											
										
											
										</div>
										
									</li>
										
								<?php endforeach; ?>
								
								
								</ul>
							</div>
							</div>
					</div>
				
			<?php endif; ?>	
				
				
					
					
					<!--div class="span6 <?php echo $noleft; ?>">
						<div class="box box-bordered">
							<div class="box-title">
								<h3><i class="icon-gift"></i>Performance</h3>
								<div class="actions">
									<?php  //if(count($approve_data) > 0 || count($exp_approve_data) > 0):?>
									<a href="#">Show All</a> 
									<?php //endif; ?>
								</div>
								
							</div>
						<div class="box-content nopadding scrollable" data-height="220"  data-visible="true" data-start="top">
								<ul class="messages">
								
									<div id="flashMessage" class="alert alert">You have no performance record for approval</div>
									<!--li class="left">
										<div class="image">
											<img src="<?php echo $this->webroot;?>img/demo/user-1.jpg" alt="">
										</div>
										<div class="message">
											<span class="caret"></span>
											<span class="name">Sheela</span>	<span class="label label-brown">Best Performer</span></span>
											<p><a href="#">For the month Mar, 2014</a>
											
												</p>
											<span class="time">
												45 minutes ago
											</span>
										</div>
									</li>
									<li class="left">
										<div class="image">
											<img src="<?php echo $this->webroot;?>img/demo/user-2.jpg" alt="">
										</div>
										<div class="message">
											<span class="caret"></span>
											<span class="name">Kathir</span>	<span class="label label-blue">Star of the Quarter</span>
											<p><a href="#">Jan 2014 to Mar 2014</a>
											
												</p>
											<span class="time">
												45 minutes ago
											</span>
										</div>
									</li>
									<li class="left">
										<div class="image">
											<img src="<?php echo $this->webroot;?>img/demo/user-1.jpg" alt="">
										</div>
										<div class="message">
											<span class="caret"></span>
											<span class="name">Priya</span> <span class="label label-purple">Spot Recognization</span>
											<p><a href="#">By Padhu for Kavia</a>
												
												</p>
											<span class="time">
												45 minutes ago
											</span>
										</div>
									</li>
								
								</ul>
							</div>
							</div>
					</div-->
				
				
				
			
			</div>
			
			
		</div>
		</div>
		
		