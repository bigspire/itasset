<div class="">
	<div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Waive Off - <span style="font-weight:normal;"><?php echo $emp_data['HrEmployee']['first_name'].' '.$emp_data['HrEmployee']['last_name']?></span><?php //echo date('Y'); ?></h5>
        </div><div class="container"></div>
        <div class="modal-body">
        <?php if($data_save != 'ok'):?>
		<div class="box-content nopadding">
									<?php echo $this->Form->create('HrWaiveOff', array('id' => 'formID', 'class' => 'form-horizontal form-column form-bordered')); ?>
									
								
									<div class="span8">
										<div class="control-group">
											<label for="textfield" class="control-label">Minutes <span class="red_star">*</span></label>
											<div class="controls">
											<?php echo $this->Form->input('minute', array('div'=> false,'type' => 'text', 'label' => false, 'id' => 'field1','class' => 'input-xlarge',  'required' => false, 'placeholder' => 'eg: 15, 20, 45 or 50', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?>  
											</div>
										</div>
										<?php if($this->Session->read('USER.Login.app_roles_id') == '1'):?>
										<div class="control-group">
											<label for="textfield" class="control-label">Reason <span class="red_star">*</span></label>
											<div class="controls">
											<?php echo $this->Form->input('reason', array('div'=> false, 'empty' => 'Select', 'type' => 'select', 'options' => array('E' => 'Exception', 'L' => 'Late Coming'), 'label' => false, 'id' => 'field1','class' => 'input-xlarge',  'required' => false,  'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?>  
											</div>
										</div>
										<div class="control-group">
											<label for="textfield" class="control-label">Type <span class="red_star">*</span></label>
											<div class="controls">
											<?php echo $this->Form->input('late_type', array('div'=> false,'type' => 'select','empty' => 'Select', 'options' => array('S' => 'Subtraction', 'A' => 'Addition'), 'label' => false, 'id' => 'field1','class' => 'input-xlarge',  'required' => false, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?>  
											</div>
										</div>									
										<?php endif; ?>
										
										<div class="control-group">
											<label for="textfield" class="control-label">Remarks <span class="red_star">*</span></label>
											<div class="controls">
											<?php echo $this->Form->input('remarks', array('div'=> false,'type' => 'textarea', 'label' => false, 'id' => 'field1','class' => 'input-block-level', 'rows' => '4',  'required' => false, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?>  
											</div>
										</div>
									</div>
										<div class="span12">
										<div class="form-actions">
										<input type="hidden" value="<?php echo $this->request->params['pass'][1];?>" name="data[HrWaiveOff][total_hr]"/>
										<!-- -->
											<input type="submit" class="btn btn-primary send_lve" value="Submit" />
											<a href="javascript:void(0)" class="close_colorBox"><button type="button" class="btn">Cancel</button></a>
										</div>
									</div>
							</div>
			<?php else: ?>
			<p style="margin-top:20px;">Processing.. Pls wait..</p>
			<?php endif; ?>
        </div>
       
      </div>
    </div>
</div>
