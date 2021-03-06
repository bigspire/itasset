{* Purpose : To list change asset request and help desk.
   Created : Nikitasa
   Date : 01-07-2016 *}
{include file='include/header.tpl'}

		<!-- basic styles -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="css/font-awesome.min.css">		
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300">
		
	<!-- colorbox -->
<link rel="stylesheet" href="css/plugins/colorbox/colorbox.css">
	<!-- ace styles -->
	<link rel="stylesheet" href="css/ace.min.css">
	
	<link rel="stylesheet" href="css/ace-rtl.min.css">
	<link rel="stylesheet" href="css/ace-skins.min.css">
	<!-- themes -->
	<link rel="stylesheet" href="css/themes/blue.css">
	
   
	<div class="widget-body">
	
	
		<input type="hidden" id="fr_home" value="">	
	
	
		<div class="widget-main no-padding">
			<div>
				<div class="dialogs scrollable" data-start ="top" data-height="465" data-visible="true">
					<div class="clearfix">	
								<div class="row">
									<div class="col-sm-9" >
										<div style="position:absolute;right:15px;z-index:99999">										
										<a href="fr_add_ticket.php" class="iframeBox" val="55_95"><button class="btn btn-xs btn-info"><i class="icon-plus"></i> Create Ticket
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
														Change Asset Req. <span class="badge badge-danger"><span class="count"  id="ast_cnt">{if $asset_count > 0}{$asset_count}{/if}</span></span>
													</a>
												</li>
												<li>
													<a data-toggle="tab" href="#tk">
														Help Desk <span class="badge badge-danger"><span class="count" id="tkt_cnt">{if $ticket_count > 0}{$ticket_count}{/if}</span></span>
													</a>
												</li>
											</ul>

		<div class="tab-content"  style="border:1px solid #c5d0dc">
											<div id="car" class="tab-pane fade">
											{if $ALERT_MSG_ASSET}
											<div id="flashMessage" class="alert alert-info"  style="margin-bottom:10px;">											
											{$ALERT_MSG_ASSET}	
											</div>
											{else}
											<table id="dynamic-table" class="table table-striped table-hover dataTable no-footer" role="grid" aria-describedby="dynamic-table_info">																					
											<div id="message"  class="dn hide-1">
    											<div id="flashMessage" class="alert alert-success"  style="margin-bottom:10px;">
    												<button  type="button" data-dismiss="alert" class="close" style="margin-right:15px;" id="1">×</button>
        												Change asset req deleted successfully.
        										</div>
        											
											</div>											
												<thead>
													<tr role="row">
														<th width="500"  tabindex="0" aria-controls="dynamic-table" rowspan="1" colspan="1">Message</th>
														<th  width="150"  tabindex="0" aria-controls="dynamic-table" rowspan="1" colspan="1" >Type</th>
														<th width="150"  tabindex="0" aria-controls="dynamic-table" rowspan="1" colspan="1">Created Date</th>
														<th width="150" style="text-align:center" tabindex="0" aria-controls="dynamic-table" rowspan="1" colspan="1">
															Status
														</th>
														<th width="150">
															Options
														</th>
														</tr>
												</thead>

												<tbody>	
												{foreach from=$data_asset item=item key=key}		
								              {if $item.created_date}
												<tr role="row" class='row-{$item.id}'>
														<td>
															<a href="fr_view_change_asset.php?id={$item.id}&asset_type={$item.type_status}" class="iframeBox"  val="55_95">{ucfirst($item.message)}</a>
														</td>
														<td>
														{ucfirst($item.type)}
														</td>
														<td class="hidden-480">{$item.created_date}</td>

														 <td style="text-align:center">
														 <span class='label label-{$item.status_cls}'>
														 {$item.status}</span>
														 </td>
								
														<td>
															<a href="javascript:void(0)" id='{$item.id}' class='deletedata' val="asset"  rel="tooltip" title="Remove" style=""><button class="btn btn-xs btn-info" val="55_95"><i class="icon-remove"></i></button></a>
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
												{assign var="hardware_type" value="1"}
													<div class="profile-user-info">
														<div class="profile-info-row">
															
															<div class="profile-info-name"> Type </div>
															
																<div class="profile-info-value">
															
																	<span><b>{ucfirst($item.hw_type)}</b></span>
																		<a href="fr_asset_change_user.php?id={$item.inv_id}&type=H" rel="tooltip" title="Request Change" style="float:right;margin-right:150px;" class="iframeBox" val="55_95"><button class="btn btn-xs btn-info" val="55_95"><i class="icon-pencil"></i> Change</button></a>
																	</div>
																</div>

																<div class="profile-info-row">
																	<div class="profile-info-name"> Brand </div>

																	<div class="profile-info-value">
																		<i class="fa fa-map-marker light-orange bigger-110"></i>
																		<span>{ucfirst($item.brand)} &nbsp;</span>
																	</div>
																</div>

																<div class="profile-info-row">
																	<div class="profile-info-name"> Inventory No </div>

																	<div class="profile-info-value">
																		<span>{ucfirst($item.inventory_no)}&nbsp;</span>
																	</div>
																</div>
																<div class="profile-info-row">
																	<div class="profile-info-name"> Asset Description </div>

																	<div class="profile-info-value">
																		<span>{strtoupper($item.code)}{$item.asset_desc}&nbsp;</span>
																	</div>
																</div>
																
															</div>
															<hr>
													{/foreach}
													
													{if !$hardware_type == 1}
												<div id="flashMessage" class="alert alert-info"  style="margin-bottom:10px;">	
												No hardware assigned to you
												</div>
												{/if}
													</div>

												<div id="sw" class="tab-pane fade">
												
												
													{foreach from=$data_software item=item key=key}	
													{assign var="software_type" value="1"}
												<div class="profile-user-info">
																<div class="profile-info-row">
															
																	<div class="profile-info-name"> Type </div>
																	<div class="profile-info-value">
																	
																		<span><b>{ucfirst($item.sw_type)}</b></span>
																	<a href="fr_asset_change_user.php?id={$item.id}&type=S" rel="tooltip" 
																	title="Request Change" style="float:right;margin-right:150px" 
																	class="iframeBox" val="55_95"><button class="btn btn-xs btn-info" val="55_95"><i class="icon-pencil"></i> Change</button></a>
																	</div>
																</div>

																<div class="profile-info-row">
																	<div class="profile-info-name"> Brand </div>

																	<div class="profile-info-value">
																		<i class="fa fa-map-marker light-orange bigger-110"></i>
																		<span>{ucfirst($item.brand)}</span>
																	</div>
																</div>

																<div class="profile-info-row">
																	<div class="profile-info-name"> Edition </div>

																	<div class="profile-info-value">
																		<span>{ucfirst($item.edition)}</span>
																	</div>
																</div>
												       
															</div>
															<hr>
										 {/foreach}
										 {if !$software_type == 1}
												<div id="flashMessage" class="alert alert-info"  style="margin-bottom:10px;">	
												No software assigned to you
												</div>
												{/if}
										
												
												</div>

												<div id="tk" class="tab-pane fade">
												{if $ALERT_MSG_TICKET}
												<div id="flashMessage" class="alert alert-info"  style="margin-bottom:10px;">	
												{$ALERT_MSG_TICKET}
												</div>
												{else}
												<table id="dynamic-table" class="table table-striped table-hover dataTable no-footer" role="grid" aria-describedby="dynamic-table_info">												
												<div id="message1" class="dn hide-2">
   												<div id="flashMessage" class="alert alert-success"  style="margin-bottom:10px;">
    													<button  class="close" id="2" style="margin-right:15px;">×</button>
        													Ticket deleted successfully.
   												</div>
												</div>										
												<thead>
													<tr role="row">
														<th width="500"  tabindex="0" aria-controls="dynamic-table" rowspan="1" colspan="1">Subject</th>
														<th  width="150"   tabindex="0" aria-controls="dynamic-table" rowspan="1" colspan="1" >Priority</th>
														<th width="150"  tabindex="0" aria-controls="dynamic-table" rowspan="1" colspan="1">Created Date</th>
														<th width="150"  style="text-align:center" tabindex="0" aria-controls="dynamic-table" rowspan="1" colspan="1">
															Status
														</th>
														<th width="150">
															Options
														</th>
														</tr>
												</thead>

												<tbody>
												{foreach from=$data_ticket item=item key=key}		
								              {if $item.priority}
												<tr role="row" class='row-{$item.id}'>
														<td>
															<a href="fr_view_ticket.php?id={$item.id}" class="iframeBox"  val="55_95">{ucfirst($item.subject)}</a>
														</td>
														<td>
														{$item.priority}
														</td>
														<td class="hidden-480">{$item.created_date}</td>

														
														<td class="hidden-480" style="text-align:center">
															<span class='label label-{$item.status_cls}'>{$item.status}</span>
														</td>
														<td>						
														 <a href="javascript:void(0)" id='{$item.id}' class='deletedata' val="ticket" rel="tooltip" title="Remove" style="" ><button class="btn btn-xs btn-info" val="55_95"><i class="icon-remove"></i></button></a>
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
							
								
		</div>					
		<script src="js/jquery.min.js"></script>
		
		
		<script src="js/jquery-ui-1.10.4.custom.min.js"></script>

		<script src="js/plugins/colorbox/jquery.colorbox-min.js"></script>



		<script src="js/bootstrap.min.js"></script>

		<script src="js/jquery-ui-1.10.3.custom.min.js"></script>
		<script src="js/jquery.slimscroll.min.js"></script>
		
		

		<script src="js/ace-extra.min.js"></script>
		
		<script src="js/ace-elements.min.js"></script>
		<script src="js/ace.min.js"></script>
	
	
	<script src="js/application.js"></script>
    <script src="js/jquery.scrollTo-1.4.3.1-min.js" type="text/javascript"></script>

	

	<script src="js/main.js"></script>			
	{literal} 
	<style type="text/css">
	.ui-dialog .ui-dialog-titlebar-close{color:#fff}
	 #dynamic-table tr th{font-weight: bold !important; font-size: 13px !important; }
	 #dynamic-table tr td{font-weight: normal !important; font-size: 13px !important; }
	 #cboxOverlay{opacity:0.5 !important;}
	</style>
	{/literal}