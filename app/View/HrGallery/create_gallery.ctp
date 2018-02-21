<?php echo $this->element('hr_menu'); ?>
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Create Gallery</h1>
					</div>
					
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>hrhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="<?php echo $this->webroot;?>hrgallery/">Gallery</a>
								<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="#">Create Gallery</a>
						</li>
					</ul>
					
				</div>
				
				<?php echo $this->Session->flash();?>
				
					<div class="row-fluid">
					<div class="span12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3><i class="icon-list"></i> Please fill the form to create new gallery</h3>
							</div>
							<div class="box-content nopadding">
								
								
								<?php echo $this->Form->create('HrGallery', array('type' => 'file', 'id' => 'formID', 'class' => 'form-horizontal form-column form-bordered')); ?>
								
								
									<div class="span12">
									
								
										
										
										<div class="control-group">
											<label for="textfield" class="control-label">Title <span class="red_star">*</span></label>
											<div class="controls">
										
										
							<?php echo $this->Form->input('title', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-xxlarge','id' => 'field1',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
							<div class="error field1"></div>
											</div>
										</div>
										
										
											<div class="control-group">
											<label for="textfield" class="control-label">Description </label>
											<div class="controls">
										
													<?php echo $this->Form->input('desc', array('div'=> false,'type' => 'textarea', 'id' => '', 'label' => false, 'class' => 'input-xxlarge', 'rows' => '3', 'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
													
											</div>
										</div>
										
										
											<div class="control-group">										
											<div class="controls">
										
										<iframe src="<?php echo $this->webroot;?>file_upload/index.php?folder=<?php echo $this->Session->read('folder');?>" width="850" frameborder="0"></iframe>
										
								<?php echo $this->Form->input('file', array('div'=> false,'type' => 'text', 'label' => false,'style' => 'border:1px solid #ffffff;background:#ffffff;', 'class' => 'input-small', 'required' => false, 'readonly', 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div',  'class' => 'error')))); ?> 
											</div>
											
										</div>								
									
										
									</div>
										
										
									<div class="span12">
										<div class="form-actions">
											<input type="submit" value="Send" class="btn btn-primary send_gal">
											<a href="<?php echo $this->webroot;?>hrgallery/"><button type="button" class="btn">Cancel</button></a>
										</div>
									</div>
									
									<?php echo $this->Form->input('page', array('type' => 'hidden', 'value' => 'add'));echo $this->Form->input('folder', array('type' => 'hidden', 'value' => $this->Session->read('folder')));  ?>

										<input type="hidden" value="<?php echo $this->webroot;?>hrgallery/create_gallery/" id="post_data">
											</div>
											
								<?php echo $this->Form->end(); ?>
							</div>
						</div>
					</div>
				</div>
					
					
				</div>
		
			
			</div>
		</div>	
			

	
			
<div id="dialog-confirm" title="Confirmation!" class="dn">
	<p>Are you sure you want to send? once sent, it cannot be modified!</p>
</div>
