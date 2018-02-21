<div id="container" style="width: 700px; height: 400px; margin: 0 auto;"></div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script language="JavaScript">
google.charts.load('current', {packages: ['corechart','line']});  

function drawChart() {
   
   var data = new google.visualization.DataTable();
   data.addColumn('string', 'verticals');
   data.addColumn('number', 'Budget(Rs.)');
   data.addColumn('number', 'Budget(Rs.)- Revised');
   data.addColumn('number', 'Actual(Rs.)');

   data.addRows([
      ['CHE-ES',  3333333, 5423524,790468],
      ['CHE-FLR', 3333333, 7130834,277669],
      ['OD',  1666667,3567678, 554600],
      ['TS(DIRECT)',  1000000, 1329716,64957],
      ['TS(INDIRECT)',  13333333, 13333333, 409894],
      ['JOBFAC',  100000, 223141, 22610]
      
   ]);
   
   // Set chart options
   var options = {'title' : 'Sales Budget Vs Actuals JULY 16 (FY 16-17)',
      hAxis: {
         title: ''
      },
      vAxis: {
         title: ''
      },   
     
      'height':400,
	  legend: 'none',
      pointsVisible: true	  
   };

   // Instantiate and draw the chart.
   var chart = new google.visualization.LineChart(document.getElementById('container'));
   chart.draw(data, options);
}
google.charts.setOnLoadCallback(drawChart);
</script>
