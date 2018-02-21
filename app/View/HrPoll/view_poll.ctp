<?php echo $this->element('hr_menu'); ?>
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>View Poll</h1>
					</div>
					
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>hrhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="<?php echo $this->webroot;?>hrpoll/">View Poll</a>
								<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="#">View Poll</a>
						</li>
					</ul>
					
				</div>
				
					<div class="row-fluid footer_div">
					<div class="span12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3><i class="icon-list"></i> View Poll Details</h3>
							</div>
							<div class="box-content nopadding">
								
								
								<?php echo $this->Form->create('HrPoll', array('id' => '', 'class' => 'form-horizontal form-column form-bordered')); ?>
								
								
																
									<div class="span6">
									
								
										
										
										<div class="control-group">
											<label for="textfield" class="control-label">Question </label>
											<div class="controls">
										
													<?php echo $poll_data['HrPoll']['ques'];?>
											</div>
										</div>
										
											<div class="control-group">
											<label for="textfield" class="control-label">Option 1 </label>
											<div class="controls">
										
													<?php echo $poll_options[0]['HrPollOption']['value']; ?> 
											</div>
										</div>
											
												<div class="control-group">
											<label for="textfield" class="control-label">Option 2 </label>
											<div class="controls">
										
													<?php echo $poll_options[1]['HrPollOption']['value']; ?>  
											</div>
										</div>
										
											<div class="control-group">
											<label for="textfield" class="control-label">Option 3 </label>
											<div class="controls">
										
													<?php echo $poll_options[2]['HrPollOption']['value']; ?> 
											</div>
										</div>
										
											<div class="control-group">
											<label for="textfield" class="control-label">Option 4 </label>
											<div class="controls">
										
												<?php echo $poll_options[3]['HrPollOption']['value']; ?> 
											</div>
										</div>
										
					
										
										
									</div>
								

<div class="span6">					

	<div class="control-group">
											<label for="textfield" class="control-label">Option 5 </label>
											<div class="controls">
										
													<?php echo $poll_options[4]['HrPollOption']['value']; ?> 
											</div>
										</div>
											<div class="control-group">
											<label for="textfield" class="control-label">Option 6 </label>
											<div class="controls">
											<?php echo $poll_options[5]['HrPollOption']['value']; ?> 
					
											</div>
										</div>
													
										
								<div class="control-group">
											<label for="textfield" class="control-label"> Correct Answer </label>
											<div class="controls">
										
															<?php 
							if($correct == 7): 
							echo 'None';
							else:
							echo 'Option '. $correct; 
							endif; ?> 
											</div>
										</div>			
										
										<div class="control-group">
											<label for="textfield" class="control-label">Status </label>
											<div class="controls">
														<?php echo $this->Functions->show_status($poll_data['HrPoll']['status']);?>
											</div>
										</div>
									
									
								
									</div>


									
									
									<div class="span12">
										<div class="form-actions">
										<?php  if($tot_votes == 0):?>
											<a href="<?php echo $this->webroot;?>hrpoll/edit_poll/<?php echo $this->request->params['pass'][0];?>/">
											<button type="button" class="btn btn-primary"><i class="icon-edit"></i>  Edit</button></a>
											<?php endif; ?>
											<a href="<?php echo $this->webroot;?>hrpoll/"><button type="button" class="btn"><i class="icon-arrow-left"></i> Go Back</button></a>
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
			
		
	

