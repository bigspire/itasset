<?php echo $this->element('bd_menu'); ?>
	<div class="container-fluid" id="content">
		<div id="main">
			<div class="container-fluid">
			
								

				<div class="page-header">
					<div class="pull-left">
						<h1><?php echo $biz_type ? $biz_type.' Business' : 'My Business';?></h1>
					</div>
						
				
					
				
				</div>
				
				<div class="breadcrumbs">
					<ul>
						
						
						
						
						<li>
							<a href="<?php echo $this->webroot;?>bdbusiness/">My Business</a>
							
						<?php if($this->request->query['type']):?>
							<i class="icon-angle-right"></i>
							<?php endif; ?>
						</li>
						
						<?php if($this->request->query['type']):?>
						<li>
							<a href="<?php echo $this->webroot;?>bdbusiness/?type=<?php echo $this->request->query['type'];?>"><?php echo $biz_type;?> Business</a>
						</li>
						<?php endif; ?>
						
						
						
					</ul>
					
					<div style="float:right;margin:3px 30px 0 10px;" class="">
					<span><i class="icon-search"></i> <a href="javascript:void(0);" class="click_hide homeSearch" title="Search Options" rel="tooltip">Search</a> </span> | 
					<span><i class="icon-share"></i> <a href="<?php echo $this->webroot;?>bdbusiness/?action=export&<?php echo $this->Functions->get_url_vars($this->request->query);?>"  class="click_hide"  title="Export Excel" rel="tooltip">Export</a></span>
					|
					<span><i class="icon-plus-sign"></i> <a href="<?php echo $this->webroot;?>bdbusiness/add/"  class="click_hide"  title="Create New Business" rel="tooltip">New Business</a></span>

										</div>
					
				</div>
			
				
				
				
				<?php echo $this->Session->flash();?>
				
				
				
					<div class="row-fluid  footer_div">
					<div class="span12">
						<div class="box box-bordered box-color">
						
						<div class="box-title">
								<h3><i class="icon-list"></i> <?php echo $biz_type ? $biz_type.' Business' : 'My Business';?></h3>
							</div>
							
						
				<?php echo $this->Form->create('BdBusiness', array('id' => 'formID', 'style' => 'margin:0', 'class' => 'form-vertical')); ?>

							<div class="box-content">
							
						<div class="dataTables_wrapper">
						
						<?php echo $this->Form->create('BdBusiness', array('id' => 'expForm', 'style' => 'margin:0', 'class' => 'form-vertical')); ?>

					<div class="pull-left homeSrchBox dn" style="margin-left:7px;padding-bottom:10px;height:auto;">
					
					<div class="control-group bdSearch" style="margin-left:0">
					<label for="textfield" class="control-label">Keyword</label>
					<div class="controls controls-row">
					<?php echo $this->Form->input('keyword', array('div'=> false,'type' => 'text', 'id' => 'SearchText', 'label' => false, 'value' => $this->request->query['keyword'], 'class' => "input-large $bdsrchSel1",  'required' => false, 'autocomplete' => 'off', 'placeholder' => 'Type Keywords', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?>
					</div>
					</div>	
					
					<div class="advSrch dn">
					<div class="control-group bdSearch" >
					<label for="textfield" class="control-label"><a href="javascript:void(0);" rel="popover" data-content="Date of First Discussion" data-trigger="hover" data-placement="right">DOFD From</a></label>
					<div class="controls controls-row">
					<?php echo $this->Form->input('from', array('div'=> false,'type' => 'text', 'id' => 'SearchText', 'label' => false,  'class' => "datepick input-small required $bdsrchSel2",  'value' => $this->request->query['from'],  'required' => false, 'autocomplete' => 'off', 'placeholder' => 'Date From', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?>
					</div>
					</div>					
					
					<div class="control-group bdSearch">
					<label for="textfield" class="control-label"><a href="javascript:void(0);" rel="popover" data-content="Date of First Discussion" data-trigger="hover" data-placement="right">DOFD To</a></label>
					<div class="controls controls-row">
					<?php echo $this->Form->input('to', array('div'=> false,'type' => 'text', 'id' => 'SearchText', 'label' => false, 'class' => "datepick input-small required $bdsrchSel3",   'value' => $this->request->query['to'], 'required' => false, 'autocomplete' => 'off', 'placeholder' => 'Date To', 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
					</div>
					</div>
					
					<div class="control-group bdSearch">
					<label for="textfield" class="control-label">Vertical </label>
					<div class="controls controls-row">
					<?php echo $this->Form->input('vertical', array('div'=> false,'type' => 'select', 'label' => false, 'class' => "input-medium $bdsrchSel4", 'empty' => 'Select', 'selected' => $this->request->query['vertical'],  'required' => false, 'placeholder' => '',  'options' => $bizVertical, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
					</div>
					</div>
					
					<?php if($bdAdmin):?>
						<div class="control-group bdSearch">
					<label for="textfield" class="control-label">SPOC </label>
					<div class="controls controls-row">
					<?php echo $this->Form->input('spoc', array('div'=> false,'type' => 'select', 'label' => false, 'class' => "input-medium $bdsrchSel5", 'empty' => 'Select','selected' => $this->request->query['spoc'],   'required' => false, 'placeholder' => '', 'options' => $bizSpoc, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
					</div>
					</div>
					<?php $bizLeft = 'margin-left:0';
					else: ?>
					<?php $sowLeft = 'margin-left:0';endif; ?>
					
					<div class="control-group bdSearch">
					<label for="textfield" class="control-label">Opportunity </label>
					<div class="controls controls-row">
					<?php echo $this->Form->input('opportunity', array('div'=> false,'type' => 'select', 'label' => false, 'class' => "input-medium $bdsrchSel6", 'empty' => 'Select','selected' => $this->request->query['opportunity'],   'required' => false, 'placeholder' => '', 'options' => $bizOpportunity, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
					</div>
					</div>
					
					<div class="control-group bdSearch">
					<label for="textfield" class="control-label">Biz. Type </label>
					<div class="controls controls-row">
					<?php echo $this->Form->input('type', array('div'=> false,'type' => 'select', 'label' => false, 'class' => "input-small $bdsrchSel8", 'empty' => 'Select',  'required' => false, 'placeholder' => '','selected' => $this->request->query['type'],  'options' => $bizType, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
					</div>
					</div>
					
					<div class="control-group bdSearch">
					<label for="textfield" class="control-label">Priority </label>
					<div class="controls controls-row">
					<?php echo $this->Form->input('priority', array('div'=> false,'type' => 'select', 'label' => false, 'class' => "input-small $bdsrchSel7", 'empty' => 'Select',  'required' => false, 'placeholder' => '','selected' => $this->request->query['priority'],  'options' => $bizPriority, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
					</div>
					</div>
					
					<div class="control-group bdSearch">
					<label for="textfield" class="control-label">Biz. Spot By </label>
					<div class="controls controls-row">
					<?php echo $this->Form->input('spot', array('div'=> false,'type' => 'select', 'label' => false, 'class' => "input-medium $bdsrchSel14", 'empty' => 'Select','selected' => $this->request->query['spot'],   'required' => false, 'placeholder' => '', 'options' => $bizSpoc, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
					</div>
					</div>
					
					<div class="control-group bdSearch"   style="<?php echo $bizLeft;?>">
					<label for="textfield" class="control-label">Biz. Source </label>
					<div class="controls controls-row">
					<?php echo $this->Form->input('source', array('div'=> false,'type' => 'select', 'label' => false, 'class' => "input-medium $bdsrchSel15", 'empty' => 'Select','selected' => $this->request->query['source'],   'required' => false, 'placeholder' => '', 'options' => $bizSource, 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
					</div>
					</div>
					
					<div class="control-group bdSearch" style="<?php echo $sowLeft;?>">
					<label for="textfield" class="control-label"><a href="javascript:void(0);" rel="popover" data-content="Scope of Work" data-trigger="hover" data-placement="right">SOW</a></label>
					<div class="controls controls-row">
					<?php echo $this->Form->input('sow', array('div'=> false,'type' => 'select', 'selected' => $this->request->query['sow'], 'label' => false, 'class' => "input-medium $bdsrchSel9", 'empty' => 'Select',  'required' => false, 'placeholder' => '',  'options' => array('2' => 'Pending', '1' => 'Finalized'), 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
					</div>
					</div>
					
					<div class="control-group bdSearch"  >
					<label for="textfield" class="control-label"><a href="javascript:void(0);" rel="popover" data-content="Proposal Submitted" data-trigger="hover" data-placement="right">PS</a></label>
					<div class="controls controls-row">
					<?php echo $this->Form->input('proposal_done', array('div'=> false,'type' => 'select', 'selected' => $this->request->query['proposal_done'], 'label' => false, 'class' => "input-small $bdsrchSel10", 'empty' => 'Select',  'required' => false,  'placeholder' => '', 'options' => array('2' => 'Pending', '1' => 'Yes', '0' => 'No'), 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
					</div>
					</div>
					
					<div class="control-group bdSearch">
					<label for="textfield" class="control-label"><a href="javascript:void(0);" rel="popover" data-content="Proposal Approved" data-trigger="hover" data-placement="right">PA</a></label>
					<div class="controls controls-row">
					<?php echo $this->Form->input('proposal_approve', array('div'=> false,'type' => 'select', 'selected' => $this->request->query['proposal_approve'], 'label' => false, 'class' => "input-small $bdsrchSel11", 'empty' => 'Select', 'required' => false, 'placeholder' => '',  'options' => array('2' => 'Pending', '1' => 'Yes', '0' => 'No'), 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
					</div>
					</div>
					
					<div class="control-group bdSearch">
					<label for="textfield" class="control-label"><a href="javascript:void(0);" rel="popover" data-content="Agreement Signed" data-trigger="hover" data-placement="right">AS</a></label>
					<div class="controls controls-row">
					<?php echo $this->Form->input('agree_sign', array('div'=> false,'type' => 'select', 'label' => false,'selected' => $this->request->query['agree_sign'], 'class' => "input-small $bdsrchSel12", 'empty' => 'Select',  'required' => false, 'placeholder' => '',  'options' => array('2' => 'Pending', '1' => 'Yes', '0' => 'No'), 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
					</div>
					</div>
					
					<div class="control-group bdSearch">
					<label for="textfield" class="control-label"><a href="javascript:void(0);" rel="popover" data-content="Work Started" data-trigger="hover" data-placement="right">WS</a></label>
					<div class="controls controls-row">
					<?php echo $this->Form->input('work_status', array('div'=> false,'type' => 'select', 'label' => false, 'selected' => $this->request->query['work_status'], 'class' => "input-small $bdsrchSel13", 'empty' => 'Select', 'required' => false, 'placeholder' => '',  'options' => array('2' => 'Pending', '1' => 'Yes', '0' => 'No'), 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
					</div>
					</div>
					
					<div class="control-group bdSearch">
					<label for="textfield" class="control-label"><a href="javascript:void(0);" rel="popover" data-content="Work Status" data-trigger="hover" data-placement="right">WS</a></label>
					<div class="controls controls-row">
					<?php echo $this->Form->input('work_complete', array('div'=> false,'type' => 'select', 'label' => false, 'selected' => $this->request->query['work_complete'], 'class' => "input-medium $bdsrchSel16", 'empty' => 'Select', 'required' => false, 'placeholder' => '',  'options' => array('2' => 'Pending', '1' => 'Active/Inprogress', '0' => 'Inactive/Completed'), 'error' =>  array('attributes' => array('wrap' => 'div', 'class' => 'error')))); ?> 
					</div>
					</div>
					
					</div>
					<div class="control-group bdSearch">
					<label for="textfield" class="control-label" style="margin-top:4px;">Unread</label>
					<div class="controls controls-row">
		<input type="checkbox" class='icheck-me unRead' <?php echo $unread_check;?> value="1" name="un_read"> 
			<?php echo $this->Form->input('unread', array('type' => 'hidden',  'value' => $this->request->query['unread'], 'id' => 'unread'));?>

					</div>
					</div>
					
					
					<div class="control-group bdSearch">
					<label for="textfield" class="control-label">&nbsp; </label>
					<div class="controls controls-row">
									<?php echo $this->Form->input('srchSubmit', array('value' => $this->request->query['srchSubmit'], 'type' => 'hidden', 'id' => 'srchSubmit'));?>
									<?php echo $this->Form->input('srchAdvance', array('value' => $this->request->query['srchAdvance'], 'type' => 'hidden', 'id' => 'srchAdvance'));?>

<input type="submit" value="Submit" class="btn btn-primary" style="">
					<a href="<?php echo $this->webroot;?>bdbusiness/?type=<?php echo $this->request->query['type']?>"><input type="button" value="Reset" class="btn" style="margin-left:4px;"></a>

		<a href="javascript:void(0);" class="showAdvSrch"><input type="button" value="Advanced Search" class="btn btn-orange searchBtn" style="margin-left:4px;"></a>

											
					
						
						</div>
						
						
						
					</div>
					
					

						
					</div>

				</form>


								<table class="table table-hover table-nomargin table-bordered usertable dataTable">
									<thead>
										
										<tr>
										
											<th width="160">
											<?php echo $this->Paginator->sort('company_name', 'Customer', array('escape' => false,'direction' => 'desc'));?>
												</th>
											
												<th width="100">
											<?php echo $this->Paginator->sort('District.district_name', 'Location', array('escape' => false,'direction' => 'desc'));?>
												</th>
												
												<th width="80">
											<?php echo $this->Paginator->sort('dofd', 'DOFD', array('escape' => false,'direction' => 'desc'));?>
												</th>	
												
												
											
										
												
											<?php //if($bdAdmin):?>
												<th width="120">
											<?php echo $this->Paginator->sort('spoc', 'SPOC', array('escape' => false,'direction' => 'desc'));?>
												</th>
											<?php //endif; ?>
												
												<th width="195">
											<?php echo $this->Paginator->sort('HrBusinessUnit.business_unit', 'Biz. Vertical', array('escape' => false,'direction' => 'desc'));?>
												</th>
												
												<th width="130">
											<?php echo $this->Paginator->sort('Creator.first_name', 'Created By', array('escape' => false,'direction' => 'desc'));?>
												</th>
							<th  width="100">
											<?php echo $this->Paginator->sort('created_date', 'Created On', array('escape' => false,'direction' => 'desc'));?>
												</th>
												<th  width="70"><?php echo $this->Paginator->sort('is_approve', 'Status', array('escape' => false,'direction' => 'desc'));?>
</th>

												
												
		
												<th  width=""><?php echo $this->Paginator->sort('BdPriority.title', 'Priority', array('escape' => false,'direction' => 'desc'));?>
</th>

	<th width="180">Options</th>
										</tr>
									</thead>
									<tbody>
									
										
									
										<?php  foreach($business_data as $business): ?>
										
										<tr>
													
															<td>															
<span rel="tooltip" title="<?php echo $this->Functions->get_biz_type($business['BdBusiness']['type']);?> Business" class="label label-<?php echo $this->Functions->get_biz_type_cls($business['BdBusiness']['type']);?>"><?php echo $business['BdBusiness']['type'];?></span>
 <?php echo $this->Functions->string_truncate(ucwords($business['BdBusiness']['company_name']), 13);?>

 		<div style="margin:5px 0 0 25px;"><?php echo $this->Functions->show_biz_read_status($business['Unread']['id'], $business['Unread']['type'],$business['Unread']['created_date'],$business['Unread']['modified_date']);?></div>

 </td>
										
										<td><?php echo ucwords($business['District']['district_name']);?></td>

											<td><?php echo $this->Functions->format_date($business['BdBusiness']['dofd'])?>
											
											<?php //if($bdAdmin):?>
											<td><?php echo $business['Employee']['first_name'].' '.$business['Employee']['last_name'];?></td>
											<?php //endif; ?>
											
											<td>
											<?php $current_status = $this->Functions->get_bd_status_txt($business['BdBusiness']);
											$cs = explode('|', $current_status);?>
	<span rel="tooltip" title="<?php echo $cs[0];?>" class="label label-<?php echo $cs[1];?>"><?php echo $cs[2];?></span>

											<?php echo $business['HrBusinessUnit']['business_unit'];?></td>
											
											<td><?php echo $business['Creator']['first_name'].' '. $business['Creator']['last_name'];?>
											</td> 
																						<td><?php echo $this->Functions->format_date($business['BdBusiness']['created_date'])?></td>

											<td>
											<?php
											echo $this->Functions->get_bd_admin_status($business['BdBusiness']['is_approve'],$business['BdBusiness']['approve_date'],$business['Approver']['first_name']);
											 ?>
											</td>
											
											
										<td>
											<?php if($bdAdmin):?>
											<a href="javascript:void(0)" data-value="<?php echo $business['BdPriority']['id'];?>" data-type="select" data-pk="<?php echo $business['BdBusiness']['id']?>" data-url="<?php echo $this->webroot;?>bdbusiness/change_priority/<?php echo $business['BdBusiness']['id']?>/" class="priorChange"><?php echo $business['BdPriority']['title'];?></a>
											<?php else: ?>
											<span class="label label-<?php echo $this->Functions->get_priority_cls($business['BdPriority']['title']);?>"><?php echo $business['BdPriority']['title'];?></span>
											<?php endif; ?>
											</td>
					
		
		<td class='hidden-480'>
		
	
		
		
		<a href="<?php echo $this->webroot;?>bdbusiness/view/<?php echo $business['BdBusiness']['id']?>/" class="click_hide upRead btn iframeBox" rid ="<?php echo $business['Unread']['id'];?>" rtype="<?php echo $business['Unread']['type'];?>" val="90_90" rel="tooltip" title="" data-original-title="View"><i class="icon-search"></i></a>
		
		<?php if(($business['Spoc']['app_users_id'] == $this->Session->read('USER.Login.id') && $business['BdBusiness']['type'] != 'O')  || ($business['BdBusiness']['status'] == '0' && $bdAdmin && $business['BdBusiness']['is_approve'] != 'R')):?>
		<a href="<?php echo $this->webroot;?>bdbusiness/edit/<?php echo $business['BdBusiness']['id']?>/?type=<?php echo $business['BdBusiness']['type']?>" class="btn click_hide" rel="tooltip" title="" data-original-title="Edit"><i class="icon-edit"></i></a>
		<?php endif; ?>
		
		<?php //if($bdAdmin && $this->Session->read('USER.Login.app_roles_id') == '18'):?>
		<!--a href="javascript:void(0);"  rel="tooltip" title="Delete" name="<?php echo $business['BdBusiness']['id'];?>" class="click_hide btn delRec"><i class="icon-remove"></i></a-->
		<?php //endif; ?>
		
		<?php if($business['BdBusiness']['status'] == '1'):?>
		<a href="<?php echo $this->webroot;?>bdbusiness/reply/<?php echo $business['BdBusiness']['id']?>/" class="upRead click_hide iframeBox btn" rid ="<?php echo $business['Unread']['id'];?>" rtype ="<?php echo $business['Unread']['type'];?>" val="60_80" rel="tooltip" title="" data-original-title="Minutes of Review"><i class="icon-file-alt"></i>
		<?php if($business[0]['total_review']):?>
		<span class="label label-warning labelReview" style=""><?php echo $business[0]['total_review'];?></span>
		<?php endif; ?>
		</a>
		<?php endif; ?>
											</td>
										</tr>
										
									<?php endforeach; ?>
									</tbody>
								</table>
								

						<?php echo $this->element('paging');?>
								
							</div>	

							</div>
							<input type="hidden" id="del_url" value="<?php echo $this->webroot;?>bdbusiness/delete_biz/"/>	

						<input type="hidden" value="1" id="SearchKeywords">
						<input type="hidden" value="<?php echo $this->webroot;?>bdbusiness/" id="webroot">
						</div>
					</div>
				
				</form>
				</div>
					
					
				</div>
		
			
			</div>
			

		</div>	
			
		
		
									
<div id="dialog-confirm" title="Confirmation!" class="dn">
	<p>Are you sure you want to delete?</p>
</div>

		
				
		


