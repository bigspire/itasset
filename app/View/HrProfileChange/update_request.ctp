
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left" style="margin-left:10px;">
						<h1>Update Profile Change</h1>
					</div>
					
				</div>
			
				
				<?php echo $this->Session->flash();?>
				
					<div class="row-fluid">
					<div class="span12">
						<div class="box box-color box-bordered">
							
							<div class="box-content nopadding">
								
								
								<?php echo $this->Form->create('HrProfileChange', array('type' => 'file','id' => 'formID', 'class' => 'form-horizontal form-column form-bordered')); ?>
								
								
									<div class="span6">
									
								
									<div class="control-group">
											<label for="textfield" class="control-label">Employee </label>
											<div class="controls">
										
											<?php echo $emp_data['User']['full_name'];?>
											</div>
										</div>
										
										<div class="control-group">
											<label for="textfield" class="control-label">Request Details </label>
											<div class="controls">
										
											<?php echo $chg_data['HrProfileChange']['desc'];?>
											</div>
										</div>
									
						
								<?php if($chg_data['HrProfileChange']['status'] == 'C'):?>
								
								<div class="control-group">
											<label for="textfield" class="control-label">Status </label>
											<div class="controls">
										
											<?php echo $this->Functions->show_change_status($chg_data['HrProfileChange']['status']);?>
											</div>
										</div>
										
										<div class="control-group">
											<label for="textfield" class="control-label">Remarks </label>
											<div class="controls">
										
											<?php echo $chg_data['HrProfileChange']['remark'];?>
											</div>
										</div>
								
								<?php else: ?>	
									<div class="control-group">
											<label for="textfield" class="control-label">Status <span class="red_star">*</span></label>
											<div class="controls">
										
										 
													
									<?php echo $this->Form->input('status', array('div'=> false,'type' => 'select', 'label' => false,  'class' => 'input-xlarge', 'empty' => 'Select', 'required' => false, 'placeholder' => '', 'style' => "clear:left", 'options' => array('C' => 'Completed'), 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
									
									
											</div>
										</div>
										
										
									<div class="control-group">
											<label for="textfield" class="control-label">Remarks </label>
											<div class="controls">
										
													<?php echo $this->Form->input('remark', array('div'=> false,'type' => 'textarea', 'rows' => '2', 'label' => false, 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											</div>
									</div>
										
									<?php endif; ?>		
					
										
										
									
										
									</div>
								



										
								<?php if($chg_data['HrProfileChange']['status'] == 'W'):?>		
									<div class="span12">
										<div class="form-actions">
											<input type="submit" value="Save changes" class="btn btn-primary">
											
											<!--a href="javascript:void(0)" class="close_colorBox"><button type="button" class="btn">Cancel</button></a-->
										</div>
									</div>
								<?php endif; ?>
						
									<?php echo $this->Form->input('id', array('type' => 'hidden'));?>
								<?php echo $this->Form->end(); ?>
							</div>
						</div>
					</div>
				</div>
					
					
				</div>
		
			
			</div>
		</div>	
			
	

	
