<?php echo $this->element('tsk_menu'); ?>
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>View Files</h1>
					</div>
					
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>tskhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="<?php echo $this->webroot;?>tskfile/">View File</a>
								<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="#">View Files</a>
						</li>
					</ul>
					
				</div>
				
					<div class="row-fluid">
					<div class="span12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3><i class="icon-list"></i> View File</h3>
							</div>
							<div class="box-content nopadding">
								
								
								<?php echo $this->Form->create('TskFile', array('id' => '', 'class' => 'form-horizontal form-column form-bordered')); ?>
								
								
									<div class="span6">
										<div class="control-group">
											<label for="textfield" class="control-label">Title </label>
											<div class="controls">
													<?php echo $tsk_file['TskFile']['title'];?>
													
												
											</div>
										</div>
										
									<div class="control-group">
											<label for="textfield" class="control-label">Description </label>
											<div class="controls">
													<?php echo $tsk_file['TskFile']['desc'];?>
													
												
											</div>
										</div>
										
												<div class="control-group">
											<label for="password" class="control-label">Status <br><br><br><br><br></label>
											<div class="controls">
												<?php echo $this->Functions->show_status($tsk_file['TskFile']['status']);?>
												
												
											</div>
										</div>
										
										
										
										
										
										</div>
										
										<div class="span6">
									
										<div class="control-group">
											<label for="password" class="control-label">Files </label>
											<div class="controls fileScroll" >
												<table class="table table-hover table-nomargin table-condensed">
									<thead>
										<tr>
											<th>File Name</th>
											<th>Size</th>
											
											
										</tr>
									</thead>
									<tbody>
										<?php foreach($file_data as $data):?>
										<tr>
										<td><a href="<?php echo $this->webroot;?>tskfile/file_download/<?php echo $data['TskFileDetail']['id']; ?>"><?php echo $data['TskFileDetail']['attachment']; ?></a></td>
										<td><?php  echo $this->Functions->getFileSize(WWW_ROOT.'uploads/tsk_files/'.$data['TskFileDetail']['attachment']) ?></td>
										
										</tr>
										<?php endforeach; ?>
									</tbody>
									</table>
												
												
											</div>
										</div>
									
										<div class="control-group">
											<label for="textfield" class="control-label">Assigned Users </label>
											<div class="controls fileScroll">
													<table class="table table-hover table-nomargin table-condensed">
								
									<tbody >
										<?php foreach($file_user as $data):?>
										<tr>
										<td><?php echo ucwords($data['HrEmployee']['first_name'].' '.$data['HrEmployee']['last_name']); ?></td>
										
										</tr>
										<?php endforeach; ?>
									</tbody>
									</table>
													
												
											</div>
										</div>
											
										
										
									</div>
									<div class="span12">
										<div class="form-actions">
												<a href="<?php echo $this->webroot;?>tskfile/edit_file/<?php echo $this->request->params['pass'][0];?>/">
											<?php if($this->Session->read('USER.Login.id') == $tsk_file['TskFile']['app_users_id']): ?>	
											<button type="button" class="btn btn-primary"><i class="icon-edit"></i> Edit</button></a>
											<?php endif; ?>
											<a href="<?php echo $this->webroot;?>tskfile/"><button type="button" class="btn"><i class="icon-arrow-left"></i> Go Back</button></a>
											
											
										
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
			
		
	

