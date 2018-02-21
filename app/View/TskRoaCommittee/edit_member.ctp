<?php echo $this->element('tsk_menu'); ?>
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Edit ROA Committee</h1>
					</div>
					
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>tskhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="<?php echo $this->webroot;?>tskroacommittee/">ROA Committee</a>
								<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="#">Edit ROA Committee</a>
						</li>
					</ul>
					
				</div>
				
				<?php echo $this->Session->flash();?>
				
					<div class="row-fluid  footer_div">
					<div class="span12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3><i class="icon-list"></i> Please fill the form to edit members</h3>
							</div>
							<div class="box-content nopadding">
								
								
								<?php echo $this->Form->create('TskRoaCommittee', array('id' => 'formID', 'class' => 'form-horizontal form-column form-bordered')); ?>
								
								<div class="span12">
									
									
									
									<div class="control-group">
											<label for="textfield" class="control-label">ROA Committee Members <span class="red_star">*</span> </label>
											<div class="controls">
											
					<?php echo $this->Form->input('member', array('div'=> false, 'id' => 'field1', "data-placeholder" => "Select Members" , 'multiple' => 'multiple', 'type' => 'select', 'options' => $empList, 'selected' => $members, 'label' => false, 'class' => 'chosen-select input-xxlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
													<div class="error field1"></div>
											</div>
										</div>	
										
									</div>
								
						
									<div class="span12">
										<div class="form-actions">
											<input type="submit" value="Save changes" class="btn btn-primary">
											<a href="<?php echo $this->webroot;?>tskroacommittee/"><button type="button" class="btn">Cancel</button></a>
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
			
	
