<?php echo $this->element('hr_menu'); ?>

	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Approve PL Request</h1>
						
						
					</div>
				
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>hrhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						
						
						<li>
							<a href="<?php echo $this->webroot;?>hrplreq/">Approve PL Request</a>
							
						</li>
						
						
					</ul>
					
				</div>
				
				
				
				<?php echo $this->Session->flash();?>
				
					<div class="row-fluid  footer_div" >
					<div class="span12">
						<div class="box box-bordered box-color">
						
						<div class="box-title">
								<h3><i class="icon-list"></i> Approve PL Request</h3>
							</div>
							
						

						<?php echo $this->Form->create('HrPlReq', array('name' => '', 'type' => '', 'id' => 'formID', 'class' => '')); ?>
							<div class="box-content">
							
						<div class="dataTables_wrapper">
						
				<div class="" id="DataTables_Table_8_filter"  style="padding:15px">
				
			
												
		<span>Employee:</span>		<?php echo $this->Form->input('emp_id', array('div'=> false,'type' => 'select', 'label' => false, 'class' => 'input-large', 'empty' => 'Select', 'selected' => $this->params->query['emp_id'], 'required' => false, 'placeholder' => '', 'style' => "clear:left", 'options' => $empList, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 

				
				
											
											<input type="submit" value="Search" class="btn btn-primary" style="margin-bottom:9px;margin-left:4px;">
											
													<a href="<?php echo $this->webroot;?>hrplreq/"><button style="margin-bottom:9px;margin-left:4px;" type="button" class="btn btn-primary"><i class="icon-refresh"></i> Reset</button></a>
											
						
								</div>			
								
								


<input type="hidden" id="del_url" value="<?php echo $this->webroot;?>hrplreq/delete_req/"/>
								<table class="table table-hover table-nomargin table-bordered usertable dataTable">
									<thead>
										
										<tr>
											<th width="160">
											<?php echo $this->Paginator->sort('HrEmployee.first_name', 'Employee', array('escape' => false,'direction' => 'desc'));?>
												</th>
											<th width="100">
											<?php echo $this->Paginator->sort('date_from', 'Leave From', array('escape' => false,'direction' => 'desc'));?>
												</th>
											<th width="100">
											<?php echo $this->Paginator->sort('date_to', 'Leave Till', array('escape' => false,'direction' => 'desc'));?>
												</th>
<th width="100">
											<?php echo $this->Paginator->sort('no_days', 'No. Days', array('escape' => false,'direction' => 'desc'));?>
												</th>													
													<th width="400">
											<?php echo $this->Paginator->sort('reason', 'Reason', array('escape' => false,'direction' => 'desc'));?>
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
									
										
									
										<?php  foreach($req_data as $req):?>
										
										<tr>
										<td><?php echo $req['HrEmployee']['first_name'].' '.$req['HrEmployee']['last_name'];?></td>
											<td><?php echo $this->Functions->format_date($req['HrPlReq']['date_from']);?></td>
											<td><?php echo $this->Functions->format_date($req['HrPlReq']['date_to']);?></td>
											<td><?php echo $req['HrPlReq']['no_days'];?></td>
											<td><?php echo $this->Functions->string_truncate($req['HrPlReq']['reason'], 60);?></td>
											
											<td><?php echo $this->Functions->format_date($req['HrPlReq']['created_date']);?></td>
										<td><?php 
											if($req['HrPlReq']['status'] == 'W'):
											echo $this->Functions->time_diff($req['HrPlReq']['created_date'], 0);
											endif;
										?></td>
											
											<td>								
		<?php echo $this->Functions->get_admin_status($req['HrPlReq']['status'],$req['HrPlReq']['approve_date']); ?>
</td>
											<td class='hidden-480'>
			<?php if($req['HrPlReq']['status'] == 'W'):?>
			<a href="<?php echo $this->webroot;?>hrplreq/view_request/<?php echo $req['HrPlReq']['id'];?>/<?php echo $req['HrPlReq']['app_users_id'];?>" class="btn" rel="tooltip" title="" data-original-title="Verify"><i class="icon-check-empty"></i></a>
			<?php else:?>
			<a href="<?php echo $this->webroot;?>hrplreq/view_request/<?php echo $req['HrPlReq']['id'];?>/<?php echo $req['HrPlReq']['app_users_id'];?>" class="btn" rel="tooltip" title="" data-original-title="Verified"><i class="icon-check"></i></a>
			<?php endif; ?>
											</td>
										</tr>
										
									<?php endforeach; ?>
									</tbody>
								</table>
								

								<?php echo $this->element('paging');?>
								
								




								
							</div>	

							</div>
						<input type="hidden" value="<?php echo $this->webroot;?>hrplreq/" id="webroot">
						 <?php echo $this->Form->end(); ?>
						</div>
					</div>
				</div>
					
					
				</div>
		
			
			</div>
			

		</div>	
			
		
		
		
		
				
		


