<?php echo $this->element('tvl_menu'); ?>
		
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Cancel Travel</h1>
						
						
					</div>
				
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>tvlhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						
						
						<li>
							<a href="<?php echo $this->webroot;?>tvlcanreq/">Cancel Travel</a>
							
						</li>
						
						
					</ul>
					
				</div>
				
				
				
				<?php echo $this->Session->flash();?>
				
					<div class="row-fluid footer_div" >
					<div class="span12">
						<div class="box box-bordered box-color">
						
						<div class="box-title">
								<h3><i class="icon-list"></i> Cancel Travel</h3>
							</div>
							
						

						<?php echo $this->Form->create('TvlCanReq', array('name' => '', 'type' => '', 'id' => 'formID', 'class' => '')); ?>
							<div class="box-content">
							
						<div class="dataTables_wrapper">
						
				<div class="" id="DataTables_Table_8_filter"  style="padding:15px">
				
				<span>Search:</span>  
				<?php echo $this->Form->input('keyword', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-large', 'value' => $this->params->query['keyword'], 'id' => 'SearchText' , 'required' => false, 'autocomplete' => 'off', 'placeholder' => 'Search here...', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												
					
				<!--span>Status:</span--> 	<?php //echo $this->Form->input('status', array('div'=> false,'type' => 'select', 'selected' => $this->params->query['status'], 'label' => false, 'class' => 'input-small', 'empty' => 'Select', 'required' => false, 'placeholder' => '', 'style' => "clear:left", 'options' => $srchStat, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
				
					<!--span>Pay Status:</span--> 	<?php //echo $this->Form->input('pay_status', array('div'=> false,'type' => 'select','selected' => $this->params->query['pay_status'],'label' => false, 'class' => 'input-medium', 'empty' => 'Select', 'required' => false, 'placeholder' => '', 'style' => "clear:left", 'options' => $payStat, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
				
				
											
											<input type="submit" class="btn btn-primary" style="margin-bottom:9px;margin-left:4px;" value="Search"/>
											
								<a href="<?php echo $this->webroot;?>tvlcanreq/"><button style="margin-bottom:9px;margin-left:4px;" type="button" class="btn btn-primary"><i class="icon-refresh"></i> Reset</button></a>
								
						
								</div>			
								
								
<div id="dialog-confirm" title="Confirmation!" class="dn">
	<p>Are you sure you want to delete?</p>
</div>

<input type="hidden" id="del_url" value="<?php echo $this->webroot;?>tvlcanreq/delete_tvlance/"/>
								<table class="table table-hover table-nomargin table-bordered usertable dataTable">
									<thead>
										
										<tr>
											

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

											<th width="150"> <?php echo $this->Paginator->sort('TskCustomer.company_name', 'Customer', array('escape' => false,'direction' => 'desc'));?></th>
											<th width="120">
											<?php echo $this->Paginator->sort('created_date', 'Created', array('escape' => false,'direction' => 'desc'));?>
											</th>
											<th width="140">Status</th>
											<!--th width="">Pay Status</th-->
											<th width="140">Action</th>
										</tr>
									</thead>
									<tbody>
									
										
									
										<?php  foreach($tvl_data as $tvl):?>
										
										<tr>
											
											<td><?php echo $this->Functions->format_date($tvl['TvlCanReq']['start_date']);?></td>
											<td><?php echo $tvl['TvlCanReq']['tvl_code'];?></td>
											<td><?php echo $this->Functions->get_travel_type($tvl['TvlCanReq']['type']);?></td>
											<td><?php echo $tvl['TvlPlace']['place'];?></td>
											<td><?php echo $this->Functions->show_tvl_mode_icon($tvl['TvlMode']['mode']);?></td>
												<td><?php echo  $this->Functions->string_truncate($tvl['TvlCancel']['reason'], 25);?></td>
											<td><?php echo $tvl['TskCustomer']['company_name'];?></td>
									<td><?php echo $this->Functions->format_date($tvl['TvlCanReq']['created_date']);?></td>

								<td class='hidden-350'>
											
											<?php echo $this->Functions->format_status($tvl[0]['st_status'],$tvl[0]['st_created'],$tvl[0]['st_user'],$tvl[0]['st_modified']); ?>
											
									
											
											</td>
									
											<td class='hidden-480'>
										
					<a href="<?php echo $this->webroot;?>tvlcanreq/view_request/<?php echo $tvl['TvlCanReq']['id'];?>/" class="btn" rel="tooltip" title="View Details"><i class="icon-search"></i></a>
											
											
										
											</td>
										</tr>
									<?php endforeach; ?>
									</tbody>
								</table>
								

								<?php echo $this->element('paging');?>
								
								




								
							</div>	

							</div>
						<input type="hidden" value="1" id="SearchKeywords">
						<input type="hidden" value="<?php echo $this->webroot;?>tvlcanreq/" id="webroot">
						 <?php echo $this->Form->end(); ?>
						</div>
					</div>
				</div>
					
					
				</div>
		
			
			</div>
			

		</div>	
			
		
		
		
		
				
		


