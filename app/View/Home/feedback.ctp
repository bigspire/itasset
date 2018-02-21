<div class="">
	<div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
       
          <h4 class="modal-title">Feedback</h4>
        </div><div class="container"></div>
        <div class="">
		
		<div class="alert alert-danger chgError dn">
											<button type="button" class="close" data-dismiss="alert">
												<i class="icon-remove"></i>
											</button>

											<strong>
												<i class="icon-remove"></i>
												Oops!
											</strong>

											Problem in saving feedback request. Pls contact admin.
											<br>
										</div>
										
			<?php if($feedback_submit == 1): ?>							
        <div class="alert alert-block alert-success chgSuccess">
											<button type="button" class="close" data-dismiss="alert">
												<i class="icon-remove"></i>
											</button>

											<p>
												Thanks for your feedback. Details sent to help desk successfully!
											</p>

											
										</div>
							
										
			<?php else: ?>						
		
				 <div class="" align="center">
		
<div class="" ><div class="" style="display: block;">
												<div class="no-padding">
											

			<?php echo $this->Form->create('Home', array( 'id' => 'formID', 'class' => '')); ?>
			
								

									<div class="space-4"></div>

									<div class="form-group" style="text-align:left">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> Please enter the feedback</label>

										<div class="col-sm-3">
											<?php echo $this->Form->input('feedback', array('div'=> false,'type' => 'textarea', 'rows' => '8', 'cols' => '45', 'id' => 'feedback', 'label' => false, 'class' => 'input-block-level',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
																						
											<div class="error error1"></div>
										
										</div>
									</div>
<div class="clearfix form-actions">


										<div class="col-md-9">
											<button  class="btn btn-info btn-sm feedBack" type="submit">
												<i class="icon-ok bigger-110"></i>
												Submit
											</button>

											
										</div>
									</div>
									
									
									
									
								
								<?php echo $this->Form->end(); ?>

									</div><!-- /widget-main -->
											</div></div>
									</div>
        
			<?php endif; ?>
        </div>
       
      </div>
    </div>
</div>
