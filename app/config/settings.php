<?php
$root	= explode('/',$_SERVER['REQUEST_URI']);
$rootPath	= $root[1];

$documentroot	= $_SERVER['DOCUMENT_ROOT'];
 
define("LIVE_SITE",'http://'.$_SERVER['HTTP_HOST']."/$rootPath");
define("WEBROOT","$documentroot/$rootPath");
define("PROFILE_IMAGE_URL",LIVE_SITE.'img/');
define("PROFILE_IMAGE_WEBROOT",WEBROOT.'/img/');
define("PROFILE_UPLOAD_URL",WEBROOT.'/app/webroot/img/');

define("IMAGE_URL",LIVE_SITE.'/app/webroot/img/');
//define("UPLOAD_URL",LIVE_SITE.'app/webroot/uploadcsv/');
define("MEMBER_FILE_UPLOAD_URL",WEBROOT.'app/webroot/memberfiles/');
define("FILE_UPLOAD_URL",WEBROOT.'app/webroot/');
?>
