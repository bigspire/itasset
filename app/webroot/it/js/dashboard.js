 <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart(){
        var data = google.visualization.arrayToDataTable([
          ['Software', 'No.'],
          ['Windows 8',     11],
          ['Windows XP',      2],
          ['Windows 10',  2],
          ['Ubuntu', 2],
          ['Windows Server 2010',    7]
        ]);

        var options = {
          title: 'Software Details',
          pieHole: 0.4,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);
      }
	  
      google.charts.setOnLoadCallback(drawChart2);
      function drawChart2(){
        var data = google.visualization.arrayToDataTable([
          ['Hardware', 'No.'],
          ['Desktop',     41],
          ['Laptops',      22],
          ['WiFi Data Card',  8],
          ['Mobile', 2],
          ['Tabs',    17]
        ]);

        var options = {
          title: 'Hardware Details',
          pieHole: 0.4,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart2'));
        chart.draw(data, options);
      }
	  
	  google.charts.setOnLoadCallback(drawChart3);
      function drawChart3(){
        var data = google.visualization.arrayToDataTable([
          ['Status', 'No.'],
          ['Open',     11],
          ['Closed',      34],
          ['Re-Open',  8],
          ['Hold', 4],
          ['Pending',    5]
        ]);

        var options = {
          title: 'Ticket Details',
          pieHole: 0.4,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart3'));
        chart.draw(data, options);
      }
	  
	  google.charts.setOnLoadCallback(drawChart4);
      function drawChart4(){
        var data = google.visualization.arrayToDataTable([
          ['Status', 'No.'],
          ['Pending',     4],
          ['Changed',      10],
        ]);

        var options = {
          title: 'Request Change',
          pieHole: 0.4,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart4'));
        chart.draw(data, options);
      }
    </script>