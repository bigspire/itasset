
	<?php echo $this->element('bd_menu'); ?>

	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
			<div class="page-header">
					<div class="pull-left">
						<h1><?php echo $biz_type ? $biz_type.' Business' : 'My Business';?></h1>
					</div>
						
				
					
				
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>bdhome/">Dashboard</a>
							<i class="icon-angle-right"></i>
						</li>
						<li>
							<a href="<?php echo $this->webroot;?>bdhome/">My Business</a>
							
							<?php if($this->request->query['type']):?>
							<i class="icon-angle-right"></i>
							<?php endif; ?>
						</li>
						<?php if($this->request->query['type']):?>
						<li>
							<a href="<?php echo $this->webroot;?>bdhome/?type=<?php echo $this->request->query['type'];?>"><?php echo $biz_type;?> Business</a>
						</li>
						<?php endif; ?>
					</ul>
					
					<div style="float:left;margin:3px 30px 0 25%;" class="">
					<span style="margin-right:20px;font-weight:bold;color:">Report From: <?php echo date('M-d', strtotime($this->Functions->format_date_save($startDate))); echo $this->Functions->get_ordinal(date('d', strtotime($this->Functions->format_date_save($startDate))));?> to <?php echo date('M-d', strtotime($this->Functions->format_date_save($endDate))); echo $this->Functions->get_ordinal(date('d', strtotime($this->Functions->format_date_save($endDate)))); ?></span> 
					<span><i class="icon-search"></i> <a href="javascript:void(0);" class="click_hide homeSearch" title="Search Options" rel="tooltip">Search</a> </span>
					<!--span><i class="icon-print"></i> <a href="javascript:void(0);"  rel="pcontent" class="print click_hide"  title="Print Graph" rel="tooltip">Print</a></span-->
					</div>
											
				</div>
				
				
				<div class="page-header">
					<!--div class="pull-left">
						<h1>Dashboard</h1>
					</div-->
					<?php echo $this->Form->create('BdHome', array('id' => 'expForm', 'style' => 'margin:0', 'class' => 'form-vertical')); ?>

					<div class="pull-left dn homeSrchBox">
					<div class="control-group bdSearch"  style="margin-left:0" >
					<label for="textfield" class="control-label"><a href="javascript:void(0);" rel="popover" data-content="Date of First Discussion" data-trigger="hover" data-placement="right">DOFD From</a></label>
					<div class="controls controls-row">
					<?php echo $this->Form->input('from', array('div'=> false,'type' => 'text', 'style' => 'margin-right:4px', 'id' => 'SearchText', 'label' => false, 'class' => 'datepick input-small required bdsrchSel',   'value' => $startDate, 'required' => false, 'autocomplete' => 'off', 'placeholder' => 'Date From', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?>
					</div>
					</div>					
					
					<div class="control-group bdSearch">
					<label for="textfield" class="control-label"><a href="javascript:void(0);" rel="popover" data-content="Date of First Discussion" data-trigger="hover" data-placement="right">DOFD To</a></label>
					<div class="controls controls-row">
					<?php echo $this->Form->input('to', array('div'=> false,'type' => 'text', 'id' => 'SearchText', 'label' => false, 'class' => 'datepick input-small required bdsrchSel',   'value' => $endDate, 'required' => false, 'autocomplete' => 'off', 'placeholder' => 'Date To', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
					</div>
					</div>
					
					
					
					<div class="control-group bdSearch">
					<label for="textfield" class="control-label"><a href="javascript:void(0);" rel="popover" data-content="Scope of Work" data-trigger="hover" data-placement="right">SOW</a></label>
					<div class="controls controls-row">
					<?php echo $this->Form->input('sow', array('div'=> false,'type' => 'select', 'label' => false, 'class' => "input-small $bdsrchSel1", 'empty' => 'Select',  'required' => false, 'placeholder' => '', 'style' => "clear:left", 'options' => array('0' => 'Pending', '1' => 'Finalized'), 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
					</div>
					</div>
					
					<div class="control-group bdSearch">
					<label for="textfield" class="control-label"><a href="javascript:void(0);" rel="popover" data-content="Proposal Submitted" data-trigger="hover" data-placement="right">PS</a></label>
					<div class="controls controls-row">
					<?php echo $this->Form->input('proposal_done', array('div'=> false,'type' => 'select', 'label' => false, 'class' => "input-small $bdsrchSel2", 'empty' => 'Select',  'required' => false, 'placeholder' => '', 'style' => "clear:left", 'options' => array('2' => 'Pending', '1' => 'Yes', '0' => 'No'), 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
					</div>
					</div>
					
					<div class="control-group bdSearch">
					<label for="textfield" class="control-label"><a href="javascript:void(0);" rel="popover" data-content="Proposal Approved" data-trigger="hover" data-placement="right">PA</a></label>
					<div class="controls controls-row">
					<?php echo $this->Form->input('proposal_approve', array('div'=> false,'type' => 'select', 'label' => false, 'class' => "input-small $bdsrchSel3", 'empty' => 'Select', 'required' => false, 'placeholder' => '', 'style' => "clear:left", 'options' => array('2' => 'Pending', '1' => 'Yes', '0' => 'No'), 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
					</div>
					</div>
					
					<div class="control-group bdSearch">
					<label for="textfield" class="control-label"><a href="javascript:void(0);" rel="popover" data-content="Agreement Signed" data-trigger="hover" data-placement="right">AS</a></label>
					<div class="controls controls-row">
					<?php echo $this->Form->input('agree_sign', array('div'=> false,'type' => 'select', 'label' => false, 'class' => "input-small $bdsrchSel4", 'empty' => 'Select',  'required' => false, 'placeholder' => '', 'style' => "clear:left", 'options' => array('2' => 'Pending', '1' => 'Yes', '0' => 'No'), 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
					</div>
					</div>
					
					<div class="control-group bdSearch">
					<label for="textfield" class="control-label"><a href="javascript:void(0);" rel="popover" data-content="Work Started" data-trigger="hover" data-placement="right">WS</a></label>
					<div class="controls controls-row">
					<?php echo $this->Form->input('work_status', array('div'=> false,'type' => 'select', 'label' => false, 'class' => "input-small $bdsrchSel5", 'empty' => 'Select', 'required' => false, 'placeholder' => '', 'style' => "clear:left", 'options' => array('2' => 'Pending', '1' => 'Yes', '0' => 'No'), 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
					</div>
					</div>
					
					<div class="control-group bdSearch">
					<label for="textfield" class="control-label"><a href="javascript:void(0);" rel="popover" data-content="Work Completed" data-trigger="hover" data-placement="right">WC</a></label>
					<div class="controls controls-row">
					<?php echo $this->Form->input('work_complete', array('div'=> false,'type' => 'select', 'label' => false, 'class' => "input-medium $bdsrchSel7", 'empty' => 'Select', 'required' => false, 'placeholder' => '',  'options' => array('2' => 'Pending',  '1' => 'Active/Inprogress', '0' => 'Inactive/Completed'), 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
					</div>
					</div>
					<?php if($bdAdmin):?>
					<div class="control-group bdSearch">
					<label for="textfield" class="control-label">SPOC </label>
					<div class="controls controls-row">
					<?php echo $this->Form->input('spoc', array('div'=> false,'type' => 'select', 'label' => false, 'class' => "input-large $bdsrchSel6", 'empty' => 'Select', 'required' => false, 'placeholder' => '', 'style' => "clear:left", 'options' => $bizSpoc, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
					</div>
					</div>
					<?php endif; ?>
					
					<div class="control-group bdSearch">
					<label for="textfield" class="control-label">&nbsp; </label>
					<div class="controls controls-row">
<input type="submit" value="Submit" class="btn btn-primary bdhomeSearch" style="">
					<a href="<?php echo $this->webroot;?>bdhome/?type=<?php echo $this->request->query['type']?>"><input type="button" value="Reset" class="btn" style="margin-left:4px;"></a>

					<!--a href="javascript:void(0)" rel="pcontent" class="print" style="margin-left:4px;text-decoration:none;">
					<button type="button" class="btn btn-magenta"><i class="icon-print"></i> Print</button>
					</a-->
											

					</div>
					</div>
					
					
				<?php echo $this->Form->input('srchSubmit', array('type' => 'hidden', 'id' => 'srchSubmit'));?>
	

				</form>
					</div>
				</div>
		
				
				<?php echo $this->Session->flash();?>
				
				
				<div class="row-fluid footer_div"  id="pcontent" >
					
		
					<div class="span3 bdBox">
					
						<div class="box box-bordered">
							<div class="box-title dashTitle">
								<h3><i class="icon-bar-chart"></i>Vertical wise</h3>
								
							</div>
							<div class="box-content">
								<div id="piechart" style="height:250px;"></div>
							
							</div>
						</div>
					</div>
					
					
					<div class="span3 bdBox">
						<div class="box box-bordered ">
							<div class="box-title dashTitle">
								<h3><i class="icon-bar-chart"></i>Opportunity wise</h3>
								
							</div>
							<div class="box-content">
								<div id="piechart2"  style="height:250px;"></div>
							</div>
						</div>
					</div>
					
					<div class="span3 bdBox">
					<div class="box box-bordered">
						<div class="box-title dashTitle">
								<h3><i class="icon-bar-chart"></i>DOFD wise</h3>
								
							</div>
							<div class="box-content">
								<div id="piechart6" style="height:250px;"></div>
							</div>
						</div>
					
					
					</div>	
					
					<div class="span3 bdBox">
							<div class="box box-bordered ">
							<div class="box-title dashTitle">
								<h3><i class="icon-bar-chart"></i>SPOC wise</h3>
								
							</div>
							<div class="box-content">
								<div id="piechart3" style="height:250px;"></div>
							</div>
						</div>
						
						
					</div>
					
					<div class="span3 bdBox">
					
						<div class="box box-bordered">
							<div class="box-title dashTitle">
								<h3><i class="icon-bar-chart"></i>Business wise</h3>
								
							</div>
							<div class="box-content">
								<div id="piechart4" style="height:250px;"></div>
							</div>
						</div>
					</div>
					
					<div class="span3 bdBox">
					<div class="box box-bordered ">
							<div class="box-title dashTitle">
								<h3><i class="icon-bar-chart"></i>Priority wise</h3>
								
							</div>
							<div class="box-content">
								<div id="piechart5" style="height:250px;"></div>
							</div>
						</div>
					</div>
					
					<div class="span3 bdBox">
					<div class="box box-bordered ">
						<div class="box-title dashTitle">
								<h3><i class="icon-bar-chart"></i>State wise</h3>
								
							</div>
							<div class="box-content">
								<div id="piechart10" style="height:250px;"></div>
							</div>
						</div>
					</div>
					
					<div class="span3 bdBox">
					<div class="box box-bordered ">
						<div class="box-title dashTitle">
								<h3><i class="icon-bar-chart"></i>District wise</h3>
								
							</div>
							<div class="box-content">
								<div id="piechart12" style="height:250px;"></div>
							</div>
						</div>
					</div>
					
					<div class="span3 bdBox">					
						<div class="box box-bordered ">
							<div class="box-title dashTitle">
								<h3><i class="icon-bar-chart"></i>Biz. Spot By wise</h3>								
							</div>
							<div class="box-content">
								<div id="piechart11" style="height:250px;"></div>
							</div>
						</div>
					</div>
					
					<div class="span3 bdBox">
					<div class="box box-bordered ">
						<div class="box-title dashTitle">
								<h3><i class="icon-bar-chart"></i>Biz. Source wise</h3>
								
							</div>
							<div class="box-content">
								<div id="piechart8" style="height:250px;"></div>
							</div>
						</div>
					</div>
					
					<div class="span3 bdBox">
					
						<div class="box box-bordered ">
							<div class="box-title dashTitle">
								<h3><i class="icon-bar-chart"></i>Conversion wise</h3>
								
							</div>
							<div class="box-content">
								<div id="piechart7" style="height:250px;"></div>
							</div>
						</div>
					</div>
					
					<div class="span3 bdBox">
					
						<div class="box box-bordered ">
							<div class="box-title dashTitle">
								<h3><i class="icon-bar-chart"></i>SOW wise</h3>
								
							</div>
							<div class="box-content">
								<div id="piechart9" style="height:250px;"></div>
							</div>
						</div>
					</div>
					
				
					
					
					
					
					
			</div>
			
			
			
			</div>
			</div>
			
		</div>
		
	
		<div class="popover2"">
		<?php $rec_count = count($graphData);
		$graph_scroll = $rec_count  > 6 ? 'scrollable' : '';?>
		<div class="<?php echo $graph_scroll;?>" data-start ="top" data-height="205" data-visible="true" >
    <table class="table table-hover table-nomargin table-condensed" >
									<thead class="persist-area2">
										<tr>
											<th>Customer</th>
											<th>Location</th>
										</tr>
									</thead>
									<tbody>
									<?php foreach($graphData as $graph_data):?>
										<tr class="<?php echo str_replace(' ', '_',$graph_data['HrBusinessUnit']['business_unit']);?> <?php echo str_replace(' ', '_',$graph_data['BdPriority']['title']);?> 
										<?php echo str_replace(' ', '_',$graph_data['Employee']['first_name']);?> <?php echo $this->Functions->get_biz_type($graph_data['BdHome']['type']);?> 
										<?php echo str_replace(' ', '_',$graph_data['BdOpportunity']['title']);?> <?php echo str_replace(' ', '_',$graph_data['District']['district_name']);?> 
										<?php echo str_replace(' ', '_', $this->Functions->get_bdgraph_status($graph_data['BdHome']['sow_done'], 'sow_done')); ?>
										<?php echo str_replace(' ', '_',$graph_data['State']['state_name']);?>	<?php echo str_replace(' ', '_',$graph_data['BdBizSource']['title']);?> graphRow">
											<td width="130"><a class="iframeBox" val="90_90" href="<?php echo $this->webroot;?>bdbusiness/view/<?php echo $graph_data['BdHome']['id'];?>/"><?php echo $graph_data['BdHome']['company_name'];?></a></td>
											<td width="60" >
												<?php echo $graph_data['District']['district_name'];?>
											</td>
											
										</tr>
										<?php endforeach;?>
									</tbody>
								</table>
</div>
</div>	


<input type="hidden" class="piechart1"/>

<script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
	
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
	  	
		var mouse = {x: null, y: null};
		document.onmousemove = function (e) {
			mouse.x = e.pageX;
			mouse.y = e.pageY;
		}
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Verticals', '# of new business'],
		  <?php foreach($verticalGraph as $vertical):?>
          ['<?php echo $vertical['HrBusinessUnit']['business_unit'] ?>',  <?php echo $vertical[0]['count'] ?>],          
		  <?php endforeach; ?>
        ]);

      var options = {
	    pieSliceText: 'value-and-percentage',
		legend: {position: 'bottom', maxLines:1, textStyle: {color: '', fontSize: 12}},
        title: '',
		titleTextStyle:{ fontSize: 15},
		is3D: true,
		chartArea:{left:5,top:5,width:"100%",height:'80%'},
		tooltip:{/* trigger: 'none',*/ textStyle: {color: '', fontSize: 13}},
       // pieStartAngle: 100,
      };
		
	
		function mouserOverHandler(){
			call_mouse_over('piechart')
		}
		
		function mouserOutHandler(){
			call_mouse_out('piechart')
		}
		
		function selectHandler() { 
          var selectedItem = chart.getSelection()[0];
          if (selectedItem) {
			$('.piechart1').val(1);
            var topping = data.getValue(selectedItem.row, 0);  
			//alert('The user selected ' + topping); 
			call_overlay(mouse.x,mouse.y,topping, 'piechart1', 'piechart');
			
         }
       }
	   
	   
        var my_div = document.getElementById('piechart');
        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
		google.visualization.events.addListener(chart, 'select', selectHandler); 
		google.visualization.events.addListener(chart, 'onmouseover', mouserOverHandler);
        google.visualization.events.addListener(chart, 'onmouseout', mouserOutHandler);

		/*google.visualization.events.addListener(chart, 'ready', function () {
			my_div.innerHTML = '<img src="' + chart.getImageURI() + '">';
		});*/
        chart.draw(data, options);
      }
	  
	  google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart2);
      function drawChart2() { 
	  var data = google.visualization.arrayToDataTable([
          ['Verticals', '# of new business'],
		 <?php foreach($opporGraph as $oppor):?>
          ['<?php echo $oppor['BdOpportunity']['title']; ?>',  <?php echo $oppor[0]['count'] ?>],          
		  <?php endforeach; ?>
        ]);

      var options = {
	    pieSliceText: 'value-and-percentage',
		legend: {position: 'bottom', maxLines:1, textStyle: {color: '', fontSize: 12}},
        title: '',
		titleTextStyle:{ fontSize: 15},
		is3D: true,
		chartArea:{left:5,top:5,width:"100%",height:'80%'},
		tooltip:{/* trigger: 'none',*/ textStyle: {color: '', fontSize: 13}},
		
       // pieStartAngle: 100,
      };
		
		function mouserOverHandler2(){
			call_mouse_over('piechart2')
		}
		
		function mouserOutHandler2(){
			call_mouse_out('piechart2')
		}

		function selectHandler2() { 
          var selectedItem = chart.getSelection()[0];
          if (selectedItem) {
			$('.piechart1').val(1);
            var topping = data.getValue(selectedItem.row, 0);  
			//alert('The user selected ' + topping); 
			call_overlay(mouse.x,mouse.y,topping, 'piechart1', 'piechart2');
			
         }
       }
	   
	  
	   
        var my_div = document.getElementById('piechart2');
        var chart = new google.visualization.PieChart(document.getElementById('piechart2'));
		google.visualization.events.addListener(chart, 'select', selectHandler2); 
		google.visualization.events.addListener(chart, 'onmouseover', mouserOverHandler2);
         google.visualization.events.addListener(chart, 'onmouseout', mouserOutHandler2);

		/*google.visualization.events.addListener(chart, 'ready', function () {
			my_div.innerHTML = '<img src="' + chart.getImageURI() + '">';
		});*/
        chart.draw(data, options);
      }
	  
	   google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart3);
      function drawChart3() { 
	  var data = google.visualization.arrayToDataTable([
          ['Verticals', '# of new business'],
		  <?php foreach($spocGraph as $spoc):?>
          ['<?php echo $spoc['Employee']['first_name'] ?>',  <?php echo $spoc[0]['count'] ?>],          
		  <?php endforeach; ?>
        ]);

      var options = {
	    pieSliceText: 'value-and-percentage',
		legend: {position: 'bottom', maxLines:1, textStyle: {color: '', fontSize: 12}},
        title: '',
		titleTextStyle:{ fontSize: 15},
		is3D: true,
		chartArea:{left:5,top:5,width:"100%",height:'80%'},
		tooltip:{/* trigger: 'none',*/ textStyle: {color: '', fontSize: 13}},
		
       // pieStartAngle: 100,
      };
		
		function mouserOverHandler3(){
			call_mouse_over('piechart3');
		}
		
		function mouserOutHandler3(){
			call_mouse_out('piechart3');
		}

		function selectHandler3() { 
          var selectedItem = chart.getSelection()[0];
          if (selectedItem) {
			$('.piechart1').val(1);
            var topping = data.getValue(selectedItem.row, 0);  
			//alert('The user selected ' + topping); 
			call_overlay(mouse.x,mouse.y,topping, 'piechart1', 'piechart3');
			
         }
       }
	   
	  
	   
        var my_div = document.getElementById('piechart3');
        var chart = new google.visualization.PieChart(document.getElementById('piechart3'));
		google.visualization.events.addListener(chart, 'select', selectHandler3); 
		google.visualization.events.addListener(chart, 'onmouseover', mouserOverHandler3);
         google.visualization.events.addListener(chart, 'onmouseout', mouserOutHandler3);
		/*google.visualization.events.addListener(chart, 'ready', function () {
			my_div.innerHTML = '<img src="' + chart.getImageURI() + '">';
		});*/
        chart.draw(data, options);
      }
	  
	  google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart4);
      function drawChart4() { 
	  var data = google.visualization.arrayToDataTable([
          ['Verticals', '# of new business'],
		  <?php foreach($typeGraph as $type):?>
          ['<?php echo $this->Functions->get_biz_type($type['BdHome']['type']); ?>',  <?php echo $type[0]['count'] ?>],          
		  <?php endforeach; ?>
        ]);

      var options = {
	    pieSliceText: 'value-and-percentage',
		legend: {position: 'bottom', maxLines:1, textStyle: {color: '', fontSize: 12}},
        title: '',
		titleTextStyle:{ fontSize: 15},
		is3D: true,
		chartArea:{left:5,top:5,width:"100%",height:'80%'},
		tooltip:{/* trigger: 'none',*/ textStyle: {color: '', fontSize: 13}},
		
       // pieStartAngle: 100,
      };
		
		function mouserOverHandler4(){
			call_mouse_over('piechart4');
		}
		
		function mouserOutHandler4(){
			call_mouse_out('piechart4');
		}

		function selectHandler4() { 
          var selectedItem = chart.getSelection()[0];
          if (selectedItem) {
			$('.piechart1').val(1);
            var topping = data.getValue(selectedItem.row, 0);   
			//alert('The user selected ' + topping); 
			call_overlay(mouse.x,mouse.y,topping, 'piechart1', 'piechart4');
			
         }
       }
	   
	  
	   
        var my_div = document.getElementById('piechart4');
        var chart = new google.visualization.PieChart(document.getElementById('piechart4'));
		google.visualization.events.addListener(chart, 'select', selectHandler4); 
		google.visualization.events.addListener(chart, 'onmouseover', mouserOverHandler4);
         google.visualization.events.addListener(chart, 'onmouseout', mouserOutHandler4);
		/*google.visualization.events.addListener(chart, 'ready', function () {
			my_div.innerHTML = '<img src="' + chart.getImageURI() + '">';
		});*/
        chart.draw(data, options);
      }
	  
	  google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart5);
      function drawChart5() { 
	  var data = google.visualization.arrayToDataTable([
          ['Verticals', '# of new business'],
		  <?php foreach($priorityGraph as $priority):?>
          ['<?php echo $priority['BdPriority']['title'] ?>',  <?php echo $priority[0]['count'] ?>],          
		  <?php endforeach; ?>
        ]);

      var options = {
	    pieSliceText: 'value-and-percentage',
		legend: {position: 'bottom', maxLines:1, textStyle: {color: '', fontSize: 12}},
        title: '',
		titleTextStyle:{ fontSize: 15},
		is3D: true,
		chartArea:{left:5,top:5,width:"100%",height:'80%'},
		tooltip:{/* trigger: 'none',*/ textStyle: {color: '', fontSize: 13}},
		
       // pieStartAngle: 100,
      };
		
		function mouserOverHandler5(){
			call_mouse_over('piechart5');
		}
		
		function mouserOutHandler5(){
			call_mouse_out('piechart5');
		}

		function selectHandler5() { 
          var selectedItem = chart.getSelection()[0];
          if (selectedItem) {
			$('.piechart1').val(1);
            var topping = data.getValue(selectedItem.row, 0);   
			//alert('The user selected ' + topping); 
			call_overlay(mouse.x,mouse.y,topping, 'piechart1', 'piechart5');
			
         }
       }
	   
	  
	   
        var my_div = document.getElementById('piechart5');
        var chart = new google.visualization.PieChart(document.getElementById('piechart5'));
		google.visualization.events.addListener(chart, 'select', selectHandler5); 
		google.visualization.events.addListener(chart, 'onmouseover', mouserOverHandler5);
         google.visualization.events.addListener(chart, 'onmouseout', mouserOutHandler5);
		/*google.visualization.events.addListener(chart, 'ready', function () {
			my_div.innerHTML = '<img src="' + chart.getImageURI() + '">';
		});*/
        chart.draw(data, options);
      }
	  
	    google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart6);
      function drawChart6() { 
	  var data = google.visualization.arrayToDataTable([
          ['Verticals', '# of new business'],
		  <?php foreach($weeklyGraph as $key => $weekly):?>
          ['<?php echo $weeklyLabel[$key]; ?>',  <?php echo $weekly; ?>],          
		  <?php endforeach; ?>
        ]);

      var options = {
	    pieSliceText: 'value-and-percentage',
		legend: {position: 'bottom', maxLines:1, textStyle: {color: '', fontSize: 12}},
        title: '',
		titleTextStyle:{ fontSize: 15},
		is3D: true,
		chartArea:{left:5,top:5,width:"100%",height:'80%'},
		tooltip:{textStyle: {color: '', fontSize: 13}},
       // pieStartAngle: 100,
      };
		
		/*
		function mouserOverHandler6(){
			call_mouse_over('piechart6');
		}
		
		function mouserOutHandler6(){
			call_mouse_out('piechart6');
		}

		
		
		function selectHandler6() { 
          var selectedItem = chart.getSelection()[0];
          if (selectedItem) {
			$('.piechart1').val(1);
            var topping = data.getValue(selectedItem.row, 0);   
			//alert('The user selected ' + topping); 
			call_overlay(mouse.x,mouse.y,topping, 'piechart1', 'piechart6');
			
         }
       }
	   */
	   
	  
	   
        var my_div = document.getElementById('piechart6');
        var chart = new google.visualization.PieChart(document.getElementById('piechart6'));
		//google.visualization.events.addListener(chart, 'select', selectHandler6); 
		//google.visualization.events.addListener(chart, 'onmouseover', mouserOverHandler6);
         //google.visualization.events.addListener(chart, 'onmouseout', mouserOutHandler6);
		/*google.visualization.events.addListener(chart, 'ready', function () {
			my_div.innerHTML = '<img src="' + chart.getImageURI() + '">';
		});*/
        chart.draw(data, options);
      }
	  
	  google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart12);
      function drawChart12() { 
	  var data = google.visualization.arrayToDataTable([
          ['Verticals', '# of new business'],
		  <?php foreach($locGraph as $loc):?>
          ['<?php echo $loc['District']['district_name'] ?>',  <?php echo $loc[0]['count'] ?>],          
		  <?php endforeach; ?>
        ]);

      var options = {
	    pieSliceText: 'value-and-percentage',
		legend: {position: 'bottom', maxLines:1, textStyle: {color: '', fontSize: 12}},
        title: '',
		titleTextStyle:{ fontSize: 15},
		is3D: true,
		chartArea:{left:5,top:5,width:"100%",height:'80%'},
		tooltip:{/* trigger: 'none',*/ textStyle: {color: '', fontSize: 13}},
		
       // pieStartAngle: 100,
      };
		
		function mouserOverHandler12(){
			call_mouse_over('piechart12');
		}
		
		function mouserOutHandler12(){
			call_mouse_out('piechart12');
		}

		function selectHandler12() { 
          var selectedItem = chart.getSelection()[0];
          if (selectedItem) {
			$('.piechart1').val(1);
            var topping = data.getValue(selectedItem.row, 0);   
			//alert('The user selected ' + topping); 
			call_overlay(mouse.x,mouse.y,topping, 'piechart1', 'piechart12');
			
         }
       }
	   
	  
	   
        var my_div = document.getElementById('piechart12');
        var chart = new google.visualization.PieChart(document.getElementById('piechart12'));
		google.visualization.events.addListener(chart, 'select', selectHandler12); 
		google.visualization.events.addListener(chart, 'onmouseover', mouserOverHandler12);
         google.visualization.events.addListener(chart, 'onmouseout', mouserOutHandler12);
		/*google.visualization.events.addListener(chart, 'ready', function () {
			my_div.innerHTML = '<img src="' + chart.getImageURI() + '">';
		});*/
        chart.draw(data, options);
      }
	  
	  google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart9);
      function drawChart9() { 
	  var data = google.visualization.arrayToDataTable([
          ['Verticals', '# of new business'],
		  <?php foreach($sowGraph as $sow):?>
          ['<?php echo $this->Functions->get_bdgraph_status($sow['BdHome']['sow_done'], 'sow_done'); ?>',  <?php echo $sow[0]['count'] ?>],          
		  <?php endforeach; ?>
        ]);

      var options = {
	    pieSliceText: 'value-and-percentage',
		legend: {position: 'bottom', maxLines:1, textStyle: {color: '', fontSize: 12}},
        title: '',
		titleTextStyle:{ fontSize: 15},
		is3D: true,
		chartArea:{left:5,top:5,width:"100%",height:'80%'},
		tooltip:{/* trigger: 'none',*/ textStyle: {color: '', fontSize: 13}},
		
       // pieStartAngle: 100,
      };
		
		function mouserOverHandler9(){
			call_mouse_over('piechart9');
		}
		
		function mouserOutHandler9(){
			call_mouse_out('piechart9');
		}

		function selectHandler9() { 
          var selectedItem = chart.getSelection()[0];
          if (selectedItem) {
			$('.piechart1').val(1);
            var topping = data.getValue(selectedItem.row, 0);   
			//alert('The user selected ' + topping); 
			call_overlay(mouse.x,mouse.y,topping, 'piechart1', 'piechart9');
			
         }
       }
	   
	  
	   
        var my_div = document.getElementById('piechart9');
        var chart = new google.visualization.PieChart(document.getElementById('piechart9'));
		google.visualization.events.addListener(chart, 'select', selectHandler9); 
		google.visualization.events.addListener(chart, 'onmouseover', mouserOverHandler9);
         google.visualization.events.addListener(chart, 'onmouseout', mouserOutHandler9);
		/*google.visualization.events.addListener(chart, 'ready', function () {
			my_div.innerHTML = '<img src="' + chart.getImageURI() + '">';
		});*/
        chart.draw(data, options);
      }
	  
	   google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart10);
      function drawChart10() { 
	  var data = google.visualization.arrayToDataTable([
          ['Verticals', '# of new business'],
		  <?php foreach($stateGraph as $state):?>
          ['<?php echo $state['State']['state_name']; ?>',  <?php echo $state[0]['count'] ?>],          
		  <?php endforeach; ?>
        ]);

      var options = {
	    pieSliceText: 'value-and-percentage',
		legend: {position: 'bottom', maxLines:1, textStyle: {color: '', fontSize: 12}},
        title: '',
		titleTextStyle:{ fontSize: 15},
		is3D: true,
		chartArea:{left:5,top:5,width:"100%",height:'80%'},
		tooltip:{/* trigger: 'none',*/ textStyle: {color: '', fontSize: 13}},
		
       // pieStartAngle: 100,
      };
		
		function mouserOverHandler10(){
			call_mouse_over('piechart10');
		}
		
		function mouserOutHandler10(){
			call_mouse_out('piechart10');
		}

		function selectHandler10() { 
          var selectedItem = chart.getSelection()[0];
          if (selectedItem) {
			$('.piechart1').val(1);
            var topping = data.getValue(selectedItem.row, 0);   
			//alert('The user selected ' + topping); 
			call_overlay(mouse.x,mouse.y,topping, 'piechart1', 'piechart10');
			
         }
       }
	   
	  
	   
        var my_div = document.getElementById('piechart10');
        var chart = new google.visualization.PieChart(document.getElementById('piechart10'));
		google.visualization.events.addListener(chart, 'select', selectHandler10); 
		google.visualization.events.addListener(chart, 'onmouseover', mouserOverHandler10);
         google.visualization.events.addListener(chart, 'onmouseout', mouserOutHandler10);
		/*google.visualization.events.addListener(chart, 'ready', function () {
			my_div.innerHTML = '<img src="' + chart.getImageURI() + '">';
		});*/
        chart.draw(data, options);
      }
	  
	   google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart8);
      function drawChart8() { 
	  var data = google.visualization.arrayToDataTable([
          ['Verticals', '# of new business'],
		  <?php foreach($referGraph as $refer):?>
          ['<?php echo $refer['BdBizSource']['title']; ?>',  <?php echo $refer[0]['count'] ?>],          
		  <?php endforeach; ?>
        ]);

      var options = {
	    pieSliceText: 'value-and-percentage',
		legend: {position: 'bottom', maxLines:1, textStyle: {color: '', fontSize: 12}},
        title: '',
		titleTextStyle:{ fontSize: 15},
		is3D: true,
		chartArea:{left:5,top:5,width:"100%",height:'80%'},
		tooltip:{/* trigger: 'none',*/ textStyle: {color: '', fontSize: 13}},
		
       // pieStartAngle: 100,
      };
		
		function mouserOverHandler8(){
			call_mouse_over('piechart8');
		}
		
		function mouserOutHandler8(){
			call_mouse_out('piechart8');
		}

		function selectHandler8() { 
          var selectedItem = chart.getSelection()[0];
          if (selectedItem) {
			$('.piechart1').val(1);
            var topping = data.getValue(selectedItem.row, 0);   
			//alert('The user selected ' + topping); 
			call_overlay(mouse.x,mouse.y,topping, 'piechart1', 'piechart8');
			
         }
       }
	   
	  
	   
        var my_div = document.getElementById('piechart8');
        var chart = new google.visualization.PieChart(document.getElementById('piechart8'));
		google.visualization.events.addListener(chart, 'select', selectHandler8); 
		google.visualization.events.addListener(chart, 'onmouseover', mouserOverHandler8);
         google.visualization.events.addListener(chart, 'onmouseout', mouserOutHandler8);
		/*google.visualization.events.addListener(chart, 'ready', function () {
			my_div.innerHTML = '<img src="' + chart.getImageURI() + '">';
		});*/
        chart.draw(data, options);
      }
	  
	   google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart11);
      function drawChart11() { 
	  var data = google.visualization.arrayToDataTable([
          ['Verticals', '# of new business'],
		   <?php foreach($spotGraph as $spot):?>
          ['<?php echo $spot['Employee']['first_name'];?>',  <?php echo $spot[0]['count'] ?>],          
		  <?php endforeach; ?>
        ]);

      var options = {
	    pieSliceText: 'value-and-percentage',
		legend: {position: 'bottom', maxLines:1, textStyle: {color: '', fontSize: 12}},
        title: '',
		titleTextStyle:{ fontSize: 15},
		is3D: true,
		chartArea:{left:5,top:5,width:"100%",height:'80%'},
		tooltip:{/* trigger: 'none',*/ textStyle: {color: '', fontSize: 13}},
		
       // pieStartAngle: 100,
      };
		
		function mouserOverHandler11(){
			call_mouse_over('piechart11');
		}
		
		function mouserOutHandler11(){
			call_mouse_out('piechart11');
		}

		function selectHandler11() { 
          var selectedItem = chart.getSelection()[0];
          if (selectedItem) {
			$('.piechart1').val(1);
            var topping = data.getValue(selectedItem.row, 0);   
			//alert('The user selected ' + topping); 
			call_overlay(mouse.x,mouse.y,topping, 'piechart1', 'piechart11');
			
         }
       }
	   
	  
	   
        var my_div = document.getElementById('piechart11');
        var chart = new google.visualization.PieChart(document.getElementById('piechart11'));
		
        chart.draw(data, options);
      }
	  
	  google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart7);
      function drawChart7() { 
	  var data = google.visualization.arrayToDataTable([
          ['Verticals', '# of new business'],
          ['Yes',  <?php echo $conver_yes ?>], 
		  ['No',  <?php echo $conver_no ?>], 		  
        ]);

      var options = {
	    pieSliceText: 'value-and-percentage',
		legend: {position: 'bottom', maxLines:1, textStyle: {color: '', fontSize: 12}},
        title: '',
		titleTextStyle:{ fontSize: 15},
		is3D: true,
		chartArea:{left:5,top:5,width:"100%",height:'80%'},
		tooltip:{/* trigger: 'none',*/ textStyle: {color: '', fontSize: 13}},
		
       // pieStartAngle: 100,
      };
		
		function mouserOverHandler7(){
			call_mouse_over('piechart7');
		}
		
		function mouserOutHandler7(){
			call_mouse_out('piechart7');
		}

		function selectHandler7() { 
          var selectedItem = chart.getSelection()[0];
          if (selectedItem) {
			$('.piechart1').val(1);
            var topping = data.getValue(selectedItem.row, 0);   
			//alert('The user selected ' + topping); 
			call_overlay(mouse.x,mouse.y,topping, 'piechart1', 'piechart7');
			
         }
       }
	   
        var my_div = document.getElementById('piechart7');
        var chart = new google.visualization.PieChart(document.getElementById('piechart7'));		
        chart.draw(data, options);
      }
	  
	  function call_overlay(x,y,topping,graphCls,graphDiv){ 
		if($('.'+graphCls).val() == '1'){ 
				var offset = $('#'+graphDiv).offset();
				var left = x;
				var top = y;
				var theHeight = $('.popover2').height();
				$('.graphRow').hide();
				topping = topping.replace(/\s+/g, '_');
				$('.popover2').show();
				$('.'+topping).show();
				$('.popover2').css('left', (left+10) + 'px');
				$('.popover2').css('top', (top-(theHeight/2)-10) + 'px');
			}
	 }
	 
	 function call_mouse_over(div) {
			$('#'+div).css('cursor','pointer')
		}  
        function call_mouse_out(div) {
			$('#'+div).css('cursor','default')
		} 
		
    </script>		
