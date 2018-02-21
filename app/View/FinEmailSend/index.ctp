<?php echo $this->element('fin_menu'); ?>
		
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Email Send</h1>
						
						
					</div>
				
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>finhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						
						
						<li>
							<a href="<?php echo $this->webroot;?>finemailsend/">Email Send</a>
							
						</li>
						
						
					</ul>
					
				</div>
				
				
				
				<?php echo $this->Session->flash();?>
				
					<div class="row-fluid footer_div" >
					<div class="span12">
						<div class="box box-bordered box-color">
						
						<div class="box-title">
								<h3><i class="icon-list"></i> Email Send</h3>
							</div>
							
						

						<?php echo $this->Form->create('FinEmailSend', array('name' => '', 'type' => '', 'id' => 'formID', 'class' => '')); ?>
							<div class="box-content">
							
						<div class="dataTables_wrapper">
						
				<div class="" id="DataTables_Table_8_filter"  style="padding:15px">
				
				<span>Search:</span>  
				
				<?php echo $this->Form->input('SearchText', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'input-large', 'value' => $this->params->query['keyword'],  'id' => 'SearchText', 'required' => false, 'autocomplete' => 'off', 'placeholder' => 'Search here...', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
												
		
				
				
											
											<input type="submit" value="Search" class="btn btn-primary" style="margin-bottom:9px;margin-left:4px;">
											
													<a href="<?php echo $this->webroot;?>finemailsend/"><button style="margin-bottom:9px;margin-left:4px;" type="button" class="btn btn-primary"><i class="icon-refresh"></i> Reset</button></a>
											
				
						
								</div>			
								
								


<input type="hidden" id="del_url" value="<?php echo $this->webroot;?>finemailsend/send_mail/"/>
								<table class="table table-hover table-nomargin table-bordered usertable dataTable">
									<thead>
										
										<tr>
											
											<th>
											<?php echo $this->Paginator->sort('first_name', 'Name', array('escape' => false,'direction' => 'desc'));?>
												</th>
												
													<th>
											<?php echo $this->Paginator->sort('email_address', 'Email', array('escape' => false,'direction' => 'desc'));?>
												</th>
												
											
											<th>
											<?php echo $this->Paginator->sort('dept_name', 'Department', array('escape' => false,'direction' => 'desc'));?>
												</th>
													<th>
											<?php echo $this->Paginator->sort('desig_name', 'Designation', array('escape' => false,'direction' => 'desc'));?>
												</th>
												
												<th>
											<?php echo $this->Paginator->sort('create_notify', 'Sent Date', array('escape' => false,'direction' => 'desc'));?>
												</th>
											
											<th>Status</th>
											<th>Options</th>
										</tr>
									</thead>
									<tbody>
									
										
									
										<?php  foreach($emp_data as $emp): ?>
										
										<tr>
											<td><?php echo $emp['FinEmailSend']['first_name'].' '.$emp['FinEmailSend']['last_name'];?></td>
											<td><?php echo $emp['FinEmailSend']['email_address'];?></td>
											<td><?php echo $emp['HrDepartment']['dept_name'];?></td>
											<td><?php echo $emp['HrDesignation']['desig_name'];?></td>
											<td><?php echo $this->Functions->format_date($emp['FinEmailSend']['create_notify']);?></td>
											<td><?php echo $this->Functions->show_email_status($emp['FinEmailSend']['create_notify']);?></td>
											<td class='hidden-480'>
												<a href="javascript:void(0);" val="<?php echo $emp['Advance']['id'];?>_<?php echo $emp['Expense']['id'];?>_<?php echo $emp['Leave']['id'];?>" name="<?php echo $emp['FinEmailSend']['email_address'].'--'.$emp['FinEmailSend']['first_name'].'--'.$emp['FinEmailSend']['id'];?>" class="btn sendEmail" rel="tooltip" title="Send"><i class="icon-envelope"></i></a>
												
											</td>
										</tr>
										
									<?php endforeach; ?>
									</tbody>
								</table>
								

								<?php echo $this->element('paging');?>
								
								




								
							</div>	

							</div>
						<input type="hidden" value="1" id="SearchKeywords">
						<input type="hidden" value="<?php echo $this->webroot;?>finemailsend/" id="webroot">
						
									
	<input type="hidden" value="<?php echo $this->webroot;?>finemailsend/" id="post_data">	
			
<div id="dialog-confirm" title="Confirmation!" class="dn">
	<p id="alt_msg"></p>
</div>		
	
	
	
						 <?php echo $this->Form->end(); ?>
						</div>
					</div>
				</div>
					
					
				</div>
		
			
			</div>
			

		</div>	
			
		
		
		
		
				
		


