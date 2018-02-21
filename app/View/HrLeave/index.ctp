

<?php echo $this->element('hr_menu'); ?>
		
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>My Leaves</h1>
					</div>
				<?php if($this->Session->read('USER.Login.emp_type') == 'R'):?>	
				<a href="<?php echo $this->webroot;?>hrleave/leave_policy/" class="colorboxPolicy">
					<button type="button" class="btn btn-teal" style="float:right;margin-top:20px;">
							<i class="icon-zoom-in"></i> Leave Policy</button></a>
				<?php endif; ?>
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>hrhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						
						
						<li>
							<a href="<?php echo $this->webroot;?>hrleave/">Leave</a>
							
						</li>
						
						
					</ul>
					
				</div>
				
				
				
				<?php echo $this->Session->flash();?>
				
					<div class="row-fluid footer_div">
					<div class="span12">
						<div class="box box-bordered box-color">
						
						<div class="box-title">
								<h3><i class="icon-list"></i> My Leaves</h3>
							</div>
							
						

						<?php echo $this->Form->create('HrLeave', array('name' => '', 'type' => '', 'id' => 'formID', 'class' => '')); ?>
							<div class="box-content">
							
						<div class="dataTables_wrapper">
						
				<div class="" id="DataTables_Table_8_filter"  style="padding:15px">
				
				<span>Search:</span>  
				<?php echo $this->Form->input('keyword', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-large', 'value' => $this->params->query['keyword'],   'required' => false, 'autocomplete' => 'off', 'placeholder' => 'Search here...', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
				
<span>Leave From:</span>  
				<?php echo $this->Form->input('from', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-small datepick', 'value' => $this->params->query['from'],   'required' => false,  'placeholder' => 'Leave From', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 

<span>Leave Till:</span>  
				<?php echo $this->Form->input('to', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-small datepick', 'value' => $this->params->query['to'],   'required' => false,  'placeholder' => 'Leave Till', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 				
	
				
											
											<input type="submit" class="btn btn-primary" style="margin-bottom:9px;margin-left:4px;" value="Search">
											
								<a href="<?php echo $this->webroot;?>hrleave/"><button style="margin-bottom:9px;margin-left:4px;" type="button" class="btn btn-primary"><i class="icon-refresh"></i> Reset</button></a>
								
								

								
					<a href="<?php echo $this->webroot;?>hrleave/create_leave/" ><button type="button" class="btn btn-primary" style="float:right"><i class="icon-plus"></i> Request Leave</button></a>
						<a href="javascript:void(0);" class="leave_status"><button type="button" class="btn btn-teal" style="float:right;margin-right:10px;"><i class="icon-search"></i> Balance</button></a>
								</div>			
								
								

								<table class="table table-hover table-nomargin table-bordered usertable dataTable">
									<thead>
										
										<tr>
							<th width="110">
											<?php echo $this->Paginator->sort('leave_from', 'Leave From', array('escape' => false,'direction' => 'desc'));?></th>
											<th width="110">
											<?php echo $this->Paginator->sort('leave_to', 'Leave Till', array('escape' => false,'direction' => 'desc'));?></th>
												<th width="95">
											<?php echo $this->Paginator->sort('no_days', 'No. of Days', array('escape' => false,'direction' => 'desc'));?></th>
											<th width="140">
											<?php echo $this->Paginator->sort('desc', 'Leave Type', array('escape' => false,'direction' => 'desc'));?></th>
											
											<th width="400"><?php echo $this->Paginator->sort('reason', 'Reason', array('escape' => false,'direction' => 'desc'));?></th>
											<th width="110">	
										<?php echo $this->Paginator->sort('created_date', 'Created', array('escape' => false,'direction' => 'desc'));?></th>
										
											<th width="120">Status</th>
											<!--th width="">Pay Status</th-->
											<th>View</th>
										</tr>
									</thead>
									<tbody>
									
										
									
										<?php  foreach($leave_data as $leave):?>
										
										<tr>
											
											
											<td><?php echo $this->Functions->format_date($leave['HrLeave']['leave_from']);?></td>
													
											<td><?php echo $this->Functions->format_date($leave['HrLeave']['leave_to']);?></td>
											<td><?php echo $leave['HrLeave']['no_days'];?></td>
												<td><?php echo $leave['HrLeaveType']['desc'];?></td>
												<td><?php echo  $this->Functions->string_truncate($leave['HrLeave']['reason'], 50);?></td>
											<td><?php echo $this->Functions->format_date($leave['HrLeave']['created_date']);?></td>
											<td>
											
											<?php 
											echo $this->Functions->format_status($leave[0]['st_status'],$leave[0]['st_created'],$leave[0]['st_user'],$leave[0]['st_modified']); ?>
											
									
											
											</td>
											
											<td>											
											
												<a href="<?php echo $this->webroot;?>hrleave/view_leave/<?php echo $leave['HrLeave']['id'];?>/" class="btn" rel="tooltip" title="View"><i class="icon-search"></i></a>
												
									
											</td>
										</tr>
									<?php endforeach; ?>
									</tbody>
								</table>
								

								<?php echo $this->element('paging');?>
								
								




								
							</div>	

							</div>
						<!--input type="hidden" value="1" id="SearchKeywords"-->
						<input type="hidden" value="<?php echo $this->webroot;?>hrleave/" id="webroot">
						 <?php echo $this->Form->end(); ?>
						</div>
					</div>
				</div>
					
					
				</div>
		
			
			</div>
			

		</div>	
			
		
		
		
	<div class="modal" id="leave_status" style="display:none">
	<div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icon-remove small"></i></button>
          <h4 class="modal-title">Leave Status</h4>
        </div><div class="container"></div>
        <div class="modal-body">
        
		
				 <?php echo $this->element('leave_status'); ?>
        
		
        </div>
        <div class="modal-footer">
          <a href="#" data-dismiss="modal" class="btn">Close</a>
        </div>
      </div>
    </div>
</div>
	
				
		


