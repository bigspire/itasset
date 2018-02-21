<style type="text/css">
body{background:#fff}
.table-hover tbody tr:hover > td,
.table-hover tbody tr:hover > th {
  background-color: #FCEAEA;
}
.error2{color:#ff0000}
.success{color:#319E21;}
.sel_size{font-weight:bold}
.table-responsive{overflow-x:hidden}
</style>
<script>
$(document).ready(function() {	
		// for previw user in share
		$('.selShirt').click(function(){	
			cls = $(this).attr('rel');	
			$('li').removeClass('active');
			$('.'+cls).addClass('active');
			$('#tshirt').val($(this).attr('rel'));
			// hide error msg
			$('#t_error').hide();
			if($(this).attr('rel') != 'No'){
				$('.sel_size').html($(this).attr('rel').toUpperCase()+' ('+$(this).attr('data-original-title')+')');
			}else{
				$('.sel_size').html('I do not wish to take');
			}
			$('#t_success').show();
		});
		// when form submitted
		$('.frmSub').click(function(){
			if($('#tshirt').val() == ''){
				$('#t_error').show();
			}else{
				$('#t_error').hide();
				$('.divSure').show();
				$('.frmSub').hide();
			}
		});
		// when click not
		$('.frmNo').click(function(){
			$('.divSure').hide();
			$('.frmSub').show();
			$('.sel_size').html('');
			$('#tshirt').val('');
			$('#t_success').hide();
			$('li').removeClass('active');
		});
		// when yes is clicked
		$('.frmYes').click(function(){
			$('.frmYes').html('Processing...');		
			$('.frmYes').attr('disabled', 'disabled');
			$('.frmNo').hide();
			$('#formID').submit();
		});
		// size chart
		$('.toggleChart').click(function(){
			$('.chart').slideToggle();
		});
});
</script>


	<?php echo $this->Form->create('Home', array('type' => '', 'id' => 'formID', 'class' => 'form-horizontal form-column form-bordered')); ?>

<div  id="att_stList">


	<h3 class="header smaller lighter green">Pick your T-Shirt Size</h3>

	<p style="color:#726E6A;text-align:justify;"><span style="font-size:20px;">Hi,</span> in our endeavour to create enhanced visibility for brand <strong>“CareerTree”</strong> the company is taking many initiatives. One such is CTians carrying the brand identity in the T-Shirt. Hence we request you to share the T-Shirt size that you wish to get and wear. 						</p>

<div class="chart" style="float:right;width:225px;margin-top:5px;margin-left:5px;">
	<h4 class="header smaller lighter blue" style="margin-top:0">Size Chart</h4>
	<table class="table table-striped table-bordered table-hover">
		<tr>
		<th>Size</th>
		<th>Shoulder Size (inches)</th>
		</tr>
		<tr>
		<td>S</td>
		<td>32-34</td>
		</tr>
		<tr>
		<td>M</td>
		<td>36-38</td>
		</tr>
		<tr>
		<td>L</td>
		<td>40-42</td>
		</tr>
		<tr>
		<td>XL</td>
		<td>44-46</td>
		</tr>
		<tr>
		<td>XXL</td>
		<td>48-50</td>
		</tr>
		</table>
	</div>


	<!--p> Click one of the boxes below: <a class="toggleChart" href="javascript:void(0)">(Size Chart)</a></p-->

	
		<ul class="pagination" style="margin:15px 0px">
		
												<li class="s">
													<a href="javascript:void(0)" rel="s" class="show-tip selShirt"  title="Small">S</a>
												</li>

												<li class="m">
													<a href="javascript:void(0)" rel="m" class="show-tip selShirt"  title="Medium">M</a>
												</li>

												<li class="l">
													<a href="javascript:void(0)" rel="l" class="show-tip selShirt"  title="Large">L</a>
												</li>

												<li class="xl">
													<a href="javascript:void(0)" rel="xl" class="show-tip selShirt"  title="Extra Large">XL</a>
												</li>

												<li class="xxl">
													<a href="javascript:void(0)" rel="xxl" class="show-tip selShirt"  title="Double Extra Large">XXL</a>
												</li>
<li class="No"> 
													<a href="javascript:void(0)" rel="No" class="selShirt"> I do not wish to take</a>
												</li>
												
											</ul>	
												
		<div class="error2 dn" id="t_error">Please select any one</div>
			<div class="success dn" id="t_success">You have selected : <span class="sel_size"></span></div>
													
								<br>
				<button class="btn btn-sm btn-warning frmSub" type="button" style="">
												<i class="ace-icon fa fa-check"></i>
												Submit
											</button>					
								<br>		
										
			<div class="dn divSure">	<b>Are you sure?</b> <button  type="submit" class="btn-sm btn btn-success frmYes">
												<i class="ace-icon fa fa-check"></i>
												Yes
											</button>
											
											<button type="button" class="btn-sm btn btn-danger frmNo">
												<i class="ace-icon fa fa-check"></i>
												No
											</button>
							</div>				
									</div>
	
	
	<?php echo $this->Form->input('tshirt', array('type' => 'hidden', 'id' => 'tshirt'));?>
	
	<?php echo $this->Form->end(); ?>								
									
</div>		

			