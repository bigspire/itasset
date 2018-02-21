<?php echo $this->element('hr_menu'); ?>
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Request Attendance Change</h1>
					</div>
					
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>hrhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="<?php echo $this->webroot;?>hrattchange/">Attendance Change</a>
								<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="#">Request Attendance Change</a>
						</li>
					</ul>
					
				</div>
				
					<?php echo $this->element('att_change_status');?>
					<div class="row-fluid footer_div">
					<div class="span12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3><i class="icon-list"></i> Please fill the form to create attendance change request</h3>
							</div>
							<div class="box-content nopadding">
									<?php echo $this->Form->create('HrAttChange', array('id' => 'formID', 'class' => 'form-horizontal form-column form-bordered')); ?>
									
								
									<div class="span12">
									
										<div class="control-group">
											<label for="textfield" class="control-label">Date <span class="red_star">*</span></label>
											<div class="controls">
											<?php echo $this->Form->input('att_date', array('div'=> false,'type' => 'text', 'label' => false, 'id' => 'field1','class' => 'input-xlarge attDate datepick',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											<span id="attFrmDay" class="dayShow"></span>
											<div class="error field1"></div>
											</div>
										</div>
										
										
										<div class="control-group">
											<label for="textfield" class="control-label">Type <span class="red_star">*</span></label>
											<div class="controls bootstrap-timepicker">
											<?php echo $this->Form->input('att_type', array('div'=> false,'type' => 'radio', 'label' => false, 'class' => 'input-xlarge attType',  'options' => $types, 'separator' => ' ', 'id' => 'field2', 'required' => false, 'placeholder' => '', 'legend' => false, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?>
											<div class="error field2"></div>
											</div>
											
											
											
										</div>
									
										<div class="control-group in_att_time">
							
											<label for="password" class="control-label">In Time <span class="red_star">*</span></label>
											<div class="controls bootstrap-timepicker">
												<?php echo $this->Form->input('in_time', array('div'=> false,'type' => 'text', 'label' => false, 'id' => 'field4','class' => 'input-xlarge timepickDefault in_att_time_field',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												<div class="error field4"></div>
											</div>
										</div>
										
										
							
										
											<div class="control-group out_att_time">
							
											<label for="password" class="control-label">Out Time <span class="red_star">*</span></label>
											<div class="controls bootstrap-timepicker">
												<?php echo $this->Form->input('out_time', array('div'=> false,'type' => 'text', 'label' => false, 'id' => 'field5','class' => 'input-xlarge timepickDefault out_att_time_field',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												<div class="error field5"></div>
											</div>
										</div>
							

							
							
							
								
										 <div class="control-group">
											<label for="textfield" class="control-label">Reason <span class="red_star">*</span><br><br><br><br></label>
											<div class="controls">
												<?php echo $this->Form->input('reason', array('div'=> false,'type' => 'textarea', 'id' => 'field3', 'label' => false, 'class' => 'input-block-level', 'rows' => '3', 'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												<div class="error field3"></div>
											</div>
											</div>
											
						
										
										
										
									
									</div>
									
											
									
										<div class="span12">
										<div class="form-actions">
											<input type="submit" class="btn btn-primary att_changeReq" value="Send" />
											<a href="<?php echo $this->webroot;?>hrattchange/"><button type="button" class="btn">Cancel</button></a>
										</div>
									</div>
										</div>
									</div>
									
									<input type="hidden" value="<?php echo date('d/m/Y');?>" id="end_date">
									<input type="hidden" value="<?php echo date('d/m/Y', strtotime(date('Y-m-d').  '-3 days'));?>" id="start_date">
									
		<?php echo $this->Form->input('user_id', array('id' => '', 'type' => 'hidden', 'value' => $this->Session->read('USER.Login.id'))); 
					 echo $this->Form->input('attType', array('id' => 'attType', 'type' => 'hidden')); 
					 
								 echo $this->Form->end(); ?>
							</div>
						
					
				</div>
					
					
				</div>
		
			
			</div>
		</div>	
	<input type="hidden" value="<?php echo $this->webroot;?>hrattchange/change_attendance/" id="post_data">	
			
<div id="dialog-confirm" title="Confirmation!" class="dn">
	<p>Are you sure you want to send? once sent, it cannot be modified!</p>
</div>



