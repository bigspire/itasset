<?php echo $this->element('fin_menu'); ?>
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Create Advance Request</h1>
					</div>
					
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>finhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="<?php echo $this->webroot;?>finadvance/">Advance</a>
								<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="#">Create Advance</a>
						</li>
					</ul>
					
				</div>
				<?php echo $this->Session->flash();?>
					<div class="row-fluid">
					<div class="span12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3><i class="icon-list"></i> Please fill the form to create advance request</h3>
							</div>
							<div class="box-content nopadding">
								
								
								<?php echo $this->Form->create('FinAdvance', array('id' => 'formID', 'class' => 'form-horizontal form-column form-bordered')); ?>
								
								
									<div class="span6">
										<div class="control-group">
											<label for="textfield" class="control-label">Purpose <span class="red_star">*</span></label>
											<div class="controls">
													<?php echo $this->Form->input('purpose', array('div'=> false,'type' => 'text','id' => 'field1', 'label' => false, 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
													<div class="error field1"></div>
													
												
											</div>
										</div>
										
										<div class="control-group">
											<label for="textfield" class="control-label">Debit to Client <span class="red_star">*</span></label>
											<div class="controls">
													<?php echo $this->Form->input('is_debit', array('div'=> false,'type' => 'radio', 'label' => false, 'style' => 'margin:4px 2px', 'class' => 'input-xlarge advDebit advDebt',  'options' => array('1' => 'Yes', '0' => 'No'), 'separator' => ' ', 'id' => 'field5', 'required' => false, 'placeholder' => '', 'legend' => false, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?>
													
													
													<?php echo $this->Form->input('tsk_company_id', array('div'=> false,'type' => 'select', 'label' => false, 'class' => 'input-xlarge comp_list', 'empty' => 'Select', 'required' => false, 'placeholder' => '', 'style' => "clear:left;display:none;", 'options' => $compList, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
													
													
													<div class="error field5"></div>
													
												
											</div>
										</div>
										
												<div class="control-group">
											<label for="password" class="control-label">Description <span class="red_star">*</span></label>
											<div class="controls">
												<?php echo $this->Form->input('description', array('div'=> false,'type' => 'textarea', 'rows' => '3','id' => 'field4', 'label' => false, 'class' => 'input-block-level',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												
												
												<div class="error field4"></div>
												
											</div>
										</div>
										
										

										
										
										
									
										
									</div>
									<div class="span6">
										<div class="control-group">
											<label for="textfield" class="control-label">Amount  (Rs) <span class="red_star">*</span></label>
											<div class="controls">
												<?php echo $this->Form->input('amount', array('div'=> false,'type' => 'text', 'id' => 'field3','label' => false, 'maxlength' => '6', 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												<div class="error field3"></div>
											</div>
										</div>
							
									<div class="control-group">
											<label for="password" class="control-label">Required Date <span class="red_star">*</span> <br><br><br><br><br><br></label>
											<div class="controls">
												<?php echo $this->Form->input('req_date', array('div'=> false,'type' => 'text', 'label' => false, 'id' => 'field2','class' => 'input-xlarge datepick',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												<div class="error field2"></div>
											</div>
										</div>
									
									</div>
									
									
									<div class="span12">
										<div class="form-actions">
										
											<input type="submit" class="btn btn-primary send_adv" value="Send" />
											<a href="<?php echo $this->webroot;?>finadvance/"><button type="button" class="btn">Cancel</button></a>
										</div>
									</div>
									<input type="hidden" value="<?php echo date('d/m/Y');?>" id="start_date">
									<input type="hidden" value="<?php echo $this->request->data['FinAdvance']['is_debit'];?>" id="hdnDebit">
								<?php echo $this->Form->end(); ?>
							</div>
						</div>
					</div>
				</div>
					
					
				</div>
		
			
			</div>
		</div>	
	<input type="hidden" value="<?php echo $this->webroot;?>finadvance/create_advance/" id="post_data">	
			
<div id="dialog-confirm" title="Confirmation!" class="dn">
	<p>Are you sure you want to send? once sent, it cannot be modified!</p>
</div>

