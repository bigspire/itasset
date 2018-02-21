<style>
.ui-widget-header{color:#000000}
</style>
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="" style="">
						<h5>
					
					
						Edit Ticket </h5>
					</div>
					
				</div>
			
				
				<?php echo $this->Session->flash();?>
				
					<div class="row-fluid">
					<div class="span12">
						<div class="box box-color box-bordered">
							
							<div class="box-content nopadding">
								
								
								<?php echo $this->Form->create('TvlTicket', array('type' => 'file', 'id' => 'formID', 'class' => 'form-horizontal form-column form-bordered')); ?>
								
								
									<div class="span6">
									
							
										
									
										
								<div class="control-group">
											<label for="textfield" class="control-label">Booking Date <span class="red_star">*</span></label>
											<div class="controls">
											
		<?php echo $this->Form->input('book_date', array('div'=> false,  'id' => 'book_date', 'type' => 'text', 'label' => false, 'class' => 'input-medium datepick',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
										<div class="error book_date"></div>
												
											</div>
										</div>
								
											
										
											<div class="control-group">
											<label for="textfield" class="control-label">Booked Through<span class="red_star">*</span></label>
											<div class="controls">
				<?php echo $this->Form->input('book_via', array('div'=> false,'type' => 'radio', 'label' => false, 'style' => 'margin:4px 2px', 'class' => 'input-xlarge tvlBookThro', 'rel' => 'tkt2Cpy',  'options' => $bookList, 'separator' => ' ', 'id' => 'book_via', 'required' => false, 'placeholder' => '', 'legend' => false, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?>
														<div class="error book_via"></div>
				
												
											</div>
										</div>
										<div class="control-group dn tkt2Cpy">
											<label for="textfield" class="control-label">Agent Copy <span class="red_star">*</span></label>
											<div class="controls">
											
				<?php echo $this->Form->input('agent_copy1', array('div'=> false, 'id' => 'agent_copy','type' => 'file', 'label' => false, 'class' => 'input-block-level',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
					<div class="error agent_copy"></div>
												
											</div>
										</div>
										
									
								
										
										
							<div class="control-group">
											<label for="textfield" class="control-label">Ticket Fare (INR) <span class="red_star">*</span></label>
											<div class="controls">
											
		<?php echo $this->Form->input('amount', array('div'=> false, 'maxlength' => '8',  'id' => 'fare','type' => 'text', 'label' => false, 'class' => 'input-medium',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
										<div class="error fare"></div>
												
											</div>
										</div>
						
									<div class="control-group">
											<label for="textfield" class="control-label">Booking Ref. No. <span class="red_star">*</span></label>
											<div class="controls">
											
		<?php echo $this->Form->input('book_ref_no', array('div'=> false, 'id' => 'ref_no','type' => 'text', 'label' => false, 'class' => 'input-medium',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
				
													<div class="error ref_no"></div>
											</div>
										</div>
								

								
										
										
										
									</div>
								


										
										
									<div class="span12">
										<div class="form-actions">
										
						<input type="submit" value="Save" class="btn btn-primary">
						
									<a href="<?php echo $this->webroot;?>tvlbooktkt/view_ticket/<?php echo $this->request->params['pass'][0];?>/"><input type="button" value="Cancel" class="btn"></a>		
						</div>
							</div>
									<?php echo $this->Form->input('id', array('type' => 'hidden'));?>
								<?php echo $this->Form->end(); ?>
							</div>
						</div>
					</div>
				</div>
					
					
				</div>
		
			
			</div>
		</div>	
			
	

	
