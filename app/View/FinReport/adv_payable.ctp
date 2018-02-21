 <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
       google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Month', 'Pending', 'Paid'],
		  ['Jan',  50000,      40000],
          ['Feb',  10000,      2000],
          ['Mar',  20000,       444],
          ['Apr',  3000,      1000],
		  ['May',  4000,      40000],
		  ['Jun',  23000,      20000]
        ]);

        var options = {
          title: 'Advance Payable Reports',
          hAxis: {title: 'Month', titleTextStyle: {color: 'red'}},
		  colors: ['#3366CC', '#55C613']
		  
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('att_div'));			  
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
						<h1>Advance Payable Reports</h1>
						
						
					</div>
					
				
				
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>finhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						
						
						<li>
							<a href="<?php echo $this->webroot;?>finreport/adv_payable/">Advance Payable</a>
							
						</li>
						
						
					</ul>
					
				</div>
				
					<?php echo $this->element('report_search'); ?>
					
					
					<?php echo $this->Session->flash();?>
				
					<div class="row-fluid  footer_div" >
					<div class="span12" >
						<div  class="box box-bordered box-color">
						
						<div class="box-title">
								<h3><i class="icon-bar-chart"></i> Advance Payable Reports </h3>
							</div>
							
						

							<div class="box-content">
							<div id="att_div" style="width: 900px; height: 350px;"></div>
							
							
							
							 </div>
						 
					
						</div>
					
					
					
					
					
					
					
					</div>
				</div>
					
				
				
				</div>
		
			
			</div>
			

		</div>	
			
		
		
		
		
				
		


