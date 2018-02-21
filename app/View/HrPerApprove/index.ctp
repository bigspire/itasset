<?php echo $this->element('hr_menu'); ?>
		
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Approve Permission</h1>
						
						
					</div>
				
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>hrhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						
						
						<li>
							<a href="<?php echo $this->webroot;?>hrperapprove/">Approve Permission</a>
							
						</li>
						
						
					</ul>
					
				</div>
				
				
				
				<?php echo $this->Session->flash();?>
				
					<div class="row-fluid  footer_div">
					<div class="span12">
						<div class="box box-bordered box-color">
						
						<div class="box-title">
								<h3><i class="icon-list"></i> Approve Permission</h3>
							</div>
							
						

						<?php echo $this->Form->create('HrPerApprove', array('name' => '', 'type' => '', 'id' => 'formID', 'class' => '')); ?>
							<div class="box-content">
							
						<div class="dataTables_wrapper">
						
				<div class="" id="DataTables_Table_8_filter"  style="padding:15px">
				
			<span>Search:</span>  <?php echo $this->Form->input('keyword', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-large', 'value' => $this->params->query['keyword'], 'required' => false, 'autocomplete' => 'off', 'placeholder' => 'Search here...', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
		
											

								<span>Employee:</span>		<?php echo $this->Form->input('emp_id', array('div'=> false,'type' => 'select', 'label' => false, 'class' => 'input-large', 'empty' => 'Select', 'selected' => $this->params->query['emp_id'], 'required' => false, 'placeholder' => '', 'style' => "clear:left", 'options' => $empList, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
								
								<span>From:</span>  
				<?php echo $this->Form->input('from', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-small datepick', 'value' => $this->params->query['from'],   'required' => false,  'placeholder' => 'From', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 

<span>To:</span>  
				<?php echo $this->Form->input('to', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-small datepick', 'value' => $this->params->query['to'],   'required' => false,  'placeholder' => 'To', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											
											<input class="btn btn-primary" type="submit" style="margin-bottom:9px;margin-left:4px;" value="Search"/>
											
				<a href="<?php echo $this->webroot;?>hrperapprove/"><button style="margin-bottom:9px;margin-left:4px;" type="button" class="btn btn-primary"><i class="icon-refresh"></i> Reset</button></a>
						
								</div>			
								
								

	<table class="table table-hover table-nomargin table-bordered usertable dataTable">
									<thead>
										
										<tr>
										
										<th  width="140">
											<?php echo $this->Paginator->sort('first_name', 'Employee', array('escape' => false,'direction' => 'desc'));?>
											</th>
											<th width="150">
							
											<?php echo $this->Paginator->sort('per_date', 'Permission Date', array('escape' => false,'direction' => 'desc'));?></th>
											
							<th width="110">
							
											<?php echo $this->Paginator->sort('per_from', 'From', array('escape' => false,'direction' => 'desc'));?></th>
											<th width="110">
											<?php echo $this->Paginator->sort('per_to', 'To', array('escape' => false,'direction' => 'desc'));?></th>
												<th width="95">
											<?php echo $this->Paginator->sort('no_hrs', 'Total Hrs', array('escape' => false,'direction' => 'desc'));?></th>
											
										
											
											<th width="400"><?php echo $this->Paginator->sort('reason', 'Reason', array('escape' => false,'direction' => 'desc'));?></th>
											<th width="110">	
										<?php echo $this->Paginator->sort('created_date', 'Created', array('escape' => false,'direction' => 'desc'));?></th>
											<th  width="80">Pending</th>
										
										
											<th width="140">Status</th>
											<!--th width="">Pay Status</th-->
											<th>Verify</th>
											
										</tr>
										
								
										
									</thead>
									<tbody>
									
										
									
										<?php  foreach($perm_data  as $key => $permission):?>
										
										<tr>
										
											<td><?php echo ucfirst($permission['Home2']['first_name']).' '.ucfirst($permission['Home2']['last_name']);?></td>
											<td><?php echo $this->Functions->format_date($permission['HrPerApprove']['per_date']);?></td>
											<td><?php echo $this->Functions->format_time_show($permission['HrPerApprove']['per_from']);?></td>
													
											<td><?php echo $this->Functions->format_time_show($permission['HrPerApprove']['per_to']);?></td>
											<td><?php echo $this->Functions->display_hrs($permission['HrPerApprove']['no_hrs']);?></td>
												
												<td><?php echo  $this->Functions->string_truncate($permission['HrPerApprove']['reason'], 30);?></td>
											<td><?php echo $this->Functions->format_date($permission['HrPerApprove']['created_date']);?></td>
											
											<td><?php $pending = strstr($permission[0]['st_status'], 'W');
											if(!empty($pending)):
											echo $this->Functions->time_diff($permission['HrPerApprove']['created_date'], 0);endif;
											?>
											</td>
										
											
											<td>	<?php echo $this->Functions->format_status($permission[0]['st_status'],$permission[0]['st_created'],$permission[0]['st_user'],$permission[0]['st_modified']); ?></td>
											
											<?php  
											$icon = $this->Functions->show_verify_icon($show_status[$key]);
											$title = $this->Functions->show_verify_title($show_status[$key]);
											
											
											?>
											
									
											
										
											
											<td>											
											
												<a href="<?php echo $this->webroot;?>hrperapprove/view_permission/<?php echo $permission['HrPerApprove']['id'];?>/<?php echo $permission[0]['status_id'];?>/<?php echo $permission['Home2']['id'];?>" class="btn" rel="tooltip" title="<?php echo $title;?>"><i class="<?php echo $icon;?>"></i></a>
												
											
												
									
											</td>
										</tr>
									<?php endforeach; ?>
									</tbody>
								</table>
								

								
								<?php echo $this->element('paging');?>
								
								
							</div>
					</div>
						 <?php echo $this->Form->end(); ?>
						</div>
					</div>
				</div>
					
					
				</div>
		
			
			</div>
			

		</div>	
			
		
		
		
		
				
		


