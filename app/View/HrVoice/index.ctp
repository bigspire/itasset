<?php echo $this->element('hr_menu'); ?>
		
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Voice</h1>
						
						
					</div>
				
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>hrhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						
						
						<li>
							<a href="<?php echo $this->webroot;?>hrvoice/">Voice</a>
							
						</li>
						
						
					</ul>
					
				</div>
				
				
				
				<?php echo $this->Session->flash();?>
				
					<div class="row-fluid  footer_div" >
					<div class="span12">
						<div class="box box-bordered box-color">
						
						<div class="box-title">
								<h3><i class="icon-list"></i> Voice </h3>
							</div>
							
						

						<?php echo $this->Form->create('HrVoice', array('name' => '', 'type' => '', 'id' => 'formID', 'class' => '')); ?>
							<div class="box-content">
							
						<div class="dataTables_wrapper">
						
				<div class="" id="DataTables_Table_8_filter"  style="padding:15px">
				
				<span>Search:</span>  
				
				<?php echo $this->Form->input('keyword', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-large', 'value' => $this->params->query['keyword'],  'id' => 'SearchText', 'required' => false, 'autocomplete' => 'off', 'placeholder' => 'Search here...', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												
		
				
				
											
											<input type="submit" value="Search" class="btn btn-primary" style="margin-bottom:9px;margin-left:4px;">
											
													<a href="<?php echo $this->webroot;?>hrvoice/"><button style="margin-bottom:9px;margin-left:4px;" type="button" class="btn btn-primary"><i class="icon-refresh"></i> Reset</button></a>
											
					<a href="<?php echo $this->webroot;?>hrvoice/create_voice/"><button type="button" class="btn btn-primary" style="float:right"><i class="icon-plus"></i> Add Voice</button></a>
						
								</div>			
								
								
<div id="dialog-confirm" title="Confirmation!" class="dn">
	<p>Are you sure you want to delete?</p>
</div>

<input type="hidden" id="del_url" value="<?php echo $this->webroot;?>hrvoice/delete_voice/"/>
								<table class="table table-hover table-nomargin table-bordered usertable dataTable">
									<thead>
										
										<tr>
											
											
													<th width="80">
											<?php echo $this->Paginator->sort('start_date', 'Start', array('escape' => false,'direction' => 'desc'));?>
												</th>
	<th width="80">
											<?php echo $this->Paginator->sort('end_date', 'End', array('escape' => false,'direction' => 'desc'));?>
												</th>	
												<th width="450">
										Description
												</th>
												
																					
												
											
											<th width="">
											<?php echo $this->Paginator->sort('person_ans', 'Persons Attended', array('escape' => false,'direction' => 'desc'));?>
												</th>
										
												
												<th width="100">
											<?php echo $this->Paginator->sort('created_date', 'Created', array('escape' => false,'direction' => 'desc'));?>
												</th>
											
											<th>Status</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
									
										
									
										<?php  foreach($voice_data as $voice): ?>
										
										<tr>
											
													<td><?php echo $this->Functions->format_date($voice['HrVoice']['start_date']);?></td>

												<td><?php echo $this->Functions->format_date($voice['HrVoice']['end_date']);?></td>
														<td><?php echo $this->Functions->string_truncate(strip_tags($voice['HrVoice']['desc']), 100);?></td>
									

												
														<td>
														
														<a href="javascript:void(0)"  rel="tooltip" title="<?php echo $voice[0]['employee_name'];?>"><?php echo $voice[0]['person_ans'];?></a>
														
														</td>
											
											<td ><?php echo $this->Functions->format_date($voice['HrVoice']['created_date']);?></td>
											<td><?php echo $this->Functions->show_survey_status($voice['HrVoice']['status'],$voice['HrVoice']['end_date']);?></td>
											<td class='hidden-480'>
											
											
											
											
												<a href="<?php echo $this->webroot;?>hrvoice/view_voice/<?php echo $voice['HrVoice']['id'];?>/<?php echo $voice[0]['tot_votes']; ?>" class="btn" rel="tooltip" title="View"><i class="icon-search"></i></a>
												
											<?php if(empty($voice[0]['person_ans'])):?>
												<a href="<?php echo $this->webroot;?>hrvoice/edit_voice/<?php echo $voice['HrVoice']['id'];?>/" class="btn" rel="tooltip" title="Edit"><i class="icon-edit"></i></a>
												
												
												<a href="javascript:void(0);" name="<?php echo $voice['HrVoice']['id'];?>" class="btn delRec" rel="tooltip" title="Delete"><i class="icon-remove"></i></a>
												<?php endif;  ?>
												
												<?php if($voice[0]['person_ans'] > 0):?>	
												<a href="<?php echo $this->webroot;?>hrvoice/?action=export&id=<?php echo $voice['HrVoice']['id'];?>" class="btn" val="40_40" rel="tooltip" title="Export"><i class="icon-download"></i></a>
												<?php endif; ?>
											</td>
										</tr>
										
									<?php endforeach; ?>
									</tbody>
								</table>
								

								<?php echo $this->element('paging');?>
								
								




								
							</div>	

							</div>
						
						<input type="hidden" value="<?php echo $this->webroot;?>hrvoice/" id="webroot">
						 <?php echo $this->Form->end(); ?>
						</div>
					</div>
				</div>
					
					
				</div>
		
			
			</div>
			

		</div>	
			
		
		
		
		
				
		


