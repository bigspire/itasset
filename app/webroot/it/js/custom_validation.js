var cur_form_name = "customForm";
check_fields = true;
var error_field = '',validate_index = undefined;
var control_count = 0;
var group_error_msg = '';
var individual_focus = undefined;
var validate_college = typeof validate;
function item_validation(field_name, field_type, field_msgg, field_error_msgg, field_adv_error_msg,set_foucs,other_error_field,control_index) {
    validate_index = control_index;
    individual_focus = set_foucs;
	//control_count = document.getElementById("Business_Category_count").value;
    check_fields = true;
	error_field = ''; group_error_msg = '';
	var n = field_name.length;
    var field_msg = field_msgg == undefined ? new Array() : field_msgg;
    var field_error_msg = field_error_msgg == undefined ? new Array() : field_error_msgg;
    var field_adv_error_msg = field_adv_error_msg == undefined ? new Array() : field_adv_error_msg;
	for (i = 0; i < n; i++) {

        if (field_msg == undefined) {
            field_msg[i] = '';
        }
        if (field_msg == undefined) {
            field_error_msg[i] = '';
        }
        if (field_adv_error_msg == undefined) {
            field_adv_error_msg[i] = '';
        }
		switch (field_type[i]) { 
			case "group_required":
                group_required_validation(field_name[i], field_msg[i] == undefined ? '' : field_msg[i], field_error_msg[i] == undefined ? '' : field_error_msg[i], field_adv_error_msg[i] == undefined ? '' : field_adv_error_msg[i]);
                break;
            case "sheepit_group_required":
                sheepit_group_required_validation(field_name[i], field_msg[i] == undefined ? '' : field_msg[i], field_error_msg[i] == undefined ? '' : field_error_msg[i], field_adv_error_msg[i] == undefined ? '' : field_adv_error_msg[i]);
                break;

            case "total_exp":
                total_exp_validation(field_name[i], field_msg[i], field_error_msg[i], field_adv_error_msg[i]);
                break;
			case "sheepit_work_period":
				sheepit_work_period_validation(field_name[i], field_msg[i], field_error_msg[i], field_adv_error_msg[i]);
                break;
            case "fcbkrequired":
                fcbkrequired_validation(field_name[i], field_msg[i], field_error_msg[i], field_adv_error_msg[i]);
                break;
            case "required":
                required_validation(field_name[i], field_msg[i], field_error_msg[i], field_adv_error_msg[i]);
                break;
            case "sheepit_required":
                sheepit_required_validation(field_name[i], field_msg[i], field_error_msg[i], field_adv_error_msg[i], '');
                break;
			case "website":	
			    website_validation(field_name[i], field_msg[i], field_error_msg[i], field_adv_error_msg[i]);
                break;
            case "password":
                password_validtion(field_name[i], field_msg[i], field_error_msg[i], field_adv_error_msg[i]);
                break;
            case "radio":
                radio_validation(field_name[i], field_msg[i], field_error_msg[i], field_adv_error_msg[i],'');
                break;
            case "checkbox":
                radio_checkbox(field_name[i], field_msg[i], field_error_msg[i], field_adv_error_msg[i]);
                break;
            case "dropdown":
                dropdown_validation(field_name[i], field_msg[i], field_error_msg[i], field_adv_error_msg[i]);
                break;
            case "sheepit_dropdown":
                sheepit_dropdown_validation(field_name[i], field_msg[i], field_error_msg[i], field_adv_error_msg[i], '');
                break;
            case "float":
                float_validation(field_name[i], field_msg[i], field_error_msg[i], field_adv_error_msg[i]);
                break;     
			case "mark":
                mark_validation(field_name[i], field_msg[i], field_error_msg[i], field_adv_error_msg[i]);
                break;
            case "sheepit_float":
                sheepit_float_validation(field_name[i], field_msg[i], field_error_msg[i], field_adv_error_msg[i], '');
                break;     
			case "sheepit_mark":
                sheepit_mark_validation(field_name[i], field_msg[i], field_error_msg[i], field_adv_error_msg[i], '');
                break;
            case "float_optional":
                float_optional_validation(field_name[i], field_msg[i], field_error_msg[i], field_adv_error_msg[i]);
                break;
            case "numeric":
                numeric_validation(field_name[i], field_msg[i], field_error_msg[i], field_adv_error_msg[i]);
                break;
            case "phone":
                phone_number_validation(field_name[i], field_msg[i], field_error_msg[i], field_adv_error_msg[i]);
                break;           
			case "contact_no":
                contact_no_validation(field_name[i], field_msg[i], field_error_msg[i], field_adv_error_msg[i]);
                break;	
			case "landline":
                landline_number_validation(field_name[i], field_msg[i], field_error_msg[i], field_adv_error_msg[i]);
                break;
            case "email":
                email_validation(field_name[i], field_msg[i], field_error_msg[i], field_adv_error_msg[i]);
                break;
            case "doc":
                file_document_validation(field_name[i], field_msg[i], field_error_msg[i], field_adv_error_msg[i]);
                break;             
			 case "pdf":
                file_pdf_validation(field_name[i], field_msg[i], field_error_msg[i], field_adv_error_msg[i]);
                break;  	
			case "doc_empty":
                file_empty_document_validation(field_name[i], field_msg[i], field_error_msg[i], field_adv_error_msg[i]);
                break; 			
			case "all_file_empty":
                file_empty_all_validation(field_name[i], field_msg[i], field_error_msg[i], field_adv_error_msg[i]);
                break; 
			case "image":
                file_image_validation(field_name[i], field_msg[i], field_error_msg[i], field_adv_error_msg[i]);
                break;			
			case "image_empty":
                file_image_emp_validation(field_name[i], field_msg[i], field_error_msg[i], field_adv_error_msg[i]);
                break;
            case "alpha_numeric":
                alphanumeric_validation(field_name[i], field_msg[i], field_error_msg[i], field_adv_error_msg[i]);
                break;
            case "question_radio":
                question_option_validation(field_name[i], field_msg[i], field_error_msg[i], field_adv_error_msg[i]);
				break;
        }
    }	

    if (jQuery.trim(error_field) != '' && set_foucs == undefined && (other_error_field == undefined)) {
		if(jQuery("#"+error_field+"_annoninput").length) {
			jQuery("#"+error_field+"_annoninput").find(".maininput").focus();
		}
		else if ($("#" + error_field).is("select")) {
            jQuery("#" + error_field).prev().click();
            setTimeout(function() {jQuery("#" + error_field).prev().find("a").focus();}, 0);
        }
        else if ($("#" + error_field).prev().hasClass("radio")) {
			setTimeout(function() {jQuery("#" + error_field).prev().find("a").focus();}, 0);
        }
        else {
			setTimeout(function() {jQuery("#" + error_field).focus();}, 0);
		}
        return false;
    }

	return check_fields;
}

function file_pdf_validation(field, msg, error_msg, adv_error_msg) {
    //if (document.getElementById(field).value != '') {
    var reg = /^.+(.PDF|.pdf)$/;
	val = document.getElementById(field).value;
	if(jQuery("#"+field+"_file").length && trim(val) == '' || trim(val) == null){
		val = jQuery("#"+field+"_file").val();
	}
	if (trim(val) == '' || trim(val) == null) {
        check_fields = check_fields && false;
        display_error_msg(field, error_msg);
    }
    else if (reg.test(val) == false) {
        display_error_msg(field, adv_error_msg);
        check_fields = check_fields && false;
    }
    else {
        hide_error_msg(field);
    }
}
/* file formate validations */
function file_document_validation(field, msg, error_msg, adv_error_msg) {
    //if (document.getElementById(field).value != '') {
    var reg = /^.+(.doc|.DOC|.DOCX|.docx)$/;
    val = document.getElementById(field).value;

    if (trim(val) == '' || trim(val) == null) {
        check_fields = check_fields && false;
        display_error_msg(field, error_msg);
    }
    else if (reg.test(val) == false) {
        display_error_msg(field, adv_error_msg);
        check_fields = check_fields && false;
    }
    else {
        hide_error_msg(field);
    }
}

/* file formate validations */
function file_empty_document_validation(field, msg, error_msg, adv_error_msg) {
    if (document.getElementById(field).value != '') {
		var reg = /^.+(.doc|.DOC|.DOCX|.docx)$/;
		val = document.getElementById(field).value;
		if (reg.test(val) == false) {
			display_error_msg(field, error_msg);
			check_fields = check_fields && false;
		}
		else {
			hide_error_msg(field);
		}
	}
	else {
		hide_error_msg(field);
	}
}

/* all file formate validations with empty*/
function file_empty_all_validation(field, msg, error_msg, adv_error_msg) {
    if (document.getElementById(field).value != '') {
	
		var reg = /^.+(.doc|.docx|.jpg|.jpeg|.gif|.png|.pdf|.xls|.xlsx)$/;
		val = document.getElementById(field).value.toLowerCase();
		if (reg.test(val) == false) {
			display_error_msg(field, error_msg);
			check_fields = check_fields && false;
		}
		else {
			hide_error_msg(field);
		}
	}
	else {
		hide_error_msg(field);
	}
}

/* all date formate validations with empty*/
function DateCheck(field1,field2, msg, error_msg, adv_error_msg)
{
  var StartDate= document.getElementById('field1').value;
  var EndDate= document.getElementById('field2').value;
  var eDate = new Date(EndDate);
  var sDate = new Date(StartDate);
  if(StartDate!= '' && StartDate!= '' && sDate> eDate)
    {
    	hide_error_msg(field1,field2);
    }else{
    	display_error_msg(field2, error_msg);
    }
}

/* image with empty file formate validations */
function file_image_validation(field, msg, error_msg, adv_error_msg) {
    if (document.getElementById(field) != undefined) {
		var reg = /^.+(.jpg|.jpeg|.gif)$/;
		val = document.getElementById(field).value.toLowerCase();
		 if (trim(val) == '' || trim(val) == null) {
			check_fields = check_fields && false;
			display_error_msg(field, error_msg);
		}
		else if (reg.test(val) == false) {
			display_error_msg(field, adv_error_msg);
			check_fields = check_fields && false;
		}
		else {
			hide_error_msg(field);
		}
	}
}

/* image without empty file formate validations */
function file_image_emp_validation(field, msg, error_msg, adv_error_msg) {
    if (document.getElementById(field).value != '') {
		var reg = /^.+(.jpg|.jpeg|.gif)$/;
		val = document.getElementById(field).value.toLowerCase();
		
		if (reg.test(val) == false) {
			display_error_msg(field, error_msg);
			check_fields = check_fields && false;
		}
		else {
			hide_error_msg(field);
		}
	}
	else {
		hide_error_msg(field);
	}
}

/* field required validation */
function fcbkrequired_validation(field, msg, error_msg, adv_error_msg) {
    if (document.getElementById(field) != null) {
		var main_input = jQuery.trim(jQuery("#"+field).next(".holder").find(".maininput").val());
		if (jQuery("#" + field + " option").size() == 0 && main_input == '') {
            check_fields = check_fields && false;
	
            display_error_msg(field, error_msg);
            if (error_field == '')
                error_field = field;
        }
        else {
            hide_error_msg(field);
        }
    }
}
/* Total Year exp validation */
function total_exp_validation(field, msg, error_msg, adv_error_msg) {

    if (field != '') {
        var split_field = field.split("-");
		var year_exp = '0';
        var dd = jQuery("#" + split_field[0]);
        var options = $('option', dd);
        options.each(function(i) {
            if ($(this).attr("selectedindex") > 0) {
                year_exp = i;
            }

        });
        var month_exp = '0';
        dd = jQuery("#" + split_field[1]);
        options = $('option', dd);
        options.each(function(i) {
            if ($(this).attr("selectedindex") > 0) {
                month_exp = i;
            }

        });
        if (year_exp == '0' && month_exp == '0') {
            display_error_msg(split_field[0], error_msg);
        } else {
            hide_error_msg(split_field[1]);
        }

    }
}
/* field website validation */
function website_validation(field, msg, error_msg, adv_error_msg, dont_show) {
	
    if (document.getElementById(field) != null) {

		val = trim(document.getElementById(field).value)
		var regexp = /^http[s]*\:\/\/[wwW]{3}\.+[a-zA-Z0-9]+\.[a-zA-Z]{2,3}.*$|^http[s]*\:\/\/[a-zA-Z0-9]+\.[a-zA-Z]{2,3}.*$|^[wwW]{3}\.+[a-zA-Z0-9]+\.[a-zA-Z]{2,3}.*$|^http[s]*\:\/\/[^w]{3}[a-zA-Z0-9]+\.[a-zA-Z]{2,3}.*$|http[s]*\:\/\/[0-9]{2,3}\.[0-9]{2,3}\.[0-9]{2,3}\.[0-9]{2,3}.*$/;
		if (trim(val) == '' || val.length == 0) {
            check_fields = check_fields && false;
            if (error_field == '')
                error_field = field;
            if (dont_show == undefined || dont_show == ''){
				display_error_msg(field, error_msg);
			}	
            else {

                group_error_msg = group_error_msg + ', ' + error_msg;
            }
        }
		else if(regexp.test(val) == false) {
			display_error_msg(field, adv_error_msg);
		}
        else {
            if (dont_show == undefined || dont_show == '')
                hide_error_msg(field);
        }
    }
}
/* field required validation */
function required_validation(field, msg, error_msg, adv_error_msg, dont_show) {
	if (document.getElementById(field) != null) {
        val = document.getElementById(field).value;

        document.getElementById(field).value = trim(document.getElementById(field).value);

        if (jQuery("#" + field).attr("placeholder") == val) {
            val = "";
        }
		
        if (trim(val) == '' || val.length == 0) {
            check_fields = check_fields && false;
            if (error_field == '')
                error_field = field;
            if (dont_show == undefined || dont_show == ''){ 
                 display_error_msg(field, error_msg);
				 }
            else{

                group_error_msg = group_error_msg + ', ' + error_msg;
            }
        }
        else {
            if (dont_show == undefined || dont_show == '')
                hide_error_msg(field);
        }
    }
}
/* Radio button validation */
function radio_validation(field, msg, error_msg,dont_show) {

    var rb2 = document.getElementsByName(field);

    var radio_choice2 = false;
    for (counter2 = 0; counter2 < rb2.length; counter2++) {
        if (rb2[counter2].checked) {
            radio_choice2 = true;
            break;
        }
    }

    if (radio_choice2 == false) {
        if (error_field == '')
                error_field = field;

            if (dont_show == undefined || dont_show == '')
			    display_error_msg(field, error_msg);
            else {

                group_error_msg = group_error_msg + ', ' + error_msg;
            }

    }
    else {
              if (dont_show == undefined || dont_show == '')
                hide_error_msg(field);
    }
}



/* Dropdown validation */
function dropdown_validation(field, msg, error_msg, adv_error_msg, dont_show,already_exists) {	
	
    if (document.getElementById(field) != undefined) {
		
		if(already_exists) {
				check_fields = check_fields && false;
				display_error_msg(field, error_msg);
		}else {
			var val = '0';
			var dd = jQuery("#" + field);
			if(validate_college != 'undefined') {
				val = jQuery("#"+field+" option:selected").index();
			}else{
				var options = $('option', dd);
				options.each(function(i) {
					if ($(this).attr("selectedindex") > 0) {
						val = i;
					}
				});
			}	
			
			if (val == "0") {
				check_fields = check_fields && false;
				if (error_field == '')
					error_field = field;
				if (dont_show == undefined || dont_show == '')
					display_error_msg(field, error_msg);
				else {

					group_error_msg = group_error_msg + ', ' + error_msg;
				}
			}
			else {	
				if (dont_show == undefined || dont_show == '')
					hide_error_msg(field);
			}
		}
	}
}
/* SheeptIt required validation */
function sheepit_required_validation(field, msg, error_msg, adv_error_msg, dont_show) {
	if (jQuery("[name='" + field + "[]']").length > 0) {
        var control_count = jQuery("[name='" + field + "[]']").length,start = 0;
		if(validate_index != undefined) {
			start = validate_index;
			control_count = start+1;
		}
        for (var i = start; i < control_count; i++) {
            required_validation(jQuery("[name='" + field + "[]']:eq(" + i + ")").attr("id"), msg, error_msg, adv_error_msg, dont_show);
        }
    }
}
/* SheeptIt Dropdown validation */
function sheepit_dropdown_validation(field, msg, error_msg, adv_error_msg, dont_show) {
    if (jQuery("[name='" + field + "[]']").length > 0) {
        var control_count = jQuery("[name='" + field + "[]']").length,start = 0;
		if(validate_index != undefined) {
			start = validate_index;
			control_count = start+1;
		}
        for (var i = start; i < control_count; i++) {
            dropdown_validation(jQuery("[name='" + field + "[]']:eq(" + i + ")").attr("id"), msg, error_msg, adv_error_msg, dont_show);
        }
    }
}
function sheepit_work_period_validation(field, msg, error_msg, adv_error_msg,dont_show) {
  
  if (field != '') {
      var split_field = field.split("-");
	  if (jQuery("[name='" + split_field[0] + "[]']").length > 0) {
		 var control_count = jQuery("[name='" + split_field[0] + "[]']").length;
		 var year_field,month_field,year_exp,dd,options,month_exp,year_text,month_text;
		 for (var i = 0; i < control_count; i++) {
			  year_field = 	jQuery("[name='" + split_field[0] + "[]']:eq(" + i + ")").attr("id");
			  month_field = 	jQuery("[name='" + split_field[1] + "[]']:eq(" + i + ")").attr("id");
			  year_exp = '0';
			  dd = jQuery("#" + year_field);
			  options = $('option', dd);
			 options.each(function(i) {
			
				if ($(this).attr("selectedindex") > 0) {
					year_exp = i;
					year_text = jQuery(this).text();
				}
			});
			 month_exp = '0';
			dd = jQuery("#" + month_field);
			options = $('option', dd);
			options.each(function(i) {
				if ($(this).attr("selectedindex") > 0) {
					month_exp = i;
					month_text = jQuery(this).text();
				}
			});
			if(year_text == 'Present') {
				year_exp = 1;
				month_exp = month_text == 'Present' ? 1 : 0;
			}
			if(month_text == 'Present') {
				month_exp = 1;
				year_exp = year_text == 'Present' ? 1 : 0;
				
			}
			
			if ((year_exp == '0' || month_exp == '0')) {
				display_error_msg(year_field, error_msg);
		    } else {
            hide_error_msg(year_field);
          }
		}
	}
 }
}
/* SheeptIt float required validation */
function sheepit_float_validation(field, msg, error_msg, adv_error_msg, dont_show) {

    if (jQuery("[name='" + field + "[]']").length > 0) {

        var control_count = jQuery("[name='" + field + "[]']").length;
        for (var i = 0; i < control_count; i++) {
            float_validation(jQuery("[name='" + field + "[]']:eq(" + i + ")").attr("id"), msg, error_msg, adv_error_msg, dont_show);
        }

    }
}
/* SheeptIt float required validation */
function sheepit_mark_validation(field, msg, error_msg, adv_error_msg, dont_show) {

    if (jQuery("[name='" + field + "[]']").length > 0) {

        var control_count = jQuery("[name='" + field + "[]']").length;
        for (var i = 0; i < control_count; i++) {
            mark_validation(jQuery("[name='" + field + "[]']:eq(" + i + ")").attr("id"), msg, error_msg, adv_error_msg, dont_show);
        }

    }
}
/* float validations*/
function float_validation(field, msg, error_msg, adv_error_msg, dont_show) {
    if (document.getElementById(field) != null) {
        val = document.getElementById(field).value;
        document.getElementById(field).value = trim(document.getElementById(field).value);
        var objRegExp = /^((\d+(\.\d*)?)|((\d*\.)?\d+))$/;
        if (trim(val) == '' || val.lenth == 0) {
            document.getElementById(field).value = '';
            if (dont_show == undefined || dont_show == '')
                display_error_msg(field, error_msg);
            else {

                group_error_msg = group_error_msg + ', ' + error_msg;
            }
            check_fields = check_fields && false;
        }
        else if (objRegExp.test(val) == false && (trim(val) != '' || val.length !== 0)) {
            document.getElementById(field).value = '';
            if (dont_show == undefined || dont_show == '')
                display_error_msg(field, error_msg);
            else {

                group_error_msg = group_error_msg + ', ' + error_msg;
            }
            check_fields = check_fields && false;
        }
        else {
            if (dont_show == undefined || dont_show == '')
                hide_error_msg(field);

        }
    }

}
/* float validations*/
function mark_validation(field, msg, error_msg, adv_error_msg, dont_show) {
	
    if (document.getElementById(field) != null) {
        val = document.getElementById(field).value;
        document.getElementById(field).value = trim(document.getElementById(field).value);
        var objRegExp = /^((\d+(\.\d*)?)|((\d*\.)?\d+))$/;
		if(adv_error_msg == 'optional' && trim(val) == ''){
			hide_error_msg(field);
			return;
		}
        if (trim(val) == '' || val.lenth == 0) {
            document.getElementById(field).value = '';
            if (dont_show == undefined || dont_show == '')
                display_error_msg(field, error_msg);
            else {

                group_error_msg = group_error_msg + ', ' + error_msg;
            }
            check_fields = check_fields && false;
        }
        else if (objRegExp.test(val) == false && (trim(val) != '' || val.length !== 0)) {
            document.getElementById(field).value = '';
            if (dont_show == undefined || dont_show == '')
                display_error_msg(field, error_msg);
            else {

                group_error_msg = group_error_msg + ', ' + error_msg;
            }
            check_fields = check_fields && false;
        } 
		else if (objRegExp.test(val) == true && (trim(val) != '' && val > 100)) {
            if (dont_show == undefined || dont_show == '')
                display_error_msg(field, mark_adv_error);
            else {

                group_error_msg = group_error_msg + ', ' + mark_adv_error;
            }
            check_fields = check_fields && false;
        }		
		else if (objRegExp.test(val) == true && (trim(val) != '' && val == 0)) {
            if (dont_show == undefined || dont_show == '')
                display_error_msg(field, mark_zero_error);
            else {

                group_error_msg = group_error_msg + ', ' + mark_zero_error;
            }
            check_fields = check_fields && false;
        }
		
        else {
            if (dont_show == undefined || dont_show == '')
                hide_error_msg(field);

        }
    }

}

/* field password validation */
function password_validtion(field, msg, error_msg, adv_error_msg, dont_show) {
    if (document.getElementById(field) != null) {

        val = jQuery("#"+field).val();
        val= trim(val);

        if (jQuery("#" + field).attr("placeholder") == val) {
            val = "";
        }
        if (trim(val) == '' || val.length == 0) {
            check_fields = check_fields && false;
            if (error_field == '')
                error_field = field;
            if (dont_show == undefined || dont_show == '')
                display_error_msg(field, error_msg);
            else {

                group_error_msg = group_error_msg + ', ' + error_msg;
            }
        }
		else if (trim(val) != '' && val.length < 4) {
            check_fields = check_fields && false;
            if (error_field == '')
                error_field = field;
            if (dont_show == undefined || dont_show == '')
                display_error_msg(field, password_min_max_error);
            else {

                group_error_msg = group_error_msg + ', ' + error_msg;
            }
        }
        else {
            if (dont_show == undefined || dont_show == '') {
                hide_error_msg(field);
			}
			if(field != 'password' && field != undefined) {
				//alert(field);
				if((jQuery('#password').val().length > 3) && (jQuery('#password').val() != jQuery('#'+field).val()) ) {
				      display_error_msg(field, password_mismatch_error);
					  }
				else {
					group_error_msg = group_error_msg + ', ' + error_msg;
				}
				
			}
        }
	
    }
}

/* Numberic Validations*/
function phone_number_validation(field, msg, error_msg, adv_error_msg) {
if (document.getElementById(field) != null) {
	required_validation(field);
    val = document.getElementById(field).value;
	var default_valid = 'true';
	if(trim(val) == '') {
		default_valid = 'false';
		check_fields = check_fields && false;
        display_error_msg(field, (error_msg != undefined && error_msg != '') ? error_msg : adv_error_msg);
	}
	
    var objRegExp =  /^0?[0-9]{1}\d{9}$/i;
	if (objRegExp.test(val) == false || (trim(val) == '' || val.length < 10 || val.length > 15 ) && (default_valid == 'true')) {
        check_fields = check_fields && false;
        display_error_msg(field, (adv_error_msg != undefined && adv_error_msg != '') ? adv_error_msg : error_msg);
	} else {
        hide_error_msg(field);
    }
	var page_name = jQuery('#'+field).closest('form').attr('id');
	if(objRegExp.test(val) == true && (page_name == 'profile' || page_name =='registration_step1') && (field == 'mobile1' || field == 'mobile_no1')){
		var page_redirect = 'check_mobile_exists';
		/*Note: The following script is used to redirect to particular page and get the value*/
		jQuery.post(jQuery("#page_url").val()+page_redirect,{mobile_no:trim(val),page:(page_name)},function(data){
			jQuery('#'+field).parent('div').removeClass('message');
			jQuery('#'+field).parent('div').find(".errorMsg").hide().text("");
			if(data == 'mobile_exist'){
				jQuery("#mobile_invalid").val(0);
				//validation = false;
				check_fields = check_fields && false;
				jQuery('#'+field).parent('div').addClass('message');
				jQuery('#'+field).parent('div').find(".errorMsg").show().text(mobile_number_try_another_error);
			}
			else{
				jQuery('#'+field).parent('div').find("span.available").show();
				jQuery('#'+field).parent('div').find(".errorMsg").hide();
				jQuery("#mobile_invalid").val(1);
			}
		});
	}
	}
}

/*Contact Number Validation (It could accept mobile or landline number*/

function contact_no_validation(field, msg, error_msg, adv_error_msg) {

    required_validation(field);
    val = document.getElementById(field).value;
	var default_valid = 'true';
	if(trim(val) == '') {
		default_valid = 'false';
		check_fields = check_fields && false;
        display_error_msg(field, (error_msg != undefined && error_msg != '') ? error_msg : adv_error_msg);
		return false;
	}
    var objRegExp = new RegExp("^[0-9 ]+$");
	var reg_landline = /^[0-9]\d{2,4}[- ]{1}\d{6,8}$/i;
	var reg_mobile = /^0?[0-9]{1}\d{9}$/i;
	if ((reg_mobile.test(val) == false && reg_landline.test(val) == false) || (trim(val) == '' || val.length == 0) && (default_valid == 'true')) {
		check_fields = check_fields && false;
        display_error_msg(field, (adv_error_msg != undefined && adv_error_msg != '') ? adv_error_msg : error_msg);


    } else {
        hide_error_msg(field);
    }
}
/* Landline number validation */
function landline_number_validation(field, msg, error_msg, adv_error_msg) {
    required_validation(field);
    val = document.getElementById(field).value;
	var default_valid = 'true';
	if(trim(val) == '') {
		default_valid = 'false';
		check_fields = check_fields && false;
        display_error_msg(field, (error_msg != undefined && error_msg != '') ? error_msg : adv_error_msg);
		return false;
	}
    var objRegExp = /^[0-9]\d{2,4}[- ]{1}\d{6,8}$/i;
    if (objRegExp.test(val) == false || (trim(val) == '' || val.length == 0) && (default_valid == 'true')) {
		check_fields = check_fields && false;
        display_error_msg(field, (adv_error_msg != undefined && adv_error_msg != '') ? adv_error_msg : error_msg);


    } else {
        hide_error_msg(field);
    }
}

/* Email Formate validations*/

function email_validation(field, msg, error_msg, adv_error_msg) {
    required_validation(field, msg, error_msg);
	
    // var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
	var reg = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	val = document.getElementById(field).value;
	
     if(reg.test(val) == true) {
		
		var page_name = jQuery('#'+field).closest('form').attr('id');
		
		if(page_name !='placement' && page_name !='business' && individual_focus == 'false'  && page_name !='edit_about'  && page_name !='login_form'){
		    
		jQuery('#'+field).parent('div').addClass('message');
		jQuery('#'+field).parent('div').find("span.available").hide();
		jQuery('#'+field).parent('div').find(".errorMsg").show().text(checking);
		var page_redirect = 'check_email_exists';
					/*Note: The following script is used to redirect to particular page and get the value*/
			jQuery.post(jQuery("#page_url").val()+page_redirect,{email_address:trim(val),page:(page_name)},function(data){
						jQuery('#'+field).parent('div').removeClass('message');
						jQuery('#'+field).parent('div').find(".errorMsg").hide().text("");
				if(data == 'email_exist'){
					jQuery("#email_invalid").val(0);
					//validation = false;
					check_fields = check_fields && false;
					jQuery('#'+field).parent('div').addClass('message');
					jQuery('#'+field).parent('div').find(".errorMsg").show().text(email_address_try_another_error);
				}
				else{
					jQuery('#'+field).parent('div').find("span.available").show();
					jQuery('#'+field).parent('div').find(".errorMsg").hide();
					jQuery("#email_invalid").val(1);
				}
			});
		}
		
	}
	else if ((reg.test(val) == false || trim(val) == '') || (email_exists != undefined && email_exists == 'true')) {
		jQuery(".available").hide();
		check_fields = check_fields && false;
        display_error_msg(field, (adv_error_msg != undefined && adv_error_msg != '' && trim(val) != '') ? adv_error_msg : error_msg);
    }
	else {
        hide_error_msg(field);
    }


}
/*Note: This is used to check,whether option checked or not on list question pages*/
function question_option_validation(class_name, field_msg, error_msg, field_adv_error_msg) {
  

   /* jQuery("." + class_name).each(function() {
        var name = jQuery(this).find('input:radio').attr("name");
        var index = jQuery("." + class_name).index(this);
        var $radios = $("input:radio[name=" + name + "]");
        if ($radios.is(':checked') == false) {
            $("input:radio[name=" + name + "] :first]").focus();
            jQuery(".error:eq(" + index + ")").html(error_msg);
            check_fields = check_fields && false;
            
        }
        else {         
            jQuery(".error:eq(" + index + ")").html("");
        }
    });*/
	
    jQuery("." + class_name).each(function() {

        if (jQuery(this).find("input:radio").length > 0) {
            if (jQuery(this).find("input:radio:checked").length == 0) {
                jQuery(this).find("span.errorMsg").html(error_msg);
                check_fields = check_fields && false;
                if (error_field == '')
                    error_field = jQuery(this).find("input:radio:first").attr("id");
                
            }
            else {
                jQuery(this).find("span.errorMsg").html("");
            }

        }
    });
   
   
}

/* field group required validation */
function group_required_validation(field, msg, error_msg, adv_error_msg) {

    group_error_msg = '';

    if (field != '') {
        var split_field = field.split("-");
        var msg1 = msg.split("-");
        var error_msg1 = error_msg.split("-");
        var adv_error_msg1 = adv_error_msg.split("-");
        var error_filed = "", split_field1 = '';
        for (var i = 0; i < split_field.length; i++) {
            split_field1 = split_field[i].split(":");

            if (split_field1[1] == "required") {
                required_validation(split_field1[0], msg1[i], error_msg1[i], adv_error_msg1[i], "dont_show");
            }
            else if (split_field1[1] == "dropdown") {
                dropdown_validation(split_field1[0], msg1[i], error_msg1[i], adv_error_msg1[i], "dont_show");
            }
            else if (split_field1[1] == "float") {
                float_validation(split_field1[0], msg1[i], error_msg1[i], adv_error_msg1[i], "dont_show");
            }        
			else if (split_field1[1] == "mark") {
                mark_validation(split_field1[0], msg1[i], error_msg1[i], adv_error_msg1[i], "dont_show");
            }

        }

        group_error_msg = group_error_msg.substring(1, group_error_msg.length);
        if (group_error_msg != "") {
            display_error_msg(split_field1[0], general_alert_error + group_error_msg + general_alert_error1);
        }
        else
            hide_error_msg(split_field1[0]);

    }
}



/* field group required validation */
function sheepit_group_required_validation(field, msg, error_msg, adv_error_msg) {
    group_error_msg = '';
    if (field != '') {

        var split_field = field.split("-");
        var split_field2 = split_field[0].split(":");
        var msg1 = msg.split("-");
        var error_msg1 = error_msg.split("-");
        var adv_error_msg1 = adv_error_msg.split("-");
        var error_filed = "", split_field1 = "";
        for (var i = 0; i < jQuery("[name='" + split_field2[0] + "[]']").length; i++) {
            

            for (var j = 0; j < split_field.length; j++) {
                split_field1 = split_field[j].split(":");
                
                if (split_field1[1] == "sheepit_required") {
                    required_validation(jQuery("[name='" + split_field1[0] + "[]']:eq(" + i + ")").attr("id"), msg1[j], error_msg1[j], adv_error_msg1[j], "dont_show");
                }
                else if (split_field1[1] == "sheepit_dropdown") {
                dropdown_validation(jQuery("[name='" + split_field1[0] + "[]']:eq(" + i + ")").attr("id"), msg1[j], error_msg1[j], adv_error_msg1[j], "dont_show");
                }
                else if (split_field1[1] == "sheepit_float") {

                float_validation(jQuery("[name='" + split_field1[0] + "[]']:eq(" + i + ")").attr("id"), msg1[j], error_msg1[j], adv_error_msg1[j], "dont_show");
                }    
				else if (split_field1[1] == "sheepit_mark") {

                mark_validation(jQuery("[name='" + split_field1[0] + "[]']:eq(" + i + ")").attr("id"), msg1[j], error_msg1[j], adv_error_msg1[j], "dont_show");
                }

            }
            
            group_error_msg = group_error_msg.substring(1, group_error_msg.length);
            
            if (group_error_msg != "") {
                display_error_msg(jQuery("[name='" + split_field1[0] + "[]']:eq(" + i + ")").attr("id"), general_alert_error + group_error_msg + general_alert_error1);
            }
            else
                hide_error_msg(jQuery("[name='" + split_field1[0] + "[]']:eq(" + i + ")").attr("id"));
            group_error_msg = '';
        }
        

    }
}

/* Numberic Validations*/
function numeric_validation(field, msg, error_msg, adv_error_msg) { 
    required_validation(field);
    val = document.getElementById(field).value;
    var objRegExp = /(^-?\d\d*\.\d*$)|(^-?\d\d*$)|(^-?\.\d\d*$)/;
    if (objRegExp.test(val) == false || (trim(val) == '' || val.length == 0)){
        jQuery("#" + field).addClass("error");
        check_fields = check_fields && false;
        if (document.getElementById(field + "_error") != null) {
            document.getElementById(field + "_error").className = "nameInfo error";
            if (error_msg)
                jQuery("#" + field + "_error").text((adv_error_msg != undefined && adv_error_msg != '') ? adv_error_msg : error_msg);
        }
    } else {
        jQuery("#" + field).removeClass("error");
        if (msg)
            jQuery("#" + field + "_error").text(msg);
        document.getElementById(field + "_error").className = "nameInfo";
    }
}

//chk if an object is an array or not.
function isArray(obj, value) {
    var bool = false;
    for (n = 0; n <= obj.length - 1; n++) {
        if (obj[n] == value && value != "||")
            bool = true;
    }
    return bool;
}




/* trim values */
function trim(val) {
    return val.replace(/^\s+|\s+$/g, '');
}


/* Radio button validation */
function radio_checkbox(field, msg, error_msg,dont_show) {

    var rb2 = document.getElementsByName(field);

    var radio_choice2 = false;
    for (counter2 = 0; counter2 < rb2.length; counter2++) {
        if (rb2[counter2].checked) {
            radio_choice2 = true;
            break;
        }
    }
	
    if (radio_choice2 == false) {
        if (error_field == '')
                error_field = field;

            if (dont_show == undefined || dont_show == ''){
				
			    display_error_msg(field, error_msg,'name');
			}	
            else {

                group_error_msg = group_error_msg + ', ' + error_msg;
            }

    }
    else {

              if (dont_show == undefined || dont_show == '')
                hide_error_msg(field,'','name');
    }
 
}


function float_optional_validation(field) {
    val = document.getElementById(field).value;
    var objRegExp = /^((\d+(\.\d*)?)|((\d*\.)?\d+))$/;
    if (trim(val) == '' || val.lenth == 0) {
        document.getElementById(field).style.border = '1px solid #B6B6B6';
    }
    else if (objRegExp.test(val) == false && (trim(val) != '' || val.length !== 0)) {
        document.getElementById(field).style.border = '1px solid #ff0000';
        check_fields = check_fields && false;
    }
    else {
        document.getElementById(field).style.border = '1px solid #B6B6B6';
    }


}


/* Alphanumeric validation */
function alphanumeric_validation(field) {
    //&& (/\d{1}[A-z]|[A-z]{1}\d/.test(val))
    var val = document.getElementById(field).value;
    document.getElementById(field).value = trim(document.getElementById(field).value);
    if (trim(val) == '' || val.length == 0) {

        document.getElementById(field).style.border = '1px solid #ff0000';
        check_fields = check_fields && false;

    }
    else if ((document.getElementById(field).value.search(/[^a-zA-Z0-9 ]/g) == -1)) {

        document.getElementById(field).style.border = '1px solid #B6B6B6';
    }
    else {
        document.getElementById(field).style.border = '1px solid #ff0000';
        check_fields = check_fields && false;
    }

}

/*Note: The following function is used to show the error msg*/
function display_error_msg(field, error_msg,control_type) {

	var id ="#" + field;
	if(field == 'role_perms'){
		jQuery(".rolePermError").html(error_msg).show();
	}else{
		jQuery(id).next(".errorMsg").html(error_msg).show();
	}
	
	/*
	if(control_type == 'name')
	   id ="[name='"+field+"']";
	var validate_clg = typeof validate;
	
	
	if(validate_clg != 'undefined' && validate == 'college') {
		var error_control = jQuery(id).parent(".error_msg").find(".error_label");
		if(!error_control.length) {
			error_control = jQuery(id).parents(".error_msg").find(".error_label");
		}
		error_control.addClass("error");
		error_control.show().html(error_msg);
	}	
	else {
		
		var parent_control = jQuery(id).parents(".error_total_exp").length ? jQuery(id).parents(".error_total_exp").find(".field:eq(0)") : ( jQuery(id).parents(".field").length == 1 ? jQuery(id).parents(".field") : jQuery(id).parents(".field_multiple"));
		parent_control.addClass("message");
		parent_control.find(".errorMsg").show().text(error_msg);
		
		if(jQuery("#no_fill_form").length > 0 && (jQuery(id).is(":text") || jQuery(id).is("textarea")))
			jQuery(id).addClass("no_fill");
	}	
	if (error_field == '')
		error_field = field;
	*/
}
/*Note: The following function is used to hide the error msg*/
function hide_error_msg(field,error_msg,control_type) {
	
	var id ="#" + field;
	if(field == 'role_perms'){
		 jQuery(".rolePermError").html(error_msg).hide();
	}else{
		jQuery(id).next(".errorMsg").html(error_msg).hide();
	}
	
	/*
	if(control_type == 'name')
	   id ="[name='"+field+"']";
	var validate_clg = typeof validate;
	if(validate_clg != 'undefined' && validate == 'college') {
		var error_control = jQuery(id).parent(".error_msg").find(".error_label");
		if(!error_control.length) {
			error_control = jQuery(id).parents(".error_msg").find(".error_label");
		}
		error_control.removeClass("error");
		error_control.hide().html("");
	}else{	
		var parent_control =  jQuery(id).parents(".error_total_exp").length ? jQuery(id).parents(".error_total_exp").find(".field:eq(0)") : (jQuery(id).parents(".field").length == 1 ? jQuery(id).parents(".field") : jQuery(id).parents(".field_multiple"));
		parent_control.removeClass("message");
		parent_control.find(".errorMsg").hide();
		if(jQuery(id).hasClass("no_fill"))
			jQuery(id).removeClass("no_fill");
	}	
	*/
}
//Note: The following scirpt is used to validate college dynamic controls
if(validate_college != 'undefined' && validate == 'college') {
	function validate_college_fields(field,type,error_msg,adv_error_msg,error_field1,current_focus_field,clone_row,control_index) {	
		validate_index = control_index;
		check_fields = true;
		var check_fields1 =  true,start = 0;
		error_field = error_field1;
		var dropdown_arr = new Array();
		var length = jQuery("."+field[0]).length;
		clone_row = clone_row == undefined ? "formRow" : clone_row;
		if(validate_index != undefined) {
			start = validate_index;
			length = start+1;
		}
		for(i = start; i < length; i++) {
			if(jQuery("."+field[0]+":eq("+i+")").parents("."+clone_row).css("display") != 'none') {
				if(type[0] == 'required' && type[1] == 'required') {
					if(type[0] == 'required') {
						if(current_focus_field == undefined || current_focus_field == field[0]) {
							required_validation(jQuery("."+field[0]+":eq("+i+")").attr("id"), '', error_msg[0], error_msg[0]);
						}else{
							check_fields = false;
						}
					}
					if(type[1] == 'required') {
						if(current_focus_field == undefined || current_focus_field == field[1]) {
							required_validation(jQuery("."+field[1]+":eq("+i+")").attr("id"), '', error_msg[1], error_msg[1]);
						}else{
							check_fields = false;
						}
					}
				}
				else if(type[0] == 'dropdown' && type[1] == 'required') {
					if(type[0] == 'dropdown') {
						var err_msg = error_msg[0];
						if(current_focus_field == undefined || current_focus_field == field[0]) {
							var id = jQuery("."+field[0]+":eq("+i+")").attr("id");
							var exists = false;
							if(jQuery("#"+id+" option:selected").index()) {
								if(jQuery.inArray(jQuery("#"+id+" option:selected").val(),dropdown_arr) >= 0) {
									exists = true;
									err_msg = adv_error_msg[0];
								}else{
									dropdown_arr.push(jQuery("#"+id+" option:selected").val());
								}
							}
							dropdown_validation(id, '', err_msg,'',undefined,exists);
						}else{
							check_fields = false;
						}
					}
					if(type[1] == 'required') {
						if(current_focus_field == undefined || current_focus_field == field[1]) {
							required_validation(jQuery("."+field[1]+":eq("+i+")").attr("id"), '', error_msg[1], error_msg[1]);
						}else{
							check_fields = false;
						}
					}
				}else if(type[0] == 'dropdown' && type[1] == 'dropdown' && type[2] == 'required') {
					
					if(type[0] == 'dropdown') {
						if(current_focus_field == undefined || current_focus_field == field[0]) {
							var id = jQuery("."+field[0]+":eq("+i+")").attr("id");
							dropdown_validation(id, '', error_msg[0],'',undefined);
						}else{
							check_fields = false;
						}	
					}
					
					if(type[1] == 'dropdown') {
						if(current_focus_field == undefined || current_focus_field == field[1]) {
						   var err_msg = error_msg[1];
							var id = jQuery("."+field[1]+":eq("+i+")").attr("id");
							var exists = false;
							if(jQuery("#"+id+" option:selected").index()) {
								var selected_value = jQuery("#"+jQuery("."+field[0]+":eq("+i+")").attr("id")+" option:selected").val()+":"+jQuery("#"+id+" option:selected").val();
								if(jQuery.inArray(selected_value,dropdown_arr) >= 0 && jQuery("#"+id+" option:selected").val() !='') {
									exists = true;
									err_msg = adv_error_msg[1];
								}else{	
									dropdown_arr.push(selected_value);
								}
							}
							
							dropdown_validation(id, '', err_msg,'',undefined,exists);
						}else{
							check_fields = false;
						}	
					
					}
					if(type[2] == 'required') {
						if(current_focus_field == undefined || current_focus_field == field[2]){
							required_validation(jQuery("."+field[2]+":eq("+i+")").attr("id"), '', error_msg[2], error_msg[2]);
						}else{
							check_fields = false;
						}	
					}
					
				}
				else if(type[0] == 'required' && type[1] == 'required' && type[2] == 'image_empty') {
					
					if(type[0] == 'required') {
						if(current_focus_field == undefined || current_focus_field == field[0]){
							var id = jQuery("."+field[0]+":eq("+i+")").attr("id");
							required_validation(id, '', error_msg[0],'',undefined);
						}else{
							check_fields = false;
						}	
					}
					
					if(type[1] == 'required') {
						if(current_focus_field == undefined || current_focus_field == field[1]){
							var id = jQuery("."+field[1]+":eq("+i+")").attr("id");
							required_validation(id, '', error_msg[1],'',undefined);
						}else{
							check_fields = false;
						}	
					}
					if(type[2] == 'image_empty') {
						if(current_focus_field == undefined || current_focus_field == field[2]){
							file_image_emp_validation(jQuery("."+field[2]+":eq("+i+")").attr("id"), '', error_msg[2], error_msg[2]);
						}else{
							check_fields = false;
						}	
					}
					
				}
				else if(type[0] == 'required' && type[1] == 'email' && type[2] == 'contact_no') {
					if(type[0] == 'required') {
						if(current_focus_field == undefined || current_focus_field == field[0]){
							var id = jQuery("."+field[0]+":eq("+i+")").attr("id");
							required_validation(id, '', error_msg[0],'',undefined);
						}else{
							check_fields = false;
						}	
					}
					if(type[1] == 'email') {
						if(current_focus_field == undefined || current_focus_field == field[1]){
							var id = jQuery("."+field[1]+":eq("+i+")").attr("id");
							email_validation(id, '', error_msg[1],adv_error_msg[1],undefined);
						}else{
							check_fields = false;
						}	
					}
					if(type[2] == 'contact_no') {
						if(current_focus_field == undefined || current_focus_field == field[2]){
							contact_no_validation(jQuery("."+field[2]+":eq("+i+")").attr("id"), '', error_msg[2], adv_error_msg[2]);
						}else{
							check_fields = false;
						}	
					}
				}
			}else{
				
			}
		}
		if(current_focus_field == undefined) {
			jQuery("#" + error_field).focus();
			return check_fields;	
		}
		return false;
			
	}
	
}
