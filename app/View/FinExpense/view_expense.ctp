<?php echo $this->element('fin_menu'); ?>
	<div class="container-fluid" id="content" style="padding-bottom:20px">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>View <?php echo $this->Functions->check_discrepancy($FN_NAME); ?></h1>
					</div>
					
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>finhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="<?php echo $this->webroot;?>finexpense/<?php echo $FN_TYPE; ?>"><?php echo $this->Functions->check_discrepancy($FN_NAME); ?></a>
								<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="#">View <?php echo $this->Functions->check_discrepancy($FN_NAME); ?></a>
						</li>
					</ul>
					
				</div>
				
					<div id="pcontent" class="row-fluid footer_div" style="width:97%" >
					
					<div class="span12" >
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3><i class="icon-list"></i> View Expense Request</h3>
							</div>
							<div class="box-content"  style="color:#555;">
									<?php echo $this->Form->create('FinExpense', array('id' => 'expForm', 'class' => 'form-vertical')); ?>
								
								
							
									<div class="row-fluid" style="margin-bottom:10px;margin-left:10px;">
									
										<div class="span2" style="margin-top:10px">
											<div class="control-group">
												<label for="textfield" class="control-label"><b>Expense No.</b></label>
												<div class="controls controls-row">
													<?php echo $this->request->data['FinExpense']['expense_no']; ?> 	
													
													 
												</div>
											</div>
										</div>
										
										<div class="span3" style="margin-top:10px">
											<div class="control-group">
												<label for="textfield" class="control-label"><b>Customer</b></label>
												<div class="controls controls-row">
													<?php echo $this->request->data['TskCustomer']['company_name']; ?> 	
													
													 
												</div>
											</div>
										</div>
										<div class="span3" style="margin-top:10px;">
											<div class="control-group">
												<label for="textfield" class="control-label"><b>Project</b></label>
												<div class="controls controls-row">
													<?php echo $this->request->data['TskProject']['project_name']; ?> 	
												
												</div>
											</div>
										</div>
										
											<div class="span2" style="margin-top:10px">
											<div class="control-group">
												<label for="textfield" class="control-label"><b>Employee</b></label>
												<div class="controls controls-row">
													<?php echo $this->request->data['Home']['first_name'].' '.$this->request->data['Home']['last_name']; ?> 	
													
													 
												</div>
											</div>
										</div>
										<?php if($this->request->data['FinExpense']['is_draft'] == 'N'): ?>
										<div class="span1" style="margin-top:10px;width:120px;">
											<div class="control-group">
												<label for="textfield" class="control-label"><b>Submission Date</b></label>
												<div class="controls controls-row">
													<?php echo $this->Functions->format_date($this->request->data['FinExpense']['created_date']); ?> 	
													
													 
												</div>
											</div>
										</div>
										<?php endif; ?>
									</div>
									
									
									
									
								
									<?php foreach($exp_list as $key => $list): ?>
								
									<div class="row-fluid row<?php echo $key;?>" style="margin-left:10px;">
										<div class="span1" style="width:60px">
											<div class="control-group">
											<?php if($key == 0):?>
												<label for="textfield" class="control-label" style="margin-bottom:10px"><b>Date</b></label>
											<?php endif; ?>
												<div class="controls controls-row">
													<?php echo $this->Functions->format_date_show($list['FinExpList']['date_exp']);?>
												</div>
											</div>
										</div>
										<div class="span1" style="width:100px">
											<div class="control-group">
											<?php if($key == 0):?>
												<label for="textfield" class="control-label" style="margin-bottom:10px"><b>Category</b></label>
											<?php endif; ?>
												<div class="controls controls-row">
													<?php echo $list['FinExpCat']['category'];?>  
											
												</div>
											</div>
										</div>
										<div class="span3"  style="width:170px">
											<div class="control-group">
												<?php if($key == 0):?>
												<label for="textfield" class="control-label" style="margin-bottom:10px"><b>Description</b></label>
											<?php endif; ?>
												<div class="controls controls-row">
													<?php echo $list['FinExpList']['description'];?> 
												</div>
											</div>
										</div>
										<div class="span1" style="width:100px">
											<div class="control-group">
											<?php if($key == 0):?>
												<label for="textfield" class="control-label" style="margin-bottom:10px"><b>Amount</b></label>
											<?php endif; ?>
												<div class="controls controls-row">
												<?php echo $list['FinExpList']['amount']; ?> 
												</div>
											</div>
										</div>
									
										<div class="span1" style="width:50px">
											<div class="control-group">
												<?php if($key == 0):?>
												<label for="textfield" class="control-label" style="margin-bottom:10px"><b>Billable</b></label>
											<?php endif; ?>
												<div class="controls controls-row">
													<?php echo $this->Functions->check_status($list['FinExpList']['billable']);?> 
												</div>
											</div>
										</div>
												<div class="span1" style="width:50px">
											<div class="control-group">
													<?php if($key == 0):?>
												<label for="textfield" class="control-label" style="margin-bottom:10px"><b>Bill</b></label>
											<?php endif; ?>
												<div class="controls controls-row">
														<?php echo $this->Functions->check_status($list['FinExpList']['bill_avail']);?>
												</div>
											</div>
										</div>
										
										<div class="span1" style="width:60px">
											<div class="control-group">
													<?php if($key == 0):?>
												<label for="textfield" class="control-label" style="margin-bottom:10px"><b>Bill No.</b></label>
											<?php endif; ?>
												<div class="controls controls-row">
													<?php echo $list['FinExpList']['bill_refno']; ?> 
												</div>
											</div>
										</div>
										
									<?php if($FN_NAME == 'discrepancy'):?>
									
										<div class="span3" style="width:150px">
											<div class="control-group">
													<?php if($key == 0):?>
												<label for="textfield" class="control-label" style="margin-bottom:10px;"><b>Reject Reason</b></label>
											<?php endif; ?>
												<div class="controls controls-row" style="color:#ff0000">
													<?php echo $list['FinExpList']['reason']; ?> 
												</div>
											</div>
										</div>
									<?php endif; ?>
										
									</div>
								
									
									<?php endforeach; ?>
								
								<div>
							
			<?php if($FN_NAME != 'discrepancy'): ?>		
	<div class="control-group span4" style="float:left;margin-left:400px;">
	<div class="controls controls-row">
												<b>Total:   <?php echo $this->Functions->money_display($this->request->data['FinExpense']['amount']);?></b>
												</div>
										</div>
						<?php endif; ?>	

								
											<div class="span12">
										<div class="form-actions" style="margin:0;padding:0 0 10px 10px;">
										
										<a class="" href="javascript:void(0);">
											
											
											
											
											
											
											
											<?php if($this->request->query['type'] == 'draft'):?>
											<a href="<?php echo $this->webroot;?>finexpense/edit_expense/<?php echo $this->request->params['pass'][0];?>/?type=draft" class="">
											<button type="button" class="btn btn-primary"><i class="icon-edit"></i> Edit</button>
											</a>
											<?php endif; ?>
											
			<a href="javascript:void(0)" class="jsRedirect" val="<?php echo $this->webroot;?>finexpense/<?php echo $FN_TYPE;?>"><button type="button" class="btn"><i class="icon-arrow-left"></i> Go Back</button></a>
											
											<?php if($this->request->query['type'] != 'draft'):?>
											<a href="javascript:void(0)" rel="pcontent" class="print" style="margin-left:10px">
											<button type="button" class="btn btn-magenta"><i class="icon-print"></i> Print</button>
											</a>
											<?php endif; ?>
											
											
											<?php if($this->request->query['type'] != 'draft'):?>
											<a href="<?php echo $this->webroot;?>finexpense/view_expense/<?php echo $this->request->params['pass'][0];?>/?action=export"  style="margin-left:10px">
											<button type="button" class="btn btn-teal"><i class="icon-file"></i> Export</button>
											</a>
											<?php endif; ?>
											
											
											
											
										</div>
									</div>
									
										<?php echo $this->Form->input('id', array('type' => 'hidden'));?>
								<?php echo $this->Form->end(); ?>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
					
					
					
				</div>
					
					
				</div>
		
			
			</div>
		
			
			
		
<div id="dialog-confirm" title="Approve Confirmation!" class="dn">
	<p>Are you sure you want to send?</p>
</div>	


