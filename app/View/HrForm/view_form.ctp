<?php echo $this->element('hr_menu'); ?>
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>View Doc</h1>
					</div>
					
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>hrhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="<?php echo $this->webroot;?>hrform/">View Doc</a>
								<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="#">View Doc</a>
						</li>
					</ul>
					
				</div>
				
					<div class="row-fluid footer_div">
					<div class="span12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3><i class="icon-list"></i> View Doc Details</h3>
							</div>
							<div class="box-content nopadding">
								
								
								<?php echo $this->Form->create('HrForm', array('id' => '', 'class' => 'form-horizontal form-column form-bordered')); ?>
								
								
									<div class="span6">
										<div class="control-group">
											<label for="textfield" class="control-label">Form </label>
											<div class="controls">
													<?php echo $frm_data['HrForm']['form'];?>
													
												
											</div>
										</div>
										<div class="control-group">
											<label for="password" class="control-label">Category </label>
											<div class="controls">
												<?php echo $frm_data['HrDocCategory']['category'];?>
											</div>
										</div>
										<div class="control-group">
											<label for="password" class="control-label">Description </label>
											<div class="controls">
												<?php echo $frm_data['HrForm']['desc'];?>
											</div>
										</div>
									
										
									</div>
									<div class="span6">
									
									<div class="control-group">
											<label for="password" class="control-label">Attachment </label>
											<div class="controls">
												<a href="<?php echo $this->webroot;?>hrform/download_form/<?php echo $frm_data['HrForm']['attachment'];?>/" class="btn btn-pink" rel="tooltip" title="Download"><?php echo $frm_data['HrForm']['attachment'];?></a>
												
												
												
												
											</div>
										</div>
									
										
												<div class="control-group">
											<label for="password" class="control-label">Status </label>
											<div class="controls">
												<?php echo $this->Functions->show_status($frm_data['HrForm']['status']);?>
												
												
											</div>
										</div>
										
										
									</div>
									<div class="span12">
										<div class="form-actions">
											<a href="<?php echo $this->webroot;?>hrform/edit_form/<?php echo $this->request->params['pass'][0];?>/">
											<button type="button" class="btn btn-primary"><i class="icon-edit"></i>  Edit</button></a>
											<a href="<?php echo $this->webroot;?>hrform/"><button type="button" class="btn"><i class="icon-arrow-left"></i> Go Back</button></a>
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
			
		
	

