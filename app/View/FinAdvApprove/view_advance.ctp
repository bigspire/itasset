<?php echo $this->element('fin_menu'); ?>
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Advance Request - Approve/Reject</h1>
					</div>
					
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>finhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="<?php echo $this->webroot;?>finadvapprove/">Advance Approve</a>
								<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="#">View Approve Advance</a>
						</li>
					</ul>
					
				</div>
				
					<div class="row-fluid">
					<div class="span12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3><i class="icon-list"></i> View Advance Request</h3>
							</div>
							<div class="box-content nopadding">
								
								
								<?php echo $this->Form->create('FinAdvApprove', array('id' => 'formID', 'class' => 'form-horizontal form-column form-bordered')); ?>
								
								
									<div class="span6">
									
									
									<div class="control-group">
											<label for="textfield" class="control-label">Advance No. </label>
											<div class="controls">
													<?php echo $this->Functions->get_adv_id($adv_data['FinAdvApprove']['id']);?>
													
												
											</div>
										</div>
										
									<div class="control-group">
											<label for="textfield" class="control-label">Employee </label>
											<div class="controls">
													<?php echo ucfirst($adv_data['Home']['first_name']).' '.ucfirst($adv_data['Home']['last_name']);?>
													
												
											</div>
										</div>
										
											
								
										
										
										
										<div class="control-group">
											<label for="textfield" class="control-label">Purpose </label>
											<div class="controls">
													<?php echo $adv_data['FinAdvApprove']['purpose'];?>
													
												
											</div>
										</div>
										

									<div class="control-group">
											<label for="password" class="control-label">Description </label>
											<div class="controls">
												<?php echo $adv_data['FinAdvApprove']['description'];?>
												
												
											</div>
										</div>
										
										
										
									
										
									</div>
									<div class="span6">
										<div class="control-group">
											<label for="textfield" class="control-label">Amount</label>
											<div class="controls">
												Rs. <?php echo $adv_data['FinAdvApprove']['amount'];?> 
											</div>
										</div>
									<div class="control-group">
											<label for="password" class="control-label">Required Date </label>
											<div class="controls">
												<?php echo $this->Functions->format_date($adv_data['FinAdvApprove']['req_date']);?>
											</div>
										</div>
										
										<div class="control-group">
											<label for="textfield" class="control-label">Debit to Client </label>
											<div class="controls">
													<?php echo $this->Functions->debit_client($adv_data['TskCustomer']['company_name']);?>
													
												
											</div>
										</div>
										
										
										
										<?php  if(!empty($adv_data['FinAdvStatus']['remarks'])): ?>
									<div class="control-group">
											<label for="password" class="control-label">My Remarks </label>
											<div class="controls">
												<?php echo $adv_data['FinAdvStatus']['remarks'];?>
												
												
											</div>
											
									</div>
								<?php endif; ?>
								
								
								</div>
									<div class="span12">
										<div class="form-actions">
										<?php if($VIEW_ONLY == 1):?>
												<a href="<?php echo $this->webroot;?>finadvapprove/"><button type="button" class="btn"><< Go Back</button></a>
										<?php else: ?>
										<a class="" href="javascript:void(0);">
											<button type="button" name="<?php echo $this->webroot;?>finadvapprove/process_adv/<?php echo $this->request->params['pass'][0];?>/<?php echo $this->request->params['pass'][1];?>/A/<?php echo $this->request->params['pass'][2];?>/" class="btn btn-green approveRec">Approve</button></a>
											
											
											<a href="javascript:void(0);">
											<button type="button" name="<?php echo $this->webroot;?>finadvapprove/process_adv/<?php echo $this->request->params['pass'][0];?>/<?php echo $this->request->params['pass'][1];?>/R/<?php echo $this->request->params['pass'][2];?>/" class="btn btn-red rejectRec">Reject</button></a>
											
											<a href="<?php echo $this->webroot;?>finadvapprove/"><button type="button" class="btn">Cancel</button></a>
											
										<?php endif; ?>
										
										</div>
									</div>
									<input type="hidden" id="adv_approve" value="1"/>
								<?php echo $this->Form->end(); ?>
							</div>
						</div>
					</div>
				</div>
					
					<?php echo $this->element('remarks');?>
				</div>
		
					
			</div>
		</div>	
			
		
<div id="dialog-confirm" title="Approve Confirmation!" class="dn">
	<p>Are you sure you want to approve?</p>
	<?php echo $this->Form->input('FinAdvStatus.remarks', array('div'=> false,'type' => 'textarea', 'label' => false, 'class' => 'input-block-level', 'id' => 'finremarks', 'required' => false, 'placeholder' => '', 'rows' => '4', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
</div>	

<div id="dialog-rej-confirm" title="Reject Confirmation!" class="dn">
	<p>Are you sure you want to reject?</p>
		<?php echo $this->Form->input('FinAdvStatus.remarks', array('div'=> false,'type' => 'textarea', 'label' => false, 'class' => 'input-block-level', 'id' => 'remarks', 'required' => false, 'placeholder' => '', 'rows' => '4', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
</div>	
