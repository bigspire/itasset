<?php
include('config/db.php');
date_default_timezone_set('Asia/Calcutta');
$last = date('Y-m-d 23:59:59', strtotime("-1 week"));
$sql = "delete from app_share where created_date <= '$last' and type != 'R'";
$result = mysql_query($sql);
?>

test content