<?php echo $this->element('tsk_menu'); ?>

	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Approve Project Request</h1>
						
						
					</div>
				
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>tskhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						
						
						<li>
							<a href="<?php echo $this->webroot;?>tskprojectrequest/">Approve Project Request</a>
							
						</li>
						
						
					</ul>
					
				</div>
				
				
				
				<?php echo $this->Session->flash();?>
				
					<div class="row-fluid  footer_div" >
					<div class="span12">
						<div class="box box-bordered box-color">
						
						<div class="box-title">
								<h3><i class="icon-list"></i> Approve Project Request</h3>
							</div>
							
						

						<?php echo $this->Form->create('TskProjectRequest', array('name' => '', 'type' => '', 'id' => 'formID', 'class' => '')); ?>
							<div class="box-content">
							
						<div class="dataTables_wrapper">
						
				<div class="" id="DataTables_Table_8_filter"  style="padding:15px">
				
			
			<span>Search:</span>  <?php echo $this->Form->input('keyword', array('div'=> false,'type' => 'text', 'id' => 'SearchText', 'label' => false, 'class' => 'input-large ', 'value' => $this->params->query['keyword'], 'required' => false, 'autocomplete' => 'off', 'placeholder' => 'Search here...', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												
		<span>Employee:</span>		<?php echo $this->Form->input('emp_id', array('div'=> false,'type' => 'select', 'label' => false, 'class' => 'input-large', 'empty' => 'Select', 'selected' => $this->params->query['emp_id'], 'required' => false, 'placeholder' => '', 'style' => "clear:left", 'options' => $empList, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 

				
				
											
											<input type="submit" value="Search" class="btn btn-primary" style="margin-bottom:9px;margin-left:4px;">
											
													<a href="<?php echo $this->webroot;?>tskprojectrequest/"><button style="margin-bottom:9px;margin-left:4px;" type="button" class="btn btn-primary"><i class="icon-refresh"></i> Reset</button></a>
											
						
								</div>			
								
								
<div id="dialog-confirm" title="Confirmation!" class="dn">
	<p>Are you sure you want to delete?</p>
</div>

<input type="hidden" id="del_url" value="<?php echo $this->webroot;?>tskprojectrequest/delete_project_req/"/>
								<table class="table table-hover table-nomargin table-bordered usertable dataTable">
									<thead>
										
										<tr>
											<th width="130">
											<?php echo $this->Paginator->sort('HrEmployee.first_name', 'Employee', array('escape' => false,'direction' => 'desc'));?>
												</th>
											<th width="150">
											<?php echo $this->Paginator->sort('project_name', 'Project', array('escape' => false,'direction' => 'desc'));?>
												</th>
											<th width="340">
											<?php echo $this->Paginator->sort('purpose', 'Purpose', array('escape' => false,'direction' => 'desc'));?>
												</th>	
													<th width="170">
											<?php echo $this->Paginator->sort('company_name', 'Company', array('escape' => false,'direction' => 'desc'));?>
												</th>
												
											
											<th width="120">
											<?php echo $this->Paginator->sort('project_leader', 'Project Leader', array('escape' => false,'direction' => 'desc'));?>
												</th>
												<th  width="100">
											<?php echo $this->Paginator->sort('created_date', 'Created', array('escape' => false,'direction' => 'desc'));?>
												</th>
											<th  width="80">Pending</th>
											<th  width="80">Status</th>
											<th>Options</th>
										</tr>
									</thead>
									<tbody>
									
										
									
										<?php  foreach($proj_data as $proj):?>
										
										<tr>
													<td><?php echo $proj['HrEmployee']['first_name'].' '.$proj['HrEmployee']['last_name'];?></td>
											<td><?php echo $proj['TskProjectRequest']['project_name'];?></td>
											<td><?php echo $this->Functions->string_truncate($proj['TskProjectRequest']['purpose'], 40);?></td>
											<td><?php echo $proj['TskCustomer']['company_name'];?></td>
											<td><?php echo $proj['PROJ_LEAD']['first_name'].' '.$proj['PROJ_LEAD']['last_name'];?></td>
											
											<td><?php echo $this->Functions->format_date($proj['TskProjectRequest']['created_date']);?></td>
										<td><?php 
											if($proj['TskProjectRequest']['status'] == 'W'):
											echo $this->Functions->time_diff($proj['TskProjectRequest']['created_date'], 0);
											endif;
										?></td>
											
											<td>								
		<?php echo $this->Functions->get_admin_status($proj['TskProjectRequest']['status'],$proj['TskProjectRequest']['approved_date']); ?>
</td>
											<td class='hidden-480'>
			<?php if($proj['TskProjectRequest']['status'] == 'W'):?>
			<a href="<?php echo $this->webroot;?>tskprojectrequest/view_project_req/<?php echo $proj['TskProjectRequest']['id'];?>/<?php echo $proj['TskProjectRequest']['app_users_id'];?>" class="btn" rel="tooltip" title="" data-original-title="Verify"><i class="icon-check-empty"></i></a>
			<?php else:?>
			<a href="<?php echo $this->webroot;?>tskprojectrequest/view_project_req/<?php echo $proj['TskProjectRequest']['id'];?>/<?php echo $proj['TskProjectRequest']['app_users_id'];?>" class="btn" rel="tooltip" title="" data-original-title="Verified"><i class="icon-check"></i></a>
			<?php endif; ?>
											</td>
										</tr>
										
									<?php endforeach; ?>
									</tbody>
								</table>
								

								<?php echo $this->element('paging');?>
								
								




								
							</div>	

							</div>
						<input type="hidden" value="1" id="SearchKeywords">
						<input type="hidden" value="<?php echo $this->webroot;?>tskprojectrequest/" id="webroot">
						 <?php echo $this->Form->end(); ?>
						</div>
					</div>
				</div>
					
					
				</div>
		
			
			</div>
			

		</div>	
			
		
		
		
		
				
		


