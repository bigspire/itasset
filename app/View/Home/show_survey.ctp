<div class="">
	<?php if($survey_data[0]['HrSurvey']['id']):?>
	<div class="modal-dialog">
			<h4 class="modal-title" style="margin-left:4px;color:#666666;text-shadow:1px 1px 1px #bcb5b5;font-weight:bold;font-size:14px;"><i class="icon-ok-sign"></i> Survey No: <?php echo $survey_data[0]['HrSurvey']['id'];?></h4>

      <div class="modal-content">
       <div class="container"></div>
        <div class="">
			<?php if($survey_submit == 1): ?>							
<div class="alert alert-warning draftMsg">
											<button type="button" class="close" data-dismiss="alert">
												<i class="icon-remove"></i>
											</button>

											<strong>
												
Survey saved as draft successfully</strong>											<br>
										</div>
						<?php endif; ?>
						
					<?php //if($survey_submit == 2): ?>							
<div class="alert alert-danger errorMsg dn">
											<button type="button" class="close" data-dismiss="alert">
												<i class="icon-remove"></i>
											</button>

											<strong>
												<i class="icon-remove"></i>
												Oops!
											</strong>

											Problem in sending the survey. Pls fill the red highlighted fields.
											<br>
										</div>
						<?php //endif; ?>
						
						<?php if($survey_complete == 1): ?>							
        <div class="alert alert-block alert-success chgSuccess">
											<button type="button" class="close" data-dismiss="alert">
												<i class="icon-remove"></i>
											</button>

											<p>
												Thank You. You have completed the recent survey successfully!
											</p>

										</div>
					<?php endif; ?>
										
			<?php if($survey_submit == 3): ?>							
        <div class="alert alert-block alert-success chgSuccess">
											<button type="button" class="close" data-dismiss="alert">
												<i class="icon-remove"></i>
											</button>

											<p>
												Thanks for your valuable feedback. Details sent successfully!
											</p>

										</div>
							
															<span style="margin-left:20px;font-size:12px;">You will be redirected to home page in <span id="timeRef">5</span> secs. automatically...</span>
						
			<?php endif; ?>						
		
			
			 <div class="modal-header">       
		  
		  
        <?php if($survey_submit != '3'):?>
				  <div style="color:;float:right;"><u>Survey closes on:</u> <?php echo $this->Functions->format_date($survey_data[0]['HrSurvey']['end_date']); ?></div>

		  <div style=""><?php echo $survey_data[0]['HrSurvey']['desc'];?></div>
		  <?php endif; ?>
		  </div>
			<?php if($survey_submit != 3 && !$survey_complete): ?>	
			
			<div class="" align="center">
		
<div class="" ><div class="" style="display: block;">
												<div class="no-padding">
											

			<?php echo $this->Form->create('HrSurveyAns', array( 'id' => 'formID', 'class' => '')); ?>
			
								

									<div class="space-4"></div>
						
						<?php $i = 1;foreach($qn_data as $data):?>
									<div class="form-group" style="text-align:left">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-2" style="color:#1b3ab7;font-size:13px;width:82%"><?php echo $i;?>)  <?php echo $data['HrSurveyQuestion']['question'];?></label>

										<div class="col-sm-3">
											<?php 
											if(!empty($this->request->data) && $this->request->data['HrSurveyAns']['is_draft'] != '1'):
												if(trim($this->request->data['HrSurveyAns']['qn'.$i]) == ''):
													$border = 'border:1px solid #ff0000';
												else:
													$border = '';
												endif;
											endif;

											?>
											
											<?php 
											if(!empty($this->request->data['HrSurveyAns']['qn'.$i])):
												$answer = $this->request->data['HrSurveyAns']['qn'.$i];
											elseif(array_key_exists($data['HrSurveyQuestion']['id'], $survey_ans)): 
												$answer = $survey_ans[$data['HrSurveyQuestion']['id']];
											else:
												$answer = '';
											endif;
											?>
											<?php echo $this->Form->input('question'.$i, array('value' => $data['HrSurveyQuestion']['id'], 'type' => 'hidden', 'id' => '')); ?> 

											<?php echo $this->Form->input('qn'.$i, array('div'=> false, 'style' => 'font-size:12px;'.$border, 'type' => 'textarea', 'value' => $answer, 'rows' => '3', 'cols' => '75', 'id' => 'qn'.$i, 'label' => false, 'class' => 'input-block-level ckeditor',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
																						
											<div class="error error<?php echo $i;?>"></div>
										
										</div>
									</div>
									
						<?php $i++; endforeach; ?>
<div class="clearfix form-actions">
<?php echo $this->Form->input('tot_qn', array( 'type' => 'hidden', 'value' => --$i, 'id' => 'tot_qn')); ?> 
<?php echo $this->Form->input('is_draft', array( 'type' => 'hidden', 'id' => 'is_draft')); ?> 


										<div class="col-md-9">
											<button  class="btn btn-success validate_survey btn-sm" type="submit">
												<i class="icon-ok bigger-110"></i>
												Send
											</button>

											<button  class="btn btn-warning btn-sm survey_draft" type="submit">
												<i class="icon-minus bigger-110"></i>
												Save as Draft
											</button>
										</div>
									</div>
									
									
								<input type="hidden" id="post_data" value="<?php echo $this->webroot;?>home/show_survey/">	
									
								
								<?php echo $this->Form->end(); ?>

									</div><!-- /widget-main -->
											</div></div>
									</div>
        
			<?php endif; ?>
						<input type="hidden" id="survey_status" value="<?php echo $survey_complete;?>"/>

			<input type="hidden" id="survey_close" value="<?php echo $survey_submit?>"/>

        </div>
       
      </div>
    </div>
	<?php else: ?>
	
	Oops! No survey found!
	<script>parent.location.reload();</script>
	<?php endif; ?>
	
	</div>


