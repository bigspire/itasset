<?php echo $this->element('hr_menu'); ?>
		
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Files</h1>
						
						
					</div>
				
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>hrhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						
						
						<li>
							<a href="<?php echo $this->webroot;?>hrfile/">Files</a>
							
						</li>
						
						
					</ul>
					
				</div>
				
				
				
				<?php echo $this->Session->flash();?>
				
					<div class="row-fluid  footer_div previewDiv" >
					<div class="span12">
						<div class="box box-bordered box-color">
						
						<div class="box-title">
								<h3><i class="icon-list"></i> Files </h3>
							</div>
							
						

						<?php echo $this->Form->create('HrFile', array('name' => '', 'type' => '', 'id' => 'formID', 'class' => '')); ?>
							<div class="box-content">
							
						<div class="dataTables_wrapper">
						
				<div class="" id="DataTables_Table_8_filter"  style="padding:15px">
				
				<span>Search:</span>  
				
				<?php echo $this->Form->input('keyword', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-large', 'value' => $this->params->query['keyword'],  'id' => 'SearchText', 'required' => false, 'autocomplete' => 'off', 'placeholder' => 'Search here...', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												
		
				
				
											
											<input type="submit" value="Search" class="btn btn-primary" style="margin-bottom:9px;margin-left:4px;">
											
													<a href="<?php echo $this->webroot;?>hrfile/"><button style="margin-bottom:9px;margin-left:4px;" type="button" class="btn btn-primary"><i class="icon-refresh"></i> Reset</button></a>
											
					<a href="<?php echo $this->webroot;?>hrfile/create_file/"><button type="button" class="btn btn-primary" style="float:right"><i class="icon-plus"></i> Add File</button></a>
						
								</div>			
								
								
<div id="dialog-confirm" title="Confirmation!" class="dn">
	<p>Are you sure you want to delete?</p>
</div>

<input type="hidden" id="del_url" value="<?php echo $this->webroot;?>hrfile/delete_file/"/>
								<table class="table table-hover table-nomargin table-bordered usertable dataTable">
									<thead>
										
										<tr>
											
											<th>
											<?php echo $this->Paginator->sort('title', 'File Name', array('escape' => false,'direction' => 'desc'));?>
												</th>
												
											<th>Link</th>	
													
											<th>Preview </th>
										
												
												<th>
											<?php echo $this->Paginator->sort('created_date', 'Created', array('escape' => false,'direction' => 'desc'));?>
												</th>
											
											
											
											<th>Options</th>
										</tr>
									</thead>
									<tbody>
									
										
									
										<?php  foreach($file_data as $frm):?>
										
										<tr>
											
											<td width="200"><?php echo $frm['HrFile']['title'];?></td>
											
			<td><a href="<?php echo Configure::read('WEBSITE').$this->webroot; ?>uploads/files/<?php echo $frm['HrFile']['image']; ?>" target="_blank"><?php echo Configure::read('WEBSITE').$this->webroot; ?>uploads/files/<?php echo $frm['HrFile']['image']; ?></a></td>
			
			<td><span class="label label-blue imgPreview" ><a href="javascript:void(0)" rel="preview" data-rel="timepopover" data-placement="bottom" class="prevImg"  data-content='<img src="<?php echo $this->webroot;?>timthumb.php?src=uploads/files/<?php echo $frm['HrFile']['image'];?>&w=300&q=100">' data-original-title="<b>Preview</b>">Show</a></span>
			</td>	
											
											<td><?php echo $this->Functions->format_date($frm['HrFile']['created_date']);?></td>
											
											<td class='hidden-480'>
											
											<a href="<?php echo $this->webroot;?>hrfile/download_image/<?php echo $frm['HrFile']['image'];?>/" class="btn" rel="tooltip" title="Download"><i class="icon-download"></i></a>
											
											
											
												<a href="<?php echo $this->webroot;?>hrfile/edit_file/<?php echo $frm['HrFile']['id'];?>/" class="btn" rel="tooltip" title="Edit"><i class="icon-edit"></i></a>
												<a href="javascript:void(0);" name="<?php echo $frm['HrFile']['id'];?>" class="btn delRec" rel="tooltip" title="Delete"><i class="icon-remove"></i></a>
											</td>
										</tr>
										
									<?php endforeach; ?>
									</tbody>
								</table>
								

								<?php echo $this->element('paging');?>
								
								




								
							</div>	

							</div>
						<input type="hidden" value="1" id="SearchKeywords">
						<input type="hidden" value="<?php echo $this->webroot;?>hrfile/" id="webroot">
						 <?php echo $this->Form->end(); ?>
						</div>
					</div>
				</div>
					
					
				</div>
		
			
			</div>
			

		</div>	
			
		
		
		
		
				
		


