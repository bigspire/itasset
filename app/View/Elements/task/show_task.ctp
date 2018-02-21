<table style="margin:0px 20px 20px 10px;width:99%" class="calTable table table-hover table-nomargin"><thead>
<?php 
if($model_cls == 'TskAssign' || $model_cls == 'TskTeamAssign'):
$l1_th = '<th  width="90">L1 Status</th>';
endif;
?>
<?php 
if($model_cls == 'TskTeamAssign' || $model_cls == 'TskTeamPlan'):
$emp_th = '<th  width="100">Employee</th>';
endif;
?>
<?php if($data[0][$model_cls]['type'] == 'D'):?>
<tr><th width="200">Title</th><th width="350">Description</th><?php echo $emp_th; ?><th>Type</th><th>Date</th><th>Start</th><th>End</th><th>Status</th><?php echo $l1_th ; ?></tr>
<?php else: ?>
<tr><th width="200">Title</th><th width="200">Description</th><?php echo $emp_th; ?><th>Type</th><th  width="80">Start</th><th  width="80">End</th><th>Customer</th><th>Project</th><th  width="90">Status</th><?php echo $l1_th ; ?></tr>
<?php endif; ?>

</thead>
<tbody>
<?php foreach($data as $tsk):

$desc_limit = $tsk[$model_cls]['type'] == 'D' ? 40 : 20;

$desc_len = strlen($tsk[$model_cls]['desc']);
$more_display = ($desc_len > $desc_limit) ? '' : 'dn';
$long_desc = ($desc_len > $desc_limit) ? $tsk[$model_cls]['desc'] : '';
?>

<tr  class="">
<td><span rel="tooltip" title="<?php echo $this->Functions->show_plan_type($tsk[$model_cls]['type']);?>" class="tsk_tip label <?php echo $this->Functions->show_task_plan_color($tsk[$model_cls]['type']);?>"><?php echo $tsk[$model_cls]['type'];?></span>
 <a href="<?php echo $this->webroot;?><?php echo $model_url;?>/view_task/<?php echo $tsk[$model_cls]['id']?>/" 
 class=" iframeBox cboxElement tsk_title" val="90_80">
 <?php echo $this->Functions->string_truncate($tsk[$model_cls]['title'], 20);?> </a> 
 
 <?php echo $this->Functions->check_task_cc($tsk['TskAssignUser']['is_cc']);?>
 
  <?php if($tsk[$model_cls]['status'] == 'W' && $tsk['TskAssignUser']['is_cc'] != '1' && $this->request->params['controller'] != 'tskteamplan' && $this->request->params['controller'] != 'tskassign' && $this->functions->check_task_edit($tsk[$model_cls]['end'])):?>
 <a href="<?php echo $this->webroot;?><?php echo $model_url;?>/edit_task/<?php echo $tsk[$model_cls]['id']?>/?type=<?php echo $tsk[$model_cls]['type']?>&page=list"  rel="tooltip"  class="tsk_tip  tsk_title" title="Edit Task"><i class="icon-edit"></i></a>
 <?php endif; ?> 
 </td>
 <?php $tag_model_cls = $this->Functions->get_tag_class();?>
 
 <td><i data-placement="top" id="tag-<?php echo $tsk[$model_cls]['id'];?>"  val="<?php echo $tsk[$model_cls]['id'].'-'.$tsk[$tag_model_cls]['is_tag'];?>"  rel="tooltip" class="tsk_tip <?php echo $this->Functions->show_read_class($tsk[$tag_model_cls]['is_tag']);?> cursor icon-circle " title="" data-original-title="<?php echo $this->Functions->show_read_text($tsk[$tag_model_cls]['is_tag']);?>"></i>
 <span class="desc_less"> <?php echo $this->Functions->string_truncate($tsk[$model_cls]['desc'], $desc_limit);?></span> <span class=" desc_more dn "><?php echo $long_desc;?></span>
 <a class=" tsk_more <?php echo $more_display;?>" href="javascript:void(0);" style="color:#EF7575">more</a>
 <a class=" tsk_less dn" href="javascript:void(0);" style="color:#EF7575">less</a></td>
 
<?php if($model_cls == 'TskTeamAssign' || $model_cls == 'TskTeamPlan'): ?>
<td><?php echo $tsk['HrEmployee']['first_name'];?></td>
<?php endif; ?>

 <td><span><?php echo $tsk['TskPlanType']['title'];?></span></td>
 
 <?php if($tsk[$model_cls]['type'] == 'D'):?>
 <td><?php echo $this->Functions->format_date($tsk[$model_cls]['start']);?></td>
 <?php endif; ?>
 
 
 <td><span><?php echo  $this->Functions->format_tsk_time_show($tsk[$model_cls]['start'], $tsk[$model_cls]['type']);?></span>
 </td>
 

 
 <td><span><?php echo  $this->Functions->format_tsk_time_show($tsk[$model_cls]['end'], $tsk[$model_cls]['type']);?></span></td>
 
 <?php if($tsk[$model_cls]['type'] == 'P'):?>
 <td><?php echo $tsk['TskCustomer']['company_name']; ?></td>
  <td><?php echo $tsk['TskProject']['project_name'];?></td>
  <?php endif; ?>
 
 <td><span><span class="label <?php echo $this->Functions->show_task_status_color($tsk[$model_cls]['status']);?>">
 <?php echo $this->Functions->show_task_status($tsk[$model_cls]['status']);?></span>
 
 <?php if($tsk[$model_cls]['status'] == 'W'):?>
 <a href="<?php echo $this->webroot;?><?php echo $model_url;?>/change_task_status/<?php echo $tsk[$model_cls]['id']?>/?type=<?php echo $tsk[$model_cls]['type']?>&page=list"  rel="tooltip" val="40_66" class="tsk_tip iframeBox 
 cboxElement tsk_title" data-original-title="Change Status"><i class="icon-edit"></i></a>
 <?php else: ?> 
 <a href="javascript:void(0)" rel="tooltip" st="<?php echo $tsk[$model_cls]['status'];?>" val="<?php echo $tsk[$model_cls]['id'];?>" id="tk_<?php echo $tsk[$model_cls]['id'];?>" title="" class="commentTsk" data-original-title="View Comment"><i class="icon-comment-alt"></i></a>
 <?php endif; ?>
 
 </span></td>
 
<?php if($model_cls == 'TskAssign' || $model_cls == 'TskTeamAssign'): ?>

 <td>
 
 <?php //if($tsk[$model_cls]['status'] != 'W'):?>
 <span class="label <?php echo $this->Functions->show_lead_task_status_color($tsk['TskAssignStatus']['status'],$tsk[$model_cls]['modified_date'],$tsk['TskAssignStatus']['created_date']);?>"><?php echo $this->Functions->show_lead_task_status($tsk['TskAssignStatus']['status'],$tsk[$model_cls]['modified_date'],$tsk['TskAssignStatus']['created_date'],$tsk[$model_cls]['status']);?></span>
 
 <?php if($tsk['TskAssignStatus']['status'] == 'R' && strtotime($tsk['TskAssignStatus']['created_date']) > strtotime($tsk[$model_cls]['modified_date'])):?>
 <a href="javascript:void(0)" rel="tooltip" st="<?php echo $tsk['TskAssignStatus']['status'];?>" mod="lead_remark" val="<?php echo $tsk['TskAssignStatus']['id'];?>" id="lead_tk_<?php echo $tsk['TskAssignStatus']['id'];?>" title="" class="commentTsk" data-original-title="View Comment"><i class="icon-comment-alt"></i></a>
 <?php endif; //endif;?>
 
 </td>

<?php  endif; ?>
 </tr>
 
<?php endforeach; ?>
 
 
 </tbody>
 </table>