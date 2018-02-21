<?php echo $this->element('hr_menu'); ?>
		
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Attendance Change</h1>
						
						
					</div>
				
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>hrhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						
						
						<li>
							<a href="<?php echo $this->webroot;?>hrattchange/">Attendance Change</a>
							
						</li>
						
						
					</ul>
					
				</div>
				
				
				
				<?php echo $this->Session->flash();?>
				
				<?php echo $this->element('att_change_status');?>
					
					<div class="row-fluid footer_div" >
					
					
					
					<div class="span12">
					
					
						<div class="box box-bordered box-color">
						
						<div class="box-title">
								<h3><i class="icon-list"></i> Attendance Change</h3>
							</div>
							
						

						<?php echo $this->Form->create('HrAttChange', array('name' => '', 'type' => '', 'id' => 'formID', 'class' => '')); ?>
							<div class="box-content">
							
						<div class="dataTables_wrapper">
						
				<div class="" id="DataTables_Table_8_filter"  style="padding:15px">
				
				<span>Search:</span>  
				<?php echo $this->Form->input('keyword', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-large', 'value' => $this->params->query['keyword'],   'required' => false, 'autocomplete' => 'off', 'placeholder' => 'Search here...', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
				
<span>From:</span>  
				<?php echo $this->Form->input('from', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-small datepick', 'value' => $this->params->query['from'],   'required' => false,  'placeholder' => 'From', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 

<span>To:</span>  
				<?php echo $this->Form->input('to', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-small datepick', 'value' => $this->params->query['to'],   'required' => false,  'placeholder' => 'To', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 				
	
				
											
											<button class="btn btn-primary" style="margin-bottom:9px;margin-left:4px;">Search</button>
											
								<a href="<?php echo $this->webroot;?>hrattchange/"><button style="margin-bottom:9px;margin-left:4px;" type="button" class="btn btn-primary"><i class="icon-refresh"></i> Reset</button></a>
								
								
								
					<a href="<?php echo $this->webroot;?>hrattchange/change_attendance/" ><button type="button" class="btn btn-primary" style="float:right"><i class="icon-plus"></i> Request Attendance Change</button></a>
					
								</div>			
								
								

								<table class="table table-hover table-nomargin table-bordered usertable dataTable">
									<thead>
										
										<tr>
										<th width="110">
							
											<?php echo $this->Paginator->sort('att_date', 'Date', array('escape' => false,'direction' => 'desc'));?></th>
											
																	
							<th width="">
							
											<?php echo $this->Paginator->sort('att_type', 'Type', array('escape' => false,'direction' => 'desc'));?></th>
							<th>
							
											<?php echo $this->Paginator->sort('in_time', 'In Time', array('escape' => false,'direction' => 'desc'));?></th>
											<th>
											<?php echo $this->Paginator->sort('out_time', 'Out Time', array('escape' => false,'direction' => 'desc'));?></th>
																					
										
											
											<th width="400"><?php echo $this->Paginator->sort('reason', 'Reason', array('escape' => false,'direction' => 'desc'));?></th>
											<th width="110">	
										<?php echo $this->Paginator->sort('created_date', 'Created', array('escape' => false,'direction' => 'desc'));?></th>
										
											<th width="120">Status</th>
											<!--th width="">Pay Status</th-->
											<th>View</th>
										</tr>
									</thead>
									<tbody>
									
										
									
										<?php  foreach($att_data as $att):?>
										
										<tr>
											<td><?php echo $this->Functions->format_date($att['HrAttChange']['att_date']);?></td>	
											
											<td><?php echo $this->Functions->get_att_type($att['HrAttChange']['att_type']);?></td>
											
											<td><?php echo $this->Functions->format_time_show($att['HrAttChange']['in_time']);?></td>
													
											<td><?php echo $this->Functions->format_time_show($att['HrAttChange']['out_time']);?></td>
											
								
												<td><?php echo  $this->Functions->string_truncate($att['HrAttChange']['reason'], 65);?></td>
											<td><?php echo $this->Functions->format_date($att['HrAttChange']['created_date']);?></td>
											<td>
											
											<?php echo $this->Functions->format_status($att[0]['st_status'],$att[0]['st_created'],$att[0]['st_user'],$att[0]['st_modified']); ?>
											
									
											
											</td>
											
											<td>											
											
												<a href="<?php echo $this->webroot;?>hrattchange/view_change/<?php echo $att['HrAttChange']['id'];?>/" class="btn" rel="tooltip" title="View"><i class="icon-search"></i></a>
												
									
											</td>
										</tr>
									<?php endforeach; ?>
									</tbody>
								</table>
								

								<?php echo $this->element('paging');?>
								
								




								
							</div>	

							</div>
						<!--input type="hidden" value="1" id="SearchKeywords"-->
						<input type="hidden" value="<?php echo $this->webroot;?>hrattchange/" id="webroot">
						 <?php echo $this->Form->end(); ?>
						</div>
					</div>
				</div>
					
					
				</div>
		
			
			</div>
			

		</div>	
			
		
	
		


