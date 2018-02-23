<?php
/* 
Purpose : To include smarty.
Created : Gayathri, Nikitasa
Date : 02-06-2016
*/
// Report all errors except E_NOTICE

// error_reporting(E_ALL & ~E_NOTICE);

date_default_timezone_set('Asia/Kolkata');
// error_reporting(0);
ini_set('display_errors', '0');
define('webroot', '');
// define('IT_DIR', 'ceo_apps_it');
define("IT_DIR", "/2017/itassetsvn/itasset/", true);

// smarty config
include('vendor/smarty-3.1.29/libs/Smarty.class.php');
$smarty = new Smarty();
$smarty->setTemplateDir('templates');
$smarty->setCompileDir('templates_c');
$smarty->setCacheDir('cache');
$smarty->setConfigDir('configs');
?>