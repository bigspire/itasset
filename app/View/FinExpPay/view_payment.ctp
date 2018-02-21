<?php echo $this->element('fin_menu'); ?>
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>View Expense Pay</h1>
					</div>
					
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>finhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="<?php echo $this->webroot;?>finexppay/">View Expense Pay</a>
								<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="#">View Expense Pay</a>
						</li>
					</ul>
					
				</div>
				
				<?php echo $this->Session->flash();?>
				
					<div class="row-fluid footer_div" id="pcontent">
					<div class="span12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3><i class="icon-list"></i> Expense Payment Details</h3>
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
											<label for="password" class="control-label">Expense No. </label>
											<div class="controls">
												 <?php echo $pay_data['FinExpenses']['expense_no']?>
											
											</div>
										</div>
										
										<div class="control-group">
											<label for="password" class="control-label">Expense Amount </label>
											<div class="controls">
												Rs.  <?php echo $pay_data['FinExpenses']['amount']?> 
												<a val="45_50" rel="tooltip" title="Expense Details" href="<?php echo $this->webroot;?>finexppay/view_exp/<?php echo $this->request->params['pass'][0];?>" class="iframeBox">(Details)</a>
											
											</div>
										</div>

										<div class="control-group">
											<label for="password" class="control-label">Advance Amount </label>
											<div class="controls">
												<?php if(!empty($pay_data['FinExpPay']['tot_advance'])):?>
												Rs. <?php echo $pay_data['FinExpPay']['tot_advance']; ?> 
												<!--a val="45_50" rel="tooltip" title="Advance Details" href="<?php echo $this->webroot;?>finexppay/view_adv/<?php echo $this->request->params['pass'][0];?>" class="iframeBox">(Details)</a-->
											<?php else: ?>
											Nil
											<?php endif; ?>
												<input type="hidden" id="sum_adv" value="<?php echo $pay_data['FinExpPay']['tot_advance'];?>">
											</div>
										</div>
										
										
									
											<div class="control-group">
											<label for="password" class="control-label"> Paid to Employee</label>
											<div class="controls">
											<?php if($pay_data['FinExpPay']['amount'] > 0): ?>
												Rs. <?php echo $pay_data['FinExpPay']['amount'];?>
											<?php endif; ?>
											</div>
										</div>
										
											<div class="control-group">
											<label for="password" class="control-label"> Total balance advance in Hand</label>
											<div class="controls">
											
											<?php if($pay_data['FinExpPay']['balance_hand'] > 0): ?>
												Rs. <?php echo $pay_data['FinExpPay']['balance_hand'];?>
												<?php else:?>
											--
											<?php endif; ?>
												
											
											</div>
											
										</div>
										
										
										
										
									</div>
									<div class="span6">
									
									
								<div class="control-group">
											<label for="password" class="control-label"> Received from Emp. </label>
											<div class="controls">
											<?php if($pay_data['FinExpPay']['amt_received'] > 0): ?>
												Rs. <?php echo $pay_data['FinExpPay']['amt_received'];?>.
											<?php else:?>
											--
											<?php endif; ?>
											</div>
										</div>
										
										
											<div class="control-group">
											<label for="password" class="control-label"> Payment Date </label>
											<div class="controls">
												<?php echo $this->Functions->format_date($pay_data['FinExpPay']['paid_date']); ?>
											</div>
										</div>
										
										
										
										
										
										<div class="control-group">
											<label for="textfield" class="control-label">Payment Mode </label>
											<div class="controls">
											<?php echo $this->Functions->pay_mode($pay_data['FinExpPay']['pay_mode']);?>
											
											</div>
										</div>
									<div class="control-group">
											<label for="password" class="control-label">Payment Ref. No. </label>
											<div class="controls">
											<?php echo $pay_data['FinExpPay']['pay_refno'];?>
												
												
											</div>
										</div>
									
									<div class="control-group">
											<label for="textfield" class="control-label">Remarks </label>
											<div class="controls">
													<?php echo $pay_data['FinExpPay']['remarks'];?>
											</div>
										</div>
										
											<div class="control-group">
											<label for="password" class="control-label">  &nbsp;</label>
											<div class="controls">
												&nbsp;
											</div>
										</div>
										
										
									</div>
									<div class="span12">
										<div class="form-actions">
											
											<a class="jsRedirect" href="javascript:void(0);" val="<?php echo $this->webroot;?>finexppay/" href=""><button type="button" class="btn"><i class="icon-arrow-left"></i>  Go Back</button></a>
											<a href="javascript:void(0)" rel="pcontent" class="print" style="margin-left:10px"><button type="button" class="btn btn-magenta"><i class="icon-print"></i> Print</button></a>
											
											
										</div>
									</div>
										<input type="hidden" value="<?php echo date('d/m/Y');?>" id="start_date">
								<?php echo $this->Form->end(); ?>
							</div>
						</div>
					</div>
				</div>
					
					
				</div>
		
			
			</div>
		</div>	
			
	
