<div class="">
	<div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
       
          <h4 class="modal-title">Request for Change</h4>
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

											Problem in saving change request. Pls contact admin.
											<br>
										</div>
										
										
        <div class="alert alert-block alert-success dn chgSuccess">
											<button type="button" class="close" data-dismiss="alert">
												<i class="icon-remove"></i>
											</button>

											<p>
												
												Request sent to HR successfully!
											</p>

											
										</div>
		
				 <div class="chgReqFrm" align="center">
		
<div class="" ><div class="" style="display: block;">
												<div class="no-padding">
											

			<?php echo $this->Form->create('HrHome', array( 'id' => 'formID', 'class' => '')); ?>
			
									<!--div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Profile change</label>

										<div class="col-sm-5">
											<select class="form-control" id="field0">
																<option value="">Select</option>
																<option value="PE">Personal</option>
																<option value="CT">Contact</option>
																<option value="ED">Education</option>
																<option value="PR">Professional</option>
																<option value="MS">Miscellaneous</option>
															
															</select>
															<div class="error error0"></div>
										</div>
									</div-->

									<div class="space-4"></div>

									<div class="form-group" style="text-align:left">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> Description</label>

										<div class="col-sm-3">
											<textarea id="field0" rows="8" cols="48"  ></textarea>
											<div class="error error0"></div>
										
										</div>
									</div>
<div class="clearfix form-actions">

<input type="hidden" id="change_req" value="<?php echo $this->webroot;?>home/change_req/"/>
										<div class="col-md-9">
											<button  rel="PE" class="btn btn-info btn-sm" id="btnReq" type="button">
												<i class="icon-ok bigger-110"></i>
												Submit
											</button>

											
										</div>
									</div>
									
									
									
									
									<input type="hidden" value="<?php echo $this->request->query['type']; ?>" id="type">
								<?php echo $this->Form->end(); ?>

									</div><!-- /widget-main -->
											</div></div>
									</div>
        
		
        </div>
       
      </div>
    </div>
</div>
