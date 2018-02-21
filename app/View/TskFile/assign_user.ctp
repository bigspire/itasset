	
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
			
			
				
				
				
				<?php echo $this->Session->flash();?>
				
					<div class="row-fluid " >
					<div class="span12">
						<div class="box  box-color">
						
						<div class="box-title">
								<h3 style="color:#444"><i class="icon-user"></i> Assigned Users :: <?php echo ucwords($tsk_data['TskFile']['title']);?></h3>
							</div>
							
						

						<?php echo $this->Form->create('TskFile', array('name' => '', 'type' => '', 'id' => 'formID', 'class' => '')); ?>
							<div class="box-content">
							
						<div class="dataTables_wrapper">
						
							
								
								


								<table class="table table-hover table-nomargin table-bordered usertable dataTable table-condensed">
									<thead>
										
										<tr>
											
											<th width="45">
											S.No
												</th>
												
												
				<th>
											Name
												</th>							
										
												
												
											
											
												
											
											<th>Remove</th>
										</tr>
									</thead>
									<tbody>
									
										
									
										<?php  foreach($file_user as $key => $user):?>
										
										<tr>
											<td><?php echo ++$key;?></td>
											<td><?php echo $user['HrEmployee']['first_name'].' '.$user['HrEmployee']['last_name'];?></td>
											
											
										
											
											<td class='hidden-480'>
											
			<a href="<?php echo $this->webroot?>tskfile/delete_user/<?php echo $tsk_data['TskFile']['id'];?>/<?php echo $user['HrEmployee']['id'];?>" class="btn delRec" rel="tooltip" title="Delete"><i class="icon-remove"></i></a>
											</td>
										</tr>
										
									<?php endforeach; ?>
									
									
									</tbody>
								</table>
							</div>	

							</div>
						<input type="hidden" value="<?php echo $this->webroot;?>tskfile/" id="webroot">
						 <?php echo $this->Form->end(); ?>
						</div>
					</div>
				</div>
					
					
				</div>
		
			
			</div>
			

		</div>	
			
		
		
		
		
				
		


