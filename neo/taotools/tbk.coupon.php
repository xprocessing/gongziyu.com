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

$req = new TbkCouponGetRequest;
$req->setMe("");
$req->setItemId($_GET["itemid"]);
$req->setActivityId("");
$resp = $c->execute($req);


//print_r($resp);
echo json_encode($resp);