<div class="">
	<div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
       
          <h4 class="modal-title">Report Issue</h4>
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
										
			<?php if($issue_submit == 1): ?>							
        <div class="alert alert-block alert-success chgSuccess">
											<button type="button" class="close" data-dismiss="alert">
												<i class="icon-remove"></i>
											</button>

											<p>
												Thanks for reporting the issue. Details sent to help desk successfully!
											</p>

											
										</div>
							
										
			<?php else: ?>						
		
				 <div class="" align="center">
		
<div class="" ><div class="" style="display: block;">
												<div class="no-padding">
											

			<?php echo $this->Form->create('Home', array( 'id' => 'formID', 'class' => '')); ?>
			
								

									<div class="space-4"></div>
									
									<div class="form-group" style="text-align:left">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> Page Title</label>

										<div class="col-sm-3">
											<?php echo $this->Form->input('page_title', array('div'=> false,'type' => 'text', 'id' => 'page_title', 'label' => false, 'style' => 'width:330px',  'class' => 'input-block-level',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
																						
											<div class="error error1"></div>
										
										</div>
									</div>
									

									<div class="form-group" style="text-align:left;clear:both;">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> Issue details</label>

										<div class="col-sm-3">
											<?php echo $this->Form->input('issue', array('div'=> false,'type' => 'textarea', 'rows' => '4', 'cols' => '37', 'id' => 'issue', 'label' => false, 'class' => 'input-block-level',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
																						
											<div class="error error2"></div>
										
										</div>
									</div>
<div class="clearfix form-actions">


										<div class="col-md-9">
											<button  class="btn btn-info btn-sm reportIssue" type="submit">
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
