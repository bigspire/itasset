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
          title: 'Expense Report',
          hAxis: {title: 'Month', titleTextStyle: {color: 'red'}},
		   vAxis: {title: 'Amount (INR)', titleTextStyle: {color: 'red'}},
		  colors: ['#3366CC', '#55C613', '#DC3912']
		  
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('leave_div'));			  
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
						<h1>Expense Reports</h1>
						
						
					</div>
					
				
				
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>finhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						
						
						<li>
							<a href="<?php echo $this->webroot;?>finreport/expense/">Expense Reports</a>
							
						</li>
						
						
					</ul>
					
				</div>
				
					<?php echo $this->element('report_search'); ?>
					
					
					<?php echo $this->Session->flash();?>
				
					<div class="row-fluid  footer_div" >
					<div class="span12" >
						<div  class="box box-bordered box-color">
						
						<div class="box-title">
								<h3><i class="icon-bar-chart"></i> Expense Reports </h3>
							</div>
							
						

							<div class="box-content">
							<div id="leave_div" style="width: 900px; height: 350px;"></div>
							
							
							
							 </div>
						 
					
						</div>
					
					
					
					
					
					
					
					</div>
				</div>
					
				
				
				</div>
		
			
			</div>
			

		</div>	
			
		
		
		
		
				
		


