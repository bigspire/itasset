<?php echo $this->element('fin_menu'); ?>
		
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Approve Advance</h1>
						
						
					</div>
				
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>finhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						
						
						<li>
							<a href="<?php echo $this->webroot;?>finadvapprove/">Approve Advance</a>
							
						</li>
						
						
					</ul>
					
				</div>
				
				
				
				<?php echo $this->Session->flash();?>
				
					<div class="row-fluid  footer_div" >
					<div class="span12">
						<div class="box box-bordered box-color">
						
						<div class="box-title">
								<h3><i class="icon-list"></i> Approve Advance</h3>
							</div>
							
						

						<?php echo $this->Form->create('FinAdvApprove', array('name' => '', 'type' => '', 'id' => 'formID', 'class' => '')); ?>
							<div class="box-content">
							
						<div class="dataTables_wrapper">
						
				<div class="" id="DataTables_Table_8_filter"  style="padding:15px">
				
			<span>Search:</span>  <?php echo $this->Form->input('keyword', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-large', 'value' => $this->params->query['keyword'], 'required' => false, 'autocomplete' => 'off', 'placeholder' => 'Search here...', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
		
											

								<span>Employee:</span>		<?php echo $this->Form->input('emp_id', array('div'=> false,'type' => 'select', 'label' => false, 'class' => 'input-large', 'empty' => 'Select', 'selected' => $this->params->query['emp_id'], 'required' => false, 'placeholder' => '', 'style' => "clear:left", 'options' => $empList, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
											
											<input class="btn btn-primary" type="submit" style="margin-bottom:9px;margin-left:4px;" value="Search"/>
											
				<a href="<?php echo $this->webroot;?>finadvapprove/"><button style="margin-bottom:9px;margin-left:4px;" type="button" class="btn btn-primary"><i class="icon-refresh"></i> Reset</button></a>
						
								</div>			
								
								
<div id="dialog-confirm" title="Confirmation!" class="dn">
	<p>Are you sure you want to delete?</p>
</div>

<input type="hidden" id="del_url" value="<?php echo $this->webroot;?>finadvance/delete_advance/"/>
								<table class="table table-hover table-nomargin table-bordered usertable dataTable">
									<thead>
										
										<tr>
											
											
											<th  width="140">
											<?php echo $this->Paginator->sort('first_name', 'Employee', array('escape' => false,'direction' => 'desc'));?>
											</th>
											<th  width="90">
											<?php echo $this->Paginator->sort('created_date', 'Date', array('escape' => false,'direction' => 'desc'));?>
</th>

<th><?php echo $this->Paginator->sort('id', 'Adv. No.', array('escape' => false,'direction' => 'desc'));?></th>
											
											<th width="115"><?php echo $this->Paginator->sort('amount', 'Amount (Rs.)', array('escape' => false,'direction' => 'desc'));?></th>
											<th><?php echo $this->Paginator->sort('purpose', 'Purpose', array('escape' => false,'direction' => 'desc'));?></th>
											<th width="120"> <?php echo $this->Paginator->sort('req_date', 'Required Date', array('escape' => false,'direction' => 'desc'));?></th>
											<th  width="80">Pending</th>
												<th width="200">Status</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
									
										
									
										<?php foreach($adv_data as $key => $adv):?>
										
										<tr>
										
											<td><?php echo ucfirst($adv['Home2']['first_name']).' '.ucfirst($adv['Home2']['last_name']);?></td>
											
											<td><?php echo $this->Functions->format_date($adv['FinAdvApprove']['created_date']);?></td>
											<td><?php echo $this->Functions->get_adv_id($adv['FinAdvApprove']['id']);?></td>
											<td><?php echo $adv['FinAdvApprove']['amount'];?></td>
												<td><?php echo  $this->Functions->string_truncate($adv['FinAdvApprove']['purpose'], 30);?></td>
											<td><?php echo $this->Functions->format_date($adv['FinAdvApprove']['req_date']);?></td>
											<td class='hidden-350'>
											
											<?php $pending = strstr($adv[0]['st_status'], 'W');
											if(!empty($pending)):
											echo $this->Functions->time_diff($adv['FinAdvApprove']['created_date'], 0);
											else:?>
											<!--button rel="" title="" class="btn btn-small btn btn-darkblue"><i class="icon-ok-sign"></i></button-->
											<?php endif; ?>
											</td>
											<td>	<?php echo $this->Functions->format_status($adv[0]['st_status'],$adv[0]['st_created'],$adv[0]['st_user'],$adv[0]['st_modified']); ?></td>
											
											<?php 
											$icon = $this->Functions->show_verify_icon($show_status[$key]);
											$title = $this->Functions->show_verify_title($show_status[$key]);
											
											
											?>
											
											<td class='hidden-480'>
											
												<a href="<?php echo $this->webroot;?>finadvapprove/view_advance/<?php echo $adv['FinAdvApprove']['id'];?>/<?php echo $adv[0]['status_id'];?>/<?php echo $adv['Home2']['id'];?>" class="btn" rel="tooltip" title="<?php echo $title;?>"><i class="<?php echo $icon;?>"></i></a>
											
											
											</td>
										</tr>
									<?php endforeach; ?>
									</tbody>
								</table>
								

								<?php echo $this->element('paging');?>
								
								




								
							</div>	

							</div>
					
						 <?php echo $this->Form->end(); ?>
						</div>
					</div>
				</div>
					
					
				</div>
		
			
			</div>
			

		</div>	
			
		
		
		
		
				
		


