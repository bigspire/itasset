<style type="text/css">
body{padding-top:20px;background:#fff}
.table-responsive{overflow-x:hidden}
.tooltip-inner{text-align:left;}
.editable-buttons{margin-top:5px}
.editable-error-block{color:#ff0000}
.editableform-loading {
    background: url('<?php echo $this->webroot;?>img/loading.gif') center center no-repeat;  
    height: 25px;
    width: auto; 
    min-width: 25px; 
}
.table-hover tbody tr:hover > td,
.table-hover tbody tr:hover > th {
  background-color: #FCEAEA;
}
</style>

<div id="disablingDiv"></div>	

<div  id="att_stList">

<div class="col-sm-6">
<?php if(empty($task_data)):?>
<div class="alert alert-warning norec">
<button type="button" class="close" data-dismiss="alert">
<i class="ace-icon fa fa-times"></i></button> Oops! no tasks to show
<br></div>
<?php endif; ?>
<div class="alert alert-success com_success dn" style="padding:8px;font-size:13px;">
<button type="button" class="close" data-dismiss="alert">
<i class="ace-icon fa fa-times"></i></button> Comment sent successfully
<br></div>

<div class="alert alert-error com_error dn" style="padding:8px;font-size:13px;">
<button type="button" class="close" data-dismiss="alert">
<i class="ace-icon fa fa-times"></i></button> Problem in posting the comment
<br></div>

</div>	


<div class="loading dn" id="busy-indicator" style="display:none;left:20%;top:25%"><span>Loading... Please wait... <img src="<?php echo $this->webroot;?>img/loading.gif"/></span></div>


								


	
<div class="col-xs-12">
					  <div class="table-responsive" style="border:none">
		
		
		
		
		<!--table style="float:right;"><tbody><tr><td class="legendColorBox">
		<i class="icon-circle-arrow-down"></i> </td><td class="legendLabel">In Time </td><td class="legendColorBox"><i class="icon-circle-arrow-up"></i> </td><td class="legendLabel">Out Time</td>
		</tr></tbody></table-->
		
		
		<form name="sharefrm" id="shareFrm" method="post" style="clear:both">	
		
			<table style="margin:4px 0px"><tr><td width="200">	<div><b>Employee:</b> <?php echo $emp_data['HrEmployee']['first_name'].' '.$emp_data['HrEmployee']['last_name'];?></td>
			<td><b>Task Date: </b> <?php echo $this->request->params['pass'][1]; ?></td>
			</tr></table>
			
			
			<table id="sample-table-1" class="table table-striped table-bordered table-hover">
												<thead>
													<tr>

														<th width="200">Title</th>
														<th width="330">Description</th>
														<th width="150">Type</th>
														<th width="120">Start</th>
														<th width="120">End</th>
														<th width="100" style="text-align:center">Status</th>
														<th width="50" style="text-align:center">Action</th>
														
													</tr>
												</thead>

												<tbody>
													
				<?php    foreach($task_data as $task): ?>
												
												
												<tr id="row-<?php echo $user['a']['id'];?>">
										<td class=""> <?php echo $task['TskPlan']['title'];?>	</td>
										<td class=""><?php echo $task['TskPlan']['desc'];?>	</td>
										<td class=""> <?php echo $task['TskPlanType']['title'];?></td>
										<td class=""> <?php echo  $this->Functions->format_tsk_time_show($task['TskPlan']['start'], 'D');?>	</td>
										<td class=""> <?php echo $this->Functions->format_tsk_time_show($task['TskPlan']['end'], 'D');?>	</td>
										
										<td class=""><span><span class="label <?php echo $this->Functions->show_task_status_color($task['TskPlan']['status']);?>">
 <?php echo $this->Functions->show_task_status($task['TskPlan']['status']);?></span>	</td>
														
									

							
								
														<td style="text-align:center">
														
						
					
										
					<button type="button"  data-placement="left" data-rows="2" data-type="textarea" data-pk="<?php echo $task['TskPlan']['id']?>" data-url="<?php echo $this->webroot;?>home/tsk_comment/" data-title="Comment" id="tsk<?php echo $task['TskPlan']['id'];?>"  class="tsk_comment click_hide btn btn-warning btn-xs  show-tip">
											<i class="icon-comment icon-only"></i>
											
										</button>
										
														</td>
														
													</tr>
											<?php endforeach; ?>
											
													
												
												</tbody>
											</table>
							
					<input type="hidden" id="webroot" value="<?php echo $this->webroot;?>"/>
					
									</form>
									
									
										</div><!-- /.table-responsive -->
										
										
										
									</div>
</div>		

			