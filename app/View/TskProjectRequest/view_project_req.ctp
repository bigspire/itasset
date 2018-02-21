<?php echo $this->element('tsk_menu'); ?>
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Approve Project Request</h1>
					</div>
					
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>tskhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="<?php echo $this->webroot;?>tskprojectrequest/">Approve Project Request</a>
								<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="#">View Project Details</a>
						</li>
					</ul>
					
				</div>
				
					<div class="row-fluid footer_div">
					<div class="span12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3><i class="icon-list"></i> View Project Details</h3>
							</div>
							<div class="box-content nopadding">
								
								
								<?php echo $this->Form->create('TskProjectRequest', array('id' => 'formID', 'class' => 'form-horizontal form-column form-bordered')); ?>
								
								
									<div class="span6">
										<div class="control-group">
											<label for="password" class="control-label">Company  </label>
											<div class="controls">
												<?php echo ucwords($proj_data['TskCustomer']['company_name']);?>
												
												
											</div>
										</div>
										

										<div class="control-group">
											<label for="textfield" class="control-label">Project Name </label>
											<div class="controls">
													<?php echo $proj_data['TskProjectRequest']['project_name'];?>
													
												
											</div>
										</div>
										<div class="control-group">
											<label for="password" class="control-label">Purpose </label>
											<div class="controls">
												<?php echo $proj_data['TskProjectRequest']['purpose'];?>
											</div>
										</div>

										<div class="control-group">
											<label for="password" class="control-label">Project Members </label>
											<div class="controls">
												<?php echo $project_member;?>
											</div>
										</div>
										
										
									
											
									
										
									</div>
									<div class="span6">
										
										
										
													<div class="control-group">
											<label for="password" class="control-label">Project Leader  </label>
											<div class="controls">
												<?php echo $proj_data['PROJ_LEAD']['first_name'].' '.$proj_data['PROJ_LEAD']['last_name'];?>
												
												
											</div>
										</div>
									
											
										<div class="control-group">
											<label for="textfield" class="control-label">Start Date </label>
											<div class="controls">
												<?php echo $this->Functions->format_date($proj_data['TskProjectRequest']['start_date']);?> 
											</div>
										</div>
									<div class="control-group">
											<label for="password" class="control-label">Target Finish Date </label>
											<div class="controls">
												<?php echo $this->Functions->format_date($proj_data['TskProjectRequest']['target_finish']);?>
												
												
											</div>
										</div>
													
									<?php if(!empty($proj_data['TskProjectRequest']['remarks'])):?>	
									<div class="control-group">
											<label for="password" class="control-label">Remarks (Reject) </label>
											<div class="controls">
												<?php echo $proj_data['TskProjectRequest']['remarks'];?>
												
												
											</div>
										</div>
													
									<?php endif; ?>	
										
										
										
										
									</div>
									<div class="span12">
										<div class="form-actions">
											
										<?php if($proj_data['TskProjectRequest']['status'] != 'W'):?>
												<a href="<?php echo $this->webroot;?>tskprojectrequest/"><button type="button" class="btn"><< Go Back</button></a>
										<?php else: ?>
										<a class="" href="javascript:void(0);">
											<button type="button" name="<?php echo $this->webroot;?>tskprojectrequest/process_req/<?php echo $this->request->params['pass'][0];?>/A/<?php echo $this->request->params['pass'][1];?>/" class="btn btn-green approveRec">Approve</button></a>
											
											
											<a href="javascript:void(0);">
											<button type="button" name="<?php echo $this->webroot;?>tskprojectrequest/process_req/<?php echo $this->request->params['pass'][0];?>/R/<?php echo $this->request->params['pass'][1];?>/" class="btn btn-red rejectRec">Reject</button></a>
											
											<a href="<?php echo $this->webroot;?>tskprojectrequest/"><button type="button" class="btn">Cancel</button></a>
											
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
		<?php echo $this->Form->input('TskProjectRequest.remarks', array('div'=> false,'type' => 'textarea', 'label' => false, 'class' => 'input-block-level', 'id' => 'remarks', 'required' => false, 'placeholder' => '', 'rows' => '4', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
</div>	

