<?php foreach($exp_list as $key => $list): ?>
								
									<div class="row-fluid row<?php echo $key;?>">
										<div class="span1" style="width:80px;float:left">
											<div class="control-group">
											<?php if($key == 0):?>
												<label for="textfield" class="control-label" style="margin-bottom:10px"><b>Date</b></label>
											<?php endif; ?>
												<div class="controls controls-row">
													<?php echo $this->Functions->format_date_show($list['FinExpList']['date_exp']);?>
												</div>
											</div>
										</div>
										<div class="span1" style="width:100px;float:left">
											<div class="control-group">
											<?php if($key == 0):?>
												<label for="textfield" class="control-label" style="margin-bottom:10px"><b>Category</b></label>
											<?php endif; ?>
												<div class="controls controls-row">
													<?php echo $list['FinExpCat']['category'];?>  
											
												</div>
											</div>
										</div>
										<div class="span3"  style="width:160px;float:left">
											<div class="control-group">
												<?php if($key == 0):?>
												<label for="textfield" class="control-label" style="margin-bottom:10px"><b>Description</b></label>
											<?php endif; ?>
												<div class="controls controls-row">
													<?php echo $list['FinExpList']['description'];?> 
												</div>
											</div>
										</div>
										<div class="span1" style="width:100px;float:left">
											<div class="control-group">
											<?php if($key == 0):?>
												<label for="textfield" class="control-label" style="margin-bottom:10px"><b>Amount</b></label>
											<?php endif; ?>
												<div class="controls controls-row">
												<?php echo $amt = $list['FinExpList']['amount']; 
													$tot += $list['FinExpList']['amount'];?> 
												</div>
											</div>
										</div>
									
										<div class="span1" style="width:50px;float:left">
											<div class="control-group">
												<?php if($key == 0):?>
												<label for="textfield" class="control-label" style="margin-bottom:10px"><b>Billable</b></label>
											<?php endif; ?>
												<div class="controls controls-row">
													<?php echo $this->Functions->check_status($list['FinExpList']['billable']);?> 
												</div>
											</div>
										</div>
												<div class="span1" style="width:50px;float:left">
											<div class="control-group">
													<?php if($key == 0):?>
												<label for="textfield" class="control-label" style="margin-bottom:10px"><b>Bill</b></label>
											<?php endif; ?>
												<div class="controls controls-row">
														<?php echo $this->Functions->check_status($list['FinExpList']['bill_avail']);?>
												</div>
											</div>
										</div>
										
										<div class="span1" style="width:60px;float:left">
											<div class="control-group">
													<?php if($key == 0):?>
												<label for="textfield" class="control-label" style="margin-bottom:10px"><b>Bill No.</b></label>
											<?php endif; ?>
												<div class="controls controls-row">
													<?php echo $list['FinExpList']['bill_refno']; ?> 
												</div>
											</div>
										</div>
										
									<?php if($FN_NAME == 'discrepancy'):?>
									
										<div class="span3" style="width:150px;float:left">
											<div class="control-group">
													<?php if($key == 0):?>
												<label for="textfield" class="control-label" style="margin-bottom:10px;"><b>Reject Reason</b></label>
											<?php endif; ?>
												<div class="controls controls-row" style="color:#ff0000">
													<?php echo $list['FinExpList']['reason']; ?> 
												</div>
											</div>
										</div>
									<?php endif; ?>
										
									</div>
								
									
									<?php endforeach; ?>
								
								<div>
							
		
	<div class="control-group span4" style="float:left;margin-left:350px;">
	<div class="controls controls-row">
												<b>Total:   <?php echo $tot;?></b>
												</div>
										</div>
				
