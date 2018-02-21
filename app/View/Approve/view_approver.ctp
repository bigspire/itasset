<?php echo $this->element($menu_inc); ?>

	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Create Advance Request</h1>
					</div>
					
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot.$redirect;?>/">Home</a>
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
								<h3><i class="icon-list"></i> view advance request</h3>
							</div>
							<div class="box-content nopadding">
								
								
								<?php echo $this->Form->create('FinAdvance', array('id' => '', 'class' => 'form-horizontal form-column form-bordered')); ?>
								
								
									<div class="span12">
										<div class="control-group">
											<label for="textfield" class="control-label">Purpose </label>
											<div class="controls">
													<?php echo $adv_data['FinAdvance']['purpose'];?>
													
												
											</div>
										</div>
										<div class="control-group">
											<label for="password" class="control-label">Required Date </label>
											<div class="controls">
												<?php echo $adv_data['FinAdvance']['req_date'];?>
											</div>
										</div>

										
										
										
									
										
								
										<div class="control-group">
											<label for="textfield" class="control-label">Amount </label>
											<div class="controls">
												<?php echo $adv_data['FinAdvance']['amount'];?> 
											</div>
										</div>
									<div class="control-group">
											<label for="password" class="control-label">Description </label>
											<div class="controls">
												<?php echo $adv_data['FinAdvance']['description'];?>
												
												
											</div>
										</div>
									
									
									</div>
									<div class="span12">
										<div class="form-actions">
											<a href="<?php echo $this->webroot;?>finadvance/edit_advance/<?php echo $this->request->params['pass'][0];?>/">
											<button type="button" class="btn btn-primary">Edit >></button></a>
											<a href="<?php echo $this->webroot;?>finadvance/"><button type="button" class="btn"><< Go Back</button></a>
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
			
		
	

