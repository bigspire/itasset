	<?php  foreach($leaveDetail as $key => $type):?>
										
								<?php
									$rowspan = ''; $padding = '';
									if($type['HrLeaveType']['id'] == '2' && $probation_review == 'C' && !empty($pl_encashable)): 
									$rowspan = "rowspan=2";
									$padding = "padding:25px 8px";									
									endif;							
								?>			
										
					<tr >
				
				<?php if($rowspan):?>
					<td <?php echo $rowspan;?> style="<?php echo $padding;?>"><a  rel='preview' data-trigger='hover'
							title='PL Balance Details' data-html = 'true' data-content="<?php echo $pl_history;?>"
							href='javascript:void(0)'><?php echo $type['HrLeaveType']['desc'];?></a></td>
				<?php else:?>
		<td><?php echo $type['HrLeaveType']['desc'];?></td>
				<?php endif; ?>												
										
											
					<td class='hidden-350' style="border-right:1px solid #efefef!important"><?php 
							$exp_doj = explode('-', $this->Session->read('USER.Login.doj'));
							$user_type = $emp_type ? $emp_type : $this->Session->read('USER.Login.emp_type');
							if(($type['HrLeaveType']['id'] == '1' &&  $user_type == 'A') || ($type['HrLeaveType']['id'] == '1' &&  $user_type == 'A2')):
							$tot_nbl = 1 - $applied_nbl;
							$tot_nbl = ($exp_doj[1] == date('m') && $exp_doj[0] == date('Y') && $exp_doj[2] > 15) ? '0' : $tot_nbl; 
							echo $tot_nbl.' '.$this->Functions->check_day_plural($tot_nbl);							
							elseif($type['HrLeaveType']['id'] == '1'  && $probation_review == 'Y'): 
							$tot_nbl = $balance_nbl-$applied_nbl;							
							echo $tot_nbl.' '.$this->Functions->check_day_plural($tot_nbl);	
							elseif($type['HrLeaveType']['id'] == '1' && $probation_review == 'C' && $confirm_pro_rata == '1'): 
							$tot_nbl = abs($balance_nbl-$applied_nbl);							
							echo $tot_nbl.' '.$this->Functions->check_day_plural($tot_nbl);								
							elseif($type['HrLeaveType']['id'] == '1'):
							$tot_val = $type['HrLeaveType']['no_days'] - $applied_nbl;
							echo $tot_val.' '.$this->Functions->check_day_plural($tot_val);
							elseif($type['HrLeaveType']['id'] == '2' && $probation_review == 'Y'): 
							echo 'N/A';
							elseif($type['HrLeaveType']['id'] == '2' && $probation_review == 'C'): 							
							$tot_pl = $balance_pl-$applied_pl;							
							echo $tot_pl = $tot_pl > 0 ? $tot_pl.' '.$this->Functions->check_day_plural($tot_pl). ' (Available)' : 'Nil';
							elseif($type['HrLeaveType']['id'] == '4'): 		
							$tot_days = $type['HrLeaveType']['no_days'] - $applied_matl;
							echo $tot_days.' '.$this->Functions->check_day_plural($tot_days);
							elseif($type['HrLeaveType']['id'] == '5'): 		
							$tot_days = $type['HrLeaveType']['no_days'] - $applied_patl;
							echo $tot_days.' '.$this->Functions->check_day_plural($tot_days);							
							else: 
							//$tot_days = $type['HrLeaveType']['no_days'] - $used_data[$key][0]['count'];
							//echo $tot_days.' '.$this->Functions->check_day_plural($tot_days);
							endif; 
							?>						
							
							</td>
							
							</tr>
							
							<?php if(!empty($pl_encashable) && $type['HrLeaveType']['id'] == '2'  && $probation_review == 'C'):?>
							<tr><td colspan="2"><div style="margin-top:2px;"><?php echo $pl_encashable;?> <?php echo $this->Functions->check_day_plural($pl_encashable);?> <span>(Encashable)</span> </div></td></tr>
							<?php endif; ?>				
							
							
										
									<?php endforeach; ?>
								
							
			<?php if($associateUSER == '1'):?>	
							<tr>				
						<td>Special Leave</td>													
										
											
					<td class="hidden-350" style="border-right:1px solid #efefef!important">
							 <?php echo $no_spl_avail = $no_spl_avail - $applied_sl;?> 
							 <?php echo $this->Functions->check_day_plural($no_spl_avail);?>
							
							</td>
							
							</tr>
							
						<?php endif; ?>	

						<tr>
								<td>Comp. Off</td>
								<td style="border-right:1px solid #efefef!important">
							
							<?php if($no_compoff > 0):?>
								<a  rel='preview' data-trigger='hover'
							title='Comp. Off Details' data-placement="top" data-html = 'true' data-content="<?php echo $comp_details;?>"
							href='javascript:void(0)'><?php echo $no_compoff;?> <?php echo $this->Functions->check_day_plural($no_compoff);?></a> 
							
							<?php else:?>
							
							Nil
							<?php endif; ?>
							
							</td>
								</tr>
							
					