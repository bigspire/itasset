<?php echo $this->element('tvl_menu'); ?>
		
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Book Ticket</h1>
						
						
					</div>
				
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>tvlhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						
						
						<li>
							<a href="<?php echo $this->webroot;?>tvlbooktkt/">Book Ticket</a>
							
						</li>
						
						
					</ul>
					
				</div>
				
				
				
				<?php echo $this->Session->flash();?>
				
					<div class="row-fluid footer_div" >
					<div class="span12">
						<div class="box box-bordered box-color">
						
						<div class="box-title">
								<h3><i class="icon-list"></i> Book Ticket</h3>
							</div>
							
						

						<?php echo $this->Form->create('TvlBookTkt', array('name' => '', 'type' => '', 'id' => 'formID', 'class' => '')); ?>
							<div class="box-content">
							
						<div class="dataTables_wrapper">
						
				<div class="" id="DataTables_Table_8_filter"  style="padding:15px">
				
				<span>Search:</span>  
				<?php echo $this->Form->input('keyword', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-large', 'value' => $this->params->query['keyword'], 'id' => 'SearchText' , 'required' => false, 'autocomplete' => 'off', 'placeholder' => 'Search here...', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												
					
				
					<span>Employee:</span>		<?php echo $this->Form->input('emp_id', array('div'=> false,'type' => 'select', 'label' => false, 'class' => 'input-large', 'empty' => 'Select', 'selected' => $this->params->query['emp_id'], 'required' => false, 'placeholder' => '', 'style' => "clear:left", 'options' => $empList, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
				
				
											
											<input type="submit" class="btn btn-primary" style="margin-bottom:9px;margin-left:4px;" value="Search"/>
											
								<a href="<?php echo $this->webroot;?>tvlbooktkt/"><button style="margin-bottom:9px;margin-left:4px;" type="button" class="btn btn-primary"><i class="icon-refresh"></i> Reset</button></a>
								
												<a href="<?php echo $this->webroot;?>tvlbooktkt/export/"><button type="button" class="btn btn-primary" style="float:right;margin-right:20px;"><i class="icon-reply"></i> Export</button></a>

						
								</div>			
								
								
<div id="dialog-confirm" title="Confirmation!" class="dn">
	<p>Are you sure you want to delete?</p>
</div>

<input type="hidden" id="del_url" value="<?php echo $this->webroot;?>tvlbooktkt/delete_tvlance/"/>
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

											<th width="300"><?php echo $this->Paginator->sort('purpose', 'Purpose', array('escape' => false,'direction' => 'desc'));?></th>
											
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
											<td><?php echo $this->Functions->format_date($tvl['TvlBookTkt']['start_date']);?></td>
											<td><?php echo $tvl['TvlBookTkt']['tvl_code'];?></td>
											<td><?php echo $this->Functions->get_travel_type($tvl['TvlBookTkt']['type']);?></td>
											<td><?php echo $tvl['TvlPlace']['place'];?></td>
											<td><?php echo $this->Functions->show_tvl_mode_icon($tvl['TvlMode']['mode']);?></td>
												<td><?php echo  $this->Functions->string_truncate($tvl['TvlBookTkt']['purpose'], 25);?></td>
									<td><?php echo $this->Functions->format_date($tvl['TvlBookTkt']['created_date']);?></td>

								
									
											<td class='hidden-480'>
					<?php if($tvl['TvlTicket']['id']):?>						
					<a href="<?php echo $this->webroot;?>tvlbooktkt/download/<?php echo $tvl['TvlBookTkt']['id'];?>/<?php echo $tvl['TvlBookTkt']['type'];?>/" rel="tooltip" title="Download Ticket" class="btn click_hide"><i class="icon-paper-clip"></i></a> &nbsp;		
					<?php endif; ?>
					
					
					<?php if($tvl['TvlBookTkt']['type'] == '1'):
					if($tvl['TvlBookTkt']['tdesk_status']):?>				
					<a href="<?php echo $this->webroot;?>tvlbooktkt/view_note/<?php echo $tvl['TvlBookTkt']['id'];?>/" val="50_70" rel="tooltip" title="View Travel Desk Status" class="iframeBox btn click_hide"><i class="glyphicon-notes"></i></a> &nbsp;	
					<?php elseif(empty($tvl['TvlBookTkt']['tkt_status'])):?>
					<a href="<?php echo $this->webroot;?>tvlbooktkt/add_note/<?php echo $tvl['TvlBookTkt']['id'];?>/?start=<?php echo $tvl['TvlBookTkt']['start_date'];?>&trip=<?php echo $tvl['TvlBookTkt']['type'];?>"  val="50_70" rel="tooltip" title="Add Travel Desk Status" class="iframeBox btn click_hide"><i class="glyphicon-edit"></i></a> &nbsp;	
					<?php endif; endif; ?>
					
					<?php if($tvl['TvlBookTkt']['type'] == '2'):
					if($tvl['TvlBookTkt']['tdesk_status']):?>	
					<div class="btn-group">
					<a href="#" data-toggle="dropdown" rel="tooltip" title="View Travel Desk Status" class="btn dropdown-toggle click_hide"><i class="glyphicon-notes"></i> <span class="caret"></span></a>
					<ul class="dropdown-menu">
					<li><a href="<?php echo $this->webroot;?>tvlbooktkt/view_note/<?php echo $tvl['TvlBookTkt']['id'];?>/" val="50_70" class="iframeBox btn">Onward Journey</a>
					</li><li><a href="<?php echo $this->webroot;?>tvlbooktkt/view_note/<?php echo $tvl['TvlBookTkt']['id'];?>/?action=return" val="50_70"  class="iframeBox btn">Return Journey</a>
					</li>
					</ul>
					</div>
					<?php elseif(empty($tvl['TvlBookTkt']['tkt_status'])):?>
					<div class="btn-group">
					<a href="#" data-toggle="dropdown" rel="tooltip" title="Add Travel Desk Status" class="btn dropdown-toggle click_hide"><i class="glyphicon-edit"></i> <span class="caret"></span></a>
					<ul class="dropdown-menu">
					<li><a href="<?php echo $this->webroot;?>tvlbooktkt/add_note/<?php echo $tvl['TvlBookTkt']['id'];?>/?start=<?php echo $tvl['TvlBookTkt']['start_date'];?>&return=<?php echo $tvl['TvlBookTkt']['return_date'];?>&trip=<?php echo $tvl['TvlBookTkt']['type'];?>" val="50_70"  class="iframeBox btn">Onward Journey</a>
					</li><li><a href="<?php echo $this->webroot;?>tvlbooktkt/add_note/<?php echo $tvl['TvlBookTkt']['id'];?>/?start=<?php echo $tvl['TvlBookTkt']['start_date'];?>&return=<?php echo $tvl['TvlBookTkt']['return_date'];?>&action=return&trip=<?php echo $tvl['TvlBookTkt']['type'];?>" val="50_70" class="iframeBox btn">Return Journey</a>
					</li>
					</ul>
					</div>
					<?php endif;endif; ?>
					
					<?php 
							
							$icon = $this->Functions->show_verify_icon($tvl['TvlBookTkt']['tkt_status'] ? 'fail' : 'pass');
							$title = $this->Functions->show_tkt_verify_title($tvl['TvlBookTkt']['tkt_status'] ? 'fail' : 'pass');
											
											
											?>						
					<a href="<?php echo $this->webroot;?>tvlbooktkt/book_ticket/<?php echo $tvl['TvlBookTkt']['id'];?>/" class="btn" rel="tooltip" title="<?php echo $title;?>"><i class="<?php echo $icon;?>"></i></a>
						
										
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
						<input type="hidden" value="<?php echo $this->webroot;?>tvlbooktkt/" id="webroot">
			<?php echo $this->Form->end(); ?>
						</div>
					</div>
				</div>
					
					
				</div>
		
			
			</div>
			

		</div>	
			
		
		
		
		
				
		


