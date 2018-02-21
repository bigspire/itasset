<?php echo $this->element('hr_menu'); ?>
		
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Approve Gallery</h1>
						
						
					</div>
				
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>hrhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						
						
						<li>
							<a href="<?php echo $this->webroot;?>hrgalapprove/">Approve Gallery</a>
							
						</li>
						
						
					</ul>
					
				</div>
				
				
				
				<?php echo $this->Session->flash();?>
				
					<div class="row-fluid" >
					<div class="span12">
						<div class="box box-bordered box-color">
						
						<div class="box-title">
								<h3><i class="icon-list"></i> Approve Gallery</h3>
							</div>
							
						

						<?php echo $this->Form->create('HrGalApprove', array('name' => '', 'type' => '', 'id' => 'formID', 'class' => '')); ?>
							<div class="box-content">
							
						<div class="dataTables_wrapper">
						
				<div class="" id="DataTables_Table_8_filter"  style="padding:15px">
				
			<span>Search:</span>  <?php echo $this->Form->input('keyword', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-large', 'value' => $this->params->query['keyword'], 'required' => false, 'autocomplete' => 'off', 'placeholder' => 'Search here...', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
		
											

								<span>Employee:</span>		<?php echo $this->Form->input('emp_id', array('div'=> false,'type' => 'select', 'label' => false, 'class' => 'input-xlarge', 'empty' => 'Select', 'selected' => $this->params->query['emp_id'], 'required' => false, 'placeholder' => '', 'style' => "clear:left", 'options' => $empList, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
								
							
											
											<input class="btn btn-primary" type="submit" style="margin-bottom:9px;margin-left:4px;" value="Search"/>
											
				<a href="<?php echo $this->webroot;?>hrgalapprove/"><button style="margin-bottom:9px;margin-left:4px;" type="button" class="btn btn-primary"><i class="icon-refresh"></i> Reset</button></a>
						
								</div>			
								
								

	<table class="table table-hover table-nomargin table-bordered usertable dataTable">
									<thead>
										
										<tr>
										
										<th  width="140">
											<?php echo $this->Paginator->sort('first_name', 'Employee', array('escape' => false,'direction' => 'desc'));?>
											</th>
											<th width="350">
							
											<?php echo $this->Paginator->sort('title', 'Title', array('escape' => false,'direction' => 'desc'));?></th>
											
							<th width="350">
							
											<?php echo $this->Paginator->sort('desc', 'Description', array('escape' => false,'direction' => 'desc'));?></th>
											
										
											
										
											
											
											<th width="110">	
										<?php echo $this->Paginator->sort('created_date', 'Created', array('escape' => false,'direction' => 'desc'));?></th>
											<th  width="80">Pending</th>
										
										
											<th width="120">Status</th>
											<!--th width="">Pay Status</th-->
											<th>View</th>
											
										</tr>
										
								
										
									</thead>
									<tbody>
									
										
									
										<?php  foreach($gal_data  as $key => $gallery):?>
										
										<tr>
										
											<td><?php echo ucfirst($gallery['Home2']['first_name']).' '.ucfirst($gallery['Home2']['last_name']);?></td>
											<td><?php echo $this->Functions->string_truncate($gallery['HrGalApprove']['title'], 30);?></td>
											<td><?php echo $this->Functions->string_truncate($gallery['HrGalApprove']['desc'], 50);?></td>
													
											
								
												
												
											<td><?php echo $this->Functions->format_date($gallery['HrGalApprove']['created_date']);?></td>
											
											<td><?php $pending = strstr($gallery[0]['st_status'], 'W');
											if(!empty($pending)):
											echo $this->Functions->time_diff($gallery['HrGalApprove']['created_date'], 0);endif;
											?>
										
											</td>
										
											
											<td>	<?php echo $this->Functions->format_status($gallery[0]['st_status'],$gallery[0]['st_created'],$gallery[0]['st_user'],$gallery[0]['st_modified']); ?></td>
											
											<?php  
											$icon = $this->Functions->show_verify_icon($show_status[$key]);
											$title = $this->Functions->show_verify_title($show_status[$key]);
											
											
											?>
											
									
											
										
											
											<td>											
											
												<a href="<?php echo $this->webroot;?>hrgalapprove/view_gallery/<?php echo $gallery['HrGalApprove']['id'];?>/<?php echo $gallery[0]['status_id'];?>/<?php echo $gallery['Home2']['id'];?>" class="btn" rel="tooltip" title="<?php echo $title;?>"><i class="<?php echo $icon;?>"></i></a>
												
											
												
									
											</td>
										</tr>
									<?php endforeach; ?>
									</tbody>
								</table>
								

								
								<?php echo $this->element('paging');?>
								
								
							</div>
					</div>
						 <?php echo $this->Form->end(); ?>
						</div>
					</div>
				</div>
					
					
				</div>
		
			
			</div>
			

		</div>	
			
		
		
		
		
				
		


