<?php echo $this->element('hr_menu'); ?>
		
	<div class="container-fluid" id="content" style="overflow:auto">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Employee Leave Details</h1>
						
						
					</div>
				
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>hrhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						
						
						<li>
							<a href="<?php echo $this->webroot;?>hrbankacc/">Employee Leave Details</a>
							
						</li>
						
						
					</ul>
					
				</div>
				
				
				
			<?php echo $this->Session->flash();?>
				
					<div class="row-fluid  footer_div" >
					<div class="span12">
						<div class="box box-bordered box-color">
						
						<div class="box-title">
								<h3><i class="icon-list"></i> Employee Leave Details </h3>
							</div>
							
						

						<?php echo $this->Form->create('HrLeaveDetail', array('name' => '', 'type' => '', 'id' => 'formID', 'class' => '')); ?>
							<div class="box-content">
							
						<div class="dataTables_wrapper">
						
				<div class="" id="DataTables_Table_8_filter"  style="padding:15px">
				
				<span>Search:</span>  
				
				<?php echo $this->Form->input('keyword', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-large', 'value' => $this->params->query['keyword'],  'id' => 'SearchText', 'required' => false, 'autocomplete' => 'off', 'placeholder' => 'Search here...', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												
		
				
				
											
											<input type="submit" value="Search" class="btn btn-primary" style="margin-bottom:9px;margin-left:4px;">
											
													<a href="<?php echo $this->webroot;?>hrleavedetails/"><button style="margin-bottom:9px;margin-left:4px;" type="button" class="btn btn-primary"><i class="icon-refresh"></i> Reset</button></a>
											
					<a href="<?php echo $this->webroot;?>hrleavedetails/upload/"><button type="button" class="btn btn-primary" style="float:right"><i class="icon-plus"></i> Upload PL</button></a>
						
								</div>			
								
								


								<table class="table table-hover table-nomargin table-bordered usertable dataTable">
									<thead>
										
										<tr>
											
											<th width="150">
											<?php echo $this->Paginator->sort('first_name', 'Employee', array('escape' => false,'direction' => 'desc'));?>
												</th>
												
												<th width="120" >
											<?php echo $this->Paginator->sort('start_time', 'Balance NBL ', array('escape' => false,'direction' => 'desc'));?>
												</th>
													
												<th width="120">
											<?php echo $this->Paginator->sort('end_time', 'Balance PL ', array('escape' => false,'direction' => 'desc'));?>
												</th>
												
											
										
																						
										<th width="110">
											<?php echo $this->Paginator->sort('created_date', 'Created Date', array('escape' => false,'direction' => 'desc'));?>
												</th>
												
												
												
												<th width="110">
											<?php echo $this->Paginator->sort('modified_date', 'Last Modified', array('escape' => false,'direction' => 'desc'));?>
												</th>	
											
											
											<th width="50">Options</th>
										</tr>
									</thead>
									<tbody>
									
										
									
										<?php  foreach($leave_data as $leave):?>
										
										<tr>
											
											<td><?php echo ucwords($leave['HrEmployee']['first_name'].' '.$leave['HrEmployee']['last_name']);?></td>
											
														<td><?php echo $leave['HrLeaveDetail']['nbl_bal'];?></td>
														
															<td><?php echo $leave[0]['pl_bal'];?></td>
															
														
															
															
											
											<td><?php echo $this->Functions->format_date($leave['HrLeaveDetail']['created_date']);?></td>
											
										<td><?php echo $this->Functions->format_date($leave['HrLeaveDetail']['modified_date']);?></td>
									
											
											<td class='hidden-480'>
											
									
											<a  href="<?php echo $this->webroot;?>hrleavedetails/edit_leave_details/<?php echo $leave['HrEmployee']['id'];?>/<?php echo $leave['HrLeaveDetail']['id'];?>/?action=view" class="btn iframeBox" val="45_50" rel="tooltip" title="View"><i class="icon-search"></i></a>
								
												<a  href="<?php echo $this->webroot;?>hrleavedetails/edit_leave_details/<?php echo $leave['HrEmployee']['id'];?>/<?php echo $leave['HrLeaveDetail']['id'];?>/?action=edit" class="btn iframeBox" val="45_50" rel="tooltip" title="Edit"><i class="icon-edit"></i></a>
									
											</td>
										</tr>
										
									<?php endforeach; ?>
									</tbody>
								</table>
								

								<?php echo $this->element('paging');?>
								
								




								
							</div>	

							</div>
							
							<?php echo $this->Form->input('edit_bank_acc', array('id' => 'edit_bank_acc', 'type' => 'hidden'));?>
						<input type="hidden" value="1" id="SearchKeywords">
						<input type="hidden" value="<?php echo $this->webroot;?>hrleavedetails/" id="webroot">
						 <?php echo $this->Form->end(); ?>
						</div>
					</div>
				</div>
					
					
				</div>
		
			
			</div>
			

		</div>	
			
		
		
		
		
				
		


