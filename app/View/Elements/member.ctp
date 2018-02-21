<div class="modal" id="myModal">
	<div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icon-remove small"></i></button>
          <h4 class="modal-title">Profile Details</h4>
        </div><div class="container"></div>
        <div class="modal-body">
        
		<?php foreach($member_data as $data): ?>
				 <div class="profSummary user-profile row member_<?php echo $data['Home']['id']; ?>" id="user-profile-1" style="display:none">
		
		<div class="col-xs-12 col-sm-3 center">
		<div>
		<span class="profile-picture">
		<?php if($data['Home']['photo'] != '' && $data['Home']['photo_status'] == 'A'):?>
		<img class="nav-user-photo" src="<?php echo $this->webroot;?>timthumb.php?src=uploads/photo/<?php echo $data['Home']['photo'];?>&h=106&q=100"/>	
		<?php elseif($data['Home']['gender'] == 'M'): ?>
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
		<?php echo $data['Home']['first_name']; ?></span>
		</a>
		
			</div>
												</div>
			</div></div>

										<div class="col-xs-12 col-sm-9">
											


											<div class="profile-user-info profile-user-info-striped">
												<div class="profile-info-row">
													<div class="profile-info-name"> Full Name </div>

													<div class="profile-info-value">
						<span id="username" class="">
						<?php echo $data['Home']['first_name']. ' '.$data['Home']['last_name']; ?></span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> Email </div>

													<div class="profile-info-value">
														<span id="username" class="">
														<?php echo $data['Home']['email_address']; ?></span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> Gender </div>

													<div class="profile-info-value">
														<span id="age" class="">
														<?php echo $this->Functions->show_gender($data['Home']['gender']); ?></span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> Mobile No. </div>

													<div class="profile-info-value">
														<span id="username" class="">
														<?php echo $data['Home']['official_contact_no']; ?>&nbsp;</span>
													</div>
												</div>
												
												<div class="profile-info-row">
													<div class="profile-info-name"> Department </div>

													<div class="profile-info-value">
														<span id="signup" class="">
														<?php echo $data['HrDepartment']['dept_name']; ?></span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> Designation </div>

													<div class="profile-info-value">
														<span id="login" class="">
														<?php echo $data['HrDesignation']['desig_name']; ?></span>
													</div>
												</div>												
											</div>
											
										</div>
									</div>
        
		<?php endforeach; ?>
		
		
		
        </div>
        <div class="modal-footer">
          <a href="#" data-dismiss="modal" class="btn">Close</a>
        </div>
      </div>
    </div>
</div>
