<div style="float:right;margin-right:100px;">
	<img  src="<?php echo Configure::read('WEBSITE').$this->webroot; ?>timthumb.php?src=uploads/company/<?php echo $pay_data[0]['HrCompany']['logo'];?>&w=250&q=100" alt=""/>
	</div>
				
				
<div  style="float:left">
<table class="table company" align="center">
									<thead>
										<tr width="25%">
											<td class="title"><?php echo $pay_data[0]['HrCompany']['company_name']; ?></td>
										</tr>
										
									
										
										<tr>
										<td>
										<?php echo $pay_data[0]['HrCompany']['address']; ?>
</td>
				

										</tr>
										<tr>
							<td><?php echo $pay_data[0]['HrCompany']['city']; ?> - <?php echo $pay_data[0]['HrCompany']['pincode']; ?></td>		
										</tr>
									</thead>
</table>

</div>



<div  style="float:left;clear:both;">
<table class="table table-hover table-nomargin  table-bordered" align="center">
									<thead>
										<tr>
											<th align="center" style="text-align:center;font-size:24px;">PAYSLIP -  <?php echo $paymonth;?></th>
											
											
										</tr>
									</thead>
</table>
</div>


								
	
<div  style="float:left;clear:both;margin-top:5px;">
<table class="table table-hover table-nomargin  table-bordered" align="center">
									<thead>
										<tr>
				<td class="labelh labelbg" width="20%">Employee Name </td>
			<td width="30%"><?php echo $pay_data[0]['HrEmployee']['first_name'].' '.$pay_data[0]['HrEmployee']['last_name'];?></td>
											<td class="labelh labelbg"  width="22%">Date of Joining</td>
											<td width="28%">
											<?php echo $this->Functions->format_date($pay_data[0]['HrEmployee']['doj']);?></td>
										</tr>
										
										
										<tr>
											<td class="labelh labelbg">Employee No.</td>
											<td><?php echo $pay_data[0]['HrEmployee']['emp_no']; ?></td>
											<td class="labelh labelbg">Income Tax Number (PAN) </td>
											<td><?php echo $pay_data[0]['HrEmployee']['pan']; ?></td>
										</tr>
										
										<tr>
											<td class="labelh labelbg">Department</td>
											<td> <?php echo $pay_data[0]['HrDepartment']['dept_name']; ?></td>
											<td class="labelh labelbg">PF Account Number </td>
											<td><?php echo $pay_data[0]['HrEmployee']['pf_no']; ?></td>
										</tr>
										
										<tr>
											<td class="labelh labelbg">Designation </td>
											<td><?php echo $pay_data[0]['HrDesignation']['desig_name']; ?></td>
											<td class="labelh labelbg">ESI Number</td>
											<td><?php echo $pay_data[0]['HrEmployee']['esi_no']; ?></td>
										</tr>
										
										<tr>
											<td class="labelh labelbg">Location</td>
											<td><?php echo $pay_data[0]['HrBranch']['branch_name']; ?></td>
											<td class="labelh labelbg">PR Account Number (PRAN) :</td>
											<td><?php echo $pay_data[0]['HrEmployee']['pran_no']; ?></td>
										</tr>
										
										<tr>
											<td class="labelh labelbg">Bank Details </td>
											<td>

													<?php
													if(!empty($pay_data[0]['HrBankAcc']['acc_no'])):?>

														<?php echo $pay_data[0]['HrBankAcc']['acc_no']; ?>, <?php echo $pay_data[0]['HrBank']['bank']; ?>, <?php echo $pay_data[0]['HrBank']['branch']; ?>
														
														<?php endif; ?>
</td>
											<td class="total labelbg">Earned Days</td>
											<td class="total"><?php echo $pay_data[0]['HrPayslip']['attendance'] - $pay_data[0]['HrPayslip']['lop']; ?> Days</td>
										</tr>
										
									</thead>
</table>

</div>
	


											
										
									
											




<div style="float:left;clear:both;margin-top:20px;">
								<table class="table table-hover table-nomargin  table-bordered"  align="center">
									<thead>
										<tr>
											<th class="labelh" width="20%">Earnings</th>
											<th width="30%">Amount (Rs.)</th>
											<th class="labelh"  width="22%">Deductions</th>
											<th class="hidden-1024" width="28%">Amount (Rs.)</th>
											
										</tr>
									</thead>
									<tbody>
										<tr>
											<td class="labelh">Basic</td>
											<td>
												<?php echo $pay_data[0]['HrPayslip']['basic']; ?>
											</td>
											<td class="labelh">Employee's Contribution to PF</td>
											<td class="hidden-1024"><?php echo $pay_data[0]['HrPayslip']['pf']; ?></td>
										
										</tr>
										<tr>
											<td class="labelh">House Rent Allowance</td>
											<td><?php echo $pay_data[0]['HrPayslip']['hra']; ?></td>
											<td class="labelh">Employee Contribution of ESI </td>
											<td class="hidden-1024"><?php echo $pay_data[0]['HrPayslip']['esi']; ?></td>
											
										</tr>
										<tr>
											<td class="labelh">Conveyance Pay </td>
											<td><?php echo $pay_data[0]['HrPayslip']['conveyance']; ?></td>
											<td class="labelh">Loan & Advances </td>
											<td class="hidden-1024"><?php echo $pay_data[0]['HrPayslip']['loans']; ?></td>
											
										</tr>
										<tr>
											<td class="labelh">Food Allowance </td>
											<td><?php echo $pay_data[0]['HrPayslip']['food_allowance']; ?></td>
											<td class="labelh">Professional Tax </td>
											<td class="hidden-1024">(-) <?php echo $pay_data[0]['HrPayslip']['prof_tax']; ?>
</td>
											
										</tr>
										
		
<?php $field_ar = $this->Functions->order_pay_fields('food_coupon_issued', $pay_data[0]['HrPayslip']['food_coupon_issued'], 'income_tds', $pay_data[0]['HrPayslip']['income_tds'],'other_deduct', $pay_data[0]['HrPayslip']['other_deduct']);?>
										<tr>
											<td class="labelh">Educational Allowance</td>
											<td><?php echo $pay_data[0]['HrPayslip']['edu_allowance']; ?></td>
											
								<?php $f1 = explode('-',$field_ar[0]);
								
								if(empty($pay_data[0]['HrPayslip'][$f1[0]])):?>
											<td class="labelh"></td>
											<td class="hidden-1024 noborder"></td>
								<?php else:?>
								<td class="labelh"><?php 
											echo $f1[1];?> </td>
											<td class="hidden-1024">
											<?php
											
											echo $pay_data[0]['HrPayslip'][$f1[0]]; ?></td>
							
								<?php endif; ?>			
											
											
										</tr>
										
													
										
										<tr>
											<td class="labelh">Special Allowance</td>
											<td><?php echo $pay_data[0]['HrPayslip']['spl_allowance']; ?></td>
											
								<?php  $f2 = explode('-',$field_ar[1]);
								if(empty($pay_data[0]['HrPayslip'][$f2[0]])):?>
											<td class="labelh"></td>
											<td class="hidden-1024 noborder"></td>
								<?php else:?>
								<td class="labelh"><?php echo $f2[1];?></td>
											<td class="hidden-1024">
											<?php echo $pay_data[0]['HrPayslip'][$f2[0]]; ?></td>
							
								<?php endif; ?>												
										</tr>
										
							<?php 
							 $f3 = explode('-',$field_ar[2]);
							if(!empty($pay_data[0]['HrPayslip']['food_coupon_sal']) || !empty($pay_data[0]['HrPayslip'][$f3[0]])):?>
										<tr>
										
									<?php
									if(empty($pay_data[0]['HrPayslip']['food_coupon_sal'])):?>
											<td class="labelh"></td>
											<td class="hidden-1024 noborder"></td>
								<?php else:?>	
											<td class="labelh">Food Coupon (Salary)</td>
											<td><?php echo $pay_data[0]['HrPayslip']['food_coupon_sal']; ?></td>
											
								<?php endif; ?>			
											
							
							<?php 
							if(empty($pay_data[0]['HrPayslip'][$f3[0]])):?>
											<td class="labelh"></td>
											<td class="hidden-1024 noborder"></td>
								<?php else:?>
								<td class="labelh"><?php echo $f3[1];?></td>
											<td class="hidden-1024"><?php echo $pay_data[0]['HrPayslip'][$f3[0]]; ?></td>
							
								<?php endif; ?>
								
								
											
										</tr>
										
							<?php endif; ?>
										
								<?php if(!empty($pay_data[0]['HrPayslip']['fuel_reimburse'])):?>
										<tr>
											<td class="labelh">Fuel Reimbursement (Salary)</td>
											<td><?php echo $pay_data[0]['HrPayslip']['fuel_reimburse']; ?></td>
											<td class="labelh"></td>
											<td class="hidden-1024 noborder"></td>
											
										</tr>
							<?php endif; ?>	

				<?php  if(!empty($pay_data[0]['HrPayslip']['phone_reimburse'])):?>
										<tr>
											<td class="labelh">Telephone Reimbursement (Salary)</td>
											<td><?php echo $pay_data[0]['HrPayslip']['phone_reimburse']; ?></td>
											<td class="labelh"></td>
											<td class="hidden-1024 noborder"></td>
											
										</tr>
							<?php endif; ?>	
								
										<tr>
											<td class="total">Total Earnings</td>
											<td><?php echo $pay_data[0]['HrPayslip']['tot_earn']; ?></td>
											<td class="hidden-350 total">Total Deductions </td>
											<td class="hidden-1024"><?php echo $pay_data[0]['HrPayslip']['tot_deduct']; ?>
</td>											
										</tr>
										
										<tr>
											<td class="noborder"></td>
											<td class="noborder"></td>
											<td class="hidden-350 total">Net Amount</td>
											<td class="hidden-1024 total"><?php echo $pay_data[0]['HrPayslip']['net_amount']; ?></td>											
										</tr>
										
									</tbody>
								</table>
</div>




<div style="float:left;clear:both;">
								<table class="table">
									<thead>
										<tr>
											
		<th class="hidden-1024 title nobg">Amount in words: <?php echo $this->Functions->convert_number($pay_data[0]['HrPayslip']['net_amount']);?></th>
											
										</tr>
									</thead>
									
									</table>
</div>

<div style="float:left;clear:both;margin-top:20px;">
								<table class="table">
									<thead>
										<tr>
											
		<th class="hidden-1024 nobg" style="font-size:18px;">For <?php echo $pay_data[0]['HrCompany']['company_name']; ?></th>
											
										</tr>
									</thead>
									
									</table>
</div>

<div style="float:left;clear:both;margin-top:90px;">
								<table class="table">
									<thead>
										<tr>
											
		<td class="hidden-1024 nobg">This is a Computer Generated PaySlip. For any queries, please mail to hr@career-tree.in</td>
											
										</tr>
									</thead>
									
									</table>
</div>


