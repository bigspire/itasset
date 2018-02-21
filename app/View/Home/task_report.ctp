 <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
     google.load("visualization", "1", {packages:["corechart"]});
	 
	  // for monthly report
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
		  <?php foreach($month_task_data as $data):?>
          ['<?php echo $data['tp']['title'];?>',     <?php echo $data[0]['count'];?>],        
		  <?php endforeach; ?>
        ]);

        var options = {
          title: 'Tasks - FTM, <?php echo $month_val;?> - <?php echo $year_val;?>',
          pieHole: 0.4,
		  titleTextStyle:{fontSize: 14},
		  tooltip:{text: 'percentage'},
		  legend:{ textStyle: {fontSize: 11}}
		  
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
      }
	  
	  // for yearly report
	  
	  google.setOnLoadCallback(drawChart2);
      function drawChart2() {
         var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
		  <?php foreach($year_task_data as $data):?>
          ['<?php echo $data['tp']['title'];?>',     <?php echo $data[0]['count'];?>],        
		  <?php endforeach; ?>
        ]);

        var options = {
          title: 'Tasks - FTY, <?php echo $year_val;?>',
          pieHole: 0.4,
		  titleTextStyle:{fontSize: 14,},
		  tooltip:{text: 'percentage'},
		  legend:{ textStyle: {fontSize: 11}}
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart2'));
        chart.draw(data, options);
      }
	 
    </script>
	
	<div class="">
	<div class="modal-dialog" style="width:100%">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Task Report - <?php echo $year_val ? $year_val : date('Y'); ?></h4>
        </div><div class="container"></div>
        <div class="modal-body">
        
		
				 <div class="user-profile row" align="center">
		
<div class="widget-body" style="border:none" ><div class="widget-body-inner" style="display: block;">
												<div class="widget-main no-padding">
						<div class="donutchart" id="donutchart" style="float:left;margin-left:20px;width: 500px; height: 300px; border:1px solid #efefef;"></div>
						<div class="donutchart2" id="donutchart2" style="float:left;margin-left:20px;width: 500px; height: 300px;border:1px solid #efefef;"></div>						
												</div><!-- /widget-main -->
											</div></div>
									</div>
        
		
        </div>
       
      </div>
    </div>
</div>
