<?php
/**
 * Created by PhpStorm.
 * User: Aaronzm
 * Date: 2017/8/12 0012
 * Time: 19:23
 */

define('APPID', 'wx852610c75cc39f9c');
define('APPSECRET', 'dcea2dff61a4a03223c2e37a5b2f1780');
define("TOKEN", "zhangming1122");
$url = $_GET["url"];
require_once('jssdk.php');
$jssdk = new JSSDK(APPID, APPSECRET);
echo json_encode($jssdk->GetSignPackage($url));