<?php echo $this->element('fin_menu'); ?>
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Create Customer</h1>
					</div>
					
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>finhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="<?php echo $this->webroot;?>tskcustomers/">Customer</a>
								<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="#">Create Customer</a>
						</li>
					</ul>
					
				</div>
				
				<?php echo $this->Session->flash();?>
				
					<div class="row-fluid  footer_div">
					<div class="span12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3><i class="icon-list"></i> Please fill the form to create a new customer</h3>
							</div>
							<div class="box-content nopadding">
								
								
								<?php echo $this->Form->create('TskCustomer', array('id' => 'formID', 'class' => 'form-horizontal form-column form-bordered')); ?>
								
								
									<div class="span6">
										<div class="control-group">
											<label for="textfield" class="control-label">Company <span class="red_star">*</span></label>
											<div class="controls">
													<?php echo $this->Form->input('company_name', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
													
												
											</div>
										</div>
										<div class="control-group">
											<label for="password" class="control-label">Email Address <span class="red_star">*</span></label>
											<div class="controls">
												<?php echo $this->Form->input('email', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											</div>
										</div>

										
										
										
										<div class="control-group">
											<label for="textfield" class="control-label">Type <span class="red_star">*</span></label>
											<div class="controls">
												<?php echo $this->Form->input('type', array('div'=> false,'type' => 'select', 'label' => false, 'class' => 'input-xlarge', 'empty' => 'Select', 'required' => false, 'placeholder' => '', 'style' => "clear:left", 'options' => $compTypes, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											</div>
										</div>
										
										<div class="control-group">
											<label for="textfield" class="control-label">Description </label>
											<div class="controls">
												<?php echo $this->Form->input('description', array('div'=> false, 'rows' => 3,'type' => 'textarea', 'label' => false, 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											</div>
										</div>
										
										
									<div class="control-group">
											<label for="textfield" class="control-label">Website </label>
											<div class="controls">
												<?php echo $this->Form->input('website', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											</div>
										</div>
										<div class="control-group">
											<label for="textfield" class="control-label">Status <span class="red_star">*</span></label>
											<div class="controls">
												<?php echo $this->Form->input('status', array('div'=> false,'type' => 'select', 'label' => false, 'class' => 'input-xlarge', 'default' => 'A',  'empty' => 'Select', 'required' => false, 'placeholder' => '', 'style' => "clear:left", 'options' => array('A' => 'Active', 'I' => 'Inactive'), 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?>  
											</div>
										</div>
									</div>
									<div class="span6">
										<div class="control-group">
											<label for="textfield" class="control-label">Phone <span class="red_star">*</span></label>
											<div class="controls">
												<?php echo $this->Form->input('phone', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											</div>
										</div>
									<div class="control-group">
											<label for="password" class="control-label">Address <span class="red_star">*</span></label>
											<div class="controls">
												<?php echo $this->Form->input('address', array('div'=> false, 'rows' => 3,'type' => 'textarea', 'label' => false, 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												
												
											</div>
										</div>
										
										
										<div class="control-group">
											<label for="textfield" class="control-label">City <span class="red_star">*</span></label>
											<div class="controls">
												<?php echo $this->Form->input('city', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											</div>
										</div>
									
									
									<div class="control-group">
											<label for="textfield" class="control-label">State <span class="red_star">*</span></label>
											<div class="controls">
												<?php echo $this->Form->input('app_state_id', array('div'=> false,'type' => 'select', 'label' => false, 'class' => 'input-xlarge', 'empty' => 'Select', 'required' => false, 'placeholder' => '', 'style' => "clear:left", 'options' => $stateList, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 	
											</div>
										</div>
										
									
											<div class="control-group">
											<label for="textfield" class="control-label">Pincode <span class="red_star">*</span></label>
											<div class="controls">
												<?php echo $this->Form->input('zip', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											</div>
										</div>
										
										
									</div>




									
									<div class="span12">
										<div class="form-actions">
											<input type="submit" value="Save changes" class="btn btn-primary">
											<a href="<?php echo $this->webroot;?>tskcustomers/"><button type="button" class="btn">Cancel</button></a>
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
			
	
