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
							<a href="<?php echo $this->webroot;?>hremployee/">View Employee</a>
								<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="#">View Employee</a>
						</li>
					</ul>
					
				</div>
				
					<div class="row-fluid  footer_div">
					<div class="span12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3><i class="icon-list"></i> View Employee Details</h3>
							</div>
							<div class="box-content nopadding">
								
								
								<?php echo $this->Form->create('HrEmployee', array('id' => '', 'class' => 'form-horizontal form-column form-bordered')); ?>
								
								
									<div class="span6">
									<div class="control-group">
											<label for="textfield" class="control-label">Company Name </label>
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
											<label for="password" class="control-label">Email </label>
											<div class="controls">
												<?php echo $emp_data['HrEmployee']['email_address'];?>
											</div>
										</div>
									<div class="control-group">
											<label for="textfield" class="control-label">DOB </label>
											<div class="controls">
												<?php echo $emp_data['HrEmployee']['dob'];?> 
											</div>
										</div>
									<div class="control-group">
											<label for="password" class="control-label">Photo </label>
											<div class="controls">
												<?php echo $emp_data['HrEmployee']['photo'];?>
												
												
											</div>
										</div>
										
									</div>
									<div class="span6">
										
									
												<div class="control-group">
											<label for="password" class="control-label">Department </label>
											<div class="controls">
												<?php echo $emp_data['HrDepartment']['dept_name'];?>
												
												
											</div>
										</div>
										
													<div class="control-group">
											<label for="password" class="control-label">Designation </label>
											<div class="controls">
												<?php echo $emp_data['HrDesignation']['desig_name'];?>
												
												
											</div>
										</div>
									
											
										
											<div class="control-group">
											<label for="password" class="control-label">Role </label>
											<div class="controls">
												<?php echo $emp_data['Role']['role_name'];?>
												
												
											</div>
										</div>
										
											<div class="control-group">
											<label for="password" class="control-label">Branch </label>
											<div class="controls">
												<?php echo $emp_data['HrBranch']['branch_name'];?>
												
												
											</div>
										</div>
										
													<div class="control-group">
											<label for="password" class="control-label">Company </label>
											<div class="controls">
												<?php echo $emp_data['HrCompany']['company_name'];?>
												
												
											</div>
										</div>
										
										
												<div class="control-group">
											<label for="password" class="control-label">Status </label>
											<div class="controls">
												<?php echo $this->Functions->show_status($emp_data['HrEmployee']['status']);?>
												
												
											</div>
										</div>
										
										
									</div>
									<div class="span12">
										<div class="form-actions">
											<a href="<?php echo $this->webroot;?>hremployee/edit_employee/<?php echo $this->request->params['pass'][0];?>/">
											<button type="button" class="btn btn-primary"><i class="icon-edit"></i> Edit</button></a>
											<a href="<?php echo $this->webroot;?>hremployee/"><button type="button" class="btn"><i class="icon-arrow-left"></i> Go Back</button></a>
											
											
											
										</div>
									</div>
								<?php echo $this->Form->end(); ?>
							</div>
						</div>
					</div>
				</div>
					
					
				</div>
		
			
			</div>
		</div>	
			
		
	

