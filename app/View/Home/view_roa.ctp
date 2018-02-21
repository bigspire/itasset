<style>
.form-horizontal.form-bordered .control-group .control-label{
padding:10px 10px 0px 10px;
}

.ui-dialog-title{color:#ffffff}
</style>	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left" style="height:auto;">
						  <h4 class="modal-title">Achievement Details</h4>
					</div>
					
				</div>
				
				<?php echo $this->Session->flash();?>
				
					<div class="row-fluid">
					<div class="span12">
						<div class="box box-bordered" style="border-top:1px solid #cccccc">
							
							<div class="box-content nopadding">
								
								
								<?php echo $this->Form->create('TskRoaApprove', array('id' => 'formID', 'class' => 'form-horizontal form-column form-bordered')); ?>
								
								
									<div class="span6">
									<div class="control-group">
											<label for="textfield" class="control-label" style="">Recognition For  </label>
											<div class="controls">
												<?php echo $roa_data['Homes2']['first_name'].' '.$roa_data['Homes2']['last_name'];?>
											</div>
										</div>
										<div class="control-group">
											<label for="textfield" class="control-label" style="">Recognition Month </label>
											<div class="controls">
												<?php echo $this->Functions->format_month($roa_data['TskRoaApprove']['reward_month']);?>
											</div>
										</div>
										
										<div class="control-group">
											<label for="textfield" class="control-label">Individual or Team? </label>
											<div class="controls">
													<?php echo $this->Functions->get_roa_type($roa_data['TskRoaApprove']['type']);?>
													
												
											</div>
										</div>
										
										
										
<div class="control-group">
											<label for="password" class="control-label">Description </label>
											<div class="controls">
											<?php echo $roa_data['TskRoaApprove']['emp_acts'];?>
												
												
											</div>
										</div>
										
										<div class="control-group">
											<label for="password" class="control-label">Rating</label>
											<div class="controls">
												<?php echo $this->Functions->show_roa_rating($roa_data['TskRoaApprove']['rating']);?>
												
												
											</div>
										</div>
									
										
									</div>
									<div class="span6">
										
									
										<div class="control-group">
											<label for="password" class="control-label">Recommended For </label>
											<div class="controls">
												<?php echo $roa_data[0]['roa_category'];?>
											</div>
										</div>
									
									<div class="control-group">
											<label for="password" class="control-label">Business performance</label>
											<div class="controls">
												
												<?php echo $roa_data['TskRoaApprove']['emp_relate'];?>
											</div>
										</div>
											
								
									<div class="control-group">
											<label for="password" class="control-label">Recommended By</label>
											<div class="controls">
												
												<?php echo $roa_data['Employee']['first_name'];?>
											</div>
										</div>
								
									</div>
									
								
								<?php echo $this->Form->end(); ?>
							</div>
						</div>
					</div>
				
				
				
				
				
				</div>
					
					
				</div>
		
			
			</div>
		
			
					
				
		
		</div>	
			


