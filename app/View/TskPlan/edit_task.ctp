<?php echo $this->element('tsk_menu'); ?>
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Edit Task Plan</h1>
					</div>
					
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>finhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="<?php echo $this->webroot;?>tskplan/">My Tasks</a>
								<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="#">Edit Task Plan</a>
						</li>
					</ul>
					
				</div>
				<?php echo $this->Session->flash();?>
					<div class="row-fluid footer_div">
					
					
					<div class="span12" >
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3><i class="icon-list"></i> Please fill the form to edit your task plan</h3>
							</div>
							<div class="box-content"  style="color:#555;">
									<?php echo $this->Form->create('TskPlan', array('id' => 'expForm', 'class' => 'form-vertical tskPlanForm')); ?>
								
								
							
									<div class="row-fluid">
									
									<div id="flashMessage" class="alert alert-error tskTimeError" style="display:none;"><button type="button" class="close" data-dismiss="alert">×</button>
								Sorry! You cannot create tasks in same time</div>
								
								
										<div class="span2" style="margin-top:10px;margin-left:20px;">
											<div class="control-group">
												<label for="textfield" class="control-label">Task Plan Type <span class="red_star">*</span></label>
												<div class="controls controls-row">
													<?php echo $this->Form->input('type', array('div'=> false,'type' => 'select', 'disabled' => true,  'label' => false,  'class' => 'input-block-level required plan_type_sel', 'required' => false, 'placeholder' => '', 'style' => "clear:left", 'options' => $taskType, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 	
													
													 
												</div>
											</div>
										</div>
										
										
										<div class="span2 dpDiv" style="margin-top:10px;width:100px;">
											<div class="control-group">
												<label for="textfield" class="control-label">Date <span class="red_star">*</span></label>
												<div class="controls controls-row">
													<?php 
													
													echo $this->Form->input('plan_date', array('div'=> false,'type' => 'text',  'readonly' => 'readonly', 'id' => 'plan_date', 'value' => $this->Functions->format_tsk_date($task_data['TskPlan']['start']),  'label' => false, 'class' => 'input-block-level required  input_dp plan_date',  'required' => false, 'placeholder' => '', 'style' => "clear:left",  'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 	
												
													 
												</div>
											</div>
										</div>
										
											<div class="span2 ppDiv" style="margin-top:10px;width:100px;">
											<div class="control-group">
												<label for="textfield" class="control-label">Start Date <span class="red_star">*</span></label>
												<div class="controls controls-row">
													<?php echo $this->Form->input('start_date', array('div'=> false,'type' => 'text', 'rel' => 'plan_start',  'label' => false, 'class' => 'input-block-level proj_date_pick plan_start input_pp', 'value' => $this->Functions->format_tsk_date($task_data['TskPlan']['start']),  'required' => false, 'placeholder' => '', 'style' => "clear:left",  'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 	
													
													 
												</div>
											</div>
										</div>
										<div class="span2 ppDiv" style="margin-top:10px;width:100px;">
											<div class="control-group">
												<label for="textfield" class="control-label">End Date <span class="red_star">*</span></label>
												<div class="controls controls-row">
													<?php echo $this->Form->input('end_date', array('div'=> false,'type' => 'text', 'rel' => 'plan_end', 'label' => false, 'class' => 'input-block-level  proj_date_pick plan_end input_pp', 'value' => $this->Functions->format_tsk_date($task_data['TskPlan']['end']),  'required' => false, 'placeholder' => '', 'style' => "clear:left",  'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												
												</div>
											</div>
										</div>
										
										
										<div class="span3 ppDiv" style="margin-top:10px;">
											<div class="control-group">
												<label for="textfield" class="control-label">Customer <span class="red_star">*</span></label>
												<div class="controls controls-row">
													<?php echo $this->Form->input('tsk_company_id', array('div'=> false,'type' => 'select', 'label' => false, 'class' => 'input-block-level  tskCpny input_pp', 'empty' => 'Select', 'required' => false, 'placeholder' => '', 'style' => "clear:left", 'options' => $compList, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 	
													
													 
												</div>
											</div>
										</div>
										<div class="span2 ppDiv" style="margin-top:10px;">
											<div class="control-group">
												<label for="textfield" class="control-label">Project <span class="red_star">*</span></label>
												<div class="controls controls-row">
													<?php echo $this->Form->input('tsk_projects_id', array('div'=> false,'type' => 'select', 'label' => false, 'class' => 'input-block-level  tskProj input_pp', 'empty' => 'Select', 'required' => false, 'placeholder' => '', 'style' => "clear:left", 'options' => $projList, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												
												</div>
											</div>
										</div>
										
										
									
										
										
									</div>
									
									
									<div class="row-fluid">
									
									
									<div class="row2">
									<div class="span1 dp" style="width:100px;margin-left:20px;clear:left;">
											<div class="control-group">
											
												<label for="textfield" class="control-label"><b>Start</b></label>
										
												<div class="controls controls-row">
													<?php echo $this->Form->input('start', array('div'=> false, 'value' => $this->Functions->show_task_time($task_data['TskPlan']['start'], $task_data['TskPlan']['type'], 'start', 'TskPlan'), 'type' => 'text', 'rel' => 'plan_start', 'label' => false, 'id' => 'start', 'class' => 'input-block-level tsk_timepicker required tsk_time tsk_time_start',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												</div>
											</div>
										</div>
										
										<div class="span1 dp" style="width:100px">
											<div class="control-group">
											
												<label for="textfield" class="control-label"><b>End</b></label>
											
												<div class="controls controls-row">
													<?php echo $this->Form->input('end', array('div'=> false,'value' => $this->Functions->show_task_time($task_data['TskPlan']['end'], $task_data['TskPlan']['type'], 'end', 'TskPlan'), 'type' => 'text','rel' => 'plan_end',  'label' => false, 'id' => 'end', 'class' => 'input-block-level tsk_timepicker required tsk_time tsk_time_end',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												</div>
											</div>
										</div>
									
										<div class="span2">
											<div class="control-group">
											
												<label for="textfield" class="control-label"><b>Task Title</b></label>
											
												<div class="controls controls-row">
													<?php echo $this->Form->input('title', array('div'=> false, 'maxlength' => 100, 'value' => $task_data['TskPlan']['title'],'type' => 'text','id' => 'title', 'label' => false, 'class' => 'input-block-level required', 'empty' => 'Select', 'required' => false, 'placeholder' => '', 'style' => "clear:left", 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											
												</div>
											</div>
										</div>
										<div class="span3">
											<div class="control-group">
											
												<label for="textfield" class="control-label"><b>Description</b></label>
											
												<div class="controls controls-row">
													<?php echo $this->Form->input('desc', array('div'=> false,'type' => 'textarea', 'label' => false, 'rows' => '1', 'value' => $task_data['TskPlan']['desc'], 'id' => 'desc','class' => 'autosize input-block-level required',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												</div>
											</div>
										</div>
										
											<div class="span2">
											<div class="control-group">
											
												<label for="textfield" class="control-label"><b>Expected Outcome</b></label>
										
												<div class="controls controls-row">
													<?php echo $this->Form->input('expected_outcome', array('div'=> false,'type' => 'textarea', 'value' => $task_data['TskPlan']['expected_outcome'], 'label' => false, 'rows' => '1', 'id' => 'outcome','class' => 'input-block-level required autosize',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												</div>
											</div>
										</div>
										
										
										<div class="span2">
											<div class="control-group">
											
												<label for="textfield" class="control-label"><b>Task Type</b></label>
											
												<div class="controls controls-row">
												<?php echo $this->Form->input('tsk_plan_types_id', array('div'=> false,'type' => 'select', 'selected' => $task_data['TskPlan']['tsk_plan_types_id'], 'label' => false, 'id' => 'type', 'class' => 'input-block-level required',  'empty' => 'Select', 'options' => $planType, 'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												</div>
											</div>
										</div>
								
				
						
									</div>
								
								
									
								
									
								<div id="sheepItForm">
								<div  id="sheepItForm_template">
								
				

	
									<div class="row-fluid" style="clear:left;margin-left:0px;" >
									
									<div class="span1 dp" style="width:100px;margin-left:20px;">
											<div class="control-group">
												
												<div class="controls controls-row">
													<?php echo $this->Form->input('start', array('div'=> false, 'rel' => 'plan_start', 'value' => '',  'type' => 'text', 'label' => false, 'name' => "data[TskPlan][start_#index#]", 'class' => 'input-block-level tsk_timepicker required tsk_time tsk_time_start',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												</div>
											</div>
										</div>
										
										<div class="span1 dp" style="width:100px">
											<div class="control-group">
											
												<div class="controls controls-row">
													<?php echo $this->Form->input('end', array('div'=> false,'type' => 'text', 'value' => '', 'rel' => 'plan_end', 'label' => false, 'name' => "data[TskPlan][end_#index#]", 'class' => 'input-block-level tsk_timepicker required tsk_time tsk_time_end',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												</div>
											</div>
										</div>
										
										
								
										<div class="span2">
											<div class="control-group">
											
												<div class="controls controls-row">
													<?php echo $this->Form->input('title', array('div'=> false,'type' => 'text', 'value' => '', 'label' => false, 'id' => 'title_#index#', 'name' => "data[TskPlan][title_#index#]", 'class' => 'required input-block-level',  'required' => false, 'placeholder' => '', 'style' => "clear:left", 'maxlength' => '100', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											
												</div>
											</div>
										</div>
										<div class="span3">
											<div class="control-group">
											
												<div class="controls controls-row">
													<?php echo $this->Form->input('desc', array('div'=> false,'type' => 'text', 'value' => '', 'label' => false, 'id' => 'desc_#index#','name' => "data[TskPlan][desc_#index#]", 'class' => 'input-block-level required autosize',  'required' => false, 'placeholder' => '', 'rows'=> '1',  'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												</div>
											</div>
										</div>
										
												<div class="span2">
											<div class="control-group">
												<div class="controls controls-row">
													<?php echo $this->Form->input('expected_outcome', array('div'=> false,'value' => '', 'type' => 'textarea', 'label' => false, 'rows' => '1', 'id' => '', 'name' => "data[TskPlan][outcome_#index#]",'class' => 'autosize input-block-level required',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												</div>
											</div>
										</div>
										
										<div class="span2">
											<div class="control-group">
												
												<div class="controls controls-row">
												<?php echo $this->Form->input('tsk_plan_types_id', array('div'=> false,'type' => 'select', 'value' => '',  'options' => $planType, 'empty' => 'Select', 'label' => false, 'name' => "data[TskPlan][types_id_#index#]", 'class' => 'input-block-level  required', 'id' => 'type_#index#',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												</div>
											</div>
										</div>
										
										
									
									
						<div class="">
						<a id="sheepItForm_remove_current"  style="cursor:pointer;margin:5px 0px 0px 10px;float:left">
						<img class="delete del_row" rel="tooltip" src="<?php echo $this->webroot;?>img/cross.png" data-original-title="Remove" 
						title="Remove" alt="Remove"	width="16" height="16" border="0"></a></div>
	
								</div>
									

								</div>
							
							 <div id="sheepItForm_noforms_template"></div>

							 
							<!-- Controls -->
							  <div id="sheepItForm_controls" style="clear:left">
							  
								<div id="sheepItForm_add" style="float:right;margin-right:50px;"><button type="submit" id="add" class="btn btn-darkblue"><i class="icon-plus"></i> Add Another Task</button></div>
								
								
							  <!-- /Controls -->

		
								</div>

								
								
		
	
								
									<div  style="margin-left:10px;margin-bottom:15px;margin-left:20px;">
										<div>
									
								
										
										<input type="submit" name="data[TskPlan][save]" class="btn btn-primary tsk_plan_save" value="Save">
											
											<a  href="<?php echo $this->webroot;?>tskplan/?type=<?php echo $this->request->query['type'];?>&date=<?php echo $this->Functions->get_task_date($this->request->data['TskPlan']['start']);?>"><button type="button" class="btn can_btn">Cancel</button></a>
											
										</div>
										
									</div>	
									
										
										
									
										<?php echo $this->Form->input('form_count', array('id'=> 'form_count', 'type' => 'hidden'));?>
								
										<!--input type="hidden" value="<?php echo date('d/m/Y', strtotime('+1 days'));?>" id="start_date"-->
										
									
										<input type="hidden" value="<?php echo $this->Functions->show_task_time($task_data['TskPlan']['start'], $task_data['TskPlan']['type'], 'start');?>" id="start_date">
										
										
										
										<input type="hidden" value="" id="end_date">
						<?php echo $this->Form->input('rec_count', array('id'=> 'rec_count', 'type' => 'hidden', 'value' => $key));?>

									<input type="hidden" value="<?php echo $this->webroot;?>" id="webroot">
									
										<input type="hidden" value="1" id="plan_task">
									<?php echo $this->Form->input('type', array('type' => 'hidden', 'value' => $task_data['TskPlan']['type']));?>		
									<?php echo $this->Form->input('id', array('type' => 'hidden', 'id' => 'rec_id'));?>
									<?php echo $this->Form->input('page', array('type' => 'hidden', 'value' => 'edit', 'id' => 'page'));?>
								<?php echo $this->Form->end(); ?>
										</div>
									</div>
								
								
								
								</form>
							</div>
						</div>
				
				</div>
					
					
				</div>
		
			
			</div>
		</div>	
</div>
