<?php
header("Content-type: text/html; charset=utf-8");
include "taobao-sdk/TopSdk.php";
//配置appkey
include "../config/gongziyutech-taobaoke.php";
//测试口令解析
$c = new TopClient;
$c->appkey = $appkey;
$c->secretKey = $secret;


$req = new WirelessShareTpwdQueryRequest;
$req->setPasswordContent($_GET["kouling"]);

$resp = $c->execute($req);


//print_r($resp);
echo json_encode($resp);


?>

