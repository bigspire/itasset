<?php echo $this->element('tsk_menu'); ?>
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Recommend ROA</h1>
					</div>
					
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>tskhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="<?php echo $this->webroot;?>tskroa/">My ROA</a>
								<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="#">Recommend ROA</a>
						</li>
					</ul>
					
				</div>
				<?php echo $this->Session->flash();?>
					<div class="row-fluid">
					<div class="span12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3><i class="icon-list"></i> Please fill the form to create ROA</h3>
							</div>
							<div class="box-content nopadding">
								
								
								<?php echo $this->Form->create('TskRoa', array('id' => 'formID', 'type' => 'file', 'class' => 'form-horizontal form-column form-bordered')); ?>
								
								
									<div class="span6">
										<div class="control-group">
											<label for="textfield" class="control-label">Individual or Team?  <span class="red_star">*</span></label>
											<div class="controls">
													<?php echo $this->Form->input('type', array('div'=> false,'type' => 'radio','label' => false, 'default' => 'I', 'style' => 'margin:4px 2px', 'class' => 'recommendType input-xlarge',  'options' => array('I' => 'Individual', 'T' => 'Team'), 'separator' => ' ', 'id' => 'field1', 'required' => false, 'placeholder' => '', 'legend' => false, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?>
													<div class="error field1"></div>
													
												
											</div>
										</div>
										
									
										
												<div class="control-group">
											<label for="password" class="control-label">Employee Name (s) <span class="red_star">*</span></label>
											<div class="controls">
											<span class="recommendEmp1">
												<?php echo $this->Form->input('employee1', array('div'=> false,'type' => 'select', 'empty' => '',  'id' => 'field2', 'label' => false, 'class' => 'input-xlarge  chosen-select', 'options' => $empList,  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												</span>
												<span class="recommendEmp2">
												<?php echo $this->Form->input('employee2', array('div'=> false,'type' => 'select', 'empty' => '', 'multiple' => 'multiple',  'id' => 'field3', 'label' => false, 'class' => 'input-xlarge  chosen-select',  'options' => $empList,  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												</span>

												<div class="error field2"></div>
												<div class="error field3"></div>
												
											</div>
										</div>
										
	<div class="control-group">
											<label for="textfield" class="control-label">Describe in detail the acts/efforts/results from the employee  <span class="red_star">*</span></label>
						<div class="controls">
						<?php echo $this->Form->input('emp_acts', array('div'=> false,'type' => 'textarea', 'rows' => '4','id' => 'field4', 'label' => false, 'class' => 'input-block-level',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
						<div class="error field4"></div>
													
												
											</div>
										</div>

										
										<div class="control-group">
											<label for="textfield" class="control-label">Do you consider this as an <span class="red_star">*</span></label>
						<div class="controls">
				<div class="help-block" id="input-size-slider"></div>
				
				<div id="tsk_rating_txt" style="margin-top:10px;"></div>
				
				<?php echo $this->Form->input('rating', array('type' => 'hidden', 'id' => 'ratingHdn'));?>
			
				<div class="error field5"></div>
													
												
											</div>
										</div>	
									
										
									</div>
									<div class="span6">
									<div class="control-group">
											<label for="textfield" class="control-label">	Recognition Month <span class="red_star">*</span></label>
											<div class="controls">
													
													
												<?php echo $this->Form->input('reward_month', array('div'=> false,'type' => 'text', 'label' => false, 'id' => 'field6','class' => 'input-xlarge monthpick',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
													
													
													<div class="error field6"></div>
													
												
											</div>
										</div>
									<div class="control-group">
											<label for="password" class="control-label">Recommend For <span class="red_star">*</span> </label>
											<div class="controls">
												<?php echo $this->Form->input('applause_cat', array('div'=> false,'type' => 'select',  'multiple' => 'multiple',  'id' => 'field7', 'label' => false, 'class' => 'input-xlarge  chosen-select',  'options' => $catList,   'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												<div class="error field7"></div>
											</div>
										</div>
									
									<div class="control-group">
											<label for="textfield" class="control-label">How does the act(s) relate to business performance   <span class="red_star">*</span></label>
						<div class="controls">
						<?php echo $this->Form->input('emp_relate', array('div'=> false,'type' => 'textarea', 'rows' => '4','id' => 'field8', 'label' => false, 'class' => 'input-block-level',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
						<div class="error field8"></div>
													
												
											</div>
										</div>
										
										<div class="control-group">
											<label for="textfield" class="control-label">Attach any document that highlights? </label>
						<div class="controls">
						<?php echo $this->Form->input('upload_file', array('div'=> false,'type' => 'file', 'id' => 'field9', 'label' => false, 'class' => 'input-block-level',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
						<div class="error field9"></div>
													
												
											</div>
										</div>
										
										
									</div>
									

									
									<div class="span12">
										<div class="form-actions">
										<input type="hidden" id="end_date" value="<?php echo date('m/Y', strtotime('-1 Month'));?>" />
											<input type="submit" class="btn btn-primary send_roa" value="Send" />
											<a href="<?php echo $this->webroot;?>tskroa/" class="cancel_send"><button type="button" class="btn cancel_send">Cancel</button></a>
										</div>
									</div>
									
										<input type="hidden" value="<?php echo $this->webroot;?>tskroa/recommend/" id="post_data">	

										
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
