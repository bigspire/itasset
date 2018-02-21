<?php echo $this->element('tsk_menu'); ?>
		
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>ROA Committee</h1>
						
						
					</div>
				
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>tskhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						
						
						<li>
							<a href="<?php echo $this->webroot;?>tskroacommittee/">ROA Committee</a>
							
						</li>
						
						
					</ul>
					
				</div>
				
				
				
				<?php echo $this->Session->flash();?>
				
					<div class="row-fluid  footer_div" >
					<div class="span12">
						<div class="box box-bordered box-color">
						
						<div class="box-title">
								<h3><i class="icon-list"></i> ROA Committee</h3>
							</div>
							
						

						<?php echo $this->Form->create('TskRoaCommittee', array('name' => '', 'type' => '', 'id' => 'formID', 'class' => '')); ?>
							<div class="box-content">
							
						<div class="dataTables_wrapper">
						
					
								
								

<input type="hidden" id="del_url" value="<?php echo $this->webroot;?>tskroacommittee/delete_project/"/>
								<table class="table table-hover table-nomargin table-bordered usertable dataTable">
									<thead>
										
										<tr>
											
											<th width="600">
											Committee Members
												</th>
												
													
											
											
											
												<th>
											Last Modified
												</th>
												
											<th>Options</th>
										</tr>
									</thead>
									<tbody>
									
										
									
										<?php  foreach($committee_data as $committee):
											$member .= ++$i.'. '.ucwords($committee['HrEmployee']['first_name'].' '.$committee['HrEmployee']['last_name'])."<br>";
											$modified = $this->Functions->format_date($committee['TskRoaCommittee']['created_date']);
											$id = $committee['TskRoaCommittee']['id'];
										endforeach; ?>
										
										<tr>
											
											<td><?php echo $member;?></td>
											<td><?php echo $modified;?></td>
											
											<td class='hidden-480'>
												<a href="<?php echo $this->webroot;?>tskroacommittee/edit_member/<?php echo $id;?>/" class="btn" rel="tooltip" title="Edit"><i class="icon-edit"></i></a>
											</td>
										</tr>
										
									
									</tbody>
								</table>
								

								
								




								
							</div>	

							</div>
						<input type="hidden" value="1" id="SearchKeywords">
						<input type="hidden" value="<?php echo $this->webroot;?>tskroacommittee/" id="webroot">
						 <?php echo $this->Form->end(); ?>
						</div>
					</div>
				</div>
					
					
				</div>
		
			
			</div>
			

		</div>	
			
		
		
		
		
				
		


