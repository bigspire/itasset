	<div class="" id="change_status" >
	<div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header"><h5>Change Status </h5>
        </div><div class="container"></div>
        <div class="modal-body" style="max-height:none;padding:10px;">
        	<?php if($save_success != '1'):?>
		<?php echo $this->Form->create($model_cls, array('id' => 'formID', 'class' => 'form-horizontal form-column form-bordered')); ?>
								
								<?php echo $ses_value = $this->Session->flash();?>	
						
					
										<div class="span12">
										<div class="control-group">
											<label for="textfield" class="control-label">Task Title </label>
											<div class="controls controls-row">
												<?php echo $tsk_data[$model_cls]['title'];?>
												</div>
										</div>	
										
								
								
									<?php if($page_reload == '' && $tsk_data[$model_cls]['status'] == 'W'):?>
										<div class="control-group">
											<label for="textfield" class="control-label">Status <span class="red_star">*</span></label>
											<div class="controls controls-row">
												<?php echo $this->Form->input('status', array('div'=> false, 'id' => 'statusChk', 'type' => 'select', 'options' => $planStatus, 'empty' => 'Select', 'label' => false, 'class' => 'required chgTskStatus',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												<div class="error statusChk"></div>

												</div>
										</div>
										
								<?php								
								if($model_cls == 'TskPlan'):
								$url = 'tskplan/?company='.$tsk_data[$model_cls]['tsk_company_id'].'&project='.$tsk_data[$model_cls]['tsk_projects_id'].'&type='.$this->request->query['type'];
								else:
								$url = 'tskteamassign/?company='.$tsk_data[$model_cls]['tsk_company_id'].'&project='.$tsk_data[$model_cls]['tsk_projects_id'].'&emp_id='.$assign_data['TskAssignUser']['app_users_id'].'&type='.$this->request->query['type'];
								endif;
								?>
								
								
										<div class="control-group dn remainingBox">
											<label for="textfield" class="control-label">Remaining task will be completed on <span class="red_star">*</span></label>
											<div class="controls">
													
													<?php if($this->request->query['type'] == 'D') :	
													echo $this->Form->input('task_remaining', array('div'=> false, 'id' => 'remainChk', 'style' => 'width:120px', 'type' => 'text', 'label' => false,  'class' => 'input-medium datepick_tsk',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); 
													$width = '75px';
													else: 
													$width = '145px';
													endif;
													?>
													<?php echo $this->Form->input('remain_from', array('div'=> false,'id' => 'start_time', 'type' => 'text','style' => 'width:'.$width,  'label' => false,  'class' => 'status_time input-small tsk_timepicker tsk_time',  'required' => false, 'placeholder' => 'Start', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
													
													<?php echo $this->Form->input('remain_end', array('div'=> false,'id' => 'end_time', 'type' => 'text','style' => 'width:'.$width,  'label' => false,  'class' => 'status_time input-small tsk_timepicker tsk_time',  'required' => false, 'placeholder' => 'End', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
													<br>								
								<a href="<?php echo $this->webroot;?><?php echo $url;?>" target="_blank">Show Task Calendar</a>
												<div class="error remainChk"></div>
											</div>
										</div>
								
										
											<div class="control-group dn postponeBox">
											<label for="textfield" class="control-label">Task Postponed To <span class="red_star">*</span>
											</label>
											
											<div class="controls">
								<?php if($this->request->query['type'] == 'D') :?>		
								<?php echo $this->Form->input('postpone_date', array('div'=> false, 'id' => 'postChk', 'type' => 'text',  'style' => 'width:120px','label' => false,  'class' => 'input-xlarge datepick_tsk',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
								<?php endif; ?>
								
								<?php echo $this->Form->input('post_from', array('div'=> false, 'id' => 'post_start', 'type' => 'text','style' => 'width:'.$width,  'label' => false,  'class' => 'status_time input-small tsk_timepicker tsk_time',  'required' => false, 'placeholder' => 'Start', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
								<?php echo $this->Form->input('post_end', array('div'=> false, 'id' => 'post_end', 'type' => 'text','style' => 'width:'.$width,  'label' => false,  'class' => 'status_time input-small tsk_timepicker tsk_time',  'required' => false, 'placeholder' => 'End', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
								<br>								
								<a href="<?php echo $this->webroot;?><?php echo $url;?>" target="_blank">Show Task Calendar</a>
									
												<div class="error postChk"></div>
											</div>
										</div>
										
										
											<div class="control-group dn commentBox">
											<label for="textfield" class="control-label">Comment <span class="red_star">*</span> </label>
											<div class="controls">
											
													<?php echo $this->Form->input('comment', array('div'=> false,'type' => 'textarea', 'id' => 'commentChk', 'rows' => '2','label' => false,  'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
													<div class="error commentChk"></div>
											</div>
										</div>
									<div class="control-group dn reasonBox">
											<label for="textfield" class="control-label">Reason <span class="red_star">*</span> </label>
											<div class="controls">
											
													<?php echo $this->Form->input('reason', array('div'=> false,'type' => 'textarea','id' => 'reasonChk', 'rows' => '2','label' => false,  'class' => 'input-xlarge reasonTxt',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
													<div class="error reasonChk"></div>
											</div>
										</div>
									<?php else: ?>
									
										<div class="control-group">
											<label for="textfield" class="control-label">Status </label>
											<div class="controls controls-row">
												<span class="label <?php echo $this->Functions->show_task_status_color($this->request->data[$model_cls]['status']);?>"><?php echo $this->Functions->show_task_status($this->request->data[$model_cls]['status']);?></span>
												
												</div>
										</div>
								
									
									<?php if($this->request->data[$model_cls]['status'] == 'P'):
									$label = 'Task Postponed To';
									elseif($this->request->data[$model_cls]['status'] == 'L'):
									$label = 'Remaining task will be completed on';
									endif;
									?>
									
									<?php if($label):?>
										<div class="control-group">
											<label for="textfield" class="control-label">Task Postponed To </label>
											<div class="controls">
											<?php if($this->request->data[$model_cls]['type'] == 'P'):?>
											Start Date: <?php echo $this->Functions->format_tsk_time_show($this->request->data[$model_cls]['start'], 'P');?>, 
											End Date: <?php echo $this->Functions->format_tsk_time_show($this->request->data[$model_cls]['end'], 'P');?>
											<?php else:?>
											<?php echo $this->Functions->format_date($this->request->data[$model_cls]['start']);?> (
											<?php echo $this->Functions->format_tsk_time_show($this->request->data[$model_cls]['start'], 'D');?> To
											<?php echo $this->Functions->format_tsk_time_show($this->request->data[$model_cls]['end'], 'D');?>)
											<?php endif; ?>
											
												
											</div>
										</div>
											<?php endif; ?>
											
											
									
									<?php if($this->request->data[$model_cls]['status'] == 'C' || $this->request->data[$model_cls]['status'] == 'P'):
									$comment_f = 'Reason';
									$comment_d = 'reason';
									else:
									$comment_f = 'Comment';
									$comment_d = 'comment';
									endif; 
									?>
									
									
									
									<div class="control-group">
											<label for="textfield" class="control-label"><?php echo $comment_f;?> </label>
											<div class="controls">
											<?php echo $this->request->data[$model_cls][$comment_d];?>
												
											</div>
										</div>
									
								
									
								
										
										<div class="span12">
										<div class="form-actions">
										
		<a href="javascript:void(0);" class="close_colorBox"><button type="button" class="btn"><i class="icon-remove"></i> Close </button></a>

									</div>
									</div>
									
									
									<?php endif; ?>
	
										
									</div>
									
					
									
								



								
									<?php if($page_reload == '' &&  $tsk_data[$model_cls]['status'] == 'W'):?>
									<div class="span12">
										<div class="form-actions">
										
				<input type="submit" name="data[<?php echo $model_cls; ?>][save]" class="btn btn-primary edit_task_status" value="Submit">
		<!--input type="button" class="btn btn-primary update_tsk_status" value="Submit"-->
		<a href="javascript:void(0);" class="close_colorBox"><button type="button" class="btn can_btn"><i class="icon-remove"></i> Cancel</button></a>

									
										</div>
									</div>								
									<?php endif; ?>
									
									<?php 
									echo $this->Form->input('id', array('type' => 'hidden', 'value' => $tsk_data[$model_cls]['id']));?>
									<input type="hidden" value="<?php echo date('d/m/Y', strtotime($this->Functions->format_date_time_show($tsk_data['TskPlan']['start']).  '+1 days'));?>" id="start_date">
							
							<input type="hidden" name="data[<?php echo $model_cls; ?>][date]"  id="date">
							<input type="hidden" name="data[<?php echo $model_cls; ?>][plan_type]" value="<?php echo $this->request->query['type'];?>" id="type">
							<input type="hidden" name="data[<?php echo $model_cls; ?>][company]" value="<?php echo $this->request->query['company'];?>" id="company">
							<input type="hidden" name="data[<?php echo $model_cls; ?>][project]" value="<?php echo $this->request->query['project'];?>" id="project">
							<input type="hidden" name="data[<?php echo $model_cls; ?>][plan_status]" value="<?php echo $this->request->query['plan_status'];?>" id="plan_status">

							<input type="hidden" id="page" value="chg_status"/> 
							
				<input type="hidden" value="<?php echo $this->Functions->get_numeric_date($this->request->data[$model_cls]['start']);?>" id="tsk_moved_date">
							
							<input type="hidden" value="<?php echo $this->request->data[$model_cls]['status'];?>" id="tskSt">
									<input type="hidden" value="1" id="changeSt">	
								<input type="hidden" value="<?php echo $page_reload?>" id="pageReload">		
									</form>
        	<?php else: ?>		
			Processing.. pls wait..
			<?php endif; ?>
       										

       
      </div>
    </div>
</div>

</div>
