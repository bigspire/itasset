<?php 
if($this->request->params['controller'] == 'tvlreqapr' || $this->request->params['controller'] == 'tvlreq' || $this->request->params['controller'] == 'tvlbooktkt'):
$model = 'TvlReqStatus';
else:
$model = 'FinAdvStatus';
endif;
?>

<?php if(!empty($lead_remarks[0][$model]['remarks'])):?>
<div class="row-fluid" style="width:80%" >

	<div class="span10">
						<div class="box">
							<div class="box-title">
								<h3  style="color:#2a2a2a">
									<i class="icon-comments"></i>
									Remarks
								</h3>
							
							</div>
							<div class="box-content scrollable" data-height="160" data-start="top" data-visible="true">
								<ul class="messages">
									
							<?php foreach($lead_remarks as $remarks):?>		
								<li class="left">
											<div class="image">
								<?php if($remarks['HrEmployee']['photo'] != ''  && $remarks['HrEmployee']['photo_status'] == 'A'):?>
							<img src="<?php echo $this->webroot;?>timthumb.php?src=uploads/photo/<?php echo $remarks['HrEmployee']['photo'];?>&h=80&q=100" title="<?php echo $remarks['HrEmployee']['first_name'].' '.$remarks['HrEmployee']['last_name'];?>"/>	
						<?php elseif($this->Session->read('USER.Login.gender') == 'M'): ?>
						<img class="nav-user-photo" src="<?php echo $this->webroot;?>img/profile_male_s.jpg" title="<?php echo $remarks['HrEmployee']['first_name'].' '.$remarks['HrEmployee']['last_name'];?>"/>
							<?php else: ?>
							<img class="nav-user-photo" src="<?php echo $this->webroot;?>img/profile_male_s.jpg" title="<?php echo $remarks['HrEmployee']['first_name'].' '.$remarks['HrEmployee']['last_name'];?>"/>
							<?php endif; ?>	
										</div>		
											<div class="message">
												<span class="name">
						<?php echo ucwords($remarks['HrEmployee']['first_name'].' '.$remarks['HrEmployee']['last_name']);?></span>		
											<span class="caret"></span>			
											<p><?php echo $remarks[$model]['remarks'];?></p>
											<span class="time">
						<?php echo $this->Functions->time_diff($remarks[$model]['modified_date'], 0);?> ago
											</span>
										</div>
								</li>
								
							<?php endforeach; ?>	
									
									
									
								</ul>
								
					
							</div>
							
									<ul class="messages">
									<li class="insert">
										
									</li>
									</ul>
						</div>
					</div>
				
					</div>					
<?php endif; ?>