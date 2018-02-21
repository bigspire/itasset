<?php echo $this->element('hr_menu'); ?>
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Gallery - Approve/Reject</h1>
					</div>
					
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>hrhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="<?php echo $this->webroot;?>hrgalapprove/">Approve Gallery</a>
								<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="#">View Gallery</a>
						</li>
					</ul>
					
				</div>
				
					<div class="row-fluid footer_div">
					<div class="span12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3><i class="icon-list"></i> View Gallery</h3>
							</div>
							<div class="box-content nopadding">
								
								
								<?php echo $this->Form->create('HrGalApprove', array('id' => 'formID', 'class' => 'form-horizontal form-column form-bordered')); ?>
								
								
									
									
								<div class="span12">
									
								
										
										
									
										
											<div class="control-group">
											<label for="textfield" class="control-label">Title </label>
											<div class="controls">
						<?php echo $gallery_data['HrGalApprove']['title'];?>
 
											</div>
										</div>
										
											
											<div class="control-group">
											<label for="textfield" class="control-label">Description </label>
											<div class="controls">
										
													<?php echo $gallery_data['HrGalApprove']['desc'];?>
											</div>
										</div>
					
										
										
									
										
			
										
								<div class="control-group">
											<label for="textfield" class="control-label">Photos <span class="red_star">*</span></label>
											<div class="controls">
										
						<?php foreach($gallery_items as $item): ?>
						
					<div class="view_gal">
<a href="<?php echo $this->webroot.'file_upload/server/php/'.$gallery_data['HrGalApprove']['folder'].'/'.$item['HrGalleryItem']['file']; ?>" rel="gallery" class="colorbox"><img  src="<?php echo $this->webroot;?>timthumb.php?src=file_upload/server/php/<?php echo $gallery_data['HrGalApprove']['folder'].'/thumbnail/'.$item['HrGalleryItem']['file'];?>&h=50&q=100"/></a>

<?php if($VIEW_ONLY != 1):?>
					<div style="margin-top:10px;color:#ff0000"><?php echo $this->Form->input('reject.', array('label' => 'Reject', 'value' => $item['HrGalleryItem']['id'], 'type' => 'checkbox')); ?>
					</div>
				
	<?php endif; ?>					
				</div>		 <?php	endforeach; ?>
											</div>
										</div>		
										
										
									
									
								
									</div>

									<div class="span12">
										<div class="form-actions">
										<?php if($VIEW_ONLY == 1):?>
												<a href="<?php echo $this->webroot;?>hrgalapprove/"><button type="button" class="btn"><< Go Back</button></a>
										<?php else: ?>
										<a class="" href="javascript:void(0);">
											<button type="button" name="<?php echo $this->webroot;?>hrgalapprove/process_gal/<?php echo $this->request->params['pass'][0];?>/<?php echo $this->request->params['pass'][1];?>/A/<?php echo $this->request->params['pass'][2];?>/" class="btn btn-green approveRec">Approve</button></a>
											
											
											<a href="javascript:void(0);">
											<button type="button" name="<?php echo $this->webroot;?>hrgalapprove/process_gal/<?php echo $this->request->params['pass'][0];?>/<?php echo $this->request->params['pass'][1];?>/R/<?php echo $this->request->params['pass'][2];?>/" class="btn btn-red rejectRec">Reject</button></a>
											
											<a href="<?php echo $this->webroot;?>hrgalapprove/"><button type="button" class="btn">Cancel</button></a>
											
										<?php endif; ?>
										
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
			
		
<div id="dialog-confirm" title="Approve Confirmation!" class="dn">
	<p>Are you sure you want to approve?</p>
</div>	

<div id="dialog-rej-confirm" title="Reject Confirmation!" class="dn">
	<p>Are you sure you want to reject?</p>
		<?php echo $this->Form->input('HrGalStatus.remarks', array('div'=> false,'type' => 'textarea', 'label' => false, 'class' => 'input-block-level', 'id' => 'remarks', 'required' => false, 'placeholder' => '', 'rows' => '4', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
</div>	
