<style type="text/css">
body{background:#fff}
.table-hover tbody tr:hover > td,
.table-hover tbody tr:hover > th {
  background-color: #FCEAEA;
}
.table-responsive{overflow-x:hidden}
</style>
<script>
$(document).ready(function() {	
	$('.close_fancy').click(function (){
		$(this).html('Thank You! 1 sec pls...');
	});
});


</script>

	<?php echo $this->Form->create('Home', array('type' => '', 'id' => 'formID', 'class' => 'form-horizontal form-column form-bordered')); ?>


<div  id="">


	<h3 class="header smaller lighter green">Dear CTians,</h3>

<p style="color:#726E6A;text-align:justify;"><span style="font-size:15px;">
<b><u>Tasks Changes (eff. Feb'15)</u></b></span></p>
<ol class="notify_user" style="font-size:13px;">
<li>Now you have the option to enter both planned and unplanned tasks.</li>
<li>If it’s a planned task, you can plan your tasks beforehand and update before EOD.</li>
<li>If it’s an unplanned task, you can make the update after the task is completed before EOD.</li>
<li>Without updating the tasks for your working hours you will not be allowed to mark your Logout Time.</li>
<li>All your updated tasks will be visible to your L1 and they can have a quick view before approving your attendance the next day.</li>
<li>Your dash board will show the % of planned and unplanned tasks hours.</li>
<li>Work planner updation is applicable only for your working days.</li>
<li>However, if you are opting for “On-Duty” option then you must specify the reasons and tasks handled clearly there.</li>
</ol>

<p style="color:#726E6A;text-align:justify;"><span style="font-size:15px;">
<b><u>Note:</u></b></span>
If you have not updated the “work planner” for the day your logout won’t be enabled. <br>
 
<b>This step is enabled to improve planned and productive performance of all employees of Career Tree.</b><br><br>
 
Pl feel free to call 9003033020 or mail me at <a href="mailto:ravi@career-tree.in">ravi@career-tree.in</a> for any clarification or doubt.

	</p>
		
							</div>				
							<br>	
<button class="btn btn-sm btn-success close_fancy" type="submit" style="">
												<i class="ace-icon fa fa-check"></i>
												READ & UNDERSTOOD
											</button>		
	
	<input type="hidden" value="<?php echo $this->webroot;?>" id="web">
	<?php echo $this->Form->end(); ?>								
									
	

			