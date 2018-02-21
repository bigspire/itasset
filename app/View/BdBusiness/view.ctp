<style>
.form-horizontal.form-bordered .control-group .control-label {
    padding: 10px 10px 0px 10px !important;
}
</style>
		<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				

				<?php echo $this->Form->create('BdBusiness', array('id' => 'expForm', 'class' => 'validateBusiness bizForm form-horizontal form-column form-bordered')); ?>
									
				<div class="row-fluid">
					<div class="span12">
						<div class="box">
							<div class="box-title">
								<h3><i class="icon-building"></i> Customer Info.</h3>
							</div>
							<div class="box-content nopadding">

								
								
									<div class="span6" style="border-bottom:1px solid #ddd;">
									
									<div class="control-group">
											<label for="textfield" class="control-label">Customer </label>
											<div class="controls">
											<?php echo ucwords($biz_data['BdBusiness']['company_name']);?>
											</div>
										</div>
										<div class="control-group">
											<label for="textfield" class="control-label">Location </label>
											<div class="controls">
									<?php echo $biz_data['State']['state_name'];
											echo ', '.$biz_data['District']['district_name'];?>
											</div>
										</div>
										<div class="control-group">
											<label for="textfield" class="control-label">Address </label>
											<div class="controls">
											<?php echo $biz_data['BdBusiness']['address'];?>
											</div>
										</div>
										<div class="control-group">
											<label for="textfield" class="control-label">Business Spot By </label>
											<div class="controls">
											<?php  echo $spot_user;?>
											</div>
										</div>
										<div class="control-group">
											<label for="textfield" class="control-label">Created By </label>
											<div class="controls">
									<?php echo ucwords($biz_data['Creator']['first_name'].' '.$biz_data['Creator']['last_name']);?>
											</div>
										</div>
									</div>
							
							<div class="span6" style="border-bottom:1px solid #ddd;">
										<div class="control-group">
											<label for="password" class="control-label">Biz. Opportunity 
										</label>
											<div class="controls">
	<?php echo $biz_data['BdOpportunity']['title'];?>												
												
											</div>
										</div>	

<div class="control-group">
											<label for="textfield" class="control-label">Priority 
 </label>
											<div class="controls">
											
	<?php echo $biz_data['BdPriority']['title'];?>												
												
											</div>
											</div>	
											<div class="control-group">
											<label for="textfield" class="control-label">Source of Business 
 </label>
											<div class="controls">
											
	<?php echo $biz_data['BdBizSource']['title'];
												if($biz_data['BdBusiness']['referrer']):
													echo ', '.ucwords($biz_data['BdBusiness']['referrer']);
												endif; ?>												
												
											</div>
											</div>	

<div class="control-group">
											<label for="textfield" class="control-label">Created On </label>
											<div class="controls">
									<?php echo $this->Functions->format_date($biz_data['BdBusiness']['created_date']);?>
											</div>
										</div>	

						<?php if($biz_data['BdBusiness']['remark'] != ''):?>
							<div class="control-group">
											<label for="textfield" class="control-label"><span style="color:#ff0000">Reason (Reject) </span></label>
											<div class="controls">
									<?php echo $biz_data['BdBusiness']['remark'];?>
											</div>
										</div>	
								<?php endif; ?>		
								</div>	
										</div>
									
									</div>
									
							</div>						
					
				</div>
					
					
					<div class="row-fluid">
					<div class="span12">
						<div class="box">
							<div class="box-title">
								<h3><i class="icon-user"></i> Customer Contact Info.</h3>
							</div>
							<div class="box-content nopadding">
									<?php foreach($contact_data as $contact):?>
										<div class="span4"  style="border-bottom:1px solid #ddd;clear:both;">
											<div class="control-group">
												<label for="textfield" class="control-label">Contact Name </label>
												<div class="controls controls-row">
												<?php echo ucwords($contact['BdBizContact']['contact_name']);?>
												</div>
											</div>
										</div>
										<div class="span4"  style="border-bottom:1px solid #ddd">
											<div class="control-group">
												<label for="textfield" class="control-label" >Email </label>
												<div class="controls controls-row">
									<?php echo $contact['BdBizContact']['email'];?>
												</div>
											</div>
										</div>
										<div class="span4"  style="border-bottom:1px solid #ddd">
											<div class="control-group">
												<label for="textfield" class="control-label">Mobile </label>
												<div class="controls controls-row">
						<?php echo $contact['BdBizContact']['mobile'];?>				
						</div>
											</div>
										</div>
										<div class="span4"  style="border-bottom:1px solid #ddd;">
											<div class="control-group">
												<label for="textfield" class="control-label">Designation </label>
												<div class="controls controls-row" style="border-right:none;">
											<?php echo ucwords($contact['BdBizContact']['designation']);?>
											</div>
											</div>
										</div>
									<div class="span8"  style="border-bottom:1px solid #ddd;">
											<div class="control-group">
												<label for="textfield" class="control-label">Address </label>
												<div class="controls controls-row" style="border-right:none;">
											<?php echo $contact['BdBizContact']['address'];?>
											</div>
											</div>
										</div>
										<?php endforeach; ?>
								
					
					
						
						
	
					</div>									
										
						
									
									
									
									
									
									
							</div>
						
					
				</div>
					
					<div class="row-fluid">
					<div class="span12">
						<div class="box">
							<div class="box-title">
								<h3><i class="icon-time"></i> Business Info.</h3>
							</div>
							<div class="box-content nopadding">
									
								
									<div class="span6">
										
											<div class="control-group">
											<label for="password" class="control-label">DOFD   </label>
											<div class="controls">
													<?php echo $this->Functions->format_date($biz_data['BdBusiness']['dofd']);?>
													<div class="error dofd"></div>
											</div>
										</div>
										
										<div class="control-group">
											<label for="textfield" class="control-label">SPOC for Follow-up 
 </label>
											<div class="controls">
											<?php echo $biz_data['Employee']['first_name'].' '.$biz_data['Employee']['last_name'];?>
												<div class="error spoc_follow"></div>
											</div>
											</div>
											
										<div class="control-group">
											<label for="password" class="control-label">SOW Finalized  
 </label>
											<div class="controls">

					<?php echo $biz_data['BdBusiness']['sow_done'] ? 'Yes' : 'No';?>
							
											</div>
										</div>
										
									<?php if($biz_data['BdBusiness']['sow_done']):?>	
									<div class="control-group">
											<label for="password" class="control-label">SOW Details  
 </label>
											<div class="controls">

					<?php echo $biz_data['BdBusiness']['sow_detail'];?>
							
											</div>
										</div>
											
									<?php endif; ?>		
											
											
									</div>
									
										<div class="span6">
										
											
										<div class="control-group">
											<label for="password" class="control-label">CB Shared  
											</label>
											<div class="controls">
											
<?php echo $biz_data['BdBusiness']['cb_share'] ? 'Yes' : 'No';?>						
												
											</div>
										</div>
											
												<div class="control-group">
											<label for="textfield" class="control-label">Biz Vertical 
 </label>
											<div class="controls">
					<?php echo $biz_data['HrBusinessUnit']['business_unit'];?>						
											<div class="error vertical"></div>
											</div>
										</div>
										
										
										<?php if($biz_data['BdBusiness']['sow_done'] == '1'):?>
											<div class="control-group">
											<label for="password" class="control-label">Proposal Submitted 
</label>
											<div class="controls">

												<?php echo $biz_data['BdBusiness']['proposal_done'] ? 'Yes' : 'No';?>	
												
											</div>
										</div>
										
										<?php endif; ?>
											
										</div>		
									<input type="hidden"  value="<?php echo $biz_data['BdBusiness']['proposal_done'];?>" id="proposal_done"/>
										<div class="span12 bizSubmit">
										<div class="form-actions">
										
											<a href="javascript:void(0);" class="close_colorBox"><button type="button" class="btn">Close</button></a>
										</div>
									</div>
									
									
										</div>
									
									
									
									
									</div>
									
									
									
									
							</div>
						
					
				</div>
						
				<?php if($biz_data['BdBusiness']['proposal_done']):?>	
					<div class="row-fluid">
					<div class="span12">
					
						<div class="box">
							<div class="box-title">
								<h3><i class="icon-file"></i> Proposal Info.</h3>
							</div>
							<div class="box-content nopadding">
									
								
									<div class="span6">

										
											<div class="control-group">
											<label for="password" class="control-label">Project Name 
 </label>
											<div class="controls">
											
							<?php echo ucwords($biz_data['BdBusiness']['project_name']);?>											
												
												
											</div>
										</div>
										
										
											<div class="control-group">
											<label for="textfield" class="control-label">Proposal Date 
 </label>
											<div class="controls">
												<?php echo $this->Functions->format_date($biz_data['BdBusiness']['proposal_date']);?>
											</div>
											</div>
											
											<?php if($biz_data['BdBusiness']['proposal_approve'] == '1'):?>
												<div class="control-group">
											<label for="textfield" class="control-label">Agreement Signed 
 </label>
											<div class="controls">
											<?php echo $biz_data['BdBusiness']['agreement_sign'] ? 'Yes' : 'No'; ?>
											</div>
											</div>
											<?php endif; ?>
										
										<?php if($biz_data['BdBusiness']['agreement_sign'] == '1'):?>
										<div class="control-group">
											<label for="textfield" class="control-label">Work Started 
 </label>
											<div class="controls">
									<?php echo $biz_data['BdBusiness']['work_start'] ? 'Yes' : 'No'; ?>
											</div>
											</div>
										<?php endif; ?>	
											
											
									</div>
									
										<div class="span6">
										
											
									
										
									<div class="control-group">
											<label for="textfield" class="control-label">Proposal Doc. / Ver. 
 </label>
											<div class="controls">
						<?php if(!empty($biz_data['BdBusiness']['proposal_doc'])):?>
							<a href="<?php echo $this->webroot;?>bdbusiness/download_proposal/<?php echo $biz_data['BdBusiness']['proposal_doc'];?>/" class="btn btn-lightgrey" rel="tooltip" title="Download"><?php echo $this->Functions->string_truncate($biz_data['BdBusiness']['proposal_doc'], 25);?></a>
						<?php endif; ?>						

				<?php echo $biz_data['BdProposalVer']['title']; ?>
						
											

												
											</div>
											</div>
										
									
										
										
										
									
										<div class="control-group">
											<label for="textfield" class="control-label">Proposal Approved 
 </label>
											<div class="controls">
												<?php echo $biz_data['BdBusiness']['proposal_approve'] ? 'Yes' : 'No'; ?>
											</div>
											</div>
											
										
										<input type="hidden" value="<?php echo $biz_data['BdBusiness']['agreement_sign'];?>" id="agreement_sign"/>
										<input type="hidden" value="<?php echo $biz_data['BdBusiness']['work_start'];?>" id="work_start"/>


											
											<?php if($biz_data['BdBusiness']['agreement_sign'] == '1'):?>	
											<div class="control-group dn agmttNo">
											<label for="textfield" class="control-label">Agreement No. 
 </label>
											<div class="controls">
<?php echo $biz_data['BdBusiness']['agreement_no']; ?>
											</div>
											</div>
											<?php endif; ?>
											
											<?php if($biz_data['BdBusiness']['work_start'] == '1'):?>	
											<div class="control-group workCompDiv">
											<label for="textfield" class="control-label">Work Complete 
 </label>
											<div class="controls">
	<?php echo $biz_data['BdBusiness']['work_complete'] ? 'Yes' : 'No'; ?>
											</div>
											</div>
											<?php endif; ?>
											
										</div>		
									
										<div class="span12">
										<div class="form-actions">
										
											<a href="javascript:void(0);" class="close_colorBox"><button type="button" class="btn">Close</button></a>
										</div>
									</div>
										</div>
									
									
									
									
									</div>
									
									
									
									
							</div>
						
					
				</div>
		
					<?php endif; ?>
												<?php echo $this->Form->end(); ?>

				</div>
		
			
			</div>
		</div>	
			


