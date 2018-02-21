<?php echo $this->element($menu_inc); ?>

		
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1><?php echo $APPROVER_TYPE;?></h1>
						
						
					</div>
				
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot.$redirect?>/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						
						
						<li>
							<a href="#"><?php echo $APPROVER_TYPE;?></a>
							
						</li>
						
						
					</ul>
					
				</div>
				
				
				
				<?php echo $this->Session->flash();?>
				
					<div class="row-fluid footer_div" >
					<div class="span12">
						<div class="box box-bordered box-color">
						
						<div class="box-title">
								<h3><i class="icon-list"></i> <?php echo $APPROVER_TYPE;?></h3>
							</div>
							
						

						<?php echo $this->Form->create('Approve', array('name' => '', 'type' => '', 'id' => 'formID', 'class' => '')); ?>
							<div class="box-content">
							
						<div class="dataTables_wrapper">
						
				<div class="" id="DataTables_Table_8_filter"  style="padding:15px">
				
				<span>Search:</span> 	<?php echo $this->Form->input('SearchText', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-large', 'value' => $this->params->query['keyword'],  'id' => 'SearchText', 'required' => false, 'autocomplete' => 'off', 'placeholder' => 'Search here...', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												
											
										<input type="submit" value="Search" class="btn btn-primary" style="margin-bottom:9px;margin-left:4px;">
											
											<a href="<?php echo $this->webroot;?>approve/?type=<?php echo $FN_TYPE;?>"><button style="margin-bottom:9px;margin-left:4px;" type="button" class="btn btn-primary"><i class="icon-refresh"></i> Reset</button></a>
											
					<a href="<?php echo $this->webroot;?>approve/create_approver/?type=<?php echo $FN_TYPE;?>"><button type="button" class="btn btn-primary" style="float:right"><i class="icon-plus"></i> Add <?php echo $APPROVER_TYPE;?></button></a>
					
<a href="<?php echo $this->webroot;?>approve/index/?type=<?php echo $FN_TYPE;?>&action=export"><button type="button" class="btn btn-primary" style="float:right;margin-right:14px;"><i class="icon-file"></i> Export <?php echo $APPROVER_TYPE;?></button></a>					
								</div>			
								
								
<div id="dialog-confirm" title="Confirmation!" class="dn">
	<p>Are you sure you want to delete?</p>
</div>

<input type="hidden" id="approver" value="<?php echo $FN_TYPE;?>"/>

<input type="hidden" id="del_url" value="<?php echo $this->webroot;?>approve/delete_approver/"/>
								<table class="table table-hover table-nomargin table-bordered usertable dataTable">
									<thead>
										
										<tr>
											
											<th width="250">
											<?php echo $this->Paginator->sort('first', 'Employee', array('escape' => false,'direction' => 'desc'));?>
</th>
											
											<th width=""><?php echo $this->Paginator->sort('l1_first', 'L1', array('escape' => false,'direction' => 'desc'));?></th>
											<th><?php echo $this->Paginator->sort('l2_first', 'L2', array('escape' => false,'direction' => 'desc'));?></th>
											<!--th width=""> <?php echo $this->Paginator->sort('auth_amount_l1', 'L1 Amount', array('escape' => false,'direction' => 'desc'));?></th>
											<th width=""> <?php echo $this->Paginator->sort('auth_amount_l2', 'L2 Amount', array('escape' => false,'direction' => 'desc'));?></th-->
											<th><?php echo $this->Paginator->sort('created_date', 'Created', array('escape' => false,'direction' => 'desc'));?></th>											
											<th><?php echo $this->Paginator->sort('modified_date', 'Modified', array('escape' => false,'direction' => 'desc'));?></th>											

											<th>Options</th>
											
										</tr>
									</thead>
									<tbody>
									
										
									
										<?php foreach($approver_data as $data):?>
										
										<tr>
											
											<td><?php echo ucwords($data['Home']['first']. ' '. $data['Home']['last']);?><br>
											<span style="font-size:11px"><?php echo $data['Home']['email_address']?></span></td>
											<td><?php echo ucwords($data['tbl_level1']['l1_first'].' '.$data['tbl_level1']['l1_last']);?><br>
											<span style="font-size:11px"><?php echo $data['tbl_level1']['l1_email']?></span></td>
												<td><?php echo $data['tbl_level2']['l2_first'].' '.$data['tbl_level2']['l2_last'];?><br>
											<span style="font-size:11px"><?php echo $data['tbl_level2']['l2_email']?></span></td>
											<!--td><?php echo $data['Approve']['auth_amount_l1'];?></td>
											<td class='hidden-350'><?php echo $data['Approve']['auth_amount_l2'];?></td-->
											
											<td><?php echo $this->Functions->format_date($data['Approve']['created_date']);?></td>
											<td><?php echo $this->Functions->format_date($data['Approve']['modified_date']);?></td>

											<td class='hidden-480'>												
												<a href="<?php echo $this->webroot;?>approve/edit_approver/<?php echo $data['Approve']['id'];?>/?type=<?php echo $FN_TYPE;?>" class="btn" rel="tooltip" title="Edit"><i class="icon-edit"></i></a>
												<a href="javascript:void(0);" name="<?php echo $data['Approve']['id'];?>" class="btn delRec" rel="tooltip" title="Delete"><i class="icon-remove"></i></a>
											</td>
										</tr>
									<?php endforeach; ?>
									</tbody>
								</table>
								

								<?php echo $this->element('paging');?>
								
								




								
							</div>	

							</div>
							<input type="hidden" value="1" id="SearchKeywords">
						<input type="hidden" value="<?php echo $this->webroot;?>approve/" id="webroot">

						
						 <?php echo $this->Form->end(); ?>
						</div>
					</div>
				</div>
					
					
				</div>
		
			
			</div>
			

		</div>	
			
		
		
		
		
				
		


