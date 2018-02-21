<?php echo $this->element('bd_menu'); ?>

	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>SPOC</h1>
						
						
					</div>
				
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>bdhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						
						
						<li>
							<a href="<?php echo $this->webroot;?>bdspoc/">SPOC</a>
							
						</li>
						
						
					</ul>
					
				</div>
				
				
				
				<?php echo $this->Session->flash();?>
				
					<div class="row-fluid  footer_div" >
					<div class="span12">
						<div class="box box-bordered box-color">
						
						<div class="box-title">
								<h3><i class="icon-list"></i> SPOC</h3>
							</div>
							
						

						<?php echo $this->Form->create('BdSpoc', array('name' => '', 'type' => '', 'id' => 'formID', 'class' => '')); ?>
							<div class="box-content">
							
						<div class="dataTables_wrapper">
						
				<div class="" id="DataTables_Table_8_filter"  style="padding:8px 8px 4px 8px">
				
			
			<?php echo $this->Form->input('keyword', array('div'=> false,'type' => 'text', 'id' => 'SearchText', 'label' => false, 'class' => 'input-xlarge ', 'value' => $this->params->query['keyword'], 'required' => false, 'autocomplete' => 'off', 'placeholder' => 'Search here...', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												
			
											<input type="submit" value="Search" class="btn btn-primary" style="margin-bottom:9px;margin-left:4px;">
											
													<a href="<?php echo $this->webroot;?>bdspoc/"><button style="margin-bottom:9px;margin-left:4px;" type="button" class="btn btn-primary"><i class="icon-refresh"></i> Reset</button></a>
											
						<a href="<?php echo $this->webroot;?>bdspoc/add_spoc/"><button type="button" class="btn btn-primary" style="float:right"><i class="icon-plus"></i> Add SPOC</button></a>
								</div>			
								
								
<div id="dialog-confirm" title="Confirmation!" class="dn">
	<p>Are you sure you want to delete?</p>
</div>

<input type="hidden" id="del_url" value="<?php echo $this->webroot;?>bdspoc/delete_spoc/"/>

								<table class="table table-hover table-nomargin table-bordered usertable dataTable">
									<thead>
										
										<tr>
											<th width="">
											<?php echo $this->Paginator->sort('HrEmployee.first_name', 'Employee', array('escape' => false,'direction' => 'desc'));?>
												</th>
											
												<th  width="100">
											<?php echo $this->Paginator->sort('created_date', 'Created', array('escape' => false,'direction' => 'desc'));?>
												</th>
											<th  width="80">Status</th>
											<th>Options</th>
										</tr>
									</thead>
									<tbody>
									
										
									
										<?php  foreach($spoc_data as $spoc):?>
										
									
										
													
										
									
											
										<tr>
														<td><?php echo $spoc['HrEmployee']['first_name'].' '.$spoc['HrEmployee']['last_name'];?></td>
											
											
											<td><?php echo $this->Functions->format_date($spoc['BdSpoc']['created_date']);?></td>
										
											
											<td>								
		<?php echo $this->Functions->show_status($spoc['BdSpoc']['status']);?>
</td>
											<td class='hidden-480'>
			<a href="javascript:void(0);" name="<?php echo $spoc['BdSpoc']['id'];?>" class="btn delRec" rel="tooltip" title="Delete"><i class="icon-remove"></i></a>

											</td>
										</tr>
										
										
									<?php endforeach; ?>
									</tbody>
								</table>
								

							<?php echo $this->element('paging');?>
								
								




								
							</div>	

							</div>
						<input type="hidden" value="1" id="SearchKeywords">
						<input type="hidden" value="<?php echo $this->webroot;?>bdspoc/" id="webroot">
						 <?php echo $this->Form->end(); ?>
						</div>
					</div>
				</div>
					
					
				</div>
		
			
			</div>
			

		</div>	
			
		
		
		
		
				
		


