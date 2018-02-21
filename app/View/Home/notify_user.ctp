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

<p style="color:#726E6A;text-align:justify;"><span style="font-size:14px;">
This time the Performance Goals of each CTian for FY15-16 is clearly aligned to his/her Role & Responsibilities. 
You can see the Career Level Chart displayed in the <b>CTians Tab </b> in the Home Page to understand where you stand and 
what’s the path ahead for you in your career at CareerTree. The Job Description for each role will soon be displayed in the same module</span></p>


<p style="color:#726E6A;text-align:justify;">



 

	</p>
		
							</div>				
							<br><br>	
<button class="btn btn-sm btn-success close_fancy" type="submit" style="">
												<i class="ace-icon fa fa-check"></i>
												OK, GOT IT
											</button>		
	
	<input type="hidden" value="<?php echo $this->webroot;?>" id="web">
	<?php echo $this->Form->end(); ?>								
									
	

			