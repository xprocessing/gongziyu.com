<?php
header("Content-type: text/html; charset=utf-8");
include "taobao-sdk/TopSdk.php";
//配置appkey
include "../config/gongziyutech-taobaoke.php";

//搞到商品图片，标题，价格，口令，详情http://open.taobao.com/api.htm?docId=24515&docType=2
//$_GET["id"]
$c = new TopClient;
$c->appkey = $appkey;
$c->secretKey = $secret;
$req = new TbkItemInfoGetRequest;
$req->setNumIids($_GET["id"]);
$req->setPlatform("1");
$req->setIp("");
$resp = $c->execute($req);

//print_r($resp);
echo json_encode($resp);

