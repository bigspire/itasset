<div class="">
	<?php if($survey_data[0]['HrVoice']['id']):?>
	<div class="modal-dialog">

      <div class="modal-content">
       <div class="container"></div>
        <div class="">
			<?php if($voice_submit == 1): ?>							
<div class="alert alert-warning draftMsg">
											<button type="button" class="close" data-dismiss="alert">
												<i class="icon-remove"></i>
											</button>

											<strong>
												
Voice saved as draft successfully</strong>											<br>
										</div>
						<?php endif; ?>
						
					<?php //if($voice_submit == 2): ?>							
<div class="alert alert-danger errorMsg dn">
											<button type="button" class="close" data-dismiss="alert">
												<i class="icon-remove"></i>
											</button>

											<strong>
												<i class="icon-remove"></i>
												Oops!
											</strong>

											Problem in submitting the form. Pls fill the red highlighted fields.
											<br>
										</div>
						<?php //endif; ?>
						
						<?php if($survey_complete == 1): ?>							
        <div class="alert alert-block alert-success chgSuccess">
											<button type="button" class="close" data-dismiss="alert">
												<i class="icon-remove"></i>
											</button>

											<p>
												Thank You. You have finished the voice page successfully!
											</p>

										</div>
					<?php endif; ?>
										
			<?php if($voice_submit == 3): ?>							
        <div class="alert alert-block alert-success chgSuccess">
											<button type="button" class="close" data-dismiss="alert">
												<i class="icon-remove"></i>
											</button>

											<p>
												Thanks for your your interest to take part in this initiative.
											</p>

										</div>
							
															<span style="margin-left:20px;font-size:12px;">You will be redirected to home page in <span id="timeRef">5</span> secs. automatically...</span>
						
			<?php endif; ?>						
		
			
			 <div class="modal-header">       
		  
		  
        <?php if($voice_submit != '3'):?>
				  <div style="color:#ff0000;float:right;"><u>Voice closes on:</u> <?php echo $this->Functions->format_date($survey_data[0]['HrVoice']['end_date']); ?></div>

		  <div style=""><?php echo $survey_data[0]['HrVoice']['desc'];?></div>
		  <?php endif; ?>
		  </div>
			<?php if($voice_submit != 3 && !$survey_complete): ?>	
			
			<div class="" align="center">
		
<div class="" ><div class="" style="display: block;">
												<div class="no-padding">
											

			<?php echo $this->Form->create('HrVoice', array( 'id' => 'formID', 'class' => 'form-vertical')); ?>
			
								

									<div class="space-4"></div>
						<div id="sheepItForm" class="sheepitVoice">
						 <div id="sheepItForm_template">
									<div class="form-group" style="text-align:left;float:left;">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-2" style="color:#1b3ab7;font-size:13px;width:82%"><?php echo $data['HrSurveyQuestion']['question'];?></label>

										<div class="col-sm-3">
										
											<?php echo $this->Form->input('msg#index#', array('div'=> false, 'style' => 'width:400px;', 'id' => 'msg#index#', 'type' => 'textarea', 'rows' => '1',  'placeholder' => 'Type Questions or Suggestions or Ideas here...',  'label' => false, 'class' => 'msgBox required autosize-transition input-block-level',  'required' => false,  'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 

											<?php echo $this->Form->input('type#index#', array('div'=> false, 'style' => 'width:120px;',  'id' => 'type#index#', 'type' => 'select', 'options' => $voiceType, 'empty' => 'Select',  'label' => false, 'class' => 'required input-small',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 

																						
											<div class="error"></div>
										
										</div>
									</div>
									
									<a id="sheepItForm_remove_current" tabindex="-1"  rel="tooltip2" title="Remove" style="float:left;margin-right:10px;margin-top:10px;">
    <span><button type="button"  rel="tooltip2" tabindex="-1"  class="btn btn-xs btn-danger" style="padding:4px" data-placement="top" title="Remove"><i class="icon-trash"></i></button></span>
    </a>
	
							</div>
							<div id="sheepItForm_noforms_template"></div>
							<div id="sheepItForm_controls" style="width:125px;float:left;">
    <div id="sheepItForm_add"><a> <span><button rel="tooltip2" title="Add another message box" type="button" style="margin:10px;" class="btn btn-xs btn-warning" title="Add Another"><i class="icon-plus"></i> Add Another</button></span></a></div>
  
  </div>
									</div>		
						
						
<div class="clearfix form-actions" style="clear:left;">
<?php echo $this->Form->input('tot_msg', array( 'type' => 'hidden', 'value' => '3',  'id' => 'tot_msg')); ?> 
<?php echo $this->Form->input('is_draft', array( 'type' => 'hidden', 'id' => 'is_draft')); ?>
<?php echo $this->Form->input('tot_edit', array( 'type' => 'hidden', 'id' => 'tot_edit', 'value' => count($voice_msg_data))); ?>  


										<div class="col-md-9">
											<button rel="tooltip2"  title="Send Now!" class="voiceSend btn btn-success btn-sm" type="submit">
												<i class="icon-ok bigger-110"></i>
												Send
											</button>

											<button rel="tooltip2" title="Save as draft and send it later when you are ready" class="survey_draft btn btn-primary btn-sm" style="margin-left:10px" rel="draft" type="submit">
												<i class="icon-save bigger-110"></i>
												Save as Draft
											</button>
										</div>
									</div>
									
									
								<input type="hidden" id="post_data" value="<?php echo $this->webroot;?>home/show_voice/">	
								

<?php foreach($voice_msg_data as $key => $record):?>
<input type="hidden" id="Vmsg<?php echo $key;?>" value="<?php echo $record['HrVoiceQuestion']['msg'];?>">
<input type="hidden" id="Vtype<?php echo $key;?>" value="<?php echo $record['HrVoiceQuestion']['type'];?>">

<?php endforeach; ?>								
								
								<?php echo $this->Form->end(); ?>

									</div><!-- /widget-main -->
											</div></div>
									</div>
        
			<?php endif; ?>
						<input type="hidden" id="survey_status" value="<?php echo $survey_complete;?>"/>

			<input type="hidden" id="survey_close" value="<?php echo $voice_submit?>"/>

        </div>
       
      </div>
    </div>
	<?php else: ?>
	
	Oops! No voice found!
	<script>parent.location.reload();</script>
	<?php endif; ?>
	
	</div>
	

