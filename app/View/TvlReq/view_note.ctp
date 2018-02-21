<style>
.ui-widget-header{color:#000000}
</style>
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="" style="">
						<h5>
					
					
						View Ticket Status</h5>
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
											<label for="textfield" class="control-label">Travel Id </label>
											<div class="controls">
										<?php echo $this->Functions->get_tvl_id($this->request->params['pass'][0]);?>
							
											</div>
										</div>
								
								<?php if(!empty($ticket_update['TvlTicketStatus']['avail'])):?>
								
									<div class="control-group">
											<label for="textfield" class="control-label">Ticket Availability </label>
											<div class="controls">
				<?php echo $status = ($ticket_update['TvlTicketStatus']['avail'] == 'Y') ? 'Yes' : 'No';?>

											</div>
										</div>
									
									
					<?php  if($ticket_update['TvlTicketStatus']['avail'] == 'N'):?>													
							<div class="control-group">
											<label for="textfield" class="control-label">Suggestion Alternative
											</label>
											<div class="controls">
										
						<?php echo $ticket_update['TvlTicketStatus']['suggestion'];?>							
											</div>
										</div>
						<?php else:?>				
										
								
									<div class="control-group">
											<label for="textfield" class="control-label">Mode of Travel </label>
											<div class="controls">
										
								<?php echo $ticket_update['TvlMode']['mode'];?>		 
													
									
											</div>
										</div>
										
										
									<div class="control-group">
											<label for="textfield" class="control-label">Booking Mode </label>
											<div class="controls">
								<?php echo $this->Functions->get_book_mode($ticket_update['TvlTicketStatus']['book_mode']);?>		
													
											</div>
									</div>
										
											<div class="control-group">
											<label for="textfield" class="control-label">Booking Date 
											</label>
											<div class="controls">
									<?php echo $this->Functions->format_date($ticket_update['TvlTicketStatus']['issue_date']);?>	
													
											</div>
										</div>
										
										<div class="control-group">
											<label for="textfield" class="control-label">Comment
											</label>
											<div class="controls">
						<?php echo $ticket_update['TvlTicketStatus']['remark'];?>				
													
											</div>
										</div>	
										
					<?php endif; ?>
									
									
										
									</div>
								
						<?php if($this->request->query['page'] == 'refresh'):?>
						
							<div class="span12">
										<div class="form-actions">
										
	<a href="javascript:void(0)"><button type="button" class="btn tktReload">Close</button></a>						
											
						</div>
							</div>
							
						
			

						<?php endif; ?>
						
						
							
							<?php endif; ?>


										<input type="hidden" id="is_page_reload" value="<?php echo $this->request->query['page'];?>"/>
								<input type="hidden" class="tktAvail" value="<?php echo $ticket_update['TvlTicketStatus']['avail'];?>"/>
									<?php echo $this->Form->input('id', array('type' => 'hidden'));?>
								<?php echo $this->Form->end(); ?>
							</div>
						</div>
					</div>
				</div>
					
					
				</div>
		
			
			</div>
		</div>	
			
	

	
