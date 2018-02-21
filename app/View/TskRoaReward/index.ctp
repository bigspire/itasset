<?php echo $this->element('tsk_menu'); ?>
		
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Gifts & Rewards</h1>
						
						
					</div>
				
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>tskhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						
						
						<li>
							<a href="<?php echo $this->webroot;?>tskroareward/">Gifts & Rewards</a>
							
						</li>
						
						
					</ul>
					
				</div>
				
				
				
				<?php echo $this->Session->flash();?>
				
					<div class="row-fluid  footer_div" >
					<div class="span12">
						<div class="box box-bordered box-color">
						
						<div class="box-title">
								<h3><i class="icon-list"></i> Gifts & Rewards</h3>
							</div>
							
						

						<?php echo $this->Form->create('TskRoaReward', array('name' => '', 'type' => '', 'id' => 'formID', 'class' => '')); ?>
							<div class="box-content">
							
						<div class="dataTables_wrapper">
						
				<div class="" id="DataTables_Table_8_filter"  style="padding:15px">
				
				
<span>Search:</span>  
				<?php echo $this->Form->input('month_start', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'monthpick input-medium', 'value' => $this->params->query['month_start'],   'required' => false, 'autocomplete' => 'off', 'placeholder' => 'From Month', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
				<?php echo $this->Form->input('month_end', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'monthpick input-medium', 'value' => $this->params->query['month_end'],   'required' => false, 'autocomplete' => 'off', 'placeholder' => 'Till Month', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
				<?php echo $this->Form->input('type', array('div'=> false,'type' => 'select', 'empty' => 'Select', 'value' => $this->params->query['type'],'label' => false, 'class' => 'input-large', 'options' => $star_options,  'required' => false, 'autocomplete' => 'off', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												
		
				
				
											
											<input type="submit" value="Search" class="btn btn-primary" style="margin-bottom:9px;margin-left:4px;">
											
													<a href="<?php echo $this->webroot;?>tskroareward/"><button style="margin-bottom:9px;margin-left:4px;" type="button" class="btn btn-primary"><i class="icon-refresh"></i> Reset</button></a>
											
					<a href="<?php echo $this->webroot;?>tskroareward/create_reward/"><button type="button" class="btn btn-primary" style="float:right"><i class="icon-plus"></i> Add Gifts & Rewards</button></a>
						
								</div>			
								
								
<div id="dialog-confirm" title="Confirmation!" class="dn">
	<p>Are you sure you want to delete?</p>
</div>

<input type="hidden" id="del_url" value="<?php echo $this->webroot;?>tskroareward/delete_reward/"/>
								<table class="table table-hover table-nomargin table-bordered usertable dataTable">
									<thead>
										
										<tr>
											
											<th width="100">
											<?php echo $this->Paginator->sort('reward_date', 'Reward Month', array('escape' => false,'direction' => 'desc'));?>
												</th>
												
													<th width="300">
											<?php echo $this->Paginator->sort('first_name', 'Employee', array('escape' => false,'direction' => 'desc'));?>
												</th>
												
											
											<th width="450">
											<?php echo $this->Paginator->sort('gift_voucher', 'Gifts / Cash', array('escape' => false,'direction' => 'desc'));?>
												</th>
												
												<th width="140">
											<?php echo $this->Paginator->sort('is_star', 'Star ?', array('escape' => false,'direction' => 'desc'));?>
												</th>
												
												
												<th width="100">
											<?php echo $this->Paginator->sort('created_date', 'Created', array('escape' => false,'direction' => 'desc'));?>
												</th>
											
											<th>Options</th>
										</tr>
									</thead>
									<tbody>
									
										
									
										<?php  foreach($reward_data as $reward):?>
										
										<tr>
											
											<td><?php echo $this->Functions->format_month($reward['TskRoaReward']['reward_date']);?></td>
											<td><?php echo $reward[0]['reward_member'];?></td>
											<td><?php echo $reward['TskRoaReward']['gift_voucher'];?></td>
<td><?php echo $this->Functions->get_star_msg($reward['TskRoaReward']['is_star']);?></td>
											<td><?php echo $this->Functions->format_date($reward['TskRoaReward']['created_date']);?></td>
											<td class='hidden-480'>
												
												<?php if(!empty($reward['TskRoaReward']['certificate'])):?>
												<a href="<?php echo $this->webroot;?>tskroareward/download_certificate/<?php echo $reward['TskRoaReward']['certificate'];?>/" class="btn" rel="tooltip" title="Download"><i class="icon-download"></i></a>
												<?php endif; ?>
												<a href="<?php echo $this->webroot;?>tskroareward/edit_reward/<?php echo $reward['TskRoaReward']['id'];?>/" class="btn" rel="tooltip" title="Edit"><i class="icon-edit"></i></a>
												<a href="javascript:void(0);" name="<?php echo $reward['TskRoaReward']['id'];?>" class="btn delRec" rel="tooltip" title="Delete"><i class="icon-remove"></i></a>
											</td>
										</tr>
										
									<?php endforeach; ?>
									</tbody>
								</table>
								

								<?php echo $this->element('paging');?>
								
								




								
							</div>	

							</div>
																	<input type="hidden" id="end_date" value="<?php echo date('m/Y', strtotime('-1 Month'));?>" />

						<input type="hidden" value="<?php echo $this->webroot;?>tskroareward/" id="webroot">
						 <?php echo $this->Form->end(); ?>
						</div>
					</div>
				</div>
					
					
				</div>
		
			
			</div>
			

		</div>	
			
		
		
		
		
				
		


