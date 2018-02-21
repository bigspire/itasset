<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
?>
<?php if($this->request->params['action'] == 'reply_share'): ?>
<script type="text/javascript">
$(document).ready(function() {

	/* reply share */	
	$('.replytoggle').unbind().on('click', function(){
		if($(this).next().find('.shareReply').is(":visible")){
			$($(this).next().find('.shareReply')).fadeOut();			
		}else{
			$($(this).next().find('.shareReply')).fadeIn();			
		}
		
	});
	
	$('.shareReply').on('keydown',function(e){
		value = $(this).val();
		id = $(this).attr('val');
		var keyCode = e.which || e.keyCode; 			
		if(keyCode == 13){ 						
			if($.trim(value) !=''){
				valid =  true;
			}else{
				valid =  false;
			}						
			// if validation success
			if(valid){
				$(this).val('');
				$(this).hide();
				update_reply_share(value,id);	
			}
		}
	});
	
	$('.openProf').on('click', function(){ 
			// hide all profiles
			$('.profSummary').hide();
			// show only the selected
			$('.member_'+$(this).attr('id')).show();
			// open the modal
			$('#myModal').modal({show:true})
	});
	
	// load the color box
	$('.iframeBox').click(function(){
		load_colorBox(this, $(this).attr('val'));	
	});
	
});
/* function to load the color box */
	function load_colorBox(obj, size){ 
		// email to friends	
		if($(obj).attr('val') != '' && $(obj).attr('val') != undefined) {
		
			dim = $(obj).attr('val').split('_');
			width = dim[0];
			height = dim[1];
		
			if($('#overlayclose').length > 0){
				over_close = false;
				esc = false;
				$('#cboxClose').show();	
				if($('#overlayclose').val() > 0){
					$('#cboxClose').hide();
				}			
			}else{
				over_close = true;
				esc = true;
			}
			
			
			$(obj).colorbox({iframe:true, rel: 'nofollow',  width:width+'%', height:height+'%',opacity:   '.8', 	  scrolling: true, fixed:true,overlayClose:over_close, escKey: esc,
				onClosed:function(){ 
				
				 }
			
			});
		}
	}
</script>
<?php endif; ?>
<?php echo $this->fetch('content'); ?>