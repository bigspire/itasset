<div class="" id="myModal">
	<div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Profile Details</h4>
        </div><div class="container"></div>
        <div class="modal-body">
        
				 <div class="user-profile row" id="user-profile-1">
		
		<div class="col-xs-12 col-sm-3 center" style="width:33%">
		<div>
		<span class="profile-picture" style="max-width:none;">
		<?php if($member_data['Home']['photo'] != '' && $member_data['Home']['photo_status'] == 'A'):?>
		<img class="nav-user-photo" src="<?php echo $this->webroot;?>timthumb.php?src=uploads/photo/<?php echo $member_data['Home']['photo'];?>&h=140&q=100"/>	
		<?php elseif($member_data['Home']['gender'] == 'M'): ?>
		<img class="nav-user-photo" src="<?php echo $this->webroot;?>img/profile_male_s.jpg" alt=""/>
		<?php else: ?>
		<img class="nav-user-photo" src="<?php echo $this->webroot;?>img/profile_female_s.jpg" alt=""/>
		<?php endif; ?>
							
							
		</span>
		<div class="space-4"></div>
		<div class="width-80 label label-info label-xlg arrowed-in arrowed-in-right">
		<div class="inline position-relative">
		<a data-toggle="dropdown" class="user-title-label dropdown-toggle" href="#">
		<i class="middle"></i>
		&nbsp;
		<span class="white">
		<?php echo $member_data['Home']['first_name']; ?></span>
		</a>
		
			</div>
												</div>
			</div></div>

										<div class="col-xs-12 col-sm-9"  style="width:67%">
											


											<div class="profile-user-info profile-user-info-striped">
												<div class="profile-info-row">
													<div class="profile-info-name"> Full Name </div>

													<div class="profile-info-value">
						<span id="username" class="">
						<?php echo $member_data['Home']['first_name']. ' '.$member_data['Home']['last_name']; ?></span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> Email </div>

													<div class="profile-info-value">
														<span id="username" class="">
														<?php echo $member_data['Home']['email_address']; ?></span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> Gender </div>

													<div class="profile-info-value">
														<span id="age" class="">
														<?php echo $this->Functions->show_gender($member_data['Home']['gender']); ?></span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> Mobile No. </div>

													<div class="profile-info-value">
														<span id="username" class="">
														<?php echo $member_data['Home']['official_contact_no']; ?>&nbsp;</span>
													</div>
												</div>
												
												<div class="profile-info-row">
													<div class="profile-info-name"> Skype </div>

													<div class="profile-info-value">
														<span id="username" class="">
														<?php echo $member_data['Home']['skype']; ?>&nbsp;</span>
													</div>
												</div>
												
												
												<div class="profile-info-row">
													<div class="profile-info-name"> Department </div>

													<div class="profile-info-value">
														<span id="signup" class="">
														<?php echo $member_data['HrDepartment']['dept_name']; ?></span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> Designation </div>

													<div class="profile-info-value">
														<span id="login" class="">
														<?php echo $member_data['HrDesignation']['desig_name']; ?></span>
													</div>
												</div>	
												<div class="profile-info-row">
													<div class="profile-info-name"> Business Unit </div>

													<div class="profile-info-value">
														<span id="login" class="">
														<?php echo $member_data['HrBusinessUnit']['business_unit']; ?></span>
													</div>
												</div>	
												<div class="profile-info-row">
													<div class="profile-info-name"> Location </div>

													<div class="profile-info-value">
														<span id="login" class="">
														<?php echo $member_data['HrBranch']['branch_name']; ?></span>
													</div>
												</div>		
											</div>
											
										</div>
									</div>
        
		
		
		
		
        </div>
    
      </div>
    </div>
</div>
