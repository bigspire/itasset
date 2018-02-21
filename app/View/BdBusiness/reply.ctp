
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				
			
				<?php echo $this->Session->flash();?>
					<div class="row-fluid">
							
						<div class="span12">
						<div class="box">
							<div class="box-title">
								<h3><i class="icon-file-alt"></i>Minutes of Review</h3>
							
							</div>
							<div class="box-content nopadding">
								<ul class="messages scrollable replyMsg" data-height="320" data-visible="true" data-start="top">
								
								<?php echo $this->element('reply_bd'); ?>
									
								<?php if(count($reply_data) == 0):?>
								<div class="alert">
											<button type="button" class="close" data-dismiss="alert">×</button>
											<strong>No reviews!</strong>

<?php if($bdAdmin):?>	<br><br> Be the first to add! <?php endif; ?>
										</div>
								<?php endif; ?>
									
								</ul>
								
								<?php if($bdAdmin):?>
								
									<ul class="messages" style="margin:10px 20px 5px 0px;width:96%">
									<li class="typing">
										<span class="name"></span> Saving... Pls wait.. <img src="<?php echo $this->webroot;?>img/loading.gif" alt="">
									</li>
									<li class="insert bdSubmit"  style="border:none;margin-left:20px;">
											<div class="text" style="margin-right:0;">

														<textarea  id="reply_bd"  style="border:1px solid #e0dede;height:32px;" name="text" placeholder="Type here..." class="input-block-level form-control autosize-transition bdReply"></textarea>
														<input type="button" id="reviewBD" class="btn btn-primary" value="Submit" class="bdReply"/>
											</div>
											
											<!--div class="submit bdSubmit">
												<button type="button" id="bdBtn"><i class="icon-share-alt"></i></button>
											</div-->
									</li>
									
									</ul>
							<?php endif; ?>
								
							</div>
						</div>
					</div>	
									
									</div>
									
									
															<input type="hidden" value="<?php echo $this->webroot;?>bdbusiness/" id="webroot"/>

								<input type="hidden" value="<?php echo $this->request->params['pass'][0];?>" id="bd_id"/>	
								<?php echo $this->Form->end(); ?>
							</div>
						
					
				</div>
					
					
				</div>
		
			
		
