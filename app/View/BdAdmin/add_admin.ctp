<?php echo $this->element('bd_menu'); ?>
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Add SPOC </h1>
					</div>
					
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>bdhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="<?php echo $this->webroot;?>bdadmin/">BD Admin</a>
								<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="#">Add BD Admin</a>
						</li>
					</ul>
					
				</div>
				<?php echo $this->Session->flash();?>
					<div class="row-fluid">
					<div class="span12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3><i class="icon-user"></i> Add BD Admin</h3>
							</div>
							<div class="box-content nopadding">
									<?php echo $this->Form->create('BdAdmin', array('id' => 'formID', 'class' => 'form-horizontal form-column form-bordered')); ?>
									
								
									<div class="span6">
										<div class="control-group">
											<label for="textfield" class="control-label">Employee <span class="red_star">*</span></label>
											<div class="controls">

												<?php echo $this->Form->input('app_users_id', array('div'=> false,'type' => 'select', 'empty' => 'Select',  'options' => $empList, 'label' => false, 'class' => 'input-xlarge chosen-select',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											<div class="error field1"></div>
											</div>
										</div>
										
										
											
										
										
									
										
										
									</div>
									
										<div class="span6">
										
										
											<div class="control-group">
											<label for="password" class="control-label">Status <span class="red_star">*</span></label>
											<div class="controls">
												<?php echo $this->Form->input('status', array('div'=> false, 'empty' => 'Select', 'type' => 'select', 'label' => false, 'default' => '1', 'class' => 'input-large',  'options' => array('1' => 'Active',  '0' => 'Inactive'),  'separator' => ' ',  'required' => false, 'placeholder' => '', 'legend' => false, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												<div class="error field3"></div>
											
												
											</div>
										</div>
									
											
										</div>	
											
											
												
									<div class="span12">
										<div class="form-actions">
										
											<input type="submit" class="btn btn-primary" value="Send" />
											<a href="<?php echo $this->webroot;?>bdadmin/"><button type="button" class="btn">Cancel</button></a>
										</div>
									</div>
									
										</div>
									
									
									
									
									</div>
									
									
									
									
										<input type="hidden" value="<?php echo $this->webroot;?>bdadmin/" id="webroot">
								<?php echo $this->Form->end(); ?>
							</div>
						
					
				</div>
					
					
				</div>
		
			
			</div>
		</div>	
			

