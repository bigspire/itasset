<?php if($this->request->data['refresh'] != 1):?>

	
<?php //echo $this->element('coming');?>
<?php echo $this->element('comp_profile');?>
<div class="modal" id="newsModal" style="display:none">
	<div class="modal-dialog" style="width:750px">
      <div class="modal-content">
        <!--div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icon-remove small"></i></button>
          <h4 class="modal-title">	News Details</h4>
        </div><div class="container"></div-->
        <div class="modal-body">
        
		<?php foreach($news_data as $newsdata): ?>
				 <div class="news-detail user-profile row news_<?php echo $newsdata['HrLatest']['id']; ?>" style="display:none;height:425px;overflow:auto">
		
		
		<?php echo $newsdata['HrLatest']['desc']; ?>
	
	
									</div>
        <?php endforeach; ?>
		
        </div>
        <div class="modal-footer">
          <a href="#" data-dismiss="modal" class="btn">Close</a>
        </div>
      </div>
    </div>
</div>

<?php endif; ?>	

	
		<div id="ajaxLoadDiv">
		
		
		
		<?php echo $this->element('header'); ?>
		
		<div class="main-container" id="main-container">
			
			
			<?php if(strtotime(date('Y-m-d')) <= strtotime('2014-08-14')):?>
			<div id="new_f" style="position: absolute;top: 55px;right: 37px;z-index: 1;"><span class="label label-yellow" style="color:#fff !important;border-radius:0px 5px 0px 5px"><i>New Themes loaded...</i>  <i class="icon-hand-right"></i></span></div>
			<?php endif; ?>
			

			<div class="main-container-inner">
				<a class="menu-toggler" id="menu-toggler" href="#">
					<span class="menu-text"></span>
				</a>

				

				<div class="main-content">
					<div class="breadcrumbs" id="breadcrumbs">
						<script type="text/javascript">
							try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
						</script>

						<ul class="breadcrumb">
							<li>
								<i class="icon-home home-icon"></i>
								<a href="<?php echo $this->webroot;?>home/">Home</a>
							</li>
							<li class="active">Dashboard</li>
							
						</ul><!-- .breadcrumb -->
						
						<div style="float:right;margin-right:34%;" class="dn confirm_out">Are you sure ? 
						
						<button  class="btn btn-success  btn-xs out_yes">
													Yes
												
												</button>
												
												<button  class="btn btn-inverse btn-xs out_no">
													No
												
												</button>
												
												
						</div>	
				
											
					</div>
						

					<div class="page-content">
						<!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->

							
				<?php  if($this->Session->read('WELCOME') == '1'): ?>
							<div class="alert alert-block alert-info welcomeAlert" style="width:45%;margin-bottom:0px;">
									<button type="button" class="welcomeIcon close" data-dismiss="alert">
										<i class="icon-remove"></i>
									</button>

									<i class="icon-ok blue"></i>

									Hi <?php echo ucfirst($this->Session->read('USER.Login.first_name')); ?>! Welcome to
									<strong class="blue">
										My PDCA
										
									</strong>
									,
	Have a great day!
								</div>

								
				<?php endif; ?>
								

								
								<?php $res = $this->Session->flash();
								if( $res != ''):?>
								<div class="alert alert-info" style="width:82%;margin-top:5px;">
											<button type="button" class="close" data-dismiss="alert">
												<i class="icon-remove"></i>
											</button>
											<?php echo strip_tags($res);?>	
											<br>
										</div>
										
							<?php endif; ?>			
								


								<div class="row" style="margin-top:5px">
									<div class="col-sm-12">
										<div class="widget-box transparent" id="recent-box">
											<div class="widget-header">
											
										
									
									
												<!--h4 class="lighter smaller">
													<i class="icon-rss orange"></i>
													Home
												</h4-->
												
						
							<h4>
								Dashboard
							
							</h4>
								
							
									
									

												<div class="widget-toolbar no-border">
													<ul class="nav nav-tabs" id="recent-tab">
													
														<li class="active dashList">
															<a data-toggle="tab" class="listlink" id="plan"  href="#plan-tab">Tasks</a>
														</li>
														
														<li class="dashList">
															<a data-toggle="tab" class="listlink" id="att"  href="#att-tab">Attendance</a>
														</li>
														
															<li class="dashList">
															<a data-toggle="tab" class="listlink"  id="task" href="#task-tab">To do
															<?php if($todo_count > 0):?>
															<span class="badge badge-warning radius5"><?php echo $todo_count; ?></span>
															<?php endif; ?></a>
														</li>
														
														<li class="dashList">
															<a data-toggle="tab" class="listlink"  id="event" href="#event-tab">Events
															<?php if($event_count > 0):?>
															<span class="badge badge-warning radius5"><?php echo $event_count; ?></span>
															<?php endif; ?></a>
														</li>
														
														
														<li class="dashList">
															<a  data-toggle="tab" class="listlink"  id="chat" href="#chat-tab">Interact 
															<span class="badge badge-warning radius5 intCount dn"></span>
															
															<?php if($share_count > 0):?>
															<span class="badge badge-warning radius5 intCount2"><?php echo $share_count; ?></span>
															<?php endif; ?></a>
														</li>
														
															<li class="dashList">
															<a data-toggle="tab" class="listlink" id="news" href="#news-tab">Latest Updates
															<?php if($news_count > 0):?>
															<span class="badge badge-warning radius5"><?php echo $news_count; ?></span>
															<?php endif; ?>
															</a>
														</li>	
														
															<li class="dashList">
															<a data-toggle="tab" class="listlink"   id="poll" href="#poll-tab">Voice
															<?php if($poll_count > 0):?>
															<span class="badge badge-warning radius5"><?php echo $poll_count; ?></span>
															<?php endif; ?></a>
														</li>
														
										<li  class="dashList">
															<a data-toggle="tab" class="listlink" id="profile"  href="#profile-tab">Profile</a>
														</li>
													
														
														
														
														<!--li class="dashList">
															<a data-toggle="tab" class="listlink" id="event" href="#event-tab">Events
															<span class="badge badge-warning radius5"></span></a></a>
														</li-->
														
													

													
														
														<li class="dashList">
															<a data-toggle="tab" class="listlink"  id="member" href="#member-tab">CTians</a>
														</li>
														
													

															
														
														
														<li class="dashList">
															<a data-toggle="tab" class="listlink"   id="form" href="#form-tab">Forms</a>
														</li>		
														<li class="dashList">
															<a data-toggle="tab" class="listlink"  id="gal" href="#gal-tab">Gallery
															<?php if($gal_count > 0):?>
															<span class="badge badge-warning radius5"><?php echo $gal_count; ?></span>
															<?php endif; ?></a>
														</li>
														
													</ul>
												</div>
											</div>
	<input type="hidden" id="webroot" value="<?php echo $this->webroot;?>"/>
											<div class="widget-body">
												<div class="widget-main padding-4">
													<div class="tab-content padding-8 overflow-visible">
													
														<div id="chat-tab" class="tab-pane">
															

														<div class="widget-body">
												<div class="widget-main no-padding ">
													<div class="slimScrollDiv" id="shareScroll">
													<div class="">
													<div class="clearfix">
													<div id="share_results" class="shareData">
													<?php echo $this->element('share');?>
                                                    </div>													

														
													</div></div></div>

														<?php echo $this->Form->create('Share', array('type' => 'file', 'method' => 'post', 'id' => 'formID', 'onsubmit' => 'return false', 'class' => '')); ?>
			<div class="form-actions" style="border-bottom:1px solid #e5e5e5;">
															
															
					
				<div class="input-group" style="width:100%">													
														
		<textarea placeholder="Enter the message here ..."  autocomplete="off" type="text" class="form-control autosize-transition shareTxtBx postShare share_er" id="shareTxtBx" name="message" style="height:32px"></textarea>
															
														
<div style="float:left;margin-top:10px;">
<span id="share_file_name"></span>
		<span><a href="javascript:void(0)"  id="share_file_remove" class="dn">Remove</a></span>
		<span style="color:#ff0000" class="dn file_share_error"></span>	
</div>	
											
<div class="btn-group" style="float:right;margin-top:10px;">


				
												
												
												<button name="message" class="btn no-radius btn-xs  btnID btn-info shareBtn"><span class="icon-share-alt"></span> Send (<span class="no_users">All</span> Users)</button>
												
												
												<button data-original-title="Options" data-placement="top"   title="Options" data-toggle="dropdown" class="btn-info btn btn-xs dropdown-toggle btndrop show-tip click_hide">
													<span class="icon-caret-down icon-only"></span>
												</button>
																							

												<ul class="dropdown-menu dropdown-success">
													<li>
														<a id="all_user" href="javascript:void(0)">All Users</a>
													</li>
													<li>
														<a id="interact_url" href="<?php echo $this->webroot;?>home/share_user/" class="iframeBox" val="36_60">Let me select</a>
													</li>
												</ul>
												
												<div  data-original-title="Attach File" data-placement="top"   title="Attach File" class="fileUpload btn btn-info btn-xs  show-tip click_hide">
													<span class="icon-picture"></span>
													<?php echo $this->Form->input('upload_file', array('type' => 'file', 'label' => false, 'value' => '', 'div' => false, 'class' => 'upload',  'id' => 'uploadShareFile'));?>
												</div>
												
												<button  class="btn no-radius btn-xs btn-info refShare"><span class="icon-refresh"></span> Refresh</button>
												
												
											</div>
											
												<?php echo $this->Form->input('webroot_share', array('div'=> false,'type' => 'hidden', 'id' => 'webroot_share', 'value' => $this->webroot.'home/share_user/'));
												echo $this->Form->input('hdnId', array('div'=> false,'type' => 'hidden', 'id' => 'hdnId'));?>
											
											<input type="hidden" id="ref_share">
															</div>
														</div>
														
			
				
															
														
														
													<input type="hidden" id="share_url" value="<?php echo $this->webroot;?>home/store_share/"/>
														<input type="hidden" id="share_reply_url" value="<?php echo $this->webroot;?>home/reply_share/"/>
															<input type="hidden" id="update_share_url" value="<?php echo $this->webroot;?>home/update_share/"/>
															
										<input type="hidden" value="<?php echo $this->Session->read('total_group'); ?>" id="total_group">
								
										
													<?php echo $this->Form->end(); ?>
												</div>
															
															
														</div>
														
														
									
									
									
													</div>
														
														<div id="task-tab" class="tab-pane">
															
	<div>
													<div class="scrollable" data-start ="top" data-height="310" data-visible="true">
													<div class="clearfix">
															<ul id="tasks" class="sortable item-list ui-sortable todoData">
															
															
																
															<?php echo $this->element('todo');?>
																
															</ul>
													</div>		
															
														</div>
														
</div>
	<?php echo $this->Form->create('Task', array('method' => 'post', 'id' => 'formID', 'onsubmit' => 'return false', 'class' => '')); ?>


														<div class="form-actions">
															<div class="input-group">
				<input placeholder="Enter the task here ..." id="taskTxtBx" type="text" class="form-control taskTxtBx postShare todo_er" name="task">
																<span class="input-group-btn">
																	<button class="btnID btn btn-sm btn-info no-radius todo_btn" type="button">
																		<i class="icon-share-alt"></i>
																		Save
																	</button>
																</span>
															</div>
			<div style="float:right;font-size:11px;color:#918C8C;padding:25px 0 0;"><span class=""><i class="icon-move"></i> </span> Just drag and drop the todo list items to order it.</div>
														</div>
														<input type="hidden" id="todo_url" value="<?php echo $this->webroot;?>home/store_todo/"/>
															<input type="hidden" id="update_todo_url" value="<?php echo $this->webroot;?>home/update_todo/"/>
															<input type="hidden" id="save_todo_url" value="<?php echo $this->webroot;?>home/save_todo/"/>
															<input type="hidden" id="delete_todo_url" value="<?php echo $this->webroot;?>home/delete_todo/"/>
															<input type="hidden" id="flag_todo_url" value="<?php echo $this->webroot;?>home/flag_todo/"/>
															<input type="hidden" id="update_ses_url" value="<?php echo $this->webroot;?>home/update_welcome_msg/"/>
	<input type="hidden" id="todo_sort_url" value="<?php echo $this->webroot;?>home/sort_todo/"/>

													<?php echo $this->Form->end(); ?>
													</div>	
													
											
												<div id="plan-tab" class="tab-pane active">
															
	
													<div class="clearfix">
															
															
															
																
															<?php echo $this->element('task_cal');?>
																
															
													</div>		
															
														

	
													</div>	
													
													
	<div id="att-tab" class="tab-pane">
	<div class="widget-body">
												<div class="widget-main no-padding dashScroll">
													<div class="scrollable" data-start ="top" data-height="415" data-visible="true">
													<div >
													<div class="clearfix">
			
													
<div class="btn-group" style="position:absolute;right:25px;top:43px;">

<?php if(!empty($apprv_att)) :?>
<a style="float:left;" href="<?php echo $this->webroot;?>home/verify_att/" rel="tooltip"  title="Approve Team Attendance" class="iframeBox click_hide" val="60_75"><button class="btn-primary btn  btn-xs dropdown-toggle" style="margin-right:5px">

<span class="icon-ok icon-on-right"></span> Approve	
<?php if($appr_count > 0):?>
<span class="badge badge-warning stCount" style="top:-10px"><?php echo $appr_count; ?></span>
<?php endif; ?></button></a>
<?php endif; ?>

<button data-toggle="dropdown" class="btn  btn-sm dropdown-toggle click_hide" style="border-width:0px" rel="tooltip"  title="Past Attendance">
													Rewind

													<span class="icon-caret-down icon-on-right"></span>
												</button>
								
									<ul class="dropdown-menu dropdown-info pull-right">
													<li>
													
													
												
											<a href="javascript:void(0)" rel="<?php echo date("Y-m", strtotime('-1 months'));?>" class="showBy">Previous Month (<?php echo date("M,y", strtotime('-1 months'));?>)</a>
													</li>

													<li>
											<a href="javascript:void(0)" rel="<?php echo date('Y-m');?>" class="showBy">Current Month (<?php echo date('M,y');?>)</a>
													</li>

													
													
												
														
												
												</ul></div>
															
											<?php echo $this->element('attendance'); ?>
										
								
												
												</div></div>

										</div>	

										
													
													
													
												</div>
															
															
														</div>
														
			<table style="margin-top:15px;font-size:smaller;color:#545454;border:1px solid #efefef"><tbody><tr><td class="legendColorBox"><div style="border:1px solid null;padding:1px"><div style="width:4px;height:0;border:5px solid #8F9293;overflow:hidden"></div></div></td><td class="legendLabel">Pending</td><td class="legendColorBox"><div style="border:1px solid null;padding:1px"><div style="width:4px;height:0;border:5px solid #51BC5B;overflow:hidden"></div></div></td><td class="legendLabel">Approved</td><td class="legendColorBox"><div style="border:1px solid null;padding:1px"><div style="width:4px;height:0;border:5px solid #FC7A5D;overflow:hidden"></div></div></td><td class="legendLabel">Rejected</td></tr></tbody></table>	
											
								</div>
								
								
									<div id="form-tab" class="tab-pane">
	<div class="widget-body">
												<div class="widget-main no-padding">
													<div class="slimScrollDiv" style="position: relative; overflow: auto; width: auto; height: 425px;">
													<div class="" style="overflow: auto; width: auto; height: 425px;">
													<div class="clearfix">
													

															
											<?php echo $this->element('form'); ?>
												</div></div></div>

												
													
													
													
												</div>
															
															
														</div>
											
								</div>
								
								
								
								
									<div id="event-tab" class="tab-pane">
	<div class="widget-body">
												<div class="widget-main no-padding">
													<div class="scrollable" data-height="350" data-start ="top"  data-visible="true">
													<div>
													
													
													<div class="clearfix">
													

															
											<?php echo $this->element('event'); ?>
											
												</div></div></div>
						  <?php if($event_count > 0):?>
						<div style="margin-top:10px;margin-left:5px">	<a href="<?php echo $this->webroot;?>tskevent/"><button class="btn btn-xs btn-info">
								<i class="icon-pencil"></i> Manage		</button></a></div>	
						<?php endif; ?>
													
													
													
												</div>
															
															
														</div>
											
								</div>
								
								
								<div id="gal-tab" class="tab-pane">
	<div class="widget-body">
												<div class="widget-main no-padding">
													<div >
													<div class="dialogs scrollable" data-start ="top" data-height="455" data-visible="true">
													<div class="clearfix">
													

	
<?php foreach($gallery_data as $gak_key => $gallery):?>	
		
<?php if($gak_key > 0): $galmargin = 'margin:10px 0px 0px 0px;'; endif;?>		
<div style="<?php echo $galmargin;?>"><b><?php echo ucwords($gallery['HrGallery']['title']); ?></b> - <?php echo $gallery['HrGallery']['desc']; ?>
<span class="widget-toolbar no-border" style="color:#db5e8c;line-height:25px;" >
																	<i class="icon-time bigger-110"></i>
				<?php echo $this->Functions->time_diff($gallery['HrGallery']['created_date'], 0);?>
																</span>
																</div>
	

					
<div class="galleryJs">

	<?php foreach($gallery_item[$gallery['HrGallery']['id']][0] as $key =>  $item):  ?>
	
<!--div style="float:left;">	
<span class="gal_like"><a href="javascript:void(0)">Like</a> | <a href="javascript:void(0)">Comment</a></span></div--> 
<img class="galImgs" data-like = "<?php echo $this->webroot;?>img/thumbs_up.png" data-src="<?php echo $this->webroot;?>file_upload/server/php/<?php echo $gallery['HrGallery']['folder'].'/'.$item['HrGalleryItem']['file'];?>"/>
 
      <?php endforeach; ?> 
</div>

	
	<?php endforeach;?>
		

	
												</div></div></div>

												
													
													
													
												</div>
															
															
														</div>
											
								</div>
								
								
								
									<div id="poll-tab" class="tab-pane">
	<div class="widget-body">
												
													<div class="clearfix">
													

															
											<iframe src="<?php echo $this->webroot;?>poll/?id=<?php echo $this->Session->read('USER.Login.id');?>" width="600" height="400" frameborder="0"></iframe>
											

												
													
													
													
												</div>
															
															
														</div>
											
								</div>
								
								
								
								
								
								
								
								
									<div id="news-tab" class="tab-pane">
	<div class="widget-body">
												<div class="widget-main no-padding">
													<div>
													<div class="scrollable" data-start ="top" data-height="425" data-visible="true">
													<div class="clearfix">
													

															
											<?php echo $this->element('news'); ?>
												</div></div></div>

												
													
													
													
												</div>
															
															
														</div>
											
								</div>
								
														
								<div id="profile-tab" class="tab-pane">
															
											<?php echo $this->element('profile'); ?>
											
								</div>
								
								
														
														
														<div id="member-tab" class="tab-pane">
																<div >
													<div class="scrollable" data-start ="top" data-height="425" data-visible="true">
															<div class="clearfix">
														
														
													<a style="position:absolute;right:25px;top:55px;" href="<?php echo $this->webroot;?>home/org_chart/" rel="tooltip"  title="" class="iframeBox" val="99_98"><button class="btn-danger btn  btn-xs dropdown-toggle" style="margin-left:5px"> Org Structure </button></a>
													<div class="btn-group" style="position:absolute;right:25px;top:1px;">
													
													



													<button data-toggle="dropdown" class="btn  btn-sm dropdown-toggle" style="border-width:0px;width:92px;">
													Sort By

													<span class="icon-caret-down icon-on-right"></span>
												</button>
												
												<ul class="dropdown-menu dropdown-info pull-right">
													<li>
														<a href="javascript:void(0)" rel="dept" class="sortBy">Department</a>
													</li>

													<li>
														<a href="javascript:void(0)" rel="branch" class="sortBy">Branch</a>
													</li>
													
													<li>
														<a href="javascript:void(0)" rel="bus_unit" class="sortBy">Business Unit</a>
													</li>

														<li>
														<a href="javascript:void(0)" rel="normal" class="sortBy"><i>Reset Order</i></a>
													</li>
												
												</ul></div>
													<div  id="memDiv" >	
												<?php echo $this->element('sort_by');?>
															</div>	
																
															</div>
</div></div>
															<!--div class="center">
																

																&nbsp;
																<a href="#">
																	See all members &nbsp;
																	<i class="icon-arrow-down"></i>
																</a>
															</div-->

															<!--div class="hr hr-single hr8"></div-->
														</div><!-- member-tab -->

														
													
												</div><!-- /widget-main -->
											</div><!-- /widget-body -->
										</div><!-- /widget-box -->
									</div><!-- /span -->

								
									</div><!-- /span -->
								</div><!-- /row -->

								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div><!-- /.main-content -->

				
				<div class="ace-settings-container show-tip click_hide" id="ace-settings-container"  rel="tooltip" data-original-title="Themes" data-placement="left"   title="Themes">
					<div class="btn btn-app btn-xs btn-warning ace-settings-btn" id="ace-settings-btn">
						<!--i class="icon-tint bigger-150"></i-->
						<img id="color-img" src="<?php echo $this->webroot;?>img/color5.png">
							</div>

					<div class="ace-settings-box" id="ace-settings-box" style="width:180px">
					

						
					<div style="border-bottom:1px solid #efefef">
							<div class="pull-left">
								<select id="skin-colorpicker" class="hide" style="display:none;">
									<?php if($cookie_color != ''): ?>
									<option value="<?php echo $cookie_color_code;?>" val="<?php echo $cookie_color;?>"><?php echo $cookie_color_code;?></option>
									<?php endif; ?>
									
									<?php if($cookie_color != 'blue'): ?>
									<option value="#438EB9" val="blue">#438EB9</option>
									<?php endif; ?>	
									<?php if($cookie_color != 'green'): ?>
									<option value="#82af6f" val="violet">#82af6f</option>	
									<?php endif; ?>
									
									<?php if($cookie_color != 'pink'): ?>
									<option value="#C6487E" val="pink">#C6487E</option>
									<?php endif; ?>
									
									<?php if($cookie_color != 'violet'): ?>
									<option value="#7e6eb0" val="violet">#7e6eb0</option>	
									<?php endif; ?>	
									
									<?php if($cookie_color != 'yellow'): ?>
									<option value="#ffc657" val="yellow">#ffc657</option>	
									<?php endif; ?>	
									
									<?php if($cookie_color != 'red'): ?>
									<option value="#e2755f" val="red">#e2755f</option>	
									<?php endif; ?>	
									
									<?php if($cookie_color != 'brown'): ?>
									<option value="#AF914B" val="brown">#AF914B</option>	
									<?php endif; ?>	
									
									<?php if($cookie_color != 'rose'): ?>
									<option value="#FF99CD" val="rose">#FF99CD</option>	
									<?php endif; ?>	
									
									<?php if($cookie_color != 'lightgreen'): ?>
									<option value="#D8E575" val="lightgreen">#D8E575</option>	
									<?php endif; ?>	
									
									
										<?php if($cookie_color != 'violets'): ?>
									<option value="#BE5FC4" val="violets">#BE5FC4</option>	
									<?php endif; ?>	
									
									<?php if($cookie_color != 'black'): ?>
									<option value="#222A2D" val="black">#222A2D</option>
									<?php endif; ?>	
									
									<?php if($cookie_color != 'grey'): ?>
									<option value="#D0D0D0" val="grey">#D0D0D0</option>	
									<?php endif; ?>	
								
																		
								
								</select>
								
							</div>
							<span>&nbsp; Skin Color<br><br></span>
							
						</div>
						
						<div>
							
							<label class="lbl" for="ace-settings-navbar"><i>Themes: </i> <a   href="<?php echo $this->webroot;?>img/theme_samples/19.jpg" class="bghelp"><span class="badge click_hide show-tip" title="Tips" >?</span></a></label>
								<a href="<?php echo $this->webroot;?>img/theme_samples/16.jpg" class="bghelp"></a>
								<a href="<?php echo $this->webroot;?>img/theme_samples/17.jpg"  class="bghelp"></a>
								<a href="<?php echo $this->webroot;?>img/theme_samples/18.jpg"  class="bghelp"></a>
								<a href="<?php echo $this->webroot;?>img/theme_samples/11.jpg" class="bghelp"></a>
								<a href="<?php echo $this->webroot;?>img/theme_samples/12.jpg" class="bghelp" ></a>
								<a href="<?php echo $this->webroot;?>img/theme_samples/13.jpg"   class="bghelp"></a>
								<a href="<?php echo $this->webroot;?>img/theme_samples/14.jpg"  class="bghelp"></a>
								<a href="<?php echo $this->webroot;?>img/theme_samples/15.jpg" class="bghelp"></a>
								


							<div class="scrollable"  data-start ="top" data-height="480" data-visible="true">
							
							
							<div style="margin-top:4px;"><a href="#" class="patterns" rel="bees-brown"><img  width="31" height="31" style="border:1px solid #efefef; padding:2px;"  src="<?php echo $this->webroot;?>img/patterns/bees-s.png"></a> <i>Bees</i></div>
							<div style="margin-top:4px;"><a href="#" class="patterns" rel="sheep-blue"><img width="31" height="31" style="border:1px solid #efefef; padding:2px;"  src="<?php echo $this->webroot;?>img/patterns/sheep-s.png"></a> <i>Sheep</i></div>							
							<div style="margin-top:4px;"><a href="#" class="patterns" rel="pentagon-green"><img width="31" height="31" style="border:1px solid #efefef; padding:2px;"  src="<?php echo $this->webroot;?>img/patterns/pentagon-s.png"></a> <i>Pentagon</i></div>
							<div style="margin-top:4px;"><a href="#" class="patterns" rel="leaves-red"><img width="31" height="31" style="border:1px solid #efefef; padding:2px;"  src="<?php echo $this->webroot;?>img/patterns/leaves-s.png"></a> <i>Leaf</i></div>
							<div style="margin-top:4px;"><a href="#" class="patterns" rel="peace-rose"><img width="31" height="31" style="border:1px solid #efefef; padding:2px;"  src="<?php echo $this->webroot;?>img/patterns/peace-s.png"></a> <i>Peace</i></div>
							<div style="margin-top:4px;"><a href="#" class="patterns" rel="purple_checked-violets"><img width="31" height="31" style="border:1px solid #efefef; padding:2px;"  src="<?php echo $this->webroot;?>img/patterns/purple_check.png"></a> <i>Purple Checked</i></div>
							<div style="margin-top:4px;"><a href="#" class="patterns" rel="checked-yellow"><img width="31" height="31" style="border:1px solid #efefef; padding:2px;"  src="<?php echo $this->webroot;?>img/patterns/checked.png"></a> <i>Blue Checked</i></div>

							<div style="margin-top:4px;"><a href="#" class="patterns" rel="pink_checked-pink"><img width="31" height="31" style="border:1px solid #efefef; padding:2px;"  src="<?php echo $this->webroot;?>img/patterns/pink_check.png"></a> <i>Pink Checked</i></div>

							<div style="margin-top:4px;"><a href="#" class="patterns" rel="green_checked-green"><img width="31" height="31" style="border:1px solid #efefef; padding:2px;"  src="<?php echo $this->webroot;?>img/patterns/green_check.png"></a> <i>Green Checked</i></div>
							<div style="margin-top:4px;"><a href="#" class="patterns" rel="red_checked-red"><img width="31" height="31" style="border:1px solid #efefef; padding:2px;"  src="<?php echo $this->webroot;?>img/patterns/red_check.png"></a> <i>Red Checked</i></div>

							<div style="margin-top:4px;"><a href="#" class="patterns" rel="grey_stripe-black"><img width="31" height="31" style="border:1px solid #efefef; padding:2px;"  src="<?php echo $this->webroot;?>img/patterns/grey_stripe.png"></a> <i>Grey Stripe</i></div>

							<div style="margin-top:4px;"><a href="#" class="patterns" rel="double_stripe-brown"><img width="31" height="31" style="border:1px solid #efefef; padding:2px;"  src="<?php echo $this->webroot;?>img/patterns/double_stripe.png"></a> <i>Double Stripe</i></div>
							<div style="margin-top:4px;"><a href="#" class="patterns" rel="redbg-red"><img width="31" height="31" style="border:1px solid #efefef; padding:2px;"  src="<?php echo $this->webroot;?>img/patterns/red.png"></a> <i>Red Texture</i></div>

							<div style="margin-top:4px;"><a href="#" class="patterns" rel="bluebg-blue"><img width="31" height="31" style="border:1px solid #efefef; padding:2px;"  src="<?php echo $this->webroot;?>img/patterns/blue.png"></a> <i>Blue Texture</i></div>
							<div style="margin-top:4px;"><a href="#" class="patterns" rel="greenbg-green"><img width="31" height="31" style="border:1px solid #efefef; padding:2px;"  src="<?php echo $this->webroot;?>img/patterns/green.png"></a> <i>Green Texture</i></div>
							<div style="margin-top:4px;"><a href="#" class="patterns" rel="violetbg-violets"><img width="31" height="31" style="border:1px solid #efefef; padding:2px;"  src="<?php echo $this->webroot;?>img/patterns/violet.png"></a> <i>Violet Texture</i></div>
							<div style="margin-top:4px;"><a href="#" class="patterns" rel="yellowbg-yellow"><img width="31" height="31" style="border:1px solid #efefef; padding:2px;"  src="<?php echo $this->webroot;?>img/patterns/yellow.png"></a> <i>Yellow Texture</i></div>
							<div style="margin-top:4px;"><a href="#" class="patterns" rel="fabric-black"><img width="31" height="31" style="border:1px solid #efefef; padding:2px;"  src="<?php echo $this->webroot;?>img/patterns/fabric_plaid.png"></a> <i>fabric </i></div>

							<div style="margin-top:4px;"><a href="#" class="patterns" rel="geometry-black"><img width="31" height="31" style="border:1px solid #efefef; padding:2px;"  src="<?php echo $this->webroot;?>img/patterns/geometry-s.png"></a> <i>Geometry</i></div>
							<div style="margin-top:4px;"><a href="#" class="patterns" rel="bird-black"><img width="31" height="31" style="border:1px solid #efefef; padding:2px;"  src="<?php echo $this->webroot;?>img/patterns/foggy_birds-s.png"></a> <i>Bird</i></div>
							<div style="margin-top:4px;"><a href="#" class="patterns" rel="matrix-grey"><img width="31" height="31" style="border:1px solid #efefef; padding:2px;"  src="<?php echo $this->webroot;?>img/patterns/grey-s.png"></a> <i>Matrix</i></div>
							
							
							
							
							
							<div style="margin-top:4px;"><a href="#" class="patterns" rel="none-blue"><img style="border:1px solid #efefef; padding:2px;"  src="<?php echo $this->webroot;?>img/patterns/none.png"></a> <i>None</i></div>
							</div>
						</div>

					
					</div>
				</div>
				
					
					
					<!-- /#ace-settings-container -->
			</div><!-- /.main-container-inner -->

		</div><!-- /.main-container -->
	
		</div>
					<!-- colorbox -->
		
<?php if($this->request->data['refresh'] != 1):?>

		<!--script src="<?php echo $this->webroot;?>js/loading.js" type="text/javascript"></script-->

		<script src="<?php echo $this->webroot;?>js/jquery.min.js"></script>
		
		<script src="<?php echo $this->webroot;?>js/jquery.cookie.js"></script>
		
		<script src="<?php echo $this->webroot;?>js/jquery-ui-1.10.4.custom.min.js"></script>

		<script src="<?php echo $this->webroot;?>js/plugins/colorbox/jquery.colorbox-min.js"></script>



		<script src="<?php echo $this->webroot;?>js/bootstrap.min.js"></script>

		<script src="<?php echo $this->webroot;?>js/jquery-ui-1.10.3.custom.min.js"></script>
		<script src="<?php echo $this->webroot;?>js/jquery.slimscroll.min.js"></script>
		
		
		
			
		

		
		<script src="<?php echo $this->webroot;?>js/ace-elements.min.js"></script>
		<script src="<?php echo $this->webroot;?>js/ace.min.js"></script>
		<script src="<?php echo $this->webroot;?>js/bootbox.min.js"></script>
	<script src="<?php echo $this->webroot;?>js/jquery.autosize.min.js"></script>
	
	<script src="<?php echo $this->webroot;?>js/jquery.easing.1.3.min.js" type="text/javascript"></script>
    <script src="<?php echo $this->webroot;?>js/jquery.touchSwipe.min.js" type="text/javascript"></script>
    <script src="<?php echo $this->webroot;?>js/jquery.imagesloaded.min.js" type="text/javascript"></script>
    <script src="<?php echo $this->webroot;?>js/jquery.scrollTo-1.4.3.1-min.js" type="text/javascript"></script>
	<script src="<?php echo $this->webroot;?>js/spin.min.js" type="text/javascript"></script>
	<script src="<?php echo $this->webroot;?>js/portfolio.min.js"></script>	
	<script src="<?php echo $this->webroot;?>js/application.js"></script>

	<script src="<?php echo $this->webroot;?>js/bootstrap-editable.min.js"></script>
	
	<script src="<?php echo $this->webroot;?>js/cal_home/jquery.eventCalendar.js" type="text/javascript"></script>
	
	<script src="<?php echo $this->webroot;?>js/main.js"></script>



	
		<!-- inline scripts related to this page -->
	
<div id="no_marked_dialog" title="Oops!" class="dn">
	<p>Please mark your in time first!</p>
</div>	
<div id="marked_dialog" title="Oops!" class="dn">
	<p>You have already marked!</p>
</div>		
<div id="att_dialog_confirm" title="Confirm!" class="dn">
	<p>Are you sure?</p>
</div>		

<div id="refreshLoad" class="refreshLoad">Loading...</div>




<div id="footer">
	<div class="wrapper">
    	<span>&copy; Copyright <?php echo date('Y');?>. Career Tree. All rights reserved. Powered by <a href="http://bigspire.com" target="_blank" title="BigSpire Software">BigSpire</a>
		
		<p style="float:right">
	
	
	
	<a href="<?php echo $this->webroot;?>home/feedback/"  rel="tooltip"  title="Any suggestions and ideas" class="iframeBox click_hide" val="40_65">Feedback</a>	|  <a href="<?php echo $this->webroot;?>home/report_issue/" rel="tooltip"  title="Help us to kill bugs" class="iframeBox click_hide" val="40_65">Report Issue</a>

	
	</p>
		
		</span>
    </div>
</div>

<?php echo $this->element('member'); ?>

<?php echo $this->element('holiday'); ?>


<?php else: ?>

<script src="<?php echo $this->webroot;?>js/main.js"></script>
<script src="<?php echo $this->webroot;?>js/ace-elements.min.js"></script>
<script src="<?php echo $this->webroot;?>js/ace.min.js"></script>
<script src="<?php echo $this->webroot;?>js/bootbox.min.js"></script>
<script src="<?php echo $this->webroot;?>js/application.js"></script>
<?php endif; ?>


<?php if($this->request->data['load_tab'] != ''):
 echo '|||'.$this->request->data['load_tab'];
 endif; ?>
 
 
