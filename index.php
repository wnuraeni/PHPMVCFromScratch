<?php
/*Session start*/
session_start();
/*Error report*/
error_reporting(E_ALL & ~E_NOTICE);

/*Mendefinisikan PATH*/
define('SITE_PATH', realpath(dirname(__FILE__)).'/'); //define path ke folder C:
//echo SITE_PATH.'<br>';
define('BASE_URL','http://localhost/testOnline/'); //define path URL
/*Memasukkan/include file-file kerangka bangun dasar*/
require_once (SITE_PATH.'application/load.php');
require_once (SITE_PATH.'application/registry.php');
require_once (SITE_PATH.'application/request.php');
require_once (SITE_PATH.'application/router.php');
require_once (SITE_PATH.'application/database.php');
require_once (SITE_PATH.'application/baseController.php');
require_once (SITE_PATH.'application/baseModel.php');

/*Route request URL*/
Router::route(new Request);
?>
