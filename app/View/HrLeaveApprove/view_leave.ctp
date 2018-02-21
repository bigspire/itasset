<?php echo $this->element('hr_menu'); ?>
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Leave Request - Approve/Reject</h1>
					</div>
					
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>hrhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="<?php echo $this->webroot;?>hrleaveapprove/">Approve Leave</a>
								<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="#">View Leave</a>
						</li>
					</ul>
					
				</div>
				
					<div class="row-fluid">
					<div class="span12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3><i class="icon-list"></i> View Leave Request</h3>
							</div>
							<div class="box-content nopadding">
								
								
								<?php echo $this->Form->create('HrLeaveApprove', array('id' => 'formID', 'class' => 'form-horizontal form-column form-bordered')); ?>
								
								
									
									
									<div class="span6">
									
										<div class="control-group">
											<label for="textfield" class="control-label">Employee </label>
											<div class="controls">
													<?php echo ucfirst($leave_data['Home']['first_name']).' '.ucfirst($leave_data['Home']['last_name']);?>
													
												
											</div>
										</div>
										
										<div class="control-group">
											<label for="textfield" class="control-label">Leave From </label>
											<div class="controls">
													<?php echo $this->Functions->format_date($leave_data['HrLeaveApprove']['leave_from']); echo ' ('.$this->Functions->get_day($leave_data['HrLeaveApprove']['leave_from']).')';?>
													
												
											</div>
										</div>
										<div class="control-group">
											<label for="password" class="control-label">Leave Till </label>
											<div class="controls">
												<?php echo $this->Functions->format_date($leave_data['HrLeaveApprove']['leave_to']); echo ' ('.$this->Functions->get_day($leave_data['HrLeaveApprove']['leave_to']).')';?>
											</div>
										</div>

										<?php if(!empty($leave_data[0]['compoff'])):?>	
									<div class="control-group">
											<label for="password" class="control-label">Comp. Off For </label>
											<div class="controls">
											<?php $date = explode(',', $leave_data[0]['compoff']);
											 echo $this->Functions->format_date($date[0]); echo ' ('.$this->Functions->get_day($date[0]).')'; 
											 if($date[1] != ''):
											  echo ', '.$this->Functions->format_date($date[1]); echo ' ('.$this->Functions->get_day($date[1]).')'; 
											 endif;
											 ?>
											</div>
										</div>		
									<?php endif; ?>
									
									<?php  if(!empty($leave_data['HrLeaveStatus']['remarks'])): ?>
									<div class="control-group">
											<label for="password" class="control-label">Remarks </label>
											<div class="controls">
												<?php echo $leave_data['HrLeaveStatus']['remarks'];?>
												
												
											</div>
											
									</div>
								<?php endif; ?>
								
										
									
										
									</div>
									<div class="span6">
									
										<div class="control-group">
											<label for="textfield" class="control-label">Leave Type</label>
											<div class="controls">
												<?php echo $leave_data['HrLeaveType']['desc'];?> 
											</div>
										</div>
										
										
										<!--div class="control-group">
											<label for="textfield" class="control-label">Is Half Day?</label>
											<div class="controls">
												<?php echo $this->Functions->check_halfday($leave_data['HrLeaveApprove']['session']);?> 
											</div>
										</div-->
										
										
										
											
										
										
								<div class="control-group">
											<label for="password" class="control-label">No. of Days </label>
											<div class="controls">
												<?php echo $leave_data['HrLeaveApprove']['no_days'].' days';?>
											</div>
										</div>
										
										
										<div class="control-group">
											<label for="password" class="control-label">Reason </label>
											<div class="controls">
												<?php echo $leave_data['HrLeaveApprove']['reason'];?>
												
												
											</div>
										</div>	
										
										
									
										
									
									</div>
									
									
									<div class="span12">
										<div class="form-actions">
										<?php if($VIEW_ONLY == 1):?>
												<a href="<?php echo $this->webroot;?>hrleaveapprove/"><button type="button" class="btn"><< Go Back</button></a>
										<?php else: ?>
										<a class="" href="javascript:void(0);">
											<button type="button" name="<?php echo $this->webroot;?>hrleaveapprove/process_adv/<?php echo $this->request->params['pass'][0];?>/<?php echo $this->request->params['pass'][1];?>/A/<?php echo $this->request->params['pass'][2];?>/" class="btn btn-green approveRec">Approve</button></a>
											
											
											<a href="javascript:void(0);">
											<button type="button" name="<?php echo $this->webroot;?>hrleaveapprove/process_adv/<?php echo $this->request->params['pass'][0];?>/<?php echo $this->request->params['pass'][1];?>/R/<?php echo $this->request->params['pass'][2];?>/" class="btn btn-red rejectRec">Reject</button></a>
											
											<a href="<?php echo $this->webroot;?>hrleaveapprove/"><button type="button" class="btn">Cancel</button></a>
											
										<?php endif; ?>
										
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
			
		
<div id="dialog-confirm" title="Approve Confirmation!" class="dn">
	<p>Are you sure you want to approve?</p>
</div>	

<div id="dialog-rej-confirm" title="Reject Confirmation!" class="dn">
	<p>Are you sure you want to reject?</p>
		<?php echo $this->Form->input('HrLeaveStatus.remarks', array('div'=> false,'type' => 'textarea', 'label' => false, 'class' => 'input-block-level', 'id' => 'remarks', 'required' => false, 'placeholder' => '', 'rows' => '4', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
</div>	
