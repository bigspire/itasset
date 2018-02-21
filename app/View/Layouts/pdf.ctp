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

	<!-- Color CSS -->
	<link rel="stylesheet" media="screen" href="<?php echo $this->webroot;?>css/themes.css">	
	
	<!-- Theme CSS -->
	<link rel="stylesheet" media="screen"  href="<?php echo $this->webroot;?>css/pdf.css">

</head>
<body>

<?php echo $this->fetch('content'); ?>

</body>
</html>