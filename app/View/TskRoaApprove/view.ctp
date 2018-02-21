<style>
.form-horizontal.form-bordered .control-group .control-label{
padding:10px 10px 0px 10px;
}
.ui-dialog-title{color:#ffffff}
</style>	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>View ROA</h1>
					</div>
					<div class="pull-right" style="margin-top:20px;">
					
				<?php $stars = explode(',', $roa_data[0]['star_type']);
				
				if($roa_data['TskRoaApprove']['is_approve'] == 'Y'  && !in_array('M', $stars)): ?>				
				<button name="<?php echo $this->webroot;?>tskroaapprove/change_status/<?php echo $this->request->params['pass'][0];?>/M/<?php echo $this->request->params['pass'][2];?>/<?php echo $this->request->params['pass'][1];?>" type="button" class="btn btn-teal confirmRec" title="Star of Month"><i class="icon-edit"></i> Star of Month</button>
				<?php endif; ?>	
				
				
				<?php 
				if(in_array('M', $stars) && !in_array('Q', $stars)):?>
				<button  name="<?php echo $this->webroot;?>tskroaapprove/change_status/<?php echo $this->request->params['pass'][0];?>/Q/<?php echo $this->request->params['pass'][2];?>/<?php echo $this->request->params['pass'][1];?>" type="button" class="btn btn-green confirmRec" title="Star of Quarter"><i class="icon-edit"></i> Star of Quarter</button>
				<?php endif; ?>
				
				<?php if(in_array('Q', $stars)  && !in_array('C', $stars)):?>				
				<button  name="<?php echo $this->webroot;?>tskroaapprove/change_status/<?php echo $this->request->params['pass'][0];?>/C/<?php echo $this->request->params['pass'][2];?>/<?php echo $this->request->params['pass'][1];?>" type="button" class="btn btn-orange confirmRec" title="Champion of CareerTree"><i class="icon-edit"></i> Champion of CareerTree</button></a>
				<?php endif; ?>
				
				
				<?php if($this->request->query['refresh'] == 1):?>
				<a href="javascript:void(0);"><button type="button" class="btn tktReload"><< Go Back</button></a>
				<?php else: ?>				
				<a href="javascript:void(0);" class="close_colorBox"  rel="<?php echo $roa_data['TskRoaApprove']['id'];?>"><button type="button" class="btn"><i class="icon-remove"></i> Close</button></a>
				<?php endif; ?>
										
				</div>
				</div>
				
				<?php echo $this->Session->flash();?>
				
					<div class="row-fluid">
					<div class="span12">
						<div class="box box-bordered" style="border-top:1px solid #cccccc">
							
							<div class="box-content nopadding">
								
								
								<?php echo $this->Form->create('TskRoaApprove', array('id' => 'formID', 'class' => 'form-horizontal form-column form-bordered')); ?>
								
								
									<div class="span6">
									<div class="control-group">
											<label for="textfield" class="control-label" style="">Recognition Month </label>
											<div class="controls">
												<?php echo $this->Functions->format_month($roa_data['TskRoaApprove']['reward_month']);?>
											</div>
										</div>
									
										
										<div class="control-group">
											<label for="textfield" class="control-label">Employee Name (s) </label>
											<div class="controls">
													<?php 
													$bus_unit = explode(',', $roa_data[0]['bus_unit']);
													$roa_member = explode(',', $roa_data[0]['roa_member']);
													$dept = explode(',', $roa_data[0]['dept']);
													$branch = explode(',', $roa_data[0]['branch']);
													$emp = explode(',', $roa_data[0]['emp_id']);
													foreach($roa_member as  $key => $member):
													if($roa_data['TskRoaApprove']['type'] == 'T'):?>
													<input type="checkbox" class="teamSel" name="team_member[]" style="margin-bottom:6px;" value="<?php echo $emp[$key] ?>"/>   
													<?php else: ?>
													<input type="hidden" class="teamSel" checked="checked" name="team_member[]" value="<?php echo $emp[$key] ?>"/>   													
													<?php endif;
													echo '<b>'.$member.'</b>'. ', '.$bus_unit[$key]. ', '.$dept[$key]. ', '.$branch[$key]."<br>";
													endforeach;
													?>
										<input type="hidden" name="reward_month" value="<?php echo $roa_data['TskRoaApprove']['reward_month']?>"/>   													
	
												
											</div>
										</div>
										
											<div class="control-group">
											<label for="password" class="control-label">Your Rating</label>
											<div class="controls">
												<?php echo $this->Functions->show_roa_rating($roa_data['TskRoaApprove']['rating']);?>
												
												
											</div>
										</div>
										
<div class="control-group">
											<label for="password" class="control-label">Describe in details </label>
											<div class="controls">
											<?php echo $roa_data['TskRoaApprove']['emp_acts'];?>
												
												
											</div>
										</div>
										
											<div class="control-group">
											<label for="password" class="control-label">Star? </label>
											<div class="controls">
												<?php 
										if($roa_data[0]['star_type'] != ''):
											$type_exp = explode(',' ,  $roa_data[0]['star_type']);
											foreach($type_exp as $val):		
										?>
											<span class="label label-<?php echo $this->Functions->get_star_color($val);?>" style="margin-left:10px;margin-top:10px;"><?php echo $this->Functions->get_star_msg($val);?></span>
											<?php endforeach;endif; ?>
												
												
											</div>
										</div>
									
									
										
									</div>
									<div class="span6">
										<div class="control-group">
											<label for="textfield" class="control-label">Individual or Team? </label>
											<div class="controls">
													<?php echo $this->Functions->get_roa_type($roa_data['TskRoaApprove']['type']);?>
													
											<input type="hidden" id="teamRecog" value="<?php echo $roa_data['TskRoaApprove']['type'];?>"/>	
											</div>
										</div>
										
										<div class="control-group">
											<label for="password" class="control-label">Recommend For </label>
											<div class="controls">
												<?php echo $roa_data[0]['roa_category'];?>
											</div>
										</div>
									
									<div class="control-group">
											<label for="password" class="control-label">Business performance</label>
											<div class="controls">
												
												<?php echo $roa_data['TskRoaApprove']['emp_relate'];?>
											</div>
										</div>
											
									<div class="control-group">
											<label for="password" class="control-label">Attach any document</label>
											<div class="controls">
													<?php if(!empty($roa_data['TskRoaApprove']['attachment'])):?>
												<a href="<?php echo $this->webroot;?>tskroa/download_attachment/<?php echo $roa_data['TskRoaApprove']['attachment'];?>/" class="btn btn-pink" rel="tooltip" title="Download"><?php echo $roa_data['TskRoaApprove']['attachment'];?></a>
												<?php else:?>
												No File Attached
												<?php endif; ?>
												
												
											</div>
										</div>
									<div class="control-group">
											<label for="password" class="control-label">Created By / On</label>
											<div class="controls">
												
												<?php echo $roa_data['Employee']['first_name'];?>, <?php echo $this->Functions->format_date($roa_data['TskRoaApprove']['created_date']);?>
											</div>
										</div>
								
									</div>
									
									<div class="span12">
										<div class="form-actions">
										<?php if($VIEW_ONLY == 1 && $this->request->query['refresh'] == 1):?>
												<a href="javascript:void(0);"><button type="button" class="btn tktReload"><< Go Back</button></a>										
										<?php elseif($VIEW_ONLY == 1):?>
												<!--a href="javascript:void(0);" class="close_colorBox"><button type="button" class="btn">Close</button></a-->										
										<?php elseif($VIEW_ONLY != 1): ?>
										<a class="" href="javascript:void(0);">
											<button type="button" name="<?php echo $this->webroot;?>tskroaapprove/process_req/<?php echo $this->request->params['pass'][0];?>/<?php echo $this->request->params['pass'][1];?>/A/<?php echo $this->request->params['pass'][2];?>/" class="btn btn-green approveRec">Approve</button></a>
											
											
											<a href="javascript:void(0);">
											<button type="button" name="<?php echo $this->webroot;?>tskroaapprove/process_req/<?php echo $this->request->params['pass'][0];?>/<?php echo $this->request->params['pass'][1];?>/R/<?php echo $this->request->params['pass'][2];?>/" class="btn btn-red rejectRec">Reject</button></a>
											
											<a href="javascript:void(0)" class="close_colorBox" rel="<?php echo $roa_data['TskRoaApprove']['id'];?>" ><button type="button" class="btn">Cancel</button></a>
											
										<?php endif; ?>
										
										</div>
									</div>
									<input type="hidden" id="view_roa"/>
								<?php echo $this->Form->end(); ?>
							</div>
						</div>
					</div>
				
				
				
				
				
				</div>
					
					
				</div>
		
			
			</div>
		
		<div class="span8" style="float:left">
						<div class="box" >
						<div class="box-title" style="">
								<h3>
									<i class="icon-comments"></i>
									Reply
								</h3>
							
							</div>
						
									
						
							<ul class="messages tskSubmit" style="margin-left:0">
									<li class="insert">
											<div class="text" style="margin-right:0">
												<input type="text"  id="reply_roa" name="text" placeholder="Reply here..." class="input-block-level tskReply">
											</div>
											
									</li>
									
									</ul>
									<div class="tskLoad" style="margin-left:25px"></div>
									<div class="replyMsg   scrollable" data-height="150" data-start="top" data-visible="true" >
							<?php echo $this->element('reply_roa');?>
							


							</div>
						
						
						</div>
					</div>
					
					
					<input type="hidden" value="<?php echo $this->webroot;?>" id="root"/>
							<input type="hidden" value="<?php echo $this->webroot;?>tskroaapprove/" id="webroot"/>
							<input type="hidden" value="<?php echo $this->request->params['pass'][0];?>" id="tsk_id"/>
		
		</div>	
			
<div id="dialog-confirm-rec" title="Approve Confirmation!" class="dn">
	<p>Are you sure?</p>
</div>	
		
<div id="dialog-confirm" title="Approve Confirmation!" class="dn">
	<p>Are you sure you want to approve?</p>
</div>	

<div id="dialog-rej-confirm" title="Reject Confirmation!" class="dn">
	<p>Are you sure you want to reject?</p>
		<?php echo $this->Form->input('TskApplauseStatus.remarks', array('div'=> false,'type' => 'textarea', 'label' => false, 'class' => 'input-block-level', 'id' => 'remarks', 'required' => false, 'placeholder' => '', 'rows' => '4', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
</div>

