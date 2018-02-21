<?php echo $this->element('hr_menu'); ?>
		
	<div class="container-fluid" id="content" style="overflow:auto">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Employee Office Timing</h1>
						
						
					</div>
				
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>hrhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						
						
						<li>
							<a href="<?php echo $this->webroot;?>hrbankacc/">Employee Office Timing</a>
							
						</li>
						
						
					</ul>
					
				</div>
				
				
				
			<?php echo $this->Session->flash();?>
				
					<div class="row-fluid  footer_div" >
					<div class="span12">
						<div class="box box-bordered box-color">
						
						<div class="box-title">
								<h3><i class="icon-list"></i> Employee Office Timing </h3>
							</div>
							
						

						<?php echo $this->Form->create('HrOfficeTiming', array('name' => '', 'type' => '', 'id' => 'formID', 'class' => '')); ?>
							<div class="box-content">
							
						<div class="dataTables_wrapper">
						
				<div class="" id="DataTables_Table_8_filter"  style="padding:15px">
				
				<span>Search:</span>  
				
				<?php echo $this->Form->input('keyword', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-large', 'value' => $this->params->query['keyword'],  'id' => 'SearchText', 'required' => false, 'autocomplete' => 'off', 'placeholder' => 'Search here...', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												
		
				
				
											
											<input type="submit" value="Search" class="btn btn-primary" style="margin-bottom:9px;margin-left:4px;">
											
													<a href="<?php echo $this->webroot;?>hrofficetiming/"><button style="margin-bottom:9px;margin-left:4px;" type="button" class="btn btn-primary"><i class="icon-refresh"></i> Reset</button></a>
											
					
						
								</div>			
								
								


								<table class="table table-hover table-nomargin table-bordered usertable dataTable">
									<thead>
										
										<tr>
											
											<th width="150">
											<?php echo $this->Paginator->sort('first_name', 'Employee', array('escape' => false,'direction' => 'desc'));?>
												</th>
												
												<th width="120" >
											<?php echo $this->Paginator->sort('start_time', 'Start Time', array('escape' => false,'direction' => 'desc'));?>
												</th>
													
												<th width="120">
											<?php echo $this->Paginator->sort('end_time', 'End Time', array('escape' => false,'direction' => 'desc'));?>
												</th>
												
<th width="150">
											<?php echo $this->Paginator->sort('grace_time', 'Grace Time', array('escape' => false,'direction' => 'desc'));?>
												</th>												
										
																						
										
												
												<th width="110">
											<?php echo $this->Paginator->sort('created_date', 'Created', array('escape' => false,'direction' => 'desc'));?>
												</th>
											
											
											<th width="50">Options</th>
										</tr>
									</thead>
									<tbody>
									
										
									
										<?php  foreach($timing_data as $timing):?>
										
										<tr>
											
											<td><?php echo ucwords($timing['HrEmployee']['first_name'].' '.$timing['HrEmployee']['last_name']);?></td>
											
														<td><?php echo $this->Functions->format_time_show($timing['HrOfficeTiming']['start_time']);?></td>
														
															<td><?php echo $this->Functions->format_time_show($timing['HrOfficeTiming']['end_time']);?></td>
															
															<td><?php 
															if($timing['HrOfficeTiming']['grace_time'] >= 0 && !empty($timing['HrOfficeTiming']['id'])):
															echo $timing['HrOfficeTiming']['grace_time'].' mins.';
															endif;
															 ?></td>
															
															
											
											<td><?php echo $this->Functions->format_date($timing['HrOfficeTiming']['created_date']);?></td>
										
									
											
											<td class='hidden-480'>
											
									<?php if(!empty($timing['HrOfficeTiming']['id'])):?>
											<a  href="<?php echo $this->webroot;?>hrofficetiming/edit_timing/<?php echo $timing['HrEmployee']['id'];?>/<?php echo $timing['HrOfficeTiming']['id'];?>/?action=view" class="btn iframeBox" val="45_60" rel="tooltip" title="View"><i class="icon-search"></i></a>
									<?php else: ?>		
												<a  href="<?php echo $this->webroot;?>hrofficetiming/edit_timing/<?php echo $timing['HrEmployee']['id'];?>/<?php echo $timing['HrOfficeTiming']['id'];?>/?action=edit" class="btn iframeBox" val="45_60" rel="tooltip" title="Edit"><i class="icon-edit"></i></a>
									<?php endif; ?>				
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
						<input type="hidden" value="<?php echo $this->webroot;?>hrofficetiming/" id="webroot">
						 <?php echo $this->Form->end(); ?>
						</div>
					</div>
				</div>
					
					
				</div>
		
			
			</div>
			

		</div>	
			
		
		
		
		
				
		


