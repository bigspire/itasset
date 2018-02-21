<?php echo $this->element('tvl_menu'); ?>
		
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Cancel Ticket</h1>
						
						
					</div>
				
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>tvlhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						
						
						<li>
							<a href="<?php echo $this->webroot;?>tvlcantkt/">Cancel Ticket</a>
							
						</li>
						
						
					</ul>
					
				</div>
				
				
				
				<?php echo $this->Session->flash();?>
				
					<div class="row-fluid footer_div" >
					<div class="span12">
						<div class="box box-bordered box-color">
						
						<div class="box-title">
								<h3><i class="icon-list"></i> Cancel Ticket</h3>
							</div>
							
						

						<?php echo $this->Form->create('TvlCanTkt', array('name' => '', 'type' => '', 'id' => 'formID', 'class' => '')); ?>
							<div class="box-content">
							
						<div class="dataTables_wrapper">
						
				<div class="" id="DataTables_Table_8_filter"  style="padding:15px">
				
				<span>Search:</span>  
				<?php echo $this->Form->input('keyword', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-large', 'value' => $this->params->query['keyword'], 'id' => 'SearchText' , 'required' => false, 'autocomplete' => 'off', 'placeholder' => 'Search here...', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												
					
				
					<span>Employee:</span>		<?php echo $this->Form->input('emp_id', array('div'=> false,'type' => 'select', 'label' => false, 'class' => 'input-large', 'empty' => 'Select', 'selected' => $this->params->query['emp_id'], 'required' => false, 'placeholder' => '', 'style' => "clear:left", 'options' => $empList, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
				
				
											
											<input type="submit" class="btn btn-primary" style="margin-bottom:9px;margin-left:4px;" value="Search"/>
											
								<a href="<?php echo $this->webroot;?>tvlcantkt/"><button style="margin-bottom:9px;margin-left:4px;" type="button" class="btn btn-primary"><i class="icon-refresh"></i> Reset</button></a>
								
						
								</div>			
								
								
<div id="dialog-confirm" title="Confirmation!" class="dn">
	<p>Are you sure you want to delete?</p>
</div>

<input type="hidden" id="del_url" value="<?php echo $this->webroot;?>tvlcantkt/delete_tvlance/"/>
								<table class="table table-hover table-nomargin table-bordered usertable dataTable">
									<thead>
										
										<tr>
											<th width="150">
											<?php echo $this->Paginator->sort('first_name', 'Employee', array('escape' => false,'direction' => 'desc'));?>
											</th>

											<th width="120">
											<?php echo $this->Paginator->sort('start_date', 'Journey Date', array('escape' => false,'direction' => 'desc'));?>
											</th>
											
											<th width="100">
											<?php echo $this->Paginator->sort('id', 'Travel Id', array('escape' => false,'direction' => 'desc'));?>
											</th>
											<th width="80">
											<?php echo $this->Paginator->sort('type', 'Type', array('escape' => false,'direction' => 'desc'));?>
											</th>
											<th width="160"><?php echo $this->Paginator->sort('TvlPlace.place', 'Place', array('escape' => false,'direction' => 'desc'));?></th>
											<th width="40"><?php echo $this->Paginator->sort('TvlMode.mode', 'Mode', array('escape' => false,'direction' => 'desc'));?></th>

											<th width="300"><?php echo $this->Paginator->sort('TvlCancel.reason', 'Cancel Reason', array('escape' => false,'direction' => 'desc'));?></th>
											
											<th width="120">
											<?php echo $this->Paginator->sort('created_date', 'Created', array('escape' => false,'direction' => 'desc'));?>
											</th>
											<!--th width="">Pay Status</th-->
											<th width="140">Action</th>
										</tr>
									</thead>
									<tbody>
									
										
									
										<?php  foreach($tvl_data as $tvl):?>
										
										<tr>
										<td><?php echo $tvl['HrEmployee']['first_name'].' '.$tvl['HrEmployee']['last_name'];?></td>

											<td><?php echo $this->Functions->format_date($tvl['TvlCanTkt']['start_date']);?></td>
											<td><?php echo $tvl['TvlCanTkt']['tvl_code'];?></td>
											<td><?php echo $this->Functions->get_travel_type($tvl['TvlCanTkt']['type']);?></td>
											<td><?php echo $tvl['TvlPlace']['place'];?></td>
											<td><?php echo $this->Functions->show_tvl_mode_icon($tvl['TvlMode']['mode']);?></td>
												<td><?php echo  $this->Functions->string_truncate($tvl['TvlCancel']['reason'], 25);?></td>
									<td><?php echo $this->Functions->format_date($tvl['TvlCanTkt']['created_date']);?></td>

								
									
											<td class='hidden-480'>

					<?php 
						
						$icon = $this->Functions->show_verify_icon($tvl['TvlCanTkt']['tkt_cancel_status'] ? 'fail' : 'pass');
						$title = $this->Functions->show_tkt_cancel_title($tvl['TvlCanTkt']['tkt_cancel_status'] ? 'fail' : 'pass');
											
					?>						
					<a href="<?php echo $this->webroot;?>tvlcantkt/cancel_ticket/<?php echo $tvl['TvlCanTkt']['id'];?>/" class="btn" rel="tooltip" title="<?php echo $title;?>"><i class="<?php echo $icon;?>"></i></a>
								
											</td>
										</tr>
									<?php endforeach; ?>
									</tbody>
								</table>
								

								<?php echo $this->element('paging');?>
								
								




								
							</div>	

							</div>
						<input type="hidden" value="1" id="SearchKeywords">
						<input type="hidden" value="1" id="overlayclose">
						<input type="hidden" value="<?php echo $this->webroot;?>tvlcantkt/" id="webroot">
			<?php echo $this->Form->end(); ?>
						</div>
					</div>
				</div>
					
					
				</div>
		
			
			</div>
			

		</div>	
			
		
		
		
		
				
		


