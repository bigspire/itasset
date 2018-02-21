<?php echo $this->element('tsk_menu'); ?>
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Edit File</h1>
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
								<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="#">Edit File</a>
						</li>
					</ul>
					
				</div>
				
				<?php echo $this->Session->flash();?>
				
					<div class="row-fluid footer_div">
					<div class="span12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3><i class="icon-list"></i> Please fill the form to edit files</h3>
							</div>
							<div class="box-content nopadding">
								
								
								<?php echo $this->Form->create('TskFile', array('type' => 'file', 'id' => 'formID', 'class' => 'form-horizontal form-column form-bordered')); ?>
								
								
									<div class="span6">
									
								
										
										
										<div class="control-group">
											<label for="textfield" class="control-label">Title <span class="red_star">*</span></label>
											<div class="controls">
										
													<?php echo $this->Form->input('title', array('div'=> false, 'maxlength' => '100', 'type' => 'text','id' => 'field0', 'label' => false, 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
													<div class="error field0"></div>
											</div>
										</div>
										
										
										
					<div class="control-group">
											<label for="textfield" class="control-label">Description <span class="red_star">*</span></label>
											<div class="controls">
														<?php echo $this->Form->input('desc', array('div'=> false,'type' => 'textarea', 'id' => 'field1', 'rows' => '2', 'label' => false, 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
														<div class="error field1"></div>
											</div>
										</div>
										
										
								
										
								
										
										<div class="control-group">
											<label for="textfield" class="control-label">Assign Users 
												<span class="red_star">*</span>
											
											</label>
											<div class="controls">
					<?php echo $this->Form->input('users', array('div'=> false, 'id' => 'field2', "data-placeholder" => "Select Users" , 'multiple' => 'multiple', 'type' => 'select', 'options' => $empList, 'selected' => $userList,   'label' => false, 'class' => 'chosen-select input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												<div class="error field2"></div>		
												
											</div>
										</div>
										
											<div class="control-group">
											<label for="textfield" class="control-label">Status <span class="red_star">*</span></label>
											<div class="controls">
													<?php echo $this->Form->input('status', array('id' => 'evt_stat', 'div'=> false,'type' => 'select', 'label' => false, 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'style' => "clear:left", 'options' => array('1' => 'Active', '0' => 'Inactive'), 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											</div>
										</div>
										
							</div>
										
									<div class="span6">	
									
										
										<div class="control-group">
											<label for="textfield" class="control-label">Upload Files </label>
											<div class="controls plupload">
									
											</div>
											<div class="error field4" style="margin-left:180px;"></div>
										</div>
										
									
									<div class="fileScroll">
										<table class="table table-hover table-nomargin table-condensed">
									<thead>
										<tr>
											<th>File Name</th>
											<th>Size</th>
											<th class="hidden-350">Action</th>
											
										</tr>
									</thead>
									<tbody>
										<?php foreach($file_data as $data):?>
										<tr>
										<td><a href="<?php echo $this->webroot;?>tskfile/file_download/<?php echo $data['TskFileDetail']['id']; ?>"><?php echo $data['TskFileDetail']['attachment']; ?></a></td>
										<td><?php  echo $this->Functions->getFileSize(WWW_ROOT.'uploads/tsk_files/'.$data['TskFileDetail']['attachment']) ?></td>
										<td>
										<a rel="tooltip" title="<?php echo $this->Functions->get_file_tip($data['TskFileDetail']['status']);?>" href="<?php echo $this->webroot;?>tskfile/file_status/<?php echo $data['TskFileDetail']['status']; ?>/<?php echo $this->request->params['pass'][0];?>/<?php echo $data['TskFileDetail']['id'];?>/<?php echo $this->request->data['TskFile']['app_users_id'];?>" class="<?php echo $this->Functions->get_status_color($data['TskFileDetail']['status']);?>"><?php echo $this->Functions->get_file_status($data['TskFileDetail']['status']);?></a>
										| 
										<a rel="tooltip" title="Remove file permanently" href="<?php echo $this->webroot;?>tskfile/remove_file/<?php echo $this->request->params['pass'][0];?>/<?php echo $data['TskFileDetail']['id'];?>/<?php echo $this->request->data['TskFile']['app_users_id'];?>/" name="<?php echo $data['TskFileDetail']['id'];?>" class="red file_remove">Remove</a></td>
										</tr>
										<?php endforeach; ?>
									</tbody>
									</table>
									
									</div>
								
									</div>


										
										
									<div class="span12">
										<div class="form-actions">
											<input type="submit" value="Save changes" class="btn btn-primary tsk_add_file">
											<a href="<?php echo $this->webroot;?>tskfile/"><button type="button" class="btn can_btn">Cancel</button></a>
										</div>
									</div>
									<input type="hidden" value="" id="file_upload">
									<input type="hidden" value="1" id="edit_file">
									<input type="hidden" value="<?php echo $this->webroot;?>" id="root">
									<?php echo $this->Form->input('id', array('type' => 'hidden'));?>
									
									<input type="hidden" id="del_url" value="<?php echo $this->webroot;?>tskfile/remove_file/"/>
									
								<?php echo $this->Form->end(); ?>
							</div>
						</div>
					</div>
				</div>
					
					
				</div>
		
			
			</div>
		</div>	
			
<div id="dialog-confirm" title="Confirmation!" class="dn">
	<p>Are you sure you want to delete?</p>
</div>	
