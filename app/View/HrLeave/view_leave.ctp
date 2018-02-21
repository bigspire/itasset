<?php echo $this->element('hr_menu'); ?>
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>View Leave Request</h1>
					</div>
					
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>hrhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="<?php echo $this->webroot;?>hrleave/">Leave</a>
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
								
								
								<?php echo $this->Form->create('HrLeave', array('id' => 'formID', 'class' => 'form-horizontal form-column form-bordered')); ?>
								
								
									<div class="span6">
										<div class="control-group">
											<label for="textfield" class="control-label">Leave From </label>
											<div class="controls">
													<?php echo $this->Functions->format_date($leave_data['HrLeave']['leave_from']); echo ' ('.$this->Functions->get_day($leave_data['HrLeave']['leave_from']).')';?>
													
												
											</div>
										</div>
										<div class="control-group">
											<label for="password" class="control-label">Leave Till </label>
											<div class="controls">
												<?php echo $this->Functions->format_date($leave_data['HrLeave']['leave_to']); echo ' ('.$this->Functions->get_day($leave_data['HrLeave']['leave_to']).')';?>
											</div>
										</div>
										
											<div class="control-group">
											<label for="password" class="control-label">Reason </label>
											<div class="controls">
												<?php echo $leave_data['HrLeave']['reason'];?>
												
												
											</div>
										</div>

										
										
										
									
										
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
												<?php echo $this->Functions->check_halfday($leave_data['HrLeave']['session']);?> 
											</div>
										</div-->
										
										
								<div class="control-group">
											<label for="password" class="control-label">No. of Days </label>
											<div class="controls">
												<?php echo $leave_data['HrLeave']['no_days'].' days';?>
											</div>
										</div>
										
									<?php if(!empty($leave_data[0]['compoff'])):?>	
									<div class="control-group">
											<label for="password" class="control-label">Comp. Off For </label>
											<div class="controls">
											<?php $date = explode(',', $leave_data[0]['compoff']);
											 echo $this->Functions->format_date($date[0]);echo ' ('.$this->Functions->get_day($date[0]).')'; 
											 if($date[1] != ''):
											  echo ', '.$this->Functions->format_date($date[1]);echo ' ('.$this->Functions->get_day($date[1]).')'; 
											 endif;
											 ?>
											</div>
										</div>		
									<?php endif; ?>
									
									
										
									
									</div>
									<div class="span12">
										<div class="form-actions">
				
				<?php if(strtotime(date('Y-m-d')) <= strtotime($leave_data['HrLeave']['leave_to']) && empty($leave_data['HrCancelLeaveStatus']['id'])):?>
				<a href="javascript:void(0);"><button type="button" name="<?php echo $this->webroot;?>hrcancelleave/cancel_leave/<?php echo $this->request->params['pass'][0];?>/" class="btn btn-red rejectRec">Cancel Leave</button></a>
				<?php endif; ?>							
										
				<a href="<?php echo $this->webroot;?>hrleave/"><button type="button" class="btn"><i class="icon-arrow-left"></i> Go Back</button></a>
										</div>
									</div>
									<input type="hidden"  name="data[HrLeave][leave_id]" value="<?php echo $this->request->params['pass'][0]; ?>"/>
								<?php echo $this->Form->end(); ?>
							</div>
						</div>
					</div>
				</div>
					
					
				</div>
		
			
			</div>
		</div>	
			
		
	
<div id="dialog-rej-confirm" title="Cancel Confirmation!" class="dn">
	<p>Are you sure you want to cancel? Enter Reason: </p>
		<?php echo $this->Form->input('HrLeaveStatus.remarks', array('div'=> false,'type' => 'textarea', 'label' => false, 'class' => 'input-block-level', 'id' => 'remarks', 'required' => false, 'placeholder' => '', 'rows' => '4', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
</div>	
