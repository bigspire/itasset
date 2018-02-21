{* Purpose : To add role.
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
							<a href="add_role.php">Add Role </a>
						</li>
					</ul>
				</div>
				{if $EXIST_MSG}
				 <div id="flashMessage" class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button>{$EXIST_MSG}</div>					
				{/if}
					<div class="row-fluid footer_div">
					<div class="span12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3><i class="icon-list"></i> Please fill the form to create a new role</h3>
							</div>
							<div class="box-content nopadding">
				<form id="formID" class="form-horizontal form-column form-bordered" method="post" accept-charset="utf-8"><div style="display:none;"><input type="hidden" name="_method" value="POST"/></div>								
				<div class="span6">
					<div class="control-group">
						<label for="textfield" class="control-label">Role Name <span class="red_star"> *</span></label>
							<div class="controls field">
								<input name="role_name" class="input-xlarge" placeholder="" type="text" id="role_name" value="{$role_name}"/> 
								<div class="errorMsg error">{$role_nameErr} </div>								
							</div>
					</div>
					<div class="control-group">
						<label for="textfield" class="control-label"> Description </label>
							<div class="controls">
								<textarea name="description" class="input-xlarge" placeholder="" cols="30" rows="6" id="description">{$description}</textarea> 				
							</div>
					</div>
				</div>
				<div class="span6">									
				<div class="control-group">
						<label  for="textfield" class="control-label"> Permissions <span class="red_star"> *</span> </label>
							<div class="controls field" >		
							<select name="permission[]" multiple="multiple" size="10" separator="  " class="multi_select" id="RolePermission"  style="clear:left"> 		
{html_options options=$permissions selected=$permission_ar}				
 </select>           
 <div class="rolePermError errorMsg error">{$permissionErr} </div>
</div>
				</div>
				<div class="control-group">
						<label for="textfield" class="control-label">Status
						<span class="red_star"> *</span></label>
						<div class="controls field" >	
											{if isset($status)}
									{html_options name=status class="input-xlarge" placeholder=""  style="clear:left" id="status" options=$role_status selected=$status}	
											{else}
									{html_options name=status class="input-xlarge" placeholder="" style="clear:left" id="status" options=$role_status selected='1'}	
											{/if}										

										<div class="errorMsg error">{$statusErr} </div>	
				</div>
				</div>	
				</div>

			<div class="span12">
					<div class="form-actions">
						<input onclick="return validate_role()" type="submit" name="submit" value="Save Changes" class="btn btn-primary">
							<a href="list_role.php"><button type="button" val="list_role.php" class="jsRedirect btn" onclick="return cancelfunction()">Cancel</button></a>
					</div>
				</div>
			</form>
			</div>
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
