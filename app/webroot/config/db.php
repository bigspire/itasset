<?php
//Update database information according to your server settings
$conn=mysql_connect('localhost', 'root', '') or die("Can't connect to mysql host");
//Select the database to use
mysql_select_db('ceo_apps') or die("Can't connect to DB");
?>