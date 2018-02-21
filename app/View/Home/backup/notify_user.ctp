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
We are introducing a new feature called “Employee Opinion Survey” in our MyPDCA.</span></p>


<p style="color:#726E6A;text-align:justify;">


We will begin the first survey by capturing your opinions / views to formulate the Business Plan of CareerTree in 2015-16.

<div style="float:left;margin-top:5px;">Expect your total participation and contribution!</div> 
 
<div style="float:right;margin-right:60px"><img src="<?php echo $this->webroot;?>img/survey_help.png" height="250"/></div>

	</p>
		
							</div>				
							<br><br><br>	
<button class="btn btn-sm btn-success close_fancy" type="submit" style="">
												<i class="ace-icon fa fa-check"></i>
												OK, GOT IT
											</button>		
	
	<input type="hidden" value="<?php echo $this->webroot;?>" id="web">
	<?php echo $this->Form->end(); ?>								
									
	

			