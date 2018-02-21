<?php echo $this->element('fin_menu'); ?>
		
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Approve Expense</h1>
						
						
					</div>
				
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>finhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						
						
						<li>
							<a href="<?php echo $this->webroot;?>finexpapprove/">Approve Expense</a>
							
						</li>
						
						
					</ul>
					
				</div>
				
				
				
				<?php echo $this->Session->flash();?>
				
					<div class="row-fluid  footer_div" >
					<div class="span12">
						<div class="box box-bordered box-color">
						
						<div class="box-title">
								<h3><i class="icon-list"></i> Approve Expense</h3>
							</div>
							
						

						<?php echo $this->Form->create('FinExpApprove', array('name' => '', 'type' => '', 'id' => 'formID', 'class' => '')); ?>
							<div class="box-content">
							
						<div class="dataTables_wrapper">
						
				<div class="" id="DataTables_Table_8_filter"  style="padding:15px">
				
				<span>Search:</span>  <?php echo $this->Form->input('keyword', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-large', 'value' => $this->params->query['keyword'],  'id' => 'SearchText',  'required' => false, 'autocomplete' => 'off', 'placeholder' => 'Search here...', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
					
			
					<span>Employee:</span>		<?php echo $this->Form->input('emp_id', array('div'=> false,'type' => 'select', 'label' => false, 'class' => 'input-large', 'empty' => 'Select', 'required' => false,  'selected' => $this->params->query['emp_id'], 'placeholder' => '', 'style' => "clear:left", 'options' => $empList, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 

						

					
											
											<input class="btn btn-primary" type="submit" style="margin-bottom:9px;margin-left:4px;" value="Search"/>
											
				<a href="<?php echo $this->webroot;?>finexpapprove/"><button style="margin-bottom:9px;margin-left:4px;" type="button" class="btn btn-primary"><i class="icon-refresh"></i> Reset</button></a>
						
								</div>			
								
								
<div id="dialog-confirm" title="Confirmation!" class="dn">
	<p>Are you sure you want to delete?</p>
</div>

<input type="hidden" id="del_url" value="<?php echo $this->webroot;?>finadvance/delete_advance/"/>
								<table class="table table-hover table-nomargin table-bordered usertable dataTable">
									<thead>
										
										<tr>
											
											<th>
											<?php echo $this->Paginator->sort('first_name', 'Employee', array('escape' => false,'direction' => 'desc'));?>
											
											<th>
											<?php echo $this->Paginator->sort('created_date', 'Date', array('escape' => false,'direction' => 'desc'));?>
</th>	<th>
											<?php echo $this->Paginator->sort('expense_no', 'Exp. No.', array('escape' => false,'direction' => 'desc'));?>
</th><th width="90">
											<?php echo $this->Paginator->sort('fin_advance_id', 'Adv. No.', array('escape' => false,'direction' => 'desc'));?>
											
											</th>	
											
											<th width="120"><?php echo $this->Paginator->sort('amount', 'Amount (Rs)', array('escape' => false,'direction' => 'desc'));?></th>
											
											<th><?php echo $this->Paginator->sort('company_name', 'Customer', array('escape' => false,'direction' => 'desc'));?></th>
											<th><?php echo $this->Paginator->sort('project_name', 'Project', array('escape' => false,'direction' => 'desc'));?></th>
											<th>Pending</th>
												<th width="200">Status</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
									
										
									
										<?php foreach($exp_data as $key => $exp):?>
										
										<tr>
											<td><?php echo ucfirst($exp['Employee']['first_name']).' '.ucfirst($exp['Employee']['last_name']);?></td>
											
											<td><?php echo $this->Functions->format_date($exp['FinExpApprove']['created_date']);?></td>
											
											<td><?php echo $exp['FinExpApprove']['expense_no'];?></td>
										<td><?php echo $this->Functions->get_adv_id($exp['FinExpApprove']['fin_advance_id']);?></td>

											<td><?php echo $exp['FinExpApprove']['amount'];?></td>
												<td><?php echo $exp['TskCustomer']['company_name'];?></td>
											<td><?php echo $exp['TskProject']['project_name'];?></td>
											<td class='hidden-350'>
											
											<?php 
											$pending = strstr($exp[0]['st_status'], 'W');
											
											if(!empty($pending) || empty($exp[0]['st_status']) || $exp['FinExpApprove']['approve_status'] == 'W'):
											echo $this->Functions->time_diff($exp['FinExpApprove']['created_date'], 0);				
											endif; ?>
											
											</td>
											<td> 
											
											<?php if(!empty($exp[0]['st_status'])):
											echo $this->Functions->format_status($exp[0]['st_status'],$exp[0]['st_created'],$exp[0]['st_user'],$exp[0]['st_modified']);
											endif;
											?>
											<?php 
											
											if(!strstr($exp[0]['st_status'],'W')):											
											echo $this->Functions->get_fin_status($exp['FinExpApprove']['approve_status'],$exp['Home2']['first_name'],$exp['FinExpApprove']['approve_date']); 
											endif;
											?>
											</td>
											<td class='hidden-480'>
											
											<?php 
											$icon = $this->Functions->show_verify_icon($show_status[$key]);
											$title = $this->Functions->show_verify_title($show_status[$key]);
											
											
											?>
											
												<a href="<?php echo $this->webroot;?>finexpapprove/view_expense/<?php echo $exp['FinExpApprove']['id'];?>/<?php echo $exp['Employee']['id'];?>/<?php echo $exp[0]['status_id'];?>" class="btn" rel="tooltip" title="<?php echo $title; ?>"><i class="<?php echo $icon; ?>"></i></a>
											
											
											</td>
											
										</tr>
									<?php endforeach; ?>
									</tbody>
								</table>
								

								<?php echo $this->element('paging');?>
								
								




								
							</div>	

							</div>
						<input type="hidden" value="1" id="SearchKeywords">
						<input type="hidden" value="<?php echo $this->webroot;?>finexpapprove/" id="webroot">
						 <?php echo $this->Form->end(); ?>
						</div>
					</div>
				</div>
					
					
				</div>
		
			
			</div>
			

		</div>	
			
		
		
		
		
				
		


