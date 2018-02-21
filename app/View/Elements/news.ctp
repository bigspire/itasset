
	
	<?php foreach($news_data as $news):?>
<div class="timeline-container">
											

												<div class="timeline-items">
													<div class="timeline-item clearfix">
														

														<div class="widget-box transparent" style="margin-left:1px;">
															<div class="widget-header widget-header-small">
															
																<h5 class="smaller">
																	
																	<span class="grey"><b><?php echo $news['HrLatest']['title'];?></b></span>
																</h5>



										
											<span class="widget-toolbar no-border">
																	<i class="icon-time bigger-110"></i>
																	<?php
				$date = $this->Functions->get_latest_date($news['HrLatest']['created_date'], $news['HrLatest']['modified_date']);
																		echo $this->Functions->time_diff($date);?> 
																</span>

								
												
															</div>
															
															

															<div class="widget-body">
															
		
		
																<div class="widget-main">
																
																<?php 
		$is_img = $this->Functions->check_image($news['HrLatest']['attachment']);
		if(!empty($news['HrLatest']['attachment']) && $is_img == true): ?>																
<div style="float:left;display:block;padding-right:10px;">
	<a  href="<?php echo $this->webroot;?>uploads/news/<?php echo $news['HrLatest']['attachment'];?>" title="" data-rel="colorbox" class="cboxElement colorbox"><img class="nav-user-photo thumb" src="<?php echo $this->webroot;?>timthumb.php?src=uploads/news/<?php echo $news['HrLatest']['attachment'];?>&h=100&q=100"/></a>
	</div>
		<?php endif; ?>
		
																	<?php echo $this->Functions->string_truncate($news['HrLatest']['desc'], 450);?>
																	<div class="space-6"></div>

																	<div class="widget-toolbox clearfix">
																		<div class="pull-left">
													<?php //if(strlen($news['HrLatest']['desc']) > 450):	?>		
																			<i class="icon-hand-right grey bigger-125"></i>
																			
	<a href="<?php echo $this->webroot;?>home/news_detail/<?php echo $news['HrLatest']['id'];?>/" class="iframeBox" val="60_90" class="bigger-110 moreNews">		
	Read more</a>
			
			<?php //$style = 'margin-left:20px'; endif; ?>
			
			
			<?php if($is_img == false && !empty($news['HrLatest']['attachment'])):?>
				<i style="margin-left:20px" class=" icon-download-alt grey bigger-125"></i> <a href="<?php echo $this->webroot;?>home/download_news/<?php echo $news['HrLatest']['attachment'];?>"  class="bigger-110">Download</a>
			<?php endif; ?>
																		</div>

																	
																	</div>
																</div>
															</div>
														</div>
													</div>

													

													

													
												</div>
											
											</div>
											
	<?php endforeach; ?>








