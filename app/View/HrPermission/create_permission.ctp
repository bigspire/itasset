<?php echo $this->element('hr_menu'); ?>
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Create Permission Request</h1>
					</div>
					
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>hrhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="<?php echo $this->webroot;?>hrpermission/">Permission</a>
								<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="#">Request Permission</a>
						</li>
					</ul>
					
				</div>
				
				
					<div class="row-fluid footer_div">
					<div class="span12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3><i class="icon-list"></i> Please fill the form to create permission request</h3>
							</div>
							<div class="box-content nopadding">
									<?php echo $this->Form->create('HrPermission', array('id' => 'formID', 'class' => 'form-horizontal form-column form-bordered')); ?>
									
								
									<div class="span6">
									
										<div class="control-group">
											<label for="textfield" class="control-label">Permission Date <span class="red_star">*</span></label>
											<div class="controls">
											<?php echo $this->Form->input('per_date', array('div'=> false,'type' => 'text', 'label' => false, 'id' => 'field1','class' => 'input-xlarge attDate datepick',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											<span id="attFrmDay" class="dayShow"></span>
											<div class="error field1"></div>
											</div>
										</div>
										
										
										<div class="control-group">
											<label for="textfield" class="control-label">From <span class="red_star">*</span></label>
											<div class="controls bootstrap-timepicker">
											<?php echo $this->Form->input('per_from', array('div'=> false,'type' => 'text', 'label' => false, 'id' => 'field2','class' => 'input-xlarge timepick fromTime timeChange',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											<div class="error field2"></div>
											</div>
											
											
											
										</div>
										
										 
										
										<div class="control-group">
											<label for="password" class="control-label">To <span class="red_star">*</span></label>
											<div class="controls bootstrap-timepicker">
												<?php echo $this->Form->input('per_to', array('div'=> false,'type' => 'text', 'label' => false, 'id' => 'field3','class' => 'input-xlarge timepick toTime timeChange',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												<div class="error field3"></div>
											</div>
										</div>
									
									</div>
									<div class="span6">
										<div class="control-group">
											<label for="password" class="control-label">Total Hrs. </label>
											<div class="controls" >
												<?php if(!empty($this->request->data['HrPermission']['no_hrs_lbl'])):?>
													<span style="margin-left:4px" id="no_hrs"><?php echo $this->request->data['HrPermission']['no_hrs_lbl']; ?></span>
												<?php else: ?>
													<span style="margin-left:4px" id="no_hrs"># Hrs</span>
												<?php endif; ?>
												
											
													
											</div>
										</div>

									
								
											
											
										
										<div class="control-group">
											<label for="textfield" class="control-label">Reason <span class="red_star">*</span><br><br><br><br></label>
											<div class="controls">
												<?php echo $this->Form->input('reason', array('div'=> false,'type' => 'textarea', 'id' => 'field4', 'label' => false, 'class' => 'input-block-level', 'rows' => '3', 'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												<div class="error field4"></div>
											</div>
											</div>
										
									</div>
									
											
									
										<div class="span12">
										<div class="form-actions">
											<input type="submit" class="btn btn-primary send_perm" value="Send" />
											<a href="<?php echo $this->webroot;?>hrpermission/"><button type="button" class="btn">Cancel</button></a>
										</div>
									</div>
										</div>
									</div>
									<?php //echo $this->Form->input('start_date', array('id' => 'start_date', 'type' => 'hidden', 'value' => date('d/m/Y'))); ?>
									<input type="hidden" value="<?php echo $this->webroot;?>hrpermission/?action=pertaken" id="taken_url">	
										<?php echo $this->Form->input('no_hrs', array('id' => 'nohrs', 'type' => 'hidden'));echo $this->Form->input('no_hrs_lbl', array('id' => 'nohrslbl', 'type' => 'hidden')); ?>
										<?php echo $this->Form->input('user_id', array('id' => '', 'type' => 'hidden', 'value' => $this->Session->read('USER.Login.id'))); ?>
										<input type="hidden" value="create_permission" id="page">	
								<?php echo $this->Form->end(); ?>
							</div>
						
					
				</div>
					
					
				</div>
		
			
			</div>
		</div>	
	<input type="hidden" value="<?php echo $this->webroot;?>hrpermission/create_permission/" id="post_data">	
			
<div id="dialog-confirm" title="Confirmation!" class="dn">
	<p>Are you sure you want to send? once sent, it cannot be modified!</p>
</div>

<div id="per-dialog-confirm" title="Confirmation!" class="dn">
	<p>Did you inform about your permission already?</p>
</div>


