<?php if($this->Paginator->counter('{:current}') > 0):?>
<div class="dataTables_info" id="DataTables_Table_8_info">

<?php //echo $this->Paginator->counter(    'Page <span>{:page}</span> of <span>{:pages}</span>, showing <span>{:current}</span> records out of     <span>{:count}</span> total, starting on record <span>{:start}</span>, ending on <span>{:end}</span>');

echo $this->Paginator->counter('Page <span>{:page}</span> of <span>{:pages}</span> Total: <span>{:count}</span>');

?>


	 
	</div>



<div class="table-pagination" id="DataTables_Table_8_paginate">

<?php if($this->Paginator->counter('{:page}') != 1): 

// Shows the next and previous links
echo $this->Paginator->first('First ', null, null, array('class' => 'paginate_button'));

// Shows the next and previous links
echo $this->Paginator->prev('Previous ',null,  null, array('class' => 'paginate_button'));

?>

<?php endif; ?>

<span>

<?php // Shows the page numbers
echo $this->Paginator->numbers(array('tag' => '', 'separator' => ' ', 'currentTag' => 'a', 'currentClass' => 'active'));
?>

</span>


<?php if($this->Paginator->counter('{:pages}') != $this->Paginator->counter('{:page}')): 

echo $this->Paginator->next(' Next', null, null, array('class' => 'next paginate_button'));

echo $this->Paginator->last(' Last', null, null, array('class' => 'next paginate_button'));


?>


<?php endif; ?>

</div>

<?php endif; ?>


&nbsp;