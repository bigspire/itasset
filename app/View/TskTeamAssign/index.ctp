<?php echo $this->element('tsk_menu'); ?>
		
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left" style="height:15px">
					
						
					</div>
				
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>tskhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						
						
						<li>
							<a href="<?php echo $this->webroot;?>tskteamassign/">Assigned by Me</a>
							<i class="icon-angle-right"></i>
						</li>
						
						<li>
						<a href="#"><?php echo $this->Functions->show_plan_type($this->request->query['type']);?> </a>
						</li>
						
					</ul>
					
				</div>
				
				
				
				<?php echo $this->Session->flash();?>
				
					<div class="row-fluid footer_div">
					<div class="span12">
						<div class="box" style="margin-top:15px;">
						
					
						

						<?php echo $this->Form->create('TskTeamAssign', array('name' => '', 'type' => '', 'id' => 'formID', 'class' => '')); ?>
							<div class="">
							
						<div class="">
						
				<div class="" id="DataTables_Table_8_filter"  style="border-bottom:1px solid #efefef;">
			
					<?php //echo $this->Form->input('type', array('div'=> false, 'type' => 'select','label' => false, 'class' => 'input-medium srch_tsk_type', 'id' => 'type', 'selected' => $this->params->query['type'] ,  'required' => false, 'placeholder' => '', 'style' => "clear:left;font-weight:bold;", 'options' => $taskType, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
<span style="font-weight:bold;"><b>Search: </b></span>
				
							<?php echo $this->Form->input('company', array('div'=> false,'type' => 'select', 
				'selected' => $this->params->query['company'], 'id'=> 'company',  'label' => false, 'class' => 'tskCpny input-large dn',
				'empty' => 'Choose Company', 'required' => false, 'placeholder' => '', 'style' => "clear:left", 
				'options' => $compList, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
				
					<?php echo $this->Form->input('project', array('div'=> false,'type' => 'select', 
				'selected' => $this->params->query['project'], 'id'=> 'project',  'label' => false, 'class' => 'input-medium tskProj dn',
				'empty' => 'Choose Project', 'required' => false, 'placeholder' => '', 'style' => "clear:left", 
				'options' => $projList, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
				
				<?php echo $this->Form->input('emp_id', array('div'=> false,'type' => 'select', 'label' => false, 'id' => 'emp_id', 'class' => 'input-medium tskEmp', 'empty' => 'Choose Employee', 'selected' => $this->params->query['emp_id'], 'required' => false, 'placeholder' => '', 'style' => "clear:left", 'options' => $empList, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 				

				<?php echo $this->Form->input('month_year', array('div'=> false,'type' => 'text', 'value' => $this->request->query['month_year'], 'id' => 'srch_month','label' => false, 'class' => 'monthpick input-small', 'required' => false, 'placeholder' => 'Month', 'autocomplete' => 'off',  'style' => "clear:left",'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 	

				
 
				<?php echo $this->Form->input('plan_status', array('div'=> false,'type' => 'select', 
				'selected' => $this->params->query['plan_status'], 'id'=> 'plan_status',  'label' => false, 'class' => 'input-medium',
				'empty' => 'Choose Status', 'required' => false, 'placeholder' => '', 'style' => "clear:left", 
				'options' => $planStatus, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
				
	 <input type="hidden" class="srch_tsk_type plan_type_sel" name="data[TskTeamAssign][type]" value="<?php echo $this->request->query['type']?>"  id="type">

				
											
				<input type="submit" class="btn btn-primary" style="margin-bottom:9px;margin-left:4px;" value="Search"/>
									
				<a href="<?php echo $this->webroot;?>tskteamassign/"><button style="margin-bottom:9px;margin-left:4px;" type="button" class="btn btn-primary"><i class="icon-refresh"></i> Reset</button></a>
								
								<a href="javascript:void(0)" style="margin-left:25px;" class="task_add_form"><button style="margin-bottom:9px;margin-left:4px;"  type="button" class="btn btn-orange"><i class="icon-plus"></i> Assign Task</button></a>
		
		
		<div style="float:right">

			<ul class="nav nav-pills" style="">
											
						<li class="dropdown active">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $this->Functions->show_plan_type($this->request->query['type']);?>  <span class="caret"></span></a>
							<ul class="dropdown-menu" style="min-width:100px">												
								
								<?php if($this->request->query['type'] == 'D' || $this->request->query['type'] == ''):?>
								<li><a href="<?php echo $this->webroot;?>tskteamassign/?type=P">Project Task</a></li>
								<?php else: ?>
								<li><a href="<?php echo $this->webroot;?>tskteamassign/?type=D">Daily Task</a></li>
								<?php endif; ?>
													
				
							</ul>
						
						</li>
											</ul>

			</div>	
				
				
							
								
				</div>
				<?php echo $this->Form->end(); ?>
				<div class="addForm">
				<?php echo $this->element('task/assign_task'); ?>
				</div>

				<div  width="85%" id="eventCalendarDefault" style="clear:both;"></div>
							
								




								
							</div>	

							</div>
								<input type="hidden" value="1" id="overlayclose">
							<input type="hidden" value="" id="pageReload">	
								<input type="hidden" value="0" id="tskplan">
								<input type="hidden" value="0" id="tmtskplan">
								<input type="hidden" value="0" id="tskassign">
								<input type="hidden" value="1" id="tmtskassign">
							<input type="hidden" value="<?php echo $this->webroot;?>" id="webroot">

						<input type="hidden" value="1" id="SearchKeywords">
						<input type="hidden" value="<?php echo $this->webroot;?>tskteamassign/" id="root">
						<input type="hidden" value="<?php echo $this->webroot;?>" id="calroot">
					<input type="hidden" value="<?php echo $this->request->query['type']?>" id="tskplan_type" >
 <input type="hidden" id="pageCache" value="1">
						 <input type="hidden" id="show_task">
						 <input type="hidden"  id="rec_id" >
						 
						 <input type="hidden" class="srch_tsk_type plan_type_sel" name="data[TskTeamAssign][type]" value="<?php echo $this->request->query['type'] ? $this->request->query['type'] : 'D';?>"  id="type">
							<input type="hidden"  id="company">
							<input type="hidden" id="project">
						<input type="hidden" id="month" value="<?php echo date('Y-m-d');?>">	
						 	<input type="hidden" name="data[TskTeamAssign][task_month]"  id="task_month">
	<input type="hidden"  id="tsk_moved_date">

				<input type="hidden" value="<?php echo $this->request->query['date']?>" id="cur_date" >
						 <?php echo $this->Form->end(); ?>
						</div>
					</div>
				</div>
					
					
				</div>
		
			
			</div>
			

		</div>	
			
		
		
		
		
				
		


