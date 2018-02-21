
	<?php echo $this->element('tvl_menu'); ?>
	
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
							<a href="<?php echo $this->webroot;?>tvlhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						<li>
							<a href="#">Dashboard</a>
						</li>
					</ul>
					
					
											
				</div>
				
				<?php echo $this->Session->flash();?>
				
				
				<?php if($tvl_req_menu == '1'):?>
				
					<div class="span6 noLeft" >
						<div class="box  box-bordered">
							<div class="box-title">
								<h3><i class="icon-edit blue"></i>Recent Travel</h3>
								<div class="actions">								
										<?php if(count($tvl_data) > 0 ||  count($tvl_cancel_data) > 0):?>
										<a href="<?php echo $this->webroot;?>tvlreq/">Show All</a>  
										<?php endif; ?>
								</div>
							</div>
							<div class="box-content <?php echo $this->Functions->show_scroll($tvl_data, $tvl_cancel_data, '', 2);?>"  data-start ="top" data-height="180" data-visible="true" style="">
								<ul class="messages">
								
								<?php if(count($tvl_data) == '0' && count($tvl_cancel_data) == '0'):?>
								<div id="flashMessage" class="alert alert">You have no recent travel requests <a href="<?php echo $this->webroot;?>tvlreq/add_request/journey/">Click Here</a> to create!</div>
								<?php endif; ?>
									
								<?php foreach($tvl_data as $tvl):?>
								
									
									<li class="left">
										
										
										
										<div class="message new_msg">
											
											<span class="time">
												 <?php echo $this->Functions->time_diff($tvl['TvlReq']['created_date']);?>,
											</span>
											<p class="statusTag">
											New Request: <a href="<?php echo $this->webroot;?>tvlreq/view_request/<?php echo $tvl['TvlReq']['id'];?>"><?php echo $this->Functions->string_truncate($tvl['TvlReq']['purpose'], 50);?></a>
											</p>
											
										
											
										</div>
										
									</li>
										
								<?php endforeach; ?>	
								
									
							<?php foreach($tvl_cancel_data as $tvl):?>
								
									
									<li class="left">
										
										
										
										<div class="message new_msg">
											
											<span class="time">
												 <?php echo $this->Functions->time_diff($tvl['TvlReq']['created_date']);?>,
											</span>
											<p class="statusTag">
											<span style="color:#FC8383"> Cancel Request: </span>  <a href="<?php echo $this->webroot;?>tvlcanreq/view_request/<?php echo $tvl['TvlReq']['id'];?>"><?php echo $this->Functions->string_truncate($tvl['TvlReq']['purpose'], 50);?></a>
											</p>
											
										
											
										</div>
										
									</li>
										
								<?php endforeach; ?>
									
									
									
									
								</ul>
							</div>
						</div>
					</div>
					
					<?php endif; ?>
					
					<?php if($tvl_apr_req_menu== '1' ): $left = 'noLeft';?>
					<div class="span6">
						<div class="box  box-bordered">
							<div class="box-title">
								<h3><i class="icon-edit"></i>Approve Travel</h3>
								<div class="actions">
									<?php   if(count($approve_data) > 0 || count($approve_cancel_data) > 0):?>
									<a href="<?php echo $this->webroot;?>tvlreqapr/">Show All</a> 
									<?php endif; ?>
								</div>
							</div>
							<div class="box-content nopadding <?php echo $this->Functions->show_scroll($approve_data, $approve_cancel_data, '', 2);?>" data-start ="top" data-height="180" data-visible="true">
								<ul class="messages">
									
									
									<?php if(count($approve_data) == 0 && count($approve_cancel_data) == 0):?>
								<div id="flashMessage" class="alert alert">You have no requests for approve</div>
								<?php endif; ?>
								
								
									<?php foreach($approve_data as $approve):?>
								
									
									<li class="left">
										
										<div class="image">
						<?php if($approve['HrEmployee']['photo'] != '' && $approve['HrEmployee']['photo_status'] == 'A'):?>
							<img class="nav-user-photo" src="<?php echo $this->webroot;?>timthumb.php?src=uploads/photo/<?php echo $approve['HrEmployee']['photo'];?>&w=50&h=50&q=100"/>	
							<?php elseif($approve['HrEmployee']['gender'] == 'M'): ?>
						<img class="nav-user-photo" style="height:60px;width:60px" src="<?php echo $this->webroot;?>img/profile_male_s.jpg" alt=""/>
						
							<?php else: ?>
						<img class="nav-user-photo" style="height:60px;width:60px" src="<?php echo $this->webroot;?>img/profile_female_s.jpg" alt=""/>
							<?php endif; ?>
										</div>
										
																				
										<div class="message">
											<span class="name"><?php echo ucfirst($approve['HrEmployee']['first_name']).' '.ucfirst($approve['HrEmployee']['last_name']);?>, </span>
											<span class="time">
												 <?php echo $this->Functions->time_diff($approve['TvlReqApr']['created_date']);?>,   
											</span>
											<p class="statusTag">
											 <a href="<?php echo $this->webroot;?>tvlreqapr/view_request/<?php echo $approve['TvlReqApr']['id'];?>/<?php echo $approve['TvlReqStatus']['id'];?>/<?php echo $approve['Home']['id'];?>"><?php echo $this->Functions->string_truncate($approve['TvlReqApr']['purpose'],50);?></a>
											</p>
											
										
											
										</div>
										
									</li>
										
								<?php endforeach; ?>	
								
						
						
									<?php foreach($approve_cancel_data as $approve):?>
								
									
									<li class="left">
										
										<div class="image">
						<?php if($approve['HrEmployee']['photo'] != '' && $approve['HrEmployee']['photo_status'] == 'A'):?>
							<img class="nav-user-photo" src="<?php echo $this->webroot;?>timthumb.php?src=uploads/photo/<?php echo $approve['HrEmployee']['photo'];?>&w=50&h=50&q=100"/>	
							<?php elseif($approve['HrEmployee']['gender'] == 'M'): ?>
						<img class="nav-user-photo" style="height:60px;width:60px" src="<?php echo $this->webroot;?>img/profile_male_s.jpg" alt=""/>
						
							<?php else: ?>
						<img class="nav-user-photo" style="height:60px;width:60px" src="<?php echo $this->webroot;?>img/profile_female_s.jpg" alt=""/>
							<?php endif; ?>
										</div>
										
																				
										<div class="message">
											<span class="name"><?php echo ucfirst($approve['HrEmployee']['first_name']).' '.ucfirst($approve['HrEmployee']['last_name']);?>, </span>
											<span class="time">
												 <?php echo $this->Functions->time_diff($approve['TvlCanApr']['created_date']);?>,   
											</span>
											<p class="statusTag">
											<span style="color:#FC8383"> Cancel Request: </span> <a href="<?php echo $this->webroot;?>tvlcanapr/view_request/<?php echo $approve['TvlCanApr']['id'];?>/<?php echo $approve['TvlReqStatus']['id'];?>/<?php echo $approve['Home']['id'];?>"><?php echo $this->Functions->string_truncate($approve['TvlCanApr']['purpose'],50);?></a>
											</p>
											
										
											
										</div>
										
									</li>
										
								<?php endforeach; ?>
						
						
									
								
									
								</ul>
							</div>
						</div>
					</div>
					
				<?php  else:
				$noleft = 'noLeft';				
				endif; ?>
				
				
				<?php if($tvl_ticket_menu== '1' ): ?>
					<div class="span6 <?php echo $left;?>">
						<div class="box  box-bordered">
							<div class="box-title">
								<h3><i class="icon-edit"></i>Priority Booking</h3>
								<div class="actions">
									<?php  if(count($booking_data) > 0):?>
									<a href="<?php echo $this->webroot;?>tvlbooktkt/">Show All</a> 
									<?php endif; ?>
								</div>
							</div>
							<div class="box-content nopadding <?php echo $this->Functions->show_scroll($booking_data, '', '', 2);?>" data-start ="top" data-height="180" data-visible="true">
								<ul class="messages">
									
									
									<?php if(count($booking_data) == 0):?>
								<div id="flashMessage" class="alert alert">You have no tickets to book</div>
								<?php endif; ?>
								
								
									<?php foreach($booking_data as $book):?>
								
									
									<li class="left">
										
										<div class="image">
						<?php if($book['HrEmployee']['photo'] != '' && $book['HrEmployee']['photo_status'] == 'A'):?>
							<img class="nav-user-photo" src="<?php echo $this->webroot;?>timthumb.php?src=uploads/photo/<?php echo $book['HrEmployee']['photo'];?>&w=50&h=50&q=100"/>	
							<?php elseif($book['HrEmployee']['gender'] == 'M'): ?>
						<img class="nav-user-photo" style="height:60px;width:60px" src="<?php echo $this->webroot;?>img/profile_male_s.jpg" alt=""/>
						
							<?php else: ?>
						<img class="nav-user-photo" style="height:60px;width:60px" src="<?php echo $this->webroot;?>img/profile_female_s.jpg" alt=""/>
							<?php endif; ?>
										</div>
										
																				
										<div class="message">
											<span class="name"><?php echo ucfirst($book['HrEmployee']['first_name']).' '.ucfirst($book['HrEmployee']['last_name']);?>, </span>
											<span class="time">
												 <?php echo $this->Functions->time_diff($book['TvlBookTkt']['created_date']);?>,   
											</span>
											<p class="statusTag">
											 <a href="<?php echo $this->webroot;?>tvlbooktkt/book_ticket/<?php echo $book['TvlBookTkt']['id'];?>/"><?php echo $this->Functions->string_truncate($book['TvlBookTkt']['purpose'],50);?></a>
											</p>
											
										
											
										</div>
										
									</li>
										
								<?php endforeach; ?>	
								
						
									
								
									
								</ul>
							</div>
						</div>
					</div>
					
				<?php  else:
				$noleft = 'noLeft';				
				endif; ?>
		
			
			</div>
			
			
		</div>
		</div>
		
		