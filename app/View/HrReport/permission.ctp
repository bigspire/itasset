 <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
       google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
         ['Month', 'Awaiting Approval', 'Approved', 'Rejected'],
          ['Jan',  14,      9, 0],
          ['Feb',  22,      3, 1],
          ['Mar',  23,       6, 3],
          ['Apr',  34,      2, 1],
		  ['May',  12,      7, 1],
		  ['Jun',  8,      2, 2]
        ]);

        var options = {
          title: 'Leave',
          hAxis: {title: 'Month', titleTextStyle: {color: 'red'}},
		  colors: ['#3366CC', '#55C613', '#DC3912']
		  
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('per_div'));			  
        chart.draw(data, options);
		document.getElementById('per_png').outerHTML = '<a target="_blank" style="color:#fff" href="' + chart.getImageURI() + '">Print</a>';
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
						<h1>Permission Reports</h1>
						
						
					</div>
					
				
				
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>hrhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						
						
						<li>
							<a href="<?php echo $this->webroot;?>hrreport/permission/">Permission Reports</a>
							
						</li>
						
						
					</ul>
					
				</div>
				
					<?php echo $this->element('report_search'); ?>
					
					
					<?php echo $this->Session->flash();?>
				
					<div class="row-fluid  footer_div" >
					<div class="span12" >
						<div  class="box box-bordered box-color">
						
						<div class="box-title">
								<h3><i class="icon-bar-chart"></i> Permission Reports </h3>
							</div>
							
						

							<div class="box-content">
							<div id="per_div" style="width: 900px; height: 350px;"></div>
							
							
							
							 <div style="margin-left:10px;margin-bottom:10px;margin-left:100px;">
							 <button  class="btn btn-primary"><i class="icon-print"></i>  <a id="per_png"></a></button>
							  <button  class="btn btn-primary"><i class="icon-reply"></i>  Export</button>
						
						 
						   </div> </div>
						 
					
						</div>
					
					
					
					
					
					
					
					</div>
				</div>
					
				
				
				</div>
		
			
			</div>
			

		</div>	
			
		
		
		
		
				
		


