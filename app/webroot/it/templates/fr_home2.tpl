{* Purpose : To list and search assign asset.
   Created : Nikitasa
   Date : 01-07-2016 *}
   
<!DOCTYPE html>
<html lang="en">
<head>

	<link rel="icon" type="image/x-icon" href="/favicon.ico">

		
		<!-- basic styles -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="css/font-awesome.min.css">		
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300">
	<link rel="stylesheet" media="screen" href="css/plugins/jquery-ui/smoothness/jquery-ui.css">
		
	<!-- colorbox -->
	<link rel="stylesheet" href="css/plugins/colorbox/colorbox.css">
	<!-- ace styles -->
	<link rel="stylesheet" href="css/ace.min.css">
	<link rel="stylesheet" href="css/ace-rtl.min.css">
	<link rel="stylesheet" href="css/ace-skins.min.css">		
	<link rel="stylesheet" href="css/jqueryui-editable.css">
	
	<!-- Core CSS File. The CSS code needed to make eventCalendar works -->
	<link rel="stylesheet" href="css/calhome/eventCalendar.css">
	<!-- Theme CSS file: it makes eventCalendar nicer -->
	<link rel="stylesheet" href="css/calhome/eventCalendar_theme_responsive.css">
	
	<link rel="stylesheet" href="css/jquery.bxslider.css">
{literal} 
	<style type="textcss">
	.ui-dialog .ui-dialog-titlebar{background:#438EB9; color:#ffffff;padding:.4em 1em}
	.ui-dialog .ui-dialog-titlebar-close{color:#fff}
	</style>
	{/literal} 

		

			
	<!-- themes -->
	<link rel="stylesheet" href="css/themes/blue.css">

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />	<title>
	 			
		Home   			 (2)
			   - My PDCA
			</title>




</head>
<!-- scrollHide-->
<body  class=" navbar-fixed theme-blue" data-theme="theme-blue">

	<!--div id="loading-image" class="loading dn"><span>Loading... Please wait... <img src="img/loading.gif"/></span></div-->
	
<div class="ajax_loading dn" id="busy-indicator" style="display:none"><span>Loading... Please wait... <img src="img/loading.gif"/></span></div>
	
	

	<div id="ajaxLoadDiv">
		
		
	
	<div class="navbar navbar-default navbar-fixed-top" id="navbar"  style="border-bottom:1px solid #efefef">



			<div class="navbar-container" id="navbar-container">
				<div class="navbar-header pull-left">
					<a href="/home/" class="navbar-brand">
						<small>
							<i class="icon-sun"></i>
							My PDCA
						</small>
					</a><!-- /.brand -->
				</div><!-- /.navbar-header -->

				
					
				<div class="navbar-header pull-right" role="navigation">
					<ul class="nav ace-nav">
					
					<li></li>
					
										
											
					<li class="purple">
						<a data-toggle="dropdown"  class="cursor dropdown-toggle show-tip click_hide"  href="javascript:void(0)"  data-placement="bottom" >
								<i class="icon-time"></i>  <span class="site_clock"> 03:33 pm </span>
								
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
									<a href="http://ct-hiring.in" target="_blank" style="color:rgb(85, 85, 85);">
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

													</ul>
						</li-->

						
										
					<li class="purple">
	<a  target="_blank"  class="dropdown-toggle show-tip click_hide" data-placement="bottom"  href="http://mail.career-tree.in"  title="Go to Mail">
								<i class="icon-envelope"></i>  	
																<!--span class="badge badge-important"></span-->
							     										
							</a>
	 
							
						</li>
						
						
					
						
						
						<li class="purple">
							<a data-toggle="dropdown" id="refreshPage" rel="tooltip" data-original-title="Refresh" class="dropdown-toggle show-tip click_hide" href="javascript:void(0)"  data-placement="bottom"   title="Refresh">
								<i class="icon-refresh"></i>
								
							</a>
	<input type="hidden" name="data[refresh_page]" id="refresh_page" value="0"/><input type="hidden" name="data[auto_load]" id="auto_load" value="0"/><input type="hidden" name="data[loadTab]" id="loadTab"/> 
							
						 </li>

						
						
					
<li>
						
							
					
					
					
					<input type="hidden" id="update_time" value="/home/mark_attendance/"/>
					
					</li>
					
					
						<li class="purple">
							<a data-toggle="dropdown"  class="dropdown-toggle show-tip click_hide" data-original-title="Notification" href="javascript:void(0)"  data-placement="bottom"   title="Notification / Switch Module">
								<i class="icon-bell-alt icon-animated-bell"></i>
																<span class="badge badge-important tot_count">2</span>
															</a>

							<ul class="pull-right dropdown-navbar navbar-pink dropdown-menu dropdown-caret dropdown-close">
								<li class="dropdown-header">
																				<i class="icon-warning-sign"></i>
									<span class="tot_count">2</span> Notifications
																	</li>
								
									<li>
									<a href="/tskhome/" class="">
										<div class="clearfix">	<span class="pull-left">
										<i class="btn btn-xs icon-check btn-info"></i>
										Work Planner</span>
																					<span class="pull-right badge badge-warning" id="tsk_count"></span>
																				</div>
									</a>
									
								</li>
								
								
								<li>
									<a href="/hrhome/" >
										<div class="clearfix">
											<span class="pull-left">
												<i class="btn btn-xs no-hover btn-success icon-user"></i>
												HRIS
											</span>
																						<span class="pull-right badge badge-success" id="hr_count">1</span>
																					
										</div>
									</a>
								</li>

								<li>
									<a href="/finhome/" style="color:rgb(85, 85, 85);">
										<div class="clearfix">
											<span class="pull-left">
												<i class="btn btn-xs no-hover btn-purple icon-money"></i>
												Finance
											</span>
																						<span class="pull-right badge badge-info" id="fin_count"></span>
																					</div>
									</a>
								</li>

								<li>
									<a href="/tvlhome/" style="color:rgb(85, 85, 85);">
										<div class="clearfix">
											<span class="pull-left">
												<i class="btn btn-xs no-hover btn-warning icon-plane"></i>
												Biz Tour
											</span>
																						<span class="pull-right badge badge-purple" id="tour_count"></span>
																					</div>
									</a>
								</li>
																<li>
									<a href="/bdhome/?type=N" title="Business Development" style="color:rgb(85, 85, 85);">
										<div class="clearfix">
											<span class="pull-left">
												<i class="btn btn-xs no-hover btn-danger icon-lightbulb"></i>
												BD
											</span>
																						<span class="pull-right badge badge-red" id="bd_menu_count">1</span>
																					</div>
									</a>
								</li>
																
									<!--li>
									<a href="/ithome/" title="IT Assets" style="color:rgb(85, 85, 85);">
										<div class="clearfix">
											<span class="pull-left">
												<i class="btn btn-xs no-hover btn-pink icon-laptop"></i>
												IT
											</span>
																						<span class="pull-right badge badge-purple" id="bd_count"></span>
																					</div>
									</a>
								</li-->

	<!--li>
									<a href="http://ct-hiring.in" target="_blank" style="color:rgb(85, 85, 85);">
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

						
						<li class="light-blue">
							<a data-toggle="dropdown"  data-placement="bottom"   title="Messages" class="show-tip click_hide dropdown-toggle" href="#">
								<i class="ace-icon fa icon-comments icon-animated-vertical" style="font-size:20px;"></i>
																
							</a>


<ul class="pull-right dropdown-navbar navbar-pink dropdown-menu dropdown-caret dropdown-close" style="max-height:300px;width:250px;overflow:auto">
							<li class="dropdown-header">
										
										<i class="icon-warning-sign"></i>
									<span class="">0</span> Message									
								</li>
									
										
											

									
									</ul>
								</li>

								
						
						<li class="light-blue">
						

							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
							
														
								
								<span class="user-info">
									<small>Welcome,</small>
									Ravichandran								</span>

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
									<a href="/logins/logout/">
										<i class="icon-off"></i>
										Logout
									</a>
								</li>
								
							</ul>
						</li>
						<li style="background:#ffffff;"  class="purple">
								<img style="margin:0px 5px" title="A product of career tree" src="img/career-tree-logo-small.png"/>
						</li>
						
					</ul><!-- /.ace-nav -->
				</div><!-- /.navbar-header -->
			</div><!-- /.container -->
		</div>

	<input type="hidden" value="/" id="site_root"/>	
		<input type="hidden" value="" id="no_att"/>	
		<input type="hidden" value="1" id="notify_user"/>

		
		<div class="main-container" id="main-container">
			
			
						

			<div class="main-container-inner">
				<a class="menu-toggler" id="menu-toggler" href="#">
					<span class="menu-text"></span>
				</a>

				

				<div class="main-content">
					<div class="breadcrumbs" id="breadcrumbs">
					{literal} 
						<script type="text/javascript">
							try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
						</script>
					{/literal} 
						<ul class="breadcrumb">
							<li>
								<i class="icon-home home-icon"></i>
								<a href="/home/">Home</a>
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
															<a data-toggle="tab" class="listlink ajaxTab" id="plan" rel="tabbed_call-taskP"  val="task_cal" href="#plan-tab">My Plan</a>
														</li>
														
														<li class="dashList">
															<a data-toggle="tab" class="listlink ajaxTab" id="att" rel="tabbed_call-attendance"  val="attendance" href="#att-tab">Attendance
															</a>
														</li>
														
															<li class="dashList">
															<a data-toggle="tab" class="listlink ajaxTab"  rel="tabbed_call-roa"
															title="Round of Applause" val="roa" id="roa" href="#roa-tab">Applause
															
															<span class="badge badge-warning radius5 roaCount dn"></span>
												
																														
												</a>
															
															
														</li>
														
														
															<li class="dashList">
															<a data-toggle="tab" class="listlink ajaxTab"  rel="tabbed_call-todoP" val="todo" id="task" href="#task-tab">To do
															</a>
														</li>
														
															<li class="dashList">
															<a data-toggle="tab" class="listlink ajaxTab"  rel="tabbed_call-assignP" val="assign" id="assign" href="#assign-tab">Assigned Tasks
																														<span class="badge badge-warning radius5">2</span>
															</a>
														</li>
														
														<!--li class="dashList">
															<a data-toggle="tab" class="listlink ajaxTab" rel="tabbed_call-eventP" id="event" val="event" href="#event-tab">Events
															</a>
														</li-->
														
														<li class="dashList">
															<a data-toggle="tab" class="listlink ajaxTab" id="latUpdate"  rel="tabbed_call-latestupdate" val="news" href="#updates-tab">Latest Updates
																														</a>
														</li>
														
														<li class="dashList">
															<a  data-toggle="tab" class="listlink ajaxTab" rel="tabbed_call-interact" val="share" id="chat" href="#chat-tab">Greetings 
															<span class="badge badge-warning radius5 intCount dn"></span>
															
															</a>
														</li>
														
															<li class="dashList">
															<a data-toggle="tab" class="listlink ajaxTab" id="news"  rel="tabbed_call-latestU" val="news" href="#news-tab">Knowledge Centre
																														</a>
														</li>	
														
															<!--li class="dashList">
															<a data-toggle="tab" class="listlink ajaxTab" rel="tabbed_call-voice " val="voice"  id="poll" href="#poll-tab">Voice
															</a>
														</li-->
														
										<li  class="dashList">
															<a data-toggle="tab" class="listlink ajaxTab" id="profile" val="profile" rel="tabbed_call-profile" href="#profile-tab">Profile</a>
														</li>
													
														
														
													

													
														
														<li class="dashList">
															<a data-toggle="tab" class="listlink ajaxTab" val="sort_by" rel="tabbed_call-officeEmp"  id="member" href="#member-tab">CTians</a>
														</li>
														
													

															
														
																												<li class="dashList">
															<a data-toggle="tab" class="listlink ajaxTab" val="form" rel="tabbed_call-files"  id="form" href="#form-tab">Office Docs
															</a>
														</li>
																												
														<li class="dashList">
															<a data-toggle="tab" class="listlink ajaxTab" val="gallery" rel="tabbed_call-photos"  id="gal" href="#gal-tab">Gallery
															</a>
														</li>
														<li class="dashList">
															<a data-toggle="tab" class="listlink ajaxTab" val="gallery" rel="tabbed_call-it"  id="ita" href="#it-tab">IT 
															</a>
														</li>
													</ul>
												</div>
											</div>
<input type="hidden" id="webroot" value="/"/>
<input type="hidden" id="attendance">
<input type="hidden" id="taskP"  value="1">
<input type="hidden" id="todoP">
<input type="hidden" id="assignP">
<input type="hidden" id="eventP">
<input type="hidden" id="interact" value="1">
<input type="hidden" id="latestU">
<input type="hidden" id="voice">
<input type="hidden" id="profile">
<input type="hidden" id="officeEmp">
<input type="hidden" id="files">
<input type="hidden" id="photos">
<input type="hidden" id="latestupdate">
<input type="hidden" id="ajaxTabLoad">

											<div class="widget-body">
												<div class="widget-main padding-4" style="background:#fff">
													<div class="tab-content padding-8 overflow-visible">
													
														
														<div id="task-tab" class="tab-pane">
															
	<div>
													<div class="scrollable" data-start ="top" data-height="310" data-visible="true">
													<div class="clearfix">
															
															
															
															<div class="ajaxCont-todoP">			
																														</div>
															
															
													</div>		
															
														</div>
														
</div>
	<form action="/home/" method="post" id="formID" onsubmit="return false" class="" accept-charset="utf-8"><div style="display:none;"><input type="hidden" name="_method" value="POST"/></div>

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
														<input type="hidden" id="todo_url" value="/home/store_todo/"/>
															<input type="hidden" id="update_todo_url" value="/home/update_todo/"/>
															<input type="hidden" id="save_todo_url" value="/home/save_todo/"/>
															<input type="hidden" id="delete_todo_url" value="/home/delete_todo/"/>
															<input type="hidden" id="flag_todo_url" value="/home/flag_todo/"/>
															<input type="hidden" id="update_ses_url" value="/home/update_welcome_msg/"/>
	<input type="hidden" id="todo_sort_url" value="/home/sort_todo/"/>

													</form>													</div>	
													
		<div id="assign-tab" class="tab-pane">
															
	<div>
													<div class="scrollable" data-start ="top" data-height="450" data-visible="true">
													<div class="clearfix">
															
																
															<div class="ajaxCont-assignP">			
															
															</div>
															
															
													</div>		
															
														</div>
														
</div>


														
														
													</div>	
													
<!-- always load in top to avoid ajax js error -->										
										<div id="chat-tab" class="tab-pane">
															

														<div class="widget-body">
												<div class="widget-main no-padding ">
													<div class="slimScrollDiv" id="shareScroll">
													<div class="">
													<div class="clearfix">
													<div id="share_results" class="shareData">
													<div class="ajaxCont-interact">		
													<div id="share_loading" class="dn">Loading data.. Pls wait..  <img src="img/loading.gif"></div>														
														
													</div>
                                                    </div>													

														
													</div></div></div>

														<form action="/home/" method="post" id="formID" onsubmit="return false" class="" enctype="multipart/form-data" accept-charset="utf-8"><div style="display:none;"><input type="hidden" name="_method" value="POST"/></div>			<div class="form-actions" style="border-bottom:1px solid #e5e5e5;">
															
															
					
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
														<a id="interact_url" href="/home/share_user/" class="iframeBox" val="36_60">Let me select</a>
													</li>
												</ul>
												
												<div  data-original-title="Attach File" data-placement="top"   title="Attach File" class="fileUpload btn btn-info btn-xs  show-tip click_hide">
													<span class="icon-picture"></span>
													<input type="file" name="data[Share][upload_file]"  class="upload" id="uploadShareFile"/>												</div>
												
												<button  class="btn no-radius btn-xs btn-info refShare"><span class="icon-refresh"></span> Refresh</button>
												
												
											</div>
											
												<input type="hidden" name="data[Share][webroot_share]" id="webroot_share" value="/home/share_user/"/><input type="hidden" name="data[Share][hdnId]" id="hdnId"/>											
											<input type="hidden" id="ref_share">
											<input type="hidden" id="ref_roa">
															</div>
														</div>
														
			
				
															
														
	
													<input type="hidden" id="share_url" value="/home/store_share/"/>
														<input type="hidden" id="share_reply_url" value="/home/reply_share/"/>
															<input type="hidden" id="update_share_url" value="/home/update_share/"/>
															
								
										
													</form>												</div>
															
															
														</div>
														
														
									
									
									
													</div>
									
	<div id="roa-tab" class="tab-pane">
															

														<div class="widget-body">
												<div class="widget-main no-padding ">
													<div class="slimScrollDiv" id="roa_shareScroll">
													<div class="">
													<div class="clearfix">
													<div class="btn-group" style="position:fixed;right:45px;margin:10px 20px 0px 0px;z-index:9999">
				<!--a href="#"><button name="" class="btn no-radius btn-xs  btnID btn-warning"><span class="icon-file"></span> ROA Policy</button>
				</a-->

</div>
													<div id="roa_share_results" class="roa_shareData">
													<div class="ajaxCont-interact">		
													<div id="roa_share_loading" class="dn">Loading data.. Pls wait..  <img src="img/loading.gif"></div>														
														
													</div>
                                                    </div>													

														
													</div></div></div>

														<form action="/home/" method="post" id="formID" onsubmit="return false" class="" enctype="multipart/form-data" accept-charset="utf-8"><div style="display:none;"><input type="hidden" name="_method" value="POST"/></div>			<div class="form-actions" style="border-bottom:1px solid #e5e5e5;">
															
															
					
				<div class="input-group" style="width:100%">													
														
		<textarea placeholder="Enter the message here ..."  autocomplete="off" type="text" class="form-control autosize-transition roaTxtBx postShare roa_er" id="shareTxtBx" name="message" style="height:32px"></textarea>
															
														
<div style="float:left;margin-top:10px;">
<span id="roa_file_name"></span>
		<span><a href="javascript:void(0)"  id="roa_file_remove" class="dn">Remove</a></span>
		<span style="color:#ff0000" class="dn file_share_error"></span>	
</div>	


											
<div class="btn-group" style="float:right;margin-top:10px;">


												
												
												<button name="roa_greeting" class="btn no-radius btn-xs  btnID btn-info shareBtn"><span class="icon-share-alt"></span> Send (<span class="no_users">All</span> Users)</button>
												
												
												<button data-original-title="Options" data-placement="top"   title="Options" data-toggle="dropdown" class="btn-info btn btn-xs dropdown-toggle btndrop show-tip click_hide">
													<span class="icon-caret-down icon-only"></span>
												</button>
																							

												<ul class="dropdown-menu dropdown-success">
													<li>
														<a id="all_user" href="javascript:void(0)">All Users</a>
													</li>
													<li>
														<a id="interact_url" href="/home/share_user/" class="iframeBox" val="36_60">Let me select</a>
													</li>
												</ul>
												
												<div  data-original-title="Attach File" data-placement="top"   title="Attach File" class="fileUpload btn btn-info btn-xs  show-tip click_hide">
													<span class="icon-picture"></span>
													<input type="file" name="data[Share][upload_file]"  class="upload" id="uploadRoaFile"/>												</div>
												
												<button  class="btn no-radius btn-xs btn-info refShare" rel="roa"><span class="icon-refresh"></span> Refresh</button>
												
												
											</div>
											
												<input type="hidden" name="data[Share][webroot_share]" id="webroot_share" value="/home/share_user/"/><input type="hidden" name="data[Share][hdnId]" id="hdnId"/>											
											<input type="hidden" id="roa_roa">
															</div>
														</div>
														
			
				
															
														
														
													<input type="hidden" id="share_url" value="/home/store_share/"/>
														<input type="hidden" id="share_reply_url" value="/home/reply_share/"/>
															<input type="hidden" id="update_share_url" value="/home/update_share/"/>
															
										<input type="hidden"  id="total_group">
											<input type="hidden" id="roa_total_group">
								
										
													</form>												</div>
															
															
														</div>
														
														
									
									
									
													</div>
											
																			
											
	<div id="plan-tab" class="tab-pane active">
	<div class="ajaxCont-taskP">
	{literal} 														
	<style>
#HomeCalendarDefault{float:left !important;width:58% !important;margin-left:10px;border-right:1px solid #E8E8E8; border-radius:0px;}
.eventCalendar-wrap{border:none;box-shadow:none;width:58% !important;}
.eventsCalendar-monthWrap{width:42% !important;}
.eventsCalendar-list-wrap{position: absolute;left: 47%;top: 5px;width:400px !important;}
.eventsCalendar-list-content{width:400px;}
.eventsCalendar-list-content.scrollables{width:368px}
.monthTitle{cursor:default;color:#000 !important}
.eventCalendar-wrap .arrow span{border:none !important}
.widget-header{border:1px solid #efefef;}
.tsk_title{color:#4C4848}
.loadChart{margin-left:20px !important;float:left;}
</style>
{/literal} 
{literal} 
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
google.load("visualization", "1", {packages:["corechart"],"callback": drawChart});
google.setOnLoadCallback(drawChart);

function drawChart() {

  var data = google.visualization.arrayToDataTable([
    ['Date', 'Planned', 'Unplanned', 'Not Planned'],
	    ['Jun-26',  0,  0,    8]
	,    ['Jun-27',  0,  0,    8]
	,    ['Jun-28',  0,  0,    8]
	,    ['Jun-29',  0,  0,    8]
	,    ['Jun-30',  0,  0,    8]
	  ]);


   var options = {
    title: 'Daily Planning Report',fontSize:13,titleTextStyle:{color:'#EF4B23'},
    hAxis: {title: 'Date',textStyle: {  fontSize: '11',color:'#4C4848'},  titleTextStyle: {color: '#969393',fontSize:12}},
	vAxis: {title: 'Task Hours', textStyle: {  fontSize: '11',color:'#4C4848'},  format: '#\' hr\'',  titleTextStyle: {color: '#969393',fontSize:12}},
	isStacked: true,
	colors: ['#18D315', '#FCD96F','#D9DBD9'],
	legend: { position: 'right',  textStyle: {fontSize: 11} },
	pointSize: 5,
	chartArea: {width: '60%'}
  };
  
  
  var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));

  chart.draw(data, options);

}
	   google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart2);
      function drawChart2() {
        var data = google.visualization.arrayToDataTable([
          ['Employee Name', '# of new business'],
          ['Planned Hrs',  0],
          ['Unplanned Hrs',  0],
          
        ]);

      var options = {
        legend: {position: 'bottom',textStyle: {fontSize: 11}},
		is3D: true,
        title: 'FTM, Jun - 2016',fontSize:13,titleTextStyle:{color:'#EF4B23'},
		colors: ['#18D315', '#FCD96F','#D9DBD9']
      };
		var my_div = document.getElementById('chart_div2');
        var chart = new google.visualization.PieChart(document.getElementById('chart_div2'));		
        chart.draw(data, options);
      }
	  
	   google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart3);
      function drawChart3() {
        var data = google.visualization.arrayToDataTable([
          ['Employee Name', '# of new business'],
          ['Planned Hrs',  0],
          ['Unplanned Hrs',  0],
          
        ]);

      var options = {
        legend: {position: 'bottom', textStyle: {fontSize: 11}},
		is3D: true,
		colors: ['#18D315', '#FCD96F','#D9DBD9'],
        title: 'FTY, 2016',fontSize:13,titleTextStyle:{color:'#EF4B23'},
      };
		var my_div = document.getElementById('chart_div3');
        var chart = new google.visualization.PieChart(document.getElementById('chart_div3'));		
        chart.draw(data, options);
      }
    </script>
{/literal} 

 <div class="widget-box">
											<div class="widget-header widget-header-flat widget-header-small">
												<h5 class="widget-title">
													<i class="ace-icon fa fa-signal"></i>
													Tasks Overview
													
						<a style="float:right;margin-right:80px;" href="/home/task_report/" class="iframeBox" val="85_80"><span class="label label-pink arrowed-right"><i class="icon-bar-chart"></i> Task Report</span></a>
						<a style="float:right;margin-right:30px;" href="/home/fin_report/" class="iframeBox" val="45_45"><span class="label label-grey arrowed-right" title="Finance Report"><i class="icon-money"></i> Fin. Report</span></a>
						<a style="float:right;margin-right:30px;" href="/home/tabbed_call/voice/voice/" class="iframeBox" val="45_55"><span class="label label-success arrowed-right" title="Poll"><i class="icon-thumbs-up-alt"></i> Voice <span></span></span></a>
						<a style="float:right;margin-right:30px;" href="/home/tabbed_call/eventP/event/" class="iframeBox" val="85_85"><span class="label label-warning arrowed-right" title="My Events"><i class="icon-time"></i> Events <span></span></span></a>

												</h5>

												
											</div>

											<div class="widget-body" style="border-left:1px solid #efefef;border-right:1px solid #efefef;">
												<div class="widget-main"  style="height:370px;">
							<div id="HomeCalendarDefault" class="homeCal" style="width:58%;height:350px;"></div>
<!--div class="loadChart">Loading chart.. Pls wait.. <img src="img/loading.gif"/></span></div-->						
						<div id="chart_div" style="margin-left:10px;float:left;width:35%;height: 168px;"></div>
						
						<div id="chart_div2" style="margin-left:15px;float:left;width:17.5%;height: 168px;margin-top:10px;border-right:1px solid #efefef;"></div>
						<div id="chart_div3" style="margin-left:10px;float:left;width:17.5%;height: 168px;margin-top:10px;"></div>						
						
												
												</div><!-- /.widget-main -->
											</div><!-- /.widget-body -->
										
										
										</div>
										
	





	
	</div>

	</div>	
													
													
	<div id="att-tab" class="tab-pane">
	<div class="widget-body">
												<div class="widget-main no-padding dashScroll">
													<div class="scrollable" data-start ="top" data-height="415" data-visible="true">
													<div >
													<div class="clearfix">
			
													
			
											<div class="ajaxCont-attendance">
																						</div>
											
								
												
												</div></div>

										</div>	

										
													
													
													
												</div>
															
															
														</div>
														
			<table style="margin-top:15px;font-size:smaller;color:#545454;border:1px solid #efefef;font-weight:bold;"><tbody><tr><td class="legendColorBox"><div style="border:1px solid null;padding:1px"><div style="width:4px;height:0;border:5px solid #8F9293;overflow:hidden"></div></div></td><td class="legendLabel">Pending</td><td class="legendColorBox"><div style="border:1px solid null;padding:1px"><div style="width:4px;height:0;border:5px solid #51BC5B;overflow:hidden"></div></div></td><td class="legendLabel">Approved</td><td class="legendColorBox"><div style="border:1px solid null;padding:1px"><div style="width:4px;height:0;border:5px solid #FC7A5D;overflow:hidden"></div></div></td><td class="legendLabel">Rejected (LOP)</td></tr></tbody></table>	
											
								</div>
								
																	<div id="form-tab" class="tab-pane">
	<div class="widget-body">
												<div class="widget-main no-padding">
													<div class="scrollable" style="padding-bottom:50px" data-height="400" data-start ="top"  data-visible="true">
													<div class="clearfix">
													

											<div class="ajaxCont-files">						
																						</div>
											
												</div></div>

												
													
													
													
												</div>
															
															
														</div>
											
								</div>
								
								
								
								
									<!--div id="event-tab" class="tab-pane">
	<div class="widget-body">
												<div class="widget-main no-padding">
													<div class="scrollable" data-height="350" data-start ="top"  data-visible="true">
													<div>
													
													
													<div class="clearfix">
													

											<div class="ajaxCont-eventP">						
																						</div>
											
												</div></div></div>
						  													
													
													
												</div>
															
															
														</div>
											
								</div-->
								
								{include file='fr_it_home2.tpl'}
								
								<!-- /widget-main -->
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
						<img id="color-img" src="img/color5.png">
							</div>

					<div class="ace-settings-box" id="ace-settings-box" style="width:300px">
					

						
					<div style="border-bottom:1px solid #efefef">
							<div class="pull-left">
								<select id="skin-colorpicker" class="hide" style="display:none;">
																		<option value="#438EB9" val="blue">#438EB9</option>
																		
										
																		<option value="#82af6f" val="violet">#82af6f</option>	
																		
																		<option value="#C6487E" val="pink">#C6487E</option>
																		
																		<option value="#7e6eb0" val="violet">#7e6eb0</option>	
										
									
																		<option value="#ffc657" val="yellow">#ffc657</option>	
										
									
																		<option value="#e2755f" val="red">#e2755f</option>	
										
									
																		<option value="#AF914B" val="brown">#AF914B</option>	
										
									
																		<option value="#FF99CD" val="rose">#FF99CD</option>	
										
									
																		<option value="#D8E575" val="lightgreen">#D8E575</option>	
										
									
									
																			<option value="#BE5FC4" val="violets">#BE5FC4</option>	
										
									
																		<option value="#222A2D" val="black">#222A2D</option>
										
									
																		<option value="#D0D0D0" val="grey">#D0D0D0</option>	
										
								
																		
								
								</select>
								
							</div>
							<h4>&nbsp; Skin Color</h4>
							
						</div>
						
						<div>
							
							<label class="lbl" for="ace-settings-navbar"><i>Themes: </i> <a   href="img/theme_samples/19.jpg" class="bghelp"><span class="badge click_hide show-tip" title="Tips" >?</span></a></label>
								<a href="img/theme_samples/16.jpg" class="bghelp"></a>
								<a href="img/theme_samples/17.jpg"  class="bghelp"></a>
								<a href="img/theme_samples/18.jpg"  class="bghelp"></a>
								<a href="img/theme_samples/11.jpg" class="bghelp"></a>
								<a href="img/theme_samples/12.jpg" class="bghelp" ></a>
								<a href="img/theme_samples/13.jpg"   class="bghelp"></a>
								<a href="img/theme_samples/14.jpg"  class="bghelp"></a>
								<a href="img/theme_samples/15.jpg" class="bghelp"></a>
								


							<div class="scrollable"  data-start ="top" data-height="480" data-visible="true">
							
							
							<div class="themeBox"><a href="#" class="patterns" rel="bees-brown"><img  width="31" height="31" style="border:1px solid #efefef; padding:2px;"  src="img/patterns/bees-s.png"></a> <i>Bees</i></div>
							<div  class="themeBox"><a href="#" class="patterns" rel="sheep-blue"><img width="31" height="31" style="border:1px solid #efefef; padding:2px;"  src="img/patterns/sheep-s.png"></a> <i>Sheep</i></div>							
							<div  class="themeBox"><a href="#" class="patterns" rel="pentagon-green"><img width="31" height="31" style="border:1px solid #efefef; padding:2px;"  src="img/patterns/pentagon-s.png"></a> <i>Pentagon</i></div>
							<div  class="themeBox"><a href="#" class="patterns" rel="leaves-red"><img width="31" height="31" style="border:1px solid #efefef; padding:2px;"  src="img/patterns/leaves-s.png"></a> <i>Leaf</i></div>
							<div  class="themeBox"><a href="#" class="patterns" rel="peace-rose"><img width="31" height="31" style="border:1px solid #efefef; padding:2px;"  src="img/patterns/peace-s.png"></a> <i>Peace</i></div>
							<div  class="themeBox"><a href="#" class="patterns" rel="purple_checked-violets"><img width="31" height="31" style="border:1px solid #efefef; padding:2px;"  src="img/patterns/purple_check.png"></a> <i>Purple Checked</i></div>
							<div  class="themeBox"><a href="#" class="patterns" rel="checked-yellow"><img width="31" height="31" style="border:1px solid #efefef; padding:2px;"  src="img/patterns/checked.png"></a> <i>Blue Checked</i></div>

							<div  class="themeBox"><a href="#" class="patterns" rel="pink_checked-pink"><img width="31" height="31" style="border:1px solid #efefef; padding:2px;"  src="img/patterns/pink_check.png"></a> <i>Pink Checked</i></div>

							<div  class="themeBox"><a href="#" class="patterns" rel="green_checked-green"><img width="31" height="31" style="border:1px solid #efefef; padding:2px;"  src="img/patterns/green_check.png"></a> <i>Green Checked</i></div>
							<div  class="themeBox"><a href="#" class="patterns" rel="red_checked-red"><img width="31" height="31" style="border:1px solid #efefef; padding:2px;"  src="img/patterns/red_check.png"></a> <i>Red Checked</i></div>

							<div  class="themeBox"><a href="#" class="patterns" rel="grey_stripe-black"><img width="31" height="31" style="border:1px solid #efefef; padding:2px;"  src="img/patterns/grey_stripe.png"></a> <i>Grey Stripe</i></div>

							<div  class="themeBox"><a href="#" class="patterns" rel="double_stripe-brown"><img width="31" height="31" style="border:1px solid #efefef; padding:2px;"  src="img/patterns/double_stripe.png"></a> <i>Double Stripe</i></div>
							<div  class="themeBox"><a href="#" class="patterns" rel="redbg-red"><img width="31" height="31" style="border:1px solid #efefef; padding:2px;"  src="img/patterns/red.png"></a> <i>Red Texture</i></div>

							<div  class="themeBox"><a href="#" class="patterns" rel="bluebg-blue"><img width="31" height="31" style="border:1px solid #efefef; padding:2px;"  src="img/patterns/blue.png"></a> <i>Blue Texture</i></div>
							<div  class="themeBox"><a href="#" class="patterns" rel="greenbg-green"><img width="31" height="31" style="border:1px solid #efefef; padding:2px;"  src="img/patterns/green.png"></a> <i>Green Texture</i></div>
							<div  class="themeBox"><a href="#" class="patterns" rel="violetbg-violets"><img width="31" height="31" style="border:1px solid #efefef; padding:2px;"  src="img/patterns/violet.png"></a> <i>Violet Texture</i></div>
							<div  class="themeBox"><a href="#" class="patterns" rel="yellowbg-yellow"><img width="31" height="31" style="border:1px solid #efefef; padding:2px;"  src="img/patterns/yellow.png"></a> <i>Yellow Texture</i></div>
							<div  class="themeBox"><a href="#" class="patterns" rel="fabric-black"><img width="31" height="31" style="border:1px solid #efefef; padding:2px;"  src="img/patterns/fabric_plaid.png"></a> <i>fabric </i></div>

							<div  class="themeBox"><a href="#" class="patterns" rel="geometry-black"><img width="31" height="31" style="border:1px solid #efefef; padding:2px;"  src="img/patterns/geometry-s.png"></a> <i>Geometry</i></div>
							<div  class="themeBox"><a href="#" class="patterns" rel="bird-black"><img width="31" height="31" style="border:1px solid #efefef; padding:2px;"  src="img/patterns/foggy_birds-s.png"></a> <i>Bird</i></div>
							<div  class="themeBox"><a href="#" class="patterns" rel="matrix-grey"><img width="31" height="31" style="border:1px solid #efefef; padding:2px;"  src="img/patterns/grey-s.png"></a> <i>Matrix</i></div>
							
							
							
							
							
							<div  class="themeBox"><a href="#" class="patterns" rel="none-blue"><img style="border:1px solid #efefef; padding:2px;"  src="img/patterns/none.png"></a> <i>None</i></div>
							</div>
						</div>

					
					</div>
				</div>
				
					
					
					<!-- /#ace-settings-container -->
			</div><!-- /.main-container-inner -->

		</div><!-- /.main-container -->
	
		</div>
					<!-- colorbox -->
		

		<!--script src="js/loading.js" type="text/javascript"></script-->

		<script src="js/jquery.min.js"></script>
		
		<script src="js/jquery.cookie.js"></script>
		
		<script src="js/jquery-ui-1.10.4.custom.min.js"></script>

		<script src="js/plugins/colorbox/jquery.colorbox-min.js"></script>



		<script src="js/bootstrap.min.js"></script>

		<script src="js/jquery-ui-1.10.3.custom.min.js"></script>
		<script src="js/jquery.slimscroll.min.js"></script>
		
		

		<script src="js/ace-extra.min.js"></script>
		
		<script src="js/ace-elements.min.js"></script>
		<script src="js/ace.min.js"></script>
		<script src="js/bootbox.min.js"></script>
	<script src="js/jquery.autosize.min.js"></script>
	
	<!--script src="js/jquery.easing.1.3.min.js" type="text/javascript"></script>
    <script src="js/jquery.touchSwipe.min.js" type="text/javascript"></script>
    <script src="js/jquery.imagesloaded.min.js" type="text/javascript"></script>
	<script src="js/spin.min.js" type="text/javascript"></script>
	<script src="js/portfolio.min.js"></script-->	
	<script src="js/application.js"></script>
    <script src="js/jquery.scrollTo-1.4.3.1-min.js" type="text/javascript"></script>

	<script src="js/bootstrap-editable.min.js"></script>
	
	<script src="js/cal_home/jquery.eventCalendar.js" type="text/javascript"></script>
	<script src="js/jquery.bxslider.min.js"></script>

	
	<script src="js/main.js"></script>



	
		<!-- inline scripts related to this page -->
	
<div id="no_marked_dialog" title="Oops!" class="dn">
	<p class="alertMsg">Please mark your in time first!</p>
</div>	
<div id="marked_dialog" title="Oops!" class="dn">
	<p class="alertMsg">You have already marked!</p>
</div>		
<div id="att_dialog_confirm" title="Confirm!" class="dn">
	<p class="alertMsg">Are you sure?</p>
</div>	

<div id="no_plan_dialog" title="Oops!" class="dn">
	<p class="alertMsg">Please create and update your today's tasks before mark out time.</p>
</div>		
<div id="less_plan_dialog" title="Oops!" class="dn">
	<p class="alertMsg">You have not properly planned your today's tasks (should be min. 80%). Please create correctly before mark out time.</p>
</div>	

<div id="no_plan_in_dialog" title="Oops!" class="dn">
	<p class="alertMsg">Please create and update your today's tasks before mark in time.</p>
</div>		
<div id="less_plan_in_dialog" title="Oops!" class="dn">
	<p class="alertMsg">You have not properly planned your today's tasks (should be min. 3 hrs). Please create correctly before mark in time.</p>
</div>	


<div id="pending_plan_dialog" title="Oops!" class="dn">
	<p class="alertMsg">You have not fully updated your today's tasks. Please update all before mark out time.</p>
</div>

<div id="no_attendance_dialog" title="Oops!" class="dn">
	<p class="alertMsg">You have not marked your yesterday's attendance (<span class="forgot_date"></span>). Please resolve it by creating <a class="alertLink" href="/hrattchange/change_attendance/" title="Create Attendance Change">Att. change</a> or  <a class="alertLink" href="/hrleave/create_leave/" title="Create Leave Request">Leave request</a> to mark your in time.</p>
</div>
<div id="refreshLoad" class="refreshLoad">Loading...</div>




<div id="footer">
	<div class="wrapper">
    	<span>&copy; Copyright 2016. Career Tree. All rights reserved. Powered by <a href="http://bigspire.com" target="_blank" title="BigSpire Software">BigSpire</a>
		
		<p style="float:right">
	
	
	
	<a href="/home/feedback/"  rel="tooltip"  title="Any suggestions and ideas" class="iframeBox click_hide" val="40_65">Feedback</a>	|  <a href="/home/report_issue/" rel="tooltip"  title="Help us to kill bugs" class="iframeBox click_hide" val="40_65">Report Issue</a>

	
	</p>
		
		</span>
    </div>
	
</div>





<input type="hidden" value="1" id="notifyHome">



		
	
	
	
			
	
<input type="hidden" value="/" id="css_root">
</body>
</html>
