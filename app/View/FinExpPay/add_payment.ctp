<?php echo $this->element('fin_menu'); ?>
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Pay Expense Amount</h1>
					</div>
					
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>finhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="<?php echo $this->webroot;?>finexppay/">Pay Expense</a>
								<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="#">Pay Expense</a>
						</li>
					</ul>
					
				</div>
				
				<?php echo $this->Session->flash();?>
				
					<div class="row-fluid footer_div">
					<div class="span12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3><i class="icon-list"></i> Please fill the form to pay expense</h3>
							</div>
							<div class="box-content nopadding">
								
								
								<?php echo $this->Form->create('FinExpPay', array('id' => 'formID', 'class' => 'form-horizontal form-column form-bordered')); ?>
								
								
									<div class="span6">
										<div class="control-group">
											<label for="textfield" class="control-label">Employee </label>
											<div class="controls">
													<?php echo $user_data['Home']['full_name']?>
													
												
											</div>
										</div>
										<div class="control-group">
											<label for="password" class="control-label">Expenses </label>
											<div class="controls">
												Rs. <?php echo $exp_data[0]['FinExpenses']['amount'];?> <a val="45_50" rel="tooltip" title="Expense Details" href="<?php echo $this->webroot;?>finexppay/view_exp/<?php echo $this->request->params['pass'][0];?>" class="iframeBox">(Details)</a>
												<input type="hidden" id="expense" value="<?php echo $exp_data[0]['FinExpenses']['amount'];?>">
											</div>
										</div>

										<div class="control-group">
											<label for="password" class="control-label">Advance Amount </label>
											<div class="controls">
											<?php if(!empty($SUM_ADVANCE)):?>
												Rs. <?php echo $SUM_ADVANCE; ?>
	<!--a val="45_50" rel="tooltip" title="Advance Details" href="<?php echo $this->webroot;?>finexppay/view_adv/<?php echo $this->request->params['pass'][0];?>" class="iframeBox">(Details)</a-->
											<?php else: ?>
											Nil
											<?php endif; ?>
												<input type="hidden" id="sum_adv" value="<?php echo $SUM_ADVANCE;?>">
												<?php echo $this->Form->input('tot_advance', array('value' => $SUM_ADVANCE, 'id' => 'tot_advance', 'type' => 'hidden')); ?> 
											</div>
										</div>
										
											<div class="control-group">
											<label for="password" class="control-label">Adjust Against Adv.<br></label>
											<div class="controls">
											
											<?php 
											if($SUM_ADVANCE >= $exp_data[0]['FinExpenses']['amount']):
											$adj_disable = 'disabled';
											endif;
											?>
												<?php echo $this->Form->input('adjust_advance', array('div'=> false, 'disabled' => $adj_disable, 'type' => 'checkbox', 'label' => false, 'class' => 'input-xlarge adj_adv',
												'id' => 'field1', 'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												<div class="error field1"></div>
											</div>
										</div>
									
											<div class="control-group">
											<label for="password" class="control-label"> Payable to  Employee <br><br></label>
											<div class="controls">
												Rs. <span id="pay_emp">0</span>
												<?php echo $this->Form->input('amount', array('value' => 0, 'id' => 'amount','type' => 'hidden')); ?> 
											</div>
										</div>
										
											<div class="control-group">
											<label for="password" class="control-label"> Total balance advance in Hand </label>
											<div class="controls">
												Rs. <span id="balance_hand">0</span> 
												
												<?php echo $this->Form->input('balance_hand', array('id' => 'balance','type' => 'hidden', 'class' => 'balance_hand')); ?> 
													<?php echo $this->Form->input('balance_final', array('id' => 'balance_final','type' => 'hidden', 'class' => 'balance_final')); ?>
											</div>
											
										</div>
										
										
										
										
									</div>
									<div class="span6">
									
									
								<div class="control-group">
											<label for="password" class="control-label"> Received from Emp. </label>
											<div class="controls receive_input">
											<?php $receive = $SUM_ADVANCE - $exp_data[0]['FinExpenses']['amount'];
												if(abs($receive) > 0): ?>
												<?php echo $this->Form->input('amt_received', array('div'=> false,'type' => 'text', 'label' => false, 'maxlength' => 6, 'id' => 'amt_received', 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											<?php else: ?>
											--
											<?php endif; ?>
												
											</div>
										</div>
										
										
											<div class="control-group">
											<label for="password" class="control-label"> Payment Date <span class="red_star">*</span>  </label>
											<div class="controls">
												<?php echo $this->Form->input('paid_date', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-xlarge datepick',  'id' => 'field2', 'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												<div class="error field2"></div>
											</div>
										</div>
										
										
										
										
										
										<div class="control-group">
											<label for="textfield" class="control-label">Payment Mode <span class="red_star">*</span>  </label>
											<div class="controls">
												<?php echo $this->Form->input('pay_mode', array('div'=> false,'type' => 'select', 'label' => false, 'class' => 'input-xlarge',  'id' => 'field3','empty' => 'Select', 'required' => false, 'placeholder' => '', 'style' => "clear:left", 'options' => $modeList, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 	
												
												<div class="error field3"></div>
											
											</div>
										</div>
										
									<div class="control-group">
											<label for="password" class="control-label">Payment Ref. No. </label>
											<div class="controls">
												<?php echo $this->Form->input('pay_refno', array('div'=> false,'type' => 'text', 'label' => false, 'maxlength' => 10, 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												
												
											</div>
										</div>
									
									<div class="control-group">
											<label for="textfield" class="control-label">Remarks </label>
											<div class="controls">
													<?php echo $this->Form->input('remarks', array('div'=> false,'type' => 'textarea', 'label' => false, 'class' => 'input-block-level',  'required' => false, 'placeholder' => '', 'rows' => '2', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											</div>
										</div>
										
											<div class="control-group">
											<label for="password" class="control-label"> <br> </label>
											<div class="controls">
												
												
												
											</div>
										</div>
										
										
									</div>
									<div class="span12">
										<div class="form-actions">
											<input type="submit" class="btn btn-primary pay_exp" value="Pay"/>
											<a href="<?php echo $this->webroot;?>finexppay/"><button type="button" class="btn">Cancel</button></a>
										</div>
									</div>
										
										<input type="hidden" value="<?php echo $this->webroot;?>finexppay/add_payment/<?php echo $this->request->params['pass'][0];?>" id="post_data">	
										<input type="hidden" value="<?php echo date('d/m/Y');?>" id="end_date">
										<input type="hidden" id="prev_balance" value="<?php echo $bal_hand;?>">
										
										
								<?php echo $this->Form->end(); ?>
							</div>
						</div>
					</div>
				</div>
					
					
				</div>
		
			
			</div>
		</div>	
			
<div id="dialog-confirm" title="Confirmation!" class="dn">
	<p>Are you sure you want to update? once done, it cannot be modified!</p>
</div>	
