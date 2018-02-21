{* Purpose : To edit change_asset_info.
   Created : Gayathri
   Modified : Nikitasa
   Date : 22-06-2016 *}		
		{include file='include/header.tpl'}
	
	<div id="page_wrapper">
	{include file='include/menu.tpl'}
<input type="hidden" value="/" id="site_root"/>	
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Edit Change Asset Info</h1>
					</div>
					
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="dashboard.php">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="list_change_asset_info.php">Change Asset Info</a>
								<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="edit_change_asset_info.php?id={$getid}">Edit Change Asset Info</a>
						</li>
					</ul>
					
				</div>
				<div class="row-fluid  footer_div">
				
					<div class="span12">
					
								<form action="edit_change_asset_info.php?id={$getid}" method="POST" enctype="multipart/form-data"  class="form-horizontal form-column form-bordered form-wizard ui-formwizard" id="formID" novalidate="novalidate">
									<div class="step ui-formwizard-content" id="firstStep" style="width:99%;margin-top:20px;">
										
									</div>
								
								
						<div class="box">
							<div class="box-title">
								<h3><i class="icon-list"></i>Change Asset Info</h3>
							</div>
							
							<div class="box-content nopadding">
							<div class="span6">
									
										<div class="control-group">
											<label for="textfield" class="control-label">Employee <span class="red_star"> *</span></label>
											<div class="controls">{$first_name} {$last_name}</div>
										</div>
										<div class="control-group">
											<label for="password" class="control-label">Message<span class="red_star"> *</span></label>
											<div class="controls">{$message}</div>
										</div>
										<div class="control-group">
											<label for="textfield" class="control-label">Remarks</label>
											<div class="controls">
												<textarea name="remark" rows="2" class="input-xlarge" placeholder="Remarks" cols="30" id="remark">{$remark}</textarea> 											
											</div>
									</div>
										</div>
<div class="span6">		
<div class="control-group">
											<label for="textfield" class="control-label">Asset Type <span class="red_star"> *</span></label>
											<div class="controls">{$type}</div>
										</div>
	<div class="control-group">
											<label for="textfield" class="control-label">Status <span class="red_star"> *</span></label>
											<div class="controls">
											<select name=status  class="input-xlarge" placeholder="" style="clear:left" id="status_id">
												{html_options  options=$change_asset_status selected=$status}	
											</select>
											<div class="errorMsg error">{$statusErr} </div>
											</div>
										</div>	
										</div>	
										<div class="span12">				
								</div>
										</div>
										
										</div>
										<div class="span12">
										<div class="form-actions">
											<a href="list_change_asset_info.php">
											<input onclick="return validate_edit_ticket()" type="submit" name="next" value="Submit" class="btn btn-primary"></a>
				                        
											
											<a href="list_change_asset_info.php"><button type="button" val="list_change_asset_info.php" class="jsRedirect btn regCancel">Cancel</button></a>
											
										</div>
									</div>	
							
						</div>
						</div>
						
					</form>					
				</div>
					</div>
		
			</div>		
					
				</div>
				{include file='include/footer.tpl'}
		
		</div>
	
	<input type="hidden" value="/" id="css_root">


{include file='include/footer_js.tpl'}
