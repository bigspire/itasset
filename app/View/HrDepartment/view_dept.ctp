<?php echo $this->element('hr_menu'); ?>
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>View Department</h1>
					</div>
					
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>hrhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="<?php echo $this->webroot;?>hrdepartment/">View Department</a>
								<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="#">View Department</a>
						</li>
					</ul>
					
				</div>
				
					<div class="row-fluid">
					<div class="span12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3><i class="icon-list"></i> View Department Details</h3>
							</div>
							<div class="box-content nopadding">
								
								
								<?php echo $this->Form->create('HrDepartment', array('id' => '', 'class' => 'form-horizontal form-column form-bordered')); ?>
								
								
									<div class="span6">
										<div class="control-group">
											<label for="textfield" class="control-label">Department </label>
											<div class="controls">
													<?php echo $dept_data['HrDepartment']['dept_name'];?>
													
												
											</div>
										</div>
										<div class="control-group">
											<label for="password" class="control-label">Description </label>
											<div class="controls">
												<?php echo $dept_data['HrDepartment']['dept_desc'];?>
											</div>
										</div>
									
										
									</div>
									<div class="span6">
									
									
										
												<div class="control-group">
											<label for="password" class="control-label">Status </label>
											<div class="controls">
												<?php echo $this->Functions->show_status($dept_data['HrDepartment']['status']);?>
												
												
											</div>
										</div>
										
										
									</div>
									<div class="span12">
										<div class="form-actions">
											
											<?php if($dept_data['HrDepartment']['id'] != '4' && $dept_data['HrDepartment']['id'] != '14'): ?>
											<a href="<?php echo $this->webroot;?>hrdepartment/edit_dept/<?php echo $this->request->params['pass'][0];?>/">
											<button type="button" class="btn btn-primary"><i class="icon-edit"></i> Edit</button></a>
											<?php endif; ?>
											<a href="<?php echo $this->webroot;?>hrdepartment/"><button type="button" class="btn"><i class="icon-arrow-left"></i> Go Back</button></a>
											
										
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
			
		
	

