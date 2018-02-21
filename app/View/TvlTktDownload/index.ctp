<?php echo $this->element('tvl_menu'); ?>
		
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Download Ticket</h1>
						
						
					</div>
				
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>tvlhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						
						
						<li>
							<a href="<?php echo $this->webroot;?>tvlcanreq/">Download Ticket</a>
							
						</li>
						
						
					</ul>
					
				</div>
				
				
				
				<?php echo $this->Session->flash();?>
				
					<div class="row-fluid footer_div" >
					<div class="span12">
						<div class="box box-bordered box-color">
						
						<div class="box-title">
								<h3><i class="icon-list"></i> Download Ticket</h3>
							</div>
							
						

						<?php echo $this->Form->create('TvlTktDownload', array('name' => '', 'type' => '', 'id' => 'formID', 'class' => '')); ?>
							<div class="box-content">
							
						<div class="dataTables_wrapper">
						
				<div class="" id="DataTables_Table_8_filter"  style="padding:15px;text-align:center;">
				
				<span>Enter Travel ID:</span>  
				<?php echo $this->Form->input('keyword', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-large', 'value' => $this->params->query['keyword'], 'id' => 'SearchText' , 'required' => false,  'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												
					
				
				
				
											
											<input type="submit" class="btn btn-primary" style="margin-bottom:9px;margin-left:4px;" value="Submit"/>
											
														<a href="<?php echo $this->webroot;?>tvltktdownload/"><button style="margin-bottom:9px;margin-left:4px;" type="button" class="btn btn-primary"><i class="icon-refresh"></i> Reset</button></a>
		
						
								</div>			
								
								

						<table class="table table-hover table-nomargin table-condensed" style="margin-bottom:20px" >
									<thead>
										<tr>
											<th>Journey Date</th>
											<th>Source</th>
											<th class="hidden-350">Destination</th>
											<th class="hidden-1024">Ticket</th>
										</tr>
									</thead>
									<tbody>
									
							<?php if(!empty($ticket[0]['TvlTktDownload']['start_date'])):?>
									
										<tr>
											<td><?php echo $this->Functions->format_date($ticket[0]['TvlTktDownload']['start_date']);?></td>
											
											<td class="hidden-350"><?php echo $ticket[0]['TvlStart']['place'];?></td>
											<td>
												<?php echo $ticket[0]['TvlPlace']['place'];?>
											</td>
											<td class="hidden-1024">
									<a href="<?php echo $this->webroot;?>tvltktdownload/download/<?php echo $ticket[0]['TvlTicket']['id'];?>/<?php echo $ticket[0]['TvlTktDownload']['id'];?>/?type=O">Download</a>

																			</td>
										</tr>
									<?php endif; ?>		
									
									
									<?php if(!empty($ticket2[0]['TvlTktDownload']['return_date'])):?>	
										<tr>
											<td><?php echo $this->Functions->format_date($ticket2[0]['TvlTktDownload']['return_date']);?></td>
											
											<td class="hidden-350"><?php echo $ticket2[0]['TvlPlace']['place'];?></td>
											<td>
												<?php echo $ticket2[0]['TvlStart']['place'];?>
											</td>
											<td class="hidden-1024">
									<a href="<?php echo $this->webroot;?>tvltktdownload/download/<?php echo $ticket2[0]['TvlTicket']['id'];?>/<?php echo $ticket2[0]['TvlTktDownload']['id'];?>/?type=R">Download (Return)</a>

																			</td>
										</tr>
										<?php endif; ?>
										
									
										
									</tbody>
								</table>


								
							</div>	

							</div>
						<input type="hidden" value="<?php echo $this->webroot;?>tvlcanreq/" id="webroot">
						 <?php echo $this->Form->end(); ?>
						</div>
					</div>
				</div>
					
					
				</div>
		
			
			</div>
			

		</div>	
			
		
		
		
		
				
		


