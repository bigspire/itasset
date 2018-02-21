<div class="row-fluid">
					<?php if(!empty($bothtime_miss)): ?>
					<div class="span4">
					<div class="box box-bordered blue">
							<div class="box-title">
								<h3>
									<i class="icon-file"></i>
									In & Out Time Not Marked <span class="label label-pink"><?php echo count($bothtime_miss); ?></span>
								</h3>
							</div>
							<div class="box-content" style="padding:10px;color:#666">
								<?php $comma = ', ';
									foreach($bothtime_miss as $key => $time):
									echo $this->Functions->format_date($time);
									if(count($bothtime_miss) > ++$key): echo $comma; endif;  
									endforeach;
									?>
							</div>
						</div>
					</div>
					<?php endif; ?>
					
					<?php if(!empty($intime_miss)): ?>
					<div class="span4">
					<div class="box box-bordered blue">
							<div class="box-title">
								<h3>
									<i class="icon-file"></i>
									In Time Not Marked <span class="label label-orange"><?php echo count($intime_miss); ?></span>
								</h3>
							</div>
							<div class="box-content" style="padding:10px;color:#666">
							<?php $comma = ', ';
									foreach($intime_miss as $key => $time):
									echo $this->Functions->format_date($time);
									if(count($intime_miss) > ++$key): echo $comma; endif;  
									endforeach;
									?>
							</div>
						</div>
					</div>
						<?php endif; ?>
					
					<?php if(!empty($outtime_miss)): ?>
					<div class="span4">
					<div class="box box-bordered blue">
							<div class="box-title">
								<h3>
									<i class="icon-file"></i>
									Out Time Not Marked <span class="label label-blue"><?php echo count($outtime_miss); ?></span>
								</h3>
							</div>
							<div class="box-content" style="padding:10px;color:#666">
								<?php $comma = ', ';
									foreach($outtime_miss as $key => $time):
									echo $this->Functions->format_date($time);
									if(count($outtime_miss) > ++$key): echo $comma; endif;  
									endforeach;
									?>
							</div>
						</div>
					</div>
					<?php endif; ?>
					
					
					</div>
					