<style>
.tooltip-inner{text-align:left;}
</style>
<div class="btn-group" style="position:absolute;right:25px;top:43px;">

<?php if(!empty($apprv_att)) :?>
<a style="float:left;" href="<?php echo $this->webroot;?>home/verify_att/" rel="tooltip"  title="Approve Team Attendance" class="iframeBox click_hide" val="75_75"><button class="btn-primary btn  btn-xs dropdown-toggle" style="margin-right:5px">

<span class="icon-ok icon-on-right"></span> Approve	
<?php if($appr_count > 0):?>
<span class="badge badge-warning stCount" style="top:-10px"><?php echo $appr_count; ?></span>
<?php endif; ?></button></a>
<?php endif; ?>
<?php if(!empty($apprv_att)) :?><br><br>
							<div class="btn-group">
												<button data-toggle="dropdown" class="btn btn-sm btn-pink dropdown-toggle">
													Team Attendance
													<i class="ace-icon fa icon-angle-down icon-on-right"></i>
												</button>

												<ul class="dropdown-menu dropdown-pink">
													<li>
														<a  href="<?php echo $this->webroot;?>home/team_att/" rel="tooltip"  title="Today's Team Attendance" class="iframeBox click_hide" val="60_75">Today</a>
													</li>
							<?php //if($team_attendance == '1') :?>	
													<li>
														<a  href="<?php echo $this->webroot;?>hrattendance/?type=team" rel="tooltip"  title="Overall Team Attendance" class="iframeBox click_hide" val="100_95">Overall</a>
													</li>
								<?php // endif; ?>												
												</ul>
											</div><!-- /.btn-group -->

	<?php endif; ?>
										
											

										
												
												</div>
	


	<div  id="attDiv">											

<?php

$month = explode('-', $selMonth);
								
//$month[0].'-'.$month[1].'-1';
									
$no_days =  date('t',strtotime($month[0].'-'.$month[1].'-1'));
										
$in_data = $this->Functions->format_in_att_data($all_att_data, $no_days,$month[0],$month[1]);
									
									
?>

										
<table width="590" style="float:left;width:590px;position:fixed;" id="" class="table table-bordered table-striped table-hover dataTable">
<thead>
															<tr>
																<th width="120">
																
																	Date
																	
																	<div class="btn-group">
<button  style="margin-left:50px" data-toggle="dropdown" class="btn btn-minier btn-white dropdown-toggle click_hide" rel="tooltip" data-placement="right" style="border-width:0px"  title="Rewind (Past Attendance)">
													

													<span class="icon-caret-down"></span>
												</button>
								
									<ul class="dropdown-menu dropdown-info pull-left">
													<li>
													
													
												
											<a href="javascript:void(0)" rel="<?php echo date("Y-m", strtotime('-31 days'));?>" class="showBy">Previous Month (<?php echo date("M,y", strtotime('-31 days'));?>)</a>
													</li>

													<li>
											<a href="javascript:void(0)" rel="<?php echo date('Y-m');?>" class="showBy">Current Month (<?php echo date('M,y');?>)</a>
													</li>

													
													
												
														
												
												</ul></div>
		
																</th>

																
																
																<th width="70">
																	
																	In Time
																</th>

																<th width="70">
																	
																	Out Time
																</th>
																<th width="95">
																	
																	Total Hrs
																	
																	
																</th>
																
																<th width="170">
																	
			
														Late Hrs - <?php 

			for($j = 1; $j <= $no_days; $j++):
				if(!empty($in_data[$j])):
					$day_no = date('d', strtotime($month[0].'-'.$month[1].'-'.$j));
					$date = $day_no.'-'.date('M', strtotime($month[0].'-'.$month[1].'-'.$j)).'-'.$month[0];
					$leave_rec = $this->Functions->check_leave_taken($day_no,$month[1], $month[0],$in_data[$j], $leave_data_user, $holidayList, $happyLeave);					
					if(empty($leave_rec)): 
					$late += $this->Functions->check_late($office_time, date('H:i', strtotime($in_data[$j])), 'admin', $permData, date('Y-m-d', strtotime($date)),$no_grace_time);
					endif;
				endif;
			endfor;
			
			$late_mins = $late > 0 ? $late.' Mins' : 'NIL';
			$late_color = $late_mins == 'NIL' ? '#0DC475' : '#ff0000';
		?>
		<span style="color:<?php echo $late_color;?>;font-size:11px;"><?php echo $late_mins;?></span>
																
																
																
		
		</th>
															</tr>
															</thead>
														
</table>
										
												
<?php //if(!empty($all_att_data)): ?>
<table width="590" style="margin-top:35px;float:left;width:590px" id="mytable" class="table table-bordered table-striped table-hover">
														

														<tbody>
										<?php 
										
										
									
									
															
										
									$out_data = $this->Functions->format_out_att_data($all_att_data, $no_days,$month[0],$month[1]); 
									
									$status_data = $this->Functions->format_att_status_data($all_att_data, $no_days,$month[0],$month[1]); 
									
									$reject_reason_data = $this->Functions->format_att_reason_data($all_att_data, $no_days,$month[0],$month[1]);
									
									$waive_data = $this->Functions->format_att_waive_data($all_att_data, $no_days,$month[0],$month[1]);
									
										
										for($i = 1; $i <= $no_days; $i++): ?>
														
								<tr class="<?php echo $this->Functions->check_att_status($status_data[$i]);?>">
						<td width="120">
										<?php
										$day_no = date('d', strtotime($month[0].'-'.$month[1].'-'.$i));
										
										echo $date = $day_no.'-'.date('M', strtotime($month[0].'-'.$month[1].'-'.$i)).'-'.$month[0];?>
										
										  <span style="font-size:11px;">(<?php echo date('D', strtotime($date));?>)</span>
															
													</td>
													
								<?php $leave_rec = $this->Functions->check_leave_taken($day_no,$month[1], $month[0],$in_data[$i], $leave_data_user, $holidayList, $happyLeave);
								if(empty($leave_rec)):?>

								<td width="70">
								
								
									
										<?php echo $in_data[$i]; ?></td>
										
											<td width="70"><?php echo $out_data[$i]; ?></td>
											
											<td width="95"><?php
											if(!empty($in_data[$i]) && !empty($out_data[$i])): 
											echo $this->Functions->diff_time($in_data[$i], $out_data[$i]);
											endif; 
											?>
											
											<?php
										if(!empty($reject_reason_data[$i])): ?>
										<a href="javascript:void(0);" class="show-tip" title="Reject Reason (L1): <?php echo $reject_reason_data[$i];?>"><i class="icon-comment"></i></a>
										<?php endif;?>
										</td>
										<td width="170"  style="color:#ff0000">
										<?php 
										if(!empty($in_data[$i])):
										echo $this->Functions->check_late($office_time, date('H:i', strtotime($in_data[$i])), 'user', $permData, date('Y-m-d', strtotime($date)),$no_grace_time);
										endif;
										
										if(!empty($waive_data[$i])): ?>
								<span style="margin-left:5px">
								<button type="button"  title="Late Mins. Waived! - <?php echo $waive_data[$i];?>"  class="click_hide btn btn-success btn-xs show-tip">
											<i class="ace-icon fa fa-times  icon-ok bigger-110 icon-only"></i>
											
										</span>
									<?php endif;?>	
									
										</td>	
								<?php else: ?>
	<td colspan="4"><?php echo $leave_rec; unset($leave_rec);?></td>
								<?php endif; ?>
															
							
										</tr>
	                                     <?php endfor; ?>
											
														
														</tbody>
													
													
													
													</table>
												
<?php //endif; ?>			
	<?php echo $this->element('remaining'); ?>
	
	
	
</div>
