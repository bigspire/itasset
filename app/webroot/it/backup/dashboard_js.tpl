
{literal} 
 <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
       {/literal}
		 {if $dt_1}
		 {literal} 
      google.charts.setOnLoadCallback(drawChart1);     
      function drawChart1(){
        var data = google.visualization.arrayToDataTable([
          ['Software', 'No.'], 
		 	{/literal}	  	 
		  	{foreach from = $data_sw_type item = rec}
          ['{$rec.title} ({$rec.edition})',  {$rec.count}],
		  	{/foreach}
		  	{literal}    
        ]);

        var options = {
		   chartArea:{left:0},
           title: '',
           pieHole: 0.4,
		   fontSize: 12,
		   legend:{position: 'right',width:'100%',  textStyle: { fontSize: 12}}
		  
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart1'));
        chart.draw(data, options);
      }
       {/literal}
		 {/if}
		 {if $dt_2}
		 {literal} 
      google.charts.setOnLoadCallback(drawChart2);
      function drawChart2(){
        var data = google.visualization.arrayToDataTable([
          ['Software', 'No.'], 
		 {/literal}	  		 
		  {foreach from = $data_sw_edition item = rec}
          ['{$rec.edition} ({$rec.no_license})',  {$rec.no_license}],
		  {/foreach}
		  {literal}    
        ]);

        var options = {
          chartArea:{left:0},
           title: '',
          pieHole: 0.4,
		  fontSize: 12, 
		  legend:{position: 'right',  textStyle: { fontSize: 12}
		  }
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart2'));
        chart.draw(data, options);
      }
      {/literal}
		 {/if}
		 {if $dt_3}
		 {literal} 
      google.charts.setOnLoadCallback(drawChart3);
      function drawChart3(){
        var data = google.visualization.arrayToDataTable([
          ['Software', 'No.'], 
		 {/literal}	  		 
		  {foreach from = $data_assign_sw item = rec}
          ['{$rec.edition} ({$rec.no_license})',  {$rec.count}],
		  {/foreach}
		  {literal}    
        ]);

        var options = {
          chartArea:{left:0},
           title: '',
          pieHole: 0.4,
		  fontSize: 12,
		  legend:{position: 'right',  textStyle: { fontSize: 12}}
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart3'));
        chart.draw(data, options);
      }
      {/literal}
		 {/if}
		 {if $dt_4}
		 {literal}
      google.charts.setOnLoadCallback(drawChart4);
      function drawChart4(){
        var data = google.visualization.arrayToDataTable([
          ['Software', 'No.'], 
		 {/literal}	  		 
		  {foreach from = $data_unassign_sw key=k item=v}
          ['{$k} ({$v})',  {$v}],
		  {/foreach}
		  {literal}    
        ]);

        var options = {
          chartArea:{left:0},
           title: '',
          pieHole: 0.4,  fontSize: 12,  legend:{position: 'right',  textStyle: { fontSize: 12}}
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart4'));
        chart.draw(data, options);
      }
      {/literal}
		 {/if}
		 {if $dt_5}
		 {literal}	  
      google.charts.setOnLoadCallback(drawChart5);
      function drawChart5(){
        var data = google.visualization.arrayToDataTable([
          ['Hardware', 'No.'],
        {/literal}	  		 
		  {foreach from = $data_hw_type item = rec}
          ['{$rec.title}',  {$rec.count}],
		  {/foreach}
		  {literal}  
        ]);

        var options = {
          chartArea:{left:0},
           title: '',
          pieHole: 0.4,  fontSize: 12,  legend:{position: 'right',  textStyle: { fontSize: 12}}
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart5'));
        chart.draw(data, options);
      }
        {/literal}
		 {/if}
		 {if $dt_6}
		 {literal}    
      google.charts.setOnLoadCallback(drawChart6);
      function drawChart6(){
        var data = google.visualization.arrayToDataTable([
          ['Hardware', 'No.'],
        {/literal}	  		 
		  {foreach from = $data_hw_brand item = rec}
          ['{$rec.title} ({$rec.brand})',  {$rec.count}],
		  {/foreach}
		  {literal}  
        ]);

        var options = {
          chartArea:{left:0},
           title: '',
          pieHole: 0.4,  fontSize: 12,  legend:{position: 'right',  textStyle: { fontSize: 12}}
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart6'));
        chart.draw(data, options);
      }
       {/literal}
		 {/if}
		 {if $dt_7}
		 {literal}      
      google.charts.setOnLoadCallback(drawChart7);
      function drawChart7(){
        var data = google.visualization.arrayToDataTable([
          ['Hardware', 'No.'],
        {/literal}	  		 
		  {foreach from = $data_assign_hw item = rec}
          ['{$rec.title} ({$rec.brand})',  {$rec.count}],
		  {/foreach}
		  {literal}  
        ]);

        var options = {
          chartArea:{left:0},
           title: '',
          pieHole: 0.4,  fontSize: 12,  legend:{position: 'right',  textStyle: { fontSize: 12}}
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart7'));
        chart.draw(data, options);
      }
      {/literal}
		 {/if}
		 {if $dt_8}
		 {literal}       
      google.charts.setOnLoadCallback(drawChart8);
      function drawChart8(){
        var data = google.visualization.arrayToDataTable([
          ['Hardware', 'No.'],
        {/literal}	  		 
		  {foreach from = $data_unassign_hw item = rec}
          ['{$rec.title} ({$rec.brand})',  {$rec.count}],
		  {/foreach}
		  {literal}  
        ]);

        var options = {
          chartArea:{left:0},
           title: '',
          pieHole: 0.4, 
		  fontSize: 12,
		  legend:{position: 'right',  textStyle: { fontSize	: 12 }
		  }
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart8'));
        chart.draw(data, options);
      }
      {/literal}
		 {/if}
		 {if $dt_9}
		 {literal} 	  
	  google.charts.setOnLoadCallback(drawChart9);
      function drawChart9(){
        var data = google.visualization.arrayToDataTable([
          ['Status', 'No.'],
        {/literal}	  		 
		  {foreach from = $data_ticket item = rec}
          ['{$rec.status}',  {$rec.count}],
		  {/foreach}
		  {literal}  
        ]);

        var options = {
          chartArea:{left:0},
           title: '',
          pieHole: 0.4, 
		  fontSize: 12,
		  legend:{position: 'right',  textStyle: { fontSize: 12}
		  }
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart9'));
        chart.draw(data, options);
      }
      {/literal}
		 {/if}
		 {if $dt_10}
		 {literal} 	  
	  google.charts.setOnLoadCallback(drawChart10);
      function drawChart10(){
        var data = google.visualization.arrayToDataTable([
          ['Status', 'No.'],
        {/literal}	  		 
		  {foreach from = $data_req_change item = rec}
          ['{$rec.status}',  {$rec.count}],
		  {/foreach}
		  {literal}  
        ]);

        var options = {
          chartArea:{left:0},
           title: '',
          pieHole: 0.4,
		  fontSize: 12,
		  legend:{position: 'right', textStyle: { fontSize: 12}
		  }
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart10'));
        chart.draw(data, options);
      }
      {/literal}
		 {/if}
		 {literal}
    </script>
{/literal}