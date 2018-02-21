<style>
table{border:1px dashed #efefef;}
.table-bordered th, .table-bordered td{border-left:1px dashed #efefef}
.table tr th, .table tr td{border-left:1px dotted #ddd;padding:6px;}
.table tr.sub_head th,tr.sub_head{background:#f7f7f7 !important;}
td.bold{font-weight:bold;}
</style><div class="">
	<div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header" style="padding:0">
          <h4 class="modal-title"><?php echo $message_data['HrMessage']['title'];?></h4>
        </div>
        <div class="modal-body" style="padding-left:0;">
        
		
				 <div>
		
<div class="widget-body" ><div class="widget-body-inner" style="display: block;">
												<div class="widget-main">
		<?php echo $message_data['HrMessage']['desc'];?>								
											
											
			
<?php if(!empty($message_data['HrMessage']['attachment'])):?>
	<div style="margin-top:5px;clear:left;"><a href="<?php echo $this->webroot;?>home/download_message/<?php echo $message_data['HrMessage']['attachment'];?>/" class="btn btn-light-grey" rel="tooltip" title="Download">Download File</a></div>

<?php endif; ?>	

												
											</div></div>
									</div>
        
		
        </div>
       
      </div>
    </div>
</div>
<input type="hidden" id="messagePage"/>