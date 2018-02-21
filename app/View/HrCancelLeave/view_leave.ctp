<?php echo $this->element('hr_menu'); ?>
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>View Cancel Leave Request</h1>
					</div>
					
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>hrhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="<?php echo $this->webroot;?>hrcancelleave/">Cancel Leave</a>
								<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="#">View Cancel Leave</a>
						</li>
					</ul>
					
				</div>
				
					<div class="row-fluid">
					<div class="span12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3><i class="icon-list"></i> View Cancel Leave Request</h3>
							</div>
							<div class="box-content nopadding">
								
								
								<?php echo $this->Form->create('HrCancelLeave', array('id' => '', 'class' => 'form-horizontal form-column form-bordered')); ?>
								
								
									<div class="span6">
										<div class="control-group">
											<label for="textfield" class="control-label">Cancel Leave From </label>
											<div class="controls">
													<?php echo $this->Functions->format_date($leave_data['HrCancelLeave']['leave_from']); echo ' ('.$this->Functions->get_day($leave_data['HrCancelLeave']['leave_from']).')';?>
													
												
											</div>
										</div>
										<div class="control-group">
											<label for="password" class="control-label">Cancel Leave Till </label>
											<div class="controls">
												<?php echo $this->Functions->format_date($leave_data['HrCancelLeave']['leave_to']); echo ' ('.$this->Functions->get_day($leave_data['HrCancelLeave']['leave_to']).')';?>
											</div>
										</div>
										
											<div class="control-group">
											<label for="password" class="control-label">Reason </label>
											<div class="controls">
												<?php echo $leave_data['HrCancelLeave']['reason'];?>
												
												
											</div>
										</div>

										
										<div class="control-group">
											<label for="password" class="control-label" style="color:#F22492">Cancel Reason </label>
											<div class="controls">
												<?php echo $leave_data['HrCancelLeave']['cancel_reason'];?>
												
												
											</div>
										</div>
										
										
										
										
									
										
									</div>
									<div class="span6">
									
										<div class="control-group">
											<label for="textfield" class="control-label">Cancel Leave Type</label>
											<div class="controls">
												<?php echo $leave_data['HrLeaveType']['desc'];?> 
											</div>
										</div>
										
										
										<!--div class="control-group">
											<label for="textfield" class="control-label">Is Half Day?</label>
											<div class="controls">
												<?php echo $this->Functions->check_halfday($leave_data['HrCancelLeave']['session']);?> 
											</div>
										</div-->
										
										
								<div class="control-group">
											<label for="password" class="control-label">No. of Days </label>
											<div class="controls">
												<?php echo $leave_data['HrCancelLeave']['no_days'].' days';?>
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
									
										<div class="control-group">
											<label for="password" class="control-label">&nbsp;</label>
											<div class="controls">
											&nbsp;
											</div>
										</div>
										
									
									</div>
									<div class="span12">
										<div class="form-actions">
											<!--a href="<?php echo $this->webroot;?>hrcancelleave/edit_advance/<?php echo $this->request->params['pass'][0];?>/">
											<button type="button" class="btn btn-primary">Edit >></button></a-->
											<a href="<?php echo $this->webroot;?>hrcancelleave/"><button type="button" class="btn"><i class="icon-arrow-left"></i> Go Back</button></a>
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
			
		
	

