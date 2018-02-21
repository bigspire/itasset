<div class="">
	<div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Attendance Status - <?php echo $year_val ? $year_val : date('Y'); ?></h4>
        </div><div class="container"></div>
        <div class="modal-body">
        
		
				 <div class="user-profile row" align="center">
		
<div class="widget-body" ><div class="widget-body-inner" style="display: block;">
												<div class="widget-main no-padding">
													<table class="table table-bordered table-striped">
														<thead class="thin-border-bottom"  style="border-top:1px solid #DDD">
															<tr>
																	<th>
																No. of Days
																</th>
																
																<th>
																
																	FTM -  <?php echo $month_val ? $month_val.', '.$year_val : date('M').', '. date('Y'); ?>
																</th>

																<th>
																	
																	FTY -  <?php echo $year_val ? $year_val : date('Y'); ?>
																</th>

															
																
															</tr>
														</thead>

														<tbody>
														
															<tr>
															<td> Present </td>
																<td  class="green"><?php echo $FTM_PRESENT;?></td>

																<td  class="green">
																	<?php echo $FTY_PRESENT;?>
																	
																</td>

																
															</tr>
														<tr> 
															<td>Absent / LOP </td>
																<td  class="red"><b><?php echo $FTM_ABSENT;?></b></td>

																<td  class="red">
																	<b><?php echo $FTY_ABSENT;?></b>
																</td>

																
															</tr>
															
															<tr>
															<td>Approved Leaves </td>
																<td  class="orange"><?php echo $FTM_APPROVED;?></td>

																<td  class="orange">
																	<?php echo $FTY_APPROVED;?>
																	
																</td>

																
															</tr>
															
															
															<tr>
															<td class="">Weekly Off </td>
																<td  class="pink"><?php echo $FTM_WEEKOFF; ?></td>

																<td  class="pink">
																	<?php echo $FTY_WEEKOFF; ?>
																	
																</td>

																
															</tr>
															<tr>
															<td class="">Holidays </td>
																<td  class="blue"><?php echo $FTM_OFF; ?></td>

																<td  class="blue">
																	<?php echo $FTY_OFF; ?>
																	
																</td>

																
															</tr>
															
															<tr class="">
															<td class=""> <b>Total</b></td>
																<td><b><?php echo $FTM_TOTAL; ?></b></td>

																<td>
																	<b><?php echo $FTY_TOTAL; ?></b>
																	
																</td>

																
															</tr>
														</tbody>
													</table>
												</div><!-- /widget-main -->
											</div></div>
									</div>
        
		
        </div>
       
      </div>
    </div>
</div>
