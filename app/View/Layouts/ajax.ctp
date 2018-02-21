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
<script type="text/javascript">
$(document).ready(function() {
		var track_load = 1; //total loaded record group(s)
		var loading  = false; //to prevents multipal ajax loads
		var roa_track_load = 1; //total loaded record group(s)
		var roa_loading  = false; //to prevents multipal ajax loads
		//detect page scroll				
			$('#shareScroll').unbind().scroll(function() {			
					
			   if($(this).scrollTop() >= ($(this)[0].scrollHeight - $(this).outerHeight())){
				
					
					total_groups = $('#total_group').val();
					
					if(track_load < total_groups && loading == false) //there's more data to load
					{ 
					
						loading = true; //prevent further ajax loading
						$('#busy-indicator').show(); //show loading image
						
						//load data from the server using a HTTP POST request
						$.post(root+'home/load_share/',{'group_no': track_load}, function(data){ 
											
							
							$("#share_results").append(data); //append received data into the element

							//hide loading image
							$('#busy-indicator').hide(); //hide loading image once data is received
							
							track_load++; //loaded group increment
							loading = false; 
						
						}).fail(function(xhr, ajaxOptions, thrownError) { //any errors?
							
							alert(thrownError); //alert with HTTP error
							$('#busy-indicator').hide(); //hide loading image
							loading = false;
						
						});
						
					}
				}
			});
			
			/* for roa scroll */
			
			$('#roa_shareScroll').unbind().scroll(function() {			
					
			   if($(this).scrollTop() >= ($(this)[0].scrollHeight - $(this).outerHeight())){
				
					
					total_groups = $('#roa_total_group').val();
					
					if(roa_track_load < total_groups && roa_loading == false) //there's more data to load
					{ 
					
						roa_loading = true; //prevent further ajax loading
						$('#busy-indicator').show(); //show loading image
						
						//load data from the server using a HTTP POST request
						$.post(root+'home/load_share/',{'group_no': roa_track_load,'type': 'roa'}, function(data){ 
											
							
							$("#roa_share_results").append(data); //append received data into the element

							//hide loading image
							$('#busy-indicator').hide(); //hide loading image once data is received
							
							roa_track_load++; //loaded group increment
							roa_loading = false; 
						
						}).fail(function(xhr, ajaxOptions, thrownError) { //any errors?
							
							alert(thrownError); //alert with HTTP error
							$('#busy-indicator').hide(); //hide loading image
							roa_loading = false;
						
						});
						
					}
				}
			});
});
</script>
<?php echo $this->element('ajax_js'); ?>
<?php echo $this->fetch('content'); ?>
