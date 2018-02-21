<?php echo $this->element('hr_menu'); ?>
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>View Survey</h1>
					</div>
					
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>hrhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="<?php echo $this->webroot;?>hrsurvey/">Survey</a>
								<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="#">View Survey</a>
						</li>
					</ul>
					
				</div>
				
					<div class="row-fluid footer_div">
					<div class="span12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3><i class="icon-list"></i> View Survey Details</h3>
							</div>
							<div class="box-content nopadding">
								
								
								<?php echo $this->Form->create('HrPoll', array('id' => '', 'class' => 'form-horizontal form-column form-bordered')); ?>
								
								
																
									<div class="span12">
									
									<div class="control-group">
											<label for="textfield" class="control-label">Start / End Date </label>
											<div class="controls">
										
													<?php echo $this->Functions->format_date($survey_data['HrSurvey']['start_date']);?>, 
													
												<?php echo $this->Functions->format_date($survey_data['HrSurvey']['end_date']);?>

													
											</div>
										</div>
										
										
										<div class="control-group">
											<label for="textfield" class="control-label">Description </label>
											<div class="controls">
										
													<?php echo $survey_data['HrSurvey']['desc'];?>
											</div>
										</div>
										
										<?php foreach($survey_question as $key =>  $qn):?>
											<div class="control-group">
											<label for="textfield" class="control-label">Question <?php echo ++$key; ?> </label>
											<div class="controls">
										
													<?php echo $qn['HrSurveyQuestion']['question']; ?> 
											</div>
										</div>
											<?php endforeach; ?>
											
											
		
										

										
										<div class="control-group">
											<label for="textfield" class="control-label">Status </label>
											<div class="controls">
														<?php echo $this->Functions->show_status($survey_data['HrSurvey']['status']);?>
											</div>
										</div>
									
									
								
									</div>


									
									
									<div class="span12">
										<div class="form-actions">
										
											<a href="<?php echo $this->webroot;?>hrsurvey/"><button type="button" class="btn"><i class="icon-arrow-left"></i> Go Back</button></a>
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
			
		
	

