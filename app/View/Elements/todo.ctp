<ul id="tasks" class="sortable item-list ui-sortable todoData"><?php $i = 1;																
																foreach($todo_data as $list):?>
															
	<?php if($list['Todo']['status'] == '0'):
																		$check = "checked='checked'";
																		else:
																		$check = '';
																		endif; 
									 $item_st = $this->Functions->get_item_status($list['Todo']['status']);									?>
																		
			<li id="sort_<?php echo $list['Todo']['id'];?>" class="Lists item-<?php echo $this->Functions->get_color($i);?>  <?php echo $item_st;?> listitems-<?php echo $list['Todo']['id'];?>">
																	
		
		<label class="inline itemList">
																			
																
<input type="checkbox" val="itemList-<?php echo $list['Todo']['id'];?>" class="itemChk ace" <?php echo $check;?>/>   

<span class="itemLbl lbl"> &nbsp;  <?php echo $list['Todo']['item'];?></span>

		</label>
		
		<span class="edit_form"> </span>
		
		

																	
																	<div class="pull-right action-buttons">
																
																
																<span class="widget-toolbar no-border" style="color:#4383b4;line-height:normal">
																	<i class="icon-time bigger-110"></i>
																	<?php				
								echo $this->Functions->time_diff($list['Todo']['created_date']);?> 
																</span>
																
																	<?php if($item_st != 'selected'):?>
																	<a href="javascript:void(0)" val="edit-<?php echo $list['Todo']['id'];?>" class="blue editItem">
																			<i class="icon-pencil bigger-130"></i>
																	</a>
																	<?php endif; ?>

																		
																
																		<span class="vbar"></span>

																		<a href="javascript:void(0)" val="del-<?php echo $list['Todo']['id'];?>" class="red delItem">
																			<i class="icon-trash bigger-130"></i>
																		</a>
																		<span class="vbar"></span>
																		
																		
<?php if($item_st != 'selected'):?>
																		<a href="javascript:void(0)" val="flag-<?php echo $list['Todo']['id'];?>-<?php echo $flg_status = $this->Functions->get_flag_status($list['Todo']['flag']);?>" class="flag-<?php echo $list['Todo']['id'];?> flagItem <?php echo $flg_status;?>">
																			<i class="icon-flag bigger-130"></i>
																		</a>
																		<?php endif; ?>
																	</div>
																</li>
															<?php $i++; if($i == 8): $i = 1; endif; endforeach; ?>	
	</ul>