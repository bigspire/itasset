<?php echo $this->element('hr_menu'); ?>
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>View Holiday</h1>
					</div>
					
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>hrhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="<?php echo $this->webroot;?>hrholiday/">Holidays</a>
								<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="#">View Holiday</a>
						</li>
					</ul>
					
				</div>
				
					<div class="row-fluid footer_div">
					<div class="span12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3><i class="icon-list"></i> View Holiday Details</h3>
							</div>
							<div class="box-content nopadding">
								
								
								<?php echo $this->Form->create('HrHoliday', array('id' => '', 'class' => 'form-horizontal form-column form-bordered')); ?>
								
								
														<div class="span6">
									
								
										
										
										<div class="control-group">
											<label for="textfield" class="control-label">Branch Name <span class="red_star">*</span></label>
											<div class="controls">
										
										
									<?php echo $holiday_data['HrBranch']['branch_name'];?>
									
									
								
											</div>
										</div>
										
											<div class="control-group">
											<label for="textfield" class="control-label">Event Name <span class="red_star">*</span></label>
											<div class="controls">
						<?php echo $holiday_data['HrHoliday']['event'];?>
 
											</div>
										</div>
										
											
											<div class="control-group">
											<label for="textfield" class="control-label">Description </label>
											<div class="controls">
										
													<?php echo $holiday_data['HrHoliday']['desc'];?>
											</div>
										</div>
					
										
										
									
										
									</div>
								

<div class="span6">									
										
								<div class="control-group">
											<label for="textfield" class="control-label">Event Date <span class="red_star">*</span></label>
											<div class="controls">
										
								<?php echo $this->Functions->format_date($holiday_data['HrHoliday']['event_date']);?>
											</div>
										</div>		
										
										<div class="control-group">
											<label for="textfield" class="control-label">Status <span class="red_star">*</span></label>
											<div class="controls">
												<?php echo $this->Functions->show_status($holiday_data['HrHoliday']['status']);?>
											</div>
										</div>
									
									
								
									</div>


								<div class="span12">
										<div class="form-actions">
											<a href="<?php echo $this->webroot;?>hrholiday/edit_holiday/<?php echo $this->request->params['pass'][0];?>/">
											<button type="button" class="btn btn-primary"><i class="icon-edit"></i>  Edit</button></a>
											<a href="<?php echo $this->webroot;?>hrholiday/"><button type="button" class="btn"><i class="icon-arrow-left"></i> Go Back</button></a>
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
			
		
	

