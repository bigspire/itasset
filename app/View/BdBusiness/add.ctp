<?php echo $this->element('bd_menu'); ?>
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>New Business </h1>
					</div>
					
				</div>
				<div class="breadcrumbs">
					<ul>
						
						
						<li>
							<a href="<?php echo $this->webroot;?>bdbusiness/">My Business</a>
								<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="#">New Business</a>
						</li>
					</ul>
					
				</div>
				
				<div id="flashMessage" style="display:none;" class="alert alert-error">
				<button type="button" class="close" data-dismiss="alert">×</button>Problem in submitting the form. please check errors...
				</div>
								<?php echo $this->Session->flash();?>
				<?php echo $this->Form->create('BdBusiness', array('id' => 'expForm', 'type' => 'file',  'class' => 'tvlForm validateBusiness bizForm form-horizontal form-column form-bordered')); ?>

									
				<div class="row-fluid">
					<div class="span12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3><i class="icon-building"></i> Customer Info. (Please enter As It Is in the Business Card)</h3>
							</div>
							<div class="box-content nopadding">

								
									<div class="span6">
									
									<div class="control-group">
											<label for="textfield" class="control-label">Customer <span class="red_star">*</span></label>
											<div class="controls">
												<?php echo $this->Form->input('company_name', array('div'=> false,'type' => 'text', 'id' => 'SearchText',  'autocomplete' => 'off', 'style' => 'width:292px', 'label' => false, 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											<div class="error SearchText"></div>
											</div>
										</div>
										<div class="control-group">
											<label for="textfield" class="control-label">Location <span class="red_star">*</span></label>
											<div class="controls">
													
				<?php echo $this->Form->input('state_id', array('div'=> false,'type' => 'select','label' => false, 'class' => 'chosen-select bdState input-medium',
				'empty' => 'Choose State', 'required' => false, 'placeholder' => '', 'style' => "",'options' => $stateList, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
				
					<?php echo $this->Form->input('district_id', array('div'=> false,'type' => 'select', 'label' => false, 'class' => 'chosen-select input-medium bdDist',
				'empty' => 'Choose District', 'required' => false, 'placeholder' => '', 'id' => 'location',  'style' => "",'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
				
											<div class="error location"></div>
											</div>
										</div>
										
										<div class="control-group">
											<label for="password" class="control-label">Address <span class="red_star">*</span>
										</label>
											<div class="controls">
												<?php echo $this->Form->input('address', array('div'=> false,'type' => 'textarea', 'style' => 'height:32px;', 'label' => false, 'class' => 'input-block-level autosize-transition',  'id' => 'address', 'required' => false, 'placeholder' => '',  'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												<div class="error address"></div>
												
												
											</div>
										</div>
										
										<div class="control-group">
											<label for="textfield" class="control-label">Business Spot By <span class="red_star">*</span></label>
											<div class="controls">
													
				<?php echo $this->Form->input('spot', array('div'=> false,'type' => 'select', 'multiple' => 'multiple', 'id' => 'spot', 'label' => false, 'class' => 'chosen-select input-xlarge',
				'required' => false, 'placeholder' => '', 'style' => "",'options' => $bizSpoc, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
				
				
											<div class="error spot"></div>
											</div>
										</div>
										
									</div>
							
							<div class="span6">
										<div class="control-group">
											<label for="password" class="control-label">Biz. Opportunity <span class="red_star">*</span>
										</label>
											<div class="controls">
												<?php echo $this->Form->input('bd_opportunity_id', array('div'=> false,'type' => 'select', 'label' => false, 'class' => 'input-large', 'empty' => 'Select',  'id' => 'opportunity', 'required' => false, 'placeholder' => '', 'style' => "clear:left", 'options' => $bizOpportunity, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												<div class="error opportunity"></div>
												
												
											</div>
										</div>	

<div class="control-group">
											<label for="textfield" class="control-label">Priority <span class="red_star">*</span>
 </label>
											<div class="controls">
											
												<?php echo $this->Form->input('bd_priority_id', array('div'=> false, 'empty' => 'Select', 'id' => 'priority', 'type' => 'select', 'label' => false, 'class' => 'input-large',  'options' => $bizPriority,  'separator' => ' ',  'required' => false, 'placeholder' => '', 'legend' => false, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												
												<div class="error priority"></div>
											</div>
											</div>	

<div class="control-group">
											<label for="textfield" class="control-label">Source of Business <span class="red_star">*</span>
 </label>
											<div class="controls">
											
												<?php echo $this->Form->input('bd_business_source_id', array('div'=> false, 'empty' => 'Select', 'id' => 'source', 'type' => 'select', 'label' => false, 'class' => 'bdreferSource input-large',  'options' => $bizSource,  'separator' => ' ',  'required' => false, 'placeholder' => '', 'legend' => false, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											
											<?php echo $this->Form->input('referrer', array('div'=> false,  'id' => 'referrer', 'type' => 'text', 'style' => 'display:none;margin-left:5px;', 'label' => false, 'class' => 'input-medium dn referField', 'separator' => ' ',  'required' => false, 'placeholder' => 'Name', 'legend' => false, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 

												
												<div class="error source"></div>
												<div class="error referField2" style="margin-left:220px"></div>
												
											</div>
											</div>	

											
								</div>	
										</div>
									
									</div>
									
							</div>						
					
				</div>
					
					
					<div class="row-fluid">
					<div class="span12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3><i class="icon-user"></i> Customer Contact Info. (Please enter As It Is in the Business Card)</h3>
							</div>
							<div class="box-content nopadding">
									
								<div id="sheepItDynamicForm">
						 <div id="sheepItDynamicForm_template">
										<div class="span4"  style="border-bottom:1px solid #ddd">
											<div class="control-group">
												<label for="textfield" class="control-label" style="width:100px">Name <span class="red_star">*</span></label>
												<div class="controls controls-row" style="margin-left:120px;">
												
												<?php echo $this->Form->input('title#index#', array('div'=> false,'type' => 'select', 'empty' => 'Title', 'style' => 'width:70px', 'options' => array('1' => 'Mr','2' =>  'Mrs', '3' => 'Ms'), 'label' => false, 'id' => 'biz_title#index#','class' => 'required ctitle#index#',  'required' => false)); ?> 

												<?php echo $this->Form->input('contact_name#index#', array('div'=> false,  'style' => 'margin-left:5px;width:201px', 'type' => 'text', 'label' => false, 'id' => 'contact#index#','class' => 'required input-medium contact#index#',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												</div>
											</div>
										</div>
										<div class="span4"  style="border-bottom:1px solid #ddd">
											<div class="control-group">
												<label for="textfield" class="control-label"  style="width:80px">Email <span class="red_star">*</span></label>
												<div class="controls controls-row" style="margin-left:90px;">
												<?php echo $this->Form->input('email#index#', array('div'=> false,'type' => 'text', 'label' => false, 'id' => 'email#index#','class' => 'required input-block-level emailOnly',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												</div>
											</div>
										</div>
										<div class="span4"  style="border-bottom:1px solid #ddd">
											<div class="control-group">
												<label for="textfield" class="control-label"   style="width:70px">Mobile <span class="red_star">*</span></label>
												<div class="controls controls-row" style="margin-left:80px">
												<?php echo $this->Form->input('mobile#index#', array('div'=> false,'type' => 'text', 'label' => false, 'id' => 'mobile#index#', 'maxlength' => '15', 'class' => 'digitOnly input-block-level required',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												</div>
											</div>
										</div>
										<div class="span4"  style="border-bottom:1px solid #ddd;">
											<div class="control-group">
												<label for="textfield" class="control-label"   style="width:105px;">Designation <span class="red_star">*</span></label>
												<div class="controls controls-row" style="margin-left:119px;border-right:none;">
												<?php echo $this->Form->input('designation#index#', array('div'=> false,'type' => 'text', 'label' => false,'id' => 'designation#index#','class' => 'input-block-level required',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												

												</div>
											</div>
										</div>
										
								
					
					
								
								
							<div class="span7"  style="border-bottom:1px solid #ddd">
											<div class="control-group">
												<label for="textfield" class="control-label" style="width:80px">Address </label>
												<div class="controls controls-row" style="margin-left:90px;">
												<?php echo $this->Form->input('address#index#', array('div'=> false,'type' => 'textarea', 'style' => 'height:30px',  'label' => false, 'id' => 'address#index#','class' => 'autosize-transition input-block-level address#index#',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												
		
												</div>
											</div>
										</div>
										
										<div class="span1"  style="height:51px;border-bottom:1px solid #ddd;border-left:none">
											<div class="control-group" style="background:#fff">
												<label for="textfield" style="background:#fff">
												<a id="sheepItDynamicForm_remove_current"   title="Remove Contact Details" style="text-decoration:none;float:right;margin-right:20px;" href="javascript:void(0)" rel="tooltip">
						
    
					<button type="button"  style="margin-top:12px" class="small btn btn-lightred"><i class="icon-trash" rel=""></i></button>
					</a>
					
		

					</label>
												
											</div>
										</div>
						
	<div style="clear:both;"></div>
	
	</div>				
	 <div id="sheepItDynamicForm_noforms_template"></div>
   
<div id="sheepItDynamicForm_controls" style="width:145px;">
    <div id="sheepItDynamicForm_add"><span>
	<button type="button" style="margin:10px;" class="small btn btn-teal" rel="tooltip"  title="Add Another Contact">
	<i class="icon-plus"></i> Add Another</button></span></div>
  
  </div>
							</div>									
										
						
									
										</div>
									
									
									
									</div>
									
									
									
									
							</div>
						
					
				</div>
					
					<div class="row-fluid footer_div bizFooterDiv">
					<div class="span12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3><i class="icon-time"></i> Business Info. (Please enter As It Is in the Proposal)</h3>
							</div>
							<div class="box-content nopadding">
									
								
									<div class="span6">
										
											<div class="control-group">
											<label for="password" class="control-label"><a href="javascript:void(0);" rel="popover" data-content="Date of First Discussion with Client" data-trigger="hover" data-placement="right">DOFD</a> <span class="red_star">*</span> </label>
											<div class="controls">
												<?php echo $this->Form->input('dofd', array('div'=> false,'type' => 'text', 'label' => false, 'id' => 'dofd','class' => 'input-xlarge datepick',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												<div class="error dofd"></div>
											</div>
										</div>
										
										
										<div class="control-group">
											<label for="password" class="control-label"><a href="javascript:void(0);" rel="popover" data-content="Source of Work Finalized" data-trigger="hover" data-placement="right">SOW Finalized</a> <span class="red_star">*</span></i>
 </label>
											<div class="controls">

<div class="check-line">
		<input type="radio" class='icheck-me sow_final' value="1" <?php echo $sow_done2_check1;?> name="sow_done2"> 
		<label class='inline' for="c5">Yes</label>
		
</div>

<div class="check-line">
	<input type="radio" class='icheck-me sow_final' name="sow_done2" <?php echo $sow_done2_check2;?>  value="0"> 
		<label class='inline' for="c5">No</label>	

</div>											
					<?php echo $this->Form->input('sow_done', array('type' => 'hidden', 'id' => 'sow_done'));?>
								
									
							
												<div class="error sow_fin"></div>
											</div>
										</div>
										
											<div class="control-group dn propSubDiv">
											<label for="password" class="control-label">SOW Details <span class="red_star">*</span>
										</label>
											<div class="controls">
											<?php echo $this->Form->input('sow_detail', array('div'=> false,'type' => 'textarea', 'style' => 'height:32px;', 'label' => false, 'class' => 'input-block-level autosize-transition',  'id' => 'sow_detail', 'required' => false, 'placeholder' => '',  'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); 
											?>
											
												<div class="error sow_detail"></div>
												
												
											</div>
										</div>
										
										<div class="control-group dn propSubDiv">
											<label for="password" class="control-label">Proposal Submitted <span class="red_star">*</span>
</label>
											<div class="controls">
											<div class="check-line">
		<input type="radio" class='icheck-me bdpropSub' value="1" <?php echo $proposal_done2_check1;?> name="proposal_done2"> 
		<label class='inline' for="c5">Yes</label>
		
</div>

<div class="check-line">
	<input type="radio" class='icheck-me bdpropSub' name="proposal_done2" <?php echo $proposal_done2_check2;?> value="0"> 
		<label class='inline' for="c5">No</label>	

</div>	
	<div class="error propSubmit"></div>
	<?php echo $this->Form->input('proposal_done', array('type' => 'hidden', 'id' => 'proposal_done'));?>

												
												
											</div>
										</div>
											
											
											
									</div>
									
										<div class="span6">
										
											
										<div class="control-group">
											<label for="password" class="control-label"><a href="javascript:void(0);" rel="popover" data-content="Corporate Brochure Shared" data-trigger="hover" data-placement="right">CB Shared</a> <span class="red_star">*</span> 
											</label>
											<div class="controls">
											
<div class="check-line">
		<input type="radio" class='icheck-me cbShare' value="1" id="cb_share1" <?php echo $cb_share_check1;?> name="cb_share"> 
		<label class='inline' for="c5">Yes</label>
		
</div>

<div class="check-line">
	<input type="radio" class='icheck-me cbShare' name="cb_share" id="cb_share2"  <?php echo $cb_share_check2;?> value="0"> 
		<label class='inline' for="c5">No</label>	

</div>											
	<div class="error cb_shared"></div>
	<input type="hidden" id="cb_share"/>
											
												
											</div>
										</div>
											
												<div class="control-group">
											<label for="textfield" class="control-label">Biz Vertical <span class="red_star">*</span>
 </label>
											<div class="controls">
												<?php echo $this->Form->input('hr_business_unit_id', array('div'=> false,'type' => 'select', 'label' => false, 'class' => 'input-xlarge', 'empty' => 'Select',  'id' => 'vertical', 'required' => false, 'placeholder' => '', 'style' => "clear:left", 'options' => $bizVertical, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											<div class="error vertical"></div>
											</div>
										</div>
										
											
										<?php if($bdAdmin):?>
										<div class="control-group">
											<label for="textfield" class="control-label">SPOC for Follow-up <span class="red_star">*</span>
 </label>
											<div class="controls">
												<?php echo $this->Form->input('bd_spoc_id', array('div'=> false,'type' => 'select', 'label' => false, 'class' => 'input-xlarge', 'empty' => 'Select',  'id' => 'spoc_follow', 'required' => false, 'placeholder' => '', 'style' => "clear:left", 'options' => $bizSpoc, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												<div class="error spoc_follow"></div>
											</div>
											</div>
											<?php else: 
							echo $this->Form->input('spoc_follows', array('type'=> 'hidden', 'id' => 'spoc_follow', 'value' => '1'));

											endif; ?>
											
										</div>		
									
										<div class="span12 bizSubmit">
										<div class="form-actions">
										
											<input type="submit" class="btn btn-primary save_business" value="Save" />
											<a href="<?php echo $this->webroot;?>bdbusiness/"  class="regCancel"><button type="button" class="btn hideBtn2">Cancel</button></a>
										</div>
									</div>
										</div>
									
									
									
									
									</div>
									
									
									
									
							</div>
						
					
				</div>
						
					
					<div class="row-fluid footer_div dn propDiv">
					<div class="span12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3><i class="icon-file"></i> Proposal Info.</h3>
							</div>
							<div class="box-content nopadding">
									
								
									<div class="span6">

										
											<div class="control-group">
											<label for="password" class="control-label">Project Name <span class="red_star">*</span>
 </label>
											<div class="controls">
												<?php echo $this->Form->input('project_name', array('div'=> false,'type' => 'text', 'label' => false, 'id' => 'project','class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												<div class="error project"></div>
												
												
											</div>
										</div>
										
										
											<div class="control-group">
											<label for="textfield" class="control-label">Proposal Date <span class="red_star">*</span>
 </label>
											<div class="controls">
												<?php echo $this->Form->input('proposal_date', array('div'=> false,'type' => 'text', 'label' => false, 'id' => 'proposal_date','class' => 'input-xlarge datepick',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												<div class="error proposal_date"></div>
											</div>
											</div>
											
												<div class="control-group dn agrsignDiv">
											<label for="textfield" class="control-label">Agreement Signed <span class="red_star">*</span>
 </label>
											<div class="controls">
											<div class="check-line">
		<input type="radio" class='icheck-me agree_sign' <?php echo $agree_sign_check1;?> value="1" name="agree_sign"> 
		
		
		<label class='inline' for="c5">Yes</label>
		
</div>

<div class="check-line">
	<input type="radio" class='icheck-me agree_sign' <?php echo $agree_sign_check2;?> name="agree_sign" value="0"> 
		<label class='inline' for="c5">No</label>	

</div>		

	<?php echo $this->Form->input('agreement_sign', array('type' => 'hidden', 'id' => 'agreement_sign'));?>


	<div class="error sign"></div>
											</div>
											</div>
											
										
										<div class="control-group dn workStartDiv">
											<label for="textfield" class="control-label">Work Started <span class="red_star">*</span>
 </label>
											<div class="controls">
									<div class="check-line">
		<input type="radio" class='icheck-me workStatus' value="1" <?php echo $work_start_check1;?> name="work_start"> 
		<label class='inline' for="c5">Yes</label>
		
</div>

<div class="check-line">
	<input type="radio" class='icheck-me workStatus' name="work_start" <?php echo $work_start_check2;?> value="0"> 
		<label class='inline' for="c5">No</label>	

</div>												<div class="error work_status"></div>
											</div>
											</div>
											
			<?php echo $this->Form->input('work_status', array('type' => 'hidden', 'id' => 'work_status'));?>
			<?php echo $this->Form->input('work_clicked', array('type' => 'hidden', 'value' => '0', 'id' => 'work_clicked'));?>
											
									</div>
									
										<div class="span6">
										
											
									
										
									<div class="control-group">
											<label for="textfield" class="control-label">Proposal Ver. <span class="red_star">*</span>
 </label>
											<div class="controls">
												<div class="fileUpload btn btn-warning btn-minier" align="center">
				<span style="color:#fff;">Attach Proposal</span>
				<div class="input file"><input type="file" name="data[BdBusiness][upload_file]" class="upload validFileType validFileSize" id="uploadFile"></div>				
				</div>

					<a href="javascript:void(0)" class="dn submitUploadCan">Cancel</a>


						<?php echo $this->Form->input('bd_proposal_version_id', array('div'=> false,'type' => 'select', 'label' => false, 'class' => 'input-medium', 'empty' => 'Select',  'id' => 'proposal_ver', 'required' => false, 'placeholder' => '', 'style' => "clear:left", 'options' => $propVersion, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
						<br>
<span id="file_name"></span>
												<div class="error error_file_type"></div>
												<div class="error error_file_size"></div>
												<div class="error uploadFile"></div>
												<div class="error proposal_ver"></div>
												
	<input type="hidden" id="valid_file_type" value="doc,docx,pdf"/>
												
											</div>
											</div>
										
			<input type="hidden" id="upload_doc" value=""/>
	
										
										
										
									
										<div class="control-group">
											<label for="textfield" class="control-label">Proposal Approved <span class="red_star">*</span>
 </label>
											<div class="controls">
	<div class="check-line">
		<input type="radio" class='icheck-me prop_approve' value="1" <?php echo $proposal_approve2_check1;?>  name="proposal_approve2"> 
		<label class='inline' for="c5">Yes</label>
		
</div>

<div class="check-line">
	<input type="radio" class='icheck-me prop_approve' <?php echo $proposal_approve2_check2;?>  name="proposal_approve2" value="0"> 
		<label class='inline' for="c5">No</label>	

</div>											
			<?php echo $this->Form->input('proposal_approve', array('type' => 'hidden', 'id' => 'proposal_approve'));?>

		
												<div class="error proposal_apr"></div>
											</div>
											</div>
											
										


											
												
											<div class="control-group dn agmttNo">
											<label for="textfield" class="control-label">Agreement No. <span class="red_star">*</span>
 </label>
											<div class="controls">
												<?php echo $this->Form->input('agreement_no', array('div'=> false,'type' => 'text', 'label' => false, 'id' => 'agree_no','class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												<div class="error agree_no"></div>
											</div>
											</div>
											
											
												<!--div class="control-group dn workCompDiv">
											<label for="textfield" class="control-label">Work Complete 
 </label>
											<div class="controls">
											<div class="check-line">
		<input type="radio" class='icheck-me work_comp' <?php echo $work_comp_check1;?> value="1" name="work_comp"> 
		
		
		<label class='inline' for="c5">Yes</label>
		
</div>

<div class="check-line">
	<input type="radio" class='icheck-me work_comp' <?php echo $work_comp_check2;?> name="work_comp" value="0"> 
		<label class='inline' for="c5">No</label>	

</div>		

	<?php //echo $this->Form->input('work_complete', array('type' => 'hidden', 'id' => 'work_complete'));?>


	<div class="error work_comp"></div>
											</div>
											</div-->
											
										</div>		
									
										<div class="span12">
										<div class="form-actions">
										
											<input type="submit" class="btn btn-primary save_business" value="Save" />
											<a href="<?php echo $this->webroot;?>bdbusiness/" class="regCancel"><button type="button" class="btn hideBtn2">Cancel</button></a>
										</div>
									</div>
										</div>
									
									
									
									
									</div>
									
									
									
									
							</div>
						
					
				</div>
					
		<input type="hidden" value="<?php echo date('d/m/Y');?>" id="end_date">
					<input type="hidden" value="1" class="init_form"/>			

	<?php echo $this->Form->input('form_count', array('type' => 'hidden', 'id' => 'form_count', 'value' => '1'));?>
									<?php echo $this->Form->input('page', array('type' => 'hidden', 'id' => 'page', 'value' => 'add_business'));?>
<input type="hidden" value="1" id="SearchKeywords">
						<input type="hidden" value="<?php echo $this->webroot;?>bdbusiness/" id="webroot">
						<?php echo $this->Form->end(); ?>

				</div>
		
			
			</div>
		</div>	
			


