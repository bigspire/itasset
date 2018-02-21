<?php 
if($this->request->query['type'] != 'team'): echo $this->element('hr_menu'); endif;?>
		
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<?php if($this->request->query['type'] != 'team'): ?>
				
				<div class="page-header">
					<div class="pull-left">
						<h1><?php echo $is_team; ?> Attendance</h1>
						
						
					</div>
				
				</div>
				
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>hrhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						
						
						<li>
							<a href="<?php echo $this->webroot;?>hrattendance/<?php echo $is_team_url; ?>"><?php echo $is_team; ?> Attendance</a>
							
						</li>
						
						
					</ul>
					
				</div>
				<?php endif; ?>
				
				
				<?php echo $this->Session->flash();?>
				
					<div class="row-fluid  footer_div" >
					<div class="span12">
						<div class="box box-bordered box-color">
						
						<div class="box-title">
								<h3><i class="icon-list"></i><?php echo $is_team; ?> Attendance</h3>
							</div>
							
						

						<?php echo $this->Form->create('HrAttendance', array('name' => '', 'type' => '', 'id' => 'formID', 'class' => '')); ?>
						
						<?php if($this->request->query['type'] == 'team'):?>
						<input type="hidden" value="team" id="approver"/>
						<?php endif; ?>
						
						<div class="box-content">
							
							
				<div class="dataTables_filter" id="DataTables_Table_8_filter"  style="padding:15px;margin-left:31%">
				
		
				
			<span>Search:</span> 	<?php echo $this->Form->input('SearchText', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-xlarge',  'value' => $this->params->query['keyword'],  'id' => 'SearchText', 'required' => false, 'autocomplete' => 'off', 'placeholder' => 'Type Employee Name...', 'error' =>  array('attributes' => array('style' => 'margin-bottom:10px;margin-left:45px;', 'wrap' => 'div', 'class' => 'error')))); ?> 
			
				
						
									
			
				<div><span>Month:</span>		<?php echo $this->Form->month('att_month', array('div'=> false,'type' => 'select', 'label' => false, 'default' => date('F'),   'class' => 'input-medium', 'empty' => 'Select', 'selected' => $this->request->data['HrAttendance']['att_month']['month'], 'required' => false, 'placeholder' => '', 'style' => "clear:left",'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
				
			
	
	<span>Year:</span>	
	<?php echo $this->Form->year('att_year', date('Y') - 1, date('Y') + 25, array('div'=> false,'type' => 'select', 'label' => false, 'class' => 'input-small', 'empty' => 'Select', 'default' => date('Y'), 'selected' => $this->request->data['HrAttendance']['att_year']['year'], 'required' => false, 'placeholder' => ''));
	?> 
	
	
	<input type="submit" class="btn btn-primary" style="margin-bottom:9px;margin-left:4px;" value="Submit"/>
	
	<a href="<?php echo $this->webroot;?>hrattendance/<?php echo $reset;?>"><button style="margin-bottom:9px;margin-left:4px;" type="button" class="btn btn-primary"><i class="icon-refresh"></i> Reset</button></a>
	
			<!--a href="#"><button class="btn btn-primary" style="margin-bottom:9px;margin-left:2px;"><i class="icon-download"></i> Export </button></a-->
	
	
	</div>
		
								</div>
								
							<div>  <?php if(!empty($this->request->data['HrAttendance']['SearchText'])): ?>	
	
		<?php 	
		
		$no_days =  date('t', strtotime($this->request->data['HrAttendance']['att_year']['year'].'-'.$this->request->data['HrAttendance']['att_month']['month'].'-01')); 

		$in_data = $this->Functions->format_in_att_data($att_data, $no_days,$this->request->data['HrAttendance']['att_year']['year'],$this->request->data['HrAttendance']['att_month']['month']);
		?>

	<table class="table table-hover table-nomargin table-bordered usertable" style="width:980px;margin-bottom:20px;border-left:1px solid #dddddd;border-right:1px solid #dddddd;border-top:1px solid #dddddd;margin-left:20px">
		<thead>
		<tr>		
		<th width="80">Name</td>
		<td width="180"><?php echo $this->request->data['HrAttendance']['SearchText'];?></td>
		<th width="120">Late Hrs: <?php echo date('M Y', strtotime($this->request->data['HrAttendance']['att_year']['year'].'-'.$this->request->data['HrAttendance']['att_month']['month'].'-01'));?>
		</td>
		<td width="85">
		
		<?php 
			for($j = 1; $j <= $no_days; $j++):
				if(!empty($in_data[$j])):
					$day_no =  date('d', strtotime($this->request->data['HrAttendance']['att_year']['year'].'-'.$this->request->data['HrAttendance']['att_month']['month'].'-'.$j));
					$date = $day_no.'-'.date('M', strtotime($this->request->data['HrAttendance']['att_year']['year'].'-'.$this->request->data['HrAttendance']['att_month']['month'].'-01')).'-'.$this->request->data['HrAttendance']['att_year']['year'];
					$leave_rec = $this->Functions->check_leave_taken($day_no,$this->request->data['HrAttendance']['att_month']['month'], $this->request->data['HrAttendance']['att_year']['year'],$in_data[$j], $leave_data_user, $holidayList, $happyLeave);					
					if(empty($leave_rec)):
					$late += $this->Functions->check_late($office_time, date('H:i', strtotime($in_data[$j])), 'admin', $permData, date('Y-m-d', strtotime($date)),$no_grace_time);
					endif;
				endif;
			endfor;
			
			$late_year -= $late_hr_deduct;			
			$late_year += $late_hr_add;
			$late_url = $late_year;
			$late_mins = $late > 0 ? $late.' Mins' : 'NIL';
			$late_color = $late_mins == 'NIL' ? '#0DC475' : '#ff0000';
		?>
		<span style="color:<?php echo $late_color;?>"><?php echo $late_mins;?></span>
		</td>
		<th width="100">Late Hrs: <?php echo date('Y', strtotime($this->request->data['HrAttendance']['att_year']['year'].'-'.$this->request->data['HrAttendance']['att_month']['month'].'-01'));?></td>
		<td width="85"><?php $late_year = $late_year > 0 ? $late_year.' Mins' : 'NIL';
			$late_color = $late_year == 'NIL' ? '#0DC475' : '#ff0000';;?>
			<span style="font-weight:bold;color:<?php echo $late_color;?>"><?php echo $late_year;?>
			</span>
			<?php if($late_url > 0 && ($this->Session->read('USER.Login.id') == '54' || $this->Session->read('USER.Login.id') == '10')):?>
			<br><a href="<?php echo $this->webroot;?>hrattendance/waive_off/<?php echo $emp_id;?>/<?php echo $late_url;?>/<?php echo $is_team_url;?>" class="iframeBox" val="50_75">Waive Off</a>
			<?php endif; ?>
			</td>
			<td>		
			<a style="margin-left:2px;" href="<?php echo $this->webroot;?>hrattendance/leave_status/<?php echo $emp_id;?>/<?php echo $branch_id;?>/<?php echo $date_val;?>/<?php echo $is_team_url;?>/<?php echo $doj;?>" class="iframeBox" val="40_60">Att. Status -  <?php echo $year_val; ?></a> |
			<a style="margin-left:2px;" href="<?php echo $this->webroot;?>home/task_report/<?php echo $emp_id;?>/<?php echo $date_val;?>" class="iframeBox" val="85_80">Task Report -  <?php echo $year_val; ?></a> | 
			<a style="margin-left:2px;" href="<?php echo $this->webroot;?>home/fin_report/<?php echo $emp_id;?>/" class="iframeBox" val="45_45">Fin. Report</a>

</td>
		</tr>
		</thead>
		</table>	

		<table style="margin-top:15px;font-size:smaller;margin-left:20px;color:#545454;border:1px solid #efefef;border-bottom:none;"><tbody><tr><td class="legendColorBox"><div style="border:1px solid null;padding:1px"><div style="width:4px;height:0;border:5px solid #8F9293;overflow:hidden"></div></div></td><td class="legendLabel">Pending</td><td class="legendColorBox"><div style="border:1px solid null;padding:1px"><div style="width:4px;height:0;border:5px solid #51BC5B;overflow:hidden"></div></div></td><td class="legendLabel">Approved</td><td class="legendColorBox"><div style="border:1px solid null;padding:1px"><div style="width:4px;height:0;border:5px solid #FC7A5D;overflow:hidden"></div></div></td><td class="legendLabel">Rejected</td></tr></tbody></table>
								<table class="table table-hover table-nomargin table-bordered usertable" style="float:left;width:550px;margin-bottom:20px;border-left:1px solid #dddddd;border-right:1px solid #dddddd;border-top:1px solid #dddddd;margin-left:20px">
									<thead>
										
										
										
										<tr>
																					
											<th width="250"><a href="#">Date</a></th>
											<th  width="100"><a href="#">In Time</a></th>
											<th  width="100"><a href="#">Out Time</a></th>
											<th  width="150"><a href="#">Total Hrs</a></th>
											<th  width="100"><a href="#">Late Hrs</a></th>
											
										</tr>
										
									</thead>
									<tbody>
								 
									<?php 
									
										
										$out_data = $this->Functions->format_out_att_data($att_data, $no_days,$this->request->data['HrAttendance']['att_year']['year'],$this->request->data['HrAttendance']['att_month']['month']);
										
										
										$status_data = $this->Functions->format_att_status_data($att_data, $no_days,$this->request->data['HrAttendance']['att_year']['year'],$this->request->data['HrAttendance']['att_month']['month']); 
											
										$reject_reason_data = $this->Functions->format_att_reason_data($att_data, $no_days,$this->request->data['HrAttendance']['att_year']['year'],$this->request->data['HrAttendance']['att_month']['month']);
	
										$waive_data = $this->Functions->format_att_waive_data($att_data, $no_days,$this->request->data['HrAttendance']['att_year']['year'],$this->request->data['HrAttendance']['att_month']['month']);

																			for($i = 1; $i <= $no_days; $i++): ?>
										<tr class="<?php echo $this->Functions->check_att_status($status_data[$i]);?>">
											
											<td><?php $day_no =  date('d', strtotime($this->request->data['HrAttendance']['att_year']['year'].'-'.$this->request->data['HrAttendance']['att_month']['month'].'-'.$i));
											
											echo  $date = $day_no.'-'.date('M', strtotime($this->request->data['HrAttendance']['att_year']['year'].'-'.
											$this->request->data['HrAttendance']['att_month']['month'].'-01')).'-'.$this->request->data['HrAttendance']['att_year']['year'];?>
											 <span style="font-size:11px;">(<?php echo date('D', strtotime($date));?>)</span>
											</td>
											
							<?php $leave_rec = $this->Functions->check_leave_taken($day_no,$this->request->data['HrAttendance']['att_month']['month'], $this->request->data['HrAttendance']['att_year']['year'],$in_data[$i], $leave_data_user, $holidayList, $happyLeave);
								if(empty($leave_rec)):?>				
											
											<td>
								
								
									
										<?php echo $in_data[$i]; ?></td>
											<td><?php echo $out_data[$i]; ?></td>
											<td><?php
											if(!empty($in_data[$i]) && !empty($out_data[$i])): 
											echo $this->Functions->diff_time($in_data[$i], $out_data[$i]);
											endif; 
											?>
											
										<?php
										if(!empty($reject_reason_data[$i])): ?>
										<a href="javascript:void(0);" class="show-tip" title="Reject Reason (L1): <?php echo $reject_reason_data[$i];?>"><i class="icon-comment"></i></a>
										<?php endif;?>
											
											</td>
											
											<td style="color:#ff0000">
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
										<?php  endfor; ?>
									
									</tbody>
								</table>
								
								

								<?php endif; ?>	
								
								
							</div>
							
							
						
		
		
							
							<div style="float:left;margin-left:10px;">
							
	<?php if(!empty($this->request->data['HrAttendance']['SearchText'])): ?>													
<h5 style="margin-left:20px;margin-top:0"><i class="icon-edit"></i> Leave Status</h5>
						
		
		<div style="margin-left:20px;margin-bottom:10px;">
		<?php echo $this->element('leave_status');?>
		</div>
							
													
<h5 style="margin-left:20px;margin-top:0"><i class="icon-edit"></i> Permission Status</h5>						
		
		<div style="margin-left:20px;margin-bottom:10px;">
		<?php echo $this->element('perm_status');?>
		</div>
		
		
		<?php endif; ?>	
		
							
							
	  <?php if(!empty($leave_data)): ?>						
<h5 style="margin-left:20px;margin-top:0"><i class="icon-edit"></i> Leave Details</h5>
		<?php endif; ?>						

								<?php if(!empty($leave_data)): ?>		
								<table class="table table-hover table-nomargin table-bordered usertable" style="float:left;width:600px;margin-bottom:20px;border-left:1px solid #dddddd;border-right:1px solid #dddddd;border-top:1px solid #dddddd;margin-left:20px">
									<thead>
										
										
										
										<tr>
																					
											<th width="90">From Date</th>
											<th width="90">To Date</th>
											<th width="90">No. of Days</th>
											<th width="120">Leave Type</th>
											<th width="200">Reason</th>
											<th width="120">Status</th>
											
										</tr>
										
									</thead>
									<tbody>
								 
									<?php 														
											
										foreach($leave_data as $leave): ?>
										<tr class="">
											
											<td><?php echo $this->Functions->format_date($leave['HrLeave']['leave_from']);?></td>
											<td><?php echo $this->Functions->format_date($leave['HrLeave']['leave_to']);?></td>
											<td><?php echo $leave['HrLeave']['no_days'];?></td>
											<td><?php echo $leave['HrLeaveType']['desc'];?></td>
											<td><?php echo  $this->Functions->string_truncate($leave['HrLeave']['reason'], 50);?></td>
											<td><?php echo $this->Functions->format_status($leave[0]['st_status'],$leave[0]['st_created'],$leave[0]['st_user'],$leave[0]['st_modified']); ?></td>
											</tr>
										<?php  endforeach; ?>
									
									</tbody>
								</table>
								
								
							  <?php if(!empty($per_data)): ?>	
								<h5 style="margin-left:20px;margin-top:0"><i class="icon-edit"></i> Permission Details</h5>
							  <?php endif; ?>
							  
								 <?php if(!empty($per_data)): ?>		
								<table class="table table-hover table-nomargin table-bordered usertable" style="float:left;width:600px;margin-bottom:20px;border-left:1px solid #dddddd;border-right:1px solid #dddddd;border-top:1px solid #dddddd;margin-left:20px">
									<thead>
										
										
										
										<tr>
											<th width="150">Permission Date</th>									
											<th width="80">From</th>
											<th width="80">To</th>											
											<th width="120">Total Hrs.</th>
											<th width="230">Reason</th>
											<th width="120">Status</th>
											
										</tr>
										
									</thead>
									<tbody>
								 
									<?php 
									
									
											
										foreach($per_data as $per): ?>
										<tr class="">
											
											<td><?php echo $this->Functions->format_date($per['HrPermission']['per_date']);?></td>
											<td><?php echo $this->Functions->format_time_show($per['HrPermission']['per_from']);?></td>
											<td><?php echo $this->Functions->format_time_show($per['HrPermission']['per_to']);?></td>
											<td><?php echo $this->Functions->display_hrs($per['HrPermission']['no_hrs']);?></td>
											<td><?php echo  $this->Functions->string_truncate($per['HrPermission']['reason'], 50);?></td>
											<td><?php echo $this->Functions->format_status($per[0]['st_status'],$per[0]['st_created'],$per[0]['st_user'],$per[0]['st_modified']); ?></td>
											</tr>
										<?php  endforeach; ?>
									
									</tbody>
								</table>
								
								<?php endif; ?>
								<?php endif; ?>	
							
							</div>
							
							
							</div>
							
						<input type="hidden" value="1" id="SearchKeywords">
						<input type="hidden" value="<?php echo $this->webroot;?>hrattendance/" id="webroot">
						 <?php echo $this->Form->end(); ?>
						</div>
					</div>
				</div>
					
					
				</div>
		
			
			</div>
			

		</div>	
			
		
		
		
		
				
		


