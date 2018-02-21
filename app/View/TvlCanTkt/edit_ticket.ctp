<style>
.ui-widget-header{color:#000000}
</style>
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="" style="">
						<h5>
					
					
						Cancel Ticket </h5>
					</div>
					
				</div>
			
				
				<?php echo $this->Session->flash();?>
				
					<div class="row-fluid">
					<div class="span12">
						<div class="box box-color box-bordered">
							
							<div class="box-content nopadding">
								
								
								<?php echo $this->Form->create('TvlTicketCancel', array('id' => 'formID', 'class' => 'form-horizontal form-column form-bordered')); ?>
								
								
									<div class="span6">
									
							
										
										
											
							
								
											
										
											
										
									
								
										
										
							<div class="control-group">
											<label for="textfield" class="control-label">Cancellation Fee (Rs) <span class="red_star">*</span></label>
											<div class="controls">
											
		<?php echo $this->Form->input('cancel_fee', array('div'=> false, 'maxlength' => '8',  'id' => 'purpose','type' => 'text', 'label' => false, 'class' => 'input-medium',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
									
												
											</div>
										</div>
						
									<div class="control-group">
											<label for="textfield" class="control-label">Remark </label>
											<div class="controls">
											
		<?php echo $this->Form->input('remark', array('div'=> false, 'id' => 'purpose','type' => 'textarea', 'rows' => '2', 'label' => false, 'class' => 'input-large',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
				
												
											</div>
										</div>
								

								
										
										
										
									</div>
								


										
										
									<div class="span12">
										<div class="form-actions">
										
						<input type="submit" value="Send" class="tktUpdate btn btn-primary">
						
											
						</div>
							</div>
									<?php echo $this->Form->input('id', array('type' => 'hidden'));?>
								<?php echo $this->Form->end(); ?>
							</div>
						</div>
					</div>
				</div>
					
					
				</div>
		
			
			</div>
		</div>	
			
	

	
