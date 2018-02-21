<div id="navigation">
		<div class="container-fluid">
			<!--a href="<?php echo $this->webroot;?>tvlhome/" id="brand">CEO Finance</a-->
			
			<ul class='main-nav'>
			
			<li class="dropdown" >
					<a href="<?php echo $this->webroot;?>tvlhome/" style="font-size:20px" data-toggle="dropdown" class='dropdown-toggle'>
						<span>Biz Tour</span>					
						
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
				
				
				
				<li class="<?php echo $tvlhome_menu;?>">
					<a href="<?php echo $this->webroot;?>tvlhome/">
						<span>Dashboard</span>
					</a>
				</li>
				<li class="dropdown <?php echo $tvlreq_menu;?> <?php echo $tvlcanreq_menu;?> <?php echo $tvltktdownload_menu;?>" >
					<a href="#" data-toggle="dropdown" class='dropdown-toggle'>
						<span>Travel</span>
						<span class="caret"></span> 
						<?php //if($TSK_PLAN_COUNT > 0): ?>
							<span class="label label-lightred bubble"><?php // echo $TSK_PLAN_COUNT; ?></span>
							<?php //endif; ?>	
						
					</a>
					<ul class="dropdown-menu">
					
						<li>
							<a href="<?php echo $this->webroot;?>tvlreq/">My Travel
							
							</a>							
						
						</li>
						
						<li>
							<a href="<?php echo $this->webroot;?>tvlcanreq/">Cancel Travel
							
							</a>							
						
						</li>
						
						<li>
							<a href="<?php echo $this->webroot;?>tvltktdownload/">Download Ticket</a>
						</li>
					
						
					</ul>
				</li>
				
					<?php if($tvl_apr_req_menu == '1' || $tvl_can_apr_menu == '1'):?>	
					
				<li class="dropdown <?php echo $tvlreqapr_menu;?> <?php echo $tvlcanapr_menu;?>">
					<a href="#" data-toggle="dropdown" class='dropdown-toggle'>
						<span>Approve Travel</span>
						<span class="caret"></span>
						<?php if($TVL_TOT_APR > 0): ?>
							<span class="label label-lightred bubble"><?php echo $TVL_TOT_APR; ?></span>
							<?php endif; ?>	
					</a>
					<ul class="dropdown-menu">
					<?php if($tvl_apr_req_menu == '1'):?>	
								<li>
									<a href="<?php echo $this->webroot;?>tvlreqapr/">Approve Travel
									<?php if($APR_TVL_COUNT > 0): ?>
							<span class="label label-lightred bubble"><?php echo $APR_TVL_COUNT; ?></span>
							<?php endif; ?>	
							</a>
								</li>
						<?php endif; ?>		
								
					<?php if($tvl_can_apr_menu == '1'):?>	
								<li>
									<a href="<?php echo $this->webroot;?>tvlcanapr/">Cancel Travel
									<?php if($APR_TVL_CAN_COUNT > 0): ?>
							<span class="label label-lightred bubble"><?php echo $APR_TVL_CAN_COUNT; ?></span>
							<?php endif; ?>	
							</a>
								</li>
						<?php endif; ?>
					</ul>
				</li>
				<?php endif; ?>
				
				
				<?php if($tvl_ticket_menu == '1'):?>	
				
				<li class="dropdown <?php echo $tvlbooktkt_menu;?> <?php echo $tvlcantkt_menu;?>">
					<a href="#" data-toggle="dropdown" class='dropdown-toggle'>
						<span>Ticket Booking</span>
						<span class="caret"></span>
						<?php if($TVL_TOT_TKT > 0): ?>
							<span class="label label-lightred bubble"><?php echo $TVL_TOT_TKT; ?></span>
							<?php endif; ?>
					</a>
					<ul class="dropdown-menu">
						<li>
							<a href="<?php echo $this->webroot;?>tvlbooktkt/">Book Ticket
							<?php if($BOOK_TKT_COUNT > 0): ?>
							<span class="label label-lightred bubble"><?php echo $BOOK_TKT_COUNT; ?></span>
							<?php endif; ?>	</a>
						</li>
						
						<li>
							<a href="<?php echo $this->webroot;?>tvlcantkt/">Cancel Ticket
							<?php if($CANCEL_TKT_COUNT > 0): ?>
							<span class="label label-lightred bubble"><?php echo $CANCEL_TKT_COUNT; ?></span>
							<?php endif; ?>	</a>
						</li>
						
					
						
					</ul>
				</li>
				<?php endif; ?>
				
	


	<?php if($tvl_roles_menu == '1' || $tvl_place_menu == '1'):?>	
				
				<li class="dropdown <?php echo $roles_menu;?> <?php echo $tvlplace_menu;?>">
					<a href="#" data-toggle="dropdown" class='dropdown-toggle'>
						<span>Settings</span>
						<span class="caret"></span>						
					</a>
					
					<ul class="dropdown-menu">
					
					<?php if($tvl_roles_menu == '1'):?>	
						<li>
							<a href="<?php echo $this->webroot;?>roles/?mod=tvl">Roles</a>
							
						</li>
					<?php endif; ?>
					
					
						
						<?php if($tvl_place_menu == '1'):?>	
						<li>
							<a href="<?php echo $this->webroot;?>tvlplace/">Places</a>
							
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
								<span class="label label-lightred bubble switchTour switchPre"  id="hr_count"></span></a>
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
							
							<?php if($bd_business_menu):?>
							<li>
								<a href="<?php echo $this->webroot;?>bdhome/?type=N" class=""><i class="icon-lightbulb"></i><span>BD
								<span class=""></span></span>
								<span class="label label-lightred bubble switchTour switchPre"  id="bd_menu_count"></span></a>
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
