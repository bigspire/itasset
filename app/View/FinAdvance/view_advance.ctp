<?php echo $this->element('fin_menu'); ?>
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>View Advance Request</h1>
					</div>
					
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>finhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="<?php echo $this->webroot;?>finadvance/">Advance</a>
								<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="#">View Advance</a>
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
								
								
								<?php echo $this->Form->create('FinAdvance', array('id' => '', 'class' => 'form-horizontal form-column form-bordered')); ?>
								
								
									<div class="span6">
									
									<div class="control-group">
											<label for="textfield" class="control-label">Advance No. </label>
											<div class="controls">
													<?php echo $this->Functions->get_adv_id($adv_data['FinAdvance']['id']);?>
													
												
											</div>
										</div>
										
										<div class="control-group">
											<label for="textfield" class="control-label">Purpose </label>
											<div class="controls">
													<?php echo $adv_data['FinAdvance']['purpose'];?>
													
												
											</div>
										</div>
										
<div class="control-group">
											<label for="password" class="control-label">Description </label>
											<div class="controls">
												<?php echo $adv_data['FinAdvance']['description'];?>
												
												
											</div>
										</div>
										
										
										
									
										
									</div>
									<div class="span6">
										<div class="control-group">
											<label for="textfield" class="control-label">Amount</label>
											<div class="controls">
												Rs. <?php echo $this->Functions->money_display($adv_data['FinAdvance']['amount']);?> 
											</div>
										</div>
										
										<div class="control-group">
											<label for="password" class="control-label">Required Date </label>
											<div class="controls">
												<?php echo $this->Functions->format_date($adv_data['FinAdvance']['req_date']);?>
											</div>
										</div>
									
									<div class="control-group">
											<label for="password" class="control-label">Debit to Client</label>
											<div class="controls">
												
												<?php echo $this->Functions->debit_client($adv_data['TskCustomer']['company_name']);?>
											</div>
										</div>
									
									
									
									</div>
									<div class="span12">
										<div class="form-actions">
											<!--a href="<?php echo $this->webroot;?>finadvance/edit_advance/<?php echo $this->request->params['pass'][0];?>/">
											<button type="button" class="btn btn-primary">Edit >></button></a-->
											<a href="<?php echo $this->webroot;?>finadvance/"><button type="button" class="btn"><i class="icon-arrow-left"></i> Go Back</button></a>
										</div>
									</div>
								<?php echo $this->Form->end(); ?>
							</div>
						</div>
					</div>
				
				
				
				<?php echo $this->element('remarks');?>
				
				
				</div>
					
					
				</div>
		
			
			</div>
		</div>	
			
		
	

