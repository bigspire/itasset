<?php if(!empty($pay_data)):?>
<div class="box box-color box-bordered">
							<div class="box-title">
								<h3><i class="icon-list"></i> Payment Details</h3>
							</div>
							<div class="box-content nopadding">
								
								
								<?php echo $this->Form->create('FinAdvPay', array('id' => '', 'class' => 'form-horizontal form-column form-bordered')); ?>
							
							
							<?php foreach($pay_data as $pay_data):?>
								<div class="span6" style="clear:left;border-top:1px solid #ddd;">
										
										<div class="control-group">
											<label for="password" class="control-label">Paid Amount </label>
											<div class="controls">
												Rs. <?php echo $pay_data['FinAdvPay']['amount'];?>
											</div>
										</div>
									<div class="control-group">
											<label for="password" class="control-label">Pay Mode </label>
											<div class="controls">
												<?php echo $this->Functions->pay_mode($pay_data['FinAdvPay']['pay_mode']);?>
												
												
											</div>
										</div>
									<div class="control-group">
											<label for="password" class="control-label">Remarks </label>
											<div class="controls">
												<?php echo $pay_data['FinAdvPay']['remarks'];?>
											</div>
										</div>
									</div>
									
								<div class="span6" style="border-top:1px solid #ddd;">
											<div class="control-group">
											<label for="textfield" class="control-label">Date of Payment </label>
											<div class="controls">
												<?php echo $this->Functions->format_date($pay_data['FinAdvPay']['paid_date']);?> 
											</div>
										</div>
											
										<div class="control-group">
											<label for="password" class="control-label">Pay Ref. No. </label>
											<div class="controls">
												<?php echo $pay_data['FinAdvPay']['pay_refno'];?>
												
												
											</div>
										</div>
												<div class="control-group">
											<label for="password" class="control-label">&nbsp; </label>
											<div class="controls">
												
												
												
											</div>
										</div>
											
										</div>
							
							
							
							<div class="span12" style="clear:left;border-top:1px solid #ddd;">
							<div class="control-group" style="">
										
											
										</div>
							</div>
							
							
					<?php endforeach; ?>
										
										
										
									
							
							<?php echo $this->Form->end(); ?>
							
							
							</div>
							
						</div>
<?php endif; ?>					