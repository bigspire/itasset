<div id="navigation">
		<div class="container-fluid">
			<!--a href="<?php echo $this->webroot;?>finhome/" id="brand">CEO Finance</a-->
			
			<ul class='main-nav'>
			
			<li class="dropdown" >
					<a href="<?php echo $this->webroot;?>finhome/" style="font-size:20px" data-toggle="dropdown" class='dropdown-toggle'>
						<span>Finance</span>					
						
					</a>
					<ul class="dropdown-menu" style="left:0">
						<li>
							<a href="<?php echo $this->webroot;?>home/">Home</a>
						</li>
						<li>
							<a href="<?php echo $this->webroot;?>hrhome/" class="">HRIS</a>
							
						</li>
						<li>
							<a href="<?php echo $this->webroot;?>tskhome/" class="">Work Planner</a>
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
				
				
				
				<li class="<?php echo $finhome_menu;?>">
					<a href="<?php echo $this->webroot;?>finhome/">
						<span>Dashboard</span>
					</a>
				</li>
				<li class="dropdown <?php echo $finadvance_menu;?> <?php echo $finadvapprove_menu;?> <?php echo $finadvpay_menu;?>" >
					<a href="#" data-toggle="dropdown" class='dropdown-toggle'>
						<span>Advance</span>
						<span class="caret"></span> 
						<?php if($ADV_COUNT > 0): ?>
							<span class="label label-lightred bubble"><?php echo $ADV_COUNT; ?></span>
							<?php endif; ?>	
						
					</a>
					<ul class="dropdown-menu">
					<?php if($advance_menu == '1'):?>
						<li>
							<a href="<?php echo $this->webroot;?>finadvance/">My Advance
								<span class="label label-lightred bubble"><?php //echo $FIN_COUNT; ?></span>
							</a>							
						
						</li>
					<?php endif; ?>
						
					<?php if($approve_advance_menu == '1'):?>
					<li>
							
							<a href="<?php echo $this->webroot;?>finadvapprove/">Approve Advance 
								<?php if($ADV_APPR_COUNT > 0): ?>
							<span class="label label-lightred bubble"><?php echo $ADV_APPR_COUNT; ?></span>
							<?php endif; ?>	
							
							</a>
							
					
							
						</li>
					<?php endif; ?>
					<?php if($advance_pay_menu == '1'):?>		
						<li>
							<a href="<?php echo $this->webroot;?>finadvpay/">Payable Amount
							<?php if($ADV_PAY_COUNT > 0): ?>
							<span class="label label-lightred bubble"><?php echo $ADV_PAY_COUNT; ?></span>
							<?php endif; ?>
							</a>
							
							
						</li>
						<?php endif; ?>
						<?php if($advance_report_menu == '1'):?>		
						<li>
							<a href="#" class="comingSoon">Reports</a>
						</li>
						<?php endif; ?>
					</ul>
				</li>
				<li class="dropdown <?php echo $finexpense_menu;?> <?php echo $finexpapprove_menu;?> <?php echo $finexppay_menu;?>">
					<a href="#" data-toggle="dropdown" class='dropdown-toggle'>
						<span>Expenses</span>
						<span class="caret"></span>
						<?php if($EXP_COUNT > 0): ?>
							<span class="label label-lightred bubble"><?php echo $EXP_COUNT; ?></span>
							<?php endif; ?>	
					</a>
					<ul class="dropdown-menu">
						<?php if($expense_menu == '1'):?>		
								<li>
									<a href="<?php echo $this->webroot;?>finexpense/">My Expenses</a>
								</li>
								
						<?php endif; ?>
						
						<?php if($expense_menu == '1'):?>		
								<li>
									<a href="<?php echo $this->webroot;?>finexpense/?type=draft">Draft Expenses</a>
								</li>
								
						<?php endif; ?>
						
						<?php if($approve_expense_menu == '1'):?>							
						<li>
							<a href="<?php echo $this->webroot;?>finexpapprove/">Approve Expense
								<?php if($EXP_APPR_COUNT > 0): ?>
							<span class="label label-lightred bubble"><?php echo $EXP_APPR_COUNT; ?></span>
							<?php endif; ?>	
							
							</a>
						</li>
						<?php endif; ?>
						<?php if($discrepancy_menu == '1'):?>		
						<li>
							<a href="<?php echo $this->webroot;?>finexpense/?type=discrepancy">Discrepancy</a>
						</li>
						<?php endif; ?>
						<?php if($expense_pay_menu == '1'):?>		
						<li>
							<a href="<?php echo $this->webroot;?>finexppay/">Payable Amount
							<?php if($EXP_PAY_COUNT > 0): ?>
							<span class="label label-lightred bubble"><?php echo $EXP_PAY_COUNT; ?></span>
							<?php endif; ?>
							
							</a>
						</li>
						<?php endif; ?>
						<?php if($expense_report_menu == '1'):?>		
						<li>
							<a href="#" class="comingSoon">Reports</a>
						</li>
					<?php endif; ?>
						
					</ul>
				</li>
				
				<?php if($customer_menu == '1' || $project_contact_menu == '1' || $project_menu == '1' ):?>	
				
				<li class="dropdown <?php echo $tskcustomers_menu;?> <?php echo $tskprojects_menu;?> <?php echo $tskprojectcontacts_menu;?>">
					<a href="#" data-toggle="dropdown" class='dropdown-toggle'>
						<span>Projects</span>
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
					<?php if($customer_menu == '1'):?>	
						<li>
							<a href="<?php echo $this->webroot;?>tskcustomers/">Customer Details</a>
						</li>
						<?php endif; ?>
						
						<?php if($project_menu == '1'):?>	
						<li>
							<a href="<?php echo $this->webroot;?>tskprojects/">Project Details</a>
						</li>
						<?php endif; ?>
						
						<?php if($project_contact_menu == '1'):?>	<li>
							<a href="<?php echo $this->webroot;?>tskprojectcontacts/">Project Contact Details</a>
						</li>
						<?php endif; ?>
						
					</ul>
				</li>
				<?php endif; ?>
				
				
			
			
			<?php if($role_menu == '1' || $expense_limit_menu == '1' || $expense_category_menu == '1' || $adv_approver_menu == '1' || $expense_approver_menu == '1'  || $emp_email_menu == '1' ):?>	
				
				
				<li class="dropdown <?php echo $approve_menu;?> <?php echo $roles_menu;?> <?php echo $finexplimit_menu;?> <?php echo $finexpcat_menu;?> <?php echo $finemailsend_menu;?>">
					<a href="#" data-toggle="dropdown" class='dropdown-toggle'>
						<span>Settings</span>
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
				<?php if($role_menu == '1'):?>						
						<li>
							<a href="<?php echo $this->webroot;?>roles/?mod=fin">Role (Access Settings)</a>
						</li>
						<?php endif; ?>
						<?php //if($expense_limit_menu == '1'):?>	
						<!--li>
							<a href="<?php echo $this->webroot;?>finexplimit/">Expense Limit</a>
						</li-->
						<?php //endif; ?>
						<?php if($expense_category_menu == '1'):?>	
						<li>
							<a href="<?php echo $this->webroot;?>finexpcat/">Expense Category</a>
						</li>
						<?php endif; ?>
						<?php if($adv_approver_menu == '1'):?>	
						<li>
							<a href="<?php echo $this->webroot;?>approve/?type=advance">Advance Approver</a>
						</li>
						<?php endif; ?>
						<?php if($expense_approver_menu == '1'):?>	
						<li>
							<a href="<?php echo $this->webroot;?>approve/?type=expense">Expense Approver</a>
						</li>
						<?php endif; ?>
				
						<?php if($emp_email_menu == '1'):?>	
						<li>
							<a href="<?php echo $this->webroot;?>finemailsend/">Employee Email Send</a>
						</li>
						<?php endif; ?>
						
						
					</ul>
				</li>
			<?php endif; ?>	
			
			
			<?php if($fin_tm_report_menu == '1' || $fin_comp_report_menu == '1' ):?>	
				
				<li class="dropdown <?php echo $finreport_menu;?> ">
					<a href="<?php echo $this->webroot;?>finreport/advance/" data-toggle="dropdown" class='dropdown-toggle'>
						<span>Reports</span>
					
					</a>
					
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
								<span class="label label-lightred bubble switchTour switchPre"  id="hr_count"></span></a>
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
