{* Purpose : To upload resume.
 Created : Nikitasa
   Date : 07-03-2017 *}

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />	<title>
		Upload Resume - CT Hiring</title>
	   <!-- Bootstrap framework -->
         <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" />
         <link rel="stylesheet" href="bootstrap/css/bootstrap-responsive.min.css" />
       <!-- gebo blue theme-->
         <link rel="stylesheet" href="css/blue.css" id="link_theme" />            
         <!-- main styles -->
         <link rel="stylesheet" href="css/style.css" />
        
	
</head>
<body  class="menu_hover " >
	<div id="container">
		<div id="content">
			<div id="maincontainer" class="clearfix">
			
			<!-- main content -->
            <div id="contentwrapper">
               <div class="main_content" style="min-height:auto;">
            <div class="row-fluid">
				 <div class="span12">
				 
				 {if $ALERT_MSG}
							<div class="alert alert-info">
								<a class="close" data-dismiss="alert">×</a>
								{$ALERT_MSG}
							</div>
						{/if}
			 		
<form action="upload_resume.php?client_id={$client_id}&req_id={$req_id}" class="formID" id="formID" method="post" enctype="multipart/form-data" accept-charset="utf-8">
<div class="box">
	<div class="row-fluid">
		<div class="span6">
			<table class="table table-hover table-nomargin table-bordered usertable dataTable">
									<thead>
										<tr>
											<th width="150">Company Name</th>
											<th width="150">Contact Person</th>
											<th width="150">Email Id</th>
											<th width="150">Contact Number</th>
											<th width="150">City</th>
											<th width="150">Address</th>								
										</tr>
									</thead>
									<tbody>
									 {foreach from=$data item=item key=key}				
										<tr>
											<td><a href="javascript:void(0)" id="{$item.id}" class="chooseVendor">{ucfirst($item.vendor_name)}<a></td>
											<td>{ucfirst($item.vendor_person)}</td>
											<td>{$item.vendor_email}</td> 
											<td>{$item.vendor_phone}</td> 	
											<td>{$item.vendor_address}</td> 
											<td>{$item.vendor_city}</td>    
										</tr>
										
										<input type="hidden" value="{ucfirst($item.vendor_name)}" class="" id="company_{$item.id}"/>		
										<input type="hidden" value="{$item.vendor_person}" class="" id="person_{$item.id}"/>	
										<input type="hidden" value="{$item.vendor_email}" class="" id="email_{$item.id}"/>	
										<input type="hidden" value="{$item.vendor_phone}" class="" id="phone_{$item.id}"/>	
										<input type="hidden" value="{$item.vendor_address}" class="" id="address_{$item.id}"/>	
										<input type="hidden" value="{$item.vendor_city}" class="" id="city_{$item.id}"/>	
									

										<input type="hidden" value="add_software_vendor_details.php" class="redirect_url"/>		
									 {/foreach}	
							 </tbody>
								</table>
								<div class="dataTables_info" id="DataTables_Table_8_info">
									{$page_info}
								</div>
								<div class="table-pagination" id="DataTables_Table_8_paginate">
									{$page_links}		
								</div>
							&nbsp;							
						</div>	
		</div>
	</div>
</div>

</form>
  </div>
  </div>
 </div> 
</div>
</div>
</div>
</div>
	 
<script src="js/jquery.min.js"></script>
		
<input type="hidden" value="add_software_vendor_details.php" class="redirect_url"/>		
<input type="hidden" value="resume.php" class="redirect_url_value"/>	
<!-- main bootstrap js -->
		 
{literal}
<script type="text/javascript">
/* show the add page once selected the vendor successfully */
$(document).ready(function(){
    $(".chooseVendor").click(function(){
        var id = jQuery(this).attr('id');		
		parent.jQuery('#company_name').attr('value', jQuery('#company_'+id).val());
		parent.jQuery('#contact_person').attr('value', jQuery('#person_'+id).val());
		parent.jQuery('#company_email').attr('value', jQuery('#email_'+id).val());
		parent.jQuery('#contact_number').attr('value', jQuery('#phone_'+id).val());
		parent.jQuery('#city').attr('value', jQuery('#city_'+id).val());
		parent.jQuery('#address').text(jQuery('#address_'+id).val());		
		parent.jQuery(".modalCloseImg").click();
		parent.$.colorbox.close();
    });
});
</script>	
{/literal}
</body>
</html>