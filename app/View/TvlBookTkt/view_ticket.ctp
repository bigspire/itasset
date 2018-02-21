<style>
.ui-widget-header{color:#000000}
</style>
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="" style="">
						<h5>
					
					
						View Booked Ticket</h5>
					</div>
					
				</div>
			
				
				<?php echo $this->Session->flash();?>
				
					<div class="row-fluid">
					<div class="span12">
						<div class="box box-color box-bordered">
							
							<div class="box-content nopadding">
								
								
								<?php echo $this->Form->create('TvlBookTkt', array('id' => 'formID', 'class' => 'form-horizontal form-column form-bordered')); ?>
								
								
									<div class="span6">
									
							
										
										
											<div class="control-group">
											<label for="textfield" class="control-label">Ticket </label>
											<div class="controls">
											
								<a href="<?php echo $this->webroot;?>tvlbooktkt/download/<?php echo $this->request->params['pass'][1];?>/1/?tvl_type=<?php echo $this->request->query['tvl_type'];?>">Download</a>
												</div>
										</div>
										
							
									<div class="control-group">
											<label for="textfield" class="control-label">Booking Date</label>
											<div class="controls">
					
							<?php  echo $this->Functions->format_date($ticket['TvlTicket']['book_date']);?>
												
											</div>
										</div>
											
										
											<div class="control-group">
											<label for="textfield" class="control-label">Booked Through</label>
											<div class="controls">
					
							<?php  echo $this->Functions->get_book_via($ticket['TvlTicket']['book_via']);?>
												
											</div>
										</div>
								
									<?php if($ticket['TvlTicket']['book_via'] == 'A'):?>
										<div class="control-group">
											<label for="textfield" class="control-label">Agent Copy </label>
											<div class="controls">
											
								<a href="<?php echo $this->webroot;?>tvlbooktkt/download/<?php echo $this->request->params['pass'][1];?>/1/?file=agentcopy&tvl_type=<?php echo $this->request->query['tvl_type'];?>">Download</a>
												
											</div>
										</div>
									<?php endif; ?>	
									
								
										
										
							<div class="control-group">
											<label for="textfield" class="control-label">Ticket Fare (INR) </label>
											<div class="controls">
											
	Rs. <?php echo $ticket['TvlTicket']['amount'];?>									
												
											</div>
										</div>
						
									<div class="control-group">
											<label for="textfield" class="control-label">Booking Ref. No. </label>
											<div class="controls">
											
	<?php echo $ticket['TvlTicket']['book_ref_no'];?>				
												
											</div>
										</div>
								

								
										
										
										
									</div>
								
					
				<?php if($this->request->query['page'] == 'refresh'):?>
				<div class="span12">
					<div class="form-actions">						
	<a href="javascript:void(0)"><button type="button" class="btn tktReload">Close</button></a>	
</div>
							</div>	
			<?php else: ?>
							
<div class="span12">
					<div class="form-actions">						
	<a href="<?php echo $this->webroot;?>tvlbooktkt/edit_ticket/<?php echo $this->request->params['pass'][0];?>/<?php echo $this->request->params['pass'][1];?>/?tvl_type=<?php echo $this->request->query['tvl_type'];?>"><button type="button" class="btn btn-primary">Edit</button></a>	
</div>
							</div>	
					<?php endif; ?>

										<input type="hidden" id="is_page_reload" value="<?php echo $this->request->query['page'];?>"/>
									<?php echo $this->Form->input('id', array('type' => 'hidden'));?>
								<?php echo $this->Form->end(); ?>
							</div>
						</div>
					</div>
				</div>
					
					
				</div>
		
			
			</div>
		</div>	
			
	

	
