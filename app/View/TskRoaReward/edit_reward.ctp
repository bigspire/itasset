<?php echo $this->element('tsk_menu'); ?>
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Edit Gifts & Rewards</h1>
					</div>
					
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>tskhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="<?php echo $this->webroot;?>tskroareward/">Gifts & Rewards</a>
								<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="#">Edit Gifts & Rewards</a>
						</li>
					</ul>
					
				</div>
				
				<?php echo $this->Session->flash();?>
				
					<div class="row-fluid  footer_div">
					<div class="span12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3><i class="icon-list"></i> Please fill the form to edit the gift details</h3>
							</div>
							<div class="box-content nopadding">
								
								
								<?php echo $this->Form->create('TskRoaReward', array('id' => 'formID', 'type' => 'file',  'class' => 'form-horizontal form-column form-bordered')); ?>
								
								
									<div class="span6">
										<div class="control-group">
											<label for="textfield" class="control-label">Reward Month<span class="red_star">*</span></label>
											<div class="controls">
													<?php echo $this->Form->input('reward_month', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-xlarge monthpick',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
													
												
											</div>
										</div>
										<div class="control-group">
											<label for="textfield" class="control-label">Reward Members <span class="red_star">*</span> </label>
											<div class="controls">
											
					<?php echo $this->Form->input('member', array('div'=> false, 'id' => '', "data-placeholder" => "Select Members" , 'multiple' => 'multiple', 'type' => 'select', 'options' => $empList, 'selected' => $members,  'label' => false, 'class' => 'chosen-select input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
													<div class="error reasonChk"></div>
											</div>
										</div>	
										
									<div class="control-group">
											<label for="textfield" class="control-label">Certificate </label>
											<div class="controls">
													<?php echo $this->Form->input('attachment', array('div'=> false,'type' => 'file', 'label' => false, 'class' => 'input-xlarge',  'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
													
												
											</div>
										</div>	
									
										
								
										
									</div>
									<div class="span6">
								
										
									
									<div class="control-group">
											<label for="textfield" class="control-label">Is Star? </label>
											<div class="controls">
												<?php echo $this->Form->input('is_star', array('div'=> false,'type' => 'select', 'label' => false, 'class' => 'input-xlarge', 'empty' => 'Select', 'required' => false, 'placeholder' => '', 'style' => "clear:left", 'options' => $star_list, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 	
											</div>
										</div>
											<div class="control-group">
											<label for="password" class="control-label">Gift Voucher <span class="red_star">*</span><br></label>
											<div class="controls">
												<?php echo $this->Form->input('gift_voucher', array('div'=> false,'type' => 'textarea', 'label' => false, 'class' => 'input-xlarge', 'rows' => '2','required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											</div>
										</div>
										</div>
										
										
										<div class="span12">
										<div class="form-actions">
											<input type="submit" value="Save changes" class="btn btn-primary">
											<a href="<?php echo $this->webroot;?>tskroareward/"><button type="button" class="btn">Cancel</button></a>
										</div>
									</div>
										
									</div>

								
										
										
							
									

							
									
									
					<input type="hidden" id="end_date" value="<?php echo date('m/Y', strtotime('-0 Month'));?>" />

										
										
										
										<?php echo $this->Form->input('id', array('type' => 'hidden'));?>
								<?php echo $this->Form->end(); ?>
							</div>
						</div>
					</div>
				</div>
					
					
				</div>
		
			
			</div>
	
			
	
