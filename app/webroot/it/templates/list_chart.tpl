{* Purpose : To view dashboard.
   Created : Nikitasa
   Modified : Gayathri
   Date : 10-06-2016 *}


	{if $smarty.get.display eq ''}
	{include file='include/header.tpl'}		
	<div id="page_wrapper">
	{include file='include/menu.tpl'}		
{elseif $smarty.get.display eq 'hide'}
<div style='display:none'>
	{include file='include/header.tpl'}		

	{include file='include/menu.tpl'}
</div>
{/if}
	<div id="page_wrapper">
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
				   {if $SUCCESS_MSG}
					<div class="alert alert-info" role="alert"> 
					{$SUCCESS_MSG}
			      </div>
			   {/if}
					<div class="pull-left">
						<h1>List chart</h1>						
					</div>
					
				</div>
			<div class="row-fluid footer_div" id="pcontent" >
					
		<form action="" name="" id="formID" class="" method="post" accept-charset="utf-8">
							<div class="errorMsg error">{$checkbox_error} </div>		
							<br>
					<div class="span5 bdBox">
										<table class="table table-hover table-nomargin table-bordered usertable dataTable">
									<thead>
										<tr>
											<th style="text-align:center">Chart</th>
											<th style="text-align:center">Show</th>
											<th style="text-align:center">Order</th>
										</tr>
									</thead>
									<tbody>
										<tr>
										 <td>Software By Type</td>

										 <td style="text-align:center;"><input type="checkbox" name="graph[]" value="1" {if $graph_1} checked {/if}></td> 
		                         <td style="text-align:center;"><input type="text" name="order_1" value="{$order_1}" style="width:70px;height:30px;"></td>	
				                 </tr>
  										<tr>
										 <td>Software By Edition</td>
		        					<td style="text-align:center;"><input type="checkbox" name="graph[]" value="2" {if $graph_2} checked {/if}></td> 
		                         <td style="text-align:center;"><input type="text" name="order_2" value="{$order_2}" style="width:70px;height:30px;"></td>	
				                 </tr>
 										<tr>
										 <td>Assigned Software By Edition</td>
		        					<td style="text-align:center;"><input type="checkbox" name="graph[]" value="3" {if $graph_3} checked {/if}></td> 
		                        <td style="text-align:center;"><input type="text" 	name="order_3" value="{$order_3}" style="width:70px;height:30px;"></td>	 	
				                 </tr>
 										<tr>
										 <td>Unassigned Software By Edition</td>
		        					<td style="text-align:center;"><input type="checkbox" name="graph[]" value="4" {if $graph_4} checked {/if}></td> 
		                        <td style="text-align:center;"><input type="text" name="order_4" value="{$order_4}" style="width:70px;height:30px;"></td>		
				                 </tr>
 										<tr>
										 <td>Hardware By Type</td>
		        					<td style="text-align:center;"><input type="checkbox" name="graph[]" value="5" {if $graph_5} checked {/if}></td> 
		                         <td style="text-align:center;"><input type="text" name="order_5" value="{$order_5}" style="width:70px;height:30px;"></td>		
				                 </tr>
 										<tr>
										 <td>Hardware By Brand</td>
		        						 <td style="text-align:center;"><input type="checkbox" name="graph[]" value="6" {if $graph_6} checked {/if}></td> 
		                          <td style="text-align:center;"><input type="text" name="order_6" value="{$order_6}" style="width:70px;height:30px;"></td>	
				                 </tr>
										<tr>
										 <td>Assigned Hardware By Brand</td>
		        						<td style="text-align:center;"><input type="checkbox" name="graph[]" value="7" {if $graph_7} checked {/if}></td> 
		                          <td style="text-align:center;"><input type="text" name="order_7" value="{$order_7}" style="width:70px;height:30px;"></td>	
				                 </tr>
  										<tr>
										 <td>Unassigned Hardware By Brand</td>
		        						 <td style="text-align:center;"><input type="checkbox" name="graph[]" value="8" {if $graph_8} checked {/if}></td> 
		                          <td style="text-align:center;"><input type="text" name="order_8" value="{$order_8}" style="width:70px;height:30px;"></td>	
				                 </tr>
										<tr>
										 <td>Tickets</td>
		        						<td style="text-align:center;"><input type="checkbox" name="graph[]" value="9" {if $graph_9} checked {/if}></td> 
		                         <td style="text-align:center;"><input type="text" name="order_9" value="{$order_9}" style="width:70px;height:30px;"></td>	
				                 </tr>
  										<tr>
										 <td>Request Change</td>
		        						<td style="text-align:center;"><input type="checkbox" name="graph[]" value="10" {if $graph_10} checked {/if}></td> 
		                        <td style="text-align:center;"><input type="text" name="order_10" value="{$order_10}" style="width:70px;height:30px;"></td>	
				                 </tr>
				               </tbody>
								</table>
							<input type="submit" value="Save" class="btn btn-primary" style="margin-bottom:4px;margin-left:4px;">
					 </div>
					
					
			
					 
	 </form>
			</div>
			</div>
		</div>
		</div>
<!--	{include file='include/footer.tpl'}-->
	</div>
	<input type="hidden" value="/" id="css_root">
	{include file='include/footer_js.tpl'}

	{include file='include/dashboard_js.tpl'}