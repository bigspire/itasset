<?php echo $this->element('tvl_menu'); ?>
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Create Place</h1>
					</div>
					
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>tvlhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="<?php echo $this->webroot;?>tvlplace/">Place</a>
								<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="#">Create Place</a>
						</li>
					</ul>
					
				</div>
				
				<?php echo $this->Session->flash();?>
				
					<div class="row-fluid">
					<div class="span12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3><i class="icon-list"></i> Please fill the form to create a new place</h3>
							</div>
							<div class="box-content nopadding">
								
								
								<?php echo $this->Form->create('TvlPlace', array('id' => 'formID', 'class' => 'form-horizontal form-column form-bordered')); ?>
								
								
									<div class="span6">
									
								
										
										
										<div class="control-group">
											<label for="textfield" class="control-label">Place <span class="red_star">*</span></label>
											<div class="controls">
										
													<?php echo $this->Form->input('place', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											</div>
										</div>
										
										
										
					
										
										
									
										
									</div>
								

<div class="span6">									
										
										
										
										<div class="control-group">
											<label for="textfield" class="control-label">Status <span class="red_star">*</span></label>
											<div class="controls">
													<?php echo $this->Form->input('status', array('div'=> false,'type' => 'select', 'label' => false, 'class' => 'input-xlarge', 'default' => '1',  'empty' => 'Select', 'required' => false, 'placeholder' => '', 'style' => "clear:left", 'options' => array('1' => 'Active', '0' => 'Inactive'), 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											</div>
										</div>
									
									
								
									</div>


										
										
									<div class="span12">
										<div class="form-actions">
											<input type="submit" value="Save changes" class="btn btn-primary">
											<a href="<?php echo $this->webroot;?>tvlplace/"><button type="button" class="btn">Cancel</button></a>
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
			
	
