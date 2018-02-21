<div id="navigation">
		<div class="container-fluid">
			<!--a href="<?php echo $this->webroot;?>tskhome/" id="brand">CEO Finance</a-->
			
			<ul class='main-nav'>
			
			<li class="dropdown" >
					<a href="<?php echo $this->webroot;?>tskhome/" style="font-size:20px" data-toggle="dropdown" class='dropdown-toggle'>
						<span>BD</span>					
						
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
							<a href="<?php echo $this->webroot;?>tskhome/" class="">Work Planner</a>
						</li>
						
						<li>
							<a href="<?php echo $this->webroot;?>tvlhome/" class="">Biz Tour</a>
						</li>
						<?php 
						if($this->Session->read('USER.Login.app_roles_id') == '21'):?>
							<li>
							<a href="<?php echo $this->webroot;?>it/" class="">IT</a>
						</li>	
						<?php endif; ?>
						
					</ul>
				</li>
				
				
			<li class="dropdown <?php echo $bdhome_menu;?>">
					<a href="#"  data-toggle="dropdown" class='dropdown-toggle'>
						<span>Dashboard</span>
						<span class="caret"></span>
					</a>
							
					<ul class="dropdown-menu">
					
					<li class="dropdown-submenu">
							<a href="<?php echo $this->webroot;?>bdhome/?type=N">My Business</a>					
						
							
							
					<ul class="dropdown-menu">
						<li>
							<a href="<?php echo $this->webroot;?>bdhome/?type=N">New Business</a>
						</li>
						<li>
							<a href="<?php echo $this->webroot;?>bdhome/?type=E">Existing Business</a>
						</li>
						<li>
							<a href="<?php echo $this->webroot;?>bdhome/?type=O">Old Business</a>
						</li>
					</ul>	
					
					
				</li>
				
				</ul>	
					
					
				</li>
			
				<li class="dropdown <?php echo $bdbusiness_menu;?>">
					<a href="#" data-toggle="dropdown" class='dropdown-toggle'>
						<span>Business</span>
						<span class="caret"></span>
						<?php if($NEW_BIZ_APR_COUNT > 0): ?>
							<span class="label label-important bubble"><?php echo $NEW_BIZ_APR_COUNT; ?></span>
							<?php  endif; ?>
							
						<?php if($NEW_BIZ_COUNT > 0): ?>
							<span class="label label bubble bdCount"><?php echo $NEW_BIZ_COUNT; ?></span>
							<?php  endif; ?>
					</a>
					<ul class="dropdown-menu">
				
						<li class="dropdown-submenu">
							<a href="<?php echo $this->webroot;?>bdbusiness/?type=N">My Business						
						
							<?php if($NEW_BIZ_APR_COUNT > 0): ?>
							<span class="label label-important bubble"><?php echo $NEW_BIZ_APR_COUNT; ?></span>
							<?php endif; ?>
							
							<?php if($NEW_BIZ_COUNT > 0): ?>
							<span class="label label bubble bdCount"><?php echo $NEW_BIZ_COUNT; ?></span>
							<?php  endif; ?>
							
							</a>
							<ul class="dropdown-menu">
								<li>
									<a href="<?php echo $this->webroot;?>bdbusiness/?type=N">New Business</a>
								</li>
								<li>
									<a href="<?php echo $this->webroot;?>bdbusiness/?type=E">Existing Business</a>
								</li>
								<li>
									<a href="<?php echo $this->webroot;?>bdbusiness/?type=O">Old Business</a>
								</li>
							</ul>
							
						</li>
						
						
					</ul>
					
					
				</li>
				
				
				
				
				
				<?php if($bd_spoc_menu == '1' || $bd_admin_menu == '1' || $bd_roles_menu == '1'):?>	
				
				<li class="dropdown <?php echo $bdspoc_menu;?> <?php echo $roles_menu;?> <?php echo $bdadmin_menu?>">
					<a href="#" data-toggle="dropdown" class='dropdown-toggle'>
						<span>Settings</span>
						<span class="caret"></span>
						
					</a>
					<ul class="dropdown-menu">
					<?php if($bd_spoc_menu == '1'):?>	
						<li>
							<a href="<?php echo $this->webroot;?>bdspoc/">SPOC</a>
						</li>
						
						<?php endif; ?>
						
						<?php if($bd_admin_menu == '1'):?>	
						<li>
							<a href="<?php echo $this->webroot;?>bdadmin/">BD Admin</a>
						</li>
						<?php endif; ?>
						
						<?php if($bd_roles_menu == '1'):?>	
						<li>
							<a href="<?php echo $this->webroot;?>roles/?mod=bd">Roles</a>
						</li>
						<?php endif; ?>
						
					</ul>
				</li>
				<?php endif; ?>
				
					
				
				
				
				
				
				
				
				
				
			</ul>
			<div class="user" style="">
				<ul class="icon-nav">
						
					
				
				
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
								<a href="<?php echo $this->webroot;?>tskhome/" class=""><i class="icon-check"></i><span>Work Planner
								<span class="switchLoad-sub"></span></span>
								<span class="label label-lightred bubble switchWork switchPre"  id="tsk_count"></span></a>
							</li>
							
						<li>
								<a href="<?php echo $this->webroot;?>tvlhome/" class=""><i class="icon-plane"></i><span>Biz Tour
								<span class="switchLoad-sub"></span></span>
								<span class="label label-lightred bubble switchTour switchPre"  id="tour_count"></span></a>
							</li>
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
