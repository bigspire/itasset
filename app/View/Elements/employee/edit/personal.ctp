<?php echo $this->element('hr_menu'); ?>
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Edit Employee</h1>
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
							<a href="#">Edit Employee</a>
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
											<label for="textfield" class="control-label">Company <span class="red_star">*</span></label>
											<div class="controls">
												<?php echo $this->Form->input('hr_company_id', array('div'=> false,'type' => 'select', 'selected' => $this->Session->read('personal.hr_company_id'),'label' => false, 'class' => 'input-xlarge', 'empty' => 'Select', 'required' => false, 'placeholder' => '', 'style' => "clear:left", 'options' => $compList, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 	
											</div>
										</div>
										
										
										<div class="control-group">
											<label for="textfield" class="control-label">First Name <span class="red_star">*</span></label>
											<div class="controls">
										
													<?php echo $this->Form->input('first_name', array('div'=> false,'type' => 'text', 'value' => $this->Session->read('personal.first_name'),  'label' => false, 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											</div>
										</div>
										
										
											<div class="control-group">
											<label for="textfield" class="control-label">Last Name <span class="red_star">*</span></label>
											<div class="controls">
										
													<?php echo $this->Form->input('last_name', array('div'=> false,'type' => 'text', 'value' => $this->Session->read('personal.last_name'),'label' => false, 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											</div>
										</div>
										
										
											<div class="control-group">
											<label for="textfield" class="control-label">Email <span class="red_star">*</span></label>
											<div class="controls">
													<?php echo $this->Form->input('email_address', array('div'=> false,'type' => 'text', 'value' => $this->Session->read('personal.email_address'), 'label' => false, 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
													
												
											</div>
										</div>
										
									
											
										
										
										
											<div class="control-group">
											<label for="textfield" class="control-label">Emp. Code <span class="red_star">*</span></label>
											<div class="controls">
													<?php echo $this->Form->input('emp_no', array('div'=> false,'type' => 'text', 'value' => $this->Session->read('personal.emp_no'), 'label' => false, 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
													
												
											</div>
										</div>
										
												
									<div class="control-group">
											<label for="textfield" class="control-label">Department <span class="red_star">*</span></label>
											<div class="controls">
												<?php echo $this->Form->input('hr_department_id', array('div'=> false,'type' => 'select', 'label' => false, 'class' => 'input-xlarge', 'empty' => 'Select', 'selected' => $this->Session->read('personal.hr_department_id'), 'required' => false, 'placeholder' => '', 'style' => "clear:left", 'options' => $deptList, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 	
											</div>
										</div>
									

	<div class="control-group">
											<label for="textfield" class="control-label">Designation <span class="red_star">*</span></label>
											<div class="controls">
												<?php echo $this->Form->input('hr_designation_id', array('div'=> false,'type' => 'select','selected' => $this->Session->read('personal.hr_designation_id'), 'label' => false, 'class' => 'input-xlarge', 'empty' => 'Select', 'required' => false, 'placeholder' => '', 'style' => "clear:left", 'options' => $desigList, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 	
											</div>
										</div>	
									
									<div class="control-group">
											<label for="textfield" class="control-label">Business Unit <span class="red_star">*</span></label>
											<div class="controls">
												<?php echo $this->Form->input('hr_business_unit_id', array('div'=> false,'type' => 'select','selected' => $this->Session->read('personal.hr_business_unit_id'), 'label' => false, 'class' => 'input-xlarge', 'empty' => 'Select', 'required' => false, 'placeholder' => '', 'style' => "clear:left", 'options' => $businessList, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 	
											</div>
										</div>	
									
									
									<div class="control-group">
											<label for="textfield" class="control-label">Mobile No. (Office) <span class="red_star">*</span></label>
											<div class="controls">
													<?php echo $this->Form->input('official_contact_no', array('div'=> false,'type' => 'text', 'value' => $this->Session->read('personal.official_contact_no'),'label' => false, 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
													
												
											</div>
										</div>
									
									
										<div class="control-group">
											<label for="textfield" class="control-label">Mobile No. (Personal) <span class="red_star">*</span></label>
											<div class="controls">
													<?php echo $this->Form->input('contact_no', array('div'=> false,'type' => 'text', 'value' => $this->Session->read('personal.contact_no'),'label' => false, 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
													
												
											</div>
										</div>
										
										
										
										
									<div class="control-group">
											<label for="textfield" class="control-label">Landline </label>
											<div class="controls">
													<?php echo $this->Form->input('landline', array('div'=> false,'type' => 'text', 'value' => $this->Session->read('personal.landline'), 'label' => false, 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
													
												
											</div>
										</div>
										
										
										
									
									<div class="control-group">
											<label for="textfield" class="control-label">Personal Email <span class="red_star">*</span></label>
											<div class="controls">
													<?php echo $this->Form->input('personal_email', array('div'=> false,'type' => 'text', 'value' => $this->Session->read('personal.personal_email'),'label' => false, 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
													
												
											</div>
										</div>
											<div class="control-group">
											<label for="textfield" class="control-label">Present Address <span class="red_star">*</span></label>
											<div class="controls">
													<?php echo $this->Form->input('communication_addr', array('div'=> false,'type' => 'textarea', 'value' => $this->Session->read('personal.communication_addr'),'rows' => '2',  'label' => false, 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
													
												
											</div>
										</div>
										
										<div class="control-group">
											<label for="textfield" class="control-label">Permanent Address <span class="red_star">*</span></label>
											<div class="controls">
													<?php echo $this->Form->input('permanent_addr', array('div'=> false,'type' => 'textarea',  'value' => $this->Session->read('personal.permanent_addr'), 'rows' => '2',  'label' => false, 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
													
												
											</div>
										</div>
										
											<div class="control-group">
											<label for="textfield" class="control-label">Marital Status <span class="red_star">*</span></label>
											<div class="controls">
													<?php echo $this->Form->input('marital_status', array('div'=> false,'type' => 'text', 'empty' => 'Select',  'type' => 'select',  'label' => false, 'selected' => $this->Session->read('personal.marital_status'),'class' => 'input-xlarge', 'options' => array('1' => 'Single', '2' => 'Married'),  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
													
												
											</div>
										</div>
										
										<div class="control-group">
											<label for="password" class="control-label">Wedding Date </label>
											<div class="controls">
												<?php echo $this->Form->input('wedding_date', array('div'=> false,'type' => 'text', 'label' => false, 'value' => $this->Session->read('personal.wedding_date'),'class' => 'input-xlarge datepick',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?>  dd/mm/yyyy 
											</div>
										</div>
										
											<div class="control-group">
											<label for="textfield" class="control-label">Blood Group <span class="red_star">*</span></label>
											<div class="controls">
													<?php echo $this->Form->input('hr_blood_group_id', array('div'=> false,'type' => 'select', 'label' => false, 'class' => 'input-xlarge', 'empty' => 'Select', 'selected' => $this->Session->read('personal.hr_blood_group_id'),'required' => false, 'placeholder' => '', 'style' => "clear:left", 'options' => $bloodList, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 	
													
												
											</div>
										</div>
										
											<div class="control-group">
											<label for="textfield" class="control-label">Att. Type <span class="red_star">*</span></label>
											<div class="controls">
													<?php echo $this->Form->input('att_type', array('div'=> false,'type' => 'select', 'label' => false, 'class' => 'input-xlarge', 'empty' => 'Select', 'required' => false, 'placeholder' => '', 'style' => "clear:left", 'options' => $att_types, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											</div>
										</div>
										
										<div class="control-group">
											<label for="textfield" class="control-label">Status <span class="red_star">*</span></label>
											<div class="controls">
													<?php echo $this->Form->input('status', array('div'=> false,'type' => 'select', 'selected' => $this->Session->read('personal.status'),'label' => false, 'class' => 'input-xlarge', 'empty' => 'Select', 'default' => '1', 'required' => false, 'placeholder' => '', 'style' => "clear:left", 'options' => array('1' => 'Active', '0' => 'Inactive'), 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											</div>
										</div>
										
										
									</div>
									
									

									
									

<div class="span6">		

	<div class="control-group">
											<label for="textfield" class="control-label">Gender <span class="red_star">*</span></label>
											<div class="controls">
												<?php echo $this->Form->input('gender', array('div'=> false,'type' => 'radio', 'label' => false, 'class' => 'input-xlarge regGender',  'options' => array('M' => 'Male',  'F' => 'Female'), 'value' => $this->Session->read('personal.gender'), 'separator' => ' ',  'required' => false, 'placeholder' => '', 'legend' => false, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											</div>
										</div>
										
										
						<div class="control-group">
											<label for="password" class="control-label">Photo </label>
											<div class="controls">
												
											
						<div class="fileUpload btn btn-darkblue btn-minier" align="center">
				<span>Upload Photo</span>
				<?php echo $this->Form->input('upload_file', array('type' => 'file', 'label' => false, 'value' => '', 'class' => 'upload',  'id' => 'uploadFile'));?>
				
				</div>
				<?php if($this->request->data['HrEmployee']['photo'] != ''):?>
				<button type="button"  class="regRmPic btn btn-minier"> Remove </button>
				<?php endif; ?>
				
				<button type="button"  class="regRmPic btn btn-minier dn"> Remove </button>
				
				<button type="button"  class="dn submitUpload btn btn-darkblue btn-minier">	Submit
				</button>
				<button type="button"  class="dn btn btn-warning btn-minier processBtn">	Processing...
				</button>
				<a href="javascript:void(0)"  class="dn submitUploadCan">Cancel</a>
					
				
				
			<div style="clear:both;margin-top:10px;">	
			<?php if($this->request->data['HrEmployee']['photo'] != ''):?>
			<img class="nav-user-photo thumb othumb" src="<?php echo $this->webroot;?>timthumb.php?src=uploads/photo/<?php echo $this->request->data['HrEmployee']['photo'];?>&h=90&q=100"/>	
			<?php elseif($this->request->data['HrEmployee']['gender'] == 'M' && $this->request->data['HrEmployee']['photo'] == ''):?>
			<img id="avatar" class="editable othumb thumb dthumb img-responsive editable-click editable-empty" width="70" height="90" src="<?php echo $this->webroot;?>img/profile_male.png"/>
			<?php elseif($this->request->data['HrEmployee']['gender'] == 'F' && $this->request->data['HrEmployee']['photo'] == ''): ?>
			<img id="avatar" class="thumb editable othumb dthumb img-responsive editable-click editable-empty" width="70" height="90" src="<?php echo $this->webroot;?>img/profile_female.png"/>
			<?php endif; ?>		
			
			<?php if($this->request->data['HrEmployee']['photo'] == ''):?>
			<img id="avatar" class="editable thumb mthumb img-responsive editable-click editable-empty dn" width="70" height="90" src="<?php echo $this->webroot;?>img/profile_male.png"/>
			<img id="avatar" class="thumb editable fthumb img-responsive editable-click editable-empty dn" width="70" height="90" src="<?php echo $this->webroot;?>img/profile_female.png"/>
			<?php endif; ?>
			
			<img class="dn" id="profilePic"/>
			
				<span id="file_name"></span>
				<span style="color:#ff0000" class="dn file_error"></span>	

					</div>
											</div>
										</div>

										
										
									
									
										<div class="control-group">
											<label for="password" class="control-label">DOB <span class="red_star">*</span></label>
											<div class="controls">
												<?php echo $this->Form->input('dob', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-xlarge datepick',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?>  dd/mm/yyyy 
											</div>
										</div>
										
										
										
										
										
									<div class="control-group">
											<label for="password" class="control-label">DOJ <span class="red_star">*</span></label>
											<div class="controls">
												<?php echo $this->Form->input('doj', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-xlarge datepick',  'required' => false,'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?>  dd/mm/yyyy 
											</div>
										</div>
										
								<div class="control-group">
											<label for="password" class="control-label">DOC <span class="red_star">*</span></label>
											<div class="controls">
												<?php echo $this->Form->input('doc', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-xlarge datepick',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?>  dd/mm/yyyy 
											</div>
										</div>

<div class="control-group">
											<label for="textfield" class="control-label">Probation Review <span class="red_star">*</span></label>
											<div class="controls">
											<?php
												echo $this->Form->input('probation', array('div'=> false,'type' => 'radio', 'label' => false, 'class' => 'input-xlarge',  'options' => array('Y' => 'Probation',  'C' => 'Confirmed'), 'value' => $this->Session->read('personal.probation'), 'separator' => ' ',  'required' => false, 'placeholder' => '', 'legend' => false, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											</div>
										</div>			
									
										<div class="control-group">
											<label for="textfield" class="control-label">Role <span class="red_star">*</span></label>
											<div class="controls">
												<?php echo $this->Form->input('app_roles_id', array('div'=> false,'type' => 'select', 'label' => false, 'class' => 'input-xlarge', 'empty' => 'Select', 'required' => false, 'placeholder' => '', 'style' => "clear:left", 'options' => $roleList, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 	
											</div>
										</div>
										
											<div class="control-group">
											<label for="textfield" class="control-label">Branch <span class="red_star">*</span></label>
											<div class="controls">
												<?php echo $this->Form->input('hr_branch_id', array('div'=> false,'type' => 'select', 'label' => false, 'class' => 'input-xlarge', 'empty' => 'Select', 'required' => false, 'placeholder' => '', 'style' => "clear:left", 'options' => $branchList, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 	
											</div>
										</div>
										
																				<div class="control-group">
											<label for="textfield" class="control-label">Skype </label>
											<div class="controls">
													<?php echo $this->Form->input('skype', array('div'=> false,'type' => 'text',  'label' => false, 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
													
												
											</div>
										</div>
										
											<div class="control-group">
											<label for="textfield" class="control-label">PAN No. </label>
											<div class="controls">
													<?php echo $this->Form->input('pan', array('div'=> false,'type' => 'text', 'label' => false,'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
													
												
											</div>
										</div>
										
											<div class="control-group">
											<label for="textfield" class="control-label">Insurance No. </label>
											<div class="controls">
													<?php echo $this->Form->input('insurance_no', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
													
												
											</div>
										</div>
										
										<div class="control-group">
											<label for="textfield" class="control-label">PF No. </label>
											<div class="controls">
													<?php echo $this->Form->input('pf_no', array('div'=> false,'type' => 'text','label' => false, 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
													
												
											</div>
										</div>
										
										
									<div class="control-group">
											<label for="textfield" class="control-label">ESI No. </label>
											<div class="controls">
													<?php echo $this->Form->input('esi_no', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
													
												
											</div>
										</div>
										
											
										
										<div class="control-group">
											<label for="textfield" class="control-label">Emerg. Contact Person </label>
											<div class="controls">
													<?php echo $this->Form->input('emergency_contact_person', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
													
												
											</div>
										</div>
										
											<div class="control-group">
											<label for="textfield" class="control-label">Emergency Contact Relation </label>
											<div class="controls">
													<?php echo $this->Form->input('emergency_relation', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
													
												
											</div>
										</div>
										
										<div class="control-group">
											<label for="textfield" class="control-label">Emergency Contact No. </label>
											<div class="controls">
													<?php echo $this->Form->input('emergency_contact_no', array('div'=> false,'type' => 'text','label' => false, 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
													
												
											</div>
										</div>
										
										<div class="control-group">
											<label for="textfield" class="control-label">Att. Approval? <span class="red_star">*</span></label>
											<div class="controls">
													<?php echo $this->Form->input('att_approve', array('div'=> false,'type' => 'select', 'label' => false, 'class' => 'input-xlarge', 'empty' => 'Select', 'required' => false, 'placeholder' => '', 'style' => "clear:left", 'options' => array('1' => 'Yes', '0' => 'No'), 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											</div>
										</div>		
									<div class="control-group">
											<label for="textfield" class="control-label">Type <span class="red_star">*</span></label>
											<div class="controls">
													<?php echo $this->Form->input('emp_type', array('div'=> false,'type' => 'select', 'label' => false, 'class' => 'input-xlarge empType', 'empty' => 'Select', 'default' => '1', 'required' => false, 'placeholder' => '', 'style' => "clear:left", 'options' => $emp_types, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											</div>
										</div>
										
									<div class="dn" id="associateDiv">
									
									<div class="control-group">
											<label for="textfield" class="control-label">Place of Work <span class="red_star">*</span></label>
											<div class="controls">
													<?php echo $this->Form->input('work_place', array('div'=> false,'type' => 'select', 'label' => false, 'class' => 'input-xlarge', 'empty' => 'Select', 'default' => '1', 'required' => false, 'placeholder' => '', 'style' => "clear:left", 'options' => array('C' => 'Client Place', 'O' => 'Our Company'), 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											</div>
										</div>	
										
											<div class="control-group">
											<label for="textfield" class="control-label">Contract Period <span class="red_star">*</span></label>
											<div class="controls">
													From <?php echo $this->Form->input('contract_from', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-medium datepick','required' => false, 'placeholder' => '', 'style' => "clear:left", 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
													To <?php echo $this->Form->input('contract_to', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-medium datepick',  'required' => false, 'placeholder' => '', 'style' => "clear:left", 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 

											</div>
										</div>	
									</div>
										
								
									</div>


										
										
				<div class="span12">
					<div class="form-actions">
				
					 <?php echo $this->Form->submit('Save ', array('div'=> false,  'label' => false, 'class' => 'btn btn-blue')); ?> 
					<a href="<?php echo $this->webroot;?>hremployee/view_employee/<?php echo $this->request->params['pass'][1];?>#personal"><button type="button" class="btn">Cancel</button></a>
											
										</div>
									</div>	
								
					</div>
				</div>
				


									
							
							
						</div>
					
					<input type="hidden" name="data[HrEmployee][rem_photo]" id="rem_photo">
					
					<input type="hidden" name="data[HrEmployee][reg_confirm]" id="reg_confirm">
					
					
					
					<input type="hidden" id="new_user" value="1">
					
					<input type="hidden" id="webroot" value="<?php echo $this->webroot;?>">
					
					<!--input type="hidden" id="end_date" value="<?php echo date('d/m/Y', strtotime((date('Y')-16).'-'.date('m').'-'.date('d')));?>"-->
					<?php echo $this->Form->input('id', array('type' => 'hidden'));?>
					<?php echo $this->Form->end(); ?>
					
				</div>
					</div>
		
			</div>		
					
				</div>
		
			
		
	
