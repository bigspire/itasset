<div id="navigation">
		<div class="container-fluid">
			
			
			<ul class='main-nav'>
			
			<li class="dropdown" >
					<a href="<?php echo $this->webroot;?>hrhome/" style="font-size:20px" data-toggle="dropdown" class='dropdown-toggle'>
						<span>HRIS</span>					
						
					</a>
					<ul class="dropdown-menu" style="left:0">
						<li>
							<a href="<?php echo $this->webroot;?>home/">Home</a>
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
				
				
				<li class="<?php echo $hrhome_menu;?>">
					<a href="<?php echo $this->webroot;?>hrhome/">
						<span>Dashboard</span>
					</a>
				</li>
				<li class="dropdown <?php echo $hrleave_menu;?> <?php echo $hrcancelleave_menu;?> <?php echo $hraprcancelleave_menu;?> <?php echo $hrleaveapprove_menu;?>">
					<a href="#" data-toggle="dropdown" class='dropdown-toggle'>
						<span>Leave</span>
						<span class="caret"></span> 
						<?php if($LEAVE_COUNT > 0): ?>
							<span class="label label-lightred bubble"><?php echo $LEAVE_COUNT; ?></span>
							<?php endif; ?>	
					</a>
					<ul class="dropdown-menu">
					<?php if($leave_menu == '1'):?>
					<li>
							<a href="<?php echo $this->webroot;?>hrleave/">My Leaves</a>
						</li>
					<?php endif; ?>	
					
					<?php if($hr_cancel_leave_menu == '1'):?>
					<li>
					<a href="<?php echo $this->webroot;?>hrcancelleave/">My Cancelled Leaves</a>
					</li>
					<?php endif; ?>	
					
						<?php if($approve_leave_menu == '1'):?>
						<li>
							<a href="<?php echo $this->webroot;?>hrleaveapprove/">Approve Leave
							<?php if($LV_APPR_COUNT > 0): ?>
							<span class="label label-lightred bubble"><?php echo $LV_APPR_COUNT; ?></span>
							<?php endif; ?>	
							</a>
						</li>
					<?php endif; ?>	
					
					<?php if($hr_apr_cancel_leave_menu == '1'):?>
					<li>
					<a href="<?php echo $this->webroot;?>hraprcancelleave/">Approve Cancel Leave
					<?php if($LV_CAN_APPR_COUNT > 0): ?>
							<span class="label label-lightred bubble"><?php echo $LV_CAN_APPR_COUNT; ?></span>
							<?php endif; ?>	
							</a>
					</li>
					<?php endif; ?>	
					
					</ul>
				</li>
				<li class="dropdown <?php echo $hrpermission_menu;?> <?php echo $hrperapprove_menu;?>">
					<a href="#" data-toggle="dropdown" class='dropdown-toggle'>
						<span>Permission</span>
						<span class="caret"></span>
						<?php if($PER_APPR_COUNT > 0): ?>
							<span class="label label-lightred bubble"><?php echo $PER_APPR_COUNT; ?></span>
							<?php endif; ?>	
							
					</a>
					<ul class="dropdown-menu">
					
						<?php if($permission_menu == '1'):?>
						<li>
							<a href="<?php echo $this->webroot;?>hrpermission/">My Permissions</a>
						</li>
						<?php endif; ?>	
						
						<?php if($approve_permission_menu == '1'):?>
						<li>
							<a href="<?php echo $this->webroot;?>hrperapprove/">Approve Permission
							
							<?php if($PER_APPR_COUNT > 0): ?>
							<span class="label label-lightred bubble"><?php echo $PER_APPR_COUNT; ?></span>
							<?php endif; ?>	
							</a>
						</li>
						<?php endif; ?>	
						<!--li>
							<a href="#">Reports</a>
						</li-->
					</ul>
				</li>
				<?php if($hr_pl_request_menu == '1'):?>				
				<li class="<?php echo $hrplreq_menu;?>">
					<a href="<?php echo $this->webroot;?>hrplreq/">
						<span>Approve PL</span>
						<?php if($PL_REQ_COUNT > 0): ?>
							<span class="label label-lightred bubble"><?php echo $PL_REQ_COUNT; ?></span>
							<?php endif; ?>	
					</a>
				</li>
				<?php endif; ?>
				
					<li class="dropdown <?php echo $hremployee_menu;?> <?php echo $hrattendance_menu;?> <?php echo $hrattchange_menu; ?>  
					<?php echo $hrmypayslip_menu;?> <?php echo $hrprofilechange_menu;?> <?php echo $hrattchangeapprove_menu; ?> 
					<?php echo $hrofficetiming_menu; ?> <?php echo $hrleavedetails_menu; ?>">
					<a href="#" data-toggle="dropdown" class='dropdown-toggle'>
						<span>Attendance</span>
						<span class="caret"></span>
							<?php if($EMP_COUNT > 0): ?>
							<span class="label label-lightred bubble"><?php echo $EMP_COUNT; ?></span>
							<?php endif; ?>	
					</a>
					<ul class="dropdown-menu">
					<?php if($att_change_menu == '1'):?>
					<li><a href="<?php echo $this->webroot;?>hrattchange/">Attendance Change
					<?php if($ATT_CHG_COUNT > 0): ?>
							<span class="label label-lightred bubble"><?php echo $ATT_CHG_COUNT; ?></span>
							<?php endif; ?>
							</a></li>
					<?php endif; ?>
					

					
					<?php if($apr_att_change_menu == '1'):?>
					<li><a href="<?php echo $this->webroot;?>hrattchangeapprove/">Approve Attendance Change
					<?php if($ATT_APRV_COUNT > 0): ?>
							<span class="label label-lightred bubble"><?php echo $ATT_APRV_COUNT; ?></span>
							<?php endif; ?>
							</a></li>
					<?php endif; ?>
					
					<?php if($profile_change_menu == '1'):?>
					<li><a href="<?php echo $this->webroot;?>hrprofilechange/">Approve Profile Change
					<?php if($EMP_PROF_CHG_COUNT > 0): ?>
							<span class="label label-lightred bubble"><?php echo $EMP_PROF_CHG_COUNT; ?></span>
							<?php endif; ?>
							</a></li>
					<?php endif; ?>
					
					
					
					
					
					<?php if($attendance_menu == '1'):?>	
					<li><a href="<?php echo $this->webroot;?>hrattendance/">Employee Attendance</a></li>
						
					<?php endif; ?>	
					
					
					
					<?php if($payslip_menu == '1'):?>		
						<li>
							<a href="<?php echo $this->webroot;?>hrmypayslip/">My Payslips</a>
						</li>
					<?php endif; ?>
						
						<?php if($employee_menu == '1'):?>	
						<li>
							<a href="<?php echo $this->webroot;?>hremployee/">Employee Details
							<?php if($EMP_PHOTO_COUNT > 0): ?>
							<span class="label label-lightred bubble"><?php echo $EMP_PHOTO_COUNT; ?></span>
							<?php endif; ?></a>
						</li>
					<?php endif; ?>	
					
					<?php if($office_timing_menu == '1'):?>	
					<li><a href="<?php echo $this->webroot;?>hrofficetiming/">Employee Office Timing</a></li>
						
					<?php endif; ?>	
						
						
						<?php if($leave_details_menu == '1'):?>	
					<li><a href="<?php echo $this->webroot;?>hrleavedetails/">Employee Leave Details</a></li>
						
					<?php endif; ?>	
					
					
					</ul>
				</li>
				
				<?php if($company_menu == '1' || $employee_menu == '1' || $department_menu == '1' || $designation_menu == '1' ):?>	
				
				<li class="dropdown <?php echo $hrcompany_menu;?>  <?php echo $hrgrade_menu;?> <?php echo $hrdepartment_menu;?> <?php echo $hrdesignation_menu;?> <?php echo $hrbranch_menu;?> <?php echo $hrbusinessunit_menu;?>">
					<a href="#" data-toggle="dropdown" class='dropdown-toggle'>
						<span>Company</span>
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
						
						<?php if($company_menu == '1'):?>	<li>
							<a href="<?php echo $this->webroot;?>hrcompany/">Company Details</a>
						</li>
						<?php endif; ?>
							

						<?php //if($grade_menu == '1'):?>	
						<!--li>
							<a href="<?php echo $this->webroot;?>hrgrade/">Grade</a>
						</li-->
						<?php //endif; ?>
						
						
						
						<?php if($branch_menu == '1'):?>	
						<li>
							<a href="<?php echo $this->webroot;?>hrbranch/">Branch</a>
						</li>
						<?php endif; ?>
					
						<?php if($department_menu == '1'):?>	
						<li>
							<a href="<?php echo $this->webroot;?>hrdepartment/">Department</a>
						</li>
						<?php endif; ?>
						<?php if($designation_menu == '1'):?>	
						<li>
							<a href="<?php echo $this->webroot;?>hrdesignation/">Designation</a>
						</li>											
						<?php endif; ?>
						<?php if($business_unit_menu == '1'):?>	
						<li>
							<a href="<?php echo $this->webroot;?>hrbusinessunit/">Business Unit</a>
						</li>											
						<?php endif; ?>
						
					</ul>
				</li>
				<?php endif; ?>
				
			
				<?php if($upload_pay_menu == '1' || $bank_act_menu == '1' || $bank_menu == '1' ):?>	
				
				<li class="dropdown <?php echo $hrbankacc_menu;?> <?php echo $hrbank_menu;?> <?php echo $hruploadpay_menu;?>">
					<a href="#" data-toggle="dropdown" class='dropdown-toggle'>
						<span>Salary</span>
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
						
					
					
						<?php if($upload_pay_menu == '1'):?>		
						<li>
							<a href="<?php echo $this->webroot;?>hruploadpay/">Upload Payslip</a>
						</li>
						<?php endif; ?>
						
							<?php if($bank_act_menu == '1'):?>		
						
						<li><a href="<?php echo $this->webroot;?>hrbankacc/">Bank Account</a></li>	
						<?php endif; ?>
						
					<?php if($bank_menu == '1'):?>								
						
						<li><a href="<?php echo $this->webroot;?>hrbank/">Bank</a></li>	
				<?php endif; ?>						
						
							
						
					</ul>
				</li>				
			
				<?php endif; ?>
				
				
				
					<!--li class="dropdown">
					<a href="#" data-toggle="dropdown" class='dropdown-toggle'>
						<span>Performance</span>
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
					<li>
							<a href="#">Probation Confirmation</a>
						</li>
						<li>
							<a href="#">Best Performer</a>
						</li>
							<li>
							<a href="#">Star of the Quarter</a>
						</li>					
						<li>
							<a href="#">Spot Recognization</a>
						</li>	
						
						<li>
							<a href="#">Performance Appraisal</a>
						</li>	
						
					</ul>
				</li-->
				
				
				<?php if($gallery_menu == '1' || $gallery_aprv_menu == '1'):?>
				<li class="dropdown <?php echo $hrgallery_menu;?> <?php echo $hrgalapprove_menu;?>">
					<a href="#" data-toggle="dropdown" class='dropdown-toggle'>
						<span>Gallery</span>
						<span class="caret"></span>
						<?php if($GAL_APPR_COUNT > 0): ?>
							<span class="label label-lightred bubble"><?php echo $GAL_APPR_COUNT; ?></span>
							<?php endif; ?>
					</a>
					
					<ul class="dropdown-menu">
					
						<?php if($gallery_menu == '1'):?>
						
						<li>
							<a href="<?php echo $this->webroot;?>hrgallery/">Gallery</a>
						</li>
						<?php endif; ?>
						
							<?php if($gallery_aprv_menu == '1'):?>
						
						<li>
							<a href="<?php echo $this->webroot;?>hrgalapprove/">Approve Gallery

							<?php if($GAL_APPR_COUNT > 0): ?>
							<span class="label label-lightred bubble"><?php echo $GAL_APPR_COUNT; ?></span>
							<?php endif; ?>	
							</a>
						</li>
						<?php endif; ?>
						
					</ul>
				</li>
				
				<?php endif; ?>
				
				<?php if($survey_menu == 1 || $hr_voice_menu == 1 || $hr_role_menu == '1' || $leave_approver_menu == '1' || $form_menu == '1' || $latest_menu == '1' || $org_menu == '1' || $holiday_menu == '1' || $poll_menu == '1' || $file_menu == '1'):?>	
				
				<li class="dropdown <?php echo $hrvoice_menu;?>  <?php echo $hrsurvey_menu;?> <?php echo $approve_menu;?> <?php echo $roles_menu;?> <?php echo $hrform_menu;?> <?php echo $hrlatest_menu;?> <?php echo $hrorg_menu;?> <?php echo $hrholiday_menu;?> <?php echo $hrpoll_menu;?> <?php echo $hrfile_menu;?> <?php echo $hrmessage_menu;?>">
					<a href="#" data-toggle="dropdown" class='dropdown-toggle'>
						<span>Settings</span>
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
					
					<?php if($hr_role_menu == '1'):?>						
						<li>
							<a href="<?php echo $this->webroot;?>roles/?mod=hr">Role (Access Settings)</a>
						</li>
						<?php endif; ?>
						
						
						
					<?php if($leave_approver_menu == '1'):?>	
					<li>
						<a href="<?php echo $this->webroot;?>approve/?type=leave">Leave Approver</a>
						</li>
					<?php endif; ?>	
						
					<?php if($form_menu == '1'):?>		
						<li>
							<a href="<?php echo $this->webroot;?>hrform/">Office Docs</a>
						</li>
						<?php endif; ?>	
						
						<?php if($latest_menu == '1'):?>	
						<li>
							<a href="<?php echo $this->webroot;?>hrlatest/">Latest Updates</a>
						</li>	
						<?php endif; ?>	
						
						<?php if($org_menu == '1'):?>	
						<li>
							<a href="<?php echo $this->webroot;?>hrorg/">Org. Updates</a>
						</li>
						<?php endif; ?>	
						
						<?php if($holiday_menu == '1'):?>	
						<li>
							<a href="<?php echo $this->webroot;?>hrholiday/">Holidays</a>
						</li>
						<?php endif; ?>		

								
						<?php if($poll_menu == '1'):?>	
						<li>
							<a href="<?php echo $this->webroot;?>hrpoll/">Poll</a>
						</li>
						<?php endif; ?>	
						
						<?php if($survey_menu == '1'):?>	
						<li>
							<a href="<?php echo $this->webroot;?>hrsurvey/">Survey</a>
						</li>
						<?php endif; ?>	
						
						<?php if($hr_voice_menu == '1'):?>	
						<li>
							<a href="<?php echo $this->webroot;?>hrvoice/">Voice</a>
						</li>
						<?php endif; ?>	
						
						
						<?php if($hr_message_menu == '1'):?>	
						<li>
							<a href="<?php echo $this->webroot;?>hrmessage/">Message</a>
						</li>
						<?php endif; ?>
						
						<?php if($file_menu == '1'):?>	
						<li>
							<a href="<?php echo $this->webroot;?>hrfile/">Files</a>
						</li>
						<?php endif; ?>	
						
						<!--li>
							<a href="poll.html">Polls</a>
						</li-->
					</ul>
				</li>
				
				<?php endif; ?>	
				
				
					<?php if($hr_tm_report_menu == '1' || $hr_comp_report_menu == '1' ):?>	
				
				<li class="dropdown <?php echo $hrreport_menu;?> ">
					<a href="<?php echo $this->webroot;?>hrreport/attendance/" data-toggle="dropdown" class='dropdown-toggle'>
						<span>Reports</span>
					
					</a>
					
				</li>
				
				<?php endif; ?>	
				
			</ul>
			
			<div class="user" style="">
				<ul class="icon-nav">
					
				
			<li class="dropdown language-select">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-reply"></i><span>Switch Module 
						<span class="switchLoad"></span>
						<span class="label label-lightred bubble switchPre switchTot" id="total_count" style="top:14px; right:12px "></span></span>
						</a>
						<ul class="dropdown-menu pull-right">
							<li>
								<a href="<?php echo $this->webroot;?>home/"><i class="icon-home"></i><span>Home</span></a>
							</li>
							
							<li>
								<a href="<?php echo $this->webroot;?>finhome/" class=""><i class="icon-money"></i><span>Finance
								<span class="switchLoad-sub"></span></span>
							<span class="label label-lightred bubble switchFin switchPre"  id="fin_count"></span>
							</a>
							</li>
							<li>
								<a href="<?php echo $this->webroot;?>tskhome/" class=""><i class="icon-check"></i><span>Work Planner
								<span class="switchLoad-sub"></span></span>
								<span class="label label-lightred bubble switchWork switchPre"  id="tsk_count"></span></a>
							</li>
						
						<li>
								<a href="<?php echo $this->webroot;?>tvlhome/" class=""><i class="icon-plane"></i><span>Biz Tour
								<span class="switchLoad-sub"></span></span>
								<span class="label label-lightred bubble switchTour switchPre"  id="tour_count"></span>
								</a>
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
						<a href="#" class='dropdown-toggle' data-toggle="dropdown"><span><i class="icon-signin"></i>  <?php echo ucfirst($this->Session->read('USER.Login.first_name')); ?> 
						<?php //echo $this->Session->read('USER.Login.email_address'); ?></span></a>
							<ul class="dropdown-menu pull-right">
						<!--li>
							<a href="#">Edit profile</a>
						</li>
						<li>
							<a href="#">Account settings</a>
						</li-->
						<li>
							<a href="<?php echo $this->webroot;?>logins/logout/"> Sign out</a>
						</li>
					</ul>
					</li>
					</ul>	
			</div>
		</div>
	</div>
	<input type="hidden" class="actionCount"/>
		<input type="hidden" value="<?php echo $this->webroot;?>" id="site_root"/>	
