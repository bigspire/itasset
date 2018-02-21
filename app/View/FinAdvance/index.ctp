<?php echo $this->element('fin_menu'); ?>
		
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>My Advance</h1>
						
						
					</div>
				
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>finhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						
						
						<li>
							<a href="<?php echo $this->webroot;?>finadvance/">My Advance</a>
							
						</li>
						
						
					</ul>
					
				</div>
				
				
				
				<?php echo $this->Session->flash();?>
				
					<div class="row-fluid footer_div" >
					<div class="span12">
						<div class="box box-bordered box-color">
						
						<div class="box-title">
								<h3><i class="icon-list"></i> My Advance</h3>
							</div>
							
						

						<?php echo $this->Form->create('FinAdvance', array('name' => '', 'type' => '', 'id' => 'formID', 'class' => '')); ?>
							<div class="box-content">
							
						<div class="dataTables_wrapper">
						
				<div class="" id="DataTables_Table_8_filter"  style="padding:15px">
				
				<span>Search:</span>  
				<?php echo $this->Form->input('keyword', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-large', 'value' => $this->params->query['keyword'],   'required' => false, 'autocomplete' => 'off', 'placeholder' => 'Search here...', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												
					
				<!--span>Status:</span--> 	<?php //echo $this->Form->input('status', array('div'=> false,'type' => 'select', 'selected' => $this->params->query['status'], 'label' => false, 'class' => 'input-small', 'empty' => 'Select', 'required' => false, 'placeholder' => '', 'style' => "clear:left", 'options' => $srchStat, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
				
					<!--span>Pay Status:</span--> 	<?php //echo $this->Form->input('pay_status', array('div'=> false,'type' => 'select','selected' => $this->params->query['pay_status'],'label' => false, 'class' => 'input-medium', 'empty' => 'Select', 'required' => false, 'placeholder' => '', 'style' => "clear:left", 'options' => $payStat, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
				
				
											
											<button class="btn btn-primary" style="margin-bottom:9px;margin-left:4px;">Search</button>
											
								<a href="<?php echo $this->webroot;?>finadvance/"><button style="margin-bottom:9px;margin-left:4px;" type="button" class="btn btn-primary"><i class="icon-refresh"></i> Reset</button></a>
								
					<a href="<?php echo $this->webroot;?>finadvance/create_advance/"><button type="button" class="btn btn-primary" style="float:right"><i class="icon-plus"></i> Add Advance</button></a>
						
								</div>			
								
								
<div id="dialog-confirm" title="Confirmation!" class="dn">
	<p>Are you sure you want to delete?</p>
</div>

<input type="hidden" id="del_url" value="<?php echo $this->webroot;?>finadvance/delete_advance/"/>
								<table class="table table-hover table-nomargin table-bordered usertable dataTable">
									<thead>
										
										<tr>
											

											<th>
											<?php echo $this->Paginator->sort('created_date', 'Date', array('escape' => false,'direction' => 'desc'));?>
											</th>
											
											<th>
											<?php echo $this->Paginator->sort('id', 'Adv. No.', array('escape' => false,'direction' => 'desc'));?>
											</th>
											
											<th width="120"><?php echo $this->Paginator->sort('amount', 'Amount (Rs)', array('escape' => false,'direction' => 'desc'));?></th>
											<th width="400"><?php echo $this->Paginator->sort('purpose', 'Purpose', array('escape' => false,'direction' => 'desc'));?></th>
											<th width="120"> <?php echo $this->Paginator->sort('req_date', 'Required Date', array('escape' => false,'direction' => 'desc'));?></th>
											<th width="200">Status</th>
											<!--th width="">Pay Status</th-->
											<th>View</th>
										</tr>
									</thead>
									<tbody>
									
										
									
										<?php  foreach($adv_data as $adv):?>
										
										<tr>
											
											<td><?php echo $this->Functions->format_date($adv['FinAdvance']['created_date']);?></td>
											<td><?php echo $this->Functions->get_adv_id($adv['FinAdvance']['id']);?></td>
											<td><?php echo $this->Functions->money_display($adv['FinAdvance']['amount']);?></td>
												<td><?php echo  $this->Functions->string_truncate($adv['FinAdvance']['purpose'], 30);?></td>
											<td><?php echo $this->Functions->format_date($adv['FinAdvance']['req_date']);?></td>
											<td class='hidden-350'>
											
											<?php echo $this->Functions->format_status($adv[0]['st_status'],$adv[0]['st_created'],$adv[0]['st_user'],$adv[0]['st_modified']); ?>
											
									
											
											</td>
											<!--td>
												
												<?php echo $this->Functions->show_pay_status($adv['FinAdvance']['amount'], $adv[0]['tot_amt'],$adv['FinAdvPay']['amount'], $adv['FinAdvPay']['paid_date'] ); ?>
											</td-->
											<td class='hidden-480'>
											<?php //$exp_status = explode(',', $adv[0]['st_status']);
											?>
											
												<a href="<?php echo $this->webroot;?>finadvance/view_advance/<?php echo $adv['FinAdvance']['id'];?>/" class="btn" rel="tooltip" title="View"><i class="icon-search"></i></a>
											
											
											<?php //if($exp_status[0] == 'W'): ?>		
												<!--a href="<?php echo $this->webroot;?>finadvance/edit_advance/<?php echo $adv['FinAdvance']['id'];?>/" class="btn" rel="tooltip" title="Edit"><i class="icon-edit"></i></a-->								
											
												<!--a href="javascript:void(0);" name="<?php echo $adv['FinAdvance']['id'];?>" class="btn delRec" rel="tooltip" title="Delete"><i class="icon-remove"></i></a-->
												
										<?php //endif; ?>
											</td>
										</tr>
									<?php endforeach; ?>
									</tbody>
								</table>
								

								<?php echo $this->element('paging');?>
								
								




								
							</div>	

							</div>
						<input type="hidden" value="1" id="SearchKeywords">
						<input type="hidden" value="<?php echo $this->webroot;?>finadvance/" id="webroot">
						 <?php echo $this->Form->end(); ?>
						</div>
					</div>
				</div>
					
					
				</div>
		
			
			</div>
			

		</div>	
			
		
		
		
		
				
		


