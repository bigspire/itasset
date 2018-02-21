 <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Month', 'Present', 'Absent', 'Late attendance'],
          ['Jan',  23,  20,    10],
          ['Feb',  32,  15,    5],
          ['Mar',  25,  12,    12],
          ['Apr',  33, 10,     4],
		  ['May',  32,  7,    1],
		  ['Jun',  28,  2,     8]
        ]);

        var options = {
          title: 'Attendance Performance',
          hAxis: {title: 'Month', titleTextStyle: {color: 'red'}},
		  
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('att_div'));
		
		/*google.visualization.events.addListener(chart, 'ready', function () {
			att_div.innerHTML = '<img src="' + chart.getImageURI() + '">';
		});*/		  
        chart.draw(data, options);
		 document.getElementById('leave_png').outerHTML = '<a target="_blank" style="color:#fff" href="' + chart.getImageURI() + '">Print</a>';
      }
	  
	  google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart2);
      function drawChart2() {
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

        var chart = new google.visualization.ColumnChart(document.getElementById('leave_div'));			  
        chart.draw(data, options);
		document.getElementById('png').outerHTML = '<a target="_blank" style="color:#fff" href="' + chart.getImageURI() + '">Print</a>';
      }
	  
	  google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart3);
      function drawChart3() {
        var data = google.visualization.arrayToDataTable([
          ['Month', 'Awaiting Approval', 'Approved', 'Rejected'],
          ['Jan',  3,      2, 0],
          ['Feb',  4,      1, 0],
          ['Mar',  3,       4, 0],
          ['Apr',  12,      6, 1],
		  ['May',  12,      2, 0],
		  ['Jun',  6,      9, 0]
        ]);

        var options = {
          title: 'Permission',
          hAxis: {title: 'Month', titleTextStyle: {color: 'red'}},
		   colors: ['#3366CC', '#55C613', '#DC3912']
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('permission_div'));
		
		/*google.visualization.events.addListener(chart, 'ready', function () {
			att_div.innerHTML = '<img src="' + chart.getImageURI() + '">';
		});*/		  
        chart.draw(data, options);
		document.getElementById('per_png').outerHTML = '<a target="_blank" style="color:#fff" href="' + chart.getImageURI() + '">Print</a>';
      }
	  
	   google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart4);
      function drawChart4() {
        var data = google.visualization.arrayToDataTable([
          ['Month', 'Awaiting Approval', 'Approved', 'Rejected'],
          ['Jan',  3,      2, 0],
          ['Feb',  4,      1, 0],
          ['Mar',  3,       4, 0],
          ['Apr',  12,      6, 1],
		  ['May',  12,      2, 0],
		  ['Jun',  6,      9, 0]
        ]);

        var options = {
          title: 'Attendance Change',
          hAxis: {title: 'Month', titleTextStyle: {color: 'red'}},
		   colors: ['#3366CC', '#55C613', '#DC3912']
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('att_change_div'));
		
		/*google.visualization.events.addListener(chart, 'ready', function () {
			att_div.innerHTML = '<img src="' + chart.getImageURI() + '">';
		});*/		  
        chart.draw(data, options);
		document.getElementById('att_chg_png').outerHTML = '<a target="_blank" style="color:#fff" href="' + chart.getImageURI() + '">Print</a>';
      }
	  
	  
	  
	  function UpdateTableHeaders() {
   $(".persist-area").each(function() {
   
       var el             = $(this),
           offset         = el.offset(),
           scrollTop      = $(window).scrollTop(),
           floatingHeader = $(".floatingHeader", this)
       
       if ((scrollTop > offset.top) && (scrollTop < offset.top + el.height())) {
           floatingHeader.css({
            "visibility": "visible"
           });
       } else {
           floatingHeader.css({
            "visibility": "hidden"
           });      
       };
   });
}

// DOM Ready      
$(function() {

   var clonedHeaderRow;

   $(".persist-area").each(function() {
       clonedHeaderRow = $(".persist-header", this);
       clonedHeaderRow
         .before(clonedHeaderRow.clone())
         .css("width", clonedHeaderRow.width())
         .addClass("floatingHeader");
         
   });
   
   $(window)
    .scroll(UpdateTableHeaders)
    .trigger("scroll");
   
});

	  function UpdateTableHeaders2() {
   $(".persist-area2").each(function() {
   
       var el             = $(this),
           offset         = el.offset(),
           scrollTop      = $(window).scrollTop(),
           floatingHeader = $(".floatingHeader2", this)
       
       if ((scrollTop > offset.top) && (scrollTop < offset.top + el.height())) {
           floatingHeader.css({
            "visibility": "visible"
           });
       } else {
           floatingHeader.css({
            "visibility": "hidden"
           });      
       };
   });
}

// DOM Ready      
$(function() {

   var clonedHeaderRow;

   $(".persist-area2").each(function() {
       clonedHeaderRow = $(".persist-header2", this);
       clonedHeaderRow
         .before(clonedHeaderRow.clone())
         .css("width", clonedHeaderRow.width())
         .addClass("floatingHeader2");
         
   });
   
   $(window)
    .scroll(UpdateTableHeaders2)
    .trigger("scroll");
   
});

$(function() {
  $('a[href*=#]:not([href=#])').click(function() {
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
      if (target.length) {
        $('html,body').animate({
          scrollTop: target.offset().top
        }, 1000);
        return false;
      }
    }
  });
});
    </script>
	
<?php echo $this->element('hr_menu'); ?>
		
		
		<span id="top_row" ></span>
		
	<div class="container-fluid" id="content">
	
	<?php echo $this->element('report_left') ?>
		
		<div id="main"  class="" style="margin-left:200px">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Reports</h1>
						
						
					</div>
					
				
				
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>hrhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						
						
						<li>
							<a href="<?php echo $this->webroot;?>hrreport/">Reports</a>
							
						</li>
						
						
					</ul>
					
				</div>
				
					<div class="persist-area2">
					
					<div class="" style="margin-top:15px;height:60px;border-bottom:1px solid #efefef;">
						
						
						<div class="persist-header2" id="DataTables_Table_8_filter" style="z-index:9999999;padding:10px 20px;background:#f4f4f4;" >
				
						<select name="data[HrLeaveApprove][emp_id]" class="input-large" placeholder="" style="clear:left" id="HrLeaveApproveEmpId">
<option value="">Employee</option>
<option value="4">ATANU GUPTA</option>
<option value="10">KARTHIKEYAN S</option>
<option value="12">LAKSHMAN N</option>
<option value="14">MAZHAR KAGDI</option>
<option value="24">RAMESH PRAKASH</option>
<option value="35">RAVICHANDRAN J</option>
<option value="26">SAIKIRAN MARISETTI</option>
<option value="33">THIRU MURUGAN</option>
</select>
					

<select name="data[HrLeaveApprove][emp_id]" class="input-large" placeholder="" style="clear:left" id="HrLeaveApproveEmpId">
<option value="">Approver</option>
<option value="4">ATANU GUPTA</option>
<option value="10">KARTHIKEYAN S</option>
<option value="12">LAKSHMAN N</option>
<option value="14">MAZHAR KAGDI</option>
<option value="24">RAMESH PRAKASH</option>
<option value="35">RAVICHANDRAN J</option>
<option value="26">SAIKIRAN MARISETTI</option>
<option value="33">THIRU MURUGAN</option>
</select>
					
				
<span>From:</span>  
				<input name="data[HrLeave][from]" class="input-small datepick" placeholder="From Date" type="text" id="HrLeaveFrom"> 

<span>Till:</span>  
				<input name="data[HrLeave][to]" class="input-small datepick" placeholder="Till Date" type="text" id="HrLeaveTo"> 				
	
				
									
											<button class="btn btn-primary" style="margin-bottom:9px;margin-left:4px;">Search</button>
											
								<a href="/ceo_apps/hrleave/"><button style="margin-bottom:9px;margin-left:4px;" type="button" class="btn btn-primary"><i class="icon-refresh"></i> Reset</button></a>
								
								

								
								</div>
								
								
								
						
					</div>
					
					<span id="att_row" ></span>
				
				<?php echo $this->Session->flash();?>
				
					<div class="row-fluid  footer_div" >
					<div class="span12" >
						<div  class="box box-bordered box-color">
						
						<div class="box-title">
								<h3><i class="icon-bar-chart"></i> Attendance Report </h3>
							</div>
							
						

							<div class="box-content">
							<div id="att_div" style="width: 900px; height: 350px;"></div>
							
							
							
							 <div style="margin-left:10px;margin-bottom:10px;margin-left:100px;">
							 <button  class="btn btn-primary"><i class="icon-print"></i>  <a id="png"></a></button>
							  <button  class="btn btn-primary"><i class="icon-reply"></i>  Export</button>
						
						 
						   </div> </div>
						 
					
						</div>
					
					<span id="lv_row" ></span>	
					<div class="box box-bordered box-color">
						
						<div class="box-title">
								<h3><i class="icon-bar-chart"></i> Leave Report </h3>
							</div>
							
						

							<div class="box-content">
							
						  
						
						  
							<div id="leave_div" style="width: 900px; height: 350px;"></div>
							
							
							 <div style="margin-left:10px;margin-bottom:10px;margin-left:100px;" >
						  <button  class="btn btn-primary"><i class="icon-print"></i> <a id="leave_png"></a></button>
						    <button  class="btn btn-primary"><i class="icon-reply"></i>  Export</button>
						  </div>
						  
						  
						
						  
						  
						  
						  
						 

							</div>
					
						<input type="hidden" value="<?php echo $this->webroot;?>hrreport/" id="webroot">
						</div>
					
					
						<span id="per_row" ></span>
					<div class="box box-bordered box-color">
						
						<div class="box-title">
								<h3><i class="icon-bar-chart"></i> Permission Report </h3>
							</div>
							
						

							<div class="box-content">
							
							
							
							
						  
						  
							<div id="permission_div" style="width: 900px; height: 350px;"></div>
						  
						  
						  <div style="margin-left:10px;margin-bottom:10px;margin-left:100px;" >
						  <button  class="btn btn-primary"><i class="icon-print"></i>  <a id="per_png"></a></button>
						    <button  class="btn btn-primary"><i class="icon-reply"></i>  Export</button>
						  </div>

							</div>
					
						<input type="hidden" value="<?php echo $this->webroot;?>hrreport/" id="webroot">
						</div>
					
					
					<span id="att_change_row" ></span>
					<div class="box box-bordered box-color">
						
						<div class="box-title">
								<h3><i class="icon-bar-chart"></i> Attendance Change Report </h3>
							</div>
							
						

							<div class="box-content">
							<div id="att_change_div" style="width: 900px; height: 350px;"></div>
							
							
							
							 <div style="margin-left:10px;margin-bottom:10px;margin-left:100px;">
							 <button  class="btn btn-primary"><i class="icon-print"></i>  <a id="att_chg_png"></a></button>
							  <button  class="btn btn-primary"><i class="icon-reply"></i>  Export</button>
						
						  </div>
						  
						  
							

							</div>
					
						<input type="hidden" value="<?php echo $this->webroot;?>hrreport/" id="webroot">
						</div>
					
					
					
					
					
					
					
					
					
					
					
					
					</div>
				</div>
					
					<p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>
					
					</div>
					
				</div>
		
			
			</div>
			

		</div>	
			
		
		
		
		
				
		


