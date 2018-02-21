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
					
						<form action="post.php" method="POST" class="form-horizontal form-wizard ui-formwizard" id="ss" novalidate="novalidate">
									<div class="step ui-formwizard-content" id="firstStep" style="width:99%;margin-top:20px;">
										<ul class="wizard-steps steps-4">
											<li class="active">
												<div class="single-step">
													<span class="title">
														1</span>
													<span class="circle">
														<span class="active"></span>
													</span>
													<span class="description">
														Personal
													</span>
												</div>
											</li>
											<li>
												<div class="single-step">
													<span class="title">
														2</span>
													<span class="circle">
													</span>
													<span class="description">
														Educational 													</span>
												</div>
											</li>
											<li>
												<div class="single-step">
													<span class="title">
														3</span>
													<span class="circle">
													</span>
													<span class="description">
														Previous Work
													</span>
												</div>
											</li>
											<li>
												<div class="single-step">
													<span class="title">
														4</span>
													<span class="circle">
													</span>
													<span class="description">
														Family
													</span>
												</div>
											</li>
											
									
											
											<li>
												<div class="single-step">
													<span class="title">
														6</span>
													<span class="circle">
													</span>
													<span class="description">
														Verify
													</span>
												</div>
											</li>
										</ul>
									</div>
								
								</form>
								
					<?php echo $this->Form->create('HrEmployee', array('id' => 'formID', 'type' => 'file', 'class' => 'form-horizontal form-column form-bordered')); ?>
								
									
									
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3><i class="icon-list"></i> Personal Details</h3>
							</div>
							
						
							<div class="box-content nopadding">
								
								
								
								
								
									<div class="span6">
									
										<div class="control-group">
											<label for="textfield" class="control-label">Company <span class="red_star">*</span></label>
											<div class="controls">
												<?php echo $this->Form->input('hr_company_id', array('div'=> false,'type' => 'select', 'label' => false, 'class' => 'input-xlarge', 'empty' => 'Select', 'required' => false, 'placeholder' => '', 'style' => "clear:left", 'options' => $compList, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 	
											</div>
										</div>
										
										
										<div class="control-group">
											<label for="textfield" class="control-label">First Name <span class="red_star">*</span></label>
											<div class="controls">
										
													<?php echo $this->Form->input('first_name', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											</div>
										</div>
										
										
											<div class="control-group">
											<label for="textfield" class="control-label">Last Name <span class="red_star">*</span></label>
											<div class="controls">
										
													<?php echo $this->Form->input('last_name', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											</div>
										</div>
										
										
											<div class="control-group">
											<label for="textfield" class="control-label">Email <span class="red_star">*</span></label>
											<div class="controls">
													<?php echo $this->Form->input('email_address', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
													
												
											</div>
										</div>
										
											<div class="control-group">
											<label for="textfield" class="control-label">Emp. Code <span class="red_star">*</span></label>
											<div class="controls">
													<?php echo $this->Form->input('emp_no', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
													
												
											</div>
										</div>
										
									
										
									</div>
									
									

									
									

<div class="span6">									
										
						<div class="control-group">
											<label for="password" class="control-label">Photo </label>
											<div class="controls">
												<?php echo $this->Form->input('pic', array('div'=> false,'type' => 'file', 'label' => false, 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												
												
											</div>
										</div>

										
											<div class="control-group">
											<label for="textfield" class="control-label">Gender <span class="red_star">*</span></label>
											<div class="controls">
												<?php echo $this->Form->input('gender', array('div'=> false,'type' => 'radio', 'label' => false, 'class' => 'input-xlarge',  'options' => array('M' => 'Male', 'F' => 'Female'), 'separator' => ' ',  'required' => false, 'placeholder' => '', 'legend' => false, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											</div>
										</div>
									
									
									<div class="control-group">
											<label for="password" class="control-label">DOJ <span class="red_star">*</span></label>
											<div class="controls">
												<?php echo $this->Form->input('doj', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-xlarge datepick',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											</div>
										</div>

										
									
										<div class="control-group">
											<label for="password" class="control-label">DOB <span class="red_star">*</span></label>
											<div class="controls">
												<?php echo $this->Form->input('dob', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-xlarge datepick',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											</div>
										</div>

										
										
										
										
										
										<div class="control-group">
											<label for="textfield" class="control-label">Status <span class="red_star">*</span></label>
											<div class="controls">
													<?php echo $this->Form->input('status', array('div'=> false,'type' => 'select', 'label' => false, 'class' => 'input-xlarge', 'empty' => 'Select', 'required' => false, 'placeholder' => '', 'style' => "clear:left", 'options' => array('1' => 'Active', '0' => 'Inactive'), 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											</div>
										</div>
									
									
								
									</div>


										
										
								
								
							</div>
						</div>
					<div class="box box-color box-bordered">
							<div class="box-title">
								<h3><i class="icon-list"></i> Professional Details</h3>
							</div>
							<div class="box-content nopadding">
								
								
							
								
								
									<div class="span6">
									
										
									<div class="control-group">
											<label for="textfield" class="control-label">Department <span class="red_star">*</span></label>
											<div class="controls">
												<?php echo $this->Form->input('hr_department_id', array('div'=> false,'type' => 'select', 'label' => false, 'class' => 'input-xlarge', 'empty' => 'Select', 'required' => false, 'placeholder' => '', 'style' => "clear:left", 'options' => $deptList, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 	
											</div>
										</div>
									

	<div class="control-group">
											<label for="textfield" class="control-label">Designation <span class="red_star">*</span></label>
											<div class="controls">
												<?php echo $this->Form->input('hr_designation_id', array('div'=> false,'type' => 'select', 'label' => false, 'class' => 'input-xlarge', 'empty' => 'Select', 'required' => false, 'placeholder' => '', 'style' => "clear:left", 'options' => $desigList, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 	
											</div>
										</div>		
										
									
										
										
									
										
									</div>
									
									

									
									

<div class="span6">									
							


										

											



										
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
										
										
									
									
									
								
									</div>


									<div class="span12">
										<div class="form-actions">
											<input type="submit" value="Next" class="btn btn-primary">
											<a href="<?php echo $this->webroot;?>hremployee/"><button type="button" class="btn">Cancel</button></a>
											
										</div>
										
										
								
								
							</div>
						</div>
					
					
					
					
					<input type="hidden" id="end_date" value="<?php echo date('d/m/Y', strtotime((date('Y')-16).'-'.date('m').'-'.date('d')));?>">
					<?php echo $this->Form->end(); ?>
					
				</div>
					</div>
		
			</div>		
					
				</div>
		
			</div>	
		
	
