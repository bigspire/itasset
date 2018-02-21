<?php echo $this->element('tvl_menu'); ?>
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Export Travel</h1>
					</div>
					
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>tvlhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="<?php echo $this->webroot;?>tvlbooktkt/">Book Ticket</a>
								<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="#">Export</a>
						</li>
					</ul>
					
				</div>
				
				<?php echo $this->Session->flash();?>
				
					<div class="row-fluid">
					<div class="span12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3><i class="icon-list"></i> Please fill the form to export travel requests</h3>
							</div>
							<div class="box-content nopadding">
								
								
								<?php echo $this->Form->create('TvlBookTkt', array('id' => '', 'class' => 'form-horizontal form-column form-bordered')); ?>
								
								
									<div class="span12">
									
								
										
										
										<div class="control-group">
											<label for="textfield" class="control-label">From Date <span class="red_star">*</span></label>
											<div class="controls">
										
													<?php echo $this->Form->input('from_date', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-xlarge datepick',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											</div>
										</div>
										
										
										
					
										
										
									
										
							
										
										
										<div class="control-group">
											<label for="textfield" class="control-label">To Date <span class="red_star">*</span></label>
											<div class="controls">
													<?php echo $this->Form->input('to_date', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-xlarge datepick',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											</div>
										</div>
									
									
								
									</div>


										
										
									<div class="span12">
										<div class="form-actions">
											<input type="submit" value="Submit" class="btn btn-primary">
											<a href="<?php echo $this->webroot;?>tvlbooktkt/"><button type="button" class="btn">Cancel</button></a>
										</div>
									</div>
								<?php echo $this->Form->end(); ?>
							</div>
						</div>
					</div>
				</div>
					
					
				</div>
		
			
			</div>
		</div>	
			
	
