<?php echo $this->element('hr_menu'); ?>
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Edit File</h1>
					</div>
					
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>hrhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="<?php echo $this->webroot;?>hrfile/">Files</a>
								<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="#">Edit File</a>
						</li>
					</ul>
					
				</div>
				
				<?php echo $this->Session->flash();?>
				
					<div class="row-fluid">
					<div class="span12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3><i class="icon-list"></i> Please fill the form to edit file</h3>
							</div>
							<div class="box-content nopadding">
								
								
								<?php echo $this->Form->create('HrFile', array('type' => 'file','id' => 'formID', 'class' => 'form-horizontal form-column form-bordered')); ?>
								
								
					<div class="span6">
									
								
										
										
										<div class="control-group">
											<label for="textfield" class="control-label">File Name <span class="red_star">*</span></label>
											<div class="controls">
										
													<?php echo $this->Form->input('title', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											</div>
										</div>
										
											<div class="control-group">
											<label for="textfield" class="control-label">Upload File <span class="red_star">*</span> <br><br><br></label>
											<div class="controls">
										
													<?php echo $this->Form->input('upload_file', array('div'=> false,'type' => 'file', 'label' => false, 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
													
												<br><?php if(!empty($this->request->data['HrFile']['image'])) :?>
													<a href="<?php echo $this->webroot;?>hrfile/download_image/<?php echo $this->request->data['HrFile']['image'];?>/" class="btn btn-pink" rel="tooltip" title="Download"><?php echo $this->request->data['HrFile']['image'];?></a>
													<?php endif; ?>
													
													
											</div>
										</div>
										
											
										
					
										
										
									
										
									</div>
								



										
										
									<div class="span12">
										<div class="form-actions">
											<input type="submit" value="Save changes" class="btn btn-primary">
											<a href="<?php echo $this->webroot;?>hrfile/"><button type="button" class="btn">Cancel</button></a>
										</div>
									</div>
										<?php echo $this->Form->input('page', array('type' => 'hidden', 'value' => 'edit')); ?> 
									<?php echo $this->Form->input('id', array('type' => 'hidden'));?>
								<?php echo $this->Form->end(); ?>
							</div>
						</div>
					</div>
				</div>
					
					
				</div>
		
			
			</div>
		</div>	
			
	

	
