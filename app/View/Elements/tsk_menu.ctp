<div id="navigation">
		<div class="container-fluid">
			<!--a href="<?php echo $this->webroot;?>tskhome/" id="brand">CEO Finance</a-->
			
			<ul class='main-nav'>
			
			<li class="dropdown" >
					<a href="<?php echo $this->webroot;?>tskhome/" style="font-size:20px" data-toggle="dropdown" class='dropdown-toggle'>
						<span>Work Planner</span>					
						
					</a>
					<ul class="dropdown-menu" style="left:0">
						<li>
							<a href="<?php echo $this->webroot;?>home/">Home</a>
						</li>
						<li>
							<a href="<?php echo $this->webroot;?>hrhome/" class="">HRIS</a>
							
						</li>
						<li>
							<a href="<?php echo $this->webroot;?>finhome/" class="">Finance</a>
						</li>
						<li>
							<a href="<?php echo $this->webroot;?>tvlhome/" class="">Biz Tour</a>
						</li>
						
						<?php if($bd_business_menu):?>
						<li>
							<a href="<?php echo $this->webroot;?>bdhome/?type=N" class="">BD</a>
						</li>
						<?php endif; ?>
						
						<?php 
						if($this->Session->read('USER.Login.app_roles_id') == '21'):?>
							<li>
							<a href="<?php echo $this->webroot;?>it/" class="">IT</a>
						</li>	
						<?php endif; ?>
					</ul>
				</li>
				
				
				
				<li class="<?php echo $tskhome_menu;?>">
					<a href="<?php echo $this->webroot;?>tskhome/">
						<span>Dashboard</span>
					</a>
				</li>
				<li class="dropdown <?php echo $tskplan_menu;?> <?php echo $tskteamplan_menu;?>" >
					<a href="#" data-toggle="dropdown" class='dropdown-toggle'>
						<span>Plan Tasks</span>
						<span class="caret"></span> 
						<?php if($TSK_PLAN_COUNT > 0): ?>
							<span class="label label bubble plan_count"><?php echo $TSK_PLAN_COUNT; ?></span>
							<?php endif; ?>	
						
					</a>
					<ul class="dropdown-menu">
					
						
					
					<?php if($tsk_plan_menu == '1'):?>	
					
					<li class='dropdown-submenu'>
							<a  href="#">My Tasks
							<?php if($MY_PLAN_COUNT > 0): ?>
								<span class="label label bubble myplan_count"><?php echo $MY_PLAN_COUNT; ?></span>
							<?php endif; ?>	
							
						
							
							</a>
							<ul class="dropdown-menu">
								<li>
									<a href="<?php echo $this->webroot;?>tskplan/?type=D">Daily Task</a>
								</li>
								<li>
									<a href="<?php echo $this->webroot;?>tskplan/?type=P">Project Task</a>
								</li>
							</ul>
						</li>
					<?php endif; ?>	
					
					
					<?php if($tsk_teamplan_menu == '1'):?>
					<li class='dropdown-submenu'>
							
							<a href="#">My Team's Tasks  
								<?php if($TEAM_PLAN_COUNT > 0): ?>
							<span class="label label bubble tmplan_count"><?php echo $TEAM_PLAN_COUNT; ?></span>
							<?php endif; ?>	
							
							</a>
							
							<ul class="dropdown-menu">
								<li>
									<a class="" href="<?php echo $this->webroot;?>tskteamplan/?type=D">Daily Task</a>
								</li>
								<li>
									<a href="<?php echo $this->webroot;?>tskteamplan/?type=P">Project Task</a>
								</li>
							</ul>
					
							
						</li>
					<?php endif; ?>
					
						
					</ul>
				</li>
				<li class="dropdown <?php echo $tskassign_menu;?> <?php echo $tskteamassign_menu;?>">
					<a href="#" data-toggle="dropdown" class='dropdown-toggle'>
						<span>Assigned Tasks</span>
						<span class="caret"></span>
						<?php if($TSK_ASSIGN_COUNT > 0): ?>
							<span class="label label bubble assign_task_count"><?php echo $TSK_ASSIGN_COUNT; ?></span>
							<?php endif; ?>	
					</a>
					<ul class="dropdown-menu">
					
					<?php if($tsk_team_assign_menu == '1'):?>		
								<li class="dropdown-submenu">
									<a href="#">Assigned by Me
									<?php if($TM_TSK_COUNT > 0): ?>
							<span class="label label bubble tm_assign_task_count"><?php echo $TM_TSK_COUNT; ?></span>
							<?php endif; ?>	
							</a>
								<ul class="dropdown-menu">
								<li>
									<a href="<?php echo $this->webroot;?>tskteamassign/?type=D">Daily Task</a>
								</li>
								<li>
									<a href="<?php echo $this->webroot;?>tskteamassign/?type=P">Project Task</a>
								</li>
							</ul>
							
								</li>
								
						<?php endif; ?>
						
						
						<?php if($tsk_assign_menu == '1'):?>		
								<li class="dropdown-submenu">
									<a href="#">Assigned to Me 
									<?php if($MY_TSK_COUNT > 0): ?>
							<span class="label label bubble my_assign_task_count"><?php echo $MY_TSK_COUNT; ?></span>
							<?php endif; ?>	</a>
							
							<ul class="dropdown-menu">
								<li>
									<a href="<?php echo $this->webroot;?>tskassign/?type=D">Daily Task</a>
								</li>
								<li>
									<a href="<?php echo $this->webroot;?>tskassign/?type=P">Project Task</a>
								</li>
							</ul>
								</li>
								
						<?php endif; ?>
						
						
						
						
						
						
					</ul>
				</li>
				
				
				
				<?php if($tsk_project_req_menu == '1'):?>	
				
				<li class="dropdown <?php echo $tskprojectrequest_menu;?>">
					<a href="#" data-toggle="dropdown" class='dropdown-toggle'>
						<span>Project Req.</span>
						<span class="caret"></span>
						<?php if($TSK_PROJ_REQ_COUNT > 0): ?>
							<span class="label label-lightred bubble"><?php echo $TSK_PROJ_REQ_COUNT; ?></span>
							<?php  endif; ?>
					</a>
					<ul class="dropdown-menu">
					<?php if($tsk_project_req_menu == '1'):?>	
						<li>
							<a href="<?php echo $this->webroot;?>tskprojectrequest/">Approve Project Request						
							
							<?php if($TSK_PROJ_REQ_COUNT > 0): ?>
							<span class="label label-lightred bubble"><?php echo $TSK_PROJ_REQ_COUNT; ?></span>
							<?php endif; ?></a>
							
						</li>
						<?php endif; ?>
						
						
						
					</ul>
				</li>
				<?php endif; ?>
				
				<?php if($tsk_event_menu == '1'):?>	
				
				<li class="dropdown <?php echo $tskevent_menu;?>">
					<a href="#" data-toggle="dropdown" class='dropdown-toggle'>
						<span>Events</span>
						<span class="caret"></span>
						
					</a>
					<ul class="dropdown-menu">
					<?php if($tsk_event_menu == '1'):?>	
						<li>
							<a href="<?php echo $this->webroot;?>tskevent/">My Events</a>
						</li>
						<?php endif; ?>
						
						
						
					</ul>
				</li>
				<?php endif; ?>
				
				
				<?php if($tsk_file_menu == '1'):?>	
				
				<li class="dropdown <?php echo $tskfile_menu;?>">
					<a href="#" data-toggle="dropdown" class='dropdown-toggle'>
						<span>Files</span>
						<span class="caret"></span>
						<?php if($TSK_FILE_COUNT > 0): ?>
							<span class="label label-lightred bubble"><?php echo $TSK_FILE_COUNT; ?></span>
							<?php  endif; ?>	
					</a>
					<ul class="dropdown-menu">
					<?php if($tsk_file_menu == '1'):?>	
						<li>
							<a href="<?php echo $this->webroot;?>tskfile/">My Files
							<?php if($TSK_FILE_COUNT > 0): ?>
							<span class="label label-lightred bubble"><?php echo $TSK_FILE_COUNT; ?></span>
							<?php endif; ?></a>
						</li>
						<?php endif; ?>
						
						
						
					</ul>
				</li>
				<?php endif; ?>
				
				
				<?php if($tsk_roa == '1' || $tsk_roa_approve == '1' || $tsk_roa_history == '1'|| $tsk_roa_committe == '1'|| $tsk_roa_rewards == '1'):?>	
				
				<li class="dropdown <?php echo $tskroa_menu;?> <?php echo $tskroaapprove_menu;?> <?php echo $tskroacommittee_menu; ?> <?php echo $tskroareward_menu;?> <?php echo $tskroahistory_menu;?>" >
					<a title="Round of Applause" href="#" data-toggle="dropdown" class='dropdown-toggle'>
						<span>ROA</span>
						<span class="caret"></span>
						<?php if($TSK_ROA_COUNT > 0): ?>
							<span class="label label-lightred bubble"><?php echo $TSK_ROA_COUNT; ?></span>
							<?php  endif; ?>						
					</a>
					<ul class="dropdown-menu">
					<?php if($tsk_roa == '1'):?>	
						<li>
							<a href="<?php echo $this->webroot;?>tskroa/" title="My Round of Applause">My ROA</a>
						</li>
						<?php endif; ?>
					<?php if($tsk_roa_approve == '1'):?>	
						<li>
							<a href="<?php echo $this->webroot;?>tskroaapprove/" title="Approve Round of Applause">Approve ROA
							<?php if($TSK_ROA_COUNT > 0): ?>
							<span class="label label-lightred bubble"><?php echo $TSK_ROA_COUNT; ?></span>
							<?php endif; ?></a>
							</a>
						</li>
						<?php endif; ?>
							
							<?php if($tsk_roa_history == '1'):?>	
						<li>
							<a href="<?php echo $this->webroot;?>tskroahistory/">ROA History</a>
						</li>
						<?php endif; ?>
						
							<?php if($tsk_roa_committe == '1'):?>	
						<li>
							<a href="<?php echo $this->webroot;?>tskroacommittee/">ROA Committee</a>
						</li>
						<?php endif; ?>
						
						
						<?php if($tsk_roa_rewards == '1'):?>	
						<li>
							<a href="<?php echo $this->webroot;?>tskroareward/">Gifts & Rewards</a>
						</li>
						<?php endif; ?>
						
					</ul>
				</li>
				<?php endif; ?>
				
					<?php if($tsk_report_indiv == '1' || $hr_report_company == '1'):?>	
				
				<li class="dropdown <?php echo $tskreport_menu;?>">
					<a href="#" data-toggle="dropdown" class='dropdown-toggle'>
						<span>Reports</span>
						<span class="caret"></span>	
					</a>
					<ul class="dropdown-menu">
					<?php if($tsk_report_indiv == '1'):?>	
						<li>
							<a href="<?php echo $this->webroot;?>tskreport/individual/">Individual</a>
						</li>
						<?php endif; ?>
						<?php if($hr_report_company == '1'):?>	
						<li>
							<a href="<?php echo $this->webroot;?>tskreport/company/">Company</a>
						</li>
						<?php endif; ?>
						
						
					</ul>
				</li>
				<?php endif; ?>
				
				
			
			
			<?php if($tskrole_menu == '1' || $tsk_types_menu == '1' || $tskapprover_menu == '1' || $event_type_menu == '1'):?>	
				
				
				<li class="dropdown <?php echo $approve_menu;?> <?php echo $roles_menu;?> <?php echo $tskplantype_menu;?> <?php echo $tskeventtype_menu;?>">
					<a href="#" data-toggle="dropdown" class='dropdown-toggle'>
						<span>Settings</span>
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
				<?php if($tskrole_menu == '1'):?>						
						<li>
							<a href="<?php echo $this->webroot;?>roles/?mod=tsk">Role (Access Settings)</a>
						</li>
						<?php endif; ?>
						
						<?php if($tskapprover_menu == '1'):?>	
						<li>
							<a href="<?php echo $this->webroot;?>approve/?type=task">Task Approver</a>
						</li>
						<?php endif; ?>
						
						<?php if($tsk_types_menu == '1'):?>	
						<li>
							<a href="<?php echo $this->webroot;?>tskplantype/">Task Type</a>
						</li>
						<?php endif; ?>
						
						
						<?php if($event_type_menu == '1'):?>	
						<li>
							<a href="<?php echo $this->webroot;?>tskeventtype/">Event Type</a>
						</li>
						<?php endif; ?>
						
					</ul>
				</li>
			<?php endif; ?>	
			
				
			</ul>
			<div class="user" style="">
				<ul class="icon-nav">
							<!--li class='dropdown language-select'>
						<a href="#" class='dropdown-toggle' data-toggle="dropdown"><img src="<?php echo $this->webroot;?>img/demo/flags/us.gif" alt=""><span>All Companies</span></a>
						<ul class="dropdown-menu pull-right">
							<li>
					<a href="#"><img src="<?php echo $this->webroot;?>img/demo/flags/br.gif" alt=""><span>CEO Talent Search</span></a>
							</li>
							<li>
					<a href="#"><img src="<?php echo $this->webroot;?>img/demo/flags/de.gif" alt=""><span>Jobsfactory</span></a>
							</li>
							
						</ul>
					</li-->
					
					<!--li class='dropdown'>
						<a href="#" class='dropdown-toggle' data-toggle="dropdown">
						<i class="icon-envelope"></i> Alerts<!--span class="label label-lightred">3</span></a-->
						<!--ul class="dropdown-menu pull-right message-ul">
							<li>
								<a href="#">
									<img src="<?php echo $this->webroot;?>img/demo/user-1.jpg" alt="">
									<div class="details">
										<div class="name">Padhu</div>
										<div class="message">
											Bill submission reminder...
										</div>
									</div>
								</a>
							</li>
							<li>
								<a href="#">
									<img src="<?php echo $this->webroot;?>img/demo/user-2.jpg" alt="">
									<div class="details">
										<div class="name">Kavia</div>
										<div class="message">
											Bill submission reminder...
										</div>
									</div>
									
								</a>
							</li>
							<li>
								<a href="#">
									<img src="<?php echo $this->webroot;?>img/demo/user-3.jpg" alt="">
								<div class="details">
										<div class="name">Padhu</div>
										<div class="message">
											Bill submission reminder...
										</div>
									</div>
								</a>
							</li>
							<li>
								<a href="#" class='more-messages'>Go to Message center <i class="icon-arrow-right"></i></a>
							</li>
						</ul>
					</li-->
					
					<!--li class='dropdown colo'>
						<a href="#" class='dropdown-toggle' data-toggle="dropdown"><i class="icon-star"></i></a>
						<ul class="dropdown-menu pull-right theme-colors">
							<li class="subtitle">
								Predefined colors
							</li>
							<li>
								
								<span class='green'></span>
								<span class="blue"></span>
								<span class="teal"></span>
								<span class="darkblue"></span>
								<span class="lightred"></span>
								<span class="pink"></span>
								<span class="satblue"></span>
								<span class="satgreen"></span>
							</li>
						</ul>
					</li-->
				
			<li class="dropdown language-select">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-reply"></i><span>Switch Module 
						<span class="switchLoad"></span>
						<span class="label label-lightred bubble switchPre switchTot" id="total_count" style="top:14px; right:12px "></span></span></a>
						<ul class="dropdown-menu pull-right">
							<li>
								<a href="<?php echo $this->webroot;?>home/"><i class="icon-home"></i><span>Home</span></a>
							</li>
							
							<li>
								<a href="<?php echo $this->webroot;?>hrhome/" class=""><i class="icon-user"></i><span>HRIS
								<span class="switchLoad-sub"></span></span>
								<span class="label label-lightred bubble switchTour switchPre"  id="hr_count"></span>
								</a>
							</li>
							<li>
								<a href="<?php echo $this->webroot;?>finhome/" class=""><i class="icon-money"></i><span>Finance
								<span class="switchLoad-sub"></span></span>
								<span class="label label-lightred bubble switchFin switchPre"  id="fin_count"></span></a>
							</li>
						<li>
								<a href="<?php echo $this->webroot;?>tvlhome/" class=""><i class="icon-plane"></i><span>Biz Tour
								<span class="switchLoad-sub"></span></span>
								<span class="label label-lightred bubble switchTour switchPre"  id="tour_count"></span></a>
							</li>
							<?php if($bd_business_menu):?>
							<li>
								<a href="<?php echo $this->webroot;?>bdhome/?type=N" class=""><i class="icon-lightbulb"></i><span>BD
								<span class=""></span></span>
								<span class="label label-lightred bubble switchTour switchPre" id="bd_menu_count"></span></a>
							</li>
							<?php endif; ?>
							
							<?php 
						if($this->Session->read('USER.Login.app_roles_id') == '21'):?>
							<li>
								<a href="<?php echo $this->webroot;?>it/" class=""><i class="icon-lightbulb"></i><span>IT
								<span class=""></span></span>
								<span class="label label-lightred bubble switchTour switchPre" id="it_menu_count"></span></a>
							</li>	
						<?php endif; ?>
						</ul>
					</li>
			
				
				<li class='dropdown language-select'>
						<a href="#" class='dropdown-toggle' data-toggle="dropdown"><span><i class="icon-signin"></i> <?php echo ucfirst($this->Session->read('USER.Login.first_name')); ?> <?php // echo $this->Session->read('USER.Login.email_address'); ?></span></a>
							<ul class="dropdown-menu pull-right">
						<!--li>
							<a href="#">Edit profile</a>
						</li>
						<li>
							<a href="#">Account settings</a>
						</li-->
						<li>
							<a href="<?php echo $this->webroot;?>logins/logout/">Sign out</a>
						</li>
					</ul>
					</li>
					</ul>	
			</div>
		</div>
	</div>
		<input type="hidden" class="actionCount"/>
			<input type="hidden" value="<?php echo $this->webroot;?>" id="site_root"/>	
