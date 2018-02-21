<?php echo $this->element('bd_menu'); ?>
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Edit Business </h1>
					</div>
					
				</div>
				<div class="breadcrumbs">
					<ul>
						
						
						<li>
							<a href="<?php echo $this->webroot;?>bdbusiness/">My Business</a>
								<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="#">Edit Business</a>
						</li>
					</ul>
					
				</div>
				
				<div id="flashMessage" style="display:none;" class="alert alert-error">
				<button type="button" class="close" data-dismiss="alert">×</button>Problem in submitting the form. please check errors...
				</div>
								<?php echo $this->Session->flash();?>

				<?php echo $this->Form->create('BdBusiness', array('id' => 'formID', 'type' => 'file',  'class' => 'tvlForm validateBusiness bizForm form-horizontal form-column form-bordered')); ?>
									
				<div class="row-fluid">
					<div class="span12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3><i class="icon-building"></i> Customer Info. (Please enter As It Is in the Business Card)</h3>
							</div>
							<div class="box-content nopadding">

								
								
									<div class="span6">
									
									<div class="control-group">
											<label for="textfield" class="control-label">Customer <?php echo $this->Functions->show_mandatory($bdAdmin);?></label>
											<div class="controls">
											<?php if($bdAdmin):
											echo $this->Form->input('company_name', array('div'=> false,'type' => 'text', 'label' => false, 'id' => 'SearchText','class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); 
											else:
										    echo ucwords($this->request->data['BdBusiness']['company_name']);
											echo $this->Form->input('customers', array('type'=> 'hidden', 'id' => 'SearchText', 'value' => '1'));

											endif;
											?>
											<div class="error SearchText"></div>
											</div>
										</div>
										<div class="control-group">
											<label for="textfield" class="control-label">Location <?php echo $this->Functions->show_mandatory($bdAdmin);?></label>
											<div class="controls">
											<?php if($bdAdmin):
											
					echo $this->Form->input('state_id', array('div'=> false,'type' => 'select','label' => false, 'class' => 'chosen-select bdState input-medium',
				'empty' => 'Choose State', 'required' => false, 'placeholder' => '', 'style' => "",'options' => $stateList, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error'))));  
				
				echo ' ';	 echo $this->Form->input('district_id', array('div'=> false,'type' => 'select', 'label' => false, 'class' => 'chosen-select input-medium bdDist',
				'empty' => 'Choose District', 'required' => false, 'placeholder' => '', 'options' => $districtList, 'id' => 'location',  'style' => "",'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); 
															else:
										    echo $this->request->data['State']['state_name'];
											echo ', '.$this->request->data['District']['district_name'];
											echo $this->Form->input('locations', array('type'=> 'hidden', 'id' => 'location', 'value' => '1'));
											endif;
											?>
											<div class="error location"></div>
											</div>
										</div>
										
										<div class="control-group">
											<label for="password" class="control-label">Address <?php echo $this->Functions->show_mandatory($bdAdmin);?>
										</label>
											<div class="controls">
											<?php if($bdAdmin):
											echo $this->Form->input('address', array('div'=> false,'type' => 'textarea', 'style' => 'height:32px;', 'label' => false, 'class' => 'input-block-level autosize-transition',  'id' => 'address', 'required' => false, 'placeholder' => '',  'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); 
											else:
										    echo $this->request->data['BdBusiness']['address'];
											echo $this->Form->input('addresses', array('type'=> 'hidden', 'id' => 'address', 'value' => '1'));
											endif;
											?>
											
												<div class="error address"></div>
												
												
											</div>
										</div>
										
											<div class="control-group">
											<label for="textfield" class="control-label">Business Spot By <?php echo $this->Functions->show_mandatory($bdAdmin);?></label>
											<div class="controls">
													
				<?php if($bdAdmin):
					echo $this->Form->input('spot', array('div'=> false,'type' => 'select', 'multiple' => 'multiple', 'id' => 'spot', 'label' => false, 'class' => 'chosen-select input-xlarge',
				'required' => false, 'placeholder' => '', 'selected' => $selSpot, 'options' => $bizSpoc, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error'))));  
															else:
										    echo $spot_user;
											echo $this->Form->input('spots', array('type'=> 'hidden', 'id' => 'spot', 'value' => '1'));
											endif;
											?>
											
				 
				
											<div class="error spot"></div>
											</div>
										</div>
										
									</div>
							
							<div class="span6">
										<div class="control-group">
											<label for="password" class="control-label">Biz. Opportunity <?php echo $this->Functions->show_mandatory($bdAdmin);?>
										</label>
											<div class="controls">
											<?php if($bdAdmin):
											echo $this->Form->input('bd_opportunity_id', array('div'=> false,'type' => 'select', 'label' => false, 'class' => 'input-large', 'empty' => 'Select',  'id' => 'opportunity', 'required' => false, 'placeholder' => '', 'style' => "clear:left", 'options' => $bizOpportunity, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); 
											else:
										    echo $this->request->data['BdOpportunity']['title'];
											echo $this->Form->input('opportunitys', array('type'=> 'hidden', 'id' => 'opportunity', 'value' => '1'));
											endif;
											?>
											
											
												<div class="error opportunity"></div>
												
												
											</div>
										</div>	

<div class="control-group">
											<label for="textfield" class="control-label">Priority <?php echo $this->Functions->show_mandatory($bdAdmin);?>
 </label>
											<div class="controls">
											
											<?php if($bdAdmin):
											echo $this->Form->input('bd_priority_id', array('div'=> false, 'empty' => 'Select', 'id' => 'priority', 'type' => 'select', 'label' => false, 'class' => 'input-large',  'options' => $bizPriority,  'separator' => ' ',  'required' => false, 'placeholder' => '', 'legend' => false, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error'))));
											else:
										    echo $this->request->data['BdPriority']['title'];
											echo $this->Form->input('prioritys', array('type'=> 'hidden', 'id' => 'priority', 'value' => '1'));
											endif;
											?>
											
												
												<div class="error priority"></div>
											</div>
											</div>		

	<div class="control-group">
											<label for="password" class="control-label">Source of Business <?php echo $this->Functions->show_mandatory($bdAdmin);?>
										</label>
											<div class="controls">
											<?php if($bdAdmin):
											echo $this->Form->input('bd_business_source_id', array('div'=> false, 'empty' => 'Select', 'id' => 'source', 'type' => 'select', 'label' => false, 'class' => 'bdreferSource input-large',  'options' => $bizSource,  'separator' => ' ',  'required' => false, 'placeholder' => '', 'legend' => false, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); 											
											echo $this->Form->input('referrer', array('div'=> false,  'id' => 'referrer', 'type' => 'text', 'style' => 'display:none;margin-left:5px;', 'label' => false, 'class' => 'input-medium dn referField', 'separator' => ' ',  'required' => false, 'placeholder' => 'Name', 'legend' => false, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); 
											else:
										    echo $this->request->data['BdBizSource']['title'];
												if($this->request->data['BdBusiness']['referrer']):
													echo ', '.ucwords($this->request->data['BdBusiness']['referrer']);
												endif; 
											echo $this->Form->input('sources', array('type'=> 'hidden', 'id' => 'source', 'value' => '1'));
											echo $this->Form->input('sources2', array('type'=> 'hidden', 'class' => 'referField', 'id' => 'referrer', 'value' => '1'));
											endif;
											?>
											
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
									
									<?php if(!$bdAdmin):?>
									<?php foreach($admin_contact_data as $admin_contact):?>
									
										<div class="span4"  style="border-bottom:1px solid #ddd">
											<div class="control-group">
												<label for="textfield" class="control-label" style="width:100px">Name </label>
												<div class="controls controls-row" style="margin-left:120px;">
												
												<?php echo $this->Functions->get_contact_title($admin_contact['BdBizContact']['title']);?> 

												<?php echo ucwords($admin_contact['BdBizContact']['contact_name']);?>
												</div>
											</div>
										</div>
										<div class="span4"  style="border-bottom:1px solid #ddd">
											<div class="control-group">
												<label for="textfield" class="control-label"  style="width:80px">Email </label>
												<div class="controls controls-row" style="margin-left:90px;">
												<?php echo $admin_contact['BdBizContact']['email'];?>
												</div>
											</div>
										</div>
										<div class="span4"  style="border-bottom:1px solid #ddd">
											<div class="control-group">
												<label for="textfield" class="control-label"   style="width:70px">Mobile </label>
												<div class="controls controls-row" style="margin-left:80px">
												<?php echo $admin_contact['BdBizContact']['mobile'];?>
												</div>
											</div>
										</div>
										<div class="span4"  style="border-bottom:1px solid #ddd;">
											<div class="control-group">
												<label for="textfield" class="control-label"   style="width:105px;">Designation </label>
												<div class="controls controls-row" style="margin-left:119px;border-right:none;">
												<?php echo ucwords($admin_contact['BdBizContact']['designation']);?>
												

												</div>
											</div>
										</div>
										
										<div class="span8"  style="border-bottom:1px solid #ddd">
											<div class="control-group">
												<label for="textfield" class="control-label" style="width:80px">Address </label>
												<div class="controls controls-row" style="margin-left:90px;">
												<?php echo ucwords($admin_contact['BdBizContact']['address']);?>
												
		
												</div>
											</div>
										</div>
								
									
									
				<div class="span4"  style="height:51px;border-bottom:1px solid #ddd;border-left:none">
											<div class="control-group" style="background:#fff">
												<label for="textfield" style="background:#fff">
												&nbsp;
					
					</label>
												
											</div>
										</div>
										
										
									<?php endforeach; ?>	
									<?php endif; ?>
									
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
								
											<?php echo $this->Form->input('contact_id#index#', array('type' => 'hidden', 'id' => 'contact_id#index#'));?>
												<?php echo $this->Form->input('contact_created#index#', array('type' => 'hidden', 'id' => 'contact_created#index#'));?>
					
								<div class="span1"  style="height:51px;border-bottom:1px solid #ddd;border-left:none">
											<div class="control-group" style="background:#fff">
												<label for="textfield" style="background:#fff">
												<a id="sheepItDynamicForm_remove_current" title="Remove Contact Details" style="text-decoration:none;float:right;margin-right:20px;" href="javascript:void(0)">
						
    
					<span><button type="button"  style="margin-top:12px"  class="small btn btn-lightred"><i class="icon-trash" rel=""></i></button></span>
					</a>
					
					</label>
												
											</div>
										</div>
										
	
	</div>		
	
	 <div id="sheepItDynamicForm_noforms_template"></div>
   
<div id="sheepItDynamicForm_controls" style="width:145px;">
    <div id="sheepItDynamicForm_add"><span>
	<button type="button" style="margin:10px;" class="small btn btn-teal" rel="tooltip"  title="Add Another Contact">
	<i class="icon-plus"></i> Add Another</button></span></div>
  
  </div>
							</div>									
										
						<div class="error noForm"></div>
									
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
											<label for="password" class="control-label"><a href="javascript:void(0);" rel="popover" data-content="Date of First Discussion with Client" data-trigger="hover" data-placement="right">DOFD</a> <?php echo $this->Functions->show_mandatory($bdAdmin);?> 
											</label>
											<div class="controls">
											<?php if($bdAdmin):
											echo $this->Form->input('dofd', array('div'=> false,'type' => 'text', 'label' => false, 'id' => 'dofd','class' => 'input-large datepick',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); 
											else:
										    echo $this->request->data['BdBusiness']['dofd'];
											echo $this->Form->input('dofds', array('type'=> 'hidden', 'id' => 'dofd', 'value' => '1'));
											endif;
											?>
												<div class="error dofd"></div>
											</div>
										</div>
										
										
											
										<div class="control-group">
											<label for="password" class="control-label"><a href="javascript:void(0);" rel="popover" data-content="Source of Work Finalized" data-trigger="hover" data-placement="right">SOW Finalized</a> <span class="red_star">*</span>
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
											<label for="password" class="control-label"><a href="javascript:void(0);" rel="popover" data-content="Corporate Brochure Shared" data-trigger="hover" data-placement="right">CB Shared</a> <?php echo $this->Functions->show_mandatory($bdAdmin);?>
											</label>
											<div class="controls">
											
												<?php 
											if($bdAdmin):?>
											<div class="check-line">
		<input type="radio" class='icheck-me cbShare' value="1" id="cb_share1" <?php echo $cb_share_check1;?> name="cb_share"> 
		<label class='inline' for="c5">Yes</label>
		
</div>

<div class="check-line">
	<input type="radio" class='icheck-me cbShare' name="cb_share" id="cb_share2"  <?php echo $cb_share_check2;?> value="0"> 
		<label class='inline' for="c5">No</label>	

</div>											
	<div class="error cb_shared"></div>
	
		<?php echo $this->Form->input('cb_share', array('type' => 'hidden', 'id' => 'cb_share'));?>	
		
											<?php else:
										    echo $this->request->data['BdBusiness']['cb_share'] ? 'Yes' : 'No';
											echo $this->Form->input('cb_shares', array('type'=> 'hidden', 'id' => 'cb_share', 'value' => '1'));
											endif;
											?>
											
								
												
											</div>
										</div>
											
												<div class="control-group">
											<label for="textfield" class="control-label">Biz Vertical <?php echo $this->Functions->show_mandatory($bdAdmin);?>
 </label>
											<div class="controls">
												<?php 
											if($bdAdmin):
											echo $this->Form->input('hr_business_unit_id', array('div'=> false,'type' => 'select', 'label' => false, 'class' => 'input-xlarge', 'empty' => 'Select',  'id' => 'vertical', 'required' => false, 'placeholder' => '', 'style' => "clear:left", 'options' => $bizVertical, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error'))));
											else:
										    echo $this->request->data['HrBusinessUnit']['business_unit'];
											echo $this->Form->input('verticals', array('type'=> 'hidden', 'id' => 'vertical', 'value' => '1'));
											endif;
											?>
											
											<div class="error vertical"></div>
											</div>
										</div>
										
											
											<div class="control-group">
											<label for="textfield" class="control-label">SPOC for Follow-up <?php echo $this->Functions->show_mandatory($bdAdmin);?>
 </label>
											<div class="controls">
											<?php 
											if($bdAdmin):
											echo $this->Form->input('bd_spoc_id', array('div'=> false,'type' => 'select', 'label' => false, 'class' => 'input-xlarge', 'empty' => 'Select',  'id' => 'spoc_follow', 'required' => false, 'placeholder' => '', 'style' => "clear:left", 'options' => $bizSpoc, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); 
											else:
										    echo $this->request->data['Employee']['first_name'].' '.$this->request->data['Employee']['last_name'];
											echo $this->Form->input('spoc_follows', array('type'=> 'hidden', 'id' => 'spoc_follow', 'value' => '1'));
											endif;
											?>
												<div class="error spoc_follow"></div>
											</div>
											</div>
										</div>		
									
										<div class="span12 bizSubmit">
										<div class="form-actions">
										
											<?php 
										if($this->request->data['BdBusiness']['is_approve'] == 'W'):?>
											<input type="submit" class="btn btn-success save_business" value="Approve" />
											<a href="javascript:void(0);">
											<button type="button" name="<?php echo $this->webroot;?>bdbusiness/reject_business/<?php echo $this->request->params['pass'][0];?>" class="btn btn-red rejectRec">Reject</button></a>
										<?php else: ?>	
											<input type="submit" class="btn btn-primary save_business" value="Save" />
										<?php endif; ?>	
											<a href="<?php echo $this->webroot;?>bdbusiness/"><button type="button" class="btn hideBtn2">Cancel</button></a>
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
<?php echo $this->Form->input('work_started', array('type' => 'hidden', 'value' => $this->request->data['BdBusiness']['work_start'], 'id' => 'work_started'));?>

											
									</div>
									
										<div class="span6">
										
											
									
										
									<div class="control-group">
											<label for="textfield" class="control-label">Proposal Ver. <span class="red_star">*</span>
 </label>
											<div class="controls">
												<div class="fileUpload btn btn-warning btn-minier" align="center">
												
												<?php if(!empty($this->request->data['BdBusiness']['proposal_doc'])):?>
																<span style="color:#fff;">Edit Proposal</span>

												<?php else: ?>
																<span style="color:#fff;">Attach Proposal</span>

												<?php endif; ?>
				<div class="input file"><input type="file" name="data[BdBusiness][upload_file]" class="upload  validFileType validFileSize" id="uploadFile"></div>				
				</div>

					<a href="javascript:void(0)" class="dn submitUploadCan">Cancel</a>


						<?php echo $this->Form->input('bd_proposal_version_id', array('div'=> false,'type' => 'select', 'label' => false, 'class' => 'input-medium', 'empty' => 'Select',  'id' => 'proposal_ver', 'required' => false, 'placeholder' => '', 'style' => "clear:left", 'options' => $propVersion, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
						
						<?php if(!empty($this->request->data['BdBusiness']['proposal_doc'])):?>
							<br><br><a href="<?php echo $this->webroot;?>bdbusiness/download_proposal/<?php echo $this->request->data['BdBusiness']['proposal_doc'];?>/" class="btn btn-lightgrey" rel="tooltip" title="Download"><?php echo $this->Functions->string_truncate($this->request->data['BdBusiness']['proposal_doc'], 25);?></a>
						
						<?php endif; ?>
<span id="file_name"></span>
												<div class="error error_file_type"></div>
												<div class="error error_file_size"></div>
												<div class="error uploadFile"></div>
												<div class="error proposal_ver"></div>
	<input type="hidden" id="valid_file_type" value="doc,docx,pdf"/>

												
											</div>
											</div>
										
			<input type="hidden" id="upload_doc" value="<?php echo $this->request->data['BdBusiness']['proposal_doc'];?>"/>
										
										
										
									
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
											
											<div class="control-group dn workCompDiv">
											<label for="textfield" class="control-label">Work Status 
 </label>
											<div class="controls">
											<div class="check-line" style="float:none;">
		<input type="radio" class='icheck-me work_comp' <?php echo $work_comp_check1;?> value="1" name="work_comp"> 
		
		
		<label class='inline' for="c5">Active/Inprogress</label>
		
</div>

<div class="check-line" style="float:none;">
	<input type="radio" class='icheck-me work_comp' <?php echo $work_comp_check2;?> name="work_comp" value="0"> 
		<label class='inline' for="c5">Inactive/Completed</label>	

</div>		

	<?php //echo $this->Form->input('work_complete', array('type' => 'hidden', 'id' => 'work_complete'));?>


	<div class="error work_comp"></div>
											</div>
											</div>
										</div>		
									
										<div class="span12">
										<div class="form-actions">
										<?php 
										if($this->request->data['BdBusiness']['is_approve'] == 'W'):?>
											<input type="submit" class="btn btn-success save_business" value="Approve" />
											<a href="javascript:void(0);">
											<button type="button" name="<?php echo $this->webroot;?>bdbusiness/reject_business/<?php echo $this->request->params['pass'][0];?>" class="btn btn-red rejectRec">Reject</button></a>
										<?php else: ?>	
											<input type="submit" class="btn btn-primary save_business" value="Save" />
										<?php endif; ?>	
											<a href="<?php echo $this->webroot;?>bdbusiness/"><button type="button" class="btn hideBtn2">Cancel</button></a>
										</div>
									</div>
										</div>
									
									
									
									
									</div>
									
									
									
									
							</div>
						
					
				</div>
		

<?php foreach($contact_data as $key => $record):?>
<input type="hidden" id="Ctitle<?php echo $key;?>" value="<?php echo $record['BdBizContact']['title'];?>">

<input type="hidden" id="Cname<?php echo $key;?>" value="<?php echo $record['BdBizContact']['contact_name'];?>">
<input type="hidden" id="Cemail<?php echo $key;?>" value="<?php echo $record['BdBizContact']['email'];?>">
<input type="hidden" id="Cmobile<?php echo $key;?>" value="<?php echo $record['BdBizContact']['mobile'];?>">
<input type="hidden" id="Cdesig<?php echo $key;?>" value="<?php echo $record['BdBizContact']['designation'];?>">
<input type="hidden" id="Cid<?php echo $key;?>" value="<?php echo $record['BdBizContact']['id'];?>">
<input type="hidden" id="Ccreated<?php echo $key;?>" value="<?php echo $record['BdBizContact']['created_by'];?>">

<?php endforeach; ?>	

<input type="hidden" value="<?php echo $tot_contact;?>" class="init_form"/>		
<input type="hidden" value="<?php echo $bdAdmin?>" class="min_form"/>		

		<input type="hidden" value="<?php echo date('d/m/Y');?>" id="end_date">
		<?php echo $this->Form->input('user_type', array('type' => 'hidden', 'id' => 'user_type', 'value' => $bdAdmin));?>

									<?php echo $this->Form->input('id', array('type' => 'hidden'));?>
									<?php echo $this->Form->input('page', array('type' => 'hidden', 'id' => 'page', 'value' => 'edit'));?>
<input type="hidden" value="<?php echo $this->webroot;?>" id="webroot"/>
	<?php echo $this->Form->input('is_approve', array('type' => 'hidden', 'id' => 'is_approve'));?>

	<?php echo $this->Form->input('form_count', array('type' => 'hidden', 'id' => 'form_count', 'value' => '1'));?>
	
												<?php echo $this->Form->end(); ?>

				</div>
		
			
			</div>
		</div>	
			

<div id="dialog-rej-confirm" title="Reject Confirmation!" class="dn">
	<p>Are you sure you want to reject?</p>
		<?php echo $this->Form->input('remarks', array('div'=> false,'type' => 'textarea', 'label' => false, 'class' => 'input-block-level', 'id' => 'remarks', 'required' => false, 'placeholder' => '', 'rows' => '4', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
</div>	

