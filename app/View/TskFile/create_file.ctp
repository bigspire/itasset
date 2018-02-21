<?php echo $this->element('tsk_menu'); ?>
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Add File</h1>
					</div>
					
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>tskhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="<?php echo $this->webroot;?>tskfile/">My Files</a>
								<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="#">Add File</a>
						</li>
					</ul>
					
				</div>
				
				<?php echo $this->Session->flash();?>
				
					<div class="row-fluid footer_div">
					<div class="span12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3><i class="icon-list"></i> Please fill the form to add files</h3>
							</div>
							<div class="box-content nopadding">
								
								
								<?php echo $this->Form->create('TskFile', array('type' => 'file', 'id' => 'formID', 'class' => 'form-horizontal form-column form-bordered')); ?>
								
								
									<div class="span6">
									
								
										
										
										<div class="control-group">
											<label for="textfield" class="control-label">Title <span class="red_star">*</span></label>
											<div class="controls">
										
													<?php echo $this->Form->input('title', array('div'=> false, 'maxlength' => '100', 'type' => 'text','id' => 'field0', 'label' => false, 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
													<div class="error field0"></div>
											</div>
										</div>
										
										
										
					<div class="control-group">
											<label for="textfield" class="control-label">Description <span class="red_star">*</span></label>
											<div class="controls">
														<?php echo $this->Form->input('desc', array('div'=> false,'type' => 'textarea', 'id' => 'field1', 'rows' => '2', 'label' => false, 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
														<div class="error field1"></div>
											</div>
										</div>
										
										
									<?php //if(!empty($teamList)):?>	
										<!--div class="control-group">
											<label for="textfield" class="control-label">Team </label>
											<div class="controls">
											
<?php echo $this->Form->input('team', array('div'=> false,'type' => 'select', 'multiple' => true,  'id' => 'field2', 'options' => $teamList,  'label' => false, 'class' => 'multiselect',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 											
												<div class="error field2"></div><br>
											</div>
											
											
										</div-->
										
									<?php //endif; ?>
										
										<div class="control-group">
											<label for="textfield" class="control-label">Assign Users 
												<span class="red_star">*</span><br><br><br>
											
											</label>
											<div class="controls">
					<?php echo $this->Form->input('users', array('div'=> false, 'id' => 'field2', "data-placeholder" => "Select Users" , 'multiple' => 'multiple', 'type' => 'select', 'options' => $empList,  'label' => false, 'class' => 'chosen-select input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												<div class="error field2"></div>		
												
											</div>
										</div>
										
							</div>
										
									<div class="span6">	
									
										
										<div class="control-group">
											<label for="textfield" class="control-label">Upload Files <span class="red_star">*</span></label>
											<div class="controls plupload">
									
											</div>
											<div class="error field4" style="margin-left:180px;"></div>
										</div>
										
										
									
									
								
									</div>


										
										
									<div class="span12">
										<div class="form-actions">
											<input type="submit" value="Save changes" class="btn btn-primary tsk_add_file">
											<a href="<?php echo $this->webroot;?>tskfile/"><button type="button" class="btn can_btn">Cancel</button></a>
										</div>
									</div>
									<input type="hidden" value="" id="file_upload">
									<input type="hidden" value="0" id="edit_file">
									<input type="hidden" value="<?php echo $this->webroot;?>" id="root">
								<?php echo $this->Form->end(); ?>
							</div>
						</div>
					</div>
				</div>
					
					
				</div>
		
			
			</div>
		</div>	
			
	
