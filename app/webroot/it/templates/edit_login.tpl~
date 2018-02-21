{* Purpose : To add login.
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
						<h1>Edit Login</h1>
					</div>
					
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="dashboard.php">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="list_login.php">Login </a>
								<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="edit_login.php?id={$getid}">Edit Login </a>
						</li>
					</ul>
				</div>
					<div class="row-fluid  footer_div">
					
					
					<div class="span12">
					
								<form action="edit_login.php?id={$getid}" method="POST" enctype="multipart/form-data"  class="form-horizontal form-column form-bordered form-wizard ui-formwizard" id="formID" novalidate="novalidate">
									<div class="step ui-formwizard-content" id="firstStep" style="width:99%;margin-top:20px;">
										
									</div>
								
									
									
						<div class="box">
							<div class="box-title">
								<h3><i class="icon-list"></i> Login Details</h3>
							</div>
							
						
							<div class="box-content nopadding">
								
								
								
								
								
									<div class="span6">
									
										<div class="control-group">
											<label for="textfield" class="control-label">Employee <span class="red_star"> *</span></label>
											<div class="controls field">
											<select name="app_users_id" id="app_users">
											<option value="">Select</option>
											{html_options class="input-xlarge" placeholder="" style="clear:left" id="app_users" options=$employee selected=$app_users_id}	
											</select>
<div class="errorMsg error">{$app_users_idErr} </div>													
										</div>
										</div>
										
										
										<div class="control-group">
											<label for="textfield" class="control-label">Username <span class="red_star"> *</span></label>
											<div class="controls field">
										<input name="user_name" class="input-xlarge" placeholder="" type="text" id="username" value="{$user_name}"/> 													
										<div class="errorMsg error">{$user_nameErr} </div>

											</div>
										</div>
										
										<div class="control-group">
											<label for="textfield" class="control-label">URL <span class="red_star"> *</span></label>
											<div class="controls field">
										<input name="host" class="input-xlarge" placeholder="" type="text" id="server" value="{$host}"/> 													
<div class="errorMsg error">{$hostErr} </div>										
										</div>
										</div>
										
													
								
									</div>
									
									

									
									

<div class="span6">		

	
										
									
									<div class="control-group">
											<label for="textfield" class="control-label">Login Type <span class="red_star"> *</span></label>
											<div class="controls field">
											<select name="it_login_type_id" id="login_type">
										<option value="">Select</option>
					{html_options class="input-xlarge" placeholder="" style="clear:left" id="login_type" options=$login selected=$it_login_type_id}	
										</select>
<div class="errorMsg error">{$it_login_type_idErr} </div>
										
										</div>
										</div>
										
										<div class="control-group">
											<label for="textfield" class="control-label">Password <span class="red_star"> *</span></label>
											<div class="controls field">
								       	<input name="password" class="input-xlarge" placeholder="" type="text" id="password" value="{$password}"/> 													
										  <div class="errorMsg error">{$passwordErr} </div>
										</div>
										</div>
													
										<div class="control-group">
											<label for="textfield" class="control-label">Status <span class="red_star"> *</span></label>
											
											<div class="controls field">
	{html_options name=status class="input-xlarge" placeholder="" style="clear:left" id="status" options=$login_status selected=$status}	
										<div class="errorMsg error">{$statusErr} </div>	
										</div>
										</div>						
								
									</div>


										
										
							<div class="span12">
										<div class="form-actions">
											<input onclick = "return validate_login()" type="submit" name="submit" value="Submit" class="btn btn-primary">
				                        
											
											<a href="list_login.php"><button type="button" val="list_login.php" class="jsRedirect btn regCancel" onclick="return cancelfunction()">Cancel</button></a>
											
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
