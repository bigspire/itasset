<?php echo $this->element('hr_menu'); ?>
		
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Survey</h1>
						
						
					</div>
				
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>hrhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						
						
						<li>
							<a href="<?php echo $this->webroot;?>hrsurvey/">Survey</a>
							
						</li>
						
						
					</ul>
					
				</div>
				
				
				
				<?php echo $this->Session->flash();?>
				
					<div class="row-fluid  footer_div" >
					<div class="span12">
						<div class="box box-bordered box-color">
						
						<div class="box-title">
								<h3><i class="icon-list"></i> Survey </h3>
							</div>
							
						

						<?php echo $this->Form->create('HrSurvey', array('name' => '', 'type' => '', 'id' => 'formID', 'class' => '')); ?>
							<div class="box-content">
							
						<div class="dataTables_wrapper">
						
				<div class="" id="DataTables_Table_8_filter"  style="padding:15px">
				
				<span>Search:</span>  
				
				<?php echo $this->Form->input('keyword', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-large', 'value' => $this->params->query['keyword'],  'id' => 'SearchText', 'required' => false, 'autocomplete' => 'off', 'placeholder' => 'Search here...', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												
		
				
				
											
											<input type="submit" value="Search" class="btn btn-primary" style="margin-bottom:9px;margin-left:4px;">
											
													<a href="<?php echo $this->webroot;?>hrsurvey/"><button style="margin-bottom:9px;margin-left:4px;" type="button" class="btn btn-primary"><i class="icon-refresh"></i> Reset</button></a>
											
					<a href="<?php echo $this->webroot;?>hrsurvey/create_survey/"><button type="button" class="btn btn-primary" style="float:right"><i class="icon-plus"></i> Add Survey</button></a>
						
								</div>			
								
								
<div id="dialog-confirm" title="Confirmation!" class="dn">
	<p>Are you sure you want to delete?</p>
</div>

<input type="hidden" id="del_url" value="<?php echo $this->webroot;?>hrsurvey/delete_survey/"/>
								<table class="table table-hover table-nomargin table-bordered usertable dataTable">
									<thead>
										
										<tr>
											
											<th>
											<?php echo $this->Paginator->sort('id', '	Survey No.', array('escape' => false,'direction' => 'desc'));?>
												</th>
													<th width="80">
											<?php echo $this->Paginator->sort('start_date', 'Start', array('escape' => false,'direction' => 'desc'));?>
												</th>
	<th width="80">
											<?php echo $this->Paginator->sort('end_date', 'End', array('escape' => false,'direction' => 'desc'));?>
												</th>	
												<th width="350">
										Description
												</th>
												
																					
												<th width="">
											<?php echo $this->Paginator->sort('no_question', 'No. of Questions', array('escape' => false,'direction' => 'desc'));?>
												</th>	
											
											<th width="">
											<?php echo $this->Paginator->sort('person_ans', 'Persons Answered', array('escape' => false,'direction' => 'desc'));?>
												</th>
										
												
												<th width="100">
											<?php echo $this->Paginator->sort('created_date', 'Created', array('escape' => false,'direction' => 'desc'));?>
												</th>
											
											<th>Status</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
									
										
									
										<?php  foreach($survey_data as $survey): ?>
										
										<tr>
											
											<td width=""><?php echo $survey['HrSurvey']['id'];?></td>
													<td><?php echo $this->Functions->format_date($survey['HrSurvey']['start_date']);?></td>

												<td><?php echo $this->Functions->format_date($survey['HrSurvey']['end_date']);?></td>
														<td><?php echo $this->Functions->string_truncate(strip_tags($survey['HrSurvey']['desc']), 100);?></td>
									

												<td><?php echo $survey['HrSurvey']['no_question'];?></td>
														<td>
														
														<a href="javascript:void(0)"  rel="tooltip" title="<?php echo $survey[0]['employee_name'];?>"><?php echo $survey[0]['person_ans'];?></a>
														
														</td>
											
											<td ><?php echo $this->Functions->format_date($survey['HrSurvey']['created_date']);?></td>
											<td><?php echo $this->Functions->show_survey_status($survey['HrSurvey']['status'],$survey['HrSurvey']['end_date']);?></td>
											<td class='hidden-480'>
											
											
											
											
												<a href="<?php echo $this->webroot;?>hrsurvey/view_survey/<?php echo $survey['HrSurvey']['id'];?>/<?php echo $survey[0]['tot_votes']; ?>" class="btn" rel="tooltip" title="View"><i class="icon-search"></i></a>
												
											<?php if(empty($survey[0]['person_ans'])):?>
												<a href="<?php echo $this->webroot;?>hrsurvey/edit_survey/<?php echo $survey['HrSurvey']['id'];?>/" class="btn" rel="tooltip" title="Edit"><i class="icon-edit"></i></a>
												
												
												<a href="javascript:void(0);" name="<?php echo $survey['HrSurvey']['id'];?>" class="btn delRec" rel="tooltip" title="Delete"><i class="icon-remove"></i></a>
												<?php endif;  ?>
												
												<?php if($survey[0]['person_ans'] > 0):?>	
												<a href="<?php echo $this->webroot;?>hrsurvey/?action=export&id=<?php echo $survey['HrSurvey']['id'];?>" class="btn" val="40_40" rel="tooltip" title="Export"><i class="icon-download"></i></a>
												<?php endif; ?>
											</td>
										</tr>
										
									<?php endforeach; ?>
									</tbody>
								</table>
								

								<?php echo $this->element('paging');?>
								
								




								
							</div>	

							</div>
						
						<input type="hidden" value="<?php echo $this->webroot;?>hrsurvey/" id="webroot">
						 <?php echo $this->Form->end(); ?>
						</div>
					</div>
				</div>
					
					
				</div>
		
			
			</div>
			

		</div>	
			
		
		
		
		
				
		


