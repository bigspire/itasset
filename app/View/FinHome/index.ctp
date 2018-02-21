
	<?php echo $this->element('fin_menu'); ?>
	
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
							<a href="<?php echo $this->webroot;?>finhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						<li>
							<a href="#">Dashboard</a>
						</li>
					</ul>
					
					
											
				</div>
				
				<?php echo $this->Session->flash();?>
				
				
				<?php if($advance_menu == '1' || $expense_menu == '1' ):?>
				
					<div class="span6 noLeft" >
						<div class="box  box-bordered">
							<div class="box-title">
								<h3><i class="icon-edit"></i>My Recent Requests</h3>
								<div class="actions">								
										<?php if(count($adv_data) > 0 || count($exp_data) > '0'):?>
										<a href="<?php echo $this->webroot;?>finadvance/">Show All</a>  
										<?php endif; ?>
								</div>
							</div>
							<div class="box-content  <?php echo $this->Functions->show_scroll($adv_data, $exp_data, '',  2);?>"  data-start ="top" data-height="180" data-visible="true">
								<ul class="messages">
								
								<?php if(count($adv_data) == '0' && count($exp_data) == '0'):?>
								<div id="flashMessage" class="alert alert">You have no requests <a href="<?php echo $this->webroot;?>finadvance/create_advance/">Click Here</a> to create!</div>
								<?php endif; ?>
									
								<?php foreach($adv_data as $adv):?>
								
									
									<li class="left">
										
										
										
										<div class="message new_msg">
											
											<span class="time">
												 <?php echo $this->Functions->time_diff($adv['FinAdvance']['created_date']);?>,   
											</span>
											<p class="statusTag">
											Advance: <a href="<?php echo $this->webroot;?>finadvance/view_advance/<?php echo $adv['FinAdvance']['id'];?>/"><?php echo $this->Functions->string_truncate($adv['FinAdvance']['purpose'], 50);?></a>
											</p>
											
										
											
										</div>
										
									</li>
										
								<?php endforeach; ?>	
								
									
								<?php foreach($exp_data as $exp):?>
								
									
									<li class="left">
										
										
										
										<div class="message new_msg">
											
											<span class="time">
												 <?php echo $this->Functions->time_diff($exp['FinExpense']['created_date']);?>,   
											</span>
											<p class="statusTag">
											Expense: <a href="<?php echo $this->webroot;?>finexpense/view_expense/<?php echo $exp['FinExpense']['id'];?>/"><?php
											echo $exp['TskCustomer']['company_name'].', '.$exp['TskProject']['project_name']?></a>
											</p>
											
										
											
										</div>
										
									</li>
										
								<?php endforeach; ?>	
									
									
									
									
									
								</ul>
							</div>
						</div>
					</div>
					
					<?php endif; ?>
					
					<?php if($approve_advance_menu == '1' || $approve_expense_menu == '1' ): $left = 'noLeft';?>
					<div class="span6">
						<div class="box  box-bordered">
							<div class="box-title">
								<h3><i class="icon-edit"></i>Approve Requests</h3>
								<div class="actions">
									<?php  if(count($approve_data) > 0 || count($exp_approve_data) > 0):?>
									<a href="<?php echo $this->webroot;?>finadvapprove/">Show All</a> 
									<?php endif; ?>
								</div>
							</div>
							<div class="box-content nopadding <?php echo $this->Functions->show_scroll($approve_data, $exp_approve_data, '',  2);?>" data-start ="top" data-height="180" data-visible="true">
								<ul class="messages">
									
									
									<?php if(count($approve_data) == 0 && count($exp_approve_data) == 0):?>
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
												 <?php echo $this->Functions->time_diff($app_data['FinAdvApprove']['created_date']);?>,   
											</span>
											<p class="statusTag">
											Advance: <a href="<?php echo $this->webroot;?>finadvapprove/view_advance/<?php echo $app_data['FinAdvApprove']['id'];?>/<?php echo $app_data['FinAdvStatus']['id'];?>/<?php echo $app_data['Home']['id'];?>"><?php echo $this->Functions->string_truncate($app_data['FinAdvApprove']['purpose'],50);?></a>
											</p>
											
										
											
										</div>
										
									</li>
										
								<?php endforeach; ?>	
								
								
								
								<?php foreach($exp_approve_data as $app_data):?>
								
									
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
												 <?php echo $this->Functions->time_diff($app_data['FinExpApprove']['created_date']);?>,   
											</span>
											<p class="statusTag">
											Expense: <a href="<?php echo $this->webroot;?>finexpapprove/view_expense/<?php echo $app_data['FinExpApprove']['id'];?>/<?php echo $app_data['Home']['id'];?>/<?php echo $app_data['FinExpStatus']['id'];?>/"><?php echo $app_data['TskCustomer']['company_name']. ', '. $app_data['TskProject']['project_name'];?></a>
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
								<h3><i class="icon-inbox"></i>My Inbox</h3>
								<div class="actions">
									<!--a href="#" class="btn btn-mini content-refresh"><i class="icon-refresh"></i></a>
									<a href="#" class="btn btn-mini content-remove"><i class="icon-remove"></i></a-->
									<!--a href="#" class="btn btn-mini content-slideUp"><i class="icon-angle-down"></i></a-->
								</div>
							</div>
								<div class="box-content nopadding no_scroll" data-start ="top" data-height="180" data-visible="true">
								<ul class="messages">
									

									
								<div id="flashMessage" class="alert alert">You have no messages </div>
							
								
								
									<!--li class="left">
										<div class="image">
											<img src="<?php echo $this->webroot;?>img/demo/user-2.jpg" alt="">
										</div>
										<div class="message">
											<span class="caret"></span>
											<span class="name">Padhu, </span> <span class="time">
												12 minutes ago
											</span>
											<p><a href="#">Bill submission reminder for your expense submission of Rs. 20000</a> </p>
											
										</div>
									</li-->
									
									
								</ul>
							</div>
						</div>
					</div>
					
					<div class="span6 <?php echo $noleft; ?>">
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
					
				
		
			
			</div>
			
			
		</div>
		</div>
		
		