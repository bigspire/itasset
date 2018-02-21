 <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Month', 'Present', 'Absent', 'Late attendance'],
          ['Jan',  23,  20,    10],
          ['Feb',  32,  15,    5],
          ['Mar',  25,  12,    12],
          ['Apr',  33, 10,     4],
		  ['May',  32,  7,    1],
		  ['Jun',  28,  2,     8]
        ]);

        var options = {
          title: 'Attendance Report (Jan, 2014 to Jun, 2014)',
          hAxis: {title: 'Month', titleTextStyle: {color: 'red'}},
		   vAxis: {title: 'No. of Days', titleTextStyle: {color: 'red'}},
		    colors: ['#55C613', '#FF9900', '#DC3912']
		  
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
          ['Chennai Branch', 'No. of Days'],
          ['Present',     11],
          ['Absent',      2],
          ['Late Attendance',  2],
         
        ]);

		var options = {
          title: 'Attendance Report - Chennai Branch (09 Jun to 15 Jun)',
          is3D: true,
		   colors: ['#55C613', '#FF9900', '#DC3912']
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);
      }
	 
		 google.setOnLoadCallback(drawChart3);
      function drawChart3() {
        var data = google.visualization.arrayToDataTable([
          ['Days', 'Present', 'Absent', 'Late attendance'],
          ['09-Jun',  23,  20,    10],
          ['10-Jun',  32,  15,    5],
          ['11-Jun',  25,  12,    12],
          ['12-Jun',  33, 10,     4],
		  ['13-Jun',  32,  7,    1],
		  ['14-Jun',  28,  2,     8],
		  ['15-Jun',  18,  4,     8]
        ]);

        var options = {
          title: 'Attendance Report (09 Jun to 15 Jun)',
          hAxis: {title: 'Date', titleTextStyle: {color: 'red'}},
		   vAxis: {title: 'No. of Days', titleTextStyle: {color: 'red'}},
		    colors: ['#55C613', '#FF9900', '#DC3912']
		  
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('days_div'));
		
		/*google.visualization.events.addListener(chart, 'ready', function () {
			att_div.innerHTML = '<img src="' + chart.getImageURI() + '">';
		});*/		  
        chart.draw(data, options);
		 document.getElementById('png').outerHTML = '<a target="_blank" style="color:#fff" href="' + chart.getImageURI() + '">Print</a>';
      }
	  
	 

    </script>
	
<?php echo $this->element('hr_menu'); ?>
		
		
		<span id="top_row" ></span>
		
	<div class="container-fluid" id="content">
	
	<?php echo $this->element('report_left') ?>
		
		<div id="main"  class="" style="margin-left:200px">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Attendance Reports</h1>
						
						
					</div>
					
				
				
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>hrhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						
						
						<li>
							<a href="<?php echo $this->webroot;?>hrreport/attendance/">Attendance Reports</a>
							
						</li>
						
						
					</ul>
					
				</div>
				
					<?php echo $this->element('report_search'); ?>
					
					
					<?php echo $this->Session->flash();?>
				
					<div class="row-fluid  footer_div" >
					<div class="span12" >
						<div  class="box box-bordered box-color">
						
						<div class="box-title">
								<h3><i class="icon-bar-chart"></i> Attendance Report </h3>
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
											In Time
											
												</th>
											
											<th>Out Time</th>
											<th>Late Reason</th>											
											<th>Approver</th>
											<th>Status</th>
										</tr>
									</thead>
									<tbody>
									
										
									
										<?php  //foreach($latest_data as $latest):?>
										
										<tr>
											
											<td>Jawahar</td>
											
														<td>12-Jun-2014</td>
											
											<td>09:30 am</td>
											<td>07:14 pm</td>
											<td>-</td>
											<td>Vinoth</td>
												<td><span class="green">Approved</span></td>
										
										</tr>
										
										
										<tr>
											
											<td>Jawahar</td>
											
														<td>12-Jun-2014</td>
											
											<td>09:30 am</td>
											<td>07:14 pm</td>
											<td>Traffic</td>
											<td>Vinoth</td>
												<td><span class="green">Approved</span></td>
										
										</tr>
										
										
										
										<tr>
											
											<td>Jawahar</td>
											
														<td>12-Jun-2014</td>
											
											<td>09:30 am</td>
											<td>07:14 pm</td>
											<td>-</td>
											<td>Vinoth</td>
											<td><span class="green">Approved</span></td>
										
										</tr>
										
										
										<tr>
											
											<td>Jawahar</td>
											
														<td>12-Jun-2014</td>
											
											<td>09:30 am</td>
											<td>07:14 pm</td>
											<td>Bus late</td>
											<td>Vinoth</td>
												<td><span class="green">Approved</span></td>
										
										</tr>
										
										
										<tr>
											
											<td>Jawahar</td>
											
														<td>12-Jun-2014</td>
											
											<td>09:30 am</td>
											<td>07:14 pm</td>
											<td>-</td>
											<td>Vinoth</td>
												<td><span class="green">Approved</span></td>
										
										</tr>
										
										<tr>
											
											<td>Jawahar</td>
											
														<td>12-Jun-2014</td>
											
											<td>09:30 am</td>
											<td>07:14 pm</td>
											<td>Got permission</td>
											<td>Vinoth</td>
												<td><span class="red">Rejected</span></td>
										
										</tr>
										
										<tr>
											
											<td>Jawahar</td>
											
														<td>12-Jun-2014</td>
											
											<td>09:30 am</td>
											<td>07:14 pm</td>
											<td>-</td>
											<td>Vinoth</td>
											<td><span class="green">Approved</span></td>
										
										</tr>
										
										<tr>
											
											<td>Jawahar</td>
											
														<td>12-Jun-2014</td>
											
											<td>09:30 am</td>
											<td>07:14 pm</td>
											<td>-</td>
											<td>Vinoth</td>
											<td><span class="green">Approved</span></td>
										
										</tr>
										
										
										<tr>
											
											<td>Jawahar</td>
											
														<td>12-Jun-2014</td>
											
											<td>09:30 am</td>
											<td>07:14 pm</td>
											<td>-</td>
											<td>Vinoth</td>
											<td><span class="green">Approved</span></td>
										</tr>
										
										
										<tr>
											
											<td>Jawahar</td>
											
														<td>12-Jun-2014</td>
											
											<td>09:30 am</td>
											<td>07:14 pm</td>
											<td>-</td>
											<td>Vinoth</td>
											<td><span class="green">Approved</span></td>
										
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
			
		
		
		
		
				
		


