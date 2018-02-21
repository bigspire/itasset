<?php echo $this->element('hr_menu'); ?>
		
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Company</h1>
						
						
					</div>
				
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>hrhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						
						
						<li>
							<a href="<?php echo $this->webroot;?>hrcompany/">Company</a>
							
						</li>
						
						
					</ul>
					
				</div>
				
				
				
				<?php echo $this->Session->flash();?>
				
					<div class="row-fluid  footer_div" >
					<div class="span12">
						<div class="box box-bordered box-color">
						
						<div class="box-title">
								<h3><i class="icon-list"></i> Company</h3>
							</div>
							
						

						<?php echo $this->Form->create('HrCompany', array('name' => '', 'type' => '', 'id' => 'formID', 'class' => '')); ?>
							<div class="box-content">
							
						<div class="dataTables_wrapper">
						
			
								
<div id="dialog-confirm" title="Confirmation!" class="dn">
	<p>Are you sure you want to delete?</p>
</div>

<input type="hidden" id="del_url" value="<?php echo $this->webroot;?>hrcompany/create_customer/"/>
								<table class="table table-hover table-nomargin table-bordered usertable dataTable">
									<thead>
										
										<tr>
											
											<th>
											<?php echo $this->Paginator->sort('company_name', 'Company', array('escape' => false,'direction' => 'desc'));?>
												</th>
													<th width="100"><?php echo $this->Paginator->sort('city', 'City', array('escape' => false,'direction' => 'desc'));?></th>
													<th width="100"><?php echo $this->Paginator->sort('state_name', 'State', array('escape' => false,'direction' => 'desc'));?></th>
											<th>
											<?php echo $this->Paginator->sort('landline', 'Landline', array('escape' => false,'direction' => 'desc'));?>
												</th>
												<th>
											<?php echo $this->Paginator->sort('created_date', 'Created', array('escape' => false,'direction' => 'desc'));?>
											</th>
											<th>
												<?php echo $this->Paginator->sort('modified_date', 'Modified', array('escape' => false,'direction' => 'desc'));?>
												</th>
									
											
												
											
										
										
											<th>Options</th>
										</tr>
									</thead>
									<tbody>
									
										
									
										<?php  foreach($cust_data as $cust):?>
										
										<tr>
											
											<td><?php echo $cust['HrCompany']['company_name'];?></td>
											<td><?php echo $cust['HrCompany']['city'];?></td>
												<td><?php echo $cust['State']['state_name'];?></td>
												<td><?php echo $cust['HrCompany']['landline'];?></td>									
											<td><?php echo $this->Functions->format_date($cust['HrCompany']['created_date']);?></td>
												<td><?php echo $this->Functions->format_date($cust['HrCompany']['modified_date']);?></td>
											<td class='hidden-480'>
												<a href="<?php echo $this->webroot;?>hrcompany/view_company/<?php echo $cust['HrCompany']['id'];?>/" class="btn" rel="tooltip" title="View"><i class="icon-search"></i></a>
												<a href="<?php echo $this->webroot;?>hrcompany/edit_company/<?php echo $cust['HrCompany']['id'];?>/" class="btn" rel="tooltip" title="Edit"><i class="icon-edit"></i></a>
											
											</td>
										</tr>
										
									<?php endforeach; ?>
									</tbody>
								</table>
								

								<?php echo $this->element('paging');?>
								
							</div>	

							</div>
						<input type="hidden" value="1" id="SearchKeywords">
						<input type="hidden" value="<?php echo $this->webroot;?>hrcompany/" id="webroot">
						 <?php echo $this->Form->end(); ?>
						</div>
					</div>
				</div>
					
					
				</div>
		
			
			</div>
			

		</div>	
			
		
		
		
		
				
		


