<?php echo $this->element('hr_menu'); ?>
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Upload PL</h1>
					</div>
					
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>hrhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="<?php echo $this->webroot;?>hrleavedetails/">Upload PL</a>
								<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="#">Upload</a>
						</li>
					</ul>
					
				</div>
				
				<?php echo $this->Session->flash();?>
				
					<div class="row-fluid footer_div">
					<div class="span12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3><i class="icon-list"></i> Please fill the form to upload employee PL</h3>
							</div>
							<div class="box-content nopadding">
								
								
								<?php echo $this->Form->create('HrLeaveDetail', array('type' => 'file', 'id' => 'formID', 'class' => 'form-horizontal form-column form-bordered')); ?>
								
								
									<div class="span12">
									
								
										
										
										<div class="control-group">
											<label for="textfield" class="control-label">Upload Excel <span class="red_star">*</span></label>
											<div class="controls">
										
													<?php echo $this->Form->input('upload_file', array('div'=> false,'type' => 'file', 'label' => false, 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
													
					<a href="<?php echo $this->webroot;?>hrleavedetails/download_sample/sample_leave.xlsx">Download Sample Format</a>
											</div>
										</div>
										
											<div class="control-group">
											<label for="textfield" class="control-label">Year of PL <span class="red_star">*</span></label>
											<div class="controls">
										
							<?php //echo $this->Form->month('sal_month', array('div'=> false,'type' => 'select', 'label' => false, 'default' => date('m', strtotime('-1 months')),  'empty' => false, 'class' => 'input-medium', 'required' => false, 'placeholder' => '', 'style' => "clear:left",'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
							
							<?php echo $this->Form->year('sal_year', date('Y'), date('Y'), array('div'=> false,'type' => 'select', 'label' => false, 'class' => 'input-small', 'empty' => false,'default' =>  date('Y', strtotime('-1 months')), 'required' => false, 'placeholder' => ''));
	?> 
	
	
											</div>
										</div>
										
											
										
					
										
										
									
										
									</div>
								



										
										
									<div class="span12">
										<div class="form-actions">
											<input type="submit" value="Save changes" class="btn btn-primary">
											<a href="<?php echo $this->webroot;?>hrleavedetails/"><button type="button" class="btn">Cancel</button></a>
										</div>
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
			
	
