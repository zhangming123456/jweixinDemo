<?php
/**
 * Created by PhpStorm.
 * User: Aaronzm
 * Date: 2017/8/12 0012
 * Time: 18:54
 */

//class JSSDK
//{
//    private $appId;
//    private $secret;
//    private $token;
//
//    public function __construct($appId, $secret, $token)
//    {
//        $this->appId = $appId;
//        $this->secret = $secret;
//        $this->token = $token;
//    }
//
//    public function valid()
//    {
//        //logger("valid");
//        $echoStr = $_GET["echostr"];
//        //valid signature , option
//        if ($this->checkSignature()) {
//            //ob_clean();
//            echo $echoStr;
//            exit;
//        }
//    }
//}
define('APPID', 'wx852610c75cc39f9c');
define('APPSECRET', 'dcea2dff61a4a03223c2e37a5b2f1780');
define("TOKEN", "zhangming1122");

class JSSDK
{
    public function valid()
    {
        $echoStr = $_GET["echostr"];
        //valid signature , option
        if ($this->checkSignature()) {
            echo $echoStr;
            exit;
        }
    }

    public function responseMsg()
    {
        //get post data, May be due to the different environments
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
        //extract post data
        if (!empty($postStr)) {
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            $fromUsername = $postObj->FromUserName;
            $toUsername = $postObj->ToUserName;
            $keyword = trim($postObj->Content);
            $time = time();
            $textTpl = "<xml><ToUserName><![CDATA[%s]]></ToUserName><FromUserName><![CDATA[%s]]></FromUserName><CreateTime>%s</CreateTime><MsgType><![CDATA[%s]]></MsgType><Content><![CDATA[%s]]></Content><FuncFlag>0</FuncFlag></xml>";
            if (!empty($keyword)) {
                $msgType = "text";
                $contentStr = "Welcome to wechat world!";
                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                echo $resultStr;
            } else {
                echo "Input something...";
            }
        } else {
            echo "";
            exit;
        }
    }

    private function checkSignature()
    {
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];

        $token = TOKEN;
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr);
        $tmpStr = implode($tmpArr);
        $tmpStr = sha1($tmpStr);
        if ($tmpStr == $signature) {
            return true;
        } else {
            return false;
        }
    }
}