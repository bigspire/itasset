<?php echo $this->element('hr_menu'); ?>
		
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Poll</h1>
						
						
					</div>
				
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>hrhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						
						
						<li>
							<a href="<?php echo $this->webroot;?>hrpoll/">Poll</a>
							
						</li>
						
						
					</ul>
					
				</div>
				
				
				
				<?php echo $this->Session->flash();?>
				
					<div class="row-fluid  footer_div" >
					<div class="span12">
						<div class="box box-bordered box-color">
						
						<div class="box-title">
								<h3><i class="icon-list"></i> Poll </h3>
							</div>
							
						

						<?php echo $this->Form->create('HrPoll', array('name' => '', 'type' => '', 'id' => 'formID', 'class' => '')); ?>
							<div class="box-content">
							
						<div class="dataTables_wrapper">
						
				<div class="" id="DataTables_Table_8_filter"  style="padding:15px">
				
				<span>Search:</span>  
				
				<?php echo $this->Form->input('keyword', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-large', 'value' => $this->params->query['keyword'],  'id' => 'SearchText', 'required' => false, 'autocomplete' => 'off', 'placeholder' => 'Search here...', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												
		
				
				
											
											<input type="submit" value="Search" class="btn btn-primary" style="margin-bottom:9px;margin-left:4px;">
											
													<a href="<?php echo $this->webroot;?>hrpoll/"><button style="margin-bottom:9px;margin-left:4px;" type="button" class="btn btn-primary"><i class="icon-refresh"></i> Reset</button></a>
											
					<a href="<?php echo $this->webroot;?>hrpoll/create_poll/"><button type="button" class="btn btn-primary" style="float:right"><i class="icon-plus"></i> Add Poll</button></a>
						
								</div>			
								
								
<div id="dialog-confirm" title="Confirmation!" class="dn">
	<p>Are you sure you want to delete?</p>
</div>

<input type="hidden" id="del_url" value="<?php echo $this->webroot;?>hrpoll/delete_poll/"/>
								<table class="table table-hover table-nomargin table-bordered usertable dataTable">
									<thead>
										
										<tr>
											
											<th>
											<?php echo $this->Paginator->sort('ques', 'Question', array('escape' => false,'direction' => 'desc'));?>
												</th>
												
												<th width="350">
										Options
												</th>
													
											
										
												
												<th>
											<?php echo $this->Paginator->sort('created_on', 'Created', array('escape' => false,'direction' => 'desc'));?>
												</th>
											
											<th>Status</th>
											<th>Options</th>
										</tr>
									</thead>
									<tbody>
									
										
									
										<?php  foreach($poll_data as $poll):?>
										
										<tr>
											
											<td width="400"><?php echo $poll['HrPoll']['ques'];?></td>
											
														<td><?php echo str_replace(',', ', ', $poll[0]['options']);?></td>
											
											<td><?php echo $this->Functions->format_date($poll['HrPoll']['created_on']);?></td>
											<td><?php echo $this->Functions->show_status($poll['HrPoll']['status']);?></td>
											<td class='hidden-480'>
											
											
											
											
												<a href="<?php echo $this->webroot;?>hrpoll/view_poll/<?php echo $poll['HrPoll']['id'];?>/<?php echo $poll[0]['tot_votes']; ?>" class="btn" rel="tooltip" title="View"><i class="icon-search"></i></a>
												
											<?php //if($poll[0]['tot_votes'] == 0):?>
												<a href="<?php echo $this->webroot;?>hrpoll/edit_poll/<?php echo $poll['HrPoll']['id'];?>/" class="btn" rel="tooltip" title="Edit"><i class="icon-edit"></i></a>
												<?php //endif;  ?>
												
												<a href="javascript:void(0);" name="<?php echo $poll['HrPoll']['id'];?>" class="btn delRec" rel="tooltip" title="Delete"><i class="icon-remove"></i></a>
												<?php if($poll[0]['tot_votes'] > 0):?>	
												<a href="<?php echo $this->webroot;?>hrpoll/view_result/<?php echo $poll['HrPoll']['id'];?>/" class="btn iframeBox" val="40_40" rel="tooltip" title="Result"><i class="icon-thumbs-up"></i></a>
												<?php endif; ?>
											</td>
										</tr>
										
									<?php endforeach; ?>
									</tbody>
								</table>
								

								<?php echo $this->element('paging');?>
								
								




								
							</div>	

							</div>
						
						<input type="hidden" value="<?php echo $this->webroot;?>hrpoll/" id="webroot">
						 <?php echo $this->Form->end(); ?>
						</div>
					</div>
				</div>
					
					
				</div>
		
			
			</div>
			

		</div>	
			
		
		
		
		
				
		


