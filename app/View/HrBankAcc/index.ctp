<?php echo $this->element('hr_menu'); ?>
		
	<div class="container-fluid" id="content" style="overflow:auto">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Bank Account</h1>
						
						
					</div>
				
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>hrhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						
						
						<li>
							<a href="<?php echo $this->webroot;?>hrbankacc/">Bank Account</a>
							
						</li>
						
						
					</ul>
					
				</div>
				
				
				
			<?php echo $this->Session->flash();?>
				
					<div class="row-fluid  footer_div" >
					<div class="span12">
						<div class="box box-bordered box-color">
						
						<div class="box-title">
								<h3><i class="icon-list"></i> Bank Account </h3>
							</div>
							
						

						<?php echo $this->Form->create('HrBankAcc', array('name' => '', 'type' => '', 'id' => 'formID', 'class' => '')); ?>
							<div class="box-content">
							
						<div class="dataTables_wrapper">
						
				<div class="" id="DataTables_Table_8_filter"  style="padding:15px">
				
				<span>Search:</span>  
				
				<?php echo $this->Form->input('keyword', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-large', 'value' => $this->params->query['keyword'],  'id' => 'SearchText', 'required' => false, 'autocomplete' => 'off', 'placeholder' => 'Search here...', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												
		
				
				
											
											<input type="submit" value="Search" class="btn btn-primary" style="margin-bottom:9px;margin-left:4px;">
											
													<a href="<?php echo $this->webroot;?>hrbankacc/"><button style="margin-bottom:9px;margin-left:4px;" type="button" class="btn btn-primary"><i class="icon-refresh"></i> Reset</button></a>
											
					
						
								</div>			
								
								
<div id="dialog-confirm" title="Confirmation!" class="dn">
	<p>Are you sure you want to delete?</p>
</div>

<input type="hidden" id="del_url" value="<?php echo $this->webroot;?>hrbankacc/delete_bank/"/>
								<table class="table table-hover table-nomargin table-bordered usertable dataTable">
									<thead>
										
										<tr>
											
											<th width="150">
											<?php echo $this->Paginator->sort('first_name', 'Employee', array('escape' => false,'direction' => 'desc'));?>
												</th>
												
												<th width="120" >
											<?php echo $this->Paginator->sort('acc_name', 'Account Name', array('escape' => false,'direction' => 'desc'));?>
												</th>
													
												<th width="120">
											<?php echo $this->Paginator->sort('acc_no', 'Account No.', array('escape' => false,'direction' => 'desc'));?>
												</th>
												
<th width="150">
											<?php echo $this->Paginator->sort('bank', 'Bank', array('escape' => false,'direction' => 'desc'));?>
												</th>												
										
										<th width="150">
											<?php echo $this->Paginator->sort('branch', 'Branch', array('escape' => false,'direction' => 'desc'));?>
												</th>	

		<th width="100">
											<?php echo $this->Paginator->sort('ifsc', 'IFSC', array('escape' => false,'direction' => 'desc'));?>
												</th>													
										
												
												<th width="110">
											<?php echo $this->Paginator->sort('created_date', 'Created', array('escape' => false,'direction' => 'desc'));?>
												</th>
											
											
											<th width="50">Options</th>
										</tr>
									</thead>
									<tbody>
									
										
									
										<?php  foreach($bnk_data as $bank):?>
										
										<tr>
											
											<td><?php echo ucwords($bank['HrEmployee']['first_name'].' '.$bank['HrEmployee']['last_name']);?></td>
											
														<td><?php echo $bank['HrBankAcc']['acc_name'];?></td>
														
															<td><?php echo $bank['HrBankAcc']['acc_no'];?></td>
															
															<td><?php echo $bank['HrBank']['bank'];?></td>
															
															<td><?php echo $bank['HrBank']['branch'];?></td>
															
																<td><?php echo $bank['HrBank']['ifsc'];?></td>
											
											<td><?php echo $this->Functions->format_date($bank['HrBankAcc']['created_date']);?></td>
										
									
											
											<td class='hidden-480'>
											
									
											
											
												<a  href="<?php echo $this->webroot;?>hrbankacc/edit_account/<?php echo $bank['HrEmployee']['id'];?>/<?php echo $bank['HrBankAcc']['id'];?>" class="btn iframeBox" val="45_65" rel="tooltip" title="Edit"><i class="icon-edit"></i></a>
											
											</td>
										</tr>
										
									<?php endforeach; ?>
									</tbody>
								</table>
								

								<?php echo $this->element('paging');?>
								
								




								
							</div>	

							</div>
							
							<?php echo $this->Form->input('edit_bank_acc', array('id' => 'edit_bank_acc', 'type' => 'hidden'));?>
						<input type="hidden" value="1" id="SearchKeywords">
						<input type="hidden" value="<?php echo $this->webroot;?>hrbankacc/" id="webroot">
						 <?php echo $this->Form->end(); ?>
						</div>
					</div>
				</div>
					
					
				</div>
		
			
			</div>
			

		</div>	
			
		
		
		
		
				
		


