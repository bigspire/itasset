			<div class="row">
								
									<div class="vspace-sm-12"></div>

									<div class="col-sm-12">
										<div class="tabbable">
											<ul class="nav nav-tabs padding-12 tab-color-blue background-blue" id="myTab4">
												<li class="active">
													<a data-toggle="tab" href="#home4">Personal</a>
												</li>
										<li class="">
													<a data-toggle="tab" href="#contact">Contact</a>
												</li>
												<li class="">
													<a data-toggle="tab" href="#dropdown14">Education</a>
												</li>
												<li class="">
													<a data-toggle="tab" href="#profile4">Profession</a>
												</li>
												
												<li class="">
													<a data-toggle="tab" href="#mis">Others</a>
												</li>
											
												
												
											</ul>

											
											<div class="tab-content" style="min-height:300px;border:1px solid #c5d0dc">
												<div id="home4" class="tab-pane active">
													
											
										<div style="float:right;margin-right:50px;" >
												<div class="profile-picture" style="float:right;">
											
<span class="profile-pic">											
		
		  <?php if($user_data['Home']['photo'] != ''):?>
			<img class="nav-user-photo thumb" src="<?php echo $this->webroot;?>timthumb.php?src=uploads/photo/<?php echo $user_data['Home']['photo'];?>&h=160&q=100"/>	
			<?php elseif($user_data['Home']['gender'] == 'M'): ?>
			<img id="avatar" class="editable thumb img-responsive  editable-empty" width="140" height="160" src="<?php echo $this->webroot;?>img/profile_male.png"/>
			<?php elseif($user_data['Home']['gender'] == 'F'): ?>
			<img id="avatar" class="thumb editable img-responsive  editable-empty" width="140" height="160" src="<?php echo $this->webroot;?>img/profile_female.png"/>
			<?php endif; ?>
							
							<div class="space-4"></div>
							
			</span>			
							
							<?php echo $this->Form->create('Home', array('type' => 'file')); ?>
						<div class="fileUpload btn btn-purple btn-minier" align="center" style="margin-left:5px">
				<span>Change</span>
				<?php echo $this->Form->input('upload_file', array('type' => 'file', 'label' => false, 'value' => '', 'class' => 'upload',  'id' => 'uploadFile'));?>
				
				</div>
				
				<button type="button"  class="dn submitUpload btn btn-purple btn-minier" style="margin-left:5px">	Submit
				</button>
				<button type="button"  class="dn btn btn-warning btn-minier processBtn" style="margin-left:5px">	Processing...
				</button>
				<a href="javascript:void(0)"  class="dn submitUploadCan">Cancel</a>
				<br><span id="file_name"></span>
				
				<?php echo $this->Form->end(); ?>	
							
							
					 <?php if($user_data['Home']['photo_status'] == 'W'):?>		
					<span style="color:#ff0000" class="await_photo"><i class="icon-warning-sign"></i> Awaiting Approval</span>	
					<?php endif; ?>
					
					<span style="color:#ff0000" class="photo_waiting dn"><i class="icon-warning-sign"></i> Awaiting Approval</span>
					
					<span style="color:#1AA33E" class="dn"><i class="icon-ok"></i> Photo Approved</span>	
				
					<span style="color:#ff0000" class="dn file_error"></span>				
					<input type="hidden" id="new_user" value="0">								
												</div>
												
													
												</div>
												
												
					
					
					
										<div class="profile-user-info profile-user-info-striped" style="width:70%">
												
												<div class="profile-info-row">
													<div class="profile-info-name"> Name </div>

													<div class="profile-info-value">
														<span class="editable " id="username"><?php echo $user_data['Home']['full_name'];?></span>
													</div>
												</div>
												
												<div class="profile-info-row">
													<div class="profile-info-name"> Email </div>

													<div class="profile-info-value">
														<span class="editable " id=""><?php echo $user_data['Home']['email_address'];?></span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> Employee Code </div>

													<div class="profile-info-value">
														
														<span class="editable " id="city"><?php echo $user_data['Home']['emp_no'];?>&nbsp;</span>
													</div>
												</div>

											

												<div class="profile-info-row">
													<div class="profile-info-name"> DOB </div>

													<div class="profile-info-value">
														<span class="editable " id="signup">
														<?php echo $this->Functions->format_date($user_data['Home']['dob']);?>&nbsp;</span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> Gender </div>

													<div class="profile-info-value">
														<span class="editable " id="login"><?php echo $this->Functions->show_gender($user_data['Home']['gender']);?></span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> DOJ </div>

													<div class="profile-info-value">
														<span class="editable " id="age">
														<?php echo $this->Functions->format_date($user_data['Home']['doj']);?>&nbsp;</span>
													</div>
												</div>
												
												
											</div>
											<div style="margin-top:20px;margin-left:200px" class="">
					<a href="<?php echo $this->webroot;?>home/change_req/?type=PE" class="iframeBox" val="40_70"><button class="btn btn-xs btn-info"><i class="icon-pencil"></i> Request Change
							</button></a></div>
							
												</div>

												<div id="profile4" class="tab-pane">
														<div class="profile-user-info profile-user-info-striped" style="width:70%">
														
															<div class="profile-info-row">
													<div class="profile-info-name"> Company </div>

													<div class="profile-info-value">
														<span class="editable " id="signup"><?php echo $user_data['HrCompany']['company_name'];?>&nbsp;</span>
													</div>
												</div>
												
												<div class="profile-info-row">
													<div class="profile-info-name"> Branch </div>

													<div class="profile-info-value">
														<span class="editable " id="age"><?php echo $user_data['HrBranch']['branch_name'];?></span>
													</div>
												</div>
												
														<div class="profile-info-row">
													<div class="profile-info-name"> Designation </div>

													<div class="profile-info-value">
														<span class="editable " id="signup"><?php echo $user_data['HrDesignation']['desig_name'];?></span>
													</div>
												</div>
												
													<div class="profile-info-row">
													<div class="profile-info-name"> Business Unit </div>

													<div class="profile-info-value">
														<span class="editable " id="signup"><?php echo $user_data['HrBusinessUnit']['business_unit'];?>&nbsp;</span>
													</div>
												</div>
												
														<div class="profile-info-row">
													<div class="profile-info-name"> Department </div>

													<div class="profile-info-value">
														<span class="editable " id="age"><?php echo $user_data['HrDepartment']['dept_name'];?></span>
													</div>
												</div>

													
												
												

												<div class="profile-info-row">
													<div class="profile-info-name"> Reporting  </div>

													<div class="profile-info-value">
														<span class="editable " id="login">
														
													
                                     <?php 	if(!empty($reportingUser[0])):
											 $comma = ','; $j = 1;
											foreach($reportingUser as $key => $user):?>
											<b><?php echo 'L'.$j++.':'; ?></b>
				<a href="<?php echo $this->webroot;?>home/overlay_info/<?php echo $user['Home']['id'];?>/share/" class="iframeBox" val="50_70"><?php echo $user['Home']['first_name'].' '.$user['Home']['last_name']; ?></a>
											<?php 
											 if(count($reportingUser) > $key+1): 
											 echo $comma;  
											 endif; 
											 endforeach; 
										   else: ?>
										You have no superiors
										<?php endif; ?>
														
														</span>
													</div>
												</div>
												
													<div class="profile-info-row">
													<div class="profile-info-name"> Attendance Marking </div>

													<div class="profile-info-value">
														<span class="editable " id="age"><?php echo $this->Functions->get_att_punch_type($user_data['Home']['att_type']);?></span>
													</div>
												</div>

												
												
												</div>
												<div style="margin-top:20px;margin-left:200px" class="">
					<a href="<?php echo $this->webroot;?>home/change_req/?type=PR" class="iframeBox" val="40_70"><button class="btn btn-xs btn-info" val="40_70"><i class="icon-pencil"></i> Request Change
							</button></a></div>
</div>
							<div id="mis" class="tab-pane">
														<div class="profile-user-info profile-user-info-striped" style="width:70%">
														
														<div class="profile-info-row">
													<div class="profile-info-name"> Marital Status </div>

													<div class="profile-info-value">
														<span class="editable " id="signup"><?php echo $this->Functions->marital_status($user_data['Home']['marital_status']);?>&nbsp;</span>
													</div>
												</div>
												<?php if($user_data['Home']['marital_status'] == '2'):?>
												<div class="profile-info-row">
													<div class="profile-info-name"> Wedding Date </div>

													<div class="profile-info-value">
														<span class="editable " id="signup"><?php echo $this->Functions->format_date($user_data['Home']['wedding_date']);?>&nbsp;</span>
													</div>
												</div>
												<?php endif; ?>
												
														<div class="profile-info-row">
													<div class="profile-info-name"> Blood Group </div>

													<div class="profile-info-value">
														<span class="editable " id="age"><?php echo $user_data['HrBloodGroup']['blood_group'];?>&nbsp;</span>
													</div>
												</div>

												
												
										

												<div class="profile-info-row">
													<div class="profile-info-name"> PAN No. </div>

													<div class="profile-info-value">
														<span class="editable " id="age"><?php echo $user_data['Home']['pan'];?>&nbsp;</span>
													</div>
												</div>
												<div class="profile-info-row">
													<div class="profile-info-name"> PF No. </div>

													<div class="profile-info-value">
														<span class="editable " id="age"><?php echo $user_data['Home']['pf_no'];?>&nbsp;</span>
													</div>
												</div>
												
												<!--div class="profile-info-row">
													<div class="profile-info-name"> ESI No. </div>

													<div class="profile-info-value">
														<span class="editable " id="age"><?php echo $user_data['Home']['esi_no'];?>&nbsp;</span>
													</div>
												</div-->
												
												</div>
												<div style="margin-top:20px;margin-left:200px" class="">
					<a href="<?php echo $this->webroot;?>home/change_req/?type=OT" class="iframeBox" val="40_70"><button class="btn btn-xs btn-info" val="40_70"><i class="icon-pencil"></i> Request Change
							</button></a></div></div>
												<div id="dropdown14" class="tab-pane">
												
										<?php
										if(!empty($type5_course)):
										$active_tab1 = 'active';
										elseif(!empty($type4_course)):
										$active_tab2 = 'active';
										elseif(!empty($type3_course)):
										$active_tab3 = 'active';
										else:
										$active_tab1 = 'active';										
										endif;
										?>
												<ul class="nav nav-tabs" id="myTab2" style="margin-left:20px">
											<?php //if(!empty($type5_course)):?>
											<li class="<?php echo $active_tab1;?>">
												<a data-toggle="tab" href="#home2">PG</a>
											</li>
											<?php //endif; ?>
											
											<?php //if(!empty($type4_course)):?>
											<li class="<?php echo $active_tab2;?>">
												<a data-toggle="tab" href="#profile2">UG</a>
											</li>
											<?php //endif; ?>
											
											<?php //if(!empty($type3_course)):?>
											<li class="<?php echo $active_tab3;?>">
												<a data-toggle="tab" href="#dropdown12">Diploma/ITI</a>
											</li>
											<?php //endif; ?>
											
											<?php //if(!empty($type2_inst_name) || !empty($type1_inst_name)):?>
											<li class="">
												<a data-toggle="tab" href="#dropdown13">School</a>
											</li>
											<?php //endif; ?>
										</ul>	
											
									<div class="tabbable tabs-below">
										<div class="tab-content">
										<?php //if(!empty($type5_course)):?>
											<div id="home2" class="tab-pane <?php echo $active_tab1;?>">
												<div class="profile-user-info profile-user-info-striped" style="width:70%">
														
														<div class="profile-info-row">
													<div class="profile-info-name"> Course </div>

													<div class="profile-info-value">
							<span class="editable " id="age"><?php echo $type5_course;?>&nbsp;</span>
													</div>
												</div>

	<div class="profile-info-row">
													<div class="profile-info-name"> Specialization </div>

													<div class="profile-info-value">
														<span class="editable " id="age"><?php echo $type5_spec;?>&nbsp;</span>
													</div>
												</div>
												
													<div class="profile-info-row">
													<div class="profile-info-name"> Year of Passing </div>

													<div class="profile-info-value">
														<span class="editable " id="age"><?php echo $type5_year_passing;?>&nbsp;</span>
													</div>
												</div>
													<div class="profile-info-row">
													<div class="profile-info-name"> % of Marks </div>

													<div class="profile-info-value">
														<span class="editable " id="age"><?php echo $type5_percent_marks;?>&nbsp;</span>
													</div>
												</div>
												
													<div class="profile-info-row">
													<div class="profile-info-name"> College Name </div>

													<div class="profile-info-value">
														<span class="editable " id="age"><?php echo $type5_inst_name;?>&nbsp;</span>
													</div>
												</div>
												
													<div class="profile-info-row">
													<div class="profile-info-name"> University </div>

													<div class="profile-info-value">
														<span class="editable " id="age"><?php echo $type5_university;?>&nbsp;</span>
													</div>
												</div>
												
													<div class="profile-info-row">
													<div class="profile-info-name"> Course Type </div>

													<div class="profile-info-value">
														<span class="editable " id="age"><?php echo $this->Functions->show_course_type($type5_course_type);?>&nbsp;</span>
													</div>
												</div></div>
											
											
											</div>
										<?php //endif; ?>
										
										<?php //if(!empty($type4_course)):?>
											<div id="profile2" class="tab-pane <?php echo $active_tab2;?>">
												<div class="profile-user-info profile-user-info-striped" style="width:70%">
														
														<div class="profile-info-row">
													<div class="profile-info-name"> Course </div>

													<div class="profile-info-value">
							<span class="editable " id="age"><?php echo $type4_course;?>&nbsp;</span>
													</div>
												</div>

	<div class="profile-info-row">
													<div class="profile-info-name"> Specialization </div>

													<div class="profile-info-value">
														<span class="editable " id="age"><?php echo $type4_spec;?>&nbsp;</span>
													</div>
												</div>
												
													<div class="profile-info-row">
													<div class="profile-info-name"> Year of Passing </div>

													<div class="profile-info-value">
														<span class="editable " id="age"><?php echo $type4_year_passing;?>&nbsp;</span>
													</div>
												</div>
													<div class="profile-info-row">
													<div class="profile-info-name"> % of Marks </div>

													<div class="profile-info-value">
														<span class="editable " id="age"><?php echo $type4_percent_marks;?>&nbsp;</span>
													</div>
												</div>
												
													<div class="profile-info-row">
													<div class="profile-info-name"> College Name </div>

													<div class="profile-info-value">
														<span class="editable " id="age"><?php echo $type4_inst_name;?>&nbsp;</span>
													</div>
												</div>
												
													<div class="profile-info-row">
													<div class="profile-info-name"> University </div>

													<div class="profile-info-value">
														<span class="editable " id="age"><?php echo $type4_university;?>&nbsp;</span>
													</div>
												</div>
												
													<div class="profile-info-row">
													<div class="profile-info-name"> Course Type </div>

													<div class="profile-info-value">
														<span class="editable " id="age"><?php echo $this->Functions->show_course_type($type4_course_type);?>&nbsp;</span>
													</div>
												</div></div>
											
											</div>
											<?php //endif; ?>
										
										<?php //if(!empty($type3_course)):?>
										<div id="dropdown12" class="tab-pane <?php echo $active_tab3;?>">
												<div class="profile-user-info profile-user-info-striped" style="width:70%">
														
														<div class="profile-info-row">
													<div class="profile-info-name"> Course </div>

													<div class="profile-info-value">
							<span class="editable " id="age"><?php echo $type3_course;?>&nbsp;</span>
													</div>
												</div>

	<div class="profile-info-row">
													<div class="profile-info-name"> Specialization </div>

													<div class="profile-info-value">
														<span class="editable " id="age"><?php echo $type3_spec;?>&nbsp;</span>
													</div>
												</div>
												
													<div class="profile-info-row">
													<div class="profile-info-name"> Year of Passing </div>

													<div class="profile-info-value">
														<span class="editable " id="age"><?php echo $type3_year_passing;?>&nbsp;</span>
													</div>
												</div>
													<div class="profile-info-row">
													<div class="profile-info-name"> % of Marks </div>

													<div class="profile-info-value">
														<span class="editable " id="age"><?php echo $type3_percent_marks;?>&nbsp;</span>
													</div>
												</div>
												
													<div class="profile-info-row">
													<div class="profile-info-name"> College Name </div>

													<div class="profile-info-value">
														<span class="editable " id="age"><?php echo $type3_inst_name;?>&nbsp;</span>
													</div>
												</div>
												
													<div class="profile-info-row">
													<div class="profile-info-name"> University </div>

													<div class="profile-info-value">
														<span class="editable " id="age"><?php echo $type3_university;?>&nbsp;</span>
													</div>
												</div>
												
													<div class="profile-info-row">
													<div class="profile-info-name"> Course Type </div>

													<div class="profile-info-value">
														<span class="editable " id="age"><?php echo $this->Functions->show_course_type($type3_course_type);?>&nbsp;</span>
													</div>
												</div></div>
											
											</div>
										<?php //endif; ?>
										
										
											<div id="dropdown13" class="tab-pane <?php echo $active_tab4;?>">
											<?php //if(!empty($type2_inst_name)):?>
												<div class="profile-user-info profile-user-info-striped" style="width:70%">
													
	<div class="profile-info-row">
													<div class="profile-info-name"> Standard </div>

													<div class="profile-info-value">
							<span class="editable" id="age">12th</span>
													</div>
												</div>

												
														<div class="profile-info-row">
													<div class="profile-info-name"> School </div>

													<div class="profile-info-value">
							<span class="editable" id="age"><?php echo $type2_inst_name;?>&nbsp;</span>
													</div>
												</div>

	
												
													<div class="profile-info-row">
													<div class="profile-info-name"> Year of Passing </div>

													<div class="profile-info-value">
														<span class="editable " id="age"><?php echo $type2_year_passing;?>&nbsp;</span>
													</div>
												</div>
													<div class="profile-info-row">
													<div class="profile-info-name"> % of Marks </div>

													<div class="profile-info-value">
														<span class="editable " id="age"><?php echo $type2_percent_marks;?>&nbsp;</span>
													</div>
												</div>
												
													
												
													<div class="profile-info-row">
													<div class="profile-info-name"> Board </div>

													<div class="profile-info-value">
														<span class="editable " id="age"><?php echo $this->Functions->show_board($type2_board);?>&nbsp;</span>
													</div>
												</div></div>
												<?php //endif; ?>
												
												<?php //if(!empty($type1_inst_name)):?>
													<div class="profile-user-info profile-user-info-striped" style="width:70%">
														
														<div class="profile-info-row">
													<div class="profile-info-name"> Standard </div>

													<div class="profile-info-value">
							<span class="editable" id="age">10th</span>
													</div>
												</div>
												
														<div class="profile-info-row">
													<div class="profile-info-name"> School </div>

													<div class="profile-info-value">
							<span class="editable" id="age"><?php echo $type1_inst_name;?>&nbsp;</span>
													</div>
												</div>

	
												
													<div class="profile-info-row">
													<div class="profile-info-name"> Year of Passing </div>

													<div class="profile-info-value">
														<span class="editable " id="age"><?php echo $type1_year_passing;?>&nbsp;</span>
													</div>
												</div>
													<div class="profile-info-row">
													<div class="profile-info-name"> % of Marks </div>

													<div class="profile-info-value">
														<span class="editable " id="age"><?php echo $type1_percent_marks;?>&nbsp;</span>
													</div>
												</div>
												
													
												
													<div class="profile-info-row">
													<div class="profile-info-name"> Board </div>

													<div class="profile-info-value">
														<span class="editable " id="age"><?php echo $this->Functions->show_board($type1_board);?>&nbsp;</span>
													</div>
												</div></div>
											<?php //endif; ?>
											</div>	
										
								
										</div>

									
									</div>
								
						
						
													
												
												
												<div style="margin-top:20px;margin-left:200px" class="">
					<a href="<?php echo $this->webroot;?>home/change_req/?type=ED" class="iframeBox" val="40_70"><button class="btn btn-xs btn-info" val="40_70"><i class="icon-pencil"></i> Request Change
							</button></a></div>
										</div>	
											
											<div id="contact" class="tab-pane">
														<div class="profile-user-info profile-user-info-striped" style="width:70%">
														
														<div class="profile-info-row">
													<div class="profile-info-name"> Mobile No. (Office) </div>

													<div class="profile-info-value">
														<span class="editable " id="age"><?php echo $user_data['Home']['official_contact_no'];?>&nbsp;</span>
													</div>
												</div>
												
												<div class="profile-info-row">
													<div class="profile-info-name"> Mobile No. (Personal) </div>

													<div class="profile-info-value">
														<span class="editable " id="age"><?php echo $user_data['Home']['contact_no'];?>&nbsp;</span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> Landline No. </div>

													<div class="profile-info-value">
														<span class="editable " id="signup"><?php echo $user_data['Home']['landline'];?>&nbsp;</span>
													</div>
												</div>

												
												<div class="profile-info-row">
													<div class="profile-info-name"> Present Address </div>

													<div class="profile-info-value">
														<span class="editable " id="signup"><?php echo $user_data['Home']['communication_addr'];?>&nbsp;</span>
													</div>
												</div>
												
												<div class="profile-info-row">
													<div class="profile-info-name"> Permanent Address </div>

													<div class="profile-info-value">
														<span class="editable " id="signup"><?php echo $user_data['Home']['permanent_addr'];?>&nbsp;</span>
													</div>
												</div>
												
														<div class="profile-info-row"   style="height:50px">
													<div class="profile-info-name"> Emergency Contact Person </div>

													<div class="profile-info-value">
														<span class="editable " id="age"><?php echo $user_data['Home']['emergency_contact_person'];?>&nbsp;
														<?php if(!empty($user_data['Home']['emergency_relation'])):?>
														<b>(<?php echo ucwords($user_data['Home']['emergency_relation']);?>)</b>
														<?php endif; ?>
														</span>
													</div>
												</div>
												
												
												<div class="profile-info-row" style="height:50px">
													<div class="profile-info-name"> Emergency Contact No. </div>

													<div class="profile-info-value">
														<span class="editable " id="age"><?php echo $user_data['Home']['emergency_contact_no'];?>&nbsp;</span>
													</div>
												</div>
												
												</div>
												<div style="margin-top:20px;margin-left:200px" class="">
					<a href="<?php echo $this->webroot;?>home/change_req/?type=CT" class="iframeBox" val="40_70"><button class="btn btn-xs btn-info" val="40_70"><i class="icon-pencil"></i> Request Change
							</button></a></div>
</div>
											</div>
										</div>
									</div><!-- /span -->
									
									<input type="hidden" value="1" id="overlayclose">
								
								
								
								<!--div class="col-sm-12">
										<h3 class="header smaller lighter green">
											<i class="icon-bullhorn"></i>
											Tips
										</h3>								

										<div class="alert alert-info">
											<button type="button" class="close" data-dismiss="alert">
												<i class="icon-remove"></i>
											</button>
											

											You can use <strong>Request Change</strong> option to inform your HR to update your very latest information to show in your profile.
											<br>
										</div>
									</div-->
								
								</div>
						
								