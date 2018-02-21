<?php echo $this->element('tsk_menu'); ?>
	
	
	<?php if(!empty($this->request->data['TskReport']['month_year'])):?>
	
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
	  <?php foreach($plannerHR as $key => $data): 
	  $planned_split = explode('|', $data[0]);?>
      google.setOnLoadCallback(drawChart<?php echo $key;?>);
      function drawChart<?php echo $key;?>() {
			
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Planned Hrs',  <?php echo $planned = $this->Functions->check_max_percent($planned_split[0]);?>],
          ['Unplanned Hrs',  <?php echo $unplanned = $this->Functions->check_max_percent($planned_split[1]);?>],
		  ['Not Planned Hrs', <?php echo $this->Functions->check_max_percent(100 - ($planned + $unplanned));?>],
        
        ]);

        var options = {
          title: '<?php echo $data[1];?>',
		  titleTextStyle:{fontSize: 13,bold:false},
          is3D: true,
		   slices: {
            0: { color: '#18D315' },
            1: { color: '#FCD96F' },
			2: { color: '#D9DBD9' }
          },
		   legend: 'none', //{position: 'bottom', textStyle: {color: '#000000', fontSize: 13,alignment:'center'}},
		   pieSliceText: 'percentage',
		   pieSliceTextStyle: {color: '#000000'},
		   tooltip:{text: 'percentage'}
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'+<?php echo $key;?>));

        chart.draw(data, options);
      }
	  <?php endforeach; ?>
    </script>
	
	<?php endif; ?>
	

	
	
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Reports</h1>
						
						
					</div>
				
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>tskhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						
						
						<li>
							<a href="<?php echo $this->webroot;?>tskreport/<?php echo $this->params['action'];?>/">Reports</a>
							
						</li>
						
						
					</ul>
					
				</div>
				
				
				
				<?php echo $this->Session->flash();?>
				
					<div class="row-fluid footer_div">
					<div class="span12">
						<div class="box box-bordered box-color">
						
						<div class="box-title">
								<h3><i class="icon-list"></i> Reports - <?php echo ucfirst($this->params['action']);?></h3>
							</div>
							
						

						<?php echo $this->Form->create('TskReport', array('name' => '', 'type' => '', 'id' => 'formID ', 'class' => 'form-vertical')); ?>
							<div class="box-content" >
							
						<div class="dataTables_wrapper">
						
				<div class="" id="DataTables_Table_8_filter"  style="padding:15px">
		
		<?php if($this->params['action'] == 'individual'):?>
		
		<span>Search:</span>  
		
		<span>Employee:</span>		<?php echo $this->Form->input('emp_id', array('div'=> false,'type' => 'select', 'label' => false, 'class' => 'input-large', 'empty' => 'All', 'selected' => $this->params->query['emp_id'], 'required' => false, 'placeholder' => '', 'style' => "clear:left", 'options' => $empList, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
		
		
							
		
		<?php else: ?>
		
		<span>Type:</span> <?php echo $this->Form->input('report_type', array('div'=> false,'type' => 'select', 'label' => false, 'class' => 'required input-medium reportType', 'empty' => 'Select', 'selected' => $this->params->query['report_type'], 'required' => false, 'placeholder' => '', 'style' => "clear:left", 'options' => array('D' => 'Department','B' => 'Business Unit','L' => 'Location'), 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?>
		
		<span class="dn Ddiv"><span>Department:</span>		<?php echo $this->Form->input('dept_id', array('div'=> false,'type' => 'select', 'label' => false, 'class' => 'selDrop input-large', 'empty' => 'All', 'selected' => $this->params->query['dept_id'], 'required' => false, 'placeholder' => '', 'style' => "clear:left", 'options' => $deptList, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> </span>
		
		<span  class="dn Bdiv"><span>Business Unit:</span>		<?php echo $this->Form->input('bus_unit', array('div'=> false,'type' => 'select', 'label' => false, 'class' => 'selDrop input-medium', 'empty' => 'All', 'selected' => $this->params->query['bus_unit'], 'required' => false, 'placeholder' => '', 'style' => "clear:left", 'options' => $businessList, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> </span>
		
		<span  class="dn Ldiv"><span>Location:</span>		<?php echo $this->Form->input('location', array('div'=> false,'type' => 'select', 'label' => false, 'class' => 'selDrop input-medium', 'empty' => 'All', 'selected' => $this->params->query['location'], 'required' => false, 'placeholder' => '', 'style' => "clear:left", 'options' => $branchList, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> </span>
		
		<?php endif; ?>
		
				<span>Month:</span>								<?php echo $this->Form->input('month_year', array('div'=> false,'type' => 'text', 'value' => $this->request->query['month_year'], 'id' => 'srch_month','label' => false, 'class' => 'monthpick input-small required', 'required' => false, 'placeholder' => 'Month', 'autocomplete' => 'off',  'style' => "clear:left",'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 	

				

		<input type="submit" value="Submit" class="chkReport btn btn-primary" style="margin-bottom:9px;margin-left:4px;">

		<?php if(!empty($this->request->data['TskReport']['month_year'])):?>
		<a href="<?php echo $this->webroot;?>tskreport/<?php echo $this->params['action'];?>/"><button style="margin-bottom:9px;margin-left:4px;" type="button" class="btn btn-primary"><i class="icon-refresh"></i> Reset</button></a>
		
		<!--a href="javascript:void(0)" rel="pcontent" class="print" ><button style="margin-bottom:9px;margin-left:4px;" type="button" class="btn btn-orange"><i class="icon-print"></i> Print</button></a-->
		
		<?php if($this->params['action'] == 'individual'):?>
		<a href="<?php echo $this->webroot;?>tskreport/<?php echo $this->params['action'];?>/?action=export&month_year=<?php echo $this->request->data['TskReport']['month_year'];?>&emp_id=<?php echo $this->request->data['TskReport']['emp_id'];?>" title="Download Excel" rel="" class="" ><button style="margin-bottom:9px;margin-left:60px;" type="button" class="btn btn-orange"><i class="icon-download-alt"></i> XLS</button></a>
		<?php else: ?>
		<a href="<?php echo $this->webroot;?>tskreport/<?php echo $this->params['action'];?>/?action=export&month_year=<?php echo $this->request->data['TskReport']['month_year'];?>&dept_id=<?php echo $this->request->data['TskReport']['dept_id'];?>&bus_unit=<?php echo $this->request->data['TskReport']['bus_unit'];?>&location=<?php echo $this->request->data['TskReport']['location'];?>&sel=<?php echo $this->request->data['TskReport']['selReport'];?>" title="Download Excel" rel="" class="" ><button style="margin-bottom:9px;margin-left:60px;" type="button" class="btn btn-orange"><i class="icon-download-alt"></i> XLS</button></a>

		<?php endif; ?>
				
		<?php endif; ?>
		
		
									
						
								</div>			
								

		
								
						<div id="pcontent">
						
						<?php if(!empty($this->request->data['TskReport']['month_year'])):?>
						
					<table style="font-weight:bold;font-size:15px;text-decoration:underline;" align="center"><tr><td style="">Daily Planning Report: <?php echo $empMonth;?></td></tr></table>

												
												
						<table style="margin-bottom:20px;margin-left:40px;font-size:smaller;padding:10px;color:#545454;border:0px solid #efefef">
						<tbody><tr>
						<td class="legendColorBox"><div style="border:1px solid null;padding:1px">
						<div style="width:4px;height:0;border:5px solid #61F93B;overflow:hidden"></div></div></td> <td class="legendLabel">Planned Hrs (in %)</td>
						<td class="legendColorBox"><div style="border:1px solid null;padding:1px">
						<div style="width:4px;height:0;border:5px solid #FCD96F;overflow:hidden"></div></div></td>
						<td class="legendLabel">Un planned Hrs (in %)</td>
						<td class="legendColorBox"><div style="border:1px solid null;padding:1px">
						<div style="width:4px;height:0;border:5px solid #F0F2EF;overflow:hidden"></div></div></td>
						<td class="legendLabel">Not planned Hrs (in %)</td>
						</tr></tbody></table>
						
						<?php endif; ?>
						
								
									
								<?php foreach($plannerHR as $key => $data): ?>

								 <div class="piechart" id="piechart<?php echo $key;?>" style="width: 300px;float:left;"></div>
								
								<?php endforeach; ?>
						
						</div>



								
							</div>	

							</div>
						<?php echo $this->Form->input('selReport', array('id'=> 'selReport', 'type' => 'hidden'));?> 
						 <?php echo $this->Form->end(); ?>
						</div>
					</div>
				</div>
					
					
				</div>
		
			
			</div>
			

		</div>	
			
		
		
		
		
				
		


