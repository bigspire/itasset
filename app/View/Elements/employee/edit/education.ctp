<?php echo $this->element('hr_menu'); ?>
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Edit Employee</h1>
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
							<a href="#">Edit Employee</a>
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
												<?php echo $this->Form->input('HrEducation.inst_name1', array('div'=> false,'type' => 'text', 'value' => $edu_data[0]['HrEducation']['inst_name'], 'id' => 'college_name_#', 'label' => false, 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 	
											</div>
										</div>								
										
										
	<div class="control-group">
											<label for="textfield" class="control-label">Board </label>
											<div class="controls">
												<?php echo $this->Form->input('HrEducation.board1', array('div'=> false,'type' => 'select', 'selected' => $edu_data[0]['HrEducation']['board'],'id' => 'college_name_#', 'label' => false, 'class' => 'input-xlarge', 'empty' => 'Select', 'required' => false, 'placeholder' => '', 'style' => "clear:left", 'options' => $boardList, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											</div>
										</div>	
	
										
									</div>
									
									

									
									

<div class="span6 eduTab">	

	
					<div class="control-group">
											<label for="textfield" class="control-label">Year of Passing </label>
											<div class="controls">
												<?php echo $this->Form->input('HrEducation.year_passing1', array('div'=> false,'type' => 'select', 'selected' => $edu_data[0]['HrEducation']['year_passing'], 'label' => false, 'class' => 'input-xlarge', 'empty' => 'Select', 'options' => $yearPass, 'required' => false, 'placeholder' => '', 'style' => "clear:left",  'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?>

												
											</div>
										</div>
											<div class="control-group">
											<label for="textfield" class="control-label">% of Marks </label>
											<div class="controls">
												<?php echo $this->Form->input('HrEducation.percent_marks1', array('div'=> false,'type' => 'text', 'value' => $edu_data[0]['HrEducation']['percent_marks'], 'maxlength' => '6', 'label' => false, 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?>	
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
												<?php echo $this->Form->input('HrEducation.inst_name2', array('div'=> false,'type' => 'text','value' => $edu_data2[0]['HrEducation']['inst_name'],'id' => 'college_name_#', 'label' => false, 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 	
											</div>
										</div>								
										
										
	<div class="control-group">
											<label for="textfield" class="control-label">Board </label>
											<div class="controls">
													<?php echo $this->Form->input('HrEducation.board2', array('div'=> false,'type' => 'select', 'value' => $edu_data2[0]['HrEducation']['board'],'id' => 'college_name_#', 'label' => false, 'class' => 'input-xlarge', 'empty' => 'Select', 'required' => false, 'placeholder' => '', 'style' => "clear:left", 'options' => $boardList, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
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
												<?php echo $this->Form->input('HrEducation.year_passing2', array('div'=> false,'type' => 'select', 'label' => false, 'class' => 'input-xlarge', 'selected' => $edu_data2[0]['HrEducation']['year_passing'],'empty' => 'Select', 'options' => $yearPass, 'required' => false, 'placeholder' => '', 'style' => "clear:left",  'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?>

												
											</div>
										</div>
											<div class="control-group">
											<label for="textfield" class="control-label">% of Marks </label>
											<div class="controls">
												<?php echo $this->Form->input('HrEducation.percent_marks2', array('div'=> false,'type' => 'text', 'value' => $edu_data2[0]['HrEducation']['percent_marks'], 'maxlength' => '6', 'label' => false, 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?>
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
												<?php echo $this->Form->input('HrEducation.inst_name3', array('div'=> false,'type' => 'text', 'value' => $edu_data3[0]['HrEducation']['inst_name'], 'label' => false, 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 	
											</div>
										</div>
									
										
										
									<div class="control-group">
											<label for="textfield" class="control-label">Course </label>
											<div class="controls">
												<?php echo $this->Form->input('HrEducation.hr_course_id3', array('div'=> false,'type' => 'select', 'id' => 'college_name_#', 'label' => false, 'class' => 'input-xlarge get_spec', 'selected' => $edu_data3[0]['HrEducation']['hr_course_id'], 'val' => 'spec1', 'empty' => 'Select', 'required' => false, 'placeholder' => '', 'style' => "clear:left", 'options' => $dipcourseList, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 	
											</div>
										</div>
									

	<div class="control-group">
											<label for="textfield" class="control-label">Specialization </label>
											<div class="controls">
												<?php echo $this->Form->input('HrEducation.hr_specialization_id3', array('div'=> false,'type' => 'select', 'label' => false, 'class' => 'input-xlarge spec1', 'empty' => 'Select', 'options' => $dipspecList, 'selected' => $edu_data3[0]['HrEducation']['hr_specialization_id'],'required' => false, 'placeholder' => '', 'style' => "clear:left", 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 	
											</div>
										</div>		
										
									
											<div class="control-group">
											<label for="textfield" class="control-label">% of Marks / Grade</label>
											<div class="controls">
													<?php echo $this->Form->input('HrEducation.percent_marks3', array('div'=> false,'type' => 'text', 'maxlength' => '6', 'label' => false, 'class' => 'input-xlarge', 'value' =>  $edu_data3[0]['HrEducation']['percent_marks'], 'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 	
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
												<?php echo $this->Form->input('HrEducation.year_passing3', array('div'=> false,'type' => 'select', 'selected' => $edu_data3[0]['HrEducation']['year_passing'], 'label' => false, 'class' => 'input-xlarge', 'empty' => 'Select', 'options' => $yearPass, 'required' => false, 'placeholder' => '', 'style' => "clear:left",  'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?>

												
											</div>
										</div>
										
										
										
										<div class="control-group">
											<label for="textfield" class="control-label">University </label>
											<div class="controls">
													<?php echo $this->Form->input('HrEducation.university3', array('div'=> false,'type' => 'text', 'value' => $edu_data3[0]['HrEducation']['university'], 'label' => false, 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											</div>
										</div>
										
																			

	<div class="control-group">
											<label for="textfield" class="control-label">Course Type</label>
											<div class="controls">
												<?php echo $this->Form->input('HrEducation.course_type3', array('div'=> false,'type' => 'select', 'label' => false, 'class' => 'input-xlarge', 'empty' => 'Select', 'selected' => $edu_data3[0]['HrEducation']['course_type'], 'required' => false, 'placeholder' => '', 'style' => "clear:left", 'options' => $courseType, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 	
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
													<?php echo $this->Form->input('HrEducation.inst_name4', array('div'=> false,'type' => 'text', 'id' => 'college_name_#', 'label' => false, 'class' => 'input-xlarge', 'value' => $edu_data4[0]['HrEducation']['inst_name'], 'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											</div>
										</div>	
										
										
									<div class="control-group">
											<label for="textfield" class="control-label">Course </label>
											<div class="controls">
												<?php echo $this->Form->input('HrEducation.hr_course_id4', array('div'=> false,'type' => 'select', 'id' => 'college_name_#', 'label' => false, 'class' => 'input-xlarge get_spec', 'empty' => 'Select', 'required' => false, 'placeholder' => '','selected' => $edu_data4[0]['HrEducation']['hr_course_id'], 'val' => 'spec2', 'style' => "clear:left", 'options' => $ugcourseList, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 	
											</div>
										</div>
									

					<div class="control-group">
											<label for="textfield" class="control-label">Specialization </label>
											<div class="controls">
												<?php echo $this->Form->input('HrEducation.hr_specialization_id4', array('div'=> false,'type' => 'select', 'selected' => $edu_data4[0]['HrEducation']['hr_specialization_id'],'label' => false, 'class' => 'input-xlarge spec2', 'options' => $ugspecList,  'empty' => 'Select', 'required' => false, 'placeholder' => '', 'style' => "clear:left", 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 	
											</div>
										</div>		
										
									
																			

											<div class="control-group">
											<label for="textfield" class="control-label">% of Marks / Grade</label>
											<div class="controls">
													<?php echo $this->Form->input('HrEducation.percent_marks4', array('div'=> false,'type' => 'text', 'maxlength' => '6', 'label' => false, 'class' => 'input-xlarge',  'value' => $edu_data4[0]['HrEducation']['percent_marks'],  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 	
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
											<?php echo $this->Form->input('HrEducation.year_passing4', array('div'=> false,'type' => 'select', 'label' => false, 'class' => 'input-xlarge', 'empty' => 'Select', 'options' => $yearPass, 'selected' => $edu_data4[0]['HrEducation']['year_passing'], 'required' => false, 'placeholder' => '', 'style' => "clear:left",  'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?>
												
											</div>
										</div>
										
										
										
										<div class="control-group">
											<label for="textfield" class="control-label">University </label>
											<div class="controls">
													<?php echo $this->Form->input('HrEducation.university4', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-xlarge',  'required' => false, 'value' => $edu_data4[0]['HrEducation']['university'], 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											</div>
										</div>
										
																			

	<div class="control-group">
											<label for="textfield" class="control-label">Course Type </label>
											<div class="controls">
												<?php echo $this->Form->input('HrEducation.course_type4', array('div'=> false,'type' => 'select', 'label' => false, 'class' => 'input-xlarge', 'empty' => 'Select','selected' => $edu_data4[0]['HrEducation']['course_type'], 'required' => false, 'placeholder' => '', 'style' => "clear:left", 'options' => $courseType, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 	
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
												<?php echo $this->Form->input('HrEducation.inst_name5', array('div'=> false,'type' => 'text', 'value' => $edu_data5[0]['HrEducation']['inst_name'],'label' => false, 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 	
											</div>
										</div>
									
										
										
									<div class="control-group">
											<label for="textfield" class="control-label">Course </label>
											<div class="controls">
												<?php echo $this->Form->input('HrEducation.hr_course_id5', array('div'=> false,'type' => 'select', 'id' => 'college_name_#', 'label' => false, 'class' => 'input-xlarge get_spec','selected' => $edu_data5[0]['HrEducation']['hr_course_id'], 'val' => 'spec3',  'empty' => 'Select', 'required' => false, 'placeholder' => '', 'style' => "clear:left", 'options' => $pgcourseList, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 	
											</div>
										</div>
									

	<div class="control-group">
											<label for="textfield" class="control-label">Specialization </label>
											<div class="controls">
												<?php echo $this->Form->input('HrEducation.hr_specialization_id5', array('div'=> false,'type' => 'select','selected' => $edu_data5[0]['HrEducation']['hr_specialization_id'], 'options' => $pgspecList, 'label' => false, 'class' => 'input-xlarge spec3', 'empty' => 'Select', 'required' => false, 'placeholder' => '', 'style' => "clear:left", 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 	
											</div>
										</div>		
										
									
											<div class="control-group">
											<label for="textfield" class="control-label">% of Marks / Grade</label>
											<div class="controls">
													<?php echo $this->Form->input('HrEducation.percent_marks5', array('div'=> false,'type' => 'text', 'maxlength' => '6', 'label' => false, 'class' => 'input-xlarge', 'value' => $edu_data5[0]['HrEducation']['percent_marks'], 'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 	
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
												<?php echo $this->Form->input('HrEducation.year_passing5', array('div'=> false,'type' => 'select', 'label' => false, 'class' => 'input-xlarge', 'empty' => 'Select', 'selected' => $edu_data5[0]['HrEducation']['year_passing'],'options' => $yearPass, 'required' => false, 'placeholder' => '', 'style' => "clear:left",  'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?>

												
											</div>
										</div>
										
										
										
										<div class="control-group">
											<label for="textfield" class="control-label">University </label>
											<div class="controls">
													<?php echo $this->Form->input('HrEducation.university5', array('div'=> false,'type' => 'text',  'value' => $edu_data5[0]['HrEducation']['university'], 'label' => false, 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											</div>
										</div>
										
																			

	<div class="control-group">
											<label for="textfield" class="control-label">Course Type</label>
											<div class="controls">
												<?php echo $this->Form->input('HrEducation.course_type5', array('div'=> false,'type' => 'select', 'label' => false,  'selected' => $edu_data5[0]['HrEducation']['course_type'], 'class' => 'input-xlarge', 'empty' => 'Select', 'required' => false, 'placeholder' => '', 'style' => "clear:left", 'options' => $courseType, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 	
											</div>
										</div>	
									
									
										
										
										
										
										
								
								
									</div>

		

		
								<div class="span12">
					<div class="form-actions">
				
					 <?php echo $this->Form->submit('Save ', array('div'=> false,  'label' => false, 'class' => 'btn btn-blue')); ?> 
					<a href="<?php echo $this->webroot;?>hremployee/view_employee/<?php echo $this->request->params['pass'][1];?>#education"><button type="button" class="btn">Cancel</button></a>
											
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
		
			
		
	
