<?php echo $this->element($menu_inc); ?>
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Create <?php echo $APPROVER_TYPE;?></h1>
					</div>
					
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot.$redirect?>/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="<?php echo $this->webroot;?>approve/?type=<?php echo $FN_TYPE;?>">
							<?php echo $APPROVER_TYPE;?></a>
								<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="#">Create <?php echo $APPROVER_TYPE;?></a>
						</li>
					</ul>
					
				</div>
				
				
					<?php echo $this->Session->flash();?>
					
					
					<div class="row-fluid">
					<div class="span12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3><i class="icon-list"></i> Please fill the form to create <?php echo $APPROVER_TYPE;?></h3>
							</div>
							<div class="box-content nopadding">
								
								
								<?php echo $this->Form->create('Approve', array('id' => 'formID', 'class' => 'form-horizontal form-column form-bordered')); ?>
								
								
									<div class="span12">
										<div class="control-group">
											<label for="textfield" class="control-label">Employee Name <span class="red_star">*</span></label>
											<div class="controls">
													<?php echo $this->Form->input('app_users_id', array('div'=> false,'type' => 'select', 'label' => false, 'class' => 'input-large', 'empty' => 'Select', 'required' => false, 'placeholder' => '', 'options' => $empList1, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?>
													
												
											</div>
										</div>
										<div class="control-group">
											<label for="password" class="control-label">Level 1 <span class="red_star">*</span></label>
											<div class="controls">
												<?php echo $this->Form->input('level1', array('div'=> false,'type' => 'select', 'label' => false, 'class' => 'input-large', 'empty' => 'Select', 'required' => false, 'placeholder' => '', 'style' => "clear:left", 'options' => $empList, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
										
											
												<?php //echo $this->Form->input('auth_amount_l1', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-small',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
										 
												 
												
											</div>
											
											
										</div>

										
										
										
									
										
									
										<div class="control-group">
											<label for="textfield" class="control-label">Level 2 </label>
											<div class="controls">
													<?php echo $this->Form->input('level2', array('div'=> false,'type' => 'select', 'label' => false, 'class' => 'input-large', 'empty' => 'Select', 'required' => false, 'placeholder' => '', 'options' => $empList, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?>
												<?php //echo $this->Form->input('auth_amount_l2', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-small',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											</div>
											
										</div>
								
									
									
									</div>
									<div class="span12">
										<div class="form-actions">
											<input type="submit" class="btn btn-primary" value="Save changes"/>
											<a href="<?php echo $this->webroot;?>approve/?type=<?php echo $FN_TYPE;?>"><button type="button" class="btn">Cancel</button></a>
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
			
	
