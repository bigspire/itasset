<?php echo $this->element('tsk_menu'); ?>
		
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>My ROA</h1>
						
						
					</div>
					<a href="<?php echo $this->webroot;?>pdfjs/web/viewer.html" class="colorboxPolicy">
					<button type="button" class="btn btn-teal" style="float:right;margin-top:20px;">
							<i class="icon-zoom-in"></i> ROA Policy</button></a>
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo $this->webroot;?>tskhome/">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						
						
						
						<li>
							<a href="<?php echo $this->webroot;?>tskroa/">My ROA</a>
							
						</li>
						
						
					</ul>
					
				</div>
				
				
				
				<?php echo $this->Session->flash();?>
				
					<div class="row-fluid footer_div" >
					<div class="span12">
						<div class="box box-bordered box-color">
						
						<div class="box-title">
								<h3><i class="icon-list"></i> My ROA</h3>
							</div>
							
						

						<?php echo $this->Form->create('TskRoa', array('name' => '', 'type' => '', 'id' => 'formID', 'class' => '')); ?>
							<div class="box-content">
							
						<div class="dataTables_wrapper">
						
				<div class="" id="DataTables_Table_8_filter"  style="padding:15px">
				
				<span>Search:</span>  
				<?php echo $this->Form->input('month_start', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'monthpick input-medium', 'value' => $this->params->query['month_start'],   'required' => false, 'autocomplete' => 'off', 'placeholder' => 'From Month', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
				<?php echo $this->Form->input('month_end', array('div'=> false,'type' => 'text', 'label' => false, 'class' => 'monthpick input-medium', 'value' => $this->params->query['month_end'],   'required' => false, 'autocomplete' => 'off', 'placeholder' => 'Till Month', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
				<?php echo $this->Form->input('type', array('div'=> false,'type' => 'select', 'empty' => 'Select', 'value' => $this->params->query['type'],'label' => false, 'class' => 'input-large', 'options' => $star_options,  'required' => false, 'autocomplete' => 'off', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 

											
					<input class="btn btn-primary" type="submit" style="margin-bottom:9px;margin-left:4px;" value="Search"/>
											
					<a href="<?php echo $this->webroot;?>tskroa/"><button style="margin-bottom:9px;margin-left:4px;" type="button" class="btn btn-primary"><i class="icon-refresh"></i> Reset</button></a>
								
					<a href="<?php echo $this->webroot;?>tskroa/recommend/"><button type="button" class="btn btn-primary" style="float:right"><i class="icon-plus"></i> Recommend</button></a>
						
				</div>			
								
								
<div id="dialog-confirm" title="Confirmation!" class="dn">
	<p>Are you sure you want to delete?</p>
</div>

<input type="hidden" id="del_url" value="<?php echo $this->webroot;?>tskroa/delete_advance/"/>
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
											
											<td><?php echo $this->Functions->format_month($roa['TskRoa']['reward_month']);?></td>
											<td><?php echo $this->Functions->get_roa_type($roa['TskRoa']['type']);?> </td>
											<td><?php echo $roa[0]['roa_member'];?>
										
										
										<?php 
										if($roa[0]['star_type'] != ''):
											$type_exp = explode(',' ,  $roa[0]['star_type']);
											foreach($type_exp as $val):		
										?>
											<span class="label label-<?php echo $this->Functions->get_star_color($val);?>" style="margin-left:10px;margin-top:10px;"><?php echo $this->Functions->get_star_msg($val);?></span>
											<?php endforeach;endif; ?>
										
										</td>
											<td><?php echo $this->Functions->show_roa_rating($roa['TskRoa']['rating']);?></td>
											<td><?php echo $this->Functions->format_date($roa['TskRoa']['created_date']);?></td>
											<td class='hidden-350'>
											
											<?php echo $this->Functions->format_status($roa[0]['st_status'],$roa[0]['st_created'],$roa[0]['st_user'],$roa[0]['st_modified']); ?>
											
									
											
										</td>
											
												
										
											<td class='hidden-480'>
											
												<a href="<?php echo $this->webroot;?>tskroa/view/<?php echo $roa['TskRoa']['id'];?>/" val="92_96" class="iframeBox btn" rel="tooltip" title="View"><i class="icon-search"></i> 
												</a>
											<?php if($roa[0]['unread'] > 0):?>
												<span id="Read-<?php echo $roa['TskRoa']['id'];?>" style="position:absolute;margin-left:3px;font-size: 11px;font-weight: 400;padding: 0 3px;" class="label label-lightred" rel="tooltip" title="New Message"><i class="icon-envelope"></i>  <?php echo $roa[0]['unread'];?></span>
											<?php endif; ?>
										
											</td>
										</tr>
									<?php endforeach; ?>
									</tbody>
								</table>
								

								<?php echo $this->element('paging');?>
								
								




								
							</div>	

							</div>
					<input type="hidden" id="end_date" value="<?php echo date('m/Y', strtotime('-1 Month'));?>" />

						<input type="hidden" value="1" id="SearchKeywords">
							<input type="hidden" value="1" id="overlayclose">
						<input type="hidden" value="<?php echo $this->webroot;?>tskroa/" id="webroot">
						 <?php echo $this->Form->end(); ?>
						</div>
					</div>
				</div>
					
					
				</div>
		
			
			</div>
			

		</div>	