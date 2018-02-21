<div id="left" style="background:#f4f4f4;" class="persist-area"  >
			
		
			<div class="subnav persist-header" style="background:#f4f4f4;margin-top:0">
				
			
				<div class="subnav-title" style="background:#f4f4f4;margin-top:15px;">
					<a href="#" class='toggle-subnav'><span></span></a>
				</div>
				
				<div class="subnav-title" style="background:#f4f4f4;">
					
				</div>
				
				
				<ul class="subnav-menu" style="background:#f4f4f4;">
				
					<?php if($this->request->params['controller'] == 'hrreport') :?>
					
					
					<li>
						<a  id="2" href="<?php echo $this->webroot;?>hrreport/attendance/" class="sel_report <?php echo $this->Functions->set_report_cls('attendance');?>">Attendance</a>
					</li>
					
					<li>
						<a  id="3" href="<?php echo $this->webroot;?>hrreport/leave/" class="sel_report  <?php echo $this->Functions->set_report_cls('leave');?>">Leave</a>
					</li>
					
					<li>
						<a  id="4" href="<?php echo $this->webroot;?>hrreport/permission/" class="sel_report  <?php echo $this->Functions->set_report_cls('permission');?>">Permission</a>
					</li>
					
					
					<li>
						<a  id="5" href="<?php echo $this->webroot;?>hrreport/att_change/" class="sel_report  <?php echo $this->Functions->set_report_cls('att_change');?>">Attendance Change</a>
					</li>
					
					<?php else:?>
					
						
					<li>
						<a  id="2" href="<?php echo $this->webroot;?>finreport/advance/" class="sel_report <?php echo $this->Functions->set_report_cls('advance');?>">Advance</a>
					</li>
					
					<li>
						<a  id="3" href="<?php echo $this->webroot;?>finreport/expense/" class="sel_report  <?php echo $this->Functions->set_report_cls('expense');?>">Expense</a>
					</li>
					
					<li>
						<a  id="4" href="<?php echo $this->webroot;?>finreport/adv_payable/" class="sel_report  <?php echo $this->Functions->set_report_cls('adv_payable');?>">Advance Payable</a>
					</li>
					
					
					<li>
						<a  id="5" href="<?php echo $this->webroot;?>finreport/exp_payable/" class="sel_report  <?php echo $this->Functions->set_report_cls('exp_payable');?>">Expense Payable</a>
					</li>
					
					<?php endif; ?>
					
					
					
				
				</ul>
				
				
				
			
			
			</div>
			
			</div>
		
		