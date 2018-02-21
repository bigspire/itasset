<?php echo $this->element('hr_menu'); ?>
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>View Employee</h1>
					</div>
					
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>hrhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="<?php echo $this->webroot;?>hremployee/<?php echo $st_url; ?>">Employee</a>
								<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="#">View Employee</a>
						</li>
					</ul>
					
				</div>
				
				<?php echo $this->Session->flash();?>
				
				
					
					<div class="row-fluid  footer_div">
					
					
					<div class="span12">
					
				<?php echo $this->element('employee/view/emp_step'); ?>
						
					<?php echo $this->Form->create('HrEmployee', array('id' => 'formID', 'type' => 'file', 'class' => 'form-horizontal form-column form-bordered')); ?>
								
									
									
						<div class="box c1">
							<div class="box-title">
								<h3><i class="icon-list"></i> Personal Details</h3>
							</div>
							
						
							<div class="box-content nopadding">
								
								
								
								
								
									<div class="span6">
									
										<div class="control-group">
											<label for="textfield" class="control-label">Company </label>
											<div class="controls">
		<?php echo $emp_data['HrCompany']['company_name']; ?>	
											</div>
										</div>
										
										
										<div class="control-group">
											<label for="textfield" class="control-label">First Name </label>
											<div class="controls">										
						<?php echo $emp_data['HrEmployee']['first_name']; ?>	
											</div>
										</div>
										
										
											<div class="control-group">
											<label for="textfield" class="control-label">Last Name </label>
											<div class="controls">
										
								<?php echo $emp_data['HrEmployee']['last_name']; ?>	
											</div>
										</div>
										
										
											<div class="control-group">
											<label for="textfield" class="control-label">Email </label>
											<div class="controls">
									<?php echo $emp_data['HrEmployee']['email_address']; ?>	
													
												
											</div>
										</div>
										
											<div class="control-group">
											<label for="textfield" class="control-label">Emp. Code </label>
											<div class="controls">
							<?php echo $emp_data['HrEmployee']['emp_no']; ?>	
													
												
											</div>
										</div>
										
												
									<div class="control-group">
											<label for="textfield" class="control-label">Department </label>
											<div class="controls">
									<?php echo $emp_data['HrDepartment']['dept_name']; ?>	
											</div>
										</div>
									

	<div class="control-group">
											<label for="textfield" class="control-label">Designation </label>
											<div class="controls">
								<?php echo $emp_data['HrDesignation']['desig_name']; ?>	
											</div>
										</div>	
									
									<div class="control-group">
											<label for="textfield" class="control-label">Business Unit </label>
											<div class="controls">
								<?php echo $emp_data['HrBusinessUnit']['business_unit']; ?>	
											</div>
										</div>	
										
									<div class="control-group">
											<label for="textfield" class="control-label">Mobile No. (Office) </label>
											<div class="controls">
								<?php echo $emp_data['HrEmployee']['official_contact_no']; ?>	
													
												
											</div>
										</div>
									
									<div class="control-group">
											<label for="textfield" class="control-label">Mobile No. (Personal) </label>
											<div class="controls">
								<?php echo $emp_data['HrEmployee']['contact_no']; ?>	
													
												
											</div>
										</div>
									
									
									
									

						<div class="control-group">
											<label for="textfield" class="control-label">Landline </label>
											<div class="controls">
								<?php echo $emp_data['HrEmployee']['landline']; ?>	
													
												
											</div>
										</div>

							<div class="control-group">
											<label for="textfield" class="control-label">Personal Email </label>
											<div class="controls">
											<?php echo $emp_data['HrEmployee']['personal_email']; ?>	
								
													
												
											</div>
										</div>			
							
							<div class="control-group">
											<label for="textfield" class="control-label">Present Address </label>
											<div class="controls">
												<?php echo $emp_data['HrEmployee']['communication_addr']; ?>	
								
													
												
											</div>
										</div>
										
										<div class="control-group">
											<label for="password" class="control-label">Permanent Address </label>
											<div class="controls">
											<?php echo $emp_data['HrEmployee']['permanent_addr']; ?>	
										
											</div>
										</div>
										
									
									<div class="control-group">
											<label for="textfield" class="control-label">Marital Status </label>
											<div class="controls">
									
									<?php echo $this->Functions->marital_status($emp_data['HrEmployee']['marital_status']); ?>
									
									
									
													
												
											</div>
										</div>

										<div class="control-group">
											<label for="password" class="control-label">Wedding Date </label>
											<div class="controls">
							<?php echo $this->Functions->format_date($emp_data['HrEmployee']['wedding_date']);?>
							
							
											</div>
										</div>
										
										<div class="control-group">
											<label for="textfield" class="control-label">Blood Group </label>
											<div class="controls">
								<?php echo $emp_data['HrBloodGroup']['blood_group']; ?>	

							
													
												
											</div>
										</div>
									
									
									<div class="control-group">
											<label for="textfield" class="control-label">Att. Type </label>
											<div class="controls">
									<?php echo $this->Functions->get_att_punch_type($emp_data['HrEmployee']['att_type']);?>
													
												
											</div>
								</div>	

								
								
									<div class="control-group">
											<label for="textfield" class="control-label">Status </label>
											<div class="controls">
									<?php echo $this->Functions->show_status($emp_data['HrEmployee']['status']);?>
													
												
											</div>
										</div>
										
										
									</div>
									
									

									
									

<div class="span6">	

	<div class="control-group">
											<label for="textfield" class="control-label">Gender </label>
											<div class="controls">
											<?php echo $this->Functions->show_gender($emp_data['HrEmployee']['gender']);?>
											</div>
										</div>
																	
										
						<div class="control-group">
											<label for="password" class="control-label">Photo </label>
											<div class="controls">
			<?php if($emp_data['HrEmployee']['photo'] != ''):?>
			<img class="nav-user-photo thumb othumb" src="<?php echo $this->webroot;?>timthumb.php?src=uploads/photo/<?php echo $emp_data['HrEmployee']['photo'];?>&h=90&q=100"/>	
			<?php elseif($emp_data['HrEmployee']['gender'] == 'M'):?>
			<img id="avatar" class="editable othumb thumb dthumb img-responsive editable-click editable-empty" width="70" height="90" src="<?php echo $this->webroot;?>img/profile_male.png"/>
			<?php elseif($emp_data['HrEmployee']['gender'] == 'F'): ?>
			<img id="avatar" class="thumb editable othumb dthumb img-responsive editable-click editable-empty" width="70" height="90" src="<?php echo $this->webroot;?>img/profile_female.png"/>
			<?php endif; ?>
					
			<?php if($emp_data['HrEmployee']['photo_status'] == 'W'):?>		
				<div style="margin-top:10px;">
				<a class="" href="javascript:void(0);">
				<button type="button" name="<?php echo $this->webroot;?>hremployee/verify_photo/<?php echo $this->request->params['pass'][0];?>/A/" class="btn btn-green approveRec">Approve</button></a>
											
											
				<a href="javascript:void(0);">
				<button type="button" name="<?php echo $this->webroot;?>hremployee/verify_photo/<?php echo $this->request->params['pass'][0];?>/R/" class="btn btn-red rejectRec">Reject</button></a>
				</a>
											
					</div>
				<?php endif; ?>
										</div>

										
										
									
										<div class="control-group">
											<label for="password" class="control-label">DOB </label>
											<div class="controls">
							<?php echo $this->Functions->format_date($emp_data['HrEmployee']['dob']);?>
							
							
											</div>
										</div>
										
										
										
										
										
									<div class="control-group">
											<label for="password" class="control-label">DOJ </label>
											<div class="controls">
											<?php echo $this->Functions->format_date($emp_data['HrEmployee']['doj']);?>
											</div>
										</div>

										
									
									<div class="control-group">
											<label for="password" class="control-label">DOC </label>
											<div class="controls">
											<?php echo $this->Functions->format_date($emp_data['HrEmployee']['doc']);?>
											</div>
										</div>
										
										<div class="control-group">
											<label for="password" class="control-label">Probation Review </label>
											<div class="controls">
											<?php echo $this->Functions->show_probation($emp_data['HrEmployee']['probation']);?>
											</div>
										</div>
									

										
										
										
										
										
										
									
									<div class="control-group">
											<label for="textfield" class="control-label">Role </label>
											<div class="controls">
								<?php echo $emp_data['Role']['role_name']; ?>	
											</div>
										</div>
										
											<div class="control-group">
											<label for="textfield" class="control-label">Skype </label>
											<div class="controls">
								<?php echo $emp_data['HrEmployee']['skype']; ?>	
											</div>
										</div>
										
											<div class="control-group">
											<label for="textfield" class="control-label">Branch </label>
											<div class="controls">
											<?php echo $emp_data['HrBranch']['branch_name']; ?>	
											</div>
										</div>
										<div class="control-group">
											<label for="password" class="control-label">PAN No. </label>
											<div class="controls">
											<?php echo $emp_data['HrEmployee']['pan']; ?>	
											</div>
										</div>
									
										<div class="control-group">
											<label for="password" class="control-label">Insurance No. </label>
											<div class="controls">
												<?php echo $emp_data['HrEmployee']['insurance_no']; ?>	
										
											</div>
										</div>
								<div class="control-group">
											<label for="password" class="control-label">PF No. </label>
											<div class="controls">
											<?php echo $emp_data['HrEmployee']['pf_no']; ?>	
										
											</div>
										</div>
										
										<div class="control-group">
											<label for="password" class="control-label">ESI No. </label>
											<div class="controls">
										<?php echo $emp_data['HrEmployee']['esi_no']; ?>	
										
											</div>
										</div>
										
										
										
								

<div class="control-group">
											<label for="password" class="control-label">Emerg. Contact Person
</label>
											<div class="controls">
											<?php echo $emp_data['HrEmployee']['emergency_contact_person']; ?>	
									
											</div>
										</div>	

<div class="control-group">
											<label for="password" class="control-label">Emerg. Contact Relation
</label>
											<div class="controls">
											<?php echo $emp_data['HrEmployee']['emergency_relation']; ?>	
									
											</div>
										</div>

<div class="control-group">
											<label for="password" class="control-label">Emergency Contact No.

</label>
											<div class="controls">
										<?php echo $emp_data['HrEmployee']['emergency_contact_no']; ?>	

									
											</div>
										</div>	

<div class="control-group">
											<label for="textfield" class="control-label">Att. Approval ? </label>
											<div class="controls">
									<?php echo $emp_data['HrEmployee']['att_approve'] ? 'Yes' : 'No';?>
													
												
											</div>
								</div>	

								
								<div class="control-group">
											<label for="textfield" class="control-label">Type </label>
											<div class="controls">
	<?php echo ($emp_data['HrEmployee']['emp_type'] == 'R' ? 'Regular' : ($emp_data['HrEmployee']['emp_type'] == 'A' ?  'Associate 1' : 'Associate 2'));?>
													
												
											</div>
										</div>
										
									<?php if($emp_data['HrEmployee']['emp_type'] == 'A' || $emp_data['HrEmployee']['emp_type'] == 'A2'):?>
									<div class="control-group">
											<label for="textfield" class="control-label">Work Place </label>
											<div class="controls">
									<?php echo $emp_data['HrEmployee']['work_place'] == 'C' ? 'Client Place' : 'Our Company';?>
													
												
											</div>
										</div>

									<div class="control-group">
											<label for="textfield" class="control-label">Contract Period </label>
											<div class="controls">
									<?php echo $emp_data['HrEmployee']['contract_from'];?> To 
									<?php echo $emp_data['HrEmployee']['contract_to'];?>
													
												
											</div>
										</div>										
					<?php endif; ?>
									
									
									</div>

								
							</div>
							
							<div class="span12">
										<div class="form-actions">
											<a href="<?php echo $this->webroot;?>hremployee/edit_employee/personal/<?php echo $this->request->params['pass'][0];?>/#personal">
											<button type="button" class="btn btn-primary"><i class="icon-edit"></i> Edit</button></a>
											<a href="<?php echo $this->webroot;?>hremployee/"><button type="button" class="btn"><i class="icon-arrow-left"></i>  Go Back</button></a>
										</div>
									</div>
									
						</div>
					</div>
				


							
						<div class="box dn c2">
							<div class="box-title">
								<h3><i class="icon-list"></i> Education Details</h3>
							</div>
							
						
							<div class="box-content nopadding">
								
								
								
					<?php  foreach($edu_data as $i => $edu): ?>

					<?php if($edu['HrEducation']['inst_name'] != '' && $edu['HrEducation']['program_type'] <= 2): ?>
							
							<?php if($i > 0):
							$border = "border-top:1px solid #ddd";
							endif; ?>
									<div class="span6">
									
										<div class="control-group" style="<?php echo $border;?>">
		<label for="textfield" class="control-label">School <b>(<?php echo $this->Functions->get_standard($edu['HrEducation']['program_type']);?>)</b> </label>
											<div class="controls">
				<?php echo $edu['HrEducation']['inst_name'];?>
											</div>
										</div>
										
										
										<div class="control-group">
											<label for="textfield" class="control-label">Year of Passing</label>
											<div class="controls">
								<?php echo $this->Functions->show_year($edu['HrEducation']['year_passing']);?>		
						
											</div>
										</div>
										
										
										
										
										
									
										
									</div>
									
									
						
									

									<div class="span6">									
										
							<div class="control-group" style="<?php echo $border;?>">
											<label for="textfield" class="control-label">Board </label>
											<div class="controls">
										<?php echo $this->Functions->show_board($edu['HrEducation']['board']);?>	
										
											
											</div>
										</div>
										
										
											<div class="control-group">
											<label for="textfield" class="control-label">% of Marks </label>
											<div class="controls">
								<?php echo $edu['HrEducation']['percent_marks'];?>			
							
					
													
												
											</div>
										</div>
									
										
								
									</div>
					
					<?php endif; ?>
		
					<?php endforeach; ?>
					
					
						<?php  foreach($edu_data as $i => $edu): ?>

				<?php if($edu['HrCourse']['course_name'] != '' && $edu['HrEducation']['program_type'] > 2): ?>
							
							<?php if($i > 0):
							$border = "border-top:1px solid #ddd;";
							$clear = "clear:left";
							endif; ?>
									<div class="span6" style="<?php echo $clear; ?>">
									
										<div class="control-group" style="<?php echo $border;?>">
		<label for="textfield" class="control-label">College <b>(<?php echo $this->Functions->get_standard($edu['HrEducation']['program_type']);?>)</b> </label>
											<div class="controls">
				<?php echo $edu['HrEducation']['inst_name'];?>
											</div>
										</div>
										
										
										<div class="control-group">
											<label for="textfield" class="control-label">Course</label>
											<div class="controls">
										
						<?php echo $edu['HrCourse']['course_name'];?>
											</div>
										</div>
										
										
										<div class="control-group">
											<label for="textfield" class="control-label">Specialization</label>
											<div class="controls">
										
						<?php echo $edu['HrSpec']['specialization'];?>
											</div>
										</div>
										
										
										
										<div class="control-group">
											<label for="textfield" class="control-label">% of Marks / Grade</label>
											<div class="controls">
										
						<?php echo $edu['HrEducation']['percent_marks'];?>
						
											</div>
										</div>
										
										
										
										
										
									
										
									</div>
									
									
						
									

									<div class="span6">		

<div class="control-group" style="<?php echo $border;?>">
											<label for="textfield" class="control-label">Year of Passing 
 </label>
											<div class="controls">
											<?php echo $this->Functions->show_year($edu['HrEducation']['year_passing']);?>
										
											</div>
										</div>									
										
							<div class="control-group">
											<label for="textfield" class="control-label">University </label>
											<div class="controls">
										<?php echo $edu['HrEducation']['university'];?>
											
											</div>
										</div>
										
										
											<div class="control-group">
											<label for="textfield" class="control-label">Course Type </label>
											<div class="controls">
											
	<?php echo $this->Functions->show_course_type($edu['HrEducation']['course_type']);?>
									
												
											</div>
										</div>
									
										
								
									</div>
					
					<?php endif; ?>
		
					<?php endforeach; ?>
					
										
							
								
							</div>
							
							<div class="span12">
										<div class="form-actions">
											<a href="<?php echo $this->webroot;?>hremployee/edit_employee/education/<?php echo $this->request->params['pass'][0];?>/">
											<button type="button" class="btn btn-primary"><i class="icon-edit"></i> Edit</button></a>
											<a href="<?php echo $this->webroot;?>hremployee/"><button type="button" class="btn"><i class="icon-arrow-left"></i>  Go Back</button></a>
										</div>
									</div>
									
						</div>
				

						<div class="box dn c3">
							<div class="box-title">
								<h3><i class="icon-list"></i> Experience Details</h3>
							</div>
							
						
							<div class="box-content nopadding">
								
								
								
						<?php  foreach($exp_data as $i => $exp): ?>

				<?php if($exp['HrExperience']['company'] != ''): ?>
							
							<?php if($i > 0):
							$border = "border-top:1px solid #ddd";
							$clear = "clear:both";
							endif; ?>
									<div class="span6" style="<?php echo $clear; ?>">
									
										<div class="control-group" style="<?php echo $border;?>">
		<label for="textfield" class="control-label">Company Name <?php echo ++$i; ?> </label>
											<div class="controls">
				<?php echo $exp['HrExperience']['company']; ?>
											</div>
										</div>
										
										
										<div class="control-group">
											<label for="textfield" class="control-label">Designation</label>
											<div class="controls">
								<?php echo $exp['HrExperience']['designation']; ?>		
					
											</div>
										</div>
										
										
											<div class="control-group">
											<label for="textfield" class="control-label">Company Address
</label>
											<div class="controls">
											<?php echo $exp['HrExperience']['address']; ?>		
						
											</div>
										</div>
										
										
									
										
									</div>
									
									
						
									

									<div class="span6">									
										
							<div class="control-group" style="<?php echo $border;?>">
											<label for="textfield" class="control-label">Total Experience  </label>
											<div class="controls">
											<?php echo $this->Functions->get_total_exp($exp['HrExperience']['total_exp']); ?>		
											
											</div>
										</div>
										
										
											<div class="control-group">
											<label for="textfield" class="control-label">Date of Joining </label>
											<div class="controls">
											<?php echo $this->Functions->format_date($exp['HrExperience']['doj']); ?>		
											
						
													
												
											</div>
										</div>
										
										<div class="control-group">
											<label for="textfield" class="control-label">Date of Relieving </label>
											<div class="controls">
					<?php echo $this->Functions->format_date($exp['HrExperience']['dor']); ?>
													
												
											</div>
										</div>
										
								
									</div>
					
					<?php endif; ?>
		
					<?php endforeach; ?>
					
					
						
					
										
						
								
							</div>
							
							<div class="span12">
										<div class="form-actions">
											<a href="<?php echo $this->webroot;?>hremployee/edit_employee/experience/<?php echo $this->request->params['pass'][0];?>/">
											<button type="button" class="btn btn-primary"><i class="icon-edit"></i> Edit</button></a>
											<a href="<?php echo $this->webroot;?>hremployee/"><button type="button" class="btn"><i class="icon-arrow-left"></i>  Go Back</button></a>
										</div>
									</div>
									
						</div>
				

						
					<div class="box dn c4">
							<div class="box-title">
								<h3><i class="icon-list"></i> Family Details</h3>
							</div>
							
						
							<div class="box-content nopadding">
								
								
								
					<?php  foreach($family_data as $i => $family): ?>

				<?php if($family['HrFamily']['relative_name'] != ''): ?>
							
							<?php if($i > 0):
							$border = "border-top:1px solid #ddd";
							$clear = "clear:both";
							endif; ?>
									<div class="span6" style="<?php echo $clear; ?>">
									
									
										<div class="control-group" style="<?php echo $border;?>">
											<label for="textfield" class="control-label">Name </label>
											<div class="controls">
										
											<?php echo $family['HrFamily']['relative_name']; ?>
											</div>
										</div>
										
										<div class="control-group">
											<label for="textfield" class="control-label">Date of Birth</label>
											<div class="controls">
										
					<?php echo $this->Functions->format_date($family['HrFamily']['dob']); ?>
											</div>
										</div>
										
										
										
										
									
										
									</div>
									
									
						
									

									<div class="span6">									
										
								<div class="control-group" style="<?php echo $border;?>">
		<label for="textfield" class="control-label">Relationship  </label>
											<div class="controls">
				<?php echo $this->Functions->get_family_relation($family['HrFamily']['relationship']); ?>
											</div>
										</div>
										
										
										
										
											<div class="control-group">
											<label for="textfield" class="control-label">Address</label>
											<div class="controls">
							<?php echo $family['HrFamily']['address']; ?>
							
						
													
												
											</div>
										</div>
									
										
								
									</div>
					
					<?php endif; ?>
		
					<?php endforeach; ?>
					
					
						
					
										
								
								
							</div>
							
							<div class="span12">
										<div class="form-actions">
											<a href="<?php echo $this->webroot;?>hremployee/edit_employee/family/<?php echo $this->request->params['pass'][0];?>/">
											<button type="button" class="btn btn-primary"><i class="icon-edit"></i> Edit</button></a>
											<a href="<?php echo $this->webroot;?>hremployee/"><button type="button" class="btn"><i class="icon-arrow-left"></i>  Go Back</button></a>
										</div>
									</div>
							
						</div>
				
						
									
							
						</div>
					
					
					
					<input type="hidden" id="load_tab">
					
					<!--input type="hidden" id="end_date" value="<?php echo date('d/m/Y', strtotime((date('Y')-16).'-'.date('m').'-'.date('d')));?>"-->
					
					<?php echo $this->Form->end(); ?>
					
				</div>
					</div>
		
			</div>		
					
				</div>
		
			
		
<div id="dialog-confirm" title="Approve Confirmation!" class="dn">
	<p>Are you sure you want to approve?</p>
</div>	

<div id="dialog-rej-confirm" title="Reject Confirmation!" class="dn">
	<p>Are you sure you want to reject?</p>
		<?php echo $this->Form->input('HrEmployee.remarks', array('div'=> false,'type' => 'textarea', 'label' => false, 'class' => 'input-block-level', 'id' => 'remarks', 'required' => false, 'placeholder' => '', 'rows' => '4', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
</div>		
	
