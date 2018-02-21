<?php echo $this->element('hr_menu'); ?>
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Attendance Change - Approve/Reject</h1>
					</div>
					
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>hrhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="<?php echo $this->webroot;?>hrattchangeapprove/">Approve Attendance Change</a>
								<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="#">View Attendance Change</a>
						</li>
					</ul>
					
				</div>
				
					<div class="row-fluid">
					<div class="span12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3><i class="icon-list"></i> View Attendance Change</h3>
							</div>
							<div class="box-content nopadding">
								
								
								<?php echo $this->Form->create('HrAttChangeApprove', array('id' => 'formID', 'class' => 'form-horizontal form-column form-bordered')); ?>
								
								
									
									
								<div class="span12">
								
									<div class="control-group">
											<label for="textfield" class="control-label">Employee </label>
											<div class="controls">
													<?php echo ucfirst($att_data['Home']['first_name']).' '.ucfirst($att_data['Home']['last_name']);?>
													
												
											</div>
										</div>
										
										<div class="control-group">
											<label for="textfield" class="control-label">Date </label>
											<div class="controls">
													<?php echo $this->Functions->format_date($att_data['HrAttChangeApprove']['att_date']);?>
													
												
											</div>
										</div>
										
										<div class="control-group">
											<label for="textfield" class="control-label">Type</label>
											<div class="controls">
												<?php echo $this->Functions->get_att_type($att_data['HrAttChangeApprove']['att_type']);?>
											</div>
										</div>
										
										<?php if(!empty($att_data['HrAttChangeApprove']['in_time'])):?>
										<div class="control-group">
											<label for="password" class="control-label">In Time</label>
											<div class="controls">
												<?php echo $this->Functions->format_time_show($att_data['HrAttChangeApprove']['in_time']);?>
											</div>

											</div>
										<?php endif; ?>
											
										
											
											
												<?php if(!empty($att_data['HrAttChangeApprove']['out_time'])):?>
											<div class="control-group">
											<label for="password" class="control-label">Out Time</label>
											<div class="controls">
												<?php echo $this->Functions->format_time_show($att_data['HrAttChangeApprove']['out_time']);?>
											</div>

											</div>
											<?php endif; ?>								

									
										
									
										
							
									
										
										
											<div class="control-group">
											<label for="password" class="control-label">Reason </label>
											<div class="controls">
												<?php echo $att_data['HrAttChangeApprove']['reason'];?>
												
												
											</div>
										</div>
									
										
									
									
									
									</div>
									
									
									
									<div class="span12">
										<div class="form-actions">
										<?php if($VIEW_ONLY == 1):?>
												<a href="<?php echo $this->webroot;?>hrattchangeapprove/"><button type="button" class="btn"><< Go Back</button></a>
										<?php else: ?>
										<a class="" href="javascript:void(0);">
											<button type="button" name="<?php echo $this->webroot;?>hrattchangeapprove/process_adv/<?php echo $this->request->params['pass'][0];?>/<?php echo $this->request->params['pass'][1];?>/A/<?php echo $this->request->params['pass'][2];?>/" class="btn btn-green approveRec">Approve</button></a>
											
											
											<a href="javascript:void(0);">
											<button type="button" name="<?php echo $this->webroot;?>hrattchangeapprove/process_adv/<?php echo $this->request->params['pass'][0];?>/<?php echo $this->request->params['pass'][1];?>/R/<?php echo $this->request->params['pass'][2];?>/" class="btn btn-red rejectRec">Reject</button></a>
											
											<a href="<?php echo $this->webroot;?>hrattchangeapprove/"><button type="button" class="btn">Cancel</button></a>
											
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
		<?php echo $this->Form->input('HrAttStatus.remarks', array('div'=> false,'type' => 'textarea', 'label' => false, 'class' => 'input-block-level', 'id' => 'remarks', 'required' => false, 'placeholder' => '', 'rows' => '4', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
</div>	
