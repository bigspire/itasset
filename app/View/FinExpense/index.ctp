<?php echo $this->element('fin_menu'); ?>
		
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1><?php echo $EXP_TYPE; ?></h1>
						
						
					</div>
				
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>finhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						
						
						<li>
							<a href="<?php echo $this->webroot;?>finexpense/<?php echo $FN_TYPE;?>"><?php echo $EXP_TYPE; ?></a>
							
						</li>
						
						
					</ul>
				<?php //if($this->request->query['type'] != 'draft'):?>	
					
					<!--a href="<?php echo $this->webroot;?>finexpense/?type=draft"><button type="button" class="btn btn-brown" style="float:right;margin-right:10px;">Draft Expenses</button></a-->
					<?php //else: ?>
					
					
					
					<!--a href="<?php echo $this->webroot;?>finexpense/"><button type="button" class="btn btn-primary" style="float:right;margin-right:10px;"><< My Expenses</button></a-->
					<?php //endif; ?>
					
					
				</div>
				
				
				
				<?php echo $this->Session->flash();?>
				
					<div class="row-fluid footer_div">
					<div class="span12">
						<div class="box box-bordered box-color">
						
						<div class="box-title">
								<h3><i class="icon-list"></i> <?php echo $EXP_TYPE; ?></h3>
							</div>
							
						

						<?php echo $this->Form->create('FinExpense', array('name' => '', 'type' => '', 'id' => 'formID', 'class' => '')); ?>
							<div class="box-content">
							
						<div class="dataTables_wrapper">
						
				<div class="" id="DataTables_Table_8_filter"  style="padding:15px">
				
				<span>Search:</span>  <?php echo $this->Form->input('keyword', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-large', 'value' => $this->params->query['keyword'],  'required' => false, 'autocomplete' => 'off', 'id' => 'SearchText','placeholder' => 'Search here...', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
				
											<input class="btn btn-primary" style="margin-bottom:9px;margin-left:4px;" type="submit" value="Search"/>
										<a href="<?php echo $this->webroot;?>finexpense/<?php echo $FN_TYPE;?>"><button style="margin-bottom:9px;margin-left:4px;" type="button" class="btn btn-primary"><i class="icon-refresh"></i> Reset</button></a>

										
											
					<a href="<?php echo $this->webroot;?>finexpense/create_expense/"><button type="button" class="btn btn-primary" style="float:right"><i class="icon-plus"></i> Add Expense</button></a>
						
								</div>			
								
								
<div id="dialog-confirm" title="Confirmation!" class="dn">
	<p>Are you sure you want to delete?</p>
</div>

<input type="hidden" id="del_url" value="<?php echo $this->webroot;?>finexpense/delete_expense/"/>
								<table class="table table-hover table-nomargin table-bordered usertable dataTable">
									<thead>
										
										<tr>
											
											<th width="90">
											<?php echo $this->Paginator->sort('created_date', 'Date', array('escape' => false,'direction' => 'desc'));?>
</th>

<th width="90">
											<?php echo $this->Paginator->sort('expense_no', 'Exp. No.', array('escape' => false,'direction' => 'desc'));?>
											
											</th>
											
				<th width="90">
											<?php echo $this->Paginator->sort('fin_advance_id', 'Adv. No.', array('escape' => false,'direction' => 'desc'));?>
											
											</th>							
											<th width="240" ><?php echo $this->Paginator->sort('company_name', 'Customer', array('escape' => false,'direction' => 'desc'));?></th>
											<th width="340"><?php echo $this->Paginator->sort('project_name', 'Project', array('escape' => false,'direction' => 'desc'));?></th>
											
											<?php if($FN_NAME != 'discrepancy'):?>
											<th width="100" > <?php echo $this->Paginator->sort('amount', 'Amount (Rs)', array('escape' => false,'direction' => 'desc'));?></th>
											<?php endif; ?>
									
											<?php  if($EXP_TYPE != 'Draft Expense' && $EXP_TYPE != 'Discrepancy' ):	 ?>
											<th width="220">Status</th>
										<?php endif; ?>
										
										<?php  if($FN_NAME == 'draft'):	 ?>
										<th width="90">	<?php echo $this->Paginator->sort('modified_date', 'Modified', array('escape' => false,'direction' => 'desc'));?></th>
										<?php endif; ?>
										
											
											<th>Options</th>
										</tr>
									</thead>
									<tbody>
									
										
									
										<?php  foreach($exp_data as $exp):?>
										
										<tr>
											
											<td><?php echo $this->Functions->format_date($exp['FinExpense']['created_date']);?></td>
											<td><?php echo $exp['FinExpense']['expense_no'];?></td>
											<td><?php echo $this->Functions->get_adv_id($exp['FinExpense']['fin_advance_id']);?></td>
											<td><?php echo $exp['TskCustomer']['company_name'];?></td>
												<td><?php echo $exp['TskProject']['project_name'];?></td>
												
												<?php if($FN_NAME != 'discrepancy'):?>
											<td><?php echo $this->Functions->money_display($exp['FinExpense']['amount']);?></td>
											<?php endif; ?>
											
											<?php if($FN_NAME == 'draft'):?>
											<td><?php echo $this->Functions->format_date($exp['FinExpense']['modified_date']);?></td>
											<?php endif; ?>
											
											
											<?php if($EXP_TYPE != 'Draft Expense' && $EXP_TYPE != 'Discrepancy' ):	 ?>
											<td class='hidden-350'>
											
											
											<?php if(!empty($exp[0]['st_status'])):
											echo $this->Functions->format_status($exp[0]['st_status'],$exp[0]['st_created'],$exp[0]['st_user'],$exp[0]['st_modified']);
											endif;
											?>
										<?php if(!strstr($exp[0]['st_status'],'W')):	
										echo $this->Functions->get_fin_status($exp['FinExpense']['approve_status'],$exp['Home2']['first_name'],$exp['FinExpense']['approve_date']); 
										endif; ?>
											</td>
											<?php endif; ?>
									
											
											
											<td class='hidden-480'>
												<a href="<?php echo $this->webroot;?>finexpense/view_expense/<?php echo $exp['FinExpense']['id'];?>/<?php echo $FN_TYPE;?>" class="btn" rel="tooltip" title="View"><i class="icon-search"></i></a>
												<?php if($exp['FinExpense']['is_draft'] == 'Y'):?>
												<a href="<?php echo $this->webroot;?>finexpense/edit_expense/<?php echo $exp['FinExpense']['id'];?>/<?php echo $FN_TYPE;?>" class="btn" rel="tooltip" title="Edit"><i class="icon-edit"></i></a>
											
	<a href="javascript:void(0);" name="<?php echo $exp['FinExpense']['id'];?>" class="btn delRec" rel="tooltip" title="Delete"><i class="icon-remove"></i></a>
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
						<input type="hidden" value="<?php echo $this->webroot;?>finexpense/" id="webroot">
						 <?php echo $this->Form->end(); ?>
						</div>
					</div>
				</div>
					
					
				</div>
		
			
			</div>
			

		</div>	
			
		
		
		
		
				
		


