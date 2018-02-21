{* Purpose : To edit ticket.
   Created : Nikitasa
   Date : 1-06-2016 *}

	{include file='include/header.tpl'}		
	<div id="page_wrapper">
	{include file='include/menu.tpl'}
	
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Edit Ticket</h1>
					</div>
					
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="dashboard.php">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="list_ticket.php">Help Desk</a>
								<i class="icon-angle-right"></i>
						</li>
						
						<li>
							<a href="edit_ticket.php?id={$smarty.get.id}&status_id={$smarty.get.status_id}">Edit Ticket</a>
						</li>
					</ul>
					
				</div>
				<div class="row-fluid  footer_div">
					<div class="span12">
	
					<form action="edit_ticket.php?id={$g_id}&status_id={$smarty.get.status_id}"  method="POST" class="form-horizontal form-column form-bordered form-wizard ui-formwizard"  id="formID">
				
	
						<div class="box">
							<div class="box-title">
								<h3><i class="icon-list"></i>Ticket Details</h3>
							</div>
							<div class="box-content nopadding">
                     <div class="span6">
                     		<div class="control-group">
											<label for="textfield" class="control-label">Employee Name</label>
									<div class="controls">
											{$data.full_name}	
									</div>
									</div>
									<div class="control-group">
											<label for="textfield" class="control-label">Subject</label>
									<div class="controls">
											{$data.subject}	
									</div>
									</div>
									<div class="control-group">
											<label for="textfield" class="control-label">Priority</label>
									<div class="controls">
											{$priority}
									</div>
									</div>
								   <div class="control-group">
											<label for="textfield" class="control-label">Attachment <br><br></label>
											<div class="controls">
											<a href = "edit_ticket.php?id={$smarty.get.id}&action=download&file={$data.attach_file}">
											{$data.attach_file}
											</a>
											</div>
									</div>
				          </div>
	
	                   <div class="span6">
									<div class="control-group">
											<label for="textfield" class="control-label">Type</label>
											<div class="controls">
											{$data.type}
										   </div>
									</div>	
									<div class="control-group">
											<label for="textfield" class="control-label">Decription</label>
											<div class="controls">
											{$data.description}
										   </div>
									</div>
									<div class="control-group">
											<label for="textfield" class="control-label">Status<span class="red_star"> *</span></label>
											<div class="controls">
											<select name='it_ticket_status_id' id="status_id" class="input-small" placeholder="" style="clear:left">
											<option value="">Select</option>
					                   {html_options options=$status_type  selected=$type}		
					                  </select>
											<div class="errorMsg error">{$error_msg}</div>
											</div>
									</div>	
									<div class="control-group">
											<label for="textfield" class="control-label">Message</label>
											<div class="controls">
												<textarea name="message" rows="2" class="input-xlarge" placeholder="Message" cols="30" id="message">{$smarty.post.message}</textarea> 																					
											</div>
									</div>
				          </div>
							 <div class="span12">
										<div class="form-actions">
											<input onclick="return validate_edit_ticket()" type="submit" name="Submit" value="Submit" class="btn btn-primary"></a>
											<a href="list_ticket.php"><button type="button" val="list_ticket.php" class="jsRedirect btn regCancel">Cancel</button></a>
										</div>
							 </div>		
							</div>
							
						</div>
						<div>
						<div class="control-group">		
						<label for="textfield" class="control-label">Response(s)</label>
							{foreach from=$data1 item=item key=key}
								{if $item.message != '0'}
									<div class="controls" style="border-bottom:1px dashed #efefef;border-top:1px dashed #efefef;">
									<span style="font-weight:;">{$item.message|ucfirst} {if $item.message} on {else} On{/if} </span> {$item.created_date} <i></i> <br>
									<i>{$item.status|ucfirst}</i>
									</div>
								{/if}
							{/foreach}
						</div>
					</form>
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