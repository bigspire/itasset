	<div class="">
	<div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header"><h5>New Task Type </h5>
        </div><div class="container"></div>
        <div class="modal-body" style="max-height:420px;">
		
		<?php echo $this->Form->create('TskProjectRequest', array('id' => 'formID', 'class' => 'form-horizontal form-column form-bordered')); ?>
								
								<?php echo $this->Session->flash();?>	
						
					
							<div class="span12">
								
									
								
								
										<div class="control-group">
											<label for="textfield" class="control-label">Task Type <span class="red_star">*</span></label>
											<div class="controls controls-row">
												<?php echo $this->Form->input('project_name', array('div'=> false, 'type' => 'text',  'label' => false, 'class' => 'required input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												<div class="error statusChk"></div>

												</div>
										</div>
										<div class="control-group">
											<label for="textfield" class="control-label">Purpose / Description <span class="red_star">*</span></label>
											<div class="controls">
										
				<?php echo $this->Form->input('purpose', array('div'=> false, 'rows' => '2', 'type' => 'textarea', 'label' => false, 'class' => 'required input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
							
												<div class="error remainChk"></div>
											</div>
										</div>
								
										
										
										
								
									
								
	
										
									</div>
									
					

								
									<div class="span12">
										<div class="form-actions">
										
				<input type="submit" name="data[<?php echo $model_cls; ?>][save]" class="btn btn-primary edit_task_status" value="Submit">
		<!--input type="button" class="btn btn-primary update_tsk_status" value="Submit"-->
		<a href="javascript:void(0);" class="close_colorBox"><button type="button" class="btn can_btn"><i class="icon-remove"></i> Cancel</button></a>

									
										</div>
									</div>								
			
					<?php echo $this->Form->end(); ?>			
        				

       
      </div>
    </div>
</div>

</div>
