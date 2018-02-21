<?php echo $this->element('fin_menu'); ?>
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Create Project Contact</h1>
					</div>
					
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>finhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="<?php echo $this->webroot;?>tskprojectcontacts/">Project Contacts</a>
								<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="#">Create Project Contact</a>
						</li>
					</ul>
					
				</div>
				
				<?php echo $this->Session->flash();?>
				
					<div class="row-fluid  footer_div">
					<div class="span12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3><i class="icon-list"></i> Please fill the form to create a new project contact</h3>
							</div>
							<div class="box-content nopadding">
								
								
								<?php echo $this->Form->create('TskProjectContact', array('id' => 'formID', 'class' => 'form-horizontal form-column form-bordered')); ?>
								
								
									<div class="span6">
											<div class="control-group">
											<label for="textfield" class="control-label">Project Name <span class="red_star">*</span></label>
											<div class="controls">
												<?php echo $this->Form->input('tsk_projects_id', array('div'=> false,'type' => 'select', 'label' => false, 'class' => 'input-xlarge', 'empty' => 'Select', 'required' => false, 'placeholder' => '', 'style' => "clear:left", 'options' => $projList, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 	
											</div>
										</div>
										
										<!--div class="control-group">
											<label for="textfield" class="control-label">Company Name <span class="red_star">*</span></label>
											<div class="controls">
												<?php //echo $this->Form->input('tsk_company_id', array('div'=> false,'type' => 'select', 'label' => false, 'readonly' => 'readonly', 'class' => 'input-xlarge', 'empty' => 'Select', 'required' => false, 'placeholder' => '', 'style' => "clear:left",'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 	
											</div>
										</div-->
										
										<div class="control-group">
											<label for="password" class="control-label">First Name <span class="red_star">*</span></label>
											<div class="controls">
												<?php echo $this->Form->input('first_name1', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											</div>
										</div>
										
											<div class="control-group">
											<label for="textfield" class="control-label">Last Name <span class="red_star">*</span></label>
											<div class="controls">
												<?php echo $this->Form->input('last_name1', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											</div>
										</div>

											<div class="control-group">
											<label for="textfield" class="control-label">Email <span class="red_star">*</span> </label>
											<div class="controls">
												<?php echo $this->Form->input('email1', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											</div>
										</div>
									
										
									</div>
									<div class="span6">
											<div class="control-group">
											<label for="password" class="control-label">Designation <span class="red_star">*</span></label>
											<div class="controls">
												<?php echo $this->Form->input('designation1', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												
												
											</div>
										</div>
										<div class="control-group">
											<label for="textfield" class="control-label">Mobile <span class="red_star">*</span> </label>
											<div class="controls">
												<?php echo $this->Form->input('phone1', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											</div>
										</div>
									<div class="control-group">
											<label for="textfield" class="control-label">Landline <span class="red_star">*</span></label>
											<div class="controls">
												<?php echo $this->Form->input('landline1', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											</div>
										</div>
										
									
								
									</div>


										
										
									<div class="span12">
										<div class="form-actions">
											<input type="submit" value="Save changes" class="btn btn-primary">
											<a href="<?php echo $this->webroot;?>tskprojectcontacts/"><button type="button" class="btn">Cancel</button></a>
										</div>
									</div>
										<?php echo $this->Form->input('id', array('type' => 'hidden'));?>
								<?php echo $this->Form->end(); ?>
							</div>
						</div>
					</div>
				</div>
					
					
				</div>
		
			
			</div>
		</div>	
			
	
