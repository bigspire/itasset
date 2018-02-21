<?php echo $this->element('tvl_menu'); ?>
		
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>My Travel</h1>
						
						
					</div>
				
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>tvlhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						
						
						<li>
							<a href="<?php echo $this->webroot;?>tvlreq/">My Travel</a>
							
						</li>
						
						
					</ul>
					
				</div>
				
				
				
				<?php echo $this->Session->flash();?>
				
					<div class="row-fluid footer_div" >
					<div class="span12">
						<div class="box box-bordered box-color">
						
						<div class="box-title">
								<h3><i class="icon-list"></i> My Travel</h3>
							</div>
							
						

						<?php echo $this->Form->create('TvlReq', array('name' => '', 'type' => '', 'id' => 'formID', 'class' => '')); ?>
							<div class="box-content">
							
						<div class="dataTables_wrapper">
						
				<div class="" id="DataTables_Table_8_filter"  style="padding:15px">
				
				<span>Search:</span>  
				<?php echo $this->Form->input('keyword', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-large', 'value' => $this->params->query['keyword'], 'id' => 'SearchText' , 'required' => false, 'autocomplete' => 'off', 'placeholder' => 'Search here...', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												
					
				
				
				
											
											<input type="submit" class="btn btn-primary" style="margin-bottom:9px;margin-left:4px;" value="Search"/>
											
								<a href="<?php echo $this->webroot;?>tvlreq/"><button style="margin-bottom:9px;margin-left:4px;" type="button" class="btn btn-primary"><i class="icon-refresh"></i> Reset</button></a>
								
					<a href="<?php echo $this->webroot;?>tvlreq/add_request/journey/"><button type="button" class="btn btn-primary" style="float:right"><i class="icon-plus"></i> Add Travel Request</button></a>
						
								</div>			
								
								
<div id="dialog-confirm" title="Confirmation!" class="dn">
	<p>Are you sure you want to delete?</p>
</div>

<input type="hidden" id="del_url" value="<?php echo $this->webroot;?>tvlreq/delete_tvlance/"/>
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

											<th width="300"><?php echo $this->Paginator->sort('purpose', 'Purpose', array('escape' => false,'direction' => 'desc'));?></th>
											
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
											
											<td><?php echo $this->Functions->format_date($tvl['TvlReq']['start_date']);?></td>
											<td><?php echo $tvl['TvlReq']['tvl_code'];?></td>
											<td><?php echo $this->Functions->get_travel_type($tvl['TvlReq']['type']);?></td>
											<td><?php echo $tvl['TvlPlace']['place'];?></td>
											<td><?php echo $this->Functions->show_tvl_mode_icon($tvl['TvlMode']['mode']);?></td>
												<td><?php echo  $this->Functions->string_truncate($tvl['TvlReq']['purpose'], 25);?></td>
											<td><?php echo $tvl['TskCustomer']['company_name'];?></td>
									<td><?php echo $this->Functions->format_date($tvl['TvlReq']['created_date']);?></td>

								<td class='hidden-350'>
											
											<?php echo $this->Functions->format_status($tvl[0]['st_status'],$tvl[0]['st_created'],$tvl[0]['st_user'],$tvl[0]['st_modified']); ?>
											
									
											
											</td>
									
											<td class='hidden-480'>
					
					
					<?php if($tvl['TvlReq']['type'] == '1'):
					if($tvl['TicketStatus']['id']):?>				
					<a href="<?php echo $this->webroot;?>tvlreq/view_note/<?php echo $tvl['TvlReq']['id'];?>/" val="50_70" rel="tooltip" title="View Travel Desk Status" class="iframeBox btn click_hide"><i class="glyphicon-notes"></i></a> &nbsp;	
					<?php endif; endif; ?>
					
					
					<?php if($tvl['TvlReq']['type'] == '2'):
					if($tvl['TicketStatus']['id']):?>	
					<div class="btn-group">
					<a href="#" data-toggle="dropdown" rel="tooltip" title="View Travel Desk Status" class="btn dropdown-toggle click_hide"><i class="glyphicon-notes"></i> <span class="caret"></span></a>
					<ul class="dropdown-menu">
					<li><a href="<?php echo $this->webroot;?>tvlreq/view_note/<?php echo $tvl['TvlReq']['id'];?>/" val="50_70" class="iframeBox btn">Onward Journey</a>
					</li><li><a href="<?php echo $this->webroot;?>tvlreq/view_note/<?php echo $tvl['TvlReq']['id'];?>/?action=return" val="50_70"  class="iframeBox btn">Return Journey</a>
					</li>
					</ul>
					</div>
					<?php endif; endif; ?>
					
					<a href="<?php echo $this->webroot;?>tvlreq/view_request/<?php echo $tvl['TvlReq']['id'];?>/" class="btn" rel="tooltip" title="View Details"><i class="icon-search"></i></a>
											
											
										
											</td>
										</tr>
									<?php endforeach; ?>
									</tbody>
								</table>
								

								<?php echo $this->element('paging');?>
								
								




								
							</div>	

							</div>
						<input type="hidden" value="1" id="SearchKeywords">
						<input type="hidden" value="<?php echo $this->webroot;?>tvlreq/" id="webroot">
						 <?php echo $this->Form->end(); ?>
						</div>
					</div>
				</div>
					
					
				</div>
		
			
			</div>
			

		</div>	
			
		
		
		
		
				
		


