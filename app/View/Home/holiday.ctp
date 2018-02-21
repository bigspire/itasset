<div class="">
	<div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Holidays - <?php echo date('Y'); ?></h4>
        </div><div class="container"></div>
        <div class="modal-body">
        
		
				 <div class="user-profile row" align="center">
		
<div class="widget-body" ><div class="widget-body-inner" style="display: block;">
												<div class="widget-main no-padding">
													<table class="table table-bordered table-striped">
														<thead class="thin-border-bottom"  style="border-top:1px solid #DDD">
															<tr>
																<th>
																
																	Date
																</th>

																<th>
																	
																	Event
																</th>

																
															</tr>
														</thead>

														<tbody>
														
														<?php foreach($holidayData as $holiday) :?>
															<tr>
																<td><?php echo $this->Functions->format_date($holiday['HrHoliday']['event_date']);?></td>

																<td>
																	
																	<b class="green"><?php echo $holiday['HrHoliday']['event'];?></b>
																</td>

																
															</tr>
                                                      <?php endforeach; ?>
														
														</tbody>
													</table>
												</div><!-- /widget-main -->
											</div></div>
									</div>
        
		
        </div>
       
      </div>
    </div>
</div>
