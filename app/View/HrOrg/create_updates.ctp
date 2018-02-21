<?php echo $this->element('hr_menu'); ?>
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Create Organization Updates</h1>
					</div>
					
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>hrhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="<?php echo $this->webroot;?>hrorg/">Organization Updates</a>
								<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="#">Create Organization Updates</a>
						</li>
					</ul>
					
				</div>
				
				<?php echo $this->Session->flash();?>
				
					<div class="row-fluid footer_div">
					<div class="span12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3><i class="icon-list"></i> Please fill the form to create a new org. update</h3>
							</div>
							<div class="box-content nopadding">
								
								
								<?php echo $this->Form->create('HrOrg', array('type' => 'file', 'id' => 'formID', 'class' => 'form-horizontal form-column form-bordered')); ?>
								
								
									<div class="span12">
									
								
										
										
										<div class="control-group">
											<label for="textfield" class="control-label">Title <span class="red_star">*</span></label>
											<div class="controls">
										
													<?php echo $this->Form->input('title', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-xxlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											</div>
										</div>
										
											
										<div class="control-group">
											<label for="textfield" class="control-label"> Description <span class="red_star">*</span></label>
											<div class="controls">
										
													<?php echo $this->Form->input('desc', array('div'=> false,'type' => 'textarea',  'label' => false, 'class' => 'ckeditor input-xxlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											</div>
										</div>			
										
					
													
										<div class="control-group">
											<label for="textfield" class="control-label">Status <span class="red_star">*</span></label>
											<div class="controls">
													<?php echo $this->Form->input('status', array('div'=> false,'type' => 'select', 'default' => '1', 'label' => false, 'class' => 'input-xlarge', 'empty' => 'Select', 'required' => false, 'placeholder' => '', 'style' => "clear:left", 'options' => array('1' => 'Active', '0' => 'Inactive'), 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											</div>
										</div>
									
									
								
									</div>


										
										
									<div class="span12">
										<div class="form-actions">
											<input type="submit" value="Save changes" class="btn btn-primary">
											<a href="<?php echo $this->webroot;?>hrorg/"><button type="button" class="btn">Cancel</button></a>
										</div>
									</div>
									
									<?php echo $this->Form->input('page', array('type' => 'hidden', 'value' => 'add')); ?> 
											</div>
											
								<?php echo $this->Form->end(); ?>
							</div>
						</div>
					</div>
				</div>
					
					
				</div>
		
			
			</div>
		
			
	
