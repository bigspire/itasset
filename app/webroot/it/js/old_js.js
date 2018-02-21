/* function to validate add software details page */
function validate_sd(){	
	//Note: assign field name
	var field_name = new Array('softwaretype','edition','subscription_based','license_no','system_req','brand','architechture_no','valid_till'
										,'paid_by','attach_warranty','paid_date','attach_bill'
										,'company_name','contact_number','city','contact_person','address'
										,'hardware_type_id','color','model_id','it_brand_id','serial_no','subscription_validity'
										,'inventory_no','state_id','district_id','asset_desc'
										,'amount'										
										,'title','type'
										,'title'
										,'title','code'
										,'title'
										,'role_name'
										,'app_users','username','server','login_type','password');
	//Note: assign field type
	var field_type = new Array("required","required","required","required","required","required","required","required"
										,"required"	,"required","required","required"	
										,"required","required","required","required","required"
										,"required","required","required","required","required","dropdown"
										,"required","required","required","required"	
										,"required"							   
									   ,"required","required"
									   ,"required"
									   ,"required","required"
									   ,"required"
									   ,"required"
									   ,"required","required","required","required","required");		
	var field_msg = new Array('');		
	var field_error_msg = new Array('Please select the Type','Please enter the Edition','Please select the subscription based ','Please select the No. of license','Please enter the system requirements','Please select the brand','Please select the Architecture ','Please select the Subscription validity'
											   ,'Please select the Paid By','Please attach the file','Please enter the paid date','Please attach the file'
												,'Please enter the Company Name','Please enter the Contact Number','Please enter the City','Please enter the Contact Person Name','Please enter the Address' 													
												,'Please select the type','Please enter the color','Please enter the model id/name','Please select the brand','Please enter the serial number','Please enter the Subscription validity '
												,'Please enter the Inventory No','Please select the Location','Please select the Location','Please enter the Asset Description'												
												,'Please enter the Amount'												
												,'Please enter the Title','Please select the Type'
												,'Please enter the Title '
												,'Please enter the Title','Please enter the CT Code '
												,'Please enter the Title'
												,'Please enter the Role Name'
												,'Please select the Employee','Please enter the Username ','Please enter the Server','Please select the Login Type','Please enter the Password'
	 );		
	var field_adv_error_msg = new Array('','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','');		
	var field_length=field_name.length;		
	var validation = item_validation(field_name, field_type,field_msg,field_error_msg,field_adv_error_msg,'');		
	if(validation == true){
		return true;
	}else{
		return false;
	}	 
	return false;
 }
 
