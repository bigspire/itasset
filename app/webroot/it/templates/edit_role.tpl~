{* Purpose : To edit role.
   Created : Nikitasa, Gayathri
   Date : 21-06-2016 *}

	{include file='include/header.tpl'}		
	<div id="page_wrapper">
	{include file='include/menu.tpl'}
	
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Role</h1>
					</div>
					
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="dashboard.php">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="list_role.php">Role </a>
								<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="edit_role.php?id={$getid}">Edit Role </a>
						</li>
					</ul>
					
				</div>
				{if $EXIST_MSG}
				 <div id="flashMessage" class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&#x2A2F;</button>{$EXIST_MSG}</div>					
				{/if}								
				
					<div class="row-fluid footer_div">
					<div class="span12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3><i class="icon-list"></i> Please fill the form to edit the role</h3>
							</div>
							<div class="box-content nopadding">
								
								
								<form action="edit_role.php?id={$getid}" id="formID" class="form-horizontal form-column form-bordered" method="post" accept-charset="utf-8"><div style="display:none;"><input type="hidden" name="_method" value="POST"/></div>								
								
									<div class="span6">
									
								
										
										
										<div class="control-group">
											<label for="textfield" class="control-label">Role Name <span class="red_star"> *</span></label>
											<div class="controls field">
										
													<input name="role_name" class="input-xlarge" placeholder="" type="text" id="role_name" value="{$role_name}"/> 
	                           <div class="errorMsg error">{$role_nameErr}</div>												
											</div>
										</div>
										
										
												<div class="control-group">
											<label for="textfield" class="control-label"> Description </label>
											<div class="controls">
										<textarea name="role_desc" class="input-xlarge" placeholder="" cols="30" rows="6" id="role_desc">{$role_desc}</textarea> 
																				
											</div>
										</div>
										
					
										
											
											
										
									
										
									</div>
								

<div class="span6">									
										
											<div class="control-group">
											<label for="textfield" class="control-label"> Permissions <span class="red_star"> *</span> </label>
											<div class="controls field">
										
<select separator="  " class="multi_select" style="clear:left"  name="app_modules_id[]" id="" multiple="multiple">								
{html_options  options=$permissions selected=$app_modules_id}		
</select>	


<div class="errorMsg error rolePermError">{$app_modules_idErr} </div>										</div>
										</div>
										
										<div class="control-group">
											<label for="textfield" class="control-label">Status <span class="red_star"> *</span></label>
											<div class="controls field">
	{html_options name=status class="input-xlarge" placeholder="" style="clear:left" id="status" options=$role_status selected=$status}	
										<div class="errorMsg error">{$statusErr} </div>	
											</div>
										</div>
									
									
										
									
								
									</div>


										
										
									<div class="span12">
										<div class="form-actions">
											<input onclick="return validate_role()" type="submit" name="submit" value="Save changes" class="btn btn-primary">
											<a href="list_role.php"><button type="button" val="list_role.php" class="jsRedirect btn" onclick="return cancelfunction()">Cancel</button></a>
										</div>
									</div>
								</form>							</div>
						</div>
					</div>
				</div>
				</div>
					</div>
				</div>
		{include file='include/footer.tpl'}
</div>
<input type="hidden" value="/" id="css_root">
{include file='include/footer_js.tpl'}