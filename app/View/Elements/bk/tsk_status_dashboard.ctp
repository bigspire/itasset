google.load("visualization", "1", {packages:["corechart"],"callback": drawChart2});
google.setOnLoadCallback(drawChart2);
function drawChart2() {

  var data = google.visualization.arrayToDataTable([
    ['Date', 'Status Pending', 'Status Updated','Upcoming'],
   <?php $comma = ',';  $tot = count($chartDate);
	foreach($chartDate as $key => $date):
	if($tot == ($key+1)): $comma = ''; endif;
	?>
    ['<?php echo date('M-d',strtotime($date));?>',  <?php echo $this->Functions->check_chart_value($statusChart['p'][$key])?>,  <?php echo $this->Functions->check_chart_value($statusChart['u'][$key])?>,  <?php echo $this->Functions->check_chart_value($statusChart['f'][$key])?>]
	<?php echo $comma; 
	endforeach; ?>
  ]);

  var options = {
    title: 'Task Status Report',fontSize:13,titleTextStyle:{color:'#EF4B23'},
	subtitle: 'Sales, Expenses, and Profit: 2014-2017',
    hAxis: {title: 'Date', textStyle: {  fontSize: '11',color:'#4C4848'},  titleTextStyle: {color: '#969393',fontSize:12}},
	vAxis: {title: 'No. of Tasks',textStyle: {  fontSize: '11', color:'#4C4848'}, titleTextStyle: {color: '#969393',fontSize:12}},
	isStacked: true,
	colors: ['#F25757', '#2EC943', '#F2CD3A'],
	legend: { position: 'right',textStyle: {fontSize: 11} },
	chartArea: {width: '60%'}
  };
  
  

  var chart = new google.visualization.ColumnChart(document.getElementById('chart_div2'));

  chart.draw(data, options);

}