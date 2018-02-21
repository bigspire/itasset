<div class="assignData">


	
	<table style="margin:0px 20px 20px 10px;width:99%" class="calTable table table-hover table-nomargin"><thead>

<?php 
if($model_cls == 'TskTeamAssign' || $model_cls == 'TskTeamPlan'):
$emp_th = '<th  width="100">Employee</th>';
endif;
?>

<tr><th width="200">Title</th><th width="200">Description</th><?php echo $emp_th; ?><th>Type</th><th  width="80">Start</th><th  width="80">End</th><th>Customer</th><th>Project</th><th  width="90">Status</th></tr>

</thead>
<tbody>
<?php foreach($data as $tsk):

$desc_limit = $tsk[$model_cls]['type'] == 'D' ? 40 : 20;

$desc_len = strlen($tsk[$model_cls]['desc']);
$more_display = ($desc_len > $desc_limit) ? '' : 'dn';
$long_desc = ($desc_len > $desc_limit) ? $tsk[$model_cls]['desc'] : '';
?>

<tr  class="">
<td>
 <a  style="color:#0E8EAB"  href="<?php echo $this->webroot;?><?php echo $model_url;?>/?type=<?php echo $tsk[$model_cls]['type']?>"  class="">
 <?php echo $this->Functions->string_truncate($tsk[$model_cls]['title'], 20);?> </a> 
 <span rel="tooltip" title="<?php echo $this->Functions->show_plan_type($tsk[$model_cls]['type']);?>" class="label <?php echo $this->Functions->show_task_plan_color($tsk[$model_cls]['type']);?>"><?php echo $tsk[$model_cls]['type'];?></span>
 
 
 
  
 </td>
 
 <td>
 <span class="desc_less"> <?php echo $this->Functions->string_truncate($tsk[$model_cls]['desc'], $desc_limit);?></span> <span class=" desc_more dn "><?php echo $long_desc;?></span>
<?php echo $this->Functions->check_task_cc($tsk['TskAssignUser']['is_cc']);?>
 </td>
 
<?php if($model_cls == 'TskTeamAssign' || $model_cls == 'TskTeamPlan'): ?>
<td><?php echo $tsk['HrEmployee2']['first_name'];?></td>
<?php endif; ?>

 <td><span><?php echo $tsk['TskPlanType']['title'];?></span></td>
 

 
 
 <td>
 <span>
  <?php if($tsk[$model_cls]['type'] == 'D'):
   echo  date('d, M', strtotime($tsk[$model_cls]['start']));
   echo ' ';   
   endif;
  echo  $this->Functions->format_tsk_time_show($tsk[$model_cls]['start'], $tsk[$model_cls]['type']);?></span>
 </td>
 

 
 <td><span>
  <?php if($tsk[$model_cls]['type'] == 'D'):
   echo  date('d, M', strtotime($tsk[$model_cls]['start']));
   echo ' ';
   endif;

 echo  $this->Functions->format_tsk_time_show($tsk[$model_cls]['end'], $tsk[$model_cls]['type']);?></span></td>
 
 <?php if($tsk[$model_cls]['type'] == 'P'):?>
 <td><?php echo $tsk['TskCustomer']['company_name']; ?></td>
  <td><?php echo $tsk['TskProject']['project_name'];?></td>
  <?php else:?>
  <td>&nbsp;</td>
  
  <td>&nbsp;</td>
  <?php endif; ?>
 
 <td><span><span class="label <?php echo $this->Functions->show_task_status_color($tsk[$model_cls]['status']);?>">
 <?php echo $this->Functions->show_task_status($tsk[$model_cls]['status']);?></span>
 
 
 
 </span></td>
 

 </tr>
 
<?php endforeach; ?>
 
 
 </tbody>
 </table>
   	
</div>