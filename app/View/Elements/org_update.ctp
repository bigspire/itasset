	
	<p style="float:right">
	
	<?php
	foreach($org_data  as $key =>  $org):?>
	
	<a href="<?php echo $this->webroot;?>home/company/<?php echo $org['HrOrg']['title'];?>/">
	<?php echo $org['HrOrg']['title'];?></a>
	<?php if(count($org_data) > ++$key): ?>
	| 
	<?php endif; ?>
	
	<?php endforeach; ?>
	
	</p>