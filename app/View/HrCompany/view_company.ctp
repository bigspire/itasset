<?php echo $this->element('hr_menu'); ?>
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>View Company</h1>
					</div>
					
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>hrhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="<?php echo $this->webroot;?>hrcompany/">Company</a>
								<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="#">View Company</a>
						</li>
					</ul>
					
				</div>
				
					<div class="row-fluid  footer_div">
					<div class="span12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3><i class="icon-list"></i> View Company Details</h3>
							</div>
							<div class="box-content nopadding">								
								
								<?php echo $this->Form->create('HrCompany', array('id' => '', 'class' => 'form-horizontal form-column form-bordered')); ?>								
								
									<div class="span6">
									
										<div class="control-group">
											<label for="textfield" class="control-label">Company Name</label>
											<div class="controls">
													<?php echo $comp_data['HrCompany']['company_name'];?>
											</div>
											
										</div>
										<div class="control-group">
											<label for="password" class="control-label">Logo </label>
											<div class="controls">
											
							<?php if($comp_data['HrCompany']['logo'] != ''):?>
							<img class="nav-user-photo" src="<?php echo $this->webroot;?>timthumb.php?src=uploads/company/<?php echo $comp_data['HrCompany']['logo'];?>&h=40&q=100"/>
							<?php endif; ?>
							
							
											
											</div>
										</div>
										
										<div class="control-group">
											<label for="textfield" class="control-label">Landline </label>
											<div class="controls">
												<?php echo $comp_data['HrCompany']['landline'];?> 
											</div>
										</div>
										
										<div class="control-group">
											<label for="textfield" class="control-label">Mobile </label>
											<div class="controls">
												<?php echo $comp_data['HrCompany']['mobile'];?> 
											</div>
										</div>
										<div class="control-group">
											<label for="textfield" class="control-label">Address </label>
											<div class="controls">
												<?php echo $comp_data['HrCompany']['address'];?> 
											</div>
										</div>
									<div class="control-group">
											<label for="password" class="control-label">City </label>
											<div class="controls">
												<?php echo $comp_data['HrCompany']['city'];?>
												
												
											</div>
										</div>
										
												<div class="control-group">
											<label for="password" class="control-label">State </label>
											<div class="controls">
												<?php echo $comp_data['HrCompany']['city'];?>
												
												
											</div>
										</div>
										
												<div class="control-group">
											<label for="password" class="control-label">Pincode </label>
											<div class="controls">
												<?php echo $comp_data['HrCompany']['pincode'];?>
												
												
											</div>
										</div>
										<div class="control-group">
											<label for="password" class="control-label">Website </label>
											<div class="controls">
												<?php echo $comp_data['HrCompany']['website'];?>
												
												
											</div>
										</div>
										
										
												<div class="control-group">
											<label for="password" class="control-label">TAN </label>
											<div class="controls">
												<?php echo $comp_data['HrCompany']['tan'];?>
												
												
											</div>
										</div>
									</div>
									<div class="span6">
										
									
									
										
										
													<div class="control-group">
											<label for="password" class="control-label">PAN </label>
											<div class="controls">
												<?php echo $comp_data['HrCompany']['pan'];?>
												
												
											</div>
										</div>
									
												<div class="control-group">
											<label for="password" class="control-label">Service Reg. No. </label>
											<div class="controls">
												<?php echo $comp_data['HrCompany']['service_reg_no'];?>
												
												
											</div>
										</div>
										
													<div class="control-group">
											<label for="password" class="control-label">Company Reg. No. </label>
											<div class="controls">
												<?php echo $comp_data['HrCompany']['company_reg_no'];?>
												
												
											</div>
										</div>
										
												<div class="control-group">
											<label for="password" class="control-label">Bank Name </label>
											<div class="controls">
												<?php echo $comp_data['HrCompany']['bank_name'];?>
												
												
											</div>
										</div>
										
										
												<div class="control-group">
											<label for="password" class="control-label">Account Name </label>
											<div class="controls">
												<?php echo $comp_data['HrCompany']['account_name'];?>
												
												
											</div>
										</div>
										
										
										
												<div class="control-group">
											<label for="password" class="control-label">Account No. </label>
											<div class="controls">
												<?php echo $comp_data['HrCompany']['account_no'];?>
												
												
											</div>
										</div>
										
										
										
												<div class="control-group">
											<label for="password" class="control-label">Branch Address </label>
											<div class="controls">
											<?php echo $comp_data['HrCompany']['branch_address'];?>
												
												
											</div>
										</div>
										
										
											<div class="control-group">
											<label for="password" class="control-label">IFSC Code </label>
											<div class="controls">
												<?php echo $comp_data['HrCompany']['ifsc_code'];?>
												
												
											</div>
										</div>
										
											<div class="control-group">
											<label for="password" class="control-label">Swift Code</label>
											<div class="controls">
											<?php echo $comp_data['HrCompany']['swift_code'];?>
												
												
											</div>
										</div>
										
										
									</div>
									<div class="span12">
										<div class="form-actions">
											<a href="<?php echo $this->webroot;?>hrcompany/edit_company/<?php echo $this->request->params['pass'][0];?>/">
											<button type="button" class="btn btn-primary"><i class="icon-edit"></i> Edit</button></a>
											<a href="<?php echo $this->webroot;?>hrcompany/"><button type="button" class="btn"><i class="icon-arrow-left"></i> Go Back</button></a>
											
											
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
			
		
	

