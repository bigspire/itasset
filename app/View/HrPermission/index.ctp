<?php echo $this->element('hr_menu'); ?>
		
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>My Permissions</h1>
						
						
					</div>
				
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>hrhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						
						
						<li>
							<a href="<?php echo $this->webroot;?>hrpermission/">My Permissions</a>
							
						</li>
						
						
					</ul>
					
				</div>
				
				
				
				<?php echo $this->Session->flash();?>
				
					<div class="row-fluid footer_div" >
					<div class="span12">
						<div class="box box-bordered box-color">
						
						<div class="box-title">
								<h3><i class="icon-list"></i> My Permissions</h3>
							</div>
							
						

						<?php echo $this->Form->create('HrPermission', array('name' => '', 'type' => '', 'id' => 'formID', 'class' => '')); ?>
							<div class="box-content">
							
						<div class="dataTables_wrapper">
						
				<div class="" id="DataTables_Table_8_filter"  style="padding:15px">
				
				<span>Search:</span>  
				<?php echo $this->Form->input('keyword', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-large', 'value' => $this->params->query['keyword'],   'required' => false, 'autocomplete' => 'off', 'placeholder' => 'Search here...', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
				
<span>From:</span>  
				<?php echo $this->Form->input('from', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-small datepick', 'value' => $this->params->query['from'],   'required' => false,  'placeholder' => 'From', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 

<span>To:</span>  
				<?php echo $this->Form->input('to', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-small datepick', 'value' => $this->params->query['to'],   'required' => false,  'placeholder' => 'To', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 				
	
				
											
											<input type="submit" class="btn btn-primary" style="margin-bottom:9px;margin-left:4px;" value="Search">
											
								<a href="<?php echo $this->webroot;?>hrpermission/"><button style="margin-bottom:9px;margin-left:4px;" type="button" class="btn btn-primary"><i class="icon-refresh"></i> Reset</button></a>
								
								
								
					<a href="<?php echo $this->webroot;?>hrpermission/create_permission/" ><button type="button" class="btn btn-primary" style="float:right"><i class="icon-plus"></i> Request Permission</button></a>
						<a href="javascript:void(0);" class="leave_status"><button type="button" class="btn btn-teal" style="float:right;margin-right:10px;"><i class="icon-search"></i> Balance</button></a>
								</div>			
								
								

								<table class="table table-hover table-nomargin table-bordered usertable dataTable">
									<thead>
										
										<tr>
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
										
											<th width="120">Status</th>
											<!--th width="">Pay Status</th-->
											<th>View</th>
										</tr>
									</thead>
									<tbody>
									
										
									
										<?php  foreach($per_data as $per):?>
										
										<tr>
											<td><?php echo $this->Functions->format_date($per['HrPermission']['per_date']);?></td>	
											
											<td><?php echo $this->Functions->format_time_show($per['HrPermission']['per_from']);?></td>
													
											<td><?php echo $this->Functions->format_time_show($per['HrPermission']['per_to']);?></td>
											<td><?php echo $this->Functions->display_hrs($per['HrPermission']['no_hrs']);?></td>
								
												<td><?php echo  $this->Functions->string_truncate($per['HrPermission']['reason'], 50);?></td>
											<td><?php echo $this->Functions->format_date($per['HrPermission']['created_date']);?></td>
											<td>
											
											<?php echo $this->Functions->format_status($per[0]['st_status'],$per[0]['st_created'],$per[0]['st_user'],$per[0]['st_modified']); ?>
											
									
											
											</td>
											
											<td>											
											
												<a href="<?php echo $this->webroot;?>hrpermission/view_permission/<?php echo $per['HrPermission']['id'];?>/" class="btn" rel="tooltip" title="View"><i class="icon-search"></i></a>
												
									
											</td>
										</tr>
									<?php endforeach; ?>
									</tbody>
								</table>
								

								<?php echo $this->element('paging');?>
								
								




								
							</div>	

							</div>
						<!--input type="hidden" value="1" id="SearchKeywords"-->
						<input type="hidden" value="<?php echo $this->webroot;?>hrpermission/" id="webroot">
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
          <h4 class="modal-title">Permission Status</h4>
        </div><div class="container"></div>
        <div class="modal-body">
        
		
				 <?php echo $this->element('perm_status'); ?>
        
		
        </div>
        <div class="modal-footer">
          <a href="#" data-dismiss="modal" class="btn">Close</a>
        </div>
      </div>
    </div>
</div>
	
				
		


