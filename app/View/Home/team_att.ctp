<style type="text/css">
body{padding-top:20px;background:#fff}
.table-responsive{overflow-x:hidden}
.tooltip-inner{text-align:left;}
.editable-buttons{margin-top:5px}
.editable-error-block{color:#ff0000}
.editableform-loading {
    background: url('<?php echo $this->webroot;?>img/loading.gif') center center no-repeat;  
    height: 25px;
    width: auto; 
    min-width: 25px; 
}
.table-hover tbody tr:hover > td,
.table-hover tbody tr:hover > th {
  background-color: #FCEAEA;
}
</style>

<div id="disablingDiv"></div>	

<div  id="att_stList">
	
<div class="col-xs-12">
					  <div class="table-responsive" style="border:none">
					  
					  		<b>Today's Team Attendance : <span id="rec_count"><?php echo $appr_count;?></span></b> 
							
							<b style="margin-left:20px;color:#ff0000">Employee on Leave : <a data-placement="bottom" rel="tooltip2" class="" title="<?php echo $leave_user;?>" href="#"><?php echo $total_leave;?></a></b> 

		<!--span style="font-size:11px;font-weight:normal;margin-left:150px;">Mouse Over the In time / Out time to view the reasons</span-->
		
		
		<!--table style="float:right;"><tbody><tr><td class="legendColorBox">
		<i class="icon-circle-arrow-down"></i> </td><td class="legendLabel">In Time </td><td class="legendColorBox"><i class="icon-circle-arrow-up"></i> </td><td class="legendLabel">Out Time</td>
		</tr></tbody></table-->
		
		
		<form name="sharefrm" id="shareFrm" method="post" style="clear:both">	
		
		

				
			<table id="sample-table-1" class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														
														<th width="190">Employee</th>
														<th width="110">Date</th>
														<th width="100">In Time</th>
														<th width="100">Out Time</th>
														<th width="130">Total Hours</th>
														<th width="90" style="text-align:center">Tasks</th>
													</tr>
												</thead>

												<tbody>
													
				<?php    foreach($att_st_data as $user): ?>
												
												
												<tr id="row-<?php echo $user['a']['id'];?>">
														<td class="">
															
								<?php echo ucwords($user[0]['first_name']);?> 
																
															
														</td>
														
										<?php if(!empty($user['a']['late_reason']) || !empty($user['a']['out_reason'])):
										$late_cls = 'red';
										else:
										$late_cls = '';
										endif;
										?>

							<td class="<?php echo $late_cls;?>"/>
							
								<?php echo $user[0]['in_date'];?>
							</td>
														
								<td>
										
								
										
								<?php if(!empty($user['a']['late_reason'])):
								if(!empty($user['a']['is_permission'])):
								$reason_title = 'Late Reason with Permission: ';
								$time_by = 'Late By: ';
								$in_type = '';
								elseif(strtotime($user[0]['in_time']) < strtotime('08:00:00')):
								$reason_title = 'Early Reason: ';
								$time_by = 'Early By: ';
								$in_type = 'E_IN';
								else:
								$reason_title = 'Late Reason: ';
								$time_by = 'Late By: ';
								$in_type = '';
								endif;
								 
								 echo '<i class="icon-circle-arrow-down"></i> '; ?> <a href="javascript:void(0);" class="tooltipCls"  rel="tooltip"  data-placement="bottom"
								title="<?php echo $time_by.$this->Functions->calculate_late($user, 'in', $in_type);?> <br><?php echo $reason_title.$user['a']['late_reason']; ?>"><?php echo $user[0]['in_time'];?></a>
								<?php else:?>
								<?php echo $user[0]['in_time'] ? '<i class="icon-circle-arrow-down"></i> ' : ''; echo $user[0]['in_time'];?>
								<?php endif; ?>
								</td>
								
								<td>	

																	
								<?php if(!empty($user['a']['out_reason'])):	

									if($user['a']['out_reason_type'] == 'E'):
									$reason_title = 'Early Reason: ';
									$title_by = 'Early';
									else:
									$reason_title = 'Late Reason: ';
									$title_by = 'Late';
									endif;	
									
								 echo '<i class="icon-circle-arrow-up"></i>';?> <a href="javascript:void(0);" class="tooltipCls"  rel="tooltip"  data-placement="bottom"
								title="<?php echo $title_by;?> By: <?php echo $this->Functions->calculate_late($user, 'out', $user['a']['out_reason_type']);?> <br><?php echo $reason_title.$user['a']['out_reason']; ?>"><?php echo $user[0]['out_time'];?></a>
								<?php elseif($user[0]['out_time']):?>
								<?php echo '<i class="icon-circle-arrow-up"></i> '; echo $user[0]['out_time'];?>
								<?php endif; ?>
								
								
								
														</td>
													

												
														<td>
														
											<?php
											if(!empty($user[0]['in_time']) && !empty($user[0]['out_time'])): 
											echo $this->Functions->diff_time($user[0]['in_time'], $user[0]['out_time']);
											endif;
														?>
														
														</td>
														
													<td align="center">
						
							<?php if(!empty($user[0]['tid'])):?>
						<a href="<?php echo $this->webroot;?>home/view_task/<?php echo $user['u']['id'];?>/<?php echo $user[0]['in_date'];?>" rel="tooltip" class="iframeBox  click_hide" title="View Tasks" val="95_95">	<button type="button" class="btn btn-purple btn-xs" title="View Tasks" >
							
							<i class="ace-icon fa fa-check icon-search   bigger-110 icon-only" ></i>
							
							</button></a>
							<?php endif; ?>
							
							</td>	
														
													</tr>
											<?php endforeach; ?>
											
													
												
												</tbody>
											</table>
							
					<input type="hidden" id="webroot" value="<?php echo $this->webroot;?>"/>
					
									</form>
									
									
										</div><!-- /.table-responsive -->
										
										
										
									</div>
</div>		

			