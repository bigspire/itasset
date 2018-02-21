<?php echo $this->element('hr_menu'); ?>
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>View Latest Updates</h1>
					</div>
					
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>hrhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="<?php echo $this->webroot;?>hrlatest/">Latest Updates</a>
								<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="#">View Latest Updates</a>
						</li>
					</ul>
					
				</div>
				
					<div class="row-fluid footer_div">
					<div class="span12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3><i class="icon-list"></i> View Latest Updates Details</h3>
							</div>
							<div class="box-content nopadding">
								
								
								<?php echo $this->Form->create('HrLatest', array('id' => '', 'class' => 'form-horizontal form-column form-bordered')); ?>
								
								
									<div class="span12">
										<div class="control-group">
											<label for="textfield" class="control-label">Title</label>
											<div class="controls">
													<?php echo $frm_data['HrLatest']['title'];?>
													
												
											</div>
										</div>
										<div class="control-group">
											<label for="password" class="control-label">Description </label>
											<div class="controls">
												<?php echo $frm_data['HrLatest']['desc'];?>
											</div>
										</div>
									
										
								
									
									
									<div class="control-group">
											<label for="password" class="control-label">Attachment </label>
											<div class="controls">
											<?php if(!empty($frm_data['HrLatest']['attachment'])):?>
												<a href="<?php echo $this->webroot;?>hrlatest/download_update/<?php echo $frm_data['HrLatest']['attachment'];?>/" class="btn btn-pink" rel="tooltip" title="Download"><?php echo $frm_data['HrLatest']['attachment'];?></a>
												<?php else:?>
												No File Attached
												<?php endif; ?>
												
												
												
												
											</div>
										</div>
									
									
									<div class="control-group">
											<label for="password" class="control-label">Type </label>
											<div class="controls">
												<?php echo $frm_data['HrLatest']['news_type'] =='K' ? 'Knowledge Centre' : 'Latest Updates';?>
												
												
											</div>
										</div>
										
												<div class="control-group">
											<label for="password" class="control-label">Status </label>
											<div class="controls">
												<?php echo $this->Functions->show_status($frm_data['HrLatest']['status']);?>
												
												
											</div>
										</div>
										
										
									</div>
									<div class="span12">
										<div class="form-actions">
											<a href="<?php echo $this->webroot;?>hrlatest/edit_updates/<?php echo $this->request->params['pass'][0];?>/">
											<button type="button" class="btn btn-primary"><i class="icon-edit"></i>  Edit  </button></a>
											<a href="<?php echo $this->webroot;?>hrlatest/"><button type="button" class="btn"><i class="icon-arrow-left"></i>  Go Back</button></a>
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
			
		
	

