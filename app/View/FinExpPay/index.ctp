<?php echo $this->element('fin_menu'); ?>
		
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Payable Expense Amount</h1>
						
						
					</div>
				
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>finhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						
						
						<li>
							<a href="<?php echo $this->webroot;?>finexppay/">Payable Expense Amount</a>
							
						</li>
						
						
					</ul>
					
				</div>
				
				
				
				<?php echo $this->Session->flash();?>
				
					<div class="row-fluid footer_div" >
					<div class="span12">
						<div class="box box-bordered box-color">
						
						<div class="box-title">
								<h3><i class="icon-list"></i> Payable Expense Amount</h3>
							</div>
							
						

						<?php echo $this->Form->create('FinExpPay', array('name' => '', 'type' => '', 'id' => 'formID', 'class' => '')); ?>
							<div class="box-content">
							
						<div class="dataTables_wrapper">
						
				<div class="" id="DataTables_Table_8_filter"  style="padding:15px">
				
				<span>Search:</span>  
				<?php echo $this->Form->input('SearchText', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-large', 'value' => $this->params->query['keyword'],  'id' => 'SearchText', 'required' => false, 'autocomplete' => 'off', 'placeholder' => 'Search here...', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												
					<span>Employee:</span>		<?php echo $this->Form->input('emp_id', array('div'=> false,'type' => 'select', 'label' => false, 'class' => 'input-xlarge', 'empty' => 'Select', 'selected' => $this->params->query['emp_id'], 'required' => false, 'placeholder' => '', 'style' => "clear:left", 'options' => $empList, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
					
				<span>Status:</span> 
				
					<?php echo $this->Form->input('status', array('div'=> false,'type' => 'select', 'label' => false, 'class' => 'input-large', 'empty' => 'Select', 'selected' => $this->params->query['status'], 'required' => false, 'placeholder' => '', 'style' => "clear:left", 'options' => array('P' => 'Pending', 'S' => 'Paid'), 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?>
				
			
											
											<input type="submit" class="btn btn-primary" style="margin-bottom:9px;margin-left:4px;" value="Search">
											
								<a href="<?php echo $this->webroot;?>finexppay/"><button style="margin-bottom:9px;margin-left:4px;" type="button" class="btn btn-primary"><i class="icon-refresh"></i> Reset</button></a>
								
					<a href="<?php echo $this->webroot;?>finexppay/?action=export"><button type="button" class="btn btn-primary" style="float:right;margin-right:20px;"><i class="icon-reply"></i> Export</button></a>

				
						
								</div>			
								
								
<div id="dialog-confirm" title="Confirmation!" class="dn">
	<p>Are you sure you want to delete?</p>
</div>

<input type="hidden" id="del_url" value="<?php echo $this->webroot;?>finexppay/delete_advance/"/>
								<table class="table table-hover table-nomargin table-bordered usertable dataTable">
									<thead>
										
										<tr>
										
										<th width="100">
											<?php echo $this->Paginator->sort('createDate', 'Date', array('escape' => false,'direction' => 'desc'));?>
</th>
											
											
											
											<th width="100">
											<?php echo $this->Paginator->sort('exp_no', 'Exp. No.', array('escape' => false,'direction' => 'desc'));?>
</th>
											
										
												<th width="170"><?php echo $this->Paginator->sort('first_name', 'Employee', array('escape' => false,'direction' => 'desc'));?></th>
														<th width="250"><?php echo $this->Paginator->sort('company_name', 'Company', array('escape' => false,'direction' => 'desc'));?></th>
														<th width="200"><?php echo $this->Paginator->sort('project_name', 'Project', array('escape' => false,'direction' => 'desc'));?></th>
													
												
													<th width="120"><?php echo $this->Paginator->sort('req_amount', 'Expenses (Rs)', array('escape' => false,'direction' => 'desc'));?></th>
														
										
										
											
												<th width="70">Status</th>
										
											<th width="70">Options</th>
										</tr>
									</thead>
									<tbody>
									
										
									
										<?php  foreach($pay_data as $pay):?>
										
										<tr>
										
										<td><?php echo $this->Functions->format_date($pay['FinExpenses2']['created_date']);?></td>
											
											<td><?php echo $pay['FinExpenses2']['expense_no'];?></td>
											
										
											<td class='hidden-350'>
											
											<?php echo ucfirst($pay['Home']['first_name']).' '.ucfirst($pay['Home']['last_name']);?>
											
									
											
											</td>
													<td><?php echo $pay['Customer']['company_name'];?></td>
											<td><?php echo $pay['Project']['project_name'];?></td>
									
												<td><?php echo $pay['FinExpenses2']['amount'];?></td>
												
											
										<td> <?php 
											
											echo $this->Functions->show_exppay_status($pay['FinExpPay']['created_date']);?></td>
											
											
											<td class='hidden-480'>
											<?php if(!empty($pay['FinExpPay']['id'])):?>
												<a href="<?php echo $this->webroot;?>finexppay/view_payment/<?php echo $pay['FinExpenses2']['id'];?>/<?php echo $pay['FinExpPay']['id'];?>" class="btn" rel="tooltip" title="View"><i class="icon-search"></i></a>
												<?php endif; ?>
												<?php if(empty($pay['FinExpPay']['id'])):?>
												<a href="<?php echo $this->webroot;?>finexppay/add_payment/<?php echo $pay['FinExpenses2']['id'];?>/" class="btn" rel="tooltip" title="Pay"><i class="icon-gift"></i></a>
												<?php endif; ?>
											
											</td>
										</tr>
									<?php endforeach; ?>
									</tbody>
								</table>
								

								<?php echo $this->element('paging');?>
								
								




								
							</div>	

							</div>
						<input type="hidden" value="1" id="SearchKeywords">
						<input type="hidden" value="<?php echo $this->webroot;?>finexppay/" id="webroot">
						 <?php echo $this->Form->end(); ?>
						</div>
					</div>
				</div>
					
					
				</div>
		
			
			</div>
			

		</div>	
			
		
		
		
		
				
		


