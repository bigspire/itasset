<?php echo $this->element('hr_menu'); ?>
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Create Leave Request </h1>
					</div>
					<?php if($this->Session->read('USER.Login.emp_type') == 'R'):?>	
					<a href="<?php echo $this->webroot;?>hrleave/leave_policy/" class="colorboxPolicy">
					<button type="button" class="btn btn-teal" style="float:right;margin-top:20px;">
							<i class="icon-zoom-in"></i> Leave Policy</button></a>
					<?php endif; ?>
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>hrhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="<?php echo $this->webroot;?>hrleave/">Leave</a>
								<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="#">Request Leave</a>
						</li>
					</ul>
					
				</div>
				<?php echo $this->Session->flash();?>
					<div class="row-fluid footer_div">
					<div class="span12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3><i class="icon-list"></i> Please fill the form to create leave request</h3>
							</div>
							<div class="box-content nopadding">
									<?php echo $this->Form->create('HrLeave', array('id' => 'formID', 'class' => 'form-horizontal form-column form-bordered')); ?>
									
								
									<div class="span8">
										<div class="control-group">
											<label for="textfield" class="control-label">Leave From <span class="red_star">*</span></label>
											<div class="controls">
											<?php echo $this->Form->input('leave_from', array('div'=> false,'type' => 'text', 'label' => false, 'id' => 'field1','class' => 'input-xlarge datepick fromDate changeDate',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?>  
											<span id="lveFrmDay" class="dayShow"></span>
											<div class="error field1"></div>
											</div>
										</div>
										
										<div class="control-group">
											<label for="password" class="control-label">Leave Till <span class="red_star">*</span></label>
											<div class="controls">
												<?php echo $this->Form->input('leave_to', array('div'=> false,'type' => 'text', 'label' => false, 'id' => 'field2','class' => 'input-xlarge datepick toDate changeDate',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												<span id="lveToDay" class="dayShow"></span>
												<div class="error field2"></div>
											</div>
										</div>
										
										
										<!--div class="control-group halfL dn">
											<label for="password" class="control-label">Is Half Day? </label>
											<div class="controls" >
												<?php echo $this->Form->input('is_half', array('div'=> false,'type' => 'checkbox', 'style' => "margin-left:3px", 'label' => false, 'id' => '','class' => 'input-xlarge is_half',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												
												
												<?php echo $this->Form->input('session', array('div'=> false,'type' => 'select', 'label' => false, 'class' => 'input-large session', 'empty' => 'Select', 'required' => false, 'placeholder' => '', 'style' => "clear:left;margin-left:20px;", 'options' => array('M' => 'Morning', 'A' => 'Afternoon'), 'id' => 'session', 'error' =>  array('attributes' => array('style' => "margin-left:38px", 'wrap' => 'div', 'class' => 'error')))); ?> 
												
											</div>
										</div-->
									
										<div class="control-group">
											<label for="password" class="control-label">No. of Days </label>
											<div class="controls" >
												<?php if(!empty($this->request->data['HrLeave']['no_days'])):?>
													<span style="margin-left:4px" id="no_days"><?php echo $this->request->data['HrLeave']['no_days']; ?></span>
												<?php else: ?>
													<span style="margin-left:4px" id="no_days">#</span>
												<?php endif; ?>
											
													Days
													
													<div class="error no_days_error"></div>
											</div>
										</div>

										<div class="control-group">
											<label for="password" class="control-label">Leave Type <span class="red_star">*</span></label>
											<div class="controls">
												<?php echo $this->Form->input('hr_leave_type_id', array('div'=> false,'type' => 'select', 'label' => false, 'class' => 'input-xlarge comp_off leave_type_id', 'empty' => 'Select',  'id' => 'field3', 'required' => false, 'placeholder' => '', 'style' => "clear:left", 'options' => $leaveType, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												<div class="error field3"></div>
												<?php if($pl_error == 'Sorry, you should apply for PL 7 days before date of leave'):?>
												<a href="<?php echo $this->webroot;?>hrleave/activate_pl/?from=<?php echo $this->request->data['HrLeave']['leave_from'];?>&to=<?php echo $this->request->data['HrLeave']['leave_to'];?>&no_days=<?php echo $this->request->data['HrLeave']['no_days'];?>" val="40_70" class="iframeBox">Create Request to Activate PL</a>
												<?php endif; ?>
												
											</div>
										</div>
										
											<div class="control-group compoff_row">
											<label for="password" class="control-label">Comp. Off For <span class="red_star">*</span></label>
											<div class="controls">
												<?php echo $this->Form->input('comp_off_dates', array('div'=> false, 'id' => 'compoff_box', "data-placeholder" => "Select Dates" , 'multiple' => 'multiple', 'type' => 'select', 'options' => $lastDays,  'label' => false, 'class' => 'chosen-select input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												<div class="error field5"></div>
												
												
											</div>
										</div>
										
										
										<div class="control-group">
											<label for="textfield" class="control-label">Reason <span class="red_star">*</span></label>
											<div class="controls">
												<?php echo $this->Form->input('reason', array('div'=> false,'type' => 'textarea', 'id' => 'field4', 'label' => false, 'class' => 'input-block-level', 'rows' => '3', 'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												<div class="error field4"></div>
											</div>
											</div>
										
									</div>
									<div class="span4">
										
											<div class="box">
						
							<?php echo $this->element('leave_status'); ?>
							
							
						</div>
					
									
									</div>
											
									
										<div class="span12">
										<div class="form-actions">
										<!-- -->
											<input type="submit" class="btn btn-primary send_lve" value="Send" />
											<a href="<?php echo $this->webroot;?>hrleave/"><button type="button" class="btn">Cancel</button></a>
										</div>
									</div>
										</div>
									</div>
									<?php //echo $this->Form->input('start_date', array('id' => 'start_date', 'type' => 'hidden', 'value' => date('d/m/Y'))); ?>
										<input type="hidden" value="<?php echo $this->webroot;?>hrleave/?action=lvtaken" id="taken_url">	
										<?php echo $this->Form->input('no_days', array('id' => 'nodays', 'type' => 'hidden')); ?>
										<?php echo $this->Form->input('user_id', array('id' => '', 'type' => 'hidden', 'value' => $this->Session->read('USER.Login.id'))); ?>
										<input type="hidden" value="<?php echo $this->webroot;?>hrleave/check_leave_days/" id="check_leave_url">	
								<?php echo $this->Form->end(); ?>
							</div>
						
					
				</div>
					
					
				</div>
		
			
			</div>
		</div>	
	<input type="hidden" value="<?php echo $this->webroot;?>hrleave/create_leave/" id="post_data">	
			
<div id="dialog-confirm" title="Confirmation!" class="dn">
	<p>Are you sure you want to send? once sent, it cannot be modified!</p>
</div>

<div id="lv-dialog-confirm" title="Confirmation!" class="dn">
	<p>Did you inform about your leave already?</p>
</div>

