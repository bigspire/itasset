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
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html lang="en">
<html>
<head>

<link rel="stylesheet" href="<?php echo $this->webroot;?>css/reset.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $this->webroot;?>css/overlay.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $this->webroot;?>css/colorbox.css" type="text/css" />


<script type="text/javascript" src="<?php echo $this->webroot;?>js/jquery-1.4.3.min.js"></script>
<script type="text/javascript" src="<?php echo $this->webroot;?>js/jquery.livequery.min.js"></script>


<script type="text/javascript" src="<?php echo $this->webroot;?>js/jquery.stylish-select.js"></script>
<script type="text/javascript" src="<?php echo $this->webroot;?>js/cufon.js"></script>
<script type="text/javascript" src="<?php echo $this->webroot;?>js/functions.js"></script>

</head>
<body>

<?php echo $this->fetch('content'); ?>	

</body>
</html>