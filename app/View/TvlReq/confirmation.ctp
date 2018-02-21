<?php echo $this->element('tvl_menu'); ?>
<style type="text/css">
.form-wizard .wizard-steps{margin:0;background:none;border-bottom:1px solid #efefef;}
.form-wizard .step .control-group{padding:0}
.form-wizard .wizard-steps li.active{border-bottom:1px solid #efefef;}
.form-wizard .wizard-steps li{text-align:left;margin-left:10px;}
.form-wizard .wizard-steps.steps-3 li{width:30.3%}
</style>
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Add Travel Request</h1>
					</div>
					
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>tvlhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="<?php echo $this->webroot;?>tvlreq/">My Travel</a>
								<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="#">Add Travel Request</a>
						</li>
					</ul>
					
				</div>
				
				<?php echo $this->Session->flash();?>
					<div class="row-fluid footer_div">
					<div class="span12">
								<?php echo $this->Form->create('TvlReq', array('id' => 'formID', 'class' => 'form-horizontal form-column form-bordered  form-wizard')); ?>

						<div class="box box-color">

							<div class="box-content nopadding">
									<div class="step" id="firstStep">
										<ul class="wizard-steps steps-3">
											<li>
												<div class="single-step">
													<span class="title">1</span>
													<span class="circle">
														
													</span>
													<span class="description">
														Journey Details
													</span>
												</div>
											</li>
											<li >
												<div class="single-step">
													<span class="title">2</span>
													<span class="circle">
													</span>
													<span class="description">
														Passenger Details
													</span>
												</div>
											</li>
											<li  class='active'>
												<div class="single-step">
													<span class="title">3</span>
													<span class="circle"><span class="active"></span>
													</span>
													<span class="description">
														Confirmation
													</span>
												</div>
											</li>
										</ul>
								

								
									<h6><i class="icon-calendar"></i>  Journey Details</h6>
								<div class="row-fluid row1" style="margin-top:10px;border:1px solid #efefef">
								

									<div class="span6">
										<div class="control-group">
											<label for="textfield" class="control-label">Travel Type </label>
											<div class="controls">
									<?php echo $this->Functions->get_travel_type($this->Session->read('STEP1.type'));?>
					
													
												
											</div>
										</div>
										
									<div class="control-group">
											<label for="textfield" class="control-label">Customer </label>
											<div class="controls">
													
													
				<?php echo $this->Session->read('STEP1.customer');?>
				
											
													
												
											</div>
										</div>
										
										<div class="control-group">
											<label for="textfield" class="control-label">Debit To </label>
											<div class="controls">
													
													
				
				<?php if($this->Session->read('STEP1.debit_same') == 'Y'):
					echo $this->Session->read('STEP1.customer');
					else: 									
					echo  $this->Session->read('STEP1.debit_customer');
					endif;
				?>								
													
													
												
											</div>
										</div>
										
										
											<div class="control-group">
											<label for="password" class="control-label">Purpose </label>
											<div class="controls">
											<?php echo $this->Session->read('STEP1.purpose');?>
												
											
												
											</div>
										</div>
										
											
										
										<div class="control-group">
											<label for="textfield" class="control-label">Mode of Travel </label>
											<div class="controls">
											<?php echo $this->Session->read('STEP1.tvl_mode');?>
													
												
											</div>
										</div>

								<div class="control-group">
											<label for="textfield" class="control-label">Class 
											</label>
											<div class="controls">
											
											<?php echo $this->Session->read('STEP1.tvl_class');?>
							
													
												
											</div>
										</div>		
							
										
									</div>
									<div class="span6">
										
							
									<div class="control-group">
											<label for="password" class="control-label">Place of Travel  </label>
											<div class="controls">
					<?php echo $this->Session->read('STEP1.tvl_depart_id_place');?> to <?php echo $this->Session->read('STEP1.tvl_dest_id_place');?>
											</div>
										</div>
										<div class="control-group">
											<label for="textfield" class="control-label">Journey Date </label>
											<div class="controls">
											
										<?php echo $this->Session->read('STEP1.start_date');										
										if($this->Session->read('STEP1.type') == '2'):
										echo ', '; echo $this->Session->read('STEP1.return_date'); echo '(Return)';
										endif;?>
												
											</div>
										</div>
										
									<?php
									if($this->Session->read('STEP1.type') == '2'):	
									$desire_type = '(Onward)';
									endif;
									?>
											<div class="control-group">
											<label for="password" class="control-label">Desired Time <?php echo $desire_type;?> </label>
											<div class="controls">
											
				<?php if($this->Session->read('STEP1.desire_depart_from') && 	$this->Session->read('STEP1.desire_depart_to')):?>						
				Departure: <?php echo $this->Session->read('STEP1.desire_depart_from');?> to <?php echo $this->Session->read('STEP1.desire_depart_to');?>; 
				<?php endif; ?>
				<?php if($this->Session->read('STEP1.desire_arrival_from') && 	$this->Session->read('STEP1.desire_arrival_to')):?>	
				Arrival: <?php echo $this->Session->read('STEP1.desire_arrival_from');?> to <?php echo $this->Session->read('STEP1.desire_arrival_to');?>
				<?php endif; ?>							</div>
										</div>
								
								<?php if($this->Session->read('STEP1.type') == '2'): ?>
										<div class="control-group">
											<label for="password" class="control-label">Desired Time (Return)</label>
											<div class="controls">
				
				<?php if($this->Session->read('STEP1.desire_return_depart_from') && 	$this->Session->read('STEP1.desire_return_depart_to')):?>		
				Departure: <?php echo $this->Session->read('STEP1.desire_return_depart_from');?> to <?php echo $this->Session->read('STEP1.desire_return_depart_to');?>; 
				<?php endif; ?>			
				
				<?php if($this->Session->read('STEP1.desire_return_arrival_from') && 	$this->Session->read('STEP1.desire_return_arrival_to')):?>		
				Arrival: <?php echo $this->Session->read('STEP1.desire_return_arrival_from');?> to <?php echo $this->Session->read('STEP1.desire_return_arrival_to');?>
				<?php endif; ?>										
											</div>
										</div>
								<?php endif; ?>		
									
										
									
										
										<div class="control-group">
											<label for="password" class="control-label">Booking Particulars</label>
											<div class="controls">
												<?php echo $this->Session->read('STEP1.spl_particular');?>										
												
											
												
											</div>
										</div>
										
											<div class="control-group">
											<label for="password" class="control-label">Expected Outcome </label>
											<div class="controls">
																	<?php echo $this->Session->read('STEP1.expected_outcome');?>								
												
											
												
											</div>
										</div>
										
									
									</div>
								
									
									
									
					
									
									
									
									</div>
								
									</div>
									
									
								
									
																		
								
							</div>
									
									<h6><i class="icon-user"></i> Passenger Details</h6>
									
				<table class="table table-hover table-nomargin table-condensed" style="font-size:13px;border:1px solid #efefef">
									<thead>
										<tr>
											<th>S.No</th>
											<th>Passenger Name</th>
											<th class="">Age</th>
											<th class="">Gender</th>
											<th class="">Mobile</th>
												<th class="">Email</th>
													<th class="">Id Card Type</th>
														<th class="">Id Card No.</th>
										</tr>
									</thead>
									<tbody>
									
										<tr>
							<td>1</td>
							<td><?php echo $this->Session->read('STEP2.passenger');?></td>
							<td class="hidden-350"><?php echo $this->Session->read('STEP2.age');?></td>
							<td class="hidden-1024"><?php echo $this->Functions->show_gender($this->Session->read('STEP2.gender'));?></td>
							<td class="hidden-480"><?php echo $this->Session->read('STEP2.mobile_no');?></td>
							<td class="hidden-480"><?php echo $this->Session->read('STEP2.email_id');?></td>
							<td class="hidden-480"><?php echo $this->Session->read('STEP2.id_type_idtype');?></td>
							<td class="hidden-480"><?php echo $this->Session->read('STEP2.id_no');?></td>
										</tr>
									
						<?php  $k = 2; for($i = 0; $i < $this->Session->read('STEP2.rec_count'); $i++): ?>
						<?php if($this->Session->read('STEP2.passenger'.$i) != ''):?>
							<tr>
							<td><?php echo $k++;?></td>
							<td><?php echo $this->Session->read('STEP2.passenger'.$i);?></td>
							<td class="hidden-350"><?php echo $this->Session->read('STEP2.age'.$i);?></td>
							<td class="hidden-1024"><?php echo $this->Functions->show_gender($this->Session->read('STEP2.gender'.$i));?></td>
							<td class="hidden-480"><?php echo $this->Session->read('STEP2.mobile'.$i);?></td>
							<td class="hidden-480"><?php echo $this->Session->read('STEP2.email_id'.$i);?></td>
							<td class="hidden-480"><?php echo $this->Session->read('STEP2.id_type'.$i.'_idtype');?></td>
							<td class="hidden-480"><?php echo $this->Session->read('STEP2.id_no'.$i);?></td>
						</tr>
						<?php endif; endfor;?>	
						
						<?php
						for($i = 0; $i < $this->Session->read('STEP2.form_count'); $i++): ?>
						<?php if($this->Session->read('STEP2.employee_'.$i) != ''):?>
							<tr>
							<td><?php echo $k++;?></td>
							<td><?php echo $this->Session->read('STEP2.employee_'.$i);?></td>
							<td class="hidden-350"><?php echo $this->Session->read('STEP2.age_'.$i);?></td>
							<td class="hidden-1024"><?php echo $this->Functions->show_gender($this->Session->read('STEP2.gender_'.$i));?></td>
							<td class="hidden-480"><?php echo $this->Session->read('STEP2.mobile_'.$i);?></td>
							<td class="hidden-480"><?php echo $this->Session->read('STEP2.email_'.$i);?></td>
							<td class="hidden-480"><?php echo $this->Session->read('STEP2.id_type_'.$i.'_idtype');?></td>
							<td class="hidden-480"><?php echo $this->Session->read('STEP2.id_no_'.$i);?></td>
						</tr>
						<?php endif; endfor;?>	

											
										
									</tbody>
								</table>
									
									
								
						
							<div class="form-actions" style="clear:left;padding-left:180px;border-top:1px solid #ddd;">
			<a href="<?php echo $this->webroot;?>tvlreq/add_request/journey/"><input type="button"  class="btn hideBtn btn-green" value="Journey Details"></a>
			
							<a href="<?php echo $this->webroot;?>tvlreq/add_request/passenger/"><input type="button"  class="btn hideBtn btn-green" value="Passenger Details"></a>

			<input type="submit" name="data[TvlReq][next]" style="margin-left:10px" class="btn btn-primary tvlConfirm" value="Send">
			
				<a href="<?php echo $this->webroot;?>tvlreq/" style="margin-left:10px"><button type="button" class="btn regCancel hideBtn">Cancel</button></a>
				
									</div>
						</div>
						
						<?php echo $this->Form->end(); ?>
					</div>
				</div>
				
					
				</div>
		
			
			</div>
		</div>	

