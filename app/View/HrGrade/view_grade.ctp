<?php echo $this->element('fin_menu'); ?>
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>View Grade</h1>
					</div>
					
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>finhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="<?php echo $this->webroot;?>hrgrade/">View Grade</a>
								<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="#">View Grade</a>
						</li>
					</ul>
					
				</div>
				
					<div class="row-fluid footer_div">
					<div class="span12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3><i class="icon-list"></i> View Grade Details</h3>
							</div>
							<div class="box-content nopadding">
								
								
								<?php echo $this->Form->create('HrGrade', array('id' => '', 'class' => 'form-horizontal form-column form-bordered')); ?>
								
								
									<div class="span6">
										<div class="control-group">
											<label for="textfield" class="control-label">Grade </label>
											<div class="controls">
													<?php echo $gr_data['HrGrade']['grade_name'];?>
													
												
											</div>
										</div>
										<div class="control-group">
											<label for="password" class="control-label">Description </label>
											<div class="controls">
												<?php echo $gr_data['HrGrade']['grade_desc'];?>
											</div>
										</div>
									
										
									</div>
									<div class="span6">
									
									
										
												<div class="control-group">
											<label for="password" class="control-label">Status </label>
											<div class="controls">
												<?php echo $this->Functions->show_status($gr_data['HrGrade']['status']);?>
												
												
											</div>
										</div>
										
										
									</div>
									<div class="span12">
										<div class="form-actions">
											<a href="<?php echo $this->webroot;?>hrgrade/edit_grade/<?php echo $this->request->params['pass'][0];?>/">
											<button type="button" class="btn btn-primary">Edit >></button></a>
											<a href="<?php echo $this->webroot;?>hrgrade/"><button type="button" class="btn"><< Go Back</button></a>
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
			
		
	

