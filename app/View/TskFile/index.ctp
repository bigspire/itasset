<?php echo $this->element('tsk_menu'); ?>
		
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>My Files</h1>
						
						
					</div>
				
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>tskhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						
						
						<li>
							<a href="<?php echo $this->webroot;?>tskfile/">My Files</a>
							
						</li>
						
						
					</ul>
					
				</div>
				
				
				
				<?php echo $this->Session->flash();?>
				
					<div class="row-fluid footer_div" >
					<div class="span12">
						<div class="box box-bordered box-color">
						
						<div class="box-title">
								<h3><i class="icon-list"></i> My Files</h3>
							</div>
							
						

						<?php echo $this->Form->create('TskFile', array('name' => '', 'type' => '', 'id' => 'formID', 'class' => '')); ?>
							<div class="box-content">
							
						<div class="dataTables_wrapper">
						
				<div class="" id="DataTables_Table_8_filter"  style="padding:15px">
				
				<span>Search:</span>  
				
				<?php echo $this->Form->input('SearchText', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-large', 'value' => $this->params->query['keyword'],  'id' => 'SearchText', 'required' => false, 'autocomplete' => 'off', 'placeholder' => 'Search here...', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												
		
				
				
											
											<input type="submit" value="Search" class="btn btn-primary" style="margin-bottom:9px;margin-left:4px;">
											
													<a href="<?php echo $this->webroot;?>tskfile/"><button style="margin-bottom:9px;margin-left:4px;" type="button" class="btn btn-primary"><i class="icon-refresh"></i> Reset</button></a>
											
					<a href="<?php echo $this->webroot;?>tskfile/create_file/"><button type="button" class="btn btn-primary" style="float:right"><i class="icon-plus"></i> Add File</button></a>
						
								</div>			
								
								
<div id="dialog-confirm" title="Confirmation!" class="dn">
	<p>Are you sure? once deleted, files will not be visible to assigned users</p>
</div>

<input type="hidden" id="del_url" value="<?php echo $this->webroot;?>tskfile/delete_file/"/>
								<table class="table table-hover table-nomargin table-bordered usertable dataTable">
									<thead>
										
										<tr>
											
											<th width="170">
											<?php echo $this->Paginator->sort('title', 'Title', array('escape' => false,'direction' => 'desc'));?>
												</th>
												
												
				<th width="450">
											<?php echo $this->Paginator->sort('desc', 'Description', array('escape' => false,'direction' => 'desc'));?>
												</th>							
										
												
												<th width="120">
											<?php echo $this->Paginator->sort('created_date', 'Created', array('escape' => false,'direction' => 'desc'));?>
												</th>
											
											<th width="150">
											<?php echo $this->Paginator->sort('HrEmployee.first_name', 'Owner', array('escape' => false,'direction' => 'desc'));?>
												</th>
													<th>
											Status
												</th>
											
											<th>Options</th>
										</tr>
									</thead>
									<tbody>
									
										
									
										<?php  foreach($file_data as $file):?>
										
										<tr>
											
											<td><?php echo $file['TskFile']['title'];?>
											<?php if($file['TskFileRead']['status'] == 'U'):?>
											<span class="label">Unread</span>
											<?php endif; ?></td>
											<td><?php echo $this->Functions->string_truncate($file['TskFile']['desc'], 50);?>
											</td>
											
											<td><?php echo $this->Functions->format_date($file['TskFile']['created_date']);?></td>
												<td><?php echo $file['HrEmployee']['first_name'].' '.$file['HrEmployee']['last_name'];?></td>
												<td><?php echo $this->Functions->show_status($file['TskFile']['status']);?></td>
											
											<td class='hidden-480'>
											<a href="<?php echo $this->webroot;?>tskfile/download/<?php echo $file['TskFile']['id'];?>/" class="btn" rel="tooltip click_hide" title="Download"><i class="icon-download"></i></a>
											
						<a href="<?php echo $this->webroot;?>tskfile/view_file/<?php echo $file['TskFile']['id'];?>/" class="btn" rel="tooltip" title="View"><i class="icon-search"></i></a>
						
					<?php if($file['TskFile']['app_users_id'] == $this->Session->read('USER.Login.id')):?>	
					<a href="<?php echo $this->webroot;?>tskfile/assign_user/<?php echo $file['TskFile']['id'];?>/" class="btn iframeBox cboxElement" val="45_50" rel="tooltip" title="Users"><i class="icon-user"></i></a>
						<a href="<?php echo $this->webroot;?>tskfile/edit_file/<?php echo $file['TskFile']['id'];?>/" class="btn" rel="tooltip" title="Edit"><i class="icon-edit"></i></a>
						
						<a href="javascript:void(0);" name="<?php echo $file['TskFile']['id'];?>" class="btn delRec" rel="tooltip" title="Delete"><i class="icon-remove"></i></a>
						<?php endif; ?>

						</td>
										</tr>
										
									<?php endforeach; ?>
									</tbody>
								</table>
								

								<?php echo $this->element('paging');?>
								
								




								
							</div>	

							</div>
						<input type="hidden" value="1" id="SearchKeywords">
						<input type="hidden" value="<?php echo $this->webroot;?>tskfile/" id="webroot">
						 <?php echo $this->Form->end(); ?>
						</div>
					</div>
				</div>
					
					
				</div>
		
			
			</div>
			

		</div>	
			
		
		
		
		
				
		


