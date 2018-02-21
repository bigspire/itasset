<?php echo $this->element('hr_menu'); ?>
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Create Employee</h1>
					</div>
					
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>hrhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="<?php echo $this->webroot;?>hremployee/">Employee</a>
								<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="#">Create Employee</a>
						</li>
					</ul>
					
				</div>
				
				<?php echo $this->Session->flash();?>
				
				
					
					<div class="row-fluid  footer_div">
					
					
					<div class="span12">
					
				<?php echo $this->element('employee/add/emp_step'); ?>
						
					<?php echo $this->Form->create('HrEmployee', array('id' => 'formID', 'type' => 'file', 'class' => 'form-horizontal form-column form-bordered')); ?>
								
									
									
						<div class="box">
							<div class="box-title">
								<h3><i class="icon-list"></i> Personal Details</h3>
							</div>
							
						
							<div class="box-content nopadding">
								
								
								
								
								
									<div class="span6">
									
										<div class="control-group">
											<label for="textfield" class="control-label">Company </label>
											<div class="controls">
		<?php echo $company_data['HrCompany']['company_name']; ?>	
											</div>
										</div>
										
										
										<div class="control-group">
											<label for="textfield" class="control-label">First Name </label>
											<div class="controls">										
										<?php echo ucwords($this->Session->read('personal.first_name')); ?>
											</div>
										</div>
										
										
											<div class="control-group">
											<label for="textfield" class="control-label">Last Name </label>
											<div class="controls">
										
									<?php echo ucwords($this->Session->read('personal.last_name')); ?>
											</div>
										</div>
										
										
											<div class="control-group">
											<label for="textfield" class="control-label">Email </label>
											<div class="controls">
											<?php echo $this->Session->read('personal.email_address'); ?>
													
												
											</div>
										</div>
										
											<div class="control-group">
											<label for="textfield" class="control-label">Emp. Code </label>
											<div class="controls">
									<?php echo $this->Session->read('personal.emp_no'); ?>
													
												
											</div>
										</div>
										
												
									<div class="control-group">
											<label for="textfield" class="control-label">Department </label>
											<div class="controls">
									<?php echo $dept_data['HrDepartment']['dept_name']; ?>	
											</div>
										</div>
									

	<div class="control-group">
											<label for="textfield" class="control-label">Designation </label>
											<div class="controls">
								<?php echo $desig_data['HrDesignation']['desig_name']; ?>	
											</div>
										</div>	
							
<div class="control-group">
											<label for="textfield" class="control-label">Business Unit </label>
											<div class="controls">
								<?php echo $biz_data['HrBusinessUnit']['business_unit']; ?>	
											</div>
										</div>								
									
									<div class="control-group">
											<label for="textfield" class="control-label">Mobile No. (Office) </label>
											<div class="controls">
									<?php echo $this->Session->read('personal.official_contact_no'); ?>
													
												
											</div>
										</div>
									
									
										<div class="control-group">
											<label for="textfield" class="control-label">Mobile No. (Personal) </label>
											<div class="controls">
									<?php echo $this->Session->read('personal.contact_no'); ?>
													
												
											</div>
										</div>
										
										

						<div class="control-group">
											<label for="textfield" class="control-label">Landline </label>
											<div class="controls">
									<?php echo $this->Session->read('personal.landline'); ?>
													
												
											</div>
										</div>

							<div class="control-group">
											<label for="textfield" class="control-label">Personal Email </label>
											<div class="controls">
									<?php echo $this->Session->read('personal.personal_email'); ?>
													
												
											</div>
										</div>			
							
							<div class="control-group">
											<label for="textfield" class="control-label">Present Addrss </label>
											<div class="controls">
									<?php echo $this->Session->read('personal.communication_addr'); ?>
													
												
											</div>
										</div>
										
										<div class="control-group">
											<label for="password" class="control-label">Permanent Address </label>
											<div class="controls">
										<?php echo $this->Session->read('personal.permanent_addr');?>
											</div>
										</div>
										
										
									
									<div class="control-group">
											<label for="textfield" class="control-label">Marital Status </label>
											<div class="controls">
									<?php echo $this->Functions->marital_status($this->Session->read('personal.marital_status'));?>
									
									
									
													
												
											</div>
										</div>
										
										<div class="control-group">
											<label for="password" class="control-label">Wedding Date </label>
											<div class="controls">
										<?php echo $this->Session->read('personal.wedding_date');?>
											</div>
										</div>

										
										<div class="control-group">
											<label for="textfield" class="control-label">Blood Group </label>
											<div class="controls">
									<?php echo $blood_data['HrBloodGroup']['blood_group']; ?>	
													
												
											</div>
										</div>
										
										<div class="control-group">
											<label for="textfield" class="control-label">Att. Type </label>
											<div class="controls">
									<?php echo $this->Functions->get_att_punch_type($this->Session->read('personal.att_type'));?>
													
												
											</div>
										</div>
									
									<div class="control-group">
											<label for="textfield" class="control-label">Status </label>
											<div class="controls">
									<?php echo $this->Functions->show_status($this->Session->read('personal.status'));?>
													
												
											</div>
										</div>
										
										
									</div>
									
									

									
									

<div class="span6">	

	<div class="control-group">
											<label for="textfield" class="control-label">Gender </label>
											<div class="controls">
											<?php echo $this->Functions->show_gender($this->Session->read('personal.gender'));?>
											</div>
										</div>
																	
										
						<div class="control-group">
											<label for="password" class="control-label">Photo </label>
											<div class="controls">
										<?php if($this->Session->read('personal.photo') != ''):?>
			<img class="nav-user-photo thumb othumb" src="<?php echo $this->webroot;?>timthumb.php?src=uploads/photo/<?php echo $this->Session->read('personal.photo');?>&h=90&q=100"/>	
			<?php elseif($this->Session->read('personal.gender') == 'M' && $this->Session->read('personal.photo') == ''):?>
			<img id="avatar" class="editable othumb thumb dthumb img-responsive editable-click editable-empty" width="70" height="90" src="<?php echo $this->webroot;?>img/profile_male.png"/>
			<?php elseif($this->Session->read('personal.gender') == 'F' && $this->Session->read('personal.photo') == ''): ?>
			<img id="avatar" class="thumb editable othumb dthumb img-responsive editable-click editable-empty" width="70" height="90" src="<?php echo $this->webroot;?>img/profile_female.png"/>
			<?php endif; ?>
												
												
											</div>
										</div>

										
										
									
										<div class="control-group">
											<label for="password" class="control-label">DOB </label>
											<div class="controls">
							<?php echo $this->Session->read('personal.dob');?>
											</div>
										</div>
										
										
										
									<div class="control-group">
											<label for="password" class="control-label">DOJ </label>
											<div class="controls">
										<?php echo $this->Session->read('personal.doj');?>
											</div>
										</div>
	<div class="control-group">
											<label for="password" class="control-label">DOC </label>
											<div class="controls">
										<?php echo $this->Session->read('personal.doc');?>
											</div>
										</div>

										
											<div class="control-group">
											<label for="password" class="control-label">Probation Review </label>
											<div class="controls">
										<?php echo $this->Functions->show_probation($this->Session->read('personal.probation'));?>
											</div>
										</div>

										
									
									

										
										
										
										
										
										
									
									<div class="control-group">
											<label for="textfield" class="control-label">Role </label>
											<div class="controls">
								<?php echo $role_data['Role']['role_name']; ?>	
											</div>
										</div>
									
											<div class="control-group">
											<label for="textfield" class="control-label">Skype </label>
											<div class="controls">
										<?php echo $this->Session->read('personal.skype');?>
											</div>
										</div>
										
											<div class="control-group">
											<label for="textfield" class="control-label">Branch </label>
											<div class="controls">
											<?php echo $branch_data['HrBranch']['branch_name']; ?>	
											</div>
										</div>
										<div class="control-group">
											<label for="password" class="control-label">PAN No. </label>
											<div class="controls">
										<?php echo $this->Session->read('personal.pan');?>
											</div>
										</div>
									
										<div class="control-group">
											<label for="password" class="control-label">Insurance No. </label>
											<div class="controls">
										<?php echo $this->Session->read('personal.insurance_no');?>
											</div>
										</div>
								<div class="control-group">
											<label for="password" class="control-label">PF No. </label>
											<div class="controls">
										<?php echo $this->Session->read('personal.pf_no');?>
											</div>
										</div>
										
										<div class="control-group">
											<label for="password" class="control-label">ESI No. </label>
											<div class="controls">
										<?php echo $this->Session->read('personal.esi_no');?>
											</div>
										</div>
										
										
										
								

<div class="control-group">
											<label for="password" class="control-label">Emerg. Contact Person
</label>
											<div class="controls">
										<?php echo $this->Session->read('personal.emergency_contact_person');?>
											</div>
										</div>	


										<div class="control-group">
											<label for="password" class="control-label">Emerg. Contact Relation
</label>
											<div class="controls">
										<?php echo $this->Session->read('personal.emergency_relation');?>
											</div>
										</div>	

<div class="control-group">
											<label for="password" class="control-label">Emergency Contact No.

</label>
											<div class="controls">
										<?php echo $this->Session->read('personal.emergency_contact_no');?>
											</div>
										</div>	

								<div class="control-group">
											<label for="textfield" class="control-label">Att. Approval ? </label>
											<div class="controls">
									<?php echo $this->Session->read('personal.att_approve') ? 'Yes' : 'No';?>
													
												
											</div>
								</div>	
										
									<div class="control-group">
											<label for="textfield" class="control-label">Type </label>
											<div class="controls">
									<?php echo $this->Session->read('personal.emp_type') == 'R' ? 'Regular' : 'Associate';?>
													
												
											</div>
										</div>
										
					<?php if($this->Session->read('personal.emp_type') == 'A'):?>
									<div class="control-group">
											<label for="textfield" class="control-label">Work Place </label>
											<div class="controls">
									<?php echo $this->Session->read('personal.work_place') == 'C' ? 'Client Place' : 'Our Company';?>
													
												
											</div>
										</div>

									<div class="control-group">
											<label for="textfield" class="control-label">Contract Period </label>
											<div class="controls">
									<?php echo $this->Session->read('personal.contract_from');?> To 
									<?php echo $this->Session->read('personal.contract_to');?>
													
												
											</div>
										</div>										
					<?php endif; ?>		
										
									</div>

								
							</div>
						</div>
				


							
						<div class="box">
							<div class="box-title">
								<h3><i class="icon-list"></i> Education Details</h3>
							</div>
							
						
							<div class="box-content nopadding">
								
								
								
					<?php for($i = 1; $i <= 2; $i++): ?>

					<?php if($this->Session->read('education.inst_name'.$i) != ''): ?>
							
							<?php if($i > 1):
							$border = "border-top:1px solid #ddd";
							endif; ?>
									<div class="span6">
									
										<div class="control-group" style="<?php echo $border;?>">
		<label for="textfield" class="control-label">School <b>(<?php echo $this->Functions->get_standard($i);?>)</b> </label>
											<div class="controls">
				<?php echo $this->Session->read('education.inst_name'.$i); ?>
											</div>
										</div>
										
										
										<div class="control-group">
											<label for="textfield" class="control-label">Year of Passing</label>
											<div class="controls">
										
						<?php echo $this->Session->read('education.year_passing'.$i); ?>
											</div>
										</div>
										
										
										
										
										
									
										
									</div>
									
									
						
									

									<div class="span6">									
										
							<div class="control-group" style="<?php echo $border;?>">
											<label for="textfield" class="control-label">Board </label>
											<div class="controls">
										
											<?php echo $this->Functions->show_board($this->Session->read('education.board'.$i)); ?>
											</div>
										</div>
										
										
											<div class="control-group">
											<label for="textfield" class="control-label">% of Marks </label>
											<div class="controls">
						<?php echo $this->Session->read('education.percent_marks'.$i); ?>
													
												
											</div>
										</div>
									
										
								
									</div>
					
					<?php endif; ?>
		
					<?php endfor; ?>
					
					
						<?php for($i = 3; $i <= 5; $i++): ?>

					<?php if($this->Session->read('education.hr_course_id'.$i) != ''): ?>
							
							<?php if($i > 3):
							$border = "border-top:1px solid #ddd;";
							$clear = "clear:left";
							endif; ?>
									<div class="span6" style="<?php echo $clear; ?>">
									
										<div class="control-group" style="<?php echo $border;?>">
		<label for="textfield" class="control-label">College Name <b>(<?php echo $this->Functions->get_standard($i);?>)</b> </label>
											<div class="controls">
				<?php echo $this->Session->read('education.inst_name'.$i); ?>
											</div>
										</div>
										
										
										<div class="control-group">
											<label for="textfield" class="control-label">Course</label>
											<div class="controls">
										
						<?php 
						if($i == 3):
						echo $course_name3['HrCourse']['course_name'];
						elseif ($i == 4):
						echo $course_name4['HrCourse']['course_name'];
						else: 
						echo $course_name5['HrCourse']['course_name'];
						endif; 
						?>
											</div>
										</div>
										
										
										<div class="control-group">
											<label for="textfield" class="control-label">Specialization</label>
											<div class="controls">
										
						<?php 
						if($i == 3):
						echo $spec_name3['HrSpec']['specialization'];
						elseif ($i == 4):
						echo $spec_name4['HrSpec']['specialization'];
						else: 
						echo $spec_name5['HrSpec']['specialization'];
						endif; 
						?>
											</div>
										</div>
										
										
										
										<div class="control-group">
											<label for="textfield" class="control-label">% of Marks / Grade</label>
											<div class="controls">
										
						<?php echo $this->Session->read('education.percent_marks'.$i); ?>
											</div>
										</div>
										
										
										
										
										
									
										
									</div>
									
									
						
									

									<div class="span6">		

<div class="control-group" style="<?php echo $border;?>">
											<label for="textfield" class="control-label">Year of Passing 
 </label>
											<div class="controls">
										
											<?php echo $this->Session->read('education.year_passing'.$i); ?>
											</div>
										</div>									
										
							<div class="control-group">
											<label for="textfield" class="control-label">University </label>
											<div class="controls">
										
											<?php echo $this->Session->read('education.university'.$i); ?>
											</div>
										</div>
										
										
											<div class="control-group">
											<label for="textfield" class="control-label">Course Type </label>
											<div class="controls">
						<?php echo $this->Functions->show_course_type($this->Session->read('education.course_type'.$i)); ?>
													
												
											</div>
										</div>
									
										
								
									</div>
					
					<?php endif; ?>
		
					<?php endfor; ?>
					
										
							
								
							</div>
						</div>
				

						<div class="box">
							<div class="box-title">
								<h3><i class="icon-list"></i> Experience Details</h3>
							</div>
							
						
							<div class="box-content nopadding">
								
								
								
					<?php for($i = 1; $i <= 2; $i++): ?>

					<?php if($this->Session->read('experience.company'.$i) != ''): ?>
							
							<?php if($i > 1):
							$border = "border-top:1px solid #ddd";
							$clear = "clear:both";
							endif; ?>
									<div class="span6" style="<?php echo $clear; ?>">
									
										<div class="control-group" style="<?php echo $border;?>">
		<label for="textfield" class="control-label">Company Name  </label>
											<div class="controls">
				<?php echo $this->Session->read('experience.company'.$i); ?>
											</div>
										</div>
										
										
										<div class="control-group">
											<label for="textfield" class="control-label">Designation</label>
											<div class="controls">
										
						<?php echo $this->Session->read('experience.designation'.$i); ?>
											</div>
										</div>
										
										
											<div class="control-group">
											<label for="textfield" class="control-label">Company Address
</label>
											<div class="controls">
										
						<?php echo $this->Session->read('experience.address'.$i); ?>
											</div>
										</div>
										
										
									
										
									</div>
									
									
						
									

									<div class="span6">									
										
							<div class="control-group" style="<?php echo $border;?>">
											<label for="textfield" class="control-label">Total Experience  </label>
											<div class="controls">
										
											<?php echo $this->Functions->get_total_exp($this->Session->read('experience.total_exp'.$i)); ?>
											</div>
										</div>
										
										
											<div class="control-group">
											<label for="textfield" class="control-label">Date of Joining </label>
											<div class="controls">
						<?php echo $this->Session->read('experience.doj'.$i); ?>
													
												
											</div>
										</div>
										
										<div class="control-group">
											<label for="textfield" class="control-label">Date of Relieving </label>
											<div class="controls">
						<?php echo $this->Session->read('experience.dor'.$i); ?>
													
												
											</div>
										</div>
										
								
									</div>
					
					<?php endif; ?>
		
					<?php endfor; ?>
					
					
						
					
										
						
								
							</div>
						</div>
				

						
<div class="box">
							<div class="box-title">
								<h3><i class="icon-list"></i> Family Details</h3>
							</div>
							
						
							<div class="box-content nopadding">
								
								
								
					<?php  for($i = 1; $i <= 6; $i++): ?>

					<?php if($this->Session->read('family.relative_name'.$i) != ''): ?>
							
							<?php if($i > 1):
							$border = "border-top:1px solid #ddd";
							$clear = "clear:both";
							endif; ?>
									<div class="span6" style="<?php echo $clear; ?>">
									
											<div class="control-group" style="<?php echo $border;?>">
											<label for="textfield" class="control-label">Name </label>
											<div class="controls">
										
											<?php echo $this->Session->read('family.relative_name'.$i); ?>
											</div>
										</div>
										
										
										
										
										<div class="control-group">
											<label for="textfield" class="control-label">Date of Birth</label>
											<div class="controls">
										
						<?php echo $this->Session->read('family.dob'.$i); ?>
											</div>
										</div>
										
										
										
										
									
										
									</div>
									
									
						
									

									<div class="span6">									
										
						<div class="control-group" style="<?php echo $border;?>">
		<label for="textfield" class="control-label">Relationship  </label>
											<div class="controls">
				<?php echo $this->Functions->get_family_relation($this->Session->read('family.relationship'.$i)); ?>
											</div>
										</div>
										
										
											<div class="control-group">
											<label for="textfield" class="control-label">Address</label>
											<div class="controls">
						<?php echo $this->Session->read('family.address'.$i); ?>
													
												
											</div>
										</div>
									
										
								
									</div>
					
					<?php endif; ?>
		
					<?php endfor; ?>
					
					
						
					
										
										
							<div class="span12">
										<div class="form-actions">
										<a href="<?php echo $this->webroot;?>hremployee/create_employee/family/"><button type="button" class="btn"><i class="icon-arrow-left"></i> Previous</button></a>
											<input type="submit" value="Finish" class="btn btn-primary">
											
											<a href="<?php echo $this->webroot;?>hremployee/"><button type="button" class="btn regCancel">Cancel</button></a>
											
										</div>
									</div>	
								
							</div>
						</div>
				
						
							
							
						</div>
					
					
					
					
					<!--input type="hidden" id="end_date" value="<?php echo date('d/m/Y', strtotime((date('Y')-16).'-'.date('m').'-'.date('d')));?>"-->
					
					<?php echo $this->Form->end(); ?>
					
				</div>
					</div>
		
			</div>		
					
				</div>
		
			
		
	
