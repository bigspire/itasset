<?php $date_st = explode('-', $selMonth);
 ?>

	<div class="" style="margin-left:48%;position:fixed;">
								<h5>
									<i class="icon-hand-right"></i>
									<?php //echo date('Y', strtotime($date_st[0].'-'.$date_st[1].'-1'));?>
									Leave Status - <?php echo date('Y');?>
								</h5>
								
								
							</div>
							


	<table width="350"  style="margin-left:48%;position:fixed;margin-top:40px;width:400px;" class="table table-hover table-nomargin table-bordered" id="attDiv">
		<thead class="thin-border-bottom" >
						<tr>
																<th width="100">
																
																	Leave Type
																</th>

																<th width="100" style="border-right:1px solid #efefef!important">
																	
																	Balance
																</th>

															
															</tr>
														</thead>

						<tbody>
						
						<?php echo $this->element('leave_summary');?>
				
								</tbody>
								
								</table>
						
	<?php $margin_top = ($this->Session->read('USER.Login.emp_type') == 'A' || $this->Session->read('USER.Login.emp_type') == 'A2') ? '200px' : '260px'; ?>
	
	<div class="" style="margin-left:48%;position:fixed;z-index:1;margin-top:<?php echo $margin_top;?>;">
								<h5>
									<i class="icon-hand-right"></i> <?php // , strtotime($date_st[0].'-'.$date_st[1].'-1')?>
									Permission for the month - <?php echo date('M');?>, <?php echo date('Y', strtotime($date_st[0].'-'.$date_st[1].'-1'));?>
								</h5>
								
								
							</div>
							
	<?php $margin_top = ($this->Session->read('USER.Login.emp_type') == 'A' || $this->Session->read('USER.Login.emp_type') == 'A2') ? '240px' : '300px'; ?>
							
	<table width="350" style="margin-left:48%;position:fixed;margin-top:<?php echo $margin_top;?>;width:400px;" class="table table-striped table-bordered table-hover" id="attDiv">
			<thead class="thin-border-bottom">
						<tr>
																<th width="100">
																
																Permission Allowed 
																</th>

																<th width="100">
																	
																	Balance
																</th>

															
															</tr>
														</thead>

						<tbody><tr>
																<td>2 Hrs
										
																</td>

																<td>	<?php 	echo $remain_data;?> Hrs
								</td>
								
								</tr>
								
								</tbody>
								
								</table>
								
			<?php $margin_top = ($this->Session->read('USER.Login.emp_type') == 'A' || $this->Session->read('USER.Login.emp_type') == 'A2') ? '350px' : '398px'; ?>
			
			<div class="" style="margin-left:48%;position:fixed;margin-top:<?php echo $margin_top;?>;">
						<a href="<?php echo $this->webroot;?>home/late_hr_status/" class="iframeBox" val="40_40"><button class="btn btn-xs btn-warning">Late Hr Status -  <?php echo date('Y'); ?></button></a>

						<a style="margin-left:18px" href="<?php echo $this->webroot;?>home/holiday/" class="iframeBox" val="50_70"><button class="btn btn-xs btn-primary">Holidays -  <?php echo date('Y'); ?></button></a>
						
						<a style="margin-left:18px"  href="<?php echo $this->webroot;?>home/leave_status/" class="iframeBox" val="40_63"><button title="Attendance Status" class="btn btn-xs btn-danger">Att. Status -  <?php echo date('Y'); ?></button></a>
			</div>
								<!--h5>
									<i class="icon-hand-right"></i>
									Holidays -  <?php echo date('Y'); ?>
								</h5>
								<li style="list-style:none;margin-left:20px;">
											
											
													</li-->
								
										