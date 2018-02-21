
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left" style="margin-left:10px;">
						<h1>Edit Bank Account</h1>
					</div>
					
				</div>
			
				
				<?php echo $this->Session->flash();?>
				
					<div class="row-fluid">
					<div class="span12">
						<div class="box box-color box-bordered">
							
							<div class="box-content nopadding">
								
								
								<?php echo $this->Form->create('HrBankAcc', array('type' => 'file','id' => 'formID', 'class' => 'form-horizontal form-column form-bordered')); ?>
								
								
									<div class="span6">
									
								
									<div class="control-group">
											<label for="textfield" class="control-label">Employee </label>
											<div class="controls">
										
											<?php echo $emp_data['HrEmployee']['full_name'];?>
											</div>
										</div>
										
									<div class="control-group">
											<label for="textfield" class="control-label">Bank Name <span class="red_star">*</span></label>
											<div class="controls">
										
										 
													
									<?php echo $this->Form->input('hr_bank_id', array('div'=> false,'type' => 'select', 'label' => false, 'class' => 'input-xlarge', 'empty' => 'Select', 'required' => false, 'placeholder' => '', 'style' => "clear:left", 'options' => $bankList, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
									
									
											</div>
										</div>
										
										
									<div class="control-group">
											<label for="textfield" class="control-label">Account Name <span class="red_star">*</span></label>
											<div class="controls">
										
													<?php echo $this->Form->input('acc_name', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											</div>
									</div>
										
											<div class="control-group">
											<label for="textfield" class="control-label">Account No. <span class="red_star">*</span></label>
											<div class="controls">
										
													<?php echo $this->Form->input('acc_no', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											</div>
										</div>
											
					
										
										
									
										
									</div>
								



										
										
									<div class="span12">
										<div class="form-actions">
											<input type="submit" value="Save changes" class="btn btn-primary">
											
											<!--a href="javascript:void(0)" class="close_colorBox"><button type="button" class="btn">Cancel</button></a-->
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
			
	

	
