<?php echo $this->element('fin_menu'); ?>
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Pay Advance Amount</h1>
					</div>
					
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>finhome/">HrEmployee</a>
							<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="<?php echo $this->webroot;?>finadvpay/">Pay Advance</a>
								<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="#">Pay Advance</a>
						</li>
					</ul>
					
				</div>
					<?php echo $this->Session->flash();?>
					<div class="row-fluid">
					<div class="span12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3><i class="icon-list"></i> Please fill the form to pay advance</h3>
							</div>
							<div class="box-content nopadding">
								
								
								<?php echo $this->Form->create('FinAdvPay', array('id' => 'formID', 'class' => 'form-horizontal form-column form-bordered')); ?>
								
								
									<div class="span6">
										<div class="control-group">
											<label for="textfield" class="control-label">Employee </label>
											<div class="controls">
													<?php echo $user_data['Home']['full_name']?>
													
												
											</div>
										</div>
										<div class="control-group">
											<label for="textfield" class="control-label">Description </label>
											<div class="controls">
													<?php echo $adv_data['FinAdvance']['description']?>
													
												
											</div>
										</div>
										
										<div class="control-group">
											<label for="password" class="control-label">Pay Amount (Rs.) <span class="red_star">*</span></label>
											<div class="controls">
												<?php echo $this->Form->input('amount', array('div'=> false,'type' => 'text', 'label' => false, 'maxlength' => 6, 'class' => 'input-xlarge', 'id' => 'field1', 'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												<div class="error field1"></div>
											</div>
										</div>

										<div class="control-group">
											<label for="password" class="control-label">Date of Payment <span class="red_star">*</span> </label>
											<div class="controls">
												<?php echo $this->Form->input('paid_date', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-xlarge datepick',  'id' => 'field2', 'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												<div class="error field2"></div>
											</div>
										</div>
										
											<div class="control-group">
											<label for="textfield" class="control-label">Remarks </label>
											<div class="controls">
													<?php echo $this->Form->input('remarks', array('div'=> false,'type' => 'textarea', 'label' => false, 'class' => 'input-block-level', 'rows' => '2', 'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											</div>
										</div>
									
										
									</div>
									<div class="span6">
										<div class="control-group">
											<label for="textfield" class="control-label">Purpose </label>
											<div class="controls">
													<?php echo $adv_data['FinAdvance']['purpose']?>
													
												
											</div>
										</div>
											<div class="control-group">
											<label for="textfield" class="control-label">Required Amount (Rs)  </label>
											<div class="controls">
													<?php echo $this->Functions->money_display($adv_data['FinAdvance']['amount']);?>
													
												
											</div>
										</div>
										<div class="control-group">
											<label for="textfield" class="control-label">Pay Mode <span class="red_star">*</span></label>
											<div class="controls">
												<?php echo $this->Form->input('pay_mode', array('div'=> false,'type' => 'select', 'label' => false, 'class' => 'input-xlarge', 'id' => 'field3', 'empty' => 'Select', 'required' => false, 'placeholder' => '', 'style' => "clear:left", 'options' => $modeList, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
<div class="error field3"></div>												
												
												
											
											</div>
										</div>
									
									<div class="control-group">
											<label for="password" class="control-label">Pay Ref. No. </label>
											<div class="controls">
												<?php echo $this->Form->input('pay_refno', array('div'=> false,'type' => 'text', 'label' => false, 'maxlength' => 10, 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												
												
											</div>
										</div>
									
								
									</div>
									<div class="span12">
										<div class="form-actions">
											<input type="submit" class="btn btn-primary pay_adv" value="Pay"/>
											<a href="<?php echo $this->webroot;?>finadvpay/"><button type="button" class="btn">Cancel</button></a>
										</div>
									</div>
									<input type="hidden" value="<?php echo $this->webroot;?>finadvpay/pay_advance/<?php echo $this->request->params['pass'][0];?>" id="post_data">	
										<input type="hidden" value="<?php echo date('d/m/Y');?>" id="end_date">
								<?php echo $this->Form->end(); ?>
							</div>
						</div>
					</div>
				
			
				
				</div>
					
						<?php echo $this->element('adv_payment'); ?>
				
				
				<?php echo $this->element('remarks');?>
					
				</div>
		
			
			</div>
		</div>	
			
<div id="dialog-confirm" title="Confirmation!" class="dn">
	<p>Are you sure you want to pay? once paid, it cannot be modified!</p>
</div>

	
	
	
