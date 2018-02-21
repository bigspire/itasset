<?php echo $this->element('hr_menu'); ?>
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Approve PL Request</h1>
					</div>
					
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>hrhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="<?php echo $this->webroot;?>hrplreq/">Approve PL Request</a>
								<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="#">View PL Request</a>
						</li>
					</ul>
					
				</div>
				
					<div class="row-fluid footer_div">
					<div class="span12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3><i class="icon-list"></i> View PL Request</h3>
							</div>
							<div class="box-content nopadding">
								
								
								<?php echo $this->Form->create('HrPlReq', array('id' => 'formID', 'class' => 'form-horizontal form-column form-bordered')); ?>
								
								
									<div class="span12">
										<div class="control-group">
											<label for="password" class="control-label">Employee  </label>
											<div class="controls">
												<?php echo ucwords($req_data['HrEmployee']['first_name'].' '.$req_data['HrEmployee']['last_name']);?>
												
												
											</div>
										</div>
										

										<div class="control-group">
											<label for="textfield" class="control-label">Leave From </label>
											<div class="controls">
													<?php echo $this->Functions->format_date($req_data['HrPlReq']['date_from']);?>
													
												
											</div>
										</div>
										<div class="control-group">
											<label for="password" class="control-label">Leave Till </label>
											<div class="controls">
												<?php echo $this->Functions->format_date($req_data['HrPlReq']['date_to']);?>
											</div>
										</div>
										
										<div class="control-group">
											<label for="password" class="control-label">No. of Days</label>
											<div class="controls">
												<?php echo $req_data['HrPlReq']['no_days'];?> Days
											</div>
										</div>

										<div class="control-group">
											<label for="password" class="control-label">Reason </label>
											<div class="controls">
												<?php echo $req_data['HrPlReq']['reason'];?>
											</div>
										</div>
										
										
									
											
									
										
							
										
													
									<?php if(!empty($req_data['HrPlReq']['remarks'])):?>	
									<div class="control-group">
											<label for="password" class="control-label" style="color:#F7815D"/>Remarks </label>
											<div class="controls">
												<?php echo $req_data['HrPlReq']['remarks'];?>
												
												
											</div>
										</div>
													
									<?php endif; ?>	
										
										
										
										
									</div>
									<div class="span12">
										<div class="form-actions">
											
										<?php if($req_data['HrPlReq']['status'] != 'W'):?>
												<a href="<?php echo $this->webroot;?>hrplreq/"><button type="button" class="btn"><< Go Back</button></a>
										<?php else: ?>
										<a class="" href="javascript:void(0);">
											<button type="button" name="<?php echo $this->webroot;?>hrplreq/process_req/<?php echo $this->request->params['pass'][0];?>/A/<?php echo $this->request->params['pass'][1];?>/" class="btn btn-green approveRec">Approve</button></a>
											
											
											<a href="javascript:void(0);">
											<button type="button" name="<?php echo $this->webroot;?>hrplreq/process_req/<?php echo $this->request->params['pass'][0];?>/R/<?php echo $this->request->params['pass'][1];?>/" class="btn btn-red rejectRec">Reject</button></a>
											
											<a href="<?php echo $this->webroot;?>hrplreq/"><button type="button" class="btn">Cancel</button></a>
											
										<?php endif; ?>	
											
										</div>
									</div>
									<input type="hidden" id="adv_approve" value="1"/>
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
	<?php echo $this->Form->input('TvlReqStatus.remarks', array('div'=> false,'type' => 'textarea', 'label' => false, 'class' => 'input-block-level', 'id' => 'finremarks', 'required' => false, 'placeholder' => '', 'rows' => '4', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
</div>

<div id="dialog-rej-confirm" title="Reject Confirmation!" class="dn">
	<p>Are you sure you want to reject?</p>
		<?php echo $this->Form->input('HrPlReq.remarks', array('div'=> false,'type' => 'textarea', 'label' => false, 'class' => 'input-block-level', 'id' => 'remarks', 'required' => false, 'placeholder' => '', 'rows' => '4', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
</div>	

