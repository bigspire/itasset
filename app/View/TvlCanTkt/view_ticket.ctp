<style>
.ui-widget-header{color:#000000}
</style>
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="" style="">
						<h5>
					
					
						View Cancelled Ticket</h5>
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
											<label for="textfield" class="control-label">Cancellation Fee </label>
											<div class="controls">
											
	Rs. <?php echo $ticket['TvlTicketCancel']['cancel_fee'];?>									
												
											</div>
										</div>
						
									<div class="control-group">
											<label for="textfield" class="control-label">Remarks </label>
											<div class="controls">
											
	<?php echo $ticket['TvlTicketCancel']['remark'];?>				
												
											</div>
										</div>
								

								
										
										
										
									</div>
								
						
						
							
								<?php if($this->request->query['page'] == 'refresh'):?>
						
							<div class="span12">
										<div class="form-actions">
										
	<a href="javascript:void(0)"><button type="button" class="btn tktReload">Close</button></a>						
											
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
			
	

	
