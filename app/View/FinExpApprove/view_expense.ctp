<?php echo $this->element('fin_menu'); ?>
	<div class="container-fluid" id="content" style="padding-bottom:20px">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Approve Expense  - Approve/Reject</h1>
					</div>
					
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>finhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="<?php echo $this->webroot;?>finexpapprove/">Expenses</a>
								<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="#">Approve Expense</a>
						</li>
					</ul>
					
				</div>
				
				
					<div class="row-fluid footer_div" id="pcontent">
					

					<div class="span12" style="clear:left" >
						<div class="box box-color box-bordered">
							<div class="box-title">
							
							<?php if($VIEW_ONLY == 1):?>
							<h3><i class="icon-list"></i> View Expense</h3>
							<?php else: ?>
							<h3><i class="icon-list"></i> Please check the form to verify expense request</h3>
							<?php endif; ?>
								
							</div>
							<div class="box-content" id="expForm" style="color:#555;">
									<?php echo $this->Form->create('FinExpApprove', array('id' => 'formID', 'class' => 'form-vertical')); ?>
								
								
							
									<div class="row-fluid" style="margin-bottom:10px;margin-left:10px;">
									
										<div class="span1" style="margin-top:10px">
											<div class="control-group">
												<label for="textfield" class="control-label"><b>Expense No.</b></label>
												<div class="controls controls-row">
													<?php echo $this->request->data['FinExpApprove']['expense_no']; ?> 	
													
													 
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
										
										<div class="span2" style="margin-top:10px;width:120px;">
											<div class="control-group">
												<label for="textfield" class="control-label"><b>Submission Date</b></label>
												<div class="controls controls-row">
													<?php echo $this->Functions->format_date($this->request->data['FinExpApprove']['created_date']); ?> 	
													
													 
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
										<div class="span2" style="margin-top:10px;">
											<div class="control-group">
												<label for="textfield" class="control-label"><b>Project</b></label>
												<div class="controls controls-row">
													<?php echo $this->request->data['TskProject']['project_name']; ?> 	
												
												</div>
											</div>
										</div>
											<div class="span2" style="margin-top:10px;">
											<div class="control-group">
												<label for="textfield" class="control-label"><b>Advance</b></label>
												<div class="controls controls-row">
												<?php if($this->request->data['FinExpApprove']['fin_advance_id']):?>
						<a class="iframeBox" val="50_60" href="<?php echo $this->webroot;?>finexpapprove/view_advance/<?php echo $this->request->data['FinExpApprove']['fin_advance_id'];?>"><?php echo $this->Functions->get_adv_id($this->request->data['FinExpApprove']['fin_advance_id']);?></a>  - ₹<?php echo $this->Functions->money_display($this->request->data['FinAdvance']['amount']); ?>
						<?php else:?>
						Nil
						<?php endif; ?>
												</div>
											</div>
										</div>
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
										<div class="span2" style="width:170px">
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
												<label for="textfield" class="control-label" style="margin-bottom:10px"><b>Amount (Rs)</b></label>
											<?php endif; ?>
												<div class="controls controls-row">
												<?php echo $list['FinExpList']['amount']; ?> 
												</div>
											</div>
										</div>
									
										<div class="span1" style="width:50px">
											<div class="control-group">
												<?php if($key == 0):?>
												<label for="textfield" class="control-label" style="margin-bottom:10px"><b>Debitable</b></label>
											<?php endif; ?>
												<div class="controls controls-row">
													<?php echo $this->Functions->check_status($list['FinExpList']['billable']);?> 
												</div>
											</div>
										</div>
												<div class="span1" style="width:40px">
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
										
									<?php if($READ_ONLY != 'readonly'):?>	
										<div class="span1">
											<div class="control-group">
													<?php if($key == 0):?>
												<label for="textfield" class="control-label" style="margin-bottom:10px;"><b>Reject</b></label>
											<?php endif; ?>
												<div class="controls controls-row">
													
													<?php echo $this->Form->input('verify_'.$list['FinExpList']['id'], array('div'=> false, $DISABLED, 'val' => $list['FinExpList']['amount'], 'type' => 'checkbox', 'label' => false, 'id' => 'chk_'.$list['FinExpList']['id'],'class' => 'input-block-level exp_reject',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
													
													<?php echo $this->Form->input('FinExpList.amtChk_'.$list['FinExpList']['id'], array('value' => $list['FinExpList']['amount'], 'type' => 'hidden')); ?>
													
													
													<?php 
													$value .= $list['FinExpList']['id'].',';
													?>													
													
												</div>
											</div>
										</div>
									<?php endif; ?>	
										
									<?php if($READ_ONLY != 'readonly'):?>	
									<div class="span2">
											<div class="control-group">
													<?php if($key == 0):?>
												<label for="textfield" class="control-label" style="margin-bottom:10px"><b>Reason</b></label>
											<?php endif; ?>

												<div class="controls controls-row">
												
												<?php echo $this->Form->input('remarks_'.$list['FinExpList']['id'], array('div'=> false,'type' => 'text', 'label' => false, 'id' => 'reason_'.$list['FinExpList']['id'], 'class' => 'input-block-level required',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												
												

											
												</div>
											</div>
										</div>
										<?php endif; ?>
									</div>
								
									
									<?php endforeach;
				echo $this->Form->input('hdnId', array('type' => 'hidden', 'value' => $value));?>						

										<div style="margin-left:350px;margin-top:20px;font-size:16px;">
											<strong>	<span>Total: </span>
												
												Rs. <span id="exp_amt"><?php echo $this->request->data['FinExpApprove']['amount'];?> </span></strong>
												
												</div>
														
								
								<div>
							
					
	
					

								
											<div class="span12">
										
									
										
										<?php if($VIEW_ONLY == 1):?>
										
										<div class="form-actions" style="margin:0;padding:0 0 10px 10px;">
										
									
											
											
											<a class="jsRedirect" href="javascript:void(0);" val="<?php echo $this->webroot;?>finexpapprove/"><button type="button" class="btn"><i class="icon-arrow-left"></i>  Go Back</button></a>
											
											<a href="javascript:void(0)" rel="pcontent" class="print" style="margin-left:10px"><button type="button" class="btn btn-magenta"><i class="icon-print"></i> Print</button></a>
											<a href="<?php echo $this->webroot;?>finexpapprove/view_expense/<?php echo $this->request->params['pass'][0];?>/<?php echo $this->request->params['pass'][1];?>/<?php echo $this->request->params['pass']['2'];?>/?action=export"  style="margin-left:10px">
											<button type="button" class="btn btn-teal"><i class="icon-file"></i> Export</button>
											</a>
											
										</div>
										
										
										<?php else: ?>
										
										<div class="form-actions" style="margin:0;padding:0 0 10px 10px;">
										<a href="<?php echo $this->webroot;?>finexpapprove/view_expense/<?php echo $this->request->params['pass'][0];?>/<?php echo $this->request->params['pass'][1];?>/<?php echo $this->request->params['pass']['2'];?>/?action=export"  style="margin-left:10px">
											<button type="button" class="btn btn-teal"><i class="icon-file"></i> Export</button>
											</a>
										<a class="" href="javascript:void(0);">
											<button type="button" name="<?php echo $this->webroot;?>finexpapprove/process_adv/<?php echo $this->request->params['pass'][0];?>/<?php echo $this->request->params['pass'][1];?>/<?php echo $rec_status;?>/<?php echo $this->request->params['pass'][2];?>/" class="btn btn-green approveRec">Send</button></a>
											
											
											
											<a href="javascript:void(0)" class="jsRedirect" val="<?php echo $this->webroot;?>finexpapprove/"><button type="button" class="btn">Cancel</button></a>
										</div>
										
										<?php endif; ?>
										
										
									</div>
								<?php echo $this->Form->input('form_count', array('id' => 'form_count', 'type' => 'hidden', 'value' => ++$key));?>	
										<?php echo $this->Form->input('id', array('type' => 'hidden'));?>
								<?php echo $this->Form->input('approve_exp', array('type' => 'hidden', 'value' => 1,  'id' => 'approve_exp'));?>
										</div>
									</div>
								<?php echo $this->Form->end(); ?>
							</div>
						</div>
					</div>
					
					
					
				</div>
					
					
				</div>
		
			
			</div>
		
			
			
		
<div id="dialog-confirm" title="Approve Confirmation!" class="dn">
	<p>Are you sure you want to process?</p>
</div>	


