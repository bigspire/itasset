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
<?php if($this->request->data['refresh'] != 1):?>
<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="icon" type="image/x-icon" href="<?php echo $this->webroot;?>favicon.ico">

	<?php if($this->request->params['controller'] == 'Logins'): ?>
	<!-- Theme CSS -->
	<link rel="stylesheet" href="<?php echo $this->webroot;?>css/login.css">
	<link rel="stylesheet" href="<?php echo $this->webroot;?>css/bootstrap_login.min.css">
	<script src="<?php echo $this->webroot;?>js/jquery.min.js"></script>
	<script src="<?php echo $this->webroot;?>js/bootstrap.min.js"></script>	
	<script src="<?php echo $this->webroot;?>js/login.js"></script>	

	<?php $bcls = 'login';?>
	<?php endif; ?>
	
	<?php if($this->request->params['controller'] == 'home'):?>
	<!-- basic styles -->
	<link href="<?php echo $this->webroot;?>css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo $this->webroot;?>css/font-awesome.min.css">		
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300">
	<link rel="stylesheet" media="screen" href="<?php echo $this->webroot;?>css/plugins/jquery-ui/smoothness/jquery-ui.css">
		
	<!-- colorbox -->
	<link rel="stylesheet" href="<?php echo $this->webroot;?>css/plugins/colorbox/colorbox.css">
	<!-- ace styles -->
	<link rel="stylesheet" href="<?php echo $this->webroot;?>css/ace.min.css">
	<link rel="stylesheet" href="<?php echo $this->webroot;?>css/ace-rtl.min.css">
	<link rel="stylesheet" href="<?php echo $this->webroot;?>css/ace-skins.min.css">		
	<link rel="stylesheet" href="<?php echo $this->webroot;?>css/jqueryui-editable.css">
	
	<!-- Core CSS File. The CSS code needed to make eventCalendar works -->
	<link rel="stylesheet" href="<?php echo $this->webroot;?>css/calhome/eventCalendar.css">
	<!-- Theme CSS file: it makes eventCalendar nicer -->
	<link rel="stylesheet" href="<?php echo $this->webroot;?>css/calhome/eventCalendar_theme_responsive.css">
	
	<link rel="stylesheet" href="<?php echo $this->webroot;?>css/jquery.bxslider.css">

	<style type="text/css">
	.ui-dialog .ui-dialog-titlebar{background:#438EB9; color:#ffffff;padding:.4em 1em}
	.ui-dialog .ui-dialog-titlebar-close{color:#fff}
	</style>
	

		

	<?php $bcls = 'navbar-fixed';?>
	<?php endif; ?>
	
	<!-- themes -->
	<link rel="stylesheet" href="<?php echo $this->webroot;?>css/themes/<?php echo $my_theme;?>.css">

	<?php echo $this->Html->charset(); ?>
	<title>
	 	<?php if($this->request->params['controller'] == 'Logins'): $web_title = 'Login'; else: $web_title = 'Home'; endif;  ?>
		
		<?php echo $web_title;?>   <?php if($TOT_COUNT > 0):?>
			 (<?php echo $TOT_COUNT; ?>)
			  <?php endif; ?> - My PDCA
		<?php //echo $title_for_layout; ?>
	</title>




</head>
<?php flush(); ?>
<!-- scrollHide-->
<body  class=" <?php echo $bcls; ?> theme-<?php echo $this->Functions->set_theme($this->request->params['theme']);?>" data-theme="theme-<?php echo $this->Functions->set_theme($this->request->params['theme']);?>">

	<!--div id="loading-image" class="loading dn"><span>Loading... Please wait... <img src="<?php echo $this->webroot;?>img/loading.gif"/></span></div-->
	
<div class="ajax_loading dn" id="busy-indicator" style="display:none"><span>Loading... Please wait... <img src="<?php echo $this->webroot;?>img/loading.gif"/></span></div>
	
<?php endif; ?>	

	<?php echo $this->fetch('content'); ?>		
	
	
	
<?php if($this->request->data['refresh'] != 1):?>			
	<?php echo $this->element('sql_dump'); ?>

<input type="hidden" value="<?php echo $this->webroot;?>" id="css_root">
</body>
</html>
<?php endif; ?>