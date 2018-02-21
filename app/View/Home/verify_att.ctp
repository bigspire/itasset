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

<div class="col-sm-6">
<?php if(empty($appr_count)):?>
<div class="alert alert-warning norec">
<button type="button" class="close" data-dismiss="alert">
<i class="ace-icon fa fa-times"></i></button> You have no attendance for approval
<br></div>
<?php endif; ?>
<div class="alert alert-success recapr dn" style="padding:8px;font-size:13px;">
<button type="button" class="close" data-dismiss="alert">
<i class="ace-icon fa fa-times"></i></button> Attendance approved successfully
<br></div>

<div class="alert alert-info recrej dn" style="padding:8px;font-size:13px;">
<button type="button" class="close" data-dismiss="alert">
<i class="ace-icon fa fa-times"></i></button> Attendance rejected successfully
<br></div>

</div>	


<div class="loading dn" id="busy-indicator" style="display:none;left:20%;top:25%"><span>Loading... Please wait... <img src="<?php echo $this->webroot;?>img/loading.gif"/></span></div>


								


	
<div class="col-xs-12">
					  <div class="table-responsive" style="border:none">
		<?php if(!empty($appr_count)):?>
		<b>Pending: <span id="rec_count"><?php echo $appr_count;?></span></b> 
		<!--span style="font-size:11px;font-weight:normal;">(Mouse Over the In time / Out time to view the reasons)</span-->
		
		
		<!--table style="float:right;"><tbody><tr><td class="legendColorBox">
		<i class="icon-circle-arrow-down"></i> </td><td class="legendLabel">In Time </td><td class="legendColorBox"><i class="icon-circle-arrow-up"></i> </td><td class="legendLabel">Out Time</td>
		</tr></tbody></table-->
		
		
		<form name="sharefrm" id="shareFrm" method="post" style="clear:both">	
			<table id="sample-table-1" class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														
														<th width="200">Employee</th>
														<th width="140">Date</th>
														<th width="170">In Time</th>
														<th width="130">Out Time</th>
														<th width="160">Total Hours</th>
														<th width="70" style="text-align:center">Tasks</th>
														<th width="130" style="text-align:center">Action</th>
														
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
										
								<?php 
								$late_login = '';
								if(!empty($user['a']['late_reason'])):
								if(!empty($user['a']['is_permission'])):
								$reason_title = 'Late Reason with Permission: ';
								$time_by = 'Late By: ';
								$in_type = '';
								$late_login = 1;
								elseif(strtotime($user[0]['in_time']) < strtotime('08:00:00')):
								$reason_title = 'Early Reason: ';
								$time_by = 'Early By: ';
								$in_type = 'E_IN';
								$late_login = '';
								else:
								$reason_title = 'Late Reason: ';
								$time_by = 'Late By: ';
								$in_type = '';
								$late_login = 1;
								endif;
								 echo "<i title='".$this->Functions->show_bio_title($user[0]['bio_in_time'])."'  rel='tooltip' class='".$this->Functions->show_bio_icon($user[0]['bio_in_time'])."'></i> "; ?> <a href="javascript:void(0);" class="tooltipCls"  rel="tooltip"  data-placement="bottom"
								title="<?php echo $time_by.$this->Functions->calculate_late($user, 'in', $in_type);?> <br><?php echo $reason_title.$user['a']['late_reason']; ?>"><?php echo $user[0]['in_time'];?></a>
								<?php else:?>
								<?php echo "<i title='".$this->Functions->show_bio_title($user[0]['bio_in_time'])."'  rel='tooltip' class='".$this->Functions->show_bio_icon($user[0]['bio_in_time'])."'></i> "; echo $user[0]['in_time'];?>
								<?php endif; ?>
								
						 <?php 
						 $waive_style1 = '';
						 $waive_style2 = '';
						 if($late_login && !$user['a']['att_waive']):
						 $waive_style1 = 'dn';
						 $waive_style2 = '';
						 elseif($user['a']['att_waive']):
						 $waive_style2 = 'dn';
						 $waive_style1 = '';
						 else:
						 $waive_style2 = 'dn';
						 $waive_style1 = 'dn';
						 endif;
						?>
								<span style="margin-left:5px" class="<?php echo $waive_style2;?>" id="enableWaive-<?php echo $user['a']['id'];?>">
								<button type="button"  data-placement="right" data-rows="2" data-type="textarea" data-pk="<?php echo $user['a']['id'];?>" data-url="<?php echo $this->webroot;?>home/waive_attendance/"  title="Waive Late Mins." val="<?php echo $user['a']['id'];?>" class="att_waive click_hide btn btn-warning btn-xs  show-tip">
											<i class="ace-icon fa fa-times  icon-unlock bigger-110 icon-only"></i>
											
										</button>
								</span>
								
								<span style="margin-left:5px" class="<?php echo $waive_style1;?>" id="disableWaive-<?php echo $user['a']['id'];?>">
								<button type="button"  title="Late Mins. Waived!"  class="click_hide btn btn-success btn-xs show-tip">
											<i class="ace-icon fa fa-times  icon-unlock bigger-110 icon-only"></i>
											
										</span>
								</div>
								
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
									
								 echo "<i title='".$this->Functions->show_bio_title($user[0]['bio_out_time'])."'  rel='tooltip' class='".$this->Functions->show_bio_icon($user[0]['bio_out_time'])."'></i> ";?> <a href="javascript:void(0);" class="tooltipCls"  rel="tooltip"  data-placement="bottom"
								title="<?php echo $title_by;?> By: <?php echo $this->Functions->calculate_late($user, 'out', $user['a']['out_reason_type']);?> <br><?php echo $reason_title.$user['a']['out_reason']; ?>"><?php echo $user[0]['out_time'];?></a>
								<?php else:?>
								<?php echo "<i title='".$this->Functions->show_bio_title($user[0]['bio_out_time'])."'  rel='tooltip' class='".$this->Functions->show_bio_icon($user[0]['bio_out_time'])."'></i> "; echo $user[0]['out_time'];?>
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
						<a rel="<?php echo $user['a']['id'];?>"  href="<?php echo $this->webroot;?>home/view_task/<?php echo $user['u']['id'];?>/<?php echo $user[0]['in_date'];?>" class="iframeBox  verifyTsk click_hide  show-tip" title="View Tasks" val="95_95">	<button type="button"  class="click_hide btn btn-purple btn-xs">
							
							<i class="ace-icon fa fa-check icon-search   bigger-110 icon-only" ></i>
							
							</button></a>
							<?php endif; ?>
							
							</td>
														<td style="text-align:center">
														
						<?php 
						 $disp_style1 = ''; $disp_style2 = '';
						 if($user['a']['task_view']):
						 $disp_style2 = 'dn';
						 $disp_style1 = '';
						 else:
						 $disp_style1 = 'dn';
						 $disp_style2 = '';
						 endif;
						?>
					<div class="<?php echo $disp_style1;?>" id="enableTsk-<?php echo $user['a']['id'];?>">
					<button type="button" title="Approve" val="<?php echo $user['a']['id'];?>" rel="A" class="click_hide btn btn-success btn-xs verify_att show-tip">
											<i class="ace-icon fa fa-check icon-ok  bigger-110 icon-only"> </i>
											
										</button>
										&nbsp;	
					<button type="button"  data-placement="left" data-rows="2" data-type="textarea" data-pk="<?php echo $user['a']['id'];?>" data-url="<?php echo $this->webroot;?>home/update_att_status/" data-title="Reject" val="<?php echo $user['a']['id'];?>" rel="R" class="att_reject click_hide btn btn-danger btn-xs  show-tip">
											<i class="ace-icon fa fa-times  icon-minus bigger-110 icon-only"></i>
											
										</button>
									</div>
									
										<div class="<?php echo $disp_style2;?>" id="disableTsk-<?php echo $user['a']['id'];?>">
										<button type="button" title="Please check <?php echo ucwords($user[0]['first_name']);?> tasks before Approve"  class="click_hide btn btn btn-xs show-tip">
											<i class="ace-icon fa fa-check icon-ok  bigger-110 icon-only"> </i>
											
										</button>
										&nbsp;	
					
					<button type="button" title="Please check <?php echo ucwords($user[0]['first_name']);?> tasks before Reject"  class="click_hide btn btn-xs  show-tip">
											<i class="ace-icon fa fa-times  icon-minus bigger-110 icon-only"></i>
											
										</button></div>
										
									
									
														</td>
														
													</tr>
											<?php endforeach; ?>
											
													
												
												</tbody>
											</table>
							
					<input type="hidden" id="webroot" value="<?php echo $this->webroot;?>"/>
					
									</form>
									
									
										</div><!-- /.table-responsive -->
										
										<?php endif; ?>
										
										<input type="hidden" id="st_total" value="<?php echo $appr_count;?>"/>
										
									</div>
</div>		

			