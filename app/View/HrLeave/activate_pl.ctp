	<div class="">
	<div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header"><h5>Request to Activate PL</h5>
        </div><div class="container"></div>
        <div class="modal-body" style="max-height:420px;">
		
		<?php echo $this->Form->create('HrPlReq', array('id' => 'formID', 'class' => 'form-horizontal form-column form-bordered')); ?>
								
									
						
					
							<div class="span12">
										
									<div class="control-group">
											<label for="textfield" class="control-label">Leave From </label>
											<div class="controls">
										<?php echo $this->request->query['from'];?>		
													<div class="error reasonChk"></div>
											</div>
										</div>
									
								
							<div class="control-group">
											<label for="textfield" class="control-label">Leave Till </label>
											<div class="controls">
											
<?php echo $this->request->query['to'];?>													<div class="error reasonChk"></div>
											</div>
										</div>		
									
						
										
										
											<div class="control-group">
											<label for="textfield" class="control-label">No. of Days </label>
											<div class="controls">
											
<?php echo $this->request->query['no_days'];?> Days
													<div class="error reasonChk"></div>
											</div>
										</div>	
										
								<div class="control-group">
											<label for="textfield" class="control-label">Reason <span class="red_star">*</span></label>
											<div class="controls">
										
				<?php echo $this->Form->input('reason', array('div'=> false, 'rows' => '4', 'type' => 'textarea', 'label' => false, 'class' => 'required input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
							
												<div class="error remainChk"></div>
											</div>
										</div>
									
									
								
	
										
									</div>
									
					

								
									<div class="span12">
										<div class="form-actions">
										
				<input type="submit" name="data[HrLeave][save]" class="btn btn-primary" value="Submit">
		<a href="javascript:void(0);" class="close_colorBox"><button type="button" class="btn can_btn"><i class="icon-remove"></i> Cancel</button></a>

									
										</div>
									</div>	
									
						<?php echo $this->Form->input('date_from', array('type' => 'hidden', 'value' => $this->request->query['from'])); ?> 
						<?php echo $this->Form->input('date_to', array('type' => 'hidden', 'value' => $this->request->query['to'])); ?> 
						<?php echo $this->Form->input('no_days', array('type' => 'hidden', 'value' => $this->request->query['no_days'])); ?> 

					<?php echo $this->Form->end(); ?>			
        				

       
      </div>
    </div>
</div>

</div>
