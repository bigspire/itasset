<?php echo $this->element('hr_menu'); ?>
		
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Message</h1>
						
						
					</div>
				
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>hrhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						
						
						<li>
							<a href="<?php echo $this->webroot;?>hrmessage/">Message</a>
							
						</li>
						
						
					</ul>
					
				</div>
				
				
				
				<?php echo $this->Session->flash();?>
				
					<div class="row-fluid  footer_div" >
					<div class="span12">
						<div class="box box-bordered box-color">
						
						<div class="box-title">
								<h3><i class="icon-list"></i> Message </h3>
							</div>
							
						

						<?php echo $this->Form->create('HrMessage', array('name' => '', 'type' => '', 'id' => 'formID', 'class' => '')); ?>
							<div class="box-content">
							
						<div class="dataTables_wrapper">
						
				<div class="" id="DataTables_Table_8_filter"  style="padding:15px">
				
				<span>Search:</span>  
				
				<?php echo $this->Form->input('keyword', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-large', 'value' => $this->params->query['keyword'],  'required' => false, 'autocomplete' => 'off', 'placeholder' => 'Search here...', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												
		
				
				
											
											<input type="submit" value="Search" class="btn btn-primary" style="margin-bottom:9px;margin-left:4px;">
											
													<a href="<?php echo $this->webroot;?>hrmessage/"><button style="margin-bottom:9px;margin-left:4px;" type="button" class="btn btn-primary"><i class="icon-refresh"></i> Reset</button></a>
											
					<a href="<?php echo $this->webroot;?>hrmessage/create_message/"><button type="button" class="btn btn-primary" style="float:right"><i class="icon-plus"></i> Add Message</button></a>
						
								</div>			
								
								
<div id="dialog-confirm" title="Confirmation!" class="dn">
	<p>Are you sure you want to delete?</p>
</div>

<input type="hidden" id="del_url" value="<?php echo $this->webroot;?>hrmessage/delete_message/"/>
								<table class="table table-hover table-nomargin table-bordered usertable dataTable">
									<thead>
										
										<tr>
											
											<th width="150">
											<?php echo $this->Paginator->sort('title', 'Title', array('escape' => false,'direction' => 'desc'));?>
												</th>
												
												<th width="250">
											<?php echo $this->Paginator->sort('desc', 'Description', array('escape' => false,'direction' => 'desc'));?>
												</th>
												<th width="100">
											<?php echo $this->Paginator->sort('show_type', 'Show To', array('escape' => false,'direction' => 'desc'));?>
												</th>		
											<th width="100">
											<?php echo $this->Paginator->sort('display_type', 'Publish Status', array('escape' => false,'direction' => 'desc'));?>
												</th>
											<th width="80">
											Start
												</th>
												<th width="80">
											End
												</th>
												
												<th width="80">
											<?php echo $this->Paginator->sort('created_date', 'Created', array('escape' => false,'direction' => 'desc'));?>
												</th>
											
											<th>Status</th>
											<th width="140">Options</th>
										</tr>
									</thead>
									<tbody>
									
										
									
										<?php  foreach($latest_data as $latest):?>
										
										<tr>
											
											<td><?php echo $latest['HrMessage']['title'];?></td>
											
														<td><?php echo $this->Functions->string_truncate($latest['HrMessage']['desc'], 65);?></td>
											<td><?php echo $latest['HrMessage']['show_type'] == 'A' ? 'All Users' : 'Approver\'s Only';?></td>
											<td><?php echo $latest['HrMessage']['display_type'] == 'M' ? 'Monthly' : 'Particular Date';?></td>
											<td><?php echo $latest['HrMessage']['display_type'] == 'M' ? $latest['HrMessage']['start_day'] : $this->Functions->format_date($latest['HrMessage']['start_date']);?></td>
											<td><?php echo $latest['HrMessage']['display_type'] == 'M' ? $latest['HrMessage']['end_day'] : $this->Functions->format_date($latest['HrMessage']['end_date']);?></td>
											<td><?php echo $this->Functions->format_date($latest['HrMessage']['created_date']);?></td>
											<td><?php echo $this->Functions->show_status($latest['HrMessage']['status']);?></td>
											<td class='hidden-480'>
											
											<?php if(!empty($latest['HrMessage']['attachment'])): ?>
											<a href="<?php echo $this->webroot;?>hrmessage/download_update/<?php echo $latest['HrMessage']['attachment'];?>/" class="btn" rel="tooltip" title="Download"><i class="icon-download"></i></a>
											<?php endif; ?>
											
											
												<a href="<?php echo $this->webroot;?>hrmessage/view_message/<?php echo $latest['HrMessage']['id'];?>/" class="btn" rel="tooltip" title="View"><i class="icon-search"></i></a>
												<a href="<?php echo $this->webroot;?>hrmessage/edit_message/<?php echo $latest['HrMessage']['id'];?>/" class="btn" rel="tooltip" title="Edit"><i class="icon-edit"></i></a>
												<a href="javascript:void(0);" name="<?php echo $latest['HrMessage']['id'];?>" class="btn delRec" rel="tooltip" title="Delete"><i class="icon-remove"></i></a>
											</td>
										</tr>
										
									<?php endforeach; ?>
									</tbody>
								</table>
								

								<?php echo $this->element('paging');?>
								
								




								
							</div>	

							</div>
					
						<input type="hidden" value="<?php echo $this->webroot;?>hrmessage/" id="webroot">
						 <?php echo $this->Form->end(); ?>
						</div>
					</div>
				</div>
					
					
				</div>
		
			
			</div>
			

		</div>	
			
		
		
		
		
				
		


