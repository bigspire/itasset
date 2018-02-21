<div class="">
	<div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Finance Report </h4>
        </div><div class="container"></div>
        <div class="modal-body">
        
		
				 <div class="user-profile row" align="center">
		
<div class="widget-body" ><div class="widget-body-inner" style="display: block;">
												<div class="widget-main no-padding">
													<table class="table table-bordered table-striped">
														<tbody>
															<tr>
																	<th width="60%">
																Total Advance Received 
																<span style="font-weight:normal">																
																(Till date)																
																</span>
																</th>
																
																<td>
																<?php echo $this->Functions->check_amount($advance_received); ?>
														</td>
</tr><tr>
																<th>
																	
																	Total Expenses Submitted 
																	<span style="font-weight:normal">																
																(Till date)																
																</span>
																</th>

															<td>
																<?php echo $this->Functions->check_amount($expense_submitted); ?>	
																</td>

																
															</tr>
															
															<tr>
																<th>
																	
																	Expense Submission Pending 
																	<span style="font-weight:normal">																
																(Till date)																
																</span>
																</th>

															<td>
																<?php echo $this->Functions->check_amount($expense_pending); ?>		
																</td>

																
															</tr>
															
															<?php $payable = $this->Functions->check_amount($expense_pay['amount']);?>	
<!--tr>
																<th>
																	
																	Total Balance Advance in Hand
																</th>

															<td>
															<?php echo $balance_hand = $this->Functions->check_amount($expense_pay['balance_hand']); ?>	

															<?php if($balance_hand != '-'): ?>
															(<span style="font-weight:normal">
																
																
																Till <?php echo $this->Functions->format_date($expense_pay['paid_date']);?>
																
																
																</span>)	
														<?php endif; ?>																
																</td>

																
															</tr>
														
														
															<tr>
																<th>
															
																	Payable to Employee 
																	<?php if($payable): ?>
																	
																	(<span style="font-weight:normal">
																
																
																Till <?php echo $this->Functions->format_date($expense_pay['paid_date']);?>
																
																
																</span>)
																
																<?php endif; ?>
																</th>

															<td>
																<?php echo $payable; ?>
																
															

																		
																</td>

																
															</tr-->
														</tbody>
													</table>
												</div><!-- /widget-main -->
											</div></div>
									</div>
        
		
        </div>
       
      </div>
    </div>
</div>
