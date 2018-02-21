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
						
					<?php echo $this->Form->create('HrFamily', array('id' => 'formID', 'type' => 'file', 'class' => 'form-horizontal form-column form-bordered')); ?>
								
									
									
						<div class="box">
							<div class="box-title">
								<h3><i class="icon-list"></i> Family Details</h3>
							</div>
							
						
							<div class="box-content nopadding">
								
											
									<div class="span6 eduTab">
									
															
<div class="control-group">
											<label for="textfield" class="control-label">Name <span class="red_star">*</span></label>
											<div class="controls">
												<?php echo $this->Form->input('HrFamily.relative_name1', array('div'=> false,'type' => 'text', 'value' => $this->Session->read('family.relative_name1'),'id' => 'college_name_#', 'label' => false, 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 	
											</div>
										</div>	
										
	
		<div class="control-group">
											<label for="textfield" class="control-label">Date of Birth <br><br></label>
											<div class="controls">
				<?php echo $this->Form->input('HrFamily.dob1', array('div'=> false,'type' => 'text', 'id' => 'college_name_#', 'label' => false, 'value' => $this->Session->read('family.dob1'),'class' => 'input-xlarge datepick',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 	

												
											</div>
										</div>
									
										
										
									</div>
									
									

									
									

<div class="span6 eduTab">	

	<div class="control-group">
											<label for="textfield" class="control-label">Relationship <span class="red_star">*</span></label>
											<div class="controls">
			<?php echo $this->Form->input('HrFamily.relationship1', array('div'=> false,'type' => 'select', 'label' => false, 'class' => 'input-xlarge','selected' => $this->Session->read('family.relationship1'), 'empty' => 'Select', 'options' => $relation, 'required' => false, 'placeholder' => '', 'style' => "clear:left",  'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?>
											</div>
										</div>	
									

										
				
												<div class="control-group">
											<label for="textfield" class="control-label"> Address </label>
											<div class="controls">
												<?php echo $this->Form->input('HrFamily.address1', array('div'=> false,'type' => 'textarea', 'value' => $this->Session->read('family.address1'),'label' => false, 'rows' => '2', 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?>	
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
											<label for="textfield" class="control-label">Name </label>
											<div class="controls">
												<?php echo $this->Form->input('HrFamily.relative_name2', array('div'=> false,'type' => 'text', 'id' => 'college_name_#', 'label' => false, 'class' => 'input-xlarge', 'value' => $this->Session->read('family.relative_name2'), 'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 	
											</div>
										</div>
										
	
		<div class="control-group">
											<label for="textfield" class="control-label">Date of Birth <br><br></label>
											<div class="controls">
				<?php echo $this->Form->input('HrFamily.dob2', array('div'=> false,'type' => 'text', 'id' => 'college_name_#', 'label' => false,  'value' => $this->Session->read('family.dob2'),'class' => 'input-xlarge datepick',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 	

												
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
											<label for="textfield" class="control-label">Relationship </label>
											<div class="controls">
			<?php echo $this->Form->input('HrFamily.relationship2', array('div'=> false,'type' => 'select', 'label' => false, 'class' => 'input-xlarge', 'empty' => 'Select', 'selected' => $this->Session->read('family.relationship2'), 'options' => $relation, 'required' => false, 'placeholder' => '', 'style' => "clear:left",  'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?>
											</div>
										</div>	

											
										
				
												<div class="control-group">
											<label for="textfield" class="control-label"> Address </label>
											<div class="controls">
												<?php echo $this->Form->input('HrFamily.address2', array('div'=> false,'type' => 'textarea',  'value' => $this->Session->read('family.address2'), 'label' => false, 'rows' => '2', 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?>	
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
											<label for="textfield" class="control-label">Name </label>
											<div class="controls">
												<?php echo $this->Form->input('HrFamily.relative_name3', array('div'=> false,'type' => 'text', 'id' => 'college_name_#', 'label' => false, 'class' => 'input-xlarge',  'value' => $this->Session->read('family.relative_name3'), 'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 	
											</div>
										</div>									
	
		<div class="control-group">
											<label for="textfield" class="control-label">Date of Birth <br><br></label>
											<div class="controls">
				<?php echo $this->Form->input('HrFamily.dob3', array('div'=> false,'type' => 'text', 'id' => 'college_name_#', 'label' => false,  'value' => $this->Session->read('family.dob3'),'class' => 'input-xlarge datepick',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 	

												
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
											<label for="textfield" class="control-label">Relationship </label>
											<div class="controls">
			<?php echo $this->Form->input('HrFamily.relationship3', array('div'=> false,'type' => 'select', 'label' => false, 'class' => 'input-xlarge', 'empty' => 'Select',  'selected' => $this->Session->read('family.relationship3'),  'selected' => $this->Session->read('family.relationship3'), 'options' => $relation, 'required' => false, 'placeholder' => '', 'style' => "clear:left",  'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?>
											</div>
										</div>	
										
										
				
												<div class="control-group">
											<label for="textfield" class="control-label"> Address </label>
											<div class="controls">
												<?php echo $this->Form->input('HrFamily.address3', array('div'=> false,'type' => 'textarea', 'value' => $this->Session->read('family.address3'), 'label' => false, 'rows' => '2', 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?>	
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
											<label for="textfield" class="control-label">Name </label>
											<div class="controls">
												<?php echo $this->Form->input('HrFamily.relative_name4', array('div'=> false,'type' => 'text', 'id' => 'college_name_#', 'label' => false, 'class' => 'input-xlarge', 'value' => $this->Session->read('family.relative_name4'), 'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 	
											</div>
										</div>	
										
	
		<div class="control-group">
											<label for="textfield" class="control-label">Date of Birth <br><br></label>
											<div class="controls">
				<?php echo $this->Form->input('HrFamily.dob4', array('div'=> false,'type' => 'text', 'id' => 'college_name_#', 'label' => false,  'value' => $this->Session->read('family.dob4'),'class' => 'input-xlarge datepick',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 	

												
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
											<label for="textfield" class="control-label">Relationship </label>
											<div class="controls">
			<?php echo $this->Form->input('HrFamily.relationship4', array('div'=> false,'type' => 'select', 'label' => false, 'class' => 'input-xlarge', 'empty' => 'Select', 'selected' => $this->Session->read('family.relationship4'), 'options' => $relation, 'required' => false, 'placeholder' => '', 'style' => "clear:left",  'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?>
											</div>
										</div>	
										
									
										
				
												<div class="control-group">
											<label for="textfield" class="control-label"> Address </label>
											<div class="controls">
												<?php echo $this->Form->input('HrFamily.address4', array('div'=> false,'type' => 'textarea', 'label' => false, 'rows' => '2', 'class' => 'input-xlarge', 'value' => $this->Session->read('family.address4'), 'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?>	
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
											<label for="textfield" class="control-label">Name </label>
											<div class="controls">
												<?php echo $this->Form->input('HrFamily.relative_name5', array('div'=> false,'type' => 'text', 'id' => 'college_name_#', 'label' => false, 'class' => 'input-xlarge', 'value' => $this->Session->read('family.relative_name5'), 'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 	
											</div>
										</div>	
										
	
		<div class="control-group">
											<label for="textfield" class="control-label">Date of Birth <br><br></label>
											<div class="controls">
				<?php echo $this->Form->input('HrFamily.dob5', array('div'=> false,'type' => 'text', 'id' => 'college_name_#', 'label' => false, 'value' => $this->Session->read('family.dob5'), 'class' => 'input-xlarge datepick',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 	

												
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
											<label for="textfield" class="control-label">Relationship </label>
											<div class="controls">
			<?php echo $this->Form->input('HrFamily.relationship5', array('div'=> false,'type' => 'select', 'label' => false, 'class' => 'input-xlarge', 'empty' => 'Select', 'selected' => $this->Session->read('family.relationship5'), 'options' => $relation, 'required' => false, 'placeholder' => '', 'style' => "clear:left",  'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?>
											</div>
										</div>	

									
										
				
												<div class="control-group">
											<label for="textfield" class="control-label"> Address </label>
											<div class="controls">
												<?php echo $this->Form->input('HrFamily.address5', array('div'=> false,'type' => 'textarea', 'value' => $this->Session->read('family.address5'), 'label' => false, 'rows' => '2', 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?>	
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
											<label for="textfield" class="control-label">Name </label>
											<div class="controls">
												<?php echo $this->Form->input('HrFamily.relative_name6', array('div'=> false,'type' => 'text', 'id' => 'college_name_#', 'label' => false, 'class' => 'input-xlarge',  'value' => $this->Session->read('family.relative_name6'), 'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 	
											</div>
										</div>	
										
	
		<div class="control-group">
											<label for="textfield" class="control-label">Date of Birth <br><br></label>
											<div class="controls">
				<?php echo $this->Form->input('HrFamily.dob6', array('div'=> false,'type' => 'text', 'id' => 'college_name_#', 'label' => false,  'value' => $this->Session->read('family.dob6'), 'class' => 'input-xlarge datepick',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 	

												
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
											<label for="textfield" class="control-label">Relationship </label>
											<div class="controls">
			<?php echo $this->Form->input('HrFamily.relationship6', array('div'=> false,'type' => 'select', 'label' => false, 'class' => 'input-xlarge', 'empty' => 'Select', 'selected' => $this->Session->read('family.relationship6'), 'options' => $relation, 'required' => false, 'placeholder' => '', 'style' => "clear:left",  'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?>
											</div>
										</div>	
									
										
				
												<div class="control-group">
											<label for="textfield" class="control-label"> Address </label>
											<div class="controls">
												<?php echo $this->Form->input('HrFamily.address6', array('div'=> false,'type' => 'textarea','value' => $this->Session->read('family.address6'), 'label' => false, 'rows' => '2', 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?>	
											</div>
										</div>			
									
									
										
										
								
								
									</div>
					


		
									<div class="span12">
										<div class="form-actions">
										<a href="<?php echo $this->webroot;?>hremployee/create_employee/experience/"><button type="button" class="btn"><i class="icon-arrow-left"></i> Previous</button></a>
											
											<input type="submit" value="Next" class="btn btn-primary">
											
						
											
										<a href="<?php echo $this->webroot;?>hremployee/create_employee/family/?action=skip"><button type="button" class="btn skipReg" rel="family details">Skip <i class="icon-share-alt"></i></button></a>
											
										</div>
									
									
							</div>
							
	</div>	
	



					</div>
				


									
							
							
						</div>
					
					
					<input type="hidden" name="data[HrFamily][reg_confirm]" id="reg_confirm">
					
					<!--input type="hidden" id="end_date" value="<?php echo date('d/m/Y', strtotime((date('Y')-16).'-'.date('m').'-'.date('d')));?>"-->
					
					<?php echo $this->Form->end(); ?>
					
				</div>
					</div>
		
			</div>		
					
				</div>
		
			
		
	
