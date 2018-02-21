<style>
body.navbar-fixed{padding-top:0}
</style>	
<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header" style="border-bottom:1px dotted #ccc;padding-bottom:20px;">
					<div class="pull-left" style="height:auto;margin-left:10px;">
						  <h4 style="font-size:14px;color:#444" class="modal-title"><?php echo $gallery_data['HrGallery']['title'];?> - 
						  <span style="font-size:12px;font-weight:normal;color:#444"><?php echo $this->Functions->string_truncate($gallery_data['HrGallery']['desc'], 150);?></span></h4>
						  
					</div>
					
				</div>
				
				
					<div class="row-fluid">
					<div class="span12">
					<div style="width:750px;margin-left:10px;float:left;">
					
					<ul class="pager" style="margin-top:0;margin-bottom:0;">
											<li class="previous prevSlide" style="position:absolute;top:260px;left:25px;">
												<a href="javascript:void(0)" title="Previous Photo"><i class="icon-circle-arrow-left"></i></a>
											</li>
											
			<?php foreach($gallery_item as $key => $item): ?>
						
			<?php if($item['HrGalleryItem']['id'] == $this->request->params['pass'][1]):
			$display = '';
			else:
			$display = 'display:none';
			endif;
			?>
			
			<?php if($commentData[$item['HrGalleryItem']['id']]['user_like'][0]):
				$tip = 'Liked!';
				$cursor = 'default';
				$opt = '1';
				$btn_color = 'btn-primary';
				else: 
				$tip = 'Click to Like';
				$cursor = '';
				$opt = '0';
				$btn_color = '';
				endif; ?>
			
			<div class="likeBtn like<?php echo $item['HrGalleryItem']['id'];?>" style="position:fixed;bottom:15px;float:left;margin-left:10px;margin-bottom:10px;<?php echo $display;?>">
					<button opt="<?php echo $opt;?>" style="cursor:<?php echo $cursor;?>;" title="<?php echo $tip;?>" val="<?php echo $this->request->params['pass'][0];?>" rel="<?php echo $item['HrGalleryItem']['id'];?>" class="likeOpt<?php echo $item['HrGalleryItem']['id'];?> btn btn-app <?php echo $btn_color;?> btn-sm galLike">
					<i class="ace-icon fa icon-thumbs-up thumbs-up<?php echo $item['HrGalleryItem']['id'];?>"></i> 
					<?php //if($commentData[$item['HrGalleryItem']['id']]['user_like'][0]):?>
					<!--span style="font-size:12px;">Liked</span-->
					<?php //else: ?>
					<!--span style="display:none;font-size:12px;" class="liked<?php echo $item['HrGalleryItem']['id'];?>">Liked</span-->
					<?php //endif; ?>
					<i class="processing process<?php echo $item['HrGalleryItem']['id'];?>"></i>
					<?php if($commentData[$item['HrGalleryItem']['id']]['like'][0]):
					$display_btn = '';
					else:
					$display_btn = 'display:none';
					endif;
					?>
					<span class="likeBadge<?php echo $item['HrGalleryItem']['id'];?> badge badge-warning badge-right" style="<?php echo $display_btn;?>">
					<?php echo $commentData[$item['HrGalleryItem']['id']]['like'][0];?>
					</span>
					</button>
					
					</div>
			<?php endforeach;?>
											<li class="next nextSlide"  style="position:absolute;top:260px;right:375px;">
												<a href="javascript:void(0)" title="Next Photo"> <i class="icon-circle-arrow-right"></i></a>
											</li>
										</ul>
										
										
				
					
					
					
					
					
						<div id="slider" style="margin-top:5px;"> 
	<?php foreach($gallery_item as $item):?>	
	<?php if($item['HrGalleryItem']['id'] == $this->request->params['pass'][1]):
	$display = '';
	$cls = 'current';
	else:
	$display = 'display:none';
	$cls = '';
	endif;
	?> 
	<a href="javascript:void(0);"   title="<?php echo $item['HrGalleryItem']['file'];?>" class="galPhoto <?php echo $cls; ?>" rel="<?php echo $item['HrGalleryItem']['id'];?>" style="cursor:default;<?php echo $display;?>"><img src="<?php echo $this->webroot;?>timthumb.php?src=file_upload/server/php/<?php echo $gallery_data['HrGallery']['folder'].'/'.$item['HrGalleryItem']['file'];?>&w=750&q=100"/></a>
	<?php endforeach;?>
	</div>
	</div>
	<div style="width:330px; float:right;margin-top:0px;margin-right:10px;">
	
	
	<div class="widget-box">
											<div class="widget-header">
												<h4 style="font-size:14px;" class="widget-title lighter smaller">
													<i class="ace-icon fa fa-comment blue"></i>
													<b>Comments </b>
												</h4>
											</div>

											<div class="widget-body">
												<div class="widget-main no-padding">
										<?php foreach($gallery_item as $item):?>	
			<?php if($item['HrGalleryItem']['id'] == $this->request->params['pass'][1]):
			$display = '';
			else:
			$display = 'display:none';
			endif;
			?> 
					<div class="galBox dialogs ace-scroll comment<?php echo $item['HrGalleryItem']['id'];?>" style="<?php echo $display;?>">
													
								<div class="scroll-content scrollable" data-start ="top" data-height="330" data-visible="true">
								<div  id="msgBox<?php echo $item['HrGalleryItem']['id'];?>" >					
													<?php 
													$com_st = 0;
													$count = count($commentData[$item['HrGalleryItem']['id']]);
													if($count > 0):													
													for($i = 0; $i < $count; $i++):
													if(!empty($commentData[$item['HrGalleryItem']['id']]['msg'][$i])):
													$com_st = 1;
													?>
														<div class="itemdiv dialogdiv">
															<div class="user">
							<?php if($commentData[$item['HrGalleryItem']['id']]['photo'][$i] != '' && $commentData[$item['HrGalleryItem']['id']]['photo_st'][$i] == 'A'):?>
							<img src="<?php echo $this->webroot;?>timthumb.php?src=uploads/photo/<?php echo $commentData[$item['HrGalleryItem']['id']]['photo'][$i];?>&w=40&h=52&q=100" title="<?php echo $commentData[$item['HrGalleryItem']['id']]['user'][$i].' '.$commentData[$item['HrGalleryItem']['id']]['last'][$i];?>"/>	
							<?php elseif($commentData[$item['HrGalleryItem']['id']]['gender'][$i] == 'M'): ?>
							<img  src="<?php echo $this->webroot;?>img/profile_male_s.jpg" title="<?php echo $commentData[$item['HrGalleryItem']['id']]['user'][$i].' '.$commentData[$item['HrGalleryItem']['id']]['last'][$i];?>"/>
							<?php else: ?>
							<img  src="<?php echo $this->webroot;?>img/profile_female_s.jpg" title="<?php echo $commentData[$item['HrGalleryItem']['id']]['user'][$i].' '.$commentData[$item['HrGalleryItem']['id']]['last'][$i];?>"/>
							<?php endif; ?>	
							
															
															</div>

															<div class="body" style="font-size:12px;">
																<div class="time">
																	<i class="ace-icon fa fa-clock-o"></i>
																	<span class="blue"  style="font-size:12px;font-weight:normal;"><?php echo $this->Functions->time_diff($commentData[$item['HrGalleryItem']['id']]['time'][$i], 1);?></span>
																</div>

																<div class="name">
																	<a href="<?php echo $this->webroot;?>home/overlay_info/<?php echo $commentData[$item['HrGalleryItem']['id']]['emp'][$i];?>/share/" class="iframeBox" val="80_86"><?php echo $commentData[$item['HrGalleryItem']['id']]['user'][$i];?></a>
																</div>
																<div class="text"  style="font-size:12px;"><?php echo $commentData[$item['HrGalleryItem']['id']]['msg'][$i];?></div>

																
															</div>
															
														</div>
													
													
										<?php endif;?>
	
														<?php endfor;?>
													
										
										
													<?php endif;?>
													
													<?php if($com_st == '0'):?>
													<div class="alert alert-warning">
											<button type="button" class="close" data-dismiss="alert">
												<i class="ace-icon fa fa-times"></i>
											</button>
											<strong></strong>

											Be the first to post comment on this photo!
											<br>
										</div>
										<?php endif; ?>
													</div>
							</div>
										
													
													</div>

										<?php endforeach;?>			
												<form>
														<div class="form-actions">
															<div class="input-group">
																<textarea id="commentTxt" style="font-size:12px;height:32px;width:310px;" placeholder="Type your message here ... Hit Enter to Save.."  class="autosize-transition form-control" name="message"></textarea>
																<span class="input-group-btn" style="float:right;margin-top:3px;margin-right:50px;">
																
																</span>
															</div>
														</div>
													</form>
												</div><!-- /.widget-main -->
											</div><!-- /.widget-body -->
											
											
	</div>			<input type="hidden" id="webroot" value="<?php echo $this->webroot;?>"/>

<input type="hidden" id="photoID" value="<?php echo $this->request->params['pass'][1];?>"/>	
<input type="hidden" id="galID" value="<?php echo $this->request->params['pass'][0];?>"/>						
				
</div>	
					</div>
				
				
				
				
				
				</div>
					
					
				</div>
		
			
			</div>
		
			
					
				
		
		</div>

<script src="<?php echo $this->webroot;?>js/jquery.min.js"></script>
<script src="<?php echo $this->webroot;?>js/bootstrap.min.js"></script>
<script src="<?php echo $this->webroot;?>js/jquery.slimscroll.min.js"></script>
<script src="<?php echo $this->webroot;?>js/application.js"></script>
<script src="<?php echo $this->webroot;?>js/jquery.autosize.min.js"></script>
<script src="<?php echo $this->webroot;?>js/plugins/colorbox/jquery.colorbox-min.js"></script>
		
<script>

$(document).ready(function() { 	
	$('.nextSlide').click(function(){
		if($('.current').next().html() != undefined && $('.current').next().html() != ''){
			$('.current').hide();
			$('.current').next().show();
			$('.current').next().addClass('current');
			$('.current:eq(0)').removeClass('current');
			// show comment box
			$('.galBox').hide();
			$('.comment'+$('.current').attr('rel')).show();
			// show the like btn
			$('.likeBtn').hide();
			$('.like'+$('.current').attr('rel')).show();
			// assign the photo id
			$('#photoID').attr('value',$('.current').attr('rel')); 
			// hide next button
			if($('.current').next().html() != undefined && $('.current').next().html() != ''){
				$(this).css('visibility', 'visible');
				$('.prevSlide').css('visibility', 'visible');
			}else{
				$(this).css('visibility', 'hidden');
			}
			// empty the comment
			$('#commentTxt').val('');
		}else{
			$(this).css('visibility', 'hidden')
		}
	});
	
	$('.prevSlide').click(function(){
		if($('.current').prev().html() != undefined && $('.current').prev().html() != ''){
			$('.current').hide();
			$('.current').prev().show();
			$('.current').prev().addClass('current');
			$('.current:eq(1)').removeClass('current');
			// show the comment box
			$('.galBox').hide();
			$('.comment'+$('.current').attr('rel')).show();	
			// show the like btn
			$('.likeBtn').hide();
			$('.like'+$('.current').attr('rel')).show();	
			// assign the photo id
			$('#photoID').attr('value',$('.current').attr('rel'));			
			// hide previous button
			if($('.current').prev().html() != undefined && $('.current').prev().html() != ''){
				$(this).css('visibility', 'visible');
				$('.nextSlide').css('visibility', 'visible');
			}else{
				$(this).css('visibility', 'hidden');	
			}
			// empty the comment
			$('#commentTxt').val('');
		}else{
			$(this).css('visibility', 'hidden');
		}
	});
	
	// for autoresize textbox	
	$('textarea[class*=autosize]').on('focus', function(){
		 $(this).autosize({append: "<br>"});
	});
	
	/* function to send gallery comment */
	$('#commentTxt').on('keydown', function(e){
		var keyCode = e.which || e.keyCode;
		if(keyCode == 13){ 	
			comment = $('#commentTxt').val().trim();
			// validate comment
			if(comment != '' && comment != undefined){
				photo = $('#photoID').val();
				gallery = $('#galID').val();
				$(this).hide();
				var jqxhr = $.ajax({
					url: $('#webroot').val()+'home/update_comment/?id='+photo+'&gal_id='+gallery+'&comment='+encodeURIComponent(comment)
				})
				.done(function(html) { 
					$('#commentTxt').show();
					$('#commentTxt').val('');
					$('#commentTxt').css('border', '1px solid #d5d5d5');
					// load the output
					$('#msgBox'+$('#photoID').val()).html(html);
				})
				.fail(function() {
				})
				.always(function() {
						
				});
			}else{
				 $('#commentTxt').css('border', '1px solid #ff0000');
			}
		}
	});
	
	// load the color box
	$('.iframeBox').click(function(){
		load_colorBox(this, $(this).attr('val'));	
	});
	
	/* function to call like gal. images */
	$('.galLike').click(function(){
		// check already liked
		if($(this).attr('opt') != '1'){
			$(this).children('.processing').html('<img src='+$('#webroot').val()+'img/dot-loader.gif>').show();
			$(this).children('.icon-thumbs-up').hide();
			photo = $(this).attr('rel');
			gal = $(this).attr('val');
			var jqxhr = $.ajax({
				url: $('#webroot').val()+'home/update_like/?id='+photo+'&gal_id='+gal
			})
			.done(function(html) { 
				$('.process'+photo).hide();
				$('.thumbs-up'+photo).show();
				// add like count
				if(html == '1'){
					badge_value = parseInt($('.likeBadge'+photo).text(), 10) + 1;
					$('.likeBadge'+photo).html(badge_value).show();
					//$('.liked'+photo).show();
					$('.likeOpt'+photo).attr('opt', 1);
					$('.likeOpt'+photo).css('cursor', 'default');
					$('.likeOpt'+photo).attr('title', 'Liked!');
					$('.likeOpt'+photo).addClass('btn-primary');
					
				}
			})
			.fail(function() {
			})
			.always(function() {
							
			});
		}
	});
	
	/* function to display the photo 
	$('#slider').mouseover(function(){
		$('.nextSlide').show();
		$('.prevSlide').show();
	});
	
	/* function to display the photo 
	$('#slider').mouseout(function(){
		$('.nextSlide').fadeOut();
		$('.prevSlide').fadeOut();
	});
	
	*/
	
	
});
	/* function to load the color box */
	function load_colorBox(obj, size){ 
		// email to friends	
		if($(obj).attr('val') != '' && $(obj).attr('val') != undefined) {
		
			dim = $(obj).attr('val').split('_');
			width = dim[0];
			height = dim[1];
		
			if($('#overlayclose').length > 0){
				over_close = false;
				esc = false;
				$('#cboxClose').show();	
				if($('#overlayclose').val() > 0){
					$('#cboxClose').hide();
				}			
			}else{
				over_close = true;
				esc = true;
			}

			
			$(obj).colorbox({iframe:true, rel: 'nofollow',  width:width+'%', height:height+'%',opacity:   '.8', 	  scrolling: true, fixed:true,overlayClose:over_close, escKey: esc,
			onClosed:function(){ 
				// for my tasks plan
					if($('#pageReload').length > 0){ 
						
					}
				}
			
			});
		}
	}
	
</script>

