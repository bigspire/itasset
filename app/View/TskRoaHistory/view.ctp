<style>
.form-horizontal.form-bordered .control-group .control-label{
padding:10px 10px 0px 10px;
}
</style>	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>View ROA</h1>
					</div>
					<div class="pull-right" style="margin-top:20px;">

				<a href="javascript:void(0);" class="close_colorBox" rel="<?php echo $roa_data['TskRoaHistory']['id'];?>" ><button type="button" class="btn"><i class="icon-remove"></i> Close</button></a>
										
				</div>
				</div>
				
				
					<div class="row-fluid">
					<div class="span12">
						<div class="box box-bordered" style="border-top:1px solid #cccccc">
							
							<div class="box-content nopadding">
								
								
								<?php echo $this->Form->create('TskRoaHistory', array('id' => '', 'class' => 'form-horizontal form-column form-bordered')); ?>
								
								
									<div class="span6">
									
								<div class="control-group">
											<label for="textfield" class="control-label" style="">Recognition Month </label>
											<div class="controls">
												<?php echo $this->Functions->format_month($roa_data['TskRoaHistory']['reward_month']);?>
											</div>
										</div>
										
										<div class="control-group">
											<label for="textfield" class="control-label">Employee Name (s) </label>
											<div class="controls">
													<?php 
													$bus_unit = explode(',', $roa_data[0]['bus_unit']);
													$roa_member = explode(',', $roa_data[0]['roa_member']);
													$dept = explode(',', $roa_data[0]['dept']);
													$branch = explode(',', $roa_data[0]['branch']);
													foreach($roa_member as  $key => $member):
													echo '<b>'.$member.'</b>'. ', '.$bus_unit[$key]. ', '.$dept[$key]. ', '.$branch[$key]."<br>";
													endforeach;
													?>
													
												
											</div>
										</div>
										
											<div class="control-group">
											<label for="password" class="control-label">Your Rating</label>
											<div class="controls">
												<?php echo $this->Functions->show_roa_rating($roa_data['TskRoaHistory']['rating']);?>
												
												
											</div>
										</div>	
										
<div class="control-group">
											<label for="password" class="control-label">Describe in details </label>
											<div class="controls">
											<?php echo $roa_data['TskRoaHistory']['emp_acts'];?>
												
												
											</div>
										</div>
										
										
									<div class="control-group">
											<label for="password" class="control-label">Star? </label>
											<div class="controls">
												<?php 
										if($roa_data[0]['star_type'] != ''):
											$type_exp = explode(',' ,  $roa_data[0]['star_type']);
											foreach($type_exp as $val):		
										?>
											<span class="label label-<?php echo $this->Functions->get_star_color($val);?>" style="margin-left:10px;margin-top:10px;"><?php echo $this->Functions->get_star_msg($val);?></span>
											<?php endforeach;endif; ?>
												
												
											</div>
										</div>
								
										
									</div>
									<div class="span6">
											<div class="control-group">
											<label for="textfield" class="control-label">Individual or Team? </label>
											<div class="controls">
													<?php echo $this->Functions->get_roa_type($roa_data['TskRoaHistory']['type']);?>
													
												
											</div>
										</div>
										
										<div class="control-group">
											<label for="password" class="control-label">Recommend For </label>
											<div class="controls">
												<?php echo $roa_data[0]['roa_category'];?>
											</div>
										</div>
									
									<div class="control-group">
											<label for="password" class="control-label">Business performance</label>
											<div class="controls">
												
												<?php echo $roa_data['TskRoaHistory']['emp_relate'];?>
											</div>
										</div>
											
									<div class="control-group">
											<label for="password" class="control-label">Attach any document</label>
											<div class="controls">
												<?php if(!empty($roa_data['TskRoaHistory']['attachment'])):?>
												<a href="<?php echo $this->webroot;?>tskroahistory/download_attachment/<?php echo $roa_data['TskRoaHistory']['attachment'];?>/" class="btn btn-pink" rel="tooltip" title="Download"><?php echo $roa_data['TskRoaHistory']['attachment'];?></a>
												<?php else:?>
												No File Attached
												<?php endif; ?>
												
												
											</div>
										</div>
									
									<div class="control-group">
											<label for="password" class="control-label">Created By / On</label>
											<div class="controls">
												
												<?php echo $roa_data['Employee']['first_name'];?>, <?php echo $this->Functions->format_date($roa_data['TskRoaHistory']['created_date']);?>
											</div>
										</div>
									</div>
									
								<?php echo $this->Form->end(); ?>
							</div>
						</div>
					</div>
				
				
				
				
				
				</div>
					
					
				</div>
		
			
			</div>
		
		
						<input type="hidden" value="<?php echo $this->webroot;?>" id="root"/>
							<input type="hidden" value="<?php echo $this->webroot;?>tskroahistory/" id="webroot"/>
							<input type="hidden" value="<?php echo $this->request->params['pass'][0];?>" id="tsk_id"/>
							<input type="hidden" id="view_roa"/>
		
		</div>	
			
		
	

