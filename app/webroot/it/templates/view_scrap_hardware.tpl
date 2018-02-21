{* Purpose : To view scrap hardware.
   Created : Nikitasa
   Date : 20-06-2016 *}

	{include file='include/header.tpl'}		
	<div id="page_wrapper">
	{include file='include/menu.tpl'}
	
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>View Scrap Hardware</h1>
					</div>
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="dashboard.php">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						<li>
							<a href="list_scrap_hardware.php">Scrap Hardware</a>
								<i class="icon-angle-right"></i>
						</li>
						<li>
							<a href="view_scrap_hardware.php?id={$id}">View Scrap Hardware</a>
						</li>
					</ul>
				</div>
					<div class="row-fluid  footer_div">
					<div class="span12">
		
					<form action="view_scrap_hardware.php" id="formID" class="form-horizontal form-column form-bordered" enctype="multipart/form-data" method="post" accept-charset="utf-8"><div style="display:none;"><input type="hidden" name="_method" value="POST"/></div>										
					<div class="box">
							<div class="box-title">
								<h3><i class="icon-list"></i>Scrap Hardware Details</h3>
							</div>
				   <div class="box-content nopadding">
						<div class="span6">		
						<div class="control-group">
						 <label for="textfield" class="control-label">Type </label>
						 {foreach from=$data item=item key=key}
						 <div class="controls">{$item.title}	</div>
						</div>		
						<div class="control-group">
						 <label for="textfield" class="control-label">Model ID / Name </label>
						 <div class="controls">{$item.model_id}	</div>
						</div>			 
						<div class="control-group">
						 <label for="textfield" class="control-label">Location </label>
						 <div class="controls">{$item.location}	</div>
						</div>
										
						<div class="control-group">
						 <label for="password" class="control-label">Scrap Date</label> </label>
						 <div class="controls">{$item.created_date}	</div>
						</div>			
						</div>
                  <div class="span6">	
                  <div class="control-group">
			          <label for="textfield" class="control-label">Brand </label>
			          <div class="controls">{$item.brand}  </div>
				      </div>
				      <div class="control-group">
				       <label for="textfield" class="control-label">Inventory No </label>
				       <div class="controls">  {$item.inventory_no}	</div>
				      </div>						
				      <div class="control-group">
			          <label for="textfield" class="control-label">Asset Description </label>
				       <div class="controls">	{$item.asset_desc}	</div>
				      </div>
					  <div class="control-group">
			          <label for="textfield" class="control-label">Message </label>
				       <div class="controls">	{$item.message}	</div>
				      </div>
				      </div>
			   	</div>
			   	{/foreach}
					<div class="span12">
						<div class="form-actions">
						 <a href="list_scrap_hardware.php"><input type="button" val="list_scrap_hardware.php" value="Back" class="jsRedirect btn btn-primary"></a>
						</div>
					</div>		
				 </div>
				</form>		
				</div>
			</div>
		</div>
	</div>		
</div>
{include file='include/footer.tpl'}
</div>
<input type="hidden" value="/" id="css_root">
{include file='include/footer_js.tpl'}