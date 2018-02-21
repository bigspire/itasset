<?php echo $this->element('hr_menu'); ?>
		
		
	<div class="container-fluid" id="content" style="overflow:auto">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>My Payslips</h1>
						
						
					</div>
				
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>hrhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						
						
						<li>
							<a href="<?php echo $this->webroot;?>hrmypayslip/">Payslips</a>
							
						</li>
						
						
					</ul>
					
				</div>
				
				
				
			<?php echo $this->Session->flash();?>
			
						
				
					<div class="row-fluid  footer_div" >
					<div class="span12">
						<div class="box box-bordered box-color">
						
						<div class="box-title">
								<h3><i class="icon-list"></i> My Payslips </h3>
							</div>
							
						

						<?php echo $this->Form->create('HrMyPayslip', array('name' => '', 'type' => '', 'id' => 'formID', 'class' => '')); ?>
							<div class="box-content">
							
						<div class="dataTables_wrapper">
						
				<div class="" id="DataTables_Table_8_filter"  style="padding:15px">
				
				<span>Search:</span>  
										
		
				<span>From:</span>  
				<?php echo $this->Form->input('from', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-small monthpick', 'value' => $this->params->query['from'],   'required' => false,  'placeholder' => 'From', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 

<span>To:</span>  
				<?php echo $this->Form->input('to', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-small monthpick', 'value' => $this->params->query['to'],   'required' => false,  'placeholder' => 'To', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 	
				
				
				
											
											<input type="submit" value="Search" class="btn btn-primary" style="margin-bottom:9px;margin-left:4px;">
											
													<a href="<?php echo $this->webroot;?>hrmypayslip/"><button style="margin-bottom:9px;margin-left:4px;" type="button" class="btn btn-primary"><i class="icon-refresh"></i> Reset</button></a>
													
													
										
					
						
								</div>			
								
								

								<table class="table table-hover table-nomargin table-bordered usertable dataTable">
									<thead>
										
										<tr>
											
											
<th width="80">
											<?php echo $this->Paginator->sort('month', 'Month', array('escape' => false,'direction' => 'desc'));?>
												</th>												
										
												<th width="80">
											<?php echo $this->Paginator->sort('net_amount', 'Net Amount', array('escape' => false,'direction' => 'desc'));?>
												</th>								
										
											
											
											
											<th width="100">Action</th>
										</tr>
									</thead>
									<tbody>
									
										
									
										<?php  foreach($pay_data as $pay):?>
										
										<tr>
											
											
														
															
	<td><?php echo date('M, Y', strtotime($pay['HrMyPayslip']['month']));?></td>
															
											<td>Rs. <?php echo $pay['HrMyPayslip']['net_amount'];?></td>				
											
																			
									
											
											<td class='hidden-480'>
								
											
										
												<a  href="<?php echo $this->webroot;?>hrmypayslip/download_pay/<?php echo $pay['HrMyPayslip']['pdf_file'];?>" class="btn" rel="tooltip" title="Download"><i class="icon-download-alt"></i></a>
												
											
											
												
											</td>
										</tr>
										
									<?php endforeach; ?>
									</tbody>
								</table>
								

								<?php echo $this->element('paging');?>
								
								




								
							</div>	

							</div>
							
							
							
						
						<input type="hidden" value="<?php echo $this->webroot;?>hrmypayslip/" id="webroot">
						 <?php echo $this->Form->end(); ?>
						</div>
					</div>
				</div>
					
					
				</div>
		
			
			</div>
			

		</div>	
			
									
								
<div id="dialog-confirm" title="Confirmation!" class="dn">
	<p>Are you sure you want to delete?</p>
</div>	
		
		
		<div id="disablingDiv"></div>
		
				
		


