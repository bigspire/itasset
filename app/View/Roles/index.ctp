<?php echo $this->element($menu); ?>
		
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Role</h1>
						
						
					</div>
				
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?><?php echo $home_link; ?>/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						
						
						<li>
							<a href="<?php echo $this->webroot;?>roles/<?php echo $role_var;?>">Role</a>
							
						</li>
						
						
					</ul>
					
				</div>
				
				
				
				<?php echo $this->Session->flash();?>
				
					<div class="row-fluid footer_div" >
					<div class="span12">
						<div class="box box-bordered box-color">
						
						<div class="box-title">
								<h3><i class="icon-list"></i> Role</h3>
							</div>
							
						

						<?php echo $this->Form->create('Role', array('name' => '', 'type' => '', 'id' => 'formID', 'class' => '')); ?>
							<div class="box-content">
							
						<div class="dataTables_wrapper">
						
				<div class="" id="DataTables_Table_8_filter"  style="padding:15px">
				
				<span>Search:</span>  
				
				<?php echo $this->Form->input('SearchText', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-large', 'value' => $this->params->query['keyword'],  'id' => 'SearchText', 'required' => false, 'autocomplete' => 'off', 'placeholder' => 'Search here...', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												
		
				
				
											
											<input type="submit" value="Search" class="btn btn-primary" style="margin-bottom:9px;margin-left:4px;">
											
													<a href="<?php echo $this->webroot;?>roles/<?php echo $role_var;?>"><button style="margin-bottom:9px;margin-left:4px;" type="button" class="btn btn-primary"><i class="icon-refresh"></i> Reset</button></a>
											
					<a href="<?php echo $this->webroot;?>roles/create_role/<?php echo $role_var;?>"><button type="button" class="btn btn-primary" style="float:right"><i class="icon-plus"></i> Add Role</button></a>
						
								</div>			
								
								
<div id="dialog-confirm" title="Confirmation!" class="dn">
	<p>Are you sure you want to delete?</p>
</div>

<input type="hidden" id="del_url" value="<?php echo $this->webroot;?>roles/delete_role/"/>
								<table class="table table-hover table-nomargin table-bordered usertable dataTable">
									<thead>
										
										<tr>
											
											<th>
											<?php echo $this->Paginator->sort('role_name', 'Role', array('escape' => false,'direction' => 'desc'));?>
												</th>
												
												
											
										
												
												<th>
											<?php echo $this->Paginator->sort('created_date', 'Created', array('escape' => false,'direction' => 'desc'));?>
												</th>
											
											<th>Status</th>
											<th>Options</th>
										</tr>
									</thead>
									<tbody>
									
										
									
										<?php  foreach($role_data as $role):?>
										
										<tr>
											
											<td><?php echo $role['Role']['role_name'];?></td>
											
											<td><?php echo $this->Functions->format_date($role['Role']['created_date']);?></td>
											<td><?php echo $this->Functions->show_status($role['Role']['status']);?></td>
											<td class='hidden-480'>
												<a href="<?php echo $this->webroot;?>roles/view_role/<?php echo $role['Role']['id'];?>/<?php echo $role_var;?>" class="btn" rel="tooltip" title="View"><i class="icon-search"></i></a>
												<a href="<?php echo $this->webroot;?>roles/edit_role/<?php echo $role['Role']['id'];?>/<?php echo $role_var;?>" class="btn" rel="tooltip" title="Edit"><i class="icon-edit"></i></a>
												<a href="javascript:void(0);" name="<?php echo $role['Role']['id'];?>" class="btn delRec" rel="tooltip" title="Delete"><i class="icon-remove"></i></a>
											</td>
										</tr>
										
									<?php endforeach; ?>
									</tbody>
								</table>
								

								<?php echo $this->element('paging');?>
								
								




								
							</div>	

							</div>
						<input type="hidden" value="1" id="SearchKeywords">
						<input type="hidden" value="<?php echo $mod?>" id="role">
						<input type="hidden" value="<?php echo $this->webroot;?>roles/" id="webroot">
						 <?php echo $this->Form->end(); ?>
						</div>
					</div>
				</div>
					
					
				</div>
		
			
			</div>
			

		</div>	
			
		
		
		
		
				
		


