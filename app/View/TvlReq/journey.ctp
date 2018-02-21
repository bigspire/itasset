<?php echo $this->element('tvl_menu'); ?>
<style type="text/css">
.form-wizard .wizard-steps{margin:0;background:none;border-bottom:1px solid #efefef;}
.form-wizard .step .control-group{padding:0}
.form-wizard .wizard-steps li.active{border-bottom:1px solid #efefef;}
.form-wizard .wizard-steps li{text-align:left;margin-left:10px;}
.form-wizard .wizard-steps.steps-3 li{width:30.3%}
</style>
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Add Travel Request</h1>
					</div>
					
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>tvlhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="<?php echo $this->webroot;?>tvlreq/">My Travel</a>
								<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="#">Add Travel Request</a>
						</li>
					</ul>
					
				</div>
				
					<div class="row-fluid footer_div">
					<div class="span12">
						<div class="box box-color">
							
							<div class="box-content nopadding">
					<?php echo $this->Form->create('TvlReq', array('id' => 'formID', 'class' => 'placeFrm form-horizontal form-column form-bordered form-wizard')); ?>
									<div class="step" id="firstStep">
										<ul class="wizard-steps steps-3">
											<li class='active'>
												<div class="single-step">
													<span class="title">1</span>
													<span class="circle">
														<span class="active"></span>
													</span>
													<span class="description">
														Journey Details
													</span>
												</div>
											</li>
											<li>
												<div class="single-step">
													<span class="title">2</span>
													<span class="circle">
													</span>
													<span class="description">
														Passenger Details
													</span>
												</div>
											</li>
											<li>
												<div class="single-step">
													<span class="title">3</span>
													<span class="circle">
													</span>
													<span class="description">
														Confirmation
													</span>
												</div>
											</li>
										</ul>
										
									<div class="span6">
										<div class="control-group">
											<label for="textfield" class="control-label">Travel Type <span class="red_star">*</span></label>
											<div class="controls">
				<?php echo $this->Form->input('type', array('div'=> false,'type' => 'radio', 'label' => false,  'value' => $this->Session->read('STEP1.type'), 'style' => 'margin:4px 2px', 'class' => 'input-xlarge tvlType',  'options' => $travelType, 'separator' => ' ', 'id' => '', 'default' => '1',  'required' => false, 'placeholder' => '', 'legend' => false, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error serverErr')))); ?>
						<div class="error field1"></div>
													
												
											</div>
										</div>
										
									<div class="control-group">
											<label for="textfield" class="control-label">Customer <span class="red_star">*</span></label>
											<div class="controls">
													
													
													<?php echo $this->Form->input('tsk_company_id', array('div'=> false,'type' => 'select', 'id' => 'customer',  'selected' => $this->Session->read('STEP1.tsk_company_id'),'label' => false, 'class' => 'input-xlarge comp_list', 'empty' => 'Select', 'required' => false, 'placeholder' => '', 'style' => "clear:left;", 'options' => $compList, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error serverErr')))); ?> 
														<div class="error customer"></div>
													<div style="margin-top:10px;">
							<?php echo $this->Form->input('debit_same', array('div'=> false,  'type' => 'radio', 'label' => false,  'value' => $this->Session->read('STEP1.debit_same'), 'style' => 'margin:4px 2px', 'class' => 'input-xlarge debitTravel',  'options' => array('Y' => 'Debit to Same', 'N' => 'Other'), 'separator' => ' ', 'required' => false, 'placeholder' => '', 'legend' => false, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error serverErr')))); ?>

													
												<?php echo $this->Form->input('debit_to', array('div'=> false,'type' => 'select', 'id' => 'debit_to',  'selected' => $this->Session->read('STEP1.debit_to'),'label' => false, 'class' => 'input-large dn', 'empty' => 'Select', 'required' => false, 'placeholder' => '', 'style' => "display:none;clear:left;", 'options' => $compList, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error serverErr')))); ?> 
												</div>
													<div class="error debit_travel"></div>
												
													
												
											</div>
										</div>
											<div class="control-group">
											<label for="password" class="control-label">Purpose <span class="red_star">*</span></label>
											<div class="controls">
												<?php echo $this->Form->input('purpose', array('div'=> false, 'id' => 'purpose', 'value' => $this->Session->read('STEP1.purpose'),'type' => 'textarea', 'rows' => '2','label' => false, 'class' => 'input-block-level',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error serverErr')))); ?> 
												
												
												<div class="error purpose"></div>
												
											</div>
										</div>
										
											
										
										<div class="control-group">
											<label for="textfield" class="control-label">Mode of Travel <span class="red_star">*</span></label>
											<div class="controls">
				<?php echo $this->Form->input('tvl_mode_id', array('div'=> false,'type' => 'radio', 'label' => false,  'value' => $this->Session->read('STEP1.tvl_mode_id'), 'default' => '2', 'style' => 'margin:4px 2px', 'class' => 'input-xlarge tvlModeSel',  'options' => $modeList, 'separator' => ' ', 'id' => '', 'required' => false, 'placeholder' => '', 'legend' => false, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error serverErr')))); ?>
						<div class="error field1"></div>
													
												
											</div>
										</div>

								<div class="control-group">
											<label for="textfield" class="control-label">Class <span class="red_star">*</span>
											<span class="owDiv"><br><br></span>
											<span class="rtDiv"><br><br></span></label>
											<div class="controls">
				<?php echo $this->Form->input('tvl_mode_option', array('div'=> false, 'id' => 'tvlclass', 'multiple' => 'multiple', 'type' => 'select', 'label' => false, 'selected' => $this->Session->read('STEP1.tvl_mode_option'),  'style' => 'margin:4px 2px', 'class' => 'input-xlarge tvlModeOpt chosen-select', 'options' => $modeOption,  'separator' => ' ',  'required' => false, 'placeholder' => '', 'legend' => false, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error serverErr')))); ?>
						<div class="error tvlclass"></div>
													
												
											</div>
										</div>		
											
										
										
										
									</div>
									<div class="span6" style="border-right:1px solid #ddd;">
										
							
									<div class="control-group">
											<label for="password" class="control-label">Place of Travel <span class="red_star">*</span> </label>
											<div class="controls">
<?php echo $this->Form->input('tvl_depart_id', array('div'=> false,'type' => 'select', 'id' => 'source','label' => false, 'selected' => $this->Session->read('STEP1.tvl_depart_id'), 'class' => 'input-medium chosen-select', 'empty'=> 'Select', 'options' => $placeList,  'required' => false, 'placeholder' => 'Source', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error serverErr')))); ?> 
								<i class="icon-exchange rtDiv dn"></i> 
								 <i class="glyphicon-right_arrow owDiv"></i>
<?php echo $this->Form->input('tvl_dest_id', array('div'=> false,'type' => 'select', 'id' => 'dest','label' => false, 'selected' => $this->Session->read('STEP1.tvl_dest_id'), 'class' => 'input-medium chosen-select',  'empty'=> 'Select', 'options' => $placeList,  'required' => false, 'placeholder' => 'Destination', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error serverErr')))); ?> 
												<div><a href="<?php echo $this->webroot;?>tvlreq/add_place/" class="iframeBox" val="40_50">Place not available?</a></div>
												<div class="error source"></div>
												<div class="error dest"></div>
												
											</div>
										</div>
										<div class="control-group">
											<label for="textfield" class="control-label">Journey Date <span class="red_star">*</span></label>
											<div class="controls">
											<?php echo $this->Form->input('start_date', array('div'=> false,'type' => 'text', 'id' => 'journey_date','label' => false,   'value' => $this->Session->read('STEP1.start_date'),'class' => 'input-medium dpd1',  'required' => false, 'placeholder' => 'Onward', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error serverErr')))); ?>     
										
											   <?php echo $this->Form->input('return_date', array('div'=> false,'type' => 'text', 'id' => 'return_date',  'value' => $this->Session->read('STEP1.return_date'),'style' => 'display:none', 'label' => false, 'class' => 'rtDiv input-medium dn dpd2',  'required' => false, 'placeholder' => 'Return', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error serverErr')))); ?> 
						
												<div class="error journey_date"></div><div class="error return_date"></div>
						<?php if($ERROR['start_date'][0] == 'You already created travel request on this date' || $ERROR['return_date'][0] == 'You already created travel request on this return date' ): ?>
						<a href="<?php echo $this->webroot;?>tvlreq/add_request/passenger/"><button class="btn btn-success" type="button">Yes, I know. Pls proceed</button></a>
						
						<?php endif;?>
											</div>
										</div>
											<div class="control-group">
											<label for="password" class="control-label">Desired Time </label>
											<div class="controls">
Depart: <?php echo $this->Form->input('desire_depart_from', array('div'=> false,'type' => 'text', 'id' => '','label' => false, 'style' => 'width:65px',   'value' => $this->Session->read('STEP1.desire_depart_from'),'class' => 'input-small defaultTimePick',  'required' => false, 'placeholder' => 'From', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error serverErr')))); ?> 
											
<?php echo $this->Form->input('desire_depart_to', array('div'=> false,'type' => 'text', 'id' => '', 'style' => 'width:65px',  'label' => false,  'value' => $this->Session->read('STEP1.desire_depart_to'),'class' => 'input-small defaultTimePick',  'required' => false, 'placeholder' => 'To', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error serverErr')))); ?> 

Arrive: <?php echo $this->Form->input('desire_arrival_from', array('div'=> false,'type' => 'text', 'style' => 'width:65px', 'id' => '','label' => false,  'value' => $this->Session->read('STEP1.desire_arrival_from'), 'class' => 'input-small defaultTimePick',  'required' => false, 'placeholder' => 'From', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error serverErr')))); ?> 
											
<?php echo $this->Form->input('desire_arrival_to', array('div'=> false,'type' => 'text', 'style' => 'width:65px', 'id' => '','label' => false,  'value' => $this->Session->read('STEP1.desire_arrival_to'), 'class' => 'input-small defaultTimePick',  'required' => false, 'placeholder' => 'To', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error serverErr')))); ?> 
												<div class="error field2"></div>
											</div>
										</div>
										
										<div class="control-group dn rtDiv">
											<label for="password" class="control-label">Desired Time (Return)</label>
											<div class="controls">
				Depart: <?php echo $this->Form->input('desire_return_depart_from', array('div'=> false,'type' => 'text', 'id' => '','label' => false, 'value' => $this->Session->read('STEP1.desire_return_depart_from'),'style' => 'width:65px',  'class' => 'input-small tsk_timepicker',  'required' => false, 'placeholder' => 'From', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error serverErr')))); ?> 
											
<?php echo $this->Form->input('desire_return_depart_to', array('div'=> false,'type' => 'text', 'id' => '', 'style' => 'width:65px',  'label' => false, 'value' => $this->Session->read('STEP1.desire_return_depart_to'),'class' => 'input-small tsk_timepicker',  'required' => false, 'placeholder' => 'To', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error serverErr')))); ?> 

Arrive: <?php echo $this->Form->input('desire_return_arrival_from', array('div'=> false,'type' => 'text', 'style' => 'width:65px', 'id' => '','label' => false, 'value' => $this->Session->read('STEP1.desire_return_arrival_from'), 'class' => 'input-small tsk_timepicker',  'required' => false, 'placeholder' => 'From', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error serverErr')))); ?> 
											
<?php echo $this->Form->input('desire_return_arrival_to', array('div'=> false,'type' => 'text', 'style' => 'width:65px', 'id' => '','label' => false, 'value' => $this->Session->read('STEP1.desire_return_arrival_to'), 'class' => 'input-small tsk_timepicker',  'required' => false, 'placeholder' => 'To', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error serverErr')))); ?> 
								
												<div class="error"></div>
											</div>
										</div>
										
									
										
									
										
										<div class="control-group">
											<label for="password" class="control-label">Special Booking Particulars <a href="javascript:void(0);" rel="tooltip" title="eg: Book me the ticket in the Bangalore Mail, preferably side upper berth if available"><span  class="badge badge-grey">?</span></a></label>
											<div class="controls">
												<?php echo $this->Form->input('spl_particular', array('div'=> false,'type' => 'textarea', 'rows' => '2','id' => '','value' => $this->Session->read('STEP1.spl_particular'), 'label' => false, 'class' => 'input-block-level',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error serverErr')))); ?> 
												
												
												<div class="error field4"></div>
												
											</div>
										</div>
										
											<div class="control-group">
											<label for="password" class="control-label">Expected Outcome <span class="red_star">*</span></label>
											<div class="controls">
												<?php echo $this->Form->input('expected_outcome', array('div'=> false,'type' => 'textarea', 'rows' => '2','id' => 'outcome', 'value' => $this->Session->read('STEP1.expected_outcome'), 'label' => false, 'class' => 'input-block-level',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error serverErr')))); ?> 
												
												
												<div class="error outcome"></div>
												
											</div>
										</div>
										
									
									</div>
									
									</div>
									
									
									<div class="form-actions" style="clear:left;">
								<a href="<?php echo $this->webroot;?>tvlreq/"><button type="button" class="btn regCancel hideCan hideBtn">Cancel</button></a>

										<input type="submit" style="margin-left:10px" class="save_journey btn btn-primary" value="Next >>" id="next">
										
										<?php if($this->Session->read('STEP2.passenger') != ''):?>									
										<input type="submit" style="margin-left:10px" name="data[TvlReq][confirm]" class="btn tktConfirm" value="Confirmation">
										<?php endif; ?>
									</div>
									
							<input type="hidden" value="<?php echo $this->webroot;?>" id="webroot">
	<input type="hidden" name="data[TvlReq][confirm]" id="confirm">
						<input type="hidden" value="1" id="overlayclose">

								<?php echo $this->Form->end(); ?>
							</div>
						</div>
					</div>
				</div>
				
					
				</div>
		
			
			</div>
		</div>	

