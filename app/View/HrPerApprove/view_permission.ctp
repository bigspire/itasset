<?php echo $this->element('hr_menu'); ?>
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Permission Request - Approve/Reject</h1>
					</div>
					
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>hrhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="<?php echo $this->webroot;?>hrperapprove/">Approve Permission</a>
								<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="#">View Permission</a>
						</li>
					</ul>
					
				</div>
				
					<div class="row-fluid">
					<div class="span12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3><i class="icon-list"></i> View Permission Request</h3>
							</div>
							<div class="box-content nopadding">
								
								
								<?php echo $this->Form->create('HrPerApprove', array('id' => 'formID', 'class' => 'form-horizontal form-column form-bordered')); ?>
								
								
									
									
								<div class="span6">
								
									<div class="control-group">
											<label for="textfield" class="control-label">Employee </label>
											<div class="controls">
													<?php echo ucfirst($perm_data['Home']['first_name']).' '.ucfirst($perm_data['Home']['last_name']);?>
													
												
											</div>
										</div>
										
										<div class="control-group">
											<label for="textfield" class="control-label">Permission Date </label>
											<div class="controls">
													<?php echo $this->Functions->format_date($perm_data['HrPerApprove']['per_date']);?>
													
												
											</div>
										</div>
											<div class="control-group">
											<label for="textfield" class="control-label">Total Hrs.</label>
											<div class="controls">
												<?php echo $this->Functions->display_hrs($perm_data['HrPerApprove']['no_hrs']);?> hrs 
											</div>
										</div>
									
									
										
									
										
									</div>
									<div class="span6">
									
									
									<div class="control-group">
											<label for="password" class="control-label">From Time </label>
											<div class="controls">
												<?php echo $this->Functions->format_time_show($perm_data['HrPerApprove']['per_from']);?>
											</div>

											</div>	
																		
<div class="control-group">
											<label for="password" class="control-label">To Time</label>
											<div class="controls">
												<?php echo $this->Functions->format_time_show($perm_data['HrPerApprove']['per_to']);?>
											</div>
										</div>
									
										<div class="control-group">
											<label for="password" class="control-label">Reason </label>
											<div class="controls">
												<?php echo $perm_data['HrPerApprove']['reason'];?>
												
												
											</div>
										</div>
									</div>
									
									<div class="span12">
										<div class="form-actions">
										<?php if($VIEW_ONLY == 1):?>
												<a href="<?php echo $this->webroot;?>hrperapprove/"><button type="button" class="btn"><< Go Back</button></a>
										<?php else: ?>
										<a class="" href="javascript:void(0);">
											<button type="button" name="<?php echo $this->webroot;?>hrperapprove/process_adv/<?php echo $this->request->params['pass'][0];?>/<?php echo $this->request->params['pass'][1];?>/A/<?php echo $this->request->params['pass'][2];?>/" class="btn btn-green approveRec">Approve</button></a>
											
											
											<a href="javascript:void(0);">
											<button type="button" name="<?php echo $this->webroot;?>hrperapprove/process_adv/<?php echo $this->request->params['pass'][0];?>/<?php echo $this->request->params['pass'][1];?>/R/<?php echo $this->request->params['pass'][2];?>/" class="btn btn-red rejectRec">Reject</button></a>
											
											<a href="<?php echo $this->webroot;?>hrperapprove/"><button type="button" class="btn">Cancel</button></a>
											
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
		<?php echo $this->Form->input('HrPerStatus.remarks', array('div'=> false,'type' => 'textarea', 'label' => false, 'class' => 'input-block-level', 'id' => 'remarks', 'required' => false, 'placeholder' => '', 'rows' => '4', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
</div>	
