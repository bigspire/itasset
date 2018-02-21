<style>
.ui-widget-header{color:#000000}
</style>
<script>
parent.$('#cboxClose').hide();
</script>
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="" style="">
						<h5>
					
					
						Add Place</h5>
					</div>
					
				</div>
			
				
				<?php echo $this->Session->flash();?>
				
					<div class="row-fluid">
					<div class="span12">
						<div class="box box-color box-bordered">
							
							<div class="box-content nopadding">
								
								
								<?php echo $this->Form->create('TvlPlace', array('id' => 'formID', 'class' => 'form-horizontal form-column form-bordered')); ?>
								
								
									<div class="span6">
									<div class="control-group">
											<label for="textfield" class="control-label">Place </label>
											<div class="controls">
										<?php if($refresh == ''):?>
										<?php echo $this->Form->input('place', array('div'=> false, 'type' => 'text', 'label' => false, 'class' => 'input-block-level',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
										<?php else:?>
										<?php echo $this->request->data['TvlPlace']['place'];?>
										<?php endif; ?>
											</div>
										</div>
								
								
									
								<div class="form-actions" style="clear:left;">	
					<?php if($refresh == ''):?>
									
								<button type="button" class="btn close_colorBox">Cancel</button>
								<input type="submit" style="margin-left:10px" name="data[TvlPlace][save]" class="btn-success btn" value="Save">
									
						<?php else:?>
								<button type="button" class="btn-info btn tvlPlaceAdd">Close</button>

						<?php endif; ?>
							</div>		</div>
						
								<?php echo $this->Form->end(); ?>
							</div>
						</div>
					</div>
				</div>
					
					
				</div>
		
			
			</div>
		</div>	
			
	

	
