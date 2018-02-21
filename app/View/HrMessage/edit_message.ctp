<?php echo $this->element('hr_menu'); ?>
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Edit Message</h1>
					</div>
					
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>hrhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="<?php echo $this->webroot;?>hrmessage/">Message</a>
								<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="#">Edit Message</a>
						</li>
					</ul>
					
				</div>
				
				<?php echo $this->Session->flash();?>
				
					<div class="row-fluid">
					<div class="span12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3><i class="icon-list"></i> Please fill the form to edit message</h3>
							</div>
							<div class="box-content nopadding">
								
								
								<?php echo $this->Form->create('HrMessage', array('type' => 'file','id' => 'formID', 'class' => 'form-horizontal form-column form-bordered')); ?>
								
								
									<div class="span12">
									
								
										
										
										<div class="control-group">
											<label for="textfield" class="control-label">Title <span class="red_star">*</span></label>
											<div class="controls">
										
													<?php echo $this->Form->input('title', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-xxlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											</div>
										</div>
										
										
								

								
											<div class="control-group">
											<label for="textfield" class="control-label"> Description </label>
											<div class="controls">
										
													<?php echo $this->Form->input('desc', array('div'=> false,'type' => 'textarea',  'label' => false, 'class' => 'ckeditor input-xxlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											</div>
										</div>
											<div class="control-group">
											<label for="textfield" class="control-label">Show To <span class="red_star">*</span></label>
											<div class="controls">
	<?php echo $this->Form->input('show_type', array('div'=> false,'type' => 'radio',   'label' => false,  'required' => false, 'class' => 'input-xlarge',  'style' => 'margin:4px 2px', 'placeholder' => '', 'style' => "clear:left",  'separator' => ' ','legend' => false, 'options' => $show_type, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
										</div>
										</div>
					
										<div class="control-group">
											<label for="textfield" class="control-label">Publish Status <span class="red_star">*</span></label>
											<div class="controls">
	<?php echo $this->Form->input('display_type', array('div'=> false,'type' => 'radio',   'label' => false,  'required' => false, 'class' => 'pubStatus input-xlarge',  'style' => 'margin:4px 2px', 'placeholder' => '', 'style' => "clear:left",  'separator' => ' ','legend' => false, 'options' => $msg_type, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
	
	<div class="betweenDate dn" style="margin-top:10px;">
	<?php echo $this->Form->input('start_date', array('div'=> false,'type' => 'text', 'id' => '', 'label' => false,  'class' => 'input-medium dpd1',  'required' => false, 'placeholder' => 'Start', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error serverErr')))); ?>     
	<?php echo $this->Form->input('end_date', array('div'=> false,'type' => 'text', 'id' => '',  'label' => false, 'class' => 'input-medium dpd2',  'required' => false, 'placeholder' => 'End', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error serverErr')))); ?> 
	</div>					
	<div class="monthDays dn" style="margin-top:10px;">
	<?php echo $this->Form->input('start_day', array('div'=> false,'type' => 'select', 'empty' => 'Select',  'options' => range(1, 31, 1), 'id' => 'minDrop', 'rel' => 'maxDrop', 'label' => false,  'class' => 'minDrop input-small',  'required' => false, 'placeholder' => 'Start', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error serverErr')))); ?>     
	<?php echo $this->Form->input('end_day', array('div'=> false,'type' => 'select','empty' => 'Select',  'options' => range(1, 31, 1), 'id' => 'maxDrop',  'label' => false, 'class' => 'maxDrop input-small',  'required' => false, 'placeholder' => 'End', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error serverErr')))); ?> 
	</div>										</div>
										</div>
										
											<div class="control-group">
											<label for="textfield" class="control-label">Attachment </label>
											<div class="controls">
										
													<?php echo $this->Form->input('upload_file', array('div'=> false,'type' => 'file', 'label' => false, 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
													
													<br><?php if(!empty($this->request->data['HrMessage']['attachment'])) :?>
													<a href="<?php echo $this->webroot;?>hrmessage/download_update/<?php echo $this->request->data['HrMessage']['attachment'];?>/" class="btn btn-pink" rel="tooltip" title="Download"><?php echo $this->request->data['HrMessage']['attachment'];?></a>
													<?php endif; ?>
													
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
											<a href="<?php echo $this->webroot;?>hrmessage/"><button type="button" class="btn">Cancel</button></a>
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
			
	
<style type="text/css">
#footer{bottom:-150px}
</style>	
	
