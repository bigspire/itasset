<?php echo $this->element('hr_menu'); ?>
		
	<div class="container-fluid" id="content" style="overflow:auto">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Approve Profile Change</h1>
						
						
					</div>
				
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>hrhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						
						
						<li>
							<a href="<?php echo $this->webroot;?>hrprofilechange/">Approve Profile Change</a>
							
						</li>
						
						
					</ul>
					
				</div>
				
				
				
			<?php echo $this->Session->flash();?>
				
					<div class="row-fluid  footer_div" >
					<div class="span12">
						<div class="box box-bordered box-color">
						
						<div class="box-title">
								<h3><i class="icon-list"></i> Approve Profile Change </h3>
							</div>
							
						

						<?php echo $this->Form->create('HrProfileChange', array('name' => '', 'type' => '', 'id' => 'formID', 'class' => '')); ?>
							<div class="box-content">
							
						<div class="dataTables_wrapper">
						
				<div class="" id="DataTables_Table_8_filter"  style="padding:15px">
				
				<span>Search:</span>  
				
				<?php echo $this->Form->input('keyword', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-large', 'value' => $this->params->query['keyword'],  'id' => 'SearchText', 'required' => false, 'autocomplete' => 'off', 'placeholder' => 'Search here...', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												
		
				
				
											
											<input type="submit" value="Search" class="btn btn-primary" style="margin-bottom:9px;margin-left:4px;">
											
													<a href="<?php echo $this->webroot;?>hrprofilechange/"><button style="margin-bottom:9px;margin-left:4px;" type="button" class="btn btn-primary"><i class="icon-refresh"></i> Reset</button></a>
											
					
						
								</div>			
								
								
<div id="dialog-confirm" title="Confirmation!" class="dn">
	<p>Are you sure you want to delete?</p>
</div>

<input type="hidden" id="del_url" value="<?php echo $this->webroot;?>hrprofilechange/delete_bank/"/>
								<table class="table table-hover table-nomargin table-bordered usertable dataTable">
									<thead>
										
										<tr>
											
											<th width="150">
											<?php echo $this->Paginator->sort('first_name', 'Employee', array('escape' => false,'direction' => 'desc'));?>
												</th>
												
												<th width="120" >
											<?php echo $this->Paginator->sort('type', 'Profile Type', array('escape' => false,'direction' => 'desc'));?>
												</th>
													
												<th width="420">
											<?php echo $this->Paginator->sort('desc', 'Description', array('escape' => false,'direction' => 'desc'));?>
												</th>
												
											
												
												<th width="110">
											<?php echo $this->Paginator->sort('created_date', 'Created', array('escape' => false,'direction' => 'desc'));?>
												</th>
											<th width="50">Pending</th>
											
											<th width="50">Status</th>
											
											<th width="50">Options</th>
										</tr>
									</thead>
									<tbody>
									
										
									
										<?php  foreach($chg_data as $chg):?>
										
										<tr>
											
											<td><?php echo ucwords($chg['User']['first_name'].' '.$chg['User']['last_name']);?></td>
											
														<td><?php echo $this->Functions->change_req_type($chg['HrProfileChange']['type']);?></td>
														
															<td><?php echo $this->Functions->string_truncate($chg['HrProfileChange']['desc'], 65);?></td>
															
															<td><?php echo $this->Functions->format_date($chg['HrProfileChange']['created_date']);?></td>
															
											<td><?php
											if($chg['HrProfileChange']['status'] == 'W'):							
											echo $this->Functions->time_diff($chg['HrProfileChange']['created_date'], 0);endif;
											?></td>
															
															
												<td><?php echo $this->Functions->show_change_status($chg['HrProfileChange']['status']);?></td>
										
										
									
											
											<td class='hidden-480'>
											
									
												<?php if($chg['HrProfileChange']['status'] == 'W') :?>
											
												<a  href="<?php echo $this->webroot;?>hrprofilechange/update_request/<?php echo $chg['User']['id'];?>/<?php echo $chg['HrProfileChange']['id'];?>" class="btn iframeBox" val="45_65" rel="tooltip" title="Update"><i class="icon-edit"></i></a>
											   
											   <?php else: ?>										   
											   
											
												<a  href="<?php echo $this->webroot;?>hrprofilechange/view_request/<?php echo $chg['User']['id'];?>/<?php echo $chg['HrProfileChange']['id'];?>" class="btn iframeBox" val="45_65" rel="tooltip" title="View"><i class="icon-search"></i></a>
											   
											   <?php endif; ?>
											   
											</td>
										</tr>
										
									<?php endforeach; ?>
									</tbody>
								</table>
								<?php echo $this->Form->input('edit_bank_acc', array('id' => 'edit_bank_acc', 'type' => 'hidden'));?>

								<input type="hidden" id="overlayclose" value="1">
								
								<?php echo $this->element('paging');?>
								
								




								
							</div>	

							</div>
						<input type="hidden" value="1" id="SearchKeywords">
						<input type="hidden" value="<?php echo $this->webroot;?>hrprofilechange/" id="webroot">
						 <?php echo $this->Form->end(); ?>
						</div>
					</div>
				</div>
					
					
				</div>
		
			
			</div>
			

		</div>	
			
		
		
		
		
				
		


