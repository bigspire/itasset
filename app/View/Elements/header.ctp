
	
	<div class="navbar navbar-default navbar-fixed-top" id="navbar"  style="border-bottom:1px solid #efefef">



			<div class="navbar-container" id="navbar-container">
				<div class="navbar-header pull-left">
					<a href="<?php echo $this->webroot;?>home/" class="navbar-brand">
						<small>
							<i class="icon-sun"></i>
							My PDCA
						</small>
					</a><!-- /.brand -->
				</div><!-- /.navbar-header -->

				
					
				<div class="navbar-header pull-right" role="navigation">
					<ul class="nav ace-nav">
					
					<li></li>
					
					<?php if($notify_survey):?>
					<li class="purple">
							<a data-toggle="dropdown" id="" rel="tooltip" data-original-title="Survey" class="dropdown-toggle show-tip click_hide iframeBox" val="50_90" href="<?php echo $this->webroot;?>home/show_survey/"  data-placement="bottom"   title="Survey">
								<i style="font-size:18px" class="icon-ok"></i>
								<span class="badge badge-yellow in_time"><?php echo $notify_survey;?></span>
								
							</a>
							
						</li>
					<?php endif; ?>
					
						<?php if($notify_voice):?>
					<li class="purple">
							<a data-toggle="dropdown" id="" rel="tooltip" data-original-title="Voice" class="dropdown-toggle show-tip click_hide iframeBox" val="50_90" href="<?php echo $this->webroot;?>home/show_voice/"  data-placement="bottom"   title="Voice">
								<i style="font-size:18px" class="icon-smile"></i>
								<span class="badge badge-yellow in_time"><?php echo $notify_voice;?></span>
								
							</a>
							
						</li>
					<?php endif; ?>
					
					<li class="purple">
						<a data-toggle="dropdown"  class="cursor dropdown-toggle show-tip click_hide"  href="javascript:void(0)"  data-placement="bottom" >
								<i class="icon-time"></i>  <span class="site_clock"> <?php echo date('h:i a'); ?> </span>
								
							</a>
					</li>
					
					
					
					<li class="purple">
						
					
						
						
							<a data-toggle="dropdown"  class="dropdown-toggle show-tip click_hide"  href="javascript:void(0)"  data-placement="bottom"   title="Other Links">
								<i class="icon-external-link" style="margin-top:15px;"></i>
								
							</a>

							<ul class="pull-left dropdown-navbar navbar-pink dropdown-menu dropdown-caret dropdown-close">
								<li class="dropdown-header">
										Other Links
								</li>

									<li>
									<a href="<?php echo Configure::read('FLR_LOGIN');?>" target="_blank" style="color:rgb(85, 85, 85);">
									<div class="clearfix">
											<span class="pull-left">												
											CT Hiring
											</span>
									</div>
									</a>
									
									
								</li>
								<li><a href="http://career-tree.in" target="_blank" style="color:rgb(85, 85, 85);">
									<div class="clearfix">
											<span class="pull-left">												
											CareerTree
											</span>
									</div>
									</a></li>
							</ul>
						</li>
						<!--li class="purple">
						
					
						
						
							<a data-toggle="dropdown"  class="dropdown-toggle show-tip click_hide" data-original-title="Notification" href="javascript:void(0)"  data-placement="bottom"   title="Company Info">
								<i class="icon-building"></i>
								
							</a>

							<ul class="pull-left dropdown-navbar navbar-pink dropdown-menu dropdown-caret dropdown-close">
								<li class="dropdown-header">
										Company Info.
								</li>

						<?php foreach($org_data  as $key =>  $org):?>		
									<li>
									<a style="color:rgb(85, 85, 85);" target href="<?php echo $this->webroot;?>home/company/<?php echo $org['HrOrg']['title'];?>/">
									<div class="clearfix">
											<span class="pull-left">												
											<?php echo $org['HrOrg']['title'];?>
											</span>
									</div>
									</a>
								</li>
						<?php endforeach; ?>
							</ul>
						</li-->

						
					<?php if($this->request->params['action'] != 'company'): ?>
					
					<li class="purple">
	<a  target="_blank"  class="dropdown-toggle show-tip click_hide" data-placement="bottom"  href="<?php echo $this->Functions->get_mail_url();?>"  title="Go to Mail">
								<i class="icon-envelope"></i>  	
								<?php //if($this->Session->read('mail.new_mail') > 0): ?>
								<!--span class="badge badge-important"><?php echo $this->Session->read('mail.new_mail'); ?></span-->
							     <?php //endif; ?>
										
							</a>
	 
							
						</li>
						
						
					
						
						
						<li class="purple">
							<a data-toggle="dropdown" id="refreshPage" rel="tooltip" data-original-title="Refresh" class="dropdown-toggle show-tip click_hide" href="javascript:void(0)"  data-placement="bottom"   title="Refresh">
								<i class="icon-refresh"></i>
								
							</a>
	<?php echo $this->Form->input('refresh_page', array('id' => 'refresh_page', 'type' => 'hidden', 'value' => '0')); echo $this->Form->input('auto_load', array('id' => 'auto_load', 'type' => 'hidden', 'value' => '0'));
 echo $this->Form->input('loadTab', array('id' => 'loadTab', 'type' => 'hidden', 'value' => $this->request->data['load_tab']));	?> 
							
						 </li>

						
						
					
<li>
						
							
			<?php 
			if($NO_ATTENDANCE != '1' && $this->Session->read('USER.Login.att_type') != 'B' && $this->Session->read('USER.Login.att_type') != ''):?>
			
				<span id="att_timer">
				<?php 				 
				 if(strtotime(date('H:i')) > strtotime($office_time) && empty($att_data[0]['HrAttendance']['in_time']) && $today_permission == '1'):?>				 
				 <button  id="att_reason"  data-rows="2" data-type="textarea" data-pk="<?php echo $today_permission;?>" data-url="<?php echo $this->webroot;?>home/att_reason/" data-title="Exceeded permission time. Reason for late"  class="btn btnIn btn-time btn-sm <?php echo $this->Functions->check_cursor($att_data[0]['HrAttendance']['in_time']);?>"  rel="in<?php echo $att_data[0]['HrAttendance']['in_time'];?>" style="padding:6px 12px;margin:0px 10px 0 10px;">In Time: 
				<span  id="in_time"><?php echo $this->Functions->format_attime($att_data[0]['HrAttendance']['in_time']);?></span><?php if(empty($att_data[0]['HrAttendance']['in_time'])):?>
							<span class="badge badge-danger in_time" >?</span>
							<?php endif; ?>
							</button>
			
					<?php
				
				elseif(strtotime(date('H:i')) > strtotime($office_time) && empty($att_data[0]['HrAttendance']['in_time'])):?>				 
				 <button  id="att_reason"  data-rows="2" data-type="textarea" data-pk="<?php echo $today_permission;?>" data-url="<?php echo $this->webroot;?>home/att_reason/" data-title="Reason for late"  class="btn btnIn btn-time btn-sm <?php echo $this->Functions->check_cursor($att_data[0]['HrAttendance']['in_time']);?>"  rel="in<?php echo $att_data[0]['HrAttendance']['in_time'];?>" style="padding:6px 12px;margin:0px 10px 0 10px;">In Time: 
				<span  id="in_time"><?php echo $this->Functions->format_attime($att_data[0]['HrAttendance']['in_time']);?></span><?php if(empty($att_data[0]['HrAttendance']['in_time'])):?>
							<span class="badge badge-danger in_time" >?</span>
							<?php endif; ?>
							</button>			
				<?php
				
				elseif(strtotime(date('H:i')) < strtotime('08:00') && empty($att_data[0]['HrAttendance']['in_time'])):?>				 
				  <button  id="att_reason"  data-rows="2" data-type="textarea" data-pk="" data-url="<?php echo $this->webroot;?>home/att_reason/" data-title="Reason for so early"  class="btn btnIn btn-time btn-sm <?php echo $this->Functions->check_cursor($att_data[0]['HrAttendance']['in_time']);?>"  rel="in<?php echo $att_data[0]['HrAttendance']['in_time'];?>" style="padding:6px 12px;margin:0px 10px 0 10px;">In Time: 
				<span  id="in_time"><?php echo $this->Functions->format_attime($att_data[0]['HrAttendance']['in_time']);?></span><?php if(empty($att_data[0]['HrAttendance']['in_time'])):?>
							<span class="badge badge-danger in_time" >?</span>
							<?php endif; ?>
							</button>
				<?php else:?>				
					<button class="btn btn-time btn_in btn-sm mark-time tooltip-success relin <?php echo $this->Functions->check_cursor($att_data[0]['HrAttendance']['in_time']);?>" data-rel="timepopover" data-placement="bottom"  data-content="You have successfully marked your in time" data-original-title="Thanks"  rel="in<?php echo $att_data[0]['HrAttendance']['in_time'];?>" style="padding:6px 12px;margin:0px 10px 0 10px;">In Time: 
				<span  id="in_time"><?php echo $this->Functions->format_attime($att_data[0]['HrAttendance']['in_time']);?></span>
							
							<?php if(empty($att_data[0]['HrAttendance']['in_time'])):?>
							<span class="badge badge-danger in_time" >?</span>
							<?php endif; ?>
							</button>
					
				 <?php endif; ?>
					
					<?php 
					 if(empty($att_data[0]['HrAttendance']['in_time'])):?>
					 <button  title="Oops!" data-placement="bottom" data-content="You didn't mark your in time" class="tooltip-error popover btn btnOut btn-time btn-sm <?php echo $this->Functions->check_cursor($att_data[0]['HrAttendance']['out_time']);?>"  rel="preview" style="padding:6px 12px;margin-right:10px;cursor:default">Out Time: 
					<span  id="out_time"><?php echo $this->Functions->format_attime($att_data[0]['HrAttendance']['out_time']);?></span><?php if(empty($att_data[0]['HrAttendance']['out_time'])):?>
							<span class="badge badge-danger out_time" >?</span>
							<?php endif; ?>
							</button>
							
				 <?php elseif(strtotime(date('H:i')) < strtotime($office_out_per_time) && empty($att_data[0]['HrAttendance']['out_time']) && $out_permission == '1'): ?>
					 <button  id="out_att_reason"  data-rows="2" data-type="textarea" data-out = "1" data-pk="outPerm-<?php echo $out_permission;?>-E" data-url="<?php echo $this->webroot;?>home/att_reason/" data-title="Reason for early"  class="btn btnOut btn-time btn-sm <?php echo $this->Functions->check_cursor($att_data[0]['HrAttendance']['out_time']);?>"  rel="out<?php echo $att_data[0]['HrAttendance']['out_time'];?>" style="padding:6px 12px;margin-right:10px;">Out Time: 
				<span  id="out_time"><?php echo $this->Functions->format_attime($att_data[0]['HrAttendance']['out_time']);?></span><?php if(empty($att_data[0]['HrAttendance']['out_time'])):?>
							<span class="badge badge-danger out_time" >?</span>
							<?php endif; ?>
							</button>
							
				<?php elseif(strtotime(date('H:i')) >= strtotime($office_out_correct_time) && strtotime(date('H:i')) <= strtotime($office_out_time)&&  empty($att_data[0]['HrAttendance']['out_time'])): ?>
					<button class="btn btn-time relout btn_in btn-sm mark-time tooltip-success <?php echo $this->Functions->check_cursor($att_data[0]['HrAttendance']['out_time']);?>" data-rel="timepopover" data-placement="bottom"  data-content="You have successfully marked your out time" data-original-title="Thanks"  rel="out<?php echo $att_data[0]['HrAttendance']['out_time'];?>" style="padding:6px 12px;margin-right:10px;">Out Time:
					<span id="out_time"><?php echo $this->Functions->format_attime($att_data[0]['HrAttendance']['out_time']);?></span>
					
					<?php if(empty($att_data[0]['HrAttendance']['out_time'])):?>
					<span class="badge badge-danger out_time">?</span>
					<?php endif; ?>
					</button>
					
				
							
				
				<?php elseif(strtotime(date('H:i')) < strtotime($office_out_time) &&  empty($att_data[0]['HrAttendance']['out_time'])):?>
					 <button  id="out_att_reason"  data-rows="2" data-type="textarea" data-out = "1" data-pk="outPerm-<?php echo $out_permission;?>-E" data-url="<?php echo $this->webroot;?>home/att_reason/" data-title="Reason for early"  class="btn btnOut btn-time btn-sm <?php echo $this->Functions->check_cursor($att_data[0]['HrAttendance']['out_time']);?>"  rel="out<?php echo $att_data[0]['HrAttendance']['out_time'];?>" style="padding:6px 12px;margin-right:10px;">Out Time: 
				<span  id="out_time"><?php echo $this->Functions->format_attime($att_data[0]['HrAttendance']['out_time']);?></span><?php if(empty($att_data[0]['HrAttendance']['out_time'])):?>
							<span class="badge badge-danger out_time" >?</span>
							<?php endif; ?>
							</button>
					
								
				<?php // if(strtotime(date('H:i')) > strtotime($office_out_time) &&  empty($att_data[0]['HrAttendance']['out_time']))
				else:?>
				
					 <button  id="out_att_reason<?php echo $att_data[0]['HrAttendance']['out_time'];?>"  data-rows="2" data-type="textarea" data-out = "1" data-pk="outPerm-<?php echo $out_permission;?>-L" data-url="<?php echo $this->webroot;?>home/att_reason/" data-title="Reason for late"  class="btn btnOut btn-time btn-sm <?php echo $this->Functions->check_cursor($att_data[0]['HrAttendance']['out_time']);?>"  rel="out<?php echo $att_data[0]['HrAttendance']['out_time'];?>" style="padding:6px 12px;margin-right:10px;">Out Time: 
				<span  id="out_time"><?php echo $this->Functions->format_attime($att_data[0]['HrAttendance']['out_time']);?></span><?php if(empty($att_data[0]['HrAttendance']['out_time'])):?>
							<span class="badge badge-danger out_time" >?</span>
							<?php endif; ?>
							</button>	
						
			<?php endif;?>
			</span>
			
			
			<?php endif; ?>		
					
					
					<input type="hidden" id="update_time" value="<?php echo $this->webroot;?>home/mark_attendance/"/>
					
					</li>
					
					
						<li class="purple">
							<a data-toggle="dropdown"  class="dropdown-toggle show-tip click_hide" data-original-title="Notification" href="javascript:void(0)"  data-placement="bottom"   title="Notification / Switch Module">
								<i class="icon-bell-alt icon-animated-bell"></i>
								<?php //if($TOT_COUNT > 0):?>
								<span class="badge badge-important tot_count"><?php echo $TOT_COUNT; ?></span>
								<?php //endif; ?>
							</a>

							<ul class="pull-right dropdown-navbar navbar-pink dropdown-menu dropdown-caret dropdown-close">
								<li class="dropdown-header">
										<?php //if($TOT_COUNT > 0):?>
										<i class="icon-warning-sign"></i>
									<span class="tot_count"><?php echo $TOT_COUNT; ?></span> Notifications
									<?php //endif; ?>
								</li>
								
									<li>
									<a href="<?php echo $this->webroot;?>tskhome/" class="">
										<div class="clearfix">	<span class="pull-left">
										<i class="btn btn-xs icon-check btn-info"></i>
										Work Planner</span>
										<?php //if($TSK_COUNT > 0):?>
											<span class="pull-right badge badge-warning" id="tsk_count"><?php echo $TSK_COUNT; ?></span>
										<?php //endif; ?>
										</div>
									</a>
									
								</li>
								
								
								<li>
									<a href="<?php echo $this->webroot;?>hrhome/" >
										<div class="clearfix">
											<span class="pull-left">
												<i class="btn btn-xs no-hover btn-success icon-user"></i>
												HRIS
											</span>
											<?php //if($HR_COUNT > 0):?>
											<span class="pull-right badge badge-success" id="hr_count"><?php echo $HR_COUNT; ?></span>
											<?php //endif; ?>
										
										</div>
									</a>
								</li>

								<li>
									<a href="<?php echo $this->webroot;?>finhome/" style="color:rgb(85, 85, 85);">
										<div class="clearfix">
											<span class="pull-left">
												<i class="btn btn-xs no-hover btn-purple icon-money"></i>
												Finance
											</span>
											<?php //if($FIN_COUNT > 0):?>
											<span class="pull-right badge badge-info" id="fin_count"><?php echo $FIN_COUNT; ?></span>
											<?php //endif; ?>
										</div>
									</a>
								</li>

								<li>
									<a href="<?php echo $this->webroot;?>tvlhome/" style="color:rgb(85, 85, 85);">
										<div class="clearfix">
											<span class="pull-left">
												<i class="btn btn-xs no-hover btn-warning icon-plane"></i>
												Biz Tour
											</span>
											<?php //if($FIN_COUNT > 0):?>
											<span class="pull-right badge badge-purple" id="tour_count"><?php echo $TOUR_COUNT; ?></span>
											<?php //endif; ?>
										</div>
									</a>
								</li>
								<?php if($bd_business_menu):?>
								<li>
									<a href="<?php echo $this->webroot;?>bdhome/?type=N" title="Business Development" style="color:rgb(85, 85, 85);">
										<div class="clearfix">
											<span class="pull-left">
												<i class="btn btn-xs no-hover btn-danger icon-lightbulb"></i>
												BD
											</span>
											<?php if($BD_COUNT > 0):?>
											<span class="pull-right badge badge-red" id="bd_menu_count"><?php echo $BD_COUNT; ?></span>
											<?php endif; ?>
										</div>
									</a>
								</li>
								<?php endif; ?>
								
								<?php 
								if($this->Session->read('USER.Login.app_roles_id') == '21'):?>
								<li>
									<a href="<?php echo $this->webroot;?>it/" style="color:rgb(85, 85, 85);">
										<div class="clearfix">
											<span class="pull-left">
												<i class="btn btn-xs no-hover btn-warning icon-laptop"></i>
												IT
											</span>
											<?php if($IT_COUNT > 0):?>
											<span class="pull-right badge badge-purple" id="it_count"><?php // echo $TOUR_COUNT; ?></span>
											<?php endif; ?>
										</div>
									</a>
								</li>
								<?php endif; ?>
								
									<!--li>
									<a href="<?php echo $this->webroot;?>ithome/" title="IT Assets" style="color:rgb(85, 85, 85);">
										<div class="clearfix">
											<span class="pull-left">
												<i class="btn btn-xs no-hover btn-pink icon-laptop"></i>
												IT
											</span>
											<?php //if($FIN_COUNT > 0):?>
											<span class="pull-right badge badge-purple" id="bd_count"><?php //echo $TOUR_COUNT; ?></span>
											<?php //endif; ?>
										</div>
									</a>
								</li-->

	<!--li>
									<a href="<?php echo Configure::read('FLR_LOGIN');?>" target="_blank" style="color:rgb(85, 85, 85);">
										<div class="clearfix">
											<span class="pull-left">
												<i class="btn btn-xs no-hover btn-pink icon-search"></i>
												FLR Portal
											</span>
											
										</div>
									</a>
								</li-->
							
							</ul>
						</li>

						
						<?php endif; ?>
<li class="light-blue">
							<a data-toggle="dropdown"  data-placement="bottom"   title="Messages" class="show-tip click_hide dropdown-toggle" href="#">
								<i class="ace-icon fa icon-comments icon-animated-vertical" style="font-size:20px;"></i>
								<?php if($count_message > 0):?><span class="badge badge-yellow">
								<?php echo $count_message; ?></span> <?php endif; ?>
								
							</a>


<ul class="pull-right dropdown-navbar navbar-pink dropdown-menu dropdown-caret dropdown-close" style="max-height:300px;width:250px;overflow:auto">
							<li class="dropdown-header">
										
										<i class="icon-warning-sign"></i>
									<span class=""><?php echo $count_message; ?></span> <?php if($count_message > 1): echo 'Messages'; else: echo 'Message'; endif; ?>
									
								</li>
								<?php foreach($message_data as $message):?>
					<li>
											<a href="<?php echo $this->webroot;?>home/show_message/<?php echo $message['HrMessage']['id'];?>/" class="staticColorBox clearfix"  style="color:#555;font-size:12px;text-align:left;">
												<span class="msg-body" style="max-width:none;">
													<span class="msg-title">
														<?php echo $this->Functions->string_truncate($message['HrMessage']['desc'], 60);?>
													</span>

													<span class="msg-time">
														<i class="ace-icon fa fa-clock-o"></i>
														<!--span>20 minutes ago</span-->
													</span>
												</span>
											</a>
										</li>
										
			
								<?php endforeach; ?>	
										
											

									
									</ul>
								</li>

								
						
						<li class="light-blue">
						

							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
							
					<?php if($this->Session->read('USER.Login.photo')!= ''):?>
							<img class="nav-user-photo" src="<?php echo $this->webroot;?>timthumb.php?src=uploads/photo/<?php echo $this->Session->read('USER.Login.photo');?>&h=40&q=100"/>	
							<?php elseif($this->Session->read('USER.Login.gender') == 'M'): ?>
						<img class="nav-user-photo" src="<?php echo $this->webroot;?>img/profile_male_s.jpg" height="45" alt=""/>
							<?php else: ?>
							<img class="nav-user-photo" src="<?php echo $this->webroot;?>img/profile_female_s.jpg" height="45" alt=""/>
							<?php endif; ?>
							
								
								<span class="user-info">
									<small>Welcome,</small>
									<?php echo ucfirst($this->Session->read('USER.Login.first_name')); ?>
								</span>

								<i class="icon-caret-down"></i>
							</a>

							<ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
								<!--li>
									<a href="#" class="comingSoon">
										<i class="icon-cog"></i>
										Settings
									</a>
								</li-->


								<li class="divider"></li>

								<li>
									<a href="<?php echo $this->webroot;?>logins/logout/">
										<i class="icon-off"></i>
										Logout
									</a>
								</li>
								
							</ul>
						</li>
						<li style="background:#ffffff;"  class="purple">
								<img style="margin:0px 5px" title="A product of career tree" src="<?php echo $this->webroot;?>img/career-tree-logo-small.png"/>
						</li>
						
					</ul><!-- /.ace-nav -->
				</div><!-- /.navbar-header -->
			</div><!-- /.container -->
		</div>

	<input type="hidden" value="<?php echo $this->webroot;?>" id="site_root"/>	
		<input type="hidden" value="<?php echo $NO_ATTENDANCE;?>" id="no_att"/>	
		<input type="hidden" value="<?php echo $this->Session->read('USER.Login.notify_user');?>" id="notify_user"/>

