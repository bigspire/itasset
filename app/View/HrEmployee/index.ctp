<?php echo $this->element('hr_menu'); ?>
<style>
.popover-title{color:#2a2a2a}
</style>		
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Employee</h1>
						
						
					</div>
				
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>hrhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						
						
						<li>
							<a href="<?php echo $this->webroot;?>hremployee/">Employee</a>
							
						</li>
						
						
					</ul>
					
				</div>
				
				
				
				<?php echo $this->Session->flash();?>
				
					<div class="row-fluid  footer_div previewDiv" >
					<div class="span12">
						<div class="box box-bordered box-color">
						
						<div class="box-title">
								<h3><i class="icon-list"></i> Employee</h3>
							</div>
							
						

						<?php echo $this->Form->create('HrEmployee', array('name' => '', 'type' => '', 'id' => 'formID', 'class' => '')); ?>
							<div class="box-content">
							
						<div class="dataTables_wrapper">
						
				<div class="" id="DataTables_Table_8_filter"  style="padding:15px">
				
				<span>Search:</span>  
				
				<?php echo $this->Form->input('keyword', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-large', 'value' => $this->params->query['keyword'],  'id' => 'SearchText', 'required' => false, 'autocomplete' => 'off', 'placeholder' => 'Search here...', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
			<span>Status:</span>		<?php echo $this->Form->input('rec_status', array('div'=> false,'type' => 'select', 'label' => false, 'class' => 'input-small',  'selected' => $this->params->query['rec_status'], 'required' => false, 'placeholder' => '', 'default' => 1,  'style' => "clear:left", 'options' => array('1' => 'Active', '2' => 'Inactive'), 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
					
	<span>Photo:</span>		<?php echo $this->Form->input('status', array('div'=> false,'type' => 'select', 'label' => false, 'class' => 'input-small', 'empty' => 'Select', 'selected' => $this->params->query['status'], 'required' => false, 'placeholder' => '', 'style' => "clear:left", 'options' => array('W' => 'Pending', 'A' => 'Approved'), 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
		
	
	<span>Emp. Type:</span>		<?php echo $this->Form->input('emp_type', array('div'=> false,'type' => 'select', 'label' => false, 'class' => 'input-medium', 'empty' => 'Select', 'selected' => $this->params->query['emp_type'], 'required' => false, 'placeholder' => '', 'style' => "clear:left", 'options' => $emp_types, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
		
											
											<input type="submit" value="Search" class="btn btn-primary" style="margin-bottom:9px;margin-left:4px;">
											
													<a href="<?php echo $this->webroot;?>hremployee/"><button style="margin-bottom:9px;margin-left:4px;" type="button" class="btn btn-primary"><i class="icon-refresh"></i> Reset</button></a>
						
					<a href="<?php echo $this->webroot;?>hremployee/create_employee/personal/"><button type="button" class="btn btn-primary" style="float:right"><i class="icon-plus"></i> Add Employee</button></a>
				
				<a href="<?php echo $this->webroot;?>hremployee/?action=export"><button type="button" class="btn btn-primary" style="float:right;margin-right:20px;"><i class="icon-reply"></i> Export</button></a>

								</div>			
								
								
<div id="dialog-confirm" title="Confirmation!" class="dn">
	<p>Are you sure you want to delete?</p>
</div>

<input type="hidden" id="del_url" value="<?php echo $this->webroot;?>hremployee/delete_employee/"/>
								<table class="table table-hover table-nomargin table-bordered usertable dataTable">
									<thead>
										
										<tr>
											
											<th>
											<?php echo $this->Paginator->sort('first_name', 'Name', array('escape' => false,'direction' => 'desc', 'class' => 'sorting'));?>
												</th>
										<th>
											<?php echo $this->Paginator->sort('emp_no', 'Emp. ID', array('escape' => false,'direction' => 'desc', 'class' => 'sorting'));?>
												</th>		
												<th width="50">
											<?php echo $this->Paginator->sort('emp_type', 'Type', array('escape' => false,'direction' => 'desc', 'class' => 'sorting'));?>
												</th>
													<th width="40">
											<?php echo $this->Paginator->sort('email_address', 'Email', array('escape' => false,'direction' => 'desc'));?>
												</th>
												
											
											<th >
											<?php echo $this->Paginator->sort('dept_name', 'Department', array('escape' => false,'direction' => 'desc'));?>
												</th>
													<th>
											<?php echo $this->Paginator->sort('desig_name', 'Designation', array('escape' => false,'direction' => 'desc'));?>
												</th>
															<th width="40">
											<?php echo $this->Paginator->sort('Role.role_name', 'Role', array('escape' => false,'direction' => 'desc'));?>
												</th>
										<th width="50">
											<?php echo $this->Paginator->sort('doj', 'DOJ', array('escape' => false,'direction' => 'desc'));?>
												</th>	
	
<th width="60">
											<?php echo $this->Paginator->sort('probation', 'Probation', array('escape' => false,'direction' => 'desc'));?>
												</th>
<th width="80">
											<?php echo $this->Paginator->sort('doc', 'DOC', array('escape' => false,'direction' => 'desc'));?>
												</th>												
												<th  width="80">
											<?php echo $this->Paginator->sort('created_date', 'Created', array('escape' => false,'direction' => 'desc'));?>
												</th>
											<th>Photo</th>
											<th>Status</th>
											<th>Options</th>
										</tr>
									</thead>
									<tbody>
									
										
									
										<?php  foreach($emp_data as $emp):?>
										
										<tr>
											
											<td><?php echo $emp['HrEmployee']['first_name'].' '.$emp['HrEmployee']['last_name'];?></td>
											<td><?php echo $emp['HrEmployee']['emp_no'];?></td>
											<td><?php echo $emp['HrEmployee']['emp_type'] == 'R' ? 'Regular' : ($emp['HrEmployee']['emp_type'] == 'A' ? 'Associate 1' : 'Associate 2');?></td>

											<td><?php echo $emp['HrEmployee']['email_address'];?></td>
											<td><?php echo $emp['HrDepartment']['dept_name'];?></td>
											<td><?php echo $emp['HrDesignation']['desig_name'];?></td>
											<td><?php echo $emp['Role']['role_name'];?></td>
										<td><?php echo $this->Functions->format_date($emp['HrEmployee']['doj']);?></td>
										<td><?php
										if($emp['HrEmployee']['emp_type'] == 'R'):
										echo $emp['HrEmployee']['probation'] == 'Y' ? 'Probation' : 'Confirmed';
										else:
										echo 'N/A';
										endif;
										?></td>
										<td><?php if($emp['HrEmployee']['emp_type'] == 'R'):
										echo $this->Functions->format_date($emp['HrEmployee']['doc']);
										else:
										echo 'N/A';
										endif;
										?></td>

											<td><?php echo $this->Functions->format_date($emp['HrEmployee']['created_date']);?></td>
											
											<td>
										<?php if($emp['HrEmployee']['photo_status'] == 'W'):?>	
											<span class="label label-warning imgPreview"><a href="javascript:void(0)" rel="preview" data-rel="timepopover" data-placement="bottom" class="prevImg" data-content='<img src="<?php echo $this->webroot;?>timthumb.php?src=uploads/photo/<?php echo $emp['HrEmployee']['photo'];?>&h=100&q=100">' data-original-title="<b>Preview</b>">Pending</a></span>
											<?php elseif($emp['HrEmployee']['photo_status'] == 'A'):?>	
											<span class="label label-success imgPreview"><a href="javascript:void(0)" rel="preview" data-rel="timepopover" data-placement="bottom" class="prevImg" data-content='<img src="<?php echo $this->webroot;?>timthumb.php?src=uploads/photo/<?php echo $emp['HrEmployee']['photo'];?>&h=100&q=100">' data-original-title="<b>Preview</b>">Verified</a></span>
											<?php else:?>
											N/A
											<?php endif; ?>
											
											
											</td>
											
											<td><?php echo $this->Functions->show_status($emp['HrEmployee']['status']);?></td>
											<td class='hidden-480'>
												<a href="<?php echo $this->webroot;?>hremployee/view_employee/<?php echo $emp['HrEmployee']['id'];?>/<?php echo $st_url; ?>" class="btn" rel="tooltip" title="View"><i class="icon-search"></i></a>
											
										
											
											</td>
										</tr>
										
									<?php endforeach; ?>
									</tbody>
								</table>
								

								<?php echo $this->element('paging');?>
								
								




								
							</div>	

							</div>
						<input type="hidden" value="1" id="SearchKeywords">
						<input type="hidden" value="<?php echo $this->webroot;?>hremployee/" id="webroot">
						 <?php echo $this->Form->end(); ?>
						</div>
					</div>
				</div>
					
					
				</div>
		
			
			</div>
			

		</div>	
			
		
		
		
		
				
		


