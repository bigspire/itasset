 <style>
table{border:1px dashed #efefef;}
.table-bordered th, .table-bordered td{border-left:1px dashed #efefef}
.table tr th, .table tr td{border-left:1px dotted #ddd;padding:6px;}
.table tr.sub_head th,tr.sub_head{background:#f7f7f7 !important;}
td.bold{font-weight:bold;}
</style><div class="">
	<div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header" style="padding:0">
          <h4 class="modal-title">My Events</h4>
        </div>
        <div class="modal-body" style="padding-left:0">
        
		
				 <div>
		
<div class="widget-body" ><div class="widget-body-inner" style="display: block;">
												<div class="widget-main"> <?php if(count($event_data) > 0):?>
  
  <table class="table table-striped table-bordered table-hover">
														<thead class="thin-border-bottom">
															<tr>
																<th width="140">
																	
																	Title
																</th>
																
																<th  width="250">
																	
																	Description
																</th>
																
																<th   width="130">
																	
																	Start Time
																</th>

																<th   width="130">
																	
																	End Time
																</th>
																<th  width="150">Type</th>
																
																<th  width="150">Status</th>
															</tr>
														</thead>

														<tbody>
														
										<?php foreach($event_data as $event):?>				
															<tr>
																<td class=""><?php echo $event['TskEvent']['title'];?></td>
																<td>
																<?php echo $this->Functions->string_truncate($event['TskEvent']['details'], 50);?>
																</td>
						<td>	<?php echo $this->Functions->show_event_date($event['TskEvent']['start']);?></td>
							<td>	<?php echo $this->Functions->show_event_date($event['TskEvent']['end']);?></td>
<td> 	
	<span class="evtTag evt<?php echo $event['TskEventType']['color']; ?>"><?php echo $event['TskEventType']['name'];?></span>

																</td>
																
																
																<td><?php echo $event['TskEvent']['status'];?></td>

																
															</tr>
									<?php endforeach; ?>
																	
															
														</tbody>
													</table>
	

  
    <?php endif; if(count($event_data) == 0 && $ajax_event == 1):?>

  	<div id="flashMessage" class="alert alert">You have no upcoming events <a target="_blank" href="<?php echo $this->webroot;?>tskevent/">Click Here</a> to create!</div>

  <?php endif; ?>
</div></div>
									</div>
        
		
        </div>
       
      </div>
    </div>
</div>
<input type="hidden" id="messagePage"/>