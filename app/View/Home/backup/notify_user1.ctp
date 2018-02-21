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
<b><u>Leave Policy Changes (eff. Jan'15)</u></b></span></p>
<ol class="notify_user" style="font-size:13px;">
<li>Employee Birthday and Wedding day will be declared as "Happy Leave".</li>
<li>Unused NBL at the end of calendar year will also be brought under encashable option (however, the encashment model will be different from that of PL).</li>
<li>Total no. of NBL changed from 15 to 12 days per year.</li>
<li>Max 2 leave applications per month is only allowed.</li>
<li>Is someone works during the Happy Leaves day (s)he is eligible for Comp Off.</li>
<li>PL leave application intimation changed from 15 days to 7 days</li>
</ol>

<p style="color:#726E6A;text-align:justify;"><span style="font-size:15px;">
<b><u>Attendance Policy Changes (eff. Jan'15)</u></b></span></p>
<ol class="notify_user" style="font-size:13px;">
<li>Late coming of every 180 mins at any time during the year (from Jan'15 onwards the late coming hours will be accumulated
 and not calculated on month basis) will lead to a day LOP.</li>

</ol>	
		
							</div>				
							<br>	
<button class="btn btn-sm btn-success close_fancy" type="submit" style="">
												<i class="ace-icon fa fa-check"></i>
												READ & UNDERSTOOD
											</button>		
	
	<input type="hidden" value="<?php echo $this->webroot;?>" id="web">
	<?php echo $this->Form->end(); ?>								
									
	

			