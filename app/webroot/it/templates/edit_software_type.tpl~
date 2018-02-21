{* Purpose : To edit software type .
   Created : Gayathri
   Date : 17-06-2016 *}		
		{include file='include/header.tpl'}

	<div id="page_wrapper">
	
	{include file='include/menu.tpl'}	
	
		<input type="hidden" value="/" id="site_root"/>	
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Edit Software Type</h1>
					</div>
					
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="dashboard.php">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="software_type.php">Software Type</a>
								<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="edit_software_type.php?id={$id}">Edit Software Type</a>
						</li>
					</ul>
					
				</div>
				
					{if $EXIST_MSG}
				 <div id="flashMessage" class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&#x2A2F;</button>{$EXIST_MSG}</div>					
				{/if}				
				
					
					<div class="row-fluid  footer_div">
					
					
					<div class="span12">
					
								<form action="post.php" method="POST" class="form-horizontal form-wizard ui-formwizard" id="ss" novalidate="novalidate">
									<div class="step ui-formwizard-content" id="firstStep" style="width:99%;margin-top:20px;">
										
									</div>
								
								</form>
						
					<form id="formID" class="form-horizontal form-column form-bordered" enctype="multipart/form-data" method="post" accept-charset="utf-8"><div style="display:none;"><input type="hidden" name="_method" value="POST"/></div>								
									
									
						<div class="box">
							<div class="box-title">
								<h3><i class="icon-list"></i> Software Type Details</h3>
							</div>
							
			
							<div class="box-content nopadding">
								
								
								
								
								
									<div class="span6">
									
										<div class="control-group">
											<label for="textfield" class="control-label">Title <span class="red_star"> *</span></label>
											<div class="controls field">
											   <input name="title" class="input-xlarge" placeholder="" type="text" id="title" value="{$title}"/> 
										<div class="errorMsg error">{$titleErr} </div>														  	
									  	</div>
										</div>
										
										
										<div class="control-group">
											<label for="textfield" class="control-label">Status <span class="red_star"> *</span></label>
											<div class="controls field">
									{html_options name=status class="input-xlarge" placeholder="" style="clear:left" id="status" options=$sw_status selected=$status}	
										<div class="errorMsg error">{$statusErr} </div>	
											</div>
										</div>
																	
								
									</div>
									
									

									
									

<div class="span6">		

	
										
									
								<div class="control-group">
											<label for="password" class="control-label">Description</label>
											<div class="controls">
                                  	<textarea name="description" rows="2" class="input-xlarge" placeholder="" cols="30" id="description">{$description}</textarea> 
													
											</div>
										</div>
																
								
									</div>


										
										
							<div class="span12">
										<div class="form-actions">
											<input onclick="return validate_swtype()" type="submit" name="next" value="Submit" class="btn btn-primary">
				                        
											
											<a href="software_type.php"><button type="button" val="software_type.php" class="jsRedirect btn regCancel" onclick="return cancelfunction()">Cancel</button></a>
											
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
