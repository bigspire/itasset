<script type="text/javascript" src="https://www.google.com/jsapi?autoload={'modules':[{'name':'visualization','version':'1','packages':['orgchart']}]}"></script>
<div class="page-header header smaller lighter red" style="margin:0;">
							<h2>
								
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									Org Structure
									<img style="float:right;margin-right:20px;" title="Career Tree HR Solutions Pvt. Ltd." src="<?php echo $this->webroot;?>img/career-tree-logo-small.png">
								</small>
							</h2>
						</div>
						
<div id="chart_div" style="cursor:move;margin-top:5px;"></div>
<style type="text/css">
.google-visualization-orgchart-node-medium{font-size:12px}
.google-visualization-orgchart-table{border-collapse:separate !important}
.google-visualization-orgchart-connrow-small{height:25px;}
.google-visualization-orgchart-node-small{font-size:0.9em}
.google-visualization-orgchart-node{border-radius:5px !important;border:1px solid #F6ACF9;box-shadow:none;background:-webkit-linear-gradient(#FCF4FC, #F9C9FC);}
.google-visualization-orgchart-linebottom{border-bottom:1px dashed #FFAB99}
.google-visualization-orgchart-lineleft{border-left:1px dashed #FFAB99}
.google-visualization-orgchart-lineright{border-right:1px dashed #FFAB99}
.btn-yellow, .btn-yellow:focus {
background-color: #fee188!important;
border-color: #fee188;
font-weight:bold;
}
.btn-minier {
padding: 0 4px;
line-height: 18px;
border-width: 2px;
font-size: 12px;
}
.btn-grey, .btn-grey:focus {
background-color: #a0a0a0!important;
border-color: #a0a0a0;
font-weight:bold;
}
</style> 
<script style="text/javascript"> 
//if(document.getElementById('refresh_page').value == 0){
	google.load("visualization", "1", {packages:["orgchart"]});
    google.setOnLoadCallback(drawChart);
    function drawChart(arg1, arg2) {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Name');
        data.addColumn('string', 'Manager');
        data.addColumn('string', 'ToolTip');
        data.addRows([
		
			[{v:'Karthikeyan', f:'<div style="color:#EF4B25;" >Karthikeyan</div><div style="width:100px;font-size:0.9em">Director</div>'},'', ''],

		<?php foreach($org_tree_data as $key => $org_data):?>
      
		 <?php 
		 /* if($org_data['Home']['photo'] != '' && $org_data['Home']['photo_status'] == 'A'):
			$org_photo = "<br><img style=border-radius:6px src=".$this->webroot."timthumb.php?src=uploads/photo/".str_replace(' ', '%20', $org_data['Home']['photo'])."&h=75&q=100/>";			
			else:
			$org_photo = '';
			endif;
		*/
		
			
		 ?>

          [{v:'<?php echo $org_data['Home']['first'];?>', f:'<div style="color:#EF4B25;" ><?php echo $org_data['Home']['first'];?></div><div style="width:100px;font-size:0.9em"><?php echo $org_data['HrDesignation']['desig_name'];?></div>'},'<?php echo $org_data['tbl_level1']['l1_first'];?>', ''],
		  <?php endforeach; ?>
        ]);
		org_size = (arg2 == '' || arg2 == undefined) ? 'small' : arg2;
        var chart = new google.visualization.OrgChart(document.getElementById('chart_div'));
        chart.draw(data, {allowHtml:true,allowCollapse:true,size:org_size});
		
	
		for (var i = 1; i < data.getNumberOfRows(); i++) {	
			if(chart.getChildrenIndexes(i) != ''){ 
				chart.collapse(i, true);
			}else{
				chart.collapse(i, false);
			}			
		}
	
		
		//node = chart.getChildrenIndexes(0);
		//alert(node);
		//alert(chart.getChildrenIndexes(11));
		//chart.collapse(11, true);
    }
	
	$(document).ready(function() { 	
		// drag the org. chart 
		$('#chart_div').draggable();
		
		/* set org. diagram size */
		$('.orgSize').click(function(){
			// update button
			for(i = 1; i < 3; i++){	
				if($(this).attr('val') == 's'+i){
					$(this).addClass('btn-yellow').removeClass('btn-grey');
				}else{
					$('.orgS'+i).removeClass('btn-yellow');
				}
			}
			drawChart('',$(this).attr('rel'));		
		});
	
	});
//}
</script>
<div style="margin-top:10px;bottom:0;position:absolute">
												<input type="button" rel="small" val="s1" value="Normal" class="orgS1 orgSize btn btn-minier btn-yellow" style="margin-top:5px">
												
												<input type="button" rel="large" val="s3" value="Bigger" class="orgS2 orgSize btn btn-minier btn-grey" style="margin-top:5px">	
												<span style="float:right;margin-left:20px;font-style:italic;margin-right:10px;color:#E05E26"><i class="icon-check"></i> Double click on the box to open the tree. <br><i class="icon-move"></i> Drag the chart to move</span>
												
												</div>
