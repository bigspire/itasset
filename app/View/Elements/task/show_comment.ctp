	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>View Comment</h1>
					</div>
					
				</div>
			
				
					<div class="row-fluid">
					
					
					<div class="span12" >
						<div class="box" >
							
							<div class="box-content nopadding">
								
								
								
								
									<div class="span12">
									
									
										<table class="table table-nomargin" style="border:1px solid #ddd">
										
										<tbody>
										
										
										
										<?php if($this->request->params['pass']['1'] == 'P' || $this->request->params['pass']['1'] == 'L'):?>
										<tr>
										<th width="150"><?php echo $date_field;?></th>
										
										<td><?php echo $date_data;?></td>
											</tr>
											<?php endif; ?>
								
									<tr>
										
										<th width=""><?php echo $remark_field;?></th>
										
										<td><?php echo $remark_data;?></td>
										
										</tr>
									
									
									
								
									
									
									</tbody>
									</table>
										
											

							
										
											
										
										
									</div>
								<input type="hidden" id="viewRemark">	
												<input type="hidden" value="0" id="overlayclose"/>
	
								

							</div>
						</div>
					</div>
				
				
				</div>
					
					
				</div>
		
			
			</div>
		</div>	
			
	
