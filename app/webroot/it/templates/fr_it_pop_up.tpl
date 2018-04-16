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
	
       

    
	<div class="widget-body" style="padding-top: 15px;border-top: 1px solid #CCC;">
	
		<div style="margin-left:20px;font-weight:bold;">One moment, Pls verify the assigned hardware and software for you.</div>

		<input type="hidden" id="fr_home" value="">	
	
	
		<div class="widget-main">
			<div>
				<div class="dialogs">
					<div class="clearfix">	
								<div class="row">
									<div class="col-sm-9" >
								
										<div class="tabbable">
											<ul class="nav nav-tabs" id="myTab">
												<li class="active">
													<a data-toggle="tab" href="#hw">
														<i class="green ace-icon fa fa-home bigger-120"></i>
														Assigned Hardware
													</a>
												</li>

												<li>
													<a data-toggle="tab" href="#sw">
														Assigned Software
													</a>
												</li>
								         
											</ul>
<form action="fr_it_pop_up.php" id="formID"  method="post">
																
																

											<div class="tab-content"  style="border:1px solid #c5d0dc">
											
			
	
												<div id="hw" class="tab-pane fade in active">
												
												{foreach from=$data_hardware item=item key=key}	
												{assign var="hardware_type" value="1"}
													<div class="profile-user-info">
														<div class="profile-info-row">
															
															<div class="profile-info-name"> Type </div>
															
																<div class="profile-info-value">
															
																	<span><b>{ucfirst($item.hw_type)}</b></span>
																	
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
																
																<div class="profile-info-row">
																	<div class="profile-info-name">  </div>

																	<div class="profile-info-value">
																	
																		<span><input type="radio" class="accept" {$accept_checked[$item.inv_id]} name="accepthw_{$item.inv_id}" value="1_{$item.inv_id}"/> I Accept</span>
																		<span><input type="radio" class="reject" {$reject_checked[$item.inv_id]} name="accepthw_{$item.inv_id}" value="0_{$item.inv_id}"/> I do not Accept</span>
																		
																	<input type="hidden" id="" name="itahw_{$item.inv_id}" value="{$item.ita_id}"/>

																	
	<input type="hidden" id="" name="itahw_type_{$item.ita_id}" value="{ucfirst($item.hw_type)}"/>
	<input type="hidden" id="" name="itahw_brand_{$item.ita_id}" value="{ucfirst($item.brand)}"/>
	<input type="hidden" id="" name="itahw_inventory_{$item.ita_id}" value="{ucfirst($item.inventory_no)}"/>
	<input type="hidden" id="" name="itahw_asset_desc_{$item.ita_id}" value="{strtoupper($item.code)}{$item.asset_desc}"/>

	
																	


																																				
																		<br>
																			<span class="error">{$fieldErr[$item.inv_id]}</span>
																		
																		<textarea style="margin-top:15px;" id="{$item.inv_id}" class="dn" placeholder="Reason for not accepting" name="reasonhw_{$item.inv_id}">{$retainReason[$item.inv_id]}</textarea>
																		<span class="error">{$reasonErr[$item.inv_id]}</span>
																		
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
																	
																	<div class="profile-info-row">
																	<div class="profile-info-name">  </div>

																	<div class="profile-info-value">
																			<span><input type="radio" name="acceptsw_{$item.id}" {$accept_checked[$item.id]} class="accept"  value="1_{$item.id}"/> I Accept</span>
																		<span><input type="radio" name="acceptsw_{$item.id}" {$reject_checked[$item.id]}  class="reject"  value="0_{$item.id}"/> I do not Accept</span>
																		
																		<input type="hidden" id="" name="itasw_{$item.id}" value="{$item.ita_id}"/>
																	




	<input type="hidden" id="" name="itasw_type_{$item.ita_id}" value="{ucfirst($item.sw_type)}"/>
	<input type="hidden" id="" name="itasw_brand_{$item.ita_id}" value="{ucfirst($item.brand)}"/>
	<input type="hidden" id="" name="itasw_edition_{$item.ita_id}" value="{ucfirst($item.edition)}"/>

	
																		<br>
																			<span class="error">{$fieldErr[$item.id]}</span>
																			
																		<textarea style="margin-top:15px;" id="{$item.id}" class="dn"  placeholder="Reason for not accepting" name="reasonsw_{$item.id}">{$retainReason[$item.id]}</textarea>
																		
																		<span class="error">{$reasonErr[$item.id]}
																		</span>
																		
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
<div align="center" style="align:center">
<input type="hidden" name="hdnSubmit" id="hdnSubmit"/>
												<input type="submit" name="submit" value="Submit" class="itAcceptBtn btn  btn-success">
											</div>
											
											
											
											</div>
											

											
											
										</form>	
									
									
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
	
	{if $form_sent == '1'}
	{literal} 
	<script type="text/javascript">
	/* redirect to hardware page once hardware moved to scrap successfully */
	self.parent.location.reload();
	parent.jQuery(".modalCloseImg").click();
	parent.$.colorbox.close();
	</script>
	{/literal}
	{/if}
