<?php echo $this->element('fin_menu'); ?>
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Create Expense Request</h1>
					</div>
					
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>finhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="<?php echo $this->webroot;?>finexpense/">Expense</a>
								<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="#">Create Expense</a>
						</li>
					</ul>
					
				</div>
				
					<div class="row-fluid footer_div" >
					
					<div class="span12" >
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3><i class="icon-list"></i> Please fill the form to add expense request</h3>
							</div>
							<div class="box-content"  style="color:#555;">
									<?php echo $this->Form->create('FinExpense', array('id' => 'expForm', 'class' => 'form-vertical')); ?>
								
								
							
									<div class="row-fluid" style="margin-left:10px">
										<div class="span3" style="margin-top:10px">
											<div class="control-group">
												<label for="textfield" class="control-label">Customer <span class="red_star">*</span></label>
												<div class="controls controls-row">
													<?php echo $this->Form->input('tsk_company_id', array('div'=> false,'type' => 'select', 'label' => false, 'class' => 'input-block-level required tskCpny', 'empty' => 'Select', 'required' => false, 'placeholder' => '', 'style' => "clear:left", 'options' => $compList, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 	
													
													 
												</div>
											</div>
										</div>
										<div class="span3" style="margin-top:10px">
											<div class="control-group">
												<label for="textfield" class="control-label">Project <span class="red_star">*</span></label>
												<div class="controls controls-row">
													<?php echo $this->Form->input('tsk_projects_id', array('div'=> false,'type' => 'select', 'label' => false, 'class' => 'input-block-level required tskProj', 'empty' => 'Select', 'required' => false, 'placeholder' => '', 'style' => "clear:left", 'options' => $projList, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												
												</div>
											</div>
										</div>
										
										<div class="span3" style="margin-top:10px">
											<div class="control-group">
												<label for="textfield" class="control-label">Advance No. </label>
												<div class="controls controls-row">
													<?php echo $this->Form->input('fin_advance_id', array('div'=> false,'type' => 'select', 'label' => false, 'class' => 'input-block-level', 'empty' => 'Select', 'required' => false, 'placeholder' => '', 'style' => "clear:left", 'options' => $advList, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												
												</div>
											</div>
										</div>
									</div>
									
									
									<div class="row-fluid row1" style="margin-left:10px">
										<div class="span1">
											<div class="control-group">
												<label for="textfield" class="control-label"><b>Date</b></label>
												<div class="controls controls-row">
													<?php echo $this->Form->input('date_exp_o1', array('div'=> false,'type' => 'text', 'label' => false, 'id' => 'date_o1', 'class' => 'input-block-level datepicker required',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												</div>
											</div>
										</div>
										<div class="span2">
											<div class="control-group">
												<label for="textfield" class="control-label"><b>Category</b></label>
												<div class="controls controls-row">
													<?php echo $this->Form->input('fin_exp_category_id_o1', array('div'=> false,'type' => 'select','id' => 'cat_o1', 'label' => false, 'class' => 'input-block-level required', 'empty' => 'Select', 'required' => false, 'placeholder' => '', 'style' => "clear:left", 'options' => $catList, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											
												</div>
											</div>
										</div>
										<div class="span4">
											<div class="control-group">
												<label for="textfield" class="control-label"><b>Description</b></label>
												<div class="controls controls-row">
													<?php echo $this->Form->input('description_o1', array('div'=> false,'type' => 'text', 'label' => false, 'id' => 'desc_o1','class' => 'input-block-level required',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												</div>
											</div>
										</div>
										<div class="span1">
											<div class="control-group">
												<label for="textfield" class="control-label"><b>Amount</b></label>
												<div class="controls controls-row">
												<?php echo $this->Form->input('amount_o1', array('div'=> false,'type' => 'text','maxlength' => 6, 'label' => false, 'id' => 'amt_o1', 'class' => 'input-block-level required amtVal',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												</div>
											</div>
										</div>
									
										<div class="span1" style="width:40px">
											<div class="control-group">
												<label for="textfield" class="control-label"><b>Debitable</b></label>
												<div class="controls controls-row">
													<?php echo $this->Form->input('billable_o1', array('div'=> false,'type' => 'checkbox', 'id' => 'isbill_o1','label' => false, 'class' => 'input-block-level required',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												</div>
											</div>
										</div>
										
										<div class="span1" style="width:40px">
											<div class="control-group">
												<label for="textfield" class="control-label"><b>Bill</b></label>
												<div class="controls controls-row">
														<?php echo $this->Form->input('bill_avail_o1', array('div'=> false,'type' => 'checkbox', 'id' => 'avail_o1','label' => false, 'class' => 'input-block-level required',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												</div>
											</div>
										</div>
										
										
										<div class="span2">
											<div class="control-group">
												<label for="textfield" class="control-label"><b>Bill ref. no.</b></label>
												<div class="controls controls-row">
													<?php echo $this->Form->input('bill_refno_o1', array('div'=> false,'type' => 'text', 'maxlength' => 15,  'id' => 'billref_o1', 'label' => false, 'class' => 'input-block-level',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												</div>
											</div>
										</div>
									</div>
								
									
									<div class="row-fluid row02" style="margin-left:10px">
										<div class="span1">
											<div class="control-group">
										
												<div class="controls controls-row">
													<?php echo $this->Form->input('date_exp_o2', array('div'=> false,'type' => 'text', 'label' => false,  'id' => 'date_o2', 'class' => 'input-block-level required datepicker',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												</div>
											</div>
										</div>
										<div class="span2">
											<div class="control-group">
												
												<div class="controls controls-row">
													<?php echo $this->Form->input('fin_exp_category_id_o2', array('div'=> false,'type' => 'select', 'id' => 'cat_o2','label' => false, 'class' => 'input-block-level required', 'empty' => 'Select', 'required' => false, 'placeholder' => '', 'style' => "clear:left", 'options' => $catList, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											
												</div>
											</div>
										</div>
										<div class="span4">
											<div class="control-group">
											
												<div class="controls controls-row">
													<?php echo $this->Form->input('description_o2', array('div'=> false,'type' => 'text', 'label' => false, 'id' => 'desc_o2', 'class' => 'input-block-level required',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												</div>
											</div>
										</div>
										<div class="span1">
											<div class="control-group">
											
												<div class="controls controls-row">
												<?php echo $this->Form->input('amount_o2', array('div'=> false,'type' => 'text','maxlength' => 6, 'label' => false, 'id' => 'amt_o2', 'class' => 'input-block-level required amtVal',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												</div>
											</div>
										</div>
									
										<div class="span1" style="width:40px">
											<div class="control-group">
											
												<div class="controls controls-row">
													<?php echo $this->Form->input('billable_o2', array('div'=> false,'type' => 'checkbox', 'id' => 'isbill_o2','label' => false, 'class' => 'input-block-level required',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												</div>
											</div>
										</div>
										<div class="span1" style="width:40px">
											<div class="control-group">
												
												<div class="controls controls-row">
														<?php echo $this->Form->input('bill_avail_o2', array('div'=> false,'type' => 'checkbox', 'id' => 'avail_o2','label' => false, 'class' => 'input-block-level required',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												</div>
											</div>
										</div>
										
										
										<div class="span2">
											<div class="control-group">
											
												<div class="controls controls-row">
													<?php echo $this->Form->input('bill_refno_o2', array('div'=> false,'type' => 'text', 'label' => false, 'id' => 'billref_o2', 'class' => 'input-block-level', 'maxlength' => 15,  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												</div>
											</div>
										</div>
										<div class="">
						<a id="del_02" class="del_row" style="cursor:pointer;margin:0px 0px 0px 10px;float:left">
						<img class="delete" src="<?php echo $this->webroot;?>img/cross.png" rel="tooltip" title="Remove" alt="Remove" width="16" height="16" border="0"></a></div>
						
									</div>
								
								
									<div class="row-fluid row03" style="margin-left:10px">
										<div class="span1">
											<div class="control-group">
											
												<div class="controls controls-row">
													<?php echo $this->Form->input('date_exp_o3', array('div'=> false,'type' => 'text', 'label' => false, 'id' => 'date_o3', 'class' => 'input-block-level datepicker required',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												</div>
											</div>
										</div>
										<div class="span2">
											<div class="control-group">
											
												<div class="controls controls-row">
													<?php echo $this->Form->input('fin_exp_category_id_o3', array('div'=> false,'type' => 'select', 'id' => 'cat_o3','label' => false, 'class' => 'input-block-level required', 'empty' => 'Select', 'required' => false, 'placeholder' => '', 'style' => "clear:left", 'options' => $catList, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											
												</div>
											</div>
										</div>
										<div class="span4">
											<div class="control-group">
												
												<div class="controls controls-row">
													<?php echo $this->Form->input('description_o3', array('div'=> false,'type' => 'text', 'id' => 'desc_o3', 'label' => false, 'class' => 'input-block-level required',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												</div>
											</div>
										</div>
										<div class="span1">
											<div class="control-group">
												
												<div class="controls controls-row">
												<?php echo $this->Form->input('amount_o3', array('div'=> false,'type' => 'text', 'maxlength' => 6,'label' => false, 'id' => 'amt_o3', 'class' => 'input-block-level required amtVal',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												</div>
											</div>
										</div>
									
										<div class="span1" style="width:40px">
											<div class="control-group">
											
												<div class="controls controls-row">
													<?php echo $this->Form->input('billable_o3', array('div'=> false,'type' => 'checkbox', 'id' => 'isbill_o3','label' => false, 'class' => 'input-block-level required',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												</div>
											</div>
										</div>
										<div class="span1" style="width:40px">
											<div class="control-group">
												
												<div class="controls controls-row">
														<?php echo $this->Form->input('bill_avail_o3', array('div'=> false,'type' => 'checkbox', 'id' => 'avail_o3','label' => false, 'class' => 'input-block-level required',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												</div>
											</div>
										</div>
										
										<div class="span2">
											<div class="control-group">
											
												<div class="controls controls-row">
													<?php echo $this->Form->input('bill_refno_o3', array('div'=> false,'type' => 'text', 'id' => 'billref_o3', 'label' => false, 'class' => 'input-block-level', 'maxlength' => 15,  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												</div>
											</div>
										</div>
										
										<div class="">
						<a id="del_03" class="del_row" style="cursor:pointer;margin:0px 0px 0px 10px;float:left">
						<img class="delete" rel="tooltip" src="<?php echo $this->webroot;?>img/cross.png" title="Remove" alt="Remove" width="16" height="16" border="0"></a></div>
						
									</div>
								
								
									<div class="row-fluid row04" style="margin-left:10px">
										<div class="span1">
											<div class="control-group">
												
												<div class="controls controls-row">
													<?php echo $this->Form->input('date_exp_o4', array('div'=> false,'type' => 'text', 'label' => false,  'id' => 'date_o4', 'class' => 'input-block-level datepicker required',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												</div>
											</div>
										</div>
										<div class="span2">
											<div class="control-group">
											
												<div class="controls controls-row">
													<?php echo $this->Form->input('fin_exp_category_id_o4', array('div'=> false,'type' => 'select', 'id' => 'cat_o4','label' => false, 'class' => 'input-block-level required', 'empty' => 'Select', 'required' => false, 'placeholder' => '', 'style' => "clear:left", 'options' => $catList, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											
												</div>
											</div>
										</div>
										<div class="span4">
											<div class="control-group">
												
												<div class="controls controls-row">
													<?php echo $this->Form->input('description_o4', array('div'=> false,'type' => 'text', 'label' => false, 'id' => 'desc_o4', 'class' => 'input-block-level required',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												</div>
											</div>
										</div>
										<div class="span1">
											<div class="control-group">
											
												<div class="controls controls-row">
												<?php echo $this->Form->input('amount_o4', array('div'=> false,'type' => 'text', 'maxlength' => 6,'label' => false,'id' => 'amt_o4',  'class' => 'input-block-level required amtVal',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												</div>
											</div>
										</div>
									
										<div class="span1" style="width:40px">
											<div class="control-group">
												
												<div class="controls controls-row">
													<?php echo $this->Form->input('billable_o4', array('div'=> false,'type' => 'checkbox', 'label' => false, 'id' => 'isbill_o4','class' => 'input-block-level required',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												</div>
											</div>
										</div>
										<div class="span1" style="width:40px">
											<div class="control-group">
												
												<div class="controls controls-row">
														<?php echo $this->Form->input('bill_avail_o4', array('div'=> false,'type' => 'checkbox', 'id' => 'avail_o4','label' => false, 'class' => 'input-block-level required',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												</div>
											</div>
										</div>
										
										<div class="span2">
											<div class="control-group">
												
												<div class="controls controls-row">
													<?php echo $this->Form->input('bill_refno_o4', array('div'=> false,'type' => 'text', 'label' => false,'id' => 'billref_o4', 'class' => 'input-block-level', 'maxlength' => 15,  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												</div>
											</div>
										</div>
										<div class="">
						<a id="del_04" class="del_row" style="cursor:pointer;margin:0px 0px 0px 10px;float:left">
						<img class="delete" rel="tooltip" src="<?php echo $this->webroot;?>img/cross.png" title="Remove" alt="Remove" width="16" height="16" border="0"></a></div>
									</div>
								
								<div id="sheepItForm">
								<div  id="sheepItForm_template">
								
				

	
									<div class="row-fluid" style="margin-left:10px">
										<div class="span1">
											<div class="control-group">
												
												<div class="controls controls-row">
													<?php echo $this->Form->input('date_exp', array('div'=> false,'type' => 'text', 'label' => false, 'id' => 'date_#index#',  'name' => "data[FinExpense][date_exp_#index#]", 'class' => 'input-block-level required datepicker',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												</div>
											</div>
										</div>
										<div class="span2">
											<div class="control-group">
											
												<div class="controls controls-row">
													<?php echo $this->Form->input('fin_exp_category_id', array('div'=> false,'type' => 'select', 'label' => false, 'id' => 'cat_#index#', 'name' => "data[FinExpense][fin_exp_category_id_#index#]", 'class' => 'required input-block-level', 'empty' => 'Select', 'required' => false, 'placeholder' => '', 'style' => "clear:left", 'options' => $catList, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											
												</div>
											</div>
										</div>
										<div class="span4">
											<div class="control-group">
											
												<div class="controls controls-row">
													<?php echo $this->Form->input('description', array('div'=> false,'type' => 'text', 'label' => false, 'id' => 'desc_#index#','name' => "data[FinExpense][description_#index#]", 'class' => 'input-block-level required',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												</div>
											</div>
										</div>
										<div class="span1">
											<div class="control-group">
												
												<div class="controls controls-row">
												<?php echo $this->Form->input('amount', array('div'=> false,'type' => 'text', 'label' => false, 'name' => "data[FinExpense][amount_#index#]", 'class' => 'input-block-level amtVal required', 'maxlength' => 6,'id' => 'amt_#index#',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												</div>
											</div>
										</div>
										
										<div class="span1" style="width:40px">
											<div class="control-group">
												
												<div class="controls controls-row">
													<?php echo $this->Form->input('billable', array('div'=> false,'type' => 'checkbox', 'name' => "data[FinExpense][billable_#index#]",'label' => false, 'id' => 'isbill_#index#', 'class' => 'input-block-level required',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												</div>
											</div>
										</div>
										<div class="span1" style="width:40px">
											<div class="control-group">
												
												<div class="controls controls-row">
														<?php echo $this->Form->input('bill_avail', array('div'=> false,'type' => 'checkbox',  'name' => "data[FinExpense][bill_avail_#index#]", 'id' => 'bill_avail_#index#', 'label' => false, 'class' => 'input-block-level required',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?>
														
													
												</div>
											</div>
										</div>									
										<div class="span2">
											<div class="control-group">
												
												<div class="controls controls-row">
													<?php echo $this->Form->input('bill_refno', array('div'=> false,'type' => 'text', 'label' => false, 'name' => "data[FinExpense][bill_refno_#index#]", 'id' => 'billref_#index#', 'maxlength' => 15, 'class' => 'input-block-level',  'required required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												</div>
											</div>
										</div>
									
						<div class="">
						<a id="sheepItForm_remove_current"  style="cursor:pointer;margin:0px 0px 0px 10px;float:left">
						<img class="delete del_row" rel="tooltip" src="<?php echo $this->webroot;?>img/cross.png" title="Remove" alt="Remove" width="16" height="16" border="0"></a></div>
	
								</div>
									

								</div>
							
							 <div id="sheepItForm_noforms_template"></div>

							 
							<!-- Controls -->
							  <div id="sheepItForm_controls">
							  
								<div id="sheepItForm_add" style="float:right;margin-right:70px;"><button type="submit" id="add" class="btn btn-darkblue"><i class="icon-plus"></i> Add Rows</button></div>
								
								
							  <!-- /Controls -->

		
								</div>

								
								
	<div style="float:right;margin-right:250px;position:absolute;right:310px;font-weight:bold;">Total</div>	
	<div class="control-group span1" style="float:right;margin-right:275px;">
	<div class="controls controls-row">
												 <?php echo $this->Form->input('amount', array('div'=> false,'type' => 'text', 'readonly' => 'readonly',  'label' => false,'id' => 'totAmt', 'maxlength' => 6, 'class' => 'input-block-level',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												</div>
											</div>
								
									<div  style="margin-left:10px;">
										<div>
									
										
										<input type="submit" name="data[FinExpense][save]" class="btn btn-primary save_btn" value="Send">
											<input type="submit" name="data[FinExpense][drafts]" class="btn btn-darkblue draft_btn" value="Save as Draft"/>
											<a href="<?php echo $this->webroot;?>finexpense/" class="cancel_btn regCancel"><button type="button" class="btn">Cancel</button></a>
											
										</div>
										
									</div>	
									
										
										
									
										<?php echo $this->Form->input('form_count', array('id'=> 'form_count', 'type' => 'hidden'));?>
								
										<input type="hidden" value="<?php echo date('d/m/Y');?>" id="end_date">
										
										<input type="hidden"  id="isDraft" name="data[FinExpense][draft]">
									
									<input type="hidden" value="<?php echo $this->webroot;?>" id="webroot">
									
									<?php echo $this->Form->input('page', array('type' => 'hidden', 'value' => 'add', 'id' => 'page'));?>
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
		</div>	
			
	<input type="hidden" value="<?php echo $this->webroot;?>finexpense/create_expense/" id="post_data">	
			
<div id="dialog-confirm" title="Confirmation!" class="dn">
	<p>Are you sure you want to send? once sent, it cannot be modified!</p>
</div>		
	
