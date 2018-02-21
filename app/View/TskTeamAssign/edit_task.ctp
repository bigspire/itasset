<?php echo $this->element('tsk_menu'); ?>
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Edit Task</h1>
					</div>
					
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>finhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="<?php echo $this->webroot;?>tskteamassign/">Assigned By Me</a>
								<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="#">Edit Task</a>
						</li>
					</ul>
					
				</div>
				
					<div class="row-fluid footer_div">
					
					
					<div class="span12">
						<div class="box box-color box-bordered" >
							<div class="box-title">
								<h3><i class="icon-list"></i> Please fill the form to edit the task</h3>
							</div>
							<div class="box-content nopadding">
								
								
								<?php echo $this->Form->create('TskTeamAssign', array('type' => 'file', 'id' => 'expForm', 'class' => 'tskPlanForm form-horizontal form-column form-bordered')); ?>
								
								
									<div class="span6">
									
									
											<div class="control-group">
												<label for="textfield" class="control-label">Task Type <span class="red_star">*</span></label>
												<div class="controls">
													<?php echo $this->Form->input('type', array('div'=> false,'type' => 'select','id' => 'plan_type',  'label' => false,  'class' => 'input-xlarge required plan_type_sel', 'required' => false, 'placeholder' => '', 'style' => "clear:left", 'options' => $taskType, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 	
													
													 
												</div>
											</div>
											
															
									


										<div class="control-group">
											<label for="textfield" class="control-label">Title <span class="red_star">*</span></label>
											<div class="controls">
													<?php echo $this->Form->input('title', array('div'=> false,'type' => 'text','id' => 'title', 'label' => false, 'class' => 'required input-xlarge',  'required' => false, 'placeholder' => '', 'maxlength' => '100', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
													<div class="error title"></div>
											</div>
										</div>
										
											<div class="control-group">
											<label for="password" class="control-label">Description <span class="red_star">*</span></label>
											<div class="controls">
													<?php echo $this->Form->input('desc', array('div'=> false,'id' => 'desc', 'type' => 'textarea', 'label' => false, 'class' => 'required input-xlarge',  'required' => false, 'placeholder' => '', 'rows' => '4', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
													<div class="error desc"></div>
											</div>
										</div>
										
										<div class="control-group" style="border-bottom:none" >
											<label for="password" class="control-label">Attach File (If any) </label>
											<div class="controls">
													<?php echo $this->Form->input('upload_file', array('div'=> false,'type' => 'file', 'label' => false, 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
													<?php if(!empty($this->request->data['TskTeamAssign']['attachment'])) :
													$tskfile =  explode('_', $this->request->data['TskTeamAssign']['attachment']); ?>
													<a  href="<?php echo $this->webroot;?>tskteamassign/download_task_file/<?php echo $this->request->data['TskTeamAssign']['attachment'];?>/" class="btn btn-pink" rel="tooltip" title="Download File"><?php echo $tskfile[1];?></a>
													<?php endif; ?>
											</div>
										</div>	
									
									<div class="control-group ppDiv" style="border-top:1px solid #ddd" >
												<label for="textfield" class="control-label">Customer <span class="red_star">*</span> <br></label>
												<div class="controls">
													<?php echo $this->Form->input('tsk_company_id', array('div'=> false,'type' => 'select', 'id' => 'company', 'label' => false, 'class' => 'input-xlarge   tskCpny input_pp', 'empty' => 'Select', 'required' => false, 'placeholder' => '', 'style' => "clear:left", 'options' => $compList, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 	
												<div class="error company"></div>		

													 
												</div>
											</div>	
										
										
									</div>
									<div class="span6">
									
										<div class="control-group dpDiv">
											<label for="password" class="control-label">Date <span class="red_star">*</span></label>
											<div class="controls">
								<?php echo $this->Form->input('plan_date', array('div'=> false,'type' => 'text', 'rel' => 'plan_start', 'label' => false, 'id' => 'plandate', 'class' => 'input-xlarge required proj_date_pick',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?>  
					<div class="error plandate"></div>

											</div>
										</div>								
										
										<div class="control-group dpDiv">
											<label for="password" class="control-label">Start  / End <span class="red_star">*</span></label>
											<div class="controls">
										<?php echo $this->Form->input('start_time', array('div'=> false,'type' => 'text', 'rel' => 'plan_start', 'label' => false, 'id' => 'endtime', 'class' => 'input-small tsk_timepicker required tsk_time tsk_time_start',  'required' => false, 'style' => 'width:120px', 'placeholder' => 'Start Time', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?>  
	
										<?php echo $this->Form->input('end_time', array('div'=> false,'type' => 'text','rel' => 'plan_end',  'label' => false, 'id' => 'starttime', 'class' => 'input-small tsk_timepicker required tsk_time tsk_time_end',  'required' => false, 'placeholder' => 'End Time',  'style' => 'width:120px', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?>  
								<div class="error starttime endtime"></div>
											</div>
										</div>
										
										<div class="control-group ppDiv">
											<label for="password" class="control-label">Start Date <span class="red_star">*</span></label>
											<div class="controls">
								<?php echo $this->Form->input('start_date', array('div'=> false,'type' => 'text', 'rel' => 'plan_start', 'label' => false, 'id' => 'startdate', 'class' => 'input-xlarge required proj_date_pick',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?>  
					<div class="error startdate"></div>

											</div>
										</div>								
										
										<div class="control-group ppDiv">
											<label for="password" class="control-label">End Date <span class="red_star">*</span></label>
											<div class="controls">
	
										<?php echo $this->Form->input('end_date', array('div'=> false,'type' => 'text','rel' => 'plan_end',  'label' => false, 'id' => 'enddate', 'class' => 'input-xlarge required proj_date_pick',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?>  
	<div class="error enddate"></div>
											</div>
										</div>
										
										
								
									<div class="control-group">
											<label for="password" class="control-label">Type <span class="red_star">*</span></label>
											<div class="controls">
												<?php echo $this->Form->input('tsk_plan_types_id', array('div'=> false,'type' => 'select','label' => false, 'id' => 'task_type',
												'class' => 'input-xlarge required',   'empty' => 'Select', 'options' => $planType, 
												'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												<div class="error task_type"></div>
											</div>
										</div>
										
										
										
	<div class="control-group">
											<label for="textfield" class="control-label">Assign User 
												<span class="red_star">*</span>
												<?php if($this->request->query['type'] == 'P'):?>
											<a href="javascript:void(0);" rel="tooltip" title="Choose the project before assigning user"><span  class="badge badge-grey">?</span></a>
											<?php endif; ?>
											
											</label>
											<div class="controls">
					<?php echo $this->Form->input('users', array('div'=> false, "data-placeholder" => "Select Users", 'empty' => 'Select',  'type' => 'select', 'selected' => $users, 'options' => $empList,  'label' => false, 'class' => 'chosen-select input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												<div class="error assign_user"></div>		
												
											</div>
										</div>
										
									
											<div class="control-group">
											<label for="textfield" class="control-label">Keep in Cc 
											
											
											</label>
											<div class="controls">
					<?php echo $this->Form->input('cc_user', array('div'=> false, 'id' => 'company', "data-placeholder" => "Select Users" , 'multiple' => 'multiple', 'type' => 'select', 'selected' => $cc, 'options' => $empCcList,  'label' => false, 'class' => 'chosen-select input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												
											</div>
										</div>	

										
<div class="control-group ppDiv">
												<label for="textfield" class="control-label">Project <span class="red_star">*</span></label>
												<div class="controls">
													<?php echo $this->Form->input('tsk_projects_id', array('div'=> false, 'id' => 'project', 'type' => 'select', 'label' => false, 'class' => 'input-xlarge tskProj input_pp', 'empty' => 'Select', 'required' => false, 'placeholder' => '', 'style' => "clear:left", 'options' => $projList, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
														<div class="error project"></div>
													 
												</div>
											</div>								
										
										</div>
									<div class="span12">
										<div class="form-actions">
											<input type="submit" class="btn btn-primary save_assign" value="Save changes">
											<a href="<?php echo $this->webroot;?>tskteamassign/?<?php echo $URL_VAR;?>&date=<?php echo $this->Functions->get_task_date($this->request->data['TskTeamAssign']['start']);?>"><button type="button" class="btn can_btn">Cancel</button></a>
										</div>
									</div>
									<?php echo $this->Form->input('TskTeamAssign.id', array('type' => 'hidden'));?>
									<input type="hidden" value="<?php echo date('d/m/Y');?>" id="start_date">
									<input type="hidden" value="<?php echo $this->webroot;?>" id="webroot">

								<?php echo $this->Form->end(); ?>
							</div>
						</div>
					</div>
				
				
				</div>
					
					
				</div>
		
			
			</div>
		</div>	
			
	
