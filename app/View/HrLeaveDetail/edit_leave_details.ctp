
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left" style="margin-left:10px;">
						<h1>
					<?php
					if($this->request->query['action'] == 'edit'):
						echo 'Edit';					
					else: 
						echo 'View';					
					endif; ?>
						Employee Leave Details</h1>
					</div>
					
				</div>
			
				
				<?php echo $this->Session->flash();?>
				
					<div class="row-fluid">
					<div class="span12">
						<div class="box box-color box-bordered">
							
							<div class="box-content nopadding">
								
								
								<?php echo $this->Form->create('HrLeaveDetail', array('type' => 'file','id' => 'formID', 'class' => 'form-horizontal form-column form-bordered')); ?>
								
								
									<div class="span6">
									
								
									<div class="control-group">
											<label for="textfield" class="control-label">Employee </label>
											<div class="controls">
										
											<?php echo $emp_data['HrEmployee']['full_name'];?>
											</div>
										</div>
									
<?php if($this->request->query['action'] == 'edit'):?>									
									<div class="control-group">
											<label for="textfield" class="control-label">Start Time <span class="red_star">*</span></label>
											<div class="controls">
										
										 
													
									<?php echo $this->Form->input('start_time', array('div'=> false,'type' => 'text', 'value' => $this->Functions->format_time_show($this->request->data['HrLeaveDetail']['start_time']), 'label' => false, 'class' => 'input-small defaulttimepick',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
									
													<i>eg: 09:30 am</i>
											</div>
										</div>
										
										
									<div class="control-group">
											<label for="textfield" class="control-label">End Time <span class="red_star">*</span></label>
											<div class="controls">
										
													<?php echo $this->Form->input('end_time', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-small defaulttimepick', 'value' => $this->Functions->format_time_show($this->request->data['HrLeaveDetail']['end_time']),  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?>
													
													<i>eg: 06:30 pm</i>
											</div>
									</div>
										
											<div class="control-group">
											<label for="textfield" class="control-label">Grace Time 
											<span class="red_star">*</span></label>
											<div class="controls">
										
													<?php echo $this->Form->input('grace_time', array('div'=> false,'type' => 'select', 'selected' => 15,  'options' => $grace_timings,  'label' => false, 'class' => 'input-small defaulttimepick',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
													
											</div>
										</div>
											
		<?php elseif(!empty($rec_exists) || $this->request->query['action'] == 'view'):?>			
						
<div class="control-group">
											<label for="textfield" class="control-label">Start Time </label>
											<div class="controls">
										
										<?php echo $this->Functions->format_time_show($this->request->data['HrLeaveDetail']['start_time']); ?>
													
								
											</div>
										</div>
										
										
									<div class="control-group">
											<label for="textfield" class="control-label">End Time </label>
											<div class="controls">
											<?php echo $this->Functions->format_time_show($this->request->data['HrLeaveDetail']['end_time']); ?>

													
											</div>
									</div>
										
											<div class="control-group">
											<label for="textfield" class="control-label">Grace Time </label>
											<div class="controls">
									<?php echo $this->request->data['HrLeaveDetail']['grace_time']; ?> mins.

													
											</div>
										</div>
		
		<?php endif; ?>
										
									
										
									</div>
								



										
										
									<div class="span12">
										<div class="form-actions">
										
						<?php if(empty($rec_exists) || $this->request->query['action'] == 'edit'):?>	
						<input type="submit" value="Save changes" class="btn btn-primary">
						<?php else: ?>
						<a href="<?php echo $this->webroot;?>hrleavedetails/edit_leave_details/<?php echo $this->request->params['pass'][0];?>/<?php echo $rec_exists;?>/?action=edit"><input type="button" value="Edit" class="btn btn-primary"></a>
						<?php endif; ?>
											
						</div>
							</div>
										 	<?php echo $this->Form->input('edit_bank_acc', array('id' => 'edit_bank_acc', 'type' => 'hidden'));?>
									<?php echo $this->Form->input('id', array('type' => 'hidden'));?>
								<?php echo $this->Form->end(); ?>
							</div>
						</div>
					</div>
				</div>
					
					
				</div>
		
			
			</div>
		</div>	
			
	

	
