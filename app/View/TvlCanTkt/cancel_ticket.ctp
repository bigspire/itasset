<?php echo $this->element('tvl_menu'); ?>
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>View Travel Request</h1>
					</div>
					
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>tvlhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="<?php echo $this->webroot;?>tvlcantkt/">Cancel Ticket</a>
								<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="#">View Travel Request</a>
						</li>
					</ul>
					
				</div>
				
					<div class="row-fluid footer_div">
					<div class="span12">
						<div class="box box-color">
							
							<div class="box-content nopadding">
								
								
								<?php echo $this->Form->create('TvlCanTkt', array('id' => 'formID', 'class' => 'form-horizontal form-column form-bordered')); ?>
								
								<h6><i class="icon-calendar"></i>  Journey Details</h6>
								<div class="row-fluid row1" style="margin-top:10px;border:1px solid #efefef">
								

									<div class="span6">
									
									<div class="control-group">
											<label for="textfield" class="control-label">Travel ID </label>
											<div class="controls">
									<?php echo $this->Functions->get_tvl_id($this->request->params['pass'][0]);?>			
													
												
											</div>
										</div>
										
										
										<div class="control-group">
											<label for="textfield" class="control-label">Travel Type </label>
											<div class="controls">
									<?php echo $this->Functions->get_travel_type($tvl_data['TvlCanTkt']['type']);?>			
													
												
											</div>
										</div>
										
									<div class="control-group">
											<label for="textfield" class="control-label">Customer </label>
											<div class="controls">
													
													
				<?php echo $tvl_data['TskCustomer']['company_name'];?>									
													
													
													
												
											</div>
										</div>
										
										<div class="control-group">
											<label for="textfield" class="control-label">Debit To </label>
											<div class="controls">
													
													
				<?php echo $tvl_data['TvlDebit']['company_name'];?>									
													
													
													
												
											</div>
										</div>
										
										
											<div class="control-group">
											<label for="password" class="control-label">Purpose </label>
											<div class="controls">
											<?php echo $tvl_data['TvlCanTkt']['purpose'];?>										
											
												
											</div>
										</div>
										
											
										
										<div class="control-group">
											<label for="textfield" class="control-label">Mode of Travel </label>
											<div class="controls">
											<?php echo $tvl_data['TvlMode']['mode'];?>													
												
											</div>
										</div>

								<div class="control-group">
											<label for="textfield" class="control-label">Class 
											</label>
											<div class="controls">
											
											<?php echo $tvl_class_data[0][0]['tvl_req_class']; ?> 							
													
												
											</div>
										</div>		
											
										<div class="control-group">
											<label for="textfield" class="control-label"><span style="color:#FC8383">Cancel Reason</span>
											</label>
											<div class="controls">
											
											<?php echo $tvl_data['TvlCancel']['reason']; ?> 							
													
												
											</div>
										</div>
										
										
									</div>
									<div class="span6">
										<div class="control-group">
											<label for="textfield" class="control-label">Employee </label>
											<div class="controls">
									<?php echo $tvl_data['HrEmployee']['first_name'].' '.$tvl_data['HrEmployee']['last_name'];?>			
													
												
											</div>
										</div>
							
									<div class="control-group">
											<label for="password" class="control-label">Place of Travel  </label>
											<div class="controls">
					<?php echo $tvl_data['TvlStart']['place'];?> to <?php echo $tvl_data['TvlPlace']['place'];?>											</div>
										</div>
										<div class="control-group">
											<label for="textfield" class="control-label">Journey Date </label>
											<div class="controls">
											
											<?php echo $this->Functions->format_date_show($tvl_data['TvlCanTkt']['start_date']);?>
					<?php if($tvl_data['TvlCanTkt']['type'] == 2):?>,  
					<?php echo $this->Functions->format_date_show($tvl_data['TvlCanTkt']['return_date']);?> (Return)
					<?php endif; ?>
					
											</div>
										</div>
										
								 <?php if($tvl_data['TvlCanTkt']['type'] == 2):
									$desire_type = '(Onward)';
									endif;
									?>
									
											<div class="control-group">
											<label for="password" class="control-label">Desired Time <?php echo $desire_type;?> </label>
											<div class="controls">
		<?php if($tvl_data['TvlCanTkt']['desire_depart_from'] && 	$tvl_data['TvlCanTkt']['desire_depart_to']):?>						
				Departure: <?php echo $this->Functions->format_time_show($tvl_data['TvlCanTkt']['desire_depart_from']);?> to <?php echo $this->Functions->format_time_show($tvl_data['TvlCanTkt']['desire_depart_to']);?>; 
				<?php endif; ?>
				<?php if($tvl_data['TvlCanTkt']['desire_arrival_from'] && 	$tvl_data['TvlCanTkt']['desire_arrival_to']):?>	
				Arrival: <?php echo $this->Functions->format_time_show($tvl_data['TvlCanTkt']['desire_arrival_from']);?> to <?php echo $this->Functions->format_time_show($tvl_data['TvlCanTkt']['desire_arrival_to']);?>
				<?php endif; ?>										
															</div>
										</div>
								
								<?php if($tvl_data['TvlCanTkt']['type'] == 2):?>		
									<div class="control-group">
											<label for="password" class="control-label">Desired Time (Return) </label>
											<div class="controls">
			<?php if($tvl_data['TvlCanTkt']['desire_return_depart_from'] && 	$tvl_data['TvlCanTkt']['desire_return_depart_to']):?>						
				Departure: <?php echo $this->Functions->format_time_show($tvl_data['TvlCanTkt']['desire_return_depart_from']);?> to <?php echo $this->Functions->format_time_show($tvl_data['TvlCanTkt']['desire_return_depart_to']);?>; 
				<?php endif; ?>
				<?php if($tvl_data['TvlCanTkt']['desire_return_arrival_from'] && 	$tvl_data['TvlCanTkt']['desire_return_arrival_to']):?>	
				Arrival: <?php echo $this->Functions->format_time_show($tvl_data['TvlCanTkt']['desire_return_arrival_from']);?> to <?php echo $this->Functions->format_time_show($tvl_data['TvlCanTkt']['desire_return_arrival_to']);?>
				<?php endif; ?>								
															</div>
										</div>
									<?php endif; ?>					
									
										
										<div class="control-group">
											<label for="password" class="control-label">Booking Particulars</label>
											<div class="controls">
																						
												<?php echo $tvl_data['TvlCanTkt']['spl_particular']; ?>
											
												
											</div>
										</div>
										
											<div class="control-group">
											<label for="password" class="control-label">Expected Outcome </label>
											<div class="controls">
								<?php echo $tvl_data['TvlCanTkt']['expected_outcome']; ?>							
												
											
												
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
							<?php foreach($tvl_person as $key => $person):?>		
										<tr>
							<td><?php echo ++$key; ?></td>
							<td><?php echo $person['TvlPassenger']['passenger'];?></td>
							<td class="hidden-350"><?php echo $person['TvlPassenger']['age'];?></td>
							<td class="hidden-1024"><?php echo $this->Functions->show_gender($person['TvlPassenger']['gender']);?></td>
							<td class="hidden-480"><?php echo $person['TvlPassenger']['mobile'];?></td>
							<td class="hidden-480"><?php echo $person['TvlPassenger']['email_id'];?></td>
							<td class="hidden-480"><?php echo $person['TvlIdType']['title'];?></td>
							<td class="hidden-480"><?php echo $person['TvlPassenger']['id_no'];?></td>
							</tr>
							<?php endforeach; ?>		
												
										
									</tbody>
								</table>
									<?php echo $this->element('remarks');?>
									
									
									<div class="span12">
										<div class="form-actions">
												<?php if(empty($tkt_data[0]['TvlTicketCancel']['tvl_ticket_id'])):?>
											<a href="<?php echo $this->webroot;?>tvlcantkt/edit_ticket/<?php echo $tkt_data[0]['TvlTicket']['id'];?>/<?php echo $this->request->params['pass'][0];?>/"  val="50_72" class="iframeBox"/>
											<button type="button" class="btn btn-primary">Cancel Ticket <?php echo $journey1;?></button></a>
											<?php else:?>
											<a href="<?php echo $this->webroot;?>tvlcantkt/view_ticket/<?php echo $tkt_data[0]['TvlTicket']['id'];?>/<?php echo $this->request->params['pass'][0];?>/?tvl_type=O"  val="40_55" class="iframeBox"/>
											<button type="button" class="btn btn-green">Cancel Details <?php echo $journey1;?></button></a>
											<?php endif; ?>
											
											
											<?php if($tvl_data['TvlBookTkt']['type'] == '2'):
											if(empty($tkt_data2[0]['TvlTicketCancel']['tvl_ticket_id'])):?>
											<a href="<?php echo $this->webroot;?>tvlcantkt/edit_ticket/<?php echo $tkt_data2[0]['TvlTicket']['id'];?>/<?php echo $this->request->params['pass'][0];?>/?action=return"  val="50_72" class="iframeBox"/>
											<button type="button" class="btn btn-primary">Cancel Ticket <?php echo $journey2;?></button></a>
											<?php else:?>
											<a href="<?php echo $this->webroot;?>tvlcantkt/view_ticket/<?php echo $tkt_data2[0]['TvlTicket']['id'];?>/<?php echo $this->request->params['pass'][0];?>/?action=return&tvl_type=R"  val="40_55" class="iframeBox"/>
											<button type="button" class="btn btn-green">Cancel Details <?php echo $journey2;?></button></a>
											<?php endif;endif; ?>
												<a href="<?php echo $this->webroot;?>tvlcantkt/"><button type="button" class="btn"><< Go Back</button></a>
										
										
										</div>
									</div>
																			<input type="hidden" value="1" id="overlayclose">

								<?php echo $this->Form->end(); ?>
							</div>
						</div>
					</div>
				
				
				
			
				
				
				</div>
					
					
				</div>
		
			
			</div>
		</div>	
			
		

