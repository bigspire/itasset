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
					<?php echo $this->Form->create('TvlReq', array('id' => 'expForm', 'class' => 'tvlForm form-wizard')); ?>
									<div class="step" id="firstStep">
										<ul class="wizard-steps steps-3">
											<li>
												<div class="single-step">
													<span class="title">1</span>
													<span class="circle">
														
													</span>
													<span class="description">
														Journey Details
													</span>
												</div>
											</li>
											<li  class='active'>
												<div class="single-step">
													<span class="title">2</span>
													<span class="circle"><span class="active"></span>
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
										
								<div class="row-fluid" style="margin-top:10px">
									
									<div class="span2">
											<div class="control-group">
												<label for="textfield" class="control-label"><b>Name</b> <span class="red_star">*</span></label>
												<div class="controls controls-row">
													<?php echo $this->Form->input('passenger', array('div'=> false,'autocomplete' => 'off', 'id' => '', 'value' => $this->Session->read('STEP2.passenger'), 'type' => 'text',  'label' => false, 'class' => 'input-block-level required emp_srch',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												</div>
											</div>
										</div>
								
									
										<div class="span1" style="width:40px;">
											<div class="control-group">
												<label for="textfield" class="control-label"><b>Age</b> <span class="red_star">*</span></label>
												<div class="controls controls-row">
													<?php echo $this->Form->input('age', array('div'=> false, 'maxlength' => 3, 'type' => 'text','id' => 'title', 'value' => $this->Session->read('STEP2.age'),'label' => false, 'class' => 'age digitOnly input-block-level required', 'empty' => 'Select', 'required' => false, 'placeholder' => '', 'style' => "clear:left", 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											
												</div>
											</div>
										</div>
										
												
										<div class="span1" style="width:85px">
											<div class="control-group">
												<label for="textfield" class="control-label"><b>Gender</b> <span class="red_star">*</span></label>
												<div class="controls controls-row">
													<?php echo $this->Form->input('gender', array('div'=> false,'type' => 'select', 'empty' => 'Select',  'options' => $gender, 'selected' => $this->Session->read('STEP2.gender'),'label' => false, 'id' => '', 'class' => 'digitOnly gender input-block-level required',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												</div>
											</div>
										</div>
											<div class="span2" style="width:150px">
											<div class="control-group">
												<label for="textfield" class="control-label"><b>Mobile</b> <span class="red_star">*</span></label>
												<div class="controls controls-row">
												<?php echo $this->Form->input('mobile_no', array('div'=> false,'type' => 'text','value' => $this->Session->read('STEP2.mobile_no'), 'maxlength' => '12', 'label' => false, 'id' => '', 'class' => 'digitOnly mobile input-block-level required',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												</div>
											</div>
										</div>
								
										
										<div class="span2" style="width:260px">
											<div class="control-group">
												<label for="textfield" class="control-label"><b>Email</b> <span class="red_star">*</span></label>
												<div class="controls controls-row">
												<?php echo $this->Form->input('email_id', array('div'=> false,'type' => 'text','label' => false, 'value' => $this->Session->read('STEP2.email_id'),'id' => '', 'class' => 'email input-block-level required',   'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												</div>
											</div>
										</div>
										
										<div class="span2" style="width:170px">
											<div class="control-group">
												<label for="textfield" class="control-label"><b>Id Card Type</b> <span class="red_star">*</span></label>
												<div class="controls controls-row">
													<?php echo $this->Form->input('id_type', array('div'=> false,'type' => 'select', 'label' => false,'selected' => $this->Session->read('STEP2.id_type'), 'options' => $idList, 'empty' => 'Select', 'id' => 'desc','class' => 'input-block-level required id_type',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												</div>
											</div>
										</div>
										
											<div class="span2" style="width:150px">
											<div class="control-group">
												<label for="textfield" class="control-label"><b>ID Card No.</b> <span class="red_star">*</span></label>
												<div class="controls controls-row">
													<?php echo $this->Form->input('id_no', array('div'=> false,'type' => 'text', 'label' => false, 'value' => $this->Session->read('STEP2.id_no'), 'id' => 'outcome','class' => 'input-block-level required id_no',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												</div>
											</div>
										</div>
										
										
										<?php
							for($i = 0; $i <= $this->Session->read('STEP2.rec_count'); $i++): 
							if($this->Session->read('STEP2.passenger'.$i) != ''):
							?>
								
								<div class="row-fluid row<?php echo $i;?>" style="clear:left">
									
									<div class="span2">
											<div class="control-group">
												<div class="controls controls-row">
													<?php echo $this->Form->input('passenger'.$i, array('div'=> false,'autocomplete' => 'off', 'id' => '', 'value' => $this->Session->read('STEP2.passenger'.$i), 'type' => 'text',  'label' => false, 'class' => 'input-block-level required emp_srch',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												</div>
											</div>
										</div>
								
									
										<div class="span1" style="width:40px;">
											<div class="control-group">
												<div class="controls controls-row">
													<?php echo $this->Form->input('age'.$i, array('div'=> false, 'maxlength' => 3, 'type' => 'text','id' => 'title', 'value' => $this->Session->read('STEP2.age'.$i),'label' => false, 'class' => 'age digitOnly input-block-level required', 'empty' => 'Select', 'required' => false, 'placeholder' => '', 'style' => "clear:left", 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											
												</div>
											</div>
										</div>
										
												
										<div class="span1" style="width:85px">
											<div class="control-group">
												<div class="controls controls-row">
													<?php echo $this->Form->input('gender'.$i, array('div'=> false,'type' => 'select', 'empty' => 'Select',  'options' => $gender, 'selected' => $this->Session->read('STEP2.gender'.$i),'label' => false, 'id' => '', 'class' => 'gender input-block-level required',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												</div>
											</div>
										</div>
											<div class="span2" style="width:150px">
											<div class="control-group">
												<div class="controls controls-row">
												<?php echo $this->Form->input('mobile'.$i, array('div'=> false,'type' => 'text','value' => $this->Session->read('STEP2.mobile'.$i), 'maxlength' => '12', 'label' => false, 'id' => '', 'class' => 'digitOnly mobile input-block-level required',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												</div>
											</div>
										</div>
								
										
										<div class="span2" style="width:260px">
											<div class="control-group">
												<div class="controls controls-row">
												<?php echo $this->Form->input('email_id'.$i, array('div'=> false,'type' => 'text','label' => false, 'value' => $this->Session->read('STEP2.email_id'.$i),'id' => '', 'class' => 'email input-block-level required',   'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												</div>
											</div>
										</div>
										
										<div class="span2" style="width:170px">
											<div class="control-group">
												<div class="controls controls-row">
													<?php echo $this->Form->input('id_type'.$i, array('div'=> false,'type' => 'select', 'label' => false,'selected' => $this->Session->read('STEP2.id_type'.$i), 'options' => $idList, 'empty' => 'Select', 'id' => 'desc','class' => 'input-block-level required',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												</div>
											</div>
										</div>
										
											<div class="span2" style="width:150px">
											<div class="control-group">
												<div class="controls controls-row">
													<?php echo $this->Form->input('id_no'.$i, array('div'=> false,'type' => 'text', 'label' => false, 'value' => $this->Session->read('STEP2.id_no'.$i), 'id' => 'outcome','class' => 'input-block-level required',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												</div>
											</div>
										</div>
										
										<div class="">
					<a id="del_<?php echo $i; ?>" class="del_row" style="cursor:pointer;margin:6px 0px 0px 10px;float:left">
						<img class="delete" rel="tooltip" title="Remove" src="<?php echo $this->webroot;?>img/cross.png"  alt="Remove" width="16" height="16" border="0"></a>
						
						</div>
									
									</div>
					
								
								<?php $j++; endif; endfor; $k = $j;?>
									
								
									<?php 
									$k = $k ? ++$k : 1;
							for($i = 0; $i < $this->Session->read('STEP2.form_count'); $i++):
							if($this->Session->read('STEP2.employee_'.$i) != ''):
							?>
								
								<div class="row-fluid row<?php echo $k;?>">
									
									<div class="span2">
											<div class="control-group">
												<div class="controls controls-row">
													<?php echo $this->Form->input('passenger'.$k, array('div'=> false,'autocomplete' => 'off', 'id' => '', 'value' => $this->Session->read('STEP2.employee_'.$i), 'type' => 'text',  'label' => false, 'class' => 'input-block-level required emp_srch',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												</div>
											</div>
										</div>
								
									
										<div class="span1" style="width:40px;">
											<div class="control-group">
												<div class="controls controls-row">
													<?php echo $this->Form->input('age'.$k, array('div'=> false, 'maxlength' => 3, 'type' => 'text','id' => 'title', 'value' => $this->Session->read('STEP2.age_'.$i),'label' => false, 'class' => 'age digitOnly input-block-level required', 'empty' => 'Select', 'required' => false, 'placeholder' => '', 'style' => "clear:left", 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											
												</div>
											</div>
										</div>
										
												
										<div class="span1" style="width:85px">
											<div class="control-group">
												<div class="controls controls-row">
													<?php echo $this->Form->input('gender'.$k, array('div'=> false,'type' => 'select', 'empty' => 'Select',  'options' => $gender, 'selected' => $this->Session->read('STEP2.gender_'.$i),'label' => false, 'id' => '', 'class' => 'gender input-block-level required',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												</div>
											</div>
										</div>
											<div class="span2" style="width:150px">
											<div class="control-group">
												<div class="controls controls-row">
												<?php echo $this->Form->input('mobile'.$k, array('div'=> false,'type' => 'text','value' => $this->Session->read('STEP2.mobile_'.$i), 'maxlength' => '12', 'label' => false, 'id' => '', 'class' => 'digitOnly mobile input-block-level required',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												</div>
											</div>
										</div>
								
										
										<div class="span2" style="width:260px">
											<div class="control-group">
												<div class="controls controls-row">
												<?php echo $this->Form->input('email_id'.$k, array('div'=> false,'type' => 'text','label' => false, 'value' => $this->Session->read('STEP2.email_'.$i),'id' => '', 'class' => 'email input-block-level required',   'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												</div>
											</div>
										</div>
										
										<div class="span2" style="width:170px">
											<div class="control-group">
												<div class="controls controls-row">
													<?php echo $this->Form->input('id_type'.$k, array('div'=> false,'type' => 'select', 'label' => false,'selected' => $this->Session->read('STEP2.id_type_'.$i), 'options' => $idList, 'empty' => 'Select', 'id' => 'desc','class' => 'input-block-level required',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												</div>
											</div>
										</div>
										
											<div class="span2" style="width:150px">
											<div class="control-group">
												<div class="controls controls-row">
													<?php echo $this->Form->input('id_no'.$k, array('div'=> false,'type' => 'text', 'label' => false, 'value' => $this->Session->read('STEP2.id_no_'.$i), 'id' => 'outcome','class' => 'input-block-level required',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												</div>
											</div>
										</div>
										
										<div class="">
					<a id="del_<?php echo $k; ?>" class="del_row" style="cursor:pointer;margin:6px 0px 0px 10px;float:left">
						<img class="delete" rel="tooltip" title="Remove" src="<?php echo $this->webroot;?>img/cross.png"  alt="Remove" width="16" height="16" border="0"></a>
						
						</div>
									
									</div>
					
								
								<?php endif;  $k++; endfor;?>
								
								
									
								<div id="sheepItForm">
								<div  id="sheepItForm_template">
								
				

	
									<div class="row-fluid" style="clear:left;" >
									
									<div class="span2">
											<div class="control-group">
												
												<div class="controls controls-row">
													<?php echo $this->Form->input('employee', array('div'=> false,  'type' => 'text', 'autocomplete' => 'off', 'label' => false, 'name' => "data[TvlReq][employee_#index#]", 'class' => 'emp_srch input-block-level required',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												</div>
											</div>
										</div>
										
										
											<div class="span1"  style="width:40px">
											<div class="control-group">
											
												<div class="controls controls-row">
													<?php echo $this->Form->input('age', array('div'=> false,'type' => 'text', 'maxlength' => '3', 'label' => false, 'id' => 'age_#index#', 'name' => "data[TvlReq][age_#index#]", 'class' => 'age required input-block-level',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											
												</div>
											</div>
										</div>
										
										
										<div class="span1"  style="width:85px">
											<div class="control-group">
											
												<div class="controls controls-row">
													<?php echo $this->Form->input('gender', array('div'=> false,'type' => 'select','empty' => 'Select',  'options' => $gender, 'label' => false, 'name' => "data[TvlReq][gender_#index#]", 'class' => 'gender input-block-level required',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												</div>
											</div>
										</div>
										
										
										<div class="span2"  style="width:150px">
											<div class="control-group">
												<div class="controls controls-row">
													<?php echo $this->Form->input('mobile', array('div'=> false,'type' => 'text','maxlength' => '12', 'label' => false,  'name' => "data[TvlReq][mobile_#index#]",'class' => 'digitOnly mobile input-block-level required',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												</div>
											</div>
										</div>
										
										<div class="span2"  style="width:260px">
											<div class="control-group">
												
												<div class="controls controls-row">
												<?php echo $this->Form->input('email_id', array('div'=> false,'type' => 'text', 'label' => false, 'name' => "data[TvlReq][email_#index#]", 'class' => 'input-block-level email required', 'id' => 'email_#index#',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												</div>
											</div>
										</div>
									
										
										<div class="span2"  style="width:170px">
											<div class="control-group">
											
												<div class="controls controls-row">
													<?php echo $this->Form->input('id_type', array('div'=> false,'type' => 'select', 'options' => $idList, 'empty' => 'Select','label' => false, 'id' => 'id_type_#index#','name' => "data[TvlReq][id_type_#index#]", 'class' => 'input-block-level required',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												</div>
											</div>
										</div>
										
										
										<div class="span2"  style="width:150px">
											<div class="control-group">
											
												<div class="controls controls-row">
													<?php echo $this->Form->input('id_no', array('div'=> false,'type' => 'text', 'label' => false, 'id' => 'id_no_#index#','name' => "data[TvlReq][id_no_#index#]", 'class' => 'input-block-level required',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												</div>
											</div>
										</div>
										
										
										
										
									
									
						<div class="">
						<a id="sheepItForm_remove_current"  style="cursor:pointer;margin:5px 0px 0px 10px;float:left">
						<img class="delete del_row" rel="tooltip" src="<?php echo $this->webroot;?>img/cross.png" data-original-title="Remove" 
						title="Remove" alt="Remove"	width="16" height="16" border="0"></a></div>
	
								</div>
									

								</div>
							
							 <div id="sheepItForm_noforms_template"></div>

							 
							<!-- Controls -->
							  <div id="sheepItForm_controls" style="clear:left">
							  
								<div id="sheepItForm_add" style="float:right;margin-right:50px;margin-bottom:10px;"><button type="submit" id="add" class="btn btn-darkblue"><i class="icon-plus"></i> Add </button></div>
								
								
							  <!-- /Controls -->

		
								</div>

								
								
		
	
								
								
									
										
									<?php echo $this->Form->input('rec_count', array('id'=> 'rec_count', 'type' => 'hidden', 'value' => $k));?>	
									
										<?php echo $this->Form->input('form_count', array('value' => $this->Session->read('STEP2.form_count'), 'id'=> 'form_count', 'type' => 'hidden'));?>
								
										
										</div>
									
									
									
									</div>
								
							
								
									</div>
									
									
									<div class="form-actions" style="clear:left;padding-left:180px;border-top:1px solid #ddd;">

							<a href="<?php echo $this->webroot;?>tvlreq/add_request/journey/"><input type="button"  class="btn hideBtn" value="<< Prev"></a>

										<input type="submit" name="data[TvlReq][next]" style="margin-left:10px" class="save_passenger btn btn-primary" value="Next >>" id="">
									</div>
									
							<input type="hidden" value="<?php echo $this->webroot;?>tvlreq/" id="webroot">
	<input type="hidden" value="1" id="SearchKeywords">
																		
								<?php echo $this->Form->end(); ?>
							</div>
						</div>
					</div>
				</div>
				
					
				</div>
		
			
			</div>
		</div>	

