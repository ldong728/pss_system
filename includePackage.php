<?php
//以下为测试公众号用
//define('APP_ID','wx03393af10613da23');
//define('APP_SECRET','40751854901cc489eddd055538224e8a');
//define('WEIXIN_ID','gh_964192c927cb');
//define('MCH_ID','now is null');
//define('KEY','now is null');
//define("TOKEN", "godlee");
//define('DOMAIN',"mmzrb");
//define('NOTIFY_URL',"now is null");
//define("DB_NAME","gshop_db");
//define("DB_USER","gshopUser");
//define("DB_PSW","cT9vVpxBLQaFQYrh");
//$mypath = $_SERVER['DOCUMENT_ROOT'] . '/'.DOMAIN;   //用于直接部署




define('ADMIN','admin');
define('PASSWORD','admin');

//alipay
define("ALI_PAY_APP_ID","2016082100305102");
define("ALI_PAY_GATEWAY","https://openapi.alipaydev.com/gateway.do");

//server&database
define("PRO","http://");


//define('DOMAIN',"/");//正式部署
//define('DB_IP','121.40.162.180');
//define("DB_NAME","pss_system_db");
//define("DB_USER","pss_developer");
//define("DB_PSW","Wx7Av3PULQpfr4fJ");


define('DOMAIN',"/pss_system");
define('DB_IP','localhost');
define("DB_NAME","pss_system_db");
define("DB_USER","root");
define("DB_PSW","");

$mypath = $_SERVER['DOCUMENT_ROOT'] .DOMAIN;   //用于直接部署
include_once $mypath . '/includes/magicquotes.inc.php';
include_once $mypath . '/includes/db.inc.php';
include_once $mypath . '/includes/helpers.inc.php';
//include_once $mypath.'/includes/db.class.php';
header("Content-Type:text/html; charset=utf-8");