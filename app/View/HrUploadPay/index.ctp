<?php echo $this->element('hr_menu'); ?>
		
		
	<div class="container-fluid" id="content" style="overflow:auto">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Upload Payslips</h1>
						
						
					</div>
				
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>hrhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						
						
						<li>
							<a href="<?php echo $this->webroot;?>hruploadpay/">Payslips</a>
							
						</li>
						
						
					</ul>
					
				</div>
				
				
				
			<?php echo $this->Session->flash();?>
			
			<?php if($this->request->query['gen_pay'] == 'success'): ?>
			<div id="flashMessage" class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>Payslip generated successfully</div>
			<?php endif; ?>
			
			<?php if($this->request->query['gen_pay'] == 'nopayslip'): ?>
			<div id="flashMessage" class="alert alert-warning"><button type="button" class="close" data-dismiss="alert">&times;</button>No employee having pending payslips</div>
			<?php endif; ?>
			
				
					<div class="row-fluid  footer_div" >
					<div class="span12">
						<div class="box box-bordered box-color">
						
						<div class="box-title">
								<h3><i class="icon-list"></i> Upload Payslips </h3>
							</div>
							
						

						<?php echo $this->Form->create('HrUploadPay', array('name' => '', 'type' => '', 'id' => 'formID', 'class' => '')); ?>
							<div class="box-content">
							
						<div class="dataTables_wrapper">
						
				<div class="" id="DataTables_Table_8_filter"  style="padding:15px">
				
				<span>Search:</span>  
				
				<?php echo $this->Form->input('keyword', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-large', 'value' => $this->params->query['keyword'],  'id' => 'SearchText', 'required' => false, 'autocomplete' => 'off', 'placeholder' => 'Search here...', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												
		
				<span>From:</span>  
				<?php echo $this->Form->input('from', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-small monthpick', 'value' => $this->params->query['from'],   'required' => false,  'placeholder' => 'From', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 

<span>To:</span>  
				<?php echo $this->Form->input('to', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-small monthpick', 'value' => $this->params->query['to'],   'required' => false,  'placeholder' => 'To', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 	
				
				
				
											
											<input type="submit" value="Search" class="btn btn-primary" style="margin-bottom:9px;margin-left:4px;">
											
													<a href="<?php echo $this->webroot;?>hruploadpay/"><button style="margin-bottom:9px;margin-left:4px;" type="button" class="btn btn-primary"><i class="icon-refresh"></i> Reset</button></a>
													
													
												<a href="<?php echo $this->webroot;?>hruploadpay/upload/"><button type="button" class="btn btn-primary" style="float:right"><i class="icon-plus"></i> Upload Payslip</button></a>
					
						
								</div>			
								
								

								<table class="table table-hover table-nomargin table-bordered usertable dataTable">
									<thead>
										
										<tr>
											
											<th width="180">
											<?php echo $this->Paginator->sort('first_name', 'Employee', array('escape' => false,'direction' => 'desc'));?>
												</th>
												
												<th width="110" >
											<?php echo $this->Paginator->sort('emp_no', 'Emp. No.', array('escape' => false,'direction' => 'desc'));?>
												</th>
													
												<th width="180">
											<?php echo $this->Paginator->sort('email_address', 'Email Id', array('escape' => false,'direction' => 'desc'));?>
												</th>
												
<th width="80">
											<?php echo $this->Paginator->sort('month', 'Month', array('escape' => false,'direction' => 'desc'));?>
												</th>												
										
												<th width="80">
											<?php echo $this->Paginator->sort('net_amount', 'Net Amount', array('escape' => false,'direction' => 'desc'));?>
												</th>								
										
												
												<th width="110">
											<?php echo $this->Paginator->sort('created_date', 'Created', array('escape' => false,'direction' => 'desc'));?>
												</th>
											
											
											<th width="100">Action</th>
										</tr>
									</thead>
									<tbody>
									
										
									
										<?php  foreach($pay_data as $pay):?>
										
										<tr>
											
											<td><?php echo ucwords($pay['HrEmployee']['first_name'].' '.$pay['HrEmployee']['last_name']);?></td>
											<td><?php echo $pay['HrEmployee']['emp_no'];?></td>
											
														<td><?php echo $pay['HrEmployee']['email_address'];?></td>
														
														
															
	<td><?php echo date('M, Y', strtotime($pay['HrUploadPay']['month']));?></td>
															
											<td>Rs. <?php echo $pay['HrUploadPay']['net_amount'];?></td>				
											
											<td><?php echo $this->Functions->format_date($pay['HrUploadPay']['created_date']);?></td>
										
									
											
											<td class='hidden-480'>
											
									
									
									
											<a  val="<?php echo $this->webroot;?>hrpayslip/index/<?php echo $pay['HrEmployee']['id'];?>/<?php echo $pay['HrUploadPay']['month'].'/'.$url_var?>"  href="javascript:void(0);" class="genpay btn notify <?php echo $this->Functions->get_payslip_color($pay['HrUploadPay']['pdf_created']);?>"  data-notify-time = '60000' data-notify-title="In Progress!" data-notify-message="Generating payslip... Please wait..." rel="tooltip" title="<?php echo $this->Functions->get_payslip_date($pay['HrUploadPay']['pdf_created']);?>"><i class="icon-cog"></i></a>
											
											<?php if(!empty($pay['HrUploadPay']['pdf_created'])):?>
												<a  href="<?php echo $this->webroot;?>hruploadpay/download_pay/<?php echo $pay['HrUploadPay']['pdf_file'];?>" class="btn" rel="tooltip" title="Download"><i class="icon-download-alt"></i></a>
												<?php endif; ?>
											
												<a href="javascript:void(0);" name="<?php echo $pay['HrUploadPay']['id'];?>" class="btn delRec notify" rel="tooltip" title="Delete"><i class="icon-remove"></i></a>
												
											</td>
										</tr>
										
									<?php endforeach; ?>
									</tbody>
								</table>
								

								<?php echo $this->element('paging');?>
								
								




								
							</div>	

							</div>
							<input type="hidden" id="del_url" value="<?php echo $this->webroot;?>hruploadpay/delete_payslip/"/>
							
							<input type="hidden" value="1" id="paygen">
						<input type="hidden" value="1" id="SearchKeywords">
						<input type="hidden" value="<?php echo $this->webroot;?>hruploadpay/" id="webroot">
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
	
		
				
		


