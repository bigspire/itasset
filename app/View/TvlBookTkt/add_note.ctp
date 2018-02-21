<style>
.ui-widget-header{color:#000000}
</style>
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="" style="">
						<h5>
					
					
						Update Ticket Status</h5>
					</div>
					
				</div>
			
				
				<?php echo $this->Session->flash();?>
				
					<div class="row-fluid">
					<div class="span12">
						<div class="box box-color box-bordered">
							
							<div class="box-content nopadding">
								
								
								<?php echo $this->Form->create('TvlBookTkt', array('id' => 'formID', 'class' => 'form-horizontal form-column form-bordered')); ?>
								
								
									<div class="span6">
									
								<div class="control-group">
											<label for="textfield" class="control-label">Travel Id <span class="red_star">*</span></label>
											<div class="controls">
										<?php echo $this->Functions->get_tvl_id($this->request->params['pass'][0]);?>
							
											</div>
										</div>
										
									<div class="control-group">
											<label for="textfield" class="control-label">Ticket Availability <span class="red_star">*</span></label>
											<div class="controls">
										
			<?php echo $this->Form->input('avail', array('div'=> false,'type' => 'select', 'empty' => 'Select', 'options' => array('Y' => 'Yes', 'N' => 'No'),'label' => false, 'class' => 'input-medium tktAvail',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 

											</div>
										</div>
									
								
									<div class="control-group dn tkt1">
											<label for="textfield" class="control-label">Mode of Travel <span class="red_star">*</span></label>
											<div class="controls">
										
										 
													
				<?php echo $this->Form->input('tvl_mode_id', array('div'=> false,'type' => 'radio', 'label' => false,  'style' => 'margin:4px 2px', 'class' => 'input-xlarge clearR',  'options' => $modeList, 'separator' => ' ', 'id' => '', 'required' => false, 'placeholder' => '', 'legend' => false, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?>
									
											</div>
										</div>
										
										
									<div class="control-group tkt1 dn">
											<label for="textfield" class="control-label">Booking Mode <span class="red_star">*</span></label>
											<div class="controls">
										
													<?php echo $this->Form->input('book_mode', array('div'=> false,'type' => 'select', 'empty' => 'Select', 'options' => $bookMode, 'label' => false, 'class' => 'input-medium clearF', 'value' => $this->Functions->format_time_show($this->request->data['HrOfficeTiming']['end_time']),  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?>
													
											</div>
									</div>
										
											<div class="control-group tkt1 dn">
											<label for="textfield" class="control-label">Booking Date 
											<span class="red_star">*</span></label>
											<div class="controls">
										
													<?php echo $this->Form->input('issue_date', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'clearF input-medium datepick',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
													
											</div>
										</div>
										
										<div class="control-group tkt1 dn">
											<label for="textfield" class="control-label">Comment
											</label>
											<div class="controls">
										
													<?php echo $this->Form->input('remark', array('div'=> false,'type' => 'textarea', 'rows' => '2', 'label' => false, 'class' => 'clearF input-large datepick',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
													
											</div>
										</div>	
										
											
			<div class="control-group tkt0 dn">
											<label for="textfield" class="control-label">Suggestion Alternative
											<span class="red_star">*</span></label>
											<div class="controls">
										
													<?php echo $this->Form->input('suggestion', array('div'=> false,'type' => 'textarea', 'rows' => '2', 'label' => false, 'class' => 'clearF input-large datepick',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
													
											</div>
										</div>
									
									
										
									</div>
								



										
										
									<div class="span12">
										<div class="form-actions">
										
						<input type="submit" value="Send" class="tktUpdate btn btn-primary">
						
											
						</div>
							</div>
							<input type="hidden" value="<?php echo date('d/m/Y', strtotime('+1 days'));?>" id="start_date"/>
							<?php if($this->request->query['action'] == 'return'):	
							$end_date = $this->request->query['return'];
							else:
							$end_date = $this->request->query['start'];
							endif;
							
							?>
								<input type="hidden" value="<?php echo date('d/m/Y', strtotime($end_date));?>" id="end_date"/>
									<?php echo $this->Form->input('id', array('type' => 'hidden'));?>
								<?php echo $this->Form->end(); ?>
							</div>
						</div>
					</div>
				</div>
					
					
				</div>
		
			
			</div>
		</div>	
			
	

	
