<?php foreach($adv_list as $key => $list): ?>
								
									<div class="row-fluid row<?php echo $key;?>">
										<div class="span1" style="width:100px;float:left">
											<div class="control-group">
											<?php if($key == 0):?>
												<label for="textfield" class="control-label" style="margin-bottom:10px"><b>Paid Date</b></label>
											<?php endif; ?>
												<div class="controls controls-row">
													<?php echo $this->Functions->format_date($list['FinAdvPay']['created_date']);?>
												</div>
											</div>
										</div>
										<div class="span1" style="width:100px;float:left">
											<div class="control-group">
											<?php if($key == 0):?>
												<label for="textfield" class="control-label" style="margin-bottom:10px"><b>Amount (Rs.)</b></label>
											<?php endif; ?>
												<div class="controls controls-row">
													<?php echo $list['FinAdvPay']['amount'];?>  
													<?php $tot += $list['FinAdvPay']['amount']; ?>
											
												</div>
											</div>
										</div>
										<div class="span3"  style="width:150px;float:left">
											<div class="control-group">
												<?php if($key == 0):?>
												<label for="textfield" class="control-label" style="margin-bottom:10px"><b>Paid Mode</b></label>
											<?php endif; ?>
												<div class="controls controls-row">
													<?php echo $this->Functions->pay_mode($list['FinAdvPay']['pay_mode']);?> 
												</div>
											</div>
										</div>
										<div class="span1" style="width:100px;float:left">
											<div class="control-group">
											<?php if($key == 0):?>
												<label for="textfield" class="control-label" style="margin-bottom:10px"><b>Pay Ref. No.</b></label>
											<?php endif; ?>
												<div class="controls controls-row">
												<?php echo $list['FinAdvPay']['pay_refno']; ?>
													
												</div>
											</div>
										</div>
									
										
										
								
										
									</div>
								
									
									<?php endforeach; ?>
								
								<div>
							
		
	<div class="control-group span4" style="float:left;margin-left:350px;">
	<div class="controls controls-row">
												<b>Total:   <?php echo $tot;?></b>
												</div>
										</div>
				
