<?php
/// 1.根据口令，解析出宝贝itemId：
/// http://gongziyu.com/taotools/tpwd.php?kouling=%E2%82%ACgyrabWmTg33%E2%82%AC

//2.根据宝贝ID，查询优惠券的coupon_activity_id，数量，金额：
/// http://gongziyu.com/taotools/tbk.coupon.php?itemid=565097035322

/// 3.根据宝贝ID，获得主图，价格等信息
/// http://gongziyu.com/taotools/weixin2taobaoService.php?id=536717273369


/// 4.根据优惠券id，item id，拼接出券合一链接：链接：
/// https://uland.taobao.com/coupon/edetail?activityId=e0b791daf10b4690aedcc234cd4bb2bd&pid=mm_00_00_00&itemId=545804497793

///5. 把链接生成新的口令

header("Content-type: text/html; charset=utf-8");
include "taobao-sdk/TopSdk.php";
//配置appkey
include "../config/gongziyutech-taobaoke.php";

//echo $appkey;
//变量声明
$itemId = "";
//

//////////////////////////////口令解析出宝贝ID
$c = new TopClient;
$c->appkey = $appkey;
$c->secretKey = $secret;
$req = new WirelessShareTpwdQueryRequest;
$req->setPasswordContent($_GET["kouling"]);
$resp = $c->execute($req);
//echo json_encode($resp);
//$kouling_outdata = json_encode($resp);
$kouling_outdata = json_decode(json_encode($resp), true);
$itemUrl = $kouling_outdata['url'];
//echo $itemUrl;
function get_between($input, $start, $end) {
    $substr = substr($input, strlen($start)+strpos($input, $start),(strlen($input) - strpos($input, $end))*(-1));

    return $substr;

}
$itemId = get_between($itemUrl, "com/i", ".htm");
//echo $itemId;

///////////////////////////////根据宝贝ID查询优惠券金额数量等

$reqforCoupon = new TbkCouponGetRequest;
$reqforCoupon->setMe("");
$reqforCoupon->setItemId($itemId);
$reqforCoupon->setActivityId("");
$reqforCouponResult = $c->execute($reqforCoupon);
//echo json_encode($reqforCouponResult);

$reqforCouponData = json_decode(json_encode($reqforCouponResult), true);

$coupon_activity_id = $reqforCouponData['data']['coupon_activity_id'];
$coupon_amount = $reqforCouponData['data']['coupon_amount'];
//echo '优惠券金额'.$coupon_amount.'元';

/////////////////////////////根据宝贝ID，获得主图，价格等信息

$reqfordetail = new TbkItemInfoGetRequest;
$reqfordetail->setNumIids($itemId);
$reqfordetail->setPlatform("1");
$reqfordetail->setIp("");
$reqfordetailResult = $c->execute($reqfordetail);

//echo json_encode($reqfordetailResult);
$reqfordetailData = json_decode(json_encode($reqfordetailResult), true);

$itemTitle = $reqfordetailData['results']['n_tbk_item']['title'];
$itemNick = $reqfordetailData['results']['n_tbk_item']['nick'];
$itemPic = $reqfordetailData['results']['n_tbk_item']['pict_url'];
$itemPrice = $reqfordetailData['results']['n_tbk_item']['reserve_price'];
$itemFinalePrice = $reqfordetailData['results']['n_tbk_item']['zk_final_price'];


//echo $itemTitle;

/////////////////////搞到二合一链接
//https://uland.taobao.com/coupon/edetail?activityId=e0b791daf10b4690aedcc234cd4bb2bd&pid=mm_98923130_55850461_19337200068&itemId=545804497793

$couponXurl = 'https://uland.taobao.com/coupon/edetail?activityId='. $coupon_activity_id .'&pid=mm_98923130_55850461_19337200068&itemId='. $itemId;
//echo $couponXurl ;


////////////////////搞到二合一口令

$reqforFinaleKouling = new TbkTpwdCreateRequest;
$reqforFinaleKouling->setUserId("123");
$reqforFinaleKouling->setText($itemTitle);
$reqforFinaleKouling->setUrl($couponXurl);
$reqforFinaleKouling->setLogo($itemPic);
$reqforFinaleKouling->setExt("{}");
$reqforFinaleKoulingResult = $c->execute($reqforFinaleKouling);
//echo json_encode($reqforFinaleKoulingResult);
$reqforFinaleKoulingData = json_decode(json_encode($reqforFinaleKoulingResult), true);
$finaleKouling = $reqforFinaleKoulingData['data']['model'];
//echo $finaleKouling;

///////////////////////////最后一步：输出给用户端数据

$xiaoyouhui = array('itemPic' => $itemPic, 'itemTitle' => $itemTitle, 'itemNick' => $itemNick, 'itemPrice' => $itemPrice, 'itemFinalePrice' => $itemFinalePrice,'coupon_amount'=>$coupon_amount,'finaleKouling'=>$finaleKouling);

echo json_encode($xiaoyouhui);



//echo "-end";










?>