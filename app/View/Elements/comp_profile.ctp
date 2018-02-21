
<div class="" id="comp_profile">
	<div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Company Details</h4>
        </div><div class="container"></div>
        <div class="modal-body">
        
		
				 <div class="user-profile row"   id="user-profile-1">
		
		<div class="col-xs-12 col-sm-3 center" style="width:25%">
		<div>
		<span class="profile-picture">
	
		<img class="nav-user-photo" src="<?php echo $this->webroot;?>timthumb.php?src=uploads/company/<?php echo $comp_data['HrCompany']['logo'];?>&w=100&q=100"/>	
								
		</span>
		<div class="space-4"></div>
		
			</div></div>

										<div class="col-xs-12 col-sm-9"  style="width:75%">
											


											<div class="profile-user-info profile-user-info-striped">
												<div class="profile-info-row">
													<div class="profile-info-name"> Company Name </div>

													<div class="profile-info-value">
						<span id="username" class="">
						<?php echo $comp_data['HrCompany']['company_name']; ?></span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> Address </div>

													<div class="profile-info-value">
														<span id="username" class="">
														<?php echo $comp_data['HrCompany']['address']; ?></span>
													</div>
												</div>


												<div class="profile-info-row">
													<div class="profile-info-name"> City </div>

													<div class="profile-info-value">
														<span id="username" class="">
														<?php echo $comp_data['HrCompany']['city']; ?>&nbsp;</span>
													</div>
												</div>
												
												<div class="profile-info-row">
													<div class="profile-info-name"> Landline </div>

													<div class="profile-info-value">
														<span id="signup" class="">
														<?php echo $comp_data['HrCompany']['landline']; ?></span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> Website </div>

													<div class="profile-info-value">
														<span id="login" class="">
		<a href="<?php echo $comp_data['HrCompany']['website']; ?>" target="_blank"><?php echo $comp_data['HrCompany']['website']; ?></a></span>
													</div>
												</div>												
											</div>
											
										</div>
									</div>
        
		
		
		
		
        </div>
       
      </div>
    </div>
</div>
