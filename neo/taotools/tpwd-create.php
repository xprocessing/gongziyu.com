<?php
header("Content-type: text/html; charset=utf-8");
include "taobao-sdk/TopSdk.php";
//配置appkey
include "../config/gongziyutech-taobaoke.php";
//测试口令生成
$c = new TopClient;
$c->appkey = $appkey;
$c->secretKey = $secret;


$c = new TopClient;
$c->appkey = $appkey;
$c->secretKey = $secret;
$req = new WirelessShareTpwdCreateRequest;
$tpwd_param = new GenPwdIsvParamDto;
$tpwd_param->ext="{\"xx\":\"xx\"}";
$tpwd_param->logo="http://gongziyu.com/shortcut.png";
$tpwd_param->url= $_GET["url2kouling"];
$tpwd_param->text="超值活动，惊喜活动多多";
$tpwd_param->user_id="24234234234";
$req->setTpwdParam(json_encode($tpwd_param));
$resp = $c->execute($req);




//print_r($resp);
echo json_encode($resp);



?>

