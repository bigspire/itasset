<?php echo $this->element('fin_menu'); ?>
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
			
				
					<div class="row-fluid">
					<div class="span12">
						<div class="box box-color box-bordered">
							<div class="box-title" style="border:2px solid #ddd">
								<h3 style="color:#444"><i class="icon-list"></i> View Advance Details</h3>
							</div>
							<div class="box-content nopadding">
								
								
								<?php echo $this->Form->create('FinAdvance', array('id' => '', 'class' => 'form-horizontal form-column form-bordered')); ?>
								
								
									<div class="span6">
									
								
										<div class="control-group">
											<label for="textfield" class="control-label">Purpose </label>
											<div class="controls">
													<?php echo $adv_data['FinAdvance']['purpose'];?>
													
												
											</div>
										</div>
										
<div class="control-group">
											<label for="password" class="control-label">Description </label>
											<div class="controls">
												<?php echo $adv_data['FinAdvance']['description'];?>
												
												
											</div>
										</div>
										
										
										
									
										
									</div>
									<div class="span6">
										<div class="control-group">
											<label for="textfield" class="control-label">Amount</label>
											<div class="controls">
												Rs. <?php echo $this->Functions->money_display($adv_data['FinAdvance']['amount']);?> 
											</div>
										</div>
										
										<div class="control-group">
											<label for="password" class="control-label">Required Date </label>
											<div class="controls">
												<?php echo $this->Functions->format_date($adv_data['FinAdvance']['req_date']);?>
											</div>
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
			
		
	

