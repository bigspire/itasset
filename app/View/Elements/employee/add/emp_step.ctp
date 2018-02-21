	<form action="post.php" method="POST" class="form-horizontal form-wizard ui-formwizard" id="ss" novalidate="novalidate">
									<div class="step ui-formwizard-content" id="firstStep" style="width:99%;margin-top:20px;">
										<ul class="wizard-steps steps-4">
												<li class="<?php echo $this->Functions->get_reg_active('personal');?>">
												<div class="single-step">
													<span class="title">
														1</span>
													<span class="circle">
													</span>
													<span class="description">
													<?php if($this->Session->read('reg.step1') == '1'): ?>
							<a href="<?php echo $this->webroot;?>hremployee/create_employee/personal/">Personal</a>
							<?php else: ?>
							Personal 		
							<?php endif; ?>											</span>
												</div>
											</li>
										
											
				<li class="<?php echo $this->Functions->get_reg_active('education');?>">
												<div class="single-step">
													<span class="title">
														2</span>
													<span class="circle">
														<span class="active"></span>
													</span>
													<span class="description">
															<?php if($this->Session->read('reg.step2') == '1'): ?>
							<a href="<?php echo $this->webroot;?>hremployee/create_employee/education/">Education</a>
							<?php else: ?>
							Education 		
							<?php endif; ?>
													</span>
												</div>
											</li>
											<li class="<?php echo $this->Functions->get_reg_active('experience');?>">
												<div class="single-step">
													<span class="title">
														3</span>
													<span class="circle">
													</span>
													<span class="description">
														<?php if($this->Session->read('reg.step3') == '1'): ?>
							<a href="<?php echo $this->webroot;?>hremployee/create_employee/experience/">Experience</a>
							<?php else: ?>
							Experience 		
							<?php endif; ?>
													</span>
												</div>
											</li>
											<li class="<?php echo $this->Functions->get_reg_active('family');?>">
												<div class="single-step">
													<span class="title">
														4</span>
													<span class="circle">
													</span>
													<span class="description">
														<?php if($this->Session->read('reg.step4') == '1'): ?>
							<a href="<?php echo $this->webroot;?>hremployee/create_employee/family/">Family</a>
							<?php else: ?>
							Family 		
							<?php endif; ?>
													</span>
												</div>
											</li>
											
									<?php if($this->request->params['action'] != 'edit_employee'):?>
											
											<li class="<?php echo $this->Functions->get_reg_active('confirm');?>">
												<div class="single-step">
													<span class="title">
														5</span>
													<span class="circle">
													</span>
													<span class="description">
															<?php if($this->Session->read('reg.step4') == '1'): ?>
							<a href="<?php echo $this->webroot;?>hremployee/create_employee/confirm/">Confirm</a>
							<?php else: ?>
							Confirm 		
							<?php endif; ?>
													</span>
												</div>
											</li>
											<?php endif; ?>
										</ul>
									</div>
								
								</form>