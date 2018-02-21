<?php echo $this->element('hr_menu'); ?>
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>View Message</h1>
					</div>
					
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>hrhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="<?php echo $this->webroot;?>hrmessage/">Message</a>
								<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="#">View Message</a>
						</li>
					</ul>
					
				</div>
				
					<div class="row-fluid footer_div">
					<div class="span12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3><i class="icon-list"></i> View Message Details</h3>
							</div>
							<div class="box-content nopadding">
								
								
								<?php echo $this->Form->create('HrMessage', array('id' => '', 'class' => 'form-horizontal form-column form-bordered')); ?>
								
								
									<div class="span12">
										<div class="control-group">
											<label for="textfield" class="control-label">Title</label>
											<div class="controls">
													<?php echo $frm_data['HrMessage']['title'];?>
													
												
											</div>
										</div>
										<div class="control-group">
											<label for="password" class="control-label">Description </label>
											<div class="controls">
												<?php echo $frm_data['HrMessage']['desc'];?>
											</div>
										</div>
									
										
								
									
									
								
									
										<div class="control-group">
											<label for="password" class="control-label">Show To </label>
											<div class="controls">
												<?php echo $frm_data['HrMessage']['show_type'] =='A' ? 'All Users' : 'Approvers\s Only';?>
												
												
											</div>
										</div>
									<div class="control-group">
											<label for="password" class="control-label">Display Type </label>
											<div class="controls">
												<?php echo $frm_data['HrMessage']['display_type'] =='N' ? 'Particular Date Only' : 'Every Month';?>, 
												<b>Start:</b> <?php echo $frm_data['HrMessage']['display_type'] =='N' ? $this->Functions->format_date($frm_data['HrMessage']['start_date']) : $frm_data['HrMessage']['start_day'];?>
												<b>End: </b> <?php echo $frm_data['HrMessage']['display_type'] =='N' ? $this->Functions->format_date($frm_data['HrMessage']['end_date']) : $frm_data['HrMessage']['end_day'];?>

												
											</div>
										</div>
											<div class="control-group">
											<label for="password" class="control-label">Attachment </label>
											<div class="controls">
											<?php if(!empty($frm_data['HrMessage']['attachment'])):?>
												<a href="<?php echo $this->webroot;?>hrmessage/download_update/<?php echo $frm_data['HrMessage']['attachment'];?>/" class="btn btn-pink" rel="tooltip" title="Download"><?php echo $frm_data['HrMessage']['attachment'];?></a>
												<?php else:?>
												No File Attached
												<?php endif; ?>
												
												
												
												
											</div>
										</div>
												<div class="control-group">
											<label for="password" class="control-label">Status </label>
											<div class="controls">
												<?php echo $this->Functions->show_status($frm_data['HrMessage']['status']);?>
												
												
											</div>
										</div>
										
										
									</div>
									<div class="span12">
										<div class="form-actions">
											<a href="<?php echo $this->webroot;?>hrmessage/edit_message/<?php echo $this->request->params['pass'][0];?>/">
											<button type="button" class="btn btn-primary"><i class="icon-edit"></i>  Edit  </button></a>
											<a href="<?php echo $this->webroot;?>hrmessage/"><button type="button" class="btn"><i class="icon-arrow-left"></i>  Go Back</button></a>
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
			
		
	

