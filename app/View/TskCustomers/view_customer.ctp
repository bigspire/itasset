<?php echo $this->element('fin_menu'); ?>
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>View Customer</h1>
					</div>
					
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>finhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="<?php echo $this->webroot;?>tskcustomers/">View Customer</a>
								<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="#">View Customer</a>
						</li>
					</ul>
					
				</div>
				
					<div class="row-fluid footer_div">
					<div class="span12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3><i class="icon-list"></i> View Customer Details</h3>
							</div>
							<div class="box-content nopadding">
								
								
								<?php echo $this->Form->create('TskCustomer', array('id' => '', 'class' => 'form-horizontal form-column form-bordered')); ?>
								
								
									<div class="span6">
										<div class="control-group">
											<label for="textfield" class="control-label">Company </label>
											<div class="controls">
													<?php echo $cust_data['TskCustomer']['company_name'];?>
													
												
											</div>
										</div>
										<div class="control-group">
											<label for="password" class="control-label">Email </label>
											<div class="controls">
												<?php echo $cust_data['TskCustomer']['email'];?>
											</div>
										</div>

										
										<div class="control-group">
											<label for="textfield" class="control-label">Phone </label>
											<div class="controls">
												<?php echo $cust_data['TskCustomer']['phone'];?> 
											</div>
										</div>
									<div class="control-group">
											<label for="password" class="control-label">Address </label>
											<div class="controls">
												<?php echo $cust_data['TskCustomer']['address'];?>
												
												
											</div>
										</div>
									
												<div class="control-group">
											<label for="password" class="control-label">City </label>
											<div class="controls">
												<?php echo $cust_data['TskCustomer']['city'];?>
												
												
											</div>
										</div>
										
												<div class="control-group">
											<label for="password" class="control-label">Status </label>
											<div class="controls">
												<?php echo $this->Functions->show_status($cust_data['TskCustomer']['status']);?>
												
												
											</div>
										</div>
											
										
									
										
									</div>
									<div class="span6">
												<div class="control-group">
											<label for="password" class="control-label">State </label>
											<div class="controls">
												<?php echo $cust_data['State']['state_name'];?>
												
												
											</div>
										</div>
									
												<div class="control-group">
											<label for="password" class="control-label">Zipcode </label>
											<div class="controls">
												<?php echo $cust_data['TskCustomer']['zip'];?>
												
												
											</div>
										</div>
										
													<div class="control-group">
											<label for="password" class="control-label">Website </label>
											<div class="controls">
												<?php echo $cust_data['TskCustomer']['website'];?>
												
												
											</div>
										</div>
										
												<div class="control-group">
											<label for="password" class="control-label">Type </label>
											<div class="controls">
												<?php echo $this->Functions->company_type($cust_data['TskCustomer']['type']);?>
												
												
											</div>
										</div>
										
										
												<div class="control-group">
											<label for="password" class="control-label">Description </label>
											<div class="controls">
												<?php echo $cust_data['TskCustomer']['description'];?>
												
												
											</div>
										</div>
										
											<div class="control-group">
											<label for="password" class="control-label">&nbsp; </label>
											<div class="controls">
											
												&nbsp;
												
											</div>
										</div>
										
										
									</div>
									<div class="span12">
										<div class="form-actions">
											<a href="<?php echo $this->webroot;?>tskcustomers/edit_customer/<?php echo $this->request->params['pass'][0];?>/">
											<button type="button" class="btn btn-primary"><i class="icon-edit"></i> Edit</button></a>
											<a href="<?php echo $this->webroot;?>tskcustomers/"><button type="button" class="btn"><i class="icon-arrow-left"></i> Go Back</button></a>
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
			
		
	

