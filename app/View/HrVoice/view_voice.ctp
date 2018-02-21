<?php echo $this->element('hr_menu'); ?>
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>View Voice</h1>
					</div>
					
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>hrhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="<?php echo $this->webroot;?>hrvoice/">Voice</a>
								<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="#">View Voice</a>
						</li>
					</ul>
					
				</div>
				
					<div class="row-fluid footer_div">
					<div class="span12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3><i class="icon-list"></i> View Voice Details</h3>
							</div>
							<div class="box-content nopadding">
								
								
								<?php echo $this->Form->create('HrVoice', array('id' => '', 'class' => 'form-horizontal form-column form-bordered')); ?>
								
								
																
									<div class="span12">
									
									<div class="control-group">
											<label for="textfield" class="control-label">Start / End Date </label>
											<div class="controls">
										
													<?php echo $this->Functions->format_date($voice_data['HrVoice']['start_date']);?>, 
													
												<?php echo $this->Functions->format_date($voice_data['HrVoice']['end_date']);?>

													
											</div>
										</div>
										
										
										<div class="control-group">
											<label for="textfield" class="control-label">Description </label>
											<div class="controls">
										
													<?php echo $voice_data['HrVoice']['desc'];?>
											</div>
										</div>
										
										
											
		
										

										
										<div class="control-group">
											<label for="textfield" class="control-label">Status </label>
											<div class="controls">
														<?php echo $this->Functions->show_status($voice_data['HrVoice']['status']);?>
											</div>
										</div>
									
									
								
									</div>


									
									
									<div class="span12">
										<div class="form-actions">
										
											<a href="<?php echo $this->webroot;?>hrvoice/"><button type="button" class="btn"><i class="icon-arrow-left"></i> Go Back</button></a>
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
			
		
	

