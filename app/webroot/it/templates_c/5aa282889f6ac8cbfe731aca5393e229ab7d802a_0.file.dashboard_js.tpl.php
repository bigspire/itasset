<?php
/* Smarty version 3.1.29, created on 2016-11-05 16:39:19
  from "/var/www/html/ceo_apps_it/app/webroot/it/templates/include/dashboard_js.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_581dbddf6333b3_84678759',
  'file_dependency' => 
  array (
    '5aa282889f6ac8cbfe731aca5393e229ab7d802a' => 
    array (
      0 => '/var/www/html/ceo_apps_it/app/webroot/it/templates/include/dashboard_js.tpl',
      1 => 1478344152,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_581dbddf6333b3_84678759 ($_smarty_tpl) {
?>
 
 <?php echo '<script'; ?>
 type="text/javascript" src="https://www.gstatic.com/charts/loader.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
       
		 <?php if ($_smarty_tpl->tpl_vars['dt_1']->value) {?>	 
		  
      google.charts.setOnLoadCallback(drawChart1);     
      function drawChart1(){
        var data = google.visualization.arrayToDataTable([
          ['Software', 'No.'], 
		 	
		  	<?php
$_from = $_smarty_tpl->tpl_vars['data_sw_type']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_rec_0_saved_item = isset($_smarty_tpl->tpl_vars['rec']) ? $_smarty_tpl->tpl_vars['rec'] : false;
$_smarty_tpl->tpl_vars['rec'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['rec']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['rec']->value) {
$_smarty_tpl->tpl_vars['rec']->_loop = true;
$__foreach_rec_0_saved_local_item = $_smarty_tpl->tpl_vars['rec'];
?>
          ['<?php echo ucfirst($_smarty_tpl->tpl_vars['rec']->value['title']);?>
 (<?php echo $_smarty_tpl->tpl_vars['rec']->value['edition'];?>
)',  <?php echo $_smarty_tpl->tpl_vars['rec']->value['count'];?>
],
		  	<?php
$_smarty_tpl->tpl_vars['rec'] = $__foreach_rec_0_saved_local_item;
}
if ($__foreach_rec_0_saved_item) {
$_smarty_tpl->tpl_vars['rec'] = $__foreach_rec_0_saved_item;
}
?>
		  	    
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
       
		 <?php }?>
		 <?php if ($_smarty_tpl->tpl_vars['dt_2']->value) {?>
		  
      google.charts.setOnLoadCallback(drawChart2);
      function drawChart2(){
        var data = google.visualization.arrayToDataTable([
          ['Software', 'No.'], 
		 	  		 
		  <?php
$_from = $_smarty_tpl->tpl_vars['data_sw_edition']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_rec_1_saved_item = isset($_smarty_tpl->tpl_vars['rec']) ? $_smarty_tpl->tpl_vars['rec'] : false;
$_smarty_tpl->tpl_vars['rec'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['rec']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['rec']->value) {
$_smarty_tpl->tpl_vars['rec']->_loop = true;
$__foreach_rec_1_saved_local_item = $_smarty_tpl->tpl_vars['rec'];
?>
          ['<?php echo ucfirst($_smarty_tpl->tpl_vars['rec']->value['edition']);?>
 (<?php echo $_smarty_tpl->tpl_vars['rec']->value['no_license'];?>
)',  <?php echo $_smarty_tpl->tpl_vars['rec']->value['no_license'];?>
],
		  <?php
$_smarty_tpl->tpl_vars['rec'] = $__foreach_rec_1_saved_local_item;
}
if ($__foreach_rec_1_saved_item) {
$_smarty_tpl->tpl_vars['rec'] = $__foreach_rec_1_saved_item;
}
?>
		      
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
      
		 <?php }?>
		 <?php if ($_smarty_tpl->tpl_vars['dt_3']->value) {?>
		  
      google.charts.setOnLoadCallback(drawChart3);
      function drawChart3(){
        var data = google.visualization.arrayToDataTable([
          ['Software', 'No.'], 
		 	  		 
		  <?php
$_from = $_smarty_tpl->tpl_vars['data_assign_sw']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_rec_2_saved_item = isset($_smarty_tpl->tpl_vars['rec']) ? $_smarty_tpl->tpl_vars['rec'] : false;
$_smarty_tpl->tpl_vars['rec'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['rec']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['rec']->value) {
$_smarty_tpl->tpl_vars['rec']->_loop = true;
$__foreach_rec_2_saved_local_item = $_smarty_tpl->tpl_vars['rec'];
?>
          ['<?php echo ucfirst($_smarty_tpl->tpl_vars['rec']->value['edition']);?>
 (<?php echo $_smarty_tpl->tpl_vars['rec']->value['no_license'];?>
)',  <?php echo $_smarty_tpl->tpl_vars['rec']->value['count'];?>
],
		  <?php
$_smarty_tpl->tpl_vars['rec'] = $__foreach_rec_2_saved_local_item;
}
if ($__foreach_rec_2_saved_item) {
$_smarty_tpl->tpl_vars['rec'] = $__foreach_rec_2_saved_item;
}
?>
		      
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
      
		 <?php }?>
		 <?php if ($_smarty_tpl->tpl_vars['dt_4']->value) {?>
		 
      google.charts.setOnLoadCallback(drawChart4);
      function drawChart4(){
        var data = google.visualization.arrayToDataTable([
          ['Software', 'No.'], 
		 	  		 
		  <?php
$_from = $_smarty_tpl->tpl_vars['data_unassign_sw']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_v_3_saved_item = isset($_smarty_tpl->tpl_vars['v']) ? $_smarty_tpl->tpl_vars['v'] : false;
$__foreach_v_3_saved_key = isset($_smarty_tpl->tpl_vars['k']) ? $_smarty_tpl->tpl_vars['k'] : false;
$_smarty_tpl->tpl_vars['v'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['k'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['v']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->_loop = true;
$__foreach_v_3_saved_local_item = $_smarty_tpl->tpl_vars['v'];
?>
		  <?php $_smarty_tpl->tpl_vars['someVar'] = new Smarty_Variable(explode("_",$_smarty_tpl->tpl_vars['v']->value), null);
$_smarty_tpl->ext->_updateScope->updateScope($_smarty_tpl, 'someVar', 0);?>
          ['<?php echo ucfirst($_smarty_tpl->tpl_vars['k']->value);?>
 (<?php echo $_smarty_tpl->tpl_vars['someVar']->value[0];?>
)',  <?php echo $_smarty_tpl->tpl_vars['someVar']->value[1];?>
],
		  <?php
$_smarty_tpl->tpl_vars['v'] = $__foreach_v_3_saved_local_item;
}
if ($__foreach_v_3_saved_item) {
$_smarty_tpl->tpl_vars['v'] = $__foreach_v_3_saved_item;
}
if ($__foreach_v_3_saved_key) {
$_smarty_tpl->tpl_vars['k'] = $__foreach_v_3_saved_key;
}
?>
		      
        ]);

        var options = {
          chartArea:{left:0},
           title: '',
          pieHole: 0.4,  fontSize: 12,  legend:{position: 'right',  textStyle: { fontSize: 12}}
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart4'));
        chart.draw(data, options);
      }
      
		 <?php }?>
		 <?php if ($_smarty_tpl->tpl_vars['dt_5']->value) {?>
		 	  
      google.charts.setOnLoadCallback(drawChart5);
      function drawChart5(){
        var data = google.visualization.arrayToDataTable([
          ['Hardware', 'No.'],
        	  		 
		  <?php
$_from = $_smarty_tpl->tpl_vars['data_hw_type']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_rec_4_saved_item = isset($_smarty_tpl->tpl_vars['rec']) ? $_smarty_tpl->tpl_vars['rec'] : false;
$_smarty_tpl->tpl_vars['rec'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['rec']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['rec']->value) {
$_smarty_tpl->tpl_vars['rec']->_loop = true;
$__foreach_rec_4_saved_local_item = $_smarty_tpl->tpl_vars['rec'];
?>
          ['<?php echo ucfirst($_smarty_tpl->tpl_vars['rec']->value['title']);?>
',  <?php echo $_smarty_tpl->tpl_vars['rec']->value['count'];?>
],
		  <?php
$_smarty_tpl->tpl_vars['rec'] = $__foreach_rec_4_saved_local_item;
}
if ($__foreach_rec_4_saved_item) {
$_smarty_tpl->tpl_vars['rec'] = $__foreach_rec_4_saved_item;
}
?>
		    
        ]);

        var options = {
          chartArea:{left:0},
           title: '',
          pieHole: 0.4,  fontSize: 12,  legend:{position: 'right',  textStyle: { fontSize: 12}}
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart5'));
        chart.draw(data, options);
      }
        
		 <?php }?>
		 <?php if ($_smarty_tpl->tpl_vars['dt_6']->value) {?>
		     
      google.charts.setOnLoadCallback(drawChart6);
      function drawChart6(){
        var data = google.visualization.arrayToDataTable([
          ['Hardware', 'No.'],
        	  		 
		  <?php
$_from = $_smarty_tpl->tpl_vars['data_hw_brand']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_rec_5_saved_item = isset($_smarty_tpl->tpl_vars['rec']) ? $_smarty_tpl->tpl_vars['rec'] : false;
$_smarty_tpl->tpl_vars['rec'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['rec']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['rec']->value) {
$_smarty_tpl->tpl_vars['rec']->_loop = true;
$__foreach_rec_5_saved_local_item = $_smarty_tpl->tpl_vars['rec'];
?>
          ['<?php echo ucfirst($_smarty_tpl->tpl_vars['rec']->value['title']);?>
 (<?php echo ucfirst($_smarty_tpl->tpl_vars['rec']->value['brand']);?>
)',  <?php echo $_smarty_tpl->tpl_vars['rec']->value['count'];?>
],
		  <?php
$_smarty_tpl->tpl_vars['rec'] = $__foreach_rec_5_saved_local_item;
}
if ($__foreach_rec_5_saved_item) {
$_smarty_tpl->tpl_vars['rec'] = $__foreach_rec_5_saved_item;
}
?>
		    
        ]);

        var options = {
          chartArea:{left:0},
           title: '',
          pieHole: 0.4,  fontSize: 12,  legend:{position: 'right',  textStyle: { fontSize: 12}}
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart6'));
        chart.draw(data, options);
      }
       
		 <?php }?>
		 <?php if ($_smarty_tpl->tpl_vars['dt_7']->value) {?>
		       
      google.charts.setOnLoadCallback(drawChart7);
      function drawChart7(){
        var data = google.visualization.arrayToDataTable([
          ['Hardware', 'No.'],
        	  		 
		  <?php
$_from = $_smarty_tpl->tpl_vars['data_assign_hw']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_rec_6_saved_item = isset($_smarty_tpl->tpl_vars['rec']) ? $_smarty_tpl->tpl_vars['rec'] : false;
$_smarty_tpl->tpl_vars['rec'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['rec']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['rec']->value) {
$_smarty_tpl->tpl_vars['rec']->_loop = true;
$__foreach_rec_6_saved_local_item = $_smarty_tpl->tpl_vars['rec'];
?>
          ['<?php echo ucfirst($_smarty_tpl->tpl_vars['rec']->value['title']);?>
 (<?php echo ucfirst($_smarty_tpl->tpl_vars['rec']->value['brand']);?>
)',  <?php echo $_smarty_tpl->tpl_vars['rec']->value['count'];?>
],
		  <?php
$_smarty_tpl->tpl_vars['rec'] = $__foreach_rec_6_saved_local_item;
}
if ($__foreach_rec_6_saved_item) {
$_smarty_tpl->tpl_vars['rec'] = $__foreach_rec_6_saved_item;
}
?>
		    
        ]);

        var options = {
          chartArea:{left:0},
           title: '',
          pieHole: 0.4,  fontSize: 12,  legend:{position: 'right',  textStyle: { fontSize: 12}}
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart7'));
        chart.draw(data, options);
      }
      
		 <?php }?>
		 <?php if ($_smarty_tpl->tpl_vars['dt_8']->value) {?>
		        
      google.charts.setOnLoadCallback(drawChart8);
      function drawChart8(){
        var data = google.visualization.arrayToDataTable([
          ['Hardware', 'No.'],
        	  		 
		  <?php
$_from = $_smarty_tpl->tpl_vars['data_unassign_hw']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_rec_7_saved_item = isset($_smarty_tpl->tpl_vars['rec']) ? $_smarty_tpl->tpl_vars['rec'] : false;
$_smarty_tpl->tpl_vars['rec'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['rec']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['rec']->value) {
$_smarty_tpl->tpl_vars['rec']->_loop = true;
$__foreach_rec_7_saved_local_item = $_smarty_tpl->tpl_vars['rec'];
?>
          ['<?php echo ucfirst($_smarty_tpl->tpl_vars['rec']->value['title']);?>
 (<?php echo ucfirst($_smarty_tpl->tpl_vars['rec']->value['brand']);?>
)',  <?php echo $_smarty_tpl->tpl_vars['rec']->value['count'];?>
],
		  <?php
$_smarty_tpl->tpl_vars['rec'] = $__foreach_rec_7_saved_local_item;
}
if ($__foreach_rec_7_saved_item) {
$_smarty_tpl->tpl_vars['rec'] = $__foreach_rec_7_saved_item;
}
?>
		    
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
      
		 <?php }?>
		 <?php if ($_smarty_tpl->tpl_vars['dt_9']->value) {?>
		  	  
	  google.charts.setOnLoadCallback(drawChart9);
      function drawChart9(){
        var data = google.visualization.arrayToDataTable([
          ['Status', 'No.'],
        	  		 
		  <?php
$_from = $_smarty_tpl->tpl_vars['data_ticket']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_rec_8_saved_item = isset($_smarty_tpl->tpl_vars['rec']) ? $_smarty_tpl->tpl_vars['rec'] : false;
$_smarty_tpl->tpl_vars['rec'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['rec']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['rec']->value) {
$_smarty_tpl->tpl_vars['rec']->_loop = true;
$__foreach_rec_8_saved_local_item = $_smarty_tpl->tpl_vars['rec'];
?>
          ['<?php echo $_smarty_tpl->tpl_vars['rec']->value['status'];?>
',  <?php echo $_smarty_tpl->tpl_vars['rec']->value['count'];?>
],
		  <?php
$_smarty_tpl->tpl_vars['rec'] = $__foreach_rec_8_saved_local_item;
}
if ($__foreach_rec_8_saved_item) {
$_smarty_tpl->tpl_vars['rec'] = $__foreach_rec_8_saved_item;
}
?>
		    
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
      
		 <?php }?>
		 <?php if ($_smarty_tpl->tpl_vars['dt_10']->value) {?>
		  	  
	  google.charts.setOnLoadCallback(drawChart10);
      function drawChart10(){
        var data = google.visualization.arrayToDataTable([
          ['Status', 'No.'],
        	  		 
		  <?php
$_from = $_smarty_tpl->tpl_vars['data_req_change']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_rec_9_saved_item = isset($_smarty_tpl->tpl_vars['rec']) ? $_smarty_tpl->tpl_vars['rec'] : false;
$_smarty_tpl->tpl_vars['rec'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['rec']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['rec']->value) {
$_smarty_tpl->tpl_vars['rec']->_loop = true;
$__foreach_rec_9_saved_local_item = $_smarty_tpl->tpl_vars['rec'];
?>
          ['<?php echo $_smarty_tpl->tpl_vars['rec']->value['status'];?>
',  <?php echo $_smarty_tpl->tpl_vars['rec']->value['count'];?>
],
		  <?php
$_smarty_tpl->tpl_vars['rec'] = $__foreach_rec_9_saved_local_item;
}
if ($__foreach_rec_9_saved_item) {
$_smarty_tpl->tpl_vars['rec'] = $__foreach_rec_9_saved_item;
}
?>
		    
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
      
		 <?php }?>
		 
    <?php echo '</script'; ?>
>
<?php }
}
