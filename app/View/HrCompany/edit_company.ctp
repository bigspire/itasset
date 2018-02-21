<?php echo $this->element('hr_menu'); ?>
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Edit Company</h1>
					</div>
					
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>hrhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="<?php echo $this->webroot;?>hrcompany/">Company</a>
								<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="#">Edit Company</a>
						</li>
					</ul>
					
				</div>
				
				<?php echo $this->Session->flash();?>
				
					<div class="row-fluid footer_div">
					<div class="span12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3><i class="icon-list"></i> Please fill the form to edit the company</h3>
							</div>
							<div class="box-content nopadding">
								
								
								<?php echo $this->Form->create('HrCompany', array('type' => 'file', 'id' => 'formID', 'class' => 'form-horizontal form-column form-bordered')); ?>
								
								
									<div class="span6">
										<div class="control-group">
											<label for="textfield" class="control-label">Company <span class="red_star">*</span></label>
											<div class="controls">
													<?php echo $this->Form->input('company_name', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
													
												
											</div>
										</div>
										<div class="control-group">
											<label for="password" class="control-label">Logo </label>
											<div class="controls">
												<?php echo $this->Form->input('upload_file', array('div'=> false,'type' => 'text', 'label' => false, 'type' => 'file',  'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?>

						<div style="margin-top:10px">
							
							<img class="nav-user-photo" src="<?php echo $this->webroot;?>timthumb.php?src=uploads/company/<?php echo $this->request->data['HrCompany']['logo'];?>&h=40&q=100"/>
							
						</div>
							
											</div>
											
											
										</div>

										
										<div class="control-group">
											<label for="textfield" class="control-label">Landline <span class="red_star">*</span></label>
											<div class="controls">
												<?php echo $this->Form->input('landline', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											</div>
										</div>
										
										<div class="control-group">
											<label for="textfield" class="control-label">Mobile </label>
											<div class="controls">
												<?php echo $this->Form->input('mobile', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											</div>
										</div>
										
										
									<div class="control-group">
											<label for="password" class="control-label">Address <span class="red_star">*</span></label>
											<div class="controls">
												<?php echo $this->Form->input('address', array('div'=> false,'type' => 'textarea', 'label' => false, 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												
												
											</div>
										</div>
										<div class="control-group">
											<label for="textfield" class="control-label">City <span class="red_star">*</span></label>
											<div class="controls">
												<?php echo $this->Form->input('city', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											</div>
										</div>
										<div class="control-group">
											<label for="textfield" class="control-label">Bank Name <span class="red_star">*</span></label>
											<div class="controls">
												<?php echo $this->Form->input('bank_name', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											</div>
										</div>
										
										<div class="control-group">
											<label for="textfield" class="control-label">Account Name <span class="red_star">*</span></label>
											<div class="controls">
												<?php echo $this->Form->input('account_name', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											</div>
										</div>
										
											
										<div class="control-group">
											<label for="textfield" class="control-label">Account No. <span class="red_star">*</span></label>
											<div class="controls">
												<?php echo $this->Form->input('account_no', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											</div>
										</div>
										
											
										
									</div>
								



<div class="span6">		

<div class="control-group">
											<label for="textfield" class="control-label">Bank Address <span class="red_star">*</span></label>
											<div class="controls">
												<?php echo $this->Form->input('branch_address', array('div'=> false,'type' => 'textarea', 'rows' => '2', 'label' => false, 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											</div>
										</div>
										
											<div class="control-group">
											<label for="textfield" class="control-label">IFSC Code </label>
											<div class="controls">
												<?php echo $this->Form->input('ifsc_code', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-xlarge', 'empty' => 'Select', 'required' => false, 'placeholder' => '', 'style' => "clear:left", 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											</div>
										</div>
										
										
											<div class="control-group">
											<label for="textfield" class="control-label">Swift Code </label>
											<div class="controls">
												<?php echo $this->Form->input('swift_code', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-xlarge', 'empty' => 'Select', 'required' => false, 'placeholder' => '', 'style' => "clear:left",'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											</div>
										</div>

									
									
									<div class="control-group">
											<label for="textfield" class="control-label">State <span class="red_star">*</span></label>
											<div class="controls">
												<?php echo $this->Form->input('app_state_id', array('div'=> false,'type' => 'select', 'label' => false, 'class' => 'input-xlarge', 'empty' => 'Select', 'required' => false, 'placeholder' => '', 'style' => "clear:left", 'options' => $stateList, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 	
											</div>
										</div>							
									
									<div class="control-group">
											<label for="textfield" class="control-label">Pincode <span class="red_star">*</span></label>
											<div class="controls">
												<?php echo $this->Form->input('pincode', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											</div>
										</div>
										
											
												<div class="control-group">
											<label for="textfield" class="control-label">Website </label>
											<div class="controls">
												<?php echo $this->Form->input('website', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											</div>
										</div>
										
										
									<div class="control-group">
											<label for="textfield" class="control-label">TAN </label>
											<div class="controls">
												<?php echo $this->Form->input('tan', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											</div>
										</div>
										
										
														
									<div class="control-group">
											<label for="textfield" class="control-label">PAN </label>
											<div class="controls">
												<?php echo $this->Form->input('pan', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											</div>
										</div>
										
										
																
									<div class="control-group">
											<label for="textfield" class="control-label">Service Reg. No. </label>
											<div class="controls">
												<?php echo $this->Form->input('service_reg_no', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											</div>
										</div>
										
																
									<div class="control-group">
											<label for="textfield" class="control-label">Company Reg. No. </label>
											<div class="controls">
												<?php echo $this->Form->input('company_reg_no', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											</div>
										</div>
										
									
										
										</div>
										
										
										
									<div class="span12">
										<div class="form-actions">
											<input type="submit" class="btn btn-primary" value="Save changes">
											<a href="<?php echo $this->webroot;?>hrcompany/"><button type="button" class="btn">Cancel</button></a>
										</div>
									</div>
									<?php echo $this->Form->input('id', array('type' => 'hidden'));?>
								<?php echo $this->Form->end(); ?>
							</div>
						</div>
					</div>
				</div>
					
					
				</div>
		
			
			</div>
		</div>	
			
	
