<?php echo $this->element('hr_menu'); ?>
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Edit Poll</h1>
					</div>
					
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>hrhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="<?php echo $this->webroot;?>hrpoll/">Poll</a>
								<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="#">Edit Poll</a>
						</li>
					</ul>
					
				</div>
				
				<?php echo $this->Session->flash();?>
				
					<div class="row-fluid footer_div">
					<div class="span12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3><i class="icon-list"></i> Please fill the form to edit poll</h3>
							</div>
							<div class="box-content nopadding">
								
								
								<?php echo $this->Form->create('HrPoll', array('type' => 'file','id' => 'formID', 'class' => 'form-horizontal form-column form-bordered')); ?>
								
								<div class="span6">
									
								
										
										
										<div class="control-group">
											<label for="textfield" class="control-label">Question <span class="red_star">*</span></label>
											<div class="controls">
										
													<?php echo $this->Form->input('ques', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											</div>
										</div>
										
											<div class="control-group">
											<label for="textfield" class="control-label">Option 1 <span class="red_star">*</span></label>
											<div class="controls">
									
													<?php echo $this->Form->input('option1', array('div'=> false,'type' => 'text', 'value' => $poll_options[0]['HrPollOption']['value'], 'label' => false, 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											</div>
										</div>
											
												<div class="control-group">
											<label for="textfield" class="control-label">Option 2 <span class="red_star">*</span></label>
											<div class="controls">
										
													<?php echo $this->Form->input('option2', array('div'=> false,'type' => 'text',  'label' => false, 'value' => $poll_options[1]['HrPollOption']['value'],'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											</div>
										</div>
										
											<div class="control-group">
											<label for="textfield" class="control-label">Option 3 <span class="red_star">*</span></label>
											<div class="controls">
										
													<?php echo $this->Form->input('option3', array('div'=> false,'type' => 'text', 'value' => $poll_options[2]['HrPollOption']['value'],'label' => false, 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											</div>
										</div>
										
											<div class="control-group">
											<label for="textfield" class="control-label">Option 4 </label>
											<div class="controls">
										
													<?php echo $this->Form->input('option4', array('div'=> false,'type' => 'text','value' => $poll_options[3]['HrPollOption']['value'], 'label' => false, 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											</div>
										</div>
										
					
										
										
									</div>
								

<div class="span6">					

	<div class="control-group">
											<label for="textfield" class="control-label">Option 5 </label>
											<div class="controls">
										
													<?php echo $this->Form->input('option5', array('div'=> false,'type' => 'text','value' => $poll_options[4]['HrPollOption']['value'], 'label' => false, 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											</div>
										</div>
											<div class="control-group">
											<label for="textfield" class="control-label">Option 6 </label>
											<div class="controls">
										
													<?php echo $this->Form->input('option6', array('div'=> false,'type' => 'text','value' => $poll_options[5]['HrPollOption']['value'], 'label' => false, 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											</div>
										</div>
													
										
								<div class="control-group">
											<label for="textfield" class="control-label"> Correct Answer <span class="red_star">*</span></label>
											<div class="controls">
										
													<?php echo $this->Form->input('answer', array('div'=> false,'type' => 'select', 'selected' => $correct, 'empty' => 'Select',  'options' => $correctAns,  'label' => false, 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
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
											<a href="<?php echo $this->webroot;?>hrpoll/"><button type="button" class="btn">Cancel</button></a>
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
			
	

	
