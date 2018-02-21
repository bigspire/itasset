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
								
					<?php echo $this->Form->create('HrEducation', array('id' => 'formID',  'class' => 'form-horizontal form-column form-bordered')); ?>
								
									
									
						<div class="box">
							<div class="box-title">
								<h3><i class="icon-list"></i> Education Details</h3>
							</div>
							
						
							<div class="box-content nopadding">
								
											
									<div class="span6">
									
								
<div class="control-group">
											<label for="textfield" class="control-label">School Name <b>(10th)</b> </label>
											<div class="controls">
												<?php echo $this->Form->input('HrEducation.inst_name1', array('div'=> false,'type' => 'text', 'value' => $this->Session->read('education.inst_name1'), 'id' => 'college_name_#', 'label' => false, 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 	
											</div>
										</div>								
										
										
	<div class="control-group">
											<label for="textfield" class="control-label">Board </label>
											<div class="controls">
												<?php echo $this->Form->input('HrEducation.board1', array('div'=> false,'type' => 'select', 'selected' => $this->Session->read('education.board1'),'id' => 'college_name_#', 'label' => false, 'class' => 'input-xlarge', 'empty' => 'Select', 'required' => false, 'placeholder' => '', 'style' => "clear:left", 'options' => $boardList, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											</div>
										</div>	
	
										
									</div>
									
									

									
									

<div class="span6 eduTab">	

	
					<div class="control-group">
											<label for="textfield" class="control-label">Year of Passing </label>
											<div class="controls">
												<?php echo $this->Form->input('HrEducation.year_passing1', array('div'=> false,'type' => 'select', 'selected' => $this->Session->read('education.year_passing1'), 'label' => false, 'class' => 'input-xlarge', 'empty' => 'Select', 'options' => $yearPass, 'required' => false, 'placeholder' => '', 'style' => "clear:left",  'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?>

												
											</div>
										</div>
											<div class="control-group">
											<label for="textfield" class="control-label">% of Marks </label>
											<div class="controls">
												<?php echo $this->Form->input('HrEducation.percent_marks1', array('div'=> false,'type' => 'text', 'value' => $this->Session->read('education.percent_marks1'), 'maxlength' => '6', 'label' => false, 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?>	
											</div>
										</div>		
										
									
										
										
										
										
										
								
								
									</div>
	
					
			<div class="span6 eduTab" style="clear:both">
									
						<div class="control-group" style="border-top:1px solid #ddd">
											<label for="textfield" class="control-label"> &nbsp;</label>
											<div class="controls">
												&nbsp;
											</div>
										</div>		
<div class="control-group">
											<label for="textfield" class="control-label">School Name <b>(12th)</b> </label>
											<div class="controls">
												<?php echo $this->Form->input('HrEducation.inst_name2', array('div'=> false,'type' => 'text','value' => $this->Session->read('education.inst_name2'),'id' => 'college_name_#', 'label' => false, 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 	
											</div>
										</div>								
										
										
	<div class="control-group">
											<label for="textfield" class="control-label">Board </label>
											<div class="controls">
													<?php echo $this->Form->input('HrEducation.board2', array('div'=> false,'type' => 'select', 'value' => $this->Session->read('education.board2'),'id' => 'college_name_#', 'label' => false, 'class' => 'input-xlarge', 'empty' => 'Select', 'required' => false, 'placeholder' => '', 'style' => "clear:left", 'options' => $boardList, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
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
											<label for="textfield" class="control-label">Year of Passing </label>
											<div class="controls">
												<?php echo $this->Form->input('HrEducation.year_passing2', array('div'=> false,'type' => 'select', 'label' => false, 'class' => 'input-xlarge', 'selected' => $this->Session->read('education.year_passing2'),'empty' => 'Select', 'options' => $yearPass, 'required' => false, 'placeholder' => '', 'style' => "clear:left",  'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?>

												
											</div>
										</div>
											<div class="control-group">
											<label for="textfield" class="control-label">% of Marks </label>
											<div class="controls">
												<?php echo $this->Form->input('HrEducation.percent_marks2', array('div'=> false,'type' => 'text', 'value' => $this->Session->read('education.percent_marks2'), 'maxlength' => '6', 'label' => false, 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?>
											</div>
										</div>
							
										
										
										
										
								
								
									</div>
						
							
							
							
							
										<div class="span6 eduTab" style="clear:both">
									
									<div class="control-group" style="border-top:1px solid #ddd">
											<label for="textfield" class="control-label"> &nbsp;</label>
											<div class="controls">
												&nbsp;
											</div>
										</div>	
										
									
								
								
										
<div class="control-group">
											<label for="textfield" class="control-label">College <b>(Diploma/ITI)</b> </label>
											<div class="controls">
												<?php echo $this->Form->input('HrEducation.inst_name3', array('div'=> false,'type' => 'text', 'value' => $this->Session->read('education.inst_name3'), 'label' => false, 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 	
											</div>
										</div>
									
										
										
									<div class="control-group">
											<label for="textfield" class="control-label">Course </label>
											<div class="controls">
												<?php echo $this->Form->input('HrEducation.hr_course_id3', array('div'=> false,'type' => 'select', 'id' => 'college_name_#', 'label' => false, 'class' => 'input-xlarge get_spec', 'selected' => $this->Session->read('education.hr_course_id3'), 'val' => 'spec1', 'empty' => 'Select', 'required' => false, 'placeholder' => '', 'style' => "clear:left", 'options' => $dipcourseList, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 	
											</div>
										</div>
									

	<div class="control-group">
											<label for="textfield" class="control-label">Specialization </label>
											<div class="controls">
												<?php echo $this->Form->input('HrEducation.hr_specialization_id3', array('div'=> false,'type' => 'select', 'label' => false, 'class' => 'input-xlarge spec1', 'empty' => 'Select', 'options' => $dipspecList, 'selected' => $this->Session->read('education.hr_specialization_id3'),'required' => false, 'placeholder' => '', 'style' => "clear:left", 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 	
											</div>
										</div>		
										
									
											<div class="control-group">
											<label for="textfield" class="control-label">% of Marks / Grade</label>
											<div class="controls">
													<?php echo $this->Form->input('HrEducation.percent_marks3', array('div'=> false,'type' => 'text', 'maxlength' => '6', 'label' => false, 'class' => 'input-xlarge', 'value' => $this->Session->read('education.percent_marks3'), 'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 	
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
											<label for="textfield" class="control-label">Year of Passing </label>
											<div class="controls">
												<?php echo $this->Form->input('HrEducation.year_passing3', array('div'=> false,'type' => 'select', 'selected' => $this->Session->read('education.year_passing3'), 'label' => false, 'class' => 'input-xlarge', 'empty' => 'Select', 'options' => $yearPass, 'required' => false, 'placeholder' => '', 'style' => "clear:left",  'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?>

												
											</div>
										</div>
										
										
										
										<div class="control-group">
											<label for="textfield" class="control-label">University </label>
											<div class="controls">
													<?php echo $this->Form->input('HrEducation.university3', array('div'=> false,'type' => 'text', 'value' => $this->Session->read('education.university3'), 'label' => false, 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											</div>
										</div>
										
																			

	<div class="control-group">
											<label for="textfield" class="control-label">Course Type</label>
											<div class="controls">
												<?php echo $this->Form->input('HrEducation.course_type3', array('div'=> false,'type' => 'select', 'label' => false, 'class' => 'input-xlarge', 'empty' => 'Select', 'selected' => $this->Session->read('education.course_type3'), 'required' => false, 'placeholder' => '', 'style' => "clear:left", 'options' => $courseType, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 	
											</div>
										</div>	
									
									
										
											<div class="control-group">
											<label for="textfield" class="control-label"> &nbsp;</label>
											<div class="controls">
												&nbsp;
											</div>
										</div>
										
										
										
								
								
									</div>

								
									<div class="span6 eduTab" style="clear:both">
									
									<div class="control-group" style="border-top:1px solid #ddd">
											<label for="textfield" class="control-label"> &nbsp;</label>
											<div class="controls">
												&nbsp;
											</div>
										</div>	
										
									
								
								
										
										
	<div class="control-group">
											<label for="textfield" class="control-label">College Name <b>(UG)</b> </label>
											<div class="controls">
													<?php echo $this->Form->input('HrEducation.inst_name4', array('div'=> false,'type' => 'text', 'id' => 'college_name_#', 'label' => false, 'class' => 'input-xlarge', 'value' => $this->Session->read('education.inst_name4'), 'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											</div>
										</div>	
										
										
									<div class="control-group">
											<label for="textfield" class="control-label">Course </label>
											<div class="controls">
												<?php echo $this->Form->input('HrEducation.hr_course_id4', array('div'=> false,'type' => 'select', 'id' => 'college_name_#', 'label' => false, 'class' => 'input-xlarge get_spec', 'empty' => 'Select', 'required' => false, 'placeholder' => '','selected' => $this->Session->read('education.hr_course_id4'), 'val' => 'spec2', 'style' => "clear:left", 'options' => $ugcourseList, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 	
											</div>
										</div>
									

					<div class="control-group">
											<label for="textfield" class="control-label">Specialization </label>
											<div class="controls">
												<?php echo $this->Form->input('HrEducation.hr_specialization_id4', array('div'=> false,'type' => 'select', 'selected' => $this->Session->read('education.hr_specialization_id4'),'label' => false, 'class' => 'input-xlarge spec2', 'options' => $ugspecList,  'empty' => 'Select', 'required' => false, 'placeholder' => '', 'style' => "clear:left", 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 	
											</div>
										</div>		
										
									
																			

											<div class="control-group">
											<label for="textfield" class="control-label">% of Marks / Grade</label>
											<div class="controls">
													<?php echo $this->Form->input('HrEducation.percent_marks4', array('div'=> false,'type' => 'text', 'maxlength' => '6', 'label' => false, 'class' => 'input-xlarge',  'value' => $this->Session->read('education.percent_marks4'),  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 	
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
											<label for="textfield" class="control-label">Year of Passing </label>
											<div class="controls">
											<?php echo $this->Form->input('HrEducation.year_passing4', array('div'=> false,'type' => 'select', 'label' => false, 'class' => 'input-xlarge', 'empty' => 'Select', 'options' => $yearPass, 'selected' => $this->Session->read('education.year_passing4'), 'required' => false, 'placeholder' => '', 'style' => "clear:left",  'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?>
												
											</div>
										</div>
										
										
										
										<div class="control-group">
											<label for="textfield" class="control-label">University </label>
											<div class="controls">
													<?php echo $this->Form->input('HrEducation.university4', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-xlarge',  'required' => false, 'value' => $this->Session->read('education.university4'), 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											</div>
										</div>
										
																			

	<div class="control-group">
											<label for="textfield" class="control-label">Course Type </label>
											<div class="controls">
												<?php echo $this->Form->input('HrEducation.course_type4', array('div'=> false,'type' => 'select', 'label' => false, 'class' => 'input-xlarge', 'empty' => 'Select','selected' => $this->Session->read('education.course_type4'), 'required' => false, 'placeholder' => '', 'style' => "clear:left", 'options' => $courseType, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 	
											</div>
										</div>	
									
									
										<div class="control-group" >
											<label for="textfield" class="control-label"> &nbsp;</label>
											<div class="controls">
												&nbsp;
											</div>
										</div>	
										
										
										
										
										
								
								
									</div>


									
										
									<div class="span6 eduTab" style="clear:both">
									
									<div class="control-group" style="border-top:1px solid #ddd">
											<label for="textfield" class="control-label"> &nbsp;</label>
											<div class="controls">
												&nbsp;
											</div>
										</div>	
										
									
								
								
										
<div class="control-group">
											<label for="textfield" class="control-label">College Name <b>(PG)</b> </label>
											<div class="controls">
												<?php echo $this->Form->input('HrEducation.inst_name5', array('div'=> false,'type' => 'text', 'value' => $this->Session->read('education.inst_name5'),'label' => false, 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 	
											</div>
										</div>
									
										
										
									<div class="control-group">
											<label for="textfield" class="control-label">Course </label>
											<div class="controls">
												<?php echo $this->Form->input('HrEducation.hr_course_id5', array('div'=> false,'type' => 'select', 'id' => 'college_name_#', 'label' => false, 'class' => 'input-xlarge get_spec','selected' => $this->Session->read('education.hr_course_id5'),'val' => 'spec3',  'empty' => 'Select', 'required' => false, 'placeholder' => '', 'style' => "clear:left", 'options' => $pgcourseList, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 	
											</div>
										</div>
									

	<div class="control-group">
											<label for="textfield" class="control-label">Specialization </label>
											<div class="controls">
												<?php echo $this->Form->input('HrEducation.hr_specialization_id5', array('div'=> false,'type' => 'select','selected' => $this->Session->read('education.hr_specialization_id5'), 'options' => $pgspecList, 'label' => false, 'class' => 'input-xlarge spec3', 'empty' => 'Select', 'required' => false, 'placeholder' => '', 'style' => "clear:left", 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 	
											</div>
										</div>		
										
									
											<div class="control-group">
											<label for="textfield" class="control-label">% of Marks / Grade</label>
											<div class="controls">
													<?php echo $this->Form->input('HrEducation.percent_marks5', array('div'=> false,'type' => 'text', 'maxlength' => '6', 'label' => false, 'class' => 'input-xlarge', 'value' => $this->Session->read('education.percent_marks5'), 'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 	
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
											<label for="textfield" class="control-label">Year of Passing </label>
											<div class="controls">
												<?php echo $this->Form->input('HrEducation.year_passing5', array('div'=> false,'type' => 'select', 'label' => false, 'class' => 'input-xlarge', 'empty' => 'Select', 'selected' => $this->Session->read('education.year_passing5'),'options' => $yearPass, 'required' => false, 'placeholder' => '', 'style' => "clear:left",  'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?>

												
											</div>
										</div>
										
										
										
										<div class="control-group">
											<label for="textfield" class="control-label">University </label>
											<div class="controls">
													<?php echo $this->Form->input('HrEducation.university5', array('div'=> false,'type' => 'text',  'value' => $this->Session->read('education.university5'), 'label' => false, 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											</div>
										</div>
										
																			

	<div class="control-group">
											<label for="textfield" class="control-label">Course Type</label>
											<div class="controls">
												<?php echo $this->Form->input('HrEducation.course_type5', array('div'=> false,'type' => 'select', 'label' => false,  'selected' => $this->Session->read('education.course_type5'), 'class' => 'input-xlarge', 'empty' => 'Select', 'required' => false, 'placeholder' => '', 'style' => "clear:left", 'options' => $courseType, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 	
											</div>
										</div>	
									
									
										
										
										
										
										
								
								
									</div>

		

		
									<div class="span12">
										<div class="form-actions">
										<a href="<?php echo $this->webroot;?>hremployee/create_employee/personal/"><button type="button" class="btn"><i class="icon-arrow-left"></i> Previous</button></a>
							
											<input type="submit" value="Next" class="btn btn-primary">
							<?php if($this->Functions->check_reg_confirm($this->Session->read('reg'))):?>
								<input type="submit" value="Next & Confirm" class="btn btn-blue regconfirmBtn">
							<?php endif; ?>	
										<a href="<?php echo $this->webroot;?>hremployee/create_employee/education/?action=skip"><button type="button" class="btn skipReg" rel="education details">Skip <i class="icon-share-alt"></i></button></a>
											
										</div>
									
									
							</div>
							
	</div>	
	



					</div>
				


									
							
							
						</div>
					
					
					
					<input type="hidden" id="webroot" value="<?php echo $this->webroot;?>">
					<!--input type="hidden" id="end_date" value="<?php echo date('d/m/Y', strtotime((date('Y')-16).'-'.date('m').'-'.date('d')));?>"-->
					<input type="hidden" name="data[HrEducation][reg_confirm]" id="reg_confirm">
					<?php echo $this->Form->end(); ?>
					
				</div>
					</div>
		
			</div>		
					
				</div>
		
			
		
	
