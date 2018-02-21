<style type="text/css">
body{padding-top:20px;background:#fff}
.table-responsive{overflow-x:hidden}
</style>

<div class="col-xs-12" style="padding-bottom:100px">
					  <div class="table-responsive">
										
						<!--div class="row">
						
						<div class="col-sm-6">
						<div id="sample-table-2_length" class="dataTables_length" style="margin:10px;">
						<input type="text" placeholder="Search Employee" class="col-xs-10 col-sm-5" style="margin-bottom:10px" aria-controls="sample-table-2"></label></div></div>
						
						</div-->
						
						<div id="tagDiv">
						
					
						
						
						
						</div>

						
							<form name="sharefrm" id="shareFrm" method="post" style="clear:both">	
									<table id="sample-table-1" class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<!--th class="center">
															<label>
																<input id="select_all"  type="checkbox" class="ace select_all">
																<span class="lbl"></span>
															</label>
														</th-->
														<th colspan="2">Employee  <span style="font-size:11px;font-weight:normal;">(Mouse over to preview)</span></th>
														
													</tr>
												</thead>

												<tbody>
													
												<?php
											$id_ar = explode('_', $this->request->query['id']);
										
												foreach($member_data as $user):
												
												if(in_array($user['Home']['id'], $id_ar)):
												$chk = 'checked';
												else:
												$chk = '';
												endif;
												
												
												?>
												
												
												<tr>
														<td class="center">
															<label>
								<?php echo $this->Form->input('chk', array('div'=> false,'type' => 'checkbox', 'label' => false, 'value' => $user['Home']['id'],  'id' => '','class' => 'shareSel ace chkSel', $chk, 'required' => false, 'placeholder' => '', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
																<span class="lbl"></span>
															</label>
														</td>

														<td>
					<a href="javascript:void(0);" rel="<?php echo $user['Home']['id'];?>" class="previewUser"><?php echo ucwords($user['Home']['full_name']);?></a>
										
				<div class="profile-user-info profile-user-info-striped dn" id="prev-<?php echo $user['Home']['id'];?>" style="margin:10px 0 0 0;position:absolute;background:#fff;border:2px solid #FFED6B">
				
				<div class="profile-info-row" style="margin:5px" >
						<?php if($user['Home']['photo'] != '' && $user['Home']['photo_status'] == 'A'):?>
							<img src="<?php echo $this->webroot;?>timthumb.php?src=uploads/photo/<?php echo $user['Home']['photo'];?>&h=106&q=100" title="<?php echo $user['Home']['full_name'];?>"/>	
						<?php endif; ?>		
							
												</div>
												
												
						<div class="profile-info-row">
						<div class="profile-info-name" style="position:absolute;width:100px;">Department </div>
						<div class="profile-info-value" style="margin-left:100px;">
						<span id="username" class="">
						<?php echo $user['HrDepartment']['dept_name'];?> </span>
													</div>
												</div>
												
												<div class="profile-info-row">
						<div class="profile-info-name" style="position:absolute;width:100px;">Designation </div>
						<div class="profile-info-value" style="margin-left:100px;">
						<span id="username" class="">
						<?php echo $user['HrDesignation']['desig_name'];?> </span>
													</div>
												</div>
												
												

																								
											</div>
														</td>
														
													</tr>
											<?php endforeach; ?>
											
													<tr>
														<td colspan="2" class="left">
															
															<button type="button" class="shareReset btn btn-minier btn-purple"> Reset</button>
															
															<!--button  type="button" class="btn no-radius btn-sm btn-primary shareSrch"> Submit</button-->
															
															
															
														</td>

														
														
													</tr>
												
												</tbody>
											</table>
								<?php echo $this->Form->input('hdnId', array('div'=> false,'type' => 'hidden', 'id' => 'hdnId'));
								
								echo $this->Form->input('shareTagUrl', array('div'=> false,'type' => 'hidden', 'id' => 'shareTagUrl', 'value' => $this->webroot.'home/share_tag/'));

	echo $this->Form->input('webroot', array('div'=> false,'type' => 'hidden', 'id' => 'webroot', 'value' => $this->webroot.'home/share_user/'));								?> 			
											
									</form>
										</div><!-- /.table-responsive -->
									</div>