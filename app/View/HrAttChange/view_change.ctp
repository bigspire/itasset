<?php echo $this->element('hr_menu'); ?>
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>View Attendance Change Request</h1>
					</div>
					
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>hrhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="<?php echo $this->webroot;?>hrattchange/">Attendance Change</a>
								<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="#">View Attendance Change</a>
						</li>
					</ul>
					
				</div>
				
					<div class="row-fluid">
					<div class="span12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3><i class="icon-list"></i> View Attendance Change Request</h3>
							</div>
							<div class="box-content nopadding">
								
								
								<?php echo $this->Form->create('HrAttChange', array('id' => '', 'class' => 'form-horizontal form-column form-bordered')); ?>
								
								
									<div class="span12">
										<div class="control-group">
											<label for="textfield" class="control-label">Date </label>
											<div class="controls">
													<?php echo $this->Functions->format_date($att_data['HrAttChange']['att_date']);?>
													
												
											</div>
										</div>
								
										
									
										<div class="control-group">
											<label for="textfield" class="control-label">Type</label>
											<div class="controls">
												<?php echo $this->Functions->get_att_type($att_data['HrAttChange']['att_type']);?>
											</div>
										</div>
										
												
										<?php if(!empty($att_data['HrAttChange']['in_time'])):?>
										<div class="control-group">
											<label for="password" class="control-label">In Time</label>
											<div class="controls">
												<?php echo $this->Functions->format_time_show($att_data['HrAttChange']['in_time']);?>
											</div>

											</div>
										<?php endif; ?>
											
											
										<?php if(!empty($att_data['HrAttChange']['out_time'])):?>
											<div class="control-group">
											<label for="password" class="control-label">Out Time</label>
											<div class="controls">
												<?php echo $this->Functions->format_time_show($att_data['HrAttChange']['out_time']);?>
											</div>

											</div>
											<?php endif; ?>								

										<div class="control-group">
											<label for="password" class="control-label">Reason </label>
											<div class="controls">
												<?php echo $att_data['HrAttChange']['reason'];?>
												
												
											</div>
										</div>
									
									
									
									</div>
									
									
									<div class="span12">
										<div class="form-actions">
										
											<a href="<?php echo $this->webroot;?>hrattchange/"><button type="button" class="btn"><i class="icon-arrow-left"></i> Go Back</button></a>
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
			
		
	

