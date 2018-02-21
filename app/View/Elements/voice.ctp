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
          <h4 class="modal-title">My Voice</h4>
        </div>
        <div class="modal-body" style="padding-left:0">
        
		
				 <div>
		
<div class="widget-body" ><div class="widget-body-inner" style="display: block;">
												<div class="widget-main">
												<iframe src="<?php echo $this->webroot;?>poll/?id=<?php echo $this->Session->read('USER.Login.id');?>" width="500" height="400"  frameborder="0"></iframe>

												</div></div>
									</div>
        
		
        </div>
       
      </div>
    </div>
</div>
<input type="hidden" id="messagePage"/>