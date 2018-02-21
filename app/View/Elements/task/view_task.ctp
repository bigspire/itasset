<div class="container-fluid" id="content">
		<div id="main" style="padding-bottom:10px">
			<div class="row-fluid" style="width:90%;margin:auto 40px ">
			
			<div class="page-header" style="margin-left:30px;">
					<div class="pull-left">
						<h1>View Task </h1>
						
						
					</div>
				
				
				<div class="pull-right" style="margin-top:20px;">
				<!-- task status change -->
				<?php if($tsk_data[$model_cls]['status'] == 'W' && $tsk_data['TskAssignUser']['is_cc'] != '1' && $this->request->params['controller'] != 'tskteamplan'): ?>
				<a href="<?php echo $this->webroot;?><?php echo $model_url;?>/change_task_status/<?php echo $this->request->params['pass'][0];?>/?type=<?php echo $tsk_data[$model_cls]['type'];?>"  class="iframeBox cboxElement tsk_title" val="50_80"><button type="button" class="btn btn-teal"><i class="icon-edit"></i> Change Status</button></a>
				<?php endif; ?>	
				<!-- task edit -->
				<?php if($tsk_data[$model_cls]['status'] == 'W'  && $this->Functions->check_task_edit($tsk_data[$model_cls]['end'])  && $this->request->params['controller'] != 'tskteamplan' && $this->request->params['controller'] != 'tskassign'): ?>
				<a href="<?php echo $this->webroot;?><?php echo $model_url;?>/edit_task/<?php echo $this->request->params['pass'][0];?>/?<?php echo $URL_VAR;?>&date=<?php echo $this->Functions->get_task_date($tsk_data[$model_cls]['start']);?>" class="edit_tsk_overlay"><button type="button" class="btn btn-primary"><i class="icon-edit"></i> Edit Task</button></a>
				<?php endif; ?>
				
				<!-- close and reopen -->
				<?php 
				if($tsk_data[$model_cls]['status'] == 'E' && $model_cls == 'TskTeamAssign' && $tsk_data['TskAssignStatus']['status'] != 'A'):
					$confirm = 1;
					if(!empty($tsk_data['TskAssignStatus']['created_date'])):			
						if(strtotime($tsk_data[$model_cls]['modified_date']) < strtotime($tsk_data['TskAssignStatus']['created_date'])):
						$confirm = 0;
						endif;
					endif;
				endif;
				?>
				
				<?php 
				if($confirm == 1):?>
				<span style="margin-right:200px;">Confirm Task Status:
				<a class="" href="javascript:void(0);"><button type="button" name="<?php echo $this->webroot;?>tskteamassign/confirm_task/<?php echo $this->request->params['pass'][0];?>/A/" class="btn btn-green approveRec">Close</button></a>										
				<a href="javascript:void(0);"><button type="button" name="<?php echo $this->webroot;?>tskteamassign/confirm_task/<?php echo $this->request->params['pass'][0];?>/R/" class="btn btn-red rejectRec">Reopen</button></a>
				</span>
				<?php endif; ?>
				
				<a href="javascript:void(0);" class="close_colorBox"><button type="button" class="btn"><i class="icon-remove"></i> Close</button></a>
										
				</div>
				
				</div>
				
				
				
					<div class="span12">
					
					
						<?php echo $sess_value = $this->Session->flash();?>
						
						
						<div class="box box-bordered">
							<!--div class="box-title">
								<h3><i class="icon-list"></i> Task Plan - <span style="color:#f4b12f"><?php echo  $this->Functions->format_date($tsk_data[$model_cls]['start']); ?></span>
								</h3>
							</div-->
							
							<div class="nopadding">
			<?php echo $this->Form->create($model_cls, array('id' => 'formID', 'class' => 'form-horizontal form-column form-bordered')); ?>
			
										<table class="table table-hover table-nomargin" style="background:#F8F8F8;margin-bottom:15px;border:1px solid #ddd">
										<thead>
										
										<tr>
										<?php if($model_cls == 'TskTeamPlan'):?>
										<th width="60">Employee</th>
										<?php endif; ?>
										
										<?php if($model_cls == 'TskAssign'):?>
										<th width="80">Assigned By</th>
										<?php endif; ?>
										
										<?php if($model_cls == 'TskTeamPlan' || $model_cls == 'TskAssign'):?>
										<td  width="120"><?php echo  $tsk_data['HrEmployee']['first_name'].' '.$tsk_data['HrEmployee']['last_name'];?></td>									
										<?php endif; ?>
											
										<?php if($tsk_data[$model_cls]['type'] == 'D'):?>
										<th  width="40">Date</th>
										<td  width="100"><?php echo  $this->Functions->format_date($tsk_data[$model_cls]['start']); ?></td>
										<?php endif; ?>
										
										
										<th width="70">Task Type</th>
										<td  width="75"><?php echo  $this->Functions->show_plan_type($tsk_data[$model_cls]['type']);?></td>
										
										<?php if($tsk_data[$model_cls]['type'] == 'P'): ?>
										<th width="60">Company</th>	<td  width="150"><?php echo  $tsk_data['TskCustomer']['company_name'];?></td>
										
										<th  width="60">Project</th><td  width="150"><?php echo  $tsk_data['TskProject']['project_name'];?></td>
										<?php else:?>
											<td width="80"></td>	<td  width="150"></td>
										
										<td  width="80"></td><td  width="150"></td>
										<?php endif; ?>
										
										</tr>
										</thead>
										</table>

					
								<table class="table table-hover table-nomargin" style="background:#F8F8F8;margin-bottom:15px;border:1px solid #ddd">
										<tr><th width="50">Title</th>
										
										<td width="150"> <?php echo $tsk_data[$model_cls]['title'];?>					
										
										</td>
										
										<th width="50">Description</th>										

										<td><span class="desc_less"> <?php echo  $tsk_data[$model_cls]['desc'];?></span></td>
										
										</tr>
										
										</table>
								<div >
										<table class="table table-hover table-nomargin" style="border:1px solid #ddd">
										<thead>
										
										<tr>
										
										
										<th  width="100">Start</th>
										<th  width="100">End</th>
										<th width="150">Type</th>
										<?php if($this->request->params['controller'] == 'tskteamassign' || $this->request->params['controller'] == 'tskassign' ): ?>
										<th width="200">Attachment</th>									
										<?php else:?>
										<th width="200">Expected Outcome</th>
										<?php endif;?>
										<th width="120">Status</th>
										<?php 
										if($model_cls == 'TskAssign' || $model_cls == 'TskTeamAssign'):
										echo $l1_th = "<th width='120'>L1 Status</th>";
										endif;
										?>
										</tr>
										</thead>
										<tbody>
									
										
										<tr>
									
																				
										<td><span><?php echo  $this->Functions->format_tsk_time_show($tsk_data[$model_cls]['start'], $tsk_data[$model_cls]['type']);?></span></td>
										<td><span><?php echo  $this->Functions->format_tsk_time_show($tsk_data[$model_cls]['end'], $tsk_data[$model_cls]['type']);?></span></td>
										<td><span class=" "><?php echo  $tsk_data['TskPlanType']['title'];?></span></td>
										
							<?php if($this->request->params['controller'] == 'tskteamassign' || $this->request->params['controller'] == 'tskassign' ): ?>
									<td>
									<?php if(!empty($tsk_data[$model_cls]['attachment'])) :
									$tskfile =  explode('_', $tsk_data[$model_cls]['attachment']); ?>
									<a  href="<?php echo $this->webroot;?>tskteamassign/download_task_file/<?php echo $tsk_data[$model_cls]['attachment'];?>/" class="btn" rel="tooltip" title="Download (<?php echo $tskfile[1];?>"><i class="icon-download"></i></a>
									<?php else:?>
									--
									<?php endif; ?>
													
									</td>
								<?php else: ?>
								
											<td><span class=" "><?php echo  $tsk_data[$model_cls]['expected_outcome'];?></span></td>
								<?php endif; ?>
											
											
													
													
				<td><span class="label <?php echo $this->Functions->show_task_status_color($tsk_data[$model_cls]['status']);?>"><?php echo $this->Functions->show_task_status($tsk_data[$model_cls]['status']);?></span> 
										<!-- task remarks  -->
				<?php if($tsk_data[$model_cls]['status'] != 'W'):?> 
				<br><i class="icon-comment-alt" style="color:#438eb9"></i> <a href="<?php echo $this->webroot;?><?php echo $model_url;?>/show_comment/<?php echo $this->request->params['pass'][0];?>/<?php echo $tsk_data[$model_cls]['status'];?>/" class="iframeBox cboxElement tsk_title" val="50_60">Comment</a>
				<?php endif; ?>

											</td>
		<?php if($model_cls == 'TskAssign' || $model_cls == 'TskTeamAssign'): ?>

		 <td>
		 <?php if($tsk_data[$model_cls]['status'] != 'W' || !empty($tsk_data['TskAssignStatus']['created_date'])):?>
		 <span class="label <?php echo $this->Functions->show_lead_task_status_color($tsk_data['TskAssignStatus']['status'],$tsk_data[$model_cls]['modified_date'],$tsk_data['TskAssignStatus']['created_date']);?>">
		 <?php echo $this->Functions->show_lead_task_status($tsk_data['TskAssignStatus']['status'],$tsk_data[$model_cls]['modified_date'],$tsk_data['TskAssignStatus']['created_date']);?></span>
		 
		 <?php if($tsk_data['TskAssignStatus']['status'] == 'R' && strtotime($tsk_data['TskAssignStatus']['created_date']) > strtotime($tsk_data[$model_cls]['modified_date'])):?>
		 <br><i class="icon-comment-alt" style="color:#438eb9"></i> <a href="<?php echo $this->webroot;?><?php echo $model_url;?>/show_lead_comment/<?php echo $tsk_data['TskAssignStatus']['id'];?>/" class="iframeBox cboxElement tsk_title" val="50_60">Comment</a>

		 <?php endif; endif; ?>
		 
		 </td>

<?php  endif; ?>
											
										</tr>
										
										
										</tbody></table>
										
										

								</div>		
										
									
									
										</div>
									
										
										</div>
									</div>
									
							<input type="hidden" name="data[<?php echo $model_cls; ?>][date]"  id="date">
							<input type="hidden" name="data[<?php echo $model_cls; ?>][plan_type]" value="<?php echo $tsk_data[$model_cls]['type'];?>" id="type">
							<input type="hidden" name="data[<?php echo $model_cls; ?>][company]" value="<?php echo $this->request->query['company'];?>" id="company">
							<input type="hidden" name="data[<?php echo $model_cls; ?>][project]" value="<?php echo $this->request->query['project'];?>" id="project">
						<input type="hidden" name="data[<?php echo $model_cls; ?>][plan_status]" value="<?php echo $this->request->query['plan_status'];?>" id="plan_status">

									<?php echo $this->Form->end(); ?>
							</div>
			</div>		
			




	<div class="span8" style="float:left">
						<div class="box" style="width:90%">
						<div class="box-title" style="margin:5px 0 0 38px;width:87%">
								<h3>
									<i class="icon-comments"></i>
									Reply Task
								</h3>
							
							</div>
						
									
						
							<ul class="messages tskSubmit" style="margin:0 20px 5px 20px;width:93%">
									<li class="insert"  style="margin-left:20px">
											<div class="text">
												<input type="text"  id="reply_tsk" name="text" placeholder="Reply here..." class="input-block-level tskReply">
											</div>
											<div class="submit">
												<button type="button" id="tskBtn"><i class="icon-share-alt"></i></button>
											</div>
									</li>
									
									</ul>
									<div class="tskLoad" style="margin-left:25px"></div>
									<div class="replyMsg">
							<?php echo $this->element('task/reply_task');?>
							</div>
						
						
						</div>
					</div>
	
	
			<?php if($this->request->params['controller'] == 'tskteamassign' || $this->request->params['controller'] == 'tskassign'):?>
				<div class="span3" style="float:left;margin-top:20px;">
						<table class="table table-hover table-nomargin" style="border:1px solid #ddd">
										<thead style=" width: 100%;">
										
										<tr>
										
										<th width="">Assigned Users</th>
									</tr>
									</thead><tbody style="height:125px; overflow:auto;display:block; width: 100%;">	
									<?php foreach($assign_data as $assign): ?>
										<tr>
										
										<td style="width:250px;"><?php echo $assign['HrEmployee']['first_name'].' '.$assign['HrEmployee']['last_name'];?>
										 <?php echo $this->Functions->check_task_cc($assign['TskAssignUser']['is_cc']);?></th>
									</tr>									
								<?php endforeach; ?>
				</tbody></table>
						
						</div>
				<?php endif; ?>		
						
						
					</div>
	
						<input type="hidden" value="<?php echo $this->webroot;?><?php echo $model_url;?>/" id="webroot"/>
<input type="hidden" value="<?php echo $this->webroot;?>" id="root"/>
	
		

<input type="hidden" value="1" id="myTask"/>
<input type="hidden"  id="viewPlan"/>
			
			<?php //if($tsk_data[$model_cls]['status'] == 'W'):?>
				<input type="hidden" value="1" id="overlayclose"/>
			<?php //endif; ?>
				
				<input type="hidden" value="<?php echo $sess_value ? 1 : 0;?>" id="pageReload">	
				<input type="hidden" value="<?php echo $this->request->params['pass'][0];?>" id="tsk_id"/>
		</div>			
</div>

<div id="dialog-confirm" title="Close Confirmation!" class="dn">
	<p>Are you sure you want to close?</p>
</div>	

<div id="dialog-rej-confirm" title="Reopen Confirmation!" class="dn">
	<p>Are you sure you want to reopen?</p>
		<?php echo $this->Form->input('TskProjectRequest.remarks', array('div'=> false,'type' => 'textarea', 'label' => false, 'class' => 'input-block-level', 'id' => 'remarks', 'required' => false, 'placeholder' => '', 'rows' => '4', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
</div>
