{* Purpose : To view dashboard.
   Created : Nikitasa
   Modified : Gayathri
   Date : 10-06-2016 *}
	{include file='include/header.tpl'}		
	<div id="page_wrapper">
	{include file='include/menu.tpl'}

	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left" style="margin-left: 10px;">
						<h1>Dashboard
						
	
  
  </h1>				

  
					</div>
					
	<div class="pull-right" style="margin-top:20px;margin-right: 208px;">										
	<a href="list_chart.php?display=hide" class="iframeBox" val="55_90">Graph Settings</a> 
  </div>
				</div>
					{if $access}
				   <div id="flashMessage" class="alert alert-success">
				   <button type="button" class="close" data-dismiss="alert">&#x2A2F;</button>{$access}</div>					
				   {/if}
				  <!--LIST CHART DETAILS-->
 
				<div class="breadcrumbs"  style="width: 83%;margin-left: 12px;">
					<ul>
						<li>
							<a href="dashboard.php">Dashboard</a>
						</li>
					</ul>	
										
				</div>
				
			<div class="row-fluid footer_div" id="pcontent" >
			{foreach from=$data item=item key=key}	
		  		{if $item.order_to_sort != 0}
					<div class="span10 bdBox">
					
						<div class="box box-bordered">
							<div class="box-title dashTitle">
								<h3><i class="icon-bar-chart"></i>{$item.graph_name}</h3>
								
							</div>
							<div class="box-content">
								<div id="piechart{$item.id}" style="height:400px;"></div>
							</div>
						</div>
					</div>
            {/if}
          {/foreach}        
			</div>
			</div>
		</div>
		</div>
	{include file='include/footer.tpl'}
	</div>
		<input type="hidden" id="graphHdn" value="1">
	<input type="hidden" value="/" id="css_root">
	{include file='include/footer_js.tpl'}
	{include file='include/dashboard_js.tpl'}