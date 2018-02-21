{* Purpose : To list change asset request and help desk.
   Created : Nikitasa
   Date : 01-07-2016 *}
   

	<div class="widget-body">
		<div class="widget-main no-padding">
			<div>
				<div class="dialogs scrollable" data-start ="top" data-height="455" data-visible="true">
					<div class="clearfix">	
								<div class="row">
									<div class="col-sm-9" >
										<div style="position:absolute;right:15px;z-index:99999">										
										<a href="fr_add_ticket.php" class="iframeBox" val="42_95"><button class="btn btn-xs btn-info"><i class="icon-plus"></i> Create Ticket
							          </button></a> 
							         </div>
										<div class="tabbable">
											<ul class="nav nav-tabs" id="myTab">
												<li class="active">
													<a data-toggle="tab" href="#hw">
														<i class="green ace-icon fa fa-home bigger-120"></i>
														My Hardware
													</a>
												</li>

												<li>
													<a data-toggle="tab" href="#sw">
														My Software
													</a>
												</li>
								            
								            <li>
													<a data-toggle="tab" href="#car">
														Change Asset Req. <span class="badge badge-danger"><span class="count" val="$asset_count" id="ast_cnt">{if $asset_count > 0}{$asset_count}{/if}</span></span>
													</a>
												</li>
												<li>
													<a data-toggle="tab" href="#tk">
														Help Desk <span class="badge badge-danger"><span class="count" val="$ticket_count" id="tkt_cnt">{if $ticket_count > 0}{$ticket_count}{/if}</span></span>
													</a>
												</li>
											</ul>

											<div class="tab-content"  style="border:1px solid #c5d0dc">
											<div id="car" class="tab-pane fade">
											{if $ALERT_MSG_ASSET}{$ALERT_MSG_ASSET}{else}	
											<table id="dynamic-table" class="table table-striped table-bordered table-hover dataTable no-footer" role="grid" aria-describedby="dynamic-table_info">																					
											<span id="message"  class="dn hide-1">
    											<div id="flashMessage" class="alert alert-success"  style="margin-bottom:10px;">
    												<button  class="close" id="1">×</button>
        												Change asset req deleted successfully.
        										</div>
											</span>											
												<thead>
													<tr role="row">
														<th width="500" class="sorting" tabindex="0" aria-controls="dynamic-table" rowspan="1" colspan="1">Message</th>
														<th  width="150"  class="sorting" tabindex="0" aria-controls="dynamic-table" rowspan="1" colspan="1" >Type</th>
														<th width="150" class="hidden-480 sorting" tabindex="0" aria-controls="dynamic-table" rowspan="1" colspan="1">Created Date</th>
														<th width="150" class="sorting" tabindex="0" aria-controls="dynamic-table" rowspan="1" colspan="1">
															Status
														</th>
														<th width="150">
															Options
														</th>
												</thead>

												<tbody>	
												{foreach from=$data_asset item=item key=key}		
								              {if $item.created_date}
												<tr role="row" class='row-{$item.id}'>
														<td>
															<a href="fr_view_change_asset.php?id={$item.id}" class="iframeBox"  val="40_70">{$item.message}</a>
														</td>
														<td>
														{$item.type}
														</td>
														<td class="hidden-480">{$item.created_date}</td>

														<td class="hidden-480">
															<span class="label label-sm label-{$item.status_cls}">{$item.status}</span>
														</td>
														<td>
															<a href="javascript:void(0)" id='{$item.id}' class='deletedata' val="asset"  rel="tooltip" title="Remove" style=""><button class="btn btn-xs btn-info" val="40_70"><i class="icon-remove"></i></button></a>
														</td>
												</tr>
												 	{/if}
												{/foreach}
												</tbody>
												</table>
												{/if}
											

												</div>
	
												<div id="hw" class="tab-pane fade in active">
												{foreach from=$data_hardware item=item key=key}	
													<div class="profile-user-info">
														<div class="profile-info-row">
															
															<div class="profile-info-name"> Type </div>
															
																<div class="profile-info-value">
															
																	<span><b>{$item.hw_type}</b></span>
																		<a href="fr_asset_change_user.php?type=H" rel="tooltip" title="Request Change" style="float:right;margin-right:150px;" class="iframeBox" val="40_70"><button class="btn btn-xs btn-info" val="40_70"><i class="icon-pencil"></i> Change</button></a>
																	</div>
																</div>

																<div class="profile-info-row">
																	<div class="profile-info-name"> Brand </div>

																	<div class="profile-info-value">
																		<i class="fa fa-map-marker light-orange bigger-110"></i>
																		<span>{$item.brand} &nbsp;</span>
																	</div>
																</div>

																<div class="profile-info-row">
																	<div class="profile-info-name"> Model ID </div>

																	<div class="profile-info-value">
																		<span>{$item.model_id}</span>
																	</div>
																</div>

																<div class="profile-info-row">
																	<div class="profile-info-name"> Serial No. </div>

																	<div class="profile-info-value">
																		<span>{$item.serial_no}</span>
																	</div>
																</div>

																<div class="profile-info-row">
																	<div class="profile-info-name"> Description </div>

																	<div class="profile-info-value">
																		<span>{$item.description}</span>
																	</div>
																	
																</div>
																
															</div>
															<hr>
													{/foreach}
													</div>

												<div id="sw" class="tab-pane fade">
												
												
													{foreach from=$data_software item=item key=key}	
												<div class="profile-user-info">
																<div class="profile-info-row">
															
																	<div class="profile-info-name"> Type </div>
																	<div class="profile-info-value">
																	
																		<span><b>{$item.sw_type}</b></span>
																	<a href="fr_asset_change_user.php?type=S" rel="tooltip" title="Request Change" style="float:right;margin-right:150px" class="iframeBox" val="40_70"><button class="btn btn-xs btn-info" val="40_70"><i class="icon-pencil"></i> Change
							</button></a>
																	</div>
																</div>

																<div class="profile-info-row">
																	<div class="profile-info-name"> Brand </div>

																	<div class="profile-info-value">
																		<i class="fa fa-map-marker light-orange bigger-110"></i>
																		<span>{$item.brand}</span>
																	</div>
																</div>

																<div class="profile-info-row">
																	<div class="profile-info-name"> Edition </div>

																	<div class="profile-info-value">
																		<span>{$item.edition}</span>
																	</div>
																</div>

																<div class="profile-info-row">
																	<div class="profile-info-name"> Description </div>

																	<div class="profile-info-value">
																		<span>{$item.description}</span>
																	</div>
																</div>
												       
															</div>
															<hr>
										 {/foreach}
												
												</div>

												<div id="tk" class="tab-pane fade">
												{if $ALERT_MSG_TICKET}{$ALERT_MSG_TICKET}{else}
												<table id="dynamic-table" class="table table-striped table-bordered table-hover dataTable no-footer" role="grid" aria-describedby="dynamic-table_info">												
												<span id="message1" class="dn hide-2">
   												<div id="flashMessage" class="alert alert-success"  style="margin-bottom:10px;">
    													<button  class="close" id="2">×</button>
        													Ticket deleted successfully.
   												</div>
												</span>										
												<thead>
													<tr role="row">
														<th width="500" class="sorting" tabindex="0" aria-controls="dynamic-table" rowspan="1" colspan="1">Subject</th>
														<th  width="150"  class="sorting" tabindex="0" aria-controls="dynamic-table" rowspan="1" colspan="1" >Priority</th>
														<th width="150" class="hidden-480 sorting" tabindex="0" aria-controls="dynamic-table" rowspan="1" colspan="1">Created Date</th>
														<th width="150" class="sorting" tabindex="0" aria-controls="dynamic-table" rowspan="1" colspan="1">
															Status
														</th>
														<th width="150">
															Options
														</th>
												</thead>

												<tbody>
												{foreach from=$data_ticket item=item key=key}		
								              {if $item.priority}
												<tr role="row" class='row-{$item.id}'>
														<td>
															<a href="fr_view_ticket.php?id={$item.id}" class="iframeBox"  val="40_70">{$item.subject}</a>
														</td>
														<td>
														{$item.priority}
														</td>
														<td class="hidden-480">{$item.created_date}</td>

														<td class="hidden-480">
															<span class="label label-sm label-{$item.status_cls}">{$item.status}</span>
														</td>
														<td>						
														 <a href="javascript:void(0)" id='{$item.id}' class='deletedata' val="ticket" rel="tooltip" title="Remove" style="" ><button class="btn btn-xs btn-info" val="40_70"><i class="icon-remove"></i></button></a>
														</td>
												</tr>
													{/if}
												{/foreach}
												</tbody>
											  </table>
												{/if}
												</div>

												
											</div>
										
									
									
									</div><!-- /.col -->
								</div>	
												
												
												</div></div></div>

												
										</div>			
													
													
												</div>
															
															
														</div>
											
								</div>
								
								
								<div id="gal-tab" class="tab-pane">
	<div class="widget-body">
												<div class="widget-main no-padding">
													<div >
													<div class="dialogs scrollable" data-start ="top" data-height="455" data-visible="true">
													<div class="clearfix">
													
<div class="ajaxCont-photos">		
	
		
</div>
	
												</div></div></div>

												
													
													
													
												</div>
															
															
														</div>
											
								</div>
								
								
								
									<!--div id="poll-tab" class="tab-pane">
	<div class="widget-body">
												
													<div class="clearfix">
													

											<div class="ajaxCont-voice">
																						</div>

												
													
													
													
												</div>
															
															
														</div>
											
								</div-->
								
								
								
								
								
								
								
								
									<div id="news-tab" class="tab-pane">
	<div class="widget-body">
												<div class="widget-main no-padding">
													<div>
													<div class="scrollable" data-start ="top" data-height="425" data-visible="true">
													<div class="clearfix">
													

											<div class="ajaxCont-latestU">							
																						</div>
											
												</div></div></div>

												
													
													
													
												</div>
															
															
														</div>
											
								</div>
								
								<div id="updates-tab" class="tab-pane">
	<div class="widget-body">
												<div class="widget-main no-padding">
													<div>
													<div class="scrollable" data-start ="top" data-height="425" data-visible="true">
													<div class="clearfix">
													

											<div class="ajaxCont-latestupdate">							
											</div>
											
												</div></div></div>

												
													
													
													
												</div>
															
															
														</div>
											
								</div>
								
														
								<div id="profile-tab" class="tab-pane">
											<div class="ajaxCont-profile">				
																						</div>
											
								</div>
								
								
														
														
														<div id="member-tab" class="tab-pane">
																<div >
													<div class="scrollable" data-start ="top" data-height="425" data-visible="true">
															<div class="clearfix">
														
													<a style="position:absolute;right:25px;top:105px;" href="/home/career_levels/" rel="tooltip"  title="" class="iframeBox" val="90_90">
													<button class="btn-success btn  btn-xs dropdown-toggle" style="margin-left:5px"> Career Levels </button></a>
													
													<a style="position:absolute;right:25px;top:55px;" href="/home/org_chart/" rel="tooltip"  title="" class="iframeBox" val="99_98">
													<button class="btn-danger btn  btn-xs dropdown-toggle" style="margin-left:5px"> Org Structure </button></a>
													
													
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
												<div class="ajaxCont-officeEmp">		
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

										
						
												