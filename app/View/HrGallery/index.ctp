<?php echo $this->element('hr_menu'); ?>
		
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Gallery</h1>
						
						
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
							
						</li>
						
						
					</ul>
					
				</div>
				
				
				
				<?php echo $this->Session->flash();?>
				
					<div class="row-fluid  footer_div" >
					<div class="span12">
						<div class="box box-bordered box-color">
						
						<div class="box-title">
								<h3><i class="icon-list"></i> Gallery </h3>
							</div>
							
						

						<?php echo $this->Form->create('HrGallery', array('name' => '', 'type' => '', 'id' => 'formID', 'class' => '')); ?>
							<div class="box-content">
							
						<div class="dataTables_wrapper">
						
				<div class="" id="DataTables_Table_8_filter"  style="padding:15px">
				
				<span>Search:</span>  
				
				<?php echo $this->Form->input('keyword', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-large', 'value' => $this->params->query['keyword'],  'id' => 'SearchText', 'required' => false, 'autocomplete' => 'off', 'placeholder' => 'Search here...', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
					
 					
		
				
				
											
											<input type="submit" value="Search" class="btn btn-primary" style="margin-bottom:9px;margin-left:4px;">
											
													<a href="<?php echo $this->webroot;?>hrgallery/"><button style="margin-bottom:9px;margin-left:4px;" type="button" class="btn btn-primary"><i class="icon-refresh"></i> Reset</button></a>
											
					<a href="<?php echo $this->webroot;?>hrgallery/create_gallery/"><button type="button" class="btn btn-primary" style="float:right"><i class="icon-plus"></i> Add Gallery</button></a>
						
								</div>			
								

<input type="hidden" id="del_url" value="<?php echo $this->webroot;?>hrgallery/delete_gallery/"/>
								<table class="table table-hover table-nomargin table-bordered usertable dataTable">
									<thead>
										
										<tr>
											
											<th width="350">
											<?php echo $this->Paginator->sort('title', 'Title', array('escape' => false,'direction' => 'desc'));?>
												</th>
												
												<th  width="350">
											<?php echo $this->Paginator->sort('desc', 'Description', array('escape' => false,'direction' => 'desc'));?>
												</th>
													
										
													
										
												
												<th  width="110">
											<?php echo $this->Paginator->sort('created_date', 'Created', array('escape' => false,'direction' => 'desc'));?>
												</th>
											
											<th>Status</th>
											<th>Options</th>
										</tr>
									</thead>
									<tbody>
									
										
									
										<?php  foreach($gallery_data as $gallery):?>
										
										<tr>
											
											<td><?php echo $this->Functions->string_truncate($gallery['HrGallery']['title'], 50);?></td>
											
														
														
									<td><?php echo $this->Functions->string_truncate($gallery['HrGallery']['desc'], 50);?></td>
									
								
									
											
											<td><?php echo $this->Functions->format_date($gallery['HrGallery']['created_date']);?></td>
											
											<td>	<?php echo $this->Functions->get_hr_status($gallery[0]['st_status'],$gallery[0]['st_created'],$gallery[0]['st_user']); ?></td>
											
											<td class='hidden-480'>
											
									
											
												<a href="<?php echo $this->webroot;?>hrgallery/view_gallery/<?php echo $gallery['HrGallery']['id'];?>/" class="btn" rel="tooltip" title="View"><i class="icon-search"></i></a>
											
											</td>
										</tr>
										
									<?php endforeach; ?>
									</tbody>
								</table>
								

								<?php echo $this->element('paging');?>
								
								




								
							</div>	

							</div>
						<input type="hidden" value="1" id="SearchKeywords">
						<input type="hidden" value="<?php echo $this->webroot;?>hrgallery/" id="webroot">
						 <?php echo $this->Form->end(); ?>
						</div>
					</div>
				</div>
					
					
				</div>
		
			
			</div>
			

		</div>	
			
		
		
		
		
				
		


