<?php if(count($select_data) > 0) :?>
<div style="margin-top:10px;">
<?php foreach($select_data as $data): ?>
<button class="btn btn-minier btn-success pull-left" style="margin-left:10px;margin-bottom:10px;">

<span class="bigger-110"><?php echo ucfirst($data['Home']['first_name']);?></span>
</button>
<?php endforeach; ?>
</div>
<?php endif; ?>