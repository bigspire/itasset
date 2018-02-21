<?php echo $this->element('fin_menu'); ?>
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>View Project</h1>
					</div>
					
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>finhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="<?php echo $this->webroot;?>tskprojects/">View Project</a>
								<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="#">View Project</a>
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
								
								
								<?php echo $this->Form->create('TskProject', array('id' => '', 'class' => 'form-horizontal form-column form-bordered')); ?>
								
								
									<div class="span6">
										<div class="control-group">
											<label for="textfield" class="control-label">Project Name </label>
											<div class="controls">
													<?php echo $proj_data['TskProject']['project_name'];?>
													
												
											</div>
										</div>
										<div class="control-group">
											<label for="password" class="control-label">Project Short Code  </label>
											<div class="controls">
												<?php echo $proj_data['TskProject']['proj_short_code'];?>
											</div>
										</div>

										
										
										<div class="control-group">
											<label for="textfield" class="control-label">Start Date </label>
											<div class="controls">
												<?php echo $this->Functions->format_date($proj_data['TskProject']['start_date']);?> 
											</div>
										</div>
									<div class="control-group">
											<label for="password" class="control-label">Target Finish Date </label>
											<div class="controls">
												<?php echo $this->Functions->format_date($proj_data['TskProject']['target_finish']);?>
												
												
											</div>
										</div>
									
									
													<div class="control-group">
											<label for="password" class="control-label">Purchse Order </label>
											<div class="controls">
												<?php echo $proj_data['TskProject']['purchase_order'];?>
												
												
											</div>
										</div>
												<div class="control-group">
											<label for="password" class="control-label">Status </label>
											<div class="controls">
												<?php echo $this->Functions->project_status($proj_data['TskProject']['status']);?>
												
												
											</div>
										</div>
									
										
									</div>
									<div class="span6">
										
										
											<div class="control-group">
											<label for="password" class="control-label">Company  </label>
											<div class="controls">
												<?php echo ucwords($proj_data['TskCustomer']['company_name']);?>
												
												
											</div>
										</div>
										
													<div class="control-group">
											<label for="password" class="control-label">Project Leader  </label>
											<div class="controls">
												<?php echo ucwords($proj_data['Home']['first_name'].' '.$proj_data['Home']['last_name']);?>
												
												
											</div>
										</div>
										
											<div class="control-group">
											<label for="password" class="control-label">Project Members  </label>
											<div class="controls">
												<?php echo $project_member;?>
												
												
											</div>
										</div>
									
												<div class="control-group">
											<label for="password" class="control-label">PO Number </label>
											<div class="controls">
												<?php echo $proj_data['TskProject']['po_number'];?>
												
												
											</div>
										</div>
										
										
												<div class="control-group">
											<label for="password" class="control-label">Payment Terms </label>
											<div class="controls">
												<?php echo $proj_data['TskProject']['payment_terms'];?>
												
												
											</div>
										</div>
										
										
										
										
										
										
										
									</div>
									<div class="span12">
										<div class="form-actions">
											<a href="<?php echo $this->webroot;?>tskprojects/edit_project/<?php echo $this->request->params['pass'][0];?>/">
											<button type="button" class="btn btn-primary"><i class="icon-edit"></i> Edit</button></a>
											<a href="<?php echo $this->webroot;?>tskprojects/"><button type="button" class="btn"><i class="icon-arrow-left"></i> Go Back</button></a>
											
											
											
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
			
		
	

