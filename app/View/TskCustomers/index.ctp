<?php echo $this->element('fin_menu'); ?>
		
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Customers (Companies)</h1>
						
						
					</div>
				
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>finhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						
						
						<li>
							<a href="<?php echo $this->webroot;?>tskcustomers/">Customers</a>
							
						</li>
						
						
					</ul>
					
				</div>
				
				
				
				<?php echo $this->Session->flash();?>
				
					<div class="row-fluid footer_div" >
					<div class="span12">
						<div class="box box-bordered box-color">
						
						<div class="box-title">
								<h3><i class="icon-list"></i> Customers</h3>
							</div>
							
						

						<?php echo $this->Form->create('TskCustomer', array('name' => '', 'type' => '', 'id' => 'formID', 'class' => '')); ?>
							<div class="box-content">
							
						<div class="dataTables_wrapper">
						
				<div class="" id="DataTables_Table_8_filter"  style="padding:15px">
				
				<span>Search:</span>  
				
				<?php echo $this->Form->input('SearchText', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-large', 'value' => $this->params->query['keyword'],  'id' => 'SearchText', 'required' => false, 'autocomplete' => 'off', 'placeholder' => 'Search here...', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												
		
				
				
											
											<input type="submit" value="Search" class="btn btn-primary" style="margin-bottom:9px;margin-left:4px;">
											
													<a href="<?php echo $this->webroot;?>tskcustomers/"><button style="margin-bottom:9px;margin-left:4px;" type="button" class="btn btn-primary"><i class="icon-refresh"></i> Reset</button></a>
											
					<a href="<?php echo $this->webroot;?>tskcustomers/create_customer/"><button type="button" class="btn btn-primary" style="float:right"><i class="icon-plus"></i> Add Customer</button></a>
						
								</div>			
								
								
<div id="dialog-confirm" title="Confirmation!" class="dn">
	<p>Are you sure you want to delete?</p>
</div>

<input type="hidden" id="del_url" value="<?php echo $this->webroot;?>tskcustomers/delete_customer/"/>
								<table class="table table-hover table-nomargin table-bordered usertable dataTable">
									<thead>
										
										<tr>
											
											<th>
											<?php echo $this->Paginator->sort('company_name', 'Company', array('escape' => false,'direction' => 'desc'));?>
												</th>
											
											<th>
											<?php echo $this->Paginator->sort('email', 'Email', array('escape' => false,'direction' => 'desc'));?>
												</th>
												<th>
											<?php echo $this->Paginator->sort('phone', 'Phone', array('escape' => false,'direction' => 'desc'));?>
												</th>
											<th width="100"><?php echo $this->Paginator->sort('city', 'City', array('escape' => false,'direction' => 'desc'));?></th>
											
												<th width="100"><?php echo $this->Paginator->sort('type', 'Type', array('escape' => false,'direction' => 'desc'));?></th>
												
											
											<th width="120"> <?php echo $this->Paginator->sort('created_date', 'Created Date', array('escape' => false,'direction' => 'desc'));?></th>
											<th>Status</th>
											<th width="120">Options</th>
										</tr>
									</thead>
									<tbody>
									
										
									
										<?php  foreach($cust_data as $cust):?>
										
										<tr>
											
											<td><?php echo $cust['TskCustomer']['company_name'];?></td>
											<td><?php echo $cust['TskCustomer']['email'];?></td>
												<td><?php echo $cust['TskCustomer']['phone'];?></td>
											<td><?php echo $cust['TskCustomer']['city'];?></td>
											<td><?php echo $this->Functions->company_type($cust['TskCustomer']['type']);?></td>
											<td><?php echo $this->Functions->format_date($cust['TskCustomer']['created_date']);?></td>
											<td><?php echo $this->Functions->show_status($cust['TskCustomer']['status']);?></td>
											<td class='hidden-480'>
												<a href="<?php echo $this->webroot;?>tskcustomers/view_customer/<?php echo $cust['TskCustomer']['id'];?>/" class="btn" rel="tooltip" title="View"><i class="icon-search"></i></a>
												<a href="<?php echo $this->webroot;?>tskcustomers/edit_customer/<?php echo $cust['TskCustomer']['id'];?>/" class="btn" rel="tooltip" title="Edit"><i class="icon-edit"></i></a>
												<a href="javascript:void(0);" name="<?php echo $cust['TskCustomer']['id'];?>" class="btn delRec" rel="tooltip" title="Delete"><i class="icon-remove"></i></a>
											</td>
										</tr>
										
									<?php endforeach; ?>
									</tbody>
								</table>
								

								<?php echo $this->element('paging');?>
								
								




								
							</div>	

							</div>
						<input type="hidden" value="1" id="SearchKeywords">
						<input type="hidden" value="<?php echo $this->webroot;?>tskcustomers/" id="webroot">
						 <?php echo $this->Form->end(); ?>
						</div>
					</div>
				</div>
					
					
				</div>
		
			
			</div>
			

		</div>	
			
		
		
		
		
				
		


