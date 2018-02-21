<style>
#HomeCalendarDefault{float:left !important;width:58% !important;margin-left:10px;border-right:1px solid #E8E8E8; border-radius:0px;}
.eventCalendar-wrap{border:none;box-shadow:none;width:58% !important;}
.eventsCalendar-monthWrap{width:42% !important;}
.eventsCalendar-list-wrap{position: absolute;left: 47%;top: 5px;width:400px !important;}
.eventsCalendar-list-content{width:400px;}
.eventsCalendar-list-content.scrollables{width:368px}
.monthTitle{cursor:default;color:#000 !important}
.eventCalendar-wrap .arrow span{border:none !important}
.widget-header{border:1px solid #efefef;}
.tsk_title{color:#4C4848}
.loadChart{margin-left:20px !important;float:left;}
.label-gree{background:#ce0aaa !important;color:#fff}

</style>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
google.load("visualization", "1", {packages:["corechart"],"callback": drawChart});
google.setOnLoadCallback(drawChart);

function drawChart() {

  var data = google.visualization.arrayToDataTable([
    ['Date', 'Planned', 'Unplanned', 'Not Planned'],
	<?php $comma = ',';  $tot = count($chartDate);
	foreach($chartDate as $key => $date):
	if($tot == ($key+1)): $comma = ''; endif;
	$planned_split = explode('|', $plannedHr[$key]);
	?>
    ['<?php echo date('M-d',strtotime($date));?>',  <?php echo $planned = $planned_split[0];?>,  <?php echo $unplanned = $planned_split[1];?>,    <?php echo $this->Functions->check_max_planned(8 - ($planned + $unplanned));?>]
	<?php echo $comma; 
	endforeach; ?>
  ]);


 <?php $exp_date1 = explode('-', $chartDate[0]); $exp_date2 = explode('-', $chartDate[4]);?>
  var options = {
    title: 'Daily Planning Report',fontSize:13,titleTextStyle:{color:'#EF4B23'},
    hAxis: {title: 'Date',textStyle: {  fontSize: '11',color:'#4C4848'},  titleTextStyle: {color: '#969393',fontSize:12}},
	vAxis: {title: 'Task Hours', textStyle: {  fontSize: '11',color:'#4C4848'},  format: '#\' hr\'',  titleTextStyle: {color: '#969393',fontSize:12}},
	isStacked: true,
	colors: ['#18D315', '#FCD96F','#D9DBD9'],
	legend: { position: 'right',  textStyle: {fontSize: 11} },
	pointSize: 5,
	chartArea: {width: '60%'}
  };
  
  
  var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));

  chart.draw(data, options);

}
	<?php $month_plan = explode('|',$overallmChart);?>
   google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart2);
      function drawChart2() {
        var data = google.visualization.arrayToDataTable([
          ['Employee Name', '# of new business'],
          ['Planned Hrs',  <?php echo $month_plan[0];?>],
          ['Unplanned Hrs',  <?php echo $month_plan[1];?>],
          
        ]);

      var options = {
        legend: {position: 'bottom',textStyle: {fontSize: 11}},
		is3D: true,
        title: 'FTM, <?php echo date('M').' - '.date('Y');?>',fontSize:13,titleTextStyle:{color:'#EF4B23'},
		colors: ['#18D315', '#FCD96F','#D9DBD9']
      };
		var my_div = document.getElementById('chart_div2');
        var chart = new google.visualization.PieChart(document.getElementById('chart_div2'));		
        chart.draw(data, options);
      }
	  
	<?php $year_plan = explode('|',$overallyChart);?>
   google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart3);
      function drawChart3() {
        var data = google.visualization.arrayToDataTable([
          ['Employee Name', '# of new business'],
          ['Planned Hrs',  <?php echo $year_plan[0];?>],
          ['Unplanned Hrs',  <?php echo $year_plan[1];?>],
          
        ]);

      var options = {
        legend: {position: 'bottom', textStyle: {fontSize: 11}},
		is3D: true,
		colors: ['#18D315', '#FCD96F','#D9DBD9'],
        title: 'FTY, <?php echo date('Y');?>',fontSize:13,titleTextStyle:{color:'#EF4B23'},
      };
		var my_div = document.getElementById('chart_div3');
        var chart = new google.visualization.PieChart(document.getElementById('chart_div3'));		
        chart.draw(data, options);
      }
    </script>


 <div class="widget-box">
											<div class="widget-header widget-header-flat widget-header-small">
												<h5 class="widget-title">
													<i class="ace-icon fa fa-signal"></i>
													Tasks Overview
													
						<a style="float:right;margin-right:80px;" href="<?php echo $this->webroot;?>home/task_report/" class="iframeBox" val="85_80"><span class="label label-pink arrowed-right"><i class="icon-bar-chart"></i> Task Report</span></a>
						<a style="float:right;margin-right:30px;" href="<?php echo $this->webroot;?>home/fin_report/" class="iframeBox" val="45_45"><span class="label label-grey arrowed-right" title="Finance Report"><i class="icon-money"></i> Fin. Report</span></a>
						<a style="float:right;margin-right:30px;" href="<?php echo $this->webroot;?>home/tabbed_call/voice/voice/" class="iframeBox" val="45_55"><span class="label label-success arrowed-right" title="Poll"><i class="icon-thumbs-up-alt"></i> Voice <span><?php if($poll_count): echo '<span class="badge badge-warning" style="padding-bottom:0;">'.$poll_count.'</span>'; endif; ?></span></span></a>
						<a style="float:right;margin-right:30px;" href="<?php echo $this->webroot;?>home/tabbed_call/eventP/event/" class="iframeBox" val="85_85"><span class="label label-warning arrowed-right" title="My Events"><i class="icon-time"></i> Events <span><?php if($event_count): echo '<span class="badge badge-success" style="padding-bottom:0;">'.$event_count.'</span>'; endif; ?></span></span></a>
						<a style="float:right;margin-right:30px;" href="<?php echo $this->webroot;?>home/budget/" class="iframeBox" val="55_75"><span class="label label-gree" title="Budget"><i class="icon-money"></i> Budget - July 2016 <span>
						<?php // if($event_count): echo '<span class="badge badge-success" style="padding-bottom:0;">'.$event_count.'</span>'; endif; ?></span></span></a>

												</h5>

												
											</div>

											<div class="widget-body" style="border-left:1px solid #efefef;border-right:1px solid #efefef;">
												<div class="widget-main"  style="height:370px;">
							<div id="HomeCalendarDefault" class="homeCal" style="width:58%;height:350px;"></div>
<?php //if($this->request->data['refresh'] != 1):?>
<!--div class="loadChart">Loading chart.. Pls wait.. <img src="<?php echo $this->webroot;?>img/loading.gif"/></span></div-->						
<?php //endif; ?>
						<div id="chart_div" style="margin-left:10px;float:left;width:35%;height: 168px;"></div>
						
						<div id="chart_div2" style="margin-left:15px;float:left;width:17.5%;height: 168px;margin-top:10px;border-right:1px solid #efefef;"></div>
						<div id="chart_div3" style="margin-left:10px;float:left;width:17.5%;height: 168px;margin-top:10px;"></div>						
						
												
												</div><!-- /.widget-main -->
											</div><!-- /.widget-body -->
										
										
										</div>
										
	





