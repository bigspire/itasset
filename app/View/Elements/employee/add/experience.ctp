<?php echo $this->element('hr_menu'); ?>
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Create Employee</h1>
					</div>
					
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>hrhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="<?php echo $this->webroot;?>hremployee/">Employee</a>
								<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="#">Create Employee</a>
						</li>
					</ul>
					
				</div>
				
				<?php echo $this->Session->flash();?>
				
				
					
					<div class="row-fluid  footer_div">
					
					
					<div class="span12">
					
							<?php echo $this->element('employee/add/emp_step'); ?>
							
					<?php echo $this->Form->create('HrExperience', array('id' => 'formID', 'type' => 'file', 'class' => 'form-horizontal form-column form-bordered')); ?>
								
									
									
						<div class="box">
							<div class="box-title">
								<h3><i class="icon-list"></i> Experience Details</h3>
							</div>
							
						
							<div class="box-content nopadding">
								
											
									<div class="span6 eduTab">
									
								
<div class="control-group">
											<label for="textfield" class="control-label">Company Name <span class="red_star">*</span></label>
											<div class="controls">
												<?php echo $this->Form->input('HrExperience.company1', array('div'=> false,'type' => 'text', 'id' => 'college_name_#', 'value' => $this->Session->read('experience.company1'),  'label' => false, 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 	
											</div>
										</div>								
										
										
	<div class="control-group">
											<label for="textfield" class="control-label">Designation <span class="red_star">*</span></label>
											<div class="controls">
												<?php echo $this->Form->input('HrExperience.designation1', array('div'=> false,'type' => 'text', 'value' => $this->Session->read('experience.designation1'), 'id' => 'college_name_#', 'label' => false, 'class' => 'input-xlarge', 'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											</div>
										</div>	
	
										<div class="control-group">
											<label for="textfield" class="control-label">Company Address </label>
											<div class="controls">
												<?php echo $this->Form->input('HrExperience.address1', array('div'=> false,'type' => 'textarea', 'value' => $this->Session->read('experience.address1'),'label' => false, 'rows' => '2', 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?>	
											</div>
										</div>	
									</div>
									
									

									
									

<div class="span6 eduTab">	

	
					<div class="control-group">
											<label for="textfield" class="control-label">Total Experience <span class="red_star">*</span></label>
											<div class="controls">
												<?php echo $this->Form->input('HrExperience.total_exp1', array('div'=> false,'type' => 'select', 'label' => false, 'class' => 'input-xlarge', 'selected' => $this->Session->read('experience.total_exp1'),'empty' => 'Select', 'options' => $yearExp, 'required' => false, 'placeholder' => '', 'style' => "clear:left",  'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?>

												
											</div>
										</div>
													
										<div class="control-group">
											<label for="textfield" class="control-label">Date of Joining <span class="red_star">*</span></label>
											<div class="controls">
												<?php echo $this->Form->input('HrExperience.doj1', array('div'=> false,'type' => 'text', 'value' => $this->Session->read('experience.doj1'), 'label' => false, 'class' => 'input-xlarge datepick',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?>	
											</div>
										</div>
									<div class="control-group">
											<label for="textfield" class="control-label">Date of Relieving <span class="red_star">*</span><br><br></label>
											<div class="controls">
												<?php echo $this->Form->input('HrExperience.dor1', array('div'=> false,'type' => 'text', 'value' => $this->Session->read('experience.dor1'), 'label' => false, 'class' => 'input-xlarge datepick',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?>	
											</div>
										</div>
										
										
									
										
										
								
								
									</div>
	
				
				
									<div class="span6 eduTab"  style="clear:both">
							<div class="control-group" style="border-top:1px solid #ddd">
											<label for="textfield" class="control-label"> &nbsp;</label>
											<div class="controls">
												&nbsp;
											</div>
										</div>			
								
<div class="control-group">
											<label for="textfield" class="control-label">Company Name </label>
											<div class="controls">
												<?php echo $this->Form->input('HrExperience.company2', array('div'=> false,'type' => 'text','value' => $this->Session->read('experience.company2'), 'id' => 'college_name_#', 'label' => false, 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 	
											</div>
										</div>								
										
										
	<div class="control-group">
											<label for="textfield" class="control-label">Designation </label>
											<div class="controls">
												<?php echo $this->Form->input('HrExperience.designation2', array('div'=> false,'type' => 'text', 'value' => $this->Session->read('experience.designation2'), 'id' => 'college_name_#', 'label' => false, 'class' => 'input-xlarge', 'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											</div>
										</div>	
	
										<div class="control-group">
											<label for="textfield" class="control-label">Company Address </label>
											<div class="controls">
												<?php echo $this->Form->input('HrExperience.address2', array('div'=> false,'type' => 'textarea', 'rows' => '2', 'label' => false, 'class' => 'input-xlarge', 'value' => $this->Session->read('experience.address2'),  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?>	
											</div>
										</div>	
									</div>
									
									

									
									

<div class="span6 eduTab">	
<div class="control-group" style="border-top:1px solid #ddd">
											<label for="textfield" class="control-label"> &nbsp;</label>
											<div class="controls">
												&nbsp;
											</div>
										</div>
	
					<div class="control-group">
											<label for="textfield" class="control-label">Total Experience </label>
											<div class="controls">
												<?php echo $this->Form->input('HrExperience.total_exp2', array('div'=> false,'type' => 'select', 'label' => false, 'class' => 'input-xlarge', 'selected' => $this->Session->read('experience.total_exp2'), 'empty' => 'Select', 'options' => $yearExp, 'required' => false, 'placeholder' => '', 'style' => "clear:left",  'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?>

												
											</div>
										</div>
													
										<div class="control-group">
											<label for="textfield" class="control-label">Date of Joining </label>
											<div class="controls">
												<?php echo $this->Form->input('HrExperience.doj2', array('div'=> false,'type' => 'text','value' => $this->Session->read('experience.doj2'), 'label' => false, 'class' => 'input-xlarge datepick',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?>	
											</div>
										</div>
									<div class="control-group">
											<label for="textfield" class="control-label">Date of Relieving <br><br></label>
											<div class="controls">
												<?php echo $this->Form->input('HrExperience.dor2', array('div'=> false,'type' => 'text', 'value' => $this->Session->read('experience.dor2'), 'label' => false, 'class' => 'input-xlarge datepick',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?>	
											</div>
										</div>
										
										
									
										
										
								
								
									</div>
					
		

		
									<div class="span12">
										<div class="form-actions">
										<a href="<?php echo $this->webroot;?>hremployee/create_employee/education/"><button type="button" class="btn"><i class="icon-arrow-left"></i> Previous</button></a>
											
										<input type="submit" value="Next" class="btn btn-primary">
										
										<?php if($this->Functions->check_reg_confirm($this->Session->read('reg'))):?>
										<input type="submit" value="Next & Confirm" class="btn btn-blue regconfirmBtn">
										<?php endif; ?>
											
										<a href="<?php echo $this->webroot;?>hremployee/create_employee/experience/?action=skip"><button type="button" class="btn skipReg" rel="experience details">Skip <i class="icon-share-alt"></i></button></a>
											
										</div>
									
									
							</div>
							
	</div>	
	



					</div>
				


									
							
							
						</div>
					
					
					
					
					<!--input type="hidden" id="end_date" value="<?php echo date('d/m/Y', strtotime((date('Y')-16).'-'.date('m').'-'.date('d')));?>"-->
					<input type="hidden" name="data[HrExperience][reg_confirm]" id="reg_confirm">
					<?php echo $this->Form->end(); ?>
					
				</div>
					</div>
		
			</div>		
					
				</div>
		
			
		
	
