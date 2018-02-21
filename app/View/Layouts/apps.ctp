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
 * @package       files.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<head>

	<!-- Bootstrap -->
	<link rel="stylesheet" media="screen" href="<?php echo $this->webroot;?>css/bootstrap.css">

	<!-- Bootstrap responsive -->
	<link rel="stylesheet" media="screen" href="<?php echo $this->webroot;?>css/bootstrap-responsive.min.css">

	<!-- jQuery UI -->
	<link rel="stylesheet" media="screen" href="<?php echo $this->webroot;?>css/plugins/jquery-ui/smoothness/jquery-ui.css">
	<link rel="stylesheet" media="screen" href="<?php echo $this->webroot;?>css/plugins/jquery-ui/smoothness/jquery.ui.theme.css">

	<!-- Theme CSS -->
	<link rel="stylesheet" media="screen"  href="<?php echo $this->webroot;?>css/style.css">
	
	<link rel="icon"  type="image/x-icon"  href="<?php echo $this->webroot;?>favicon.ico">

	<!-- Color CSS -->
	<link rel="stylesheet" media="screen" href="<?php echo $this->webroot;?>css/themes.css">	

	<!-- Date picker CSS -->
	<link rel="stylesheet" media="screen" href="<?php echo $this->webroot;?>css/plugins/datepicker/datepicker.css">	
	<link type="text/css" media="screen" href="<?php echo $this->webroot;?>css/jquery.autocomplete.css" rel="stylesheet" />
	<link rel="stylesheet" media="screen" type="text/css" href="<?php echo $this->webroot;?>css/jquery.multiselect.css" />
	<!-- colorbox -->
	<link rel="stylesheet" href="<?php echo $this->webroot;?>css/plugins/colorbox/colorbox.css">
	<link rel="stylesheet" type="text/css" media="print" href="<?php echo $this->webroot;?>css/print.css">
	
	<!-- timepicker -->
	<link rel="stylesheet" href="<?php echo $this->webroot;?>css/plugins/timepicker/bootstrap-timepicker.min.css">
	
	<?php if($this->request->params['controller'] == 'bdbusiness'):?> 
	<link rel="stylesheet" href="<?php echo $this->webroot;?>css/plugins/icheck/all.css">
	<?php endif; ?>
		
	<!-- Notify -->
	<link rel="stylesheet" href="<?php echo $this->webroot;?>css/plugins/gritter/jquery.gritter.css">

	<link rel="stylesheet" href="<?php echo $this->webroot;?>css/themes/<?php echo $my_theme;?>.css">
	
	
	<?php if($this->request->params['controller'] == 'tskplan' || $this->request->params['controller'] == 'tskassign' 
	|| $this->request->params['controller'] == 'tskteamplan' || $this->request->params['controller'] == 'tskteamassign'):?>
	<!-- Grid CSS File (only needed for demo page) -->
	<link rel="stylesheet" href="<?php echo $this->webroot;?>css/paragridma.css">
	<!-- Core CSS File. The CSS code needed to make eventCalendar works -->
	<link rel="stylesheet" href="<?php echo $this->webroot;?>css/eventCalendar.css">
	<!-- Theme CSS file: it makes eventCalendar nicer -->
	<link rel="stylesheet" href="<?php echo $this->webroot;?>css/eventCalendar_theme_responsive.css">	
	<?php endif; ?>
	
	
	
	<?php if($this->request->params['controller'] == 'tskevent'): ?>
	<link rel="stylesheet" type="text/css" href="<?php echo $this->webroot;?>css/jquery.datetimepicker.css"/>
	<?php endif; ?>
	
	
	
	
	<?php if(($this->request->params['action'] == 'index' &&  $this->request->params['controller'] == 'tskplan')|| $this->request->params['action'] == 'edit_plan' || $this->request->params['action'] == 'assign_task'
	|| $this->request->params['action'] == 'edit_task' 	|| $this->request->params['action'] == 'add_request' || ($this->request->params['action'] == 'index' &&  $this->request->params['controller'] == 'tskteamassign')): ?>
	<link rel="stylesheet" type="text/css" href="<?php echo $this->webroot;?>css/jquery.timepicker.css"/>
	<?php endif; ?>
	
	
	<!-- multi select -->
	<?php if($this->request->params['controller'] == 'tskfile'): ?>
	<link rel="stylesheet" href="<?php echo $this->webroot;?>css/plugins/multiselect/multi-select.css">
	<!-- Plupload -->
	<link rel="stylesheet" href="<?php echo $this->webroot;?>css/plugins/plupload/jquery.plupload.queue.css">
	<?php endif; ?>
	
	<!-- Chosen -->
	<?php if(($this->request->params['controller'] == 'tskteamassign' && $this->request->params['action'] == 'index') || $this->request->params['action'] == 'create_file' || $this->request->params['action'] == 'assign_task' || $this->request->params['action'] == 'edit_file'
		|| $this->request->params['action'] == 'create_leave' || $this->request->params['action'] == 'edit_task'  || $this->request->params['action'] == 'add_request'
		|| $this->request->params['action'] == 'create_project' || $this->request->params['action'] == 'edit_project' || $this->request->params['action'] == 'recommend' || $this->request->params['action'] == 'edit_member'
		 || $this->request->params['action'] == 'create_reward' || $this->request->params['action'] == 'edit_reward' || $this->request->params['action'] == 'add_spoc' || $this->request->params['action'] == 'add_admin'
		 || $this->request->params['controller'] == 'bdbusiness'): ?>
	<link rel="stylesheet" href="<?php echo $this->webroot;?>css/plugins/chosen/chosen.css">	
	<?php endif; ?>
	
	<?php if($this->request->params['controller'] == 'bdbusiness'): ?>
		<link rel="stylesheet" href="<?php echo $this->webroot;?>css/jqueryui-editable.css">
	<?php endif; ?>
	
	
	<?php echo $this->Html->charset(); ?>
	<title>
		
		<?php echo $title_for_layout; ?>
	</title>
	
	


</head>
 <?php flush(); ?>
<body>
	<?php echo $this->element('coming');?>
<div class="loading dn" id="busy-indicator" style="display:none"><span>Loading... Please wait...</span></div>
	
	<div id="page_wrapper">
	<?php //echo $this->Session->flash(); ?>

	<?php echo $this->fetch('content'); ?>		
			
	<?php echo $this->element('sql_dump'); ?>
	
	<?php 
	if($this->request->params['action'] != 'create_expense' && $this->request->params['action'] != 'edit_expense' 
	&& $this->request->params['action'] != 'upload' && $this->request->params['action'] != 'leave_policy' && ($this->request->params['controller'] != 'hrattendance' && $this->request->query['type'] != 'team')
	&& ($this->request->params['action'] != 'reply')): ?>
	<?php echo $this->element('footer'); ?>
	<?php endif; ?>
	</div>
	
	<input type="hidden" value="<?php echo $this->webroot;?>" id="css_root">


	
	<!-- jQuery -->
	<script src="<?php echo $this->webroot;?>js/jquery.1.8.3.js"></script>
	
	<!--script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script-->	
	<script src="<?php echo $this->webroot;?>js/jquery-ui-1.10.4.custom.min.js"></script>
	<!-- slimScroll -->
	<script src="<?php echo $this->webroot;?>js/plugins/slimscroll/jquery.slimscroll.js"></script>
	<!-- Bootstrap -->
	<script src="<?php echo $this->webroot;?>js/bootstrap.min.js"></script>
	<!-- Chosen -->
	<!--script src="<?php echo $this->webroot;?>js/plugins/chosen/chosen.jquery.min.js"></script-->
	<!-- select2 -->
	<script src="<?php echo $this->webroot;?>js/plugins/select2/select2.min.js"></script>
	<!-- icheck -->
	<script src="<?php echo $this->webroot;?>js/plugins/icheck/jquery.icheck.min.js"></script>
	<!-- CKEditor -->
	<!--script src="<?php echo $this->webroot;?>js/plugins/ckeditor/ckeditor.js"></script-->
	<script src="//cdn.ckeditor.com/4.4.7/full/ckeditor.js"></script>
	<!-- Datepicker -->
	<?php if( $this->request->params['controller'] == 'tvlreq' ||  $this->request->params['controller'] == 'hrmessage'):?>	
	<script src="<?php echo $this->webroot;?>js/plugins/datepicker/bootstrap-datepicker_checkin.js"></script>
	<?php else:?>
	<script src="<?php echo $this->webroot;?>js/plugins/datepicker/bootstrap-datepicker.js"></script>
	<?php endif; ?>
	<!-- Timepicker -->
	<script src="<?php echo $this->webroot;?>js/plugins/timepicker/bootstrap-timepicker.min.js"></script>	
	<script type="text/javascript" src="<?php echo $this->webroot;?>js/multiselect/jquery.multiselect.js"></script>
	<?php if($this->request->params['action'] == 'add_request'):?>
	<script type="text/javascript" src="<?php echo $this->webroot;?>js/jquery.autocomplete2.js"></script>
	<?php else:?>
	<script type="text/javascript" src="<?php echo $this->webroot;?>js/jquery.autocomplete.min.js"></script>
	<?php endif; ?>
	<!-- Notify -->
	<script src="<?php echo $this->webroot;?>js/plugins/gritter/jquery.gritter.min.js"></script>	
	<script src="<?php echo $this->webroot;?>js/jquery.sheepItPlugin-1.1.1.js"></script>	
	<script src="<?php echo $this->webroot;?>js/jquery.printarea.js"></script>	
	<script src="<?php echo $this->webroot;?>js/plugins/colorbox/jquery.colorbox-min.js"></script>	
	<script src="<?php echo $this->webroot;?>js/application.js"></script>		
	<script src="<?php echo $this->webroot;?>js/jquery.cookie.js"></script>
	
	

	
	
	<?php if($this->request->params['controller'] == 'tskevent'): ?>
	<script src="<?php echo $this->webroot;?>js/jquery.datetimepicker.js"></script>
	<?php endif; ?>
	
	<?php if($this->request->params['controller'] == 'tskplan' || $this->request->params['controller'] == 'tskassign' 
	|| $this->request->params['controller'] == 'tskteamplan' || $this->request->params['controller'] == 'tskteamassign'):?>
	<script src="<?php echo $this->webroot;?>js/jquery.eventCalendar.js" type="text/javascript"></script>
	<?php endif; ?>
	
	<?php if(($this->request->params['action'] == 'index' &&  $this->request->params['controller'] == 'tskplan')|| $this->request->params['action'] == 'edit_plan' || $this->request->params['action'] == 'assign_task'
	|| $this->request->params['action'] == 'edit_task' 	|| $this->request->params['action'] == 'add_request' || ($this->request->params['action'] == 'index' &&  $this->request->params['controller'] == 'tskteamassign')
	|| $this->request->params['action'] == 'reply' || $this->request->params['controller'] == 'bdbusiness'): ?>
	<script src="<?php echo $this->webroot;?>js/jquery.timepicker.min.js"></script>
	<script src="<?php echo $this->webroot;?>js/jquery.autosize.min.js"></script>
	<?php endif; ?>
	
	
	<!-- multi select -->
	<?php if($this->request->params['controller'] == 'tskfile'): ?>
	<script src="<?php echo $this->webroot;?>js/plugins/multiselect/jquery.multi-select.js"></script>
	<script src="<?php echo $this->webroot;?>js/plugins/plupload/plupload.full.js"></script>
	<script src="<?php echo $this->webroot;?>js/plugins/plupload/jquery.plupload.queue.js"></script>	
	<?php endif; ?>
	
	
	
	
	<!-- Chosen -->
	<?php if(($this->request->params['controller'] == 'tskteamassign' && $this->request->params['action'] == 'index') || $this->request->params['action'] == 'create_file' || $this->request->params['action'] == 'assign_task' || $this->request->params['action'] == 'edit_file'
		|| $this->request->params['action'] == 'create_leave' || $this->request->params['action'] == 'edit_task'  || $this->request->params['action'] == 'add_request'
		|| $this->request->params['action'] == 'create_project' || $this->request->params['action'] == 'edit_project' || $this->request->params['action'] == 'recommend' || $this->request->params['action'] == 'edit_member'
		 || $this->request->params['action'] == 'create_reward' || $this->request->params['action'] == 'edit_reward' || $this->request->params['action'] == 'add_spoc' || $this->request->params['action'] == 'add_admin'
		 || $this->request->params['controller'] == 'bdbusiness'): ?>
	<script src="<?php echo $this->webroot;?>js/plugins/chosen/chosen.jquery.min.js"></script> 
	<?php endif; ?>	 
	
	<?php if($this->request->params['controller'] == 'bdbusiness'): ?>
	<script src="<?php echo $this->webroot;?>js/bootstrap-editable.min.js"></script>
	<?php endif; ?>
	
	<script src="<?php echo $this->webroot;?>js/main.js"></script>	
</body>
</html>