<?php echo $this->element('fin_menu'); ?>
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Edit Project</h1>
					</div>
					
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>finhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="<?php echo $this->webroot;?>tskprojects/">Project</a>
								<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="#">Edit Project</a>
						</li>
					</ul>
					
				</div>
				
				<?php echo $this->Session->flash();?>
				
					<div class="row-fluid  footer_div">
					<div class="span12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3><i class="icon-list"></i> Please fill the form to edit project</h3>
							</div>
							<div class="box-content nopadding">
								
								
								<?php echo $this->Form->create('TskProject', array('id' => 'formID', 'class' => 'form-horizontal form-column form-bordered')); ?>
								
								<div class="span6">
									
										<div class="control-group">
											<label for="textfield" class="control-label">Company Name <span class="red_star">*</span></label>
											<div class="controls">
												<?php echo $this->Form->input('tsk_company_id', array('div'=> false,'type' => 'select', 'label' => false, 'class' => 'input-xlarge', 'empty' => 'Select', 'required' => false, 'placeholder' => '', 'style' => "clear:left", 'options' => $compList, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 	
											</div>
										</div>
										
										
										<div class="control-group">
											<label for="textfield" class="control-label">Project Name <span class="red_star">*</span></label>
											<div class="controls">
													<?php echo $this->Form->input('project_name', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
													
												
											</div>
										</div>
										<div class="control-group">
											<label for="password" class="control-label">Project Short Code <span class="red_star">*</span><br></label>
											<div class="controls">
												<?php echo $this->Form->input('proj_short_code', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-xlarge', 'maxlength' => '6', 'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											</div>
										</div>

										
										
													<div class="control-group">
											<label for="textfield" class="control-label">Status <span class="red_star">*</span></label>
											<div class="controls">
													<?php echo $this->Form->input('status', array('div'=> false,'type' => 'select', 'label' => false, 'class' => 'input-xlarge', 'empty' => 'Select', 'required' => false, 'placeholder' => '', 'style' => "clear:left", 'options' => $projStatus, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											</div>
										</div>
									
									
									<div class="control-group">
											<label for="textfield" class="control-label">Project Leader <span class="red_star">*</span></label>
											<div class="controls">
												<?php echo $this->Form->input('project_leader', array('div'=> false,'type' => 'select', 'label' => false, 'class' => 'input-xlarge', 'empty' => 'Select', 'required' => false, 'placeholder' => '', 'style' => "clear:left", 'options' => $empList, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 	
											</div>
										</div>
									
									<div class="control-group">
											<label for="textfield" class="control-label">Project Members <span class="red_star">*</span> </label>
											<div class="controls">
											
					<?php echo $this->Form->input('member', array('div'=> false, 'id' => '', "data-placeholder" => "Select Members" , 'multiple' => 'multiple', 'type' => 'select', 'options' => $empList, 'selected' => $members, 'label' => false, 'class' => 'chosen-select input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
													<div class="error reasonChk"></div>
											</div>
										</div>	
										
									</div>
									<div class="span6">
										<div class="control-group">
											<label for="textfield" class="control-label">Start Date <span class="red_star">*</span></label>
											<div class="controls">
												<?php echo $this->Form->input('start_date', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-xlarge datepick',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											</div>
										</div>
									<div class="control-group">
											<label for="password" class="control-label">Target Finish Date </label>
											<div class="controls">
												<?php echo $this->Form->input('target_finish', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-xlarge datepick',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												
												
											</div>
										</div>
										<div class="control-group">
											<label for="textfield" class="control-label">PO Number </label>
											<div class="controls">
												<?php echo $this->Form->input('po_number', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											</div>
										</div>
										
										<div class="control-group">
											<label for="textfield" class="control-label">Purchse Order </label>
											<div class="controls">
												<?php echo $this->Form->input('purchase_order', array('div'=> false,'type' => 'file', 'label' => false, 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											</div>
										</div>
										
										<div class="control-group">
											<label for="textfield" class="control-label">Payment Terms </label>
											<div class="controls">
												<?php echo $this->Form->input('payment_terms', array('div'=> false, 'rows' => 3,'type' => 'textarea', 'label' => false, 'class' => 'input-xlarge', 'required' => false, 'placeholder' => '', 'style' => "clear:left", 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											</div>
										</div>
										</div>
										
						
									<div class="span12">
										<div class="form-actions">
											<input type="submit" value="Save changes" class="btn btn-primary">
											<a href="<?php echo $this->webroot;?>tskprojects/"><button type="button" class="btn">Cancel</button></a>
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
			
	
