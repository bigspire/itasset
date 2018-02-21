<?php echo $this->element($menu); ?>
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Edit Role</h1>
					</div>
					
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?><?php echo $home_link; ?>/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="<?php echo $this->webroot;?>roles/<?php echo $role_var;?>">Role</a>
								<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="#">Edit Role</a>
						</li>
					</ul>
					
				</div>
				
				<?php echo $this->Session->flash();?>
				
					<div class="row-fluid">
					<div class="span12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3><i class="icon-list"></i> Please fill the form to edit role</h3>
							</div>
							<div class="box-content nopadding">
								
								
								<?php echo $this->Form->create('Role', array('id' => 'formID', 'class' => 'form-horizontal form-column form-bordered')); ?>
								
								
									<div class="span6">
									
								
										
										
										<div class="control-group">
											<label for="textfield" class="control-label">Role Name <span class="red_star">*</span></label>
											<div class="controls">
										
													<?php echo $this->Form->input('role_name', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											</div>
										</div>
										
										
												<div class="control-group">
											<label for="textfield" class="control-label"> Description </label>
											<div class="controls">
										
													<?php echo $this->Form->input('role_desc', array('div'=> false,'type' => 'textarea', 'label' => false, 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											</div>
										</div>
					
										
										
									
										
									</div>
								

<div class="span6">									
										
										
															
						<div class="control-group">
											<label for="textfield" class="control-label">  Permissions <span class="red_star">*</span> <br> <br><br><br><br><br></label>
											<div class="controls">
										
													<?php echo $this->Form->input('permission', array('multiple' => 'multiple', 'size' => '10', 'required' => false, 'legend' => false, 'before' => '','after' => '',    'between' => '  ',    'selected' => $permissionList, 'separator' => '  ','type' => 'select', 'label' => false, 'div' => false, 'class' => 'input-xlarge', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error', 'style' => 'clear:left')), 'options' => $moduleList, 'class' => 'multi_select')); ?>
											</div>
										</div>
										
										
										<div class="control-group">
											<label for="textfield" class="control-label">Status <span class="red_star">*</span></label>
											<div class="controls">
													<?php echo $this->Form->input('status', array('div'=> false,'type' => 'select', 'label' => false, 'class' => 'input-xlarge', 'empty' => 'Select', 'required' => false, 'placeholder' => '', 'style' => "clear:left", 'options' => array('1' => 'Active', '0' => 'Inactive'), 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											</div>
										</div>
									
									
								
									</div>


										
										
									<div class="span12">
										<div class="form-actions">
											<input type="submit" value="Save changes" class="btn btn-primary">
											<a href="<?php echo $this->webroot;?>roles/<?php echo $role_var;?>"><button type="button" class="btn">Cancel</button></a>
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
			
	

	
