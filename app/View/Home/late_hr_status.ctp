<div class="">
	<div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Late Hr Status - <?php echo date('Y'); ?></h4>
        </div><div class="container"></div>
        <div class="modal-body">
        
		<?php 
	
			
		$late_month = $late_month > 0 ? $late_month.' Mins' : 'NIL';
		$late_year = $late_year > 0 ? $late_year.' Mins' : 'NIL';
		
		?>
				 <div class="user-profile row" align="center">
		
<div class="widget-body" ><div class="widget-body-inner" style="display: block;">
												<div class="widget-main no-padding">
													<table class="table table-bordered table-striped">
														<thead class="thin-border-bottom"  style="border-top:1px solid #DDD">
															<tr>
																<th>
																
																	For the Month -  <?php echo date('M').', '. date('Y');; ?>
																</th>

																<th>
																	
																	For the Year -  <?php echo date('Y'); ?>
																</th>

																
															</tr>
														</thead>

														<tbody>
														
															<tr>
																<td class="<?php echo $late_month == 'NIL' ? 'green' : 'red'?>"><?php echo $late_month?></td>

																<td>
																	
																	<b class="<?php echo $late_year == 'NIL' ? 'green' : 'red'?>"><?php echo $late_year?></b>
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
