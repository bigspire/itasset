<?php 
$j = 1;
foreach($form_data as  $form):
$title = $form['HrDocCategory']['category'];
$title2 = $title; 

if($title1 != $title2):?>
<h5 class="header smaller red" style="clear:left;margin-top:0;"><?php  echo $j .'. '.$title;?>
</h5>
<?php $j++; endif; ?>

												<div class="itemdiv memberdiv noBorder" style="width:300px">
																
															
<div class="user">
															

							<img class="nav-user-photo" title="" src="<?php echo $this->webroot;?>img/<?php echo $this->Functions->get_file_icon($form['HrForm']['attachment']);?>" alt=""/>
							

							
																	</div>
																	
																	<div class="body">
																		<div class="name" style="">
					<a href="<?php echo $this->webroot;?>home/download_form/<?php echo $form['HrForm']['attachment'];?>" style="max-width:200px" rel="popover" data-placement="bottom" data-trigger="hover" title="Description" data-content="<?php echo $form['HrForm']['desc'];?>"><?php echo $form['HrForm']['form'];?></a>
																			
																		</div>

																		

																		<div>
			<?php if(strtotime($doc_modify) < strtotime($form['HrForm']['created_date']) || strtotime($doc_modify) < strtotime($form['HrForm']['modified_date'])):
				$label = 'label-warning';
				$label_new = '(New)';
				else:
				$label = '';
				$label_new = '';
				endif;
				?>
			<span class="label label-sm <?php echo $label;?>"><?php echo $this->Functions->format_date($this->Functions->get_latest_date($form['HrForm']['created_date'],$form['HrForm']['modified_date']));?> <?php echo $label_new;?></span>
																		</div>
																	</div>
																</div>
<?php

$title1 = $title;
?>		
<?php endforeach; ?>