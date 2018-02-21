<?php echo $this->element('fin_menu'); ?>
		
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Project Contacts</h1>
						
						
					</div>
				
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>finhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						
						
						<li>
							<a href="<?php echo $this->webroot;?>tskprojectcontacts/">Project Contacts</a>
							
						</li>
						
						
					</ul>
					
				</div>
				
				
				
				<?php echo $this->Session->flash();?>
				
					<div class="row-fluid  footer_div" >
					<div class="span12">
						<div class="box box-bordered box-color">
						
						<div class="box-title">
								<h3><i class="icon-list"></i> Project Contacts</h3>
							</div>
							
						

						<?php echo $this->Form->create('TskProjectContact', array('name' => '', 'type' => '', 'id' => 'formID', 'class' => '')); ?>
							<div class="box-content">
							
						<div class="dataTables_wrapper">
						
				<div class="" id="DataTables_Table_8_filter"  style="padding:15px">
				
				<span>Search:</span>  
				
				<?php echo $this->Form->input('SearchText', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-large', 'value' => $this->params->query['keyword'],  'id' => 'SearchText', 'required' => false, 'autocomplete' => 'off', 'placeholder' => 'Search here...', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												
		
				
				
											
											<input type="submit" value="Search" class="btn btn-primary" style="margin-bottom:9px;margin-left:4px;">
											
													<a href="<?php echo $this->webroot;?>tskprojectcontacts/"><button style="margin-bottom:9px;margin-left:4px;" type="button" class="btn btn-primary"><i class="icon-refresh"></i> Reset</button></a>
											
					<a href="<?php echo $this->webroot;?>tskprojectcontacts/create_project_contact/"><button type="button" class="btn btn-primary" style="float:right"><i class="icon-plus"></i> Add Project Contact</button></a>
						
								</div>			
								
								
<div id="dialog-confirm" title="Confirmation!" class="dn">
	<p>Are you sure you want to delete?</p>
</div>

<input type="hidden" id="del_url" value="<?php echo $this->webroot;?>tskprojectcontacts/delete_project_contact/"/>
								<table class="table table-hover table-nomargin table-bordered usertable dataTable">
									<thead>
										
										<tr>
											
											<th>
											<?php echo $this->Paginator->sort('project_name', 'Project', array('escape' => false,'direction' => 'desc'));?>
												</th>
											
										
												<th>
											<?php echo $this->Paginator->sort('first_name', 'Contact Person', array('escape' => false,'direction' => 'desc'));?>
												</th>
													<th>
											<?php echo $this->Paginator->sort('designation1', 'Designation', array('escape' => false,'direction' => 'desc'));?>
												</th>
												<th>
											<?php echo $this->Paginator->sort('landline1', 'Landline', array('escape' => false,'direction' => 'desc'));?>
												</th>
												<th>
											<?php echo $this->Paginator->sort('phone1', 'Mobile', array('escape' => false,'direction' => 'desc'));?>
												</th>
												<th>
											<?php echo $this->Paginator->sort('created_date', 'Created', array('escape' => false,'direction' => 'desc'));?>
												</th>
											
											
											<th>Options</th>
										</tr>
									</thead>
									<tbody>
									
										
									
										<?php  foreach($proj_cont_data as $contact):?>
										
										<tr>
											
											<td><?php echo $contact['TskProject']['project_name'];?></td>
										
											<td><?php echo $contact['TskProjectContact']['first_name1'].' '.$contact['TskProjectContact']['last_name1'];?></td>
											
												<td><?php echo $contact['TskProjectContact']['designation1'];?></td>
													<td><?php echo $contact['TskProjectContact']['landline1'];?></td>
													<td><?php echo $contact['TskProjectContact']['phone1'];?></td>

											<td><?php echo $this->Functions->format_date($contact['TskProjectContact']['created_date']);?></td>
											
											<td class='hidden-480'>
												<!--a href="<?php echo $this->webroot;?>tskprojectcontacts/view_project_contact/<?php echo $contact['TskProjectContact']['id'];?>/" class="btn" rel="tooltip" title="View"><i class="icon-search"></i></a-->
												<a href="<?php echo $this->webroot;?>tskprojectcontacts/edit_project_contact/<?php echo $contact['TskProjectContact']['id'];?>/" class="btn" rel="tooltip" title="Edit"><i class="icon-edit"></i></a>
												<a href="javascript:void(0);" name="<?php echo $contact['TskProjectContact']['id'];?>" class="btn delRec" rel="tooltip" title="Delete"><i class="icon-remove"></i></a>
											</td>
										</tr>
										
									<?php endforeach; ?>
									</tbody>
								</table>
								

								<?php echo $this->element('paging');?>
								
								




								
							</div>	

							</div>
						<input type="hidden" value="1" id="SearchKeywords">
						<input type="hidden" value="<?php echo $this->webroot;?>tskprojectcontacts/" id="webroot">
						 <?php echo $this->Form->end(); ?>
						</div>
					</div>
				</div>
					
					
				</div>
		
			
			</div>
			

		</div>	
			
		
		
		
		
				
		


