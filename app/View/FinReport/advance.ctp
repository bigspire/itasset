 <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
         var data = google.visualization.arrayToDataTable([
         ['Month', 'Pending', 'Approved', 'Rejected'],
        ['Jan',  50000,      40000, 0 ],
          ['Feb',  10000,      2000, 1000],
          ['Mar',  20000,       4444, 0],
          ['Apr',  3000,      1000, 0],
		  ['May',  4000,      40000, 0],
		  ['Jun',  23000,      20000, 3000]
        ]);

        var options = {
          title: 'Advance Report (Jan, 2014 to Jun, 2014)',
          hAxis: {title: 'Month', titleTextStyle: {color: 'red'}},
		   vAxis: {title: 'Amount (INR)', titleTextStyle: {color: 'red'}},
		    colors: ['#FF9900', '#55C613', '#DC3912']
		  
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('att_div'));
		
		/*google.visualization.events.addListener(chart, 'ready', function () {
			att_div.innerHTML = '<img src="' + chart.getImageURI() + '">';
		});*/		  
        chart.draw(data, options);
		 document.getElementById('png').outerHTML = '<a target="_blank" style="color:#fff" href="' + chart.getImageURI() + '">Print</a>';
      }
	  
	  
	   google.setOnLoadCallback(drawChart2);
      function drawChart2() {
         var data = google.visualization.arrayToDataTable([
          ['Chennai Branch', 'No. of Requests'],
          ['Pending',     48000],
          ['Approved',      200000],
          ['Rejected',  10000],
         
        ]);

		var options = {
          title: 'Advance Report - Chennai Branch (09 Jun to 15 Jun)',
          is3D: true,
		   colors: ['#FF9900', '#55C613', '#DC3912']
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);
      }
	 
		 google.setOnLoadCallback(drawChart3);
      function drawChart3() {
         var data = google.visualization.arrayToDataTable([
         ['Date', 'Pending', 'Approved', 'Rejected'],
           ['02-08, Jun',  45000,  240000,    1000],
          ['09-15, Jun',  25000,  20000,    5440],
          ['16-22, Jun',  2345,  2000,    1220],
          ['23-30, Jun',  65000, 45000,     3440],
        ]);

        var options = {
          title: 'Advance Report (01 Jun to 30 Jun)',
          hAxis: {title: 'Week', titleTextStyle: {color: 'red'}},
		   vAxis: {title: 'Amount (INR)', titleTextStyle: {color: 'red'}},
		    colors: ['#FF9900', '#55C613', '#DC3912']
		  
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('days_div'));
		
		/*google.visualization.events.addListener(chart, 'ready', function () {
			att_div.innerHTML = '<img src="' + chart.getImageURI() + '">';
		});*/		  
        chart.draw(data, options);
		 document.getElementById('png').outerHTML = '<a target="_blank" style="color:#fff" href="' + chart.getImageURI() + '">Print</a>';
      }
	  
	 

    </script>
	
<?php echo $this->element('fin_menu'); ?>
		
		
		<span id="top_row" ></span>
		
	<div class="container-fluid" id="content">
	
	<?php echo $this->element('report_left') ?>
		
		<div id="main"  class="" style="margin-left:200px">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Advance Reports</h1>
						
						
					</div>
					
				
				
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>finhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						
						
						<li>
							<a href="<?php echo $this->webroot;?>finreport/advance/">Advance Reports</a>
							
						</li>
						
						
					</ul>
					
				</div>
				
					<?php echo $this->element('report_search'); ?>
					
					
					<?php echo $this->Session->flash();?>
				
					<div class="row-fluid  footer_div" >
					<div class="span12" >
						<div  class="box box-bordered box-color">
						
						<div class="box-title">
								<h3><i class="icon-bar-chart"></i> Advance Report </h3>
								<div class="actions">
									<input type="checkbox" checked="checked" style="margin:0"> <a style="margin-top:2px" href="#" class="checkbox-active">Graph View</a>
								</div>
							</div>
							
						

							<div class="box-content">
							
							 <div id="days_div" style="width: 900px; height: 350px;"></div>
							 
							 
							<div id="att_div" style="width: 900px; height: 350px;"></div>
							
							
							  <div id="piechart" style="width: 900px; height: 500px;"></div>
							  
							 
					
					<div class="dataTables_wrapper">
							<table class="table table-hover table-nomargin table-condensed">
									<thead>
										
										<tr>
											
											<th>
											Employee
												</th>
												
												<th >
											Date
												</th>
													
											
										
												
												<th>
											Adv. No.
											
												</th>
											
											<th>Amount (Rs)</th>
											<th>Purpose</th>											
											<th>Pending</th>
											<th>Status</th>
										</tr>
									</thead>
									<tbody>
									
										
									
										<?php  //foreach($latest_data as $latest):?>
										
										<tr>
											
											<td>Jawahar</td>
											
														<td>12-Jun-2014</td>
											
											<td>123</td>
											<td>5000</td>
											<td><a href="#">Rajastan recruitment process</a></td>
											<td>4 days</td>
												<td><span class="green">
												<span class="label label-satgreen"><a href="#" rel="tooltip" data-original-title="Karthikeyan,  (Approved)<br> 23-May-2014">L1 - A</a></span>
												
												</span></td>
										
										</tr>
										
										
										<tr>
											
											<td>Jawahar</td>
											
														<td>12-Jun-2014</td>
											
											<td>123</td>
											<td>5000</td>
											<td><a href="#">Rajastan recruitment process</a></td>
											<td>4 days</td>
												<td><span class="green">
												<span class="label label-satgreen"><a href="#" rel="tooltip" data-original-title="Karthikeyan,  (Approved)<br> 23-May-2014">L1 - A</a></span>
												
												</span></td>
										
										</tr>
										
										<tr>
											
											<td>Jawahar</td>
											
														<td>12-Jun-2014</td>
											
											<td>123</td>
											<td>5000</td>
											<td><a href="#">Rajastan recruitment process</a></td>
											<td>4 days</td>
												<td><span class="green">
												<span class="label label-satgreen"><a href="#" rel="tooltip" data-original-title="Karthikeyan,  (Approved)<br> 23-May-2014">L1 - A</a></span>
												
												</span></td>
										
										</tr>
										
										<tr>
											
											<td>Jawahar</td>
											
														<td>12-Jun-2014</td>
											
											<td>123</td>
											<td>5000</td>
											<td><a href="#">Rajastan recruitment process</a></td>
											<td>4 days</td>
												<td><span class="green">
												<span class="label label-satgreen"><a href="#" rel="tooltip" data-original-title="Karthikeyan,  (Approved)<br> 23-May-2014">L1 - A</a></span>
												
												</span></td>
										
										</tr>
										<tr>
											
											<td>Jawahar</td>
											
														<td>12-Jun-2014</td>
											
											<td>123</td>
											<td>5000</td>
											<td><a href="#">Rajastan recruitment process</a></td>
											<td>4 days</td>
												<td><span class="green">
												<span class="label label-satgreen"><a href="#" rel="tooltip" data-original-title="Karthikeyan,  (Approved)<br> 23-May-2014">L1 - A</a></span>
												
												</span></td>
										
										</tr>
										<tr>
											
											<td>Jawahar</td>
											
														<td>12-Jun-2014</td>
											
											<td>123</td>
											<td>5000</td>
											<td><a href="#">Rajastan recruitment process</a></td>
											<td>4 days</td>
												<td><span class="green">
												<span class="label label-satgreen"><a href="#" rel="tooltip" data-original-title="Karthikeyan,  (Approved)<br> 23-May-2014">L1 - A</a></span>
												
												</span></td>
										
										</tr>
										<tr>
											
											<td>Jawahar</td>
											
														<td>12-Jun-2014</td>
											
											<td>123</td>
											<td>5000</td>
											<td><a href="#">Rajastan recruitment process</a></td>
											<td>4 days</td>
												<td><span class="green">
												<span class="label label-satgreen"><a href="#" rel="tooltip" data-original-title="Karthikeyan,  (Approved)<br> 23-May-2014">L1 - A</a></span>
												
												</span></td>
										
										</tr>
										<tr>
											
											<td>Jawahar</td>
											
														<td>12-Jun-2014</td>
											
											<td>123</td>
											<td>5000</td>
											<td><a href="#">Rajastan recruitment process</a></td>
											<td>4 days</td>
												<td><span class="green">
												<span class="label label-satgreen"><a href="#" rel="tooltip" data-original-title="Karthikeyan,  (Approved)<br> 23-May-2014">L1 - A</a></span>
												
												</span></td>
										
										</tr>
										
										<tr>
											
											<td>Jawahar</td>
											
														<td>12-Jun-2014</td>
											
											<td>123</td>
											<td>5000</td>
											<td><a href="#">Rajastan recruitment process</a></td>
											<td>4 days</td>
												<td><span class="green">
												<span class="label label-satgreen"><a href="#" rel="tooltip" data-original-title="Karthikeyan,  (Approved)<br> 23-May-2014">L1 - A</a></span>
												
												</span></td>
										
										</tr>
										
										<tr>
											
											<td>Jawahar</td>
											
														<td>12-Jun-2014</td>
											
											<td>123</td>
											<td>5000</td>
											<td><a href="#">Rajastan recruitment process</a></td>
											<td>4 days</td>
												<td><span class="green">
												<span class="label label-satgreen"><a href="#" rel="tooltip" data-original-title="Karthikeyan,  (Approved)<br> 23-May-2014">L1 - A</a></span>
												
												</span></td>
										
										</tr>
									<?php // endforeach; ?>
									</tbody>
								</table>
									
									
									
									
									<?php echo $this->element('paging');?>
									
									
									<div class="dataTables_info" id="DataTables_Table_8_info">

Page <span>1</span> of <span>2</span> Total: <span>12</span>

	 
	</div>
	
	
									<div class="dataTables_paginate paging_full_numbers" id="DataTables_Table_8_paginate">

<span class="paginate_button">Previous </span>

<span>

<a>1</a> <a href="/ceo_apps/hrattchange/index/page:2/sort:HrAttChange.created_date/direction:desc">2</a>
</span>


<span class="next"><a href="/ceo_apps/hrattchange/index/page:2/sort:HrAttChange.created_date/direction:desc" rel="next"> Next</a></span><span class="next"><a href="/ceo_apps/hrattchange/index/page:2/sort:HrAttChange.created_date/direction:desc" rel="next"> Last</a></span>


</div>

</div>

						   </div>
						 
					
						</div>
					
					
					
					
					
					
					
					</div>
				</div>
					
				
				
				</div>
		
			
			</div>
			

		</div>	
			
		
		
		
		
				
		


