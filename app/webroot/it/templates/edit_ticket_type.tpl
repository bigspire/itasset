{* Purpose : To edit ticket type.
   Created : Nikitasa
   Date : 16-12-2017 *}		
		
{include file='include/header.tpl'}
	<div id="page_wrapper">
	{include file='include/menu.tpl'}		
	
	<input type="hidden" value="/" id="site_root"/>	
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Edit Ticket Type</h1>
					</div>
					
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="dashboard.php">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="list_ticket_type.php">Ticket Type</a>
							<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="edit_ticket_type.php">Edit Ticket Type</a>
						</li>
					</ul>
					
				</div>
				{if $EXIST_MSG}
				 <div id="flashMessage" class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button>{$EXIST_MSG}</div>					
				{/if}
								

				<div class="row-fluid  footer_div">
					<div class="span12">
						
					<form action="edit_ticket_type.php?id={$getid}"  id="formID" class="form-horizontal form-column form-bordered" enctype="multipart/form-data" method="post" accept-charset="utf-8"><div style="display:none;"><input type="hidden" name="_method" value="POST"/></div>											
						<div class="box">
							<div class="box-title">
								<h3><i class="icon-list"></i>Ticket Type Details</h3>
							</div>
							
							<div class="box-content nopadding">
									<div class="span6">
									
										<div class="control-group">
											<label for="textfield" class="control-label">Type <span class="red_star"> *</span></label>
											<div class="controls field">
											   <input name="type" class="input-xlarge" placeholder="" type="text" id="type" value="{$type}"/> 
												<div class="errorMsg error">{$typeErr} </div>												  
									  	</div>
										</div>
										</div>	
									<div class="span6">	
										<div class="control-group">
											<label for="textfield" class="control-label">Status <span class="red_star"> *</span></label>
											<div class="controls field">
											{if isset($status)}
												{html_options name=status class="input-xlarge" placeholder="" style="clear:left" id="status" options=$ticket_status selected=$status}	
											{else}
												{html_options name=status class="input-xlarge" placeholder="" style="clear:left" id="status" options=$ticket_status selected='1'}	
											{/if}	
											<div class="errorMsg error">{$statusErr} </div>			
											</div>
										</div>
																	
									</div>					
	
							<div class="span12">
										<div class="form-actions">
											<input onclick="return validate_brand()" type="submit" name="submit" value="Submit" class="btn btn-primary">
											<a href="list_ticket_type.php"><button type="button" val="list_ticket_type.php" class="jsRedirect btn regCancel" onclick="return cancelfunction()">Cancel</button></a>
										</div>
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