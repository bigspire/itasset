<style>
body.navbar-fixed{padding-top:0}
body{background:none;}
</style>	
<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">	
<div class="widget-box">
											<div class="widget-header">
												<h4 style="font-size:14px;" class="widget-title lighter smaller">
													<i class="ace-icon fa fa-comment blue"></i>
													<b>Comments </b>
												</h4>
											</div>

											<div class="widget-body">
												<div class="widget-main no-padding">
		
					<div class="galBox dialogs ace-scroll">
													
								<div class="scroll-content scrollable" data-start ="top" data-height="330" data-visible="true">
								<div  >					
							<?php foreach($comment_data as $commentData):?>
														<div class="itemdiv dialogdiv">
															<div class="user">
							<?php if($commentData['HrEmployee']['photo'] != '' && $commentData['HrEmployee']['photo_status'] == 'A'):?>
							<img src="<?php echo $this->webroot;?>timthumb.php?src=uploads/photo/<?php echo $commentData['HrEmployee']['photo'];?>&w=40&h=52&q=100" title="<?php echo $commentData['HrEmployee']['first_name'].' '.$commentData['HrEmployee']['last_name'];?>"/>	
							<?php elseif($commentData['HrEmployee']['gender'] == 'M'): ?>
							<img  src="<?php echo $this->webroot;?>img/profile_male_s.jpg" title="<?php echo $commentData['HrEmployee']['first_name'].' '.$commentData['HrEmployee']['last_name'];?>"/>
							<?php else: ?>
							<img  src="<?php echo $this->webroot;?>img/profile_female_s.jpg" title="<?php echo $commentData['HrEmployee']['first_name'].' '.$commentData['HrEmployee']['last_name'];?>"/>
							<?php endif; ?>	
							
															
															</div>

															<div class="body" style="font-size:12px;">
																<div class="time">
																	<i class="ace-icon fa fa-clock-o"></i>
																	<span class="blue"  style="font-size:12px;font-weight:normal;"><?php echo $this->Functions->time_diff($commentData['HrGalComment']['created_date'], 1);?></span>
																</div>

																<div class="name">
																	<?php echo $commentData['HrEmployee']['first_name'];?>
																</div>
																<div class="text"  style="font-size:12px;"><?php echo $commentData['HrGalComment']['msg'];?></div>

																
															</div>
															
														</div>
													
													
										<?php endforeach;?>
	
													
													
													
													</div>
							</div>
										
													
													</div>

												
												</div><!-- /.widget-main -->
											</div><!-- /.widget-body -->
											
											
	</div>			
	</div>
	</div>
</div>