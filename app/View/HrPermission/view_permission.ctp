<?php echo $this->element('hr_menu'); ?>
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>View Permission Request</h1>
					</div>
					
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>hrhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="<?php echo $this->webroot;?>hrpermission/">Permission</a>
								<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="#">View Permission</a>
						</li>
					</ul>
					
				</div>
				
					<div class="row-fluid">
					<div class="span12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3><i class="icon-list"></i> View Permission Request</h3>
							</div>
							<div class="box-content nopadding">
								
								
								<?php echo $this->Form->create('HrPermission', array('id' => '', 'class' => 'form-horizontal form-column form-bordered')); ?>
								
								
									<div class="span6">
										<div class="control-group">
											<label for="textfield" class="control-label">Permission Date </label>
											<div class="controls">
													<?php echo $this->Functions->format_date($perm_data['HrPermission']['per_date']);?>
													
												
											</div>
										</div>
										<div class="control-group">
											<label for="password" class="control-label">From Time</label>
											<div class="controls">
												<?php echo $this->Functions->format_time_show($perm_data['HrPermission']['per_from']);?>
											</div>

											</div>
										<div class="control-group">
											<label for="password" class="control-label">Reason </label>
											<div class="controls">
												<?php echo $perm_data['HrPermission']['reason'];?>
												
												
											</div>
										</div>
									
										
									
										
									</div>
									<div class="span6">
									
										<div class="control-group">
											<label for="textfield" class="control-label">Total Hrs.</label>
											<div class="controls">
												<?php echo $this->Functions->display_hrs($perm_data['HrPermission']['no_hrs']);?> hrs 
											</div>
										</div>
										
																		
<div class="control-group">
											<label for="password" class="control-label">To Time </label>
											<div class="controls">
												<?php echo $this->Functions->format_time_show($perm_data['HrPermission']['per_to']);?>
											</div>
										</div>
									
									
									</div>
									<div class="span12">
										<div class="form-actions">
										
											<a href="<?php echo $this->webroot;?>hrpermission/"><button type="button" class="btn"><i class="icon-arrow-left"></i> Go Back</button></a>
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
			
		
	

