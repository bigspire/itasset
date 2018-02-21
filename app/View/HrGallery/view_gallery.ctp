<?php echo $this->element('hr_menu'); ?>
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>View Gallery</h1>
					</div>
					
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>hrhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="<?php echo $this->webroot;?>hrgallery/">Gallery</a>
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
								<h3><i class="icon-list"></i> View Gallery Details</h3>
							</div>
							<div class="box-content nopadding">
								
								
								<?php echo $this->Form->create('HrGallery', array('id' => '', 'class' => 'form-horizontal form-column form-bordered')); ?>
								
								
														<div class="span12">
									
								
										
										
									
										
											<div class="control-group">
											<label for="textfield" class="control-label">Title </label>
											<div class="controls">
						<?php echo $gallery_data['HrGallery']['title'];?>
 
											</div>
										</div>
										
											
											<div class="control-group">
											<label for="textfield" class="control-label">Description </label>
											<div class="controls">
										
													<?php echo $gallery_data['HrGallery']['desc'];?>
											</div>
										</div>
					
										
										
									
										
			
										
								<div class="control-group">
											<label for="textfield" class="control-label">Photos </label>
											<div class="controls">
										
						<?php foreach($gallery_items as $item): ?>
						
					<div class="view_gal">
<a href="<?php echo $this->webroot.'file_upload/server/php/'.$gallery_data['HrGallery']['folder'].'/'.$item['HrGalleryItem']['file']; ?>" rel="gallery" class="colorbox"><img  src="<?php echo $this->webroot;?>timthumb.php?src=file_upload/server/php/<?php echo $gallery_data['HrGallery']['folder'].'/thumbnail/'.$item['HrGalleryItem']['file'];?>&h=50&q=100"/></a>
					
					</div>
						
					 <?php	endforeach; ?>
											</div>
										</div>		
										
										
									
									
								
									</div>


								<div class="span12">
										<div class="form-actions">
										
											<a href="<?php echo $this->webroot;?>hrgallery/"><button type="button" class="btn"><< Go Back</button></a>
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
			
		
	

