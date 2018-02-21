<?php echo $this->element('tsk_menu'); ?>
		
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>ROA History</h1>
						
						
					</div>
				
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>tskhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						
						
						<li>
							<a href="<?php echo $this->webroot;?>tskroahistory/">ROA History</a>
							
						</li>
						
						
					</ul>
					
				</div>
				
				
				
				<?php echo $this->Session->flash();?>
				
					<div class="row-fluid footer_div" >
					<div class="span12">
						<div class="box box-bordered box-color">
						
						<div class="box-title">
								<h3><i class="icon-list"></i> ROA History</h3>
							</div>
							
						

						<?php echo $this->Form->create('TskRoaHistory', array('name' => '', 'type' => '', 'id' => 'formID', 'class' => '')); ?>
							<div class="box-content">
							
						<div class="dataTables_wrapper">
						
				<div class="" id="DataTables_Table_8_filter"  style="padding:15px">
				
				<span>Search:</span>  
				<?php echo $this->Form->input('month_start', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'monthpick input-medium', 'value' => $this->params->query['month_start'],   'required' => false, 'autocomplete' => 'off', 'placeholder' => 'From Month', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
				<?php echo $this->Form->input('month_end', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'monthpick input-medium', 'value' => $this->params->query['month_end'],   'required' => false, 'autocomplete' => 'off', 'placeholder' => 'Till Month', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
				<?php echo $this->Form->input('type', array('div'=> false,'type' => 'select', 'empty' => 'Select', 'value' => $this->params->query['type'],'label' => false, 'class' => 'input-large', 'options' => $star_options,  'required' => false, 'autocomplete' => 'off', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 

											
					<input class="btn btn-primary" type="submit" style="margin-bottom:9px;margin-left:4px;" value="Search"/>
											
					<a href="<?php echo $this->webroot;?>tskroahistory/"><button style="margin-bottom:9px;margin-left:4px;" type="button" class="btn btn-primary"><i class="icon-refresh"></i> Reset</button></a>
								
						
				</div>			
								
								


<input type="hidden" id="del_url" value="<?php echo $this->webroot;?>tskroahistory/delete_advance/"/>
								<table class="table table-hover table-nomargin table-bordered usertable dataTable">
									<thead>
										
										<tr>
											

											<th width="120">
											<?php echo $this->Paginator->sort('reward_month', 'Month', array('escape' => false,'direction' => 'desc'));?>
											</th>
											
											<th width="120">
											<?php echo $this->Paginator->sort('type', 'Type', array('escape' => false,'direction' => 'desc'));?>
											</th>
											
											<th width="400">
											<?php echo $this->Paginator->sort('employee', 'Employee (s)', array('escape' => false,'direction' => 'desc'));?>
											</th>
											
											<th width="120"><?php echo $this->Paginator->sort('rating', 'Rating', array('escape' => false,'direction' => 'desc'));?></th>
											<th width="120"> <?php echo $this->Paginator->sort('created_date', 'Created Date', array('escape' => false,'direction' => 'desc'));?></th>
											<th width="200">Status</th>
											<th>View</th>
										</tr>
									</thead>
									<tbody>
									
										
									
										<?php  foreach($roa_data as $roa):?>
										
										<tr>
											
											<td><?php echo $this->Functions->format_month($roa['TskRoaHistory']['reward_month']);?></td>
											<td><?php echo $this->Functions->get_roa_type($roa['TskRoaHistory']['type']);?> </td>
											<td><?php echo $roa[0]['roa_member'];?>
										
										
										<?php 
										if($roa[0]['star_type'] != ''):
											$type_exp = explode(',' ,  $roa[0]['star_type']);
											foreach($type_exp as $val):		
										?>
											<span class="label label-<?php echo $this->Functions->get_star_color($val);?>" style="margin-left:10px;margin-top:10px;"><?php echo $this->Functions->get_star_msg($val);?></span>
											<?php endforeach;endif; ?>
										
										</td>
											<td><?php echo $this->Functions->show_roa_rating($roa['TskRoaHistory']['rating']);?></td>
											<td><?php echo $this->Functions->format_date($roa['TskRoaHistory']['created_date']);?></td>
											<td class='hidden-350'>
											
											<?php echo $this->Functions->format_status($roa[0]['st_status'],$roa[0]['st_created'],$roa[0]['st_user'],$roa[0]['st_modified']); ?>
											
									
											
										</td>
											
												
										
											<td class='hidden-480'>
											
												<a href="<?php echo $this->webroot;?>tskroahistory/view/<?php echo $roa['TskRoaHistory']['id'];?>/" val="92_75" class="iframeBox btn" rel="tooltip" title="View"><i class="icon-search"></i> 
												</a>
											<?php if($roa[0]['unread'] > 0):?>
												<span id="Read-<?php echo $roa['TskRoaHistory']['id'];?>" style="position:absolute;margin-left:3px;font-size: 11px;font-weight: 400;padding: 0 3px;" class="label label-lightred"><?php echo $roa[0]['unread'];?></span>
											<?php endif; ?>
										
											</td>
										</tr>
									<?php endforeach; ?>
									</tbody>
								</table>
								

								<?php echo $this->element('paging');?>
								
								

										<input type="hidden" id="end_date" value="<?php echo date('m/Y', strtotime('-0 Month'));?>" />



								
							</div>	

							</div>
						<input type="hidden" value="1" id="SearchKeywords">
							<input type="hidden" value="1" id="overlayclose">
						<input type="hidden" value="<?php echo $this->webroot;?>tskroahistory/" id="webroot">
						 <?php echo $this->Form->end(); ?>
						</div>
					</div>
				</div>
					
					
				</div>
		
			
			</div>
			

		</div>	